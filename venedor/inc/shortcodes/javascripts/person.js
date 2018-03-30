
jQuery(function($) {

    var form = jQuery('<div id="persons-form"><table id="persons-table" class="form-table">\
			<tr>\
				<th><label for="persons-title">Title</label></th>\
				<td><input type="text" name="title" id="persons-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="persons-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="persons-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="persons-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="persons-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="persons-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="persons-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="persons-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="persons-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="persons-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="persons-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#persons-submit').click(function(){

        var options = {
            'title'              : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[persons';

        for( var index in options) {
            var value = table.find('#persons-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Person Shortcodes[/persons]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="person-form"><table id="person-table" class="form-table">\
			<tr>\
				<th><label for="person-name">Name *</label></th>\
				<td><input type="text" name="name" id="person-name" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-photo">Photo URL</label></th>\
				<td><input type="text" name="photo" id="person-photo" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-role">Role *</label></th>\
				<td><input type="text" name="role" id="person-role" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-facebook">Facebook</label></th>\
				<td><input type="text" name="facebook" id="person-facebook" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-twitter">Twitter</label></th>\
				<td><input type="text" name="twitter" id="person-twitter" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-dribbble">Dribbble</label></th>\
				<td><input type="text" name="dribbble" id="person-dribbble" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-pinterest">Pinterest</label></th>\
				<td><input type="text" name="pinterest" id="person-pinterest" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-instagram">Instagram</label></th>\
				<td><input type="text" name="instagram" id="person-instagram" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-linkedin">Linkedin</label></th>\
				<td><input type="text" name="linkedin" id="person-linkedin" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-tumblr">Tumblr</label></th>\
				<td><input type="text" name="tumblr" id="person-tumblr" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-youtube">Youtube</label></th>\
				<td><input type="text" name="youtube" id="person-youtube" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-email">Email</label></th>\
				<td><input type="text" name="email" id="person-email" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-phone">Phone</label></th>\
				<td><input type="text" name="phone" id="person-phone" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="person-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="person-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="person-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="person-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="person-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="person-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="person-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="person-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#person-submit').click(function(){

        var options = {
            'name'               : '',
            'photo'              : '',
            'role'               : '',
            'facebook'           : '',
            'twitter'            : '',
            'dribbble'           : '',
            'pinterest'          : '',
            'instagram'          : '',
            'linkedin'           : '',
            'tumblr'             : '',
            'youtube'            : '',
            'email'              : '',
            'phone'              : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[person';

        for( var index in options) {
            var value = table.find('#person-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/person]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="person_boxs-form"><table id="person_boxs-table" class="form-table">\
			<tr>\
				<th><label for="person_boxs-title">Title</label></th>\
				<td><input type="text" name="title" id="person_boxs-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="person_boxs-cols">Columns</label></th>\
				<td><input type="text" name="cols" id="person_boxs-cols" value="4" /></td>\
			</tr>\
			<tr>\
				<th><label for="person_boxs-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="person_boxs-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="person_boxs-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="person_boxs-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="person_boxs-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="person_boxs-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="person_boxs-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="person_boxs-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="person_boxs-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#person_boxs-submit').click(function(){

        var options = {
            'title'              : '',
            'cols'               : '4',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[person_boxs';

        for( var index in options) {
            var value = table.find('#person_boxs-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Person Box Shortcodes[/person_boxs]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="person_box-form"><table id="person_box-table" class="form-table">\
			<tr>\
				<th><label for="person_box-name">Name *</label></th>\
				<td><input type="text" name="name" id="person_box-name" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-photo">Photo URL</label></th>\
				<td><input type="text" name="photo" id="person_box-photo" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-role">Role *</label></th>\
				<td><input type="text" name="role" id="person_box-role" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-bg_color">Background Color</label></th>\
				<td><input type="text" name="bg_color" id="person_box-bg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-hbg_color">Hover Background Color</label></th>\
				<td><input type="text" name="hbg_color" id="person_box-hbg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="person_box-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="person_box-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="person_box-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="person_box-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="person_box-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="person_box-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="person_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#person_box-submit').click(function(){

        var options = {
            'name'               : '',
            'photo'              : '',
            'role'               : '',
            'bg_color'           : '',
            'hbg_color'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[person_box';

        for( var index in options) {
            var value = table.find('#person_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="persons_slider-form"><table id="persons_slider-table" class="form-table">\
			<tr>\
				<th><label for="persons_slider-title">Title</label></th>\
				<td><input type="text" name="title" id="persons_slider-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slider-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="persons_slider-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slider-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="persons_slider-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="persons_slider-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="persons_slider-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="persons_slider-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="persons_slider-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slider-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="persons_slider-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="persons_slider-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#persons_slider-submit').click(function(){

        var options = {
            'title'              : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[persons_slider';

        for( var index in options) {
            var value = table.find('#persons_slider-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Persons Slide Shortcodes[/persons_slider]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="persons_slide-form"><table id="persons_slide-table" class="form-table">\
			<tr>\
				<th><label for="persons_slide-name">Name *</label></th>\
				<td><input type="text" name="name" id="persons_slide-name" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-photo">Photo URL</label></th>\
				<td><input type="text" name="photo" id="persons_slide-photo" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-role">Role *</label></th>\
				<td><input type="text" name="role" id="persons_slide-role" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-link">Link URL</label></th>\
				<td><input type="text" name="link" id="persons_slide-link" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-target">Link Target</label></th>\
				<td><select name="target" id="persons_slide-target">\
                ' + venedor_shortcode_target() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-bg_color">Background Color</label></th>\
				<td><input type="text" name="bg_color" id="persons_slide-bg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-hbg_color">Hover Background Color</label></th>\
				<td><input type="text" name="hbg_color" id="persons_slide-hbg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="persons_slide-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="persons_slide-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="persons_slide-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="persons_slide-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="persons_slide-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="persons_slide-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="persons_slide-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#persons_slide-submit').click(function(){

        var options = {
            'name'               : '',
            'photo'              : '',
            'role'               : '',
            'link'               : '',
            'target'             : '',
            'bg_color'           : '',
            'hbg_color'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[persons_slide';

        for( var index in options) {
            var value = table.find('#persons_slide-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});