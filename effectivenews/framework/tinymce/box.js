(function() {
    tinymce.create('tinymce.plugins.box', {
        init : function(ed, url) {
            ed.addButton('box', {
                title : 'Add a box',
                image : url+'/images/box.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Box', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=box-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('box', tinymce.plugins.box);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="box-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="box-type">Type</label>\
			    <span>select one or create your custom</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="type" id="box-type">\
					<option value="">Default</option>\
					<option value="info">Info</option>\
					<option value="note">Note</option>\
					<option value="error">Error</option>\
					<option value="tip">Tip</option>\
					<option value="custom">Custom</option>\
				</select>\
				<div class="mom_color_wrap custom_box hide">\
				<div class="mom_color"><span style="width:100%;">Background Image <a class="upload_box_bg" href="#">Upload Image</a></span><input type="text" name="bgimg" id="box-bgimg" value=""></div>\
				<div class="mom_color"><span>Background Color</span><input type="text" class="mom-color-field" id="box-bg" value=""></div>\
				<div class="mom_color"><span>Text Color</span><input type="text" class="mom-color-field" id="box-color" value=""></div>\
				<div class="mom_color"><span>Border Color</span><input type="text" class="mom-color-field" id="box-border" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="box-radius">Radius</label>\
			    <span>insert box border radius number eg. 10</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="radius" id="box-radius" value="">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="box-fontsize">Font Size</label>\
			    <span>insert a font size as a number eg. 14</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="fontsize" id="box-fontsize" value="">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="box-content">Content</label>\
			    <span>Box Content</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <textarea id="box-content" name="content" cols="40" rows="6"></textarea>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="box-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		
		$('#box-type').change(function () {
		   if ($(this).val() === 'custom') {
		    $('.custom_box').slideDown(250);
		   } else {
		    $('.custom_box').slideUp('fast');
		   }
		});
//media Upload

	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var set_to_post_id = post_id; // Set this
	$('.upload_box_bg').live('click', function( event ){
	    var $this = $(this);
	event.preventDefault();
	if ( file_frame ) {
	file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
	file_frame.open();
	return;
	} else {
	wp.media.model.settings.post.id = set_to_post_id;
	}
	file_frame = wp.media.frames.file_frame = wp.media({
	title: jQuery( this ).data( 'uploader_title' ),
	button: {
	text: jQuery( this ).data( 'uploader_button_text' ),
	},
	multiple: false
	});
	 
	file_frame.on( 'select', function() {
	attachment = file_frame.state().get('selection').first().toJSON();
	
	    table.find('#box-bgimg').val(attachment.url);
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.upload_box_bg').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});

		
		// handles the click event of the submit button
		form.find('#box-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'type':'',
				'color':'',
				'bgimg':'',
				'bg':'',
				'fontsize':'',
				'radius':'',
				'border':'',
		};
			var shortcode = '[box';
			
			for( var index in options) {
				var value = table.find('#box-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' + table.find('#box-content').val()+'[/box]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
