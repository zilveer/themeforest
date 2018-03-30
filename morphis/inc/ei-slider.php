<?php	
global $NHP_Options; 
$options_morphis = $NHP_Options; 

$main_accent_hover_color = substr($options_morphis['main_accent_hover_color'], 1);
?>
<!-- Ei SLIDER -->
<div id="main-slider" class="container-full-width">

<?php $toggle_slider_boxed = ''; ?>
<?php if(isset($options_morphis['toggle_slider_boxed'])): ?>
	<?php $toggle_slider_boxed = $options_morphis['toggle_slider_boxed']; ?>
<?php endif; ?>
  <?php if($toggle_slider_boxed == '1' && $options_morphis['boxed_full_layout_select'] == 'boxed'): ?>
	<div class="container">
<?php else : ?>
	<div class="bottom-spacer">
  <?php endif; ?>
	<div class="divider upper"></div>
	
	   <div id="ei-slider" class="ei-slider">
	   
			<ul class="ei-slider-large">			
								
			<?php $query = new WP_Query( array( 
									'post_type' => 'slide',
									'orderby' => 'menu_order',
									'posts_per_page' => -1,
									'order' => 'ASC'
								) );
				
				if( $query->have_posts() ) {
				
				  while ($query->have_posts()) : $query->the_post(); 
				  
			?>	
			
				 <li>
				 
					<?php $disable_dot_overlay = get_post_meta($post->ID,'_cmb_toggle_dot_overlay',TRUE); ?>												
					<?php $slide_item_image = get_post_meta($post->ID,'_cmb_slide_image_upload',TRUE); ?>			
					<?php $slide_item_video = get_post_meta($post->ID,'_cmb_slide_video_upload',TRUE); ?>			
					<?php $slide_item_link_address = get_post_meta($post->ID,'_cmb_link_address',TRUE); ?>			
					
					<?php // video or image ?>
					<?php if(!empty($slide_item_image) && empty($slide_item_video)): ?>
						<?php if($disable_dot_overlay != 'on') : ?>
							<div class="slide-overlay"></div> <!-- dots overlay -->
						<?php endif; ?>
					<?php if(!empty($slide_item_link_address)) : ?>
						<a href="<?php echo $slide_item_link_address ?>" target="_blank"><img src="<?php echo $slide_item_image; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="slider-item" /></a>
					<?php else: ?>
						<img src="<?php echo $slide_item_image; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="slider-item" />
					<?php endif; ?>
					<?php elseif(!empty($slide_item_video)): ?>
						<?php // check if string contains the word 'youtu' ?>
						<?php if(strpos($slide_item_video, "youtu") != false): ?>
							<div id="<?php echo $post->ID . "-yt-wrap"; ?>" class="frame-responsive slider-item youtube-video-slide">
								<div class="youtube-screen-overlay">
									<a href="#" class="youtube-play-icon"></a>
									<img src="http://img.youtube.com/vi<?php echo substr($slide_item_video, strrpos($slide_item_video, "/")); ?>/0.jpg" title="<?php _e( 'Play Youtube Video', 'morphis' ); ?>" class="youtube-play-screen"/>	
								</div>
								<iframe id="<?php echo $post->ID . "-yt"; ?>" src="http://www.youtube.com/embed<?php echo substr($slide_item_video, strrpos($slide_item_video, "/")); ?>?enablejsapi=1&wmode=opaque" frameborder="0" allowfullscreen class="youtube-api-item"></iframe>
							</div>
						<?php else: ?>
							<div class="frame-responsive slider-item vimeo-video-slide">
								<iframe id="<?php echo $post->ID . "-vimeo"; ?>" class="vimeo-api-item" src="http://player.vimeo.com/video/<?php echo $slide_item_video; ?>?api=1&player_id=<?php echo $post->ID . "-vimeo"; ?>" color="<?php echo $main_accent_hover_color; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
							</div>
						<?php endif; ?>
					<?php else: ?>
						
					<?php endif; ?>
					<?php ?>
					
					<div class="ei-title">
					
						<?php $slide_item_main_caption = get_post_meta($post->ID,'_cmb_main_caption',TRUE); ?>		
						
						<?php $slide_item_secondary_caption = get_post_meta($post->ID,'_cmb_secondary_caption',TRUE); ?>
						<?php $main_caption_color = get_post_meta($post->ID,'_cmb_main_caption_color',TRUE); ?>
						<?php $sec_caption_color = get_post_meta($post->ID,'_cmb_sec_caption_color',TRUE); ?>
					
						<h2 style="color: <?php echo $main_caption_color; ?>"><?php echo $slide_item_main_caption; ?></h2>
						
						<h3 style="color: <?php echo $sec_caption_color; ?>"><?php echo $slide_item_secondary_caption; ?></h3>
						
					</div>
					
				</li>
			
			<?php endwhile;
				  
				}
				
			?>
				
			</ul><!-- ei-slider-large -->
			
			<ul class="ei-slider-thumbs">
			
				<li class="ei-slider-element"><?php _e( 'Current', 'morphis' ); ?></li>
				
				<?php $query = new WP_Query( array( 
									'post_type' => 'slide',
									'orderby' => 'menu_order',
									'posts_per_page' => -1,
									'order' => 'ASC'
								) ); ?>

				
				<?php if( $query->have_posts() ) {
				
				  		while ($query->have_posts()) : $query->the_post(); 

							echo '<li id="ei-thumb-' . $post->ID . '" data-eithumb="' . $post->ID . '"><a href="#"></a>' ;	
							the_post_thumbnail('ei-slider-thumbnail');							
							echo '</li>';	
					
				  		endwhile;
					  
					}		
					
				?>
					
			</ul><!-- ei-slider-thumbs -->
		</div><!-- ei-slider -->
		<div class="divider lower"></div>
		
		</div>
		
</div>
  <!-- END EI SLIDER -->
	<script type="text/javascript">
		 jQuery(document).ready( function($) {
			$('#ei-slider').eislideshow({				
				// animation types:
				// "sides" : new slides will slide in from left / right
				// "center": new slides will appear in the center
				animation			: '<?php echo $options_morphis['eiAnimationType']; ?>', // sides || center
				// if true the slider will automatically slide, and it will only stop if the user clicks on a thumb
				autoplay			: <?php if($options_morphis['eiAutoplay'] == '1') { echo 'true'; } else { echo 'false'; }?>,
				// interval for the slideshow
				slideshow_interval	: <?php echo $options_morphis['eiSlideInterval']; ?>,
				// speed for the sliding animation
				speed			: <?php echo $options_morphis['eiSpeed']; ?>,
				// easing for the sliding animation
				easing			: '<?php echo $options_morphis['eiEasing']; ?>',
				// percentage of speed for the titles animation. Speed will be speed * titlesFactor
				titlesFactor		: <?php echo $options_morphis['eiTitlesFactor']; ?>,
				// titles animation speed
				titlespeed			: <?php echo $options_morphis['eiTitleSpeed']; ?>,
				// titles animation easing
				titleeasing			: '<?php echo $options_morphis['eiTitleEasing']; ?>',
				// maximum width for the thumbs in pixels
				thumbMaxWidth		: <?php echo $options_morphis['eiThumbnailWidth']; ?>				
			});
		});
	</script>