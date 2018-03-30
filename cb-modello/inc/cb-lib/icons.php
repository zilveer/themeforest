<div id="cb-icon-container" style="display: none;">
<a class="close" href="javascript:CBFontAwesome.hideEditor();" title="close"><i class="fa fa-times"></i></a>

<div class="icons">
<div class="wrap" style="padding: 1em">
<div id="icons-pack-select">
    <button type="button" class="button button-primary " id="fontawesome-icons">FontAwesome Icons</button>
</div>



<div id="fontawesome-icons-content" class="icons-pack">
<div id="icon_prev">
    <div class="aq_desc">
        <label>
            <div id="cur_icon"></div>
        </label>
        <a class="save" href="javascript:CBFontAwesome.saveIcon();" title="close">
            <button type="button" class="button button-primary cb_button_save ">Save</button>
        </a>
    </div>
</div>
<div class="fleft" id="last_icon" style="margin-top:30px;">
    <div class="aq_desc"><label>Last used icon</label><span>Click on icon to set last settings<br/></span>

        <div class="last_icon_prev"></div>
    </div>
</div>
<div class="cl"></div>
<div class="fleft" id="icon_cur_sett">

    <div id="icon_customise">
        <div class="aq_desc first">
            <label for="font-size">Font size </label>

            <div class="slider_inside">
                <input type="text" id="font-size" value="20" data-slider="true" data-slider-step="1"
                       data-slider-range="8,100" data-slider-highlight="true">
                <?php _e('px', 'cb-modello'); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="aq_desc">
            <label for="color">Color </label> <input id="color" type="text"
                                                     value="#000" class="newcolor" autocomplete="off" style="">
        </div>
        <div class="aq_desc inp_larger">
            <label for="tip">Tip text </label><input id="tip" type="text"
                                                     value="" class="tip" autocomplete="" style="">
        </div>
        <div class="cl"></div>
        <input type="hidden" id="send_to_full"/>
    </div>


    <div id="icon_ani">

        <?php
        $icon_ani_o = array('' => 'none', 'border_outer' => 'border outer', 'border_outer2' => 'border outer 2', 'background_inner' => 'background inner',
            'background_outer' => 'background outer', 'flip_left' => 'flip left', 'flip_top' => 'flip top', 'rotate' => 'rotate');

        $icon_ani_color_after_o = array('' => 'same', 'white' => 'white', 'blue' => 'blue', 'black' => 'black', 'green' => 'green', 'red' => 'red', 'red' => 'red');
        $icon_ani_bg_color_after_o = array('' => 'none', 'white' => 'white', 'blue' => 'blue', 'black' => 'black', 'green' => 'green', 'red' => 'red', 'red' => 'red');

        ?>

        <div class="aq_desc first">
            <label for="icon_ani_select">Icon animation </label>
            <select name="icon_ani_select" id="icon_ani_select">
                <?php foreach ($icon_ani_o as $icon_ani_single => $icon_ani_single_v) {
                    echo '<option value="' . $icon_ani_single . '">' . $icon_ani_single_v . '</option>';
                } ?>
            </select>

            <div class="clear"></div>
        </div>

        <div class="aq_desc">
            <label for="icon_ani_color_after">Icon color after hover </label>
            <select name="icon_ani_color_after" id="icon_ani_color_after">
                <?php foreach ($icon_ani_color_after_o as $icon_ani_color_after_single => $icon_ani_color_after_single_v) {
                    echo '<option value="' . $icon_ani_color_after_single . '">' . $icon_ani_color_after_single_v . '</option>';
                } ?>
            </select>
        </div>
        <div class="aq_desc">
            <label for="icon_ani_bg">Icon background</label>
            <select name="icon_ani_bg" id="icon_ani_bg">
                <?php foreach ($icon_ani_bg_color_after_o as $icon_ani_bg_after_single => $icon_ani_bg_after_single_v) {
                    echo '<option value="' . $icon_ani_bg_after_single . '">' . $icon_ani_bg_after_single_v . '</option>';
                } ?>
            </select>
        </div>
        <div class="aq_desc">
            <label for="icon_ani_bg_after">Icon background after hover </label>
            <select name="icon_ani_bg_after" id="icon_ani_bg_after">
                <?php foreach ($icon_ani_bg_color_after_o as $icon_ani_bg_after_single => $icon_ani_bg_after_single_v) {
                    echo '<option value="' . $icon_ani_bg_after_single . '">' . $icon_ani_bg_after_single_v . '</option>';
                } ?>
            </select>
        </div>
        <div class="aq_desc" style="display:none!important;">
            <label for="icon_wh_size">Icon container size</label>
            <select name="icon_wh_size" id="icon_wh_size">
                <option value=""></option>
                <option value="i20">20px</option>
                <option value="i40">40px</option>
                <option value="i60">60px</option>
                <option value="i80">80px</option>
                <option value="i100">100px</option>
                <option value="i150">150px</option>
                <option value="i200">200px</option>
                <option value="i250">250px</option>
                <option value="i300">300px</option>
            </select>
        </div>
        <div class="cl"></div>
    </div>
    <div class="cl"></div>



</div>


<div class="admin-icons-content">

<div id="new" style="margin-top:50px;">
    <h2 class="page-header">11 New Icons in 4.0</h2>


    <div class="row fontawesome-icon-list">


        <i class="fa fa-rub"></i>

        <i class="fa fa-ruble"></i>

        <i class="fa fa-rouble"></i>

        <i class="fa fa-pagelines"></i>

        <i class="fa fa-stack-exchange"></i>

        <i class="fa fa-arrow-circle-o-right"></i>

        <i class="fa fa-arrow-circle-o-left"></i>

        <i class="fa fa-caret-square-o-left"></i>

        <i class="fa fa-toggle-left"></i>

        <i class="fa fa-dot-circle-o"></i>

        <i class="fa fa-wheelchair"></i>

        <i class="fa fa-vimeo-square"></i>

        <i class="fa fa-try"></i>

        <i class="fa fa-turkish-lira"></i>

        <i class="fa fa-plus-square-o"></i>

    </div>

</div>

<section id="web-application">
<h2 class="page-header">Web Application Icons</h2>

<div class="row fontawesome-icon-list">


<i class="fa fa-adjust"></i>

<i class="fa fa-anchor"></i>

<i class="fa fa-archive"></i>

<i class="fa fa-arrows"></i>

<i class="fa fa-arrows-h"></i>

<i class="fa fa-arrows-v"></i>

<i class="fa fa-asterisk"></i>

<i class="fa fa-ban"></i>

<i class="fa fa-bar-chart-o"></i>

<i class="fa fa-barcode"></i>

<i class="fa fa-bars"></i>

<i class="fa fa-beer"></i>

<i class="fa fa-bell"></i>

<i class="fa fa-bell-o"></i>

<i class="fa fa-bolt"></i>

<i class="fa fa-book"></i>

<i class="fa fa-bookmark"></i>

<i class="fa fa-bookmark-o"></i>

<i class="fa fa-briefcase"></i>

<i class="fa fa-bug"></i>

<i class="fa fa-building-o"></i>

<i class="fa fa-bullhorn"></i>

<i class="fa fa-bullseye"></i>

<i class="fa fa-calendar"></i>

<i class="fa fa-calendar-o"></i>

<i class="fa fa-camera"></i>

<i class="fa fa-camera-retro"></i>

<i class="fa fa-caret-square-o-down"></i>

<i class="fa fa-caret-square-o-left"></i>

<i class="fa fa-caret-square-o-right"></i>

<i class="fa fa-caret-square-o-up"></i>

<i class="fa fa-certificate"></i>

<i class="fa fa-check"></i>

<i class="fa fa-check-circle"></i>

<i class="fa fa-check-circle-o"></i>

<i class="fa fa-check-square"></i>

<i class="fa fa-check-square-o"></i>

<i class="fa fa-circle"></i>

<i class="fa fa-circle-o"></i>

<i class="fa fa-clock-o"></i>

<i class="fa fa-cloud"></i>

<i class="fa fa-cloud-download"></i>

<i class="fa fa-cloud-upload"></i>

<i class="fa fa-code"></i>

<i class="fa fa-code-fork"></i>

<i class="fa fa-coffee"></i>

<i class="fa fa-cog"></i>

<i class="fa fa-cogs"></i>

<i class="fa fa-comment"></i>

<i class="fa fa-comment-o"></i>

<i class="fa fa-comments"></i>

<i class="fa fa-comments-o"></i>

<i class="fa fa-compass"></i>

<i class="fa fa-credit-card"></i>

<i class="fa fa-crop"></i>

<i class="fa fa-crosshairs"></i>

<i class="fa fa-cutlery"></i>

<i class="fa fa-dashboard"></i>

<i class="fa fa-desktop"></i>

<i class="fa fa-dot-circle-o"></i>

<i class="fa fa-download"></i>

<i class="fa fa-edit"></i>

<i class="fa fa-ellipsis-h"></i>

<i class="fa fa-ellipsis-v"></i>

<i class="fa fa-envelope"></i>

<i class="fa fa-envelope-o"></i>

<i class="fa fa-eraser"></i>

<i class="fa fa-exchange"></i>

<i class="fa fa-exclamation"></i>

<i class="fa fa-exclamation-circle"></i>

<i class="fa fa-exclamation-triangle"></i>

<i class="fa fa-external-link"></i>

<i class="fa fa-external-link-square"></i>

<i class="fa fa-eye"></i>

<i class="fa fa-eye-slash"></i>

<i class="fa fa-female"></i>

<i class="fa fa-fighter-jet"></i>

<i class="fa fa-film"></i>

<i class="fa fa-filter"></i>

<i class="fa fa-fire"></i>

<i class="fa fa-fire-extinguisher"></i>

<i class="fa fa-flag"></i>

<i class="fa fa-flag-checkered"></i>

<i class="fa fa-flag-o"></i>

<i class="fa fa-flash"></i>

<i class="fa fa-flask"></i>

<i class="fa fa-folder"></i>

<i class="fa fa-folder-o"></i>

<i class="fa fa-folder-open"></i>

<i class="fa fa-folder-open-o"></i>

<i class="fa fa-frown-o"></i>

<i class="fa fa-gamepad"></i>

<i class="fa fa-gavel"></i>

<i class="fa fa-gear"></i>

<i class="fa fa-gears"></i>

<i class="fa fa-gift"></i>

<i class="fa fa-glass"></i>

<i class="fa fa-globe"></i>

<i class="fa fa-group"></i>

<i class="fa fa-hdd-o"></i>

<i class="fa fa-headphones"></i>

<i class="fa fa-heart"></i>

<i class="fa fa-heart-o"></i>

<i class="fa fa-home"></i>

<i class="fa fa-inbox"></i>

<i class="fa fa-info"></i>

<i class="fa fa-info-circle"></i>

<i class="fa fa-key"></i>

<i class="fa fa-keyboard-o"></i>

<i class="fa fa-laptop"></i>

<i class="fa fa-leaf"></i>

<i class="fa fa-legal"></i>

<i class="fa fa-lemon-o"></i>

<i class="fa fa-level-down"></i>

<i class="fa fa-level-up"></i>

<i class="fa fa-lightbulb-o"></i>

<i class="fa fa-location-arrow"></i>

<i class="fa fa-lock"></i>

<i class="fa fa-magic"></i>

<i class="fa fa-magnet"></i>

<i class="fa fa-mail-forward"></i>

<i class="fa fa-mail-reply"></i>

<i class="fa fa-mail-reply-all"></i>

<i class="fa fa-male"></i>

<i class="fa fa-map-marker"></i>

<i class="fa fa-meh-o"></i>

<i class="fa fa-microphone"></i>

<i class="fa fa-microphone-slash"></i>

<i class="fa fa-minus"></i>

<i class="fa fa-minus-circle"></i>

<i class="fa fa-minus-square"></i>

<i class="fa fa-minus-square-o"></i>

<i class="fa fa-mobile"></i>

<i class="fa fa-mobile-phone"></i>

<i class="fa fa-money"></i>

<i class="fa fa-moon-o"></i>

<i class="fa fa-music"></i>

<i class="fa fa-pencil"></i>

<i class="fa fa-pencil-square"></i>

<i class="fa fa-pencil-square-o"></i>

<i class="fa fa-phone"></i>

<i class="fa fa-phone-square"></i>

<i class="fa fa-picture-o"></i>

<i class="fa fa-plane"></i>

<i class="fa fa-plus"></i>

<i class="fa fa-plus-circle"></i>

<i class="fa fa-plus-square"></i>

<i class="fa fa-plus-square-o"></i>

<i class="fa fa-power-off"></i>

<i class="fa fa-print"></i>

<i class="fa fa-puzzle-piece"></i>

<i class="fa fa-qrcode"></i>

<i class="fa fa-question"></i>

<i class="fa fa-question-circle"></i>

<i class="fa fa-quote-left"></i>

<i class="fa fa-quote-right"></i>

<i class="fa fa-random"></i>

<i class="fa fa-refresh"></i>

<i class="fa fa-reply"></i>

<i class="fa fa-reply-all"></i>

<i class="fa fa-retweet"></i>

<i class="fa fa-road"></i>

<i class="fa fa-rocket"></i>

<i class="fa fa-rss"></i>

<i class="fa fa-rss-square"></i>

<i class="fa fa-search"></i>

<i class="fa fa-search-minus"></i>

<i class="fa fa-search-plus"></i>

<i class="fa fa-share"></i>

<i class="fa fa-share-square"></i>

<i class="fa fa-share-square-o"></i>

<i class="fa fa-shield"></i>

<i class="fa fa-shopping-cart"></i>

<i class="fa fa-sign-in"></i>

<i class="fa fa-sign-out"></i>

<i class="fa fa-signal"></i>

<i class="fa fa-sitemap"></i>

<i class="fa fa-smile-o"></i>

<i class="fa fa-sort"></i>

<i class="fa fa-sort-alpha-asc"></i>

<i class="fa fa-sort-alpha-desc"></i>

<i class="fa fa-sort-amount-asc"></i>

<i class="fa fa-sort-amount-desc"></i>

<i class="fa fa-sort-asc"></i>

<i class="fa fa-sort-desc"></i>

<i class="fa fa-sort-down"></i>

<i class="fa fa-sort-numeric-asc"></i>

<i class="fa fa-sort-numeric-desc"></i>

<i class="fa fa-sort-up"></i>

<i class="fa fa-spinner"></i>

<i class="fa fa-square"></i>

<i class="fa fa-square-o"></i>

<i class="fa fa-star"></i>

<i class="fa fa-star-half"></i>

<i class="fa fa-star-half-empty"></i>

<i class="fa fa-star-half-full"></i>

<i class="fa fa-star-half-o"></i>

<i class="fa fa-star-o"></i>

<i class="fa fa-subscript"></i>

<i class="fa fa-suitcase"></i>

<i class="fa fa-sun-o"></i>

<i class="fa fa-superscript"></i>

<i class="fa fa-tablet"></i>

<i class="fa fa-tachometer"></i>

<i class="fa fa-tag"></i>

<i class="fa fa-tags"></i>

<i class="fa fa-tasks"></i>

<i class="fa fa-terminal"></i>

<i class="fa fa-thumb-tack"></i>

<i class="fa fa-thumbs-down"></i>

<i class="fa fa-thumbs-o-down"></i>

<i class="fa fa-thumbs-o-up"></i>

<i class="fa fa-thumbs-up"></i>

<i class="fa fa-ticket"></i>

<i class="fa fa-times"></i>

<i class="fa fa-times-circle"></i>

<i class="fa fa-times-circle-o"></i>

<i class="fa fa-tint"></i>

<i class="fa fa-toggle-down"></i>

<i class="fa fa-toggle-left"></i>

<i class="fa fa-toggle-right"></i>

<i class="fa fa-toggle-up"></i>

<i class="fa fa-trash-o"></i>

<i class="fa fa-trophy"></i>

<i class="fa fa-truck"></i>

<i class="fa fa-umbrella"></i>

<i class="fa fa-unlock"></i>

<i class="fa fa-unlock-alt"></i>

<i class="fa fa-unsorted"></i>

<i class="fa fa-upload"></i>

<i class="fa fa-user"></i>

<i class="fa fa-users"></i>

<i class="fa fa-video-camera"></i>

<i class="fa fa-volume-down"></i>

<i class="fa fa-volume-off"></i>

<i class="fa fa-volume-up"></i>

<i class="fa fa-warning"></i>

<i class="fa fa-wheelchair"></i>

<i class="fa fa-wrench"></i>

</div>

</section>

<section id="form-control">
    <h2 class="page-header">Form Control Icons</h2>

    <div class="row fontawesome-icon-list">


        <i class="fa fa-check-square"></i>

        <i class="fa fa-check-square-o"></i>

        <i class="fa fa-circle"></i>

        <i class="fa fa-circle-o"></i>

        <i class="fa fa-dot-circle-o"></i>

        <i class="fa fa-minus-square"></i>

        <i class="fa fa-minus-square-o"></i>

        <i class="fa fa-plus-square"></i>

        <i class="fa fa-plus-square-o"></i>

        <i class="fa fa-square"></i>

        <i class="fa fa-square-o"></i>

    </div>
</section>

<section id="currency">
    <h2 class="page-header">Currency Icons</h2>

    <div class="row fontawesome-icon-list">


        <i class="fa fa-bitcoin"></i>

        <i class="fa fa-btc"></i>

        <i class="fa fa-cny"></i>

        <i class="fa fa-dollar"></i>

        <i class="fa fa-eur"></i>

        <i class="fa fa-euro"></i>

        <i class="fa fa-gbp"></i>

        <i class="fa fa-inr"></i>

        <i class="fa fa-jpy"></i>

        <i class="fa fa-krw"></i>

        <i class="fa fa-money"></i>

        <i class="fa fa-rmb"></i>

        <i class="fa fa-rouble"></i>

        <i class="fa fa-rub"></i>

        <i class="fa fa-ruble"></i>

        <i class="fa fa-rupee"></i>

        <i class="fa fa-try"></i>

        <i class="fa fa-turkish-lira"></i>

        <i class="fa fa-usd"></i>

        <i class="fa fa-won"></i>

        <i class="fa fa-yen"></i>

    </div>

</section>

<section id="text-editor">
    <h2 class="page-header">Text Editor Icons</h2>

    <div class="row fontawesome-icon-list">


        <i class="fa fa-align-center"></i>

        <i class="fa fa-align-justify"></i>

        <i class="fa fa-align-left"></i>

        <i class="fa fa-align-right"></i>

        <i class="fa fa-bold"></i>

        <i class="fa fa-chain"></i>

        <i class="fa fa-chain-broken"></i>

        <i class="fa fa-clipboard"></i>

        <i class="fa fa-columns"></i>

        <i class="fa fa-copy"></i>

        <i class="fa fa-cut"></i>

        <i class="fa fa-dedent"></i>

        <i class="fa fa-eraser"></i>

        <i class="fa fa-file"></i>

        <i class="fa fa-file-o"></i>

        <i class="fa fa-file-text"></i>

        <i class="fa fa-file-text-o"></i>

        <i class="fa fa-files-o"></i>

        <i class="fa fa-floppy-o"></i>

        <i class="fa fa-font"></i>

        <i class="fa fa-indent"></i>

        <i class="fa fa-italic"></i>

        <i class="fa fa-link"></i>

        <i class="fa fa-list"></i>

        <i class="fa fa-list-alt"></i>

        <i class="fa fa-list-ol"></i>

        <i class="fa fa-list-ul"></i>

        <i class="fa fa-outdent"></i>

        <i class="fa fa-paperclip"></i>

        <i class="fa fa-paste"></i>

        <i class="fa fa-repeat"></i>

        <i class="fa fa-rotate-left"></i>

        <i class="fa fa-rotate-right"></i>

        <i class="fa fa-save"></i>

        <i class="fa fa-scissors"></i>

        <i class="fa fa-strikethrough"></i>

        <i class="fa fa-table"></i>

        <i class="fa fa-text-height"></i>

        <i class="fa fa-text-width"></i>

        <i class="fa fa-th"></i>

        <i class="fa fa-th-large"></i>

        <i class="fa fa-th-list"></i>

        <i class="fa fa-underline"></i>

        <i class="fa fa-undo"></i>

        <i class="fa fa-unlink"></i>

    </div>

</section>

<section id="directional">
    <h2 class="page-header">Directional Icons</h2>

    <div class="row fontawesome-icon-list">


        <i class="fa fa-angle-double-down"></i>

        <i class="fa fa-angle-double-left"></i>

        <i class="fa fa-angle-double-right"></i>

        <i class="fa fa-angle-double-up"></i>

        <i class="fa fa-angle-down"></i>

        <i class="fa fa-angle-left"></i>

        <i class="fa fa-angle-right"></i>

        <i class="fa fa-angle-up"></i>

        <i class="fa fa-arrow-circle-down"></i>

        <i class="fa fa-arrow-circle-left"></i>

        <i class="fa fa-arrow-circle-o-down"></i>

        <i class="fa fa-arrow-circle-o-left"></i>

        <i class="fa fa-arrow-circle-o-right"></i>

        <i class="fa fa-arrow-circle-o-up"></i>

        <i class="fa fa-arrow-circle-right"></i>

        <i class="fa fa-arrow-circle-up"></i>

        <i class="fa fa-arrow-down"></i>

        <i class="fa fa-arrow-left"></i>

        <i class="fa fa-arrow-right"></i>

        <i class="fa fa-arrow-up"></i>

        <i class="fa fa-arrows"></i>

        <i class="fa fa-arrows-alt"></i>

        <i class="fa fa-arrows-h"></i>

        <i class="fa fa-arrows-v"></i>

        <i class="fa fa-caret-down"></i>

        <i class="fa fa-caret-left"></i>

        <i class="fa fa-caret-right"></i>

        <i class="fa fa-caret-square-o-down"></i>

        <i class="fa fa-caret-square-o-left"></i>

        <i class="fa fa-caret-square-o-right"></i>

        <i class="fa fa-caret-square-o-up"></i>

        <i class="fa fa-caret-up"></i>

        <i class="fa fa-chevron-circle-down"></i>

        <i class="fa fa-chevron-circle-left"></i>

        <i class="fa fa-chevron-circle-right"></i>

        <i class="fa fa-chevron-circle-up"></i>

        <i class="fa fa-chevron-down"></i>

        <i class="fa fa-chevron-left"></i>

        <i class="fa fa-chevron-right"></i>

        <i class="fa fa-chevron-up"></i>

        <i class="fa fa-hand-o-down"></i>

        <i class="fa fa-hand-o-left"></i>

        <i class="fa fa-hand-o-right"></i>

        <i class="fa fa-hand-o-up"></i>

        <i class="fa fa-long-arrow-down"></i>

        <i class="fa fa-long-arrow-left"></i>

        <i class="fa fa-long-arrow-right"></i>

        <i class="fa fa-long-arrow-up"></i>

        <i class="fa fa-toggle-down"></i>

        <i class="fa fa-toggle-left"></i>

        <i class="fa fa-toggle-right"></i>

        <i class="fa fa-toggle-up"></i>

    </div>

</section>

<section id="video-player">
    <h2 class="page-header">Video Player Icons</h2>

    <div class="row fontawesome-icon-list">


        <i class="fa fa-arrows-alt"></i>

        <i class="fa fa-backward"></i>

        <i class="fa fa-compress"></i>

        <i class="fa fa-eject"></i>

        <i class="fa fa-expand"></i>

        <i class="fa fa-fast-backward"></i>

        <i class="fa fa-fast-forward"></i>

        <i class="fa fa-forward"></i>

        <i class="fa fa-pause"></i>

        <i class="fa fa-play"></i>

        <i class="fa fa-play-circle"></i>

        <i class="fa fa-play-circle-o"></i>

        <i class="fa fa-step-backward"></i>

        <i class="fa fa-step-forward"></i>

        <i class="fa fa-stop"></i>

        <i class="fa fa-youtube-play"></i>

    </div>

</section>

<section id="brand">
    <h2 class="page-header">Brand Icons</h2>

    <div class="alert alert-success">
        <ul class="margin-bottom-none padding-left-lg">
            <li>All brand icons are trademarks of their respective owners.</li>
            <li>The use of these trademarks does not indicate endorsement of the trademark holder by Font Awesome, nor
                vice versa.
            </li>
        </ul>

    </div>

    <div class="row fontawesome-icon-list">


        <i class="fa fa-adn"></i>

        <i class="fa fa-android"></i>

        <i class="fa fa-apple"></i>

        <i class="fa fa-bitbucket"></i>

        <i class="fa fa-bitbucket-square"></i>

        <i class="fa fa-bitcoin"></i>

        <i class="fa fa-btc"></i>

        <i class="fa fa-css3"></i>

        <i class="fa fa-dribbble"></i>

        <i class="fa fa-dropbox"></i>

        <i class="fa fa-facebook"></i>

        <i class="fa fa-facebook-square"></i>

        <i class="fa fa-flickr"></i>

        <i class="fa fa-foursquare"></i>

        <i class="fa fa-github"></i>

        <i class="fa fa-github-alt"></i>

        <i class="fa fa-github-square"></i>

        <i class="fa fa-gittip"></i>

        <i class="fa fa-google-plus"></i>

        <i class="fa fa-google-plus-square"></i>

        <i class="fa fa-html5"></i>

        <i class="fa fa-instagram"></i>

        <i class="fa fa-linkedin"></i>

        <i class="fa fa-linkedin-square"></i>

        <i class="fa fa-linux"></i>

        <i class="fa fa-maxcdn"></i>

        <i class="fa fa-pagelines"></i>

        <i class="fa fa-pinterest"></i>

        <i class="fa fa-pinterest-square"></i>

        <i class="fa fa-renren"></i>

        <i class="fa fa-skype"></i>

        <i class="fa fa-stack-exchange"></i>

        <i class="fa fa-stack-overflow"></i>

        <i class="fa fa-trello"></i>

        <i class="fa fa-tumblr"></i>

        <i class="fa fa-tumblr-square"></i>

        <i class="fa fa-twitter"></i>

        <i class="fa fa-twitter-square"></i>

        <i class="fa fa-vimeo-square"></i>

        <i class="fa fa-vk"></i>

        <i class="fa fa-weibo"></i>

        <i class="fa fa-windows"></i>

        <i class="fa fa-xing"></i>

        <i class="fa fa-xing-square"></i>

        <i class="fa fa-youtube"></i>

        <i class="fa fa-youtube-play"></i>

        <i class="fa fa-youtube-square"></i>

    </div>
</section>

<section id="medical">
    <h2 class="page-header">Medical Icons</h2>

    <div class="row fontawesome-icon-list">


        <i class="fa fa-ambulance"></i>

        <i class="fa fa-h-square"></i>

        <i class="fa fa-hospital-o"></i>

        <i class="fa fa-medkit"></i>

        <i class="fa fa-plus-square"></i>

        <i class="fa fa-stethoscope"></i>

        <i class="fa fa-user-md"></i>

        <i class="fa fa-wheelchair"></i>

    </div>

</section>
</div>
</div>

<div id="svg-icons-content" style="display: none" class="icons-pack">
    <div id="icon_prev_svg">
        <div class="aq_desc">
            <label>
                <div id="cur_icon_svg"></div>
            </label>
            <a class="save" href="javascript:CBFontAwesome.saveIconSVG();" title="close">
                <button type="button" class="button button-primary cb_button_save ">Save</button>
            </a>
        </div>
    </div>

    <div class="cl"></div>

    <div class="aq_desc first">
        <label for="font-size">Icon size</label>

        <div class="slider_inside">
            <input type="text" id="font-size-svg" value="64" data-slider="true" data-slider-step="16"
                   data-slider-range="32,256" data-slider-highlight="true">
            <?php _e('px', 'cb-modello'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="aq_desc">
        <label for="color">Color </label> <input id="color-svg" type="text"
                                                 value="#454040" class="newcolor" autocomplete="off" style="">
        <div class="clear"></div>

    </div>
    <section class="si-icons si-icons-default">
        <span class="si-icon si-icon-nav-left-arrow" data-icon-name="navLeftArrow"></span>
        <span class="si-icon si-icon-nav-up-arrow" data-icon-name="navUpArrow"></span>
        <span class="si-icon si-icon-right-arrow" data-icon-name="rightArrow"></span>
        <span class="si-icon si-icon-down-arrow" data-icon-name="downArrow"></span>
        <span class="si-icon si-icon-hamburger" data-icon-name="hamburger"></span>
        <span class="si-icon si-icon-hamburger-cross" data-icon-name="hamburgerCross"></span>
        <span class="si-icon si-icon-plus" data-icon-name="plus"></span>
        <span class="si-icon si-icon-plus-cross" data-icon-name="plusCross"></span>
        <span class="si-icon si-icon-maximize" data-icon-name="maximize"></span>
        <span class="si-icon si-icon-maximize-rotate" data-icon-name="maximizeRotate"></span>
        <span class="si-icon si-icon-contract" data-icon-name="contract"></span>
        <span class="si-icon si-icon-play" data-icon-name="play"></span>
        <span class="si-icon si-icon-monitor" data-icon-name="monitor"></span>
        <span class="si-icon si-icon-trash" data-icon-name="trash"></span>
        <span class="si-icon si-icon-flag" data-icon-name="flag"></span>
        <span class="si-icon si-icon-volume" data-icon-name="volume"></span>
        <span class="si-icon si-icon-clock" data-icon-name="clock"></span>
        <span class="si-icon si-icon-mail" data-icon-name="mail"></span>
        <span class="si-icon si-icon-smiley" data-icon-name="smiley"></span>
        <span class="si-icon si-icon-equalizer" data-icon-name="equalizer"></span>
        <span class="si-icon si-icon-glass-empty" data-icon-name="glass"></span>
        <span class="si-icon si-icon-lock" data-icon-name="padlock"></span>
        <span class="si-icon si-icon-hourglass" data-icon-name="hourglass"></span>
        <span class="si-icon si-icon-zoom" data-icon-name="zoom"></span>
    </section>

</div>
</div>
</div>
</div>
<div id="cb-icon-backdrop" style="display: none;"></div>