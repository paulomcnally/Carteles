<?php
require_once "load.php";
$last_pictures = get_last_pictures();
?>
<?php get_header("Sitio web"); ?>

<div id="area-content">
  <div class="box">
    <?php load_last_pictures(); ?>
    <?php load_last_most_view_pictures(); ?>
  </div>
</div>
<?php get_footer(); ?>
