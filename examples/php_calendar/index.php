<?php
require_once 'util/props.php';
?>

<base target="htmz">
<link rel="stylesheet" href="style.css">

<h1>my calendar</h1>

<?php
$cur_date = getdate();

render('month.php', [
  'year' => $cur_date['year'],
  'month' => $cur_date['mon'],
]);

include '../../htmz.html';