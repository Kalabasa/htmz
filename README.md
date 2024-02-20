# htmz

_a low power tool for html_

<b>htmz</b> is a minimalist HTML microframework that gives you the power to create dynamic web user interfaces with the familiar simplicity of **plain HTML**.

Zero dependencies. Zero JS bundles to load. Not even a backend is required. _Just an inline HTML snippet_.

See the [documentation website](https://kalabasa.github.io/htmz) for more details, usage, examples, and more.

## Installing

Simply copy the following snippet into your page.

<!-- prettier-ignore-start -->
```html
<iframe hidden name=htmz onload="setTimeout(()=>document.querySelector(contentWindow.location.hash||null)?.replaceWith(...contentDocument.body.childNodes))"></iframe>
```
<!-- prettier-ignore-end -->

## What does it do?

htmz does one thing and one thing only.

- Enable you to load HTML resources within _any element_ in the page.

Imagine clicking a link, but instead of reloading the whole page, it only updates a relevant portion of the page. Think tabbed UIs, dual-pane list-detail layouts, dialogs, in-place editors, and the like.

**htmz is a generalisation of HTML frames.** &mdash; Load HTML resources within ~~any frame~~ _any element_ in the page.
