<?php
/**
 * Generate Slideshow .
 *
 * @ [slidegallery width=100 height=100 link=(lightbox,direct,none)]
 */
function mSlideGallery($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '1',
		"lightbox" => 'false',
		"crop" => 'true',
		"height" => '434',
		"width" => '620',
		"resize" => true,
		"title" => 'false'
	), $atts));
	$withplus=$width+20;
	$resize_image=false;
	if ($resize=="true") { $resize_image=true; }
	$quality=72;
	$link_end="";
	$lightbox_link="";
	$crop_image= " ,imageCrop: true";
	if ($lightbox == "true" ) { $lightbox_link = " ,lightbox: true"; }
	$rootpath= get_stylesheet_directory_uri();
	$images =& get_children( array( 
						'post_parent' => get_the_id(),
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order' )
						);
	
	if ( $images ) 
	{
	$output = '<div class="clear"></div>';
		$output .= '<div id="galleria">';
			foreach ( $images as $id => $image ) {
			$attatchmentID = $image->ID; 
			$imagearray = wp_get_attachment_image_src( $attatchmentID , 'full', false);
			$imageURI = $imagearray[0];
			$imageID = get_post($attatchmentID);
			$imageTitle = $imageID->post_title;
			$imageCaption = $imageID->post_excerpt;
			if ($title=="false") { $imageTitle=""; }
			//$output .= '<a href="' . $imageURI . '" title="'. $imageTitle .'">';
					$output .= mtheme_display_post_image (
						$ID=get_the_id(),
						$imageURI,
						$linked,
						$type="blog-post",
						$post->post_title,
						$class=""
						);
			//$output .='</a>';
			}
		$output .='</div>';
	$output .='<div class="clear"></div>';
    $output .= '<script>';
	$output .= 'var mtheme_galleria_uri="' . $rootpath . '/js/galleria/"; ';
    $output .= "Galleria.loadTheme(mtheme_galleria_uri+'galleria.classic.js'); ";
    $output .= "jQuery('#galleria').galleria({ autoplay: 5000 , transitionSpeed: 600, thumbCrop: true,transition: 'fadeslide', showCounter: false, imageCrop: true, width: ".$width.", height: ". $height . $crop_image . $lightbox_link ." }); ";
    $output .= '</script>';
	return $output;
	}	
}
add_shortcode("galleria", "mSlideGallery");



function mNivoSlides($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '1',
		"lightbox" => 'false',
		"crop" => 'true',
		"height" => '434',
		"width" => '620',
		"resize" => true,
		"title" => 'false'
	), $atts));
	$withplus=$width+20;
	$resize_image=false;
	if ($resize=="true") { $resize_image=true; }
	$quality=THEME_IMAGE_QUALITY;
	$link_end="";
	$lightbox_link="";
	
	$cssheight= $height . "px";
	$csswidth= $width . "px";
	
	if ($height==0) { $cssheight="50px"; }
	
	$crop_image= " ,imageCrop: true";
	if ($lightbox == "true" ) { $lightbox_link = " ,lightbox: true"; }
	$rootpath= get_stylesheet_directory_uri();
	$images =& get_children( array( 
						'post_parent' => get_the_id(),
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order' )
						);
	
	if ( $images ) 
	{
	
	$nivoID = "sliderID" . dechex(time()).dechex(mt_rand(1,65535));
	
$mtheme_path=MTHEME_PATH;
$output = <<<HTML
<script type='text/javascript'>
/*<![CDATA[*/
    jQuery(window).load(function() {
        jQuery('#{$nivoID}').nivoSlider({
        effect:'fold', // Specify sets like: 'fold,fade,sliceDown'
        slices:10, // For slice animations
        boxCols: 10, // For box animations
        boxRows: 10, // For box animations
        animSpeed:500, // Slide transition speed
        pauseTime:6000, // How long each slide will show
		keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
		});
    });

/*]]>*/
</script>

<div class="clear"></div>
<div class="slider-wrapper theme-default">
<div id="{$nivoID}" class="nivoSlider">
HTML;
			foreach ( $images as $id => $image ) {
			$attatchmentID = $image->ID; 
			$imagearray = wp_get_attachment_image_src( $attatchmentID , 'full', false);
			$imageURI = $imagearray[0];
			$imageID = get_post($attatchmentID);
			$imageTitle = $imageID->post_title;
			$imageCaption = $imageID->post_excerpt;
			if ($title=="false") { $imageTitle=""; }
			//$output .= '<a href="' . $imageURI . '" title="'. $imageTitle .'">';

				$output .= mtheme_display_post_image (
				$ID=get_the_id(),
				$imageURI,
				$linked,
				$type="blog-post",
				$post->post_title,
				$class=""
				);
			//$output .='</a>';
			}
$output .= <<<HTML
</div>
</div>
<div class="clear"></div>
HTML;
	return $output;
	}	
}
add_shortcode("nivoslides", "mNivoSlides");
?>