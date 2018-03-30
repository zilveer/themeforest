<?php
/**
 * WooCommerce Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pile
 * @since Pile 2.1
 */

if ( ! function_exists( 'woocommerce_output_content_wrapper' ) ) {
	/**
	 * Overwrite the start of the page wrapper.
	 *
	 */
	function woocommerce_output_content_wrapper() {?>

		<div id="djaxHero" <?php pile_hero_classes( 'djax-updatable djax--hidden' ); ?>></div>

		<?php do_action( 'pile_djax_container_start' ); ?>

		<?php if ( is_archive() ) { ?>
			<div class="site-content  wrapper">
				<div class="content-width">
					<div class="page__header">
						<h1 class="page__title"><?php woocommerce_page_title(); ?></h1>
						<?php pile_woocommerce_categories(); ?>
					</div>
		<?php }
	}
}
if ( ! function_exists( 'woocommerce_output_content_wrapper_end' ) ) {
	/**
	 * Overwrite the end of the page wrapper.
	 *
	 */
	function woocommerce_output_content_wrapper_end() {
		do_action( 'pile_djax_container_end' ); ?>

		<?php if ( is_archive() ) { ?>
				</div><!-- .content-width -->
			</div><!-- .site-content  .wrapper -->
		<?php }
	}
}

if ( ! function_exists( 'woocommerce_default_product_tabs' ) ) {
	/**
	 * Add default product tabs to product pages.
	 *
	 * @param array $tabs
	 *
	 * @return array
	 */
	function woocommerce_default_product_tabs( $tabs = array() ) {
		global $product, $post;
		$enable_builder = get_post_meta( get_the_ID(), 'enable_builder', true );
		$builder_meta   = get_post_meta( get_the_ID(), '_pile_page_builder', true );

		// Description tab - shows product when is not empty
		if ( $post->post_content || ( 'on' === $enable_builder && ! empty( $builder_meta ) ) ) {
			$tabs['description'] = array(
				'title'    => __( 'Description', 'woocommerce' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);
		}

		// Additional information tab - shows attributes
		if ( $product && ( $product->has_attributes() || ( $product->enable_dimensions_display() && ( $product->has_dimensions() || $product->has_weight() ) ) ) ) {
			$tabs['additional_information'] = array(
				'title'    => __( 'Additional Information', 'woocommerce' ),
				'priority' => 20,
				'callback' => 'woocommerce_product_additional_information_tab'
			);
		}

		// Reviews tab - shows comments
		if ( comments_open() ) {
			$tabs['reviews'] = array(
				'title'    => sprintf( __( 'Reviews (%d)', 'woocommerce' ), $product->get_review_count() ),
				'priority' => 30,
				'callback' => 'comments_template'
			);
		}

		return $tabs;
	}
}

// Ensure cart contents update when products are added to the cart via AJAX
function woopgrade_header_add_to_cart_fragment( $fragments ) {
	ob_start(); ?>
	<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>"
	   title="<?php _e( 'View your shopping cart', 'woothemes' ); ?>">
		<?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'woothemes' ), WC()->cart->cart_contents_count ); ?>
		- <?php echo WC()->cart->get_cart_total(); ?>
	</a>
	<?php $fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}

add_filter( 'add_to_cart_fragments', 'woopgrade_header_add_to_cart_fragment' );

function pile_add_to_cart_button( $message ) {
	// Here you should modify $message as you want, and then return it.
	$newButtonString = 'View cart';
	$replaceString   = '<p><a$1class="btn btn--medium">' . $newButtonString . '</a>';
	$message         = preg_replace( '#<a(.*?)class="button">(.*?)</a>#', $replaceString, $message );

	return $message . '</p>';
}

add_filter( 'woocommerce_add_to_cart_message', 'pile_add_to_cart_button', 999 );


/* This snippet removes the action that inserts thumbnails to products in the loop
 * and re-adds the function customized with our wrapper in it.
 * It applies to all archives with products.
 *
 * @original plugin: WooCommerce
 * @author of snippet: Brian Krogsard
 */

/**
 * WooCommerce Loop Product Thumbs
 **/
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

	function woocommerce_template_loop_product_thumbnail() {

		global $post;

		$image       = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-big' );
		$image_ratio = 70; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
		if ( isset( $image[1] ) && isset( $image[2] ) && $image[1] > 0 ) {
			$image_ratio = $image[2] * 100 / $image[1];
		}

		// echo '<div class="product__image-wrapper" style="padding-top: '. $image_ratio .'%;">';
		echo '<div class="mosaic__image" style="padding-top: ' . $image_ratio . '%;">';
		echo woocommerce_get_product_thumbnail( 'small-size' );
		echo '</div>';
	}
}
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

/**
 * WooCommerce Product Thumbnail
 **/
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

	function woocommerce_get_product_thumbnail( $size = 'blog-big', $placeholder_width = 0, $placeholder_height = 0 ) {
		global $post;
		if ( has_post_thumbnail() ) {
			return get_the_post_thumbnail( $post->ID, $size );
		} else {
			return '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder"/>';
		}
	}
}



/**
 * WooCommerce Loop Product Thumbs
 **/
if ( ! function_exists( 'woocommerce_subcategory_thumbnail' ) ) {

	function woocommerce_subcategory_thumbnail( $category ) {

		$small_thumbnail_size = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
		$thumbnail_id         = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
		} else {
			$image[0] = wc_placeholder_img_src();
		}

//        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-big');
		$image_ratio = 100; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
		if ( isset( $image[1] ) && isset( $image[2] ) && $image[1] > 0 ) {
			$image_ratio = $image[2] * 100 / $image[1];
		}

		// echo '<div class="product__image-wrapper" style="padding-top: '. $image_ratio .'%;">';
		echo '<div class="mosaic__image" style="padding-top: ' . $image_ratio . '%;">';
		if ( $image ) {
			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: http://core.trac.wordpress.org/ticket/23605
			$image[0] = str_replace( ' ', '%20', $image[0] );

			echo '<img src="' . esc_url( $image[0] ) . '" alt="' . esc_attr( $category->name ) . '" />';
		}
		echo '</div>';
	}
}
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
add_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );

if ( ! function_exists( 'pile_woocommerce_categories' ) ) {

	function pile_woocommerce_categories() {

		global $wp_query;

		// get all product categories
		$terms = get_terms( array(
			'taxonomy' => 'product_cat',
		) );

		// if there is a category queried cache it
		$current_term =	get_queried_object();

		if ( ! empty( $terms ) /*&& pile_option('display_product_filters', '0')*/ ) {
			// create a link which should link to the shop
			$all_link = get_post_type_archive_link( 'product' );

			echo '<nav class="page__subtitle"><ul class="meta meta--post">';
			// display the shop link first if there is one
			if ( ! empty( $all_link ) ) {
				// also if the current_term doesn't have a term_id it means we are quering the shop and the "all categories" should be active
				echo '<li><a href="' . $all_link . '"' . ( ( ! isset( $current_term->term_id ) ) ? ' class="active"' : ' class="inactive"' ) . '>' . esc_html__( 'All Products', 'pile' ) . '</a></li>';
			}

			// display a link for each product category
			foreach ($terms as $key => $term ) {
				$link  = get_term_link( $term, 'product_cat' );
				if ( ! is_wp_error( $link ) ) {

					// if the current category is queried add the "active class" to the link
					$class_string = 'class="meta-list__item  ';
					if ( ! empty( $current_term->name ) && $current_term->name === $term->name ) {
						$class_string .= 'active"';
					} else {
						$class_string .= 'inactive"';
					}

					echo '<a href="' . $link . '"' . $class_string . '>' . $term->name . '</a>';
				}
			}
			echo '</ul></nav>';
		} // close if ! empty( $terms )
	}
}
//add_action( 'woocommerce_before_shop_loop', 'pile_woocommerce_categories', 30 );

function pile_add_shop_custom_style(){


	$cover_background = get_post_meta( get_the_ID(), '_hero_background_color', true );

	if ( empty( $cover_background ) ) {
		$cover_background = '#FFF';
	}
	echo '<style>' .
		'div.product .js-post-gallery { background-color: ' . $cover_background . '; }' .
	'</style>';
}
add_action( 'woocommerce_before_single_product', 'pile_add_shop_custom_style' );

/**
 * Add layout classes for single product template.
 * Avoid adding these clases on other loops like `related products`
 *
 * @param $classes
 * @param $class
 * @param $post_id
 *
 * @return array
 */
function pile_woo_add_layout_product_class( $classes, $class, $post_id ) {
	global $wp_query, $woocommerce_loop;

	// for single query only
	if ( $woocommerce_loop === null && $wp_query->is_singular( 'product' ) && $wp_query->is_main_query() ) {
		$cover_layout = get_post_meta( get_the_ID(), '_product_image_layout', true );
		// fallback to the default layout
		if ( is_string( $cover_layout ) && ! empty( $cover_layout ) ) {
			$classes[] = $cover_layout;
		} else {
			$classes[] = 'l-contain';
		}
		return $classes;
	}
	return $classes;
}

add_filter( 'post_class', 'pile_woo_add_layout_product_class', 10, 3 );

function pile_add_single_before_wrapper (){?>
	<div class="js-post-gallery">
		<div class="flex">
<?php }

add_action( 'woocommerce_before_single_product_summary', 'pile_add_single_before_wrapper');

function pile_add_single_after_wrapper (){?>
		</div>
	</div>
<?php }

add_action( 'woocommerce_after_single_product_summary', 'pile_add_single_after_wrapper', 5);

function pile_woocommerce_template_loop_product_link_open() {
	echo '<a href="' . get_the_permalink() . '" class="pile-item-wrapper-link">';
}

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'pile_woocommerce_template_loop_product_link_open', 10 );