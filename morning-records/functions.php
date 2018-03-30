<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */

// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'morning_records_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_theme_setup', 1 );
	function morning_records_theme_setup() {

		// Register theme menus
		add_filter( 'morning_records_filter_add_theme_menus',		'morning_records_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'morning_records_filter_add_theme_sidebars',	'morning_records_add_theme_sidebars' );

		// Set options for importer
		add_filter( 'morning_records_filter_importer_options',		'morning_records_set_importer_options' );

		// Add theme required plugins
		add_filter( 'morning_records_filter_required_plugins',		'morning_records_add_required_plugins' );

		// Add theme specified classes into the body
		add_filter( 'body_class', 'morning_records_body_classes' );

		// Set list of the theme required plugins
		morning_records_storage_set('required_plugins', array(
			'essgrids',
			'instagram_widget',
			'revslider',
			'trx_utils',
			'visual_composer',
			'woocommerce'
			)
		);
		
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'morning_records_add_theme_menus' ) ) {
	//add_filter( 'morning_records_filter_add_theme_menus', 'morning_records_add_theme_menus' );
	function morning_records_add_theme_menus($menus) {
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'morning_records_add_theme_sidebars' ) ) {
	//add_filter( 'morning_records_filter_add_theme_sidebars',	'morning_records_add_theme_sidebars' );
	function morning_records_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> esc_html__( 'Main Sidebar', 'morning-records' ),
				'sidebar_footer'	=> esc_html__( 'Footer Sidebar', 'morning-records' )
			);
			if (function_exists('morning_records_exists_woocommerce') && morning_records_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = esc_html__( 'WooCommerce Cart Sidebar', 'morning-records' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}


// Add theme required plugins
if ( !function_exists( 'morning_records_add_required_plugins' ) ) {
	//add_filter( 'morning_records_filter_required_plugins',		'morning_records_add_required_plugins' );
	function morning_records_add_required_plugins($plugins) {
		$plugins[] = array(
			'name' 		=> esc_html__( 'Morning Utilities', 'morning-records' ),
			'version'	=> '2.7',					// Minimal required version
			'slug' 		=> 'trx_utils',
			'source'	=> morning_records_get_file_dir('plugins/install/trx_utils.zip'),
			'force_activation'   => false,			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => true,			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'required' 	=> true
		);
		return $plugins;
	}
}


// Add theme specified classes into the body
if ( !function_exists('morning_records_body_classes') ) {
	//add_filter( 'body_class', 'morning_records_body_classes' );
	function morning_records_body_classes( $classes ) {

		$classes[] = 'morning_records_body';
		$classes[] = 'body_style_' . trim(morning_records_get_custom_option('body_style'));
		$classes[] = 'body_' . (morning_records_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent');
		$classes[] = 'theme_skin_' . trim(morning_records_get_custom_option('theme_skin'));
		$classes[] = 'article_style_' . trim(morning_records_get_custom_option('article_style'));
		
		$blog_style = morning_records_get_custom_option(is_singular() && !morning_records_storage_get('blog_streampage') ? 'single_style' : 'blog_style');
		$classes[] = 'layout_' . trim($blog_style);
		$classes[] = 'template_' . trim(morning_records_get_template_name($blog_style));
		
		$body_scheme = morning_records_get_custom_option('body_scheme');
		if (empty($body_scheme)  || morning_records_is_inherit_option($body_scheme)) $body_scheme = 'original';
		$classes[] = 'scheme_' . $body_scheme;

		$top_panel_position = morning_records_get_custom_option('top_panel_position');
		if (!morning_records_param_is_off($top_panel_position)) {
			$classes[] = 'top_panel_show';
			$classes[] = 'top_panel_' . trim($top_panel_position);
		} else 
			$classes[] = 'top_panel_hide';
		$classes[] = morning_records_get_sidebar_class();

		if (morning_records_get_custom_option('show_video_bg')=='yes' && (morning_records_get_custom_option('video_bg_youtube_code')!='' || morning_records_get_custom_option('video_bg_url')!=''))
			$classes[] = 'video_bg_show';

		if (morning_records_get_theme_option('page_preloader')!='')
			$classes[] = 'preloader';

		return $classes;
	}
}

// Add TOC items 'Home' and "To top"
if ( !function_exists('morning_records_home_and_toc') ) {
    function morning_records_home_and_toc()
    {
        if (morning_records_get_custom_option('menu_toc_home') == 'yes')
            echo trim(morning_records_sc_anchor(array(
                    'id' => "toc_home",
                    'title' => esc_html__('Home', 'morning-records'),
                    'description' => esc_html__('{{Return to Home}} - ||navigate to home page of the site', 'morning-records'),
                    'icon' => "icon-home",
                    'separator' => "yes",
                    'url' => esc_url(home_url('/'))
                )
            ));
        if (morning_records_get_custom_option('menu_toc_top') == 'yes')
            echo trim(morning_records_sc_anchor(array(
                    'id' => "toc_top",
                    'title' => esc_html__('To Top', 'morning-records'),
                    'description' => esc_html__('{{Back to top}} - ||scroll to top of the page', 'morning-records'),
                    'icon' => "icon-double-up",
                    'separator' => "yes")
            ));
    }
}

// Page preloader
if ( !function_exists('morning_records_page_preloader') ) {
    function morning_records_page_preloader()
    {
        if (($preloader=morning_records_get_theme_option('page_preloader'))!='') {
            $clr = morning_records_get_scheme_color('bg_color');
            ?>
            <style type="text/css">
                <!--
                #page_preloader { background-color: <?php echo esc_attr($clr); ?>; background-image:url(<?php echo esc_url($preloader); ?>); }
                -->
            </style>
            <?php
        }
    }
}

// Theme options
if ( !function_exists('morning_records_custom_options') ) {
    function morning_records_custom_options()
    {
        $theme_init = array();
        $theme_init['theme_skin'] = morning_records_esc(morning_records_get_custom_option('theme_skin'));
        $theme_init['body_scheme'] = morning_records_get_custom_option('body_scheme');
        if (empty($theme_init['body_scheme'])  || morning_records_is_inherit_option($theme_init['body_scheme'])) $theme_init['body_scheme'] = 'original';
        $theme_init['body_style']  = morning_records_get_custom_option('body_style');
        $theme_init['top_panel_position'] = morning_records_get_custom_option('top_panel_position');
        $theme_init['top_panel_scheme'] = morning_records_get_custom_option('top_panel_scheme');
        $theme_init['video_bg_show']  = morning_records_get_custom_option('show_video_bg')=='yes' && (morning_records_get_custom_option('video_bg_youtube_code')!='' || morning_records_get_custom_option('video_bg_url')!='');

        return $theme_init;
    }
}


// Set theme specific importer options
if ( !function_exists( 'morning_records_set_importer_options' ) ) {
	//add_filter( 'morning_records_filter_importer_options',	'morning_records_set_importer_options' );
	function morning_records_set_importer_options($options=array()) {
		if (is_array($options)) {
			$options['debug'] = morning_records_get_theme_option('debug_mode')=='yes';
			$options['menus'] = array(
				'menu-main'	  => esc_html__('Main menu', 'morning-records'),
				'menu-user'	  => esc_html__('User menu', 'morning-records'),
				'menu-footer' => esc_html__('Footer menu', 'morning-records'),
				'menu-outer'  => esc_html__('Main menu', 'morning-records')
			);

			// Prepare demo data
			$demo_data_url = esc_url('http://recstudio.ancorathemes.com/demo/');
			
			// Main demo
			$options['files']['default'] = array(
				'title'				=> esc_html__('Morning demo', 'morning-records'),
				'file_with_posts'	=> $demo_data_url . 'default/posts.txt',
				'file_with_users'	=> $demo_data_url . 'default/users.txt',
				'file_with_mods'	=> $demo_data_url . 'default/theme_mods.txt',
				'file_with_options'	=> $demo_data_url . 'default/theme_options.txt',
				'file_with_templates'=>$demo_data_url . 'default/templates_options.txt',
				'file_with_widgets'	=> $demo_data_url . 'default/widgets.txt',
				'file_with_revsliders' => array(
					$demo_data_url . 'default/revsliders/home.zip',
				),
				'file_with_attachments' => array(),
				'attachments_by_parts'	=> true,
				'domain_dev'	=> esc_url('recstudio.dv.ancorathemes.com'),
				'domain_demo'	=> esc_url('recstudio.ancorathemes.com')
			);
			for ($i=1; $i<=3; $i++) {
				$options['files']['default']['file_with_attachments'][] = $demo_data_url . 'default/uploads/uploads.' . sprintf('%03u', $i);
			}
		}
		return $options;
	}
}

function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');


/* Include framework core files
------------------------------------------------------------------- */
// If now is WP Heartbeat call - skip loading theme core files (to reduce server and DB uploads)
    require_once trailingslashit( get_template_directory() ) . 'fw/loader.php';
?>