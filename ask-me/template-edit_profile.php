<?php ob_start();/* Template Name: Edit profile */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="page-content">
			<div class="boxedtitle page-title"><h2><?php the_title();?></h2></div>
			<div class="form-style form-style-4">
				<?php echo do_shortcode("[ask_edit_profile]")?>
			</div><!-- End page-content -->
		</div><!-- End main -->
	<?php endwhile; endif;
get_footer();?>