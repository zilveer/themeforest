<!-- Gallery Start -->
		<div class="col-lg-12">
				<div class="image pictures-carousel animated" data-animation="fadeInUp" data-animation-delay="100">
	<?php 			
					if(function_exists("rwmb_meta")){
						$slides = rwmb_meta( 'wish_gallery_gal', 'type=image&size=type_post_image' ); 
					}else{
						$slides = array();	
					}


					if(!empty($slides)){
					foreach($slides as $slide){
					?>
							<div><img src="<?php echo esc_url($slide['url']); ?>" class="img-responsive" alt="slide"></div>
						<?php }}else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/blog_large.png" alt="" class="img-responsive">
						<?php } ?>			
				</div>
		</div>
								<!-- Gallery Ends -->