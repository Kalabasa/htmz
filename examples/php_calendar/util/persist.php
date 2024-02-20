<?php
function load_calendar() {
  $cookie = $_COOKIE['calendar'] ?? null;
  if (isset($cookie)) return unserialize(base64_decode($cookie));
  return [];
}

function save_calendar($calendar) {
  setcookie('calendar', base64_encode(serialize($calendar)));
}

function load_events($year, $month) {
  $calendar = load_calendar();
  return array_filter(
    $calendar,
    function($event) use($year, $month) {
      $date = date_parse($event['date_str']);
      return $date['year'] === $year && $date['month'] === $month;
    }
  );
}

function delete_event($id) {
  $calendar = load_calendar();
  unset($calendar[$id]);
  save_calendar($calendar);
}

function save_event($event) {
  $calendar = load_calendar();
  $calendar[$event['id']] = $event;
  save_calendar($calendar);
}