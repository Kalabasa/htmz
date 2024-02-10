<?php
require_once 'util/props.php';
require_once 'util/color.php';
require_once 'util/persist.php';

[
  'id' => $id,
  'date_str' => $date_str,
  'content' => $content,
  'color' => $color,
  'action' => $action, // 'open' | 'close' | 'create' | 'save'
] = consume_props() + [
  'id' => uniqid(),
  'content' => '',
  'color' => '#ffcc00',
  'action' => 'close',
];

$html_id = "event-{$id}";
$placeholder = $content ? $content : 'new entry';
$fg_color = get_fg_color($color);

if ($action === 'save') {
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
    action="event.php#<?= $html_id ?>"
    method="post"
  >
    <input name="id" type="hidden" value="<?= $id ?>">
    <input name="date_str" type="hidden" value="<?= $date_str ?>">
    <input name="content" type="hidden" value="<?= htmlspecialchars($content) ?>">
    <input name="color" type="hidden" value="<?= htmlspecialchars($color) ?>">

    <button
      class="event-button"
      name="action"
      value="open"
      style="background:<?= $color ?>;color:<?= $fg_color ?>"
    >
      <?= htmlspecialchars($placeholder) ?>
    </button>
  </form>

  <?php if ($action==='open' || $action==='create'): ?>
    <dialog open>
      <form
        action="event.php#<?= $html_id ?>"
        method="post"
      >
        <input name="id" type="hidden" value="<?= $id ?>">
        <input name="date_str" type="hidden" value="<?= $date_str ?>">
        <div class="event-dialog-row">
          <label>
            <input
              name="content"
              type="text"
              value="<?= htmlspecialchars($content) ?>"
              placeholder="<?= htmlspecialchars($placeholder) ?>"
              autofocus
            >
          </label>
          <label>
            <input name="color" type="color" value="<?= $color ?>">
          </label>
        </div>
        <div class="event-dialog-row">
          <button name="action" value="save">save</button>
          <button class="delete-button" formaction="delete_event.php#<?= $html_id ?>">delete</button>
          <?php if ($action !== 'create'): ?>
            <button
              name="action"
              value="close"
              class="close-button"
              formmethod="dialog"
            >
              close
            </button>
          <?php endif ?>
        </div>
      </form>
    </dialog>
  <?php endif ?>
</li>