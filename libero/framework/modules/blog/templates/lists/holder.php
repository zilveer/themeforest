<?php if(($sidebar == 'default')||($sidebar == '')||($sidebar == 'no-sidebar')) : ?>
	<?php libero_mikado_get_blog_type($blog_type); ?>
<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
	<div <?php echo libero_mikado_sidebar_columns_class(); ?>>
		<div class="mkd-column1 mkd-content-left-from-sidebar">
			<div class="mkd-column-inner">
				<?php libero_mikado_get_blog_type($blog_type); ?>
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
				<?php libero_mikado_get_blog_type($blog_type); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

