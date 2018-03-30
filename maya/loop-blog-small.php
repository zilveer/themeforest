                    <?php
                    $has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yiw_get_option( 'show_featured_blog', 1 ) ) || ( get_post_type() == 'post' && is_single() && ! yiw_get_option( 'show_featured_single', 1 ) ) ) ? false : true;
                    $more          = '<a class="more-link" href="' . get_permalink() . '">' . str_replace( '->', '&rarr;', yiw_get_option('blog_read_more_text') ) . '</a>';
                    ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post group blog-' . $GLOBALS['blog_type'] . ( ( ! $has_thumbnail ) ? ' without-thumbnail' : '' ) ); ?>>

                        <div class="thumbnail">
							<?php // thumbnail
							if ( $has_thumbnail ) {
								echo apply_filters( 'yiw-loop-blog-small-thumbnail', get_the_post_thumbnail( get_the_ID(), 'blog_small' ) );
							} ?>
                            <?php if( yiw_get_option( 'blog_show_date' ) ) : ?>
                            <p class="date">
                                <span class="month"><?php echo get_the_time('M') ?></span>
                                <span class="day"><?php echo get_the_time('d') ?></span>
                            </p>
                            <?php endif; ?>
                        </div>

                        <?php
                            $link = get_permalink();
                            if ( is_single() )  the_title( "<h1 class=\"post-title\"><a href=\"$link\">", "</a></h1>" );
                            else                the_title( "<h2 class=\"post-title\"><a href=\"$link\">", "</a></h2>" );
                        ?>

                        <div class="the-content">
                            <?php
                            if( ! is_single() && has_excerpt() ) {
                                yiw_excerpt_text( get_the_excerpt() );
                                echo $more;
                            } else {
                                the_content();
                            }
                            ?>
                        </div>
                        <?php wp_link_pages(); ?>

                        <div class="meta-bottom">
                        <?php if( yiw_get_option( 'blog_show_author' ) OR yiw_get_option( 'blog_show_categories' ) OR yiw_get_option( 'blog_show_comments' ) OR yiw_get_option( 'blog_show_socials' ) ) : ?>
                            <div class="meta group">
                                <?php if( yiw_get_option( 'blog_show_author' ) ) : ?><p class="author"><span><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></span></p><?php endif; ?>
                                <?php if( yiw_get_option( 'blog_show_categories' ) ) : ?><p class="categories"><span><?php _e( 'In:', 'yiw' ); the_category( ', ' ) ?></span></p><?php endif; ?>
                                <?php if( yiw_get_option( 'blog_show_comments' ) ) : ?><p class="comments"><span><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></span></p><?php endif; ?>
                                <?php if( yiw_get_option( 'blog_show_socials' ) ) : ?>
                                <p class="socials">
                                    <span><?php _e( 'Share on', 'yiw' ); ?></span>
                                    <?php echo do_shortcode( '[share title="" socials="' . yiw_get_option( 'blog_share_socials' ) . '"]' ); ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        </div>

						<?php edit_post_link( __( 'Edit', 'yiw' ), '<p class="edit-link">', '</p>' ); ?>

						<?php if( is_single() ) the_tags( '<p class="list-tags">Tags: ', ', ', '</p>' ) ?>

                    </div>