<?php if(($sidebar == "default")||($sidebar == "")) : ?>

	<div class="eltd-blog-holder eltd-blog-single">
		<?php flow_elated_get_single_html(); ?>
	</div>

<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>

	<div <?php echo flow_elated_sidebar_columns_class(); ?>>
		<div class="eltd-column1 eltd-content-left-from-sidebar">
			<div class="eltd-column-inner">
				<div class="eltd-blog-holder eltd-blog-single">
					<?php flow_elated_get_single_html(); ?>
				</div>
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
				<div class="eltd-blog-holder eltd-blog-single">
					<?php flow_elated_get_single_html(); ?>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>
