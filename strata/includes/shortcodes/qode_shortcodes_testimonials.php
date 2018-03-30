<?php
	$full_path = __FILE__;
	$path = explode('wp-content', $full_path);
	require_once( $path[0] . '/wp-load.php' );
?>
<div id="qode_shortcode_form_wrapper">
    <form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
        <div class="input">
            <label>Type</label>
            <select id="type" name="type">
                <option value="standard">Standard</option>
                <option value="full_width">Full width</option>
            </select>
        </div>
		<div class="input">
            <label>Content in Grid (only for Full Width)</label>
            <select id="content_in_grid" name="content_in_grid">
                <option value=""></option>
                <option value="0">No</option>
				<option value="1">Yes</option>
            </select>
        </div>
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
            <label>Background color</label>
			<div class="colorSelector"><div style=""></div></div>
            <input name="background_color" id="background_color" value="" maxlength="12" size="12" />
        </div>
		<div class="input">
            <label>Border color</label>
			<div class="colorSelector"><div style=""></div></div>
            <input name="border_color" id="border_color" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Show author image</label>
            <select id="author_image" name="author_image">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="input">
            <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
        </div>
    </form>
</div>