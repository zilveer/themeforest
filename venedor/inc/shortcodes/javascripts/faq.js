
jQuery(function($) {

    var form = jQuery('<div id="faq-form"><table id="faq-table" class="form-table">\
			<tr>\
				<th><label for="faq-cats">FAQ Category IDs</label></th>\
				<td><input type="text" name="cats" id="faq-cats" value="0" />\
				<br/><small>Comma separated list of faq category ids.</small></td>\
			</tr>\
			<tr>\
				<th><label for="faq-filter">Show Filter</label></th>\
                <td><select name="filter" id="faq-filter">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="faq-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="faq-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="faq-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="faq-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="faq-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="faq-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="faq-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="faq-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="faq-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#faq-submit').click(function(){

        var options = {
            'cats'               : '0',
            'filter'             : 'false',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[faq';

        for( var index in options) {
            var value = table.find('#faq-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});