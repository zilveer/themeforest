<?php 

		global $avia_config, $post_loop_count; 
		$post_class 	= "post-entry-".get_the_ID();
		$post_format 	= get_post_format() ? get_post_format() : 'standard';
		$slider 		= new avia_slideshow(get_the_ID());
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
?>


		<div class='post-entry post-entry-type-<?php echo $post_format." ".$post_class; ?>'>
		
			<span class='entry-border-overflow extralight-border'></span>
			
			<?php if($slider->slidecount) echo $slider->display(); ?>

			<div class="seven alpha units entry-content offset-by-one">	
			
			
			 
			 	<blockquote class='first-quote'>
						<?php the_title(); ?>
				</blockquote>
				<?php 
				echo "<div class='quote-content'>";
				the_content(__('Read more  &rarr;','avia_framework'));  
				echo "</div>";
				
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
							echo "</span><span class='text-sep comment-container-sep'>/</span>";	 
						}
						else
						{
							echo '<span class="blog-permalink minor-meta">';
							echo "<a href='".get_permalink()."'>".__('#permalink','avia_framework')."</a>";
							echo '</span><span class="text-sep comment-container-sep">/</span>';
						}
						
						$cats = get_the_category();
						if(!empty($cats))
						{
							echo '<span class="blog-categories minor-meta">'.__('posted in ','avia_framework');
							the_category(', ');
						echo '</span><span class="text-sep blog-cat-sep">/</span>';
						}
						
						echo "<span class='date-container minor-meta'>";
						echo get_the_date();
						echo '</span>';
						
												
						
						
						/*
						echo '<span class="text-sep permalink-sep">/</span><span class="blog-author minor-meta">'.__('by ','avia_framework');
						the_author_posts_link(); 
						echo '</span><span class="text-sep">/</span>';

						*/
						
						
						
						
						
						?>
					
					</div>	
					
				</div>

								
			</div>	
			

		</div><!--end post-entry-->