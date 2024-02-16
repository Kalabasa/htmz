# htmz

_a low power tool for html_

<b>htmz</b> is a simple tool that gives you the power to create dynamic web user interfaces with the familiar simplicity of
**vanilla HTML**.

No client-side libraries to load. Not even a backend is required. Just HTML content and a _209-byte inline snippet_.

See the [documentation website](https://kalabasa.github.io/htmz) for more details, usage, examples, and more.

## What does it do?

htmz does one thing and one thing only.

- Enable you to load HTML resources within _any element_ in the page.

Imagine clicking a link, but instead of reloading the whole page, it only updates a relevant portion of the page. Think tabbed UIs, dual-pane list-detail layouts, dialogs, in-place editors, and the like. Imagine doing these things without having to write client-side scripts or mess with UI frameworks.

**htmz is a generalisation of HTML frames.** &mdash; Load HTML resources within ~~any frame~~ _any element_ in the page.

## Installing

Simply copy the following snippet into your page.

<!-- prettier-ignore-start -->
```html
<iframe hidden name=htmz onload="window!=this.contentWindow&&setTimeout(()=>document.querySelector(this.contentWindow.location.hash||':not(*)')?.replaceWith(...this.contentDocument.body.childNodes))"></iframe>
```
<!-- prettier-ignore-end -->
