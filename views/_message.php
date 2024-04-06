<?php if (isset($_SESSION["message"])) : ?>

<?php
  if ($_SESSION["type"] == "success") {
    $class = "alert--success";
  }

  if ($_SESSION["type"] == "error") {
    $class = "alert--error";
  }
  ?>

<div class="alert <?php echo $class; ?>">
  <?php echo $_SESSION["message"]; ?>
</div>

<?php unset($_SESSION["message"]); ?>

<?php endif; ?>