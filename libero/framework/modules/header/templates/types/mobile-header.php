<?php do_action('libero_mikado_before_mobile_header'); ?>

<header class="mkd-mobile-header">
    <div class="mkd-mobile-header-inner">
        <?php do_action( 'libero_mikado_after_mobile_header_html_open' ) ?>
        <div class="mkd-mobile-header-holder">
            <div class="mkd-vertical-align-containers">
                <div class="mkd-position-left">
                    <div class="mkd-position-left-inner">
                        <?php if($show_logo) : ?>
                        <?php libero_mikado_get_mobile_logo(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mkd-position-right">
                    <div class="mkd-position-right-inner">
                        <?php if(is_active_sidebar('mkd-right-from-mobile-logo')) {
                            dynamic_sidebar('mkd-right-from-mobile-logo');
                        } ?>
                        <?php if($show_navigation_opener) : ?>
                            <div class="mkd-mobile-menu-opener">
                                <a href="javascript:void(0)">
                                <span class="mkd-mobile-opener-icon-holder">
                                    <span class="mkd-lines-holder">
                                        <span class="mkd-lines-holder-inner">
                                            <span class="mkd-lines line-1"></span>
                                            <span class="mkd-lines line-2"></span>
                                            <span class="mkd-lines line-3"></span>
                                            <span class="mkd-lines line-4"></span>
                                            <span class="mkd-lines line-5"></span>
                                        </span>
                                    </span>
                                </span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div> <!-- close .mkd-vertical-align-containers -->
        </div>
        <?php libero_mikado_get_mobile_nav(); ?>
    </div>
</header> <!-- close .mkd-mobile-header -->

<?php do_action('libero_mikado_after_mobile_header'); ?>