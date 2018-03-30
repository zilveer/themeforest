<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

wp_enqueue_script( 'jquery-masonry' );
$sidebar = yit_get_sidebars();
$layout_sidebar = $sidebar['layout'];

//Sets classes for the element

if( $layout_sidebar == 'sidebar-no' ){
    $default_classes = "col-sm-3 col-xs-6 masonry_item";
}elseif( $layout_sidebar == 'sidebar-double' ) {
    $default_classes = "col-lg-6 col-sm-6 col-xs-6 masonry_item";
}else{
    $default_classes = "col-lg-4 col-sm-6 col-xs-6 masonry_item";
}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class($default_classes); ?>>



            <?php if( $show_thumbnail && ! $is_quote ) : ?>
                <?php yit_get_template( 'blog/post-formats/standard.php', array( 'show_date' => $show_date, 'blog_type' => $blog_type, 'post_format' => $post_format,  'show_post_format_icon' => $show_post_format_icon, 'link' => $link ) ) ?>
            <?php endif; ?>
            <?php if( $is_quote ) : ?>
                 <div class="yit_post_content clearfix">
                <?php $quote_args = array( 'show_date' => $show_date, 'blog_type' => $blog_type, 'title' => $title, 'link' => $link, 'show_read_more' => $show_read_more, 'read_more_text' => $read_more_text, 'show_post_format_icon' => $show_post_format_icon, ) ?>
                <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', $quote_args ) ?>
            <?php endif; ?>

            <?php if( ! $is_quote ) : ?>
                <div class="yit_post_content clearfix">

                    <?php if( $show_title ) : ?>
                        <?php yit_string( "<h2 class='post-title'><a href='{$link}'>", $title, "</a></h2>" ); ?>
                    <?php endif; ?>

                    <?php if( $show_excerpt ) : ?>
                        <?php  ( true == $show_read_more ) ?  the_content( $read_more_text ) : the_excerpt(); ?>
                    <?php endif; ?>

            <?php endif; ?>

            <?php if( $show_meta_box ) : ?>
                <div class="yit_post_meta">

                    <?php if( $show_author ) : ?>
                        <span class="author <?php echo $author_icon_class ?>" <?php if( $author_icon_type == 'custom' ) echo yit_ssl_url( $author_icon )?>>
                            <?php if( $author_icon_type == 'icon' ) echo $author_icon ?>
                            <?php echo __('by', 'yit') . ' ';  the_author_posts_link(); ?>
                        </span>
                    <?php endif; ?>

                    <?php if( $show_categories ) : ?>
                        <span class="categories <?php echo $categories_icon_class ?>" <?php if( $categories_icon_type == 'custom' ) echo yit_ssl_url( $categories_icon )?>>
                            <?php if( $categories_icon_type == 'icon' ) echo $categories_icon ?>
                            <?php echo __('Categories: ', 'yit') . ' ' ;  ?>
                            <?php the_category( ', ' ); ?>
                        </span>
                    <?php endif; ?>

                    <?php if( $show_comments )   : ?>
                        <span class="comments <?php echo $comments_icon_class ?>" <?php if( $comments_icon_type == 'custom' ) echo yit_ssl_url( $comments_icon )?>>
                            <?php if( $comments_icon_type == 'icon' ) echo $comments_icon ?>
                            <?php echo __('Comments: ', 'yit') . ' '; ?>
                            <a href="<?php comments_link() ?>"><?php comments_number( 0, 1, '%'); ?></a>
                        </span>
                    <?php endif; ?>

                    <?php if( $show_tags && $has_tags ) : ?>
                        <span class="tags <?php echo $tags_icon_class ?>" <?php if( $tags_icon_type == 'custom' ) echo yit_ssl_url( $tags_icon )?>>
                            <?php if( $tags_icon_type == 'icon' ) echo $tags_icon ?>
                            <?php the_tags( __('Tags: ', 'yit') , ', '); ?>
                        </span>
                    <?php endif; ?>
                    <?php yit_edit_post_link( __( 'Edit', 'yit' )  , '<span class="yit-edit-post"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
                </div>
            <?php endif; ?>
                </div>
        </div>

