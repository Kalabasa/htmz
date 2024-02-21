const http = require('node:http');

const port = 4000;
const basename = `http://localhost:${port}/`;

function listen(routes) {
  const server = http.createServer(async (req, res) => {
    if (req.method !== 'GET') {
      res.statusCode = 405;
      res.end('use GET');
    }

    for (const [pathname, cb] of routes) {
      const reqURL = new URL(req.url, basename);
      if (reqURL.pathname === pathname) {
        res.setHeader('Content-Type', 'text/html; charset=utf-8');
        res.statusCode = 200;
        cb(req, res);
        return;
      }
    }

    res.statusCode = 404;
    res.end();
  });

  server.listen(port, () => {
    console.log(`node_chat server running at ${basename}`);
  });

  return { basename };
}

module.exports = listen;