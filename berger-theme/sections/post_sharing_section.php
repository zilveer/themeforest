<?php 

global $clapat_bg_theme_options;

if( $clapat_bg_theme_options['clapat_bg_blog_post_secondary_menu'] ){
?>
						<!-- Post Sharing -->
						<div id="post-sharing" class="share-hide">

							<h6><?php _e("Share this post", THEME_LANGUAGE_DOMAIN); ?></h6>

							<ul class="post-share">
								<?php if( $clapat_bg_theme_options['clapat_bg_blog_post_share_facebook'] ){ ?>
								<li><a title="<?php _e("Share this", THEME_LANGUAGE_DOMAIN); ?>" href="#" class="clapat-facebook-share"><i class="fa fa-facebook"></i> <span class="count">3</span></a></li>
								<?php } ?>
								<?php if( $clapat_bg_theme_options['clapat_bg_blog_post_share_twitter'] ){ ?>
								<li><a title="<?php _e("Tweet this", THEME_LANGUAGE_DOMAIN); ?>" href="#" class="clapat-twitter-share"> <i class="fa fa-twitter"></i> <span class="count">7</span></a></li>
								<?php } ?>
								<?php if( $clapat_bg_theme_options['clapat_bg_blog_post_share_pinterest'] ){ ?>
								<li><a title="<?php _e("Pin this", THEME_LANGUAGE_DOMAIN); ?>" href="#" class="clapat-pinterest-share"> <i class="fa fa-pinterest"></i> <span class="count">9</span></a></li>
								<?php } ?>
							</ul>
						<?php 
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            			echo "<span id='clapat-share-image' clapat-data-img='" . esc_attr( $thumbnail[0] ) . "'/>"; // If it has a featured image
						?>
						
						</div>
						<!-- Post Sharing -->

<?php } ?>