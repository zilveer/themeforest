<?php

// [quote foo="foo-value"]
function quote_func( $atts ) {
   extract( shortcode_atts( array(
      'quote' => '',
   ), $atts ) );
 
   return "<blockquote><p>{$quote}</p></blockquote>";
}
add_shortcode( 'quote', 'quote_func' );

add_action( 'vc_before_init', 'quote_integrateWithVC' );
function quote_integrateWithVC() {
   vc_map( array(
      "name" => __("Quote", "themesdojo"),
      "base" => "quote",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Quote", "themesdojo"),
            "param_name" => "quote",
            "value" => __("Quote", "themesdojo"),
            "description" => __("Add text here.", "themesdojo")
         )
      )
   ) );
}

?>