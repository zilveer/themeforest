<?php

/*
 * Enqueue Scripts & Styles
 */
function barcelona_enqueue_scripts() {

	wp_enqueue_script( 'jquery' );

	if ( ! is_admin() ) {

		$barcelona_post_id = NULL;
		if ( is_singular() ) {
			global $post;
			$barcelona_post_id = $post->ID;
		}

		/*
		 * Enqueue Styles
		 */
		$barcelona_font = barcelona_get_font();
		wp_register_style( 'barcelona-font', esc_url( $barcelona_font[0] ) );
		wp_enqueue_style( 'barcelona-font' );

		wp_register_style( 'bootstrap', BARCELONA_THEME_PATH .'assets/css/bootstrap.min.css', array(), '3.3.4' );
		wp_enqueue_style( 'bootstrap' );

		wp_register_style( 'font-awesome', BARCELONA_THEME_PATH .'assets/css/font-awesome.min.css', array(), '4.4.0' );
		wp_enqueue_style( 'font-awesome' );

		wp_register_style( 'vs-preloader', BARCELONA_THEME_PATH .'assets/css/vspreloader.min.css' );
		wp_enqueue_style( 'vs-preloader' );

		wp_register_style( 'owl-carousel', BARCELONA_THEME_PATH .'assets/lib/owl-carousel/assets/owl.carousel.min.css', array(), '2.0.0');
		wp_enqueue_style( 'owl-carousel' );

		wp_register_style( 'owl-theme', BARCELONA_THEME_PATH .'assets/lib/owl-carousel/assets/owl.theme.default.min.css', array(), '2.0.0' );
		wp_enqueue_style( 'owl-theme' );

		wp_register_style( 'jquery-boxer', BARCELONA_THEME_PATH .'assets/css/jquery.fs.boxer.min.css', array(), '3.3.0' );
		wp_enqueue_style( 'jquery-boxer' );

		wp_register_style( 'barcelona-stylesheet', BARCELONA_THEME_PATH .'style.css', array(), BARCELONA_THEME_VERSION );
		wp_enqueue_style( 'barcelona-stylesheet' );

		if ( is_rtl() ) {
			wp_register_style( 'barcelona-rtl', BARCELONA_THEME_PATH .'assets/css/barcelona-rtl.css', array(), BARCELONA_THEME_VERSION );
			wp_enqueue_style( 'barcelona-rtl' );
		}

		if ( class_exists('Woocommerce') ) {

			wp_register_style( 'barcelona-woocommerce-stylesheet', BARCELONA_THEME_PATH  .'woocommerce/css/woocommerce.css', array(), BARCELONA_THEME_VERSION );
			wp_enqueue_style('barcelona-woocommerce-stylesheet');

			if ( is_rtl() ) {
				wp_register_style( 'barcelona-woocommerce-rtl', BARCELONA_THEME_PATH  .'woocommerce/css/woocommerce-rtl.css', array(), BARCELONA_THEME_VERSION );
				wp_enqueue_style('barcelona-woocommerce-rtl');
			}

		}

		/*
		 * Enqueue Scripts
		 */
		wp_register_script( 'ie-html5', BARCELONA_THEME_PATH .'assets/js/html5.js');
		wp_enqueue_script( 'ie-html5' );

		wp_register_script( 'bootstrap', BARCELONA_THEME_PATH .'assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.4', true );
		wp_enqueue_script( 'bootstrap' );

		wp_register_script( 'retina-js', BARCELONA_THEME_PATH .'assets/js/retina.min.js' );
		wp_enqueue_script( 'retina-js' );

		wp_register_script( 'picturefill', BARCELONA_THEME_PATH .'assets/js/picturefill.min.js', array(), false, true );
		wp_enqueue_script( 'picturefill' );

		wp_register_script( 'owl-carousel', BARCELONA_THEME_PATH .'assets/lib/owl-carousel/owl.carousel.min.js', array( 'jquery' ), '2.0.0', true );
		wp_enqueue_script( 'owl-carousel' );

		wp_register_script( 'boxer', BARCELONA_THEME_PATH .'assets/js/jquery.fs.boxer.min.js', array( 'jquery' ), '3.3.0', true );
		wp_enqueue_script( 'boxer' );

		if ( is_active_widget( false, false, 'barcelona-gplus-box' ) ) {
			wp_register_script( 'google-platform', esc_url( '//apis.google.com/js/platform.js' ), false, true );
			wp_enqueue_script( 'google-platform' );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$barcelona_params = array(
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'post_id' => $barcelona_post_id,
			'i18n' => array(
				'login_to_vote' => esc_html__( 'Please login to vote!', 'barcelona' )
			)
		);

		if ( is_archive() || is_search() || is_home() ) {
			global $wp_query;
			if ( property_exists( $wp_query, 'query' ) ) {
				$barcelona_params['query'] = $wp_query->query;
			}
			$barcelona_params['posts_layout'] = barcelona_get_option( 'posts_layout' );
			$barcelona_params['post_meta_choices'] = barcelona_get_option( 'post_meta_choices' );
		}
		$barcelona_params['masonry_layout'] = barcelona_get_option( 'masonry_layout' );
		

		wp_register_script( 'barcelona-main', BARCELONA_THEME_PATH .'assets/js/barcelona-main.js', array( 'jquery' ), BARCELONA_THEME_VERSION, true );
		wp_enqueue_script( 'barcelona-main' );
		wp_localize_script( 'barcelona-main', 'barcelonaParams', $barcelona_params );

	}

}
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/*
 * This theme styles the visual editor to resemble the theme style
 */
function barcelona_after_setup_theme() {

	add_action( 'wp_enqueue_scripts', 'barcelona_enqueue_scripts', 99 );

	add_editor_style( 'includes/admin/css/barcelona-editor.css' );

	if ( is_rtl() ) {
		add_editor_style( 'includes/admin/css/barcelona-editor-rtl.css' );
	}

}
add_action( 'after_setup_theme', 'barcelona_after_setup_theme' );

/*
 * Add custom codes for header
 */
function barcelona_header_custom_code() {

	$barcelona_extra_fonts = array();
	if ( is_active_widget( false, false, 'barcelona-about-me' ) ) {
		$barcelona_extra_fonts = array( 'Old+Standard+TT' );
	}

	$barcelona_font = barcelona_get_font( $barcelona_extra_fonts );
	$barcelona_background = barcelona_get_background();
	$barcelona_options = barcelona_get_options( array(
		'apple_touch_icon_iphone',
		'apple_touch_icon_ipad',
		'apple_touch_icon_retina',
		'favicon_url',
		'header_custom_code',
		'css_custom_code',
		'nosidebar_content_width',
		'selection_color',
		'top_nav_background_color',
		'top_nav_background_hover_color',
        'top_nav_link_color',
        'top_nav_active_item_background_color',
        'top_nav_active_item_link_color',
        'megamenu_background_color',
        'megamenu_link_color',
        'megamenu_text_color',
        'footer_background_color',
		'general_link_color',
		'header_link_color',
		'footer_link_color',
		'footer_text_color',
		'facebook_app_id',
		'add_facebook_og_tags'
	) );

	if ( ! empty( $barcelona_options['apple_touch_icon_iphone'] ) ) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="57x57" href="'. esc_url( $barcelona_options['apple_touch_icon_iphone'] ) .'" />'. "\n";
	}

	if ( ! empty( $barcelona_options['apple_touch_icon_ipad'] ) ) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'. esc_url( $barcelona_options['apple_touch_icon_ipad'] ) .'" />'. "\n";
	}

	if ( ! empty( $barcelona_options['apple_touch_icon_retina'] ) ) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'. esc_url( $barcelona_options['apple_touch_icon_retina'] ) .'" />'. "\n";
	}

	if ( ! empty( $barcelona_options['favicon_url'] ) ) {
		echo '<link rel="icon" href="'. esc_url( $barcelona_options['favicon_url'] ) .'" />'. "\n";
	}

	/*
	 * Add Open Graph Tags
	 */
	if ( $barcelona_options['add_facebook_og_tags'] == 'on' ) {

		$barcelona_og_tags = array();
		$barcelona_desc_length = 197;

		if ( ! function_exists( 'jetpack_og_tags' ) ):

			if ( is_home() || is_front_page() ) {

				$barcelona_front_page_id = get_option( 'page_for_posts' );

				$barcelona_og_tags['og:type'] = 'website';
				$barcelona_og_tags['og:title'] = get_bloginfo( 'name' );
				$barcelona_og_tags['og:description'] = get_bloginfo( 'description' );
				$barcelona_og_tags['og:url'] = ( $barcelona_front_page_id && is_home() ) ? get_permalink( $barcelona_front_page_id ) : home_url( '/' );

				$barcelona_facebook_admins = get_option( 'facebook_admins' );
				if ( ! empty( $barcelona_facebook_admins ) ) {
					$barcelona_og_tags['fb:admins'] = $barcelona_facebook_admins;
				}


			} else if ( is_author() ) {

				$barcelona_author = get_queried_object();

				$barcelona_og_tags['og:type'] = 'profile';
				$barcelona_og_tags['og:title'] = $barcelona_author->display_name;
				$barcelona_og_tags['og:description'] = $barcelona_author->description;
				$barcelona_og_tags['og:url'] = ( ! empty( $barcelona_author->user_url ) ) ? esc_url( $barcelona_author->user_url ) : esc_url( get_author_posts_url( $barcelona_author->ID ) );

				$barcelona_og_tags['profile:first_name'] = get_the_author_meta( 'first_name', $barcelona_author->ID );
				$barcelona_og_tags['profile:last_name']  = get_the_author_meta( 'last_name', $barcelona_author->ID );

			} else if ( is_singular() ) {

				global $post;

				$barcelona_og_tags['og:type'] = 'article';
				$barcelona_og_tags['og:title'] = ( ! empty( $post->post_title ) ) ? wp_kses( apply_filters( 'the_title', $post->post_title, $post->ID ), array() ) : ' ';
				$barcelona_og_tags['og:url'] = esc_url( get_the_permalink( $post->ID ) );

				if ( ! post_password_required() ) {

					if ( ! empty( $post->post_excerpt ) ) {
						$barcelona_og_tags['og:description'] = preg_replace( '@https?://[\S]+@', '', strip_shortcodes( wp_kses( $post->post_excerpt, array() ) ) );
					} else {
						$exploded_content_on_more_tag = explode( '<!--more-->', $post->post_content );
						$barcelona_og_tags['og:description'] = wp_trim_words( preg_replace( '@https?://[\S]+@', '', strip_shortcodes( wp_kses( $exploded_content_on_more_tag[0], array() ) ) ) );
					}

				}

				if ( empty( $barcelona_og_tags['og:description'] ) ) {
					$barcelona_og_tags['og:description'] = esc_html__( 'Visit the post for more.', 'barcelona' );
				} else {
					$barcelona_og_tags['og:description'] = wp_kses( trim( convert_chars( wptexturize( $barcelona_og_tags['og:description'] ) ) ), array() );
				}

				$barcelona_og_tags['article:published_time'] = date( 'c', strtotime( $post->post_date_gmt ) );
				$barcelona_og_tags['article:modified_time'] = date( 'c', strtotime( $post->post_modified_gmt ) );

			}

			if ( ! empty( $barcelona_og_tags ) ) {

				$barcelona_og_tags['og:site_name'] = get_bloginfo( 'name' );

				if ( empty( $barcelona_og_tags['og:title'] ) ) {
					$barcelona_og_tags['og:title'] = esc_html__( '(no title)', 'barcelona' );
				}

				// Shorten the description if it's too long
				if ( isset( $barcelona_og_tags['og:description'] ) ) {
					$barcelona_og_tags['og:description'] = strlen( $barcelona_og_tags['og:description'] ) > $barcelona_desc_length ? mb_substr( $barcelona_og_tags['og:description'], 0, $barcelona_desc_length ) . '…' : $barcelona_og_tags['og:description'];
				}

				// Get image info and build tags
				if ( ! post_password_required() ) {

					$barcelona_thumbnail_url = barcelona_get_thumbnail_url( 'barcelona-lg' );

					if ( is_array( $barcelona_thumbnail_url ) ) {
						$barcelona_og_tags['og:image'] = $barcelona_thumbnail_url[0];
					}

					if ( isset( $barcelona_thumbnail_url[1] ) ) {
						$barcelona_og_tags['og:image:width'] = $barcelona_thumbnail_url[1];
					}

					if ( isset( $barcelona_thumbnail_url[2] ) ) {
						$barcelona_og_tags['og:image:height'] = $barcelona_thumbnail_url[2];
					}

				}

				$barcelona_og_tags['og:locale'] = barcelona_get_locale();

			}

		endif;

		if ( ! empty( $barcelona_options['facebook_app_id'] ) ) {
			$barcelona_og_tags['fb:app_id'] = esc_attr( $barcelona_options['facebook_app_id'] );
		}

		foreach ( $barcelona_og_tags as $barcelona_k => $barcelona_v ) {
			echo "\n" .'<meta property="'. esc_attr( $barcelona_k ) .'" content="'. esc_attr( $barcelona_v ) .'" />';
		}

	}

	// Add header custom code
	if ( ! empty( $barcelona_options['header_custom_code'] ) ) {
		// We trust the author here. The author can add custom html to header.
		echo $barcelona_options['header_custom_code'] ."\n";
	}

	// Add body & heading font styles
	echo wp_kses( $barcelona_font[1], array( 'style' => array( 'type' => array()) ) ) ."\n";

	if ( ! empty( $barcelona_background ) ) {
		$barcelona_options['css_custom_code'] .= "\n". $barcelona_background;
	}

	if ( ! empty( $barcelona_options['nosidebar_content_width'] ) ) {
		$barcelona_options['css_custom_code'] .= "\n
		 @media only screen and (min-width: 992px) { .sidebar-none .post-content, .sidebar-none .post-footer { width: ". esc_html( $barcelona_options['nosidebar_content_width'] ) ."px !important; } }";
	}

	if ( ! empty( $barcelona_options['selection_color'] ) ) {
		$barcelona_options['css_custom_code'] .= "\n::-moz-selection { background-color: ". esc_html( $barcelona_options['selection_color'] ) ."; }\n::selection { background-color: ". esc_html( $barcelona_options['selection_color'] ) ."; }";
	}


	if ( ! empty( $barcelona_options['top_nav_background_color'] ) ) { // back color
		$barcelona_options['css_custom_code'] .= "\n.navbar-nav, .navbar-nav > li > .sub-menu, .navbar-wrapper nav.navbar-stuck > .navbar-inner { background-color: ". esc_html( $barcelona_options['top_nav_background_color'] ) ." !important; }\n
		.navbar-nav, .navbar-nav > li > .sub-menu { border: 1px solid ". esc_html( $barcelona_options['top_nav_background_color'] ) ." !important; }";
	}
    if ( ! empty( $barcelona_options['top_nav_background_hover_color'] ) ) { // item hover
        $barcelona_options['css_custom_code'] .= "\n.nav > li:hover > a, .navbar-nav > li > a:hover, .navbar-nav > li > button:hover, .sub-menu > li > a:hover { background-color: ". esc_html( $barcelona_options['top_nav_background_hover_color'] ) ." !important; }";
    }
    if ( ! empty( $barcelona_options['top_nav_link_color'] ) ) { // link text color
        $barcelona_options['css_custom_code'] .= "\n.navbar-nav > li > a, .sub-menu > li > a { color: ". esc_html( $barcelona_options['top_nav_link_color'] ) ." !important; }";
    }
	if ( ! empty( $barcelona_options['top_nav_active_item_background_color'] ) ) { // active item back color
		$barcelona_options['css_custom_code'] .= "\n.navbar-nav > .current-menu-item > a { background-color: ". esc_html( $barcelona_options['top_nav_active_item_background_color'] ) ." !important; }";
	}
    if ( ! empty( $barcelona_options['top_nav_active_item_link_color'] ) ) { // active item link text color
        $barcelona_options['css_custom_code'] .= "\n.navbar-nav .current-menu-item > a { color: ". esc_html( $barcelona_options['top_nav_active_item_link_color'] ) ." !important; }";
    }


	if ( ! empty( $barcelona_options['megamenu_background_color'] ) ) {
		$barcelona_options['css_custom_code'] .= "\n.mega-menu { background-color: ". esc_html( $barcelona_options['megamenu_background_color'] ) ." !important; }";
	}
	if ( ! empty( $barcelona_options['megamenu_link_color'] ) ) {
		$barcelona_options['css_custom_code'] .= "\n.navbar-nav .mega-menu a, .navbar-nav .mega-menu div { color: ". esc_html( $barcelona_options['megamenu_link_color'] ) ." !important; }";
	}
	if ( ! empty( $barcelona_options['megamenu_text_color'] ) ) {
		$barcelona_options['css_custom_code'] .= "\n.navbar-nav .mega-menu .tag-list .title { color: ". esc_html( $barcelona_options['megamenu_text_color'] ) ." !important; }";
	}


	if ( ! empty( $barcelona_options['footer_background_color'] ) ) {
		$barcelona_options['css_custom_code'] .= "\n.footer .barcelona-widget-about-me .about-me, .footer, .footer .container, .footer-widget .widget-title .title, .footer-sidebars .sidebar-widget .widget-title .title { background-color: ". esc_html( $barcelona_options['footer_background_color'] ) ." !important; }";
	}



    if ( ! empty( $barcelona_options['footer_link_color'] ) ) {
        $barcelona_options['css_custom_code'] .= "\nfooter a { color: ". esc_html( $barcelona_options['footer_link_color'] ) ." !important; }";
    }
	if ( ! empty( $barcelona_options['footer_text_color'] ) ) {
		$barcelona_options['css_custom_code'] .= "\nfooter p, footer h1, footer h2, footer h3, footer h4, footer h5, footer h6, footer .barcelona-widget-posts .post-meta > li { color: ". esc_html( $barcelona_options['footer_text_color'] ) ." !important; }";
	}


	if ( ! empty( $barcelona_options['general_link_color'] ) ) {
		$barcelona_options['css_custom_code'] .= "\n#page-wrapper a { color: ". esc_html( $barcelona_options['general_link_color'] ) ."; }";
	}


	// Add css custom code
	if ( ! empty( $barcelona_options['css_custom_code'] ) ) {
		// We trust the author here. The author can add custom css code to header.
		echo "<style type=\"text/css\">\n". $barcelona_options['css_custom_code'] ."\n</style>\n";
	}

}
add_action( 'wp_head', 'barcelona_header_custom_code' );

/*
 * Add custom codes for footer
 */
function barcelona_footer_custom_code() {

	$barcelona_code = barcelona_get_option( 'footer_custom_code' );
	$barcelona_background = barcelona_get_background( true );

	if ( ! empty( $barcelona_background ) ) {

		if ( empty( $barcelona_code ) ) {
			$barcelona_code = '';
		}

		$barcelona_code .= "\n<script>jQuery(document).ready(function($){ $.backstretch('". esc_url( $barcelona_background ) ."'); });</script>";

	}

	// Add footer custom code
	if ( ! empty( $barcelona_code ) ) {
		// We trust the author here. The author can add custom html to footer.
		echo $barcelona_code ."\n";
	}

}
add_action( 'wp_footer', 'barcelona_footer_custom_code', 99999 );

/*
 * OptionTree Admin Style
 */
function barcelona_ot_admin_styles_after() {

	wp_register_style( 'google-font-montserrat', barcelona_get_protocol() .'//fonts.googleapis.com/css?family=Montserrat:400,700' );
	wp_enqueue_style( 'google-font-montserrat' );

	wp_register_style( 'barcelona-ot-admin', BARCELONA_THEME_PATH .'includes/admin/css/barcelona-ot-admin.css', array(), BARCELONA_THEME_VERSION );
	wp_enqueue_style( 'barcelona-ot-admin' );

	if ( is_rtl() ) {
		wp_register_style( 'barcelona-ot-admin-rtl', BARCELONA_THEME_PATH .'includes/admin/css/barcelona-ot-admin-rtl.css', array(), BARCELONA_THEME_VERSION );
		wp_enqueue_style( 'barcelona-ot-admin-rtl' );
	}

}
add_action( 'ot_admin_styles_after', 'barcelona_ot_admin_styles_after' );

/*
 * Enqueue Admin Scripts & Styles
 */
function barcelona_admin_enqueue_scripts( $hook ) {

	$barcelona_hook_arr = array(
		'widgets.php',
		'edit-tags.php',
		'term.php',
		'post-new.php',
		'post.php',
		'appearance_page_ot-theme-options'
	);

	if ( in_array( $hook, $barcelona_hook_arr ) ) {

		wp_enqueue_style( 'font-awesome', BARCELONA_THEME_PATH . 'assets/css/font-awesome.min.css', array(), '4.4.0' );

		wp_enqueue_script( 'barcelona-admin', BARCELONA_THEME_PATH .'includes/admin/js/barcelona-admin.js', array( 'jquery', 'wp-color-picker' ), BARCELONA_THEME_VERSION, true );
		wp_enqueue_style( 'barcelona-admin', BARCELONA_THEME_PATH .'includes/admin/css/barcelona-admin.css', array( 'wp-color-picker' ), BARCELONA_THEME_VERSION, 'all' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'barcelona-admin-rtl', BARCELONA_THEME_PATH .'includes/admin/css/barcelona-admin-rtl.css', array( 'wp-color-picker' ), time(), 'all' );
		}

		if ( $hook == 'edit-tags.php' || $hook == 'widgets.php' ) {
			wp_enqueue_media();
		}

	}

}
add_action( 'admin_enqueue_scripts', 'barcelona_admin_enqueue_scripts', 99 );

/*
 * Add IE conditions for spesific tags
 */
function barcelona_ie_conditional_scripts( $tag, $handle ) {

	if ( $handle == 'ie-html5' ) {
		$tag = "<!--[if lt IE 9]>\n" . $tag . "<![endif]-->\n";
	}

	return $tag;

}
add_filter( 'script_loader_tag', 'barcelona_ie_conditional_scripts', 10, 2 );

/*
 * Customizer live preview script
 */
function barcelona_customizer_live_preview() {

	wp_enqueue_script( 'barcelona-customize', BARCELONA_THEME_PATH .'includes/admin/js/barcelona-customize.js', array( 'jquery','customize-preview' ), BARCELONA_THEME_VERSION, true );

}
add_action( 'customize_preview_init', 'barcelona_customizer_live_preview' );