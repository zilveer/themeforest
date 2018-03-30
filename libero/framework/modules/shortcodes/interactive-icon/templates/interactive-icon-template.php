<div class="mkd-interactive-icon <?php echo esc_attr($interactive_icon_classes) ?>">
    <div class="mkd-interactive-icon-inner">
        <div class="mkd-interactive-icon-initial-content">
            <div class="mkd-interactive-icon-image mkd-initial-content-item">
                <?php echo wp_get_attachment_image($icon,'full'); ?>
            </div>
            <div class="mkd-interactive-icon-title mkd-initial-content-item">
                 <h4 style="<?php echo esc_attr($typography_styles)?>" ><?php echo esc_html($title); ?></h4>
            </div>
        </div>
        <div class="mkd-interactive-icon-hover-content">
            <div style="<?php echo esc_attr($separator_styles)?>" class="mkd-interactive-icon-separator">
            </div>
            <?php if ($url != '') { ?>
                <a href="<?php echo esc_url($url); ?>" class="mkd-interactive-icon-link">
            <?php } ?>
                    <div class="mkd-interactive-icon-text">
                        <p style="<?php echo esc_attr($typography_styles)?>"><?php echo esc_html($text); ?></p>
                    </div>  
            <?php if ($url != '') { ?>    
                    <span style="<?php echo esc_attr($typography_styles)?>" class="mkd-interactive-icon-small icon-holder">
                        <span aria-hidden="true" class="arrow_carrot-right_alt2"></span>
                    </span>
                </a>
            <?php } ?>
        </div>
    </div>
</div>