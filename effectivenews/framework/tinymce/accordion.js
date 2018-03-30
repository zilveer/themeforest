(function() {
    tinymce.create('tinymce.plugins.acc', {
        init : function(ed, url) {
            ed.addButton('acc', {
                title : 'Insert Accordion',
                image : url+'/images/acc.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Accordion Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=accordion-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('acc', tinymce.plugins.acc);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="accordion-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="accordion-type">Type</label>\
			    <span>accordion or toggle</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="accordion-type">\
					<option value="">Accordion</option>\
					<option value="toggle">Toggle</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="accordion-handle">Handle</label>\
			    <span>the icon on the left</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="accordion-handle">\
					<option value="arrows">Arrows</option>\
					<option value="numbers">Numbers</option>\
					<option value="pm">Plus & Minus</option>\
					<option value="">None</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="accordion-space">Space</label>\
			    <span>small space between the accordions titles for nicer design</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="accordion-space">\
					<option value="no">No</option>\
					<option value="yes">Yes</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="">Icon colors</label>\
			    <span>accordions icons colors</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<div class="mom_color_wrap" style="margin-top:0;">\
				<div class="mom_color"><span>Icon Color</span><input type="text" class="mom-color-field" id="accordion-icon_color" value=""></div>\
				<div class="mom_color"><span>Current Icon Color</span><input type="text" class="mom-color-field" id="accordion-icon_current_color" value=""></div>\
				</div>\
\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_acc_wrap">\
		    <div class="mom_acc_sc">\
			<div class="acc_title"><div class="acc_sort_handle"></div><a href="#" class="mom_sc_select_icon acc_icon brankic-icon-info2"></a><input type="text" value="" id="accordion-title" placeholder="Title"><input type="hidden" class="accordion-icon" value="">\
			<a class="remove_accordion fa-icon-remove" href="#"></a>\
		<div class="toggle_state hide"><select id="accordion-state">\
					<option value="close">Close</option>\
					<option value="open">Open</option>\
		</select></div>\
		</div>\
			<div class="acc_content"><textarea id="accordion-caption" placeholder="Content"></textarea></div>\
		    </div> <!-- end acc -->\
		    </div>\
		    <a href="#" class="add_acc" id="add_accordion">+</a>\
		    <div class="mom_icons_overlay acc_icons hide">\
<div id="TB_title"><div id="TB_ajaxWindowTitle">Select Icon</div><i class="icon_ov_close fa-icon-remove"></i></div>\
		    <div class="ov_inner">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="ov_icons_type">Icons Type</label>\
			    <span>select from tons of vector icons or upload your custom one, custom icon must be 16px*16px or smaller</span>\
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
		    <div class="mom_custom_media_upload acc_custom_icon hide">\
			<a class="mom_upload_media mom_tiny_button upload_custom_icon" href="#">Upload Custom Icon</a>\
			<img class="mom_custom_icon_prev" src="'+mom_url+'/framework/shortcodes/images/custom_img.png" alt="">\
			<input type="text" class="accordion-custom_icon" value="" style="visibility: hidden;" />\
		    </div>\
		    </div>\
		<div class="mom_submit_form">\
			<a id="acc_icon_submit" class="button-primary">Select Icon</a>\
		</div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="accordion-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		//add new
		jQuery('#add_accordion').live('click', function(){
                    jQuery('.mom_acc_sc:first').clone(true).addClass('new_accordion').appendTo('.mom_acc_wrap');
		    jQuery('.new_accordion:last').find('input').val('');
		    jQuery('.new_accordion:last').find('.acc_icon').removeClass().addClass('mom_sc_select_icon acc_icon brankic-icon-info2');
		    jQuery('.mom_acc_sc .acc_content').slideUp();
		    jQuery('.new_accordion:last .acc_content').slideDown('fast');
		   $('.mom_acc_sc .acc_title').removeClass('acc_active');
		   $('.new_accordion:last .acc_title').addClass('acc_active');
		    var height = $('#TB_ajaxContent').height();
		    $('#TB_ajaxContent').animate({ scrollTop: height },'250');
                    return false;
               });
                //remove this
		jQuery('.remove_accordion').live('click', function(e) {
                    if(jQuery('.mom_acc_sc').size() == 1) {
                        alert('Sorry, you need at least one element');
                    }
                    else {
                        jQuery(this).parent().parent().slideUp(300, function() {
                            jQuery(this).remove();
                        })
                    }
		    e.stopPropagation();
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
	$('.acc_custom_icon a.upload_custom_icon').live('click', function( event ){
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
	
	    $('.accordion-custom_icon').val(attachment.url);
	    $this.next('img').attr({src: attachment.url});
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.acc_custom_icon a.upload_custom_icon').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});

    // make it accordion
    $('.mom_acc_sc .acc_title:first').addClass('acc_active');
    $('.mom_acc_sc .acc_title').click( function () {
       if(!$(this).hasClass('acc_active')) {
       $('.mom_acc_sc .acc_title').removeClass('acc_active');
       $(this).addClass('acc_active');
       $('.acc_content').slideUp();
       $(this).next('.acc_content').slideDown();
       }
    });
     
    // sort accordions
    $( ".mom_acc_wrap" ).sortable({
	handle : '.acc_sort_handle'
	});
		
    // colors fields
    jQuery('.mom-color-field').wpColorPicker();

		
    // toggle state
    $('#accordion-type').change( function () {
		    if($(this).val() === 'toggle') {
			$('.toggle_state').fadeIn();
		    } else {
			$('.toggle_state').fadeOut();
		    }
		});


    //add icon
    $('.acc_icon').click( function(e) {
		   e.preventDefault();
		   $this = $(this);
		   $('.acc_icons').fadeIn();
		   $('.icon_ov_close').click( function () {
			$('.acc_icons').fadeOut();
		    })
		    $('#acc_icon_submit').click( function() {
		    if ($('.acc_icons #ov_icons_type').val() === 'custom') {
			$this.siblings('.accordion-icon').val($('.accordion-custom_icon').val());
			$this.removeClass().css({
			    background: 'url('+$('.accordion-custom_icon').val()+') no-repeat center',
			    float: 'left',
			    width: '20px',
			    height: '46px'
			    
			})
		    } else {
			icon = $(this).parent().parent().find('input[name="mom_menu_item_icon"]:checked').val();
			$this.siblings('.accordion-icon').val(icon);
			$this.removeClass('brankic-icon-info2').addClass(icon);
		    }
		    $('.acc_icons').fadeOut();
	    });

    });
	    $('.acc_icons #ov_icons_type').change( function () {
		    if($(this).val() === 'custom') {
			$('.acc_custom_icon').fadeIn();
			$('.acc_vector_icons').fadeOut();
		    } else {
			$('.acc_vector_icons').fadeIn();
			$('.acc_custom_icon').fadeOut();
		    }
		});
	    

	    

		// handles the click event of the submit button
		form.find('#accordion-submit').click(function(){
			//output
                    var type = $('#accordion-type').val();
                    var handle = jQuery('#accordion-handle').val();
                    var space = jQuery('#accordion-space').val();

			var iconColor = jQuery('#accordion-icon_color').val();
			var iconColorh = jQuery('#accordion-icon_current_color').val();
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

		    if (type !== '') {
			type = 'type="'+type+'"'; 
		    }

		    output = '[accordions '+type+' handle="'+handle+'" space="'+space+'" '+iconc+iconch+']<br />';

                jQuery('.mom_acc_sc').each(function(index) {
                    var title = jQuery(this).find('#accordion-title').val();
                    var caption = jQuery(this).find('#accordion-caption').val();
			if ($(this).find('.accordion-icon').val() !== '') {
			    var icon = 'icon="'+$(this).find('.accordion-icon').val()+'" ';
			} else {
			    icon = '';
			}
		    
   		    if($('#accordion-type').val() === 'toggle') {
			var state = jQuery(this).find('#accordion-state').val();
			togglestate = 'state="'+state+'" '; 
		    } else {
			togglestate = '';
		    }

                    output += ' [accordion title="'+title+'" '+icon+togglestate+']'+caption+'[/accordion]<br />';
                });
                output += ' [/accordions] ';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
