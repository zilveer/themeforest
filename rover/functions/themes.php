<?php
/**
 * @package by Theme Record
 * @auther: MattMao
 *
 * 1--Load functions
 * 2--Add admin menu
 * 3--Add scripts and styles
 * 4--Add theme support
 * 5--Add languages support
 * 6--Add menu support
 * 7--Remove Auto <p> For Shortcodes
 * 8--Widgets Functions
 * 9--Add Category ID to Column
 * 10-Fixed WP Title
 * 11--Add functionality to the image uploader on product pages to exlcude an image
*/

#
#Load functions
#
require_once(FUNCTIONS_DIR.'/settings/generator.php');
require_once(FUNCTIONS_DIR.'/settings/functions.php');
require_once(FUNCTIONS_DIR.'/theme-config.php');
require_once(FUNCTIONS_DIR.'/plugins/breadcrumb.php');
require_once(FUNCTIONS_DIR.'/plugins/flickr.php');
require_once(FUNCTIONS_DIR.'/plugins/pagination.php');
require_once(FUNCTIONS_DIR.'/plugins/sidebar.php');
require_once(FUNCTIONS_DIR.'/plugins/slideshow.php');
require_once(FUNCTIONS_DIR.'/plugins/tweets.php');
require_once(FUNCTIONS_DIR.'/plugins/recaptchalib.php');
require_once(FUNCTIONS_DIR.'/shortcodes/shortcode-functions.php');
require_once(FUNCTIONS_DIR.'/shortcodes/tinymce/tinymce.class.php');
require_once(FUNCTIONS_DIR.'/widgets/widget-comments.php');
require_once(FUNCTIONS_DIR.'/widgets/widget-flickr.php');
require_once(FUNCTIONS_DIR.'/widgets/widget-portfolio.php');
require_once(FUNCTIONS_DIR.'/widgets/widget-post.php');
require_once(FUNCTIONS_DIR.'/widgets/widget-product.php');
require_once(FUNCTIONS_DIR.'/widgets/widget-search.php');
require_once(FUNCTIONS_DIR.'/widgets/widget-social.php');
require_once(FUNCTIONS_DIR.'/widgets/widget-tweets.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-generator.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-portfolio.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-portfolio-image.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-portfolio-video.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-blog.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-blog-audio.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-blog-image.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-blog-video.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-blog-link.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-blog-quote.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-page.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-product.php');
if (!class_exists('All_in_One_SEO_Pack') && !class_exists('WPSEO_Frontend')) {
	require_once(FUNCTIONS_DIR.'/metaboxes/metabox-seo.php');
}
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-gallery-image.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-sidebar.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-custom-sidebar.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-slideshow.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-slideshow-full.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-slideshow-text.php');
require_once(FUNCTIONS_DIR.'/metaboxes/metabox-slideshow-video.php');
require_once(FUNCTIONS_DIR.'/shop/cart.php');
require_once(FUNCTIONS_DIR.'/shop/thank-you.php');
require_once(FUNCTIONS_DIR.'/shop/orders/orders-class.php');
require_once(FUNCTIONS_DIR.'/shop/orders/orders.php');
require_once(FUNCTIONS_DIR.'/shop/orders/order-data.php');
require_once(FUNCTIONS_DIR.'/class-tgm-plugin-activation.php');
require_once(FUNCTIONS_DIR.'/theme-font.php');
require_once(FUNCTIONS_DIR.'/theme-helper.php');
require_once(FUNCTIONS_DIR.'/theme-taxonomy.php');
require_once(FUNCTIONS_DIR.'/theme-reorder.php');
require_once(FUNCTIONS_DIR.'/theme-install.php');



#
# Add menu scripts and styles to backend
#
if( is_admin() ){
	add_action('admin_init', 'theme_backend_load_styles');
	add_action('admin_init', 'theme_backend_load_scripts');
	add_action('admin_menu', 'theme_admin_menu', 9);
}


#
# Add admin menu
#
function theme_admin_menu()
{
	$add_menu = 'add_menu_page';
	$add_submenu = 'add_submenu_page';
	$add_menu(THEME_NAME, THEME_NAME, 'administrator', 'theme-settings', 'load_theme_pages', FUNCTIONS_URI . '/assets/images/icon-options.png', 58);
	$add_submenu('theme-settings', 'Theme Settings', __('Settings',  'TR'), 'administrator', 'theme-settings', 'load_theme_pages');
	$add_submenu('theme-settings', 'Colors Settings', __('Colors',  'TR'), 'administrator', 'theme-colors', 'load_theme_pages');
	$add_submenu('theme-settings', 'Fonts Settings', __('Fonts',  'TR'), 'administrator', 'theme-fonts', 'load_theme_pages');
	$add_submenu('theme-settings', 'Payment', __('Payment',  'TR'), 'administrator', 'theme-payment', 'load_theme_pages');
}


#
# Add styles to backend
#
function theme_backend_load_styles() {
	wp_enqueue_style('thickbox');
	wp_register_style('chosen', FUNCTIONS_URI.'/assets/css/chosen.css', false, THEME_VERSION, 'screen');
	wp_register_style('admin', FUNCTIONS_URI.'/assets/css/admin.css', false, THEME_VERSION, 'screen');
	wp_register_style('colorpicker', FUNCTIONS_URI.'/assets/css/colorpicker.css', false, THEME_VERSION, 'screen');
	wp_register_style('order', FUNCTIONS_URI.'/assets/css/order.css', false, THEME_VERSION, 'screen');
	wp_enqueue_style('chosen');
	wp_enqueue_style('admin');
	wp_enqueue_style('colorpicker');
	wp_enqueue_style('order');
}


#
# Add scripts to backend
#
function theme_backend_load_scripts() {
	wp_register_script('jquery-upload', FUNCTIONS_URI.'/assets/js/jquery-upload.js', array('jquery','media-upload','thickbox'), THEME_VERSION, false );
	wp_register_script('jquery-colorpicker', FUNCTIONS_URI.'/assets/js/jquery-colorpicker.js', array('jquery'), THEME_VERSION, false );
	wp_register_script('jquery-chosen', FUNCTIONS_URI.'/assets/js/jquery-chosen-min.js', array('jquery'), THEME_VERSION, false );
	wp_register_script('jquery-admin', FUNCTIONS_URI.'/assets/js/jquery-admin.js', array('jquery'), THEME_VERSION, false );
	wp_register_script('jquery-metabox', FUNCTIONS_URI.'/assets/js/jquery-metabox.js', array('jquery'), THEME_VERSION, false );
	wp_enqueue_script('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('jquery-colorpicker');
	wp_enqueue_script('jquery-chosen');
	wp_enqueue_script('jquery-admin');
	wp_enqueue_script('jquery-metabox');

	if ( isset($_GET['page']) ) $page = $_GET['page']; else $page = '';
	if ( is_admin() && ($page == 'theme-settings' || $page == 'theme-colors') ) 
	{
		wp_enqueue_script('jquery-upload');
	}
}


#
# Add theme support
#
if ( function_exists('add_theme_support') )
{
	#
	#Basic theme support
	#
	if ( ! isset( $content_width ) ) $content_width = 940;
	add_theme_support('menus');
	add_theme_support('post-thumbnails', array('post', 'portfolio', 'product', 'gallery', 'slideshow'));

	#
	#Creates wordpress image thumb sizes for the theme
	#
	function add_theme_thumbnail_size($thumb_size)
	{	
		foreach ($thumb_size['imgSize'] as $sizeName => $size)
		{
			if($sizeName == 'base')
			{
				set_post_thumbnail_size($thumb_size['imgSize'][$sizeName]['width'], $thumb_size[$sizeName]['height'], true);
			}
			else
			{	
				if(!isset($thumb_size['imgSize'][$sizeName]['crop'])) $thumb_size['imgSize'][$sizeName]['crop'] = true;

				add_image_size(	 
					$sizeName,
					$thumb_size['imgSize'][$sizeName]['width'], 
					$thumb_size['imgSize'][$sizeName]['height'], 
					$thumb_size['imgSize'][$sizeName]['crop']
				);
			}
		}
	}


	#
	# Set the thumbs size for the posts
	#
	$thumb_size['imgSize']['admin-thumbnail'] = array('width'=>45,  'height'=>45);
	$thumb_size['imgSize']['widget'] = array('width'=>45,  'height'=>45);
	$thumb_size['imgSize']['column-2'] = array('width'=>460,  'height'=>290);
	$thumb_size['imgSize']['column-3'] = array('width'=>300,  'height'=>190);
	$thumb_size['imgSize']['column-4'] = array('width'=>220,  'height'=>140);
	$thumb_size['imgSize']['portfolio'] = array('width'=>940,  'height'=>9999, 'crop'=>false);
	$thumb_size['imgSize']['blog'] = array('width'=>650,  'height'=>9999, 'crop'=>false);
	$thumb_size['imgSize']['product-column'] = array('width'=>220,  'height'=>200);
	$thumb_size['imgSize']['product'] = array('width'=>460,  'height'=>9999, 'crop'=>false);
	$thumb_size['imgSize']['gallery-column'] = array('width'=>220,  'height'=>220);
	$thumb_size['imgSize']['gallery'] = array('width'=>940,  'height'=>9999, 'crop'=>false);
	$thumb_size['imgSize']['widget-portfolio'] = array('width'=>250,  'height'=>160);

	add_theme_thumbnail_size($thumb_size);
}


#
# Add languages support
#
load_theme_textdomain( 'TR', LANG_DIR );


#
# Add menu support
#
register_nav_menus( array( 
	'top menu' => __( 'Top Navigation', 'TR' ),
	'bottom menu' => __( 'Bottom Navigation', 'TR' )
)); 


#
# Remove Auto <p> For Shortcodes
#
function theme_shortcode_text($content) 
{ 
	$content = do_shortcode( shortcode_unautop( $content ) ); 
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	return $content;
}


#
#Widgets Functions
#
function theme_remove_wp_widgets()
{
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_RSS');
}

add_action('widgets_init', 'theme_remove_wp_widgets');
add_filter('widget_text', 'do_shortcode');



#
# Add widgets support
#
if ( function_exists('register_sidebar') )
{
	$sidebars = array('page', 'blog', 'archive', 'contact', 'search');	
	foreach ($sidebars as $sidebar)
	{	
		register_sidebar( array (
			'name' => $sidebar.' sidebar',
			'id' => $sidebar.'-widget-area',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="title"><span>',
			'after_title' => '</span></h3>'
		));
	}

	#
	#Add footer sidebars
	#
	global $tr_config;
	$footer_columns = $tr_config['widgets_column'];
	for ($i = 1; $i <= $footer_columns; $i++)
	{
		register_sidebar(array(
			'name' => 'footer widget '.$i,
			'id' => 'footer-widget-area-'.$i,
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="title"><span>',
			'after_title' => '</span></h3>',
		));
	}


	#
	#Add custom sidebarss
	#
	$sidebar_args = array( 
		'post_type' => 'sidebar',
		'posts_per_page' => -1,
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'post_status' => 'publish'
	);

	$sidebars = get_posts( $sidebar_args );

	if($sidebars)
	{
		foreach ($sidebars as $sidebar) 
		{
			global $post;
			$id = $sidebar->ID;
			$name = get_meta_option('sidebar_name', $id);

			register_sidebar( array (
				'name' => $name,
				'id' => 'custom-widget-area-'.$id,
				'before_widget' => '<div class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="title"><span>',
				'after_title' => '</span></h3>'
			));
		}
	}
}



#
#Add Category ID to Column
#
add_filter( 'manage_edit-category_columns', 'theme_taxonomy_columns_header' );
add_filter( 'manage_edit-portfolio-category_columns', 'theme_taxonomy_columns_header' );
add_filter( 'manage_edit-product-category_columns', 'theme_taxonomy_columns_header' );
add_filter( 'manage_category_custom_column', 'theme_taxonomy_columns_row', 10, 3 );
add_filter( 'manage_portfolio-category_custom_column', 'theme_taxonomy_columns_row', 10, 3 );
add_filter( 'manage_product-category_custom_column', 'theme_taxonomy_columns_row', 10, 3 );

function theme_taxonomy_columns_header($columns) {
    $columns['catID'] = __('ID');
    return $columns;
}


function theme_taxonomy_columns_row($columnTitle, $argument, $categoryID){
    return $categoryID;
}



#
#Add functionality to the image uploader on product pages to exlcude an image
#
add_filter('attachment_fields_to_edit', 'theme_exclude_image_from_page_field', 1, 2);
add_filter('attachment_fields_to_save', 'theme_exclude_image_from_page_field_save', 1, 2);

function theme_exclude_image_from_page_field( $fields, $object ) {
	
	if (!$object->post_parent) return $fields;
	
	$parent = get_post( $object->post_parent );
	
	$exclude_image = (int) get_post_meta($object->ID, '_post_theme_exclude_image', true);
	
	$label = __('Exclude image',  'TR');
	
	$html = '<input type="checkbox" '.checked($exclude_image, 1, false).' name="attachments['.$object->ID.'][post_theme_exclude_image]" id="attachments['.$object->ID.'][post_theme_exclude_image]" />';
	
	$fields['post_theme_exclude_image'] = array(
			'label' => $label,
			'input' => 'html',
			'html' =>  $html,
			'value' => '',
			'helps' => __('Enabling this option will hide it from the page image gallery or slidershow.',  'TR')
	);
	
	return $fields;
}

function theme_exclude_image_from_page_field_save( $post, $attachment ) {

	if (isset($_REQUEST['attachments'][$post['ID']]['post_theme_exclude_image'])) :
		delete_post_meta( (int) $post['ID'], '_post_theme_exclude_image' );
		update_post_meta( (int) $post['ID'], '_post_theme_exclude_image', 1);
	else :
		delete_post_meta( (int) $post['ID'], '_post_theme_exclude_image' );
		update_post_meta( (int) $post['ID'], '_post_theme_exclude_image', 0);
	endif;
		
	return $post;				
}



#
# Allow plugins/themes to override the default caption template.
#
function theme_img_caption_shortcode($attr, $content = null) {
	// New-style shortcode with the caption inside the shortcode with the link and image tags.
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">'. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

add_shortcode('wp_caption', 'theme_img_caption_shortcode');
add_shortcode('caption', 'theme_img_caption_shortcode');



#
#Remove the gallery
#

if( !function_exists( 'remove_gallery_setting_div' ) ) {
    function remove_gallery_setting_div() {
        echo '
            <style type="text/css">
                #gallery-settings *{
                display:none;
                }
            </style>';
    }
}

add_action( 'admin_head_media_upload_gallery_form', 'remove_gallery_setting_div' );




/********************************************
  Auto plugin activation
********************************************/
add_action('tgmpa_register', 'theme_register_required_plugins');

function theme_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> FUNCTIONS_DIR . '/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.0.41', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'mm_lang',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'mm_lang' ),
			'menu_title'                       			=> __( 'Install Plugins', 'mm_lang' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'mm_lang' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'mm_lang' ),
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
			'return'                           			=> __( 'Return to Required Plugins Installer', 'mm_lang' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'mm_lang' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'mm_lang' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa($plugins, $config);
}
?>