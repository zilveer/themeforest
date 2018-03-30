<?php
/**
 * Pile functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Pile
 * @since   Pile 1.0
 */

if ( ! function_exists(' pile_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own pile_theme_setup() function to override in a child theme.
	 *
	 * @since Pile 1.0
	 */
	function pile_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Pile, use a find and replace
		 * to change 'pile' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'pile', get_template_directory() . '/languages' );

		//add theme support for RSS feed links automatically generated in the head section
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		//tell galleries and captions to behave nicely and use HTML5 markup
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );

		// add theme support for post formats
		// child themes note: use the after_setup_theme hook with a callback
		$formats = array( 'quote', );
		add_theme_support( 'post-formats', $formats );

		add_theme_support( 'menus' );
		$menus = array(
			'main_menu'   => esc_html__( 'Header Menu', 'pile' ),
			'social_menu' => esc_html__( 'Social Menu', 'pile' ),
			'footer_menu' => esc_html__( 'Footer Menu', 'pile' ),
		);
		foreach ( $menus as $key => $value ) {
			register_nav_menu( $key, $value );
		}

		add_theme_support( 'post-thumbnails' );

		$sizes = array(

			/**
			 * MAXIMUM SIZE
			 * Maximum Full Image Size
			 * - Sliders
			 * - Lightbox
			 */
			'full-size' => array(
				'width' => 2048
			),
			/**
			 * LARGE SIZE
			 * - Single post without sidebar
			 */
			'large-size'     => array(
				'width' => 1200
			),
			/**
			 * MEDIUM SIZE
			 * - Tablet Sliders
			 * - Archive Featured Image
			 * - Single Featured Image
			 */
			'medium-size'    => array(
				'width' => 700,
			),
			/**
			 * SMALL SIZE
			 * - Masonry Grid
			 * - Mobile Sliders
			 */
			'small-size'     => array(
				'width' => 385,
			),

		);

		if ( ! empty( $sizes ) ) {
			foreach ( $sizes as $size_key => $values ) {

				$width = 0;
				if ( isset( $values['width'] ) ) {
					$width = $values['width'];
				}

				$height = 0;
				if ( isset( $values['height'] ) ) {
					$height = $values['height'];
				}

				$hard_crop = false;
				if ( isset( $values['hard_crop'] ) ) {
					$hard_crop = $values['hard_crop'];
				}

				add_image_size( $size_key, $width, $height, $hard_crop );

			}
		}

		add_editor_style( array( 'editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'pile_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pile_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pile_content_width', 1060, 0 );
}
add_action( 'after_setup_theme', 'pile_content_width', 0 );


if ( ! function_exists( 'pile_scripts_styles' ) ) :
	/**
	 * Enqueues scripts and styles.
	 *
	 * @since Pile 2.0
	 */
	function pile_scripts_styles() {
		$theme = wp_get_theme();

		$main_style_deps = array( 'wp-mediaelement' );

		//only enqueue the de default font if Customify is not present
		if ( ! class_exists( 'PixCustomifyPlugin' ) ) {
			wp_enqueue_style( 'pile-fonts-trueno', get_template_directory_uri() . '/assets/fonts/trueno/stylesheet.css' );
			$main_style_deps[] = 'pile-fonts-trueno';
		} else {
			// we will load the Trueno font only if it is selected in one of the Customify's fields
			$fonts = array( 'google_titles_font', 'google_descriptions_font', 'google_nav_font', 'google_body_font' );
			foreach ( $fonts as $font ) {
				$val = pile_option( $font );
				if ( ! empty( $val ) ) {

					if ( is_string( $val ) ) {
						$val = json_decode(  wp_unslash( PixCustomifyPlugin::decodeURIComponent($val) ), true );
					}

					if ( ! empty( $val ) && is_array( $val ) && in_array( 'Trueno', $val ) ) {
						wp_enqueue_style( 'pile-fonts-trueno', get_template_directory_uri() . '/assets/fonts/trueno/stylesheet.css' );
						break;
					}
				}
			}
		}

		if ( ! is_rtl() ) { // but why?
			wp_enqueue_style( 'pile-main-style', get_stylesheet_uri(), $main_style_deps, $theme->get( 'Version' ) );
		}

		// Scripts
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr.min.js', array( 'jquery' ), '3.3.1' );
		wp_enqueue_script( 'jquery-gsap', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/jquery.gsap.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'tween-max', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TweenMax.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'scroll-to-plugin', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/plugins/ScrollToPlugin.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'pile-rs', '//pxgcdn.com/js/rs/9.5.7/index.js', array( 'jquery' ) );
		wp_enqueue_script( 'pile-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( 'wp-mediaelement', 'masonry', 'jquery-gsap', 'scroll-to-plugin', 'tween-max', 'pile-rs' ), $theme->get( 'Version' ), true );

		wp_enqueue_script( 'addthis-api', '//s7.addthis.com/js/300/addthis_widget.js#async=1', array( 'jquery' ), null, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$google_maps_key = pile_option( 'google_maps_api_key' );

		if ( ! empty( $google_maps_key ) ) {
			$google_maps_key = '&key=' . $google_maps_key;
		} else {
			$google_maps_key = '';
		}

		wp_register_script( 'google-maps', '//maps.google.com/maps/api/js?language=en&callback=GMap.init' . $google_maps_key, array( 'jquery' ), null, true );

		//determine if we actually need to enqueue the GMaps script
		//i.e. we are on a page with the Contact page template and it has a GMaps URL inserted in the appropriate meta box
		global $is_gmap;

		$is_gmap = false;
		$gmap_url = get_post_meta( get_the_ID(), '_pile_gmap_url', true );
		if ( get_page_template_slug( get_the_ID() ) == 'page-templates/contact.php' && ! empty( $gmap_url ) ) {
			//set the global so everybody knows that we are in dire need of the Google Maps API
			$is_gmap = true;
			// enqueue only on this page
			wp_enqueue_script('google-maps');
		}

		wp_localize_script( 'pile-main-scripts', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
		// localize the theme_name, we are gonna need it
		wp_localize_script( 'pile-main-scripts', 'pile_ajax', array (
			'nonce'      => wp_create_nonce( 'pile_ajax' ),
		));
		wp_localize_script( 'pile-main-scripts', 'objectl10n', array(
			'tPrev'             => esc_html__( 'Previous (Left arrow key)', 'pile' ),
			'tNext'             => esc_html__( 'Next (Right arrow key)', 'pile' ),
			'tCounter'          => esc_html__( 'of', 'pile' ),
			'infscrLoadingText' => "",
			'infscrReachedEnd'  => "",
		) );

		// if the woocommerce user wants prettyPhoto, here is the only way it will work.
		// we load it on the first window.load so when the user goes to a product he must have these scripts already
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) && 'yes' === get_option( 'woocommerce_enable_lightbox' ) && file_exists( WP_PLUGIN_DIR . '/woocommerce/assets/css/prettyPhoto.css' ) ) {
			$woo_asssets_url = plugins_url( '/woocommerce/assets/', WP_PLUGIN_DIR . '/' );
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woo_asssets_url . 'css/prettyPhoto.css' );
			wp_enqueue_script( 'prettyPhoto-init', $woo_asssets_url . 'js/prettyPhoto/jquery.prettyPhoto.init' . $suffix . '.js', array( 'jquery','prettyPhoto' ) );
			wp_enqueue_script( 'prettyPhoto', $woo_asssets_url . 'js/prettyPhoto/jquery.prettyPhoto' . $suffix . '.js', array( 'jquery' ), '3.1.6', true );
		}
	}
endif; // pile_scripts_styles
add_action( 'wp_enqueue_scripts', 'pile_scripts_styles' );


// admin assets

/*
 * Enqueue some custom JS in the admin area for various small tasks
 */
function pile_add_admin_general_script( $hook ){
	$theme = wp_get_theme();
	wp_enqueue_script( 'pile_admin_general_script', get_template_directory_uri() . '/assets/js/admin/admin-general.js', array( 'jquery' ), $theme->get( 'Version' ) );
	wp_enqueue_style( 'pile-admin-general', get_template_directory_uri() . '/assets/css/admin-general.css', array(), $theme->get( 'Version' ) );
}
add_action( 'admin_enqueue_scripts','pile_add_admin_general_script' );

/*
* Enqueue the builder script in the admin area
*/
function pile_add_pix_builder_script( $hook ) {
	$theme = wp_get_theme();
	wp_enqueue_script( 'pile_pix_builder_custom', get_template_directory_uri() . '/assets/js/admin/pix_builder.js', array( 'jquery' ), $theme->get( 'Version' ) );

	$gridster_params = array(
		'widget_margins'          => array( 15, 15 ),
		'widget_base_dimensions'  => array( 160, 40 ),
		'min_cols'                => 6,
		'max_cols'                => 6,
		'resize'                  => array(
			'enabled'  => true,
			'axes'     => array( 'x' ),
			'min_size' => array( 2, 2 ),
			'max_size' => array( 6, 2 )
		),
		'draggable'               => array(
			'handle' => '.drag_handler'
		),
		'on_resize_callback'      => array(
			'el',
			'ui',
			'$widget',
			'if ( this.resize_wgd.size_x == 5 ) {
				var cws = this.resize_last_sizex,
					newx = cws == 4 ? 6 : 4;
				var new_wgd = this.resize_wgd;
				new_wgd.size_x = newx;
				jQuery(this.resize_wgd.el).find(".preview-holder").data("sizex", newx);
				this.mutate_widget_in_gridmap($widget, this.resize_wgd, new_wgd);
				return false;
			};'
		),
		'serialize_params'        => array(
			'$w',
			'wgd',
			'var type = $w.data("type"),
			content = $w.find(".block_content").text();
			if (type == "text") {
				content = $w.find(".block_content textarea").val();
			} else if (type == "image") {
				content = $w.find(".open_media").attr("data-attachment_id");
			} else if (type == "editor") {
				content = $w.find(".to_send").text();
			}
			return {
				id: $w.prop("id").replace("block_", ""),
				type: type,
				content: content,
				col: wgd.col,
				row: wgd.row,
				size_x: wgd.size_x,
				size_y: wgd.size_y
			};'
		)
	);

	wp_localize_script('pile_pix_builder_custom', 'gridster_params', $gridster_params );


	/**
	 * We are gonna create an empty style tag which will be
	 * targeted with jQuery and filled with new gridster css rules
	 * any time the grid is changing values
	 */
	add_action('admin_head', 'add_custom_gridster_style_tag');
	function add_custom_gridster_style_tag() {
		echo '<style id="custom_gridster_style"></style>';
	}
}
add_action('admin_enqueue_scripts','pile_add_pix_builder_script');

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Pile 2.0.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function pile_content_image_sizes_attr( $sizes, $size ) {
	//we don't mess with anything while in the admin
	if ( ! is_admin() ) {
		$width = $size[0];


		//only do this for the projects/products grids, not the hero images ) hence the in_the_loop())
		if ( ( is_page_template( 'page-templates/portfolio-archive.php' ) ||
		       is_post_type_archive( 'pile_portfolio' ) ||
		       is_tax( get_object_taxonomies( 'pile_portfolio' ) ) ||
		       ( function_exists( 'wc_get_page_id' ) && get_the_ID() == wc_get_page_id( 'shop' ) ) ||
		       is_post_type_archive( 'product' ) ||
		       is_tax( get_object_taxonomies( 'product' ) ) ) && in_the_loop() ) {


			//so we are on portfolio archive grid or shop

			if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() ) ) {
				//depending on the number of columns used, we will do some trickery
				//for screens bigger than 999px
				$large_no = intval( pile_option( 'products_pile_large_columns' ) );
				//for screens between 699 and 999
				$medium_no = intval( pile_option( 'products_pile_medium_columns' ) );
				//for screens smaller than 699
				$small_no = intval( pile_option( 'products_pile_small_columns' ) );
			} else {
				//depending on the number of columns used, we will do some trickery
				//for screens bigger than 999px
				$large_no = intval( pile_option( 'pile_large_columns' ) );
				//for screens between 699 and 999
				$medium_no = intval( pile_option( 'pile_medium_columns' ) );
				//for screens smaller than 699
				$small_no = intval( pile_option( 'pile_small_columns' ) );
			}

			$sizes = '';

			//we go from small to large, and depending on the image width and the columns settings we decide what is the best compromise
			switch ( $small_no ) {
				case 1:
					$sizes .= '(max-width: 698px) 95vw, ';
					break;
				case 2:
					$sizes .= '(max-width: 698px) 45vw, ';
					break;
				case 3:
					$sizes .= '(max-width: 698px) 30vw, ';
					break;
			}

			switch ( $medium_no ) {
				case 1:
					$sizes .= '(max-width: 998px) 95vw, ';
					break;
				case 2:
					$sizes .= '(max-width: 998px) 47vw, ';
					break;
				case 3:
					$sizes .= '(max-width: 998px) 30vw, ';
					break;
				case 4:
					$sizes .= '(max-width: 998px) 23vw, ';
					break;
				case 5:
					$sizes .= '(max-width: 998px) 19vw, ';
					break;
			}

			switch ( $large_no ) {
				case 1:
					$sizes .= '(max-width: 1200px) 97vw, ';
					if ( $width >= 1200 ) {
						$sizes .= '1200px';
					} else {
						$sizes .= $width . 'px';
					}
					break;
				case 2:
					$sizes .= '(max-width: 1200px) 48vw, ';
					if ( $width >= 600 ) {
						$sizes .= '600px';
					} else {
						$sizes .= $width . 'px';
					}
					break;
				case 3:
					$sizes .= '(max-width: 1200px) 31vw, ';
					if ( $width >= 400 ) {
						$sizes .= '400px';
					} else {
						$sizes .= $width . 'px';
					}
					break;
				case 4:
					$sizes .= '(max-width: 1200px) 23vw, ';
					if ( $width >= 300 ) {
						$sizes .= '300px';
					} else {
						$sizes .= $width . 'px';
					}
					break;
				case 5:
					$sizes .= '(max-width: 1200px) 19vw, ';
					if ( $width >= 240 ) {
						$sizes .= '240px';
					} else {
						$sizes .= $width . 'px';
					}
					break;
				case 6:
					$sizes .= '(max-width: 1200px) 15vw, ';
					if ( $width >= 200 ) {
						$sizes .= '200px';
					} else {
						$sizes .= $width . 'px';
					}
					break;
			}
		} elseif ( is_page() ) {
			//it is just a regular page
			//now we need to know if we are in the loop or in the hero
			if ( in_the_loop() ) {
				//the only thing that we know here is that images can't be bigger than 1200px wide - it's something
				$sizes = '(max-width: 1200px) 100vw, ';
				if ( $width >= 1200 ) {
					$sizes .= '1200px';
				} else {
					$sizes .= $width . 'px';
				}
			} else {
				//in the hero, the image is always full width, but deliver a minimum of 770px (account for retina)
				$sizes = '(max-width: 385px) 770px, 100vw';
			}
		} elseif ( is_singular( 'post' ) ) {
			//for single posts we know that the max width for images with overflow is 1100px
			$sizes = '(max-width: 1125px) 100vw, ';
			if ( $width >= 1125 ) {
				$sizes .= '1125px';
			} else {
				$sizes .= $width . 'px';
			}
		} elseif ( pile_is_post_type( 'post' ) ) {
			//we are on a blog archive and we are dealing with the post thumbnails
			$sizes = '(max-width: 698px) 100vw, (max-width: 998px) 48vw, (max-width: 1296px) 32vw, 368px';
		} elseif ( is_singular( 'pile_portfolio' ) ) {
			//we are on a single project
			//we are dealing with the hero images
			//in the hero, the image is always full width, but deliver a minimum of 770px (account for retina)
			$sizes = '(max-width: 385px) 770px, 100vw';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'pile_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post/project thumbnails
 *
 * @since Pile 2.0.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function pile_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	//we don't mess with anything while in the admin
	if ( ! is_admin() ) {
		$image = wp_get_attachment_image_src( $attachment->ID, 'full' );
		//do nothing if we've got no image sizes
		if ( ! empty( $image[1] ) ) {
			$width = $image[1];

			if ( is_singular( 'post' ) ) {
				//we are on single posts
				$attr['sizes'] = '(max-width: 768px) 97vw, (max-width: 1200px) 750px, ';

				if ( $width >= 1125 ) {
					$attr['sizes'] .= '1125px';
				} else {
					$attr['sizes'] .= $width . 'px';
				}
			} elseif ( is_singular( 'pile_portfolio' ) ) {
				//we are on single projects - we arrive here due to the fact that we are using wp_get_attachment_image()
				//we are dealing with the content images (the custom builder)
				$attr['sizes'] = '(max-width: 998px) 97vw, ';
				//all we know is that they can't be bigger than the set width (project_content_width)
				$content_width = pile_option( 'project_content_width' );
				if ( $width >= $content_width ) {
					$attr['sizes'] .= $content_width . 'px';
				} else {
					$attr['sizes'] .= $width . 'px';
				}
			} elseif ( is_singular( 'product' ) ) {
				//we are on single products - we arrive here due to the fact that we are using wp_get_attachment_image()
				if ( 'full-size' == $size ) {
					//we are dealing with the product gallery (big images)
					//now we need to account for the product layout
					$cover_layout = get_post_meta( get_the_ID(), '_product_image_layout', true );
					//falback to the default layout
					if ( empty( $cover_layout ) ) {
						$cover_layout = 'contain';
					}

					switch ( $cover_layout ) {
						case 'contain':
							//under 699px they are full-width
							$attr['sizes'] = '(max-width: 698px) 100vw, ';
							if ( $width >= 350 ) {
								$attr['sizes'] .= '50vw';
							} else {
								$attr['sizes'] .= $width . 'px';
							}
							break;
						case 'cover-half':
						case 'cover-two-thirds':
						case 'cover-full-bleed':
							//the thing with covers is that they are full-height
							//so strictly looking at the width won't cut it as it may result in pixelated images when stretched
							//so, the best we can do is use some decent sized images (the large-size and full-size, so we can account for retina also)
							$attr['sizes'] = '';
							if ( $width >= 1200 ) {
								$attr['sizes'] .= '(max-width: 698px) 1200px, ';
							}
							if ( $width >= 2048 ) {
								$attr['sizes'] .= '2048px';
							} else {
								$attr['sizes'] .= $width . 'px';
							}
							break;
						default:
							//do nothing
					}

				} else {
					//we are dealing with the product gallery thumbnails
					$attr['sizes'] = '(min-width: 999px) 6.75em, 385px';
				}
			}
		}
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'pile_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Legacy functionality and logic (hopefully we will get rid of this some day)
 */
require get_template_directory() . '/inc/classes/wpgrade.php';

/**
 * Functionality for those that don't have the mbstring PHP extension
 */
require get_template_directory() . '/inc/mb_compat.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Register Widget Areas
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Stuff that is being run on theme activation.
 */
require get_template_directory() . '/inc/activation.php';

/**
 * Load Recommended/Required plugins notification
 */
require get_template_directory() . '/inc/required-plugins/required-plugins.php';

/**
 * Various plugins integrations.
 */
require get_template_directory() . '/inc/integrations.php';

/* Automagical updates */
function wupdates_check_JDeVM( $transient ) {
	// Nothing to do here if the checked transient entry is empty
	if ( empty( $transient->checked ) ) {
		return $transient;
	}

	// Let's start gathering data about the theme
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );
	// Then WordPress version
	include( ABSPATH . WPINC . '/version.php' );
	$http_args = array (
		'body' => array(
			'slug' => $slug,
			'url' => home_url(), //the site's home URL
			'version' => 0,
			'locale' => get_locale(),
			'phpv' => phpversion(),
			'child_theme' => is_child_theme(),
			'data' => null, //no optional data is sent by default
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
	);

	// If the theme has been checked for updates before, get the checked version
	if ( isset( $transient->checked[ $slug ] ) && $transient->checked[ $slug ] ) {
		$http_args['body']['version'] = $transient->checked[ $slug ];
	}

	// Use this filter to add optional data to send
	// Make sure you return an associative array - do not encode it in any way
	$optional_data = apply_filters( 'wupdates_call_data_request', $http_args['body']['data'], $slug, $http_args['body']['version'] );

	// Encrypting optional data with private key, just to keep your data a little safer
	// You should not edit the code bellow
	$optional_data = json_encode( $optional_data );
	$w=array();$re="";$s=array();$sa=md5('044151e90ffba6231b80d5e446e80e7d8f993f67');
	$l=strlen($sa);$d=$optional_data;$ii=-1;
	while(++$ii<256){$w[$ii]=ord(substr($sa,(($ii%$l)+1),1));$s[$ii]=$ii;} $ii=-1;$j=0;
	while(++$ii<256){$j=($j+$w[$ii]+$s[$ii])%255;$t=$s[$j];$s[$ii]=$s[$j];$s[$j]=$t;}
	$l=strlen($d);$ii=-1;$j=0;$k=0;
	while(++$ii<$l){$j=($j+1)%256;$k=($k+$s[$j])%255;$t=$w[$j];$s[$j]=$s[$k];$s[$k]=$t;
		$x=$s[(($s[$j]+$s[$k])%255)];$re.=chr(ord($d[$ii])^$x);}
	$optional_data=bin2hex($re);

	// Save the encrypted optional data so it can be sent to the updates server
	$http_args['body']['data'] = $optional_data;

	// Check for an available update
	$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/themes/check_version/JDeVM', 'http' );
	if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
		$url = set_url_scheme( $url, 'https' );
	}

	$raw_response = wp_remote_post( $url, $http_args );
	if ( $ssl && is_wp_error( $raw_response ) ) {
		$raw_response = wp_remote_post( $http_url, $http_args );
	}
	// We stop in case we haven't received a proper response
	if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
		return $transient;
	}

	$response = (array) json_decode($raw_response['body']);
	if ( ! empty( $response ) ) {
		// You can use this action to show notifications or take other action
		do_action( 'wupdates_before_response', $response, $transient );
		if ( isset( $response['allow_update'] ) && $response['allow_update'] && isset( $response['transient'] ) ) {
			$transient->response[ $slug ] = (array) $response['transient'];
		}
		do_action( 'wupdates_after_response', $response, $transient );
	}

	return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'wupdates_check_JDeVM' );

/* Only allow theme updates with a valid Envato purchase code */
function wupdates_add_purchase_code_field_JDeVM( $themes ) {
	$output = '';
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );
	if ( ! is_multisite() && isset( $themes[ $slug ] ) ) {
		$output .= "<br/><br/>"; //put a little space above

		//get errors so we can show them
		$errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
		delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

		//check if we have a purchase code saved already
		$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
		//in case there is an update available, tell the user that it needs a valid purchase code
		if ( empty( $purchase_code ) && ! empty( $themes[ $slug ]['hasUpdate'] ) ) {
			$output .= '<div class="notice notice-error notice-alt notice-large">' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'wupdates' ) . '</div>';
		}
		//output errors and notifications
		if ( ! empty( $errors ) ) {
			foreach ( $errors as $key => $error ) {
				$output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
			}
		}
		if ( ! empty( $purchase_code ) ) {
			if ( ! empty( $errors ) ) {
				//since there is already a purchase code present - notify the user
				$output .= '<div class="notice notice-warning notice-alt"><p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'wupdates' ) . '</p></div>';
			} else {
				//this means a valid purchase code is present and no errors were found
				$output .= '<div class="notice notice-success notice-alt notice-large">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'wupdates' ) . '</div>';
			}
		}
		$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
		$output .= '<form class="wupdates_purchase_code" action="" method="post">' .
		           '<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
		           '<input type="text" id="' . $purchase_code_key . '" name="' . $purchase_code_key . '"
			        value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'wupdates' ) . '" style="width:100%"/>' .
		           '<p>' . __( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'wupdates' ) . '</p>' .
		           '<p class="theme-description">' .
		           __( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'wupdates' ) .
		           '</p>
			</form>';
	}
	//finally put the markup after the theme tags
	if ( ! isset( $themes[ $slug ]['tags'] ) ) {
		$themes[ $slug ]['tags'] = '';
	}
	$themes[ $slug ]['tags'] .= $output;

	return $themes;
}
add_filter( 'wp_prepare_themes_for_js' ,'wupdates_add_purchase_code_field_JDeVM' );

/* Handle the purchase code input for multisite installations */
function wupdates_ms_theme_list_purchase_code_field_JDeVM( $theme, $r ) {
	$output = '<br/>';
	$slug = $theme->get_template();
	//get errors so we can show them
	$errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
	delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

	//check if we have a purchase code saved already
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
	//in case there is an update available, tell the user that it needs a valid purchase code
	if ( empty( $purchase_code ) ) {
		$output .=  '<p>' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'wupdates' ) . '</p>';
	}
	//output errors and notifications
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $key => $error ) {
			$output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
		}
	}
	if ( ! empty( $purchase_code ) ) {
		if ( ! empty( $errors ) ) {
			//since there is already a purchase code present - notify the user
			$output .= '<p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'wupdates' ) . '</p>';
		} else {
			//this means a valid purchase code is present and no errors were found
			$output .= '<p><span class="notice notice-success notice-alt">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'wupdates' ) . '</span></p>';
		}
	}
	$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
	$output .= '<form class="wupdates_purchase_code" action="" method="post">' .
	           '<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
	           '<input type="text" id="' . $purchase_code_key . '" name="' . $purchase_code_key . '"
		        value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'wupdates' ) . '"/>' . ' ' .
	           __( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'wupdates' ) . ' ' .
	           __( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'wupdates' ) .
	           '</form>';

	echo $output;
}
add_action( 'in_theme_update_message-' . basename( get_template_directory() ), 'wupdates_ms_theme_list_purchase_code_field_JDeVM', 10, 2 );

function wupdates_purchase_code_needed_notice_JDeVM() {
	global $current_screen;

	$output = '';
	$slug = basename( get_template_directory() );
	//check if we have a purchase code saved already
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
	//if the purchase code doesn't pass the prevalidation, show notice
	if ( in_array( $current_screen->id, array( 'update-core', 'update-core-network') ) && true !== wupdates_prevalidate_purchase_code_JDeVM( $purchase_code ) ) {
		$output .= '<div class="updated"><p>' . sprintf( __( '<a href="%s">Please enter your purchase code</a> to get automatic updates for <b>%s</b>.', 'wupdates' ), network_admin_url( 'themes.php?theme=' . $slug ), wp_get_theme( $slug ) ) . '</p></div>';
	}

	echo $output;
}
add_action( 'admin_notices', 'wupdates_purchase_code_needed_notice_JDeVM' );
add_action( 'network_admin_notices', 'wupdates_purchase_code_needed_notice_JDeVM' );

function wupdates_process_purchase_code_JDeVM() {
	//in case the user has submitted the purchase code form
	if ( ! empty( $_POST['wupdates_pc_theme'] ) ) {
		$errors = array();
		$slug = sanitize_text_field( $_POST['wupdates_pc_theme'] ); // get the theme's slug
		//PHP doesn't allow dots or spaces in $_POST keys - it converts them into underscore; so we do also
		$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
		$purchase_code = false;
		if ( ! empty( $_POST[ $purchase_code_key ] ) ) {
			//get the submitted purchase code and sanitize it
			$purchase_code = sanitize_text_field( $_POST[ $purchase_code_key ] );
			//do a prevalidation; no need to make the API call if the format is not right
			if ( true !== wupdates_prevalidate_purchase_code_JDeVM( $purchase_code ) ) {
				$purchase_code = false;
			}
		}
		if ( ! empty( $purchase_code ) ) {
			//check if this purchase code represents a sale of the theme
			$http_args = array (
				'body' => array(
					'slug' => $slug, //the theme's slug
					'url' => home_url(), //the site's home URL
					'purchase_code' => $purchase_code,
				)
			);

			//make sure that we use a protocol that this hosting is capable of
			$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/front/check_envato_purchase_code/JDeVM', 'http' );
			if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
				$url = set_url_scheme( $url, 'https' );
			}
			//make the call to the purchase code check API
			$raw_response = wp_remote_post( $url, $http_args );
			if ( $ssl && is_wp_error( $raw_response ) ) {
				$raw_response = wp_remote_post( $http_url, $http_args );
			}
			// In case the server hasn't responded properly, show error
			if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
				$errors[] = __( 'We are sorry but we couldn\'t connect to the verification server. Please try again later.', 'wupdates' ) . '<span class="hidden">' . print_r( $raw_response, true ) . '</span>';
			} else {
				$response = json_decode( $raw_response['body'], true );
				if ( ! empty( $response ) ) {
					//we will only update the purchase code if it's valid
					//this way we keep existing valid purchase codes
					if ( isset( $response['purchase_code'] ) && 'valid' == $response['purchase_code'] ) {
						//all is good, update the purchase code option
						update_option( strtolower( $slug ) . '_wup_purchase_code', $purchase_code );
						//delete the update_themes transient so we force a recheck
						set_site_transient('update_themes', null);
					} else {
						if ( isset( $response['reason'] ) && ! empty( $response['reason'] ) && 'out_of_support' == $response['reason'] ) {
							$errors[] = esc_html__( 'Your purchase\'s support period has ended. Please extend it to receive automatic updates.', 'wupdates' );
						} else {
							$errors[] = esc_html__( 'Could not find a sale with this purchase code. Please double check.', 'wupdates' );
						}
					}
				}
			}
		} else {
			//in case the user hasn't entered a valid purchase code
			$errors[] = esc_html__( 'Please enter a valid purchase code. Make sure to get all the characters.', 'wupdates' );
		}

		if ( count( $errors ) > 0 ) {
			//if we do have errors, save them in the database so we can display them to the user
			update_option( strtolower( $slug ) . '_wup_errors', $errors );
		} else {
			//since there are no errors, delete the option
			delete_option( strtolower( $slug ) . '_wup_errors' );
		}

		//redirect back to the themes page and open popup
		wp_redirect( esc_url_raw( add_query_arg( 'theme', $slug ) ) );
		exit;
	}
}
add_action( 'admin_init', 'wupdates_process_purchase_code_JDeVM' );

function wupdates_send_purchase_code_JDeVM( $optional_data, $slug ) {
	//get the saved purchase code
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );

	if ( null === $optional_data ) { //if there is no optional data, initialize it
		$optional_data = array();
	}
	//add the purchase code to the optional_data so we can check it upon update check
	//if a theme has an Envato item selected, this is mandatory
	$optional_data['envato_purchase_code'] = $purchase_code;

	return $optional_data;
}
add_filter( 'wupdates_call_data_request', 'wupdates_send_purchase_code_JDeVM', 10, 2 );

function wupdates_prevalidate_purchase_code_JDeVM( $purchase_code ) {
	$purchase_code = preg_replace( '#([a-z0-9]{8})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{12})#', '$1-$2-$3-$4-$5', strtolower( $purchase_code ) );
	if ( 36 == strlen( $purchase_code ) ) {
		return true;
	}
	return false;
}

/* End of Envato checkup code */

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */
function woo_related_products_limit() {
	global $product;
	$args['posts_per_page'] = 3;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'pile_related_products_args' );
function pile_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}