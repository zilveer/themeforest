<?php
add_action('admin_init', 'stag_styling_options');
function stag_styling_options(){

  $styling_options['description'] = __('Configure the visual appearance of your theme, or insert any custom CSS. You can also edit your site color scheme using <a href="'.admin_url('customize.php').'">WordPress Live Customizer</a>, if applicable.', 'stag');


  $styling_options[] = array(
    'title' => __('Main Layout', 'stag'),
    'desc'  => __('Select main content and sidebar alignment.', 'stag'),
    'type'  => 'radio',
    'id'    => 'style_main_layout',
    'val'   => 'layout-2cr',
    'options' => array(
      'layout-1cf' => __('1 Column (full)', 'stag'),
      'layout-2cr' => __('2 Columns (right)', 'stag'),
      'layout-2cl' => __('2 Columns (left)', 'stag')
    )
  );

  $styling_options[] = array(
    'title' => __('Background Color', 'stag'),
    'desc'  => __('Choose the background color of your site', 'stag'),
    'type'  => 'color',
    'id'    => 'style_background_color',
    'val'   => '#f5f5f5'
  );

  $styling_options[] = array(
    'title' => __('Accent Color', 'stag'),
    'desc'  => __('Choose the accent color of your site', 'stag'),
    'type'  => 'color',
    'id'    => 'style_accent_color',
    'val'   => '#69ae43'
  );

  $styling_options[] = array(
    'title' => __('Body Font', 'stag'),
    'desc'  => __('Quickly add a custom Google Font for body from <a href="http://www.google.com/webfonts/" target="_blank">Google Font Directory.</a><br>
               <code>Example font name: "Source Sans Pro"</code>, for including font weights type <code>Source Sans Pro:400,700,400italic</code>.', 'stag'),
    'type'  => 'text',
    'id'    => 'style_body_font',
    'val'   => 'Open Sans:300,400,700'
  );

  $styling_options[] = array(
    'title' => __('Heading Font', 'stag'),
    'desc'  => __('Quickly add a custom Google Font for Headings from <a href="http://www.google.com/webfonts/" target="_blank">Google Font Directory.</a><br>
               For font type: <code>"Source Sans Pro"</code>, for including specific font weights <code>Source Sans Pro:400,700,400italic</code>.', 'stag'),
    'type'  => 'text',
    'id'    => 'style_heading_font',
    'val'   => ''
  );

  $styling_options[] = array(
    'title' => __( 'Google Font Script', 'stag' ),
    'desc' => __( 'Choose the character sets you want for Google Web Font', 'stag' ),
    'type' => 'select',
    'id' => 'style_font_script',
    'val' => 'latin',
    'options' => array(
      'cyrillic' => __( 'Cyrillic', 'stag' ),
      'cyrillic-ext' => __( 'Cyrillic Extended', 'stag' ),
      'greek' => __( 'Greek', 'stag' ),
      'greek-ext' => __( 'Greek Extended', 'stag' ),
      'khmer' => __( 'Khmer', 'stag' ),
      'latin' => __( 'Latin', 'stag' ),
      'latin,latin-ext' => __( 'Latin Extended', 'stag' ),
      'vietnamese' => __( 'Vietnamese', 'stag' ),
    )
  );

  $styling_options[] = array(
    'title' => __('Custom CSS', 'stag'),
    'desc'  => __('Quickly add some CSS to your theme by adding it to this block.', 'stag'),
    'type'  => 'textarea',
    'id'  => 'style_custom_css',
  );

  stag_add_framework_page( 'Styling Options', $styling_options, 10 );
}



/* Output main layout -------------------------------*/
function stag_style_main_layout($classes) {
  $classes[] = stag_get_option('style_main_layout');;
  return $classes;
}
add_filter( 'body_class', 'stag_style_main_layout' );

/* Custom Stylesheet Output -----------------------------------------------*/
function stag_custom_css($content){
  $stag_values = get_option( 'stag_framework_values' );
  if( array_key_exists( 'style_custom_css', $stag_values ) && $stag_values['style_custom_css'] != '' ){
    $content .= '/* Custom CSS */' . "\n";
    $content .= stripslashes($stag_values['style_custom_css']);
    $content .= "\n\n";
  }
  return $content;
}
add_filter( 'stag_custom_styles', 'stag_custom_css' );


function stag_google_font_url() {

  $body_font = stag_get_option('style_body_font');
  $heading_font = stag_get_option('style_heading_font');

  if( $body_font === '' && $heading_font === '' )
    return;

  $fonts_url = '';
  $font_families = array();

  $font_families[] = $body_font;
  $font_families[] = $heading_font;

  $query_args = array(
    'family' => urlencode( implode( '|', array_filter($font_families) ) ),
    'subset' => urlencode( stag_get_option('style_font_script') )
  );

	$protocol = ( is_ssl() ) ? 'https:' : 'http:';

	$fonts_url = add_query_arg( $query_args, $protocol . "//fonts.googleapis.com/css" );

  return esc_url( $fonts_url );
}

if( ! function_exists( 'stag_remove_trailing_char' ) ) {
/**
 * Check if there is any space
 */
function stag_remove_trailing_char( $string, $char = ' ' ) {
  $offset = strlen( $string ) - 1;
  $trailing_char = strpos( $string, $char, $offset );
  if( $trailing_char )
    $string = substr( $string, 0, -1 );
  return $string;
}
}

function stag_get_font_face( $option ) {
  $stack = null;
  if( $option !=  '') {
    $option = explode( ':', $option );
    $name = stag_remove_trailing_char( $option[0] );
    $stack = $name;
  } else {
    $stack = '';
  }
  return $stack;
}


function stag_user_styles_push($content){
  $bodyfont = stag_get_option('style_body_font');
  $body_font_output = stag_get_font_face($bodyfont);

  $headingfont = stag_get_option('style_heading_font');
  $heading_font_output = stag_get_font_face($headingfont);

  $background_color = stag_get_option('style_background_color');

  $output = "/* Custom Styles Output */\n";

  if($background_color != ''){
    $output .= "body{ background-color: $background_color; }\n";
  }

  if($bodyfont != ''){
    $output .= "body{ font-family: '$body_font_output'; }\n";
  }

  if($headingfont != ''){
    $output .= "\nh1, h2, h3, h4, h5, h6, .heading{";
    $output .= "font-family: '$heading_font_output';";
    $output .= "}\n";
  }

  $accent_color = stag_get_option('style_accent_color');
  $output .= "a, .stag-twitter a, .accent-color, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6, .footer .twitter-feeds li a { color: {$accent_color}; }";
  $output .= ".accent-background, .more-link, .button, .page-numbers, .nav-links > div, input[type=submit], button, .button { background-color: {$accent_color}; }";

  $portfolio_bg_color = stag_get_option('portfolio_background_color');
  $portfolio_bg_opacity = stag_get_option('portfolio_background_opacity');
  $portfolio_bg_opacity = intval($portfolio_bg_opacity)/100;
  if( $portfolio_bg_color != '' ){
    $output .= ".single-portfolio .custom-background.universal { background-color: {$portfolio_bg_color} !important;}";
    $output .= ".page-template-template-portfolio-php .custom-background.universal { background-color: {$portfolio_bg_color} !important;}";
  } else {
    $output .= ".single-portfolio .custom-background.universal { background-color: transparent !important !important;}";
    $output .= ".page-template-template-portfolio-php .custom-background.universal { background-color: transparent !important !important;}";
  }

  if( $portfolio_bg_opacity != '' ){
    $output .= ".single-portfolio .custom-background.universal .backstretch { opacity: {$portfolio_bg_opacity};}";
    $output .= ".page-template-template-portfolio-php .custom-background.universal .backstretch { opacity: {$portfolio_bg_opacity};}";
  } else {
    $output .= ".single-portfolio .custom-background.universal .backstretch { opacity: 1 !important;}";
    $output .= ".page-template-template-portfolio-php .custom-background.universal .backstretch { opacity: 1 !important;}";
  }


  $content .= $output."\n";
  return $content;
}
add_action( 'stag_custom_styles', 'stag_user_styles_push', 10);
