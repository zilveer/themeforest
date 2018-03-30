<div class="mkdf-tabs clearfix <?php echo esc_attr($tabs_classes) ?>">
    <div class="mkdf-tabs-nav">
        <ul>
            <?php  foreach ($tabs_titles as $tab_title) {?>
                <li>
                    <a href="#tab-<?php echo sanitize_title($tab_title)?>"><?php echo esc_attr($tab_title)?></a>
                </li>
            <?php } ?>
        </ul>
        <div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div>
    </div>
    <?php echo do_shortcode($content) ?>
</div>