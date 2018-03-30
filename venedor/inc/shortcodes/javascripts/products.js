
jQuery(function($) {

    var form = jQuery('<div id="sw_bestseller_products-form"><table id="sw_bestseller_products-table" class="form-table">\
			<tr>\
				<th><label for="sw_bestseller_products-title">Title</label></th>\
				<td><input type="text" name="title" id="sw_bestseller_products-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-desc">Description</label></th>\
				<td><textarea name="desc" id="sw_bestseller_products-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-products">Products Count</label></th>\
				<td><input type="text" name="products" id="sw_bestseller_products-products" value="8" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-cats">Category IDs</label></th>\
				<td><input type="text" name="cats" id="sw_bestseller_products-cats" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-view">View Mode</label></th>\
				<td><select name="view" id="sw_bestseller_products-view">\
                ' + venedor_shortcode_view_mode() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-single">Single View</label></th>\
				<td><select name="single" id="sw_bestseller_products-single">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="sw_bestseller_products-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_bestseller_products-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_bestseller_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_bestseller_products-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_bestseller_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_bestseller_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_bestseller_products-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_bestseller_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_bestseller_products-submit').click(function(){

        var options = {
            'title'              : '',
            "desc"               : '',
            'products'           : '8',
            'cats'               : '',
            'view'               : 'grid',
            'single'             : 'false',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_bestseller_products';

        for( var index in options) {
            var value = table.find('#sw_bestseller_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="sw_featured_products-form"><table id="sw_featured_products-table" class="form-table">\
			<tr>\
				<th><label for="sw_featured_products-title">Title</label></th>\
				<td><input type="text" name="title" id="sw_featured_products-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-desc">Description</label></th>\
				<td><textarea name="desc" id="sw_featured_products-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-products">Products Count</label></th>\
				<td><input type="text" name="products" id="sw_featured_products-products" value="8" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-cats">Category IDs</label></th>\
				<td><input type="text" name="cats" id="sw_featured_products-cats" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-view">View Mode</label></th>\
				<td><select name="view" id="sw_featured_products-view">\
                ' + venedor_shortcode_view_mode() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-orderby">Order By</label></th>\
				<td><select name="orderby" id="sw_featured_products-orderby">\
                ' + venedor_shortcode_orderby() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-order">Order</label></th>\
				<td><select name="order" id="sw_featured_products-order">\
                ' + venedor_shortcode_order() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-single">Single View</label></th>\
				<td><select name="single" id="sw_featured_products-single">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="sw_featured_products-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_featured_products-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_featured_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_featured_products-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_featured_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_featured_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_featured_products-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_featured_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_featured_products-submit').click(function(){

        var options = {
            'title'              : '',
            "desc"               : '',
            'products'           : '8',
            'cats'               : '',
            'view'               : 'grid',
            'orderby'            : 'date',
            'order'              : 'desc',
            'single'             : 'false',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_featured_products';

        for( var index in options) {
            var value = table.find('#sw_featured_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});

jQuery(function($) {

    var form = jQuery('<div id="sw_sale_products-form"><table id="sw_sale_products-table" class="form-table">\
			<tr>\
				<th><label for="sw_sale_products-title">Title</label></th>\
				<td><input type="text" name="title" id="sw_sale_products-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-desc">Description</label></th>\
				<td><textarea name="desc" id="sw_sale_products-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-products">Products Count</label></th>\
				<td><input type="text" name="products" id="sw_sale_products-products" value="8" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-cats">Category IDs</label></th>\
				<td><input type="text" name="cats" id="sw_sale_products-cats" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-view">View Mode</label></th>\
				<td><select name="view" id="sw_sale_products-view">\
                ' + venedor_shortcode_view_mode() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-orderby">Order By</label></th>\
				<td><select name="orderby" id="sw_sale_products-orderby">\
                ' + venedor_shortcode_orderby() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-order">Order</label></th>\
				<td><select name="order" id="sw_sale_products-order">\
                ' + venedor_shortcode_order() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-single">Single View</label></th>\
				<td><select name="single" id="sw_sale_products-single">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="sw_sale_products-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_sale_products-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_sale_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_sale_products-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_sale_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_sale_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_sale_products-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_sale_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_sale_products-submit').click(function(){

        var options = {
            'title'              : '',
            "desc"               : '',
            'products'           : '8',
            'cats'               : '',
            'view'               : 'grid',
            'orderby'            : 'date',
            'order'              : 'desc',
            'single'             : 'false',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_sale_products';

        for( var index in options) {
            var value = table.find('#sw_sale_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});

jQuery(function($) {

    var form = jQuery('<div id="sw_latest_products-form"><table id="sw_latest_products-table" class="form-table">\
			<tr>\
				<th><label for="sw_latest_products-title">Title</label></th>\
				<td><input type="text" name="title" id="sw_latest_products-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-desc">Description</label></th>\
				<td><textarea name="desc" id="sw_latest_products-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-products">Products Count</label></th>\
				<td><input type="text" name="products" id="sw_latest_products-products" value="8" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-cats">Category IDs</label></th>\
				<td><input type="text" name="cats" id="sw_latest_products-cats" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-view">View Mode</label></th>\
				<td><select name="view" id="sw_latest_products-view">\
                ' + venedor_shortcode_view_mode() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-orderby">Order By</label></th>\
				<td><select name="orderby" id="sw_latest_products-orderby">\
                ' + venedor_shortcode_orderby() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-order">Order</label></th>\
				<td><select name="order" id="sw_latest_products-order">\
                ' + venedor_shortcode_order() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-single">Single View</label></th>\
				<td><select name="single" id="sw_latest_products-single">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="sw_latest_products-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_latest_products-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_latest_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_latest_products-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_latest_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_latest_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_latest_products-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_latest_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_latest_products-submit').click(function(){

        var options = {
            'title'              : '',
            "desc"               : '',
            'products'           : '8',
            'cats'               : '',
            'view'               : 'grid',
            'orderby'            : 'date',
            'order'              : 'desc',
            'single'             : 'false',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_latest_products';

        for( var index in options) {
            var value = table.find('#sw_latest_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});

