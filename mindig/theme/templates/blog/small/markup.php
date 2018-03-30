<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class( array( $bootstrap_col_class) ); ?>>
    <div class="meta clearfix blog <?php echo $blog_type ?>">
        <div class="<?php echo $blog_type ?> post-wrapper">
            <?php if( ! $is_quote ) : ?>
                <?php yit_get_template( 'blog/post-formats/standard.php', array( 'show_thumbnail' => $show_thumbnail, 'show_date' => $show_date, 'post_format' => $post_format,  'show_post_format_icon' => $show_post_format_icon, 'blog_type' => $blog_type, 'link' => $link ) ) ?>
            <?php endif; ?>

            <?php if( $is_quote ) : ?>
                <?php $quote_args = array( 'show_date'      => $show_date,
                                           'blog_type'      => $blog_type,
                                           'title'          => $title,
                                           'link'           => $link,
                                           'show_title'     => $show_title,
                                           'show_read_more' => $show_read_more,
                                           'read_more_text' => $read_more_text,
                                           'show_meta_box'  => $show_meta_box ) ?>
                <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', $quote_args ) ?>
                <div class="yit_post_format_icon"><?php echo isset( $post_format ) ? $post_format : '' ?></div>
            <?php else : ?>
                <div class="yit_post_content clearfix">
                    <?php if( $show_title ) : ?>
                        <?php yit_string( "<h3 class='post-title'><a href='{$link}'>", $title, "</a></h3>" ); ?>
                    <?php endif; ?>

                    <div class="yit_the_content">
                        <?php  echo ( true == $show_read_more ) ? yit_plugin_content( 'excerpt', 60, $read_more_text, '', false ) : yit_plugin_content( 'excerpt', 60, '', '', false ) ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if( $show_meta_box ) : ?>
                <div class="yit_post_meta">
                    <?php if( $show_author ) : ?>
                        <span class="author <?php echo $author_icon_class ?>">
                            <?php if( $author_icon_type == 'icon' ) echo $author_icon ?>
                            <?php echo __('by', 'yit') . ' ';  the_author_posts_link(); ?>
                        </span>
                    <?php endif; ?>

                    <?php if( $show_categories ) : ?>
                        <span class="categories <?php echo $categories_icon_class ?>">
                            <?php if( $show_author ) echo $post_meta_separator; ?>
                            <?php echo __('Categories: ', 'yit') . ' ' ;  ?>
                            <?php the_category( ', ' ); ?>
                        </span>
                    <?php endif; ?>

                    <?php if( $show_comments )   : ?>
                        <span class="comments <?php echo $comments_icon_class ?>">
                            <?php if( $show_categories || $show_author ) echo $post_meta_separator ?>
                            <a href="<?php comments_link() ?>"><?php comments_number( __( '0 Comment', 'yit' ), __( '1 Comment', 'yit' ), '% Comments'); ?></a>
                        </span>
                    <?php endif; ?>

                    <?php if( $show_tags && $has_tags ) : ?>
                        <span class="tags <?php echo $tags_icon_class ?>">
                            <?php if( $show_categories || $show_author || $show_comments  && $has_tags ) echo $post_meta_separator ?>
                            <?php if( $tags_icon_type == 'icon' ) echo $tags_icon ?>
                            <?php the_tags( __('Tags: ', 'yit') , ', '); ?>
                        </span>
                        <?php yit_edit_post_link( __( 'Edit', 'yit' )  , '<span class="yit-edit-post"> / ', '</span>' ); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
