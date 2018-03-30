<?php

if(!defined('STARTUPLY_IMPORT_DIR')) {
	define('STARTUPLY_IMPORT_DIR', trailingslashit(dirname(__FILE__)));
}

if(!defined('STARTUPLY_IMPORT_URI')) {
	define('STARTUPLY_IMPORT_URI', get_template_directory_uri(). '/engine/lib/vivaco-importer/');
}

function startuply_admin_menu_enqueue() {
	wp_enqueue_style( 'startuply-import-css', STARTUPLY_IMPORT_URI.'css/startuply-import.css', false, '', 'all');

	wp_enqueue_script( 'startuply-import-js', STARTUPLY_IMPORT_URI.'js/startuply-import.js', array('jquery'), '', true);
}

function startuply_admin_menu_init() {
	if( key_exists( 'startuply_import_nonce', $_POST ) ){
		if ( wp_verify_nonce( $_POST['startuply_import_nonce'], basename(__FILE__) ) ){
			// Importer classes
			if( ! defined( 'WP_LOAD_IMPORTERS' ) ) define( 'WP_LOAD_IMPORTERS', true );

			if( ! class_exists( 'WP_Importer' ) ){
				require_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			}

			if( ! class_exists( 'WP_Import' ) ){
				require_once STARTUPLY_IMPORT_DIR . 'wordpress-importer.php';
			}

			if( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ){
				$error = null;

				if( (isset($_POST['startuply-import-demo-data']) && strlen($_POST['startuply-import-demo-data']) > 0) ||
					(isset($_POST['startuply-wordpress-reset']) && strlen($_POST['startuply-wordpress-reset']) > 0) ) {

					if( (isset($_POST['startuply-wordpress-reset']) && strlen($_POST['startuply-wordpress-reset']) > 0)) {
						startuply_wordpress_reset();

						wp_redirect( admin_url('themes.php?page=tgmpa-install-plugins') ); // if plugins are not reset - we don't really need to redirect anyone, better to show "Import was successfull message to users"
					}

					if( (isset($_POST['startuply-import-demo-data']) && strlen($_POST['startuply-import-demo-data']) > 0) ) {
						startuply_import_content();
						startuply_import_menu_location();
						startuply_import_options();
						startuply_import_widget();

						//set home & blog page
						$home = get_page_by_title( 'Home: Default' );
						$blog = get_page_by_title( 'Blog page' );
						if( $home->ID && $blog->ID ) {
							update_option('show_on_front', 'page');
							update_option('page_on_front', $home->ID); // Front Page
							update_option('page_for_posts', $blog->ID); // Blog Page
						}
					}

					// message box
					if( $error ){
						echo '<div class="error settings-error">';
							echo '<p><strong>'. $error .'</strong></p>';
						echo '</div>';
					} else {
						echo '<div class="updated settings-error">';
							echo '<p><strong>'. __('All done. Have fun!','vivaco') .'</strong></p>';
						echo '</div>';
					}
				}
			}
		}
	}
}

function startuply_import() {
	?>
	<div id="startuply-wrapper" class="startuply-import wrap">

		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

		<p><strong>*NOTE: using this importer more then once can result in duplicate content! Works best on clean WP install*</strong></p>
		<p>
			 - Before starting the import, you need to install all required theme plugins first
		</p>
		<p>
			- Import process will take time needed to download all attachments from demo web site, it can take several minutes. Closing Browser will stop the import process
		</p>

		<p>
			- Please make sure that your server able to do outbound request, we need to download some image that used on demo
		</p>

		<form action="" method="post">
			<input type="hidden" name="startuply_import_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

			<input type="hidden" name="startuply-wordpress-reset" id="startuply-wordpress-reset" value="" />
			<input type="submit" name="startuply-import-demo-data" id="startuply-import-demo-data" class="button button-primary" value="Start import" />

				<a href="#" class="reset-current-data" id="import-demo-data-with-reset">Reset current data</a>
		</form>

	</div>
	<?php
}

function startuply_import_content(){
	$import = new WP_Import();

	$file = 'startuply_demo_all.xml';
	$xml = STARTUPLY_IMPORT_DIR . 'demodata/default/'. $file;

	$import->fetch_attachments = true;

	ob_start();
	$import->import( $xml );
	ob_end_clean();
};

function startuply_import_menu_location(){
	$file = 'menu.txt';
	$file_path 	= STARTUPLY_IMPORT_URI . 'demodata/default/'. $file;

	$file_data 	= wp_remote_get( $file_path );
	$data 		= unserialize( base64_decode( $file_data['body']));
	// // build menu.txt content

	// $my_data = get_theme_mod('nav_menu_locations');
	// print_r($my_data); // hier $my_data nav area slug => id
	// echo '<br/>';

	// $my_data = array( // data nav area slug => menu Name. Not Id!!
	// 	"right_menu" => "Login/Register",
	// 	"left_menu" => "Demo menu"
	// 	);
	// echo base64_encode(serialize($my_data)).'<br/>';


	$menus 		= wp_get_nav_menus();

	foreach( $data as $key => $val ){
		foreach( $menus as $menu ){
			if( $menu->name == $val ){
				$data[$key] = absint( $menu->term_id );
			}
		}
	}
	// // debug code
	// echo '<pre>'.print_r($data, 1).'</pre><br/>';
	// echo '<pre>'.print_r($menus, 1).'</pre><br/>';

	set_theme_mod( 'nav_menu_locations', $data );
};

function startuply_import_options(){
// TODO:
};

function startuply_import_widget(){
	$params = array(
		array(
			'sidebar' => 'sidebar_footer_1',
			'widgets' => array(
				array(
					'name' => 'about_sply_widget',
					'widget_opt_name' => 'widget_about_sply_widget',
					'args' => array(
						'title' => '',
						'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco. Qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
						'author' => 'John Doeson, Founder.',
						'bg_image' => '',
					)
				)
			)
		),
		array(
			'sidebar' => 'sidebar_footer_2',
			'widgets' => array(
				array(
					'name' => 'socials_sply_widget',
					'widget_opt_name' => 'widget_socials_sply_widget',
					'args' => array(
						'title' => 'Social Networks',
						'fb_opt' => 'http://your-social-link-here.com',
						'twitter_opt' => 'http://your-social-link-here.com',
						'google_opt' => 'http://your-social-link-here.com',
						'linkedin_opt' => 'http://your-social-link-here.com',
						'instagram_opt' => 'http://your-social-link-here.com',
						'skype_opt' => 'http://your-social-link-here.com',
						'pinterest_opt' => 'http://your-social-link-here.com',
						'youtube_opt' => 'http://your-social-link-here.com',
						'soundcloud_opt' => '',
						'rss_opt' => '',
					)
				)
			)
		),
		array(
			'sidebar' => 'sidebar_footer_3',
			'widgets' => array(
				array(
					'name' => 'contacts_sply_widget',
					'widget_opt_name' => 'widget_contacts_sply_widget',
					'args' => array(
						'title' => __( 'Our Contacts', 'vivaco' ),
						'our_email' => 'office@vivaco.com',
						'our_address' => '2901 Marmora road, Glassgow,<br> Seattle, WA 98122-1090',
						'our_telephone' => '+9 500 750',
					)
				)
			)
		),
	);

	$active_widgets = get_option( 'sidebars_widgets' );

	$magick_id = 77;

	foreach ($params as $sidebar) {
		foreach ($sidebar['widgets'] as $widget) {
			$active_widgets[$sidebar['sidebar']][] = $widget['name'].'-'.$magick_id;

			$widget_options = get_option( $widget['widget_opt_name'] );
			$widget_options[$magick_id] = $widget['args'];

			update_option( $widget['widget_opt_name'], $widget_options );
		}
	}

	update_option( 'sidebars_widgets', $active_widgets );
};

function startuply_wordpress_reset(){
	/* deactivate plugins */
	$plugins = get_option('active_plugins');
	if($plugins) {
		deactivate_plugins($plugins);
	}

	/* reset wordpress */
	require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

	global $current_user;

	$blogname = get_option( 'blogname' );
	$admin_email = get_option( 'admin_email' );
	$blog_public = get_option( 'blog_public' );

	if ( $current_user->user_login != 'admin' ) {
		$user = get_user_by( 'login', 'admin' );
	}

	if ( $user === false || empty( $user->user_level ) || $user->user_level < 10 ) {
		$user = $current_user;
	}

	global $wpdb, $reactivate_wp_reset_additional;

	$prefix = str_replace( '_', '\_', $wpdb->prefix );
	$tables = $wpdb->get_col( "SHOW TABLES LIKE '{$prefix}%'" );
	foreach ( $tables as $table ) {
		if ($table !== $wpdb->prefix.'usermeta' && $table !== $wpdb->prefix.'users') {
			$wpdb->query( "DROP TABLE $table" );
		}
	}

	$result = wp_install( $blogname, $user->user_login, $user->user_email, $blog_public );
	extract( $result, EXTR_SKIP );

	$query = $wpdb->prepare( "UPDATE $wpdb->users SET user_pass = %s, user_activation_key = '' WHERE ID = %d", $user->user_pass, $user->ID );
	$wpdb->query( $query );

	if ( get_user_meta( $user->ID, 'default_password_nag' ) )
		update_user_meta( $user->ID, 'default_password_nag', false );

	if ( get_user_meta( $user->ID, $wpdb->prefix . 'default_password_nag' ) )
		update_user_meta( $user->ID, $wpdb->prefix . 'default_password_nag', false );

	if ( ! empty( $reactivate_wp_reset_additional ) ) {
		foreach ( $reactivate_wp_reset_additional as $plugin ) {
			$plugin = plugin_basename( $plugin );
			if ( ! is_wp_error( validate_plugin( $plugin ) ) )
				@activate_plugin( $plugin );
		}
	}

	wp_clear_auth_cookie();
	wp_set_auth_cookie( $user->ID );

	switch_theme('startuply');
}

?>
