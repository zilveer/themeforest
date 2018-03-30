<?php
global $porto_settings, $porto_layout;
?>
<header id="header" class="header-separate header-9 <?php echo $porto_settings['search-size'] ?> sticky-menu-header<?php echo ($porto_settings['logo-overlay'] && $porto_settings['logo-overlay']['url']) ? ' logo-overlay-header' : '' ?>">
    <?php if ($porto_settings['show-header-top']) : ?>
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <?php
                    // show social links
                    echo porto_header_socials();

                    // show currency and view switcher
                    $currency_switcher = porto_currency_switcher();
                    $view_switcher = porto_view_switcher();

                    if ($currency_switcher || $view_switcher)
                        echo '<div class="switcher-wrap">';

                    echo $currency_switcher;

                    if ($currency_switcher && $view_switcher)
                        echo '<span class="gap switcher-gap">|</span>';

                    echo $view_switcher;

                    if ($currency_switcher || $view_switcher)
                        echo '</div>';
                    ?>
                </div>
                <div class="header-right">
                    <?php
                    // show welcome message and top navigation
                    $top_nav = porto_top_navigation();

                    if ($porto_settings['welcome-msg'])
                        echo '<span class="welcome-msg">' . do_shortcode($porto_settings['welcome-msg']) . '</span>';

                    if ($porto_settings['welcome-msg'] && $top_nav)
                        echo '<span class="gap">|</span>';

                    echo $top_nav;
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="header-main">
        <div class="container">
            <div class="header-left">
                <?php
                // show logo
                $logo = porto_logo();
                echo $logo;
                ?>
            </div>
            <div class="header-center">
                <?php
                // show search form
                echo porto_search_form();

                // show mobile toggle
                ?>
                <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>
            </div>
            <div class="header-right">
                <?php
                $minicart = porto_minicart();
                ?>
                <div class="<?php if ($minicart) echo 'header-minicart'.str_replace('minicart', '', $porto_settings['minicart-type']) ?>">
                    <?php
                    // show contact info and mini cart
                    $contact_info = $porto_settings['header-contact-info'];

                    if ($contact_info)
                        echo '<div class="header-contact">' . do_shortcode($contact_info) . '</div>';

                    // show mini cart
                    echo $minicart;
                    ?>
                </div>
    
                <?php
                get_template_part('header/header_tooltip');
                ?>

            </div>
        </div>
    </div>

    <?php
    $toggle_menu = porto_main_toggle_menu();
    if ($toggle_menu || $porto_settings['menu-block']) :
    ?>
    <div class="main-menu-wrap">
        <div id="main-menu" class="container">
            <div class="menu-center">
                <div class="row">
                    <div class="col-md-3 sidebar">
                        <?php
                        // show toggle menu
                        if ($toggle_menu) : ?>
                            <div id="main-toggle-menu" class="<?php echo (!$porto_settings['menu-toggle-onhome'] && is_front_page()) ? 'show-always' : 'closed' ?>">
                                <div class="menu-title closed">
                                    <div class="toggle"></div>
                                    <?php if ($porto_settings['menu-title']) : ?>
                                        <?php echo do_shortcode($porto_settings['menu-title']) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="toggle-menu-wrap">
                                    <?php echo $toggle_menu ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($porto_settings['menu-block']) : ?>
                    <div class="col-md-9">
                        <div class="menu-custom-block">
                            <?php echo do_shortcode($porto_settings['menu-block']) ?>
                            <?php
                            if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
                                if (is_user_logged_in()) {
                                    $logout_link = '';
                                    if ( class_exists( 'WooCommerce' ) ) {
                                        $logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
                                    } else {
                                        $logout_link = wp_logout_url( get_home_url() );
                                    }
                                    echo '<a class="'. (is_rtl() ? 'pull-left p-l-none' : 'pull-right p-r-none') . '" href="' . $logout_link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a>';
                                } else {
                                    $login_link = $register_link = '';
                                    if ( class_exists( 'WooCommerce' ) ) {
                                        $login_link = wc_get_page_permalink( 'myaccount' );
                                        if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                                            $register_link = wc_get_page_permalink( 'myaccount' );
                                        }
                                    } else {
                                        $login_link = wp_login_url( get_home_url() );
                                        $active_signup = get_site_option( 'registration', 'none' );
                                        $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                                        if ($active_signup != 'none')
                                            $register_link = wp_registration_url( get_home_url() );
                                    }
                                    if ($register_link && isset($porto_settings['menu-enable-register']) && $porto_settings['menu-enable-register']) {
                                        echo '<a class="'. (is_rtl() ? 'pull-left p-l-none' : 'pull-right p-r-none') . '" href="' . $register_link . '"><i class="fa fa-user-plus"></i>' . __('Register', 'porto') . '</a>';
                                    }
                                    echo '<a class="'. (is_rtl() ? 'pull-left p-l-none' : 'pull-right p-r-none') . '" href="' . $login_link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($porto_settings['show-sticky-searchform'] || $porto_settings['show-sticky-minicart']) : ?>
                <div class="menu-right">
                    <?php
                    // show search form
                    echo porto_search_form();

                    // show mini cart
                    echo porto_minicart();
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</header>