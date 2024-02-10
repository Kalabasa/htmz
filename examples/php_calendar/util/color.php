<?php
function get_fg_color($bg_color) {
  $r = intval(substr($bg_color, 1, 2), 16);
  $g = intval(substr($bg_color, 3, 2), 16);
  $b = intval(substr($bg_color, 5, 2), 16);
  $luminance = 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
  return $luminance < 160 ? '#fffd' : '#000a';
}