<?php
require_once "load.php";


$text = (isset($_GET['text'])) ? base64_decode($_GET['text']) : "404";
$bordercolor = (isset($_GET['bordercolor'])) ? base64_decode($_GET['bordercolor']) : $GLOBALS['default_border_color'];
$fontcolor = (isset($_GET['fontcolor'])) ? base64_decode($_GET['fontcolor']) : $GLOBALS['default_font_color'];


$image = new Text2Image();
$image->setOutputFile(false);
$image->setText( $text );
$image->setFontColor( $fontcolor );
$image->setFontSize(35);
$image->setFontFamily("impact.ttf");
$image->setImageBackground( true );
$image->setImageBackgroundColor("#FFFFFF");
$image->setImageBorder( true );
$image->setImageBorderColor( $bordercolor );
$image->setImageBorderSize(15);
$image->setDomain($GLOBALS['page_domain'],160);
$image->setImageThumbnails( false );
$image->makeImage();
?>