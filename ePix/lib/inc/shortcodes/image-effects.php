<?php

	/* ------------------------------------
	:: IMAGE EFFECTS
	------------------------------------*/

	class WPBakeryShortCode_Imageeffect extends WPBakeryShortCode {
		protected  $predefined_atts = array(
					  'type' => '',
					  'image' => '',
					  'url' => '',	 
					  'width' => '',	
					  'class' => '',	 
					  'height' => '',
					  'videourl' => '',
					  'lightbox' => '',
				   	  'overlay_state' => '',
				  	  'zoomhover' => '',					  
					  'target' => '',
					  'link' => '',
					  'alt' => '',	 
					  'subtitle' => '',	 
					  'align' => '',
					  'shadow' => '',
					  'titleoverlay' => '',
					  'lightbox_iframe',	 	 
					  'css_animation' => '' 
					);

		public function singleParamHtmlHolder( $param, $value ) {
			$output = '';
			// Compatibility fixes
			$old_names = array( 'yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange' );
			$new_names = array( 'alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning' );
			$value = str_ireplace( $old_names, $new_names, $value );
			//$value = __($value, "js_composer");
			//
			$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
			$type = isset( $param['type'] ) ? $param['type'] : '';
			$class = isset( $param['class'] ) ? $param['class'] : '';
	
			if ( isset( $param['holder'] ) == false || $param['holder'] == 'hidden' ) {
				$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
				if ( ( $param['type'] ) == 'attach_image' ) {
					$img = wpb_getImageBySize( array( 'attach_id' => (int)preg_replace( '/[^\d]/', '', $value ), 'thumb_size' => 'thumbnail' ) );
					$output .= ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />' ) . '<img src="' . vc_asset_url( 'vc/elements_icons/single_image.png' ) . '" class="no_image_image' . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '" /><a href="#" class="column_edit_trigger' . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '">' . __( 'Add image', 'js_composer' ) . '</a>';
				}
			} else {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
			}
			return $output;
		}
					
		public function content( $atts, $content = null ) {
			$type = $image = $url = $width = $class = $height = $videourl = $lightbox = $target = $link = $alt = $align = $shadow = $titleoverlay = $css_animation = $css_class = $lightbox_iframe = '';
			extract(shortcode_atts(array(
				  'type' => '',
				  'image' => '',
				  'url' => '',	 
				  'width' => '',	
				  'class' => '',	 
				  'height' => '',
				  'videourl' => '',
				  'lightbox' => '',
				  'target' => '',
				  'link' => '',
				  'overlay_state' => '',
				  'zoomhover' => '',
				  'alt' => '',	 
				  'subtitle' => '',	 
				  'align' => '',
				  'shadow' => '',
				  'titleoverlay' => '',
				  'lightbox_iframe' => '',	 
				  'css_animation' => '' 
			), $atts));
				
			$css_class = $this->getCSSAnimation($css_animation) .' '. $class;
			$NV_imgheight = $height;
			$NV_imgwidth = $width;
			$NV_imgzoomcrop = 0;
			
			$image_size = 'full';	
			
			if( !empty( $image ) )
			{
				$get_image_src = wp_get_attachment_image_src( $image, $image_size );
				$NV_previewimgurl = $get_image_src[0];		
			}
			else
			{
				$NV_previewimgurl = esc_attr($url);
			}
			
			if( !empty($videourl) )
			{
				$lightboxurl = esc_attr($videourl);
			}
			else
			{
				$lightboxurl = $NV_previewimgurl;
			}	
			
			// Check is Timthumb is Enabled or Disabled
			if( of_get_option('timthumb_disable') !='disable' )
			{  
				require_once NV_FILES . '/adm/functions/BFI_Thumb.php';
				
				if( !empty( $NV_imgwidth ) )
				{
					$params['width'] = $NV_imgwidth;	
				}
		
				if( !empty( $NV_imgheight ) )
				{
					$params['height'] = $NV_imgheight;	
				}		
				
				
				if( $NV_imgzoomcrop == 0 )
				{
					$params['crop'] = true;	
				}
				
				// Circular Effect
				if( $type == 'circular' || $type == 'frame circular' )
				{
					$params['height'] = $params['width'];
				}
				
				$NV_imagepath = bfi_thumb( dyn_getimagepath($NV_previewimgurl) , $params );
			}
			else 
			{
				$NV_imagepath = dyn_getimagepath($NV_previewimgurl);
			}
				
		
			if($NV_imgheight)
			{
				$NV_height_attr='height="'.$NV_imgheight.'"';	
			}
			else
			{
				$NV_height_attr='';
			}
			
			if($NV_imgwidth)
			{
				$NV_width_attr='style="width:'.$NV_imgwidth.'px"';	
			}
			else
			{
				$NV_width_attr='';
			}	
		
			
			$NV_imgframe = $NV_imgblackwhite = $NV_lightbox = $NV_imageeffect = '';
			
			if( esc_attr($type)=="reflect" || esc_attr($type)=="reflectlightbox" || esc_attr($type)=="reflection" )
			{ 
				$NV_imageeffect = 'reflection';
			} 
			elseif(esc_attr($type)=="shadowreflectlightbox" || esc_attr($type)=="shadowreflection" || esc_attr($type)=="shadowreflect")
			{
				$NV_imageeffect = 'shadowreflection'; 
			}
			elseif(esc_attr($type)=="frame" || esc_attr($type)=="framelightbox" || esc_attr($type)=="frameblackwhite" )
			{
				$NV_imgframe = 'frame'; 
			}		
			else
			{
				$NV_imageeffect =  esc_attr($type);
			}
			
			if(
			esc_attr($type)=="blackwhite" || 
			esc_attr($type)=="shadowblackwhite" || 
			esc_attr($type)=="frameblackwhite") {
				$NV_imgblackwhite = 'blackwhite';
			} 
			
			if(
			esc_attr($type)=="shadowlightbox" || 
			esc_attr($type)=="shadowreflectlightbox" || 
			esc_attr($type)=="reflectlightbox" || 
			esc_attr($type)=="framelightbox" || 
			esc_attr($type) == "lightbox" ||
			esc_attr($lightbox) == "yes") {
				$NV_lightbox = "yes";	
			}		
		
			// enqueue black and white script
			if( $NV_imgblackwhite == 'blackwhite' )
			{
				wp_deregister_script('jquery-blackandwhite');	
				wp_register_script('jquery-blackandwhite', get_template_directory_uri().'/js/jquery.blackandwhite.min.js',false,array('jquery'),true);
				wp_enqueue_script('jquery-blackandwhite');
			}
		
			$NV_target = esc_attr($target);
			
			// Target
			if( !empty($NV_target) ) $NV_target = 'target="'. $NV_target .'"'; else $NV_target = '';	
			
			
			$fancybox_id = str_replace("'", "", $alt );
			
			// Max Width
			$max_width = '';
			if( !empty( $width ) )
			{
				$max_width = 'style="max-width:'. $width .'px"';
			}
			
			$output = '';
		
			$output .= "\n\t\t". '<div class="nv-skin mediawrap '. $align .' '.  $css_class .' '. $NV_imgframe .' '. $NV_imageeffect .'" '. $max_width .'>';
			$output .= "\n\t\t\t". '<div class="container '. $NV_imageeffect .'">';
			$output .= "\n\t\t\t\t". '<div class="gridimg-wrap '. $zoomhover .'">';
			$output .= "\n\t\t\t\t\t". '<div class="title-wrap '. $NV_imgblackwhite .'">';						

				// Split Icon Space
				$split = '';
															
				if( !empty($NV_lightbox) && !empty( $link ) ) $split = 'split';						
						
				$output .= '<img src="'. $NV_imagepath .'" alt="'. esc_attr($alt) .'" width="'. esc_attr($width) .'" height="'. esc_attr($height) .'"  />';

				if( !empty( $lightbox_iframe ) )
				{
					$lightbox_iframe = 'data-fancybox-type="iframe"';
				}				

				// LightBox
				if( !empty($NV_lightbox) ) 
				{
					$lightbox_url = $lightbox_type = '';
									
					if( !empty($videourl) && empty( $lightbox_iframe ) )
					{
						$lightbox_type = 'fa fa-play';
					}
					else
					{
						$lightbox_type = 'fa fa-expand';
					}
											
					$output .= '<a href="'. $lightboxurl .'" '. $lightbox_iframe .' data-fancybox-group="image-'. $fancybox_id .'" class="fancybox action-icons lightbox-icon '. $split .'"><i class="'. $lightbox_type .' fa-lg"></i></a>';
				}
			
				if( !empty( $link ) )
				{ 
					$output .= '<a href="'. esc_attr($link) .'" '. $NV_target .' class="action-icons link-icon '. $split .'"><i class="fa fa-link fa-lg"></i></a>';
				}						
                   

				if( $titleoverlay =="yes" ) 
				{
					$output .= '<div class="caption-wrap '. ( !empty( $NV_cssclasses ) ? $NV_cssclasses : '' ) .' '. $overlay_state .'">';
							
					// Title
					if( $titleoverlay == "yes" )
					{					

						if( !empty( $alt ) )
						{	
							$output .= "\n\t". '<div class="title caption skinset-main nv-skin">';
							$output .= "\n\t\t". '<h3>'. esc_attr($alt) .'</h3>';
							$output .= "\n\t". '</div>';
						}
									
						if( !empty( $subtitle ) )
						{
							$output .= "\n\t". '<div class="content caption skinset-main nv-skin">';
							$output .= "\n\t\t". do_shortcode( esc_attr($subtitle) );
							$output .= "\n\t". '</div>';		
						}
					}					
				
					$output .= '</div><!-- /caption-wrap -->';	
				}
					                         
			$output .= "\n\t\t\t\t\t". '</div>';
			$output .= "\n\t\t\t\t". '</div><!-- / gridimg-wrap -->';
			$output .= "\n\t\t\t". '</div><!-- / container -->';
			$output .= "\n\t\t". '</div><!-- / mediawrap -->';
		
			return $output;
		}
	}

	/* ------------------------------------
	:: IMAGE MAP	
	------------------------------------*/

	wpb_map( array(
		"name"		=> __("Image Effect", "js_composer"),
		"base"		=> "imageeffect",
		"controls"	=> "edit_popup_delete",
		"class"		=> "wpb_vc_single_image_widget",
		"icon"		=> "icon-image",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "attach_image",
				"heading" => __("Image", "js_composer"),
				"param_name" => "image",
				"value" => "",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "img",
				"heading" => __("Image URL", "js_composer"),
				"param_name" => "url",
				"value" => "",
				"description" => __("Enter URL if you wish to use an image not in the media library.", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Effect", "js_composer"),
				"param_name" => "type",
				"value" => array(
				'None' => "",
					'Frame' => "frame",
					'Circular' => "circular",
					'Circular + Frame' => "circular frame",
					'Black & White' => 'blackwhite',
					'Frame + Black & White' => 'frameblackwhite'
				),
				"description" => __("Circular works with modern browsers only.", "js_composer")
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Zoom on Hover", "js_composer"),
				"param_name" => "zoomhover",
				"value" =>  array(
					__('Enable', "js_composer") => "zoomhover", 
				),
				"description" => __("Zoom Image on Hover. <strong>Note:</strong> Works only in modern browsers.", "js_composer")
			),			
			array(
				"type" => "textfield",
				"heading" => __("Image Width", "js_composer"),
				"param_name" => "width",
				"value" => "",
				"description" => __("Enter image width.", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("Image Height", "js_composer"),
				"param_name" => "height",
				"value" => "",
				"description" => __("Enter image height.", "js_composer")
			),
			$add_css_animation,
			get_common_options( 'align', 'Image' ),
			array(
				"type" => "textfield",
				"heading" => __("Title", "js_composer"),
				"param_name" => "alt",
				"value" => "",
				"description" => __("Title / Alternate text", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("Sub Title", "js_composer"),
				"param_name" => "subtitle",
				"value" => "",
			),			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Enable Title Overlay", "js_composer"),
				"param_name" => "titleoverlay",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Overlay State", "js_composer"),
				"param_name" => "overlay_state",
				"value" => array(
					__("Hover", "js_composer") => "hover", 
					__("Static", "js_composer") => "static"
				),
				"dependency" => Array( 'element' => 'titleoverlay' /*, 'not_empty' => true*/, 'value' => array('yes') ),
			),			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Enable Lightbox", "js_composer"),
				"param_name" => "lightbox",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),						
			array(
				"type" => "textfield",
				"heading" => __("Media URL", "js_composer"),
				"param_name" => "videourl",
				"value" => "",
				"dependency" => Array('element' => 'lightbox' /*, 'not_empty' => true*/, 'value' => array('yes')),
				"description" => __("Enter url if you want to use lightbox to display a Video or other media.", "js_composer")
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Media URL in iFrame", "js_composer"),
				"param_name" => "lightbox_iframe",
				"value" =>  array(
					__('Enable', "js_composer") => "enable", 
				),
				"dependency" => Array('element' => 'lightbox' /*, 'not_empty' => true*/, 'value' => array('yes')),
				"description" => __("Place the Media URL within an iFrame.", "js_composer")
			),				
			array(
				"type" => "textfield",
				"heading" => __("Image link", "js_composer"),
				"param_name" => "link",
				"value" => "",
				"description" => __("Enter url if you want to link this image with any url. Leave empty if you won't use it", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Link Target", "js_composer"),
				"param_name" => "target",
				"value" => array(
					__("Same window", "js_composer") => "_self", 
					__("New window", "js_composer") => "_blank"
				),
				"dependency" => Array('element' => "img_link", 'not_empty' => true)
			)
		)
	));	