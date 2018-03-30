(function() {
    tinymce.create('tinymce.plugins.login', {
        init : function(ed, url) {
            ed.addButton('login', {
                title : 'Add a login / register',
                image : url+'/images/login.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'login', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=login-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('login', tinymce.plugins.login);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="login-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="login-type">Type</label>\
			    <span>Login Form or register form</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<select name="type" id="login-type">\
					<option value="login_form">Login Form</option>\
					<option value="register_form">Register Form</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element req_login">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="login-register">Register Page URL</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<input type="text" name="register" id="login-register">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element req_login">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="login-reset">Lost password Page URL</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<input type="text" name="reset" id="login-reset">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    </div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="login-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();

    $('#login-type').change( function () {
		    if($(this).val() === 'register_form') {
			$('.req_login').slideUp();
		    } else {
			$('.req_login').slideDown();
		    }
		});
	
		// handles the click event of the submit button
		form.find('#login-submit').click(function(){
			type = $('#login-type').val();
			if(type === 'login_form') {
			    var options = {
				    'register':'',
				    'reset':'',
			    };
			} else {
			    var options = {};
			}
			//selected = tinyMCE.activeEditor.selection.getContent();
			var shortcode = '['+type;
			
			for( var index in options) {
				var value = table.find('#login-' + index).val();
				
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
