(function() {
    tinymce.create('tinymce.plugins.newsbox', {
        init : function(ed, url) {
            ed.addButton('newsbox', {
                title : 'Add a newsbox',
                image : url+'/images/newsbox.png',
                onclick : function() {
// triggers the thicknewsbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Box', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=newsbox-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('newsbox', tinymce.plugins.newsbox);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="newsbox-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-style">Style</label>\
			    <span>select from newsbox styles</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    <label class="mom_radio_img"><input type="radio" checked="checked" name="newsbox-style" value="1"><img src="'+mom_url+'/framework/shortcodes/images/nb1.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="2"><img src="'+mom_url+'/framework/shortcodes/images/nb2.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="3"><img src="'+mom_url+'/framework/shortcodes/images/nb3.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="4"><img src="'+mom_url+'/framework/shortcodes/images/nbs4.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="two_cols"><img src="'+mom_url+'/framework/shortcodes/images/nb4.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="four_cols"><img src="'+mom_url+'/framework/shortcodes/images/nb4.png"><i></i></label>\
				<div class="mom_color_wrap tow_cols_last hide">\
				<div class="mom_color"><span>Last?</span>\
				    <select id="newsbox-last">\
					<option value="">No</option>\
					<option value="yes">Yes</option>\
				    </select>\
				</div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-title">Title</label>\
			    <span>if you select display category or tag leave this blank and it will be the category/tag name</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input id="newsbox-title" type="text">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newsbox-display">\
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
			    <label for="newsbox-cat">Category</label>\
			    <span>select one</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newsbox-category" name="newsbox-category">\
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
			    <label for="newsbox-tag">Tag ID</label>\
			    <span>Learn How to get tag Id from <a href="http://www.wpbeginner.com/beginners-guide/how-to-find-post-category-tag-comments-or-user-id-in-wordpress/" target="_blank">here</a></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select type="text" id="newsbox-tag" name="newsbox-tag">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-count">Number Of posts</label>\
			    <span>this count start after the recent post it mean if you set this as 10 the newsbox will show 11 post the top post then the 10</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newsbox-count" id="newsbox-count">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-orderby">Order by</label>\
			    <span>recent, popular, random</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="newsbox-orderby">\
					<option value="">Recent</option>\
					<option value="popular">Popular</option>\
					<option value="random">Random</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-sort">Sort by</label>\
			    <span>DESC, ASC</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="newsbox-sort">\
					<option value="">DESC</option>\
					<option value="ASC">ASC</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-show_more">Show More Button</label>\
			    <span>enable show more button</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="mom_switch"><input id="newsbox-show_more" checked="checked" type="checkbox" value="on"><label><i></i></label></div>\
				<div class="mom_color_wrap show_more_type">\
				<div class="mom_color"><span>Show more on click</span><select name="show_more_type" id="newsbox-show_more_type">\
					<option value="">More posts with Ajax</option>\
					<option value="link">Category/tag page</option>\
				</select></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label>Header Custom colors</label>\
			    <span>custom header colors</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<div class="mom_color_wrap">\
				<div class="mom_color"><span>Background Color</span><input type="text" class="mom-color-field" id="newsbox-header_background" value=""></div>\
				<div class="mom_color"><span>Text Color</span><input type="text" class="mom-color-field" id="newsbox-header_text_color" value=""></div>\
				<div class="mom_color"><span>Hide dots pattern</span><select name="show_more_type" id="newsbox-hide_dots">\
					<option value="">No</option>\
					<option value="yes">Yes</option>\
				</select></div>\
				</div></div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-post_type">Custom post type</label>\
			    <span>Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newsbox-post_type" id="newsbox-post_type">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    </div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="newsbox-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		
		$('#newsbox-show_more').click(function() {
		    if (!this.checked) {
			$('.show_more_type').slideUp('fast');
		    } else {
			$('.show_more_type').slideDown(250);
		    }
		});

		$('#newsbox-display').change( function() {
		    if($(this).val() === 'category') {
			$('.nb_cats').slideDown(250);
			$('.nb_tags').slideUp('fast');
			$('.custom_newsbox_title').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.nb_tags').slideDown(250);
			$('.nb_cats').slideUp('fast');
			$('.custom_newsbox_title').slideDown(250);
		    } else {
			$('.nb_tags').slideUp('fast');
			$('.nb_cats').slideUp('fast');
			$('.custom_newsbox_title').slideDown(250);
		    }
		});
jQuery('input[name="newsbox-style"]').click(function() {
    if ($('input[name="newsbox-style"]:checked').val() === 'two_cols' || $('input[name="newsbox-style"]:checked').val() === 'four_cols') {
	$('.tow_cols_last').slideDown(250);
    } else {
	$('.tow_cols_last').slideUp('fast');
    }
});

		    $("#newsbox-form input[type=checkbox]").click(
			function() {
			    var attr = $(this).attr('checked');
		    if (typeof attr !== 'undefined' && attr !== false) {
			        $(this).attr({
					     checked: 'checked',
					     value: 'on'
					     });
		    } else {
				$(this).removeAttr('checked');
 				$(this).attr('value', 'off');
		    }
			} 
		    );
		
		// handles the click event of the submit button
		form.find('#newsbox-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
                    var nbs = jQuery('input[name="newsbox-style"]:checked').val();
		    
		    var nbsAttr = ' style="'+nbs+'"';
			
			var options = { 
				'display':'',
				'title':'',
				'category':'',
				'tag':'',
				'orderby':'',
				'sort':'',
				'count':'',
				'show_more':'',
				'show_more_type':'',
				'last':'',
				'post_type':'',
				'header_background':'',
				'header_text_color' : '',
				'hide_dots' : ''				
				
		};
			var shortcode = '[news_box'+nbsAttr;
			
			for( var index in options) {
				var value = table.find('#newsbox-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thicknewsbox
			tb_remove();
		});
	});
})();
