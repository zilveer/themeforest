<?php
/**
 * Campaign Taxonomy Page
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
get_header();

?>

<div class="sd-campaign-listing sd-campaigns">
	<div class="container">
			<div class="row">
				<div class="sd-listing-content">
					<?php $i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div class="col-md-4 col-sm-4 sd-listing-item">
								<?php
									get_template_part('framework/inc/vc/shortcodes/sd-campaign-carousel/sd-campaign-item-carousel');
								?>
							</div>
							<!-- col-md-4 -->
							<?php $i++; if ( $i == 3 ) { echo '<div class="clearfix"></div>'; $i = 0; } ?>
					<?php endwhile; endif; wp_reset_postdata(); ?>	
				</div>
				<!-- sd-listing-content -->
			</div>
			<!-- row -->
			<?php sd_custom_pagination(); ?>
		</div>
		<!-- container -->
	</div>
	<!-- sd-campaign-listing -->

<?php get_footer(); ?>