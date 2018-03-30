<?php
global $porto_settings, $porto_layout;

$search_size = $porto_settings['search-size'];
?>
<header id="header" class="header-separate header-4 logo-center <?php echo $search_size ?> sticky-menu-header<?php echo ($porto_settings['logo-overlay'] && $porto_settings['logo-overlay']['url']) ? ' logo-overlay-header' : '' ?>">
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
                // show search form
                echo porto_search_form();

                // show mobile toggle
                ?>
                <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>
            </div>
            <div class="header-center">
                <?php
                // show logo
                $logo = porto_logo();
                echo $logo;
                ?>
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
    // check main menu
    $main_menu = porto_main_menu();
    if ($main_menu) : ?>
        <div class="main-menu-wrap<?php echo ($porto_settings['menu-type']?' '.$porto_settings['menu-type']:'') ?>">
            <div id="main-menu" class="container <?php echo $porto_settings['menu-align'] ?><?php echo $porto_settings['show-sticky-menu-custom-content'] ? '' : ' hide-sticky-content' ?>">
                <?php if ($porto_settings['show-sticky-logo']) : ?>
                    <div class="menu-left">
                        <?php
                        // show logo
                        $logo = porto_logo( true );
                        echo $logo;
                        ?>
                    </div>
                <?php endif; ?>
                <div class="menu-center">
                    <?php
                    // show main menu
                    echo $main_menu;
                    ?>
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