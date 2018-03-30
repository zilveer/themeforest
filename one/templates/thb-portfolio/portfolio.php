<?php

if ( !isset( $args ) ) {
	$args = array();
}

thb_portfolio_query( $args );

if ( !isset( $layout ) ) {
	$layout = false;
}

if ( !isset( $params ) ) {
	$params = array();
}

$thb_portfolio_layout = thb_get_portfolio_layout( $layout );
$classes = $thb_portfolio_layout;
$data_attrs = array();

if ( isset( $params['carousel'] ) && $params['carousel'] == '1' ) {
	$classes .= ' thb-carousel';
	$data_attrs = thb_get_carousel_attributes( $params );
}
else {
	$classes .= ' ' . thb_get_portfolio_classes( $columns, $gutter );
}

$thb_size = thb_get_grid_image_size( $columns, $images_height );

?>

<?php if( have_posts() ) : ?>

	<ul class="<?php echo $classes; ?>" <?php thb_attributes( $data_attrs ); ?>>
		<?php while( have_posts() ) : ?>
			<?php
				the_post();
				thb_portfolio_item( array(
					'thb_portfolio_layout' => $thb_portfolio_layout,
					'thb_size'             => $thb_size
				) );
			?>
		<?php endwhile; ?>
	</ul>

<?php endif; ?>