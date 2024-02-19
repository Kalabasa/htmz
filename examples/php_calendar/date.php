<?php
require_once 'util/props.php';

[
  'date_str' => $date_str, // YYYY-MM-DD
  'highlighted' => $highlighted,
] = consume_props() + [
  'highlighted' => false,
];

$date = date_parse($date_str);
$create_slot_id = "create-slot-{$date_str}";

$events = array_filter(
  load_events($date['year'], $date['month']),
  fn($event) => $event['date_str'] === $date_str
);
?>

<div
  id="date-<?= $date_str ?>"
  class="date <?= $highlighted?'date-highlighted':'' ?>"
>
  <div class="date-num"><?= $date['day'] ?></div>

  <ul>
    <?php
    foreach ($events as $event) {
      render('event.php', [
        'id' => $event['id'],
        'date_str' => $event['date_str'],
        'content' => $event['content'],
        'color' => $event['color'],
      ]);
    }
    ?>
    <div id="<?= $create_slot_id ?>"></div>
  </ul>

  <form
    class="create-event-form"
    action="create_event.php#<?= $create_slot_id ?>"
    method="post"
  >
    <input name="date_str" type="hidden" value="<?= $date_str ?>">
    <button class="create-event">Create event</button>
  </form>
</div>