
jQuery(function($) {

    var form = jQuery('<div id="map-form"><table id="map-table" class="form-table">\
			<tr>\
				<th><label for="map-address">Address *</label></th>\
				<td><textarea name="address" id="map-address"></textarea>\
				<br/><small>"|" separated list of google map addresses.</small></td>\
			</tr>\
            <tr>\
				<th><label for="map-type">Type</label></th>\
                <td><select name="type" id="map-type">\
                ' + venedor_shortcode_gmap_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="map-width">Width</label></th>\
				<td><input type="text" name="width" id="map-width" value="100%" /></td>\
			</tr>\
            <tr>\
				<th><label for="map-height">Height</label></th>\
				<td><input type="text" name="height" id="map-height" value="300px" /></td>\
			</tr>\
            <tr>\
				<th><label for="map-zoom">Zoom Level</label></th>\
				<td><input type="text" name="zoom" id="map-zoom" value="14" /></td>\
			</tr>\
            <tr>\
				<th><label for="map-scrollwheel">Scroll Wheel</label></th>\
				<td><select name="scrollwheel" id="map-scrollwheel">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="map-scale">Show Scale</label></th>\
				<td><select name="scale" id="map-scale">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="map-zoom_pancontrol">Show Zoom Pan Control</label></th>\
				<td><select name="zoom_pancontrol" id="map-zoom_pancontrol">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="map-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="map-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="map-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="map-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="map-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="map-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="map-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="map-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="map-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#map-submit').click(function(){

        var options = {
            'address'            : '',
            'type'               : 'roadmap',
            'width'              : '100%',
            'height'             : '300px',
            'zoom'               : '14',
            'scrollwheel'        : 'true',
            'scale'              : 'true',
            'zoom_pancontrol'    : 'true',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[map';

        for( var index in options) {
            var value = table.find('#map-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});