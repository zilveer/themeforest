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
	$current_post['slider']		->setImageSize('featured_small');
	
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
	
		<div <?php post_class('post-entry post-entry-type-'.$post_format . " " . $post_class); ?>'>
					
			<?php 
			
			//echo slideshow
			echo $sliderHtml;
			
			//echo the post title
			echo $title;
						
			?>
			<!--meta info-->
	        <div class="<?php avia_layout_class('meta'); ?> units blog-meta">
	        	
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
			

			<div class="<?php avia_layout_class('entry'); ?> units entry-content <?php echo $post_format; ?>-content">	
			 	
				<?php 
				
				
				
				// subtitle
				echo $subtitle;
				
				// echo the post content
				echo $content;
				
				wp_link_pages(array('before' =>'<div class="pagination_split_post">',
				    					'after'  =>'</div>',
				    					'pagelink' => '<span>%</span>'
				    					)); 
				
				if(has_tag() && is_single())
				{	
					echo '<span class="blog-tags minor-meta">';
					echo the_tags('<strong>'.__('Tags: ','avia_framework').'</strong><span>'); 
					echo '</span></span>';
				}
				?>
								
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
		// paginate_links(); posts_nav_link(); next_posts_link(); previous_posts_link();
	}
?>