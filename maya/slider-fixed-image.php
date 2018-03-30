<?php 
/**
 * @package WordPress
 * @since 1.0
 */
 ?>

		<!-- START SLIDER -->
        <div id="slider" class="group inner mobile fixed-image">
            <?php if( yiw_get_option( 'slider_fixed_image_url' ) ) : ?>
            <a href="<?php echo yiw_get_option( 'slider_fixed_image_url' ) ?>" <?php if( yiw_get_option( 'slider_fixed_image_target' ) ) : ?>target="_blank"<?php endif ?>>
            <?php endif ?>
                <img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
            <?php if( yiw_get_option( 'slider_fixed_image_url' ) ) : ?>
            </a>
            <?php endif ?>
		</div>
        <!-- END SLIDER --> 