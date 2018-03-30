<?php
/**
 * All the custom functions, filters used in the theme can be found here. All the settings and supports of the theme start from here.
 *
 */
 
/* CONSTANTS
-------------------------------------------------------------------------------- */
	define('THEMENAME', 'unik');
	

/* SLIGHTLY MODIFIED OPTION FRAMEWORK
---------------------------------------------------------------------------------*/
	require_once ('admin/index.php');


/* METABOX FRAMEWORK
---------------------------------------------------------------------------------*/
 	define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/functions/meta-box' ) );
    define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/functions/meta-box' ) );
	require_once( get_template_directory().'/functions/meta-box/meta-box.php' );	
	require_once (get_template_directory().'/functions/meta-boxes.php');	
	
	
	
/* CONTENT WIDTH
---------------------------------------------------------------------------------*/	
	if ( ! isset( $content_width ) )
		$content_width = 788;	
	
	
/* THEME BASIC SETUP
---------------------------------------------------------------------------------*/		
	function unik_theme_features() {
		add_editor_style( get_template_directory_uri().'/css/editor-style.css' );
		
		// Load text domain
		load_theme_textdomain( THEMENAME, get_template_directory() . '/languages' );

		// Adds automatic RSS feed 
		add_theme_support( 'automatic-feed-links' );

		// HTML5 form support
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

		// Available post format
		add_theme_support( 'post-formats', array('audio', 'gallery') );
		
		//menu support
		add_theme_support( 'menus' );
		
		//woocommerce
		add_theme_support( 'woocommerce' );
		
		//localization
		$lang = get_template_directory()  . '/lang';
		load_theme_textdomain(THEMENAME, $lang);
		
		// Register nav menu
		register_nav_menu( 'primary', __( 'Top Menu', THEMENAME ) );

		// Support post thumbnails
		add_theme_support('post-thumbnails');
		
		// Set thumbnail size
		set_post_thumbnail_size( 800, 520, true );
		
		// Add image sizes
		add_image_size('ext-large', 1200, 600, true);
		add_image_size('large', 800, 520, true);
		add_image_size('medium', 460, 340, true);
		add_image_size('square', 400, 400, true);
		
		add_image_size('masonry-medium', 460, 10000, true); // unlimited height for masonry
		add_image_size('single', 800, 10000, true); // unlimited height for single post
		add_image_size('single-event', 1140, 10000, true); // unlimited height for single event post

		add_image_size('carousel', 460, 340, true);
		add_image_size('small-thumb', 60, 60, true);
		
		add_image_size( 'col-4', 320, 228, true );
		add_image_size( 'col-3', 460, 340, true );
		add_image_size( 'col-2', 800, 520, true );
		
		add_image_size( 'product', 460, 10000, true );

	}
	add_action( 'after_setup_theme', 'unik_theme_features' );		



	
/* REQUIRED STYLES AND SCRIPTS
---------------------------------------------------------------------------------*/
	function unik_theme_scripts_styles() {
		
		//wp_enqueue_script('jquery');	// Load jquery 
		
		// Add comment reply script when applicable
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		
		wp_enqueue_script( 'comment-reply' );
		
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js' ); //modernizer for html5
		wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), false, true ); //required for dropdown menu
		wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), false, true ); //bootstrap
		wp_enqueue_script( 'jquery.easing', get_template_directory_uri() . '/js/jquery.easing.js' , array( 'jquery' ), false, true);//required for jquery easing	
		wp_enqueue_script( 'supersized', get_template_directory_uri() . '/js/supersized.js' , array( 'jquery' ), false, true); //supersized full screen slider
		wp_enqueue_script( 'supersized.shutter', get_template_directory_uri() . '/js/supersized.shutter.js', array( 'jquery' ), false, true );
		

		//player
		wp_enqueue_script( 'jquery.grab', get_template_directory_uri() . '/js/jquery.grab.js' , array( 'jquery' ), false, true);
		wp_enqueue_script( 'jquery.jplayer.min', get_template_directory_uri() . '/js/jquery.jplayer.min.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'jquery.jplayer.playlist', get_template_directory_uri() . '/js/jquery.jplayer.playlist.js', array( 'jquery' ), false, true );

		
		wp_enqueue_script( 'carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel.js' , array( 'jquery' ), false, true); //carouFredSel
		
		wp_deregister_script( 'jquery.flexslider' );// deregister any other flex slider
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js' , array( 'jquery' ), false, true); //flex slider
		wp_enqueue_script( 'fitvid', get_template_directory_uri() . '/js/jquery.fitvid.js' , array( 'jquery' ), false, true); // required for responsive video
		wp_enqueue_script( 'nice_scroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js' , array( 'jquery' ), false, true);
		
		wp_deregister_script( 'jquery.prettyPhoto' );// de register any other prettyphoto
		wp_enqueue_script( 'jquery.prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js' , array( 'jquery' ), false, true);
		
		wp_enqueue_script( 'jquery.address', get_template_directory_uri() . '/js/jquery.address.js' , array( 'jquery' ), false, true);
		wp_enqueue_script( 'jquery.ba-urlinternal', get_template_directory_uri() . '/js/jquery.ba-urlinternal.min.js' , array( 'jquery' ), false, true);
		
		wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/js/waypoints.min.js' , array( 'jquery' ), false, true);
		wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js' , array( 'jquery' ), false, true);
		wp_enqueue_script( 'jquery-masonry');
		
		wp_enqueue_script( 'elevateZoom', get_template_directory_uri() . '/js/jquery.elevateZoom-min.js' , array( 'jquery' ), false, true);
		
		
		wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/sticky.php' , array( 'jquery' ), false, true);
		wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js' , array( 'jquery' ), false, true);

		
		
		

		
		/*--- Required Styles ---*/

		wp_enqueue_style( 'animate',get_template_directory_uri().'/css/animate.css');//animate
		wp_enqueue_style( 'bootstrap',get_template_directory_uri().'/css/bootstrap.css');//bootstrap css	
		wp_enqueue_style( 'prettyPhoto',get_template_directory_uri().'/css/prettyPhoto.css'); //prettyphoto lightbox
		wp_enqueue_style( 'jplayer',get_template_directory_uri().'/css/jplayer.css');//jplayer styles
		wp_enqueue_style( 'fontello',get_template_directory_uri().'/css/fontello.css');
		wp_enqueue_style( 'font-awesome',get_template_directory_uri().'/css/font-awesome.min.css');
		wp_enqueue_style( THEMENAME.'-style', get_stylesheet_uri() );	// Loads the main stylesheet.
		
		$protocol = is_ssl() ? 'https' : 'http';
		
		// google fonts from theme option
		global $unik_data;
		
		wp_enqueue_style( 'google_body_font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ','+',$unik_data['google_body_font']).':'.$unik_data['body_font_weight']);
		
		wp_enqueue_style( 'google_heading_font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ','+',$unik_data['google_heading_font']).':'.$unik_data['heading_font_weight']);
		
		wp_enqueue_style( 'google_menu_font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ','+',$unik_data['google_menu_font']).':'.$unik_data['menu_font_weight']);
		
		wp_enqueue_style( 'theme-option-style',get_template_directory_uri().'/css/theme-option-style.php'); // Load the styles from theme options
		
		
		
	}

	add_action( 'wp_enqueue_scripts', 'unik_theme_scripts_styles' );
	


/* Woocommere settings
-------------------------------------------------------------------------------- */
/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Put your plugin code here
	function unik_woo_scripts(){
		
		wp_dequeue_style('woocommerce-layout');
		wp_deregister_script('add-to-cart-variation');
		wp_deregister_script( 'add-to-cart-variation', get_template_directory_uri(). '/woocommerce/assets/js/add-to-cart-variation.js' , array( 'jquery' ), WC_VERSION, true);
		wp_enqueue_script( 'wc-add-to-cart-variation');
		
		wp_enqueue_script( 'wc-add-to-cart-1', get_template_directory_uri(). '/woocommerce/assets/js/add-to-cart.js' , array( 'jquery' ), WC_VERSION, true);
		
		
		wp_enqueue_script( 'wc-single-product', get_template_directory_uri(). '/woocommerce/assets/js/single-product.js' , array( 'jquery' ), false, true );
		
	}
	add_action('wp_enqueue_scripts','unik_woo_scripts');

		
	//remove woocommerce breadcrumb
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
	
	//single page 
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	
}

		
		

		
/* TGM PLUGIN ACTIVATION
-------------------------------------------------------------------------------- */
	require_once('functions/class-tgm-plugin-activation.php');
	
	add_action( 'tgmpa_register', 'unik_register_required_plugins' );
	/**
	 * Register the required plugins for this theme.
	 *
	 * In this example, we register two plugins - one included with the TGMPA library
	 * and one from the .org repo.
	 *
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	function unik_register_required_plugins() {
	 
		/**
		 * Array of plugin arrays. Required keys are name, slug and required.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	 
			// This is an example of how to include a plugin pre-packaged with a theme
			array(
				'name'                  => 'Revolution Slider', // The plugin name
				'slug'                  => 'revslider', // The plugin slug (typically the folder name)
				'source'                => get_template_directory_uri(). '/lib/plugins/revslider.zip', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			// This is an example of how to include a plugin pre-packaged with a theme
			array(
				'name'                  => 'Layer Slider', // The plugin name
				'slug'                  => 'LayerSlider', // The plugin slug (typically the folder name)
				'source'                => get_template_directory_uri(). '/lib/plugins/LayerSlider.zip', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),	
			
			// This is an example of how to include a plugin pre-packaged with a theme
			array(
				'name'                  => 'Envato Wordpress Toolkit', // The plugin name
				'slug'                  => 'envato-wordpress-toolkit', // The plugin slug (typically the folder name)
				'source'                => 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),			
			array(
				'name'                  => 'Woocommerce', // The plugin name
				'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
				'source'                => 'http://downloads.wordpress.org/plugin/woocommerce.zip', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),			
			array(
				'name'                  => 'Contact form 7', // The plugin name
				'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
				'source'                => 'http://downloads.wordpress.org/plugin/contact-form-7.zip', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),			
			array(
				'name'                  => 'Booking Calendar', // The plugin name
				'slug'                  => 'booking', // The plugin slug (typically the folder name)
				'source'                => 'http://downloads.wordpress.org/plugin/booking.zip', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			)
	 
	 
	   );
	 
		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'unik';
	 
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'            => THEMENAME,           // Text domain - likely want to be the same as your theme.
			'default_path'      => '',                           // Default absolute path to pre-packaged plugins
			'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
			'parent_url_slug'   => 'themes.php',         // Default parent URL slug
			'menu'              => 'install-required-plugins',   // Menu slug
			'has_notices'       => true,                         // Show admin notices or not
			'is_automatic'      => false,            // Automatically activate plugins after installation or not
			'message'           => '',               // Message to output right before the plugins table
			'strings'           => array(
				'page_title'                                => __( 'Install Required Plugins', THEMENAME ),
				'menu_title'                                => __( 'Install Plugins', THEMENAME ),
				'installing'                                => __( 'Installing Plugin: %s', THEMENAME ), // %1$s = plugin name
				'oops'                                      => __( 'Something went wrong with the plugin API.', THEMENAME ),
				'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                                    => __( 'Return to Required Plugins Installer', THEMENAME ),
				'plugin_activated'                          => __( 'Plugin activated successfully.', THEMENAME ),
				'complete'                                  => __( 'All plugins installed and activated successfully. %s', THEMENAME ) // %1$s = dashboard link
			)
		);
	 
		tgmpa( $plugins, $config );
	 
	}


	
/* ADMIN SCRIPT
-------------------------------------------------------------------------------- */
	function unik_theme_admin_scripts() {
		wp_register_script( 'theme-script', get_template_directory_uri() . '/js/admin-script.js' );
		
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		
		wp_enqueue_script( 'theme-script' );
	}
	add_action( 'admin_enqueue_scripts', 'unik_theme_admin_scripts' );



/* CUSTOM EXCERPT LENGTH PULLED FROM THEME OPTION
-------------------------------------------------------------------------------- */
	function unik_custom_excerpt_length( $length ) {
		global $unik_data;
		$length = intval($unik_data['excerpt_length_blog']);
		return $length;
	}
	add_filter( 'excerpt_length', 'unik_custom_excerpt_length', 999 );

	
		
/* CUSTOM POST TYPE  (Event)
-------------------------------------------------------------------------------- */	
	add_action('init', 'unik_theme_create_event');
	
	function unik_theme_create_event(){
		$labels = array(
			'name' => __( 'Event',THEMENAME ),
			'all_items' => __( 'All events',THEMENAME ),
			'singular_name' => __( 'Event',THEMENAME ),
			'add_new_item' => 'Add new event',
		);
		$args = array(
			'labels' => $labels,
			'label' => __('All events',THEMENAME),
			'singular_label' => __('Event',THEMENAME),
			'public' => true,
			'show_ui' => true,		
			'_builtin' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'event'),
			'has_archive' => true,
			'supports' => array('title','editor','revisions','thumbnail','custom-fields','comments'),
			'taxonomies' => array('event_cat', 'post_tag',),
		);
		if (function_exists('register_post_type')):
			register_post_type('event', $args);
		endif;
	}
	
	
	//Custom taxonomies (category)
	add_action('init', 'unik_theme_event_category', 0);

	function unik_theme_event_category(){
	
		$labels = array(
			'name' => _x( 'Event Categories', 'taxonomy general name', THEMENAME ),
			'singular_name' => _x( 'Event category', 'taxonomy singular name', THEMENAME ),
			'search_items' =>  __( 'Search event', THEMENAME ),
			'all_items' => __( 'Event categories', THEMENAME ),
			'parent_item' => __( 'Parent event category', THEMENAME ),
			'parent_item_colon' => __( 'Parent event category:', THEMENAME ),
			'edit_item' => __( 'Edit Event category', THEMENAME ), 
			'update_item' => __( 'Update event category', THEMENAME ),
			'add_new_item' => __( 'Add new category', THEMENAME ),
			'new_item_name' => __( 'New event Name', THEMENAME )
		); 	
		
		register_taxonomy('event_cat',array('event'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event_categories' )
	
		));
	}

	
/* UNIK BREADCRUMBS FUNCTION
-------------------------------------------------------------------------------- */
	function unik_breadcrumbs(){

		global $post;
		$breadcrumb_sep=' / '; // Separator	
		
		// get post type
		$posttype = get_post_type( get_the_ID() );
		
	?>	
		<a href="<?php echo home_url(); ?>"><?php _e('Home', THEMENAME); ?></a>

	<?php echo $breadcrumb_sep; ?>

	<?php

	$blog_page_id=get_option('page_for_posts');

		//Single post
		if(is_single()){
			if($posttype=='event'){
				the_title();
			} else {

				if($blog_page_id){
				//Blog posts		
					echo '<a href="' . get_permalink($blog_page_id) . '">';
					echo get_the_title($blog_page_id);		
					echo '</a>';
				
					echo $breadcrumb_sep;
				}
				the_title();
			}
		}

		
		if (is_home()) {
			echo get_the_title($blog_page_id);	
		}	

		if ( is_page() && $post->post_parent==0 ) {
				the_title();
		}
		elseif( is_page() && $post->post_parent!=0 ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb)
					echo $crumb . $breadcrumb_sep;
				the_title();
		}
		elseif (is_category() ) {
				_e('Archive for category', THEMENAME);
				echo ' &#39;';
				single_cat_title();
				echo '&#39;';
	 
		}
		elseif ( is_tax() ) {
				global $wp_query;	
				$term = $wp_query->get_queried_object();	
				$taxonomy = get_taxonomy ( get_query_var('taxonomy') );
				$term = $term->name;
				_e('Archive for', THEMENAME);
				echo ' ' . strtolower($taxonomy->labels->singular_name) . ' &#39;' . $term . '&#39;';
	 
		}
		elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> / ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> / ';
			echo get_the_time('d');
		} 
		elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> / ';
			echo get_the_time('F'); 
		} 
		elseif ( is_year() ) {
			echo get_the_time('Y'); 
		} 	
		elseif ( is_search() ) {
				_e('Search results for', THEMENAME);
				echo ' &#39;' . get_search_query() . '&#39;'; 
		}
		elseif ( is_tag() ) {
				_e('Posts tagged', THEMENAME); 
				echo ' &#39;';
				single_tag_title();
				echo '&#39;';
		}
		elseif ( is_author() ) {
				_e('Posts by', THEMENAME); 
				echo ' &#39;';
				the_author();
				echo '&#39;';
		}
		if ( get_query_var('paged') ) {
			printf( __( ' (Page %s) ', THEMENAME ), get_query_var('paged') );
		}
	}



/* UNIK PAGINATION FUNCTION
---------------------------------------------------------------------------------*/
	if ( !function_exists('unik_pagination') ) {

		function unik_pagination( $pages = '', $range = 2 ) {
			
		if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', THEMENAME ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', THEMENAME ) ); ?></div>
			<?php endif; ?>

		<?php }
	}


	
/* UNIK COMMENT TEMPLATE
-------------------------------------------------------------------------------- */
	function unik_theme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment;
	   
		$imageurl = get_avatar(get_comment_author_email(), '72');   

	   ?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"> 	
		 <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
		  <div class="comment-author vcard">
			 <div><?php echo $imageurl; ?> </div>
			 <?php printf('<span class="author-name">%s</span>', get_comment_author_link()) ?>
			
		  </div>
		  <div class="comment-text">
		  <?php if ($comment->comment_approved == '0') : ?>
			
			 <em><?php _e('Your comment is awaiting moderation.',THEMENAME) ?></em>
			 <br />
		  <?php endif; ?>
		  <div class="comment-meta commentmetadata"><?php printf(__('%1$s at %2$s',THEMENAME), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('(Edit)',THEMENAME),'  ','') ?>
			<span class="reply">
				&nbsp; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'],'before' => '<i class="icon-reply"></i>'))) ?>
			</span>
		  </div>
		  <?php comment_text(); ?>
		  </div>
		  <div class="clear"></div>
		 </div>
		 
<?php
	}

	
/* REGISTER SIDEBARS
---------------------------------------------------------------------------------*/
	
	//Sidebar for blog
	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Blog Sidebar',
						'id'            => 'blog-sidebar',
						'description'   => 'A sidebar for blog '.__('Shortcode: [sidebar name="blog-sidebar"]', THEMENAME),
						'before_widget' => '<div  id="%1$s" class="widget bg-block-1 %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="block-title">',
						'after_title'   => '</h3>' )
						);
	}		
	
	//Sidebar for general purpose
	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Main Sidebar',
						'id'            => 'main-sidebar',
						'description'   => 'A sidebar for general purpose. '.__('Shortcode: [sidebar name="main-sidebar"]', THEMENAME),
						'before_widget' => '<div  id="%1$s" class="widget bg-block-1 %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="block-title">',
						'after_title'   => '</h3>' )
						);
	}



	//Sidebar for blog
	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Event Sidebar',
						'id'            => 'event-sidebar',
						'description'   => 'A sidebar for events. '.__('Shortcode: [sidebar name="event-sidebar"]', THEMENAME),
						'before_widget' => '<div  id="%1$s" class="widget bg-block-1 %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="block-title">',
						'after_title'   => '</h3>' )
						);
	}	
	
	//Sidebar for reservation/booking
	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Reservation Sidebar',
						'id'            => 'reservation-sidebar',
						'description'   => 'A widgeted area for reservation form. '.__('Shortcode: [sidebar name="reservation-sidebar"]', THEMENAME),
						'before_widget' => '<div  id="%1$s" class="widget bg-block-1 %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="block-title">',
						'after_title'   => '</h3>' )
						);
	}

	//Sidebar for woocommerce
	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Woocommerce Sidebar',
						'id'            => 'woocommerce-sidebar',
						'description'   => 'A widgeted area for Woocommerce. '.__('Shortcode: [sidebar name="woocommerce-sidebar"]', THEMENAME),
						'before_widget' => '<div  id="%1$s" class="widget bg-block-1 %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="block-title">',
						'after_title'   => '</h3>' )
						);
	}
	
/* SIDEBAR GENERATOR FROM THEME OPTION
---------------------------------------------------------------------------------------------*/
	$sidebar_options = isset($unik_data['sidebars']) ? $unik_data['sidebars'] : '';
	
	if(!empty($sidebar_options) and is_array($sidebar_options)){
		foreach ($sidebar_options as $sidebar_option){
			if(!empty($sidebar_option['title']) and function_exists('register_sidebar')){
				register_sidebar(array(
								'name'          => $sidebar_option['title'],
								'id'            => str_replace(' ','-',strtolower($sidebar_option['title'])),
								'description'   => __('Shortcode: [sidebar name="'.str_replace(' ','-',strtolower($sidebar_option['title'])).'"]', THEMENAME),
								'before_widget' => '<div  id="%1$s" class="widget bg-block-1 %2$s">',
								'after_widget'  => '</div>',
								'before_title'  => '<h3 class="block-title">',
								'after_title'   => '</h3>' )
								);
			}
		}	
	}

	
	
/* UNIK CUSTOM WIDGETS
---------------------------------------------------------------------------------*/
	require_once('widgets/flickr.php');
	require_once('widgets/twitter.php');


	
/* CUSTOM METABOX FOR SELECTING SIDEBAR
---------------------------------------------------------------------------------*/	  
	add_action( 'add_meta_boxes', 'unik_add_sidebar_metabox' );  
	add_action( 'save_post', 'unik_save_sidebar_postdata' );  
  
	/* Adds a box to the side column on the Post and Page edit screens */  
	function unik_add_sidebar_metabox()  {

		add_meta_box(   
			'select_sidebar',  
			__( 'Select Sidebar', THEMENAME ),  
			'unik_select_sidebar_callback',  
			'page',  
			'side'  
		);  
	}
	
	function unik_select_sidebar_callback( $post )  {
		global $wp_registered_sidebars;  
		  
		$custom = get_post_custom($post->ID);  
		  
		if(isset($custom['select_sidebar']))  
			$val = $custom['select_sidebar'][0];  
		else  
			$val = "default";  
	  
		// Use nonce for verification  
		wp_nonce_field( get_template_directory(), 'select_sidebar_nonce' );  
	  
		// The actual fields for data entry  
		$output = '<p><label for="myplugin_new_field">'.__("Choose a sidebar to display", THEMENAME ).'</label></p>';  
		$output .= "<select name='select_sidebar'>";  
	  
		  
		// Fill the select element with all registered sidebars  
		foreach($wp_registered_sidebars as $sidebar_id => $sidebar)  
		{  
			$output .= "<option";  
			if($sidebar['id'] == $val)  
				$output .= " selected='selected'";  
			$output .= " value='".$sidebar['id']."'>".$sidebar['name']."</option>";  
		}  
		
		$output .= "</select>";  
		  
		echo $output;  
	}
	
	function unik_save_sidebar_postdata( $post_id ){
		// verify if this is an auto save routine.   
		// If it is our form has not been submitted, so we dont want to do anything  
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )   
		  return;  
	  
		// verify this came from our screen and with proper authorization,  
		// because save_post can be triggered at other times  
		
	  
		if ( !current_user_can( 'edit_page', $post_id ) )  
			return;  
		$unik_datasidebar = '';
		if(isset($_POST['select_sidebar'])){$unik_datasidebar = $_POST['select_sidebar']; }

		
	  
		update_post_meta($post_id, "select_sidebar", $unik_datasidebar);  
	}    



		
/* FUNCTION TO SHOW SOCIAL ICONS
---------------------------------------------------------------------------------------------*/	
	function unik_social($id,$title){
		global $unik_data;
		$class = str_replace(' ','-',strtolower($title));
		if(!empty($unik_data[$id])){
			echo '<a class="'.$class.'" target="_blank" title="'.$title.'" href="'.$unik_data[$id].'"><i class="icon icon-'.$id.'"></i></a>';
		}
	}
	
/* FUNCTION TO SHOW CUSTOM SOCIAL ICONS
---------------------------------------------------------------------------------------------*/
	function unik_social_custom($link,$image,$class){
		global $unik_data;
		if(!empty($unik_data[$link])){
			if(!empty($unik_data[$image]) && $unik_data[$image] != ''){
				echo '<a href="'.$unik_data[$link].'"><img src="'.$unik_data[$image].'" alt=""></a>';
			}
			elseif(!empty($unik_data[$class])){
				echo '<a href="'.$unik_data[$link].'"><i class="'.$unik_data[$class].'"></i></a>';
			}
		}
	}
	
	
/* CUSTOM SHORTCODES
---------------------------------------------------------------------------------------------*/
	// Allow shortcodes in widget
	add_filter('widget_text', 'do_shortcode');
	require_once('functions/shortcodes.php');

	
/* Decript songs callback function
---------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_unik_decript_song', 'unik_decript_song_callback' );
add_action( 'wp_ajax_nopriv_unik_decript_song', 'unik_decript_song_callback' );


function unik_decript_song_callback() {

	$song =  $_POST['song'] ;

	$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = unik_decryptIt($song);

    echo $qDecoded ;

	wp_die(); 
}

/* Encript songs callback function
---------------------------------------------------------------------------------------------*/

add_action( 'wp_ajax_unik_encript_song', 'unik_encript_song_callback' );
add_action( 'wp_ajax_nopriv_unik_encript_song', 'unik_encript_song_callback' );


function unik_encript_song_callback() {

	$song =  $_POST['song'] ;

    $Encoded      = unik_encryptIt($song);

    echo $Encoded ;

	wp_die(); 
}



function unik_encryptIt( $q ) {
    $qEncoded      = base64_encode( $q );
    return( $qEncoded );
}

function unik_decryptIt( $q ) {
    $qDecoded      = base64_decode( $q );
    return( $qDecoded );
}
	

?>