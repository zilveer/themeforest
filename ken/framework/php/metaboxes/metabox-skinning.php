<?php

$config  = array(
  'title' => sprintf( '%s Styling Options', THEME_NAME ),
  'id' => 'mk-metaboxes-styling',
  'pages' => array(
    'page',
    'post',
    'portfolio'
  ),
  'callback' => '',
  'context' => 'normal',
  'priority' => 'core'
);
$options = array(

  array(
    "name" => __( "Custom Settings", "mk_framework" ),
    "subtitle" => __( "You should enable this option if you want to override global background values defined in Theme Settings. Please note that this option will only apply to background selector and layout selector not other options int this metabox.", "mk_framework" ),
    "id" => "_custom_bg",
    "default" => 'false',
    "type" => "toggle"
  ),

  array(
      "name" => __("Upload Logo (Dark & default)", "mk_framework"),
      "desc" => __("This logo will be used when transparent header is enabled and your header skin is dark.", "mk_framework"),
      "id" => "logo",
      "default" => "",
      "type" => "upload"
  ),
  array(
      "name" => __("Upload Retina Logo (Dark & default)", "mk_framework"),
      "desc" => __("Use this option if you want your logo appear crystal clean in retina devices(eg. macbook retina, ipad, iphone).", "mk_framework"),
      "id" => "logo_retina",
      "default" => "",
      "type" => "upload"
  ),
  array(
      "name" => __("Upload Logo (Light Skin)", "mk_framework"),
      "desc" => __("This logo will be used when transparent header is enabled and your header is light skin.", "mk_framework"),
      "id" => "light_logo",
      "default" => "",
      "type" => "upload"
  ),
  array(
      "name" => __("Upload Retina Logo (Light Skin)", "mk_framework"),
      "desc" => __("Use this option if you want your logo appear crystal clean in retina devices(eg. macbook retina, ipad, iphone).", "mk_framework"),
      "id" => "light_logo_retina",
      "default" => "",
      "type" => "upload"
  ),

  array(
      "name" => __("Upload Logo (Mobile Version)", "mk_framework"),
      "desc" => __("Use this option to change your logo for mobile devices if your logo width is quite long to fit in mobile device screen.", "mk_framework"),
      "id" => "responsive_logo",
      "default" => "",
      "type" => "upload"
  ),
  array(
      "name" => __("Upload Retina Logo (Mobile Version)", "mk_framework"),
      "desc" => __("Use this option if you want your logo appear crystal clean in retina devices(eg. macbook retina, ipad, iphone).", "mk_framework"),
      "id" => "responsive_logo_retina",
      "default" => "",
      "type" => "upload"
  ),

  array(
    "name" => __( "Choose Layout", 'mk_framework' ),
    "subtitle" => __( "Choose between a full or a boxed layout to set how your website's layout will look like.", 'mk_framework' ),
    "id" => "background_selector_orientation",
    "default" => "full",
    "options" => array(
      "boxed" => 'boxed-layout',
      "full" => 'full-width-layout',
    ),
    "type" => "visual_selector"
  ),

  array(
    "name" => __( "Boxed Layout Shadow", "mk_framework" ),
    "subtitle" => __( "", "mk_framework" ),
    "id" => "boxed_layout_shadow",
    "default" => "false",
    "type" => "toggle"
  ),


  array(
    "name" => __( "Background color & texture", 'mk_framework' ),
    "subtitle" => __( "Please click on the different sections to modify their backgrounds.", 'mk_framework' ),
    "id"=> 'general_backgounds',
    "type" => "general_background_selector"
  ),


  array(
    "id"=>"body_color",
    "default"=> "#fff",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"body_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"body_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_cover",
    "default"=> "false",
    "type"=> 'hidden_input',
  ),




  array(
    "id"=>"page_color",
    "default"=> "#fff",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"page_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"page_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"page_cover",
    "default"=> "false",
    "type"=> 'hidden_input',
  ),








  array(
    "id"=>"header_color",
    "default"=> "#fff",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"header_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"header_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),
  array(
    "id"=>"header_cover",
    "default"=> "false",
    "type"=> 'hidden_input',
  ),




  array(
    "id"=>"banner_color",
    "default"=> "#fafafa",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"banner_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"banner_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"banner_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"banner_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"banner_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),
  array(
    "id"=>"banner_cover",
    "default"=> "false",
    "type"=> 'hidden_input',
  ),




  array(
    "id"=>"footer_color",
    "default"=> "#191919",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"footer_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"footer_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),
  array(
    "id"=>"footer_cover",
    "default"=> "false",
    "type"=> 'hidden_input',
  ),


  array(
    "name" => __( "Page Title Effect", "mk_framework" ),
    "subtitle" => __( "Scroll animations for your page title area", "mk_framework" ),
    "desc" => __( "", "mk_framework" ),
    "id" => "_page_title_intro",
    "default" => 'none',
    "placeholder" => 'false',
    "width" => 400,
    "options" => array(
      "none" => __('-- No Animation', "mk_framework" ),
      "parallax" => __('Parallax', "mk_framework" ),
      "parallaxZoomOut" => __('Parallax Zoom Out', "mk_framework" ),
      "gradient" => __('Gradient', "mk_framework" ),
    ),
    "type" => "select"
  ),

  array(
    "name" => __( "Page Title Section Padding", "mk_framework" ),
    "subtitle" => __( "Default : 40px", "mk_framework" ),
    "desc" => __( "This padding will be applied to both top and bottom of the page title section", "mk_framework" ),
    "id" => "_page_title_padding",
    "default" => "40",
    "min" => "0",
    "max" => "500",
    "step" => "1",
    "unit" => 'px',
    "type" => "range"
  ),

  array(
    "name" => __( "Page Title Section Full Height", "mk_framework" ),
    "subtitle" => __( "", "mk_framework" ),
    "desc" => __( "", "mk_framework" ),
    "id" => "_page_title_fullHeight",
    "default" => "false",
    "type" => "toggle"
  ),

  array(
    "name" => __( "Page Title Align", "mk_framework" ),
    "subtitle" => __( "Using this option you can align the page title text.", "mk_framework" ),
    "desc" => __( "", "mk_framework" ),
    "id" => "_page_title_align",
    "default" => 'left',
    "placeholder" => 'false',
    "width" => 400,
    "options" => array(
      "left" => __('Title on Left', "mk_framework" ),
      "center" => __('Title on Center', "mk_framework" ),
      "right" => __('Title on Right', "mk_framework" ),
    ),
    "type" => "select"
  ),

  array(
    "name" => __( "Page Title Text Size", "mk_framework" ),
    "subtitle" => __( "Default : 18px", "mk_framework" ),
    "desc" => __( "", "mk_framework" ),
    "id" => "_page_title_size",
    "default" => "18",
    "min" => "14",
    "max" => "100",
    "step" => "1",
    "unit" => 'px',
    "type" => "range"
  ),
  array(
    "name" => __( "Page Title Letter Spacing", "mk_framework" ),
    "subtitle" => __( "Default : 0px", "mk_framework" ),
    "desc" => __( "Space between each letter", "mk_framework" ),
    "id" => "_page_title_letter_spacing",
    "default" => "0",
    "min" => "0",
    "max" => "10",
    "step" => "1",
    "unit" => 'px',
    "type" => "range"
  ),

  array(
    "name" => __( "Page Title Font Weight", "mk_framework" ),
    "subtitle" => __( "", "mk_framework" ),
    "desc" => __( "", "mk_framework" ),
    "id" => "_page_title_weight",
    "default" => '',
    "options" => array(
            "600"=>__('Semi Bold', "mk_framework"),
            "bold" => __('Bold', "mk_framework"),
            "bolder" => __('Bolder', "mk_framework"),
            "normal" => __('Normal', "mk_framework"),
            "300" => __('Light', "mk_framework")
    ),
    "type" => "select"
  ),

  array(
    "name" => __( 'Page Title Color', 'mk_framework' ),
    "subtitle" => __( "Using this option you can change page title text color.", "mk_framework" ),
    "id" => "_page_title_color",
    "default" => "",
    "type" => "color"
  ),

  array(
    "name" => __( "Breadcrumb Skin", "mk_framework" ),
    "subtitle" => __( "Dark skin is for light color backgrounds and light for dark backgrounds.", "mk_framework" ),
    "desc" => __( "", "mk_framework" ),
    "id" => "_breadcrumb_skin",
    "default" => 'dark',
    "placeholder" => 'false',
    "width" => 400,
    "options" => array(
      "dark" => __('Dark', "mk_framework" ),
      "light" => __('Light', "mk_framework" ),
      "custom" => __('Custom', "mk_framework" ),
    ),
    "type" => "select"
  ),

  array(
    "name" => __( 'Breadcrumb Custom Color', 'mk_framework' ),
    "subtitle" => __( "Using this option you can change breadcrumb link and text color.", "mk_framework" ),
    "id" => "_breadcrumb_custom_color",
    "default" => "#fff",
    "type" => "color"
  ),

  array(
    "name" => __( 'Breadcrumb Custom Hover Color', 'mk_framework' ),
    "subtitle" => __( "Using this option you can change breadcrumb link hover color.", "mk_framework" ),
    "id" => "_breadcrumb_custom_hover_color",
    "default" => "#000",
    "type" => "color",
  ),

);
new mk_metaboxesGenerator( $config, $options );
