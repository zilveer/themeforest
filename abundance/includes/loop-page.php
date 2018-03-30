<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	$slider = new avia_slideshow(get_the_ID());
	$image_size = "page";
?>

		<div class='post-entry'>
			
			
			<?php 
								
			//call the function that displays featured images and slideshows within posts
			if(strpos($avia_config['layout'], 'big_image') !== false) $image_size = 'page';
			if(strpos($avia_config['layout'], 'fullwidth') !== false) $image_size = 'featured';
			if(strpos($avia_config['layout'], 'medium_image') !== false) $image_size = 'blog';
			
 	 		$slideHtml = $slider->display_small($image_size);
 	 		if($slideHtml)
 	 		{
 	 			echo $slideHtml;
 	 			$avia_config['slider_first_post_active'] = true;
 	 		}
			?>

			
			<div class="entry-content">	
				
				<?php 
				
				//echo "<h1 class='post-title'>".get_the_title()."</h1>";
				//display the actual post content
				the_content(__('Read more  &rarr;','avia_framework')); 
				
				//check if this is the contact form page, if so display the form
                $contact_page_id = avia_get_option('email_page');
                
                //wpml prepared
                if (function_exists('icl_object_id'))
                {
                    $contact_page_id = icl_object_id($contact_page_id, 'page', true);
                }
                
				if($contact_page_id == $post->ID) get_template_part( 'includes/contact-form' );
			
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