<?php
/**
 * One Click Automatic Installation Module
 *
 * 1. Adds "Install Demo Content" admin notice.
 * 2. Deletes posts, pages, menus, sidebars etc.
 * 3. Imports posts, pages, menus, sidebars etc.
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit on direct entrance

/**
 * Automatic installation admin panel notice.
 *
 * @return void
 */
function flow_auto_install_notice() {
	?>
	<div id="message" class="updated au-box">
		<div class="au-title"><?php _e( '<strong>Demo Content Importer</strong>', 'flowthemes' ); ?></div>
		<p class="au-desc"><?php _e( 'Clicking the "Install Demo" button will delete all the posts, pages, comments, revisions, categories, tags, menus, news, portfolio projects, widgets, theme settings and import the demo content for your current theme. The media library items will not be deleted. If this is a fresh installation of WordPress you can safely do that. Please skip setup otherwise.', 'flowthemes' ); ?></p>
		<p class="au-links">
			<a href="<?php echo add_query_arg( array( 'flow_install_demo' => 'true', 'import' => 'wordpress' ), get_admin_url() ); ?>" class="au-install-button"><?php _e( 'Install Demo', 'flowthemes' ); ?></a> | <a class="au-skip-button" href="<?php echo add_query_arg( 'flow_hide_install_demo', 'true', get_admin_url() ); ?>"><?php _e( 'Skip Setup', 'flowthemes' ); ?></a>				
		</p>
		<?php
			$available_importers = get_importers();
			if ( ! empty( $_GET['flow_install_demo'] ) ) {
				if ( $_GET['import'] == 'wordpress' && is_array( $available_importers ) && array_key_exists( 'wordpress', $available_importers ) && class_exists( 'WP_Import' ) ) {
				} else {
					echo '<p class="au-notice">';
					echo 'WordPress Importer plugin is not installed. Please install and activate it first and then run the installer.';
					echo '</p>';
				}
			}
		?>
	</div>
<?php }

/**
 * Checks what template is being used and if it doesn't match saved one it offers a way to install demo configuration. 
 * Adds admin panel notice with "Install" button.
 *
 * @return void
 */
function flow_auto_install_print_notice() {
	$template = get_option( 'template' );
	if ( ! empty( $_GET['flow_hide_install_demo'] ) ) {
		update_option( 'flow_hide_install_demo', $template );
		return;
	}
	if ( get_option( 'flow_hide_install_demo' ) !== $template ) {
		add_action( 'admin_notices', 'flow_auto_install_notice' );
	}
	return;
}
add_action( 'admin_print_styles', 'flow_auto_install_print_notice' );

/**
 * Cleans the database.
 *
 * @return void
 */
function flow_clean_database() {
	$clean_hidden = 'clean_submit_hidden';
	if(isset($_POST[ $clean_hidden ]) && $_POST[ $clean_hidden ] == 'Y'){
		check_admin_referer('flow_clean_nonce_security');
		flow_install_theme_settings(false, false, true);
	}
	return;
}
add_action( 'admin_init', 'flow_clean_database' );

/**
 * Installs theme settings only.
 * Adds admin panel notice with "Install" button.
 *
 * @param {boolean} True to install settings (2nd priority).
 * @param {boolean} True to return settings (1st priority).
 * @param {boolean} True to uninstall settings (3rd priority).
 * @return {array|boolean} True on success, false on failure or array of settings and their values.
 */
function flow_install_theme_settings($install = false, $return = false, $uninstall = false){
	$theme_settings = array(
		// Theme Settings
		'flow_hide_install_demo' => 0,
		'flow_logo' => 'http://themes.devatic.com/daisho/wp-content/uploads/2012/10/daisho.svg',
		'custom_css_style' => '.page-id-3232 .page-header { display: none; }',
		'flow_styling' => array('.conatainer_language_selector' => array('top' => '5px', 'left' => '170px')),
		'footer_col_countcustom' => 'grid_12 last widget_no_margin, grid_6, grid_6 last',
	);
	if($return){
		return $theme_settings;
	}
	if($install && is_admin() && current_user_can('manage_options') && current_user_can('edit_theme_options')){
		foreach($theme_settings as $k => $v){
			update_option($k, $v);
		}
		return true;
	}	
	if($uninstall && is_admin() && current_user_can('manage_options') && current_user_can('edit_theme_options')){
		foreach($theme_settings as $k => $v){
			delete_option($k);
		}
		return true;
	}
	return false;
}

/**
 * 1. Deletes content.
 * 2. Imports demo content.
 * 3. Does this if 'flow_hide_install_demo' option doesn't contain the theme name yet and if user clicks "Install" button on the 'flow_auto_install_notice' notice.
 *
 * @return void
 */
function flow_auto_install_admin_init() {
	function flow_delete_everything(){
	
		// Delete posts, pages, custom post types
		$post_types = array( 'post' => 'post', 'page' => 'page', 'revision' => 'revision', 'nav_menu_item' => 'nav_menu_item', 'news' => 'news', 'portfolio' => 'portfolio' );
		$query = new WP_Query( array( 'post_status' => 'any', 'post_type' => $post_types, 'posts_per_page' => '-1', 'suppress_filters' => true ) );
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();
				$postid = get_the_ID();
				$force_delete = true;
				wp_delete_post( $postid, $force_delete );
			}
		}
		
		// Delete theme mods (nav_menu_locations, sidebars_widgets, header color etc.)
		remove_theme_mods();
		
		// Delete menus
		$menu_list = wp_get_nav_menus();
		foreach($menu_list as $menu){
			wp_delete_nav_menu($menu->term_id);
		}
		
		// Delete categories
		$taxonomies = get_taxonomies('', 'names');
		$terms = get_terms($taxonomies, 'hide_empty=0');

		foreach($terms as $term){
			if(is_object($term) && $term->taxonomy != 'link_category' && $term->taxonomy != 'post_format' && $term->taxonomy != 'nav_menu'){
				if((is_object($term) &&  $term->taxonomy == 'category') && ($term->term_id == 1 || $term->term_taxonomy_id == 1)){
				}else{
					wp_delete_term($term->term_id, $term->taxonomy);
				}
			}
		}
		return;
	}
	
	function flow_import_everything(){
	
		// Import demo posts, pages, menus, projects etc.
		$importer = new WP_Import;
		$file = get_template_directory() . '/core/auto-install/daishowordpresstheme.wordpress.2013-06-14.xml';
		
		ob_start();
		$importer->import( $file );
		ob_end_clean();
		
		// Update WordPress settings
		$theme_settings = array(
			// Theme Settings
			'info_box' => '3393',
			'flow_portfolio_page' => '3433',
			// WP Settings
			'page_on_front' => '3232',
			'page_for_posts' => '2482',
			'show_on_front' => 'page'
		);
		foreach($theme_settings as $k => $v){
			update_option($k, $v);
		}

		// Install demo settings
		flow_install_theme_settings( true, false, false );
		
		// Import Sidebars and Widgets
		$demo_widget_text = array(
			4 => array(
				'title' => 'Sidebar Heading',
				'text' => 'Search advertising focuses competitor, relying on insider information. Visualization of the concept of weakly transmits the consumer market, optimizing budgets.',
				'filter' => false,
			) ,
			5 => array(
				'title' => false,
				'text' => '<hr><div class="footer-client-logos clearfix"><img src="http://themes.devatic.com/daisho/wp-content/uploads/2012/09/client1.png" alt=""><img src="http://themes.devatic.com/daisho/wp-content/uploads/2012/09/client2y.png" alt=""><img src="http://themes.devatic.com/daisho/wp-content/uploads/2012/09/client3.png" alt=""> <img src="http://themes.devatic.com/daisho/wp-content/uploads/2012/09/client4.png" alt=""><img src="http://themes.devatic.com/daisho/wp-content/uploads/2012/09/client5.png" alt=""></div><hr>',
				'filter' => false,
			) ,
			8 => array(
				'title' => false,
				'text' => '<div class="copyright_notice">&copy; 2016 Daisho Systems. All Rights Reserved.</div>',
				'filter' => false,
			) ,
			10 => array(
				'title' => '',
				'text' => '<div class="footer-fa clearfix"><a class="fa fa-youtube" href="http://devatic.com/"></a><a class="fa fa-twitter" href="http://devatic.com/"></a><a class="fa fa-skype" href="http://devatic.com/"></a><a class="fa fa-facebook-square" href="http://devatic.com/"></a><a class="fa fa-vimeo-square" href="http://devatic.com/"></a><a class="fa fa-linkedin-square" href="http://devatic.com/"></a><a class="fa fa-google-plus-square" href="http://devatic.com/"></a></div>',
				'filter' => false,
			) ,
			'_multiwidget' => 1,
		);
		update_option( 'widget_text', $demo_widget_text );
		
		$demo_widget_categories = array ( 2 => array ( 'title' => 'Categories', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0, ), '_multiwidget' => 1, );
		update_option( 'widget_categories', $demo_widget_categories );
		
		//$demo_widget_search = array ( 2 => array ( 'title' => 'Search', ), '_multiwidget' => 1, );
		//update_option( 'widget_search', $demo_widget_search );
		
		$demo_widget_nav_menu = array ( 2 => array ( 'title' => 'Pages', 'nav_menu' => 32, ), '_multiwidget' => 1, );
		update_option( 'widget_nav_menu', $demo_widget_nav_menu );
		
		$demo_widget_tag_cloud = array ( 2 => array ( 'title' => false, 'taxonomy' => 'post_tag', ), '_multiwidget' => 1, );
		update_option( 'widget_tag_cloud', $demo_widget_tag_cloud );
		
		$demo_sidebars = array ( 'wp_inactive_widgets' => array ( ), 'sidebar-1' => array ( 0 => 'nav_menu-2', 1 => 'text-4', 2 => 'categories-2', 3 => 'tag_cloud-2', ), 'flow-footer-1' => array ( 0 => 'text-5', ), 'flow-footer-2' => array ( 0 => 'text-8', ), 'flow-footer-3' => array ( 0 => 'text-10', ), );
		update_option( 'sidebars_widgets', $demo_sidebars );

		// Attach menus
		$menu_obj = get_terms( 'nav_menu' );
		$menu_locations = get_nav_menu_locations();
		if(is_array($menu_obj) && !empty($menu_obj)){
			foreach($menu_obj as $single_menu){
				if($single_menu->slug == 'main-menu'){
					$menu_locations['main_menu'] = $single_menu->term_id;
				}
				if($single_menu->slug == 'mobile-menu'){
					$menu_locations['mobile_menu'] = $single_menu->term_id;
				}
			}
			set_theme_mod( 'nav_menu_locations', $menu_locations );
		}
	}
	
	$template = get_option( 'template' );
	$available_importers = get_importers();
	
	if( ! empty( $_GET['flow_install_demo'] ) &&
		$_GET['import'] == 'wordpress' &&
		is_array( $available_importers ) &&
		array_key_exists( 'wordpress', $available_importers ) &&
		class_exists( 'WP_Import' ) &&
		get_option( 'flow_hide_install_demo' ) !== $template &&
		current_user_can( 'edit_theme_options' ) &&
		current_user_can( 'manage_options' ) &&
		current_user_can( 'delete_pages' ) &&
		current_user_can( 'delete_posts' ) &&
		current_user_can( 'import' )
	) {
		flow_delete_everything();
		flow_import_everything();
		
		// Flush rules after install
		flush_rewrite_rules();

		update_option( 'flow_hide_install_demo', $template );
		
		wp_redirect( esc_url( remove_query_arg( array( 'flow_install_demo', 'import' ) ) ) );
		exit;
	}
}
add_action( 'admin_init', 'flow_auto_install_admin_init' );
