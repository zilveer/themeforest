<?php if(($sidebar == 'default')||($sidebar == '')) : ?>
	<?php hashmag_mikado_get_blog_type($blog_type); ?>
<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
	<div <?php echo hashmag_mikado_sidebar_columns_class(); ?>>
		<div class="mkdf-column1 mkdf-content-left-from-sidebar">
			<div class="mkdf-column-inner">
				<?php hashmag_mikado_get_blog_type($blog_type); ?>
			</div>
		</div>
		<div class="mkdf-column2">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
	<div <?php echo hashmag_mikado_sidebar_columns_class(); ?>>
		<div class="mkdf-column1">
			<?php get_sidebar(); ?>
		</div>
		<div class="mkdf-column2 mkdf-content-right-from-sidebar">
			<div class="mkdf-column-inner">
				<?php hashmag_mikado_get_blog_type($blog_type); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

