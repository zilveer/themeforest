<?php
/**
 * 
 * template for displaying portfolio detail page
 *
 */

get_header(); ?>
<section class="content_block_background">
	<section class="content_block clearfix">
		<section id="post-<?php the_ID(); ?>" <?php post_class("content ".$rt_sidebar_location[0]); ?> >		

	 		<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_portfolio', array( "called_for" => "inside_content" ) ) ); ?>

			<?php get_template_part( "/portfolio-contents/single-portfolio", "content" ); ?>

		</section><!-- / end section .content -->
		<?php get_sidebar(); ?>
	</section>
</section>		
<?php get_footer(); ?>
