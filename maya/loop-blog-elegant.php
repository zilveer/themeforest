                    <?php
                    $has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yiw_get_option( 'show_featured_blog', 1 ) ) || ( get_post_type() == 'post' && is_single() && ! yiw_get_option( 'show_featured_single', 1 ) ) ) ? false : true;
                    $link          = get_permalink();
                    $more          = '<a class="more-link" href="' . get_permalink() . '">' . str_replace( '->', '&rarr;', yiw_get_option('blog_read_more_text') ) . '</a>';
                    ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post group blog-' . $GLOBALS['blog_type'] ); ?>>

                        <div class="the_post group">
                            <?php
                            //if is_single(), elegant style requires the title outside .blog-elegant-left
                            if ( is_single() AND get_post_type() != 'bl_testimonials' )  the_title( "<h1 class=\"post-title\"><a href=\"$link\">", "</a></h1>" );
                            ?>
                            <div class="blog-elegant-left">
                                <?php
                                // title
                                if( !is_single() OR get_post_type() == 'bl_testimonials' ) the_title( "<h2 class=\"post-title\"><a href=\"$link\">", "</a></h2>" );
                                ?>

                                <div class="meta group">
                                    <?php if( yiw_get_option( 'blog_show_date' ) ) : ?><p class="date"><?php echo the_time( str_replace( 'F', 'M', get_option('date_format') ) ); ?></p><?php endif; ?>
                                    <?php if( yiw_get_option( 'blog_show_author' ) ) : ?><p class="author"><span><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></span></p><?php endif; ?>
                                    <?php if( yiw_get_option( 'blog_show_categories' ) ) : ?><p class="categories"><span><?php _e( 'In:', 'yiw' ); the_category( ', ' ) ?></span></p><?php endif; ?>
                                </div>

                                <?php if( yiw_get_option( 'blog_show_comments' ) ) : ?><p class="comments"><span><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></span></p><?php endif; ?>
                                <?php if( yiw_get_option( 'blog_show_socials' ) ) : ?>
                                <div class="blog-elegant-socials">
                                    <p><?php _e( 'Share on', 'yiw' ); ?></p>
                                    <?php echo do_shortcode( '[share title="" socials="' . yiw_get_option( 'blog_share_socials' ) . '"]' ); ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="blog-elegant-right">
                            <?php
                            // thumbnail
                            if ( $has_thumbnail ) {
								echo apply_filters( 'yiw-loop-blog-elegant-thumbnail', get_the_post_thumbnail( get_the_ID(), 'blog_elegant' ) );
							}

                            // content
                            //add_filter( 'excerpt_more', create_function( '$more', 'return "<br /><br /><a class=\"more-link\" href=\"'. get_permalink( get_the_ID() ) . '\">' . yiw_get_option('blog_read_more_text') . '</a>";' ) );
                            if ( ! is_single() ) {
                                if ( has_excerpt() OR get_post_type() == 'bl_testimonials' ) {
                                    yiw_excerpt_text( get_the_excerpt() );
                                    echo $more;
                                } else {
                                    the_content( str_replace( '->', '&rarr;', yiw_get_option('blog_read_more_text') ) );
                                }
                            }
                            ?>
                            </div>
                       </div>

                        <?php
                        if( is_single() AND get_post_type() != 'bl_testimonials' ) {
                            echo '<div class="the_content">', the_content(), '</div>';
                        }

                        wp_link_pages();

                        edit_post_link( __( 'Edit', 'yiw' ), '<p class="edit-link">', '</p>' );
                        ?>
                    </div>