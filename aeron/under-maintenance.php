<?php
/*
Template Name: Under Maintenance
*/

get_header(); ?>

	<section id="under_maintenance">
		<div class="section_border_top_pattern">
			<div class="container">
				<div class="row">
					<div class="span4">
						<i class="ci_icon-wrench"></i>
					</div>
					<div class="span6">
						<?php 
							if ( have_posts() ) : while ( have_posts() ) : the_post();
								the_content();
							endwhile; 
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer();