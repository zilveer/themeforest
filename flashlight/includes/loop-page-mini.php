<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	
?>

		<div class='post-entry entry-mini'>

			<div class="entry-content">	
				
				<?php 
				
				echo "<div class='box'>";
							
							echo "<div class='inner_box'>";
				
								echo "<h1 class='post-title'>".get_the_title()."</h1>";
								//display the actual post content
								the_content(__('Read more  &rarr;','avia_framework')); 
							echo "<div class='clearboth'></div><!--end inner_box-->";
							echo "</div><!--end inner_box-->";
							
					echo "</div><!--end box-->";
			
				 ?>	
			</div>							
		
		
		</div><!--end post-entry-->
		
		
<?php 
	endwhile;		
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<?php get_template_part('includes/error404'); ?>
	</div>
<?php

	endif;
?>