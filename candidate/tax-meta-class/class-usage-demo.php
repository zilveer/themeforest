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
require_once("tax-meta-class/tax-meta-class.php");
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   */
  $prefix = 'ba_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'demo_meta_box',          // meta box id, unique per meta box
    'title' => 'Demo Meta Box',          // meta box title
    'pages' => array('category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  
  /*
   * Add fields to your meta box
   */
  
  //text field
  $my_meta->addText($prefix.'text_field_id',array('name'=> esc_html__('My Text ','candidate'),'desc' => 'this is a field desription'));
  //textarea field
  $my_meta->addTextarea($prefix.'textarea_field_id',array('name'=> esc_html__('My Textarea ','candidate')));
  //checkbox field
  $my_meta->addCheckbox($prefix.'checkbox_field_id',array('name'=> esc_html__('My Checkbox ','candidate')));
  //select field
  $my_meta->addSelect($prefix.'select_field_id',array('selectkey1'=>'Select Value1','selectkey2'=>'Select Value2'),array('name'=> esc_html__('My select ','revija'), 'std'=> array('selectkey2')));
  //radio field
  $my_meta->addRadio($prefix.'radio_field_id',array('radiokey1'=>'Radio Value1','radiokey2'=>'Radio Value2'),array('name'=> esc_html__('My Radio Filed','revija'), 'std'=> array('radionkey2')));
  //date field
  $my_meta->addDate($prefix.'date_field_id',array('name'=> esc_html__('My Date ','revija')));
  //Time field
  $my_meta->addTime($prefix.'time_field_id',array('name'=> esc_html__('My Time ','revija')));
  //Color field
  $my_meta->addColor($prefix.'color_field_id',array('name'=> esc_html__('My Color ','revija')));
  //Image field
  $my_meta->addImage($prefix.'image_field_id',array('name'=> esc_html__('My Image ','revija')));
  //file upload field
  $my_meta->addFile($prefix.'file_field_id',array('name'=> esc_html__('My File ','revija')));
  //wysiwyg field
  $my_meta->addWysiwyg($prefix.'wysiwyg_field_id',array('name'=> esc_html__('My wysiwyg Editor ','revija')));
  //taxonomy field
  $my_meta->addTaxonomy($prefix.'taxonomy_field_id',array('taxonomy' => 'category'),array('name'=> esc_html__('My Taxonomy ','candidate')));
  //posts field
  $my_meta->addPosts($prefix.'posts_field_id',array('args' => array('post_type' => 'page')),array('name'=> esc_html__('My Posts ','candidate')));
  
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  
  $repeater_fields[] = $my_meta->addText($prefix.'re_text_field_id',array('name'=> esc_html__('My Text ','candidate')),true);
  $repeater_fields[] = $my_meta->addTextarea($prefix.'re_textarea_field_id',array('name'=> esc_html__('My Textarea ','candidate')),true);
  $repeater_fields[] = $my_meta->addCheckbox($prefix.'re_checkbox_field_id',array('name'=> esc_html__('My Checkbox ','candidate')),true);
  $repeater_fields[] = $my_meta->addImage($prefix.'image_field_id',array('name'=> esc_html__('My Image ','candidate')),true);
  
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $my_meta->addRepeaterBlock($prefix.'re_',array('inline' => true, 'name' => esc_html__('This is a Repeater Block','candidate'),'fields' => $repeater_fields));
  /*
   * Don't Forget to Close up the meta box decleration
   */
  //Finish Meta Box Decleration
  $my_meta->Finish();
}
