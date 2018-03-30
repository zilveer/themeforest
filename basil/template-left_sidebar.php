<?php

/*
Template Name: Left Sidebar (for recipes)
*/

get_header(); ?>

<section class="basilHPBlock basilRightContent">
	<div class="basilShell">
	
		<article class="basilPageContent">
			<?php
			basil_post_title(false);
			get_template_part('loop'); # Loop
			?>
		</article>
		
		<aside class="basilSidebar"><?php
			
			$sidebar = 'default-sidebar';
				
			echo '<div class="sidebar left">';
				echo '<ul class="widgets">';
					dynamic_sidebar($sidebar);
				echo '</ul>';
			echo '</div>';
			
		?></aside>
			
	</div>
</section>
			
<?php get_footer(); ?>