<?php

//include the main class file
require_once("tools/Tax-meta-class/Tax-meta-class.php");

if (is_admin()){
  /* 
   * prefix of meta keys, optional
   * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
   *  you also can make prefix empty to disable it
   * 
   */
  $prefix = 'newidea_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'portfolio_meta_box',          // meta box id, unique per meta box
    'title' => 'Portfolio Meta Box',          // meta box title
    'pages' => array('portfolio_categories'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => true,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  
  /*
   * Add fields to your meta box
   */
  
  //Input field
  $my_meta->addText($prefix.'portfolio_order_id',array('name'=> __('Portfolio Order Id','newidea')));
  
  //Image field
  $my_meta->addImage($prefix.'image_field_id',array('name'=> __('Portfolio Category Image','newidea')));
  
  //Category Background Image
  $my_meta->addImage($prefix.'image_bg',array('name'=> __('Portfolio Category Background Image','newidea')));
  
  /*
   * Don't Forget to Close up the meta box decleration
   */
  //Finish Meta Box Decleration
  $my_meta->Finish();
}
