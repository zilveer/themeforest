
jQuery(function($) {

    var form = jQuery('<div id="recent_posts-form"><table id="recent_posts-table" class="form-table">\
            <tr>\
				<th><label for="recent_posts-title">Title</label></th>\
				<td><input type="text" name="title" id="recent_posts-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-desc">Description</label></th>\
				<td><textarea name="desc" id="recent_posts-desc"></textarea></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-show_title">Show Post Title</label></th>\
				<td><select name="show_title" id="recent_posts-show_title">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-show_excerpt">Show Post Excerpt</label></th>\
				<td><select name="show_excerpt" id="recent_posts-show_excerpt">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-show_meta">Show Post Meta</label></th>\
				<td><select name="show_meta" id="recent_posts-show_meta">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-items">Posts Count</label></th>\
				<td><input type="text" name="items" id="recent_posts-items" value="6" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-cat">Category IDs</label></th>\
				<td><input type="text" name="cat" id="recent_posts-cat" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="recent_posts-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="recent_posts-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="recent_posts-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="recent_posts-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="recent_posts-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="recent_posts-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="recent_posts-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="recent_posts-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="recent_posts-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#recent_posts-submit').click(function(){

        var options = {
            'title'              : '',
            'desc'               : '',
            'show_title'         : 'true',
            'show_excerpt'       : 'true',
            'show_meta'          : 'true',
            'items'              : '6',
            'cat'                : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[recent_posts';

        for( var index in options) {
            var value = table.find('#recent_posts-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});