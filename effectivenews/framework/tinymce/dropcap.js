(function() {
    tinymce.create('tinymce.plugins.dropcap', {
        init : function(ed, url) {
            ed.addButton('dropcap', {
                title : 'Add a dropcap',
                image : url+'/images/drop.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'dropcap', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=dropcap-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="dropcap-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="dropcap-style">Style</label>\
			    <span>dropcap styles</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="style" id="dropcap-style">\
					<option value="">Normal</option>\
					<option value="square">Square</option>\
					<option value="circle">Circle</option>\
				</select>\
				<div class="mom_color_wrap">\
				<div class="mom_color"><span>Letter Color</span><input type="text" class="mom-color-field" name="color" id="dropcap-color" value=""></div>\
				<div class="mom_color dcbgcolor hide"><span>Background Color</span><input type="text" class="mom-color-field" name="bgcolor" id="dropcap-bgcolor" value=""></div>\
				<div class="mom_color dcsradius hide"><span>Square Radius</span><input type="text"  name="sradius" id="dropcap-sradius" value="" style="width:70px; height:24px; line-height:24px; text-align:center;"></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="dropcap-font">Font</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="font" id="dropcap-font">'+$faces+'</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="dropcap-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
	
		jQuery('.mom-color-field').wpColorPicker();
		$('#dropcap-style').change( function () {
		    if($(this).val() === 'circle' || $(this).val() === 'square') {
		        $('.dcbgcolor').slideDown(250);
		    } else {
			$('.dcbgcolor').slideUp('fast');
		    }
		    if($(this).val() === 'square') {
		        $('.dcsradius').slideDown(250);
		    } else {
		        $('.dcsradius').slideUp('fast');
		    }
		});
		// handles the click event of the submit button
		form.find('#dropcap-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
				'style':'',
				'color':'',
				'bgcolor':'',
				'sradius':'',
				'font':'',
		};
                        selected = tinyMCE.activeEditor.selection.getContent();
			var shortcode = '[dropcap';
			
			for( var index in options) {
				var value = table.find('#dropcap-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' +selected+'[/dropcap]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
