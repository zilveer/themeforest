<?php

/**
 * Create the SEO metaboxes
 */
 
add_action('add_meta_boxes', 'zilla_metabox_seo');
function zilla_metabox_seo(){
    
    /* Create the SEO metabox ----------------------------------------------*/
	$meta_box = array(
		'id' => 'zilla_metabox_seo',
		'title' =>  __('SEO Settings', 'zilla'),
		'description' => __('These settings enable you to customize the SEO settings for this post/page.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('Title', 'zilla'),
					'desc' => __('Most search engines use a maximum of 60 chars for the title.', 'zilla'),
					'id' => '_zilla_seo_title',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Description', 'zilla'),
					'desc' => __('Most search engines use a maximum of 160 chars for the description.', 'zilla'),
					'id' => '_zilla_seo_description',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Keywords', 'zilla'),
					'desc' => __('A comma separated list of keywords', 'zilla'),
					'id' => '_zilla_seo_keywords',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Meta Robots Index', 'zilla'),
					'desc' => __('Do you want robots to index this page?', 'zilla'),
					'id' => '_zilla_seo_robots_index',
					'type' => 'radio',
					'std' => 'index',
					'options' => array('index', 'noindex')
				),
			array( 
					'name' => __('Meta Robots Follow', 'zilla'),
					'desc' => __('Do you want robots to follow links from this page?', 'zilla'),
					'id' => '_zilla_seo_robots_follow',
					'type' => 'radio',
					'std' => 'follow',
					'options' => array('follow', 'nofollow')
				)
		)
	);
	
	if( !zilla_is_third_party_seo() ){
		// Posts
		zilla_add_meta_box( $meta_box );
		// Pages
		$meta_box['page'] = 'page';
		zilla_add_meta_box( $meta_box );
	}
}


/**
 * Edit the Title
 */
function zilla_metabox_seo_title($title) {
	global $post;

	if( $post && !zilla_is_third_party_seo() ) {
	    if( is_home() || is_archive() || is_search() ) { 
	        $postid = get_option('page_for_posts'); 
	    } else {
	        $postid = $post->ID;
	    }
	    
		if( $seo_title = get_post_meta( $postid, '_zilla_seo_title', true ) ) {
			return $seo_title;
		}
	}
	return $title;
}
add_filter('wp_title', 'zilla_metabox_seo_title', 15);


/**
 * Add the Description
 */
function zilla_metabox_seo_description() {
	global $post;
	
	if( $post && !zilla_is_third_party_seo() ) {
	    if( is_home() || is_archive() || is_search() ) { 
	        $postid = get_option('page_for_posts'); 
	    } else {
	        $postid = $post->ID;
	    }
	    
		if( $seo_description = get_post_meta( $postid, '_zilla_seo_description', true ) ){
			echo '<meta name="description" content="'. esc_html(strip_tags($seo_description)) .'" />' . "\n";
		}
	}
}
add_action('zilla_meta_head', 'zilla_metabox_seo_description');


/**
 * Add the Keywords
 */
function zilla_metabox_seo_keywords() {
	global $post;
	
	if( $post && !zilla_is_third_party_seo() ) {
	    if( is_home() || is_archive() || is_search() ) { 
	        $postid = get_option('page_for_posts'); 
	    } else {
	        $postid = $post->ID;
	    }
	    
		if( $seo_keywords = get_post_meta( $postid, '_zilla_seo_keywords', true ) ){
			echo '<meta name="keywords" content="'. esc_html(strip_tags($seo_keywords)) .'" />' . "\n";
		}
	}
}
add_action('zilla_meta_head', 'zilla_metabox_seo_keywords');


/**
 * Add the Robots Meta
 */
function zilla_metabox_seo_robots() {
	global $post;
	
	if( $post && !zilla_is_third_party_seo() && get_option('blog_public') == 1 ){
	    if( is_home() || is_archive() || is_search() ) { 
	        $postid = get_option('page_for_posts'); 
	    } else {
	        $postid = $post->ID;
	    }
	    
		$seo_index = get_post_meta( $postid, '_zilla_seo_robots_index', true );
		$seo_follow = get_post_meta( $postid, '_zilla_seo_robots_follow', true );
		if( !$seo_index ) $seo_index = 'index';
		if( !$seo_follow ) $seo_follow = 'follow';
		
		if( !($seo_index == 'index' && $seo_follow == 'follow') )
			echo '<meta name="robots" content="'. $seo_index .','. $seo_follow .'" />' . "\n";
	}
}
add_action('zilla_meta_head', 'zilla_metabox_seo_robots');