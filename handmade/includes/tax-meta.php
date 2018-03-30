<?php
//include the main class file
if (is_admin()){
    /*
     * prefix of meta keys, optional
     */
    $prefix = 'g5plus_';
    /*
     * configure your meta box
     */
    $config = array(
        'id' => 'category_meta_box',          // meta box id, unique per meta box
        'title' => esc_html__('Category Meta Box','g5plus-handmade') ,          // meta box title
        'pages' => array('category','product_cat'),        // taxonomy name, accept categories, post_tag and custom taxonomies
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
    $my_meta->addText($prefix.'page_title_height',array('name' => esc_html__('Page Title Height','g5plus-handmade')));

    //Image field
    $my_meta->addImage($prefix.'page_title_background',array('name'=> esc_html__('Page Title Background ','g5plus-handmade')));




    /*
     * Don't Forget to Close up the meta box decleration
     */
    //Finish Meta Box Decleration
    $my_meta->Finish();
}
