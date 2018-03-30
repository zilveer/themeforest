<?php
/* Donations support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('morning_records_trx_donations_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_trx_donations_theme_setup', 1 );
	function morning_records_trx_donations_theme_setup() {

		// Register shortcode in the shortcodes list
		if (morning_records_exists_trx_donations()) {
			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('morning_records_filter_get_blog_type',			'morning_records_trx_donations_get_blog_type', 9, 2);
			add_filter('morning_records_filter_get_blog_title',		'morning_records_trx_donations_get_blog_title', 9, 2);
			add_filter('morning_records_filter_get_current_taxonomy',	'morning_records_trx_donations_get_current_taxonomy', 9, 2);
			add_filter('morning_records_filter_is_taxonomy',			'morning_records_trx_donations_is_taxonomy', 9, 2);
			add_filter('morning_records_filter_get_stream_page_title',	'morning_records_trx_donations_get_stream_page_title', 9, 2);
			add_filter('morning_records_filter_get_stream_page_link',	'morning_records_trx_donations_get_stream_page_link', 9, 2);
			add_filter('morning_records_filter_get_stream_page_id',	'morning_records_trx_donations_get_stream_page_id', 9, 2);
			add_filter('morning_records_filter_query_add_filters',		'morning_records_trx_donations_query_add_filters', 9, 2);
			add_filter('morning_records_filter_detect_inheritance_key','morning_records_trx_donations_detect_inheritance_key', 9, 1);
			add_filter('morning_records_filter_list_post_types',		'morning_records_trx_donations_list_post_types');
			// Register shortcodes in the list
			add_action('morning_records_action_shortcodes_list',		'morning_records_trx_donations_reg_shortcodes');
			if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
				add_action('morning_records_action_shortcodes_list_vc','morning_records_trx_donations_reg_shortcodes_vc');
			if (is_admin()) {
				add_filter( 'morning_records_filter_importer_options',				'morning_records_trx_donations_importer_set_options' );
			}
		}
		if (is_admin()) {
			add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_trx_donations_importer_required_plugins', 10, 2 );
			add_filter( 'morning_records_filter_required_plugins',				'morning_records_trx_donations_required_plugins' );
		}
	}
}

if ( !function_exists( 'morning_records_trx_donations_settings_theme_setup2' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_trx_donations_settings_theme_setup2', 3 );
	function morning_records_trx_donations_settings_theme_setup2() {
		// Add Donations post type and taxonomy into theme inheritance list
		if (morning_records_exists_trx_donations()) {
			morning_records_add_theme_inheritance( array('donations' => array(
				'stream_template' => 'blog-donations',
				'single_template' => 'single-donation',
				'taxonomy' => array(TRX_DONATIONS::TAXONOMY),
				'taxonomy_tags' => array(),
				'post_type' => array(TRX_DONATIONS::POST_TYPE),
				'override' => 'page'
				) )
			);
		}
	}
}

// Check if Donations installed and activated
if ( !function_exists( 'morning_records_exists_trx_donations' ) ) {
	function morning_records_exists_trx_donations() {
		return class_exists('TRX_DONATIONS');
	}
}


// Return true, if current page is donations page
if ( !function_exists( 'morning_records_is_trx_donations_page' ) ) {
	function morning_records_is_trx_donations_page() {
		$is = false;
		if (morning_records_exists_trx_donations()) {
			$is = in_array(morning_records_storage_get('page_template'), array('blog-donations', 'single-donation'));
			if (!$is) {
				if (!morning_records_storage_empty('pre_query'))
					$is = (morning_records_storage_call_obj_method('pre_query', 'is_single') && morning_records_storage_call_obj_method('pre_query', 'get', 'post_type') == TRX_DONATIONS::POST_TYPE) 
							|| morning_records_storage_call_obj_method('pre_query', 'is_post_type_archive', TRX_DONATIONS::POST_TYPE) 
							|| morning_records_storage_call_obj_method('pre_query', 'is_tax', TRX_DONATIONS::TAXONOMY);
				else
					$is = (is_single() && get_query_var('post_type') == TRX_DONATIONS::POST_TYPE) 
							|| is_post_type_archive(TRX_DONATIONS::POST_TYPE) 
							|| is_tax(TRX_DONATIONS::TAXONOMY);
			}
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'morning_records_trx_donations_detect_inheritance_key' ) ) {
	//add_filter('morning_records_filter_detect_inheritance_key',	'morning_records_trx_donations_detect_inheritance_key', 9, 1);
	function morning_records_trx_donations_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return morning_records_is_trx_donations_page() ? 'donations' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'morning_records_trx_donations_get_blog_type' ) ) {
	//add_filter('morning_records_filter_get_blog_type',	'morning_records_trx_donations_get_blog_type', 9, 2);
	function morning_records_trx_donations_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax(TRX_DONATIONS::TAXONOMY) || is_tax(TRX_DONATIONS::TAXONOMY))
			$page = 'donations_category';
		else if ($query && $query->get('post_type')==TRX_DONATIONS::POST_TYPE || get_query_var('post_type')==TRX_DONATIONS::POST_TYPE)
			$page = $query && $query->is_single() || is_single() ? 'donations_item' : 'donations';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'morning_records_trx_donations_get_blog_title' ) ) {
	//add_filter('morning_records_filter_get_blog_title',	'morning_records_trx_donations_get_blog_title', 9, 2);
	function morning_records_trx_donations_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( morning_records_strpos($page, 'donations')!==false ) {
			if ( $page == 'donations_category' ) {
				$term = get_term_by( 'slug', get_query_var( TRX_DONATIONS::TAXONOMY ), TRX_DONATIONS::TAXONOMY, OBJECT);
				$title = $term->name;
			} else if ( $page == 'donations_item' ) {
				$title = morning_records_get_post_title();
			} else {
				$title = esc_html__('All donations', 'morning-records');
			}
		}

		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'morning_records_trx_donations_get_stream_page_title' ) ) {
	//add_filter('morning_records_filter_get_stream_page_title',	'morning_records_trx_donations_get_stream_page_title', 9, 2);
	function morning_records_trx_donations_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (morning_records_strpos($page, 'donations')!==false) {
			if (($page_id = morning_records_trx_donations_get_stream_page_id(0, $page=='donations' ? 'blog-donations' : $page)) > 0)
				$title = morning_records_get_post_title($page_id);
			else
				$title = esc_html__('All donations', 'morning-records');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'morning_records_trx_donations_get_stream_page_id' ) ) {
	//add_filter('morning_records_filter_get_stream_page_id',	'morning_records_trx_donations_get_stream_page_id', 9, 2);
	function morning_records_trx_donations_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (morning_records_strpos($page, 'donations')!==false) $id = morning_records_get_template_page_id('blog-donations');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'morning_records_trx_donations_get_stream_page_link' ) ) {
	//add_filter('morning_records_filter_get_stream_page_link',	'morning_records_trx_donations_get_stream_page_link', 9, 2);
	function morning_records_trx_donations_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (morning_records_strpos($page, 'donations')!==false) {
			$id = morning_records_get_template_page_id('blog-donations');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'morning_records_trx_donations_get_current_taxonomy' ) ) {
	//add_filter('morning_records_filter_get_current_taxonomy',	'morning_records_trx_donations_get_current_taxonomy', 9, 2);
	function morning_records_trx_donations_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( morning_records_strpos($page, 'donations')!==false ) {
			$tax = TRX_DONATIONS::TAXONOMY;
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'morning_records_trx_donations_is_taxonomy' ) ) {
	//add_filter('morning_records_filter_is_taxonomy',	'morning_records_trx_donations_is_taxonomy', 9, 2);
	function morning_records_trx_donations_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get(TRX_DONATIONS::TAXONOMY)!='' || is_tax(TRX_DONATIONS::TAXONOMY) ? TRX_DONATIONS::TAXONOMY : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'morning_records_trx_donations_query_add_filters' ) ) {
	//add_filter('morning_records_filter_query_add_filters',	'morning_records_trx_donations_query_add_filters', 9, 2);
	function morning_records_trx_donations_query_add_filters($args, $filter) {
		if ($filter == 'donations') {
			$args['post_type'] = TRX_DONATIONS::POST_TYPE;
		}
		return $args;
	}
}

// Add custom post type to the list
if ( !function_exists( 'morning_records_trx_donations_list_post_types' ) ) {
	//add_filter('morning_records_filter_list_post_types',		'morning_records_trx_donations_list_post_types');
	function morning_records_trx_donations_list_post_types($list) {
		$list[TRX_DONATIONS::POST_TYPE] = esc_html__('Donations', 'morning-records');
		return $list;
	}
}


// Register shortcode in the shortcodes list
if (!function_exists('morning_records_trx_donations_reg_shortcodes')) {
	//add_filter('morning_records_action_shortcodes_list',	'morning_records_trx_donations_reg_shortcodes');
	function morning_records_trx_donations_reg_shortcodes() {
		if (morning_records_storage_isset('shortcodes')) {

			$plugin = TRX_DONATIONS::get_instance();
			$donations_groups = morning_records_get_list_terms(false, TRX_DONATIONS::TAXONOMY);

			morning_records_sc_map_before('trx_dropcaps', array(

				// Donations form
				"trx_donations_form" => array(
					"title" => esc_html__("Donations form", 'morning-records'),
					"desc" => esc_html__("Insert Donations form", 'morning-records'),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"title" => array(
							"title" => esc_html__("Title", 'morning-records'),
							"desc" => esc_html__("Title for the donations form", 'morning-records'),
							"value" => "",
							"type" => "text"
						),
						"subtitle" => array(
							"title" => esc_html__("Subtitle", 'morning-records'),
							"desc" => esc_html__("Subtitle for the donations form", 'morning-records'),
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => esc_html__("Description", 'morning-records'),
							"desc" => esc_html__("Short description for the donations form", 'morning-records'),
							"value" => "",
							"type" => "textarea"
						),
						"align" => array(
							"title" => esc_html__("Alignment", 'morning-records'),
							"desc" => esc_html__("Alignment of the donations form", 'morning-records'),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => morning_records_get_sc_param('align')
						),
						"account" => array(
							"title" => esc_html__("PayPal account", 'morning-records'),
							"desc" => esc_html__("PayPal account's e-mail. If empty - used from Donations settings", 'morning-records'),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"sandbox" => array(
							"title" => esc_html__("Sandbox mode", 'morning-records'),
							"desc" => esc_html__("Use PayPal sandbox to test payments", 'morning-records'),
							"dependency" => array(
								'account' => array('not_empty')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => morning_records_get_sc_param('yes_no')
						),
						"amount" => array(
							"title" => esc_html__("Default amount", 'morning-records'),
							"desc" => esc_html__("Specify amount, initially selected in the form", 'morning-records'),
							"dependency" => array(
								'account' => array('not_empty')
							),
							"value" => 5,
							"min" => 1,
							"step" => 5,
							"type" => "spinner"
						),
						"currency" => array(
							"title" => esc_html__("Currency", 'morning-records'),
							"desc" => esc_html__("Select payment's currency", 'morning-records'),
							"dependency" => array(
								'account' => array('not_empty')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => morning_records_array_merge(array(0 => esc_html__('- Select currency -', 'morning-records')), $plugin->currency_codes)
						),
						"width" => morning_records_shortcodes_width(),
						"top" => morning_records_get_sc_param('top'),
						"bottom" => morning_records_get_sc_param('bottom'),
						"left" => morning_records_get_sc_param('left'),
						"right" => morning_records_get_sc_param('right'),
						"id" => morning_records_get_sc_param('id'),
						"class" => morning_records_get_sc_param('class'),
						"css" => morning_records_get_sc_param('css')
					)
				),
				
				
				// Donations form
				"trx_donations_list" => array(
					"title" => esc_html__("Donations list", 'morning-records'),
					"desc" => esc_html__("Insert Doantions list", 'morning-records'),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"title" => array(
							"title" => esc_html__("Title", 'morning-records'),
							"desc" => esc_html__("Title for the donations list", 'morning-records'),
							"value" => "",
							"type" => "text"
						),
						"subtitle" => array(
							"title" => esc_html__("Subtitle", 'morning-records'),
							"desc" => esc_html__("Subtitle for the donations list", 'morning-records'),
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => esc_html__("Description", 'morning-records'),
							"desc" => esc_html__("Short description for the donations list", 'morning-records'),
							"value" => "",
							"type" => "textarea"
						),
						"link" => array(
							"title" => esc_html__("Button URL", 'morning-records'),
							"desc" => esc_html__("Link URL for the button at the bottom of the block", 'morning-records'),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"link_caption" => array(
							"title" => esc_html__("Button caption", 'morning-records'),
							"desc" => esc_html__("Caption for the button at the bottom of the block", 'morning-records'),
							"value" => "",
							"type" => "text"
						),
						"style" => array(
							"title" => esc_html__("List style", 'morning-records'),
							"desc" => esc_html__("Select style to display donations", 'morning-records'),
							"value" => "excerpt",
							"type" => "select",
							"options" => array(
								'excerpt' => esc_html__('Excerpt', 'morning-records')
							)
						),
						"readmore" => array(
							"title" => esc_html__("Read more text", 'morning-records'),
							"desc" => esc_html__("Text of the 'Read more' link", 'morning-records'),
							"value" => esc_html__('Read more', 'morning-records'),
							"type" => "text"
						),
						"cat" => array(
							"title" => esc_html__("Categories", 'morning-records'),
							"desc" => esc_html__("Select categories (groups) to show donations. If empty - select donations from any category (group) or from IDs list", 'morning-records'),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => morning_records_array_merge(array(0 => esc_html__('- Select category -', 'morning-records')), $donations_groups)
						),
						"count" => array(
							"title" => esc_html__("Number of donations", 'morning-records'),
							"desc" => esc_html__("How many donations will be displayed? If used IDs - this parameter ignored.", 'morning-records'),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => esc_html__("Columns", 'morning-records'),
							"desc" => esc_html__("How many columns use to show donations list", 'morning-records'),
							"value" => 3,
							"min" => 2,
							"max" => 6,
							"step" => 1,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => esc_html__("Offset before select posts", 'morning-records'),
							"desc" => esc_html__("Skip posts before select next part.", 'morning-records'),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => esc_html__("Donadions order by", 'morning-records'),
							"desc" => esc_html__("Select desired sorting method", 'morning-records'),
							"value" => "date",
							"type" => "select",
							"options" => morning_records_get_sc_param('sorting')
						),
						"order" => array(
							"title" => esc_html__("Donations order", 'morning-records'),
							"desc" => esc_html__("Select donations order", 'morning-records'),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => morning_records_get_sc_param('ordering')
						),
						"ids" => array(
							"title" => esc_html__("Donations IDs list", 'morning-records'),
							"desc" => esc_html__("Comma separated list of donations ID. If set - parameters above are ignored!", 'morning-records'),
							"value" => "",
							"type" => "text"
						),
						"top" => morning_records_get_sc_param('top'),
						"bottom" => morning_records_get_sc_param('bottom'),
						"id" => morning_records_get_sc_param('id'),
						"class" => morning_records_get_sc_param('class'),
						"css" => morning_records_get_sc_param('css')
					)
				)

			));
		}
	}
}


// Register shortcode in the VC shortcodes list
if (!function_exists('morning_records_trx_donations_reg_shortcodes_vc')) {
	//add_filter('morning_records_action_shortcodes_list_vc',	'morning_records_trx_donations_reg_shortcodes_vc');
	function morning_records_trx_donations_reg_shortcodes_vc() {

		$plugin = TRX_DONATIONS::get_instance();
		$donations_groups = morning_records_get_list_terms(false, TRX_DONATIONS::TAXONOMY);

		// Donations form
		vc_map( array(
				"base" => "trx_donations_form",
				"name" => esc_html__("Donations form", 'morning-records'),
				"description" => esc_html__("Insert Donations form", 'morning-records'),
				"category" => esc_html__('Content', 'morning-records'),
				'icon' => 'icon_trx_donations_form',
				"class" => "trx_sc_single trx_sc_donations_form",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "title",
						"heading" => esc_html__("Title", 'morning-records'),
						"description" => esc_html__("Title for the donations form", 'morning-records'),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "subtitle",
						"heading" => esc_html__("Subtitle", 'morning-records'),
						"description" => esc_html__("Subtitle for the donations form", 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "description",
						"heading" => esc_html__("Description", 'morning-records'),
						"description" => esc_html__("Description for the donations form", 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textarea"
					),
					array(
						"param_name" => "align",
						"heading" => esc_html__("Alignment", 'morning-records'),
						"description" => esc_html__("Alignment of the donations form", 'morning-records'),
						"class" => "",
						"value" => array_flip(morning_records_get_sc_param('align')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "account",
						"heading" => esc_html__("PayPal account", 'morning-records'),
						"description" => esc_html__("PayPal account's e-mail. If empty - used from Donations settings", 'morning-records'),
						"admin_label" => true,
						"group" => esc_html__('PayPal', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "sandbox",
						"heading" => esc_html__("Sandbox mode", 'morning-records'),
						"description" => esc_html__("Use PayPal sandbox to test payments", 'morning-records'),
						"admin_label" => true,
						"group" => esc_html__('PayPal', 'morning-records'),
						'dependency' => array(
							'element' => 'account',
							'not_empty' => true
						),
						"class" => "",
						"value" => array("Sandbox mode" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "amount",
						"heading" => esc_html__("Default amount", 'morning-records'),
						"description" => esc_html__("Specify amount, initially selected in the form", 'morning-records'),
						"admin_label" => true,
						"group" => esc_html__('PayPal', 'morning-records'),
						"class" => "",
						"value" => "5",
						"type" => "textfield"
					),
					array(
						"param_name" => "currency",
						"heading" => esc_html__("Currency", 'morning-records'),
						"description" => esc_html__("Select payment's currency", 'morning-records'),
						"class" => "",
						"value" => array_flip(morning_records_array_merge(array(0 => esc_html__('- Select currency -', 'morning-records')), $plugin->currency_codes)),
						"type" => "dropdown"
					),
					morning_records_get_vc_param('id'),
					morning_records_get_vc_param('class'),
					morning_records_get_vc_param('css'),
					morning_records_vc_width(),
					morning_records_get_vc_param('margin_top'),
					morning_records_get_vc_param('margin_bottom'),
					morning_records_get_vc_param('margin_left'),
					morning_records_get_vc_param('margin_right')
				)
			) );
			
		class WPBakeryShortCode_Trx_Donations_Form extends MORNING_RECORDS_VC_ShortCodeSingle {}



		// Donations list
		vc_map( array(
				"base" => "trx_donations_list",
				"name" => esc_html__("Donations list", 'morning-records'),
				"description" => esc_html__("Insert Donations list", 'morning-records'),
				"category" => esc_html__('Content', 'morning-records'),
				'icon' => 'icon_trx_donations_list',
				"class" => "trx_sc_single trx_sc_donations_list",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => esc_html__("List style", 'morning-records'),
						"description" => esc_html__("Select style to display donations", 'morning-records'),
						"class" => "",
						"value" => array(
							esc_html__('Excerpt', 'morning-records') => 'excerpt'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "title",
						"heading" => esc_html__("Title", 'morning-records'),
						"description" => esc_html__("Title for the donations form", 'morning-records'),
						"group" => esc_html__('Captions', 'morning-records'),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "subtitle",
						"heading" => esc_html__("Subtitle", 'morning-records'),
						"description" => esc_html__("Subtitle for the donations form", 'morning-records'),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "description",
						"heading" => esc_html__("Description", 'morning-records'),
						"description" => esc_html__("Description for the donations form", 'morning-records'),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textarea"
					),
					array(
						"param_name" => "link",
						"heading" => esc_html__("Button URL", 'morning-records'),
						"description" => esc_html__("Link URL for the button at the bottom of the block", 'morning-records'),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link_caption",
						"heading" => esc_html__("Button caption", 'morning-records'),
						"description" => esc_html__("Caption for the button at the bottom of the block", 'morning-records'),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "readmore",
						"heading" => esc_html__("Read more text", 'morning-records'),
						"description" => esc_html__("Text of the 'Read more' link", 'morning-records'),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => esc_html__('Read more', 'morning-records'),
						"type" => "textfield"
					),
					array(
						"param_name" => "cat",
						"heading" => esc_html__("Categories", 'morning-records'),
						"description" => esc_html__("Select category to show donations. If empty - select donations from any category (group) or from IDs list", 'morning-records'),
						"group" => esc_html__('Query', 'morning-records'),
						"class" => "",
						"value" => array_flip(morning_records_array_merge(array(0 => esc_html__('- Select category -', 'morning-records')), $donations_groups)),
						"type" => "dropdown"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'morning-records'),
						"description" => esc_html__("How many columns use to show donations", 'morning-records'),
						"group" => esc_html__('Query', 'morning-records'),
						"admin_label" => true,
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "count",
						"heading" => esc_html__("Number of posts", 'morning-records'),
						"description" => esc_html__("How many posts will be displayed? If used IDs - this parameter ignored.", 'morning-records'),
						"group" => esc_html__('Query', 'morning-records'),
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "offset",
						"heading" => esc_html__("Offset before select posts", 'morning-records'),
						"description" => esc_html__("Skip posts before select next part.", 'morning-records'),
						"group" => esc_html__('Query', 'morning-records'),
						"class" => "",
						"value" => "0",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Post sorting", 'morning-records'),
						"description" => esc_html__("Select desired posts sorting method", 'morning-records'),
						"group" => esc_html__('Query', 'morning-records'),
						"class" => "",
						"value" => array_flip(morning_records_get_sc_param('sorting')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Post order", 'morning-records'),
						"description" => esc_html__("Select desired posts order", 'morning-records'),
						"group" => esc_html__('Query', 'morning-records'),
						"class" => "",
						"value" => array_flip(morning_records_get_sc_param('ordering')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "ids",
						"heading" => esc_html__("client's IDs list", 'morning-records'),
						"description" => esc_html__("Comma separated list of donation's ID. If set - parameters above (category, count, order, etc.)  are ignored!", 'morning-records'),
						"group" => esc_html__('Query', 'morning-records'),
						'dependency' => array(
							'element' => 'cats',
							'is_empty' => true
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),

					morning_records_get_vc_param('id'),
					morning_records_get_vc_param('class'),
					morning_records_get_vc_param('css'),
					morning_records_get_vc_param('margin_top'),
					morning_records_get_vc_param('margin_bottom')
				)
			) );
			
		class WPBakeryShortCode_Trx_Donations_List extends MORNING_RECORDS_VC_ShortCodeSingle {}

	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'morning_records_trx_donations_required_plugins' ) ) {
	//add_filter('morning_records_filter_required_plugins',	'morning_records_trx_donations_required_plugins');
	function morning_records_trx_donations_required_plugins($list=array()) {
		if (in_array('trx_donations', morning_records_storage_get('required_plugins'))) {
			$path = morning_records_get_file_dir('plugins/install/trx_donations.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> 'Donations',
					'slug' 		=> 'trx_donations',
					'source'	=> $path,
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}



// One-click import support
//------------------------------------------------------------------------

// Check in the required plugins
if ( !function_exists( 'morning_records_trx_donations_importer_required_plugins' ) ) {
	//add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_trx_donations_importer_required_plugins', 10, 2 );
	function morning_records_trx_donations_importer_required_plugins($not_installed='', $list='') {
		//if (in_array('trx_donations', morning_records_storage_get('required_plugins')) && !morning_records_exists_trx_donations() )
		if (morning_records_strpos($list, 'trx_donations')!==false && !morning_records_exists_trx_donations() )
			$not_installed .= '<br>Donations';
		return $not_installed;
	}
}

// Set options for one-click importer
if ( !function_exists( 'morning_records_trx_donations_importer_set_options' ) ) {
	//add_filter( 'morning_records_filter_importer_options',	'morning_records_trx_donations_importer_set_options' );
	function morning_records_trx_donations_importer_set_options($options=array()) {
		if ( in_array('trx_donations', morning_records_storage_get('required_plugins')) && morning_records_exists_trx_donations() ) {
			// Add slugs to export options for this plugin
			$options['additional_options'][] = 'trx_donations_options';
		}
		return $options;
	}
}
?>