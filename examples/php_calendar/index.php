<?php
require_once 'util/props.php';
?>

<base target="htmz">
<link rel="stylesheet" href="style.css">

<h1>my calendar</h1>

<p>This calendar is the most complex example.</p>

<p>Because switching months would replace the current month’s HTML with the new month’s HTML, there was a need to store application state beyond the confines of HTML. Thus, application data is persisted in cookies.</p>

<p>This application was implemented using a componentized approach. See <code>util/props.php</code> for the API.</p>

<?php
$cur_date = getdate();

render('month.php', [
  'year' => $cur_date['year'],
  'month' => $cur_date['mon'],
]);

include '../../htmz.html';