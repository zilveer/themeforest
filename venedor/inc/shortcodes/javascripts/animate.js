
jQuery(function($) {

    var form = jQuery('<div id="animate-form"><table id="animate-table" class="form-table">\
			<tr>\
				<th><label for="animate-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="animate-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="animate-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="animate-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="animate-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="animate-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="animate-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="animate-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="animate-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#animate-submit').click(function(){

        var options = {
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[animate';

        for( var index in options) {
            var value = table.find('#animate-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/animate]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});