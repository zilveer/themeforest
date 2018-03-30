<?php global $product; ?>
<li>
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo $product->get_image(); ?>
		<span class="widget-product-title"><?php echo $product->get_title(); ?></span>
	</a>
        <?php echo $product->get_price_html(); ?>
	<?php if ( ! empty( $show_rating ) ) {

        $count   = $product->get_rating_count();
        $average = $product->get_average_rating();
        $avclass = trizzy_get_rating_class($average);

        if ( $count > 0 ) : ?>

            <div class="woocommerce-product-rating reviews-counter" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                <div class="star-rating rating <?php echo $avclass; ?>" title="<?php printf( __( 'Rated %s out of 5', 'trizzy' ), $average ); ?>">
                    <div class="star-rating"></div>
                    <div class="star-bg"></div>
                </div>
            </div>
    <?php endif;
    } ?>

</li>