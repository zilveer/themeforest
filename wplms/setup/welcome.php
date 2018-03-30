<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class WPLMS_Admin_Welcome {

	private $plugin;
	public $major_version='2.2.2';
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Bail if user cannot moderate
		if ( ! current_user_can( 'manage_options' ) )
			return;
		add_action( 'admin_menu', array( $this, 'admin_menus') );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_init', array( $this, 'welcome'    ) );
	}


	/**
	 * Add admin menus/screens
	 *
	 * @access public
	 * @return void
	 */
	public function admin_menus() {	

		$welcome_page_name  = __( 'Install WPLMS', 'vibe' );
		$welcome_page_title = __( 'Welcome to WPLMS', 'vibe' );
		if(!$this->check_installed()){
			$page = add_dashboard_page( $welcome_page_title, $welcome_page_name, 'manage_options', 'wplms-install', array( $this, 'install_screen' ) );
			add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );
		}
		if ( empty( $_GET['page'] ) ) {
			return;
		}

		
		$welcome_page_name  = __( 'About WPLMS', 'vibe' );
		$welcome_page_title = __( 'Welcome to WPLMS', 'vibe' );
		switch ( $_GET['page'] ) {
			case 'wplms-about' :
				$page = add_dashboard_page( $welcome_page_title, $welcome_page_name, 'manage_options', 'wplms-about', array( $this, 'about_screen' ) );
				add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );
			break;
			case 'wplms-system' :
				/*$page = add_dashboard_page( $welcome_page_title, $welcome_page_name, 'manage_options', 'wplms-system', array( $this, 'system_screen' ) );
				add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );*/
			break;
			case 'wplms-changelog' :
				$page = add_dashboard_page( $welcome_page_title, $welcome_page_name, 'manage_options', 'wplms-changelog', array( $this, 'changelog_screen' ) );
				add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );
			break;
		}
	}

	/**
	 * admin_css function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_css() {
		wp_enqueue_style( 'vibe-activation', VIBE_URL.'/assets/css/old_files/activation.css');
	}

	/**
	 * Add styles just for this page, and remove dashboard page links.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_head() {
		remove_submenu_page( 'index.php', 'wplms-about' );
		//remove_submenu_page( 'index.php', 'wplms-system' );
		remove_submenu_page( 'index.php', 'wplms-changelog' );

		?>
		<style type="text/css">
			/*<![CDATA[*/
			.wplms-wrap .wplms-badge {
				<?php echo is_rtl() ? 'left' : 'right'; ?>: 0;
			}
			.wplms-wrap .feature-rest div {
				float:<?php echo is_rtl() ? 'right':'left' ; ?>;
			}
			.wplms-wrap .feature-rest div.last-feature {
				padding-<?php echo is_rtl() ? 'right' : 'left'; ?>: 50px !important;
				padding-<?php echo is_rtl() ? 'left' : 'right'; ?>: 0;
			}
			.three-col > div{
				float:<?php echo is_rtl() ? 'right':'left' ; ?>;
			}
			/*]]>*/
		</style>
		<?php
	}

	/**
	 * Into text/links shown on all about pages.
	 *
	 * @access private
	 * @return void
	 */
	private function intro() {

		// Flush after upgrades
		if ( ! empty( $_GET['wplms-updated'] ) || ! empty( $_GET['wplms-installed'] ) )
			flush_rewrite_rules();
		/*
		$sidebars = get_option('sidebars_widgets');
		echo base64_encode(serialize($sidebars));*/
		/*global $wpdb;
		$results =  $wpdb->get_results("SELECT option_name from {$wpdb->options} where option_name LIKE 'widget_%'");
		$widgets = array();
		foreach($results as $result){
			$widgets[$result->option_name]=get_option($result->option_name);
		}
		print_r(base64_encode(serialize($widgets)));
		*/
		/*global $wpdb;
		$results =  $wpdb->get_results("SELECT option_name from {$wpdb->options} where option_name LIKE 'mycred_%'");
		$mycred = array();
		foreach($results as $result){
			$mycred[$result->option_name]=get_option($result->option_name);
		}
		print_r(base64_encode(serialize($mycred)));*/
		?>
		<h1><?php printf( __( 'Welcome to WPLMS %s', 'vibe' ), $this->major_version ); ?></h1>

		<div class="about-text wplms-about-text">
			<?php
				if ( ! empty( $_GET['wplms-installed'] ) )
					$message = __( 'Thanks, all done!', 'vibe' );
				elseif ( ! empty( $_GET['wplms-updated'] ) )
					$message = __( 'Thank you for updating to the latest version!', 'vibe' );
				else
					$message = __( 'Thanks for installing!', 'vibe' );

				printf( __( '%s WPLMS is the best Learning Management platform for WordPress. The latest version %s now contains following features.', 'vibe' ), $message, $this->major_version );
			?>
		</div>

		<div class="wplms-badge"><img src="<?php echo 'https://0.s3.envato.com/files/80339740/themeforest_thumbnail.png'; ?>" /></div>

		<p class="wplms-actions">
			<a href="<?php echo admin_url('admin.php?page=wplms_options'); ?>" class="button button-primary"><?php _e( 'Settings', 'vibe' ); ?></a>
			<a href="<?php echo esc_url( 'http://vibethemes.com/documentation/wplms/article-categories/tips-tricks/'); ?>" class="docs button"><?php _e( 'FAQs', 'vibe' ); ?></a>
			<a href="<?php echo esc_url( 'http://vibethemes.com/envato/wplms/documentation/'); ?>" class="docs button"><?php _e( 'Docs', 'vibe' ); ?></a>
			<a href="<?php echo esc_url( 'http://vibethemes.com/documentation/wplms/knowledge-base/'); ?>" class="button"><?php _e( 'Customization Tips', 'vibe' ); ?></a>
			<a href="<?php echo esc_url( 'http://vibethemes.com/documentation/wplms/'); ?>" class="button"><?php _e( 'Support system', 'vibe' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<?php
				if(!$this->check_installed()){
					?>
					<a class="nav-tab <?php if ( $_GET['page'] == 'wplms-install' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wplms-install' ), 'index.php' ) ) ); ?>">
						<?php _e( "Installation and Setup", 'vibe' ); ?>
					</a>
					<?php
				}
			?>
			
			<a class="nav-tab <?php if ( $_GET['page'] == 'wplms-about' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wplms-about' ), 'index.php' ) ) ); ?>">
				<?php _e( "What's New", 'vibe' ); ?>
			</a>
			<?php 
			//<a class="nav-tab <?php if ( $_GET['page'] == 'wplms-system' ) echo 'nav-tab-active'; ?>
			<?php 
			//" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wplms-system' ), 'index.php' ) ) ); 
			 // ?>
			 <?php 
			 //">
			?>
			<?php
			// _e( 'System Status', 'vibe' ); 
				?>
			</a><a class="nav-tab <?php if ( $_GET['page'] == 'wplms-changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wplms-changelog' ), 'index.php' ) ) ); ?>">
				<?php _e( 'Changelog', 'vibe' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Output the install screen.
	 */
	public function install_screen() {
		?>
		<div class="wrap wplms-wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog">
				<div class="wplms-feature feature-rest feature-section col two-col">
					<div class="col-1">
						<h4><?php _e( 'One Click installation and Setup', 'vibe' ); ?></h4>
						<p><?php _e( 'You can now install WPLMS in one single click, select the setup procedure from the options given in the right. You just need to Click the button once and everything would be automatically installed and setup, after which your WPLMS Site would be ready to use and configure.', 'vibe' ); ?></p>
					</div>
					<div class="col-2"><?php
						if ( in_array( 'wordpress-importer/wordpress-importer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || (function_exists('is_plugin_active_for_network') && is_plugin_active_for_network( 'wordpress-importer/wordpress-importer.php'))) {
							echo '<p style="padding:15px;background-color: #FFF6BF;border: 1px solid #ffd324;border-radius: 2px;color: #817134;">'.__('Please deactivate WordPress importer plugin to avoid conflicts with Vibe one click installer.','vibe').'</p>';
						}else{
							if (is_plugin_active('buddypress/bp-loader.php') && is_plugin_active('vibe-course-module/loader.php') && is_plugin_active('vibe-customtypes/vibe-customtypes.php')) { 
						?>
						<strong class="install_buttons">
							<a class="button button-primary button-hero sample_data_install" data-file="theme_data"><?php _e('Setup Theme without Sample Data','vibe'); ?></a>
							<span><?php _e('OR','vibe'); ?> </span>
							<?php
								$disabled=0;
								$plugin_flag=1;
								if(is_plugin_active('LayerSlider/layerslider.php') && is_plugin_active('wplms-assignments/wplms-assignments.php') && is_plugin_active('wplms-front-end/wplms-front-end.php') && is_plugin_active('woocommerce/woocommerce.php')){
									$plugin_flag=0;
								}
								$plugin_flag=apply_filters('wplms_setup_plugins',$plugin_flag);
								if (!$plugin_flag) { 
									?>
									<a class="button button-primary button-hero sample_data_install <?php echo (($disabled)?'disabled':''); ?>" data-file="sampledata"><?php _e('Setup Theme with Sample Data','vibe'); ?><?php echo (($disabled)?'<span>'.__('Please enable all the plugins','vibe').'</span>':''); ?></a>
								<?php }else{
									echo '<p style="padding:15px;background-color: #FFF6BF;border: 1px solid #ffd324;border-radius: 2px;color: #817134;display: inline-block;">'.sprintf(__('Install all plugins for Full Sample Data import % slink %s','vibe'),'<a href="'.admin_url('themes.php?page=install-required-plugins').'">','</a>').'</p>';
								 }
							?>
						</strong>
						<?php
						}else{
							echo '<p style="padding:15px;background-color: #FFF6BF;border: 1px solid #ffd324;border-radius: 2px;color: #817134;">'.__('Please activate all/required plugins bundled with the theme.','vibe').'</p><a href="'.admin_url('themes.php?page=install-required-plugins').'" class="button button-primary">'.__('Install & Activate plugins','vibe').'</a>';
						}
						echo '<span id="loading"><i class="sphere"></i></span>';
					}
					?>
					</div>
				</div>
			</div>
			<div class="changelog about-integrations">
				<h3><?php _e( 'Video Tutorial of Installing theme', 'vibe' ); ?></h3>

				<iframe width="100%" height="480" src="http://www.youtube.com/embed/<?php echo apply_filters('wplms_one_click_setup_video','HURLXtbfKVY');?>" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="changelog">
				<div class="feature-section col three-col">
					<div>
						<h4><?php _e( 'Setup Issues', 'vibe' ); ?></h4>
						<p><?php _e( 'Facing issues while setting up? Try out suggested links below.', 'vibe' ); ?></p>
						<p><a href="http://vibethemes.com/envato/wplms/documentation/quick-installation-guide.html#pre-setup"><?php _e( 'WPLMS Pre-Setup settings', 'vibe' ); ?></a><br />
						<a href="http://vibethemes.com/envato/wplms/documentation/quick-installation-guide.html"><?php _e( 'WPLMS manual installation & setup', 'vibe' ); ?></a><br />
						<?php //<a href="<?php echo admin_url( 'index.php?page=wplms-system' ); ?>">
						<?php //_e( 'WPLMS System Status', 'vibe' ); ?>
						<?php //</a><br /> ?>
						<a href="http://vibethemes.com/envato/wplms/documentation/quick-installation-guide.html#setup-issues"><?php _e( 'WPLMS FAQs', 'vibe' ); ?></a></p>
					</div>
					<div>
						<h4><?php _e( 'Popular Setup issues', 'vibe' ); ?></h4>
						<p><?php _e( 'Following is the list of most frequent setup issues faced by users', 'vibe' ); ?></p>
						<p><a href="http://vibethemes.com/documentation/wplms/knowledge-base/server-500-error-blank-white-page-after-activating-the-theme-or-one-of-its-plugins/"><?php _e( 'White screen when installed', 'vibe' ); ?></a><br />
						<a href="http://vibethemes.com/documentation/wplms/article-categories/faqs/"><?php _e( 'Course pages not opening', 'vibe' ); ?></a><br />
						<a href="http://vibethemes.com/documentation/wplms/article-categories/faqs/"><?php _e( 'Getting 404 pages', 'vibe' ); ?></a><br />
						<a href="http://vibethemes.com/documentation/wplms/article-categories/faqs/"><?php _e( 'Start Course/Take this Course not working', 'vibe' ); ?></a><br />
						</p>
					</div>
					<div class="last-feature">
						<h4><?php _e( 'Other popular issues', 'vibe' ); ?></h4>
						<p><?php _e( 'Following is the list of most frequent issues faced by users', 'vibe' ); ?></p>
						<p><a href="http://vibethemes.com/documentation/wplms/article-categories/faqs/"><?php _e( 'Quizzes not saving answers', 'vibe' ); ?></a><br />
						<a href="http://vibethemes.com/documentation/wplms/article-categories/faqs/"><?php _e( 'Visual composer not updating', 'vibe' ); ?></a><br />
						<a href="http://vibethemes.com/documentation/wplms/article-categories/faqs/"><?php _e( 'Getting 404 page on editing course', 'vibe' ); ?></a><br />
						<a href="http://vibethemes.com/documentation/wplms/article-categories/faqs/"><?php _e( 'Theme customizer not working', 'vibe' ); ?></a><br />
						</p>
					</div>
				</div>
			</div>
			<div class="return-to-dashboard">
				<a href="http://vibethemes.com/documentation/wplms/forums/"><?php _e( 'Unable to setup ? Get help on our Support forums.', 'vibe' ); ?></a>
			</div>
		</div>
		<?php
	}
	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		?>
		<div class="wrap wplms-wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog">
				<div class="wplms-feature feature-rest feature-section col two-col">
					<div class="col-1">
						<h4><?php _e( '15 bug fixes & updates', 'vibe' ); ?></h4>
						<p><?php _e( 'We\'ve fixed some pending bugs. A lot of small issues, styling issues have been fixed.', 'vibe' ); ?></p>
						<a href="http://vibethemes.com/documentation/wplms/knowledge-base/2-2-2/" class="button"><?php _e( 'Check update log ', 'vibe' ); ?></a>
					</div>
					<div class="col-2">
						<h4><?php _e( 'Minor Update', 'vibe' ); ?></h4>
						<p><?php _e( 'We resolved few bugs, the theme is more stable than ever.', 'vibe' ); ?></p>
						<a href="http://vibethemes.com/documentation/wplms/knowledge-base/2-2-2/" class="button"><?php _e( 'Check update log ', 'vibe' ); ?></a>
					</div>
				</div>
			</div>
			<div class="changelog about-integrations">
				<h3><?php _e( 'What\'s New in WPLMS', 'vibe' ); ?><span style="float:right;"><a href="https://www.youtube.com/playlist?list=PL8n4TGA_rwD_5jqsgXIxXOk1H6ar-SVCV" class="button button-primary" target="_blank"><?php _e('WPLMS Video Playlist','vibe'); ?></a></span></h3>
				
				<div class="wplms-feature feature-section col three-col">
					<div>
						<h4><?php _e( 'Live Directory Search', 'vibe' ); ?></h4>
						<p><img src="https://i.gyazo.com/cfda325ee3aec3ffeea9fefc7678929e.gif" /></p>
					</div>
					<div>
						<h4><?php _e( 'New Featured Block', 'vibe' ); ?></h4>
						<p><img src="https://i.gyazo.com/6c99f776696edbe0a714bb4463735a10.png" /></p>
					</div>
					<div class="last-feature">
						
					</div>
				</div>
			</div>
			<div class="changelog">
				<div class="feature-section col three-col">
					<div>
						<h4><?php _e( 'Caching plugins Compatibility', 'vibe' ); ?></h4>
						<p><?php _e( 'WPLMS is now fully compatible with WP Super cache and W3 Total cache plugins.', 'vibe' ); ?></p>
						<a href="hhttp://vibethemes.com/documentation/wplms/knowledge-base/wplms-with-w3-total-cache/" class="button">Tutorial</a>
					</div>
					<div>
						<h4><?php _e( 'Migrate From LearnDash to WPLMS', 'vibe' ); ?></h4>
						<p><?php _e( 'Migrate all courses, units, sections, quizzes and content from LeardDash to WPLMS in 1 single click.', 'vibe' ); ?></p>
						<a href="http://vibethemes.com/documentation/wplms/knowledge-base/migrate-from-learndash-to-wplms/" class="button">Tutorial</a>
					</div>
					<?php /*
					<div>
						<h4><?php _e( 'Updated Documentation ', 'vibe' ); ?></h4>
						<p><?php _e( 'Documentation has been updated. We\'ve added new functions & shortcodes list and developer documentation. For most updated documentation we recommend checking the online documentation doc.', 'vibe' ); ?></p>
						<a href="vibethemes.com/envato/wplms/documentation/"><?php _e( 'Check documentation','vibe'); ?></a>
					</div>
					*/ ?>
					<div class="last-feature">
						<h4><?php _e( 'Translation Collaboration', 'vibe' ); ?></h4>
						<p><?php _e( 'It is really difficult to maintain translations in a versatible project as WPLMS. Therefore we ask our users to email us translation files at support@vibethemes.com with subject "WPLMS - Translation Files".', 'vibe' ); ?></p>
						<a href="http://vibethemes.com/documentation/wplms/knowledge-base/2-2-2/"><?php _e( 'Check Translation files status','vibe'); ?></a>
					</div>
				</div>
			</div>
			<div class="return-to-dashboard">
				<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wplms_options' ), 'admin.php' ) ) ); ?>"><?php _e( 'Go to WPLMS Options panel', 'vibe' ); ?></a>
			</div>
		</div>
		<?php
	}

	/**
	 * Output the system.
	 */
	public function system_screen() {
		?>
		<div class="wrap wplms-wrap about-wrap">

			<?php $this->intro(); ?>
			<table class="wplms_status_table widefat" cellspacing="0" id="status">
				<thead>
					<tr>
						<th colspan="2"><h4><?php _e( 'Environment', 'vibe' ); ?></h4></th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td><?php _e( 'Home URL', 'vibe' ); ?>:</td>
						<td><?php echo home_url(); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'Site URL', 'vibe' ); ?>:</td>
						<td><?php echo site_url(); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'WP Version', 'vibe' ); ?>:</td>
						<td><?php bloginfo('version'); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'WP Multisite Enabled', 'vibe' ); ?>:</td>
						<td><?php if ( is_multisite() ) echo __( 'Yes', 'vibe' ); else echo __( 'No', 'vibe' ); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'Web Server Info', 'vibe' ); ?>:</td>
						<td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'PHP Version', 'vibe' ); ?>:</td>
						<td><?php if ( function_exists( 'phpversion' ) ) echo esc_html( phpversion() ); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'MySQL Version', 'vibe' ); ?>:</td>
						<td>
							<?php
							/** @global wpdb $wpdb */
							global $wpdb;
							echo $wpdb->db_version();
							?>
						</td>
					</tr>
					<tr>
						<td><?php _e( 'WP Active Plugins', 'vibe' ); ?>:</td>
						<td><?php echo count( (array) get_option( 'active_plugins' ) ); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'WP Memory Limit', 'vibe' ); ?>:</td>
						<td><?php
							$memory = $this->wplms_let_to_num( WP_MEMORY_LIMIT );
							if ( $memory < 134217728 ) {
								echo '<mark class="error">' . sprintf( __( '%s - We recommend setting memory to at least 128MB. See: <a href="%s">Increasing memory allocated to PHP</a>', 'vibe' ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
							} else {
								echo '<mark class="yes">' . size_format( $memory ) . '</mark>';
							}
						?></td>
					</tr>
					<tr>
						<td><?php _e( 'WP Debug Mode', 'vibe' ); ?>:</td>
						<td><?php if ( defined('WP_DEBUG') && WP_DEBUG ) echo '<mark class="yes">' . __( 'Yes', 'vibe' ) . '</mark>'; else echo '<mark class="no">' . __( 'No', 'vibe' ) . '</mark>'; ?></td>
					</tr>
					<tr>
						<td><?php _e( 'WP Language', 'vibe' ); ?>:</td>
						<td><?php echo get_locale(); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'WP Max Upload Size', 'vibe' ); ?>:</td>
						<td><?php echo size_format( wp_max_upload_size() ); ?></td>
					</tr>
					<?php if ( function_exists( 'ini_get' ) ) : ?>
						<tr>
							<td><?php _e('PHP Post Max Size', 'vibe' ); ?>:</td>
							<td><?php echo size_format($this->wplms_let_to_num( ini_get('post_max_size') ) ); ?></td>
						</tr>
						<tr>
							<td><?php _e('PHP Time Limit', 'vibe' ); ?>:</td>
							<td><?php echo ini_get('max_execution_time'); ?></td>
						</tr>
						<tr>
							<td><?php _e( 'PHP Max Input Vars', 'vibe' ); ?>:</td>
							<td><?php echo ini_get('max_input_vars'); ?></td>
						</tr>
						<tr>
							<td><?php _e( 'SUHOSIN Installed', 'vibe' ); ?>:</td>
							<td><?php echo extension_loaded( 'suhosin' ) ? __( 'Yes', 'vibe' ) : __( 'No', 'vibe' ); ?></td>
						</tr>
					<?php endif; ?>
					<tr>
						<td><?php _e( 'Default Timezone', 'vibe' ); ?>:</td>
						<td><?php
							$default_timezone = date_default_timezone_get();
							if ( 'UTC' !== $default_timezone ) {
								echo '<mark class="error">' . sprintf( __( 'Default timezone is %s - it should be UTC', 'vibe' ), $default_timezone ) . '</mark>';
							} else {
								echo '<mark class="yes">' . sprintf( __( 'Default timezone is %s', 'vibe' ), $default_timezone ) . '</mark>';
							} ?>
						</td>
					</tr>
				</tbody>


				<thead>
					<tr>
						<th colspan="2"><h4><?php _e( 'Settings', 'vibe' ); ?></h4></th>
					</tr>
				</thead>

				<thead>
					<tr>
						<th colspan="2"><?php _e( 'WPLMS Pages', 'vibe' ); ?></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$check_pages = array(
							_x( 'All Course page', 'Page setting', 'vibe' ) => array(
									'option' => 'bp-pages.course'
								),
							_x( 'Take this course page', 'Page setting', 'vibe' ) => array(
									'option' => 'take_course_page',
									'shortcode' => '[' . apply_filters( 'vibe_cart_shortcode_tag', 'vibe_cart' ) . ']'
								),
							_x( 'Create Course Page', 'Page setting', 'vibe' ) => array(
									'option' => 'create_course',
								),
							_x( 'Default Certificate Page', 'Page setting', 'vibe' ) => array(
									'option' => 'certificate_page',
								)
						);

						$alt = 1;

						foreach ( $check_pages as $page_name => $values ) {

							if ( $alt == 1 ) echo '<tr>'; else echo '<tr>';

							echo '<td>' . esc_html( $page_name ) . ':</td><td>';

							$error = false;

							switch($values['option']){
								case 'bp-pages.course':
									$pages=get_option('bp-pages');
									if(isset($pages) && is_array($pages) && isset($pages['course']))
										$page_id=$pages['course'];
								break;
								default:
									$page_id = vibe_get_option($values['option']);
								break;
							}
							// Page ID check
							if ( ! isset($page_id ) ){
								echo '<mark class="error">' . __( 'Page not set', 'vibe' ) . '</mark>';
								$error = true;
							} else {
								$error = false;
							}

							if ( ! $error ) echo '<mark class="yes">#' . absint( $page_id ) . ' - ' . str_replace( home_url(), '', get_permalink( $page_id ) ) . '</mark>';

							echo '</td></tr>';

							$alt = $alt * -1;
						}
					?>
				</tbody>

				<thead>
					<tr>
						<th colspan="2"><h4><?php _e( 'Templates', 'vibe' ); ?></h4></th>
					</tr>
				</thead>

				<tbody>
					<?php

						$template_paths = apply_filters( 'bp_course_load_template_filter', array( 'vibe' => BP_COURSE_MOD_PLUGIN_DIR . '/includes/templates/' ) );
						$scanned_files  = array();
						$found_files    = array();

						
						foreach ( $template_paths as $plugin_name => $template_path ) {
							$scanned_files[ $plugin_name ] = $this->scan_template_files( $template_path );
						}

						

						foreach ( $scanned_files as $plugin_name => $files ) {
							foreach ( $files as $file ) {
								if ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
									$theme_file = get_stylesheet_directory() . '/' . $file;
								} elseif ( file_exists( get_stylesheet_directory() . '/vibe/' . $file ) ) {
									$theme_file = get_stylesheet_directory() . '/vibe/' . $file;
								} elseif ( file_exists( get_template_directory() . '/' . $file ) ) {
									$theme_file = get_template_directory() . '/' . $file;
								} elseif( file_exists( get_template_directory() . '/vibe/' . $file ) ) {
									$theme_file = get_template_directory() . '/vibe/' . $file;
								} else {
									$theme_file = false;
								}

								if ( $theme_file ) {
									$core_version  = $this->get_file_version( BP_COURSE_MOD_PLUGIN_DIR . '/includes/templates/' . $file );
									$theme_version = $this->get_file_version( $theme_file );

									if ( $core_version && ( empty( $theme_version ) || version_compare( $theme_version, $core_version, '<' ) ) ) {
										$found_files[ $plugin_name ][] = sprintf( __( '<code>%s</code> version <strong style="color:red">%s</strong> is out of date. The core version is %s', 'vibe' ), str_replace( WP_CONTENT_DIR . '/themes/', '', $theme_file ), $theme_version ? $theme_version : '-', $core_version );
									} else {
										$found_files[ $plugin_name ][] = sprintf( '<code>%s</code>'.$core_version.' - '.$theme_version, str_replace( WP_CONTENT_DIR . '/themes/', '', $theme_file ) );
									}
								}
							}
						}

						if ( $found_files ) {
							foreach ( $found_files as $plugin_name => $found_plugin_files ) {
								?>
								<tr>
									<td><?php _e( 'Template Overrides', 'vibe' ); ?> (<?php echo $plugin_name; ?>):</td>
									<td><?php echo implode( ', <br/>', $found_plugin_files ); ?></td>
								</tr>
								<?php
							}
						} else {
							?>
							<tr>
								<td><?php _e( 'Template Overrides', 'vibe' ); ?>:</td>
								<td><?php _e( 'No overrides present in theme.', 'vibe' ); ?></td>
							</tr>
							<?php
						}
					?>
				</tbody>

			</table>
		</div>
		<?php
	}

	/**
	 * Output the changelog screen
	 */
	public function changelog_screen() {
		?>
		<div class="wrap wplms-wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="changelog-description">
			<p><?php printf( __( 'Full Changelog of WPLMS Theme', 'vibe' ), 'vibe' ); ?></p>

			<?php
				$file = VIBE_PATH.'/changelog.txt';
				$myfile = fopen($file, "r") or die("Unable to open file!".$file);
				while(!feof($myfile)) {
					$string = fgets($myfile);
					if(strpos($string, '* version') === 0){
						echo '<br />---------------------- * * * ----------------------<br /><br />';
					}
				  echo $string . "<br>";
				}
				fclose($myfile);
			?>
			</div>
		</div>
		<?php
	}

	function scan_template_files( $template_path ) {
		
		$files         = scandir( $template_path );
		$result        = array();
		if ( $files ) {
			foreach ( $files as $key => $value ) {
				if ( ! in_array( $value, array( ".",".." ) ) ) {
					if ( is_dir( $template_path . DIRECTORY_SEPARATOR . $value ) ) {
						$sub_files = self::scan_template_files( $template_path . DIRECTORY_SEPARATOR . $value );
						foreach ( $sub_files as $sub_file ) {
							$result[] = $value . DIRECTORY_SEPARATOR . $sub_file;
						}
					} else {
						$result[] = $value;
					}
				}
			}
		}
		return $result;
	}
	function get_file_version( $file ) {
		// We don't need to write to the file, so just open for reading.
		$fp = fopen( $file, 'r' );

		// Pull only the first 8kiB of the file in.
		$file_data = fread( $fp, 8192 );

		// PHP will close file handle, but we are good citizens.
		fclose( $fp );

		// Make sure we catch CR-only line endings.
		$file_data = str_replace( "\r", "\n", $file_data );
		$version   = '';

		if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( '@version', '/' ) . '(.*)$/mi', $file_data, $match ) && $match[1] )
			$version = _cleanup_header_comment( $match[1] );

		return $version ;
	}
	/**
	 * Sends user to the welcome page on first activation
	 */
	public function welcome() {
		// Bail if no activation redirect transient is set
	    if ( ! get_transient( '_wplms_activation_redirect' ) ) {
			return;
	    }

		// Delete the redirect transient
		delete_transient( '_wplms_activation_redirect' );
		// Bail if activating from network, or bulk, or within an iFrame
		if ( is_network_admin() || defined( 'IFRAME_REQUEST' ) ) {
			return;
		}

		if(!$this->check_installed()){
			wp_redirect( admin_url( 'index.php?page=wplms-install' ) );
		}else{
			wp_redirect( admin_url( 'index.php?page=wplms-about' ) );
		}
		exit;
	}
	function wplms_let_to_num( $size ) {
		$l   = substr( $size, -1 );
		$ret = substr( $size, 0, -1 );
		switch ( strtoupper( $l ) ) {
			case 'P':
				$ret *= 1024;
			case 'T':
				$ret *= 1024;
			case 'G':
				$ret *= 1024;
			case 'M':
				$ret *= 1024;
			case 'K':
				$ret *= 1024;
		}
		return $ret;
	}
	function check_installed(){
		$check_options_panel = get_option(THEME_SHORT_NAME);
		if(!isset($check_options_panel) || empty($check_options_panel))
			return false;

		$take_course_page = vibe_get_option('take_course_page');
		if(!isset($take_course_page) || !is_numeric($take_course_page) || empty($take_course_page))
			return false;

		return true;
	}
}




add_action('init','wplms_welcome_user');
function wplms_welcome_user(){
	new WPLMS_Admin_Welcome();	
}
