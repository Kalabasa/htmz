<?php
$date_str = $_REQUEST['date_str'];
$highlighted = $_REQUEST['highlighted'];
$_REQUEST = [];

$global_events = $global_events ?? load_events($year, $month);
$date_num = date_parse($date_str)['day'];
$create_slot_id = "create-slot-{$date_str}";

$events = array_filter(
  $global_events,
  fn($event) => $event['date_str'] === $date_str
);
?>

<div
  id="date-<?= $date_str ?>"
  class="date <?= $highlighted?'date-highlighted':'' ?>"
>
  <div class="date-num"><?= $date_num ?></div>

  <ul>
    <?php
    foreach ($events as $event) {
      $_REQUEST['id'] = $event['id'];
      $_REQUEST['date_str'] = $event['date_str'];
      $_REQUEST['content'] = $event['content'];
      $_REQUEST['color'] = $event['color'];
      $_REQUEST['closed'] = 1;
      include('event.php');
    }
    ?>
    <slot id="<?= $create_slot_id ?>"></slot>
  </ul>

  <form
    class="create-event-form"
    target="htmz"
    action="create_event.php#<?= $create_slot_id ?>"
    method="post"
  >
    <input name="date_str" type="hidden" value="<?= $date_str ?>">
    <button class="create-event">Create event</button>
  </form>
</div>