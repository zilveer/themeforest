<?php
/**
 * This file contain some general functions:
 * -enqueuing CSS and JS files
 * -inserting the JavaScript init code into the head
 * -set the default thumbnail size
 * -print pagination function
 * -register navigation menus function
 *
 */


/**
 * ADD THE ACTIONS
 */
add_action('admin_enqueue_scripts', 'designare_admin_init');
add_action('admin_head', 'designare_admin_head_add');
add_action('init', 'register_designare_menus' );
add_action('admin_menu', 'designare_add_theme_menu');
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

add_theme_support('menus');
add_theme_support('automatic-feed-links');


/**
 * Enqueues the JavaScript files needed depending on the current section.
 */
function designare_admin_init(){
	global $current_screen, $designare_data;
	
	wp_enqueue_media();
	wp_enqueue_script( 'gallery' );
	wp_enqueue_script('jquery');

	if($current_screen->base=='post'){
		//enqueue the script and CSS files for the TinyMCE editor formatting buttons
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('designare-page-options',DESIGNARE_SCRIPT_URL.'page-options.js');
		wp_enqueue_script('designare-colorpicker',DESIGNARE_SCRIPT_URL.'colorpicker.js');

		//set the style files
		add_editor_style('lib/formatting-buttons/custom-editor-style.css');
		wp_enqueue_style('designare-page-style',DESIGNARE_CSS_URL.'page_style.css');
		wp_enqueue_style('designare-colorpicker-style',DESIGNARE_CSS_URL.'colorpicker.css');
		wp_enqueue_script('designare-ajaxupload',DESIGNARE_SCRIPT_URL.'ajaxupload.js');
		wp_enqueue_script('designare-options',DESIGNARE_SCRIPT_URL.'options.js');
		wp_enqueue_script('designare-options-des',DESIGNARE_SCRIPT_URL.'options_designare.js');
	}

	if(isset($_GET['page']) && $_GET['page']==DESIGNARE_OPTIONS_PAGE){
		//enqueue the scripts for the Options page
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('designare-jquery-co',DESIGNARE_SCRIPT_URL.'jquery-co.js');
		wp_enqueue_script('designare-ajaxupload',DESIGNARE_SCRIPT_URL.'ajaxupload.js');
		wp_enqueue_script('designare-colorpicker',DESIGNARE_SCRIPT_URL.'colorpicker.js');
		wp_enqueue_script('designare-options',DESIGNARE_SCRIPT_URL.'options.js');
		wp_enqueue_script('designare-options-des',DESIGNARE_SCRIPT_URL.'options_designare.js');
		wp_enqueue_script('designare-jquery-ui',DESIGNARE_SCRIPT_URL.'jquery-ui-1.8.17.custom.min.js');

		//enqueue the styles for the Options page
		wp_enqueue_style('designare-admin-style',DESIGNARE_CSS_URL.'admin_style.css');
		wp_enqueue_style('designare-colorpicker-style',DESIGNARE_CSS_URL.'colorpicker.css');
		wp_enqueue_style('designare-jqueryui-style',DESIGNARE_CSS_URL.'cupertino/jquery-ui-1.8.17.custom.css');
		
	}

	if($current_screen->id==DESIGNARE_PORTFOLIO_POST_TYPE){
		//enqueue the scripts needed for the add/edit portfolio post
		wp_enqueue_script('jquery');
		wp_enqueue_script('designare-ajaxupload',DESIGNARE_SCRIPT_URL.'ajaxupload.js');
		wp_enqueue_script('designare-options',DESIGNARE_SCRIPT_URL.'options.js');
		wp_enqueue_media();
		wp_enqueue_script( 'custom-header' );
	}

	if($current_screen->id=='page'){
		//enqueue the scripts needed for the add/edit page page
		wp_enqueue_script('jquery');
		wp_enqueue_script('designare-options',DESIGNARE_SCRIPT_URL.'page-options.js');
		wp_enqueue_script('designare-options2',DESIGNARE_SCRIPT_URL.'options.js');
		wp_enqueue_script('designare-ajaxupload',DESIGNARE_SCRIPT_URL.'ajaxupload.js');
	}

	if(isset($_GET['page']) && (in_array($_GET['page'], $designare_data->custom_posttypes) || $_GET['page']==DESIGNARE_PORTFOLIO_POST_TYPE)){
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('designare-ajaxupload',DESIGNARE_SCRIPT_URL.'ajaxupload.js');
		wp_enqueue_script('designare-options',DESIGNARE_SCRIPT_URL.'options.js');
		wp_enqueue_script('designare-custom-page',DESIGNARE_SCRIPT_URL.'custom-page.js');
		//enqueue the styles for the Options page
		wp_enqueue_style('designare-admin-style',DESIGNARE_CSS_URL.'custom_page.css');
		wp_enqueue_style('jquery-ui-dialog');
	}

}

global $pagenow;
if (is_admin() && isset($_GET['activated']) && $pagenow == "themes.php" ) {
    //Do redirect
    header( 'Location: '.admin_url().'admin.php?page='.DESIGNARE_OPTIONS_PAGE.'&activated=true' ) ;
}


/**
 * Inserts scripts for initializing the JavaScript functionality for the relevant section.
 */
function designare_admin_head_add(){

	if(isset($_GET['page']) && $_GET['page']==DESIGNARE_OPTIONS_PAGE){
		//init the options js functionality
		echo '<script>jQuery(document).ready(function($) {
				
				$(".slider").each(function(){
					
					var value = parseInt($(this).siblings(".slider-input").val());
					$(this).empty().slider({
						range: "min",
						value: value,
						min: 0,
						max: 100,
						slide: function( event, ui ) {
							$( "#"+$(this).attr("title") ).val( ui.value + " px" );
						}
					});
				
				});
				
				designareOptions.init({cookie:true});
		});</script>
		<!--[if IE 9]>
		<style type="text/css">
		.tab_navigation ul li.ui-tabs-selected a.tab span, .tab_navigation ul li.ui-tabs-selected a.tab span{
		top:-1px;
		position:relative;
		}
		
		.tab_navigation ul li.ui-tabs-selected a.tab{
		position:relative;
		top:1px;
		}
		</style>
		<![endif]-->
				
				';
	}
}

/**
 * Add the main setting menu for the theme.
 */
function designare_add_theme_menu(){
	add_theme_page( DESIGNARE_THEMENAME, DESIGNARE_THEMENAME." Options", 'delete_pages', DESIGNARE_OPTIONS_PAGE, 'designare_theme_admin', DESIGNARE_LIB_URL.'/images/designare.png');
}

/* ------------------------------------------------------------------------*
 * LOCALE AND TRANSLATION
 * ------------------------------------------------------------------------*/

load_theme_textdomain( 'designare', get_template_directory() . '/lang' );

/**
 * Returns a text depending on the settings set. By default the theme gets uses
 * the texts set in the Translation section of the Options page. If multiple languages enabled,
 * the default language texts are used from the Translation section and the additional language
 * texts are used from the added .mo files within the lang folder.
 * @param $textid the ID of the text
 */
function des_text($textid){

	$locale=get_locale();
	$int_enabled=get_option(DESIGNARE_SHORTNAME.'_enable_translation')=='on'?true:false;
	$default_locale=get_option(DESIGNARE_SHORTNAME.'_def_locale');

	if($int_enabled && $locale!=$default_locale){
		//use translation - extract the text from a defined .mo file
		return $textid;
	}else{
		//use the default text settings
		return stripslashes(get_option(DESIGNARE_SHORTNAME.$textid));
	}
}


/* ------------------------------------------------------------------------*
 * SET THE THUMBNAILS
 * ------------------------------------------------------------------------*/


if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
	add_image_size('post_box_img', 550, 250, true);
	add_image_size('static-header-img', 950, 350, true);
}


/**
 * Prints the pagination. Checks whether the WP-Pagenavi plugin is installed and if so, calls
 * the function for pagination of this plugin. If not- shows prints the previous and next post links.
 */
function print_pagination(){
	if(function_exists('wp_pagenavi')){
	 wp_pagenavi();
	}else{?>
<div id="blog_nav_buttons" class="navigation">
<div class="alignleft"><?php if (!function_exists('icl_object_id')) previous_posts_link('<span>&laquo;</span> '.des_text('_previous_text')); else previous_posts_link('<span>&laquo;</span> '.__('Older Entries','smartbox')); ?></div>
<div class="alignright"><?php if (!function_exists('icl_object_id')) next_posts_link(des_text('_next_text').' <span>&raquo;</span>'); else next_posts_link(__('Newer Entries','smartbox').' <span>&raquo;</span>'); ?></div>
</div>
	<?php
	}
}


/**
 * Register the main menu for the theme.
 */
function register_designare_menus() {
	register_nav_menu('primary-navigation', 'Main Navigation');
	register_nav_menu('footer-navigation', 'Footer Navigation');
	register_nav_menu('woonav', 'WooCommerce Menu');
	register_nav_menu('topbarnav', 'Top Bar Navigation');
}

function special_nav_class($classes, $item){
    $classes[] = $item->object . "-" . $item->object_id;
    return $classes;
}

/**
 * Removes an item from an array by specifying its value
 * @param $array the array from witch to remove the item
 * @param $val the value to be removed
 * @return returns the initial array without the removed item
 */
function designare_remove_item_by_value($array, $val = '') {
	if (empty($array) || !is_array($array)) return false;
	if (!in_array($val, $array)) return $array;

	foreach($array as $key => $value) {
		if ($value == $val) unset($array[$key]);
	}

	return array_values($array);
}

