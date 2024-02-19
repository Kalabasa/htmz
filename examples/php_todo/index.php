<base target="htmz">
<link rel="stylesheet" href="style.css">

<h1>my todo list</h1>

<form
  class="create-form"
  action="create.php#create-slot"
  method="post"
>
  <input name="content" type="text" placeholder="Create todo items...">
  <button aria-label="Create">↵</button>
</form>

<ul>
  <div id="create-slot"></div>
</ul>

<?php include '../../htmz.html' ?>