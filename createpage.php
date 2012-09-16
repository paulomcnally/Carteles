<?php
require_once "load.php";

$text = (isset($_POST['text'])) ? $_POST['text'] : NULL;
$bordercolor = (isset($_POST['bordercolor'])) ? $_POST['bordercolor'] : NULL;
$fontcolor = (isset($_POST['fontcolor'])) ? $_POST['fontcolor'] : NULL;

if( !is_null( $text ) && !is_null( $bordercolor ) && !is_null( $fontcolor ) ){
	$image = new Text2Image();
	$image->setImageOutputName();
	
	$picture_id = insert_picture($image->getImageOutputName(), $text, $bordercolor, $fontcolor);
	header("Location: " . parse_picture_link( $picture_id, $text ) );
	die();
	}

header("Location: " . $GLOBALS['page_domain']);
die();

?>