<?php ob_start();/* Template Name: Add post */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="page-content">
			<div class="boxedtitle page-title"><h2><?php the_title();?></h2></div>
			<?php the_content();
			echo do_shortcode("[add_post]")?>
		</div><!-- End page-content -->
	<?php endwhile; endif;
get_footer();?>