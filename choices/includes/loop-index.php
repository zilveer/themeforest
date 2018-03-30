<?php 
global $avia_config, $post_loop_count;

do_action( 'avia_action_query_check' , 'loop-index' );

if(empty($post_loop_count)) $post_loop_count = 1;

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	
	
	/*
     * get the current post id, the current post class and current post format
 	 */
 	 
	$the_id 		= get_the_ID();
	$parity			= $post_loop_count % 2 ? 'odd' : 'even';
	$post_class 	= "post-entry-".$the_id." post-loop-".$post_loop_count." post-parity-".$parity;
	$post_format 	= get_post_format() ? get_post_format() : 'standard';
	$subtitle		= avia_post_meta($the_id, 'subtitle');
	$sliderHtml		= false;
	
	/*
     * retrieve slider, title and content for this post,...
     */
    
	$current_post['slider']  	= new avia_slideshow($the_id);
	$current_post['title']   	= get_the_title();
	$current_post['content'] 	= get_the_content(__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>');
	$current_post['subtitle']	= $subtitle ? "<div class='subtitle_intro'>".apply_filters('the_content',$subtitle)."</div>" : "";
	
	/*
     * ...now apply a filter, based on the post type... (filter function is located in includes/helper-post-format.php)
     */
	$current_post	= apply_filters( 'post-format-'.$post_format, $current_post );
	
	/*
     * ... last apply the default wordpress filters to the content
     */
	$current_post['content'] = str_replace(']]>', ']]&gt;', apply_filters('the_content', $current_post['content'] ));
	
	/*
	 * Now extract the variables so that $current_post['slider'] becomes $slider, $current_post['title'] becomes $title, etc
	 */ 
	extract($current_post);
	
	/*
	 * save slider html output
	 */ 
	if($slider && $slider->slidecount) 
	{
		$sliderHtml = $slider->display(); 
		$post_class .= " with-slideshow";
	}
	/*
	 * render the html:
	 */
	?>
	
		<div class='post-entry post-entry-type-<?php echo $post_format." ".$post_class; ?>'>
					
			<?php 
			
			//echo slideshow
			echo $sliderHtml;
						
			?>
			<span class='date-container date-container-mobile minor-meta meta-color'><?php echo get_the_date(); ?></span>
			<!--meta info-->
	        <div class="<?php avia_layout_class('meta'); ?> units blog-meta">
	        	
	        	<div class='side-container side-container-date'>
	        		
	        		<div class='side-container-inner'>
	        			<div class="date">
			   				<span class='day'><?php the_time('d') ?></span>
			   				<span class='date_group'>
			   					<span class='month'><?php the_time('M') ?></span>
			   					<span class='year'><?php the_time('Y') ?></span>
			   				</span>
						</div><!-- end date -->
	        		
   						<!--
						<span class='date-container minor-meta meta-color'><?php echo get_the_date() ?></span>
   						<div class='post-format-icon'></div>
						-->
	        		</div>
	        		
	        	</div>
				
			</div><!--end meta info-->	
			

			<div class="<?php avia_layout_class('entry'); ?> units entry-content <?php echo $post_format; ?>-content">	
			 	
				<?php 
				
				//echo the post title
				echo $title;
				
				// subtitle
				echo $subtitle;
				
				// echo the post content
				echo $content;
				
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
							// __('posted in','avia_framework')
							echo '<span class="blog-categories minor-meta">'.__('in','avia_framework')." ";
							the_category(', ');
							echo ' </span>';
							 echo '<span class="text-sep cat-sep">/</span>';
						}
						
						
						echo '<span class="blog-author minor-meta">'.__('by ','avia_framework');
						the_author_posts_link(); 
						echo '</span><span class="text-sep author-sep">/</span>';
						
						echo '<span class="blog-permalink minor-meta">';
						echo "<a href='".get_permalink()."'>".__('#permalink','avia_framework')."</a>";
						echo '</span>';
						
						
						?>
					
					</div>	
					
				</div>

								
			</div>	
			

		</div><!--end post-entry-->
	<?php 
	
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
	
	if(!isset($avia_config['remove_pagination'] )) 
	{ 
		echo "<div class='".avia_layout_class('entry', false)." ".avia_offset_class('meta', false)." units'>";
		echo avia_pagination(); 
		echo "</div>";
	}
?>