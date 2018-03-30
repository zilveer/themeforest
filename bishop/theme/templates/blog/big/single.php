<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( $hide_footer ) {
    add_filter('yit_footer_type', 'yit_hide_footer' );
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="meta clearfix blog <?php echo $blog_type ?>">

        <?php if( $is_quote && ! is_singular( 'post' ) && ! ( defined('DOING_AJAX') && DOING_AJAX ) ) : ?>
            <?php $args = array(
                'post_format'    => $post_format,
                'image_size'     => $image_size,
                'show_date'      => $show_date,
                'title'          => $title,
                'link'           => $link,
                'show_read_more' => $show_read_more,
                'blog_type'      => $blog_type,
                'show_post_format_icon' => $show_post_format_icon
            ); ?>
            <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', $args ) ?>
        <?php endif; ?>


        <?php if( $show_title ) : ?>
            <?php yit_string( "<h1 class='post-title'><a href='{$link}'>", $title, "</a></h1>" ); ?>
        <?php endif; ?>


        <?php if( $show_meta_box ) : ?>
            <div class="yit_post_meta_wrapper">
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
            </div>
        <?php endif; ?>

        <div class="yit_post_content clearfix">
            <?php $is_quote ? yit_get_template( 'blog/post-formats/quote.php', array( 'blog_type' => $blog_type ) ) : the_content() ?>
        </div>

         <?php if( $show_share ) : ?>
            <div class="share-wrapper">
                <span class="share <?php echo $share_icon_class ?>" <?php if( $share_icon_type == 'custom' ) echo yit_ssl_url( $share_icon )?>>
                    <?php if( $share_icon_type == 'icon' ) echo $share_icon ?>
                    <span class="share-text"><?php echo $share_text ?></span>
                    <div class="socials-container">
                        <?php echo yit_get_social_share( 'text', 'arrow' ) ?>
                    </div>
                </span>
            </div>
        <?php endif; ?>

    </div>
</div>