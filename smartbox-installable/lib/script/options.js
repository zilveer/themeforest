var designareOptions = {
    separator: '|*|',
    dialogOpened: false,
    init: function (options) {
        designareOptions.setCheckboxClickHandlers();
        designareOptions.setHelpFunc();
        designareOptions.setOnOffFunc();
        designareOptions.setTextImageFunc();
        designareOptions.setLeftRightFunc();
        designareOptions.setLightDarkFunc();
        designareOptions.setColorpickFunc();
        designareOptions.setStyleSelectFunc();
        jQuery(".sortable").sortable();
        var mainNavOptions = {};
        if (options.cookie) {
            mainNavOptions = {
                cookie: {
                    name: 'tabs',
                    expires: 1
                }
            }
        }
        designareOptions.setTabs(options.cookie);
        jQuery('#options-submit').bind('click', function (event) {
            event.preventDefault();
            jQuery('#designare-options').submit()
        });
        jQuery('#designare-content-container').delegate('.hover', 'mouseover', function () {
            jQuery(this).css({
                cursor: 'pointer'
            })
        });
        jQuery('.sortable').delegate('input', 'focusin', function () {
            jQuery(this).addClass('selected')
        }).delegate('input', 'focusout', function () {
            jQuery(this).removeClass('selected')
        });
        designareOptions.loadSelectedSliderNames();
        jQuery('#designare-content-container').append('<input type="hidden" value="Designare Options Panel" />')
    },
    setTabs: function (enableCookies) {
        jQuery('.main-navigation-container').hide();
        var selectedClass = 'ui-tabs-selected',
            mainNavCookie = 'designare-main-navigation',
            subNavCookie = 'designare-sub-navigation',
            mainNotSel = (enableCookies && jQuery.cookie(mainNavCookie)) ? jQuery.cookie(mainNavCookie) : ':first',
            mainSel = mainNotSel === ':first' ? 'a:first' : 'a[href="' + mainNotSel + '"]';
        if (mainNotSel === ':first') {
            jQuery('.main-navigation-container:first').show()
        } else {
            jQuery(mainNotSel).show()
        }
        jQuery('#content').css({
            backgroundImage: 'none'
        });
        jQuery('#navigation ' + mainSel).parents('li:first').addClass(selectedClass);
        jQuery('.main-navigation-container').each(function () {
            var thisId = '#' + jQuery(this).attr('id'),
                notSel = (enableCookies && jQuery.cookie(thisId)) ? jQuery.cookie(thisId) : ':first',
                sel = notSel === ':first' ? 'a.tab:first' : 'a.tab[href="' + notSel + '"]';
            jQuery(this).find('.sub-navigation-container').not(notSel).hide();
            jQuery(this).find(sel).parents('li:first').addClass(selectedClass)
        });
        jQuery('#navigation a').click(function (event) {
            event.preventDefault();
            var href = jQuery(this).attr('href');
            jQuery('.main-navigation-container').hide();
            jQuery(href).show();
            jQuery('#navigation li').removeClass(selectedClass);
            jQuery(this).parents('li:first').addClass(selectedClass);
            if (enableCookies) {
                jQuery.cookie(mainNavCookie, href)
            }
        });
        jQuery('a.tab').click(function (event) {
            event.preventDefault();
            var href = jQuery(this).attr('href');
            jQuery(href).show().siblings('.sub-navigation-container').hide();
            jQuery(this).parents('li:first').addClass(selectedClass).siblings('li').removeClass(selectedClass);
            if (enableCookies) {
                var parentId = '#' + jQuery(this).parents('div.main-navigation-container:first').attr('id');
                jQuery.cookie(parentId, href)
            }
        })
    },
    loadSelectedSliderNames: function () {
        var savedClass = jQuery('#dandelionfhome_slider').find('option[value="' + jQuery('#dandelion_home_slider').val() + '"]').attr('class');
        jQuery('#dandelion_home_slider_name option').not('.' + savedClass).hide();
        if (!jQuery('#dandelion_home_slider_name option.' + savedClass).length) {
            jQuery('#dandelion_home_slider_name').attr('disabled', 'disabled')
        }
        jQuery('#dandelion_home_slider').change(function () {
            var selectedval = jQuery(this).val(),
                selectedClass = jQuery(this).find('option[value="' + selectedval + '"]').attr('class'),
                selectedOptions = jQuery('#dandelion_home_slider_name option.' + selectedClass);
            if (selectedOptions.length) {
                jQuery('#dandelion_home_slider_name').removeAttr('disabled');
                selectedOptions.show();
                jQuery('#dandelion_home_slider_name option').not('.' + selectedClass).removeAttr('selected').hide()
            } else {
                jQuery('#dandelion_home_slider_name').attr('disabled', 'disabled')
            }
        })
    },
    removeSavedMessage: function () {
        jQuery('#saved_box').slideUp('slow')
    },
    setStyleSelectFunc: function () {
        jQuery('.styles-holder').each(function () {
            jQuery(this).delegate('a.style-box', 'click', function (event) {
                event.preventDefault();
                var $that = jQuery(this),
                    $parent = jQuery(this).parent();
                $parent.addClass('selected-style').siblings('.selected-style').removeClass('selected-style');
                $parent.parent().siblings('input').attr("value", $that.attr('title'))
            })
        })
    },
    setHelpFunc: function () {
        jQuery('#designare-content-container').delegate('a.help-button', 'click', function (event) {
            event.preventDefault();
            if (!designareOptions.dialogOpened) {
                jQuery(this).find('.help-dialog:first').clone().dialog({
                    autoOpen: true,
                    title: jQuery(this).attr('title'),
                    closeText: '',
                    open: function () {
                        designareOptions.dialogOpened = true
                    },
                    close: function () {
                        designareOptions.dialogOpened = false
                    }
                })
            }
        })
    },
    setColorpickFunc: function () {
        jQuery('input.color').ColorPicker({
            onSubmit: function (hsb, hex, rgb, el) {
                jQuery(el).val(hex);
                jQuery(el).ColorPickerHide();
                jQuery(el).siblings('.color-preview').css({
                    backgroundColor: '#' + hex
                })
            },
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            }
        }).bind('keyup', function () {
            var value = this.value;
            jQuery(this).ColorPickerSetColor(value);
            var bgColor = value === '' ? 'transparent' : '#' + value;
            jQuery(this).siblings('.color-preview').css({
                backgroundColor: bgColor
            })
        });
        jQuery('.color-preview').ColorPicker({
            onSubmit: function (hsb, hex, rgb, el) {
                jQuery(el).css({
                    backgroundColor: '#' + hex
                }).ColorPickerHide();
                jQuery(el).siblings('input.color').attr("value", hex)
            },
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(jQuery(this).siblings('input.color').attr('value'))
            }
        }).bind({
            'keyup': function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            'mouseover': function () {
                jQuery(this).css({
                    cursor: 'pointer'
                })
            }
        })
    },
    setOnOffFunc: function () {
        jQuery('div.on-off').each(function () {
            if (jQuery(this).siblings('input[type=hidden]:first').attr('value') === 'on') {
                jQuery(this).find('span').css({
                    marginLeft: 49
                })
            }
        });
        jQuery('div.on-off').bind('click', function () {
            var hiddenInput = jQuery(this).siblings('input[type=hidden]:first');
            if (hiddenInput.attr('value') == 'on') {
                jQuery(this).find('span').animate({
                    marginLeft: 2
                });
                hiddenInput.attr('value', 'off')
            } else {
                jQuery(this).find('span').animate({
                    marginLeft: 49
                });
                hiddenInput.attr('value', 'on')
            }
        })
    },
    setTextImageFunc: function () {
        jQuery('div.text-image').each(function () {
            if (jQuery(this).siblings('input[type=hidden]:first').attr('value') === 'text') {
                jQuery(this).find('span').css({
                    marginLeft: 49
                })
            }
        });
        jQuery('div.text-image').bind('click', function () {
            var hiddenInput = jQuery(this).siblings('input[type=hidden]:first');
            if (hiddenInput.attr('value') == 'text') {
                jQuery(this).find('span').animate({
                    marginLeft: 2
                });
                hiddenInput.attr('value', 'image')
            } else {
                jQuery(this).find('span').animate({
                    marginLeft: 49
                });
                hiddenInput.attr('value', 'text')
            }
        })
    },
    setLeftRightFunc: function () {
        jQuery('div.left-right').each(function () {
            if (jQuery(this).siblings('input[type=hidden]:first').attr('value') === 'right') {
                jQuery(this).find('span').css({
                    marginLeft: 49
                })
            }
        });
        jQuery('div.left-right').bind('click', function () {
            var hiddenInput = jQuery(this).siblings('input[type=hidden]:first');
            if (hiddenInput.attr('value') == 'right') {
                jQuery(this).find('span').animate({
                    marginLeft: 2
                });
                hiddenInput.attr('value', 'left')
            } else {
                jQuery(this).find('span').animate({
                    marginLeft: 49
                });
                hiddenInput.attr('value', 'right')
            }
        })
    },
    setLightDarkFunc: function () {
        jQuery('div.light-dark').each(function () {
            if (jQuery(this).siblings('input[type=hidden]:first').attr('value') === 'light') {
                jQuery(this).find('span').css({
                    marginLeft: 49
                })
            }
        });
        jQuery('div.light-dark').bind('click', function () {
            var hiddenInput = jQuery(this).siblings('input[type=hidden]:first');
            if (hiddenInput.attr('value') == 'light') {
                jQuery(this).find('span').animate({
                    marginLeft: 2
                });
                hiddenInput.attr('value', 'dark')
            } else {
                jQuery(this).find('span').animate({
                    marginLeft: 49
                });
                hiddenInput.attr('value', 'light')
            }
        })
    },
    loadUploader: function (element, pathToPhp, uploadsUrl, multi) {
		if (multi == null){
			multi = false;
		}
        var button = element,
            interval, buttonSpan;
        new AjaxUpload(button, {
            action: pathToPhp,
            name: "designarefile",
            onSubmit: function (file, ext) {
                buttonSpan = button.find('span');
                if (!buttonSpan.length) {
                    buttonSpan = button
                }
                buttonSpan.text('Upload');
                this.disable();
                interval = window.setInterval(function () {
                    var text = button.text();
                    if (text.length < 10) {
                        buttonSpan.text(text + '.')
                    } else {
                        buttonSpan.text('.')
                    }
                }, 200)
            },
            onComplete: function (file, response) {
            		imgUrl = uploadsUrl + '/' + response;
            		console.log(imgUrl);
            		var defVal = button.siblings('input.upload:first').attr('value');
            		if(multi && defVal != "")
            			button.siblings('input.upload:first').attr('value', defVal+'|*|'+imgUrl);
            		else 
                	button.siblings('input.upload:first').attr('value', imgUrl);
                	
                buttonSpan.text('Upload');
                window.clearInterval(interval);
                this.enable()
            }
        })
    },
    setCheckboxClickHandlers: function () {
        jQuery(".check").click(function (event) {
            event.preventDefault();
            var that = jQuery(this),
                value = that.attr('title'),
                checked = false,
                selectedClass = 'selected-check',
                hiddenInput = jQuery(that.parents().get(1)).siblings(".hidden-value:first"),
                hiddenIds = hiddenInput.val(),
                idsArray = hiddenIds === '' ? [] : hiddenIds.split(',');
            that.toggleClass(selectedClass);
            checked = that.hasClass(selectedClass);
            if (checked) {
                idsArray.push(value)
            } else {
                idsArray = jQuery.grep(idsArray, function (val) {
                    return val != value
                })
            }
            hiddenIds = idsArray.join(',');
            hiddenInput.val(hiddenIds)
        })
    },
    showSavedImgData: function (optionsData) {
        var count = optionsData.inputIds.length;
        var data = [];
        if (optionsData.hiddenIds[i]){
		    for (var i = 0; i < count; i++) {
	            data[i] = jQuery(optionsData.hiddenIds[i]).val().split(designareOptions.separator)
	        } 
	        for (var i = 0; i < count; i++) {
	            data[i] = jQuery(optionsData.hiddenIds[i]).val().split(designareOptions.separator)
	        }
          	var entryCount = data[0].length;
	        for (var j = 0; j < entryCount - 1; j++) {
	            var html = '<li>';
	            for (var i = 0; i < count; i++) {
	                if (optionsData.preview && optionsData.inputIds[i] === '#' + optionsData.preview) {
	                    html += designareOptions.generatePreview(data[i][j])
	                }
	                var none = data[i][j] === '' ? '<i>---</i>' : '';
	                html += '<b>' + optionsData.labels[i] + ': </b><span class="' + optionsData.spanClasses[i] + '">' + data[i][j] + '</span>' + none + '<br/>'
	            }
	            html += '<div class="editButton hover"></div><div class="deleteButton hover"></div></li>';
	            jQuery(optionsData.ulId).append(html)
	        }
        }
        
    },
    generatePreview: function (imgUrl) {
        return '<img src="' + imgUrl + '" />'
    },
    setCustomFieldsFunc: function (mainId, fieldIds, labels, istextarea, preview) {
        inputIds = [];
        hiddenIds = [];
        spanClasses = [];
        for (var i = 0, length = fieldIds.length; i < length; i++) {
            inputIds[i] = '#' + fieldIds[i];
            hiddenIds[i] = '#' + fieldIds[i] + 's';
            spanClasses[i] = fieldIds[i] + '_span'
        }
        var ulId = '#' + mainId + '_list';
        var addButton = '#' + mainId + '_button';
        optionsData = {
            inputIds: inputIds,
            hiddenIds: hiddenIds,
            spanClasses: spanClasses,
            istextarea: istextarea,
            ulId: ulId,
            labels: labels,
            addButton: addButton,
            preview: preview
        };
        designareOptions.setCommonAddFunc(optionsData)
    },
    setCommonAddFunc: function (optionsData) {
        designareOptions.showSavedImgData(optionsData);
        jQuery(optionsData.addButton).click(function (event) {
            event.preventDefault();
            designareOptions.addItem(optionsData)
        });
        jQuery(optionsData.ulId).bind('sortstop', function (event, ui) {
            designareOptions.setSliderImgChanges(optionsData)
        });
        designareOptions.setActionButtonHandlers(optionsData)
    },
    addItem: function (optionsData) {
        var length = optionsData.inputIds.length;
        var html = '<li>';
        for (var i = 0; i < length; i++) {
            if (optionsData.preview && optionsData.inputIds[i] === '#' + optionsData.preview) {
                html += designareOptions.generatePreview(jQuery(optionsData.inputIds[i]).attr("value"))
            }
            html += '<b>' + optionsData.labels[i] + ': </b><span class="' + optionsData.spanClasses[i] + '">' + jQuery(optionsData.inputIds[i]).attr("value") + '</span><br/>'
        }
        html += '<div class="editButton hover"></div><div class="deleteButton hover"></li>';
        jQuery(optionsData.ulId).append(html);
        designareOptions.setSliderImgChanges(optionsData)
    },
    setSliderImgChanges: function (optionsData) {
        var count = optionsData.inputIds.length;
        var values = [];
        for (i = 0; i < count; i++) {
            values[i] = ''
        }
        jQuery(optionsData.ulId + ' li').each(function () {
            for (i = 0; i < count; i++) {
                values[i] += jQuery(this).find('span.' + optionsData.spanClasses[i]).html() + designareOptions.separator
            }
        });
        for (i = 0; i < count; i++) {
            jQuery(optionsData.hiddenIds[i]).val(values[i])
        }
    },
    setActionButtonHandlers: function (optionsData) {
        jQuery(optionsData.ulId).delegate('.deleteButton', 'click', function () {
            jQuery(this).parent("li").remove();
            designareOptions.setSliderImgChanges(optionsData)
        });
        jQuery(optionsData.ulId).delegate('.editButton', 'click', function () {
            var currentLi = jQuery(this).parent('li');
            currentLi.find('i').remove();
            currentLi.find('span').each(function (i) {
                var that = jQuery(this),
                    spanclass = that.attr('class'),
                    spanvalue = that.html();
                if (optionsData.istextarea[i]) {
                    that.replaceWith(jQuery('<textarea type="text" class="inputarea ' + spanclass + '" >' + spanvalue + '</textarea>'))
                } else {
                    that.replaceWith(jQuery('<input type="text" value="' + spanvalue + '" class="' + spanclass + '" />'))
                }
            });
            jQuery(this).replaceWith(jQuery('<div class="doneButton hover"></div>').click(function (e) {
                e.preventDefault();
                currentLi.find('input,textarea').each(function () {
                    var that = jQuery(this),
                        spanclass = that.attr('class'),
                        spanvalue = that.val();
                    var none = spanvalue === '' ? '<i>---</i>' : '';
                    that.replaceWith(jQuery('<span class="' + spanclass + '">' + spanvalue + '</span>' + none))
                });
                designareOptions.setSliderImgChanges(optionsData);
                jQuery(this).replaceWith('<div class="editButton hover"></div>')
            }))
        })
    },
    makeExportFile: function(optionsData) { 
    	/* create the file */
    	console.log('download the file');
    }
};
jQuery(window).load(function () {
    if (jQuery('#saved_box').length) {
        setTimeout('designareOptions.removeSavedMessage()', 3000)
    }
});

function des_templater_actions_handler(action, value, des){
	var opts = [],
		values = [],
		newname = false,
		handler = jQuery('#templatepath').html()+"/lib/functions/des_templater.php";
	switch (value){
		case "general":
			opts = [des+"_style_defcolor", des+"_style_color"];
		break;
		case "body":
			opts = [des+"_body_layout_type", des+"_body_type", des+"_body_image", des+"_body_color", des+"_body_pattern", des+"_header_body_pattern", des+"_body_shadow", des+"_body_shadow_color", des+"_contentbg_type", des+"_contentbg_image", des+"_contentbg_color", des+"_contentbg_pattern", des+"_contentbg_custom_pattern", des+"_globalborders_bg_color"];
		break;
		case "header":
			opts = [des+"_enable_top_panel", des+"_toppanelbg_type", des+"_toppanelbg_image", des+"_toppanelbg_color", des+"_toppanelbg_pattern", des+"_toppanelbg_custom_pattern", des+"_toppanel_borderscolor", des+"_toppanel_linkscolor", des+"_toppanel_paragraphscolor", des+"_toppanel_headingscolor", des+"_info_above_menu", des+"_wpml_menu_widget", des+"_woocommerce_menu", des+"_woocommerce_shopping_cart", des+"_top_bar_menu", des+"_topbar_text_color", des+"_topbar_links_color", des+"_topbar_links_hover_color", des+"_topbar_bg_color", des+"_topbarborders_bg_color", des+"_social_icons_style", des+"_headerbg_type", des+"_headerbg_image", des+"_headerbg_color", des+"_headerbg_pattern", des+"_headerbg_custom_pattern", des+"_header_bordertopcolor", des+"_header_borderbottomcolor", des+"_header_bordersearchcolor", des+"_hide_headershadow", des+"_social_icons_style_four", des+"_search_menu_widget"];
		break;
		case "menu":
			opts = [des+"_menu_font", des+"_menu_font_size", des+"_menu_color", des+"_menu_uppercase", des+"_menu_background_color", des+"_menu_side_margin", des+"_big_menu_margin_top", des+"_big_menu_padding_bottom", des+"_small_menu_margin_top", des+"_small_menu_padding_bottom"];
		break;
		case "pagetitle":
			opts = [des+"_header_type", des+"_header_image", des+"_header_color", des+"_header_pattern", des+"_header_custom_pattern", des+"_banner_slider", des+"_page_title_shadow", des+"_page_title_shadow_color", des+"_header_height", des+"_hide_pagetitle", des+"_header_text_font", des+"_header_text_color", des+"_header_text_size", des+"_header_text_margin_top", des+"_hide_sec_pagetitle", des+"_secondary_title_font", des+"_secondary_title_text_color", des+"_secondary_title_text_size", des+"_breadcrumbs_text_margin_top", des+"_breadcrumbs"];
		break;
		case "footer":
			opts = [des+"_show_twitter_newsletter_footer", des+"_newsletter_enabled", des+"_show_twitter_scroller", des+"_twitter_newsletter_type", des+"_twitter_newsletter_image", des+"_twitter_newsletter_color", des+"_twitter_newsletter_pattern", des+"_twitter_newsletter_pattern", des+"_twitter_newsletter_borderscolor", des+"_show_primary_footer", des+"_footerbg_type", des+"_footerbg_image", des+"_footerbg_color", des+"_footerbg_pattern", des+"_footerbg_custom_pattern", des+"_footerbg_borderscolor", des+"_footerbg_linkscolor", des+"_footerbg_paragraphscolor", des+"_footerbg_headingscolor", des+"_show_sec_footer", des+"_sec_footerbg_type", des+"_sec_footerbg_image", des+"_sec_footerbg_color", des+"_sec_footerbg_pattern", des+"_sec_footerbg_custom_pattern", des+"_sec_footerbg_borderscolor", des+"_sec_footerbg_linkscolor", des+"_sec_footerbg_paragraphscolor"];
		break;
		case "text":
			opts = [des+"_links_font", des+"_links_size", des+"_links_color", des+"_links_color_hover", des+"_links_bg_color_hover", des+"_p_font", des+"_p_size", des+"_p_color", des+"_st_font", des+"_st_size", des+"_st_color", des+"_h1_font", des+"_h1_size", des+"_h1_color", des+"_h2_font", des+"_h2_size", des+"_h2_color", des+"_h3_font", des+"_h3_size", des+"_h3_color", des+"_h4_font", des+"_h4_size", des+"_h4_color", des+"_h5_font", des+"_h5_size", des+"_h5_color", des+"_h6_font", des+"_h6_size", des+"_h6_color"];
		break;
	}
	for (var i=0; i<opts.length; i++){
		if (jQuery('#'+opts[i]).is('select')){
			opts[i] += " option:selected";
		}
		values.push(jQuery('#'+opts[i]).val());
	}
		
	if (action === "save_new"){
		jQuery(".newnamebox#namebox-"+value).dialog({
			modal: true,
			buttons:{ "Save" : function(){
					newname = jQuery(this).find('.save_new').val();
					jQuery.ajax({
				        url: handler,
				        dataType: 'JSON',
				        type: 'POST',
				        data: {
				        	current : jQuery('#des_style_template_chooser_'+value).val(),
				        	action : action,
				        	newname : newname,
				        	template : value,
					        opts : opts,
					        values : values
				        },
				        success: function(response){
				            jQuery('#des_style_template_chooser_'+value+' option:selected').removeAttr('selected');
				            jQuery('#des_style_template_chooser_'+value).append('<option value="des_template_['+value+']_'+response['des_template_tab']['name']+'">'+newname+'</option>').val('des_template_['+value+']_'+response['des_template_tab']['name']);
				            jQuery('#des_current_'+value+'_template').val('des_template_['+value+']_'+response['des_template_tab']['name']);
				            jQuery(".newnamebox#namebox-"+value).dialog("close");
				            jQuery(".newnamebox#namebox-"+value).dialog("destroy");
				            jQuery('#des_style_template_chooser_'+value).siblings('.warning').css('display','none');
				            jQuery('#des_style_template_chooser_'+value).css('display','block');
				            jQuery('#des_style_template_chooser_'+value).siblings('h4').css('display','block');
				            jQuery.ajax({
						        url: handler,
						        dataType: 'JSON',
						        type: 'POST',
						        data: {
						        	current : jQuery('#des_style_template_chooser_'+value).val(),
						        	newname : jQuery('#des_style_template_chooser_'+value+' option:selected').html(),
						        	action : "save_current",
						        	template : value,
							        opts : opts,
							        values : values
						        },
						        success: function(response){
						            if (response == 1){
							        	jQuery('#des_templater_'+value+' .msg_save_new').css('opacity',1);
							        	setTimeout(function(){ jQuery('#des_templater_'+value+' .msg_save_new').css('opacity',0); }, 2000);  
						            }
						        }
						    });
				        }
				    });
				},
				"Cancel" : function(){
					jQuery(".newnamebox#namebox-"+value).dialog("close");
					jQuery(".newnamebox#namebox-"+value).dialog("destroy");
				}
			}
		});
	} else {
		jQuery.ajax({
	        url: handler,
	        dataType: 'JSON',
	        type: 'POST',
	        data: {
	        	current : jQuery('#des_style_template_chooser_'+value).val(),
	        	newname : jQuery('#des_style_template_chooser_'+value+' option:selected').html(),
	        	action : action,
	        	template : value,
		        opts : opts,
		        values : values
	        },
	        success: function(response){
	        	if (action === "delete_current" && response == "itemdeleted"){
	        		jQuery('#des_templater_'+value+' .msg_deleted').css('opacity',1);
		        	setTimeout(function(){ jQuery('#des_templater_'+value+' .msg_deleted').css('opacity',0); }, 2000);  
		        	jQuery('#des_style_template_chooser_'+value+' option[value="'+jQuery('#des_style_template_chooser_'+value).val()+'"]').remove();
		        	jQuery('#des_current_'+value+'_template').val(jQuery('#des_style_template_chooser_'+value).val());
		        	if (!jQuery('#des_style_template_chooser_'+value+' option').length){
			        	jQuery('#des_style_template_chooser_'+value).css('display','none').siblings('.warning').css('display','block');
		        	}
		        	jQuery.ajax({
				        url: handler,
				        dataType: 'JSON',
				        type: 'POST',
				        data: {
				        	current : jQuery('#des_style_template_chooser_'+value).val(),
				        	newname : jQuery('#des_style_template_chooser_'+value+' option:selected').html(),
				        	action : "load_template",
				        	template : value,
					        opts : opts,
					        values : values
				        },
				        success: function(response){
				            /*horizontal sliders*/
				            setTimeout(function(){
					        	jQuery('.ui-slider').each(function(i,e){
						            jQuery(e).find('.ui-slider-range').css('width', parseInt(jQuery(e).siblings('input').val(), 10)+'%');
						            jQuery(e).find('.ui-slider-handle').css('left', parseInt(jQuery(e).siblings('input').val(), 10)+'%');
					            });
				            }, 20);
				            /*selects*/
				            if (typeof(response) === "string"){
					            response = unserialize(response);
				            }
				            var count = Object.keys(response).length;
				            for (var i=0; i<count-1; i++){
				            	var elm = response[i][0].toString();
					            if (elm.indexOf("selected") != -1){
					            	elm = elm.split(" option:selected");
				            		elm = elm[0];
						            jQuery('#'+elm).val(response[i][1]);
					            } else {
						            jQuery('#'+response[i][0]).val(response[i][1]);	
					            }			            
				            }
				            /*colorpickers*/
							jQuery('.color-preview').each(function(e){
								if (jQuery(this).siblings('.color').val() != "")
									jQuery(this).css('background-color', '#'+jQuery(this).siblings('.color').val());
								else jQuery(this).css('background-color', 'transparent');
							});
							/*patterns,colors,etc - styles-holder*/
							jQuery('.styles-holder').each(function(e){
								jQuery(this).find('ul li a[title="'+jQuery(this).children('input').val()+'"]').parent().addClass('selected-style').siblings().removeClass('selected-style');
							});
							/*checkboxes*/
							jQuery('div.on-off').each(function(){
								var hiddenInput = jQuery(this).siblings('input[type=hidden]:first');
					            if (hiddenInput.attr('value') == 'on') {
					                jQuery(this).find('span').animate({
					                    marginLeft: 49
					                });
					            } else {
					                jQuery(this).find('span').animate({
					                    marginLeft: 2
					                });
					            }
							});
				        }
				    });
		        	if (response == 1){
			        	jQuery('#des_templater_'+value+' .msg_deleted').css('opacity',1);
			        	setTimeout(function(){ jQuery('#des_templater_'+value+' .msg_deleted').css('opacity',0); }, 2000);  
		            }
	        	}
	            if (response == 1){
		        	jQuery('#des_templater_'+value+' .msg_save_success').css('opacity',1);
		        	setTimeout(function(){ jQuery('#des_templater_'+value+' .msg_save_success').css('opacity',0); }, 2000);  
	            }
	            if (action === "load_template"){
		            jQuery('#des_templater_'+value+' .msg_loaded').css('opacity',1);
		        	setTimeout(function(){ jQuery('#des_templater_'+value+' .msg_loaded').css('opacity',0); }, 2000);  
		            /*horizontal sliders*/
		            setTimeout(function(){
			        	jQuery('.ui-slider').each(function(i,e){
				            jQuery(e).find('.ui-slider-range').css('width', parseInt(jQuery(e).siblings('input').val(), 10)+'%');
				            jQuery(e).find('.ui-slider-handle').css('left', parseInt(jQuery(e).siblings('input').val(), 10)+'%');
			            });
		            }, 20);
		            /*selects*/
		            
					while (!jQuery.isPlainObject(response)){
						response = unserialize(response);
					}
		         	var count = Object.keys(response).length;
		            for (var i=0; i<count-1; i++){
		            	var elm = response[i][0].toString();
			            if (elm.indexOf("selected") != -1){
			            	elm = elm.split(" option:selected");
		            		elm = elm[0];
				            jQuery('#'+elm).val(response[i][1]);
			            } else {
				            jQuery('#'+response[i][0]).val(response[i][1]);	
			            }			            
		            }   
		            /*colorpickers*/
					jQuery('.color-preview').each(function(e){
						if (jQuery(this).siblings('.color').val() != "")
							jQuery(this).css('background-color', '#'+jQuery(this).siblings('.color').val());
						else jQuery(this).css('background-color', 'transparent');
					});
					/*patterns,colors,etc - styles-holder*/
					jQuery('.styles-holder').each(function(e){
						jQuery(this).find('ul li a[title="'+jQuery(this).children('input').val()+'"]').parent().addClass('selected-style').siblings().removeClass('selected-style');
					});
					/*checkboxes*/
					jQuery('div.on-off').each(function(){
						var hiddenInput = jQuery(this).siblings('input[type=hidden]:first');
			            if (hiddenInput.attr('value') == 'on') {
			                jQuery(this).find('span').animate({
			                    marginLeft: 49
			                });
			            } else {
			                jQuery(this).find('span').animate({
			                    marginLeft: 2
			                });
			            }
					});
	            }
	        }
	    });
	}
}

function unserialize(data) {
  //  discuss at: http://phpjs.org/functions/unserialize/
  // original by: Arpad Ray (mailto:arpad@php.net)
  // improved by: Pedro Tainha (http://www.pedrotainha.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Chris
  // improved by: James
  // improved by: Le Torbi
  // improved by: Eli Skeggs
  // bugfixed by: dptr1988
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //  revised by: d3x
  //    input by: Brett Zamir (http://brett-zamir.me)
  //    input by: Martin (http://www.erlenwiese.de/)
  //    input by: kilops
  //    input by: Jaroslaw Czarniak
  //        note: We feel the main purpose of this function should be to ease the transport of data between php & js
  //        note: Aiming for PHP-compatibility, we have to translate objects to arrays
  //   example 1: unserialize('a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}');
  //   returns 1: ['Kevin', 'van', 'Zonneveld']
  //   example 2: unserialize('a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}');
  //   returns 2: {firstName: 'Kevin', midName: 'van', surName: 'Zonneveld'}

  var that = this,
    utf8Overhead = function(chr) {
      // http://phpjs.org/functions/unserialize:571#comment_95906
      var code = chr.charCodeAt(0);
      if (code < 0x0080) {
        return 0;
      }
      if (code < 0x0800) {
        return 1;
      }
      return 2;
    };
  error = function(type, msg, filename, line) {
    throw new that.window[type](msg, filename, line);
  };
  read_until = function(data, offset, stopchr) {
    var i = 2,
      buf = [],
      chr = data.slice(offset, offset + 1);

    while (chr != stopchr) {
      if ((i + offset) > data.length) {
        error('Error', 'Invalid');
      }
      buf.push(chr);
      chr = data.slice(offset + (i - 1), offset + i);
      i += 1;
    }
    return [buf.length, buf.join('')];
  };
  read_chrs = function(data, offset, length) {
    var i, chr, buf;

    buf = [];
    for (i = 0; i < length; i++) {
      chr = data.slice(offset + (i - 1), offset + i);
      buf.push(chr);
      length -= utf8Overhead(chr);
    }
    return [buf.length, buf.join('')];
  };
  _unserialize = function(data, offset) {
    var dtype, dataoffset, keyandchrs, keys, contig,
      length, array, readdata, readData, ccount,
      stringlength, i, key, kprops, kchrs, vprops,
      vchrs, value, chrs = 0,
      typeconvert = function(x) {
        return x;
      };

    if (!offset) {
      offset = 0;
    }
    dtype = (data.slice(offset, offset + 1))
      .toLowerCase();

    dataoffset = offset + 2;

    switch (dtype) {
      case 'i':
        typeconvert = function(x) {
          return parseInt(x, 10);
        };
        readData = read_until(data, dataoffset, ';');
        chrs = readData[0];
        readdata = readData[1];
        dataoffset += chrs + 1;
        break;
      case 'b':
        typeconvert = function(x) {
          return parseInt(x, 10) !== 0;
        };
        readData = read_until(data, dataoffset, ';');
        chrs = readData[0];
        readdata = readData[1];
        dataoffset += chrs + 1;
        break;
      case 'd':
        typeconvert = function(x) {
          return parseFloat(x);
        };
        readData = read_until(data, dataoffset, ';');
        chrs = readData[0];
        readdata = readData[1];
        dataoffset += chrs + 1;
        break;
      case 'n':
        readdata = null;
        break;
      case 's':
        ccount = read_until(data, dataoffset, ':');
        chrs = ccount[0];
        stringlength = ccount[1];
        dataoffset += chrs + 2;

        readData = read_chrs(data, dataoffset + 1, parseInt(stringlength, 10));
        chrs = readData[0];
        readdata = readData[1];
        dataoffset += chrs + 2;
        if (chrs != parseInt(stringlength, 10) && chrs != readdata.length) {
          error('SyntaxError', 'String length mismatch');
        }
        break;
      case 'a':
        readdata = {};

        keyandchrs = read_until(data, dataoffset, ':');
        chrs = keyandchrs[0];
        keys = keyandchrs[1];
        dataoffset += chrs + 2;

        length = parseInt(keys, 10);
        contig = true;

        for (i = 0; i < length; i++) {
          kprops = _unserialize(data, dataoffset);
          kchrs = kprops[1];
          key = kprops[2];
          dataoffset += kchrs;

          vprops = _unserialize(data, dataoffset);
          vchrs = vprops[1];
          value = vprops[2];
          dataoffset += vchrs;

          if (key !== i)
            contig = false;

          readdata[key] = value;
        }

        if (contig) {
          array = new Array(length);
          for (i = 0; i < length; i++)
            array[i] = readdata[i];
          readdata = array;
        }

        dataoffset += 1;
        break;
      default:
        error('SyntaxError', 'Unknown / Unhandled data type(s): ' + dtype);
        break;
    }
    return [dtype, dataoffset - offset, typeconvert(readdata)];
  };

  return _unserialize((data + ''), 0)[2];
}