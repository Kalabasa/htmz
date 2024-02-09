<?php
$date_str = $_REQUEST['date_str'];
$_REQUEST = [];

$create_slot_id = "create-slot-{$date_str}";

$_REQUEST['id'] = uniqid();
$_REQUEST['date_str'] = $date_str;
include('event.php');
?>

<slot id="<?= $create_slot_id ?>"></slot>