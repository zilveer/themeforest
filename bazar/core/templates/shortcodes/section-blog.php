<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$args = array(
    'post_type' => 'post',
    'posts_per_page' => $items,
);

if( isset( $category ) && !empty( $category ) ) {
    $args['category_name'] = $category;
}

$size_thumbnail = yit_get_sidebar_layout() != 'sidebar-no' ? 'section_blog_sidebar' : 'section_blog';
$sidebar_layout = yit_get_sidebar_layout(); // All'interno del while e fino a prima del wp_reset_query() risulta errato
$postsPerRow = ($sidebar_layout != 'sidebar-no' ? '3' : '4');
$sb_span_class_max = "span" . ($sidebar_layout != 'sidebar-no' ? '9' : '12');
$sb_span_class = "span" . ($sidebar_layout != 'sidebar-no' ? '3' : '3');
$blog = new WP_Query( $args );
if( $blog->have_posts() ) :
    global $wp_query, $post, $more;
    ?>
        <div class="row">
        <div class="section blog"><!-- SECTION BLOG WRAPPER -->
        <?php
        if( !empty( $title ) ) { yit_string( '<h3 class="title '. $sb_span_class_max .'">', $title, '</h3>' ); }
        if( !empty( $description ) ) { yit_string( '<p class="description '. $sb_span_class_max .'">', $description, '</p>' ); }

        $i = $sticked = $already_tsicked = 0; // si potrebbe usare $already_tsicked al posto di $i
        ?>
        <?php
        $i = 0; $y=0;
        while( $blog->have_posts() ) : $blog->the_post();
                $more = 0;

                /** Sticky Post **/
                if( $i == 0 && is_sticky() && ( $show_featured == 'yes' || $show_featured == '1' ) ) :
                    $sticked = 1;

                    $sb_post_classes_sticky = implode(" ", get_post_class( 'hentry-post sticky' )) . " " .$sb_span_class_max;
                    ?>
                    <div class="<?php  echo $sb_post_classes_sticky;?>"><!-- STICKY POST DIV -->
                            <div class="thumbnail"><!-- THUMBNAIL DIV -->
                                <div class="row">
                                    <div class="span<?php echo ( ( $sidebar_layout != 'sidebar-no' ) ? 4 : 6 ) ?>">
                                        <div class="image-wrap"><!-- IMAGE-WRAP DIV -->
                                            <?php
                                            echo ( has_post_thumbnail() )  ? yit_image( "size=$size_thumbnail", false ) : '<img src="' . YIT_CORE_ASSETS_URL . '/images/no-featured.jpg" title="' . __( '(this post does not have a featured image)', 'yit' ) . '" alt="" />'; ?>
                                        </div><!-- END IMAGE-WRAP DIV-->
                                        <?php if( ( $show_title == '1' || $show_title == 'yes' ) || ( $show_date == '1' || $show_date == 'yes' ) || ( $show_comments == '1' || $show_comments == 'yes' ) ) : ?>
                                            <div class="meta group"><!-- META DIV-->
                                                <?php if( $show_title == '1' || $show_title == 'yes' ) { the_title( '<h4><a href="' . get_permalink() . '" title="' . get_the_title() . '">', '</a></h4>' ); } ?>
                                                <?php if( $show_date == '1' || $show_date == 'yes' ) : ?><p class="date"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/clock.png" title="<?php _e( 'Date', 'yit' ) ?>" alt="<?php _e( 'Date', 'yit' ) ?>" /><?php echo get_the_date( get_option( 'date_format', 'F j, Y' ) ) ?></p><?php endif ?>
                                                <?php if( $show_comments == '1' || $show_comments == 'yes' ) : ?><p class="comments"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/comments-small.png" title="<?php _e( 'Comments', 'yit' ) ?>" alt="<?php _e( 'Comments', 'yit' ) ?>" /><span><?php comments_popup_link( __( 'No comments', 'yit' ), __( '1 comment', 'yit' ), __( '% comments', 'yit' ) ); ?></span></p><?php endif ?>
                                            </div><!-- END META DIV-->
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div><!-- THUMBNAIL DIV-->

                            <div class="the-content"><!-- THE-CONTENT DIV -->
                                <?php
                                global $more;
                                $more = 0;

                                if( $show_excerpt == '1' || $show_excerpt == 'yes' ) {
                                    if( $show_readmore == '1' || $show_readmore  == 'yes' )
                                        { the_content( $readmore_text ); }
                                    else
                                        { echo yit_content( 'content', $excerpt_length ); }
                                }
                                ?>
                            </div><!-- THUMBNAIL DIV-->

                    </div><!-- END STICKY POST DIV -->
                    <?php
                    $i++;
                    continue;
                endif;
                /** End Sticky Post **/

                if( $i == 1 && $sticked ) {
                    yit_string( '<div class="' . $sb_span_class_max .'"><h4 class="other-articles">', $other_posts_label , '</h4></div>' );
                }
                if( ($i == 0 && !$sticked) || ($i == 1 && $sticked) ) {
                    echo "<div class=\"blog-row\">";
                }
                ?>
                <?php
                if( $i != 0 || !$sticked ) : ?>
                    <div class="<?php echo $sb_span_class;  echo ( ($y % $postsPerRow == 0) ? " post_first" : ""); ?>">
                    <?php
                        if( $i == 0 )
                            { echo '<div id="section-blog-not-sticky">'; }  //Sembra superfluo
                    ?>
                        <div <?php  post_class( 'hentry-post' ) ?>><!-- POST DIV -->
                            <div class="meta group">
                                <?php if( $show_title == '1' || $show_title == 'yes' ) { the_title( '<h4><a href="' . get_permalink() . '" title="' . get_the_title() . '">', '</a></h4>' ); } ?>
                                <?php if( $show_date == '1' || $show_date == 'yes' ) : ?><p class="date"><?php echo get_the_date( get_option( 'date_format', 'F j, Y' ) ) ?></p><?php endif ?>
                                <?php if( $show_comments == '1' || $show_comments == 'yes' ) : ?><p class="comments"><span><?php comments_popup_link( __( 'No comments', 'yit' ), __( '1 comment', 'yit' ), __( '% comments', 'yit' ) ); ?></span></p><?php endif ?>
                            </div>
                        </div><!-- END POST DIV -->
                    <?php
                        if( $i == 0 )
                            { echo '</div>'; }
                    endif;

                    $i++;
                    $y++;
                ?>
            </div>

        <?php endwhile ?>
        </div><!-- end blog-row -->
        </div><!-- SECTION BLOG WRAPPER -->
        </div><!-- end blog row -->

    <?php
endif;
wp_reset_query();?>