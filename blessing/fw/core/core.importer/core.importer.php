<?php
// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Theme init
if (!function_exists('ancora_importer_theme_setup')) {
	add_action( 'ancora_action_after_init_theme', 'ancora_importer_theme_setup' );		// Fire this action after load theme options
	function ancora_importer_theme_setup() {
		if (is_admin() && current_user_can('import') && ancora_get_theme_option('admin_dummy_data')=='yes') {
			new ancora_dummy_data_importer();
		}
	}
}

class ancora_dummy_data_importer {

	// Theme specific settings
	var $options = array(
		'debug'					=> true,						// Enable debug output
		'enable_importer'		=> true,						// Show Importer section
		'enable_exporter'		=> true,						// Show Exporter section
		'data_type'				=> 'vc',						// Default dummy data type
		'file_with_content'		=> array(
			'no_vc'				=> 'demo/dummy_data.xml',		// Name of the file with demo content without VC wrappers
			'vc'				=> 'demo/dummy_data_vc.xml'		// Name of the file with demo content for Visual Composer
			),
		'file_with_options'		=> 'demo/theme_options.txt',	// Name of the file with theme options
		'file_with_postmeta'	=> 'demo/theme_postmeta.txt',	// Name of the file with post meta
		'file_with_widgets'		=> 'demo/widgets.txt',			// Name of the file with widgets data
		'folder_with_revsliders'=> 'demo/revslider',			// Name of the folder with revolution sliders data
		'domain_dev'			=> 'blessing.ancorathemes.dev',		// Domain on developer's server
		'domain_demo'			=> 'blessing.ancorathemes.com',		// Domain on demo-server
		'demo_url'				=> 'http://blessing.ancorathemes.com/',	// URL of the demo site - need for change URLs in the custom menu items
		'uploads_folder'		=> 'imports',					// Folder with images on demo server
		'upload_attachments'	=> true,						// Upload attachments images
		'import_posts'			=> true,						// Import posts
		'import_to'				=> true,						// Import Theme Options
		'import_widgets'		=> true,						// Import widgets
		'import_sliders'		=> true,						// Import sliders
		'overwrite_content'		=> true,						// Overwrite existing content
		'show_on_front'			=> 'page',						// Reading settings
		'page_on_front'			=> 'Homepage',					// Homepage title
		'page_for_posts'		=> 'Memorials',					// Blog streampage title
		'menus'					=> array(						// Menus locations and names
			'menu-main'	=> 'Main menu'
		),
		'taxonomies'		=> array(),							// List of required taxonomies: 'post_type' => 'taxonomy', ...
		'required_plugins'		=> array( 
			'woocommerce',
			'visual_composer',
            'ancora-paypal-donation',
			'revslider',
            'calculated-fields-form'
		),
		'wooc_pages'			=> array(						// Options slugs and pages titles for WooCommerce pages
			'woocommerce_shop_page_id' 				=> 'Shop',
			'woocommerce_cart_page_id' 				=> 'Cart',
			'woocommerce_checkout_page_id' 			=> 'Checkout',
			'woocommerce_pay_page_id' 				=> 'Checkout &#8594; Pay',
			'woocommerce_thanks_page_id' 			=> 'Order Received',
			'woocommerce_myaccount_page_id' 		=> 'My Account',
			'woocommerce_edit_address_page_id'		=> 'Edit My Address',
			'woocommerce_view_order_page_id'		=> 'View Order',
			'woocommerce_change_password_page_id'	=> 'Change Password',
			'woocommerce_logout_page_id'			=> 'Logout',
			'woocommerce_lost_password_page_id'		=> 'Lost Password'
		)
	);

	var $error    = '';				// Error message
	var $success  = '';				// Success message
	var $result   = 0;				// Import posts percent (if break inside)
	var $last_slider = 0;			// Last imported slider number

	var $nonce    = '';
	var $export_options = '';
	var $export_templates = '';
	var $export_postmeta = '';
	var $export_widgets = '';
	var $uploads_url = '';
	var $uploads_dir = '';
	var $import_log = '';
	var $import_last_id = 0;

	//-----------------------------------------------------------------------------------
	// Constuctor
	//-----------------------------------------------------------------------------------
	function __construct() {
	    $this->options = apply_filters('ancora_filter_importer_options', $this->options);
		$this->nonce = wp_create_nonce(__FILE__);
		$uploads_info = wp_upload_dir();
		$this->uploads_dir = $uploads_info['basedir'];
		$this->uploads_url = $uploads_info['baseurl'];
		if ($this->options['debug']) define('IMPORT_DEBUG', true);
		$this->import_log = ancora_get_file_dir('core/core.importer/importer.log');
		$log = explode('|', ancora_fgc($this->import_log));
		$this->import_last_id = (int) $log[0];
		$this->result = empty($log[1]) ? 0 : (int) $log[1];
		$this->last_slider = empty($log[2]) ? '' : $log[2];
		add_action('admin_menu', array($this, 'admin_menu_item'));
	}

	//-----------------------------------------------------------------------------------
	// Admin Interface
	//-----------------------------------------------------------------------------------
	function admin_menu_item() {
		if ( current_user_can( 'manage_options' ) ) {
			// In this case menu item is add in admin menu 'Appearance'
			add_theme_page(__('Install Dummy Data', 'ancora'), __('Install Dummy Data', 'ancora'), 'edit_theme_options', 'trx_importer', array($this, 'build_page'));

			// In this case menu item is add in admin menu 'Tools'
			//add_management_page(__('Theme Demo', 'ancora'), __('Theme Demo', 'ancora'), 'manage_options', 'trx_importer', array($this, 'build_page'));
		}
	}
	
	
	//-----------------------------------------------------------------------------------
	// Build the Main Page
	//-----------------------------------------------------------------------------------
	function build_page() {
		
		$after_importer = false;

		do {
			if ( isset($_POST['importer_action']) ) {
				if ( !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], __FILE__ ) ) {
					$this->error = __('Incorrect WP-nonce data! Operation canceled!', 'ancora');
					break;
				}
				if ($this->checkRequiredPlugins()) {
					$this->options['overwrite_content']	= $_POST['importer_action']=='overwrite';
					$this->options['data_type'] 		= $_POST['data_type']=='vc' ? 'vc' : 'no_vc';
					$this->options['upload_attachments']= isset($_POST['importer_upload']);
					$this->options['import_posts']		= isset($_POST['importer_posts']);
					$this->options['import_to']			= isset($_POST['importer_to']);
					$this->options['import_widgets']	= isset($_POST['importer_widgets']);
					$this->options['import_sliders']	= isset($_POST['importer_sliders']);
					$this->import_last_id = (int) $_POST['last_id'];
					?>
					<div class="trx_importer_log">
						<?php
						$this->importer();
						$after_importer = true;
						?>
						<script type="text/javascript">
							jQuery(document).ready(function() {
								jQuery('.trx_importer_log').remove();
								<?php if ($this->import_last_id > 0 || $this->last_slider > 0) { ?>
								setTimeout(function() {
									jQuery('#trx_importer_continue').trigger('click');
								}, 3000);
								<?php } ?>
							});
						</script>
					</div>
					<?php
				}
			} else if ( isset($_POST['exporter_action']) ) {
				if ( !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], __FILE__ ) ) {
					$this->error = __('Incorrect WP-nonce data! Operation canceled!', 'ancora');
					break;
				}
				$this->exporter();
			}
		} while (false);
		?>
		<div class="trx_importer">
			<div class="trx_importer_result">
				<?php if (!empty($this->error)) { ?>
				<p>&nbsp;</p>
				<div class="error">
					<p><?php echo ($this->error); ?></p>
				</div>
				<p>&nbsp;</p>
				<?php } ?>
				<?php if (!empty($this->success)) { ?>
				<p>&nbsp;</p>
				<div class="updated">
					<p><?php echo ($this->success); ?></p>
				</div>
				<p>&nbsp;</p>
				<?php } ?>
			</div>
	
			<?php if (empty($this->success) && $this->options['enable_importer']) { ?>
				<div class="trx_importer_section"<?php echo ($after_importer ? ' style="display:none;"' : ''); ?>>
					<h2 class="trx_title"><?php _e('Ancora Importer', 'ancora'); ?></h2>
					<p><b><?php _e('Attention! Important info:', 'ancora'); ?></b></p>
					<ol>
						<li><?php _e('Data import can take a long time (sometimes more than 10 minutes) - please wait until the end of the procedure, do not navigate away from the page.', 'ancora'); ?></li>
						<li><?php _e('Web-servers set the time limit for the execution of php-scripts. Therefore, the import process will be split into parts. Upon completion of each part - the import will resume automatically!', 'ancora'); ?></li>
						<li><?php _e('We recommend that you select the first option to import (with the replacement of existing content) - so you get a complete copy of our demo site', 'ancora'); ?></li>
						<li><?php _e('We also encourage you to leave the enabled check box "Upload attachments" - to download the demo version of the images', 'ancora'); ?></li>
					</ol>
	
					<form id="trx_importer_form" action="#" method="post">
	
						<input type="hidden" value="<?php echo esc_attr($this->nonce); ?>" name="nonce" />
						<input type="hidden" value="0" name="last_id" />
	
						<p>
						<input type="radio" <?php echo ($this->options['overwrite_content'] ? 'checked="checked"' : ''); ?> value="overwrite" name="importer_action" id="importer_action_over" /><label for="importer_action_over"><?php _e('Overwrite existing content', 'ancora'); ?></label><br>
						<?php _e('In this case <b>all existing content will be erased</b>! But you get full copy of the our demo site <b>(recommended)</b>.', 'ancora'); ?>
						</p>
	
						<p>
						<input type="radio" <?php echo !$this->options['overwrite_content'] ? 'checked="checked"' : ''; ?> value="append" name="importer_action" id="importer_action_append" /><label for="importer_action_append"><?php _e('Append to existing content', 'ancora'); ?></label><br>
						<?php _e('In this case demo data append to the existing content! Warning! In many cases you do not have exact copy of the demo site.', 'ancora'); ?>
						</p>
	
						<p><b><?php _e('Select the data to import:', 'ancora'); ?></b></p>
						<p>
						<?php
						$checked = 'checked="checked"';
						if (!empty($this->options['file_with_content']['vc']) && file_exists(ancora_get_file_dir($this->options['file_with_content']['vc']))) {
							?>
							<input type="radio" <?php echo ($this->options['data_type']=='vc' ? $checked : ''); ?> value="vc" name="data_type" id="data_type_vc" /><label for="data_type_vc"><?php _e('Import data for edit in the Visual Composer', 'ancora'); ?></label><br>
							<?php
							if ($this->options['data_type']=='vc') $checked = '';
						}
						if (!empty($this->options['file_with_content']['no_vc']) && file_exists(ancora_get_file_dir($this->options['file_with_content']['no_vc']))) {
							?>
							<input type="radio" <?php echo ($this->options['data_type']=='no_vc' || $checked ? $checked : ''); ?> value="no_vc" name="data_type" id="data_type_no_vc" /><label for="data_type_no_vc"><?php _e('Import data without Visual Composer wrappers', 'ancora'); ?></label>
							<?php
						}
						?>
						</p>
						<p>
						<input type="checkbox" <?php echo ($this->options['import_posts'] ? 'checked="checked"' : ''); ?> value="1" name="importer_posts" id="importer_posts" /> <label for="importer_posts"><?php _e('Import posts', 'ancora'); ?></label><br>
						<input type="checkbox" <?php echo ($this->options['upload_attachments'] ? 'checked="checked"' : ''); ?> value="1" name="importer_upload" id="importer_upload" /> <label for="importer_upload"><?php _e('Upload attachments', 'ancora'); ?></label>
						</p>
						<p>
						<input type="checkbox" <?php echo ($this->options['import_to'] ? 'checked="checked"' : ''); ?> value="1" name="importer_to" id="importer_to" /> <label for="importer_to"><?php _e('Import Theme Options', 'ancora'); ?></label><br>
						<input type="checkbox" <?php echo ($this->options['import_widgets'] ? 'checked="checked"' : ''); ?> value="1" name="importer_widgets" id="importer_widgets" /> <label for="importer_widgets"><?php _e('Import Widgets', 'ancora'); ?></label><br>
						<input type="checkbox" <?php echo ($this->options['import_sliders'] ? 'checked="checked"' : ''); ?> value="1" name="importer_sliders" id="importer_sliders" /> <label for="importer_sliders"><?php _e('Import Sliders', 'ancora'); ?></label>
						</p>
	
						<div class="trx_buttons">
							<?php if ($this->import_last_id > 0 || $this->last_slider > 0) { ?>
							<h4 class="trx_importer_complete"><?php sprintf(__('Import posts completed by %s', 'ancora'), $this->result.'%'); ?></h4>
							<input type="submit" value="<?php printf(__('Continue import (from ID=%s)', 'ancora'), $this->import_last_id); ?>" onClick="this.form.last_id.value='<?php echo esc_attr($this->import_last_id); ?>'" id="trx_importer_continue">
							<input type="submit" value="<?php _e('Start import again', 'ancora'); ?>">
							<?php } else { ?>
							<input type="submit" value="<?php _e('Start import', 'ancora'); ?>">
							<?php } ?>
						</div>
					</form>
				</div>
			<?php } ?>

			<?php if (empty($this->success) && $this->options['enable_exporter']) { ?>
				<div class="trx_exporter_section"<?php echo ($after_importer ? ' style="display:none;"' : ''); ?>>
					<h2 class="trx_title"><?php _e('Ancora Exporter', 'ancora'); ?></h2>
					<form id="trx_exporter_form" action="#" method="post">
	
						<input type="hidden" value="<?php echo esc_attr($this->nonce); ?>" name="nonce" />
						<input type="hidden" value="all" name="exporter_action" />
	
						<div class="trx_buttons">
							<?php if ($this->export_options!='') { ?>
							<h4><?php _e('Theme Options', 'ancora'); ?></h4>
							<textarea rows="10" cols="80"><?php echo esc_html($this->export_options); ?></textarea>
							<h4><?php _e('Templates Options', 'ancora'); ?></h4>
							<textarea rows="10" cols="80"><?php echo esc_html($this->export_templates); ?></textarea>
							<h4><?php _e('Widgets', 'ancora'); ?></h4>
							<textarea rows="10" cols="80"><?php echo esc_html($this->export_widgets); ?></textarea>
							<?php } else { ?>
							<input type="submit" value="<?php _e('Export Theme Options', 'ancora'); ?>">
							<?php } ?>
						</div>
	
					</form>
				</div>
			<?php } ?>
		</div>
		<?php
	}
	
	
	//-----------------------------------------------------------------------------------
	// Export dummy data
	//-----------------------------------------------------------------------------------
	function exporter() {
		global $wpdb;
		$suppress = $wpdb->suppress_errors();

		// Export theme and categories options and VC templates
		$rows = $wpdb->get_results( "SELECT option_name, option_value FROM " . esc_sql($wpdb->options) . " WHERE option_name LIKE 'ancora_options%' OR option_name='wpb_js_templates'" );
		$options = array();
		if (count($rows) > 0) {
			foreach ($rows as $row) {
				$options[$row->option_name] = $this->prepare_uploads(unserialize($row->option_value));
			}
		}
		$this->export_options = base64_encode(str_replace($this->options['domain_dev'], $this->options['domain_demo'], serialize($options)));

		// Export templates options
		$rows = $wpdb->get_results( "SELECT option_name, option_value FROM " . esc_sql($wpdb->options) . " WHERE option_name LIKE 'ancora_options_template_%'" );
		$options = array();
		if (count($rows) > 0) {
			foreach ($rows as $row) {
				$options[$row->option_name] = $this->prepare_uploads(unserialize($row->option_value));
			}
		}
		$this->export_templates = base64_encode(str_replace($this->options['domain_dev'], $this->options['domain_demo'], serialize($options)));

		// Export widgets
		$rows = $wpdb->get_results( "SELECT option_name, option_value FROM " . esc_sql($wpdb->options) . " WHERE option_name = 'sidebars_widgets' OR option_name LIKE 'widget_%'" );
		$options = array();
		if (count($rows) > 0) {
			foreach ($rows as $row) {
				$options[$row->option_name] = $this->prepare_uploads(unserialize($row->option_value));
			}
		}
		$this->export_widgets = base64_encode(str_replace($this->options['domain_dev'], $this->options['domain_demo'], serialize($options)));

		$wpdb->suppress_errors( $suppress );
	}
	
	
	//-----------------------------------------------------------------------------------
	// Import dummy data
	//-----------------------------------------------------------------------------------
	function importer() {
		?>
		<p>&nbsp;</p>
		<div class="error">
			<h4><?php echo __('Import progress:', 'ancora') . ' <span id="import_progress_value">' . ($this->last_slider > 0 ? 99 : $this->result) . '</span>%'; ?></h4>
			<p><?php echo __('Status:', 'ancora'); ?> <span id="import_progress_status"></span></p>
			<p><?php echo __('Data import can take a long time (sometimes more than 10 minutes)!', 'ancora')
				. '<br>' . __('Please wait until the end of the procedure, do not navigate away from the page!', 'ancora'); ?></p>
		</div>
		<p>&nbsp;</p>
		<?php
		// Import posts, pages, menu items, etc.
		$result = 100;
		if ($this->options['import_posts'] && empty($this->last_slider)) {
			// Load WP Importer class
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers
			if ( !class_exists('WP_Import') ) {
				require(ancora_get_file_dir('core/core.importer/wordpress-importer.php'));
			}
			if ( class_exists( 'WP_Import' ) ) {
				$result = $this->import_posts();
				if ($result >= 100) {
					if (in_array('woocommerce', $this->options['required_plugins']))
						$this->setup_woocommerce_pages();
					$this->setup_menus();
				} else {
					$log = explode('|', ancora_fgc($this->import_log));
					$this->import_last_id = (int) $log[0];
				}
			}
		}

		// Import Theme Options
		if ($result>=100 && empty($this->last_slider) && $this->options['import_to']) {
			ancora_options_reset();
			$this->import_theme_options();
		}

		// Import Widgets
		if ($result>=100 && empty($this->last_slider) && $this->options['import_widgets'])
			$this->import_widgets();

		// Import Sliders
		if ($result>=100 && $this->options['import_sliders'])
			$this->import_sliders();

		// Setup Front page and Blog page
		if ($result>=100 && empty($this->last_slider) && $this->options['import_posts']) {
			// Set reading options
			$home_page = get_page_by_title( $this->options['page_on_front'] );
			$posts_page = get_page_by_title( $this->options['page_for_posts'] );
			if ($home_page->ID && $posts_page->ID) {
				update_option('show_on_front', $this->options['show_on_front']);
				update_option('page_on_front', $home_page->ID); 	// Front Page
				update_option('page_for_posts', $posts_page->ID);	// Blog Page
			}

			// Flush rules after install
			flush_rewrite_rules();
		}
		// finally redirect to success page
		if ($result >= 100 && empty($this->last_slider)) 
			$this->success = __('Congratulations! Import demo data finished successfull!', 'ancora');
		else {
			$this->error = '<h4>' . sprintf(__('Import progress: %s.', 'ancora'), $result.'%') . '</h4>'
				. __('Due to the expiration of the time limit for the execution of scripts on your server, the import process is interrupted!', 'ancora')
				. '<br>' . __('After 3 seconds, the import will continue automatically!', 'ancora');
			$this->result = $result;
		}
	}
	
	//==========================================================================================
	// Utilities
	//==========================================================================================

	// Check for required plugings
	function checkRequiredPlugins() {
		$not_installed = '';
		if (in_array('visual_composer', $this->options['required_plugins']) && $_POST['data_type']=='vc' && !ancora_exists_visual_composer() )
			$not_installed .= '<br>Visual Composer';
		if (in_array('woocommerce', $this->options['required_plugins']) && !ancora_exists_woocommerce() )
			$not_installed .= '<br>WooCommerce';
		if (in_array('revslider', $this->options['required_plugins']) && !ancora_exists_revslider())
			$not_installed .= '<br>Revolution Slider';
		if (in_array('instagram', $this->options['required_plugins']) && !ancora_exists_instagram())
			$not_installed .= '<br>Instagram Widget';
		$not_installed = apply_filters('ancora_filter_importer_required_plugins', $not_installed);
		if ($not_installed) {
			$this->error = '<b>'.__('Attention! For correct installation of the demo data, you must install and activate the following plugins: ', 'ancora').'</b>'.($not_installed);
			$this->options['enable_importer'] = false;
			return false;
		}
		return true;
	}


	// Import XML file with posts data
	function import_posts() {
		if (empty($this->options['file_with_content'][$this->options['data_type']])) return;
		echo ($this->import_last_id == 0 
			? '<h3>'.__('Start Import', 'ancora').'</h3>'
			: '<h3>'.sprintf(__('Continue Import from ID=%d', 'ancora'), $this->import_last_id).'</h3>');
		echo '<b>' . __('Import Posts (pages, menus, attachments, etc) ...', 'ancora').'</b><br>'; flush();
		$theme_xml = ancora_get_file_dir($this->options['file_with_content'][$this->options['data_type']]);
		$importer = new WP_Import();
		$importer->fetch_attachments = $this->options['upload_attachments'];
		$importer->overwrite = $this->options['overwrite_content'];
		$importer->debug = $this->options['debug'];
		$importer->uploads_folder = $this->options['uploads_folder'];
		$importer->demo_url = $this->options['demo_url'];
		$importer->start_from_id = $this->import_last_id;
		$importer->import_log = $this->import_log;
		if ($this->import_last_id == 0) $this->clear_tables();
		$this->prepare_taxonomies();
		if (!$this->options['debug']) ob_start();
		$result = $importer->import($theme_xml);
		if (!$this->options['debug']) ob_end_clean();
		if ($result>=100) ancora_fpc($this->import_log, '');
		return $result;
	}
	
	
	// Delete all data from tables
	function clear_tables() {
		global $wpdb;
		if ($this->options['overwrite_content']) {
			echo '<br><b>'.__('Clear tables ...', 'ancora').'</b><br>'; flush();
			if ($this->options['import_posts']) {
				$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->comments));
				if ( is_wp_error( $res ) ) echo __( 'Failed truncate table "comments".', 'ancora' ) . ' ' . ($res->get_error_message()) . '<br />';
				$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->commentmeta));
				if ( is_wp_error( $res ) ) echo __( 'Failed truncate table "commentmeta".', 'ancora' ) . ' ' . ($res->get_error_message()) . '<br />';
				$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->postmeta));
				if ( is_wp_error( $res ) ) echo __( 'Failed truncate table "postmeta".', 'ancora' ) . ' ' . ($res->get_error_message()) . '<br />';
				$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->posts));
				if ( is_wp_error( $res ) ) echo __( 'Failed truncate table "posts".', 'ancora' ) . ' ' . ($res->get_error_message()) . '<br />';
				$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->terms));
				if ( is_wp_error( $res ) ) echo __( 'Failed truncate table "terms".', 'ancora' ) . ' ' . ($res->get_error_message()) . '<br />';
				$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->term_relationships));
				if ( is_wp_error( $res ) ) echo __( 'Failed truncate table "term_relationships".', 'ancora' ) . ' ' . ($res->get_error_message()) . '<br />';
				$res = $wpdb->query("TRUNCATE TABLE " . esc_sql($wpdb->term_taxonomy));
				if ( is_wp_error( $res ) ) echo __( 'Failed truncate table "term_taxonomy".', 'ancora' ) . ' ' . ($res->get_error_message()) . '<br />';
			}
		}
	}

	
	// Prepare additional taxes
	function prepare_taxonomies() {
		if (isset($this->options['taxonomies']) && is_array($this->options['taxonomies']) && count($this->options['taxonomies']) > 0) {
			foreach ($this->options['taxonomies'] as $type=>$tax) {
				ancora_require_data( 'taxonomy', $tax, array(
					'post_type'			=> array( $type ),
					'hierarchical'		=> false,
					'query_var'			=> $tax,
					'rewrite'			=> true,
					'public'			=> false,
					'show_ui'			=> false,
					'show_admin_column'	=> false,
					'_builtin'			=> false
					)
				);
			}
		}
	}
	

	// Set WooCommerce pages
	function setup_woocommerce_pages() {
		foreach ($this->options['wooc_pages'] as $woo_page_name => $woo_page_title) {
			$woopage = get_page_by_title( $woo_page_title );
			if ($woopage->ID) {
				update_option($woo_page_name, $woopage->ID);
			}
		}
		// We no longer need to install pages
		delete_option( '_wc_needs_pages' );
		delete_transient( '_wc_activation_redirect' );
	}


	// Set imported menus to registered theme locations
	function setup_menus() {
		echo '<script>'
			. 'document.getElementById("import_progress_status").innerHTML = "' . __('Setup menus ...', 'ancora') .'";'
			. '</script>';
		echo '<br><b>'.__('Setup menus ...', 'ancora').'</b><br>'; flush();
		$locations = get_theme_mod( 'nav_menu_locations' );
		$menus = wp_get_nav_menus();
		if ($menus) {
			foreach ($menus as $menu) {
				foreach ($this->options['menus'] as $loc=>$name) {
					if ($menu->name == $name)
						$locations[$loc] = $menu->term_id;
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}


	// Import theme options
	function import_theme_options() {
		if (empty($this->options['file_with_options'])) return;
		echo '<script>'
			. 'document.getElementById("import_progress_status").innerHTML = "' . __('Import Theme Options ...', 'ancora') .'";'
			. '</script>';
		echo '<br><b>'.__('Import Theme Options ...', 'ancora').'</b><br>'; flush();
		$theme_options_txt = ancora_fgc(ancora_get_file_dir($this->options['file_with_options']));
		$data = unserialize( base64_decode( $theme_options_txt) );
		// Replace upload url in options
		foreach ($data as $k=>$v) {
			foreach ($v as $k1=>$v1) {
				$v[$k1] = $this->replace_uploads($v1);
			}
			update_option( $k, $v );
		}
		ancora_load_main_options();
	}


	// Import post meta options
	function import_postmeta() {
		if (empty($this->options['file_with_postmeta'])) return;
		$theme_options_txt = ancora_fgc(ancora_get_file_dir($this->options['file_with_postmeta']));
		$data = unserialize( base64_decode( $theme_options_txt) );
		// Replace upload url in options
		foreach ($data as $k=>$v) {
			foreach ($v as $k1=>$v1) {
				$v[$k1] = $this->replace_uploads($v1);
			}
			update_post_meta( $k, $v['key'], $v['value'] );
		}
	}


	// Import widgets
	function import_widgets() {
		if (empty($this->options['file_with_widgets'])) return;
		echo '<script>'
			. 'document.getElementById("import_progress_status").innerHTML = "' . __('Import Widgets ...', 'ancora') .'";'
			. '</script>';
		echo '<br><b>'.__('Import Widgets ...', 'ancora').'</b><br>'; flush();
		$widgets_txt = ancora_fgc(ancora_get_file_dir($this->options['file_with_widgets']));
		$data = unserialize( base64_decode( $widgets_txt ) );
		foreach ($data as $k=>$v) {
			update_option( $k, $this->replace_uploads($v) );
		}
	}


	// Import sliders
	function import_sliders() {
		// Revolution Sliders
		if (ancora_exists_revslider() && file_exists(WP_PLUGIN_DIR.'/revslider/revslider.php')) {
			require_once(WP_PLUGIN_DIR.'/revslider/revslider.php');
			$dir = ancora_get_folder_dir($this->options['folder_with_revsliders']);
			if ( is_dir($dir) ) {
				$hdir = @opendir( $dir );
				if ( $hdir ) {
					echo '<script>'
						. 'document.getElementById("import_progress_status").innerHTML = "' . __('Import Revolution sliders ...', 'ancora') .'";'
						. '</script>';
					echo '<br><b>'.__('Import Revolution sliders ...', 'ancora').'</b><br>'; flush();
					$slider = new RevSlider();
					$counter = 0;
					while (($file = readdir( $hdir ) ) !== false ) {
						$counter++;
						if ($counter <= $this->last_slider) continue;
						$pi = pathinfo( ($dir) . '/' . ($file) );
						if ( substr($file, 0, 1) == '.' || is_dir( ($dir) . '/' . ($file) ) || $pi['extension']!='zip' )
							continue;
if ($this->options['debug']) printf(__('Slider "%s":', 'ancora'), $file);
						if (!is_array($_FILES)) $_FILES = array();
						$_FILES["import_file"] = array("tmp_name" => ($dir) . '/' . ($file));
						$response = $slider->importSliderFromPost();
						if ($response["success"] == false) { 
if ($this->options['debug']) echo ' '.__('import error:', 'ancora').'<br>'.ancora_debug_dump_var($response);
						} else {
if ($this->options['debug']) echo ' '.__('imported', 'ancora').'<br>';
						}
						flush();
						break;
					}
					@closedir( $hdir );
					// Write last slider into log
					ancora_fpc($this->import_log, $file ? '0|100|'.intval($counter) : '');
					$this->last_slider = $file ? $counter : 0;
				}
			}
		} else {
			if ($this->options['debug']) { printf(__('Can not locate Revo plugin: %s', 'ancora'), WP_PLUGIN_DIR.'/revslider/revslider.php<br>'); flush(); }
		}
	}

	
	// Replace uploads dir to new url
	function replace_uploads($str) {
		/*
		if (is_array($str)) {
			foreach ($str as $k=>$v) {
				$str[$k] = $this->replace_uploads($v);
			}
		} else if (is_string($str)) {
			while (($pos = ancora_strpos($str, "/{$this->options['uploads_folder']}/"))!==false) {
				$pos0 = $pos;
				while ($pos0) {
					if (ancora_substr($str, $pos0, 5)=='http:')
						break;
					$pos0--;
				}
				$str = ($pos0 > 0 ? ancora_substr($str, 0, $pos0) : '') . ($this->uploads_url) . ancora_substr($str, $pos+ancora_strlen($this->options['uploads_folder'])+1);
			}
		}
		return $str;
		*/
		return ancora_replace_uploads_url($str, $this->options['uploads_folder']);
	}

	
	// Replace uploads dir to imports then export data
	function prepare_uploads($str) {
		if ($this->options['uploads_folder']=='uploads') return $str;
		if (is_array($str)) {
			foreach ($str as $k=>$v) {
				$str[$k] = $this->prepare_uploads($v);
			}
		} else if (is_string($str)) {
			$str = str_replace('/uploads/', "/{$this->options['uploads_folder']}/", $str);
		}
		return $str;
	}
}
?>