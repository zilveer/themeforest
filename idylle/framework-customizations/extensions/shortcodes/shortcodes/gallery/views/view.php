<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
?>




<div class="row idy_gallery">
        
    <?php foreach ($atts['gallery'] as $gallery):



        if(empty ($gallery['video']) ){
            if ( empty( $gallery['image'] ) ) {
                $image = get_template_directory_uri().'/images/no_image.jpg';
            } else {
                $image = fw_resize( $gallery['image']['attachment_id'], '600', '500', true );
                $bimage = fw_resize( $gallery['image']['attachment_id'], '1200', '', true );
                $lightbox = "lightbox";
            }
        }else {
                $image = "http://img.youtube.com/vi/".$gallery['video']."/0.jpg";
                $bimage = "https://www.youtube.com/watch?v=".$gallery['video'];
                $lightbox = "video";

        }
    ?>

    <!-- Item -->
    <div class="idy_gallery_item">
        
        <a href="<?php echo esc_url( $bimage ); ?>" class="idy_gallery_item_link <?php echo esc_attr( $lightbox ); ?>" title="<?php echo esc_attr($gallery['title']); ?>">
            <img class="idy_gallery_item_photo idy_image_bck"  alt="<?php echo esc_attr($gallery['title']); ?>" src="<?php echo esc_attr($image); ?>">
        </a>

        <h4><?php echo esc_attr($gallery['title']); ?></h4>
    </div>

    <?php endforeach; ?>
    
</div>


