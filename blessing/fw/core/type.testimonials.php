<?php
/**
 * Ancora Framework: Testimonial post type settings
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Theme init
if (!function_exists('ancora_testimonial_theme_setup')) {
	add_action( 'ancora_action_before_init_theme', 'ancora_testimonial_theme_setup' );
	function ancora_testimonial_theme_setup() {
	
		// Add item in the admin menu
		add_action('admin_menu',			'ancora_testimonial_add_meta_box');

		// Save data from meta box
		add_action('save_post',				'ancora_testimonial_save_data');

		// Meta box fields
		global $ANCORA_GLOBALS;
		$ANCORA_GLOBALS['testimonial_meta_box'] = array(
			'id' => 'testimonial-meta-box',
			'title' => __('Testimonial Details', 'ancora'),
			'page' => 'testimonial',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				"testimonial_author" => array(
					"title" => __('Testimonial author',  'ancora'),
					"desc" => __("Name of the testimonial's author", 'ancora'),
					"class" => "testimonial_author",
					"std" => "",
					"type" => "text"),
				"testimonial_email" => array(
					"title" => __("Author's e-mail",  'ancora'),
					"desc" => __("E-mail of the testimonial's author - need to take Gravatar (if registered)", 'ancora'),
					"class" => "testimonial_email",
					"std" => "",
					"type" => "text"),
				"testimonial_link" => array(
					"title" => __('Testimonial link',  'ancora'),
					"desc" => __("URL of the testimonial source or author profile page", 'ancora'),
					"class" => "testimonial_link",
					"std" => "",
					"type" => "text")
			)
		);
		
		// Prepare type "Testimonial"
		ancora_require_data( 'post_type', 'testimonial', array(
			'label'               => __( 'Testimonial', 'ancora' ),
			'description'         => __( 'Testimonial Description', 'ancora' ),
			'labels'              => array(
				'name'                => _x( 'Testimonials', 'Post Type General Name', 'ancora' ),
				'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'ancora' ),
				'menu_name'           => __( 'Testimonials', 'ancora' ),
				'parent_item_colon'   => __( 'Parent Item:', 'ancora' ),
				'all_items'           => __( 'All Testimonials', 'ancora' ),
				'view_item'           => __( 'View Item', 'ancora' ),
				'add_new_item'        => __( 'Add New Testimonial', 'ancora' ),
				'add_new'             => __( 'Add New', 'ancora' ),
				'edit_item'           => __( 'Edit Item', 'ancora' ),
				'update_item'         => __( 'Update Item', 'ancora' ),
				'search_items'        => __( 'Search Item', 'ancora' ),
				'not_found'           => __( 'Not found', 'ancora' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'ancora' ),
			),
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail'),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'menu_icon'			  => 'dashicons-cloud',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 25,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'page',
			)
		);
		
		// Prepare taxonomy for testimonial
		ancora_require_data( 'taxonomy', 'testimonial_group', array(
			'post_type'			=> array( 'testimonial' ),
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => _x( 'Testimonials Group', 'taxonomy general name', 'ancora' ),
				'singular_name'     => _x( 'Group', 'taxonomy singular name', 'ancora' ),
				'search_items'      => __( 'Search Groups', 'ancora' ),
				'all_items'         => __( 'All Groups', 'ancora' ),
				'parent_item'       => __( 'Parent Group', 'ancora' ),
				'parent_item_colon' => __( 'Parent Group:', 'ancora' ),
				'edit_item'         => __( 'Edit Group', 'ancora' ),
				'update_item'       => __( 'Update Group', 'ancora' ),
				'add_new_item'      => __( 'Add New Group', 'ancora' ),
				'new_item_name'     => __( 'New Group Name', 'ancora' ),
				'menu_name'         => __( 'Testimonial Group', 'ancora' ),
			),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'testimonial_group' ),
			)
		);
	}
}


// Add meta box
if (!function_exists('ancora_testimonial_add_meta_box')) {
	//add_action('admin_menu', 'ancora_testimonial_add_meta_box');
	function ancora_testimonial_add_meta_box() {
		global $ANCORA_GLOBALS;
		$mb = $ANCORA_GLOBALS['testimonial_meta_box'];
		add_meta_box($mb['id'], $mb['title'], 'ancora_testimonial_show_meta_box', $mb['page'], $mb['context'], $mb['priority']);
	}
}

// Callback function to show fields in meta box
if (!function_exists('ancora_testimonial_show_meta_box')) {
	function ancora_testimonial_show_meta_box() {
		global $post, $ANCORA_GLOBALS;

		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_testimonial_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		
		$data = get_post_meta($post->ID, 'testimonial_data', true);
	
		$fields = $ANCORA_GLOBALS['testimonial_meta_box']['fields'];
		?>
		<table class="testimonial_area">
		<?php
		foreach ($fields as $id=>$field) { 
			$meta = isset($data[$id]) ? $data[$id] : '';
			?>
			<tr class="testimonial_field <?php echo esc_attr($field['class']); ?>" valign="top">
				<td><label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($field['title']); ?></label></td>
				<td><input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($meta); ?>" size="30" />
					<br><small><?php echo esc_attr($field['desc']); ?></small></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}
}


// Save data from meta box
if (!function_exists('ancora_testimonial_save_data')) {
	//add_action('save_post', 'ancora_testimonial_save_data');
	function ancora_testimonial_save_data($post_id) {
		// verify nonce
		if (!isset($_POST['meta_box_testimonial_nonce']) || !wp_verify_nonce($_POST['meta_box_testimonial_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ($_POST['post_type']!='testimonial' || !current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		global $ANCORA_GLOBALS;

		$data = array();

		$fields = $ANCORA_GLOBALS['testimonial_meta_box']['fields'];

		// Post type specific data handling
		foreach ($fields as $id=>$field) { 
			if (isset($_POST[$id])) 
				$data[$id] = stripslashes($_POST[$id]);
		}

		update_post_meta($post_id, 'testimonial_data', $data);
	}
}
?>