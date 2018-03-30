
jQuery(function($) {

    var form = jQuery('<div id="content_box-form"><table id="content_box-table" class="form-table">\
			<tr>\
				<th><label for="content_box-title">Title</label></th>\
				<td><input type="text" name="title" id="content_box-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="content_box-desc">Description</label></th>\
				<td><input type="text" name="desc" id="content_box-desc" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="content_box-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="content_box-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="content_box-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="content_box-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="content_box-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="content_box-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="content_box-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="content_box-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="content_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#content_box-submit').click(function(){

        var options = {
            'title'              : '',
            'desc'               : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[content_box';

        for( var index in options) {
            var value = table.find('#content_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/content_box]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});