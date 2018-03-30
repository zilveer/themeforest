					
							<!-- Media Item -->
							<div <?php post_class('media-item animate-onscroll '); ?>>
								<?php 
									if($media['format'] != 'gallery'){
								?>
								<div class="media-image">
								
									<img src="<?php if(isset($media['thumb'])) echo esc_url($media['thumb']); ?>" alt="">
									
									
									
									<div class="media-hover 
									<?php if(get_option('sense_show_share_madia') == 'show')
											{
											 echo "media_bt"; ?>
											<?php } ?> 
											">
										<div class="media-icons">
											<a href="<?php if(isset($media['jackbox-link'])) echo esc_url($media['jackbox-link']); ?>" data-group="media-jackbox" data-thumbnail="<?php if(isset($media['thumb'])) echo $media['thumb']; ?>" class="jackbox media-icon"><i class="icons <?php if($media['format'] == 'image') echo 'icon-zoom-in'; else if($media['format'] == 'video') echo 'icon-play'; ?>"></i></a>
											<a href="<?php echo esc_url($media['post-link']); ?>" class="media-icon"><i class="icons icon-link"></i></a>
										
										<?php if(get_option('sense_show_share_madia') == 'show')
											{
											?>
											<div class="share-icons">
											<span><?php esc_html_e( 'Share This', 'candidate' ); ?>:</span>
											
												<a data-type="fb" target="_blank" thumbnail="<?php if(isset($media['thumb'])) echo esc_url($media['thumb']); ?>" title="<?php if(isset($media['name'])) echo esc_attr($media['name']); ?>" href="<?php echo esc_url($media['jackbox-link']); ?>" link="<?php echo esc_url($media['post-link']); ?>" class="media-icon share-facebook">Facebook</a>
												<a data-type="tw" target="_blank" href="<?php echo esc_url($media['jackbox-link']); ?>" link="<?php echo esc_url($media['jackbox-link']); ?>" title="<?php if(isset($media['name'])) echo esc_attr($media['name']); ?>" class="media-icon share-twitter">Twitter</a>
											 
											</div>
											
											<?php } ?>
										</div>
										
										
									</div>
								
								</div>
									<?php 
										} else {
									
								
										$type = $media['type-image'];
										$slider_image_gallery = get_meta_option('portfolio_post_gallery', $post->ID);
										$attachments = array_filter( explode( ',', $slider_image_gallery ) );
										?>
										<!-- Portfolio Slideshow -->
										<div class="portfolio-slideshow media-image flexslider">
											
											<ul class="slides">
											
												<?php 
												foreach ($attachments as $attachment) 
												{
												$attachment_id = get_post( $attachment );
												$caption = trim(strip_tags($attachment_id->post_excerpt));
												$alt = trim(strip_tags(get_post_meta($attachment, '_wp_attachment_image_alt', true)));
												echo '<li>';
												echo candidat_get_featured_image($attachment, $type, 'portfolio-image', $alt);
												echo '</li>'."\n";
												}
												?>
												
											</ul>
											
										</div>
								
								
								
								
									<?php 
										} 
									?>
									
									
								<div class="media-info">
								
									<div class="media-header">
										
										<div class="media-format">
											<div>
											<i class="icons <?php if($media['format'] == 'image' || $media['format'] == 'gallery') echo 'icon-picture'; else if($media['format'] == 'video') echo 'icon-video'; ?>"></i>
											</div>
										</div>
										
										<div class="media-caption">
											<h2><a href="<?php echo esc_url($media['post-link']); ?>"><?php if(isset($media['name'])) echo esc_attr($media['name']); ?></a></h2>
											<span class="tags"><?php if(isset($media['category'])) echo $media['category']; ?></span>
										</div>
										
									</div>
									
									<div class="media-description">
										<p><?php if(isset($media['description'])) echo $media['description']; ?></p>
									</div>
									
									<div class="media-button">
										<a href="<?php echo $media['post-link']; ?>" class="button big button-arrow"><?php esc_html_e( 'More info', 'candidate' ); ?></a>
										<?php 
										if(isset($media['project-link']) && $media['project-link'] != '') echo '<a href="'. esc_url($media['project-link']) .'" target="_blank" class="button big button-arrow">' . __( 'View Project' , 'candidate') . '</a>';
										?>
									</div>
								
								</div>
								
								
								
							</div>
							<!-- /Media Item -->