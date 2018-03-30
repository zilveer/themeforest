<?php
get_header();
?>
	<div class="properties">
		<div class="container">
			<div class="grid_full_width">
				<?php get_template_part('templates/estate-loop/' . $pgl_options->option('estate_list_layout')) ?>
			</div>
		</div>
	</div>
<?php
get_footer();
?>