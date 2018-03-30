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


wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'yit-testimonial' );

wp_reset_query();

$args = array(
    'post_type' => 'testimonial'
);

$text_type = YIT_Testimonial()->get_option( 'text-type-testimonials' );

$args['posts_per_page'] = ( ! is_null( $items ) ) ? $items : - 1;

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

$tests = new WP_Query( $args );
$count_posts = wp_count_posts( 'testimonial' );
$text_type = YIT_Testimonial()->get_option( 'text-type-testimonials' );
$thumbnail = ( YIT_Testimonial()->get_option( 'thumbnail-testimonials' ) == '' ) ? 'yes' : YIT_Testimonial()->get_option( 'thumbnail-testimonials' );

if ( $count_posts->publish == 1 ) {
    $is_slider = false;
}
else {
    $is_slider = true;
}

$html = '';
if ( ! $tests->have_posts() ) {
    return $html;
}

$pagination = ( $pagination == 'yes') ? 'true' : 'false';
$navigation = ( $navigation == 'yes') ? 'true' : 'false';
$autoplay = ( $autoplay == 'yes') ? 'true' : 'false';
?>

<div class="testimonials-slider">
    <?php if ( $is_slider ): ?>
        <ul class="testimonial-content owl-slider hide-elem" data-slidespeed="<?php echo $speed ?>" data-pagination="<?php echo $pagination ?>" data-paginationspeed="<?php echo $paginationspeed ?>" data-navigation="<?php echo $navigation ?>" data-singleitem="true" data-autoplay="<?php echo $autoplay ?>" >
    <?php else: ?>
        <ul class="testimonial-content">
    <?php endif ?>
        <?php
        //loop
        $c = 0;
        while ( $tests->have_posts() ) : $tests->the_post();

            $length = create_function( '', "return $excerpt;" );
            add_filter( 'excerpt_length', $length );

            $title = the_title( '<span class="name">', '</span>', false );
            $text = (strcmp($text_type, 'content') == 0) ? get_the_content() : get_the_excerpt();
            remove_filter( 'excerpt_length', $length );

            $label   = yit_get_post_meta( get_the_ID(), '_yit_testimonial_social' );
            $siteurl = yit_get_post_meta( get_the_ID(), '_yit_testimonial_website' );


            $website = '';
            if ( $siteurl != '' ):
                if ( $label != '' ):
                    $website = '<a href="' . esc_url( $siteurl ) . '">' . $label . '</a>';
                else:
                    $website = '<a href="' . esc_url( $siteurl ) . '">' . $siteurl . '</a>';
                endif;
            endif;

            ?>

            <li class='item'>
                <?php  // Control if the thumbnail exists
                if ( $thumbnail && get_the_post_thumbnail( null, 'thumb-testimonial' ) ) :  ?>
                    <!-- We have the thumbnail in the span2 -->

                        <div class="thumbnail">
                            <?php echo get_the_post_thumbnail( null, 'thumb-testimonial' ); ?>
                        </div>

                <?php endif ?>

                <blockquote><p><?php echo $text ?></p></blockquote>
                <p class="meta"><?php echo $title; ?> <?php if ( $website != '' ) : ?> - <?php echo $website; endif; ?></p>
            </li>

            <?php $c ++; endwhile; ?>

    </ul>

</div>
<?php echo $html; ?>
