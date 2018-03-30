<?php if(($sidebar == "default")||($sidebar == "")||($sidebar == "no-sidebar")) : ?>
	<div class="mkd-blog-holder mkd-blog-single">
		<?php libero_mikado_get_single_html(); ?>
	</div>
<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
	<div <?php echo libero_mikado_sidebar_columns_class(); ?>>
		<div class="mkd-column1 mkd-content-left-from-sidebar">
			<div class="mkd-column-inner">
				<div class="mkd-blog-holder mkd-blog-single">
					<?php libero_mikado_get_single_html(); ?>
				</div>
			</div>
		</div>
		<div class="mkd-column2">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
	<div <?php echo libero_mikado_sidebar_columns_class(); ?>>
		<div class="mkd-column1">
			<?php get_sidebar(); ?>
		</div>
		<div class="mkd-column2 mkd-content-right-from-sidebar">
			<div class="mkd-column-inner">
				<div class="mkd-blog-holder mkd-blog-single">
					<?php libero_mikado_get_single_html(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
