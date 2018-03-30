<?php global $unf_options;
	if ($unf_options['breadcrumb'] == 1){
		if ( !is_page_template( 'page-home.php' ) ) {?>
		<?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>
<?php }
	} ?>