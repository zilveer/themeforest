<?php
/*
Template Name: Right sidebar
*/
?>

<?php if (get_post_meta($post->ID, 'header_choice_select', true));{ get_header(get_post_meta($post->ID, 'header_choice_select', true)); } ?>
<div id="container_bg">
	<div id="content_left">
	
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			
			<?php if (ot_get_option('page_comments')) {
				comments_template( '', true );
			} ?>	
		<?php endwhile; ?>
			
	</div><!--#content -->

	<div id="sidebar_right">
		<?php get_sidebar(); ?>
	</div><!--#sidebar_right-->

	<div class="clear"></div>
</div><!-- #container -->
<?php get_footer(); ?>