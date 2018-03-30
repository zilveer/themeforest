<?php
/*
*	Template Portfolio Grid
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/
?>

<article id="grve-portfolio-item-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( 'grve-portfolio-item grve-isotope-item' ); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<div class="grve-isotope-item-inner">
			<figure class="grve-hover-style-2 grve-image-hover grve-zoom-none">
				<div class="grve-media">
					<?php
						blade_grve_print_portfolio_image( 'blade-grve-small-square' );
						if( function_exists( 'blade_grve_print_portfolio_like_counter' ) ) {
							blade_grve_print_portfolio_like_counter();
						}
					?>
				</div>
				<figcaption>
					<div class="grve-portfolio-content">
						<h3 class="grve-title grve-text-hover-primary-1 grve-h5"><?php the_title(); ?></h3>
					</div>
				</figcaption>
			</figure>
		</div>
	</a>
</article>