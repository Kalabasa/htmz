<?php
require_once 'util/props.php';
require_once 'util/persist.php';

['id' => $id] = consume_props();

delete_event($id);