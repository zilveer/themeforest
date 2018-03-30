<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>

<div id="qode_shortcode_form_wrapper">
	<form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
		<div class="input">
			<label>Type</label>
			<select name="team_type" id="team_type">
				<option class="" value="">Default</option>
				<option value="info_hover">Info on Hover</option>
			</select>
		</div>
		<div class="input">
			<label>Team Image</label>
			<input id="team_image" type="text" name="team_image" class="popup_image" value="" size="55" />
			<input class="upload_button" type="button" value="Upload file" id="popup_image_button">
		</div>
		<div class="input">
			<label>Image Hover Color</label>
			<div class="colorSelector"><div style=""></div></div>
			<input name="team_image_hover_color" id="team_image_hover_color" value="" size="10" />
		</div>
		<div class="input">
			<label>Team Name</label>
			<input name="team_name" id="team_name" type="text">
		</div>
		<div class="input">
            <label>Name Tag</label>
            <select name="team_name_tag" id="team_name_tag">
                <option value=""></option>
                <option value="h2">h2</option>
                <option value="h3">h3</option>
                <option value="h4">h4</option>
                <option value="h5">h5</option>
                <option value="h6">h6</option>
            </select>
        </div>
		<div class="input">
			<label>Name font size</label>
			<input name="team_name_font_size" id="team_name_font_size" type="text">
		</div>
		<div class="input">
			<label>Name Color</label>
			<div class="colorSelector"><div style=""></div></div>
			<input name="team_name_color" id="team_name_color" value="" size="10" />
		</div>
		<div class="input">
			<label>Name font weight</label>
			<select name="team_name_font_weight" id="team_name_font_weight">
				<option class="" value="">Default</option>
				<option value="100">Thin 100</option>
				<option value="200">Extra-Light 200</option>
				<option value="300">Light 300</option>
				<option value="400">Regular 400</option>
				<option value="500">Medium 500</option>
				<option value="600">Semi-Bold 600</option>
				<option value="700">Bold 700</option>
				<option value="800">Extra-Bold 800</option>
				<option value="900">Ultra-Bold 900</option>
			</select>
		</div>
		<div class="input">
			<label>Name text transform</label>
			<select name="team_name_text_transform" id="team_name_text_transform">
				<option class="" value="">Default</option>
				<option value="none">None</option>
				<option value="capitalize">Capitalize</option>
				<option value="uppercase">Uppercase</option>
				<option value="lowercase">Lowercase</option>
			</select>
		</div>
		<div class="input">
			<label>Position</label>
			<input name="team_position" id="team_position" type="text">
		</div>
		<div class="input">
			<label>Position font size(px)</label>
			<input name="team_position_font_size" id="team_position_font_size" type="text">
		</div>

		<div class="input">
			<label>Position Color</label>
			<div class="colorSelector"><div style=""></div></div>
			<input name="team_position_color" id="team_position_color" value="" size="10" />
		</div>
		<div class="input">
			<label>Position font weight</label>
			<select name="team_position_font_weight" id="team_position_font_weight">
				<option class="" value="">Default</option>
				<option value="100">Thin 100</option>
				<option value="200">Extra-Light 200</option>
				<option value="300">Light 300</option>
				<option value="400">Regular 400</option>
				<option value="500">Medium 500</option>
				<option value="600">Semi-Bold 600</option>
				<option value="700">Bold 700</option>
				<option value="800">Extra-Bold 800</option>
				<option value="900">Ultra-Bold 900</option>
			</select>
		</div>
		<div class="input">
			<label>Position text transform</label>
			<select name="team_position_text_transform" id="team_position_text_transform">
				<option class="" value="">Default</option>
				<option value="none">None</option>
				<option value="capitalize">Capitalize</option>
				<option value="uppercase">Uppercase</option>
				<option value="lowercase">Lowercase</option>
			</select>
		</div>
		<div class="input">
			<label>Description</label>
			<textarea name="team_description" id="team_description"></textarea>
		</div>
		<div class="input">
			<label>Description Color</label>
			<div class="colorSelector"><div style=""></div></div>
			<input name="team_description_color" id="team_description_color" value="" size="10" />
		</div>
		<div class="input">
			<label>Text Align</label>
			<select name="text_align" id="text_align">
				<option class="" value="">Default</option>
				<option value="left_align">Left</option>
				<option value="center_align">Center</option>
				<option value="right_align">Right</option>
			</select>
		</div>
		<div class="input">
			<label>Background Color</label>
			<div class="colorSelector"><div style=""></div></div>
			<input name="background_color" id="background_color" value="" size="10" />
		</div>
		<div class="input">
			<label>Box border</label>
			<select name="box_border" id="box_border">
				<option class="" value="">Default</option>
				<option value="no">No</option>
				<option value="yes">Yes</option>
			</select>
		</div>
		<div class="input">
			<label>Social Icon Pack</label>
			<select name="team_social_icon_pack" id="team_social_icon_pack">
				<option value="font_awesome">Font Awesome</option>
				<option value="font_elegant">Font Elegant</option>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 1 Font Awesome</label>
            <select id="team_social_fa_icon_1" name="team_social_fa_icon_1">
                <option value=""></option>
                <?php
                $fa_icons = qode_font_awesome_social();
                foreach ($fa_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
            </select>
		</div>
		<div class="input">
			<label>Social Icon 1 Font Elegant</label>
			<select name="team_social_fe_icon_1" id="team_social_fe_icon_1">
				<option value=""></option>
                <?php
                $fe_icons = qode_font_elegant_social();
                foreach ($fe_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 1 Link</label>
			<input name="team_social_icon_1_link" id="team_social_icon_1_link" type="text">
		</div>
		<div class="input">
			<label>Social Icon 1 Target</label>
			<select name="team_social_icon_1_target" id="team_social_icon_1_target">
				<option value="_self">Self</option>
				<option value="_blank">Blank</option>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 2 Font Awesome</label>
			<select name="team_social_fa_icon_2" id="team_social_fa_icon_2">
                <option value=""></option>
                <?php
                $fa_icons = qode_font_awesome_social();
                foreach ($fa_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 2 Font Elegant</label>
			<select name="team_social_fe_icon_2" id="team_social_fe_icon_2">
				<option value=""></option>
                <?php
                $fe_icons = qode_font_elegant_social();
                foreach ($fe_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 2 Link</label>
			<input name="team_social_icon_2_link" id="team_social_icon_2_link" type="text">
		</div>
		<div class="input">
			<label>Social Icon 2 Target</label>
			<select name="team_social_icon_2_target" id="team_social_icon_2_target">
				<option value="_self">Self</option>
				<option value="_blank">Blank</option>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 3 Font Awesome</label>
			<select name="team_social_fa_icon_3" id="team_social_fa_icon_3">
               <option value=""></option>
				<?php
                $fa_icons = qode_font_awesome_social();
                foreach ($fa_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 3 Font Elegant</label>
			<select name="team_social_fe_icon_3" id="team_social_fe_icon_3">
				<option value=""></option>
                <?php
                $fe_icons = qode_font_elegant_social();
                foreach ($fe_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 3 Link</label>
			<input name="team_social_icon_3_link" id="team_social_icon_3_link" type="text">
		</div>
		<div class="input">
			<label>Social Icon 3 Target</label>
			<select name="team_social_icon_3_target" id="team_social_icon_3_target">
				<option value="_self">Self</option>
				<option value="_blank">Blank</option>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 4 Font Awesome</label>
			<select name="team_social_fa_icon_4" id="team_social_fa_icon_4">
				<option value=""></option>
                <?php
                $fa_icons = qode_font_awesome_social();
                foreach ($fa_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 4 Font Elegant</label>
			<select name="team_social_fe_icon_4" id="team_social_fe_icon_4">
				<option value=""></option>
                <?php
                $fe_icons = qode_font_elegant_social();
                foreach ($fe_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 4 Link</label>
			<input name="team_social_icon_4_link" id="team_social_icon_4_link" type="text">
		</div>
		<div class="input">
			<label>Social Icon 4 Target</label>
			<select name="team_social_icon_4_target" id="team_social_icon_4_target">
				<option value="_self">Self</option>
				<option value="_blank">Blank</option>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 5 Font Awesome</label>
			<select name="team_social_fa_icon_5" id="team_social_fa_icon_5">
				<option value=""></option>
                <?php
                $fa_icons = qode_font_awesome_social();
                foreach ($fa_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 5 Font Elegant</label>
			<select name="team_social_fe_icon_5" id="team_social_fe_icon_5">
				<option value=""></option>
                <?php
                $fe_icons = qode_font_elegant_social();
                foreach ($fe_icons as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($key); ?></option>
                <?php
                }
                ?>
			</select>
		</div>
		<div class="input">
			<label>Social Icon 5 Link</label>
			<input name="team_social_icon_5_link" id="team_social_icon_5_link" type="text">
		</div>
		<div class="input">
			<label>Social Icon 5 Target</label>
			<select name="team_social_icon_5_target" id="team_social_icon_5_target">
				<option value="_self">Self</option>
				<option value="_blank">Blank</option>
			</select>
		</div>
		<div class="input">
			<label>Show Skills</label>
			<select name="show_skills" id="show_skills">
				<option value="yes">Yes</option>
				<option value="no">No</option>
			</select>
		</div>
		<div class="input">
			<label>Skills Title Size</label>
			<input name="skills_title_size" id="skills_title_size" type="text">
		</div>
		<div class="input">
			<label>First Skill Title (For example Web design)</label>
			<input name="skill_title_1" id="skill_title_1" type="text">
		</div>
		<div class="input">
			<label>First Skill Percentage (Enter just number, without %)</label>
			<input name="skill_percentage_1" id="skill_percentage_1" type="text">
		</div>

		<div class="input">
			<label>Second Skill Title (For example Web design)</label>
			<input name="skill_title_2" id="skill_title_2" type="text">
		</div>
		<div class="input">
			<label>Second Skill Percentage (Enter just number, without %)</label>
			<input name="skill_percentage_2" id="skill_percentage_2" type="text">
		</div>
		<div class="input">
			<label>Third Skill Title (For example Web design)</label>
			<input name="skill_title_3" id="skill_title_3" type="text">
		</div>
		<div class="input">
			<label>Third Skill Percentage (Enter just number, without %)</label>
			<input name="skill_percentage_3" id="skill_percentage_3" type="text">
		</div>

		<div class="input">
			<input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
		</div>
	</form>
</div>