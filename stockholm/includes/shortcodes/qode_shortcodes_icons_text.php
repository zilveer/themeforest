<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>

<div id="qode_shortcode_form_wrapper">
    <form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
        <div class="input">
            <label>Box type</label>
            <select name="box_type" id="box_type">
                <option value="normal">Normal</option>
                <option value="icon_in_a_box'">Icon in a box</option>
            </select>
        </div>
        <div class="input">
        <label>Box border</label>
            <select name="box_border" id="box_border">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="input">
            <label>Box Border Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input name="box_border_color" id="box_border_color" value="" maxlength="10" size="10" />
        </div>
        <div class="input">
            <label>Box Backround Color (only for icon in a box type)</label>
            <div class="colorSelector"><div style=""></div></div>
            <input name="box_background_color" id="box_background_color" value="" maxlength="10" size="10" />
        </div>        
         <div class="input">
            <label>Icon Pack</label>
            <select name="icon_pack" id="icon_pack">
                <option value="font_awesome">Font Awesome</option>
                <option value="font_elegant">Font Elegant</option>
            </select>
        </div>
         <div class="input">
            <label>Font Awesome</label>
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
            <div class="input">
                <label>Icon Type</label>
                <select name="icon_type" id="icon_type">
                    <option value="normal">Normal</option>
                    <option value="circle">Circle</option>
                    <option value="square">Square</option>
                </select>
            </div>
            <label>Icon Size/Icon Space From Text</label>
            <select name="icon_size" id="icon_size">
                <option value="fa-lg">Tiny</option>
                <option value="fa-2x">Small</option>
                <option value="fa-3x">Medium</option>
                <option value="fa-4x">Large</option>
                <option value="fa-5x">Very Large</option>
            </select>
        </div>        
        <div class="input">    
            <label>Icon Animation</label>
            <select name="icon_animation" id="icon_animation">
                <option value="">No</option>
                <option value="q_icon_animation">Yes</option>
            </select>
        </div>
        <div class="input">    
            <label>Icon Animation Delay</label>
            <input name="icon_animation_delay" id="icon_animation_delay" value="" maxlength="10" size="10" />
        </div>
        <div class="input">
            <label>Icon Position (only for normal box type)</label>
            <select name="icon_position" id="icon_position">
                <option value="top">Top</option>
                <option value="left">Left</option>
                <option value="left_from_title">Left From Title</option>
            </select>
        </div>
        <div class="input">
            <label>Icon margin (top right bottom left)</label>
            <input type="text" name="icon_margin" id="icon_margin" value="" size="12" maxlength="12" />
        </div>
        <div class="input">
            <label>Icon Border Color (Only for Square and Circle type)</label>
            <div class="colorSelector"><div style=""></div></div>
            <input type="text" name="icon_border_color" id="icon_border_color" value="" size="12" maxlength="12" />
        </div>
        <div class="input">
            <label>Icon Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input name="icon_color" id="icon_color" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Icon Background Color (only for square and circle icon type)</label>
            <div class="colorSelector"><div style=""></div></div>
            <input name="icon_background_color" id="icon_background_color" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Title</label>
            <input name="title" id="title" value="" maxlength="100" size="12" />
        </div>
        <div class="input">
            <label>Title Tag</label>
            <select name="title_tag" id="title_tag">
                <option value=""></option>
                <option value="h2">h2</option>
                <option value="h3">h3</option>
                <option value="h4">h4</option>
                <option value="h5">h5</option>
                <option value="h6">h6</option>
            </select>
        </div>
        <div class="input">
            <label>Title Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input name="title_color" id="title_color" value="" maxlength="100" size="12" />
        </div>
        <div class="input">
            <label>Text</label>
            <input name="text" id="text" value="" />
        </div>
        <div class="input">
            <label>Text Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input name="text_color" id="text_color" value="" />
        </div>
        <div class="input">
            <label>Link</label>
            <input name="link" id="link" value="" maxlength="100" size="12" />
        </div>
        <div class="input">
            <label>Link Text</label>
            <input name="link_text" id="link_text" value="" maxlength="100" size="12" />
        </div>
        <div class="input">
            <label>Target</label>
            <select name="target" id="target">
                <option value=""></option>
                <option value="_self">Self</option>
                <option value="_blank">Blank</option>
            </select>
        </div>
        <div class="input">
            <label>Link Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input name="link_color" id="link_color" value="" />
        </div>
        <div class="input">
            <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
        </div>
    </form>

</div>