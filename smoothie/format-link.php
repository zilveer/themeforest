							<div class="link-post">
									<?php $link = get_post_meta($post->ID, '_cr_link_url', true); ?>
									<h2><a href="<?php echo $link; ?>" target="_blank"><?php the_title(); ?></a></h2>
									<p class="link-url"><a href="<?php echo $link; ?>" target="_blank"><?php echo $link; ?></a></p>								
							</div>