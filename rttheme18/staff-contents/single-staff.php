<?php
/**
 * 
 * template for displaying staff detail page
 *
 */
global $rt_sidebar_location;
get_header(); ?>
<section class="content_block_background">
	<section class="content_block clearfix">
		<section id="staff-<?php the_ID(); ?>" <?php post_class("content ".$rt_sidebar_location[0]); ?> >		
 
			<?php get_template_part( "/staff-contents/single-staff", "content" ); ?>

		</section><!-- / end section .content -->
		<?php get_sidebar(); ?>
	</section>
</section>		
<?php get_footer(); ?>