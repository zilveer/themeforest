<?php

add_filter('su/data/shortcodes', 'iconShortcode');

/**
* Filter to modify original shortcodes data and add custom shortcodes
*
* @param array $shortcodes Original plugin shortcodes
* @return array Modified array
*/
function iconShortcode ( $shortcodes ) {
        // Add new shortcode
        $shortcodes['icon'] = array(
            // Shortcode name
            'name' => __( 'Inline Icon', 'textdomain' ),
            // Shortcode type. Can be 'wrap' or 'single'
            // Example: [b]this is wrapped[/b], [this_is_single]
            'type' => 'wrap',
            // Shortcode group. Can be 'content', 'box', 'media' or 'other'. Groups can be mixed, for example 'content box'
            'group' => 'content',
            // List of shortcode params (attributes)
            'atts' => array(
                // Style attribute
                'style' => array(
                    // Attribute type. Can be 'select', 'color', 'switch', 'gallery' or 'text'
                    'type' => 'select',
                    // Available values
                    'values' => array(
                        'default' => __( 'Default', 'textdomain' ),
                        'small' => __( 'Small', 'textdomain' )
                    ),
                    // Default value
                    'default' => 'default',
                    // Attribute name
                    'name' => __( 'Style', 'textdomain' ),
                    // Attribute description
                    'desc' => __( 'Inline Icon style', 'textdomain' )
                ),
                'icon' => array(
                    'type' => 'icon',
                    'default' => '',
                    'name' => __( 'Icon', 'su' ),
                    'desc' => __( 'You can upload custom icon for this button or pick a built-in icon', 'su' )
                ),
                'icon_color' => array(
                    'type' => 'color',
                    'default' => '#FFFFFF',
                    'name' => __( 'Icon color', 'su' ),
                    'desc' => __( 'This color will be applied to the selected icon. Does not works with uploaded icons', 'su' )
                )
            ),
            // Example of usage for cheatsheet
            'usage' => '[icon icon="icon: home"]Content[/icon]<br/>[icon icon="icon: home" icon_color="#666666"] Content [/icon]',
            // Default content for generator (for wrap-type shortcodes)
            'content' => __( 'Inline Icon text', 'textdomain' ),
            // Shortcode description for cheatsheet and generator
            'desc' => __( 'Insert fontawesome font icon with any text', 'textdomain' ),
            // Custom icon url for Generator (example)
            'icon' => 'star',
            // Custom demo image url for cheatsheet (example)
            'demo' => 'star',
            // Name of custom shortcode function
            'function' => 'bdt_icon'
        );
        // Return modified data
        return $shortcodes;
    }

/**
* Heading2 shortcode function
*
* @param array $atts Shortcode attributes
* @param string $content Shortcode content
* @return string Shortcode markup
*/

function bdt_icon($atts = null, $content = null) {
    $atts = shortcode_atts( array(
        'icon' => 'icon: star',
        'icon_color' => ''
    ), $atts, 'bdt_icon' );

    if ($atts['icon_color'] != false ) {
        $atts['icon_color'] = 'style="color:' . $atts['icon_color'] . '"';
    }

    $atts['icon'] = '<i class="fa fa-' . trim( str_replace( 'icon:', '', $atts['icon'] ) ) . '"' . $atts['icon_color'] . '></i>';
    su_query_asset( 'css', 'font-awesome' );

    return $atts['icon'] . ' ' . do_shortcode( $content );
}



/*add_filter( 'su/data/shortcodes', 'add_custom_button_style' );


function add_custom_button_style( $shortcodes ) {
    // You can remove all presets before adding custom style
    $shortcodes['button']['atts']['style']['values'] = array();
    // Add new button style
    $shortcodes['button']['atts']['style']['values']['custom-style'] = 'Custom style';
    // You can even remove unwanted attributes like links target
    unset( $shortcodes['button']['atts']['target'] );
    // Return modified data
    return $shortcodes;
}*/


/* Pricing Table -----------------------------------------------------------------------------------*/

if (!function_exists('sc_plan')) {
  function sc_plan( $atts, $content = null ) {
      extract(shortcode_atts(array(
      'name'      => 'Premium',
      'link'      => 'http://www.google.com',
      'linkname'      => 'Sign Up',
      'price'      => '39.00$',
      'per'      => false,
      'color'    => false, // grey, green, red, blue
      'featured' => ''
      ), $atts));
      
      if($featured != '') {
        $return = "<div class='featured' style='background-color:".$color.";'><span class='featured-text'>".$featured."</span><span class='feature-corner' style='background-color:".$color.";'></span></div>";
      }
      else{
        $return = "";
      }

      if($per != false) {
        $return3 = "".$per."";
      }
      else{
        $return3 = "";
      }
      $return5 = "";
      if($color != false) {
        if($featured == true){
          $return5 = "style='color:".$color.";' ";
        }
       // $return4 = "style='color:".$color.";' ";
      }
      else{
        $return4 = "";
      }
    
    $out = "
      <div class='plan'>  
        ".$return."
        <div class='plan-head'>
          <h3>".$name."</h3>
          <div class='price'>".$price." <span>".$return3."</span></div></div>
          <ul>" .do_shortcode($content). "</ul><div class='signup'><a class='readon' href='".$link."'>".$linkname."</a></div>
      </div>";
      return $out;
  }
}

if(function_exists('sc_plan')) {
  add_shortcode('plan', 'sc_plan');
}

/*-----------------------------------------------------------------------------------*/
if(!function_exists('sc_pricing')) {
  function sc_pricing( $atts, $content = null ) {
      extract(shortcode_atts(array(
          'col'      => '3'
      ), $atts));
    
    $out = "<div class='pricing-table col-".$col."'>" .do_shortcode($content). "</div><div class='clear'></div>";
      return $out;
  }
}

if(function_exists('sc_pricing')) {
  add_shortcode('pricing-table', 'sc_pricing');
}