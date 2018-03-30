(function() {
    tinymce.create('tinymce.plugins.venue', {
        init: function(ed, url) {
            ed.addButton('venue', {
                title: 'venue',
                image: url + '/venue.png',
                onclick: function() {
                    // triggers the thickbox
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show('Our Venue Place', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=venue-form');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
        getInfo: function() {
            return {
                longname: "venue",
                author: 'ThemeonLab',
                authorurl: 'http://www.themeonlab.com',
                infourl: 'http://www.themeonlab.com',
                version: "1.0"
            };
        }
    });
    tinymce.PluginManager.add('venue', tinymce.plugins.venue);

    // executes this when the DOM is ready
    jQuery(function() {
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="venue-form"><table id="venue-table" class="form-table">\
			<tr>\
				<th><label for="venue-title">Text For Title</label></th>\
				<td><input type="text" name="text" id="venue-title" value="Some Dummy Title" /><br />\
                <small>Insert Title for your venue.</small></td>\
			</tr>\
			<tr>\
				<th><label for="venue-address">Venue Address</label></th>\
				<td><textarea name="content" id="venue-address" style="width:300px;height:180px;"></textarea><br />\
                <small>Insert Address.</small></td>\
			</tr>\
			<tr>\
				<th><label for="venue-content">Venue Content</label></th>\
				<td><textarea name="content" id="venue-content" style="width:300px;height:180px;"></textarea><br />\
                <small>Insert Content.</small></td>\
			</tr>\
			<tr>\
				<th><label for="venue-button_text">Button Text</label></th>\
				<td><input type="text" name="text" id="venue-button_text" value="More Info" /><br />\
                <small>Insert Button Text.</small></td>\
			</tr>\
                        <tr>\
				<th><label for="venue-link">Button Url</label></th>\
				<td><input type="url" name="url" id="venue-link" value="" /><br />\
                <small>Insert Like maps.google.com</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="venue-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#venue-submit').click(function() {
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = {
                'title': '',
                'address': '',
                'content': '',
                'button_text': '',
                'link': ''
            };
            var shortcode = '[rms-venue';

            for (var index in options) {
                var value = table.find('#venue-' + index).val();

                // attaches the attribute to the shortcode only if it's different from the default value
                if (value !== options[index])
                {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }

            shortcode += ']';

            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });
    });
})();