<?php get_header(); ?>


<!-- ============================================== -->


<!-- CATEGORY QUERY + START OF THE LOOP -->
<?php while (have_posts()) : the_post(); ?>		


<!-- ============================================== -->

  
<!-- Super Container -->
<div class="super-container main-content-area" id="section-content">


	<!-- 960 Container -->
	<div class="container">		
		
		<?php if(get_custom_field('remove_sidebar') == 'on') { $remove_sidebar = 'sixteen'; } ?>
		
		<!-- CONTENT -->
		<div class="eleven columns content <?php echo $remove_sidebar; ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			
			<h1 class="title"><span><?php the_title(); ?></span></h1>
			
			<hr class="half-bottom" />
					
										
			<div class="date"> 
				<?php _e('Posted on', 'skeleton') ?> <?php the_time(__ ('F', 'skeleton'));?> <?php the_time(__ ('jS', 'skeleton'));?>, <?php _e('by', 'skeleton')?> <?php the_author(); ?> <?php _e('in', 'skeleton')?> <?php the_category(', ') ?>. <?php comments_popup_link(__ ('No Comments', 'skeleton'), __ ('1 Comment', 'skeleton'), __ngettext ('% comment', '% comments', get_comments_number (),'skeleton')); ?>			
			</div>	 
				 	
			<hr />
				 	
			<!-- Featured Image -->
			<?php if(get_option_tree('show_featured_image') == 'on') : ?>

				<?php if (has_post_thumbnail( $post->ID )) {
				 		
						// Check for Sencha preferences, set the variable if the user wants it.
						// Unused as of 1.04 for the time being until some bugs get sorted out
				 		if (get_option_tree('sencha') == 'on') { 
							$sencha = 'http://src.sencha.io/';
						} else {
							$sencha = '';
						} 
						
						// Grab the URL for the thumbnail (featured image)
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
						$post_slug = str_replace(" ", "-",$post->post_name);
						
						// Check for a lightbox link, if it exists, use that as the value. 
						// If it doesn't, use the featured image URL from above.
						if(get_custom_field('lightbox_link')) { 							
							$lightbox_link = get_custom_field('lightbox_link'); 							
						} else {							
							$lightbox_link = $image[0];							
						}
						
						?>
					<a href="<?php echo $lightbox_link; ?>" data-rel="prettyPhoto[<?php echo $post_slug; ?>]">
						<img class="aligncenter" src="<?php echo $sencha; ?><?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
					</a>
							
				<br class="clearfix" />					
				<?php } else {} ?>	 
				
			<?php endif; ?>
				
				
				<!-- THE POST LOOP -->				
				
				
				<!-- ============================================ -->
			
			
				<!-- THE POST CONTENT -->	
				<div class="the_content post type-post hentry excerpt clearfix">	
					
					
					
					<?php the_content(); ?>
					<br />
					<?php wp_link_pages('before=<div id="page-links"><span>Pages:</span>&after=</div>&link_before=<div>&link_after=</div>'); ?>
					<hr />
										
					
					<!-- META AREA -->
					<div class="meta-space">					
						<div class="tags clearfix <?php echo get_option_tree('tags_color'); ?>">
							<img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/tag.png" class="tag_icon" />
							<?php the_tags(' ',' '); ?>				
						</div>				
					</div> 
					<!-- /META AREA -->
					
				
				</div>
				<!-- /THE POST CONTENT -->
				
				<br />
				<hr class="remove-top"/>
				
				<!-- COMMENTS SECTION -->
				<?php comments_template(); ?> 
				<div class="hidden"><?php wp_list_comments('type="comment&avatar_size=64'); ?></div>
				<?php next_comments_link(); previous_comments_link(); ?>
				<div class="hidden"><?php comments_template( '', true ); ?></div>
				<!-- COMMENTS-SECTION -->
				
				
							
			<?php endwhile; ?>
			<!-- /POST LOOP -->			
	
		
		</div>	
		<!-- /CONTENT -->
		
		
		
		
		<!-- ============================================== -->
		
		
		<?php if(get_custom_field('remove_sidebar') == 'on') { } else { ?>
		<!-- SIDEBAR -->
		<div class="five columns sidebar">
			
			<?php dynamic_sidebar( 'default-widget-area' ); ?>	
				
		</div>
		<!-- /SIDEBAR -->	
		<?php } ?>
				

	</div>
	<!-- /End 960 Container -->
	
</div>
<!-- /End Super Container -->


<!-- ============================================== -->


<?php get_footer(); ?>