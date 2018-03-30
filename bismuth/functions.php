<?php
$lb_opc = get_option('lb_opc');
add_action( 'after_setup_theme', 'vp_setup' );
if ( ! function_exists( 'vp_setup' ) ){
	function vp_setup(){
		global $lb_opc;
		require get_template_directory() . '/includes/custom-functions.php';
		require get_template_directory() . '/includes/shortcodes.php';
		require get_template_directory() . '/includes/comments.php';
		require get_template_directory() . '/includes/post_types.php';
		require get_template_directory() . '/includes/custom_metaboxes/meta_boxes.php';
		require_once( get_template_directory() .'/includes/class-tgm-plugin-activation.php' ); //Include the TGM_Plugin_Activation class
		load_theme_textdomain('LB', get_template_directory() . '/languages');
		require 'includes/nhp-options.php';
	}
}

//add thumbnails
add_theme_support( 'post-thumbnails', array( 'slides','custom_posts','page','post' ) ); // Posts and Movies 

set_post_thumbnail_size( 640, 250);

//add feeds
add_theme_support( 'automatic-feed-links' );

// Loading js files into the theme
add_action('wp_head', 'vp_scripts');
if ( !function_exists('vp_scripts') ) {
	function vp_scripts() {
		global $lb_opc;


		if ( is_singular() && get_option( 'thread_comments' ) )
    		wp_enqueue_script( 'comment-reply' );
	}

}


/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/

add_action('wp_enqueue_scripts','adapt_scripts_function');
function adapt_scripts_function() {
	//get theme options
	global $lb_opc;
	
	wp_enqueue_script('jquery');	
	
	// Site wide js
		wp_enqueue_script( 'cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', true );
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), '1.0', true );
        wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', false, '1.0', true );
        wp_enqueue_script( 'supersized', get_template_directory_uri() . '/js/supersized.3.2.7.min.js', array(), '1.0');
        wp_enqueue_script( 'localscroll', get_template_directory_uri() . '/js/jquery.localscroll-1.2.7-min.js', array(), '1.0', true );
		
        //wp_enqueue_script( 'mobilemenu', get_template_directory_uri() . '/js/jquery.mobilemenu.js', array(), '1.0', true );
        
        //wp_enqueue_script( 'sirdjsmenu', get_template_directory_uri() . '/js/jquery.sidr.min.js', array(), '1.0', false );
        
		wp_enqueue_script( 'fixmenu', get_template_directory_uri() . '/js/stickUp.min.js', array(), '1.0', false );

        //wp_enqueue_script( 'jnav', get_template_directory_uri() . '/js/jquery.nav.js', array(), '1.0', true );

		wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/js/jquery.smooth-scroll.js', false, '1.0', true );
		//wp_enqueue_script( 'contact-form', get_template_directory_uri() . '/js/contact-form.js', array(), '1.0', true );
		wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', false, '1.0', true );
		wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), '1.0', true );
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), '1.0');
        wp_enqueue_script( 'jui', get_template_directory_uri() . '/js/jquery-ui-1.8.23.custom.min.js', array(), '1.0');
		wp_enqueue_script('initfooter', get_template_directory_uri() . '/js/init-footer.js', false, '1.0', true );

		if ( is_singular() && get_option( 'thread_comments' ) )
    		wp_enqueue_script( 'comment-reply' );
}


/*-----------------------------------------------------------------------------------*/
/*Enqueue CSS
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'adapt_enqueue_css');
function adapt_enqueue_css() {
	
		wp_enqueue_style( 'base', get_template_directory_uri() . '/css/base.css', array(), '1.2');
		wp_enqueue_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '1.2');
        wp_enqueue_style( 'supersized', get_template_directory_uri() . '/css/supersized.css', array(), '3.2.7');
		wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '2.0');
		wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '1.0');
		wp_enqueue_style( 'source-sans', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,400italic,600italic,700italic', array());
		wp_enqueue_style( 'lato', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,900', array());

        //wp_enqueue_style( 'sidrmenu', get_template_directory_uri() . '/css/jquery.sidr.light.css', array(), '1.0');

		wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '1.0');
	
}

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
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
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Symple Shotcodes Mod', // The plugin name
			'slug'     				=> 'symple-shortcodes-mod', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/lib/plugins/symple-shortcodes-mod.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),


	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'tgmpa';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/*-----------------------------------------------------------------------------------*/
/*	Custom Post Types & Taxonomies
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'adapt_create_post_types' );
function adapt_create_post_types() {
	//slider post type
	register_post_type( 'Slides',
		array(
		  'labels' => array(
			'name' => __( 'LB Slides', '' ),
			'singular_name' => __( 'Slide', '' ),		
			'add_new' => _x( 'Add New', 'Slide', '' ),
			'add_new_item' => __( 'Add New Slide', '' ),
			'edit_item' => __( 'Edit Slide', '' ),
			'new_item' => __( 'New Slide', '' ),
			'view_item' => __( 'View Slide', '' ),
			'search_items' => __( 'Search Slides', '' ),
			'not_found' =>  __( 'No Slides found', '' ),
			'not_found_in_trash' => __( 'No Slides found in Trash', '' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title','thumbnail'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'slides' ),
		)
	  );
}


add_action('wp_head', 'vp_custom_css', 11);
function vp_custom_css() {
	global $lb_opc;
	if(isset($lb_opc['custom_css']) && $lb_opc['custom_css'] != '')
			echo '<style type="text/css">' . $lb_opc['custom_css'] . '</style>';
}


if ( ! isset( $content_width ) ) $content_width = 960;

function encEmail ($orgStr) {
    $encStr = "";
    $nowStr = "";
    $rndNum = -1;

    $orgLen = strlen($orgStr);
    for ( $i = 0; $i < $orgLen; $i++) {
        $encMod = rand(1,2);
        switch ($encMod) {
        case 1: // Decimal
            $nowStr = "&#" . ord($orgStr[$i]) . ";";
            break;
        case 2: // Hexadecimal
            $nowStr = "&#x" . dechex(ord($orgStr[$i])) . ";";
            break;
        }
        $encStr .= $nowStr;
    }
    return $encStr;
} 

function register_menus() {
	register_nav_menus( array( 'top-menu' => 'Top primary menu')
						);
}
add_action('init', 'register_menus');

class description_walker extends Walker_Nav_Menu
{
      function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           if($item->object == 'page')
           {
                $varpost = get_post($item->object_id);
                $attributes .= ' href="' . get_site_url() . '#' . $varpost->post_name . '"';
           }
           else
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
add_filter( 'posts_orderby', 'sort_query_by_post_in', 10, 2 );
function sort_query_by_post_in( $sortby, $thequery ) {
	if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
		$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
	return $sortby;
}

add_action('init', 'vp_sidebars');
function vp_sidebars() {
	$args = array(
				'name'          => 'Right sidebar',
				'before_widget' => '<div id="%1$s" class="padding-bottom %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>' );
	register_sidebar($args);
}
?>