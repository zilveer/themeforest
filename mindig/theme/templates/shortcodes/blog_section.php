<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $post;

$enable_thumbnails = ( $enable_thumbnails == 'yes' ) ? true : false;
$enable_title = ( $enable_title == 'yes' ) ? true : false;
$enable_date = ( $enable_date == 'yes' ) ? true : false;
$enable_author = ( $enable_author == 'yes' && get_the_author() != false ) ? true : false;
$enable_comments = ( $enable_comments == 'yes' ) ? true : false;

switch ( $ncolumns ) {
    case 1 :
        $class = 'col-sm-12';
        break;
    case 2 :
        $class = 'col-sm-6';
        break;
    case 3 :
    default :
        $class = 'col-sm-4';
        break;
}

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $nitems
);


$image_size = YIT_Registry::get_instance()->image->get_size( 'blog_section' );

$blog = new WP_Query( $args );

if ( $blog->have_posts() ) :

    ?>
    <div class="blog-section-wrapper row <?php echo esc_attr( $animate . ' ' . $vc_css ) ?>">
        <ul class="blog_posts">
            <?php while ( $blog->have_posts() ) : $blog->the_post() ?>
                <li class="blog_post_container <?php echo $class ?>">
                    <div class="clearfix blog_post">
                        <?php if ( $enable_date ) : ?>
                            <div class="yit_post_date">
                                <span class="day">
                                    <?php echo get_the_date( 'd' ) ?>
                                </span>
                                <span class="month">
                                    <?php echo get_the_date( 'M' ) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ( $enable_thumbnails && has_post_thumbnail() ) : ?>
                            <div class="yit_post_thumbnail">
                                <a class="title_link" href="<?php the_permalink() ?>">
                                    <?php yit_image( 'size=blog_section&class=img-responsive' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="yit_post_meta">
                                <?php if ( $enable_title ) : ?>
                                    <span class="title">
                                    <a class="title_link" href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                </span>
                                <?php endif; ?>
                                <span class="info">
                            <?php if ( $enable_author ) : ?>
                                        <?php echo __( 'posted by', 'yit' ) . ' ';
                                        the_author_posts_link();
                                        echo ' / '; ?>
                                    <?php endif; ?>
                                    <?php if ( $enable_comments ) : ?>
                                        <a href="<?php comments_link() ?>"><?php comments_number( '0 ' . __( 'Comment', 'yit' ), '1 ' . __( 'Comment', 'yit' ), '% ' . __( 'Comments', 'yit' ) ); ?></a>
                                    <?php endif; ?>
                                </span>
                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>

    </div>

<?php endif; ?>

<?php wp_reset_query(); ?>