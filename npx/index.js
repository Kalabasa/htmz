#!/usr/bin/env node
const fs = require("node:fs");

const htmzSnippet = `<iframe hidden name=htmz onload="setTimeout(()=>document.querySelector(contentWindow.location.hash||null)?.replaceWith(...contentDocument.body.childNodes))"></iframe>`;

if (process.argv.length < 3 || process.argv.length > 3 || process.argv[2].startsWith("-")) {
  console.error(`\
Usage: npx htmz <path>
Installs htmz into an HTML file.

Example:
  npx htmz src/index.html`);
  process.exit(1);
}

const filePath = process.argv[2];
const source = fs.readFileSync(filePath).toString();

if (source.includes(htmzSnippet)) return;

const sourceLowerCased = source.toLowerCase();
const bodyClosingTagIndex = sourceLowerCased.lastIndexOf("</body>");
const htmlClosingTagIndex = sourceLowerCased.lastIndexOf("</html>");
const contentEndIndex =
  bodyClosingTagIndex !== -1 ? bodyClosingTagIndex
    : htmlClosingTagIndex !== -1 ? htmlClosingTagIndex
      : source.length;

let trimmedContentEndIndex = contentEndIndex;
while (" \t\n".includes(source[trimmedContentEndIndex - 1])) trimmedContentEndIndex--;

const newSource = source.slice(0, contentEndIndex) + htmzSnippet + source.slice(trimmedContentEndIndex);

fs.renameSync(filePath, filePath + ".bak");
fs.writeFileSync(filePath, newSource);
