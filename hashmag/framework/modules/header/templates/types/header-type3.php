<?php do_action('hashmag_mikado_before_page_header'); ?>

    <header class="mkdf-page-header">
        <div class="mkdf-logo-area">
            <div class="mkdf-grid">
                <div class="mkdf-vertical-align-containers <?php echo esc_attr($alignment); ?>">
                    <div class="mkdf-position-left">
                        <div class="mkdf-position-left-inner">
                            <?php if (!$hide_logo) {
                                hashmag_mikado_get_logo();
                            } ?>
                        </div>
                    </div>
                    <div class="mkdf-position-right">
                        <div class="mkdf-position-right-inner">
                            <?php if (is_active_sidebar('mkdf-right-from-logo') && $logo_position == 'left') : ?>
                                <?php dynamic_sidebar('mkdf-right-from-logo'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mkdf-menu-area">
            <div class="mkdf-grid">
                <div class="mkdf-vertical-align-containers">
                    <div class="mkdf-position-left">
                        <div class="mkdf-position-left-inner">
                            <?php hashmag_mikado_get_main_menu(); ?>
                        </div>
                    </div>
                    <div class="mkdf-position-right">
                        <div class="mkdf-position-right-inner">
                            <?php if (is_active_sidebar('mkdf-right-from-main-menu')) : ?>
                                <?php dynamic_sidebar('mkdf-right-from-main-menu'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($show_sticky) {
            hashmag_mikado_get_sticky_header('centered');
        } ?>
    </header>

<?php do_action('hashmag_mikado_after_page_header'); ?>