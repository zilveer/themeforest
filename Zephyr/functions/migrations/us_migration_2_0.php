<?php

class us_migration_2_0 extends US_Migration_Translator {

	/**
	 * @var bool Possibly dangerous translation that needs to be migrated manually (don't use this too often)
	 */
	public $should_be_manual = TRUE;

	public function translate_menus( &$locations ) {
		$rules = array(
			'zephyr_main_menu' => 'us_main_menu',
			'zephyr_footer_menu' => 'us_footer_menu',
		);

		return $this->_translate_menus( $locations, $rules );
	}

	// Options
	public function translate_theme_options( &$options ) {

		$rules = array(
			'custom_logo' => array(
				'new_name' => 'logo_image',
			),
			'custom_logo_transparent' => array(
				'new_name' => 'logo_image_transparent'
			),
			'logo_as_text' => array(
				'new_name' => 'logo_type',
				'values' => array(
					TRUE => 'text',
					FALSE => 'img',
				),
			),
			'header_layout_type' => array(
				'new_name' => 'titlebar_size',
				'values' => array(
					'Compact' => 'medium',
					'Large' => 'large',
					'Huge' => 'huge',
				),
			),
			'titlebar_color_style' => array(
				'new_name' => 'titlebar_color',
				'values' => array(
					'Content bg | Content text' => 'default',
					'Alternate bg | Content text' => 'alternate',
					'Primary bg | White text' => 'primary',
					'Secondary bg | White text' => 'secondary',
				),
			),
			'custom_favicon' => array(
				'new_name' => 'favicon',
			),
			'tracking_code' => array(
				'new_name' => 'custom_html',
			),
			'blog_excerpt_length' => array(
				'new_name' => 'excerpt_length',
			),
			'boxed_layout' => array(
				'new_name' => 'canvas_layout',
				'values' => array(
					TRUE => 'boxed',
					FALSE => 'wide',
				),
			),
			'body_bg' => array(
				'new_name' => 'color_body_bg',
			),
			'body_background_image' => array(
				'new_name' => 'body_bg_image',
			),
			'body_background_image_repeat' => array(
				'new_name' => 'body_bg_image_repeat',
				'values' => array(
					'Repeat' => 'repeat',
					'Repeat Horizontally' => 'repeat-x',
					'Repeat Vertically' => 'repeat-y',
					'Do Not Repeat' => 'no-repeat',
				),
			),
			'body_background_image_position' => array(
				'new_name' => 'body_bg_image_position',
			),
			'body_background_image_attachment_fixed' => array(
				'new_name' => 'body_bg_image_attachment',
				'values' => array(
					TRUE => 'fixed',
					FALSE => 'scroll',
				),
			),
			'body_background_image_stretch' => array(
				'new_name' => 'body_bg_image_size',
				'values' => array(
					TRUE => 'cover',
					FALSE => 'initial',
				),
			),
			'disable_animation_width' => array(
				'new_name' => 'disable_effects_width',
			),
			'color_scheme' => array(
				'new_name' => 'color_style',
				'values' => array(
					'Purple White' => '1',
					'Teal Serenity' => '2',
					'Sunny Cocktail' => '3',
					'Light Tangerine' => '4',
					'Green Darkness' => '5',
					'Wet Stone' => '6',
				),
			),
			'header_bg' => array(
				'new_name' => 'color_header_bg',
			),
			'header_text' => array(
				'new_name' => 'color_header_text',
			),
			'header_text_hover' => array(
				'new_name' => 'color_header_text_hover',
			),
			'header_ext_bg' => array(
				'new_name' => 'color_header_ext_bg',
			),
			'header_ext_text' => array(
				'new_name' => 'color_header_ext_text',
			),
			'header_ext_text_hover' => array(
				'new_name' => 'color_header_ext_text_hover',
			),
			'transparent_header_text' => array(
				'new_name' => 'color_header_transparent_text',
			),
			'transparent_header_text_hover' => array(
				'new_name' => 'color_header_transparent_text_hover',
			),
			'search_bg' => array(
				'new_name' => 'color_header_search_bg',
			),
			'search_text' => array(
				'new_name' => 'color_header_search_text',
			),
			'change_main_menu_colors' => array(
				'new_name' => 'change_menu_colors',
			),
			'transparent_menu_active_text' => array(
				'new_name' => 'color_menu_transparent_active_text',
			),
			'menu_active_text' => array(
				'new_name' => 'color_menu_active_text',
			),
			'menu_hover_bg' => array(
				'new_name' => 'color_menu_hover_bg',
			),
			'menu_hover_text' => array(
				'new_name' => 'color_menu_hover_text',
			),
			'drop_bg' => array(
				'new_name' => 'color_drop_bg',
			),
			'drop_text' => array(
				'new_name' => 'color_drop_text',
			),
			'drop_hover_bg' => array(
				'new_name' => 'color_drop_hover_bg',
			),
			'drop_hover_text' => array(
				'new_name' => 'color_drop_hover_text',
			),
			'drop_active_bg' => array(
				'new_name' => 'color_drop_active_bg',
			),
			'drop_active_text' => array(
				'new_name' => 'color_drop_active_text',
			),
			'menu_button_bg' => array(
				'new_name' => 'color_menu_button_bg',
			),
			'menu_button_text' => array(
				'new_name' => 'color_menu_button_text',
			),
			'menu_button_hover_bg' => array(
				'new_name' => 'color_menu_button_hover_bg',
			),
			'menu_button_hover_text' => array(
				'new_name' => 'color_menu_button_hover_text',
			),
			'change_main_content_colors' => array(
				'new_name' => 'change_content_colors',
			),
			'main_bg' => array(
				'new_name' => 'color_content_bg',
			),
			'main_bg_alt' => array(
				'new_name' => 'color_content_bg_alt',
			),
			'main_border' => array(
				'new_name' => 'color_content_border',
			),
			'main_heading' => array(
				'new_name' => 'color_content_heading',
			),
			'main_text' => array(
				'new_name' => 'color_content_text',
			),
			'main_primary' => array(
				'new_name' => 'color_content_primary',
			),
			'main_secondary' => array(
				'new_name' => 'color_content_secondary',
			),
			'main_fade' => array(
				'new_name' => 'color_content_faded',
			),
			'subfooter_bg' => array(
				'new_name' => 'color_subfooter_bg',
			),
			'subfooter_bg_alt' => array(
				'new_name' => 'color_subfooter_bg_alt',
			),
			'subfooter_border' => array(
				'new_name' => 'color_subfooter_border',
			),
			'subfooter_text' => array(
				'new_name' => 'color_subfooter_text',
			),
			'subfooter_heading' => array(
				'new_name' => 'color_subfooter_heading',
			),
			'subfooter_link' => array(
				'new_name' => 'color_subfooter_link',
			),
			'subfooter_link_hover' => array(
				'new_name' => 'color_subfooter_link_hover',
			),
			'footer_bg' => array(
				'new_name' => 'color_footer_bg',
			),
			'footer_text' => array(
				'new_name' => 'color_footer_text',
			),
			'footer_link' => array(
				'new_name' => 'color_footer_link',
			),
			'footer_link_hover' => array(
				'new_name' => 'color_footer_link_hover',
			),
			'header_is_sticky' => array(
				'new_name' => 'header_sticky',
			),
			'header_bg_transparent' => array(
				'new_name' => 'header_transparent',
			),
			'disable_sticky_header_width' => array(
				'new_name' => 'header_sticky_disable_width',
			),
			'main_header_layout' => array(
				'new_name' => 'header_layout',
			),
			'header_main_shrinked_height' => array(
				'new_name' => 'header_main_sticky_height_1',
			),
			'header_show_search' => array(
				'new_name' => 'header_search_show',
			),
			'header_show_contacts' => array(
				'new_name' => 'header_contacts_show',
			),
			'header_phone' => array(
				'new_name' => 'header_contacts_phone',
			),
			'header_email' => array(
				'new_name' => 'header_contacts_email',
			),
			'header_custom_icon' => array(
				'new_name' => 'header_contacts_custom_icon',
			),
			'header_custom_text' => array(
				'new_name' => 'header_contacts_custom_text',
			),
			'header_show_socials' => array(
				'new_name' => 'header_socials_show',
			),
			'header_social_facebook' => array(
				'new_name' => 'header_socials_facebook',
			),
			'header_social_twitter' => array(
				'new_name' => 'header_socials_twitter',
			),
			'header_social_google' => array(
				'new_name' => 'header_socials_google',
			),
			'header_social_linkedin' => array(
				'new_name' => 'header_socials_linkedin',
			),
			'header_social_youtube' => array(
				'new_name' => 'header_socials_youtube',
			),
			'header_social_vimeo' => array(
				'new_name' => 'header_socials_vimeo',
			),
			'header_social_flickr' => array(
				'new_name' => 'header_socials_flickr',
			),
			'header_social_instagram' => array(
				'new_name' => 'header_socials_instagram',
			),
			'header_social_behance' => array(
				'new_name' => 'header_socials_behance',
			),
			'header_social_xing' => array(
				'new_name' => 'header_socials_xing',
			),
			'header_social_pinterest' => array(
				'new_name' => 'header_socials_pinterest',
			),
			'header_social_skype' => array(
				'new_name' => 'header_socials_skype',
			),
			'header_social_tumblr' => array(
				'new_name' => 'header_socials_tumblr',
			),
			'header_social_dribbble' => array(
				'new_name' => 'header_socials_dribbble',
			),
			'header_social_vk' => array(
				'new_name' => 'header_socials_vk',
			),
			'header_social_soundcloud' => array(
				'new_name' => 'header_socials_soundcloud',
			),
			'header_social_yelp' => array(
				'new_name' => 'header_socials_yelp',
			),
			'header_social_twitch' => array(
				'new_name' => 'header_socials_twitch',
			),
			'header_social_deviantart' => array(
				'new_name' => 'header_socials_deviantart',
			),
			'header_social_foursquare' => array(
				'new_name' => 'header_socials_foursquare',
			),
			'header_social_github' => array(
				'new_name' => 'header_socials_github',
			),
			'header_social_rss' => array(
				'new_name' => 'header_socials_rss',
			),
			'header_show_language' => array(
				'new_name' => 'header_language_show',
			),
			'header_language_type' => array(
				'new_name' => 'header_language_source',
				'values' => array(
					'Your own links' => 'own',
					'WPML language switcher' => 'wpml',
				),
			),
			'header_language_amount' => array(
				'new_name' => 'header_link_qty',
				'values' => array(
					'2' => '1',
					'3' => '2',
					'4' => '3',
					'5' => '4',
					'6' => '5',
					'7' => '6',
					'8' => '7',
					'9' => '8',
					'10' => '9',
				),
			),
			'header_language_1_name' => array(
				'new_name' => 'header_link_title',
			),
			'header_language_2_name' => array(
				'new_name' => 'header_link_1_label',
			),
			'header_language_2_url' => array(
				'new_name' => 'header_link_1_url',
			),
			'header_language_3_name' => array(
				'new_name' => 'header_link_2_label',
			),
			'header_language_3_url' => array(
				'new_name' => 'header_link_2_url',
			),
			'header_language_4_name' => array(
				'new_name' => 'header_link_3_label',
			),
			'header_language_4_url' => array(
				'new_name' => 'header_link_3_url',
			),
			'header_language_5_name' => array(
				'new_name' => 'header_link_4_label',
			),
			'header_language_5_url' => array(
				'new_name' => 'header_link_4_url',
			),
			'header_language_6_name' => array(
				'new_name' => 'header_link_5_label',
			),
			'header_language_6_url' => array(
				'new_name' => 'header_link_5_url',
			),
			'header_language_7_name' => array(
				'new_name' => 'header_link_6_label',
			),
			'header_language_7_url' => array(
				'new_name' => 'header_link_6_url',
			),
			'header_language_8_name' => array(
				'new_name' => 'header_link_7_label',
			),
			'header_language_8_url' => array(
				'new_name' => 'header_link_7_url',
			),
			'header_language_9_name' => array(
				'new_name' => 'header_link_8_label',
			),
			'header_language_9_url' => array(
				'new_name' => 'header_link_8_url',
			),
			'header_language_10_name' => array(
				'new_name' => 'header_link_9_label',
			),
			'header_language_10_url' => array(
				'new_name' => 'header_link_9_url',
			),
			'mobile_nav_width' => array(
				'new_name' => 'menu_mobile_width',
			),
			'menu_hover_animation' => array(
				'new_name' => 'menu_dropdown_effect',
				'values' => array(
					'FadeIn' => 'opacity',
					'FadeIn + SlideDown' => 'height',
					'Material Design Effect' => 'mdesign',
				),
			),
			'header_menu_togglable' => array(
				'new_name' => 'menu_togglable_type',
			),
			'footer_show_widgets' => array(
				'new_name' => 'footer_show_top',
			),
			'footer_widgets_columns' => array(
				'new_name' => 'footer_columns',
			),
			'footer_show_footer' => array(
				'new_name' => 'footer_show_bottom',
			),
			'heading_font' => array(
				'new_name' => 'heading_font_family',
			),
			'body_text_font' => array(
				'new_name' => 'body_font_family',
			),
			'regular_fontsize' => array(
				'new_name' => 'body_fontsize',
			),
			'regular_fontsize_mobile' => array(
				'new_name' => 'body_fontsize_mobile',
			),
			'regular_lineheight' => array(
				'new_name' => 'body_lineheight',
			),
			'regular_lineheight_mobile' => array(
				'new_name' => 'body_lineheight_mobile',
			),
			'navigation_font' => array(
				'new_name' => 'menu_font_family',
			),
			'nav_font_weight_200' => array(
				'new_name' => 'menu_font_weight_200',
			),
			'nav_font_weight_300' => array(
				'new_name' => 'menu_font_weight_300',
			),
			'nav_font_weight_400' => array(
				'new_name' => 'menu_font_weight_400',
			),
			'nav_font_weight_600' => array(
				'new_name' => 'menu_font_weight_600',
			),
			'nav_font_weight_700' => array(
				'new_name' => 'menu_font_weight_700',
			),
			'nav_font_style_italic' => array(
				'new_name' => 'menu_font_style_italic',
			),
			'nav_fontsize' => array(
				'new_name' => 'menu_fontsize',
			),
			'nav_fontsize_mobile' => array(
				'new_name' => 'menu_fontsize_mobile',
			),
			'subnav_fontsize' => array(
				'new_name' => 'menu_sub_fontsize',
			),
			'subnav_fontsize_mobile' => array(
				'new_name' => 'menu_sub_fontsize_mobile',
			),
			'portfolio_sidebar_pos' => array(
				'new_name' => 'portfolio_sidebar',
				'values' => array(
					'No Sidebar' => 'none',
					'Right' => 'right',
					'Left' => 'left',
				),
			),
			'portfolio_slug_info' => array(
				'new_name' => 'portfolio_info',
			),
			'blog_sidebar_pos' => array(
				'new_name' => array(
					'blog_sidebar',
					'archive_sidebar',
					'search_sidebar',
				),
				'values' => array(
					'No Sidebar' => 'none',
					'Right' => 'right',
					'Left' => 'left',
				),
			),
			'post_sidebar_pos' => array(
				'new_name' => 'post_sidebar',
				'values' => array(
					'No Sidebar' => 'none',
					'Right' => 'right',
					'Left' => 'left',
				),
			),
			'post_read_more' => array(
				'new_name' => array(
					'blog_read_more',
					'archive_read_more',
					'search_read_more',
				),
			),
			'post_meta_date' => array(
				'new_name' => array(
					'post_meta_date',
					'blog_meta_date',
					'archive_meta_date',
					'search_meta_date',
				),
			),
			'post_meta_author' => array(
				'new_name' => array(
					'post_meta_author',
					'blog_meta_author',
					'archive_meta_author',
					'search_meta_author',
				),
			),
			'post_meta_categories' => array(
				'new_name' => array(
					'post_meta_categories',
					'blog_meta_categories',
					'archive_meta_categories',
					'search_meta_categories',
				),
			),
			'post_meta_comments' => array(
				'new_name' => array(
					'post_meta_comments',
					'blog_meta_comments',
					'archive_meta_comments',
					'search_meta_comments',
				),
			),
			'post_meta_tags' => array(
				'new_name' => array(
					'post_meta_tags',
					'blog_meta_tags',
					'archive_meta_tags',
					'search_meta_tags',
				),
			),
			'post_related_posts' => array(
				'new_name' => 'post_related',
			),
			'blog_layout' => array(
				'values' => array(
					'Large Image' => 'large',
					'Small Image' => 'smallcircle',
					'Masonry Grid' => 'masonry',
				),
			),
			'archive_layout' => array(
				'values' => array(
					'Large Image' => 'large',
					'Small Image' => 'smallcircle',
					'Masonry Grid' => 'masonry',
				),
			),
			'search_layout' => array(
				'values' => array(
					'Large Image' => 'large',
					'Small Image' => 'smallcircle',
					'Masonry Grid' => 'masonry',
				),
			),
			'shop_sidebar_pos' => array(
				'new_name' => 'shop_sidebar',
				'values' => array(
					'No Sidebar' => 'none',
					'Right' => 'right',
					'Left' => 'left',
				),
			),
			'good_sidebar_pos' => array(
				'new_name' => 'product_sidebar',
				'values' => array(
					'No Sidebar' => 'none',
					'Right' => 'right',
					'Left' => 'left',
				),
			),
			'shop_columns_qty' => array(
				'new_name' => 'shop_columns',
				'values' => array(
					'2 columns' => '2',
					'3 columns' => '3',
					'4 columns' => '4',
					'5 columns' => '5',
				),
			),
			'related_products_qty' => array(
				'new_name' => 'product_related_qty',
				'values' => array(
					'2 items' => '2',
					'3 items' => '3',
					'4 items' => '4',
					'5 items' => '5',
				),
			),
			'products_listing_style' => array(
				'new_name' => 'shop_listing_style',
				'values' => array(
					'Flat style' => '1',
					'Card style' => '2',
				),
			),
		);

		$this->_translate_theme_options( $options, $rules );

		if ( isset( $options['use_excerpt'] ) ) {
			if ( $options['use_excerpt'] == 'Full Content of Post' ) {
				$options['excerpt_length'] = '';
			} elseif ( $options['use_excerpt'] == 'No Content' ) {
				$options['blog_excerpt'] = $options['archive_excerpt'] = $options['search_excerpt'] = FALSE;
			}
		}

		return TRUE;
	}

	// Meta
	public function translate_meta( &$meta, $post_type ) {
		$meta_changed = FALSE;

		$translate_meta_for = array(
			'post',
			'page',
			'us_portfolio',
		);

		if ( ! in_array( $post_type, $translate_meta_for ) ) {
			return $meta_changed;
		}

		$rules = array(
			'us_subtitle' => array(
				'new_name' => 'us_titlebar_subtitle',
				'post_types' => array(
					'page',
					'us_portfolio',
				),
			),
			'us_header_layout_type' => array(
				'new_name' => 'us_titlebar_size',
				'values' => array(
					'Compact' => 'medium',
					'Large' => 'large',
					'Huge' => 'huge',
				),
				'post_types' => array(
					'page',
					'us_portfolio',
				),
			),
			'us_titlebar_parallax' => array(
				'new_name' => 'us_titlebar_image_parallax',
				'post_types' => array(
					'page',
					'us_portfolio',
				),
			),
			'us_show_subfooter_widgets' => array(
				'new_name' => 'us_footer_show_top',
				'values' => array(
					'yes' => 'show',
					'no' => 'hide',
				),
				'post_types' => array(
					'post',
					'page',
					'us_portfolio',
				),
			),
			'us_show_footer' => array(
				'new_name' => 'us_footer_show_bottom',
				'values' => array(
					'yes' => 'show',
					'no' => 'hide',
				),
				'post_types' => array(
					'post',
					'page',
					'us_portfolio',
				),
			),
			'us_titlebar' => array(
				'new_name' => 'us_titlebar_content',
				'values' => array(
					'' => 'all',
					'caption_only' => 'caption',
				),
				'post_types' => array(
					'page',
					'us_portfolio',
				),
			),
			'us_title_bg_color' => array(
				'new_name' => 'us_tile_bg_color',
				'post_types' => array(
					'us_portfolio',
				),
			),
			'us_title_text_color' => array(
				'new_name' => 'us_tile_text_color',
				'post_types' => array(
					'us_portfolio',
				),
			),
		);

		// Changing values and giving new names where needed
		$meta_changed = $this->_translate_meta($meta, $post_type, $rules) OR $meta_changed;

		// Cases that is hard to describe by rues

		// Translating us_header_type to us_header_pos & us_heder_bg
		if ( isset( $meta['us_header_type'] ) AND ( empty( $meta['us_header_pos'] ) OR empty( $meta['us_header_bg'] ) ) ) {
			$meta_changed = TRUE;
			switch ( $meta['us_header_type'][0] ) {
				case 'Sticky Transparent':
					$meta['us_header_pos'][0] = 'fixed';
					$meta['us_header_bg'][0] = 'transparent';
					break;

				case 'Sticky Solid':
					$meta['us_header_pos'][0] = 'fixed';
					$meta['us_header_bg'][0] = 'solid';
					break;

				case 'Non-sticky':
					$meta['us_header_pos'][0] = 'static';
					$meta['us_header_bg'][0] = 'solid';
					break;
			}
		}

		// Adding us_titlebar_image_size if needed
		if ( in_array( $post_type, array( 'page', 'portfolio' ) ) AND empty( $meta['us_titlebar_image_size'] ) ) {
			$meta_changed = TRUE;
			$meta['us_titlebar_image_size'][0] = 'cover';
		}

		// Translating Template into meta fields
		if ( isset( $meta['_wp_page_template'][0] ) AND ( $meta['_wp_page_template'][0] != 'default' ) ) {
			$meta_changed = TRUE;
			switch ( $meta['_wp_page_template'][0] ) {
				case 'page-blank.php':
					$meta['us_header_remove'][0] = TRUE;
					$meta['us_titlebar_content'][0] = 'hide';
					$meta['us_footer_show_top'][0] = 'hide';
					$meta['us_footer_show_bottom'][0] = 'hide';
					break;

				case 'page-sidebar_left.php':
					$meta['us_sidebar'][0] = 'left';
					break;

				case 'page-sidebar_right.php':
					$meta['us_sidebar'][0] = 'right';
					break;
			}

			$meta['_wp_page_template'][0] = 'default';
		}

		return $meta_changed;
	}

	// Content
	public function translate_content( &$content ) {
		return $this->_translate_content( $content );
	}

	// Shortcodes
	public function translate_vc_row( &$name, &$params, &$content ) {

		$shortcode_changed = FALSE;
		if ( isset( $params['columns_type'] ) ) {
			unset( $params['columns_type'] );
			$shortcode_changed = TRUE;
		}

		$params_rules = array(
			'section_id' => array(
				'new_name' => 'el_id',
			),
		);

		$shortcode_changed = ( $this->translate_params( $params, $params_rules ) OR $shortcode_changed );

		if ( ! isset( $params['section'] ) OR empty( $params['section'] ) ) {
			$params['height'] = 'medium';
			$params['color_scheme'] = '';
			$params['us_bg_color'] = '';
			$params['us_text_color'] = '';
			$params['us_bg_image'] = '';
			$params['us_bg_video'] = '0';
			if ( isset( $params['full_height'] ) ) {
				unset( $params['full_height'] );
			}
			if ( isset( $params['full_width'] ) ) {
				unset( $params['full_width'] );
			}
			if ( isset( $params['full_screen'] ) ) {
				unset( $params['full_screen'] );
			}
			$shortcode_changed = TRUE;
		}

		if ( isset( $params['section'] ) AND $params['section'] == 'yes' ) {
			$params['height'] = 'medium';
			unset( $params['section'] );
			$shortcode_changed = TRUE;

			$params_rules = array(
				'vertical_centering' => array(
					'new_name' => 'valign',
					'values' => array(
						'yes' => 'center',
					),
				),
				'boxed_columns' => array(
					'new_name' => 'columns_type',
					'values' => array(
						'' => 'medium',
						'yes' => 'none',
					),
				),
				'full_width' => array(
					'new_name' => 'width',
					'values' => array(
						'yes' => 'full',
					),
				),
				'background' => array(
					'new_name' => 'color_scheme',
				),
				'bg_color' => array(
					'new_name' => 'us_bg_color',
				),
				'overlay_color' => array(
					'new_name' => 'us_bg_overlay_color',
				),
				'text_color' => array(
					'new_name' => 'us_text_color',
				),
				'img' => array(
					'new_name' => 'us_bg_image',
				),
				'parallax' => array(
					'new_name' => 'us_bg_parallax',
				),
				'video' => array(
					'new_name' => 'us_bg_video',
				),
			);
			$shortcode_changed = ( $this->translate_params( $params, $params_rules ) OR $shortcode_changed );

			if ( isset( $params['full_height'] ) AND $params['full_height'] == 'yes' ) {
				$params['height'] = 'auto';
				unset( $params['full_height'] );
			}

			if ( isset( $params['full_screen'] ) AND $params['full_screen'] == 'yes' ) {
				$params['height'] = 'full';
				unset( $params['full_screen'] );
			}
		}

		return $shortcode_changed;
	}

	public function translate_vc_row_inner( &$name, &$params, &$content ) {

		$shortcode_changed = FALSE;
		if ( isset( $params['columns_type'] ) ) {
			unset( $params['columns_type'] );
			$shortcode_changed = TRUE;
		}

		$params_rules = array(
			'boxed_columns' => array(
				'new_name' => 'columns_type',
				'values' => array(
					'' => 'medium',
					'yes' => 'none',
				),
			),
			'section_id' => array(
				'new_name' => 'el_id',
			),
		);

		$shortcode_changed = ( $this->translate_params( $params, $params_rules ) OR $shortcode_changed );

		return $shortcode_changed;
	}

	public function translate_vc_column( &$name, &$params, &$content ) {
		$shortcode_changed = FALSE;

		$custom_css_rules = array();
		if ( ! empty( $params['css'] ) AND preg_match( '~(\.[a-z0-9\_]+) ?\{([^\}]+?)\;?\}~', $params['css'], $matches ) ) {
			$custom_css_class = $matches[1];
			foreach ( array_map( 'trim', explode( ';', $matches[1] ) ) as $custom_css_rule ) {
				$custom_css_rule = explode( ':', $custom_css_rule, 2 );
				if ( count( $custom_css_rule ) < 2 ) {
					continue;
				}
				$custom_css_rules[ $custom_css_rule[0] ] = $custom_css_rule[1];
			}
		} else {
			global $vc_custom_css_id;
			$vc_custom_css_id = isset( $vc_custom_css_id ) ? ( $vc_custom_css_id + 1 ) : 1;
			$custom_css_class = '.vc_custom_' . time() . sprintf( '%03d', $vc_custom_css_id );
		}

		if ( isset( $params['bg_color'] ) ) {
			$custom_css_rules['background'] = $params['bg_color'];
			unset( $params['bg_color'] );
			$shortcode_changed = TRUE;
		}

		if ( isset( $params['img'] ) ) {
			$image = wp_get_attachment_image_src( $params['img'], 'large' );
			if ( $image ) {
				$custom_css_rules['background'] = isset( $custom_css_rules['background'] ) ? ( $custom_css_rules['background'] . ' ' ) : '';
				$custom_css_rules['background'] .= 'url( ' . $image[0] . '?id=' . $params['img'] . ')';
			}
			unset( $params['img'] );
			$shortcode_changed = TRUE;
		}

		if ( isset( $custom_css_rules['background'] ) AND strpos( $custom_css_rules['background'], '!important' ) === FALSE ) {
			$custom_css_rules['background'] .= ' !important';
		}

		if ( ! empty( $custom_css_rules ) ) {
			$params['css'] = $custom_css_class . '{';
			foreach ( $custom_css_rules as $custom_css_rule_attr => $custom_css_rule_value ) {
				$params['css'] .= $custom_css_rule_attr . ': ' . $custom_css_rule_value . ';';
			}
			$params['css'] .= '}';
			$this->_extra_css .= $params['css'];
		}

		return $shortcode_changed;
	}

	public function translate_vc_column_inner( &$name, &$params, &$content ) {
		return $this->translate_vc_column( $name, $params, $content );
	}

	public function translate_vc_tabs( &$name, &$params, &$content ) {
		$name = 'vc_tta_tabs';

		if ( isset( $params['timeline'] ) AND $params['timeline'] == 'yes' ) {
			$params['layout'] = 'timeline';
			unset( $params['timeline'] );
		}

		return TRUE;
	}

	public function translate_vc_tab( &$name, &$params, &$content ) {
		$name = 'vc_tta_section';

		if ( isset( $params['no_indents'] ) AND $params['no_indents'] == 'yes' ) {
			$params['indents'] = 'none';
			unset( $params['no_indents'] );
		}

		return TRUE;
	}

	public function translate_vc_accordion( &$name, &$params, &$content ) {
		$name = 'vc_tta_accordion';

		if ( isset( $params['title_center'] ) AND $params['title_center'] == 'yes' ) {
			$params['c_align'] = 'center';
			unset( $params['title_center'] );
		}

		return TRUE;
	}

	public function translate_vc_accordion_tab( &$name, &$params, &$content ) {
		$name = 'vc_tta_section';

		if ( isset( $params['no_indents'] ) AND $params['no_indents'] == 'yes' ) {
			$params['indents'] = 'none';
			unset( $params['no_indents'] );
		}

		return TRUE;
	}

	public function translate_vc_actionbox( &$name, &$params ) {
		$name = 'us_cta';

		$params_rules = array(
			'type' => array(
				'new_name' => 'color',
			),
			'button_label' => array(
				'new_name' => 'btn_label',
			),
			'button_color' => array(
				'new_name' => 'btn_color',
			),
			'button_type' => array(
				'new_name' => 'btn_style',
			),
			'button_size' => array(
				'new_name' => 'btn_size',
				'values' => array(
					'big' => 'large',
				),
			),
			'button_icon' => array(
				'new_name' => 'btn_icon',
			),
			'button_iconpos' => array(
				'new_name' => 'btn_iconpos',
			),
		);

		$this->translate_params( $params, $params_rules );

		$btn_link = '';
		if ( isset( $params['button_link'] ) ) {
			if ( $params['button_link'] != '' ) {
				$btn_link .= 'url:' . urlencode( $params['button_link'] );
			}
			unset( $params['button_link'] );
		}
		if ( isset( $params['button_target'] ) AND ( $params['button_target'] == 1 OR $params['button_target'] == 'yes' ) ) {
			$btn_link .= '|target:%20_blank';
			unset( $params['button_target'] );
		}
		$params['btn_link'] = trim( $btn_link, '|' );

		return TRUE;
	}

	public function translate_vc_blog( &$name, &$params, &$content ) {
		$name = 'us_blog';

		$params_rules = array(
			'type' => array(
				'new_name' => 'layout',
				'values' => array(
					'large_image' => 'large',
					'small_circle_image' => 'smallcircle',
				),
			),
			'show_date' => array(
				'values' => array(
					'yes' => NULL,
					NULL => '0',
				),
			),
			'show_author' => array(
				'values' => array(
					'yes' => NULL,
					NULL => '0',
				),
			),
			'show_categories' => array(
				'values' => array(
					'yes' => NULL,
					NULL => '0',
				),
			),
			'show_tags' => array(
				'values' => array(
					'yes' => NULL,
					NULL => '0',
				),
			),
			'show_comments' => array(
				'values' => array(
					'yes' => NULL,
					NULL => '0',
				),
			),
			'show_read_more' => array(
				'values' => array(
					'yes' => NULL,
					NULL => '0',
				),
			),
			'category' => array(
				'new_name' => 'categories',
			),
		);

		$this->translate_params( $params, $params_rules );

		if ( $params['post_content'] == 'excerpt' ) {
			$params['show_excerpt'] = '1';
			unset( $params['post_content'] );
		} elseif ( $params['post_content'] == 'none' ) {
			$params['show_excerpt'] = '0';
			unset( $params['post_content'] );
		} elseif ( $params['post_content'] == 'full' ) {
			unset( $params['post_content'] );
		}

		return TRUE;
	}

	public function translate_vc_button( &$name, &$params, &$content ) {
		$name = 'us_btn';

		$params_rules = array(
			'type' => array(
				'new_name' => 'style',
			),
		);

		$this->translate_params( $params, $params_rules );

		$link = '';

		if ( isset( $params['url'] ) AND $params['url'] != '' ) {
			$link .= 'url:' . urlencode( $params['url'] );
			unset( $params['url'] );
		}
		if ( isset( $params['external'] ) AND ( $params['external'] == 1 OR $params['external'] == 'yes' ) ) {
			$link .= '|target:%20_blank';
			unset( $params['external'] );
		}

		$params['link'] = $link;

		if ( isset( $params['size'] ) AND $params['size'] == 'big' ) {
			$params['size'] = 'large';
		} elseif ( empty( $params['size'] ) ) {
			unset( $params['size'] );
		}

		return TRUE;
	}

	public function translate_vc_clients( &$name, &$params, &$content ) {
		$name = 'us_logos';

		$params_rules = array(
			'type' => array(
				'new_name' => 'style',
				'values' => array(
					'raised' => '1',
					'flat' => '2',
				),
			),
			'arrows' => array(
				'values' => array(
					'yes' => '1',
				),
			),
			'auto_scroll' => array(
				'values' => array(
					'yes' => '1',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		return TRUE;
	}

	public function translate_vc_counter( &$name, &$params, &$content ) {
		$name = 'us_counter';

		$params_rules = array(
			'number' => array(
				'new_name' => 'initial',
			),
			'count' => array(
				'new_name' => 'target',
			),
			'size' => array(
				'values' => array(
					'big' => 'large',
				),
			),
		);

		$shortcode_changed = $this->translate_params( $params, $params_rules );

		return $shortcode_changed;
	}

	public function translate_vc_contact_form( &$name, &$params ) {
		$name = 'us_cform';

		$params_rules = array(
			'form_email' => array(
				'new_name' => 'receiver_email',
			),
			'button_type' => array(
				'new_name' => 'button_style',
			),
		);

		$this->translate_params( $params, $params_rules );

		$fields = array(
			'form_name_field' => 'name_field',
			'form_email_field' => 'email_field',
			'form_phone_field' => 'phone_field',
			'form_message_field' => 'message_field',
		);
		foreach ( $fields as $field => $new_field ) {
			if ( isset( $params[ $field ] ) AND $params[ $field ] == 'show' ) {
				$params[ $new_field ] = 'shown';
				unset( $params[ $field ] );
			} elseif ( isset( $params[ $field ] ) AND $params[ $field ] == 'not_show' ) {
				$params[ $new_field ] = 'hidden';
				unset( $params[ $field ] );
			} elseif ( isset( $params[ $field ] ) AND $params[ $field ] == 'required' ) {
				unset( $params[ $field ] );
			}
		}

		if ( isset( $params['form_captcha'] ) AND $params['form_captcha'] == 'show' ) {
			$params['captcha_field'] = 'required';
		} elseif ( isset( $params['form_captcha'] ) AND $params['form_captcha'] == '' ) {
			unset( $params['form_captcha'] );
		}

		if ( isset( $params['button_size'] ) AND $params['button_size'] == 'big' ) {
			$params['button_size'] = 'large';
		} elseif ( isset( $params['button_size'] ) AND $params['button_size'] == '' ) {
			unset( $params['button_size'] );
		}

		return TRUE;
	}

	public function translate_vc_gallery( &$name, &$params, &$content ) {
		$name = 'us_gallery';

		$params_rules = array(
			'indents' => array(
				'values' => array(
					'yes' => '1',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		if ( isset( $params['masonry'] ) AND $params['masonry'] == 'yes' ) {
			$params['layout'] = 'masonry';
			unset( $params['masonry'] );
		} elseif ( isset( $params['masonry'] ) ) {
			unset( $params['masonry'] );
		}

		return TRUE;
	}

	public function translate_vc_gmaps( &$name, &$params, &$content ) {
		$name = 'us_gmaps';

		$params_rules = array(
			'address' => array(
				'new_name' => 'marker_address',
			),
			'marker_2_address' => array(
				'new_name' => 'marker2_address',
			),
			'marker_3_address' => array(
				'new_name' => 'marker3_address',
			),
			'marker_4_address' => array(
				'new_name' => 'marker4_address',
			),
			'marker_5_address' => array(
				'new_name' => 'marker5_address',
			),
			'type' => array(
				'values' => array(
					'ROADMAP' => 'roadmap',
					'SATELLITE' => 'satellite',
					'HYBRID' => 'hybrid',
					'TERRAIN' => 'terrain',
				),
			),
			'add_markers' => array(
				'values' => array(
					'yes' => '1',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		if ( isset( $params['marker'] ) AND $params['marker'] != '' ) {
			$params['marker_text'] = base64_encode( $params['marker'] );
			unset( $params['marker'] );
		}

		if ( isset( $params['marker_2'] ) AND $params['marker_2'] != '' ) {
			$params['marker2_text'] = base64_encode( $params['marker_2'] );
			unset( $params['marker_2'] );
		}

		if ( isset( $params['marker_3'] ) AND $params['marker_3'] != '' ) {
			$params['marker3_text'] = base64_encode( $params['marker_3'] );
			unset( $params['marker_3'] );
		}

		if ( isset( $params['marker_4'] ) AND $params['marker_4'] != '' ) {
			$params['marker4_text'] = base64_encode( $params['marker_4'] );
			unset( $params['marker_4'] );
		}

		if ( isset( $params['marker_5'] ) AND $params['marker_5'] != '' ) {
			$params['marker5_text'] = base64_encode( $params['marker_5'] );
			unset( $params['marker_5'] );
		}

		return TRUE;
	}

	public function translate_vc_iconbox( &$name, &$params, &$content ) {
		$name = 'us_iconbox';

		$params_rules = array(
			'type' => array(
				'new_name' => 'style',
			),
			'size' => array(
				'values' => array(
					'big' => 'large',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		$link = '';

		if ( isset( $params['link'] ) AND $params['link'] != '' ) {
			$link .= 'url:' . urlencode( $params['link'] );
			unset( $params['link'] );
		}
		if ( isset( $params['external'] ) AND $params['external'] == 1 ) {
			$link .= '|target:%20_blank';
			unset( $params['external'] );
		}

		$params['link'] = $link;

		return TRUE;
	}

	public function translate_vc_simple_slider( &$name, &$params, &$content ) {
		$name = 'us_image_slider';

		$params_rules = array(
			'auto_rotation' => array(
				'new_name' => 'autoplay',
				'values' => array(
					'yes' => '1',
				),
			),
			'fullscreen' => array(
				'values' => array(
					'yes' => '1',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		if ( isset( $params['transition'] ) AND $params['transition'] == 'fade' ) {
			$params['transition'] = 'crossfade';
		} elseif ( isset( $params['transition'] ) AND $params['transition'] == 'dissolve' ) {
			$params['transition'] = 'crossfade';
		}

		if ( isset( $params['stretch'] ) AND $params['stretch'] == 'yes' ) {
			$params['img_fit'] = 'cover';
			unset( $params['stretch'] );
		}

		return TRUE;
	}

	public function translate_vc_single_image( &$name, &$params, &$content ) {
		$name = 'us_single_image';

		$params_rules = array(
			'img_link_large' => array(
				'new_name' => 'lightbox',
				'values' => array(
					'yes' => '1',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		$link = '';

		if ( isset( $params['img_link'] ) AND $params['img_link'] != '' ) {
			$link .= 'url:' . urlencode( $params['img_link'] );
			unset( $params['img_link'] );
		}
		if ( isset( $params['img_link_new_tab'] ) AND ( $params['img_link_new_tab'] == 1 OR $params['img_link_new_tab'] == 'yes' ) ) {
			$link .= '|target:%20_blank';
			unset( $params['img_link_new_tab'] );
		}

		$params['link'] = $link;

		return TRUE;
	}

	public function translate_vc_separator( &$name, &$params, &$content ) {
		$name = 'us_separator';

		if ( isset( $params['size'] ) AND $params['size'] == 'big' ) {
			$params['size'] = 'large';
		} elseif ( isset( $params['size'] ) AND $params['size'] == '' ) {
			unset( $params['size'] );
		}

		if ( isset( $params['type'] ) AND $params['type'] == '' ) {
			unset( $params['type'] );
		}

		return TRUE;
	}

	public function translate_vc_testimonial( &$name, &$params, &$content ) {
		$name = 'us_testimonial';

		$params_rules = array(
			'type' => array(
				'new_name' => 'style',
			),
		);

		$this->translate_params( $params, $params_rules );

		return TRUE;
	}

	public function translate_vc_member( &$name, &$params, &$content ) {
		$name = 'us_person';

		$params_rules = array(
			'img' => array(
				'new_name' => 'image',
			),
			'type' => array(
				'new_name' => 'style',
			),
		);

		$this->translate_params( $params, $params_rules );

		if ( ! isset( $params['name'] ) ) {
			$params['name'] = '';
		}
		if ( ! isset( $params['role'] ) ) {
			$params['role'] = '';
		}

		if ( $content == 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor.' ) {
			$content = '';
		}

		$link = '';

		if ( isset( $params['link'] ) AND $params['link'] != '' ) {
			$link .= 'url:' . urlencode( $params['link'] );
			unset( $params['link'] );
		}
		if ( isset( $params['external'] ) AND ( $params['external'] == 1 OR $params['external'] == 'yes' ) ) {
			$link .= '|target:%20_blank';
			unset( $params['external'] );
		}

		$params['link'] = $link;

		return TRUE;
	}

	public function translate_vc_message( &$name, &$params, &$content ) {
		$name = 'us_message';

		$params_rules = array(
			'closing' => array(
				'values' => array(
					'yes' => '1',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		return TRUE;
	}

	public function translate_vc_portfolio( &$name, &$params, &$content ) {
		$name = 'us_portfolio';

		$params_rules = array(
			'style' => array(
				'values' => array(
					'type_1' => 'style_1',
					'type_2' => 'style_2',
					'type_3' => 'style_3',
					'type_4' => 'style_4',
					'type_5' => 'style_5',
				),
			),
			'ratio' => array(
				'values' => array(
					'3:2' => '3x2',
					'4:3' => '4x3',
					'1:1' => '1x1',
					'2:3' => '2x3',
					'3:4' => '3x4',
				),
			),
			'meta' => array(
				'values' => array(
					'category' => 'categories',
				),
			),
			'filters' => array(
				'new_name' => 'filter',
				'values' => array(
					'yes' => 'category',
				),
			),
			'with_indents' => array(
				'values' => array(
					'yes' => '1',
				),
			),
			'random_order' => array(
				'new_name' => 'orderby',
				'values' => array(
					'yes' => 'rand',
				),
			),
			'category' => array(
				'new_name' => 'categories',
			),
		);

		$this->translate_params( $params, $params_rules );

		if ( ( ! isset( $params['items'] ) OR $params['items'] == '' ) AND ( ! empty( $params['columns'] ) ) ) {
			$params['items'] = $params['columns'];
		}

		return TRUE;
	}

	public function translate_pricing_table( &$name, &$params, &$content ) {
		$name = 'us_pricing';

		$items = array();

		$shortcode_pattern = $this->get_shortcode_regex( array( 'pricing_column', 'pricing_row', 'pricing_footer' ) );
		if ( preg_match_all( '/' . $shortcode_pattern . '/s', $content, $matches ) ) {
			if ( count( $matches[2] ) ) {
				foreach ( $matches[2] as $i => $shortcode_name ) {
					if ( $shortcode_name == 'pricing_column' ) {
						$item = array();
						$shortcode_params = shortcode_parse_atts( $matches[3][ $i ] );
						$shortcode_content = $matches[5][ $i ];

						if ( ! empty( $shortcode_params['title'] ) ) {
							$item['title'] = $shortcode_params['title'];
						}
						if ( ! empty( $shortcode_params['price'] ) ) {
							$item['price'] = $shortcode_params['price'];
						}
						if ( ! empty( $shortcode_params['time'] ) ) {
							$item['substring'] = $shortcode_params['time'];
						}
						if ( ! empty( $shortcode_params['featured'] ) AND $shortcode_params['featured'] == 1 ) {
							$item['type'] = 'featured';
						}

						$item['features'] = '';

						if ( preg_match_all( '/' . $shortcode_pattern . '/s', $shortcode_content, $item_matches ) ) {
							if ( count( $item_matches[2] ) ) {
								foreach ( $item_matches[2] as $j => $item_shortcode_name ) {
									if ( $item_shortcode_name == 'pricing_row' ) {
										$item['features'] .= $item_matches[5][ $j ] . "\n";
									}

									if ( $item_shortcode_name == 'pricing_footer' ) {
										$footer_shortcode_params = shortcode_parse_atts( $item_matches[3][ $j ] );

										$item['btn_text'] = $item_matches[5][ $j ];

										$item['btn_link'] = '';

										if ( isset( $footer_shortcode_params['url'] ) AND $footer_shortcode_params['url'] != '' ) {
											$item['btn_link'] .= 'url:' . urlencode( $footer_shortcode_params['url'] );
										}
										if ( isset( $footer_shortcode_params['external'] ) AND ( $footer_shortcode_params['external'] == 1 OR $footer_shortcode_params['external'] == 'yes' ) ) {
											$item['btn_link'] .= '|target:%20_blank';
										}

										if ( isset( $footer_shortcode_params['color'] ) AND $footer_shortcode_params['color'] != '' ) {
											$item['btn_color'] = $footer_shortcode_params['color'];
										}

										if ( isset( $footer_shortcode_params['type'] ) AND $footer_shortcode_params['type'] != '' ) {
											$item['btn_style'] = $footer_shortcode_params['type'];
										}

										if ( isset( $footer_shortcode_params['icon'] ) AND $footer_shortcode_params['icon'] != '' ) {
											$item['btn_icon'] = $footer_shortcode_params['icon'];
										}

										if ( isset( $footer_shortcode_params['iconpos'] ) AND $footer_shortcode_params['iconpos'] != '' ) {
											$item['btn_iconpos'] = $footer_shortcode_params['iconpos'];
										}

										if ( isset( $footer_shortcode_params['size'] ) AND $footer_shortcode_params['size'] != '' ) {
											$item['btn_size'] = $footer_shortcode_params['size'];
											if ( $item['btn_size'] == 'big' ) {
												$item['btn_size'] = 'large';
											}
										}
									}
								}
							}
						}

						$items[] = $item;
					}
				}
			}
		}

		$params['items'] = rawurlencode( json_encode( $items ) );

		$content = '';

		return TRUE;
	}

	public function translate_vc_social_links( &$name, &$params, &$content ) {
		$name = 'us_social_links';

		$params_rules = array(
			'size' => array(
				'values' => array(
					'' => 'small',
					'normal' => 'medium',
					'big' => 'large',
				),
			),
			'inverted' => array(
				'values' => array(
					'yes' => '1',
				),
			),
			'desaturated' => array(
				'values' => array(
					'yes' => '1',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		return TRUE;
	}

	public function translate_vc_custom_heading( &$name, &$params ) {
		if ( ! isset( $params['google_fonts'] ) OR empty( $params['google_fonts'] ) ) {
			$heading_font = us_get_option( 'heading_font_family' );
			if ( empty( $heading_font ) ) {
				return FALSE;
			}
			$font_config = us_config( 'google-fonts.' . $heading_font );
			if ( empty( $font_config ) OR ! is_array( $font_config ) ) {
				return FALSE;
			}
			$vc_font_value = array(
				'font_family' => array(),
				'font_style' => rawurlencode( '400 regular:400:normal' ),
			);
			foreach ( $font_config['variants'] as $font_family ) {
				if ( $font_family == '400' ) {
					$font_family = 'regular';
				} elseif ( $font_family == '400italic' ) {
					$font_family = 'italic';
				}
				$vc_font_value['font_family'][] = $font_family;
			}
			$vc_font_value['font_family'] = rawurlencode( $heading_font . ':' . implode( ',', $vc_font_value['font_family'] ) );
			foreach ( array( 200, 300, 400, 600, 700 ) as $weight ) {
				if ( us_get_option( 'heading_font_weight_' . $weight ) ) {
					$vc_font_value['font_style'] = rawurlencode( $weight . ' regular:' . $weight . ':normal' );
					break;
				}
			}
			$params['google_fonts'] = 'font_family:' . $vc_font_value['font_family'] . '|font_style:' . $vc_font_value['font_style'];

			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Stub for get_shortcode_regex()
	 *
	 * @param $name
	 * @param $params
	 *
	 * @return bool
	 */
	public function translate_vc_column_text( &$name, &$params ) {
		return FALSE;
	}

}

