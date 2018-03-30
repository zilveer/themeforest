							
							<!-- Media Item -->
							<div <?php post_class('media-item animate-onscroll gallery-media '); ?>>
							
								<div class="media-image">
								
									<img src="<?php if(isset($media['thumb'])) echo $media['thumb']; ?>" alt="">
									
									<div class="media-hover 
									<?php if(get_option('sense_show_share_madia') == 'show')
											{
											 echo "media_bt"; ?>
											<?php } ?> 
									">
										<div class="media-icons">
											<a href="<?php if(isset($media['jackbox-link'])) echo $media['jackbox-link']; ?>" data-group="media-jackbox" data-thumbnail="<?php if(isset($media['thumb'])) echo $media['thumb']; ?>" class="jackbox media-icon"><i class="icons <?php if($media['format'] == 'image' || $media['format'] == 'gallery') echo 'icon-zoom-in'; else if($media['format'] == 'video') echo 'icon-play'; ?>"></i></a>
											<a href="<?php echo $media['post-link']; ?>" class="media-icon"><i class="icons icon-link"></i></a>
										
										
										<?php if(get_option('sense_show_share_madia') == 'show')
											{
											?>
											<div class="share-icons">
												<span><?php esc_html_e( 'Share This', 'candidate' ); ?>:</span>
												<a target="_blank" thumbnail="<?php if(isset($media['thumb'])) echo esc_url($media['thumb']); ?>" title="<?php if(isset($media['name'])) echo esc_attr($media['name']); ?>" href="<?php echo esc_url($media['jackbox-link']); ?>" link="<?php echo esc_url($media['post-link']); ?>" class="media-icon share-facebook">Facebook</a>
												<a target="_blank" href="<?php echo esc_url($media['jackbox-link']); ?>" title="<?php if(isset($media['name'])) echo esc_attr($media['name']); ?>" class="media-icon share-twitter">Twitter</a>
											</div>
										<?php } ?>
										
										</div>
									</div>
								
								</div>
									
							</div>
							<!-- /Media Item -->