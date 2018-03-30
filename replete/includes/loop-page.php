<?php 
global $avia_config, $post_loop_count;

$post_loop_count= 1;
$post_class 	= "post-entry-".avia_get_the_id();
$slider 		= new avia_slideshow(avia_get_the_id());
$slider->setImageSize('featured_small');

		
		
		
do_action('avia_action_query_check','loop-page');

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
?>

		<div class='post-entry post-entry-type-page <?php echo $post_class; ?>'>
		
			<span class='entry-border-overflow extralight-border'></span>
			
			<?php if($slider->slidecount) echo $slider->display(); ?>
			
			
			<div class="<?php avia_layout_class('content'); ?> alpha units entry-content">	
				
				<?php 
				
				echo avia_small_title();
				
				//display the actual post content
				the_content(__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>'); 
				
				wp_link_pages(array('before' =>'<div class="pagination_split_post">',
				    					'after'  =>'</div>',
				    					'pagelink' => '<span>%</span>'
				    					)); 
				
				//check if this is the contact form page, if so display the form
                $contact_page_id = avia_get_option('email_page');
                
                
                //check if the page got a contact form applied
				if(isset($post->ID) && $contact_page_id == $post->ID && !post_password_required()) get_template_part( 'includes/contact-form' );
			
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