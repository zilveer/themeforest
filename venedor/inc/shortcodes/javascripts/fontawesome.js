
jQuery(function($) {

    var form = jQuery('<div id="fontawesome-form"><table id="fontawesome-table" class="form-table">\
			<tr>\
				<th><label for="fontawesome-icon">Icon Name *</label></th>\
				<td><select name="icon" id="fontawesome-icon">\
                ' + venedor_shortcode_fontawesome_icon() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="fontawesome-size">Icon Size</label></th>\
                <td><select name="size" id="fontawesome-size">\
                ' + venedor_shortcode_fontawesome_size() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="fontawesome-fontsize">Icon Font Size</label></th>\
				<td><input type="text" name="fontsize" id="fontawesome-fontsize" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="fontawesome-color">Icon Color</label></th>\
				<td><input type="text" name="color" id="fontawesome-color" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="fontawesome-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="fontawesome-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="fontawesome-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="fontawesome-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="fontawesome-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="fontawesome-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="fontawesome-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="fontawesome-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="fontawesome-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#fontawesome-submit').click(function(){

        var options = {
            'icon'               : '',
            'size'               : '',
            'fontsize'           : '',
            'color'              : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[fontawesome';

        for( var index in options) {
            var value = table.find('#fontawesome-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});