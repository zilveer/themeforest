<?php
/**
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 * Template name: Portfolio
 */
get_header(); ?>

<?php thb_page_before(); ?>

	<div id="page-content">

		<?php thb_page_start(); ?>

		<?php get_template_part('partials/partial-pageheader' ); ?>

		<?php thb_page_content_start(); ?>

		<div class="thb-section-container <?php echo thb_pagecontent_skin(); ?>">

			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

				<?php if ( get_the_content() != '' || ! function_exists('thb_portfolio_loop' ) ) : ?>

					<div id="main-content">

						<?php global $more; $more = 0; ?>

						<?php if ( get_the_content() != '' || apply_filters( 'the_content', '' ) ) : ?>

							<div class="thb-text">
								<?php if ( get_the_content() ) : ?>
									<?php the_content(); ?>
								<?php else : ?>
									<?php echo apply_filters( 'the_content', '' ); ?>
								<?php endif; ?>
							</div>

						<?php endif; ?>

						<?php
							if( ! function_exists('thb_portfolio_loop') ) {
								echo "<p class='thb-message warning'>" . __( "It looks like the THB Portfolio plugin is not active.</br>Please install or activate it in order to display your portfolio items.", "thb_text_domain" ) . "</p>";
							}
						?>

					</div>

				<?php endif; ?>

			<?php endwhile; endif; ?>

			<?php if ( function_exists( 'thb_portfolio_loop' ) ) : ?>
				<div id="thb-portfolio-container" class="thb-portfolio <?php echo thb_get_portfolio_filter_alignment(); ?>" <?php thb_portfolio_data_attributes(); ?>>
					<?php
						thb_portfolio_filter();
						thb_portfolio_loop();
						thb_pagination();
					?>
				</div>
			<?php endif; ?>

		</div>

	<?php thb_page_end(); ?>

	</div>

<?php thb_page_after(); ?>

<?php get_footer(); ?>