<?php

/**
 * iCore custom helper functions
 * 
 *
 * @since	iCore 2.0
 */


// Get theme options
global $theme_options, $theme_shortname;
$theme_options = get_option( $theme_shortname . '_options' ); 

// Get Category ID by it's name
function get_catId($cat_name)
{
	global $wpdb;
	$cat_name_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name = '".$cat_name."'");
	return $cat_name_id;
}

// Get Page ID by it's name
function get_pageId($page_name)
{
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$page_name."' AND post_type = 'page'");
	return $page_name_id;
}

// Get Page Name by it's ID
function get_pagename($page_id)
{
	global $wpdb;
	$page_name = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '".$page_id."' AND post_type = 'page'");
	return $page_name;
}

// Get Category Name by it's ID
function get_categname($cat_id)
{
	global $wpdb;
	$cat_name = $wpdb->get_var("SELECT name FROM $wpdb->terms WHERE term_id = '".$cat_id."'");
	return $cat_name;
}


// Truncate Post Content
function truncate_post($limit, $html, $break=".", $pad="...") {

	$string = get_the_content();
	$string = apply_filters('the_content', $string);

if($html == 0) {	
	$string = preg_replace('@<script[^>]*?>.*?</script>@si', '', $string);
	$string = preg_replace('@<style[^>]*?>.*?</style>@si', '', $string);
	$tags = "<p>,<ol>,<ul>,<li>,<h1>,<h2>,<h3>,<h3>,<a>,<href>,<span>";
	$string = strip_tags($string); } 
		else 
	{	
		$string = preg_replace('@<script[^>]*?>.*?</script>@si', '', $string);
		$string = preg_replace('@<style[^>]*?>.*?</style>@si', '', $string);
		$tags = "";
		$string = strip_tags($string, $tags); }
	if(strlen($string) <= $limit) { echo $string;  }
	if(strlen($string) >= $limit) {  
		$string = substr($string, 0, $limit);
	   	   echo $string . $pad; 
	}
}


// Get custom field value
function icore_get_meta ($key, $echo = FALSE) {

    global $post;
    $custom_field = get_post_meta($post->ID, $key, true);
    return $custom_field;
}

// Get values of multiple custom fields
function icore_get_multimeta ($key) {

    foreach($key as $value) {
        global $post;
        
        if($value == 'Align') {
            
            $custom_field = get_post_meta($post->ID, $value, true);
            if($custom_field == '') $result[$value] = 'c';
            if($custom_field == 'center') $result[$value] = 'c';
            if($custom_field == 'top') $result[$value] = 't';
            if($custom_field == 'bottom') $result[$value] = 'b';
            if($custom_field == 'left') $result[$value] = 'l';
            if($custom_field == 'right') $result[$value] = 'r';           
        }
        else 
        {
        $custom_field = get_post_meta($post->ID, $value, true);
        $result[$value] =  $custom_field; }
    }
    return $result;
}



// Get current location
function icore_get_location() {

	$location = 'index';
	
	if ( is_front_page() ) {
		// Front Page
		$location = 'front-page';
	} else if ( is_date() ) {
		// Date Archive Index
		$location = 'date';
	} else if ( is_author() ) {
		// Author Archive Index
		$location = 'author';
	} else if ( is_category() ) {
		// Category Archive Index
		$location = 'category';
	} else if ( is_tag() ) {
		// Tag Archive Index
		$location = 'tag';
	} else if ( is_tax() ) {
		// Taxonomy Archive Index
		$location = 'taxonomy';
	} else if ( is_archive() ) {
		// Archive Index
		$location = 'archive';
	} else if ( is_search() ) {
		// Search Results Page
		$location = 'search';
	} else if ( is_404() ) {
		// Error 404 Page
		$location = '404';
	} else if ( is_attachment() ) {
		// Attachment Page
		$location = 'attachment';
	} else if ( is_single() ) {
		// Single Blog Post
		$location = 'single';
	} else if ( is_page() ) {
		// Static Page
		$location = 'page';
	} else if ( is_home() ) {
		// Blog Posts Index
		$location = 'home';
	}
	
	return $location;
}



function thumb($width, $height, $align) {
    $meta = icore_get_multimeta(array('Thumbnail','Height', 'Width', 'Video', 'Align'));   
}


// Truncate Post Title
function icore_cut_title($amount) {
    
    $thetitle = get_the_title();
    $getlength = mb_strlen($thetitle, 'UTF-8');
    echo mb_substr($thetitle, 0, $amount, 'UTF-8');
    if ($getlength > $amount) echo "...";
}

// Truncate Title
function icore_title($amount='') { 
    
    if($amount !=='') { 
    icore_cut_title($amount); } 
    else 
    { the_title(); }
}


// Print Nav Menu
function icore_nav_menu($location = 'primary-menu', $menuClass = 'nav sf', $description = 'desc_off' ) {   
    global $theme_shortname;
    
    if (function_exists('wp_nav_menu') && $description == 'desc_off') { 
        $menu = wp_nav_menu(array('theme_location' => $location, 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false ));
    } else { 
		if (function_exists('wp_nav_menu') && $description == 'desc_on') { 
                    $menu = wp_nav_menu(array('theme_location' => $location, 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false, 'walker' => new icore_menudesc() ));
                            } }

                if($menu != '') { 
                    echo $menu; 
				} else { ?>
                    <ul class="<?php echo $menuClass; ?>">
                        <li>
                    
                    <?php echo '<a href="' . home_url() . '/wp-admin/nav-menus.php">Create menu</a>'; ?>
                     </li>
                     </ul>
                     <?php
                } 
} 

// Print search bar
function icore_search_bar() {  
    global $theme_options;
    if ( isset($theme_options['search']) && $theme_options['search'] == '1' ) { ?>
    	<div id="searchbar">
            <?php get_search_form(); ?>
        </div>
<?php 
    } 
}

// Print logo
function icore_logo() {
	global $theme_options;
	    
    if( isset( $theme_options['logo'] ) && $logo = $theme_options['logo']) { 

        $logo = "<img class='site-title' src=".$logo." alt='' />";
        $logo = "<h1 id='site-title'><a href='".home_url('/')."'>".$logo."</a></h1>";
        
    } else { 

        $logo = get_bloginfo('name'); 
        $logo = "<h1 id='site-title'><a href='".home_url('/')."'>".$logo."</a></h1>";
            
    }
 
   return $logo; 
}


// Print Custom CSS
add_action( 'wp_head', 'icore_custom_css' );

function icore_custom_css() {
	global $theme_options;
	 
	if( isset( $theme_options['custom_css'] ) && $theme_options['custom_css'] <> '') {
		echo '<style type="text/css">';
		echo sanitize_text_field( $theme_options['custom_css'] );
		echo '</style>';
	 }
}

// Print Custom Primary Color
add_action( 'wp_footer', 'icore_primary_color' );

function icore_primary_color() {
	global $theme_options;
	 
	if( isset( $theme_options['primary_color'] ) && $theme_options['primary_color'] <> '') {
		echo '<style type="text/css">';
		echo '.primary-color {background-color:'.$theme_options['primary_color'].' }';
		echo '</style>';
	 }
}


// Print Custom Header/Footer Link Color
add_action( 'wp_footer', 'icore_header_link_color' );

function icore_header_link_color() {
	global $theme_options;
	 
	if( isset( $theme_options['header_link_color'] ) && $theme_options['header_link_color'] <> '') {
		echo '<style type="text/css">';
		echo 'h1.logo a, ul.top a, #footer-widgets h4.widget-title {color:'.$theme_options['header_link_color'].' }';
		echo '</style>';
	 }
}

// Print Custom Header/Footer Text Color
add_action( 'wp_footer', 'icore_header_text_color' );

function icore_header_text_color() {
	global $theme_options;
	 
	if( isset( $theme_options['header_text_color'] ) && $theme_options['header_text_color'] <> '') {
		echo '<style type="text/css">';
		echo '#tagline, span.menu-desc, #footer-widgets {color:'.$theme_options['header_text_color'].' }';
		echo '</style>';
	 }
}


// Print Custom Secondary Color
add_action( 'wp_footer', 'icore_secondary_color');

function icore_secondary_color() {
	global $theme_options;
	 
	if( isset( $theme_options['secondary_color'] ) && $theme_options['secondary_color'] <> '') {
		echo '<style type="text/css">';
		echo '
		.woocommerce-pagination .page-numbers li a, .woocommerce-pagination .page-numbers li span.current  { background-color:'.$theme_options['secondary_color'].' }
		.widget_price_filter .ui-slider .ui-slider-handle { background-color:'.$theme_options['secondary_color'].' }
		.secondary-color { background-color:'.$theme_options['secondary_color'].' }
		.blurb a.readmore, a.comment-reply-link, #respond input[type="submit"] /* input[type="button"] */, .widget_price_filter button, .shop_table input[type="submit"], input[type="submit"], .nav-next a, .nav-previous a, .pagination-prev a, .pagination-next a, span.onsale { background: '.$theme_options['secondary_color'].'}';
		echo '</style>';
	 }
}

// Print Custom Navigation link colors
add_action( 'wp_footer', 'icore_nav_color' );

function icore_nav_color() {
	global $theme_options;
	
	if( isset( $theme_options['nav_bg_color'] ) && $theme_options['nav_bg_color'] <> '') {
		echo '<style type="text/css">';
		echo 'ul.nav li {background-color:'.$theme_options['nav_bg_color'].' }';
		echo '</style>';
	 }
	
	if( isset( $theme_options['nav_color'] ) && $theme_options['nav_color'] <> '') {
		echo '<style type="text/css">';
		echo 'ul.nav li a, #cart-menu-inner a.menu-link {color:'.$theme_options['nav_color'].' }';
		echo '</style>';
	 }
	
	if( isset( $theme_options['nav_hover_color'] ) && $theme_options['nav_hover_color'] <> '') {
		echo '<style type="text/css">';
		echo 'ul.nav li a:hover, #cart-menu-inner a.menu-link:hover {color:'.$theme_options['nav_hover_color'].' }';
		echo '</style>';
	 }
	
	if( isset( $theme_options['nav_active_color'] ) && $theme_options['nav_active_color'] <> '') {
		echo '<style type="text/css">';
		echo 'ul.nav li.current-menu-item a {color:'.$theme_options['nav_active_color'].' }';
		echo '</style>';
	 }
	
}


// Print Google Analytics Code
add_action( 'wp_head', 'icore_ga_code' );

function icore_ga_code() {
	global $theme_options;
	
	if( isset( $theme_options['google_analytics'] ) && $theme_options['google_analytics'] <> '' ) echo $theme_options['google_analytics'];	
}

// Print Favicon
add_action( 'wp_head', 'icore_favicon' );

function icore_favicon() {
	global $theme_options;
	
	if ( isset( $theme_options['favicon'] ) && '' != $theme_options['favicon'] ) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url( $theme_options['favicon'] ); ?>" />
<?php endif; 
}

?>