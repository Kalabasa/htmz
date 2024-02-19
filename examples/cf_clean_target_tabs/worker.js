class ElementHandler {
  element(element) {
    element.append(
      `<iframe hidden name="#${element.getAttribute('id')}" onload="window.htmz?.(this)"></iframe>`,
      { html: true }
    );
  }
}

export default {
  async fetch(req) {
    const url = new URL(req.url);
    url.host = "localhost:3000";
    const res = await fetch(new Request(url, req));
    return new HTMLRewriter().on('[id]', new ElementHandler()).transform(res);
  }
}