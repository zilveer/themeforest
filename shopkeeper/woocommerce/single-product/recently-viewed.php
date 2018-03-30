<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
                
$args = array( 
	'posts_per_page' => 4,
	'no_found_rows' => 1,
	'post_status' => 'publish',
	'post_type' => 'product',
	'post__in' => $viewed_products,
	'orderby' => 'rand'
);

$args['meta_query'] = array();
$args['meta_query'][] = WC()->query->stock_status_meta_query();
$args['meta_query'] = array_filter( $args['meta_query'] );

$temp_post = $post; // Storing the object temporarily

$recently_viewed = new WP_Query($args);

if ( $recently_viewed->have_posts() ) {

	echo '<h2>' . __( 'Recently Viewed', 'woocommerce' ) . '</h2>';
	echo '<ul>';

	while ( $recently_viewed->have_posts()) {
		$recently_viewed->the_post();
		global $product;
	?>
	
	<li>
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo $product->get_image(); ?>
		</a>
	</li>
	
	<?php
	}

	echo '</ul>';
}

$post = $temp_post; // Restore the value of $post to the original
wp_reset_query();