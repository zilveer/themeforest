(function() {
    tinymce.create('tinymce.plugins.videosc', {
        init : function(ed, url) {
            ed.addButton('videosc', {
                title : 'Add a video',
                image : url+'/images/video.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Video', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=video-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('videosc', tinymce.plugins.videosc);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="video-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="video-type">Video Type</label>\
			    <span>vimeo or youtube</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select id="video-type" name="type">\
				<option value="youtube">Youtube</option>\
				<option value="vimeo">Vimeo</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="video-id">Video ID</label>\
			    <span>video id is the bold text in this links : http://www.youtube.com/watch?v=<strong>XSo4JQnm8Bw</strong>, http://vimeo.com/<strong>7449107</strong></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="video-id" name="id" />\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="video-width">Video Width</label>\
			    <span>in pixels</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="video-width" name="width"/>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="video-height">Video Height</label>\
			    <span>in pixels</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="video-height" name="height"/>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="video-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#video-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'type':'',
				'id':'',
				'width':'',
				'height':'',
		};
			var shortcode = '[mom_video';
			
			for( var index in options) {
				var value = table.find('#video-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
