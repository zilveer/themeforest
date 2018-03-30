<?php
#-----------------------------------------
#	RT-Theme theme_functions.php
#	version: 1.0
#-----------------------------------------

#
# Global Variables
#
if( ! function_exists("rt_global_variables") ){
	function rt_global_variables(){
		global $is_front_page;
 
		//@return true if it is home page or filtered
		$is_front_page = is_front_page() || apply_filters("like_front_page", false ) ? true : false;
	}
}
add_action( 'template_redirect', 'rt_global_variables', 10 );

#
#	sub page layouts function
# 
 
function sub_page_layout($location,$sidebar){
	global $sidebar, $is_front_page;

	$sidebar = (!$sidebar) ? sidebar_location() : $sidebar;
	$page_layout = ($sidebar=="full") ? "fullwidth" : "sidebarwidth";
	$subpage_class = (!$is_front_page) ? "sub_page" : "";
	$floating_sidebars = get_option(THEMESLUG."_close_floating_sidebars")== "" ? "float" : "";
		
	$content_location = ($sidebar =="left") ? $content_location="right" : $content_location="left";
	
	if($location=="subheader"){
		echo '<div id="main" role="main" class="clearfix">';
		echo	'<div class="'.$subpage_class.' '.$page_layout.' ">';
		echo ($page_layout=="sidebarwidth") ? '<div class="content '.$content_location.' clearfix">' : '<div class="content '.$page_layout.' clearfix">';
	}

	if($location=="subfooter"){

		if($page_layout=="sidebarwidth"){
			echo '</div><div class="sidebar '. $sidebar .' '. $floating_sidebars .' clearfix">';
				get_template_part( 'sidebar', 'sidebar-core-file');
			echo '</div>';
		} 
		
		if($page_layout!="sidebarwidth"){
			echo '</div>';
		} 

		echo '</div></div>'; 
	}   
}

#
#	optional sidebar locations
#

function sidebar_location(){ 
	global $post; 
 
	$sidebar 	= get_option(THEMESLUG.'_sidebar_position'); //no specific sidebar location - use default
	$metabox_selection  = (isset($post) && is_object( $post )) ? get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) : false ; //sidebar selection via metaboxes
	
		
	if( ! is_search() ){ 

		// site part = regular pages
		if (is_theme_page() || is_contact_page() && ( isset($post) && is_object( $post ) ) ) $sidebar = (get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true)) ? get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) : $sidebar ; //sidebar location regular page 	

		// site part = blog
		if(is_blog_page()) $sidebar  = ($metabox_selection ? $metabox_selection : ( get_option(THEMESLUG.'_sidebar_position_blog') ? get_option(THEMESLUG.'_sidebar_position_blog') : $sidebar ) );	 

		// site part = product
		if(is_product_page()) $sidebar  = ($metabox_selection	? $metabox_selection : (	get_option(THEMESLUG.'_sidebar_position_product') ? get_option(THEMESLUG.'_sidebar_position_product') : $sidebar ) );	  

		// site part = portfolio
		if(is_portfolio_page()) $sidebar  = ($metabox_selection  ? $metabox_selection : (	get_option(THEMESLUG.'_sidebar_position_portfolio') ? get_option(THEMESLUG.'_sidebar_position_portfolio') : $sidebar ) );
	 

		// WooCommerce
		if ( class_exists( 'Woocommerce' ) ) {		 
			 $woo_page_id ="";
			 $woo_page_id = (is_product_category() || is_shop()) ? woocommerce_get_page_id('shop') : $woo_page_id;

			 if($woo_page_id){
				 $sidebar = (get_post_meta($woo_page_id, THEMESLUG.'custom_sidebar_position', true)) ? get_post_meta($woo_page_id, THEMESLUG.'custom_sidebar_position', true) : $sidebar ; //sidebar location for woo shop
			 } 
		}
	}

	// if sidebar still empty use the right as default position
	if( empty( $sidebar ) ){
		$sidebar = "right"; 
	} 

	return $sidebar;
}

 
 
#
#	Get Page Layout
#

function get_page_layout(){ 
	if(is_page() || is_single()) global $post; 
	
	$metabox_selection =  ($post) ? ( get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) )  ?  ( get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) )  : false : false; //fullwidth selection via metaboxes

	// site part = regular pages
	if(is_theme_page() || is_contact_page()) $fullwidth = $metabox_selection; 
	
	// site part = blog
	if(is_blog_page()) $fullwidth = ($metabox_selection) ?  ($metabox_selection=="full" ? "fullwidth" : false )	: get_option(THEMESLUG.'_sidebar_position_blog')=="full" ? "fullwidth" : false;		
  
		
	return $fullwidth;
} 
 

#
# Add Class WP Menu - adds class for the first menu item
#
 
function add_class_first_item($menu){
	
	$find="\"><a ";
	$replace=" first\"><a ";
	return preg_replace('/'.$find.'/', $replace, $menu, 1); 
}


#
# Remove more link in excerpts 
#

function no_excerpt_more($more) {
	return '.. ';
}

#
# Get page count
#

function get_page_count(){
    global $wp_query;	
    $count=array('page_count'=>$wp_query->max_num_pages,'post_count'=>$wp_query->post_count);
    return $count;
}


#
# Pagination
#
function get_pagination($range = 7, $ajaxScroller = false){
	global $paged, $wp_query; 

	$max_page = $wp_query->max_num_pages;
	 
	if($max_page > 1){
	if(!$paged){
	  $paged = 1;
	}

	if(!$ajaxScroller){
		if ($paged > 1){
			echo "<li class=\"arrowleft\">";
			    previous_posts_link('←');
			echo "</li>\n";
		}
	}

	if($max_page > $range){
	if($paged < $range){
	  for($i = 1; $i <= ($range + 1); $i++){
		echo "<li";
		if($i==$paged) echo " class='active'";

			if(!$ajaxScroller){		
				echo "><a href='" . get_pagenum_link($i) ."'>".$i."</a>";
			}else{
				echo '><a class="'.($i).'">'.$i.'</a>';
			}

		echo "</li>\n";
	  }
	}
	elseif($paged >= ($max_page - ceil(($range/2)))){
	  for($i = $max_page - $range; $i <= $max_page; $i++){
		echo "<li";
		if($i==$paged) echo " class='active'";
		

			if(!$ajaxScroller){		
				echo "><a href='" . get_pagenum_link($i) ."'>".$i."</a>";
			}else{
				echo '><a class="'.($i).'">'.$i.'</a>';
			}

		echo "</li>\n";
	  }
	}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
	  for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
	    echo "<li";
	    if($i==$paged) echo " class='active'";


			if(!$ajaxScroller){		
				echo "><a href='" . get_pagenum_link($i) ."'>".$i."</a>";
			}else{
				echo '><a class="'.($i).'">'.$i.'</a>';
			}

	    echo "</li>\n";
	  }
	}
	}
	else{
	for($i = 1; $i <= $max_page; $i++){
	    echo "<li";
	    if($i==$paged) echo " class=\"active\" ";


			if(!$ajaxScroller){		
				echo "><a href='" . get_pagenum_link($i) ."'>".$i."</a>";
			}else{
				echo '><a class="'.($i).'">'.$i.'</a>';
			}

	    echo "</li>\n";
	}
	}
	if(!$ajaxScroller){	
		if ($paged != $max_page){
		    echo "<li class=\"arrowright\">";
		    next_posts_link('→');
		    echo "</li>\n";
		}
	}
	
	}
}


#
# checks page reserved for blog product or portfolio
# 

function is_theme_page(){
    global $post; 
    
    @$post->ID = wpml_page_id($post->ID);
    
    if($post->ID != BLOGPAGE && $post->ID !=PRODUCTPAGE && $post->ID !=PORTFOLIOPAGE && $post->ID !=CONTACTPAGE  && is_page()){
	   return true;
    }
    
} 

#
# checks theme parts that reserved for blog
# 

function is_blog_page(){
    global $post; 
    
    @$post->ID = wpml_page_id($post->ID);
    
	if($post->ID == BLOGPAGE || is_category() || is_single() && $post->post_type!='products' && $post->post_type!='portfolio'  ){
	    return true;
	} 

	//check default blog template usage
	if(get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) == "templateid_004" ){
	    return true;
	}			
}

#
# checks theme parts that reserved for products
# 

function is_product_page(){
    global $post,$taxonomy; 
    
    @$post->ID = wpml_page_id($post->ID);
    
	if($post->ID == PRODUCTPAGE || $taxonomy=="product_categories" || $post->post_type=='products'){
	    return true;
	} 

	//check default product template usage
	if(get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) == "templateid_003" ){
	    return true;
	}
}

#
# checks theme parts that reserved for portfolio
# 

function is_portfolio_page(){
    global $post,$taxonomy,$sidebar; 
  
    @$post->ID = wpml_page_id($post->ID);
    
	if($post->ID == PORTFOLIOPAGE || $taxonomy=="portfolio_categories" || $post->post_type=='portfolio'){
	    return true;
	}

	//check default porfolio template usage
	if(get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) == "templateid_002" ){
	    return true;
	}	
}

#
# checks theme parts that reserved for contact page
# 

function is_contact_page(){
    global $post; 
  
    @$post->ID = wpml_page_id($post->ID);
    
	if($post->ID == CONTACTPAGE){
	    return true;
	}

	//check default contact template usage
	if(get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) == "templateid_005" ){
	    return true;
	}		
}

#
# gets orginal paths of images when multi site mode active
#
function find_image_org_path($image) {
	if(is_multisite()){
		global $blog_id;
		if (isset($blog_id) && $blog_id > 0) {
			if(strpos($image,get_bloginfo('wpurl'))!==false){//image is local 
				if(empty(get_current_site(1)->path)){
					$the_image_path = get_current_site(1)->path.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image);
				}else{
					$the_image_path = $image;
				}				
			}else{
				$the_image_path = $image;
			}
		}else{
			$the_image_path = $image;
		}
	}else{
		$the_image_path = $image;
	} 
	return $the_image_path;
}
 

#
# set selected theme style to body tag
#

function rt_body_class_name($classes) {
	$classes[] = get_option( THEMESLUG."_style" );
	$classes[] = get_option( THEMESLUG."_close_responsive" ) ? '' : 'responsive' ;	// responsive
	// return the $classes array
	return $classes;
}

#
# returns a post ID from a url
#

function rt_get_attachment_id_from_src ($image_src) { 
	global $wpdb; 
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id    = $wpdb->get_var($query);
	return $id; 
}


#
# find orginal image url - clean thumbnail extensions
#

function rt_clean_thumbnail_ext ($image_src) { 
	$search = '#-\d+x\d+#';  
	return preg_replace($search, "", $image_src);
}


#
# Exclude some custom post types from search
#
function excludePostsfromSearch($query) { 
	if ($query->is_search) {
		if(!get_query_var("post_type")){
			$query->set('post_type', array("post","page","portfolio","products","product"));
			$query->set('posts_per_page', 10);
		}
	}
	return $query; 
}
if(!is_admin()) add_filter('pre_get_posts','excludePostsfromSearch');



#
# Replacement for get_adjacent_post()
#
# Default get_adjacent_post() not supports custom post taxonomies
#
#
function mod_get_adjacent_post($in_same_category = false, $previous = true, $excluded_categories = '', $taxonomy = '', $orderBy= '') {
	global $post, $wpdb;
    
	if ( empty( $post ) || ( !empty($taxonomy) && !taxonomy_exists( $taxonomy ) ) )
		   return null;

	$current_post_date = $post->post_date;

	$join = '';
	$posts_in_ex_cats_sql = '';
	if ( $in_same_category || !empty($excluded_categories) ) {
		   $join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

		   if ( $in_same_category ) {
				 $cat_array = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
				 $join .= " AND tt.taxonomy = '".$taxonomy."' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
		   }

		   $posts_in_ex_cats_sql = "AND tt.taxonomy = '".$taxonomy."'";
		   if ( !empty($excluded_categories) ) {
				 $excluded_categories = array_map('intval', explode(' and ', $excluded_categories));
				 if ( !empty($cat_array) ) {
					    $excluded_categories = array_diff($excluded_categories, $cat_array);
					    $posts_in_ex_cats_sql = '';
				 }

				 if ( !empty($excluded_categories) ) {
					    $posts_in_ex_cats_sql = " AND tt.taxonomy = '".$taxonomy."' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
				 }
		   }
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';
	$orderBy = ($orderBy) ? "p.post_".$orderBy : "p.post_date";  // title or date

	$join  = apply_filters( "get_{$adjacent}_{$taxonomy}_join", $join, $in_same_category, $excluded_categories );
	$where = apply_filters( "get_{$adjacent}_{$taxonomy}_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_category, $excluded_categories );
	$sort  = apply_filters( "get_{$adjacent}_{$taxonomy}_sort", "ORDER BY $orderBy $order LIMIT 1" );

	$query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
	$query_key = "adjacent_{$taxonomy}_" . md5($query);
	$result = wp_cache_get($query_key, 'counts');
	if ( false !== $result )
		   return $result;

	$result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");
	if ( null === $result )
		   $result = '';

	wp_cache_set($query_key, $result, 'counts');
	return $result;
}


#
# Convert Hex values to RGB
#
function HexToRGB($hex) {
	$hex = str_replace("#", "", $hex);
	$color = array();
 
	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	 
	return $color;
}

//Browser Info
function browser_info($agent=null) {
  // Declare known browsers to look for
  $known = array('msie', 'firefox', 'safari', 'webkit', 'opera', 'netscape',
    'konqueror', 'gecko');

  // Clean up agent and build regex that matches phrases for known browsers
  // (e.g. "Firefox/2.0" or "MSIE 6.0" (This only matches the major and minor
  // version numbers.  E.g. "2.0.0.6" is parsed as simply "2.0"
  $agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
  $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';

  // Find all phrases (or return empty array if none found)
  if (!preg_match_all($pattern, $agent, $matches)) return array();

  // Since some UAs have more than one phrase (e.g Firefox has a Gecko phrase,
  // Opera 7,8 have a MSIE phrase), use the last one found (the right-most one
  // in the UA).  That's usually the most correct.
  $i = count($matches['browser'])-1;
  return array($matches['browser'][$i] => $matches['version'][$i]);
}


//Search Highlight
function search_highlight($needle, $haystack) {
	$ind = stripos($haystack, $needle);
	$len = strlen($needle);
		if($ind !== false) {
		return substr($haystack, 0, $ind) . '<span class="yellow nopadding">' . substr($haystack, $ind, $len) . "</span>" . search_highlight($needle, substr($haystack, $ind + $len));
	} else {
		return $haystack;
	}
}


// WOOCOMMERCE SLUG NOTICE  
function rt_check_woo_permalink(){

	//Slugnames
	$woocommerce_permalinks = get_option( 'woocommerce_permalinks' );
	$rt_theme_product_slug =  str_replace("/","",get_option( THEMESLUG.'_product_single_slug'));
	$rt_theme_product_category_slug =  str_replace("/","",get_option( THEMESLUG.'_product_category_slug'));
	$woo_product_slug = is_array($woocommerce_permalinks) ? str_replace("/","",$woocommerce_permalinks["product_base"]) : "";
	$woo_category_slug =  is_array($woocommerce_permalinks) ? str_replace("/","",$woocommerce_permalinks["category_base"]) : "";

	//check woocommerce product slugname with rt-theme product slugname 
	if(	( $rt_theme_product_slug == $woo_product_slug ) ||  ( empty($woo_product_slug) && $rt_theme_product_slug == "product" ) ) {
		add_action('admin_notices', 'rt_woo_product_base_notice');
	}
 
	//check woocommerce category slugname with rt-theme category slugname 
	if(	( $rt_theme_product_category_slug == $woo_category_slug ) || ( empty($woo_category_slug) && $rt_theme_product_category_slug == "product-category" ) ) {
		add_action('admin_notices', 'rt_woo_category_base_notice');
	}
}

if ( class_exists( 'Woocommerce' ) ) {
	add_action('init', 'rt_check_woo_permalink'); 
}

function rt_woo_product_base_notice(){ 
	echo '<div class="error"> 
			<br />
			<H3>ERROR : '.THEMENAME.' - Slugname conflict resulting in a 404 on Woocommerce product pages</H3><br />
			Two custom post types are using the same slugname which are WooCommerce and '.THEMENAME.' Product Showcase. <br />
			<br />
			There are two solutions;<br /><br />
			1) Go to '.THEMENAME.' <a href="admin.php?page=rt_product_options">Product Settings</a> and change the "Single Product Slug" to another one.<br />
			2) Or, go to WordPress Admin -> Settings -> <a href="options-permalink.php">Permalinks</a> and change the "Product permalink base" -> "Custom Base" permalink name to another one.<br /><br /><br />
		</div>';
}

function rt_woo_category_base_notice(){ 
	echo '<div class="error"> 
			<br />
			<H3>ERROR : '.THEMENAME.' - Slugname conflict resulting in a 404 on Woocommerce product categories</H3><br />
			Two custom post types are using the same slugname which are WooCommerce and '.THEMENAME.' Product Showcase. <br />
			<br />
			There are two solutions;<br /><br />
			1) Go to '.THEMENAME.' <a href="admin.php?page=rt_product_options">Product Settings</a> and change the "Category Slug" to another one.<br />
			2) Or, go to WordPress Admin -> Settings -> <a href="options-permalink.php">Permalinks</a> and change the "Optional" -> "Product category base" permalink name to another one.<br /><br /><br />
		</div>';
}

?>