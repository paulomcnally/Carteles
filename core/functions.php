<?php
function _parse_text( $text ){
	return stripslashes(html_entity_decode(utf8_encode($text)));
	}

function get_header( $title = NULL ){
	$GLOBALS['page_title'] = _parse_text($title);
	$patch = $GLOBALS['f_theme'] . "header.php";
	if( file_exists( $patch ) ){
		require_once $patch;
		}
	}

function get_footer(  ){
	$patch = $GLOBALS['f_theme'] . "footer.php";
	if( file_exists( $patch ) ){
		require_once $patch;
		}
	}

function load_last_pictures( $limit = NULL ){
	if( !is_null( $limit ) ){
		$GLOBALS['pagination_rows'] = $limit;
		}
	$patch = $GLOBALS['f_theme'] . "last_pictures.php";
	if( file_exists( $patch ) ){
		require_once $patch;
		}
	}

function load_last_most_view_pictures( $limit = NULL ){
	if( !is_null( $limit ) ){
		$GLOBALS['pagination_rows'] = $limit;
		}
	$patch = $GLOBALS['f_theme'] . "last_most_view_pictures.php";
	if( file_exists( $patch ) ){
		require_once $patch;
		}
	}

function get_now(){
	return date("Y-m-d H:i:s");
	}

function insert_picture( $picture_hash, $picture_text, $picture_border_color, $picture_font_color ){
	$GLOBALS['mysql']->insert("pictures",array("picture_hash"=>$picture_hash, "picture_registered"=>get_now(), "picture_text"=>$picture_text,"picture_border_color"=>$picture_border_color,"picture_font_color"=>$picture_font_color),array('%s','%s','%s','%s','%s'));
	$picture_id = $GLOBALS['mysql']->getInsertId();
	insert_tag($picture_id, $picture_text);
	return $picture_id;
	}

function insert_tag( $picture_id, $picture_text ){
	
	$words = explode( " ", $picture_text );
	$query = "INSERT INTO tags(tag_name, picture_id) VALUES";
	$values = array();
	foreach( $words as $word ){
		array_push( $values, "('".$GLOBALS['mysql']->html($word)."','".$picture_id."')" );
		}
	$query .= implode( ",", $values );
	$GLOBALS['mysql']->query( $query );
	}

function get_picture_by_hash( $hash = NULL ){
	$obj = new stdClass();
	$obj->picture_id				=	0;
	$obj->picture_text				=	"404";
	$obj->picture_border_color		=	$GLOBALS['default_border_color'];
	$obj->picture_font_color		=	$GLOBALS['default_font_color'];
	if( is_null( $hash ) ){
		return $obj;
		}
	
	if( $n = $GLOBALS['mysql']->query( "SELECT picture_id, picture_text, picture_border_color, picture_font_color FROM pictures WHERE picture_hash = '".$hash."'" ) ){
		return $GLOBALS['mysql']->last_result[0];
		}
		else{
			return $obj;
			}
	}
	
function update_visit( $picture_id ){
	if( !isset( $_SESSION[$GLOBALS['ips']] ) ){
		$_SESSION[$GLOBALS['ips']] = array();
		}
	
	if( !in_array( md5( getRealIpAddr() . $picture_id ), $_SESSION[$GLOBALS['ips']] ) ){
		$GLOBALS['mysql']->query("UPDATE pictures SET picture_views = picture_views + 1 WHERE picture_id = " . $picture_id);
		
		array_push($_SESSION[$GLOBALS['ips']], md5( getRealIpAddr() . $picture_id ) );
		}
	
	
	}

function get_picture_by_id( $id = NULL ){
	$obj = new stdClass();
	$obj->picture_id				=	0;
	$obj->picture_text				=	"404";
	$obj->picture_border_color		=	$GLOBALS['default_border_color'];
	$obj->picture_font_color		=	$GLOBALS['default_font_color'];
	$obj->picture_hash				=	"bd757f056b0455605d56f747fc089a5a";
	if( is_null( $id ) ){
		return $obj;
		}
		
	if( $n = $GLOBALS['mysql']->query( "SELECT picture_id, picture_text, picture_hash, picture_border_color, picture_font_color FROM pictures WHERE picture_id = '".$id."'" ) ){
		$data = $GLOBALS['mysql']->last_result[0];
		
		update_visit( $id );
		return $data;
		}
		else{
			return $obj;
			}
	}

function get_total_rows(){
	return $GLOBALS['mysql']->getVar("SELECT count(*) FROM pictures");
	}

function get_last_pictures( $start=0, $limit = 10 ){
	return $GLOBALS['mysql']->getResults("SELECT picture_id, picture_hash, picture_text, picture_border_color, picture_font_color FROM pictures ORDER BY picture_registered DESC LIMIT ".$start."," . $limit);
	}

function get_most_view_pictures( $start=0, $limit = 10 ){
	return $GLOBALS['mysql']->getResults("SELECT picture_id, picture_hash, picture_text, picture_border_color, picture_font_color, picture_views FROM pictures ORDER BY picture_views DESC LIMIT ".$start."," . $limit);
	}

function parse_picture_url($hash, $is_thumbnails = false){
	if( $is_thumbnails ){
		return $GLOBALS['page_domain'] . "t/" . $hash . ".jpg";
		}
		else{
			return $GLOBALS['page_domain'] . "i/" . $hash . ".jpg";
			}
	
	}

function parse_picture_link( $id, $text ){
	return $GLOBALS['page_domain'] . $id . "/" . makeSlugs($text) . ".html";
	}


function my_str_split($string)
   {
      $slen=strlen($string);
      for($i=0; $i<$slen; $i++)
      {
         $sArray[$i]=$string{$i};
      }
      return $sArray;
   }

   function noDiacritics($string)
   {
      //cyrylic transcription
      $cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
      $cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia'); 
 
      
      $from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
      $to   = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");
      
      
      $from = array_merge($from, $cyrylicFrom);
      $to   = array_merge($to, $cyrylicTo);
      
      $newstring=str_replace($from, $to, $string);   
      return $newstring;
   }

   function makeSlugs($string, $maxlen=0)
   {
      $newStringTab=array();
      $string=strtolower(noDiacritics($string));
      if(function_exists('str_split'))
      {
         $stringTab=str_split($string);
      }
      else
      {
         $stringTab=my_str_split($string);
      }

      $numbers=array("0","1","2","3","4","5","6","7","8","9","-");
      //$numbers=array("0","1","2","3","4","5","6","7","8","9");

      foreach($stringTab as $letter)
      {
         if(in_array($letter, range("a", "z")) || in_array($letter, $numbers))
         {
            $newStringTab[]=$letter;
            //print($letter);
         }
         elseif($letter==" ")
         {
            $newStringTab[]="-";
         }
      }

      if(count($newStringTab))
      {
         $newString=implode($newStringTab);
         if($maxlen>0)
         {
            $newString=substr($newString, 0, $maxlen);
         }
         
         $newString = removeDuplicates('--', '-', $newString);
      }
      else
      {
         $newString='';
      }      
      
      return $newString;
   }
   
   
   function checkSlug($sSlug)
   {
      if(ereg ("^[a-zA-Z0-9]+[a-zA-Z0-9\_\-]*$", $sSlug))
      {
         return true;
      }
      
      return false;
   }
   
   function removeDuplicates($sSearch, $sReplace, $sSubject)
   {
      $i=0;
      do{
      
         $sSubject=str_replace($sSearch, $sReplace, $sSubject);         
         $pos=strpos($sSubject, $sSearch);
         
         $i++;
         if($i>100)
         {
            die('removeDuplicates() loop error');
         }
         
      }while($pos!==false);
      
      return $sSubject;
   }
  
  function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>