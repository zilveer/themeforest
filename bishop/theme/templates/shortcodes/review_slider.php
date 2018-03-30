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
 * Template file for show a review of the user
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

$id = ( isset($id) ) ? (int) $id : 0;
$show_avatar = ( isset( $show_avatar ) && $show_avatar == 'yes' ) ? 'yes' : 'no';
$show_rating = ( isset( $show_rating ) && $show_rating == 'yes' ) ? 'yes' : 'no';
$items = ( isset( $items ) ) ? $items : 10;

//fix old version that have -1 to select all, instead the query wants blank value to grab all product
$items = ( isset( $items ) && $items=='-1' ) ? '' : $items;

$args = array(
    'status'              => 'approve',
    'post_status'         => 'publish',
    'post_type'           => 'product',
    'order'               => 'DESC',
    'number'              => $items,
    'ignore_sticky_posts' => 1
);

if( $id != 0 ) {
    $args['post_id'] = $id;
}

$reviews = get_comments( $args );

?>
<div class="sc-review">
    <?php if ( ! empty( $title ) ) {
        yit_plugin_string( '<h3 class="title">', yit_plugin_decode_title( $title ), '</h3>' );
    }

    if ( ! empty( $description ) ) {
        yit_plugin_string( '<p class="desc">', $description, '</p>' );
    }

    ?>
</div>
<div class="comment_container comment-flexslider <?php echo esc_attr( $vc_css );?>" data-timeout="<?php echo isset( $timeout ) ? $timeout : 3000; ?>" data-speed="<?php echo isset( $speed ) ? $speed : 400; ?>">

    <ul class="clearfix slides">
        <?php foreach ( $reviews as $review ) : ?>
            <li>

                <?php if ( $show_avatar == 'yes' ) :
                    echo get_avatar( $review->comment_author_email, $size = '70' );
                endif ?>


                <div class="comment-text woocommerce <?php if ( $show_avatar == 'no' ) : ?>no-avatar<?php endif ?>">

                    <p itemprop="description" class="description"><?php echo $review->comment_content ?></p>

                    <p class="meta">
                        <?php if ( $show_rating == 'yes' ) :
                            $rating = esc_attr( get_comment_meta( $review->comment_ID, 'rating', true ) ) ?>
                            <span class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'yit' ), $rating ) ?>">
                                <span style="width:<?php echo ( intval( get_comment_meta( $review->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $review->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', 'yit' ); ?></span>
                            </span>
                        <?php endif; ?>
                        <span itemprop="author"><?php echo $review->comment_author; _e( ' on ', 'yit' ) ?>
                            <a href="<?php echo get_permalink( $review->ID ) ?>"><?php echo $review->post_title; ?></a></span>
                    </p>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

