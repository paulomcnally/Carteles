<?php
require_once "load.php";
$hash = ( isset( $_GET['hash'] ) && @preg_match( '/^[0-9a-f]{32}$/i', $_GET['hash'] ) ) ? @$_GET['hash'] : NULL;
$is_thumbnails = ( isset( $_GET['t'] ) && @preg_match( '/[tT][rR][uU][eE]/', $_GET['t'] ) ) ? true : false;

$data = get_picture_by_hash( $hash );

$image = new Text2Image();
$image->setOutputFile(false);
$image->setText( $data->picture_text );
$image->setFontColor( $data->picture_font_color );
$image->setFontSize(35);
$image->setFontFamily("impact.ttf");
$image->setImageBackground( true );
$image->setImageBackgroundColor("#FFFFFF");
$image->setImageBorder( true );
$image->setImageBorderColor( $data->picture_border_color );
$image->setImageBorderSize(15);
$image->setDomain($GLOBALS['page_domain'],160);
$image->setImageThumbnails( $is_thumbnails );
$image->makeImage();
?>