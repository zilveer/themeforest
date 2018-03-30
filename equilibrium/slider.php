<?php $slider_width = 940; ?>
<?php $slider_height = intval( of_get_option( 'slider_height' , '450' ) ); ?>
<?php $auto_height_enabled = intval( of_get_option( 'auto_height_enabled', '0' ) ); ?>
<?php $args = array( 'post_type' => 'slider', 'orderby' => 'date', 'posts_per_page' => '-1' ); ?>
<?php $loop = new WP_Query( $args ); ?>

<?php if( ! $auto_height_enabled ) { ?>
	<style>
		.slider, .slides-container { height: <?php echo $slider_height . 'px'; ?> } 
	</style>
<?php } ?>

<!-- START .slider -->
<section class="slider">
	
	<?php 
	// get an object containing all the post statuses of the post type 'slider'
	$count = wp_count_posts( 'slider' );
	
	// if the total number of published slides is equal to one, display the single slide, while not showing the next and previous buttons, as well as the slider's pagination; otherwise, display all the mentioned things.
	if ( intval( $count -> publish ) === 1 ) {
	?>
		
		<!-- START .single-slider-img -->
		<div class="single-slider-img">
			
			<?php // query the "my_slider" custom post type and import its posts into the slider	?>
			<?php while ( $loop->have_posts()) : $loop->the_post(); ?>
				
				<?php $slide_img_src = eq_get_the_slide_img_source(); ?>
				<?php $slide_img_href = eq_get_the_slide_img_href(); ?>
				<?php $video_embed_code = eq_get_the_slide_video_code(); ?>
					
			    <figure>
			    	
				    <?php // Display the video, if it's code is present; otherwise, display the image or the custom content from the WordPress' TinyMCE editor ?>
				    <?php if ( !empty( $video_embed_code ) ) { ?>
				    	
				    	<?php echo stripslashes( htmlspecialchars_decode( $video_embed_code ) ); ?>
		
				    <?php } elseif ( $slide_img_src ) { ?>
				    	
						    <?php
						    	// If the slide's image is linked, output the code for the link
						    	if( $slide_img_href ) {
						    			
						    		 echo '<a href="' . $slide_img_href . '">'; 
								
								}  
								?>		    	
				    	
				    			<?php 
				    			$image_details = wp_get_attachment_image_src( eq_get_attachment_id_from_src( $slide_img_src ), 'slider-image' );
				    			$image_full_width = $image_details[1];
								$image_full_height = $image_details[2];
	  							?>
				        	  
				        	  	<?php // If the slider doesn't auto adjusts its height based on the height of the content in the slide, set all the images to the same size; otherwise, set only restrict only the width of the images to 940 pixels ?>
				        	  	<?php if ( ! $auto_height_enabled ) { ?> 
					       		  
					       			<?php // If the original size of the thumbnail doesn't properly match the proportions of the slider, resize it; otherwise, display it in original size ?>
					       		  	<?php if ( $image_full_width > $slider_width || $image_full_height > $slider_height ) { ?>
					       		  	
							        	<img class="slider-img" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $image_details[0]; ?>&amp;h=<?php echo $slider_height; ?>&amp;w=940&amp;q=90" alt="<?php the_title(); ?>" />
					              
					              	<?php } else { ?>
					              	
							        	<img class="slider-img" src="<?php echo $slide_img_src; ?>" alt="<?php the_title(); ?>" />
					              
					              	<?php } ?>
					              
					          	<?php } else { ?>
					          	
							  		<?php // If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size ?>
					       		  	<?php if( $image_full_width > $slider_width ) { ?>
					       		  		
					       		  		<?php 
					       		  		/* find the "desired height" of the current thumbnail, relative to the desired width  */
	  									$desired_height = floor( $image_full_height * ( $slider_width / $image_full_width ) );
					       		  		?>
					       		  	
							        	<img width="<?php echo $slider_width; ?>" height="<?php echo $desired_height; ?>" class="slider-img" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $image_details[0]; ?>&amp;h=<?php echo $desired_height; ?>&amp;w=940&amp;q=90" alt="<?php the_title(); ?>" />
					              
					              	<?php } else { ?>
					              	
							        	<img width="<?php echo $image_full_width; ?>" height="<?php echo $image_full_height; ?>" class="slider-img" src="<?php echo $slide_img_src; ?>" alt="<?php the_title(); ?>" />
					              
					              	<?php } ?>
								  
						  		<?php } ?>
							  
								<?php if( $slide_img_href ) { echo '</a>'; } ?>
							  
					  <?php } else { ?>
						
					      <?php the_content(); ?>
							  
					  <?php } ?>  
				   
			      </figure>
		        
		    <?php endwhile; ?>
		    
		</div>
		<!-- END .single-slider-img -->
		
	<?php } else { ?>
	
		<!-- START #slides -->
	    <div id="slides">
		    	
		    	<!-- START .slides-container -->
		    	<div class="slides-container">
			   	
			   	<?php // query the "my_slider" custom post type and import its posts into the slider	?>
				<?php while ( $loop->have_posts()) : $loop->the_post(); ?>
					
					<?php $slide_img_src = eq_get_the_slide_img_source(); ?>
					<?php $slide_img_href = eq_get_the_slide_img_href(); ?>
					<?php $video_embed_code = eq_get_the_slide_video_code(); ?>
						
				    <!-- START .slide -->
				    <figure class="slide">
				    	
				    <?php // Display the video, if it's code is present; otherwise, display the image or the custom content from the WordPress' TinyMCE editor ?>
				    <?php if ( !empty( $video_embed_code ) ) { ?>
				    	
				    	<?php echo stripslashes( htmlspecialchars_decode( $video_embed_code ) ); ?>
		
				    <?php } elseif ( $slide_img_src ) { ?>
				    	
						    <?php
						    	// If the slide's image is linked, output the code for the link
						    	if( $slide_img_href ) {
						    			
						    		 echo '<a href="' . $slide_img_href . '">'; 
								
								}  
								?>		    	
				    	
				    			<?php 
				    			$image_details = wp_get_attachment_image_src( eq_get_attachment_id_from_src( $slide_img_src ), 'slider-image' );
				    			$image_full_width = $image_details[1];
								$image_full_height = $image_details[2];
	  							?>
				        	  
				        	  	<?php // If the slider doesn't auto adjusts its height based on the height of the content in the slide, set all the images to the same size; otherwise, set only restrict only the width of the images to 940 pixels ?>
				        	  	<?php if ( ! $auto_height_enabled ) { ?> 
					       		  
					       			<?php // If the original size of the thumbnail doesn't properly match the proportions of the slider, resize it; otherwise, display it in original size ?>
					       		  	<?php if ( $image_full_width > $slider_width || $image_full_height > $slider_height ) { ?>
					       		  	
							        	<img class="slider-img" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $image_details[0]; ?>&amp;h=<?php echo $slider_height; ?>&amp;w=940&amp;q=90" alt="<?php the_title(); ?>" />
					              
					              	<?php } else { ?>
					              	
							        	<img class="slider-img" src="<?php echo $slide_img_src; ?>" alt="<?php the_title(); ?>" />
					              
					              	<?php } ?>
					              
					          	<?php } else { ?>
					          	
							  		<?php // If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size ?>
					       		  	<?php if( $image_full_width > $slider_width ) { ?>
					       		  		
					       		  		<?php 
					       		  		/* find the "desired height" of the current thumbnail, relative to the desired width  */
	  									$desired_height = floor( $image_full_height * ( $slider_width / $image_full_width ) );
					       		  		?>
					       		  	
							        	<img width="<?php echo $slider_width; ?>" height="<?php echo $desired_height; ?>" class="slider-img" src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $image_details[0]; ?>&amp;h=<?php echo $desired_height; ?>&amp;w=940&amp;q=90" alt="<?php the_title(); ?>" />
					              
					              	<?php } else { ?>
					              	
							        	<img width="<?php echo $image_full_width; ?>" height="<?php echo $image_full_height; ?>" class="slider-img" src="<?php echo $slide_img_src; ?>" alt="<?php the_title(); ?>" />
					              
					              	<?php } ?>
								  
						  		<?php } ?>
							  
								<?php if( $slide_img_href ) { echo '</a>'; } ?>
							  
					  <?php } else { ?>
						
					      <?php the_content(); ?>
							  
					  <?php } ?>   
				      </figure>
				      <!-- END .slide -->
			        
			    <?php endwhile; ?>
			    
			    </div> 
		       	<!-- END .slides_container -->
		    	
		    <!-- START #next-prev-links -->
		    <div id="next-prev-links">
		       	<a href="#" class="prev"><img src="<?php echo get_template_directory_uri() ?>/images/layout/arrow-left.png" width="41" height="41" alt="Previous" /></a>
		        <a href="#" class="next"><img src="<?php echo get_template_directory_uri() ?>/images/layout/arrow-right.png" width="41" height="41" alt="Next" /></a>
		    </div>
		    <!-- END #next-prev-links -->
		    
		</div>
	    <!-- END #slides -->
	    
	<?php } // end of else ?>
    
</section>
<!-- END .slider -->