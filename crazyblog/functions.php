<?php

require_once( get_template_directory() . '/core/init.php' );
crazyblog_Module_Init::crazyblog_Init();


add_filter( 'get_header', 'crazyblog_under_construction' );

function crazyblog_under_construction() {
	if ( !is_admin() && !is_user_logged_in() ) {
		$settings = crazyblog_opt();
		if ( crazyblog_set( $settings, 'under_construction_status' ) == '1' ) {
			include crazyblog_ROOT . 'comming-soon.php';
			exit;
		}
	}
}

function crazyblog_search_filter( $query ) {

	if ( !$query->is_admin && $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'crazyblog_gallery' ) );
	}
	return $query;
}

add_filter( 'pre_get_posts', 'crazyblog_search_filter' );


add_filter( 'post_row_actions', 'crazyblog_remove_view_link_faq', 10, 1 );

function crazyblog_remove_view_link_faq( $action ) {
	global $post;
	if ( crazyblog_set( $post, 'post_type' ) == 'crazyblog_gallery' ) {
		unset( $action['view'] );
		return $action;
	} else {
		return $action;
	}
}

add_filter( 'get_sample_permalink_html', 'crazyblog_perm', '', 4 );

function crazyblog_perm( $return, $id, $new_title, $new_slug ) {

	$post = get_post( $id );
	if ( crazyblog_set( $post, 'post_type' ) == 'crazyblog_gallery' ) {
		return '';
	} else {
		return $return;
	}
}

function crazyblog_excerpt_more( $more ) {
	return '';
}

add_filter( 'excerpt_more', 'crazyblog_excerpt_more' );


add_filter( 'wp_list_categories', 'crazyblog_add_span_cat_count' );

function crazyblog_add_span_cat_count( $links ) {
	$links = str_replace( '</a> (', '</a> <span>', $links );
	$links = str_replace( ')', '</span>', $links );
	return $links;
}

add_filter( 'max_srcset_image_width', create_function( '', 'return 1;' ) );
//add_filter( 'wp_handle_upload', 'test' );
//
//function test( $data ) {
//	printr( $data );
//}
