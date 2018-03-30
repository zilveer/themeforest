<?php 
global $avia_config, $post_loop_count, $slider; 
if($slider->slidecount) echo $slider->display(); ?>

<h1 class='post-title offset-by-one six units alpha'>
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?></a>
			</h1>
			
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
			
				
			 <span class='date-container minor-meta meta-color'><?php echo get_the_date(); ?></span>	
				<?php 
				the_content(__('Read more  &rarr;','avia_framework'));
				
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
						
						if(comments_open() || get_comments_number())
						{
							echo "<span class='comment-container minor-meta'>";
							comments_popup_link(" <span>0 ".__('Comments','avia_framework')."</span>", 
												" <span>1 ".__('Comment' ,'avia_framework')."</span>",
												" <span>% ".__('Comments','avia_framework')."</span>",'comments-link',
												__('Comments Off'  ,'avia_framework')); 	
							echo "</span>";	 
						}
				
						
						$cats = get_the_term_list(  get_the_ID(), 'portfolio_entries',"",", ","");
						if(!empty($cats))
						{
							echo '<span class="text-sep tweets-count-sep">/</span><span class="blog-categories minor-meta">'.__('posted in ','avia_framework');
							echo $cats;
							echo ' </span>';
						}
						
						
						/*
						echo '<span class="blog-author minor-meta">'.__('by ','avia_framework');
						the_author_posts_link(); 
						echo '</span><span class="text-sep">/</span>';
						
						echo '<span class="blog-permalink minor-meta">';
						echo "<a href='".get_permalink()."'>".__('#permalink','avia_framework')."</a>";
						echo '</span>';
						*/
						
						
						
						
						
						?>
					
					</div>	
					
				</div>

								
			</div>	