(function() {
    tinymce.create('tinymce.plugins.blog', {
        init : function(ed, url) {
            ed.addButton('blog', {
                title : 'Blog Posts',
                image : url+'/images/blog_posts.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Blog Posts', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=blog-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('blog', tinymce.plugins.blog);
    
   // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="blog-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-Style">Style</label>\
			    <span>4 different styles</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog-style">\
				    <option value="m1">Medium thumbnails</option>\
				    <option value="m2">Medium thumbnails2</option>\
				    <option value="l">Large thumbnails</option>\
				    <option value="g">Grid</option>\
			    </select>\
				</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-share">Share Icons</label>\
			    <span>enable/disable post share icons </span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="mom_switch"><input id="blog-share" checked="checked" type="checkbox" value="on"><label><i></i></label></div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog-display">\
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
			    <label for="blog-cat">Category</label>\
			    <span>select one</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog-category" name="blog-category">\
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
			    <label for="blog-tag">Tag ID</label>\
			    <span>Learn How to get tag Id from <a href="http://www.wpbeginner.com/beginners-guide/how-to-find-post-category-tag-comments-or-user-id-in-wordpress/" target="_blank">here</a></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="blog-tag" name="blog-tag">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-format">Format</label>\
			    <span>display posts by format</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog-format" multiple>\
			    '+$formats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-count">Number Of posts</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="blog-count" id="blog-count">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-excerpt_length">Excerpt Length</label>\
			    <span>characters length</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="blog-excerpt_length" id="blog-excerpt_length">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-orderby">Order by</label>\
			    <span>recent, popular, random</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="blog-orderby">\
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
			    <label for="blog-sort">Sort by</label>\
			    <span>DESC, ASC</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<select id="blog-sort">\
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
			    <label for="blog-pagination">Pagination</label>\
			    <span>enable show more button</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="mom_switch"><input id="blog-pagination" checked="checked" type="checkbox" value="on"><label><i></i></label></div>\
				<div class="mom_color_wrap blog_pagination_wrap">\
				<div class="mom_color"><span>Pagination type <span class="mom-small-desc simptip-position-top simptip-movable simptip-multiline" data-tooltip="caution: dont use ajax pagination if you order post by "random" it cause problems"><i class="enotype-icon-help"></i></span></span><select name="pagination_type" id="blog-pagination_type">\
					<option value="">Default</option>\
					<option value="ajax">Ajax</option>\
				</select></div>\
				<div class="mom_color"><span>posts count on load <span class="mom-small-desc simptip-position-top simptip-movable simptip-multiline" data-tooltip="the count of posts on load if you set the pagination type to ajax default is 3"><i class="enotype-icon-help"></i></span></span><input name="load_more_count" id="blog-load_more_count" type="text" class="custom_input small"></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label>Ads</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<div class="mom_color_wrap">\
				<div class="mom_color"><span>Select Ad:</span><select name="type" id="blog-ad_id"><option value=""></option>\
				'+$ads+'\
				</select>\
				</div>\
				<div class="mom_color"><span>Display after x posts</span><input type="text" id="blog-ad_count" class="custom_input" value="3"></div>\
				<div class="mom_color"><span>Repeat ad</span><select name="show_more_type" id="blog-ad_repeat">\
					<option value="">No</option>\
					<option value="yes">Yes</option>\
				</select></div>\
				</div></div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="blog-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		

		$('#blog-pagination').click(function() {
		    if (!this.checked) {
			$('.blog_pagination_wrap').slideUp('fast');
		    } else {
			$('.blog_pagination_wrap').slideDown(250);
		    }
		});

		$('#blog-display').change( function() {
		    if($(this).val() === 'category') {
			$('.nb_cats').slideDown(250);
			$('.nb_tags').slideUp('fast');
			$('.custom_blog_title').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.nb_tags').slideDown(250);
			$('.nb_cats').slideUp('fast');
			$('.custom_blog_title').slideDown(250);
		    } else {
			$('.nb_tags').slideUp('fast');
			$('.nb_cats').slideUp('fast');
			$('.custom_blog_title').slideDown(250);
		    }
		});


		    $("#blog-form input[type=checkbox]").click(
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
		form.find('#blog-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			
			var options = { 
				'style':'',
				'share': '',
				'display':'',
				'format':null,
				'category':'',
				'tag':'',
				'orderby':'',
				'sort':'',
				'count':'',
				'excerpt_length':'',
				'pagination':'',
				'pagination_type' : '',
				'load_more_count' : '',
				'ad_id' : '',
				'ad_count' : '',
				'ad_repeat' : '',
		};
			var shortcode = '[blog_posts';
			
			for( var index in options) {
				var value = table.find('#blog-' + index).val();
				
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