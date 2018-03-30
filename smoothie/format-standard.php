								<!-- grab the featured image -->
								<?php if ( has_post_thumbnail() ) { $imagesize = 'large-image';?>
                                <?php if (is_singular()){
                                    $imagesize = 'large-image';
                                } else if (is_home() && of_get_option('of_masonryswitchhome')=="1"){
                                    $imagesize = 'medium-image';
                                } else if (is_archive() && of_get_option('of_masonryswitch')=="1"){
                                    $imagesize = 'medium-image';
                                } else if (is_search() && of_get_option('of_masonryswitch')=="1"){
                                    $imagesize = 'medium-image';
                                } ?>
                                    <a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( $imagesize ); ?></a>
								<?php } ?>
                                <div class="clear"></div>
							<div class="frame">
								<div class="title-wrap">
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									
									<div class="title-meta">
											<span><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span> 
                                            <span><i class="fa fa-calendar"></i><a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php echo get_the_date(); ?></a></span>
                                            <span class="categories"><i class="fa fa-align-justify"></i><?php the_category(', '); ?></span>
                                            <span class="tags"><?php the_tags('<i class="fa fa-tag"></i>', ', '); ?></span>
									</div>
								</div>
								
								<div class="post-content">
									<?php if (!is_single() && of_get_option('of_excerptset')=="1") { ?>
										<?php the_excerpt(); ?>
									<?php } else { ?>
										<?php the_content( __('Read more...', 'cr') ); ?>
										
										<?php if(is_single()) { ?>
											<div class="pagelink">
												<?php wp_link_pages(); ?>
											</div>
										<?php } ?>
									<?php } ?>
								</div>        
							</div><!-- frame -->

							<!-- meta info bar -->
							<?php if(is_page()) { } else { ?>
								<div class="bar">
											<div class="share">
												<!-- twitter -->
												<a class="share-twitter" onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank"><i class="fa fa-twitter"></i></a>
												
												<!-- facebook -->
												<a class="share-facebook" onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>"  target="blank"><i class="fa fa-facebook"></i></a>
												
												<!-- google plus -->
												<a class="share-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;"><i class="fa fa-google-plus"></i></a>
												
												<!-- Linkedin -->
												<a onClick="MyWindow=window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php echo home_url(); ?>','MyWindow','width=600,height=400'); return false;" title="Share on LinkedIn" style="cursor:pointer;" target="_blank" id="linkedin-share"><i class="fa fa-linkedin"></i></a>
												
												<!-- Pinterest -->
												<?php if (has_post_thumbnail( $post->ID ) ){ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
												<a onClick="MyWindow=window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image[0]; ?>&description=<?php the_title(); ?>','MyWindow','width=600,height=400'); return false;" style="cursor:pointer;" target="_blank" id="pinterest-share"><i class="fa fa-pinterest"></i></a>
												<?php } else { ?>
												<a onClick="MyWindow=window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=&description=<?php the_title(); ?>','MyWindow','width=600,height=400'); return false;" style="cursor:pointer;" target="_blank" id="pinterest-share"><i class="fa fa-pinterest"></i></a>
												<?php }?>
											</div><!-- share -->								
								</div><!-- bar -->
							<?php } ?>