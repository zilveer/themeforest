<?php

	// Prevent loading this file directly
	if ( ! defined( 'ABSPATH' ) ) { exit; }

	/* Template Name: Page with Sidebar */

?>
<?php get_header(); ?>
	
	<div id="main-container">

		<div class="container sidebar-open clearfix">

			<div id="content">
		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										
					<?php get_template_part('layout', 'page'); ?>
										
				<?php endwhile; endif; ?>

			</div>
			
			<?php get_sidebar(); ?>
				
		</div>

	</div>
	
<?php get_footer(); ?>