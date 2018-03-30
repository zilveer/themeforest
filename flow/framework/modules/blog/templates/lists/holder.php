<?php
if(($sidebar == 'default')||($sidebar == 'no-sidebar')) : ?>

	<?php flow_elated_get_blog_type($blog_type, $sidebar); ?>
	<?php the_posts_pagination(); ?>

<?php

elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>

	<?php $slider_position = flow_elated_get_blog_slider_position(); ?>

	<div <?php echo flow_elated_sidebar_columns_class(); ?>>
		<div class="eltd-column1 eltd-content-left-from-sidebar">
			<div class="eltd-column-inner">
				<?php
				if($slider_position === 'above_content'){
					get_template_part('slider');
				}?>
				<?php flow_elated_get_blog_type($blog_type,$sidebar); ?>
				<?php the_posts_pagination(); ?>
			</div>
		</div>
		<div class="eltd-column2">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
	<div <?php echo flow_elated_sidebar_columns_class(); ?>>
		<div class="eltd-column1">
			<?php get_sidebar(); ?>
		</div>
		<div class="eltd-column2 eltd-content-right-from-sidebar">
			<div class="eltd-column-inner">
				<?php if($slider_position === 'above_content'){
					get_template_part('slider');
				}?>
				<?php flow_elated_get_blog_type($blog_type, $sidebar); ?>
				<?php the_posts_pagination(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

