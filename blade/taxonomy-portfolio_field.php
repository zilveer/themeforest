<?php get_header(); ?>

<?php blade_grve_print_header_title( 'portfolio' ); ?>
<?php blade_grve_print_header_breadcrumbs( 'portfolio' ); ?>

<?php	
	$portfolio_style = 'fitRows';
	$columns = '3';
	$columns_tablet_landscape = '3';
	$columns_tablet_portrait = '2';
	$columns_mobile = '1';
?>

<!-- CONTENT -->
<div id="grve-content" class="clearfix">
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

								<div class="grve-portfolio grve-isotope grve-with-gap" data-gutter-size="40" data-columns="<?php echo esc_attr( $columns ); ?>" data-columns-tablet-landscape="<?php echo esc_attr( $columns_tablet_landscape ); ?>" data-columns-tablet-portrait="<?php echo esc_attr( $columns_tablet_portrait ); ?>" data-columns-mobile="<?php echo esc_attr( $columns_mobile ); ?>" data-layout="<?php echo esc_attr( $portfolio_style ); ?>" data-spinner="no">								
						<?php
							if ( have_posts() ) :
						?>
									<div class="grve-isotope-container">
						<?php
									// Start the Loop.
									while ( have_posts() ) : the_post();
										//Get post template
										get_template_part( 'templates/portfolio', 'grid' );

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
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
		<!-- End Content -->
	</div>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
