<?php

class SwiftPageBuilderShortcode_codesnippet extends SwiftPageBuilderShortcode {

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
        $width = spb_translateColumnWidthToSpan($width);
                
        if ($pb_margin_bottom == "yes") {
        $el_class .= ' pb-margin-bottom';
        }

        $output .= "\n\t".'<div class="spb_codesnippet_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h4 class="spb_heading spb_codesnippet_heading"><span>'.$title.'</span></h4>' : '';
        $output .= "\n\t\t\t<code>".spb_js_remove_wpautop($content)."</code>";
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'codesnippet', array(
    "name"		=> __("Code Snippet", "swiftframework"),
    "base"		=> "codesnippet",
    "class"		=> "spb_codesnippet",
    "icon"      => "spb-icon-code-snippet",
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
	        "value" => __("<p>Add your code snippet here.</p>", "swiftframework"),
	        "description" => __("Enter your code snippet.", "swiftframework")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Margin below widget", "swiftframework"),
	        "param_name" => "pb_margin_bottom",
	        "value" => array(__('Yes', "swiftframework") => "yes", __('No', "swiftframework") => "no"),
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

?>