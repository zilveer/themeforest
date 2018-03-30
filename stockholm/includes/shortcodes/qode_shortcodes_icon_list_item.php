<?php
$full_path = __FILE__;
$path = explode( 'wp-content', $full_path );
require_once( $path[0] . '/wp-load.php' );
 ?>

<div id="qode_shortcode_form_wrapper">
<form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
        
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
        <label>Icon Type</label>
        <select id="icon_type" name="icon_type">
            <option value="normal_icon_list">Normal</option>
            <option value="small_icon_list">Small</option>
        </select>
    </div>
	<div class="input">
		<label>Icon Color</label>
		<div class="colorSelector"><div style=""></div></div>
		<input name="icon_color" id="icon_color" value="" maxlength="10" size="10" />
	</div>
	    <div class="input">
        <label>Border Type</label>
        <select id="border_type" name="border_type">
           <option value=""></option>
            <option value="circle">Circle</option>
            <option value="square">Square</option>
        </select>
    </div>
	<div class="input">
		<label>Border Color</label>
		<div class="colorSelector"><div style=""></div></div>
		<input type="text" name="border_color" id="border_color" value="" size="10" maxlength="10" />
	</div>
	<div class="input">
		<label>Title</label>
		<input name="title" id="title" value="" maxlength="100" size="55" />
	</div>
	<div class="input">
		<label>Title Color</label>
		<div class="colorSelector"><div style=""></div></div>
		<input name="title_color" id="title_color" value="" maxlength="12" size="12" />
	</div>
    <div class="input">
        <label>Title Size (px)</label>
        <input name="title_size" id="title_size" value="" maxlength="100" size="55" />
    </div>
	<div class="input">
		<input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
	</div>
</form>
</div>