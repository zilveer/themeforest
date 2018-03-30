<?php
/* BuddyPress support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('morning_records_buddypress_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_buddypress_theme_setup', 1 );
	function morning_records_buddypress_theme_setup() {
		if (morning_records_exists_buddypress()) {
			// Add custom styles for Buddy & BBPress
			add_action( 'morning_records_action_add_styles', 				'morning_records_buddypress_frontend_scripts' );
			// One-click import support
			if (is_admin()) {
				add_filter( 'morning_records_filter_importer_options',			'morning_records_buddypress_importer_set_options' );
				add_action( 'morning_records_action_importer_params',			'morning_records_buddypress_importer_show_params', 10, 1 );
				add_action( 'morning_records_action_importer_clear_tables',	'morning_records_buddypress_importer_clear_tables', 10, 2 );
				add_action( 'morning_records_action_importer_import',			'morning_records_buddypress_importer_import', 10, 2 );
				add_action( 'morning_records_action_importer_import_fields',	'morning_records_buddypress_importer_import_fields', 10, 1 );
				add_action( 'morning_records_action_importer_export',			'morning_records_buddypress_importer_export', 10, 1 );
				add_action( 'morning_records_action_importer_export_fields',	'morning_records_buddypress_importer_export_fields', 10, 1 );
			}
		}
		if (morning_records_is_buddypress_page()) {
			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('morning_records_filter_get_blog_type',				'morning_records_buddypress_get_blog_type', 9, 2);
			add_filter('morning_records_filter_get_blog_title',			'morning_records_buddypress_get_blog_title', 9, 2);
			add_filter('morning_records_filter_get_stream_page_title',		'morning_records_buddypress_get_stream_page_title', 9, 2);
			add_filter('morning_records_filter_get_stream_page_link',		'morning_records_buddypress_get_stream_page_link', 9, 2);
			add_filter('morning_records_filter_get_stream_page_id',		'morning_records_buddypress_get_stream_page_id', 9, 2);
			add_filter('morning_records_filter_detect_inheritance_key',	'morning_records_buddypress_detect_inheritance_key', 9, 1);
		}
		if (is_admin()) {
			add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_buddypress_importer_required_plugins', 10, 2 );
			add_filter( 'morning_records_filter_required_plugins',				'morning_records_buddypress_required_plugins' );
		}
	}
}
if ( !function_exists( 'morning_records_buddypress_settings_theme_setup2' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_buddypress_settings_theme_setup2', 3 );
	function morning_records_buddypress_settings_theme_setup2() {
		if (morning_records_exists_buddypress()) {
			morning_records_add_theme_inheritance( array('buddypress' => array(
				'stream_template' => 'buddypress',
				'single_template' => '',
				'taxonomy' => array(),
				'taxonomy_tags' => array(),
				'post_type' => array('forum', 'topic', 'reply'),
				'override' => 'page'
				) )
			);
		}
	}
}

// Check if BuddyPress and/or BBPress installed and activated
if ( !function_exists( 'morning_records_exists_buddypress' ) ) {
	function morning_records_exists_buddypress() {
		return class_exists( 'BuddyPress' ) || class_exists( 'bbPress' );
	}
}

// Check if current page is BuddyPress and/or BBPress page
if ( !function_exists( 'morning_records_is_buddypress_page' ) ) {
	function morning_records_is_buddypress_page() {
		$is = false;
		if ( morning_records_exists_buddypress() ) {
			$is = in_array(morning_records_storage_get('page_template'), array('buddypress'));
			if (!$is && morning_records_storage_empty('pre_query') )
				$is = (function_exists('is_buddypress') && is_buddypress())
						||
						(function_exists('is_bbpress') && is_bbpress());
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'morning_records_buddypress_detect_inheritance_key' ) ) {
	//add_filter('morning_records_filter_detect_inheritance_key',	'morning_records_buddypress_detect_inheritance_key', 9, 1);
	function morning_records_buddypress_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return morning_records_is_buddypress_page() ? 'buddypress' : $key;
	}
}

// Filter to detect current page slug
if ( !function_exists( 'morning_records_buddypress_get_blog_type' ) ) {
	//add_filter('morning_records_filter_get_blog_type',	'morning_records_buddypress_get_blog_type', 9, 2);
	function morning_records_buddypress_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->get('post_type')=='forum' || get_query_var('post_type')=='forum')
			$page = 'buddypress_forum';
		else if ($query && $query->get('post_type')=='topic' || get_query_var('post_type')=='topic')
			$page = 'buddypress_topic';
		else if ($query && $query->get('post_type')=='reply' || get_query_var('post_type')=='reply')
			$page = 'buddypress_reply';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'morning_records_buddypress_get_blog_title' ) ) {
	//add_filter('morning_records_filter_get_blog_title',	'morning_records_buddypress_get_blog_title', 9, 2);
	function morning_records_buddypress_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( morning_records_strpos($page, 'buddypress')!==false ) {
			if ( $page == 'buddypress_forum' || $page == 'buddypress_topic' || $page == 'buddypress_reply' ) {
				$title = morning_records_get_post_title();
			} else {
				$title = esc_html__('Forums', 'morning-records');
			}
		}
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'morning_records_buddypress_get_stream_page_title' ) ) {
	//add_filter('morning_records_filter_get_stream_page_title',	'morning_records_buddypress_get_stream_page_title', 9, 2);
	function morning_records_buddypress_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (morning_records_strpos($page, 'buddypress')!==false) {
			// Page exists at root slug path, so use its permalink
			$page = bbp_get_page_by_path( bbp_get_root_slug() );
			if ( !empty( $page ) )
				$title = get_the_title( $page->ID );
			else
				$title = esc_html__('Forums', 'morning-records');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'morning_records_buddypress_get_stream_page_id' ) ) {
	//add_filter('morning_records_filter_get_stream_page_id',	'morning_records_buddypress_get_stream_page_id', 9, 2);
	function morning_records_buddypress_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (morning_records_strpos($page, 'buddypress')!==false) {
			// Page exists at root slug path, so use its permalink
			$page = bbp_get_page_by_path( bbp_get_root_slug() );
			if ( !empty( $page ) ) $id = $page->ID;
		}
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'morning_records_buddypress_get_stream_page_link' ) ) {
	//add_filter('morning_records_filter_get_stream_page_link', 'morning_records_buddypress_get_stream_page_link', 9, 2);
	function morning_records_buddypress_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (morning_records_strpos($page, 'buddypress')!==false) {
			// Page exists at root slug path, so use its permalink
			$page = bbp_get_page_by_path( bbp_get_root_slug() );
			if ( !empty( $page ) )
				$url = get_permalink( $page->ID );
			else
				$url = get_post_type_archive_link( bbp_get_forum_post_type() );
		}
		return $url;
	}
}


// Enqueue BuddyPress and/or BBPress custom styles
if ( !function_exists( 'morning_records_buddypress_frontend_scripts' ) ) {
	//add_action( 'morning_records_action_add_styles', 'morning_records_buddypress_frontend_scripts' );
	function morning_records_buddypress_frontend_scripts() {
		if (file_exists(morning_records_get_file_dir('css/plugin.buddypress.css')))
			morning_records_enqueue_style( 'morning_records-plugin.buddypress-style',  morning_records_get_file_url('css/plugin.buddypress.css'), array(), null );
	}
}


// Filter to add in the required plugins list
if ( !function_exists( 'morning_records_buddypress_required_plugins' ) ) {
	//add_filter('morning_records_filter_required_plugins',	'morning_records_buddypress_required_plugins');
	function morning_records_buddypress_required_plugins($list=array()) {
		if (in_array('buddypress', morning_records_storage_get('required_plugins'))) {
			$list[] = array(
					'name' 		=> 'BuddyPress',
					'slug' 		=> 'buddypress',
					'required' 	=> false
					);
			$list[] = array(
					'name' 		=> 'bbPress',
					'slug' 		=> 'bbpress',
					'required' 	=> false
					);
		}
		return $list;
	}
}



// One-click import support
//------------------------------------------------------------------------

// Check in the required plugins
if ( !function_exists( 'morning_records_buddypress_importer_required_plugins' ) ) {
	//add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_buddypress_importer_required_plugins', 10, 2 );
	function morning_records_buddypress_importer_required_plugins($not_installed='', $list='') {
		//if (in_array('buddypress', morning_records_storage_get('required_plugins')) && !morning_records_exists_buddypress() )
		if (morning_records_strpos($list, 'buddypress')!==false && !morning_records_exists_buddypress() )
			$not_installed .= '<br>BuddyPress and BBPress';
		return $not_installed;
	}
}

// Set options for one-click importer
if ( !function_exists( 'morning_records_buddypress_importer_set_options' ) ) {
	//add_filter( 'morning_records_filter_importer_options',	'morning_records_buddypress_importer_set_options', 10, 1 );
	function morning_records_buddypress_importer_set_options($options=array()) {
		if ( in_array('buddypress', morning_records_storage_get('required_plugins')) && morning_records_exists_buddypress() ) {
			if (is_array($options['files']) && count($options['files']) > 0) {
				foreach ($options['files'] as $k => $v) {
					$options['files'][$k]['file_with_buddypress'] = str_replace('posts', 'buddypress', $v['file_with_posts']);
				}
			}
			// Add option's names to export options for this plugin
			$options['additional_options'][] = 'bp-active-components';
			$options['additional_options'][] = 'bp-pages';
			$options['additional_options'][] = 'widget_bp_%';
			$options['additional_options'][] = 'bp-deactivated-components';
			$options['additional_options'][] = 'bb-config-location';
			$options['additional_options'][] = 'bp-xprofile-base-group-name';
			$options['additional_options'][] = 'bp-xprofile-fullname-field-name';
//			$options['additional_options'][] = 'bp-blogs-first-install';
			$options['additional_options'][] = 'bp-disable-profile-sync';
			$options['additional_options'][] = 'bp-disable-avatar-uploads';
			$options['additional_options'][] = 'bp-disable-group-avatar-uploads';
			$options['additional_options'][] = 'bp-disable-account-deletion';
			$options['additional_options'][] = 'bp-disable-blogforum-comments';
			$options['additional_options'][] = 'bp_restrict_group_creation';
		}
		return $options;
	}
}

// Add checkbox to the one-click importer
if ( !function_exists( 'morning_records_buddypress_importer_show_params' ) ) {
	//add_action( 'morning_records_action_importer_params',	'morning_records_buddypress_importer_show_params', 10, 1 );
	function morning_records_buddypress_importer_show_params($importer) {
		?>
		<input type="checkbox" <?php echo in_array('buddypress', morning_records_storage_get('required_plugins')) && $importer->options['plugins_initial_state'] 
											? 'checked="checked"' 
											: ''; ?> value="1" name="import_buddypress" id="import_buddypress" /> <label for="import_buddypress"><?php esc_html_e('Import BuddyPress', 'morning-records'); ?></label><br>
		<?php
	}
}

// Clear tables
if ( !function_exists( 'morning_records_buddypress_importer_clear_tables' ) ) {
	//add_action( 'morning_records_action_importer_clear_tables',	'morning_records_buddypress_importer_clear_tables', 10, 2 );
	function morning_records_buddypress_importer_clear_tables($importer, $clear_tables) {
		if (morning_records_strpos($clear_tables, 'buddypress')!==false) {
			if ($importer->options['debug']) dfl(esc_html__('Clear BuddyPress tables', 'morning-records'));
			global $wpdb;
			$activity = count($wpdb->get_results( "SHOW TABLES LIKE '".esc_sql($wpdb->prefix)."bp_activity'", ARRAY_A )) == 1;
			$friends  = count($wpdb->get_results( "SHOW TABLES LIKE '".esc_sql($wpdb->prefix)."bp_friends'", ARRAY_A )) == 1;
			$groups   = count($wpdb->get_results( "SHOW TABLES LIKE '".esc_sql($wpdb->prefix)."bp_groups'", ARRAY_A )) == 1;
			$messages = count($wpdb->get_results( "SHOW TABLES LIKE '".esc_sql($wpdb->prefix)."bp_messages_messages'", ARRAY_A )) == 1;
			$blog     = count($wpdb->get_results( "SHOW TABLES LIKE '".esc_sql($wpdb->prefix)."bp_user_blogs'", ARRAY_A )) == 1;
			$notify   = count($wpdb->get_results( "SHOW TABLES LIKE '".esc_sql($wpdb->prefix)."bp_notifications'", ARRAY_A )) == 1;
			$extended = count($wpdb->get_results( "SHOW TABLES LIKE '".esc_sql($wpdb->prefix)."bp_xprofile_data'", ARRAY_A )) == 1;
			if ($activity==0 || $friends==0 || $groups==0 || $messages==0 || $blog==0 || $notify==0 || $extended==0) {
				$bp = buddypress();
				require_once $bp->plugin_dir . '/bp-core/admin/bp-core-admin-schema.php';
				if ($activity==0)	bp_core_install_activity_streams();
				if ($friends==0)	bp_core_install_friends();
				if ($groups==0)		bp_core_install_groups();
				if ($messages==0)	bp_core_install_private_messaging();
				if ($blog==0)		bp_core_install_blog_tracking();
				if ($notify==0)		bp_core_install_notifications();
				if ($extended==0)	bp_core_install_extended_profiles();
				bp_core_maybe_install_signups();
			}
		}
	}
}

// Import posts
if ( !function_exists( 'morning_records_buddypress_importer_import' ) ) {
	//add_action( 'morning_records_action_importer_import',	'morning_records_buddypress_importer_import', 10, 2 );
	function morning_records_buddypress_importer_import($importer, $action) {
		if ( $action == 'import_buddypress' )
			$importer->response['result'] = $importer->import_dump('buddypress', esc_html__('BuddyPress', 'morning-records'));
	}
}

// Display import progress
if ( !function_exists( 'morning_records_buddypress_importer_import_fields' ) ) {
	//add_action( 'morning_records_action_importer_import_fields',	'morning_records_buddypress_importer_import_fields', 10, 1 );
	function morning_records_buddypress_importer_import_fields($importer) {
		?>
		<tr class="import_buddypress">
			<td class="import_progress_item"><?php esc_html_e('BuddyPress data', 'morning-records'); ?></td>
			<td class="import_progress_status"></td>
		</tr>
		<?php
	}
}

// Export posts
if ( !function_exists( 'morning_records_buddypress_importer_export' ) ) {
	//add_action( 'morning_records_action_importer_export',	'morning_records_buddypress_importer_export', 10, 1 );
	function morning_records_buddypress_importer_export($importer) {

		// BuddyPress tables
		$options = array(
			'bp_activity'			=> $importer->export_dump("bp_activity"),
            'bp_activity_meta'		=> $importer->export_dump("bp_activity_meta"),
            'bp_friends'			=> $importer->export_dump("bp_friends"),
            'bp_groups'				=> $importer->export_dump("bp_groups"),
            'bp_groups_groupmeta'	=> $importer->export_dump("bp_groups_groupmeta"),
            'bp_groups_members'		=> $importer->export_dump("bp_groups_members"),
            'bp_messages_messages'	=> $importer->export_dump("bp_messages_messages"),
            'bp_messages_meta'		=> $importer->export_dump("bp_messages_meta"),
            'bp_messages_notices'	=> $importer->export_dump("bp_messages_notices"),
            'bp_messages_recipients'=> $importer->export_dump("bp_messages_recipients"),
            'bp_user_blogs'			=> $importer->export_dump("bp_user_blogs"),
            'bp_user_blogs_blogmeta'=> $importer->export_dump("bp_user_blogs_blogmeta"),
            'bp_notifications'		=> $importer->export_dump("bp_notifications"),
            'bp_notifications_meta'	=> $importer->export_dump("bp_notifications_meta"),
            'bp_xprofile_data'		=> $importer->export_dump("bp_xprofile_data"),
            'bp_xprofile_fields'	=> $importer->export_dump("bp_xprofile_fields"),
            'bp_xprofile_groups'	=> $importer->export_dump("bp_xprofile_groups"),
            'bp_xprofile_meta'		=> $importer->export_dump("bp_xprofile_meta")
        );
		morning_records_storage_set('export_buddypress', serialize($options));
	}
}

// Display exported data in the fields
if ( !function_exists( 'morning_records_buddypress_importer_export_fields' ) ) {
	//add_action( 'morning_records_action_importer_export_fields',	'morning_records_buddypress_importer_export_fields', 10, 1 );
	function morning_records_buddypress_importer_export_fields($importer) {
		?>
		<tr>
			<th align="left"><?php esc_html_e('BuddyPress', 'morning-records'); ?></th>
			<td><?php morning_records_fpc(morning_records_get_file_dir('core/core.importer/export/buddypress.txt'), morning_records_storage_get('export_buddypress')); ?>
				<a download="buddypress.txt" href="<?php echo esc_url(morning_records_get_file_url('core/core.importer/export/buddypress.txt')); ?>"><?php esc_html_e('Download', 'morning-records'); ?></a>
			</td>
		</tr>
		<?php
	}
}
?>