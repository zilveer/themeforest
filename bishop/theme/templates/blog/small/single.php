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

    <div class="meta clearfix row blog <?php echo $blog_type ?> single">

        <div class="col-sm-12">

            <?php if( $show_thumbnail && $post_format == 'standard' ) : ?>
                <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', array( 'show_date' => $show_date, 'blog_type' => $blog_type ) ) ?>
            <?php else: ?>
                <?php $args = array(
                    'post_format'    => $post_format,
                    'image_size'     => $image_size,
                    'show_date'      => $show_date,
                    'title'          => $title,
                    'link'           => $link,
                    'show_read_more' => $show_read_more,
                    'blog_type'      => $blog_type
                ); ?>
                <?php
                    if( $post_format != 'standard' ){
                        yit_get_template( 'blog/post-formats/' . $post_format . '.php', $args );
                    }
                ?>
            <?php endif; ?>


            <?php if( ! $is_quote ) : ?>
                <div class="yit_post_content clearfix">

                    <?php if( $show_title ) : ?>
                        <?php yit_string( "<h1 class='post-title'><a href='{$link}'>", $title, "</a></h1>" ); ?>
                    <?php endif; ?>

                    <?php the_content() ?>

                </div>
            <?php endif; ?>

                <?php if( $show_meta_box ) : ?>
                    <div class="yit_post_meta">

                         <?php if( $show_author ) : ?>
                            <span class="author <?php echo $author_icon_class ?>" <?php if( $author_icon_type == 'custom' ) echo yit_ssl_url( $author_icon )?>>
                                <?php if( $author_icon_type == 'icon' ) echo $author_icon ?>
                                <?php echo  __('by', 'yit') . ' ';  the_author_posts_link(); ?>
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

                        <?php if( $show_share ) : ?>
                            <span class="share <?php echo $share_icon_class ?>" <?php if( $share_icon_type == 'custom' ) echo yit_ssl_url( $share_icon )?>>
                                <?php if( $share_icon_type == 'icon' ) echo $share_icon ?>
                                <span class="share-text"><?php echo $share_text ?></span>
                                <div class="socials-container">
                                    <?php echo yit_get_social_share( 'text', 'arrow-right' ) ?>
                                </div>
                            </span>
                        <?php endif; ?>

                    </div>

            <?php endif; ?>

        </div>
    </div>

</div>
<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */