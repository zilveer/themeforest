<?php if(! defined('ABSPATH')){ return; }

$theme_config = array(
		'options_prefix' => 'zn_kallyas_optionsv4', // The DB options field name
		'theme_id' => 'kallyas', // The theme id that will be used for options field
		'name'           => 'Kallyas', // The theme name
		'server_url'	=> 'http://kallyas.net',
		'supports'       => array(
			'pagebuilder'  	=> true,
			'megamenu'     	=> true,
			'iconmanager'  	=> true,
			'imageresizer' 	=> true,
			'shortcodes' 	=> false,
			'theme_updater'	=> array(
				'author' => 'Hogash',
			),
		),
	);

	// Change the advanced tab to advanced_options. This is needed for the custom css save
	// TODO : Remove this and change the 'advanced_options' to 'advanced'
	function zn_add_custom_css_saving( $saved_options ){

		if ( isset( $saved_options['advanced_options']['custom_css'] ) ) {
			$custom_css = $saved_options['advanced_options']['custom_css'];
			update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_css', $custom_css, false );

			// Remove custom css from the main options field
			unset( $saved_options['advanced_options']['custom_css'] );
		}

		if ( isset( $saved_options['advanced_options']['custom_js'] ) ) {
			$custom_js = $saved_options['advanced_options']['custom_js'];
			update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_js', $custom_js, true );

			// Remove custom css from the main options field
			unset( $saved_options['advanced_options']['custom_js'] );
		}

		return $saved_options;
	}
	add_filter( 'zn_options_to_save', 'zn_add_custom_css_saving' );

	function znkl_dummy_data_locations(){
		return array(
			'main' => array(
				'title'   => 'KALLYAS MAIN DEMO',
				'desc'   => 'This is the main demo of our theme.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/main_demo/main-demo.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/main_demo',
				'preview' => 'http://kallyas.net/demo/',
				'plugins' => array('woocommerce', 'revslider', 'hogash-post-love', 'CuteSlider'),
			),
			'one_page' => array(
				'title'   => 'KALLYAS ONE PAGE',
				'desc'   => 'This is the one page demo of the theme',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/one_page/one-page.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/one_page',
				'preview' => 'http://kallyas.net/demos/',
				'plugins' => array(),
			),
			'ares_furniture' => array(
				'title'   => 'ARES DEMO',
				'desc'   => 'Import Ares Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/ares_furniture/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/ares_furniture',
				'preview' => 'http://kallyas.net/demo-ares/furniture/',
				'plugins' => array('woocommerce', 'revslider', 'hogash-post-love'),
			),
			'travel' => array(
				'title'   => 'TRAVEL DEMO',
				'desc'   => 'Import Travel Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/travel/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/travel',
				'preview' => 'http://kallyas.net/demos/travel/',
				'plugins' => array('woocommerce', 'revslider', 'booking'),
			),
			'app_landing' => array(
				'title'   => 'APP LANDING DEMO',
				'desc'   => 'Import App Landing Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/app_landing/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/app_landing',
				'preview' => 'http://kallyas.net/demo-kyma/app-landing/',
				'plugins' => array('revslider'),
			),
			'restaurant' => array(
				'title'   => 'RESTAURANT DEMO',
				'desc'   => 'Import Restaurant Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/restaurant/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/restaurant',
				'preview' => 'http://kallyas.net/demos/phaeton-demo-wordpress-restaurant',
				'plugins' => array('revslider'),
			),
			'construction' => array(
				'title'   => 'CONSTRUCTION DEMO',
				'desc'   => 'Import Restaurant Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/construction/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/construction',
				'preview' => 'http://kallyas.net/demo-ares/construction/',
				'plugins' => array('revslider'),
			),
			'jewelry' => array(
				'title'   => 'JEWELRY DEMO',
				'desc'   => 'Import Jewelry Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/jewelry/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/jewelry',
				'preview' => 'http://kallyas.net/demo-ares/jewelry/',
				'plugins' => array('woocommerce', 'revslider', 'hogash-post-love'),
			),
			'fitness' => array(
				'title'   => 'FITNESS DEMO',
				'desc'   => 'Import Fitness Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/fitness/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/fitness',
				'preview' => 'http://kallyas.net/demo-ares/fitness/',
				'plugins' => array('revslider','bookly-responsive-appointment-booking-tool','event-calendar-wd/ecwd.php'),
			),
			'portfolio-minimal' => array(
				'title'   => 'Portfolio Minimal',
				'desc'   => 'Import Portfolio Minimal Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/portfolio-minimal/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/portfolio-minimal',
				'preview' => 'http://demo.kallyas.net/portfolio-minimal/',
				'plugins' => array('revslider'),
			),
			'parallax' => array(
				'title'   => 'Parallax',
				'desc'   => 'Import Parallax Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/parallax/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/parallax',
				'preview' => 'http://demo.kallyas.net/parallax/',
				'plugins' => array('woocommerce'),
			),
			'education' => array(
				'title'   => 'Education',
				'desc'   => 'Import Education Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/education/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/education',
				'preview' => 'http://demo.kallyas.net/education/',
				'plugins' => array( 'revslider','bookly-responsive-appointment-booking-tool','event-calendar-wd', 'znpb-counter-element', 'bbpress' ),
			),
			'dash' => array(
				'title'   => 'Dash',
				'desc'   => 'Import Dash Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/dash/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/dash',
				'preview' => 'http://demo.kallyas.net/dash/',
				'plugins' => array(),
			),
			'barbershop' => array(
				'title'   => 'Barbershop',
				'desc'    => 'Import Barbershop Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/barbershop/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/barbershop',
				'preview' => 'http://demo.kallyas.net/barbershop/',
				'plugins' => array('woocommerce', 'bookly-responsive-appointment-booking-tool' ),
			),
			'jewelry2' => array(
				'title'   => 'Jewelry 2',
				'desc'    => 'Import Jewelry #2 Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/jewelry2/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/jewelry2',
				'preview' => 'http://demo.kallyas.net/jewelry2/',
				'plugins' => array('revslider','woocommerce'),
			),
			'watchshop' => array(
				'title'   => 'WatchShop',
				'desc'    => 'Import WatchShop Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/watchshop/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/watchshop',
				'preview' => 'http://demo.kallyas.net/watchshop/',
				'plugins' => array('revslider','woocommerce'),
			),
			'freelancer' => array(
				'title'   => 'Freelancer',
				'desc'    => 'Import Freelancer Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/freelancer/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/freelancer',
				'preview' => 'http://demo.kallyas.net/freelancer/',
				'plugins' => array(),
			),
			'wedding' => array(
				'title'   => 'Wedding',
				'desc'    => 'Import Wedding Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/wedding/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/wedding',
				'preview' => 'http://demo.kallyas.net/wedding/',
				'plugins' => array(),
			),
			'product-landing' => array(
				'title'   => 'Product Landing',
				'desc'    => 'Import Product Landing Demo content.',
				'image'   => THEME_BASE_URI .'/template_helpers/dummy_content/product-landing/thumb.jpg',
				'folder'  => THEME_BASE .'/template_helpers/dummy_content/product-landing',
				'preview' => 'http://demo.kallyas.net/product-landing/',
				'plugins' => array('revslider', 'znpb-counter-element' ),
			),
		);
	}

	add_filter( 'zn_dummy_data_locations', 'znkl_dummy_data_locations' );

