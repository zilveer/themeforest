/**
	Penguin Framework

	Copyright (c) 2009-2015 ThemeFocus

	@url http://penguin.themefocus.co
	@package Penguin
	@version 4.0
**/

jQuery(document).ready(function($) {
    
	/* create penguin object */
	var penguin = new Object({
		
		// ---------------------------------------
		//	tabs for penguin framework page
		// ---------------------------------------
		tabs:{ init:function(){
				var bitems	= $('.penguin-tabs .penguin-tabs-nav li');
				var citems	= $('.penguin-tabs-content');
				var current_index 	= 0;
				var new_index 		= 0;
				var run_tab			= false;
				
				var cookie = penguin.getCookie("penguin_section_page");
				if(cookie != null && $(".penguin-update-tip").length>0) {
					for(var w=0; w<citems.length; w++){
						if($(citems[w]).attr('id') == cookie){
							current_index = w;
							break;
						}
					}
				} else {
					penguin.delCookie("penguin_section_page");
				}
				
				$(citems[current_index]).addClass("show");
				$(bitems[current_index]).addClass("current");
				
				for(var i = 0; i< bitems.length; i++){
					if($(bitems[i]).children('a').attr('data-type') == "link"){continue;}
					$(bitems[i]).click(function() {
						var my_index = $(this).index();
						if(run_tab || current_index == my_index){return;}
						run_tab = true;
						new_index = my_index;
						$(bitems[current_index]).removeClass("current");
						$(bitems[new_index]).addClass("current");
						penguin.addCookie("penguin_section_page",$(citems[my_index]).attr('id'),0) ;
						$(citems[current_index]).removeClass("show");
						$(citems[new_index]).addClass("show");
						$(citems[new_index]).css('opacity',0).animate({opacity:1},400);
						current_index = new_index;
						refreshEndButton();
						run_tab = false;
						return false;
                    });
				}
				
				$('.penguin-over').fadeOut(1000,'',removePenguinOver);

				//setTimeout(removePenguinOver,500);
				
				function refreshEndButton(){
					if($(citems[current_index]).hasClass("penguin-custom-page") || $(citems[current_index]).hasClass("penguin-module-page")) {
						$(".penguin-page-end").css('display','none');
					} else {
						$(".penguin-page-end").css('display','block');
					}
				}
				
				function removePenguinOver(){
					$('.penguin-over').remove();
					$('#penguin-content').addClass('show-init');
				}			
			}
		},
		// ---------------------------------------
		//	Upload your images 
		// ---------------------------------------
		uploadImages:{init:function(){
				var upload_image_id = '';
				
				$( '.upload-image-button' ).click(function() {
					var imgUpload = $(this).parent().find('.upload-image-input');
					if( imgUpload.length != 0) {
						upload_image_id = imgUpload.attr( 'id' );
						
						var frame = wp.media({
							title : 'Add your image',
							multiple : false,
							library : { type : 'image'},
							button : { text : 'Insert' },
						});
						frame.on('open',function() {
							// open window
						});
						frame.on('close',function() {
							// close window
						});
						
						frame.on( 'select', function() {
							// select images
							var attachment = frame.state().get('selection').first().toJSON();
							var imgurl = attachment.url;
							
							$( '#'+upload_image_id ).val(imgurl);
						
							if($( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').children("img").length == 0){
								$( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').html('<img class="penguin-preview-image-img" src="'+imgurl+'" alt="image" >');
							}else{
								$( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').children("img").attr("src",imgurl).fadeIn();
							}
								
							upload_image_id = '';
						});
						
						frame.open();
					}
					return false;
				});
				
				$( '.remove-image-button' ).click(function() {
					var imgUpload = $(this).parent().find('.upload-image-input');
					if( imgUpload.length != 0) {
						upload_image_id = imgUpload.attr( 'id' );
						$( '#'+upload_image_id ).val('');
						$( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').children("img").remove();
						upload_image_id = '';	
					}
					return false;
				});
				
			}
		},
		// ---------------------------------------
		//	ColorPicker
		// ---------------------------------------
		picker:{init:function(){
				// check colorpicker
				penguin.checkElement(".penguin-color-picker",backColorPicker);

				function backColorPicker(params){
					var citem = params;
					$(citem).ColorPicker({
						color:penguin.RGBToHex($(citem).children("b").css('backgroundColor')),
						onShow: function (colpkr) {
							$(colpkr).fadeIn(500);
							return false;
						},
						onHide: function (colpkr) {
							$(colpkr).fadeOut(500);
							return false;
						},
						onChange: function (hsb, hex, rgb) {
							$(citem).children("b").css('backgroundColor', '#' + hex);
							$(citem).children("span").html('#' + hex);
							$(citem).parent().find("input").attr("value",hex);
						}
					});
				}
			}
		},
		// ---------------------------------------
		//	Message
		// ---------------------------------------
		message:{init:function(){
				if($(".penguin-update-tip").find(".message-close-button").length > 0){
					$(".penguin-update-tip").find(".message-close-button").click(function() {
						hideElement();
                    });
					setTimeout(hideElement,4000);
				}
				
				function hideElement(){
					$(".penguin-update-tip").fadeOut("fast");
				}
			}
		},
		backsetting:{init:function(){
				penguin.checkElement(".penguin-setting-back",backSetting);
				function backSetting(params){
					var item = params;
					$(params).find(".penguin-input-checkbox").click(function() {
						if($(this).attr("checked") == "checked"){
							alert($(item).parent().find(".penguin-setting-tip").html());
						}
                    });
				}
			}
		},
		// ---------------------------------------
		//	penguin checkbox, enabled for penguin framework page
		// ---------------------------------------
		checkboxenabled:{init:function(){
				penguin.checkElement(".penguin-checkbox",backCheckboxEnabled);
				function backCheckboxEnabled(params){
					$(params).click(function() {
						if($(this).hasClass('select')){
							$(this).removeClass('select');
							$('#'+ $(this).attr('data-id')).attr('value','off');
						}else{
							$(this).addClass('select');
							$('#'+ $(this).attr('data-id')).attr('value','on');
						}
					});
				}
			}
		},
		// ---------------------------------------
		//	penguin enabled select, button effect
		// ---------------------------------------
		enabledEffect:{init:function(){
				$('.penguin-enable-element select').each(function() {
					$(this).change(function() {
						checkEnableSelect(this,true,0);
					});
					checkEnableSelect(this,true,0);
				});
				
				$('.penguin-enable-element .penguin-checkbox').each(function() {
					$(this).click(function() {
						checkboxCheck(this);
					});
					checkboxCheck($(this));
				});
				
				$('.penguin-enable-element input[type=radio]').each(function() {
					$(this).click(function() {
						checkRadio(this);
					});
					checkRadio(this);
				});
				
				// check radio type element
				function checkRadio(element){
					if($(element).attr('checked') != "checked"){
						return;
					}
					var index = parseInt($(element).attr('value'));
					
					var group = $(element).parent().parent().parent().attr('data-group');

					if(group && group != ''){
						$('.'+group).css('display','none');
						var items = String($(element).parent().parent().parent().attr('data-id')).split(':');
						for(var i=0;i<items.length;i++){
							var info = items[i].split('-');
							if(index == parseInt(info[0]) && String(info[1]) != ''){
								$('.'+String(info[1])).css('display','inline-block');
							}
						}
					}
				}
				
				function checkEnableSelect(element, bool, index){
					if(bool){
						index = element.selectedIndex;
					}
					var group = jQuery(element).parent().parent().attr('data-group');
					if(group && group != ''){
						$('.'+group).hide();
						var items = String(jQuery(element).parent().parent().attr('data-id')).split(':');
						for(var i=0;i<items.length;i++){
							var info = items[i].split('-');
							if(index == parseInt(info[0]) && String(info[1]) != ''){
								$('.'+String(info[1])).show();
							}
						}
					}
				}
				
				function checkboxCheck(element){
					if($('#'+ $(element).attr('data-id')).attr('value') == "on"){
						checkEnableSelect(element,false, 1);
					}else{
						checkEnableSelect(element,false, 0);
					}
				}
				
			}
		},
		// ---------------------------------------
		//	penguin tips
		// ---------------------------------------
		tiptool:{init:function(){
				var tip_position = new Array();
				
				var tip_ps = $('#penguin-container').attr('data-tip-position').split('|');
				
				if(tip_ps && tip_ps.length == 2){
					tip_position[0] = tip_ps[0];
					tip_position[1] = tip_ps[1];
				}else{
					tip_position[0] = 'bottom left';
					tip_position[1] = 'top left';
				}
				
				tip_ps = $('#penguin-container').attr('data-tip-click-element').split('|');
				
				if(tip_ps && tip_ps.length == 2){
					tip_position[2] = tip_ps[0];
					tip_position[3] = tip_ps[1];
				}else{
					tip_position[2] = 'right center';
					tip_position[3] = 'left center';
				}
				
				$(".tiptip-element").each(function() {
					$(this).qtip({ // Grab all elements with a non-blank data-tooltip attr.
						content: $(this).parent().find('.penguin-page-content-desc').html(),
						position: {
							my: tip_position[0],  // Position my top left...
							at: tip_position[1], // at the bottom right of...
						}
					});
				});
				
				$(".tiptip-click-element").each(function() {
					$(this).qtip({ // Grab all elements with a non-blank data-tooltip attr.
						content: $(this).parent().find('.penguin-page-content-desc').html(),
						position: {
							my: tip_position[2],  // Position my top left...
							at: tip_position[3], // at the bottom right of...
						}
					});
				});
			}
		},
		// ---------------------------------------
		//	penguin CodeMirror
		// ---------------------------------------
		codeMirror:{init:function(){
				if($('body.rtl').length != 0 ){return false;}
				$(".codemirror-element").each(function() {
					var codeMirror = CodeMirror.fromTextArea(document.getElementById($(this).attr('id')) , {
					  value: $(this).value,
					  mode:  $(this).attr('data-type'),
					  dir:'rtl',
					  lineNumbers: true
					});
				});
			}
		},
		// ---------------------------------------
		//	penguin Image Radio
		// ---------------------------------------
		imageRadio:{init:function(){
				$('.penguin-image-radios').each(function() {
					var radio = $(this);
					var items = $(this).children('.penguin-image-radio ');
                	$(items).click(function() {
						if($(this).hasClass('selected')){
							return false;
						}
						$(items).removeClass('selected');
                        $(this).addClass('selected');
						$(radio).find('input').attr('value',$(this).attr('data-id'));
                    });
                });
			}
		},
		// ---------------------------------------
		//	penguin Drag Element
		// ---------------------------------------
		dragElement:{init:function(){
				penguin.checkElement(".penguin-drag-container",backDragElement);
				
				function backDragElement(params){
					$(params).children(".penguin-drag-elements").dragsort({dragSelector: ".penguin-drag-btn", dragEnd:refreshDragData });
					
					$(params).find('.penguin-drag-check').click(function() {
                        if(!$(this).hasClass('show')){
							$(this).addClass('show');
							if($(this).parent().prev('.penguin-drag-check-position').length > 0){
								$(this).parent().prev('.penguin-drag-check-position').find('.penguin-drag-check').removeClass('show');
							}else if($(this).parent().next('.penguin-drag-check-position').length > 0){
								$(this).parent().next('.penguin-drag-check-position').find('.penguin-drag-check').removeClass('show');
							}
						}else{
							$(this).removeClass('show')
						}
						refreshDragData();
                    });
					
					function refreshDragData(){
						var items = $(params).find('.penguin-drag-element');
						var out_html = '';
						for(var i=0; i<items.length; i++ ){
							if(i > 0){ out_html += '|';}
							var pid = 2;
							
							var pos = $(items[i]).find('.penguin-drag-check-position');
							
							for(var k=0;k<pos.length;k++){
								if($(pos[k]).find('.show').length > 0){
									pid = k;
									break;
								}
							}
							out_html += $(items[i]).attr('data-index')+'-'+pid;
						}
						
						$(params).children('input').attr('value',out_html);
					}
				}
			}
		},
		// ---------------------------------------
		//	COMMON -----------  check element and ex fun
		// ---------------------------------------
		checkElement:function(params,fun){
			var list = $(params);
			if(list.length <= 0){	return false;	}
			for (var w=0;w<list.length;w++){
				fun(list[w]);
			}
		},
		// ---------------------------------------
		//	Cookie ----------- save ,delete ,get cookie
		// ---------------------------------------
		addCookie:function(name,value,hours){
			var str = name + "=" + escape(value); 
			if(hours > 0){
				var date = new Date();
				var ms = hours*3600*1000;
				date.setTime(date.getTime() + ms);
				str += "; expires=" + date.toGMTString();
			}
			document.cookie = str;
		},
		getCookie:function(name){
			var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
			if(arr != null) return unescape(arr[2]); 
			return null;
		},
		delCookie:function(name){
			document.cookie = name+"=;expires="+(new Date(0)).toGMTString();
		},
		// ---------------------------------------
		//	RGB -> HEX 
		// ---------------------------------------
		RGBToHex:function(color){ 
			if (color.substr(0, 1) == '#') {
				return color;
			}
			var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(color);

			if(digits == null || digits.length < 3) digits = [255,255,255];
			
			var red = parseInt(digits[2]);
			var green = parseInt(digits[3]);
			var blue = parseInt(digits[4]);
			
			var rgb = blue | (green << 8) | (red << 16);
			return digits[1] + '#' + rgb.toString(16);
		} 
	});/* penguin object */
	
	penguin.uploadImages.init();
	penguin.picker.init();
	penguin.backsetting.init();
	penguin.message.init();
	penguin.checkboxenabled.init();
	if(typeof(CodeMirror) !== 'undefined')	{
		penguin.codeMirror.init();
	}
	penguin.enabledEffect.init();
	penguin.tabs.init();
	penguin.imageRadio.init();
	penguin.dragElement.init();

	$('.penguin-options-save').click(function() { 
		$('#penguin-options-form').submit(); return false;
	});
	
	$('#penguin-options-import').click(function() { 
		if($(this).parent().find('textarea').val() == ""){
			alert('You have no input any code!');
			return false;
		}
		$('#penguin-options-form').submit();
		return false;
	});

});