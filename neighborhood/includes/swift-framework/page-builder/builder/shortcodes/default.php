<?php

    /*
    *
    *	Swift Page Builder - Default Shortcodes
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2014 - http://www.swiftideas.net
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
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading"><span>'.$icon_output.''.$title.'</span></h4>' : '';
	        } else {
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading spb_text_heading"><span>'.$title.'</span></h4>' : '';
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
	    "name"		=> __("Text Block", "swiftframework"),
	    "base"		=> "spb_text_block",
	    "class"		=> "",
	    "icon"      => "spb-icon-text-block",
	    "wrapper_class" => "clearfix",
	    "controls"	=> "full",
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
	    	    "heading" => __("Title icon", "swiftframework"),
	    	    "param_name" => "icon",
	    	    "value" => "",
	    	    "description" => __("Icon to the left of the title text. You can get the code from <a href='http://fortawesome.github.com/Font-Awesome/' target='_blank'>here</a>. E.g. fa-cloud", "swiftframework")
	    	),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __("Text", "swiftframework"),
	            "param_name" => "content",
	            "value" => "",
	            "description" => __("Enter your content.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Margin below widget", "swiftframework"),
	            "param_name" => "pb_margin_bottom",
	            "value" => array(__('No', "swiftframework") => "no", __('Yes', "swiftframework") => "yes"),
	            "description" => __("Add a bottom margin to the widget.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Border below widget", "swiftframework"),
	            "param_name" => "pb_border_bottom",
	            "value" => array(__('No', "swiftframework") => "no", __('Yes', "swiftframework") => "yes"),
	            "description" => __("Add a bottom border to the widget.", "swiftframework")
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
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading spb_text_heading"><span>'.$title.'</span></h4>' : '';
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
	    "name"		=> __("Boxed Content", "swiftframework"),
	    "base"		=> "boxed_content",
	    "class"		=> "",
	    "icon"      => "spb-icon-boxed-content",
	    "wrapper_class" => "clearfix",
	    "controls"	=> "full",
	    "params"	=> array(
	    	array(
	    	    "type" => "textfield",
	    	    "heading" => __("Widget title", "swiftframework"),
	    	    "param_name" => "title",
	    	    "value" => "",
	    	    "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
	    	),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __("Text", "swiftframework"),
	            "param_name" => "content",
	            "value" => __("<p>This is a boxed content block. Click the edit button to edit this text.</p>", "swiftframework"),
	            "description" => __("Enter your content.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Box type", "swiftframework"),
	            "param_name" => "type",
	            "value" => array(__('Coloured', "swiftframework") => "coloured", __('White with stroke', "swiftframework") => "whitestroke"),
	            "description" => __("Choose the surrounding box type for this content", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Custom background colour", "swiftframework"),
	            "param_name" => "custom_bg_colour",
	            "value" => "",
	            "description" => __("Provide a hex colour code here (include #). If blank, your chosen accent colour will be used.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Custom text colour", "swiftframework"),
	            "param_name" => "custom_text_colour",
	            "value" => "",
	            "description" => __("Provide a hex colour code here (include #) if you want to override the default (#ffffff).", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Margin below widget", "swiftframework"),
	            "param_name" => "pb_margin_bottom",
	            "value" => array(__('No', "swiftframework") => "no", __('Yes', "swiftframework") => "yes"),
	            "description" => __("Add a bottom margin to the widget.", "swiftframework")
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
	        $output .= '<div class="spb_divider '. $type .' spb_content_element alt-bg '.$width.' '.$el_class.'">';
	        } else {
	        $output .= '<div class="spb_divider '. $type .' spb_content_element '.$width.' '.$el_class.'">';
	        }
	        if ($type == "go_to_top") {
	        $output .= '<a class="animate-top" href="#">'. $text .'</a>';
	        } else if ($type == "go_to_top_icon1") {
	        $output .= '<a class="animate-top" href="#"><i class="fa-arrow-up"></i></a>';
	        } else if ($type == "go_to_top_icon2") {
	        $output .= '<a class="animate-top" href="#">'. $text .'<i class="fa-arrow-up"></i></a>';
	        }
	        $output .= '</div>'.$this->endBlockComment('divider')."\n";
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'divider',  array(
	    "name"		=> __("Divider", "swiftframework"),
	    "base"		=> "divider",
	    "class"		=> "spb_divider spb_controls_top_right",
		'icon'		=> 'spb-icon-divider',
	    "controls"	=> 'edit_popup_delete',
	    "params"	=> array(
	        array(
	            "type" => "dropdown",
	            "heading" => __("Divider type", "swiftframework"),
	            "param_name" => "type",
	            "value" => array(__('Standard', "swiftframework") => "standard", __('Thin', "swiftframework") => "thin", __('Dotted', "swiftframework") => "dotted", __('Go to top (text)', "swiftframework") => "go_to_top", __('Go to top (Icon 1)', "swiftframework") => "go_to_top_icon1", __('Go to top (Icon 2)', "swiftframework") => "go_to_top_icon2"),
	            "description" => __("Select divider type.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Go to top text", "swiftframework"),
	            "param_name" => "text",
	            "value" => __("Go to top", "swiftframework"),
	            "description" => __("The text for the 'Go to top (text)' divider type.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Full width", "swiftframework"),
	            "param_name" => "full_width",
	            "value" => array(__('No', "swiftframework") => "no", __('Yes', "swiftframework") => "yes"),
	            "description" => __("Select yes if you'd like the divider to be full width (only to be used with no sidebars, and with Standard/Thin/Dotted divider types).", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swiftframework"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
	        )
	    ),
	    "js_callback" => array("init" => "spbTextSeparatorInitCallBack")
	) );
	
	
	/* BLANK SPACER ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_blank_spacer extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	        $height = $el_class = '';
	        extract(shortcode_atts(array(
	            'height' => '',
	            'spacer_id' => '',
	            'el_class' => '',
	            'el_position' => ''
	        ), $atts));
	        
	        $width = spb_translateColumnWidthToSpan("1/1");
	        
	        $output = '';
	        if ($spacer_id != "") {
	        $output .= '<div id="'.$spacer_id.'" class="blank_spacer '.$width.' '.$el_class.'" style="height:'.$height.';">';
	        } else {
	        $output .= '<div class="blank_spacer '.$width.' '.$el_class.'" style="height:'.$height.';">';
	        }
	        $output .= '</div>'.$this->endBlockComment('divider')."\n";
	        
	        $output = $this->startRow($el_position, $width, true) . $output . $this->endRow($el_position, $width, true);
	        
	        return $output;
	    }
	}
	
	SPBMap::map( 'blank_spacer',  array(
	    "name"		=> __("Blank Spacer", "swiftframework"),
	    "base"		=> "blank_spacer",
	    "class"		=> "spb_blank_spacer spb_controls_top_right",
		'icon'		=> 'spb-icon-spacer',
	    "controls"	=> 'edit_popup_delete',
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "heading" => __("Height", "swiftframework"),
	            "param_name" => "height",
	            "value" => __("30px", "swiftframework"),
	            "description" => __("The height of the spacer, in px (required).", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Spacer ID", "swiftframework"),
	            "param_name" => "spacer_id",
	            "value" => "",
	            "description" => __("If you wish to add an ID to the spacer, then add it here. You can then use the id to deep link to this section of the page. NOTE: Make sure this is unique to the page!!", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swiftframework"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
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
	            'el_position' => '',
	            'width' => '1/1'
	        ), $atts));
	        $output = '';
	        
	        $width = spb_translateColumnWidthToSpan($width);
	        
	        if ($color == "alert-block") $color = "";
	        
	        $width = spb_translateColumnWidthToSpan("1/1");
	
	        $output .= '<div class="alert spb_content_element '.$width.' '.$color.'"><div class="messagebox_text">'.spb_js_remove_wpautop($content).'</div></div>'.$this->endBlockComment('alert box')."\n";
	        //$output .= '<div class="spb_messagebox message '.$color.'"><div class="messagebox_text">'.spb_js_remove_wpautop($content).'</div></div>';
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_message', array(
	    "name"		=> __("Message Box", "swiftframework"),
	    "base"		=> "spb_message",
	    "class"		=> "spb_messagebox spb_controls_top_right",
		"icon"		=> "spb-icon-message-box",
	    "wrapper_class" => "alert",
	    "controls"	=> "edit_popup_delete",
	    "params"	=> array(
	        array(
	            "type" => "dropdown",
	            "heading" => __("Message box type", "swiftframework"),
	            "param_name" => "color",
	            "value" => array(__('Informational', "swiftframework") => "alert-info", __('Warning', "swiftframework") => "alert-block", __('Success', "swiftframework") => "alert-success", __('Error', "swiftframework") => "alert-error"),
	            "description" => __("Select message type.", "swiftframework")
	        ),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "messagebox_text",
	            "heading" => __("Message text", "swiftframework"),
	            "param_name" => "content",
	            "value" => __("<p>This is a message box. Click the edit button to edit this text.</p>", "swiftframework"),
	            "description" => __("Message text.", "swiftframework")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swiftframework"),
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
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
	            'title' => __("Click to toggle", "swiftframework"),
	            'el_class' => '',
	            'open' => 'false',
	            'el_position' => '',
	            'width' => '1/1'
	        ), $atts));
	        $output = '';
	        
	        $width = spb_translateColumnWidthToSpan($width);
	
	        $el_class = $this->getExtraClass($el_class);
	        $open = ( $open == 'true' ) ? ' spb_toggle_title_active' : '';
	        $el_class .= ( $open == ' spb_toggle_title_active' ) ? ' spb_toggle_open' : '';
			$output .= '<div class="toggle-wrap '.$width.'">';
	        $output .= '<div class="spb_toggle'.$open.'">'.$title.'</div><div class="spb_toggle_content'.$el_class.'">'.spb_js_remove_wpautop($content).'</div>'.$this->endBlockComment('toggle')."\n";
	        $output .= '</div>';
			$output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_toggle', array(
	    "name"		=> __("Toggle", "swiftframework"),
	    "base"		=> "spb_toggle",
	    "class"		=> "spb_faq",
		"icon"		=> "spb-icon-toggle",
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "holder" => "h4",
	            "class" => "toggle_title",
	            "heading" => __("Toggle title", "swiftframework"),
	            "param_name" => "title",
	            "value" => __("Toggle title", "swiftframework"),
	            "description" => __("Toggle block title.", "swiftframework")
	        ),
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "class" => "toggle_content",
	            "heading" => __("Toggle content", "swiftframework"),
	            "param_name" => "content",
	            "value" => __("<p>The toggle content goes here, click the edit button to change this text.</p>", "swiftframework"),
	            "description" => __("Toggle block content.", "swiftframework")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Default state", "swiftframework"),
	            "param_name" => "open",
	            "value" => array(__("Closed", "swiftframework") => "false", __("Open", "swiftframework") => "true"),
	            "description" => __("Select this if you want toggle to be open by default.", "swiftframework")
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

?>