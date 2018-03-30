<?php

/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


yit_enqueue_script( 'yit-testimonial', YIT_Testimonial()->plugin_assets_url . '/js/yit-testimonial-frontend.js', array( 'jquery' ), null, true );
yit_enqueue_script( 'owl-carousel', YIT_Testimonial()->plugin_assets_url . '/js/owl.carousel.min.js', array( 'jquery' ) );


wp_reset_query();

$args = array(
    'post_type' => 'testimonial'
);

$args['posts_per_page'] = ( isset( $items ) && $items != '' ) ? $items : - 1;

if ( isset( $cat ) && ! empty( $cat ) ) {
    $cat               = array_map( 'trim', explode( ',', $cat ) );
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category-testimonial',
            'field'    => 'id',
            'terms'    => $cat
        )
    );
}

$options = get_option( 'yit_testimonial_options' );
$text_type = YIT_Testimonial()->get_option( 'text-type-testimonials' );
$limit_words = YIT_Testimonial()->get_option( 'limit-words-testimonials' );
$limit = ( $limit_words != '' ) ? $limit_words : 50;
$thumbnail = ( YIT_Testimonial()->get_option( 'thumbnail-testimonials' ) == '' ) ? 'yes' : YIT_Testimonial()->get_option( 'thumbnail-testimonials' );

$tests = new WP_Query( $args );
$found_posts = $tests->found_posts;

if ( ! $tests->have_posts() ) {
    return false;
}

?>
<?php
$i = 0;
$row = 4;
if ( $style == 'comic' ) {
    $row = 3;
}

while ( $tests->have_posts() ) : $tests->the_post();
    if ( $i == 0 || $i % $row == 0 ) {
        echo '<div class="row">';
    }

    if ( $text_type == 'excerpt' ) {
        $length = create_function( '', "return $limit;" );
        add_filter( 'excerpt_length', $length );
        $text = get_the_excerpt();
        remove_filter( 'excerpt_length', $length );
    }
    else {
        $text = get_the_content();
    }

    $title       = the_title( '<p class="name">', '</p>', false );
    $label       = yit_get_post_meta( get_the_ID(), '_yit_testimonial_social' );
    $siteurl     = yit_get_post_meta( get_the_ID(), '_yit_testimonial_website' );
    $small_quote = yit_get_post_meta( get_the_ID(), '_yit_testimonial_small_quote' );
    $website     = '';
    $rating      = yit_get_post_meta( get_the_ID(), '_yit_testimonial_rating' );

    if ( $siteurl != '' ):
        if ( $label != '' ):
            $website = '<p class="website"><a  href="' . esc_url( $siteurl ) . '">' . $label . '</a></p>';
        else:
            $website = '<p class="website"><a  href="' . esc_url( $siteurl ) . '">' . $siteurl . '</a></p>';
        endif;
    elseif ( $label != '' ) :
        $website = '<p class="website">' . $label . '</p>';
    endif;

    switch ( $style ):
        case 'comic':

            ?>
            <div class="col-sm-4 testimonial-item-comic">
                <div id="testimonial" class="testimonial-comic">
                    <div class="testimonial-box arrow-down">
                        <?php if ( $small_quote != '' ): ?>
                            <blockquote><?php echo $small_quote ?></blockquote>
                        <?php endif ?>
                        <div class="testimonial-text"><?php echo wpautop( $text ); ?></div>
                    </div>
                    <div class="testimonial-meta clearfix">

                        <?php // Control if the thumbnail exists
                        if ( $thumbnail == 'yes' && get_the_post_thumbnail( null, 'thumb-testimonial' ) ):  ?>
                            <div class="thumbnail-comic">
                                <?php echo get_the_post_thumbnail( null, 'thumb-testimonial' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="testimonial-info <?php if ( $thumbnail == 'no' || ! get_the_post_thumbnail( null, 'thumb-testimonial' ) )  : ?>nothumb<?php endif ?>">

                            <div class="testimonial-name"><?php echo $title ?></div>

                            <?php if ( $website != '' ) : ?>
                                <div class="testimonial-site"><?php echo $website; ?></div>
                            <?php endif; ?>

                            <?php if( $rating!=0 ): ?>
                                <div class="testimonial-rating">
                                    <span class="star-empty"><span class="star" style="width: <?php echo $rating*20 ?>%;"></span></span>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php $i ++;
            if ( $i % $row == 0 ) {
                echo '</div>';
            } ?>
            <?php
            break;
        case 'square':

                $min = min( $items, $found_posts );
                $cols = $min < 4 ? 12 / $min : 3;

            ?>

            <div class="col-sm-<?php echo $cols; ?> testimonial-item-square<?php echo ( $i % 2 == 0 ) ? ' testimonial-even' : ' testimonial-odd' ?>">
                <div id="testimonial" class="testimonial-square">
                    <figure>
                        <?php if ( $thumbnail == 'yes' && get_the_post_thumbnail( null, 'thumb-testimonial' ) ) : ?>
                            <?php echo get_the_post_thumbnail( null, 'thumb-testimonial' ); ?>
                        <?php endif ?>
                        <div class="testimonial-info <?php if ( $thumbnail == 'no' || ! get_the_post_thumbnail( null, 'thumb-testimonial' ) ) : ?>nothumb<?php endif ?>">
                            <div class="testimonial-name" ><?php echo $title ?></div>
                            <?php if ( $website != '' ) : ?>
                                <div class="testimonial-site"><?php echo $website; ?></div>
                            <?php endif; ?>
                        </div>
                    </figure>

                    <?php if ( isset( $small_quote ) && $small_quote != '' ) : ?>
                        <blockquote><?php echo $small_quote ?></blockquote>
                    <?php endif ?>
                    <div class="testimonial-text"><?php echo wpautop( $text ); ?></div>
                </div>
            </div>
            <?php $i ++;
            if ( $i % $row == 0 ) {
                echo '</div>';
            } ?>
            <?php
            break;
            ?>
        <?php endswitch ?>
<?php endwhile; ?>

<?php if ( $i % $row != 0 ) {
    echo '</div>';
} ?>

