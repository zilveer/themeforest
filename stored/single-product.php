<?php

// Template for Cart66 Cloud

$product_sku = get_post_meta( get_the_ID(), '_cc_product_sku', true );

get_header(); ?>
<div id="single_product_page"><?php
	if (have_posts()) : while (have_posts()) : the_post();

		$images = cc_get_product_image_ids( get_the_ID() );
		if ( count( $images ) || has_post_thumbnail() ) {

			?><div <?php post_class(); ?>><?php

				if ( count( $images ) != 0 ) {
					?><div id="product_images"><?php
						if ( has_post_thumbnail() ) {
							$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);
							?><a id="main_product_image" href="<?php echo isset( $thumbnail[0] ) ? $thumbnail[0] : ''; ?>" class="lightbox">
								<span class="preview"></span>
								<?php the_post_thumbnail( 'product_main', array('alt' => get_the_title()) ); ?>
							</a><?php
						}

						if ( count( $images ) > 1 ) {

							?><div id="product_thumbs"><?php

									$featured_image = get_post_thumbnail_id(get_the_ID());
									$featured_image_url = wp_get_attachment_url( $featured_image );

									foreach ( $images as $image_id ) {

										$mini_image = wp_get_attachment_image_src( $image_id, 'product_mini_gallery' );
										$full_image = wp_get_attachment_image_src( $image_id, 'large' );
										if ( $image_id != $featured_image ) {
											?><a href="<?php echo $full_image[0]; ?>" class="lightbox">
												<span class="preview"></span>
												<img src="<?php echo $mini_image[0]; ?>" class="attachment-product_main wp-post-image">
											</a><?php
										}

									}

								?><div class="clear"></div>
							</div><?php
						}

						if ((get_the_term_list( $post->ID, 'types' ) != '') || (get_the_term_list( $post->ID, 'product_tags' ) != '') || (get_the_term_list( $post->ID, 'product-category' ) != '') ) { ?>
						<div class="single-product-meta">
							<?php if (get_the_term_list( $post->ID, 'product-category' ) != '') { ?>
							<span><?php echo get_the_term_list( $post->ID, 'product-category', 'Product Categories: ', ', ', '' ); ?></span>
							<?php } ?>

						</div><?php
						}
					?></div><!-- end #product_images -->


					<div id="product_info" class="entry-content">
				<?php } else { // else, if there are NOT images ?>
					<div id="product_info_full" class="entry-content">
				<?php } // end if there are images

						?><h2 class="post_title"><?php the_title(); ?></h2><?php
						the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

						<div id="cc2-form" class="Cart66CartButton">
							<span class="Cart66Price Cart66PriceBlock">
								<?php echo apply_money_styles( do_shortcode( '[cc_product_price sku="' . $product_sku . '"]' ) ); ?>
							</span>
							<?php echo do_shortcode( '[cc_product sku="' . $product_sku . '" quantity="true" price="false" display="vertical" ]' ); ?>
						</div>


					<?php // Start Cloud
					if (!defined( 'CC_VERSION_NUMBER' )&&class_exists('CC_Cart66Cloud')) { ?>
					<?php $cart66_product = cart66_get_product(get_post_meta($post->ID, '_dc_product_id', true)); ?>
					<?php if($cart66_product): ?>

						<!-- Start Cloud Pricing -->
					<div class="Cart66CartButton">

						<div id="price_container">
							<?php if(!empty($cart66_product['on_sale']) && !empty($cart66_product['sale_price'])): ?>
								<span class="price"><del><?php echo $cart66_product['formatted_price']; ?></del></span><span class="price sale-price"><?php echo $cart66_product['formatted_sale_price']; ?></span>
							<?php else: ?>
								<span class="price"><?php echo $cart66_product['formatted_price']; ?></span>
							<?php endif; ?>


							 <div class="clear"></div>
						</div><!-- end Cloud Pricing -->

						<div class="clear"></div>
					</div>
					<?php endif; ?>
					<?php } // End Cloud ?>

					</div><!-- end #product_info -->

					<div class="clear"></div>
			</div><!-- end .post_class --><?php

		if (of_get_option('product_comments') == 'yes') {
			?><div id="product_comments"><?php
			comments_template('', true);
			?></div><?php
		}

	}

	endwhile; else: ?>
		<h2 class="page_title"><?php _e('Sorry, we can\'t seem to find what you\'re looking for.', 'designcrumbs'); ?></h2>
		<p><?php _e('Please try one of the links on top.', 'designcrumbs'); ?></p><?php
	endif;

	?><div class="clear"></div>

</div><!-- end #single_product_page -->
<?php get_footer(); ?>