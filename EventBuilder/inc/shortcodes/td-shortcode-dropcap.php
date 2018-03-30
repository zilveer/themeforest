<?php

// [dropcap foo="foo-value"]
function dropcap_func( $atts ) {
   extract( shortcode_atts( array(
      'dropcap' => '',
   ), $atts ) );
 
   return "<span class='dropcap'>{$dropcap}</span>";
}
add_shortcode( 'dropcap', 'dropcap_func' );

add_action( 'vc_before_init', 'dropcap_integrateWithVC' );
function dropcap_integrateWithVC() {
   vc_map( array(
      "name" => __("Dropcap", "themesdojo"),
      "base" => "dropcap",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Character", "themesdojo"),
            "param_name" => "character",
            "value" => __("Character", "themesdojo"),
            "description" => __("Add character here.", "themesdojo")
         )
      )
   ) );
}

?>