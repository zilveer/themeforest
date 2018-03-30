<?php
//include the main class file
require_once("tax-meta-class/Tax-meta-class.php");
if (is_admin()){
    /*
     * prefix of meta keys, optional
     */
    $prefix = 'zorka_';
    /*
     * configure your meta box
     */
    $config = array(
        'id' => 'category_product_meta_box',          // meta box id, unique per meta box
        'title' => 'Category Product Meta Box',          // meta box title
        'pages' => array('product_cat'),        // taxonomy name, accept categories, post_tag and custom taxonomies
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
    $my_meta->addImage($prefix.'custom_page_title_background',array('name'=> esc_html__('Page Title Background ','zorka')));

    //select field
    $my_meta->addSelect($prefix.'custom_product_archive_layout',array('none' => esc_html__('None','zorka'), 'full-content'=> esc_html__('Full Width','zorka')  ,'left-sidebar'=> esc_html__('Left Sidebar','zorka') ,'right-sidebar' => esc_html__('Right Sidebar','zorka') ),array('name'=> esc_html__('Layout','zorka') , 'std'=> array('none')));

    /*
     * Don't Forget to Close up the meta box decleration
     */
    //Finish Meta Box Decleration
    $my_meta->Finish();
}
