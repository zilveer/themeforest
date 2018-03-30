					<?php $inspire_options_post = get_option('inspire_options_post'); ?>
					
					<div class="post-pagination <?php echo $inspire_options_post['post_style'] ?>">
					
						<?php
							$prev_post = get_previous_post();
							if (!empty( $prev_post )): ?>
								<a class="pagination prev" href="<?php echo get_permalink( $prev_post->ID ); ?>"><span>« <?php _e('Previous Post', 'loc_inspire'); ?></span><?php echo $prev_post->post_title; ?></a>
							<?php else : ?>
								<a class="pagination prev last" href="#"><span>« <?php _e('Previous Post', 'loc_inspire'); ?></span><?php _e('There are no older stories', 'loc_inspire'); ?>There are no older stories</a>
						<?php endif; ?>
						
						<?php
							$next_post = get_next_post();
							if (!empty( $next_post )): ?>
								<a class="pagination next" href="<?php echo get_permalink( $next_post->ID ); ?>"><span><?php _e('Next Post', 'loc_inspire'); ?> »</span><?php echo $next_post->post_title; ?></a>
							<?php else : ?>
								<a class="pagination next last" href="#"><span><?php _e('Next Post', 'loc_inspire'); ?> »</span></span><?php _e('This is the most recent story', 'loc_inspire'); ?></a>
						<?php endif; ?>
					
					</div>
