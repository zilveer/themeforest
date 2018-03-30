<?php
get_header();
?>
	<div class="properties">
		<div class="container">
			<div class="grid_full_width">
				<!-- Error 404 -->
				<div class="error404">
					<h1><?php _e('404', PGL)?></h1>
					<p><?php _e('The page cannot be found.', PGL);?></p>
					<a href="<?php echo get_home_url() ?>"><?php _e('Return to the home page', PGL);?></a>
				</div>
				<!-- End Error 404 -->
			</div>
		</div>
	</div>
<?php
get_footer();