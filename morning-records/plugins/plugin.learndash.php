<?php
/* LearnDash LMS support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('morning_records_learndash_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_learndash_theme_setup', 1 );
	function morning_records_learndash_theme_setup() {

		// Register shortcode in the shortcodes list
		if (morning_records_exists_learndash()) {
			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('morning_records_filter_get_blog_type',			'morning_records_learndash_get_blog_type', 9, 2);
			add_filter('morning_records_filter_get_blog_title',		'morning_records_learndash_get_blog_title', 9, 2);
			add_filter('morning_records_filter_get_current_taxonomy',	'morning_records_learndash_get_current_taxonomy', 9, 2);
			add_filter('morning_records_filter_is_taxonomy',			'morning_records_learndash_is_taxonomy', 9, 2);
			add_filter('morning_records_filter_get_stream_page_title',	'morning_records_learndash_get_stream_page_title', 9, 2);
			add_filter('morning_records_filter_get_stream_page_link',	'morning_records_learndash_get_stream_page_link', 9, 2);
			add_filter('morning_records_filter_get_stream_page_id',	'morning_records_learndash_get_stream_page_id', 9, 2);
			add_filter('morning_records_filter_query_add_filters',		'morning_records_learndash_query_add_filters', 9, 2);
			add_filter('morning_records_filter_detect_inheritance_key','morning_records_learndash_detect_inheritance_key', 9, 1);

			add_action('morning_records_action_add_styles',			'morning_records_learndash_frontend_scripts');

			// One-click importer support
			add_filter( 'morning_records_filter_importer_options',		'morning_records_learndash_importer_set_options' );

			add_filter('morning_records_filter_list_post_types', 		'morning_records_learndash_list_post_types', 10, 1);

			// Register shortcodes in the list
			//add_action('morning_records_action_shortcodes_list',		'morning_records_learndash_reg_shortcodes');
			//if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			//	add_action('morning_records_action_shortcodes_list_vc','morning_records_learndash_reg_shortcodes_vc');

			// Get list post_types and taxonomies
			morning_records_storage_set('learndash_post_types', array('sfwd-courses', 'sfwd-lessons', 'sfwd-quiz', 'sfwd-topic', 'sfwd-certificates', 'sfwd-transactions'));
			morning_records_storage_set('learndash_taxonomies', array('category'));
		}
		if (is_admin()) {
			add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_learndash_importer_required_plugins', 10, 2 );
			add_filter( 'morning_records_filter_required_plugins',				'morning_records_learndash_required_plugins' );
		}
	}
}

// Attention! Add action on 'init' instead 'before_init_theme' because LearnDash add post_types and taxonomies on this action
if ( !function_exists( 'morning_records_learndash_settings_theme_setup2' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_learndash_settings_theme_setup2', 3 );
	//add_action( 'init', 'morning_records_learndash_settings_theme_setup2', 20 );
	function morning_records_learndash_settings_theme_setup2() {
		// Add LearnDash post type and taxonomy into theme inheritance list
		if (morning_records_exists_learndash()) {
			// Get list post_types and taxonomies
			if (!empty(SFWD_CPT_Instance::$instances) && count(SFWD_CPT_Instance::$instances) > 0) {
				$post_types = array();
				foreach (SFWD_CPT_Instance::$instances as $pt=>$data)
					$post_types[] = $pt;
				if (count($post_types) > 0)
					morning_records_storage_set('learndash_post_types', $post_types);
			}
			// Add in the inheritance list
			morning_records_add_theme_inheritance( array('learndash' => array(
				'stream_template' => 'blog-learndash',
				'single_template' => 'single-learndash',
				'taxonomy' => morning_records_storage_get('learndash_taxonomies'),
				'taxonomy_tags' => array('post_tag'),
				'post_type' => morning_records_storage_get('learndash_post_types'),
				'override' => 'page'
				) )
			);
		}
	}
}



// Check if Morning records Donations installed and activated
if ( !function_exists( 'morning_records_exists_learndash' ) ) {
	function morning_records_exists_learndash() {
		return class_exists('SFWD_LMS');
	}
}


// Return true, if current page is donations page
if ( !function_exists( 'morning_records_is_learndash_page' ) ) {
	function morning_records_is_learndash_page() {
		$is = false;
		if (morning_records_exists_learndash()) {
			$is = in_array(morning_records_storage_get('page_template'), array('blog-learndash', 'single-learndash'));
			if (!$is) {
				$is = !morning_records_storage_empty('pre_query')
							? morning_records_storage_call_obj_method('pre_query', 'is_single') && in_array(morning_records_storage_call_obj_method('pre_query', 'get', 'post_type'), morning_records_storage_get('learndash_post_types'))
							: is_single() && in_array(get_query_var('post_type'), morning_records_storage_get('learndash_post_types'));
			}
			if (!$is) {
				$post_types = morning_records_storage_get('learndash_post_types');
				if (count($post_types) > 0) {
					foreach ($post_types as $pt) {
						if (!morning_records_storage_empty('pre_query') ? morning_records_storage_call_obj_method('pre_query', 'is_post_type_archive', $pt) : is_post_type_archive($pt)) {
							$is = true;
							break;
						}
					}
				}
			}
			if (!$is) {
				$taxes = morning_records_storage_get('learndash_taxonomies');
				if (count($taxes) > 0) {
					foreach ($taxes as $pt) {
						if (!morning_records_storage_empty('pre_query') ? morning_records_storage_call_obj_method('pre_query', 'is_tax', $pt) : is_tax($pt)) {
							$is = true;
							break;
						}
					}
				}
			}
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'morning_records_learndash_detect_inheritance_key' ) ) {
	//add_filter('morning_records_filter_detect_inheritance_key',	'morning_records_learndash_detect_inheritance_key', 9, 1);
	function morning_records_learndash_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return morning_records_is_learndash_page() ? 'learndash' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'morning_records_learndash_get_blog_type' ) ) {
	//add_filter('morning_records_filter_get_blog_type',	'morning_records_learndash_get_blog_type', 9, 2);
	function morning_records_learndash_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		$taxes = morning_records_storage_get('learndash_taxonomies');
		if (count($taxes) > 0) {
			foreach ($taxes as $pt) {
				if ($query && $query->is_tax($pt) || is_tax($pt)) {
					$page = 'learndash_'.$pt;
					break;
				}
			}
		}
		if (empty($page)) {
			$pt = $query ? $query->get('post_type') : get_query_var('post_type');
			if (in_array($pt, morning_records_storage_get('learndash_post_types'))) {
				$page = $query && $query->is_single() || is_single() ? 'learndash_item' : 'learndash';
			}
		}
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'morning_records_learndash_get_blog_title' ) ) {
	//add_filter('morning_records_filter_get_blog_title',	'morning_records_learndash_get_blog_title', 9, 2);
	function morning_records_learndash_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( morning_records_strpos($page, 'learndash')!==false ) {
			if ( $page == 'learndash_item' ) {
				$title = morning_records_get_post_title();
			} else if ( morning_records_strpos($page, 'learndash_')!==false ) {
				$parts = explode('_', $page);
				$term = get_term_by( 'slug', get_query_var( $parts[1] ), $parts[1], OBJECT);
				$title = $term->name;
			} else {
				$title = esc_html__('All courses', 'morning-records');
			}
		}

		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'morning_records_learndash_get_stream_page_title' ) ) {
	//add_filter('morning_records_filter_get_stream_page_title',	'morning_records_learndash_get_stream_page_title', 9, 2);
	function morning_records_learndash_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (morning_records_strpos($page, 'learndash')!==false) {
			if (($page_id = morning_records_learndash_get_stream_page_id(0, $page=='learndash' ? 'blog-learndash' : $page)) > 0)
				$title = morning_records_get_post_title($page_id);
			else
				$title = esc_html__('All courses', 'morning-records');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'morning_records_learndash_get_stream_page_id' ) ) {
	//add_filter('morning_records_filter_get_stream_page_id',	'morning_records_learndash_get_stream_page_id', 9, 2);
	function morning_records_learndash_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (morning_records_strpos($page, 'learndash')!==false) $id = morning_records_get_template_page_id('blog-learndash');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'morning_records_learndash_get_stream_page_link' ) ) {
	//add_filter('morning_records_filter_get_stream_page_link',	'morning_records_learndash_get_stream_page_link', 9, 2);
	function morning_records_learndash_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (morning_records_strpos($page, 'learndash')!==false) {
			$id = morning_records_get_template_page_id('blog-learndash');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'morning_records_learndash_get_current_taxonomy' ) ) {
	//add_filter('morning_records_filter_get_current_taxonomy',	'morning_records_learndash_get_current_taxonomy', 9, 2);
	function morning_records_learndash_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( morning_records_strpos($page, 'learndash')!==false ) {
			$taxes = morning_records_storage_get('learndash_taxonomies');
			if (count($taxes) > 0) {
				$tax = $taxes[0];
			}
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'morning_records_learndash_is_taxonomy' ) ) {
	//add_filter('morning_records_filter_is_taxonomy',	'morning_records_learndash_is_taxonomy', 9, 2);
	function morning_records_learndash_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else {
			$taxes = morning_records_storage_get('learndash_taxonomies');
			if (count($taxes) > 0) {
				foreach ($taxes as $pt) {
					if ($query && ($query->get($pt)!='' || $query->is_tax($pt)) || is_tax($pt)) {
						$tax = $pt;
						break;
					}
				}
			}
			return $tax;
		}
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'morning_records_learndash_query_add_filters' ) ) {
	//add_filter('morning_records_filter_query_add_filters',	'morning_records_learndash_query_add_filters', 9, 2);
	function morning_records_learndash_query_add_filters($args, $filter) {
		if ($filter == 'learndash') {
			$args['post_type'] = 'sfwd-courses';	//morning_records_storage_get('learndash_post_types');
		}
		return $args;
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'morning_records_learndash_required_plugins' ) ) {
	//add_filter('morning_records_filter_required_plugins',	'morning_records_learndash_required_plugins');
	function morning_records_learndash_required_plugins($list=array()) {
		if (in_array('learndash', morning_records_storage_get('required_plugins'))) {
			$path = morning_records_get_file_dir('plugins/install/sfwd-lms.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> 'LearnDash LMS',
					'slug' 		=> 'sfwd-lms',
					'source'	=> $path,
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}

// Add custom post type into list
if ( !function_exists( 'morning_records_learndash_list_post_types' ) ) {
	//add_filter('morning_records_filter_list_post_types', 	'morning_records_learndash_list_post_types', 10, 1);
	function morning_records_learndash_list_post_types($list) {
		$list['sfwd-courses'] = esc_html__('Courses (LearnDash)', 'morning-records');
		return $list;
	}
}

// Enqueue custom styles
if ( !function_exists( 'morning_records_learndash_frontend_scripts' ) ) {
	//add_action( 'morning_records_action_add_styles', 'morning_records_learndash_frontend_scripts' );
	function morning_records_learndash_frontend_scripts() {
		if (file_exists(morning_records_get_file_dir('css/plugin.learndash.css')))
			morning_records_enqueue_style( 'morning_records-plugin.learndash-style',  morning_records_get_file_url('css/plugin.learndash.css'), array(), null );
	}
}



// One-click import support
//------------------------------------------------------------------------

// Check in the required plugins
if ( !function_exists( 'morning_records_learndash_importer_required_plugins' ) ) {
	//add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_learndash_importer_required_plugins', 10, 2 );
	function morning_records_learndash_importer_required_plugins($not_installed='', $list='') {
		//if (in_array('learndash', morning_records_storage_get('required_plugins')) && !morning_records_exists_learndash() )
		if (morning_records_strpos($list, 'learndash')!==false && !morning_records_exists_learndash() )
			$not_installed .= '<br>LearnDash LMS';
		return $not_installed;
	}
}

// Set options for one-click importer
if ( !function_exists( 'morning_records_learndash_importer_set_options' ) ) {
	//add_filter( 'morning_records_filter_importer_options',	'morning_records_learndash_importer_set_options' );
	function morning_records_learndash_importer_set_options($options=array()) {
		if ( in_array('learndash', morning_records_storage_get('required_plugins')) && morning_records_exists_learndash() ) {
			// Add slugs to export options for this plugin
			$options['additional_options'][] = 'sfwd_cpt_options';
		}
		return $options;
	}
}
?>