
jQuery(function($) {

    var form = jQuery('<div id="container-form"><table id="container-table" class="form-table">\
			<tr>\
				<th><label for="container-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="container-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="container-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="container-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="container-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="container-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="container-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="container-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="container-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#container-submit').click(function(){

        var options = {
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[container';

        for( var index in options) {
            var value = table.find('#container-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/container]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});