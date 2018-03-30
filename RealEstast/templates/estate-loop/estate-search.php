<?php
get_header();
global $pgl_options;
?>
	<div class="properties">
		<div class="container">
			<div class="grid_full_width">
				<?php
				if( have_posts() ) {
					$template = 'templates/estate-loop/' . $pgl_options->option('estate_search_layout');
				 	get_template_part($template);
				} else {
					?>
					<div class="error404">
						<h1><?php _e('Oops...', PGL)?></h1>
						<p><?php _e('No result found.', PGL)?></p>
						<a href="<?php echo get_home_url() ?>"><?php _e('Return to the home page', PGL);?></a>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
<?php
get_footer();
?>