<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div style="display: none;">
    <a href="#google_font_set" id="google_font_set_link">fancy</a>
    <div id="google_font_set" style="width: 800px; height: 600px;">
        <a class="admin-button button-small button-yellow button_save_google_fonts" href="#"><?php _e('save', 'cardealer'); ?></a>
        <ul id="google_font_set_list"></ul><br />
        <a class="admin-button button-small button-yellow button_save_google_fonts" href="#"><?php _e('save', 'cardealer'); ?></a>
    </div>


    <a href="#fancy_loader" id="fancy_loader_link">fancy loader</a>
    <div id="fancy_loader">
        <img src="<?php echo TMM_THEME_URI . "/images/preloader.gif" ?>" alt="loader" />
    </div>


    <div id="ui_slider_item">

        <div class="clearfix ui-slider-item" id="__UI_SLIDER_NAME__">
            <input type="text" class="range-amount-value" value="__UI_SLIDER_VALUE__" />
            <input type="hidden" value="__UI_SLIDER_VALUE__" name="__UI_SLIDER_NAME__" class="range-amount-value-hidden" />
            <div class="slider-range __UI_SLIDER_NAME__"></div>
        </div>

    </div>

</div>
