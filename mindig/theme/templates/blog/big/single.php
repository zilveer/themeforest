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

            <?php if( $post_format == 'standard' ) : ?>
                <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', array( 'show_thumbnail' => $show_thumbnail, 'show_date' => $show_date, 'blog_type' => $blog_type ) ) ?>
            <?php else: ?>
                <?php $args = array(
                    'post_format'    => $post_format,
                    'image_size'     => $image_size,
                    'show_date'      => $show_date,
                    'show_title'     => $show_title,
                    'title'          => $title,
                    'link'           => $link,
                    'show_read_more' => $show_read_more,
                    'blog_type'      => $blog_type
                );

                if( $post_format != 'standard' ){
                    yit_get_template( 'blog/post-formats/' . $post_format . '.php', $args );
                }
                ?>
            <?php endif; ?>

            <div class="yit_post_content title clearfix">
                 <?php if( $show_date && $post_format != 'quote' ) : ?>
                    <div class="yit_post_meta_date">
                        <span class="day">
                            <?php echo get_the_date( 'd' ) ?>
                        </span>

                        <span class="month">
                            <?php echo get_the_date( 'M' ) ?>
                        </span>
                    </div>
                <?php endif; ?>
                <div class="title-meta-wrapper">
                    <?php if( $show_title && $post_format != 'quote' ) : ?>
                        <?php yit_string( "<h1 class='post-title'>", $title, "</h1>" ); ?>
                    <?php endif; ?>
                    <div class="yit_post_meta first_block">
                         <?php if( $show_author ) : ?>
                            <span class="author">
                                <?php echo  __('by', 'yit') . ' ';  the_author_posts_link(); ?>
                            </span>
                        <?php endif; ?>
                        <?php if( $show_comments ) : ?>
                            <span class="comments">
                                <?php if( $show_author ) echo $post_meta_separator; ?>
                                <a href="<?php comments_link() ?>"><?php comments_number( __( '0 Comment', 'yit' ), __( '1 Comment', 'yit' ), '% Comments'); ?></a>
                            </span>
                        <?php endif; ?>
                        <?php $edit_text = $show_author || $show_comments ? __( '/ Edit', 'yit' ) : __( 'Edit', 'yit' ); ?>
                        <?php yit_edit_post_link( $edit_text, '<span class="yit-edit-post">', '</span>' ); ?>
                    </div>
                </div>
            </div>
            <?php if( $post_format != 'quote' ) : ?>
                <div class="yit_the_content">
                    <?php the_content() ?>
                </div>
            <?php endif; ?>
            <?php if( $show_meta_box ) : ?>
                <div class="yit_post_meta last_block">
                     <div>
                         <?php if( $show_categories ) : ?>
                            <span class="categories">
                                <strong><?php echo __('Categories: ', 'yit') . ' ' ;  ?></strong>
                                <?php the_category( ', ' ); ?>
                            </span>
                        <?php endif; ?>

                        <?php if( $show_tags && $has_tags ) : ?>
                            <span class="tags">
                                <strong><?php echo __('Tags: ', 'yit') . ' ' ;  ?></strong>
                                <?php the_tags( '' , ', '); ?>
                            </span>
                        <?php endif; ?>
                     </div>
                    <?php if( $show_share ) : ?>
                        <div class="morph-button morph-button-inflow morph-button-inflow-2">
							<button type="button">
                                <span class="share <?php echo $share_icon_class ?>" <?php if( $share_icon_type == 'custom' ) echo yit_ssl_url( $share_icon )?>>
                                    <?php if( $share_icon_type == 'icon' ) echo $share_icon ?>
                                    <?php echo $share_text ?>
                                </span>
                            </button>
							<div class="morph-content">
                                <div>
                                    <?php yit_get_social_share( 'text', 'content-style-social', array( 'facebook', 'twitter', 'google') )?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>