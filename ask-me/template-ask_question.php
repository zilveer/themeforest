<?php ob_start();/* Template Name: Add question */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="page-content">
			<div class="boxedtitle page-title"><h2><?php the_title();?></h2></div>
			<?php the_content();
			echo do_shortcode("[ask_question]")?>
		</div><!-- End page-content -->
	<?php endwhile; endif;
get_footer();?>