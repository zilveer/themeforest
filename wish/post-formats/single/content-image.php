<!-- Image Start -->
		<div class="col-lg-12">
				<div class="image animated" data-animation="fadeInUp" data-animation-delay="100">
						<?php 
						$attr = array(
							'class' => "img-responsive",
							'alt'   => $post->post_title,
						);

						if ( has_post_thumbnail() ) {

						the_post_thumbnail( 'type_post_image', $attr);

					   }else{ ?>
					   	<img alt="<?php echo esc_attr($post->post_title); ?>" src='<?php echo esc_url( get_template_directory_uri() )  ?>/images/placeholders/blog2.png' class='post-placeholder img-responsive'>

					   	<?php } ?>

						<div class="picture-overlay">
							<div class="icons">
								<div><span class="icon"><a href="<?php esc_url( the_permalink() ) ?>"><i class="fa fa-link"></i></a></span><span class="icon"><a class="image-popup-vertical-fit" href="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ); ?>" title="<?php echo get_post(get_post_thumbnail_id())->post_title; ?>"><i class="fa fa-search"></i></a></span></div>
							</div>
						</div>
					   	
  					
				</div>
		</div>
								<!-- Image Ends -->