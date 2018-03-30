
jQuery(function($) {

    var form = jQuery('<div id="block-form"><table id="block-table" class="form-table">\
            <tr>\
				<th colspan="2"><strong>Input block id or name.</strong></th>\
			</tr>\
			<tr>\
				<th><label for="block-id">Block ID *</label></th>\
				<td><input type="text" name="id" id="block-id" value="" />\
				<br/><small>numerical value</small></td>\
			</tr>\
			<tr>\
				<th><label for="block-name">Block Name *</label></th>\
				<td><input type="text" name="name" id="block-name" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="block-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="block-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="block-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="block-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="block-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="block-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="block-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="block-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="block-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#block-submit').click(function(){

        var options = {
            'id'                 : '',
            'name'               : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[block';

        for( var index in options) {
            var value = table.find('#block-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});