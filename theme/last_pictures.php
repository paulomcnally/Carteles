<?php
$GLOBALS['pagination_start']		=	( $GLOBALS['pagination_page'] == 1 ) ? 0 : ($GLOBALS['pagination_page'] - 1) * $GLOBALS['pagination_rows'];
$GLOBALS['pagination_total_pages']	=	ceil(get_total_rows() / $GLOBALS['pagination_rows']); 
$last_pictures = get_last_pictures($GLOBALS['pagination_start'], $GLOBALS['pagination_rows']);
?>
<div class="box-header">
	<?php if( $GLOBALS['pagination_show'] ): ?>
	<span class="floatR">
    <?php if(($GLOBALS['pagination_page'] - 1) > 0): ?>
    <a href='<?php echo $GLOBALS['page_domain']; ?>recents.html?p=<?php echo ($GLOBALS['pagination_page']-1); ?>'>« Anterior</a>
    <?php endif; ?>
    
	Página <?php echo $GLOBALS['pagination_page']; ?>
    
	<?php if(($GLOBALS['pagination_page'] + 1)<=$GLOBALS['pagination_total_pages']): ?>
    <a href='<?php echo $GLOBALS['page_domain']; ?>recents.html?p=<?php echo ($GLOBALS['pagination_page']+1); ?>'>Siguiente »</a>
    <?php endif; ?>
	</span>
    <?php endif; ?>
  <h2>Recientes</h2>
</div>
<?php if( count( $last_pictures ) > 0 ): ?>
<?php foreach( $last_pictures as $key=>$picture ): ?>
<?php if( $key == 0 || $key == $GLOBALS['page_horizontal_count'] ): ?>
<div class="block">
  <?php endif; ?>
  <div class="item"> <a class="preview" title="<?php echo _parse_text($picture->picture_text); ?>" href="<?php echo parse_picture_link( $picture->picture_id, $picture->picture_text ); ?>"> <img alt="<?php echo _parse_text($picture->picture_text); ?>" src="<?php echo parse_picture_url( $picture->picture_hash, true ); ?>" width="130" height="117" style="margin:6px;" /> </a> <br>
    <a class="btn btn-fb" style="margin-left:10px;margin-bottom:5px;" href="http://www.facebook.com/sharer.php?u=<?php echo parse_picture_link( $picture->picture_id, $picture->picture_text ); ?>" target="_blank" onclick="window.open(this.href,this.target, 'width=600, height=340'); return false;">Compartir</a> </div>
  <?php if( $key == $GLOBALS['page_horizontal_count'] + -1 ): ?>
</div>
<div class="clear"></div>
<?php endif; ?>
<?php endforeach; ?>
</div>
<div class="clear"></div>
<div class="clear"></div>

<?php if( !$GLOBALS['pagination_show'] ): ?>
    <div class="viewMore" onclick="location.href='<?php echo $GLOBALS['page_domain']; ?>recents.html'">Ver más</div>
    <?php endif; ?>
<?php endif; ?>
