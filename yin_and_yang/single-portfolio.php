<?php get_header(); ?>
		
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
		<?php 
			$desired_width = 813;
			$desired_height = 613;
			$current_post_id = $post->ID;
			$terms = get_the_terms($current_post_id, 'portfolio_category', 'string');
			$num_of_terms = count($terms);
			$content_post = get_post($current_post_id);
			$content = $content_post->post_content;
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]>', $content);
			$post = get_post($current_post_id); 
			
			// Prev and Next Post IDs
			$adjacent_ids = onioneye_get_next_and_prev_ids($current_post_id); 
			$prev_id = $adjacent_ids[0]; 
			$next_id = $adjacent_ids[1]; 
			
			// Metabox Values
			$image_list = get_post_meta($current_post_id, 'onioneye_image_list', true);
			$client = get_post_meta($current_post_id, 'onioneye_client', true); 
			$project_url = get_post_meta($current_post_id, 'onioneye_item_url', true);
			$is_pub_date_displayed = get_post_meta($current_post_id, 'onioneye_publication_date', true); 
			$video_embed_code = get_post_meta($current_post_id, 'onioneye_embed_code', true); 
			
		    $no_of_columns = 0; 
		    
		    if($is_pub_date_displayed) {
				$no_of_columns++;  
		    }
			if($terms) {
				$no_of_columns++; 	
			}
			if($client) {
				$no_of_columns++;
			}
			if($project_url) {
				$no_of_columns++;
			}			
		?>
		
		<div class="portfolio-item-wrapper group">
			<div class="single-portfolio-item group">
			
				<div class="mobile-nav-container">
					<h1 class="item-title"><?php echo get_the_title($current_post_id); ?></h1>
					
					<div class="mobile-post-nav group">
					
						<?php if($prev_id && $next_id) { ?>			
						
							<a class="next-portfolio-post mobile-nav-btn" rel="next" href="#" data-post_id="<?php echo esc_attr($next_id); ?>">
								<span><?php esc_html_e( 'Next post', 'onioneye' ); ?></span>
							</a>
							<a class="prev-portfolio-post mobile-nav-btn" rel="prev" href="#" data-post_id="<?php echo esc_attr($prev_id); ?>">
								<span><?php esc_html_e( 'Prev post', 'onioneye' ); ?></span>
							</a>
							
						<?php } else if ($prev_id) { ?>
							
							<div class="next-nav-placeholder mobile-nav-btn">
								<span><?php esc_html_e( 'Next post', 'onioneye' ); ?></span>
							</div>
							<a class="prev-portfolio-post mobile-nav-btn" href="#" data-post_id="<?php echo esc_attr($prev_id); ?>">
								<span><?php esc_html_e( 'Prev post', 'onioneye' ); ?></span>
							</a>
				
						<?php } else if ($next_id) { ?>
				
							<a class="next-portfolio-post mobile-nav-btn" href="#" data-post_id="<?php echo esc_attr($next_id); ?>">
								<span><?php esc_html_e( 'Next post', 'onioneye' ); ?></span>
							</a>
							<div class="prev-nav-placeholder mobile-nav-btn">
								<span><?php esc_html_e( 'Prev post', 'onioneye' ); ?></span>
							</div>
					
						<?php } ?>
						
					</div><!-- /.mobile-post-nav -->
				</div><!-- /.mobile-nav-container -->
				
				<section class="item-content">
							
					<?php if(!empty($image_list)) { ?>
					
						<div class="metabox-media-files">
							
							<?php 						
								if(!empty($image_list) && count($image_list) === 1) {
									
									$portfolio_img_url = reset($image_list);
									$portfolio_img_id = key($image_list);
								
									$img_meta = wp_get_attachment_image_src($portfolio_img_id, 'full-size');
									$image_full_width = $img_meta[1];
									$image_full_height = $img_meta[2];
									$alt_attr = get_post_meta($portfolio_img_id, '_wp_attachment_image_alt', true);
									$img_caption = get_post($portfolio_img_id)->post_excerpt; 
									
									/* find the "desired height" of the current thumbnail, relative to the desired width */
									if($image_full_width && $image_full_height) { 
										$desired_height = floor($image_full_height * ($desired_width / $image_full_width));
									}
									
									$thumb = onioneye_get_attachment_id_from_src($portfolio_img_url);
									$image = onioneye_vt_resize($thumb, '', $desired_width, $desired_height, true);
											    
									if( $image_full_width > $desired_width || $image_full_height > $desired_height ) { 
							?>
										<div style="max-width: <?php echo esc_attr($desired_width) . 'px'; ?>">
											<div class="single-img-height" style="height: 0; padding-bottom: <?php echo onioneye_get_loader_height($desired_width, $desired_height); ?>">
											
												<div class="single-img-container">
													
													<img class="single-img single-img-ajax" src="<?php echo esc_url($image[url]); ?>" width="<?php echo esc_attr($desired_width); ?>" 
														height="<?php echo esc_attr($desired_height); ?>" alt="<?php echo esc_attr($alt_attr); ?>" />
														
													<?php if($img_caption) { ?>
											  			<p class="oy-flex-caption"><?php echo $img_caption; ?></p>
											  		<?php } ?>
												</div>
												
												<div class="single-img-loader"></div>
											
											</div>
										</div>
												              
							<?php 
									} else { 
							?>		    
										<div style="max-width: <?php echo esc_attr($image_full_width) . 'px'; ?>">
											<div class="single-img-height" style="height: 0; padding-bottom: <?php echo onioneye_get_loader_height($image_full_width, $image_full_height); ?>">
											
												<div class="single-img-container">
													
													<img class="single-img single-img-ajax" src="<?php echo esc_url($portfolio_img_url); ?>" width="<?php echo esc_attr($image_full_width); ?>" 
														height="<?php echo esc_attr($image_full_height); ?>" alt="<?php echo esc_attr($alt_attr); ?>" />
														
													<?php if($img_caption) { ?>
											  			<p class="oy-flex-caption"><?php echo $img_caption; ?></p>
											  		<?php } ?>
												</div>
												
												<div class="single-img-loader"></div>
											
											</div>
										</div>
							<?php 
									} 
								}
								else if(!empty($image_list) && count($image_list) >= 1) {	
							?>
									
									<div class="oy-flex-container">
									
										<div class="oy-flexslider">
											
											<ul class="oy-slides">
											   				
												<?php foreach ($image_list as $portfolio_img_id => $portfolio_img_url) { 
																							  
													$img_meta = wp_get_attachment_image_src($portfolio_img_id, 'full-size');
													$image_full_width = $img_meta[1];
													$image_full_height = $img_meta[2];
													$alt_attr = get_post_meta($portfolio_img_id, '_wp_attachment_image_alt', true);
													$img_caption = get_post($portfolio_img_id)->post_excerpt; 
													
													/* find the "desired height" of the current thumbnail, relative to the desired width */
													if($image_full_width && $image_full_height) { 
														$desired_height = floor($image_full_height * ($desired_width / $image_full_width));
													}
													
													$thumb = onioneye_get_attachment_id_from_src($portfolio_img_url);
													$image = onioneye_vt_resize( $thumb, '', $desired_width, $desired_height, true );
											    
												    // If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size
													if( $image_full_width > $desired_width || $image_full_height > $desired_height ) { 
												
												?>
														<li>
															<img class="oy-slider-img" src="<?php echo esc_url($image[url]); ?>" width="<?php echo esc_attr($desired_width); ?>" 
																height="<?php echo esc_attr($desired_height); ?>" alt="<?php echo esc_attr($alt_attr); ?>" />
															
															<?php if($img_caption) { ?>
													  			<p class="oy-flex-caption"><?php echo $img_caption; ?></p>
													  		<?php } ?>					
														</li>
														              
												<?php 
													} else { 
												?>
													
														<li>
															<img class="oy-slider-img" src="<?php echo esc_url($portfolio_img_url); ?>" width="<?php echo esc_attr($image_full_width); ?>" 
																height="<?php echo esc_attr($image_full_height); ?>"  alt="<?php echo esc_attr($alt_attr); ?>" />
															
															<?php if($img_caption) { ?>
													  			<p class="oy-flex-caption"><?php echo $img_caption; ?></p>
													  		<?php } ?>		
														</li>
							   
												<?php 
													} // end else
												} // end foreach
												?>												   							        							    
											    
											</ul><!-- /.oy-slides -->
											
											<div class="oy-flex-img-loader"></div>
										    
										</div><!-- /.oy-flexslider -->
									
									</div><!-- /.oy-flex-container -->
						
							<?php } // end else if ?>
							
						</div><!-- END .metabox-media-files -->
					<?php } ?>
						
					<?php if($video_embed_code) { ?>
						
						<div class="video-embed">
							<?php echo stripslashes(htmlspecialchars_decode($video_embed_code)); ?>			
						</div>
								
					<?php }	?>
						
					<?php if($content) { ?>
					
						<div class="item-description">  			
							<?php echo $content; ?>
						</div>
					
					<?php } ?>
					
				</section><!-- /.item-content -->
				
				<aside class="item-sidebar group">
					
					<ul class="post-nav group">
						
						<li><span class="close-post">&nbsp;</span></li>
					
					<?php if($prev_id && $next_id) { ?>			
					
						<li><a class="next-portfolio-post" rel="next" href="#" data-post_id="<?php echo esc_attr($next_id); ?>">&nbsp;</a></li>
						<li><a class="prev-portfolio-post" rel="prev" href="#" data-post_id="<?php echo esc_attr($prev_id); ?>">&nbsp;</a></li>
						
					<?php } else if ($prev_id) { ?>
					
						<li><a class="prev-portfolio-post" href="#" data-post_id="<?php echo esc_attr($prev_id); ?>">&nbsp;</a></li>
			
					<?php } else if ($next_id) { ?>
			
						<li><a class="next-portfolio-post" href="#" data-post_id="<?php echo esc_attr($next_id); ?>">&nbsp;</a></li>
				
					<?php } ?>
						
					</ul><!-- /.post-nav -->
					
					<h1 class="item-title"><?php echo get_the_title($current_post_id); ?></h1>
					
					<div class="project-meta group <?php echo esc_attr('oy-' . $no_of_columns . '-cols'); ?>">	
						<?php if($terms) { ?>					
							
							<ul class="item-categories item-metadata group">
						    	<li><?php esc_html_e( 'Categories', 'onioneye' ); ?><span> &rarr;</span></li>
								
								<?php 
									$i = 0;
			
									foreach($terms as $term) {
				
										if($i + 1 == $num_of_terms) {
				    						echo '<li class="item-term">' . esc_html($term -> name) . '</li>';
				 						}
										else {
											echo '<li class="item-term">' . esc_html($term -> name) . '<span class="cat-comma">, </span></li>';
										}
											
										$i++;
									}
								?>
							</ul>
								
						<?php } ?>
						
						<?php if($is_pub_date_displayed) { ?>
							
							<ul class="item-date item-metadata">
							    <li><?php esc_html_e('Date', 'onioneye'); ?><span> &rarr;</span></li>
							    <li><?php echo mysql2date( __( 'F Y', 'onioneye' ), $post->post_date ); ?></li>
							</ul>
						
						<?php } ?>
						
						<?php if( $client ) { ?>
							
							<ul class="item-client item-metadata">
							    <li><?php esc_html_e('Client', 'onioneye'); ?><span> &rarr;</span></li>
							    <li><?php echo esc_html($client); ?></li>
							</ul>
							
						<?php } ?>
						
						<?php if( $project_url ) { ?>
							
							<ul class="item-url item-metadata">
							    <li><?php esc_html_e( 'Project URL', 'onioneye' ); ?><span> &rarr;</span></li>
							    <li><a href="<?php echo esc_url($project_url); ?>"><?php esc_html_e( 'Visit site', 'onioneye' ); ?></a></li>
							</ul>
							
						<?php } ?>
					</div><!-- /.project-meta -->
								
				</aside><!-- /.item-sidebar -->	
				
				<div class="portfolio-border">&nbsp;</div>
				
			</div><!-- /.single-portfolio-item -->
		</div><!-- /.portfolio-item-wrapper -->
		
		<?php get_template_part('includes/portfolio'); ?>
        
    <?php endwhile; ?>
        				
<?php get_footer(); ?>