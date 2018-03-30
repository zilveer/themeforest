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

yit_enqueue_script( 'yit-testimonial', YIT_Testimonial()->plugin_assets_url . '/js/yit-testimonial-frontend.min.js', array( 'jquery' ), null, true );
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

if ( ! $tests->have_posts() ) {
    return false;
}


?>
<?php
$i = 0;
$row = 2;
while ( $tests->have_posts() ) : $tests->the_post();
    if ( $i == 0 || $i % $row == 0 ) {
        echo '<div class="row-fluid">';
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

    $title              = the_title( '<p class="name">', '</p>', false );
    $label              = yit_get_post_meta( get_the_ID(), '_yit_testimonial_social' );
    $siteurl            = yit_get_post_meta( get_the_ID(), '_yit_testimonial_website' );
    $small_quote        = yit_get_post_meta( get_the_ID(), '_yit_testimonial_small_quote' );
    $website            = '';
    $has_post_thumbnail = has_post_thumbnail();


    if ( $siteurl != '' ):
        if ( $label != '' ):
            $website = '<span class="testimonialwebsite">' . $title . ' - ' . '<a  href="' . esc_url( $siteurl ) . '">' . $label . '</a> </span>';
        else:
            $website = '<span class="testimonialwebsite">' . $title . ' - ' . '<a  href="' . esc_url( $siteurl ) . '">' . $siteurl . '</a> </span>';
        endif;
    elseif ( $label != '' ):
        $website = '<span class="testimonialwebsite">' . $title . '</span>';
    else :
        $website = '<span class="testimonialwebsite">' . $title . '</span>';
    endif;
    ?>
    <div class="testimonial">
        <div class="row">
            <?php if ( $small_quote != '' ): ?>
                <h4><?php echo $small_quote ?></h4>
            <?php endif ?>
            <div class="span7 testimonial-cit">
                <div class="testimonial-text"><?php echo wpautop( $text ); ?></div>
            </div>

            <?php  // Control if the thumbnail exists
            if ( $thumbnail == 'yes' && $has_post_thumbnail ) :  ?>
                <!-- We have the thumbnail in the span2 -->
                <div class="span5 thumb">
                    <div class="thumbnail">
                        <?php echo get_the_post_thumbnail( null, 'thumb-testimonial' ); ?>
                    </div>
                </div>
            <?php endif ?>

            <div class="clearfix"></div>
        </div>

        <!-- testimonial's name -->
        <div class="testimonial-name <?php if ( $thumbnail == 'no' || ! $has_post_thumbnail ) : ?>nothumb<?php endif ?>">
            <?php echo "<div class='text'>" . $website . "</div>"; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php $i ++;
    if ( $i % $row == 0 ) {
        echo '</div>';
    } ?>
<?php endwhile; ?>

<?php if ( $i % $row != 0 ) {
    echo '</div>';
} ?>

<?php wp_reset_query() ?>