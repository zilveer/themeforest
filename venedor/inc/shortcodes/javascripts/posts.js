
jQuery(function($) {

    var form = jQuery('<div id="posts-form"><table id="posts-table" class="form-table">\
            <tr>\
				<th><label for="posts-title">Title</label></th>\
				<td><input type="text" name="title" id="posts-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="posts-layout">Layout</label></th>\
				<td><select name="layout" id="posts-layout">\
                ' + venedor_shortcode_blog_layout() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="posts-cat">Category IDs</label></th>\
				<td><input type="text" name="cat" id="posts-cat" value="" />\
				<br/><small>comma separated list of category ids</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts-post_in">Post IDs</label></th>\
				<td><input type="text" name="post_in" id="posts-post_in" value="" />\
                <br/><small>comma separated list of post ids</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts-count">Posts Count</label></th>\
				<td><input type="text" name="count" id="posts-count" value="10" /></td>\
			</tr>\
			<tr>\
				<th><label for="posts-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="posts-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="posts-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="posts-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="posts-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#posts-submit').click(function(){

        var options = {
            'title'              : '',
            'layout'             : 'grid',
            'cat'                : '',
            'post_in'            : '',
            'count'              : '10',
            'arrow_pos'          : '',
            'class'              : ''
        };

        var shortcode = '[posts';

        for( var index in options) {
            var value = table.find('#posts-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="posts_slider-form"><table id="posts_slider-table" class="form-table">\
            <tr>\
				<th><label for="posts_slider-title">Title</label></th>\
				<td><input type="text" name="title" id="posts_slider-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-desc">Description</label></th>\
				<td><textarea name="desc" id="posts_slider-desc"></textarea></td>\
			</tr>\
			<tr>\
				<th><label for="posts-cat">Category IDs</label></th>\
				<td><input type="text" name="cat" id="posts-cat" value="" />\
				<br/><small>comma separated list of category ids</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts-post_in">Post IDs</label></th>\
				<td><input type="text" name="post_in" id="posts-post_in" value="" />\
                <br/><small>comma separated list of post ids</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-show_title">Show Post Title</label></th>\
				<td><select name="show_title" id="posts_slider-show_title">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-show_excerpt">Show Post Excerpt</label></th>\
				<td><select name="show_excerpt" id="posts_slider-show_excerpt">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-show_meta">Show Post Meta</label></th>\
				<td><select name="show_meta" id="posts_slider-show_meta">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-count">Posts Count</label></th>\
				<td><input type="text" name="count" id="posts_slider-count" value="6" /></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="posts_slider-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="posts_slider-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="posts_slider-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="posts_slider-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="posts_slider-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="posts_slider-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="posts_slider-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#posts_slider-submit').click(function(){

        var options = {
            'title'              : '',
            'desc'               : '',
            'cat'                : '',
            'post_in'            : '',
            'show_title'         : 'true',
            'show_excerpt'       : 'true',
            'show_meta'          : 'true',
            'count'              : '6',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[posts_slider';

        for( var index in options) {
            var value = table.find('#posts_slider-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});