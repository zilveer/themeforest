<?php
/*
Plugin Name: Vivaco Custom Shortcodes
Description: vivaco-shortcodes
Version: 2.2.0
Author: Vivaco (Alexander)
Author URI: http://vivaco.com
*/

// Hex 2 RGB values
function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if (strlen($hex) == 3) {
		$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
		$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
		$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
	} else {
		$r = hexdec(substr($hex, 0, 2));
		$g = hexdec(substr($hex, 2, 2));
		$b = hexdec(substr($hex, 4, 2));
	}

	$rgb = array(
		$r,
		$g,
		$b
	);
	return implode(",", $rgb); // returns the rgb values separated by commas
	// return $rgb; // returns an array with the rgb values
}

//setting a random id
if (!function_exists('vsc_random_id')) {
	function vsc_random_id($id_length) {
		$random_id_length = $id_length;
		$rnd_id = crypt(uniqid(rand(), 1), 'DlbkWT*ZQ*_jpORJ*PwokopPlY+NR|frcgz%+WCx|RZPkq*IbO56hQ1o9*b2'); // on php 5.6 crypt without or with simple salt parameter generate E_NOTICE
		$rnd_id = strip_tags(stripslashes($rnd_id));
		$rnd_id = str_replace(".", "", $rnd_id);
		$rnd_id = strrev(str_replace("/", "", $rnd_id));
		$rnd_id = str_replace(range(0, 9), "", $rnd_id);
		$rnd_id = substr($rnd_id, 0, $random_id_length);
		$rnd_id = strtolower($rnd_id);

		return $rnd_id;
	}
}
/*
function vivaco_shortcodes_image_sizes() {
	add_image_size('blog-thumb', 700, 700, false); // Blog thumbnails
	add_image_size('gallery-thumb', 1120, 9999, false); // Gallery thumbnails
}
add_action('init', 'vivaco_shortcodes_image_sizes');
*/


function extend_composer_classes() {
// Content slider
	define( 'CONTENT_SLIDE_TITLE', __( "Content Slide", "vivaco" ) );
	require_once vc_path_dir('SHORTCODES_DIR', 'vc-tabs.php');
	class WPBakeryShortCode_VSC_Content_Slider extends WPBakeryShortCode_VC_Tabs {
		protected $predefined_atts = array(
			'tab_id' => CONTENT_SLIDE_TITLE,
			'title' => ''
		);

		protected function getFileName() {
			return 'vsc_content_slider';
		}

		public function getTabTemplate() {
			return '<div class="wpb_template">' . do_shortcode( '[vc_tab title="' . CONTENT_SLIDE_TITLE . '" tab_id=""][/vc_tab]' ) . '</div>';
		}
	}
}
add_action( 'vc_before_init', 'extend_composer_classes' );

function extend_composer() {
	if (class_exists('WPBakeryVisualComposer')) {

		$list = array(
			//'post',
			'page',
			'vivaco-modals'
		);
		vc_set_default_editor_post_types( $list );
	
		if (function_exists('vc_map')) {

			// Change default VC attributes.
			$attributes = array(
				"type" => "textfield",
				"heading" => __( "Image size", "vivaco" ),
				"param_name" => "img_size",
				"description" => __( "Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \"thumbnail\" size.", "vivaco" ),
				"value" => "full"
			);
			//Single image new onclick targets
			$attributes_modals = array(
			'type' => 'dropdown',
			'heading' => __( 'On click action', 'js_composer' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'None', 'js_composer' ) => '',
				__( 'Link to large image', 'js_composer' ) => 'img_link_large',
				__( 'Open prettyPhoto', 'js_composer' ) => 'link_image',
				__( 'Open custom link', 'js_composer' ) => 'custom_link',
				__( 'Zoom', 'js_composer' ) => 'zoom',
				__( 'Open Modal', 'js_composer' ) => 'modal',
			),
			'description' => __( 'Select action for click action.', 'js_composer' ),
			'std' => '',
			);
			
			$attributes_modals_dep = array(
						"type" => "textfield",
						"heading" => __("Display modal box by ID", "vivaco"),
						"param_name" => "modal_box_id",
						'dependency' => array(
							'element' => 'onclick',
							'value' => 'modal',
						),
					);

			vc_remove_param( "vc_gallery", "img_size" );
			vc_remove_param( "vc_single_image", "img_size" );
			vc_remove_param( "vc_single_image", "onclick" );
			vc_add_param( "vc_gallery", $attributes);
			vc_add_param( "vc_single_image", $attributes);
			vc_add_param( "vc_single_image", $attributes_modals);
			vc_add_param( "vc_single_image", $attributes_modals_dep);

			vc_remove_param("vc_toggle", 'style');
			vc_remove_param("vc_toggle", 'color');
			vc_remove_param("vc_toggle", 'size');

			vc_add_param( "vc_column_text", array(
				"type" => "dropdown",
				"heading" => __("Text alignment", "vivaco"),
				"param_name" => "text_align",
				"value" => array(
					__("Auto", "vivaco") => "",
					__("Left", "vivaco") => 'alignleft',
					__("Center", "vivaco") => "aligncenter",
					__("Right", "vivaco") => "alignright"
				)
			));

			vc_remove_param( "vc_column_text", "css_animation" );
			vc_add_param("vc_column_text", array(
				'type' => 'colorpicker',
				'group' => 'Change color',
				'heading' => __('Text Color', 'vivaco'),
				'param_name' => 'text_color'
			));

			// Custom Map
			require_once('shortcodes/swp_contact7_form.php');
			require_once('shortcodes/swp_row.php');
			require_once('shortcodes/swp_row_inner.php');
			require_once('shortcodes/swp_column.php');
			require_once('shortcodes/swp_column_inner.php');
			require_once('shortcodes/swp_separator.php');
			require_once('shortcodes/swp_tab.php');
			require_once('shortcodes/swp_button.php');
			require_once('shortcodes/swp_button2.php');
			require_once('shortcodes/swp_list.php');
			require_once('shortcodes/swp_quote.php');
			require_once('shortcodes/swp_section_title.php');
			require_once('shortcodes/swp_vc_icon.php');
			require_once('shortcodes/swp_text_with_icon.php');
			require_once('shortcodes/swp_canvas_title.php');
			require_once('shortcodes/swp_progress_bar.php');
			require_once('shortcodes/swp_pie_chart.php');
			require_once('shortcodes/swp_counter.php');
			require_once('shortcodes/swp_team_member.php');
			require_once('shortcodes/swp_call_to_action.php');
			require_once('shortcodes/swp_message_box.php');
			require_once('shortcodes/swp_cta2.php');
			require_once('shortcodes/swp_pricing_table.php');
			require_once('shortcodes/swp_testimonials.php');
			require_once('shortcodes/swp_newsletter.php');
			require_once('shortcodes/swp_portfolio_grid.php');
			require_once('shortcodes/swp_content_slider.php');
			require_once('shortcodes/swp_countdown.php');
			require_once('shortcodes/swp_single_product.php');

			/*
			vc_map(array(
				"name" => __("Space", "vivaco"),
				"icon" => "icon-ui-splitter-horizontal",
				"base" => "vsc-space",
				"weight" => 21,
				"description" => "Add space between elements",
				"class" => "space_extended",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"admin_label" => true,
						"heading" => __("Height of the space(px)", "vivaco"),
						"param_name" => "height",
						"value" => 60,
						"description" => __("Set height of the space. You can add white space between elements to separate them beautifully", "vivaco")
					)
				)
			));
			*/
		}
	}

	//Remove some shortcodes from Grid VC editor shortcodes in backend
	if (function_exists('vc_remove_element')) {
		vc_remove_element("vc_cta_button");
		vc_remove_element("vc_cta_button2");
		vc_remove_element("vc_teaser_grid");
		vc_remove_element("vc_posts_slider");
		vc_remove_element("vc_images_carousel");
		vc_remove_element("vc_carousel");
		vc_remove_element("vc_button");
		//vc_remove_element("vc_text_separator");
		//vc_remove_element("vc_icon");
		//vc_remove_element("vc_button2");
	}

}
add_action('init', 'extend_composer', 9999);

function startuply_change_succession() {
	if (function_exists('vc_map')) {
		// Change succession for default elements.

		//ROW 1
		vc_map_update('vc_row', array( "weight" => 100 ));
		vc_map_update( "vsc-section-title", array( "weight" => 90 ));
		vc_map_update( "vc_column_text", array( "weight" => 80, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vc_empty_space", array( "weight" => 79, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vc_single_image", array( "weight" => 78, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_gallery", array( "weight" => 77,'category' => __("Content", "vivaco")));

		//ROW 2
		vc_map_update( "vc_tabs", array( "weight" => 76, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vc_tour", array( "weight" => 75, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vc_accordion", array( "weight" => 74, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vsc-button", array( "weight" => 73, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vc_icon", array( "weight" => 72, 'category' => __("Content", "vivaco")));
		vc_map_update( "vsc-text-icon", array( "weight" => 71, 'category' => __("Content", "vivaco")));

		//ROW 3
		vc_map_update( "vc_separator", array( "weight" => 70, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_progress_bar", array( "weight" => 69, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_pie", array( "weight" => 68, 'category' => __("Content", "vivaco")));
		vc_map_update( "vsc-counter", array( "weight" => 67, 'category' => __("Content", "vivaco")));
		vc_map_update( "vsc-countdown", array( "weight" => 66, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_custom_heading", array( "weight" => 65, 'category' => __("Content", "vivaco")));

		//ROW 4
		vc_map_update( "vsc_content_slider", array( "weight" => 64, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vsc-team-member-new", array( "weight" => 63, 'category' => __("Content", "vivaco")));
		vc_map_update( "vsc-testimonials-slider", array( "weight" => 62, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_toggle", array( "weight" => 61, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vsc-quote", array( "weight" => 59, 'category' => __("Content", "vivaco")));
		vc_map_update( "vsc-list", array( "weight" => 60, 'category' => __("Content", "vivaco")));


		//ROW 5
		vc_map_update( "vc_message", array( "weight" => 57, 'category' => __("Content", "vivaco") ));
		vc_map_update( "contact-form-7-wrapper", array( "weight" => 56, 'category' => __("Content", "vivaco")));
		vc_map_update( "vsc-newsletter", array( "weight" => 55, 'category' => __("Content", "vivaco")));
		vc_map_update( "vsc-call-to-action", array( "weight" => 54, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_video", array( "weight" => 53, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_gmaps", array( "weight" => 52, 'category' => __("Content", "vivaco")));
		//vc_map_update( "vsc-table_placebo", array( "weight" => 52, 'category' => __("Content", "vivaco")));
		vc_map_update( "vsc-product-pricing", array( "weight" => 51,'category' => __("Content", "vivaco")));
		if ( shortcode_exists( "VC_edd" ) ) {
			vc_map_update( "VC_edd", array( "weight" => 50,'category' => __("Content", "vivaco")));
		}


		//ROW 6

		vc_map_update( "vsc-portfolio-grid", array( "weight" => 49, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vc_basic_grid", array( "weight" => 48, 'category' => __("Content", "vivaco") ));
		vc_map_update( "vc_media_grid", array( "weight" => 47, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_masonry_grid", array( "weight" => 46, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_masonry_media_grid", array( "weight" => 45, 'category' => __("Content", "vivaco")));

		//ROW 7
		if ( shortcode_exists( "rev_slider_vc" ) ) {
			vc_map_update( "rev_slider_vc", array( "weight" => 45, 'category' => __("Content", "vivaco")));
		}
		vc_map_update( "vc_widget_sidebar", array( "weight" => 44, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_raw_html", array( "weight" => 43, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_raw_js", array( "weight" => 42, 'category' => __("Content", "vivaco")));
		vc_map_update( "css_animation", array( "weight" => 41, 'category' => __("Content", "vivaco")));
		if ( shortcode_exists( "templatera" ) ) {
			vc_map_update( "templatera", array( "weight" => 40, 'category' => __("Content", "vivaco")));
		}

		//ROW 8
		vc_map_update( "vc_flickr", array( "weight" => 39, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_facebook", array( "weight" => 38, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_tweetmeme", array( "weight" => 37, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_googleplus", array( "weight" => 36, 'category' => __("Content", "vivaco")));
		vc_map_update( "vc_pinterest", array( "weight" => 35, 'category' => __("Content", "vivaco")));

		if ( shortcode_exists( "templatera" ) ) {
			vc_map_update( "templatera", array( 'category' => __("Content", "vivaco")));
		}

		if ( shortcode_exists( "gravityform" ) ) {
			vc_map_update( "gravityform", array( 'category' => __("Content", "vivaco")));
		}

		// Fix the new Google maps link + add small guidance
		if (class_exists('WPBMap')) {
			$param = WPBMap::getParam( 'vc_gmaps', 'link' );
			$param['description'] = sprintf( __( 'Visit %s to create your map. 1) Find location 2) Click "Settings" (cog icon) at the bottom right of the screen and choose "Share or embed map" 3) Click "Embed map" tab to reveal iframe code 4) Copy iframe code and paste it here.', 'js_composer' ), '<a href="https://www.google.com/maps" target="_blank">Google maps</a>' );
			vc_update_shortcode_param( 'vc_gmaps', $param );
		}
	}
}
add_action( 'wp_loaded', 'startuply_change_succession' , 9999);

if (!function_exists('vivaco_enqueue_scripts')) {

	// frontend register styles
	function vivaco_enqueue_scripts() {
		$version = '2.2.0';
	}

	add_action('wp_enqueue_scripts', 'vivaco_enqueue_scripts');
}

if (!function_exists('vivaco_admin_enqueue_scripts')) {
	// back-end register styles

	//Add custom Visual Composer styles and icons
	function vivaco_admin_enqueue_scripts($hook) {
		$version = '2.2.0';

		if (function_exists('vc_map')) {
			wp_enqueue_style('extend-composer', get_template_directory_uri() . '/css/extend-composer.css', array(), $version);
		}
	}

	add_action('admin_enqueue_scripts', 'vivaco_admin_enqueue_scripts');
}





/*-----------------------------------------------------------------------------------*/
/*	Page Title
/*-----------------------------------------------------------------------------------*/
function vsc_page_title_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => ''
	), $atts));

	return get_the_title($id);
}

add_shortcode('vsc-page-title', 'vsc_page_title_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Page Excerpt
/*-----------------------------------------------------------------------------------*/
function vsc_page_excerpt_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => ''
	), $atts));

	global $post;
	$save_post = $post;
	$post = get_post($id);
	setup_postdata($post); // hello
	$output = get_the_excerpt();
	$post = $save_post;
	return $output;
}

add_shortcode('vsc-page-excerpt', 'vsc_page_excerpt_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Page Content
/*-----------------------------------------------------------------------------------*/
function vsc_page_content_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => ''
	), $atts));

	$content_post = get_post($id);
	setup_postdata($post); // hello
	$post_content = $content_post->post_content;

	return do_shortcode($post_content);
}

add_shortcode('vsc-page-content', 'vsc_page_content_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Page Thumbnail
/*-----------------------------------------------------------------------------------*/
function vsc_page_thumbnail_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => '',
		'thumb_size' => 'gallery-thumb'
	), $atts));

	return get_the_post_thumbnail($id, explode('x', $thumb_size, 2));
}

add_shortcode('vsc-page-thumbnail', 'vsc_page_thumbnail_shortcode');




/*-----------------------------------------------------------------------------------*/
/*	Space
/*-----------------------------------------------------------------------------------*/
/*
function vsc_space_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'height' => '60'
	), $atts));
	return '<div style="clear:both; width:100%; height:' . $height . 'px"></div>';
}

add_shortcode('vsc-space', 'vsc_space_shortcode');
*/



/*-----------------------------------------------------------------------------------*/
/*	Social Share Blog
/*-----------------------------------------------------------------------------------*/

function vsc_social_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => ''
	), $atts));

	wp_enqueue_script('vsc-social');

	$output = '';

	$output .= '<div class="share-options">';
	if (!empty($title)) {
		$output .= '<h6>' . $title . '</h6>';
	}
	$output .= '<a href="" class="twitter-sharer" onClick="twitterSharer()"><i class="fa fa-twitter"></i></a>';
	$output .= '<a href="" class="facebook-sharer" onClick="facebookSharer()"><i class="fa fa-facebook"></i></a>';
	$output .= '<a href="" class="pinterest-sharer" onClick="pinterestSharer()"><i class="fa fa-pinterest"></i></a>';
	$output .= '<a href="" class="google-sharer" onClick="googleSharer()"><i class="fa fa-google-plus"></i></a>';
	$output .= '<a href="" class="delicious-sharer" onClick="deliciousSharer()"><i class="fa fa-share"></i></a>';
	$output .= '<a href="" class="linkedin-sharer" onClick="linkedinSharer()"><i class="fa fa-linkedin"></i></a>';
	$output .= '</div>';
	$output .= '<p></p>';

	return $output;
}

add_shortcode('vsc-social-block', 'vsc_social_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar
/*-----------------------------------------------------------------------------------*/

function adjustBrightness($hex, $steps) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Format the hex color string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);

	// Get decimal values
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));

	// Adjust number of steps and keep it inside 0 to 255
	$r = max(0,min(255,$r + $steps));
	$g = max(0,min(255,$g + $steps));
	$b = max(0,min(255,$b + $steps));

	$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
	$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
	$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

	return '#'.$r_hex.$g_hex.$b_hex;
}






/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/

/* Old */

function vsc_team_member($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => ''
	), $atts));

	global $post;

	$args = array(
		'post_type' => 'team',
		'posts_per_page' => 1,
		'p' => $id
	);

	$team_query = new WP_Query($args);
	if ($team_query->have_posts()):
		while ($team_query->have_posts()):
			$team_query->the_post();

			$member_text = get_post_meta($post->ID, 'vsc_member_text', true);
			$position = get_post_meta($post->ID, 'vsc_member_position', true);
			$twitter = get_post_meta($post->ID, 'vsc_member_twitter', true);
			$facebook = get_post_meta($post->ID, 'vsc_member_facebook', true);
			$email = get_post_meta($post->ID, 'vsc_member_mail', true);
			$linkedin = get_post_meta($post->ID, 'vsc_member_linkedin', true);
			$google = get_post_meta($post->ID, 'vsc_member_google', true);

			$team_thumb_icon = get_post_meta($post->ID, 'vsc_team_thumb_icon', true);

			$mail = $email;

			$image = get_the_post_thumbnail($id, 'member-thumb', array(
				'class' => 'img-responsive img-circle'
			));
			$url_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

			$retour = '';
			$retour .= '<div class="team-member member">';
			$retour .= '<div class="thumb-wrapper">';


			$retour .= '<div class="title-wrap">';
			$retour .= '<p class="h7 base_clr_txt">';

			$member_name = get_the_title();
			$member_name = str_replace(' ', '<br/>', $member_name );
			$retour .= $member_name;

			$retour .= '</p>';
			$retour .= '</div>';

			$retour .= '<div class="overlay img-circle"></div>';

			$retour .= '<div class="team-text">';
			$retour .= '<div class="grid-child">';
			if (!empty($position)) {
				$retour .= '<p class="thin team-subtitle">' . $position . '</p>';
			}
			if (!empty($member_text)) {
				$retour .= '<p class="member-content">' . wp_kses_post($member_text) . '</p>';
			}
			$retour .= '</div>';
			$retour .= '<div class="helper">';
			$retour .= '</div>';
			$retour .= '</div>';


			$retour .= $image;
			$retour .= '</div>';


			$retour .= '<div class="socials">';
			if (!empty($mail)) {
				$retour .= '<a href="mailto:' . $mail . '"><i class="icon icon-chat-messages-13"></i></a>';
			}
			if (!empty($facebook)) {
				$retour .= '<a href="' . esc_url($facebook) . '"><i class="icon icon-socialmedia-08"></i></a>';
			}
			if (!empty($twitter)) {
				$retour .= '<a href="' . esc_url($twitter) . '"><i class="icon icon-socialmedia-07"></i></a>';
			}
			if (!empty($google)) {
				$retour .= '<a href="' . esc_url($google) . '"><i class="icon icon-socialmedia-16"></i></a>';
			}
			if (!empty($linkedin)) {
				$retour .= '<a href="' . esc_url($linkedin) . '"><i class="icon icon-socialmedia-05"></i></a>';
			}
			$retour .= '</div>';


			$retour .= '</div>';
		endwhile;
	else:
		$retour = '';
		$retour .= "nothing found.";
	endif;

	//Reset Query
	wp_reset_query();

	return $retour;
}
add_shortcode('vsc-team-member', 'vsc_team_member');


function vsc_accent($atts, $content = null) {
	extract(shortcode_atts(array(
		"class" => "base_clr_txt",
		"tag" => "span"
	), $atts));
	$output = "<{$tag} class=\"{$class}\">{$content}</{$tag}>";

	return do_shortcode($output);
}
add_shortcode("accent", "vsc_accent");



/*-----------------------------------------------------------------------------------*/
/*	Shortcodes Filter
/*-----------------------------------------------------------------------------------*/
function vivaco_the_content_filter($content) {
	// array of custom shortcodes
	$block = join("|", array(
		"vsc-portfolio-grid",
		"vsc-blog-grid",
		"vsc-signup",
		"vsc-pricing-column",
		"vsc-button",
		"vsc-funfact",
		"vsc-skillbar",
		"vsc-column"
	));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep);

	return $rep;
}
add_filter("the_content", "vivaco_the_content_filter");



/* enabled shortcodes in widgets */
add_filter('widget_text', 'do_shortcode');




/* extend composer fonts */
function startuply_extend_composer_fonts() {

	function vc_iconpicker_type_startuplyli( $icons ) {
		$startuplyli_icons = array();

		// key:class part name => {name: Category name, up_to: from 1 to up_to number class part}
		$categories = array(
			'alerts' => array('name' => 'Alerts', 'up_to' => 18 ),
			'arrows' => array('name' => 'Arrows', 'up_to' => 41 ),
			'badges-votes' => array('name' => 'Badges Votes', 'up_to' => 16 ),
			'chat-messages' => array('name' => 'Chat Messages', 'up_to' => 16 ),
			'documents-bookmarks' => array('name' => 'Documents Bookmarks', 'up_to' => 16 ),
			'ecology' => array('name' => 'Ecology', 'up_to' => 16 ),
			'education-science' => array('name' => 'Education', 'up_to' => 20 ),
			'emoticons' => array('name' => 'Emoticons', 'up_to' => 35 ),
			'faces-users' => array('name' => 'Faces Users', 'up_to' => 7 ),
			'filetypes' => array('name' => 'File Types', 'up_to' => 17 ),
			'food' => array('name' => 'Food', 'up_to' => 18 ),
			'graphic-design' => array('name' => 'Graphic Design', 'up_to' => 34 ),
			'medical' => array('name' => 'Medical', 'up_to' => 28 ),
			'multimedia' => array('name' => 'Multimedia', 'up_to' => 40 ),
			'nature' => array('name' => 'Nature', 'up_to' => 14 ),
			'office' => array('name' => 'Office', 'up_to' => 61 ),
			'party' => array('name' => 'Party', 'up_to' => 11 ),
			'realestate-living' => array('name' => 'Realestate Living', 'up_to' => 16 ),
			'seo-icons' => array('name' => 'SEO', 'up_to' => 42 ),
			'shopping' => array('name' => 'Shopping', 'up_to' => 27 ),
			'socialmedia' => array('name' => 'Social Media', 'up_to' => 29 ),
			'sport' => array('name' => 'Sport', 'up_to' => 18 ),
			'text-hierarchy' => array('name' => 'Text Hierarchy', 'up_to' => 10 ),
			'touch-gestures' => array('name' => 'Touch Gestures', 'up_to' => 24 ),
			'travel-transportation' => array('name' => 'Travel', 'up_to' => 20 ),
			'weather' => array('name' => 'Weather', 'up_to' => 14 ),
		);

		$count = 0;
		foreach ($categories as $key => $category) {
			$values = array();
			for ( $idx = 1; $idx <= $category['up_to']; $idx++ ) {
				$values[] = array( sprintf("icon icon-%s-%02d", $key, $idx) => $category['name'] );
			}
			if ( $key == 'emoticons' ) {
				$values[] = array( 'icon-emoticons-artboard-80' => $category['name'] );
			}
			$count += count($values);

			$startuplyli_icons[$category['name']] = $values;
		}

		return array_merge( $icons, $startuplyli_icons );
	}
	add_filter( 'vc_iconpicker-type-startuplyli', 'vc_iconpicker_type_startuplyli', 1 /* first in list */ );


	function vc_iconpicker_type_startuplyli_register_css( $icons ) {
		wp_enqueue_style( 'startuply_lineicons_1', get_template_directory_uri() . '/fonts/LineIcons/font-lineicons.css', false, WPB_VC_VERSION, 'screen' );
	}
	add_action( 'vc_base_register_front_css', 'vc_iconpicker_type_startuplyli_register_css' );
	add_action( 'vc_base_register_admin_css', 'vc_iconpicker_type_startuplyli_register_css' );

	/* remove existing sample */

	function startuply_destroy_array_element_by_key($haystack, $needle){
		$output = array();

		foreach($haystack as $key => $value){
			if( $key && in_array( $key, $needle ) === true ){
				unset($key);
			}elseif(is_array($value)){
				$output[$key] = startuply_destroy_array_element_by_key($value, $needle);
			}else{
				$output[$key] = $value;
			}
		}
		return $output;
	}

	// function startuply_remove_icon_type_fontawesome($icons) {
	// 	$remove_icons = array('fa fa-adjust', 'fa fa-anchor');

	// 	return startuply_destroy_array_element_by_key($icons, $remove_icons);
	// }
	// function startuply_remove_icon_type_openiconic($icons) {
	// 	$remove_icons = array('vc-oi vc-oi-dial', 'vc-oi vc-oi-pilcrow');

	// 	return startuply_destroy_array_element_by_key($icons, $remove_icons);
	// }
	// function startuply_remove_icon_type_typicons($icons) {
	// 	$remove_icons = array();

	// 	return startuply_destroy_array_element_by_key($icons, $remove_icons);
	// }
	// function startuply_remove_icon_type_entypo($icons) {
	// 	$remove_icons = array();

	// 	return startuply_destroy_array_element_by_key($icons, $remove_icons);
	// }
	// function startuply_remove_icon_type_linecons($icons) {
	// 	$remove_icons = array();

	// 	return startuply_destroy_array_element_by_key($icons, $remove_icons);
	// }


	// add_filter( 'vc_iconpicker-type-fontawesome', 'startuply_remove_icon_type_fontawesome', 999 );
	// add_filter( 'vc_iconpicker-type-openiconic', 'startuply_remove_icon_type_openiconic', 999 );
	// add_filter( 'vc_iconpicker-type-typicons', 'startuply_remove_icon_type_typicons', 999 );
	// add_filter( 'vc_iconpicker-type-entypo', 'startuply_remove_icon_type_entypo', 999 );
	// add_filter( 'vc_iconpicker-type-linecons', 'startuply_remove_icon_type_linecons', 999 );
}
add_action( 'vc_before_init', 'startuply_extend_composer_fonts' );

function startuply_set_vc_as_theme() {
    vc_set_as_theme(true);
}
add_action( 'vc_before_init', 'startuply_set_vc_as_theme' );
