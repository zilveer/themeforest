<?php
add_action('after_setup_theme', 'lang_theme_setup');
function lang_theme_setup(){
    load_theme_textdomain('cb-cosmetico', get_template_directory() . '/locale');
}
/**************************************************************************/
//required plugins
require_once('BFI_Thumb.php');
if(is_admin()){
	require_once('inc/tgm-plugin-activation/class-tgm-plugin-activation.php');
	add_action( 'tgmpa_register', 'cb_register_required_plugins' );

	function cb_register_required_plugins() {
		$plugins = array(
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'WP PageNavi',
			'slug' 		=> 'wp-pagenavi',
			'required' 	=> true,
		),
		array(
			'name' 		=> 'Yoast Breadcrumbs',
			'slug' 		=> 'breadcrumbs',
			'required' 	=> true,
		),
		array(
			'name' 		=> 'WooCommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> true,
		),
		array(
			'name' 		=> 'WooCommerce Cloud Zoom Image Plugin',
			'slug' 		=> 'cloud-zoom-for-woocommerce',
			'required' 	=> true,
		),
		array(
			'name' 		=> 'YITH WooCommerce Wishlist',
			'slug' 		=> 'yith-woocommerce-wishlist',
			'required' 	=> true,
		)

		);
		$theme_text_domain = 'cb-cosmetico';

		$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
		);

		tgmpa( $plugins, $config );
	}
}
//required plugins end

define( 'WP_THEME_URL', get_template_directory_uri('template_directory'));

//aqua page builder with cosmetico modifications
require_once('inc/builder-aqua-cb/aq-page-builder.php');

/**************************************************************************/
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
/**************************************************************************/
/* cb admin menu*/
if(is_admin()){require(TEMPLATEPATH . "/inc/cb-menu.php");}
/**************************************************************************/
/*  add first-menu-item class to first menu item  */
function add_first($output) {
	$output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
	return $output;
}
add_filter('wp_nav_menu', 'add_first');
/**************************************************************************/
/* get page */
function gep($pageId){
	if(!is_numeric($pageId)){ return; }
	global $wpdb;
	$sql_query = 'SELECT DISTINCT * FROM '.$wpdb->posts.' WHERE '.$wpdb->posts.'.ID='.$pageId;
	$posts = $wpdb->get_results($sql_query);
	if(!empty($posts)) {
		foreach($posts as $post) {
			return nl2br($post->post_content);
		}
	}
}
/**************************************************************************/
/*  add last menu item class  */
function add_last_item_class2($menuHTML) {
	$last_items_ids  = array();
	$menus = wp_get_nav_menus();
	foreach ( $menus as $menu_maybe ) {
		if ( $menu_items = wp_get_nav_menu_items($menu_maybe->term_id) ) {
			$items = array();
			foreach ( $menu_items as $menu_item ) {
				$items[$menu_item->menu_item_parent][] = $menu_item->ID;
			}
			foreach ( $items as $item ) {
				$last_items_ids[] .= end($item);
			}
		}
	}
	$items_add_class='';
	$replacement='';
	foreach( $last_items_ids as $last_item_id ) {
		$items_add_class[] .= ' menu-item-'.$last_item_id;
		$replacement[]    .= ' menu-item-'.$last_item_id . ' last-menu-item';
	}
	$menuHTML = str_replace($items_add_class, $replacement, $menuHTML);
	return $menuHTML;

}
add_filter('wp_nav_menu','add_last_item_class2');

function add_class_attachment_link($html){
	$postid = get_the_ID();
	$html = str_replace('<a','<a data-rel="pp[mg]"',$html);
	return $html;
}
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);
/**************************************************************************/
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(array('main-menu' => 'main-menu'));
}
/**************************************************************************/
/* custom excerpts */
function custom_excerpt_length($length) {
	return 22;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
	return ' /... ';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('widget_text', 'do_shortcode');

/* strip content */
function strip_cn($con,$con_lg) {
	if(strlen($con)>$con_lg) {
		$con=preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s','',$con);
		$con=preg_replace('/<img[^>]+\>/i','',$con);
		$con=strip_tags($con);
		if($con_lg!='0') return substr($con,0,(int)$con_lg).' /...';
	}
	else {
		$con=preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s','',$con);
		$con=preg_replace('/<img[^>]+\>/i','',$con);
		$con=strip_tags($con);
		return $con;
	}
}

/* strip + show html*/
function strip_cn_html($con,$con_lg) {
	if(strlen($con)>$con_lg) {
		return substr($con,0,$con_lg).' /...';
	}
	else {
		return $con;
	}
}

/* strip content + show image*/
function strip_cn_i($con,$con_lg) {
	if(strlen($con)>$con_lg) {
		$con=preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s','',$con);
		$con=strip_tags($con);
		return substr($con,0,$con_lg).' /...';
	}
	else {
		$con=preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s','',$con);
		$con=strip_tags($con);
		return $con;
	}
}
/**************************************************************************/
/* admin uploader */
function add_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', WP_THEME_URL.'/inc/js/upl.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}
function add_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'add_scripts');
add_action('admin_print_styles', 'add_styles');
add_filter('media_send_to_editor', 'media_editor', 1, 3);

function media_editor($html, $send_id, $attachment ){
	$post = get_post($send_id);
	$html .= '<media>'.$post->guid.'</media>';
	return $html;
}
/**************************************************************************/
add_action('admin_head', 'arial_font');
function arial_font() {
	$admin_theme=get_option('cb5_admin_theme');
	if($admin_theme!='yes') echo '
<link rel="stylesheet" href="'.WP_THEME_URL.'/css/admin.css"/>
<link rel="stylesheet" href="'.WP_THEME_URL.'/inc/font-awesome/css/font-awesome.min.css"/>';
	echo '<style type="text/css">
#cb_setts .button-primary {line-height:9px!important;}
#cb_setts select {
padding: 2px 8px;
}
.mce-i-cbut {
background:url(../wp-content/themes/cb-cosmetico/inc/js/button.png) center center no-repeat transparent!important;
}
</style>';
}
/**************************************************************************/
/*  add shortcode generator button  */
if(is_admin()){
	function add_cb_button() {
		if (!current_user_can('edit_posts') && ! current_user_can('edit_pages'))
		return;
		if (get_user_option('rich_editing')=='true') {
			add_filter('mce_external_plugins', 'add_cb_tinymce_plugin');
			add_filter('mce_buttons', 'register_cb_button');
		}
	}
	add_action('init', 'add_cb_button');

	function register_cb_button($buttons) {
		array_push($buttons, "|", "cb_button");
		return $buttons;
	}

	function add_cb_tinymce_plugin($plugin_array) {
		$plugin_array['cb_button'] = WP_THEME_URL.'/inc/js/cb_button.js';
		return $plugin_array;
	}

	function my_refresh_mce($ver) {
		$ver += 3;
		return $ver;
	}
	add_filter( 'tiny_mce_version', 'my_refresh_mce');
}

add_action('admin_head', 'cb_add_my_tc_button');

function cb_add_my_tc_button() { global $typenow; // check user permissions 
if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) { return; }
 // verify the post type 
 if( ! in_array( $typenow, array( 'post', 'page' ) ) ) return; 
 // check if WYSIWYG is enabled 
 if ( get_user_option('rich_editing') == 'true') { add_filter("mce_external_plugins", "cbdd_tinymce_plugin"); 
 add_filter('mce_buttons', 'cb_register_my_tc_button'); } }

function cbdd_tinymce_plugin($plugin_array) {
	$plugin_array['cb_tc_button'] = WP_THEME_URL.'/inc/js/cb_button.js'; 
	 return $plugin_array;
}

function cb_register_my_tc_button($buttons) { array_push($buttons, "cb_tc_button"); return $buttons; }










/**************************************************************************/
/*  under construction page  */
$under=get_option('cb5_under');
if($under=='yes') {
	get_currentuserinfo() ;
	global $user_level;
	if ($user_level<10&&!in_array($GLOBALS['pagenow'],array('wp-login.php', 'wp-register.php'))&&stripos($_SERVER['REQUEST_URI'],'/wp-admin/')==false) {
		require('inc/cb-under-construction.php'); exit; }
}
/**************************************************************************/
$editor_style=get_option('cb5_editor_style');
if($editor_style=='yes') { add_editor_style('text-editor.css'); }
/**************************************************************************/
function is_login_page() {
	return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}
/*  Scripts  */
function cb5_scripts() {
	if( !is_admin()&&!is_login_page() ){
		require(get_template_directory().'/inc/cb-general-options.php');
		global $post;
		$cb_type=esc_attr(get_post_meta($post->ID, 'cb5_cb_type', $single = true));
		wp_enqueue_script('cosmeticocustomjs',WP_THEME_URL.'/inc/js/cb_functions.js', array('jquery'), '1.0', true);
        wp_localize_script(
            'cosmeticocustomjs',
            'ajax_script',
            array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		if($usescroll=='yes')wp_enqueue_script('scrollbar',WP_THEME_URL.'/inc/js/scroll/jquery.custom-scrollbar.js',array('jquery'),'1.0',true);
		$slide_type=get_option('cb5_slide_type');
		$header_type='';
		if(isset($post->ID))$header_type=get_post_meta($post->ID, 'cb5_header_type', $single = true);
		if($header_type=='slider_head') $slider_home=get_post_meta($post->ID, 'cb5_home_slider', $single = true); else $slider_home='';
		wp_enqueue_script('gmaps','//maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
		if($disable_pp=='no'){
			wp_enqueue_script('prettyphoto',WP_THEME_URL.'/inc/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true);
		}
		wp_enqueue_script('jqueryui',WP_THEME_URL.'/inc/js/ui/jquery-ui.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('masonrye',WP_THEME_URL.'/inc/js/jquery.masonry.min.js', array('jquery'), '1.0', true);

		if( ($full_slider=='yes'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$full_slider_where=='yes' ) )||$slider_home=='full'){
			wp_enqueue_script('fulleasing',WP_THEME_URL.'/inc/js/supersized/slideshow/js/jquery.easing.min.js', array('jquery'), '1.0', true);
			wp_enqueue_script('fullsuper',WP_THEME_URL.'/inc/js/supersized/slideshow/js/supersized.3.2.7.min.js', array('jquery'), '1.0', false);
			if($full_slider_style=='1') { wp_enqueue_script('fullshutter',WP_THEME_URL.'/inc/js/supersized/slideshow/theme/supersized.shutter.min.js', array('jquery'), '1.0', true); }
		}
		if($cb_type=='gallery')wp_enqueue_script('adipoli',WP_THEME_URL.'/inc/js/adipoli-v2/jquery.adipoli.min.js', array('jquery'), '2.0', true);
		$cb_type='';
		wp_enqueue_script('backstretch',WP_THEME_URL.'/inc/js/jquery.backstretch.min.js',array('jquery'),'1.0',true);
	wp_enqueue_script('knob',WP_THEME_URL.'/inc/js/jquery.knob.js',array('jquery'),'1.0',true);
	wp_enqueue_script('viewport',WP_THEME_URL.'/inc/js/jquery.viewport.mini.js',array('jquery'),'1.0',true);
	wp_enqueue_script('doubletap',WP_THEME_URL.'/inc/js/doubletaptogo.js',array('jquery'),'1.0',true);
	}
}
add_action('wp_print_scripts', 'cb5_scripts');


/**************************************************************************/

/*  CSS  */
function cb5_css() {
	if( !is_admin() ){

		require(get_template_directory().'/inc/cb-general-options.php');
		wp_enqueue_style('stylesheet', get_stylesheet_uri(), false, '1.0', 'screen');
		wp_enqueue_style('videojs', WP_THEME_URL.'/inc/js/video-js/video-js.css', false, '1.0', 'screen');
		wp_enqueue_style('fontawesome',WP_THEME_URL.'/inc/font-awesome/css/font-awesome.min.css', false, '1.0', 'screen');
		require(get_template_directory().'/inc/cb-general-options.php');
		global $post;
		//if(!isset($post->ID)) $post->ID='';
		$slide_type=get_option('cb5_slide_type');
		$header_type='';
		if(isset($post->ID))$header_type=get_post_meta($post->ID, 'cb5_header_type', $single = true);
		if($header_type=='slider_head') $slider_home=get_post_meta($post->ID, 'cb5_home_slider', $single = true); else $slider_home='';
		global $post;
		//if(!isset($post->ID)) $post->ID='';
		$cb_type=esc_attr(get_post_meta($post->ID, 'cb5_cb_type', $single = true));
		if($disable_pp=='no'||$disable_pp==''){
			wp_enqueue_style('prettyphoto', WP_THEME_URL.'/inc/css/prettyPhoto.css', false, '1.0', 'screen');
		}
		if($cb_type=='gallery') { wp_enqueue_style('adi', WP_THEME_URL.'/inc/js/adipoli-v2/adipoli.css', false, '1.0', 'screen'); }
		wp_enqueue_style('jui', WP_THEME_URL.'/inc/css/jquery-ui.css', false, '1.0', 'screen');
		if( ($full_slider=='yes'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$full_slider_where=='yes' ) )||$slider_home=='full'){
			if($full_slider_style=='1') { wp_enqueue_style('fullshutter', WP_THEME_URL.'/inc/js/supersized/slideshow/theme/supersized.shutter.css', false, '1.0', 'screen'); }
			wp_enqueue_style('fulls', WP_THEME_URL.'/inc/js/supersized/slideshow/css/supersized.css', false, '1.0', 'screen');
		}
		wp_enqueue_style('woo',WP_THEME_URL.'/css/woo.css', false, '1.0', 'screen');
		wp_enqueue_style('responsive',WP_THEME_URL.'/css/responsive.css', false, '1.0', 'screen');

		$fonts_g=array();
		if($font_family_google!='------') {
			$font_g=$font_family_google;
			$font_g=str_replace(' ','%20',$font_g);$font_g=str_replace('+','%20',$font_g);
			$font_gg=str_replace('%20',' ',$font_g);
			array_push($fonts_g,$font_g);
		}

		if($font_family_google_head!='------') {
			$font_g_head=$font_family_google_head;
			$font_g_head=str_replace(' ','%20',$font_g_head);$font_g_head=str_replace('+','%20',$font_g_head);
			$font_gg_head=str_replace('%20',' ',$font_g_head);
			array_push($fonts_g,$font_g_head);
		}

		if($font_family_google_head_title!='------') {
			$font_g_head_title=$font_family_google_head_title;
			$font_g_head_title=str_replace(' ','%20',$font_g_head_title);$font_g_head_title=str_replace('+','%20',$font_g_head_title);
			$font_gg_head_title=str_replace('%20',' ',$font_g_head_title);
			array_push($fonts_g,$font_g_head_title);
		}

		if($font_family_google_head_title2!='------') {
			$font_g_head_title2=$font_family_google_head_title2;
			$font_g_head_title2=str_replace(' ','%20',$font_g_head_title2);$font_g_head_title2=str_replace('+','%20',$font_g_head_title2);
			$font_gg_head_title2=str_replace('%20',' ',$font_g_head_title2);
			array_push($fonts_g,$font_g_head_title2);
		}

		if($menu_f!='------') {
			$menu_f=str_replace(' ','%20',$menu_f);$menu_f=str_replace('+','%20',$menu_f);
			$menu_f2=str_replace('+','%20',$menu_f);
			array_push($fonts_g,$menu_f);
		}

		if($logo_f!='------') {
			$logo_f=str_replace(' ','%20',$logo_f);$logo_f=str_replace('+','%20',$logo_f);
			$logo_f2=str_replace('%20',' ',$logo_f);
			array_push($fonts_g,$logo_f);
		}
		$fonts_g=array_unique($fonts_g); $pcp=0;
		foreach($fonts_g as $fonts_g_value) { $pcp++; wp_enqueue_style('font_extra_'+$pcp, 'http://fonts.googleapis.com/css?family='.$fonts_g_value.':400,500,600,700', false, '1.0', 'screen');
		}

	}//is admin end

}
add_action('wp_print_styles', 'cb5_css');


/*  Add dynamic scripts and css content to every page  */
function cb_cus_op() {
	get_template_part('inc/cb-css');
	get_template_part('inc/cb-js');
}
add_action('wp_head', 'cb_cus_op');


/**************************************************************************/

/*  theme activation messages  */
function cb_activate($oldname, $oldtheme=false) {

	$msg = '<div id="message2" class="updated"><h2>Congratulations! Cosmetico has been activated.</h2>
<br/>INSTALL REQUIRED PLUGINS FIRST.
<br/>To Install Demo Content select "Demo Content" Tab in cosmetico Settings after clicking button below.
<form method="POST" action="admin.php?page=cb-menu.php">
<br/><input type="submit" class="button" value="Configure Cosmetico or Install Demo Content- which we recommend">
</form><br/></div>';

	add_action('admin_notices', $c=create_function('','echo "'.addcslashes($msg,'"').'";'));

}
function cb_activate_i($oldname, $oldtheme=false) {
	require('inc/cb-install.php');
}

add_action('after_switch_theme', 'cb_activate', 10 ,  2);
add_action('after_switch_theme', 'cb_activate_i', 10 ,  2);


/**************************************************************************/


if(is_admin()){include_once (TEMPLATEPATH.'/inc/post-page-config.php');} // post & page config
include_once (TEMPLATEPATH.'/inc/widgets.php'); // widgets
include_once (TEMPLATEPATH.'/inc/shortcodes.php'); // shortcodes

/*require('update-notifier.php');*/

/**************************************************************************/

add_theme_support( 'woocommerce' );

/**************************************************************************/
function array_str_replace( $sSearch, $sReplace, &$aSubject ) {

	foreach( $aSubject as $sKey => $uknValue ) {
		if( is_array($uknValue) ) {
			array_str_replace( $sSearch, $sReplace, $aSubject[$sKey] );
		} else {
			$aSubject[$sKey] = str_replace( $sSearch, $sReplace, $uknValue );
		}
	}

}
/*  Get content from builder  */
function cb5_builder_content($contentos){
	global $post;
	$builder_id=get_post_meta($post->ID,'cb5_builder','yes');
	$blocks=get_post_meta($post->ID,'blocks','yes');

	if($builder_id!=''&&$builder_id!='0') {
		$blocks = array();
		$all = get_post_custom($builder_id);
		foreach($all as $key => $block) {
			if(substr($key, 0, 9) == 'aq_block_') {
				$block_instance = get_post_meta($builder_id, $key, true);
				if(is_array($block_instance)) $blocks[$key] = $block_instance;
			}
		}
		$sort = array();
		foreach($blocks as $block) {
			$sort[] = $block['order'];
		}
		array_multisort($sort, SORT_NUMERIC, $blocks);
	}

	$content_show=true;
	if($builder_id!='') {
		if(isset($blocks)&&is_array($blocks)){
			array_str_replace(";cbsp#21&;","\r\n",$blocks);
			array_str_replace(";cbsp#21;","\r\n",$blocks);
			ob_start();
			$aq=new AQ_Block();
			$template_id='';
			echo '<div id="aq-template-wrapper-'.$post->ID.'" class="aq-template-wrapper aq_row">';
			$overgrid = 0; $span = 0; $first = false;

			foreach($blocks as $key => $instance) {
				if (isset($blocks[$key]['content'])){
					$instance['content']=str_replace(";cbsp#21&;","\r\n",$instance['content']);
					$instance['content']=str_replace(";cbsp#21;","\r\n",$instance['content']);
				}
				global $aq_registered_blocks;
				extract($instance);
				if(class_exists($id_base)) {
					$block = $aq_registered_blocks[$id_base];
					$instance['template_id'] = $template_id;
					if (isset($instance['id_base']))if($instance['id_base'] == "aq_content_block") $content_show=false;

					if($parent == 0) {
						$col_size = absint(preg_replace("/[^0-9]/", '', $size));
						$overgrid = $span + $col_size;
						if($overgrid > 12 || $span == 12 || $span == 0) {
							$span = 0;
							$first = true;
						}
						if($first == true) {
							$instance['first'] = true;
						}

						$block->block_callback($instance);
						$span = $span + $col_size;
						$overgrid = 0;
						$first = false;
					}
				}
			}
			echo '</div>';
			$con=ob_get_contents();
			ob_end_clean();
			if($builder_id!=''&&$builder_id!='0'){
				$con=str_replace('<br />','',$con);
				$con=html_entity_decode($con);
			}

			$con=str_replace(';cbsp#21&;','<br/>',$con);
			$con=str_replace(';cbsp#21;','<br/>',$con);
			//echo '<pre>'.$con.'</pre>';
			if($content_show)return $contentos.$con;
			else return $con;
		}} else return $contentos;
}
add_filter('the_content','cb5_builder_content');


/*  shortcode spacing fix  */
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


/*  AJAX loader for portfolio and blog  */
add_action( 'wp_ajax_nopriv_cbloader', 'cb_loader_code' );
add_action( 'wp_ajax_cbloader', 'cb_loader_code' );
function cb_loader_code() {

	check_ajax_referer('cosmetico-settings', 'security');
	$data = $_POST;
	
	unset($data['security'], $data['action']);
	if (isset($data['cats']))$cats = $data['cats'];
	if (isset($data['typ']))$typ = $data['typ']; else $typ='port';
	if (isset($data['con_lg']))$con_lg = $data['con_lg']; else $con_lg='100';
	if (isset($data['per_page']))$per_page = $data['per_page'];
	if (isset($data['paged']))$paged = $data['paged'];
	if (isset($data['col_v']))$col_v = $data['col_v'];
	if (isset($data['columns']))$columns = $data['columns'];
	if (isset($data['pcap']))$pcap = $data['pcap'];
	if (isset($data['headi']))$headi = $data['headi'];
	if (isset($data['headi_end']))$headi_end = $data['headi_end'];
	if (isset($data['plink']))$plink = $data['plink'];
	if (isset($data['pshape']))$pshape = $data['pshape'];
	if (isset($data['fr']))$fr = $data['fr'];
	if (isset($data['frin']))$frin = $data['frin'];
	if (isset($data['pheight']))$pheight = $data['pheight'];
	if (isset($data['roundy']))$roundy = $data['roundy'];
	if (isset($data['bfi_w']))$bfi_w = $data['bfi_w']; else $bfi_w='';
	if (isset($data['det']))$det = $data['det']; else $det='no';

	ob_start();
	
	?>
<div
	class="<?php if($typ=='blog') echo 'blog_els'; else echo 'port_els'; ?>">
	<?php
	$cc=1;
	query_posts('cat='.$cats.'&posts_per_page='.$per_page.'&paged='.$paged);
	if(have_posts()) :
	while(have_posts()) : the_post() ?>
	<?php global $post;
	$output=''; $ccat='';
	$c_cat=get_the_category();

	foreach($c_cat as $c_cat_item) {
		$output .= ' cat-'.$c_cat_item->term_id ;
		$ccat .= $c_cat_item->term_id;

	}
	$headi=str_replace('/','',$headi);
	?>

	<div class="<?php if($typ=='blog') echo 'postbox blog_item post-cat'; else echo 'pitem'; ?> <?php echo $col_v;?> <?php echo $output; ?>" data-id="<?php echo $ccat; ?>" style="<?php if($columns!=1&&$cc%$columns==0&&$cc!=0) echo 'margin-right: 0;'; ?>">
	<?php if($typ=='blog'){ ?>
		<div
			class="<?php if (has_post_format('quote')) echo 'post_quote';  if (has_post_format('link')) echo 'post_link';  if (has_post_format('gallery')) echo 'post_gallery';  ?> ddd blog_inside_post">
			<?php }?>

			<?php   $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
			$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

			if($isrc=='') {$isrc=wp_get_attachment_image_src(array_shift(array_keys($imgs)),'full'); }
			$bfi_var='';
			if($pshape==''||$pshape=='rectangle'||$pshape=='default') $bfi_var=bfi_thumb($isrc[0], array('width' => $bfi_w, 'height'=>$bfi_w, 'crop' => true));
			else $bfi_var=bfi_thumb($isrc[0], array('width' => $bfi_w, 'height'=>$bfi_w, 'crop' => true));
			$pshapediv='';
			$pshapecon='';
			if($pcap=='yes') $nocap=''; else $nocap=' nocap';
			if($pcap=='yes') $pcapy=''; else $pcapy='';
			$see_more=__('see more','cb-cosmetico');
			if($plink=='ajax') $picons='<div class="see_more_wrap"><div class="see_wrap2"><a data-cur-id="'.$post->ID.'" onclick="load_image(\''.$isrc[0].'\',\''.$post->ID.'\');return false;" href="'.$isrc[0].'"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';
			else $picons='<div class="see_more_wrap"><div class="see_wrap2"><a href="'.$isrc[0].'" data-rel="pp[ppgall]"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';
			if($plink=='page') $picons='<div class="see_more_wrap"><div class="see_wrap2"><a href="'.get_permalink().'"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';


			if($pshape!=''&&$pshape!='default'&&$pshape!='rectangle') {
				$pshapediv=$picons.'<div class="pshape-'.$pshape.'"></div>'; $fadec1=''; $fadec2='<div class="fade_c fade_cajax">'.$pcapy.'</div>';
				$pshapecon='portfolio-shape'.$nocap;
			} else {
				$pshapediv=''; $fadec1='<div class="fade_c fade_cajax">'.$pcapy.$picons.'</div>'; $fadec2=''; $pshapecon='';
			}



			if($isrc) { ?>
			<div
				class="<?php echo $fr; ?> <?php echo $roundy; ?> fade fade_ajax <?php echo $pshapecon; ?>">
				<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
				<?php echo $fadec1; ?>
				<?php echo $pshapediv.$fadec2; ?>
					<a <?php if($plink=='ajax') { ?>
						data-cur-id="<?php echo $post->ID; ?>"
						onclick="load_image('<?php echo $isrc[0]; ?>','<?php echo $post->ID; ?>');return false;"
						<?php } ?>
						href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"
						<?php  if($plink=='image') echo 'data-rel="pp"'; ?>><img
						src="<?php echo $bfi_var; ?>"
						class="<?php echo $roundy; ?> fade fade_ajax fade-si"
						alt="portfolio item" /> </a>
					<div class="cl"></div>
				</div>

				<?php if($det=='yes'||$typ=='blog'){
					$pcatso='';
					if($typ=='blog') echo '<div class="recent_inside">'; else echo '<div class="portfolio_det">';
					$categoriesy=wp_get_post_categories($post->ID);
					foreach($categoriesy as $cate) {
						$category = get_category( $cate );
						$pcatso .= '<a href="'.get_category_link($category->term_id ).'" class="skin-text" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
					}
					$pcatso=substr($pcatso,0,-2);
					echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end;
					if($typ=='blog') {
						echo ' <h3 class="date_title skin-text"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_avatar(get_the_author_meta('ID'),32).get_the_author().'</a> <i class="icon-time"></i> '.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'';
						echo '</h3>';
					} else {
						echo '<span class="port_author skin-text">by: <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link skin-text">'.get_the_author().'</a></span>';
						echo '<span class="port_date skin-text">'.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</span> / <span class="port_cats skin-text">'.$pcatso.'</span>';
					}
					if($typ=='blog') { ?>
				<p>
				<?php
				$con=get_the_content();
				echo strip_cn($con,$con_lg);
				?>
				</p><a href="<?php echo get_permalink(); ?>" class="bttn_big"><?php _e('read more','cb-cosmetico');?>
				</a>
				<?php }
				}
				?>

			</div>
		</div>

		<?php } else { ?>

		<?php if($typ!='blog'){?>
		<div class="<?php echo $fr; ?> <?php echo $roundy; ?>">
			<div class="<?php echo $frin; ?> round">
				<a href="<?php echo get_permalink(); ?>"><img
					src="<?php echo bfi_thumb(WP_THEME_URL.'/img/test_bg.jpg', array('width' => 980, 'height'=>950, 'crop' => true)); ?>"
					class="<?php echo $roundy; ?> fade fade_ajax" alt="no image" /> </a>
				<div class="cl"></div>
			</div>
			<?php } ?>
			<?php if($det=='yes'||$typ=='blog'){
				$pcatso='';
				if($typ=='blog') echo '<div class="recent_inside">'; else echo '<div class="portfolio_det">';
				$categoriesy=wp_get_post_categories($post->ID);
				foreach($categoriesy as $cate) {
					$category = get_category( $cate );
					$pcatso .= '<a href="'.get_category_link($category->term_id ).'" class="skin-text" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
				}
				$pcatso=substr($pcatso,0,-2);
				echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end;
				if($typ=='blog') {
					echo ' <h3 class="date_title skin-text"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_avatar(get_the_author_meta('ID'),32).get_the_author().'</a> <i class="icon-time"></i> '.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'';
					echo '</h3>';
				} else {
					echo '<span class="port_author skin-text">by: <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link skin-text">'.get_the_author().'</a></span>';
					echo '<span class="port_date skin-text">'.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</span> / <span class="port_cats skin-text">'.$pcatso.'</span>';
				}
				if($typ=='blog') { ?>
			<p>
			<?php
			$con=get_the_content();
			echo strip_cn($con,$con_lg);
			?>
			</p>
			<?php }
			}
			?>
		</div>
	</div>

	<?php } ?>

	<?php if($typ!='blog'){ ?>
	<div class="port_item port_<?php echo $post->ID;?>">
	<?php echo '<h1 class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></h1>'; ?>
	<?php echo get_the_content(); ?>
	<?php
	$port_url=get_post_meta($post->ID,'cb5_port_url','true');
	$port_client=get_post_meta($post->ID,'cb5_port_client','true');
	$port_key=get_post_meta($post->ID,'cb5_port_key','true');
	echo '<ul>';
	if($port_url!='') echo '<li><b>'.__('Project URL').'</b>: <a href="'.$port_url.'" target="_blank">'.$port_url.'</a></li>';
	if($port_client!='') echo '<li><b>'.__('Project Client').'</b>: '.$port_client.'</li>';
	if($port_key!='') echo '<li><b>'.__('Keywords').'</b>: <i>'.$port_key.'</i></li>';
	echo '</ul>';
	echo '<div class="port_arrows"><a class="cb-next-porfolio prev-arrow" data-me-id="'.$post->ID.'" data-action="prev">&laquo; '.__('previous item','cb-cosmetico').'</a><a class="cb-next-porfolio next-arrow" data-me-id="'.$post->ID.'" data-action="next">'.__('next item','cb-cosmetico').' &raquo;</a></div>';
	?>

	</div>

	<div class="c_item c_item_<?php echo $post->ID;?>"
		style="display: none;">
		<a href="#" class="prev_item">&laquo; <?php _e('prev item','cb-cosmetico');?>
		</a> <a href="#" class="next_item"><?php _e('next item','cb-cosmetico');?>
			&raquo;</a>
	</div>
	<?php } ?>



	<div class="cl"></div>
	<?php if($typ=='blog'){?>
</div>
	<?php }?>
</div>
<!--/portfolio post end-->
	<?php


	$cc++; endwhile;
	endif;
	wp_reset_query();
	?>
<div class="cl"></div>
</div>
<div class="cl"></div>
	<?php

	$data = ob_get_contents();
	ob_end_clean();
	die($data);
}

/*  AJAX loader for portfolio and blog  */
add_action( 'wp_ajax_nopriv_cbprodloader', 'cbprodloader_code' );
add_action( 'wp_ajax_cbprodloader', 'cbprodloader_code' );
function cbprodloader_code() {

	check_ajax_referer('cosmetico-settings', 'security');
	$data = $_POST;
	unset($data['security'], $data['action']);
	if (isset($data['typ']))$typ = $data['typ'];
	if (isset($data['next_page']))$next_page = $data['next_page'];
	if (isset($data['per']))$per = $data['per'];
	if (isset($data['cols']))$cols = $data['cols'];
	global $woocommerce_loop;
	switch($typ){
		case "hot_products":
			$args = array('post_type'=>'product','post_status'=>'publish','ignore_sticky_posts'=>1,'paged'=>$next_page,'posts_per_page'=>$per,
'meta_query'=>array(
			array('key' => '_visibility','value' => array('catalog', 'visible'),'compare' => 'IN'),
			array('key' => '_sale_price','value' => 0,'compare' => '>','type' => 'NUMERIC')
			));
			ob_start();
			$products = new WP_Query( $args );
			//echo '<pre>';print_r($products);echo '</pre>';
			$woocommerce_loop['columns'] = $cols;
			if ( $products->have_posts() ) : ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; ?>

			<?php endif;
			wp_reset_query();
			$data=ob_get_clean(); ob_flush();
			break;

case "new_products":
	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per,
		'paged'=>$next_page,
		'orderby' => 'date',
		'order' => 'desc',
		'meta_query' => array(
	array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
				)
				)
				);
				ob_start();
				$products = new WP_Query( $args );
				//echo '<pre>';print_r($products);echo '</pre>';
				$woocommerce_loop['columns'] = $cols;
				if ( $products->have_posts() ) : ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<?php woocommerce_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; ?>

				<?php endif;
				wp_reset_query();
				$data=ob_get_clean(); ob_flush();
				break;

case "best_sellers":
	$args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page' => $per,
		'paged'=>$next_page,
        'meta_key' 		 => 'total_sales',
    	'orderby' 		 => 'meta_value',
        'meta_query' => array(
	array(
                'key' => '_visibility',
                'value' => array( 'catalog', 'visible' ),
                'compare' => 'IN'
                )
                )
                );
                ob_start();
                $products = new WP_Query( $args );
                //echo '<pre>';print_r($products);echo '</pre>';
                $woocommerce_loop['columns'] = $cols;
                if ( $products->have_posts() ) : ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                <?php endwhile; ?>

                <?php endif;
                wp_reset_query();
                $data=ob_get_clean(); ob_flush();
                break;

	}
	die($data);
}



//woocommerce options


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
<a class="cart-contents <?php if($woocommerce->cart->cart_contents_count>9) echo 'v2'; ?>"
	href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
	title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo $woocommerce->cart->cart_contents_count;?><span
	class="cart_top_count"><?php echo $woocommerce->cart->get_cart_total(); ?>
</span> </a>
	<?php

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;

}









/* WooCommerce Chosen Addon
 Plugin Name: WooCommerce Chosen Variation Dropdowns
 Plugin URI: http://gerhardpotgieter.com/tag/woocommerce-chosen-variations
 Version: 0.1
 Description: Transform the variation dropdowns on your product pages to Chosen dropdowns.
 Author: kloon
 Tested up to: 3.6
 Author URI: http://gerhardpotgieter.com

 License: GNU General Public License v3.0
 License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	if ( ! class_exists( 'WC_Chosen_Variation_Dropdowns' ) ) {

		class WC_Chosen_Variation_Dropdowns {

			function __construct() {
				add_filter( 'woocommerce_catalog_settings', array( $this, 'register_settings' ) );
				add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
			}

			function register_settings( $settings ) {
				$newsettings = array();
				foreach ( $settings as $key => $value ) {
					if ( $key == 6 ) {
						$newsettings[] = array(
							'title'		=> __( 'Disable Product Chosen Search', 'woocommerce' ),
							'desc' 		=> __( 'Disable Chosen search field on product variation dropdowns.', 'woocommerce' ),
							'id' 		=> 'woocommerce_chosen_variation_search_disabled',
							'default'	=> 'no',
							'type' 		=> 'checkbox',
							'checkboxgroup'		=> 'start'
							);
							$newsettings[] = $value;
					} else {
						$newsettings[] = $value;
					}
				}
				return $newsettings;
			}

			function register_scripts() {
				if ( apply_filters( 'woocommerce_is_product_chosen_dropdown', is_singular( 'product' ) ) ) {
					global $woocommerce;
					$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
					wp_register_script( 'ajax-chosen', $woocommerce->plugin_url() . '/assets/js/chosen/ajax-chosen.jquery'.$suffix.'.js', array('jquery', 'chosen'), $woocommerce->version );
					wp_register_script( 'chosen', $woocommerce->plugin_url() . '/assets/js/chosen/chosen.jquery'.$suffix.'.js', array('jquery'), $woocommerce->version );
					wp_enqueue_script( 'ajax-chosen' );
					wp_enqueue_script( 'chosen' );
					wp_enqueue_style( 'woocommerce_chosen_styles', $woocommerce->plugin_url() . '/assets/css/chosen.css' );

					// Get options and build options string
					$options = array();
					$new_options = array();
					$js_options = '';
					if ( get_option( 'woocommerce_chosen_variation_search_disabled' ) == 'yes' )
					$options['disable_search'] = 'true';

					if ( ! empty( $options ) ) {
						foreach ( $options as $key => $value ) {
							$new_options[] = $key . ': ' . $value;
						}
						$js_options = '{' . implode( ',', $new_options ) . '}';
					}

					//wc_enqueue_js( "
					//	jQuery('.variations select').chosen(" . $js_options . ");
					//" );
				}
			}
		}

		$GLOBALS['wc_chosen_variation_dropdowns'] = new WC_Chosen_Variation_Dropdowns();
	}
}



add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' » ';
	return $defaults;
}


/*  Mailchimp ajax subscribe */
add_action( 'wp_ajax_nopriv_mailchimp_subscribe', 'mailchimp_subscribe_code' );
add_action( 'wp_ajax_mailchimp_subscribe', 'mailchimp_subscribe_code' );
function mailchimp_subscribe_code() {

	check_ajax_referer('cb-cosmetico', 'security');
	$data = $_POST;
	$response = '1';
	unset($data['security'], $data['action']);


	if (isset($data['email']))$email = $data['email'];
	if (isset($data['fname']))$fname = $data['fname'];else $fname='';
	if (isset($data['sname']))$sname = $data['sname'];else $sname='';
	if (isset($data['mailchimp_list']))$mailchimp_list = $data['mailchimp_list'];

	$result['success'] = false;
	$result['message'] = stripslashes(get_option('cb5_mailchimp_failure'));


	if($email=='' || ! is_email($email)){
		$result['success'] = false;
		$result['message'] = __('Correct email address', 'cb-cosmetico');
		$response = json_encode($result);
		exit($response);
	}

	if($mailchimp_list==''){
		$result['success'] = false;
		$result['message'] = stripslashes(get_option('cb5_mailchimp_failure'));
		$response = json_encode($result);
		exit($response);
	}

	if (!class_exists('MailChimp')) require_once(get_template_directory() . '/inc/mailchimp-api-master/MailChimp.class.php');
	$MailChimp = new MailChimp(get_option('cb5_mailchimp_key'));
	$mailresult = $MailChimp->call('lists/subscribe', array(
			'id'                => $mailchimp_list,
			'email'             => array('email'=>$email),
			'merge_vars'        => array('FNAME'=>$fname, 'LNAME'=>$sname),
			'double_optin'      => false,
			'update_existing'   => true,
			'replace_interests' => false,
			'send_welcome'      => false,
	));
	if(isset($mailresult['email'])){

		$result['success'] = true;
		$result['message'] = stripslashes(get_option('cb5_mailchimp_success'));
		$response = json_encode($result);
		exit($response);
	}
	if(isset($mailresult['status'])&& $mailresult['status']=='error'){
		$result['success'] = false;
		$result['message'] = $mailresult['error'];
		$response = json_encode($result);
		exit($response);
	}

	$response = json_encode($result);
	exit($response);

}
$cb_woo_per_page_value=get_option('cb5_woo_per_page');
$woo_per_page='return '.$cb_woo_per_page_value.';';
add_filter( 'loop_shop_per_page', create_function( '$cols', $woo_per_page ), 20 );
?>
