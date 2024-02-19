const fs = require('node:fs');
const listen = require('./server.js');

const pastMessages = [];
const subscribers = new Set();

const { basename } = listen([
  // serve index.html
  ['/node_chat/', (req, res) => {
    const indexFile = __dirname + '/index.html';
    const stat = fs.statSync(indexFile);
    res.setHeader('Content-Length', stat.size);
    fs.createReadStream(indexFile).pipe(res);
  }],

  ['/node_chat/chat', (req, res) => {
    res.setHeader('Cache-Control', 'no-cache, must-revalidate');
    const reqURL = new URL(req.url, basename);
    if (reqURL.searchParams.has("join")) {
      receivePastMessages(res);
    } else {
      receiveNextMessage(res);
    }
    broadcastNewMessage(req);
  }],
]);

function receivePastMessages(res) {
  res.end(html`
    <meta http-equiv="refresh" content="1; url=/node_chat/chat#new-messages">
    ${pastMessages.join('\n')}
    <div id="new-messages"></div>
  `);
}

function receiveNextMessage(res) {
  const onMessage = (content) => {
    res.end(html`
        <meta http-equiv="refresh" content="1; url=/node_chat/chat#new-messages">
        ${content}
        <div id="new-messages"></div>
      `);
    subscribers.delete(onMessage);
  };
  subscribers.add(onMessage);
}

function broadcastNewMessage(req) {
  const reqURL = new URL(req.url, basename);

  if (!reqURL.searchParams.has("text")) return;

  const author = reqURL.searchParams.get("author") ?? 'anon';
  const text = reqURL.searchParams.get("text");
  const message = html`
    <div class="message">
      <span class="message-author">${sanitize(author)}</span>
      <span class="message-text">${sanitize(text)}</span>
    </div>
  `;

  pastMessages.push(message);
  pastMessages.splice(0, pastMessages.length - 20);

  for (const onMessage of subscribers) {
    onMessage(message);
  }
}

function html(strings, ...values) {
  return String.raw({ raw: strings }, ...values);
}

function sanitize(value) {
  return value.toString()
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');
}