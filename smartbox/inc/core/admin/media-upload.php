<?php
/**
 * Oxygenna.com
 *
 * $Template:: Smartbox
 * $Copyright:: (c) 2013 Oxygenna.com
 * $Licence:: http://wiki.envato.com/support/legal-terms/licensing-terms/
 */

class OxyMediaUpload {
    function __construct() {
        if( isset( $_REQUEST['oxy_upload_to_option'] ) ) {
            // remove url tab
            add_filter( 'media_upload_tabs', array( &$this, 'option_image_upload_tabs') );
            // fix image view in media library
            add_filter( 'attachment_fields_to_edit', array( &$this, 'image_attachments' ), 10, 2 );
            // add extra parameter to upload url
            add_filter( 'media_upload_form_url', array( &$this, 'upload_form_extra_parameter'), 10, 2 );
            // add extra parameter to html5 upload
            add_filter( 'upload_post_params', array( &$this, 'image_upload_post_params') );
            // load image-option javascript
            wp_enqueue_script( 'theme-options-upload', ADMIN_JS_URI . 'theme-options-upload.js' );
        }
    }

    function upload_form_extra_parameter( $form_action_url, $type ) {
        $form_action_url = $form_action_url . '&oxy_upload_to_option=true&amp;input_id=' . $_GET['input_id'];
        return $form_action_url;
    }

    function image_attachments( $form_fields, $post ) {
        // remove all fields from image
        unset( $form_fields );
        // add url title and excerpt as a hidden field
        $form_fields['post_excerpt'] = array( 'input' => 'hidden', 'name' => 'url', 'value' => $post->post_excerpt );
        $form_fields['post_title'] = array( 'input' => 'hidden', 'name' => 'url', 'value' => $post->post_title );
        $form_fields['url'] = array( 'input' => 'hidden', 'name' => 'url', 'value' => $post->guid );
        $form_fields['image-size'] = array( 'input' => 'hidden', 'name' => 'image-size', 'value' => 'full' );

        // add select image button
        $send = '<input type="submit" onclick="oxyThemeOptions.mediaOptionSelectImage(\'' . $_REQUEST['input_id'] . '\',\'' . $post->guid . '\',\'' . $post->ID . '\')" class="button" value="' .__('Select Image', THEME_ADMIN_TD) . '">';

        $form_fields['buttons'] = array( 'tr' => "\t\t<tr class='submit'><td></td><td class='savesend'>$send</td></tr>\n" );

        return $form_fields;
    }

    function option_image_upload_tabs( $tabs ) {
        // remove direct url image
        unset( $tabs['type_url'] );
        return $tabs;
    }

    function image_upload_post_params( $params ) {
        $params['oxy_upload_to_option'] = 1;
        $params['input_id'] = $_GET['input_id'];
        unset( $params['short'] );
        return $params;
    }
}