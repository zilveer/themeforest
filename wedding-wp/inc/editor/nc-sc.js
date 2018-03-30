// closure to avoid namespace collision
/*
 * ALERT BUTTON
 */
(function() {
    tinymce.create('tinymce.plugins.alert', {
        init: function(ed, url) {
            ed.addButton('alert', {
                title: 'Alert',
                image: url + '/alert-ico.png',
                onclick: function() {

                    alert_form();
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');

                    tb_show('Alert | Webnus theme shortcode manager', '#TB_inline?width=900&inlineId=alert-form');
                    jQuery('#TB_window').center();
                    jQuery('#TB_window').css('height', '250');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('alert', tinymce.plugins.alert);



    function alert_form()
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this

        /*
         * 
         * <tr>\
         <th><label for="testimonial-form-title">Title</label></th>\
         <td><input type="text" name="testimonial-form-title" id="testimonial-form-title" value="Title"  /><br />\
         <small>Specify the Testimonial Title.</small>\
         </tr>\
         */

        var form = jQuery('<div id="alert-form"><table id="alert-table" class="form-table">\
				<tr>\
				<th><label for="alert-form-type">Type</label></th>\
				<td><select  name="alert-form-type" id="alert-form-type">\
				<option value="info">Info</option><option value="success">Success</option><option value="warning">Warning</option><option value="danger">Danger</option></select><br />\
				<small>Alert Type</small>\
				</tr>\
				<tr>\
				<th><label for="alert-form-close">Close Button</label></th>\
				<td><input type="checkbox" name="alert-form-close" id="alert-form-close" value="yes"   /><br />\
				<small>Has Close Button?</small>\
				</tr>\
				</table>\
				<p class="submit">\
				<input type="button" id="alert-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();


        form.find('#alert-form-submit').click(function() {
            var type = table.find("#alert-form-type").val();
            if(table.find("#alert-form-close:checked").attr('checked'))
			var close = 'true';
			else
			var close = 'false';
			

            var shortcode = '[alert type="' + type + '" close="' + close + '"]Content Text[/alert]';



            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }
})(jQuery);

/*
 * BUTTON
 */
(function() {
    tinymce.create('tinymce.plugins.webnus_button', {
        init: function(ed, url) {
            ed.addButton('webnus_button', {
                title: 'Button',
                image: url + '/button-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                    button_form();
                    tb_show('Button | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=button-form');

                    jQuery('#TB_ajaxContent').css('height', 660);
                    jQuery('#TB_window').css('height', 660);
                    jQuery('#TB_window').center();

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('webnus_button', tinymce.plugins.webnus_button);


    function button_form()
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="button-form"><table id="button-table" class="form-table">\
				<tr>\
					<th><label for="button-form-url">URL</label></th>\
					<td><input type="text" name="button-form-url" id="button-form-url" value="http://"  /><br />\
					<small>Specify the Button URL.</small>\
				</tr>\
				<tr>\
					<th><label for="button-form-target">Target</label></th>\
					<td><select id="button-form-target"><option value="_blank">Blank</option><option value="_self">Self</option><option value="_parent">Parent</option><option value="_top">Top</option></select><br />\
					<small>Specify the Button Target.</small></td>\
				</tr>\
				<tr>\
					<th><label for="button-form-color">Color</label></th>\
					<td><select id="button-form-color"><option value="green">Green</option><option value="red">Red</option><option value="blue">Blue</option><option value="gray">Gray</option><option value="cherry">Cherry</option><option value="orchid">Orchid</option><option value="pink">Pink</option><option value="orange">Orange</option><option value="teal">Teal</option><option value="skyblue">Skyblue</option><option value="jade">Jade</option></select><br />\
					<small>Specify the Button Color.</small></td>\
				</tr>\
				<tr>\
					<th><label for="button-form-size">Size</label></th>\
					<td><select id="button-form-size"><option value="medium">Medium</option><option value="small">Small</option><option value="large">Large</option></select><br />\
					<small>Specify the Button Target.</small></td>\
				</tr>\
				<tr>\
					<th><label for="button-form-border">Border</label></th>\
					<td><select id="button-form-border"><option value="false">Normal</option><option value="true">Bordered</option><br />\
					<small>Specify the Border Type.</small></td>\
				</tr>\
				<tr>\
					<th><label for="button-form-icon">Icon</label></th>\
					<td><input type="text" name="button-form-icon" id="button-form-icon" value=""  /><br />\
					<small>Specify the Button Icon.</small>\
				</tr>\
				<tr>\
					<th><label for="button-form-text">Text</label></th>\
					<td><input type="text" name="button-form-text" id="button-form-text" value="Button Text"  /><br />\
					<small>Specify the Button Target.</small></td>\
				</tr>\
				</table>\
				<p class="submit">\
				<input type="button" id="button-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#button-form-submit').click(function() {
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var button_form_url = table.find("#button-form-url").val();
            var button_form_target = table.find("#button-form-target option:selected").val();
            var button_form_color = table.find("#button-form-color option:selected").val();
            var button_form_size = table.find("#button-form-size option:selected").val();
            var button_form_text = table.find("#button-form-text").val();
			var button_form_border = table.find("#button-form-border").val();
			var button_form_icon = table.find("#button-form-icon").val();





            var shortcode = '[button url="' + button_form_url + '" target="' + button_form_target + '" color="' + button_form_color + '" size="' + button_form_size + '" border="' + button_form_border + '" icon="' + button_form_icon +  '"]'+button_form_text+'[/button]';
            // inserts the shortcode into the active editor

            if (tinyMCE.activeEditor.selection.getContent() != '') {
                tinyMCE.activeEditor.selection.setContent('[button url="' + button_form_url + '" target="' + button_form_target + '" color="' + button_form_color + '" size="' + button_form_size + '" border="' + button_form_border + '" icon="' + button_form_icon + '"]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
            } else
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }


})(jQuery);





/*
 * Highlight
 */
(function() {
    tinymce.create('tinymce.plugins.highlight', {
        init: function(ed, url) {
            ed.addButton('highlight', {
                title: 'Highlight',
                image: url + '/highlight-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                    highlight_form();
                    tb_show('Highlight | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=highlight-form');
                    jQuery('#TB_window').css('height', 150);
                    jQuery('#TB_window').center();

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('highlight', tinymce.plugins.highlight);



    function highlight_form()
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="highlight-form"><table id="highlight-table" class="form-table">\
				<tr>\
					<th><label for="highlight-form-no">Highlight</label></th>\
					<td><select id="highlight-form-no"><option value="highlight1">Highlight 1</option><option value="highlight2">Highlight 2</option><option value="highlight3">Highlight 3</option><option value="highlight4">Highlight 4</option></select><br />\
					<small>Specify the Highlight.</small></td>\
				</tr>\
				</table>\
				<p class="submit">\
				<input type="button" id="highlight-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();


        form.find('#highlight-form-submit').click(function() {
            var highlight_form_no = table.find("#highlight-form-no option:selected").val();

            var shortcode = '[' + highlight_form_no + ']Default Highlight Text[/' + highlight_form_no + ']';


            if (tinyMCE.activeEditor.selection.getContent() != '') {
                tinyMCE.activeEditor.selection.setContent('[' + highlight_form_no + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + highlight_form_no + ']');
            } else
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }



})(jQuery);




/*
 * Dropcap
 */
(function() {
    tinymce.create('tinymce.plugins.dropcap', {
        init: function(ed, url) {
            ed.addButton('dropcap', {
                title: 'Dropcap',
                image: url + '/dropcap-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                    dropcap_form();
                    tb_show('Dropcap | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=dropcap-form');
                    jQuery('#TB_window').css('height', 150);
                    jQuery('#TB_window').center();

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);

    function dropcap_form()
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="dropcap-form"><table id="dropcap-table" class="form-table">\
				<tr>\
					<th><label for="dropcap-form-no">Dropcap</label></th>\
					<td><select id="dropcap-form-no"><option value="dropcap1">Dropcap 1</option><option value="dropcap2">Dropcap 2</option><option value="dropcap3">Dropcap 3</option></select><br />\
					<small>Specify the Dropcap.</small></td>\
				</tr>\
				</table>\
				<p class="submit">\
				<input type="button" id="dropcap-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();


        form.find('#dropcap-form-submit').click(function() {
            var dropcap_form_no = table.find("#dropcap-form-no option:selected").val();

            var shortcode = '[' + dropcap_form_no + ']Default Dropcap Text[/' + dropcap_form_no + ']';


            if (tinyMCE.activeEditor.selection.getContent() != '') {
                tinyMCE.activeEditor.selection.setContent('[' + dropcap_form_no + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + dropcap_form_no + ']');
            } else
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }



})(jQuery);




/*
 * List
 */
(function() {
    tinymce.create('tinymce.plugins.list', {
        init: function(ed, url) {
            ed.addButton('list', {
                title: 'List',
                image: url + '/list-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                    list_form();
                    tb_show('List | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=list-form');
                    jQuery('#TB_window').css('height', 150);
                    jQuery('#TB_window').center();

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('list', tinymce.plugins.list);

    function list_form()
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="list-form"><table id="list-table" class="form-table">\
				<tr>\
					<th><label for="list-form-type">List Types</label></th>\
					<td><select id="list-form-type"><option value="check">Check</option><option value="plus">Plus</option><option value="minus">Minus</option><option value="star">Star</option><option value="arrow">Arrow</option><option value="arrow2">Arrow 2</option><option value="square">Square</option><option value="circle">Circle</option><option value="cross">Cross</option></select><br />\
					<small>List type attributes.</small></td>\
				</tr>\
				</table>\
				<p class="submit">\
				<input type="button" id="list-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();


        form.find('#list-form-submit').click(function() {
            var list_form_type = table.find("#list-form-type option:selected").val();

            var shortcode = '[list-ul type="' + list_form_type + '"][li-row]Defalt List Item 1[/li-row][li-row]Defalt List Item 2[/li-row][/list-ul]';


            if (tinyMCE.activeEditor.selection.getContent() != '') {
                tinyMCE.activeEditor.selection.setContent('[list-ul type="' + list_form_type + '"][li-row]' + tinyMCE.activeEditor.selection.getContent() + '[/li-row][/list-ul]');
            } else
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }



})(jQuery);

/*
 * Clear Shortcode
 */

(function() {
    tinymce.create('tinymce.plugins.clear', {
        init: function(ed, url) {
            ed.addButton('clear', {
                title: 'Clear',
                image: url + '/clear-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[clear]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('clear', tinymce.plugins.clear);
})(jQuery);




/*
 * Line Shortcode
 */

(function() {
    tinymce.create('tinymce.plugins.line', {
        init: function(ed, url) {
            ed.addButton('line', {
                title: 'Line',
                image: url + '/separator-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                     line_form();
					
					tb_show('Line | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=line-form');

                    jQuery('#TB_window').css('height', 150);
					jQuery('#TB_window').css('width', 400);
					
                    jQuery('#TB_window').center();

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('line', tinymce.plugins.line);


 function line_form() //Line
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="line-form"><table id="line-table" class="form-table">\
				<tr>\
					<th><label for="line-type">Type</label></th>\
					<td><select id="line-type"><option value="1">Line</option><option value="2">Thick Line</option></select><br />\
					<small>Line Type</small>\
					</tr></table>\
				<p class="submit">\
				<input type="button" id="line-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#line-submit').click(function() {

            var line_type = table.find("#line-type option:selected").val();
            
			var shortcode='';
			if(line_type==1)
				shortcode = '[line]';
			else
				shortcode = '[tline]';
			

            
            // inserts the shortcode into the active editor


            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }

	
})(jQuery);





/*
 * Tab
 */
(function() {
    tinymce.create('tinymce.plugins.tab', {
        init: function(ed, url) {
            ed.addButton('tab', {
                title: 'Tab',
                image: url + '/tab-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                    tab_form();
                    tb_show('Tab | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=tab-form');

                    jQuery('#TB_window').center();

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('tab', tinymce.plugins.tab);

    function tab_form()
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="tab-form"><table id="tab-table" class="form-table">\
				<tr>\
					<td><label for="tab-form-title">Tab ID</label></td>\
					<td><input type="text" id[]="tab-form-title" name[]="tab-form-title" value="Tab1" class="tab-form-title"/>Is default? &nbsp; <input type="checkbox" id="tab-form-active[]" name="tab-form_active[]" value="1" class="tab-form-active"/><br />\
					<small>Tab title attribute.</small></td>\
				</tr>\
				<tr>\
					<td><input type="button" id="add-tab" class="button-primary" value="Add Tab" name="submit" /></td>\
					<td></td>\
				</tr>\
				</table>\
				<p class="submit">\
				<input type="button" id="tab-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        var new_tr = '<tr><td><label for="tab-form-title">Tab ID</label></td>\
					<td><input type="text" id[]="tab-form-title" name[]="tab-form-title" value="Tab ID" class="tab-form-title"/>Is default? &nbsp; <input type="checkbox" id="tab-form-active[]" name="tab-form_active[]" value="1" class="tab-form-active"/><br />\
					<small>Tab ID attribute.</small></td>\
				</tr>\ ';


        form.find('#add-tab').click(function() {


            table.find("tr:last").before(new_tr);

        });


        form.find('#tab-form-submit').click(function() {

            var tab_title = [];
            var tab_active = [];
            table.find('input[type=text]').each(function(i, e) {

                tab_title.push(this.value);

                if (jQuery(this).closest('tr').find(':checkbox').attr('checked'))
                    tab_active.push(true);
                else
                    tab_active.push(false);

            });

            var tabgroup = "[tabgroup]";
            for (i = 0; i < tab_title.length; i++)
            {

                if (tab_active[i])
                    tabgroup += '[tab title="' + tab_title[i] + '" state="active"] Content of Tab  [/tab]';
                else
                    tabgroup += '[tab title="' + tab_title[i] + '"] Content of Tab  [/tab]';
            }
            tabgroup += "[/tabgroup]";



            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, tabgroup);



            //alert(tabgroup);
            // closes Thickbox
            tb_remove();
        });


        jQuery('.tab-form-active').live("click", function() {

            //table.find('input[type=text]').each(function(i,e){
            jQuery('.tab-form-active').removeAttr('checked');

            jQuery(this).attr('checked', 'checked');


            // closes Thickbox
            //tb_remove();
        });
        //end live

    }



})(jQuery);



/*
 * Left Tab
 */
(function() {
    tinymce.create('tinymce.plugins.lefttab', {
        init: function(ed, url) {
            ed.addButton('lefttab', {
                title: 'Left Tab',
                image: url + '/leftnav-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                    navtab_form();
                    tb_show('Left Tab | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=navtab-form');

                    jQuery('#TB_window').center();


                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('lefttab', tinymce.plugins.lefttab);



    function navtab_form()
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="navtab-form"><table id="navtab-table" class="form-table">\
				<tr>\
					<td><label for="tab-form-title">Tab ID</label></td>\
					<td><input type="text" id[]="tab-form-title" name[]="tab-form-title" value="Tab1" class="tab-form-title"/>Is default? &nbsp; <input type="checkbox" id="tab-form-active[]" name="tab-form_active[]" value="1" class="tab-form-active"/><br />\
					<small>Tab title attribute.</small></td>\
				</tr>\
				<tr>\
					<td><input type="button" id="add-tab" class="button-primary" value="Add Tab" name="submit" /></td>\
					<td></td>\
				</tr>\
				</table>\
				<p class="submit">\
				<input type="button" id="tab-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        var new_tr = '<tr><td><label for="tab-form-title">Tab ID</label></td>\
					<td><input type="text" id[]="tab-form-title" name[]="tab-form-title" value="Tab1" class="tab-form-title"/>Is default? &nbsp; <input type="checkbox" id="tab-form-active[]" name="tab-form_active[]" value="1" class="tab-form-active"/><br />\
					<small>Tab ID attribute.</small></td>\
				</tr>\ ';


        form.find('#add-tab').click(function() {


            table.find("tr:last").before(new_tr);

        });


        form.find('#tab-form-submit').click(function() {

            var tab_title = [];
            var tab_active = [];
            table.find('input[type=text]').each(function(i, e) {

                tab_title.push(this.value);

                if (jQuery(this).closest('tr').find(':checkbox').attr('checked'))
                    tab_active.push(true);
                else
                    tab_active.push(false);

            });

            var tabgroup = "[lefttab]";
            for (i = 0; i < tab_title.length; i++)
            {

                if (tab_active[i])
                    tabgroup += '[tab title="' + tab_title[i] + '" state="active"] Content of Tab  [/tab]';
                else
                    tabgroup += '[tab title="' + tab_title[i] + '"] Content of Tab  [/tab]';
            }
            tabgroup += "[/lefttab]";



            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, tabgroup);



            //alert(tabgroup);
            // closes Thickbox
            tb_remove();
        });


        jQuery('.tab-form-active').live("click", function() {

            //table.find('input[type=text]').each(function(i,e){
            jQuery('.tab-form-active').removeAttr('checked');

            jQuery(this).attr('checked', 'checked');


            // closes Thickbox
            //tb_remove();
        });
        //end live

    }




})(jQuery);



/*
 * Accordion Shortcode
 */

(function() {
    tinymce.create('tinymce.plugins.accordion', {
        init: function(ed, url) {
            ed.addButton('accordion', {
                title: 'Accordion',
                image: url + '/accordion-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[accordion title="Accordion title"]' + tinyMCE.activeEditor.selection.getContent() + '[/accordion]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
})(jQuery);



/*
 * RecentWorks
 */
(function() {
    tinymce.create('tinymce.plugins.homerecentworks', {
        init: function(ed, url) {
            ed.addButton('homerecentworks', {
                title: 'Recent Works',
                image: url + '/latestprojets-ico.png',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[recentworks]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('homerecentworks', tinymce.plugins.homerecentworks);

})(jQuery);





/*
 * Progress Bar
 */
(function() {
    tinymce.create('tinymce.plugins.progressbar', {
        init: function(ed, url) {
            ed.addButton('progressbar', {
                title: 'ProgressBar',
                image: url + '/progress-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                    progressbar_form();
                    tb_show('ProgressBar | Webnus theme shortcode manager', '#TB_inline?width=900&inlineId=progressbar-form');
                    jQuery('#TB_window').center();
                    jQuery('#TB_window').css('height', '280');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('progressbar', tinymce.plugins.progressbar);



    function progressbar_form()
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this

        /*
         * 
         * <tr>\
         <th><label for="testimonial-form-title">Title</label></th>\
         <td><input type="text" name="testimonial-form-title" id="testimonial-form-title" value="Title"  /><br />\
         <small>Specify the Testimonial Title.</small>\
         </tr>\
         */

        var form = jQuery('<div id="progressbar-form"><table id="progressbar-table" class="form-table">\
				<tr>\
				<th><label for="progressbar-form-type">Type</label></th>\
				<td><select  name="progressbar-form-type" id="progressbar-form-type">\
				<option value="info">Blue</option><option value="success">Green</option><option value="warning">Orange</option><option value="danger">Red</option></select><br />\
				<small>Progressbar Type</small>\
				</tr>\
				<tr>\
				<th><label for="progressbar-form-percent">Percent</label></th>\
				<td><input type="text" name="progressbar-form-percent" id="progressbar-form-percent" value="50"  /><br />\
				<small>Progressbar Percent.</small>\
				</tr>\
				<tr>\
				<th><label for="progressbar-form-text">Text</label></th>\
				<td><input type="text" name="progressbar-form-text" id="progressbar-form-text" value="Sample"  /><br />\
				<small>Progressbar Text.</small>\
				</tr>\
				</table>\
				<p class="submit">\
				<input type="button" id="progressbar-form-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();


        form.find('#progressbar-form-submit').click(function() {
            var progressbar_type = table.find("#progressbar-form-type").val();
            var progressbar_percent = table.find("#progressbar-form-percent").val();
			var progressbar_text = table.find("#progressbar-form-text").val();

            var shortcode = '[progress type="' + progressbar_type + '" percent="' + progressbar_percent + '" text="'+progressbar_text +'"]';



            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }
})(jQuery);


/*
 * Flex
 */
(function() {
    tinymce.create('tinymce.plugins.flex', {
        init: function(ed, url) {
            ed.addButton('flex', {
                title: 'Flex Slider',
                image: url + '/flexslider-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[flexslider][flexitem img="" alt=""][flexitem img="" alt=""][/flexslider]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('flex', tinymce.plugins.flex);


})(jQuery);




/*
 * CallOut
 */
(function() {
    tinymce.create('tinymce.plugins.callout', {
        init: function(ed, url) {
            ed.addButton('callout', {
                title: 'Callout (promobox)',
                image: url + '/callout-ico.png',
                onclick: function() {

                    callout_form();
                    tb_show('Callout | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=callout-form');

                    jQuery('#TB_window').css('height', 350);
                    jQuery('#TB_window').center();
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('callout', tinymce.plugins.callout);

    function callout_form() //otype [ourteam 1 or ourteam 2]
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="callout-form"><table id="callout-table" class="form-table">\
				<tr>\
					<th><label for="callout-title">Title</label></th>\
					<td><input type="text" name="callout-title" id="callout-title" value=""  /><br />\
					<small>CallOut Title</small>\
				</tr>\
				<tr>\
					<th><label for="callout-text">Text</label></th>\
					<td><input type="text" name="callout-text" id="callout-text" value=""  /><br />\
					<small>CallOut Text</small>\
				</tr>\
                                <tr>\
					<th><label for="callout-buttontext">Button Text</label></th>\
					<td><input type="text" name="callout-buttontext" id="callout-buttontext" value=""  /><br />\
					<small>CallOut Button Text</small>\
				</tr>\
                                <tr>\
					<th><label for="callout-buttonlink">Button Link</label></th>\
					<td><input type="text" name="callout-buttonlink" id="callout-buttonlink" value=""  /><br />\
					<small>CallOut Button Link</small>\
				</tr>\
                                </table>\
				<p class="submit">\
				<input type="button" id="callout-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#callout-submit').click(function() {

            var callout_title = table.find("#callout-title").val();
            var callout_text = table.find("#callout-text").val();
            var callout_buttontext = table.find("#callout-buttontext").val();
            var callout_buttonlink = table.find("#callout-buttonlink").val();





            var shortcode = "[callout title='" + callout_title + "' text='" + callout_text + "' button_text='" + callout_buttontext + "'  button_link='" + callout_buttonlink + "']";
            // inserts the shortcode into the active editor


            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }

})(jQuery);




/*
 * 1/3
 */
(function() {
    tinymce.create('tinymce.plugins.testimonial', {
        init: function(ed, url) {
            ed.addButton('testimonial', {
                title: 'Testimonial',
                image: url + '/testimonial-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[testimonial name="" img="" subtitle=""] Contents [/testimonial]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('testimonial', tinymce.plugins.testimonial);

   

})(jQuery);




/*
 * 1/3
 */
(function() {
    tinymce.create('tinymce.plugins.one_third', {
        init: function(ed, url) {
            ed.addButton('one_third', {
                title: '1/3 Columns',
                image: url + '/column13-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[one_third] Contents [/one_third]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('one_third', tinymce.plugins.one_third);

   

})(jQuery);



/*
 * 2/3
 */
(function() {
    tinymce.create('tinymce.plugins.two_third', {
        init: function(ed, url) {
            ed.addButton('two_third', {
                title: '2/3 Columns',
                image: url + '/colimn23-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[two_third] Contents [/two_third]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('two_third', tinymce.plugins.two_third);

   

})(jQuery);



/*
 * 1/2
 */
(function() {
    tinymce.create('tinymce.plugins.one_half', {
        init: function(ed, url) {
            ed.addButton('one_half', {
                title: '1/2 Columns',
                image: url + '/column12-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[one_half] Contents [/one_half]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('one_half', tinymce.plugins.one_half);

   

})(jQuery);



/*
 * 1/4
 */
(function() {
    tinymce.create('tinymce.plugins.one_fourth', {
        init: function(ed, url) {
            ed.addButton('one_fourth', {
                title: '1/4 Columns',
                image: url + '/column14-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[one_fourth] Contents [/one_fourth]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('one_fourth', tinymce.plugins.one_fourth);

   

})(jQuery);




/*
 * 1/6
 */
(function() {
    tinymce.create('tinymce.plugins.one_sixth', {
        init: function(ed, url) {
            ed.addButton('one_sixth', {
                title: '1/6 Columns',
                image: url + '/column16-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[one_sixth] Contents [/one_sixth]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('one_sixth', tinymce.plugins.one_sixth);

   

})(jQuery);

/*
 * 1/12
 */
(function() {
    tinymce.create('tinymce.plugins.one_twelfth', {
        init: function(ed, url) {
            ed.addButton('one_twelfth', {
                title: '1/12 Columns',
                image: url + '/column112-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[one_twelfth] Contents [/one_twelfth]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('one_twelfth', tinymce.plugins.one_twelfth);

   

})(jQuery);


/*
 * Row
 */
(function() {
    tinymce.create('tinymce.plugins.row', {
        init: function(ed, url) {
            ed.addButton('row', {
                title: 'Row',
                image: url + '/row-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[row] Contents [/row]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('row', tinymce.plugins.row);

   

})(jQuery);



/*
 * Blox
 */
(function() {
    tinymce.create('tinymce.plugins.blox', {
        init: function(ed, url) {
            ed.addButton('blox', {
                title: 'Blox',
                image: url + '/bloxgray-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[blox img="http://" height="380" nomargin="false" fixed="false"] Contents [/blox]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('blox', tinymce.plugins.blox);

   

})(jQuery);

/*
 * parallax
 */
(function() {
    tinymce.create('tinymce.plugins.parallax', {
        init: function(ed, url) {
            ed.addButton('parallax', {
                title: 'parallax',
                image: url + '/parallax-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[parallax img="http://" height="380" height="420" speed="5" class="dark"] Contents [/parallax]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('parallax', tinymce.plugins.parallax);

   

})(jQuery);


/*
 * BloxDark
 */
(function() {
    tinymce.create('tinymce.plugins.bloxdark', {
        init: function(ed, url) {
            ed.addButton('bloxdark', {
                title: 'BloxDrak',
                image: url + '/bloxdark-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[bloxdark img="http://" height="380" nomargin="false" fixed="false"] Contents [/bloxdark]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('bloxdark', tinymce.plugins.bloxdark);

   

})(jQuery);




/*
 * FAQ
 */
(function() {
    tinymce.create('tinymce.plugins.faq', {
        init: function(ed, url) {
            ed.addButton('faq', {
                title: 'FAQ',
                image: url + '/faq-ico.png',
                onclick: function() {

                    tinyMCE.activeEditor.selection.setContent('[faq]');
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('faq', tinymce.plugins.faq);

   

})(jQuery);






/*
 * Big Title1
 */
(function() {
    tinymce.create('tinymce.plugins.bigtitle1', {
        init: function(ed, url) {
            ed.addButton('bigtitle1', {
                title: 'Big Title 1',
                image: url + '/bigtitle-ico.png',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[big_title]Title[/big_title]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('bigtitle1', tinymce.plugins.bigtitle1);
})(jQuery);


/*
 * Big Title2
 */
(function() {
    tinymce.create('tinymce.plugins.bigtitle2', {
        init: function(ed, url) {
            ed.addButton('bigtitle2', {
                title: 'Big Title 2',
                image: url + '/bigtitle2-ico.png',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[big_title2]Title[/big_title2]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('bigtitle2', tinymce.plugins.bigtitle2);
})(jQuery);



/*
 * Box Link
 */
(function() {
    tinymce.create('tinymce.plugins.boxlink', {
        init: function(ed, url) {
            ed.addButton('boxlink', {
                title: 'Box Link',
                image: url + '/boxlink-ico.png',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[boxlink url="http://"]Content[/boxlink]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('boxlink', tinymce.plugins.boxlink);
	
	
	
	

	
	
})(jQuery);



/*
 * Distance
 */
(function() {
    tinymce.create('tinymce.plugins.distance', {
        init: function(ed, url) {
            ed.addButton('distance', {
                title: 'Distance',
                image: url + '/distance-ico.png',
                onclick: function() {
                 	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');

                   
					distance_form();
					
					tb_show('Distance | Webnus theme shortcode manager', '#TB_inline?width=700&inlineId=distance-form');

                    jQuery('#TB_window').css('height', 150);
					jQuery('#TB_window').css('width', 400);
					jQuery('#TB_window').css('width', 400);
                    jQuery('#TB_window').center();

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('distance', tinymce.plugins.distance);
	
	
	
 function distance_form() //distance
    {

        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="distance-form"><table id="distance-table" class="form-table">\
				<tr>\
					<th><label for="distance-title">Type</label></th>\
					<td><select id="distance-type"><option value="1">Distance 1</option><option value="2">Distance 2</option><option value="3">Distance 3</option><option value="4">Distance 4</option></select><br />\
					<small>Distance Type</small>\
					</tr></table>\
				<p class="submit">\
				<input type="button" id="distance-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
				</p>\
				</div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#distance-submit').click(function() {

            var distance_type = table.find("#distance-type option:selected").val();
            



            var shortcode = '[distance'+ distance_type +']';
            // inserts the shortcode into the active editor


            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });

    }

	
})(jQuery);





/*
 * Link
 */
(function() {
    tinymce.create('tinymce.plugins.link1', {
        init: function(ed, url) {
            ed.addButton('link1', {
                title: 'Link (Learn more)',
                image: url + '/link-ico.png',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[link url="http://"]Content[/link]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('link1', tinymce.plugins.link1);
})(jQuery);





/*
 * Paragraph
 */
(function() {
    tinymce.create('tinymce.plugins.paragraph', {
        init: function(ed, url) {
            ed.addButton('paragraph', {
                title: 'Paragraph',
                image: url + '/paragraph-ico.png',
                onclick: function() {
                    tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[p]Content[/p]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('paragraph', tinymce.plugins.paragraph);
})(jQuery);



/*
 * Retina Icon
 */
(function() {
    tinymce.create('tinymce.plugins.retinaicon', {
        init: function(ed, url) {
            ed.addButton('retinaicon', {
                title: 'Retina Icon',
                image: url + '/retinaicon-ico.png',
                onclick: function() {
                	jQuery('.wpb_bootstrap_modals').css('z-index', '100');
                    jQuery('div.modal').css('z-index', '101');
                    jQuery('.modal-backdrop').css('z-index', '100');


                    retinaicon_form();
                    tb_show('Retina Icon | Webnus theme shortcode manager', '#TB_inline?width=700&height=550&inlineId=retinaicon-form');

                    jQuery('#TB_window').css('height', 600);
                    jQuery('#TB_window').css('width', 700);
                    
                    
                    jQuery('#TB_window').center();

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('retinaicon', tinymce.plugins.retinaicon);
    
    
    jQuery('#TB_window').live("tb_unload", function(){
        jQuery('.webnus-iconfonts-wrapper').remove();
    });
    
    function retinaicon_form() 
    {
		
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery(jQuery.base64.decode('PGRpdiBpZD0icmV0aW5haWNvbi1mb3JtIiBjbGFzcz0id2VibnVzLWljb25mb250cy13cmFwcGVyIj4NCgkJPHRhYmxlPg0KCQkJPHRyPg0KCQkJCTx0ZD4mbmJzcDs8L3RkPg0KCQkJCTx0ZD4mbmJzcDs8L3RkPg0KCQkJCTx0ZD4mbmJzcDs8L3RkPg0KCQkJPC90cj4NCgkJCTx0cj4NCgkJCQk8dGQ+PGxhYmVsIGZvcj0id2VibnVzLWljb25zLWNvbG9ycGlja2VyIj48L2xhYmVsPjxpbnB1dCB0eXBlPSJ0ZXh0IiBpZD0id2VibnVzLWljb25zLWNvbG9ycGlja2VyIiAvPjwvdGQ+DQoJCQkJPHRkPjxsYWJlbCBmb3I9IndlYm51cy1pY29ucy11cmwiPlVSTDo8L2xhYmVsPjxpbnB1dCB0eXBlPSJ0ZXh0IiBpZD0id2VibnVzLWljb25zLXVybCIgdmFsdWU9IiIvPjwvdGQ+DQoJCQkJPHRkPjxsYWJlbCBmb3I9IndlYm51cy1pY29ucy1zaXplIj5TaXplOjwvbGFiZWw+PGlucHV0IHR5cGU9InRleHQiIGlkPSJ3ZWJudXMtaWNvbnMtc2l6ZSIgdmFsdWU9IjE4cHgiLz48L3RkPg0KCQkJPC90cj4NCgkJPC90YWJsZT4NCgkJPGRpdiBjbGFzcz0id2VibnVzLWljb25zLWxpc3Qtd3JhcHBlciI+DQo8dWwgY2xhc3M9IndlYm51cy1pY29ucy1saXN0Ij4NCgkJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9Im5vbmUiIHZhbHVlPSJub25lIj48bGFiZWwgZm9yPSJub25lIj48aSBjbGFzcz0ibm9uZSIgc3R5bGU9ImZvbnQtc2l6ZTo5cHg7Ij5Ob25lPC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfaGVhcnQiIHZhbHVlPSJsaV9oZWFydCI+PGxhYmVsIGZvcj0ibGlfaGVhcnQiPjxpIGNsYXNzPSJsaV9oZWFydCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfY2xvdWQiIHZhbHVlPSJsaV9jbG91ZCI+PGxhYmVsIGZvcj0ibGlfY2xvdWQiPjxpIGNsYXNzPSJsaV9jbG91ZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfc3RhciIgdmFsdWU9ImxpX3N0YXIiPjxsYWJlbCBmb3I9ImxpX3N0YXIiPjxpIGNsYXNzPSJsaV9zdGFyIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV90diIgdmFsdWU9ImxpX3R2Ij48bGFiZWwgZm9yPSJsaV90diI+PGkgY2xhc3M9ImxpX3R2Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9zb3VuZCIgdmFsdWU9ImxpX3NvdW5kIj48bGFiZWwgZm9yPSJsaV9zb3VuZCI+PGkgY2xhc3M9ImxpX3NvdW5kIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV92aWRlbyIgdmFsdWU9ImxpX3ZpZGVvIj48bGFiZWwgZm9yPSJsaV92aWRlbyI+PGkgY2xhc3M9ImxpX3ZpZGVvIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV90cmFzaCIgdmFsdWU9ImxpX3RyYXNoIj48bGFiZWwgZm9yPSJsaV90cmFzaCI+PGkgY2xhc3M9ImxpX3RyYXNoIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV91c2VyIiB2YWx1ZT0ibGlfdXNlciI+PGxhYmVsIGZvcj0ibGlfdXNlciI+PGkgY2xhc3M9ImxpX3VzZXIiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX2tleSIgdmFsdWU9ImxpX2tleSI+PGxhYmVsIGZvcj0ibGlfa2V5Ij48aSBjbGFzcz0ibGlfa2V5Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9zZWFyY2giIHZhbHVlPSJsaV9zZWFyY2giPjxsYWJlbCBmb3I9ImxpX3NlYXJjaCI+PGkgY2xhc3M9ImxpX3NlYXJjaCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfc2V0dGluZ3MiIHZhbHVlPSJsaV9zZXR0aW5ncyI+PGxhYmVsIGZvcj0ibGlfc2V0dGluZ3MiPjxpIGNsYXNzPSJsaV9zZXR0aW5ncyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfY2FtZXJhIiB2YWx1ZT0ibGlfY2FtZXJhIj48bGFiZWwgZm9yPSJsaV9jYW1lcmEiPjxpIGNsYXNzPSJsaV9jYW1lcmEiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3RhZyIgdmFsdWU9ImxpX3RhZyI+PGxhYmVsIGZvcj0ibGlfdGFnIj48aSBjbGFzcz0ibGlfdGFnIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9sb2NrIiB2YWx1ZT0ibGlfbG9jayI+PGxhYmVsIGZvcj0ibGlfbG9jayI+PGkgY2xhc3M9ImxpX2xvY2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX2J1bGIiIHZhbHVlPSJsaV9idWxiIj48bGFiZWwgZm9yPSJsaV9idWxiIj48aSBjbGFzcz0ibGlfYnVsYiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfcGVuIiB2YWx1ZT0ibGlfcGVuIj48bGFiZWwgZm9yPSJsaV9wZW4iPjxpIGNsYXNzPSJsaV9wZW4iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX2RpYW1vbmQiIHZhbHVlPSJsaV9kaWFtb25kIj48bGFiZWwgZm9yPSJsaV9kaWFtb25kIj48aSBjbGFzcz0ibGlfZGlhbW9uZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfZGlzcGxheSIgdmFsdWU9ImxpX2Rpc3BsYXkiPjxsYWJlbCBmb3I9ImxpX2Rpc3BsYXkiPjxpIGNsYXNzPSJsaV9kaXNwbGF5Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9sb2NhdGlvbiIgdmFsdWU9ImxpX2xvY2F0aW9uIj48bGFiZWwgZm9yPSJsaV9sb2NhdGlvbiI+PGkgY2xhc3M9ImxpX2xvY2F0aW9uIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9leWUiIHZhbHVlPSJsaV9leWUiPjxsYWJlbCBmb3I9ImxpX2V5ZSI+PGkgY2xhc3M9ImxpX2V5ZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfYnViYmxlIiB2YWx1ZT0ibGlfYnViYmxlIj48bGFiZWwgZm9yPSJsaV9idWJibGUiPjxpIGNsYXNzPSJsaV9idWJibGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3N0YWNrIiB2YWx1ZT0ibGlfc3RhY2siPjxsYWJlbCBmb3I9ImxpX3N0YWNrIj48aSBjbGFzcz0ibGlfc3RhY2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX2N1cCIgdmFsdWU9ImxpX2N1cCI+PGxhYmVsIGZvcj0ibGlfY3VwIj48aSBjbGFzcz0ibGlfY3VwIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9waG9uZSIgdmFsdWU9ImxpX3Bob25lIj48bGFiZWwgZm9yPSJsaV9waG9uZSI+PGkgY2xhc3M9ImxpX3Bob25lIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9uZXdzIiB2YWx1ZT0ibGlfbmV3cyI+PGxhYmVsIGZvcj0ibGlfbmV3cyI+PGkgY2xhc3M9ImxpX25ld3MiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX21haWwiIHZhbHVlPSJsaV9tYWlsIj48bGFiZWwgZm9yPSJsaV9tYWlsIj48aSBjbGFzcz0ibGlfbWFpbCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfbGlrZSIgdmFsdWU9ImxpX2xpa2UiPjxsYWJlbCBmb3I9ImxpX2xpa2UiPjxpIGNsYXNzPSJsaV9saWtlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9waG90byIgdmFsdWU9ImxpX3Bob3RvIj48bGFiZWwgZm9yPSJsaV9waG90byI+PGkgY2xhc3M9ImxpX3Bob3RvIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9ub3RlIiB2YWx1ZT0ibGlfbm90ZSI+PGxhYmVsIGZvcj0ibGlfbm90ZSI+PGkgY2xhc3M9ImxpX25vdGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX2Nsb2NrIiB2YWx1ZT0ibGlfY2xvY2siPjxsYWJlbCBmb3I9ImxpX2Nsb2NrIj48aSBjbGFzcz0ibGlfY2xvY2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3BhcGVycGxhbmUiIHZhbHVlPSJsaV9wYXBlcnBsYW5lIj48bGFiZWwgZm9yPSJsaV9wYXBlcnBsYW5lIj48aSBjbGFzcz0ibGlfcGFwZXJwbGFuZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfcGFyYW1zIiB2YWx1ZT0ibGlfcGFyYW1zIj48bGFiZWwgZm9yPSJsaV9wYXJhbXMiPjxpIGNsYXNzPSJsaV9wYXJhbXMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX2Jhbmtub3RlIiB2YWx1ZT0ibGlfYmFua25vdGUiPjxsYWJlbCBmb3I9ImxpX2Jhbmtub3RlIj48aSBjbGFzcz0ibGlfYmFua25vdGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX2RhdGEiIHZhbHVlPSJsaV9kYXRhIj48bGFiZWwgZm9yPSJsaV9kYXRhIj48aSBjbGFzcz0ibGlfZGF0YSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfbXVzaWMiIHZhbHVlPSJsaV9tdXNpYyI+PGxhYmVsIGZvcj0ibGlfbXVzaWMiPjxpIGNsYXNzPSJsaV9tdXNpYyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfbWVnYXBob25lIiB2YWx1ZT0ibGlfbWVnYXBob25lIj48bGFiZWwgZm9yPSJsaV9tZWdhcGhvbmUiPjxpIGNsYXNzPSJsaV9tZWdhcGhvbmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3N0dWR5IiB2YWx1ZT0ibGlfc3R1ZHkiPjxsYWJlbCBmb3I9ImxpX3N0dWR5Ij48aSBjbGFzcz0ibGlfc3R1ZHkiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX2xhYiIgdmFsdWU9ImxpX2xhYiI+PGxhYmVsIGZvcj0ibGlfbGFiIj48aSBjbGFzcz0ibGlfbGFiIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9mb29kIiB2YWx1ZT0ibGlfZm9vZCI+PGxhYmVsIGZvcj0ibGlfZm9vZCI+PGkgY2xhc3M9ImxpX2Zvb2QiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3Qtc2hpcnQiIHZhbHVlPSJsaV90LXNoaXJ0Ij48bGFiZWwgZm9yPSJsaV90LXNoaXJ0Ij48aSBjbGFzcz0ibGlfdC1zaGlydCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfZmlyZSIgdmFsdWU9ImxpX2ZpcmUiPjxsYWJlbCBmb3I9ImxpX2ZpcmUiPjxpIGNsYXNzPSJsaV9maXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJsaV9jbGlwIiB2YWx1ZT0ibGlfY2xpcCI+PGxhYmVsIGZvcj0ibGlfY2xpcCI+PGkgY2xhc3M9ImxpX2NsaXAiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3Nob3AiIHZhbHVlPSJsaV9zaG9wIj48bGFiZWwgZm9yPSJsaV9zaG9wIj48aSBjbGFzcz0ibGlfc2hvcCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfY2FsZW5kYXIiIHZhbHVlPSJsaV9jYWxlbmRhciI+PGxhYmVsIGZvcj0ibGlfY2FsZW5kYXIiPjxpIGNsYXNzPSJsaV9jYWxlbmRhciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0ibGlfdmFsbGV0IiB2YWx1ZT0ibGlfdmFsbGV0Ij48bGFiZWwgZm9yPSJsaV92YWxsZXQiPjxpIGNsYXNzPSJsaV92YWxsZXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3Z5bmlsIiB2YWx1ZT0ibGlfdnluaWwiPjxsYWJlbCBmb3I9ImxpX3Z5bmlsIj48aSBjbGFzcz0ibGlfdnluaWwiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3RydWNrIiB2YWx1ZT0ibGlfdHJ1Y2siPjxsYWJlbCBmb3I9ImxpX3RydWNrIj48aSBjbGFzcz0ibGlfdHJ1Y2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImxpX3dvcmxkIiB2YWx1ZT0ibGlfd29ybGQiPjxsYWJlbCBmb3I9ImxpX3dvcmxkIj48aSBjbGFzcz0ibGlfd29ybGQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLW11c2ljIiB2YWx1ZT0iZmEtbXVzaWMiPjxsYWJlbCBmb3I9ImZhLW11c2ljIj48aSBjbGFzcz0iZmEtbXVzaWMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNlYXJjaCIgdmFsdWU9ImZhLXNlYXJjaCI+PGxhYmVsIGZvcj0iZmEtc2VhcmNoIj48aSBjbGFzcz0iZmEtc2VhcmNoIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1lbnZlbG9wZS1vIiB2YWx1ZT0iZmEtZW52ZWxvcGUtbyI+PGxhYmVsIGZvcj0iZmEtZW52ZWxvcGUtbyI+PGkgY2xhc3M9ImZhLWVudmVsb3BlLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWhlYXJ0IiB2YWx1ZT0iZmEtaGVhcnQiPjxsYWJlbCBmb3I9ImZhLWhlYXJ0Ij48aSBjbGFzcz0iZmEtaGVhcnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN0YXIiIHZhbHVlPSJmYS1zdGFyIj48bGFiZWwgZm9yPSJmYS1zdGFyIj48aSBjbGFzcz0iZmEtc3RhciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3Rhci1vIiB2YWx1ZT0iZmEtc3Rhci1vIj48bGFiZWwgZm9yPSJmYS1zdGFyLW8iPjxpIGNsYXNzPSJmYS1zdGFyLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXVzZXIiIHZhbHVlPSJmYS11c2VyIj48bGFiZWwgZm9yPSJmYS11c2VyIj48aSBjbGFzcz0iZmEtdXNlciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmlsbSIgdmFsdWU9ImZhLWZpbG0iPjxsYWJlbCBmb3I9ImZhLWZpbG0iPjxpIGNsYXNzPSJmYS1maWxtIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10aC1sYXJnZSIgdmFsdWU9ImZhLXRoLWxhcmdlIj48bGFiZWwgZm9yPSJmYS10aC1sYXJnZSI+PGkgY2xhc3M9ImZhLXRoLWxhcmdlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10aCIgdmFsdWU9ImZhLXRoIj48bGFiZWwgZm9yPSJmYS10aCI+PGkgY2xhc3M9ImZhLXRoIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10aC1saXN0IiB2YWx1ZT0iZmEtdGgtbGlzdCI+PGxhYmVsIGZvcj0iZmEtdGgtbGlzdCI+PGkgY2xhc3M9ImZhLXRoLWxpc3QiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNoZWNrIiB2YWx1ZT0iZmEtY2hlY2siPjxsYWJlbCBmb3I9ImZhLWNoZWNrIj48aSBjbGFzcz0iZmEtY2hlY2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXJlbW92ZSIgdmFsdWU9ImZhLXJlbW92ZSI+PGxhYmVsIGZvcj0iZmEtcmVtb3ZlIj48aSBjbGFzcz0iZmEtcmVtb3ZlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zZWFyY2gtcGx1cyIgdmFsdWU9ImZhLXNlYXJjaC1wbHVzIj48bGFiZWwgZm9yPSJmYS1zZWFyY2gtcGx1cyI+PGkgY2xhc3M9ImZhLXNlYXJjaC1wbHVzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zZWFyY2gtbWludXMiIHZhbHVlPSJmYS1zZWFyY2gtbWludXMiPjxsYWJlbCBmb3I9ImZhLXNlYXJjaC1taW51cyI+PGkgY2xhc3M9ImZhLXNlYXJjaC1taW51cyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcG93ZXItb2ZmIiB2YWx1ZT0iZmEtcG93ZXItb2ZmIj48bGFiZWwgZm9yPSJmYS1wb3dlci1vZmYiPjxpIGNsYXNzPSJmYS1wb3dlci1vZmYiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNpZ25hbCIgdmFsdWU9ImZhLXNpZ25hbCI+PGxhYmVsIGZvcj0iZmEtc2lnbmFsIj48aSBjbGFzcz0iZmEtc2lnbmFsIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1nZWFyIiB2YWx1ZT0iZmEtZ2VhciI+PGxhYmVsIGZvcj0iZmEtZ2VhciI+PGkgY2xhc3M9ImZhLWdlYXIiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRyYXNoLW8iIHZhbHVlPSJmYS10cmFzaC1vIj48bGFiZWwgZm9yPSJmYS10cmFzaC1vIj48aSBjbGFzcz0iZmEtdHJhc2gtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaG9tZSIgdmFsdWU9ImZhLWhvbWUiPjxsYWJlbCBmb3I9ImZhLWhvbWUiPjxpIGNsYXNzPSJmYS1ob21lIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1maWxlLW8iIHZhbHVlPSJmYS1maWxlLW8iPjxsYWJlbCBmb3I9ImZhLWZpbGUtbyI+PGkgY2xhc3M9ImZhLWZpbGUtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2xvY2stbyIgdmFsdWU9ImZhLWNsb2NrLW8iPjxsYWJlbCBmb3I9ImZhLWNsb2NrLW8iPjxpIGNsYXNzPSJmYS1jbG9jay1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1yb2FkIiB2YWx1ZT0iZmEtcm9hZCI+PGxhYmVsIGZvcj0iZmEtcm9hZCI+PGkgY2xhc3M9ImZhLXJvYWQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWRvd25sb2FkIiB2YWx1ZT0iZmEtZG93bmxvYWQiPjxsYWJlbCBmb3I9ImZhLWRvd25sb2FkIj48aSBjbGFzcz0iZmEtZG93bmxvYWQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFycm93LWNpcmNsZS1vLWRvd24iIHZhbHVlPSJmYS1hcnJvdy1jaXJjbGUtby1kb3duIj48bGFiZWwgZm9yPSJmYS1hcnJvdy1jaXJjbGUtby1kb3duIj48aSBjbGFzcz0iZmEtYXJyb3ctY2lyY2xlLW8tZG93biI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYXJyb3ctY2lyY2xlLW8tdXAiIHZhbHVlPSJmYS1hcnJvdy1jaXJjbGUtby11cCI+PGxhYmVsIGZvcj0iZmEtYXJyb3ctY2lyY2xlLW8tdXAiPjxpIGNsYXNzPSJmYS1hcnJvdy1jaXJjbGUtby11cCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaW5ib3giIHZhbHVlPSJmYS1pbmJveCI+PGxhYmVsIGZvcj0iZmEtaW5ib3giPjxpIGNsYXNzPSJmYS1pbmJveCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGxheS1jaXJjbGUtbyIgdmFsdWU9ImZhLXBsYXktY2lyY2xlLW8iPjxsYWJlbCBmb3I9ImZhLXBsYXktY2lyY2xlLW8iPjxpIGNsYXNzPSJmYS1wbGF5LWNpcmNsZS1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1yb3RhdGUtcmlnaHQiIHZhbHVlPSJmYS1yb3RhdGUtcmlnaHQiPjxsYWJlbCBmb3I9ImZhLXJvdGF0ZS1yaWdodCI+PGkgY2xhc3M9ImZhLXJvdGF0ZS1yaWdodCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcmVmcmVzaCIgdmFsdWU9ImZhLXJlZnJlc2giPjxsYWJlbCBmb3I9ImZhLXJlZnJlc2giPjxpIGNsYXNzPSJmYS1yZWZyZXNoIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1saXN0LWFsdCIgdmFsdWU9ImZhLWxpc3QtYWx0Ij48bGFiZWwgZm9yPSJmYS1saXN0LWFsdCI+PGkgY2xhc3M9ImZhLWxpc3QtYWx0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1sb2NrIiB2YWx1ZT0iZmEtbG9jayI+PGxhYmVsIGZvcj0iZmEtbG9jayI+PGkgY2xhc3M9ImZhLWxvY2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZsYWciIHZhbHVlPSJmYS1mbGFnIj48bGFiZWwgZm9yPSJmYS1mbGFnIj48aSBjbGFzcz0iZmEtZmxhZyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaGVhZHBob25lcyIgdmFsdWU9ImZhLWhlYWRwaG9uZXMiPjxsYWJlbCBmb3I9ImZhLWhlYWRwaG9uZXMiPjxpIGNsYXNzPSJmYS1oZWFkcGhvbmVzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS12b2x1bWUtb2ZmIiB2YWx1ZT0iZmEtdm9sdW1lLW9mZiI+PGxhYmVsIGZvcj0iZmEtdm9sdW1lLW9mZiI+PGkgY2xhc3M9ImZhLXZvbHVtZS1vZmYiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXZvbHVtZS1kb3duIiB2YWx1ZT0iZmEtdm9sdW1lLWRvd24iPjxsYWJlbCBmb3I9ImZhLXZvbHVtZS1kb3duIj48aSBjbGFzcz0iZmEtdm9sdW1lLWRvd24iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXZvbHVtZS11cCIgdmFsdWU9ImZhLXZvbHVtZS11cCI+PGxhYmVsIGZvcj0iZmEtdm9sdW1lLXVwIj48aSBjbGFzcz0iZmEtdm9sdW1lLXVwIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1xcmNvZGUiIHZhbHVlPSJmYS1xcmNvZGUiPjxsYWJlbCBmb3I9ImZhLXFyY29kZSI+PGkgY2xhc3M9ImZhLXFyY29kZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYmFyY29kZSIgdmFsdWU9ImZhLWJhcmNvZGUiPjxsYWJlbCBmb3I9ImZhLWJhcmNvZGUiPjxpIGNsYXNzPSJmYS1iYXJjb2RlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10YWciIHZhbHVlPSJmYS10YWciPjxsYWJlbCBmb3I9ImZhLXRhZyI+PGkgY2xhc3M9ImZhLXRhZyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdGFncyIgdmFsdWU9ImZhLXRhZ3MiPjxsYWJlbCBmb3I9ImZhLXRhZ3MiPjxpIGNsYXNzPSJmYS10YWdzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1ib29rIiB2YWx1ZT0iZmEtYm9vayI+PGxhYmVsIGZvcj0iZmEtYm9vayI+PGkgY2xhc3M9ImZhLWJvb2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJvb2ttYXJrIiB2YWx1ZT0iZmEtYm9va21hcmsiPjxsYWJlbCBmb3I9ImZhLWJvb2ttYXJrIj48aSBjbGFzcz0iZmEtYm9va21hcmsiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXByaW50IiB2YWx1ZT0iZmEtcHJpbnQiPjxsYWJlbCBmb3I9ImZhLXByaW50Ij48aSBjbGFzcz0iZmEtcHJpbnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNhbWVyYSIgdmFsdWU9ImZhLWNhbWVyYSI+PGxhYmVsIGZvcj0iZmEtY2FtZXJhIj48aSBjbGFzcz0iZmEtY2FtZXJhIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1mb250IiB2YWx1ZT0iZmEtZm9udCI+PGxhYmVsIGZvcj0iZmEtZm9udCI+PGkgY2xhc3M9ImZhLWZvbnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJvbGQiIHZhbHVlPSJmYS1ib2xkIj48bGFiZWwgZm9yPSJmYS1ib2xkIj48aSBjbGFzcz0iZmEtYm9sZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaXRhbGljIiB2YWx1ZT0iZmEtaXRhbGljIj48bGFiZWwgZm9yPSJmYS1pdGFsaWMiPjxpIGNsYXNzPSJmYS1pdGFsaWMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRleHQtaGVpZ2h0IiB2YWx1ZT0iZmEtdGV4dC1oZWlnaHQiPjxsYWJlbCBmb3I9ImZhLXRleHQtaGVpZ2h0Ij48aSBjbGFzcz0iZmEtdGV4dC1oZWlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRleHQtd2lkdGgiIHZhbHVlPSJmYS10ZXh0LXdpZHRoIj48bGFiZWwgZm9yPSJmYS10ZXh0LXdpZHRoIj48aSBjbGFzcz0iZmEtdGV4dC13aWR0aCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYWxpZ24tbGVmdCIgdmFsdWU9ImZhLWFsaWduLWxlZnQiPjxsYWJlbCBmb3I9ImZhLWFsaWduLWxlZnQiPjxpIGNsYXNzPSJmYS1hbGlnbi1sZWZ0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hbGlnbi1jZW50ZXIiIHZhbHVlPSJmYS1hbGlnbi1jZW50ZXIiPjxsYWJlbCBmb3I9ImZhLWFsaWduLWNlbnRlciI+PGkgY2xhc3M9ImZhLWFsaWduLWNlbnRlciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYWxpZ24tcmlnaHQiIHZhbHVlPSJmYS1hbGlnbi1yaWdodCI+PGxhYmVsIGZvcj0iZmEtYWxpZ24tcmlnaHQiPjxpIGNsYXNzPSJmYS1hbGlnbi1yaWdodCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYWxpZ24tanVzdGlmeSIgdmFsdWU9ImZhLWFsaWduLWp1c3RpZnkiPjxsYWJlbCBmb3I9ImZhLWFsaWduLWp1c3RpZnkiPjxpIGNsYXNzPSJmYS1hbGlnbi1qdXN0aWZ5Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1saXN0IiB2YWx1ZT0iZmEtbGlzdCI+PGxhYmVsIGZvcj0iZmEtbGlzdCI+PGkgY2xhc3M9ImZhLWxpc3QiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWRlZGVudCIgdmFsdWU9ImZhLWRlZGVudCI+PGxhYmVsIGZvcj0iZmEtZGVkZW50Ij48aSBjbGFzcz0iZmEtZGVkZW50Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1pbmRlbnQiIHZhbHVlPSJmYS1pbmRlbnQiPjxsYWJlbCBmb3I9ImZhLWluZGVudCI+PGkgY2xhc3M9ImZhLWluZGVudCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdmlkZW8tY2FtZXJhIiB2YWx1ZT0iZmEtdmlkZW8tY2FtZXJhIj48bGFiZWwgZm9yPSJmYS12aWRlby1jYW1lcmEiPjxpIGNsYXNzPSJmYS12aWRlby1jYW1lcmEiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBob3RvIiB2YWx1ZT0iZmEtcGhvdG8iPjxsYWJlbCBmb3I9ImZhLXBob3RvIj48aSBjbGFzcz0iZmEtcGhvdG8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBlbmNpbCIgdmFsdWU9ImZhLXBlbmNpbCI+PGxhYmVsIGZvcj0iZmEtcGVuY2lsIj48aSBjbGFzcz0iZmEtcGVuY2lsIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1tYXAtbWFya2VyIiB2YWx1ZT0iZmEtbWFwLW1hcmtlciI+PGxhYmVsIGZvcj0iZmEtbWFwLW1hcmtlciI+PGkgY2xhc3M9ImZhLW1hcC1tYXJrZXIiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFkanVzdCIgdmFsdWU9ImZhLWFkanVzdCI+PGxhYmVsIGZvcj0iZmEtYWRqdXN0Ij48aSBjbGFzcz0iZmEtYWRqdXN0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10aW50IiB2YWx1ZT0iZmEtdGludCI+PGxhYmVsIGZvcj0iZmEtdGludCI+PGkgY2xhc3M9ImZhLXRpbnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWVkaXQiIHZhbHVlPSJmYS1lZGl0Ij48bGFiZWwgZm9yPSJmYS1lZGl0Ij48aSBjbGFzcz0iZmEtZWRpdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc2hhcmUtc3F1YXJlLW8iIHZhbHVlPSJmYS1zaGFyZS1zcXVhcmUtbyI+PGxhYmVsIGZvcj0iZmEtc2hhcmUtc3F1YXJlLW8iPjxpIGNsYXNzPSJmYS1zaGFyZS1zcXVhcmUtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2hlY2stc3F1YXJlLW8iIHZhbHVlPSJmYS1jaGVjay1zcXVhcmUtbyI+PGxhYmVsIGZvcj0iZmEtY2hlY2stc3F1YXJlLW8iPjxpIGNsYXNzPSJmYS1jaGVjay1zcXVhcmUtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYXJyb3dzIiB2YWx1ZT0iZmEtYXJyb3dzIj48bGFiZWwgZm9yPSJmYS1hcnJvd3MiPjxpIGNsYXNzPSJmYS1hcnJvd3MiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN0ZXAtYmFja3dhcmQiIHZhbHVlPSJmYS1zdGVwLWJhY2t3YXJkIj48bGFiZWwgZm9yPSJmYS1zdGVwLWJhY2t3YXJkIj48aSBjbGFzcz0iZmEtc3RlcC1iYWNrd2FyZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmFzdC1iYWNrd2FyZCIgdmFsdWU9ImZhLWZhc3QtYmFja3dhcmQiPjxsYWJlbCBmb3I9ImZhLWZhc3QtYmFja3dhcmQiPjxpIGNsYXNzPSJmYS1mYXN0LWJhY2t3YXJkIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1iYWNrd2FyZCIgdmFsdWU9ImZhLWJhY2t3YXJkIj48bGFiZWwgZm9yPSJmYS1iYWNrd2FyZCI+PGkgY2xhc3M9ImZhLWJhY2t3YXJkIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1wbGF5IiB2YWx1ZT0iZmEtcGxheSI+PGxhYmVsIGZvcj0iZmEtcGxheSI+PGkgY2xhc3M9ImZhLXBsYXkiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBhdXNlIiB2YWx1ZT0iZmEtcGF1c2UiPjxsYWJlbCBmb3I9ImZhLXBhdXNlIj48aSBjbGFzcz0iZmEtcGF1c2UiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN0b3AiIHZhbHVlPSJmYS1zdG9wIj48bGFiZWwgZm9yPSJmYS1zdG9wIj48aSBjbGFzcz0iZmEtc3RvcCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZm9yd2FyZCIgdmFsdWU9ImZhLWZvcndhcmQiPjxsYWJlbCBmb3I9ImZhLWZvcndhcmQiPjxpIGNsYXNzPSJmYS1mb3J3YXJkIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1mYXN0LWZvcndhcmQiIHZhbHVlPSJmYS1mYXN0LWZvcndhcmQiPjxsYWJlbCBmb3I9ImZhLWZhc3QtZm9yd2FyZCI+PGkgY2xhc3M9ImZhLWZhc3QtZm9yd2FyZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3RlcC1mb3J3YXJkIiB2YWx1ZT0iZmEtc3RlcC1mb3J3YXJkIj48bGFiZWwgZm9yPSJmYS1zdGVwLWZvcndhcmQiPjxpIGNsYXNzPSJmYS1zdGVwLWZvcndhcmQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWVqZWN0IiB2YWx1ZT0iZmEtZWplY3QiPjxsYWJlbCBmb3I9ImZhLWVqZWN0Ij48aSBjbGFzcz0iZmEtZWplY3QiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNoZXZyb24tbGVmdCIgdmFsdWU9ImZhLWNoZXZyb24tbGVmdCI+PGxhYmVsIGZvcj0iZmEtY2hldnJvbi1sZWZ0Ij48aSBjbGFzcz0iZmEtY2hldnJvbi1sZWZ0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jaGV2cm9uLXJpZ2h0IiB2YWx1ZT0iZmEtY2hldnJvbi1yaWdodCI+PGxhYmVsIGZvcj0iZmEtY2hldnJvbi1yaWdodCI+PGkgY2xhc3M9ImZhLWNoZXZyb24tcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBsdXMtY2lyY2xlIiB2YWx1ZT0iZmEtcGx1cy1jaXJjbGUiPjxsYWJlbCBmb3I9ImZhLXBsdXMtY2lyY2xlIj48aSBjbGFzcz0iZmEtcGx1cy1jaXJjbGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLW1pbnVzLWNpcmNsZSIgdmFsdWU9ImZhLW1pbnVzLWNpcmNsZSI+PGxhYmVsIGZvcj0iZmEtbWludXMtY2lyY2xlIj48aSBjbGFzcz0iZmEtbWludXMtY2lyY2xlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10aW1lcy1jaXJjbGUiIHZhbHVlPSJmYS10aW1lcy1jaXJjbGUiPjxsYWJlbCBmb3I9ImZhLXRpbWVzLWNpcmNsZSI+PGkgY2xhc3M9ImZhLXRpbWVzLWNpcmNsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2hlY2stY2lyY2xlIiB2YWx1ZT0iZmEtY2hlY2stY2lyY2xlIj48bGFiZWwgZm9yPSJmYS1jaGVjay1jaXJjbGUiPjxpIGNsYXNzPSJmYS1jaGVjay1jaXJjbGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXF1ZXN0aW9uLWNpcmNsZSIgdmFsdWU9ImZhLXF1ZXN0aW9uLWNpcmNsZSI+PGxhYmVsIGZvcj0iZmEtcXVlc3Rpb24tY2lyY2xlIj48aSBjbGFzcz0iZmEtcXVlc3Rpb24tY2lyY2xlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1pbmZvLWNpcmNsZSIgdmFsdWU9ImZhLWluZm8tY2lyY2xlIj48bGFiZWwgZm9yPSJmYS1pbmZvLWNpcmNsZSI+PGkgY2xhc3M9ImZhLWluZm8tY2lyY2xlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jcm9zc2hhaXJzIiB2YWx1ZT0iZmEtY3Jvc3NoYWlycyI+PGxhYmVsIGZvcj0iZmEtY3Jvc3NoYWlycyI+PGkgY2xhc3M9ImZhLWNyb3NzaGFpcnMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRpbWVzLWNpcmNsZS1vIiB2YWx1ZT0iZmEtdGltZXMtY2lyY2xlLW8iPjxsYWJlbCBmb3I9ImZhLXRpbWVzLWNpcmNsZS1vIj48aSBjbGFzcz0iZmEtdGltZXMtY2lyY2xlLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNoZWNrLWNpcmNsZS1vIiB2YWx1ZT0iZmEtY2hlY2stY2lyY2xlLW8iPjxsYWJlbCBmb3I9ImZhLWNoZWNrLWNpcmNsZS1vIj48aSBjbGFzcz0iZmEtY2hlY2stY2lyY2xlLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJhbiIgdmFsdWU9ImZhLWJhbiI+PGxhYmVsIGZvcj0iZmEtYmFuIj48aSBjbGFzcz0iZmEtYmFuIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hcnJvdy1sZWZ0IiB2YWx1ZT0iZmEtYXJyb3ctbGVmdCI+PGxhYmVsIGZvcj0iZmEtYXJyb3ctbGVmdCI+PGkgY2xhc3M9ImZhLWFycm93LWxlZnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFycm93LXJpZ2h0IiB2YWx1ZT0iZmEtYXJyb3ctcmlnaHQiPjxsYWJlbCBmb3I9ImZhLWFycm93LXJpZ2h0Ij48aSBjbGFzcz0iZmEtYXJyb3ctcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFycm93LXVwIiB2YWx1ZT0iZmEtYXJyb3ctdXAiPjxsYWJlbCBmb3I9ImZhLWFycm93LXVwIj48aSBjbGFzcz0iZmEtYXJyb3ctdXAiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFycm93LWRvd24iIHZhbHVlPSJmYS1hcnJvdy1kb3duIj48bGFiZWwgZm9yPSJmYS1hcnJvdy1kb3duIj48aSBjbGFzcz0iZmEtYXJyb3ctZG93biI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbWFpbC1mb3J3YXJkIiB2YWx1ZT0iZmEtbWFpbC1mb3J3YXJkIj48bGFiZWwgZm9yPSJmYS1tYWlsLWZvcndhcmQiPjxpIGNsYXNzPSJmYS1tYWlsLWZvcndhcmQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWV4cGFuZCIgdmFsdWU9ImZhLWV4cGFuZCI+PGxhYmVsIGZvcj0iZmEtZXhwYW5kIj48aSBjbGFzcz0iZmEtZXhwYW5kIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jb21wcmVzcyIgdmFsdWU9ImZhLWNvbXByZXNzIj48bGFiZWwgZm9yPSJmYS1jb21wcmVzcyI+PGkgY2xhc3M9ImZhLWNvbXByZXNzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1wbHVzIiB2YWx1ZT0iZmEtcGx1cyI+PGxhYmVsIGZvcj0iZmEtcGx1cyI+PGkgY2xhc3M9ImZhLXBsdXMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLW1pbnVzIiB2YWx1ZT0iZmEtbWludXMiPjxsYWJlbCBmb3I9ImZhLW1pbnVzIj48aSBjbGFzcz0iZmEtbWludXMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFzdGVyaXNrIiB2YWx1ZT0iZmEtYXN0ZXJpc2siPjxsYWJlbCBmb3I9ImZhLWFzdGVyaXNrIj48aSBjbGFzcz0iZmEtYXN0ZXJpc2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWV4Y2xhbWF0aW9uLWNpcmNsZSIgdmFsdWU9ImZhLWV4Y2xhbWF0aW9uLWNpcmNsZSI+PGxhYmVsIGZvcj0iZmEtZXhjbGFtYXRpb24tY2lyY2xlIj48aSBjbGFzcz0iZmEtZXhjbGFtYXRpb24tY2lyY2xlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1naWZ0IiB2YWx1ZT0iZmEtZ2lmdCI+PGxhYmVsIGZvcj0iZmEtZ2lmdCI+PGkgY2xhc3M9ImZhLWdpZnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWxlYWYiIHZhbHVlPSJmYS1sZWFmIj48bGFiZWwgZm9yPSJmYS1sZWFmIj48aSBjbGFzcz0iZmEtbGVhZiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmlyZSIgdmFsdWU9ImZhLWZpcmUiPjxsYWJlbCBmb3I9ImZhLWZpcmUiPjxpIGNsYXNzPSJmYS1maXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1leWUiIHZhbHVlPSJmYS1leWUiPjxsYWJlbCBmb3I9ImZhLWV5ZSI+PGkgY2xhc3M9ImZhLWV5ZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZXllLXNsYXNoIiB2YWx1ZT0iZmEtZXllLXNsYXNoIj48bGFiZWwgZm9yPSJmYS1leWUtc2xhc2giPjxpIGNsYXNzPSJmYS1leWUtc2xhc2giPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXdhcm5pbmciIHZhbHVlPSJmYS13YXJuaW5nIj48bGFiZWwgZm9yPSJmYS13YXJuaW5nIj48aSBjbGFzcz0iZmEtd2FybmluZyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGxhbmUiIHZhbHVlPSJmYS1wbGFuZSI+PGxhYmVsIGZvcj0iZmEtcGxhbmUiPjxpIGNsYXNzPSJmYS1wbGFuZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2FsZW5kYXIiIHZhbHVlPSJmYS1jYWxlbmRhciI+PGxhYmVsIGZvcj0iZmEtY2FsZW5kYXIiPjxpIGNsYXNzPSJmYS1jYWxlbmRhciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcmFuZG9tIiB2YWx1ZT0iZmEtcmFuZG9tIj48bGFiZWwgZm9yPSJmYS1yYW5kb20iPjxpIGNsYXNzPSJmYS1yYW5kb20iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNvbW1lbnQiIHZhbHVlPSJmYS1jb21tZW50Ij48bGFiZWwgZm9yPSJmYS1jb21tZW50Ij48aSBjbGFzcz0iZmEtY29tbWVudCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbWFnbmV0IiB2YWx1ZT0iZmEtbWFnbmV0Ij48bGFiZWwgZm9yPSJmYS1tYWduZXQiPjxpIGNsYXNzPSJmYS1tYWduZXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNoZXZyb24tdXAiIHZhbHVlPSJmYS1jaGV2cm9uLXVwIj48bGFiZWwgZm9yPSJmYS1jaGV2cm9uLXVwIj48aSBjbGFzcz0iZmEtY2hldnJvbi11cCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2hldnJvbi1kb3duIiB2YWx1ZT0iZmEtY2hldnJvbi1kb3duIj48bGFiZWwgZm9yPSJmYS1jaGV2cm9uLWRvd24iPjxpIGNsYXNzPSJmYS1jaGV2cm9uLWRvd24iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXJldHdlZXQiIHZhbHVlPSJmYS1yZXR3ZWV0Ij48bGFiZWwgZm9yPSJmYS1yZXR3ZWV0Ij48aSBjbGFzcz0iZmEtcmV0d2VldCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc2hvcHBpbmctY2FydCIgdmFsdWU9ImZhLXNob3BwaW5nLWNhcnQiPjxsYWJlbCBmb3I9ImZhLXNob3BwaW5nLWNhcnQiPjxpIGNsYXNzPSJmYS1zaG9wcGluZy1jYXJ0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1mb2xkZXIiIHZhbHVlPSJmYS1mb2xkZXIiPjxsYWJlbCBmb3I9ImZhLWZvbGRlciI+PGkgY2xhc3M9ImZhLWZvbGRlciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZm9sZGVyLW9wZW4iIHZhbHVlPSJmYS1mb2xkZXItb3BlbiI+PGxhYmVsIGZvcj0iZmEtZm9sZGVyLW9wZW4iPjxpIGNsYXNzPSJmYS1mb2xkZXItb3BlbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYXJyb3dzLXYiIHZhbHVlPSJmYS1hcnJvd3MtdiI+PGxhYmVsIGZvcj0iZmEtYXJyb3dzLXYiPjxpIGNsYXNzPSJmYS1hcnJvd3MtdiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYXJyb3dzLWgiIHZhbHVlPSJmYS1hcnJvd3MtaCI+PGxhYmVsIGZvcj0iZmEtYXJyb3dzLWgiPjxpIGNsYXNzPSJmYS1hcnJvd3MtaCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYmFyLWNoYXJ0LW8iIHZhbHVlPSJmYS1iYXItY2hhcnQtbyI+PGxhYmVsIGZvcj0iZmEtYmFyLWNoYXJ0LW8iPjxpIGNsYXNzPSJmYS1iYXItY2hhcnQtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdHdpdHRlci1zcXVhcmUiIHZhbHVlPSJmYS10d2l0dGVyLXNxdWFyZSI+PGxhYmVsIGZvcj0iZmEtdHdpdHRlci1zcXVhcmUiPjxpIGNsYXNzPSJmYS10d2l0dGVyLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmFjZWJvb2stc3F1YXJlIiB2YWx1ZT0iZmEtZmFjZWJvb2stc3F1YXJlIj48bGFiZWwgZm9yPSJmYS1mYWNlYm9vay1zcXVhcmUiPjxpIGNsYXNzPSJmYS1mYWNlYm9vay1zcXVhcmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNhbWVyYS1yZXRybyIgdmFsdWU9ImZhLWNhbWVyYS1yZXRybyI+PGxhYmVsIGZvcj0iZmEtY2FtZXJhLXJldHJvIj48aSBjbGFzcz0iZmEtY2FtZXJhLXJldHJvIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1rZXkiIHZhbHVlPSJmYS1rZXkiPjxsYWJlbCBmb3I9ImZhLWtleSI+PGkgY2xhc3M9ImZhLWtleSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZ2VhcnMiIHZhbHVlPSJmYS1nZWFycyI+PGxhYmVsIGZvcj0iZmEtZ2VhcnMiPjxpIGNsYXNzPSJmYS1nZWFycyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY29tbWVudHMiIHZhbHVlPSJmYS1jb21tZW50cyI+PGxhYmVsIGZvcj0iZmEtY29tbWVudHMiPjxpIGNsYXNzPSJmYS1jb21tZW50cyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdGh1bWJzLW8tdXAiIHZhbHVlPSJmYS10aHVtYnMtby11cCI+PGxhYmVsIGZvcj0iZmEtdGh1bWJzLW8tdXAiPjxpIGNsYXNzPSJmYS10aHVtYnMtby11cCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdGh1bWJzLW8tZG93biIgdmFsdWU9ImZhLXRodW1icy1vLWRvd24iPjxsYWJlbCBmb3I9ImZhLXRodW1icy1vLWRvd24iPjxpIGNsYXNzPSJmYS10aHVtYnMtby1kb3duIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zdGFyLWhhbGYiIHZhbHVlPSJmYS1zdGFyLWhhbGYiPjxsYWJlbCBmb3I9ImZhLXN0YXItaGFsZiI+PGkgY2xhc3M9ImZhLXN0YXItaGFsZiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaGVhcnQtbyIgdmFsdWU9ImZhLWhlYXJ0LW8iPjxsYWJlbCBmb3I9ImZhLWhlYXJ0LW8iPjxpIGNsYXNzPSJmYS1oZWFydC1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zaWduLW91dCIgdmFsdWU9ImZhLXNpZ24tb3V0Ij48bGFiZWwgZm9yPSJmYS1zaWduLW91dCI+PGkgY2xhc3M9ImZhLXNpZ24tb3V0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1saW5rZWRpbi1zcXVhcmUiIHZhbHVlPSJmYS1saW5rZWRpbi1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLWxpbmtlZGluLXNxdWFyZSI+PGkgY2xhc3M9ImZhLWxpbmtlZGluLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdGh1bWItdGFjayIgdmFsdWU9ImZhLXRodW1iLXRhY2siPjxsYWJlbCBmb3I9ImZhLXRodW1iLXRhY2siPjxpIGNsYXNzPSJmYS10aHVtYi10YWNrIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1leHRlcm5hbC1saW5rIiB2YWx1ZT0iZmEtZXh0ZXJuYWwtbGluayI+PGxhYmVsIGZvcj0iZmEtZXh0ZXJuYWwtbGluayI+PGkgY2xhc3M9ImZhLWV4dGVybmFsLWxpbmsiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNpZ24taW4iIHZhbHVlPSJmYS1zaWduLWluIj48bGFiZWwgZm9yPSJmYS1zaWduLWluIj48aSBjbGFzcz0iZmEtc2lnbi1pbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdHJvcGh5IiB2YWx1ZT0iZmEtdHJvcGh5Ij48bGFiZWwgZm9yPSJmYS10cm9waHkiPjxpIGNsYXNzPSJmYS10cm9waHkiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWdpdGh1Yi1zcXVhcmUiIHZhbHVlPSJmYS1naXRodWItc3F1YXJlIj48bGFiZWwgZm9yPSJmYS1naXRodWItc3F1YXJlIj48aSBjbGFzcz0iZmEtZ2l0aHViLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdXBsb2FkIiB2YWx1ZT0iZmEtdXBsb2FkIj48bGFiZWwgZm9yPSJmYS11cGxvYWQiPjxpIGNsYXNzPSJmYS11cGxvYWQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWxlbW9uLW8iIHZhbHVlPSJmYS1sZW1vbi1vIj48bGFiZWwgZm9yPSJmYS1sZW1vbi1vIj48aSBjbGFzcz0iZmEtbGVtb24tbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGhvbmUiIHZhbHVlPSJmYS1waG9uZSI+PGxhYmVsIGZvcj0iZmEtcGhvbmUiPjxpIGNsYXNzPSJmYS1waG9uZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3F1YXJlLW8iIHZhbHVlPSJmYS1zcXVhcmUtbyI+PGxhYmVsIGZvcj0iZmEtc3F1YXJlLW8iPjxpIGNsYXNzPSJmYS1zcXVhcmUtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYm9va21hcmstbyIgdmFsdWU9ImZhLWJvb2ttYXJrLW8iPjxsYWJlbCBmb3I9ImZhLWJvb2ttYXJrLW8iPjxpIGNsYXNzPSJmYS1ib29rbWFyay1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1waG9uZS1zcXVhcmUiIHZhbHVlPSJmYS1waG9uZS1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLXBob25lLXNxdWFyZSI+PGkgY2xhc3M9ImZhLXBob25lLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdHdpdHRlciIgdmFsdWU9ImZhLXR3aXR0ZXIiPjxsYWJlbCBmb3I9ImZhLXR3aXR0ZXIiPjxpIGNsYXNzPSJmYS10d2l0dGVyIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1mYWNlYm9vayIgdmFsdWU9ImZhLWZhY2Vib29rIj48bGFiZWwgZm9yPSJmYS1mYWNlYm9vayI+PGkgY2xhc3M9ImZhLWZhY2Vib29rIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1naXRodWIiIHZhbHVlPSJmYS1naXRodWIiPjxsYWJlbCBmb3I9ImZhLWdpdGh1YiI+PGkgY2xhc3M9ImZhLWdpdGh1YiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdW5sb2NrIiB2YWx1ZT0iZmEtdW5sb2NrIj48bGFiZWwgZm9yPSJmYS11bmxvY2siPjxpIGNsYXNzPSJmYS11bmxvY2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNyZWRpdC1jYXJkIiB2YWx1ZT0iZmEtY3JlZGl0LWNhcmQiPjxsYWJlbCBmb3I9ImZhLWNyZWRpdC1jYXJkIj48aSBjbGFzcz0iZmEtY3JlZGl0LWNhcmQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXJzcyIgdmFsdWU9ImZhLXJzcyI+PGxhYmVsIGZvcj0iZmEtcnNzIj48aSBjbGFzcz0iZmEtcnNzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1oZGQtbyIgdmFsdWU9ImZhLWhkZC1vIj48bGFiZWwgZm9yPSJmYS1oZGQtbyI+PGkgY2xhc3M9ImZhLWhkZC1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1idWxsaG9ybiIgdmFsdWU9ImZhLWJ1bGxob3JuIj48bGFiZWwgZm9yPSJmYS1idWxsaG9ybiI+PGkgY2xhc3M9ImZhLWJ1bGxob3JuIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1iZWxsIiB2YWx1ZT0iZmEtYmVsbCI+PGxhYmVsIGZvcj0iZmEtYmVsbCI+PGkgY2xhc3M9ImZhLWJlbGwiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNlcnRpZmljYXRlIiB2YWx1ZT0iZmEtY2VydGlmaWNhdGUiPjxsYWJlbCBmb3I9ImZhLWNlcnRpZmljYXRlIj48aSBjbGFzcz0iZmEtY2VydGlmaWNhdGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWhhbmQtby1yaWdodCIgdmFsdWU9ImZhLWhhbmQtby1yaWdodCI+PGxhYmVsIGZvcj0iZmEtaGFuZC1vLXJpZ2h0Ij48aSBjbGFzcz0iZmEtaGFuZC1vLXJpZ2h0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1oYW5kLW8tbGVmdCIgdmFsdWU9ImZhLWhhbmQtby1sZWZ0Ij48bGFiZWwgZm9yPSJmYS1oYW5kLW8tbGVmdCI+PGkgY2xhc3M9ImZhLWhhbmQtby1sZWZ0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1oYW5kLW8tdXAiIHZhbHVlPSJmYS1oYW5kLW8tdXAiPjxsYWJlbCBmb3I9ImZhLWhhbmQtby11cCI+PGkgY2xhc3M9ImZhLWhhbmQtby11cCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaGFuZC1vLWRvd24iIHZhbHVlPSJmYS1oYW5kLW8tZG93biI+PGxhYmVsIGZvcj0iZmEtaGFuZC1vLWRvd24iPjxpIGNsYXNzPSJmYS1oYW5kLW8tZG93biI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYXJyb3ctY2lyY2xlLWxlZnQiIHZhbHVlPSJmYS1hcnJvdy1jaXJjbGUtbGVmdCI+PGxhYmVsIGZvcj0iZmEtYXJyb3ctY2lyY2xlLWxlZnQiPjxpIGNsYXNzPSJmYS1hcnJvdy1jaXJjbGUtbGVmdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYXJyb3ctY2lyY2xlLXJpZ2h0IiB2YWx1ZT0iZmEtYXJyb3ctY2lyY2xlLXJpZ2h0Ij48bGFiZWwgZm9yPSJmYS1hcnJvdy1jaXJjbGUtcmlnaHQiPjxpIGNsYXNzPSJmYS1hcnJvdy1jaXJjbGUtcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFycm93LWNpcmNsZS11cCIgdmFsdWU9ImZhLWFycm93LWNpcmNsZS11cCI+PGxhYmVsIGZvcj0iZmEtYXJyb3ctY2lyY2xlLXVwIj48aSBjbGFzcz0iZmEtYXJyb3ctY2lyY2xlLXVwIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hcnJvdy1jaXJjbGUtZG93biIgdmFsdWU9ImZhLWFycm93LWNpcmNsZS1kb3duIj48bGFiZWwgZm9yPSJmYS1hcnJvdy1jaXJjbGUtZG93biI+PGkgY2xhc3M9ImZhLWFycm93LWNpcmNsZS1kb3duIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1nbG9iZSIgdmFsdWU9ImZhLWdsb2JlIj48bGFiZWwgZm9yPSJmYS1nbG9iZSI+PGkgY2xhc3M9ImZhLWdsb2JlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS13cmVuY2giIHZhbHVlPSJmYS13cmVuY2giPjxsYWJlbCBmb3I9ImZhLXdyZW5jaCI+PGkgY2xhc3M9ImZhLXdyZW5jaCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdGFza3MiIHZhbHVlPSJmYS10YXNrcyI+PGxhYmVsIGZvcj0iZmEtdGFza3MiPjxpIGNsYXNzPSJmYS10YXNrcyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmlsdGVyIiB2YWx1ZT0iZmEtZmlsdGVyIj48bGFiZWwgZm9yPSJmYS1maWx0ZXIiPjxpIGNsYXNzPSJmYS1maWx0ZXIiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJyaWVmY2FzZSIgdmFsdWU9ImZhLWJyaWVmY2FzZSI+PGxhYmVsIGZvcj0iZmEtYnJpZWZjYXNlIj48aSBjbGFzcz0iZmEtYnJpZWZjYXNlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hcnJvd3MtYWx0IiB2YWx1ZT0iZmEtYXJyb3dzLWFsdCI+PGxhYmVsIGZvcj0iZmEtYXJyb3dzLWFsdCI+PGkgY2xhc3M9ImZhLWFycm93cy1hbHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWdyb3VwIiB2YWx1ZT0iZmEtZ3JvdXAiPjxsYWJlbCBmb3I9ImZhLWdyb3VwIj48aSBjbGFzcz0iZmEtZ3JvdXAiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNoYWluIiB2YWx1ZT0iZmEtY2hhaW4iPjxsYWJlbCBmb3I9ImZhLWNoYWluIj48aSBjbGFzcz0iZmEtY2hhaW4iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNsb3VkIiB2YWx1ZT0iZmEtY2xvdWQiPjxsYWJlbCBmb3I9ImZhLWNsb3VkIj48aSBjbGFzcz0iZmEtY2xvdWQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZsYXNrIiB2YWx1ZT0iZmEtZmxhc2siPjxsYWJlbCBmb3I9ImZhLWZsYXNrIj48aSBjbGFzcz0iZmEtZmxhc2siPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWN1dCIgdmFsdWU9ImZhLWN1dCI+PGxhYmVsIGZvcj0iZmEtY3V0Ij48aSBjbGFzcz0iZmEtY3V0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jb3B5IiB2YWx1ZT0iZmEtY29weSI+PGxhYmVsIGZvcj0iZmEtY29weSI+PGkgY2xhc3M9ImZhLWNvcHkiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBhcGVyY2xpcCIgdmFsdWU9ImZhLXBhcGVyY2xpcCI+PGxhYmVsIGZvcj0iZmEtcGFwZXJjbGlwIj48aSBjbGFzcz0iZmEtcGFwZXJjbGlwIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zYXZlIiB2YWx1ZT0iZmEtc2F2ZSI+PGxhYmVsIGZvcj0iZmEtc2F2ZSI+PGkgY2xhc3M9ImZhLXNhdmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNxdWFyZSIgdmFsdWU9ImZhLXNxdWFyZSI+PGxhYmVsIGZvcj0iZmEtc3F1YXJlIj48aSBjbGFzcz0iZmEtc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1uYXZpY29uIiB2YWx1ZT0iZmEtbmF2aWNvbiI+PGxhYmVsIGZvcj0iZmEtbmF2aWNvbiI+PGkgY2xhc3M9ImZhLW5hdmljb24iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWxpc3QtdWwiIHZhbHVlPSJmYS1saXN0LXVsIj48bGFiZWwgZm9yPSJmYS1saXN0LXVsIj48aSBjbGFzcz0iZmEtbGlzdC11bCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbGlzdC1vbCIgdmFsdWU9ImZhLWxpc3Qtb2wiPjxsYWJlbCBmb3I9ImZhLWxpc3Qtb2wiPjxpIGNsYXNzPSJmYS1saXN0LW9sIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zdHJpa2V0aHJvdWdoIiB2YWx1ZT0iZmEtc3RyaWtldGhyb3VnaCI+PGxhYmVsIGZvcj0iZmEtc3RyaWtldGhyb3VnaCI+PGkgY2xhc3M9ImZhLXN0cmlrZXRocm91Z2giPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXVuZGVybGluZSIgdmFsdWU9ImZhLXVuZGVybGluZSI+PGxhYmVsIGZvcj0iZmEtdW5kZXJsaW5lIj48aSBjbGFzcz0iZmEtdW5kZXJsaW5lIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10YWJsZSIgdmFsdWU9ImZhLXRhYmxlIj48bGFiZWwgZm9yPSJmYS10YWJsZSI+PGkgY2xhc3M9ImZhLXRhYmxlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1tYWdpYyIgdmFsdWU9ImZhLW1hZ2ljIj48bGFiZWwgZm9yPSJmYS1tYWdpYyI+PGkgY2xhc3M9ImZhLW1hZ2ljIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10cnVjayIgdmFsdWU9ImZhLXRydWNrIj48bGFiZWwgZm9yPSJmYS10cnVjayI+PGkgY2xhc3M9ImZhLXRydWNrIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1waW50ZXJlc3QiIHZhbHVlPSJmYS1waW50ZXJlc3QiPjxsYWJlbCBmb3I9ImZhLXBpbnRlcmVzdCI+PGkgY2xhc3M9ImZhLXBpbnRlcmVzdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGludGVyZXN0LXNxdWFyZSIgdmFsdWU9ImZhLXBpbnRlcmVzdC1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLXBpbnRlcmVzdC1zcXVhcmUiPjxpIGNsYXNzPSJmYS1waW50ZXJlc3Qtc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1nb29nbGUtcGx1cy1zcXVhcmUiIHZhbHVlPSJmYS1nb29nbGUtcGx1cy1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLWdvb2dsZS1wbHVzLXNxdWFyZSI+PGkgY2xhc3M9ImZhLWdvb2dsZS1wbHVzLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZ29vZ2xlLXBsdXMiIHZhbHVlPSJmYS1nb29nbGUtcGx1cyI+PGxhYmVsIGZvcj0iZmEtZ29vZ2xlLXBsdXMiPjxpIGNsYXNzPSJmYS1nb29nbGUtcGx1cyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbW9uZXkiIHZhbHVlPSJmYS1tb25leSI+PGxhYmVsIGZvcj0iZmEtbW9uZXkiPjxpIGNsYXNzPSJmYS1tb25leSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2FyZXQtZG93biIgdmFsdWU9ImZhLWNhcmV0LWRvd24iPjxsYWJlbCBmb3I9ImZhLWNhcmV0LWRvd24iPjxpIGNsYXNzPSJmYS1jYXJldC1kb3duIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jYXJldC11cCIgdmFsdWU9ImZhLWNhcmV0LXVwIj48bGFiZWwgZm9yPSJmYS1jYXJldC11cCI+PGkgY2xhc3M9ImZhLWNhcmV0LXVwIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jYXJldC1sZWZ0IiB2YWx1ZT0iZmEtY2FyZXQtbGVmdCI+PGxhYmVsIGZvcj0iZmEtY2FyZXQtbGVmdCI+PGkgY2xhc3M9ImZhLWNhcmV0LWxlZnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNhcmV0LXJpZ2h0IiB2YWx1ZT0iZmEtY2FyZXQtcmlnaHQiPjxsYWJlbCBmb3I9ImZhLWNhcmV0LXJpZ2h0Ij48aSBjbGFzcz0iZmEtY2FyZXQtcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNvbHVtbnMiIHZhbHVlPSJmYS1jb2x1bW5zIj48bGFiZWwgZm9yPSJmYS1jb2x1bW5zIj48aSBjbGFzcz0iZmEtY29sdW1ucyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdW5zb3J0ZWQiIHZhbHVlPSJmYS11bnNvcnRlZCI+PGxhYmVsIGZvcj0iZmEtdW5zb3J0ZWQiPjxpIGNsYXNzPSJmYS11bnNvcnRlZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc29ydC1kb3duIiB2YWx1ZT0iZmEtc29ydC1kb3duIj48bGFiZWwgZm9yPSJmYS1zb3J0LWRvd24iPjxpIGNsYXNzPSJmYS1zb3J0LWRvd24iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNvcnQtdXAiIHZhbHVlPSJmYS1zb3J0LXVwIj48bGFiZWwgZm9yPSJmYS1zb3J0LXVwIj48aSBjbGFzcz0iZmEtc29ydC11cCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZW52ZWxvcGUiIHZhbHVlPSJmYS1lbnZlbG9wZSI+PGxhYmVsIGZvcj0iZmEtZW52ZWxvcGUiPjxpIGNsYXNzPSJmYS1lbnZlbG9wZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbGlua2VkaW4iIHZhbHVlPSJmYS1saW5rZWRpbiI+PGxhYmVsIGZvcj0iZmEtbGlua2VkaW4iPjxpIGNsYXNzPSJmYS1saW5rZWRpbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcm90YXRlLWxlZnQiIHZhbHVlPSJmYS1yb3RhdGUtbGVmdCI+PGxhYmVsIGZvcj0iZmEtcm90YXRlLWxlZnQiPjxpIGNsYXNzPSJmYS1yb3RhdGUtbGVmdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbGVnYWwiIHZhbHVlPSJmYS1sZWdhbCI+PGxhYmVsIGZvcj0iZmEtbGVnYWwiPjxpIGNsYXNzPSJmYS1sZWdhbCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZGFzaGJvYXJkIiB2YWx1ZT0iZmEtZGFzaGJvYXJkIj48bGFiZWwgZm9yPSJmYS1kYXNoYm9hcmQiPjxpIGNsYXNzPSJmYS1kYXNoYm9hcmQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNvbW1lbnQtbyIgdmFsdWU9ImZhLWNvbW1lbnQtbyI+PGxhYmVsIGZvcj0iZmEtY29tbWVudC1vIj48aSBjbGFzcz0iZmEtY29tbWVudC1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jb21tZW50cy1vIiB2YWx1ZT0iZmEtY29tbWVudHMtbyI+PGxhYmVsIGZvcj0iZmEtY29tbWVudHMtbyI+PGkgY2xhc3M9ImZhLWNvbW1lbnRzLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZsYXNoIiB2YWx1ZT0iZmEtZmxhc2giPjxsYWJlbCBmb3I9ImZhLWZsYXNoIj48aSBjbGFzcz0iZmEtZmxhc2giPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNpdGVtYXAiIHZhbHVlPSJmYS1zaXRlbWFwIj48bGFiZWwgZm9yPSJmYS1zaXRlbWFwIj48aSBjbGFzcz0iZmEtc2l0ZW1hcCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdW1icmVsbGEiIHZhbHVlPSJmYS11bWJyZWxsYSI+PGxhYmVsIGZvcj0iZmEtdW1icmVsbGEiPjxpIGNsYXNzPSJmYS11bWJyZWxsYSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGFzdGUiIHZhbHVlPSJmYS1wYXN0ZSI+PGxhYmVsIGZvcj0iZmEtcGFzdGUiPjxpIGNsYXNzPSJmYS1wYXN0ZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbGlnaHRidWxiLW8iIHZhbHVlPSJmYS1saWdodGJ1bGItbyI+PGxhYmVsIGZvcj0iZmEtbGlnaHRidWxiLW8iPjxpIGNsYXNzPSJmYS1saWdodGJ1bGItbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZXhjaGFuZ2UiIHZhbHVlPSJmYS1leGNoYW5nZSI+PGxhYmVsIGZvcj0iZmEtZXhjaGFuZ2UiPjxpIGNsYXNzPSJmYS1leGNoYW5nZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2xvdWQtZG93bmxvYWQiIHZhbHVlPSJmYS1jbG91ZC1kb3dubG9hZCI+PGxhYmVsIGZvcj0iZmEtY2xvdWQtZG93bmxvYWQiPjxpIGNsYXNzPSJmYS1jbG91ZC1kb3dubG9hZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2xvdWQtdXBsb2FkIiB2YWx1ZT0iZmEtY2xvdWQtdXBsb2FkIj48bGFiZWwgZm9yPSJmYS1jbG91ZC11cGxvYWQiPjxpIGNsYXNzPSJmYS1jbG91ZC11cGxvYWQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXVzZXItbWQiIHZhbHVlPSJmYS11c2VyLW1kIj48bGFiZWwgZm9yPSJmYS11c2VyLW1kIj48aSBjbGFzcz0iZmEtdXNlci1tZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3RldGhvc2NvcGUiIHZhbHVlPSJmYS1zdGV0aG9zY29wZSI+PGxhYmVsIGZvcj0iZmEtc3RldGhvc2NvcGUiPjxpIGNsYXNzPSJmYS1zdGV0aG9zY29wZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3VpdGNhc2UiIHZhbHVlPSJmYS1zdWl0Y2FzZSI+PGxhYmVsIGZvcj0iZmEtc3VpdGNhc2UiPjxpIGNsYXNzPSJmYS1zdWl0Y2FzZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYmVsbC1vIiB2YWx1ZT0iZmEtYmVsbC1vIj48bGFiZWwgZm9yPSJmYS1iZWxsLW8iPjxpIGNsYXNzPSJmYS1iZWxsLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNvZmZlZSIgdmFsdWU9ImZhLWNvZmZlZSI+PGxhYmVsIGZvcj0iZmEtY29mZmVlIj48aSBjbGFzcz0iZmEtY29mZmVlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jdXRsZXJ5IiB2YWx1ZT0iZmEtY3V0bGVyeSI+PGxhYmVsIGZvcj0iZmEtY3V0bGVyeSI+PGkgY2xhc3M9ImZhLWN1dGxlcnkiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZpbGUtdGV4dC1vIiB2YWx1ZT0iZmEtZmlsZS10ZXh0LW8iPjxsYWJlbCBmb3I9ImZhLWZpbGUtdGV4dC1vIj48aSBjbGFzcz0iZmEtZmlsZS10ZXh0LW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJ1aWxkaW5nLW8iIHZhbHVlPSJmYS1idWlsZGluZy1vIj48bGFiZWwgZm9yPSJmYS1idWlsZGluZy1vIj48aSBjbGFzcz0iZmEtYnVpbGRpbmctbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaG9zcGl0YWwtbyIgdmFsdWU9ImZhLWhvc3BpdGFsLW8iPjxsYWJlbCBmb3I9ImZhLWhvc3BpdGFsLW8iPjxpIGNsYXNzPSJmYS1ob3NwaXRhbC1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hbWJ1bGFuY2UiIHZhbHVlPSJmYS1hbWJ1bGFuY2UiPjxsYWJlbCBmb3I9ImZhLWFtYnVsYW5jZSI+PGkgY2xhc3M9ImZhLWFtYnVsYW5jZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbWVka2l0IiB2YWx1ZT0iZmEtbWVka2l0Ij48bGFiZWwgZm9yPSJmYS1tZWRraXQiPjxpIGNsYXNzPSJmYS1tZWRraXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZpZ2h0ZXItamV0IiB2YWx1ZT0iZmEtZmlnaHRlci1qZXQiPjxsYWJlbCBmb3I9ImZhLWZpZ2h0ZXItamV0Ij48aSBjbGFzcz0iZmEtZmlnaHRlci1qZXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJlZXIiIHZhbHVlPSJmYS1iZWVyIj48bGFiZWwgZm9yPSJmYS1iZWVyIj48aSBjbGFzcz0iZmEtYmVlciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaC1zcXVhcmUiIHZhbHVlPSJmYS1oLXNxdWFyZSI+PGxhYmVsIGZvcj0iZmEtaC1zcXVhcmUiPjxpIGNsYXNzPSJmYS1oLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGx1cy1zcXVhcmUiIHZhbHVlPSJmYS1wbHVzLXNxdWFyZSI+PGxhYmVsIGZvcj0iZmEtcGx1cy1zcXVhcmUiPjxpIGNsYXNzPSJmYS1wbHVzLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYW5nbGUtZG91YmxlLWxlZnQiIHZhbHVlPSJmYS1hbmdsZS1kb3VibGUtbGVmdCI+PGxhYmVsIGZvcj0iZmEtYW5nbGUtZG91YmxlLWxlZnQiPjxpIGNsYXNzPSJmYS1hbmdsZS1kb3VibGUtbGVmdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYW5nbGUtZG91YmxlLXJpZ2h0IiB2YWx1ZT0iZmEtYW5nbGUtZG91YmxlLXJpZ2h0Ij48bGFiZWwgZm9yPSJmYS1hbmdsZS1kb3VibGUtcmlnaHQiPjxpIGNsYXNzPSJmYS1hbmdsZS1kb3VibGUtcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFuZ2xlLWRvdWJsZS11cCIgdmFsdWU9ImZhLWFuZ2xlLWRvdWJsZS11cCI+PGxhYmVsIGZvcj0iZmEtYW5nbGUtZG91YmxlLXVwIj48aSBjbGFzcz0iZmEtYW5nbGUtZG91YmxlLXVwIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hbmdsZS1kb3VibGUtZG93biIgdmFsdWU9ImZhLWFuZ2xlLWRvdWJsZS1kb3duIj48bGFiZWwgZm9yPSJmYS1hbmdsZS1kb3VibGUtZG93biI+PGkgY2xhc3M9ImZhLWFuZ2xlLWRvdWJsZS1kb3duIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hbmdsZS1sZWZ0IiB2YWx1ZT0iZmEtYW5nbGUtbGVmdCI+PGxhYmVsIGZvcj0iZmEtYW5nbGUtbGVmdCI+PGkgY2xhc3M9ImZhLWFuZ2xlLWxlZnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFuZ2xlLXJpZ2h0IiB2YWx1ZT0iZmEtYW5nbGUtcmlnaHQiPjxsYWJlbCBmb3I9ImZhLWFuZ2xlLXJpZ2h0Ij48aSBjbGFzcz0iZmEtYW5nbGUtcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFuZ2xlLXVwIiB2YWx1ZT0iZmEtYW5nbGUtdXAiPjxsYWJlbCBmb3I9ImZhLWFuZ2xlLXVwIj48aSBjbGFzcz0iZmEtYW5nbGUtdXAiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFuZ2xlLWRvd24iIHZhbHVlPSJmYS1hbmdsZS1kb3duIj48bGFiZWwgZm9yPSJmYS1hbmdsZS1kb3duIj48aSBjbGFzcz0iZmEtYW5nbGUtZG93biI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZGVza3RvcCIgdmFsdWU9ImZhLWRlc2t0b3AiPjxsYWJlbCBmb3I9ImZhLWRlc2t0b3AiPjxpIGNsYXNzPSJmYS1kZXNrdG9wIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1sYXB0b3AiIHZhbHVlPSJmYS1sYXB0b3AiPjxsYWJlbCBmb3I9ImZhLWxhcHRvcCI+PGkgY2xhc3M9ImZhLWxhcHRvcCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdGFibGV0IiB2YWx1ZT0iZmEtdGFibGV0Ij48bGFiZWwgZm9yPSJmYS10YWJsZXQiPjxpIGNsYXNzPSJmYS10YWJsZXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLW1vYmlsZS1waG9uZSIgdmFsdWU9ImZhLW1vYmlsZS1waG9uZSI+PGxhYmVsIGZvcj0iZmEtbW9iaWxlLXBob25lIj48aSBjbGFzcz0iZmEtbW9iaWxlLXBob25lIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jaXJjbGUtbyIgdmFsdWU9ImZhLWNpcmNsZS1vIj48bGFiZWwgZm9yPSJmYS1jaXJjbGUtbyI+PGkgY2xhc3M9ImZhLWNpcmNsZS1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1xdW90ZS1sZWZ0IiB2YWx1ZT0iZmEtcXVvdGUtbGVmdCI+PGxhYmVsIGZvcj0iZmEtcXVvdGUtbGVmdCI+PGkgY2xhc3M9ImZhLXF1b3RlLWxlZnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXF1b3RlLXJpZ2h0IiB2YWx1ZT0iZmEtcXVvdGUtcmlnaHQiPjxsYWJlbCBmb3I9ImZhLXF1b3RlLXJpZ2h0Ij48aSBjbGFzcz0iZmEtcXVvdGUtcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNwaW5uZXIiIHZhbHVlPSJmYS1zcGlubmVyIj48bGFiZWwgZm9yPSJmYS1zcGlubmVyIj48aSBjbGFzcz0iZmEtc3Bpbm5lciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2lyY2xlIiB2YWx1ZT0iZmEtY2lyY2xlIj48bGFiZWwgZm9yPSJmYS1jaXJjbGUiPjxpIGNsYXNzPSJmYS1jaXJjbGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLW1haWwtcmVwbHkiIHZhbHVlPSJmYS1tYWlsLXJlcGx5Ij48bGFiZWwgZm9yPSJmYS1tYWlsLXJlcGx5Ij48aSBjbGFzcz0iZmEtbWFpbC1yZXBseSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZ2l0aHViLWFsdCIgdmFsdWU9ImZhLWdpdGh1Yi1hbHQiPjxsYWJlbCBmb3I9ImZhLWdpdGh1Yi1hbHQiPjxpIGNsYXNzPSJmYS1naXRodWItYWx0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1mb2xkZXItbyIgdmFsdWU9ImZhLWZvbGRlci1vIj48bGFiZWwgZm9yPSJmYS1mb2xkZXItbyI+PGkgY2xhc3M9ImZhLWZvbGRlci1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1mb2xkZXItb3Blbi1vIiB2YWx1ZT0iZmEtZm9sZGVyLW9wZW4tbyI+PGxhYmVsIGZvcj0iZmEtZm9sZGVyLW9wZW4tbyI+PGkgY2xhc3M9ImZhLWZvbGRlci1vcGVuLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNtaWxlLW8iIHZhbHVlPSJmYS1zbWlsZS1vIj48bGFiZWwgZm9yPSJmYS1zbWlsZS1vIj48aSBjbGFzcz0iZmEtc21pbGUtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZnJvd24tbyIgdmFsdWU9ImZhLWZyb3duLW8iPjxsYWJlbCBmb3I9ImZhLWZyb3duLW8iPjxpIGNsYXNzPSJmYS1mcm93bi1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1tZWgtbyIgdmFsdWU9ImZhLW1laC1vIj48bGFiZWwgZm9yPSJmYS1tZWgtbyI+PGkgY2xhc3M9ImZhLW1laC1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1nYW1lcGFkIiB2YWx1ZT0iZmEtZ2FtZXBhZCI+PGxhYmVsIGZvcj0iZmEtZ2FtZXBhZCI+PGkgY2xhc3M9ImZhLWdhbWVwYWQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWtleWJvYXJkLW8iIHZhbHVlPSJmYS1rZXlib2FyZC1vIj48bGFiZWwgZm9yPSJmYS1rZXlib2FyZC1vIj48aSBjbGFzcz0iZmEta2V5Ym9hcmQtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmxhZy1vIiB2YWx1ZT0iZmEtZmxhZy1vIj48bGFiZWwgZm9yPSJmYS1mbGFnLW8iPjxpIGNsYXNzPSJmYS1mbGFnLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZsYWctY2hlY2tlcmVkIiB2YWx1ZT0iZmEtZmxhZy1jaGVja2VyZWQiPjxsYWJlbCBmb3I9ImZhLWZsYWctY2hlY2tlcmVkIj48aSBjbGFzcz0iZmEtZmxhZy1jaGVja2VyZWQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRlcm1pbmFsIiB2YWx1ZT0iZmEtdGVybWluYWwiPjxsYWJlbCBmb3I9ImZhLXRlcm1pbmFsIj48aSBjbGFzcz0iZmEtdGVybWluYWwiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNvZGUiIHZhbHVlPSJmYS1jb2RlIj48bGFiZWwgZm9yPSJmYS1jb2RlIj48aSBjbGFzcz0iZmEtY29kZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbWFpbC1yZXBseS1hbGwiIHZhbHVlPSJmYS1tYWlsLXJlcGx5LWFsbCI+PGxhYmVsIGZvcj0iZmEtbWFpbC1yZXBseS1hbGwiPjxpIGNsYXNzPSJmYS1tYWlsLXJlcGx5LWFsbCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3Rhci1oYWxmLWVtcHR5IiB2YWx1ZT0iZmEtc3Rhci1oYWxmLWVtcHR5Ij48bGFiZWwgZm9yPSJmYS1zdGFyLWhhbGYtZW1wdHkiPjxpIGNsYXNzPSJmYS1zdGFyLWhhbGYtZW1wdHkiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWxvY2F0aW9uLWFycm93IiB2YWx1ZT0iZmEtbG9jYXRpb24tYXJyb3ciPjxsYWJlbCBmb3I9ImZhLWxvY2F0aW9uLWFycm93Ij48aSBjbGFzcz0iZmEtbG9jYXRpb24tYXJyb3ciPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNyb3AiIHZhbHVlPSJmYS1jcm9wIj48bGFiZWwgZm9yPSJmYS1jcm9wIj48aSBjbGFzcz0iZmEtY3JvcCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY29kZS1mb3JrIiB2YWx1ZT0iZmEtY29kZS1mb3JrIj48bGFiZWwgZm9yPSJmYS1jb2RlLWZvcmsiPjxpIGNsYXNzPSJmYS1jb2RlLWZvcmsiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXVubGluayIgdmFsdWU9ImZhLXVubGluayI+PGxhYmVsIGZvcj0iZmEtdW5saW5rIj48aSBjbGFzcz0iZmEtdW5saW5rIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1xdWVzdGlvbiIgdmFsdWU9ImZhLXF1ZXN0aW9uIj48bGFiZWwgZm9yPSJmYS1xdWVzdGlvbiI+PGkgY2xhc3M9ImZhLXF1ZXN0aW9uIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1pbmZvIiB2YWx1ZT0iZmEtaW5mbyI+PGxhYmVsIGZvcj0iZmEtaW5mbyI+PGkgY2xhc3M9ImZhLWluZm8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWV4Y2xhbWF0aW9uIiB2YWx1ZT0iZmEtZXhjbGFtYXRpb24iPjxsYWJlbCBmb3I9ImZhLWV4Y2xhbWF0aW9uIj48aSBjbGFzcz0iZmEtZXhjbGFtYXRpb24iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN1cGVyc2NyaXB0IiB2YWx1ZT0iZmEtc3VwZXJzY3JpcHQiPjxsYWJlbCBmb3I9ImZhLXN1cGVyc2NyaXB0Ij48aSBjbGFzcz0iZmEtc3VwZXJzY3JpcHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN1YnNjcmlwdCIgdmFsdWU9ImZhLXN1YnNjcmlwdCI+PGxhYmVsIGZvcj0iZmEtc3Vic2NyaXB0Ij48aSBjbGFzcz0iZmEtc3Vic2NyaXB0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1lcmFzZXIiIHZhbHVlPSJmYS1lcmFzZXIiPjxsYWJlbCBmb3I9ImZhLWVyYXNlciI+PGkgY2xhc3M9ImZhLWVyYXNlciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcHV6emxlLXBpZWNlIiB2YWx1ZT0iZmEtcHV6emxlLXBpZWNlIj48bGFiZWwgZm9yPSJmYS1wdXp6bGUtcGllY2UiPjxpIGNsYXNzPSJmYS1wdXp6bGUtcGllY2UiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLW1pY3JvcGhvbmUiIHZhbHVlPSJmYS1taWNyb3Bob25lIj48bGFiZWwgZm9yPSJmYS1taWNyb3Bob25lIj48aSBjbGFzcz0iZmEtbWljcm9waG9uZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbWljcm9waG9uZS1zbGFzaCIgdmFsdWU9ImZhLW1pY3JvcGhvbmUtc2xhc2giPjxsYWJlbCBmb3I9ImZhLW1pY3JvcGhvbmUtc2xhc2giPjxpIGNsYXNzPSJmYS1taWNyb3Bob25lLXNsYXNoIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zaGllbGQiIHZhbHVlPSJmYS1zaGllbGQiPjxsYWJlbCBmb3I9ImZhLXNoaWVsZCI+PGkgY2xhc3M9ImZhLXNoaWVsZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2FsZW5kYXItbyIgdmFsdWU9ImZhLWNhbGVuZGFyLW8iPjxsYWJlbCBmb3I9ImZhLWNhbGVuZGFyLW8iPjxpIGNsYXNzPSJmYS1jYWxlbmRhci1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1maXJlLWV4dGluZ3Vpc2hlciIgdmFsdWU9ImZhLWZpcmUtZXh0aW5ndWlzaGVyIj48bGFiZWwgZm9yPSJmYS1maXJlLWV4dGluZ3Vpc2hlciI+PGkgY2xhc3M9ImZhLWZpcmUtZXh0aW5ndWlzaGVyIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1yb2NrZXQiIHZhbHVlPSJmYS1yb2NrZXQiPjxsYWJlbCBmb3I9ImZhLXJvY2tldCI+PGkgY2xhc3M9ImZhLXJvY2tldCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbWF4Y2RuIiB2YWx1ZT0iZmEtbWF4Y2RuIj48bGFiZWwgZm9yPSJmYS1tYXhjZG4iPjxpIGNsYXNzPSJmYS1tYXhjZG4iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNoZXZyb24tY2lyY2xlLWxlZnQiIHZhbHVlPSJmYS1jaGV2cm9uLWNpcmNsZS1sZWZ0Ij48bGFiZWwgZm9yPSJmYS1jaGV2cm9uLWNpcmNsZS1sZWZ0Ij48aSBjbGFzcz0iZmEtY2hldnJvbi1jaXJjbGUtbGVmdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2hldnJvbi1jaXJjbGUtcmlnaHQiIHZhbHVlPSJmYS1jaGV2cm9uLWNpcmNsZS1yaWdodCI+PGxhYmVsIGZvcj0iZmEtY2hldnJvbi1jaXJjbGUtcmlnaHQiPjxpIGNsYXNzPSJmYS1jaGV2cm9uLWNpcmNsZS1yaWdodCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2hldnJvbi1jaXJjbGUtdXAiIHZhbHVlPSJmYS1jaGV2cm9uLWNpcmNsZS11cCI+PGxhYmVsIGZvcj0iZmEtY2hldnJvbi1jaXJjbGUtdXAiPjxpIGNsYXNzPSJmYS1jaGV2cm9uLWNpcmNsZS11cCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2hldnJvbi1jaXJjbGUtZG93biIgdmFsdWU9ImZhLWNoZXZyb24tY2lyY2xlLWRvd24iPjxsYWJlbCBmb3I9ImZhLWNoZXZyb24tY2lyY2xlLWRvd24iPjxpIGNsYXNzPSJmYS1jaGV2cm9uLWNpcmNsZS1kb3duIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1odG1sNSIgdmFsdWU9ImZhLWh0bWw1Ij48bGFiZWwgZm9yPSJmYS1odG1sNSI+PGkgY2xhc3M9ImZhLWh0bWw1Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jc3MzIiB2YWx1ZT0iZmEtY3NzMyI+PGxhYmVsIGZvcj0iZmEtY3NzMyI+PGkgY2xhc3M9ImZhLWNzczMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFuY2hvciIgdmFsdWU9ImZhLWFuY2hvciI+PGxhYmVsIGZvcj0iZmEtYW5jaG9yIj48aSBjbGFzcz0iZmEtYW5jaG9yIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS11bmxvY2stYWx0IiB2YWx1ZT0iZmEtdW5sb2NrLWFsdCI+PGxhYmVsIGZvcj0iZmEtdW5sb2NrLWFsdCI+PGkgY2xhc3M9ImZhLXVubG9jay1hbHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJ1bGxzZXllIiB2YWx1ZT0iZmEtYnVsbHNleWUiPjxsYWJlbCBmb3I9ImZhLWJ1bGxzZXllIj48aSBjbGFzcz0iZmEtYnVsbHNleWUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWVsbGlwc2lzLWgiIHZhbHVlPSJmYS1lbGxpcHNpcy1oIj48bGFiZWwgZm9yPSJmYS1lbGxpcHNpcy1oIj48aSBjbGFzcz0iZmEtZWxsaXBzaXMtaCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZWxsaXBzaXMtdiIgdmFsdWU9ImZhLWVsbGlwc2lzLXYiPjxsYWJlbCBmb3I9ImZhLWVsbGlwc2lzLXYiPjxpIGNsYXNzPSJmYS1lbGxpcHNpcy12Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1yc3Mtc3F1YXJlIiB2YWx1ZT0iZmEtcnNzLXNxdWFyZSI+PGxhYmVsIGZvcj0iZmEtcnNzLXNxdWFyZSI+PGkgY2xhc3M9ImZhLXJzcy1zcXVhcmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBsYXktY2lyY2xlIiB2YWx1ZT0iZmEtcGxheS1jaXJjbGUiPjxsYWJlbCBmb3I9ImZhLXBsYXktY2lyY2xlIj48aSBjbGFzcz0iZmEtcGxheS1jaXJjbGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRpY2tldCIgdmFsdWU9ImZhLXRpY2tldCI+PGxhYmVsIGZvcj0iZmEtdGlja2V0Ij48aSBjbGFzcz0iZmEtdGlja2V0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1taW51cy1zcXVhcmUiIHZhbHVlPSJmYS1taW51cy1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLW1pbnVzLXNxdWFyZSI+PGkgY2xhc3M9ImZhLW1pbnVzLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbWludXMtc3F1YXJlLW8iIHZhbHVlPSJmYS1taW51cy1zcXVhcmUtbyI+PGxhYmVsIGZvcj0iZmEtbWludXMtc3F1YXJlLW8iPjxpIGNsYXNzPSJmYS1taW51cy1zcXVhcmUtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbGV2ZWwtdXAiIHZhbHVlPSJmYS1sZXZlbC11cCI+PGxhYmVsIGZvcj0iZmEtbGV2ZWwtdXAiPjxpIGNsYXNzPSJmYS1sZXZlbC11cCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbGV2ZWwtZG93biIgdmFsdWU9ImZhLWxldmVsLWRvd24iPjxsYWJlbCBmb3I9ImZhLWxldmVsLWRvd24iPjxpIGNsYXNzPSJmYS1sZXZlbC1kb3duIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jaGVjay1zcXVhcmUiIHZhbHVlPSJmYS1jaGVjay1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLWNoZWNrLXNxdWFyZSI+PGkgY2xhc3M9ImZhLWNoZWNrLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGVuY2lsLXNxdWFyZSIgdmFsdWU9ImZhLXBlbmNpbC1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLXBlbmNpbC1zcXVhcmUiPjxpIGNsYXNzPSJmYS1wZW5jaWwtc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1leHRlcm5hbC1saW5rLXNxdWFyZSIgdmFsdWU9ImZhLWV4dGVybmFsLWxpbmstc3F1YXJlIj48bGFiZWwgZm9yPSJmYS1leHRlcm5hbC1saW5rLXNxdWFyZSI+PGkgY2xhc3M9ImZhLWV4dGVybmFsLWxpbmstc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zaGFyZS1zcXVhcmUiIHZhbHVlPSJmYS1zaGFyZS1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLXNoYXJlLXNxdWFyZSI+PGkgY2xhc3M9ImZhLXNoYXJlLXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY29tcGFzcyIgdmFsdWU9ImZhLWNvbXBhc3MiPjxsYWJlbCBmb3I9ImZhLWNvbXBhc3MiPjxpIGNsYXNzPSJmYS1jb21wYXNzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10b2dnbGUtZG93biIgdmFsdWU9ImZhLXRvZ2dsZS1kb3duIj48bGFiZWwgZm9yPSJmYS10b2dnbGUtZG93biI+PGkgY2xhc3M9ImZhLXRvZ2dsZS1kb3duIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10b2dnbGUtdXAiIHZhbHVlPSJmYS10b2dnbGUtdXAiPjxsYWJlbCBmb3I9ImZhLXRvZ2dsZS11cCI+PGkgY2xhc3M9ImZhLXRvZ2dsZS11cCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdG9nZ2xlLXJpZ2h0IiB2YWx1ZT0iZmEtdG9nZ2xlLXJpZ2h0Ij48bGFiZWwgZm9yPSJmYS10b2dnbGUtcmlnaHQiPjxpIGNsYXNzPSJmYS10b2dnbGUtcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWV1cm8iIHZhbHVlPSJmYS1ldXJvIj48bGFiZWwgZm9yPSJmYS1ldXJvIj48aSBjbGFzcz0iZmEtZXVybyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZ2JwIiB2YWx1ZT0iZmEtZ2JwIj48bGFiZWwgZm9yPSJmYS1nYnAiPjxpIGNsYXNzPSJmYS1nYnAiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWRvbGxhciIgdmFsdWU9ImZhLWRvbGxhciI+PGxhYmVsIGZvcj0iZmEtZG9sbGFyIj48aSBjbGFzcz0iZmEtZG9sbGFyIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1ydXBlZSIgdmFsdWU9ImZhLXJ1cGVlIj48bGFiZWwgZm9yPSJmYS1ydXBlZSI+PGkgY2xhc3M9ImZhLXJ1cGVlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jbnkiIHZhbHVlPSJmYS1jbnkiPjxsYWJlbCBmb3I9ImZhLWNueSI+PGkgY2xhc3M9ImZhLWNueSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcnVibGUiIHZhbHVlPSJmYS1ydWJsZSI+PGxhYmVsIGZvcj0iZmEtcnVibGUiPjxpIGNsYXNzPSJmYS1ydWJsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtd29uIiB2YWx1ZT0iZmEtd29uIj48bGFiZWwgZm9yPSJmYS13b24iPjxpIGNsYXNzPSJmYS13b24iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJpdGNvaW4iIHZhbHVlPSJmYS1iaXRjb2luIj48bGFiZWwgZm9yPSJmYS1iaXRjb2luIj48aSBjbGFzcz0iZmEtYml0Y29pbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmlsZSIgdmFsdWU9ImZhLWZpbGUiPjxsYWJlbCBmb3I9ImZhLWZpbGUiPjxpIGNsYXNzPSJmYS1maWxlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1maWxlLXRleHQiIHZhbHVlPSJmYS1maWxlLXRleHQiPjxsYWJlbCBmb3I9ImZhLWZpbGUtdGV4dCI+PGkgY2xhc3M9ImZhLWZpbGUtdGV4dCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc29ydC1hbHBoYS1hc2MiIHZhbHVlPSJmYS1zb3J0LWFscGhhLWFzYyI+PGxhYmVsIGZvcj0iZmEtc29ydC1hbHBoYS1hc2MiPjxpIGNsYXNzPSJmYS1zb3J0LWFscGhhLWFzYyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc29ydC1hbHBoYS1kZXNjIiB2YWx1ZT0iZmEtc29ydC1hbHBoYS1kZXNjIj48bGFiZWwgZm9yPSJmYS1zb3J0LWFscGhhLWRlc2MiPjxpIGNsYXNzPSJmYS1zb3J0LWFscGhhLWRlc2MiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNvcnQtYW1vdW50LWFzYyIgdmFsdWU9ImZhLXNvcnQtYW1vdW50LWFzYyI+PGxhYmVsIGZvcj0iZmEtc29ydC1hbW91bnQtYXNjIj48aSBjbGFzcz0iZmEtc29ydC1hbW91bnQtYXNjIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zb3J0LWFtb3VudC1kZXNjIiB2YWx1ZT0iZmEtc29ydC1hbW91bnQtZGVzYyI+PGxhYmVsIGZvcj0iZmEtc29ydC1hbW91bnQtZGVzYyI+PGkgY2xhc3M9ImZhLXNvcnQtYW1vdW50LWRlc2MiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNvcnQtbnVtZXJpYy1hc2MiIHZhbHVlPSJmYS1zb3J0LW51bWVyaWMtYXNjIj48bGFiZWwgZm9yPSJmYS1zb3J0LW51bWVyaWMtYXNjIj48aSBjbGFzcz0iZmEtc29ydC1udW1lcmljLWFzYyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc29ydC1udW1lcmljLWRlc2MiIHZhbHVlPSJmYS1zb3J0LW51bWVyaWMtZGVzYyI+PGxhYmVsIGZvcj0iZmEtc29ydC1udW1lcmljLWRlc2MiPjxpIGNsYXNzPSJmYS1zb3J0LW51bWVyaWMtZGVzYyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdGh1bWJzLXVwIiB2YWx1ZT0iZmEtdGh1bWJzLXVwIj48bGFiZWwgZm9yPSJmYS10aHVtYnMtdXAiPjxpIGNsYXNzPSJmYS10aHVtYnMtdXAiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRodW1icy1kb3duIiB2YWx1ZT0iZmEtdGh1bWJzLWRvd24iPjxsYWJlbCBmb3I9ImZhLXRodW1icy1kb3duIj48aSBjbGFzcz0iZmEtdGh1bWJzLWRvd24iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXlvdXR1YmUtc3F1YXJlIiB2YWx1ZT0iZmEteW91dHViZS1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLXlvdXR1YmUtc3F1YXJlIj48aSBjbGFzcz0iZmEteW91dHViZS1zcXVhcmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXlvdXR1YmUiIHZhbHVlPSJmYS15b3V0dWJlIj48bGFiZWwgZm9yPSJmYS15b3V0dWJlIj48aSBjbGFzcz0iZmEteW91dHViZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEteGluZyIgdmFsdWU9ImZhLXhpbmciPjxsYWJlbCBmb3I9ImZhLXhpbmciPjxpIGNsYXNzPSJmYS14aW5nIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS14aW5nLXNxdWFyZSIgdmFsdWU9ImZhLXhpbmctc3F1YXJlIj48bGFiZWwgZm9yPSJmYS14aW5nLXNxdWFyZSI+PGkgY2xhc3M9ImZhLXhpbmctc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS15b3V0dWJlLXBsYXkiIHZhbHVlPSJmYS15b3V0dWJlLXBsYXkiPjxsYWJlbCBmb3I9ImZhLXlvdXR1YmUtcGxheSI+PGkgY2xhc3M9ImZhLXlvdXR1YmUtcGxheSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZHJvcGJveCIgdmFsdWU9ImZhLWRyb3Bib3giPjxsYWJlbCBmb3I9ImZhLWRyb3Bib3giPjxpIGNsYXNzPSJmYS1kcm9wYm94Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zdGFjay1vdmVyZmxvdyIgdmFsdWU9ImZhLXN0YWNrLW92ZXJmbG93Ij48bGFiZWwgZm9yPSJmYS1zdGFjay1vdmVyZmxvdyI+PGkgY2xhc3M9ImZhLXN0YWNrLW92ZXJmbG93Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1pbnN0YWdyYW0iIHZhbHVlPSJmYS1pbnN0YWdyYW0iPjxsYWJlbCBmb3I9ImZhLWluc3RhZ3JhbSI+PGkgY2xhc3M9ImZhLWluc3RhZ3JhbSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmxpY2tyIiB2YWx1ZT0iZmEtZmxpY2tyIj48bGFiZWwgZm9yPSJmYS1mbGlja3IiPjxpIGNsYXNzPSJmYS1mbGlja3IiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFkbiIgdmFsdWU9ImZhLWFkbiI+PGxhYmVsIGZvcj0iZmEtYWRuIj48aSBjbGFzcz0iZmEtYWRuIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1iaXRidWNrZXQiIHZhbHVlPSJmYS1iaXRidWNrZXQiPjxsYWJlbCBmb3I9ImZhLWJpdGJ1Y2tldCI+PGkgY2xhc3M9ImZhLWJpdGJ1Y2tldCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYml0YnVja2V0LXNxdWFyZSIgdmFsdWU9ImZhLWJpdGJ1Y2tldC1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLWJpdGJ1Y2tldC1zcXVhcmUiPjxpIGNsYXNzPSJmYS1iaXRidWNrZXQtc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10dW1ibHIiIHZhbHVlPSJmYS10dW1ibHIiPjxsYWJlbCBmb3I9ImZhLXR1bWJsciI+PGkgY2xhc3M9ImZhLXR1bWJsciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdHVtYmxyLXNxdWFyZSIgdmFsdWU9ImZhLXR1bWJsci1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLXR1bWJsci1zcXVhcmUiPjxpIGNsYXNzPSJmYS10dW1ibHItc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1sb25nLWFycm93LWRvd24iIHZhbHVlPSJmYS1sb25nLWFycm93LWRvd24iPjxsYWJlbCBmb3I9ImZhLWxvbmctYXJyb3ctZG93biI+PGkgY2xhc3M9ImZhLWxvbmctYXJyb3ctZG93biI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbG9uZy1hcnJvdy11cCIgdmFsdWU9ImZhLWxvbmctYXJyb3ctdXAiPjxsYWJlbCBmb3I9ImZhLWxvbmctYXJyb3ctdXAiPjxpIGNsYXNzPSJmYS1sb25nLWFycm93LXVwIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1sb25nLWFycm93LWxlZnQiIHZhbHVlPSJmYS1sb25nLWFycm93LWxlZnQiPjxsYWJlbCBmb3I9ImZhLWxvbmctYXJyb3ctbGVmdCI+PGkgY2xhc3M9ImZhLWxvbmctYXJyb3ctbGVmdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbG9uZy1hcnJvdy1yaWdodCIgdmFsdWU9ImZhLWxvbmctYXJyb3ctcmlnaHQiPjxsYWJlbCBmb3I9ImZhLWxvbmctYXJyb3ctcmlnaHQiPjxpIGNsYXNzPSJmYS1sb25nLWFycm93LXJpZ2h0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hcHBsZSIgdmFsdWU9ImZhLWFwcGxlIj48bGFiZWwgZm9yPSJmYS1hcHBsZSI+PGkgY2xhc3M9ImZhLWFwcGxlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS13aW5kb3dzIiB2YWx1ZT0iZmEtd2luZG93cyI+PGxhYmVsIGZvcj0iZmEtd2luZG93cyI+PGkgY2xhc3M9ImZhLXdpbmRvd3MiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFuZHJvaWQiIHZhbHVlPSJmYS1hbmRyb2lkIj48bGFiZWwgZm9yPSJmYS1hbmRyb2lkIj48aSBjbGFzcz0iZmEtYW5kcm9pZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbGludXgiIHZhbHVlPSJmYS1saW51eCI+PGxhYmVsIGZvcj0iZmEtbGludXgiPjxpIGNsYXNzPSJmYS1saW51eCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZHJpYmJibGUiIHZhbHVlPSJmYS1kcmliYmJsZSI+PGxhYmVsIGZvcj0iZmEtZHJpYmJibGUiPjxpIGNsYXNzPSJmYS1kcmliYmJsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc2t5cGUiIHZhbHVlPSJmYS1za3lwZSI+PGxhYmVsIGZvcj0iZmEtc2t5cGUiPjxpIGNsYXNzPSJmYS1za3lwZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZm91cnNxdWFyZSIgdmFsdWU9ImZhLWZvdXJzcXVhcmUiPjxsYWJlbCBmb3I9ImZhLWZvdXJzcXVhcmUiPjxpIGNsYXNzPSJmYS1mb3Vyc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10cmVsbG8iIHZhbHVlPSJmYS10cmVsbG8iPjxsYWJlbCBmb3I9ImZhLXRyZWxsbyI+PGkgY2xhc3M9ImZhLXRyZWxsbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmVtYWxlIiB2YWx1ZT0iZmEtZmVtYWxlIj48bGFiZWwgZm9yPSJmYS1mZW1hbGUiPjxpIGNsYXNzPSJmYS1mZW1hbGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLW1hbGUiIHZhbHVlPSJmYS1tYWxlIj48bGFiZWwgZm9yPSJmYS1tYWxlIj48aSBjbGFzcz0iZmEtbWFsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZ2l0dGlwIiB2YWx1ZT0iZmEtZ2l0dGlwIj48bGFiZWwgZm9yPSJmYS1naXR0aXAiPjxpIGNsYXNzPSJmYS1naXR0aXAiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN1bi1vIiB2YWx1ZT0iZmEtc3VuLW8iPjxsYWJlbCBmb3I9ImZhLXN1bi1vIj48aSBjbGFzcz0iZmEtc3VuLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLW1vb24tbyIgdmFsdWU9ImZhLW1vb24tbyI+PGxhYmVsIGZvcj0iZmEtbW9vbi1vIj48aSBjbGFzcz0iZmEtbW9vbi1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hcmNoaXZlIiB2YWx1ZT0iZmEtYXJjaGl2ZSI+PGxhYmVsIGZvcj0iZmEtYXJjaGl2ZSI+PGkgY2xhc3M9ImZhLWFyY2hpdmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJ1ZyIgdmFsdWU9ImZhLWJ1ZyI+PGxhYmVsIGZvcj0iZmEtYnVnIj48aSBjbGFzcz0iZmEtYnVnIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS12ayIgdmFsdWU9ImZhLXZrIj48bGFiZWwgZm9yPSJmYS12ayI+PGkgY2xhc3M9ImZhLXZrIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS13ZWlibyIgdmFsdWU9ImZhLXdlaWJvIj48bGFiZWwgZm9yPSJmYS13ZWlibyI+PGkgY2xhc3M9ImZhLXdlaWJvIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1yZW5yZW4iIHZhbHVlPSJmYS1yZW5yZW4iPjxsYWJlbCBmb3I9ImZhLXJlbnJlbiI+PGkgY2xhc3M9ImZhLXJlbnJlbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGFnZWxpbmVzIiB2YWx1ZT0iZmEtcGFnZWxpbmVzIj48bGFiZWwgZm9yPSJmYS1wYWdlbGluZXMiPjxpIGNsYXNzPSJmYS1wYWdlbGluZXMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN0YWNrLWV4Y2hhbmdlIiB2YWx1ZT0iZmEtc3RhY2stZXhjaGFuZ2UiPjxsYWJlbCBmb3I9ImZhLXN0YWNrLWV4Y2hhbmdlIj48aSBjbGFzcz0iZmEtc3RhY2stZXhjaGFuZ2UiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFycm93LWNpcmNsZS1vLXJpZ2h0IiB2YWx1ZT0iZmEtYXJyb3ctY2lyY2xlLW8tcmlnaHQiPjxsYWJlbCBmb3I9ImZhLWFycm93LWNpcmNsZS1vLXJpZ2h0Ij48aSBjbGFzcz0iZmEtYXJyb3ctY2lyY2xlLW8tcmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWFycm93LWNpcmNsZS1vLWxlZnQiIHZhbHVlPSJmYS1hcnJvdy1jaXJjbGUtby1sZWZ0Ij48bGFiZWwgZm9yPSJmYS1hcnJvdy1jaXJjbGUtby1sZWZ0Ij48aSBjbGFzcz0iZmEtYXJyb3ctY2lyY2xlLW8tbGVmdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdG9nZ2xlLWxlZnQiIHZhbHVlPSJmYS10b2dnbGUtbGVmdCI+PGxhYmVsIGZvcj0iZmEtdG9nZ2xlLWxlZnQiPjxpIGNsYXNzPSJmYS10b2dnbGUtbGVmdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZG90LWNpcmNsZS1vIiB2YWx1ZT0iZmEtZG90LWNpcmNsZS1vIj48bGFiZWwgZm9yPSJmYS1kb3QtY2lyY2xlLW8iPjxpIGNsYXNzPSJmYS1kb3QtY2lyY2xlLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXdoZWVsY2hhaXIiIHZhbHVlPSJmYS13aGVlbGNoYWlyIj48bGFiZWwgZm9yPSJmYS13aGVlbGNoYWlyIj48aSBjbGFzcz0iZmEtd2hlZWxjaGFpciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdmltZW8tc3F1YXJlIiB2YWx1ZT0iZmEtdmltZW8tc3F1YXJlIj48bGFiZWwgZm9yPSJmYS12aW1lby1zcXVhcmUiPjxpIGNsYXNzPSJmYS12aW1lby1zcXVhcmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXR1cmtpc2gtbGlyYSIgdmFsdWU9ImZhLXR1cmtpc2gtbGlyYSI+PGxhYmVsIGZvcj0iZmEtdHVya2lzaC1saXJhIj48aSBjbGFzcz0iZmEtdHVya2lzaC1saXJhIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1wbHVzLXNxdWFyZS1vIiB2YWx1ZT0iZmEtcGx1cy1zcXVhcmUtbyI+PGxhYmVsIGZvcj0iZmEtcGx1cy1zcXVhcmUtbyI+PGkgY2xhc3M9ImZhLXBsdXMtc3F1YXJlLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNwYWNlLXNodXR0bGUiIHZhbHVlPSJmYS1zcGFjZS1zaHV0dGxlIj48bGFiZWwgZm9yPSJmYS1zcGFjZS1zaHV0dGxlIj48aSBjbGFzcz0iZmEtc3BhY2Utc2h1dHRsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc2xhY2siIHZhbHVlPSJmYS1zbGFjayI+PGxhYmVsIGZvcj0iZmEtc2xhY2siPjxpIGNsYXNzPSJmYS1zbGFjayI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZW52ZWxvcGUtc3F1YXJlIiB2YWx1ZT0iZmEtZW52ZWxvcGUtc3F1YXJlIj48bGFiZWwgZm9yPSJmYS1lbnZlbG9wZS1zcXVhcmUiPjxpIGNsYXNzPSJmYS1lbnZlbG9wZS1zcXVhcmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXdvcmRwcmVzcyIgdmFsdWU9ImZhLXdvcmRwcmVzcyI+PGxhYmVsIGZvcj0iZmEtd29yZHByZXNzIj48aSBjbGFzcz0iZmEtd29yZHByZXNzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1vcGVuaWQiIHZhbHVlPSJmYS1vcGVuaWQiPjxsYWJlbCBmb3I9ImZhLW9wZW5pZCI+PGkgY2xhc3M9ImZhLW9wZW5pZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaW5zdGl0dXRpb24iIHZhbHVlPSJmYS1pbnN0aXR1dGlvbiI+PGxhYmVsIGZvcj0iZmEtaW5zdGl0dXRpb24iPjxpIGNsYXNzPSJmYS1pbnN0aXR1dGlvbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbW9ydGFyLWJvYXJkIiB2YWx1ZT0iZmEtbW9ydGFyLWJvYXJkIj48bGFiZWwgZm9yPSJmYS1tb3J0YXItYm9hcmQiPjxpIGNsYXNzPSJmYS1tb3J0YXItYm9hcmQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXlhaG9vIiB2YWx1ZT0iZmEteWFob28iPjxsYWJlbCBmb3I9ImZhLXlhaG9vIj48aSBjbGFzcz0iZmEteWFob28iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWdvb2dsZSIgdmFsdWU9ImZhLWdvb2dsZSI+PGxhYmVsIGZvcj0iZmEtZ29vZ2xlIj48aSBjbGFzcz0iZmEtZ29vZ2xlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1yZWRkaXQiIHZhbHVlPSJmYS1yZWRkaXQiPjxsYWJlbCBmb3I9ImZhLXJlZGRpdCI+PGkgY2xhc3M9ImZhLXJlZGRpdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcmVkZGl0LXNxdWFyZSIgdmFsdWU9ImZhLXJlZGRpdC1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLXJlZGRpdC1zcXVhcmUiPjxpIGNsYXNzPSJmYS1yZWRkaXQtc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zdHVtYmxldXBvbi1jaXJjbGUiIHZhbHVlPSJmYS1zdHVtYmxldXBvbi1jaXJjbGUiPjxsYWJlbCBmb3I9ImZhLXN0dW1ibGV1cG9uLWNpcmNsZSI+PGkgY2xhc3M9ImZhLXN0dW1ibGV1cG9uLWNpcmNsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3R1bWJsZXVwb24iIHZhbHVlPSJmYS1zdHVtYmxldXBvbiI+PGxhYmVsIGZvcj0iZmEtc3R1bWJsZXVwb24iPjxpIGNsYXNzPSJmYS1zdHVtYmxldXBvbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZGVsaWNpb3VzIiB2YWx1ZT0iZmEtZGVsaWNpb3VzIj48bGFiZWwgZm9yPSJmYS1kZWxpY2lvdXMiPjxpIGNsYXNzPSJmYS1kZWxpY2lvdXMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWRpZ2ciIHZhbHVlPSJmYS1kaWdnIj48bGFiZWwgZm9yPSJmYS1kaWdnIj48aSBjbGFzcz0iZmEtZGlnZyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGllZC1waXBlciIgdmFsdWU9ImZhLXBpZWQtcGlwZXIiPjxsYWJlbCBmb3I9ImZhLXBpZWQtcGlwZXIiPjxpIGNsYXNzPSJmYS1waWVkLXBpcGVyIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1waWVkLXBpcGVyLWFsdCIgdmFsdWU9ImZhLXBpZWQtcGlwZXItYWx0Ij48bGFiZWwgZm9yPSJmYS1waWVkLXBpcGVyLWFsdCI+PGkgY2xhc3M9ImZhLXBpZWQtcGlwZXItYWx0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1kcnVwYWwiIHZhbHVlPSJmYS1kcnVwYWwiPjxsYWJlbCBmb3I9ImZhLWRydXBhbCI+PGkgY2xhc3M9ImZhLWRydXBhbCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtam9vbWxhIiB2YWx1ZT0iZmEtam9vbWxhIj48bGFiZWwgZm9yPSJmYS1qb29tbGEiPjxpIGNsYXNzPSJmYS1qb29tbGEiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWxhbmd1YWdlIiB2YWx1ZT0iZmEtbGFuZ3VhZ2UiPjxsYWJlbCBmb3I9ImZhLWxhbmd1YWdlIj48aSBjbGFzcz0iZmEtbGFuZ3VhZ2UiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZheCIgdmFsdWU9ImZhLWZheCI+PGxhYmVsIGZvcj0iZmEtZmF4Ij48aSBjbGFzcz0iZmEtZmF4Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1idWlsZGluZyIgdmFsdWU9ImZhLWJ1aWxkaW5nIj48bGFiZWwgZm9yPSJmYS1idWlsZGluZyI+PGkgY2xhc3M9ImZhLWJ1aWxkaW5nIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jaGlsZCIgdmFsdWU9ImZhLWNoaWxkIj48bGFiZWwgZm9yPSJmYS1jaGlsZCI+PGkgY2xhc3M9ImZhLWNoaWxkIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1wYXciIHZhbHVlPSJmYS1wYXciPjxsYWJlbCBmb3I9ImZhLXBhdyI+PGkgY2xhc3M9ImZhLXBhdyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3Bvb24iIHZhbHVlPSJmYS1zcG9vbiI+PGxhYmVsIGZvcj0iZmEtc3Bvb24iPjxpIGNsYXNzPSJmYS1zcG9vbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY3ViZSIgdmFsdWU9ImZhLWN1YmUiPjxsYWJlbCBmb3I9ImZhLWN1YmUiPjxpIGNsYXNzPSJmYS1jdWJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jdWJlcyIgdmFsdWU9ImZhLWN1YmVzIj48bGFiZWwgZm9yPSJmYS1jdWJlcyI+PGkgY2xhc3M9ImZhLWN1YmVzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1iZWhhbmNlIiB2YWx1ZT0iZmEtYmVoYW5jZSI+PGxhYmVsIGZvcj0iZmEtYmVoYW5jZSI+PGkgY2xhc3M9ImZhLWJlaGFuY2UiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJlaGFuY2Utc3F1YXJlIiB2YWx1ZT0iZmEtYmVoYW5jZS1zcXVhcmUiPjxsYWJlbCBmb3I9ImZhLWJlaGFuY2Utc3F1YXJlIj48aSBjbGFzcz0iZmEtYmVoYW5jZS1zcXVhcmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN0ZWFtIiB2YWx1ZT0iZmEtc3RlYW0iPjxsYWJlbCBmb3I9ImZhLXN0ZWFtIj48aSBjbGFzcz0iZmEtc3RlYW0iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXN0ZWFtLXNxdWFyZSIgdmFsdWU9ImZhLXN0ZWFtLXNxdWFyZSI+PGxhYmVsIGZvcj0iZmEtc3RlYW0tc3F1YXJlIj48aSBjbGFzcz0iZmEtc3RlYW0tc3F1YXJlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1yZWN5Y2xlIiB2YWx1ZT0iZmEtcmVjeWNsZSI+PGxhYmVsIGZvcj0iZmEtcmVjeWNsZSI+PGkgY2xhc3M9ImZhLXJlY3ljbGUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWF1dG9tb2JpbGUiIHZhbHVlPSJmYS1hdXRvbW9iaWxlIj48bGFiZWwgZm9yPSJmYS1hdXRvbW9iaWxlIj48aSBjbGFzcz0iZmEtYXV0b21vYmlsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2FiIiB2YWx1ZT0iZmEtY2FiIj48bGFiZWwgZm9yPSJmYS1jYWIiPjxpIGNsYXNzPSJmYS1jYWIiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRyZWUiIHZhbHVlPSJmYS10cmVlIj48bGFiZWwgZm9yPSJmYS10cmVlIj48aSBjbGFzcz0iZmEtdHJlZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc3BvdGlmeSIgdmFsdWU9ImZhLXNwb3RpZnkiPjxsYWJlbCBmb3I9ImZhLXNwb3RpZnkiPjxpIGNsYXNzPSJmYS1zcG90aWZ5Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1kZXZpYW50YXJ0IiB2YWx1ZT0iZmEtZGV2aWFudGFydCI+PGxhYmVsIGZvcj0iZmEtZGV2aWFudGFydCI+PGkgY2xhc3M9ImZhLWRldmlhbnRhcnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNvdW5kY2xvdWQiIHZhbHVlPSJmYS1zb3VuZGNsb3VkIj48bGFiZWwgZm9yPSJmYS1zb3VuZGNsb3VkIj48aSBjbGFzcz0iZmEtc291bmRjbG91ZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZGF0YWJhc2UiIHZhbHVlPSJmYS1kYXRhYmFzZSI+PGxhYmVsIGZvcj0iZmEtZGF0YWJhc2UiPjxpIGNsYXNzPSJmYS1kYXRhYmFzZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmlsZS1wZGYtbyIgdmFsdWU9ImZhLWZpbGUtcGRmLW8iPjxsYWJlbCBmb3I9ImZhLWZpbGUtcGRmLW8iPjxpIGNsYXNzPSJmYS1maWxlLXBkZi1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1maWxlLXdvcmQtbyIgdmFsdWU9ImZhLWZpbGUtd29yZC1vIj48bGFiZWwgZm9yPSJmYS1maWxlLXdvcmQtbyI+PGkgY2xhc3M9ImZhLWZpbGUtd29yZC1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1maWxlLWV4Y2VsLW8iIHZhbHVlPSJmYS1maWxlLWV4Y2VsLW8iPjxsYWJlbCBmb3I9ImZhLWZpbGUtZXhjZWwtbyI+PGkgY2xhc3M9ImZhLWZpbGUtZXhjZWwtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmlsZS1wb3dlcnBvaW50LW8iIHZhbHVlPSJmYS1maWxlLXBvd2VycG9pbnQtbyI+PGxhYmVsIGZvcj0iZmEtZmlsZS1wb3dlcnBvaW50LW8iPjxpIGNsYXNzPSJmYS1maWxlLXBvd2VycG9pbnQtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmlsZS1waG90by1vIiB2YWx1ZT0iZmEtZmlsZS1waG90by1vIj48bGFiZWwgZm9yPSJmYS1maWxlLXBob3RvLW8iPjxpIGNsYXNzPSJmYS1maWxlLXBob3RvLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZpbGUtemlwLW8iIHZhbHVlPSJmYS1maWxlLXppcC1vIj48bGFiZWwgZm9yPSJmYS1maWxlLXppcC1vIj48aSBjbGFzcz0iZmEtZmlsZS16aXAtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZmlsZS1zb3VuZC1vIiB2YWx1ZT0iZmEtZmlsZS1zb3VuZC1vIj48bGFiZWwgZm9yPSJmYS1maWxlLXNvdW5kLW8iPjxpIGNsYXNzPSJmYS1maWxlLXNvdW5kLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWZpbGUtbW92aWUtbyIgdmFsdWU9ImZhLWZpbGUtbW92aWUtbyI+PGxhYmVsIGZvcj0iZmEtZmlsZS1tb3ZpZS1vIj48aSBjbGFzcz0iZmEtZmlsZS1tb3ZpZS1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1maWxlLWNvZGUtbyIgdmFsdWU9ImZhLWZpbGUtY29kZS1vIj48bGFiZWwgZm9yPSJmYS1maWxlLWNvZGUtbyI+PGkgY2xhc3M9ImZhLWZpbGUtY29kZS1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS12aW5lIiB2YWx1ZT0iZmEtdmluZSI+PGxhYmVsIGZvcj0iZmEtdmluZSI+PGkgY2xhc3M9ImZhLXZpbmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNvZGVwZW4iIHZhbHVlPSJmYS1jb2RlcGVuIj48bGFiZWwgZm9yPSJmYS1jb2RlcGVuIj48aSBjbGFzcz0iZmEtY29kZXBlbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtanNmaWRkbGUiIHZhbHVlPSJmYS1qc2ZpZGRsZSI+PGxhYmVsIGZvcj0iZmEtanNmaWRkbGUiPjxpIGNsYXNzPSJmYS1qc2ZpZGRsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbGlmZS1ib3V5IiB2YWx1ZT0iZmEtbGlmZS1ib3V5Ij48bGFiZWwgZm9yPSJmYS1saWZlLWJvdXkiPjxpIGNsYXNzPSJmYS1saWZlLWJvdXkiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNpcmNsZS1vLW5vdGNoIiB2YWx1ZT0iZmEtY2lyY2xlLW8tbm90Y2giPjxsYWJlbCBmb3I9ImZhLWNpcmNsZS1vLW5vdGNoIj48aSBjbGFzcz0iZmEtY2lyY2xlLW8tbm90Y2giPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXJhIiB2YWx1ZT0iZmEtcmEiPjxsYWJlbCBmb3I9ImZhLXJhIj48aSBjbGFzcz0iZmEtcmEiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWdlIiB2YWx1ZT0iZmEtZ2UiPjxsYWJlbCBmb3I9ImZhLWdlIj48aSBjbGFzcz0iZmEtZ2UiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWdpdC1zcXVhcmUiIHZhbHVlPSJmYS1naXQtc3F1YXJlIj48bGFiZWwgZm9yPSJmYS1naXQtc3F1YXJlIj48aSBjbGFzcz0iZmEtZ2l0LXNxdWFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtZ2l0IiB2YWx1ZT0iZmEtZ2l0Ij48bGFiZWwgZm9yPSJmYS1naXQiPjxpIGNsYXNzPSJmYS1naXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWhhY2tlci1uZXdzIiB2YWx1ZT0iZmEtaGFja2VyLW5ld3MiPjxsYWJlbCBmb3I9ImZhLWhhY2tlci1uZXdzIj48aSBjbGFzcz0iZmEtaGFja2VyLW5ld3MiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRlbmNlbnQtd2VpYm8iIHZhbHVlPSJmYS10ZW5jZW50LXdlaWJvIj48bGFiZWwgZm9yPSJmYS10ZW5jZW50LXdlaWJvIj48aSBjbGFzcz0iZmEtdGVuY2VudC13ZWlibyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcXEiIHZhbHVlPSJmYS1xcSI+PGxhYmVsIGZvcj0iZmEtcXEiPjxpIGNsYXNzPSJmYS1xcSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtd2VjaGF0IiB2YWx1ZT0iZmEtd2VjaGF0Ij48bGFiZWwgZm9yPSJmYS13ZWNoYXQiPjxpIGNsYXNzPSJmYS13ZWNoYXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNlbmQiIHZhbHVlPSJmYS1zZW5kIj48bGFiZWwgZm9yPSJmYS1zZW5kIj48aSBjbGFzcz0iZmEtc2VuZCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc2VuZC1vIiB2YWx1ZT0iZmEtc2VuZC1vIj48bGFiZWwgZm9yPSJmYS1zZW5kLW8iPjxpIGNsYXNzPSJmYS1zZW5kLW8iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWhpc3RvcnkiIHZhbHVlPSJmYS1oaXN0b3J5Ij48bGFiZWwgZm9yPSJmYS1oaXN0b3J5Ij48aSBjbGFzcz0iZmEtaGlzdG9yeSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2lyY2xlLXRoaW4iIHZhbHVlPSJmYS1jaXJjbGUtdGhpbiI+PGxhYmVsIGZvcj0iZmEtY2lyY2xlLXRoaW4iPjxpIGNsYXNzPSJmYS1jaXJjbGUtdGhpbiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtaGVhZGVyIiB2YWx1ZT0iZmEtaGVhZGVyIj48bGFiZWwgZm9yPSJmYS1oZWFkZXIiPjxpIGNsYXNzPSJmYS1oZWFkZXIiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBhcmFncmFwaCIgdmFsdWU9ImZhLXBhcmFncmFwaCI+PGxhYmVsIGZvcj0iZmEtcGFyYWdyYXBoIj48aSBjbGFzcz0iZmEtcGFyYWdyYXBoIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zbGlkZXJzIiB2YWx1ZT0iZmEtc2xpZGVycyI+PGxhYmVsIGZvcj0iZmEtc2xpZGVycyI+PGkgY2xhc3M9ImZhLXNsaWRlcnMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNoYXJlLWFsdCIgdmFsdWU9ImZhLXNoYXJlLWFsdCI+PGxhYmVsIGZvcj0iZmEtc2hhcmUtYWx0Ij48aSBjbGFzcz0iZmEtc2hhcmUtYWx0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1zaGFyZS1hbHQtc3F1YXJlIiB2YWx1ZT0iZmEtc2hhcmUtYWx0LXNxdWFyZSI+PGxhYmVsIGZvcj0iZmEtc2hhcmUtYWx0LXNxdWFyZSI+PGkgY2xhc3M9ImZhLXNoYXJlLWFsdC1zcXVhcmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJvbWIiIHZhbHVlPSJmYS1ib21iIj48bGFiZWwgZm9yPSJmYS1ib21iIj48aSBjbGFzcz0iZmEtYm9tYiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtc29jY2VyLWJhbGwtbyIgdmFsdWU9ImZhLXNvY2Nlci1iYWxsLW8iPjxsYWJlbCBmb3I9ImZhLXNvY2Nlci1iYWxsLW8iPjxpIGNsYXNzPSJmYS1zb2NjZXItYmFsbC1vIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS10dHkiIHZhbHVlPSJmYS10dHkiPjxsYWJlbCBmb3I9ImZhLXR0eSI+PGkgY2xhc3M9ImZhLXR0eSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYmlub2N1bGFycyIgdmFsdWU9ImZhLWJpbm9jdWxhcnMiPjxsYWJlbCBmb3I9ImZhLWJpbm9jdWxhcnMiPjxpIGNsYXNzPSJmYS1iaW5vY3VsYXJzIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1wbHVnIiB2YWx1ZT0iZmEtcGx1ZyI+PGxhYmVsIGZvcj0iZmEtcGx1ZyI+PGkgY2xhc3M9ImZhLXBsdWciPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNsaWRlc2hhcmUiIHZhbHVlPSJmYS1zbGlkZXNoYXJlIj48bGFiZWwgZm9yPSJmYS1zbGlkZXNoYXJlIj48aSBjbGFzcz0iZmEtc2xpZGVzaGFyZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdHdpdGNoIiB2YWx1ZT0iZmEtdHdpdGNoIj48bGFiZWwgZm9yPSJmYS10d2l0Y2giPjxpIGNsYXNzPSJmYS10d2l0Y2giPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXllbHAiIHZhbHVlPSJmYS15ZWxwIj48bGFiZWwgZm9yPSJmYS15ZWxwIj48aSBjbGFzcz0iZmEteWVscCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtbmV3c3BhcGVyLW8iIHZhbHVlPSJmYS1uZXdzcGFwZXItbyI+PGxhYmVsIGZvcj0iZmEtbmV3c3BhcGVyLW8iPjxpIGNsYXNzPSJmYS1uZXdzcGFwZXItbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtd2lmaSIgdmFsdWU9ImZhLXdpZmkiPjxsYWJlbCBmb3I9ImZhLXdpZmkiPjxpIGNsYXNzPSJmYS13aWZpIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jYWxjdWxhdG9yIiB2YWx1ZT0iZmEtY2FsY3VsYXRvciI+PGxhYmVsIGZvcj0iZmEtY2FsY3VsYXRvciI+PGkgY2xhc3M9ImZhLWNhbGN1bGF0b3IiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBheXBhbCIgdmFsdWU9ImZhLXBheXBhbCI+PGxhYmVsIGZvcj0iZmEtcGF5cGFsIj48aSBjbGFzcz0iZmEtcGF5cGFsIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1nb29nbGUtd2FsbGV0IiB2YWx1ZT0iZmEtZ29vZ2xlLXdhbGxldCI+PGxhYmVsIGZvcj0iZmEtZ29vZ2xlLXdhbGxldCI+PGkgY2xhc3M9ImZhLWdvb2dsZS13YWxsZXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNjLXZpc2EiIHZhbHVlPSJmYS1jYy12aXNhIj48bGFiZWwgZm9yPSJmYS1jYy12aXNhIj48aSBjbGFzcz0iZmEtY2MtdmlzYSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY2MtbWFzdGVyY2FyZCIgdmFsdWU9ImZhLWNjLW1hc3RlcmNhcmQiPjxsYWJlbCBmb3I9ImZhLWNjLW1hc3RlcmNhcmQiPjxpIGNsYXNzPSJmYS1jYy1tYXN0ZXJjYXJkIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jYy1kaXNjb3ZlciIgdmFsdWU9ImZhLWNjLWRpc2NvdmVyIj48bGFiZWwgZm9yPSJmYS1jYy1kaXNjb3ZlciI+PGkgY2xhc3M9ImZhLWNjLWRpc2NvdmVyIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jYy1hbWV4IiB2YWx1ZT0iZmEtY2MtYW1leCI+PGxhYmVsIGZvcj0iZmEtY2MtYW1leCI+PGkgY2xhc3M9ImZhLWNjLWFtZXgiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNjLXBheXBhbCIgdmFsdWU9ImZhLWNjLXBheXBhbCI+PGxhYmVsIGZvcj0iZmEtY2MtcGF5cGFsIj48aSBjbGFzcz0iZmEtY2MtcGF5cGFsIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1jYy1zdHJpcGUiIHZhbHVlPSJmYS1jYy1zdHJpcGUiPjxsYWJlbCBmb3I9ImZhLWNjLXN0cmlwZSI+PGkgY2xhc3M9ImZhLWNjLXN0cmlwZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYmVsbC1zbGFzaCIgdmFsdWU9ImZhLWJlbGwtc2xhc2giPjxsYWJlbCBmb3I9ImZhLWJlbGwtc2xhc2giPjxpIGNsYXNzPSJmYS1iZWxsLXNsYXNoIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1iZWxsLXNsYXNoLW8iIHZhbHVlPSJmYS1iZWxsLXNsYXNoLW8iPjxsYWJlbCBmb3I9ImZhLWJlbGwtc2xhc2gtbyI+PGkgY2xhc3M9ImZhLWJlbGwtc2xhc2gtbyI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdHJhc2giIHZhbHVlPSJmYS10cmFzaCI+PGxhYmVsIGZvcj0iZmEtdHJhc2giPjxpIGNsYXNzPSJmYS10cmFzaCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtY29weXJpZ2h0IiB2YWx1ZT0iZmEtY29weXJpZ2h0Ij48bGFiZWwgZm9yPSJmYS1jb3B5cmlnaHQiPjxpIGNsYXNzPSJmYS1jb3B5cmlnaHQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWF0IiB2YWx1ZT0iZmEtYXQiPjxsYWJlbCBmb3I9ImZhLWF0Ij48aSBjbGFzcz0iZmEtYXQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWV5ZWRyb3BwZXIiIHZhbHVlPSJmYS1leWVkcm9wcGVyIj48bGFiZWwgZm9yPSJmYS1leWVkcm9wcGVyIj48aSBjbGFzcz0iZmEtZXllZHJvcHBlciI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtcGFpbnQtYnJ1c2giIHZhbHVlPSJmYS1wYWludC1icnVzaCI+PGxhYmVsIGZvcj0iZmEtcGFpbnQtYnJ1c2giPjxpIGNsYXNzPSJmYS1wYWludC1icnVzaCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYmlydGhkYXktY2FrZSIgdmFsdWU9ImZhLWJpcnRoZGF5LWNha2UiPjxsYWJlbCBmb3I9ImZhLWJpcnRoZGF5LWNha2UiPjxpIGNsYXNzPSJmYS1iaXJ0aGRheS1jYWtlIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1hcmVhLWNoYXJ0IiB2YWx1ZT0iZmEtYXJlYS1jaGFydCI+PGxhYmVsIGZvcj0iZmEtYXJlYS1jaGFydCI+PGkgY2xhc3M9ImZhLWFyZWEtY2hhcnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXBpZS1jaGFydCIgdmFsdWU9ImZhLXBpZS1jaGFydCI+PGxhYmVsIGZvcj0iZmEtcGllLWNoYXJ0Ij48aSBjbGFzcz0iZmEtcGllLWNoYXJ0Ij48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1saW5lLWNoYXJ0IiB2YWx1ZT0iZmEtbGluZS1jaGFydCI+PGxhYmVsIGZvcj0iZmEtbGluZS1jaGFydCI+PGkgY2xhc3M9ImZhLWxpbmUtY2hhcnQiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWxhc3RmbSIgdmFsdWU9ImZhLWxhc3RmbSI+PGxhYmVsIGZvcj0iZmEtbGFzdGZtIj48aSBjbGFzcz0iZmEtbGFzdGZtIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1sYXN0Zm0tc3F1YXJlIiB2YWx1ZT0iZmEtbGFzdGZtLXNxdWFyZSI+PGxhYmVsIGZvcj0iZmEtbGFzdGZtLXNxdWFyZSI+PGkgY2xhc3M9ImZhLWxhc3RmbS1zcXVhcmUiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXRvZ2dsZS1vZmYiIHZhbHVlPSJmYS10b2dnbGUtb2ZmIj48bGFiZWwgZm9yPSJmYS10b2dnbGUtb2ZmIj48aSBjbGFzcz0iZmEtdG9nZ2xlLW9mZiI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtdG9nZ2xlLW9uIiB2YWx1ZT0iZmEtdG9nZ2xlLW9uIj48bGFiZWwgZm9yPSJmYS10b2dnbGUtb24iPjxpIGNsYXNzPSJmYS10b2dnbGUtb24iPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWJpY3ljbGUiIHZhbHVlPSJmYS1iaWN5Y2xlIj48bGFiZWwgZm9yPSJmYS1iaWN5Y2xlIj48aSBjbGFzcz0iZmEtYmljeWNsZSI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYnVzIiB2YWx1ZT0iZmEtYnVzIj48bGFiZWwgZm9yPSJmYS1idXMiPjxpIGNsYXNzPSJmYS1idXMiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWlveGhvc3QiIHZhbHVlPSJmYS1pb3hob3N0Ij48bGFiZWwgZm9yPSJmYS1pb3hob3N0Ij48aSBjbGFzcz0iZmEtaW94aG9zdCI+PC9pPjwvbGFiZWw+PC9saT4NCgkJPGxpPjxpbnB1dCB0eXBlPSJyYWRpbyIgbmFtZT0iaWNvbmZvbnRzX25hbWUiICBpZD0iZmEtYW5nZWxsaXN0IiB2YWx1ZT0iZmEtYW5nZWxsaXN0Ij48bGFiZWwgZm9yPSJmYS1hbmdlbGxpc3QiPjxpIGNsYXNzPSJmYS1hbmdlbGxpc3QiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLWNjIiB2YWx1ZT0iZmEtY2MiPjxsYWJlbCBmb3I9ImZhLWNjIj48aSBjbGFzcz0iZmEtY2MiPjwvaT48L2xhYmVsPjwvbGk+DQoJCTxsaT48aW5wdXQgdHlwZT0icmFkaW8iIG5hbWU9Imljb25mb250c19uYW1lIiAgaWQ9ImZhLXNoZWtlbCIgdmFsdWU9ImZhLXNoZWtlbCI+PGxhYmVsIGZvcj0iZmEtc2hla2VsIj48aSBjbGFzcz0iZmEtc2hla2VsIj48L2k+PC9sYWJlbD48L2xpPg0KCQk8bGk+PGlucHV0IHR5cGU9InJhZGlvIiBuYW1lPSJpY29uZm9udHNfbmFtZSIgIGlkPSJmYS1tZWFucGF0aCIgdmFsdWU9ImZhLW1lYW5wYXRoIj48bGFiZWwgZm9yPSJmYS1tZWFucGF0aCI+PGkgY2xhc3M9ImZhLW1lYW5wYXRoIj48L2k+PC9sYWJlbD48L2xpPg0KPC91bD4NCjwvZGl2Pg0KCQk8ZGl2IGNsYXNzPSJ3ZWJudXMtaWNvbnMtYnV0dG9ucyI+DQoJCQk8YnV0dG9uIGlkPSJ3ZWJudXMtaWNvbnMtZ2V0Y29kZSI+SW5zZXJ0IEljb248L2J1dHRvbj4NCgkJCQ0KCQk8L2Rpdj4NCgk8L2Rpdj4='));
		form.find("#webnus-icons-colorpicker").wpColorPicker();
        var table = form.find('table');
        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#webnus-icons-getcode').click(function() {

            var icomoon_color = table.find("#webnus-icons-colorpicker").val();
            var icomoon_url = ' link="'+table.find("#webnus-icons-url").val()+'"';
            var icomoon_size = table.find("#webnus-icons-size").val();
            
			var icomoon_class =jQuery('input[name="iconfonts_name"]:checked').val();
			

			if(icomoon_color)
			 tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon name="'+icomoon_class+'" size="'+icomoon_size+'" color="'+icomoon_color+'"'+ icomoon_url +']');
			else
			 tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon name="'+icomoon_class+'" size="'+icomoon_size+'"'+ icomoon_url +']');


          

            // closes Thickbox
            tb_remove();
        });

    }
    
    
})(jQuery);


/**
		PictureBox
**/


(function() {
    tinymce.create('tinymce.plugins.doublepromo', {
        init: function(ed, url) {
            ed.addButton('doublepromo', {
                title: 'Double Promo',
                image: url + '/doublepromo-ico.png',
                onclick: function() {
                    
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[doublepromo title="Title Goes Here" Text="Sample Text" link_text="Read More" link_link="#" img="" img_alt="" last="false"][doublepromo title="Title Goes Here" Text="Sample Text" link_text="Read More" link_link="#" img="" img_alt="" last="true"]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('doublepromo', tinymce.plugins.doublepromo);
})(jQuery);



/*
		QUOTE
*/

(function() {
    tinymce.create('tinymce.plugins.quote', {
        init: function(ed, url) {
            ed.addButton('quote', {
                title: 'Quote of the Week',
                image: url + '/qotofweek-ico.png',
                onclick: function() {
                    
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[quote title="Title" Text="text" name="Name" name_sub="Name Sub"]');

                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);
})(jQuery);





(function($) {
    $.fn.extend({
        center: function() {
            return this.each(function() {
                var top = ($(window).height() - $(this).outerHeight()) / 2;
                var left = ($(window).width() - $(this).outerWidth()) / 2;
                $(this).css({position: 'absolute', margin: 0, top: (top > 0 ? top : 0) + 'px', left: (left > 0 ? left : 0) + 'px'});
            });
        }
    });
})(jQuery);
