<?php
$pictures = get_most_view_pictures($GLOBALS['page_vertical_count']);
?>
<div class="box-header">
  <h2>Más vistas</h2>
</div>
<?php if( count( $pictures ) > 0 ): ?>
<?php foreach( $pictures as $key=>$picture ): ?>
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
<?php endif; ?>
