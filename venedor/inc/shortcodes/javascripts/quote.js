
jQuery(function($) {

    var form = jQuery('<div id="quote-form"><table id="quote-table" class="form-table">\
			<tr>\
				<th><label for="quote-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="quote-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="quote-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="quote-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="quote-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="quote-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="quote-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="quote-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="quote-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#quote-submit').click(function(){

        var options = {
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[quote';

        for( var index in options) {
            var value = table.find('#quote-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/quote]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});