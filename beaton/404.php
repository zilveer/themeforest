<?php

get_header();

echo '
	<div id="wrap" class="fixed">
	
	<div class="page-title">
		<h1 class="blog">' . esc_html__( "404 ERROR - Not Found", "wizedesign" ) . '</h1>
	</div><!-- end .page-title -->
	<div class="error-404">
		<h4>' . esc_html__( "The page you requested does not exist.", "wizedesign" ) . '</h4>
	</div><!-- end .error-404 -->';

get_footer();