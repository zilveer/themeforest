<?php
/**
 * Use for Visual Composer properties grids module
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/01/16
 * Time: 2:21 PM
 */
global $post, $prop_images;

$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'houzez-image570_340', false);
$thumb_url = $thumb_url_array[0];
$prop_images        = get_post_meta( $post->ID, 'fave_property_images', false );
?>
<div class="figure-grid item-thumb" <?php if( !empty($thumb_url) ) { echo 'style="background-image: url('.esc_url( $thumb_url ).');"'; } ?>>

    <?php get_template_part( 'template-parts/featured-property' ); ?>

    <a href="<?php the_permalink(); ?>" class="hover-effect"></a>
    <?php get_template_part( 'template-parts/share', 'favourite' ); ?>
    <div class="detail">
        <div class="fig-title clearfix">
            <h3 class="pull-left"><?php the_title(); ?></h3>

        </div>

        <ul class="list-inline">
            <li class="cap-price"><?php echo houzez_listing_price(); ?></li>
            <?php houzez_listing_meta_v2(); ?>
        </ul>
    </div>
</div>
