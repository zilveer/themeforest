<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	
?>

		<div class='post-entry'>

			<div class="entry-content">	
				
				<?php 
				$titleClass = $avia_config['layout'];
				echo "<h1 class='post-title $titleClass'>".get_the_title()."</h1>";
				
				//embeded thumb gallery
				if(strpos($avia_config['layout'],'thumb') !== false && !post_password_required())
				{
					echo "<div class='hr_invisible '></div>";
					new avia_embed_images();
				}
				
				//display the actual post content
				the_content(__('Read more  &rarr;','avia_framework')); 
				
				if(!post_password_required())
				{	
					//check if this is the contact form page, if so display the form
	                $contact_page_id = avia_get_option('email_page');
	                
	                //wpml prepared
	                if (function_exists('icl_object_id'))
	                {
	                    $contact_page_id = icl_object_id($contact_page_id, 'page', true);
	                }
	                
					if($contact_page_id == $post->ID) get_template_part( 'includes/contact-form' );
					
				
					
					//embeded list gallery
					if(strpos($avia_config['layout'],'attached_images') !== false )
					{
						new avia_embed_images();
					}
					
					//embeded list gallery
					if(strpos($avia_config['layout'],'gallery_shortcode') !== false )
					{
						global $gallery_active;

						if(!$gallery_active)
                        {
                            $ids = array();
                            /* get slideshow images */
                            $attachments = avia_post_meta(get_the_ID(), 'slideshow');
                            if(!empty($attachments))
                            {
                                foreach($attachments as $attachment)
                                {
                                    $ids[] = $attachment['slideshow_image'];
                                }
                            }

                            /* check for images in the wordpress gallery */
                            $args = array(
                                'post_type' => 'attachment',
                                'numberposts' => -1,
                                'post_status' =>'any',
                                'post_parent' => get_the_ID(),
                                'exclude' => $ids
                            );
                            $attachments = get_posts($args);
                            if ($attachments) {
                                foreach ( $attachments as $attachment ) {
                                    $ids[] = $attachment->ID;
                                }
                            }

                            if(!empty($ids))
                            {
                                $ids = 'ids="' . implode(',', $ids) . '"';
                            }
                            else
                            {
                              $ids = '';
                            }
                            echo do_shortcode("[gallery $ids]");
                        }
					}
					
					//embeded 3 column gallery
					if(strpos($avia_config['layout'],'three_column') !== false )
					{
						new avia_three_column();
					}
				}
			
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