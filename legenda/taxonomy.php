<?php 
	get_header();
?>

<?php et_page_heading(); ?>

<div class="container">
	<div class="page-content">
		<div class="row-fluid">
			<div class="span8">
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>
					
					<?php get_template_part('content', get_post_format()); ?>

				<?php endwhile; else: ?>

					<h3><?php _e('No posts were found!', ETHEME_DOMAIN) ?></h3>

				<?php endif; ?>

				<div class="articles-nav">
					<div class="left"><?php next_posts_link(__('&larr; Older Posts', ETHEME_DOMAIN)); ?></div>
					<div class="right"><?php previous_posts_link(__('Newer Posts &rarr;', ETHEME_DOMAIN)); ?></div>
					<div class="clear"></div>
				</div>

			</div>
			<div class="span4">
				<?php get_sidebar(); ?>
			</div>
		</div>


	</div>
</div>

	
<?php
	get_footer();
?>