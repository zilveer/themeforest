<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Theme Setup
*	--------------------------------------------------------------------- 
*/

remove_action( 'wp_head', 'feed_links_extra'); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links'); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link'); // index link
remove_action( 'wp_head', 'parent_post_rel_link'); // prev link
remove_action( 'wp_head', 'start_post_rel_link'); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link'); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version

/* Set content width */
if ( ! isset( $content_width ) ) $content_width = 940;

/* Register menu */
register_nav_menus( array(
	'primary' => __( 'Main Navigation', 'mnky-admin' ),
	'footer' => __( 'Footer Navigation', 'mnky-admin' )
) );

// Use shortcodes in text widgets.
add_filter('widget_text', 'do_shortcode');

// Fix shortcodes auto-formatting
function wpex_fix_shortcodes($content){   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);

	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'wpex_fix_shortcodes');

/* Thumbnails */
add_theme_support( 'post-thumbnails' );

/* Ppost formats */
add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );

/* Feeds */
add_theme_support( 'automatic-feed-links' );

/* Custom WordPress login */
function custom_login_head() {
	$login_logo = ot_get_option('login_logo');
	if($login_logo){
	echo "
		<style> 
		body.login #login h1 a {
		background: url('" . ot_get_option('login_logo') . "') no-repeat scroll center bottom transparent;
		height: 80px;
		width: 326px;
		margin-bottom:20px;
		}
		</style>";
	}
}
add_action('login_head', 'custom_login_head');


function custom_login_url() {
  return site_url();
}
add_filter( 'login_headerurl', 'custom_login_url', 10, 4 );


function custom_login_title() {
     return get_bloginfo('name');
}
add_filter('login_headertitle', 'custom_login_title');

/* Exclude category from blog */
function excludeCat($query) {
	if ( $query->is_home ) {
		$exclude_cat_ids = ot_get_option('exclude_categories_from_blog');
		if($exclude_cat_ids){
			foreach( $exclude_cat_ids as $exclude_cat_id ) {
				$exclude_from_blog[] = '-'. $exclude_cat_id;
			}
			$query->set('cat', implode(',', $exclude_from_blog));
		}
	}
	return $query;
}
add_filter('pre_get_posts', 'excludeCat');

/* Custom excerpts */
function get_excerpt($limit) {
  $excerpt = get_the_content();
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = strip_tags($excerpt); 
  $excerpt = explode(' ', $excerpt, $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'&nbsp;...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  return $excerpt;
}

/* Custom editor buttons */
function enable_more_buttons($buttons) {
	$buttons[] = 'hr';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'backcolor';

	return $buttons;
}
add_filter("mce_buttons_2", "enable_more_buttons");

/* Validation for category tag */
add_filter( 'the_category', 'add_nofollow_cat' ); 
function add_nofollow_cat( $text ) { 
$text = str_replace('rel="category tag"', "", $text); return $text; 
}

/* Languages */
function theme_language(){
    load_theme_textdomain('kickstart', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'theme_language');

/* HEX to RGB */
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); 
}

/* Add editor style */
add_editor_style('inc/stylesheet/editor-style.css');

?>