<?php if ($show_header_top) : ?>

    <?php do_action('hashmag_mikado_before_header_top'); ?>

    <div class="mkdf-top-bar">
        <?php if ($top_bar_in_grid) : ?>
        <div class="mkdf-grid">
            <?php endif; ?>
            <?php do_action('hashmag_mikado_after_header_top_html_open'); ?>
            <div class="mkdf-vertical-align-containers mkdf-<?php echo esc_attr($column_widths); ?>">
                <div class="mkdf-position-left">
                    <div class="mkdf-position-left-inner">
                        <?php if (is_active_sidebar('mkdf-top-bar-left')) : ?>
                            <?php dynamic_sidebar('mkdf-top-bar-left'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mkdf-position-center">
                    <div class="mkdf-position-center-inner">
                        <?php if (is_active_sidebar('mkdf-top-bar-center')) : ?>
                            <?php dynamic_sidebar('mkdf-top-bar-center'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mkdf-position-right">
                    <div class="mkdf-position-right-inner">
                        <?php if (is_active_sidebar('mkdf-top-bar-right')) : ?>
                            <?php dynamic_sidebar('mkdf-top-bar-right'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ($top_bar_in_grid) : ?>
        </div>
    <?php endif; ?>
    </div>

    <?php do_action('hashmag_mikado_after_header_top'); ?>

<?php endif; ?>