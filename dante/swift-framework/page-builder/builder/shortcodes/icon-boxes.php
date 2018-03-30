<?php

class SwiftPageBuilderShortcode_spb_icon_box extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $el_class = $text_color = $image_url = $image_object = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'character' => '',
        	'image' => '',
        	'animation' => '',
        	'animation_delay' => '',
        	'box_type' => '',
        	'color' => '',
            'link' => '',
            'target' => '',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));

        $output = '';
        
        if ($image != "") {
	        $img_url = wp_get_attachment_url( $image, 'full' );
	        $image_oject = array();
	        if ( function_exists('sf_aq_resize') ) {
		        $image_object = sf_aq_resize( $img_url, 70, 70, true, false);      
		    }
		    $image_url = $image_object[0];
        }
        
       	$icon_box_output = do_shortcode('[sf_iconbox character="'.$character.'" image="'.$image.'" color="standard" type="'.$box_type.'" title="'.$title.'" animation="'.$animation.'" animation_delay="'.$animation_delay.'" color="'.$color.'" link="'.$link.'" target="'.$target.'"]'.$content.'[/sf_iconbox]');
        		       	       				        
        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);

        $output .= "\n\t".'<div class="spb_icon_box '.$width.$el_class.'">';            
        $output .= "\n\t\t".'<div class="spb_wrapper box-wrap">';
        $output .= "\n\t\t\t".$icon_box_output;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        
        global $sf_include_carousel;
        $sf_include_carousel = true;
        
        return $output;
    }
}

$target_arr = array(__("Same window", "swift-framework-admin") => "_self", __("New window", "swift-framework-admin") => "_blank");

SPBMap::map( 'spb_icon_box', array(
    "name"		=> __("Icon Box", "swift-framework-admin"),
    "base"		=> "spb_icon_box",
    "class"		=> "",
    "icon"      => "spb-icon-icon-box",
    "wrapper_class" => "clearfix",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Icon Box title", "swift-framework-admin"),
    	    "param_name" => "title",
    	    "holder" => 'div',
    	    "value" => "",
    	    "description" => __("Icon Box title text.", "swift-framework-admin")
    	),
        array(
            "type" => "dropdown",
            "heading" => __("Icon Box Type", "swift-framework-admin"),
            "param_name" => "box_type",
            "value" => array(
            	__('Standard', "swift-framework-admin") => "standard",
            	__('Standard with Title Icon', "swift-framework-admin") => "standard-title",
            	__('Left Icon', "swift-framework-admin") => "left-icon",
            	__('Left Icon Alt', "swift-framework-admin") => "left-icon-alt",
            	__('Boxed One', "swift-framework-admin") => "boxed-one",
            	__('Boxed Two', "swift-framework-admin") => "boxed-two",
            	__('Boxed Three', "swift-framework-admin") => "boxed-three",
            	__('Boxed Four', "swift-framework-admin") => "boxed-four",
            	__('Animated', "swift-framework-admin") => "animated",
            ),
            "description" => __("Choose the type of icon box.", "swift-framework-admin")
        ),
        array(
            "type" => "icon-picker",
            "heading" => __("Icon Box Icon", "swift-framework-admin"),
            "param_name" => "image",
            "value" => "",
            "description" => ''
        ),
        array(
            "type" => "textfield",
            "heading" => __("Icon Box Character", "swift-framework-admin"),
            "param_name" => "character",
            "value" => "",
            "description" => __("Instead of an icon, you can optionally provide a single letter/digit here. NOTE: This will override the icon selection.", "swift-framework-admin")
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Text", "swift-framework-admin"),
            "param_name" => "content",
            "value" => __("click the edit button to change this text.", "swift-framework-admin"),
            "description" => __("Enter your content.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icon Box Color", "swift-framework-admin"),
            "param_name" => "color",
            "value" => array(
            	__('Standard', "swift-framework-admin") => "standard",
            	__('Accent', "swift-framework-admin") => "accent",
            	__('Secondary Accent', "swift-framework-admin") => "secondary-accent",
            	__('Icon One', "swift-framework-admin") => "icon-one",
            	__('Icon Two', "swift-framework-admin") => "icon-two",
            	__('Icon Three', "swift-framework-admin") => "icon-three",
            	__('Icon Four', "swift-framework-admin") => "icon-four"
            ),
            "description" => __("These colours are all set in the Color Customiser (link in the WP Admin Bar).", "swift-framework-admin")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Icon Box Link", "swift-framework-admin"),
            "param_name" => "link",
            "value" => "",
            "description" => __("If you would like, you can set a link here for the icon and title to link through to.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Link Target", "swift-framework-admin"),
            "param_name" => "target",
            "value" => $target_arr
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Intro Animation", "swift-framework-admin"),
            "param_name" => "animation",
            "value" => array(
            			__("None", "swift-framework-admin") => "none",
            			__("Fade In", "swift-framework-admin") => "fade-in",
            			__("Fade From Left", "swift-framework-admin") => "fade-from-left",
            			__("Fade From Right", "swift-framework-admin") => "fade-from-right",
            			__("Fade From Bottom", "swift-framework-admin") => "fade-from-bottom",
            			__("Move Up", "swift-framework-admin") => "move-up",
            			__("Grow", "swift-framework-admin") => "grow",
            			__("Fly", "swift-framework-admin") => "fly",
            			__("Helix", "swift-framework-admin") => "helix",
            			__("Flip", "swift-framework-admin") => "flip",
            			__("Pop Up", "swift-framework-admin") => "pop-up",
            			__("Spin", "swift-framework-admin") => "spin",
            			__("Flip X", "swift-framework-admin") => "flip-x",
            			__("Flip Y", "swift-framework-admin") => "flip-y"
            			),
            "description" => __("Select an intro animation for the icon box that will show it when it appears within the viewport.", "swift-framework-admin")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Animation Delay", "swift-framework-admin"),
            "param_name" => "animation_delay",
            "value" => "0",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
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