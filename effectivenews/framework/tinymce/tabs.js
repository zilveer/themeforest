(function() {
    tinymce.create('tinymce.plugins.tabs', {
        init : function(ed, url) {
            ed.addButton('tabs', {
                title : 'Insert Tabs',
                image : url+'/images/tabs.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Insert Tabs', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=tabs-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="tabs-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="tab-type">Style</label>\
			    <span>7 styles available</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="tab-style">\
					<option value="h1">Horizontal Tabs</option>\
					<option value="v1">Vertical Tabs</option>\
					<option value="v3">Vertical Tabs Big</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="">Icon colors</label>\
			    <span>tabs icons colors</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<div class="mom_color_wrap" style="margin-top:0;">\
				<div class="mom_color"><span>Icon Color</span><input type="text" class="mom-color-field" id="tab-icon_color" value=""></div>\
				<div class="mom_color"><span>Current Icon Color</span><input type="text" class="mom-color-field" id="tab-icon_current_color" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tab_wrap">\
		    <a href="#" class="add_tab" id="add_tab">+</a>\
		    <div class="mom_tab_sc">\
			<ul class="mom_tabs">\
			    <li class="tab_title" data-href="#tab0"><div class="tab_sort_handle"></div><a href="#" class="mom_sc_select_icon tab_icon brankic-icon-info2"></a><input type="text" id="tab-title" placeholder="Title" value="Tab 1"><input class="tab-icon invisible" value=""><a class="remove_tab fa-icon-remove" href="#"></a></li>\
			    <li class="tab_title" data-href="#tab1"><div class="tab_sort_handle"></div><a href="#" class="mom_sc_select_icon tab_icon brankic-icon-info2"></a><input type="text" id="tab-title" placeholder="Title" value="Tab 2"><input class="tab-icon invisible" value=""><a class="remove_tab fa-icon-remove" href="#"></a></li>\
			    <li class="tab_title" data-href="#tab2"><div class="tab_sort_handle"></div><a href="#" class="mom_sc_select_icon tab_icon brankic-icon-info2"></a><input type="text" id="tab-title" placeholder="Title" value="Tab 3"><input class="tab-icon invisible" value=""><a class="remove_tab fa-icon-remove" href="#"></a></li>\
			</ul>\
			<div class="tab_panes">\
    			<div class="tab_content" id="tab0"><textarea id="tab-caption" placeholder="Content">tab content 1</textarea></div>\
    			<div class="tab_content" id="tab1"><textarea id="tab-caption" placeholder="Content">tab content 2</textarea></div>\
    			<div class="tab_content" id="tab2"><textarea id="tab-caption" placeholder="Content">tab content 3</textarea></div>\
			</div>\
		    </div> <!-- end tab -->\
		    </div>\
		    <div class="mom_icons_overlay tab_icons hide">\
<div id="TB_title"><div id="TB_ajaxWindowTitle">Select Icon</div><i class="icon_ov_close fa-icon-remove"></i></div>\
		    <div class="ov_inner">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="ov_icons_type">Icons Type</label>\
			    <span>select from Tons of vector icons or upload your custom one, custom icon must be 16px*16px or smaller</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="ov_icons_type">\
					<option value="">Vector Icons</option>\
					<option value="custom">Custom Icon</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_custom_media_upload tab_custom_icon hide">\
			<a class="mom_upload_media mom_tiny_button upload_custom_icon" href="#">Upload Custom Icon</a>\
			<img class="mom_custom_icon_prev" src="'+mom_url+'/framework/shortcodes/images/custom_img.png" alt="">\
			<input type="text" class="tab-custom_icon" value="" style="visibility: hidden;" />\
		    </div>\
		    </div>\
		<div class="mom_submit_form">\
			<a id="tab_icon_submit" class="button-primary">Select Icon</a>\
		</div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="tab-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();

		var count = 2;
		jQuery('#add_tab').live('click', function(){
		    count += 1;
		    $('.mom_tab_sc .tab_title:first').clone(true, true).addClass('new_tab_title').appendTo('ul.mom_tabs');
		    $('.new_tab_title:last').find('input').val('');
		    $('.new_tab_title:last').attr('data-href', '#tab'+count);
		    $('.mom_tab_sc .tab_title').removeClass('tab_active');
		    $('.new_tab_title:last').addClass('tab_active');
		    $('.tab_panes .tab_content:first').clone().addClass('new_tab_content').appendTo('.tab_panes');
		    $('.new_tab_content:last').find('textarea').val('');
		    $('.new_tab_content:last').attr('id', 'tab'+count);
		    $('.tab_panes .tab_content').hide();
		    $('.new_tab_content:last').show();
                    return false;
               });
                jQuery('.remove_tab').live('click', function() {
                    if(jQuery('.tab_title').size() == 1) {
                        alert('Sorry, you need at least one element');
                    }
                    else {
                        jQuery(this).parent().slideUp(300, function() {
                            jQuery(this).remove();
                        })
			var rcontent = $(this).parent().attr('data-href');
			$(rcontent).remove();
			$('.mom_tab_sc .tab_title').removeClass('tab_active');
			$('.tab_panes .tab_content').hide();
			$('.mom_tab_sc .tab_title:first').addClass('tab_active');
			$('.tab_panes .tab_content:first').show();

                    }
                    return false;
                });
		
//tab it
    $('.mom_tab_sc .tab_title:first').addClass('tab_active');
    $('.tab_panes .tab_content').hide();
    $('.tab_panes .tab_content:first').show();
    $('.mom_tab_sc .tab_title').live('click', function () {
       $('.mom_tab_sc .tab_title').removeClass('tab_active');
       $(this).addClass('tab_active');
       var currentConten = $(this).attr('data-href');
	$('.tab_panes .tab_content').hide();
	$(currentConten).fadeIn();
    });
    // sort accordions
    $( ".mom_tabs" ).sortable({
	handle : '.tab_sort_handle'
    });
    	    	jQuery.ajax({
			type: "post",
			url: MomCats.url,
                        dataType: 'html',
                        data: "action=mom_loadIcon&nonce="+MomCats.nonce,
			beforeSend: function() {
			},
			success: function(data){
                            form.find('.ov_inner').append('<div class="acc_vector_icons">'+data+'</div>');
			}
		});
	// media upload
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var set_to_post_id = post_id; // Set this
	$('.tab_custom_icon a.upload_custom_icon').live('click', function( event ){
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
	
	    $('.tab-custom_icon').val(attachment.url);
	    $this.next('img').attr({src: attachment.url});
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.tab_custom_icon a.upload_custom_icon').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});


    //add icon
    $('.tab_icon').on('click', function(e) {
		   e.preventDefault();
		   $this = $(this);
		   $('.tab_icons').fadeIn();
		   $('.icon_ov_close').click( function () {
			$('.tab_icons').fadeOut();
		    })
		    $('#tab_icon_submit').click( function() {
		    if ($('.tab_icons #ov_icons_type').val() === 'custom') {
			$this.siblings('.tab-icon').val($('.tab-custom_icon').val());
			$this.removeClass().css({
			    background: 'url('+$('.tab-custom_icon').val()+') no-repeat center',
			    float: 'left',
			    width: '20px',
			    height: '46px'
			    
			})
		    } else {
			icon = $(this).parent().parent().find('input[name="mom_menu_item_icon"]:checked').val();
			$this.siblings('.tab-icon').val(icon);
			$this.removeClass('brankic-icon-info2').addClass(icon);
		    }
		    $('.tab_icons').fadeOut();
	    });

		});
	    $('.tab_icons #ov_icons_type').change( function () {
		    if($(this).val() === 'custom') {
			$('.tab_custom_icon').fadeIn();
			$('.tab_vector_icons').fadeOut();
		    } else {
			$('.tab_vector_icons').fadeIn();
			$('.tab_custom_icon').fadeOut();
		    }
		});

		
		jQuery('.mom-color-field').wpColorPicker();


//icon live search
    $("#tabs-form #filter").keyup(function(){

        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(), count = 0;


        var regex = new RegExp(filter, "i"); // Create a regex variable outside the loop statement

        // Loop through the icons
        $(this).parent().nextAll(".icons_wrap").find(".mom_tiny_icon").each(function(){
            var classname = $('i', this).attr('class');
            // If the list item does not contain the text phrase fade it out
            if (classname.search(regex) < 0) { // use the variable here
                $(this).hide();

            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).fadeIn();
                count++;
            }
        });

    });			// handles the click event of the submit button
		form.find('#tab-submit').click(function(){
			//output
		    var style = $('#tab-style').val();
			var iconColor = jQuery('#tab-icon_color').val();
			var iconColorh = jQuery('#tab-icon_current_color').val();
			if(iconColor !== '') {
			    iconc = 'icon_color="'+iconColor+'" ';
			} else {
			    iconc = '';
			}
			if(iconColorh !== '') {
			    iconch = 'icon_current_color="'+iconColorh+'"';
			} else {
			    iconch ='';
			}
		    output = '[tabs style="'+style+'" '+iconc+iconch+']<br />';

                jQuery('.mom_tab_sc .tab_title').each(function() {
                    var title = jQuery(this).find('#tab-title').val();
		    var tcontent = $(this).attr('data-href');
                    var caption = $(tcontent +' #tab-caption').val();
			if ($(this).find('.tab-icon').val() !== '') {
			    var icon = 'icon="'+$(this).find('.tab-icon').val()+'" ';
			} else {
			    icon = '';
			}
                    output += ' [tab title="'+title+'" '+icon+']'+caption+'[/tab]<br />';
                });
                output += ' [/tabs] ';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
