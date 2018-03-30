
jQuery(function($) {

    var form = jQuery('<div id="sw_slider-form"><table id="sw_slider-table" class="form-table">\
			<tr>\
				<th><label for="sw_slider-pagination">Pagination</label></th>\
                <td><select name="pagination" id="sw_slider-pagination">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_slider-navigation">Navigation</label></th>\
                <td><select name="navigation" id="sw_slider-navigation">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_slider-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_slider-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_slider-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_slider-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_slider-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_slider-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_slider-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_slider-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_slider-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_slider-submit').click(function(){

        var options = {
            'pagination'         : 'false',
            'navigation'         : 'true',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_slider';

        for( var index in options) {
            var value = table.find('#sw_slider-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert SW Slide Shortcodes[/sw_slider]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="sw_slide-form"><table id="sw_slide-table" class="form-table">\
			<tr>\
				<th><label for="sw_slide-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_slide-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_slide-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_slide-submit').click(function(){

        var options = {
            'class'              : ''
        };

        var shortcode = '[sw_slide';

        for( var index in options) {
            var value = table.find('#sw_slide-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/sw_slide]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});