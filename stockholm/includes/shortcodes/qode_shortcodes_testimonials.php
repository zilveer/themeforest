<?php
	$full_path = __FILE__;
	$path = explode('wp-content', $full_path);
	require_once( $path[0] . '/wp-load.php' );
?>
<div id="qode_shortcode_form_wrapper">
    <form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
		<div class="input">
            <label>Category (slug)</label>
            <input name="category" id="category" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Number</label>
            <input name="number" id="number" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Text color</label>
			<div class="colorSelector"><div style=""></div></div>
            <input name="text_color" id="text_color" value="" maxlength="12" size="12" />
        </div>
                <div class="input">
         <label>Text Font Size</label>
            <input name="text_font_size" id="text_font_size" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Author Text color</label>
			<div class="colorSelector"><div style=""></div></div>
            <input name="author_text_color" id="author_text_color" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Text Align</label>
            <select name="text_align" id="text_align">
                <option value="left_align">Left</option>
                <option value="center_align">Center</option>
                <option value="right_align">Right</option>
            </select>
        </div>
        <div class="input">
            <label>Show navigation</label>
            <select name="show_navigation" id="show_navigation">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="input">
            <label>Navigation Style</label>
            <select name="navigation_style" id="navigation_style">
                <option value="dark">Dark</option>
                <option value="light">Light</option>
            </select>
        </div>
        <div class="input">
            <label>Auto rotate slides</label>
            <select name="auto_rotate_slides" id="auto_rotate_slides">
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="0">Disable</option>
            </select>
        </div>
        <div class="input">
            <label>Animation Type</label>
            <select name="animation_type" id="animation_type">
                <option value="fade">Fade</option>
                <option value="slide">Slide</option>
            </select>
        </div>
        <div class="input">
            <label>Animation speed</label>
            <input name="animation_speed" id="animation_speed" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
        </div>
    </form>
</div>