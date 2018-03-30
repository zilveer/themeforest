<?php
/**
 * Video Box shortcode template
 */
?>
<div class="mkd-video-box">
    <a class="mkd-video-image" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto">
        <?php echo wp_get_attachment_image($video_image,'full'); ?>
        <span class="mkd-video-box-button-holder <?php echo esc_attr($title_holder_classes); ?>">
            <span class="mkd-video-box-button">
            	<span class="mkd-video-box-button-arrow"></span>
        	</span>
        </span>
    </a>
    <?php if ($text !== ''){ ?>
        <div class="mkd-video-box-text">
            <span class="mkd-video-box-title"><?php echo wp_kses_post($title); ?></span>
            <p><?php echo esc_html($text); ?></p>
        </div>
    <?php } ?>
</div>