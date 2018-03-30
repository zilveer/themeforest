<?php
/**
 * Setup metaboxes settings
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Setup
 * @subpackage Setting
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add Title and Breadcrumb settings of Content metabox (page type) for post editing screen.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_metabox_page_content_args', 'prima_metabox_page_content_args_title' );
function prima_metabox_page_content_args_title( $meta ) {
	$meta[] = array ( 
		"name" => __("Hide Breadcrumb", 'primathemes'),
		"id" => "_page_breadcrumb_hide",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will hide breadcrumb on this page.", 'primathemes'),
		);
	$meta[] = array ( 
		"name" => __("Hide Page Title", 'primathemes'),
		"id" => "_page_title_hide",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will hide page title on this page. NOTE: Some page template is designed with no page title", 'primathemes'),
		);
	return $meta;
}

/**
 * Add Title settings of Content metabox for product category editing screen.
 *
 * @since PrimaShop 1.3
 */
add_filter( 'prima_metabox_product_cat_content_args', 'prima_metabox_product_cat_content_args_title' );
function prima_metabox_product_cat_content_args_title( $meta ) {
	$meta[] = array ( 
		"name" => __("Hide Category Title", 'primathemes'),
		"id" => "_cat_title_hide",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will hide category title on this product category archive page", 'primathemes'),
		);
	return $meta;
}

/**
 * Add Featured Header settings of Header metabox for post editing screen.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_metabox_post_header_args', 'prima_metabox_types_header_args_featured' );
add_filter( 'prima_metabox_page_header_args', 'prima_metabox_types_header_args_featured' );
add_filter( 'prima_metabox_product_header_args', 'prima_metabox_types_header_args_featured' );
add_filter( 'prima_metabox_category_header_args', 'prima_metabox_types_header_args_featured' );
add_filter( 'prima_metabox_post_tag_header_args', 'prima_metabox_types_header_args_featured' );
function prima_metabox_types_header_args_featured( $meta ) {
	$meta['header_featured'] = array ( 
		"name" => __("Featured Header Type", 'primathemes'),
		"id" => "_prima_header_featured",
		"type" => "select",
		"default" => "image",
		"options" => array ( 
			'image' => __('Image', 'primathemes'),
			'slider' => __('Slider', 'primathemes'),
			'custom' => __('Custom', 'primathemes'),
			'disable' => __('Disable', 'primathemes'),
			),
		);
	$meta['header_nopadding'] = array ( 
		"name" => __("Remove Header Padding", 'primathemes'),
		"id" => "_prima_header_nopadding",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will remove padding (top,left,bottom,right space) on the featured header", 'primathemes'),
		);
	$meta['header_custom'] = array ( 
		"name" => __("Custom Header", 'primathemes'),
		"id" => "_prima_header_custom",
		"type" => "wysiwyg",
		"desc" => __("You can add any content (HTML, shortcodes) for your custom header.", 'primathemes'),
		"class" => "meta_header_featured meta_header_custom",
		);
	$meta['header_fullscreen'] = array ( 
		"name" => __("Full Screen Mode", 'primathemes'),
		"id" => "_prima_header_fullscreen",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will enable full screen mode.", 'primathemes'),
		"class" => "meta_header_featured meta_header_custom meta_header_image meta_header_slider",
		);
	$meta['header_slider_animation'] = array ( 
		"name" => __("Slider Animation Type", 'primathemes'),
		"id" => "_prima_header_slider_animation",
		"type" => "select",
		"default" => "slide",
		"options" => array ( 
			'slide' => __('Slide', 'primathemes'),
			'slide_reverse' => __('Slide (Reverse)', 'primathemes'),
			'fade' => __('Fade', 'primathemes'),
			),
		"class" => "meta_header_featured meta_header_slider",
		);
	$meta['header_slider_controlnav'] = array ( 
		"name" => __("Remove Slider Control Navigation", 'primathemes'),
		"id" => "_prima_header_slider_controlnav",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will remove slider control navigation (square bullets)", 'primathemes'),
		"class" => "meta_header_featured meta_header_slider",
		);
	$meta['header_slider_directionnav'] = array ( 
		"name" => __("Remove Slider Direction Navigation", 'primathemes'),
		"id" => "_prima_header_slider_directionnav",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will remove slider direction control (left/right arrows)", 'primathemes'),
		"class" => "meta_header_featured meta_header_slider",
		);
	$meta["header_slider_slideshowspeed"] = array ( 
		"name" => __("Slider Slideshow Speed", 'primathemes'),
		"id" => "_prima_header_slider_slideshowspeed",
		"type" => "text",
		"desc" =>  __("Set the speed of the slideshow cycling, in milliseconds", 'primathemes'),
		"class" => "meta_header_featured meta_header_slider",
		);
	$meta["header_slider_animationspeed"] = array ( 
		"name" => __("Slider Animation Speed", 'primathemes'),
		"id" => "_prima_header_slider_animationspeed",
		"type" => "text",
		"desc" =>  __("Set the speed of animations, in milliseconds", 'primathemes'),
		"class" => "meta_header_featured meta_header_slider",
		);
	$slider_numbers = intval ( prima_get_setting( 'header_featured_slider_numbers' ) );
	if ( $slider_numbers < 1 ) $slider_numbers = 5; 
	for ($i = 1; $i <= $slider_numbers; $i++) {
		$class = $i == 1 ? " meta_header_image" : '';
		$meta["header_image_$i"] = array ( 
			"name" => sprintf ( __("Header Image #%d", 'primathemes'), $i ),
			"id" => "_prima_header_image_$i",
			"type" => "upload",
			"desc" => '',
			"class" => "meta_header_featured meta_header_slider".$class,
			);
		$meta["header_image_url_$i"] = array ( 
			"name" => sprintf ( __("Header Image #%d Link", 'primathemes'), $i ),
			"id" => "_prima_header_image_url_$i",
			"type" => "text",
			"desc" => '',
			"class" => "meta_header_featured meta_header_slider".$class,
			);
		$meta["header_image_target_$i"] = array ( 
			"name" => "",
			"id" => "_prima_header_image_target_$i",
			"type" => "checkbox",
			"default" => "",
			"desc" => __("Open link in new window", 'primathemes'),
			"class" => "noborder meta_header_featured meta_header_slider".$class,
			);
		$meta["header_image_desc_$i"] = array ( 
			"name" => sprintf ( __("Header Image #%d Description", 'primathemes'), $i ),
			"id" => "_prima_header_image_desc_$i",
			"type" => "text",
			"desc" => '',
			"class" => "meta_header_featured meta_header_slider",
			);
	}
	return $meta;
}

/**
 * Add hide header elements settings of Header metabox for post editing screen.
 *
 * @since PrimaShop 1.3
 */
add_filter( 'prima_metabox_page_header_args', 'prima_metabox_types_header_args_hide' );
function prima_metabox_types_header_args_hide( $meta ) {
	$meta['_prima_header_topnav_hide'] = array ( 
		"name" => __("Hide Top Navigation", 'primathemes'),
		"id" => "_prima_header_topnav_hide",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will hide top navigation on this page", 'primathemes'),
		);
	$meta['_prima_header_content_hide'] = array ( 
		"name" => __("Hide Header Logo and Menu", 'primathemes'),
		"id" => "_prima_header_content_hide",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will hide header logo and menu on this page", 'primathemes'),
		);
	$meta['_prima_header_cta_hide'] = array ( 
		"name" => __("Hide Call To Action", 'primathemes'),
		"id" => "_prima_header_cta_hide",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will hide call to action on this page", 'primathemes'),
		);
	return $meta;
}

/**
 * Add hide footer elements settings of Footer metabox for post editing screen.
 *
 * @since PrimaShop 1.3
 */
add_filter( 'prima_metabox_page_footer_args', 'prima_metabox_types_footer_args_hide' );
function prima_metabox_types_footer_args_hide( $meta ) {
	$meta['_prima_footer_widgets_hide'] = array ( 
		"name" => __("Hide Footer Widgets Area", 'primathemes'),
		"id" => "_prima_footer_widgets_hide",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will hide footer widgets area on this page", 'primathemes'),
		);
	$meta['_prima_footer_content_hide'] = array ( 
		"name" => __("Hide Footer Credits and Menu", 'primathemes'),
		"id" => "_prima_footer_content_hide",
		"type" => "checkbox",
		"default" => "false",
		"desc" => __("This will hide footer credits and menu on this page", 'primathemes'),
		);
	return $meta;
}

/**
 * Add Blog Page Template settings of Page Template metabox for post editing screen.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_metabox_page_template_args', 'prima_metabox_page_template_args_blog' );
function prima_metabox_page_template_args_blog( $meta ) {
	$categories = get_terms('category');
	if ( count($categories) > 0 ){
		$options = array();
		$options[0] = __('All Categories', 'primathemes');
		foreach ( $categories as $category ) {
			$options[$category->term_id] = $category->name;
		}
		$meta['page-blog-category'] = array ( 
			"name" => __("Category", 'primathemes'),
			"id" => "content_category",
			"template" => "page_blog",
			"type" => "select",
			"default" => "",
			"options" => $options,
			);
	}
	$meta['page-blog-contentlayout'] = array ( 
		"name" => __("Content Layout", 'primathemes'),
		"id" => "content_layout",
		"template" => "page_blog",
		"type" => "select",
		"default" => "",
		"options" => array ( 
			'default' => __('Full Text', 'primathemes'),
			'excerpt' => __('Summary', 'primathemes'),
			'featuredfull' => __('Featured Image + Full Text', 'primathemes'),
			'featured' => __('Featured Image + Summary', 'primathemes'),
			'thumbnailleft' => __('Left Thumbnail + Summary', 'primathemes'),
			'thumbnailright' => __('Right Thumbnail + Summary', 'primathemes'),
			),
		);
	$meta['page-blog-contentnavigation'] = array ( 
		"name" => __("Content Navigation", 'primathemes'),
		"id" => "content_navigation",
		"template" => "page_blog",
		"type" => "select",
		"default" => "",
		"options" => array ( 
			'prevnext' => __('Previous Page - Next Page', 'primathemes'),
			'oldernewer' => __('Older Posts - Newer Posts', 'primathemes'),
			'numeric' => __('Numeric Navigation', 'primathemes'),
			),
		);
	$meta['page-blog-postsperpage'] = array ( 
		"name" => __("Posts Per Page", 'primathemes'),
		"id" => "postsperpage",
		"template" => "page_blog",
		"type" => "text_small",
		"default" => '',
		"desc" => '',
		);
	return $meta;
}

/**
 * Add custom javascript for Featured Header metaboxes, for better user experience.
 *
 * @since PrimaShop 1.0
 */
add_action( 'admin_head-post.php', 'prima_metabox_header_featured_scripts' );
add_action( 'admin_head-post-new.php', 'prima_metabox_header_featured_scripts' );
add_action( 'admin_head-edit-tags.php', 'prima_metabox_header_featured_scripts' );
function prima_metabox_header_featured_scripts() {
    ?>
	<script type="text/javascript">
	/*<![CDATA[*/
	jQuery(document).ready(function($){
		/* Check if featured header dropdown exists */
		if ( $('#prima-_prima_header_featured').length ) { 
			var header_featured = '';
			header_featured = $('#prima-_prima_header_featured').val();
			
			$('.meta_header_featured').hide();
			if ( header_featured == '' || header_featured == 'image' ) {
				$('.meta_header_image').show();
			}
			else if ( header_featured == 'slider' ) {
				$('.meta_header_slider').show();
			}
			else if ( header_featured == 'custom' ) {
				$('.meta_header_custom').show();
			}
			
			$('#prima-_prima_header_featured').change( function () {
				header_featured = $(this).val();
				$('.meta_header_featured').hide();
				if ( header_featured == '' || header_featured == 'image' ) {
					$('.meta_header_image').show();
				}
				else if ( header_featured == 'slider' ) {
					$('.meta_header_slider').show();
				}
				else if ( header_featured == 'custom' ) {
					$('.meta_header_custom').show();
				}
			});
		}
	});
	/*]]>*/
	</script>
	<?php 
}

/**
 * Add custom javascript for Page Template metaboxes, for better user experience.
 *
 * @since PrimaShop 1.0
 */
add_action( 'admin_head-post.php', 'prima_metabox_page_template_scripts' );
add_action( 'admin_head-post-new.php', 'prima_metabox_page_template_scripts' );
function prima_metabox_page_template_scripts() {
    ?>
	<script type="text/javascript">
	/*<![CDATA[*/
	jQuery(document).ready(function($){
		/* Check if page template dropdown exists */
		if ( $('#page_template').length ) { 
			var template = '';
			template = $('#page_template').val();
			template = template.replace(".php", "");
			
			if ( template == '' || template == 'default' ) $('#prima-metabox-page-template').hide();
			else { 
				$('#prima-metabox-page-template').show();
				$('#prima-metabox-page-template tr.meta_template').hide();
				$('#prima-metabox-page-template tr.meta_template_'+template).show();
			}
			
			/* TODO: Need to find a better way to do this...
			if ( template == 'page_blog' ) $('#postdivrich, #postexcerpt').hide();
			else $('#postdivrich, #postexcerpt').show();
			*/

			$('#page_template').change( function () {
				template = $(this).val();
				template = template.replace(".php", "");
				if ( template == '' || template == 'default' ) $('#prima-metabox-page-template').hide();
				else { 
					$('#prima-metabox-page-template').show();
					$('#prima-metabox-page-template tr.meta_template').hide();
					$('#prima-metabox-page-template tr.meta_template_'+template).show();
				}

				/* TODO: Need to find a better way to do this...
				if ( template == 'page_blog' ) $('#postdivrich, #postexcerpt').hide();
				else $('#postdivrich, #postexcerpt').show();
				*/
			});
		}
	});
	/*]]>*/
	</script>
	<?php 
}
