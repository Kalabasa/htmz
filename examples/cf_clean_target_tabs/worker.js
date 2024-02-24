class IFrameInjector {
  element(element) {
    element.after(
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
    // For every element with an ID, inject an htmz iframe
    return new HTMLRewriter().on('[id]', new IFrameInjector()).transform(res);
  }
}