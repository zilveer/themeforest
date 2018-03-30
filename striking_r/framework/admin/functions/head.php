<?php

add_action('admin_head', 'theme_add_head');
/**
 * Change the icon on every page where theme use.
 */
function theme_add_head() {
	?>
<?php if($custom_favicon = theme_get_option('general','custom_favicon')) { ?>
<link rel="shortcut icon" href="<?php echo theme_get_image_src($custom_favicon); ?>" />
<?php } ?>
<style>
	<?php if (theme_is_post_type('portfolio')) : ?>
	#icon-edit { background:transparent url('<?php echo THEME_ADMIN_ASSETS_URI .'/images/portfolio_icon32.png';?>') no-repeat; }
	<?php endif; ?>
	<?php if (theme_is_post_type('slideshow')) : ?>
	#icon-edit { background:transparent url('<?php echo THEME_ADMIN_ASSETS_URI .'/images/slideshow_icon32.png';?>') no-repeat; }
	<?php endif; ?>
</style>
<script>
var theme_admin_assets_uri="<?php echo THEME_ADMIN_ASSETS_URI;?>";
</script>
	<?php
}

add_action('admin_init', 'theme_admin_register_script');
function theme_admin_register_script(){
	wp_register_script('jquery-switcher',THEME_ADMIN_ASSETS_URI . '/js/jquery.switcher.js',array('jquery'));

	wp_register_script('jquery-outside-events',THEME_ADMIN_ASSETS_URI . '/js/jquery.ba-outside-events.min.js',array('jquery'),'1.1');
	wp_register_script('jquery-colorinput',THEME_ADMIN_ASSETS_URI . '/js/jquery.colorInput.js',array('jquery'));
	wp_register_script('jquery-select2',THEME_ADMIN_ASSETS_URI . '/js/select2.min.js',array('jquery'),'3.4.1');

	wp_register_script('jquery-choice',THEME_ADMIN_ASSETS_URI . '/js/jquery.choice.js',array('jquery'));
	wp_register_script('jquery-tools-validator',THEME_ADMIN_ASSETS_URI . '/js/validator.js',array('jquery'),'1.2.5');
	wp_register_script('jquery-download',THEME_ADMIN_ASSETS_URI . '/js/jquery.download.js',array('jquery'));
	wp_register_script('jquery-ui-slider',THEME_ADMIN_ASSETS_URI . '/js/jquery.ui.slider.min.js',array('jquery-ui-core'),'1.10');
	wp_register_script('theme-base', THEME_ADMIN_ASSETS_URI . '/js/theme.js',array('jquery','jquery-outside-events','jquery-colorinput','jquery-switcher','jquery-choice','jquery-tools-validator','jquery-ui-slider','jquery-select2','jquery-ui-sortable'));
	wp_register_script('theme-init', THEME_ADMIN_ASSETS_URI . '/js/script.js',array('jquery','theme-base'));
}

if(theme_is_options() || theme_is_post_type()){
	add_action('admin_init', 'theme_admin_add_script');
}
function theme_admin_add_script() {
	wp_enqueue_script('theme-init');
	
	add_thickbox();
	
	global $wp_version;
	if(theme_is_options() && version_compare($wp_version, "3.5", '>=')){
		wp_enqueue_media();
	}
}
if(theme_is_nav_menu()){
	add_action('admin_init', 'theme_admin_nav_menu_add_script_style');
}

function theme_admin_nav_menu_add_script_style() {
	theme_enqueue_icon_set();
	wp_enqueue_script('theme-nav-menu',THEME_ADMIN_ASSETS_URI . '/js/nav-menu.js',array('jquery'));

	add_thickbox();
	
	global $wp_version;
	if(theme_is_options() && version_compare($wp_version, "3.5", '>=')){
		wp_enqueue_media();
	}
}

if(is_admin()){
	add_action('admin_init', 'theme_admin_add_style');
}
function theme_admin_add_style() {
	if(is_rtl()){
		wp_enqueue_style('theme-admin-style', THEME_ADMIN_ASSETS_URI . '/css/style-rtl.css');
	} else {
		wp_enqueue_style('theme-admin-style', THEME_ADMIN_ASSETS_URI . '/css/style.css');
	}
	
}
global $wp_version;
if(version_compare($wp_version, "3.3-beta1", '<')){
	if(theme_is_options() && $_GET['page']=='theme_homepage'){
		add_filter('admin_head','theme_admin_tinymce');
		add_filter('admin_head','theme_homepage_option_add_script');
	}
}
function theme_homepage_option_add_script(){
	wp_print_scripts('theme-shortcode');
}
function theme_admin_tinymce() {
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	wp_editor();
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}

add_action( 'admin_enqueue_scripts', 'theme_fix_the_events_calendar_issue', 1);
function theme_fix_the_events_calendar_issue(){
	global $current_screen; 
	if ( isset($current_screen->post_type) && $current_screen->post_type === 'tribe_events'){
		wp_dequeue_script('jquery-select2');
	}
}