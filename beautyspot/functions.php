<?php

if ( ! isset( $content_width ) ) {
    $content_width = 750;
}

/* -----------------------------------------------------------------------------

    LOAD TEXTDOMAIN

----------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_load_textdomain' ) ) {
		function lsvr_load_textdomain(){
			load_theme_textdomain( 'beautyspot', get_template_directory() . '/languages' );
		}
	}
	add_action( 'after_setup_theme', 'lsvr_load_textdomain' );


/* -----------------------------------------------------------------------------

    INCLUDES

----------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------
        Redux Framework Settings
    ------------------------------------------------------------------------- */

	// CONFIG
	if ( ! isset( $theme_options ) && file_exists( dirname( __FILE__ ) . '/includes/redux/redux-config.php' ) ) {
		require_once( dirname( __FILE__ ) . '/includes/redux/redux-config.php' );
	}

    /* -------------------------------------------------------------------------
        TGM Plugin Activation
    ------------------------------------------------------------------------- */

    require_once( 'includes/tgm-plugin-settings.php' );

    /* -------------------------------------------------------------------------
        Breadcrumbs
    ------------------------------------------------------------------------- */

    require_once( 'includes/breadcrumbs.php' );

    /* -------------------------------------------------------------------------
        Comment Walker Class
    ------------------------------------------------------------------------- */

    require_once( 'includes/lsvr-walker-comment.class.php' );

    /* -------------------------------------------------------------------------
        Main Menu Walker Class
    ------------------------------------------------------------------------- */

    require_once( 'includes/lsvr-walker-main-nav.class.php' );

    /* -------------------------------------------------------------------------
        Metaboxes
    ------------------------------------------------------------------------- */

    require_once( 'includes/metaboxes.php' );

    /* -------------------------------------------------------------------------
        Pagination
    ------------------------------------------------------------------------- */

    require_once( 'includes/pagination.php' );

    /* -------------------------------------------------------------------------
        Visual Composer Settings
    ------------------------------------------------------------------------- */

    require_once( 'includes/visual-composer-settings.php' );


/* -----------------------------------------------------------------------------

    REGISTER

----------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------
        Register nav menus
    ------------------------------------------------------------------------- */

    register_nav_menu( 'header', __( 'Header Menu', 'beautyspot' ) );
    register_nav_menu( 'footer', __( 'Footer Menu', 'beautyspot' ) );

    /* -------------------------------------------------------------------------
        Register sidebars
    ------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_register_sidebars' ) ) {
		function lsvr_register_sidebars() {

			// PRIMARY SIDEBAR
			register_sidebar( array(
				'name' => __( 'Default Sidebar', 'beautyspot' ),
				'id' => 'primary-sidebar',
				'description'   => __( 'Default sidebar located on a side of page template. You can change the side of sidebar separately for each page.', 'beautyspot' ),
				'class'         => '',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h3 class="widget-title m-secondary-font">',
				'after_title'   => '</h3>'
			));

			// BOTTOM SIDEBAR
			register_sidebar( array(
				'name' => __( 'Bottom Panel', 'beautyspot' ),
				'id' => 'bottom-sidebar',
				'description'   => __( 'A widget area located above the footer of the site.', 'beautyspot' ),
				'class'         => '',
				'before_widget' => '<div id="%1$s" class="widget col-md-6 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title m-secondary-font">',
				'after_title'   => '</h3>'
			));

			// CUSTOM SIDEBARS
			for ( $i = 1; $i <= 10; $i++ ) {
				if ( lsvr_get_field( 'enable_sidebar_' . $i, false, true ) ) {
					register_sidebar( array(
						'name'          => lsvr_get_field( 'sidebar_' . $i . '_name', 'Custom Sidebar ' . $i ),
						'id'            => 'custom-sidebar-' . $i,
						'class'         => '',
						'before_widget' => '<li id="%1$s" class="widget %2$s">',
						'after_widget'  => '</li>',
						'before_title'  => '<h3 class="widget-title m-secondary-font">',
						'after_title'   => '</h3>'
					));
				}
			}

		}
	}
    add_action( 'widgets_init', 'lsvr_register_sidebars' );


/* -----------------------------------------------------------------------------

    ADD THEME SUPPORT

----------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------
        Post formats
    ------------------------------------------------------------------------- */

    add_theme_support( 'post-formats', array( 'image', 'gallery', 'audio', 'video', 'link', 'quote' ) );

    /* -------------------------------------------------------------------------
        Featured images
    ------------------------------------------------------------------------- */

    add_theme_support( 'post-thumbnails' );

    update_option( 'thumbnail_size_w', 300 );
    update_option( 'thumbnail_size_h', 300 );
    update_option( 'medium_size_w', 800 );
    update_option( 'medium_size_h', 0 );
    update_option( 'large_size_w', 1200 );
    update_option( 'large_size_h', 0 );

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'small', 430, 700 );
        add_image_size( 'small-cropped', 430, 330, true );
        add_image_size( 'medium-cropped', 800, 600, true );
        add_image_size( 'large-cropped', 1200, 900, true );
        add_image_size( 'hd', 2000, 2000 );
        add_image_size( 'hd-cropped', 2000, 1500, true );
    }

    /* -------------------------------------------------------------------------
        Automatic feed links
    ------------------------------------------------------------------------- */

    add_theme_support( 'automatic-feed-links' );

    /* -------------------------------------------------------------------------
        WooCommerce
    ------------------------------------------------------------------------- */

    add_theme_support( 'woocommerce' );

    /* -------------------------------------------------------------------------
        Title Tag
    ------------------------------------------------------------------------- */

	add_theme_support( 'title-tag' );


/* -----------------------------------------------------------------------------

    LOAD STYLES AND SCRIPTS

----------------------------------------------------------------------------- */

    $theme = wp_get_theme();
    $theme_version = $theme->Version;

    /* -------------------------------------------------------------------------
        CSS
    ------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_load_theme_styles' ) ) {
		function lsvr_load_theme_styles(){

			global $theme_version;

			// Default style.css with theme's main styles
			wp_register_style( 'main-style', get_bloginfo( 'stylesheet_url' ), array(), $theme_version );
			wp_enqueue_style( 'main-style' );

			// Typography
			if ( lsvr_get_field( 'enable_google_fonts', true, true ) ) {
				if ( is_array( lsvr_get_field( 'primary_font' ) ) ) {
					$primary_font = lsvr_get_field( 'primary_font', 'Source Sans Pro' );
					$primary_font_family = array_key_exists( 'font-family', $primary_font ) ? $primary_font['font-family'] : 'Open Sans';
					$primary_font_size = array_key_exists( 'font-size', $primary_font ) ? $primary_font['font-size'] : '16px';
					$primary_font_weight = array_key_exists( 'font-weight', $primary_font ) ? $primary_font['font-weight'] : '300';
					wp_add_inline_style( 'main-style', 'body, input, textarea, select, h2 em { font-family: \'' . $primary_font_family . '\', Arial, sans-serif; font-size: ' . $primary_font_size . '; font-weight: ' . $primary_font_weight . '; } .wpcf7-list-item-label { font-family: \'' . $primary_font_family . '\', Arial, sans-serif; }' );
				}
				if ( is_array( lsvr_get_field( 'secondary_font' ) ) ) {
					$secondary_font = lsvr_get_field( 'secondary_font' );
					$secondary_font_family = array_key_exists( 'font-family', $secondary_font ) ? $secondary_font['font-family'] : 'Montserrat';
					$secondary_font_elements = '.m-secondary-font, .heading-2, .header-menu > ul > li > span, .various-content h1, .various-content h2, .various-content h3, .various-content h4, .various-content h5, ';
					$secondary_font_elements .= '.c-button, .default-form label, .wpcf7-form label, table th, .header-cart a, .header-search .search-toggle,';
					$secondary_font_elements .= '.woocommerce .product .product_title, .woocommerce form label, .checkout h3 .checkout-input label';
					wp_add_inline_style( 'main-style', $secondary_font_elements . ' { font-family: \'' . $secondary_font_family . '\', Arial, sans-serif; }' );
				}
			}

			// Custom Color Skin
			if ( lsvr_get_field( 'enable_custom_theme_skin', false, true ) && lsvr_get_field( 'custom_theme_skin_name' ) !== '' ){
				$custom_theme_skin_name = lsvr_get_field( 'custom_theme_skin_name' );
				if ( strlen( $custom_theme_skin_name ) > 4 && substr( $custom_theme_skin_name, -4 ) === '.css' ) {
					$custom_theme_skin_name = substr( $custom_theme_skin_name, 0, -4 );
				}
				$theme_skin_file = '/library/css/skin/' . $custom_theme_skin_name . '.css';
				wp_register_style( 'theme-skin', get_stylesheet_directory_uri() . $theme_skin_file, array(), $theme_version );
			}
			// Predefined Color Skin
			else {
				$theme_skin_file = '/library/css/skin/' . lsvr_get_field( 'theme_skin', 'default' ) . '.css';
				wp_register_style( 'theme-skin', get_template_directory_uri() . $theme_skin_file, array(), $theme_version );
			}
			wp_enqueue_style( 'theme-skin' );

			// IE8 (and lower) specific styles
			$oldie_styles = create_function( '', 'echo \'<!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/library/css/oldie.css"><![endif]-->\';' );
			add_action( 'wp_head', $oldie_styles );

			// CUSTOM CSS
			if ( lsvr_get_field( 'custom_css_code' ) !== '' ){
				wp_add_inline_style( 'theme-skin', lsvr_get_field( 'custom_css_code' ) );
			}

		}
	}
    add_action( 'wp_enqueue_scripts', 'lsvr_load_theme_styles' );

    /* -------------------------------------------------------------------------
        JS
    ------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_load_theme_scripts' ) ) {
		function lsvr_load_theme_scripts() {

			global $theme_version;

			// Modernizr
			// http://modernizr.com/
			wp_register_script( 'modernizr', get_template_directory_uri() . '/library/js/modernizr.custom.min.js', array('jquery'), $theme_version, false );
			wp_enqueue_script( 'modernizr' );

			// Various Third Pary Scripts
			// http://jqueryui.com/
			wp_register_script( 'third-party', get_template_directory_uri() . '/library/js/third-party.js', array('jquery'), $theme_version, true );
			wp_enqueue_script( 'third-party' );

			// HTML5 compatibility script for IE8 and lower
			$html5shim = create_function( '', 'echo \'<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->\';' );
			add_action( 'wp_head', $html5shim );

			// Support for Media Queries in IE8 and lower
			$respondjs = create_function( '', 'echo \'<!--[if lt IE 9]><script src="' . get_template_directory_uri() . '/library/js/respond.min.js"></script><![endif]-->\';' );
			add_action( 'wp_head', $respondjs );

			// Datepicker Translation
			$datepicker_strings_js = create_function( '', 'echo "<script type=\"text/javascript\">
			var lsvr_datepicker_strings = { closeText: \'' . __( 'Done', 'beautyspot' ) . '\',
			prevText: \''. __( 'Prev', 'beautyspot' ) . '\', nextText: \'' . __( 'Next', 'beautyspot' ) . '\', currentText: \'' . __( 'Today', 'beautyspot' ) . '\',
			monthNames: [\'' . __( 'January', 'beautyspot' ) . '\',\'' . __( 'February', 'beautyspot' ) . '\',\'' . __( 'March', 'beautyspot' ) . '\',
			\'' . __( 'April', 'beautyspot' ) . '\',\'' . __( 'May', 'beautyspot' ) . '\',\'' . __( 'June', 'beautyspot' ) . '\',
			\'' . __( 'July', 'beautyspot' ) . '\',\'' . __( 'August', 'beautyspot' ) . '\',\'' . __( 'September', 'beautyspot' ) . '\',
			\'' . __( 'October', 'beautyspot' ) . '\',\'' . __( 'November', 'beautyspot' ) . '\',\'' . __( 'December', 'beautyspot' ) . '\'],
			monthNamesShort: [\'' . __( 'Jan', 'beautyspot' ) . '\', \'' . __( 'Feb', 'beautyspot' ) . '\', \'' . __( 'Mar', 'beautyspot' ) . '\',
			\'' . __( 'Apr', 'beautyspot' ) . '\', \'' . __( 'May', 'beautyspot' ) . '\', \'' . __( 'Jun', 'beautyspot' ) . '\',
			\'' . __( 'Jul', 'beautyspot' ) . '\', \'' . __( 'Aug', 'beautyspot' ) . '\', \'' . __( 'Sep', 'beautyspot' ) . '\',
			\'' . __( 'Oct', 'beautyspot' ) . '\', \'' . __( 'Nov', 'beautyspot' ) . '\', \'' . __( 'Dec', 'beautyspot' ) . '\'],
			dayNames: [\'' . __( 'Sunday', 'beautyspot' ) . '\', \'' . __( 'Monday', 'beautyspot' ) . '\', \'' . __( 'Tuesday', 'beautyspot' ) . '\',
			\'' . __( 'Wednesday', 'beautyspot' ) . '\', \'' . __( 'Thursday', 'beautyspot' ) . '\', \'' . __( 'Friday', 'beautyspot' ) . '\',
			\'' . __( 'Saturday', 'beautyspot' ) . '\'],
			dayNamesShort: [\'' . __( 'Sun', 'beautyspot' ) . '\', \'' . __( 'Mon', 'beautyspot' ) . '\', \'' . __( 'Tue', 'beautyspot' ) . '\',
			\'' . __( 'Wed', 'beautyspot' ) . '\', \'' . __( 'Thu', 'beautyspot' ) . '\', \'' . __( 'Fri', 'beautyspot' ) . '\', \'' . __( 'Sat', 'beautyspot' ) . '\'],
			dayNamesMin: [\'' . __( 'Su', 'beautyspot' ) . '\',\'' . __( 'Mo', 'beautyspot' ) . '\',\'' . __( 'Tu', 'beautyspot' ) . '\',\'' . __( 'We', 'beautyspot' ) . '\',
			\'' . __( 'Th', 'beautyspot' ) .'\',\'' . __( 'Fr', 'beautyspot' ) . '\',\'' . __( 'Sa', 'beautyspot' ) . '\'],
			weekHeader: \'' . __( 'Wk', 'beautyspot' ) . '\' };</script>";' );
			add_action( 'wp_footer', $datepicker_strings_js );

			// Theme's scripts library
			wp_register_script( 'scripts-library', get_template_directory_uri() . '/library/js/library.js', array('jquery'), $theme_version, true );
			wp_enqueue_script( 'scripts-library' );

			// Theme's main scripts
			wp_register_script( 'main-scripts', get_template_directory_uri() . '/library/js/scripts.js', array('jquery'), $theme_version, true );
			wp_enqueue_script( 'main-scripts' );

			// Twitter Feed Ajax
			if ( lsvr_get_field( 'enable_twitter_feed', false, true ) ) {
				wp_localize_script( 'main-scripts', 'lsvrMainScripts', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
			}

			// Comment reply
			if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }

			// Add JS vars
			if ( lsvr_get_field( 'gmap_api_key', '' ) !== '' ) {
				wp_add_inline_script( 'main-scripts', 'var lsvrGmapApiKey = "' . lsvr_get_field( 'gmap_api_key' ) . '";' );
			}

			// Custom JS
			if ( lsvr_get_field( 'custom_js_code' ) !== '' ) {
				$custom_js_code = create_function( '', 'echo "<script type=\"text/javascript\">' . lsvr_get_field( 'custom_js_code' ) . '</script>";' );
				add_action( 'wp_footer', $custom_js_code );
			}

			// Any code
			if ( lsvr_get_field( 'custom_any_code' ) !== '' ) {
				function lsvr_custom_footer_code (){
					echo lsvr_get_field( 'custom_any_code' );
				}
				add_action( 'wp_footer', 'lsvr_custom_footer_code' );
			}

		}
	}
    add_action( 'wp_enqueue_scripts', 'lsvr_load_theme_scripts' );


/* -----------------------------------------------------------------------------

    TWITTER AJAX FEED

----------------------------------------------------------------------------- */

global $theme_options;
if ( isset( $theme_options ) && is_array( $theme_options ) && count( $theme_options ) > 0 ) {
	if ( array_key_exists( 'enable_twitter_feed', $theme_options ) && $theme_options[ 'enable_twitter_feed' ] ) {
		if ( ! function_exists( 'lsvr_add_twitter_feed_ajax' ) ) {
			function lsvr_add_twitter_feed_ajax() {
				if ( lsvr_get_field( 'enable_twitter_feed', false, true ) ) {
					add_action( 'wp_ajax_lsvr_twitter_feed', 'lsvr_twitter_feed' );
					add_action( 'wp_ajax_nopriv_lsvr_twitter_feed', 'lsvr_twitter_feed' );
					function lsvr_twitter_feed() {
						include( 'includes/twitter-feed.php' );
						die();
					}
				}
			}
		}
	    add_action( 'init', 'lsvr_add_twitter_feed_ajax' );
	}
}


/* -----------------------------------------------------------------------------

    VARIOUS FUNCTIONS AND FIXES

----------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------
        GET FIELD
        For use with Redux Framework
    ------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_get_field' ) ) {
		function lsvr_get_field( $field_id, $default = '', $force_bool = false ){

			global $theme_options;
			if ( isset( $theme_options ) && is_array( $theme_options ) && count( $theme_options ) > 0 ) {

				if ( array_key_exists( $field_id, $theme_options ) ) {
					$return = $theme_options[ $field_id ];
				}
				else if ( isset( $default ) ) {
					$return = $default;
				}
				else {
					$return = '';
				}

				// FORCE CAST AS BOOL
				if ( $force_bool ) {
					return (bool) $return;
				}
				else {
					return $return;
				}

			}
			else {
				if ( isset( $default ) ) {
					return $default;
				}
				else {
					return false;
				}
			}

		}
	}

    /* -------------------------------------------------------------------------
        GET IMAGE FIELD
        For use with Redux Framework
    ------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_get_image_field' ) ) {
		function lsvr_get_image_field( $field_id, $key = 'url' ){

			$field = lsvr_get_field( $field_id );
			if ( is_array( $field ) && array_key_exists( $key, $field ) ) {
				return $field[$key];
			}
			else {
				return false;
			}

		}
	}

    /* -------------------------------------------------------------------------
        GET SOCIAL LINKS
    ------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_get_social_links' ) ) {
		function lsvr_get_social_links() {

			$return = lsvr_get_field( 'social_links' );
			if ( is_array( $return ) ) {

				$return = array_filter( $return );
				if ( is_array( $return ) && count ( $return ) > 0 ) {
					return $return;
				}
				else {
					return false;
				}

			}
			else {
				return false;
			}

		}
	}

    /* -------------------------------------------------------------------------
        CONTACT FORM 7 DEREGISTER CSS
    ------------------------------------------------------------------------- */

	add_action( 'wp_print_styles', 'lsvr_cf7_deregister_styles', 100 );
	function lsvr_cf7_deregister_styles() {
		wp_deregister_style( 'contact-form-7' );
	}

    /* -------------------------------------------------------------------------
        ENABLE SHORTCODES FOT TEXT WIDGET
    ------------------------------------------------------------------------- */

    add_filter( 'widget_text', 'do_shortcode' );

    /* -------------------------------------------------------------------------
        GET IMAGE DATA
    ------------------------------------------------------------------------- */

    if ( ! function_exists( 'lsvr_get_image_data' ) ) {
        function lsvr_get_image_data( $image_id ){

            $image_data = array();
            $image_sizes = array( 'thumbnail', 'small', 'small-cropped', 'medium', 'medium-cropped', 'large', 'large-cropped', 'hd', 'hd-cropped', 'full' );

            foreach ( $image_sizes as $size ) {
                $temp = wp_get_attachment_image_src( $image_id, $size );
                $image_data[$size] = $temp[0];
            }

			// GET ALT
			$image_data['alt'] = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

			// GET TITLE
			$image_meta = wp_get_attachment_metadata( $image_id );
			if ( is_array( $image_meta ) && array_key_exists( 'title', $image_meta ) ){
				$image_data['title'] = $image_meta['title'];
			}
			else {
				$image_data['title'] = '';
			}

			// GET CAPTION
			$image_post_data = get_post( $image_id );
			if ( $image_post_data && is_object( $image_post_data ) ) {
				$image_data['caption'] = $image_post_data->post_excerpt;
			}
			else {
				$image_data['caption'] = '';
			}

            if ( count( $image_data ) > 0 ) {
                return $image_data;
            }
            else {
                return false;
            }

        }
    }

    /* -------------------------------------------------------------------------
        Get Taxonomy Term Parents
    ------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_get_term_parents' ) ) {
		function lsvr_get_term_parents( $term_id, $taxonomy, $max_limit = 5 ) {

			$term = get_term( $term_id, $taxonomy );
			if ( $term->parent !== 0 ) {

				$parents_arr = array();
				$counter = 0;
				$parent_id = $term->parent;

				while ( $parent_id !== 0 && $counter < $max_limit ) {
					array_unshift( $parents_arr, $parent_id );
					$parent = get_term( $parent_id, $taxonomy );
					$parent_id = $parent->parent;
					$counter++;
				}
				return $parents_arr;

			}
			else {
				return array();
			}

		}
	}

    /* -------------------------------------------------------------------------
        EXCERPT BY ID
    ------------------------------------------------------------------------- */

    /*
	* http://pippinsplugins.com/a-better-wordpress-excerpt-by-id-function/
    * Gets the excerpt of a specific post ID or object
    * @param - $post - object/int - the ID or object of the post to get the excerpt of
    * @param - $length - int - the length of the excerpt in words
    * @param - $tags - string - the allowed HTML tags. These will not be stripped out
    * @param - $extra - string - text to append to the end of the excerpt
    */

	if ( ! function_exists( 'lsvr_excerpt_by_id' ) ) {
		function lsvr_excerpt_by_id( $post, $length = 10, $tags = '<a><em><strong>', $extra = ' &hellip;' ) {

			if ( is_int( $post ) ) {
				// get the post object of the passed ID
				$post = get_post($post);
			} elseif ( ! is_object( $post ) ) {
				return false;
			}

			if ( has_excerpt( $post->ID ) && $length < 1 ) {

				$the_excerpt = $post->post_excerpt;
				return apply_filters('the_content', $the_excerpt);

			} else {
				$the_excerpt = $post->post_content;
			}

			$the_excerpt = strip_shortcodes( strip_tags( $the_excerpt ), $tags );
			$the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2+1 );
			$excerpt_waste = array_pop( $the_excerpt );
			$the_excerpt = implode( $the_excerpt );
			$the_excerpt .= $extra;

			return apply_filters( 'the_content', $the_excerpt );

		}
	}

    /* -------------------------------------------------------------------------
        WOOCOMMERCE SETTINGS
    ------------------------------------------------------------------------- */

	// HIDE DEFAULT TITLE
	add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
	function woo_hide_page_title() { return false; }

	// SET IMAGE DIMENSIONS UPON ACTIVATION
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'lsvr_woocommerce_image_dimensions', 1 );
		function lsvr_woocommerce_image_dimensions() {
			$catalog = array(
				'width' 	=> '300',
				'height'	=> '300',
				'crop'		=> 1
			);
			$single = array(
				'width' 	=> '800',
				'height'	=> '800',
				'crop'		=> 0
			);
			$thumbnail = array(
				'width' 	=> '150',
				'height'	=> '150',
				'crop'		=> 1
		);
		update_option( 'shop_catalog_image_size', $catalog );
		update_option( 'shop_single_image_size', $single );
		update_option( 'shop_thumbnail_image_size', $thumbnail );
	}

	// CART HEADER AJAX
	add_filter( 'add_to_cart_fragments', 'lsvr_woocommerce_header_add_to_cart_fragment' );
	function lsvr_woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
		<span class="cart-count">(<?php echo sprintf( _n( '%d item', '%d items', $woocommerce->cart->cart_contents_count, 'beautyspot' ), $woocommerce->cart->cart_contents_count ); ?>)</span></a>
		<?php
		$fragments['span.cart-count'] = ob_get_clean();
		return $fragments;
	}

	// LOGIN FORM BEFORE / AFTER
	add_action( 'woocommerce_before_customer_login_form', 'lsvr_login_form_before' );
	function lsvr_login_form_before () {
		echo '<div class="default-form">';
	}
	add_action( 'woocommerce_after_customer_login_form', 'lsvr_login_form_after' );
	function lsvr_login_form_after () {
		echo '</div>';
	}

	// NUMBER OF PRODUCTS
    function lsvr_woo_set_number_of_products() {
        $products_per_page = lsvr_get_field( 'woo_index_products_per_page', 9 );
        add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_per_page . ';' ), 20 );
    }
    add_action( 'init', 'lsvr_woo_set_number_of_products' );

    /* -------------------------------------------------------------------------
        Enable Shortcodes in Excerpt
    ------------------------------------------------------------------------- */

	add_filter( 'the_excerpt', 'do_shortcode' );

    /* -------------------------------------------------------------------------
        Enable Style Switcher
    ------------------------------------------------------------------------- */

	//define( 'enable_style_switcher', true );

    /* -------------------------------------------------------------------------
        Export XML Fix
    ------------------------------------------------------------------------- */

	if ( ! function_exists( 'lsvr_dummy_wp_get_attachment_url' ) ) {
		function lsvr_dummy_wp_get_attachment_url( $url, $post_id ){
			return 'http://s2.postimg.org/n2r0cqtyh/dummy.jpg';
		}
	}
    //add_filter( 'wp_get_attachment_url' , 'lsvr_dummy_wp_get_attachment_url' , 10 , 2 );


?>