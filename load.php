<?php
@session_start();
setlocale(LC_ALL, 'en_US.UTF8');
$base = dirname(__FILE__) . DIRECTORY_SEPARATOR;

$f_core = $base . "core" . DIRECTORY_SEPARATOR;
$f_theme = $base . "theme" . DIRECTORY_SEPARATOR;

$page_name				=	"Carteles";
$page_title				=	"Sitio";
$page_domain			=	"http://5.39.95.237/demo/";
$page_facebook			=	"https://www.facebook.com/mcnallydevelopers";
$page_horizontal_count	=	5;
$page_vertical_count	=	5;

$default_border_color	=	"#7c8ab8";
$default_font_color		=	"#2d3035";

$dbhost					=	"cartelessociales.db.6864390.hostedresource.com";
$dbuser					=	"cartelessociales";
$dbpassword				=	"Pd__5588asd";
$dbname					=	"cartelessociales";

$og_title				=	$page_title;
$og_type				=	"website";
$og_url					=	$page_domain;
$og_description			=	"Carteles Facebook";
$og_image				=	$page_domain . "default.jpg";


$ips					=	"jknasdasd";

require_once $f_core . "JSONResponse.php";
require_once $f_core . "Database.php";
require_once $f_core . "Text2image.php";
require_once $f_core . "functions.php";

$mysql = new Database($dbhost, $dbuser, $dbpassword, $dbname);
?>