<?php
$fetch_dest = $_SERVER['HTTP_SEC_FETCH_DEST'];
$document_dest = $fetch_dest === 'document';

if ($document_dest) include 'prelude.php';
?>

<div id="content">
  <strong>This is the content.</strong>
</div>

<?php
if ($document_dest) include 'footer.php';
?>