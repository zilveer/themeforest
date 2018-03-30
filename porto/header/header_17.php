<?php
global $porto_settings, $porto_layout;

$search_size = $porto_settings['search-size'];
?>
<header id="header" class="header-separate header-corporate header-17 <?php echo $search_size ?> sticky-menu-header<?php echo ($porto_settings['logo-overlay'] && $porto_settings['logo-overlay']['url']) ? ' logo-overlay-header' : '' ?>">
    <?php if ($porto_settings['show-header-top']) : ?>
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <?php
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

                    // show welcome message
                    if ($porto_settings['welcome-msg'])
                        echo '<span class="welcome-msg">' . do_shortcode($porto_settings['welcome-msg']) . '</span>';
                    ?>
                </div>
                <div class="header-right">
                    <?php
                    // show top navigation
                    $top_nav = porto_top_navigation();
                    echo $top_nav;
                    ?>
                    <?php
                    $header_social = porto_header_socials();
                    if ($header_social) {
                        echo '<div class="block-inline">';
                        // show social links
                        echo $header_social;
                        echo '</div>';
                    }
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
            <div class="header-right">
                <?php
                // show contact info and top navigation
                $contact_info = $porto_settings['header-contact-info'];

                if ($contact_info)
                    echo '<div class="header-contact">' . do_shortcode($contact_info) . '</div>';
                ?>
                <?php
                // show search form
                echo porto_search_form();

                // show mobile toggle
                ?>
                <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>
                <?php
                if ($porto_settings['show-header-top'] || $porto_settings['show-sticky-minicart']) {
                    // show minicart
                    $minicart = porto_minicart();

                    echo $minicart;
                }
                if (!$porto_settings['show-header-top']) {
                    $header_social = porto_header_socials();
                    if ($header_social) {
                        echo '<div class="block-inline">';
                        // show social links
                        echo $header_social;
                        echo '</div>';
                    }
                }
                ?>

                <?php
                get_template_part('header/header_tooltip');
                ?>

            </div>
        </div>
    </div>

    <?php
    // check main menu
    $main_menu = porto_main_menu();
    if ($main_menu) : ?>
        <div class="main-menu-wrap<?php echo ($porto_settings['menu-type']?' '.$porto_settings['menu-type']:'') ?>">
            <div id="main-menu" class="container <?php echo $porto_settings['menu-align'] ?><?php echo $porto_settings['show-sticky-menu-custom-content'] ? '' : ' hide-sticky-content' ?>">
                <div class="menu-center">
                    <?php
                    // show main menu
                    echo $main_menu;
                    ?>
                </div>
                <div class="menu-right">
                    <?php
                    // show search form
                    echo porto_search_form();

                    if ($porto_settings['show-sticky-minicart']) {
                        // show mini cart
                        echo porto_minicart();
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</header>