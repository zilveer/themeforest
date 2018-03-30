
jQuery(function($) {

    var form = jQuery('<div id="background-form"><table id="background-table" class="form-table">\
			<tr>\
				<th><label for="background-bg_color">Background Color</label></th>\
				<td><input type="text" name="bg_color" id="background-bg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="background-image">Image URL *</label></th>\
				<td><input type="text" name="image" id="background-image" value="" />\
				<br/><small>ex: //example.com/image.png</small></td>\
			</tr>\
            <tr>\
				<th><label for="background-color">Text Color</label></th>\
				<td><input type="text" name="color" id="background-color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="background-link_color">Link Color</label></th>\
				<td><input type="text" name="link_color" id="background-link_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="background-padding">Padding</label></th>\
				<td><input type="text" name="padding" id="background-padding" value="30px 30px 30px 30px" /></td>\
			</tr>\
			<tr>\
				<th><label for="background-parallax">Parallax</label></th>\
				<td><input type="text" name="parallax" id="background-parallax" value="0" />\
				<br/><small>numerical value</small></td>\
			</tr>\
			<tr>\
				<th><label for="background-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="background-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="background-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="background-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="background-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="background-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="background-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="background-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="background-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#background-submit').click(function(){

        var options = {
            'bg_color'           : '',
            'image'              : '',
            'color'              : '',
            'link_color'         : '',
            'padding'            : '0 0 0 0',
            'parallax'           : '0',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[background';

        for( var index in options) {
            var value = table.find('#background-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/background]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});