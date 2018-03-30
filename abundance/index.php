<?php 
global $avia_config;

	/*
	 * check which page template should be applied: 
	 * cecks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * located at the bottom of includes/helper-templates.php
	 */
	 avia_get_frontpage_template();


	/* 
	 * If the frontpage check above doesnt redirect the site to a static page or dynamic template show the default blog
	 */
	
	get_template_part( 'template', 'blog' );
	
	
	?>