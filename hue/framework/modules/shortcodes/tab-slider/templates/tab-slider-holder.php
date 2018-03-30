<div class="mkd-tab-slider-holder">
    <div class="mkd-tab-slider-nav">
        <?php
        preg_match_all('/\[mkd_tab_slider([^\]]*)\]/', $content, $matches, PREG_OFFSET_CAPTURE);

        foreach($matches[0] as $match) :
            preg_match('/slide_title="([^\"]+)/i', $match[0], $slide_title_match, PREG_OFFSET_CAPTURE);
        ?>
            <div class="mkd-tab-slider-nav-item">
                <?php if(is_array($slide_title_match) && count($slide_title_match)) : ?>
                    <h6 class="mkd-tab-slider-nav-title"><?php echo esc_html($slide_title_match[1][0]); ?></h6>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="mkd-tab-slider-container">
        <ul class="mkd-tab-slider-container-inner">
            <?php echo do_shortcode($content); ?>
        </ul>
    </div>
</div>