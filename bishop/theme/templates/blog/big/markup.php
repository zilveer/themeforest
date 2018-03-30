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

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="meta clearfix blog <?php echo $blog_type ?>">

        <?php if( $show_thumbnail && $what_formats_show == 'featured-image' && ! $is_quote ) : ?>
            <?php yit_get_template( 'blog/post-formats/standard.php', array( 'show_date' => $show_date, 'post_format' => $post_format, 'show_post_format_icon' => $show_post_format_icon, 'blog_type' => $blog_type, 'link' => $link ) ) ?>
        <?php elseif( $show_thumbnail && $what_formats_show == 'post-format' && ! $is_quote ) : ?>
            <?php $args = array(
                'post_format'    => $post_format,
                'image_size'     => $image_size,
                'show_date'      => $show_date,
                'title'          => $title,
                'link'           => $link,
                'show_read_more' => $show_read_more,
                'read_more_text' => $read_more_text,
                'blog_type'      => $blog_type,
                'show_post_format_icon' => $show_post_format_icon
            ); ?>
            <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', $args ) ?>
        <?php elseif( $is_quote ): ?>
            <?php $quote_args = array( 'show_date' => $show_date, 'blog_type' => $blog_type, 'title' => $title, 'link' => $link, 'show_read_more' => $show_read_more, 'post_format' => $post_format, 'read_more_text' => $read_more_text, 'show_post_format_icon' => $show_post_format_icon ) ?>
            <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', $quote_args ) ?>
        <?php endif; ?>

        <?php if( ! $is_quote ) : ?>
            <div class="yit_post_content clearfix">

                <?php if( $show_title ) : ?>
                    <?php yit_string( "<h2 class='post-title'><a href='{$link}'>", $title, "</a></h2>" ); ?>
                <?php endif; ?>

                <?php  ( true == $show_read_more ) ?  the_content( $read_more_text ) : the_excerpt(); ?>

            </div>
        <?php endif; ?>


        <?php if( $show_meta_box ) : ?>
            <div class="yit_post_meta">

                <span class="yit_author_date">
                    <?php if( $show_author )     { echo __('by', 'yit') . ' ';  the_author_posts_link(); } ?>
                    <?php if( $show_date )       { echo __('on', 'yit') . ' ' . get_the_date(); }?>
                </span>

                <span class="yit_post_info">

                    <?php if( $show_categories ) : ?>
                        <?php if( $show_author || $show_date ) echo $post_meta_separator; ?>
                        <?php echo __('Categories: ', 'yit') . ' ' ;  ?>
                        <?php the_category( ', ' ); ?>
                    <?php endif; ?>

                    <?php if( $show_comments )   : ?>
                        <?php if( $show_categories ) echo $post_meta_separator ?>
                        <?php echo __('Comments: ', 'yit') . ' '; ?>
                        <a href="<?php comments_link() ?>"><?php comments_number( 0, 1, '%'); ?></a>
                    <?php endif; ?>

                    <?php if( $show_tags ) : ?>
                        <?php if( $show_comments && $has_tags ) echo $post_meta_separator ?>
                        <?php the_tags( __('Tags: ', 'yit') , ', '); ?>
                    <?php endif; ?>

                </span>
                <?php yit_edit_post_link( __( 'Edit', 'yit' ) , '<span class="yit-edit-post">' . $post_meta_separator, '</span>' ); ?>
            </div>
        <?php endif; ?>
    </div>

</div>