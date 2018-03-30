<?php
/**
 * Morning records Framework: return lists
 *
 * @package morning_records
 * @since morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return styles list
if ( !function_exists( 'morning_records_get_list_styles' ) ) {
	function morning_records_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'morning-records'), $i);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the shortcodes margins
if ( !function_exists( 'morning_records_get_list_margins' ) ) {
	function morning_records_get_list_margins($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_margins'))=='') {
			$list = array(
				'null'		=> esc_html__('0 (No margin)',	'morning-records'),
				'tiny'		=> esc_html__('Tiny',		'morning-records'),
				'small'		=> esc_html__('Small',		'morning-records'),
				'medium'	=> esc_html__('Medium',		'morning-records'),
				'large'		=> esc_html__('Large',		'morning-records'),
				'huge'		=> esc_html__('Huge',		'morning-records'),
				'tiny-'		=> esc_html__('Tiny (negative)',	'morning-records'),
				'small-'	=> esc_html__('Small (negative)',	'morning-records'),
				'medium-'	=> esc_html__('Medium (negative)',	'morning-records'),
				'large-'	=> esc_html__('Large (negative)',	'morning-records'),
				'huge-'		=> esc_html__('Huge (negative)',	'morning-records')
				);
			$list = apply_filters('morning_records_filter_list_margins', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_margins', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the animations
if ( !function_exists( 'morning_records_get_list_animations' ) ) {
	function morning_records_get_list_animations($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_animations'))=='') {
			$list = array(
				'none'			=> esc_html__('- None -',	'morning-records'),
				'bounced'		=> esc_html__('Bounced',		'morning-records'),
				'flash'			=> esc_html__('Flash',		'morning-records'),
				'flip'			=> esc_html__('Flip',		'morning-records'),
				'pulse'			=> esc_html__('Pulse',		'morning-records'),
				'rubberBand'	=> esc_html__('Rubber Band',	'morning-records'),
				'shake'			=> esc_html__('Shake',		'morning-records'),
				'swing'			=> esc_html__('Swing',		'morning-records'),
				'tada'			=> esc_html__('Tada',		'morning-records'),
				'wobble'		=> esc_html__('Wobble',		'morning-records')
				);
			$list = apply_filters('morning_records_filter_list_animations', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_animations', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the line styles
if ( !function_exists( 'morning_records_get_list_line_styles' ) ) {
	function morning_records_get_list_line_styles($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_line_styles'))=='') {
			$list = array(
				'solid'	=> esc_html__('Solid', 'morning-records'),
				'dashed'=> esc_html__('Dashed', 'morning-records'),
				'dotted'=> esc_html__('Dotted', 'morning-records'),
				'double'=> esc_html__('Double', 'morning-records'),
				'image'	=> esc_html__('Image', 'morning-records')
				);
			$list = apply_filters('morning_records_filter_list_line_styles', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_line_styles', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'morning_records_get_list_animations_in' ) ) {
	function morning_records_get_list_animations_in($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_animations_in'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'morning-records'),
				'bounceIn'			=> esc_html__('Bounce In',			'morning-records'),
				'bounceInUp'		=> esc_html__('Bounce In Up',		'morning-records'),
				'bounceInDown'		=> esc_html__('Bounce In Down',		'morning-records'),
				'bounceInLeft'		=> esc_html__('Bounce In Left',		'morning-records'),
				'bounceInRight'		=> esc_html__('Bounce In Right',	'morning-records'),
				'fadeIn'			=> esc_html__('Fade In',			'morning-records'),
				'fadeInUp'			=> esc_html__('Fade In Up',			'morning-records'),
				'fadeInDown'		=> esc_html__('Fade In Down',		'morning-records'),
				'fadeInLeft'		=> esc_html__('Fade In Left',		'morning-records'),
				'fadeInRight'		=> esc_html__('Fade In Right',		'morning-records'),
				'fadeInUpBig'		=> esc_html__('Fade In Up Big',		'morning-records'),
				'fadeInDownBig'		=> esc_html__('Fade In Down Big',	'morning-records'),
				'fadeInLeftBig'		=> esc_html__('Fade In Left Big',	'morning-records'),
				'fadeInRightBig'	=> esc_html__('Fade In Right Big',	'morning-records'),
				'flipInX'			=> esc_html__('Flip In X',			'morning-records'),
				'flipInY'			=> esc_html__('Flip In Y',			'morning-records'),
				'lightSpeedIn'		=> esc_html__('Light Speed In',		'morning-records'),
				'rotateIn'			=> esc_html__('Rotate In',			'morning-records'),
				'rotateInUpLeft'	=> esc_html__('Rotate In Down Left','morning-records'),
				'rotateInUpRight'	=> esc_html__('Rotate In Up Right',	'morning-records'),
				'rotateInDownLeft'	=> esc_html__('Rotate In Up Left',	'morning-records'),
				'rotateInDownRight'	=> esc_html__('Rotate In Down Right','morning-records'),
				'rollIn'			=> esc_html__('Roll In',			'morning-records'),
				'slideInUp'			=> esc_html__('Slide In Up',		'morning-records'),
				'slideInDown'		=> esc_html__('Slide In Down',		'morning-records'),
				'slideInLeft'		=> esc_html__('Slide In Left',		'morning-records'),
				'slideInRight'		=> esc_html__('Slide In Right',		'morning-records'),
				'zoomIn'			=> esc_html__('Zoom In',			'morning-records'),
				'zoomInUp'			=> esc_html__('Zoom In Up',			'morning-records'),
				'zoomInDown'		=> esc_html__('Zoom In Down',		'morning-records'),
				'zoomInLeft'		=> esc_html__('Zoom In Left',		'morning-records'),
				'zoomInRight'		=> esc_html__('Zoom In Right',		'morning-records')
				);
			$list = apply_filters('morning_records_filter_list_animations_in', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_animations_in', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'morning_records_get_list_animations_out' ) ) {
	function morning_records_get_list_animations_out($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_animations_out'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',	'morning-records'),
				'bounceOut'			=> esc_html__('Bounce Out',			'morning-records'),
				'bounceOutUp'		=> esc_html__('Bounce Out Up',		'morning-records'),
				'bounceOutDown'		=> esc_html__('Bounce Out Down',		'morning-records'),
				'bounceOutLeft'		=> esc_html__('Bounce Out Left',		'morning-records'),
				'bounceOutRight'	=> esc_html__('Bounce Out Right',	'morning-records'),
				'fadeOut'			=> esc_html__('Fade Out',			'morning-records'),
				'fadeOutUp'			=> esc_html__('Fade Out Up',			'morning-records'),
				'fadeOutDown'		=> esc_html__('Fade Out Down',		'morning-records'),
				'fadeOutLeft'		=> esc_html__('Fade Out Left',		'morning-records'),
				'fadeOutRight'		=> esc_html__('Fade Out Right',		'morning-records'),
				'fadeOutUpBig'		=> esc_html__('Fade Out Up Big',		'morning-records'),
				'fadeOutDownBig'	=> esc_html__('Fade Out Down Big',	'morning-records'),
				'fadeOutLeftBig'	=> esc_html__('Fade Out Left Big',	'morning-records'),
				'fadeOutRightBig'	=> esc_html__('Fade Out Right Big',	'morning-records'),
				'flipOutX'			=> esc_html__('Flip Out X',			'morning-records'),
				'flipOutY'			=> esc_html__('Flip Out Y',			'morning-records'),
				'hinge'				=> esc_html__('Hinge Out',			'morning-records'),
				'lightSpeedOut'		=> esc_html__('Light Speed Out',		'morning-records'),
				'rotateOut'			=> esc_html__('Rotate Out',			'morning-records'),
				'rotateOutUpLeft'	=> esc_html__('Rotate Out Down Left',	'morning-records'),
				'rotateOutUpRight'	=> esc_html__('Rotate Out Up Right',		'morning-records'),
				'rotateOutDownLeft'	=> esc_html__('Rotate Out Up Left',		'morning-records'),
				'rotateOutDownRight'=> esc_html__('Rotate Out Down Right',	'morning-records'),
				'rollOut'			=> esc_html__('Roll Out',		'morning-records'),
				'slideOutUp'		=> esc_html__('Slide Out Up',		'morning-records'),
				'slideOutDown'		=> esc_html__('Slide Out Down',	'morning-records'),
				'slideOutLeft'		=> esc_html__('Slide Out Left',	'morning-records'),
				'slideOutRight'		=> esc_html__('Slide Out Right',	'morning-records'),
				'zoomOut'			=> esc_html__('Zoom Out',			'morning-records'),
				'zoomOutUp'			=> esc_html__('Zoom Out Up',		'morning-records'),
				'zoomOutDown'		=> esc_html__('Zoom Out Down',	'morning-records'),
				'zoomOutLeft'		=> esc_html__('Zoom Out Left',	'morning-records'),
				'zoomOutRight'		=> esc_html__('Zoom Out Right',	'morning-records')
				);
			$list = apply_filters('morning_records_filter_list_animations_out', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_animations_out', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return classes list for the specified animation
if (!function_exists('morning_records_get_animation_classes')) {
	function morning_records_get_animation_classes($animation, $speed='normal', $loop='none') {
		// speed:	fast=0.5s | normal=1s | slow=2s
		// loop:	none | infinite
		return morning_records_param_is_off($animation) ? '' : 'animated '.esc_attr($animation).' '.esc_attr($speed).(!morning_records_param_is_off($loop) ? ' '.esc_attr($loop) : '');
	}
}


// Return list of categories
if ( !function_exists( 'morning_records_get_list_categories' ) ) {
	function morning_records_get_list_categories($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_categories'))=='') {
			$list = array();
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
			$taxonomies = get_categories( $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'morning_records_get_list_terms' ) ) {
	function morning_records_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = morning_records_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			if ( is_array($taxonomy) || taxonomy_exists($taxonomy) ) {
				$terms = get_terms( $taxonomy, array(
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $taxonomy,
					'pad_counts'               => false
					)
				);
			} else {
				$terms = morning_records_get_terms_by_taxonomy_from_db($taxonomy);
			}
			if (!is_wp_error( $terms ) && is_array($terms) && count($terms) > 0) {
				foreach ($terms as $cat) {
					$list[$cat->term_id] = $cat->name;	// . ($taxonomy!='category' ? ' /'.($cat->taxonomy).'/' : '');
				}
			}
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'morning_records_get_list_posts_types' ) ) {
	function morning_records_get_list_posts_types($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_posts_types'))=='') {
			/* 
			// This way to return all registered post types
			$types = get_post_types();
			if (in_array('post', $types)) $list['post'] = esc_html__('Post', 'morning-records');
			if (is_array($types) && count($types) > 0) {
				foreach ($types as $t) {
					if ($t == 'post') continue;
					$list[$t] = morning_records_strtoproper($t);
				}
			}
			*/
			// Return only theme inheritance supported post types
			$list = apply_filters('morning_records_filter_list_post_types', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'morning_records_get_list_posts' ) ) {
	function morning_records_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (($list = morning_records_storage_get($hash))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'morning-records');
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => (int) $opt['taxonomy_value'] > 0 ? 'id' : 'slug',
						'terms' => $opt['taxonomy_value']
					)
				);
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set($hash, $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list pages
if ( !function_exists( 'morning_records_get_list_pages' ) ) {
	function morning_records_get_list_pages($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'page',
			'post_status'		=> 'publish',
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'asc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));
		return morning_records_get_list_posts($prepend_inherit, $opt);
	}
}


// Return list of registered users
if ( !function_exists( 'morning_records_get_list_users' ) ) {
	function morning_records_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = morning_records_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'morning-records');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_users', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return slider engines list, prepended inherit (if need)
if ( !function_exists( 'morning_records_get_list_sliders' ) ) {
	function morning_records_get_list_sliders($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_sliders'))=='') {
			$list = array(
				'swiper' => esc_html__("Posts slider (Swiper)", 'morning-records')
			);
			$list = apply_filters('morning_records_filter_list_sliders', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_sliders', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return slider controls list, prepended inherit (if need)
if ( !function_exists( 'morning_records_get_list_slider_controls' ) ) {
	function morning_records_get_list_slider_controls($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_slider_controls'))=='') {
			$list = array(
				'no'		=> esc_html__('None', 'morning-records'),
				'side'		=> esc_html__('Side', 'morning-records'),
				'bottom'	=> esc_html__('Bottom', 'morning-records'),
				'pagination'=> esc_html__('Pagination', 'morning-records')
				);
			$list = apply_filters('morning_records_filter_list_slider_controls', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_slider_controls', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return slider controls classes
if ( !function_exists( 'morning_records_get_slider_controls_classes' ) ) {
	function morning_records_get_slider_controls_classes($controls) {
		if (morning_records_param_is_off($controls))	$classes = 'sc_slider_nopagination sc_slider_nocontrols';
		else if ($controls=='bottom')			$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_bottom';
		else if ($controls=='pagination')		$classes = 'sc_slider_pagination sc_slider_pagination_bottom sc_slider_nocontrols';
		else									$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_side';
		return $classes;
	}
}

// Return list with popup engines
if ( !function_exists( 'morning_records_get_list_popup_engines' ) ) {
	function morning_records_get_list_popup_engines($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_popup_engines'))=='') {
			$list = array(
				"pretty"	=> esc_html__("Pretty photo", 'morning-records'),
				"magnific"	=> esc_html__("Magnific popup", 'morning-records')
				);
			$list = apply_filters('morning_records_filter_list_popup_engines', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_popup_engines', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'morning_records_get_list_menus' ) ) {
	function morning_records_get_list_menus($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'morning-records');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'morning_records_get_list_sidebars' ) ) {
	function morning_records_get_list_sidebars($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_sidebars'))=='') {
			if (($list = morning_records_storage_get('registered_sidebars'))=='') $list = array();
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_sidebars', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'morning_records_get_list_sidebars_positions' ) ) {
	function morning_records_get_list_sidebars_positions($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_sidebars_positions'))=='') {
			$list = array(
				'none'  => esc_html__('Hide',  'morning-records'),
				'left'  => esc_html__('Left',  'morning-records'),
				'right' => esc_html__('Right', 'morning-records')
				);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_sidebars_positions', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return sidebars class
if ( !function_exists( 'morning_records_get_sidebar_class' ) ) {
	function morning_records_get_sidebar_class() {
		$sb_main = morning_records_get_custom_option('show_sidebar_main');
		$sb_outer = morning_records_get_custom_option('show_sidebar_outer');
		return (morning_records_param_is_off($sb_main) ? 'sidebar_hide' : 'sidebar_show sidebar_'.($sb_main))
				. ' ' . (morning_records_param_is_off($sb_outer) ? 'sidebar_outer_hide' : 'sidebar_outer_show sidebar_outer_'.($sb_outer));
	}
}

// Return body styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_body_styles' ) ) {
	function morning_records_get_list_body_styles($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_body_styles'))=='') {
			$list = array(
				'boxed'	=> esc_html__('Boxed',		'morning-records'),
				'wide'	=> esc_html__('Wide',		'morning-records')
				);
			if (morning_records_get_theme_setting('allow_fullscreen')) {
				$list['fullwide']	= esc_html__('Fullwide',	'morning-records');
				$list['fullscreen']	= esc_html__('Fullscreen',	'morning-records');
			}
			$list = apply_filters('morning_records_filter_list_body_styles', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_body_styles', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return skins list, prepended inherit
if ( !function_exists( 'morning_records_get_list_skins' ) ) {
	function morning_records_get_list_skins($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_skins'))=='') {
			$list = morning_records_get_list_folders("skins");
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_skins', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return css-themes list
if ( !function_exists( 'morning_records_get_list_themes' ) ) {
	function morning_records_get_list_themes($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_themes'))=='') {
			$list = morning_records_get_list_files("css/themes");
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_themes', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return templates list, prepended inherit
if ( !function_exists( 'morning_records_get_list_templates' ) ) {
	function morning_records_get_list_templates($mode='') {
		if (($list = morning_records_storage_get('list_templates_'.($mode)))=='') {
			$list = array();
			$tpl = morning_records_storage_get('registered_templates');
			if (is_array($tpl) && count($tpl) > 0) {
				foreach ($tpl as $k=>$v) {
					if ($mode=='' || in_array($mode, explode(',', $v['mode'])))
						$list[$k] = !empty($v['icon']) 
									? $v['icon'] 
									: (!empty($v['title']) 
										? $v['title'] 
										: morning_records_strtoproper($v['layout'])
										);
				}
			}
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_templates_'.($mode), $list);
		}
		return $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_templates_blog' ) ) {
	function morning_records_get_list_templates_blog($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_templates_blog'))=='') {
			$list = morning_records_get_list_templates('blog');
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_templates_blog', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return blogger styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_templates_blogger' ) ) {
	function morning_records_get_list_templates_blogger($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_templates_blogger'))=='') {
			$list = morning_records_array_merge(morning_records_get_list_templates('blogger'), morning_records_get_list_templates('blog'));
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_templates_blogger', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return single page styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_templates_single' ) ) {
	function morning_records_get_list_templates_single($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_templates_single'))=='') {
			$list = morning_records_get_list_templates('single');
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_templates_single', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return header styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_templates_header' ) ) {
	function morning_records_get_list_templates_header($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_templates_header'))=='') {
			$list = morning_records_get_list_templates('header');
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_templates_header', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return form styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_templates_forms' ) ) {
	function morning_records_get_list_templates_forms($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_templates_forms'))=='') {
			$list = morning_records_get_list_templates('forms');
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_templates_forms', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return article styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_article_styles' ) ) {
	function morning_records_get_list_article_styles($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_article_styles'))=='') {
			$list = array(
				"boxed"   => esc_html__('Boxed', 'morning-records'),
				"stretch" => esc_html__('Stretch', 'morning-records')
				);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_article_styles', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return post-formats filters list, prepended inherit
if ( !function_exists( 'morning_records_get_list_post_formats_filters' ) ) {
	function morning_records_get_list_post_formats_filters($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_post_formats_filters'))=='') {
			$list = array(
				"no"      => esc_html__('All posts', 'morning-records'),
				"thumbs"  => esc_html__('With thumbs', 'morning-records'),
				"reviews" => esc_html__('With reviews', 'morning-records'),
				"video"   => esc_html__('With videos', 'morning-records'),
				"audio"   => esc_html__('With audios', 'morning-records'),
				"gallery" => esc_html__('With galleries', 'morning-records')
				);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_post_formats_filters', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return portfolio filters list, prepended inherit
if ( !function_exists( 'morning_records_get_list_portfolio_filters' ) ) {
	function morning_records_get_list_portfolio_filters($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_portfolio_filters'))=='') {
			$list = array(
				"hide"		=> esc_html__('Hide', 'morning-records'),
				"tags"		=> esc_html__('Tags', 'morning-records'),
				"categories"=> esc_html__('Categories', 'morning-records')
				);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_portfolio_filters', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return hover styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_hovers' ) ) {
	function morning_records_get_list_hovers($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_hovers'))=='') {
			$list = array();
			$list['circle effect1']  = esc_html__('Circle Effect 1',  'morning-records');
			$list['circle effect2']  = esc_html__('Circle Effect 2',  'morning-records');
			$list['circle effect3']  = esc_html__('Circle Effect 3',  'morning-records');
			$list['circle effect4']  = esc_html__('Circle Effect 4',  'morning-records');
			$list['circle effect5']  = esc_html__('Circle Effect 5',  'morning-records');
			$list['circle effect6']  = esc_html__('Circle Effect 6',  'morning-records');
			$list['circle effect7']  = esc_html__('Circle Effect 7',  'morning-records');
			$list['circle effect8']  = esc_html__('Circle Effect 8',  'morning-records');
			$list['circle effect9']  = esc_html__('Circle Effect 9',  'morning-records');
			$list['circle effect10'] = esc_html__('Circle Effect 10',  'morning-records');
			$list['circle effect11'] = esc_html__('Circle Effect 11',  'morning-records');
			$list['circle effect12'] = esc_html__('Circle Effect 12',  'morning-records');
			$list['circle effect13'] = esc_html__('Circle Effect 13',  'morning-records');
			$list['circle effect14'] = esc_html__('Circle Effect 14',  'morning-records');
			$list['circle effect15'] = esc_html__('Circle Effect 15',  'morning-records');
			$list['circle effect16'] = esc_html__('Circle Effect 16',  'morning-records');
			$list['circle effect17'] = esc_html__('Circle Effect 17',  'morning-records');
			$list['circle effect18'] = esc_html__('Circle Effect 18',  'morning-records');
			$list['circle effect19'] = esc_html__('Circle Effect 19',  'morning-records');
			$list['circle effect20'] = esc_html__('Circle Effect 20',  'morning-records');
			$list['square effect1']  = esc_html__('Square Effect 1',  'morning-records');
			$list['square effect2']  = esc_html__('Square Effect 2',  'morning-records');
			$list['square effect3']  = esc_html__('Square Effect 3',  'morning-records');
	//		$list['square effect4']  = esc_html__('Square Effect 4',  'morning-records');
			$list['square effect5']  = esc_html__('Square Effect 5',  'morning-records');
			$list['square effect6']  = esc_html__('Square Effect 6',  'morning-records');
			$list['square effect7']  = esc_html__('Square Effect 7',  'morning-records');
			$list['square effect8']  = esc_html__('Square Effect 8',  'morning-records');
			$list['square effect9']  = esc_html__('Square Effect 9',  'morning-records');
			$list['square effect10'] = esc_html__('Square Effect 10',  'morning-records');
			$list['square effect11'] = esc_html__('Square Effect 11',  'morning-records');
			$list['square effect12'] = esc_html__('Square Effect 12',  'morning-records');
			$list['square effect13'] = esc_html__('Square Effect 13',  'morning-records');
			$list['square effect14'] = esc_html__('Square Effect 14',  'morning-records');
			$list['square effect15'] = esc_html__('Square Effect 15',  'morning-records');
			$list['square effect_dir']   = esc_html__('Square Effect Dir',   'morning-records');
			$list['square effect_shift'] = esc_html__('Square Effect Shift', 'morning-records');
			$list['square effect_book']  = esc_html__('Square Effect Book',  'morning-records');
			$list['square effect_more']  = esc_html__('Square Effect More',  'morning-records');
			$list['square effect_fade']  = esc_html__('Square Effect Fade',  'morning-records');
			$list = apply_filters('morning_records_filter_portfolio_hovers', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_hovers', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the blog counters
if ( !function_exists( 'morning_records_get_list_blog_counters' ) ) {
	function morning_records_get_list_blog_counters($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_blog_counters'))=='') {
			$list = array(
				'views'		=> esc_html__('Views', 'morning-records'),
				'likes'		=> esc_html__('Likes', 'morning-records'),
				'rating'	=> esc_html__('Rating', 'morning-records'),
				'comments'	=> esc_html__('Comments', 'morning-records')
				);
			$list = apply_filters('morning_records_filter_list_blog_counters', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_blog_counters', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list of the item sizes for the portfolio alter style, prepended inherit
if ( !function_exists( 'morning_records_get_list_alter_sizes' ) ) {
	function morning_records_get_list_alter_sizes($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_alter_sizes'))=='') {
			$list = array(
					'1_1' => esc_html__('1x1', 'morning-records'),
					'1_2' => esc_html__('1x2', 'morning-records'),
					'2_1' => esc_html__('2x1', 'morning-records'),
					'2_2' => esc_html__('2x2', 'morning-records'),
					'1_3' => esc_html__('1x3', 'morning-records'),
					'2_3' => esc_html__('2x3', 'morning-records'),
					'3_1' => esc_html__('3x1', 'morning-records'),
					'3_2' => esc_html__('3x2', 'morning-records'),
					'3_3' => esc_html__('3x3', 'morning-records')
					);
			$list = apply_filters('morning_records_filter_portfolio_alter_sizes', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_alter_sizes', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return extended hover directions list, prepended inherit
if ( !function_exists( 'morning_records_get_list_hovers_directions' ) ) {
	function morning_records_get_list_hovers_directions($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_hovers_directions'))=='') {
			$list = array(
				'left_to_right' => esc_html__('Left to Right',  'morning-records'),
				'right_to_left' => esc_html__('Right to Left',  'morning-records'),
				'top_to_bottom' => esc_html__('Top to Bottom',  'morning-records'),
				'bottom_to_top' => esc_html__('Bottom to Top',  'morning-records'),
				'scale_up'      => esc_html__('Scale Up',  'morning-records'),
				'scale_down'    => esc_html__('Scale Down',  'morning-records'),
				'scale_down_up' => esc_html__('Scale Down-Up',  'morning-records'),
				'from_left_and_right' => esc_html__('From Left and Right',  'morning-records'),
				'from_top_and_bottom' => esc_html__('From Top and Bottom',  'morning-records')
			);
			$list = apply_filters('morning_records_filter_portfolio_hovers_directions', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_hovers_directions', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the label positions in the custom forms
if ( !function_exists( 'morning_records_get_list_label_positions' ) ) {
	function morning_records_get_list_label_positions($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_label_positions'))=='') {
			$list = array(
				'top'		=> esc_html__('Top',		'morning-records'),
				'bottom'	=> esc_html__('Bottom',		'morning-records'),
				'left'		=> esc_html__('Left',		'morning-records'),
				'over'		=> esc_html__('Over',		'morning-records')
			);
			$list = apply_filters('morning_records_filter_label_positions', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_label_positions', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the bg image positions
if ( !function_exists( 'morning_records_get_list_bg_image_positions' ) ) {
	function morning_records_get_list_bg_image_positions($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_bg_image_positions'))=='') {
			$list = array(
				'left top'	   => esc_html__('Left Top', 'morning-records'),
				'center top'   => esc_html__("Center Top", 'morning-records'),
				'right top'    => esc_html__("Right Top", 'morning-records'),
				'left center'  => esc_html__("Left Center", 'morning-records'),
				'center center'=> esc_html__("Center Center", 'morning-records'),
				'right center' => esc_html__("Right Center", 'morning-records'),
				'left bottom'  => esc_html__("Left Bottom", 'morning-records'),
				'center bottom'=> esc_html__("Center Bottom", 'morning-records'),
				'right bottom' => esc_html__("Right Bottom", 'morning-records')
			);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_bg_image_positions', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the bg image repeat
if ( !function_exists( 'morning_records_get_list_bg_image_repeats' ) ) {
	function morning_records_get_list_bg_image_repeats($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_bg_image_repeats'))=='') {
			$list = array(
				'repeat'	=> esc_html__('Repeat', 'morning-records'),
				'repeat-x'	=> esc_html__('Repeat X', 'morning-records'),
				'repeat-y'	=> esc_html__('Repeat Y', 'morning-records'),
				'no-repeat'	=> esc_html__('No Repeat', 'morning-records')
			);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_bg_image_repeats', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the bg image attachment
if ( !function_exists( 'morning_records_get_list_bg_image_attachments' ) ) {
	function morning_records_get_list_bg_image_attachments($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_bg_image_attachments'))=='') {
			$list = array(
				'scroll'	=> esc_html__('Scroll', 'morning-records'),
				'fixed'		=> esc_html__('Fixed', 'morning-records'),
				'local'		=> esc_html__('Local', 'morning-records')
			);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_bg_image_attachments', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}


// Return list of the bg tints
if ( !function_exists( 'morning_records_get_list_bg_tints' ) ) {
	function morning_records_get_list_bg_tints($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_bg_tints'))=='') {
			$list = array(
				'white'	=> esc_html__('White', 'morning-records'),
				'light'	=> esc_html__('Light', 'morning-records'),
				'dark'	=> esc_html__('Dark', 'morning-records')
			);
			$list = apply_filters('morning_records_filter_bg_tints', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_bg_tints', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return custom fields types list, prepended inherit
if ( !function_exists( 'morning_records_get_list_field_types' ) ) {
	function morning_records_get_list_field_types($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_field_types'))=='') {
			$list = array(
				'text'     => esc_html__('Text',  'morning-records'),
				'textarea' => esc_html__('Text Area','morning-records'),
				'password' => esc_html__('Password',  'morning-records'),
				'radio'    => esc_html__('Radio',  'morning-records'),
				'checkbox' => esc_html__('Checkbox',  'morning-records'),
				'select'   => esc_html__('Select',  'morning-records'),
				'date'     => esc_html__('Date','morning-records'),
				'time'     => esc_html__('Time','morning-records'),
				'button'   => esc_html__('Button','morning-records')
			);
			$list = apply_filters('morning_records_filter_field_types', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_field_types', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return Google map styles
if ( !function_exists( 'morning_records_get_list_googlemap_styles' ) ) {
	function morning_records_get_list_googlemap_styles($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_googlemap_styles'))=='') {
			$list = array(
				'default' => esc_html__('Default', 'morning-records')
			);
			$list = apply_filters('morning_records_filter_googlemap_styles', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_googlemap_styles', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'morning_records_get_list_icons' ) ) {
	function morning_records_get_list_icons($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_icons'))=='') {
			$list = morning_records_parse_icons_classes(morning_records_get_file_dir("css/fontello/css/fontello-codes.css"));
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_icons', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return socials list
if ( !function_exists( 'morning_records_get_list_socials' ) ) {
	function morning_records_get_list_socials($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_socials'))=='') {
			$list = morning_records_get_list_files("images/socials", "png");
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_socials', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return flags list
if ( !function_exists( 'morning_records_get_list_flags' ) ) {
	function morning_records_get_list_flags($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_flags'))=='') {
			$list = morning_records_get_list_files("images/flags", "png");
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_flags', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'morning_records_get_list_yesno' ) ) {
	function morning_records_get_list_yesno($prepend_inherit=false) {
		$list = array(
			'yes' => esc_html__("Yes", 'morning-records'),
			'no'  => esc_html__("No", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'morning_records_get_list_onoff' ) ) {
	function morning_records_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on" => esc_html__("On", 'morning-records'),
			"off" => esc_html__("Off", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'morning_records_get_list_showhide' ) ) {
	function morning_records_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'morning-records'),
			"hide" => esc_html__("Hide", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with 'Ascending' and 'Descending' items
if ( !function_exists( 'morning_records_get_list_orderings' ) ) {
	function morning_records_get_list_orderings($prepend_inherit=false) {
		$list = array(
			"asc" => esc_html__("Ascending", 'morning-records'),
			"desc" => esc_html__("Descending", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'morning_records_get_list_directions' ) ) {
	function morning_records_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'morning-records'),
			"vertical" => esc_html__("Vertical", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with item's shapes
if ( !function_exists( 'morning_records_get_list_shapes' ) ) {
	function morning_records_get_list_shapes($prepend_inherit=false) {
		$list = array(
			"round"  => esc_html__("Round", 'morning-records'),
			"square" => esc_html__("Square", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with item's sizes
if ( !function_exists( 'morning_records_get_list_sizes' ) ) {
	function morning_records_get_list_sizes($prepend_inherit=false) {
		$list = array(
			"tiny"   => esc_html__("Tiny", 'morning-records'),
			"small"  => esc_html__("Small", 'morning-records'),
			"medium" => esc_html__("Medium", 'morning-records'),
			"large"  => esc_html__("Large", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with slider (scroll) controls positions
if ( !function_exists( 'morning_records_get_list_controls' ) ) {
	function morning_records_get_list_controls($prepend_inherit=false) {
		$list = array(
			"hide" => esc_html__("Hide", 'morning-records'),
			"side" => esc_html__("Side", 'morning-records'),
			"bottom" => esc_html__("Bottom", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with float items
if ( !function_exists( 'morning_records_get_list_floats' ) ) {
	function morning_records_get_list_floats($prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'morning-records'),
			"left" => esc_html__("Float Left", 'morning-records'),
			"right" => esc_html__("Float Right", 'morning-records')
		);
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with alignment items
if ( !function_exists( 'morning_records_get_list_alignments' ) ) {
	function morning_records_get_list_alignments($justify=false, $prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'morning-records'),
			"left" => esc_html__("Left", 'morning-records'),
			"center" => esc_html__("Center", 'morning-records'),
			"right" => esc_html__("Right", 'morning-records')
		);
		if ($justify) $list["justify"] = esc_html__("Justify", 'morning-records');
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with horizontal positions
if ( !function_exists( 'morning_records_get_list_hpos' ) ) {
	function morning_records_get_list_hpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['left'] = esc_html__("Left", 'morning-records');
		if ($center) $list['center'] = esc_html__("Center", 'morning-records');
		$list['right'] = esc_html__("Right", 'morning-records');
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with vertical positions
if ( !function_exists( 'morning_records_get_list_vpos' ) ) {
	function morning_records_get_list_vpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['top'] = esc_html__("Top", 'morning-records');
		if ($center) $list['center'] = esc_html__("Center", 'morning-records');
		$list['bottom'] = esc_html__("Bottom", 'morning-records');
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return sorting list items
if ( !function_exists( 'morning_records_get_list_sortings' ) ) {
	function morning_records_get_list_sortings($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_sortings'))=='') {
			$list = array(
				"date" => esc_html__("Date", 'morning-records'),
				"title" => esc_html__("Alphabetically", 'morning-records'),
				"views" => esc_html__("Popular (views count)", 'morning-records'),
				"comments" => esc_html__("Most commented (comments count)", 'morning-records'),
				"author_rating" => esc_html__("Author rating", 'morning-records'),
				"users_rating" => esc_html__("Visitors (users) rating", 'morning-records'),
				"random" => esc_html__("Random", 'morning-records')
			);
			$list = apply_filters('morning_records_filter_list_sortings', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_sortings', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list with columns widths
if ( !function_exists( 'morning_records_get_list_columns' ) ) {
	function morning_records_get_list_columns($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_columns'))=='') {
			$list = array(
				"none" => esc_html__("None", 'morning-records'),
				"1_1" => esc_html__("100%", 'morning-records'),
				"1_2" => esc_html__("1/2", 'morning-records'),
				"1_3" => esc_html__("1/3", 'morning-records'),
				"2_3" => esc_html__("2/3", 'morning-records'),
				"1_4" => esc_html__("1/4", 'morning-records'),
				"3_4" => esc_html__("3/4", 'morning-records'),
				"1_5" => esc_html__("1/5", 'morning-records'),
				"2_5" => esc_html__("2/5", 'morning-records'),
				"3_5" => esc_html__("3/5", 'morning-records'),
				"4_5" => esc_html__("4/5", 'morning-records'),
				"1_6" => esc_html__("1/6", 'morning-records'),
				"5_6" => esc_html__("5/6", 'morning-records'),
				"1_7" => esc_html__("1/7", 'morning-records'),
				"2_7" => esc_html__("2/7", 'morning-records'),
				"3_7" => esc_html__("3/7", 'morning-records'),
				"4_7" => esc_html__("4/7", 'morning-records'),
				"5_7" => esc_html__("5/7", 'morning-records'),
				"6_7" => esc_html__("6/7", 'morning-records'),
				"1_8" => esc_html__("1/8", 'morning-records'),
				"3_8" => esc_html__("3/8", 'morning-records'),
				"5_8" => esc_html__("5/8", 'morning-records'),
				"7_8" => esc_html__("7/8", 'morning-records'),
				"1_9" => esc_html__("1/9", 'morning-records'),
				"2_9" => esc_html__("2/9", 'morning-records'),
				"4_9" => esc_html__("4/9", 'morning-records'),
				"5_9" => esc_html__("5/9", 'morning-records'),
				"7_9" => esc_html__("7/9", 'morning-records'),
				"8_9" => esc_html__("8/9", 'morning-records'),
				"1_10"=> esc_html__("1/10", 'morning-records'),
				"3_10"=> esc_html__("3/10", 'morning-records'),
				"7_10"=> esc_html__("7/10", 'morning-records'),
				"9_10"=> esc_html__("9/10", 'morning-records'),
				"1_11"=> esc_html__("1/11", 'morning-records'),
				"2_11"=> esc_html__("2/11", 'morning-records'),
				"3_11"=> esc_html__("3/11", 'morning-records'),
				"4_11"=> esc_html__("4/11", 'morning-records'),
				"5_11"=> esc_html__("5/11", 'morning-records'),
				"6_11"=> esc_html__("6/11", 'morning-records'),
				"7_11"=> esc_html__("7/11", 'morning-records'),
				"8_11"=> esc_html__("8/11", 'morning-records'),
				"9_11"=> esc_html__("9/11", 'morning-records'),
				"10_11"=> esc_html__("10/11", 'morning-records'),
				"1_12"=> esc_html__("1/12", 'morning-records'),
				"5_12"=> esc_html__("5/12", 'morning-records'),
				"7_12"=> esc_html__("7/12", 'morning-records'),
				"10_12"=> esc_html__("10/12", 'morning-records'),
				"11_12"=> esc_html__("11/12", 'morning-records')
			);
			$list = apply_filters('morning_records_filter_list_columns', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_columns', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return list of locations for the dedicated content
if ( !function_exists( 'morning_records_get_list_dedicated_locations' ) ) {
	function morning_records_get_list_dedicated_locations($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_dedicated_locations'))=='') {
			$list = array(
				"default" => esc_html__('As in the post defined', 'morning-records'),
				"center"  => esc_html__('Above the text of the post', 'morning-records'),
				"left"    => esc_html__('To the left the text of the post', 'morning-records'),
				"right"   => esc_html__('To the right the text of the post', 'morning-records'),
				"alter"   => esc_html__('Alternates for each post', 'morning-records')
			);
			$list = apply_filters('morning_records_filter_list_dedicated_locations', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_dedicated_locations', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return post-format name
if ( !function_exists( 'morning_records_get_post_format_name' ) ) {
	function morning_records_get_post_format_name($format, $single=true) {
		$name = '';
		if ($format=='gallery')		$name = $single ? esc_html__('gallery', 'morning-records') : esc_html__('galleries', 'morning-records');
		else if ($format=='video')	$name = $single ? esc_html__('video', 'morning-records') : esc_html__('videos', 'morning-records');
		else if ($format=='audio')	$name = $single ? esc_html__('audio', 'morning-records') : esc_html__('audios', 'morning-records');
		else if ($format=='image')	$name = $single ? esc_html__('image', 'morning-records') : esc_html__('images', 'morning-records');
		else if ($format=='quote')	$name = $single ? esc_html__('quote', 'morning-records') : esc_html__('quotes', 'morning-records');
		else if ($format=='link')	$name = $single ? esc_html__('link', 'morning-records') : esc_html__('links', 'morning-records');
		else if ($format=='status')	$name = $single ? esc_html__('status', 'morning-records') : esc_html__('statuses', 'morning-records');
		else if ($format=='aside')	$name = $single ? esc_html__('aside', 'morning-records') : esc_html__('asides', 'morning-records');
		else if ($format=='chat')	$name = $single ? esc_html__('chat', 'morning-records') : esc_html__('chats', 'morning-records');
		else						$name = $single ? esc_html__('standard', 'morning-records') : esc_html__('standards', 'morning-records');
		return apply_filters('morning_records_filter_list_post_format_name', $name, $format);
	}
}

// Return post-format icon name (from Fontello library)
if ( !function_exists( 'morning_records_get_post_format_icon' ) ) {
	function morning_records_get_post_format_icon($format) {
		$icon = 'icon-';
		if ($format=='gallery')		$icon .= 'pictures';
		else if ($format=='video')	$icon .= 'video';
		else if ($format=='audio')	$icon .= 'note';
		else if ($format=='image')	$icon .= 'picture';
		else if ($format=='quote')	$icon .= 'quote';
		else if ($format=='link')	$icon .= 'link';
		else if ($format=='status')	$icon .= 'comment';
		else if ($format=='aside')	$icon .= 'doc-text';
		else if ($format=='chat')	$icon .= 'chat';
		else						$icon .= 'book-open';
		return apply_filters('morning_records_filter_list_post_format_icon', $icon, $format);
	}
}

// Return fonts styles list, prepended inherit
if ( !function_exists( 'morning_records_get_list_fonts_styles' ) ) {
	function morning_records_get_list_fonts_styles($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_fonts_styles'))=='') {
			$list = array(
				'i' => esc_html__('I','morning-records'),
				'u' => esc_html__('U', 'morning-records')
			);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_fonts_styles', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return Google fonts list
if ( !function_exists( 'morning_records_get_list_fonts' ) ) {
	function morning_records_get_list_fonts($prepend_inherit=false) {
		if (($list = morning_records_storage_get('list_fonts'))=='') {
			$list = array();
			$list = morning_records_array_merge($list, morning_records_get_list_font_faces());
			// Google and custom fonts list:
			//$list['Advent Pro'] = array(
			//		'family'=>'sans-serif',																						// (required) font family
			//		'link'=>'Advent+Pro:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic',	// (optional) if you use Google font repository
			//		'css'=>morning_records_get_file_url('/css/font-face/Advent-Pro/stylesheet.css')									// (optional) if you use custom font-face
			//		);
			$list = morning_records_array_merge($list, array(
				'Advent Pro' => array('family'=>'sans-serif'),
				'Alegreya Sans' => array('family'=>'sans-serif'),
				'Arimo' => array('family'=>'sans-serif'),
				'Asap' => array('family'=>'sans-serif'),
				'Averia Sans Libre' => array('family'=>'cursive'),
				'Averia Serif Libre' => array('family'=>'cursive'),
				'Bree Serif' => array('family'=>'serif',),
				'Cabin' => array('family'=>'sans-serif'),
				'Cabin Condensed' => array('family'=>'sans-serif'),
				'Caudex' => array('family'=>'serif'),
				'Comfortaa' => array('family'=>'cursive'),
				'Cousine' => array('family'=>'sans-serif'),
				'Crimson Text' => array('family'=>'serif'),
				'Cuprum' => array('family'=>'sans-serif'),
				'Dosis' => array('family'=>'sans-serif'),
				'Economica' => array('family'=>'sans-serif'),
				'Exo' => array('family'=>'sans-serif'),
				'Expletus Sans' => array('family'=>'cursive'),
				'Karla' => array('family'=>'sans-serif'),
				'Lato' => array('family'=>'sans-serif'),
				'Lekton' => array('family'=>'sans-serif'),
				'Lobster Two' => array('family'=>'cursive'),
				'Maven Pro' => array('family'=>'sans-serif'),
				'Merriweather' => array('family'=>'serif'),
				'Montserrat' => array('family'=>'sans-serif'),
				'Neuton' => array('family'=>'serif'),
				'Noticia Text' => array('family'=>'serif'),
				'Old Standard TT' => array('family'=>'serif'),
				'Open Sans' => array('family'=>'sans-serif'),
				'Orbitron' => array('family'=>'sans-serif'),
				'Oswald' => array('family'=>'sans-serif'),
				'Overlock' => array('family'=>'cursive'),
				'Oxygen' => array('family'=>'sans-serif'),
				'Philosopher' => array('family'=>'serif'),
				'PT Serif' => array('family'=>'serif'),
				'Puritan' => array('family'=>'sans-serif'),
				'Raleway' => array('family'=>'sans-serif'),
				'Roboto' => array('family'=>'sans-serif'),
				'Roboto Slab' => array('family'=>'sans-serif'),
				'Roboto Condensed' => array('family'=>'sans-serif'),
				'Rosario' => array('family'=>'sans-serif'),
				'Share' => array('family'=>'cursive'),
				'Signika' => array('family'=>'sans-serif'),
				'Signika Negative' => array('family'=>'sans-serif'),
				'Source Sans Pro' => array('family'=>'sans-serif'),
				'Tinos' => array('family'=>'serif'),
				'Ubuntu' => array('family'=>'sans-serif'),
				'Vollkorn' => array('family'=>'serif')
				)
			);
			$list = apply_filters('morning_records_filter_list_fonts', $list);
			if (morning_records_get_theme_setting('use_list_cache')) morning_records_storage_set('list_fonts', $list);
		}
		return $prepend_inherit ? morning_records_array_merge(array('inherit' => esc_html__("Inherit", 'morning-records')), $list) : $list;
	}
}

// Return Custom font-face list
if ( !function_exists( 'morning_records_get_list_font_faces' ) ) {
	function morning_records_get_list_font_faces($prepend_inherit=false) {
		static $list = false;
		if (is_array($list)) return $list;
		$list = array();
		$dir = morning_records_get_folder_dir("css/font-face");
		if ( is_dir($dir) ) {
			$hdir = @ opendir( $dir );
			if ( $hdir ) {
				while (($file = readdir( $hdir ) ) !== false ) {
					$pi = pathinfo( ($dir) . '/' . ($file) );
					if ( substr($file, 0, 1) == '.' || ! is_dir( ($dir) . '/' . ($file) ) )
						continue;
					$css = file_exists( ($dir) . '/' . ($file) . '/' . ($file) . '.css' ) 
						? morning_records_get_folder_url("css/font-face/".($file).'/'.($file).'.css')
						: (file_exists( ($dir) . '/' . ($file) . '/stylesheet.css' ) 
							? morning_records_get_folder_url("css/font-face/".($file).'/stylesheet.css')
							: '');
					if ($css != '')
						$list[$file.' ('.esc_html__('uploaded font', 'morning-records').')'] = array('css' => $css);
				}
				@closedir( $hdir );
			}
		}
		return $list;
	}
}
?>