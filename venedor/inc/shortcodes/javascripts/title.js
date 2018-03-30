
jQuery(function($) {

    var form = jQuery('<div id="title-form"><table id="title-table" class="form-table">\
			<tr>\
				<th><label for="title-title">Title</label></th>\
				<td><input type="text" name="title" id="title-class" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-title_transform">Title Text Transform</label></th>\
				<td><select name="title_transform" id="title-title_transform">\
                ' + venedor_shortcode_transform() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="title-title_fontsize">Title Font Size</label></th>\
				<td><input type="text" name="title_fontsize" id="title-title_fontsize" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-desc">Description</label></th>\
				<td><textarea name="desc" id="title-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="title-desc_fontsize">Desc Font Size</label></th>\
				<td><input type="text" name="desc_fontsize" id="title-desc_fontsize" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-size">Title Size</label></th>\
				<td><select name="size" id="title-size">\
                ' + venedor_shortcode_title_size() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="title-show_line">Show Line</label></th>\
				<td><select name="show_line" id="title-show_line">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="title-line_pos">Line Position</label></th>\
				<td><select name="line_pos" id="title-line_pos">\
                ' + venedor_shortcode_line_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="title-line_width">Line Width</label></th>\
				<td><input type="text" name="line_width" id="title-line_width" value="40px" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-line_color">Line Color</label></th>\
				<td><input type="text" name="line_color" id="title-line_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-align">Align</label></th>\
                <td><select name="align" id="title-align">\
                ' + venedor_shortcode_align_center() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="title-color">Text Color</label></th>\
				<td><input type="text" name="color" id="title-color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-shadow">Text Shadow</label></th>\
				<td><input type="text" name="shadow" id="title-shadow" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="title-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="title-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="title-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="title-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="title-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="title-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="title-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="title-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#title-submit').click(function(){

        var options = {
            'title'              : '',
            'title_transform'    : '',
            'title_fontsize'     : '',
            'desc'               : '',
            'desc_fontsize'      : '',
            'size'               : '',
            'show_line'          : 'true',
            'line_pos'           : 'middle',
            'line_width'         : '40px',
            'line_color'         : '',
            'align'              : 'center',
            'color'              : '',
            'shadow'             : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[title';

        for( var index in options) {
            var value = table.find('#title-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});