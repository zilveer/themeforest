<?php 
global $avia_config;

	/*
	 * check which page template should be applied: 
	 * checks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * the function avia_get_frontpage_template() located at the top of includes/helper-template-logic.php is
 	 * responsible for all those checks
	 */
	 do_action('avia_action_frontpage_check');


	/* 
	 * If the frontpage check above doesnt redirect the site to a static page or dynamic template show the default blog
	 */
	
	get_template_part( 'template', 'blog' );
	
	
	?>