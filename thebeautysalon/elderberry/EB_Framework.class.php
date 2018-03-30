<?php
/** Elderberry Framework
  *
  * The file houses the main Elderberry Framework class.
  *
  * @package Elderberry
  *
  */

/** Elderberry Framework Class
  *
  * The main class for the Elderberry Framework. It takes care of numerous
  * runtime/installation tasks as well as handling general tasks.
  *
  */
class EB_Framework {

	/** Configuration Array
	  *
	  * The array of config options passed to the framework as
	  * defined in the config.php file. See the config.php
	  * file or the config.sample.php file in samples directory.
	  *
	  * @var array
	  * @access public
	  *
	  */
	public $config;

	/** Defaults
	  *
	  * This array of defaults for the current theme, as
	  * defined in the defaults.php file. See the defaults.php
	  * file or the defaults.sample.php file in the samples
	  * directory.
	  *
	  * @var array
	  * @access public
	  *
	  */
	public $defaults;

	/** Framework Constructor
	  *
	  * Takes care of a multitude of tasks when the framework is initiated.
	  * It makes sure all the required config options are available, sets
	  * the defaults, the theme options, and more.
	  *
	  * @param array $config The configuration settings
	  * @param array $defaults The default settings
	  *
	  */
	function __construct( $config, $defaults ) {

		// Basic Setup
		$this->check_config();
		$this->config = $config;
		$this->defaults = $defaults;
		$this->set_options();

		// Create Theme Option Controls
		$this->option_controls = new EB_Controls( $this, 'option', array( 'appearance_page_eb-theme-options' ) );
		$this->custom_field_controls = new EB_Controls( $this, 'custom_fields', array( 'post' ) );


		// Set Up Theme Options
		add_action( 'admin_menu', array( $this, 'theme_options_page') );
		add_action( 'wp_ajax_action_save_options', array( $this, 'action_save_options' ) );
		add_action( 'wp_ajax_action_reset_options', array( $this, 'action_reset_options' ) );

		// Set Up Custom Fields
		add_filter( 'redirect_post_location', array( $this, 'post_save_redirect') );
		add_action( 'add_meta_boxes', array( $this, 'remove_custom_fields_meta_box' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_custom_fields_meta_box' ) );
		add_action( 'save_post', array( $this, 'custom_fields_save' ) );

		// Set Up Sidebars and Widgets
		$this->setup_sidebars();

		// Set Up Menus
		$this->setup_menus();

		// Set up Shortcodes
		$this->shortcodes = new EB_Shortcodes( $this );

		// Set Up Custom Post Types
		$this->setup_post_types();

		// Set Up Custom Taxonomies
		$this->setup_taxonomies();

		// Set Up Meta Boxes
		$this->setup_metaboxes();

		// Set up Google Fonts
		add_action( 'wp_head', array( $this, 'set_fonts' ) );

		// Backend Editor
		add_editor_style( 'elderberry/themes/' . EB_ADMIN_THEME_NAME . '/css/editor.css' );

		// Image Sizes

		add_image_size( 'eb_col_1', 1140, 9999 );
		add_image_size( 'eb_col_2', 558, 9999 );
		add_image_size( 'eb_col_3', 364, 9999 );
		add_image_size( 'eb_col_4', 267, 9999 );
		add_image_size( 'eb_col_5', 209, 9999 );
		add_image_size( 'eb_col_6', 170, 9999 );

		add_image_size( 'eb_xlarge_thumb', 400, 400, true );
		add_image_size( 'eb_large_thumb', 200, 200, true );
		add_image_size( 'eb_thumb', 120, 120, true );
		add_image_size( 'eb_admin_thumb', 160, 64 );


		add_filter('the_content', array( $this, 'clean_shortcodes' ) );
		if (!is_admin()) {
			add_filter('widget_text', 'do_shortcode', 11);
		}
		add_filter('widget_text', array( $this, 'clean_shortcodes' ), 10 );
		//add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));

	}


	/** Undefined Method Handler
	  *
	  * This method is set up so that if we are in a test
	  * environment, calling an undefined function throws a nice
	  * error. However, in a production environment it let's
	  * everything move on without an error.
	  *
	  * @param string $method The name of the method called
	  * @param array $args The args the method was called with
	  *
	  */
	function __call( $method, $args ) {
		$message ='
			<p>
				You are using a function you haven\'t defined: <strong>' . $method . '()</strong>
			</p>
		';
		$this->fatal_error( $message );

	}


	/********************************************************/
	/*                    !Theme Options                    */
	/********************************************************/

	/*********************************************/
	/*             Atomic Operations             */
	/*********************************************/

	/** Load Options
	  *
	  * Loads the options from the WordPress options table.
	  * If we don't have any saved options yet, we get
	  * the defaults.
	  *
	  * @see $options
	  * @uses get_default_options()
	  *
	  */
	function set_options() {
		$options = get_option( EB_OPTION_NAME );
		if( empty( $options ) ) {
			$options = $this->get_default_options();
			$this->save_options( $options );
		}
		$this->options = $options;
	}

	/** Delete Options
	  *
	  * Deletes the options from the database. After deletion
	  * it pulls the default options for us. This is effectively
	  * a factoru reset.
	  *
	  * @see $options
	  * @uses get_default_options()
	  *
	  */
	function delete_options() {
		delete_option( EB_OPTION_NAME );
		$this->options = $this->get_default_options();
	}

	/** Delete Single Option
	  *
	  * Deletes a simgle option by setting its value to
	  * empty. It is basically an alias for update_option()
	  *
	  * @param string $name The name of the option to delete
	  *
	  * @see $options
	  * @uses update_option()
	  *
	  */
	function delete_option( $name ) {
		$this->update_option( $name, '' );
	}

	/** Update Single Option
	  *
	  * Update the value of a single option. It first sets
	  * the value in the $options variable, then saves the
	  * whole thing to the database.
	  *
	  * @param string $name The name of the option to change
	  * @param string $value The new value of the option
	  *
	  * @see $options
	  * @uses save_options()
	  *
	  */
	function update_option( $name, $value ) {
		$this->options[$name] = $value;
		$this->save_options();
	}

	/** Get Single Option
	  *
	  * Find the valie of a single option
	  *
	  * @param string $name The name of the option to get
	  *
	  * @see $options
	  *
	  * @return mixed
	  *
	  */
	function get_option_value( $name ) {
		if( empty( $this->options[$name] ) ){
			return '';
		}
		return $this->options[$name];
	}

	/** Save Options
	  *
	  * Saves a new options array to the database. If no
	  * options are given, it uses the value of the $options
	  * variable as the new option array.
	  *
	  * It makes sure we don't save any empty data and fills
	  * up the $options variable with the new data once it
	  * has been saved.
	  *
	  * @param array $new_options The new options to save
	  *
	  * @see $options
	  * @uses check_options()
	  *
	  */
	function save_options( $new_options = array() ) {
		if( empty( $new_options ) ) {
			$new_options = $this->options;
		}

		$new_options = $this->check_options( $new_options );


		update_option( EB_OPTION_NAME, $new_options );

		$this->options = $new_options;

	}


	/*********************************************/
	/*             Helper Functions              */
	/*********************************************/

	/** Option Checker
	  *
	  * Makes sure that we don't save any empty data that
	  * we shouldn't. If something is empty it will check
	  * if it can be empty. If it can then the empty value
	  * is used. If it can not it will use the default or
	  * the 'empty_value', depending on weather and empty
	  * value is allowed or not.
	  *
	  * @param array $options The options to check
	  *
	  * @see $options
	  * @uses get_options_data()
	  *
	  * @return array $options The checked and modified options
	  *
	  */
	function check_options( $options ) {
		$default_options = $this->get_control_data( 'option' );
		foreach( $default_options as $name => $data ) {
			if( is_array( $data['default'] ) ) {
				foreach( $data['default'] as $subname => $subdata ) {
					$value = ( empty( $options[$name][$subname] ) ) ? '' : $options[$name][$subname];
					$empty_value = ( empty( $data['empty_value'][$subname] ) ) ? '' : $data['empty_value'][$subname];
					$options[$name][$subname] = $this->get_checked_value( $value, $data['allow_empty'][$subname], $empty_value, $data['default'][$subname] );
				}
			}
			else {
				$value = ( empty( $options[$name] ) ) ? '' : $options[$name];

				$empty_value = ( empty( $data['empty_value'] ) ) ? '' : $data['empty_value'];
				$options[$name] = $this->get_checked_value( $value, $data['allow_empty'], $empty_value, $data['default'] );
			}
		}

		foreach( $options as $name => $value ) {
			if( is_string( $value ) ) {
				$options[$name] = trim( $value );
			}
		}


		return $options;
	}

	function get_checked_value( $option_value, $allow_empty, $empty_value, $default_value ) {
		if( empty( $option_value ) ) {
			if ( $allow_empty == true ) {
				if( !empty( $empty_value ) ) {
					$option_value = $empty_value;
				}
				else {
					$option_value = '';
				}
			}
			else {
				$option_value = $default_value;
			}
		}

		return $option_value;
	}

	/** Get Default Options
	  *
	  * Retrieves a key-value list of the default options
	  *
	  * @see $options
	  *
	  * @return array $default_options The default options array
	  *
	  */
	function get_default_options() {

		$default_options = array();
		foreach( $this->defaults['option']['groups'] as $group ) {
			foreach( $group['tabs'] as $tab ) {
				foreach( $tab['items'] as $item ) {
					$default_options[$item['guid']] = $item['control']['default'];
				}
			}
		}
		return $default_options;
	}




	/*********************************************/
	/*             Display Functions             */
	/*********************************************/


	/** Add Options Page
	  *
	  * This function adds the Theme Options to the WordPress
	  * Admin area.
	  *
	  */
	function theme_options_page() {
		add_theme_page( 'Modify your theme options here', 'Theme Options', 'manage_options', 'eb-theme-options', array( $this, 'theme_options_show' ) );
	}


	/** Show Options
	  *
	  * This function initiates the display of the page
	  *
	  * @uses EB_Controls::set_type()
	  * @uses EB_Controls::show_controls()
	  *
	  */
	function theme_options_show() {
		if( !empty( $_GET['saved'] ) AND $_GET['saved'] == 'true' ) {
			echo '
				<div id="message" class="updated"><p>
				Your Settings Have Been Saved</p></div>
			';
		}

		echo '<div class="admin-page">';
		echo '<form class="eb-options-form" method="post" action="' . admin_url( 'admin-ajax.php' ) . '">';
		echo '<input type="hidden" name="action" value="action_save_options">';
		echo '<input type="hidden" name="location" value="">';
		$this->option_controls->show_controls( $this->defaults['option'], array( 'title' => 'Theme Options' ) );
		echo '</form>';
		echo '</div>';
	}


	/*********************************************/
	/*                User Actions               */
	/*********************************************/

	/** Save Options User Action
	  *
	  * The function run when the user initiates the option
	  * saving process. It saves the options and redirects
	  * the user to the proper location.
	  *
	  */
	function action_save_options() {
	    $_POST = array_map( 'stripslashes_deep', $_POST );
		$options = $this->save_options( $_POST );

		$redirect = $_SERVER['HTTP_REFERER'];
		if( substr_count( $redirect, '&saved=true' ) == 0 ) {
			$redirect .= '&saved=true';
		}

		$hash = '';
		if( !empty( $_POST['location'] ) ) {
			$hash = '#' . $_POST['location'];
		}

		header( 'Location: ' . $redirect . $hash );
		die();
	}


	/** Reset Options User Action
	  *
	  * The function run when the user initiates the option
	  * reset process. It removes all options and redirects
	  * the user to the proper location.
	  *
	  */
	function action_reset_options() {
		check_admin_referer( 'elderberry_reset_options' );
		$this->delete_options();
		header( 'location: ' . $_SERVER['HTTP_REFERER'] );
	}



	/********************************************************/
	/*                    !Custom Fields                    */
	/********************************************************/

	/*********************************************/
	/*             Atomic Operations             */
	/*********************************************/

	/** Custom Field Value
	  *
	  * Retrieves the value of a single custom field. $post->postmeta
	  * should already be set at this stage as it will make things more
	  * efficient.
	  *
	  * The function returns the correct value, which depends on weather
	  * or not the meta field exists and weather or not it's empty.
	  *
	  * @param object $post The WordPress post object
	  * @param string $name The name of the custom field we need
	  *
	  * @uses get_all_postmeta()
	  * @uses get_control_data()
	  * @uses get_post_type()
	  *
	  * @return mixed $value
	  *
	  */
	function get_custom_field_value( $post, $name ) {


		if( !isset( $post->postmeta ) ) {
			$post->postmeta = $this->get_all_postmeta( $post );
		}

		$data = $this->get_control_data( 'custom_fields', $this->get_post_type() );

		if( !isset( $post->postmeta[$name] ) ) {
			$value = $data[$name]['default'];
		}
		elseif( isset( $post->postmeta[$name] ) AND empty( $post->postmeta[$name] ) ) {
			if( $data[$name]['allow_empty'] == false ) {
				$value = $data[$name]['default'];
			}
			else {
				$value = ( empty( $data[$name]['empty_value'] ) ) ? '' : $data[$name]['empty_value'];
			}
		}
		elseif( isset( $post->postmeta[$name] ) AND !empty( $post->postmeta[$name] ) ) {
			$value = $post->postmeta[$name];
		}

		return $value;
	}

	/** Save Custom Fields
	  *
	  * Saves the custom field data for a post. It makes sure that all
	  * non-empty data has the correct value when saved.
	  *
	  * @uses get_control_data()
	  *
	  */
	function custom_fields_save() {

		if( empty( $_POST['post_ID'] ) OR ( defined( 'DOING_AUTOSAVE' ) AND DOING_AUTOSAVE ) OR ( defined( 'DOING_AJAX' ) AND DOING_AJAX ) ) {
			return false;
		}
		$custom_fields_data = $this->get_control_data( 'custom_fields', $this->get_post_type( $_POST['post_ID'] ) );

		$custom_fields = array();
		foreach( $_POST as $name => $value ) {
			if( in_array( $name, array_keys( $custom_fields_data ) ) ) {
				$custom_fields[$name] = $value;
			}
		}

		foreach ( $custom_fields_data as $name => $data ) {
			if( in_array( $name, array_keys( $custom_fields ) ) ) {
				if( empty( $custom_fields[$name] ) ) {
					if( $data['allow_empty'] ) {
						$custom_fields[$name] = ( empty( $data['empty_value'] ) ) ? '' : $data['empty_value'];
					}
					else {
						$custom_fields[$name] = $data['default'];
					}
				}
			}
			else {
				if( $data['allow_empty'] ) {
					$custom_fields[$name] = ( empty( $data['empty_value'] ) ) ? '' : $data['empty_value'];
				}
				else {
					$custom_fields[$name] = $data['default'];
				}
			}
		}

		foreach( $custom_fields as $name => $value ) {
			if( is_string( $value ) ) {
				$value = trim( $value );
			}

			$array = @unserialize( stripslashes( $value ) );
			if( is_array( $array ) ) {
				$value = $array;
			}
			update_post_meta( $_POST['post_ID'], $name, $value );
		}

	}

	/*********************************************/
	/*             Helper Functions              */
	/*********************************************/

	/** Save Hash Redirection
	  *
	  * Makes sure that the last screen of the options form is
	  * shown after a redirect. This is done by adding the
	  * proper hash after the URL.
	  *
	  * @param strong $location The location we need to add
	  *
	  * @return string $location The URL to return to
	  *
	  */
	function post_save_redirect( $location ) {
		if( !empty( $_POST['location'] ) ) {
			return $location .'#' . $_POST['location'];
		}
		return $location;
	}

	/** Get Post Type
	  *
	  * Figures out which page we are showing. This is used to
	  * display the correct custom field options for posts.
	  *
	  * The post type is the acutal post type for posts and pages.
	  * If we are on a page template, the page template is used.
	  *
	  * @return string $type The page type
	  *
	  */
	function get_post_type( $post_id = 0 ) {
		if( $post_id == 0 ) {
			global $post;
			$type = $post->post_type;
			if( !empty( $post->page_template ) ) {
				$page_template = $post->page_template;
			}
			if( !empty( $post->postmeta['_wp_page_template'] ) ) {
				$page_template = $post->postmeta['_wp_page_template'];
			}
		}
		else {
			$type = get_post_type( $post_id );
			$page_template = get_post_meta( $post_id, '_wp_page_template', true );
		}

		$type = ( empty( $page_template ) OR $page_template == 'default' ) ? $type : $page_template;

		$type = str_replace( '.php', '', $type );

		return $type;
	}


	/*********************************************/
	/*             Display Functions             */
	/*********************************************/

	/** Custom Field Options Box
	  *
	  * Adds the custom meta box we use to show the custom
	  * field options.
	  *
	  */
	function add_custom_fields_meta_box() {
		global $post;
		$page_type = $this->get_post_type();
		add_meta_box( 'eb-custom-fields', 'Additional settings', array( &$this, 'show_custom_fields' ), $post->post_type, 'normal', 'high' );
	}

	/** Remove Default Custom Fields Box
	  *
	  * Removes the default custom fields meta box from the backend.
	  * To remove the boxed the 'disable_meta' key must be set to 'yes'
	  * for the page in question. See the defaults.php file or the
	  * defaults.sample.php file in the samples directory for more info.
	  *
	  * @see $defaults
	  *
	  */
	function remove_custom_fields_meta_box() {
		foreach( $this->defaults['custom_fields']['groups'] as $name => $data ) {
			if( !empty( $data['disable_meta'] ) AND $data['disable_meta'] == 'yes' ) {
				remove_meta_box( 'postcustom', $name, 'normal' );
			}
		}
	}

	/** Show Custom Fields
	  *
	  * Initiates the showing of the custom fields box.
	  *
	  * @uses EB_Controls::show_controls()
	  *
	  */
	function show_custom_fields() {
		global $post;
		$post_type = $this->get_post_type();

		echo '<div class="eb-options-form">';
		echo '<input type="hidden" name="location" value="">';
		$this->custom_field_controls->show_controls( $this->defaults['custom_fields'], array( 'title' => 'Post/Page Options', 'group' => $post_type ) );
		echo '</div>';
	}


	function has_element( $element ) {
		global $post;
		$post_type = $this->get_post_type();
		$has_element = ( !empty( $this->options[$element] ) AND $this->options[$element] == 'yes' ) ? 'yes' : 'no';
		if( !empty( $post_type ) AND !empty( $this->options[$post_type .'_settings'][$element] ) ) {
			$has_element = ( $this->options[$post_type .'_settings'][$element] == 'default' ) ? $has_element : $this->options[$post_type .'_settings'][$element];
		}
		if( is_singular() ) {
			$has_element = ( empty( $post->postmeta[$element] ) OR $post->postmeta[$element] == 'default' ) ? $has_element : $post->postmeta[$element];
		}

		$has_element = ( $has_element == 'yes' ) ? true : false;

		return $has_element;
	}

	function get_sidebar_content() {
		global $post;
		$post_type = $this->get_post_type();

		$sidebar = $this->options['sidebar'];

		if( !empty( $post_type ) AND !empty( $this->options[$post_type .'_settings']['sidebar'] ) AND $this->options[$post_type .'_settings']['sidebar'] != 'default' ) {
			$sidebar = $this->options[$post_type .'_settings']['sidebar'];
		}
		if( is_singular() AND !empty( $post->postmeta['sidebar'] ) AND $post->postmeta['sidebar'] != 'default' ) {
			$sidebar = $post->postmeta['sidebar'];
		}

		return $sidebar;
	}

	function get_sidebar_position() {
		global $post;
		$post_type = $this->get_post_type();

		$sidebar = $this->options['sidebar_position'];

		if( !empty( $post_type ) AND !empty( $this->options[$post_type .'_settings']['sidebar_position'] ) AND $this->options[$post_type .'_settings']['sidebar_position'] != 'default' ) {
			$sidebar = $this->options[$post_type .'_settings']['sidebar_position'];
		}
		if( is_singular() AND !empty( $post->postmeta['sidebar'] ) AND $post->postmeta['sidebar_position'] != 'default' ) {
			$sidebar = $post->postmeta['sidebar_position'];
		}

		return $sidebar;
	}

	/********************************************************/
	/*                       !Widgets                       */
	/********************************************************/

	/** Setup Sidebars
	  *
	  * Sets the sidebars available by default using the 'sidebars'
	  * array in the defaults and the custom_sidebars theme option.
	  *
	  * @see $options
	  * @see $defaults
	  *
	  */
	function setup_sidebars() {

			register_sidebar( array(
				'name'           => 'Shop Sidebar',
				'id'             => 'shop-sidebar',
				'before_widget' => '<div class="box widget fbwidget scheme-light %2$s">',
				'after_widget'  => '<div class="end"></div></div>',
				'before_title'  => '<div class="widget-title"><h1 class="title-text">',
				'after_title'   => '</h1></div>',
			 ));


		$sidebars = $this->defaults['sidebars'];
		$custom_sidebars = explode( ',', $this->options['custom_sidebars'] );
		foreach( $custom_sidebars as $index => $sidebar ) {
			if( ! empty( $sidebar ) ) {
				$sidebars[$sidebar] = array( 'scheme' => 'content' );
			}
		}
		foreach( $sidebars as $name => $sidebar ) {
			register_sidebar( array(
				'name'           => $name,
				'id'             => sanitize_title_with_dashes( $name ),
				'before_widget' => '<div class="box widget fbwidget scheme-' . $sidebar['scheme'] . ' %2$s">',
				'after_widget'  => '<div class="end"></div></div>',
				'before_title'  => '<div class="widget-title"><h1 class="title-text">',
				'after_title'   => '</h1></div>',
			 ));
		}
	}

	/** Get Widget Field Value
	  *
	  * Finds the value of a settings field for a widget.
	  * It makes sure that empty values are handled well.
	  *
	  * @uses get_control_data()
	  *
	  * @param array $group The data of the options group the field is in
	  * @param string $name The name of the field
	  *
	  * @return mixed $value;
	  *
	  */
	function get_widget_field_value( $group, $name ) {
		$data = $this->get_control_data( 'widgets', $group['guid'] );
		if( !isset( $group['instance'][$name] ) ) {
			$value = $data[$name]['default'];
		}
		elseif( isset( $group['instance'][$name] ) AND empty( $group['instance'][$name] ) ) {
			if( $data[$name]['allow_empty'] == false ) {
				$value = $data[$name]['default'];
			}
			else {
				$value = ( empty( $data[$name]['empty_value'] ) ) ? '' : $data[$name]['empty_value'];
			}
		}
		elseif( isset( $group['instance'][$name] ) AND !empty( $group['instance'][$name] ) ) {
			$value = $group['instance'][$name];
		}


		return $value;
	}


	/********************************************************/
	/*                        !Menus                        */
	/********************************************************/

	/** Setup Menus
	  *
	  * Sets the menus available by default using the 'sidebars'
	  * array in the defaults and the custom_sidebars theme option.
	  *
	  * @see $defaults
	  *
	  */
	function setup_menus() {
		register_nav_menus( $this->defaults['menus'] );
	}


	/********************************************************/
	/*                     !Post Types                      */
	/********************************************************/

	/** Set Up Post Types
	  *
	  * Retrieves the custom post types from the defaults.php
	  * file and makes sure that they exist and executes
	  * the code to create them.
	  *
	  * @uses fatal_error()
	  *
	  */
	function setup_post_types() {

		foreach( $this->defaults['post_types'] as $post_type ) {
			if( !function_exists( 'eb_customposts_' . $post_type ) ) {
				$this->fatal_error('
					<p>
					You are trying to use a custom post type (' . $post_type . ') which you have not created a function for.
					</p>
					<p>
						Please create the <code>eb_customposts_' . $post_type . '()</code> function to handle your custom post type. While not required, we advise also creating the <code>eb_customposts_messages_' . $post_type . '()</code> function to handle the interaction messages.
					</p>
				');
			}

			add_action( 'init', 'eb_customposts_' . $post_type );

			if( function_exists( 'eb_customposts_messages_' . $post_type ) ) {
				add_filter( 'post_updated_messages', 'eb_customposts_messages_' . $post_type );
			}
		}

	}


	/********************************************************/
	/*                     !Taxonomies                      */
	/********************************************************/

	/** Set Up Taxonomies
	  *
	  * Retrieves the custom taxonomies from the defaults.php
	  * file and makes sure that they exist and executes
	  * the code to create them.
	  *
	  * @uses fatal_error()
	  *
	  */
	function setup_taxonomies() {

		foreach( $this->defaults['taxonomies'] as $taxonomy ) {

			if( !function_exists( 'eb_taxonomies_' . $taxonomy ) ) {
				$this->fatal_error('
					<p>
					You are trying to use a custom taxonomy (' . $taxonomy . ') which you have not created a function for.
					</p>
					<p>
						Please create the <code>eb_taxonomies_' . $taxonomy . '()</code> function to handle your taxonomy.
					</p>
				');
			}

			add_action( 'init', 'eb_taxonomies_' . $taxonomy );
		}

	}


	/********************************************************/
	/*                     !Meta Boxes                      */
	/********************************************************/

	/** Set Up Meta Boxes
	  *
	  * Retrieves the custom meta boxes from the defaults.php
	  * file and makes sure that they exist and executes
	  * the code to create them.
	  *
	  * @uses fatal_error()
	  *
	  */
	function setup_metaboxes() {

		foreach( $this->defaults['metaboxes'] as $metabox ) {

			if( !function_exists( 'eb_metabox_' . $metabox ) ) {
				$this->fatal_error('
					<p>
					You are trying to use a meta box (' . $metabox . ') which you have not created a function for.
					</p>
					<p>
						Please create the <code>eb_metabox_' . $metabox . '()</code> function to handle your meta box. While not required, we advise also creating the <code>eb_metabox_save_' . $metabox . '()</code> function to save the data from your meta box if needed.
					</p>
				');
			}

			add_action( 'add_meta_boxes', 'eb_metabox_' . $metabox );

			if( function_exists( 'eb_metabox_save_' . $metabox ) ) {
				add_action( 'save_post', 'eb_metabox_save_' . $metabox );
			}
		}

	}


	/********************************************************/
	/*                   !Font Functions                    */
	/********************************************************/



	/** Get Font To Display
	  *
	  * Builds the font stack from the use selection using the
	  * name as the main font and the fallbacks and type as
	  * the fallback fonts.
	  *
	  * @param string $font_type The font option to check
	  *
	  * @return string $font_display The font stack
	  *
	  */
	function get_font_display( $font_type ) {
		$font = $this->options[$font_type];
		$font_display = array();
		if( !empty( $font['name'] ) ) {
			$font_display[] = $font['name'];
		}
		if( !empty( $font['fallback'] ) ) {
			$font_display[] = $font['fallback'];
		}
		if( !empty( $font['type'] ) ) {
			$font_display[] = $font['type'];
		}

		$font_display = implode( ', ', $font_display );

		return $font_display;
	}





	function get_fontlist() {
		$fontlist = get_option( 'rf_fontlist' );
		if( empty( $fontlist ) ) {

			$fontlist = array();
			$fonts = unserialize( include( 'fontlist.php' ) );
			$fontlist = array();
			foreach( $fonts->items as $font ) {
				$fontlist[$font->family] = $font->variants;
			}

			$builtin = array(
				'Helvetica Neue'    => 'Helvetica Neue',
				'Helvetica'         => 'Helvetica',
				'Arial'             => 'Arial',
				'Times New Roman'   => 'Times New Roman',
				'Verdana'           => 'Verdana',
				'Georgia'           => 'Georgia',
			);

			foreach( $builtin as $font ) {
				$fontlist[$font] = array( 'regular', 700 );
			}

			update_option( 'rf_fontlist', $fontlist );
		}
		return $fontlist;
	}

	function get_fonts_array() {
		$fonts = $this->get_fontlist();
		$options = array();
		foreach( $fonts as $font => $variations ) {
			$options[$font] = $font;
		}

		return $options;
	}




	function set_fonts() {
		$fonts['heading'] = $this->options['heading_font'];
		$fonts['body'] = $this->options['body_font'];
		$fontlist = $this->get_fontlist();
		$request = 'http://fonts.googleapis.com/css?family=';

		$single_font = array();

		$builtin = array(
			'Helvetica Neue'    => 'Helvetica Neue',
			'Helvetica'         => 'Helvetica',
			'Arial'             => 'Arial',
			'Times New Roman'   => 'Times New Roman',
			'Verdana'           => 'Verdana',
			'Georgia'           => 'Georgia',
		);


		foreach( $fonts as $font ) {
			if( !in_array( $font['name'], $builtin ) ) {
				$single_request = $font['name'];
				$sizes = array( 400 );
				if( !empty( $fontlist[$font['name']] ) AND in_array( 200, $fontlist[$font['name']] ) ) {
					$sizes[] = 200;
				}
				if( !empty( $fontlist[$font['name']] ) AND in_array( 700, $fontlist[$font['name']] ) ) {
					$sizes[] = 700;
				}

				if( count( $sizes ) > 1 ) {
					$single_request .= ':' . implode( ',', $sizes );
				}

				$single_font[] = $single_request;
			}
		}

		$request .= implode( '|', $single_font );
		$request = str_replace( ' ', '+', $request );

		echo "<link href='" . $request . "' rel='stylesheet' type='text/css'>"

		?>



		<?php
	}


	/********************************************************/
	/*                 !Layout Management                   */
	/********************************************************/

	/** Get All Layouts
	  *
	  * Builds an array of available layouts by parsing the layouts
	  * directory in the theme. The layouts directory must have
	  * sub-directories for the layout types.
	  *
	  * @return array $layouts The available layouts
	  *
	  */
	function get_layouts() {
		if( !empty( $this->layouts ) ) {
			$layouts = $this->layouts;
			return $layouts;
		}

		$layout_folders = array();
		$handle = @opendir( get_template_directory() . '/layouts/' );
		if( !empty( $handle ) ) {
			while ( false !== ( $folder = readdir( $handle ) ) ) {
				if ( $folder != '.' AND $folder != '..' AND substr( $folder, 0, 1) != '.' ) {
					$layout_folders[] = $folder;
				}
			}
		}
		@closedir( $handle );

		$layouts = array();
		foreach( $layout_folders as $folder ) {
			$layout_files = array();
			$handle = @opendir( get_template_directory() . '/layouts/' . $folder );
			if( !empty( $handle ) ) {
				while ( false !== ( $file = readdir( $handle ) ) ) {
					if ( $file != '.' AND $file != '..' AND substr( $file, 0, 1) != '.' ) {
						$layout_files[] = $file;
					}
				}
			}

			@closedir( $handle );
			foreach( $layout_files as $layout_file ) {
				$file = get_template_directory() . '/layouts/' . $folder . '/' . $layout_file;
				$handle = fopen( $file, 'r' );
				for($i=0; $i<4; $i++ ) {
					$lines[$i] = fgets( $handle );
				}

				$id = str_replace( '.php', '', $layout_file );
				$layouts[$folder][$id] = array(
					'id' => $id,
					'name' => str_replace( '/**', '', trim( $lines[1] ) ),
					'description' => trim( $lines[2] )
				);

				fclose( $handle );
			}

			$this->layouts = $layouts;

		}

		return $layouts;

	}

	function get_layouts_for_documentation( $type = 'post' ) {
		if( $type != '' ) {
			$layouts = $this->get_layouts();
			$documentation = array();
			foreach( $layouts[$type] as $layout ) {
				$documentation[$layout['id']] = array(
					'name' => str_replace( 'layout-', '', $layout['id'] ),
					'description' => '',
				);
			}
			return $documentation;
		}
	}

	function get_layout( $type, $layout ) {
		return get_template_directory() . '/layouts/' . $type . '/layout-' . $layout . '.php' ;
	}


	/********************************************************/
	/*               !General Helper Functions              */
	/********************************************************/

	/***********************************************/
	/*              Backend Functions              */
	/***********************************************/


	/** Get Controls Data
	  *
	  * Retrieves information about a control type. It parses the
	  * appropriate sub-array of the $defaults array for
	  * controls and reads all the required data out of it.
	  *
	  * @see $defaults
	  *
	  * @param string $type The type of data we need the control data for
	  * @param string $group_name The group name, if only a specific one is needed
	  *
	  * @return array $default_options The default options array
	  *
	  */

	function get_control_data( $type, $group_name = '' ) {
		$control_data = array();
		foreach( $this->defaults[$type]['groups'] as $group_id => $group ) {
			if( empty( $group_name ) OR ( !empty( $group_name ) AND $group_name == $group_id ) ) {
				foreach( $group['tabs'] as $section ) {
					foreach( $section['items'] as $item ) {
						$default = ( !empty( $item['control']['default'] ) ) ? $item['control']['default'] : '';
						$allow_empty = ( !empty( $item['control']['allow_empty'] ) ) ? $item['control']['allow_empty'] : false;
						$empty_value = ( !empty( $item['control']['empty_value'] ) ) ? $item['control']['empty_value'] : false;
						$control_data[$item['guid']]['default'] = $default;
						$control_data[$item['guid']]['allow_empty'] = $allow_empty;
						$control_data[$item['guid']]['empty_value'] = $empty_value;
					}
				}
			}
		}

		return $control_data;

	}


	function get_colorbox_list() {
		$colorlist = '<div class="colorlist">';

		foreach( $this->defaults['colors'] as $name => $value ) {

			if( !empty( $this->options[$name . '_color'] ) ) {
				$value = $this->options[$name . '_color'];
			}

			$colorlist .= '<div class="color">
				<div class="colorbox" style="background:' . $value . '"></div>
				<span class="name">' . $name . '</span>
			</div>';
		}

		$colorlist .= '</div>';

		return $colorlist;
	}

	/***********************************************/
	/*               Option Helpers                */
	/***********************************************/


	function get_sidebars_array( $args = array() ) {
		$defaults = array_keys( $this->defaults['sidebars'] );
		$custom_sidebars = array();

		if( !empty( $this->options['custom_sidebars']  ) ) {
			$custom_sidebars = explode( ',', $this->options['custom_sidebars'] );
		}
		$all_sidebars = array_merge( $defaults, $custom_sidebars );
		$sidebars = array();
		foreach ( $all_sidebars as $sidebar ) {
			$sidebars[$sidebar] = $sidebar;
		}

		return $sidebars;

	}

	function get_pages_array( $args = array() ) {
		global $post;
		$page_args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'posts_per_page' => -1
		);

		if( !empty( $args['exclude'] ) ) {
			$page_args['meta_query'] = array(
		        array(
		            'key' => '_wp_page_template',
		            'value' => $args['exclude'],
		            'compare' => 'NOT IN',
		        )
		    );
		}

		if( !empty( $args['include'] ) ) {
			$page_args['meta_query'] = array(
		        array(
		            'key' => '_wp_page_template',
		            'value' => $args['include'],
		            'compare' => 'IN',
		        )
		    );
		}
		$pages = new WP_Query( $page_args );
		$options = array();

		if( !empty( $args['show_empty'] ) ){
				$options[$args['show_empty']] = '';
		}

		$temp_post = $post;
		if( $pages->have_posts() ) {
			while( $pages->have_posts() ) {
				$pages->the_post();
				$options[the_title('', '', false )] = get_the_ID();
			}
		}
		$post = $temp_post;
		return $options;

	}

	function get_taxonomies_array( $args = array() ) {
		$terms = get_terms( $args['taxonomy'] );
		$array = array();
		foreach( $terms as $term ) {
			$array[$term->name] = $term->term_id;
		}
		return $array;
	}


	/** Get Layouts Array
	  *
	  * Gets an array of layouts we can use in our select
	  * menus.
	  *
	  * @return array $options The available layouts in an array
	  *
	  */
	function get_layouts_array( $args = array() ) {
		$type = ( $args['type'] == '' ) ? 'post' : $args['type'];
		$layouts = $this->get_layouts();
		$options = array();

		if( !empty( $this->options[$type . '_layout'] ) AND !empty( $args['default'] ) AND $args['default'] == true ) {
			$options['-- Default Setting --'] = 'default';
		}

		foreach( $layouts[$type] as $layout ) {
			$options[$layout['name']] = $layout['id'];
		}
		return $options;
	}


	/***********************************************/
	/*              Frontend Functions             */
	/***********************************************/


	function the_excerpt( $charlength, $moretext = '' ) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if ( strlen( $excerpt ) > $charlength ) {
			$subex = substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo substr( $subex, 0, $excut );
			} else {
				echo $subex;
			}
			echo $moretext;
		} else {
			echo $excerpt;
		}
	}

	function clean_shortcodes($content){
	    $array = array (
	        '<p>[' => '[',
	        ']</p>' => ']',
	        ']<br />' => ']',
	    );
	    $content = strtr($content, $array);
	    return $content;
	}

	function get_price_format( $price, $id = '' ) {
		$currency_display  = '<span class="price-display">';
		if( $this->options['currency_position'] == 'before' ) {
			$currency_display .= $this->options['currency_symbol'];
		}
		$currency_display .= '<span class="price current_price" id="' . $id . '">' . $price . '</span>';
		if( $this->options['currency_position'] == 'after' ) {
			$currency_display .= $this->options['currency_symbol'];
		}
		$currency_display .= '</span>';
		return $currency_display;
	}

	function show_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
			<li class="comment pingback">
				<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
		<?php
			break;
			default :
		?>
			<li <?php comment_class( 'comment' ); ?> id="comment-<?php comment_ID(); ?>">
				<article class='comment-inner'>
					<div class='comment-image'>
						<div class='image'>
							<?php echo get_avatar( $comment, 50 ) ?>
						</div>
					</div>
					<div class='comment-content'>
						<header>
							<span class='comment-author'><?php comment_author_link() ?></span>
							<span class='comment-time'><?php comment_time( 'F d Y \a\t H:i a' ) ?></span>
							<span class='comment-reply'>
								<?php
									comment_reply_link( array_merge( $args, array(
										'reply_text' => 'Reply',
										'depth' => $depth,
										'max_depth' => $args['max_depth']
										)));
								?>
							</span>
						</header>

						<div class='content'>
							<?php comment_text() ?>
						</div>
					</div>
				</article>
		<?php
		break;
		endswitch;
	}



	/** Get All Post Meta
	  *
	  * Parses all the postmeta for an item into the post object.
	  * This is useful when we need to check all the postmeta
	  * values, we won't need to query them one by one.
	  *
	  * By default this function will work on the global post
	  * object. It adds the additional postmeta automatically.
	  *
	  * If it receives a post object as a parameterit will only
	  * return the postmeta array, it will need to be added to the
	  * object manually.
	  *
	  * @global object $wpdb The WordPress database object
	  * @global object $post The WordPress post object
	  *
	  * @param object $the_post A WordPress post object
	  *
	  */
	function get_all_postmeta( $the_post = '' ) {
		global $wpdb, $post;
		$post_id = ( !empty( $the_post ) ) ? $the_post->ID : $post->ID;
		$data = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = $post_id" );

		$postmeta = array();
		while( $meta = current( $data ) ) {
			$postmeta[ $meta->meta_key ] = $meta->meta_value;
			next( $data );
		}

		if( !empty( $the_post ) ) {
			return $postmeta;
		}
		else {
			$post->postmeta = $postmeta;
		}

	}


	/** Show Canonical URL
	  *
	  * Retrieve the canonical URL for the page we are
	  * on. Used mainly in the head section for og tags.
	  *
	  * @return string $url The canonical URL
	  *
	  */
	function canonical_url() {
		if( is_home() OR is_front_page() ) {
			$url = 	home_url();
		}
		elseif( is_singular() ) {
			global $post;
			$url = get_permalink( $post->ID );
		}
		else {
			global $wp;
			$url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
		}

		return $url;

	}


	/** Page Title
	  *
	  * Retrieve the page title. This can be a variety of different
	  * things depending on where the user is. It is used in the head
	  * section, mainly for the og tags.
	  *
	  * @global object $post The WordPress post object
	  * @global integer $paged The WordPress page number
	  *
	  * @return string $title The page title
	  *
	  */
	function page_title() {
		global $page, $paged;

		ob_start();

		echo $this->site_title();
		wp_title( '' );

		$site_description = get_bloginfo( 'description', 'display' );

		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		if ( $paged >= 2 || $page >= 2 )
			echo ' | Page ' . max( $paged, $page );

		$title = ob_get_clean();
		$title = trim( $title );
		return $title;

	}

	/** Page Image
	  *
	  * Retrieve the page image. This can be a variety of different
	  * things depending on where the user is. It is used in the head
	  * section, mainly for the og tags.
	  *
	  * @global object $post The WordPress post object
	  *
	  * @return string $image The page image url
	  *
	  */
	function page_image() {
		global $post;

		$image = '';
		$image_id = '';
		if( is_singular() ) {
			$image_id = get_post_thumbnail_id( $post->ID );
		}

		if( empty( $image_id ) ) {
			$image_id = $this->options['website_image'];
		}

		if( !empty( $image_id ) ) {
			$image = wp_get_attachment_image_src( $image_id, 'thumbnail' );
			$image = $image[0];
		}

		return $image;

	}





	/********************************************************/
	/*            !Error Checking and Reporting             */
	/********************************************************/

	/** Check Configuration
	  *
	  * Checks the configuration file for any potential errors.
	  * If there are any, a fatal error is produced. It also
	  * checks for constant definitions and if not present it
	  * adds default values for some of them.
	  *
	  * @uses fatal_error()
	  *
	  */
	function check_config() {

		if( !defined( 'EB_ENVIRONMENT' ) ) {
			define( 'EB_ENVIRONMENT', 'production' );
		}
		if( !defined( 'EB_ADMIN_THEME' ) ) {
			define( 'EB_ADMIN_THEME', 'elderberry' );
		}
		if( !defined( 'EB_URL' ) ) {
			define( 'EB_URL', get_template_directory_uri() . '/framework' );
		}
		if( !defined( 'EB_PATH' ) ) {
			define( 'EB_PATH', get_template_directory() . '/framework' );
		}
		if( !defined( 'EB_ADMIN_THEME_URL' ) ) {
			define( 'EB_ADMIN_THEME_URL', EB_URL . '/themes/' . EB_ADMIN_THEME );
		}
		if( !defined( 'EB_THEME_URL' ) ) {
			define( 'EB_THEME_URL', EB_URL . '/themes/' . EB_ADMIN_THEME );
		}

		$definitions = array( 'EB_THEME_NAME', 'EB_THEME_PREFIX' );

		$undefined = array();
		foreach( $definitions as $definition ) {
			if( !defined( $definition ) ) {
				$undefined[] = $definition;
			}
		}

		if( !empty( $undefined ) ) {
			$message  = '<p>The following constants are not defined: ' . implode( ', ', $undefined ) . '. Please open your config.php file and make sure they are properly defined</p>';
			$this->fatal_error( $message );
		}

		$required_classes = array( 'EB_Controls' );
		$missing = array();
		foreach( $required_classes as $class ) {
			if( !class_exists( $class ) ) {
				$missing[] = $class;
			}
		}

		if( !empty( $missing ) ) {
			$message  = '<p>The following classes are not required, but can\'t be found: ' . implode( ', ', $missing ) . '. Classes are usually found in the main framework directory, all required classes are bundled with the Elderberry package. Have you misplaced a file by mistake?</p>';
			$this->fatal_error( $message );
		}


	}


	/** Fatal Error Generator
	  *
	  * This function is only used to generate fatal errors
	  * which would cause everything to break otherwise. It
	  * uses a message passed as an argument and also the
	  * error support text which framework users can specify.
	  *
	  * @param string $message The message to show the user
	  * @param string $environment The environment to show the error in
	  *
	  * @uses get_error_support_text()
	  *
	  */
	function fatal_error( $message, $environment = 'test' ) {
		if( EB_ENVIRONMENT == $environment OR $environment == 'all' ) {

			$html = '
			<!DOCTYPE html>

			<html lang="en">
			<head>
			    <meta charset="utf-8">

			    <title>Elderberry Framework Error</title>
			    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/reset/reset-min.css">
			    <link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css">

			    <style type="text/css" rel="stylesheet">
			    	html{
			    		background:url( ' . EB_URL . '/img/elderberry/bg.png );
			    		border-top:3px solid #59b6e2;
			    		color:#555;
			    		font-family:Helvetica neue, helvetica, arial, sans-serif;
			    		font-size:14px;
			    		text-shadow:0px 0px 1px #fff;
			    	}
			    	h1,h2,h3,h4,h5,h6 {
			    		font-family:Bitter;
			    		text-align:center;
			    	}
			    	p {
			    		margin:0 0 22px 0;
			    	}
			    	a {
			    		color: #59b6e2;
			    	}
			    	h1 {
			    		font-size:24px;
			    		margin:0 0 22px 0;
			    		line-height:32px;
			    	}
			    	strong {
			    		font-weight:700;
			    	}
			    	code {
			    		background:#ddd;
			    		padding:0 5px;
			    		font-family:monospace
			    	}
			    	#logo {
			    		padding:11px 0;
			    		text-align:center;
			    		margin:0 0 44px 0;
			    		background:#f1f1f1;
			    		border-bottom:1px solid #ddd;
			    	}
			    	#content {
			    		padding:0 44px;
			    		max-width: 1140px;
			    	}
			    	.message, .contact {
			    		line-height:22px;
			    		font-size:14px;
			    		max-width: 500px;
			    		margin:0 auto 22px auto;
			    	}
			    </style>

			</head>

			<body>
				<div id="logo">
					<img src="' . EB_URL . '/themes/elderberry/img/logo.png">
				</div>
				<div id="content">
					<h1>A Fatal Error Has Occured!</h1>
					<div class="message">' . $message . '</div>
			';
			if( !empty( $this->error_support_text ) ) {
				$html .= '
					<div class="contact">' . $this->error_support_text . '</div>
				';
			}
			$html .= '
				</div>
			</body>
			</html>


			';

			die( $html );
		}
	}


	function get_current_url() {
		global $wp;
		$current_url = home_url(add_query_arg(array(),$wp->request));
		return $current_url . '/';
	}


}



?>