<div id="content">
    <p>The content below will be lazy loaded!</p>
    <progress id="target">
    </progress>
    <iframe src="slow.php#target" loading=lazy style="height:0;opacity:0"
        onload="setTimeout(()=>document.querySelector(contentWindow.location.hash||null)?.replaceWith(...contentDocument.body.childNodes))"></iframe>
</div>