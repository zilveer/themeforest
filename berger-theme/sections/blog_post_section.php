<?php

global $clapat_bg_theme_options;

$post_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

?>

					<!-- Article Post -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
						
						<?php if( !empty( $post_image[0] )  ){ ?>
                        <div class="post-image" style="background-image:url(<?php echo esc_url( $post_image[0] ); ?>)"></div>
                        <?php } ?>
                            <div class="overlay">
                                <ul class="meta-categories title-has-line">
                                    <?php the_category(); ?>
                                </ul>
                                
								<?php if( $clapat_bg_theme_options['clapat_bg_blog_post_title'] ){ ?>
                                <a class="post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php } ?>
								
                                <ul class="entry-meta">
                                    <li class="entry-date"><a href="<?php the_permalink(); ?>"><?php the_time('F j, Y'); ?></a></li>
                                    <?php if( $clapat_bg_theme_options['clapat_bg_blog_author_info'] ){ ?>
									<li class="entry-author"><?php _e('Posted by', THEME_LANGUAGE_DOMAIN ); ?> <?php the_author_posts_link(); ?></li>
									<?php } ?>
                                    <?php if( $clapat_bg_theme_options['clapat_bg_blog_comments'] ){ ?>
									<li class="entry-comments"><?php comments_popup_link(); ?></li>
									<?php } ?>
									<?php the_tags('<ul class="clapat-tags"><li class="entry-tags">', '</li><li class="entry-tags">', '</li></ul>'); ?>
                                </ul>
                            </div>
                            
                    </article>
                    <!--/Article Post -->
