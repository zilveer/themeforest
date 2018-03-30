                    		<div class="clearfix">
                    			<ul class="paging">
							
								<?php
									$prev_post = get_previous_post();
									if (!empty( $prev_post )): ?>
                    					<li class="left"><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><span>S</span> <?php _e('Prev', 'loc_canon'); ?></a></li>
									<?php else : ?>
                    					<li class="left"><span class="inactive">s</span></li>
								<?php endif; ?>
								
								<?php
									$next_post = get_next_post();
									if (!empty( $next_post )): ?>
                    					<li class="right"><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php _e('Next', 'loc_canon'); ?> <span>s</span></a></li>
									<?php else : ?>
                    					<li class="right"><span class="inactive">s</span></li>
								<?php endif; ?>
							
                    			</ul>
							</div>

