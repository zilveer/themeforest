<?php get_header(); ?>

<div class="content">

	<?php
		get_template_part( 'loop', 'index' );
		if ($wp_query->max_num_pages > 1) tie_pagenavi();
	?>
	
</div><!-- .content /-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>