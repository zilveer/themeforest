<?php
	
define('BASIL_FA_VERSION','4.5.0');

add_action( 'after_setup_theme', 'basil_lang_setup' );
function basil_lang_setup() {
	# Language Settings
	load_theme_textdomain( 'basil', get_template_directory() . '/languages' );
}

if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

// Option Tree Settings
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_options_ui', '__return_true' );
add_filter( 'ot_show_settings_import', '__return_true' );
add_filter( 'ot_show_settings_export', '__return_true' );
add_filter( 'comment_form_defaults', 'basil_remove_comment_styling_prompt' );

function basil_ot_typography_fields( $array, $field_id ) {

	
	
    /* only run the filter where the field ID is 'main_font'  */
    if ( 0 === strpos($field_id, 'to_defaut_formatting_style') ||
    	0 === strpos($field_id, 'to_h1_formatting_style') ||
    	0 === strpos($field_id, 'to_h2_formatting_style') ||
    	0 === strpos($field_id, 'to_h3_formatting_style') ||
    	0 === strpos($field_id, 'to_h4_formatting_style') ||
    	0 === strpos($field_id, 'to_h5_formatting_style') ||
    	0 === strpos($field_id, 'to_h6_formatting_style') ) {
       $array = array( 'font-color','font-size','font-style','font-weight','letter-spacing','line-height','text-decoration','text-transform' );
    }

    return $array;

}
add_filter('ot_recognized_typography_fields','basil_ot_typography_fields', 10, 2);

// Theme Updates
require_once('updates/theme-update-checker.php');
$BoxyThemeUpdateChecker = new ThemeUpdateChecker('basil','http://boxyupdates.com/get/?action=get_metadata&slug=basil');

// WooCommerce Support - Added 09/30/2014
add_theme_support('woocommerce');

// Remove All WooCommerce Styling
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function basil_wc_loop_shop_columns( $number_columns ) {
	return 3;
}

// Load the styles and assets if on the OT pane
global $boxy_pagenow;
if (isset($_GET['page']) && $_GET['page'] != 'ot-theme-options' || !isset($_GET['page'])) {
    function ot_admin_styles() { /* Block the styles from loading anywhere but the admin page */ }
}

# Required: include OptionTree.
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

# Include OptionTree: Self Theme Options
load_template( trailingslashit( get_template_directory() ) . 'options/theme-options.php' );

function basil_remove_comment_styling_prompt($defaults) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}

function basil_theme_options_buttons() {
    ?>
    <div class="export-theme-option">
    	<div class="form-import">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="basil_import_file" />
                <button class="button button-primary">Import Theme Options</button>
                <?php if (!empty($_GET['error'])): ?>
                   <p><?php echo esc_html($_GET['error']) ?></p>
                <?php endif ?>
            </form> 
        </div><!-- /.form-import -->
        <div class="form-export">
            <form action="" method="POST">
                <input type="hidden" name="get_options_export_file" />
                <input type="submit" class="button button" value="Export Theme Options" />
            </form>
        </div><!-- /.form-export -->
        <div class="cl"></div>
    </div>
    <?php
}

// Visual Composer Theme Mode
add_action( 'init', 'boxy_vcSetAsTheme' );
function boxy_vcSetAsTheme() {
	if (function_exists('vc_set_as_theme')) : vc_set_as_theme(true); endif;
}

// Envira Gallery License
add_action( 'after_setup_theme', 'tgm_envira_define_license_key' );
function tgm_envira_define_license_key() { 
    // If the key has not already been defined, define it now.
    if ( ! defined( 'ENVIRA_LICENSE_KEY' ) ) {
        define( 'ENVIRA_LICENSE_KEY', '93b032dcb25f3564ff1814b3fd777efb' );
    }
}

// Import / Export Theme Options
if (isset($_GET['page']) && $_GET['page'] === 'ot-theme-options') {
    add_action( 'admin_notices', 'basil_theme_options_buttons', 999 );
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['basil_import_file']['tmp_name'])) {
    basil_import_theme_options();
}

function basil_import_theme_options($json_file = false) {

	if ($json_file){
	
		$filename = $json_file;
		
	} else {

	    if($_SERVER['REQUEST_METHOD'] != 'POST') {
	        return;
	    }
	
	    $filename = '';
	
	    if (!$_FILES["basil_import_file"]["error"]) {
	      $filename = $_FILES["basil_import_file"]["tmp_name"];
	    }
	    
	}

    if($filename) {
        $json = file_get_contents($filename);
    } else {
        $error = urlencode('Please Upload File');
        wp_redirect(home_url("/wp-admin/themes.php?page=ot-theme-options&error=$error"));
        exit;
    }

    if ($json) {
        $encoded_json = json_decode($json);
    } else {
        $error = urlencode('Please upload correct Options file');
        wp_redirect(home_url("/wp-admin/themes.php?page=ot-theme-options&error=$error"));
        exit;
    }

    global $wpdb;
    $theme_options = $encoded_json[0]->option_value;

    $wpdb->query("UPDATE " . $wpdb->options . " SET option_value='" . esc_sql($encoded_json[0]->option_value) . "' WHERE option_name = 'option_tree' ");
    wp_redirect(home_url('/wp-admin/themes.php?page=ot-theme-options&message=updated'));
    exit;
}
 
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['get_options_export_file'])) {
    basil_export_theme_options();
}

function basil_options_updated_message() {
    ?>
    <div class="updated">
        <p><?php _e( 'The theme options have been updated!', 'basil' ); ?></p>
    </div>
    <?php
}

if (isset($_GET['page']) && $_GET['page'] === 'ot-theme-options' && isset($_GET['message']) && $_GET['message'] == 'updated'){ add_action( 'admin_notices', 'basil_options_updated_message' ); }

function basil_export_theme_options() {
    global $wpdb; 
    $theme_options = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->options . ' WHERE `option_name` = "option_tree"' );

    $json = json_encode($theme_options);

    $filename = 'theme-options.json';
    header("Content-type:application/json; charset=utf-8");
    header("Content-Disposition: attachment; filename=theme-options.json");
    echo $json;
    exit;
}


/* REQUIRED PLUGINS */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'basil_register_required_plugins' );

function basil_register_required_plugins() {

    $plugins = array(
    
    	array(
            'name'                  => 'Cooked',
            'slug'                  => 'cooked',
            'source'                => 'http://boxycdn-plugins.s3.amazonaws.com/cooked.zip',
            'required'              => true
        ),
        
        array(
            'name'                  => 'Custom Sidebars',
            'slug'                  => 'custom-sidebars',
            'required'              => false
        ),
        
		array(
            'name'                  => 'Envira Gallery',
            'slug'                  => 'envira-gallery',
            'source'                => 'http://boxycdn-plugins.s3.amazonaws.com/envira-gallery.zip',
            'required'              => false
        ),
        
        array(
            'name'                  => 'WPBakery Visual Composer',
            'slug'                  => 'js_composer',
            'source'                => 'http://boxycdn-plugins.s3.amazonaws.com/js_composer.zip',
            'required'              => false
        ),
        
        array(
            'name'                  => 'Contact Form 7',
            'slug'                  => 'contact-form-7',
            'required'              => false
        ),
 
    );
 
    $theme_text_domain = 'basil';
    $config = array(
        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
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
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        )
    );
 
    tgmpa( $plugins, $config );
 
}



define('CRB_THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('TP', 'basil'); # Theme Prefix
define('TEMPLATE_DIR_URL', get_template_directory_uri());
define('ENABLE_TWITTER_CONFIG', true);

# Enqueue JS and CSS assets on the front-end
add_action('wp_enqueue_scripts', 'crb_wp_enqueue_scripts');
function crb_wp_enqueue_scripts() {
	
	# Enqueue jQuery
	wp_enqueue_script('jquery');
	
	# Enqueue Custom JS files
	crb_enqueue_script(TP . '-easing', TEMPLATE_DIR_URL . '/js/jquery.easing.js', array('jquery'));
	crb_enqueue_script(TP . '-slicknav', TEMPLATE_DIR_URL . '/js/jquery.slicknav.min.js', array('jquery'));
	crb_enqueue_script(TP . '-modernizr', TEMPLATE_DIR_URL . '/js/modernizr.js', array('jquery'));
	crb_enqueue_script(TP . '-fitvids', TEMPLATE_DIR_URL . '/js/fitvids.js', array('jquery'));
	crb_enqueue_script(TP . '-wow', TEMPLATE_DIR_URL . '/js/wow.min.js', array('jquery'));
	crb_enqueue_script(TP . '-isotope', TEMPLATE_DIR_URL . '/js/isotope.pkgd.min.js', array('jquery'));
	crb_enqueue_script(TP . '-carouFredSel', TEMPLATE_DIR_URL . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'));
	crb_enqueue_script(TP . '-basil', TEMPLATE_DIR_URL . '/js/basil.js', array('jquery'));

	# IE scripts
	if ( basil_is_IE() ) {
		crb_enqueue_script(TP . '-html5-shiv', 'http://html5shiv.googlecode.com/svn/trunk/html5.js');
	}

	# Enqueue Custom CSS files
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	$custom_google_font = ot_get_option('to_general_custom_font','Lato');
  	crb_enqueue_style( TP . '-gf-custom', '//fonts.googleapis.com/css?family='.$custom_google_font.':100,200,300,400,500,600,700,800&subset=latin,cyrillic-ext,cyrillic,greek-ext,vietnamese,latin-ext');
	crb_enqueue_style(TP . '-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/'.BASIL_FA_VERSION.'/css/font-awesome.min.css');
	crb_enqueue_style(TP . '-standardize', TEMPLATE_DIR_URL . '/css/standardize.css');
	crb_enqueue_style(TP . '-slicknav', TEMPLATE_DIR_URL . '/css/slicknav.css');
	crb_enqueue_style(TP . '-animate', TEMPLATE_DIR_URL . '/css/animate.css');
	crb_enqueue_style(TP . '-styles', TEMPLATE_DIR_URL . '/style.css');
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
   		crb_enqueue_style(TP . '-woocommerce', TEMPLATE_DIR_URL . '/css/woocommerce.css');
   	}
	
	
	$disable_responsive = ot_get_option('to_disable_responsive',false);
  	if ($disable_responsive != 'yes') :
		crb_enqueue_style(TP . '-responsive', TEMPLATE_DIR_URL . '/css/responsive.css');
	endif;

	# Enqueue Comments JS file
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
}

# Enqueue JS and CSS assets on admin pages
add_action('admin_enqueue_scripts', 'crb_admin_enqueue_scripts');
add_action('login_enqueue_scripts', 'crb_admin_enqueue_scripts');
function crb_admin_enqueue_scripts() {
	wp_enqueue_script( 'basil-admin-scripts', TEMPLATE_DIR_URL . '/js/admin-scripts.js' , array('jquery'), '1.0', true );
}

add_action('after_setup_theme', 'crb_setup_theme');
# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if (!function_exists('crb_setup_theme')) {
	function crb_setup_theme() {
		include_once(CRB_THEME_DIR . 'lib/common.php');
		if ( !class_exists('Carbon_Field') ) {
			include_once(CRB_THEME_DIR . 'lib/carbon-fields/carbon-fields.php');
		}

		# Theme supports
		add_theme_support('automatic-feed-links');

		# Manually select Post Formats to be supported - http://codex.wordpress.org/Post_Formats
		add_theme_support('post-formats', array( 'video', 'audio' ));

		# Register Theme Menu Locations
		add_theme_support('menus');
		register_nav_menus(array(
			'main-menu' => __('Main Menu', 'basil'),
			'mobile-menu' => __( 'Mobile Menu','basil' )
		));
		
		# Widget Framework
		include_once(CRB_THEME_DIR . 'lib/widget_framework.php');
		
		# Attach custom widgets
		include_once(CRB_THEME_DIR . 'lib/facebook/facebook.php');

		# Attach custom widgets
		include_once(CRB_THEME_DIR . 'options/widgets.php');

		# Attach custom shortcodes
		include_once(CRB_THEME_DIR . 'options/shortcodes.php');
		
		# Attach custom shortcodes
		include_once(CRB_THEME_DIR . 'options/custom-fields.php');

		# Add Actions
		add_action('widgets_init', 'crb_widgets_init');

		/**
		 * Custom Image Sizes
		 */
		add_theme_support('post-thumbnails');

		# Favicon
		add_image_size(TP . '_favicon', 32, 32, true);

		# Recipe Slider
		add_image_size(TP . '_tpl_recipe_slider_short', 2000, 527, true);
		add_image_size(TP . '_tpl_recipe_slider_tall', 2000, 869, true);
		add_image_size(TP . '_tpl_recipe_slider_short_rt', 4000, 1054, true);
		add_image_size(TP . '_tpl_recipe_slider_tall_rt', 4000, 1738, true);

		# Post
		add_image_size(TP . '_post_thumbnail_square', 150, 150, true);
		add_image_size(TP . '_post_thumbnail_square_rt', 300, 300, true);
		add_image_size(TP . '_post_thumbnail_small', 298, 192, true);
		add_image_size(TP . '_post_thumbnail_small_rt', 596, 384, true);
		
		$wc_products_per_page = ot_get_option('to_wc_products_per_page',8);
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$wc_products_per_page.';' ), 20 );
	}
}

# Register Sidebars
# Note: In a child theme with custom crb_setup_theme() this function is not hooked to widgets_init
function crb_widgets_init() {
	# Default Sidebar
	$sidebar_options_default = array_merge(crb_get_default_sidebar_options(), array(
		'name' => __('Default Sidebar', 'basil'),
		'id'   => 'default-sidebar',
	));
	register_sidebar($sidebar_options_default);
	
}

# Sidebar Options
function crb_get_default_sidebar_options() {
	return array(
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	);
}

# Custom code goes below this line

/**
 * Checks if the current browse is IE
 */
function basil_is_IE() {
	global $is_IE;
	return $is_IE;
}

/**
 * Outputs the favicon in wp_head();
 */
add_action('wp_head', 'basil_output_favicon');
function basil_output_favicon() {
	$favicon_src = ot_get_option('to_general_favicon',false);
	
	if ($favicon_src) {
		$favicon_src = wp_get_attachment_image_src( $favicon_src,'full' );
		echo '<link rel="shortcut icon" href="' . $favicon_src[0] . '">';
	}
}

/**
 * Renders the Header Logo
 */
function basil_render_header_logo() {
	$header_logo = ot_get_option( 'to_header_logo' );
	if ( !empty($header_logo) ) {
		?>
		<div class="logo">
			<a href="<?php echo home_url('/'); ?>">
				<img src="<?php echo $header_logo; ?>" alt="<?php bloginfo('name'); ?>" />
			</a>
		</div>
		<?php
	}
}

function basil_recipe_search_form(){
	
	$recipe_list_view_page = get_option('cp_recipes_list_view_page');
	
	if ($recipe_list_view_page):
	
		$recipe_page_url = get_permalink($recipe_list_view_page);
	
		echo '<form method="get" class="searchform" action="'.$recipe_page_url.'">';
			echo '<div>';
				echo '<label class="screen-reader-text" for="content-search">'.__('Search for:', 'basil').'</label>';
				echo '<input type="text" placeholder="'.__('Search recipes...', 'basil').'" name="content-search" class="field" />';
				echo '<input type="submit" class="searchsubmit" value="'.__('Search', 'basil').'" />';
			echo '</div>';
		echo '</form>';
		
	else:
		
		echo wpautop(__('Choose a "Browse Recipe" page.','basil'));
		
	endif;
		
}

/**
 * Checks if the current page is archive, search or home
 * 
 * @return bool
 */
function basil_is_non_singular() {
	return is_archive() || is_search() || is_home();
}

/**
 * Renders the page title depending on the current page
 * 
 * @return html
 * @see loop.php
 */
function basil_page_title() {
	$page_title = '';

	if ( is_archive() ) {
		if ( is_category() ) {
			$page_title .= single_cat_title('', false);
		} elseif ( is_tag() ) {
			$page_title .= single_tag_title('', false);
		} elseif ( is_day() ) {
			$page_title .= get_the_time('F jS, Y');
		} elseif ( is_month() ) {
			$page_title .= get_the_time('F, Y');
		} elseif ( is_year() ) {
			$page_title .= get_the_time('Y');
		} elseif ( is_author() ) {
			$page_title .= __('Author Archive', 'basil').': '.get_the_author_meta( 'display_name' );
		} elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) {
			$page_title .= __('Blog Archives', 'basil');
		}
	} elseif ( is_search() ) {
		$page_title .= __('Search for:', 'basil') . ' <em>' . get_search_query() . '</em>';
	} elseif ( is_404() ) {
		$page_title .= __('404 Error Page', 'basil');
	} elseif ( is_home() ) {
		$page_for_posts = get_option('page_for_posts');
		if ($page_for_posts) {
			$page_title = get_the_title($page_for_posts);
		}
	} elseif ( is_singular() ) {
		$page_title = get_the_title();
	}

	# Returning the output if there is such
	if ( !empty($page_title) ) {
		echo '<h1>' . $page_title . '</h1>';
	}
}

/**
 * Renders the current post title
 * 
 * @return html
 * @see loop.php
 */
function basil_post_title($not_single = true) {
	global $post;
	$post_title = $post->post_title;

	if( basil_is_non_singular() ) {
		$post_title = '<a href="' . get_permalink($post->ID) . '">' . $post_title . '</a>';
	} else {
		if ( ($hide_title = get_post_meta($post->ID, 'page_hide_title', true)) && $hide_title == 'yes' ) {
			$post_title = '';
		}
	}

	if ( !empty($post_title) ) {
		if ($not_single) { echo '<h2 class="entry-title">' . $post_title . '</h2>'; } else { echo '<h1 class="entry-title">' . $post_title . '</h1>'; }
	}
}

/**
 * Returns the content of the current post/page
 * 
 * Checks if the page is in listing page. If true, returns excerpt.
 * Otherwise, returns the whole content.
 */
function basil_the_content() {
	global $post;
	$post_content = get_the_content($post->ID);

	if ( basil_is_non_singular() ) { # Listing page
		if ( $more_tag_pos = strpos($post_content, '<!--more-->') ) { # Check for more tag
			$post_content = strip_tags(substr($post_content, 0, $more_tag_pos));
		} else {
			$post_content = get_the_excerpt();
		}
	}

	echo apply_filters('the_content', $post_content);
}

/**
 * Returns a list with the default socials used in the theme
 */
function basil_get_socials() {
	return array(
		'facebook' => array(
			'label' => __('Facebook', 'basil'),
			'icon'  => 'facebook'
		),
		'twitter' => array(
			'label' => __('Twitter', 'basil'),
			'icon'  => 'twitter',
		),
		'linkedin' => array(
			'label' => __('LinkedIn', 'basil'),
			'icon'  => 'linkedin',
		),
		'foursquare' => array(
			'label' => __('Foursquare', 'basil'),
			'icon'  => 'foursquare',
		),
		'behance' => array(
			'label' => __('Behance', 'basil'),
			'icon'  => 'behance',
		),
		'google_plus' => array(
			'label' => __('Google Plus', 'basil'),
			'icon'  => 'google-plus',
		),
		'dribbble' => array(
			'label' => __('Dribbble', 'basil'),
			'icon'  => 'dribbble',
		),
		'instagram' => array(
			'label' => __('Instagram', 'basil'),
			'icon'  => 'instagram',
		),
		'pinterest' => array(
			'label' => __('Pinterest', 'basil'),
			'icon'  => 'pinterest',
		),
		'soundcloud' => array(
			'label' => __('SoundCloud', 'basil'),
			'icon'  => 'soundcloud',
		),
		'skype' => array(
			'label' => __('Skype', 'basil'),
			'icon'  => 'skype',
		),
		'vimeo' => array(
			'label' => __('Vimeo', 'basil'),
			'icon'  => 'vimeo-square',
		),
		'youtube' => array(
			'label' => __('YouTube', 'basil'),
			'icon'  => 'youtube-play',
		),
	);
}

/**
 * Returns the Theme Options for the Socials
 */
function basil_get_ot_to_socials() {
	$socials = basil_get_socials();
	$output  = array();
	$label_url = __('URL', 'basil');

	foreach ($socials as $s_ID => $s_details) {
		$output[] = array(
			'id'      => 'to_social_' . $s_ID,
			'label'   => __($s_details['label'], 'basil') . ' ' . $label_url,
			'type'    => 'text',
			'std'     => '',
			'section' => 'to_socials',
		);
	}

	return $output;
}

/**
 * Renders the Socials
 */
function basil_render_socials() {
	$socials = basil_get_socials();
	if (!$socials) {
		return;
	}

	ob_start();

	foreach ($socials as $social_ID => $social_details) {
		$social_URL = ot_get_option('to_social_' . $social_ID);
		if ( empty($social_URL) ) {
			continue;
		}
		echo '<li><a href="' . $social_URL . '" target="_blank" title="' . $social_details['label'] . '"><i class="fa fa-' . $social_details['icon'] . '"></i><small></small></a></li>';
	}

	$output = ob_get_clean();
	if ( !empty($output) ) {
		echo $output;
	}
}


/**
 * Renders the Post Meta of a single post
 */
function basil_post_meta() {
	$post_ID = get_the_ID();
	?>

	<p class="basilPostMeta basilMetaOnPost">
		<?php
		# Date
		$date_format = get_option('date_format');
		$post_date  = get_the_time( $date_format, $post_ID );
		$post_year  = get_the_time('Y', $post_ID);
		$post_month = get_the_time('m', $post_ID);
		$post_day   = get_the_time('d', $post_ID);
		$post_date_link = get_day_link($post_year, $post_month, $post_day);
		echo '<span><i class="fa fa-calendar"></i>&nbsp;&nbsp;'.__('Posted on','basil').' <a class="entry-date" href="' . $post_date_link . '">' . $post_date . '</a></span>';

		# Author
		echo '<span><i class="fa fa-user"></i>&nbsp;&nbsp;'.__('by','basil').' <a class="entry-author" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author() . '</a></span>';

		# Comments
		echo '<span><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<a class="entry-comments" href="' . get_comments_link() . '">'; comments_number(__('No comments','basil'),__('1 comment','basil'),'% '.__('comments','basil')); echo '</a></span>';
		?>
	</p>

	<?php
}

/**
 * Renders the Pagination for Single Post
 */
function basil_single_post_pagination() {
	echo '<div class="nav-single clearfix">';
		previous_post_link('<div class="alignleft"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;%link</div>', '%title', true);
		next_post_link('<div class="alignright">%link&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></div>', '%title', true);
	echo '</div><!-- /pagination -->';
}

function basil_non_singular_pagination() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="basilPostsPagination cf"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="basilPrevNextButton basilPrev">%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-arrow-left"></i>&nbsp;&nbsp;'.__('Previous Page','basil')) );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li class="basilPrevNextButton basilNext">%s</li>' . "\n", get_next_posts_link(__('Next Page','basil').'&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>') );

	echo '</ul></div>' . "\n";

}



/**
 * Renders the Banner on Home template
 */
function basil_tpl_home_render_banner() {
	$banner_image = ot_get_option('to_banner_image');
	$banner_text = ot_get_option('to_banner_text');

	ob_start();

	# Banner Image
	if ( !empty($banner_image) ) {
		echo '<img width="2000" src="'.$banner_image.'" class="home-banner attachment-basil_tpl_home_banner_image" alt="" />';
	}

	# Banner Text
	if ( !empty($banner_text) ) {
		?>
		<div class="banner-text">
			<div class="shell">
				<?php echo apply_filters('the_content', $banner_text); ?>
			</div>
		</div>
		<?php
	}

	$output = ob_get_clean();
	if ( !empty($output) ) {
		?>
		<div class="banner">
			<?php echo $output; ?>
			<div class="color-bar">
				<span class="color-bar-1"></span>
				<span class="color-bar-2"></span>
				<span class="color-bar-3"></span>
				<span class="color-bar-4"></span>
				<span class="color-bar-5"></span>
			</div>
		</div><!-- /banner -->
		<?php
	}
}

/**
 * Converts a given HEX color to its RGB
 */
function basil_hex_to_rgba($hex, $opacity = 1) {
	if ( substr($hex, 0, 1) == '#' ) {
		$hex = substr($hex, 1);
	}

	$r = hexdec( substr($hex, 0, 2) );
	$g = hexdec( substr($hex, 2, 2) );
	$b = hexdec( substr($hex, 4, 2) );

	$output = "rgba({$r}, {$g}, {$b}, {$opacity})";
	return $output;
}

/**
 * Renders the custom css data
 */
add_action('wp_head', 'basil_render_custom_css');
function basil_render_custom_css() {

	$theme_options = get_option( ot_options_id() );
	$theme_uri = get_template_directory_uri();
	
	$pattern_file = dirname(__FILE__) . '/options/custom-basil-css-pattern.php';
	if ( !file_exists($pattern_file) ) {
		return;
	}

	ob_start();
	echo '<style type="text/css">';
	include_once esc_attr($pattern_file);
	echo '</style>';
	$output = ob_get_clean();
	
	echo $output;
}

/**
 * Renders the footer
 */
function basil_render_footer() {
	$footer_left_choice  = ot_get_option('to_footer_bottom_left');
	$footer_right_choice = ot_get_option('to_footer_bottom_right');
	if ( empty($footer_left_choice) && empty($footer_right_choice) ) {
		return;
	}
	?>
	<div class="footer">
		<div class="shell clearfix">
			<?php
			# Header Left Text
			if ( $footer_left_choice ) {
				echo '<div class="left">';
					if ( $footer_left_choice == 'text' ) {
						$footer_left_text = ot_get_option('to_footer_bottom_left_text');
						if ($footer_left_text) {
							echo '<p class="copyright">' . do_shortcode($footer_left_text) . '</p>';
						}
					} elseif ($footer_left_choice == 'socials') {
						basil_render_socials();
					}
				echo '</div>';
			}

			# Header Right Text
			if ( $footer_right_choice ) {
				echo '<div class="right">';
					if ( $footer_right_choice == 'text' ) {
						$footer_right_text = ot_get_option('to_footer_bottom_right_text');
						if ($footer_right_text) {
							echo '<p class="footer-text">' . do_shortcode($footer_right_text) . '</p>';
						}
					} elseif ($footer_right_choice == 'socials') {
						basil_render_socials();
					}
				echo '</div>';
			}
			?>
		</div>
	</div>
	<?php
}

/**
 * Returns the Color Options
 */
function basil_get_to_color_options() {
	$options = array(
	
		# Link Colors
		'link_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Link Color', 'basil'),
			'std'   => '#90CC28',
		),
		'link_color_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Link Color on Hover', 'basil'),
			'std'   => '#555',
		),
	
		# Button Option 1 Colors
		'button_color_1_bg' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 1 (Background)', 'basil'),
			'std'   => '#90CC28',
		),
		'button_color_1_text' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 1 (Text)', 'basil'),
			'std'   => '#fff',
		),
		'button_color_1_bg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 1 on Hover (Background)', 'basil'),
			'std'   => '#000',
		),
		'button_color_1_text_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 1 on Hover (Text)', 'basil'),
			'std'   => '#fff',
		),
		
		# Button Option 2 Colors
		'button_color_2_bg' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 2 (Background)', 'basil'),
			'std'   => '#E15152',
		),
		'button_color_2_text' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 2 (Text)', 'basil'),
			'std'   => '#fff',
		),
		'button_color_2_bg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 2 on Hover (Background)', 'basil'),
			'std'   => '#000',
		),
		'button_color_2_text_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 2 on Hover (Text)', 'basil'),
			'std'   => '#fff',
		),
		
		# Button Option 3 Colors
		'button_color_3_bg' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 3 (Background)', 'basil'),
			'std'   => '#aaa',
		),
		'button_color_3_text' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 3 (Text)', 'basil'),
			'std'   => '#fff',
		),
		'button_color_3_bg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 3 on Hover (Background)', 'basil'),
			'std'   => '#666',
		),
		'button_color_3_text_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Button Color 3 on Hover (Text)', 'basil'),
			'std'   => '#fff',
		),
		
		# Header & Navigation
		'header_bg_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Header Background Color', 'basil'),
			'std'   => '#fff',
		),
		'header_text_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Header Right Text Color (if active)', 'basil'),
			'std'   => '#aaa',
		),
		'nav_bg_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Background Color', 'basil'),
			'std'   => '#90CC28',
		),
		'nav_link_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Link Color', 'basil'),
			'std'   => '#fff',
		),
		'nav_link_color_text_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Link Color on Hover', 'basil'),
			'std'   => '#fff',
		),
		'nav_link_color_bg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Link Background Color on Hover', 'basil'),
			'std'   => '#B1DB5E',
		),
		'nav_dropdown_bg_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Dropdown Background Color', 'basil'),
			'std'   => '#B1DB5E',
		),
		'nav_dropdown_link_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Dropdown Link Color', 'basil'),
			'std'   => '#fff',
		),
		'nav_dropdown_link_color_text_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Dropdown Link Color on Hover', 'basil'),
			'std'   => '#888',
		),
		'nav_dropdown_link_color_bg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Dropdown Link Background Color on Hover', 'basil'),
			'std'   => '#fff',
		),
		'nav_text_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Navigation Right Text Color (if active)', 'basil'),
			'std'   => '#e6f5c8',
		),
		
		# Socials in Navigation
		'nav_socials_fg' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Socials in Nav (foreground color)', 'basil'),
			'std'   => '#fff',
		),
		'nav_socials_bg' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Socials in Nav (background color)', 'basil'),
			'std'   => '#B1DB5E',
		),
		'nav_socials_fg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Socials in Nav (foreground color) on Hover ', 'basil'),
			'std'   => '#000',
		),
		'nav_socials_bg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Socials in Nav (background color) on Hover ', 'basil'),
			'std'   => '#fff',
		),
		
		# Socials in Footer
		'footer_socials_fg' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Socials in Footer (foreground color)', 'basil'),
			'std'   => '#888',
		),
		'footer_socials_bg' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Socials in Footer (background color)', 'basil'),
			'std'   => '#333',
		),
		'footer_socials_fg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Socials in Footer (foreground color) on Hover ', 'basil'),
			'std'   => '#fff',
		),
		'footer_socials_bg_hover' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Socials in Footer (background color) on Hover ', 'basil'),
			'std'   => '#90CC28',
		),

		# Blog Post Colors
		'blog_panel_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Blog Image Panel Color (on hover)', 'basil'),
			'std'   => '#90CC28',
		),
		
		# Pagination Colors
		'pagination_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Pagination Color', 'basil'),
			'std'   => '#90CC28',
		),
		
		# Twitter Block Colors
		'twitter_bg_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Twitter Block Background Color', 'basil'),
			'std'   => '#E15152',
		),
		'twitter_text_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Twitter Block Text Color', 'basil'),
			'std'   => '#fff',
		),
		
		# Footer Colors
		'footer_bg_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Footer Background Color', 'basil'),
			'std'   => '#000',
		),
		'footer_text_color' => array( # Color
			'type'  => 'colorpicker',
			'label' => __('Footer Text Color', 'basil'),
			'std'   => '#aaa',
		),
		

		
	);

	$output_options = array();
	foreach ($options as $o_ID => $o_details) {
		$output_options[] = array(
			'id'    => 'to_color_' . $o_ID,
			'type'  => $o_details['type'],
			'label' => $o_details['label'],
			'std'	=> $o_details['std'],
			'section' => 'to_colors',
			'min_max_step' => ( isset($o_details['min_max_step']) ? $o_details['min_max_step'] : '' ),
		);
	}

	return $output_options;
}

function basil_menu_message(){
	echo '<span style="color:#fff;">'.__('Please add a menu.','basil').'</span>';
}

/**
 * Returns the content position
 */
function basil_get_content_position() {
	
	$content_position = 'left';
	if ( is_page() || is_front_page() ) {
		$content_position = get_post_meta( get_the_ID(), 'page_content_position', true );
	}
	
	return $content_position;
	
}

/**
 * Returns the Sidebar Position
 */
function basil_get_sidebar_position() {
	$content_position = basil_get_content_position();

	return ( $content_position == 'left' ? 'right' : 'left' );
}