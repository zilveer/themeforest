<?php get_header(get_post_meta($post->ID, 'header_choice_select', true)); ?>

<div id="container_bg">
	<div id="content_full" >
	
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			
			<?php if (ot_get_option('page_comments')) {
				comments_template( '', true );
			} ?>	
		<?php endwhile; ?>
			
	</div><!-- #content -->
</div><!-- #container -->
<?php get_footer(); ?>