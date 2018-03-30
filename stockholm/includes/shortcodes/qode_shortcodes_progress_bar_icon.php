<?php
$full_path = __FILE__;
$path = explode( 'wp-content', $full_path );
require_once( $path[0] . '/wp-load.php' );
?>
<div id="qode_shortcode_form_wrapper">
<form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
    <div class="input">
        <label>Number of Icons</label>
        <input name="icons_number" id="icons_number" value="" maxlength="12" size="12" />
    </div>
    <div class="input">
        <label>Number of Active Icons</label>
        <input name="active_number" id="active_number" value="" maxlength="12" size="12" />
    </div>
    <div class="input">
        <label>Type</label>
        <select name="type" id="type">
            <option value="normal">Normal</option>
            <option value="circle">Circle</option>
            <option value="square">Square</option>
        </select>
    </div>
    <div class="input">
            <label>Icon Pack</label>
            <select name="icon_pack" id="icon_pack">
                <option value="">No Icon</option>
                <option value="font_awesome">Font Awesome</option>
                <option value="font_elegant">Font Elegant</option>
            </select>
        </div>
        
        <div class="input">
        <label>Font Awesome Icons</label>
            <select id="fa_icon" name="fa_icon">
                <option value=""></option>
                <?php
                $fa_icons = qode_font_awesome_icon_array();
                foreach ($fa_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        
        <div class="input">
        <label>Elegant Icons</label>
            <select id="fe_icon" name="fe_icon">
                <option value=""></option>
                <?php
                $fe_icons = qode_font_elegant_icon_array();
                foreach ($fe_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    <div class="input">
        <label>Size</label>
        <select name="size" id="size">
            <option value="tiny">Tiny</option>
            <option value="small">Small</option>
            <option value="medium">Medium</option>
            <option value="large">Large</option>
            <option value="very_large">Very Large</option>
        </select>
    </div>
    <div class="input">
        <label>Icon Color</label>
        <div class="colorSelector"><div style=""></div></div>
        <input name="icon_color" id="icon_color" value="" maxlength="12" size="12" />
    </div>
    <div class="input">
        <label>Icon Active Color</label>
        <div class="colorSelector"><div style=""></div></div>
        <input type="text" name="icon_active_color" id="icon_active_color" value="" size="12" maxlength="12" />
    </div>
     <div class="input">
        <label>Background Color</label>
        <div class="colorSelector"><div style=""></div></div>
        <input name="background_color" id="background_color" value="" maxlength="12" size="12" />
    </div>
    <div class="input">
        <label>Background Active Color</label>
        <div class="colorSelector"><div style=""></div></div>
        <input type="text" name="background_active_color" id="background_active_color" value="" size="12" maxlength="12" />
    </div>
    <div class="input">
        <label>Border Color (Only for Square and Circle type)</label>
        <div class="colorSelector"><div style=""></div></div>
        <input type="text" name="border_color" id="border_color" value="" size="12" maxlength="12" />
    </div>
    <div class="input">
        <label>Border Active Color (Only for Square and Circle type)</label>
        <div class="colorSelector"><div style=""></div></div>
        <input type="text" name="border_active_color" id="border_active_color" value="" size="12" maxlength="12" />
    </div>
    <div class="input">
        <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
    </div>
</form>
</div>