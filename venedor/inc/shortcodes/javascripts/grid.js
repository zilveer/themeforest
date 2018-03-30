
jQuery(function($) {

    var form = jQuery('<div id="grid_container-form"><table id="grid_container-table" class="form-table">\
			<tr>\
				<th><label for="grid_container-grid_size">Grid Size</label></th>\
				<td><input type="text" name="grid_size" id="grid_container-grid_size" value="0px" />\
			</tr>\
			<tr>\
				<th><label for="grid_container-gutter_size">Gutter Size</label></th>\
				<td><input type="text" name="gutter_size" id="grid_container-gutter_size" value="5px" />\
			</tr>\
			<tr>\
				<th><label for="grid_container-max_width">Max Width</label></th>\
				<td><input type="text" name="max_width" id="grid_container-max_width" value="767px" />\
				<br/><small>will be show as grid only when window width > max width.</small></td>\
			</tr>\
			<tr>\
				<th><label for="grid_container-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="grid_container-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="grid_container-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#grid_container-submit').click(function(){

        var options = {
            'grid_size'          : '0px',
            'gutter_size'        : '5px',
            'max_width'          : '767px',
            'class'              : ''
        };

        var shortcode = '[grid_container';

        for( var index in options) {
            var value = table.find('#grid_container-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Grid Item Shortcodes[/grid_container]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="grid_item-form"><table id="grid_item-table" class="form-table">\
			<tr>\
				<th><label for="grid_item-gutter_size">Width</label></th>\
				<td><input type="text" name="width" id="grid_item-width" value="200px" />\
			</tr>\
			<tr>\
				<th><label for="grid_item-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="grid_item-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="grid_item-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#grid_item-submit').click(function(){

        var options = {
            'width'              : '200px',
            'class'              : ''
        };

        var shortcode = '[grid_item';

        for( var index in options) {
            var value = table.find('#grid_item-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/grid_item]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});