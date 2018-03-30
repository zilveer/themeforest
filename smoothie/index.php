<?php get_header(); ?>


		
		<div id="content">
			<!-- conditional subtitles -->
            <?php 
			$archive = '';
			    if( is_category() ){ $archive = 'cat='. get_query_var('cat'); } 
				elseif( is_tag() ){ $archive = 'tag_id='. get_query_var('tag_id'); }
				elseif( is_day() ){ $archive = 'year='. get_the_time('Y') .'&monthnum='. get_the_time('n') .'&day='. get_the_time('j'); }
				elseif( is_month() ){ $archive = 'year='. get_the_time('Y') .'&monthnum='. get_the_time('n'); }
				elseif( is_year() ){ $archive = 'year='. get_the_time('Y'); }
				elseif( is_author() ){ $archive = 'author='. get_query_var('author'); }
				elseif( is_search() ){ $archive = 's='. get_search_query(); }
			?>
			<?php if(is_search()) { ?>
				<div class="sub-title"><?php /* Search Count */ global $wp_query; $total_results = $wp_query->found_posts; echo $total_results . ' '; wp_reset_query(); ?><?php _e('Search Results for','cr'); ?> "<?php the_search_query() ?>" </div>
			<?php } else if(is_tag()) { ?>
				<div class="sub-title"><?php _e('Tag:','cr'); ?> <?php single_tag_title(); ?></div>
			<?php } else if(is_day()) { ?>
				<div class="sub-title"><?php _e('Archive:','cr'); ?> <?php echo get_the_date(); ?></div>
			<?php } else if(is_month()) { ?>
				<div class="sub-title"><?php _e('Archive:','cr'); ?> <?php echo get_the_date('F Y'); ?></div>
			<?php } else if(is_year()) { ?>
				<div class="sub-title"><?php _e('Archive:','cr'); ?> <?php echo get_the_date('Y'); ?></div>
			<?php } else if(is_404()) { ?>
				<div class="sub-title"><?php _e('404 - Page Not Found!','cr'); ?></div>
			<?php } else if(is_category()) { ?>
				<div class="sub-title"><?php _e('Category:','cr'); ?> <?php single_cat_title(); ?></div>
			<?php } else if(is_author()) { ?>
				<div class="sub-title"><?php _e('Posts by Author:','cr'); ?> <?php the_author_posts(); ?> <?php _e('posts by','cr'); ?> <?php
				$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); echo $curauth->nickname; ?></div>		
			<?php } ?>
			<?php if ((of_get_option('of_masonryswitch')=="1" && !is_single() && !is_home() ) || (of_get_option('of_masonryswitchhome')=="1" && is_home())) { ?>

				<div class="post-wrap masonrycontainer">
					<!-- grab the posts -->
					<?php 
						global $more; $more = 0;
					?>
					
					<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
						
					<div class="masonr">	
					
						<div <?php post_class('post'); ?>>
							<!-- uses the post format -->
							<?php
                                if(!get_post_format()) {                       
                                    get_template_part('format', 'standard-small');
                                } else {                
                                    $format = get_post_format();
                                    if ($format == 'image') {get_template_part('format', 'image-small');} 
                                    else if ($format == 'gallery') {get_template_part('format', 'gallery-small');}
                                    else {get_template_part('format', $format);}
                                }
							?>
						</div><!-- post-->
					</div>
					
					<?php endwhile; ?>
				</div> <!-- end content if no posts -->
					<!-- load more -->
				<?php if($wp_query->max_num_pages>1) { ?> 
					<a href="#" id="load-more" rel="<?php echo $archive; ?>" ><?php _e('Load More','cr'); ?></a>
				<?php } $temp = $wp_query; $wp_query = null; wp_reset_query(); ?>
					<!-- end load more -->
					<?php else: ?>
                    </div>
					<?php endif; ?>
					
            <?php } else { ?>
			
			<div class="post-wrap">
				<!-- grab the posts -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
					<div <?php post_class('post'); ?>>
						<!-- uses the post format -->
						<?php
							if(!get_post_format()) {
							   get_template_part('format', 'standard');
							} else {
							   get_template_part('format', get_post_format());
							};
						?>
					</div><!-- post-->
					
				
				<?php if(is_single()) { ?>
					<!-- next and previous posts -->	
					<div class="next-prev">
                    	<?php
							 $p = get_adjacent_post(false, '', true);
							 if(!empty($p)) echo '<div class="prev-post"><a href="' . get_permalink($p->ID) . '" title="' . $p->post_title . '">' . __(' Previous Post', 'cr') . '</a></div>';
						 
							 $n = get_adjacent_post(false, '', false);
							 if(!empty($n)) echo '<div class="next-post"><a href="' . get_permalink($n->ID) . '" title="' . $n->post_title . '">' . __('Next Post ', 'cr') . '</a></div>';
						?>
					</div>	
				<?php } ?>			
				
				<?php endwhile; ?>
			</div><!-- post wrap -->
							
			<?php if(!is_single()) { ?>	
				<!-- post navigation -->
				<div class="post-nav">
					<div class="postnav-left"><?php previous_posts_link(__('Newer Posts', 'cr')) ?></div>
					<div class="postnav-right"><?php next_posts_link(__('Older Posts', 'cr')) ?></div>	
					<div style="clear:both;"> </div>
				</div><!-- end post navigation -->
			<?php } ?>
			<?php else: ?>
				</div> <!-- end content if no posts -->
			<?php endif; ?><!-- end posts -->
			<?php } ?>
			
			<?php if(is_single ()) { ?>
				<!-- comments -->
				<?php if ('open' == $post->comment_status) { ?>
				<div id="comment-jump" class="comments">
					<?php comments_template(); ?>
				</div>
				<?php } ?>
			<?php } ?>

		</div><!--content-->
		
		<!-- grab the sidebar -->
		<?php if ((of_get_option('of_masonryswitch')=="1" && !is_single() && !is_home() ) || (of_get_option('of_masonryswitchhome')=="1" && is_home())) {} else{
			get_sidebar(); 
		} ?>
	
		<!-- grab footer -->
		<?php get_footer(); ?>