
jQuery(function($) {

    var form = jQuery('<div id="recent_portfolios-form"><table id="recent_portfolios-table" class="form-table">\
            <tr>\
				<th><label for="recent_portfolios-title">Title</label></th>\
				<td><input type="text" name="title" id="recent_portfolios-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-desc">Description</label></th>\
				<td><textarea name="desc" id="recent_portfolios-desc"></textarea></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-show_title">Show Portfolio Title</label></th>\
				<td><select name="show_title" id="recent_portfolios-show_title">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-show_cats">Show Portfolio Categories</label></th>\
				<td><select name="show_cats" id="recent_portfolios-show_cats">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-items">Portfolios Count</label></th>\
				<td><input type="text" name="items" id="recent_portfolios-items" value="6" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-cat">Category IDs</label></th>\
				<td><input type="text" name="cat" id="recent_portfolios-cat" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="recent_portfolios-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="recent_portfolios-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="recent_portfolios-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="recent_portfolios-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="recent_portfolios-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="recent_portfolios-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="recent_portfolios-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="recent_portfolios-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="recent_portfolios-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#recent_portfolios-submit').click(function(){

        var options = {
            'title'              : '',
            'desc'               : '',
            'show_title'         : 'true',
            'show_cats'          : 'true',
            'items'              : '6',
            'cat'                : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[recent_portfolios';

        for( var index in options) {
            var value = table.find('#recent_portfolios-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});