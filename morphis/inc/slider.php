<?php
?>
<div class="caroufredsel-preloader">
<div class="preloader-image"></div>
</div>
<!-- MAIN SLIDER -->
  <div id="main-slider" class="container-full-width main-slider-caroufredsel">
  
 	<?php 
		global $NHP_Options; 
		$options_morphis = $NHP_Options; 
	?>
	
	<?php if( isset( $options_morphis['toggle_slider_boxed'] ) && isset( $options_morphis['boxed_full_layout_select'] ) ): ?>
		<?php if($options_morphis['toggle_slider_boxed'] == '1' && $options_morphis['boxed_full_layout_select'] == 'boxed'): ?>
			<div class="container">
		<?php endif; ?>
  <?php else : ?>
  
	<div class="bottom-spacer">
	
  <?php endif; ?>
  
			<div class="divider upper"></div>		
			
				<div class="slides-carousel">
				<?php
				
				
				
				$query = new WP_Query( array( 
									'post_type' => 'slide',
									'orderby' => 'menu_order',
									'posts_per_page' => -1,
									'order' => 'ASC'
								) );

				if( $query->have_posts() ) {
				
				  while ($query->have_posts()) : $query->the_post(); ?>	
				  
					
					
						<?php $main_caption_color = get_post_meta($post->ID,'_cmb_main_caption_color',TRUE); ?>
						<?php $sec_caption_color = get_post_meta($post->ID,'_cmb_sec_caption_color',TRUE); ?>					
						<?php $slide_item_image = get_post_meta($post->ID,'_cmb_slide_image_upload',TRUE); ?>			
						<?php $slide_item_main_caption = get_post_meta($post->ID,'_cmb_main_caption',TRUE); ?>
						<?php $slide_item_secondary_caption = get_post_meta($post->ID,'_cmb_secondary_caption',TRUE); ?>		
						<?php $slide_item_link_button_caption = get_post_meta($post->ID,'_cmb_link_caption',TRUE); ?>		
						<?php $slide_item_link_button_link = get_post_meta($post->ID,'_cmb_link_address',TRUE);  ?>	
						<?php $slide_item_video = get_post_meta($post->ID,'_cmb_slide_video_upload',TRUE); ?>	
						
						<?php // video or image ?>
						
						<?php if(!empty($slide_item_image) && empty($slide_item_video)): ?>
						
						<div class="slide">
							
							<img src="<?php echo $slide_item_image; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="slider-item" />
							
							<?php if($slide_item_main_caption != ''): ?>
							
								<h3><span class="slide-title" style="color: <?php echo $main_caption_color; ?>"><?php echo $slide_item_main_caption; ?></span></h3>
														
							<?php endif; ?>
							
								<p style="color: <?php echo $sec_caption_color; ?>"><?php echo $slide_item_secondary_caption; ?></p>
							
							<?php
							
								if(strlen($slide_item_link_button_caption) != 0){
								
							?>
							
								<a href="<?php echo $slide_item_link_button_link; ?>" target="_blank"><?php echo $slide_item_link_button_caption; ?> <span class="orange">&#43;</span></a>
							
							<?php
							
								}
						
							?>	
							
					
						
						</div>		
					
					<?php endif; ?>
					
					<?php 
					
				  endwhile;
				  
				}
				  ?>
					
				</div>
				
			<a href="#" id="prev"></a>
			<a href="#" id="next"></a>	
				
		<div class="clear"></div>
				
		<div class="divider lower"></div>
		
	</div>
		
  </div>
  <!-- END MAIN SLIDER -->
