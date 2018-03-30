<?php
$size = 'property-detail-slider-image-two';
$properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size='.$size, $post->ID );
if( !empty($properties_images) ){
    ?>
    <div id="property-slider-two-wrapper" class="clearfix">
        <div id="property-slider-two" class="flexslider loading">
            <ul class="slides">
                <?php
                foreach( $properties_images as $prop_image_id=>$prop_image_meta ){
                    echo '<li>';
                    echo '<a href="'.$prop_image_meta['full_url'].'" class="'.get_lightbox_plugin_class() .'" '.generate_gallery_attribute().'>';
                    echo '<img src="'.$prop_image_meta['url'].'" alt="'.$prop_image_meta['title'].'" />';
                    echo '</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
        <div id="property-carousel-two" class="flexslider">
            <ul class="slides">
                <?php
                foreach( $properties_images as $prop_image_id=>$prop_image_meta ){
                    $slider_thumb = wp_get_attachment_image_src($prop_image_id,'property-thumb-image');
                    echo '<li>';
                    echo '<img src="'.$slider_thumb[0].'" alt="'.$prop_image_meta['title'].'" />';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <?php
    if(has_post_thumbnail()){
        ?>
        <div id="property-featured-image" class="clearfix only-for-print">
            <?php
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_url($image_id);
            echo '<a href="'.$image_url.'" class="'.get_lightbox_plugin_class() .'" '.generate_gallery_attribute().'>';
            echo '<img src="'.$image_url.'" alt="'.get_the_title().'" />';
            echo '</a>';
            ?>
        </div>
        <?php
    }
}elseif(has_post_thumbnail()){
    ?>
    <div id="property-featured-image" class="clearfix">
        <?php
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_url($image_id);
            echo '<a href="'.$image_url.'" class="'.get_lightbox_plugin_class() .'" '.generate_gallery_attribute().'>';
            echo '<img src="'.$image_url.'" alt="'.get_the_title().'" />';
            echo '</a>';
        ?>
    </div>
    <?php
}
?>