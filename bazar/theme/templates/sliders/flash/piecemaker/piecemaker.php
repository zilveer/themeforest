<?php 
require_once( dirname(__FILE__) . '/../../../../../core/safe-wp-load.php' ); 
require_once( dirname(__FILE__) . '/mimetype.php' );  

function get_flash_configuration( $settings )
{
	$fields = array();
	foreach( $settings as $setting => $val )
	{         
		$var = yit_slide_get( $setting );
		$var = str_replace( '#', '0x', $var );
		                                
		if( $var ) 
			$fields[] = "$setting=\"$var\"";
		else
			$fields[] = "$setting=\"$val\"";
	}
	
	return $fields;
}

yit_set_slider_loop( $_GET['slider_name'] );

header ("Content-Type:text/xml"); ?> 
<Piecemaker>
  <Contents>
<?php
		
	while( yit_have_slide() ) :
		                                                  
		$image_id = yit_slide_get('image_id');      
		$image_url = yit_slide_get('image-url');     
		$image_title = strip_tags( yit_slide_get('title') ); 
		$content = stripslashes( yit_slide_get('content') );
		
		$content = str_replace( "\n", '', $content );
		$title = yit_string( '<h1>', $image_title, '</h1>', false );
		//$the_image_ = wp_get_attachment_metadata( $image_id );
		
		//$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mime_type = $mimetype->getType( $image_url );
		//finfo_close($finfo);
		
		$link_url = yit_slide_get('slide-link-url');
		
		if( preg_match( '/image\/(.*)/', $mime_type ) )
		{ 
		    echo "    <Image Source=\"$image_url\" Title=\"$image_title\">";
		    yit_string( "\n" . '      <Text>' . $title, $content, '</Text>' . "\n    " );
		    if( ! empty( $link_url ) ) echo "  <Hyperlink URL=\"$link_url\"" . ( strpos( $link_url, YIT_SITE_URL ) === false ? ' Target="_blank"' : '' ) . " />\n    ";
		    echo "</Image>\n";
	    } 
		
		if( $mime_type == 'application/x-shockwave-flash' )
		{
		   	echo "    <Flash Source=\"$image_url\" Title=\"$image_title\">
  <Image Source=\"".yit_get_slider_url()."/piecemaker/contents/flash-preview.png\" />  
</Flash>\n";
	    }                        
		
		if( preg_match( '/video\/(.*)/', $mime_type ) )
		{
		    //echo "  <Video Source=\"$image_url\" Title=\"$image_title\" Width=\"$the_image_[width]\" Height=\"$the_image_[height]\" Autoplay=\"true\">
		    echo "  <Video Source=\"$image_url\" Title=\"$image_title\" Autoplay=\"true\">
<Image Source=\"".yit_get_slider_url()."/piecemaker/contents/video-preview.jpg\" />  
</Video>\n";
	    } 
	    
	endwhile;
  	echo "  </Contents>\n";
  
  	// array with default values
  	$settings = array(        
		'ImageWidth' => yit_slide_get('width'),
		'ImageHeight' => yit_slide_get('height'),
		'LoaderColor' => "0x333333",
		'InnerSideColor' => "0x222222",
		'SideShadowAlpha' => 0.8,
		'DropShadowAlpha' => 0.7,
		'DropShadowDistance' => 25,
		'DropShadowScale' => 0.95, 
		'DropShadowBlurX' => 40,
		'DropShadowBlurY' => 4,
		'MenuDistanceX' => 20,
		'MenuDistanceY' => 50,
		'MenuColor1' => "0x999999",
		'MenuColor2' => "0x333333",
		'MenuColor3' => "0xFFFFFF",
		'ControlSize' => 100,
		'ControlDistance' => 20,
		'ControlColor1' => "0x222222",
		'ControlColor2' => "0xFFFFFF",
		'ControlAlpha' => 0.8,
		'ControlAlphaOver' => 0.95,
		'ControlsX' => 450,
		'ControlsY' => 280,
		'ControlsAlign' => "center",
		'TooltipHeight' => 30,
		'TooltipColor' => "0x222222",
		'TooltipTextY' => 5,             
		'TooltipTextStyle' => 'P-Italic',   
		'TooltipTextColor' => "0xFFFFFF", 
		'TooltipMarginLeft' => 5,  
		'TooltipMarginRight' => 7,  
		'TooltipTextSharpness' => 50,
		'TooltipTextThickness' => -100,  
		'InfoWidth' => 400,
		'InfoBackground' => "0xFFFFFF",
		'InfoBackgroundAlpha' => 0.95,
		'InfoMargin' => 400,
		'InfoSharpness' => 0,
		'InfoThickness' => 0,
		'Autoplay' => 10,
		'FieldOfView' => 45
	);
	
	$fields = get_flash_configuration( $settings );
	
	yit_string( '  <Settings ', implode( ' ', $fields ), '></Settings>' );
	
	$transitions = array(
		'Pieces' => 9,
		'Time' => 1.2,
		'Transition' => 'easeInOutBack',
		'Delay' => 0.1,
		'DepthOffset' => 300,
		'CubeDistance' => 30
	);                  
	
	$fields = get_flash_configuration( $transitions );
             
  echo "\n  <Transitions>\n";
  echo "    <Transition " . implode( ' ', $fields ) . "></Transition>\n";
  echo "  </Transitions>\n";
echo "</Piecemaker>";
?>         