<?php
/* 
This is the core QuickStep File.
It is recommended that you don't 
edit this file and add any custom
functions to your functions.php file.

Developed by: Theme Luxe
URL: http://themeluxe.com
*/

// Adding Translation Option
load_theme_textdomain( 'qs_framework', get_template_directory() .'/languages' );
$locale = get_locale();
$locale_file = get_template_directory()."/library/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);

/*-----------------------------------------------------------------------------------*/
/* Load textdomain - load_textdomain() */
/*-----------------------------------------------------------------------------------*/
function qs_load_textdomain() {
load_theme_textdomain( 'qs_framework' );
load_theme_textdomain( 'qs_framework', get_template_directory() . '/languages' );
}
add_action( 'init', 'qs_load_textdomain', 10 );

/* ---------------------------------------------------------------------- */
/*	Cleaning up WordPress
/* ---------------------------------------------------------------------- */

// Cleaning up the Wordpress Head
function qs_head_cleanup() {
	// remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
	// remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
	remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' );                         // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' );                           // WP version
}

	add_action('init', 'qs_head_cleanup');
	function qs_rss_version() { return ''; }
	add_filter('the_generator', 'qs_rss_version');
	
// loading jquery reply elements on single pages automatically
function qs_queue_js(){ if (!is_admin()){ if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script( 'comment-reply' ); }
}
	// reply on comments script
	add_action('wp_print_scripts', 'qs_queue_js');

// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
function qs_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}
add_filter('excerpt_more', 'qs_excerpt_more');
	
// Remove the p from around imgs 
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');
if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
    //WP Auto Feed Links
}


/* ---------------------------------------------------------------------- */
/*	Page Navigation For AJAX
/* ---------------------------------------------------------------------- */
function get_ajax_pagenum_link($pagenum = 1, $escape = true ) {
	global $wp_rewrite;

	$pagenum = (int) $pagenum;
	
	global $pageURL;
	$request = remove_query_arg('paged', $pageURL);

	$home_root = parse_url(home_url());
	$home_root = ( isset($home_root['path']) ) ? $home_root['path'] : '';
	$home_root = preg_quote( $home_root, '|' );

	$request = preg_replace('|^'. $home_root . '|', '', $request);
	$request = preg_replace('|^/+|', '', $request);

	if ( !$wp_rewrite->using_permalinks() || is_admin() ) {
		$base = trailingslashit( home_url() );
                

		if ( $pagenum > 1 ) {
			$result = add_query_arg( 'paged', $pagenum, $base . $request );
		} else {
			$result = $base . $request;
		}
	} else {
		$qs_regex = '|\?.*?$|';
		preg_match( $qs_regex, $request, $qs_match );

		if ( !empty( $qs_match[0] ) ) {
			$query_string = $qs_match[0];
			$request = preg_replace( $qs_regex, '', $request );
		} else {
			$query_string = '';
		}

		$request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
		$request = preg_replace( '|^index\.php|', '', $request);
		$request = ltrim($request, '/');

		$base = trailingslashit( home_url() );

		if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) )
			$base .= 'index.php/';

		if ( $pagenum > 1 ) {
			$request = ( ( !empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
		}
		
		
		$result = $base . $request . $query_string;
	}

	$result = apply_filters('get_pagenum_link', $result);

	if ( $escape )
		return esc_url( $result );
	else
		return esc_url_raw( $result );
}


function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before.'<nav class="page-navigation"><ol class="qs_page_navi clearfix">'."";
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = "First";
		echo '<li class="bpn-first-page-link"><a class="page-nav-link" href="page_id='.get_ajax_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
	}
	echo '<li class="bpn-prev-link">';
	//previous_posts_link('<<');  //@TODO
	echo '</li>';
        if(of_get_option('qs_separate_posts')) { $separate_posts = 'separate'; } else { $separate_posts = ''; }
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="bpn-current">'.$i.'</li>';
		} else {
			echo '<li><a class="page-nav-link '. $separate_posts.'" href="'.get_ajax_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="bpn-next-link">';
	//next_posts_link('>>');  //@TODO
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "Last";
		echo '<li class="bpn-last-page-link"><a class="page-nav-link '.$separate_posts.'" href="'.get_ajax_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
	}
	echo '</ol></nav>'.$after."";
}


/* ---------------------------------------------------------------------- */
/*	AJAX comments
/* ---------------------------------------------------------------------- */

function ajaxify_comments($comment_ID, $comment_status){
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	//If AJAX Request Then
		switch($comment_status){
			case '0':
				//notify moderator of unapproved comment
				wp_notify_moderator($comment_ID);
			case '1': //Approved comment
				echo "success";
				$commentdata=&get_comment($comment_ID, ARRAY_A);
				$post=&get_post($commentdata['comment_post_ID']); 
				wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
			break;
			default:
				echo $comment_status;
		}
		exit;
	}
}
add_action('comment_post', 'ajaxify_comments',20, 2);
	

?>