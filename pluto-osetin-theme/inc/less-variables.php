<?php

class my_less extends lessc {

  private $default_vars = array();

  function __construct() {
    parent::__construct();

    // Images path
    define('CSS_IMAGES_PATH', get_template_directory_uri()."/images/");
    $this->color_schemes_arr = array('al_pacino', 'blue_sky', 'dark_night', 'black_and_white', 'pinkman', 'space', 'grey_clouds', 'almond_milk', 'clear_white', 'sakura', 'mighty_slate', 'retro_orange');
  }

  public function load_defaults()
  {
    $scheme_vars = array();
    $color_scheme = $this->get_current_color_scheme();
    // load default color scheme settings
    require_once( get_template_directory() . "/inc/colors/default.php");
    if(!in_array($color_scheme, $this->color_schemes_arr)){
      $color_scheme = "blue_sky";
    }
    // load selected colors scheme settings
    require_once( get_template_directory() . "/inc/colors/{$color_scheme}.php" );
    // load custom variables you want to override
    require_once( get_template_directory() . '/extend/custom_scheme_vars.php' );
    $this->default_vars = $scheme_vars;
  }

  public static function get_current_color_scheme()
  {
    if(isset($_SESSION['color_scheme'])){
      $color_scheme = $_SESSION['color_scheme'];
    }else{
      $color_scheme = get_field('color_scheme', 'option');
    }
    return $color_scheme;
  }


  // **************************************************
  // **************************************************
  // **************************************************

  // SETTING LESS CSS VARIABLES FROM THE ADMIN OPTIONS

  // **************************************************
  // **************************************************
  // **************************************************


  function my_less_vars( $vars, $handle ) {
    $this->load_defaults();
    $vars = $this->default_vars;
    $vars[ 'plutoFolderPath' ] = "'".get_template_directory_uri()."'";
    $vars[ 'imagesPath' ] = "'".get_template_directory_uri()."/assets/images'";
    $vars[ 'fontsPath' ] = "'".get_template_directory_uri()."/assets/fonts'";
    $vars[ 'logoImageHeight' ] = $this->custom_or_default('logo_image_height', 'logoImageHeight', '40px');
    $vars[ 'topMenuLogoImageHeight' ] = $this->custom_or_default('top_menu_logo_image_height', 'topMenuLogoImageHeight', '20px');
    $vars[ 'fixedPostHeight' ] = '200px';

    if (get_field('logo_type', 'option') == 'text'){
      $vars[ 'logoFontSize' ] = $this->custom_or_default('logo_font_size', 'logoFontSize', '24px');
      $vars[ 'logoPadding' ] = '8px';
    }else{
      $vars[ 'logoFontSize' ] = '24px';
      $vars[ 'logoPadding' ] = '0px';
    }

    if(get_field('no_limit_single_post_width', 'option') != true){
      if(get_field('single_post_maximum_width', 'option')){
        $vars[ 'singlePostMaxWidth' ] = $this->add_px(get_field('single_post_maximum_width', 'option'));
      }else{
        $vars[ 'singlePostMaxWidth' ] = '900px';
      }
    }else{
      $vars[ 'singlePostMaxWidth' ] = 'auto';
    }

    // COLUMNS
    // without sidebar menu left right
    $vars[ 'wosmlr_columns_992_1200' ] = $this->custom_or_default('wosmlr_columns_992_1200', 'wosmlr_columns_992_1200', 2);
    $vars[ 'wosmlr_columns_1200_1600' ] = $this->custom_or_default('wosmlr_columns_1200_1600', 'wosmlr_columns_1200_1600', 3);
    $vars[ 'wosmlr_columns_1600_1750' ] = $this->custom_or_default('wosmlr_columns_1600_1750', 'wosmlr_columns_1600_1750', 4);
    $vars[ 'wosmlr_columns_1750_5000' ] = $this->custom_or_default('wosmlr_columns_1750_5000', 'wosmlr_columns_1750_5000', 5);

    // without sidebar menu top
    $vars[ 'wosmt_columns_768_992' ] = $this->custom_or_default('wosmt_columns_768_992', 'wosmt_columns_768_992', 2);
    $vars[ 'wosmt_columns_992_1200' ] = $this->custom_or_default('wosmt_columns_992_1200', 'wosmt_columns_992_1200', 3);
    $vars[ 'wosmt_columns_1200_1300' ] = $this->custom_or_default('wosmt_columns_1200_1300', 'wosmt_columns_1200_1300', 3);
    $vars[ 'wosmt_columns_1300_1600' ] = $this->custom_or_default('wosmt_columns_1300_1600', 'wosmt_columns_1300_1600', 4);
    $vars[ 'wosmt_columns_1600_5000' ] = $this->custom_or_default('wosmt_columns_1600_5000', 'wosmt_columns_1600_5000', 5);


    // with sidebar menu left right
    $vars[ 'wsmlr_columns_992_1600' ] = $this->custom_or_default('wsmlr_columns_992_1600', 'wsmlr_columns_992_1600', 2);
    $vars[ 'wsmlr_columns_1600_1750' ] = $this->custom_or_default('wsmlr_columns_1600_1750', 'wsmlr_columns_1600_1750', 3);
    $vars[ 'wsmlr_columns_1750_5000' ] = $this->custom_or_default('wsmlr_columns_1750_5000', 'wsmlr_columns_1750_5000', 4);

    // with sidebar menu top
    $vars[ 'wsmt_columns_992_1300' ] = $this->custom_or_default('wsmt_columns_992_1300', 'wsmt_columns_992_1300', 2);
    $vars[ 'wsmt_columns_1300_1600' ] = $this->custom_or_default('wsmt_columns_1300_1600', 'wsmt_columns_1300_1600', 3);
    $vars[ 'wsmt_columns_1600_1880' ] = $this->custom_or_default('wsmt_columns_1600_1880', 'wsmt_columns_1600_1880', 4);
    $vars[ 'wsmt_columns_1880_5000' ] = $this->custom_or_default('wsmt_columns_1880_5000', 'wsmt_columns_1880_5000', 5);

    // FONTS
    $vars[ 'baseFontSize' ]              = $this->add_px($this->custom_or_default('base_font_size' , 'baseFontSize'));
    $vars[ 'headingsBaseFontSize' ]      = $this->add_px($this->custom_or_default('headings_base_font_size' , 'headingsBaseFontSize'));
    $vars[ 'mainMenuFontSize' ]          = $this->add_px($this->custom_or_default('main_menu_font_size' , 'mainMenuFontSize'));
    $vars[ 'menuLogoFontSize' ]          = $this->add_px($this->custom_or_default('logo_font_size' , 'menuLogoFontSize'));

    $vars[ 'baseFontFamily' ]            = $this->custom_or_default('text_font_family' , 'baseFontFamily');
    $vars[ 'baseFontWeight' ]            = $this->custom_or_default('text_font_weight' , 'baseFontWeight');
    $vars[ 'headingsFontFamily' ]        = $this->custom_or_default('headings_font_family' , 'headingsFontFamily');
    $vars[ 'headingsFontWeight' ]        = $this->custom_or_default('headings_font_weight' , 'headingsFontWeight');
    $vars[ 'menuFontFamily' ]            = $this->custom_or_default('menu_font_family' , 'menuFontFamily');
    $vars[ 'menuFontWeight' ]            = $this->custom_or_default('menu_links_font_weight' , 'menuFontWeight');

    // Check if "allow override of color scheme" is checked in admin
    if(get_field('enable_custom_colors', 'option') == true) {

      $vars[ 'ajaxLoaderImageName' ] = $this->custom_or_default('ajax_loader_image_name', 'ajaxLoaderImageName', 'loader-blue');
      // BODY
      $vars[ 'bodyBackgroundImage' ]            = $this->custom_or_default_image_url('body_background_image', 'bodyBackgroundImage', 'none');
      $vars[ 'bodyBackgroundColor' ]            = $this->custom_or_default('body_background_color' , 'bodyBackgroundColor');
      if(get_field('body_background_color', 'option')){
        if(get_field('body_background_style', 'option') == 'dark'){
          $vars['bodyHeadingsColor'] = $this->my_mix($vars[ 'bodyBackgroundColor' ], '#fff', 30);
          $vars['bodyTextColor'] = $this->my_mix($vars[ 'bodyBackgroundColor' ], '#fff', 50);
        }else{
          $vars['bodyHeadingsColor'] = $this->my_mix($vars[ 'bodyBackgroundColor' ], '#111', 30);
          $vars['bodyTextColor'] = $this->my_mix($vars[ 'bodyBackgroundColor' ], '#111', 50);
        }
      }

      // MENU
      $vars[ 'menuBackgroundImage' ]            = $this->custom_or_default_image_url('menu_background_image' , 'menuBackgroundImage', 'none');
      $vars[ 'menuBackgroundColor' ]            = $this->custom_or_default('menu_background_color' , 'menuBackgroundColor');
      $vars[ 'menuTopBackgroundImage' ]         = $this->custom_or_default_image_url('menu_background_image' , 'menuTopBackgroundImage', 'none');
      $vars[ 'menuTopBackgroundColor' ]         = $this->custom_or_default('menu_background_color' , 'menuTopBackgroundColor');

      if( get_field('menu_background_style', 'option') == 'light' ){
        $vars[ 'menuShadow' ]                   = '0px 0px 8px 1px rgba(0,0,0,0.1), inset 0px 0px 2px 1px #fff';
        $vars[ 'menuBorderColor' ]              = $this->adjustBrightness( $vars[ 'menuBackgroundColor' ], -20);
        // MENU LIST
        $vars[ 'menuLinkColor' ]                = '#111';
        $vars[ 'menuLogoColor' ]                = '#111';
        $vars[ 'menuLinkColorActive' ]          = $this->my_mix($vars[ 'menuBackgroundColor' ], '#111', 30);

        // MENU SERCH
        $vars[ 'menuSearchFieldBackground' ]    = $this->adjustBrightness( $vars[ 'menuBackgroundColor' ], 20);
        $vars[ 'menuSearchFieldBorderColor' ]   = $this->adjustBrightness( $vars[ 'menuBackgroundColor' ], -20);
        $vars[ 'menuSearchFieldShadow' ]        = "1px 1px 2px 0px " . $this->adjustBrightness( $vars[ 'menuBackgroundColor' ], 20) . ", inset 0px 1px 1px 0px rgba(0,0,0,0.1)";
      }else{
        $vars[ 'menuShadow' ]                   = 'none';
        $vars[ 'menuBorderColor' ]              = 'none';
        // MENU LIST
        $vars[ 'menuLinkColor' ]                = $this->my_mix($vars[ 'menuBackgroundColor' ], '#fff', 35);
        $vars[ 'menuLogoColor' ]                = $this->my_mix($vars[ 'menuBackgroundColor' ], '#fff', 15);
        $vars[ 'menuLinkColorActive' ]          = $this->my_mix($vars[ 'menuBackgroundColor' ], '#fff', 10);

        // MENU SERCH
        $vars[ 'menuSearchFieldBackground' ]    = $this->adjustBrightness( $vars[ 'menuBackgroundColor' ], -40);
        $vars[ 'menuSearchFieldColor' ]         = '#fff';
        $vars[ 'menuSearchFieldBorderColor' ]   = $this->adjustBrightness( $vars[ 'menuBackgroundColor' ], 30);
        $vars[ 'menuSearchFieldShadow' ]        = 'none';
      }

      // MENU GRADIENT
      if( get_field('menu_background_color', 'option') ){
        $vars['menuBackgroundGradientFrom']     = $vars[ 'menuBackgroundColor' ];
        $vars['menuBackgroundGradientTo']       = $vars[ 'menuBackgroundColor' ];
        $vars['menuTopBackgroundGradientFrom']     = $vars[ 'menuBackgroundColor' ];
        $vars['menuTopBackgroundGradientTo']       = $vars[ 'menuBackgroundColor' ];
      }

      // HIGHLIGHT ACCENTS
      if(get_field('top_body_highlight', 'option')){
        $vars['menuTopHighlightBorder']         = '4px solid '.get_field('top_body_highlight', 'option');
        $vars['contentTopHighlightBorder']      = '4px solid '.get_field('top_body_highlight', 'option');
      }else{
        $vars['menuTopHighlightBorder']         = 'none';
        $vars['contentTopHighlightBorder']      = 'none';
      }
      $vars['highlightStrokesBackground']       = $this->custom_or_default('hightlight_accents' , 'highlightStrokesBackground');
      $vars['menuDividerBackgroundColor']       = $this->custom_or_default('hightlight_accents' , 'menuDividerBackgroundColor');


      // SIDEBAR
      $vars[ 'sidebarBackgroundImage' ]            = $this->custom_or_default_image_url('sidebar_background_image', 'sidebarBackgroundImage', 'none');
      $vars[ 'sidebarBackgroundColor' ]            = $this->custom_or_default('sidebar_background_color' , 'sidebarBackgroundColor');
      if( get_field('sidebar_background_color', 'option') ){
        $vars['sidebarBackgroundGradientFrom']     = $vars[ 'sidebarBackgroundColor' ];
        $vars['sidebarBackgroundGradientTo']       = $vars[ 'sidebarBackgroundColor' ];
        if( get_field('sidebar_background_style', 'option') == 'light' ){
          $vars[ 'sidebarShadow' ]                   = 'inset 2px 0px 3px 0px rgba(0,0,0,0.08), -1px 0px 2px 0px '.$this->adjustBrightness( $vars[ 'sidebarBackgroundColor' ], 20);
          $vars[ 'sidebarBorder' ]                   = '1px solid '.$this->adjustBrightness( $vars[ 'sidebarBackgroundColor' ], -30);
          $vars[ 'sidebarHeadingsColor' ]            = $this->my_mix($vars[ 'sidebarBackgroundColor' ], '#111', 30);
          $vars[ 'sidebarTextColor' ]                = $this->my_mix($vars[ 'sidebarBackgroundColor' ], '#111', 50);
        }else{
          $vars[ 'sidebarShadow' ]                   = 'none';
          $vars[ 'sidebarBorder' ]                   = 'none';
          $vars[ 'sidebarHeadingsColor' ]            = $this->my_mix($vars[ 'sidebarBackgroundColor' ], '#fff', 30);
          $vars[ 'sidebarTextColor' ]                = $this->my_mix($vars[ 'sidebarBackgroundColor' ], '#fff', 50);
        }
      }


      // POST
      $vars[ 'postBackground' ]                  = $this->custom_or_default('post_background', 'postBackground');
      $vars[ 'postMetaBackground' ]              = $this->custom_or_default('post_meta_background', 'postMetaBackground');
      $vars[ 'postMetaHeartBackground' ]         = $this->custom_or_default('post_meta_heart_background', 'postMetaHeartBackground');
      $vars[ 'postMetaHeartColor' ]              = $this->custom_or_default('post_meta_heart_color', 'postMetaHeartColor');
      $vars[ 'postMetaHeartColorHover' ]         = $this->custom_or_default('post_meta_heart_color_hover', 'postMetaHeartColorHover');
      $vars[ 'postTitleColor' ]                  = $this->custom_or_default('post_title_color', 'postTitleColor');
      $vars[ 'postContentColor' ]                = $this->custom_or_default('post_content_color', 'postContentColor');

      if( get_field('body_background_style', 'option') == 'light' ){
        $vars[ 'postBorder' ] = '1px solid '. $this->adjustBrightness( $vars[ 'bodyBackgroundColor' ], -40 );
      }else{
        $vars[ 'postBorder' ] = 'none';
      }
      $vars[ 'textColor' ]                      = $this->custom_or_default('text_color', 'textColor');

    }
    return $vars;
  }

  public function FunctionName($value='')
  {
      # code...
  }

  // Convert RGBA color to 6 digit HEX
  public function my_rgba_to_hex($rgba_arr){
    return "#".substr(parent::lib_rgbahex($rgba_arr), -6);
  }

  // Mix 2 colors
  public function my_mix($color1, $color2, $percent){
    return $this->my_rgba_to_hex(parent::lib_mix(array("list", ",", array( array("raw_color", $color1),  array("raw_color", $color2), array("number", $percent, "%")))));
  }


  function adjustBrightness($hex, $steps) {
    $hex = str_replace('#','',$hex);
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Format the hex color string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
    return '#'.$r_hex.$g_hex.$b_hex;
  }

  function getContrastYIQ($hexcolor, $dark = 'black', $light = 'white'){
    $r = hexdec(substr($hexcolor,0,2));
    $g = hexdec(substr($hexcolor,2,2));
    $b = hexdec(substr($hexcolor,4,2));
    $yiq = (($r*299)+($g*587)+($b*114))/1000;
    return ($yiq >= 128) ? $dark : $light;
  }

  function add_px($value = '14')
  {
    $value = str_replace('px', '', $value);
    $value = $value.'px';
    return $value;
  }

  function custom_or_default($custom_key, $default_key, $default_value = '#aaa'){
    $option_value = get_field("{$custom_key}", 'option');
    if(!empty($option_value)){
      return $option_value;
    }else{
      if(isset($this->default_vars["{$default_key}"]))
        return $this->default_vars["{$default_key}"];
      else
        return $default_value;
    }
  }

  function custom_or_default_image_url($custom_key, $default_key, $default_value = 'none'){
    $option_value = get_field("{$custom_key}", 'option');
    if(!empty($option_value)){
      return $this->wrap_in_url($option_value);
    }else{
      if(isset($this->default_vars["{$default_key}"]))
        return $this->default_vars["{$default_key}"];
      else
        return $default_value;
    }
  }

  public function wrap_in_url($value='none')
  {
    if($value == 'none'){
      return 'none';
    }else{
      return 'url('.$value.')';
    }
  }

  function custom_merged_or_default($custom_key, $default_key, $merge_string, $default_value = "4px solid #fff"){
    $option_value = get_field("{$custom_key}", 'option');
    if(!empty($option_value)){
      return $merge_string.$option_value;
    }else{
      if(isset($this->default_vars["{$default_key}"]))
        return $this->default_vars["{$default_key}"];
      else
        return $default_value;
    }
  }

  function adjust_custom_or_use_default($custom_key, $default_key, $steps){
    $option_value = get_field("{$custom_key}", 'option');
    if(!empty($option_value)){
      return $this->adjustBrightness($option_value, $steps);
    }else{
      return $this->default_vars["{$default_key}"];
    }
  }

  function adjust_mix_custom_or_use_default($custom_key, $default_key, $steps, $mix_color, $mix_value){
    $option_value = get_field("{$custom_key}", 'option');
    if(!empty($option_value)){
      $adjusted_color = $this->adjustBrightness($option_value, $steps);
      $mixed_color = $this->my_mix($mix_color, $adjusted_color, $mix_value);
      return $mixed_color;
    }else{
      return $this->default_vars["{$default_key}"];
    }
  }

}


// Hook to the ACF and set a variable to recompile a less css if options have been saved
function my_acf_save_post( $post_id ) {
  // stop function if not "options" page
  if( $post_id != "options" ) {
    return;
  }
  // Set a flag to recompile LESS on the next front end request.
  update_option( 'prefix_force_recompile', 'yes' );
}
// run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'my_acf_save_post', 20);

$my_less = new my_less;
// pass variables into all .less files
add_filter( 'less_vars', array($my_less, 'my_less_vars'), 10, 2 );

?>