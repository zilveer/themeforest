<div class="mkd-expanding-images-holder">
    <div class="mkd-expanding-images" <?php hue_mikado_inline_style($holder_width) ?>>
        <?php foreach($images as $image) { ?>
            <div class="image">
                <div class="image-inner">
                    <div class="image-inner2">
                        <div class="image-inner3">
                            <?php if($image['image_link'] !== ''){ ?>
                            <a href="<?php echo esc_url($image['image_link']) ?>" target="<?php echo esc_attr($image['image_target']) ?>">
                                <?php } ?>
                                <img src="<?php echo esc_url($image['url']);?>" alt="">
                            <?php if($image['image_link'] !== ''){ ?>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>