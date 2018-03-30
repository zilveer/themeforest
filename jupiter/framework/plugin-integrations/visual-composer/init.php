<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Adds support to Visual Composer page builder. It also adds some features, elimniates some features from the plugin that plays not well with the theme.
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */




// Do not proceed if Visual Composer plugin is not active
if (!class_exists('WPBakeryShortCode')) return false;



include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/autocomplete.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/group_heading.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/hidden_input.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/item_id.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/multiselect.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/range.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/theme_fonts.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/toggle.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/upload.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/visual_selector.php");
include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/fields/gmap_iterator.php");




/*
*
* Set Visual Composer to act as bundled with the theme
* Load theme built-in shortcodes template files located in components/shortcodes
* Disable Frontend of Visual Composer due to the incompatibilities 
*
*/

if(!function_exists('mk_set_visual_composer_as_bundled')) {
	function mk_set_visual_composer_as_bundled() {
	    

	    vc_set_as_theme();

	    
	    if (defined('MODIFIED_VC_ACTIVATED')) {
	        $child_dir = get_stylesheet_directory() . '/components/shortcodes';
	        $parent_dir = get_template_directory() . '/components/shortcodes';
	        
	        vc_set_shortcodes_parent_templates_dir($parent_dir);
	        vc_set_shortcodes_templates_dir($child_dir);
	    } 
	    else {
	        
	        $child_dir = get_template_directory() . '/components/shortcodes';
	        $parent_dir = get_template_directory() . '/components/shortcodes';
	        vc_set_shortcodes_templates_dir($parent_dir);
	        vc_set_shortcodes_templates_dir($child_dir);
	    }
	    
	    vc_disable_frontend();
	}

	add_action('vc_before_init', 'mk_set_visual_composer_as_bundled');
}




/*
*
* Add global params that are used in other shortcodes.
* load vc_map locted in /components/shortcodes/SHORTCODE_NAME/vc_map.php
* If child theme os active and vc_map exists in the same directory, the child theme will override the parent file
*
*/

if(!function_exists('mk_visual_composer_mapper')) {
	function mk_visual_composer_mapper() {

		include (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/global-params.php");
	   
	    $shortcodes_dir = get_template_directory() . '/components/shortcodes/*/vc_map.php';
	    
	    $shortcodes = glob($shortcodes_dir);
	    
	    if(is_array($shortcodes) && !empty($shortcodes)) {
		    foreach ($shortcodes as $shortcode) {

		        $shortcode_name = array_reverse(explode('/', $shortcode));
		        $shortcode_name = $shortcode_name[1];

		        if(file_exists(get_stylesheet_directory() . '/components/shortcodes/'.$shortcode_name.'/vc_map.php')) {
		            include_once(get_stylesheet_directory() . '/components/shortcodes/'.$shortcode_name.'/vc_map.php');
		        } else {
		            include_once ($shortcode);
		        }

		    }
		}


	    // For custom post types added in child theme
	    $external_shortcodes_dir = get_stylesheet_directory() . '/components/shortcodes/*/vc_map.php';

	    $external_shortcodes = glob($external_shortcodes_dir);
	    
	    if(is_array($external_shortcodes) && !empty($external_shortcodes)) {
		    foreach ($external_shortcodes as $shortcode) {

		        $shortcode_name = array_reverse(explode('/', $shortcode));
		        $shortcode_name = $shortcode_name[1];
		        
		        include_once(get_stylesheet_directory() . '/components/shortcodes/'.$shortcode_name.'/vc_map.php');
		    }
		}
	}

	add_action('vc_mapper_init_before', 'mk_visual_composer_mapper');
}



require_once (THEME_PLUGIN_INTEGRATIONS . "/visual-composer/page-section.php");


/*
*
* Initialising theme built-in shortcodes for Visual Composer to detect them. 
*/
class WPBakeryShortCode_mk_category extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_products extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_table extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_icon_box extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_icon_box2 extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_icon_box_gradient extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_mini_callout extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_custom_sidebar extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_gallery extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_social_networks extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_advanced_gmaps extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_swipe_slideshow extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_portfolio extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_news extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_blog extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_blog_teaser extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_moving_image extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_font_icons extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_photo_album extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_blockquote extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_milestone extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_dropcaps extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_highlight extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_tooltip extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_skill_meter extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_skill_meter_chart extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_chart extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_steps extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_custom_list extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_message_box extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_divider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_shape_divider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_button extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_button_gradient extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_toggle extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_fancy_title extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_ornamental_title extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_title_box extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_circle_image extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_pricing_table extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_pricing_table_2 extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_employees extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_clients extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_testimonials extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_flexslider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_layerslider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_revslider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_woocommerce_recent_carousel extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_image_slideshow extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_image extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_image_switch extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_fullwidth_slideshow extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_Laptop_slideshow extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_lcd_slideshow extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_padding_divider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_contact_form extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_faq extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_contact_info extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_portfolio_carousel extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_blog_carousel extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_blog_showcase extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_audio extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_countdown extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_news_tab extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_edge_slider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_banner_builder extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_animated_columns extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_tab_slider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_flipbox extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_edge_one_pager extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_header extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_page_title_box extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_imagebox_item extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_theatre_slider extends WPBakeryShortCode{}
class WPBakeryShortCode_mk_subscribe extends WPBakeryShortCode{}

/*
* Shortcodes that will be as container for other shortcodes. inheriting WPBakeryShortCodesContainer
*/
class WPBakeryShortCode_mk_imagebox extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_mk_custom_box extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_mk_slideshow_box extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_mk_content_box extends WPBakeryShortCodesContainer{}
