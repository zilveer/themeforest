<?php
/*
Template Name: Full Width
*/
get_header(); ?>
	<div id="page">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?>>
			<div class="entry-content" id="page-content">
				<h2 class="post_title"><?php the_title(); ?></h2>
				<?php the_content(); ?>
				<div class="clear"></div>
			</div><!-- end #page-content -->
		</div><!-- end #page -->
		<?php endwhile; endif; ?>
	</div><!-- end #page -->
<?php get_footer(); ?>