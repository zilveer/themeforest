<?php 
global $avia_config, $post_loop_count;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }
if(empty($post_loop_count)) $post_loop_count = 1;

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	if(empty($avia_config['layout'])) $avia_config['layout'] = "sidebar_right";
	
		//retrieve the post format that the user selected for this post
		if(!get_post_format()) 
		{
			get_template_part('includes/format', 'standard');
		} 
		else 
		{
			get_template_part('includes/format', get_post_format());
		}
	
	$post_loop_count++;		
	endwhile;		
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
	
<?php

	endif;
	
	if(!isset($avia_config['remove_pagination'] )) echo avia_pagination();	
?>