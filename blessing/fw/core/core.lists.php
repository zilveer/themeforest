<?php
/**
 * Ancora Framework: return lists
 *
 * @package themerex
 * @since themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Return list of the animations
if ( !function_exists( 'ancora_get_list_animations' ) ) {
	function ancora_get_list_animations($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_animations']))
			$list = $ANCORA_GLOBALS['list_animations'];
		else {
			$list = array();
			$list['none']			= __('- None -',	'ancora');
			$list['bounced']		= __('Bounced',		'ancora');
			$list['flash']			= __('Flash',		'ancora');
			$list['flip']			= __('Flip',		'ancora');
			$list['pulse']			= __('Pulse',		'ancora');
			$list['rubberBand']		= __('Rubber Band',	'ancora');
			$list['shake']			= __('Shake',		'ancora');
			$list['swing']			= __('Swing',		'ancora');
			$list['tada']			= __('Tada',		'ancora');
			$list['wobble']			= __('Wobble',		'ancora');
			$ANCORA_GLOBALS['list_animations'] = $list = apply_filters('ancora_filter_list_animations', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'ancora_get_list_animations_in' ) ) {
	function ancora_get_list_animations_in($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_animations_in']))
			$list = $ANCORA_GLOBALS['list_animations_in'];
		else {
			$list = array();
			$list['none']			= __('- None -',	'ancora');
			$list['bounceIn']		= __('Bounce In',			'ancora');
			$list['bounceInUp']		= __('Bounce In Up',		'ancora');
			$list['bounceInDown']	= __('Bounce In Down',		'ancora');
			$list['bounceInLeft']	= __('Bounce In Left',		'ancora');
			$list['bounceInRight']	= __('Bounce In Right',		'ancora');
			$list['fadeIn']			= __('Fade In',				'ancora');
			$list['fadeInUp']		= __('Fade In Up',			'ancora');
			$list['fadeInDown']		= __('Fade In Down',		'ancora');
			$list['fadeInLeft']		= __('Fade In Left',		'ancora');
			$list['fadeInRight']	= __('Fade In Right',		'ancora');
			$list['fadeInUpBig']	= __('Fade In Up Big',		'ancora');
			$list['fadeInDownBig']	= __('Fade In Down Big',	'ancora');
			$list['fadeInLeftBig']	= __('Fade In Left Big',	'ancora');
			$list['fadeInRightBig']	= __('Fade In Right Big',	'ancora');
			$list['flipInX']		= __('Flip In X',			'ancora');
			$list['flipInY']		= __('Flip In Y',			'ancora');
			$list['lightSpeedIn']	= __('Light Speed In',		'ancora');
			$list['rotateIn']		= __('Rotate In',			'ancora');
			$list['rotateInUpLeft']		= __('Rotate In Down Left',	'ancora');
			$list['rotateInUpRight']	= __('Rotate In Up Right',	'ancora');
			$list['rotateInDownLeft']	= __('Rotate In Up Left',	'ancora');
			$list['rotateInDownRight']	= __('Rotate In Down Right','ancora');
			$list['rollIn']				= __('Roll In',			'ancora');
			$list['slideInUp']			= __('Slide In Up',		'ancora');
			$list['slideInDown']		= __('Slide In Down',	'ancora');
			$list['slideInLeft']		= __('Slide In Left',	'ancora');
			$list['slideInRight']		= __('Slide In Right',	'ancora');
			$list['zoomIn']				= __('Zoom In',			'ancora');
			$list['zoomInUp']			= __('Zoom In Up',		'ancora');
			$list['zoomInDown']			= __('Zoom In Down',	'ancora');
			$list['zoomInLeft']			= __('Zoom In Left',	'ancora');
			$list['zoomInRight']		= __('Zoom In Right',	'ancora');
			$ANCORA_GLOBALS['list_animations_in'] = $list = apply_filters('ancora_filter_list_animations_in', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'ancora_get_list_animations_out' ) ) {
	function ancora_get_list_animations_out($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_animations_out']))
			$list = $ANCORA_GLOBALS['list_animations_out'];
		else {
			$list = array();
			$list['none']			= __('- None -',	'ancora');
			$list['bounceOut']		= __('Bounce Out',			'ancora');
			$list['bounceOutUp']	= __('Bounce Out Up',		'ancora');
			$list['bounceOutDown']	= __('Bounce Out Down',		'ancora');
			$list['bounceOutLeft']	= __('Bounce Out Left',		'ancora');
			$list['bounceOutRight']	= __('Bounce Out Right',	'ancora');
			$list['fadeOut']		= __('Fade Out',			'ancora');
			$list['fadeOutUp']		= __('Fade Out Up',			'ancora');
			$list['fadeOutDown']	= __('Fade Out Down',		'ancora');
			$list['fadeOutLeft']	= __('Fade Out Left',		'ancora');
			$list['fadeOutRight']	= __('Fade Out Right',		'ancora');
			$list['fadeOutUpBig']	= __('Fade Out Up Big',		'ancora');
			$list['fadeOutDownBig']	= __('Fade Out Down Big',	'ancora');
			$list['fadeOutLeftBig']	= __('Fade Out Left Big',	'ancora');
			$list['fadeOutRightBig']= __('Fade Out Right Big',	'ancora');
			$list['flipOutX']		= __('Flip Out X',			'ancora');
			$list['flipOutY']		= __('Flip Out Y',			'ancora');
			$list['hinge']			= __('Hinge Out',			'ancora');
			$list['lightSpeedOut']	= __('Light Speed Out',		'ancora');
			$list['rotateOut']		= __('Rotate Out',			'ancora');
			$list['rotateOutUpLeft']	= __('Rotate Out Down Left',	'ancora');
			$list['rotateOutUpRight']	= __('Rotate Out Up Right',		'ancora');
			$list['rotateOutDownLeft']	= __('Rotate Out Up Left',		'ancora');
			$list['rotateOutDownRight']	= __('Rotate Out Down Right',	'ancora');
			$list['rollOut']			= __('Roll Out',		'ancora');
			$list['slideOutUp']			= __('Slide Out Up',		'ancora');
			$list['slideOutDown']		= __('Slide Out Down',	'ancora');
			$list['slideOutLeft']		= __('Slide Out Left',	'ancora');
			$list['slideOutRight']		= __('Slide Out Right',	'ancora');
			$list['zoomOut']			= __('Zoom Out',			'ancora');
			$list['zoomOutUp']			= __('Zoom Out Up',		'ancora');
			$list['zoomOutDown']		= __('Zoom Out Down',	'ancora');
			$list['zoomOutLeft']		= __('Zoom Out Left',	'ancora');
			$list['zoomOutRight']		= __('Zoom Out Right',	'ancora');
			$ANCORA_GLOBALS['list_animations_out'] = $list = apply_filters('ancora_filter_list_animations_out', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'ancora_get_list_categories' ) ) {
	function ancora_get_list_categories($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_categories']))
			$list = $ANCORA_GLOBALS['list_categories'];
		else {
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
			foreach ($taxonomies as $cat) {
				$list[$cat->term_id] = $cat->name;
			}
			$ANCORA_GLOBALS['list_categories'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'ancora_get_list_terms' ) ) {
	function ancora_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_taxonomies_'.($taxonomy)]))
			$list = $ANCORA_GLOBALS['list_taxonomies_'.($taxonomy)];
		else {
			$list = array();
			$args = array(
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
				'pad_counts'               => false );
			$taxonomies = get_terms( $taxonomy, $args );
			foreach ($taxonomies as $cat) {
				$list[$cat->term_id] = $cat->name;	// . ($taxonomy!='category' ? ' /'.($cat->taxonomy).'/' : '');
			}
			$ANCORA_GLOBALS['list_taxonomies_'.($taxonomy)] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'ancora_get_list_posts_types' ) ) {
	function ancora_get_list_posts_types($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_posts_types']))
			$list = $ANCORA_GLOBALS['list_posts_types'];
		else {
			$list = array();
			/* 
			// This way to return all registered post types
			$types = get_post_types();
			if (in_array('post', $types)) $list['post'] = __('Post', 'ancora');
			foreach ($types as $t) {
				if ($t == 'post') continue;
				$list[$t] = ancora_strtoproper($t);
			}
			*/
			// Return only theme inheritance supported post types
			$ANCORA_GLOBALS['list_posts_types'] = $list = apply_filters('ancora_filter_list_post_types', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'ancora_get_list_posts' ) ) {
	function ancora_get_list_posts($prepend_inherit=false, $opt=array()) {
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

		global $ANCORA_GLOBALS;
		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (isset($ANCORA_GLOBALS[$hash]))
			$list = $ANCORA_GLOBALS[$hash];
		else {
			$list = array();
			$list['none'] = __("- Not selected -", 'ancora');
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
			foreach ($posts as $post) {
				$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
			}
			$ANCORA_GLOBALS[$hash] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}


// Return list of registered users
if ( !function_exists( 'ancora_get_list_users' ) ) {
	function ancora_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_users']))
			$list = $ANCORA_GLOBALS['list_users'];
		else {
			$list = array();
			$list['none'] = __("- Not selected -", 'ancora');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			foreach ($users as $user) {
				$accept = true;
				if (is_array($user->roles)) {
					if (count($user->roles) > 0) {
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
			$ANCORA_GLOBALS['list_users'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}


// Return sliders list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'ancora_get_list_sliders' ) ) {
	function ancora_get_list_sliders($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_sliders']))
			$list = $ANCORA_GLOBALS['list_sliders'];
		else {
			$list = array();
			$list["swiper"] = __("Posts slider (Swiper)", 'ancora');
			if (ancora_exists_revslider())
				$list["revo"] = __("Layer slider (Revolution)", 'ancora');
			if (ancora_exists_royalslider())
				$list["royal"] = __("Layer slider (Royal)", 'ancora');
			$ANCORA_GLOBALS['list_sliders'] = $list = apply_filters('ancora_filter_list_sliders', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with popup engines
if ( !function_exists( 'ancora_get_list_popup_engines' ) ) {
	function ancora_get_list_popup_engines($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_popup_engines']))
			$list = $ANCORA_GLOBALS['list_popup_engines'];
		else {
			$list = array();
			$list["pretty"] = __("Pretty photo", 'ancora');
			$list["magnific"] = __("Magnific popup", 'ancora');
			$ANCORA_GLOBALS['list_popup_engines'] = $list = apply_filters('ancora_filter_list_popup_engines', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'ancora_get_list_menus' ) ) {
	function ancora_get_list_menus($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_menus']))
			$list = $ANCORA_GLOBALS['list_menus'];
		else {
			$list = array();
			$list['default'] = __("Default", 'ancora');
			$menus = wp_get_nav_menus();
			if ($menus) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			$ANCORA_GLOBALS['list_menus'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'ancora_get_list_sidebars' ) ) {
	function ancora_get_list_sidebars($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_sidebars'])) {
			$list = $ANCORA_GLOBALS['list_sidebars'];
		} else {
			$list = isset($ANCORA_GLOBALS['registered_sidebars']) ? $ANCORA_GLOBALS['registered_sidebars'] : array();
			$ANCORA_GLOBALS['list_sidebars'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'ancora_get_list_sidebars_positions' ) ) {
	function ancora_get_list_sidebars_positions($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_sidebars_positions']))
			$list = $ANCORA_GLOBALS['list_sidebars_positions'];
		else {
			$list = array();
			$list['left']  = __('Left',  'ancora');
			$list['right'] = __('Right', 'ancora');
			$ANCORA_GLOBALS['list_sidebars_positions'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return sidebars class
if ( !function_exists( 'ancora_get_sidebar_class' ) ) {
	function ancora_get_sidebar_class($style, $pos) {
		return ancora_sc_param_is_off($style) ? 'sidebar_hide' : 'sidebar_show sidebar_'.($pos);
	}
}

// Return body styles list, prepended inherit
if ( !function_exists( 'ancora_get_list_body_styles' ) ) {
	function ancora_get_list_body_styles($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_body_styles']))
			$list = $ANCORA_GLOBALS['list_body_styles'];
		else {
			$list = array();
			$list['boxed']		= __('Boxed',		'ancora');
			$list['wide']		= __('Wide',		'ancora');
			$list['fullwide']	= __('Fullwide',	'ancora');
			$list['fullscreen']	= __('Fullscreen',	'ancora');
			$ANCORA_GLOBALS['list_body_styles'] = $list = apply_filters('ancora_filter_list_body_styles', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return skins list, prepended inherit
if ( !function_exists( 'ancora_get_list_skins' ) ) {
	function ancora_get_list_skins($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_skins']))
			$list = $ANCORA_GLOBALS['list_skins'];
		else
			$ANCORA_GLOBALS['list_skins'] = $list = ancora_get_list_folders("skins");
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return css-themes list
if ( !function_exists( 'ancora_get_list_themes' ) ) {
	function ancora_get_list_themes($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_themes']))
			$list = $ANCORA_GLOBALS['list_themes'];
		else
			$ANCORA_GLOBALS['list_themes'] = $list = ancora_get_list_files("css/themes");
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return templates list, prepended inherit
if ( !function_exists( 'ancora_get_list_templates' ) ) {
	function ancora_get_list_templates($mode='') {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_templates_'.($mode)]))
			$list = $ANCORA_GLOBALS['list_templates_'.($mode)];
		else {
			$list = array();
			foreach ($ANCORA_GLOBALS['registered_templates'] as $k=>$v) {
				if ($mode=='' || ancora_strpos($v['mode'], $mode)!==false)
					$list[$k] = !empty($v['title']) ? $v['title'] : ancora_strtoproper($v['layout']);
			}
			$ANCORA_GLOBALS['list_templates_'.($mode)] = $list;
		}
		return $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'ancora_get_list_templates_blog' ) ) {
	function ancora_get_list_templates_blog($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_templates_blog']))
			$list = $ANCORA_GLOBALS['list_templates_blog'];
		else {
			$list = ancora_get_list_templates('blog');
			$ANCORA_GLOBALS['list_templates_blog'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return blogger styles list, prepended inherit
if ( !function_exists( 'ancora_get_list_templates_blogger' ) ) {
	function ancora_get_list_templates_blogger($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_templates_blogger']))
			$list = $ANCORA_GLOBALS['list_templates_blogger'];
		else {
			$list = ancora_array_merge(ancora_get_list_templates('blogger'), ancora_get_list_templates('blog'));
			$ANCORA_GLOBALS['list_templates_blogger'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return single page styles list, prepended inherit
if ( !function_exists( 'ancora_get_list_templates_single' ) ) {
	function ancora_get_list_templates_single($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_templates_single']))
			$list = $ANCORA_GLOBALS['list_templates_single'];
		else {
			$list = ancora_get_list_templates('single');
			$ANCORA_GLOBALS['list_templates_single'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return article styles list, prepended inherit
if ( !function_exists( 'ancora_get_list_article_styles' ) ) {
	function ancora_get_list_article_styles($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_article_styles']))
			$list = $ANCORA_GLOBALS['list_article_styles'];
		else {
			$list = array();
			$list["boxed"]   = __('Boxed', 'ancora');
			$list["stretch"] = __('Stretch', 'ancora');
			$ANCORA_GLOBALS['list_article_styles'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return color schemes list, prepended inherit
if ( !function_exists( 'ancora_get_list_color_schemes' ) ) {
	function ancora_get_list_color_schemes($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_color_schemes']))
			$list = $ANCORA_GLOBALS['list_color_schemes'];
		else {
			$list = array();
			if (!empty($ANCORA_GLOBALS['color_schemes'])) {
				foreach ($ANCORA_GLOBALS['color_schemes'] as $k=>$v) {
					$list[$k] = $v['title'];
				}
			}
			$ANCORA_GLOBALS['list_color_schemes'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return button styles list, prepended inherit
if ( !function_exists( 'ancora_get_list_button_styles' ) ) {
	function ancora_get_list_button_styles($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_button_styles']))
			$list = $ANCORA_GLOBALS['list_button_styles'];
		else {
			$list = array();
			$list["custom"]	= __('Custom', 'ancora');
			$list["link"] 	= __('As links', 'ancora');
			$list["menu"] 	= __('As main menu', 'ancora');
			$list["user"] 	= __('As user menu', 'ancora');
			$ANCORA_GLOBALS['list_button_styles'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return post-formats filters list, prepended inherit
if ( !function_exists( 'ancora_get_list_post_formats_filters' ) ) {
	function ancora_get_list_post_formats_filters($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_post_formats_filters']))
			$list = $ANCORA_GLOBALS['list_post_formats_filters'];
		else {
			$list = array();
			$list["no"]      = __('All posts', 'ancora');
			$list["thumbs"]  = __('With thumbs', 'ancora');
			$list["reviews"] = __('With reviews', 'ancora');
			$list["video"]   = __('With videos', 'ancora');
			$list["audio"]   = __('With audios', 'ancora');
			$list["gallery"] = __('With galleries', 'ancora');
			$ANCORA_GLOBALS['list_post_formats_filters'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return portfolio filters list, prepended inherit
if ( !function_exists( 'ancora_get_list_portfolio_filters' ) ) {
	function ancora_get_list_portfolio_filters($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_portfolio_filters']))
			$list = $ANCORA_GLOBALS['list_portfolio_filters'];
		else {
			$list = array();
			$list["hide"] = __('Hide', 'ancora');
			$list["tags"] = __('Tags', 'ancora');
			$list["categories"] = __('Categories', 'ancora');
			$ANCORA_GLOBALS['list_portfolio_filters'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return hover styles list, prepended inherit
if ( !function_exists( 'ancora_get_list_hovers' ) ) {
	function ancora_get_list_hovers($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_hovers']))
			$list = $ANCORA_GLOBALS['list_hovers'];
		else {
			$list = array();
			$list['circle effect1']  = __('Circle Effect 1',  'ancora');
			$list['circle effect2']  = __('Circle Effect 2',  'ancora');
			$list['circle effect3']  = __('Circle Effect 3',  'ancora');
			$list['circle effect4']  = __('Circle Effect 4',  'ancora');
			$list['circle effect5']  = __('Circle Effect 5',  'ancora');
			$list['circle effect6']  = __('Circle Effect 6',  'ancora');
			$list['circle effect7']  = __('Circle Effect 7',  'ancora');
			$list['circle effect8']  = __('Circle Effect 8',  'ancora');
			$list['circle effect9']  = __('Circle Effect 9',  'ancora');
			$list['circle effect10'] = __('Circle Effect 10',  'ancora');
			$list['circle effect11'] = __('Circle Effect 11',  'ancora');
			$list['circle effect12'] = __('Circle Effect 12',  'ancora');
			$list['circle effect13'] = __('Circle Effect 13',  'ancora');
			$list['circle effect14'] = __('Circle Effect 14',  'ancora');
			$list['circle effect15'] = __('Circle Effect 15',  'ancora');
			$list['circle effect16'] = __('Circle Effect 16',  'ancora');
			$list['circle effect17'] = __('Circle Effect 17',  'ancora');
			$list['circle effect18'] = __('Circle Effect 18',  'ancora');
			$list['circle effect19'] = __('Circle Effect 19',  'ancora');
			$list['circle effect20'] = __('Circle Effect 20',  'ancora');
			$list['square effect1']  = __('Square Effect 1',  'ancora');
			$list['square effect2']  = __('Square Effect 2',  'ancora');
			$list['square effect3']  = __('Square Effect 3',  'ancora');
	//		$list['square effect4']  = __('Square Effect 4',  'ancora');
			$list['square effect5']  = __('Square Effect 5',  'ancora');
			$list['square effect6']  = __('Square Effect 6',  'ancora');
			$list['square effect7']  = __('Square Effect 7',  'ancora');
			$list['square effect8']  = __('Square Effect 8',  'ancora');
			$list['square effect9']  = __('Square Effect 9',  'ancora');
			$list['square effect10'] = __('Square Effect 10',  'ancora');
			$list['square effect11'] = __('Square Effect 11',  'ancora');
			$list['square effect12'] = __('Square Effect 12',  'ancora');
			$list['square effect13'] = __('Square Effect 13',  'ancora');
			$list['square effect14'] = __('Square Effect 14',  'ancora');
			$list['square effect15'] = __('Square Effect 15',  'ancora');
			$list['square effect_dir']   = __('Square Effect Dir',   'ancora');
			$list['square effect_shift'] = __('Square Effect Shift', 'ancora');
			$list['square effect_book']  = __('Square Effect Book',  'ancora');
			$ANCORA_GLOBALS['list_hovers'] = $list = apply_filters('ancora_filter_portfolio_hovers', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return extended hover directions list, prepended inherit
if ( !function_exists( 'ancora_get_list_hovers_directions' ) ) {
	function ancora_get_list_hovers_directions($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_hovers_directions']))
			$list = $ANCORA_GLOBALS['list_hovers_directions'];
		else {
			$list = array();
			$list['left_to_right'] = __('Left to Right',  'ancora');
			$list['right_to_left'] = __('Right to Left',  'ancora');
			$list['top_to_bottom'] = __('Top to Bottom',  'ancora');
			$list['bottom_to_top'] = __('Bottom to Top',  'ancora');
			$list['scale_up']      = __('Scale Up',  'ancora');
			$list['scale_down']    = __('Scale Down',  'ancora');
			$list['scale_down_up'] = __('Scale Down-Up',  'ancora');
			$list['from_left_and_right'] = __('From Left and Right',  'ancora');
			$list['from_top_and_bottom'] = __('From Top and Bottom',  'ancora');
			$ANCORA_GLOBALS['list_hovers_directions'] = $list = apply_filters('ancora_filter_portfolio_hovers_directions', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}


// Return list of the label positions in the custom forms
if ( !function_exists( 'ancora_get_list_label_positions' ) ) {
	function ancora_get_list_label_positions($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_label_positions']))
			$list = $ANCORA_GLOBALS['list_label_positions'];
		else {
			$list = array();
			$list['top']	= __('Top',		'ancora');
			$list['bottom']	= __('Bottom',		'ancora');
			$list['left']	= __('Left',		'ancora');
			$list['over']	= __('Over',		'ancora');
			$ANCORA_GLOBALS['list_label_positions'] = $list = apply_filters('ancora_filter_label_positions', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return background tints list, prepended inherit
if ( !function_exists( 'ancora_get_list_bg_tints' ) ) {
	function ancora_get_list_bg_tints($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_bg_tints']))
			$list = $ANCORA_GLOBALS['list_bg_tints'];
		else {
			$list = array();
			$list['none']  = __('None',  'ancora');
			$list['light'] = __('Light','ancora');
			$list['dark']  = __('Dark',  'ancora');
			$ANCORA_GLOBALS['list_bg_tints'] = $list = apply_filters('ancora_filter_bg_tints', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return background tints list for sidebars, prepended inherit
if ( !function_exists( 'ancora_get_list_sidebar_styles' ) ) {
	function ancora_get_list_sidebar_styles($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_sidebar_styles']))
			$list = $ANCORA_GLOBALS['list_sidebar_styles'];
		else {
			$list = array();
			$list['none']  = __('None',  'ancora');
			$list['light white'] = __('White','ancora');
			$list['light'] = __('Light','ancora');
			$list['dark']  = __('Dark',  'ancora');
			$ANCORA_GLOBALS['list_sidebar_styles'] = $list = apply_filters('ancora_filter_sidebar_styles', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return custom fields types list, prepended inherit
if ( !function_exists( 'ancora_get_list_field_types' ) ) {
	function ancora_get_list_field_types($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_field_types']))
			$list = $ANCORA_GLOBALS['list_field_types'];
		else {
			$list = array();
			$list['text']     = __('Text',  'ancora');
			$list['textarea'] = __('Text Area','ancora');
			$list['password'] = __('Password',  'ancora');
			$list['radio']    = __('Radio',  'ancora');
			$list['checkbox'] = __('Checkbox',  'ancora');
			$list['button']   = __('Button','ancora');
			$ANCORA_GLOBALS['list_field_types'] = $list = apply_filters('ancora_filter_field_types', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return Google map styles
if ( !function_exists( 'ancora_get_list_googlemap_styles' ) ) {
	function ancora_get_list_googlemap_styles($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_googlemap_styles']))
			$list = $ANCORA_GLOBALS['list_googlemap_styles'];
		else {
			$list = array();
			$list['default'] = __('Default', 'ancora');
			$list['simple'] = __('Simple', 'ancora');
			$list['greyscale'] = __('Greyscale', 'ancora');
			$list['greyscale2'] = __('Greyscale 2', 'ancora');
			$list['invert'] = __('Invert', 'ancora');
			$list['dark'] = __('Dark', 'ancora');
			$list['style1'] = __('Custom style 1', 'ancora');
			$list['style2'] = __('Custom style 2', 'ancora');
			$list['style3'] = __('Custom style 3', 'ancora');
			$ANCORA_GLOBALS['list_googlemap_styles'] = $list = apply_filters('ancora_filter_googlemap_styles', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'ancora_get_list_icons' ) ) {
	function ancora_get_list_icons($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_icons']))
			$list = $ANCORA_GLOBALS['list_icons'];
		else
			$ANCORA_GLOBALS['list_icons'] = $list = ancora_parse_icons_classes(ancora_get_file_dir("css/fontello/css/fontello-codes.css"));
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return socials list
if ( !function_exists( 'ancora_get_list_socials' ) ) {
	function ancora_get_list_socials($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_socials']))
			$list = $ANCORA_GLOBALS['list_socials'];
		else
			$ANCORA_GLOBALS['list_socials'] = $list = ancora_get_list_files("images/socials", "png");
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return flags list
if ( !function_exists( 'ancora_get_list_flags' ) ) {
	function ancora_get_list_flags($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_flags']))
			$list = $ANCORA_GLOBALS['list_flags'];
		else
			$ANCORA_GLOBALS['list_flags'] = $list = ancora_get_list_files("images/flags", "png");
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'ancora_get_list_yesno' ) ) {
	function ancora_get_list_yesno($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_yesno']))
			$list = $ANCORA_GLOBALS['list_yesno'];
		else {
			$list = array();
			$list["yes"] = __("Yes", 'ancora');
			$list["no"]  = __("No", 'ancora');
			$ANCORA_GLOBALS['list_yesno'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'ancora_get_list_onoff' ) ) {
	function ancora_get_list_onoff($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_onoff']))
			$list = $ANCORA_GLOBALS['list_onoff'];
		else {
			$list = array();
			$list["on"] = __("On", 'ancora');
			$list["off"] = __("Off", 'ancora');
			$ANCORA_GLOBALS['list_onoff'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'ancora_get_list_showhide' ) ) {
	function ancora_get_list_showhide($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_showhide']))
			$list = $ANCORA_GLOBALS['list_showhide'];
		else {
			$list = array();
			$list["show"] = __("Show", 'ancora');
			$list["hide"] = __("Hide", 'ancora');
			$ANCORA_GLOBALS['list_showhide'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with 'Ascending' and 'Descending' items
if ( !function_exists( 'ancora_get_list_orderings' ) ) {
	function ancora_get_list_orderings($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_orderings']))
			$list = $ANCORA_GLOBALS['list_orderings'];
		else {
			$list = array();
			$list["asc"] = __("Ascending", 'ancora');
			$list["desc"] = __("Descending", 'ancora');
			$ANCORA_GLOBALS['list_orderings'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'ancora_get_list_directions' ) ) {
	function ancora_get_list_directions($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_directions']))
			$list = $ANCORA_GLOBALS['list_directions'];
		else {
			$list = array();
			$list["horizontal"] = __("Horizontal", 'ancora');
			$list["vertical"] = __("Vertical", 'ancora');
			$ANCORA_GLOBALS['list_directions'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with float items
if ( !function_exists( 'ancora_get_list_floats' ) ) {
	function ancora_get_list_floats($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_floats']))
			$list = $ANCORA_GLOBALS['list_floats'];
		else {
			$list = array();
			$list["none"] = __("None", 'ancora');
			$list["left"] = __("Float Left", 'ancora');
			$list["right"] = __("Float Right", 'ancora');
			$ANCORA_GLOBALS['list_floats'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with alignment items
if ( !function_exists( 'ancora_get_list_alignments' ) ) {
	function ancora_get_list_alignments($justify=false, $prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_alignments']))
			$list = $ANCORA_GLOBALS['list_alignments'];
		else {
			$list = array();
			$list["none"] = __("None", 'ancora');
			$list["left"] = __("Left", 'ancora');
			$list["center"] = __("Center", 'ancora');
			$list["right"] = __("Right", 'ancora');
			if ($justify) $list["justify"] = __("Justify", 'ancora');
			$ANCORA_GLOBALS['list_alignments'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return sorting list items
if ( !function_exists( 'ancora_get_list_sortings' ) ) {
	function ancora_get_list_sortings($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_sortings']))
			$list = $ANCORA_GLOBALS['list_sortings'];
		else {
			$list = array();
			$list["date"] = __("Date", 'ancora');
			$list["title"] = __("Alphabetically", 'ancora');
			$list["views"] = __("Popular (views count)", 'ancora');
			$list["comments"] = __("Most commented (comments count)", 'ancora');
			$list["author_rating"] = __("Author rating", 'ancora');
			$list["users_rating"] = __("Visitors (users) rating", 'ancora');
			$list["random"] = __("Random", 'ancora');
			$ANCORA_GLOBALS['list_sortings'] = $list = apply_filters('ancora_filter_list_sortings', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list with columns widths
if ( !function_exists( 'ancora_get_list_columns' ) ) {
	function ancora_get_list_columns($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_columns']))
			$list = $ANCORA_GLOBALS['list_columns'];
		else {
			$list = array();
			$list["none"] = __("None", 'ancora');
			$list["1_1"] = __("100%", 'ancora');
			$list["1_2"] = __("1/2", 'ancora');
			$list["1_3"] = __("1/3", 'ancora');
			$list["2_3"] = __("2/3", 'ancora');
			$list["1_4"] = __("1/4", 'ancora');
			$list["3_4"] = __("3/4", 'ancora');
			$list["1_5"] = __("1/5", 'ancora');
			$list["2_5"] = __("2/5", 'ancora');
			$list["3_5"] = __("3/5", 'ancora');
			$list["4_5"] = __("4/5", 'ancora');
			$list["1_6"] = __("1/6", 'ancora');
			$list["5_6"] = __("5/6", 'ancora');
			$list["1_7"] = __("1/7", 'ancora');
			$list["2_7"] = __("2/7", 'ancora');
			$list["3_7"] = __("3/7", 'ancora');
			$list["4_7"] = __("4/7", 'ancora');
			$list["5_7"] = __("5/7", 'ancora');
			$list["6_7"] = __("6/7", 'ancora');
			$list["1_8"] = __("1/8", 'ancora');
			$list["3_8"] = __("3/8", 'ancora');
			$list["5_8"] = __("5/8", 'ancora');
			$list["7_8"] = __("7/8", 'ancora');
			$list["1_9"] = __("1/9", 'ancora');
			$list["2_9"] = __("2/9", 'ancora');
			$list["4_9"] = __("4/9", 'ancora');
			$list["5_9"] = __("5/9", 'ancora');
			$list["7_9"] = __("7/9", 'ancora');
			$list["8_9"] = __("8/9", 'ancora');
			$list["1_10"]= __("1/10", 'ancora');
			$list["3_10"]= __("3/10", 'ancora');
			$list["7_10"]= __("7/10", 'ancora');
			$list["9_10"]= __("9/10", 'ancora');
			$list["1_11"]= __("1/11", 'ancora');
			$list["2_11"]= __("2/11", 'ancora');
			$list["3_11"]= __("3/11", 'ancora');
			$list["4_11"]= __("4/11", 'ancora');
			$list["5_11"]= __("5/11", 'ancora');
			$list["6_11"]= __("6/11", 'ancora');
			$list["7_11"]= __("7/11", 'ancora');
			$list["8_11"]= __("8/11", 'ancora');
			$list["9_11"]= __("9/11", 'ancora');
			$list["10_11"]= __("10/11", 'ancora');
			$list["1_12"]= __("1/12", 'ancora');
			$list["5_12"]= __("5/12", 'ancora');
			$list["7_12"]= __("7/12", 'ancora');
			$list["10_12"]= __("10/12", 'ancora');
			$list["11_12"]= __("11/12", 'ancora');
			$ANCORA_GLOBALS['list_columns'] = $list = apply_filters('ancora_filter_list_columns', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return list of locations for the dedicated content
if ( !function_exists( 'ancora_get_list_dedicated_locations' ) ) {
	function ancora_get_list_dedicated_locations($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_dedicated_locations']))
			$list = $ANCORA_GLOBALS['list_dedicated_locations'];
		else {
			$list = array();
			$list["default"] = __('As in the post defined', 'ancora');
			$list["center"]  = __('Above the text of the post', 'ancora');
			$list["left"]    = __('To the left the text of the post', 'ancora');
			$list["right"]   = __('To the right the text of the post', 'ancora');
			$list["alter"]   = __('Alternates for each post', 'ancora');
			$ANCORA_GLOBALS['list_dedicated_locations'] = $list = apply_filters('ancora_filter_list_dedicated_locations', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return post-format name
if ( !function_exists( 'ancora_get_post_format_name' ) ) {
	function ancora_get_post_format_name($format, $single=true) {
		$name = '';
		if ($format=='gallery')		$name = $single ? __('gallery', 'ancora') : __('galleries', 'ancora');
		else if ($format=='video')	$name = $single ? __('video', 'ancora') : __('videos', 'ancora');
		else if ($format=='audio')	$name = $single ? __('audio', 'ancora') : __('audios', 'ancora');
		else if ($format=='image')	$name = $single ? __('image', 'ancora') : __('images', 'ancora');
		else if ($format=='quote')	$name = $single ? __('quote', 'ancora') : __('quotes', 'ancora');
		else if ($format=='link')	$name = $single ? __('link', 'ancora') : __('links', 'ancora');
		else if ($format=='status')	$name = $single ? __('status', 'ancora') : __('statuses', 'ancora');
		else if ($format=='aside')	$name = $single ? __('aside', 'ancora') : __('asides', 'ancora');
		else if ($format=='chat')	$name = $single ? __('chat', 'ancora') : __('chats', 'ancora');
		else						$name = $single ? __('standard', 'ancora') : __('standards', 'ancora');
		return apply_filters('ancora_filter_list_post_format_name', $name, $format);
	}
}

// Return post-format icon name (from Fontello library)
if ( !function_exists( 'ancora_get_post_format_icon' ) ) {
	function ancora_get_post_format_icon($format) {
		$icon = 'icon-';
		if ($format=='gallery')		$icon .= 'picture-2';
		else if ($format=='video')	$icon .= 'video-2';
		else if ($format=='audio')	$icon .= 'musical-2';
		else if ($format=='image')	$icon .= 'picture-boxed-2';
		else if ($format=='quote')	$icon .= 'quote-2';
		else if ($format=='link')	$icon .= 'link-2';
		else if ($format=='status')	$icon .= 'agenda-2';
		else if ($format=='aside')	$icon .= 'chat-2';
		else if ($format=='chat')	$icon .= 'chat-all-2';
		else						$icon .= 'book-2';
		return apply_filters('ancora_filter_list_post_format_icon', $icon, $format);
	}
}

// Return fonts styles list, prepended inherit
if ( !function_exists( 'ancora_get_list_fonts_styles' ) ) {
	function ancora_get_list_fonts_styles($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_fonts_styles']))
			$list = $ANCORA_GLOBALS['list_fonts_styles'];
		else {
			$list = array();
			$list['i'] = __('I','ancora');
			$list['u'] = __('U', 'ancora');
			$ANCORA_GLOBALS['list_fonts_styles'] = $list;
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return Google fonts list
if ( !function_exists( 'ancora_get_list_fonts' ) ) {
	function ancora_get_list_fonts($prepend_inherit=false) {
		global $ANCORA_GLOBALS;
		if (isset($ANCORA_GLOBALS['list_fonts']))
			$list = $ANCORA_GLOBALS['list_fonts'];
		else {
			$list = array();
			$list = ancora_array_merge($list, ancora_get_list_fonts_custom());
			// Google and custom fonts list:
			//$list['Advent Pro'] = array(
			//		'family'=>'sans-serif',																						// (required) font family
			//		'link'=>'Advent+Pro:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic',	// (optional) if you use Google font repository
			//		'css'=>ancora_get_file_url('/css/font-face/Advent-Pro/stylesheet.css')									// (optional) if you use custom font-face
			//		);
			$list['Advent Pro'] = array('family'=>'sans-serif');
			$list['Alegreya Sans'] = array('family'=>'sans-serif');
			$list['Arimo'] = array('family'=>'sans-serif');
			$list['Asap'] = array('family'=>'sans-serif');
			$list['Averia Sans Libre'] = array('family'=>'cursive');
			$list['Averia Serif Libre'] = array('family'=>'cursive');
			$list['Bree Serif'] = array('family'=>'serif',);
			$list['Cabin'] = array('family'=>'sans-serif');
			$list['Cabin Condensed'] = array('family'=>'sans-serif');
			$list['Caudex'] = array('family'=>'serif');
			$list['Comfortaa'] = array('family'=>'cursive');
			$list['Cousine'] = array('family'=>'sans-serif');
			$list['Crimson Text'] = array('family'=>'serif');
			$list['Cuprum'] = array('family'=>'sans-serif');
			$list['Dosis'] = array('family'=>'sans-serif');
			$list['Economica'] = array('family'=>'sans-serif');
			$list['Exo'] = array('family'=>'sans-serif');
			$list['Expletus Sans'] = array('family'=>'cursive');
			$list['Karla'] = array('family'=>'sans-serif');
			$list['Lato'] = array('family'=>'sans-serif');
			$list['Lekton'] = array('family'=>'sans-serif');
			$list['Lobster Two'] = array('family'=>'cursive');
			$list['Maven Pro'] = array('family'=>'sans-serif');
			$list['Merriweather'] = array('family'=>'serif');
			$list['Montserrat'] = array('family'=>'sans-serif');
			$list['Neuton'] = array('family'=>'serif');
			$list['Noticia Text'] = array('family'=>'serif');
			$list['Old Standard TT'] = array('family'=>'serif');
			$list['Open Sans'] = array('family'=>'sans-serif');
			$list['Orbitron'] = array('family'=>'sans-serif');
			$list['Oswald'] = array('family'=>'sans-serif');
			$list['Overlock'] = array('family'=>'cursive');
			$list['Oxygen'] = array('family'=>'sans-serif');
			$list['PT Serif'] = array('family'=>'serif');
			$list['Puritan'] = array('family'=>'sans-serif');
			$list['Raleway'] = array('family'=>'sans-serif');
			$list['Roboto'] = array('family'=>'sans-serif');
			$list['Roboto Slab'] = array('family'=>'sans-serif');
			$list['Roboto Condensed'] = array('family'=>'sans-serif');
			$list['Rosario'] = array('family'=>'sans-serif');
			$list['Share'] = array('family'=>'cursive');
			$list['Signika'] = array('family'=>'sans-serif');
			$list['Signika Negative'] = array('family'=>'sans-serif');
			$list['Source Sans Pro'] = array('family'=>'sans-serif');
			$list['Tinos'] = array('family'=>'serif');
			$list['Ubuntu'] = array('family'=>'sans-serif');
			$list['Vollkorn'] = array('family'=>'serif');
			$ANCORA_GLOBALS['list_fonts'] = $list = apply_filters('ancora_filter_list_fonts', $list);
		}
		return $prepend_inherit ? ancora_array_merge(array('inherit' => __("Inherit", 'ancora')), $list) : $list;
	}
}

// Return Custom font-face list
if ( !function_exists( 'ancora_get_list_fonts_custom' ) ) {
	function ancora_get_list_fonts_custom($prepend_inherit=false) {
		static $list = false;
		if (is_array($list)) return $list;
		$list = array();
		$dir = ancora_get_folder_dir("css/font-face");
		if ( is_dir($dir) ) {
			$hdir = @ opendir( $dir );
			if ( $hdir ) {
				while (($file = readdir( $hdir ) ) !== false ) {
					$pi = pathinfo( ($dir) . '/' . ($file) );
					if ( substr($file, 0, 1) == '.' || ! is_dir( ($dir) . '/' . ($file) ) )
						continue;
					$css = file_exists( ($dir) . '/' . ($file) . '/' . ($file) . '.css' ) 
						? ancora_get_folder_url("css/font-face/".($file).'/'.($file).'.css')
						: (file_exists( ($dir) . '/' . ($file) . '/stylesheet.css' ) 
							? ancora_get_folder_url("css/font-face/".($file).'/stylesheet.css')
							: '');
					if ($css != '')
						$list[$file.' ('.__('uploaded font', 'ancora').')'] = array('css' => $css);
				}
				@closedir( $hdir );
			}
		}
		return $list;
	}
}
?>