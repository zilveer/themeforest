<?php
global $porto_settings;
?>
<div class="panel-overlay"></div>
<div id="nav-panel" class="<?php echo (isset($porto_settings['mobile-panel-pos']) && $porto_settings['mobile-panel-pos']) ? $porto_settings['mobile-panel-pos'] : '' ?>">
    <?php
    // show welcome message
    if ($porto_settings['welcome-msg'])
        echo '<span class="welcome-msg">' . $porto_settings['welcome-msg'] . '</span>';

    // show currency and view switcher
    $switcher = '';
    $switcher .= porto_mobile_currency_switcher();
    $switcher .= porto_mobile_view_switcher();

    if ($switcher)
        echo '<div class="switcher-wrap">'.$switcher.'</div>';

    // show top navigation and mobile menu
    $menu = porto_mobile_menu();

    if ($menu)
        echo '<div class="menu-wrap">'.$menu.'</div>';

    $header_type = porto_get_header_type();

    if (($header_type == 1 || $header_type == 4 || $header_type == 9 || $header_type == 13 || $header_type == 14) && $porto_settings['menu-block']) {
        echo '<div class="menu-custom-block">' . force_balance_tags($porto_settings['menu-block']) . '</div>';
    }

    $menu = porto_mobile_top_navigation();

    if ($menu)
        echo '<div class="menu-wrap">'.$menu.'</div>';

    // show social links
    echo porto_header_socials();
    ?>
</div>
<a href="#" id="nav-panel-close" class="<?php echo (isset($porto_settings['mobile-panel-pos']) && $porto_settings['mobile-panel-pos']) ? $porto_settings['mobile-panel-pos'] : '' ?>"><i class="fa fa-close"></i></a>