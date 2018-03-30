<?php get_header();
 
	echo '<header class="postheader">';
	echo epic_breadcrumbs('bcContent');
	echo '<h1>'.__('Sorry, this page does not seem to exist ','epic').'</h1>';
	echo '</header>';
	
	

		
	
	epic_article_alpha();
			echo '<section class="innercontent">';?>
			
		 	<p class="post-title"><?php _e('Please try something else..','epic');?></p>
		 	<?php get_template_part('searchform');?>
			<?php
			echo '</section>';
	epic_article_omega(); 

get_sidebar();

get_footer();?>

