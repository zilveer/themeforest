<?php


require_once (THEME_INCLUDES . "/Tax-meta-class/Tax-meta-class.php");

if (is_admin()){

  /* 
   * prefix of meta keys, optional
   */

  $prefix = 'mk_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'mk_tax_metabox',          // meta box id, unique per meta box
    'title' => 'Tax Meta Box',          // meta box title
    'pages' => array('category', 'portfolio_category', 'portfolio_category', 'news_category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  $taxonomy_meta =  new Tax_Meta_Class($config);
  
  $taxonomy_meta->addImage($prefix.'image_field_id',array('name'=> __('Thumbnail','mk_framework')));
  
   
  $taxonomy_meta->Finish();
}