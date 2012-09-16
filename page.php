<?php
require_once "load.php";
$picture_id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
if( !is_null( $picture_id ) ){
	
	}
$data = get_picture_by_id( $picture_id );
$GLOBALS['og_title']		=	$data->picture_text . " - " . $GLOBALS['page_title'];
$GLOBALS['og_url']			=	parse_picture_link( $data->picture_id, $data->picture_text );
$GLOBALS['og_image']		=	parse_picture_url( $data->picture_hash, false );
$GLOBALS['og_description']	=$data->picture_text;
?>
<?php get_header( $GLOBALS['og_title'] ); ?>
<div id="area-head"> <img src="<?php echo parse_picture_url( $data->picture_hash, false ); ?>" width="415" height="375" /> </div>
<div id="area-content">
  <div class="box">
    <?php load_last_pictures(); ?>
  </div>
</div>
<?php get_footer(); ?>
