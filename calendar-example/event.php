<?php
require_once('util/color.php');
require_once('util/persist.php');

$id = $_REQUEST['id'];
$date_str = $_REQUEST['date_str'];
$content = $_REQUEST['content'];
$color = $_REQUEST['color'] ?? '#ffcc00';
$save = $_REQUEST['save'];
$closed = $_REQUEST['closed'] || !empty($save);
$_REQUEST = [];

$html_id = "event-{$id}";
$placeholder = $content ? $content : 'new entry';
$fg_color = get_fg_color($color);

if (!empty($save)) {
  save_event([
    'id' => $id,
    'date_str' => $date_str,
    'content' => $content,
    'color' => $color,
  ]);
}
?>

<li
  id="<?= $html_id ?>"
  class="event"
>
  <form
    target="htmz"
    action="event.php#<?= $html_id ?>"
    method="post"
  >
    <input name="id" type="hidden" value="<?= $id ?>">
    <input name="date_str" type="hidden" value="<?= $date_str ?>">

    <button
      class="event-button"
      name="open"
      value="open"
      style="background:<?= $color ?>;color:<?= $fg_color ?>"
    >
      <?= $placeholder ?>
    </button>

    <dialog <?= $closed?'':'open' ?>>
      <div class="event-form-row">
        <label>
          <input
            name="content"
            type="text"
            value="<?= $content ?>"
            placeholder="<?= $placeholder ?>"
            autofocus
          >
        </label>
        <label>
          <input name="color" type="color" value="<?= $color ?>">
        </label>
      </div>
      <div class="event-form-row">
        <button name="save" value="save">save</button>
        <button class="delete-button" formaction="delete_event.php#<?= $html_id ?>">delete</button>
      </div>
    </dialog>
  </form>
</li>