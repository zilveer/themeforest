<?php do_action('flow_elated_before_mobile_header'); ?>

<header class="eltd-mobile-header">
    <div class="eltd-mobile-header-inner">
        <?php do_action( 'flow_elated_after_mobile_header_html_open' ) ?>
        <div class="eltd-mobile-header-holder">
            <div class="eltd-grid">
                <div class="eltd-vertical-align-containers">
                    <?php if($show_navigation_opener) : ?>
                        <div class="eltd-mobile-menu-opener">
                            <a href="javascript:void(0)">
                    <span class="eltd-mobile-opener-icon-holder">
                        <?php print $menu_opener_icon; ?>
                    </span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($show_logo) : ?>
                        <div class="eltd-position-center">
                            <div class="eltd-position-center-inner">
                                <?php flow_elated_get_mobile_logo(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="eltd-position-right">
                        <div class="eltd-position-right-inner">
                            <?php if(is_active_sidebar('eltd-right-from-mobile-logo')) {
                                dynamic_sidebar('eltd-right-from-mobile-logo');
                            } ?>
                        </div>
                    </div>
                </div> <!-- close .eltd-vertical-align-containers -->
            </div>
        </div>
        <?php flow_elated_get_mobile_nav(); ?>
    </div>
</header> <!-- close .eltd-mobile-header -->

<?php do_action('flow_elated_after_mobile_header'); ?>