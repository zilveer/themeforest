<?php 

		global $avia_config, $post_loop_count; 
		$post_class 	= "post-entry-".get_the_ID();
		$post_format 	= get_post_format() ? get_post_format() : 'standard';
		$slider 		= new avia_slideshow(get_the_ID());
		$slider->setImageSize('fullsize');
		$slider->modify_slide_poster("default");
		$content 		= get_the_content();
		
		if(!$slider->slidecount) 
		{
			$attachments = get_children(array('post_parent' => get_the_ID(),
			            'post_status' => 'inherit',
			            'post_type' => 'attachment',
			            'post_mime_type' => 'image',
			            'order' => 'ASC',
			            'orderby' => 'menu_order ID'));
			            
			if(is_array($attachments) && !empty($attachments))
			{
				$slider->set_image_ids($attachments);
			}
		}
				
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
		
		if(trim($content) == "") $post_class .= " no_content_post";
?>


		<div class='post-entry post-entry-type-<?php echo $post_format." ".$post_class; ?>'>
		
			<span class='entry-border-overflow extralight-border'></span>
			
			<?php if($slider->slidecount) echo $slider->display(); ?>

			<h1 class='post-title offset-by-one '>
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?>
					<span class='post-format-icon minor-meta'></span>
					</a>
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
			

			<div class="seven units entry-content">	
			
			 <span class='date-container minor-meta meta-color'><?php echo get_the_date(); ?></span>	
				<?php 
				the_content(__('Read more  &rarr;','avia_framework'));
				
				if(has_tag() && is_single())
				{	
					echo '<span class="blog-tags minor-meta">';
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
												
						$cats = get_the_category();
						if(!empty($cats))
						{
							echo '<span class="blog-categories minor-meta">'.__('posted in ','avia_framework');
							the_category(', ');
							echo ' </span><span class="text-sep">/</span>';
						}
						
						
						
						echo '<span class="blog-author minor-meta">'.__('by ','avia_framework');
						the_author_posts_link(); 
						echo '</span>';
						/*
						echo '<span class="blog-permalink minor-meta">';
						echo "<a href='".get_permalink()."'>".__('#permalink','avia_framework')."</a>";
						echo '</span>';
						*/
						
						
						
						
						
						?>
					
					</div>	
					
				</div>

								
			</div>	
			

		</div><!--end post-entry-->