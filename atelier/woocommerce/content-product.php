<?php
	/**
	 * The template for displaying product content within loops.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/content-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     2.6.1
	 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $woocommerce, $post, $product, $woocommerce_loop, $sf_options, $sf_catalog_mode, $sf_product_multimasonry, $sf_product_display_type, $sf_product_display_layout;

	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) )
		$woocommerce_loop['loop'] = 0;

	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$product_display_columns = $sf_options['product_display_columns'];

		// COLUMNS GET VARIABLE
		if (isset($_GET['product_columns'])) {
			$product_display_columns = $_GET['product_columns'];
		}

		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $product_display_columns );
	}

	// Ensure visibility
	if ( ! $product || ! $product->is_visible() )
		return;

	// Increase loop count
	$woocommerce_loop['loop']++;

	// Extra post classes
	$classes = array();
	if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
		$classes[] = 'first';
	if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
		$classes[] = 'last';

	$width = $thumb_width = $thumb_height = "";

	$product_display_type = $sf_options['product_display_type'];
	$product_display_gutters = $sf_options['product_display_gutters'];
	$product_qv_hover = $sf_options['product_qv_hover'];
	$product_buybtn = $sf_options['product_buybtn'];
	$product_rating = $sf_options['product_rating'];
	$product_details_alignment = $sf_options['product_details_alignment'];
	$disable_product_transition = false;
	if ( isset( $sf_options['disable_product_transition'] ) ) {
		$disable_product_transition = $sf_options['disable_product_transition'];
	}
	
	if ( $sf_product_display_type ) {
		$product_display_type = $sf_product_display_type;
	}

	// GET VARIABLES
	if ( isset($_GET['product_display']) ) {
		$product_display_type = $_GET['product_display'];
	}
	if ( isset($woocommerce_loop['style-override']) && $woocommerce_loop['style-override'] != "" ) {
		$product_display_type = $woocommerce_loop['style-override'];
	}

	if ( isset($_GET['product_gutters']) ) {
		$product_display_gutters = $_GET['product_gutters'];
	}

	$product_layout = "";
	if ( $sf_product_multimasonry ) {
		$product_display_type = "gallery";
	} else {
		if ( isset($sf_options['product_display_layout']) ) {
			$product_layout = $sf_options['product_display_layout'];
		}
	}
	
	if ( $sf_product_display_layout != "" ) {
		$product_layout = $sf_product_display_layout;
	}

	if ( $product_qv_hover ) {
		$classes[] = 'qv-hover';
	}

	$figure_class = 'animated-overlay';
	
	$sidebar_config = $sf_options['woo_sidebar_config'];
	if (isset($_GET['sidebar'])) {
		$sidebar_config = $_GET['sidebar'];
	}

	if (isset($_GET['layout'])) {
		$product_layout = $_GET['layout'];
	}

	if ( !$disable_product_transition && $product_display_type != "preview-slider" ) {
		if ( $product_display_type == "standard" ) {
			$figure_class .= ' product-transition-fade';
		} else {
			$figure_class .= ' product-transition-zoom';
		}
	} else {
		$figure_class .= ' product-transition-disabled';
	}

	$classes[] = 'product-display-'.$product_display_type;

	if (!$product_display_gutters && ($product_display_type == "gallery" || $sf_product_multimasonry) ) {
		$classes[] = 'no-gutters';
	}

	if ($product_buybtn && $product_display_type == "standard") {
		$classes[] = 'buy-btn-visible';
	}
	if ($product_rating && $product_display_type == "standard") {
		$classes[] = 'rating-visible';
	}

	$classes[] = 'product-layout-'.$product_layout;
	$classes[] = 'details-align-'.$product_details_alignment;


	// Get the product description
	$product_description = sf_get_post_meta($post->ID, 'sf_product_short_description', true);
	if ($product_description == "") {
		$product_description = $post->post_excerpt;
	}
	
	// Get variations for variable products
	if ( $product->is_type( 'variable' ) && $product_display_type == "preview-slider" ) {
		$available_variations = $product->get_available_variations();
	}
	
	
	// Width, Height parameters
	if ( $sf_product_multimasonry ) {

		$masonry_thumb_size = sf_get_post_meta( get_the_ID(), 'sf_masonry_thumb_size', true );

		if ( $masonry_thumb_size == "large" ) {
		    $classes[] = 'col-sm-6 size-large';
		    $width = 'col-sm-6';
		    $thumb_width = 800;
		    $thumb_height = 650;
		} else if ( $masonry_thumb_size == "tall" ) {
		    $classes[] = 'col-sm-3 size-tall';
		    $width = 'col-sm-3';
		    $thumb_width = 400;
		    $thumb_height = 800;
		} else {
			$classes[] = 'col-sm-3 size-standard';
			$width = 'col-sm-3';
			$thumb_width = 400;
			$thumb_height = 320;
		}

	} else {
		
		if ( $product_layout == "grid" ) {
			if ( $sidebar_config == "no-sidebars" ) {
				$classes[] = 'col-sm-sf-5';
				$width = 'col-sm-sf-5';
			} else {
				$classes[] = 'col-sm-3';
				$width = 'col-sm-3';
			}
		} else if ($woocommerce_loop['columns'] == 4) {
			$classes[] = 'col-sm-3';
			$width = 'col-sm-3';
		} else if ($woocommerce_loop['columns'] == 5) {
			$classes[] = 'col-sm-sf-5';
			$width = 'col-sm-sf-5';
		} else if ($woocommerce_loop['columns'] == 3) {
			$classes[] = 'col-sm-4';
			$width = 'col-sm-4';
		} else if ($woocommerce_loop['columns'] == 2) {
			$classes[] = 'col-sm-6';
			$width = 'col-sm-6';
		} else if ($woocommerce_loop['columns'] == 1) {
			$classes[] = 'col-sm-12';
			$width = 'col-sm-12';
		} else if ($woocommerce_loop['columns'] == 6) {
			$classes[] = 'col-sm-2';
			$width = 'col-sm-2';
		}
		
	}
?>
<li <?php post_class( $classes ); ?> data-width="<?php echo esc_attr($width); ?>">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<?php if ( $product_display_type == "preview-slider" ) { ?>
	<div class="preview-slider-item-wrapper">
	<?php } ?>

	<figure class="<?php echo esc_attr($figure_class); ?>">

		<?php sf_woo_product_badge(); ?>

		<?php if ( $sf_product_multimasonry ) {
			$thumb_image    = get_post_thumbnail_id();
			$thumb_image_id = $thumb_image;
			$thumb_img_url  = wp_get_attachment_url( $thumb_image, 'full' );
			
			if ( $thumb_img_url == "" ) {
				$thumb_img_url = "default";
			}
			
			$image = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );
			$image_alt = esc_attr( sf_get_post_meta( $thumb_image_id, '_wp_attachment_image_alt', true ) );
			
			if ( $image_alt == "" ) {
				$image_alt = get_the_title();
			}

			if ( $image ) {
				echo '<div class="multi-masonry-img-wrap"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $image_alt . '" /></div>' . "\n";
			}
		} else if ( $product_display_type == "preview-slider" ) {
						
			if ( $product->is_type( 'variable' ) ) {
				
				echo '<div class="variable-image-wrapper is-variable">';
				$img_count = 0;			
				$available_variations = $product->get_available_variations();
				if ($available_variations && is_array($available_variations) ) {
					$available_variations = array_reverse($available_variations);
					foreach ( $available_variations as $variation ) {
						if ( $variation['variation_is_visible'] ) {
							
							$sale = false;
							if ( $variation['display_price'] != $variation['display_regular_price'] ) {
							$sale = true;
							}
											
							if ( $img_count == 0 ) {
							echo '<div class="img-wrap selected" data-sale="'.$sale.'">';
							} else if ( $img_count == 1 ) {
							echo '<div class="img-wrap move-right" data-sale="'.$sale.'">';
							} else {
							echo '<div class="img-wrap" data-sale="'.$sale.'">';
							}
							echo '<div class="variation-price">'.$variation["price_html"].'</div>';
							echo '<img src="'.$variation["image_src"].'" />';		
							echo '</div>';
							$img_count++;
						}
					}
				}
				echo '</div>';
				
			} else {
				
				echo '<div class="variable-image-wrapper">';
				echo '<div class="img-wrap selected">';
				woocommerce_template_loop_product_thumbnail();
				echo '</div>';
				echo '</div>';	
				
			}
			
		} else {
			echo '<div class="img-wrap first-image">';
			woocommerce_template_loop_product_thumbnail();
			echo '</div>';

			if ($product_display_type == "standard" && !$disable_product_transition) {

				$attachment_ids = $product->get_gallery_attachment_ids();

				$img_count = 0;

				if ($attachment_ids) {

					foreach ( $attachment_ids as $attachment_id ) {

						if ( sf_get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
							continue;
						
						echo '<div class="img-wrap second-image">'.wp_get_attachment_image( $attachment_id, 'shop_catalog' ).'</div>';

						$img_count++;

						if ($img_count == 1) break;

					}

				} else {
					echo '<div class="img-wrap second-image">';
					woocommerce_template_loop_product_thumbnail();
					echo '</div>';
				}
			}
		} ?>

		<?php if (!$sf_catalog_mode) { ?>
		<div class="cart-overlay">
			<div class="shop-actions clearfix">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</div>
		<?php } ?>
		
		<?php if ( !( $product_display_type == "preview-slider" && $product->is_type( 'variable' ) ) ) { ?>
		<a href="<?php the_permalink(); ?>"></a>
		<?php } ?>

		<div class="figcaption-wrap"></div>

		<?php if ($product_display_type != "standard") { ?>
			<figcaption>
				<div class="thumb-info">
					<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
					<h4><?php the_title(); ?></h4>
					<?php
						$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
						echo $product->get_categories( ', ', '<h5 class="posted_in">', '</h5>' );
					?>
					<?php if ( class_exists( 'Woocommerce_German_Market' ) ) { ?>
						<div class="gm-hover-price-wrap">
						<?php
							/**
							 * woocommerce_after_shop_loop_item_title hook
							 *
							 * @hooked woocommerce_template_loop_price - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item_title' );
						?>
						</div>				
					<?php } else { ?>
						<h6><?php woocommerce_template_loop_price(); ?></h6>
					<?php } ?>
				</div>
			</figcaption>

		<?php } ?>

	</figure>

	<div class="product-details">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php
			$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
			echo $product->get_categories( ', ', '<span class="posted_in">', '</span>' );
		?>

		<div class="product-desc">
			<?php echo $product_description; ?>
		</div>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</div>

	<?php if ($product_display_type == "standard") { ?>
		<div class="clear"></div>
		<div class="product-actions">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div>
	<?php } ?>
	
	<?php if ( $product_display_type == "preview-slider" ) { ?>
	</div>
	<?php } ?>

</li>