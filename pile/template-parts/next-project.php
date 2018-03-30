<?php
/**
 * The template for the next project area link.
 *
 * @package Pile
 * @since   Pile 2.0
 */

$next_post = get_previous_post();

if ( empty( $next_post ) ) {
	//it seems we are at the last project
	//then link to the first project so we go round and round and ...
	$next_post = pile_get_boundary_post( false, '', false );
}

if ( ! empty( $next_post ) ) {
	// hijack the post so we can treat the next post in a regular fashion
	$post = $next_post;
	setup_postdata( $post );

	//get the next project's hero background color - this time we will use it as border color
	$border_color = pile_get_the_hero_background_color(); ?>

	<div class="hero hero--next">
		<div class="hero-slider" style="background-color: <?php echo $border_color; ?>">
			<?php
			// we need the next project's first hero slide
			$slides = pile_get_hero_slides_ids( $post );
			foreach ( $slides as $key => $attachment_id ) {
				pile_the_hero_slide_background( $attachment_id );
				break;
			} ?>
		</div><!-- .hero-slider -->
		<div class="hero-content">
			<?php the_title('<span class="hero--next__title meta">', '</span>'); ?>
			<h2 class="hero--next__label"><?php esc_html_e('Next Project', 'pile'); ?></h2>
			<span class="hero--next__cta meta"><?php esc_html_e('See More', 'pile'); ?></span>
		</div><!-- .hero-content -->
		<a class="hero--next__link" data-color="<?php echo $border_color; ?>" href="<?php the_permalink(); ?>"></a>
	</div><!-- .hero.hero-next -->
	<?php
	// bring back order to the world
	wp_reset_postdata();
}
