<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for shows last post of a specific category
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

global $icons_name;

$sidebars  = yit_get_sidebars();
remove_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 ); //shortcode in more links

$args = array(
    'posts_per_page'      => $items,
    'orderby'             => 'date',
    'ignore_sticky_posts' => 1
);

if ( isset( $popular ) && $popular == 'yes' ) {
    $args['orderby'] = 'comment_count';
}

if ( isset( $cat_name ) && ! empty( $cat_name ) && $cat_name != 'null' && $cat_name != "a:0:{}" ) {
    $args['category_name'] = $cat_name;
}
$author_name = get_the_author_link();

$author      = ( isset( $author ) && ! empty( $author_name ) ) ? $author : 'no';
$show_tags  = ( isset( $show_tags ) && $show_tags == 'yes' );
$show_author  =  ( isset( $author ) && $author == 'yes' );
$show_categories  =  ( isset( $show_categories ) && $show_categories == 'yes' );
$show_comments  =  ( isset( $comments ) && $comments == 'yes' );
$post_meta_separator     = ' / ';


$args['order'] = 'DESC';

$myposts = new WP_Query( $args );

$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

$bootstrap_col_class     = '';


if( $sidebars['layout'] == 'sidebar-no' ){
    $bootstrap_col_class = 'col-sm-3 col-xs-6';
}elseif( $sidebars['layout'] == 'sidebar-double' ){
    $bootstrap_col_class = 'col-sm-6 col-xs-6';
}else{
    $bootstrap_col_class = 'col-sm-4 col-xs-6';
}

/* FROM TO */
$author_icon_options     = yit_get_option( 'blog-author-icon' );
$author_icon_type        = $author_icon_options['select'];
$author_icon             = ( $author_icon_type == 'none' ) ? false : ( ( $author_icon_type == 'icon' ) ? '<i class="fa fa-' . $author_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $author_icon_options['custom'] ) . ') top left no-repeat"' );
$author_icon_class       = ( $author_icon_type == 'none' ) ? 'without-icon' : ( ( $author_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );

$comments_icon_options   = yit_get_option( 'blog-comments-icon' );
$comments_icon_type      = $comments_icon_options['select'];
$comments_icon           = ( $comments_icon_type == 'none' ) ? false : ( ( $comments_icon_type == 'icon' ) ? '<i class="fa fa-' . $comments_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $comments_icon_options['custom'] ) . ') top left no-repeat"' );
$comments_icon_class     = ( $comments_icon_type == 'none' ) ? 'without-icon' : ( ( $comments_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );

$categories_icon_options = yit_get_option( 'blog-categories-icon' );
$categories_icon_type    = $categories_icon_options['select'];
$categories_icon         = ( $categories_icon_type == 'none' ) ? false : ( ( $categories_icon_type == 'icon' ) ? '<i class="fa fa-' . $categories_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $categories_icon_options['custom'] ) . ') top left no-repeat"' );
$categories_icon_class   = ( $categories_icon_type == 'none' ) ? 'without-icon' : ( ( $categories_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );

$tags_icon_options       = yit_get_option( 'blog-tags-icon' );
$tags_icon_type          = $tags_icon_options['select'];
$tags_icon               = ( $tags_icon_type == 'none' ) ? false : ( ( $tags_icon_type == 'icon' ) ? '<i class="fa fa-' . $tags_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $tags_icon_options['custom'] ) . ') top left no-repeat"' );
$tags_icon_class         = ( $tags_icon_type == 'none' ) ? 'without-icon' : ( ( $tags_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );

$read_more_text          = yit_get_option( 'blog-read-more-text' ) != '' ? yit_get_option( 'blog-read-more-text' ) : __( 'Read More', 'yit' );

echo '<div class="yit_shortcodes recent-post group ' . esc_attr( $animate . $vc_css ) . '" ' . $animate_data . '>' . '<div class="row">';

if ( $myposts->have_posts() ) : while ( $myposts->have_posts() ) : $myposts->the_post();
    $has_tags   = ( ! get_the_tags() ) ? false : true;    ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class( array( $bootstrap_col_class) ); ?>>
        <div class="meta clearfix blog small">
            <div class="small post-wrapper">
                <?php if( has_post_thumbnail() && $showthumb != 'no' ) :
                    $img ='';
                    $img = yit_image( "size=blog_small", false );
                    ?>
                    <div class="thumbnail small">
                        <a href="<?php the_permalink() ?>">
                            <?php echo $img; ?>
                            <div class="yit_post_format_icon"><?php echo ( ! get_post_format() ) ? 'standard' : get_post_format() ?></div>
                        </a>
                        <?php  if ( $date == "yes" ): ?>
                            <div class="yit_post_meta_date">
                                <span class="day"><?php the_time( 'd' ) ?></span>
                                <span class="month"><?php the_time( 'M' ) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="yit_post_content clearfix">
                    <h3 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <div class="yit_the_content">
                        <?php

                        if ( strpos( $readmore, "href='#'" ) ) {
                            $post_readmore = str_replace( "href='#'", "href='" . get_permalink() . "'", $readmore );
                        }
                        else {
                            $post_readmore = $readmore;
                        }

                        if( $excerpt != 'no'): ?>
                            <?php echo yit_plugin_content( 'excerpt', $excerpt_length, $post_readmore ) ?>
                        <?php endif   ?>

                    </div>
                </div>

                <div class="yit_post_meta">
                    <?php  if( $author == 'yes' ): ?>
                        <span class="author <?php echo $author_icon_class ?>">
                                <?php if( $author_icon_type == 'icon' ) echo $author_icon ?>
                            <?php echo __('by', 'yit') . ' ';  the_author_posts_link(); ?>
                    </span>
                    <?php endif ?>

                    <?php
                    if( $show_categories ) : ?>
                        <span class="categories <?php echo $categories_icon_class ?>">
                                <?php if( $show_author ) echo $post_meta_separator; ?>
                            <?php if( $categories_icon_type == 'icon' ) echo $categories_icon ?>
                            <?php echo __('Categories: ', 'yit') . ' ' ;  ?>
                            <?php the_category( ', ' ); ?>
                            </span>
                    <?php endif; ?>

                    <?php  if( $comments == 'yes' ): ?>
                        <span class="comments <?php echo $comments_icon_class ?>">
                                <?php if( $show_categories || $show_author ) echo $post_meta_separator ?>
                            <?php if( $comments_icon_type == 'icon' ) echo $comments_icon ?>
                            <a href="<?php comments_link() ?>"><?php comments_number( __( '0 Comment', 'yit' ), __( '1 Comment', 'yit' ), '% Comments'); ?></a>
                            </span>
                    <?php endif ?>


                    <?php if( $show_tags && $has_tags ) : ?>
                        <span class="tags <?php echo $tags_icon_class ?>">
                            <?php if( $show_categories || $show_author || $show_comments  && $has_tags ) echo $post_meta_separator ?>
                            <?php if( $tags_icon_type == 'icon' ) echo $tags_icon ?>
                            <?php the_tags( __('Tags: ', 'yit') , ', '); ?>
                        </span>
                        <?php yit_edit_post_link( __( 'Edit', 'yit' )  , '<span class="yit-edit-post"> / ', '</span>' ); ?>
                    <?php endif; ?>



                </div>

            </div>
        </div>
    </div>
<?php
endwhile; endif;

wp_reset_query();

echo '</div></div>';
