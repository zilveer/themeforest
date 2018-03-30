<?php get_header(); ?>

		<!-- Row for main content area -->
		<div id="content" class="<?php echo implode(' ', jwLayout::content_width()); ?> columns" role="main">
	
			<div class="post-box">
				<?php  get_template_part('loop', 'page'); ?>
			</div>

		</div><!-- End Content row -->
		
<?php get_footer(); ?>