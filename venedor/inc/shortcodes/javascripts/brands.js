
jQuery(function($) {

    var form = jQuery('<div id="brands-form"><table id="brands-table" class="form-table">\
			<tr>\
				<th><label for="brands-title">Title</label></th>\
				<td><input type="text" name="title" id="brands-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="brands-single_item">Single Item</label></th>\
				<td><select name="single_item" id="brands-single_item">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th colspan="2"><strong>if single item => false</strong></th>\
			</tr>\
			<tr>\
				<th><label for="brands-items">Items</label></th>\
				<td><input type="text" name="items" id="brands-items" value="6" />\
				<br/><small>window width >= 1200px</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-items_desktop">Items on Desktop</label></th>\
				<td><input type="text" name="items_desktop" id="brands-items_desktop" value="4" />\
				<br/><small>992px <= window width < 1200px</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-items_desktop_small">Items on Small Desktop</label></th>\
				<td><input type="text" name="items_desktop_small" id="brands-items_desktop_small" value="3" />\
				<br/><small>768px <= window width < 992px</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-items_tablet">Items on Tablet</label></th>\
				<td><input type="text" name="items_tablet" id="brands-items_tablet" value="2" />\
				<br/><small>480px <= window width < 768px</small></td>\
			</tr>\
            <tr>\
				<th>Items on Microphone</th>\
				<td><strong>1</strong>\
				<br/><small>window width < 480px</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="brands-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="brands-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="brands-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="brands-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="brands-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="brands-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="brands-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="brands-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="brands-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#brands-submit').click(function(){

        var options = {
            'title'              : '',
            'single_item'        : 'false',
            'items'              : '6',
            'items_desktop'      : '4',
            'items_desktop_small': '3',
            'items_tablet'       : '2',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[brands';

        for( var index in options) {
            var value = table.find('#brands-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Brand Shortcodes[/brands]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="brand-form"><table id="brand-table" class="form-table">\
			<tr>\
				<th><label for="brand-image">Image URL *</label></th>\
				<td><input type="text" name="image" id="brand-image" value="" />\
				<br/><small>ex: //example.com/image.png</small></td>\
			</tr>\
            <tr>\
				<th><label for="brand-title">Title</label></th>\
				<td><input type="text" name="title" id="brand-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="brand-link">Link URL</label></th>\
				<td><input type="text" name="link" id="brand-link" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="brand-target">Link Target</label></th>\
				<td><select name="target" id="brand-target">\
                ' + venedor_shortcode_target() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="brand-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="brand-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="brand-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="brand-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="brand-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="brand-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="brand-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="brand-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="brand-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#brand-submit').click(function(){

        var options = {
            'title'              : '',
            'image'              : '',
            'link'               : '',
            'target'             : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[brand';

        for( var index in options) {
            var value = table.find('#brand-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});