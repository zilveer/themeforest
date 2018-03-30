<?php 
function multipurpose_admin_styles() {
    wp_enqueue_style('thickbox');
    wp_enqueue_style('fancybox', get_template_directory_uri() . '/options/css/jquery.fancybox.css',true);
    wp_enqueue_style('style', get_template_directory_uri() . '/options/css/style.css',true);

}
function multipurpose_admin_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('jquery');
    wp_enqueue_script('fancybox',get_template_directory_uri() . '/options/js/jquery.fancybox.pack.js',true);
	wp_enqueue_script('plugins',get_template_directory_uri() . '/options/js/plugins.js',true);
    wp_enqueue_script('script',get_template_directory_uri() . '/options/js/scripts.js',true);
}

add_action('admin_print_styles', 'multipurpose_admin_styles');
add_action('admin_print_scripts', 'multipurpose_admin_scripts');
// Add item on menu
get_template_part('options/auto');
add_action( 'admin_menu', 'multipurpose_theme_options_add_page' );
function multipurpose_theme_options_add_page() {
    add_theme_page( esc_attr__( 'Sidebars', 'newtheme' ), esc_attr__( 'Sidebars', 'newtheme' ), 'edit_theme_options', 'theme_options', 'sidebar_do_page' );
    multipurpose_add_menu_page_custom(esc_attr__('MultiPurpose', 'newtheme'), esc_attr__('MultiPurpose', 'newtheme'), 'edit_theme_options', 'cpanel_options', 'cpanel_do_page',get_template_directory_uri() . '/options/cpanel/img/icon.png',30);
}
add_filter( 'the_content', 'wpautop');

function multipurpose_add_menu_page_custom( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null ) {
	        global $menu, $admin_page_hooks, $_registered_pages, $_parent_pages;	
	        $menu_slug = plugin_basename( $menu_slug );	
	        $admin_page_hooks[$menu_slug] = sanitize_title( $menu_title );	
	        $hookname = get_plugin_page_hookname( $menu_slug, '' );	
	        if ( !empty( $function ) && !empty( $hookname ) && current_user_can( $capability ) )
	                add_action( $hookname, $function );	
	        if ( empty($icon_url) ) {
	                $icon_url = 'none';
	                $icon_class = 'menu-icon-generic ';
	        } else {
	                $icon_url = set_url_scheme( $icon_url );
	                $icon_class = '';
	        }	
	        $new_menu = array( $menu_title, $capability, $menu_slug, $page_title, 'menu-top ' . $icon_class . $hookname, $hookname, $icon_url );	
	        if ( null === $position )
	                $menu[] = $new_menu;
	        else
	                $menu[$position] = $new_menu;	
	        $_registered_pages[$hookname] = true;
	        $_parent_pages[$menu_slug] = false;	
	return $hookname;
}

//use to add class on body
add_filter( 'body_class', 'multipurpose_body_class');
function multipurpose_body_class( $classes ) {
    $cpanel_info = get_option('cpanel_option');

    if(!empty($cpanel_info['colors'])) {
        $classes[] = $cpanel_info['colors'];
    }

    if(isset($cpanel_info['boxed']) && $cpanel_info['boxed'] == 'yes') {
        $classes[] = 'boxed';
		 
		if(isset($cpanel_info['boxed_shadow']) && $cpanel_info['boxed_shadow'] == 'yes') {
			$classes[] = 'shadow';
		}  
    }

    
   
    if(!empty($cpanel_info['patterns'])) {
        $classes[] = $cpanel_info['patterns'];
    }
	
	 if(!empty($cpanel_info['frame'])) {
        $classes[] = $cpanel_info['frame'];
    }

	
    return $classes;
}

// use to add class on header
function multipurpose_add_header_class(){
    $cpanel_info = get_option('cpanel_option');
    $class="";
    if(isset($cpanel_info['sticky']) && $cpanel_info['sticky'] == 'yes') {
        $class .= "sticky-enabled ";
		
		 if(!isset($cpanel_info['sticky_top_bar'])) {
        	$class .= "no-topbar";
    	}
    }
   
    return trim($class);
}

function multipurpose_add_style_head(){
$cpanel_info = get_option('cpanel_option');
$text="";
if(!empty($cpanel_info['boxed_color']) && !empty($cpanel_info['boxed'])&&$cpanel_info['boxed'] == 'yes') {
		  $text='<style type="text/css">
				body.boxed {background-color: #'.$cpanel_info["boxed_color"].'}
			</style>';
 }
 
 return $text;
}
?>