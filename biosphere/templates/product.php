<?php 
	
	// Globals
	global $dd_sn;
	global $dd_post_class;
	global $dd_thumb_size;
	global $dd_count;
	global $more; $more = 0; // Make the more tag work

	// Globals - WooCommerce
	global $product;
	global $woocommerce;

	// Cart URL - WooCommerce
	$woo_cart_url = $woocommerce->cart->get_cart_url();

	// Default - Post Class
	if ( ! isset( $dd_post_class ) ) {
		$dd_post_class = 'four columns ';
	}

	// Default - Thumb Size
	if ( ! isset( $dd_thumb_size ) ) {
		$dd_thumb_size = 'dd-one-fourth';	
	}

	// Post Class - Append - Thumbnail
	if ( has_post_thumbnail() ) {
		$dd_post_class_append = 'has-thumb ';
	} else {
		$dd_post_class_append = '';
	}

	// Post Class - Last (column)
	if ( $dd_count == 4 ) {
		$last_class = 'last';
		$dd_count = 0;
	} else {
		$last_class = '';
	}

	if ( $dd_count == 1 ) {
		$last_class = 'clear';
	}

?>

<?php if ( is_single() ) : ?>
		
	

<?php else : ?>

	<div <?php post_class( 'dd-product ' . $dd_post_class . $dd_post_class_append . $last_class ); ?>>

		<div class="dd-product-inner">

			<div class="dd-product-thumb">

				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-one-fourth-crop' ); ?></a>

				<span class="dd-product-price"><?php echo $product->get_price_html(); ?></span>

			</div><!-- .blog-post-thumb -->

			<div class="dd-product-main">

				<a href="<?php the_permalink(); ?>" class="dd-product-title"><?php the_title(); ?></a>

				<?php if ( $product->get_rating_count() > 0 ) : ?>

					<?php
						$rating = round( $product->get_average_rating() );
					?>

					<div class="dd-product-rating">

						<div class="dd-product-rating-full">

							<span class="icon-star"></span>
							<span class="icon-star"></span>
							<span class="icon-star"></span>
							<span class="icon-star"></span>
							<span class="icon-star"></span>

							<div class="dd-product-rating-real">

								<?php for ( $i = 0;  $i < $rating;  $i++ ) : ?> 
									<span class="icon-star"></span>
								<?php endfor; ?>

								<?php for ( $i = $i;  $i < 5 ;  $i++) : ?>
									<span class="icon-star invisible"></span>
								<?php endfor; ?>

							</div><!-- .dd-product-rating-real -->

						</div><!-- .dd-product-rating-full -->

					</div><!-- .dd-product-rating -->

				<?php endif; ?>
					
				<div class="dd-product-permalink">
					<a href="<?php echo do_shortcode( '[add_to_cart_url id="' . get_the_ID() . '"]' ); ?>"  data-load-text="<?php _e( 'ADDING', 'dd_string' ); ?>" data-view-cart-url="<?php echo $woo_cart_url; ?>" data-view-cart-text="<?php _e( 'VIEW CART', 'dd_string' ); ?>" class="dd-button orange-light add-to-cart-ajax"><span class="icon-cart"></span><?php _e( 'ADD TO CART', 'dd_string' ); ?></a>
				</div><!-- .dd-product-permalink -->

			</div><!-- .dd-product-main -->

		</div><!-- .dd-product-inner -->

	</div><!-- .dd-product -->

<?php endif; ?>