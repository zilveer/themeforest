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
					  'target' => '',
					  'link' => '',
					  'alt' => '',	 
					  'align' => '',
					  'shadow' => '',
					  'titleoverlay' => '',	 
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
			$type = $image = $url = $width = $class = $height = $videourl = $lightbox = $target = $link = $alt = $align = $shadow = $titleoverlay = $css_animation = $css_class = '';
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
				  'alt' => '',	 
				  'align' => '',
				  'shadow' => '',
				  'titleoverlay' => '',	 
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
			elseif(esc_attr($type)=="frame" || esc_attr($type)=="framelightbox" || esc_attr($type)=="frameblackwhite")
			{
				$NV_imgframe = 'frame'; 
			}
			
			if(
			esc_attr($type)=="blackwhite" || 
			esc_attr($type)=="shadowblackwhite" || 
			esc_attr($type)=="frameblackwhite") {
				$NV_imgblackwhite ='blackwhite';
			} 
			
			if(
			esc_attr($type)=="shadowlightbox" || 
			esc_attr($type)=="shadowreflectlightbox" || 
			esc_attr($type)=="reflectlightbox" || 
			esc_attr($type)=="framelightbox" || 
			esc_attr($type)=="lightbox" ||
			esc_attr($lightbox)=="yes") {
				$NV_lightbox="yes";	
			}
			
			
			if( empty( $NV_imageeffect ) && (
			esc_attr($shadow) || 
			esc_attr($type)=="shadow" ||
			esc_attr($type)=="shadowblackwhite" ||
			esc_attr($type)=="shadowlightbox" ) ) { 
				$NV_imageeffect ='shadow'; 
			} 
		
		
			// enqueue black and white script
			if( $NV_imgblackwhite == 'blackwhite' )
			{
				wp_deregister_script('jquery-blackandwhite');	
				wp_register_script('jquery-blackandwhite', get_template_directory_uri().'/js/jquery.blackandwhite.min.js',false,array('jquery'),true);
				wp_enqueue_script('jquery-blackandwhite');
			}
			
		
			$NV_target = esc_attr($target);
			
			if(!empty($NV_target)) $NV_target='target="'.$NV_target.'"'; else $NV_target='';	
			
			if( $link !='' )
			{
				$NV_link_start = '<a href="'.esc_attr($link).'" title="'.esc_attr($alt).'" '. $NV_target .' class="'. $NV_imgblackwhite .'">';
				$NV_link_end = '</a>';
			}
			else
			{
				$NV_link_start = '';
				$NV_link_end = '';
			} 
			
			$fancybox_id = str_replace("'", "", $alt );
			
			$max_width = '';
			
			if( !empty($width) )
			{
				if( $NV_imgframe == 'frame' )
				{
					$new_width = $width + 14;
				}
				else
				{
					$new_width = $width;
				}
				
				$max_width = 'style="max-width:'. $new_width .'px"';
			}
			
		
			$output = '';
			
			$output .= '<div class="nv-skin mediawrap '. $align .' '.  $css_class . ( !empty( $NV_imgframe ) ? ' '. $NV_imgframe : '' ) .' '. $NV_imageeffect .'" '. $max_width .'>';
			$output .= '<div class="container '. ( !empty( $NV_imgeffect ) ? $NV_imgeffect : '' ) .'">';
			$output .= '<div class="gridimg-wrap '. ( $type == 'none' ? 'none ' : '' ) .'">';
			$output .= '<div class="title-wrap '. ( empty( $NV_lightbox ) && empty($NV_link_start) ? $NV_imgblackwhite : '' ) .'">';	
					
				// LightBox
				if( !empty($NV_lightbox) && empty($NV_link_start) ) 
				{
					$output .= '<a href="'. $lightboxurl .'" title="'. $alt .'" data-fancybox-group="image-'. $fancybox_id .'" class="fancybox ';
					
					if( !empty($videourl) )	
					{
						$output .= 'galleryvid '; 
					}
					else
					{
						$output .= 'galleryimg '; 
					}
						
					$output .= $NV_imgblackwhite .'"';
		
					if( !empty( $height ) )
					{
						$output .= 'style="max-height:'. $height .'px;"';					
					}
					
					$output .='>';
				} 
						
				// Image Link
				$output .= $NV_link_start;
						
				$output .= '<img '. ( esc_attr($type)=="reflect" || esc_attr($type)=="reflection" || esc_attr($type)=="reflectlightbox" || esc_attr($type)=="shadowreflectlightbox" || esc_attr($type)=="shadowreflect"  || esc_attr($type)=="shadowreflection" ? 'class="reflect"' : '' ) .'src="'. $NV_imagepath .'" alt="'. esc_attr($alt) .'" width="'. esc_attr($width) .'" height="'. esc_attr($height) .'"  />';
		
									
				// LightBox / Link *End*
				if( !empty($NV_lightbox) || !empty($NV_link_start) )
				{
					$output .= '</a>';
				}
						
				if( $titleoverlay =="yes" ) 
				{ 
					$output .= '<div class="title">';
					$output .= '<h3>'. esc_attr($alt) .'</h3>';
					$output .= '</div>';	              
				}
						                           
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
	
			return $output;
		}
	}

	/* ------------------------------------
	:: IMAGE MAP	
	------------------------------------*/

	wpb_map( array(
		"name"		=> __("Single Image", "js_composer"),
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
				"value" => get_options_array('imageeffect'),
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
				"heading" => __("Alt", "js_composer"),
				"param_name" => "alt",
				"value" => "",
				"description" => __("Alternate text", "js_composer")
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
				)
			)
		)
	));	