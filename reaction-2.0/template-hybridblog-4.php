<?php
/*
 * Template Name: Hybrid Blog (4-columns)
*/

get_header(); 
?>


<!-- ============================================== -->


<!-- Super Container -->
<div class="super-container full-width main-content-area hybrid-blog-4" id="section-content">

	<!-- 960 Container -->
	<div class="container">		
				
		<!-- CONTENT -->
		<div class="sixteen columns content">		
			
			<!-- Page Title -->
			<?php if(get_custom_field('hide_title') == 'on') : else : ?>
			<div class="sixteen columns alpha omega">			
				<h1 class="title"><span><?php the_title(); ?></span></h1>	
			</div>
			<?php endif; ?>
			
			<!-- Page Content (if it exists) -->
			<?php while ( have_posts() ) : the_post(); ?>	
			<div class="sixteen columns alpha omega">
				<?php the_content(); ?>			
			</div>	
			<?php endwhile; ?>	
		
		</div>
			
			<!-- ============================================== -->			
			
	
			<!-- CATEGORY QUERY + START OF THE LOOP -->
			<?php get_template_part( 'element', 'categoryfilterquery' ); ?>
			<?php while (have_posts()) : the_post(); ?>		
									
				<div class="four columns hybrid">
				
				
				<!-- THE POST EXCERPT -->	
				<div class="the_content post type-post hentry excerpt clearfix" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
					
					<hr class="partial-bottom" />					
				 	
				 	<!-- Grab the image path and set our variables -->
					<?php if (has_post_thumbnail( $post->ID )) {
		 								
						// Grab the URL for the thumbnail (featured image)
						$thumb = get_post_thumbnail_id(); 
						$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
						
							if (ot_get_option('default_image_height')) : 
								$imgheight = ot_get_option('default_image_height', $theme_options, false, true, 0 );
								$image = vt_resize( $thumb, '', 700, $imgheight, true );	
							else : 
								$image = vt_resize( $thumb, '', 700, 2000, false );	
							endif;
														
						// Check for a lightbox link, if it exists, use that as the value. 
						// If it doesn't, use the featured image URL from above.
						if(get_custom_field('lightbox_link')) { 							
							$lightbox_link = get_custom_field('lightbox_link'); 							
						} else {							
							$lightbox_link = $image_full[0];							
						}
					
					?>
					
						<div class="">
							<div class="aside"> 
								<a href="<?php if (get_option_tree('open_as_lightbox') == 'on') { echo $lightbox_link; } else { the_permalink(); } ?>" <?php if (get_option_tree('open_as_lightbox') == 'on') { ?>data-rel="prettyPhoto[Gallery]"<?php } ?>>
									<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" />
								</a>
							</div> 
						</div>															
					 
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						
						<div class="">
							<?php echo excerpt(30); ?>
							<a href="<?php the_permalink(); ?>" class="readmore"> <?php _e('Read More', 'skeleton') ?> &raquo;</a>
						</div> 
						
					
					<?php } else { ?>	 
						<div>
							<?php echo excerpt(30); ?>
							<a href="<?php the_permalink(); ?>" class="readmore"> <?php _e('Read More', 'skeleton') ?> &raquo;</a>
						</div> 
					<?php } ?>					
					
					
					
				</div>
				<!-- /THE POST EXCERPT -->
				
				
				</div>
							
			<?php endwhile; ?>
			<!-- /STOP LOOP -->
			
			
			<!-- ============================================== -->		
			
		<div class="sixteen columns content">	
		
		<?php get_template_part( 'element', 'pagination' ); ?>		
		
		</div>	
		<!-- /CONTENT -->
		
		
		<!-- ============================================== -->
			
				

	</div>
	<!-- /End 960 Container -->
	
</div>
<!-- /End Super Container -->


<!-- ============================================== -->


<?php get_footer(); ?>