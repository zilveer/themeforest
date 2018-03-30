       				<?php
                    $has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yiw_get_option( 'show_featured_blog', 1 ) ) || ( get_post_type() == 'post' && is_single() && ! yiw_get_option( 'show_featured_single', 1 ) ) ) ? false : true;
                    $more          = '<a class="more-link" href="' . get_permalink() . '">' . str_replace( '->', '&rarr;', yiw_get_option('blog_read_more_text') ) . '</a>';
                    ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post group blog-' . $GLOBALS['blog_type'] ); ?>>

                        <div class="<?php if ( ! $has_thumbnail ) echo 'without ' ?>thumbnail">
                            <div class="image-wrap">
                                <?php if ( $has_thumbnail ) : ?>

                                    <a href="<?php the_permalink() ?>">
                                    <?php the_post_thumbnail( 'blog_big' ); ?>
                                    </a>

                                <?php endif; ?>

                                <?php if ( get_post_type() == 'post' AND yiw_get_option( 'blog_show_date' ) ) : ?>
                                <p class="date">
                                    <span class="month"><?php echo get_the_time('M') ?></span>
                                    <span class="day"><?php echo get_the_time('d') ?></span>
                                </p>
                                <?php endif ?>
                            </div>

                            <?php
                                $link = get_permalink();
                                if ( is_single() )  the_title( "<h1 class=\"post-title\"><a href=\"$link\">", "</a></h1>" );
                                else                the_title( "<h2 class=\"post-title\"><a href=\"$link\">", "</a></h2>" );
                            ?>
                        </div>

                        <?php if ( get_post_type() == 'post' ) : ?>
                        <div class="meta group">
                            <?php if( yiw_get_option( 'blog_show_author' ) ) : ?><p class="author"><span><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></span></p><?php endif; ?>
                            <?php if( yiw_get_option( 'blog_show_categories' ) ) : ?><p class="categories"><span><?php _e( 'In:', 'yiw' ); the_category( ', ' ) ?></span></p><?php endif; ?>
                            <?php if( yiw_get_option( 'blog_show_comments' ) ) : ?><p class="comments"><span><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></span></p><?php endif; ?>
                        </div>
                        <?php endif ?>

                        <div class="the-content"><?php
                            //add_filter( 'excerpt_more', create_function( '$more', 'return "<br /><br /><a class=\"more-link\" href=\"'. get_permalink( get_the_ID() ) . '\">' . yiw_get_option('blog_read_more_text') . '</a>";' ) );
                            if ( ( is_category() || is_archive() || is_search() || ! is_single() ) && has_excerpt() ) {
                                yiw_excerpt_text( get_the_excerpt() );
                                echo $more;
                            } else {
                                the_content( str_replace( '->', '&rarr;', yiw_get_option('blog_read_more_text') ) );
                            }
                        ?></div>

                        <?php wp_link_pages(); ?>

						<?php edit_post_link( __( 'Edit', 'yiw' ), '<span class="edit-link">', '</span>' ); ?>

						<?php if( is_single() ) the_tags( '<p class="list-tags">Tags: ', ', ', '</p>' ) ?>

                    </div>