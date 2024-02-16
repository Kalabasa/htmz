<?php
$id = $_REQUEST['id'];
$html_id = "todo-{$id}";
?>

<li
  class="todo-item"
  id="<?= $html_id ?>"
>
  <form
    action="edit.php#<?= $html_id ?>"
    method="post"
  >
    <input name="id" type="hidden" value="<?= $id ?>">
    <input
      class="todo-item-content"
      name="content"
      type="text"
      value="<?= htmlspecialchars($_REQUEST['content']) ?>"
      pattern=".+"
    >
    <button class="todo-item-save">save</button>
    <button
      class="todo-item-clear"
      formaction="clear.php#<?= $html_id ?>"
      aria-label="Clear">
      ✔
    </button>
  </form>
</li>