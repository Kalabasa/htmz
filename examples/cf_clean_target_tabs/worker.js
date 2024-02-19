class ElementHandler {
  element(element) {
    element.after(
      `<iframe hidden name="#${element.getAttribute('id')}" onload="console.log(window.name,this.contentWindow.location.toString(),this.name, this.contentDocument.body.childNodes);this.contentWindow.location.href!=='about:blank'&&document.querySelector(this.name).replaceWith(...this.contentDocument.body.childNodes)"></iframe>`,
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