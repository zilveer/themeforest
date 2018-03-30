<!-- Super Container - Three Column Row - Content comes from OptionTree -->
<div class="super-container full-width breakout-row" id="breakout-row">

	<!-- 960 Container -->
	<div class="container">		
		
		
		<div class="sixteen columns">
			<br class="clearfix"/>
			<hr />
		</div>
		
		
			<div class="four columns omega aside-container">
				<div class="aside"> 
					<?php if(get_option_tree('homepage_breakout_title')) { ?><h3><?php echo get_option_tree('homepage_breakout_title'); ?></h3><?php } ?>
					<?php if(get_option_tree('homepage_breakout_text')) { ?><p><?php echo get_option_tree('homepage_breakout_text'); ?></p><?php } ?>
				</div>
			</div>

			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$breakout_cat = get_option_tree('homepage_breakout_category');
			$breakout_num = get_option_tree('homepage_breakout_number');
			$args=array(
				'cat'=>$breakout_cat,			// Query for the cat ID's (because you can't use multiple names or slugs... crazy WP!)
				'posts_per_page'=>$breakout_num,
				'paged'=>$paged,			// Basic pagination stuff.
			   );
			query_posts($args); ?>
			
			<?php while (have_posts()) : the_post(); ?>
					
					<!-- THE POST LOOP -->				
					
					<!-- ============================================ -->
				
					<?php if (has_post_thumbnail( $post->ID )) {
							
							// Check for Sencha preferences, set the variable if the user wants it.
							// Unused as of 1.04 for the time being until some bugs get sorted out
							if (get_option_tree('sencha') == 'Yes') { 
								$sencha = 'http://src.sencha.io/';
							} else {
								$sencha = '';
							} 
							
							// Grab the URL for the thumbnail (featured image)
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
							
							
							// Check for a lightbox link, if it exists, use that as the value. 
							// If it doesn't, use the featured image URL from above.
							if(get_custom_field('lightbox_link')) { 							
								$lightbox_link = get_custom_field('lightbox_link'); 							
							} else {							
								$lightbox_link = $image[0];							
							}
							
					}
							
					?>
				
					<div class="four columns module-container 
							<?php //Here's where we add in the individual category slugs for each individual post
								$postcats = get_the_category();
								if ($postcats) {
								  foreach($postcats as $cat) {
									echo $cat->slug . ' '; 
								  }
								}
							?>">
							
						<div class="module" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>						
							<?php if (has_post_thumbnail( $post->ID )) { ?>
								
								<div class="module-img">							
									<a href="<?php if (get_option_tree('open_as_lightbox') == 'Yes') { echo $lightbox_link; } else { the_permalink(); } ?>" <?php if (get_option_tree('open_as_lightbox') == 'Yes') { ?>data-rel="prettyPhoto[Gallery]"<?php } ?>>
										<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
										<span></span>
									</a>							
									<div class="lightboxLink">
										<a class="popLink boxLink" href="<?php echo $lightbox_link; ?>" data-rel="prettyPhoto[Lightbox]" title="Lightbox"></a>
									</div>						    
									<div class="thumbLink">
										<a class="popLink" href="<?php the_permalink(); ?>" title="Full Post"></a>
									</div>						    
								</div>
							
							<?php } ?>
							
							<div class="module-meta">
								<h5 class="<?php if (has_post_thumbnail( $post->ID )) { echo "has_image"; } else{ echo "no_image"; } ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>	
								<?php echo excerpt(25); ?> <!-- Swap with the_excerpt() if you so desire -->
							</div>						
						</div>
					</div>	
					
					<!-- ============================================ -->
							
				<?php endwhile; ?>
				<!-- /POST LOOP -->
		
		
	</div>
	<!-- /End 960 Container -->

</div>
<!-- /End Super Container -->