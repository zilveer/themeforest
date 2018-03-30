<div class="mkd-process-item-holder">
    <div class="mkd-pi-holder-inner">
        <?php if(!empty($number)) : ?>
            <div class="mkd-number-holder-inner <?php echo esc_attr($number_gradient_style); ?>">
                <span><?php echo esc_html($number); ?></span>
                <div class="mkd-border"></div>
            </div>
        <?php endif; ?>

        <div class="mkd-pi-content-holder">
            <?php if(!empty($title)) : ?>
                <div class="mkd-pi-title-holder">
                    <h5 class="mkd-pi-title"><?php echo esc_html($title); ?></h5>
                </div>
            <?php endif; ?>

            <?php if(!empty($text)) : ?>
                <div class="mkd-pi-text-holder">
                    <p><?php echo esc_html($text); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>