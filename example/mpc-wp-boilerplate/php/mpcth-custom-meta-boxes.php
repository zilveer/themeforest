<?php

/**
 * Custom Meta Boxes
 *
 * Functions for all metaboxes (post item, portfolio item, page, blog page,portfolio page).
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 *
 */

/*-----------------------------------------------------------------------------------*/
/*	Custom Meta Boxes
/*-----------------------------------------------------------------------------------*/

function mpcth_admin_init() {
	wp_enqueue_style('mpcth-metaboxes-style', MPC_THEME_ROOT.'/mpc-wp-boilerplate/css/metaboxes.css');
	wp_enqueue_script('mpcth-metaboxes-js', MPC_THEME_ROOT.'/mpc-wp-boilerplate/js/mpcth-metaboxes.js', array('jquery'), '1.0');
}
add_action('admin_init', 'mpcth_admin_init');

/*-----------------------------------------------------------------------------------*/
/*	Add Meta Boxes
/*-----------------------------------------------------------------------------------*/

function add_pages_meta_box() {
	$post_id = '';

	if(isset($_GET['post']))
		$post_id =  $_GET['post'];
	elseif(isset($_POST['post_ID']))
		$post_id = $_POST['post_ID'];

	global $template_file;
	$template_file = get_post_meta($post_id, '_wp_page_template', TRUE);

	/* Blog Post Settings */
	add_meta_box('mpcth_post_settings', __('Post Settings', 'mpcth'), 'post_meta_box', 'post', 'normal', 'core');
	add_filter('postbox_classes_post_mpcth_post_settings', 'mpcth_meta_box_class');

	/* Portfolio Post Settings */
	add_meta_box('mpcth_post_settings', __('Post Settings', 'mpcth'), 'post_meta_box', 'portfolio', 'normal', 'core');
	add_filter('postbox_classes_portfolio_mpcth_post_settings', 'mpcth_meta_box_class');

	/* Gallery Post Settings */
	add_meta_box('mpcth_post_settings', __('Post Settings', 'mpcth'), 'post_meta_box', 'gallery', 'normal', 'core');
	add_filter('postbox_classes_gallery_mpcth_post_settings', 'mpcth_meta_box_class');

	/* Page Settings */
	add_meta_box('mpcth_page_settings', __('Page Settings', 'mpcth'), 'page_meta_box', 'page', 'normal', 'core');
	add_filter('postbox_classes_page_mpcth_page_settings', 'mpcth_meta_box_class');

	/* Blog Page Template Settings */
	add_meta_box('mpcth_blog_settings', __('Blog Settings', 'mpcth'), 'blog_meta_box', 'page', 'normal', 'core');
	add_filter('postbox_classes_page_mpcth_blog_settings', 'mpcth_meta_box_class');

	/* Portfolio Page Template Settings */
	add_meta_box('mpcth_portfolio_settings', __('Portfolio Settings', 'mpcth'), 'portfolio_meta_box', 'page', 'normal', 'core');
	add_filter('postbox_classes_page_mpcth_portfolio_settings', 'mpcth_meta_box_class');
}
add_action('add_meta_boxes', 'add_pages_meta_box');

/* ---------------------------------------------------------------- */
/* Encode embed code on post save
/* ---------------------------------------------------------------- */

function mpcth_meta_box_save($post_id) {
	// Bail if we're doing an auto save
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	// if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can('edit_post', $post_id) ) return;

	if(isset($_POST['embed_code']))
		update_post_meta($post_id, 'embed_code', urlencode($_POST['embed_code']));
}
add_action('save_post', 'mpcth_meta_box_save');

/* ---------------------------------------------------------------- */
/*	Add classes to meta boxes
/* ---------------------------------------------------------------- */

function mpcth_meta_box_class( $classes = array() ) {
    $classes[] = 'mpcth-meta-box';

    return $classes;
}

/*-----------------------------------------------------------------------------------*/
/*	Blog Post Settings
/*-----------------------------------------------------------------------------------*/

function post_meta_box($post) {
	global $mpcth_options;
	global $post;

	wp_nonce_field('mpc_post_meta_box_nonce', 'post_meta_box_nonce');

	$values = get_post_custom($post->ID);

	$post_format = get_post_format();
	$post_type = $post->post_type;

	if($post_type == 'portfolio' || $post_type == 'gallery') { ?>
		<script>
			jQuery(document).ready(function($) {
				$('#post-formats-select input').each(function() {
					var $this = $(this),
						next = $this.next();

					if(next.text() == 'Aside' || next.text() == 'Status' || next.text() == 'Quote' || next.text() == 'Link') {
						$this.remove();
						next.next('br').remove();
						next.remove();
					}
				});
			});
		</script>
	<?php }

	if(isset($values['double_width_enabled']))
		$double_width_enabled = esc_attr($values['double_width_enabled'][0]);
	else
		$double_width_enabled = "off";

	$double_width_enabled = checked($double_width_enabled, 'on', false);

	if(isset($values['post_size']))
		$post_size = esc_attr($values['post_size'][0]);
	else
		$post_size = "1:1";

	if(isset($values['post_prop']))
		$post_prop = esc_attr($values['post_prop'][0]);
	else
		$post_prop = "rectangle";

	/* Background Settings */
	if(isset($values['background_type']))
		$background_type = esc_attr($values['background_type'][0]);
	else
		$background_type = "default";

	if(isset($values['background_embed_source']))
		$background_embed_source = esc_attr($values['background_embed_source'][0]);
	else
		$background_embed_source = "";

	if(isset($values['background_image_source']))
		$background_image_source = esc_attr($values['background_image_source'][0]);
	else
		$background_image_source = "";

	if(isset($values['background_image_pattern']))
		$background_image_pattern = esc_attr($values['background_image_pattern'][0]);
	else
		$background_image_pattern = "off";

	$background_image_pattern = checked($background_image_pattern, 'on', false);

	if(isset($values['background_toggler_enabled']))
		$background_toggler_enabled = esc_attr($values['background_toggler_enabled'][0]);
	else
		$background_toggler_enabled = "off";

	$background_toggler_enabled = checked($background_toggler_enabled, 'on', false);

	if(isset($values['custom_page_size']))
		$custom_page_size = esc_attr($values['custom_page_size'][0]);
	else
		$custom_page_size = "off";

	$custom_page_size = checked($custom_page_size, 'on', false);

	if(isset($values['page_size']))
		$page_size = esc_attr($values['page_size'][0]);
	else
		$page_size = "960px";

	if(isset($values['page_align']))
		$page_align = esc_attr($values['page_align'][0]);
	else
		$page_align = "default";

	/* Lightbox Settings */
	if(isset($values['lightbox_enabled']))
		$lightbox_enabled = esc_attr($values['lightbox_enabled'][0]);
	else
		$lightbox_enabled = "off";

	$lightbox_enabled = checked($lightbox_enabled, 'on', false);

	if(isset($values['lightbox_caption']))
		$lightbox_caption = esc_attr($values['lightbox_caption'][0]);
	else
		$lightbox_caption = "";

	if(isset($values['lightbox_source'] ))
		$lightbox_source = esc_attr($values['lightbox_source'][0]);
	else
		$lightbox_source = "";

	/* Top Widget Area Settings */
	if(isset($values['hide_top_area']))
		$hide_top_area = esc_attr($values['hide_top_area'][0]);
	else
		$hide_top_area = "off";

	$hide_top_area = checked($hide_top_area, 'on', false);

	if(isset($values['custom_top_area']))
		$custom_top_area = esc_attr($values['custom_top_area'][0]);
	else
		$custom_top_area = "off";

	$custom_top_area = checked($custom_top_area, 'on', false);

	if(isset($values['top_area_columns'])) {
		$top_area_columns = esc_attr($values['top_area_columns'][0]);
	} else {
		$top_area_columns = "3";
	}

	/* Post formats */
	if(isset($values['gallery_images_val'] ))
		$gallery_images_val = esc_attr($values['gallery_images_val'][0]);
	else
		$gallery_images_val = "";

	if($gallery_images_val != "") {
		$ids = explode(',', $gallery_images_val);

		$gallery_images = '';

		foreach ($ids as $id) {
			$gallery_images .= wp_get_attachment_image($id, 'thumbnail', false, array('class' => "mpcth-gallery-image"));
		}
	} else {
		$gallery_images = "";
	}

	if(isset($values['tweet_url'] ))
		$tweet_url = esc_attr($values['tweet_url'][0]);
	else
		$tweet_url = "";

	if(isset($values['link_url'] ))
		$link_url = esc_attr($values['link_url'][0]);
	else
		$link_url = "";

	if(isset($values['quote'] ))
		$quote = esc_attr($values['quote'][0]);
	else
		$quote = "";

	if(isset($values['quote_author'] ))
		$quote_author = esc_attr($values['quote_author'][0]);
	else
		$quote_author = "";

	if(isset($values['mp3'] ))
		$mp3 = esc_attr($values['mp3'][0]);
	else
		$mp3 = "";

	if(isset($values['ogg'] ))
		$ogg = esc_attr($values['ogg'][0]);
	else
		$ogg = "";

	if(isset($values['m4v'] ))
		$m4v = esc_attr($values['m4v'][0]);
	else
		$m4v = "";

	if(isset($values['ogv'] ))
		$ogv = esc_attr($values['ogv'][0]);
	else
		$ogv = "";

	if(isset($values['video_width'] ))
		$video_width = esc_attr($values['video_width'][0]);
	else
		$video_width = "";

	if(isset($values['video_height'] ))
		$video_height = esc_attr($values['video_height'][0]);
	else
		$video_height = "";

	if(isset($values['embed_code'] ))
		$embed_code =  str_replace('\"', '"', urldecode($values['embed_code'][0]));
	else
		$embed_code = "";

	/* Sidebar Settings */
	if(isset($values['custom_sidebar_position']))
		$custom_sidebar_position = esc_attr($values['custom_sidebar_position'][0]);
	else
		$custom_sidebar_position = "off";

	$custom_sidebar_position = checked($custom_sidebar_position, 'on', false);

	if(isset($values['custom_sidebar']))
		$custom_sidebar = esc_attr($values['custom_sidebar'][0]);
	else
		$custom_sidebar = "off";

	$custom_sidebar = checked($custom_sidebar, 'on', false);

	if(isset($values['sidebar_position'])) {
		$sidebar_position = esc_attr($values['sidebar_position'][0]);
	} else {
		if(get_post_type() == 'post' && isset($mpcth_options) && isset($mpcth_options['mpcth_blog_post_sidebar']))
			$sidebar_position = $mpcth_options['mpcth_blog_post_sidebar'];
		elseif (get_post_type() == 'portfolio' && isset($mpcth_options) && isset($mpcth_options['mpcth_portfolio_post_sidebar']))
			$sidebar_position = $mpcth_options['mpcth_portfolio_post_sidebar'];
		elseif (is_page() && isset($mpcth_options) && isset($mpcth_options['mpcth_sidebar']))
			$sidebar_position = $mpcth_options['mpcth_sidebar'];
		else
			$sidebar_position = "right";
	}

	$sidebar_position_left = checked($sidebar_position, 'left', false);
	$sidebar_position_none = checked($sidebar_position, 'none', false);
	$sidebar_position_right = checked($sidebar_position, 'right', false);

	/* Post Preview */
	if(isset($values['display_in_single_view']))
		$display_in_single_view = esc_attr($values['display_in_single_view'][0]);
	else
		$display_in_single_view = "on";

	$display_in_single_view = checked($display_in_single_view, 'on', false);

	if(isset($values['featured_shortcode']))
		$featured_shortcode = esc_attr($values['featured_shortcode'][0]);
	else
		$featured_shortcode = "";

	/* HTML Markup */
	$box_output = '';

	$box_output .= '<div class="mpcth-of">';

	/* Post Settings */
	$box_output .=
		'<div class="mpcth-of-accordion-heading mpcth-of-post-settings"><h3>' . __('Post Settings', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content">';
		if($post_type == "portfolio") {
			$box_output .= '<div class="mpcth-of-section mpcth-of-section-select">'.
					'<h4>' . __('Post Size', 'mpcth') . '</h4>'.
					'<div class="mpcth-of-option">'.
						'<div class="mpcth-of-controls">'.
							'<select id="mpcth_otc_post_size" name="post_size" class="of-input">'.
								'<option value="1:1"' .(($post_size == '1:1') ? 'selected="selected"' : ''). '>' . __('1:1', 'mpcth') . '</option>'.
								'<option value="2:1"' .(($post_size == '2:1') ? 'selected="selected"' : ''). '>' . __('2:1', 'mpcth') . '</option>'.
								'<option value="1:2"' .(($post_size == '1:2') ? 'selected="selected"' : ''). '>' . __('1:2', 'mpcth') . '</option>'.
								'<option value="2:2"' .(($post_size == '2:2') ? 'selected="selected"' : ''). '>' . __('2:2', 'mpcth') . '</option>'.
							'</select>'.
							'<span class="mpcth-of-select-mockup"><span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span></span>'.
						'</div>'.
						'<div class="mpcth-of-explain">' . __('Choose portfolio post size.', 'mpcth') . '</div>'.
					'</div>'.
				'</div>';
		} else {
			$box_output .=	'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
					'<h4>' . __('Double Column Width', 'mpcth') . '</h4>'.
					'<div class="mpcth-of-option">'.
						'<div class="mpcth-of-controls">'.
							'<input type="checkbox" id="mpcth_otc_double_width_enabled" name="double_width_enabled" class="checkbox of-input"'.$double_width_enabled.'/>'.
							'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
						'</div>'.
						'<div class="mpcth-of-explain">' . __('Check this if you want to display this post in two columns.', 'mpcth') . '</div>'.
					'</div>'.
				'</div>';
		}

		$box_output .= '<div class="mpcth-of-section mpcth-of-section-select">'.
				'<h4>' . __('Background Type', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<select id="mpcth_otc_background_type" name="background_type" class="of-input">'.
							'<option value="default"' .(($background_type == 'default') ? 'selected="selected"' : ''). '>' . __('Default', 'mpcth') . '</option>'.
							'<option value="image"' .(($background_type == 'image') ? 'selected="selected"' : ''). '>' . __('Image', 'mpcth') . '</option>'.
							'<option value="embed"' .(($background_type == 'embed') ? 'selected="selected"' : ''). '>' . __('Embed (Vimeo, Yourube, Maps)', 'mpcth') . '</option>'.
							'<option value="none"' .(($background_type == 'none') ? 'selected="selected"' : ''). '>' . __('None', 'mpcth') . '</option>'.
						'</select>'.
						'<span class="mpcth-of-select-mockup"><span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Choose pagination type for your blog page.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text">'.
				'<h4>' . __('Background Source', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_background_embed_source" name="background_embed_source" class="of-input" value="'.$background_embed_source.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify background source. You can paste an image, Youtube or Vimeo URL.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-upload mpcth_custom_opt">'.
				'<h4>' . __('Background Source', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						mpcth_optionsframework_medialibrary_uploader( 'mpcth_otc_background_image_source', $background_image_source, null, '', 0, 'background_image_source', true ).
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify background source. You can paste an image, Youtube or Vimeo URL.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Repeat Pattern', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_background_image_pattern" name="background_image_pattern" class="checkbox of-input"'.$background_image_pattern.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to display this post in two columns.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Enable Content Toggler', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_background_toggler_enabled" name="background_toggler_enabled" class="checkbox of-input"'.$background_toggler_enabled.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to add content toggler to this page. It will let user show/hide page content to view page background.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Custom Post Size', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_custom_page_size" name="custom_page_size" class="checkbox of-input"'.$custom_page_size.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to set different page size for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-slider">'.
				'<h4>' . __('Post Size', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<div class="mpcth-of-slider" data-min="768" data-max="1920"></div><input id="mpcth_otc_page_size"  name="page_size" value="' .$page_size. '" style="visibility:hidden;" /><label>' .$page_size. '</label>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify page size in percents.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-select">'.
				'<h4>' . __('Post Align', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<select id="mpcth_otc_page_align" name="page_align" class="of-input">'.
							'<option value="default"' .(($page_align == 'default') ? 'selected="selected"' : ''). '>' . __('Default', 'mpcth') . '</option>'.
							'<option value="left"' .(($page_align == 'left') ? 'selected="selected"' : ''). '>' . __('Left', 'mpcth') . '</option>'.
							'<option value="center"' .(($page_align == 'center') ? 'selected="selected"' : ''). '>' . __('Center', 'mpcth') . '</option>'.
							'<option value="right"' .(($page_align == 'right') ? 'selected="selected"' : ''). '>' . __('Right', 'mpcth') . '</option>'.
						'</select>'.
						'<span class="mpcth-of-select-mockup"><span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Choose page alignment.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>';

	/* Sidebar Settings */
	$box_output .=
		'<div class="mpcth-of-accordion-heading mpcth-of-ac-open"><h3>' . __('Sidebar Settings', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content">'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Custom Sidebar Position', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_custom_sidebar_position" name="custom_sidebar_position" class="checkbox of-input"'.$custom_sidebar_position.'/>'.
						'<span class="mpcth-of-switcher">'.
							'<span class="mpcth-of-switcher-slide">'.
								'<span class="mpcth-of-switcher-thumb">| | |</span>'.
								'<span class="mpcth-of-switcher-on">ON</span>'.
								'<span class="mpcth-of-switcher-off">OFF</span>'.
							'</span>'.
						'</span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to use custom sidebar for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-sidebar">'.
				'<h4>' . __('Sidebar', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="radio" id="mpcth_otc_sidebar_right" name="sidebar_position" class="of-input of-radio" value="right" '.$sidebar_position_right.'>'.
						'<div class="mpcth-of-sb-right">'.
							'<span class="mpcth-of-sb-section-right"></span>'.
							'<span class="mpcth-of-sb-section-left"></span>'.
						'</div>'.
						'<input type="radio" id="mpcth_otc_sidebar_none" name="sidebar_position" class="of-input of-radio" value="none" '.$sidebar_position_none.'>'.
						'<div class="mpcth-of-sb-none">'.
							'<span class="mpcth-of-sb-section-right"></span>'.
							'<span class="mpcth-of-sb-section-left"></span>'.
						'</div>'.
						'<input type="radio" id="mpcth_otc_sidebar_left" name="sidebar_position" class="of-input of-radio" value="left" '.$sidebar_position_left.'>'.
						'<div class="mpcth-of-sb-left">'.
							'<span class="mpcth-of-sb-section-right"></span>'.
							'<span class="mpcth-of-sb-section-left"></span>'.
						'</div>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify sidebar position to this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Custom Sidebar', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_custom_sidebar" name="custom_sidebar" class="checkbox of-input"'.$custom_sidebar.'/>'.
						'<span class="mpcth-of-switcher">'.
							'<span class="mpcth-of-switcher-slide">'.
								'<span class="mpcth-of-switcher-thumb">| | |</span>'.
								'<span class="mpcth-of-switcher-on">ON</span>'.
								'<span class="mpcth-of-switcher-off">OFF</span>'.
							'</span>'.
						'</span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to use custom sidebar for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>';

	/* Top Widget Area Settings */
	$box_output .=
	'<div class="mpcth-of-accordion-heading"><h3>' . __('Top Widget Area Settings', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content">'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Hide Top Widget Area', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_hide_top_area" name="hide_top_area" class="checkbox of-input" '.$hide_top_area.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to hide top widget area for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Custom Top Widget Area', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_custom_top_area" name="custom_top_area" class="checkbox of-input" '.$custom_top_area.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to use custom top widget area for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-select">'.
				'<h4>' . __('Number of Custom Top Widget Area Columns', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<select id="mpcth_otc_top_area_columns" name="top_area_columns" class="of-input">'.
							'<option value="1"' .(($top_area_columns == '1') ? 'selected="selected"' : ''). '>1</option>'.
							'<option value="2"' .(($top_area_columns == '2') ? 'selected="selected"' : ''). '>2</option>'.
							'<option value="3"' .(($top_area_columns == '3') ? 'selected="selected"' : ''). '>3</option>'.
							'<option value="4"' .(($top_area_columns == '4') ? 'selected="selected"' : ''). '>4</option>'.
							'<option value="5"' .(($top_area_columns == '5') ? 'selected="selected"' : ''). '>5</option>'.
						'</select>'.
						'<span class="mpcth-of-select-mockup"><span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify number of columns in your custom top widget area.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>';

	/* Lightbox Settings */
	$box_output .=
		'<div class="mpcth-of-accordion-heading mpcth-of-lightbox-settings"><h3>' . __('Lightbox Settings', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content">'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Enable Lightbox', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_lightbox_enabled" name="lightbox_enabled" class="checkbox of-input"'.$lightbox_enabled.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to add lightbox preview of this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text">'.
				'<h4>' . __('Lightbox Caption', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_lightbox_caption" name="lightbox_caption" class="of-input" value="'.$lightbox_caption.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify lightbox description', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-upload">'.
				'<h4>' . __('Lightbox Source', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						mpcth_optionsframework_medialibrary_uploader( 'mpcth_otc_lightbox_source', $lightbox_source, null, '', 0, 'lightbox_source', true ).
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify lightbox source.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>';

	/* Post Preview */
	$box_output .=
		'<div class="mpcth-of-accordion-heading"><h3>' . __('Post Preview', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content mpcth-post-format-setup">'.
			// gallery post format
			'<div class="mpcth-of-section mpcth-of-section-upload mpcth-post-format-gallery">'.
				'<h4>' . __('Gallery Images', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input id="mpcth_otc_gallery_images_val" class="mpcth-gallery-images-val of-input upload" type="text" name="gallery_images_val" value="'.$gallery_images_val.'">'.
						'<input id="mpcth_otc_gallery_images_button" class="upload_gallery_button button mpcth-of-grey-button" type="button" value="'.($gallery_images_val == '' ? __('Select', 'mpcth') : __('Edit', 'mpcth')).'">'.
						'<div id="mpcth_otc_gallery_images_wrap" class="mpcth-gallery-images-wrap">'.$gallery_images.'</div>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Paste tweet embed code for more information please see help file.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			// status post format
			'<div class="mpcth-of-section mpcth-of-section-text mpcth-post-format-status">'.
				'<h4>' . __('Tweet URL', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_tweet_url" name="tweet_url" class="of-input" value="'.$tweet_url.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Paste tweet embed code for more information please see help file.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			// link post format
			'<div class="mpcth-of-section mpcth-of-section-text mpcth-post-format-link">'.
				'<h4>' . __('Link', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_link_url" name="link_url" class="of-input" value="'.$link_url.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Paste link you would like to share', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			// quote post format
			'<div class="mpcth-of-section mpcth-of-section-textarea-big mpcth-post-format-quote">'.
				'<h4>' . __('Quote', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<textarea id="mpcth_otc_quote" class="of-input" name="quote" rows="8">'.$quote.'</textarea>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify quote which will be dislayed at the top of your post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-textarea-big mpcth-post-format-quote">'.
				'<h4>' . __('Quote Author', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_quote_author" name="quote_author" class="of-input" value="'.$quote_author.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify quote author.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			// audio post format
			'<div class="mpcth-of-section mpcth-of-section-text mpcth-post-format-audio">'.
				'<h4>' . __('MP3 File URL', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_mp3" name="mp3" class="of-input" value="'.$mp3.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('URL to the MP3 file.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text mpcth-post-format-audio">'.
				'<h4>' . __('OGG File URL', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_ogg" name="ogg" class="of-input" value="'.$ogg.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('URL to the OGG file.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			// video post format
			'<div class="mpcth-of-section mpcth-of-section-text mpcth-post-format-video">'.
				'<h4>' . __('MP4 File URL', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_m4v" name="m4v" class="of-input" value="'.$m4v.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('URL to the M4V file.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text mpcth-post-format-video">'.
				'<h4>' . __('OGG File URL', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_ogv" name="ogv" class="of-input" value="'.$ogv.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('URL to the OGV file.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text mpcth-post-format-video">'.
				'<h4>' . __('Video Width', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_video_width" name="video_width" class="of-input" value="'.$video_width.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify width of your video.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text mpcth-post-format-video">'.
				'<h4>' . __('Video Height', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_video_height" name="video_height" class="of-input" value="'.$video_height.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify height of your video.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-textarea-big
			mpcth-post-format-video">'.
				'<h4>' . __('Video Embed Code', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<textarea id="mpcth_otc_embed_code" class="of-input" name="embed_code" rows="8">'.$embed_code.'</textarea>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('If your video is not self hosted you can paste here an embed code from Vimeo or Youtube.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			// displayed for all
			'<div class="mpcth-of-section mpcth-of-section-checkbox mpcth-post-format-all">'.
				'<h4>' . __('Display In Single View', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_display_in_single_view" name="display_in_single_view" class="checkbox of-input"'.$display_in_single_view.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('By enabling this option the featured image/featured shortcode will be displayed at the top of the post in single view.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>'.
	'</div>';

	echo $box_output;
}

function save_post_meta_box($post_id) {
	global $mpcth_sidebar_options;
	global $post;

	$id = isset($_POST['post_ID']) ? $_POST['post_ID'] : $post_id;

	// Bail if we're doing an auto save
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// if our nonce isn't there, or we can't verify it, bail
	if(!isset($_POST['post_meta_box_nonce']) || !wp_verify_nonce($_POST['post_meta_box_nonce'], 'mpc_post_meta_box_nonce')) return;

	// if our current user can't edit this post, bail
	if(!current_user_can('edit_post', $post->ID)) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['double_width_enabled']) && $_POST['double_width_enabled'])
		$double_width_enabled = 'on';
	else
		$double_width_enabled = 'off';

	update_post_meta($id, 'double_width_enabled', $double_width_enabled);

	if(isset($_POST['post_size']))
		update_post_meta($id, 'post_size', wp_kses($_POST['post_size'], $allowed));

	if(isset($_POST['post_prop']))
		update_post_meta($id, 'post_prop', wp_kses($_POST['post_prop'], $allowed));

	if(isset($_POST['background_type']))
		update_post_meta($id, 'background_type', wp_kses($_POST['background_type'], $allowed));

	if(isset($_POST['background_embed_source']))
		update_post_meta($id, 'background_embed_source', wp_kses($_POST['background_embed_source'], $allowed));

	if(isset($_POST['background_image_source']))
		update_post_meta($id, 'background_image_source', wp_kses($_POST['background_image_source'], $allowed));

	if(isset($_POST['background_image_pattern']) && $_POST['background_image_pattern'])
		$background_image_pattern = 'on';
	else
		$background_image_pattern = 'off';

	update_post_meta($id, 'background_image_pattern', $background_image_pattern);

	if(isset($_POST['background_toggler_enabled']) && $_POST['background_toggler_enabled'])
		$background_toggler_enabled = 'on';
	else
		$background_toggler_enabled = 'off';

	update_post_meta($id, 'background_toggler_enabled', $background_toggler_enabled);

	if(isset($_POST['page_size']))
		update_post_meta($id, 'page_size', wp_kses($_POST['page_size'], $allowed));

	if(isset($_POST['page_align']))
		update_post_meta($id, 'page_align', wp_kses($_POST['page_align'], $allowed));

	if(isset($_POST['custom_page_size']) && $_POST['custom_page_size'])
		$custom_page_size = 'on';
	else
		$custom_page_size = 'off';

	update_post_meta($id, 'custom_page_size', $custom_page_size);

	if(isset($_POST['lightbox_enabled']) && $_POST['lightbox_enabled'])
		$lightbox_enabled = 'on';
	else
		$lightbox_enabled = 'off';

	update_post_meta($id, 'lightbox_enabled', $lightbox_enabled);

	if(isset($_POST['display_in_single_view']) && $_POST['display_in_single_view'])
		$display_in_single_view = 'on';
	else
		$display_in_single_view = 'off';

	update_post_meta($id, 'display_in_single_view', $display_in_single_view);

	if(isset($_POST['lightbox_caption']))
		update_post_meta($id, 'lightbox_caption', wp_kses($_POST['lightbox_caption'], $allowed));

	if(isset($_POST['lightbox_source']))
		update_post_meta($id, 'lightbox_source', wp_kses($_POST['lightbox_source'], $allowed));

	if(isset($_POST['gallery_images_val']))
		update_post_meta($id, 'gallery_images_val', wp_kses($_POST['gallery_images_val'], $allowed));

	if(isset($_POST['tweet_url']))
		update_post_meta($id, 'tweet_url', $_POST['tweet_url']);

	if(isset($_POST['link_url']))
		update_post_meta($id, 'link_url', $_POST['link_url']);

	if(isset($_POST['quote']))
		update_post_meta($id, 'quote', $_POST['quote']);

	if(isset($_POST['quote_author']))
		update_post_meta($id, 'quote_author', $_POST['quote_author']);

	if(isset($_POST['mp3']))
		update_post_meta($id, 'mp3', $_POST['mp3']);

	if(isset($_POST['ogg']))
		update_post_meta($id, 'ogg', $_POST['ogg']);

	if(isset($_POST['m4v']))
		update_post_meta($id, 'm4v', $_POST['m4v']);

	if(isset($_POST['ogv']))
		update_post_meta($id, 'ogv', $_POST['ogv']);

	if(isset($_POST['video_width']))
		update_post_meta($id, 'video_width', $_POST['video_width']);

	if(isset($_POST['video_height']))
		update_post_meta($id, 'video_height', $_POST['video_height']);

	// if(isset($_POST['embed_code']))
	// 	update_post_meta($id, 'embed_code', $_POST['embed_code']);

	if(isset($_POST['featured_shortcode']))
		update_post_meta($id, 'featured_shortcode', wp_kses($_POST['featured_shortcode'], $allowed));

	update_option('mpcth_sidebar_options', $mpcth_sidebar_options);

	if(isset($_POST['hide_top_area']) && $_POST['hide_top_area'])
		$hide_top_area = 'on';
	else
		$hide_top_area = 'off';

	update_post_meta($id, 'hide_top_area', $hide_top_area);

	if(isset($_POST['custom_top_area']) && $_POST['custom_top_area'])
		$custom_top_area = 'on';
	else
		$custom_top_area = 'off';

	update_post_meta($id, 'custom_top_area', $custom_top_area);

	if(isset($_POST['top_area_columns']))
		update_post_meta($id, 'top_area_columns', wp_kses($_POST['top_area_columns'], $allowed));

	if(isset($_POST['custom_sidebar_position']) && $_POST['custom_sidebar_position'])
		$custom_sidebar_position = 'on';
	else
		$custom_sidebar_position = 'off';

	update_post_meta($id, 'custom_sidebar_position', $custom_sidebar_position);

	if(isset($_POST['sidebar_position'])) {
		update_post_meta($id, 'sidebar_position', wp_kses($_POST['sidebar_position'], $allowed));

		if($_POST['sidebar_position'] != 'none') {
			if(isset($_POST['custom_sidebar']) && $_POST['custom_sidebar'])
				$custom_sidebar = 'on';
			else
				$custom_sidebar = 'off';
		} else {
			$custom_sidebar = 'off';
		}

		update_post_meta($id, 'custom_sidebar', $custom_sidebar);
	}

	if(isset($mpcth_sidebar_options['custom_sidebars'])) {
		if($custom_top_area == 'on')
			$mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $id] = $id;
		else
			if(isset($mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $id]))
				unset($mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $id]);

		if($custom_sidebar == 'on')
			$mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $id] = $id;
		else
			if(isset($mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $id]))
				unset($mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $id]);
	} else {
		$mpcth_sidebar_options['custom_sidebars'] = array();
		$mpcth_sidebar_options['custom_sidebars']['sidebar'] = array();
		$mpcth_sidebar_options['custom_sidebars']['top_area'] = array();

		if($custom_top_area == 'on')
			$mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $id] = $id;

		if($custom_sidebar == 'on')
			$mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $id] = $id;
	}
}

add_action('save_post', 'save_post_meta_box');

/* ---------------------------------------------------------------- */
/*	Page Settings
/* ---------------------------------------------------------------- */

function page_meta_box($post) {
	global $mpcth_options;
	global $template_file;

	wp_nonce_field('mpc_page_meta_box_nonce', 'page_meta_box_nonce');

	$values = get_post_custom($post->ID);

	/* Top Widget Area Settings */
	if(isset($values['hide_top_area']))
		$hide_top_area = esc_attr($values['hide_top_area'][0]);
	else
		$hide_top_area = "off";

	$hide_top_area = checked($hide_top_area, 'on', false);

	if(isset($values['custom_top_area']))
		$custom_top_area = esc_attr($values['custom_top_area'][0]);
	else
		$custom_top_area = "off";

	$custom_top_area = checked($custom_top_area, 'on', false);

	if(isset($values['top_area_columns'])) {
		$top_area_columns = esc_attr($values['top_area_columns'][0]);
	} else {
		$top_area_columns = "3";
	}

	/* Background Settings */
	if(isset($values['background_type']))
		$background_type = esc_attr($values['background_type'][0]);
	else
		$background_type = "default";

	if(isset($values['background_embed_source']))
		$background_embed_source = esc_attr($values['background_embed_source'][0]);
	else
		$background_embed_source = "";

	if(isset($values['background_image_source']))
		$background_image_source = esc_attr($values['background_image_source'][0]);
	else
		$background_image_source = "";

	if(isset($values['background_image_pattern']))
		$background_image_pattern = esc_attr($values['background_image_pattern'][0]);
	else
		$background_image_pattern = "off";

	$background_image_pattern = checked($background_image_pattern, 'on', false);

	if(isset($values['background_toggler_enabled']))
		$background_toggler_enabled = esc_attr($values['background_toggler_enabled'][0]);
	else
		$background_toggler_enabled = "off";

	$background_toggler_enabled = checked($background_toggler_enabled, 'on', false);

	if(isset($values['custom_page_size']))
		$custom_page_size = esc_attr($values['custom_page_size'][0]);
	else
		$custom_page_size = "off";

	$custom_page_size = checked($custom_page_size, 'on', false);

	if(isset($values['page_size']))
		$page_size = esc_attr($values['page_size'][0]);
	else
		$page_size = "960px";

	if(isset($values['page_align']))
		$page_align = esc_attr($values['page_align'][0]);
	else
		$page_align = "default";

	/* Sidebar Settings */
	if(isset($values['custom_sidebar_position']))
		$custom_sidebar_position = esc_attr($values['custom_sidebar_position'][0]);
	else
		$custom_sidebar_position = "off";

	$custom_sidebar_position = checked($custom_sidebar_position, 'on', false);

	if(isset($values['custom_sidebar']))
		$custom_sidebar = esc_attr($values['custom_sidebar'][0]);
	else
		$custom_sidebar = "off";

	$custom_sidebar = checked($custom_sidebar, 'on', false);

	if(isset($values['sidebar_position'])) {
		$sidebar_position = esc_attr($values['sidebar_position'][0]);
	} else {
		if(get_post_type() == 'post' && isset($mpcth_options) && isset($mpcth_options['mpcth_blog_post_sidebar']))
			$sidebar_position = $mpcth_options['mpcth_blog_post_sidebar'];
		elseif (get_post_type() == 'portfolio' && isset($mpcth_options) && isset($mpcth_options['mpcth_portfolio_post_sidebar']))
			$sidebar_position = $mpcth_options['mpcth_portfolio_post_sidebar'];
		elseif (is_page() && isset($mpcth_options) && isset($mpcth_options['mpcth_sidebar']))
			$sidebar_position = $mpcth_options['mpcth_sidebar'];
		else
			$sidebar_position = "right";
	}

	$sidebar_position_left = checked($sidebar_position, 'left', false);
	$sidebar_position_none = checked($sidebar_position, 'none', false);
	$sidebar_position_right = checked($sidebar_position, 'right', false);

	/* HTML Markup */
	$box_output = '';

	$box_output .= '<div class="mpcth-of">';

	/* Page Settings */
	$box_output .=
		'<div class="mpcth-of-accordion-heading mpcth-of-section-default-page"><h3>' . __('Layout Settings', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content">'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox mpcth-of-section-default-page">'.
				'<h4>' . __('Custom Post Size', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_custom_page_size" name="custom_page_size" class="checkbox of-input"'.$custom_page_size.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to set different page size for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-slider mpcth-of-section-default-page">'.
				'<h4>' . __('Post Size', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<div class="mpcth-of-slider" data-min="768" data-max="1920"></div><input id="mpcth_otc_page_size"  name="page_size" value="' .$page_size. '" style="visibility:hidden;" /><label>' .$page_size. '</label>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify page size in percents.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-select mpcth-of-section-default-page">'.
				'<h4>' . __('Post Align', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<select id="mpcth_otc_page_align" name="page_align" class="of-input">'.
							'<option value="default"' .(($page_align == 'default') ? 'selected="selected"' : ''). '>' . __('Default', 'mpcth') . '</option>'.
							'<option value="left"' .(($page_align == 'left') ? 'selected="selected"' : ''). '>' . __('Left', 'mpcth') . '</option>'.
							'<option value="center"' .(($page_align == 'center') ? 'selected="selected"' : ''). '>' . __('Center', 'mpcth') . '</option>'.
							'<option value="right"' .(($page_align == 'right') ? 'selected="selected"' : ''). '>' . __('Right', 'mpcth') . '</option>'.
						'</select>'.
						'<span class="mpcth-of-select-mockup"><span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Choose page alignment.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>';

	/* Sidebar Settings */
	$box_output .=
		'<div class="mpcth-of-accordion-heading mpcth-of-section-sidebar"><h3>' . __('Sidebar Settings', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content mpcth-of-section-sidebar">'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Custom Sidebar Position', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_custom_sidebar_position" name="custom_sidebar_position" class="checkbox of-input"'.$custom_sidebar_position.'/>'.
						'<span class="mpcth-of-switcher">'.
							'<span class="mpcth-of-switcher-slide">'.
								'<span class="mpcth-of-switcher-thumb">| | |</span>'.
								'<span class="mpcth-of-switcher-on">ON</span>'.
								'<span class="mpcth-of-switcher-off">OFF</span>'.
							'</span>'.
						'</span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to use custom sidebar for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-sidebar">'.
				'<h4>' . __('Sidebar', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="radio" id="mpcth_otc_sidebar_right" name="sidebar_position" class="of-input of-radio" value="right" '.$sidebar_position_right.'>'.
						'<div class="mpcth-of-sb-right">'.
							'<span class="mpcth-of-sb-section-right"></span>'.
							'<span class="mpcth-of-sb-section-left"></span>'.
						'</div>'.
						'<input type="radio" id="mpcth_otc_sidebar_none" name="sidebar_position" class="of-input of-radio" value="none" '.$sidebar_position_none.'>'.
						'<div class="mpcth-of-sb-none">'.
							'<span class="mpcth-of-sb-section-right"></span>'.
							'<span class="mpcth-of-sb-section-left"></span>'.
						'</div>'.
						'<input type="radio" id="mpcth_otc_sidebar_left" name="sidebar_position" class="of-input of-radio" value="left" '.$sidebar_position_left.'>'.
						'<div class="mpcth-of-sb-left">'.
							'<span class="mpcth-of-sb-section-right"></span>'.
							'<span class="mpcth-of-sb-section-left"></span>'.
						'</div>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify sidebar position to this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Custom Sidebar', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_custom_sidebar" name="custom_sidebar" class="checkbox of-input"'.$custom_sidebar.'/>'.
						'<span class="mpcth-of-switcher">'.
							'<span class="mpcth-of-switcher-slide">'.
								'<span class="mpcth-of-switcher-thumb">| | |</span>'.
								'<span class="mpcth-of-switcher-on">ON</span>'.
								'<span class="mpcth-of-switcher-off">OFF</span>'.
							'</span>'.
						'</span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to use custom sidebar for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>';

	/* Top Widget Area Settings */
	$box_output .=
	'<div class="mpcth-of-accordion-heading"><h3>' . __('Top Widget Area Settings', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content">'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Hide Top Widget Area', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_hide_top_area" name="hide_top_area" class="checkbox of-input" '.$hide_top_area.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to hide top widget area for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Custom Top Widget Area', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_custom_top_area" name="custom_top_area" class="checkbox of-input" '.$custom_top_area.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to use custom top widget area for this post.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-select">'.
				'<h4>' . __('Number of Custom Top Widget Area Columns', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<select id="mpcth_otc_top_area_columns" name="top_area_columns" class="of-input">'.
							'<option value="1"' .(($top_area_columns == '1') ? 'selected="selected"' : ''). '>1</option>'.
							'<option value="2"' .(($top_area_columns == '2') ? 'selected="selected"' : ''). '>2</option>'.
							'<option value="3"' .(($top_area_columns == '3') ? 'selected="selected"' : ''). '>3</option>'.
							'<option value="4"' .(($top_area_columns == '4') ? 'selected="selected"' : ''). '>4</option>'.
							'<option value="5"' .(($top_area_columns == '5') ? 'selected="selected"' : ''). '>5</option>'.
						'</select>'.
						'<span class="mpcth-of-select-mockup"><span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify number of columns in your custom top widget area.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>';

	/* Background Settings */
	$box_output .=
		'<div class="mpcth-of-accordion-heading"><h3>' . __('Background Settings', 'mpcth') . '</h3><span class="mpcth-of-circle"><span></span></span></div>'.
		'<div class="mpcth-of-accordion-content">'.
			'<div class="mpcth-of-section mpcth-of-section-select">'.
				'<h4>' . __('Background Type', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<select id="mpcth_otc_background_type" name="background_type" class="of-input">'.
							'<option value="default"' .(($background_type == 'default') ? 'selected="selected"' : ''). '>' . __('Default', 'mpcth') . '</option>'.
							'<option value="image"' .(($background_type == 'image') ? 'selected="selected"' : ''). '>' . __('Image', 'mpcth') . '</option>'.
							'<option value="embed"' .(($background_type == 'embed') ? 'selected="selected"' : ''). '>' . __('Embed (Vimeo, Yourube, Maps)', 'mpcth') . '</option>'.
							'<option value="none"' .(($background_type == 'none') ? 'selected="selected"' : ''). '>' . __('None', 'mpcth') . '</option>'.
						'</select>'.
						'<span class="mpcth-of-select-mockup"><span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Choose pagination type for your blog page.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text">'.
				'<h4>' . __('Background Source', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_background_embed_source" name="background_embed_source" class="of-input" value="'.$background_embed_source.'">'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify background source. You can paste an image, Youtube or Vimeo URL.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-upload mpcth_custom_opt">'.
				'<h4>' . __('Background Source', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						mpcth_optionsframework_medialibrary_uploader( 'mpcth_otc_background_image_source', $background_image_source, null, '', 0, 'background_image_source', true ).
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify background source. You can paste an image, Youtube or Vimeo URL.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Repeat Pattern', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_background_image_pattern" name="background_image_pattern" class="checkbox of-input"'.$background_image_pattern.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to display this post in two columns.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Enable Content Toggler', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_background_toggler_enabled" name="background_toggler_enabled" class="checkbox of-input"'.$background_toggler_enabled.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to add content toggler to this page. It will let user show/hide page content to view page background.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>'.
	'</div>';

	echo $box_output;
}

function save_page_meta_box($post_id) {
	global $post;
	global $mpcth_sidebar_options;

	$id = isset($_POST['post_ID']) ? $_POST['post_ID'] : $post_id;

	// Bail if we're doing an auto save
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// if our nonce isn't there, or we can't verify it, bail
	if(!isset($_POST['page_meta_box_nonce']) || !wp_verify_nonce($_POST['page_meta_box_nonce'], 'mpc_page_meta_box_nonce')) return;

	// if our current user can't edit this post, bail
	if(!current_user_can('edit_post', $post->ID)) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['background_type']))
		update_post_meta($id, 'background_type', wp_kses($_POST['background_type'], $allowed));

	if(isset($_POST['background_embed_source']))
		update_post_meta($id, 'background_embed_source', wp_kses($_POST['background_embed_source'], $allowed));

	if(isset($_POST['background_image_source']))
		update_post_meta($id, 'background_image_source', wp_kses($_POST['background_image_source'], $allowed));

	if(isset($_POST['background_image_pattern']) && $_POST['background_image_pattern'])
		$background_image_pattern = 'on';
	else
		$background_image_pattern = 'off';

	update_post_meta($id, 'background_image_pattern', $background_image_pattern);

	if(isset($_POST['background_toggler_enabled']) && $_POST['background_toggler_enabled'])
		$background_toggler_enabled = 'on';
	else
		$background_toggler_enabled = 'off';

	update_post_meta($id, 'background_toggler_enabled', $background_toggler_enabled);

	if(isset($_POST['custom_page_size']) && $_POST['custom_page_size'])
		$custom_page_size = 'on';
	else
		$custom_page_size = 'off';

	update_post_meta($id, 'custom_page_size', $custom_page_size);

	if(isset($_POST['page_size']))
		update_post_meta($id, 'page_size', wp_kses($_POST['page_size'], $allowed));

	if(isset($_POST['page_align']))
		update_post_meta($id, 'page_align', wp_kses($_POST['page_align'], $allowed));

	if(isset($_POST['custom_sidebar_position']) && $_POST['custom_sidebar_position'])
		$custom_sidebar_position = 'on';
	else
		$custom_sidebar_position = 'off';

	update_post_meta($id, 'custom_sidebar_position', $custom_sidebar_position);

	if(isset($_POST['sidebar_position'])) {
		update_post_meta($id, 'sidebar_position', wp_kses($_POST['sidebar_position'], $allowed));

		if($_POST['sidebar_position'] != 'none') {
			if(isset($_POST['custom_sidebar']) && $_POST['custom_sidebar'])
				$custom_sidebar = 'on';
			else
				$custom_sidebar = 'off';
		} else {
			$custom_sidebar = 'off';
		}

		update_post_meta($id, 'custom_sidebar', $custom_sidebar);
	}

	if(isset($_POST['hide_top_area']) && $_POST['hide_top_area'])
		$hide_top_area = 'on';
	else
		$hide_top_area = 'off';

	update_post_meta($id, 'hide_top_area', $hide_top_area);

	if(isset($_POST['custom_top_area']) && $_POST['custom_top_area'])
		$custom_top_area = 'on';
	else
		$custom_top_area = 'off';

	update_post_meta($id, 'custom_top_area', $custom_top_area);
	
	if(isset($_POST['custom_footer']) && $_POST['custom_footer'])
		$custom_footer = 'on';
	else
		$custom_footer = 'off';

	update_post_meta($id, 'custom_top_area', $custom_top_area);

	if(isset($_POST['top_area_columns']))
		update_post_meta($id, 'top_area_columns', wp_kses($_POST['top_area_columns'], $allowed));

	if(isset($mpcth_sidebar_options['custom_sidebars'])) {
		if($custom_top_area == 'on')
			$mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $id] = $id;
		else
			if(isset($mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $id]))
				unset($mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $id]);

		if($custom_sidebar == 'on')
			$mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $id] = $id;
		else
			if(isset($mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $id]))
				unset($mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $id]);
	} else {
		$mpcth_sidebar_options['custom_sidebars'] = array();
		$mpcth_sidebar_options['custom_sidebars']['sidebar'] = array();
		$mpcth_sidebar_options['custom_sidebars']['top_area'] = array();

		if($custom_footer == 'on')
			$mpcth_sidebar_options['custom_sidebars']['footer']['id_' . $id] = $id;

		if($custom_top_area == 'on')
			$mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $id] = $id;

		if($custom_sidebar == 'on')
			$mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $id] = $id;
	}

	update_option('mpcth_sidebar_options', $mpcth_sidebar_options);
}

add_action('save_post', 'save_page_meta_box');

/* ---------------------------------------------------------------- */
/*	Blog Settings
/* ---------------------------------------------------------------- */

function blog_meta_box($post) {
	wp_nonce_field('mpc_blog_meta_box_nonce', 'blog_meta_box_nonce');

	$values = get_post_custom($post->ID);

	/* Blog Settings */
	$blog_categories = get_categories();

	$blog_type = "masonry";

	if(isset($values['blog_pagination'])) {
		$blog_pagination = esc_attr($values['blog_pagination'][0]);
	} else {
		$blog_pagination = "standard";
	}

	if(isset($values['blog_lm_info']))
		$blog_lm_info = esc_attr($values['blog_lm_info'][0]);
	else
		$blog_lm_info = "off";

	$blog_lm_info = checked($blog_lm_info, 'on', false);

	if(isset($values['blog_category_filter']))
		$blog_category_filter = esc_attr($values['blog_category_filter'][0]);
	else
		$blog_category_filter = "on";

	$blog_category_filter = checked($blog_category_filter, 'on', false);

	$category_values = array();

	if(isset($values['blog_cat']))
		$values['blog_cat'] = unserialize($values['blog_cat'][0]);
	else
		$values['blog_cat'] = array();

	foreach($blog_categories as $cat) {
		if(isset($values['blog_cat'][$cat->slug]))
			$category_values[$cat->slug] = esc_attr($values['blog_cat'][$cat->slug]);
		else
			$category_values[$cat->slug] = "on";

		$category_values[$cat->slug] = checked($category_values[$cat->slug], 'on', false);
	}

	if(isset($values['blog_post_max_width'])) {
		$blog_post_max_width = esc_attr($values['blog_post_max_width'][0]);
	} else {
		$blog_post_max_width = "500";
	}

	if(isset($values['blog_post_min_width'])) {
		$blog_post_min_width = esc_attr($values['blog_post_min_width'][0]);
	} else {
		$blog_post_min_width = "300";
	}

	/* HTML Markup */
	$box_output = '';

	$box_output .= '<div class="mpcth-of">';

	$box_output .=
		'<div class="mpcth-of-accordion-content">'.
			'<div class="mpcth-of-section mpcth-of-section-text">'.
				'<h4>' . __('Post Max Width', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_blog_post_max_width" name="blog_post_max_width" class="checkbox of-input" value="'.$blog_post_max_width.'"/>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify maximal width of post displayed in masonry layout. We recommend setting it twice the minimum width.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text">'.
				'<h4>' . __('Post Min Width', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_blog_post_min_width" name="blog_post_min_width" class="checkbox of-input" value="'.$blog_post_min_width.'"/>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify minimal width of post displayed in masonry layout. We don\'t recommend setting it below 300.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Load More Info', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_blog_lm_info" name="blog_lm_info" class="checkbox of-input" '.$blog_lm_info.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check it if you want to display load more informations (loaded posts/all posts).', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Enable Category Filter', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_blog_category_filter" name="blog_category_filter" class="checkbox of-input" '.$blog_category_filter.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to add categories filter.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-radio mpcth-of-section-checkbox-multiple">'.
				'<h4>' . __('Choose Categories', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">';

						foreach($blog_categories as $cat) {
							$box_output .= '<input class="of-input of-checkbox" '.$category_values[$cat->slug].' type="checkbox" name="blog_cat-'.$cat->slug.'" id="blog_cat-'.$cat->slug.'" value="'.$cat->slug.'">';
							$box_output .= '<label for="blog_cat-'.$cat->slug.'"><span></span>'.$cat->name.'</label>';
						}

					$box_output .= '</div>'.
					'<div class="mpcth-of-explain">' . __('Choose which categories will be displayed in category filter.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>'.
	'</div>';

	echo $box_output;
}

function save_blog_meta_box($post_id) {
	global $post;

	$id = isset($_POST['post_ID']) ? $_POST['post_ID'] : $post_id;

	// Bail if we're doing an auto save
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// if our nonce isn't there, or we can't verify it, bail
	if(!isset($_POST['blog_meta_box_nonce']) || !wp_verify_nonce($_POST['blog_meta_box_nonce'], 'mpc_blog_meta_box_nonce')) return;

	// if our current user can't edit this post, bail
	if(!current_user_can('edit_post', $post->ID)) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['blog_category_filter']) && $_POST['blog_category_filter'])
		$blog_category_filter = 'on';
	else
		$blog_category_filter = 'off';

	update_post_meta($id, 'blog_category_filter', $blog_category_filter);

	$blog_categories = get_categories();
	$category_values = array();

	foreach($blog_categories as $cat) {

		if(isset($_POST['blog_cat-'.$cat->slug]) && $_POST['blog_cat-'.$cat->slug])
			$category_values[$cat->slug] = 'on';
		else
			$category_values[$cat->slug] = 'off';

		update_post_meta($id, 'blog_cat', $category_values);
	}

	if(isset($_POST['blog_lm_info']) && $_POST['blog_lm_info'])
		$blog_lm_info = 'on';
	else
		$blog_lm_info = 'off';

	update_post_meta($id, 'blog_lm_info', $blog_lm_info);

	if(isset($_POST['blog_type']))
		update_post_meta($id, 'blog_type', wp_kses('masonry', $allowed));

	if(isset($_POST['blog_pagination']))
		update_post_meta($id, 'blog_pagination', wp_kses($_POST['blog_pagination'], $allowed));

	if(isset($_POST['blog_post_max_width']))
		update_post_meta($id, 'blog_post_max_width', wp_kses($_POST['blog_post_max_width'], $allowed));

	if(isset($_POST['blog_post_min_width']))
		update_post_meta($id, 'blog_post_min_width', wp_kses($_POST['blog_post_min_width'], $allowed));
}
add_action('save_post', 'save_blog_meta_box');

/* ---------------------------------------------------------------- */
/*	Portfolio Settings
/* ---------------------------------------------------------------- */

function portfolio_meta_box($post) {
	wp_nonce_field('mpc_portfolio_meta_box_nonce', 'portfolio_meta_box_nonce');

	$values = get_post_custom($post->ID);

	/* portfolio Settings */
	$portfolio_categories = get_categories(array(
                   				'taxonomy' => 'mpcth_portfolio_category',
                    			'hide_empty' => 1
                     		));

	$portfolio_type = "masonry";

	if(isset($values['portfolio_pagination'])) {
		$portfolio_pagination = esc_attr($values['portfolio_pagination'][0]);
	} else {
		$portfolio_pagination = "standard";
	}

	if(isset($values['post_prop']))
		$post_prop = esc_attr($values['post_prop'][0]);
	else
		$post_prop = "rectangle";

	if(isset($values['portfolio_lm_info']))
		$portfolio_lm_info = esc_attr($values['portfolio_lm_info'][0]);
	else
		$portfolio_lm_info = "off";

	$portfolio_lm_info = checked($portfolio_lm_info, 'on', false);

	if(isset($values['portfolio_category_filter']))
		$portfolio_category_filter = esc_attr($values['portfolio_category_filter'][0]);
	else
		$portfolio_category_filter = "on";

	$portfolio_category_filter = checked($portfolio_category_filter, 'on', false);

	$category_values = array();

	if(isset($values['portfolio_cat'][0]))
		$values['portfolio_cat'] = unserialize($values['portfolio_cat'][0]);

	foreach($portfolio_categories as $cat) {
		if(isset($values['portfolio_cat'][$cat->slug]))
			$category_values[$cat->slug] = esc_attr($values['portfolio_cat'][$cat->slug]);
		else
			$category_values[$cat->slug] = "on";

		$category_values[$cat->slug] = checked($category_values[$cat->slug], 'on', false);
	}

	if(isset($values['portfolio_post_display'])) {
		$portfolio_post_display = esc_attr($values['portfolio_post_display'][0]);
	} else {
		$portfolio_post_display = "10";
	}

	if(isset($values['portfolio_post_max_width'])) {
		$portfolio_post_max_width = esc_attr($values['portfolio_post_max_width'][0]);
	} else {
		$portfolio_post_max_width = "500";
	}

	if(isset($values['portfolio_post_min_width'])) {
		$portfolio_post_min_width = esc_attr($values['portfolio_post_min_width'][0]);
	} else {
		$portfolio_post_min_width = "300";
	}

	if(isset($values['portfolio_link_item']))
		$portfolio_link_item = esc_attr($values['portfolio_link_item'][0]);
	else
		$portfolio_link_item = "on";

	$portfolio_link_item = checked($portfolio_link_item, 'on', false);

	if(isset($values['portfolio_remove_frame']))
		$portfolio_remove_frame = esc_attr($values['portfolio_remove_frame'][0]);
	else
		$portfolio_remove_frame = "off";

	$portfolio_remove_frame = checked($portfolio_remove_frame, 'on', false);

	/* HTML Markup */
	$box_output = '';

	$box_output .= '<div class="mpcth-of">';

	$box_output .=
		'<div class="mpcth-of-accordion-content">'.
			'<div class="mpcth-of-section mpcth-of-section-select">'.
					'<h4>' . __('Posts Proportion', 'mpcth') . '</h4>'.
					'<div class="mpcth-of-option">'.
						'<div class="mpcth-of-controls">'.
							'<select id="mpcth_otc_post_prop" name="post_prop" class="of-input">'.
								'<option value="rectangle"' .(($post_prop == 'rectangle') ? 'selected="selected"' : ''). '>' . __('rectangle', 'mpcth') . '</option>'.
								'<option value="square"' .(($post_prop == 'square') ? 'selected="selected"' : ''). '>' . __('square', 'mpcth') . '</option>'.
							'</select>'.
							'<span class="mpcth-of-select-mockup"><span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span></span>'.
						'</div>'.
						'<div class="mpcth-of-explain">' . __('Choose portfolio post proportions.', 'mpcth') . '</div>'.
					'</div>'.
				'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text">'.
				'<h4>' . __('Post To Display', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_portfolio_post_display" name="portfolio_post_display" class="checkbox of-input" value="'.$portfolio_post_display.'"/>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify how many posts you would like to display per page/load.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text">'.
				'<h4>' . __('Post Max Width', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_portfolio_post_max_width" name="portfolio_post_max_width" class="checkbox of-input" value="'.$portfolio_post_max_width.'"/>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify maximal width of post displayed in masonry layout. We recommend setting it twice the minimum width.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-text">'.
				'<h4>' . __('Post Min Width', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="text" id="mpcth_otc_portfolio_post_min_width" name="portfolio_post_min_width" class="checkbox of-input" value="'.$portfolio_post_min_width.'"/>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Specify minimal width of post displayed in masonry layout. We don\'t recommend setting it below 300.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Load More Info', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_portfolio_lm_info" name="portfolio_lm_info" class="checkbox of-input" '.$portfolio_lm_info.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check it if you want to display load more informations (loaded posts/all posts).', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-checkbox">'.
				'<h4>' . __('Enable Category Filter', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">'.
						'<input type="checkbox" id="mpcth_otc_portfolio_category_filter" name="portfolio_category_filter" class="checkbox of-input" '.$portfolio_category_filter.'/>'.
						'<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>'.
					'</div>'.
					'<div class="mpcth-of-explain">' . __('Check this if you want to add categories filter.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
			'<div class="mpcth-of-section mpcth-of-section-radio mpcth-of-section-checkbox-multiple">'.
				'<h4>' . __('Choose Categories', 'mpcth') . '</h4>'.
				'<div class="mpcth-of-option">'.
					'<div class="mpcth-of-controls">';
						foreach($portfolio_categories as $cat) {
							$box_output .= '<input class="of-input of-checkbox" '.$category_values[$cat->slug].' type="checkbox" name="portfolio_cat-'.$cat->slug.'" id="portfolio_cat-'.$cat->slug.'" value="'.$cat->slug.'">';
							$box_output .= '<label for="portfolio_cat-'.$cat->slug.'"><span></span>'.$cat->name.'</label>';
						}
					$box_output .= '</div>'.
					'<div class="mpcth-of-explain">' . __('Choose which categories will be displayed in category filter.', 'mpcth') . '</div>'.
				'</div>'.
			'</div>'.
		'</div>'.
	'</div>';

	echo $box_output;
}

function save_portfolio_meta_box($post_id) {
	global $post;
	$id = isset($_POST['post_ID']) ? $_POST['post_ID'] : $post_id;

	// Bail if we're doing an auto save
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// if our nonce isn't there, or we can't verify it, bail
	if(!isset($_POST['portfolio_meta_box_nonce']) || !wp_verify_nonce($_POST['portfolio_meta_box_nonce'], 'mpc_portfolio_meta_box_nonce')) return;

	// if our current user can't edit this post, bail
	if(!current_user_can('edit_post', $post->ID)) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['portfolio_category_filter']) && $_POST['portfolio_category_filter'])
		$portfolio_category_filter = 'on';
	else
		$portfolio_category_filter = 'off';

	update_post_meta($id, 'portfolio_category_filter', $portfolio_category_filter);

	$portfolio_categories = get_categories(array(
                   				'taxonomy' => 'mpcth_portfolio_category',
                    			'hide_empty' => 1
                     		));

	$category_values = array();

	foreach($portfolio_categories as $cat) {

		if(isset($_POST['portfolio_cat-'.$cat->slug]) && $_POST['portfolio_cat-'.$cat->slug])
			$category_values[$cat->slug] = 'on';
		else
			$category_values[$cat->slug] = 'off';

		update_post_meta($id, 'portfolio_cat', $category_values);
	}

	if(isset($_POST['portfolio_lm_info']) && $_POST['portfolio_lm_info'])
		$portfolio_lm_info = 'on';
	else
		$portfolio_lm_info = 'off';

	update_post_meta($id, 'portfolio_lm_info', $portfolio_lm_info);

	if(isset($_POST['post_prop']))
		update_post_meta($id, 'post_prop', wp_kses($_POST['post_prop'], $allowed));

	if(isset($_POST['portfolio_post_display']))
		update_post_meta($id, 'portfolio_post_display', wp_kses($_POST['portfolio_post_display'], $allowed));

	if(isset($_POST['portfolio_type']))
		update_post_meta($id, 'portfolio_type', wp_kses('masonry', $allowed));

	if(isset($_POST['portfolio_pagination']))
		update_post_meta($id, 'portfolio_pagination', wp_kses($_POST['portfolio_pagination'], $allowed));

	if(isset($_POST['portfolio_post_max_width']))
		update_post_meta($id, 'portfolio_post_max_width', wp_kses($_POST['portfolio_post_max_width'], $allowed));

	if(isset($_POST['portfolio_post_min_width']))
		update_post_meta($id, 'portfolio_post_min_width', wp_kses($_POST['portfolio_post_min_width'], $allowed));

	if(isset($_POST['portfolio_link_item']) && $_POST['portfolio_link_item'])
		$portfolio_link_item = 'on';
	else
		$portfolio_link_item = 'off';

	update_post_meta($id, 'portfolio_link_item', $portfolio_link_item);

	if(isset($_POST['portfolio_remove_frame']) && $_POST['portfolio_remove_frame'])
		$portfolio_remove_frame = 'on';
	else
		$portfolio_remove_frame = 'off';

	update_post_meta($id, 'portfolio_remove_frame', $portfolio_remove_frame);
}
add_action('save_post', 'save_portfolio_meta_box');

?>