<?php get_header(); ?>


<?php blade_grve_print_header_title( 'blog' ); ?>
<?php blade_grve_print_header_breadcrumbs( 'post' ); ?>

<!-- CONTENT -->
<div id="grve-content" class="clearfix <?php echo blade_grve_sidebar_class( 'blog' ); ?>">
	<div class="grve-content-wrapper">
		<!-- MAIN CONTENT -->
		<div id="grve-main-content">
			<div class="grve-main-content-wrapper clearfix">

				<div class="grve-section" style="margin-bottom: 0px;">

					<div class="grve-container">

						<!-- ROW -->
						<div class="grve-row">

							<!-- COLUMN 1 -->
							<div class="grve-column-1">

								<!-- Blog FitRows -->
								<?php
									$grve_blog_style = blade_grve_option( 'blog_style', 'large' );
									$grve_blog_class = blade_grve_get_blog_class();
								?>
								<div class="<?php echo esc_attr( $grve_blog_class ); ?>" <?php blade_grve_print_blog_data(); ?>>

									<?php
									if ( have_posts() ) :
										if ( 'large' == $grve_blog_style || 'small' == $grve_blog_style ) {
									?>
										<div class="grve-standard-container">
									<?php
										} else {
									?>
										<div class="grve-isotope-container">
									<?php
										}

									// Start the Loop.
									while ( have_posts() ) : the_post();
										//Get post template
										get_template_part( 'content', get_post_format() );
									endwhile;

									?>
									</div>
									<?php
										// Previous/next post navigation.
										blade_grve_paginate_links();
									else :
										// If no content, include the "No posts found" template.
										get_template_part( 'content', 'none' );
									endif;
									?>

								</div>
								<!-- End Element Blog -->
							</div>
							<!-- END COLUMN 1 -->

						</div>
						<!-- END ROW -->

					</div>

				</div>

			</div>
		</div>
		<!-- End Content -->
		<?php
			blade_grve_set_current_view( 'blog' );
			if ( is_front_page() ) {
				//blade_grve_set_current_view( 'frontpage' );
			}
		?>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
