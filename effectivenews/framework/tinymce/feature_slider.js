(function() {
    tinymce.create('tinymce.plugins.featureslider', {
        init : function(ed, url) {
            ed.addButton('featureslider', {
                title : 'Feature Slider',
                image : url+'/images/feature_slider.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Feature Slider', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=featureslider-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('featureslider', tinymce.plugins.featureslider);
    
   // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="featureslider-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="featureslider-display">\
					<option value="">Latest Posts</option>\
					<option value="category">Category</option>\
					<option value="tag">tag</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_cats hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-cat">Category</label>\
			    <span>select one or more</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="featureslider-category" name="featureslider-category">\
			    <option value="">Select Category ...</option>\
				    '+$cats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_tags hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-tag">Tag ID</label>\
			    <span>Learn How to get tag Id from <a href="http://www.wpbeginner.com/beginners-guide/how-to-find-post-category-tag-comments-or-user-id-in-wordpress/" target="_blank">here</a></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="featureslider-tag" name="featureslider-tag">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-count">Number Of posts</label>\
			    <span>-1 for all posts</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="featureslider-count" id="featureslider-count">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-orderby">Order by</label>\
			    <span>recent, popular, random</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="featureslider-orderby">\
					<option value="">Recent</option>\
					<option value="popular">Popular</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-caption">Caption</label>\
			    <span>show/hide Caption</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="mom_switch"><input id="featureslider-caption" checked="checked" type="checkbox" value="on"><label><i></i></label></div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-caption_style">Caption Style</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="featureslider-caption_style">\
					<option value="">Default</option>\
					<option value="2">Alt</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-caption_length">Caption Length</label>\
			    <span>characters length default is 110</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="featureslider-caption_length" id="featureslider-caption_length">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-nav">Navigation</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="featureslider-nav">\
					<option value="bullets">Bullets</option>\
					<option value="thumbs">Thumbs</option>\
					<option value="numbers">Numbers</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-arrows">Arrows</label>\
			    <span>show/hide Arrows</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="mom_switch"><input id="featureslider-arrows" type="checkbox" value=""><label><i></i></label></div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-animation">Animation</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="featureslider-animation">\
					<option value="crossfade">crossfade</option>\
					<option value="scroll">scroll</option>\
					<option value="directscroll">directscroll</option>\
					<option value="fade">fade</option>\
					<option value="cover">cover</option>\
					<option value="cover-fade">cover-fade</option>\
					<option value="uncover">uncover</option>\
					<option value="uncover-fade">uncover-fade</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-easing">Easing</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="featureslider-easing">\
				    <option value="jswing">jswing</option>\
				    <option value="def">def</option>\
				    <option value="easeInQuad">easeInQuad</option>\
				    <option value="easeOutQuad">easeOutQuad</option>\
				    <option value="easeInOutQuad">easeInOutQuad</option>\
				    <option value="easeInCubic">easeInCubic</option>\
				    <option value="easeOutCubic">easeOutCubic</option>\
				    <option value="easeInOutCubic" selected="selected">easeInOutCubic</option>\
				    <option value="easeInQuart">easeInQuart</option>\
				    <option value="easeOutQuart">easeOutQuart</option>\
				    <option value="easeInOutQuart">easeInOutQuart</option>\
				    <option value="easeInQuint">easeInQuint</option>\
				    <option value="easeOutQuint">easeOutQuint</option>\
				    <option value="easeInOutQuint">easeInOutQuint</option>\
				    <option value="easeInSine">easeInSine</option>\
				    <option value="easeOutSine">easeOutSine</option>\
				    <option value="easeInOutSine">easeInOutSine</option>\
				    <option value="easeInExpo">easeInExpo</option>\
				    <option value="easeOutExpo">easeOutExpo</option>\
				    <option value="easeInOutExpo">easeInOutExpo</option>\
				    <option value="easeInCirc">easeInCirc</option>\
				    <option value="easeOutCirc">easeOutCirc</option>\
				    <option value="easeInOutCirc">easeInOutCirc</option>\
				    <option value="easeInElastic">easeInElastic</option>\
				    <option value="easeOutElastic">easeOutElastic</option>\
				    <option value="easeInOutElastic">easeInOutElastic</option>\
				    <option value="easeInBack">easeInBack</option>\
				    <option value="easeOutBack">easeOutBack</option>\
				    <option value="easeInOutBack">easeInOutBack</option>\
				    <option value="easeInBounce">easeInBounce</option>\
				    <option value="easeOutBounce">easeOutBounce</option>\
				    <option value="easeInOutBounce">easeInOutBounce</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-speed">Animation Speed</label>\
			    <span>in ms, default is 600</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="featureslider-speed" id="featureslider-speed">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-timeout">Timeout</label>\
			    <span>the time between each slide in ms, default 4000 = 4 seconds</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="featureslider-timeout" id="featureslider-timeout">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="featureslider-post_type">Custom post type</label>\
			    <span>Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="featureslider-post_type" id="featureslider-post_type">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="featureslider-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		

		$('#featureslider-show_more').click(function() {
		    if (!this.checked) {
			$('.show_more_type').slideUp('fast');
		    } else {
			$('.show_more_type').slideDown(250);
		    }
		});

		$('#featureslider-display').change( function() {
		    if($(this).val() === 'category') {
			$('.nb_cats').slideDown(250);
			$('.nb_tags').slideUp('fast');
			$('.custom_featureslider_title').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.nb_tags').slideDown(250);
			$('.nb_cats').slideUp('fast');
			$('.custom_featureslider_title').slideDown(250);
		    } else {
			$('.nb_tags').slideUp('fast');
			$('.nb_cats').slideUp('fast');
			$('.custom_featureslider_title').slideDown(250);
		    }
		});
jQuery('input[name="featureslider-style"]').click(function() {
    if ($('input[name="featureslider-style"]:checked').val() === 'two_cols') {
	$('.tow_cols_last').slideDown(250);
    } else {
	$('.tow_cols_last').slideUp('fast');
    }
});

		    $("#featureslider-form input[type=checkbox]").click(
			function() {
			    var attr = $(this).attr('checked');
		    if (typeof attr !== 'undefined' && attr !== false) {
			        $(this).attr({
					     checked: 'checked',
					     value: 'on'
					     });
		    } else {
				$(this).removeAttr('checked');
 				$(this).attr('value', '');
		    }
			} 
		    );
		
		// handles the click event of the submit button
		form.find('#featureslider-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			
			var options = { 
				'display':'',
				'category':'',
				'tag':'',
				'orderby':'',
				'count':'',
				'caption':'',
				'caption_style':'',
				'caption_length':'',
				'nav':'',
				'animation':'',
				'easing':'',
				'speed':'',
				'timeout':'',
				'arrows':'',
				'post_type':'',
		};
			var shortcode = '[feature_slider';
			
			for( var index in options) {
				var value = table.find('#featureslider-' + index).val();
				
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