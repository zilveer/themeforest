<?php

    /*
    *
    *	Swift Page Builder - Raw Content Shortcode
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2014 - http://www.swiftideas.net
    *
    */
    
	/* RAW HTML ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_spb_raw_html extends SwiftPageBuilderShortcode {
	
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
	
	        if ( isset( $param['holder'] ) == false || $param['holder'] == 'hidden' ) {
	            $output .= '<input type="hidden" class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
	        } else {
	            if ( $param['type'] == 'textarea_raw_html' ) {
	                $output .= '<' . $param['holder'] . ' class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . htmlentities( rawurldecode( base64_decode( strip_tags( $value ) ) ), ENT_COMPAT, 'UTF-8' ) . '</' . $param['holder'] . '><input type="hidden" name="' . $param_name . '_code" class="' . $param_name . '_code" value="' . strip_tags( $value ) . '" />';
	            } else {
	                $output .= '<' . $param['holder'] . ' class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
	            }
	        }
	        return $output;
	    }
	
	    public function content( $atts, $content = null ) {
	
	        $el_class = $width = $el_position = '';
	        extract(shortcode_atts(array(
	            'el_class' => '',
	            'el_position' => '',
	            'width' => '1/2'
	        ), $atts));
	
	        $output = '';
	
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	        $el_class .= ' spb_raw_html';
	        $content = rawurldecode( base64_decode( strip_tags( $content ) ) );
	        $output .= "\n\t".'<div class="spb_content_element '.$width.$el_class.'">';
	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        $output .= "\n\t\t\t".$content;
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
	
	        //
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_raw_html', array(
		"name"		=> __("Raw HTML", "swiftframework"),
		"base"		=> "spb_raw_html",
		"class"		=> "div",
		"icon"      => "spb-icon-raw-html",
		"wrapper_class" => "clearfix",
		"controls"	=> "full",
		"params"	=> array(
			array(
				"type" => "textarea_raw_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Raw HTML", "swiftframework"),
				"param_name" => "content",
				"value" => base64_encode("<p>This is a raw html block.<br/>Click the edit button to change this html.</p>"),
				"description" => __("Enter your HTML content.", "swiftframework")
			),
		)
	) );


	/* RAW JS ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_spb_raw_js extends SwiftPageBuilderShortcode_spb_raw_html {
	    
	        public function content( $atts, $content = null ) {
	
	            $el_class = $width = $el_position = '';
	
	            extract(shortcode_atts(array(
	                'el_class' => '',
	                'el_position' => '',
	                'width' => '1/2'
	            ), $atts));
	
	            $output = '';
	
	            $el_class = $this->getExtraClass($el_class);
	            $width = spb_translateColumnWidthToSpan($width);
	            $el_class .= ' spb_raw_js';
	            $content = rawurldecode( base64_decode( strip_tags( $content ) ) );
	            $output .= "\n\t".'<div class="spb_content_element '.$width.$el_class.'">';
	            $output .= "\n\t\t".'<div class="spb_wrapper">';
	            $output .= "\n\t\t\t".'<script type="text/javascript">';
	            $output .= "\n\t\t\t\t".$content;
	            $output .= "\n\t\t\t".'</script>';
	            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
	
	            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	            return $output;
	        }
	    
	}
	
	SPBMap::map( 'spb_raw_js', array(
		"name"		=> __("Raw JS", "swiftframework"),
		"base"		=> "spb_raw_js",
		"class"		=> "div",
		"icon"      => "spb-icon-raw-javascript",
		"wrapper_class" => "clearfix",
		"controls"	=> "full",
		"params"	=> array(
			array(
				"type" => "textarea_raw_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Raw js", "swiftframework"),
				"param_name" => "content",
				"value" => __(base64_encode("alert('Enter your js here!');"), "swiftframework"),
				"description" => __("Enter your Js.", "swiftframework")
			),
		)
	) );