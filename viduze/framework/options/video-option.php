<?php
/**
 * API for creating admin panel
 *
 * @package CP API
 * @subpackage Admin
 */

/*=============================================================================*
 * Admin Page
 *=============================================================================*/ 
abstract class CP_Panel {
	protected $layout_like = 'dashboard'; // postnew, dashboard, settings
	protected $layout_columns; // postnew(max=>2, default=>2), dashboard(max=>4, default=>1) 
	
	protected $menu_slug;
	protected $plugin_file;
	
	protected $submenu = false;
	protected $buttons = array('save', 'reset', 'toggle');

	/*======================================================================*
	 *	Registration Component
	 *======================================================================*/
	private static $registered = array();
	
	static function register( $class ) {
		if ( isset( self::$registered[$class] ) )
			return false;
			
		self::$registered[$class] = $class;
		
		add_action('_admin_menu', array(__CLASS__, '_register_panel'));
		
		return true;
	}
	
	static function unregister( $class ) {
		if ( ! isset( self::$registered[$class] ) )
			return false;

		unset( self::$registered[$class] );

		return true;
	}
	
	static function _register_panel() {
		foreach(self::$registered as $class) {
			new $class();
		}
	}
	
	/*======================================================================*
	 *	Main Method
	 *======================================================================*/
	function CP_Panel() {
		$this->__construct();
	}
	
	function __construct() {
		global $plugin_page;
		
		if($this->layout_like == 'dashboard')
			$this->layout_columns = !empty($this->layout_columns) ? $this->layout_columns : array('max'=>4, 'default'=>1);
		elseif($this->layout_like == 'postnew')
			$this->layout_columns = !empty($this->layout_columns) ? $this->layout_columns : array('max'=>2, 'default'=>2);

		$this->donate_url = !empty($this->donate_url) ? $this->donate_url : 'http://dedepress.com/donate/';
		$this->support_url = !empty($this->support_url) ? $this->support_url : 'http://dedepress.com/support/';
		$this->translating_url = !empty($this->translating_url) ? $this->translating_url : 'http://dedepress.com/';
		$this->menu_slug = !empty($this->menu_slug) ? $this->menu_slug : '';

		
		/* Add menu pages and meta boxes */
		add_action('admin_menu', array(&$this, 'add_menu_pages'));
		add_action('admin_menu', array(&$this, 'add_meta_boxes'));
		

		add_action('admin_init', array(&$this, 'hello'));
		
		$current_page = !empty( $_GET['page'] ) ? $_GET['page'] : '';
		if( $current_page != $this->menu_slug )
			return;
		
		add_action('admin_menu', array(&$this, 'update'), 2);
		add_action('admin_menu', array(&$this, 'add_settings_sections') );

		/* Set screen layout columns */
		add_action('admin_head', array(&$this, 'custom_screen_options'), 0); // for wp 3.1 or higher
		
		// Print default scripts and styles

		// Add admin notices
		add_action('admin_notices', array(&$this, 'admin_notices'));
		
		// Filtering pluginn action links and plugin row meta
		add_filter( 'plugin_action_links', array(&$this, 'plugin_action_links'),  10, 2 );
		add_filter( 'plugin_row_meta', array(&$this, 'plugin_row_meta'),  10, 2 );
	}
	
	function add_menu_pages() {
		
	}
	
	function add_meta_boxes() {
	
	}
	
	function add_settings_sections() {
		
	}
	
	function add_default_meta_boxes($meta_boxes = array()) {
		global $plugin_page;
		$page_hook = get_plugin_page_hookname( $plugin_page, '' );
		
		if(in_array('plugin-info', $meta_boxes) && $this->plugin_file)
			add_meta_box('plugin-info-meta-box', __('Plugin Info', 'dp'), array(&$this, 'plugin_info_meta_box'), $page_hook, 'side' );
		
		if(in_array('theme-info', $meta_boxes))
			add_meta_box('theme-info-meta-box', __('Theme Info', 'dp'), array(&$this, 'theme_info_meta_box'), $page_hook, 'side' );
		
		if(in_array('like-this', $meta_boxes))
			add_meta_box('like-this-meta-box', __('Like This?', 'dp'), array(&$this, 'like_this_meta_box'), $page_hook, 'side' );
		
		if(in_array('need-support', $meta_boxes))
			add_meta_box('need-support-meta-box', __('Need Support?', 'dp'), array(&$this, 'need_support_meta_box'), $page_hook, 'side' );
		
		if(in_array('quick-preview', $meta_boxes))
			add_meta_box('quick-preview-meta-box', __('Quick Preview', 'dp'), array(&$this, 'quick_preview_meta_box'), $page_hook, 'side' );
	}
	
	/*======================================================================*
	 *	Default Meta boxes 
	 *======================================================================*/
	function plugin_info_meta_box() {
		if( !$this->plugin_file )
			return;
		
		$plugin_data = get_plugin_data( trailingslashit(WP_PLUGIN_DIR) . $this->plugin_file, false);

		echo '<p>' . __('Name:', 'dp') . ' <a target="_blank" href="'.$plugin_data['PluginURI'].'"><strong>' . $plugin_data['Name'] . '</strong></a></p>';
		echo '<p>' . __('Version:', 'dp') . ' ' .$plugin_data['Version'] . '</p>';
		echo '<p>' . __('Author:', 'dp') . ' <a href="'.$plugin_data['AuthorURI'].'">' . $plugin_data['Author'] . '</a></p>';
		echo '<p>' . __('Description:', 'dp') . ' '. $plugin_data['Description'] . '</span></p>';
	}
	
	function theme_info_meta_box() {
		if(function_exists('wp_get_theme'))
			$theme_data = wp_get_theme();
		else
			return;

		echo '<p>' . __('Name:', 'dp') . ' <a target="_blank" href="'.$theme_data['URI'].'"><strong>' . $theme_data['Name'] . '</strong></a></p>';
		echo '<p>' . __('Version:', 'dp') . ' ' .$theme_data['Version'] . '</p>';
		echo '<p>' . __('Author:', 'dp') . ' <a href="'.$theme_data['AuthorURI'].'">' . $theme_data['Author'] . '</a></p>';
		echo '<p>' . __('Description:', 'dp') . ' '. $theme_data['Description'] . '</span></p>';
	}
	
	function like_this_meta_box() {
		echo '<p>' . __('We spend a lot of effort on Free WordPress development. Any help would be highly appreciated. Thanks!', 'dp') . '</p>';
		echo '<ul>';
		
		$plugin_data = get_plugin_data( trailingslashit(WP_PLUGIN_DIR) . $this->plugin_file, false);
		
		echo '<li class="link-it"><a href="' . $plugin_data['PluginURI']. '">' . __('Link to it so others can find out about it', 'dp') . '</a></li>';

		if( !empty($this->wp_plugin_url) )
			echo '<li class="rating-it"><a href="' . $this->wp_plugin_url . '">' . __('Give it a good rating on WordPress.org', 'dp') . '</a></li>';
		
		if( !empty($this->donate_url) )
			echo '<li class="donate-it"><a href="' . $this->donate_url. '">' . __('Donate something to our team', 'dp') . '</a></li>';
		
		if( !empty($this->translating_url) )
			echo '<li class="trans-it"><a href="' . $this->translating_url. '">' . __('Help us translating it', 'dp') . '</a></li>';
			
		echo '</ul>';
	}
	
	function need_support_meta_box() {
		echo '<p>';
		echo sprintf(__('If you have any problems or ideas for improvements or enhancements, please use the <a href="%s">Our Support Forums</a>.', 'dp'), $this->support_url );
		echo '</p>';
	}
	
	/*======================================================================*
	 *	Default Callback Functions 
	 *======================================================================*/
	/**
	 * Default meta box callback function
	 * @since 0.7
	 */
	function meta_box($object, $box) {
		$defaults = $this->fields();		
		if(!isset($defaults[$box['id']]))
			return;
		$defaults = $defaults[$box['id']];

		$new_fields = dp_instance_fields($defaults);
		dp_form_fields($new_fields);
	}
	
	/**
	 * Default settings section callback function
	 * @since 0.8
	 */
	function settings_section($section) {
		$defaults = $this->fields();		
		if(!isset($defaults[$section['id']]))
			return;
			
		$defaults = $defaults[$section['id']];

		$new_fields = dp_instance_fields($defaults);
		dp_form_fields($new_fields);
	}
	
	/*======================================================================*
	 *	Update and Reset
	 *======================================================================*/
	/**
	 * Update Settings.
	 * @since 0.1
	 */
	function update() {
		$defaults = $this->defaults();
		
		if( !is_array($defaults) || empty($defaults) || !isset($_GET['page']) || $_GET['page'] != $this->menu_slug)
			return;
		
		// Save the settings when user click "Save" Button
		if (isset($_POST['save'])) {
				
			foreach( $defaults as $option_name => $option_value) {
				$value = null;
				if(!empty($_POST[$option_name]))
					$value = $_POST[$option_name];
				if ( !is_array($value) )
					$value = trim($value);
				$value = stripslashes_deep($value);
				
				update_option($option_name, $value);
			}
			
			do_action('dp_update_settings');
			do_action('dp_save_settings');
			
			$args = array_filter(array(
				'page' => $_REQUEST['page'],
				'updated' => true
			));
			wp_redirect( add_query_arg($args, get_current_url(false)) );
			exit();
		}
		
		// Reset settings to defaults when user click "Reset" button or settings is empty.
		elseif(isset($_POST['reset'])) {
			foreach($defaults as $option_name => $option_value) {
				update_option($option_name, $option_value);
			}
			
			do_action('dp_update_settings');
			do_action('dp_reset_settings');
			
			$args = array_filter(array(
				'page' => $_REQUEST['page'],
				'reset' => true
			));
			wp_redirect( add_query_arg($args, get_current_url(false)) );
			exit();
		}
		
		/* global $wp_rewrite;
		$wp_rewrite->flush_rules(); */
	}
	
	function hello() {
		$hello = get_option($this->menu_slug.'_say_hello');
		
		$defaults = $this->defaults();
		
		if( !is_array($defaults) || empty($defaults))
			return;
		
		if(!$hello) {
			foreach($defaults as $option_name => $option_value) {
				update_option($option_name, $option_value);
			}
			
			update_option($this->menu_slug.'_say_hello', true);
		}
		
		/*global $wp_rewrite;
		$wp_rewrite->flush_rules();*/
		
		return;
	}
	
	/*======================================================================* 
	 *	General filters
	 *======================================================================*/
	/**
	 * Generate a standard admin notice
	 * @since 0.7
	 */
	function admin_notices() {
		global $parent_file;
		
		if ( !isset($_GET['page']) || $_GET['page'] != $this->menu_slug )
			return;
			
		global $read_notice;
		$read_notice = false;
		
		if($read_notice)
			return false;
		
		if (!empty($_GET['updated']) && $parent_file != 'options-general.php')
			echo '<div id="message" class="updated"><p><strong>' . __('Settings Saved.', 'dp') . '</strong></p></div>';

		elseif (!empty($_GET['reset']))
			echo '<div id="message" class="updated"><p><strong>' . __('Settings Reset.', 'dp') . '</strong></p></div>';
			
		$read_notice = true;
	}
	
	function screen_layout_columns($columns, $screen) {
		$columns[$screen] = $this->layout_columns;
		
		return $columns;
	}
	
	function custom_screen_options() {
		if($this->layout_columns)
			add_screen_option('layout_columns', $this->layout_columns);
	}

	/*======================================================================* 
	 *	Plugin filters
	 *======================================================================*/
	function plugin_action_links( $actions, $plugin_file ) {
			if ( $plugin_file == $this->plugin_file && $this->settings_url)
				$actions[] = '<a href="'.$this->settings_url.'">' . __('Settings', 'dp') .'</a>';
			
			return $actions;
		}
	
	function plugin_row_meta( $plugin_meta, $plugin_file ){
			if ( $plugin_file == $this->plugin_file ) {
				$plugin_meta[] = '<a href="'.$this->donate_url.'">' . __('Donate', 'dp') .'</a>';
				$plugin_meta[] = '<a href="'.$this->support_url.'">' . __('Support', 'dp') .'</a>';
			}

			return $plugin_meta;
		}
	
	/*======================================================================* 
	 *	Theme filters
	 *======================================================================*/
	function theme_action_links($links) {

		 $links[] = '<a href="'.admin_url('options.php').'">' . __('Settings', 'dp') .'</a>';
		return $links;
	}
	
	/*======================================================================*/
	/* Render Functions
	/*======================================================================*/
	function screen_icon() {
		echo '<a target="_blank" href="http://dedepress.com">' . get_screen_icon('themes') . '</a>';
	}
	
	function submenu() {
		if(!$this->submenu)
			return false;
			
		global $plugin_page, $submenu, $parent_file; 
		$i = 0;
		
		if(!isset($submenu[$parent_file]) || !is_array($submenu[$parent_file]))
			return;
		
		echo '<ul class="subsubsub">';
		foreach($submenu[$parent_file] as $sub) {
			echo '<li>';
			if($i > 0) echo " | ";
			$i++;
			$class = '';
			if($sub[2] == $plugin_page)
				$class = ' class="current"';
			echo '<a'.$class.' href="'.esc_url(admin_url('admin.php?page=' . $sub[2])).'">'.$sub[0].'</a></li>'; 
		}
		echo '</ul>';
	}
	
	function page_buttons($in_top = false) {
		if(in_array('save', $this->buttons))
			echo '<input type="submit" name="save" value="'.__('Save Changes', 'dp').'" class="button-primary"> ';
		
		if(in_array('reset', $this->buttons))
			echo '<input type="submit" value="'.__('Reset Settings', 'dp').'" name="reset" class="reset button button-highlighted"> ';
		
		if(in_array('toggle', $this->buttons) && $this->layout_like != 'settings' && $in_top)
			echo '<input type="button" class="button toggel-all" value="'.__('Toggle Boxes', 'dp').'" />';
	}
	
	function page_title() { ?>
		<h2>
			<?php echo get_admin_page_title(); ?>
			<?php $this->page_buttons(true); ?>
		</h2>
	<?php }
	
	function menu_page() {  
		global $parent_file, $plugin_page, $page_hook, $typenow, $hook_suffix, $pagenow, $current_screen, $wp_current_screen_options, $screen_layout_columns; 
		$screen = get_current_screen();
		?>
		<div class="wrap dp-panel">
			<form method="post" action="">
				<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
				<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
				
				<?php $this->screen_icon(); ?>
				<?php $this->page_title(); ?>
				<?php $this->submenu(); ?>
				
				<br class="clear" />
				
				<?php 
					if($this->layout_like == 'dashboard') {
						$this->metabox_holder_like_dashboard();
					} elseif($this->layout_like == 'postnew') {
						$this->metabox_holder_like_postnew();
					} elseif($this->layout_like == 'settings') {
						do_settings_sections($screen->id); 
					}
				?>
				
				<br class="clear" />
				<?php $this->page_buttons(); ?>
				
				<span class="pickcolor"></span>
				<div id="colorpicker" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
			</form>
		</div><!-- end .wrap -->
	<?php }
	
	function metabox_holder_like_dashboard() {
		global $wp_version, $screen_layout_columns;
	
		$screen = get_current_screen();
		
		$class = $hide2 = $hide3 = $hide4 = '';
		
		if($wp_version >= 3.4)
			$class = 'columns-' . get_current_screen()->get_columns();
		else {
			switch ( $screen_layout_columns ) {
				case 4:
					$width = 'width:25%;';
				break;
				case 3:
					$width = 'width:33.333333%;';
					$hide4 = 'display:none;';
					break;
				case 2:
					$width = 'width:50%;';
					$hide3 = $hide4 = 'display:none;';
					break;
				default:
						$width = 'width:100%;';
				$hide2 = $hide3 = $hide4 = 'display:none;';
			}
		} ?>
		
	<div id="dashboard-widgets" class="metabox-holder <?php echo $class; ?>">
		<div id="postbox-container-1" class="postbox-container" style="<?php echo $width; ?>">
			<?php do_meta_boxes($screen->id, 'normal', null); ?>
		</div><!-- end .postbox-container -->
				
		<div id="postbox-container-2" class="postbox-container" style="<?php echo $hide2.$width; ?>">
			<?php do_meta_boxes($screen->id, 'side', null); ?>
		</div><!-- end .postbox-container -->
					
		<div id="postbox-container-3" class="postbox-container" style="<?php echo $hide3.$width; ?>">
			<?php do_meta_boxes($screen->id, 'column3', null); ?>
		</div><!-- end .postbox-container -->
					
		<div id="postbox-container-4" class="postbox-container" style="<?php echo $hide4.$width; ?>">
			<?php do_meta_boxes($screen->id, 'column4', null); ?>
		</div><!-- end .postbox-container -->
		
	</div><!-- end .metabox-holder -->
	<?php }

	function metabox_holder_like_postnew() {
		global $screen_layout_columns;

		$screen = get_current_screen(); ?>
		<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
			<div class="inner-sidebar">
				<?php do_meta_boxes($screen->id, 'side', null); ?>
			</div><!-- end .innser-sidebar -->
			
			<div id="post-body">
				<div id="post-body-content">
					<?php do_meta_boxes($screen->id, 'normal', null); ?>
				</div><!-- end #post-body-conent -->
			</div><!-- end #post-body -->
		</div><!-- end .metabox-holder -->
	<?php }
	
	/*======================================================================* 
	 * Fields and Defaults
	 *======================================================================*/
	
	function fields() {
		$fields = array();
			
		return $fields;
	}
	
	/* Get default options from fields  */
	function defaults( $fields = array() ) {
		if(!$fields)
			$fields = $this->fields();
			
		if(empty($fields) || !is_array($fields))
			return;
			
		$defaults = array();
		
		foreach($fields as $box_id => $box_fields) {
			foreach(dp_field_options($box_fields) as $name => $field) {
				$defaults[$name] = $field;
			}
		}
		
		return $defaults;
	}
	
	/*======================================================================* 
	 * Scripts and Styles
	 *======================================================================*/
	
	/**
	 * Add default scripts.
	 *
	 * @since 1.0
	 */
	function default_scripts() {
		if( !isset($_GET['page']) || $_GET['page'] != $this->menu_slug )
			return;
		
		wp_enqueue_script('postbox');
		wp_enqueue_script('post');
		dp_enqueue_admin_styles();
		dp_enqueue_admin_scripts();
	}
	
	/**
	 * Add default styles
	 *
	 * @since 1.0
	 */
	function default_styles() {
		if (!isset($_GET['page']) || $_GET['page'] != $this->menu_slug)
			return;
			
		dp_enqueue_admin_styles();
	}
}

function dp_register_panel($class) {
	CP_Panel::register($class);
}

function dp_unregister_panel($class) {
	CP_Panel::unregister($class);
}


/*=============================================================================*
 * Post Meta Box
 *=============================================================================*/ 
abstract class CP_Post_Panel {
	protected $name;
	protected $title;
	protected $post_types;
	
	protected $nonce;
	protected $nonce_action;
	
	
	/*======================================================================*
	 *	Registration Component
	 *======================================================================*/

	private static $registered = array();
	
	static function register( $class ) {
		if ( isset( self::$registered[$class] ) )
			return false;
			
		self::$registered[$class] = $class;
		
		add_action('admin_init', array(__CLASS__, '_register'));
		
		return true;
	}
	
	static function unregister( $class ) {
		if ( ! isset( self::$registered[$class] ) )
			return false;

		unset( self::$registered[$class] );

		return true;
	}
	
	static function _register() {
		foreach(self::$registered as $class) {
			new $class();
		}
	}
	
	/*======================================================================*
	 *	Main Method
	 *======================================================================*/
	function CP_Post_Panel() {
		$this->__construct();
	}
	
	function __construct() {
		$fields = $this->fields();
		if(!$this->name || empty($fields) || !is_array($fields))
			return;
		
		$this->nonce = !empty($this->nonce) ? $this->nonce : $this->name.'_nonce';
		$this->nonce_action = !empty($this->nonce_action) ? $this->nonce_action : plugin_basename(__FILE__);
		$this->post_types = !empty($this->post_types ) ? (array) $this->post_types : get_post_types(array(), 'names');
		
		add_action( 'save_post', array(&$this, 'handle'), 10, 2);
		add_action( 'add_meta_boxes', array(&$this, 'add_meta_boxes') );
		
		foreach($fields as $field) {
			if($field['type'] == 'image_id' && class_exists('MultiPostThumbnails'))
				new MultiPostThumbnails(array( 'label' => $field['label'], 'id' => $field['name']) );
		}
	}

	function add_meta_boxes() {
		foreach($this->post_types as $post_type) {
			add_meta_box($this->name, $this->title, array(&$this, 'meta_box'), $post_type, 'normal', 'high');
		}
	}
	
	function meta_box($object, $box) {
		/*dp_enqueue_admin_styles();
		dp_enqueue_admin_scripts();*/
		
		global $post;
		$defaults = $this->fields();
		if(empty($defaults) || !is_array($defaults))
			return;
			
		$new_fields = dp_instance_fields($defaults, 'post_meta');
		
		wp_nonce_field( $this->nonce_action, $this->nonce );
		echo '<div class="dp-panel">';
		echo dp_form_fields($new_fields);
		echo '</div>';
	}
	
	function handle($post_id, $post) {
		if (!isset( $_POST[$this->nonce] ) || !wp_verify_nonce( $_POST[$this->nonce], $this->nonce_action ) || !in_array($post->post_type, $this->post_types))
			return $post_id;
			
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		
		$fields = $this->fields();
		
		if(empty($fields))
			return;

		foreach ( dp_field_options($fields) as $name => $field) {
			
			$meta_value = get_post_meta( $post_id, $name, true );
		
			$new_meta_value = $_POST[ $name ];
			
			if(is_array($new_meta_value))
				$new_meta_value = array_filter($new_meta_value);
			elseif(!empty($file['type']) && $field['type'] == 'password')
				$new_meta_value = md5($new_meta_vlue);
			
			if ( $new_meta_value && empty($meta_value) )
				add_post_meta( $post_id, $name, $new_meta_value, true );

			elseif ( $new_meta_value && $new_meta_value != $meta_value )
				update_post_meta( $post_id, $name, $new_meta_value );
			elseif ( empty($new_meta_value) && $meta_value )
				delete_post_meta( $post_id, $name, $meta_value );
			
		}
	}
	
	function fields( $post_type = '') {
		$fields = array();
		
		return $fields;
	}
}

function dp_register_post_panel($class) {
	CP_Post_Panel::register($class);
}

function dp_unregister_post_panel($class) {
	CP_Post_Panel::unregister($class);
}


/*=============================================================================*
 * Term Meta Box
 *=============================================================================*/
abstract class CP_Term_Panel {
	protected $name;
	protected $title;
	protected $taxonomies;
	
	protected $nonce;
	protected $nonce_action;
	
	/*======================================================================*
	 *	Registration Component
	 *======================================================================*/

	private static $registered = array();
	
	static function register( $class ) {
		
		if ( isset( self::$registered[$class] ) )
			return false;
			
		self::$registered[$class] = $class;
		
		add_action('_admin_menu', array(__CLASS__, '_register'));
		
		return true;
	}
	
	static function unregister( $class ) {
		if ( ! isset( self::$registered[$class] ) )
			return false;

		unset( self::$registered[$class] );

		return true;
	}
	
	static function _register() {		
		foreach(self::$registered as $class) {
			new $class();
		}
	}
	
	function CP_Term_Panel() {
		$this->__construct();
	}
	
	function __construct() {
		if(!$this->name)
			return;

		$this->nonce = !empty($this->nonce) ? $this->nonce : $this->name.'_nonce';
		$this->nonce_action = !empty($this->nonce_action) ? $this->nonce_action : plugin_basename(__FILE__);
		
		add_action('admin_menu', array(&$this, 'edit_term_form_action'));
		add_action('edit_term', array(&$this, 'handle'), 10, 3);
	}
	
	function edit_term_form_action() {
		$this->taxonomies = !empty($this->taxonomies ) ? (array)$this->taxonomies : get_taxonomies(array('show_ui' => true));
		
		foreach ($this->taxonomies as $taxonomy) { 
			add_action($taxonomy . '_edit_form', array(&$this, 'meta_box'), 10, 2);
			// add_action($taxonomy . '_add_form_fields', array(&$this, 'tax_form_fields'), 10);
		}
	}
	
	function tax_form_fields($taxonomy) {
		$this->meta_box('', $taxonomy);
	}
	
	function meta_box($term, $taxonomy) {
		if($this->title)
			echo '<h3>'.$this->title.'</h3>';
		
		$defaults = $this->fields();
		if(empty($defaults) || !is_array($defaults))
			return;
			
		$new_fields = dp_instance_fields($defaults, 'term_meta', $term);
		
		wp_nonce_field( $this->nonce_action, $this->nonce );
		echo dp_form_fields($new_fields);
	}
	
	function handle($term_id, $tt_id, $taxonomy) {
		if (!isset( $_POST[$this->nonce] ) || !wp_verify_nonce( $_POST[$this->nonce], $this->nonce_action ))
			return $term_id;

		$fields = $this->fields();

		foreach ( dp_field_options($fields) as $name => $field ) {
			$meta_value = get_term_meta( $term_id, $name, true );
			
			$new_meta_value = $_POST[$name];
			
			if(is_array($new_meta_value))
				$new_meta_value = array_filter($new_meta_value);
			elseif($field['type'] == 'password')
				$new_meta_value = md5($new_meta_vlue);
				
			if ( $new_meta_value && empty($meta_value) )
				add_term_meta( $term_id, $name, $new_meta_value, true );
				
			elseif ( $new_meta_value && $new_meta_value != $meta_value )
				update_term_meta( $term_id, $name, $new_meta_value );
				
			elseif ( empty($new_meta_value) && $meta_value )
				delete_term_meta( $term_id, $name, $meta_value );
		}
	}
	
	function fields($type = '') {
		return $fields;
	}
}

function dp_register_term_panel($class) {
	CP_Term_Panel::register($class);
}

function dp_unregister_term_panel($class) {
	CP_Term_Panel::unregister($class);
}

/*=============================================================================*
 * User Meta Box
 *=============================================================================*/
abstract class CP_User_Panel {
	protected $name;
	protected $title;
	
	protected $nonce;
	protected $nonce_action;
	
	function CP_User_Panel() {
		$this->__construct();
	}
	
	function __construct() {
		if(!$this->name)
			return;
		
		$this->nonce = !empty($this->nonce) ? $this->nonce : $this->name.'_nonce';
		$this->nonce_action = !empty($this->nonce_action) ? $this->nonce_action : plugin_basename(__FILE__);
		
		add_action( 'personal_options_update', array(&$this, 'handle') );
		add_action( 'edit_user_profile_update', array(&$this, 'handle') );
		add_action( 'admin_menu', array(&$this, 'add_meta_boxes') );
	}
	
	function add_meta_boxes() {
		add_action( 'show_user_profile', array(&$this, 'meta_box') );
		add_action( 'edit_user_profile', array(&$this, 'meta_box') );
	}
	
	function meta_box($user) {
		if($this->title)
			echo '<h3>'.$this->title.'</h3>';
		
		$defaults = $this->fields();
		if(empty($defaults) || !is_array($defaults))
			return;
			
		$new_fields = dp_instance_fields($defaults, 'user_meta', $user);
		
		wp_nonce_field( $this->nonce_action, $this->nonce );
		echo dp_form_fields($new_fields);
		
	}
	
	function handle($user_id) {
		if (!isset( $_POST[$this->nonce] ) || !wp_verify_nonce( $_POST[$this->nonce], $this->nonce_action ))
			return $user_id;
		
		$fields = $this->fields();
		
		if(empty($fields))
			return;
		
		foreach ( dp_field_options($fields) as $name => $field) {
			$meta_value = get_user_meta( $user_id, $name, true );
			
		
			$new_meta_value = $_POST[ $name ];
			
			if(is_array($new_meta_value))
				$new_meta_value = array_filter($new_meta_value);
			elseif($field['type'] == 'password')
				$new_meta_value = md5($new_meta_vlue);
				
			if ( $new_meta_value && empty($meta_value) )
				add_user_meta( $user_id, $name, $new_meta_value, true );
			elseif ( $new_meta_value && $new_meta_value != $meta_value )
				update_user_meta( $user_id, $name, $new_meta_value );
			elseif ( empty($new_meta_value) && $meta_value )
				delete_user_meta( $user_id, $name, $meta_value );
		}
	}
	
	function fields( $post_type = '') {
		$fields = array();
		
		return $fields;
	}
	
	/*======================================================================*
	 *	Registration Component
	 *======================================================================*/

	private static $registered = array();
	
	static function register( $class ) {
		if ( isset( self::$registered[$class] ) )
			return false;
			
		self::$registered[$class] = $class;
		
		add_action('_admin_menu', array(__CLASS__, '_register'));
		
		return true;
	}
	
	static function unregister( $class ) {
		if ( ! isset( self::$registered[$class] ) )
			return false;

		unset( self::$registered[$class] );

		return true;
	}
	
	static function _register() {
		foreach(self::$registered as $class) {
			new $class();
		}
	}
}

function dp_register_user_panel($class) {
	CP_User_Panel::register($class);
}

function dp_unregister_user_panel($class) {
	CP_User_Panel::unregister($class);
}

/*=============================================================================*
 * Hacks
 *=============================================================================*/

/**
 * Make a fix for per page screen option on the custom plugin page
 */
add_filter('set-screen-option', 'dp_set_screen_option_filter', 999, 3);
function dp_set_screen_option_filter($status, $option, $value) {
	$value = (int) $value;
	if ( $value < 1 || $value > 999 )
		return false;
	else
		return $value;
}


	
		function add_meta_boxes(){
		add_meta_box( 'dp-general-settings', __('General Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'dp-custom-labels-settings', __('Custom Labels Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		
		add_meta_box( 'dp-design-settings', __('Design Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'dp-header-settings', __('Header Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'dp-footer-settings', __('Footer Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		
		add_meta_box( 'dp-video-settings', __('Video Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		
		add_meta_box( 'dp-archive-settings', __('Archive Pages Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'dp-cat-featured-settings', __('Category Featured Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'dp-single-settings', __('Single Post Pages Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'dp-post-likes-settings', __('Post Likes Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'dp-hook-settings', __('Hook Settings', 'dp'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
	}
	
	function fields(){
		$fields = array(
			// Fields for Archive Settings
			'dp-archive-settings' => array(
				array(
					'type' => 'description',
					'value' => __('These settings determine how to display content on archive pages.', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_loop_actions_status',
					'value' => true,
					'title' => __('Loop Actions', 'dp'),
					'label' => __('Check this to show "Loop Actions" bar', 'dp')
				),
				array(
					'name' => 'dp_sort_types_order'
				),
				array(
					'name' => 'dp_sort_types',
					'callback' => 'dp_sort_types_settings',
					'value' => dp_supported_sort_types()
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_sort_order',
					'value' => true,
					'title' => __('Sort Order', 'dp'),
					'label' => __('Check this to show ASC/DESC order', 'dp')
				),
				array(
					'name' => 'dp_view_types_order'
				),
				array(
					'name' => 'dp_view_types',
					'callback' => 'dp_view_types_settings',
					'value' => dp_supported_view_types()
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_archive_ajaxload',
					'value' => true,
					'title' => __('Ajaxload', 'dp'),
					'label' => __('Check this to enble Ajax video on archive pages (Only works with "List Large" view)', 'dp')
				)
			),
			
			// Fields for Category Featured Settings
			'dp-cat-featured-settings' => array(
				array(
					'name' => 'dp_cat_featured',
					'callback' => 'dp_cat_featured_settings'
				),
				array(
					'name' => 'dp_cat_featured[posts_per_page]',
					'value' => 15
				)
			),
			
			// Fields for Custom Labels Settings
			'dp-custom-labels-settings' => array(
				array(
					'type' => 'description',
					'value' => __("These settings enable you to change the labels of WordPress built-in post type 'post', to 'Videos', or whatever you want to name it.", 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_post_labels_status',
					'title' => __('Custom Labels', 'dp'),
					'label' => __('check this to enable custom labels for post type "post"?', 'dp'),
					'value' => false
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[name]',
					'title' => __('name', 'dp'),
					'value' => __('Videos', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[singular_name]',
					'title' => __('singular_name', 'dp'),
					'value' => __('Video', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[add_new]',
					'title' => __('add_new', 'dp'),
					'value' => __('Add New', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[add_new_item]',
					'title' => __('add_new_item', 'dp'),
					'value' => __('Add New Video', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[edit_item]',
					'title' => __('edit_item', 'dp'),
					'value' => __('Edit Video', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[new_item]',
					'title' => __('new_item', 'dp'),
					'value' => __('New Video', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[all_items]',
					'title' => __('all_items', 'dp'),
					'value' => __('All Videos', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[view_item]',
					'title' => __('view_item', 'dp'),
					'value' => __('View Video', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[search_items]',
					'title' => __('search_items', 'dp'),
					'value' => __('Search Videos', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[not_found]',
					'title' => __('not_found', 'dp'),
					'value' => __('No videos found.', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[not_found_in_trash]',
					'title' => __('not_found_in_trash', 'dp'),
					'value' => __('No videos found in Trash.', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[menu_name]',
					'title' => __('menu_name', 'dp'),
					'value' => __('Videos', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_post_labels[name_admin_bar]',
					'title' => __('name_admin_bar', 'dp'),
					'value' => __('Video', 'dp')
				)
			),
			'dp-video-settings' => array(
				array(
					'type' => 'select',
					'name' => 'dp_default_player[video_file]',
					'value' => 'mediaelement',
					'options' => array(
						'mediaelement' => __('MediaElement (WordPress Default Player)', 'dp'), 
						'jwplayer' => __('JWPlayer', 'dp'), 
						'flowplayer' => __('FlowPlayer', 'dp'),
						'jplayer' => __('jPlayer', 'dp'), 
					),
					'title' => __('Default Player for Video File', 'dp'),
				),
				/*array(
					'type' => 'select',
					'name' => 'dp_jplayer[ratio]',
					'value' => '16:9',
					'options' => dp_jplayer_ratio(),
					'title' => __('Size', 'dp'),
				),*/
			),
			// Fields for General Settings
			'dp-general-settings' => array(
				array(
					'type' => 'select',
					'name' => 'dp_logo_type',
					'value' => 'image',
					'options' => array(
						'text' => __('Text Logo', 'dp'), 
						'image' => __('Image Logo', 'dp')
					),
					'title' => __('Logo Type', 'dp'),
				),
				array(
					'type' => 'upload',
					'name' => 'dp_logo',
					'title' => __('Image Logo', 'dp'),
					'desc' => __( 'Upload a logo for your theme, or specify the image url of your online logo.', 'dp'),
					'value' => get_template_directory_uri().'/images/logo.png'
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_site_description',
					'title' => __('Tagline', 'dp'),
					'label' => __( 'Show site tagline?', 'dp')
				),
				array(
					'type' => 'upload',
					'name' => 'dp_favicon',
					'title' => __('Favicon', 'dp'),
					'desc' => __( 'Upload a 16px x 16px PNG/GIF image that will represent your website\'s favicon.', 'dp'),
					'value' => 'http://s.wordpress.org/favicon.ico'
				),
				array(
					'type' => 'text',
					'name' => 'dp_rss_url',
					'title' => __('RSS URL', 'dp'),
					'desc' => sprintf(__( 'The default RSS url of your website is <code>%s</code>, if you want to use other feed url(e.g. feedburner), paste it to here.', 'dp'), get_bloginfo('rss2_url')),
				),
				array(
					'type' => 'upload',
					'name' => 'dp_login_logo',
					'title' => __('Login Logo', 'dp'),
					'desc' => __( 'Upload a logo for your wp-login.php page.', 'dp'),
					'value' => get_template_directory_uri().'/images/login-logo.png'
				),
				array(
					'type' => 'custom',
					'title' => __('Main Navigation', 'dp'),
					'label' => __('Check this to enable footer navigation in footer area.', 'dp'),
					'desc' => sprintf(__('By default, the main navigation is a list of your categories, if your want to customize it, add a menu on <a href="%s">Apperance->Menus</a> page and set this menu as "Main Navigation" in "Theme Location" box.', 'dp'), admin_url('nav-menus.php')),
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_responsive',
					'value' => true,
					'title' => __('Responsive', 'dp'),
					'label' => __( 'Check this to enable responsive?', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_masonry',
					'value' => true,
					'title' => __('Masonry Layout', 'dp'),
					'label' => __( 'Check this to enable jQuery Masonry layout with Sidebar and Footbar (Uncheck it if have issues, because it can\'t working with some plugins)', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_addthis',
					'value' => true,
					'title' => __('AddThis', 'dp'),
					'label' => __( 'Check this to enable AddThis share buttons.', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_addthis_pubid',
					'title' => __('AddThis PubID', 'dp'),
					'desc' => __( 'Your AddThis Publisher Profile ID (e.g. xa-502a3a59790da5bd). This required if you want AddThis to track analytics for your site.', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_fb_ogtags',
					'value' => true,
					'title' => __('Facebook Open Graph Tags', 'dp'),
					'label' => __( 'Check this to insert Facebook Open Graph Tags into head.', 'dp')
				)
			),
			
			// Fields for Single Settings
			'dp-single-settings' => array(
				array(
					'type' => 'text',
					'name' => 'dp_related_posts',
					'title' => __('Related Posts', 'dp'),
					'desc' => __( "How many related posts should be displayed on the single post page? If you don't want to show it leave this field blank or set to 0.", 'dp'),
					'value' => 4,
					'class' => 'small-text'
				),
				array(
					'type' => 'select',
					'name' => 'dp_related_posts_view',
					'title' => __('Related Posts View', 'dp'),
					'value' => 'grid-mini',
					'options' => array(
						'grid-mini' => $supported_view_types['grid-mini'],
						'grid-small' => $supported_view_types['grid-small'],
						'grid-medium' => $supported_view_types['grid-medium']
					)
				),
				array(
					'type' => 'select',
					'name' => 'dp_single_video_layout',
					'title' => __('Single Video Layout', 'dp'),
					'desc' => __( 'Specify a default layout for all of the video posts, and you can override this setting for individual posts in "Video Settings" panel on edit post page.', 'dp'),
					'options' => array(
						'standard' => __('Standard', 'dp'), 
						'full-width' =>__('Full Width', 'dp')
					),
					'value' => 'standard',
					'class' => 'small-text'
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_single_video_autoplay',
					'title' => __('Autoplay', 'dp'),
					'label' => __( 'Check this to autoplay video when viewing a single video post?', 'dp'),
					'value' => true,
					'class' => 'small-text'
				),
				array(
					'type' => 'text',
					'name' => 'dp_info_toggle',
					'title' => __('"More/Less" Toggle', 'dp'),
					'desc' => __( "Enter a number as less height for video detatils area, eg. 100, if you don't need this function, leave this field blank or set to 0. Note: this function is only works on single video post pages.", 'dp'),
					'value' => 100,
					'class' => 'small-text'
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_single_thumb',
					'title' => __('Thumbnail', 'dp'),
					'label' => __( 'Check this to show thumbnail on single posts.', 'dp'),
					'value' => false,
					'class' => 'small-text'
				)
			),
			
			// Fields for Post Likes Settings
			'dp-post-likes-settings' => array(
				array(
					'type' => 'checkbox',
					'name' => 'dp_post_likes[login_required]',
					'value' => true,
					'title' => __('Login Required', 'dp'),
					'label' => __('Users must be registered and logged in to like post ', 'dp')
				),
				array(
					'type' => 'custom',
					'name' => 'dp_post_likes_page',
					'title' => __('Likes Page', 'dp'),
					'custom' => wp_dropdown_pages(array('echo' => false, 'name' => 'dp_post_likes_page', 'selected' => get_option('dp_post_likes_page'), 'show_option_none' => __('&mdash; Select &mdash;', 'dp'))),
					'desc' => 
					sprintf(__('<p>Select a page as user\'s likes page, if the page doesn\'t exist:<br />
					1. <a href="%s">Adding a new page</a><br />
					2. Give this page a title like "My Likes".<br />
					3. Set page template as "Likes".<br />
					<br />
					The "Likes Page" is a page for display user/visitor\'s liked posts.<br />
					<strong>* Logged in:</strong> If the user is logged in, the page will display the user\'s liked posts based on the user\'s ID.<br />
					<strong>* Not Logged in:</strong> If the visitor is not logged in, the page will display the visitor\'s liked posts based on the visitor\'s IP.<br />
					<strong>* Login Required + Not Logged in:</strong> If "Login Required" and the user is not logged in, the page will display a message to remind users to register and login.<br />', 'dp'), admin_url('post-new.php?post_type=page')),
				)
			),
			
			// Fields for Header Settings
			'dp-header-settings' => array(
				array(
					'type' => 'checkbox',
					'name' => 'dp_header_search',
					'value' => true,
					'title' => __('Search Box', 'dp'),
					'label' => __('Check this to enable search box in header area', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_header_signup',
					'value' => true,
					'title' => __('Sign up', 'dp'),
					'label' => __('Check this to enable "Sing up" button in header area (When your site is allowed to register)', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_header_login',
					'value' => true,
					'title' => __('Login', 'dp'),
					'label' => __('Check this to enable "Log in" button in header area', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_header_account',
					'value' => true,
					'title' => __('Account', 'dp'),
					'label' => __('Check this to enable account button in header area (When the user is logged in)', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_header_likes',
					'value' => true,
					'title' => __('Likes Page', 'dp'),
					'label' => __('Check this to enable Likes page in header area', 'dp')
				)
			),
			
			// Fields for Footer Settings
			'dp-footer-settings' => array(
				array(
					'type' => 'checkbox',
					'name' => 'dp_footbar_status',
					'value' => true,
					'title' => __('Footbar', 'dp'),
					'label' => sprintf(__( 'Check this to enable footbar (Footer Widget Areas), and add widgets on <a href="%s">Appearance->Widgets</a> page', 'dp'), admin_url('widgets.php')),
				),
				array(
					'type' => 'select',
					'name' => 'dp_footbar_layout',
					'value' => 'c3',
					'options' => array(
						'c3' => __('3 Columns', 'dp'), 
						'c4' => __('4 Columns', 'dp'), 
						'c4s1' => __('4+1 Columns', 'dp')
					),
					'title' => __('Footbar Layout', 'dp'),
					'desc' => sprintf(__('Select a layout for your footer widget areas, after you change this option, you may need to re-configure widgets on  <a href="%s">Appearance->Widgets</a> page', 'dp'), admin_url('widgets.php'))
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_footer_nav_status',
					'value' => true,
					'title' => __('Footer Navigation', 'dp'),
					'label' => __('Check this to enable footer navigation in footer area.', 'dp'),
					'desc' => sprintf(__('By default, the footer navigation is a list of your pages, if your want to customize it, add a menu on <a href="%s">Apperance->Menus</a> page and set this menu as "Footer Navigation" in "Theme Location" box.', 'dp'), admin_url('nav-menus.php'))
				),
				array(
					'type' => 'text',
					'name' => 'dp_site_copyright',
					'title' => __('Text for Copyright', 'dp'),
					'value' => __('Copyright %1$s &copy; %2$s All rights reserved.', 'dp'),
					'desc' => __("<code>%1&#36;s</code> is current year, <code>%2&#36;s</code> is a link with your site name.", 'dp')
				),
				array(
					'type' => 'textarea',
					'name' => 'dp_site_credits',
					'title' => __('Text for Credits', 'dp'),
					'value' => __('Powered by <a target="_blank" href="http://wordpress.org/">WordPress</a> & <a target="_blank" href="http://dedepress.com/themes/detube/" title="Premium Video Theme">deTube</a> by <a target="_blank" href="http://dedepress.com" title="Premium WordPress Themes">DeDePress</a>.', 'dp'),
					'desc' => __('Whether WordPress or DeDePress, No attribution or backlinks are strictly required, but play the game, it\'s always nice to be credited for your site. Any form of spreading the word is always appreciated!', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_social_nav_status',
					'value' => true,
					'title' => __('Social Navigation', 'dp'),
					'label' => __('Check this to enable social navigation in footer area', 'dp')
				),
				array(
					'type' => 'text',
					'name' => 'dp_social_nav_desc',
					'title' => __('Navigation Description', 'dp'),
					'value' =>  __('Follow us elsewhere', 'dp'),
				),
				array(
					'type' => 'fields',
					'title' => __('Twitter Link', 'dp'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'dp_social_nav_links[twitter][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[twitter][url]',
							'prepend' => __('URL:', 'dp'),
							'value' => 'http://twitter.com/dedepress',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[twitter][title]',
							'prepend' => __('Title Attribute:', 'dp'),
							'value' => __('Follow us on Twitter', 'dp'),
							'class' => 'regular-text'
						)
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Facebook Link', 'dp'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'dp_social_nav_links[facebook][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[facebook][url]',
							'prepend' => __('URL:', 'dp'),
							'value' => 'http://facebook.com/dedepress',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[facebook][title]',
							'prepend' => __('Title Attribute:', 'dp'),
							'value' => __('Become a fan on Facebook', 'dp'),
							'class' => 'regular-text'
						)
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Google Plus Link', 'dp'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'dp_social_nav_links[gplus][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[gplus][url]',
							'prepend' => __('URL:', 'dp'),
							'value' => 'http://gplus.to/dedepress',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[gplus][title]',
							'prepend' => __('Title Attribute:', 'dp'),
							'value' => __('Follow us on Google Plus', 'dp'),
							'class' => 'regular-text'
						)
					)
				),
				array(
					'type' => 'fields',
					'title' => __('RSS Link', 'dp'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'dp_social_nav_links[rss][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[rss][url]',
							'prepend' => __('URL:', 'dp'),
							'value' => get_bloginfo('rss2_url'),
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[rss][title]',
							'prepend' => __('Title Attribute:', 'dp'),
							'value' => __('Subscriber to RSS Feed', 'dp'),
							'class' => 'regular-text'
						)
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Newsletter Link', 'dp'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'dp_social_nav_links[news][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[news][url]',
							'prepend' => __('URL:', 'dp'),
							'value' => 'http://dedepress.com',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'dp_social_nav_links[news][title]',
							'prepend' => __('Title Attribute:', 'dp'),
							'value' => __('Premium WordPress Themes', 'dp'),
							'class' => 'regular-text'
						)
					)
				)
			),
			
			// Fields for Hook Settings
			'dp-hook-settings' => array(
				array(
					'type' => 'textarea',
					'name' => 'dp_head_code',
					'title' => __('Head Code', 'dp'),
					'desc' => __( 'Paste any code here. It will be inserted before the <code>&lt;/head&gt;</code> tag of your theme.', 'dp'),
				),
				array(
					'type' => 'textarea',
					'name' => 'dp_footer_code',
					'title' => __('Footer Code', 'dp'),
					'desc' => __( 'Paste any code here, e.g. your Google Analytics tracking code. It will be inserted before the <code>&lt;/body&gt;</code> tag of your theme.', 'dp'),
				)
			),
			
			// Fields for Design Settings
			'dp-design-settings' => array(
				array(
					'type' => 'select',
					'name' => 'dp_wrap_layout',
					'value' => '',
					'options' => array('full-wrap' => __('Full Width', 'dp'), 'boxed-wrap'=>__('Boxed', 'dp')),
					'title' => __('Wrap Layout', 'dp'),
				),
				array(
					'type' => 'color',
					'name' => 'dp_bgcolor',
					'value' => '#EEE',
					'title' => __('Custom Background Color', 'dp'),
					'append' => __("Default color value is #EEEEEE", 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_bgpat',
					'value' => true,
					'title' => __('Background Pattern', 'dp'),
					'label' => __("Check this to enable background pattern.", 'dp')
				),
				array(
					'type' => 'select',
					'name' => 'dp_preset_bgpat',
					'value' => get_template_directory_uri().'/images/bg-pattern.png',
					'options' => dp_get_patterns(),
					'title' => __('Preset Background Pattern', 'dp'),
					'desc' => dp_preset_bgpat_preview()
				),
				array(
					'type' => 'upload',
					'name' => 'dp_custom_bgpat',
					'value' => '',
					'title' => __('Custom Background Pattern', 'dp'),
					'desc' => __('This option will override "Preset Background Pattern" in the above.', 'dp'),
				),
				array(
					'type' => 'select',
					'name' => 'dp_bgrep',
					'value' => 'repeat',
					'options' => array('repeat', 'repeat-x', 'repeat-y', 'no-repeat'),
					'title' => __('Background Repeat', 'dp')
				),
				array(
					'type' => 'select',
					'name' => 'dp_bgatt',
					'value' => 'fixed',
					'options' => array('fixed', 'scroll'),
					'title' => __('Background Attachment', 'dp')
				),
				array(
					'type' => 'checkbox',
					'name' => 'dp_bgfull',
					'value' => false,
					'title' => __('Full Page Background Image', 'dp'),
					'label' => __("Check this to enable full page background image(not working below IE9).", 'dp')
				)
			) 
		);
		
		return $fields;
	}

/**
 * Get all patterns from "{theme_direcoty}/patterns/"
 */
function dp_get_patterns() {
	$dir = get_template_directory().'/patterns';
	
	$patterns = array(
		get_template_directory_uri().'/images/bg-pattern.png' => __('Default', 'dp')
	);
	
	if (!is_dir($dir))
		return $patterns;
	
    if ($handler = opendir($dir)) {
        while (($file = readdir($handler)) !== false) {
			// Get file extension
			if(function_exists('pathinfo'))
				$file_ext = pathinfo($file, PATHINFO_EXTENSION);
			else
				$file_ext = end(explode(".", $file));
			
			if ($file != "." && $file != ".." && in_array($file_ext, array('jpg', 'png', 'gif'))) {
				$file_url = get_template_directory_uri().'/patterns/'.$file;
				$patterns[$file_url] = $file;
			}
        }
        closedir($handler);
	}
	
	return $patterns;
}

function dp_preset_bgpat_preview() {
	$pat = get_option('dp_preset_bgpat');
	if(!$pat)
		$pat = get_template_directory_uri().'/images/bg-pattern.png';
	
	$html = '
		<style type="text/css">
			.dp-preset-bgpat-preivew{
				margin:20px 0 0;
				height:100px;
				border:1px solid #CCC;
				background:#EEE url('.$pat.');
			}
		</style>
	';
	$html .= '<div class="dp-preset-bgpat-preivew"></div>';
	 
	return $html;
}

/* Home Settings
 *=============================================================================*/

	
	
	

/**
 * General sort types settings meta box
 */
function dp_sort_types_settings() {
	$supported_types = dp_supported_sort_types();
	$types = get_option('dp_sort_types');
	$types_order = get_option('dp_sort_types_order');
	
	if(empty($types))
		$types = array();
	if(empty($types_order))
		$types_order = array_keys($supported_types);

	echo '<tr><th>'.__('Sort Types', 'dp').'</th> <td><ul class="ui-sortable sortable-list">';
	foreach($types_order as $type) {
		$checked = array_key_exists($type, $types) ? ' checked="checked"' : '';
		$label = $supported_types[$type]['label'];
		echo '<li>
			<input style="display:none;" type="checkbox" name="dp_sort_types_order[]" value="'.$type.'" checked="checked" />
			<input type="checkbox" name="dp_sort_types['.$type.']" value="1" '.$checked.'/> '.$label.
			'</li>';
	}
	echo '</ul>';
	echo __("Check a type to enable it, or drag the types to reorder.", 'dp');
	echo '</td></tr>';
}

/**
 * General view types settings meta box
 */
function dp_view_types_settings() {
	$supported_types = dp_supported_view_types();
	$types = get_option('dp_view_types');
	$types_order = get_option('dp_view_types_order');
	
	if(empty($types))
		$types = array();
	if(empty($types_order))
		$types_order = array_keys($supported_types);

	echo '<tr><th>'.__('View Types', 'dp').'</th><td><ul class="sortable-list">';
	foreach($types_order as $type) {
		$checked = array_key_exists($type, $types) ? ' checked="checked"' : '';
		$label = $supported_types[$type];
		echo '<li>
			<input style="display:none;" type="checkbox" name="dp_view_types_order[]" value="'.$type.'" checked="checked" />
			<input type="checkbox" name="dp_view_types['.$type.']" value="1" '.$checked.'/> '.$label.
			'</li>';
	}
	echo '</ul>';
	echo __("Check a type to enable it, or drag the types to reorder.", 'dp');
	echo '</td></tr>';
}

/**
 * Home featured settings meta box
 */
function dp_home_featured_settings() {
	$defaults = array(
		'cat' => '',
		'post_type' => 'post',
		'taxonomies' => '',
		'orderby' => '',
		'order' => '',
		'posts_per_page' => 18,
		'posts__in' => '',
		'autoplay' => 0,
		'ajaxload' => true,
		'autoscroll' => 0,
		'layout' => 'standard', // standard, full-width
		'first_post_media' => 'video'
	);
	$args = get_option('dp_home_featured');
	foreach($defaults as $key => $value) {
		if(!array_key_exists($key, $args)) {
			$args[$key] = 0;
		}
	}
	$args = wp_parse_args($args, $defaults);
	
	$dropdown_sort_types = dp_dropdown_sort_types(array(
		'echo' => 0, 
		'name' => 'dp_home_featured[orderby]',
		'selected' => $args['orderby']
	));
	
	$dropdown_order_types = dp_dropdown_order_types(array(
		'echo' => 0, 
		'name' => 'dp_home_featured[order]',
		'selected' => $args['order']
	));
	
	$dropdown_views_timing = dp_dropdown_views_timing(array(
		'echo' => 0, 
		'name' => 'dp_home_featured[views_timing]',
		'selected' => $args['views_timing']
	));
	
	$dropdown_layouts = dp_form_field(array(
		'echo' => 0,
		'type' => 'select',
		'options' => array(
			'standard' => __('Standard', 'dp'), 
			'full-width' => __('Full Width', 'dp')
		),
		'name' => 'dp_home_featured[layout]',
		'value' => $args['layout']
	));
	
	$dropdown_post_types = dp_dropdown_post_types(array(
		'echo' => 0,
		'name' => 'dp_home_featured[post_type]',
		'selected' => $args['post_type']
	));
	
	
	$multi_dropdown_terms = dp_multi_dropdown_terms(array(
		'echo' => 0,
		'name' => 'dp_home_featured[taxonomies]',
		'selected' => $args['taxonomies']
	));
	
	$html = '<table class="form-table">
		<tr>
			<td colspan="2">
				<div class="description">'.__("These settings enable you to show featured posts on home pages. If you don't want to show it, set 'Number of Posts' to 0.", 'dp').'</div>
			</td>
		</tr>
		<tr>
			<th>'.__('Layout', 'dp').'</th>
			<td>'.$dropdown_layouts.'</td>
		</tr>';
	
	if($dropdown_post_types) {
	$html .= '<tr>
			<th><label>'.__('Post Type', 'dp').'</label></th>
			<td>
				'.$dropdown_post_types.'
			</td>
		</tr>';
	}
	$html .= '<tr>
			<th>'.__('Taxonomy Query', 'dp').'</th>
			<td>
				'.$multi_dropdown_terms.'
			</td>
		</tr>
		<tr>
			<th>'.__('Sort', 'dp').'</th>
			<td>
				<label>'.__('Order by:', 'dp').'</label> '.$dropdown_sort_types.'&nbsp;&nbsp;
				<label>'.__('Order:', 'dp').'</label> '.$dropdown_order_types.'&nbsp;&nbsp;
				<label>'.__('Views Timing:', 'dp').'</label> '.$dropdown_views_timing.'&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<th><label>'.__('Number of Posts', 'dp').' </label></th>
			<td>
				<input class="small-text" type="text" value="'.$args['posts_per_page'].'" name="dp_home_featured[posts_per_page]" />
			</td>
		</tr>
		<tr>
			<th><label>'.__('Includes', 'dp').'</label></th> 
			<td>
				<input class="widefat" type="text" value="'.$args['post__in'].'" name="dp_home_featured[post__in]" />
				<p class="description">'.__('If you want to display specific posts, enter post ids to here, separate ids with commas, (e.g. 1,2,3,4). <br />if this field is not empty, category will be ignored. <br/>If you want to display posts sort by the order of your enter IDs, set "Sort" field as <strong>Includes</strong>.', 'dp').'</p>
			</td>
		</tr>
		<tr>
			<th><label>'.__('First Post Media', 'dp').'</label></th>
			<td>
				'.dp_form_field(array(
					'name' => 'dp_home_featured[first_post_media]',
					'type' => 'select',
					'value' => $args['first_post_media'],
					'options' => array(
						'video'=>__('Video', 'dp'), 
						'thumb'=>__('Thumbnail', 'dp'),
					),
					'echo' => false
				)).'<p class="description">'.__('Select a media type for first post', 'dp').'
			</td>
		</tr>
		<tr>
			<th><label>'.__('Autoplay', 'dp').'</label></th> 
			<td>
				<label><input type="checkbox" value="1" name="dp_home_featured[autoplay]" '.checked($args['autoplay'], true, false).'/>'.__('Check this to enable autoplay', 'dp').'</label>
			</td>
		</tr>
		<tr>
			<th><label>'.__('Ajaxload', 'dp').'</label></th> 
			<td>
				<label><input type="checkbox" value="1" name="dp_home_featured[ajaxload]" '.checked($args['ajaxload'], true, false).'/>'.__('Check this to enable ajaxload', 'dp').'</label>
			</td>
		</tr>
		<tr>
			<th><label>'.__('Autoscroll', 'dp').'</label></th> 
			<td>
				<input class="widefat" type="text" value="'.$args['autoscroll'].'" name="dp_home_featured[autoscroll]" />
				<p class="description">'.__('Set autoscrolling interval in milliseconds to make carousel to automatic play (eg. 2500), set it to 0 or leave it blank to disable it . <strong>Note</strong>: It will disable autoplay and ajaxload.', 'dp').'</p>
			</td>
		</tr>
	</table>';

	return $html;
}

/**
 * Category featured settings meta box
 */
function dp_cat_featured_settings() {
	$defaults = array(
		'orderby' => '',
		'order' => '',
		'posts_per_page' => '',
		'item'
	);
	$args = get_option('dp_cat_featured');
	$args = wp_parse_args($args, $defaults);
	
	$dropdown_sort_types = dp_dropdown_sort_types(array(
		'echo' => 0, 
		'name' => 'dp_cat_featured[orderby]',
		'selected' => $args['orderby']
	));
	
	$dropdown_order_types = dp_dropdown_order_types(array(
		'echo' => 0, 
		'name' => 'dp_cat_featured[order]',
		'selected' => $args['order']
	));

	$html = '
		<tr>
			<td colspan="2">
				<div class="description">'.__("These settings enable you to show posts of current category with carousel effect on category pages. If you don't want to show it, set 'Number of Posts' to 0.", 'dp').'</div>
			</td>
		</tr>
		<tr>
			<th>'.__('Query', 'dp').'</th>
			<td>
				<label>'.__('Sort:', 'dp').'</label> '.$dropdown_sort_types.'&nbsp;&nbsp;'.$dropdown_order_types.'&nbsp;&nbsp;
				<label>'.__('Number of Posts:', 'dp').' </label>
				<input class="small-text" type="text" value="'.$args['posts_per_page'].'" name="dp_cat_featured[posts_per_page]" />
			</td>
		</tr>
	';

	return $html;
}


/**
 * Home sections settings meta box
 */
function dp_home_sections_settings() {
	$html = '
	<tr><td colspan="2">
	<div class="item-box">
	<p class="description" style="padding:10px;">'.__('To adding a section, click "<strong>Add New Section</strong>" button. <br />Drag sections up or down to change their order of appearance on home page.<br/>Don\'t forget to click "<strong>Save Changes</strong>" button.', 'dp').'</p>
	<div class="item-list-container" id="dp-home-sections-item-list-container">
		<a href="#" class="button add-new-item" data-position="prepend">'.__('Add New Section', 'dp').'</a>
		<ul class="item-list ui-sortable" id="dp-home-sections-item-list">';
		
	$items = get_option('dp_home_sections');
	if(!empty($items) && is_array($items)) {
		foreach($items as $number => $item) {
			$item = array_filter($item);
			if(!empty($item))
				$html .= dp_home_section_item($number, $item);
		}
	}
	
	$html .= '
		</ul>
		<ul class="item-list-sample" id="dp-home-sections-item-list-sample" style="display:none;">'.dp_home_section_item().'</ul>
	<a href="#" class="button add-new-item" data-position="append">'.__('Add New Section', 'dp').'</a>
	
	</div></div>
	</td></tr>';
	
	return $html;
}

/**
 * Single section settings
 */
function dp_home_section_item($number = null, $item = array()) {
	$default_item = array(
		'post_type' => 'post',
		'cat' => '',
		'view' => '',
		'orderby' => '',
		'order' => '',
		'taxonomies' => '',
		'tax_query' => array(),
		'post__in' => '',
		'posts_per_page' => '',
		'title' => '',
		'link' => '',
		'before' => '',
		'after' => '',
		'views_timing' => ''
	);
	$item = wp_parse_args($item, $default_item);
	if($number === null)
		$number = '##';

	$dropdown_view_types = dp_dropdown_view_types(array(
		'echo' => 0, 
		'name' => 'dp_home_sections['.$number.'][view]',
		'selected' => !empty($item['view']) ? $item['view'] : 'grid-small'
	));
	
	$dropdown_sort_types = dp_dropdown_sort_types(array(
		'echo' => 0, 
		'name' => 'dp_home_sections['.$number.'][orderby]',
		'selected' => $item['orderby']
	));
	
	$dropdown_order_types = dp_dropdown_order_types(array(
		'echo' => 0, 
		'name' => 'dp_home_sections['.$number.'][order]',
		'selected' => $item['order']
	));
	
	$dropdown_views_timing = dp_dropdown_views_timing(array(
		'echo' => 0, 
		'name' => 'dp_home_sections['.$number.'][views_timing]',
		'selected' => $item['views_timing']
	));
	
	$dropdown_post_types = dp_dropdown_post_types(array(
		'echo' => 0, 
		'name' => 'dp_home_sections['.$number.'][post_type]',
		'selected' => $item['post_type']
	));
	
	$taxonomies = get_taxonomies(array('public'=>true), 'objects');
	$multi_dropdown_terms = dp_multi_dropdown_terms(array(
		'echo' => 0,
		'name' => 'dp_home_sections['.$number.'][taxonomies]',
		'selected' => $item['taxonomies']
	));
	
	$section_title = __('Section Box', 'dp');
	$section_title .= !empty($item['title']) ? ': <spanc class="in-widget-title">'.$item['title'].'</span>' : '';
	
	$html = '
	<li rel="'.$number.'">
		<div class="section-box closed">
		<div class="section-handlediv" title="Click to toggle"><br></div><h3 class="section-hndle"><span>'.$section_title.'</span></h3>
		
		<div class="section-inside">
		
		<table class="item-table">
			<tr>

				<td>
					<table class="item-table">';
	
			if($dropdown_post_types) {
				$html .= '<tr>
				<th><label>'.__('Post Type', 'dp').'</label></th>
					<td>
						'.$dropdown_post_types.'
					</td>
				</tr>';
			}
	
			$html .= '
						<tr>
							<th>'.__('Taxomoy Query', 'dp').'</th>
							<td>
								'.$multi_dropdown_terms.'
							</td>
						</tr>
						<tr>
							<th>'.__('Sort', 'dp').'</th>
							<td>
								<label>'.__('Order by:', 'dp').'</label> '.$dropdown_sort_types.'&nbsp;&nbsp;
								<label>'.__('Order:', 'dp').'</label> '.$dropdown_order_types.'&nbsp;&nbsp;
								<label>'.__('Views Timing:', 'dp').'</label> '.$dropdown_views_timing.'
							</td>
						</tr>
						<tr>
							<th><label>'.__('Number of Posts:', 'dp').' </label></th>
							<td>
								<input class="small-text" type="text" value="'.$item['posts_per_page'].'" name="dp_home_sections['.$number.'][posts_per_page]" />&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<th><label>'.__('Includes', 'dp').'</label></th> 
							<td>
								<input class="widefat" type="text" value="'.$item['post__in'].'" name="dp_home_sections['.$number.'][post__in]" />
								<p class="description">'.__('If you want to display specific posts, enter post ids to here, separate ids with commas, (e.g. 1,2,3,4). <br />if this field is not empty, category will be ignored. <br/>If you want to display posts sort by the order of your enter IDs, set "Sort" field as <strong>Includes</strong>.', 'dp').'</p>
							</td>
						</tr>
						<tr>
							<th><label>'.__('View', 'dp').'</label></th> 
							<td>'.$dropdown_view_types.'</td>
						</tr>
						<tr>
							<th><label>'.__('Title', 'dp').'</label></th> 
							<td>
								<input class="widefat" type="text" value="'.$item['title'].'" name="dp_home_sections['.$number.'][title]" />
								<p class="description">'.__('If you specify a category, the default title is the category name, and you can still fill in this field to override it.', 'dp').'</p>
							</td>
						</tr>
						<tr>
							<th><label>'.__('Link', 'dp').'</label></th> 
							<td>
								<input class="widefat" type="text" value="'.$item['link'].'" name="dp_home_sections['.$number.'][link]" />
								<p class="description">'.__('If you specified a category, the default link is the category link, and you can still fill in this field to override it.', 'dp').'</p>
							</td>
						</tr>
						<tr>
							<th><label>'.__('Before', 'dp').'</label></th> 
							<td>
								<textarea rows="5" class="widefat" name="dp_home_sections['.$number.'][before]">'.$item['before'].'</textarea>
								<p class="description">'.__('Maybe you want to insert something before this section, such as your ad code. (support html and shortcode).', 'dp').'</p>
							</td>
						</tr>
						<tr>
							<th><label>'.__('After', 'dp').'</label></th> 
							<td>
								<textarea rows="5" class="widefat" name="dp_home_sections['.$number.'][after]">'.$item['after'].'</textarea>
								<p class="description">'.__('Maybe you want to insert something after this section, such as your ad code. (support html and shortcode).', 'dp').'</p>
							</td>
						</tr>
					</table>
				</td>
				
				<td style="width:50px;">
					<a href="#" class="button delete-item">'.__('Delete', 'dp').'</a>
				</td>
			</tr>
		</table>
		</div>
		</div>
	</li>
	';

	return $html;
}

/**
 * HTML dropdown list of post types
 *
 * @since deTube 1.2.6
 */
function dp_dropdown_post_types($args='') {
	$defaults = array(
		'name' => '',
		'selected' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$post_types = get_post_types(array('public'=>true), 'objects');
	unset($post_types['page']);
	unset($post_types['attachment']);
	if(count($post_types) < 2)
		return;

	$post_type_options = array('all'=>__('All', 'dp'));
	foreach($post_types as $type_name=>$type_object)
		$post_type_options[$type_name] = $type_object->labels->singular_name;
		
	$dropdown = dp_form_field(array(
		'echo' => 0,
		'type' => 'select',
		'options' => $post_type_options,
		'name' => $name,
		'value' => $selected
	));
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}

/**
 * HTML dropdown list of taxonomies terms
 *
 * @since deTube 1.2.6
 */
function dp_multi_dropdown_terms($args='') {
	$defaults = array(
		'name' => '',
		'selected' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);


	$taxes = get_taxonomies(array('public'=>true), 'objects');
	// Only category and post_format now
	$taxes = array(
		'category'=>$taxes['category'],
		'post_format'=>$taxes['post_format'],
		// 'post_tag'=>$taxes['post_tag']
	);
	$dropdown = '';
	foreach($taxes as $tax_name=>$tax_object) {
		$dropdown_args = array(
			'echo' => 0,
			'taxonomy' => $tax_name,
			'name' => $name.'['.$tax_name.']',
			'selected' => !empty($selected[$tax_name]) ? $selected[$tax_name] : array(),
			'show_option_all' => __('All', 'dp'),
			'hide_empty' => false,
			'hide_if_empty' => true,
			'number' => 2000,
			'orderby' => 'name'
		);
		if($tax_name == 'post_format')
			$dropdown_args['show_option_none'] = __('Standard', 'dp');
		$dropdown_terms = wp_dropdown_categories($dropdown_args);
		
		if($dropdown_terms)
			$dropdown .= '<label>'.$tax_object->labels->singular_name.':</label> '.$dropdown_terms.'&nbsp;&nbsp;';
	}
	
	$dropdown .= __('Tags (Separate tag slugs with commas):', 'dp').' ';
	$dropdown .= dp_form_field(dp_instance_field(array(
		'type' => 'text',
		'name' => $name.'[post_tag]',
		'value' => '',
		'class' => 'regular-text',
		'label' => 'Tag Slug',
		'echo' => 0
	)));
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}


/**
 * HTML dropdown list of view types
 */
function dp_dropdown_view_types($args){
	$defaults = array(
		'name' => '',
		'selected' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$view_types = dp_supported_view_types();
	
	$dropdown = '<select name="'.$name.'">';
	foreach($view_types as $type => $label) {
		$dropdown .= '<option value="'.$type.'"'.selected($type, $selected, false).'>'.$label.'</option>';
	}
	$dropdown .= '</select>';
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}

/**
 * HTML dropdown list of sort types
 */
function dp_dropdown_sort_types($args){
	$defaults = array(
		'name' => '',
		'selected' => '',
		'class' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$sort_types = dp_supported_sort_types();
	$sort_types['post__in'] = array(
		'label' => __('Includes', 'dp')
	); 
	
	$dropdown = '<select class="'.$class.'" name="'.$name.'">';
	foreach($sort_types as $type => $args) {
		$dropdown .= '<option value="'.$type.'"'.selected($type, $selected, false).'>'.$args['label'].'</option>';
	}
	$dropdown .= '</select>';
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}

/**
 * HTML dropdown list of views timing
 */
function dp_dropdown_views_timing($args){
	$defaults = array(
		'name' => '',
		'selected' => '',
		'class' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$views_timing = dp_views_timings();
	
	$dropdown = '<select class="'.$class.'" name="'.$name.'">';
	foreach($views_timing as $option => $label) {
		$dropdown .= '<option value="'.$option.'"'.selected($option, $selected, false).'>'.$label.'</option>';
	}
	$dropdown .= '</select>';
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}

/**
 * HTML dropdown list of order types
 */
function dp_dropdown_order_types($args){
	$defaults = array(
		'name' => '',
		'selected' => '',
		'class' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$order_types = array(
		'DESC' => __('Sort Descending', 'dp'),
		'ASC' => __('Sort Ascending', 'dp')
	);
	
	$dropdown = '<select class="'.$class.'" name="'.$name.'">';
	foreach($order_types as $type => $label) {
		$dropdown .= '<option value="'.$type.'"'.selected($type, $selected, false).'>'.$label.'</option>';
	}
	$dropdown .= '</select>';
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}


/*= Custom Pnale on edit post Page
 *=============================================================================*/

class CP_Video_Settings_Panel extends CP_Post_Panel {

	function __construct() {
		$this->name = 'dp-video-settings';
		$this->title = __('Video Settings', 'dp');
		$this->post_types = array('post');
		
		parent::__construct();
	}
	
	function fields() {
		$single_video_layout = get_option('dp_single_video_layout');
		$video_layout_label = ($single_video_layout == 'standard' || !$single_video_layout) ? __('Standard', 'dp') : __('Full Width', 'dp');
		
		$fields = array(
			array(
				'type' => 'select',
				'name' => 'cp_video_layout',
				'title' => __('Video Layout', 'dp'),
				'desc' => sprintf(__( 'The default single video layout is <b>"%s"</b>, select a layout if you want to use different layout to override it.', 'dp'), $video_layout_label),
				'options' => array(
					'' => '',
					'standard' => __('Standard', 'dp'), 
					'full-width' =>__('Full Width', 'dp')
				),
				'value' => ''
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'description',
				'value' => __('Please choose one of the following ways to embed the video into your post, the video is determined in the order: <b>Video Code > Video URL > Video File.</b>', 'dp'),
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'textarea',
				'name' => 'cp_video_file',
				'title' => __('Video File', 'dp'),
				'desc' => __( 'Paste your video file url to here. <b>Supported Video Formats:</b> mp4, m4v, webmv, webm, ogv and flv.<br /><br/>
				<b>About Cross-platform and Cross-browser Support</b><br/>
				If you want your video works in all platforms and browsers(HTML5 and Flash), you should provide various video formats for same video, if the video files are ready, enter one url per line. For Example: <br />
				<code>http://yousite.com/sample-video.m4v</code><br />
				<code>http://yousite.com/sample-video.ogv</code><br />
				<b>Recommended Format Solution</b>: webmv + m4v + ogv.
				', 'dp'),
			),
			array(
				'type' => 'upload',
				'name' => 'cp_video_poster',
				'title' => __('Video Poster', 'dp'),
				'desc' => __( 'The preview image for video file, recommended size is 960px*540px.', 'dp'),
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'text',
				'name' => 'cp_video_url',
				'title' => __('Video URL', 'dp'),
				'desc' => __( 'Paste the url from popular video sites like YouTube or Vimeo. For example: <br/>
				<code>http://www.youtube.com/watch?v=nTDNLUzjkpg</code><br/>
				or<br/>
				<code>http://vimeo.com/23079092</code><br/><br/>
				See <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">Supported Video Sites</a>.', 'dp')
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'textarea',
				'name' => 'cp_video_code',
				'title' => __('Video Code', 'dp'),
				'desc' => __( 'Paste the raw video code to here, such as <code>&lt;object&gt;</code>, <code>&lt;embed&gt;</code> or <code>&lt;iframe&gt;</code> code.', 'dp')
			)
		);
		return $fields;
	}
}
dp_register_post_panel('CP_Video_Settings_Panel');


/**
 * Functions for create form elements
 *
 * @package CP API
 * @subpackage Admin
 */

function dp_form_fields($fields = '', $args = '') {	
	$defaults = array(
		'before_container' => '<table class="form-table"><tbody>',
		'after_container' => '</tbody></table>',
		'before_row' => '<tr>',
		'after_row' => '</td></tr>',
		'before_title' => '<th scope="row">',
		'after_title' => '</th><td>',
		'callback' => '',
	);
	$args = wp_parse_args( $args, $defaults );

	echo $args['before_container'];
	
	foreach ($fields as $field) {
		if(!is_array($field))
			continue;
		
		$type = !empty( $field['type'] ) ? $field['type'] : '';
		$name = !empty( $field['name'] ) ? $field['name'] : '';
		$types = array('text', 'password', 'upload', 'image_id', 'color', 'textarea', 'radio', 'select', 'multiselect', 'checkbox', 'checkboxes', 'custom');
		
		if( !empty( $field['callback'] ) && is_callable( $field['callback'] ) ) {
				echo call_user_func( $field['callback'], $field );
		} 
		elseif($type == 'description' && !empty($field['value'])) {
			echo '<tr><td colspan="2"><div class="description">'.$field['value'].'</div></td></tr>';
		} 
		elseif($type == 'fields' ) {
			$defaults = array(
				'before_container' => '',
				'after_container' => '',
				'before_row' => '',
				'after_row' => '',
				'before_title' => '',
				'after_title' => '',
				'callback' => ''
			);
			
			echo '<tr><th>'.$field['title'].'</th><td>';
			dp_form_fields( $field['fields'], wp_parse_args( $field['args'], $defaults ) );
			echo '</td></tr>';
		} 
		elseif(!empty($type)) {
			if(!empty( $args['callback'] ) && is_callable( $args['callback'] ))
				$field = call_user_func( $args['callback'], $field);
			
			$field = wp_parse_args($field, $args);
			dp_form_row($field);
		}
	}
	
	echo $args['after_container'];
}

function dp_form_widget($fields = array(), $field_args_callback = '') {
	
	foreach ($fields as $field) {
		if(!is_array($field))
			continue;
		
		$type = !empty($field['type']) ? $field['type'] : '';
		$name = !empty($field['name']) ? $field['name'] : '';
		
		$types = array('text', 'textarea', 'radio', 'select', 'multiselect', 'checkbox', 'checkboxes');
		
		// if callback is set
		if(!empty($field['callback']))
			call_user_func($field['callback'], $field);
			
		// Handle outputs for form elements
		elseif(in_array($type, $types)) {
			if(!empty($field_args_callback) && is_callable($field_args_callback))
				$field = call_user_func($field_args_callback, $field);
				
			if(!empty($field['to_array'])) {
				$to_array = $field['to_array'];
				$field['name'] = "{$to_array}[{$name}]";
				$field['id'] = "$to_array-$name";
			}
			
			$field['before'] = '<p>';
			$field['after'] = '</p>';
			$field['before_title'] = '';
			$field['after_title'] = '';
			
			dp_form_row($field);
		}
		
		// type = description
		elseif($type == 'description' && !empty($field['value']))
			echo '<tr><td colspan="2"><span class="description">'.$field['value'].'</span></td></tr>';
		
		// type = custom
		elseif($type == 'custom' && !empty($field['value']))
			echo '<tr><td colspan="2">'.$field['value'].'</td></tr>';
	}
	echo '</tbody></table>';
}

function dp_form_row($args = '') {
	$defaults = array(
		'before_row' => '<tr>',
		'before_title' => '<th scope="row">',
		'title' => '',
		'after_title' => '</th><td>',
		'after_row' => '</td></tr>',
		'label_for' => '',
		'id' => '',
		'tip' => '',
		'req' => '',
		'desc' => '',
		'prepend' => '',
		'append' => '',
		'field' => ''
	);
	
	$args = wp_parse_args( $args, $defaults ); 
	extract($args);
	
	if(empty($id) && !empty($name))
		$id = $args['id'] = sanitize_field_id($name);
	if(empty($label_for) && !empty($id))
		$label_for = ' for="'.$id.'"';
	
	echo $before_row;
	
	/* Title */
	if($args['type'] != 'checkbox' || $args['type'] == 'checkboxes')
		$title = '<label'.$label_for.'>'.$args['title'].'</label> ';
	/* Tip */
	if($tip)
		$tip = ' <span class="tip">(?)</span><div style="display:none;">'.$tip.'</div>';
	/* Required */
	$req = '';	
	if($args['req'] === true || $args['req'] === 1)
		$req = '*';
	elseif(isset($args['req']))
		$req = $args['req'];
	if(!empty($req))
		$req = ' <span class="required">'.$req.'</span>';
	
	/* Output */
	echo $before_title . $title . $req . $tip . $after_title . ' ';
	
	if(!empty($args['prepend']))
		echo $args['prepend'] . ' ';
	
	if( empty($args['field']) )
		dp_form_field($args);
	
	if($args['type'] == 'custom' && !empty($args['custom']))
		echo $args['custom'];
		
	if(!empty($args['append']))
		echo ' '.$args['append'] . ' ';
		
	if(!empty($desc))
		echo ' <div class="description">'.$desc.'</div>';
		
	echo $after_row;
}

function dp_form_field($args = '') {
	if(empty($args['type']))
		return;

	$defaults = array(
		'name' => '',
		'value' => '',
		'class' => '',
		'id' => '',
		'options' => '',
		'sep' => '',
		'label' => '',
		'label_for' => '',
		'style' => '',
		'field_args' => '',
		'echo' => true
	);
	
	if($args['type'] == 'text')
		$defaults['class'] = 'widefat';
	elseif($args['type'] == 'textarea')
		$defaults['class'] = 'widefat';
	elseif($args['type'] == 'multiselect')
		$defaults['style'] = 'height:8em;';
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	if($args['type'] == 'upload') {
		$class .= ' dp-upload-text';
	} elseif( $args['type'] == 'color' ) {
		$class .= 'dp-color-input';
	}
	
	if(!empty($class)) 
		$class = ' class="'.$class.'"';
	if(empty($id) && !empty($name))
		$id = $args['id'] = sanitize_html_class($name);
	if(empty($label_for) && !empty($id))
		$label_for = ' for="'.sanitize_html_class($id).'"';
	if(!empty($id))
		$id = ' id="'.$id.'"';
	if(!empty($style))
		$style = ' style="'.$style.'"';
		
	$output = null;
	
	/* type = text, password, hidden */
	if($type == 'text' || $type == 'password' || $type == 'hidden') {
		$type = ' type="'.$type.'"';
		if(!empty($name)) $name = ' name="'.$name.'"';
		if($type == 'password') $value="";
		$value = ' value="' . esc_attr($value) . '"';
		
		$output = "<input{$type}{$name}{$value}{$id}{$class}{$style} />";
	}
		
	/* type = upload */
	elseif($type == 'upload') {
		$type = ' type="text"';
		$value = ' value="' . esc_attr(stripslashes($value)) . '"';
		if(!empty($name))
			$name = ' name="'.$name.'"';

		$output = "<input{$type}{$name}{$value}{$id}{$class}{$style} />";
		$output .= ' &nbsp; <a title="" class="button dp-upload-button" href="'.get_upload_iframe_src('image').'">Upload</a> <a href="#" class="button dp-remove-button">Remove</a> <div class="dp-upload-preview"></div>';
	} 
	
	/* type = image_id */
	elseif($type == 'image_id') {
		$output = apply_filters($args['name'].'_filter', ' ', $args);
	} 
	
	/* type = color */
	elseif($type == 'color') {
		$type = ' type="text"';
		$value = ' value="' . esc_attr(stripslashes($value)) . '"';
		if(!empty($name))
			$name = ' name="'.$name.'"';

		$output = "<span class='dp-color-handle colorSelector'>&nbsp;</span> <input{$type}{$name}{$value}{$id}{$class}{$style}>";
	}
	
	/* type = textarea */
	elseif($type == 'textarea') {
		$value = esc_textarea($value);
		if(!empty($name)) $name = ' name="'.$name.'"';
		if(!isset($args['cols'])) $cols = '10';
		if(!isset($args['rows'])) $rows = '6';
		$cols = ' cols="' . $cols . '"';
		$rows = ' rows="' . $rows . '"';

		$output .= "<textarea{$name}{$id}{$class}{$style}{$rows}{$cols}>{$value}</textarea></div>";
	}
	
	/* type = editor */
	elseif($type == 'editor') {
		$field_args = array_merge(array('textarea_name' => $name, 'textarea_rows' => 4), (array)$field_args);
		wp_editor($value, $args['id'], $field_args);
	}
	
	/* type = radio */
	elseif($type == 'radio' && is_array($options)) {
		foreach ($options as $option => $label) {
			if(!is_assoc($options))
				$option = $label;
				
			$output[] = '<label'.$label_for.'><input name="'.$name.'" type="radio" value="'.$option.'"'.checked($option, $value, false).' />'.$label.'</label>';
		}
	
		$output = implode( ($sep ? $sep : '<br />'), $output);
	}
	
	/* type = select */
	elseif($type == 'select' && is_array($options)) {
		$name = !empty($name) ? 'name="'.$name.'"' : '';
	
		$output .= "<select{$id}{$class}{$name}{$style}>";
		
		if(isset($args['option_none']))
			$output .= '<option value="">'.$args['option_none'].'</option>';
		
		/*foreach ($options as $option => $label) {
				$output .= '<option value="'.$option.'"'.selected($option, $value, false).'>'.$label.'</option>';
			}*/
		if(is_assoc($options)) {
			foreach ($options as $option => $label) {
				$output .= '<option value="'.$option.'"'.selected($option, $value, false).'>'.$label.'</option>';
			}
		} else {
			foreach ($options as $option => $label) {
				$output .= '<option value="'.$label.'"'.selected($label, $value, false).'>'.$label.'</option>';
			}
		}
		
		$output .= '</select> ';
	}
	
	/* type = multiselect */
	elseif($type == 'multiselect' && is_array($options)) {
		$output .= '<select multiple="multiple" name="'.$name.'[]"' . $id . $class . $style . '>';
		foreach ($options as $option => $label) { 
			if(!is_assoc($options))
				$option = $label;

				$selected = (is_array($value) && in_array($option, $value)) ? ' selected="selected"' : '';
				
			$output .= '<option value="'.$option.'"'.$selected.'>'.$label.'</option>';
		} 
		$output .= '</select>';
	}
	
	/* type = checkbox */
	elseif($type == 'checkbox') {
		$output .= '<label'.$label_for.'><input'.$id.' name="'.$name.'" type="checkbox" value="1"'.checked($value, true, false).' /> '.$args['label'].'</label> ';
	}
	
	/* type = checkboxes */
	elseif($type == 'checkboxes' && is_array($options)) {
		
		foreach ($options as $option => $label) {
	
			if(!is_assoc($options))
				$option = $label;
				
			$checked = (is_array($value) && in_array($option, $value)) ? ' checked="checked"' : '';
				
			$output[] = '<label><input'.$class.$style.' name="'.$name.'[]" type="checkbox" value="'.$option.'"'.$checked.' /> '.$label.'</label>';
		}
		
		$output = '<div class="dp-checkboxes">' . implode($args['sep'] ? $args['sep'] : '<br />', $output) . '</div>';
	}
	
	if($echo)
		echo $output;
	else
		return $output;
}

function dp_field_options( $fields = array() ) {
	$options = array();
	
	foreach($fields as $field) {
		global $post;
			
		if( !empty($field['fields']) && $field['type'] == 'fields' ) {
			$options = array_merge_recursive( $options, dp_field_options($field['fields']) );
		} else {
			if(empty($field['name']) )
				continue;
				
			$name = $field['name'];
			$name = str_replace('[]', '', $name);
			$name = str_replace(']', '', $name);
			$name = explode('[', $name);
			
			$option = array();
			
			for($i=count($name) - 1; $i>=0; $i--) {
				if($i == count($name) - 1) {
					$option[$name[$i]] = isset($field['value']) ? $field['value'] : '';
				} else {
					$option[$name[$i]] = $option;
					// $option[$name[$i]] = array( $name[$i+1] => $option[$name[$i+1]] );

					unset( $option[$name[$i+1]] );
				}
			}
			
			$options = array_merge_recursive($options, $option);
		}
	}
	
	return $options;
}

function dp_instance_fields( $fields, $instance_type = '', $object = '') {
	$new_fields = array();
	
	foreach($fields as $field)
		$new_fields[] = dp_instance_field($field, $instance_type, $object);
		
	return $new_fields;
}

function dp_instance_field( $field, $instance_type = '', $object = '') {
	global $post;
		
		if(!empty($field['fields']) && $field['type'] == 'fields') {
			$field['fields'] = dp_instance_fields($field['fields'], $instance_type);
		} elseif(empty($field['name']) ) {
			return $field;
		} else {
			$name = $field['name'];
			$name = str_replace('[]', '', $name);
			$name = str_replace(']', '', $name);
			$name = explode('[', $name);
			
			if( $instance_type == 'post_meta' )
				$value = get_post_meta($post->ID, $name[0], true);
			elseif( $instance_type == 'user_meta' ) {
				$value = get_user_meta($object->ID, $name[0], true);
			} elseif( $instance_type == 'term_meta' )
				$value = get_term_meta($object->term_id, $name[0], true);
			else
				$value = get_option($name[0]);
				
			unset($name[0]);
			foreach($name as $n) {
				if( empty($value[$n]) ) {
					$value = '';
					break;
				}	
						
				$value = $value[$n];
			}
			
			$field['value'] = $value;
		}
		
	return $field;
}

function dp_get_logic_fields( $args = '' ) {
	
	$defaults = array(
		'include' => '',
		'exclude' => ''
	);
	$args = wp_parse_args($args, $defaults);
	extract($args); 
	
	$fields = array();
	
	/* Global */
	$fields['global'] = array(
		'name' => 'global',
		'title' => __('Global Settings', 'dp')
	);
	
	/* Front Page **/
	$fields['front_page'] = array(
		'name' => 'front_page',
		'title' => __('Front Page', 'dp')
	);
	
	// Home
	$fields['home'] = array(
		'name' => 'home',
		'title' => __('Blog Home', 'dp')
	);
	
	/* Single Post */
	$post_types = get_post_types(array('publicly_queryable' => true), 'objects');
	foreach($post_types as $type => $obj) {
		$fields['single_' . $type] = array(
			'name' => 'single_' . $type,
			'title' => sprintf( __('Single %s', 'dp'), $obj->labels->singular_name ),
			'group' => 'single',
		);
	}
	
	/* Post Type Archives */
	$post_types = get_post_types(array('has_archive' => true), 'objects');
	foreach($post_types as $type => $obj) {
		$fields['archive_' . $type] = array(
			'name' => 'archive_' . $type,
			'title' => sprintf( __('Post Type Archive: %s', 'dp' ), $obj->labels->singular_name ),
			'group' => 'post_type_archive'
		);
	}
	
	/* Taxonomy Archives */
	$taxonomies = get_taxonomies(array( 'show_ui' => true ), 'objects');
	foreach($taxonomies as $tax => $obj) {
		$fields['tax_' . $tax] = array(
			'name' => 'tax_' . $tax,
			'title' => sprintf( __('Taxonomy Archive: %s', 'dp'), $obj->labels->singular_name ),
			'group' => 'tax'
		);
	}
	
	/* Author Archives */
	$fields['author'] = array(
		'name' => 'author',
		'title' => __('Author Archive', 'dp')
	);
	
	/* Date Archives */
	$fields['date'] = array(
		'name' => 'date',
		'title' => __('Date Archive', 'dp')
	);
	
	/* Search Pages */ 
	$fields['search'] = array(
		'name' => 'search',
		'title' => __('Search Result Page', 'dp')
	);

	/* 404 */
	$fields['404'] = array(
		'name' => '404',
		'title' => __('404 Page', 'dp')
	);
	
	if( !is_array($include) )
		$include = array_filter(explode(',', $include));
		
	if( !is_array($exclude) )
		$exclude = array_filter(explode(',', $exclude));

	if( !empty($include) || !empty($exclude) ) {
		foreach( $fields as $index => $field ) {
			$key = isset($field['group']) ? $field['group'] : $index;
		
			if( ($include && !in_array($key, $include)) || ($exclude && in_array($key, $exclude)) )
				unset($fields[$key]);
		}
	}

	return $fields;
}

function dp_get_logic_option( $settings = '' ) {
	global $wp_query;
	
	if(empty($settings) || !is_array($settings))
		return;
	
	$defaults = array_keys( dp_get_logic_fields() );
	$settings = wp_parse_args($settings, $defaults);

	if ( is_front_page() )
		$r = $settings['front_page'];

	elseif ( is_home() )
		$r = $settings['home'];
	
	elseif( is_singular() ) {
		global $post;
		$r = $settings['single_'.$post->post_type];
	}

	elseif ( is_archive() ) {

		if ( is_category() || is_tag() || is_tax() ) {
			$term = $wp_query->get_queried_object();
			
			$r = $settings['tax_'.$term->taxonomy];
		}

		elseif ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
			$post_type = get_query_var( 'post_type' );
			
			$r = $settings['archive_'.$post_type];
		}

		elseif ( is_author() ) {
			$r = $settings['author'];

		} elseif ( is_date () ) {
			$r = $settings['date'];
		}
	}

	elseif ( is_search() ) {
		$r = $settings['search'];
	} 
	
	elseif ( is_404() ) {
		$r = $settings['404'];
	} 

	else {
		$r = $settings['global'];
	}
	
	$r = wp_kses_stripslashes($r);
	
	return $r;
}

/**
 * Helper functions to increase productivity
 *
 *  @package CP Framework
 * @subpackage Functions
 */

function dp_dir_path( $file = '' ) {
	$dir = dirname($file) ;
	$dir = str_replace('\\','/',$dir); // sanitize for Win32 installs
	$dir = trailingslashit($dir);
	
	return $dir;
}

function dp_dir_url( $file = '' ) {
	$dir = dp_dir_path( $file );

	$root = $_SERVER['DOCUMENT_ROOT'];
	$root = str_replace('\\\\', '/', $root);
	
	$url = substr( $dir, strlen($root) );
	
	$scheme = is_ssl() && !is_admin() ? 'https://' : 'http://';
	$url = $scheme . trailingslashit($_SERVER['HTTP_HOST'].'/') . $url;
	
	return $url;
}

function is_robot(){
    static $is_robot = null;

    if(null == $is_robot){
    $is_robot = false;
    $robotlist = 'bot|spider|crawl|nutch|lycos|robozilla|slurp|search|seek|archive';
    if( isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/{$robotlist}/i", $_SERVER['HTTP_USER_AGENT']) ){
    $is_robot = true;
    }
    }

    return $is_robot;
} 
 
function wp_mshot($url = '', $width = 250) {

	if ($url != '') {
		return 'http://s.wordpress.com/mshots/v1/' . urlencode(clean_url($url)) . '?w=' . $width;
	} else {
		return '';
	}

} 
 
/**
 * Check a string within a string, this function will be useful 
 * when strpos() doesn't determine correctly.
 *
 * @since 1.0
 * @param string $a Finding in this string.
 * @param string $b Finding this string.
 */
function in_str($string, $find) {
	$check = explode($find, $string);
	return (count($check) > 1);
}

function is_url($url) {
    $info = parse_url($url);
    return ($info['scheme']=='http' || $info['scheme']=='https') && $info['host'] != "";
} 

function is_image($handler) {
    $ext = preg_match('/\.([^.]+)$/', $file, $matches) ? strtolower($matches[1]) : false;
	$image_exts = array('jpg', 'jpeg', 'gif', 'png');
	
	return in_array($ext, $image_exts);
}  

/**
 * Check if an array is associative.
 *
 * @since 1.0
 * @param array $arr
 * @return bool
 */
function is_assoc($arr) {
    return array_keys($arr) !== range(0, count($arr) - 1);
}

/**
 * Sanitize a string for filed name.
 *
 * Keys are used as internal identifiers. Lowercase alphanumeric characters and underscores are allowed.
 *
 * @since 1.0
 *
 * @param string $name String name
 * @return string Sanitized name
 */
function sanitize_field_name($name) {
	$raw_name = $name;
	$name = strtolower( $name );
	$name = preg_replace( '/[^a-z0-9_\[\]]/', '_', $name );
	return apply_filters( 'sanitize_field_name', $name, $raw_name );
}

function sanitize_field_value($value) {
	$raw_value = $value;
	$value = strtolower( $value );
	$value = preg_replace( '/[^a-z0-9_]/', '_', $value );
	return apply_filters( 'sanitize_field_value', $value, $raw_value );
}

/**
 * Sanitize a string for field id or class.
 *
 * Keys are used as internal identifiers. Lowercase alphanumeric characters and dashes are allowed.
 *
 * @since 1.0
 *
 * @param string $id String id
 * @return string Sanitized id
 */
function sanitize_field_id($id) {
	$raw_id = $id;
	$id = strtolower( $id );
	$id = str_replace(']', '', $id);
	$id = preg_replace( '/[^a-z0-9\-]/', '-', $id );
	return apply_filters( 'sanitize_field_id', $id, $raw_id );
}

function pre_print_r($r, $clean = true) {
	$r =  print_r($r, 1);
	if($clean)
		$r =  esc_html($r);
			
	echo '<pre>'.$r.'</pre>';
}

function pre_var_export($r, $clean = true) {
	$r =  var_export($r, true);
	if($clean)
		$r =  esc_html($r);
			
	echo '<pre>'.$r.'</pre>';
}

/**
 * Sort an two-dimension array by the level two values use array_multisort() function.
 *
 */
function mdsort() {
	$args = func_get_args();
	
	$array = array_shift($args);
	
	if (!is_array($array))
		return false;
		
	$params = array();
	
	foreach ($args as $arg) {
		if (is_string($arg)) {
			$sort = array();
			foreach ($array as $key => $row)
				$sort[$key] = $row[$arg];
		
			$params[] = $sort;
		} else
			$params[] = $arg;
	}
	
	$params[] = &$array;
	
	call_user_func_array("array_multisort", $params);
	
	return $array;
}

function dp_dir2url( $path = '', $dir = '' ) {
	if( !$dir )
		$dir = __FILE__;

	$dir = dirname(plugin_basename($dir));
	
	$url = substr( $dir, strlen($_SERVER['DOCUMENT_ROOT']) );
	$scheme = is_ssl() && !is_admin() ? 'https://' : 'http://';
	$url = $scheme . $_SERVER['HTTP_HOST'] . $url;
	$url = trailingslashit($url);
	
	if ( !empty($path) && is_string($path) && strpos($path, '..') === false )
		$url .= '/' . ltrim($path, '/');
		
	return $url;
}

function strip_empty_tags($content = '') {
	if($content == '')
		return;

	return preg_replace("#<[^>/]+>\s</[^>/]+>#", '', $content);
}

function get_current_url($query_string = true) {
	$scheme = !empty($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on" ? 'https://' : 'http://';
	
	$url = $_SERVER['REQUEST_URI'];
	if(!$query_string)
		$url = str_replace('?'.$_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
	
	$url = $scheme . $_SERVER['HTTP_HOST'] . $url;
	
	return $url;
}

function get_ip() {
	$ip = '';
	
	if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP"); 
	elseif(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
		$ip = getenv("REMOTE_ADDR"); 
	elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
		$ip = $_SERVER['REMOTE_ADDR']; 

	return $ip;
}

/**
 * Shorten long numbers to K/M/B (Thousand, Million and Billion)
 *
 * @param int $number The number to shorten.
 * @param int $decimals Precision of the number of decimal places.
 * @param string $suffix A string displays as the number suffix.
 */
if(!function_exists('short_number')) {
function short_number($n, $decimals = 2, $suffix = '') {
	if(!$suffix)
		$suffix = 'K,M,B';
	$suffix = explode(',', $suffix);

    if ($n < 1000) { // any number less than a Thousand
        $shorted = number_format($n);
    } elseif ($n < 1000000) { // any number less than a million
        $shorted = number_format($n/1000, $decimals).$suffix[0];
    } elseif ($n < 1000000000) { // any number less than a billion
        $shorted = number_format($n/1000000, $decimals).$suffix[1];
    } else { // at least a billion
        $shorted = number_format($n/1000000000, $decimals).$suffix[2];
    }

    return $shorted;
}
}

/**
 * Determines the difference between two timestamps.
 *
 * The difference is returned in a human readable format such as "1 hour",
 * "5 mins", "2 days".
 *
 * @param int $from Unix timestamp from which the difference begins.
 * @param int|string $to Optional. Unix timestamp to end the time difference, or time type either 'mysql' or 'timestamp'. Default becomes current_time('timestamp') if not set.
 * @param int $limit Optional. The number of unit types to display (i.e. the accuracy). Defaults to 1. 
 * @return string Human readable time difference.
 */
function relative_time( $from, $to = '', $limit = 1 ) {
	// Since all months/years aren't the same, these values are what Google's calculator says
	$units = apply_filters( 'time_units', array(
			31556926 => array( __('%s year', 'dp'),  __('%s years', 'dp') ),
			2629744  => array( __('%s month', 'dp'), __('%s months', 'dp') ),
			604800   => array( __('%s week', 'dp'),  __('%s weeks', 'dp') ),
			86400    => array( __('%s day', 'dp'),   __('%s days', 'dp') ),
			3600     => array( __('%s hour', 'dp'),  __('%s hours', 'dp') ),
			60       => array( __('%s min', 'dp'),   __('%s mins', 'dp') )
	) );

	if($to == 'mysql')
		$to = mysql2date('U', current_time('mysql'));
	elseif($to == 'timestamp')
		$to = current_time('timestamp');
	elseif(empty($to))
		$to = time();
	
	$diff = (int)abs($to - $from);

	$items = 0;
	$output = array();

	foreach ( $units as $unitsec => $unitnames ) {
		if ( $items >= $limit )
			break;

		if ( $diff < $unitsec )
			continue;

		$numthisunits = floor( $diff / $unitsec );
		$diff = $diff - ( $numthisunits * $unitsec );
		$items++;

		if ( $numthisunits > 0 )
			$output[] = sprintf( _n( $unitnames[0], $unitnames[1], $numthisunits ), $numthisunits );
	}

	// translators: The seperator which seperates the years, months, etc.
	$seperator = _x( ', ', 'human_time_diff', 'dp' );

	if ( !empty($output) ) {
		return implode( $seperator, $output );
	} else {
		$smallest = array_pop( $units );
		return sprintf( $smallest[0], 1 );
	}
}

if(!function_exists('mb_strimwidth')) {
function mb_strimwidth($str ,$start , $width ,$trimmarker='' ){
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
    return $output.$trimmarker;
}
}
/**
 * Convert array to attributes string
 */
function arr2atts($array = array(), $include_empty_att = false) {
	if(empty($array))
		return;
	
	$atts = array();
	foreach($array as $key => $att) {
		if(!$include_empty_att && empty($att))
			continue;
		
		$atts[] = $key.'="'.$att.'"';
	}
	
	return ' '.implode(' ', $atts);
}

/**
 * Get Video Thumbnail URL
 *
 * @param string $size Optional. Image size. Defaults to 'custom-medium';.
 */ 
function dp_thumb_url($size = 'custom-medium', $default = '', $post_id = null, $echo = false){
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
	if(!$size)
		$size == 'custom-medium';
	
	/* Check if this video has a feature image */
	if(has_post_thumbnail() && $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size))
		$thumb_url = $thumb[0];

	/* If no feature image, try to get thumbnail by "Video Thumbnails" plugin */
	if(empty($thumb_url) && function_exists('get_video_thumbnail')) {
		$video_thumbnail = get_video_thumbnail($post_id);
		if(!is_wp_error($video_thumbnail))
			$thumb_url = $video_thumbnail;
	}

	/* If this is a video by jplayer, try to get thumbnail from video_posts */
	if(empty($thumb_url) && $poster = get_post_meta($post_id, 'cp_video_poster', true))
		$thumb_url = $poster;
	
	/* If still no image or is wp error, define default image */
	if(empty($thumb_url) || is_wp_error($thumb_url)) {
		if($default === false || $default === 0)
			return false;
		
		$thumb_url = !empty($default) ? $default : get_template_directory_uri().'/images/nothumb.png';
	}
		
	if($echo)
		echo $thumb_url;
	else
		return $thumb_url;
} 
 
/**
 * Display Video Thumbnail HTML
 *
 * @param int $size Optional. Image size. Defaults to 'custom-medium';.
 */
function dp_thumb_html($size = 'custom-medium', $default = '', $post_id = null, $echo = true) {
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
	if(!$size)
		$size == 'custom-medium';
	
	// Get thumb url
	$thumb_url = dp_thumb_url($size, $default, $post_id, false);

	$html = '
	<div class="thumb">
		<a class="clip-link" data-id="'.$post->ID.'" title="'.esc_attr(get_the_title($post_id)).'" href="'.get_permalink($post_id).'">
			<span class="clip">
				<img src="'.$thumb_url.'" alt="'.esc_attr(get_the_title($post_id)).'" /><span class="vertical-align"></span>
			</span>
							
			<span class="overlay"></span>
		</a>
	</div>';
	
	if($echo)
		echo $html;
	else
		return $html;
} 

add_theme_support('post-formats', array( 'video'));


function dp_parse_query_args($args) {
	$defaults = array(
		'post_type' => 'post',
		'ignore_sticky_posts' => true,
		'orderby' => 'date',
		'order' => 'desc',
		'cat' => '',
		'tax_query' => '',
		'taxonomies' => array(),
		'meta_key' => '',
		'post__in' => '',
		'current_cat' => '',
		'current_author' => ''
	);
	$args = wp_parse_args($args, $defaults);
	// extract($args);
	
	// Set post_type
	if($args['post_type']=='all') {
		$post_types = get_post_types(array('public'=>true), 'names');
		unset($post_types['page']);
		unset($post_types['attachment']);
		$args['post_type'] = $post_types;
	}
	
	// Set post__in, ignore other arguments and return
	if(!empty($args['post__in']) && !is_array($args['post__in'])) {
		$args['post__in'] = explode(',', $args['post__in']);
		return $args; 
	}
	
	// Set tax_query
	$taxes = array_filter($args['taxonomies']);
	if(!empty($taxes)) {
		foreach($taxes as $tax=>$terms) {
			$args['tax_query']['relation'] = 'AND';
			
			if($tax=='post_format' && ($terms=='-1' || $terms=='standard')) {
				$post_formats = get_theme_support('post-formats');
				$terms = array();
				foreach ($post_formats[0] as $format) {
					$terms[] = 'post-format-'.$format;
				}
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => 'NOT IN'
				);
			} elseif($tax == 'post_tag') {
				if(!is_array($terms))
					$terms = explode(',', trim($terms));
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => 'IN'
				);
			} else {
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'id',
					'terms' => (array)$terms,
					'operator' => 'IN'
				);
			}
		}
	}

	// Set 'author' to current author id on author archive page if 'current_author' is true
	if(!empty($args['current_author']) && is_author())
		$args['author'] = dp_get_queried_user_id();

	// Set 'cat' to current cat id on category archive page if 'current_cat' is true
	if(!empty($args['current_cat']) && is_category())
		$args['cat'] = get_queried_object_id();

	return $args;
}

// Filter to "pre_get_posts" to change query vars
add_action( 'pre_get_posts', 'dp_custom_get_posts' );
function dp_custom_get_posts( $query ) {
	if(is_admin())
		return;
		
	$orderby = $query->get('orderby');
	$order = $query->get('order');
	
	// If no 'orderby' specified, get first sort type from selected sort types
	if(is_main_query() && !empty($selected_sort_types) && empty($orderby)) {
		$_sort_types = array_keys($selected_sort_types);
		$orderby = $_sort_types[0];
		$query->set('orderby', $orderby);
	}
	
	// Reset query vars based orderby parameter
	if($orderby == 'comments') {
		$query->set('orderby', 'comment_count');
	} 
	elseif($orderby == 'views') {	
		$query->set('orderby', 'meta_value_num');
		$query->set('meta_key', 'views');
		
		// The arguments for BAW Post Views Count plugin
		if(function_exists('baw_pvc_main')) {
			global $timings;
			$views_timing = $query->get('views_timing') ? $query->get('views_timing') : 'all';
			$date = $views_timing == 'all' ? '' : '-'. date( $timings[$views_timing] );
			$meta_key = apply_filters( 'baw_count_views_meta_key', '_count-views_' . $views_timing . $date, $views_timing, $date );
			$query->set('meta_key', $meta_key);
		}
	} 
	elseif($orderby == 'likes') {	
		$query->set('orderby', 'meta_value_num');
		$query->set('meta_key', 'likes');
	} 
	elseif($orderby == 'title' && !$order) {
		// If order by title, and no order specified, set "ASC" as default order.
		$query->set('order', 'ASC');
	}

	// Only display posts on search results page
	if (is_search() && $query->is_main_query())
		$query->set('post_type', 'post');
	
	// Make tax_query support "post-format-standard"
	$tax_query = $query->get('tax_query');
	
	if(!empty($tax_query)) {
		foreach($tax_query as $index => $single_tax_query) {
			if(empty($single_tax_query['terms']))
				continue;
			
			$in_post_formats = (array)$single_tax_query['terms'];
			
			if($single_tax_query['taxonomy'] == 'post_format'
			&& $single_tax_query['field'] == 'slug'
			&& in_array('post-format-standard', $in_post_formats)) {
				// Get reverse operator
				$reverse_operator = 'IN';
				if(empty($single_tax_query['operator']) || $single_tax_query['operator'] == 'IN')
					$reverse_operator = 'NOT IN';
				elseif($single_tax_query['operator'] == 'AND')
					break;
				
				// Get "not in post formats"
				$post_formats = get_theme_support('post-formats');
				$all_post_formats = array();
				if(is_array( $post_formats[0])) {
					$all_post_formats = array();
					foreach($post_formats[0] as $post_format)
						$all_post_formats[] = 'post-format-'.$post_format;
				}
				$not_in_post_formats = array_diff($all_post_formats, $in_post_formats);
				
				// Reset post_format in tax_query
				$query->query_vars['tax_query'][$index] = array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => $not_in_post_formats,
					'operator' => $reverse_operator
				);
			}
		}
	}
	
	return $query;
}