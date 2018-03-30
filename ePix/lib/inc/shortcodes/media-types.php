<?php

	/* ------------------------------------
	:: MEDIA TYPES
	------------------------------------*/
	
	function mediaembed_shortcode( $atts, $content = null, $code ) {
	   extract( shortcode_atts( array(
		  'type' => 'youtube',
		  'url' => '',
		  'imageurl' => '',	 
		  'width' => '',	 
		  'height' => '',
		  'align' => '',
		  'shadow' => '',
		  'ratio' => '',
		  'id' => '',
		  'autoplay' => '',	
		  'loop' => '',
		  'customlayer' => '',	  	 	  	  	 	  	   
		  ), $atts ) );
		
		if( $code == 'videoembed' )
		{
			$NV_mediatype='video';
		}
		elseif( $code == 'audioembed' )
		{
			$NV_mediatype='audio';
		} 
		
		$NV_previewimgurl='';
		
		$NV_customlayer = esc_attr($customlayer);
		$NV_imgheight = esc_attr($height);
		$NV_imgwidth = esc_attr($width);
		$NV_movieurl = esc_attr($url);
		$NV_videotype = esc_attr($type);
		$NV_videoautoplay = esc_attr($autoplay);
		$NV_previewimgurl = esc_attr($imageurl);
		$NV_loop = esc_attr($loop);
		
		
		if(!$NV_loop) $NV_loop="0";
		if($NV_loop=="yes") $NV_loop="1";
		
		$slide_id = esc_attr($id);
		
		if($NV_videotype=="jwplayer") {
			$NV_videotype="jwp";
		}
		
		if($NV_videotype=="flash") {
			$NV_videotype="swf";
		}
		
		
		if(esc_attr($shadow)=="yes") {
			$NV_videoshadow = "shadow";
		} elseif(esc_attr($shadow)=="frame") {
			$NV_videoframe = "frame"; 
		} else {
			$NV_videoshadow ='';
			$NV_videoframe='';
		}
		
		if($NV_videoautoplay) {
			$NV_videoautoplay = "1";
		} else {
			$NV_videoautoplay ="0";	
		}	
		
		ob_start(); 
	
		$styling=''; // add inline CSS
		if(esc_attr($height)) 	{ $styling='height:'.esc_attr($height).'px;';}
		if($styling) { $styling='style="'.$styling.'"'; } else { $styling=''; }	
	
		if($NV_imgwidth) {
			$NV_width_attr='max-width:'.$NV_imgwidth.'px';
		} else {
			$NV_width_attr='';
		}
		
		?>
	
		<div class="nv-skin mediawrap <?php echo esc_attr($align).' '.$NV_mediatype.' '.$NV_videoframe; ?>"  style="max-width:<?php echo $NV_imgwidth; ?>px">
		
			<div class="container videotype <?php echo $NV_videoshadow ?>">   
				<div class="gridimg-wrap" style="<?php echo $NV_width_attr; ?>">
					<?php
					$output = '';  
					include(NV_FILES .'/inc/classes/video-class.php'); 
					echo $output;
					?>
				</div><!-- / gridimg-wrap -->
			</div><!-- / container -->	
		</div><!-- / mediawrap -->
	<?php 
	
		$output_string=ob_get_contents();
		ob_end_clean();
	
		return $output_string;
	
	}

	/* ------------------------------------
	:: VIDEO MAP	  	
	------------------------------------*/

	if( get_option('themeva_theme') != 'ePix' && get_option('themeva_theme') != 'Copa' )
	{
		$shadow_effect = array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Shadow Effect", "js_composer"),
			"param_name" => "shadow",
			"value" =>  array(
			__('Enable', "js_composer") => "yes", 
			)
		);		
	}
	else
	{
		$shadow_effect = array(
			"type" => NULL,
			"param_name" => NULL,
			"value" => NULL
		);
	}


	wpb_map( array(
		"name"		=> __("Video Player", "js_composer"),
		"base"		=> "videoembed",
		"controls"	=> "edit_popup_delete",
		"class"		=> "",
		"icon"		=> "icon-video",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "dropdown",
				"heading" => __("Type", "js_composer"),
				"param_name" => "type",
				"value" => array(
					__('YouTube', "js_composer") => 'youtube', 
					__('Vimeo', "js_composer") => 'vimeo',
					__('Flash', "js_composer") => 'flash', 
					__('Wistia', "js_composer") => 'wistia', 
					__('JW Player', "js_composer") => 'jwplayer', 
				),
			),	
			array(
				"type" => "dropdown",
				"heading" => __("Media Ratio", "js_composer"),
				"param_name" => "ratio",
				"value" => array(
					__("16:9", "js_composer") => "sixteen_by_nine", 
					__("4:3", "js_composer") => "four_by_three"
				),
			),				
			array(
				"type" => "textfield",
				"heading" => __("Media URL", "js_composer"),
				"param_name" => "url",
				"value" => "",
				"description" => __("Enter URL of media.", "js_composer")
			),		
			array(
				"type" => "textfield",
				"heading" => __("Image URL", "js_composer"),
				"param_name" => "imageurl",
				"value" => "",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('jwplayer')),
				"description" => __("Enter URL if you wish to use a holding image ( Paused, Loading ).", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("ID", "js_composer"),
				"param_name" => "id",
				"value" => "video_0",
				"dependency" => Array('element' => 'type' /*, 'not_empty' => true*/, 'value' => array('jwplayer')),
				"description" => __("Enter a unique ID.", "js_composer")
			),			
			array(
				"type" => "textfield",
				"heading" => __("Media Width", "js_composer"),
				"param_name" => "width",
				"value" => "",
				"description" => __("Enter image width.", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("Media Height", "js_composer"),
				"param_name" => "height",
				"value" => "",
				"description" => __("Enter media height.", "js_composer")
			),
			get_common_options( 'align', 'Media' ),		
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Loop", "js_composer"),
				"param_name" => "loop",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Autoplay", "js_composer"),
				"param_name" => "autoplay",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),
			//$shadow_effect				
		)
	));	

	/* ------------------------------------
	:: AUDIO MAP	  	
	------------------------------------*/

	wpb_map( array(
		"name"		=> __("Audio Player", "js_composer"),
		"base"		=> "audioembed",
		"controls"	=> "edit_popup_delete",
		"class"		=> "",
		"icon"		=> "icon-audio",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(			
			array(
				"type" => "textfield",
				"heading" => __("Media URL", "js_composer"),
				"param_name" => "url",
				"value" => "",
				"description" => __("Enter URL of media.", "js_composer")
			),		
			array(
				"type" => "textfield",
				"heading" => __("Cover Image URL", "js_composer"),
				"param_name" => "imageurl",
				"value" => "",
				"description" => __("Optional cover image ( Paused, Loading ).", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("ID", "js_composer"),
				"param_name" => "id",
				"value" => "audio_0",
				"description" => __("Enter a unique ID.", "js_composer")
			),			
			array(
				"type" => "textfield",
				"heading" => __("Player Width", "js_composer"),
				"param_name" => "width",
				"value" => "",
				"description" => __("Enter image width.", "js_composer")
			),
			get_common_options( 'align', 'Media' ),		
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Loop", "js_composer"),
				"param_name" => "loop",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Autoplay", "js_composer"),
				"param_name" => "autoplay",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),
			$shadow_effect											
		)
	));
		
	
	add_shortcode('mediaembed', 'mediaembed_shortcode');
	add_shortcode('videoembed', 'mediaembed_shortcode');
	add_shortcode('audioembed', 'mediaembed_shortcode');