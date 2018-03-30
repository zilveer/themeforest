<?php

function dt_posts_parents_where( $where ) {
	global $wpdb;
	$query = dt_parent_where_query();
	if( $query ) { 
		$where .= sprintf( " AND %s.post_parent IN(%s)", $wpdb->posts, $query );
	}
	return $where;
}

function the_category_filter($thelist,$separator=' ') {
   $thelist = str_replace(' rel="category"', '', $thelist);
   return $thelist;
}
add_filter('the_category','the_category_filter', 10, 2);

//Image with caption filter
function fb_img_caption_shortcode($attr, $content = null) {
	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));
 $id = 'id="' . $id . '" ';
	return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width) . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_shortcode('wp_caption', 'fb_img_caption_shortcode');
add_shortcode('caption', 'fb_img_caption_shortcode');
add_shortcode('img_caption_shortcode', 'fb_img_caption_shortcode');

// Change what's hidden by default
add_filter('default_hidden_meta_boxes', 'be_hidden_meta_boxes', 10, 2);
function be_hidden_meta_boxes($hidden, $screen) {
	if ( 'post' == $screen->base || 'page' == $screen->base )
		$hidden = array(
			'slugdiv',
			'trackbacksdiv',
			'authordiv',
			'revisionsdiv',
			'dt_page_box-gallery',
			'dt_page_box-homeslider',
			'dt_page_box-portfolio',
			'dt_page_box-homevideo'
		);
		// removed 'postcustom',
	return $hidden;
}

// custom mediauploader tab action for gallery
function dt_a_album_mu() {
    $errors = array();

    if ( !empty($_POST) ) {
        $return = media_upload_form_handler();

        if ( is_string($return) )
            return $return;
        if ( is_array($return) )
            $errors = $return;
    }

    wp_enqueue_style( 'media' );
    wp_enqueue_script('admin-gallery');
    
    return wp_iframe( 'dt_album_media_form', $errors );
}
add_action( 'media_upload_dt_gallery_media', 'dt_a_album_mu' );

// media uploader for gallery filter
function dt_f_album_mu($tabs) {
    $post_id = isset( $_REQUEST['post_id'] ) ? absint( $_REQUEST['post_id'] ) : null;
	if ( 'dt_gallery_plus' == get_post_type( $post_id ) ) {
		global $wpdb;
        
        if( isset($tabs['library']) ) {
			unset($tabs['library']);
		}
		
        if( isset($tabs['gallery']) ) {
			unset($tabs['gallery']);
		}
        
        if( isset($tabs['type_url']) ) {
			unset($tabs['type_url']);
		}
        
  
        if ( $post_id ) {
            $attachments = intval( $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM $wpdb->posts WHERE post_type = 'attachment' AND post_status != 'trash' AND post_parent = %d", $post_id ) ) );
        }
        
        if ( empty($attachments) ) {
            return $tabs;
        }
    
		if( !isset($tabs['dt_gallery_media'])) {
			$tabs['dt_gallery_media'] = sprintf(__('Images (%s)', LANGUAGE_ZONE), "<span id='attachments-count'>$attachments</span>");
		}
        
        if( isset($tabs['type']) ) {
            $tabs['type'] = 'Upload';
        }
	}
	return $tabs;
}
add_filter('media_upload_tabs', 'dt_f_album_mu', 99 );

// filter prevent loading gallery after save uploaded images
function dt_f_album_aftos( $post, $attachments ) {
    if( 'dt_gallery_plus' == get_post_type($_REQUEST['post_id']) ) {
        if( isset($_GET['tab']) && 'type' == $_GET['tab']) {
            unset($_POST['save']);
        }
    }
    return $post;
}
add_filter( 'attachment_fields_to_save', 'dt_f_album_aftos', 99, 2 );

// fields filter for custom uploader
function dt_f_album_att_fields($fields, $post) {
	if( 'dt_gallery_plus' == get_post_type($post->post_parent) ) {
        unset($fields['align']);
        unset($fields['image-size']);
        unset($fields['post_content']);
        unset($fields['image_alt']);
		unset($fields['url']);
	}
	return $fields;
}
add_filter('attachment_fields_to_edit', 'dt_f_album_att_fields', 99, 2);

// slideshow iframe uploader
function dt_f_slider_mu($tabs) {
	$post_id = isset( $_REQUEST['post_id'] ) ? absint( $_REQUEST['post_id'] ) : null;
	if ( 'main_slider' == get_post_type( $post_id ) ) {
		global $wpdb;
        
        if( isset($tabs['library']) ) {
			unset($tabs['library']);
		}
		
        if( isset($tabs['gallery']) ) {
			unset($tabs['gallery']);
		}
        
        if( isset($tabs['type_url']) ) {
			unset($tabs['type_url']);
		}
        
        if ( $post_id ) {
            $attachments = intval( $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM $wpdb->posts WHERE post_type = 'attachment' AND post_status != 'trash' AND post_parent = %d", $post_id ) ) );
        }
        
        if ( empty($attachments) ) {
            unset($tabs['gallery']);
            return $tabs;
        }
    
		if( !isset($tabs['dt_slider_media'] )) {
			$tabs['dt_slider_media'] = sprintf(__('Slides (%s)', LANGUAGE_ZONE), "<span id='attachments-count'>$attachments</span>");
		}
        
        if( isset($tabs['type']) ) {
            $tabs['type'] = 'Upload';
        }
	}
	return $tabs;
}
add_filter('media_upload_tabs', 'dt_f_slider_mu', 99 );

// fields filter for custom uploader
function dt_f_slider_att_fields($fields, $post) {
	if( 'main_slider' == get_post_type($post->post_parent) ) {
       	
        unset($fields['align']);
        unset($fields['image-size']);
        unset($fields['post_content']);
        unset($fields['image_alt']);
        unset($fields['url']);
        
        // link field
//        $fields["dt_slider_link"]["label"] = _x("Link", 'backend slider', LANGUAGE_ZONE);
//        $fields["dt_slider_link"]["input"] = "text";
//        $fields["dt_slider_link"]['value'] = get_post_meta($post->ID, "_dt_slider_link", true);
        
        $fields["post_excerpt"]["label"] = _x('Slide description', 'backend slider', LANGUAGE_ZONE);

        // hide slide description field
        $fields["dt_slider_hdesc"]["label"] = '';
        $fields["dt_slider_hdesc"]["input"] = "html";
        $fields["dt_slider_hdesc"]["html"] = "<input type='checkbox' value='1'
            name='attachments[{$post->ID}][dt_slider_hdesc]'
            id='attachments[{$post->ID}][dt_slider_hdesc]'" . checked(get_post_meta($post->ID, "_dt_slider_hdesc", true), true, false ). "/> " . _x('Hide slide description', 'backend slider', LANGUAGE_ZONE);
        
        // open linc in new window
/*        $fields["dt_slider_newwin"]["label"] = '';
        $fields["dt_slider_newwin"]["input"] = "html";
        $fields["dt_slider_newwin"]["html"] = "<input type='checkbox' value='1'
            name='attachments[{$post->ID}][dt_slider_newwin]'
            id='attachments[{$post->ID}][dt_slider_newwin]'" . checked(get_post_meta($post->ID, "_dt_slider_newwin", true), true, false ). "/> " . _x('Open link in a new window', 'backend slider', LANGUAGE_ZONE);
 */      
	}
	return $fields;
}
add_filter('attachment_fields_to_edit', 'dt_f_slider_att_fields', 99, 2);

// upload tab custom fields save handler
function dt_f_slider_att_fields_save($post, $attachment) {
	// prevent loading gallery after save uploaded images
    if( 'main_slider' == get_post_type($_REQUEST['post_id']) ) {
        if( isset($_GET['tab']) && 'type' == $_GET['tab']) {
            unset($_POST['save']);
        }
    }
    
    // $attachment part of the form $_POST ($_POST[attachments][postID])
	// $post attachments wp post array - will be saved after returned
	//     $post['post_type'] == 'attachment'
	
    if( 'main_slider' == get_post_type($post['post_parent']) ) {

        // link (text)
        if( isset($attachment['dt_slider_link']) ){
            // update_post_meta(postID, meta_key, meta_value);
            update_post_meta($post['ID'], '_dt_slider_link', $attachment['dt_slider_link']);
        }
        
        // hide desc (checkbox)
        update_post_meta($post['ID'], '_dt_slider_hdesc', isset($attachment['dt_slider_hdesc']));
        
        // open in new window (checkbox)
        update_post_meta($post['ID'], '_dt_slider_newwin', isset($attachment['dt_slider_newwin']));
    }
    
	return $post;
}
add_filter('attachment_fields_to_save', 'dt_f_slider_att_fields_save', 99, 2);

// custom mediauploader tab action
function dt_a_slider_mu() {
    $errors = array();

    if ( !empty($_POST) ) {
        $return = media_upload_form_handler();

        if ( is_string($return) )
            return $return;
        if ( is_array($return) )
            $errors = $return;
    }

    wp_enqueue_style( 'media' );
    wp_enqueue_script('admin-gallery');
    
    return wp_iframe( 'dt_slider_media_form', $errors );
}
add_action( 'media_upload_dt_slider_media', 'dt_a_slider_mu' );

// filter tourn off send in to post button in media uploader gallery for dt_gallery_plus post type
function dt_media_item_remove_insert_in_to_post( $args = array() ) {
	if( isset($args['send']) )
		$args['send'] = false;
	return $args;
}
