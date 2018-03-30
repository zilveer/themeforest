<?php 
global $avia_config, $post_loop_count;

$post_loop_count= 1;
$post_class 	= "post-entry-".@get_the_ID();
$slider 		= new avia_slideshow(@get_the_ID());
if($slider->slidecount) 
{
	$post_class .= " with_slideshow";
	if($post_loop_count === 1)
	{	
		$slider->customClass('big-slideshow');
		$post_class .= " big-slideshow-post";
	}
	else
	{
		$slider->customClass('seven units alpha offset-by-one');
	}
}
		
		
		
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
?>

		<div class='post-entry post-entry-type-page <?php echo $post_class; ?>'>
		
			<span class='entry-border-overflow extralight-border'></span>
			
			<?php if($slider->slidecount) echo $slider->display(); ?>
			
			<!--meta info-->
	        <div class="one unit alpha blog-meta">
	        	
	        	<div class='side-container side-container-date'>
	        		
	        		<div class='side-container-inner'>
	        		
	        			<span class='date-day'><?php the_time('d') ?></span>
   						<span class='date-month'><?php the_time('M') ?></span>
   						
	        		</div>
	        		
	        	</div>
				
			</div><!--end meta info-->	

			
			<div class="six units entry-content">	
				
				<?php 
				echo "<h1>".get_the_title(avia_get_the_id())."</h1>";
				
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
                
				if(isset($post->ID) && $contact_page_id == $post->ID) get_template_part( 'includes/contact-form' );
			
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