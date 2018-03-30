<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


?>


<!-- Animation Blocks -->
<div data-animation="idy_animation_blocks" data-bottom="@class:noactive" data-center="@class:active">

    <!-- Animation Image -->
  	<div class="idy_image_bottom">
        <div class="idy_heart idy_heart_small">
           <i class="ti ti-heart"></i>
        </div>
        <div class="idy_image_bottom_img idy_image_bck" data-image="<?php echo esc_attr($atts['image']['url']); ?>"></div>
    </div>
    <!-- Animation Image End -->
</div>
<!-- Animation Blocks End -->


