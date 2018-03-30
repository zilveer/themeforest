<?php
/**
 * Skylab functions and definitions
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 745;

/**
 * Options Tree.
 */
 
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

include_once( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );
	
/**
 * Tell WordPress to run mega_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'mega_setup' );

if ( ! function_exists( 'mega_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function mega_setup() {

	/* Make Skylab available for translation.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'mega', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'mega' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'image' ) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page and custom backgrounds
	add_theme_support( 'post-thumbnails' );
	
	
	// Declare WooCommerce support
	add_theme_support( 'woocommerce' );
	
	// Ensure cart contents update when products are added to the cart via AJAX
	add_filter( 'add_to_cart_fragments', 'mega_woocommerce_header_add_to_cart_fragment' );
	 
	function mega_woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		
		ob_start();
		
		?>

		<div class="woocommerce-cart-wrapper">
			<?php if ( ! $woocommerce->cart->cart_contents_count ) { ?>
				<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> (<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>
			<?php } else { ?>
				<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> (<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>
				<div class="product-list-cart">
					<ul>
					<?php foreach($woocommerce->cart->cart_contents as $cart_item): //var_dump($cart_item); ?>
						<li>
							<a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
								<?php echo get_the_post_thumbnail( $cart_item['product_id'], 'shop_thumbnail' ); ?>
								<?php echo $cart_item['data']->post->post_title; ?>
							</a>
							<?php echo $cart_item['quantity']; ?> x <?php echo $woocommerce->cart->get_product_subtotal( $cart_item['data'], $cart_item['quantity'] ); ?>
						</li>
						<?php endforeach; ?>
						<div class="woocommerce-cart-checkout">
							<a class="button" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ); ?>"><?php _e( 'View Cart', 'mega' ); ?></a>
							<a class="button alt" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) ); ?>"><?php _e( 'Checkout', 'mega' ); ?> &rarr;</a>
						</div>
					</ul>
				</div>
			<?php } ?>
		</div>
		<?php
		
		$fragments['#page .woocommerce-cart-wrapper'] = ob_get_clean();
		
		return $fragments;
		
	}
	
	// Hook in functions to display the wrappers theme requires
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	add_action('woocommerce_before_main_content', 'mega_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'mega_theme_wrapper_end', 10);

	function mega_wrapper_start() {
		echo '<div id="primary">';
	}

	function mega_theme_wrapper_end() {
		echo '</div>';
	}
	
	// Disable WooCommerce breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	
	// WooCommerce display number products per page.
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
	
	// WooCommerce change number of products per row
	$shop_layout = ot_get_option( 'shop_layout' );
	if ( isset($_GET['sidebar']) ) {
		if ( $shop_layout !== 'full-width' && $_GET['sidebar'] !== 'full-width' ) {
			add_filter('loop_shop_columns', 'loop_columns');
		}
	} else if ( $shop_layout !== 'full-width' ) {
		add_filter('loop_shop_columns', 'loop_columns');
	}
	
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 3;
		}
	}
	
	// WooCommerce change number of products per row
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );
	 
	if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
		function woocommerce_output_upsells() {
			woocommerce_upsell_display( 3,3 ); // Display 3 products in rows of 3
		}
	}
	
	// WooCommerce flipside featured images
	add_action('woocommerce_before_shop_loop_item_title', 'mega_woocommerce_template_loop_product_thumbnail', 10);
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	function mega_woocommerce_template_loop_product_thumbnail() {
		$id = get_the_ID();
		$size = 'shop_catalog';

		$gallery = get_post_meta($id, '_product_image_gallery', true);
		$attachment_image = '';
		if(!empty($gallery)) {
			$gallery = explode(',', $gallery);
			$first_image_id = $gallery[0];
			$attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'back-image'));
		}
		$thumb_image = get_the_post_thumbnail($id , $size);

		if ( $attachment_image ) {
			$classes = 'flipside-image product-image-wrapper';
		} else {
			$classes = 'default-image product-image-wrapper';
		}

		echo '<span class="'. $classes .'">';
		echo $attachment_image;
		echo $thumb_image;
		echo '</span>';
	}
	
	// WooCommerce remove Add to Cart Buttons from Shop Page
	function mega_remove_loop_button() {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	}
	//add_action( 'init','mega_remove_loop_button' );
	//add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
	
	// WooCommerce add categories to Shop Page
	//add_action( 'woocommerce_after_shop_loop_item', 'mega_woocommerce_template_loop_category', 10 );
	function mega_woocommerce_template_loop_category() {
		global $post, $product;
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ', ', '<span class="posted_in">' . _n( '', '', $size, 'mega' ) . ' ', '</span>' );
	}
	
	// WooCommerce ajax loader
	//add_filter( 'woocommerce_ajax_loader_url', 'woo_custom_cart_loader' );
	//function woo_custom_cart_loader() {
		//return __(get_template_directory_uri().'/images/ajax-loader.gif', 'woocommerce');
	//}
	
	// WPML for OptionTree
	if(function_exists('icl_register_string')){
		$top_bar_info = ot_get_option( 'top_bar_info' );
		icl_register_string( 'OptionTree', 'top_bar_info', $top_bar_info );
		$footer_info = ot_get_option( 'footer_info' );
		icl_register_string( 'OptionTree', 'footer_info', $footer_info );
	}
	
	// OptionTree filter on layout images
	function mega_filter_radio_images( $array, $field_id  ) {
		  
		if ( $field_id  == 'shop_layout' ) {
			$array = array(
				array(
				'value'   => 'left-sidebar',
				'label'   => __( 'Left Sidebar', 'option-tree' ),
				'src'     => OT_URL . 'assets/images/layout/left-sidebar.png'
				),
				array(
				'value'   => 'right-sidebar',
				'label'   => __( 'Right Sidebar', 'option-tree' ),
				'src'     => OT_URL . 'assets/images/layout/right-sidebar.png'
				),
				array(
				'value'   => 'full-width',
				'label'   => __( 'Full Width (no sidebar)', 'option-tree' ),
				'src'     => OT_URL . 'assets/images/layout/full-width.png'
			  )
			);
		}
		  
		 return $array;
	  
	}
	add_filter( 'ot_radio_images', 'mega_filter_radio_images', 10, 2 );
	
}
endif; // mega_setup

// Auto plugin activation
require_once( get_template_directory() . '/inc/class-tgm-plugin-activation.php' );
add_action('tgmpa_register', 'mega_register_required_plugins');
function mega_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'WPBakery Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/inc/plugins/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or mega, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/inc/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or mega, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Portfolio Post Type', // The plugin name
			'slug'     				=> 'portfolio-post-type', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/inc/plugins/portfolio-post-type.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or mega, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false
		),
		//array(
			//'name' 		=> 'WordPress SEO',
			//'slug' 		=> 'wordpress-seo',
			//'required' 	=> false
		//),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'theme-slug'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'theme-slug'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'theme-slug' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'theme-slug' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'theme-slug' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'theme-slug' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
		*/
	);

	tgmpa($plugins, $config);
}

/**
 * Title Tags.
 */
//if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function mega_render_title() {
?>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'mega' ), max( $paged, $page ) );

	?></title>
<?php
    }
    add_action( 'wp_head', 'mega_render_title' );
//}

/**
 * Sets the post excerpt length.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function mega_excerpt_length( $length ) {
		return 46;
}
add_filter( 'excerpt_length', 'mega_excerpt_length' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function mega_auto_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'mega_auto_excerpt_more' );

/**
 * Get taxonomies terms links.
 */
function mega_custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post( $post->ID );
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies( $post_type );
	foreach ( $taxonomies as $taxonomy ) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term ) {
				$out[] = $term->name;
			}
			if ( count($out) > 1 ) {
				$elem = array_pop( $out );
				$return = implode( ', ', $out ) . __( ' & ', 'mega' ) . $elem;
			} else {
				$return = $out[0];
			}
			return $return;
		}
	}
}

/**
 * Remove title attribute from images.
 */
function mega_wp_get_attachment_image_attributes_title_filter( $attr ) {
	unset( $attr['title'] );
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'mega_wp_get_attachment_image_attributes_title_filter' );

/**
 * Register our sidebars and widgetized areas.
 */
function mega_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'mega' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'mega' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for your pages', 'mega' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'mega' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your shop page', 'mega' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'mega' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your footer', 'mega' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'mega' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your footer', 'mega' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'mega' ),
		'id' => 'sidebar-6',
		'description' => __( 'An optional widget area for your footer', 'mega' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Area Four', 'mega' ),
		'id' => 'sidebar-7',
		'description' => __( 'An optional widget area for your footer', 'mega' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
}
add_action( 'widgets_init', 'mega_widgets_init' );

if ( ! function_exists( 'mega_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function mega_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo sanitize_html_class( $nav_id ); ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'mega' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<i class="nav-pagination-single-left"></i> Older Posts', 'mega' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer Posts <i class="nav-pagination-single-right"></i>', 'mega' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // mega_content_nav

if ( ! function_exists( 'mega_pagination_content_nav' ) ) :
/**
 * Display navigation to next/previous pages with pagination when applicable
 */
function mega_pagination_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo sanitize_html_class( $nav_id ); ?>">
			
			<?php $big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text' => __('<span class="meta-nav">&larr;</span> Prev', 'mega'),
				'next_text' => __('Next <span class="meta-nav">&rarr;</span>', 'mega'),
				'end_size' => 1
			) ); ?>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // mega_pagination_content_nav

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function mega_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;
		
	if ( is_active_sidebar( 'sidebar-6' ) )
		$count++;
		
	if ( is_active_sidebar( 'sidebar-7' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one clearfix';
			break;
		case '2':
			$class = 'two clearfix';
			break;
		case '3':
			$class = 'three clearfix';
			break;
		case '4':
			$class = 'four clearfix';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @return string|bool URL or false when no link is present.
 */
function mega_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

if ( ! function_exists( 'mega_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function mega_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mega' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mega' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="avatar vcard">
					<?php
						$avatar_size = 48;

						echo get_avatar( $comment, $avatar_size );

					?>

				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mega' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content">
			<div class="comment-author vcard">
					<?php

						// translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s', 'mega' ),
							
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s" class="comment-time"><span>%3$s</span></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s %2$s', 'mega' ), get_comment_date('M j, Y'), get_comment_time() )
							)
						);
						
						$sep = '<span class="sep"> | </span>';
						if ( comments_open() ) :
						echo $sep;
						endif; // End if comments_open()
						comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'mega' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
							$show_sep = true;
							//$sep = '<span class="sep"> | </span>';
							edit_comment_link( __( 'Edit', 'mega' ), '' . $sep . '<span class="edit-link">', '</span>' );
					?>

			</div><!-- .comment-author .vcard -->
				
			<?php comment_text(); ?>
			
			</div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for mega_comment()

if ( ! function_exists( 'mega_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mega_posted_on() {
	printf( __( '<p class="entry-date-wrapper"><span class="entry-date" datetime="%2$s" pubdate>%3$s</span></p><span class="by-author"> <span class="sep">|</span> <span class="author vcard"> by <a class="url fn n" href="%4$s" title="%5$s" rel="author">%6$s</a></span></span>', 'mega' ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'mega' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

	/**
	 * Create WP3 menu areas.
	 */
	register_nav_menus( array( 'primary' => 'Primary Menu' ) );

/**
 * Using a Custom Walker Function for wp_list_categories for portfolio.
 */
class Mega_Walker_Portfolio_Category extends Walker_Category {
   function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0 ) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
	  $link = '<a href="#" data-filter=".'.$category->slug.'" ';
      if ( ! ( $use_desc_for_title == 0 || empty($category->description) ) )
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      $link .= $cat_name;
      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'mega' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-'.rand(2, 99).'"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}

/**
 * Adds custom taxonomies to the post class.
 */
if ( ! function_exists( 'mega_custom_taxonomy_post_class' ) ) {

	function mega_custom_taxonomy_post_class( $classes, $class, $ID ) {

			if ( ( 'portfolio' == get_post_type() ) ) {
	
				$taxonomy = 'portfolio-category';
			
			}
			
			if ( ! empty( $taxonomy ) ) {

				$terms = get_the_terms( (int) $ID, $taxonomy );
				
					if ( ! empty( $terms ) ) {

						foreach( (array) $terms as $order => $term ) {
					   
							if ( ! in_array( $term->slug, $classes ) ) {

								$classes[] = 'element ' . $term->slug . '';

							}
						
						}

					}
				
			}

            return $classes;

        }

    }
add_filter( 'post_class', 'mega_custom_taxonomy_post_class', 10, 3 );

/**
 * Adds classes to the array of body classes.
 */
function mega_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() )
		$classes[] = 'singular';
		
	// Layout
	//$layout = ot_get_option( 'layout' );
	//if ( $layout == 'boxed' )
		//$classes[] = 'boxed';
	//else $classes[] = 'wide';
	
	// Left Menu
	$left_menu = ot_get_option( 'left_menu' );
	if ( ! empty( $left_menu ) )
		$classes[] = 'left-menu';
		
	// Empty Cart
	global $woocommerce;
	if ( $woocommerce && is_cart() ) {
		if((sizeof($woocommerce->cart->cart_contents)) == 0) {
			$classes[] = 'empty-cart';
		}
	}
	
	// No products
	if ( $woocommerce && is_shop() && ! have_posts() || $woocommerce && is_product_category() && ! have_posts() ) {
		$classes[] = 'no-products';
	}
	
	// Remove for Blog Sidebar and Center Posts
	$remove_sidebar_and_center_posts = ot_get_option( 'remove_sidebar_and_center_posts' );
	if ( ! empty( $remove_sidebar_and_center_posts ) && mega_is_blog() ) {
		$classes[] = 'no-sidebar-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'mega_body_classes' );

// mega_is_blog
function mega_is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag()) || (is_search()) ) && ( $posttype == 'post')  ) ? true : false ;
}

/**
 * Loads a set of CSS and/or Javascript documents. 
 */
function mega_enqueue_admin_scripts($hook) {
	wp_register_style( 'ot-admin-custom', get_template_directory_uri() . '/inc/css/ot-admin-custom.css' );
	if ( $hook == 'appearance_page_ot-theme-options' ) {
		wp_enqueue_style( 'ot-admin-custom' );
	}
	if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
		wp_register_style( 'js_composer_extend', get_template_directory_uri() . '/vc_extend/assets/css/js_composer_extend.css' );
		
		wp_register_script( 'composer-custom-views_extend', get_template_directory_uri().'/vc_extend/assets/js/composer-custom-views_extend.js', array('wpb_js_composer_js_view'), WPB_VC_VERSION, true );
		if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' )
			return;
		wp_enqueue_script( 'composer-custom-views_extend' );
		wp_enqueue_style( 'js_composer_extend' );
	}
}
add_action( 'admin_enqueue_scripts', 'mega_enqueue_admin_scripts', 9999 );

/**
 * A safe way to add/enqueue a CSS/JavaScript. 
 */
 function mega_enqueue_scripts() {
	// A safe way to register a JavaScript file.
	wp_register_style( 'style', get_template_directory_uri() . '/style.css' );
	wp_register_style( 'fresco', get_template_directory_uri() . '/css/fresco.css' );
	wp_enqueue_style( 'style', array() );
	
	wp_register_script( 'jquery.magnific-popup.min', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'fresco', get_template_directory_uri() . '/js/fresco.js', array( 'jquery' ), false, false );
	wp_register_script( 'isotope.pkgd.min', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), false, true );
	wp_register_script( 'jquery.portfolio', get_template_directory_uri() . '/js/jquery.portfolio.js', array(), false, true );
	wp_register_script( 'jquery.gallery', get_template_directory_uri() . '/js/jquery.gallery.js', array(), false, true );
	wp_register_script( 'jquery.fancybox.pack', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array(), false, true );
	//wp_register_script( 'jquery.fancybox-media', get_template_directory_uri() . '/js/jquery.fancybox-media.js', array(), false, true );
	wp_register_script( 'jquery.royalslider.min', get_template_directory_uri() . '/js/jquery.royalslider.min.js', array(), false, true );
	wp_register_script( 'vc_pie_mega', get_template_directory_uri() . '/js/jquery.vc_chart_mega.js', array( 'waypoints', 'progressCircle' ), false, true );
	wp_register_script( 'jquery.init', get_template_directory_uri() . '/js/jquery.init.js', array( 'jquery' ), false, true );

	//if ( ! is_404() ) {
		wp_enqueue_style( 'js_composer_front' );
		wp_enqueue_script( 'wpb_composer_front_js' );
		wp_enqueue_style('js_composer_custom_css');
		
		if ( is_post_type_archive( 'portfolio' ) ) {
			wp_enqueue_script( 'isotope.pkgd.min' );
			wp_enqueue_script( 'jquery.portfolio' );
			wp_enqueue_script( 'jquery.fancybox.pack' );
			//wp_enqueue_script( 'jquery.fancybox-media' );
		}
		
		global $woocommerce;
		if ( $woocommerce ) {
			if ( is_product() ) {
				wp_enqueue_script( 'flexslider' );
			}
		}
			
		wp_enqueue_script( 'jquery.init' );
	//}
	
}
add_action( 'wp_enqueue_scripts', 'mega_enqueue_scripts', 1 ); 

/**
 * Initialize jQuery Plugins.
 */
function mega_initialize_jquery_plugins() {
	
?>
	<!-- JavaScript
    ================================================== -->
	<?php
	global $wp_the_query;
	$pageid = $wp_the_query->get_queried_object_id();
	$mediaType = get_post_meta( $pageid, 'mega_portfolio_type', true );
	//$mediaType = get_post_meta( get_the_ID(), 'mega_portfolio_type', true );
	?>
	
	<?php $left_menu = ot_get_option( 'left_menu' ); ?>
	<?php if ( empty( $left_menu ) ) { ?>
	
	
	<?php $header_style = ot_get_option( 'header_style' ); ?>
	<?php if ( empty( $header_style ) ) { ?>
		<?php $header_style = 'fixed'; ?>
	<?php } ?>
	<?php $remove_header_height_reduction = ot_get_option( 'remove_header_height_reduction' ); ?>
	<?php if ( $header_style == 'fixed' ) { ?>
		<?php //if ( empty( $remove_header_height_reduction ) ) { ?>
		<script>
		// Transition
		jQuery(document).ready(function($) {
			if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
				var $addTransition = $( '#header, .site-title-custom, #site-title, .site-title-custom img, #access, .search-header-wrapper, .social-accounts-wrapper, .woocommerce-cart-wrapper, #header-wrapper #s' );
				$addTransition.addClass( 'transition' );
			}
		});
		</script>
		<?php //} ?>
		
		<script>
		// Sticky header
		//if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
			var sticky = document.querySelector('#header-wrapper');
			<?php if ( is_page_template( 'page-header-tansparent.php' ) ) { ?>sticky.classList.add('fixed');<?php } ?>
			var origOffsetY = sticky.offsetTop;
			var hasScrollY = 'scrollY' in window;

			function onScroll(e) {
			  var y = hasScrollY ? window.scrollY : document.documentElement.scrollTop;
			  y >= origOffsetY ? sticky.classList.add('fixed') : sticky.classList.remove('fixed');
			}

			if (document.addEventListener) {
				 document.addEventListener('scroll', onScroll); 
			} else if (document.attachEvent)  {
				 document.attachEvent('onscroll', onScroll);
			}
		//}
		</script>
		<?php $header_background_for_blog = ot_get_option( 'header_background_for_blog' ); ?>
		<?php $header_background_for_shop = ot_get_option( 'header_background_for_shop' ); ?>
		
		<?php global $post_type; ?>
		<?php $enable_transparent_header_background_for_single_portfolio_pages = ot_get_option( 'enable_transparent_header_background_for_single_portfolio_pages' ); ?>
		
		<?php $optiontree_enable_transparent_header_background_for_single_portfolio_pages = get_post_meta( get_the_ID(), 'optiontree_enable_transparent_header_background_for_single_portfolio_pages', true ); ?>
		<?php $enable_transparent_header_background_for_blog = ot_get_option( 'enable_transparent_header_background_for_blog' ); ?>
		<?php $enable_transparent_header_background_for_shop = ot_get_option( 'enable_transparent_header_background_for_shop' ); ?>
		<?php if ( is_page_template( 'page-header-tansparent.php' ) || ! empty( $enable_transparent_header_background_for_blog ) && ! empty( $header_background_for_blog ) && mega_is_blog() || ! empty( $enable_transparent_header_background_for_shop ) && ! empty( $header_background_for_shop ) && is_shop() || ! empty( $enable_transparent_header_background_for_shop ) && ! empty( $header_background_for_shop ) && is_product_category() || ! empty( $enable_transparent_header_background_for_shop ) && ! empty( $header_background_for_shop ) && is_product_tag() || ! empty( $enable_transparent_header_background_for_single_portfolio_pages ) && $post_type == 'portfolio' || ! empty( $optiontree_enable_transparent_header_background_for_single_portfolio_pages ) ) { ?>
		<script>
		jQuery(document).ready(function($) {
		// Transparent Header Background for Homepage
		//if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
			var sticky = $('#header-wrapper').offset().top;
			var page = $('#page');
					  
			$(window).scroll(function(){
				if( $(window).scrollTop() > sticky ) {
					page.removeClass('transparent-header');
				} else {
					page.addClass('transparent-header');
				}
			});
		//}
		});
		</script>
		<?php } ?>
	<?php } // End if ( $header_style == 'fixed' ) ?>
	<?php } // End if ( empty( $left_menu ) ) ?>
	
	<script>
	// FlexSlider
	jQuery(window).load(function() {
		jQuery('.flex-direction-nav a').html('');
	});
	</script>
	
	<?php $disable_right_click = ot_get_option( 'disable_right_click' ); ?>
	<?php if ( ! empty( $disable_right_click ) ) { ?>
		<script>
			jQuery(document).ready(function($) {
				$('img').bind("contextmenu", function (e) {
					return false; /* Disables right click */
				})
			});
		</script>
	<?php } ?>
	
	<?php $javascript_code = ot_get_option( 'javascript_code' ); ?>
	<?php if ( ! empty( $javascript_code ) ) { ?>
		<?php echo $javascript_code; ?>
	<?php } ?>
	
	<?php global $woocommerce; ?>
	<?php if ( $woocommerce ) {  ?>
		<?php if ( is_shop() || is_product_category() ) { ?>
		<script>
		jQuery(document).ready(function($) {
			if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
				$('.chosen-select-no-single').chosen({
					disable_search_threshold: 10
				});
			} else {
				$('.chosen-select-no-single').css({'opacity' : '1', 'width' : '100%', 'height' : 'auto'});
			}
		});
		</script>
		<?php } ?>
	<?php } ?>
  
<?php
}
add_action( 'wp_footer', 'mega_initialize_jquery_plugins', 20 );

/**
 * Load up our theme meta boxes and related code.
 */
	load_template( trailingslashit( get_template_directory() ) . 'inc/meta-box-option-tree.php' );
	
/**
 * Load up our theme style and related code.
 */
	require( get_template_directory() . '/inc/styles.php' );

/**
 * Get Attachement ID from URL.
 */
function mega_get_attachment_id( $url ) {

    $dir = wp_upload_dir();
    $dir = trailingslashit($dir['baseurl']);

    if( false === strpos( $url, $dir ) )
        return false;

    $file = basename($url);

    $query = array(
        'post_type' => 'attachment',
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'value' => $file,
                'compare' => 'LIKE',
            )
        )
    );

    $query['meta_query'][0]['key'] = '_wp_attached_file';
    $ids = get_posts( $query );

    foreach( $ids as $id )
        if( $url == array_shift( wp_get_attachment_image_src($id, 'full') ) )
            return $id;

    $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
    $ids = get_posts( $query );

    foreach( $ids as $id ) {

        $meta = wp_get_attachment_metadata($id);

        foreach( $meta['sizes'] as $size => $values )
            if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {
				return $id;
            }
    }

    return false;
}

/**
 * Filter Primary Typography Fields.
 */
function mega_filter_typography_fields( $array, $field_id ) {
  if ( $field_id == 'primary_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'mega_filter_typography_fields', 10, 2 );

/**
 * Filter Menu Typography Fields.
 */
function mega_filter_menu_typography_fields( $array, $field_id ) {
  if ( $field_id == 'menu_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'mega_filter_menu_typography_fields', 10, 2 );

/**
 * Filter Header Typography Fields.
 */
function mega_filter_header_typography_fields( $array, $field_id ) {
  if ( $field_id == 'header_typography' ) {
    $array = array(
		'font-family'
    );
  }
  
  return $array;
}
add_filter( 'ot_recognized_typography_fields', 'mega_filter_header_typography_fields', 10, 2 );

/**
 * Remove the WordPress Image Caption Extra 10px Width.
 */
class mega_fixImageMargins {
    public $xs = 0; //change this to change the amount of extra spacing

    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty($caption) ) {
            return $content;
        }

        if ( $id ) $id = 'id="' . $id . '" ';

    return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new mega_fixImageMargins();

// Convert Hex Color to RGB
function mega_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/**
 * Contact Form 7 Custom AJAX Loader
 */
function mega_wpcf7_ajax_loader () {
	return get_template_directory_uri() .'/images/preloader.gif';
}
add_filter( 'wpcf7_ajax_loader', 'mega_wpcf7_ajax_loader' );

// Vc set as theme
//add_action( 'init', 'mega_vcSetAsTheme' );
//function mega_vcSetAsTheme() {
	//vc_set_as_theme();
//}

/**
 * Visual Composer with custom set of shortcodes.
 */

// don't load directly
if (!defined('ABSPATH')) die('-1');

/*
Display notice if Visual Composer is not installed or activated.
*/
if ( !defined('WPB_VC_VERSION') ) { return; }

// Row
vc_add_param( 'vc_row', array(
		  "type" => "dropdown",
		  "heading" => __("Parallax scrolling", "mega"),
		  "param_name" => "bg_parallax_scrolling",
		  "value" => array(__("No", "mega") => 'no', __("Yes", "mega") => 'yes', ),
		  "description" => __("Enable parallax scrolling? Note: Background Repeat option must be Cover.", "mega")
		) );
		
vc_add_param( 'vc_row', array(
		  "type" => "textfield",
		  "heading" => __("Enter video file URL", "mega"),
		  "param_name" => "bg_video",
		  "value" => '',
		  "description" => __("Enter HTML5 video file URL", "mega")
		) );
		
vc_add_param( 'vc_row',array(
		  "type" => "colorpicker",
		  "heading" => __("Background overlay color", "mega"),
		  "param_name" => "bg_overlay_color",
		  "description" => __("Choose a value for background overlay color.", "mega")
		) );
vc_add_param( 'vc_row',array(
		  "type" => "textfield",
		  "heading" => __("Background overlay opacity", "mega"),
		  "param_name" => "bg_overlay_opacity",
		  "value" => '',
		  "description" => __("Choose a value for background overlay opacity. Example: .8.", "mega")
		) );
vc_add_param( 'vc_row',array(
		  "type" => "attach_image",
		  "heading" => __("Fallback image", "mega"),
		  "param_name" => "fallback_image",
		  "admin_label" => true,
		  "value" => '',
		  "description" => __('Upload a fallback image for your video.', "mega")
		) );

// Google Maps Alternative
function mega_vc_gmaps_alternative( $atts ) {
   extract( shortcode_atts( array(
      'adress' => '121 King Street, Melbourne, Australia',
      'height' => '540',
	  'bubble' => '',
	  'zoom' => '14',
	  'custom_marker' => '',
	  'zoom_control' => '',
	  'pan_control' => '',
	  'map_type_control' => '',
	  'street_view_control' => '',
	  //'grayscale' => '',
	  //'hue' => '',
	  'style' => '',
	  'css_class' => ''
   ), $atts ) );
   
	if ($zoom_control!='' && $zoom_control!='0'){
		$zoom_control = 'true';
	} else {
		$zoom_control = 'false';
	}
	
	if ($pan_control!='' && $pan_control!='0'){
		$pan_control = 'true';
	} else {
		$pan_control = 'false';
	}
	
	if ($map_type_control!='' && $map_type_control!='0'){
		$map_type_control = 'true';
	} else {
		$map_type_control = 'false';
	}
	
	if ($street_view_control!='' && $street_view_control!='0'){
		$street_view_control = 'true';
	} else {
		$street_view_control = 'false';
	}
 
	$output = "<section class='block-map-wrapper {$css_class}'>";
			$output .= "<div class='block-map clearfix'>";
				$output .= "<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=true'></script>";
				$output .= "<script>";
				$output .= "jQuery(document).ready(function(){";
				
				//if ($grayscale!='' && $grayscale!='0'){
					//$saturation = -100;
				//} else {
					//$saturation = -20;
				//}
				
				//if ( empty( $hue ) ) {
					//$hue = '';
				//}
				
				if ( $style == 'light_monochrome' ) {
				
					$output .= "var stylez = [";
						$output .= "{";
							$output .= "'featureType': 'water',";
							$output .= "'elementType': 'all',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#96e0e9'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': -78";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': 67";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'simplified'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						
						$output .= "{";
							$output .= "'featureType': 'landscape',";
							$output .= "'elementType': 'all',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#ffffff'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': -100";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': 100";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'simplified'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						
						$output .= "{";
							$output .= "'featureType': 'road',";
							$output .= "'elementType': 'geometry',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#bbc0c4'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': -93";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': 31";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'simplified'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						
						$output .= "{";
							$output .= "'featureType': 'poi',";
							$output .= "'elementType': 'all',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#ffffff'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': -100";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': 100";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'off'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						
						$output .= "{";
							$output .= "'featureType': 'road.local',";
							$output .= "'elementType': 'geometry',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#96e0e9'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': -90";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': -8";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'simplified'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						
						$output .= "{";
							$output .= "'featureType': 'transit',";
							$output .= "'elementType': 'all',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#96e0e9'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': 10";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': 69";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'on'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						
						$output .= "{";
							$output .= "'featureType': 'administrative.locality',";
							$output .= "'elementType': 'all',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#2c2e33'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': 7";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': 19";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'on'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						
						$output .= "{";
							$output .= "'featureType': 'road',";
							$output .= "'elementType': 'labels',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#bbc0c4'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': -93";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': 31";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'on'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						
						$output .= "{";
							$output .= "'featureType': 'road.arterial',";
							$output .= "'elementType': 'labels',";
							$output .= "'stylers': [";
							$output .= "{";
							$output .= "'hue': '#bbc0c4'";
							$output .= "},";
							$output .= "{";
							$output .= "'saturation': -93";
							$output .= "},";
							$output .= "{";
							$output .= "'lightness': -2";
							$output .= "},";
							$output .= "{";
							$output .= "'visibility': 'simplified'";
							$output .= "},";
							$output .= "]";
						$output .= "},";
						//$output .= "{";
							//$output .= "featureType: 'all',";
							//$output .= "elementType: 'all',";
							//$output .= "stylers: [";
								//$output .= "{ saturation: {$saturation} }, {hue: '{$hue}'}";
							//$output .= "]";
						//$output .= "}";
					$output .= "];";
					
					
				} else {
				
					$output .= "var stylez = [";
						$output .= "{";
							$output .= "'featureType': 'all',";
							$output .= "'elementType': 'labels.text.fill',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'saturation': 36";
								$output .= "},";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 40";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'all',";
							$output .= "'elementType': 'labels.text.stroke',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'visibility': 'on'";
								$output .= "},";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 16";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'all',";
							$output .= "'elementType': 'labels.icon',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'visibility': 'off'";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'administrative',";
							$output .= "'elementType': 'geometry.fill',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 20";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'administrative',";
							$output .= "'elementType': 'geometry.stroke',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 17";
								$output .= "},";
								$output .= "{";
									$output .= "'weight': 1.2";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'landscape',";
							$output .= "'elementType': 'geometry',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 20";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'poi',";
							$output .= "'elementType': 'geometry',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 21";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'road.highway',";
							$output .= "'elementType': 'geometry.fill',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 17";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'road.highway',";
							$output .= "'elementType': 'geometry.stroke',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 29";
								$output .= "},";
								$output .= "{";
									$output .= "'weight': 0.2";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'road.arterial',";
							$output .= "'elementType': 'geometry',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 18";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'road.local',";
							$output .= "'elementType': 'geometry',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 16";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'transit',";
							$output .= "'elementType': 'geometry',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 19";
								$output .= "}";
							$output .= "]";
						$output .= "},";
						$output .= "{";
							$output .= "'featureType': 'water',";
							$output .= "'elementType': 'geometry',";
							$output .= "'stylers': [";
								$output .= "{";
									$output .= "'color': '#000000'";
								$output .= "},";
								$output .= "{";
									$output .= "'lightness': 17";
								$output .= "}";
							$output .= "]";
						$output .= "}";
					$output .= "];";
				
				}
				
				// Map Options
				$output .= "var mapOptions = {";
					$output .= "zoom: {$zoom},";
					$output .= "scrollwheel: false,";
					$output .= "zoomControl: {$zoom_control},";
					$output .= "zoomControlOptions: {";
						$output .= "style: google.maps.ZoomControlStyle.LARGE,";
						$output .= "position: google.maps.ControlPosition.TOP_LEFT";
					$output .= "},";
					$output .= "mapTypeControl: {$map_type_control},";
					$output .= "scaleControl: false,";
					$output .= "panControl: {$pan_control},";
					$output .= "streetViewControl: {$street_view_control},";
					$output .= "draggable: false,";

					$output .= "mapTypeId: google.maps.MapTypeId.ROADMAP";
				$output .= "};";
				
				// The Map Object
				$output .= "var map = new google.maps.Map(document.getElementById('map'), mapOptions);";
				
				$output .= "var address = '';";
				$output .= "var geocoder = new google.maps.Geocoder();";
				$output .= "geocoder.geocode({ 'address' : '{$adress}' }, function (results, status) {";
					$output .= "if (status == google.maps.GeocoderStatus.OK) {";
						$output .= "address = results[0].geometry.location;";
								
						$output .= "map.setCenter(results[0].geometry.location);";
						
						if ( ! empty( $custom_marker ) ) {
							//$custom_marker_url = wp_get_attachment_url( $custom_marker, 'full' );
							$custom_marker_url = wp_get_attachment_image_src( $custom_marker, 'full' );
							$custom_marker_width_small = $custom_marker_url[1] / 2;
							$custom_marker_height_small = $custom_marker_url[2] / 2;
						}
								
						$output .= "var marker = new google.maps.Marker({";
							$output .= "position: address,";
							$output .= "map: map,";
							$output .= "clickable: true,";
							if ( ! empty( $custom_marker ) ) {
							$output .= "icon: {";
								$output .= "url: '{$custom_marker_url[0]}',";
								$output .= "size: null,";
								$output .= "origin: null,";
								//$output .= "anchor: null,";
								$output .= "anchor: new google.maps.Point(15, 45),";
								$output .= "scaledSize: new google.maps.Size({$custom_marker_width_small},{$custom_marker_height_small})";
							$output .= "},";
							}
						$output .= "});";
								
						$output .= "var infowindow = new google.maps.InfoWindow({ content: '{$adress}', infoBoxClearance: new google.maps.Size(1, 5) });";
						if ($bubble!='' && $bubble!='0'){
						$output .= "google.maps.event.addListener(map, 'tilesloaded', function() {";
							$output .= "infowindow.open(map, marker);";
							$output .= "});";
						}
						$output .= "google.maps.event.addListener(marker, 'click', function() {";
						$output .= "infowindow.open(map, marker);";
						$output .= "});";
								
					$output .= "}";
				$output .= "});";
				
				//if ($grayscale!='' && $grayscale!='0'){
					$output .= "var mapType = new google.maps.StyledMapType(stylez, { name:'Grayscale' });";
					$output .= "map.mapTypes.set('gray', mapType);";
					$output .= "map.setMapTypeId('gray');";
				//}
				
				$output .= "});";
				$output .= "</script>";
				
				$output .= "<div id='map' class='map' style='width: 100%; height:{$height}px'></div>";
			$output .= "</div><!-- .block-map -->";
		$output .= "</section><!-- .block-map-wrapper -->";
 
	return $output;
}
add_shortcode( 'vc_gmaps_alternative', 'mega_vc_gmaps_alternative' );

vc_map( array(
   "name" => __("Google Maps Alternative", "mega"),
   "base" => "vc_gmaps_alternative",
   "class" => "",
   "icon" => "icon-wpb-vc_gmaps_alternative",
   "category" => __('Content', "mega"),
   //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
   //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/assets/css/js_composer_extend.css'),
   "params" => array(
      array(
		  "type" => "textfield",
		  "heading" => __("Google map adress", "mega"),
		  "param_name" => "adress",
		  "admin_label" => true,
		  "value" => __("121 King Street, Melbourne, Australia", "mega"),
		  "description" => sprintf(__('Adress for your map. Visit %s find your address and then paste it here. Example: 121 King Street, Melbourne, Australia', "mega"), '<a href="http://maps.google.com" target="_blank">Google maps</a>')
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Map height", "mega"),
		  "param_name" => "height",
		  "admin_label" => true,
		  "value" => 540,
		  "description" => __('Enter map height in pixels. Example: 540.', "mega")
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Map Zoom", "mega"),
		  "param_name" => "zoom",
		  "value" => array(__("14 - Default", "mega") => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Add info bubble", "mega"),
		  "param_name" => "bubble",
		  "description" => __("If selected, information bubble will be visible.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => "attach_image",
		  "heading" => __("Custom Marker", "mega"),
		  "param_name" => "custom_marker",
		  "admin_label" => true,
		  "value" => '',
		  "description" => __('Upload a custom marker for your address.', "mega")
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable Zoom Control", "mega"),
		  "param_name" => "zoom_control",
		  "description" => __("If selected, zoom control will be enabled.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable Pan Control", "mega"),
		  "param_name" => "pan_control",
		  "description" => __("If selected, pan control will be enabled.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable Type Control", "mega"),
		  "param_name" => "map_type_control",
		  "description" => __("If selected, type control will be enabled.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable Street View Control", "mega"),
		  "param_name" => "street_view_control",
		  "description" => __("If selected, street view control will be enabled.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		//array(
		  //"type" => 'checkbox',
		  //"heading" => __("Enable grayscale", "mega"),
		  //"param_name" => "grayscale",
		  //"description" => __("If selected, grayscale will be enabled.", "mega"),
		  //"value" => Array(__("Yes, please", "mega") => true),
		//),
		//array(
		  //"type" => "colorpicker",
		  //"heading" => __("Hue color", "mega"),
		  //"param_name" => "hue",
		  //"description" => __("Choose a value for hue color.", "mega")
		//),
		array(
		  "type" => "dropdown",
		  "heading" => __("Map Style", "mega"),
		  "param_name" => "style",
		  "value" => array(__("Light Monochrome - Default", "mega") => "light_monochrome", __("Shades of Grey", "mega") => "shades_of_grey")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Extra class name", "mega"),
		  "param_name" => "css_class",
		  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mega")
		)
   )
) );

// Posts Alternative
function mega_posts( $atts, $content = null ) {
	wp_enqueue_script( 'isotope.pkgd.min' );

    extract( shortcode_atts( array(
		'columns' => '3',
		'number' => 12,
		'grid_thumb_size' => 'full',
		'pagination' => '',
		'pagination_align' => '',
		'category' => '',
		'post_in' => '',
		'post_not_in' => '',
		'orderby' => 'date',
		'order' => 'DESC',
		'css_class' => ''
    ), $atts ) );
	
	if ( $columns == 3 ) {
		$posts_columns = 'columns_count_3';
		$post_column_class = 'vc_span4';
	} elseif ( $columns == 4 ) {
		$posts_columns = 'columns_count_4';
		$post_column_class = 'vc_span3';
	} elseif ( $columns == 2 ) {
		$posts_columns = 'columns_count_2';
		$post_column_class = 'vc_span6';
	} elseif ( $columns == 1 ) {
		$posts_columns = 'columns_count_1';
		$post_column_class = 'vc_span12';
	}
	
	if ($pagination!='' && $pagination!='0') {
		$no_found_rows = false;
    } else {
		$no_found_rows = true;
	}
	
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
	
	global $wp_query, $paged, $post;
    $temp = $wp_query;
    $wp_query= null;
	
	$args = array();
	
	$not_in = array();
	if ( $post_not_in != '' ) {
		$post_not_in = str_ireplace(" ", "", $post_not_in);
		$not_in = explode(",", $post_not_in);
	}
	
	if ( $post_in == '' ) {
		global $post;
		array_push($not_in, $post->ID);
	}
	else if ( $post_in != '' ) {
		$post_in = str_ireplace(" ", "", $post_in);
		$args['post__in'] = explode(",", $post_in);
	}
	if ( $post_in == '' || $post_not_in != '' ) {
		$args['post__not_in'] = $not_in;
	}
	
	if ( $orderby != NULL ) {
		$args['orderby'] = $orderby;
	}
	$args['order'] = $order;
	
	$args['post_type'] = 'post';
	$args['category'] = $category;
	$args['posts_per_page'] = $number;
	$args['paged'] = $paged;
	$args['no_found_rows'] = $no_found_rows;
	$args['post_status'] = 'publish';
	
	// Run query
	$wp_query = new WP_Query($args);
	ob_start();
    ?>
	
	<?php
	if ($pagination_align!='' && $pagination_align!='0') {
		$pagination_align_class = 'pagination-center';
	} else {
		$pagination_align_class = 'pagination-right';
	}
	?>
	
	<div class="wpb_teaser_grid wpb_content_element wpb_grid-alternative wpb_teaser_grid_post <?php echo sanitize_html_class( $posts_columns ); ?> <?php echo sanitize_html_class( $pagination_align_class ); ?> <?php echo sanitize_html_class( $css_class ); ?> clearfix">
		<div class="wpb_wrapper">
		<div class="teaser_grid_container clearfix">
			<div class="mt-loader spinner3"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
			<ul class="wpb_thumbnails-alternative wpb_thumbnails-fluid clearfix" data-layout-mode="masonry">
			<div class="grid-sizer"></div>
			<div class="gutter-sizer"></div>
			
				<?php if ( $wp_query->have_posts() ) : ?>
			
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<?php
						$post_id = $wp_query->post->ID;
						$thumbnail = '';
						
						$post_thumbnail = $p_img_large = '';

						$post_thumbnail = wpb_getImageBySize(array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size ));
						$thumbnail = $post_thumbnail['thumbnail'];
						$p_img_large = $post_thumbnail['p_img_large'];
						?>
					
						<?php if ( $columns == 1 ) { ?>
							<?php global $more; ?>
							<?php $more = 0; ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php } else { ?>
							<li id="post-<?php the_ID(); ?>" class="isotope-item <?php echo sanitize_html_class( $post_column_class ); ?> clearfix">
							<?php if ( $thumbnail ) { ?>
								<div class="post-thumb">
									<a class="link_image" href="<?php the_permalink(); ?>" rel="bookmark">
										<?php echo $thumbnail; ?>
									</a>
								</div><!-- .post-thumb -->
							<?php } ?>
							<div class="hentry-text-wrapper">
								<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<?php $categories = get_the_category_list( __( ', ', 'mega' ) ); ?>
								<div class="entry-meta">
									<span class="entry-date"><?php echo esc_html( get_the_date() ); ?></span><span class="sep">|</span><?php echo $categories; ?>
								</div>
								<?php $content = apply_filters('the_excerpt', get_the_excerpt()); ?>
								<?php $content = wpautop($content); ?>
								<?php $link = ''; ?>
								<?php
								// Read more link
								$link = '<a class="more-link" href="'. esc_url( get_permalink() ) .'">'. __("Read more", "mega") .' <i>&rarr;</i></a>';
								?>
								<div class="entry-content"><?php echo $content; ?></div><div class="more-link-wrapper"><?php echo $link; ?></div>
							</div>
							</li><!-- #post-<?php the_ID(); ?> -->
						<?php } ?>
					<?php endwhile; ?>
					
				<?php endif; ?>
			</ul>
		</div><!-- .teaser_grid_container -->
		
		<?php if ($pagination!='' && $pagination!='0') { ?>
			<?php mega_pagination_content_nav( 'nav-pagination' ); ?>
		<?php } ?>
		
		<?php wp_reset_query(); ?>
	
	</div><!-- .wpb_wrapper -->
	</div><!-- .wpb_teaser_grid -->
	
    <?php $wp_query = null; $wp_query = $temp;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode( 'posts', 'mega_posts' );

vc_map( array(
   "name" => __("Posts Alternative", "mega"),
   "base" => "posts",
   "class" => "",
   "icon" => "icon-wpb-vc_posts_alternative",
   "category" => __('Content', "mega"),
   //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/assets/css/js_composer_extend.css'),
   "params" => array(
		array(
		  "type" => "dropdown",
		  "heading" => __("Columns count", "mega"),
		  "param_name" => "columns",
		  "value" => array(__("3 - Default", "mega") => 3, 1),
		  "description" => __('Select columns count.', "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Posts items count", "mega"),
		  "param_name" => "number",
		  "admin_label" => true,
		  "value" => 12,
		  "description" => __('Enter posts items count.', "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Thumbnail size", "js_composer"),
		  "param_name" => "grid_thumb_size",
		  "description" => __('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).', "mega")
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable pagination", "mega"),
		  "param_name" => "pagination",
		  "description" => __("If selected, pagination will be enabled.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Center pagination", "mega"),
		  "param_name" => "pagination_align",
		  "description" => __("If selected, pagination will be centered.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Categories", "mega"),
		  "param_name" => "category",
		  "description" => __("If you want to narrow output, enter category slugs here. Note: Only listed categories will be included. Divide categories with commas.", "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Posts items IDs", "mega"),
		  "param_name" => "post_in",
		  "description" => __('Fill this field with posts items IDs separated by commas (,) to retrieve only them.', "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Exclude posts items IDs", "mega"),
		  "param_name" => "post_not_in",
		  "description" => __('Fill this field with posts items IDs separated by commas (,) to exclude them from query.', "mega")
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Order by", "mega"),
		  "param_name" => "orderby",
		  "value" => array( __("Date", "mega") => "date", __("ID", "mega") => "ID", __("Title", "mega") => "title", __("Random", "mega") => "rand" ),
		  "description" => sprintf(__('Select how to sort retrieved posts. More at %s.', 'mega'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Order way", "mega"),
		  "param_name" => "order",
		  "value" => array( __("Descending", "mega") => "DESC", __("Ascending", "mega") => "ASC" ),
		  "description" => sprintf(__('Designates the ascending or descending order. More at %s.', 'mega'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Extra class name", "mega"),
		  "param_name" => "css_class",
		  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mega")
		)
   )
) );

// Portfolio Alternative
function mega_portfolio( $atts, $content = null ) {
	wp_enqueue_script( 'isotope.pkgd.min' );
	wp_enqueue_script( 'jquery.portfolio' );

    extract( shortcode_atts( array(
        'filter' => '',
		'filter_align' => '',
		'columns' => '4',
		'number' => 12,
		'grid_thumb_size' => 'large',
		'meta_data' => '',
		'margin' => 20,
		'full_width' => '',
		'pagination' => '',
		'style' => '1',
		'category' => '',
		'post_in' => '',
		'post_not_in' => '',
		'orderby' => 'date',
		'order' => 'DESC',
		'animation' => '',
		'portfolio_50_width_enable' => '',
		'css_class' => ''
    ), $atts ) );
	
	if ( $style == '2' ) {
		wp_enqueue_script( 'jquery.fancybox.pack' );
	}
	//wp_enqueue_script( 'jquery.fancybox-media' );
	
	if ( $columns == 3 ) {
		$portfolio_columns = 'col3';
	} elseif ( $columns == 4 ) {
		$portfolio_columns = 'col4';
	} elseif ( $columns == 5 ) {
		$portfolio_columns = 'col5';
	}
	
	if ( $style == '2' || $style == '3' || $style == '4' ) {
		$portfolio_title_position_class = 'title-visible';
	} else {
		$portfolio_title_position_class = 'title-hidden';
	}
	
	if ( $margin == 0 ) {
		$portfolio_margin = 'margin0';
	} else {
		$portfolio_margin = 'margin20';
	}
	
	if ($full_width!='' && $full_width!='0') {
		$portfolio_full_width_class = 'full-width';
	} else {
		$portfolio_full_width_class = 'default-width';
	}
	
	if ($pagination!='' && $pagination!='0') {
       $no_found_rows = false;
    } else {
		$no_found_rows = true;
	}
	
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
	
	global $wp_query, $paged, $post;
    $temp = $wp_query;
    $wp_query= null;
	
	$args = array();
	
	$not_in = array();
	if ( $post_not_in != '' ) {
		$post_not_in = str_ireplace(" ", "", $post_not_in);
		$not_in = explode(",", $post_not_in);
	}
	
	if ( $post_in == '' ) {
		global $post;
		array_push($not_in, $post->ID);
	}
	else if ( $post_in != '' ) {
		$post_in = str_ireplace(" ", "", $post_in);
		$args['post__in'] = explode(",", $post_in);
	}
	if ( $post_in == '' || $post_not_in != '' ) {
		$args['post__not_in'] = $not_in;
	}
	
	if ( $orderby != NULL ) {
		$args['orderby'] = $orderby;
	}
	$args['order'] = $order;
	
	$args['post_type'] = 'portfolio';
	$args['portfolio-category'] = $category;
	$args['posts_per_page'] = $number;
	$args['paged'] = $paged;
	$args['no_found_rows'] = $no_found_rows;
	$args['post_status'] = 'publish';
	$wp_query = new WP_Query($args);
	ob_start();
    ?>
	
	<?php if ($animation!='' && $animation!='0') {
		wp_enqueue_script( 'waypoints' );
		$Animation = 'mt-animate_when_almost_visible-enabled';
	} else {
		$Animation = 'mt-animate_when_almost_visible-disabled';
	}
	?>
	
	<?php if ($portfolio_50_width_enable!='' && $portfolio_50_width_enable!='0') {
		$Portfolio_50_width_enable = 'portfolio-50-width-enabled';
	} else {
		$Portfolio_50_width_enable = 'portfolio-50-width-disabled';
	}
	?>
	
	<div id="block-portfolio" class="<?php echo sanitize_html_class( $portfolio_full_width_class ); ?> <?php echo sanitize_html_class( $css_class ); ?> clearfix" data-columns="<?php echo esc_attr( $portfolio_columns ); ?>">
	
		<?php if ($filter!='' && $filter!='0') { ?>
			<?php
			if ($filter_align!='' && $filter_align!='0') {
				$filter_align_class = 'filter-center';
			} else {
				$filter_align_class = 'filter-left';
			}
			 ?>
					
		<?php $wp_list_categories = wp_list_categories( array( 'title_li' => '', 'show_option_none' => '', 'taxonomy' => 'portfolio-category', 'walker' => new Mega_Walker_Portfolio_Category(), 'orderby' => 'name', 'style' => 'none', 'echo' => 0 ) ); ?>
						
		<?php if ( ! empty( $wp_list_categories ) ) : ?>
						
			<nav id="filters" class="<?php echo sanitize_html_class( $portfolio_full_width_class ); ?> <?php echo sanitize_html_class( $filter_align_class ); ?> option-set">
				<div>
				<?php $sep = '<span class="sep"></span>'; ?>
				<?php $wp_list_categories = str_replace( '<br />', $sep, $wp_list_categories ); ?>
				<a href="#" data-filter="*" class="selected"><?php echo __( 'All', 'mega' ) ?></a>
				<?php echo $sep; ?>						
				
				<?php
				if ( $sep != '' ) {
					$wp_list_categories = strrev( $wp_list_categories );
					$sep = strrev( $sep );
					$wp_list_categories = explode( $sep, $wp_list_categories, 2 );
					$wp_list_categories = implode( '', $wp_list_categories );
					$wp_list_categories = strrev( $wp_list_categories );
				}
				?>	
												
				<?php echo $wp_list_categories; ?>
				</div>
			</nav>
						
		<?php endif; // End if ( ! empty( $wp_list_categories ) ) ?>
						
	<?php } // End if ($filter!='' && $filter!='0') ?>
	
		<div class="mt-loader spinner3"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
		<div id="portfolio" class="<?php echo sanitize_html_class( $portfolio_columns ); ?> <?php echo sanitize_html_class( $portfolio_title_position_class ); ?> <?php echo sanitize_html_class( $portfolio_margin ); ?> <?php echo sanitize_html_class( $Animation ); ?> <?php echo sanitize_html_class( $Portfolio_50_width_enable ); ?> clearfix">
		<div class="grid-sizer"></div>
		<div class="gutter-sizer"></div>
			<?php if ( $wp_query->have_posts() ) : ?>
		
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				
					<?php
					$post_id = $wp_query->post->ID;
					$thumbnail = '';
						
					$post_thumbnail = $p_img_large = '';

					$post_thumbnail = wpb_getImageBySize(array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size ));
					$thumbnail = $post_thumbnail['thumbnail'];
					$p_img_large = $post_thumbnail['p_img_large'];
					?>
					
					<?php $portfolio_custom_url = get_post_meta( get_the_ID(), 'portfolio_custom_url', true ); ?>
				
					<?php if ( $style == '2' ) { ?>
						
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
								<div class="content-wrapper">
									<?php if ( $thumbnail ) { ?>
										<div class="post-thumbnail clearfix">
										<?php $portfolio_highlight_text_color = get_post_meta( get_the_ID(), 'portfolio_highlight_text_color', true ); ?>
										<?php $portfolio_highlight_background_color = get_post_meta( get_the_ID(), 'portfolio_highlight_background_color', true ); ?>
										<?php $portfolio_image_lightbox = get_post_meta( get_the_ID(), 'portfolio_image_lightbox', true ); ?>
										<?php $rgb = mega_hex2rgb( $portfolio_highlight_background_color ); ?>
										<?php $opacity = .8; ?>
										<?php $rgba = "rgba(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ", " . $opacity . ")"; ?>
												<?php echo $thumbnail; ?>
												<div class="portfolio-view-wrapper">
													<div class="portfolio-bg" style="background-color: <?php echo esc_attr( $portfolio_highlight_background_color ); ?>; background-color: <?php echo esc_attr( $rgba ); ?>; color: <?php echo esc_attr( $portfolio_highlight_text_color ); ?>;"></div>
														<div class="portfolio-view-content">
															<div class="portfolio-view-animate">
																<header class="entry-header">
																	<a class="wpb_button_a" href="<?php if ( ! empty( $portfolio_custom_url ) ) echo esc_url( $portfolio_custom_url ); else the_permalink(); ?>" <?php if ( ! empty( $portfolio_custom_url ) ) echo 'target="_blank"'?>><?php _e("View", "mega"); ?></a>
																	<a class="wpb_button_a fb-lightbox" href="<?php echo esc_url( $portfolio_image_lightbox ); ?>" rel="fb-gallery" data-caption="<?php the_title(); ?>"><?php _e("Zoom", "mega"); ?></a>
																</header><!-- .entry-header -->
															</div>
														</div>
												</div>
										</div>
									<?php } ?>
												<header class="entry-header">
													<a class="content-wrapper" href="<?php if ( ! empty( $portfolio_custom_url ) ) { echo esc_url( $portfolio_custom_url ); } else { the_permalink(); } ?>" <?php if ( ! empty( $portfolio_custom_url ) ) { ?>target="_blank" <?php } ?>>
														<h2><?php the_title(); ?></h2>
													</a>
												</header><!-- .entry-header -->
											<?php if ( $meta_data == 'Categories' ) { ?>
												<div class="entry-category"><?php echo mega_custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
											<?php } else if ( $meta_data == 'Excerpt' ) { ?>
												<div class="entry-excerpt"><?php the_excerpt(); ?></div>
											<?php } else if ( $meta_data == 'Both' ) { ?>
												<div class="entry-excerpt"><?php the_excerpt(); ?></div>
												<div class="entry-category"><?php echo mega_custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
											<?php } ?>
								</div><!-- .content-wrapper -->
							</article><!-- #post-<?php the_ID(); ?> -->
							
						<?php } else if ( $style == '3' ) { ?>
						
								
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
								<div class="browser-bar"><div class="browser-button"></div><div class="browser-button"></div><div class="browser-button"></div></div>
								<a class="content-wrapper" href="<?php if ( ! empty( $portfolio_custom_url ) ) { echo esc_url( $portfolio_custom_url ); } else { the_permalink(); } ?>" <?php if ( ! empty( $portfolio_custom_url ) ) { ?>target="_blank" <?php } ?>>
									<?php if ( $thumbnail ) { ?>
										<div class="post-thumbnail clearfix">
										<?php $portfolio_highlight_text_color = get_post_meta( get_the_ID(), 'portfolio_highlight_text_color', true ); ?>
										<?php $portfolio_highlight_background_color = get_post_meta( get_the_ID(), 'portfolio_highlight_background_color', true ); ?>
										<?php $rgb = mega_hex2rgb( $portfolio_highlight_background_color ); ?>
										<?php $opacity = .8; ?>
										<?php $rgba = "rgba(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ", " . $opacity . ")"; ?>
												<?php echo $thumbnail; ?>
										</div>
									<?php } ?>
												<header class="entry-header portfolio-data">
													<h2><?php the_title(); ?></h2>
												</header><!-- .entry-header -->
											<?php if ( $meta_data == 'Categories' ) { ?>
												<div class="entry-category"><?php echo mega_custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
											<?php } else if ( $meta_data == 'Excerpt' ) { ?>
												<div class="entry-excerpt"><?php the_excerpt(); ?></div>
											<?php } else if ( $meta_data == 'Both' ) { ?>
												<div class="entry-excerpt"><?php the_excerpt(); ?></div>
												<div class="entry-category"><?php echo mega_custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
											<?php } ?>
								</a><!-- .content-wrapper -->
							</article><!-- #post-<?php the_ID(); ?> -->
							
						
						<?php } else if ( $style == '4' ) { ?>
						
								
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
								<a class="content-wrapper" href="<?php if ( ! empty( $portfolio_custom_url ) ) { echo esc_url( $portfolio_custom_url ); } else { the_permalink(); } ?>" <?php if ( ! empty( $portfolio_custom_url ) ) { ?>target="_blank" <?php } ?>>
									<?php if ( $thumbnail ) { ?>
										<div class="post-thumbnail clearfix">
										<?php $portfolio_highlight_text_color = get_post_meta( get_the_ID(), 'portfolio_highlight_text_color', true ); ?>
										<?php $portfolio_highlight_background_color = get_post_meta( get_the_ID(), 'portfolio_highlight_background_color', true ); ?>
										<?php $rgb = mega_hex2rgb( $portfolio_highlight_background_color ); ?>
										<?php $opacity = .8; ?>
										<?php $rgba = "rgba(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ", " . $opacity . ")"; ?>
												<?php echo $thumbnail; ?>
										</div>
									<?php } ?>
												<header class="entry-header portfolio-data">
													<h2><?php the_title(); ?></h2>
												</header><!-- .entry-header -->
											<?php if ( $meta_data == 'Categories' ) { ?>
												<div class="entry-category"><?php echo mega_custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
											<?php } else if ( $meta_data == 'Excerpt' ) { ?>
												<div class="entry-excerpt"><?php the_excerpt(); ?></div>
											<?php } else if ( $meta_data == 'Both' ) { ?>
												<div class="entry-excerpt"><?php the_excerpt(); ?></div>
												<div class="entry-category"><?php echo mega_custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
											<?php } ?>
								</a><!-- .content-wrapper -->
							</article><!-- #post-<?php the_ID(); ?> -->
							
								
						
						<?php } else { ?>
						
							
							<?php $portfolio_50_width = get_post_meta( get_the_ID(), 'portfolio_50_width', true ); ?>
							<?php if ($portfolio_50_width_enable!='' && $portfolio_50_width_enable!='0') { ?>
								<?php if ( ! empty( $portfolio_50_width ) ) { ?>
									<?php $portfolio_50_width = 'portfolio-50-width'; ?>
								<?php }?>
							<?php } ?>
							<?php
							$classes = array(
								'clearfix',
								$portfolio_50_width
							);
							?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
								<div class="content-wrapper">
									<?php if ( $thumbnail ) { ?>
										<div class="post-thumbnail clearfix">
										<?php $portfolio_highlight_text_color = get_post_meta( get_the_ID(), 'portfolio_highlight_text_color', true ); ?>
										<?php $portfolio_highlight_background_color = get_post_meta( get_the_ID(), 'portfolio_highlight_background_color', true ); ?>
										<?php $rgb = mega_hex2rgb( $portfolio_highlight_background_color ); ?>
										<?php $opacity = .8; ?>
										<?php $rgba = "rgba(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ", " . $opacity . ")"; ?>
										<a class="content-wrapper" href="<?php if ( ! empty( $portfolio_custom_url ) ) { echo esc_url( $portfolio_custom_url ); } else { the_permalink(); } ?>" <?php if ( ! empty( $portfolio_custom_url ) ) { ?>target="_blank" <?php } ?>>
												<?php echo $thumbnail; ?>
												<div class="portfolio-view-wrapper">
													<div class="portfolio-bg" style="background-color: <?php echo esc_attr( $portfolio_highlight_background_color ); ?>; background-color: <?php echo esc_attr( $rgba ); ?>; color: <?php echo esc_attr( $portfolio_highlight_text_color ); ?>;"></div>
														<div class="portfolio-view-content">
															<div class="portfolio-view-animate">
																<header class="entry-header">
																	<h2><?php the_title(); ?></h2>
																</header><!-- .entry-header -->
																<?php if ( $meta_data == 'Categories' ) { ?>
																	<div class="entry-category" style="color: <?php echo esc_attr( $portfolio_highlight_text_color ); ?>;"><?php echo mega_custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
																<?php } else if ( $meta_data == 'Excerpt' ) { ?>
																	<div class="entry-excerpt" style="color: <?php echo esc_attr( $portfolio_highlight_text_color ); ?>;"><?php the_excerpt(); ?></div>
																<?php } else if ( $meta_data == 'Both' ) { ?>
																	<div class="entry-excerpt" style="color: <?php echo esc_attr( $portfolio_highlight_text_color ); ?>;"><?php the_excerpt(); ?></div>
																	<div class="entry-category" style="color: <?php echo esc_attr( $portfolio_highlight_text_color ); ?>;"><?php echo mega_custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
																<?php } ?>
															</div>
														</div>
												</div>
											</a>
										</div>
									<?php } ?>
								</div><!-- .content-wrapper -->
							</article><!-- #post-<?php the_ID(); ?> -->
							
							
						<?php //} ?>
					<?php } ?>
				<?php endwhile; ?>
				
			<?php endif; ?>
		
		</div><!-- #portfolio -->
		
		<?php if ($pagination!='' && $pagination!='0') { ?>
			<?php mega_pagination_content_nav( 'nav-pagination' ); ?>
		<?php } ?>
		
		<?php wp_reset_query(); ?>
	
	</div><!-- #block-portfolio -->
	
    <?php $wp_query = null; $wp_query = $temp;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode( 'portfolio', 'mega_portfolio' );

vc_map( array(
   "name" => __("Portfolio Alternative", "mega"),
   "base" => "portfolio",
   "class" => "",
   "icon" => "icon-wpb-vc_portfolio_alternative",
   "category" => __('Content', "mega"),
   //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/assets/css/js_composer_extend.css'),
   "params" => array(
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable filter", "mega"),
		  "param_name" => "filter",
		  "description" => __("If selected, filter will be enabled.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Center filter", "mega"),
		  "param_name" => "filter_align",
		  "description" => __("If selected, filter will be centered.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Columns count", "mega"),
		  "param_name" => "columns",
		  "value" => array(__("4 - Default", "mega") => 4, 3),
		  "description" => __('Select columns count.', "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Portfolio items count", "mega"),
		  "param_name" => "number",
		  "admin_label" => true,
		  "value" => 12,
		  "description" => __('Enter portfolio items count.', "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Thumbnail size", "js_composer"),
		  "param_name" => "grid_thumb_size",
		  "description" => __('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).', "mega")
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Portfolio Meta", "mega"),
		  "param_name" => "meta_data",
		  "value" => array(__("Excerpt - Default", "mega") => __("Excerpt", "mega"), __("Both", "mega"), __("Categories", "mega"), __("None", "mega")),
		  "description" => __('Select what information to display for each portfolio item just under their title.', "mega")
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Margin between portfolio items", "mega"),
		  "param_name" => "margin",
		  "value" => array(__("20 - Default", "mega") => 20, 0),
		  "description" => __('Select margin between portfolio items.', "mega")
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable full width", "mega"),
		  "param_name" => "full_width",
		  "description" => __("If selected, full width will be enabled.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable pagination", "mega"),
		  "param_name" => "pagination",
		  "description" => __("If selected, pagination will be enabled.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Portfolio style", "mega"),
		  "param_name" => "style",
		  "value" => array(__("1 - Default", "mega") => 1, 2, 3, 4),
		  "description" => __('Select style for portfolio items.', "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Categories", "mega"),
		  "param_name" => "category",
		  "description" => __("If you want to narrow output, enter category slugs here. Note: Only listed categories will be included. Divide categories with commas.", "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Portfolio items IDs", "mega"),
		  "param_name" => "post_in",
		  "description" => __('Fill this field with portfolio items IDs separated by commas (,) to retrieve only them.', "mega")
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Exclude portfolio items IDs", "mega"),
		  "param_name" => "post_not_in",
		  "description" => __('Fill this field with portfolio items IDs separated by commas (,) to exclude them from query.', "mega")
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Order by", "mega"),
		  "param_name" => "orderby",
		  "value" => array( __("Date", "mega") => "date", __("ID", "mega") => "ID", __("Title", "mega") => "title", __("Random", "mega") => "rand" ),
		  "description" => sprintf(__('Select how to sort retrieved posts. More at %s.', 'mega'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Order way", "mega"),
		  "param_name" => "order",
		  "value" => array( __("Descending", "mega") => "DESC", __("Ascending", "mega") => "ASC" ),
		  "description" => sprintf(__('Designates the ascending or descending order. More at %s.', 'mega'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable animation", "mega"),
		  "param_name" => "animation",
		  "description" => __("Select animation if you want portfolio to be animated when it enters into the browsers viewport.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => 'checkbox',
		  "heading" => __("Enable portfolio 50% width", "mega"),
		  "param_name" => "portfolio_50_width_enable",
		  "description" => __("Select if you want enable 50% width for portfolio items.", "mega"),
		  "value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Extra class name", "mega"),
		  "param_name" => "css_class",
		  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mega")
		)
   )
) );

// Image Gallery Alternative
function mega_gallery_alternative( $atts, $content = null ) {
	wp_enqueue_script( 'jquery.magnific-popup.min' );
	wp_enqueue_script( 'isotope.pkgd.min' );
	wp_enqueue_script( 'jquery.gallery' );

    extract( shortcode_atts( array(
		'img_size' => 'full',
		'images' => '',
		'columns' => '',
		'randomize' => '',
		'caption' => '',
		'css_class' => '',
    ), $atts ) );
	
	if ( $columns == 5 ) {
		$columns_class = 'col5';
	} elseif ( $columns == 6 ) {
		$columns_class = 'col6';
	} elseif ( $columns == 7 ) {
		$columns_class = 'col7';
	} elseif ( $columns == 8 ) {
		$columns_class = 'col8';
	}
    ?>
	
	<div id="block-gallery-alternative" class="<?php echo sanitize_html_class( $columns_class ); ?> <?php echo sanitize_html_class( $css_class ); ?> clearfix">
	
		<div class="mt-loader spinner3"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
		<div id="gallery-alternative" class="clearfix">
		<div class="grid-sizer"></div>
		<div class="gutter-sizer"></div>
		<?php
		if ( $images == '' ) $images = '-1,-2,-3';

		$images = explode( ',', $images );


// Randomize images
if ( ! empty( $randomize ) ) {
	shuffle($images);
}


$i = - 1;

foreach ( $images as $attach_id ) {
	$i ++;
	if ( $attach_id > 0 ) {
		$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ) );
	} else {
		$post_thumbnail = array();
		$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
		$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
	}

	$thumbnail = $post_thumbnail['thumbnail'];
	?>
	
	<?php //$gallery_image_src = wp_get_attachment_image_src( $attach_id, $img_size ); ?>
	<?php $gallery_image_src_full = wp_get_attachment_image_src( $attach_id, 'full' ); ?>
	<?php $attachment = get_post( $attach_id ); ?>
	<?php $attachment_title = apply_filters( 'the_title', $attachment->post_title ); ?>
	<?php $attachment_caption = apply_filters( 'the_title', $attachment->post_excerpt ); ?>
	
	<div class="gallery-alternative-item">
		<a class="magnificpopup" href="<?php echo esc_url( $gallery_image_src_full[0] ); ?>" <?php if ( $caption == 'title' ) { echo 'data-attribute-caption="'. esc_attr( $attachment_title ) .'"'; } else if ( $caption == 'caption' ) { echo 'data-attribute-caption="'. esc_attr( $attachment_caption ) .'"'; } ?>>
			<?php echo $thumbnail; ?>
		</a>
	</div>
<?php } ?>
		
		</div><!-- #gallery-alternative -->
	</div><!-- #block-gallery-alternative -->
	
    <?php
}
add_shortcode( 'gallery_alternative', 'mega_gallery_alternative' );

vc_map( array(
	'name' => __( 'Image Gallery Alternative', 'mega' ),
	'base' => 'gallery_alternative',
	'icon' => 'icon-wpb-images-stack',
	'category' => __( 'Content', 'mega' ),
	'description' => __( 'Responsive image gallery', 'mega' ),
	'params' => array(
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'mega' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'mega' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'mega' ),
			'param_name' => 'img_size',
			'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size.', 'mega' )
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Columns count", "mega"),
		  "param_name" => "columns",
		  "value" => array(__("6 - Default", "mega") => 6, 5, 7, 8),
		  "description" => __('Select columns count.', "mega")
		),
		array(
			"type" => 'checkbox',
			"heading" => __("Randomize images", "mega"),
			"param_name" => "randomize",
			"description" => __("If selected, images will be randomized.", "mega"),
			"value" => Array(__("Yes, please", "mega") => true),
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Attribute of the target element that contains caption", "mega"),
		  "param_name" => "caption",
		  "value" => array( __("None", "mega") => "none", __("Title", "mega") => "title", __("Caption", "mega") => "caption", ),
		  "description" => __( 'Attribute of the target element that contains caption.', 'mega' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'mega' ),
			'param_name' => 'css_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'mega' )
		)
	)
) );

// Images
function mega_add_vc_gallery_link_magnificpopup() {
	$param = WPBMap::getParam('vc_gallery', 'onclick');
	$param['value'][__('Open magnificPopup', 'mega')] = 'link_magnificpopup';
	WPBMap::mutateParam('vc_gallery', $param);
}
add_action('init', 'mega_add_vc_gallery_link_magnificpopup');

function mega_add_vc_gallery_type_single_column() {
	$param = WPBMap::getParam('vc_gallery', 'type');
	$param['value'][__('Single Column', 'mega')] = 'single_column';
	WPBMap::mutateParam('vc_gallery', $param);
}
add_action('init', 'mega_add_vc_gallery_type_single_column');

function mega_add_vc_gallery_type_r_slider() {
	$param = WPBMap::getParam('vc_gallery', 'type');
	$param['value'][__('R Slider', 'mega')] = 'r_slider';
	WPBMap::mutateParam('vc_gallery', $param);
}
add_action('init', 'mega_add_vc_gallery_type_r_slider');

// Image Gallery
vc_add_param( 'vc_gallery', array(
	"type" => "checkbox",
	"heading" => __("Randomize images", "mega"),
	"param_name" => "randomize",
	"value" => Array(__("Yes, please", "mega") => true),
	"description" => __("If selected, images will be randomized.", "mega")
) );

// Testimonials
require_once vc_path_dir('SHORTCODES_DIR', 'vc-tab.php');
class WPBakeryShortCode_VC_Testimonials_tab extends WPBakeryShortCode_VC_Tab {
	protected $controls_css_settings = 'tc vc_control-container';
	protected $controls_list = array('add', 'edit', 'clone', 'delete');
	protected $predefined_atts = array(
		'el_class' => '',
		'width' => '',
		'title' => ''
	);

	public function contentAdmin( $atts, $content = null ) {
		$width = $el_class = $title = '';
		extract( shortcode_atts( $this->predefined_atts, $atts ) );
		$output = '';

		$column_controls = $this->getColumnControls( $this->settings( 'controls' ) );
		$column_controls_bottom = $this->getColumnControls( 'add', 'bottom-controls' );

		if ( $width == 'column_14' || $width == '1/4' ) {
			$width = array( 'vc_col-sm-3' );
		} else if ( $width == 'column_14-14-14-14' ) {
			$width = array( 'vc_col-sm-3', 'vc_col-sm-3', 'vc_col-sm-3', 'vc_col-sm-3' );
		} else if ( $width == 'column_13' || $width == '1/3' ) {
			$width = array( 'vc_col-sm-4' );
		} else if ( $width == 'column_13-23' ) {
			$width = array( 'vc_col-sm-4', 'vc_col-sm-8' );
		} else if ( $width == 'column_13-13-13' ) {
			$width = array( 'vc_col-sm-4', 'vc_col-sm-4', 'vc_col-sm-4' );
		} else if ( $width == 'column_12' || $width == '1/2' ) {
			$width = array( 'vc_col-sm-6' );
		} else if ( $width == 'column_12-12' ) {
			$width = array( 'vc_col-sm-6', 'vc_col-sm-6' );
		} else if ( $width == 'column_23' || $width == '2/3' ) {
			$width = array( 'vc_col-sm-8' );
		} else if ( $width == 'column_34' || $width == '3/4' ) {
			$width = array( 'vc_col-sm-9' );
		} else if ( $width == 'column_16' || $width == '1/6' ) {
			$width = array( 'vc_col-sm-2' );
		} else {
			$width = array( '' );
		}
		for ( $i = 0; $i < count( $width ); $i ++ ) {
			$output .= '<div class="group wpb_sortable">';
			$output .= '<h3><span class="tab-label"><%= params.title %></span></h3>';
			$output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';
			$output .= str_replace( "%column_size%", wpb_translateColumnWidthToFractional( $width[$i] ), $column_controls );
			$output .= '<div class="wpb_element_wrapper">';
			$output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';
			$output .= do_shortcode( shortcode_unautop( $content ) );
			$output .= '</div>';
			if ( isset( $this->settings['params'] ) ) {
				$inner = '';
				foreach ( $this->settings['params'] as $param ) {
					$param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key = key( $param_value );
						$param_value = $param_value[$first_key];
					}
					$inner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				$output .= $inner;
			}
			$output .= '</div>';
			$output .= str_replace( "%column_size%", wpb_translateColumnWidthToFractional( $width[$i] ), $column_controls_bottom );
			$output .= '</div>';
			$output .= '</div>';
		}
		return $output;
	}

	public function mainHtmlBlockParams( $width, $i ) {
		return 'data-element_type="' . $this->settings["base"] . '" class=" wpb_' . $this->settings['base'] . '"' . $this->customAdminBlockParams();
	}

	public function containerHtmlBlockParams( $width, $i ) {
		return 'class="wpb_column_container vc_container_for_children"';
	}

	public function contentAdmin_old( $atts, $content = null ) {
		$width = $el_class = $title = '';
		extract( shortcode_atts( $this->predefined_atts, $atts ) );
		$output = '';
		$column_controls = $this->getColumnControls( $this->settings( 'controls' ) );
		for ( $i = 0; $i < count( $width ); $i ++ ) {
			$output .= '<div class="group wpb_sortable">';
			$output .= '<div class="wpb_element_wrapper">';
			$output .= '<div class="vc_row-fluid wpb_row_container">';
			$output .= '<h3><a href="#">' . $title . '</a></h3>';
			$output .= '<div ' . $this->customAdminBockParams() . ' data-element_type="' . $this->settings["base"] . '" class=" wpb_' . $this->settings['base'] . ' wpb_sortable">';
			$output .= '<div class="wpb_element_wrapper">';
			$output .= '<div class="vc_row-fluid wpb_row_container">';
			$output .= do_shortcode( shortcode_unautop( $content ) );
			$output .= '</div>';
			if ( isset( $this->settings['params'] ) ) {
				$inner = '';
				foreach ( $this->settings['params'] as $param ) {
					$param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key = key( $param_value );
						$param_value = $param_value[$first_key];
					}
					$inner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				$output .= $inner;
			}
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
	}

	protected function outputTitle( $title ) {
		return '';
	}

	public function customAdminBlockParams() {
		return '';
	}
}

class WPBakeryShortCode_VC_Testimonials extends WPBakeryShortCode {
	static $filter_added = false;
	protected $controls_css_settings = 'out-tc vc_controls-content-widget';
	protected $controls_list = array('edit', 'clone', 'delete');
	public function __construct( $settings ) {
		parent::__construct( $settings );
		// WPBakeryVisualComposer::getInstance()->addShortCode( array( 'base' => 'vc_testimonials_tab' ) );
		if ( ! self::$filter_added ) {
			$this->addFilter( 'vc_inline_template_content', 'setCustomTabId' );
			self::$filter_added = true;
		}
	}

	public function contentAdmin( $atts, $content = null ) {
		$width = $custom_markup = '';
		$shortcode_attributes = array( 'width' => '1/1' );
		foreach ( $this->settings['params'] as $param ) {
			if ( $param['param_name'] != 'content' ) {
				//$shortcode_attributes[$param['param_name']] = $param['value'];
				if ( isset( $param['value'] ) && is_string( $param['value'] ) ) {
					$shortcode_attributes[$param['param_name']] = __( $param['value'], "mega" );
				} elseif ( isset( $param['value'] ) ) {
					$shortcode_attributes[$param['param_name']] = $param['value'];
				}
			} else if ( $param['param_name'] == 'content' && $content == NULL ) {
				//$content = $param['value'];
				$content = __( $param['value'], "mega" );
			}
		}
		extract( shortcode_atts(
			$shortcode_attributes
			, $atts ) );

		// Extract tab titles

		preg_match_all( '/vc_testimonials_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
		/*
$tab_titles = array();
if ( isset($matches[1]) ) { $tab_titles = $matches[1]; }
*/
		$output = '';
		$tab_titles = array();

		if ( isset( $matches[0] ) ) {
			$tab_titles = $matches[0];
		}
		$tmp = '';
		if ( count( $tab_titles ) ) {
			$tmp .= '<ul class="clearfix tabs_controls">';
			foreach ( $tab_titles as $tab ) {
				preg_match( '/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
				if ( isset( $tab_matches[1][0] ) ) {
					$tmp .= '<li><a href="#tab-' . ( isset( $tab_matches[3][0] ) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) . '">' . $tab_matches[1][0] . '</a></li>';

				}
			}
			$tmp .= '</ul>' . "\n";
		} else {
			$output .= do_shortcode( $content );
		}


		/*
if ( count($tab_titles) ) {
	$tmp .= '<ul class="clearfix">';
	foreach ( $tab_titles as $tab ) {
		$tmp .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
	}
	$tmp .= '</ul>';
} else {
	$output .= do_shortcode( $content );
}
*/
		$elem = $this->getElementHolder( $width );

		$iner = '';
		foreach ( $this->settings['params'] as $param ) {
			$custom_markup = '';
			$param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
			if ( is_array( $param_value ) ) {
				// Get first element from the array
				reset( $param_value );
				$first_key = key( $param_value );
				$param_value = $param_value[$first_key];
			}
			$iner .= $this->singleParamHtmlHolder( $param, $param_value );
		}
		//$elem = str_ireplace('%wpb_element_content%', $iner, $elem);

		if ( isset( $this->settings["custom_markup"] ) && $this->settings["custom_markup"] != '' ) {
			if ( $content != '' ) {
				$custom_markup = str_ireplace( "%content%", $tmp . $content, $this->settings["custom_markup"] );
			} else if ( $content == '' && isset( $this->settings["default_content_in_template"] ) && $this->settings["default_content_in_template"] != '' ) {
				$custom_markup = str_ireplace( "%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"] );
			} else {
				$custom_markup = str_ireplace( "%content%", '', $this->settings["custom_markup"] );
			}
			//$output .= do_shortcode($this->settings["custom_markup"]);
			$iner .= do_shortcode( $custom_markup );
		}
		$elem = str_ireplace( '%wpb_element_content%', $iner, $elem );
		$output = $elem;

		return $output;
	}

	public function getTabTemplate() {
		return '<div class="wpb_template">' . do_shortcode( '[vc_testimonials_tab title="Tab" tab_id=""][/vc_testimonials_tab]' ) . '</div>';
	}

	public function setCustomTabId( $content ) {
		return preg_replace( '/tab\_id\=\"([^\"]+)\"/', 'tab_id="$1-' . time() . '"', $content );
	}
}

vc_map( array(
  "name" => __("Testimonials", "mega"),
  "base" => "vc_testimonials",
  "show_settings_on_create" => false,
  "is_container" => true,
  "icon" => "icon-wpb-ui-accordion",
  "category" => __('Content', 'mega'),
  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/assets/js/composer-custom-views_extend.js'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "mega"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mega")
    ),
	array(
		"type" => 'colorpicker',
		"heading" => __("Dot Navigation Color", "mega"),
		"param_name" => "dot_navigation_color",
		"description" => __("Choose a value for dot navigation color.", "mega"),
	),
	array(
		"type" => 'checkbox',
		"heading" => __("Randomize testimonial order", "mega"),
		"param_name" => "randomize_testimonial_order",
		"description" => __("If selected, testimonial will be randomized.", "mega"),
		"value" => Array(__("Yes, please", "mega") => true),
	),
  ),
  'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . __( 'Add section', 'mega' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . __( 'Add section', 'mega' ) . '</span></a>
</div>
',
  'default_content' => '
  [vc_testimonials_tab title="'.__('Section 1', "mega").'"][/vc_testimonials_tab]
  [vc_testimonials_tab title="'.__('Section 2', "mega").'"][/vc_testimonials_tab]
  ',
  'js_view' => 'VcTestimonialsView'
) );
vc_map( array(
	'name' => __( 'Section', 'mega' ),
	'base' => 'vc_testimonials_tab',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
	 array(
      "type" => "attach_image",
      "heading" => __("Image", "mega"),
      "param_name" => "image",
      "value" => "",
      "description" => __("Select image from media library.", "mega")
    ),
	 array(
      "type" => "textfield",
      "heading" => __("Image size", "mega"),
      "param_name" => "img_size",
      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Name", "mega"),
      "param_name" => "name",
      "description" => __("Enter person name.", "mega")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Title", "mega"),
      "param_name" => "title",
      "description" => __("Enter person title.", "mega")
    ),
	array(
      "type" => "colorpicker",
      "heading" => __("Title color", "mega"),
      "param_name" => "title_color",
      "description" => __("Choose a value for title color.", "mega")
    ),
  ),
  'js_view' => 'VcAccordionTabView'
) );

// Person
function mega_vc_person( $atts, $content = null ) {
	 extract( shortcode_atts( array(
			'image' => '',
			'name' => '',
			'img_size' => 'thumbnail',
			'title' => '',
			'content' => $content,
			'facebook' => '',
	   		'twitter' => '',
			'google_plus' => '',
			'linkedin' => '',
			'dribbble' => '',
			'pinterest' => '',
			'instagram' => '',
			'flickr' => '',
			'tumblr' => '',
			'css_animation' => '',
			'css_class' => '',
		), $atts ) ); 
		
	$img_id = preg_replace('/[^\d]/', '', $image);
	$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
	if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" />';
		
	if ( $css_animation != '' ) {
        wp_enqueue_script( 'waypoints' );
        $CSSAnimation = ' wpb_animate_when_almost_visible wpb_'.$css_animation;
    } else {
		$CSSAnimation = 'no-animation';
	}
	
	$output = '';
	$output .= '<div class="person '. $CSSAnimation .' '. $css_class .'">';
	$output .= '<div class="person-img-wrapper clearfix">';
		$output .= $img['thumbnail'];
	$output .= '</div>';
		$output .= '<div class="person-desc-wrapper">';
		$output .= '<div>';
		$output .= '<div class="person-desc-bg"></div>';
		$output .= '<div class="person-desc">';
			$output .= '<div class="person-author clearfix">';
				$output .= '<div class="person-author-wrapper"><h3 class="person-name">' . $name . '</h3>';
				$output .= '<span class="person-title">' . $title . '</span></div>';
				
			$output .= '</div>';
			$output .= '<div class="person-content">' . wpb_js_remove_wpautop($content, true) . '</div>';
			
			$output .= '<ul class="clearfix">';
				
				if ( ! empty( $facebook ) ) {
					$output .= '<li><a class="social facebook" href="' . $facebook . '">
						<span class="social-icon"></span>
					</a></li>';
				}
					
				if ( ! empty( $twitter ) ) {
					$output .= '<li><a class="social twitter" href="' . $twitter . '">
						<span class="social-icon"></span>
					</a></li>';
				}
				
				if ( ! empty( $google_plus ) ) {
					$output .= '<li><a class="social gplus" href="' . $google_plus . '">
						<span class="social-icon"></span>
					</a></li>';
				}
					
				if ( ! empty( $linkedin ) ) {
					$output .= '<li><a class="social linkedin" href="' . $linkedin . '">
						<span class="social-icon"></span>
					</a></li>';
				}
					
				if ( ! empty( $dribbble ) ) {
					$output .= '<li><a class="social dribbble" href="' . $dribbble . '">
						<span class="social-icon"></span>
					</a></li>';
				}
				
				if ( ! empty( $pinterest ) ) {
					$output .= '<li><a class="social pinterest" href="' . $pinterest . '">
						<span class="social-icon"></span>
					</a></li>';
				}
				
				if ( ! empty( $instagram ) ) {
					$output .= '<li><a class="social instagram" href="' . $instagram . '">
						<span class="social-icon"></span>
					</a></li>';
				}
				
				if ( ! empty( $flickr ) ) {
					$output .= '<li><a class="social flickr" href="' . $flickr . '">
						<span class="social-icon"></span>
					</a></li>';
				}
				
				if ( ! empty( $tumblr ) ) {
					$output .= '<li><a class="social tumblr" href="' . $tumblr . '">
						<span class="social-icon"></span>
					</a></li>';
				}
				
			$output .= '</ul>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
	$output .= '</div><!-- .person -->';

	return $output;
}
add_shortcode( 'vc_person', 'mega_vc_person' );

vc_map( array(
  "name" => __("Person", "mega"),
  "base" => "vc_person",
  "icon" => "icon-wpb-vc_person",
  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/assets/css/js_composer_extend.css'),
  "category" => __('Content', 'mega'),
  "params" => array(
     array(
      "type" => "attach_image",
      "heading" => __("Image", "mega"),
      "param_name" => "image",
      "value" => "",
      "description" => __("Select image from media library.", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Image size", "mega"),
      "param_name" => "img_size",
      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "mega")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Name", "mega"),
      "param_name" => "name",
      "description" => __("Enter person name.", "mega")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Title", "mega"),
      "param_name" => "title",
      "description" => __("Enter person title.", "mega")
    ),
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "heading" => __("Text", "mega"),
      "param_name" => "content",
      "value" => __("<p>I am text block. Click edit button to change this text.</p>", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Facebook Address (URL)", "mega"),
      "param_name" => "facebook",
      "description" => __("Facebook Address (URL)", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Twitter Address (URL)", "mega"),
      "param_name" => "twitter",
      "description" => __("Twitter Address (URL)", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Google Plus Address (URL)", "mega"),
      "param_name" => "google_plus",
      "description" => __("Google Plus Address (URL)", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("LinkedIn Address (URL)", "mega"),
      "param_name" => "linkedin",
      "description" => __("LinkedIn Address (URL)", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Dribbble Address (URL)", "mega"),
      "param_name" => "dribbble",
      "description" => __("Dribbble Address (URL)", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Pinterest Address (URL)", "mega"),
      "param_name" => "pinterest",
      "description" => __("Pinterest Address (URL)", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Instagram Address (URL)", "mega"),
      "param_name" => "instagram",
      "description" => __("Instagram Address (URL)", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Flickr Address (URL)", "mega"),
      "param_name" => "flickr",
      "description" => __("Flickr Address (URL)", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Tumblr Address (URL)", "mega"),
      "param_name" => "tumblr",
      "description" => __("Tumblr Address (URL)", "mega")
    ),
	$add_css_animation = array(
			'type' => 'dropdown',
			'heading' => __( 'CSS Animation', 'js_composer' ),
			'param_name' => 'css_animation',
			'admin_label' => true,
			'value' => array(
				__( 'No', 'js_composer' ) => '',
				__( 'Top to bottom', 'js_composer' ) => 'top-to-bottom',
				__( 'Bottom to top', 'js_composer' ) => 'bottom-to-top',
				__( 'Left to right', 'js_composer' ) => 'left-to-right',
				__( 'Right to left', 'js_composer' ) => 'right-to-left',
				__( 'Appear from center', 'js_composer' ) => "appear"
			),
			'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'js_composer' )
		),
	array(
		  "type" => "textfield",
		  "heading" => __("Extra class name", "mega"),
		  "param_name" => "css_class",
		  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mega")
		),
  )
) );

// Marketing Tour
function mega_vc_marketing_tour( $atts, $content = null ) {
	 extract( shortcode_atts( array(
			'image' => '',
			'name' => '',
			'img_size' => 'thumbnail',
			'title' => '',
			'content' => $content,
			'icon_name' => '',
			'icon_color' => '',
			'css_animation' => '',
			'css_class' => '',
		), $atts ) );
	
	$img_id = preg_replace('/[^\d]/', '', $image);
	$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
	if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" />';
		
	if ( $css_animation != '' ) {
        wp_enqueue_script( 'waypoints' );
        $CSSAnimation = ' wpb_animate_when_almost_visible wpb_'.$css_animation;
    } else {
		$CSSAnimation = 'no-animation';
	}
	
	$output = '';
	$output .= '<div class="marketing-tour-wrapper clearfix '. $CSSAnimation .' '. $css_class .'">';
		$output .= '<span class="marketing-tour">';
			if ( ! empty( $icon_name ) ) {
				if ( $icon_color == NULL ) {
					$output .= '<div class="icon-'. $icon_name .' custom-pack-icon"></div>';
				} else {
					$output .= '<div class="icon-'. $icon_name .' custom-pack-icon" style="color: '. $icon_color .';"></div>';
				}
			} else {
				$output .= $img['thumbnail'];
			}
		$output .= '</span>';
		if(!empty($content)) {
		$output .= '<div class="marketing-tour-content">' . wpb_js_remove_wpautop($content, true) . '</div>';
		}
	$output .= '</div><!-- .marketing-tour-wrapper -->';

	return $output;
}
add_shortcode( 'vc_marketing_tour', 'mega_vc_marketing_tour' );

vc_map( array(
  "name" => __("Marketing Tour", "mega"),
  "base" => "vc_marketing_tour",
  "icon" => "icon-wpb-vc_marketing_tour",
  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/assets/css/js_composer_extend.css'),
  "category" => __('Content', 'mega'),
  "params" => array(
     array(
      "type" => "attach_image",
      "heading" => __("Image", "mega"),
      "param_name" => "image",
      "value" => "",
      "description" => __("Select image from media library.", "mega")
    ),
	 array(
      "type" => "textfield",
      "heading" => __("Image size", "mega"),
      "param_name" => "img_size",
      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "mega")
    ),
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "heading" => __("Text", "mega"),
      "param_name" => "content",
      "value" => __("<p>I am text block. Click edit button to change this text.</p>", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Icon name", "mega"),
      "param_name" => "icon_name",
      "description" => sprintf(__('If you wish to use font icons, then use this field to add an icon name. You will need to install WordPress Icons - SVG plugin first. More at %s.', 'mega'), '<a href="https://wordpress.org/plugins/svg-vector-icon-plugin/" target="_blank">WordPress Icons - SVG</a>')
    ),
	array(
		"type" => "colorpicker",
		"heading" => __("Icon color", "mega"),
		"param_name" => "icon_color",
		"value" => NULL,
		"description" => __("Choose a value for icon color.", "mega")
	),
	$add_css_animation,
	array(
      "type" => "textfield",
      "heading" => __("Extra class name", "mega"),
      "param_name" => "css_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mega")
    )
  )
) );

// Counting
function mega_vc_counting( $atts, $content = null ) {
	wp_enqueue_script( 'waypoints' );

	 extract( shortcode_atts( array(
			'number' => '',
			'caption' => '',
			'id' => '',
			'image' => '',
			'img_size' => 'full',
			'icon_name' => '',
			'icon_color' => '',
			'units' => '',
		), $atts ) );
	
	$img_id = preg_replace('/[^\d]/', '', $image);
	$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
	//if ( $img == NULL ) $img['thumbnail'] = '';
	
	if(!empty($units)) {
		$units = '<span class="count-value">' . $units . '</span>';
	}
	
	$output = '';
	
	$output .= '<div class="count-wrapper" data-count="count-' . $id . '" data-end="' . $number . '">';
		//if ( $img !== NULL )
		if ( ! empty( $icon_name ) ) {
			if ( $icon_color == NULL ) {
				$output .= '<div class="icon-'. $icon_name .' custom-pack-icon"></div>';
			} else {
				$output .= '<div class="icon-'. $icon_name .' custom-pack-icon" style="color: '. $icon_color .';"></div>';
			}
		} else {
				$output .= $img['thumbnail'];
		}
		$output .= '<span class="count-value" id="count-' . $id . '">0</span>' . $units . '';
		$output .= '<span class="count-caption">' . $caption . '</span>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'vc_counting', 'mega_vc_counting' );

vc_map( array(
  "name" => __("Counting", "mega"),
  "base" => "vc_counting",
  //"icon" => "icon-wpb-vc_testimonial_single",
  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/assets/css/js_composer_extend.css'),
  "category" => __('Content', 'mega'),
  "params" => array(
     array(
      "type" => "attach_image",
      "heading" => __("Image", "mega"),
      "param_name" => "image",
      "value" => "",
      "description" => __("Select image from media library.", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Image size", "mega"),
      "param_name" => "img_size",
      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Icon name", "mega"),
      "param_name" => "icon_name",
      "description" => sprintf(__('If you wish to use font icons, then use this field to add an icon name. You will need to install WordPress Icons - SVG plugin first. More at %s.', 'mega'), '<a href="https://wordpress.org/plugins/svg-vector-icon-plugin/" target="_blank">WordPress Icons - SVG</a>')
    ),
	array(
		"type" => "colorpicker",
		"heading" => __("Icon color", "mega"),
		"param_name" => "icon_color",
		"value" => NULL,
		"description" => __("Choose a value for icon color.", "mega")
	),
	array(
      "type" => "textfield",
      "heading" => __("Number", "mega"),
      "param_name" => "number",
      "description" => __("Enter number.", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Caption", "mega"),
      "param_name" => "caption",
      "description" => __("Enter number.", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Id", "mega"),
      "param_name" => "id",
      "description" => __("Enter id.", "mega")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Units", "mega"),
      "param_name" => "units",
      "description" => __("Enter measurement units (if needed) Eg. %, px, points, etc.", "mega")
    ),
  )
) );

// Jetpack Sharing
function mega_vc_jetpack_sharing( $atts, $content = null ) {
	if ( function_exists( 'sharing_display' ) ) {
		return sharing_display();
	}
}
add_shortcode( 'vc_jetpack_sharing', 'mega_vc_jetpack_sharing' );

vc_map( array(
  "name" => __("Jetpack Sharing", "mega"),
  "base" => "vc_jetpack_sharing",
  'show_settings_on_create' => false,
  "category" => __('Social', 'mega')
) );

function mega_jptweak_remove_share() {
	global $post_type;
	if( $post_type == 'portfolio') {
		if ( function_exists( 'sharing_display' ) ) {
			remove_filter( 'the_content', 'sharing_display', 19 );
		}
	}
	if( $post_type == 'product') {
		remove_filter( 'the_content', 'sharing_display', 19 );
	}
}
add_action( 'loop_start', 'mega_jptweak_remove_share' );


// Move JetPack Social Sharing under Woocommerce single product page tabs
add_action( 'woocommerce_after_single_product_summary', 'mega_addshare', 10 );
function mega_addshare() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( function_exists( 'sharing_display' ) ) {
		echo sharing_display();
	}
}

// A function that gets image ID's from URLs for OptionTree
function mega_custom_get_attachment_id( $guid ) {
  global $wpdb;

  /* nothing to find return false */
  if ( ! $guid )
    return false;

  /* get the ID */
  $id = $wpdb->get_var( $wpdb->prepare(
    "
    SELECT  p.ID
    FROM    $wpdb->posts p
    WHERE   p.guid = %s
            AND p.post_type = %s
    ",
    $guid,
    'attachment'
  ) );

  /* the ID was not found, try getting it the expensive WordPress way */
  if ( $id == 0 )
    $id = url_to_postid( $guid );

  return $id;
}

// WooCommerce remove single product title
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// WooCommerce redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
	$args = array(
			'posts_per_page' => 3,
			'columns' => 3,
			'orderby' => 'rand'
		);
	woocommerce_related_products( $args ); // Display 6 products in rows of 3
}

// Remove WooCommerce styles and scripts unless inside the store.
function mega_woo_scripts() {
	//if ( 'product' !== get_post_type() && !is_page( 'cart' ) && !is_page( 'checkout' ) ) {
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	//}
	global $woocommerce;
	if ( $woocommerce ) {
			if ( is_product() ) {
				wp_enqueue_script( 'fresco' );
				wp_enqueue_style( 'fresco', array() );
			}
		
		if ( is_shop() || is_product_category() ) {
			wp_enqueue_script( 'chosen' );
			wp_enqueue_style( 'woocommerce_chosen_styles', plugins_url('/woocommerce/assets/css/chosen.css') );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'mega_woo_scripts', 99 );

// Exclude post types from wp default search results */
function mega_update_custom_type() {
    global $wp_post_types;

    //if ( post_type_exists( 'product' ) ) {

        // exclude from search results
        //$wp_post_types['product']->exclude_from_search = true;
    //}
	
	if ( post_type_exists( 'portfolio' ) ) {

        // exclude from search results
        $wp_post_types['portfolio']->exclude_from_search = true;
    }
	
	// exclude from search results
    $wp_post_types['page']->exclude_from_search = true;
	
	// exclude from search results
	$wp_post_types['attachment']->exclude_from_search = true;
}
//add_action( 'init', 'mega_update_custom_type', 99 );


// Comment count fix after import
add_filter( 'get_comments_number', 'mega_comment_count', 0 );
function mega_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}