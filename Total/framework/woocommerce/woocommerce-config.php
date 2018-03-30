<?php
/**
 * Perform all main WooCommerce configurations for this theme
 *
 * @package Total WordPress Theme
 * @subpackage WooCommerce
 * @version 3.5.3
 *
 * @todo Remove global var ?
 */

// Define global var for class, makes child theming easier/possible
global $wpex_woocommerce_config;

// Start and run class
if ( ! class_exists( 'WPEX_WooCommerce_Config' ) ) {
	class WPEX_WooCommerce_Config {

		/**
		 * Main Class Constructor
		 *
		 * @since 2.0.0
		 */
		public function __construct() {

			// Include helper functions
			require_once( WPEX_FRAMEWORK_DIR .'woocommerce/woocommerce-helpers.php' );

			// These filters/actions must run on init
			add_action( 'init', array( $this, 'init' ) );

			// Add new image sizes for WooCommerce
			add_filter( 'wpex_image_sizes', array( $this, 'add_image_sizes' ), 99 );

			// Register Woo sidebar
			add_filter( 'widgets_init', array( $this, 'register_woo_sidebar' ) );

			// Add Woo VC modules
			add_filter( 'vcex_builder_modules', array( 'WPEX_WooCommerce_Config', 'vc_modules' ) );

			/*-------------------------------------------------------------------------------*/
			/* -  Admin only actions/filters
			/*-------------------------------------------------------------------------------*/
			if ( is_admin() ) {

				// Add new image sizes tab
				add_filter( 'wpex_image_sizes_tabs', array( $this, 'image_sizes_tabs' ), 10 );

			}

			/*-------------------------------------------------------------------------------*/
			/* -  Front-End only actions/filters
			/*-------------------------------------------------------------------------------*/
			else {

				// Display correct sidebar for products
				add_filter( 'wpex_get_sidebar', array( $this, 'display_woo_sidebar' ) );

				// Set correct post layouts
				add_filter( 'wpex_post_layout_class', array( $this, 'layouts' ) );
				
				// Disable WooCommerce main page title
				add_filter( 'woocommerce_show_page_title', '__return_false' );

				// Alter page header title
				add_filter( 'wpex_title', array( $this, 'title_config' ) );

				// Show/hide main page header
				add_filter( 'wpex_display_page_header', array( $this, 'display_page_header' ) );

				// Make sure CSS loads on shop page
				if ( WPEX_VC_ACTIVE ) {
					add_filter( 'wpex_vc_css_ids', array( $this, 'shop_vc_css' ) );
				}

				// Get shop slider shortcode
				add_filter( 'wpex_post_slider_shortcode', array( $this, 'shop_slider_shortcode' ) );

				// Display shop slider
				add_filter( 'wpex_has_post_slider', array( $this, 'display_shop_slider' ) );

				// Alter page header subheading
				add_filter( 'wpex_post_subheading', array( $this, 'alter_subheadings' ) );

				// Show/hide category description
				add_filter( 'wpex_has_term_description_above_loop', array( $this, 'term_description_above_loop' ) );

				// Show/hide social share on products
				add_filter( 'wpex_has_social_share', array( $this, 'post_social_share' ) );

				// Show/hide next/prev on products
				add_filter( 'wpex_has_next_prev', array( $this, 'next_prev' ) );

				// Define accents
				add_filter( 'wpex_accent_texts', array( $this, 'accent_texts' ) );
				add_filter( 'wpex_accent_borders', array( $this, 'accent_borders' ) );
				add_filter( 'wpex_accent_backgrounds', array( $this, 'accent_backgrounds' ) );

				// Border colors
				add_filter( 'wpex_border_color_elements', array( $this, 'border_color_elements' ) );
			
			}	

			// Scripts
			add_action( 'woocommerce_enqueue_styles', array( $this, 'remove_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'remove_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_custom_scripts' ) );
			
			// Social share
			add_action( 'woocommerce_after_single_product_summary', 'wpex_social_share', 11 );

			// Menu cart
			add_action( 'wpex_hook_header_inner', array( $this, 'cart_dropdown' ), 40 );
			add_action( 'wpex_hook_main_menu_bottom', array( $this, 'cart_dropdown' ) );
			add_action( 'wp_footer', array( $this, 'cart_overlay' ) );

			// Product entries
			add_action( 'woocommerce_before_shop_loop_item', array( $this, 'add_shop_loop_item_inner_div' ) );
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'close_shop_loop_item_inner_div' ) );
			add_action( 'woocommerce_before_shop_loop_item', array( $this, 'add_shop_loop_item_out_of_stock_badge' ) );

			// Product post
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'clear_summary_floats' ), 1 );

			// Main Woo Filters
			add_filter( 'wp_nav_menu_items', array( $this, 'menu_cart_icon' ) , 10, 2 );
			add_filter( 'add_to_cart_fragments', array( $this, 'menu_cart_icon_fragments' ) );
			add_filter( 'woocommerce_general_settings', array( $this, 'remove_general_settings' ) );
			add_filter( 'woocommerce_product_settings', array( $this, 'remove_product_settings' ) );
			add_filter( 'woocommerce_sale_flash', array( $this, 'woocommerce_sale_flash' ), 10, 3 );
			add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 );
			add_filter( 'loop_shop_columns', array( $this, 'loop_shop_columns' ) );
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_product_args' ) );
			add_filter( 'woocommerce_pagination_args', array( $this, 'pagination_args' ) );
			add_filter( 'woocommerce_continue_shopping_redirect', array( $this, 'continue_shopping_redirect' ) );
			add_filter( 'post_class', array( $this, 'add_product_entry_classes' ), 40, 3 );
			add_filter( 'product_cat_class', array( $this, 'product_cat_class' ) );
			add_filter( 'woocommerce_cart_item_thumbnail', array( $this, 'cart_item_thumbnail' ), 10, 3 );

			// Add new typography settings
			add_filter( 'wpex_typography_settings', array( $this, 'typography_settings' ) );

			// Add new customizer options
			add_filter( 'wpex_customizer_sections', array( $this, 'customizer_settings' ) );
			
		} // End __construct

		/*-------------------------------------------------------------------------------*/
		/* -  Start Class Functions
		/*-------------------------------------------------------------------------------*/

		/**
		 * Runs on Init.
		 * You can't remove certain actions in the constructor because it's too early.
		 *
		 * @since 2.0.0
		 */
		public function init() {

			// Remove category descriptions, these are added already by the theme
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
			
			// Alter cross-sells display
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			add_action( 'woocommerce_cart_collaterals', array( $this, 'cross_sell_display' ) );

			// Alter upsells display
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'upsell_display' ), 15 );

			// Alter WooCommerce category thumbnail
			remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
			add_action( 'woocommerce_before_subcategory_title', array( $this, 'subcategory_thumbnail' ), 10 );

			// Remove loop product thumbnail function and add our own that pulls from template parts
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'loop_product_thumbnail' ), 10 );

			// Remove coupon from checkout
			//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

			// Remove single meta
			if ( ! wpex_get_mod( 'woo_product_meta', true ) ) {
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			}

			// Remove upsells if set to 0
			if ( '0' == wpex_get_mod( 'woocommerce_upsells_count', '4' ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'wpex_woocommerce_output_upsells', 15 );
			}

			// Remove related products if count is set to 0
			if ( '0' == wpex_get_mod( 'woocommerce_related_count', '4' ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}

			// Remove crossells if set to 0
			if ( '0' == wpex_get_mod( 'woocommerce_cross_sells_count', '4' ) ) {
				remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			}

			// Remove result count if disabled
			if ( ! wpex_get_mod( 'woo_shop_result_count', true ) ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			}

			// Remove orderby if disabled
			if ( ! wpex_get_mod( 'woo_shop_sort', true ) ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			}

		}

		/**
		 * Adds a WooCommerce tab to the image sizes admin panel
		 *
		 * @since 3.3.2
		 */
		public static function image_sizes_tabs( $array ) {
			$array['woocommerce'] = 'WooCommerce';
			return $array;
		}

		/**
		 * Adds image sizes for WooCommerce to the image sizes panel.
		 *
		 * @since 2.0.0
		 */
		public static function add_image_sizes( $sizes ) {
			return array_merge( $sizes, array(
					'shop_catalog' => array(
						'label'   => esc_html__( 'Product Entry', 'total' ),
						'width'   => 'woo_entry_width',
						'height'  => 'woo_entry_height',
						'crop'    => 'woo_entry_image_crop',
						'section' => 'woocommerce',
					),
					'shop_single' => array(
						'label'   => esc_html__( 'Product Post', 'total' ),
						'width'   => 'woo_post_width',
						'height'  => 'woo_post_height',
						'crop'    => 'woo_post_image_crop',
						'section' => 'woocommerce',
					),
					'shop_single_thumbnail' => array(
						'label'   => esc_html__( 'Product Post Thumbnail', 'total' ),
						'width'   => 'woo_post_thumb_width',
						'height'  => 'woo_post_thumb_height',
						'crop'    => 'woo_post_thumb_crop',
						'section' => 'woocommerce',
					),
					'shop_thumbnail' => array(
						'label'     => esc_html__( 'Shop & Cart Thumbnail', 'total' ),
						'width'     => 'woo_shop_thumbnail_width',
						'height'    => 'woo_shop_thumbnail_height',
						'crop'      => 'woo_shop_thumbnail_crop',
						'section' => 'woocommerce',
					),
					'shop_category' => array(
						'label'     => esc_html__( 'Product Category Entry', 'total' ),
						'width'     => 'woo_cat_entry_width',
						'height'    => 'woo_cat_entry_height',
						'crop'      => 'woo_cat_entry_image_crop',
						'section' => 'woocommerce',
					)
				)
			);
		}

		/**
		 * Remove general settings from Woo Admin panel.
		 *
		 * @since 2.0.0
		 */
		public static function remove_general_settings( $settings ) {
			$remove = array( 'woocommerce_enable_lightbox' );
			foreach( $settings as $key => $val ) {
				if ( isset( $val['id'] ) && in_array( $val['id'], $remove ) ) {
					unset( $settings[$key] );
				}
			}
			return $settings;
		}

		/**
		 * Remove product settings from Woo Admin panel.
		 *
		 * @since 2.0.0
		 */
		public static function remove_product_settings( $settings ) {
			$remove = array(
				'image_options',
				'shop_catalog_image_size',
				'shop_single_image_size',
				'shop_thumbnail_image_size',
				'woocommerce_enable_lightbox'
			);
			foreach( $settings as $key => $val ) {
				if ( isset( $val['id'] ) && in_array( $val['id'], $remove ) ) {
					unset( $settings[$key] );
				}
			}
			return $settings;
		}

		/**
		 * Register new WooCommerce sidebar.
		 *
		 * @since 2.0.0
		 */
		public static function register_woo_sidebar() {

			// Return if custom sidebar disabled
			if ( ! wpex_get_mod( 'woo_custom_sidebar', true ) ) {
				return;
			}

			// Get correct sidebar heading tag
			$heading_tag = wpex_get_mod( 'sidebar_headings', 'div' );
			$heading_tag = $heading_tag ? $heading_tag : 'div';

			// Register new woo_sidebar widget area
			register_sidebar( array (
				'name'          => esc_html__( 'WooCommerce Sidebar', 'total' ),
				'id'            => 'woo_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $heading_tag .' class="widget-title">',
				'after_title'   => '</'. $heading_tag .'>',
			) );

		}

		/**
		 * Display WooCommerce sidebar.
		 *
		 * @since 2.0.0
		 */
		public static function display_woo_sidebar( $sidebar ) {

			// Alter sidebar display to show woo_sidebar where needed
			if ( wpex_get_mod( 'woo_custom_sidebar', true ) && is_woocommerce() && is_active_sidebar( 'woo_sidebar' ) ) {
				$sidebar = 'woo_sidebar';
			}

			// Return correct sidebar
			return $sidebar;

		}

		/**
		 * Returns correct title for WooCommerce pages.
		 *
		 * @since 2.0.0
		 */
		public static function title_config( $title ) {

			// Shop title
			if ( is_shop() ) {
				$shop_id = wpex_parse_obj_id( wc_get_page_id( 'shop' ), 'page' );
				$title   = $shop_id ? get_the_title( $shop_id ) : '';
				$title   = $title ? $title : $title = esc_html__( 'Shop', 'total' );
			}

			// Product title
			elseif ( is_product() ) {
				$title = wpex_get_translated_theme_mod( 'woo_shop_single_title' );
				$title = $title ? $title : esc_html__( 'Shop', 'total' );
			}

			// Checkout
			elseif ( is_order_received_page() ) {
				$title = esc_html__( 'Order Received', 'total' );
			}

			// Return title
			return $title;

		}

		/**
		 * Hooks into the wpex_display_page_header and returns false if page header is disabled via the customizer.
		 *
		 * @since 2.0.0
		 */
		public static function display_page_header( $return ) {
			if ( is_shop() && ! wpex_get_mod( 'woo_shop_title', true ) ) {
				$return = false;
			}
			return $return;
		}

		/**
		 * Tweaks the post layouts for WooCommerce archives and single product posts.
		 *
		 * @since 2.0.0
		 */
		public static function layouts( $class ) {
			if ( wpex_is_woo_shop() ) {
				$class = wpex_get_mod( 'woo_shop_layout', 'full-width' );
			} elseif ( wpex_is_woo_tax() ) {
				$class = wpex_get_mod( 'woo_shop_layout', 'full-width' );
			} elseif ( wpex_is_woo_single() ) {
				$class = wpex_get_mod( 'woo_product_layout', 'full-width' );
			}
			return $class;
		}

		/**
		 * Remove WooCommerce styles not needed for this theme.
		 *
		 * @since 2.0.0
		 * @link  http://docs.woothemes.com/document/disable-the-default-stylesheet/
		 */
		public static function remove_styles( $enqueue_styles ) {
			if ( is_array( $enqueue_styles ) ) {
				unset( $enqueue_styles['woocommerce-layout'] );
				unset( $enqueue_styles['woocommerce-smallscreen'] );
				unset( $enqueue_styles['woocommerce_prettyPhoto_css'] );
			}
			return $enqueue_styles;
		}

		/**
		 * Remove WooCommerce scripts.
		 *
		 *
		 * @since 2.0.0
		 */
		public static function remove_scripts() {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
		}

		/**
		 * Add Custom WooCommerce CSS.
		 *
		 * @since 2.0.0
		 */
		public static function add_custom_scripts() {

			// General WooCommerce Custom CSS
			wp_enqueue_style( 'wpex-woocommerce', WPEX_CSS_DIR_URI .'wpex-woocommerce.css', array(), WPEX_THEME_VERSION );

			// WooCommerce Responsiveness
			if ( wpex_global_obj( 'responsive' ) ) {
				wp_enqueue_style( 'wpex-woocommerce-responsive', WPEX_CSS_DIR_URI .'wpex-woocommerce-responsive.css', array( 'wpex-woocommerce' ), WPEX_THEME_VERSION );
			}

			// Increment JS
			if ( is_singular( 'product' ) || is_cart() ) {
				wp_enqueue_script( 'wpex-wc-quantity-increment', WPEX_JS_DIR_URI .'dynamic/wc-quantity-increment-min.js', array( 'jquery' ), '', WPEX_THEME_VERSION );
			}

		}

		/**
		 * Change onsale text.
		 *
		 * @since 2.0.0
		 */
		public static function woocommerce_sale_flash( $text, $post, $_product ) {
			return '<span class="onsale">'. esc_html__( 'Sale', 'total' ) .'</span>';
		}

		/**
		 * Returns correct posts per page for the shop
		 *
		 * @since 3.0.0
		 */
		public static function loop_shop_per_page() {
			$posts_per_page = wpex_get_mod( 'woo_shop_posts_per_page' );
			$posts_per_page = $posts_per_page ? $posts_per_page : '12';
			return $posts_per_page;
		}

		/**
		 * Change products per row for the main shop.
		 *
		 * @since 2.0.0
		 */
		public static function loop_shop_columns() {
			$columns = wpex_get_mod( 'woocommerce_shop_columns' );
			$columns = $columns ? $columns : '4';
			return $columns;
		}

		/**
		 * Change products per row for upsells.
		 *
		 * @since 2.0.0
		 */
		public static function upsell_display() {
			// Get count
			$count = wpex_get_mod( 'woocommerce_upsells_count' );
			$count = $count ? $count : '4';
			// Get columns
			$columns = wpex_get_mod( 'woocommerce_upsells_columns' );
			$columns = $columns ? $columns : '4';
			// Alter upsell display
			woocommerce_upsell_display( $count, $columns );
		}

		/**
		 * Change products per row for crossells.
		 *
		 * @since 2.0.0
		 */
		public static function cross_sell_display() {
			// Get count
			$count = wpex_get_mod( 'woocommerce_cross_sells_count' );
			$count = $count ? $count : '2';
			// Get columns
			$columns = wpex_get_mod( 'woocommerce_cross_sells_columns' );
			$columns = $columns ? $columns : '2';
			// Alter cross-sell display
			woocommerce_cross_sell_display( $count, $columns );
		}

		/**
		 * Change category thumbnail.
		 *
		 * @since 2.0.0
		 */
		public static function subcategory_thumbnail( $category ) {

			// Get attachment id
			$attachment      = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
			$attachment_data = wpex_get_attachment_data( $attachment );

			// Get alt
			if ( ! empty( $attachment_data['alt'] ) ) {
				$alt = $attachment_data['alt'];
			} else {
				$alt = $category->name;
			}

			// Return thumbnail if attachment is defined
			if ( $attachment ) {

				wpex_post_thumbnail( array(
					'attachment' => $attachment,
					'size'       => 'shop_category',
					'alt'        => esc_attr( $alt ),
				) );

			}

			// Display placeholder
			else {

				echo '<img src="'. wc_placeholder_img_src() .'" alt="'. esc_html__( 'Placeholder Image', 'total' ) .'" />';

			}

		}

		/**
		 * Alter the related product arguments.
		 *
		 * @since 2.0.0
		 */
		public static function related_product_args() {
			// Get global vars
			global $product, $orderby, $related;
			// Get posts per page
			$posts_per_page = wpex_get_mod( 'woocommerce_related_count' );
			$posts_per_page = $posts_per_page ? $posts_per_page : '4';
			// Get columns
			$columns = wpex_get_mod( 'woocommerce_related_columns' );
			$columns = $columns ? $columns : '4';
			// Return array
			return array(
				'posts_per_page' => $posts_per_page,
				'columns'        => $columns,
			);
		}

		/**
		 * Adds an opening div "product-inner" around product entries.
		 *
		 * @since 2.0.0
		 */
		public static function add_shop_loop_item_inner_div() {
			echo '<div class="product-inner clr">';
		}

		/**
		 * Closes the "product-inner" div around product entries.
		 *
		 * @since 2.0.0
		 */
		public static function close_shop_loop_item_inner_div() {
			echo '</div><!-- .product-inner .clr -->';
		}

		/**
		 * Clear floats after single product summary.
		 *
		 * @since 2.0.0
		 */
		public static function clear_summary_floats() {
			echo '<div class="wpex-clear-after-summary wpex-clear"></div>';
		}

		/**
		 * Adds an out of stock tag to the products.
		 *
		 * @since 2.0.0
		 */
		public static function add_shop_loop_item_out_of_stock_badge() {
			if ( function_exists( 'wpex_woo_product_instock' ) && ! wpex_woo_product_instock() ) { ?>
				<div class="outofstock-badge">
					<?php echo apply_filters( 'wpex_woo_outofstock_text', esc_html__( 'Out of Stock', 'total' ) ); ?>
				</div><!-- .product-entry-out-of-stock-badge -->
			<?php }
		}

		/**
		 * Returns our product thumbnail from our template parts based on selected style in theme mods.
		 *
		 * @since 2.0.0
		 */
		public static function loop_product_thumbnail() {
			if ( function_exists( 'wc_get_template' ) ) {
				// Get entry product media style
				$style = wpex_get_mod( 'woo_product_entry_style' );
				$style = $style ? $style : 'image-swap';
				// Get entry product media template part
				wc_get_template(  'loop/thumbnail/'. $style .'.php' );
			}
		}

		/**
		 * Tweaks pagination arguments.
		 *
		 * @since 2.0.0
		 */
		public static function pagination_args( $args ) {
			$args['prev_text'] = '<i class="fa fa-angle-left"></i>';
			$args['next_text'] = '<i class="fa fa-angle-right"></i>';
			return $args;
		}

		/**
		 * Alter continue shoping URL.
		 *
		 * @since 2.0.0
		 */
		public static function continue_shopping_redirect( $return_to ) {
			if ( $shop_id  = wc_get_page_id( 'shop' ) ) {
				$shop_id   = wpex_parse_obj_id( $shop_id, 'page' );
				$return_to = get_permalink( $shop_id );
			}
			return $return_to;
		}

		/**
		 * Hooks into the wpex_has_post_slider function and returns true for the shop if
		 * a slider is defined via the customizer.
		 *
		 * @since 2.0.0
		 */
		public static function display_shop_slider( $return ) {
			if ( is_shop() && wpex_get_mod( 'woo_shop_slider' ) ) {
				$return = true;
			}
			return $return;
		}

		/**
		 * The shop post slider
		 *
		 * @since 2.0.0
		 */
		public static function shop_slider_shortcode( $slider ) {
			if ( is_shop() && ! $slider ) {
				$slider = wpex_get_mod( 'woo_shop_slider' );
			}
			return $slider;
		}

		/**
		 * Alters subheading for the shop.
		 *
		 * @since 2.0.0
		 */
		public static function alter_subheadings( $subheading ) {

			// Woo Taxonomies
			if ( wpex_is_woo_tax() ) {
				if ( 'under_title' == wpex_get_mod( 'woo_category_description_position', 'under_title' ) ) {
					$subheading = term_description();
				} else {
					$subheading = NULL;
				}
			}

			// Orderby, search...etc
			if ( is_shop() ) {
				if ( ! empty( $_GET['s'] ) ) {
					$subheading = esc_html__( 'Search results for:', 'total' ) .' <span>&quot;'. esc_html( $_GET['s'] ) .'&quot;</span>';
				}
			}

			// Return subheading
			return $subheading;

		}

		/**
		 * Alters subheading for the shop.
		 *
		 * @since 2.0.0
		 */
		public static function term_description_above_loop( $return ) {

			// Check if enabled
			if ( wpex_is_woo_tax() && 'above_loop' == wpex_get_mod( 'woo_category_description_position' ) ) {
				$return = true;
			}

			// Return bool
			return $return;

		}

		/**
		 * Enable post social share if enabled.
		 *
		 * @since 2.0.0
		 */
		public static function post_social_share( $return ) {
			if ( is_singular( 'product' ) && wpex_get_mod( 'social_share_woo', false ) ) {
				$return = true;
			}
			return $return;
		}

		/**
		 * Add classes to WooCommerce product entries.
		 *
		 * @since 2.0.0
		 */
		public static function add_product_entry_classes( $classes, $class = '', $post_id = '' ) {
			if ( 'product' == get_post_type() && is_array( $classes ) ) {
				global $woocommerce_loop;
				if ( ! empty( $woocommerce_loop['columns'] ) && in_array( 'wpex-woo-entry', $classes ) ) {
					$classes[] = 'col';
					$columns = isset( $woocommerce_loop['columns'] ) ? $woocommerce_loop['columns'] : 4;
					$classes[] = wpex_grid_class( $columns );
					$key = array_search( 'wpex-woo-entry', $classes );
					unset( $classes[$key] );
				}
			}
			return $classes;
		}

		/**
		 * Disables the next/previous links if disabled via the customizer.
		 *
		 * @since 2.0.0
		 */
		public static function next_prev( $return ) {
			if ( is_woocommerce() && is_singular( 'product' ) && ! wpex_get_mod( 'woo_next_prev', true ) ) {
				$return = false;
			}
			return $return;
		}

		/**
		 * Adds border accents for WooCommerce styles.
		 *
		 * @since 2.1.0
		 */
		public static function accent_texts( $texts ) {
			return array_merge( array(
				'.woocommerce ul.products li.product h3',
				'.woocommerce ul.products li.product h3 mark',
			), $texts );
		}

		/**
		 * Adds border accents for WooCommerce styles.
		 *
		 * @since 2.1.0
		 */
		public static function accent_borders( $borders ) {
			return array_merge( array(
				'#current-shop-items-dropdown' => array( 'top' ),
				'.woocommerce div.product .woocommerce-tabs ul.tabs li.active a' => array( 'bottom' ),
			), $borders );
		}

		/**
		 * Adds border accents for WooCommerce styles.
		 *
		 * @since 2.1.0
		 */
		public static function accent_backgrounds( $backgrounds ) {
			return array_merge( array(
				'.woocommerce #respond input#submit',
				'.woocommerce a.button',
				'.woocommerce button.button',
				'.woocommerce input.button',
				'.woocommerce ul.products li.product .added_to_cart',
				'.woocommerce #respond input#submit.alt',
				'.woocommerce a.button.alt',
				'.woocommerce button.button.alt',
				'.woocommerce input.button.alt',
				'.woocommerce #respond input#submit:hover',
				'.woocommerce a.button:hover',
				'.woocommerce button.button:hover',
				'.woocommerce input.button:hover',
				'.woocommerce ul.products li.product .added_to_cart:hover',
				'.woocommerce #respond input#submit.alt:hover',
				'.woocommerce a.button.alt:hover',
				'.woocommerce button.button.alt:hover',
				'.woocommerce input.button.alt:hover',
			), $backgrounds );
		}

		/**
		 * Adds border color elements for WooCommerce styles.
		 *
		 * @since 3.3.2
		 */
		public static function border_color_elements( $elements ) {
			return array_merge( array(

				// Product
				'.product_meta',
				'.woocommerce div.product .woocommerce-tabs ul.tabs',

				// Account
				'#customer_login form.login, #customer_login form.register,
				p.myaccount_user',

				// Widgets
				'.woocommerce ul.product_list_widget li:first-child,
				.woocommerce .widget_shopping_cart .cart_list li:first-child,
				.woocommerce.widget_shopping_cart .cart_list li:first-child',
				'.woocommerce ul.product_list_widget li,
				.woocommerce .widget_shopping_cart .cart_list li,
				.woocommerce.widget_shopping_cart .cart_list li',

				// Tables
				'.woocommerce-checkout #payment ul.payment_methods,
				.woocommerce table.shop_table,
				.woocommerce table.shop_table td,
				.woocommerce-cart .cart-collaterals .cart_totals tr td,
				.woocommerce-cart .cart-collaterals .cart_totals tr th,
				.woocommerce table.shop_table tbody th,
				.woocommerce table.shop_table tfoot td,
				.woocommerce table.shop_table tfoot th,
				.woocommerce .order_details,
				.woocommerce .cart-collaterals .cross-sells,
				.woocommerce-page .cart-collaterals .cross-sells,
				.woocommerce .cart-collaterals .cart_totals,
				.woocommerce-page .cart-collaterals .cart_totals,
				.woocommerce .cart-collaterals h2, .woocommerce .cart-collaterals h2,
				.woocommerce ul.order_details, .woocommerce .shop_table.order_details tfoot th,
				.woocommerce .shop_table.customer_details th,
				.woocommerce-checkout #payment ul.payment_methods,
				.woocommerce .col2-set.addresses .col-1, .woocommerce .col2-set.addresses .col-2,
				.woocommerce-cart .cart-collaterals .cart_totals .order-total th,
				.woocommerce-cart .cart-collaterals .cart_totals .order-total td',

				// Checkout
				'.woocommerce form.login,
				.woocommerce form.register,
				.woocommerce-checkout #payment',

			), $elements );
		}

		/**
		 * Alter WooCommerce category classes
		 *
		 * @since 3.0.0
		 */
		public static function product_cat_class( $classes ) {
			global $woocommerce_loop;
			$classes[] = 'col';
			$classes[] = wpex_grid_class( $woocommerce_loop['columns'] );
			return $classes;
		}

		/**
		 * Alter the cart item thumbnail size
		 *
		 * @since 3.0.0
		 */
		public static function cart_item_thumbnail( $thumb, $cart_item, $cart_item_key ) {
			if ( ! empty( $cart_item['variation_id'] )
				&& $thumbnail = get_post_thumbnail_id( $cart_item['variation_id'] )
			) {
				return wpex_get_post_thumbnail( array(
					'size'       => 'shop_thumbnail',
					'attachment' => $thumbnail,
				) );
			} elseif ( isset( $cart_item['product_id'] )
				&& $thumbnail = get_post_thumbnail_id( $cart_item['product_id'] )
			) {
				return wpex_get_post_thumbnail( array(
					'size'       => 'shop_thumbnail',
					'attachment' => $thumbnail,
				) );
			} else {
				return wc_placeholder_img();
			}
		}

		/**
		 * Add WooCommerce cart dropdown to the header
		 *
		 * @since 3.0.0
		 */
		public static function cart_dropdown() {

			// Return if style not set to dropdown
			if ( 'drop_down' != wpex_global_obj( 'menu_cart_style' ) ) {
				return;
			}

			// Should we get the template part?
			$get = false;

			// Get current header style
			$header_style = wpex_global_obj( 'header_style' );

			// Header Inner Hook
			if ( 'wpex_hook_header_inner' == current_filter() ) {
				if ( 'one' == $header_style ) {
					$get = true;
				}
			}
			
			// Menu bottom hook
			elseif ( 'wpex_hook_main_menu_bottom' == current_filter() ) {
				if ( 'two' == $header_style
					|| 'three' == $header_style
					|| 'four' == $header_style
					|| 'five' == $header_style ) {
					$get = true;
				}
			}

			// Get template file
			if ( $get ) {
				get_template_part( 'partials/cart/cart-dropdown' );
			}

		}

		/**
		 * Adds Cart overlay code to footer
		 *
		 * @since 3.0.0
		 */
		public static function cart_overlay() {
			if ( 'overlay' == wpex_global_obj( 'menu_cart_style' ) ) {
				get_template_part( 'partials/cart/cart-overlay' );
			}
		}

		/**
		 * Adds cart icon to menu
		 *
		 * @since 3.0.0
		 */
		public static function menu_cart_icon( $items, $args ) {

			// Only used for the main menu
			if ( 'main_menu' != $args->theme_location ) {
				return $items;
			}

			// Get style
			$style = wpex_global_obj( 'menu_cart_style' );

			// Return items if no style
			if ( ! $style ) {
				return $items;
			}

			// Toggle class
			$toggle_class = 'toggle-cart-widget';

			// Define classes to add to li element
			$classes = array( 'woo-menu-icon', 'wpex-menu-extra' );
			
			// Add style class
			$classes[] = 'wcmenucart-toggle-'. $style;

			// Prevent clicking on cart and checkout
			if ( 'custom-link' != $style && ( is_cart() || is_checkout() ) ) {
				$classes[] = 'nav-no-click';
			}

			// Add toggle class
			else {
				$classes[] = $toggle_class;
			}

			// Turn classes into string
			$classes = implode( ' ', $classes );
			
			// Add cart link to menu items
			$items .= '<li class="'. $classes .'">' . wpex_wcmenucart_menu_item() .'</li>';
			
			// Return menu items
			return $items;
		}

		/**
		 * Add menu cart item to the Woo fragments so it updates with AJAX
		 *
		 * @since 3.0.0
		 */
		public static function menu_cart_icon_fragments( $fragments ) {
			$fragments['.wcmenucart'] = wpex_wcmenucart_menu_item();
			return $fragments;
		}

		/**
		 * Add typography options for the WooCommerce product title
		 *
		 * @since 3.0.0
		 */
		public static function typography_settings( $settings ) {
			$settings['woo_entry_title'] = array(
				'label' => esc_html__( 'WooCommerce Entry Title', 'total' ),
				'target' => '.woocommerce ul.products li.product h3, .woocommerce ul.products li.product h3 mark',
				'margin' => true,
			);
			$settings['woo_product_title'] = array(
				'label' => esc_html__( 'WooCommerce Product Title', 'total' ),
				'target' => '.woocommerce div.product .product_title',
				'margin' => true,
			);
			$settings['woo_post_tabs_title'] = array(
				'label' => esc_html__( 'WooCommerce Tabs Title', 'total' ),
				'target' => '.woocommerce-tabs h2',
				'margin' => true,
			);
			$settings['woo_upsells_related_title'] = array(
				'label' => esc_html__( 'WooCommerce Up-Sells & Related Title', 'total' ),
				'target' => '.woocommerce .upsells.products h2, .woocommerce .related.products h2',
				'margin' => true,
			);
			return $settings;
		}

		/**
		 * Adds customizer settings
		 *
		 * @since 3.0.8
		 */
		public function customizer_settings( $sections ) {

			// Social share
			if ( isset( $sections['wpex_social_sharing']['settings'] ) ) {
				$sections['wpex_social_sharing']['settings'][] = array(
					'id' => 'social_share_woo',
					'default' => false,
					'control' => array (
						'label' => 'WooCommerce',
						'type' => 'checkbox',
						'active_callback' => 'wpex_has_social_share_sites',
					),
				);
			}
				
			// Return sections
			return $sections;

		}

		/**
		 * Add shop ID to list of VC id's for custom field CSS.
		 *
		 * @since 2.0.0
		 */
		public static function shop_vc_css( $ids ) {
			if ( is_shop() && $shop_id = wpex_parse_obj_id( wc_get_page_id( 'shop' ) ) ) {
				$ids[] = $shop_id;
			}
			return $ids;
		}

		/**
		 * Add custom VC modules
		 *
		 * @since 3.5.3
		 */
		public static function vc_modules( $modules ) {
			$modules[] = 'woocommerce_carousel';
			return $modules;
		}

	}
}
$wpex_woocommerce_config = new WPEX_WooCommerce_Config();