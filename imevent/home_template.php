<?php 
/** Template Name: Home Template  */

get_header();
	while(have_posts()): the_post(); ?>
		<div class="container">
			<div class="row">
				<?php the_content(); ?>
			</div>
		</div>
    <?php endwhile;
get_footer();