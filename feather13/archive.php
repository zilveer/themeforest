<?php get_header(); ?>
<?php get_template_part('_subheader'); ?>

<div class="container fix <?php if(!wpb_option('sidebar-enable')) echo 'no-sidebar'; ?>">
	
	<?php if(!wpb_option('disable-archive-heading')): ?>
		<div id="page-title">
			<h2><?php echo wpb_archive_heading(); ?></h2>
		</div><!--/page-title-->
	<?php endif; ?>
	
	<div id="content-part">
		<?php get_template_part('_loop'); ?>
	</div><!--/content-part-->
	
	<?php if(wpb_option('sidebar-enable')): ?>
		<div id="sidebar" class="sidebar-right">	
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
	<?php endif; ?>
		
</div><!--/container-->

<?php get_footer(); ?>