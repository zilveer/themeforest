<?php

/*
Template Name: Right Sidebar (for recipes)
*/

get_header(); ?>

<section class="basilHPBlock basilLeftContent">
	<div class="basilShell">
	
		<article class="basilPageContent">
			<?php
			basil_post_title(false);
			get_template_part('loop'); # Loop
			?>
		</article>
		
		<aside class="basilSidebar"><?php
			
			$sidebar = 'default-sidebar';
				
			echo '<div class="sidebar right">';
				echo '<ul class="widgets">';
					dynamic_sidebar($sidebar);
				echo '</ul>';
			echo '</div>';
			
		?></aside>
			
	</div>
</section>
			
<?php get_footer(); ?>