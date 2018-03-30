<?php

/*
 * Metaboxes in different post types
 */
function a13_admin_meta_boxes(){
    add_meta_box(
        'apollo13_theme_options',
        __be( 'Blog post details' ),
        'a13_meta_main_opts',
        'post',
        'normal',
        'high',
        array('func' => 'apollo13_metaboxes_post')//callback
    );
    add_meta_box(
        'apollo13_theme_options',
        __be( 'Page details' ),
        'a13_meta_main_opts',
        'page',
        'normal',
        'low',
        array('func' => 'apollo13_metaboxes_page')//callback
    );
    add_meta_box(
        'apollo13_theme_options',
        __be( 'Work details' ),
        'a13_meta_main_opts',
        A13_CUSTOM_POST_TYPE_WORK,
        'normal',
        'low',
        array('func' => 'apollo13_metaboxes_cpt_work')//callback
    );
    add_meta_box(
        'apollo13_theme_options_1',
        __be( 'Work media - Add images/videos' ),
        'a13_meta_main_opts',
        A13_CUSTOM_POST_TYPE_WORK,
        'normal',
        'low',
        array('func' => 'apollo13_metaboxes_cpt_images')//callback
    );
    add_meta_box(
        'apollo13_theme_options',
        __be( 'Gallery details' ),
        'a13_meta_main_opts',
        A13_CUSTOM_POST_TYPE_GALLERY,
        'normal',
        'low',
        array('func' => 'apollo13_metaboxes_cpt_gallery')//callback
    );
    add_meta_box(
        'apollo13_theme_options_1',
        __be( 'Gallery media - Add images/videos' ),
        'a13_meta_main_opts',
        A13_CUSTOM_POST_TYPE_GALLERY,
        'normal',
        'low',
        array('func' => 'apollo13_metaboxes_cpt_images')//callback
    );
}


/*
 * Generates inputs in metaboxes
 */
function a13_meta_main_opts( $post, $metabox ){

    // Use nonce for verification
    wp_nonce_field( 'apollo13_customization' , 'apollo13_noncename' );

    $a13_prefix = A13_INPUT_PREFIX;

    require_once (A13_TPL_ADV_DIR . '/meta.php');
    $metaboxes = $metabox['args']['func']();

    $fieldset_open = false;
    $additive_mode = false;
    $thumbs_mode = false;

    echo '<div class="apollo13-settings apollo13-metas">';
    //shows all meta fields of post in multi dimensional array
//        var_dump($custom = get_post_custom($post->ID));

    foreach( $metaboxes as &$meta ){
        //ASSIGNING VALUE
        $value = '';
        if ( isset( $meta['id'] ) ){
            //additive_mode
            if(isset( $meta['additive'] ) && $meta['additive'] === true){
                $additive_mode = true;
            }

            $value = get_post_meta($post->ID, '_'.$meta['id'] , true);

            //use default if no value
            if( !strlen($value) ){
                $value = ( isset( $meta['default'] )? $meta['default'] : '' );
            }
        }

        $params = array(
            'style' => '',
            'value' => $value
        );

        /*
        * print tag according to type
        */

        if ( $meta['type'] == 'fieldset' ) {
            if ( $fieldset_open ) {
                a13_close_meta_fieldset($thumbs_mode);
            }

            $title = '';
            $class = ' static';
            if( $additive_mode ){
                $class = ' additive prototype';
                $additive_mode = true;

                //hidden textarea with JSON of all images
                echo '<textarea id="' . $a13_prefix.$meta['id'] . '" name="' . $a13_prefix.$meta['id'] . '">'.$value.'</textarea>';
//                    echo '<textarea id="' . $meta['id'] . '" name="' . $meta['id'] . '" type="hidden" value="' . $value . '" />';
            }

            echo '<div class="fieldset' . $class . '">';
            $fieldset_open = true;

            if(isset($meta['for_thumbs']) && $meta['for_thumbs'] ==  true){
                $thumbs_mode = true;
                echo '
                    <div class="thumb-info clearfix">
                        <img class="info-thumb" style="display: none;" src="" alt="" />
                        <span class="thumb-show-fields" data-swaptext="'.__be('Hide').'">'.__be('Show').'</span>
                        <span class="button remove-fieldset">'.__be('Remove item').'</span>
                        <span class="thumb-title"></span>
                    </div>
                    <div class="thumb-fields" style="display: none;">';
            }
        }

        //checks for all normal options
        elseif( a13_print_form_controls($meta, $params, true ) ){
            continue;
        }

        /***********************************************
         * SPECIAL field types
         ************************************************/

        elseif ( $meta['type'] == 'adder' ) {
            if ( $fieldset_open ) {
                a13_close_meta_fieldset($thumbs_mode);
                $fieldset_open = false;
                $additive_mode = false;
                $thumbs_mode = false;
            }
            echo '<div class="add-more-parent"><span class="button button-hero add-more-fields"><span>+</span>' . $meta['name'] . '</span></div>';
        }

        elseif ( $meta['type'] == 'multi-upload' ) {
            echo '<div class="a13-mu-container">
                    <input id="a13-multi-upload" type="button" value="'.esc_attr( __be('Select/Upload many images') ).'" class="button button-hero" />
                    <p class="desc">'.__be('To mark more items in Media Library hold <code>Ctrl</code> or <code>Cmd</code> key while selecting them.').'</p>
                 </div>';
        }
    } //end foreach

    unset($meta);// be safe, don't loose your hair :-)

    //close fieldset
    if ( $fieldset_open ) {
        a13_close_meta_fieldset($thumbs_mode);
    }

    echo '</div>';//.apollo13-settings .apollo13-metas
}


function a13_close_meta_fieldset($thumbs_mode){
    if($thumbs_mode == true){
        echo '</div>';
    }
    echo '</div>';
}


/*
 * Saving metas in post
 */
function a13_save_post($post_id){
    static $done = 0;
    $done++;
    if( $done > 1 ){
        return;//no double saving same things
    }

    $a13_prefix = A13_INPUT_PREFIX;

    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    if( ! isset( $_POST['apollo13_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['apollo13_noncename'], 'apollo13_customization' ) )
        return;

    require_once (A13_TPL_ADV_DIR . '/meta.php');

    $metaboxes = array();

    switch( $_POST['post_type'] ){
        case 'post':
            $metaboxes = apollo13_metaboxes_post();
            break;
        case 'page':
            $metaboxes = apollo13_metaboxes_page();
            break;
        case A13_CUSTOM_POST_TYPE_WORK:
            $metaboxes = array_merge( apollo13_metaboxes_cpt_work(), apollo13_metaboxes_cpt_images() );
            break;
        case A13_CUSTOM_POST_TYPE_GALLERY:
            $metaboxes = array_merge( apollo13_metaboxes_cpt_gallery(), apollo13_metaboxes_cpt_images() );
            break;
    }

    //saving meta
        $additive_mode = false;
    foreach( $metaboxes as &$meta ){
        //don't save fields of prototype
        if($additive_mode){
            if($meta['type'] === 'adder'){
                $additive_mode = false;
            }
            continue;
        }

        if( $meta['type'] == 'fieldset' && isset( $meta['additive'] ) ){
            $additive_mode = true;
        }
        if( isset( $meta['id'] ) && isset( $_POST[ $a13_prefix.$meta['id'] ] ) ){
            $val = $_POST[ $a13_prefix.$meta['id'] ];
            update_post_meta( $post_id, '_'.$meta['id'] , $val );
        }
    }
}



add_action( 'add_meta_boxes', 'a13_admin_meta_boxes');
//Do something with the data entered
add_action( 'save_post', 'a13_save_post' );

