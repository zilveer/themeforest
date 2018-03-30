<?php
/*-------------------------------------------------------------------------*/
/*	Do not modify this file - The sky will fall.
/*-------------------------------------------------------------------------*/ 

// Define File Directores.
if ( function_exists( 'wp_get_theme' ) ) :
	$theme_object 	= wp_get_theme(); // WordPress 3.4.0 plus.
	$theme_name 	= $theme_object->name;
else:
	$theme_data 	= get_theme_data( get_template_directory() . '/style.css' ); // Before WordPress 3.4.0 deprecated function.
	$theme_name 	= $theme_data['Name'];
endif;

// Define Theme Constants.
define( 'TT_FUNCTIONS', 				get_template_directory() . '/framework' );
define( 'TT_GLOBAL', 					get_template_directory() . '/framework/global' );
define( 'TT_ADMIN', 					get_template_directory() . '/framework/admin' );
define( 'TT_EXTENDED', 					get_template_directory() . '/framework/extended' );
define( 'TT_CONTENT', 					get_template_directory() . '/framework/content' );
define( 'TT_JS', 						get_template_directory_uri() . '/framework/js' );
define( 'TT_FRAMEWORK', 				get_template_directory_uri() . '/framework' );
define( 'TT_CSS', 						get_template_directory_uri() . '/css/' );
define( 'TT_HOME', 						get_template_directory_uri() );
define( 'TT', 							get_template_directory() . '/framework/truethemes' );
define( 'TIMTHUMB_SCRIPT',				get_template_directory_uri() . '/framework/extended/timthumb/timthumb.php' );
define( 'TIMTHUMB_SCRIPT_MULTISITE', 	get_template_directory_uri() . '/framework/extended/timthumb/timthumb.php' );

// Load Theme Specific Functions.
require_once( get_template_directory() . '/framework/theme-specific/_theme_specific_init.php' );

// Load Global Functions.
require_once( TT_GLOBAL . '/widgets.php' );
require_once( TT_GLOBAL . '/theme-functions.php' );

// Load TrueThemes Functions.
//require_once( TT . '/upgrade/init.php' );
require_once( TT . '/image-thumbs.php' );
require_once( TT . '/metabox/init.php' );

// Load Admin Framework.
require_once( TT_ADMIN . '/admin-functions.php' );
require_once( TT_ADMIN . '/admin-interface.php' );

// Load Extended Functionality.
require_once( TT_EXTENDED . '/multiple_sidebars.php' );
require_once( TT_EXTENDED . '/breadcrumbs.php' );
require_once( TT_EXTENDED . '/3d-tag-cloud/wp-cumulus.php' );
require_once( TT_EXTENDED . '/twitter/latest-tweets.php' );
require_once( TT_EXTENDED . '/page_linking.php' );
require_once( TT_EXTENDED . '/tgm-plugin-activation/class-tgm-plugin-activation.php');

if ( ! function_exists( 'wp_pagenavi' ) ){
	require_once( TT_EXTENDED . '/wp-pagenavi.php' );
}


if(class_exists('Jetpack')){
//We found Jetpack

	
//get jetpack activated modules.
$jetpack_activated_modules = get_option('jetpack_active_modules');
//check if jetpack contact form is deactivated, we load our theme contact form.
if(!in_array('contact-form',$jetpack_activated_modules)){
	
	//check if publicize and share module is activated, if yes, we disable it too, so that our contact form shortcode works!
	$arr = array_diff($jetpack_activated_modules, array("publicize","sharedaddy"));
  	
  	//We update back modified jetpack activated modules.
  	update_option('jetpack_active_modules',$arr);  

	//check if user enables our theme contact form plugin, if yes, we use it.
	$tt_formbuilder = get_option( 'st_formbuilder' );
	
	   //checks for grunion contact form plugin
		if(!function_exists('contact_form_parse')){
			if ( 'true' == $tt_formbuilder ){require_once( TT_EXTENDED . '/grunion-contact-form/grunion-contact-form.php' );}
		}
}

}else{
//no Jetpack, we do normal check

	//check if user enables our theme contact form plugin, if yes, we use it.
	$tt_formbuilder = get_option( 'st_formbuilder' );
	   //checks for grunion contact form plugin
		if(!function_exists('contact_form_parse')){
			if ( 'true' == $tt_formbuilder ){require_once( TT_EXTENDED . '/grunion-contact-form/grunion-contact-form.php' );}
		}

}


if ( class_exists( 'woocommerce' ) )
	require_once( TT_EXTENDED . '/woocommerce.php' );	

// Load SEO Module.
global $ttso;
$seo_module = $ttso->st_seo_module;

// Check user setting at site options general settings.
if ( 'true' == $seo_module ) {
	// Require all seo module files and "activate" seo module.
	require_once( TT_EXTENDED. '/seo-module/seo_module.php' );
	$aioseop_options = get_option( 'aioseop_options' );
	
	if ( 0 == $aioseop_options['aiosp_enabled'] ) {
		$aioseop_options['aiosp_enabled'] = 1;
		update_option( 'aioseop_options', $aioseop_options );
	}
} else {
    // User has "disabled" the seo module, but still show the empty page with a message.
	$aioseop_options = get_option( 'aioseop_options' );
	$aioseop_options['aiosp_enabled'] = 0;
	update_option( 'aioseop_options', $aioseop_options );
    add_action( 'admin_menu', 'truethemes_add_empty_seo_settings_page' );
}

/**
 * Do not move this function! Loads the empty seo settings page.
 */
function truethemes_add_empty_seo_settings_page() {
	add_theme_page( __( 'SEO Settings', 'tt_theme_framework' ), __( 'SEO Settings', 'tt_theme_framework' ), 'manage_options', 'seo_settings', 'truethemes_empty_seo_settings_page' );
}

/**
 * Do not move this function! Displays the empty seo settings page.
 */
function truethemes_empty_seo_settings_page() {

	?>
	<div class="wrap">
		<div style="padding:8px 10px 15px 15px;">	
			<?php screen_icon( 'options-general' ); ?>
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		</div>
		<div id="message" class="updated fade" style="width:765px!important;margin:10px 0px 0px 0px;">
			<p><?php printf( __( 'The SEO Module is currently disabled. To enable this Module, please go to <a href="%s">Appearance &gt; Site Options &gt; General Settings</a>.', 'tt_theme_framework' ), esc_url(add_query_arg( array( 'page' => 'siteoptions' ), admin_url( 'admin.php' ) ) ) ); ?></p>
		</div>
	<?php
	
}



/*------------------------------------*/
/* Register Custom Taxonomies
/*------------------------------------*/
//Slider Taxonomy
function truethemes_sterling_slider_taxonomy() {
	register_taxonomy(
		'sterling-slider-category',
		'slider',
		array(
			'label'        => __('Categories' , 'tt_theme_framework'),
			'sort'         => true,
			'hierarchical' => true,
			'args'         => array( 'orderby' => 'term_order' ),
			'rewrite'      => array( 'slug'    => 'sterling-slider-category' )
		)
	);
}
add_action( 'init', 'truethemes_sterling_slider_taxonomy' );




/*------------------------------------*/
/* Sticky Menu
/*------------------------------------*/
/*
* function to hook jQuery to footer to activate sticky menu according to site option setting.
*/
function tt_hook_sticky_menu(){
	$activate_sticky_menu = get_option('st_fix_header_and_menubar');
	if($activate_sticky_menu == 'true'){
	wp_enqueue_script( 'scrollwatch', TT_JS .'/scrollWatch.js', array('jquery'),'4.0',$in_footer = true);
	echo "<!--Site Option Activated Sticky Menu-->\n<script type='text/javascript'>jQuery(document).ready(function(){truethemes_StickyMenu();});</script>\n<!--End Sticky Menu Activation-->\n";
	}
}
add_action('wp_footer','tt_hook_sticky_menu');

function tt_hook_sticky_mobile_menu(){
$activate_sticky_mobile_menu = get_option('st_fix_mobile_menu');
if($activate_sticky_mobile_menu == 'true'):
?>
<style type='text/css'>
/**sticky mobile menu**/
@media screen and (max-width: 480px){
#tt-header-wrap {
	box-shadow: 0 3px 9px 0 rgba(0, 0, 0, 0.1), 0 1px 3px 0 rgba(0, 0, 0, 0.2);
	position: fixed;
	width: 100%;
	z-index:9999;
}
.banner-slider {
	padding-top: 233px;	
}

.small_banner {
	padding-top: 223px !important;	
}
}
</style>
<?php
endif;
}
add_action('wp_head','tt_hook_sticky_mobile_menu');



/*------------------------------------*/
/*	CSS for Custom Post Type Icons
/*------------------------------------*/
function truethemes_custom_admin_css(){
	echo '<style>

#adminmenu #menu-posts-slider .menu-icon-post div.wp-menu-image:before {
	content: "\f169";
	/* content: "\f181"; */
}

#adminmenu #menu-posts-gallery .menu-icon-post div.wp-menu-image:before {
	content: "\f233";
}

#adminmenu #menu-posts-feedback .menu-icon-post div.wp-menu-image:before {
	content: "\f175";
}

.wp-media-buttons .tt-add-form span.wp-media-buttons-icon:before {
	font: 400 17px/1 dashicons;
	content: "\f175";
	margin-left:-1px;
}
	/* Social Media Widget select field */
	.wp-admin #tt-social-widget-dropdown {
	width:95% !important;	
}

/* hide revolution slider notice */
.rs-update-notice-wrap {
	display: none;
}
	</style>';        
}
add_action('admin_head','truethemes_custom_admin_css');





/*----------------------------------------------------------------*/
/* Remove old Page Templates
/*----------------------------------------------------------------*/
//@since 2.5 - "Activate Sterling 2.2" removed from site options panel
function tt_remove_old_page_templates(){
	wp_register_script( 'remove_page_template_select_option', TT_JS .'/admin-remove-page-template-select-option.js', array('jquery'),'1.0');
	wp_enqueue_script( 'remove_page_template_select_option');
}
add_action( 'admin_enqueue_scripts', 'tt_remove_old_page_templates' );


/*-----------------------------------------------------------------------------------*/
/* TGM Plugin Activation (LayerSlider, etc)
/*-----------------------------------------------------------------------------------*/
add_action( 'tgmpa_register', 'truethemes_register_required_plugins' );

function truethemes_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Include Premium Plugins:
		array(
			'name'     				=> 'LayerSlider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> 'http://s3.truethemes.net.s3.amazonaws.com/theme-included-plugins/layersliderwp.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> 'http://s3.truethemes.net.s3.amazonaws.com/theme-included-plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// Include Plugins from the WordPress Plugin Repository:
		array(
			'name' 		=> 'CU3ER 3D Slider',
			'slug' 		=> 'wpcu3er',
			'required' 	=> false,
		),
		
		array(
			'name' 		=> 'MailChimp List Subscribe Form',
			'slug' 		=> 'mailchimp',
			'required' 	=> false,
		),
		
		array(
			'name' 		=> 'Post Type Order',
			'slug' 		=> 'post-types-order',
			'required' 	=> false,
		),
		
		array(
			'name' 		=> 'WooCommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> false,
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'tt_theme_framework';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,      // Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                      // Default absolute path to pre-packaged plugins
		'menu'              => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'       => true,                    // Show admin notices or not.
        'dismissable'       => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'       => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic'      => true,                   // Automatically activate plugins after installation or not.
		'message' 			=> '<br /><h3>Frequently Asked Questions:</h3><ol style="padding:10px 0;"><li style="padding-bottom:12px;"><strong>How do I install the plugins listed below?</strong><br />Simply hover over each plugin that you\'d like to install and click <em>Install</em>. <a href="http://vimeopro.com/truethemes/sterling-wordpress-theme" target="_blank">Detailed video instructions outlined here.</a></li><li><strong>I\'m receiving an Error when trying to install the LayerSlider or Slider Revolution Plugins?</strong><br />These premium plugins are hosted on our Secure Amazon S3 server. Certain web servers do not allow for direct installation of files from an outside server, resulting in the error. A workaround for this is to use the "Bulk Actions" dropdown below. Simply check the boxes next to all plugins, choose "Install" from the Bulk Actions dropdown and click "Apply".</li></ol><br />',							// Message to output right before the plugins table
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
	
	if(current_user_can('administrator')){ //do this only for admin and not subscribers
		tgmpa( $plugins, $config );
	}
}
?>