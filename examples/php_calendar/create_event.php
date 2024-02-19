<?php
require_once 'util/props.php';

['date_str' => $date_str] = consume_props();

$create_slot_id = "create-slot-{$date_str}";

render('event.php', [
  'date_str' => $date_str,
  'action' => 'create',
]);
?>

<div id="<?= $create_slot_id ?>"></div>