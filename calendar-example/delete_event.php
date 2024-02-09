<?php
require_once('util/persist.php');

$id = $_REQUEST['id'];
$_REQUEST = [];

delete_event($id);