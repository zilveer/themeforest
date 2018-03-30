<?php get_header(); ?>
<?php get_template_part('_subheader'); ?>

<div class="container fix <?php if(!wpb_option('sidebar-enable')) echo 'no-sidebar'; ?>">
		
	<div id="page-title">
		<h2><?php _e('Error 404. <span>Oops!</span>','feather'); ?></h2>
	</div><!--/page-title-->

	<div id="content-part">
		<article class="entry">
			<div class="pad">
				<div class="text">
					<h1><?php _e('Something went wrong.','feather'); ?></h1>
					<p><?php _e('The page you are looking for could not be found.','feather'); ?></p>
					<div class="clear"></div>
				</div>
			</div>
		</article>
	</div><!--/content-part-->
	
	<?php if ( wpb_option('sidebar-enable') ): ?>
		<div id="sidebar" class="sidebar-right">
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
	<?php endif; ?>
		
</div><!--/container-->

<?php get_footer(); ?>