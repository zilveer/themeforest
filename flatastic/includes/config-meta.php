<?php

if (!class_exists('MAD_META')) {

	class MAD_META {

		function __construct() {
			add_action('init', array(&$this, 'init') );
		}

		public function init() {
			add_filter('rwmb_meta_boxes', array(&$this, 'meta_boxes_array'));
		}

		public function meta_boxes_array($mad_meta_boxes) {

			/*	Meta Box Definitions
			/* ---------------------------------------------------------------------- */

			$mad_prefix = 'mad_';

			/*	Post Format: Quote
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'post-quote-settings',
				'title'    => __('Quote Settings', 'flatastic'),
				'pages'    => array('post'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => __('The Quote', 'flatastic'),
						'id'   => $mad_prefix . 'quote',
						'type' => 'textarea',
						'std'  => '',
						'desc' => '',
						'cols' => '40',
						'rows' => '8'
					),
					array(
						'name' => __('The Author', 'flatastic'),
						'id'   => $mad_prefix . 'quote_author',
						'type' => 'text',
						'std'  => '',
						'desc' => __('(optional)', 'flatastic')
					)
				)
			);

			/*	Layout Settings
			/* ---------------------------------------------------------------------- */

			$mad_pages = get_pages('title_li=&orderby=name');
			$mad_list_pages = array('' => 'None');
			foreach ($mad_pages as $key => $entry) {
				$mad_list_pages[$entry->ID] = $entry->post_title;
			}

			$mad_list_menus = array('' => 'Default');
			$mad_menu_terms = get_terms(array(
				'taxonomy' => 'nav_menu'
			));
			if ( !empty( $mad_menu_terms ) ) {
				foreach ($mad_menu_terms as $term) {
					$mad_list_menus[$term->term_id] = $term->name;
				}
			}

			$mad_registered_sidebars = MAD_HELPER::get_registered_sidebars(array("" => 'Default Sidebar'), array('General Widget Area'));
			$mad_registered_custom_sidebars = array();

			foreach($mad_registered_sidebars as $key => $value) {
				if (strpos($key, 'Footer Row') === false) {
					$mad_registered_custom_sidebars[$key] = $value;
				}
			}

			$mad_meta_boxes[] = array(
				'id'       => 'layout-settings',
				'title'    => __('Layout', 'flatastic'),
				'pages'    => array('post', 'page', 'portfolio', 'product', 'testimonials', 'team-members'),
				'context'  => 'side',
				'priority' => 'default',
				'fields'   => array(
					array(
						'name'    => __('Header Layout', 'flatastic'),
						'id'      => $mad_prefix . 'header_layout',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Choose header layout', 'flatastic'),
						'options' => array(
							'' => __('Default', 'flatastic'),
							'type-1' => __('Header 1', 'flatastic'),
							'type-2' => __('Header 2', 'flatastic'),
							'type-3' => __('Header 3', 'flatastic'),
							'type-4' => __('Header 4', 'flatastic'),
							'type-5' => __('Header 5', 'flatastic'),
							'type-6' => __('Header 6', 'flatastic')
						)
					),
					array(
						'name'    => __('Navigation Menu primary', 'flatastic'),
						'id'      => $mad_prefix . 'nav_menu',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Choose navigation menu for primary location', 'flatastic'),
						'options' => $mad_list_menus
					),
					array(
						'name'    => __('Navigation Menu secondary', 'flatastic'),
						'id'      => $mad_prefix . 'nav_menu_secondary',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Choose navigation menu for secondary location', 'flatastic'),
						'options' => $mad_list_menus
					),
					array(
						'name'    => __('After Header Content', 'flatastic'),
						'id'      => $mad_prefix . 'header_after',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Display content after the header', 'flatastic'),
						'options' => $mad_list_pages
					),
					array(
						'name'    => __('Sidebar Position', 'flatastic'),
						'id'      => $mad_prefix . 'page_sidebar_position',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Choose page sidebar position', 'flatastic'),
						'options' => array(
							'' => __('Default Sidebar Position', 'flatastic'),
							'no_sidebar' => __('No Sidebar', 'flatastic'),
							'sbl' => __('Left Sidebar', 'flatastic'),
							'sbr' => __('Right Sidebar', 'flatastic')
						)
					),
					array(
						'name'    => __('Sidebar Setting', 'flatastic'),
						'id'      => $mad_prefix . 'page_sidebar',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Choose a custom sidebar', 'flatastic'),
						'options' => $mad_registered_custom_sidebars
					),
					array(
						'name'    => __('Breadcrumb Navigation', 'flatastic'),
						'id'      => $mad_prefix . 'breadcrumb',
						'type'    => 'select',
						'std'     => 'breadcrumb',
						'desc'    => __('Display the Breadcrumb Navigation?', 'flatastic'),
						'options' => array(
							'breadcrumb' => __('Display breadcrumbs', 'flatastic'),
							'hide' => __('Hide', 'flatastic')
						)
					),
					array(
						'name'    => '',
						'id'      => $mad_prefix . 'page_layout',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Choose page layout style', 'flatastic'),
						'options' => array(
							'' => __('Default Layout', 'flatastic'),
							'boxed_layout' => __('Boxed Layout', 'flatastic'),
							'wide_layout' => __('Wide Layout', 'flatastic')
						)
					)
				)
			);

			/*	Body Background
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'body-background',
				'title'    => __('Body Background', 'flatastic'),
				'pages'    => array('page'),
				'context'  => 'side',
				'priority' => 'default',
				'fields'   => array(
					array(
						'name'    => __('Background color', 'flatastic'),
						'id'      => $mad_prefix . 'bg_color',
						'type'    => 'color',
						'std'     => '',
						'desc'    => __('Select the background color of the body', 'flatastic')
					),
					array(
						'name'    => __('Background image', 'flatastic'),
						'id'      => $mad_prefix . 'bg_image',
						'type'    => 'thickbox_image',
						'std'     => '',
						'desc'    => __('Select the background image', 'flatastic')
					),
					array(
						'name'    => __('Background repeat', 'flatastic'),
						'id'      => $mad_prefix . 'bg_image_repeat',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Select the repeat mode for the background image', 'flatastic'),
						'options' => array(
							'' => __('Default', 'flatastic'),
							'repeat' => __('Repeat', 'flatastic'),
							'no-repeat' => __('No Repeat', 'flatastic'),
							'repeat-x' => __('Repeat Horizontally', 'flatastic'),
							'repeat-y' => __('Repeat Vertically', 'flatastic')
						)
					),
					array(
						'name'    => __('Background position', 'flatastic'),
						'id'      => $mad_prefix . 'bg_image_position',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Select the position for the background image', 'flatastic'),
						'options' => array(
							'' => __('Default', 'flatastic'),
							'top left' => __('Top left', 'flatastic'),
							'top center' => __('Top center', 'flatastic'),
							'top right' => __('Top right', 'flatastic'),
							'bottom left' => __('Bottom left', 'flatastic'),
							'bottom center' => __('Bottom center', 'flatastic'),
							'bottom right' => __('Bottom right', 'flatastic')
						)
					),
					array(
						'name'    => __('Background attachment', 'flatastic'),
						'id'      => $mad_prefix . 'bg_image_attachment',
						'type'    => 'select',
						'std'     => '',
						'desc'    => __('Select the attachment for the background image ', 'flatastic'),
						'options' => array(
							'' => __('Default', 'flatastic'),
							'scroll' => __('Scroll', 'flatastic'),
							'fixed' => __('Fixed', 'flatastic')
						)
					),
				)
			);

			/*	Team Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'team-settings',
				'title'    => __('Team Settings', 'flatastic'),
				'pages'    => array('team-members'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => __('Position', 'flatastic'),
						'id'   => $mad_prefix . 'tm_position',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					)
				)
			);

			$mad_meta_boxes[] = array(
				'id'       => 'team-social-settings',
				'title'    => __('Team Social Links', 'flatastic'),
				'pages'    => array('team-members'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => __('Facebook', 'flatastic'),
						'id'   => $mad_prefix . 'tm_facebook',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					),
					array(
						'name' => __('Twitter', 'flatastic'),
						'id'   => $mad_prefix . 'tm_twitter',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					),
					array(
						'name' => __('Google Plus', 'flatastic'),
						'id'   => $mad_prefix . 'tm_gplus',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					),
					array(
						'name' => __('Pinterest', 'flatastic'),
						'id'   => $mad_prefix . 'tm_pinterest',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					),
					array(
						'name' => __('Instagram', 'flatastic'),
						'id'   => $mad_prefix . 'tm_instagram',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					)
				)
			);

			/*	Testimonials Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'testimonials-settings',
				'title'    => __('Testimonials Settings', 'flatastic'),
				'pages'    => array('testimonials'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => __('Place', 'flatastic'),
						'id'   => $mad_prefix . 'tm_place',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					)
				)
			);

			/*	Portfolio Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'portfolio-settings',
				'title'    => __('Portfolio Slider Settings', 'flatastic'),
				'pages'    => array('portfolio'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => __('Portfolio Slider Images', 'flatastic'),
						'id'   => $mad_prefix . 'portfolio_images',
						'type' => 'image_advanced',
						'std'  => '',
						'desc' => __('Upload portfolio single images come here', 'flatastic')
					),
					array(
						'name' => __('Slideshow', 'flatastic'),
						'id'   => $mad_prefix . 'flex_slideshow',
						'type' => 'checkbox',
						'std'  => '1',
						'desc' => __('Boolean: Animate slider automatically', 'flatastic')
					),
					array(
						'name' => __('Slideshow speed', 'flatastic'),
						'id'   => $mad_prefix . 'flex_slideshow_speed',
						'type' => 'number',
						'std'  => 5000,
						'step' => 10,
						'desc' => __('Integer: Set the speed of the slideshow cycling, in milliseconds', 'flatastic')
					)
				)
			);

			/*	Masonry Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'masonry-settings',
				'title'    => __('Masonry Settings', 'flatastic'),
				'pages'    => array('portfolio'),
				'context'  => 'side',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name'    => __('Masonry Size', 'flatastic'),
						'id'      => $mad_prefix . 'masonry_size',
						'type'    => 'select',
						'options' => array(
							'masonry-big' => __('Masonry Big Size', 'flatastic'),
							'masonry-medium' => __('Masonry Medium Size', 'flatastic'),
							'masonry-small' => __('Masonry Small Size', 'flatastic'),
							'masonry-long' => __('Masonry Long Size', 'flatastic')
						),
						'std'     => 'masonry-medium',
						'desc'    => __('Choose width for masonry portfolio', 'flatastic')
					),
				)
			);

			/*	Product Settings
			/* ---------------------------------------------------------------------- */

//			$mad_meta_boxes[] = array(
//				'id' => $mad_prefix . 'product_custom_meta_box',
//				'title' => __('Custom Tab Options', 'flatastic'),
//				'pages' => array('product'),
//				'context' => 'normal',
//				'priority' => 'high',
//				'fields' => array(
//					array(
//						'name' => __('', 'flatastic'),
//						'id' => $mad_prefix . 'title_product_tab',
//						'type' => 'text',
//						'desc' => __('Title Custom Tab',  'flatastic'),
//						'std' => '',
//					),
//					array(
//						'name' => __('', 'flatastic'),
//						'id' => $mad_prefix . 'content_product_tab',
//						'desc' => __('Content Custom Tab',  'flatastic'),
//						'std' => '',
//						'type' => 'wysiwyg'
//					)
//				)
//			);

			return $mad_meta_boxes;
		}

	}

	new MAD_META;
}