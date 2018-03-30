
jQuery(function($) {

    var form = jQuery('<div id="counter_circle-form"><table id="counter_circle-table" class="form-table">\
			<tr>\
				<th><label for="counter_circle-filledcolor">Filled Color</label></th>\
				<td><input type="text" name="filledcolor" id="counter_circle-filledcolor" value="" />\
				<br/><small>default: button hover background color</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-unfilledcolor">Unfilled Color</label></th>\
				<td><input type="text" name="unfilledcolor" id="counter_circle-unfilledcolor" value="" />\
				<br/><small>default: block background color</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-size">Circle Size *</label></th>\
				<td><input type="text" name="size" id="counter_circle-size" value="220" />\
				<br/><small>numerical value (unit: pixels)</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-speed">Animation Speed *</label></th>\
				<td><input type="text" name="speed" id="counter_circle-speed" value="1000" />\
				<br/><small>numerical value (unit: miliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-strokesize">Stroke Size *</label></th>\
				<td><input type="text" name="strokesize" id="counter_circle-strokesize" value="11" />\
				<br/><small>numerical value (unit: pixels)</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-percent">Filled Percent *</label></th>\
				<td><input type="text" name="percent" id="counter_circle-percent" value="100" />\
				<br/><small>numerical value (min: 0, max: 100)</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-desc">Description</label></th>\
				<td><textarea name="desc" id="counter_circle-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-desc_link">Description Link</label></th>\
				<td><input type="text" name="desc_link" id="counter_circle-desc_link" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-desc_fontsize">Description Font Size</label></th>\
				<td><input type="text" name="desc_fontsize" id="counter_circle-desc_fontsize" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-desc_color">Description Color</label></th>\
				<td><input type="text" name="desc_color" id="counter_circle-desc_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="counter_circle-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="counter_circle-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#counter_circle-submit').click(function(){

        var options = {
            'filledcolor'        : '',
            'unfilledcolor'      : '',
            'size'               : '220',
            'speed'              : '1000',
            'strokesize'         : '11',
            'percent'            : '100',
            'desc'               : '',
            'desc_link'          : '',
            'desc_fontsize'      : '',
            'desc_color'         : '',
            'class'              : ''
        };

        var shortcode = '[counter_circle';

        for( var index in options) {
            var value = table.find('#counter_circle-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Circle Content[/counter_circle]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="counter_box-form"><table id="counter_box-table" class="form-table">\
			<tr>\
				<th><label for="counter_box-value">Counter Value *</label></th>\
				<td><input type="text" name="value" id="counter_box-value" value="1000" />\
				<br/><small>numerical value</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_box-unit">Counter Unit</label></th>\
				<td><input type="text" name="unit" id="counter_box-unit" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_box-color">Counter Color</label></th>\
				<td><input type="text" name="color" id="counter_box-color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_box-link">Link URL</label></th>\
				<td><input type="text" name="link" id="counter_box-link" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_box-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="counter_box-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="counter_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#counter_box-submit').click(function(){

        var options = {
            'value' : '1000',
            'unit' : '',
            'color' : '',
            'link' : '',
            'class' : ''
        };

        var shortcode = '[counter_box';

        for( var index in options) {
            var value = table.find('#counter_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/counter_box]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});