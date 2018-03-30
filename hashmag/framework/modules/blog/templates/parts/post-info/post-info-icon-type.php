<span class="mkdf-post-info-icon-holder">
	<span class="mkdf-post-info-icon-holder-table">
		<span class="mkdf-post-info-icon-holder-cell">
            <?php
            if ($params['post_type'] == 'mkdf-post-video') { ?>
                <a itemprop="image" class="mkdf-video-button-play" href="<?php echo esc_url($video_link); ?>"
                   data-rel="prettyPhoto">
                    <span class="mkdf-post-info-icon <?php echo esc_attr($params['post_type']) ?>"></span>
                </a>
            <?php } else { ?>

                <span class="mkdf-post-info-icon <?php echo esc_attr($params['post_type']) ?>"></span>

            <?php } ?>
		</span>
	</span>
</span>