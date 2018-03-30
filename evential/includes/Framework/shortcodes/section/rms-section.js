(function() {
    tinymce.create('tinymce.plugins.section', {
        init: function(ed, url) {
            ed.addButton('section', {
                title: 'Section',
                image: url + '/section.png',
                onclick: function() {
                    // triggers the thickbox
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show('Section Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=section-form');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
        getInfo: function() {
            return {
                longname: "Section",
                author: 'Themeonlab',
                authorurl: 'http://www.themeonlab.com',
                infourl: 'http://www.themeonlab.com',
                version: "1.0"
            };
        }
    });
    tinymce.PluginManager.add('section', tinymce.plugins.section);
    // executes this when the DOM is ready
    jQuery(function() {
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="section-form"><table id="section-table" class="form-table">\
			<tr>\
				<th><label for="section_formate">Section Type</label></th>\
				<td><select name="formate" id="section_formate" >\
                                <option value="Simple-Section">BG Color Section</option>\
                                <option value="Parallax-Section">BG Image Section</option>\
                                </select><br />\
				<small>Select Section Type.</small></td>\
			</tr>\
			<tr>\
				<th><label for="section_id">Section ID</label></th>\
				<td><input type="text" name="id" id="section_id" value="" /><br />\
				<small>ID For Menu Scrolling.</small></td>\
			</tr>\
			<tr>\
				<th><label for="section_class">CSS Class</label></th>\
				<td><input type="text" name="class" id="section_class" value="" /><br />\
				<small>Class Fro Custome CSS.</small></td>\
			</tr>\
			<tr>\
				<th><label for="section_bgimage">Background Image</label></th>\
				<td><input type="text" name="bgimage" id="section_bgimage" value="" /><br />\
				<small>Insert Section Background Image URL.</small></td>\
			</tr>\
			<tr>\
				<th><label for="section_bgcolor">Background Color</label></th>\
				<td><input type="text" name="bgcolor" id="section_bgcolor" value="" /><br />\
				<small>Insert Section Background Color With HEX Formate.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="section_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#section_submit').click(function() {
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = {
                'id': '',
                'formate': '',
                'class': '',
                'bgimage': '',
                'bgcolor': ''
            };
            var shortcode = '[rms-section';

            for (var index in options) {
                var value = table.find('#section_' + index).val();

                // attaches the attribute to the shortcode only if it's different from the default value
                if (value !== options[index])
                {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }

            shortcode += '][/rms-section]';

            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });
    });
})();