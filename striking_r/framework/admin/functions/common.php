<?php

/**
 * Check Whether the current wordpress version is support for the theme.
 */
function theme_check_wp_version(){
	global $wp_version;
	
	$check_WP   = '4.0';
	$is_ok  =  version_compare($wp_version, $check_WP, '>=');
	
	if ( ($is_ok == FALSE) ) {
		return false;
	}
	
	return true;
}

function theme_save_skin_style() {
	if(is_multisite()){
		global $blog_id;
		$file = THEME_CACHE_DIR.'/skin_'.$blog_id.'.css';
	}else{
		$file = THEME_CACHE_DIR.'/skin.css';
	}

	if(theme_get_option('advanced','complex_class')){
		$content = include(THEME_FUNCTIONS.'/skin_complex.php');
	}else{
		$content = include(THEME_FUNCTIONS.'/skin.php');
	}
	
	$result = theme_write_file($file, $content);
	return $result;
}

function theme_write_file($file, $content){
	if(!is_dir(dirname($file))){
		wp_mkdir_p(dirname($file));
	}
	if(wp_is_writable(dirname($file)) == false){
		@chmod(dirname($file),0755);
	}
	
	if(!wp_is_writable(dirname($file))) {
		return false;
	}
	
	if ( $file_handle = @fopen( $file, 'w+' ) ) {
		@fwrite( $file_handle, $content );
		fclose( $file_handle );

		return true;
	}
	
	return false;
}

function theme_check_image_folder(){
	if(!is_dir(THEME_CACHE_IMAGES_DIR)){
		theme_create_cache_files();
	}
	if(is_multisite()){
		if(!is_dir(THEME_CACHE_IMAGES_DIR)){
			wp_mkdir_p(THEME_CACHE_IMAGES_DIR);
		}
	}
}

function theme_clear_cache(){
	if(WP_Filesystem(array('method'=>'direct'))){
		$whitelist = array(
			'index.html',
			'skin.css',
			'skin_\d+.css',
			'images\/index.html',
			'images',
			'images\d+',
			'backup',
		);
		global $wp_filesystem;
		$files = $wp_filesystem->dirlist(THEME_CACHE_DIR, true, false);
		$pattern = "/^".implode('|',$whitelist)."$/i";

		foreach($files as $filename => $fileinfo){
			if(!preg_match($pattern, $filename)){
				$wp_filesystem->delete(trailingslashit(THEME_CACHE_DIR).$filename, true);
			}
		}
		$files = $wp_filesystem->dirlist(THEME_CACHE_IMAGES_DIR, true, false);
		if(!empty($files)){
			foreach($files as $filename => $fileinfo){
				if($filename != 'index.html'){
					$wp_filesystem->delete(trailingslashit(THEME_CACHE_IMAGES_DIR).$filename, true);
				}
			}
		}
	}
	$posts = get_posts( array( 
		'post_type'   => 'attachment', 
		'numberposts' => -1
	));
	foreach ( $posts as $post ) {
		$metadata = wp_get_attachment_metadata($post->ID);
		if(is_array($metadata)){
			unset($metadata['custom_sizes']);
		}
		wp_update_attachment_metadata($post->ID, $metadata);
	}
}
function theme_get_image_size(){
	$customs =  theme_get_option('image','customs');
	$sizes = array(
		"small" => __("Small",'theme_admin'),
		"medium" => __("Medium",'theme_admin'),
		"large" => __("Large",'theme_admin'),
	);
	if(!empty($customs)){
		$customs = explode(',',$customs);
		foreach($customs as $custom){
			$sizes[$custom] = ucfirst(strtolower($custom));
		}
	}
	return $sizes;
}
/**
 * Whether the current request is in nav menus page
 * 
 * @param mixed $post_types
 * @return bool True if inside theme options pages.
 */
function theme_is_nav_menu() {
	if ('nav-menus.php' == basename($_SERVER['PHP_SELF'])) {
		return true;
	}
	return false;
}
/**
 * Whether the current request is in theme options pages
 * 
 * @param mixed $post_types
 * @return bool True if inside theme options pages.
 */
function theme_is_options() {
	if ('admin.php' == basename($_SERVER['PHP_SELF']) && isset($_GET['page']) && stripos($_GET['page'], 'theme_') === 0 ) {
		return true;
	}
	// to be add some check code for validate only in theme options pages
	return false;
}
/**
 * Whether the current request is in post type pages
 * 
 * @param mixed $post_types
 * @return bool True if inside post type pages
 */
function theme_is_post_type($post_types = ''){
	if(theme_is_post_type_list($post_types) || theme_is_post_type_new($post_types) || theme_is_post_type_edit($post_types) || theme_is_post_type_post($post_types) || theme_is_post_type_taxonomy($post_types)){
		return true;
	}else{
		return false;
	}
}
/**
 * Whether the current request is in post type list page
 * 
 * @param mixed $post_types
 * @return bool True if inside post type list page
 */
function theme_is_post_type_list($post_types = '') {
	if ('edit.php' != basename($_SERVER['PHP_SELF'])) {
		return false;
	}
	if ($post_types == '') {
		return true;
	} else {
		$check = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_POST['post_type']) ? $_POST['post_type'] : 'post');
		if (is_string($post_types) && $check == $post_types) {
			return true;
		} elseif (is_array($post_types) && in_array($check, $post_types)) {
			return true;
		}
		return false;
	}
}

/**
 * Whether the current request is in post type new page
 * 
 * @param mixed $post_types
 * @return bool True if inside post type new page
 */
function theme_is_post_type_new($post_types = '') {
	if ('post-new.php' != basename($_SERVER['PHP_SELF'])) {
		return false;
	}
	if ($post_types == '') {
		return true;
	} else {
		$check = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_POST['post_type']) ? $_POST['post_type'] : 'post');
		if (is_string($post_types) && $check == $post_types) {
			return true;
		} elseif (is_array($post_types) && in_array($check, $post_types)) {
			return true;
		}
		return false;
	}
}
/**
 * Whether the current request is in post type post page
 * 
 * @param mixed $post_types
 * @return bool True if inside post type post page
 */
function theme_is_post_type_post($post_types = '') {
	if ('post.php' != basename($_SERVER['PHP_SELF'])) {
		return false;
	}
	if ($post_types == '') {
		return true;
	} else {
		$post = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post']) ? $_POST['post'] : false);
		$check = get_post_type($post);
		
		if (is_string($post_types) && $check == $post_types) {
			return true;
		} elseif (is_array($post_types) && in_array($check, $post_types)) {
			return true;
		}
		return false;
	}
}
/**
 * Whether the current request is in post type edit page
 * 
 * @param mixed $post_types
 * @return bool True if inside post type edit page
 */
function theme_is_post_type_edit($post_types = '') {
	if ('post.php' != basename($_SERVER['PHP_SELF'])) {
		return false;
	}
	$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');
	if ('edit' != $action) {
		return false;
	}
	
	if ($post_types == '') {
		return true;
	} else {
		$post = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post']) ? $_POST['post'] : false);
		$check = get_post_type($post);
		
		if (is_string($post_types) && $check == $post_types) {
			return true;
		} elseif (is_array($post_types) && in_array($check, $post_types)) {
			return true;
		}
		return false;
	}
}
/**
 * Whether the current request is in post type taxonomy pages
 * 
 * @param mixed $post_types
 * @return bool True if inside post type taxonomy pages
 */
function theme_is_post_type_taxonomy($post_types = '') {
	if ('edit-tags.php' != basename($_SERVER['PHP_SELF'])) {
		return false;
	}
	if ('term.php' != basename($_SERVER['PHP_SELF'])) {
		return false;
	}
	if ($post_types == '') {
		return true;
	} else {
		$check = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_POST['post_type']) ? $_POST['post_type'] : 'post');
		if (is_string($post_types) && $check == $post_types) {
			return true;
		} elseif (is_array($post_types) && in_array($check, $post_types)) {
			return true;
		}
		return false;
	}
}


add_action( 'update_option_page_on_front', 'theme_set_page_on_front',10,2);

function theme_set_page_on_front($old, $new){
	theme_set_option('homepage','home_page',$new);
}

//add_action( 'update_option_page_for_posts', 'theme_set_page_for_posts',10,2);

function theme_set_page_for_posts($old, $new){
	theme_set_option('blog','blog_page',$new);
}


function theme_slidershow_source_process($option,$value) {
	$source = array();
	if($value != false){
		if(is_array($value)){
			foreach($value as $option){
				if(strpos($option, '|') === false){
					$source[$option] = true;
				}else{
					list($target, $cat) = explode("|", $option);
					
					if(array_key_exists($target, $source)){
						if(is_array($source[$target])){
							$source[$target][] = $cat;
						}
					}else{
						$source[$target] = array();
						$source[$target][] = $cat;
					}
				}
			}
		}
	}
	$ret = '';
	foreach($source as $target=>$cats){
		$ret .= '{'.$target;
		if(is_array($cats)){
			$ret .= ':'.implode(",", $cats);
		}
		$ret .= '}';
	}
	return $ret;
}

function theme_slidershow_source_prepare($option) {
	$pattern = '/{([sbpg]):{0,1}([^}]+?){0,1}}/i';
	preg_match_all($pattern, $option['value'], $match);
	$value = array();
	if(!empty($match)){
		foreach($match[1] as $index => $target){
			$cats = explode(",", $match[2][$index]);
			
			foreach($cats as $cat){
				if(!empty($cat)){
					$value[]=$target.'|'.$cat;
				}else{
					$value[]=$target;
				}
			}
		}
	}
	$option['value'] = $value;
	return $option;
}

function theme_ajax_get_object_taxonomies() {
	if(isset($_POST['post_type'])){
		$taxonomies = get_object_taxonomies($_POST['post_type'],'objects');
		$output = '<option value="" selected="selected"></option>';
		if(is_array($taxonomies)){
			foreach ($taxonomies as $taxonomy) {
				if($taxonomy->show_ui){
					$output .= '<option value="'.$taxonomy->name.'">'.$taxonomy->label.'</option>';
				}
			}
		}
		echo $output;
	}

	die();
}
add_action('wp_ajax_theme-get-taxonomies', 'theme_ajax_get_object_taxonomies');

function theme_ajax_get_terms() {
	if(isset($_POST['taxonomy'])){
		$output = '';
		$terms = get_terms($_POST['taxonomy'],array(
			'orderby'	=> 'count',
			'hide_empty' => 0
		));
		if(is_array($terms)){
			foreach ($terms as $term) {
				$output .= '<option value="'.$term->slug.'">'.$term->name.'</option>';
			}
		}
		echo $output;
	}

	die();
}
add_action('wp_ajax_theme-get-terms', 'theme_ajax_get_terms');

function theme_ajax_do_shortcode() {
	if(isset($_POST['content'])){

		$content = $_POST['content'];
		echo do_shortcode(stripslashes($content));
	}

	die();
}
add_action('wp_ajax_theme-do-shortcode', 'theme_ajax_do_shortcode');

add_action( 'wp_edit_nav_menu_walker', 'theme_edit_nav_menu_walker');
add_action( 'wp_update_nav_menu_item', 'theme_update_nav_menu_item', 10, 3 );

function theme_edit_nav_menu_walker($walker){
	require_once(THEME_ADMIN_FUNCTIONS .'/nav-menu.php');
	
	return 'Theme_Walker_Nav_Menu_Edit';
}
function theme_update_nav_menu_item($menu_id, $menu_item_id, $args) {
    if ( isset($_POST["menu-item-icon"]) && is_array($_POST[ "menu-item-icon"])) {
    	foreach( $_POST["menu-item-icon"] as $post_id => $value ) {
			update_post_meta( $post_id, 'menu-item-icon', $value );
		}
	}
	if ( isset($_POST["menu-item-icon-color"]) && is_array($_POST[ "menu-item-icon-color"])) {
		if(array_key_exists($menu_item_id, $_POST[ "menu-item-icon-color"])){
			update_post_meta( $menu_item_id, 'menu-item-icon-color', $_POST[ 'menu-item-icon-color'][$menu_item_id] );
		}
	}
	if ( isset($_POST["menu-item-not-show-in-mobile"]) && is_array($_POST[ "menu-item-not-show-in-mobile"])) {
		if(array_key_exists($menu_item_id, $_POST[ "menu-item-not-show-in-mobile"])){
			update_post_meta( $menu_item_id, 'not-show-in-mobile', $_POST[ 'menu-item-not-show-in-mobile'][$menu_item_id] );
		} else {
			delete_post_meta ($menu_item_id, 'not-show-in-mobile');
		}
	} else {
		delete_post_meta ($menu_item_id, 'not-show-in-mobile');
	}
}

add_action('wp_ajax_theme-install-demo-data', 'theme_ajax_install_dummy_data');
function theme_ajax_install_dummy_data(){
	$nonce = $_POST['nonce'];
	$demotype = $_POST['type'];

	if( !wp_verify_nonce($nonce, 'install-demo-'.THEME_SLUG) ){
		die('-1'); 
	}
	
	require_once (THEME_ADMIN_FUNCTIONS . '/importer.php');
	theme_install_dummy_data($demotype);

  	die();
}