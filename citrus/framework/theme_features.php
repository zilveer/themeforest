<?php if (!function_exists('dt_theme_features')) {

	// Register Theme Features
	function dt_theme_features() {
		global $wp_version;
		
		// Add theme support for Custom Background
		$b_args = array(
			'default-color' => 'ffffff',
			'default-image' => '',
			'wp-head-callback' => '_custom_background_cb',
			'admin-head-callback' => '',
			'admin-preview-callback' => ''
		);
		add_theme_support('custom-background', $b_args);
		// END of Custom Background Feature

		// Add theme support for Custom Header
		$hargs = array( 'default-image'=>'',	'random-default'=>false,	'width'=>0,					'height'=>0,
				'flex-height'=> false,	'flex-width'=> false,		'default-text-color'=> '',	'header-text'=> false,
				'uploads'=> true,		'wp-head-callback'=> '',	'admin-head-callback'=> '',	'admin-preview-callback' => '');
				
		add_theme_support('custom-header', $hargs);
		// END of Custom Header Feature
		
		
		# Now Theme supports WooCommerce
		add_theme_support('woocommerce');

		// Add theme support for Translation
		load_theme_textdomain('dt_themes', get_template_directory().'/languages');

		// Add theme support for Post Formats
		$formats = array(
			'status',
			'quote',
			'gallery',
			'image',
			'video',
			'audio',
			'link',
			'aside',
			'chat'
		);
		add_theme_support('post-formats', $formats);
		// END of Post Formats

		// Add theme support for custom CSS in the TinyMCE visual editor
		add_editor_style('custom-editor-style.css');

		// Add theme support for Automatic Feed Links
	
		add_theme_support('automatic-feed-links');
		// END of Automatic Feed Links

		// Add theme support for Featured Images
		add_theme_support('post-thumbnails', array(
			'post',
			'page',
			'product',
			'tribe_events',
			'dt_teachers',
			'course',
			'lesson',
			'dt_courses'
		));

		add_image_size('portfolio-two-column', 580, 580, true);
		add_image_size('portfolio-two-column-single-sidebar', 435, 435, true);
		add_image_size('portfolio-two-column-both-sidebar', 420, 420, true);
		add_image_size('portfolio-two-column-fullwidth', 951, 951, true);

		add_image_size('portfolio-three-column', 420, 420, true);
		add_image_size('portfolio-three-column-single-sidebar', 420, 420, true);
		add_image_size('portfolio-three-column-both-sidebar', 420, 420, true);
		add_image_size('portfolio-three-column-fullwidth', 634, 634, true);
		
		add_image_size('portfolio-four-column', 420, 420, true);
		add_image_size('portfolio-four-column-single-sidebar', 420, 420, true);
		add_image_size('portfolio-four-column-both-sidebar', 420, 420, true);
		add_image_size('portfolio-four-column-fullwidth', 475, 475, true);
		
		add_image_size('portfolio-single', 567, 567, true);
		add_image_size('portfolio-single-fullwidth', 1160, 1160, true);
		
		add_image_size('blog-one-column', 1160, 800, true);
		add_image_size('blog-one-column-single-sidebar', 870, 600, true);
		add_image_size('blog-one-column-both-sidebar', 580, 400, true);
		
		add_image_size('blog-two-column', 567, 391, true);
		add_image_size('blog-two-column-single-sidebar', 425, 293, true);
		add_image_size('blog-two-column-both-sidebar', 284, 196, true);

		add_image_size('blog-three-column', 425, 293, true);
		add_image_size('blog-three-column-single-sidebar', 425, 293, true);
		add_image_size('blog-three-column-both-sidebar', 580, 300, true);

		add_image_size('blog-thumb-widget', 85, 85, true);
		
		// END of Featured Images option
		
		if (version_compare($wp_version, '3.6', '>=')) :
		
			$args = array(
				'search-form',
				'comment-form',
				'comment-list'
			);
		
			add_theme_support( 'html5', $args );		
		endif;

	}
	// Hook into the 'after_setup_theme' action
	add_action('after_setup_theme', 'dt_theme_features');

}

if (!function_exists('dttheme_activation_function')) {
	function dttheme_activation_function($oldname, $oldtheme=false) {
		update_option(IAMD_THEME_SETTINGS, dttheme_default_option());
	}
	add_action("after_switch_theme", "dttheme_activation_function", 10 , 2);
}

if (!function_exists('dt_theme_navigation_menus')) {

	// Register Navigation Menus
	function dt_theme_navigation_menus() {
		$menus = dttheme_option('menus');
		
		$locations = array(
			'header_menu' => __('Header Menu', 'dt_themes'),
		);
		
		if(isset($menus) && $menus != '') {
			foreach($menus as $key => $menu) {
				$locations[$key] = esc_html($menu);
			}
		}
		register_nav_menus($locations);
	}

	// Hook into the 'init' action
	add_action('init', 'dt_theme_navigation_menus');
}