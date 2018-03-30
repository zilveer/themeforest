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
        'title' => esc_html__('Category Meta Box','g5plus-academia') ,          // meta box title
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
    //Image field
    $my_meta->addImage($prefix.'page_title_background',array('name'=> esc_html__('Page Title Background Image','g5plus-academia')));
    $my_meta->addRadio($prefix.'icon_type',array('font_icon'=>'Font Icon','image_icon'=>'Image Icon'),array('name'=> esc_html__('Icon type','g5plus-academia'), 'std'=> array('font_icon')));

    if(function_exists('academia_get_font_awesome')){
        $academia_font_awesome = &academia_get_font_awesome();
        $select_icon = array();
        foreach($academia_font_awesome as $value ){
            $key_val=key($value);
            $arr_val= array_values($value);
            $select_icon[$key_val] = $arr_val[0];
        }
        $my_meta->addSelect($prefix.'icon',$select_icon,array('name'=> esc_html__('Icon ','g5plus-academia'), 'std'=> array('')));
    }

    $my_meta->addColor($prefix.'icon_bg_color',array('name'=> esc_html__('Icon Background Color ','g5plus-academia')));

    $my_meta->addImage($prefix.'image_icon',array('name'=> esc_html__('Image Icon','g5plus-academia')));


    /*
     * Don't Forget to Close up the meta box decleration
     */
    //Finish Meta Box Decleration
    $my_meta->Finish();
}
