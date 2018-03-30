<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 5:02 PM
 * Since v1.4.0
 */
$size = 'houzez-property-thumb-image-v2';
$properties_images = rwmb_meta( 'fave_property_images', 'type=plupload_image&size='.$size, $post->ID );

if( !empty($properties_images) ) {
?>
<div class="detail-gallery detail-block houzez-gallery-prop-v2 clearfix">


    <?php foreach( $properties_images as $prop_image_id => $prop_image_meta ) {
            $full_image = houzez_get_image_by_id( $prop_image_id, 'full' );
        ?>
        <div class="col-sm-3">
            <figure class="item-thumb">
                <a href="<?php echo esc_url( $full_image[0] ); ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]" class="hover-effect">
                    <img src="<?php echo esc_url( $prop_image_meta['url'] ); ?>" width="<?php echo esc_attr( $prop_image_meta['width'] ); ?>" height="<?php echo esc_attr( $prop_image_meta['height'] ); ?>" alt="<?php echo esc_attr( $prop_image_meta['title'] ); ?>">
                </a>
            </figure>
        </div>

    <?php } ?>

</div>
<?php } ?>