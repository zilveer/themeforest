<?php
	// Split the featured pages from the options, and put in an array
	$featuredpages = get_option('themeteam_origami_featured_slider_ids');
	$featuredpages_array=split(",",$featuredpages); 
	$featuredpages_array = array_diff($featuredpages_array, array(""));
	
	$slider_type = get_option('themeteam_origami_featured_slider_type'); 
 	
 	switch($slider_type){
		case 'full_image':
?>
		<div>
		<div id="full-width-slider">
			
					<?php foreach ( $featuredpages_array as $featureditem ) { ; ?>
						<?php query_posts('page_id=' . $featureditem); ?>
					    <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; 
					    	$themeteam_custom_link = get_post_meta($post->ID, "themeteam_custom_link", true); 
					    	$themeteam_slider_text = get_post_meta($post->ID, "themeteam_slider_text", true); 
					    	$themeteam_header_text = get_post_meta($post->ID, "themeteam_header_text", true); 
					    	$themeteam_image_upload = get_post_meta($post->ID, "themeteam_image_upload", true); 
					    	$themeteam_video_embed = get_post_meta($post->ID, "themeteam_video_embed", true); 
					    	$themeteam_video_height = get_post_meta($post->ID, "themeteam_video_height", true); 
					    	$themeteam_video_width = get_post_meta($post->ID, "themeteam_video_width", true); 
					    	$video_width = $themeteam_video_width + 2;
					    	$video_height = $themeteam_video_height + 2;
					    ?>
		            	<div style="display:block;width:100%;height:400px;background-image:url('<?php echo $themeteam_image_upload; ?>');">
		            		<div class="container_12">
		                        <div class="slider-texts">
				            		<h2><?php if($themeteam_image_upload || $themeteam_image_upload = '') { ?>
				                        <?php if ( $themeteam_custom_link ) {?>
					      					<a href="<?php echo $themeteam_custom_link; ?>"><?php echo get_the_title(); ?></a>
					      				<?php } else { ?>
					      					<a href="<?php echo get_page_link($post->ID); ?>"><?php echo get_the_title(); ?></a>
					      				<?php }?>
									<?php } ?>
									</h2>
                                  <p><?php echo $themeteam_slider_text; ?></p>
                                </div>
							</div>
		            	</div>
		            	<?php endwhile; endif; ?>
					<?php } ?>
		
		</div>
		<div id="control_wrapper" class="controls">
			<span id="slider_next">
				<a href="javascript:void(0);">Previous</a>
			</span> 
			<span id="slider_prev"><a href="javascript:void(0);">Next</a></span>
		</div>
		</div>

<?php 
		break;
		case 'normal_width':
?>
    <div id="origami-slider" class="clearfix">
		<div class="container_12">
		
		<div id="normal-width-slider">
        	<ul>
            	<?php foreach ( $featuredpages_array as $featureditem ) { ; ?>
					<?php query_posts('page_id=' . $featureditem); ?>
				    <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; 
				    	$themeteam_custom_link = get_post_meta($post->ID, "themeteam_custom_link", true); 
				    	$themeteam_slider_text = get_post_meta($post->ID, "themeteam_slider_text", true); 
				    	$themeteam_header_text = get_post_meta($post->ID, "themeteam_header_text", true); 
				    	$themeteam_image_upload = get_post_meta($post->ID, "themeteam_image_upload", true); 
				    	$themeteam_video_embed = get_post_meta($post->ID, "themeteam_video_embed", true); 
				    	$themeteam_video_height = get_post_meta($post->ID, "themeteam_video_height", true); 
				    	$themeteam_video_width = get_post_meta($post->ID, "themeteam_video_width", true); 
				    	$video_width = $themeteam_video_width + 2;
				    	$video_height = $themeteam_video_height + 2;
				    ?>
		            	<li>
		              		<div class="grid_4 left">
		                		<h1>
		                			<?php if ( $themeteam_custom_link ) {?>
			      						<a href="<?php echo $themeteam_custom_link; ?>"><?php echo get_the_title(); ?></a>
			      					<?php } else { ?>
			      						<a href="<?php echo get_page_link($post->ID); ?>"><?php echo get_the_title(); ?></a>
			      					<?php }?>
		                		</h1>
		                		<p>
		                			<?php echo $themeteam_slider_text; ?> 
		                		</p>
		                		<p>
		                			<?php if ( $themeteam_custom_link ) {?>
			      						<a href="<?php echo $themeteam_custom_link; ?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>View More</span></span></a>
			      					<?php } else { ?>
			      						<a href="<?php echo get_page_link($post->ID); ?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>View More</span></span></a>
			      					<?php }?>
		                		</p>
		              		</div>
                			<?php if($themeteam_image_upload || $themeteam_image_upload = '') { ?>
                			<div class="grid_8">
	                			<div class="shadow">
	                        		<?php if ( $themeteam_custom_link ) {?>
		      							<a href="<?php echo $themeteam_custom_link; ?>"><?php echo themeteam_resize($themeteam_image_upload,'Slider Image','','620','400'); ?></a>
		      						<?php } else { ?>
		      							<a href="<?php echo get_page_link($post->ID); ?>"><?php echo themeteam_resize($themeteam_image_upload,'Slider Image','','620','400'); ?></a>
		      						<?php }?>
		      					</div>
	      					</div>
							<?php } else if ($themeteam_video_embed) { ?>
							<div class="grid_8" style="height:auto; padding-top:30px;">
								<div class="shadow" style="width:<?php echo $themeteam_video_width; ?>px;height:<?php echo $themeteam_video_height; ?>px;">
									<?php echo $themeteam_video_embed; ?>
								</div>
							</div>
							<?php } ?>
		            	</li>
            		<?php endwhile; endif; ?>
				<?php } ?>
            </ul>
		</div>
    </div>		
</div>		
<?php		
		break;
		case 'nivo':
?>
    <div id="origami-slider" class="clearfix">
		<div class="container_12">
      	  <div class="grid_12" id="nivoslider-container">
            <div id="nivoslider">
			<?php foreach ( $featuredpages_array as $featureditem ) { ; ?>
				<?php query_posts('page_id=' . $featureditem); ?>
			    <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; 
			    	$themeteam_custom_link = get_post_meta($post->ID, "themeteam_custom_link", true); 
			    	$themeteam_slider_text = get_post_meta($post->ID, "themeteam_slider_text", true); 
			    	$themeteam_header_text = get_post_meta($post->ID, "themeteam_header_text", true); 
			    	$themeteam_image_upload = get_post_meta($post->ID, "themeteam_image_upload", true); 
			    	$themeteam_video_embed = get_post_meta($post->ID, "themeteam_video_embed", true); 
			    	$themeteam_video_height = get_post_meta($post->ID, "themeteam_video_height", true); 
			    	$themeteam_video_width = get_post_meta($post->ID, "themeteam_video_width", true); 
			    	$video_width = $themeteam_video_width + 2;
			    	$video_height = $themeteam_video_height + 2;
			    ?>
			    <?php if($themeteam_image_upload || $themeteam_image_upload = '') { ?>
	                <?php if ( $themeteam_custom_link ) {?>
	  						<a href="<?php echo $themeteam_custom_link; ?>"><?php echo themeteam_resize($themeteam_image_upload,'Slider Image','','930','400'); ?></a>
	  					<?php } else { ?>
	  						<a href="<?php echo get_page_link($post->ID); ?>"><?php echo themeteam_resize($themeteam_image_upload,'Slider Image','','930','400'); ?></a>
	  					<?php }?>
				<?php } ?>
				<?php endwhile; endif; ?>
			<?php } ?>
		    </div>
          </div>
		</div>
</div>		
<?php
		break;
	}
?>