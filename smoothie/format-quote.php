							<div class="quote-post">
							<?php if( !is_single() ) { ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'cr'), get_the_title()); ?>">
							<?php } ?>

								<!-- BEGIN .entry-quote -->
								<div class="entry-quote">
									<?php $quote = get_post_meta($post->ID, '_cr_quote_quote', true); ?>
									<blockquote><p><?php echo $quote; ?></p></blockquote>
									<p class="quote-source"><?php the_title(); ?></p>
								<!-- END .entry-quote -->
								</div>

							<?php if( !is_single() ) { ?>
								</a>
							<?php } ?>
							</div>