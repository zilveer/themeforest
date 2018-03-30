<?php

#-------------------------------------------------------------
# Smooth Theme Framework Version
#-------------------------------------------------------------
function st_framework_version_init(){
    $st_framework_version = '1.0';
    if(get_option('st_framework_version_init') != $st_framework_version){
        update_option('st_framework_version',$st_framework_version);
    }
}
add_action('init','st_framework_version_init',10);


#-------------------------------------------------------------
# Define Admin Path and URL
#-------------------------------------------------------------
define('ST_ADMIN_PATH',dirname(__FILE__));
define('ST_ADMIN_URL',ST_URL.'admin');

define('ST_PAGE_TITLE',ST_THEME_NAME.' Settings Page');   // Theme Option Title
define('ST_MENU_TITLE',ST_THEME_NAME);					 // Theme Option Menu Title
define('ST_PAGE_SLUG','smooththemes');				 // Theme Option URL Slug


#-------------------------------------------------------------
# Load the required Framework Files
#-------------------------------------------------------------

// kiểm tra tính hợp lệ của ajax
$current_user = wp_get_current_user();
$ajax_nonce = wp_create_nonce($current_user->ID);
//check_ajax_referer( $current_user->ID, 'ajax_nonce' );

if(is_admin()){


    add_action( 'wp_ajax_smooththemes_save_option_action', 'smooththemes_save_option_action' );
    function smooththemes_save_option_action() {
        $st_default_lang_code = get_bloginfo('language'); // DO NOT REMOVE
        if(isset($_POST['save']) && $_POST['save']=='Y'){

            $data = array();
            foreach( $_POST as $key => $arr ){
                if(strpos($key, ST_SETTINGS_OPTION)!==false){
                    $k = str_replace(ST_SETTINGS_OPTION.'_', '', $key);
                    $data[$k]= $arr;
                }
            }

            if(st_is_wpml()){
                // ICL_LANGUAGE_CODE
                //  echo var_dump($st_default_lang_code,ICL_LANGUAGE_CODE);
                if($st_default_lang_code==ICL_LANGUAGE_CODE || ICL_LANGUAGE_CODE=='' || strpos($st_default_lang_code,ICL_LANGUAGE_CODE)!==false){
                    // update_option(ST_FRAMEWORK_SETTINGS_OPTION,$_POST[ST_FRAMEWORK_SETTINGS_OPTION]);
                    update_option(ST_SETTINGS_OPTION,$data);
                }
                update_option(ST_SETTINGS_OPTION.'_'.ICL_LANGUAGE_CODE, $data);
                do_action('st_save_options',$data);

            }else{

                 echo ST_SETTINGS_OPTION;

                update_option(ST_SETTINGS_OPTION,$data);
                do_action('st_save_options', $data );
            }


            flush_rewrite_rules();
        }
        echo 1;
        die();
    }




    // for media
    function st_image_attachment_fields_to_edit($form_fields, $post){
        $form_fields["st_custom"]["label"] = '';
        $form_fields["st_custom"]["input"] = "html";

        $image_attributes = wp_get_attachment_image_src( $post->ID ,'medium' ); // returns an array

        $form_fields["st_custom"]["html"] = '

            <input type="hidden"  class="st_attach_btn" data-src = "'.$image_attributes[0].'"   post_id ="'.$post->ID.'" >
            ';


        return $form_fields;
    }

    add_filter("attachment_fields_to_edit", "st_image_attachment_fields_to_edit", null, 99);

    //----------------Show image size in mediabox-------------------
    function st_insert_custom_image_sizes( $sizes ) {
        // get the custom image sizes
        global $_wp_additional_image_sizes;
        // if there are none, just return the built-in sizes
        if ( empty( $_wp_additional_image_sizes ) )
            return $sizes;

        // add all the custom sizes to the built-in sizes
        foreach ( $_wp_additional_image_sizes as $id => $data ) {
            // take the size ID (e.g., 'my-name'), replace hyphens with spaces,
            // and capitalise the first letter of each word
            if ( !isset($sizes[$id]) )
                $sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
        }

        return $sizes;
    }

    add_filter( 'image_size_names_choose', 'st_insert_custom_image_sizes' );



    include(ST_ADMIN_PATH.'/editor/editor.php');

    include(ST_ADMIN_PATH.'/admin-users.php');
    include(ST_ADMIN_PATH.'/admin-functions.php');
    include(ST_ADMIN_PATH.'/admin-menu.php');
    include(ST_ADMIN_PATH.'/admin-scripts.php');
    include(ST_ADMIN_PATH.'/ajax-media.php');
    //  include(ST_ADMIN_PATH.'/ajax-slidebar-generator.php');

    //
    if(file_exists(ST_ADMIN_PATH.'/page-builder/page-builder.php')){
        include(ST_ADMIN_PATH.'/page-builder/page-builder.php');
    }

    if(file_exists(ST_ADMIN_PATH.'/review-control/review.php')){
        include(ST_ADMIN_PATH.'/review-control/review.php');
    }

    include(ST_ADMIN_PATH.'/admin-meta-box.php');
    include(ST_DIR.'/settings/meta-box-settings.php');
    include(ST_ADMIN_PATH.'/admin-post-type.php');


    include(ST_ADMIN_DIR.'admin-customize.php');

    include(ST_ADMIN_DIR.'post-type-meta/event.php');
    include(ST_ADMIN_DIR.'post-type-meta/room.php');
    include(ST_ADMIN_DIR.'post-type-meta/gallery.php');

}







