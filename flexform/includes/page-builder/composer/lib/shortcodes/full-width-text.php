<?php
	
class WPBakeryShortCode_fullwidth_text extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'alt_background'	=> 'none',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        $el_class .= ' wpb_text_column';
        
        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }
                        
        if ($alt_background == "none" || $sidebars != "no-sidebars") {
        $output .= "\n\t".'<div class="full-width-text wpb_content_element '.$width.$el_class.'">';
        } else {
        $output .= "\n\t".'<div class="full-width-text wpb_content_element alt-bg '.$alt_background.' '.$width.$el_class.'">';
        }

        $output .= "\n\t\t".'<div class="wpb_wrapper clearfix">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading wpb_text_heading">'.$title.'</h3></div>' : '';
        $output .= "\n\t\t\t".do_shortcode($content);
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

WPBMap::map( 'fullwidth_text', array(
    "name"		=> __("Text Block (Full Width)", "js_composer"),
    "base"		=> "fullwidth_text",
    "class"		=> "fullwidth_text",
    "icon"      => "icon-wpb-full-width-text",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "js_composer"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
	    ),
	    array(
	        "type" => "textarea_html",
	        "holder" => "div",
	        "class" => "",
	        "heading" => __("Text", "js_composer"),
	        "param_name" => "content",
	        "value" => __("<p>This is a text block. Click the edit button to change this text..</p>", "js_composer"),
	        "description" => __("Enter your content.", "js_composer")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Show alt background", "js_composer"),
	        "param_name" => "alt_background",
	        "value" => array(__("None", "js_composer") => "none", __("Alt 1", "js_composer") => "alt-one", __("Alt 2", "js_composer") => "alt-two", __("Alt 3", "js_composer") => "alt-three", __("Alt 4", "js_composer") => "alt-four", __("Alt 5", "js_composer") => "alt-five", __("Alt 6", "js_composer") => "alt-six", __("Alt 7", "js_composer") => "alt-seven", __("Alt 8", "js_composer") => "alt-eight", __("Alt 9", "js_composer") => "alt-nine", __("Alt 10", "js_composer") => "alt-ten"),
	        "description" => __("Show an alternative background around the asset. These can all be set in Flexform Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "js_composer")
	    ),
	    array(
	        "type" => "altbg_preview",
	        "heading" => __("Alt Background Preview", "js_composer"),
	        "param_name" => "altbg_preview",
	        "value" => "",
	        "description" => __("", "js_composer")
	    ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

?>