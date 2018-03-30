<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Services shortcode template
 *
 * @package Yithemes
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly
$num_of_services = ( $items != 'null' ) ? count( explode( ',', $items ) ) : - 1;

$args = array(
    'post_type'      => YIT_Services()->service_post_type,
    'posts_per_page' => $num_of_services,
    'post__in'       => ( $items != 'null' ) ? explode( ',', $items ) : ''
);

$services = new WP_Query( $args );

if ( $items_per_row == 2 || $items_per_row == 3 || $items_per_row == 4 || $items_per_row == 6 ) {

    $items_span = 12 / $items_per_row;
}
else {
    $items_span = 3;
}

$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

if ( $services->have_posts() ) :
    global $wp_query, $post, $more;
    ?>
    <div class="section services margin-bottom section-services-bandw <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?> >
        <?php
        if ( ! empty( $title ) ) {
            if ( ! empty( $services_icon_title ) ) {
                ?>
                <img src="<?php echo $services_icon_title ?>">
            <?php
            }
            yit_string( '<h4 class="title">', yit_plugin_decode_title( $title ), '</h4>' );
        } ?>
        <?php
        if ( ! empty( $description ) ) {
            yit_plugin_string( '<p class="description">', $description, '</p>' );
        }
        ?>
        <div class="services-row row group">
            <?php while ( $services->have_posts() ) : $services->the_post() ?>

                <div class="col-sm-<?php echo $items_span; ?> service-wrapper col-xs-6">
                    <div class="service group">
                        <div class="image-wrapper <?php echo ( $show_border == 'yes' ) ? 'border' : ''; ?> ">
                            <?php
                            if ( has_post_thumbnail() ) {
                                $image_attr = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
                                <img src="<?php echo $image_attr[0] ?>" width="<?php echo $image_attr[1] ?>" height="<?php echo $image_attr[2] ?>" alt="<?php the_title_attribute() ?>" />
                            </a>
                            <?php
                            }
                            else {
                                ?>
                                <a href="<?php the_permalink() ?>"><img src='<?php echo YIT_Services()->plugin_assets_url ?>/images/no-featured.jpg' title="<?php _e( '(this post does not have a featured image)', 'yit' ) ?>" alt="no featured images" /></a>
                            <?php
                            }

                            ?>
                        </div>
                        <?php if ( $show_title == 'yes' ): ?>
                            <h3><?php echo yit_plugin_decode_title( get_the_title() ); ?></h3><?php endif ?>
                        <?php
                        if ( $show_excerpt == 'yes' ):
                            echo yit_plugin_content( 'content', $excerpt_length );
                            if ( $show_services_button == "yes" ) :
                                ?>
                                <div class="read-more">
                                    <a class="red-button" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo $services_button_text ?></a>
                                </div>
                            <?php
                            endif;
                        endif;
                        ?>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
        <!-- end row -->
    </div>
<?php endif;
wp_reset_query();