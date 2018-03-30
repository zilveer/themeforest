<!-- video Start -->
								<div class="col-lg-12">
								<?php if(wp_oembed_get(get_post_meta($post->ID, 'wish_video', true)) != ""){ ?>
									<div class="video animated" data-animation="fadeInUp" data-animation-delay="100">
											<?php echo wp_oembed_get(get_post_meta($post->ID, 'wish_video', true)); ?>				
									</div>
								<?php }else{ ?>
									<div class="image animated" data-animation="fadeInUp" data-animation-delay="100">
										<img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/blog_large.png" alt="" class="img-responsive">
									</div>
								<?php } ?>	

								</div>
								<!-- video Ends -->