<?php
@[
  'action' => $action,
  'class' => $class,
] = $_REQUEST;
?>

<span id="picker">
  <!-- self-updating HTML fragment -->
  <form
    action="picker.php#picker"
    method="post"
  >
    <!-- retain state by putting params back into params -->
    <input name="class" type="hidden" value="<?= $class ?>">

    <label>
      <strong><?= $class ?></strong>
      <button name="action" value="select">Select</button>
    </label>

    <!-- render dialog if open -->
    <?php if ($action === 'select'): ?>
      <dialog open>
        <div>Select a class</div>
        <button name="class" value="scout">Scout</button>
        <button name="class" value="soldier">Soldier</button>
        <button name="class" value="pyro">Pyro</button>
      </dialog>
    <?php endif ?>
  </form>
</span>