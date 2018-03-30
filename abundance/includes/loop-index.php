<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	$slider = new avia_slideshow(get_the_ID());
	if(empty($avia_config['layout'])) $avia_config['layout'] = "big_image sidebar_right";
	
?>

		<div class='post-entry'>
		
		<?php 
			if(strpos($avia_config['layout'], 'big_image') !== false) $slideHtml = $slider->display_small('page'); 
			if(strpos($avia_config['layout'], 'dual-sidebar') !== false) $slideHtml = $slider->display_small('blog');
			
 	 		if(isset($slideHtml) && $slideHtml)
 	 		{
 	 			echo $slideHtml;
 	 			$avia_config['slider_first_post_active'] = true;
 	 		}
 	 		
 	 		
 	 		
 	 		if(!is_single()){ ?>
			<h1 class='post-title'>
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?></a>
			</h1>
			<?php }
			
			
	        	if(strpos($avia_config['layout'], 'small_image') !== false)
	        	{
	        		$sliderHTML = $slider->display_small('small');
		        	echo "<div class='mini_slider'>";
		        	if($sliderHTML)
		        	{
		        		echo $sliderHTML;
		        	}
		        	else
		        	{
		        		echo "<a class='permalink' href='".get_permalink()."' rel='bookmark' title='". __('Permanent Link:','avia_framework')." ".get_the_title()."'>".__('Permalink','avia_framework')."</a>";
		        	}
		        	echo "</div>";
	        	}
	        ?>
			
			
			<!--meta info-->
	        <div class="blog-meta">
	        	
				<span class='post-meta-infos'>
					<span class='date-container minor-meta'><?php the_time('d M Y') ?></span>
					<span class='text-sep'>/</span>
					<span class='comment-container minor-meta'>
					<?php comments_popup_link("<strong>0</strong> ".__('Comments','avia_framework'), 
											  "<strong>1</strong> ".__('Comment' ,'avia_framework'),
											  "<strong>%</strong> ".__('Comments','avia_framework'),'comments-link',
											  "<strong></strong>  ".__('Comments Off','avia_framework')); ?>
					</span>	
					<span class='text-sep'>/</span>

					<?php
					$cats = get_the_category();
					
					if(!empty($cats))
					{
						echo '<span class="blog-categories minor-meta">'.__('in ','avia_framework');
						the_category(', ');
						echo '</span><span class="text-sep">/</span>';
					}
					
					$portfolio_cats = get_the_term_list(  get_the_ID(), 'portfolio_entries', '', ', ','');
					
					if($portfolio_cats && !is_object($portfolio_cats))
					{
						echo '<span class="blog-categories minor-meta">'.__('in ','avia_framework');
						echo $portfolio_cats;
						echo '</span><span class="text-sep">/</span>';
					}
					
					
					echo '<span class="blog-author minor-meta">'.__('by ','avia_framework');
					the_author_posts_link(); 
					echo '</span>';
					
					
					?>
				
				</span>	
				
				
				
				
			</div><!--end meta info-->	
			

			<div class="entry-content">	
				
				<?php 
				if(strpos($avia_config['layout'], 'medium_image sidebar') !== false) echo $slider->display_small('blog');
				
				the_content(__('Read more  &rarr;','avia_framework'));  
				
				if(has_tag() && is_single())
					{	
						echo '<span class="blog-tags">';
						echo the_tags('<strong>'.__('Tags: ','avia_framework').'</strong><span>'); 
						echo '</span></span>';
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
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
<?php

	endif;
	
	if(!isset($avia_config['remove_pagination'] ))
		echo avia_pagination();	
?>