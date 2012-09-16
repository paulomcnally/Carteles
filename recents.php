<?php
require_once "load.php";
?>
<?php get_header("Recientes" . " - " . $GLOBALS['page_title']); ?>

<div id="area-content">
  <div class="box">
    <?php load_last_pictures(100); ?>
  </div>
</div>
<?php get_footer(); ?>
