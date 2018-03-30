<?php
/*
Plugin Name: Demo Tax meta class
Plugin URI: http://en.bainternet.info
Description: Tax meta class usage demo
Version: 2.0.2
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/

//include the main class file
require_once("Tax-meta-class/Tax-meta-class.php");
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   */
  $prefix = 'pp_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'parallax_cat',          // meta box id, unique per meta box
    'title' => 'Parallax settings for category',          // meta box title
    'pages' => array('category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  
  /*
   * Add fields to your meta box
   */
  
    //Image field
  $my_meta->addImage($prefix.'parallax_bg', 
    array(
      'name'=> __('Parallax header background ','tax-meta'),
      'desc' => 'Leave empty to show default header',
      )
  );

  $my_meta->addSelect($prefix.'parallax_opacity',
    array(
      '0'=>'0',
      '0.1'=>'0.1',
      '0.15'=>'0.15',
      '0.2'=>'0.2',
      '0.25'=>'0.25',
      '0.3'=>'0.3',
      '0.35'=>'0.35',
      '0.4'=>'0.4',
      '0.45'=>'0.45',
      '0.5'=>'0.5',
      '0.55'=>'0.55',
      '0.6'=>'0.6',
      '0.65'=>'0.65',
      '0.7'=>'0.7',
      '0.75'=>'0.75',
      '0.8'=>'0.8',
      '0.85'=>'0.85',
      '0.9'=>'0.9',
      '0.95'=>'0.95',
      '1'=>'0.1',
      
    ),
    array(
      'name'=> __('Overlay opacity','tax-meta'), 
      'std'=> array('0.6')
    )
  );
  $my_meta->addColor($prefix.'parallax_color',array('name'=> __('Overlay color','tax-meta')));

 /*
   * Don't Forget to Close up the meta box decleration
   */
  //Finish Meta Box Decleration
  $my_meta->Finish();
}
