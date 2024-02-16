<base target="htmz">
<link rel="stylesheet" href="style.css">

<h1>dialog</h1>

<p>Dialog picker using native HTML (&lt;dialog&gt;).</p>

<p>See <code>picker.php</code>. It represents a stateful UI component, but no state is stored server-side! The HTML is the state.</p>

<p>One limitation of dialogs is that you can’t have a modal dialog in pure HTML. You would have to do it the normal way (that is, client-side scripting for highly-interactive elements).</p>

<p>Back navigation & history works, surprisingly. You can <a href="https://en.wikipedia.org/wiki/Time_travel_debugging" target="_blank">‘time travel’</a> through application state natively using your browser’s history. But for real, I feel like this would only work for simple UIs (like a single target).</p>

<?php include 'picker.php' ?>

<?php include '../../htmz.html' ?>