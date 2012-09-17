<?php
/*
 * @author	Paulo McNaly
 *
 * Sources:	http://polyetilen.lt/en/text-wrap-for-imagettftext
 *			http://php.net/manual/en/function.imagettftext.php#75718
*/


class Text2Image{
	
	private $domain							=	"www.paulomcnally.com";
	
	private $domain_left					=	100;
	
	private $text							=	"404";
	
	private $text_maxlength					=	120;
	
	private $text_width						=	0;
	
	private $text_height					=	0;
	
	private $box							=	array();
	
	private $fonts_folder					=	"fonts/";
	
	private $font_size						=	23;
	
	private $font_color						=	"#ffffff";
	
	private $font_color_rgb					=	array();
	
	private $font_family					=	"ambient.ttf";
	
	private $file_name						=	"default.jpg";
	
	private $file_mime_type					=	"image/jpg";

	private $file_extension					=	".jpg";
	
	private $file_output					=	false;
	
	private $file_output_name				=	"new_file";
	
	private $x_finalpos						=	0;

	private $y_finalpos						=	0;
	
	private $file_s_end_buffer_size			=	4096;
	
	private $error_message					=	"";
	
	private $image_background				=	false;
	
	private $image_background_color 		=	"#FFFFFF";
	
	private $image_background_color_rgb 	=	array();
	
	private $image_border					=	false;
	
	private $image_border_size 				=	3;
	
	private $image_border_color				=	"#000000";
	
	private $image_border_color_rgb			=	array();
	
	private $image_width					=	NULL;
	
	private $image_height					=	NULL;
	
	private $image							=	NULL;
	
	private $image_output_name				=	"example.jpg";
	
	private $image_default_patch			=	"i/";
		
	private $image_default_width			=	415;
	
	private $image_default_height			=	375;
	
	private $image_thumbnails				=	true;
	
	private $image_thumbnails_patch			=	"t/";
	
	private $image_thumbnails_width			=	131;
	
	private $image_thumbnails_height		=	119;
	
	private $image_text_area_width			=	360;
	
	private $image_text_area_margin			=	0;
	
			
	public function __construct(){
		
		$this->setFontFamily( $this->font_family ); 
		
		if( !$this->check() ){
			$this->error_message = "ImageCreate function ir require in this server.";
			}
		
		$this->image =  imagecreatefromjpeg( $this->file_name );
		}
	
	public function setDomain( $string_name, $int_left ){
		$this->domain = $string_name;
		$this->domain_left = $int_left;
		}
	
	public function setOutputFile( $boolen ){
		$this->file_output = $boolen;
		}
	
	private function setOutputFileName( $string ){
		$this->file_output_name = $string;
		}
	
	private function check(){
		return function_exists('ImageCreate');
		}
	
	public function setImageBackground( $boolean ){
		$this->image_background = $boolean;
		}
	
	public function setImageBackgroundColor( $hex_color ){
		if( @preg_match( '/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $hex_color ) ){
			$this->image_background_color_rgb = $this->hex_to_rgb( $hex_color );
			$this->image_background_color = imagecolorallocate($this->image, $this->image_background_color_rgb['red'], $this->image_background_color_rgb['green'], $this->image_background_color_rgb['blue']);
			}
		}
	
	public function setImageBorder( $boolean ){
		$this->image_border = $boolean;
		}
	
	public function setImageBorderColor( $hex_color ){
		if( @preg_match( '/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $hex_color ) ){
			$this->image_border_color_rgb = $this->hex_to_rgb( $hex_color );
			$this->image_border_color = imagecolorallocate($this->image, $this->image_border_color_rgb['red'], $this->image_border_color_rgb['green'], $this->image_border_color_rgb['blue']);
			}
		
		}
	
	public function setImageBorderSize( $int ){
		if( @preg_match( '/^\d{1,3}$/', $int ) ){
			$this->image_border_size = $int;
			}
		
		}
	
	public function setImageThumbnails( $boolean ){
		if( is_bool( $boolean ) ){
			$this->image_thumbnails = $boolean;
			}
		}

	/**
	 * set font size
	 * @example:	23
	 * @limit:		0 to 999
	 */
	public function setFontSize( $int ){
		if( @preg_match( '/^\d{1,3}$/', $int ) ){
			$this->font_size = $int;
			}
		}


	/**
	 * set font color
	 * @example:	#FFFFFF
	 */
	public function setFontColor( $hex_color ){
		if( @preg_match( '/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $hex_color ) ){
			$this->font_color_rgb = $this->hex_to_rgb( $hex_color );
			$this->font_color = @imagecolorallocate($this->image,$this->font_color_rgb['red'],$this->font_color_rgb['green'],$this->font_color_rgb['blue']);
			}
		
		}

	
	/**
	 * set font family
	 * @example:	ambient.ttf
	 */
	public function setFontFamily( $font_family ){
		if( @preg_match( '/^\w{1,}.ttf$/', $font_family ) ){
			if(is_readable( $this->fonts_folder . $font_family )){
				$this->font_family = $this->fonts_folder . $font_family;
				}
				else{
					die("Error");
					}
			}
		}


	/**
	 * set text
	 * @example:	Hello world
	 */
	public function setText( $text ){
		if( !empty( $text ) ){
			$this->text = substr(stripslashes(html_entity_decode($text)),0,$this->text_maxlength);
			}
		}
	
	
	/**
	 * set image sizes
	 */
	private function calculeImageSizes(){
		$this->image_width = @imagesx($this->image);
		$this->image_height = @imagesy($this->image);
		}


	/**
	 * make image file
	 * @example:	output.jpg
	 */
	public function makeImage( ){
		
		$this->calculeImageSizes();
		
		$this->imageText();
		
		$this->imageDomain();

		if( $this->image_background ){
			$this->imageBackground( );
			}
		
		if( $this->image_border ){
			$this->imageBorder( );
			}
		
		if( $this->image_thumbnails ){
			$this->imageThumbnails();
			}
			else{
				$this->imageDefault();
				}
		imagedestroy($this->image);
		}
	
	
	/**
	 * Conver hex color to rgb
	 */
	private function hex_to_rgb($hex) {
		// remove '#'
		if(substr($hex,0,1) == '#'){
			$hex = substr($hex,1) ;
			}
			
		// expand short form ('fff') color to long form ('ffffff')
		if(strlen($hex) == 3) {
			$hex = substr($hex,0,1) . substr($hex,0,1) .
				   substr($hex,1,1) . substr($hex,1,1) .
				   substr($hex,2,1) . substr($hex,2,1) ;
		}

		// convert from hexidecimal number systems
		$rgb['red'] = hexdec(substr($hex,0,2)) ;
		$rgb['green'] = hexdec(substr($hex,2,2)) ;
		$rgb['blue'] = hexdec(substr($hex,4,2)) ;
		return $rgb ;
		}
	
	private function imageBackground( ){
		@imagefill($this->image, 0, 0, $this->image_background_color);
		}
	
	private function imageBorder( ) { 
   		$x1 = 0; 
    	$y1 = 0; 
    	$x2 = imagesx($this->image) - 1; 
    	$y2 = imagesy($this->image) - 1;
    	for($i = 0; $i < $this->image_border_size ; $i++) { 
    	    @imagerectangle($this->image, $x1++, $y1++, $x2--, $y2--, $this->image_border_color); 
    		} 
		}
	
	private function imageDomain(){
		$this->setFontFamily("arial.ttf");
		imagettftext($this->image, 10, 0, $this->domain_left, 350, $this->font_color, $this->font_family,$this->domain);
		}
	
	private function imageText(  ){
		$lines=explode("\n",$this->textParse());
		for($i=0; $i< count($lines); $i++){
			$calcule = ( count($lines) == 1 ) ? 2 : count($lines);
			$this->box = imagettfbbox($this->font_size, 0, $this->font_family, $lines[$i]);
			$this->text_width		=	abs($this->box[2]-$this->box[0]);
			$this->text_height		=	abs($this->box[3]-$this->box[1]);
			$x = ($this->image_width/2) - ($this->text_width/2);
			$y = ($this->image_height/$calcule) - ($this->text_height);
			$newY=$y+($i * $this->font_size * 1.2) + 10;
			imagettftext($this->image, $this->font_size, 0, $x, $newY, $this->font_color, $this->font_family, $lines[$i]);
    		}
		}
	
	private function imageThumbnails(){
		$tmp_img = imagecreatetruecolor( $this->image_thumbnails_width, $this->image_thumbnails_height );
		// copy and resize old image into new image 
		imagecopyresized( $tmp_img, $this->image, 0, 0, 0, 0, $this->image_thumbnails_width, $this->image_thumbnails_height, $this->image_default_width, $this->image_default_height );
		// save thumbnail into a file
		if( $this->file_output ){
			@imagejpeg($tmp_img, $this->image_thumbnails_patch . $this->image_output_name);
			}
			else{
				header('Content-type: ' . $this->file_mime_type);
				@imagejpeg($tmp_img);
				}
		
		imagedestroy($tmp_img);
		}
	
	private function imageDefault(){
		if( $this->file_output ){
			@imagejpeg($this->image,$this->image_default_patch . $this->image_output_name);
			}
			else{
				header('Content-type: ' . $this->file_mime_type);
				@imagejpeg($this->image);
				}
		}
	
	public function setImageOutputName(){
		$this->image_output_name = md5(microtime() . rand()) . ".jpg";
		}
	
	public function getImageOutputName(){
		return $this->image_output_name;
		}
	
	private function textParse(){
		$text_a = explode(' ', $this->text);
		$text_new = '';
		$newText = "";
		foreach($text_a as $word){
    		$box = imagettfbbox($this->font_size, 0, $this->font_family, $newText.' '.$word);
    		if($box[2] > $this->image_text_area_width + $this->image_text_area_margin ){
				if( empty( $newText ) ){
					$newText .= "\n" ;
					}
					else{
						$newText .= "\n";
						}
				$text_new .= $newText;
				$newText = "";
				$newText .= $word;
    		} else {
        		$newText .= " ".$word;
    		}
		}
		$text_new .= $newText;
		$text_new = trim($text_new);
		return $text_new;
		}
	} 
?>