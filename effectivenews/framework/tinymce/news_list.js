(function() {
    tinymce.create('tinymce.plugins.newslist', {
        init : function(ed, url) {
            ed.addButton('newslist', {
                title : 'News List',
                image : url+'/images/blog.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'News List', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=newslist-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('newslist', tinymce.plugins.newslist);
    
   // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="newslist-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newslist-title">Title</label>\
			    <span>if you select display category or tag leave this blank and it will be the category/tag name</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input id="newslist-title" type="text">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newslist-image_size">Image Size</label>\
			    <span>medium or big</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newslist-image_size">\
					<option value="">Medium</option>\
					<option value="big">Big</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newslist-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newslist-display">\
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
			    <label for="newslist-cat">Category</label>\
			    <span>select one</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newslist-category" name="newslist-category">\
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
			    <label for="newslist-tag">Tag ID</label>\
			    <span>Learn How to get tag Id from <a href="http://www.wpbeginner.com/beginners-guide/how-to-find-post-category-tag-comments-or-user-id-in-wordpress/" target="_blank">here</a></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="newslist-tag" name="newslist-tag">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newslist-format">Format</label>\
			    <span>display posts by format</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newslist-format" multiple>\
			    '+$formats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newslist-count">Number Of posts</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newslist-count" id="newslist-count">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newslist-excerpt_length">Excerpt Length</label>\
			    <span>characters length default is 150</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newslist-excerpt_length" id="newslist-excerpt_length">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newslist-orderby">Order by</label>\
			    <span>recent, popular, random</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="newslist-orderby">\
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
			    <label for="newslist-sort">Sort by</label>\
			    <span>DESC, ASC</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="newslist-sort">\
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
			    <label for="newslist-show_more">Show More Button</label>\
			    <span>enable show more button</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="mom_switch"><input id="newslist-show_more" checked="checked" type="checkbox" value="on"><label><i></i></label></div>\
				<div class="mom_color_wrap show_more_type">\
				<div class="mom_color"><span>On Click</span><select name="show_more_type" id="newslist-show_more_type">\
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
				<div class="mom_color"><span>Background Color</span><input type="text" class="mom-color-field" id="newslist-header_background" value=""></div>\
				<div class="mom_color"><span>Text Color</span><input type="text" class="mom-color-field" id="newslist-header_text_color" value=""></div>\
				<div class="mom_color"><span>Hide dots pattern</span><select name="show_more_type" id="newslist-hide_dots">\
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
			    <label for="newslist-post_type">Custom post type</label>\
			    <span>Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newslist-post_type" id="newslist-post_type">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="newslist-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		

		$('#newslist-show_more').click(function() {
		    if (!this.checked) {
			$('.show_more_type').slideUp('fast');
		    } else {
			$('.show_more_type').slideDown(250);
		    }
		});

		$('#newslist-display').change( function() {
		    if($(this).val() === 'category') {
			$('.nb_cats').slideDown(250);
			$('.nb_tags').slideUp('fast');
			$('.custom_newslist_title').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.nb_tags').slideDown(250);
			$('.nb_cats').slideUp('fast');
			$('.custom_newslist_title').slideDown(250);
		    } else {
			$('.nb_tags').slideUp('fast');
			$('.nb_cats').slideUp('fast');
			$('.custom_newslist_title').slideDown(250);
		    }
		});
jQuery('input[name="newslist-style"]').click(function() {
    if ($('input[name="newslist-style"]:checked').val() === 'two_cols') {
	$('.tow_cols_last').slideDown(250);
    } else {
	$('.tow_cols_last').slideUp('fast');
    }
});

		    $("#newslist-form input[type=checkbox]").click(
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
		form.find('#newslist-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			
			var options = { 
				'title':'',
				'image_size': '',
				'display':'',
				'format':null,
				'category':'',
				'tag':'',
				'orderby':'',
				'sort':'',
				'count':'',
				'excerpt_length':'',
				'show_more':'',
				'show_more_type':'',
				'post_type': '',
				'header_background':'',
				'header_text_color' : '',
				'hide_dots' : ''				
		};
			var shortcode = '[news_list';
			
			for( var index in options) {
				var value = table.find('#newslist-' + index).val();
				
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