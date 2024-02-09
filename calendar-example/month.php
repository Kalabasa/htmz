<?php
require_once('util/persist.php');

$cur_date = getdate();
$year = intval2($_REQUEST['year']) ?? $cur_date['year'];
$month = intval2($_REQUEST['month']) ?? $cur_date['mon'];
$_REQUEST = [];

$month_start_date = getdate(strtotime("{$year}-{$month}-1"));
$month_start_wday = $month_start_date['wday'];

$day_count = days_in_month($month, $year);

$next_month = (($month + 1) - 1) % 12 + 1;
$prev_month = (($month + 11) - 1) % 12 + 1;
$next_month_year = $year + ($month === 12 ? 1 : 0);
$prev_month_year = $year + ($month === 1 ? -1 : 0);

$month_names = [
  'Jan',
  'Feb',
  'Mar',
  'Apr',
  'May',
  'Jun',
  'Jul',
  'Aug',
  'Sep',
  'Oct',
  'Nov',
  'Dec',
];
$month_name = $month_names[$month - 1];
$prev_month_name = $month_names[$prev_month - 1];
$next_month_name = $month_names[$next_month - 1];

$wday_names = [
  'sun',
  'mon',
  'tue',
  'wed',
  'thu',
  'fri',
  'sat',
];

function is_weekend($date) {
  global $month_start_wday;
  $wday = ($date + $month_start_wday) % 7;
  return $wday === 0 || $wday === 1;
}

function is_past($date) {
  global $cur_date, $year, $month;
  $cur_year = $cur_date['year'];
  $cur_month = $cur_date['mon'];
  return $year < $cur_year || ($year === $cur_year && $month < $cur_month || $month === $cur_month && $date < $cur_date['mday']);
}

function is_today($date) {
  global $cur_date, $year, $month;
  return $year === $cur_date['year'] && $month === $cur_date['mon'] && $date === $cur_date['mday'];
}

function days_in_month($month, $year) {
  return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
}

function intval2($str) {
  $val = intval($str);
  return $val === 0 ? null : $val;
}
?>

<div id="month" class="month">
  <div class="month-control">
    <h2 class="current-month"><?= $month_name ?> <?= $year ?></h2>
    <a
      target="htmz"
      href="month.php?month=<?= $prev_month ?>&year=<?= $prev_month_year?>#month"
    >
      ← <?= $prev_month_name ?>
    </a>
    <a
      target="htmz"
      href="month.php?month=<?= $next_month ?>&year=<?= $next_month_year?>#month"
    >
      <?= $next_month_name ?> →
    </a>
  </div>

  <ol class="month-grid">
    <?php foreach ($wday_names as $wday_name): ?>
      <li class="wday-name"><?= $wday_name ?></li>
    <?php endforeach ?>

    <?php if ($month_start_wday > 0): ?>
      <div style="grid-column:<?= $month_start_wday ?>/<?= $month_start_wday ?>"></div>
    <?php endif ?>

    <?php for ($i = 1; $i <= $day_count; $i++): ?>
      <li class="day <?= is_weekend($i)?'day-weekend':'' ?> <?= is_today($i)?'day-today':'' ?> <?= is_past($i)?'day-past':'' ?>">
        <?php
        $_REQUEST['date_str'] = "{$year}-{$month}-{$i}";
        include('date.php');
        ?>
      </li>
    <?php endfor ?>
  </ol>
</div>