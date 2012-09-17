<?php
require_once "load.php";
$GLOBALS['pagination_show'] = true;
?>
<?php get_header("Mas vistas" . " - " . $GLOBALS['page_title']); ?>

<div id="area-content">
  <div class="box">
    <?php load_last_most_view_pictures($GLOBALS['page_vertical_count_p']); ?>
    
    
    <div align="center" style="margin-top:10px;margin-bottom:5px;">
    <?php if(($GLOBALS['pagination_page'] - 1) > 0): ?>
    <a href='<?php echo $GLOBALS['page_domain']; ?>mostview.html?p=<?php echo ($GLOBALS['pagination_page']-1); ?>'>« Anterior</a>
    <?php endif; ?>
    
    
    <?php for ($i=1; $i<=$GLOBALS['pagination_total_pages']; $i++): ?>
    <?php if( $GLOBALS['pagination_page'] == $i ): ?>
    <strong><?php echo $i; ?></strong>
    <?php else: ?>
    <a href='<?php echo $GLOBALS['page_domain']; ?>mostview.html?p=<?php echo $i; ?>'><?php echo $i; ?></a>
    <?php endif; ?>
    <?php endfor; ?> 		
    
    <?php if(($GLOBALS['pagination_page'] + 1)<=$GLOBALS['pagination_total_pages']): ?>
    <a href='<?php echo $GLOBALS['page_domain']; ?>recents.html?p=<?php echo ($GLOBALS['pagination_page']+1); ?>'>Siguiente »</a>
    <?php endif; ?>				
	</div>
  </div>
</div>
<?php get_footer(); ?>
