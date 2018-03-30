								<!-- grab the featured image -->
								<div class="image-format">
								<?php if ( has_post_thumbnail() ) { $imagesize = 'large-image'; ?>
                                <?php if (is_singular()){
                                    $imagesize = 'large-image';
                                } else if (is_home() && of_get_option('of_masonryswitchhome')=="1"){
                                    $imagesize = 'medium-image';
                                } else if (is_archive() && of_get_option('of_masonryswitch')=="1"){
                                    $imagesize = 'medium-image';
                                } else if (is_search() && of_get_option('of_masonryswitch')=="1"){
                                    $imagesize = 'medium-image';
                                }?>
                                    <a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( $imagesize ); ?></a>
								<?php } ?>
								</div>