jQuery.noConflict();

jQuery(function(){
	jQuery('#pix_admin_reset').click(function() {
		var answer = confirm("By clicking \"Reset\" almost all the changes you made with the Delight Admin panel will be lost.\n\nAre you sure you want to continue?")
		if (answer) {
			jQuery('#pix_admin_reset_hidden').click();
		}
		else {
		}
	});
});	


/******************************************************
*
*	Fade in on load
*
******************************************************/
jQuery(window).one('load',function() {
	if(jQuery.browser.msie && jQuery.browser.version < 9) {
		jQuery('#pix_wrap').css({'visibility':'visible'});
	} else {
		jQuery('#pix_wrap').css({'opacity':0,'visibility':'visible'}).animate({'opacity':1},500);
	}
});
/******************************************************
*
*	Jquery tabs
*
******************************************************/
jQuery(function() {
	var date = new Date();
	var post;
	var post2;
	var pan;
	var ind;
	var active_tab = localStorage.getItem("active_tab");
	if(typeof active_tab == 'undefined' || active_tab == false || active_tab == null) {
		active_tab = 0;
	}
	if(jQuery.browser.msie && jQuery.browser.version < 9) {
		var fadeEffect = 'none';
	} else {
		var fadeEffect = 'toggle';
	}
	jQuery( "#pix_body" ).tabs({
		fx: { 
			opacity: fadeEffect
		},
		active: active_tab,
		collapsible: true,
		beforeActivate: function(event, ui) {
			my_data = 0;
			if(jQuery('#your-sidebars-tab, #translation-tab').is(':visible')){
				jQuery('#pix_body .input-save').animate({'opacity':0},200);
			} else {
				if(!jQuery('#pix_body .input-save').is('visible')) {
					jQuery('#pix_body .input-save').animate({'opacity':1},200);
				}
			}
			post = jQuery('form',ui.panel).serialize();
			pan = ui.panel;
		},
		activate: function(event, ui) {
			post2 = jQuery('form',pan).serialize();
			if(post!=post2) {
					var answer = confirm("You made some changes to Delight admin panel.\nThe changes you made will be lost if you go to another tab without saving.\nClick OK to go to another tab without saving")
					if (answer){
						return true
					}
					else{
						return false
					}
			}
			ind = jQuery( "#pix_body" ).tabs( "option", "active" );
			if (Modernizr.localstorage) {
			  localStorage.setItem("active_tab", ind)
			}
		}
	});
	jQuery( "#pix_body > div" ).each(function(){
		var i = jQuery(this).index();
		var ind2,
			t = jQuery(this);
		var active_tab2 = localStorage.getItem("active_tab2"+i);
		if(typeof active_tab2 == 'undefined' || active_tab2 == false || active_tab2 == null) {
			active_tab2 = 0;
		}
		jQuery(this).tabs({
			fx: { 
				opacity: fadeEffect
			},
			active: active_tab2,
			collapsible: true,
			beforeActivate: function(event, ui) {
				if(jQuery('#your-sidebars-tab, #translation-tab').is(':visible')){
					jQuery('#pix_body .input-save').animate({'opacity':0},200);
				} else {
					if(!jQuery('#pix_body .input-save').is('visible')) {
						jQuery('#pix_body .input-save').animate({'opacity':1},200);
					}
				}
			},
			activate: function(event, ui) {
				var ind2 = t.tabs( "option", "active" );
				if (Modernizr.localstorage) {
				  localStorage.setItem("active_tab2"+i, ind2);
				}
			}
		});
	});
	if(jQuery('#your-sidebars-tab, #translation-tab').is(':visible')){
		jQuery('#pix_body .input-save').animate({'opacity':0},0);
	}
});

/******************************************************
*
*	Show options by changing input val
*
******************************************************/
jQuery(function() {
	jQuery('.toggler').each(function(){
		var toggler = jQuery(this).val();
		var theId = jQuery(this).attr('id');
		jQuery('.toggle.'+theId+'[data-type*="'+toggler+'"]').show();
		
		if(this.tagName == 'SELECT'){
			jQuery(this).change(function(){
				var toggler = jQuery(this).find('option:selected').val();
				jQuery('.toggle.'+theId).hide();
				//if(!jQuery('.toggle#'+theId+'[data-type*="'+toggler+'"]').is('visible')) {
					jQuery('.toggle.'+theId+'[data-type*="'+toggler+'"]').fadeIn(300);
				//}
			});
		}
	});
});

/******************************************************
*
*	Cancella sidebar
*
******************************************************/
function sidebar_rm_ajax() {
	jQuery("input[name^='sidebar_rm']").bind("click",function(){
		
		var $sidebarId = jQuery(this).attr("id");
		var $sidebarName = jQuery("#sidebar_generator_"+$sidebarId).val();
		jQuery("#sidebar_generator_"+$sidebarId).remove();
		
		var $arraySidebarInputs = new Array;
		jQuery("input[name^='sidebar_generator_']").each(function(id) {
                     $updateSidebars = jQuery("input[name^='sidebar_generator_']").get(id);
                     $arraySidebarInputs.push($updateSidebars.value);
                    });
		
		var $sidebarInputsStr = $arraySidebarInputs.join(",");
			
		jQuery.ajax({
			type: "post",url: $rmSidebarAjaxUrl,data: { action: "sidebar_rm", sidebar: $sidebarInputsStr, sidebar_id: $sidebarId, sidebar_name: $sidebarName, _ajax_nonce: $ajaxNonce },
			beforeSend: function() {jQuery(".sidebar_rm_"+$sidebarId).css({display:""});}, //fadeIn loading just when link is clicked
			success: function(html){ //so, if data is retrieved, store it in html
				jQuery("#sidebar_row_"+$sidebarId).fadeOut("fast"); //animation
				window.location.href=window.location.href;
			}
		}); //close jQuery.ajax
		return false;
	});
}

jQuery(document).ready(function(){
sidebar_rm_ajax();
});

/******************************************************
*
*	Upload buttons
*
******************************************************/
jQuery(document).ready(function($){
 	jQuery('.rm_upload_image input.slideshow_image').live('keyup',function() {
		var upField = jQuery(this);
		var upThumb = upField.parents('.rm_upload_image').find('.image_thumb img');
		imgurl = upField.val();
		var imgurlNoF = imgurl.substring(0,imgurl.lastIndexOf('.'));
		var onlyFormat = imgurl.substr(imgurl.lastIndexOf('.'));
		jQuery.ajax({
			url:imgurlNoF+'-50x50'+onlyFormat,
			type:'HEAD',
			error:
				function(){
					var imgurlNoF2 = imgurlNoF.substring(0,imgurlNoF.lastIndexOf('-'));
					var preview = imgurlNoF2+'-50x50'+onlyFormat;
					upThumb.attr('src',preview).show();
				},
			success:
				function(){
					var preview = imgurlNoF+'-50x50'+onlyFormat;
					upThumb.attr('src',preview).show();
				}
		});
	});

 	jQuery('.rm_upload_image .pix_upload_image_button, .rm_upload_image .image_thumb').live('click',function() {
		var upLoad = jQuery(this).parents('.rm_upload_image');
		var upField = upLoad.find('input[type="text"]').not('.secondtype');
		var upThumb = upLoad.find('.image_thumb img');
		window.formfield_image = '';
		
		window.formfield_image = upField;
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		if(jQuery(this).hasClass('no_overlay')){
			jQuery('#TB_overlay').removeClass('TB_overlayBG');
		}
		
		window.image_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html, f) {
			if (window.formfield_image != '') {
				imgurl = $('img',html).attr('src');
				window.formfield_image.val(imgurl).keyup();
                var imgurlNoF = imgurl.substring(0,imgurl.lastIndexOf('.'));
                var onlyFormat = imgurl.substr(imgurl.lastIndexOf('.'));
				window.formfield_image = '';
				tb_remove();
				jQuery.ajax({
					url:imgurlNoF+'-50x50'+onlyFormat,
					type:'HEAD',
					error:
						function(){
							var imgurlNoF2 = imgurlNoF.substring(0,imgurlNoF.lastIndexOf('-'));
							var preview = imgurlNoF2+'-50x50'+onlyFormat;
							upThumb.attr('src',preview).show();
						},
					success:
						function(){
							var preview = imgurlNoF+'-50x50'+onlyFormat;
							upThumb.attr('src',preview).show();
						}
				});
			}
			else {
				window.image_send_to_editor(html);
			}
		}
		return false;
	});


 	jQuery('.rm_upload_video input[type="button"], .rm_upload_video a.pix_upload_video_button').live('click',function() {
		var upLoad = jQuery(this).parents('.rm_upload_video');
		var upField = upLoad.find('input[type="text"]');
		window.formfield_video = '';
		
		window.formfield_video = upField;
		tb_show('', 'media-upload.php?type=video&TB_iframe=true');
		if(jQuery(this).hasClass('no_overlay')){
			jQuery('#TB_overlay').removeClass('TB_overlayBG');
		}
		
		window.video_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (window.formfield_video != '') {
				imgurl = $(html).attr('href');
				window.formfield_video.val(imgurl);
				window.formfield_video = '';
				tb_remove();
			}
			else {
				window.video_send_to_editor(html);
			}
		}
		return false;
	});


 	jQuery('.rm_upload_audio input[type="button"], .rm_upload_audio a.pix_upload_audio_button').live('click',function() {
		var upLoad = jQuery(this).parents('.rm_upload_audio');
		var upField = upLoad.find('input[type="text"]');
		window.formfield_video = '';
		
		window.formfield_video = upField;
		tb_show('', 'media-upload.php?type=audio&TB_iframe=true');
		if(jQuery(this).hasClass('no_overlay')){
			jQuery('#TB_overlay').removeClass('TB_overlayBG');
		}
		
		window.video_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (window.formfield_video != '') {
				imgurl = $(html).attr('href');
				window.formfield_video.val(imgurl);
				window.formfield_video = '';
				tb_remove();
			}
			else {
				window.video_send_to_editor(html);
			}
		}
		return false;
	});
});




/******************************************************
*
*	Sortable
*
******************************************************/
jQuery(function(){
	jQuery( ".sorting" ).sortable({ 
		opacity: 0.6,
		items: 'div.rm_upload_image',
		placeholder: "ui-state-highlight",
		handle: '.handle'
	});
});

jQuery(function(){
	jQuery( ".sorting_admin" ).sortable({ 
		opacity: 0.6,
		items: 'div.rm_upload_image',
		placeholder: "ui-state-highlight",
		handle: '.handle',
		stop: function() {
            var order = jQuery(this).sortable('toArray');
			var id = jQuery('.rm_upload_image:last',this).attr('id');
			var subS = id.lastIndexOf('_')+1;
			var idSubs = id.substring(0,subS);
			jQuery.each(order, function(key, value) {
				jQuery('#'+order[key]+' input').attr('name',idSubs+'[' + key + ']');
			});
        }
	});
});

jQuery(function(){
	jQuery( ".sorting_fields" ).sortable({ 
		opacity: 0.6,
		items: 'div.added_field',
		placeholder: "ui-state-highlight",
		handle: '.handle',
		stop: function() {
			var t = jQuery(this);
            var order = jQuery(this).sortable('toArray');
			var id = jQuery('.added_field:last',this).attr('id');
			var subS = id.lastIndexOf('_')-1;
			var subS2 = id.lastIndexOf('_');
			var idNum = id.substring(subS,subS2);
			var parId = t.parents('.form_builder').attr('id').replace('_form_builder','');
			jQuery.each(order, function(key, value) {
				jQuery('#'+order[key]+' select', t).attr('name','pix_array_'+parId+'_fields_['+key+'][0]');
				jQuery('#'+order[key]+' input[type=checkbox]', t).attr('name','pix_array_'+parId+'_fields_['+key+'][1]');
				jQuery('#'+order[key]+' textarea.added_field_2', t).attr('name','pix_array_'+parId+'_fields_['+key+'][2]');
				jQuery('#'+order[key]+' textarea.added_field_3', t).attr('name','pix_array_'+parId+'_fields_['+key+'][3]');
				jQuery('#'+order[key]+' textarea.added_field_4', t).attr('name','pix_array_'+parId+'_fields_['+key+'][4]');
				jQuery('#'+order[key]+' textarea.added_field_5', t).attr('name','pix_array_'+parId+'_fields_['+key+'][5]');
				jQuery('#'+order[key]+' textarea.added_field_6', t).attr('name','pix_array_'+parId+'_fields_['+key+'][6]');
				jQuery('#'+order[key]+' textarea.added_field_7', t).attr('name','pix_array_'+parId+'_fields_['+key+'][7]');
				jQuery('#'+order[key]+' textarea.added_field_8', t).attr('name','pix_array_'+parId+'_fields_['+key+'][8]');
			});
        }
	});
});



jQuery(function() {
	jQuery('.sorting_admin').each(function(){
		var t = jQuery(this);
		var i = jQuery('.rm_upload_image',t).size();
	
		jQuery('a.add',t).click(function() {
			var id = jQuery('.rm_upload_image:last',t).attr('id');
			var subS = id.lastIndexOf('_')+1;
			var idSubs = id.substring(0,subS)
			jQuery('<div id="' + idSubs + i + '" class="rm_upload_image"><div class="handle"></div><div class="image_thumb"><img src="" alt="Preview" style="display:none" /></div><input name="' + idSubs +'[' + i + ']" type="text" value="" /><a class="button-secondary pix_upload_image_button" href="#">Upload Image</a><a href="#" class="button-secondary remove">Remove</a></div>').appendTo(t);
			i++;
			return false;
		});
	
		jQuery('a.remove',t).live('click',function() {
			if(i > 1) {
				jQuery(this).parents('.rm_upload_image').remove();
				i--;
			}
			jQuery('.rm_upload_image',t).each(function(){
				var id = jQuery(this).attr('id');
				var subS = id.lastIndexOf('_')+1;
				var idSubs = id.substring(0,subS)
				jQuery(this).attr('id',idSubs+(jQuery(this).index()-1));
				jQuery('input',this).attr('name',idSubs +'[' +(jQuery(this).index()-1)+']');
			});
			return false;
		});
	
	});
});

/******************************************************
*
*	Adding form
*
******************************************************/
jQuery(function() {
	jQuery('.added_forms_div').each(function(){
		var t = jQuery(this);
		var i = jQuery('.added_form',t).size();
	
		jQuery('a#add_a_form',t).click(function() {
			var i = jQuery('.added_form',t).size();
			jQuery('<div class="added_form" id="added_form_'+i+'"><input name="pix_array_your_forms_[' + i + ']" type="text" value="Form '+(i+1)+'" style="width:390px; float:left;" /><a href="#" class="button-secondary remove alignright" style="margin-top:4px">Remove</a></div><div class="clear"></div>').appendTo(t);
			i++;
			return false;
		});
	
		jQuery('a.remove',t).live('click',function() {
			jQuery(this).parents('.added_form').remove();
			var id = jQuery(this).parents('.added_form').find('input').attr('id');
			jQuery('#'+id+'_form_builder').remove();
			jQuery('.added_form').each(function(){
				jQuery(this).attr('id','added_form_'+jQuery('.added_form').index(jQuery(this)));
				jQuery('input',this).attr('name','pix_array_your_forms_['+(jQuery('.added_form').index(jQuery(this)))+']');
			});
			return false;
		});
	});
	
});

/******************************************************
*
*	Adding field
*
******************************************************/
/*Sort del field da select*/
jQuery(function(){
	jQuery('.added_field').each(function(){
		var t = jQuery(this);
		var v = jQuery('select option:selected',t).val();
		jQuery('.added_field_'+v, t).show();
		jQuery('select',t).change(function(){
			var v = jQuery('option:selected',this).val();
			jQuery('.toHide', t).hide();
			if(!jQuery('.added_field_'+v, t).is(':visible')) {
				jQuery('.added_field_'+v, t).fadeIn();
			}
		});
	});
})
/*Adding*/
jQuery(function() {
	jQuery('.sorting_fields').each(function(){
		var t = jQuery(this);
		var i = jQuery('.added_field',t).size();
		var id = jQuery('.added_field:last',t).attr('id');
		var idRepl = id.replace('_'+(i-1),'');
		var idRepl2 = idRepl.replace('added_field','');
		var parId = t.parents('.form_builder').attr('id').replace('_form_builder','');
	
		jQuery('a.add_a_field',t).click(function() {
			jQuery('<div id="added_field'+idRepl2+'_'+i+'" class="added_field new">'+
					'<div class="handle"></div>'+
					'<div style="float:left; width:190px">'+
						'<select name="pix_array_'+parId+'_fields_['+i+'][0]">'+
							'<option value="2">Text</option>'+
							'<option value="3">Email</option>'+
							'<option value="4">Alternative mail</option>'+
							'<option value="5">Textarea</option>'+
							'<option value="6">Select</option>'+
							'<option value="10">Multiple selection select</option>'+
							'<option value="11">Checkbox</option>'+
							'<option value="12">Radio button</option>'+
							'<option value="7">Period from</option>'+
							'<option value="13">Period to</option>'+
							'<option value="8">Captcha</option>'+
						'</select>'+
                        '<div class="toHide"><label for="pix_array_'+parId+'_fields_['+i+'][1]">Required:</label><input type="checkbox" value="required" name="pix_array_'+parId+'_fields_['+i+'][1]"><div class="off-on"><div class="switcher off"></div></div></div>'+
                        '<a href="#" class="button-secondary remove">Remove</a>'+
						'<div class="toHide" style="clear:left; padding-top:5px">'+
                        '<label for="pix_array_'+parId+'_fields_['+i+'][9]">Name:</label>'+
                        '<input type="text" style="border-color:#b2b2a1; width:140px; float:right" name="pix_array_'+parId+'_fields_['+i+'][9]" value="Field">'+
                        '</div>'+
                        '<div class="added_field_3 added_field_8 alert" style="display: none">Use this field only once in a form!</div>'+
                    '</div>'+
                    '<textarea class="added_field_2" name="pix_array_'+parId+'_fields_['+i+'][2]"><label>Name:</label>'+
'[pix_text name="Field"]</textarea>'+
                    '<textarea class="added_field_3" style="display:none" name="pix_array_'+parId+'_fields_['+i+'][3]"><label>Email:</label>'+
'[pix_email]</textarea>'+
                    '<textarea class="added_field_4" style="display:none" name="pix_array_'+parId+'_fields_['+i+'][4]"><label>Alternative email:</label>'+
'[pix_alt_email name="Field"]</textarea>'+
                    '<textarea class="added_field_5" style="display:none" name=" name="pix_array_'+parId+'_fields_['+i+'][5]"><label>Message:</label>'+
'[pix_textarea name="Field"]</textarea>'+
                    '<textarea class="added_field_6" style="display:none" name=" name="pix_array_'+parId+'_fields_['+i+'][6]"><label>Select an option:</label>'+
'[pix_select name="Field"]'+
'[pix_option][/pix_option]'+
'[pix_option value="first"]First[/pix_option]'+
'[pix_option value="second"]Second[/pix_option]'+
'[/pix_select]</textarea>'+
                    '<textarea class="added_field_10" style="display:none" name=" name="pix_array_'+parId+'_fields_['+i+'][10]"><label>Select an option:</label>'+
'[pix_select name="Field" multiple="multiple" height="200"]'+
'[pix_option][/pix_option]'+
'[pix_option value="first"]First[/pix_option]'+
'[pix_option value="second"]Second[/pix_option]'+
'[/pix_select]</textarea>'+
                    '<textarea class="added_field_11" style="display:none" name="pix_array_'+parId+'_fields_['+i+'][11]"><label>Check this box:</label>'+
'[pix_checkbox name="Field"]</textarea>'+
                    '<textarea class="added_field_12" style="display:none" name="pix_array_'+parId+'_fields_['+i+'][12]"><label>Radio button:</label>'+
'[pix_radio name="Field" value="First button"][pix_radio name="Field" value="Second button"]</textarea>'+
                     '<textarea class="added_field_7" style="display:none" name=" name="pix_array_'+parId+'_fields_['+i+'][7]"><label>Pediod from:</label>'+
'[pix_period_from name="From"]</textarea>'+
                     '<textarea class="added_field_13" style="display:none" name=" name="pix_array_'+parId+'_fields_['+i+'][13]"><label>Pediod to:</label>'+
'[pix_period_to name="To"]</textarea>'+
                     '<textarea class="added_field_8" style="display:none" name="pix_array_'+parId+'_fields_['+i+'][8]"><label>Captcha:</label>'+
'<div class="captchaCont">[pix_captcha_img] [pix_captcha_input]</div></textarea>'+
                      '</div>').appendTo(t);
			i++;

//Ripeto la funzione dell'alternanza select/textarea per i campi creati ex-novo
			jQuery('.added_field.new').each(function(){
				var t = jQuery(this);
				var v = jQuery('select option:selected',t).val();
				jQuery('textarea.added_field_'+v, t).show();
				jQuery('select',t).change(function(){
					var v = jQuery('option:selected',this).val();
					jQuery('textarea', t).hide();
					if(v=='3'||v=='8'){
						jQuery('.alert',t).show();
						jQuery('.toHide', t).hide();
					} else {
						jQuery('.alert',t).hide();
						jQuery('.toHide', t).show();
					}
					jQuery('textarea.added_field_'+v, t).fadeIn();
				});
			});
		return false;
		});
	
	});
//Remove
	jQuery('.sorting_fields').each(function(){
		var t = jQuery(this);
		jQuery('.remove',this).live('click',function(){
			jQuery(this).parents('.added_field').remove();
			jQuery('.added_field', t).each(function(){
				var id = jQuery(this).attr('id');
				var subS = id.lastIndexOf('_')-1;
				var subS2 = id.lastIndexOf('_');
				var idNum = id.substring(subS,subS2);
				var num = jQuery('.added_field',t).index(jQuery(this));
				var parId = jQuery(this).parents('.form_builder').attr('id').replace('_form_builder','');
				jQuery(this).attr('id','added_field'+idNum+'_'+num);
				jQuery('select', this).attr('name','pix_array_'+parId+'_fields_['+num+'][0]');
				jQuery('input[type=checkbox]', this).attr('name','pix_array_'+parId+'_fields_['+num+'][1]');
				jQuery('input[type=text]', this).attr('name','pix_array_'+parId+'_fields_['+num+'][9]');
				jQuery('textarea.added_field_2', this).attr('name','pix_array_'+parId+'_fields_['+num+'][2]');
				jQuery('textarea.added_field_3', this).attr('name','pix_array_'+parId+'_fields_['+num+'][3]');
				jQuery('textarea.added_field_4', this).attr('name','pix_array_'+parId+'_fields_['+num+'][4]');
				jQuery('textarea.added_field_5', this).attr('name','pix_array_'+parId+'_fields_['+num+'][5]');
				jQuery('textarea.added_field_6', this).attr('name','pix_array_'+parId+'_fields_['+num+'][6]');
				jQuery('textarea.added_field_7', this).attr('name','pix_array_'+parId+'_fields_['+num+'][7]');
				jQuery('textarea.added_field_8', this).attr('name','pix_array_'+parId+'_fields_['+num+'][8]');
			});
			return false;
		});
	});
//Required
});

/******************************************************
*
*	Checkboxes and name value
*
******************************************************/
jQuery(function() {
	jQuery('#pix_body input[type=checkbox], .meta_hidden input[type=checkbox], .my_meta_control input[type=checkbox]').after('<div class="off-on"><div class="switcher"></div></div>');
	jQuery('#pix_body input[type=checkbox].check_toggler').next('.off-on').addClass('check_toggler');
	jQuery('.off-on').each(function(){
		if(!jQuery(this).prev('input[type=checkbox]').is(':checked')){
			jQuery('.switcher',this).addClass('off');
		}
	});
	jQuery('.off-on').live('click',function(){
		var t = jQuery(this);
		var p = jQuery(this).prev('input[type=checkbox]');
		if(jQuery('.switcher',t).hasClass('off')){
			p.attr('checked', 'checked');
			jQuery('.switcher',t).removeClass('off');	
			t.parents('.added_field').find('textarea').each(function(){
				if(jQuery(this).val().indexOf('required')==-1 && jQuery(this).val().indexOf('captcha')==-1 && jQuery(this).val().indexOf('pix_email')==-1 ){
					jQuery(this).val(jQuery(this).val().replace(']', ' required="required"]'));
				}
			});
		} else {
			p.removeAttr('checked');
			jQuery('.switcher',t).addClass('off');
			t.parents('.added_field').find('textarea').each(function(){
				if(jQuery(this).val().indexOf('required')!=-1){
					jQuery(this).val(jQuery(this).val().replace(' required="required"', ''));
				}
			});
		}
	});
	jQuery('.sorting_fields input[type=text]').live('keyup',function(){
		var t = jQuery(this);
		jQuery(this).parents('.added_field').find('textarea').each(function(){
			jQuery(this).val(jQuery(this).val().replace(/name=\".*?\"/, 'name="'+t.val()+'"'));
		});
	});
});

/******************************************************
*
*	Slider
*
******************************************************/
jQuery(function() {
	if(jQuery.isFunction(jQuery.fn.slider)) {
		jQuery('.slider_div').each(function(){
			var t = jQuery(this);
			var value = jQuery('input',t).val();
			if(t.hasClass('milliseconds')){
				var mi = 0;
				var m = 50000;
				var s = 100;
			} else if(t.hasClass('opacity')){
				var mi = 0;
				var m = 1;
				var s = 0.05;
			} else if(t.hasClass('googlemap')){
				var mi = 1;
				var m = 19;
				var s = 1;
			} else if(t.hasClass('border')){
				var mi = 0;
				var m = 50;
				var s = 1;
			} else {
				var mi = 0;
				var m = 200;
				var s = 1;
			}
			jQuery('.slider_cursor',t).slider({
				value: value,
				min: mi,
				max: m,
				step: s,
				slide: function( event, ui ) {
					jQuery('input',t).val( ui.value );
				}
			});
			jQuery('input',t).keyup(function(){
				var v = jQuery('input',t).val();
				jQuery('.slider_cursor',t).slider({
					value: v,
					min: 0,
					max: m,
					step: s,
					slide: function( event, ui ) {
						jQuery('input',t).val( ui.value );
					}
				});
			})
		});
	}
});


/******************************************************
*
*	Font select
*
******************************************************/
if(typeof google != 'undefined' && google != false && google != null) {
	google.load("webfont", "1");
	jQuery(function() {
		if(jQuery('body').hasClass('google_font_loaded')){
			jQuery('select.font_select').each(function(){
					var val = jQuery('option:selected',this).val();
					WebFont.load({
						google: {
							families: [ val ]
						}
					});
					if (/:/i.test(val)){
						val = val.substring(0,val.lastIndexOf(':'));
					}
					jQuery(this).parent().find('.preview_font').css('font-family',val);
					jQuery(this).change(function(){
						if (jQuery(this).parent().find('.font_your_own').val()==''){
							val = jQuery('option:selected',this).val();
							WebFont.load({
								google: {
									families: [ val ]
								}
							});
							if (/:/i.test(val)){
								val = val.substring(0,val.lastIndexOf(':'));
							}
							jQuery(this).parent().find('.preview_font').css('font-family',val);
						}
					});
			});
			jQuery('input.font_your_own').each(function(){
					var val = jQuery(this).val();
					if(val!=''){
						WebFont.load({
							google: {
								families: [ val ]
							}
						});
						if (/:/i.test(val)){
							val = val.substring(0,val.lastIndexOf(':'));
						}
						jQuery(this).parent().find('.preview_font').css('font-family',val);
					}
					jQuery(this).keyup(function(){
						var val = jQuery(this).val();
						if(val!=''){
							WebFont.load({
								google: {
									families: [ val ]
								}
							});
							if (/:/i.test(val)){
								val = val.substring(0,val.lastIndexOf(':'));
							}
						} else {
							val = jQuery(this).parent().find('select.font_select option:selected',this).val();
							WebFont.load({
								google: {
									families: [ val ]
								}
							});
							if (/:/i.test(val)){
								val = val.substring(0,val.lastIndexOf(':'));
							}
						}
						jQuery(this).parent().find('.preview_font').css('font-family',val);
					});
			});
		}
	});
}

/******************************************************
*
*	Farbtastic
*
******************************************************/
jQuery(window).one('load',function() {
	if(jQuery.isFunction(jQuery.fn.farbtastic)) {
		jQuery('.colorpicker').after('<div class="picker_close" />');
		jQuery('.a_palette').each(function(){
			jQuery(this).click(function(){
				jQuery('.colorpicker').fadeOut(0);
				jQuery('.picker_close').fadeOut(0);
				jQuery(this).next('.colorpicker').fadeIn(300);
				jQuery(this).next('.colorpicker').next('.picker_close').fadeIn(300);
				return false;
			});
		});
		jQuery('.colorpicker').each(function(){
			var the_picker = jQuery(this);
			jQuery(this).next('.picker_close').click(function(){
				the_picker.fadeOut(300);
				jQuery(this).fadeOut(300);
				return false;
			});
		});
		jQuery('.pix_color').each(function() {
			var divPicker = jQuery(this).find('.colorpicker');
			var inputPicker = jQuery(this).find('input[type=text]');
			divPicker.farbtastic(inputPicker);
		});
	}
});


/******************************************************
*
*	Check toggle
*
******************************************************/
jQuery(window).one('load',function() {
	jQuery('input.check_toggler').each(function(){
		var t = jQuery(this);
		var oO = t.next('.off-on');
		var p = t.parents('.block_separator');
		var target = t.attr('data-target');
		var l = jQuery('.off-on.check_toggler .switcher',p).length;
		if(jQuery('.off-on.check_toggler .switcher.off',p).length==l){
			jQuery('#'+target, p).fadeIn();
		} else {
			jQuery('#'+target, p).hide();
		}
		oO.click(function(){
			if(jQuery('.switcher',this).hasClass('off')){
				jQuery('#'+target, p).hide();
			} else {
				if(jQuery('.off-on.check_toggler .switcher.off',p).length==(l-1)){
					jQuery('#'+target, p).fadeIn();
				} else {
					jQuery('#'+target, p).hide();
				}
			}
		});
	});
});


/******************************************************
*
*	Pricetable disable button
*
******************************************************/
jQuery(window).one('load',function() {
	jQuery('#pricetable_generator').each(function(){
		var t = jQuery(this);
		var add = jQuery('#add_a_slider',t);
		var cant = jQuery('#cant',t);
		add.click(function(){
			var l = jQuery('.image_block',t).length;
			if(l==6){
				add.fadeOut(100,function(){
					cant.fadeIn();
				});
			}
		});
		jQuery('.dodelete',t).live('click',function(){
			if(cant.is(':visible')){
				setTimeout(
				function(){
					var l = jQuery('.image_block',t).length;
					if(l<6){
					cant.fadeOut(100,function(){
						add.fadeIn();
					})
					}
				},100);
			}
		});
	});
});


/******************************************************
*
*	SEO counter
*
******************************************************/
jQuery(document).ready(function() {

    jQuery('.pix_title_seo').each(function() {
		var c = jQuery(this).val().length;
		if(c<=70){
			jQuery(this).next('p').html('<strong class="strong_char_good">'+(70-c)+'</strong> recommended characters');
		} else {
			jQuery(this).next('p').html('<strong class="strong_char_bad">'+(70-c)+'</strong> recommended characters');
		}
		jQuery(this).keyup(function(){
			c = jQuery(this).val().length;
			if(c<=70){
				jQuery(this).next('p').html('<strong class="strong_char_good">'+(70-c)+'</strong> recommended characters');
			} else {
				jQuery(this).next('p').html('<strong class="strong_char_bad">'+(70-c)+'</strong> recommended characters');
			}
		});
    });

    jQuery('.pix_desc_seo').each(function() {
		var c = jQuery(this).val().length;
		if(c<=160){
			jQuery(this).next('p').html('<strong class="strong_char_good">'+(160-c)+'</strong> recommended characters');
		} else {
			jQuery(this).next('p').html('<strong class="strong_char_bad">'+(160-c)+'</strong> recommended characters');
		}
		jQuery(this).keyup(function(){
			c = jQuery(this).val().length;
			if(c<=160){
				jQuery(this).next('p').html('<strong class="strong_char_good">'+(160-c)+'</strong> recommended characters');
			} else {
				jQuery(this).next('p').html('<strong class="strong_char_bad">'+(160-c)+'</strong> recommended characters');
			}
		});
    });

});


/******************************************************
*
*	qTip
*
******************************************************/
jQuery(window).one('load',function() {
	if(jQuery.isFunction(jQuery.fn.qtip)) {
		jQuery('a').not('.toleft, .toright').each(function(){
			var t = jQuery(this);
			var w = t.attr('data-width');
			if(w==''){
				w = 280;
			}
			var h = t.attr('data-height');
			if(h==''){
				h = 'auto';
			}
			t.qtip({
				style: {
					tip: {
						corner: "topLeft"
					},
					classes: "ui-tooltip-youtube",
					height: h
				},
				position: {
					target: "mouse",
					adjust: {
						mouse: false,
						x: 10,
						y: 10
					},
					my: "top left",
					at: "top left"
				},
				show: {
					delay: 150,
					solo: true
				},
				content: t.attr('title'),
				events: {
				  show: function(event, api) {
					jQuery('.ui-tooltip, .qtip').css({'width':w});
				  }
			   }
			});
		});
	
		jQuery('a.toleft').each(function(){
			var t = jQuery(this);
			var w = t.attr('data-width');
			if(w==''){
				w = 280;
			}
			var h = t.attr('data-height');
			if(h==''){
				h = 'auto';
			}
			t.qtip({
				style: {
					tip: {
						corner: "topRight"
					},
					classes: "ui-tooltip-youtube",
					height: h
				},
				position: {
					target: "mouse",
					adjust: {
						mouse: false,
						x: 10,
						y: 10
					},
					my: "top right",
					at: "top right"
				},
				show: {
					delay: 150,
					solo: true
				},
				content: t.attr('title'),
				events: {
				  show: function(event, api) {
					jQuery('.ui-tooltip, .qtip').css({'width':w});
				  }
			   }
			});
		});
	
	
		jQuery('a.toright').each(function(){
			var t = jQuery(this);
			var w = t.attr('data-width');
			if(w==''){
				w = 280;
			}
			var h = t.attr('data-height');
			if(h==''){
				h = 'auto';
			}
			t.qtip({
				style: {
					tip: {
						corner: "bottomLeft"
					},
					classes: "ui-tooltip-youtube",
					height: h
				},
				position: {
					target: "mouse",
					adjust: {
						mouse: false,
						x: 10,
						y: -10
					},
					my: "bottom left",
					at: "bottom left"
				},
				show: {
					delay: 150,
					solo: true
				},
				content: t.attr('title'),
				events: {
				  show: function(event, api) {
					jQuery('.ui-tooltip, .qtip').css({'width':w});
				  }
			   }
			});
		});
	
	
		jQuery('.pix_tips_ajax').not('.topLeft').each(function(){
			var t = jQuery(this);
			var u = t.attr('href');
			var w = t.attr('data-width');
			var h = t.attr('data-height');
			t.qtip({
			   content: {
				  text: 'Loading...',
				  ajax: {
					 url: u
				  }
			   },
				style: {
					tip: {
						corner: "bottomLeft"
					},
					classes: "ui-tooltip-youtube",
					maxWidth: w,
					height: h
				},
				position: {
					target: "mouse",
					adjust: {
						mouse: false,
						x: 10,
						y: -10
					},
					my: "bottom left",
					at: "bottom left"
				},
				show: {
					delay: 500,
					solo: true
				},
				hide: {
					event: 'unfocus'
				}
			});
			t.click(function(){
				return false;
			});
		});
		jQuery('.pix_tips_ajax.topLeft').each(function(){
			var t = jQuery(this);
			var u = t.attr('href');
			var w = t.attr('data-width');
			var h = t.attr('data-height');
			t.qtip({
			   content: {
				  text: 'Loading...',
				  ajax: {
					 url: u
				  }
			   },
				style: {
					tip: {
						corner: "topLeft"
					},
					classes: "ui-tooltip-youtube",
					maxWidth: w,
					height: h
				},
				position: {
					target: "mouse",
					adjust: {
						mouse: false,
						x: 10,
						y: 10
					},
					my: "top left",
					at: "top left"
				},
				show: {
					delay: 500,
					solo: true
				},
				hide: {
					event: 'unfocus'
				}
			});
			t.click(function(){
				return false;
			});
		});
	}
});


/******************************************************
*
*	Changelog
*
******************************************************/
jQuery(window).one('load',function() {
	if(jQuery.isFunction(jQuery.fn.colorbox)) {
		jQuery('#update-button').colorbox({width:"80%", height:"80%", iframe:true});
	}
});


/******************************************************
*
*	Custom blog
*
******************************************************/
jQuery(function() {
	jQuery('#custom_blog_block select').change(function(){
		v = jQuery(this).val();
		jQuery('#custom_blog_block input[type=hidden]').val(v);
	});
});



