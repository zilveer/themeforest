<?php
/**
 * Morning records Framework: Team support
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Theme init
if (!function_exists('morning_records_team_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_team_theme_setup', 1 );
	function morning_records_team_theme_setup() {

		// Add item in the admin menu
		add_action('add_meta_boxes',						'morning_records_team_add_meta_box');

		// Save data from meta box
		add_action('save_post',								'morning_records_team_save_data');
		
		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('morning_records_filter_get_blog_type',			'morning_records_team_get_blog_type', 9, 2);
		add_filter('morning_records_filter_get_blog_title',		'morning_records_team_get_blog_title', 9, 2);
		add_filter('morning_records_filter_get_current_taxonomy',	'morning_records_team_get_current_taxonomy', 9, 2);
		add_filter('morning_records_filter_is_taxonomy',			'morning_records_team_is_taxonomy', 9, 2);
		add_filter('morning_records_filter_get_stream_page_title',	'morning_records_team_get_stream_page_title', 9, 2);
		add_filter('morning_records_filter_get_stream_page_link',	'morning_records_team_get_stream_page_link', 9, 2);
		add_filter('morning_records_filter_get_stream_page_id',	'morning_records_team_get_stream_page_id', 9, 2);
		add_filter('morning_records_filter_query_add_filters',		'morning_records_team_query_add_filters', 9, 2);
		add_filter('morning_records_filter_detect_inheritance_key','morning_records_team_detect_inheritance_key', 9, 1);

		// Extra column for team members lists
		if (morning_records_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-team_columns',			'morning_records_post_add_options_column', 9);
			add_filter('manage_team_posts_custom_column',	'morning_records_post_fill_options_column', 9, 2);
		}

		// Register shortcodes [trx_team] and [trx_team_item]
		add_action('morning_records_action_shortcodes_list',		'morning_records_team_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_team_reg_shortcodes_vc');

		// Meta box fields
		morning_records_storage_set('team_meta_box', array(
			'id' => 'team-meta-box',
			'title' => esc_html__('Team Member Details', 'morning-records'),
			'page' => 'team',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				"team_member_position" => array(
					"title" => esc_html__('Position',  'morning-records'),
					"desc" => wp_kses_data( __("Position of the team member", 'morning-records') ),
					"class" => "team_member_position",
					"std" => "",
					"type" => "text"),
				"team_member_email" => array(
					"title" => esc_html__("E-mail",  'morning-records'),
					"desc" => wp_kses_data( __("E-mail of the team member - need to take Gravatar (if registered)", 'morning-records') ),
					"class" => "team_member_email",
					"std" => "",
					"type" => "text"),
				"team_member_link" => array(
					"title" => esc_html__('Link to profile',  'morning-records'),
					"desc" => wp_kses_data( __("URL of the team member profile page (if not this page)", 'morning-records') ),
					"class" => "team_member_link",
					"std" => "",
					"type" => "text"),
				"team_member_socials" => array(
					"title" => esc_html__("Social links",  'morning-records'),
					"desc" => wp_kses_data( __("Links to the social profiles of the team member", 'morning-records') ),
					"class" => "team_member_email",
					"std" => "",
					"type" => "social")
				)
			)
		);
		
		// Add supported data types
		morning_records_theme_support_pt('team');
		morning_records_theme_support_tx('team_group');
	}
}

if ( !function_exists( 'morning_records_team_settings_theme_setup2' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_team_settings_theme_setup2', 3 );
	function morning_records_team_settings_theme_setup2() {
		// Add post type 'team' and taxonomy 'team_group' into theme inheritance list
		morning_records_add_theme_inheritance( array('team' => array(
			'stream_template' => 'blog-team',
			'single_template' => 'single-team',
			'taxonomy' => array('team_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('team'),
			'override' => 'custom'
			) )
		);
	}
}


// Add meta box
if (!function_exists('morning_records_team_add_meta_box')) {
	//add_action('add_meta_boxes', 'morning_records_team_add_meta_box');
	function morning_records_team_add_meta_box() {
		$mb = morning_records_storage_get('team_meta_box');
		add_meta_box($mb['id'], $mb['title'], 'morning_records_team_show_meta_box', $mb['page'], $mb['context'], $mb['priority']);
	}
}

// Callback function to show fields in meta box
if (!function_exists('morning_records_team_show_meta_box')) {
	function morning_records_team_show_meta_box() {
		global $post;

		$data = get_post_meta($post->ID, 'morning_records_team_data', true);
		$fields = morning_records_storage_get_array('team_meta_box', 'fields');
		?>
		<input type="hidden" name="meta_box_team_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
		<table class="team_area">
		<?php
		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $id=>$field) { 
				$meta = isset($data[$id]) ? $data[$id] : '';
				?>
				<tr class="team_field <?php echo esc_attr($field['class']); ?>" valign="top">
					<td><label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($field['title']); ?></label></td>
					<td>
						<?php
						if ($id == 'team_member_socials') {
							$socials_type = morning_records_get_theme_setting('socials_type');
							$social_list = morning_records_get_theme_option('social_icons');
							if (is_array($social_list) && count($social_list) > 0) {
								foreach ($social_list as $soc) {
									if ($socials_type == 'icons') {
										$parts = explode('-', $soc['icon'], 2);
										$sn = isset($parts[1]) ? $parts[1] : $soc['icon'];
									} else {
										$sn = basename($soc['icon']);
										$sn = morning_records_substr($sn, 0, morning_records_strrpos($sn, '.'));
										if (($pos=morning_records_strrpos($sn, '_'))!==false)
											$sn = morning_records_substr($sn, 0, $pos);
									}   
									$link = isset($meta[$sn]) ? $meta[$sn] : '';
									?>
									<label for="<?php echo esc_attr(($id).'_'.($sn)); ?>"><?php echo esc_attr(morning_records_strtoproper($sn)); ?></label><br>
									<input type="text" name="<?php echo esc_attr($id); ?>[<?php echo esc_attr($sn); ?>]" id="<?php echo esc_attr(($id).'_'.($sn)); ?>" value="<?php echo esc_attr($link); ?>" size="30" /><br>
									<?php
								}
							}
						} else {
							?>
							<input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($meta); ?>" size="30" />
							<?php
						}
						?>
						<br><small><?php echo esc_attr($field['desc']); ?></small>
					</td>
				</tr>
				<?php
			}
		}
		?>
		</table>
		<?php
	}
}


// Save data from meta box
if (!function_exists('morning_records_team_save_data')) {
	//add_action('save_post', 'morning_records_team_save_data');
	function morning_records_team_save_data($post_id) {
		// verify nonce
		if ( !wp_verify_nonce( morning_records_get_value_gp('meta_box_team_nonce'), admin_url() ) )
			return $post_id;

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ($_POST['post_type']!='team' || !current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		$data = array();

		$fields = morning_records_storage_get_array('team_meta_box', 'fields');

		// Post type specific data handling
		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $id=>$field) {
				if (isset($_POST[$id])) {
					if (is_array($_POST[$id]) && count($_POST[$id]) > 0) {
						foreach ($_POST[$id] as $sn=>$link) {
							$_POST[$id][$sn] = stripslashes($link);
						}
						$data[$id] = $_POST[$id];
					} else {
						$data[$id] = stripslashes($_POST[$id]);
					}
				}
			}
		}

		update_post_meta($post_id, 'morning_records_team_data', $data);
	}
}



// Return true, if current page is team member page
if ( !function_exists( 'morning_records_is_team_page' ) ) {
	function morning_records_is_team_page() {
		$is = in_array(morning_records_storage_get('page_template'), array('blog-team', 'single-team'));
		if (!$is) {
			if (!morning_records_storage_empty('pre_query'))
				$is = morning_records_storage_call_obj_method('pre_query', 'get', 'post_type')=='team' 
						|| morning_records_storage_call_obj_method('pre_query', 'is_tax', 'team_group') 
						|| (morning_records_storage_call_obj_method('pre_query', 'is_page') 
								&& ($id=morning_records_get_template_page_id('blog-team')) > 0 
								&& $id==morning_records_storage_get_obj_property('pre_query', 'queried_object_id', 0)
							);
			else
				$is = get_query_var('post_type')=='team' || is_tax('team_group') || (is_page() && ($id=morning_records_get_template_page_id('blog-team')) > 0 && $id==get_the_ID());
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'morning_records_team_detect_inheritance_key' ) ) {
	//add_filter('morning_records_filter_detect_inheritance_key',	'morning_records_team_detect_inheritance_key', 9, 1);
	function morning_records_team_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return morning_records_is_team_page() ? 'team' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'morning_records_team_get_blog_type' ) ) {
	//add_filter('morning_records_filter_get_blog_type',	'morning_records_team_get_blog_type', 9, 2);
	function morning_records_team_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('team_group') || is_tax('team_group'))
			$page = 'team_category';
		else if ($query && $query->get('post_type')=='team' || get_query_var('post_type')=='team')
			$page = $query && $query->is_single() || is_single() ? 'team_item' : 'team';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'morning_records_team_get_blog_title' ) ) {
	//add_filter('morning_records_filter_get_blog_title',	'morning_records_team_get_blog_title', 9, 2);
	function morning_records_team_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( morning_records_strpos($page, 'team')!==false ) {
			if ( $page == 'team_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'team_group' ), 'team_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'team_item' ) {
				$title = morning_records_get_post_title();
			} else {
				$title = esc_html__('All team', 'morning-records');
			}
		}

		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'morning_records_team_get_stream_page_title' ) ) {
	//add_filter('morning_records_filter_get_stream_page_title',	'morning_records_team_get_stream_page_title', 9, 2);
	function morning_records_team_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (morning_records_strpos($page, 'team')!==false) {
			if (($page_id = morning_records_team_get_stream_page_id(0, $page=='team' ? 'blog-team' : $page)) > 0)
				$title = morning_records_get_post_title($page_id);
			else
				$title = esc_html__('All team', 'morning-records');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'morning_records_team_get_stream_page_id' ) ) {
	//add_filter('morning_records_filter_get_stream_page_id',	'morning_records_team_get_stream_page_id', 9, 2);
	function morning_records_team_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (morning_records_strpos($page, 'team')!==false) $id = morning_records_get_template_page_id('blog-team');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'morning_records_team_get_stream_page_link' ) ) {
	//add_filter('morning_records_filter_get_stream_page_link',	'morning_records_team_get_stream_page_link', 9, 2);
	function morning_records_team_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (morning_records_strpos($page, 'team')!==false) {
			$id = morning_records_get_template_page_id('blog-team');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'morning_records_team_get_current_taxonomy' ) ) {
	//add_filter('morning_records_filter_get_current_taxonomy',	'morning_records_team_get_current_taxonomy', 9, 2);
	function morning_records_team_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( morning_records_strpos($page, 'team')!==false ) {
			$tax = 'team_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'morning_records_team_is_taxonomy' ) ) {
	//add_filter('morning_records_filter_is_taxonomy',	'morning_records_team_is_taxonomy', 9, 2);
	function morning_records_team_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get('team_group')!='' || is_tax('team_group') ? 'team_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'morning_records_team_query_add_filters' ) ) {
	//add_filter('morning_records_filter_query_add_filters',	'morning_records_team_query_add_filters', 9, 2);
	function morning_records_team_query_add_filters($args, $filter) {
		if ($filter == 'team') {
			$args['post_type'] = 'team';
		}
		return $args;
	}
}





// ---------------------------------- [trx_team] ---------------------------------------

/*
[trx_team id="unique_id" columns="3" style="team-1|team-2|..."]
	[trx_team_item user="user_login"]
	[trx_team_item member="member_id"]
	[trx_team_item name="team member name" photo="url" email="address" position="director"]
[/trx_team]
*/
if ( !function_exists( 'morning_records_sc_team' ) ) {
	function morning_records_sc_team($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"style" => "team-1",
			"slider" => "no",
			"controls" => "no",
			"slides_space" => 0,
			"interval" => "",
			"autoheight" => "no",
			"align" => "",
			"custom" => "no",
			"ids" => "",
			"cat" => "",
			"count" => 3,
			"columns" => 3,
			"offset" => "",
			"orderby" => "title",
			"order" => "asc",
			"title" => "",
			"subtitle" => "",
			"description" => "",
			"link_caption" => esc_html__('Learn more', 'morning-records'),
			"link" => '',
			"scheme" => '',
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));

		if (empty($id)) $id = "sc_team_".str_replace('.', '', mt_rand());
		if (empty($width)) $width = "100%";
		if (!empty($height) && morning_records_param_is_on($autoheight)) $autoheight = "no";
		if (empty($interval)) $interval = mt_rand(5000, 10000);

		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);

		$ws = morning_records_get_css_dimensions_from_values($width);
		$hs = morning_records_get_css_dimensions_from_values('', $height);
		$css .= ($hs) . ($ws);

		$count = max(1, (int) $count);
		$columns = max(1, min(12, (int) $columns));
		if (morning_records_param_is_off($custom) && $count < $columns) $columns = $count;

		morning_records_storage_set('sc_team_data', array(
			'id' => $id,
            'style' => $style,
            'columns' => $columns,
            'counter' => 0,
            'slider' => $slider,
            'css_wh' => $ws . $hs
            )
        );

		if (morning_records_param_is_on($slider)) morning_records_enqueue_slider('swiper');
	
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'_wrap"' : '') 
						. ' class="sc_team_wrap'
						. ($scheme && !morning_records_param_is_off($scheme) && !morning_records_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
						.'">'
					. '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
						. ' class="sc_team sc_team_style_'.esc_attr($style)
							. ' ' . esc_attr(morning_records_get_template_property($style, 'container_classes'))
							. (morning_records_param_is_on($slider)
								? 
								: '')
							. (!empty($class) ? ' '.esc_attr($class) : '')
							. ($align!='' && $align!='none' ? ' align'.esc_attr($align) : '')
						.'"'
						. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
						. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
					. '>'
					. (!empty($title) ? '<h2 class="sc_team_title sc_item_title">' . trim(morning_records_strmacros($title)) . '</h2>' : '')
                    . (!empty($subtitle) ? '<h6 class="sc_team_subtitle sc_item_subtitle">' . trim(morning_records_strmacros($subtitle)) . '</h6>' : '')
                    . (!empty($description) ? '<div class="sc_team_descr sc_item_descr">' . trim(morning_records_strmacros($description)) . '</div>' : '')
					. (morning_records_param_is_on($slider) 
						? ('<div class="sc_slider_swiper swiper-slider-container'
										. ' ' . esc_attr(morning_records_get_slider_controls_classes($controls))
										. (morning_records_param_is_on($autoheight) ? ' sc_slider_height_auto' : '')
										. ($hs ? ' sc_slider_height_fixed' : '')
										. '"'
									. (!empty($width) && morning_records_strpos($width, '%')===false ? ' data-old-width="' . esc_attr($width) . '"' : '')
									. (!empty($height) && morning_records_strpos($height, '%')===false ? ' data-old-height="' . esc_attr($height) . '"' : '')
									. ((int) $interval > 0 ? ' data-interval="'.esc_attr($interval).'"' : '')
									. ($slides_space > 0 ? ' data-slides-space="' . esc_attr($slides_space) . '"' : '')
									. ($columns > 1 ? ' data-slides-per-view="' . esc_attr($columns) . '"' : '')
									. ' data-slides-min-width="250"'
								. '>'
							. '<div class="slides swiper-wrapper">')
						: ($columns > 1 // && morning_records_get_template_property($style, 'need_columns')
							? '<div class="sc_columns columns_wrap">' 
							: '')
						);
	
		$content = do_shortcode($content);
	
		if (morning_records_param_is_on($custom) && $content) {
			$output .= $content;
		} else {
			global $post;
	
			if (!empty($ids)) {
				$posts = explode(',', $ids);
				$count = count($posts);
			}
			
			$args = array(
				'post_type' => 'team',
				'post_status' => 'publish',
				'posts_per_page' => $count,
				'ignore_sticky_posts' => true,
				'order' => $order=='asc' ? 'asc' : 'desc',
			);
		
			if ($offset > 0 && empty($ids)) {
				$args['offset'] = $offset;
			}
		
			$args = morning_records_query_add_sort_order($args, $orderby, $order);
			$args = morning_records_query_add_posts_and_cats($args, $ids, 'team', $cat, 'team_group');
			$query = new WP_Query( $args );
	
			$post_number = 0;
				
			while ( $query->have_posts() ) { 
				$query->the_post();
				$post_number++;
				$args = array(
					'layout' => $style,
					'show' => false,
					'number' => $post_number,
					'posts_on_page' => ($count > 0 ? $count : $query->found_posts),
					"descr" => morning_records_get_custom_option('post_excerpt_maxlength'.($columns > 1 ? '_masonry' : '')),
					"orderby" => $orderby,
					'content' => false,
					'terms_list' => false,
					"columns_count" => $columns,
					'slider' => $slider,
					'tag_id' => $id ? $id . '_' . $post_number : '',
					'tag_class' => '',
					'tag_animation' => '',
					'tag_css' => '',
					'tag_css_wh' => $ws . $hs
				);
				$post_data = morning_records_get_post_data($args);
				$post_meta = get_post_meta($post_data['post_id'], 'morning_records_team_data', true);
				$thumb_sizes = morning_records_get_thumb_sizes(array('layout' => $style));
				$args['position'] = $post_meta['team_member_position'];
				$args['link'] = !empty($post_meta['team_member_link']) ? $post_meta['team_member_link'] : $post_data['post_link'];
				$args['email'] = $post_meta['team_member_email'];
				$args['photo'] = $post_data['post_thumb'];
				$mult = morning_records_get_retina_multiplier();
				if (empty($args['photo']) && !empty($args['email'])) $args['photo'] = get_avatar($args['email'], $thumb_sizes['w']*$mult);
				$args['socials'] = '';
				$soc_list = $post_meta['team_member_socials'];
				if (is_array($soc_list) && count($soc_list)>0) {
					$soc_str = '';
					foreach ($soc_list as $sn=>$sl) {
						if (!empty($sl))
							$soc_str .= (!empty($soc_str) ? '|' : '') . ($sn) . '=' . ($sl);
					}
					if (!empty($soc_str))
						$args['socials'] = morning_records_do_shortcode('[trx_socials size="tiny" shape="round" socials="'.esc_attr($soc_str).'"][/trx_socials]');
				}
	
				$output .= morning_records_show_post_layout($args, $post_data);
			}
			wp_reset_postdata();
		}

		if (morning_records_param_is_on($slider)) {
			$output .= '</div>'
				. '<div class="sc_slider_controls_wrap"><a class="sc_slider_prev" href="#"></a><a class="sc_slider_next" href="#"></a></div>'
				. '<div class="sc_slider_pagination_wrap"></div>'
				. '</div>';
		} else if ($columns > 1) {// && morning_records_get_template_property($style, 'need_columns')) {
			$output .= '</div>';
		}

		$output .= (!empty($link) ? '<div class="sc_team_button sc_item_button">'.morning_records_do_shortcode('[trx_button link="'.esc_url($link).'" icon="icon-right"]'.esc_html($link_caption).'[/trx_button]').'</div>' : '')
					. '</div><!-- /.sc_team -->'
				. '</div><!-- /.sc_team_wrap -->';
	
		// Add template specific scripts and styles
		do_action('morning_records_action_blog_scripts', $style);
	
		return apply_filters('morning_records_shortcode_output', $output, 'trx_team', $atts, $content);
	}
	morning_records_require_shortcode('trx_team', 'morning_records_sc_team');
}


if ( !function_exists( 'morning_records_sc_team_item' ) ) {
	function morning_records_sc_team_item($atts, $content=null) {
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts( array(
			// Individual params
			"user" => "",
			"member" => "",
			"name" => "",
			"position" => "",
			"photo" => "",
			"email" => "",
			"link" => "",
			"socials" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => ""
		), $atts)));
	
		morning_records_storage_inc_array('sc_team_data', 'counter');
	
		$id = $id ? $id : (morning_records_storage_get_array('sc_team_data', 'id') ? morning_records_storage_get_array('sc_team_data', 'id') . '_' . morning_records_storage_get_array('sc_team_data', 'counter') : '');
	
		$descr = trim(chop(do_shortcode($content)));
	
		$thumb_sizes = morning_records_get_thumb_sizes(array('layout' => morning_records_storage_get_array('sc_team_data', 'style')));
	
		if (!empty($socials)) $socials = morning_records_do_shortcode('[trx_socials size="tiny" shape="round" socials="'.esc_attr($socials).'"][/trx_socials]');
	
		if (!empty($user) && $user!='none' && ($user_obj = get_user_by('login', $user)) != false) {
			$meta = get_user_meta($user_obj->ID);
			if (empty($email))		$email = $user_obj->data->user_email;
			if (empty($name))		$name = $user_obj->data->display_name;
			if (empty($position))	$position = isset($meta['user_position'][0]) ? $meta['user_position'][0] : '';
			if (empty($descr))		$descr = isset($meta['description'][0]) ? $meta['description'][0] : '';
			if (empty($socials))	$socials = morning_records_show_user_socials(array('author_id'=>$user_obj->ID, 'echo'=>false));
		}
	
		if (!empty($member) && $member!='none' && ($member_obj = (intval($member) > 0 ? get_post($member, OBJECT) : get_page_by_title($member, OBJECT, 'team'))) != null) {
			if (empty($name))		$name = $member_obj->post_title;
			if (empty($descr))		$descr = $member_obj->post_excerpt;
			$post_meta = get_post_meta($member_obj->ID, 'morning_records_team_data', true);
			if (empty($position))	$position = $post_meta['team_member_position'];
			if (empty($link))		$link = !empty($post_meta['team_member_link']) ? $post_meta['team_member_link'] : get_permalink($member_obj->ID);
			if (empty($email))		$email = $post_meta['team_member_email'];
			if (empty($photo)) 		$photo = wp_get_attachment_url(get_post_thumbnail_id($member_obj->ID));
			if (empty($socials)) {
				$socials = '';
				$soc_list = $post_meta['team_member_socials'];
				if (is_array($soc_list) && count($soc_list)>0) {
					$soc_str = '';
					foreach ($soc_list as $sn=>$sl) {
						if (!empty($sl))
							$soc_str .= (!empty($soc_str) ? '|' : '') . ($sn) . '=' . ($sl);
					}
					if (!empty($soc_str))
						$socials = morning_records_do_shortcode('[trx_socials size="tiny" shape="round" socials="'.esc_attr($soc_str).'"][/trx_socials]');
				}
			}
		}
		if (empty($photo)) {
			$mult = morning_records_get_retina_multiplier();
			if (!empty($email)) $photo = get_avatar($email, $thumb_sizes['w']*$mult);
		} else {
			if ($photo > 0) {
				$attach = wp_get_attachment_image_src( $photo, 'full' );
				if (isset($attach[0]) && $attach[0]!='')
					$photo = $attach[0];
			}
			$photo = morning_records_get_resized_image_tag($photo, $thumb_sizes['w'], $thumb_sizes['h']);
		}
		$post_data = array(
			'post_title' => $name,
			'post_excerpt' => $descr
		);
		$args = array(
			'layout' => morning_records_storage_get_array('sc_team_data', 'style'),
			'number' => morning_records_storage_get_array('sc_team_data', 'counter'),
			'columns_count' => morning_records_storage_get_array('sc_team_data', 'columns'),
			'slider' => morning_records_storage_get_array('sc_team_data', 'slider'),
			'show' => false,
			'descr'  => 0,
			'tag_id' => $id,
			'tag_class' => $class,
			'tag_animation' => $animation,
			'tag_css' => $css,
			'tag_css_wh' => morning_records_storage_get_array('sc_team_data', 'css_wh'),
			'position' => $position,
			'link' => $link,
			'email' => $email,
			'photo' => $photo,
			'socials' => $socials
		);
		$output = morning_records_show_post_layout($args, $post_data);

		return apply_filters('morning_records_shortcode_output', $output, 'trx_team_item', $atts, $content);
	}
	morning_records_require_shortcode('trx_team_item', 'morning_records_sc_team_item');
}
// ---------------------------------- [/trx_team] ---------------------------------------



// Add [trx_team] and [trx_team_item] in the shortcodes list
if (!function_exists('morning_records_team_reg_shortcodes')) {
	//add_filter('morning_records_action_shortcodes_list',	'morning_records_team_reg_shortcodes');
	function morning_records_team_reg_shortcodes() {
		if (morning_records_storage_isset('shortcodes')) {

			$users = morning_records_get_list_users();
			$members = morning_records_get_list_posts(false, array(
				'post_type'=>'team',
				'orderby'=>'title',
				'order'=>'asc',
				'return'=>'title'
				)
			);
			$team_groups = morning_records_get_list_terms(false, 'team_group');
			$team_styles = morning_records_get_list_templates('team');
			$controls	 = morning_records_get_list_slider_controls();

			morning_records_sc_map_after('trx_tabs', array(

				// Team
				"trx_team" => array(
					"title" => esc_html__("Team", 'morning-records'),
					"desc" => wp_kses_data( __("Insert team in your page (post)", 'morning-records') ),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"title" => array(
							"title" => esc_html__("Title", 'morning-records'),
							"desc" => wp_kses_data( __("Title for the block", 'morning-records') ),
							"value" => "",
							"type" => "text"
						),
						"subtitle" => array(
							"title" => esc_html__("Subtitle", 'morning-records'),
							"desc" => wp_kses_data( __("Subtitle for the block", 'morning-records') ),
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => esc_html__("Description", 'morning-records'),
							"desc" => wp_kses_data( __("Short description for the block", 'morning-records') ),
							"value" => "",
							"type" => "textarea"
						),
						"style" => array(
							"title" => esc_html__("Team style", 'morning-records'),
							"desc" => wp_kses_data( __("Select style to display team members", 'morning-records') ),
							"value" => "1",
							"type" => "select",
							"options" => $team_styles
						),
						"columns" => array(
							"title" => esc_html__("Columns", 'morning-records'),
							"desc" => wp_kses_data( __("How many columns use to show team members", 'morning-records') ),
							"value" => 3,
							"min" => 2,
							"max" => 5,
							"step" => 1,
							"type" => "spinner"
						),
						"scheme" => array(
							"title" => esc_html__("Color scheme", 'morning-records'),
							"desc" => wp_kses_data( __("Select color scheme for this block", 'morning-records') ),
							"value" => "",
							"type" => "checklist",
							"options" => morning_records_get_sc_param('schemes')
						),
						"slider" => array(
							"title" => esc_html__("Slider", 'morning-records'),
							"desc" => wp_kses_data( __("Use slider to show team members", 'morning-records') ),
							"value" => "no",
							"type" => "switch",
							"options" => morning_records_get_sc_param('yes_no')
						),
						"controls" => array(
							"title" => esc_html__("Controls", 'morning-records'),
							"desc" => wp_kses_data( __("Slider controls style and position", 'morning-records') ),
							"dependency" => array(
								'slider' => array('yes')
							),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $controls
						),
						"slides_space" => array(
							"title" => esc_html__("Space between slides", 'morning-records'),
							"desc" => wp_kses_data( __("Size of space (in px) between slides", 'morning-records') ),
							"dependency" => array(
								'slider' => array('yes')
							),
							"value" => 0,
							"min" => 0,
							"max" => 100,
							"step" => 10,
							"type" => "spinner"
						),
						"interval" => array(
							"title" => esc_html__("Slides change interval", 'morning-records'),
							"desc" => wp_kses_data( __("Slides change interval (in milliseconds: 1000ms = 1s)", 'morning-records') ),
							"dependency" => array(
								'slider' => array('yes')
							),
							"value" => 7000,
							"step" => 500,
							"min" => 0,
							"type" => "spinner"
						),
						"autoheight" => array(
							"title" => esc_html__("Autoheight", 'morning-records'),
							"desc" => wp_kses_data( __("Change whole slider's height (make it equal current slide's height)", 'morning-records') ),
							"dependency" => array(
								'slider' => array('yes')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => morning_records_get_sc_param('yes_no')
						),
						"align" => array(
							"title" => esc_html__("Alignment", 'morning-records'),
							"desc" => wp_kses_data( __("Alignment of the team block", 'morning-records') ),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => morning_records_get_sc_param('align')
						),
						"custom" => array(
							"title" => esc_html__("Custom", 'morning-records'),
							"desc" => wp_kses_data( __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", 'morning-records') ),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => morning_records_get_sc_param('yes_no')
						),
						"cat" => array(
							"title" => esc_html__("Categories", 'morning-records'),
							"desc" => wp_kses_data( __("Select categories (groups) to show team members. If empty - select team members from any category (group) or from IDs list", 'morning-records') ),
							"dependency" => array(
								'custom' => array('no')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => morning_records_array_merge(array(0 => esc_html__('- Select category -', 'morning-records')), $team_groups)
						),
						"count" => array(
							"title" => esc_html__("Number of posts", 'morning-records'),
							"desc" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'morning-records') ),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => esc_html__("Offset before select posts", 'morning-records'),
							"desc" => wp_kses_data( __("Skip posts before select next part.", 'morning-records') ),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => esc_html__("Post order by", 'morning-records'),
							"desc" => wp_kses_data( __("Select desired posts sorting method", 'morning-records') ),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "title",
							"type" => "select",
							"options" => morning_records_get_sc_param('sorting')
						),
						"order" => array(
							"title" => esc_html__("Post order", 'morning-records'),
							"desc" => wp_kses_data( __("Select desired posts order", 'morning-records') ),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "asc",
							"type" => "switch",
							"size" => "big",
							"options" => morning_records_get_sc_param('ordering')
						),
						"ids" => array(
							"title" => esc_html__("Post IDs list", 'morning-records'),
							"desc" => wp_kses_data( __("Comma separated list of posts ID. If set - parameters above are ignored!", 'morning-records') ),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "",
							"type" => "text"
						),
						"link" => array(
							"title" => esc_html__("Button URL", 'morning-records'),
							"desc" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'morning-records') ),
							"value" => "",
							"type" => "text"
						),
						"link_caption" => array(
							"title" => esc_html__("Button caption", 'morning-records'),
							"desc" => wp_kses_data( __("Caption for the button at the bottom of the block", 'morning-records') ),
							"value" => "",
							"type" => "text"
						),
						"width" => morning_records_shortcodes_width(),
						"height" => morning_records_shortcodes_height(),
						"top" => morning_records_get_sc_param('top'),
						"bottom" => morning_records_get_sc_param('bottom'),
						"left" => morning_records_get_sc_param('left'),
						"right" => morning_records_get_sc_param('right'),
						"id" => morning_records_get_sc_param('id'),
						"class" => morning_records_get_sc_param('class'),
						"animation" => morning_records_get_sc_param('animation'),
						"css" => morning_records_get_sc_param('css')
					),
					"children" => array(
						"name" => "trx_team_item",
						"title" => esc_html__("Member", 'morning-records'),
						"desc" => wp_kses_data( __("Team member", 'morning-records') ),
						"container" => true,
						"params" => array(
							"user" => array(
								"title" => esc_html__("Registerd user", 'morning-records'),
								"desc" => wp_kses_data( __("Select one of registered users (if present) or put name, position, etc. in fields below", 'morning-records') ),
								"value" => "",
								"type" => "select",
								"options" => $users
							),
							"member" => array(
								"title" => esc_html__("Team member", 'morning-records'),
								"desc" => wp_kses_data( __("Select one of team members (if present) or put name, position, etc. in fields below", 'morning-records') ),
								"value" => "",
								"type" => "select",
								"options" => $members
							),
							"link" => array(
								"title" => esc_html__("Link", 'morning-records'),
								"desc" => wp_kses_data( __("Link on team member's personal page", 'morning-records') ),
								"divider" => true,
								"value" => "",
								"type" => "text"
							),
							"name" => array(
								"title" => esc_html__("Name", 'morning-records'),
								"desc" => wp_kses_data( __("Team member's name", 'morning-records') ),
								"divider" => true,
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"position" => array(
								"title" => esc_html__("Position", 'morning-records'),
								"desc" => wp_kses_data( __("Team member's position", 'morning-records') ),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"email" => array(
								"title" => esc_html__("E-mail", 'morning-records'),
								"desc" => wp_kses_data( __("Team member's e-mail", 'morning-records') ),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"photo" => array(
								"title" => esc_html__("Photo", 'morning-records'),
								"desc" => wp_kses_data( __("Team member's photo (avatar)", 'morning-records') ),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"readonly" => false,
								"type" => "media"
							),
							"socials" => array(
								"title" => esc_html__("Socials", 'morning-records'),
								"desc" => wp_kses_data( __("Team member's socials icons: name=url|name=url... For example: facebook=http://facebook.com/myaccount|twitter=http://twitter.com/myaccount", 'morning-records') ),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"_content_" => array(
								"title" => esc_html__("Description", 'morning-records'),
								"desc" => wp_kses_data( __("Team member's short description", 'morning-records') ),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => morning_records_get_sc_param('id'),
							"class" => morning_records_get_sc_param('class'),
							"animation" => morning_records_get_sc_param('animation'),
							"css" => morning_records_get_sc_param('css')
						)
					)
				)

			));
		}
	}
}


// Add [trx_team] and [trx_team_item] in the VC shortcodes list
if (!function_exists('morning_records_team_reg_shortcodes_vc')) {
	//add_filter('morning_records_action_shortcodes_list_vc',	'morning_records_team_reg_shortcodes_vc');
	function morning_records_team_reg_shortcodes_vc() {

		$users = morning_records_get_list_users();
		$members = morning_records_get_list_posts(false, array(
			'post_type'=>'team',
			'orderby'=>'title',
			'order'=>'asc',
			'return'=>'title'
			)
		);
		$team_groups = morning_records_get_list_terms(false, 'team_group');
		$team_styles = morning_records_get_list_templates('team');
		$controls	 = morning_records_get_list_slider_controls();

		// Team
		vc_map( array(
				"base" => "trx_team",
				"name" => esc_html__("Team", 'morning-records'),
				"description" => wp_kses_data( __("Insert team members", 'morning-records') ),
				"category" => esc_html__('Content', 'morning-records'),
				'icon' => 'icon_trx_team',
				"class" => "trx_sc_columns trx_sc_team",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"as_parent" => array('only' => 'trx_team_item'),
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => esc_html__("Team style", 'morning-records'),
						"description" => wp_kses_data( __("Select style to display team members", 'morning-records') ),
						"class" => "",
						"admin_label" => true,
						"value" => array_flip($team_styles),
						"type" => "dropdown"
					),
					array(
						"param_name" => "scheme",
						"heading" => esc_html__("Color scheme", 'morning-records'),
						"description" => wp_kses_data( __("Select color scheme for this block", 'morning-records') ),
						"class" => "",
						"value" => array_flip(morning_records_get_sc_param('schemes')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "slider",
						"heading" => esc_html__("Slider", 'morning-records'),
						"description" => wp_kses_data( __("Use slider to show team members", 'morning-records') ),
						"admin_label" => true,
						"group" => esc_html__('Slider', 'morning-records'),
						"class" => "",
						"std" => "no",
						"value" => array_flip(morning_records_get_sc_param('yes_no')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "controls",
						"heading" => esc_html__("Controls", 'morning-records'),
						"description" => wp_kses_data( __("Slider controls style and position", 'morning-records') ),
						"admin_label" => true,
						"group" => esc_html__('Slider', 'morning-records'),
						'dependency' => array(
							'element' => 'slider',
							'value' => 'yes'
						),
						"class" => "",
						"std" => "no",
						"value" => array_flip($controls),
						"type" => "dropdown"
					),
					array(
						"param_name" => "slides_space",
						"heading" => esc_html__("Space between slides", 'morning-records'),
						"description" => wp_kses_data( __("Size of space (in px) between slides", 'morning-records') ),
						"admin_label" => true,
						"group" => esc_html__('Slider', 'morning-records'),
						'dependency' => array(
							'element' => 'slider',
							'value' => 'yes'
						),
						"class" => "",
						"value" => "0",
						"type" => "textfield"
					),
					array(
						"param_name" => "interval",
						"heading" => esc_html__("Slides change interval", 'morning-records'),
						"description" => wp_kses_data( __("Slides change interval (in milliseconds: 1000ms = 1s)", 'morning-records') ),
						"group" => esc_html__('Slider', 'morning-records'),
						'dependency' => array(
							'element' => 'slider',
							'value' => 'yes'
						),
						"class" => "",
						"value" => "7000",
						"type" => "textfield"
					),
					array(
						"param_name" => "autoheight",
						"heading" => esc_html__("Autoheight", 'morning-records'),
						"description" => wp_kses_data( __("Change whole slider's height (make it equal current slide's height)", 'morning-records') ),
						"group" => esc_html__('Slider', 'morning-records'),
						'dependency' => array(
							'element' => 'slider',
							'value' => 'yes'
						),
						"class" => "",
						"value" => array("Autoheight" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "align",
						"heading" => esc_html__("Alignment", 'morning-records'),
						"description" => wp_kses_data( __("Alignment of the team block", 'morning-records') ),
						"class" => "",
						"value" => array_flip(morning_records_get_sc_param('align')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "custom",
						"heading" => esc_html__("Custom", 'morning-records'),
						"description" => wp_kses_data( __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", 'morning-records') ),
						"class" => "",
						"value" => array("Custom members" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "title",
						"heading" => esc_html__("Title", 'morning-records'),
						"description" => wp_kses_data( __("Title for the block", 'morning-records') ),
						"admin_label" => true,
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "subtitle",
						"heading" => esc_html__("Subtitle", 'morning-records'),
						"description" => wp_kses_data( __("Subtitle for the block", 'morning-records') ),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "description",
						"heading" => esc_html__("Description", 'morning-records'),
						"description" => wp_kses_data( __("Description for the block", 'morning-records') ),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textarea"
					),
					array(
						"param_name" => "cat",
						"heading" => esc_html__("Categories", 'morning-records'),
						"description" => wp_kses_data( __("Select category to show team members. If empty - select team members from any category (group) or from IDs list", 'morning-records') ),
						"group" => esc_html__('Query', 'morning-records'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip(morning_records_array_merge(array(0 => esc_html__('- Select category -', 'morning-records')), $team_groups)),
						"type" => "dropdown"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'morning-records'),
						"description" => wp_kses_data( __("How many columns use to show team members", 'morning-records') ),
						"group" => esc_html__('Query', 'morning-records'),
						"admin_label" => true,
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "count",
						"heading" => esc_html__("Number of posts", 'morning-records'),
						"description" => wp_kses_data( __("How many posts will be displayed? If used IDs - this parameter ignored.", 'morning-records') ),
						"group" => esc_html__('Query', 'morning-records'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "offset",
						"heading" => esc_html__("Offset before select posts", 'morning-records'),
						"description" => wp_kses_data( __("Skip posts before select next part.", 'morning-records') ),
						"group" => esc_html__('Query', 'morning-records'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "0",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Post sorting", 'morning-records'),
						"description" => wp_kses_data( __("Select desired posts sorting method", 'morning-records') ),
						"group" => esc_html__('Query', 'morning-records'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"std" => "title",
						"class" => "",
						"value" => array_flip(morning_records_get_sc_param('sorting')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Post order", 'morning-records'),
						"description" => wp_kses_data( __("Select desired posts order", 'morning-records') ),
						"group" => esc_html__('Query', 'morning-records'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"std" => "asc",
						"class" => "",
						"value" => array_flip(morning_records_get_sc_param('ordering')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "ids",
						"heading" => esc_html__("Team member's IDs list", 'morning-records'),
						"description" => wp_kses_data( __("Comma separated list of team members's ID. If set - parameters above (category, count, order, etc.)  are ignored!", 'morning-records') ),
						"group" => esc_html__('Query', 'morning-records'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link",
						"heading" => esc_html__("Button URL", 'morning-records'),
						"description" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'morning-records') ),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link_caption",
						"heading" => esc_html__("Button caption", 'morning-records'),
						"description" => wp_kses_data( __("Caption for the button at the bottom of the block", 'morning-records') ),
						"group" => esc_html__('Captions', 'morning-records'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					morning_records_vc_width(),
					morning_records_vc_height(),
					morning_records_get_vc_param('margin_top'),
					morning_records_get_vc_param('margin_bottom'),
					morning_records_get_vc_param('margin_left'),
					morning_records_get_vc_param('margin_right'),
					morning_records_get_vc_param('id'),
					morning_records_get_vc_param('class'),
					morning_records_get_vc_param('animation'),
					morning_records_get_vc_param('css')
				),
				'default_content' => '
					[trx_team_item user="' . esc_html__( 'Member 1', 'morning-records' ) . '"][/trx_team_item]
					[trx_team_item user="' . esc_html__( 'Member 2', 'morning-records' ) . '"][/trx_team_item]
					[trx_team_item user="' . esc_html__( 'Member 4', 'morning-records' ) . '"][/trx_team_item]
				',
				'js_view' => 'VcTrxColumnsView'
			) );
			
			
		vc_map( array(
				"base" => "trx_team_item",
				"name" => esc_html__("Team member", 'morning-records'),
				"description" => wp_kses_data( __("Team member - all data pull out from it account on your site", 'morning-records') ),
				"show_settings_on_create" => true,
				"class" => "trx_sc_collection trx_sc_column_item trx_sc_team_item",
				"content_element" => true,
				"is_container" => true,
				'icon' => 'icon_trx_team_item',
				"as_child" => array('only' => 'trx_team'),
				"as_parent" => array('except' => 'trx_team'),
				"params" => array(
					array(
						"param_name" => "user",
						"heading" => esc_html__("Registered user", 'morning-records'),
						"description" => wp_kses_data( __("Select one of registered users (if present) or put name, position, etc. in fields below", 'morning-records') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($users),
						"type" => "dropdown"
					),
					array(
						"param_name" => "member",
						"heading" => esc_html__("Team member", 'morning-records'),
						"description" => wp_kses_data( __("Select one of team members (if present) or put name, position, etc. in fields below", 'morning-records') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip($members),
						"type" => "dropdown"
					),
					array(
						"param_name" => "link",
						"heading" => esc_html__("Link", 'morning-records'),
						"description" => wp_kses_data( __("Link on team member's personal page", 'morning-records') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "name",
						"heading" => esc_html__("Name", 'morning-records'),
						"description" => wp_kses_data( __("Team member's name", 'morning-records') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "position",
						"heading" => esc_html__("Position", 'morning-records'),
						"description" => wp_kses_data( __("Team member's position", 'morning-records') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "email",
						"heading" => esc_html__("E-mail", 'morning-records'),
						"description" => wp_kses_data( __("Team member's e-mail", 'morning-records') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "photo",
						"heading" => esc_html__("Member's Photo", 'morning-records'),
						"description" => wp_kses_data( __("Team member's photo (avatar)", 'morning-records') ),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "socials",
						"heading" => esc_html__("Socials", 'morning-records'),
						"description" => wp_kses_data( __("Team member's socials icons: name=url|name=url... For example: facebook=http://facebook.com/myaccount|twitter=http://twitter.com/myaccount", 'morning-records') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					morning_records_get_vc_param('id'),
					morning_records_get_vc_param('class'),
					morning_records_get_vc_param('animation'),
					morning_records_get_vc_param('css')
				),
				'js_view' => 'VcTrxColumnItemView'
			) );
			
		class WPBakeryShortCode_Trx_Team extends MORNING_RECORDS_VC_ShortCodeColumns {}
		class WPBakeryShortCode_Trx_Team_Item extends MORNING_RECORDS_VC_ShortCodeCollection {}

	}
}
?>