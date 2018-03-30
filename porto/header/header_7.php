<?php
global $porto_settings, $porto_layout;
?>
<header id="header" class="header-7 logo-center <?php echo $porto_settings['search-size'] ?><?php echo ($porto_settings['logo-overlay'] && $porto_settings['logo-overlay']['url']) ? ' logo-overlay-header' : '' ?>">
    <?php if ($porto_settings['show-header-top']) : ?>
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <?php
                // show social links
                echo porto_header_socials();
                ?>
            </div>
            <div class="header-right">
                <?php
                // show welcome message
                if ($porto_settings['welcome-msg'])
                    echo '<span class="welcome-msg">' . do_shortcode($porto_settings['welcome-msg']) . '</span>';
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="header-main">
        <div class="container">
            <div class="header-left">
                <div id="main-menu">
                    <?php
                    // show main menu
                    echo porto_main_menu();
                    ?>
                </div>
            </div>
            <div class="header-center">
                <?php
                // show logo
                $logo = porto_logo();
                echo $logo;
                ?>
            </div>
            <div class="header-right search-popup">
                <?php
                $minicart = porto_minicart();
                ?>
                <div class="<?php if ($minicart) echo 'header-minicart'.str_replace('minicart', '', $porto_settings['minicart-type']) ?>">
                    <?php // show mobile toggle ?>
                    <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>
                    <div class="block-nowrap">
                        <?php
                        // show top navigation
                        $top_nav = porto_top_navigation();
                        echo $top_nav;

                        // show search form
                        echo porto_search_form();
                        ?>
                    </div>

                    <?php
                    // show currency and view switcher
                    $currency_switcher = porto_currency_switcher();
                    $view_switcher = porto_view_switcher();

                    if ($currency_switcher || $view_switcher)
                        echo '<div class="switcher-wrap">';

                    echo $currency_switcher;

                    echo $view_switcher;

                    if ($currency_switcher || $view_switcher)
                        echo '</div>';

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
</header>