<?php 
add_action('after_setup_theme', 'lang_theme_setup');
function lang_theme_setup(){
    load_theme_textdomain('cb-modello', get_template_directory() . '/lang');
}
//cb-theme layout
require_once('inc/cb-theme/cb-theme-class.php');
require_once('inc/cb-theme/cb-theme-options.php');

//thumbnails generator
require_once('inc/cb-lib/bfithumb.php');

//required plugins
if(is_admin()){
require_once('inc/cb-activate-plugins/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'modello_register_required_plugins' );

function modello_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/assets/revslider.zip', // The plugin source
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
			'required' 	=> false,
		),
		array(
			'name' 		=> 'YITH WooCommerce Wishlist',
			'slug' 		=> 'yith-woocommerce-wishlist',
			'required' 	=> true,
		),
		array(
			'name' 		=> 'Widget Importer Exporter',
			'slug' 		=> 'widget-importer-exporter',
			'required' 	=> true,
		),

	);
	$theme_text_domain = 'cb-modello';
	
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

//aqua page builder with modello modifications
require_once('inc/cb-builder/aq-page-builder.php');
//require_once('inc/builder-aqua-cb/aq-page-builder.php');

/**************************************************************************/
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support( 'woocommerce' );
/**************************************************************************/
/* cb admin menu*/
if(is_admin()){require(TEMPLATEPATH . "/inc/cb-admin/cb-admin-template.php");}
/**************************************************************************/
function add_first($output) {
  $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
  return $output;
}
add_filter('wp_nav_menu', 'add_first');

/**************************************************************************/
/* get page*/
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
$woo_menu=esc_attr(get_option('cb5_woo_menu'));
if($woo_menu!='yes') {
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
}

function add_class_attachment_link($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a data-rel="pp[mg]"',$html);
    return $html;
}
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);
/**************************************************************************/
add_action( 'init', 'register_my_menus' );
    function register_my_menus() {
    register_nav_menus(array('menu-1' => 'main-menu','mobile-menu'=>'mobile-menu'));
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
wp_register_script('my-upload', WP_THEME_URL.'/inc/assets/js/upl.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
function add_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_enqueue_scripts', 'add_scripts');
add_action('admin_enqueue_scripts', 'add_styles');
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
if($admin_theme!='yes')
    wp_enqueue_style( 'font-awesome',WP_THEME_URL.'/inc/assets/font-awesome/css/font-awesome.min.css');

}

/**************************************************************************/
function wpse35898_admin_head() {
    ?>
    <script type="text/javascript">
        window.onbeforeunload = function() {};
    </script>
<?php
}
add_action( 'admin_head' , 'wpse35898_admin_head' );

/**************************************************************************/
$under=get_option('cb5_under');
if($under=='yes') {
WP_GET_CURRENT_USER();
global $user_level; 
if ($user_level<10&&!in_array($GLOBALS['pagenow'],array('wp-login.php', 'wp-register.php'))&&stripos($_SERVER['REQUEST_URI'],'/wp-admin/')==false) { 
require('inc/cb-under-construction.php'); exit; }
} 
/**************************************************************************/
$editor_style=get_option('cb5_editor_style');
if($editor_style=='yes') { add_editor_style('text-editor.css'); }
/**************************************************************************/

function cb5_scripts() {
    if( !is_admin() ){
    //require('inc/cb-theme/cb-theme-options.php'); 
	global $post;
	$cb_js_options='';
	if(isset($post->ID)) $cb_js_options=cb_get_js_options($post->ID);
	wp_enqueue_script('modellocustomjs',WP_THEME_URL.'/inc/assets/js/cb_functions.js', array('jquery'), '1.0', true);
    wp_localize_script('modellocustomjs','ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	if(isset($post->ID)&&$cb_js_options['usescroll']=='nicescroll') wp_enqueue_script('scrollbar',WP_THEME_URL.'/inc/assets/js/scroll/jquery.custom-scrollbar.js',array('jquery'),'1.0',true);
	if(isset($post->ID)&&$cb_js_options['usescroll']=='smooth')  {
		wp_enqueue_script('scrollbar2',WP_THEME_URL.'/inc/assets/js/jquery.simplr.smoothscroll.js',array('jquery'),'1.0',true);
		}
	wp_enqueue_script('gmaps','http://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
	if(isset($post->ID)&&$cb_js_options['disable_pp']=='no'){
	 wp_enqueue_script('prettyphoto',WP_THEME_URL.'/inc/assets/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true);
	} else wp_enqueue_script('prettyphoto',WP_THEME_URL.'/inc/assets/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true);
	wp_enqueue_script('jqueryui',WP_THEME_URL.'/inc/assets/js/ui/jquery-ui.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('masonry',WP_THEME_URL.'/inc/assets/js/jquery.masonry.min.js', array('jquery'), '1.0', true);
	
	if((isset($post->ID)&&$cb_js_options['full_slider']=='yes'&&((isset($post->ID)&&$cb_js_options['home_slider']=='')||(isset($post->ID)&&$cb_js_options['home_slider']=='none'))&&( is_front_page()||is_home()||(isset($post->ID)&&$cb_js_options['full_slider_where']=='yes' )) )||(isset($post->ID)&&$cb_js_options['home_slider']=='full')){
	wp_enqueue_script('fulleasing',WP_THEME_URL.'/inc/assets/js/supersized/slideshow/js/jquery.easing.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('fullsuper',WP_THEME_URL.'/inc/assets/js/supersized/slideshow/js/supersized.3.2.7.min.js', array('jquery'), '1.0', false);
	if(isset($post->ID)&&$cb_js_options['full_slider_style']=='1') { wp_enqueue_script('fullshutter',WP_THEME_URL.'/inc/assets/js/supersized/slideshow/theme/supersized.shutter.min.js', array('jquery'), '1.0', true); }
	}
	wp_enqueue_script('imload',WP_THEME_URL.'/inc/assets/js/imagesloaded.pkgd.min.js',array('jquery'),'1.0',true);
	wp_enqueue_script('knob',WP_THEME_URL.'/inc/assets/js/jquery.knob.js',array('jquery'),'1.0',true);
	wp_enqueue_script('viewport',WP_THEME_URL.'/inc/assets/js/jquery.viewport.mini.js',array('jquery'),'1.0',true);
	wp_enqueue_script('backstretch',WP_THEME_URL.'/inc/assets/js/jquery.backstretch.min.js',array('jquery'),'1.0',true);
    wp_enqueue_script('echo',WP_THEME_URL.'/inc/assets/js/echo-master/src/echo.js',array('jquery'),'1.0',true);
    wp_enqueue_script('sel2',WP_THEME_URL.'/inc/assets/js/select2/select2.js',array('jquery'),'1.0',true);
     
    wp_enqueue_script('modernizr',WP_THEME_URL.'/inc/assets/js/modernizr.custom.js',array('jquery'),'1.0');
	wp_enqueue_script('doubletap',WP_THEME_URL.'/inc/assets/js/doubletaptogo.js',array('jquery'),'1.0',true);

    /* modello_add */
    wp_enqueue_script('jquerymigrate',WP_THEME_URL.'/inc/assets/js/modello/jquery-migrate-1.2.1.js',array('jquery'),'1.0',true);
    wp_enqueue_script('bootstrap',WP_THEME_URL.'/css/modello/bootstrap/js/bootstrap.min.js',array('jquery'),'1.0',true);
    wp_enqueue_script('carouFredSel',WP_THEME_URL.'/inc/assets/js/modello/jquery.carouFredSel-6.2.1-packed.js',array('jquery'),'1.0',true);
    wp_enqueue_script('easing',WP_THEME_URL.'/inc/assets/js/modello/jquery.easing-1.3.js',array('jquery'),'1.0',true);
    wp_enqueue_script('lazyload',WP_THEME_URL.'/inc/assets/js/modello/jquery.lazyload.min.js',array('jquery'),'1.0',true);
    wp_enqueue_script('bootslider',WP_THEME_URL.'/inc/assets/js/modello/bootstrap-slider.js',array('jquery'),'1.0',true);
    wp_enqueue_script('customscript',WP_THEME_URL.'/inc/assets/js/modello/script.js',array('jquery'),'1.0',true);
    wp_enqueue_script('customscript2',WP_THEME_URL.'/inc/js/modello/script.js',array('jquery'),'1.0',true);
    }
}
add_action('wp_print_scripts', 'cb5_scripts');

/**************************************************************************/

function cb5_css() {
    if( !is_admin() ){
	
	//require('inc/cb-theme/cb-theme-options.php');
	global $post;
	$cb_css_options=cb_get_css_options($post->ID);

	wp_enqueue_style('sel2',WP_THEME_URL.'/inc/assets/js/select2/select2.css', false, '1.0', 'screen');
	wp_enqueue_style('stylesheet', get_stylesheet_uri(), false, '1.0', 'screen');
	wp_enqueue_style('blocks',WP_THEME_URL.'/css/blocks.css', false, '1.0', 'screen');
	if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	wp_enqueue_style('wooc',WP_THEME_URL.'/css/woo.css', false, '1.0', 'screen');
	}
	wp_enqueue_style('fontawesome',WP_THEME_URL.'/inc/assets/font-awesome/css/font-awesome.min.css', false, '1.0', 'screen');

	wp_enqueue_style('any', WP_THEME_URL.'/inc/assets/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
	if($cb_css_options['disable_pp']=='no'||$cb_css_options['disable_pp']==''){
	 wp_enqueue_style('prettyphoto', WP_THEME_URL.'/inc/assets/css/prettyPhoto.css', false, '1.0', 'screen');
	} 
	if($cb_css_options['cb_type']=='gallery') { wp_enqueue_style('adi', WP_THEME_URL.'/inc/assets/js/adipoli-v2/adipoli.css', false, '1.0', 'screen'); }
	wp_enqueue_style('jui', WP_THEME_URL.'/inc/assets/css/jquery-ui.css', false, '1.0', 'screen');
	if( ($cb_css_options['full_slider']=='yes'&&($cb_css_options['home_slider']==''||$cb_css_options['home_slider']=='none')&&( is_front_page()||is_home()||$cb_css_options['full_slider_where']=='yes' ) )||$cb_css_options['home_slider']=='full'){
	if($cb_css_options['full_slider_style']=='1') { wp_enqueue_style('fullshutter', WP_THEME_URL.'/inc/assets/js/supersized/slideshow/theme/supersized.shutter.css', false, '1.0', 'screen'); }
	wp_enqueue_style('fulls', WP_THEME_URL.'/inc/assets/js/supersized/slideshow/css/supersized.css', false, '1.0', 'screen');
    }
	wp_enqueue_style('qtip',WP_THEME_URL.'/inc/assets/js/qtip/jquery.qtip.min.css', false, '1.0', 'screen');
	wp_enqueue_style('responsive',WP_THEME_URL.'/css/responsive.css', false, '1.0', 'screen');

	
	$fonts_g=array();
	if($cb_css_options['font_family_google']!='------') { 
	$font_g=$cb_css_options['font_family_google'];
	$font_g=str_replace(' ','%20',$font_g);$font_g=str_replace('+','%20',$font_g);
	$font_gg=str_replace('%20',' ',$font_g);
	array_push($fonts_g,$font_g);
	}
	
	if($cb_css_options['font_family_google_head']!='------') { 
	$font_g_head=$cb_css_options['font_family_google_head'];
	$font_g_head=str_replace(' ','%20',$font_g_head);$font_g_head=str_replace('+','%20',$font_g_head);
	$font_gg_head=str_replace('%20',' ',$font_g_head);
	array_push($fonts_g,$font_g_head);
	}
	
	if($cb_css_options['font_family_google_head_title']!='------') { 
	$font_g_head_title=$cb_css_options['font_family_google_head_title'];
	$font_g_head_title=str_replace(' ','%20',$font_g_head_title);$font_g_head_title=str_replace('+','%20',$font_g_head_title);
	$font_gg_head_title=str_replace('%20',' ',$font_g_head_title);
	array_push($fonts_g,$font_g_head_title);
	}
	
	if($cb_css_options['font_family_google_head_title2']!='------') { 
	$font_g_head_title2=$cb_css_options['font_family_google_head_title2'];
	$font_g_head_title2=str_replace(' ','%20',$font_g_head_title2);$font_g_head_title2=str_replace('+','%20',$font_g_head_title2);
	$font_gg_head_title2=str_replace('%20',' ',$font_g_head_title2);
	array_push($fonts_g,$font_g_head_title2);
	}

	if($cb_css_options['menu_f']!='------') { 
	$menu_f=str_replace(' ','%20',$cb_css_options['menu_f']);$menu_f=str_replace('+','%20',$menu_f);
	$menu_f2=str_replace('+','%20',$menu_f);
	array_push($fonts_g,$menu_f);
	}
	
	if($cb_css_options['logo_f']!='------') { 
	$logo_f=str_replace(' ','%20',$cb_css_options['logo_f']);$logo_f=str_replace('+','%20',$logo_f);
	$logo_f2=str_replace('%20',' ',$logo_f);
	array_push($fonts_g,$logo_f);
	}
	$fonts_g=array_unique($fonts_g); $pcp=0;
	foreach($fonts_g as $fonts_g_value) { $pcp++; wp_enqueue_style('font_extra_'+$pcp, 'http://fonts.googleapis.com/css?family='.$fonts_g_value.':400,500,600,700', false, '1.0', 'screen');
	}

        /* modello_add START */
        wp_enqueue_style('fontsanspro','http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700', false, '1.0', 'screen');
        wp_enqueue_style('fontjosefin','http://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,700', false, '1.0', 'screen');

        wp_enqueue_style('bootstrapcss',WP_THEME_URL.'/css/modello/bootstrap/css/bootstrap.min.css', false, '1.0', 'screen');
        wp_enqueue_style('fontawersome','http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', false, '1.0', 'screen');

        wp_enqueue_style('slidercss',WP_THEME_URL.'/css/modello/slider1.css', false, '1.0', 'screen');
        wp_enqueue_style('customstyle',WP_THEME_URL.'/css/modello/style.css"', false, '1.0', 'screen');
        wp_enqueue_style('animatecss',WP_THEME_URL.'/css/modello/animate.min.css', false, '1.0', 'screen');
        wp_enqueue_style('responsivecss',WP_THEME_URL.'/css/modello/responsive.css', false, '1.0', 'screen');
        wp_enqueue_style('dataslider',WP_THEME_URL.'/css/modello/dataslider.css', false, '1.0', 'screen');



        /* modello_add END */

    }//is admin end
	
}
add_action('wp_enqueue_scripts', 'cb5_css');


function modello_cus_op() {
get_template_part('inc/cb-css');
get_template_part('inc/cb-js');
}
add_action('wp_head', 'modello_cus_op');


/**************************************************************************/

function modello_activate($oldname, $oldtheme=false) {

$msg = '<div id="message2" class="updated"><h2>Congratulations! Modello has been activated.</h2>
<br/>INSTALL REQUIRED PLUGINS FIRST.
<br/>To Install Demo Content select "Demo Content" Tab in modello Settings after clicking button below.
<form method="POST" action="admin.php?page=cb-admin">
<br/><input type="submit" class="button" value="Configure Modello or Install Demo Content- which we recommend">
</form><br/></div>';

add_action('admin_notices', $c=create_function('','echo "'.addcslashes($msg,'"').'";'));

}
function modello_activate_i($oldname, $oldtheme=false) {
    if(esc_attr(get_option('cb5_installed'))!='yes'){
        require('inc/cb-install.php');

    }
}

add_action('after_switch_theme', 'modello_activate', 10 ,  2);
add_action('after_switch_theme', 'modello_activate_i', 10 ,  2);


/**************************************************************************/

if(is_admin()){include_once (TEMPLATEPATH.'/inc/cb-post-config.php');} // post & page config
include_once (TEMPLATEPATH.'/inc/cb-widgets.php'); // widgets
include_once (TEMPLATEPATH.'/inc/cb-shortcodes.php'); // shortcodes

require('update-notifier.php');

/**************************************************************************/

add_theme_support( 'woocommerce' );

/**************************************************************************/

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
//    array_str_replace(";cbsp#21;","\r\n",$blocks);
ob_start();
    /*echo '<pre>';
    print_r($blocks);
    echo '</pre>';
    */
$aq=new AQ_Block();
$template_id='';
echo '<div id="aq-template-wrapper-'.$post->ID.'" class="aq-template-wrapper row">';
$overgrid = 0; $span = 0; $first = false;

foreach($blocks as $key => $instance) {
if (isset($blocks[$key]['content'])){
$instance['content']=str_replace(";cbsp#21&;","\r\n",$instance['content']);
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
global $post;
$cb_type=esc_attr(get_post_meta($post->ID, '_cb5_post_type', 'true'));
if($builder_id!=''&&$builder_id!='0'){
$con=str_replace('<br />','',$con);
$con=html_entity_decode($con); }
//if($content_show)return $contentos.'<div class="builder_padding"></div>'.$con;
$bpad='';
if(isset($cb_type)&&$cb_type=='portfolio_project') $con='<div class="cl"></div><div><div><div class="contentos_builder_portfolio">'.$con.'</div></div>';
if($contentos!='')$bpad='<div class="builder_padding"></div>';

if(isset($cb_type)&&$cb_type=='portfolio_project') return $contentos.'</div></div></div>'.$con;
else if($content_show)return $contentos.$bpad.$con;
else return $con;
}} else return $contentos;
}
add_filter('the_content','cb5_builder_content');

//woocommerce options
if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
$cb5_woo_cols=get_option('cb5_woo_cols');
global $woocommerce_loop;
$cb5_woo_per_page_value=get_option('cb5_woo_per_page');
$woocommerce_loop['columns'] = $cb5_woo_cols;
$cb5_woo_per_page='return '.$cb5_woo_per_page_value.';';
add_filter('loop_shop_per_page', create_function('$cols',$cb5_woo_per_page ));
}

function array_str_replace( $sSearch, $sReplace, &$aSubject ) {

	foreach( $aSubject as $sKey => $uknValue ) {
		if( is_array($uknValue) ) {
			array_str_replace( $sSearch, $sReplace, $aSubject[$sKey] );
		} else {
			$aSubject[$sKey] = str_replace( $sSearch, $sReplace, $uknValue );
		}
	}

}









/*  AJAX loader for blog blocks  */
add_action( 'wp_ajax_nopriv_cbloader', 'cb_loader_code' );
add_action( 'wp_ajax_cbloader', 'cb_loader_code' );
function cb_loader_code() {

	check_ajax_referer('cb-secur', 'security');
	$data = $_POST;
	unset($data['security'], $data['action']);
	if (isset($data['cats']))$cats = $data['cats'];
	if (isset($data['per_page']))$per_page = $data['per_page'];
	if (isset($data['ord']))$ord = $data['ord'];
	if (isset($data['paged']))$paged = $data['paged'];
	if (isset($data['hide_content']))$hide_content = $data['hide_content'];
	if (isset($data['style']))$style = $data['style'];
	if (isset($data['cap']))$cap = $data['cap'];
	if (isset($data['link']))$link = $data['link'];
	if (isset($data['title']))$title = $data['title'];
	if (isset($data['post_details']))$post_details = $data['post_details'];
	if (isset($data['columns']))$columns = $data['columns'];
	if (isset($data['con_lg']))$con_lg = $data['con_lg'];
	if (isset($data['pshape']))$pshape = $data['pshape'];
	if (isset($data['alig']))$alig = $data['alig'];
	if (isset($data['list']))$list = $data['list'];
	if (isset($data['read_more']))$read_more = $data['read_more'];
	if (isset($data['sf']))$sf=$data['sf'];
	if (isset($data['gallery_blog']))$gallery_blog = $data['gallery_blog'];
	if (isset($data['fade']))$fade = $data['fade'];
	if (isset($data['fade_ani']))$fade_ani = $data['fade_ani'];
	if (isset($data['ajax']))$ajax = $data['ajax'];
	if (isset($data['side']))$side = $data['side'];
	if (isset($data['global_side']))$global_side = $data['global_side'];
	if (isset($data['coutput']))$coutput = $data['coutput'];
	if (isset($data['full_port']))$full_port = $data['full_port'];
	$echo='no';

	ob_start();
	$cc=1;
query_posts('cat='.$cats.'&posts_per_page='.$per_page.'&order='.$ord.'&paged='.$paged);
$count_posts=1; $roc=0; $aligp='';
$cbtheme=new cbtheme();
if(have_posts()) :
		while(have_posts()){ the_post();
		global $post;
		$cb_blocks_options=cb_get_blocks_options($post->ID);
		$cb_sidebars=cb_get_sidebars($post->ID);
		if($alig!=''&&$alig!='no') $aligp=$cb_blocks_options['posts_style']; else $aligp='';
		if($count_posts%$columns=='0') $mr='0'; else $mr='';

$cbtheme->build_blocks(array('cb_type'=>$cb_blocks_options['cb_type'],'read_more'=>$read_more,
		'sf'=>$sf,'gallery_blog'=>$gallery_blog,
		'hide_content'=>$hide_content,'style'=>$style,'fade'=>$fade,'fade_ani'=>$fade_ani,
		'cap'=>$cap,'link'=>$link,'ajax'=>$ajax,
		'side'=>$side,'global_side'=>$global_side,'title'=>$title,'details'=>$post_details,'columns'=>$columns,'echo'=>'no',
		'con_lg'=>$con_lg,'mr'=>$mr,'pshape'=>$pshape,'aligp'=>$aligp,'list'=>$list,'coutput'=>$coutput,'full'=>$full_port));

		$count_posts++;
		
		} else :
		$roc=1;
		get_template_part('404');
endif;
  
  $data = ob_get_contents();
  ob_end_clean();
  die($data);
}







/*  AJAX loader for PRODUCTS  */
add_action( 'wp_ajax_nopriv_cbprodloader', 'cbprodloader_code' );
add_action( 'wp_ajax_cbprodloader', 'cbprodloader_code' );
function cbprodloader_code() {

	check_ajax_referer('modello-settings', 'security');
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
			$data=ob_get_clean(); 
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
				$data=ob_get_clean(); 
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
if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	$woo_cols=get_option('cb5_woo_cols');
	global $woocommerce_loop;
	$cb_woo_per_page_value=get_option('cb5_woo_per_page');
	$woocommerce_loop['columns'] = $woo_cols;
	$woo_per_page='return '.$cb_woo_per_page_value.';';
	add_filter( 'loop_shop_per_page', create_function( '$cols', $woo_per_page ));

    remove_action( 'woocommerce_after_single_product_summary',
        'woocommerce_output_related_products',20);
    add_action( 'woocommerce_after_single_product',
        'woocommerce_output_related_products', 20);
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
<div class="cart-aja"> 
<a class="cart-contentsy <?php if($woocommerce->cart->cart_contents_count>9) echo 'v2'; ?>" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('Shopping cart', 'cb-modello'); ?>">
<?php _e('shopping cart','cb-modello')?>:
</a>
                       <span class="top-cart-price"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
                        <div class="total-buble">
                            <span><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                        </div>

                    
                   

                        <div class="hover-holder">
                        
                        
                        
                        
                        
                        
                        
<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

?>

                        
                        
                            

                                

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<ul class="basket-items ">
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php $isempty=''; $cr=0;$cp=0; $rpt=1; $ccc=0;
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) { $ccc=0;


			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) { $cr++;} }

			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
if($ccc<6) {
				if ( $_product->exists() && $values['quantity'] > 0 ) { $cp++;
					?>
					<li class="row">
					<div class="thumb col-xs-3">
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
					</div>

						<div class="body col-xs-9">
						<?php
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else{
									echo '
                                        <h5>'; printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );
									echo '</h5>';
								}
							?>
							<div class="price">
                            <span>
							<?php
								$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?></span>
                            </div>
						<?php
				echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove-item" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
				?>
                          </div>
                         </li>
							
					<?php } 
				}$ccc++;
			} 
		}else { $rpt=0; echo '<li class="empty_shop">'.__('Your shopping cart is empty.','cb-modello').'</li>'; $isempty='true';}
global $woocommerce;
$cart_url = $woocommerce->cart->get_cart_url();

if($ccc>6)  echo '<a class="view_carty" href="'.$cart_url.'">'.__('View all products','cb-modello').'</a>';

		do_action( 'woocommerce_cart_contents' );
		?>
		<?php if($rpt!=0) {?>
				<input type="submit" class="top-chk-out md-button" name="proceed" value="<?php _e( 'Checkout', 'cb-modello' ); ?>" />
				<?php do_action('woocommerce_proceed_to_checkout'); ?>
				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		<?php } ?>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
                            </ul>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">
<?php do_action('woocommerce_cart_collaterals'); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
                        </div></div>
	
	<?php

	$fragments['div.cart-aja'] = ob_get_clean();

	return $fragments;

}




/* Facebook login
*/
require_once('inc/cb-lib/cb-facebook-connect/cb-fb-connect.php');



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
					wp_register_script( 'ajax-chosen', get_template_directory_uri() . '/inc/assets/chosen/ajax-chosen.jquery'.$suffix.'.js', array('jquery', 'chosen'), $woocommerce->version );
					wp_register_script( 'chosen', get_template_directory_uri() . '/inc/assets/chosen/chosen.jquery'.$suffix.'.js', array('jquery'), $woocommerce->version );
					wp_enqueue_script( 'ajax-chosen' );
					wp_enqueue_script( 'chosen' );
					wp_enqueue_style( 'woocommerce_chosen_styles', get_template_directory_uri() . '/inc/assets/chosen/chosen.css' );

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

					wc_enqueue_js( "
						jQuery('.variations select').chosen(" . $js_options . ");
					" );
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
function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
        switch ($num % 10) {
            // Handle 1st, 2nd, 3rd
            case 1:  return $num.'st';
            case 2:  return $num.'nd';
            case 3:  return $num.'rd';
        }
    }
    return $num.'th';
}

/*  Mailchimp ajax subscribe */
add_action( 'wp_ajax_nopriv_mailchimp_subscribe', 'mailchimp_subscribe_code' );
add_action( 'wp_ajax_mailchimp_subscribe', 'mailchimp_subscribe_code' );
function mailchimp_subscribe_code() {

    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    $response = '1';
    unset($data['security'], $data['action']);


    if (isset($data['email']))$email = $data['email'];
    if (isset($data['fname']))$fname = $data['fname'];else $fname='';
    if (isset($data['sname']))$sname = $data['sname'];else $sname='';
    if (isset($data['mailchimp_list']))$mailchimp_list = $data['mailchimp_list'];

    $result['success'] = false;
    $result['message']= stripslashes(get_option('cb5_mailchimp_failure'));


    if($email=='' || ! is_email($email)){
        $result['success'] = false;
        $result['message'] = __('Correct email address', 'cb-modello');
        $response = json_encode($result);
        exit($response);
    }

if($mailchimp_list==''){
    $result['success'] = false;
    $result['message'] = stripslashes(get_option('cb5_mailchimp_failure'));
    $response = json_encode($result);
    exit($response);
}

    if (!class_exists('MailChimp')) require_once(get_template_directory() . '/inc/cb-lib/mailchimp-api-master/MailChimp.class.php');
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
add_action('admin_init', 'on_admin_init');

function on_admin_init()
{
    // include the library
    if (!class_exists('Envato_WordPress_Theme_Upgrader')) include_once(get_template_directory() . '/inc/cb-lib/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');

 if(get_option('cb5_envato_user') && get_option('cb5_envato_key')){
    $upgrader = new Envato_WordPress_Theme_Upgrader( get_option('cb5_envato_user'), get_option('cb5_envato_key') );

    $upgrader->check_for_theme_update();

    $upgrader->upgrade_theme();
 }
}

/**
 *  @param string $label html label  of field
 *  @param string|int $selected  selected value
 *  @param array $arg arguments array(value,label for value)
 *  @param string $name html select name
 *  @param string $id html select #id (when empty == $name)
 *  @return void generate select tag
 */

function generate_select($label, $selected, $arg, $name, $id = '',$info='')
{
	?>
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <?php if ($info!='') echo '<div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">' . $info.'</span></div>';?>
    <select name="<?php echo $name; ?>" id="<?php echo(($id != '') ? $id : $name); ?>">
        <?php
        for ($i = 0; $i < sizeof($arg); $i++) {
            echo '<option value="' . $arg[$i][0] . '" ' . (($arg[$i][0] == $selected) ? 'selected' : '') . '>' . $arg[$i][1] . '</option>';
        }
        ?>
    </select>
<?php
}
function generate_check($label, $selected, $name, $id = '')
{
    ?>
    <input name="<?php echo $name; ?>" type="hidden" value="no" />
    <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
    <input name="<?php echo $name; ?>" id="<?php echo(($id != '') ? $id : $name); ?>"
     <?php
           if ($selected=='yes') echo ' checked="checked"';
        ?> class="check" type="checkbox" value="yes" />
    <label for="<?php echo $name; ?>" class="css-label"></label>
    <div class="cl"></div>
<?php
}

function generate_hint($hint)
{
	?>
    <div class="cb_hint"><i class="fa fa-info ani-bg"></i><span class="hint"><?php echo $hint; ?></span></div>
<?php
}


/**
 * get array key | no notices when key not exist
 * @param $array
 * @param $key
 * @return string
 */
function cb_get_value($array, $key)
{
    if (isset($array[$key])) return $array[$key]; else return '';
}

/* hex to rgb conversion*/
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
	return implode(",", $rgb); // returns the rgb values separated by commas
	//return $rgb; // returns an array with the rgb values
}
$custom_posttypes = array(
    array('type'=>'service','template_id'=>6505,'labels'=>array(
        'name' => 'Services',
        'singular_name' => 'Service',
        'add_new' => 'Add new',
        'add_new_item' => 'Add new service',
        'new_item' => 'New service',
        'edit_item' => 'Edit service',
        'view_item' => 'See service',
        'search_items' => 'Search service',
        'parent_item_colon' => 'Service parent:'
    ),'supports'=>array('title', 'excerpt', 'custom-fields','author','thumbnail','comments','revisions' ),
        'taxonomies' =>array(),'rewrite'=>array('slug' => 'service', 'with_front' => false),'public'=>true,'has_archive' =>true,'query_var' =>true,'menu_icon'=>'dashicons-awards'),

    array('type'=>'portfolio','template_id'=>8019,'labels'=>array(
        'name' => 'Portfolio',
        'singular_name' => 'Portfolio item',
        'add_new' => 'Add new',
        'add_new_item' => 'Add new portfolio item',
        'new_item' => 'New portfolio item',
        'edit_item' => 'Edit portfolio item',
        'view_item' => 'See portfolio item',
        'search_items' => 'Search portfolio item',
        'parent_item_colon' => 'Portfolio item parent:'
    ),'supports'=>array('title', 'excerpt', 'custom-fields','author','thumbnail','comments','revisions' ),
        'taxonomies' =>array(),'rewrite'=>array('slug' => 'portfolio', 'with_front' => false),'public'=>true,'has_archive' =>true,'query_var' =>true,'menu_icon'=>'dashicons-portfolio'),

    array('type'=>'gallery','template_id'=>8022,'labels'=>array(
        'name' => 'Gallery',
        'singular_name' => 'Gallery item',
        'add_new' => 'Add new',
        'add_new_item' => 'Add new gallery item',
        'new_item' => 'New gallery item',
        'edit_item' => 'Edit gallery item',
        'view_item' => 'See gallery item',
        'search_items' => 'Search gallery item',
        'parent_item_colon' => 'Gallery item parent:'
    ),'supports'=>array('title', 'excerpt', 'custom-fields','author','thumbnail','comments','revisions' ),
        'taxonomies' =>array(),'rewrite'=>array('slug' => 'gallery', 'with_front' => false),'public'=>true,'has_archive' =>true,'query_var' =>true,'menu_icon'=>'dashicons-format-gallery')
);


//add_action( 'init', 'create_service_posttype' );

function create_service_posttype() {
    global $custom_posttypes;
    if (is_array($custom_posttypes)){
        foreach ($custom_posttypes as $value) {

            register_post_type($value['type'], array(
                'labels' => $value['labels'],
                'supports' => $value['supports'],
                'taxonomies' => $value['taxonomies'],
                'rewrite' => $value['rewrite'],
                'public' => $value['public'],
                'has_archive' => $value['has_archive'],
                'query_var' => $value['query_var'],
                'menu_icon'=>$value['menu_icon']
            ));
        }
    }


}

function cb_getTemplateId($a) {
    return $a['template_id'];
}
function cb_getType($a) {
    return $a['type'];
}
function cb_getTemplateIdFromType($type,$custom_posttypes){
    foreach ($custom_posttypes as $value) {
        if ($value['type']==$type) return $value['template_id'];
    }
    return 0;
}






class cbWalker_mobi extends Walker_Nav_Menu
{
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="mobi-menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class cbWalker extends Walker_Nav_Menu
{
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		if(trim($item->description)!='')$item_output .= '<span class="sub">' . $item->description . '</span>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}remove_filter( 'nav_menu_description', 'strip_tags' );
add_filter( 'wp_setup_nav_menu_item', 'cus_wp_setup_nav_menu_item' );
function cus_wp_setup_nav_menu_item( $menu_item ) {
     $menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
     return $menu_item;
}

function woocommerce_template_loop_product_thumbnail(){
global $post, $woocommerce, $product;
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );
			$i=1;
			
			if(get_option('cb5_clicka')=='yes') echo '<a href="'.get_permalink().'">';
			echo '<div class="image "><div class="product-mini-gallery">

			<img src="'.bfi_thumb($image_link, array('width' => '212','height'=>'281', 'crop' => true)).'"  width="212" height="281" alt="product"/>';
			if($attachment_count>0){foreach($product->get_gallery_attachment_ids() as $im_url){
			$image_extra=wp_get_attachment_url($im_url);
			if($image_extra!='')echo '<img src="'.bfi_thumb($image_extra, array('width' => '212','height'=>'281', 'crop' => true)).'" width="212" height="281" alt="product"/>';
			}
            }
			//echo '<img src="'.bfi_thumb(WP_THEME_URL.'/img/blank.jpg', array('width' => '212','height'=>'281', 'crop' => true)).'"  alt="product"/>';
			echo '</div></div>';
			if(get_option('cb5_clicka')=='yes') echo '</a>';

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

		}
 do_action( 'woocommerce_product_thumbnails' );
}
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}
// Register Custom Navigation Walker
require_once('inc/wp_bootstrap_navwalker.php');


class mobile_walker extends Walker_Nav_Menu{

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';


        $item_output .= '<option value="'.$item->url.'">'.apply_filters( 'the_title', $item->title, $item->ID ).'</option>';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}
function ShowLinkToProduct($post_id, $categories_as_array, $class,$con='') {
    // get post according post id
    $query_args = array( 'post__in' => array($post_id), 'posts_per_page' => 1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $categories_as_array
        )));
    $r_single = new WP_Query($query_args);
    if ($r_single->have_posts()) {
        $r_single->the_post();
        global $product;
        if($con!='') $class.=' noa';
        ?>
  <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="<?php echo $class;?>">
<?php if($con!='') echo '<span>'.$con.'</span>'; ?>  </a>

        <?php
        wp_reset_query();
    }
}



add_filter('body_class', 'remove_a_body_class', 20, 2);
function remove_a_body_class($wp_classes) {
	foreach($wp_classes as $key => $value) {
		if ($value == 'woocommerce') unset($wp_classes[$key]);
		if ($value == 'woocommerce-page') unset($wp_classes[$key]);
	}
	return $wp_classes;
}

add_action( 'init', 'create_brands' );
function create_brands() {
    register_post_type( 'cb_brands',
        array(
            'labels' => array(
                'name' => __( 'Brands','cb-modello' ),
                'singular_name' => __( 'Brand','cb-modello' ),
                'all_items' => __( 'All Brands','cb-modello' ),
		'add_new_item'       => __( 'Add New Brand' ,'cb-modello' ),
		'new_item'           => __( 'New Brand' ,'cb-modello' ),
		'edit_item'          => __( 'Edit Brand' ,'cb-modello' ),
		'view_item'          => __( 'View Brand', 'cb-modello' )

            ),
            'menu_position' => 56,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'brands'),
            'menu_icon'=>'dashicons-tag',
            'supports'=>array('title', 'excerpt', 'thumbnail')
        )
    );
}
function cb_brand_meta_box()
{


        add_meta_box(
            'cb_brand_new_meta_box',
            __('Product Brand', 'cb-modello'),
            'cb_brand_new_meta_box',
            'product','side','core'
        );

}
add_action('add_meta_boxes', 'cb_brand_meta_box');

function cb_brand_new_meta_box($post)
{
    wp_nonce_field('cb_brand_new_meta_box', 'cb_brand_new_meta_box_nonce');
$meta_box_value2 = get_post_meta($post->ID,'_cb5_brand',true);
$args = array(
    'post_type'=> 'cb_brands',
    'orderby'=>'title',
	'nopaging'=>'true',
    'order'=>'ASC');
$posts_array = get_posts( $args );

echo '<div class="sidebar_name" id="brand_name"><div class="framein round">
 <select name="_cb5_brand">';?>
<option value=""<?php if($meta_box_value2 == ''){ echo " selected";} ?>>-- select brand --</option><?php
if(is_array($posts_array) && !empty($posts_array)){

    foreach($posts_array as $brand){
        if($meta_box_value2 == $brand->ID){ echo "<option value='".$brand->ID."' selected>".$brand->post_name."</option>\n";
        } else { echo "<option value='".$brand->ID."'>".$brand->post_name."</option>\n";}
    }
} ?>
</select><br/></div></div><?php
}
function cb_brand_save($post_id)
{

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */


    // Check if our nonce is set.
    if (!isset($_POST['cb_brand_new_meta_box_nonce']))
        return $post_id;

    $nonce = $_POST['cb_brand_new_meta_box_nonce'];

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'cb_brand_new_meta_box'))
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    // Check the user's permissions.
    if ('page' == $_POST['post_type']) {

        if (!current_user_can('edit_page', $post_id))
            return $post_id;

    } else {

        if (!current_user_can('edit_post', $post_id))
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    $data = $_POST;
    $screen = get_current_screen();


    update_post_meta($post_id, '_cb5_brand', $data['_cb5_brand']);

}



add_action('save_post', 'cb_brand_save');



