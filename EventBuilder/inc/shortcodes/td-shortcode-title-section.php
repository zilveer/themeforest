<?php

// [title_section foo="foo-value"]
function title_section_func( $atts ) {
   extract( shortcode_atts( array(
      'title' => '',
      'subtitle' => '',
   ), $atts ) );
 
   return "<div class='section-header'>
               <h2>{$title}</h2>
               <h4>{$subtitle}</h4>
           </div>";
}
add_shortcode( 'title_section', 'title_section_func' );

add_action( 'vc_before_init', 'title_section_integrateWithVC' );
function title_section_integrateWithVC() {
   vc_map( array(
      "name" => __("Title Section", "themesdojo"),
      "base" => "title_section",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", "themesdojo"),
            "param_name" => "title",
            "value" => __("Title", "themesdojo"),
            "description" => __("Add title here.", "themesdojo")
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Subtitle", "themesdojo"),
            "param_name" => "subtitle",
            "value" => __("Awesome section description goes here.", "themesdojo"),
            "description" => __("Description for foo param.", "themesdojo")
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Align", "themesdojo"),
            "param_name" => "text_align",
            "value" => array(
               "Left" => "left",
               "Center" => "center",
               "Right" => "right"
            ),
            "description" => __("Select text align.", "themesdojo")
         )
      )
   ) );
}

?>