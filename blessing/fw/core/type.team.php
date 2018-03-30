<?php
/**
 * Ancora Framework: Team post type settings
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Theme init
if (!function_exists('ancora_team_theme_setup')) {
	add_action( 'ancora_action_before_init_theme', 'ancora_team_theme_setup' );
	function ancora_team_theme_setup() {

		// Add item in the admin menu
		add_action('admin_menu',							'ancora_team_add_meta_box');

		// Save data from meta box
		add_action('save_post',								'ancora_team_save_data');
		
		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('ancora_filter_get_blog_type',			'ancora_team_get_blog_type', 9, 2);
		add_filter('ancora_filter_get_blog_title',		'ancora_team_get_blog_title', 9, 2);
		add_filter('ancora_filter_get_current_taxonomy',	'ancora_team_get_current_taxonomy', 9, 2);
		add_filter('ancora_filter_is_taxonomy',			'ancora_team_is_taxonomy', 9, 2);
		add_filter('ancora_filter_get_stream_page_title',	'ancora_team_get_stream_page_title', 9, 2);
		add_filter('ancora_filter_get_stream_page_link',	'ancora_team_get_stream_page_link', 9, 2);
		add_filter('ancora_filter_get_stream_page_id',	'ancora_team_get_stream_page_id', 9, 2);
		add_filter('ancora_filter_query_add_filters',		'ancora_team_query_add_filters', 9, 2);
		add_filter('ancora_filter_detect_inheritance_key','ancora_team_detect_inheritance_key', 9, 1);

		// Extra column for team members lists
		if (ancora_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-team_columns',			'ancora_post_add_options_column', 9);
			add_filter('manage_team_posts_custom_column',	'ancora_post_fill_options_column', 9, 2);
		}

		// Meta box fields
		global $ANCORA_GLOBALS;
		$ANCORA_GLOBALS['team_meta_box'] = array(
			'id' => 'team-meta-box',
			'title' => __('Team Member Details', 'ancora'),
			'page' => 'team',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				"team_member_position" => array(
					"title" => __('Position',  'ancora'),
					"desc" => __("Position of the team member", 'ancora'),
					"class" => "team_member_position",
					"std" => "",
					"type" => "text"),
				"team_member_email" => array(
					"title" => __("E-mail",  'ancora'),
					"desc" => __("E-mail of the team member - need to take Gravatar (if registered)", 'ancora'),
					"class" => "team_member_email",
					"std" => "",
					"type" => "text"),
				"team_member_link" => array(
					"title" => __('Link to profile',  'ancora'),
					"desc" => __("URL of the team member profile page (if not this page)", 'ancora'),
					"class" => "team_member_link",
					"std" => "",
					"type" => "text"),
				"team_member_socials" => array(
					"title" => __("Social links",  'ancora'),
					"desc" => __("Links to the social profiles of the team member", 'ancora'),
					"class" => "team_member_email",
					"std" => "",
					"type" => "social")
			)
		);
		
		// Prepare type "Team"
		ancora_require_data( 'post_type', 'team', array(
			'label'               => __( 'Team member', 'ancora' ),
			'description'         => __( 'Team Description', 'ancora' ),
			'labels'              => array(
				'name'                => _x( 'Team', 'Post Type General Name', 'ancora' ),
				'singular_name'       => _x( 'Team member', 'Post Type Singular Name', 'ancora' ),
				'menu_name'           => __( 'Team', 'ancora' ),
				'parent_item_colon'   => __( 'Parent Item:', 'ancora' ),
				'all_items'           => __( 'All Team', 'ancora' ),
				'view_item'           => __( 'View Item', 'ancora' ),
				'add_new_item'        => __( 'Add New Team member', 'ancora' ),
				'add_new'             => __( 'Add New', 'ancora' ),
				'edit_item'           => __( 'Edit Item', 'ancora' ),
				'update_item'         => __( 'Update Item', 'ancora' ),
				'search_items'        => __( 'Search Item', 'ancora' ),
				'not_found'           => __( 'Not found', 'ancora' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'ancora' ),
			),
			'supports'            => array( 'title', 'excerpt', 'editor', 'author', 'thumbnail', 'comments'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'			  => 'dashicons-admin-users',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 25,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'capability_type'     => 'page',
			'rewrite'             => true
			)
		);
		
		// Prepare taxonomy for team
		ancora_require_data( 'taxonomy', 'team_group', array(
			'post_type'			=> array( 'team' ),
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => _x( 'Team Group', 'taxonomy general name', 'ancora' ),
				'singular_name'     => _x( 'Group', 'taxonomy singular name', 'ancora' ),
				'search_items'      => __( 'Search Groups', 'ancora' ),
				'all_items'         => __( 'All Groups', 'ancora' ),
				'parent_item'       => __( 'Parent Group', 'ancora' ),
				'parent_item_colon' => __( 'Parent Group:', 'ancora' ),
				'edit_item'         => __( 'Edit Group', 'ancora' ),
				'update_item'       => __( 'Update Group', 'ancora' ),
				'add_new_item'      => __( 'Add New Group', 'ancora' ),
				'new_item_name'     => __( 'New Group Name', 'ancora' ),
				'menu_name'         => __( 'Team Group', 'ancora' ),
			),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'team_group' ),
			)
		);
	}
}

if ( !function_exists( 'ancora_team_settings_theme_setup2' ) ) {
	add_action( 'ancora_action_before_init_theme', 'ancora_team_settings_theme_setup2', 3 );
	function ancora_team_settings_theme_setup2() {
		// Add post type 'team' and taxonomy 'team_group' into theme inheritance list
		ancora_add_theme_inheritance( array('team' => array(
			'stream_template' => 'team',
			'single_template' => 'single-team',
			'taxonomy' => array('team_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('team'),
			'override' => 'page'
			) )
		);
	}
}


// Add meta box
if (!function_exists('ancora_team_add_meta_box')) {
	//add_action('admin_menu', 'ancora_team_add_meta_box');
	function ancora_team_add_meta_box() {
		global $ANCORA_GLOBALS;
		$mb = $ANCORA_GLOBALS['team_meta_box'];
		add_meta_box($mb['id'], $mb['title'], 'ancora_team_show_meta_box', $mb['page'], $mb['context'], $mb['priority']);
	}
}

// Callback function to show fields in meta box
if (!function_exists('ancora_team_show_meta_box')) {
	function ancora_team_show_meta_box() {
		global $post, $ANCORA_GLOBALS;

		// Use nonce for verification
		$data = get_post_meta($post->ID, 'team_data', true);
		$fields = $ANCORA_GLOBALS['team_meta_box']['fields'];
		?>
		<input type="hidden" name="meta_box_team_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<table class="team_area">
		<?php
		foreach ($fields as $id=>$field) { 
			$meta = isset($data[$id]) ? $data[$id] : '';
			?>
			<tr class="team_field <?php echo esc_attr($field['class']); ?>" valign="top">
				<td><label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($field['title']); ?></label></td>
				<td>
					<?php
					if ($id == 'team_member_socials') {
						$upload_info = wp_upload_dir();
						$upload_url = $upload_info['baseurl'];
						$social_list = ancora_get_theme_option('social_icons');
						foreach ($social_list as $soc) {
							$sn = basename($soc['icon']);
							$sn = ancora_substr($sn, 0, ancora_strrpos($sn, '.'));
							if (($pos=ancora_strrpos($sn, '_'))!==false)
								$sn = ancora_substr($sn, 0, $pos);
							$link = isset($meta[$sn]) ? $meta[$sn] : '';
							?>
							<label for="<?php echo esc_attr(($id).'_'.($sn)); ?>"><?php echo esc_attr(ancora_strtoproper($sn)); ?></label><br>
							<input type="text" name="<?php echo esc_attr($id); ?>[<?php echo esc_attr($sn); ?>]" id="<?php echo esc_attr(($id).'_'.($sn)); ?>" value="<?php echo esc_attr($link); ?>" size="30" /><br>
							<?php
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
		?>
		</table>
		<?php
	}
}


// Save data from meta box
if (!function_exists('ancora_team_save_data')) {
	//add_action('save_post', 'ancora_team_save_data');
	function ancora_team_save_data($post_id) {
		// verify nonce
		if (!isset($_POST['meta_box_team_nonce']) || !wp_verify_nonce($_POST['meta_box_team_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ($_POST['post_type']!='team' || !current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		global $ANCORA_GLOBALS;

		$data = array();

		$fields = $ANCORA_GLOBALS['team_meta_box']['fields'];

		// Post type specific data handling
		foreach ($fields as $id=>$field) {
			if (isset($_POST[$id])) {
				if (is_array($_POST[$id])) {
					foreach ($_POST[$id] as $sn=>$link) {
						$_POST[$id][$sn] = stripslashes($link);
					}
					$data[$id] = $_POST[$id];
				} else {
					$data[$id] = stripslashes($_POST[$id]);
				}
			}
		}

		update_post_meta($post_id, 'team_data', $data);
	}
}



// Return true, if current page is team member page
if ( !function_exists( 'ancora_is_team_page' ) ) {
	function ancora_is_team_page() {
		return get_query_var('post_type')=='team' || is_tax('team_group') || (is_page() && ancora_get_template_page_id('team')==get_the_ID());
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'ancora_team_detect_inheritance_key' ) ) {
	//add_filter('ancora_filter_detect_inheritance_key',	'ancora_team_detect_inheritance_key', 9, 1);
	function ancora_team_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return ancora_is_team_page() ? 'team' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'ancora_team_get_blog_type' ) ) {
	//add_filter('ancora_filter_get_blog_type',	'ancora_team_get_blog_type', 9, 2);
	function ancora_team_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('team_group') || is_tax('team_group'))
			$page = 'team_category';
		else if ($query && $query->get('post_type')=='team' || get_query_var('post_type')=='team')
			$page = $query && $query->is_single() || is_single() ? 'team_item' : 'team';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'ancora_team_get_blog_title' ) ) {
	//add_filter('ancora_filter_get_blog_title',	'ancora_team_get_blog_title', 9, 2);
	function ancora_team_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( ancora_strpos($page, 'team')!==false ) {
			if ( $page == 'team_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'team_group' ), 'team_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'team_item' ) {
				$title = ancora_get_post_title();
			} else {
				$title = __('All team', 'ancora');
			}
		}

		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'ancora_team_get_stream_page_title' ) ) {
	//add_filter('ancora_filter_get_stream_page_title',	'ancora_team_get_stream_page_title', 9, 2);
	function ancora_team_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (ancora_strpos($page, 'team')!==false) {
			if (($page_id = ancora_team_get_stream_page_id(0, $page)) > 0)
				$title = ancora_get_post_title($page_id);
			else
				$title = __('All team', 'ancora');
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'ancora_team_get_stream_page_id' ) ) {
	//add_filter('ancora_filter_get_stream_page_id',	'ancora_team_get_stream_page_id', 9, 2);
	function ancora_team_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (ancora_strpos($page, 'team')!==false) $id = ancora_get_template_page_id('team');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'ancora_team_get_stream_page_link' ) ) {
	//add_filter('ancora_filter_get_stream_page_link',	'ancora_team_get_stream_page_link', 9, 2);
	function ancora_team_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (ancora_strpos($page, 'team')!==false) {
			$id = ancora_get_template_page_id('team');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'ancora_team_get_current_taxonomy' ) ) {
	//add_filter('ancora_filter_get_current_taxonomy',	'ancora_team_get_current_taxonomy', 9, 2);
	function ancora_team_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( ancora_strpos($page, 'team')!==false ) {
			$tax = 'team_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'ancora_team_is_taxonomy' ) ) {
	//add_filter('ancora_filter_is_taxonomy',	'ancora_team_is_taxonomy', 9, 2);
	function ancora_team_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get('team_group')!='' || is_tax('team_group') ? 'team_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'ancora_team_query_add_filters' ) ) {
	//add_filter('ancora_filter_query_add_filters',	'ancora_team_query_add_filters', 9, 2);
	function ancora_team_query_add_filters($args, $filter) {
		if ($filter == 'team') {
			$args['post_type'] = 'team';
		}
		return $args;
	}
}
?>