
jQuery(function($) {

    var form = jQuery('<div id="feature_box_slider-form"><table id="feature_box_slider-table" class="form-table">\
			<tr>\
				<th><label for="feature_box_slider-title">Title</label></th>\
				<td><input type="text" name="title" id="feature_box_slider-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box_slider-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="feature_box_slider-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box_slider-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="feature_box_slider-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="feature_box_slider-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="feature_box_slider-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box_slider-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="feature_box_slider-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box_slider-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="feature_box_slider-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="feature_box_slider-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#feature_box_slider-submit').click(function(){

        var options = {
            'title'              : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[feature_box_slider';

        for( var index in options) {
            var value = table.find('#feature_box_slider-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Feature Box Shortcodes[/feature_box_slider]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="feature_box-form"><table id="feature_box-table" class="form-table">\
			<tr>\
				<th><label for="feature_box-color">Text Color</label></th>\
				<td><input type="text" name="color" id="feature_box-color" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-hcolor">Text Hover Color</label></th>\
				<td><input type="text" name="hcolor" id="feature_box-hcolor" value="" /></td>\
			</tr>\
			<tr>\
				<th colspan="2"><strong>Configure with image or icon options.</strong></th>\
			</tr>\
			<tr>\
				<th><label for="feature_box-size">Image or Icon Wrapper Size</label></th>\
				<td><input type="text" name="size" id="feature_box-size" value="124" />\
				<br/><small>numerical value</small></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-type">Image or Icon Wrapper Type</label></th>\
				<td><select name="type" id="feature_box-type">\
                ' + venedor_shortcode_wrapper_type() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-image">Image URL</label></th>\
				<td><input type="text" name="image" id="feature_box-image" value="" />\
				<br/><small>ex: //example.com/image.png</small></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-image_bordercolor">Image Border Color</label></th>\
				<td><input type="text" name="image_bordercolor" id="feature_box-image_bordercolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-image_hbordercolor">Image Hover Border Color</label></th>\
				<td><input type="text" name="image_hbordercolor" id="feature_box-image_hbordercolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon">FontAwesome Icon Name</label></th>\
				<td><select name="icon" id="feature_box-icon">\
                ' + venedor_shortcode_fontawesome_icon() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_bg">Icon Background Color</label></th>\
				<td><input type="text" name="icon_bg" id="feature_box-icon_bg" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_hbg">Icon Hover Background Color</label></th>\
				<td><input type="text" name="icon_hbg" id="feature_box-icon_hbg" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_color">Icon Color</label></th>\
				<td><input type="text" name="icon_color" id="feature_box-icon_color" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_hcolor">Icon Hover Color</label></th>\
				<td><input type="text" name="icon_hcolor" id="feature_box-icon_hcolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_bordercolor">Icon Border Color</label></th>\
				<td><input type="text" name="icon_bordercolor" id="feature_box-icon_bordercolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_hbordercolor">Icon Hover Border Color</label></th>\
				<td><input type="text" name="icon_hbordercolor" id="feature_box-icon_hbordercolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-title">Title</label></th>\
				<td><input type="text" name="title" id="feature_box-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-link">Link</label></th>\
				<td><input type="text" name="link" id="feature_box-link" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-align">Align</label></th>\
				<td><select name="align" id="feature_box-align">\
                ' + venedor_shortcode_align_center() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-bg_color">Background Color</label></th>\
				<td><input type="text" name="bg_color" id="feature_box-bg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-hbg_color">Hover Background Color</label></th>\
				<td><input type="text" name="hbg_color" id="feature_box-hbg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-line_color">Line Color</label></th>\
				<td><input type="text" name="line_color" id="feature_box-line_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-line_hcolor">Line Hover Color</label></th>\
				<td><input type="text" name="line_hcolor" id="feature_box-line_hcolor" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-border">Hover Effect, Show Image or Icon Wrapper</label></th>\
				<td><select name="border" id="feature_box-border">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-show_bg">Show Background</label></th>\
				<td><select name="show_bg" id="feature_box-show_bg">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="feature_box-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="feature_box-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="feature_box-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="feature_box-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="feature_box-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="feature_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#feature_box-submit').click(function(){

        var options = {
            'color'              : '',
            'hcolor'             : '',
            'size'               : '124',
            'type'               : 'circle',
            'image'              : '',
            'image_bordercolor'  : '',
            'image_hbordercolor' : '',
            'icon'               : '',
            'icon_bg'            : '',
            'icon_hbg'           : '',
            'icon_color'         : '',
            'icon_hcolor'        : '',
            'icon_bordercolor'   : '',
            'icon_hbordercolor'  : '',
            'title'              : '',
            'link'               : '',
            'align'              : 'center',
            'bg_color'           : '',
            'hbg_color'          : '',
            'line_color'         : '',
            'line_hcolor'        : '',
            'border'             : 'true',
            'show_bg'            : 'false',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[feature_box';

        for( var index in options) {
            var value = table.find('#feature_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/feature_box]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});