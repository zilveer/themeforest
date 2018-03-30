<?php get_header(); ?>

	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>
	
	<!-- BEGIN .section -->
	<div class="section">
		
		<ul class="columns-content page-content clearfix">
			
			<!-- BEGIN .col-main -->
			<li class="<?php echo sidebar_position('primary-content'); ?>">
		
				<h2 class="page-title">
					<?php _e('Page Not Found', 'qns'); ?>
				</h2>
			
				<p><?php echo __('Oops! looks like you clicked on a broken link.','qns') . ' <a href="' . home_url() . '">' . __('Go home?</a>', 'qns') ?></p>
		
			<!-- END .col-main -->
			</li>
				
			<?php get_sidebar(); ?>
		
		</ul>
		
	<!-- END .section -->
	</div>

<?php get_footer(); ?>