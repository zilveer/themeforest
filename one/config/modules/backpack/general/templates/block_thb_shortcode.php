<?php thb_builder_fake_query(); ?>

<?php
	global $wp_query;
	$shortcode_query = $wp_query;
?>

<?php if( $shortcode_query->have_posts() ) : while( $shortcode_query->have_posts() ) : $shortcode_query->the_post(); ?>

	<div class="thb-section-block-content">

		<div class="thb-text">
			<?php if ( $shortcode != '' ) : ?>
				<?php echo do_shortcode( $shortcode ); ?>
			<?php endif; ?>
		</div>

	</div>

<?php endwhile; endif; ?>

<?php wp_reset_query(); ?>