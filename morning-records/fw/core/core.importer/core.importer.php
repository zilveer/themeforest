<?php
// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Theme init
if (!function_exists('morning_records_importer_theme_setup')) {
	add_action( 'morning_records_action_after_init_theme', 'morning_records_importer_theme_setup' );		// Fire this action after load theme options
	function morning_records_importer_theme_setup() {
		if (is_admin() && current_user_can('import') && morning_records_get_theme_option('admin_dummy_data')=='yes') {
			new morning_records_dummy_data_importer();
		}
	}
}

class morning_records_dummy_data_importer {

	// Theme specific settings
	var $options = array(
		'debug'					=> false,						// Enable debug output
		'demo_type'				=> 'default',								// Default dummy data type
		'files'					=> array(									// Dummy data files: path to the local file with demo content or URL from external (cloud) server)
																			// 																	MUST BE SET IN THE THEME!
			/* Demo structure example (for the one dummy data item):
			'default' 				=> array(
				'title'				=> esc_html__('Default demo', 'morning-records'),	// Installation title ('Light version', 'Portfolio style', etc.
				'file_with_posts'	=> 'demo/posts.txt',			// File with posts content
				'file_with_users'	=> 'demo/users.txt',			// File with users
				'file_with_mods'	=> 'demo/theme_mods.txt',		// File with theme mods
				'file_with_options'	=> 'demo/theme_options.txt',	// File with theme options
				'file_with_templates'=> 'demo/templates_options.txt',// File with templates options
				'file_with_widgets' => 'demo/widgets.txt',			// File with widgets data
				'file_with_revsliders' => array(
					'http://some.cloud.net/theme_name/revsliders/home_slider.zip',		// URL to the remote archive with first slider
					'http://some.cloud.net/theme_name/revsliders/home_slider_2.zip'		// URL to the remote archive with second slider (separate slider, not part of the previous item)
					'importer/demo/revsliders/home_slider.zip',							// or Local file with slider (included in the theme package)
				),
				'file_with_attachments' => array(							// Array with attachments
					'http://some.cloud.net/theme_name/uploads.zip',			// URL to the remote archive with attachments
					'http://some.cloud.net/theme_name/uploads.001',			// or URL to the remote part #1 of the archive
					'http://some.cloud.net/theme_name/uploads.002',			//    URL to the remote part #2 of the archive
					'importer/demo/uploads.zip',							// or Local file with attachments (included in the theme package)
				),
				'attachments_by_parts'	=> true,							// Files above are parts of single file - large media archive
																			// They are must be concatenated in one file before unpacking
				'domain_dev'			=> '',								// Domain on the developer's server 								MUST BE SET IN THE THEME!
				'domain_demo'			=> ''								// Domain on the demo-server										MUST BE SET IN THE THEME!
			)
			*/
		),
		'ignore_post_types'		=> array(						// Ignore specified post types when export posts and postmeta
			'revision'
		),
		'plugins_initial_state'	=> 0,							// The initial state of the plugin's checkboxes: 1 - checked, 0 - unchecked		MUST BE SET OR CHANGED IN THEME!
		'taxonomies'			=> array(),						// List of the required taxonomies: 'post_type' => 'taxonomy', ...				MUST BE SET OR CHANGED IN THEME!
		'additional_options'	=> array(						// Additional options slugs (for export plugins settings).						MUST BE SET OR CHANGED IN THEME!
			// WP
			'blogname',
			'blogdescription',
			'posts_per_page',
			'show_on_front',
			'page_on_front',
			'page_for_posts'
		)
	);

	var $error    = '';				// Error message
	var $result   = 0;				// Import posts percent (if break inside)
	
	var $action 	= '';			// Current AJAX action

	var $last_slider = 0;			// Last imported slider number. 															MUST BE SET OR CHANGED IN THEME!

	var $export_mods = '';
	var $export_options = '';
	var $export_templates = '';
	var $export_widgets = '';
	var $export_posts = '';
	var $export_users = '';

	var $uploads_url = '';
	var $uploads_dir = '';

	var $import_log = '';
	var $import_last_id = 0;
	
	var $start_time = 0;
	var $max_time = 0;

	var	$response = array(
			'action' => '',
			'error' => '',
			'result' => '100'
		);

	//-----------------------------------------------------------------------------------
	// Constuctor
	//-----------------------------------------------------------------------------------
	function __construct() {
		// Add menu item
		add_action('admin_menu', 					array($this, 'admin_menu_item'));
		// Add menu item
		add_action('admin_enqueue_scripts', 		array($this, 'admin_scripts'));
		// AJAX handler
		add_action('wp_ajax_morning_records_importer_start_import',		array($this, 'importer'));
		add_action('wp_ajax_nopriv_morning_records_importer_start_import',	array($this, 'importer'));
	}
	
	function prepare_vars() {
		// Detect current uploads folder and url
		$uploads_info = wp_upload_dir();
		$this->uploads_dir = $uploads_info['basedir'];
		$this->uploads_url = $uploads_info['baseurl'];
		// Filter importer options
	    $this->options = apply_filters('morning_records_filter_importer_options', $this->options);
		// Get allowed execution time
		$this->start_time = time();
		$this->max_time = round( 0.9 * max(30, ini_get('max_execution_time')));
		// Get data from log-file
		$this->import_log = morning_records_get_file_dir('core/core.importer/log.posts.txt');
		if (empty($this->import_log)) {
			$this->import_log = get_template_directory().'/fw/core/core.importer/log.posts.txt';
			if (!file_exists($this->import_log)) morning_records_fpc($this->import_log, '');
		}
		$log = explode('|', morning_records_fgc($this->import_log));
		$this->import_last_id = (int) $log[0];
		$this->result = empty($log[1]) ? 0 : (int) $log[1];
		$this->last_slider = empty($log[2]) ? '' : $log[2];
		// Type of demo data
		if (isset($_POST['demo_type']))
			$this->options['demo_type'] = $_POST['demo_type'];
	}

	//-----------------------------------------------------------------------------------
	// Admin Interface
	//-----------------------------------------------------------------------------------
	
	// Add menu item
	function admin_menu_item() {
		if ( current_user_can( 'manage_options' ) ) {
			// Add in admin menu 'Theme Options'
			morning_records_admin_add_menu_item('theme', array(
				'page_title' => esc_html__('Install Dummy Data', 'morning-records'),
				'menu_title' => esc_html__('Install Dummy Data', 'morning-records'),
				'capability' => 'manage_options',
				'menu_slug'  => 'trx_importer',
				'callback'   => array($this, 'build_page'),
				'icon'		 => ''
				)
			);
		}
	}
	
	// Add script
	function admin_scripts() {
		morning_records_enqueue_style(  'morning_records-importer-style',  morning_records_get_file_url('core/core.importer/core.importer.css'), array(), null );
		morning_records_enqueue_script( 'morning_records-importer-script', morning_records_get_file_url('core/core.importer/core.importer.js'), array('jquery'), null, true );	
	}
	
	
	//-----------------------------------------------------------------------------------
	// Build the Main Page
	//-----------------------------------------------------------------------------------
	function build_page() {
		$this->prepare_vars();
		
		// Export data
		if ( isset($_POST['exporter_action']) ) {
			if ( !wp_verify_nonce( morning_records_get_value_gp('nonce'), admin_url() ) )
				$this->error = esc_html__('Incorrect WP-nonce data! Operation canceled!', 'morning-records');
						
			else
				$this->exporter();
		}
		?>

		<div class="trx_importer">
			<div class="trx_importer_section">
				<h2 class="trx_title"><?php esc_html_e('ThemeREX Importer', 'morning-records'); ?></h2>
				<p><b><?php esc_html_e('Attention! Important info:', 'morning-records'); ?></b></p>
				<ol>
					<li><?php esc_html_e('Data import will replace all existing content - so you get a complete copy of our demo site', 'morning-records'); ?></li>
					<li><?php esc_html_e('Data import can take a long time (sometimes more than 10 minutes) - please wait until the end of the procedure, do not navigate away from the page.', 'morning-records'); ?></li>
					<li><?php esc_html_e('Web-servers set the time limit for the execution of php-scripts. Therefore, the import process will be split into parts. Upon completion of each part - the import will resume automatically!', 'morning-records'); ?></li>
				</ol>

				<form id="trx_importer_form">

					<?php if (count($this->options['files']) > 1) { ?>
						<p><br><b><?php esc_html_e('Select the demo-data set to be imported:', 'morning-records'); ?></b></p>
		
						<p>
							<?php
							$checked = 'checked="checked"';
							foreach ($this->options['files'] as $k=>$v) {
								?><label><input type="radio"<?php if ($this->options['demo_type']==$k) echo ' checked="checked"'; ?> value="<?php echo esc_attr($k); ?>" name="demo_type" /><?php echo esc_html($v['title']); ?></label><br><?php
							}
							?>
						</p>
					<?php } ?>

					<p><br><b><?php esc_html_e('Select the elements to be imported:', 'morning-records'); ?></b></p>

					<p>
						<input type="checkbox" checked="checked" value="1" name="import_posts" id="import_posts" /> <label for="import_posts"><?php esc_html_e('Import posts', 'morning-records'); ?></label><br><br>
						<input type="checkbox" checked="checked" value="1" name="import_attachments" id="import_attachments" /> <label for="import_attachments"><?php esc_html_e('Import media', 'morning-records'); ?></label><br><br>
						<input type="checkbox" checked="checked" value="1" name="import_tm" id="import_tm" /> <label for="import_tm"><?php esc_html_e('Import Theme Mods', 'morning-records'); ?></label><br>
						<input type="checkbox" checked="checked" value="1" name="import_to" id="import_to" /> <label for="import_to"><?php esc_html_e('Import Theme Options', 'morning-records'); ?></label><br>
						<input type="checkbox" checked="checked" value="1" name="import_tpl" id="import_tpl" /> <label for="import_tpl"><?php esc_html_e('Import Templates Options', 'morning-records'); ?></label><br>
						<input type="checkbox" checked="checked" value="1" name="import_widgets" id="import_widgets" /> <label for="import_widgets"><?php esc_html_e('Import Widgets', 'morning-records'); ?></label><br><br>
	
						<?php do_action('morning_records_action_importer_params', $this); ?>
					</p>

					<div class="trx_buttons">
						<?php if ($this->import_last_id > 0 || !empty($this->last_slider)) { ?>
							<h4 class="trx_importer_complete"><?php sprintf(esc_html__('Import posts completed by %s', 'morning-records'), $this->result.'%'); ?></h4>
							<input type="button" value="<?php
								if ($this->import_last_id > 0)
									printf(esc_html__('Continue import (from ID=%s)', 'morning-records'), $this->import_last_id);
								else
									esc_html_e('Continue import sliders', 'morning-records');
								?>" 
								data-last_id="<?php echo esc_attr($this->import_last_id); ?>" 
								data-last_slider="<?php echo esc_attr($this->last_slider); ?>"
								>
							<input type="button" value="<?php esc_attr_e('Start import again', 'morning-records'); ?>">
						<?php } else { ?>
							<input type="button" value="<?php esc_attr_e('Start import', 'morning-records'); ?>">
						<?php } ?>
					</div>
				</form>
				
				<div id="trx_importer_progress" class="notice notice-info style_<?php echo esc_attr(morning_records_get_theme_setting('admin_dummy_style')); ?>">
					<h4 class="trx_importer_progress_title"><?php esc_html_e('Import demo data', 'morning-records'); ?></h4>
					<table border="0" cellpadding="4">
					<tr class="import_posts">
						<td class="import_progress_item"><?php esc_html_e('Posts', 'morning-records'); ?></td>
						<td class="import_progress_status"></td>
					</tr>
					<tr class="import_attachments">
						<td class="import_progress_item"><?php esc_html_e('Media', 'morning-records'); ?></td>
						<td class="import_progress_status"></td>
					</tr>
					<tr class="import_tm">
						<td class="import_progress_item"><?php esc_html_e('Theme Mods', 'morning-records'); ?></td>
						<td class="import_progress_status"></td>
					</tr>
					<tr class="import_to">
						<td class="import_progress_item"><?php esc_html_e('Theme Options', 'morning-records'); ?></td>
						<td class="import_progress_status"></td>
					</tr>
					<tr class="import_tpl">
						<td class="import_progress_item"><?php esc_html_e('Templates Options', 'morning-records'); ?></td>
						<td class="import_progress_status"></td>
					</tr>
					<tr class="import_widgets">
						<td class="import_progress_item"><?php esc_html_e('Widgets', 'morning-records'); ?></td>
						<td class="import_progress_status"></td>
					</tr>
					<?php do_action('morning_records_action_importer_import_fields', $this); ?>
					</table>
					<h4 class="trx_importer_progress_complete"><?php esc_html_e('Congratulations! Data import complete!', 'morning-records'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('View site', 'morning-records'); ?></a></h4>
				</div>
				
			</div>

			<div class="trx_exporter_section">
				<h2 class="trx_title"><?php esc_html_e('ThemeREX Exporter', 'morning-records'); ?></h2>
				<?php 
				if ($this->error) {
					?><div class="trx_exporter_error notice notice-error"><?php echo trim($this->error); ?></div><?php
				}
				?>
				<form id="trx_exporter_form" action="#" method="post">

					<input type="hidden" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" name="nonce" />
					<input type="hidden" value="all" name="exporter_action" />

					<div class="trx_buttons">
						<?php 
						if ($this->export_options!='') { 
							?>
							<table border="0" cellpadding="6">
							<tr>
								<th align="left"><?php esc_html_e('Users', 'morning-records'); ?></th>
								<td><?php morning_records_fpc(morning_records_get_file_dir('core/core.importer/export/users.txt'), $this->export_users); ?>
									<a download="users.txt" href="<?php echo esc_url(morning_records_get_file_url('core/core.importer/export/users.txt')); ?>"><?php esc_html_e('Download', 'morning-records'); ?></a>
								</td>
							</tr>
							<tr>
								<th align="left"><?php esc_html_e('Posts', 'morning-records'); ?></th>
								<td><?php morning_records_fpc(morning_records_get_file_dir('core/core.importer/export/posts.txt'), $this->export_posts); ?>
									<a download="posts.txt" href="<?php echo esc_url(morning_records_get_file_url('core/core.importer/export/posts.txt')); ?>"><?php esc_html_e('Download', 'morning-records'); ?></a>
								</td>
							</tr>
							<tr>
								<th align="left"><?php esc_html_e('Theme Mods', 'morning-records'); ?></th>
								<td><?php morning_records_fpc(morning_records_get_file_dir('core/core.importer/export/theme_mods.txt'), $this->export_mods); ?>
									<a download="theme_mods.txt" href="<?php echo esc_url(morning_records_get_file_url('core/core.importer/export/theme_mods.txt')); ?>"><?php esc_html_e('Download', 'morning-records'); ?></a>
								</td>
							</tr>
							<tr>
								<th align="left"><?php esc_html_e('Theme Options', 'morning-records'); ?></th>
								<td><?php morning_records_fpc(morning_records_get_file_dir('core/core.importer/export/theme_options.txt'), $this->export_options); ?>
									<a download="theme_options.txt" href="<?php echo esc_url(morning_records_get_file_url('core/core.importer/export/theme_options.txt')); ?>"><?php esc_html_e('Download', 'morning-records'); ?></a>
								</td>
							</tr>
							<tr>
								<th align="left"><?php esc_html_e('Templates Options', 'morning-records'); ?></th>
								<td><?php morning_records_fpc(morning_records_get_file_dir('core/core.importer/export/templates_options.txt'), $this->export_templates); ?>
									<a download="templates_options.txt" href="<?php echo esc_url(morning_records_get_file_url('core/core.importer/export/templates_options.txt')); ?>"><?php esc_html_e('Download', 'morning-records'); ?></a>
								</td>
							</tr>
							<tr>
								<th align="left"><?php esc_html_e('Widgets', 'morning-records'); ?></th>
								<td><?php morning_records_fpc(morning_records_get_file_dir('core/core.importer/export/widgets.txt'), $this->export_widgets); ?>
									<a download="widgets.txt" href="<?php echo esc_url(morning_records_get_file_url('core/core.importer/export/widgets.txt')); ?>"><?php esc_html_e('Download', 'morning-records'); ?></a>
								</td>
							</tr>
							
							<?php do_action('morning_records_action_importer_export_fields', $this); ?>

							</table>

							<?php

						} else {

							if (count($this->options['files']) > 1) {

								?><p><?php esc_html_e('Demo type', 'morning-records'); ?><br><?php

								$checked = 'checked="checked"';
								foreach ($this->options['files'] as $k=>$v) {
									if (!empty($v['file_with_posts'])) {
										?>
										<label><input type="radio"<?php if ($this->options['demo_type']==$k) echo ' checked="checked"'; ?> value="<?php echo esc_attr($k); ?>" name="demo_type" /><?php echo esc_html($v['title']); ?></label><br>
										<?php
									}
								}
								?></p><?php
							}
							
							?><input type="submit" value="<?php esc_attr_e('Export Demo Data', 'morning-records'); ?>"><?php
						}
						?>

					</div>
				</form>
			</div>
		</div>
		<?php
	}

	// Check for required plugings
	function check_required_plugins($list='') {
		$not_installed = '';
		if (in_array('trx_utils', morning_records_storage_get('required_plugins')) && !defined('TRX_UTILS_VERSION') )
			$not_installed .= 'Morning records Utilities';
		$not_installed = apply_filters('morning_records_filter_importer_required_plugins', $not_installed, $list);
		if ($not_installed) {
			$this->error = '<b>'.esc_html__('Attention! For correct installation of the selected demo data, you must install and activate the following plugins: ', 'morning-records').'</b><br>'.($not_installed);
			return false;
		}
		return true;
	}
	
	
	//-----------------------------------------------------------------------------------
	// Export dummy data
	//-----------------------------------------------------------------------------------
	function exporter() {
		global $wpdb;
		$suppress = $wpdb->suppress_errors();

		// Export theme mods
		$this->export_mods = serialize($this->prepare_data(get_theme_mods()));

		// Export theme, templates and categories options and VC templates
		$rows = $wpdb->get_results( "SELECT option_name, option_value FROM " . esc_sql($wpdb->options) . " WHERE option_name LIKE '" . esc_sql(morning_records_storage_get('options_prefix')) . "_options%'" );
		$options = array();
		if (is_array($rows) && count($rows) > 0) {
			foreach ($rows as $row) {
				$options[$row->option_name] = morning_records_unserialize($row->option_value);
			}
		}
		// Export additional options
		if (is_array($this->options['additional_options']) && count($this->options['additional_options']) > 0) {
			foreach ($this->options['additional_options'] as $opt) {
				$rows = $wpdb->get_results( "SELECT option_name, option_value FROM " . esc_sql($wpdb->options) . " WHERE option_name LIKE '" . esc_sql($opt) . "'" );
				if (is_array($rows) && count($rows) > 0) {
					foreach ($rows as $row) {
						$options[$row->option_name] = morning_records_unserialize($row->option_value);
					}
				}
			}
		}
		$this->export_options = serialize($this->prepare_data($options));

		// Export templates options
		$rows = $wpdb->get_results( "SELECT option_name, option_value FROM " . esc_sql($wpdb->options) . " WHERE option_name LIKE '".esc_sql(morning_records_storage_get('options_prefix'))."_options_template_%'" );
		$options = array();
		if (is_array($rows) && count($rows) > 0) {
			foreach ($rows as $row) {
				$options[$row->option_name] = morning_records_unserialize($row->option_value);
			}
		}
		$this->export_templates = serialize($this->prepare_data($options));

		// Export widgets
		$rows = $wpdb->get_results( "SELECT option_name, option_value FROM " . esc_sql($wpdb->options) . " WHERE option_name = 'sidebars_widgets' OR option_name LIKE 'widget_%'" );
		$options = array();
		if (is_array($rows) && count($rows) > 0) {
			foreach ($rows as $row) {
				$options[$row->option_name] = morning_records_unserialize($row->option_value);
			}
		}
		$this->export_widgets = serialize($this->prepare_data($options));

		// Export posts
		$this->export_posts = serialize(array(
			"posts"					=> $this->export_dump("posts"),
			"postmeta"				=> $this->export_dump("postmeta"),
			"comments"				=> $this->export_dump("comments"),
			"commentmeta"			=> $this->export_dump("commentmeta"),
			"terms"					=> $this->export_dump("terms"),
			"term_taxonomy"			=> $this->export_dump("term_taxonomy"),
			"term_relationships"	=> $this->export_dump("term_relationships")
			)
        );
		
		// Expost WP Users
		$users = array();
		$rows = $this->export_dump("users");
		if (is_array($rows) && count($rows)>0) {
			foreach ($rows as $k=>$v) {
				$rows[$k]['user_login']	= $rows[$k]['user_nicename'] = 'user'.$v['ID'];
				$rows[$k]['user_pass']		= '';
				$rows[$k]['display_name']	= sprintf(esc_html__('User %d', 'morning-records'), $v['ID']);
				$rows[$k]['user_email']	= 'user'.$v['ID'].'@user-mail.net';
			}
		}
		$users['users'] = $rows;
		$rows = $this->export_dump("usermeta");
		if (is_array($rows) && count($rows)>0) {
			foreach ($rows as $k=>$v) {
				if      ($v['meta_key'] == 'nickname')				$rows[$k]['meta_value'] = 'user'.$v['user_id'];
				else if ($v['meta_key'] == 'first_name')			$rows[$k]['meta_value'] = sprintf(esc_html__('FName%d', 'morning-records'), $v['user_id']);
				else if ($v['meta_key'] == 'last_name')				$rows[$k]['meta_value'] = sprintf(esc_html__('LName%d', 'morning-records'), $v['user_id']);
				else if ($v['meta_key'] == 'billing_first_name')	$rows[$k]['meta_value'] = sprintf(esc_html__('FName%d', 'morning-records'), $v['user_id']);
				else if ($v['meta_key'] == 'billing_last_name')		$rows[$k]['meta_value'] = sprintf(esc_html__('LName%d', 'morning-records'), $v['user_id']);
				else if ($v['meta_key'] == 'billing_email')			$rows[$k]['meta_value'] = 'user'.$v['user_id'].'@user-mail.net';
			}
		}
		$users['usermeta'] = $rows;
		$this->export_users = serialize($users);

		// Export Theme specific post types
		do_action('morning_records_action_importer_export', $this);

		$wpdb->suppress_errors( $suppress );
	}
	
	
	//-----------------------------------------------------------------------------------
	// Export specified table
	//-----------------------------------------------------------------------------------
	function export_dump($table) {
		global $wpdb;
		$rows = array();
		if ( count($wpdb->get_results( "SHOW TABLES LIKE '".esc_sql($wpdb->prefix . $table)."'", ARRAY_A )) == 1 ) {
			$where = '';
			if (count($this->options['ignore_post_types'])>0) {
				if ($table=='posts') {
					$where = " WHERE t.post_type NOT IN ('" . join("','", array_map("esc_sql", $this->options['ignore_post_types'])) . "')";
				}
			}
			// Attention! All parts of $where clause processed with esc_sql() in the condition above
			$query = "SELECT t.* FROM " . esc_sql($wpdb->prefix.$table) . " AS t" . $where;
			$rows = $this->prepare_data( $wpdb->get_results( $query, ARRAY_A ) );
			if ($this->options['debug']) dfl(sprintf(__("Export %d rows from table '%s'. Used query: %s", 'morning-records'), count($rows), $table, $query));
		}
		return $rows;
	}
	
	
	//-----------------------------------------------------------------------------------
	// Import dummy data
	//-----------------------------------------------------------------------------------
	//add_action('wp_ajax_morning_records_importer_start_import',			array($this, 'importer'));
	//add_action('wp_ajax_nopriv_morning_records_importer_start_import',	array($this, 'importer'));
	function importer() {

		if ($this->options['debug']) dfl(__('AJAX handler for importer', 'morning-records'));

		if ( !isset($_POST['importer_action']) || !wp_verify_nonce( morning_records_get_value_gp('ajax_nonce'), admin_url('admin-ajax.php') ) )
			die();
		
		$this->prepare_vars();

		$this->action = $this->response['action'] = $_POST['importer_action'];

		if ($this->options['debug']) dfl( sprintf(__('Dispatch action: %s', 'morning-records'), $this->action) );
		
		global $wpdb;
		$suppress = $wpdb->suppress_errors();

		ob_start();

		// Change max_execution_time (if allowed by server)
		$admin_tm = max(0, min(1800, (int) morning_records_get_theme_option('admin_dummy_timeout')));
		$tm = max(30, (int) ini_get('max_execution_time'));
		if ($tm < $admin_tm) {
			@set_time_limit($admin_tm);
			$this->max_time = round( 0.9 * max(30, ini_get('max_execution_time')));
		}

		// Start import - clear tables, etc.
		if ($this->action == 'import_start') {
			if (!$this->check_required_plugins($_POST['clear_tables']))
				$this->response['error'] = $this->error;
			else
				if (!empty($_POST['clear_tables'])) $this->clear_tables();

		// Import posts and users
		} else if ($this->action == 'import_posts') {
			if (($this->response['result'] = $this->import_posts()) >= 100 && ($this->response['result'] = $this->import_users()) >= 100)
				do_action('morning_records_action_importer_after_import_posts', $this);

		// Import attachments
		} else if ($this->action == 'import_attachments') {
			$this->response['result'] = $this->import_attachments();

		// Import Theme Mods
		} else if ($this->action == 'import_tm') {
			$this->response['result'] = $this->import_theme_mods();

		// Import Theme Options
		} else if ($this->action == 'import_to') {
			$this->response['result'] = $this->import_theme_options();

		// Import Templates Options
		} else if ($this->action == 'import_tpl') {
			$this->response['result'] = $this->import_templates_options();

		// Import Widgets
		} else if ($this->action == 'import_widgets') {
			$this->response['result'] = $this->import_widgets();

		// End import - clear cache, flush rules, etc.
		} else if ($this->action == 'import_end') {
			morning_records_clear_cache('all');
			flush_rewrite_rules();

		// Import Theme specific posts
		} else {
			do_action('morning_records_action_importer_import', $this, $this->action);
		}

		ob_end_clean();

		$wpdb->suppress_errors($suppress);

		if ($this->options['debug']) dfl( sprintf(__("AJAX handler finished - send results to client: %s", 'morning-records'), json_encode($this->response)) );

		echo json_encode($this->response);
		die();
	}
	
	
	// Delete all data from tables
	function clear_tables() {
		global $wpdb;
		if (morning_records_strpos($_POST['clear_tables'], 'posts')!==false && $this->import_last_id==0) {
			if ($this->options['debug']) dfl( __('Clear posts tables', 'morning-records') );
			$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->posts));
			if ( is_wp_error( $res ) ) dfl( __( 'Failed truncate table "posts".', 'morning-records' ) . ' ' . ($res->get_error_message()) );
			$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->postmeta));
			if ( is_wp_error( $res ) ) dfl( __( 'Failed truncate table "postmeta".', 'morning-records' ) . ' ' . ($res->get_error_message()) );
			$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->comments));
			if ( is_wp_error( $res ) ) dfl( __( 'Failed truncate table "comments".', 'morning-records' ) . ' ' . ($res->get_error_message()) );
			$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->commentmeta));
			if ( is_wp_error( $res ) ) dfl( __( 'Failed truncate table "commentmeta".', 'morning-records' ) . ' ' . ($res->get_error_message()) );
			$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->terms));
			if ( is_wp_error( $res ) ) dfl( __( 'Failed truncate table "terms".', 'morning-records' ) . ' ' . ($res->get_error_message()) );
			$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->term_relationships));
			if ( is_wp_error( $res ) ) dfl( __( 'Failed truncate table "term_relationships".', 'morning-records' ) . ' ' . ($res->get_error_message()) );
			$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->term_taxonomy));
			if ( is_wp_error( $res ) ) dfl( __( 'Failed truncate table "term_taxonomy".', 'morning-records' ) . ' ' . ($res->get_error_message()) );
		}
		do_action('morning_records_action_importer_clear_tables', $this, $_POST['clear_tables']);
	}


	// Import users
	function import_users() {
		if ($this->options['debug']) 
			dfl(__('Import users', 'morning-records'));
		return $this->import_dump('users', esc_html__('Users', 'morning-records'));
	}

	// Import posts, terms and comments
	function import_posts() {
		if ($this->options['debug']) 
			dfl((int) $_POST['last_id'] > 0 ? sprintf(__('Continue import posts from ID=%d', 'morning-records'), (int) $_POST['last_id']) : __('Import posts, terms and comments', 'morning-records'));
		$result = $this->import_dump('posts', esc_html__('Posts', 'morning-records'));
		if ($result>=100) morning_records_fpc($this->import_log, '');
		return $result;
	}

	// Import attachments
	function import_attachments() {
		$result = 100;
		if ($this->options['debug']) 
			dfl(__('Import media (attachments)', 'morning-records'));
		if (empty($this->options['files'][$this->options['demo_type']]['file_with_attachments'])) return;
		// Get log
		$log = morning_records_get_file_dir('core/core.importer/log.media.txt');
		if (empty($log)) {
			$log = get_template_directory().'/fw/core/core.importer/log.media.txt';
			if (!file_exists($log)) morning_records_fpc($log, '');
		}
		$last_arh = morning_records_fgc($log);
		// Process files
		$files = $this->options['files'][$this->options['demo_type']]['file_with_attachments'];
		if (!is_array($files)) $files = array($files);
		$counter = 0;
		foreach ($files as $file) {
			$counter++;
			if (!empty($last_arh)) {
				if ($file==$last_arh)
					$last_arh = '';
				continue;
			}
			$need_del = false;
			$need_extract = true;
			$need_exit = false;		// Break process when critical error is appear
			$zip = $file;
			$attempt = !empty($_POST['attempt']) ? (int) $_POST['attempt']+1 : 1;
			if ($this->options['debug']) 
				dfl(sprintf(__('Start load file: %s. Attempt %d.', 'morning-records'), $file, $attempt));
			// Download remote file
			if (morning_records_substr($zip, 0, 5)=='http:' || morning_records_substr($zip, 0, 6)=='https:') {
				if (!$this->options['files'][$this->options['demo_type']]['attachments_by_parts']) {
					// Method 1: WP download_url() load single file into system temp folder
					$response = download_url($zip, $this->max_time);
					if (is_string($response)) {
						$zip = $response;
						$need_del = true;
						unset($this->response['attempt']);
					} else {
						if ($attempt < 3) {
							$this->response['attempt'] = $attempt;
							if ($this->options['debug']) {
								$error_log = sprintf(__("Error download remote archive with media '%s'. Attempt %d.", 'morning-records'), $zip, $attempt);
								dfl($error_log);
							}
							$result = round(max(0, $counter-1) / count($files) * 100);
						} else {
							unset($this->response['attempt']);
							$this->response['error'] = sprintf(__("Error download remote archive with media '%s'.", 'morning-records'), $zip)
														. " \n" . __("Please, try again!", 'morning-records');
							if ($this->options['debug']) 
								dfl($this->response['error']);
							$result = 100;
						}
						$need_exit = true;
						$need_extract = false;
						$zip = '';
					}
				} else {
					// Method 2: Load file in the memory and save it into WP uploads dir - used to load many parts of file
					$response = wp_remote_get($zip, array(
									'timeout'     => $this->max_time,
									'redirection' => $this->max_time
									)
								);
					if (is_array($response) && isset($response['response']['code']) && $response['response']['code']==200) {
						$zip = $this->uploads_dir.'/import_media.tmp';
						morning_records_fpc($zip, $response['body'], $file==$files[0] ? 0 : FILE_APPEND);
						$need_extract = ($counter == count($files));
						$need_del = $need_extract;
						unset($this->response['attempt']);
						if ($this->options['debug']) 
							dfl(sprintf(__("Download %d part of archive '%s'", 'morning-records'), $counter, $file));
					} else {
						if ($attempt < 3) {
							$this->response['attempt'] = $attempt;
							if ($this->options['debug']) {
								$error_log = sprintf(__("Error download next part of remote archive with media '%s'. Attempt %d.", 'morning-records'), $zip, $attempt);
								dfl($error_log);
							}
							$result = round(max(0, $counter-1) / count($files) * 100);
						} else {
							unset($this->response['attempt']);
							$this->response['error'] = sprintf(__("Error download next part of remote archive with media '%s'.", 'morning-records'), $zip)
													. " \n" . __("Please, try again!", 'morning-records');
							if ($this->options['debug']) 
								dfl($this->response['error']);
							$result = 100;
						}
						$need_exit = true;
						$need_extract = false;
						$zip = '';
					}
				}
			} else {
				// Archive packed with theme
				$zip = morning_records_get_file_dir($zip);
			}
			// Unrecoverable error is appear
			if ($need_exit) break;
			// Unzip file
			if ($need_extract) {
				if (!empty($zip) && file_exists($zip)) {
					if ($this->options['debug']) 
						dfl(sprintf(__('Extract zip-file "%s"', 'morning-records'), $zip));
					WP_Filesystem();
					$rez = unzip_file($zip, $this->uploads_dir);
					if (is_wp_error($rez)) {
						if ($this->options['debug']) 
							dfl(sprintf(__('Error when unzip file "%s": %s', 'morning-records'), $zip, $res->get_error_message()));
					}
					if ($need_del) unlink($zip);
				} else {
					if ($this->options['debug']) 
						dfl(sprintf(__('File "%s" not found', 'morning-records'), $zip));
				}
			}
			// Save to log last processed file
			morning_records_fpc($log, $file);
			// Check time
			$result = $counter < count($files) ? round($counter / count($files) * 100) : 100;
			if ($this->options['debug']) 
					dfl(sprintf( __('File %s imported. Current import progress: %s. Time limit: %s sec. Elapsed time: %s sec.', 'morning-records'), $file, $result.'%', $this->max_time, time() - $this->start_time));
			// Break import after timeout or if attachments loading from parts - to show percent loading after each part
			//if (time() - $this->start_time >= $this->max_time)
				break;
		}
		// Clear log with last processed file
		if ($result>=100)
			morning_records_fpc($log, '');
		return $result;
	}

	// Import theme mods
	function import_theme_mods() {
		$result = 100;
		if (empty($this->options['files'][$this->options['demo_type']]['file_with_mods'])) return $result;
		$attempt = !empty($_POST['attempt']) ? (int) $_POST['attempt']+1 : 1;
		if ($this->options['debug']) 
			dfl(sprintf(__('Import Theme Mods. Attempt %d.', 'morning-records'), $attempt));
		$txt = morning_records_get_local_or_remote_file($this->options['files'][$this->options['demo_type']]['file_with_mods']);
		if (empty($txt)) {
			if ($attempt < 3) {
				$this->response['attempt'] = $attempt;
				if ($this->options['debug']) {
					$error_log = sprintf(__("Error load data from the file '%s'. Attempt %d.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_mods'], $attempt);
					dfl($error_log);
				}
				$result = 0;
			} else {
				unset($this->response['attempt']);
				$this->response['error'] = sprintf(__("Error load data from the file '%s'.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_mods'])
											. " \n" . __("Please, try again!", 'morning-records');
				if ($this->options['debug']) 
					dfl($this->response['error']);
			}
			return $result;
		}
		unset($this->response['attempt']);
		$data = morning_records_unserialize($txt);
		// Replace upload url in options
		if (is_array($data) && count($data) > 0) {
			foreach ($data as $k=>$v) {
				$data[$k] = $this->replace_uploads($v);
			}
			$theme = get_option( 'stylesheet' );
			update_option( "theme_mods_$theme", $data );
		} else {
			if ($this->options['debug'])
				dfl(sprintf(__('Error unserialize data from the file %s', 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_mods']));
		}
		return $result;
	}


	// Import theme options
	function import_theme_options() {
		$result = 100;
		if (empty($this->options['files'][$this->options['demo_type']]['file_with_options'])) return $result;
		$attempt = !empty($_POST['attempt']) ? (int) $_POST['attempt']+1 : 1;
		if ($this->options['debug']) 
			dfl(sprintf(__('Import Theme Options. Attempt %d.', 'morning-records'), $attempt));
		//if ($this->options['debug']) dfl(__('Reset Theme Options', 'morning-records'));
		//morning_records_options_reset();
		$txt = morning_records_get_local_or_remote_file($this->options['files'][$this->options['demo_type']]['file_with_options']);
		if (empty($txt)) {
			if ($attempt < 3) {
				$this->response['attempt'] = $attempt;
				if ($this->options['debug']) {
					$error_log = sprintf(__("Error load data from the file '%s'. Attempt %d.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_options'], $attempt);
					dfl($error_log);
				}
				$result = 0;
			} else {
				unset($this->response['attempt']);
				$this->response['error'] = sprintf(__("Error load data from the file '%s'.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_options'])
											. " \n" . __("Please, try again!", 'morning-records');
				if ($this->options['debug']) 
					dfl($this->response['error']);
			}
			return $result;
		}
		unset($this->response['attempt']);
		$data = morning_records_unserialize($txt);
		// Replace upload url in options
		if (is_array($data) && count($data) > 0) {
			foreach ($data as $k=>$v) {
				$v = $this->replace_uploads($v);
				if ($k == 'mega_main_menu_options' && isset($v['last_modified']))
					$v['last_modified'] = time()+30;
				update_option( $k, $v );
			}
		} else {
			if ($this->options['debug'])
				dfl(sprintf(__('Error unserialize data from the file %s', 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_options']));
		}
		morning_records_load_main_options();
		return $result;
	}


	// Import templates options
	function import_templates_options() {
		$result = 100;
		if (empty($this->options['files'][$this->options['demo_type']]['file_with_templates'])) return $result;
		$attempt = !empty($_POST['attempt']) ? (int) $_POST['attempt']+1 : 1;
		if ($this->options['debug']) 
			dfl(sprintf(__('Import Templates Options. Attempt %d.', 'morning-records'), $attempt));
		$txt = morning_records_get_local_or_remote_file($this->options['files'][$this->options['demo_type']]['file_with_templates']);
		if (empty($txt)) {
			if ($attempt < 3) {
				$this->response['attempt'] = $attempt;
				if ($this->options['debug']) {
					$error_log = sprintf(__("Error load data from the file '%s'. Attempt %d.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_templates'], $attempt);
					dfl($error_log);
				}
				$result = 0;
			} else {
				unset($this->response['attempt']);
				$this->response['error'] = sprintf(__("Error load data from the file '%s'.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_templates'])
											. " \n" . __("Please, try again!", 'morning-records');
				if ($this->options['debug']) 
					dfl($this->response['error']);
			}
			return $result;
		}
		unset($this->response['attempt']);
		$data = morning_records_unserialize($txt);
		// Replace upload url in options
		if (is_array($data) && count($data) > 0) {
			foreach ($data as $k=>$v) {
				update_option( $k, $this->replace_uploads($v) );
			}
		} else {
			if ($this->options['debug'])
				dfl(sprintf(__('Error unserialize data from the file %s', 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_templates']));
		}
		return $result;
	}


	// Import widgets
	function import_widgets() {
		$result = 100;
		if (empty($this->options['files'][$this->options['demo_type']]['file_with_widgets'])) return $result;
		$attempt = !empty($_POST['attempt']) ? (int) $_POST['attempt']+1 : 1;
		if ($this->options['debug']) 
			dfl(sprintf(__('Import Widgets. Attempt %d.', 'morning-records'), $attempt));
		$txt = morning_records_get_local_or_remote_file($this->options['files'][$this->options['demo_type']]['file_with_widgets']);
		if (empty($txt)) {
			if ($attempt < 3) {
				$this->response['attempt'] = $attempt;
				if ($this->options['debug']) {
					$error_log = sprintf(__("Error load data from the file '%s'. Attempt %d.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_widgets'], $attempt);
					dfl($error_log);
				}
				$result = 0;
			} else {
				unset($this->response['attempt']);
				$this->response['error'] = sprintf(__("Error load data from the file '%s'.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_widgets'])
											. " \n" . __("Please, try again!", 'morning-records');
				if ($this->options['debug']) 
					dfl($this->response['error']);
			}
			return $result;
		}
		unset($this->response['attempt']);
		$data = morning_records_unserialize($txt);
		if (is_array($data) && count($data) > 0) {
			foreach ($data as $k=>$v) {
				update_option( $k, $this->replace_uploads($v) );
			}
		} else {
			if ($this->options['debug'])
				dfl(sprintf(__('Error unserialize data from the file %s', 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_widgets']));
		}
		return $result;
	}


	// Import any SQL dump
	function import_dump($slug, $title) {
		$result = 100;
		if (empty($this->options['files'][$this->options['demo_type']]['file_with_'.trim($slug)])) return $result;
		$attempt = !empty($_POST['attempt']) ? (int) $_POST['attempt']+1 : 1;
		if ($this->options['debug']) 
			dfl(sprintf(__('Import dump of "%s". Attempt %d.', 'morning-records'), $title, $attempt));
		$txt = morning_records_get_local_or_remote_file($this->options['files'][$this->options['demo_type']]['file_with_'.trim($slug)]);
		if (empty($txt)) {
			if ($attempt < 3) {
				$this->response['attempt'] = $attempt;
				if ($this->options['debug']) {
					$error_log = sprintf(__("Error load data from the file '%s'. Attempt %d.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_'.trim($slug)], $attempt);
					dfl($error_log);
				}
				$result = 0;
			} else {
				unset($this->response['attempt']);
				$this->response['error'] = sprintf(__("Error load data from the file '%s'.", 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_'.trim($slug)])
											. " \n" . __("Please, try again!", 'morning-records');
				if ($this->options['debug']) 
					dfl($this->response['error']);
			}
			return $result;
		}
		unset($this->response['attempt']);
		$data = morning_records_unserialize($txt);
		if (is_array($data) && count($data) > 0) {
			global $wpdb;
			foreach ($data as $table=>$rows) {
				if ($this->options['debug']) dfl(sprintf(__('Process table "%s"', 'morning-records'), $table));
				// Clear table, if it is not 'users' or 'usermeta' amd not any posts, terms or comments table
				if (!in_array($table, array('users', 'usermeta')) && $this->action!='import_posts')
					$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->prefix . $table));
				$values = $fields = '';
				$break = false;
				if (is_array($rows) && ($posts_all=count($rows)) > 0) {
					$posts_counter = $posts_imported = 0;
					$start_from_id = (int) $_POST['last_id'] > 0 ? $this->import_last_id : 0;
					foreach ($rows as $row) {
						$posts_counter++;
						if ($table=='posts' && !empty($row['ID']) && $row['ID'] <= $start_from_id) continue;
						// Replace demo URL to current site URL
						$row = morning_records_replace_site_url($row, $this->options['files'][$this->options['demo_type']]['domain_demo']);
						$f = '';
						$v = '';
						if (is_array($row) && count($row) > 0) {
							foreach ($row as $field => $value) {
								$f .= ($f ? ',' : '') . "'" . esc_sql($field) . "'";
								$v .= ($v ? ',' : '') . "'" . esc_sql($value) . "'";
							}
						}
						if ($fields == '') $fields = '(' . $f . ')';
						$values .= ($values ? ',' : '') . '(' . $v . ')';
						// If query length exceed 64K - run query, because MySQL not accept long query string
						// If current table 'users' or 'usermeta' - run queries row by row, because we append data
						if (morning_records_strlen($values) > 64000 || in_array($table, array('users', 'usermeta'))) {
							// Attention! All items in the variable $values escaped on the loop above - esc_sql($value)
							$q = "INSERT INTO ".esc_sql($wpdb->prefix . $table)." VALUES {$values}";
							$wpdb->query($q);
							$values = $fields = '';
						}
						
						// Save into log last
						if ($table=='posts') {
							$result = $posts_counter < $posts_all ? round($posts_counter / $posts_all * 100) : 100;
							morning_records_fpc($this->import_log, trim(max($row['ID'], $start_from_id)) . '|' . trim($result));
							if ($this->debug) dfl( sprintf( __('Post (ID=%s) imported. Current import progress: %s. Time limit: %s sec. Elapsed time: %s sec.', 'morning-records'), $row['ID'], $result.'%', $this->max_time, time() - $this->start_time) );
							// Break import after timeout or if leave one post and execution time > half of max_time
							if (time() - $this->start_time >= $this->max_time) {
								$break = true;
								break;
							}
						}
					}
				}
				if (!empty($values)) {
					// Attention! All items in the variable $values escaped on the loop above - esc_sql($value)
					$q = "INSERT INTO ".esc_sql($wpdb->prefix . $table)." VALUES {$values}";
					$wpdb->query($q);
				}
				if ($this->options['debug']) dfl(sprintf(__('Imported %s. Elapsed time %s sec. of %s sec.', 'morning-records'), $result.'%', time() - $this->start_time, $this->max_time));
				if ($break) break;
			}
		} else {
			if ($this->options['debug'])
				dfl(sprintf(__('Error unserialize data from the file %s', 'morning-records'), $this->options['files'][$this->options['demo_type']]['file_with_'.$slug]));
		}
		return $result;
	}

	
	// Replace uploads dir to new url
	function replace_uploads($str) {
		return morning_records_replace_uploads_url($str);
	}

	
	// Replace strings then export data
	function prepare_data($str) {
		$need_ser = false;
		if (is_string($str) && morning_records_substr($str, 0, 2)=='a:') {
			$str = morning_records_unserialize($str);
			$need_ser = is_array($str);
		}
		if (is_array($str) && count($str) > 0) {
			foreach ($str as $k=>$v) {
				$str[$k] = $this->prepare_data($v);
			}
		} else if (is_string($str)) {
			// Replace developers domain to demo domain
			if ($this->options['files'][$this->options['demo_type']]['domain_dev']!=$this->options['files'][$this->options['demo_type']]['domain_demo'])
				$str = str_replace($this->options['files'][$this->options['demo_type']]['domain_dev'], $this->options['files'][$this->options['demo_type']]['domain_demo'], $str);
			// Replace DOS-style line endings to UNIX-style
			$str = str_replace("\r\n", "\n", $str);
		}
		if ($need_ser) $str = serialize($str);
		return $str;
	}
}
?>