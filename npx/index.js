#!/usr/bin/env node
import fs from "fs-extra";
import yargs from "yargs/yargs";
import { hideBin } from "yargs/helpers";
import { RewritingStream } from 'parse5-html-rewriting-stream';
import ss from "stream-string";

const snippetHolder = [`<iframe hidden name=htmz onload="setTimeout(()=>document.querySelector(contentWindow.location.hash||null)?.replaceWith(...contentDocument.body.childNodes))"></iframe>`];

const args = yargs(hideBin(process.argv))
  .scriptName("npx htmzify")
  .example("npx htmzify src/index.html")
  .command("$0 <path>", "Installs htmz into an HTML file", (yargs) => yargs
    .positional("path", {
      type: "string",
      desc: "Path to the HTML file"
    })
    .option("nobak", {
      type: "boolean",
      desc: "Do not make a backup copy"
    })
  )
  .parse()

const filePath = args.path;

let cancel = false;
let prevIndent = "";
let prevPrevIndent = "";
const rewriter = new RewritingStream();

rewriter.on("startTag", (startTag) => {
  if (startTag.tagName === "iframe" && startTag.attrs.find(attr => attr.name === "name" && attr.value === "htmz")) {
    cancel = true;
    rewriter.stop();
  }
  rewriter.emitStartTag(startTag);
});

rewriter.on("text", (_, text) => {
  const indents = [...text.matchAll(/[\n\r](\s*)/g)];
  if (indents.length > 0) {
    prevPrevIndent = prevIndent;
    prevIndent = indents[indents.length - 1][1];
  }
  rewriter.emitRaw(text);
});

rewriter.on("endTag", (endTag) => {
  if (snippetHolder.length && (endTag.tagName === "html" || endTag.tagName === "body")) {
    rewriter.emitRaw(formatSnippet(snippetHolder.pop()));
  }
  rewriter.emitEndTag(endTag);
});

function formatSnippet(snippet) {
  return prevPrevIndent.slice(prevIndent.length) + snippet + "\n" + prevIndent;
}

const readStream = fs.createReadStream(filePath, { encoding: "utf-8" });
let transformed = await ss(readStream.pipe(rewriter));

if (cancel) process.exit(0);

if (snippetHolder.length) {
  transformed += formatSnippet(snippetHolder.pop());
}

if (!args.nobak) fs.moveSync(filePath, filePath + ".bak", { overwrite: true });
fs.writeFileSync(filePath, transformed);
