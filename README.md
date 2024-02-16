# htmz

_A low power tool for HTML_

**htmz** is a snippet that gives you power to make seamless single-page-app experiences and web UI componentization with the simplicity of **plain HTML**.

No client-side libraries or scripting required. Not even a backend is required. Just HTML documents.

See the [documentation website](https://kalabasa.github.io/htmz) for more usage, examples, and more.

## What does it do?

htmz does one thing and one thing only.

- **Enables loading of HTML resources within _any element_ in the page, rather than loading a full web page at a time.**

So, imagine clicking a link, but it only updates a relevant part of the page, not reload the whole page.

_htmz is a generalisation of frames._

> Load HTML resources within ~~frames~~ _any element_ in the page.

## Installing

Simply copy the following snippet into your page.

<!-- prettier-ignore-start -->
```html
<iframe hidden name=htmz onload="window!=this.contentWindow&&setTimeout(()=>document.querySelector(this.contentWindow.location.hash||':not(*)')?.replaceWith(...this.contentDocument.body.childNodes))"></iframe>
```
<!-- prettier-ignore-end -->

No need for npm or &lt;script&gt; tags. No third-party domain requests.
