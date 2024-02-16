<?php
// Lightweight PHP componentization helper
// * Using these helpers, each php script becomes a component with a defined props interface.
// * Components can be rendered synchronously (programmatically) or async via HTTP request.
// * To programmatically render a component, call `render`.
// * To render a component via HTTP, load the php resource, passing props as GET or POST parameters.

// At the top of each php script, consume props
//
//   ['id' => $id, 'text' => $text] = consume_props();
//
function consume_props() {
  $props = $_REQUEST;
  $_REQUEST = [];
  return $props;
}

// Render a component with props
//
//   render('item.php', ['id' => 0, 'text' => 'foo']);
//
function render($filename, $props = []) {
  set_props($props);
  include $filename;
}

// Before invoking a component, set their props.
// Unlike `render`, this executes the component in the global scope.
//
//   set_props(['id' => 0, 'text' => 'foo']);
//   include('item.php');
//
function set_props($props) {
  $_REQUEST = $props;
}
