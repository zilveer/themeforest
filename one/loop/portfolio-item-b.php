<?php
	$thb_fi = $args['thb_fi'];
	$item_id = url_to_postid( thb_portfolio_item_get_permalink() );
	$featured_image = get_post_thumbnail_id( $item_id );
	$alt = get_post_meta($featured_image, '_wp_attachment_image_alt', true);
?>

<?php if ( thb_is_portfolio_likes_active() && $thb_fi != '' ) : ?>
	<?php thb_like(); ?>
<?php endif; ?>

<?php if( $thb_fi != '' ) : ?>
	<a href="<?php echo thb_portfolio_item_get_permalink(); ?>" rel="bookmark" class="work-thumb">
		<img src="<?php echo $thb_fi; ?>" alt="<?php echo esc_html( $alt ); ?>">

		<?php thb_get_template_part( 'templates/thb-portfolio/portfolio-item-data', $args ); ?>
	</a>
<?php endif; ?>

<?php if ( $thb_fi == '' ) : ?>
	<?php thb_get_template_part( 'templates/thb-portfolio/portfolio-item-data-a', $args ); ?>
<?php endif; ?>