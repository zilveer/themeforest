<?php

class WPBakeryShortCode_codesnippet extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $pb_margin_bottom = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'pb_margin_bottom'	=> '',
            'el_class' => '',
            'el_position' => '',
            'width' => '1'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);
                
        if ($pb_margin_bottom == "yes") {
        $el_class .= ' pb-margin-bottom';
        }

        $output .= "\n\t".'<div class="wpb_codesnippet_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading wpb_codesnippet_heading"><span>'.$title.'</span></h3></div>' : '';
        $output .= "\n\t\t\t<code>".wpb_js_remove_wpautop($content)."</code>";
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

WPBMap::map( 'codesnippet', array(
    "name"		=> __("Code Snippet", "js_composer"),
    "base"		=> "codesnippet",
    "class"		=> "wpb_codesnippet",
    "icon"      => "icon-wpb-code-snippet",
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
	        "value" => __("<p>Add your code snippet here.</p>", "js_composer"),
	        "description" => __("Enter your code snippet.", "js_composer")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Margin below widget", "js_composer"),
	        "param_name" => "pb_margin_bottom",
	        "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
	        "description" => __("Add a bottom margin to the widget.", "js_composer")
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