<?php
require_once "load.php";
$picture_id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
if( !is_null( $picture_id ) ){
	
	}
$data = get_picture_by_id( $picture_id );
$GLOBALS['og_title']		=	_parse_text( $data->picture_text . " - " . $GLOBALS['page_title'] );
$GLOBALS['og_url']			=	parse_picture_link( $data->picture_id, $data->picture_text );
$GLOBALS['og_image']		=	parse_picture_url( $data->picture_hash, false );
?>
<?php get_header( $GLOBALS['og_title'] ); ?>
<div id="area-head">
	<img src="<?php echo parse_picture_url( $data->picture_hash, false ); ?>" width="415" height="375" /> 
	<div id="article_social">
    <!-- Facebook Share -->
    <div class="twttrbar">
    <a class="btn btn-fb" style="margin-left:10px;margin-bottom:5px;" href="http://www.facebook.com/sharer.php?u=<?php echo parse_picture_link( $data->picture_id, $data->picture_text ); ?>" target="_blank" onclick="window.open(this.href,this.target, 'width=600, height=340'); return false;">Compartir</a>
    </div>
    <div class="twttrbar">
    <!-- Facebook -->
    <div class="fb-like" data-href="<?php echo parse_picture_link( $data->picture_id, $data->picture_text ); ?>" data-send="true" data-layout="button_count" data-width="200" data-show-faces="true"></div>
    </div>
    <!-- Twitter -->
    <div class="twttrbar">
   	<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo parse_picture_link( $data->picture_id, $data->picture_text ); ?>" data-lang="es">Twittear</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </div>
	<!-- Google Plus -->
    <div class="twttrbar">
	<g:plusone size="medium" href="http://mcnallydevelopers.com/carteles/1/youre-all-i-need.html"></g:plusone>
	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
	</div>
    <div id="reportC" style="margin-left:10px;"><span onclick="coments_show();" class="link" style="color:#FFA300;cursor:pointer;font-weight:bold;">Mostrar Comentarios</span></div>
    
    </div>
    
    
	<div id="box" style="display:none;">
    <div class="fb-comments" data-href="<?php echo parse_picture_link( $data->picture_id, $data->picture_text ); ?>" data-num-posts="50" data-width="730"></div>
    </div>

</div>


<div id="area-content">
  <div class="box">
    <?php load_last_pictures(); ?>
  </div>
</div>
<?php get_footer(); ?>
