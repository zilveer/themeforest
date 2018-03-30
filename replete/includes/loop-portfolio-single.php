<?php 
global $avia_config, $slider, $post_loop_count; 


$post_class = "post-entry-".avia_get_the_id();
$slider 	= new avia_slideshow(avia_get_the_id());
$slider		->setImageSize('fullsize'); 

do_action( 'avia_action_query_check' , 'loop-portfolio-single' );


// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	
		
		?>
		<div class='post-entry post-entry-type-portfolio <?php echo $post_class; ?>'>
		
			<span class='entry-border-overflow extralight-border'></span>

			
			<div class="eight units alpha min_height_1">
				
					<?php if($slider->slidecount) echo $slider->display(); ?>
		        					
			</div>
			

			<div class="four units entry-content">	
			
			
			
			
				
			 <!--<span class='date-container minor-meta meta-color'><?php echo get_the_date(); ?></span>-->
				<?php 
				
				$meta = avia_portfolio_meta(get_the_ID());
				if($meta)
				{
					echo $meta;
					echo avia_advanced_hr(false, 'small');
				}
				
				the_content(__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>');				
				
				if(has_tag() && is_single())
				{	
					echo '<span class="text-sep">/</span><span class="blog-tags minor-meta">';
					echo the_tags('<strong>'.__('Tags: ','avia_framework').'</strong><span>'); 
					echo '</span></span>';
				}
				?>
				
				
				
				<div class='blog-inner-meta extralight-border'>
	        	
					<div class='post-meta-infos'>
						
						<?php 

						$cats = get_the_term_list(  get_the_ID(), 'portfolio_entries',"",", ","");
						if(!empty($cats))
						{
							echo '<span class="text-sep tweets-count-sep">/</span><span class="blog-categories minor-meta">'.__('posted in ','avia_framework');
							echo $cats;
							echo ' </span>';
						}

						?>
					
					</div>	
					
				</div>
								
			</div>	


		</div><!--end post-entry-->
		<?php
			
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