<?php
global $porto_settings, $porto_layout;
?>
<header id="header" class="header-side <?php echo $porto_settings['search-size'] ?> sticky-menu-header<?php echo ($porto_settings['logo-overlay'] && $porto_settings['logo-overlay']['url']) ? ' logo-overlay-header' : '' ?>">
    <div class="header-main<?php if ($porto_settings['show-minicart'] && class_exists('WooCommerce')) echo ' show-minicart' ?>">

        <div class="side-top">
            <div class="container">
                <?php
                // show currency and view switcher
                $currency_switcher = porto_currency_switcher();
                $view_switcher = porto_view_switcher();
                $minicart = porto_minicart();

                echo $currency_switcher;

                echo $view_switcher;

                echo $minicart;
                ?>
            </div>
        </div>

        <div class="container">

            <?php
                get_template_part('header/header_tooltip');
            ?>

            <div class="header-left">
                <?php
                // show logo
                $logo = porto_logo();
                echo $logo;
                ?>
            </div>

            <div class="header-center">
                <?php
                $sidebar_menu = porto_header_side_menu();
                if ($sidebar_menu) :
                    echo $sidebar_menu;
                endif;
                ?>

                <?php
                // show search form
                echo porto_search_form();
                // show mobile toggle
                ?>
                <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>

                <?php
                // show top navigation
                $top_nav = porto_mobile_top_navigation();
                echo $top_nav;
                ?>
            </div>

            <div class="header-right">
                <div class="side-bottom">
                    <?php
                    // show contact info and mini cart
                    $contact_info = $porto_settings['header-contact-info'];

                    if ($contact_info)
                        echo '<div class="header-contact">' . do_shortcode($contact_info) . '</div>';
                    ?>

                    <?php
                    // show social links
                    echo porto_header_socials();
                    ?>

                    <?php
                    // show copyright
                    $copyright = $porto_settings['header-copyright'];

                    if ($copyright)
                        echo '<div class="header-copyright">' . do_shortcode($copyright) . '</div>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>