<?php

$homepage = get_option( 'show_on_front');
if( $homepage == "page" ) {
	$meta = get_post_custom_values("_wp_page_template",get_option( 'page_on_front'));
	if($homepage == "page" && $meta[0] == "template-homepage.php") {$has_homepage=true;} else {$has_homepage=false;}
}
	
	
function register_my_menus() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array( 
				'top-menu' => esc_html__( 'Top Menu', THEME_NAME ),
				'main-menu' => esc_html__( 'Main Menu', THEME_NAME ),
			)
		);
	}	
}

function create_gallery() {
		
	$labels = array(
    'name' => _x('Gallery', THEME_NAME),
    'singular_name' => _x('Gallery Menu', THEME_NAME),
    'add_new' => _x('Add New', THEME_NAME),
    'add_new_item' => esc_html__('Add New Item', THEME_NAME),
    'edit_item' => esc_html__('Edit Item', THEME_NAME),
    'new_item' => esc_html__('New Gallery Item', THEME_NAME),
    'view_item' => esc_html__('View Item', THEME_NAME),
    'search_items' => esc_html__('Search Gallery Items', THEME_NAME),
    'ndf_found' =>  esc_html__('No gallery items found', THEME_NAME),
    'ndf_found_in_trash' => esc_html__('No gallery items found in Trash', THEME_NAME), 
    'parent_item_colon' => ''
	);
  
	register_taxonomy(DF_POST_GALLERY."-cat", 
					    	array("Gallery Categories"), 
					    	array(	"hierarchical" => true, 
					    			"label" => "Gallery Categories", 
					    			"singular_label" => "Gallery Categories", 
					    			"rewrite" => true,
					    			"query_var" => true
					    		));  
		
		register_post_type( DF_POST_GALLERY,
		array( 'labels' => $labels,
	         'public' => true,  
	         'show_ui' => true,  
	         'capability_type' => 'post',  
	         'hierarchical' => false,  
			 'taxonomies' => array(DF_POST_GALLERY.'-cat'),
	         'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes', 'excerpt') ) );

}

function different_register_sidebar($name, $id, $description){
	register_sidebar(array('name'=>$name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget_title"><h3>',
        'after_title' => '</h3></div>'
	));
}



/* -------------------------------------------------------------------------*
 * 							DEFAULT SIDEBARS								*
 * -------------------------------------------------------------------------*/
$stickySidebar = df_get_option ( THEME_NAME."_sticky_sidebar" );
$different_sidebars=array();
$different_sidebars[] = array('name'=>esc_html__('Default Sidebar', THEME_NAME), 'id'=>'default','description' => esc_html__('The default page sidebar.', THEME_NAME));
$different_sidebars[] = array('name'=>esc_html__('Footer First Column', THEME_NAME), 'id'=>'df_footer_1', 'description' => esc_html__('Footer first column widget area', THEME_NAME));	
$different_sidebars[] = array('name'=>esc_html__('Footer Second Column', THEME_NAME), 'id'=>'df_footer_2', 'description' => esc_html__('Footer second column widget area', THEME_NAME));	
$different_sidebars[] = array('name'=>esc_html__('Footer Third Column', THEME_NAME), 'id'=>'df_footer_3', 'description' => esc_html__('Footer third column widget area', THEME_NAME));	
$different_sidebars[] = array('name'=>esc_html__('Footer Forth Column', THEME_NAME), 'id'=>'df_footer_4', 'description' => esc_html__('Footer forth column widget area', THEME_NAME));	

if(function_exists('is_woocommerce')) {
	$different_sidebars[] = array('name'=>'Woocommerce', 'id'=>'df_woocommerce', 'description' => esc_html__('Woocommerce Page Sidebar', THEME_NAME));	
}
if(function_exists("is_bbpress")) {
	$different_sidebars[] = array('name'=>'bbPress', 'id'=>'df_bbpress', 'description' => esc_html__('bbPress Page Sidebar', THEME_NAME));
}
if(function_exists("is_buddypress")) {
	$different_sidebars[] = array('name'=>'BuddyPress', 'id'=>'df_buddypress', 'description' => esc_html__('BuddyPress Page Sidebar', THEME_NAME));	
}
if($stickySidebar=="on") {
	//$different_sidebars[] = array('name'=>'Sticky Sidebar', 'id'=>'sticky_sidebar', 'description' => esc_html__('Sticky sidebar under the main sidebar, that will stay fixed while you scroll down the page', THEME_NAME));	
}


$sidebar_strings = df_get_option(THEME_NAME.'_sidebar_names');
$generated_sidebars = explode("|*|", $sidebar_strings);
array_pop($generated_sidebars);
$different_generated_sidebars=array();
	
foreach($generated_sidebars as $sidebar) {
	$different_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar), 'description'=>$sidebar);
	$different_generated_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar), 'description'=>$sidebar);
}
 
 /* -------------------------------------------------------------------------*
 * 							REGISTER ALL SIDEBARS
 * -------------------------------------------------------------------------*/

if (function_exists('register_sidebar')) {
	
	//register the sidebars
	foreach($different_sidebars as $sidebar){
		different_register_sidebar($sidebar['name'], $sidebar['id'], $sidebar['description']);
	}
	
}

add_action('init', 'register_my_menus' );
add_theme_support( 'post-thumbnails' );
add_action('init', 'create_gallery');


?>