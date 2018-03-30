(function() {
    tinymce.create('tinymce.plugins.animate', {
        init : function(ed, url) {
            ed.addButton('animate', {
                title : 'Add a animater',
                image : url+'/images/animate.png',
                              onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Animation', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=animate-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('animate', tinymce.plugins.animate);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="animate-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="animate-animation">Animatin</label>\
			    <span>tons of animations</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select id="animate-animation">\
			    <optgroup label="Attention Seekers">\
			      <option value="bounce">bounce</option>\
			      <option value="flash">flash</option>\
			      <option value="pulse">pulse</option>\
			      <option value="rubberBand">rubberBand</option>\
			      <option value="shake">shake</option>\
			      <option value="swing">swing</option>\
			      <option value="tada">tada</option>\
			      <option value="wobble">wobble</option>\
			    </optgroup>\
			    <optgroup label="Bouncing Entrances">\
			      <option value="bounceIn">bounceIn</option>\
			      <option value="bounceInDown">bounceInDown</option>\
			      <option value="bounceInLeft">bounceInLeft</option>\
			      <option value="bounceInRight">bounceInRight</option>\
			      <option value="bounceInUp">bounceInUp</option>\
			    </optgroup>\
			    <optgroup label="Fading Entrances">\
			      <option value="fadeIn">fadeIn</option>\
			      <option value="fadeInDown">fadeInDown</option>\
			      <option value="fadeInDownBig">fadeInDownBig</option>\
			      <option value="fadeInLeft">fadeInLeft</option>\
			      <option value="fadeInLeftBig">fadeInLeftBig</option>\
			      <option value="fadeInRight">fadeInRight</option>\
			      <option value="fadeInRightBig">fadeInRightBig</option>\
			      <option value="fadeInUp">fadeInUp</option>\
			      <option value="fadeInUpBig">fadeInUpBig</option>\
			    </optgroup>\
			    <optgroup label="Flippers">\
			      <option value="flip">flip</option>\
			      <option value="flipInX">flipInX</option>\
			      <option value="flipInY">flipInY</option>\
			    </optgroup>\
			    <optgroup label="Lightspeed">\
			      <option value="lightSpeedIn">lightSpeedIn</option>\
			    </optgroup>\
			    <optgroup label="Rotating Entrances">\
			      <option value="rotateIn">rotateIn</option>\
			      <option value="rotateInDownLeft">rotateInDownLeft</option>\
			      <option value="rotateInDownRight">rotateInDownRight</option>\
			      <option value="rotateInUpLeft">rotateInUpLeft</option>\
			      <option value="rotateInUpRight">rotateInUpRight</option>\
			    </optgroup>\
			    <optgroup label="Sliders">\
			      <option value="slideInDown">slideInDown</option>\
			      <option value="slideInLeft">slideInLeft</option>\
			      <option value="slideInRight">slideInRight</option>\
			    </optgroup>\
			    <optgroup label="Specials">\
			      <option value="hinge">hinge</option>\
			      <option value="rollIn">rollIn</option>\
			    </optgroup>\
			  </select>\
					</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="animate-duration">Duration</label>\
			    <span>animation duration in seconds</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="animate-duration">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="animate-delay">Delay</label>\
			    <span>animated element delay in seconds</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="animate-delay">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="animate-iteration">Iteration Count</label>\
			    <span>number of animation times -1 for non stop animation</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="animate-iteration">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="animate-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();

		// handles the click event of the submit button
		form.find('#animate-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'animation':'',
				'duration': '',
				'delay': '',
				'iteration': '',
		};
                        selected = tinyMCE.activeEditor.selection.getContent();
    			var shortcode = '[animate'
			
			for( var index in options) {
				var value = table.find('#animate-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']<br>'+selected+'<br>[/animate]';;
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();