								<!-- grab the featured image -->
								<div class="image-format">
								<?php if ( has_post_thumbnail() ) { $imagesize = 'medium-image'; ?>
                                    <a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( $imagesize ); ?></a>
								<?php } ?>
								</div>