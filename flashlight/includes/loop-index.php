<?php 
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }
$loopcounter = 1;

// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	
?>

		<div class='post-entry <?php echo "post-entry-".$loopcounter; $loopcounter++; ?>'>

				<?php
				$image = "";
 	 			$titleClass = "";
 	 			if(is_single()) $titleClass = $avia_config['layout'];

 	 			
				?>
			
				<h1 class='post-title <?php echo $titleClass; ?>'>
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?></a>
				</h1>
				
				<?php
					
				
				if(!post_password_required())
				{
					//embeded thumb gallery
					if(is_single() && strpos($avia_config['layout'],'thumb') !== false )
					{
							echo "<div class='hr_invisible '></div>";
							new avia_embed_images();
					}
					else if(! is_single())
					{
						$class = "preview_image ";
						$size  = "portfolio";
						$layout = avia_get_option('blog_image_layout');
						
						if($layout == "full")
						{
							$class = "preview_image_full";
							$size  = "blog";
						}
						
						
						$image = get_the_post_thumbnail( get_the_ID(), $size );
			 	 		if($image)
			 	 		{
			 	 			$image = "<a class='external-link $class' href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."'>".$image."</a>";
			 	 			echo $image;
			 	 		}
					}
				}
				?>
				
				
				<!--meta info-->
		        <div class="blog-meta">
		        
						<span class="date">
			   				<span class='day'><?php the_time('d') ?></span>
			   				<span class='month'><?php the_time('M') ?></span>
			   				<span class='year'><?php the_time('Y') ?></span>
						</span><!-- end date -->
						<span class='text-sep'>/</span>
						<?php if ( comments_open() )
						{ 
							  echo "<span class='comment-container minor-meta'>";
							  comments_popup_link("0 ".__('Comments','avia_framework'), 
												  "1 ".__('Comment' ,'avia_framework'),
												  "% ".__('Comments','avia_framework'),'comments-link',
												  "".__('Comments Off','avia_framework')); 
												  ?>
						</span>	
						<span class='text-sep'>/</span>
						<?php
						}
						$cats = get_the_category();
						
						if(!empty($cats))
						{
							echo '<span class="blog-categories minor-meta">'.__('in ','avia_framework');
							the_category(', ');
							echo '</span>';
						}
						
						$portfolio_cats = get_the_term_list(  get_the_ID(), 'portfolio_entries', '', ', ','');
						
						if($portfolio_cats && !is_object($portfolio_cats))
						{
							echo '<span class="blog-categories minor-meta">'.__('in ','avia_framework');
							echo $portfolio_cats;
							echo '</span>';
						}
						
							#remove comments bellow to show author as well
						
							/*
							echo '<span class="blog-author minor-meta">'.__('by ','avia_framework');
							the_author_posts_link(); 
							echo '</span>';
							*/
						
						
						?>
							
				</div><!--end meta info-->	
				
				<div class="entry-content">
				<?php 
				if(is_search() || avia_is_overview()) 
				{
					the_excerpt();
				}
				else
				{
					the_content(__('Read more  &rarr;','avia_framework'));  
				}
				
				if(!post_password_required())
				{
					//embeded list gallery
					if(is_single() && strpos($avia_config['layout'],'attached_images') !== false )
					{
						new avia_embed_images();
					}
					
					//embeded 3 column gallery
					if(is_single() && strpos($avia_config['layout'],'three_column') !== false )
					{
						new avia_three_column();
					}
					
					//embeded list gallery
					if(is_single() && strpos($avia_config['layout'],'gallery_shortcode') !== false )
					{
						global $gallery_active;

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
					}
				}
				
				
				if(has_tag() && is_single())
					{	
						echo '<span class="blog-tags">';
						echo the_tags('<strong>'.__('Tags: ','avia_framework').'</strong><span>'); 
						echo '</span></span>';
					}	
				?>	
					
							
			</div>	
					
		
		
		</div><!--end post-entry-->
		
		<div class='hr hr_post_seperator'></div>
		
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
		{ echo avia_pagination(); echo "<div class='clearboth'></div>";	}
?>