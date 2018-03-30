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
		init:function(){
			// check all meta container elements
			
			$('.penguin-meta-container').each(function() {
				
            	var current_index 	= 0;
				var tabs 			= $(this).find('.penguin-meta-tabs a');
				var contents 		= $(this).find('.penguin-meta-content');
				
				for(var i=0;i<tabs.length;i++){
					if(i == current_index){
						$(tabs[i]).parent().addClass('current');
						$(contents[i]).addClass('current');
					}
					$(tabs[i]).click(function() {
                        $(tabs).parent().removeClass('current');
						$(contents).removeClass('current');
						$(this).parent().addClass('current');
						$($(this).attr('href')).addClass('current');
						return false;
                    });
				}
				
				if(tabs.length == 0){
					$(contents[current_index]).addClass('current');
				}
				
            });
			
			
			
			penguin.picker.init();
			penguin.uploadImages.init();
			penguin.checkboxenabled.init();
			//penguin.tiptool.init();
			penguin.enabledEffect.init(true);
			penguin.customFields.init();
			penguin.templateOptions.init();
			penguin.postFormatOptions.init();
		
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
		//	Upload your images 
		// ---------------------------------------
		uploadImages:{init:function(){
				var upload_image_id = '';
				
				uploadImage($( '.upload-image-button'));
				removeImage($( '.remove-image-button'));
				
				// upload image
				function uploadImage(element){
					$(element).click(function() {
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
								var imgurl = attachment.url, imgid = attachment.id;
								
								if($( '#'+upload_image_id ).hasClass('no-id')){
									$( '#'+upload_image_id ).val(imgurl);
								}else{
									$( '#'+upload_image_id ).val(imgurl + '<|>' + imgid);
								}
								
								if($( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').children("img").length == 0){
									$( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').html('<img class="penguin-preview-image-img" src="'+imgurl+'" alt="image" >');
								}else{
									$( '#'+upload_image_id).parent().parent().find('.penguin-preview-image').children("img").attr("src",imgurl).fadeIn();
								}
								
								upload_image_id = '';
								
								refreshGalleryData(null);
							});
							
							frame.open();
						}
						return false;
					});
				}
				
				// remove image 
				function removeImage(element){
					$(element).click(function() {
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
				
				//penguin custom gallery
				penguin.checkElement(".penguin-gallery-container",backCustomGallery);
				
				$(".penguin-gallery-elements").dragsort({dragSelector: ".drag-image-button",dragEnd:refreshGalleryData });
				
				function backCustomGallery(params){
					var gitems = $(params).find('.penguin-gallery-element');
					var gid = gitems.length;
					
					$(params).find('.penguin-custom-btns .penguin-add-button').click(function() {
						var add_html	=	'<li class="penguin-gallery-element" ><div><span class="drag-image-button"><i class="fa fa-bars fa-lg"></i></span><input id="'+ $(params).children('input').attr('name') + '-' + gid + '" class="penguin-input-text upload-image-input" type="text" readonly="readonly"><a class="penguin-input-button upload-image-button" href="#"><i class="fa fa-upload fa-lg"></i></a><a class="penguin-input-button edit-image-caption" href="#"><i class="fa fa-pencil"></i></a><a class="penguin-input-button remove-gallery-button" href="#"><i class="fa fa-trash-o fa-lg"></i></a></div><div class="penguin-preview-image"></div></li>';
						
						gid++;
						$(params).find('.penguin-gallery-elements').append(add_html);
						gitems = $(params).find('.penguin-gallery-element');
						
						uploadImage($(gitems[gitems.length-1]).find( '.upload-image-button'));
						editGallery($(gitems[gitems.length-1]).find( '.edit-image-caption'));
						removeGallery($(gitems[gitems.length-1]).find( '.remove-gallery-button'));
						
						return false;
					});
					
					$(params).find('.penguin-custom-btns .penguin-delete-button').click(function() {
						gitems = $(params).find('.penguin-gallery-element');
						if(gitems.length == 0){return false;}
						for(var i=0;i<gitems.length;i++){
							$(gitems[i]).remove();
						}
						gitems = Array();
						gid = 0;
						refreshGalleryData(params);
                        return false;
					});
					
					removeGallery($(params).find( '.remove-gallery-button'));
					editGallery($(params).find( '.edit-image-caption'));
					
					// remove gallery
					function removeGallery(element){
						$(element).click(function() {
							$(this).parent().parent().remove();
							refreshGalleryData(params);
							return false;
						});
					}
					
					//edit image 
					function editGallery(element){
						$(element).click(function() {
							var url = $(element).parent().children('input').attr('value') ;
							if(url == ""){return false;}
							var base = window.location.href
							base = (base.split("?"))[0];
							url = url.split("<|>");
							if(url.length > 1 && url[1] != null && parseInt(url[1]) > 0){
								url =  base + '?post=' + url[1] + '&action=edit';
								var win=window.open(url, '_blank');
							}
							return false;
						});
					}
					
				}
				
				//refresh gallery
				function refreshGalleryData(params){
					if(params == null){
						params = '.penguin-gallery-container';
					}
					$(params).each(function() {
                        var gitems 		= $(this).find('.penguin-gallery-element');
						var out_html 	= '';
						var count		= 0;
						for(var i=0;i<gitems.length;i++){
							var img_url = $(gitems[i]).find('input').attr('value');
							if(img_url == ""){
								continue;
							}
							if(count > 0){
								out_html += '{|}';
							}
							out_html += img_url;
							count++;
						}
						$(this).children('input').attr('value',out_html);
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
		//	penguin tips
		// ---------------------------------------
		tiptool:{init:function(){
				var tip_position = new Array();

				if($('body.rtl').length > 0){
					tip_position[0] = 'bottom right';
					tip_position[1] = 'top right';
				}else{
					tip_position[0] = 'bottom left';
					tip_position[1] = 'top left';
				}
				
				$(".tiptip-click-element").each(function() {
					$(this).qtip({ // Grab all elements with a non-blank data-tooltip attr.
						content: $(this).parent().find('.penguin-meta-desc-content').html(),
						position: {
							my: tip_position[0],  // Position my top left...
							at: tip_position[1], // at the bottom right of...
						}
					});
				});
			}
		},
		// ---------------------------------------
		//	penguin enabled select, button effect
		// ---------------------------------------
		enabledEffect:{init:function(ex_bool){
				if(ex_bool){
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
				}else{
					checkHideEnableElement();
				}
				
				function checkHideEnableElement(){
					$('.penguin-enable-element').each(function() {
						if($(this).css('display') == "none"){
							$('.'+$(this).attr('data-group')).css('display','none');
						}else{
							if($(this).find('input[type=radio]').length > 0){
								checkRadio($(this).find('input[type=radio]'));
							}else if($(this).find('select').length > 0){
								checkEnableSelect($(this).find('select'),true,0);
							}else{
								checkboxCheck($(this).find('.penguin-checkbox'));
							}
						}
					});
				}
				
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
				
				// check select and penguin check type element
				function checkEnableSelect(element, bool, index){
					if(bool){
						index = $(element).get(0).selectedIndex;
					}
					var group = $(element).parent().parent().attr('data-group');
					if(group && group != ''){
						$('.'+group).css('display','none');
						var items = String($(element).parent().parent().attr('data-id')).split(':');
						for(var i=0;i<items.length;i++){
							var info = items[i].split('-');
							if(index == parseInt(info[0]) && String(info[1]) != ''){
								$('.'+String(info[1])).css('display','inline-block');
							}
						}
					}
				}
				
				// check penguin check box
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
		//	penguin custom fileds
		// ---------------------------------------
		customFields:{init:function(){
				penguin.checkElement(".penguin-custom-fileds",backCustomFields);
				function backCustomFields(params){
					
					var citems = $(params).find('.penguin-custom-element');

					$(params).find('.penguin-custom-btns .penguin-add-button').click(function() {
						var fields 		= $(params).find('.penguin-custom-element-filed-name');
						var add_html	=	'<ul class="penguin-custom-element">';
						for(var i=0;i<fields.length; i++){
							add_html += '<li class="penguin-custom-element-filed"><input type="text"></li>';
						}
						add_html += '<li class="penguin-custom-element-filed-btn"><a class="penguin-input-button penguin-delete-button" href="#"><i class="fa fa-minus"></i></a></li></ul>';
						$(params).find('.penguin-custom-elements').append(add_html);
						citems = $(params).find('.penguin-custom-element');
						addRemoveItemEvent(citems[citems.length - 1]);
						refreshContent();
                        return false;
                    });
					
					$(params).find('.penguin-custom-btns .penguin-delete-button').click(function() {
						if(citems.length == 0){return false;}
						for(var i=0;i<citems.length;i++){
							$(citems[i]).remove();
						}
						citems = Array();
						refreshContent();
                        return false;
                    });
					
					$(citems).each(function() {
                       addRemoveItemEvent($(this));
                    });
					
					function addRemoveItemEvent(element){
						 $(element).find('.penguin-delete-button').click(function() {
                            $(this).parent().parent().remove();
							citems = $(params).find('.penguin-custom-element');
							refreshContent();
							return false;
                        });
						$(element).find('input').change(function() {
                            refreshContent();
                        });
					}
					
					// update textarea content
					function refreshContent(){
						var out_html = '';
						var count_i = 0;
						for(var i = 0;i<citems.length;i++){
							var elements = $(citems[i]).find('.penguin-custom-element-filed');
							if($(elements).length == 0 || $(elements[0]).find('input').attr('value') == ''){	continue;}
							
							if(count_i > 0) {	out_html += '{|}';	}
							
							for(var j = 0;j<elements.length;j++){
								if(j > 0) {	out_html += '[|]';	}
								out_html += $(elements[j]).find('input').attr('value');
							}
							count_i++;
						}
						$(params).find('.penguin-custom-fileds-textarea').val(out_html);
					}
					
				}
			}
		},
		// ---------------------------------------
		//	penguin template check
		// ---------------------------------------
		templateOptions:{init:function(){
			
			// enable template show element
			$('#page_template').change(function() {
				checkTemplate(this);
			});
			
			function checkTemplate(element){
				if($(element).length > 0 && $(element).val().length > 0){
					var str = $(element).val();
					str = str.substr(0,str.length-4);
					
					$('.penguin-check').css('display','none');
					$('.penguin-template-'+str).css('display','inline-block');

					//check again enabled element
					penguin.enabledEffect.init(false);
				}
			}
			
			checkTemplate($('#page_template'));
		}},
		// ---------------------------------------
		//	penguin post format check
		// ---------------------------------------
		postFormatOptions:{init:function(){
			
			// enable post format show element
			$('#post-formats-select input').change(function() {
				checkFormat();
			});
			
			function checkFormat(){
				var items = $('#post-formats-select input');
				
				for(var i=0;i<items.length;i++){
					if($(items[i]).attr('checked') == "checked"){
						$('.penguin-postformat').css('display','none');
						$('.penguin-postformat-'+$(items[i]).attr('value')).css('display','inline-block');
						break;
					}
				}

				//check again enabled element
				penguin.enabledEffect.init(false);
			}
			
			checkFormat($('#post-formats-select'));
		}},
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
	});
	
	penguin.init();
	
});