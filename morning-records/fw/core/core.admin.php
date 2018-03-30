<?php
/**
 * Morning records Framework: Admin functions
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Admin actions and filters:
------------------------------------------------------------------------ */

if (is_admin()) {

	/* Theme setup section
	-------------------------------------------------------------------- */
	
	if ( !function_exists( 'morning_records_admin_theme_setup' ) ) {
		add_action( 'morning_records_action_before_init_theme', 'morning_records_admin_theme_setup', 11 );
		function morning_records_admin_theme_setup() {
			if ( is_admin() ) {
				add_action("admin_head",			'morning_records_admin_prepare_scripts');
				add_action("admin_enqueue_scripts",	'morning_records_admin_load_scripts');
				add_action('tgmpa_register',		'morning_records_admin_register_plugins');

				// AJAX: Get terms for specified post type
				add_action('wp_ajax_morning_records_admin_change_post_type', 		'morning_records_callback_admin_change_post_type');
				add_action('wp_ajax_nopriv_morning_records_admin_change_post_type','morning_records_callback_admin_change_post_type');
			}
		}
	}
	
	// Load required styles and scripts for admin mode
	if ( !function_exists( 'morning_records_admin_load_scripts' ) ) {
		//add_action("admin_enqueue_scripts", 'morning_records_admin_load_scripts');
		function morning_records_admin_load_scripts() {
			morning_records_enqueue_script( 'morning_records-debug-script', morning_records_get_file_url('js/core.debug.js'), array('jquery'), null, true );
			//if (morning_records_options_is_used()) {
				morning_records_enqueue_style( 'morning_records-admin-style', morning_records_get_file_url('css/core.admin.css'), array(), null );
				morning_records_enqueue_script( 'morning_records-admin-script', morning_records_get_file_url('js/core.admin.js'), array('jquery'), null, true );
			//}
			if (morning_records_strpos($_SERVER['REQUEST_URI'], 'widgets.php')!==false) {
				morning_records_enqueue_style( 'morning_records-fontello-style', morning_records_get_file_url('css/fontello-admin/css/fontello-admin.css'), array(), null );
				morning_records_enqueue_style( 'morning_records-animations-style', morning_records_get_file_url('css/fontello-admin/css/animation.css'), array(), null );
			}
		}
	}
	
	// Prepare required styles and scripts for admin mode
	if ( !function_exists( 'morning_records_admin_prepare_scripts' ) ) {
		//add_action("admin_head", 'morning_records_admin_prepare_scripts');
		function morning_records_admin_prepare_scripts() {
			?>
			<script>
				if (typeof MORNING_RECORDS_STORAGE == 'undefined') var MORNING_RECORDS_STORAGE = {};
				MORNING_RECORDS_STORAGE['admin_mode']	= true;
				MORNING_RECORDS_STORAGE['ajax_nonce'] 	= "<?php echo esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))); ?>";
				MORNING_RECORDS_STORAGE['ajax_url']	= "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";
				MORNING_RECORDS_STORAGE['ajax_error']	= "<?php esc_html_e('Invalid server answer', 'morning-records'); ?>";
				MORNING_RECORDS_STORAGE['importer_error_msg'] = "<?php esc_html_e('Errors that occurred during the import process:', 'morning-records'); ?>";
				MORNING_RECORDS_STORAGE['user_logged_in'] = true;
			</script>
			<?php
		}
	}
	
	// AJAX: Get terms for specified post type
	if ( !function_exists( 'morning_records_callback_admin_change_post_type' ) ) {
		//add_action('wp_ajax_morning_records_admin_change_post_type', 		'morning_records_callback_admin_change_post_type');
		//add_action('wp_ajax_nopriv_morning_records_admin_change_post_type',	'morning_records_callback_admin_change_post_type');
		function morning_records_callback_admin_change_post_type() {
			if ( !wp_verify_nonce( morning_records_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
				die();
			$post_type = $_REQUEST['post_type'];
			$terms = morning_records_get_list_terms(false, morning_records_get_taxonomy_categories_by_post_type($post_type));
			$terms = morning_records_array_merge(array(0 => esc_html__('- Select category -', 'morning-records')), $terms);
			$response = array(
				'error' => '',
				'data' => array(
					'ids' => array_keys($terms),
					'titles' => array_values($terms)
				)
			);
			echo json_encode($response);
			die();
		}
	}

	// Return current post type in dashboard
	if ( !function_exists( 'morning_records_admin_get_current_post_type' ) ) {
		function morning_records_admin_get_current_post_type() {
			global $post, $typenow, $current_screen;
			if ( $post && $post->post_type )							//we have a post so we can just get the post type from that
				return $post->post_type;
			else if ( $typenow )										//check the global $typenow — set in admin.php
				return $typenow;
			else if ( $current_screen && $current_screen->post_type )	//check the global $current_screen object — set in sceen.php
				return $current_screen->post_type;
			else if ( isset( $_REQUEST['post_type'] ) )					//check the post_type querystring
				return sanitize_key( $_REQUEST['post_type'] );
			else if ( isset( $_REQUEST['post'] ) ) {					//lastly check the post id querystring
				$post = get_post( sanitize_key( $_REQUEST['post'] ) );
				return !empty($post->post_type) ? $post->post_type : '';
			} else														//we do not know the post type!
				return '';
		}
	}

	// Add admin menu pages
	if ( !function_exists( 'morning_records_admin_add_menu_item' ) ) {
		function morning_records_admin_add_menu_item($mode, $item, $pos='100') {
			static $shift = 0;
			if ($pos=='100') $pos .= '.'.$shift++;
			$fn = join('_', array('add', $mode, 'page'));
			if (empty($item['parent']))
				$fn($item['page_title'], $item['menu_title'], $item['capability'], $item['menu_slug'], $item['callback'], $item['icon'], $pos);
			else
				$fn($item['parent'], $item['page_title'], $item['menu_title'], $item['capability'], $item['menu_slug'], $item['callback'], $item['icon'], $pos);
		}
	}
	
	// Register optional plugins
	if ( !function_exists( 'morning_records_admin_register_plugins' ) ) {
		function morning_records_admin_register_plugins() {

			$plugins = apply_filters('morning_records_filter_required_plugins', array());
			$config = array(
				'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '',                      // Default absolute path to bundled plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'parent_slug'  => 'themes.php',            // Parent menu slug.
				'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => true,                    // Automatically activate plugins after installation or not.
				'message'      => ''                       // Message to output right before the plugins table.
			);
	
			tgmpa( $plugins, $config );
		}
	}

	get_template_part(morning_records_get_file_slug('lib/tgm/class-tgm-plugin-activation.php'));

	get_template_part(morning_records_get_file_slug('tools/emailer/emailer.php'));
	get_template_part(morning_records_get_file_slug('tools/po_composer/po_composer.php'));
}

?>