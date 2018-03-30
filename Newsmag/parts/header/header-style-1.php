<!--
Header style 1
-->

<div class="td-header-container td-header-wrap td-header-style-1">
    <div class="td-header-row td-header-top-menu">
        <?php td_api_top_bar_template::_helper_show_top_bar() ?>
    </div>

    <div class="td-header-row td-header-header">
        <div class="td-header-sp-logo">
            <?php locate_template('parts/header/logo-h1.php', true);?>
        </div>
        <div class="td-header-sp-rec">
            <?php locate_template('parts/header/ads.php', true); ?>
        </div>
    </div>

    <div class="td-header-menu-wrap">
        <div class="td-header-row td-header-border td-header-main-menu">
            <?php locate_template('parts/header/header-menu.php', true);?>
        </div>
    </div>
</div>