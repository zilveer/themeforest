<?php 
/*
	Template Name: Shop
*/

get_header(); 

global $dd_sn;

if ( class_exists( 'woocommerce' ) ) {
	global $woocommerce; 
}

$posts_per_page = get_post_meta( get_the_ID(), $dd_sn . 'posts_per_page', true );

?>

	<div class="container clearfix">

		<div id="content">

			<?php

			if ( class_exists( 'woocommerce' ) ) :

				$woo_cart_url = $woocommerce->cart->get_cart_url();

				$wrapper_class = '';

				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 20
				);
				$dd_query = new WP_Query( $args );
				
				if ( $dd_query->have_posts() ) : $carousel_content = ''; ?>

					<div class="slider-container-loader"><img src="<?php echo get_template_directory_uri() . '/images/misc/ajax-loader.gif'; ?>"></div>

					<div class="products-slider">

						<div class="flexslider">

							<ul class="slides">

								<?php while ( $dd_query->have_posts() ) : $dd_query->the_post(); global $product;  ?>

									<?php 
										$product_bg_color = get_post_meta( get_the_ID(), $dd_sn . 'product_bg', true ); 
										if ( ! $product_bg_color ) {
											$product_bg_color = 'default';
										}
									?>

									<li data-bg-color="<?php echo $product_bg_color; ?>">

										<div class="product-slide-thumb">

											<?php if ( has_post_thumbnail() ) : ?>
												<?php the_post_thumbnail( 'full' ); ?>
											<?php endif; ?>

										</div><!-- .product-slide-thumb -->

										<div class="product-slide-main">

											<a href="<?php the_permalink(); ?>" class="product-slide-title"><?php the_title(); ?></a>

											<div class="product-slide-meta clearfix">
												
												<?php if ( $product->get_price_html() !== '' ) : ?>
													<a href="<?php the_permalink(); ?>" class="product-slide-price"><?php echo $product->get_price_html(); ?></a>
												<?php endif; ?>
												
												<div class="product-slide-excerpt"><?php the_excerpt(); ?></div>

											</div><!-- .product-slide-meta -->

											<div class="product-slide-links">
												<a href="<?php the_permalink(); ?>" class="dd-button medium blue"><span class="icon-text-doc"></span><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
												<a href="<?php echo do_shortcode( '[add_to_cart_url id="' . get_the_ID() . '"]' ); ?>" data-view-cart-url="<?php echo $woo_cart_url; ?>" data-load-text="<?php _e( 'ADDING', 'dd_string' ); ?>" data-view-cart-text="<?php _e( 'VIEW CART', 'dd_string' ); ?>" class="dd-button medium orange-light add-to-cart-ajax"><span class="icon-cart"></span><?php _e( 'ADD TO CART', 'dd_string' ); ?></a>
											</div><!-- .product-slide-links -->

										</div><!-- .product-slide-main -->

									</li>

								<?php
									$carousel_content .= '<li>' . get_the_post_thumbnail( get_the_ID(), 'dd-tiny' ) . '</li>';
								?>

								<?php endwhile; ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

					</div><!-- .products-slider -->

					<div class="products-carousel">

						<div class="flexslider">

							<ul class="slides">
								<?php echo $carousel_content; ?>
								<li class="products-carousel-fake-slide"></li>
							</ul><!-- .slides -->

						</div><!-- .flexslider -->

						<div class="products-carousel-nav">

							<a href="#" class="products-carousel-nav-prev"><span class="icon-chevron-left"></span></a>
							<a href="#" class="products-carousel-nav-next"><span class="icon-chevron-right"></span></a>

						</div><!-- .products-carousel-nav -->

						<div class="products-carousel-overlay-left"></div>
						<div class="products-carousel-overlay-right"></div>

					</div><!-- .products-carousel -->

				<?php endif; wp_reset_postdata();

			endif;

			?>

			<div class="separator"></div>

			<div class="dd-products dd-products-listing clearfix">

				<?php

					/* Query */

					if(is_front_page()){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }else{ $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; }
					$args = array(
						'paged' => $paged, 
						'post_type' => 'product',
						'posts_per_page' => $posts_per_page
					);
					$dd_query = new WP_Query($args);

					/* Vars */

					$dd_count = 0;

					/* Loop */

					if ($dd_query->have_posts()) : while ($dd_query->have_posts()) : $dd_query->the_post(); /* Loop the posts */ $dd_count++;
						
							get_template_part( 'templates/product', '' );

					endwhile; else:

						?><div class="align-center">There are no products. Go to WP admin &rarr; Posts &rarr; Add New.<br>You can read more about creating blog posts in the Documentation.</div><?php

					endif;

				?>

			</div><!-- .dd-products-listing -->

			<?php
				$num_pages = $dd_query->max_num_pages;
				dd_theme_pagination( $num_pages ); 
				wp_reset_postdata(); 
			?>

		</div><!-- #content -->

	</div><!-- .container -->

<?php get_footer(); ?>