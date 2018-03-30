<?php

add_action( 'admin_init', 'themo_load_sortable_type', 1 );
function themo_load_sortable_type()
{
    require 'field-sortable.php';
}

$glyphicons_website = "http://glyphicons.com";

//======================================================================
// Meta Box HELPER Functions
//======================================================================


//-----------------------------------------------------
// Tabs
//-----------------------------------------------------
function themo_return_tabs($key,$name){

    $header_label = 'Header';
    if($key == 'themo_page_header'){$header_label = 'Custom Header';}

    $sortorder_tab = array('display' => array(
        'label' =>  'Display',
        //'icon'  => 'dashicons-email', // Dashicon
    ));

    $header_tab = array('header'  => array(
        'label' =>  $header_label,
        //'icon'  => 'dashicons-share', // Dashicon
    ));

    $background_tab = array('background'  => array(
        'label' =>  'Background',
        //'icon'  => 'http://i.imgur.com/nJtag1q.png', // Custom icon, using image
    ));

    $border_tab = array('border'  => array(
        'label' =>  'Border',
        //'icon'  => 'http://i.imgur.com/nJtag1q.png', // Custom icon, using image
    ));

    $padding_tab = array('padding'  => array(
        'label' =>  'Padding',
        //'icon'  => 'http://i.imgur.com/nJtag1q.png', // Custom icon, using image
    ));

    $animation_tab = array('animation'  => array(
        'label' =>  'Animation',
        //'icon'  => 'http://i.imgur.com/nJtag1q.png', // Custom icon, using image
    ));
    
    $key_tab = array($key  => array(
        'label' => sprintf( '%1$s',$name),
        //'icon'  => 'dashicons-share', // Dashicon
    ));


    return array($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab);

}


//-----------------------------------------------------
// Glyphioncs / Icons
//-----------------------------------------------------
function themo_return_icons($key,$i,$class=''){

    global $glyphicons_website;

    $glyphicons_icon_set = array(
        'id'          => $key."_".$i."_glyphicons_icon_set",
        'name'       =>  'Icon Library',
        'std'         => 'none',
        'type'        => 'radio',
        'options'  => array(
            'none'  => 'No Icon',
            'glyphicons' => 'Glyphicons',
            'halflings'  => 'Halflings',
            'social'  => 'Social',
            'filetype'  => 'Filetypes',
        ),
        'class' => $class
    );

    $glyphicons_icon = array(
        'id'          => $key."_".$i."_glyphicons-icon",
        'name'       => 'Icon Key',
        'desc'        => 'Use any <a href="'.esc_url($glyphicons_website).'" target="_blank">Glyphicon</a> (e.g.: social-facebook). <a href="'.esc_url($glyphicons_website).'" target="_blank">FULL LIST HERE</a>',
        'type'        => 'text',
        'class' => $class
    );

    return array($glyphicons_icon_set,$glyphicons_icon);

}

//-----------------------------------------------------
// Sort Order
//-----------------------------------------------------
function themo_return_sort_order($key,$i){
    global $themo_meta_box_order, $post_id;

    $meta_box_order = get_post_meta($post_id, $key."_".$i."_order", true);

// Check General Options to see if Manual Sort Order is Seleted.
    if ( function_exists( 'ot_get_option' ) ) {
        $meta_box_manual_sort_order = ot_get_option( 'themo_meta_box_builder_meta_box_manual_sort_order', 'off' );
    }

// If Manual Sort Order is set to ON, then add "meta-box-order" that will show the manual sort order text field.


    $sort_order_metabox_type = "hidden";
    $sort_order_metabox_class = "";
    $sort_order_metabox_name = "";

    if(isset($meta_box_manual_sort_order) && $meta_box_manual_sort_order == 'on'){
        $sort_order_metabox_type = "text";
        $sort_order_metabox_class = 'checkbox-condition '.$key."_".$i.'_sortorder_show';
        $sort_order_metabox_name =  'Order';
    }

    if(isset($meta_box_order) && !$meta_box_order > 0){
        if(!isset($themo_meta_box_order)){
            $themo_meta_box_order = 10;
            $meta_box_order =  $themo_meta_box_order;
        }else{
            $themo_meta_box_order = $themo_meta_box_order + 10;
            $meta_box_order =  $themo_meta_box_order;
        }
    }



    $sortorder_show	= array(
        'id'          => $key."_".$i."_sortorder_show",
        'name'       =>  'Display',
        'std'         => 0,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch',
        'tab'  => 'display',
    );
    $order = array(
        'id'          => $key."_".$i."_order",
        'name'       => $sort_order_metabox_name,
        'type'        => $sort_order_metabox_type,
        'std'         => $meta_box_order,
        'class' => $sort_order_metabox_class,
        'tab'  => 'display',
    );

    $anchor =	array(
        'id'          => $key."_".$i."_anchor",
        'name'       =>  'Anchor',
        'type'        => 'text',
        'class' => 'checkbox-condition '.$key."_".$i.'_sortorder_show anchor-input',
        'tab'  => 'display',
    );



    return array($sortorder_show,$order,$anchor);
}

//-----------------------------------------------------
// Header Options
//-----------------------------------------------------
function themo_return_meta_header($key,$i){

    global $glyphicons_website;

    $header_label = 'Header';
    if($key == 'themo_page_header'){$header_label = 'Custom Header';}

    $show_header = array(
        'id'          => $key."_".$i.'_show_header',
        'name'       =>  $header_label,
        'std'         => 0,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch',
        'tab'  => 'header',
    );

    $glyphicons_icon_set = array(
        'id'          => $key."_".$i."_glyphicons_icon_set",
        'name'       =>  'Header Icon Library',
        'std'         => 'none',
        'type'        => 'radio',
        'options'  => array(
            'none'  => 'No Icon',
            'glyphicons' => 'Glyphicons',
            'halflings'  => 'Halflings',
            'social'  => 'Social',
            'filetype'  => 'Filetypes',
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
        'tab'  => 'header',
    );

    $glyphicons_icon = array(
        'id'          => $key."_".$i."_glyphicons-icon",
        'name'       => 'Icon Key',
        'desc'        => 'Use any <a href="'.esc_url($glyphicons_website).'" target="_blank">Glyphicon</a> (e.g.: social-facebook). <a href="'.esc_url($glyphicons_website).'" target="_blank">FULL LIST HERE</a>',
        'type'        => 'text',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
        'tab'  => 'header',
    );

    $header 	= array(
        'id'          => $key."_".$i."_header",
        'name'       =>  'Heading',
        'type'        => 'text',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
        'tab'  => 'header',
        'add_to_wpseo_analysis' => true,
    );
    $subtext 	= array(
        'id'          => $key."_".$i.'_subtext',
        'name'       =>  'Subtext',
        'type'        => 'textarea',
        'rows'        => '4',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
        'tab'  => 'header',
        'add_to_wpseo_analysis' => true,
    );
    $header_float = array(
        'id'          => $key."_".$i."_header_float",
        'name'       =>  'Align Header',
        'std'         => 'left',
        'type'        => 'radio',
        'options'  => array(
            'left'  => 'Left Align',
            'centered' => 'Centered',
            'right'  => 'Right Align'
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
        'tab'  => 'header',
    );
    return array($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon);
}

//-----------------------------------------------------
// Background
//-----------------------------------------------------
function themo_return_background_options($key,$i){

    $show_background_desc =  'Background styling is intended for full width pages, therefore they do not show when using sidebars.';
    if($key == 'themo_page_header'){  // dont's how for page header and slider (they are always full width)
        $show_background_desc =  'Background styling available with Custom Header option only.';
    }elseif($key == ''){
        $show_background_desc = '';
    }

    $show_background = array(
        'id'          => $key."_".$i.'_show_background',
        'name'       =>  'Background Styling',
        'desc'        => $show_background_desc,
        'std'         => 0,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch',
        'tab'  => 'background',
    );

    $background_color = array(
        'id'          => $key."_".$i.'_background_color',
        'name' =>  'Background Color',
        'type' => 'color',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_background',
        'tab'  => 'background',
    );

    $background_image = array(
        'name'        =>  'Background Image',
        'id'          => $key."_".$i.'_background_image',
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
        'class' => 'checkbox-condition '.$key."_".$i.'_show_background',
        'tab'  => 'background',
    );

    $parallax = array(
        'id'          => $key."_".$i.'_parallax',
        'name'       =>  'Parallax',
        'std'         => 0,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch checkbox-condition '.$key."_".$i.'_show_background',
        'tab'  => 'background',
    );

    $background_repeat = array(
        'name'        =>  'Background Repeat',
        'id'          => $key."_".$i.'_background_repeat',
        'type'        => 'select',
        'options'     => array(
            '' =>  '',
            'no-repeat' =>  'No Repeat',
            'repeat' =>  'Repeat All',
            'repeat-x' =>  'Repeat Horizontally',
            'repeat-y' =>  'Repeat Vertically',
        ),
        // Select multiple values, optional. Default is false.
        'multiple'    => false,
        'std'         => '',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_background ',
        //'placeholder' =>  'background-repeat',
        'tab'  => 'background',
    );

    $background_attachment = array(
        'name'        =>  'Background Attachment',
        'id'          => $key."_".$i.'_background_attachment',
        'type'        => 'select',
        'options'     => array(
            '' =>  '',
            'fixed' =>  'fixed',
            'scroll' =>  'scroll',
        ),
        // Select multiple values, optional. Default is false.
        'multiple'    => false,
        'std'         => '',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_background',
        //'placeholder' =>  'background-attachment',
        'tab'  => 'background',
    );

    $background_position = array(
        'name'        =>  'Background Position',
        'id'          => $key."_".$i.'_background_position',
        'type'        => 'select',
        'options'     => array(
            '' =>  '',
            'left top' =>  'Left Top',
            'left center' =>  'Left Center',
            'left bottom' =>  'Left Bottom',
            'center top' =>  'Center Top',
            'center center' =>  'Center Center',
            'center bottom' =>  'Center Bottom',
            'right top' =>  'Right Top',
            'right center' =>  'Right Center',
            'right bottom' =>  'Right Bottom',
        ),
        // Select multiple values, optional. Default is false.
        'multiple'    => false,
        'std'         => '',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_background',
        //'placeholder' =>  'background_position',
        'tab'  => 'background',
    );

    $background_size = array(
        'name'        =>  'Background Size',
        'id'          => $key."_".$i.'_background_size',
        'type'  => 'text',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_background',
        'tab'  => 'background',
    );



    $text_contrast = array(
        'id'          => $key."_".$i.'_text_contrast',
        'name'       =>  'Text contrast',
        'desc'        =>  'For darker colored backgrounds, use the light text option.',
        'std'         => 'dark',
        'type'        => 'radio',
        'options'  => array(
            'dark'  => 'Dark Text',
            'light' => 'Light Text'
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show_background',
        'tab'  => 'background',
    );

//return var_export($output,true);
    return array($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast);
}

//-----------------------------------------------------
// Borders
//-----------------------------------------------------
function themo_return_border_options($key,$i){


    $show_background_desc =  '';
    if($key == 'themo_page_header'){  // dont's how for page header and slider (they are always full width)
        $show_background_desc =  'Border options available with Custom Header option only.';
    }

    $show_border_default = 0;
    $border_default = "";

    if($key == 'themo_page_header'){
        $show_border_default = "on";
        $border_default = "bottom";
    }

    $show_border = array(
        'id'          => $key."_".$i.'_show_border',
        'name'       =>  'Borders',
        'std'         => $show_border_default,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch',
        'tab'  => 'border',
        'desc'        => $show_background_desc,
    );
    $border =	array(
        'name'       =>  'Border Position',
        'id'          => $key."_".$i.'_border',
        'type'        => 'radio',
        'std'         => $border_default,
        'options'  => array(
            'top'  => 'Border Top',
            'bottom' => 'Border Bottom',
            'both' => 'Border Top & Bottom'
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show_border',
        'tab'  => 'border',
    );
    $border_full_width = array(
        'id'          => $key."_".$i.'_border_full_width',
        'name'       =>  'Full width borders',
        'std'         => 0,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch checkbox-condition '.$key."_".$i.'_show_border',
        'tab'  => 'border',
    );
    return array($show_border, $border, $border_full_width);
}

//-----------------------------------------------------
// Padding
//-----------------------------------------------------
function themo_return_padding_options($key,$i){

    $show_background_desc =  '';
    if($key == 'themo_page_header'){  // dont's how for page header and slider (they are always full width)
        $show_background_desc =  'Padding options available with Custom Header option only.';
    }

    $padding = 	array(
        'id'          => $key."_".$i.'_padding',
        'name'       =>  'Padding',
        'std'         => 0,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch',
        'tab'  => 'padding',
        'desc'        => $show_background_desc,
    );
    $top_padding = array(
        'id'          => $key."_".$i.'_top_padding',
        'name'       =>  'Top Padding',
        'type'        => 'slider',
        'suffix'     =>  'px',
        // jQuery UI slider options. See here http://api.jqueryui.com/slider/
        'js_options' => array(
            'min'  => 0,
            'max'  => 300,
            'step' => 5,
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_padding',
        'tab'  => 'padding',
    );
    $bottom_padding = array(
        'id'          => $key."_".$i.'_bottom_padding',
        'name'       =>  'Bottom Padding',
        'type'        => 'slider',
        'suffix'     =>  'px',
        'js_options' => array(
            'min'  => 0,
            'max'  => 300,
            'step' => 5,
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_padding',
        'tab'  => 'padding',
    );
    return array($padding,$top_padding,$bottom_padding);
}

//-----------------------------------------------------
// Animation
//-----------------------------------------------------
function themo_return_animation_options($key,$i){


    $show_background_desc =  '';
    if($key == 'themo_page_header'){  // dont's how for page header and slider (they are always full width)
        $show_background_desc =  'Animation options available with Custom Header option only.';
    }

    $animation = 	array(
        'id'          => $key."_".$i.'_animate',
        'name'       =>  'Animate',
        'std'         => 0,
        'type'        => 'checkbox',
        'desc'        => $show_background_desc,
        'class' => 'checkbox-switch',
        'tab'  => 'animation',
    );
    $animation_style = 	array(
        'id'          => $key."_".$i.'_animate_style',
        'name'       =>  'Animation Style',
        'std'         => 'slideUp',
        'type'        => 'select',
        'options'     => array(
            'slideUp' =>  'Slide Up',
            'slideDown' =>  'Slide Down',
            'slideLeft' =>  'Slide Left',
            'slideRight' =>  'Slide Right',
            'fadeIn' =>  'Fade In',
        ),
        // Select multiple values, optional. Default is false.
        'multiple'    => false,
        'class' => 'checkbox-condition '.$key."_".$i.'_animate',
        'tab'  => 'animation',
    );
    return array($animation,$animation_style);
}

//-----------------------------------------------------
// Button
//-----------------------------------------------------
function themo_return_button_options($key,$i,$tab=null,$serial=false){

    if(is_null($tab)){
        $tab = $key;
    }

    if(isset($serial) && $serial > ""){
        $serial_name = ' '.$serial;
        $serial = '_'.$serial;
    }else{
        $serial_name = false;
        $serial = false;
    }


    $show_button_heading = array(
        'type' => 'heading',
        'name' =>  'Button'.$serial_name,
        'id'          => $key."_".$i."_button_heading".$serial,
        'tab'  => $tab,
    );
    $show_button = array(
        'id'          => $key."_".$i.'_show_button'.$serial,
        'name'       =>  'Show Button',
        'std'         => 0,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch',
        'tab'  =>  $tab,
    );
    $button_text 	= array(
        'id'          => $key."_".$i."_button_text".$serial,
        'name'       =>  'Button Text',
        'type'        => 'text',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_button'.$serial,
        'tab'  =>  $tab,
        'add_to_wpseo_analysis' => true,

    );
    $button_link 	= array(
        'id'          => $key."_".$i."_button_link".$serial,
        'name'       =>  'Button Link',
        'type'        => 'text',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_button'.$serial,
        'tab'  =>  $tab,
        'add_to_wpseo_analysis' => true,
    );
    $button_link_target = 	array(
        'id'          => $key."_".$i.'_button_link_target'.$serial,
        'name'       =>  'Link Target',
        'type'        => 'checkbox_list',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_button'.$serial,
        'options'     => array(
            '_blank' =>  'Open link in a new window / tab',
        ),
        'tab'  =>  $tab,
    );
    $button_style = 	array(
        'id'          => $key."_".$i.'_button_style'.$serial,
        'name'       =>  'Button Style',
        'std'         => 'standard',
        'type'        => 'select',
        'options'     => array(
            'standard' =>  'Standard',
            'ghost' =>  'Ghost',
            'cta' =>  'Call to Action',
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show_button'.$serial,
        'tab'  =>  $tab,
    );
    $button_graphic = array(
        'id'          => $key."_".$i.'_button_img_ID'.$serial,
        'name'        =>  'Button Graphic',
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
        'class' => 'checkbox-condition '.$key."_".$i.'_show_button'.$serial,
        'tab'  =>  $tab,
    );
    // Select Custom Post Type
    $add_to_cart_product_id = array(
        'id'          => $key."_".$i."_productID".$serial,
        'name'        =>  'Convert to Add to Cart Button',
        'type'        => 'post',
        // Post type
        'post_type'   => 'product',
        // Field type, either 'select' or 'select_advanced' (default)
        'field_type'  => 'select_advanced',
        'multiple'    => false,
        'placeholder' =>  'Select a product',
        // Query arguments (optional). No settings means get all published posts
        'desc' =>   'Overrides Button Link, Link Target and Button Graphic.',
        'query_args'  => array(
            'post_status'    => 'publish',
            'posts_per_page' => - 1,
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show_button'.$serial,
        'tab'  => $tab,
    );

    $add_to_cart_product_sku = array(
        'id'          => $key."_".$i."_product_sku".$serial,
        'name'        =>  'Product SKU',
        'type'  => 'text',
        'placeholder' =>  'sku-123',
        'desc' =>   'Optional',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_button'.$serial,
        'tab'  => $tab,
    );

    return array($show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku);
}

//-----------------------------------------------------
// Link
//-----------------------------------------------------
function themo_return_link($key,$i,$tab=null){

    if(is_null($tab)){
        $tab = $key;
    }

    $show_link = array(
        'id'          => $key."_".$i.'_show_link',
        'name'       =>  'Display Link',
        'std'         => 0,
        'type'        => 'checkbox',
        'class' => 'checkbox-switch',
        'tab'  =>  $tab,
    );
    $link 	= array(
        'id'          => $key."_".$i."_link",
        'name'       =>  'Link URL',
        'type'        => 'text',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_link',
        'tab'  =>  $tab,
    );
    $link_target = 	array(
        'id'          => $key."_".$i.'_link_target',
        'name'       =>  'Link Target',
        'type'        => 'checkbox_list',
        'options'     => array(
            '_blank' =>  'Open link in a new window / tab',
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show_link',
        'tab'  =>  $tab,
    );

    $link_text = array(
        'id'          => $key."_".$i."_link_text",
        'name'       =>  'Link Text',
        'type'        => 'text',
        'class' => 'checkbox-condition '.$key."_".$i.'_show_link',
        'tab'  =>  $tab,
    );


    return array($show_link,$link,$link_target,$link_text);
}

//-----------------------------------------------------
// Print Header Action
//-----------------------------------------------------

function themo_print_header_array($key,$i){
    $output = array(
        'id'          => $key."_".$i.'_header',
        'desc'        =>  'This is some help',
        'name'       =>  'Heading',
        'type'        => 'text',

        'condition'   => $key."_".$i.'_show_header:is(on)',
    );
    return $output;
}

//-----------------------------------------------------
// Edit Lock Check
//-----------------------------------------------------
function themo_edit_lock_check($key,$i,$locked_options = array(),$meta_box_array = array()){

    $edit_lock = 'on'; //get_post_meta($post_id, $key."_".$i."_sortorder_edit_enable", true);

    if(isset($edit_lock) && $edit_lock == 'off'){
        return $meta_box_array;
    }else{
        foreach ($locked_options as &$value) {
            array_push($meta_box_array['fields'],$value);
        }
        return $meta_box_array;
    }

}


add_filter( 'rwmb_meta_boxes', '_themo_general_meta_boxes' );

add_filter( 'rwmb_meta_boxes', '_themo_specific_meta_boxes' );


//-----------------------------------------------------
// Return Custom Post Type Options
//-----------------------------------------------------

function themo_return_custom_post_type_options($key,$i,$post_type=null,$label=null){

    if(is_null($post_type)) {
        $post_type = $key;
    }

    $slug = '<a target="_blank" href="edit.php?post_type='.$key.'">Add New '.$label.'</a>';

    $options = array(
        'id'          => $key."_".$i."_posts",
        'name'        =>  'Select individually',
        'type'        => 'post',
        // Post type
        'post_type'   => $post_type,
        // Field type, either 'select' or 'select_advanced' (default)
        'field_type'  => 'select_advanced',
        'multiple'    => true,
        'placeholder' =>  'Select an Item',
        // Query arguments (optional). No settings means get all published posts
        'desc' =>   $slug,
        'query_args'  => array(
            'post_status'    => 'publish',
            'posts_per_page' => - 1,
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show',
        'tab'  => $key,
    );

    return array($options);
}

//-----------------------------------------------------
// Return Terms Options
//-----------------------------------------------------

function themo_return_term_options($key,$i,$term=null,$label=null){

    $slug = '<a target="_blank" href="edit-tags.php?taxonomy='.$term.'">Add New '.$label.'</a>';
    $options = array(
            'name'  =>  'Select by group',
            'id'          => $key."_".$i."_groups",
            'type' => 'taxonomy_advanced',
            'options' => array(
                // Taxonomy name
                'taxonomy' => $term,
                // How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
                'type'     => 'select_advanced',
            ),
            'multiple'    => true,
            'class' => 'checkbox-condition '.$key."_".$i.'_show',
            'desc' =>  sprintf(  '%1$s <br />You can choose to select individually or by group, not a combination of both.', $slug ),
            'tab'  => $key,
    );

    return array($options);
}

//-----------------------------------------------------
// Return Order By Options
//-----------------------------------------------------

function themo_return_order_by_options($key,$i,$name){

    $theme_name =  wp_get_theme();
    if(isset($theme_name) & $theme_name > ""){
        $theme_name = $theme_name .' > ';
    }

    $options = array(
        'id'          => $key."_".$i."_orderby",
        'name'       =>  'Order by',
        'std'         => 'date',
        'desc'       => sprintf(  '<strong>Drag and Drop:</strong> %1$s > Sort by Order <br><strong>Manually:</strong> %1$s > Edit > Attributes > Order', $theme_name . $name),
        'type'        => 'select',
        'options'     => array(
            'date' =>  'Date',
            'menu_order' =>  'Drag and Drop',
        ),
        'class' => 'checkbox-condition '.$key."_".$i.'_show',
        'tab'  => $key,
    );

    return array($options);
}

//======================================================================
// General Meta Boxes
//======================================================================

function _themo_general_meta_boxes($meta_boxes) {

    //-----------------------------------------------------
    // Accordion Custom Post Type Meta box
    //-----------------------------------------------------

    $key = '';
    $name = 'Accordion Options';
    $post_types = 'themo_accordion';
    $i = '';

    /* Get Button Options */
    list($show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku) = themo_return_button_options($key,$i);

    /* Get Button Options #2 */
    list($show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2) = themo_return_button_options($key,$i,null,'2');

    /* Icons */
    list($glyphicons_icon_set,$glyphicons_icon) = themo_return_icons($key,$i);

    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            $show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku,
            /* Button 2 */
            $show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2,
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            $glyphicons_icon_set,$glyphicons_icon,
        ),
    );


    //-----------------------------------------------------
    // Brands Custom Post Type Meta box
    //-----------------------------------------------------

    $key = '';
    $name = 'Brand Options';
    $post_types = 'themo_brands';

    /* Get Link Options */
    list($show_link,$link,$link_target,$link_text) = themo_return_link($key,$i);


    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            $show_link,$link,$link_target,$link_text
        ),
    );

    //-----------------------------------------------------
    // Featured Custom Post Type Meta box
    //-----------------------------------------------------

    $key = '';
    $name = 'Featured Options';
    $post_types = 'themo_featured';

    /* Get Link Options */
    list($show_link,$link,$link_target,$link_text) = themo_return_link($key,$i);


    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            $show_link,$link,$link_target,$link_text
        ),
    );

    //-----------------------------------------------------
    // Pricing Plans Custom Post Type Meta box
    //-----------------------------------------------------

    $key = '';
    $name = 'Pricing Plan Options';
    $post_types = 'themo_pricing_plans';

    /* Get Button Options */
    list($show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku) = themo_return_button_options($key,$i);

    /* Get Button Options #2 */
    list($show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2) = themo_return_button_options($key,$i,null,'2');


    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'name'  =>  'Price',
                'id'          => $key."_price",
                'type'  => 'text',
                'placeholder' =>  'Free',
            ),
            array(
                'name'  =>  'Price per',
                'id'          => $key."_price_per",
                'type'  => 'text',
                'placeholder' =>  '/month',
            ),
            array(
                'id'          => $key."_details",
                'name'       => $name. ' Details',
                'desc'        =>  'List all details here.  Use a line break to force a new row.',
                'type'        => 'textarea',
                'cols' => 20,
                'rows' => 3,
            ),
            $show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku,
            /* Button 2 */
            $show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2,
            array(
                'id'          => $key."_featured",
                'name'       =>  'Most Popular / Featured.',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch'
            ),
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
        ),
    );

    //-----------------------------------------------------
    // Slider Custom Post Type Meta box
    //-----------------------------------------------------

    $key = '';
    $name = 'Slider Options';
    $post_types = 'themo_slider';

    /* Get Button Options */
    list($show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku) = themo_return_button_options($key,$i,'button');

    /* Get Button Options #2 */
    list($show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2) = themo_return_button_options($key,$i,'button','2');

    /* Get Link Options */
    list($show_link,$link,$link_target,$link_text) = themo_return_link($key,$i,'featured-image-options');

    /* Get Background Options */
    list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

    /* Get Padding Options */
    list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);


    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'tabs'      => array(
            'button' => array(
                'label' =>  'Button',

            ),
            'featured-image-options'  => array(
                'label' =>  'Featured Image Options',

            ),
            'background'  => array(
                'label' =>  'Background',

            ),
            'padding'  => array(
                'label' =>  'Padding',

            ),
            'shortcode'  => array(
                'label' =>  'Shortcode',

            ),
            'align_style'  => array(
                'label' =>  'Alignment and Styling',

            ),
        ),
        'tab_style' => 'left',

        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            // Button
            $show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku,
            /* Button 2 */
            $show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2,

            // Link
            $show_link,$link,$link_target,$link_text,

            // Background
            $show_background,$background_color,$background_image,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,

            // Padding
            $padding,$top_padding,$bottom_padding,

            array(
                'id'          => $key."_form_shortcode",
                'name'       =>  'Shortcode',
                'type'        => 'text',
                'tab'  => 'shortcode',
            ),
            array(
                'type' => 'heading',
                'name' =>  'Booked Calendar Options',
                'id'          => $key."_".$i."_photo_heading",
                'tab'  => 'shortcode',
            ),
            array(
                'id'          => $key."_show_tooltip",
                'name'       =>  'Display Tooltip',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch',
                'tab'  => 'shortcode',
            ),
            array(
                'id'          => $key.'_tooltip_text',
                'name'       =>  'Text',
                'type'        => 'text',
                'class' => 'checkbox-condition '.$key.'_show_tooltip',
                'tab'  => 'shortcode',
            ),
            array(
                'type' => 'heading',
                'name' =>  'Formidable Options',
                'id'          => $key."_".$i."_formidable_heading",
                'tab'  => 'shortcode',
            ),
            array(
                'id'          => $key."_form_border",
                'name'       =>  'Form Border',
                'std'         => 'none',
                'type'        => 'radio',
                'options'     => array(
                    'form-bg light-bg' =>  'Light',
                    'form-bg dark-bg' =>  'Dark',
                    'none' =>  'None',
                ),
                'tab'  => 'shortcode',
            ),


            array(
                'id'          => $key.'_large_styling',
                'name'       =>  'Large Styling',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch',
                'tab'  => 'align_style',
            ),
            array(
                 'id'          => $key.'_align_content',
                 'name'       =>  'Align Content',
                 'std'         => 1,
                 'type'        => 'checkbox',
                 'class' => 'checkbox-switch',
                 'tab'  => 'align_style',
             ),
            array(
                'id'          => $key."_content_align",
                'name'       =>  'Alignment Options',
                'std'         => 'slide-cal-center',
                'type'        => 'radio',
                'options'     => array(
                    'slide-cal-left' =>  'Left',
                    'slide-cal-center' =>  'Center',
                    'slide-cal-right' =>  'Right',
                ),
                'tab'  => 'align_style',
                'class' => 'checkbox-condition '.$key.'_align_content',
            ),
            array(
                'id'          => $key.'_hide_title',
                'name'       =>  'Hide Title',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch',
                'tab'  => 'align_style',
            ),
        ),

    );


    //-----------------------------------------------------
    // Team Custom Post Type Meta box
    //-----------------------------------------------------
    $key = '';
    $name = 'Team Options';
    $post_types = 'themo_team';

    /* Get Link Options */
    list($show_link,$link,$link_target,$link_text) = themo_return_link($key,$i);


    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            array(
                'name'  =>  'Job Title',
                'id'          => $key."_job_title",
                'type'  => 'text',
                'placeholder' =>  'CEO',
            ),
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            array(
                'name'        =>  'Social Icons',
                'id'          => $key."_social_icon",
                'type'        => 'select_advanced',
                // Select multiple values, optional. Default is false.
                'multiple'    => true,
                // 'std'         => 'value2', // Default value, optional
                'placeholder' =>  'Select an Icon',
                'options'     => array(
                    'social-pinterest' =>  'Pinterest',
                    'social-dropbox' =>  'Dropbox',
                    'social-google-plus' =>  'Google Plus',
                    'social-jolicloud' =>  'Jolicloud',
                    'social-yahoo' =>  'Yahoo',
                    'social-blogger' =>  'Blogger',
                    'social-picasa' =>  'Picasa',
                    'social-amazon' =>  'Amazon',
                    'social-tumblr' =>  'Tumblr',
                    'social-wordpress' =>  'Wordpress',
                    'social-instapaper' =>  'Instapaper',
                    'social-evernote' =>  'Evernote',
                    'social-xing' =>  'Xing',
                    'social-zootool' =>  'Zootool',
                    'social-dribbble' =>  'Dribbble',
                    'social-read-it-later' =>  'Read it later',
                    'social-linked-in' =>  'LinkedIn',
                    'social-forrst' =>  'Forrst',
                    'social-pinboard' =>  'Pinboard',
                    'social-behance' =>  'Behance',
                    'social-github' =>  'Github',
                    'social-youtube' =>  'Youtube',
                    'social-skitch' =>  'Skitch',
                    'social-foursquare' =>  'Foursquare',
                    'social-quora' =>  'Quora',
                    'social-badoo' =>  'Badoo',
                    'social-spotify' =>  'Spotify',
                    'social-stumbleupon' =>  'Stumbleupon',
                    'social-readability' =>  'Readability',
                    'social-facebook' =>  'Facebook',
                    'social-twitter' =>  'Twitter',
                    'social-instagram' =>  'Instagram',
                    'social-posterous-spaces' =>  'Posterous Spaces',
                    'social-vimeo' =>  'Vimeo',
                    'social-flickr' =>  'Flickr',
                    'social-last-fm' =>  'Last fm',
                    'social-rss' =>  'rss',
                    'social-skype' =>  'Skype',
                    'social-e-mail' =>  'e-mail',
                    'social-vine' =>  'Vine',
                    'social-myspace' =>  'Myspace',
                    'social-goodreads' =>  'Goodreads',
                    'social-apple' =>  'Apple',
                    'social-windows' =>  'Windows',
                    'social-yelp' =>  'Yelp',
                    'social-playstation' =>  'Playstation',
                    'social-xbox' =>  'xbox',
                    'social-android' =>  'Android',
                    'social-ios' =>  'ios',
                    'social-wikipedia' =>  'Wikipedia',
                    'social-pocket' =>  'Pocket',
                    'social-steam' =>  'Steam',
                    'social-souncloud' =>  'Souncloud',
                    'social-slideshare' =>  'Slideshare',
                    'social-netflix' =>  'Netflix',
                    'social-paypal' =>  'Paypal',
                    'social-google-drive' =>  'Google Drive',
                    'social-linux-foundation' =>  'Linux Foundation',
                    'social-ebay' =>  'ebay',
                ),
            ),
            // URL
            array(
                'name' =>  'Social Media Links',
                'id'   => $key."_social_link",
                'desc' =>  'Click plus button to add a link for each or your social media icons',
                'type' => 'text',
                'placeholder' =>  'http://facebook.com',
                'clone' => true,
            ),
            array(
                'name'       =>  'Link Target',
                'desc' =>  'Open link in a new window / tab',
                'id'          => $key."_".$i.'_social_link_target',
                'type' => 'checkbox',
                // Value can be 0 or 1
                'std'  => 1,
            ),
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            $show_link,$link,$link_target
        ),
    );



    //-----------------------------------------------------
    // Team Custom Post Type Meta box
    //-----------------------------------------------------
    $key = '';
    $name = 'Testimonial Options';
    $post_types = 'themo_testimonials';


    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            array(
                'name'  =>  'Title',
                'id'          => $key."_title",
                'type'  => 'text',
                'placeholder' =>  'Satisfied Customer',
            ),
            array(
                'name'  =>  'Quote',
                'id'          => $key."_quote",
                'type'  => 'textarea',
                'placeholder' =>  'Five Star Rating. Amazing Service.',
                'cols' => 20,
                'rows' => 3,
            ),

        ),
    );


    //-----------------------------------------------------
    // Thumbnail Slider Custom Post Type Meta box
    //-----------------------------------------------------
    $key = '';
    $name = 'Thumbnail Slider Options';
    $post_types = 'themo_thumb_slider';


    /* Get Link Options */
    list($show_link,$link,$link_target,$link_text) = themo_return_link($key,$i);

    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'name'  =>  'Small Text',
                'id'          => $key."_small_text",
                'type'  => 'text',
            ),
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            // Link
            $show_link,$link,$link_target,$link_text,
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            array(
                'id'          =>$key."_".$i.'_hide_title',
                'name'       =>  'Hide Title',
                'std'         => 0,
                'type'        => 'checkbox',
            ),
        ),

    );


    //-----------------------------------------------------
    // Tour Custom Post Type Meta box
    //-----------------------------------------------------
    $key = '';
    $name = 'Tour Options';
    $post_types = 'themo_tour';


    /* Get Background Options */
    list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

    /* Get Border Options */
    list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

    /* Get Padding Options */
    list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

    /* Animation */
    list($animation,$animation_style) = themo_return_animation_options($key,$i);

    /* Get Button Options */
    list($show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku) = themo_return_button_options($key,$i);

    /* Get Button Options #2 */
    list($show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2) = themo_return_button_options($key,$i,null,'2');

    $meta_boxes[] = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(

            /* Button */
            $show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku,
            /* Button 2 */
            $show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2,
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            array(
                'id'          => $key."_".$i.'_large_styling',
                'name'       =>  'Large Styling',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch',
            ),
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            array(
                'type' => 'heading',
                'name' =>  'Featured Image Options',
                'id'          => $key."_".$i."_photo_heading",
            ),
            array(
                'id'          => $key."_".$i."_photo_align",
                'name'       =>  'Align Photo',
                'std'         => 'right',
                'type'        => 'radio',
                'options'     => array(
                    'left' =>  'Left',
                    'centered' =>  'Centered',
                    'right' =>  'Right',
                ),
            ),
            array(
                'id'          => $key."_".$i.'_photo_size',
                'name'       =>  'Photo Size',
                'std'         => 'small',
                'type'        => 'radio',
                'options'     => array(
                    'small' =>  'Small',
                    'large' =>  'Large',
                ),
                'desc'        =>  '(Available for Left & Right Align)',
            ),
            array(
                'id'          => $key."_".$i."_photo_sticky",
                'name'       =>  'Pin Photo',
                'std'         => 'none',
                'type'        => 'radio',
                'options'     => array(
                    'top' =>  'Sticky Top',
                    'none' =>  'None',
                    'bottom' =>  'Sticky Bottom',
                ),
            ),
            array(
                'id'          => $key."_".$i.'_hover',
                'name'       =>  'Hover Slide Up Animation',
                'std'         => 1,
                'type'        => 'checkbox',
                'desc'        =>  '(Available for Sticky Bottom)',
            ),
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            /* Background */
            $show_background,$parallax,$background_color,$background_repeat,$background_attachment,$background_position,$background_size,$background_image,$text_contrast,
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            /* Animation */
            $animation,$animation_style,
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            /* Borders */
            $show_border, $border, $border_full_width,
            array(
                'type' => 'divider',
                'id'   => 'fake_divider_id', // Not used, but needed
            ),
            /* Padding */
            $padding,$top_padding,$bottom_padding
        ),
    );


    //-----------------------------------------------------
    // Service Block Custom Post Type Meta box
    //-----------------------------------------------------

    $key = '';
    $name = 'Service Block Options';
    $post_types = 'themo_service_block';

    /* Icons */
    list($glyphicons_icon_set,$glyphicons_icon) = themo_return_icons($key,$i,'checkbox-condition themo_project_show_icon');

    /* Get Link Options */
    list($show_link,$link,$link_target,$link_text) = themo_return_link($key,$i);

    $meta_boxes[] = array(
        'id'          => $key."_meta_box",
        //'autosave'   => true,
        'title'       => $name.themo_return_meta_box_number($i),
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            $glyphicons_icon_set,$glyphicons_icon,
            $show_link,$link,$link_target,$link_text
        ),
    );

    //-----------------------------------------------------
    // Project Single Options
    //-----------------------------------------------------
    $key = 'themo_project_single';
    $name = 'Project Options';
    $post_types = 'themo_portfolio';


    /* Get Button Options */
    list($show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku) = themo_return_button_options($key,$i);

    /* Get Button Options #2 */
    list($show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2) = themo_return_button_options($key,$i,null,'2');

    /* Icons */
    list($glyphicons_icon_set,$glyphicons_icon) = themo_return_icons($key,$i,'checkbox-condition themo_project_show_icon');

    $themo_project_options_meta_box = array(
        'id'          => $key."_meta_box",
        //'autosave'   => true,
        'title'       =>  'Project Options',
        'post_types' => $post_types,
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            // START PROJECT OPTIONS META BOX

            /* Button */
            $show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku,
            /* Button 2 */
            $show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2,

            array(
                'id'          => 'themo_project_show_icon',
                'name'       => 'Show Project Type Icon',
                'desc'       => '',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch'
            ),
            $glyphicons_icon_set,$glyphicons_icon,

            array(
                'name'       =>  'Alternative Thumbnail Image',
                'id'          => 'themo_project_thumb',
                'desc'        =>  'Upload an image to show as an alternative to your featured image. (Image and Standard Formats Only)',
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'class' => 'checkbox-condition '.$key."_".$i.'_show_background',
            ),
            array(
                'id'          => 'themo_project_lightbox',
                'name'       =>  'Enable Lightbox on Portfolio Home',
                'desc'       =>   'Only available on Image Format Type',
                'std'         => 0,
                'type'        => 'checkbox',
            ),
            // END PAGE LAYOUT META BOX
        )
    );
    $meta_boxes[] = $themo_project_options_meta_box;


    //-----------------------------------------------------
    // Portfolio Options
    //-----------------------------------------------------
    $key = 'themo_portfolio_options';
    $name = 'Portfolio';
    //$i = '1';



    $themo_portfolio_options_meta_box = array(
        'id'          => $key."_meta_box",
        //'autosave'   => true,
        'title'       =>  'Portfolio Options',
        'pages'       => array( 'page' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            // START PORTFOLIO OPTIONS META BOX

            array(
                'id'          => 'themo_portfolio_filter_bar',
                'name'       =>  'Show Project Filter Bar',
                'desc'       => '',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch'
            ),
            array(
                'id'          => 'themo_filter_by_type',
                'name'       =>  'Filter by Project Type',
                'desc'       => '',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch'
            ),
            array(
                'name'       =>  'Select by Type',
                'id'          => 'themo_filter_project_type_ids',
                'type'    => 'taxonomy_advanced',
                'options' => array(
                    // Taxonomy name
                    'taxonomy' => 'themo_project_type',
                    'type'     => 'select_advanced',
                ),
                'multiple'    => true,
                'class' => 'checkbox-condition themo_filter_by_type',
                'desc'        =>  'Select the Project Types you wish to include',
            ),
            array(
                'id'          => 'themo_projects_per_page',
                'name'       =>  'Project per page.',
                'desc'       =>  'Defaults > Settings > Reading Settings > Blog pages show at most',
                'type'        => 'text',
            ),

            // Portfolio Column Option
            array(
                'id'          => 'themo_cols_per_page',
                'name'       =>  'Number of columns to show',
                'type'        => 'slider',
                'std' => 3,
                // jQuery UI slider options. See here http://api.jqueryui.com/slider/
                'js_options' => array(
                    'min'  => 3,
                    'max'  => 5,
                    'step' => 1,
                ),
            ),
            array(
                'id'          => "themo_orderby",
                'name'       =>  'Order by',
                'std'         => 'date',
                'desc'       => sprintf(  '<strong>Drag and Drop</strong> : %1$s > Sort by Order <br><strong>Manually</strong> using %1$s > Edit > Attributes > Order', $name),
                'type'        => 'select',
                'options'     => array(
                    'date' =>  'Date',
                    'menu_order' =>  'Drag and Drop',
                )
            )

            // END PAGE LAYOUT META BOX
        )
    );
    $meta_boxes[] = $themo_portfolio_options_meta_box;
	//-----------------------------------------------------
    // Blog Category Filter
    //-----------------------------------------------------
        $themo_blog_category_meta_box = array(
            'id'          => 'themo_blog_category_meta_box',
            'title'       => __( 'Category Filter', 'stratus' ),
            'pages'       => array( 'page' ),
            'context'     => 'normal',
            'priority'    => 'default',
            'fields'      => array(
                // START PAGE LAYOUT META BOX

                array(
                    'id'          => 'themo_category_checkbox',
                    'type' => 'taxonomy_advanced',
                    'options' => array(
                        'taxonomy' => 'category',
                        'type'     => 'checkbox_list',
                    ),
                    'multiple'    => true,
                ),
                // END PAGE LAYOUT META BOX
            )
        );
        $meta_boxes[] = $themo_blog_category_meta_box;

    //-----------------------------------------------------
    // Page Layout, Sidebar, Content Editor Sort Order
    //-----------------------------------------------------
    $themo_page_layout_meta_box = array(
        'id'          => 'themo_page_layout_meta_box',
        //'autosave'   => true,
        'title'       =>  'Page Layout',
        'pages'       => array( 'page', 'product' ),
        'context'     => 'side',
        'priority'    => 'default',
        'fields'      => array(
            // START PAGE LAYOUT META BOX

            array(
                'id'          => 'themo_page_layout',
                'name'       => '',
                'std'         => 'full',
                'type'        => 'radio',
                'section'     => 'themo_home_page_meta',
                'class' => 'themo_page_layout',
                'options'     => array(

                    'left' =>  'Left Sidebar',
                    'right' =>  'Right Sidebar',
                    'full' =>  'No Sidebar',
                )
            ),
            array(
                'id'          => 'themo_page_disable_nav_transparency',
                'name'       => 'Disable Nav Transparency',
                'desc'       => 'Force nav header to stay solid.',
                'std'         => 0,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch'

            ),
            // END PAGE LAYOUT META BOX
        )
    );

    $meta_boxes[] = $themo_page_layout_meta_box;


//-----------------------------------------------------
// Page Header
//-----------------------------------------------------
    $key = 'themo_page_header';
    $name = 'Page Header';

    /* Check if Post type exists, if not try to get it via Post ID  */
    if (isset($_GET['post_type']) && $_GET['post_type'] > ""){
        $post_type = $_GET['post_type'];
    }else{
        $post_id = (isset($_GET['post'])) ? $_GET['post'] : ((isset($_POST['post_ID'])) ? $_POST['post_ID'] : false);
        if(isset($post_id) && $post_id > ""){
            $post_type = get_post_type($post_id);
        }
    }

    /* If this is a product post type then set page header display default to 0 (not displayed) */
    if(isset($post_type) && $post_type > "" && $post_type == 'product'){
        $page_header_display_default = 0;
    }else{
        $page_header_display_default = 1;
    }


    $i = 1;


    /* Tabs */
    list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

    /* Header */
    list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

    /* Get Background Options */
    list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

    /* Animation */
    list($animation,$animation_style) = themo_return_animation_options($key,$i);

    /* Get Padding Options */
    list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

    /* Get Border Options */
    list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

    /* Get Button Options */
    list($show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku) = themo_return_button_options($key,$i,'header');

    /* Get Button Options #2 */
    list($show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2) = themo_return_button_options($key,$i,'header','2');


    $themo_page_header_meta = array(
        'id'          => $key."_".$i."_meta_box",
        //'autosave'   => true,
        'title'       => $name,
        'pages'       => array( 'page','product' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'tabs'      => array(
            key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
            key($header_tab) =>  $header_tab[key($header_tab)],
            key($background_tab) =>  $background_tab[key($background_tab)],
            key($animation_tab) =>  $animation_tab[key($animation_tab)],
            key($border_tab) =>  $border_tab[key($border_tab)],
            key($padding_tab) =>  $padding_tab[key($padding_tab)],
        ),
        'tab_style' => 'left',
        'fields'      => array(
            // START HEADER META BOX
            array(
                'id'          => $key."_".$i."_show",
                'name'       =>  'Display',
                'std'         => $page_header_display_default,
                'type'        => 'checkbox',
                'class' => 'checkbox-switch',
                'tab'  =>  'display',
            ),
            
            array(
                'id'          => $key."_".$i."_anchor",
                'name'       =>  'Anchor',
                'type'        => 'text',
                'class' => 'checkbox-condition '.$key."_".$i.'_show anchor-input',
                'tab'  =>  'display',
            ),



            /* Header */
            $show_header,
            array(
                'type' => 'divider',
                'id'          => $key."_".$i.'_divider',
                'tab'  =>  'header',
                'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
            ),
            $glyphicons_icon_set,$glyphicons_icon,
            array(
                'type' => 'divider',
                'id'          => $key."_".$i.'_divider',
                'tab'  =>  'header',
                'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
            ),
            $header,$subtext,$header_float,
            array(
                'type' => 'divider',
                'id'          => $key."_".$i.'_divider',
                'tab'  =>  'header',
                'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
            ),

            /* Button */
            $show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku,

            /* Button 2 */
            $show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2,

            /* Background */
            $show_background,$parallax,$background_color,$background_repeat,$background_attachment,$background_position,$background_size,$background_image,$text_contrast,

            /* Animation */
            $animation,$animation_style,

            /* Borders */
            $show_border, $border, $border_full_width,

            /* Padding */
            $padding,$top_padding,$bottom_padding

            // END HEADER BOX
        )
    );

    $meta_boxes[] = $themo_page_header_meta;
    return $meta_boxes;
}

//======================================================================
// Specific Meta Boxes
//======================================================================

function _themo_specific_meta_boxes($meta_boxes) {

    global $post_id;

    $post_id = (isset($_GET['post'])) ? $_GET['post'] : ((isset($_POST['post_ID'])) ? $_POST['post_ID'] : false);


    //-----------------------------------------------------
    // Meta Box Builder
    //-----------------------------------------------------
    $key = 'themo_meta_box_builder';
    $name = 'Meta Box Builder';

    $i = 1;

    $themo_meta_box_builder_meta = array(
        'id'          => $key."_meta_box",
        //'autosave'   => true,
        'title'       => $name,
        'tabs'      => array(
            'meta_boxes' => array(
                'label' =>  'Meta Boxes',

            ),
            'quantities'  => array(
                'label' =>  'Quantities',

            ),
            'order'  => array(
                'label' =>  'Order',

            ),
        ),

        // Tab style: 'default', 'box' or 'left'. Optional
        'tab_style' => 'left',
        'pages'       => array( 'page' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'id'          => $key."_meta_boxes",
                'name'       =>  'Meta Boxes',
                'type'        => 'checkbox_list',
                'desc' => "<p>Need help? <a href='http://docs.themovation.com/stratus/#metaboxbuilder' target='_blank'>Meta Box Documentation</a></p>",
                'options' => array(
                    'accordion' =>  'Accordion',
                    //'booked_calendar' =>  'Booked Calendar',
                    'brands' =>  'Brands',
                    'call_to_action' =>  'Call to Action',
                    'content_editor' =>  'Content Editor',
                    'conversion_form' =>  'Conversion Form',
                    'faq' =>  'FAQ',
                    'featured' =>  'Featured',
                    'map' =>  'Map',
                    'slider_master' => 'Master Slider',
                    'portfolio' =>  'Portfolio',
                    'pricing_plans' =>  'Pricing Plans',
                    'service_block' =>  'Service Block',
                    'service_block_split' =>  'Service Block Split',
                    'showcase' =>  'Showcase',
                    'slider' =>  'Slider',
                    'team' =>  'Team',
                    'testimonials' =>  'Testimonials',
                    'thumb_slider' =>  'Thumbnail Slider',
                    'tour' =>  'Tour',
                    'html' =>  'WYSIWYG / Rich Text Editor',
                ),
                'class' => 'checkbox-inline',
                'tab'  => 'meta_boxes',

            ),
            // END HEADER BOX
        )
    );

    if ($post_id){

        //-----------------------------------------------------
        // Helper to find label for key.
        //-----------------------------------------------------
        function themo_search_for_meta_value($value, $array) {
            foreach ($array as $key => $val) {
                if ($val['value'] === $value) {
                    return $val['name'];
                }
            }
            return null;
        }

        //-----------------------------------------------------
        // Get Meta Box Selections for this post / page
        // and add quantity sliders
        //-----------------------------------------------------

        $themo_meta_box_builder_meta_boxes = get_post_meta($post_id, 'themo_meta_box_builder_meta_boxes');

        // If there are values, then add meta boxes to page / post.
        if ( isset($themo_meta_box_builder_meta_boxes) && is_array($themo_meta_box_builder_meta_boxes)) {

            // Check General Options to see the max quantity for meta boxes.
            if ( function_exists( 'ot_get_option' ) ) {
                $meta_box_max_quantity = ot_get_option( 'themo_meta_box_builder_meta_box_max_quantity', '5' );
            }

            // Add Tab for Meta Box Quantity Sliders

            foreach($themo_meta_box_builder_meta_boxes as $value => $meta_box_name){ // loop through each metabox and output metabox

                if( $meta_box_name !== 'content_editor' && $meta_box_name !== 'slider' && $meta_box_name !== 'slider_master'){

                    $label = $themo_meta_box_builder_meta['fields'][0]['options'][$meta_box_name];

                    $meta_box_quantity =  array(
                        'name'       => ucfirst($label),
                        'id'          => 'themo_meta_box_quantity_'.$meta_box_name,
                        'type'        => 'slider',
                        'std'  => 1,
                        // jQuery UI slider options. See here http://api.jqueryui.com/slider/
                        'js_options' => array(
                            'min'   => 1,
                            'max'   => $meta_box_max_quantity,
                            'step'  => 1,
                        ),
                        'tab'  => 'quantities',
                    );
                    array_push($themo_meta_box_builder_meta['fields'],$meta_box_quantity);
                }
            }



            //-----------------------------------------------------
            // Sortable
            //-----------------------------------------------------

            // Add Sortable
            array_push($themo_meta_box_builder_meta['fields'],array('id'=> $key."_meta_box_sort_order",/*'autosave' => true,*/'class'=>'type-sortable','name'=>  'Drag and drop to organize','type'=> 'sortable','tab'=> 'order'));

            // Keep track of where we are in the array.
            $fields_count = count($themo_meta_box_builder_meta['fields'])-1;

            $meta_box_sorted_list = array();

            //foreach( $meta_box_sorted_list as $value => $meta_box_name ) {
            foreach( $themo_meta_box_builder_meta_boxes as $value => $meta_box_name ) {

                if($meta_box_name !== 'slider' && $meta_box_name !== 'slider_master'){

                    $label = $themo_meta_box_builder_meta['fields'][0]['options'][$meta_box_name];

                    // See if there are more than 1 copies of this meta box
                    $themo_meta_box_builder_meta_box_quantity = get_post_meta($post_id, 'themo_meta_box_quantity_'.$meta_box_name, true);


                    // If there is more than 1 copy of a meta box, save the value.
                    if(isset($themo_meta_box_builder_meta_box_quantity) && $themo_meta_box_builder_meta_box_quantity > 0){
                        $themo_meta_box_quantity = $themo_meta_box_builder_meta_box_quantity;
                    }else{
                        $themo_meta_box_quantity = 1;
                    }

                    $themo_meta_box_prefix = 'themo_';

                    $x=1; // our counter

                    // for each copy, add the meta box to the page.
                    while($x<=$themo_meta_box_quantity) {
                        $meta_box_sortable = array(
                            'value'       => $themo_meta_box_prefix.$value."_".$x,
                            'name'       => ucfirst($label).themo_return_meta_box_number($x),
                            'meta_name'       => $themo_meta_box_prefix.$meta_box_name."_".$x,
                        );


                        if(isset($themo_meta_box_builder_meta['fields'][$fields_count]['choices']) && $themo_meta_box_builder_meta['fields'][$fields_count]['choices'] > ""){

                            array_push($themo_meta_box_builder_meta['fields'][$fields_count]['choices'],$meta_box_sortable);
                        }else{

                            $choices = array($meta_box_sortable);
                            $themo_meta_box_builder_meta['fields'][$fields_count]['choices']=$choices;
                        }

                        $x++;
                    }
                }

                //$meta_box_order_count++;
            }
        }
    }

    $meta_boxes[] = $themo_meta_box_builder_meta;


    if ($post_id){

        //-----------------------------------------------------
        // Track Max Order Value for Sorting
        //-----------------------------------------------------
        $custom_field_keys = get_post_custom($post_id); // GET ALL CUSTOM META DATA

        // For each Key, loop through and get the max order value.
        foreach ( $custom_field_keys as $key => $value ) {

            $pos_show = strpos($key, '_sortorder_show'); // Only interested in themo fields
            $meta_key = substr($key, 0, $pos_show); // Just the key prefix please.

            $sort_order_key = $meta_key . '_order'; // Add prefix to _order to snag order value.

            if (array_key_exists($sort_order_key, $custom_field_keys)) { // If a sort order value is set, grab it.
                $sort_order = $custom_field_keys[$sort_order_key][0];
                $sort_order_array[] = $sort_order; // Add to array so we can get max value later.
            }
        }
        // Now we have all Order Values in an Array, loop through and get the highest number.
        if(isset($sort_order_array)){
            $sort_order_max = max($sort_order_array); // Store Max Order Value, update Global variable.
            if($sort_order_max > 0){
                global $themo_meta_box_order;
                $themo_meta_box_order = $sort_order_max;
            }
        }

        //-----------------------------------------------------
        // Get Meta Box Selections for this post / page.
        //-----------------------------------------------------
        $themo_meta_box_builder_meta_boxes = get_post_meta($post_id, 'themo_meta_box_builder_meta_boxes');


        // If there are values, then add meta boxes to page / post.
        if ( isset($themo_meta_box_builder_meta_boxes) && is_array($themo_meta_box_builder_meta_boxes)) {
            $i = 1;
            foreach($themo_meta_box_builder_meta_boxes as $value => $meta_box_name){ // loop through each metabox and output metabox
                // How many meta boxes do we need to print?
                $meta_box_multiply = 1;
                $themo_meta_box_quantity = get_post_meta($post_id, "themo_meta_box_quantity_".$meta_box_name, true);

                if(isset($themo_meta_box_quantity) && $themo_meta_box_quantity > 1){
                    $meta_box_multiply = $themo_meta_box_quantity;
                }

                themo_register_meta_box($meta_box_name,$meta_box_multiply,$meta_boxes);


            }
        }

    }

    return $meta_boxes;
}


//======================================================================
// themo_register_meta_box
// Register Specific Meta Box
//======================================================================
function themo_register_meta_box($meta_box_name,$meta_box_multiply = 1,&$meta_boxes){


    global $glyphicons_website;

    switch ($meta_box_name){

        case "accordion":
//-----------------------------------------------------
// Accordion
//-----------------------------------------------------
            $key = 'themo_accordion';
            $name = 'Accordion';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_accordion_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        $sortorder_show,$order,$anchor,
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Accordions */
                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_accordion_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_accordion_meta);

                $meta_boxes[] = $themo_accordion_meta;

            } // END accordion

            break;
        case "booked_calendar":
//-----------------------------------------------------
// BOOKED CALENDAR
//-----------------------------------------------------
            $key = 'themo_booked_calendar';
            $name = 'Booked Calendar';


            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                $themo_booked_calendar_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START BOOKED CAL
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,
                        // END BOOKED CAL
                    )
                );



                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Booked Calendar */

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       =>  'Display Shortcode',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_shortcode',
                        'name'       =>  'Booked-Calendar Shortcode',
                        'type'        => 'text',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_calendar_align",
                        'name'       =>  'Align Calendar',
                        'std'         => 'left',
                        'type'        => 'radio',
                        'options'     => array(
                            'left' => 'Align Left',
                            'center' =>  'Align Center',
                            'right' =>  'Align Right',
                        ),
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_show_tooltip",
                        'name'       =>  'Display Tooltip',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_tooltip_text',
                        'name'       =>  'Text',
                        'type'        => 'text',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_tooltip',
                        'tab'  =>  $key,
                    ),
                    // DIVIDER
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_text_header',
                        'name'       =>  'Heading',
                        'type'        => 'text',
                        'tab'  =>  $key,
                        'add_to_wpseo_analysis' => true,
                    ),
                    // WYSIWYG/RICH TEXT EDITOR
                    array(
                        'name'    =>  'WYSIWYG / Rich Text Editor',
                        'id'          => $key."_".$i.'_text',
                        'type'    => 'wysiwyg',
                        // Set the 'raw' parameter to TRUE to prevent data being passed through wp auto p on save
                        'raw'     => false,
                        'std'     =>  'WYSIWYG default value',
                        // Editor settings, see wp_editor() function: look4wp.com/wp_editor
                        'options' => array(
                            'textarea_rows' => 5,
                            'teeny'         => false,
                            'media_buttons' => true,
                        ),
                        'tab'  =>  $key,
                        'add_to_wpseo_analysis' => true,
                    ),

                    /* Background */
                    $show_background,$parallax,$background_color,$background_repeat,$background_attachment,$background_position,$background_size,$background_image,$text_contrast,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );

                // Check for Edit Lock / hide locked meta box options of ON
                $themo_booked_calendar_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_booked_calendar_meta);

                $meta_boxes[] = $themo_booked_calendar_meta;
            } // END BOOKED CAL LOOP

            break;
        case "brands":
//-----------------------------------------------------
// BRANDS
//-----------------------------------------------------
            $key = 'themo_brands';
            $name = 'Brands';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Link Options */
                list($show_link,$link,$link_target,$link_text) = themo_return_link($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_homepage_logo_list_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,
                    )
                );


                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Logo List */

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_homepage_logo_list_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_homepage_logo_list_meta);


                $meta_boxes[] = $themo_homepage_logo_list_meta;
            } // END BRAND LIST LOOP

            break;
        case "call_to_action":
//-----------------------------------------------------
// CALL TO ACTION
//-----------------------------------------------------
            $key = 'themo_call_to_action';
            $name = 'Call to action';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Button Options */
                list($show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku) = themo_return_button_options($key,$i);
                list($show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2) = themo_return_button_options($key,$i,null,'2');


                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                $themo_homepage_call_to_action_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,

                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_text",
                        'name'       =>  'Text',
                        'type'        => 'text',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                        'add_to_wpseo_analysis' => true,

                    ),
                    /* Button 1 */
                    $show_button_heading,$show_button,$button_text,$button_link,$button_style,$button_link_target,$button_graphic,$add_to_cart_product_id,$add_to_cart_product_sku,
                    /* Button 2 */
                    $show_button_heading_2,$show_button_2,$button_text_2,$button_link_2,$button_style_2,$button_link_target_2,$button_graphic_2,$add_to_cart_product_id_2,$add_to_cart_product_sku_2,
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );

                // Check for Edit Lock / hide locked meta box options of ON
                $themo_homepage_call_to_action_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_homepage_call_to_action_meta);

                $meta_boxes[] = $themo_homepage_call_to_action_meta;
            }

            break;
        case "content_editor":
//-----------------------------------------------------
// Content Editor
//-----------------------------------------------------
            $key = 'themo_content_editor';
            $name = 'Content Editor';

            $i = 1;

            /* Tabs */
            list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

            /* Sort Order */
            list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

            $themo_content_editor_meta = array(
                'id'          => $key."_".$i."_meta_box",
                //'autosave'   => true,
                'title'       => $name,
                'pages'       => array( 'page' ),
                'context'     => 'normal',
                'priority'    => 'high',
                'tabs'      => array(
                    key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                ),
                'tab_style' => 'left',
                'fields'      => array(
                    // START META BOX
                    $sortorder_show,$order,$anchor,
                    // END BOX
                )
            );
            $meta_boxes[] = $themo_content_editor_meta;
            break;
        case "conversion_form":
//-----------------------------------------------------
// CONVERSION FORM
//-----------------------------------------------------
            $key = 'themo_conversion_form';
            $name = 'Conversion Form';


            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                $themo_conversion_form_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START CONVERSION FORM
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,


                        // END CONVERSION FORM
                    )
                );



                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Conversion Form */

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       =>  'Form',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_shortcode',
                        'name'       =>  'Form Shortcode',
                        'type'        => 'text',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_conversion_form_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_conversion_form_meta);
                $meta_boxes[] = $themo_conversion_form_meta;
            } // END CONVERSION LOOP

            break;
        case "faq":
//-----------------------------------------------------
// FAQs
//-----------------------------------------------------
            $key = 'themo_faq';
            $name = 'FAQ';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_float_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* FAQ */
                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,

                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_float_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_float_meta);

                $meta_boxes[] = $themo_float_meta;
            } // END FLOAT LOOP

            break;
        case "featured":
//-----------------------------------------------------
// FEATURED
//-----------------------------------------------------
            $key = 'themo_featured';
            $name = 'Featured';


            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_homepage_featured_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START FEATURED META BOX
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,


                        // END FEATURED META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Featured Items */
                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name." Items",
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),

                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,

                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_homepage_featured_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_homepage_featured_meta);

                $meta_boxes[] = $themo_homepage_featured_meta;
            } // END FEATURED LOOP

            break;
        case "html":
//-----------------------------------------------------
// HTML
//-----------------------------------------------------
            $key = 'themo_html';
            $name = 'HTML';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                $themo_html_editor_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START HTML EDITOR META BOX

                        /* Sort Order */
                        $sortorder_show,$order,$anchor,


                        // END HTML EDITOR META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* HTML EDITOR */
                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       =>  'Content',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'name'    =>  'WYSIWYG / Rich Text Editor',
                        'id'          => $key."_".$i."_content",
                        'type'    => 'wysiwyg',
                        // Set the 'raw' parameter to TRUE to prevent data being passed through wp auto p() on save
                        'raw'     => false,
                        // Editor settings, see wp_editor() function: look4wp.com/wp_editor
                        'options' => array(
                            'textarea_rows' => 4,
                            'teeny'         => false,
                            'media_buttons' => true,
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                        'add_to_wpseo_analysis' => true,
                    ),

                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_html_editor_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_html_editor_meta);

                $meta_boxes[] = $themo_html_editor_meta;
            } // END HTML

            break;
        case "map":
//-----------------------------------------------------
// MAP
//-----------------------------------------------------
            $key = 'themo_map';
            $name = 'Map';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                $themo_gmap_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,

                        // END GOOGLE MAP META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Google Map */
                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name." Shortcode",
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'            => $key."_".$i.'_address',
                        'name'          =>  'Address',
                        'type'          => 'text',
                        'std'           => "Liberty Island, New York, NY 10004, United States",
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'            => $key."_".$i.'_loc',
                        'name'          =>  'Location',
                        'type'          => 'map',
                        'std'           => '',     // 'latitude,longitude[,zoom]' (zoom is optional)
                        'style'         => 'width: 500px; height: 500px',
                        'address_field' => $key."_".$i.'_address', // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_title",
                        'name'       =>  'Title',
                        'std' => 'Our Location',
                        'type'        => 'text',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_height",
                        'name'       =>  'Height',
                        'type'        => 'text',
                        'std' => '300',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_width",
                        'name'       =>  'Width',
                        'desc' =>  'Leave blank for auto.',
                        'type'        => 'text',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    array(
                        'name' =>  'Zoom',
                        'id'          => $key."_".$i."_zoom",
                        'type' => 'slider',
                        'std' => 8,
                        // jQuery UI slider options. See here http://api.jqueryui.com/slider/
                        'js_options' => array(
                            'min'   => 1,
                            'max'   => 20,
                            'step'  => 1,
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_divider',
                        'type'        => 'divider',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_in_heder",
                        'name'       =>  'Replace Header with Map',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch checkbox-condition '.$key."_".$i.'_show',
                        'desc' => 'Map "Display" must be OFF. Page Header Meta Box "Display" must be ON + "Header" ON',
                        'tab'  =>  $key,
                    ),

                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_gmap_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_gmap_meta);
                $meta_boxes[] = $themo_gmap_meta;

            } // END GOOGLE MAP LOOP

            break;
        case "pricing_plans":
//-----------------------------------------------------
// PLANS
//-----------------------------------------------------
            $key = 'themo_pricing_plans';
            $name = 'Pricing Plans';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_plans_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START PLANS META BOX
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,


                        // END PLANS META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Service Plans */

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,
                    array(
                        'id'          => $key."_".$i."_footnote_show",
                        'name'       =>  'Footnote',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_footnote",
                        'name'       =>  'Footnote Copy',
                        'type'        => 'textarea',
                        'rows'        => '3',
                        'class' => 'checkbox-condition '.$key."_".$i.'_footnote_show',
                        'tab'  =>  $key,
                    ),
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_plans_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_plans_meta);

                $meta_boxes[] = $themo_plans_meta;
            } // END PLANS

            break;
        case "service_block":
//-----------------------------------------------------
// SERVICE BLOCKS (Style 1 and 2)
//-----------------------------------------------------
            $key = 'themo_service_block';
            $name = 'Service Block';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);


                $themo_homepage_service_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,
                    )
                );


                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),

                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,

                    array(
                        'id'          => $key."_".$i."_style",
                        'name'       =>  'Layout',
                        'std'         => 'horizontal',
                        'type'        => 'radio',
                        'options'  => array(
                            'horizontal'  => 'Horizontal',
                            'vertical' => 'Vertical',
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show service-block-layout',
                        'tab'  =>  $key,
                    ),

                    array(
                        'id'          => $key."_".$i."_icon_style",
                        'name'       =>  'Icon Style',
                        'std'         => 'standard',
                        'type'        => 'radio',
                        'options'  => array(
                            'standard'  => 'Standard Style',
                            'circle' => 'Circled Style',
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show service-block-style',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_layout_columns",
                        'name'       =>  '1 or 2 columns',
                        'std'         => 1,
                        'type'        => 'radio',
                        'options'  => array(
                            '1'  => '1 Column',
                            '2'  => '2 Column',
                            '3'  => '3 Column'
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show service-block-columns',
                        'tab'  =>  $key,
                    ),

                    array(
                        'id'          => $key."_".$i.'_image',
                        'name'       => $name .  ' Image',
                        'type'        => 'image_advanced',
                        'max_file_uploads' => 1,
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),

                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_homepage_service_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_homepage_service_meta);

                $meta_boxes[] = $themo_homepage_service_meta;

            }// END SERVICE LOOP

            break;
        case "service_block_split":
//-----------------------------------------------------
// SERVICE BOXES SPLIT LOOP
//-----------------------------------------------------
            $key = 'themo_service_block_split';
            $name = 'Service Block Split';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,"themo_service_block",$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);



                $themo_homepage_service_split_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START SERVICE META BOX
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,
                        // END SERVICE SPLIT META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header *//* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       =>  'Service Block',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,

                    array(
                        'id'          => $key."_".$i.'_show_content',
                        'name'       =>  'HTML',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_content',
                        'name'       =>  'Text',
                        'type'        => 'wysiwyg',
                        'placeholder' =>  'Enter your text...',
                        'options' => array(
                            'textarea_rows' => 4,
                            'teeny'         => false,
                            'media_buttons' => true,
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_content',
                        'tab'  =>  $key,
                        'add_to_wpseo_analysis' => true,
                    ),
                    array(
                        'id'          => $key."_".$i.'_reverse',
                        'name'       =>  'Reverse Alignment',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );

                // Check for Edit Lock / hide locked meta box options of ON
                $themo_homepage_service_split_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_homepage_service_split_meta);

                $meta_boxes[] = $themo_homepage_service_split_meta;

            }// END SERVICE SPLIT LOOP

            break;
        case "showcase":
//-----------------------------------------------------
// SHOWCASE
//-----------------------------------------------------
            $key = 'themo_showcase';
            $name = 'Showcase';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP
                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,"themo_service_block",$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_showcase_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START SHOWCASE META BOX

                        /* Sort Order */
                        $sortorder_show,$order,$anchor,

                        // END TOUR META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Showcase Blocks */

                    array(
                        'id'          => $key."_".$i.'_show_floating_block',
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_content_heading',
                        'name'       =>  'Title',
                        'type'        => 'text',
                        'placeholder' =>  'Add your title...',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_floating_block',
                        'tab'  =>  $key,
                        'add_to_wpseo_analysis' => true,
                    ),
                    array(
                        'id'          => $key."_".$i.'_content',
                        'name'       =>  'Text',
                        'type'        => 'wysiwyg',
                        'placeholder' =>  'Enter your text...',
                        // Editor settings, see wp_editor() function: look4wp.com/wp_editor
                        'options' => array(
                            'textarea_rows' => 4,
                            'teeny'         => false,
                            'media_buttons' => true,
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_floating_block',
                        'tab'  =>  $key,
                        'add_to_wpseo_analysis' => true,
                    ),
                    array(
                        'id'          => $key."_".$i.'_image',
                        'name'       => $name .  ' Image',
                        'type'        => 'image_advanced',
                        'max_file_uploads' => 1,
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_floating_block',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_image_float',
                        'name'       =>  'Align Image',
                        'std'         => 'left',
                        'type'        => 'radio',
                        'options'  => array(
                            'left'  => 'Left Align',
                            'centered' => 'Centered',
                            'right'  => 'Right Align'
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_floating_block',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name. ' Bullet Items',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,

                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_showcase_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_showcase_meta);

                $meta_boxes[] = $themo_showcase_meta;

            }// END SHOWCASE LOOP

            break;
        case "slider":
//-----------------------------------------------------
// Slider
//-----------------------------------------------------
            $key = 'themo_slider';
            $name = 'Slider';
            $i = '';

            /* Tabs */
            list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

            /* Animation */
            list($animation,$animation_style) = themo_return_animation_options($key,$i);

            /* Get Custom Post Type */
            list($custom_post_type_options) = themo_return_custom_post_type_options($key,'flex',null,$name);

            /* Get Term Options */
            list($terms_options) = themo_return_term_options($key,'flex','themo_cpt_group');

            /* Order By Options */
            list($order_by_options) = themo_return_order_by_options($key,'flex',$name);

            $themo_slider_meta = array(
                'id'          => $key.'_meta_box',
                //'autosave'   => true,
                'title'       => $name.themo_return_meta_box_number($i),
                'pages'       => array( 'page' ),
                'context'     => 'normal',
                'priority'    => 'high',
                'tabs'      => array(
                    key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                    key($key_tab) =>  $key_tab[key($key_tab)],
                    key($animation_tab) =>  $animation_tab[key($animation_tab)],
                ),
                'tab_style' => 'left',
                'fields'      => array(
                    // START SLIDER META BOX
                    array(
                        'id'          => $key."_sortorder_show",
                        'name'       =>  'Display',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  'display',
                    ),
                    array(
                        'id'          => $key."_anchor",
                        'name'       =>  'Anchor',
                        'type'        => 'text',
                        'class' => 'checkbox-condition '.$key.'_sortorder_show anchor-input',
                        'tab'  =>  'display',
                    ),
                    // END SLIDER META BOX
                )
            );

            // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
            $locked_options = array(
                array(
                    'id'          => $key."_flex_show",
                    'name'       => 'Flexslider',
                    'std'         => 0,
                    'type'        => 'checkbox',
                    'class' => 'checkbox-switch',
                    'tab'  =>  $key,
                ),
                // Select Custom Post Type
                $custom_post_type_options,
                // Select Terms
                $terms_options,
                // Order By Options
                $order_by_options,

                array(
                    'type' => 'divider',
                    'id'   => 'fake_divider_id', // Not used, but needed
                    'tab'  =>  $key,
                ),
                array(
                    'id'          => $key."_down_arrow",
                    'name'       => 'Down Arrow',
                    'std'         => 0,
                    'type'        => 'checkbox',
                    'class' => 'checkbox-switch',
                    'tab'  =>  $key,
                ),
                array(
                    'id'          => $key."_down_arrow_anchor",
                    'name'       =>  'Anchor',
                    'type'        => 'text',
                    'placeholder' =>  '#anchor',
                    'class' => 'checkbox-condition '.$key."_down_arrow",
                    'tab'  =>  $key,
                ),

                /* Animation */
                $animation,$animation_style,

            );


            // Check for Edit Lock / hide locked meta box options of ON
            $themo_slider_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_slider_meta);

            //ot_register_meta_box( $themo_slider_meta );
            $meta_boxes[] = $themo_slider_meta;

            break;
        case "team":
//-----------------------------------------------------
// TEAM
//-----------------------------------------------------
            $key = 'themo_team';
            $name = 'Team';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_team_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START TEAM META BOX
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,


                        // END TEAM META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Meet the Team */
                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       =>  'Team Members',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );

                // Check for Edit Lock / hide locked meta box options of ON
                $themo_team_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_team_meta);

                $meta_boxes[] = $themo_team_meta;
            } // END TEAM LOOP

            break;
        case "testimonials":
//-----------------------------------------------------
// TESTIMONIALS
//-----------------------------------------------------
            $key = 'themo_testimonials';
            $name = 'Testimonials';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_homepage_testimonials_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START Testimonials META BOX
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,


                        // END Testimonials META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Testimonials */
                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,


                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_homepage_testimonials_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_homepage_testimonials_meta);

                $meta_boxes[] = $themo_homepage_testimonials_meta;
            } // END TESTIMONIAL LOOP

            break;
        case "thumb_slider":

//-----------------------------------------------------
// Thumbnail Slider
//-----------------------------------------------------
            $key = 'themo_thumb_slider';
            $name = 'Thumbnail Slider';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Animation */
                list($animation,$animation_style) = themo_return_animation_options($key,$i);

                /* Get Link Options */
                list($show_link,$link,$link_target,$link_text) = themo_return_link($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);

                $themo_homepage_thumbslide_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($animation_tab) =>  $animation_tab[key($animation_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START THUMB SLIDER META BOX
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,

                        // END THUMB SLIDER META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Thumbs */

                    array(
                        'id'          => $key."_".$i.'_show',
                        'name'       => $name.' Items',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key."_".$i.'_image_orientation',
                        'name'       =>  'Image Orientation',
                        'std'         => 'landscape',
                        'type'        => 'radio',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'options'  => array(
                            'landscape'  => 'Landscape',
                            'portrait' => 'Portrait',
                        ),
                        'tab'  =>  $key,
                    ),

                    array(
                        'id'          => $key."_".$i.'_lightbox',
                        'name'       => 'Enable Lightbox',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),

                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Animation */
                    $animation,$animation_style,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_homepage_thumbslide_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_homepage_thumbslide_meta);

                $meta_boxes[] = $themo_homepage_thumbslide_meta;

            } // END Thumbnail Slider

            break;
        case "tour":
//-----------------------------------------------------
// Tour
//-----------------------------------------------------
            $key = 'themo_tour';
            $name = 'Tour';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_cpt_group','Group');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);


                $themo_float_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(

                        // START FLOATING META BOX
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,

                    ) // END FLOATING META BOX
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(

                    /* Content with Floating Image */

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,

                );


                // Check for Edit Lock / hide locked meta box options of ON
                $themo_float_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_float_meta);


                $meta_boxes[] = $themo_float_meta;
            } // END FLOAT LOOP

            break;
        case "portfolio":
//-----------------------------------------------------
// Portfolio
//-----------------------------------------------------
            $key = 'themo_portfolio';
            $name = 'Portfolio';

            for ($i = 1;$i <= $meta_box_multiply;$i++) { // LOOP

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Header */
                list($show_header,$header,$subtext,$header_float,$glyphicons_icon_set,$glyphicons_icon) = themo_return_meta_header($key,$i);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);

                /* Get Background Options */
                list($show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast) = themo_return_background_options($key,$i);

                /* Get Border Options */
                list($show_border, $border, $border_full_width) = themo_return_border_options($key,$i);

                /* Get Padding Options */
                list($padding,$top_padding,$bottom_padding) = themo_return_padding_options($key,$i);

                /* Get Custom Post Type */
                list($custom_post_type_options) = themo_return_custom_post_type_options($key,$i,null,$name);

                /* Get Term Options */
                list($terms_options) = themo_return_term_options($key,$i,'themo_project_type','Project Type');

                /* Order By Options */
                list($order_by_options) = themo_return_order_by_options($key,$i,$name);


                $themo_portfolio_meta = array(
                    'id'          => $key."_".$i."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page' ),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($header_tab) =>  $header_tab[key($header_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                        key($background_tab) =>  $background_tab[key($background_tab)],
                        key($border_tab) =>  $border_tab[key($border_tab)],
                        key($padding_tab) =>  $padding_tab[key($padding_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        /* Sort Order */
                        $sortorder_show,$order,$anchor,
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(
                    /* Header */
                    $show_header,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $glyphicons_icon_set,$glyphicons_icon,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),
                    $header,$subtext,$header_float,
                    array(
                        'type' => 'divider',
                        'id'          => $key."_".$i.'_divider',
                        'tab'  =>  'header',
                        'class' => 'checkbox-condition '.$key."_".$i.'_show_header',
                    ),

                    /* Portfolio Options */

                    array(
                        'id'          => $key."_".$i."_show",
                        'name'       => $name,
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),

                    array(
                        'id'          => $key.'_'.$i.'_filter_bar',
                        'name'       =>  'Show Project Filter Bar',
                        'desc'       => '',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    // Select Custom Post Type
                    $custom_post_type_options,
                    // Select Terms
                    $terms_options,
                    // Order By Options
                    $order_by_options,

                    // Portfolio Column Option
                    array(
                        'id'          => $key.'_'.$i.'_cols_per_page',
                        'name'       => 'Number of columns to show',
                        'std'         => 3,
                        'type'        => 'slider',
                        // jQuery UI slider options. See here http://api.jqueryui.com/slider/
                        'js_options' => array(
                            'min'  => 3,
                            'max'  => 5,
                            'step' => 1,
                        ),
                        'class' => 'checkbox-condition '.$key."_".$i.'_show',
                        'tab'  =>  $key,
                    ),
                    /* Background */
                    $show_background,$background_color,$background_image,$parallax,$background_repeat,$background_attachment,$background_position,$background_size,$text_contrast,
                    /* Borders */
                    $show_border, $border, $border_full_width,
                    /* Padding */
                    $padding,$top_padding,$bottom_padding
                );

                // Check for Edit Lock / hide locked meta box options of ON
                $themo_portfolio_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_portfolio_meta);

                //ot_register_meta_box( $themo_portfolio_meta );
                $meta_boxes[] = $themo_portfolio_meta;
            }

            break;


        case "slider_master":
//-----------------------------------------------------
// MASTER SLIDER
//-----------------------------------------------------
            $key = 'themo_slider_master';
            $name = 'Master Slider';
            $i = '';

                /* Tabs */
                list($sortorder_tab,$header_tab,$background_tab,$border_tab,$padding_tab,$animation_tab,$key_tab) = themo_return_tabs($key,$name);

                /* Sort Order */
                list($sortorder_show,$order,$anchor) = themo_return_sort_order($key,$i);


                $themo_master_slider_meta = array(
                    'id'          => $key."_meta_box",
                    //'autosave'   => true,
                    'title'       => $name.themo_return_meta_box_number($i),
                    'pages'       => array( 'page'),
                    'context'     => 'normal',
                    'priority'    => 'high',
                    'tabs'      => array(
                        key($sortorder_tab) =>  $sortorder_tab[key($sortorder_tab)],
                        key($key_tab) =>  $key_tab[key($key_tab)],
                    ),
                    'tab_style' => 'left',
                    'fields'      => array(
                        // START HTML EDITOR META BOX

                        // START SLIDER META BOX
                        array(
                            'id'          => $key."_sortorder_show",
                            'name'       =>  'Display',
                            'std'         => 0,
                            'type'        => 'checkbox',
                            'class' => 'checkbox-switch',
                            'tab'  =>  'display',
                        ),
                        array(
                            'id'          => $key."_anchor",
                            'name'       =>  'Anchor',
                            'type'        => 'text',
                            'class' => 'checkbox-condition '.$key.'_sortorder_show anchor-input',
                            'tab'  =>  'display',
                        ),
                        // END HTML EDITOR META BOX
                    )
                );

                // Meta Box Options. We separate meta box options into a unique array so we can include if edit lock is not on.
                $locked_options = array(

                    array(
                        'id'          => $key."_show",
                        'name'       =>  'Display Shortcode',
                        'std'         => 0,
                        'type'        => 'checkbox',
                        'class' => 'checkbox-switch',
                        'tab'  =>  $key,
                    ),
                    array(
                        'id'          => $key.'_shortcode',
                        'name'       =>  'Master Slider Shortcode',
                        'type'        => 'text',
                        'class' => 'checkbox-condition '.$key.'_show',
                        'tab'  =>  $key,
                    ),
                );


                // Check for Edit Lock / hide locked meta box options of ON
            $themo_master_slider_meta = themo_edit_lock_check($key,$i,$locked_options,$themo_master_slider_meta);

                $meta_boxes[] = $themo_master_slider_meta;


            break;
    }
    //-----------------------------------------------------
    // END SWITCH
    //-----------------------------------------------------
}
?>