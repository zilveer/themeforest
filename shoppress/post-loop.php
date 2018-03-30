<?php global $post, $gp_settings; ?>


<!-- BEGIN CONTENT -->

<div id="content">


	<!-- BEGIN BREADCRUMBS -->

	<?php if($gp_settings['breadcrumbs'] == "Show") { ?><div id="breadcrumb"><?php echo gp_breadcrumbs(); ?></div><?php } ?>
	
	<!-- END BREADCRUMBS -->
		
		
	<!-- BEGIN TITLE -->
	
	<?php if($gp_settings['title'] == "Show") { ?>
		<h1 class="page-title">
		<?php if(is_search()) { ?>
			<?php echo $wp_query->found_posts; ?> <?php _e('search results for', 'gp_lang'); ?> "<?php echo esc_html($s); ?>"
		<?php } elseif(is_category()) { ?>
			<?php single_cat_title(); ?>
		<?php } elseif(is_tag()) { ?>
			<?php single_tag_title(); ?>
		<?php } else { ?>
			<?php if ( ! function_exists( '_wp_render_title_tag' ) && ! function_exists( 'socialize_render_title' ) ) { 
				_e( 'Archives', 'gp_lang' );
			} else {
				the_archive_title();
			} ?>	
		<?php } ?>
		</h1>
	<?php } ?>
	
	<!-- END TITLE -->
	
	
	<!-- BEGIN POST WRAPPER -->
	
	<div class="post-wrapper">
		
		<?php if (have_posts()) : while (have_posts()) : the_post();
		
		
		// Image Dimensions
		
		if(get_post_meta(get_the_ID(), $dirname.'_thumbnail_width', true) && get_post_meta(get_the_ID(), $dirname.'_thumbnail_width', true) != "") {
			$thumbnail_width = get_post_meta(get_the_ID(), $dirname.'_thumbnail_width', true);
		} else {
			$thumbnail_width = $gp_settings['thumbnail_width'];
		}
		if(get_post_meta(get_the_ID(), $dirname.'_thumbnail_height', true) != "") {
			$thumbnail_height = get_post_meta(get_the_ID(), $dirname.'_thumbnail_height', true);
		} else {
			$thumbnail_height = $gp_settings['thumbnail_height'];
		}	
		
		?>
		
		
			<!-- BEGIN POST -->
			
			<div <?php post_class('post-loop '.$gp_settings['preload']); ?>>
			

				<!-- BEGIN FEATURED IMAGE -->	
									
				<?php if(has_post_thumbnail()) { ?>

					<div class="post-thumbnail<?php if($gp_settings['image_wrap'] == "Enable") { ?> wrap<?php } ?>">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php $image = aq_resize(wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())), $thumbnail_width, $thumbnail_height, $gp_settings['hard_crop'], false, true); ?>
							<?php if(get_option($dirname.'_retina') == "0") { $retina = aq_resize(wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())), $thumbnail_width*2, $thumbnail_height*2, $gp_settings['hard_crop'], true, true); } else { $retina = ""; } ?>
							<img src="<?php echo $image[0]; ?>" data-rel="<?php echo $retina; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { the_title_attribute(); } ?>" class="wp-post-image" />			
						</a>
					</div>
					
					<?php if($gp_settings['image_wrap'] == "Disable") { ?><div class="clear"></div><?php } ?>
					
				<?php } ?>
				
				<!-- END FEATURED IMAGE -->
				
				
				<!-- BEGIN POST TEXT -->
				
				<div class="post-text">
				
					
					<!-- BEGIN TITLE -->
					
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					
					<!-- END TITLE -->
					
					
					<!-- BEGIN POST META -->
					
					<?php if($gp_settings['meta_date'] == "0" OR $gp_settings['meta_author'] == "0" OR $gp_settings['meta_cats'] == "0" OR $gp_settings['meta_comments'] == "0") { ?>
					
						<div class="post-meta">
						
							<?php if($gp_settings['meta_author'] == "0") { ?><span class="author-icon"><?php the_author_posts_link(); ?></span><?php } ?>
							
							<?php if($gp_settings['meta_date'] == "0") { ?><span class="clock-icon"><?php the_time(get_option('date_format')); ?></span><?php } ?>
							
							<?php if($gp_settings['meta_cats'] == "0" && $post->post_type == "post") { ?><span class="folder-icon"><?php the_category(', '); ?></span><?php } ?>
							
							<?php if($gp_settings['meta_comments'] == "0" && comments_open()) { ?><span class="speech-icon"><?php comments_popup_link(__('0', 'gp_lang'), __('1', 'gp_lang'), __('%', 'gp_lang'), 'comments-link', ''); ?></span><?php } ?>
							
						</div>
						
					<?php } ?>
					
					<!-- END POST META -->
					
					
					<!-- BEGIN POST CONTENT -->
					
					<?php if($gp_settings['content_display'] == "1") { ?>	
					
						<?php the_content('&raquo;'); ?>
						
					<?php } else { ?>
					
						<?php if($gp_settings['excerpt_length'] != "0") { ?><p><?php echo gp_excerpt($gp_settings['excerpt_length']); ?><?php if($gp_settings['read_more'] == "0") { ?> <a href="<?php the_permalink(); ?>" class="read-more" title="<?php the_title_attribute(); ?>"> &raquo;</a><?php } ?></p><?php } ?>
						
					<?php } ?>
					
					<!-- END POST CONTENT -->
					
					
					<!-- BEGIN POST TAGS -->
					
					<?php if($gp_settings['meta_tags'] == "0") { ?>
						<?php the_tags('<div class="post-meta post-tags"><span class="tag-icon">', ', ', '</span></div>'); ?>
					<?php } ?>
					
					<!-- END POST TAGS -->
					
					
				</div>
				
				<!-- END POST TEXT -->
	
	
			</div>
			
			<!-- END POST -->
	
			
		<?php endwhile; ?>
		
			
			<?php gp_pagination(); ?>
	
	
		<?php else : ?>	
	
	
			<h4><?php _e('Try searching again using the search form below.', 'gp_lang'); ?></h4>
		
			<div class="sc-divider"></div>
			
			<h3><?php _e('Search The Site', 'gp_lang'); ?></h3>
			<?php get_search_form(); ?>	
		
		
		<?php endif; ?>	

	</div>
	
	<!-- END POST WRAPPER -->
	
	
</div>

<!-- END CONTENT -->

	
<?php get_sidebar(); ?>