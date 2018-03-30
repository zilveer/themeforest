<?php
	
	/*
	*
	*	Swift Page Builder - Default Shortcodes Config
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/
	
	/* TEXT BLOCK ASSET
	================================================== */
	class SwiftPageBuilderShortcode_spb_text_block extends SwiftPageBuilderShortcode {
	
	    public function content( $atts, $content = null ) {
	
	        $title = $pb_margin_bottom = $pb_border_bottom = $el_class = $width = $el_position = '';
	
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'icon' => '',
	        	'pb_margin_bottom' => 'no',
	        	'pb_border_bottom' => 'no',
	            'el_class' => '',
	            'el_position' => '',
	            'width' => '1/2'
	        ), $atts));
	
	        $output = '';
	
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	
	        $el_class .= ' spb_text_column';
	        
	        if ($pb_margin_bottom == "yes") {
	        $el_class .= ' pb-margin-bottom';
	        }
	        if ($pb_border_bottom == "yes") {
	        $el_class .= ' pb-border-bottom';
	        }
	        
	        $icon_output = "";
	        
	        if ($icon) { 
	        $icon_output = '<i class="'.$icon.'"></i>';
	        }
	
	        $output .= "\n\t".'<div class="spb_content_element '.$width.$el_class.'">';
	        $output .= "\n\t\t".'<div class="spb_wrapper clearfix">';
	        if ($icon_output != "") {
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading spb-icon-heading"><span>'.$icon_output.''.$title.'</span></h3>' : '';
	        } else {
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading spb-text-heading"><span>'.$title.'</span></h3>' : '';
	        }
	        $output .= "\n\t\t\t".do_shortcode($content);
	        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);
	
	        //
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_text_block', array(
	    "name"		=> __("Text Block", "swift-framework-admin"),
	    "base"		=> "spb_text_block",
	    "class"		=> "",
	    "icon"      => "spb-icon-text-block",
	    "wrapper_class" => "clearfix",
	    "controls"	=> "full",
	    "params"	=> array(
	    	array(
	    	    "type" => "textfield",
	    	    "heading" => __("Widget title", "swift-framework-admin"),
	    	    "param_name" => "title",
	    	    "value" => "",
	    	    "description" => __("Heading text. Leave it empty if not needed.", "swift-framework-admin")
	    	),
	    	array(
	    	    "type" => "textfield",
	    	    "heading" => __("Title icon", "swift-framework-admin"),
	    	    "param_name" => "icon",
	    	    "value" => "",
	    	    "description" => __("Icon to the left of the title text. You can get the code from <a href='http://fortawesome.github.com/Font-Awesome/' target='_blank'>here</a>. E.g. icon-cloud", "swift-framework-admin")
	    	),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __("Text", "swift-framework-admin"),
	            "param_name" => "content",
	            "value" => "",
	            "description" => __("Enter your content.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Margin below widget", "swift-framework-admin"),
	            "param_name" => "pb_margin_bottom",
	            "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
	            "description" => __("Add a bottom margin to the widget.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Border below widget", "swift-framework-admin"),
	            "param_name" => "pb_border_bottom",
	            "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
	            "description" => __("Add a bottom border to the widget.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swift-framework-admin"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
	        )
	    )
	) );
	
	
	/* BOXED CONTENT ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_boxed_content extends SwiftPageBuilderShortcode {
	
	    public function content( $atts, $content = null ) {
	
	        $title = $type = $custom_styling = $custom_bg_colour = $custom_text_colour = $pb_margin_bottom = $el_class = $width = $el_position = '';
	
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'type'	=> '',
	        	'custom_bg_colour' => '',
	        	'custom_text_colour' => '',
	        	'pb_margin_bottom' => 'no',
	            'el_class' => '',
	            'el_position' => '',
	            'width' => '1/2'
	        ), $atts));
	
	        $output = '';
	
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	
	        $el_class .= ' spb_box_text';
	        $el_class .= ' '.$type;
	        
	        if ($pb_margin_bottom == "yes") {
	        $el_class .= ' pb-margin-bottom';
	        }
	        
	        if ($custom_bg_colour != "") {
	        $custom_styling .= 'background: '.$custom_bg_colour.'!important;';
	        }
	        
	        if ($custom_text_colour != "") {
	        $custom_styling .= 'color: '.$custom_text_colour.'!important;';
	        }
	
	        $output .= "\n\t".'<div class="spb_content_element '.$width.$el_class.'">';
	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading spb-text-heading"><span>'.$title.'</span></h3>' : '';
	        $output .= "\n\t\t\t";
	        if ($custom_styling != "") {
	        $output .= '<div class="box-content-wrap" style="'.$custom_styling.'">'.do_shortcode($content).'</div>';
	        } else {
	        $output .= '<div class="box-content-wrap">'.do_shortcode($content).'</div>';
	        }
	        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);
	
	        //
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'boxed_content', array(
	    "name"		=> __("Boxed Content", "swift-framework-admin"),
	    "base"		=> "boxed_content",
	    "class"		=> "",
	    "icon"      => "spb-icon-boxed-content",
	    "wrapper_class" => "clearfix",
	    "controls"	=> "full",
	    "params"	=> array(
	    	array(
	    	    "type" => "textfield",
	    	    "heading" => __("Widget title", "swift-framework-admin"),
	    	    "param_name" => "title",
	    	    "value" => "",
	    	    "description" => __("Heading text. Leave it empty if not needed.", "swift-framework-admin")
	    	),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __("Text", "swift-framework-admin"),
	            "param_name" => "content",
	            "value" => __("<p>This is a boxed content block. Click the edit button to edit this text.</p>", "swift-framework-admin"),
	            "description" => __("Enter your content.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Box type", "swift-framework-admin"),
	            "param_name" => "type",
	            "value" => array(__('Coloured', "swift-framework-admin") => "coloured", __('White with stroke', "swift-framework-admin") => "whitestroke"),
	            "description" => __("Choose the surrounding box type for this content", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Custom background colour", "swift-framework-admin"),
	            "param_name" => "custom_bg_colour",
	            "value" => "",
	            "description" => __("Provide a hex colour code here (include #). If blank, your chosen accent colour will be used.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Custom text colour", "swift-framework-admin"),
	            "param_name" => "custom_text_colour",
	            "value" => "",
	            "description" => __("Provide a hex colour code here (include #) if you want to override the default (#ffffff).", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Margin below widget", "swift-framework-admin"),
	            "param_name" => "pb_margin_bottom",
	            "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
	            "description" => __("Add a bottom margin to the widget.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swift-framework-admin"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
	        )
	    )
	) );
	
	
	/* DIVIDER ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_divider extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	        $with_line = $type = $el_class = $text = '';
	        extract(shortcode_atts(array(
	            'with_line' => '',
	            'type'		=> '',
	            'full_width'		=> '',
	            'text' => '',
	            'el_class' => '',
	            'el_position' => ''
	        ), $atts));
	        
	        $width = spb_translateColumnWidthToSpan("1/1");
	        
	        $output = '';
	        if ($full_width == "yes") {
	        $output .= '<div class="spb_divider '. $type .' spb_content_element asset-bg '.$width.' '.$el_class.'">';
	        } else {
	        $output .= '<div class="divider-wrap"><div class="spb_divider '. $type .' spb_content_element '.$width.' '.$el_class.'">';
	        }
	        if ($type == "go_to_top") {
	        $output .= '<a class="animate-top" href="#">'. $text .'</a>';
	        } else if ($type == "go_to_top_icon1") {
	        $output .= '<a class="animate-top" href="#"><i class="ss-up"></i></a>';
	        } else if ($type == "go_to_top_icon2") {
	        $output .= '<a class="animate-top" href="#">'. $text .'<i class="ss-up"></i></a>';
	        }
	        if ($full_width != "yes") {
	        $output .= '</div>';
	        }
	        $output .= '</div>'.$this->endBlockComment('divider')."\n";
	        
	        if ($full_width == "yes") {
	        $output = $this->startRow($el_position, '', true, "full-width") . $output . $this->endRow($el_position, '', true);
	        } else {
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        }
	     
	        return $output;
	    }
	}
	SPBMap::map( 'divider',  array(
	    "name"		=> __("Divider", "swift-framework-admin"),
	    "base"		=> "divider",
	    "class"		=> "spb_divider spb_controls_top_right",
		'icon'		=> 'spb-icon-divider',
	    "controls"	=> 'edit_popup_delete',
	    "params"	=> array(
	        array(
	            "type" => "dropdown",
	            "heading" => __("Divider type", "swift-framework-admin"),
	            "param_name" => "type",
	            "value" => array(__('Standard', "swift-framework-admin") => "standard", __('Thin', "swift-framework-admin") => "thin", __('Dotted', "swift-framework-admin") => "dotted", __('Go to top (text)', "swift-framework-admin") => "go_to_top", __('Go to top (Icon 1)', "swift-framework-admin") => "go_to_top_icon1", __('Go to top (Icon 2)', "swift-framework-admin") => "go_to_top_icon2"),
	            "description" => __("Select divider type.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Go to top text", "swift-framework-admin"),
	            "param_name" => "text",
	            "value" => __("Go to top", "swift-framework-admin"),
	            "description" => __("The text for the 'Go to top (text)' divider type.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Full width", "swift-framework-admin"),
	            "param_name" => "full_width",
	            "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
	            "description" => __("Select yes if you'd like the divider to be full width (only to be used with no sidebars, and with Standard/Thin/Dotted divider types).", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swift-framework-admin"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
	        )
	    ),
	    "js_callback" => array("init" => "spbTextSeparatorInitCallBack")
	) );
	
	
	/* BLANK SPACER ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_blank_spacer extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	        $height = $el_class = $width = $el_position = '';
	        extract(shortcode_atts(array(
	            'height' => '',
	            'spacer_id' => '',
	            'spacer_name' => '',
	            'el_class' => '',
	            'el_position' => '',
	            'width' => '1/2'
	        ), $atts));
	        
	        $width = spb_translateColumnWidthToSpan($width);
	        
	        $output = '';
	        if ($spacer_id != "") {
	        $output .= '<div id="'.$spacer_id.'" data-spacername="'.$spacer_name.'" class="blank_spacer '.$width.' '.$el_class.'" style="height:'.$height.';">';
	        } else {
	        $output .= '<div class="blank_spacer '.$width.' '.$el_class.'" style="height:'.$height.';">';
	        }
	        $output .= '</div>'.$this->endBlockComment('divider')."\n";
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'blank_spacer',  array(
	    "name"		=> __("Blank Spacer", "swift-framework-admin"),
	    "base"		=> "blank_spacer",
	    "class"		=> "spb_blank_spacer",
		'icon'		=> 'spb-icon-spacer',
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "heading" => __("Height", "swift-framework-admin"),
	            "param_name" => "height",
	            "value" => __("30px", "swift-framework-admin"),
	            "description" => __("The height of the spacer, in px (required).", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Spacer ID", "swift-framework-admin"),
	            "param_name" => "spacer_id",
	            "value" => "",
	            "description" => __("If you wish to add an ID to the spacer, then add it here. You can then use the id to deep link to this section of the page. This is also used for one page navigation. NOTE: Make sure this is unique to the page!!", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Spacer Section Name", "swift-framework-admin"),
	            "param_name" => "spacer_name",
	            "value" => "",
	            "description" => __("This is used for the one page navigation, to identify the section below. If this is left blank, then the section will be left off of the one page navigation.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swift-framework-admin"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
	        )
	    ),
	    "js_callback" => array("init" => "spbBlankSpacerInitCallBack")
	) );
	
	
	/* MESSAGE BOX ASSET
	================================================== */
	class SwiftPageBuilderShortcode_spb_message extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	        $color = '';
	        extract(shortcode_atts(array(
	            'color' => 'alert-info',
	            'el_position' => ''
	        ), $atts));
	        $output = '';
	        if ($color == "alert-block") $color = "";
	        
	        $width = spb_translateColumnWidthToSpan("1/1");
	
	        $output .= '<div class="'.$width.'"><div class="alert spb_content_element '.$color.'"><div class="messagebox_text">'.spb_format_content($content).'</div></div></div>'.$this->endBlockComment('alert box')."\n";
	        //$output .= '<div class="spb_messagebox message '.$color.'"><div class="messagebox_text">'.spb_format_content($content).'</div></div>';
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_message', array(
	    "name"		=> __("Message Box", "swift-framework-admin"),
	    "base"		=> "spb_message",
	    "class"		=> "spb_messagebox spb_controls_top_right",
		"icon"		=> "spb-icon-message-box",
	    "wrapper_class" => "alert",
	    "controls"	=> "edit_popup_delete",
	    "params"	=> array(
	        array(
	            "type" => "dropdown",
	            "heading" => __("Message box type", "swift-framework-admin"),
	            "param_name" => "color",
	            "value" => array(__('Informational', "swift-framework-admin") => "alert-info", __('Warning', "swift-framework-admin") => "alert-block", __('Success', "swift-framework-admin") => "alert-success", __('Error', "swift-framework-admin") => "alert-error"),
	            "description" => __("Select message type.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "messagebox_text",
	            "heading" => __("Message text", "swift-framework-admin"),
	            "param_name" => "content",
	            "value" => __("<p>This is a message box. Click the edit button to edit this text.</p>", "swift-framework-admin"),
	            "description" => __("Message text.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swift-framework-admin"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
	        )
	    ),
	    "js_callback" => array("init" => "spbMessageInitCallBack")
	) );
	
	
	/* TOGGLE ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_spb_toggle extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	        $title = $el_class = $open = null;
	        extract(shortcode_atts(array(
	            'title' => __("Click to toggle", "swift-framework-admin"),
	            'el_class' => '',
	            'open' => 'false',
	            'el_position' => '',
	            'width' => '1/1'
	        ), $atts));
	        $output = '';
	        
	        $width = spb_translateColumnWidthToSpan($width);
	
	        $el_class = $this->getExtraClass($el_class);
	        $open = ( $open == 'true' ) ? ' spb_toggle_title_active' : '';
	        $toggle_class = ( $open == ' spb_toggle_title_active' ) ? ' spb_toggle_open' : '';
			$output .= '<div class="toggle-wrap '.$width.' '.$el_class.'">';
	        $output .= '<div class="spb_toggle'.$open.'">'.$title.'</div><div class="spb_toggle_content'.$toggle_class.'">'.spb_format_content($content).'</div>'.$this->endBlockComment('toggle')."\n";
	        $output .= '</div>';
			$output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_toggle', array(
	    "name"		=> __("Toggle", "swift-framework-admin"),
	    "base"		=> "spb_toggle",
	    "class"		=> "spb_faq",
		"icon"		=> "spb-icon-toggle",
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "holder" => "h4",
	            "class" => "toggle_title",
	            "heading" => __("Toggle title", "swift-framework-admin"),
	            "param_name" => "title",
	            "value" => __("Toggle title", "swift-framework-admin"),
	            "description" => __("Toggle block title.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "toggle_content",
	            "heading" => __("Toggle content", "swift-framework-admin"),
	            "param_name" => "content",
	            "value" => __("<p>The toggle content goes here, click the edit button to change this text.</p>", "swift-framework-admin"),
	            "description" => __("Toggle block content.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Default state", "swift-framework-admin"),
	            "param_name" => "open",
	            "value" => array(__("Closed", "swift-framework-admin") => "false", __("Open", "swift-framework-admin") => "true"),
	            "description" => __("Select this if you want toggle to be open by default.", "swift-framework-admin")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swift-framework-admin"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
	        )
	    )
	) );
	

?>