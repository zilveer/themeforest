<div class="mkd-device-slider-holder">
    <img alt="" src="<?php echo MIKADO_ASSETS_ROOT; ?>/img/laptop.png" class="mkd-frame-image">
    <div class="mkd-device-images-holder">
        <div class="owl-carousel">
            <?php foreach($images as $image) { ?>
                <div>
                    <?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
                </div>
            <?php } ?>

        </div>
    </div>
</div>