<div class="mkd-cards-gallery-holder">
    <div class="mkd-cards-gallery">
        <?php foreach($images as $image) { ?>
            <div class="card" <?php hue_mikado_inline_style($background_color); ?>>
                <?php if($image['image_link'] !== ''){ ?>
                <a href="<?php echo esc_url($image['image_link']) ?>" target="<?php echo esc_attr($image['image_target']) ?>">
                    <?php } ?>
                    <img src="#" alt="" data-image="<?php echo esc_url($image['url']);?>" <?php hue_mikado_inline_style(array('width:'.$image['width'].'px','height:1px')); ?> data-ratio="<?php echo esc_attr($image['height']/$image['width']); ?>" data-lazy="true">
                <?php if($image['image_link'] !== ''){ ?>
                </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="fake_card">
        <img src="<?php echo esc_url(end($images)['url']);?>" alt="">
    </div>
</div>