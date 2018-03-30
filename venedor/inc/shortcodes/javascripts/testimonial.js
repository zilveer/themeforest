
jQuery(function($) {

    var form = jQuery('<div id="testimonials-form"><table id="testimonials-table" class="form-table">\
			<tr>\
				<th><label for="testimonials-title">Title</label></th>\
				<td><input type="text" name="title" id="testimonials-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-type">Show Type</label></th>\
                <td><select name="type" id="testimonials-type">\
                ' + venedor_shortcode_testimonial_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="testimonials-color">Color</label></th>\
				<td><input type="text" name="color" id="testimonials-color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-shadow">Shadow</label></th>\
				<td><input type="text" name="shadow" id="testimonials-shadow" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-single_item">Single Item</label></th>\
				<td><select name="single_item" id="testimonials-single_item">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th colspan="2">if single item => false</th>\
			</tr>\
            <tr>\
				<th><label for="testimonials-items">Items</label></th>\
				<td><input type="text" name="items" id="testimonials-items" value="3" />\
				<br/><small>window width >= 1200px</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-items_desktop">Items on Desktop</label></th>\
				<td><input type="text" name="items_desktop" id="testimonials-items_desktop" value="3" />\
				<br/><small>992px <= window width < 1200px</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-items_desktop_small">Items on Small Desktop</label></th>\
				<td><input type="text" name="items_desktop_small" id="testimonials-items_desktop_small" value="2" />\
				<br/><small>768px <= window width < 992px</small></td>\
			</tr>\
            <tr>\
				<th>Items on Tablet, Microphone</th>\
				<td><strong>1</strong>\
				<br/><small>window width < 768px</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="testimonials-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="testimonials-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="testimonials-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="testimonials-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="testimonials-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="testimonials-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="testimonials-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="testimonials-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#testimonials-submit').click(function(){

        var options = {
            'title'              : '',
            'type'               : 'normal',
            'color'              : '',
            'shadow'             : '',
            'single_item'        : 'true',
            'items'              : '3',
            'items_desktop'      : '3',
            'items_desktop_small': '2',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[testimonials';

        for( var index in options) {
            var value = table.find('#testimonials-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Testimonial Shortcodes[/testimonials]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="testimonial-form"><table id="testimonial-table" class="form-table">\
			<tr>\
				<th><label for="testimonial-title">Title</label></th>\
				<td><input type="text" name="title" id="testimonial-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-name">Name</label></th>\
				<td><input type="text" name="name" id="testimonial-name" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-photo">Photo URL</label></th>\
				<td><input type="text" name="photo" id="testimonial-photo" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-link">Link URL</label></th>\
				<td><input type="text" name="link" id="testimonial-link" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-target">Link Target</label></th>\
				<td><select name="target" id="testimonial-target">\
                ' + venedor_shortcode_target() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="testimonial-date">Date</label></th>\
				<td><input type="text" name="date" id="testimonial-date" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="testimonial-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="testimonial-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="testimonial-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="testimonial-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonial-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="testimonial-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="testimonial-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#testimonial-submit').click(function(){

        var options = {
            'title'              : '',
            'name'               : '',
            'photo'              : '',
            'link'               : '',
            'target'             : '',
            'date'               : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[testimonial';

        for( var index in options) {
            var value = table.find('#testimonial-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/testimonial]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});