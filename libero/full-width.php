<?php 
/*
Template Name: Full Width
*/ 
?>
<?php
$sidebar = libero_mikado_sidebar_layout(); ?>

<?php get_header(); ?>
<?php libero_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>

<div class="mkd-full-width">
<div class="mkd-full-width-inner">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if(($sidebar == 'default')||($sidebar == '')) : ?>
			<?php the_content(); ?>
			<?php do_action('libero_mikado_page_after_content'); ?>
		<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
			<div <?php echo libero_mikado_sidebar_columns_class(); ?>>
				<div class="mkd-column1 mkd-content-left-from-sidebar">
					<div class="mkd-column-inner">
						<?php the_content(); ?>
						<?php do_action('libero_mikado_page_after_content'); ?>
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
						<?php the_content(); ?>
						<?php do_action('libero_mikado_page_after_content'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
</div>
<?php get_footer(); ?>