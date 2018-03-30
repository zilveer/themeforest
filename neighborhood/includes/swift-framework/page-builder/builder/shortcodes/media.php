<?php

    /*
    *
    *	Swift Page Builder - Media Shortcodes
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2014 - http://www.swiftideas.net
    *
    */


	/* VIDEO ASSET
	================================================== */
	class SwiftPageBuilderShortcode_spb_video extends SwiftPageBuilderShortcode {

	    protected function content( $atts, $content = null ) {
	        $title = $link = $size = $el_position = $full_width = $width = $el_class = '';
	        extract(shortcode_atts(array(
	            'title' => '',
	            'link' => '',
	            'size' => ( isset($content_width) ) ? $content_width : 500,
	            'el_position' => '',
	            'width' => '1/1',
	            'full_width' => 'no',
	            'el_class' => ''
	        ), $atts));
	        $output = '';

	        if ( $link == '' ) { return null; }
	        $video_h = '';
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	        $size = str_replace(array( 'px', ' ' ), array( '', '' ), $size);
	        $size = explode("x", $size);
	        $video_w = $size[0];
	        if ( count($size) > 1 ) {
	            $video_h = ' height="'.$size[1].'"';
	        }

	        global $wp_embed;
	        $embed = $wp_embed->run_shortcode('[embed width="'.$video_w.'"'.$video_h.']'.$link.'[/embed]');

			if ($full_width == "yes") {
	        $output .= "\n\t".'<div class="spb_video_widget full-width spb_content_element '.$width.' '.$el_class.'">';
			} else {
	        $output .= "\n\t".'<div class="spb_video_widget spb_content_element '.$width.$el_class.'">';
			}

	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading spb_video_heading"><span>'.$title.'</span></h4>' : '';
	        $output .= $embed;
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}

	SPBMap::map( 'spb_video', array(
	    "name"		=> __("Video Player", "swiftframework"),
	    "base"		=> "spb_video",
	    "class"		=> "",
		"icon"		=> "spb-icon-film-youtube",
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "heading" => __("Widget title", "swiftframework"),
	            "param_name" => "title",
	            "value" => "",
	            "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Video link", "swiftframework"),
	            "param_name" => "link",
	            "value" => "",
	            "description" => __('Link to the video. More about supported formats at <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>.', "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Video size", "swiftframework"),
	            "param_name" => "size",
	            "value" => "",
	            "description" => __('Enter video size in pixels. Example: 200x100 (Width x Height).', "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Full width", "swiftframework"),
	            "param_name" => "full_width",
	            "value" => array(__('No', "swiftframework") => "no", __('Yes', "swiftframework") => "yes"),
	            "description" => __("Select this if you want the video to be the full width of the page container (leave the above size blank).", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swiftframework"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
	        )
	    )
	) );


	/* SINGLE IMAGE ASSET
	================================================== */
	class SwiftPageBuilderShortcode_spb_single_image extends SwiftPageBuilderShortcode {

	    public function content( $atts, $content = null ) {

	        $el_class = $width = $image_size = $frame = $lightbox = $image_link = $link_target = $caption = $el_position = $image = '';

	        extract(shortcode_atts(array(
	            'width' => '1/1',
	            'image' => $image,
	            'image_size' => '',
	            'frame'	=> '',
	            'lightbox' => '',
	            'image_link' => '',
	            'link_target' => '',
	            'caption' => '',
	            'fullwidth' => 'no',
	            'el_position' => '',
	            'el_class' => ''
	        ), $atts));

			if ($image_size == "") { $image_size = "large"; }
		
	        $output = '';
	        $img = spb_getImageBySize(array( 'attach_id' => preg_replace('/[^\d]/', '', $image), 'thumb_size' => $image_size ));
	        $img_url = wp_get_attachment_image_src($image, 'large');
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	        // $content =  !empty($image) ? '<img src="'..'" alt="">' : '';
	        $output .= "\n\t".'<div class="spb_content_element spb_single_image '. $frame .' '.$width.' '.$el_class.'">';

	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        if ($lightbox == "yes") {
	        $output .= '<figure class="lightbox clearfix">';
	        } else {
	        $output .= '<figure class="clearfix">';
	        }
	        if ($image_link != "") {
	        $output .= "\n\t\t\t".'<a class="img-link" href="'.$image_link.'" target="'.$link_target.'">';
	        $output .= '<div class="overlay"><div class="thumb-info">';
	        $output .= '<i class="fa-link"></i>';
	        $output .= '</div></div>';
	        $output .= $img['thumbnail'];
	        $output .= '</a>';
	        } else if ($lightbox == "yes") {
	        //$output .= "\n\t\t\t".'<a class="lightbox" data-rel="ilightbox[' . $image . '-' . rand( 0, 1000 ) . ']" href="'.$img_url[0].'" rel="image-gallery">';
	        $output .= "\n\t\t\t".'<a class="lightbox" data-rel="ilightbox[image-gallery]" href="'.$img_url[0].'">';
	        $output .= '<div class="overlay"><div class="thumb-info">';
	        $output .= '<i class="fa-search"></i>';
	        $output .= '</div></div>';
	        $output .= $img['thumbnail'];
	        $output .= '</a>';
	        } else {
	        $output .= "\n\t\t\t".$img['thumbnail'];
	        }
	        if ($caption != "") {
	        $output .= '<figcaption>'.$caption.'</figcaption>';
	        } else {
	        $output .= '<figcaption>'.do_shortcode($content).'</figcaption>';
			}
	        $output .= '</figure>';
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

	        // Output
	        if ($fullwidth == "yes") {
		        $output = $this->startRow($el_position, $width, $fullwidth, "full-width") . $output . $this->endRow($el_position, $width, $fullwidth, "full-width");
	        } else {
	        	$output = $this->startRow($el_position, $width, $fullwidth) . $output . $this->endRow($el_position, $width, $fullwidth);
	        }
	        
	        
	        return $output;
	    }

	    public function singleParamHtmlHolder($param, $value) {
	        $output = '';
	        // Compatibility fixes
	        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
	        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
	        $value = str_ireplace($old_names, $new_names, $value);
	        //$value = __($value, "swiftframework");
	        //
	        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
	        $type = isset($param['type']) ? $param['type'] : '';
	        $class = isset($param['class']) ? $param['class'] : '';

	        if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
	            $output .= '<input type="hidden" class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
	            if(($param['type'])=='attach_image') {
	                $img = spb_getImageBySize(array( 'attach_id' => (int)preg_replace('/[^\d]/', '', $value), 'thumb_size' => 'thumbnail' ));
	                $output .= ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . SwiftPageBuilder::getInstance()->assetURL('img/blank_f7.gif') . '" class="attachment-thumbnail" alt="" title="" />') . '<a href="#" class="column_edit_trigger' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '"><i class="spb-icon-single-image"></i>' . __( 'No image yet! Click here to select it now.', "swiftframework" ) . '</a>';
	            }
	        }
	        else {
	            $output .= '<'.$param['holder'].' class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
	        }
	        return $output;
	    }
	}

	SPBMap::map( 'spb_single_image', array(
		"name"		=> __("Single Image", "swiftframework"),
		"base"		=> "spb_single_image",
		"class"		=> "spb_single_image_widget",
		"icon"		=> "spb-icon-single-image",
	    "params"	=> array(
			array(
				"type" => "attach_image",
				"heading" => __("Image", "swiftframework"),
				"param_name" => "image",
				"value" => "",
				"description" => ""
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Image Size", "swiftframework"),
			    "param_name" => "image_size",
			    "value" => array(__("Full", "swiftframework") => "full", __("Large", "swiftframework") => "large", __("Medium", "swiftframework") => "medium", __("Thumbnail", "swiftframework") => "thumbnail"),
			    "description" => __("Select the source size for the image (NOTE: this doesn't affect it's size on the front-end, only the quality).", "swiftframework")
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Image Frame", "swiftframework"),
			    "param_name" => "frame",
			    "value" => array(__("No Frame", "swiftframework") => "noframe", __("Border Frame", "swiftframework") => "borderframe", __("Glow Frame", "swiftframework") => "glowframe", __("Shadow Frame", "swiftframework") => "shadowframe"),
			    "description" => __("Select a frame for the image.", "swiftframework")
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Enable lightbox link", "swiftframework"),
			    "param_name" => "lightbox",
			    "value" => array(__("Yes", "swiftframework") => "yes", __("No", "swiftframework") => "no"),
			    "description" => __("Select if you want the image to open in a lightbox on click", "swiftframework")
			),
			array(
			    "type" => "textfield",
			    "heading" => __("Add link to image", "swiftframework"),
			    "param_name" => "image_link",
			    "value" => "",
			    "description" => __("If you would like the image to link to a URL, then enter it here. NOTE: this will override the lightbox functionality if you have enabled it.", "swiftframework")
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Link opens in new window?", "swiftframework"),
			    "param_name" => "link_target",
			    "value" => array(__("Self", "swiftframework") => "_self", __("New Window", "swiftframework") => "_blank"),
			    "description" => __("Select if you want the link to open in a new window", "swiftframework")
			),
			array(
			    "type" => "textarea_html",
			    "holder" => 'div',
			    "heading" => __("Image Caption", "swiftframework"),
			    "param_name" => "content",
			    "value" => "",
			    "description" => __("If you would like a caption to be shown below the image, add it here.", "swiftframework")
			),
			array(
	            "type"        => "buttonset",
	            "heading"     => __( "Full Width", 'swiftframework' ),
	            "param_name"  => "fullwidth",
	            "value"       => array(
	                __( 'No', 'swiftframework' )  => "no",
	                __( 'Yes', 'swiftframework' ) => "yes"
	            ),
	            "description" => __( "Select if you'd like the asset to be full width (edge to edge). NOTE: only possible on pages without sidebars.", 'swiftframework' )
	        ),
			array(
			    "type" => "textfield",
			    "heading" => __("Extra class name", "swiftframework"),
			    "param_name" => "el_class",
			    "value" => "",
			    "description" => __("If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css.", "swiftframework")
			)
	    )
	));


	/* GOOGLE MAPS ASSET
	================================================== */
	class SwiftPageBuilderShortcode_spb_gmaps extends SwiftPageBuilderShortcode {

	    protected function content( $atts, $content = null ) {

	        $title = $address = $size = $zoom = $pin_image = $type = $el_position = $width = $el_class = '';
	        extract(shortcode_atts(array(
	            'title' => '',
	            'address' => '',
	            'size' => 200,
	            'zoom' => 14,
	            'pin_image' => '',
	            'type' => 'm',
	            'fullscreen' => 'no',
	            'el_position' => '',
	            'width' => '1/1',
	            'el_class' => ''
	        ), $atts));
	        $output = '';

	        if ( $address == '' ) { return null; }

	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);

	        $size = str_replace(array( 'px', ' ' ), array( '', '' ), $size);

	        $img_url = wp_get_attachment_image_src($pin_image, 'full');

			if ($fullscreen == "yes" && $width == "span12") {
			$output .= "\n\t".'<div class="spb_gmaps_widget fullscreen-map spb_content_element '.$width.$el_class.'">';
	        } else {
	        $output .= "\n\t".'<div class="spb_gmaps_widget spb_content_element '.$width.$el_class.'">';
	        }
	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading"><span>'.$title.'</span></h4>' : '';
	        $output .= '<div class="spb_map_wrapper"><div class="map-canvas" style="width:100%;height:'.$size.'px;" data-address="'.$address.'" data-zoom="'.$zoom.'" data-maptype="'.$type.'" data-pinimage="'.$img_url[0].'"></div></div>';
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
			
			if ( $fullscreen == "yes" ) {
			    $output = $this->startRow( $el_position, '', true, 'full-width' ) . $output . $this->endRow( $el_position, '', true, 'full-width' );
			} else {
			    $output = $this->startRow( $el_position ) . $output . $this->endRow( $el_position );
			}
			
	        global $include_maps;
	        $include_maps = true;

	        return $output;
	    }
	}

	SPBMap::map( 'spb_gmaps',  array(
	    "name"		=> __("Google Map", "swiftframework"),
	    "base"		=> "spb_gmaps",
	    "class"		=> "",
		"icon"		=> "spb-icon-map-pin",
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "heading" => __("Widget title", "swiftframework"),
	            "param_name" => "title",
	            "value" => "",
	            "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Address", "swiftframework"),
	            "param_name" => "address",
	            "value" => "",
	            "description" => __('Enter the address that you would like to show on the map here, i.e. "Cupertino".', "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Map height", "swiftframework"),
	            "param_name" => "size",
	            "value" => "300",
	            "description" => __('Enter map height in pixels. Example: 300).', "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Map type", "swiftframework"),
	            "param_name" => "type",
	            "value" => array(__("Map", "swiftframework") => "ROADMAP", __("Satellite", "swiftframework") => "SATELLITE", __("Hybrid", "swiftframework") => "HYBRID", __("Terrain", "swiftframework") => "TERRAIN"),
	            "description" => __("Select button alignment.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Map Zoom", "swiftframework"),
	            "param_name" => "zoom",
	            "value" => array(__("14 - Default", "swiftframework") => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
	        ),
	        array(
	        	"type" => "attach_image",
	        	"heading" => __("Custom Map Pin", "swiftframework"),
	        	"param_name" => "pin_image",
	        	"value" => "",
	        	"description" => "Choose an image to use as the custom pin for the address on the map. Upload your custom map pin, the image size must be 150px x 75px."
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Fullscreen Display", "swiftframework"),
	            "param_name" => "fullscreen",
	            "value" => array(__("No", "swiftframework") => "no", __("Yes", "swiftframework") => "yes"),
	            "description" => __("If yes, the map will be displayed from screen edge to edge.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swiftframework"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
	        )
	    )
	) );