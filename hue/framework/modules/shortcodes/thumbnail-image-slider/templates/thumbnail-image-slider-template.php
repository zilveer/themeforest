<?php
/**
 * Thumbnail Image Slider shortcode template
 */
?>
<div class="mkd-thumbnail-image-slider">
    <div class="flexslider">
        <ul class="slides">
        <?php foreach ($images as $image) { ?>
            <li data-thumb="<?php echo esc_url($image['thumb'])?>">
                <img src="<?php echo esc_url($image['url']);?>" alt="mkd-slider-img">
            </li>
        <?php } ?>
        </ul>
    </div>
</div>
