<?php do_action('hashmag_mikado_before_sticky_header'); ?>

    <div class="mkdf-sticky-header">
        <?php do_action('hashmag_mikado_after_sticky_menu_html_open'); ?>
        <div class="mkdf-sticky-holder">
            <div class="mkdf-grid">
                <div class=" mkdf-vertical-align-containers">
                    <div class="mkdf-position-left">
                        <div class="mkdf-position-left-inner">
                            <?php if (!$hide_logo) {
                                hashmag_mikado_get_logo('sticky');
                            } ?>
                        </div>
                    </div>
                    <div class="mkdf-position-center">
                        <div class="mkdf-position-center-inner">
                            <?php hashmag_mikado_get_sticky_main_menu('mkdf-sticky-nav'); ?>
                        </div>
                    </div>
                    <div class="mkdf-position-right">
                        <div class="mkdf-position-right-inner">
                            <?php if (is_active_sidebar('mkdf-sticky-right')) : ?>
                                <?php dynamic_sidebar('mkdf-sticky-right'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php do_action('hashmag_mikado_after_sticky_header'); ?>