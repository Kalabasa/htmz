# htmz

_A low power tool for HTML_

**htmz** gives you power to make seamless single-page-app experiences and web UI componentization with the simplicity of **plain HTML**.

When I say plain HTML, I mean straight up HTML. No HTML extensions. No xy-weird yz-prefixed xz-attributes. No &lt;custom-elements&gt;. No DOM listeners. No AJAX!

No backend required. Though, web servers are pretty useful things when developing applcations & components. ;)

Inspired by [htmx](https://htmx.org/), HATEOAS[[1]](https://en.wikipedia.org/wiki/HATEOAS)[[2]](https://htmx.org/essays/hateoas/), [Comet](<https://en.wikipedia.org/wiki/Comet_(programming)>), and other similar application architectures and implementations. If you don’t know what those things are, it’s worth checking them out! I don’t think I can do a good job of explaining the general programming model here.

## What does it do?

It does one thing and one thing only.

- **Enables loading of HTML resources within _any element_ in the page, rather than loading a full web page at a time.**

So, imagine clicking a link, but it only updates a relevant part of the page, not reload the whole page. Without having to write client-side scripts or special HTML.

This idea is not new. Dividing web pages into independently reloading parts has been a thing since mid-1990s. They were called _frames_, namely, &lt;iframe&gt;s, &lt;frame&gt;s, and &lt;frameset&gt;s.

htmz is a generalisation of frames.

- Load HTML resources within ~~frames~~ _any element_ in the page.

## How do you use it?

Here’s a simple tabbed UI example. We have a tablist containing links to HTML resources and a tab panel to hold the content of those resources.

```html
<div role="tablist">
  <a target="htmz" href="/dog.html#my-tab-panel">Dog</a>
  <a target="htmz" href="/cat.html#my-tab-panel">Cat</a>
  <a target="htmz" href="/horse.html#my-tab-panel">Horse</a>
</div>

<slot id="my-tab-panel" role="tabpanel"></slot>
```

To invoke htmz, you need only native attributes, supplying these three things:

- The **target** attribute `target="htmz"`
- The href (or action) attribute pointing to the **resource URL** `href="/dog.html...`
- And continuing within href: the **destination id selector** immediately after the URL `...#my-tab-panel"`

```html
<!-- Loads /dog.html into #my-tab-panel -->
<a target="htmz" href="/dog.html#my-tab-panel">Dog</a>
```

Naturally, only `<a>` and `<form>` elements can target and invoke htmz (as of curent HTML5). This is fine; if you need something more dynamic than a request-response model, use JavaScript! It’s not forbidden. Anyway, don’t you forget the &lt;button&gt;’s `formaction` attribute!

## Installing

Simply copy the following snippet into your page.

<!-- prettier-ignore-start -->
```html
<iframe hidden name="htmz" onload="window!=this.contentWindow&&document.querySelector(this.contentWindow.location.hash||':not(*)')?.replaceWith(...this.contentDocument.body.children)"></iframe>
```
<!-- prettier-ignore-end -->

No need for npm or &lt;script&gt; tags. What CDNs?

## Base target

Tired of adding `target="htmz"` to every link and form?

Add `<base target="htmz">` at the top of your page to set the default target to use for all _relative_ URLs.

## Extensibility

Need advanced selectors? Need error handling? Here’s a development version of the snippet. Feel free to hack and extend. You’re a programmer, right?

```html
<script>
  function htmz(frame) {
    if (window === frame.contentWindow) return;

    const selector = frame.contentWindow.location.hash || ':not(*)';

    // Write your extensions here

    document.querySelector(selector)
      ?.replaceWith(...frame.contentDocument.body.children);
  }
</script>
<iframe hidden name="htmz" onload="htmz(this)"></iframe>
```

## How does it work?

htmz is an iframe named "htmz". It has an onload handler to process your invocations.

htmz is essentialy a _proxy target_.

It’s like when you want to reach `https://wikipedia.com` from another country but to do that you’d actually load another site, a proxy site like `https://someproxysite.com`, then provide the real target in a parameter `https://someproxysite.com/?url=https%3A%2F%2Fwikipedia%2Ecom`.

htmz is when you want to target `#my-tab-panel` but to do that you’d actually use the proxy target `target="htmz"` then provide the real target in a URL hash fragment.

When you load a URL into the htmz iframe, the onload handler kicks in. It parses your destination id selector and transplants the iframe’s contents (now containing the loaded HTML resource) into your specified destination.

Unlike other libraries, htmz only runs when you invoke it. It does not continually scan your DOM for special attributes and triggers, nor does it attach listeners everywhere. It’s a proxy not a VPN.

## Is htmz a library or a framework?

Neither. htmz is a **snippet**.

## What does htmz mean?

HTMZ stands for **H**tml **T**argeted **M**anipulation **Z**oner

However, the official backronym is **Hyper Text Markup Zanguage**.

## Is this a joke?

I don’t know. The tool actually works somehow. It’s powerful for its size. But there are limitations.
