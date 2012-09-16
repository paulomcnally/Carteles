<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:title" content="<?php echo $GLOBALS['og_title']; ?>" />
<meta property="og:type" content="<?php echo $GLOBALS['og_type']; ?>" />
<meta property="og:url" content="<?php echo $GLOBALS['og_url']; ?>" />
<meta property="og:description" content="<?php echo $GLOBALS['og_description']; ?>" />
<meta property="og:image" content="<?php echo $GLOBALS['og_image']; ?>" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="415" />
<meta property="og:image:height" content="375" />
<title><?php echo $GLOBALS['page_title']; ?></title>
<link type="text/css" href="<?php echo $GLOBALS['page_domain']; ?>theme/style.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $GLOBALS['page_domain']; ?>theme/jquery.miniColors.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['page_domain']; ?>theme/jquery.miniColors.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['page_domain']; ?>theme/jquery.tools.min.js"></script>
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() {
$("#bordercolor,#fontcolor").miniColors();
$("a[title]").tooltip();
});
function nameempty()
{		
        
		var re = /\s/g; //Match any white space including space, tab, form-feed, etc.
		var str = document.formNew.text.value.replace(re, "");
		if ( str.length < 2 || str == 'Escribetucartelaqui.')
        {
			return false;
		}
		return true;
}
function submitF()
{
	if (nameempty() == false){
		return false;	
	}else{
		document.forms['formNew'].action = "<?php echo $GLOBALS['page_domain']; ?>createpage.php";
		document.forms['formNew'].method = "POST";
		document.forms['formNew'].submit();
	}
	return true;
}
</script>
</head>

<body>
<div id="bar">
  <div class="centered">
    <div id="head">
      <div id="tools-left">
        <h1 id="logo"><a href="<?php echo $GLOBALS['page_domain']; ?>"><?php echo $GLOBALS['page_name']; ?></a></h1>
        <div id="lang-act"> </div>
        <div id="logo-like">
          <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://www.facebook.com/plugins/like.php?href=<?php echo $GLOBALS['page_facebook']; ?>&amp;layout=button_count&amp;show_faces=false&amp;width=135&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:135px; height:21px;"> </iframe>
        </div>
      </div>
      <div id="tools">
      	<a href="<?php echo $GLOBALS['page_domain']; ?>" style="margin-left:15px;">Inicio</a>
        <a href="<?php echo $GLOBALS['page_domain']; ?>recents.html" style="margin-left:15px;">Recientes</a>
		<a href="<?php echo $GLOBALS['page_domain']; ?>mostview.html" style="margin-left:15px;">Más vistas</a>
        <div class="floatR"> </div>
        <div id="lang-no"> </div>
      </div>
    </div>
  </div>
</div>
<div class="centered">
<div id="content">
<div id="column-left">
  <div id="newquote">
    <form id="formNew" name="formNew" action="<?php echo $GLOBALS['page_domain']; ?>createpage.php" method="post" accept-charset="iso-8859-1" onsubmit="return nameempty();">
      <div id="new-left">
        <div class="r"> Color marco:
          <input type="hidden" id="bordercolor" name="bordercolor" class="color-picker miniColors" size="6" value="<?php echo $GLOBALS['default_border_color']; ?>" maxlength="7" autocomplete="off">
        </div>
        <div  class="r"> Color letra:
          <input type="hidden" id="fontcolor" name="fontcolor" class="color-picker miniColors" size="6" value="<?php echo $GLOBALS['default_font_color']; ?>" maxlength="7" autocomplete="off">
        </div>
      </div>
      <div id="new-right">
        <textarea id="textareaNew" name="text" rows="4" onfocus="if(this.value==&quot;Escribe tu cartel aqui.&quot;)this.value=&quot;&quot;" onblur="if(this.value==&quot;&quot;)this.value=&quot;Escribe tu cartel aqui.&quot;" onmouseover="this.focus()" maxlength="130"></textarea>
        <input id="buttonNew" value="Crear cartel" onclick="submitF();" type="submit">
      </div>
    </form>
  </div>
</div>
<div id="column-content">
