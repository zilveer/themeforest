<div class="breadcrumbs <?php echo is_page_template( 'template-builder-page.php' ) ? ' breadcrumbs--page-builder' : ''; ?>" id="project-navigation-anchor">
	<div class="container">
		<?php
			if( function_exists( 'bcn_display' ) ) {
				bcn_display();
			}
		?>
	</div>
</div>