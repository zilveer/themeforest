<?php
// Template Name: HomePage
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

<div id="main">
	<div id="homepage-content">
		<div class="width-container">
			
			<!-- this code pull in the homepage content -->
			<?php while(have_posts()): the_post(); ?>
				<?php if($post->post_content=="") : ?><?php else : ?>
				<div id="homepage-content-container">
					<?php the_content(); ?>
					<div class='clearfix'></div>
				</div>
				<?php endif; ?>
			<?php endwhile; ?>
			<div class="clearfix"></div>
			
			<!-- widgets added in the footer.php file -->			
	
		</div><!-- close .width-container -->
	</div><!-- close #homepage-content -->

<!-- #main closes in footer -->
<?php get_footer(); ?>