jQuery.noConflict();

var mysiteAdmin = {
	
	init : function() {
		mysiteAdmin.optionTabs();
		mysiteAdmin.tooltipHelp();
		mysiteAdmin.footerSave();
		mysiteAdmin.resetConfirm();
		mysiteAdmin.optionSave();
		mysiteAdmin.saveSidebar();
		mysiteAdmin.sidebarDelete();
		mysiteAdmin.layoutSelect();
		mysiteAdmin.multiDropdown();
		mysiteAdmin.optionToggle();
		mysiteAdmin.optionsToggleSlide();
		mysiteAdmin.wpMedia();
		mysiteAdmin.colorPicker();
		mysiteAdmin.sliderResponsiveOptionSet();
		
		mysiteAdmin.cloneContactForm();
		mysiteAdmin.deleteContactForm();
		mysiteAdmin.responderContactForm();
		
		mysiteAdmin.menuAdd();
		mysiteAdmin.menuEdit();
		mysiteAdmin.menuCancel();
		mysiteAdmin.menuDelete();
		
		mysiteAdmin.shortcodeSelect();
		mysiteAdmin.shortcodeMultiply();
		mysiteAdmin.shortcodeInsert();
		
		mysiteAdmin.skinActivate();
		mysiteAdmin.skinGenOptions();
	},
	
	ajaxSubmit : function(postData) {
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			data: postData,
			beforeSend: function(x) {
		        if(x && x.overrideMimeType) {
		            x.overrideMimeType('application/json;charset=UTF-8');
		        }
		    },
			success: function(data) {
				mysiteAdmin.processJson(data);
			}
		});
	},
	
	optionSave : function() {
		jQuery('form#mysite_admin_form').submit(function(e){
			
			if(jQuery('#import_options')[0].value.length>20) {
				jQuery('form#mysite_admin_form').prepend( jQuery("<input>", { type: "hidden", name:"mysite_import_options", val: true }) );
				return true;
			}
			
			if(jQuery('#mysite_full_submit').val() == 1){
				
				return true;
				
			} else {
				
				jQuery('#ajax-feedback').css({display:'block'});

				tinyMCE.triggerSave();

				var formData = jQuery(this),
					optionSave = jQuery("<input>", { type: "text", name:"mysite_option_save", val: true }),
					postData = formData.add(optionSave).serialize();

				mysiteAdmin.ajaxSubmit(postData);

				e.preventDefault();
			}
		});
	},
	
	resetConfirm : function () {
		jQuery('.mysite_reset_button').click(function(e){
			if (confirm(objectL10n.resetConfirm)){
				jQuery('#mysite_full_submit').val(1);
			} else {
				e.preventDefault();
			}
		});
	},
	
	processJson : function(data) {

		if(data.success == 'saved_sidebar')
		{
			mysiteAdmin.addSidebar(data);
		}

		if(data.success == 'deleted_sidebar')
		{
			mysiteAdmin.deleteSidebar(data);
		}

		if(data.success == 'options_saved')
		{
			mysiteAdmin.menuRefresh();
		}
				
		if(data.success == 'skin_saved')
		{
			mysiteAdmin.skinSaved(data);
		}

		if(data.success == 'skin_edit')
		{
			mysiteAdmin.skinCreateAjaxOutput(data);
			return;
		}
		
		if(data.success == 'skin_manage')
		{
			mysiteAdmin.skinManageAjaxOutput(data);
			return;
		}
		
		if(data.success == 'skin_advanced')
		{
			mysiteAdmin.skinAdvancedAjaxOutput(data);
			return;
		}
		
		if(jQuery.browser.safari){ bodyelem = jQuery('body') } else { bodyelem = jQuery('html') }
		  bodyelem.animate({
		    scrollTop:0
		  }, 'fast', function() {
			
			jQuery('#message').empty();
			
			var el = jQuery('#message').append(data.message),
			    timer = ( data.image_error ) ? 15000 : 3000;
			
			el.fadeIn();

			jQuery('#ajax-feedback').fadeOut('fast');
			jQuery('.ajax_feedback_activate_skin').fadeOut('fast');
			jQuery('.ajax_feedback_save_skin').css('display','none');
			jQuery('.cancel_skin_edit').parent().css('display','inline-block');

			el.queue(function(){
			  setTimeout(function(){
			    el.dequeue();
			  }, timer ); 
			}); 
			el.fadeOut();
			
		});
	},
	
	footerSave : function(field) {
		jQuery('.mysite_footer_submit').click(function(e){
			if(jQuery('#import_options')[0].value.length>20) { 
				jQuery('form#mysite_admin_form').prepend( jQuery("<input>", { type: "hidden", name:"mysite_import_options", val: true }) );
				return true;
			}
			
		if(jQuery.browser.safari){ bodyelem = jQuery('body') } else { bodyelem = jQuery('html') }
		  bodyelem.animate({
		    scrollTop:0
		  }, 'fast', function() {
			jQuery('form#mysite_admin_form').submit();
		  });
		e.preventDefault();
		});
	},
	
	optionTabs : function() {
		var windowHash = window.location.hash;
		if( windowHash != '' ){
			jQuery('.mysite_tab').css('display','none');
			jQuery(windowHash).css('display','block');
			jQuery('a[href="' + windowHash + '"]').parent().addClass('current');
		}else{
			jQuery('.mysite_tab').css('display','none');
			jQuery('.mysite_tab:first').css('display','block');
			jQuery('#mysite_admin_tabs li:first').addClass('current');
		}

		jQuery('#mysite_admin_tabs li a').click(function(e){
		
			jQuery('#mysite_admin_tabs li').removeClass('current');
			jQuery(this).parent().addClass('current');
		
			var clicked_tab = jQuery(this).attr('href');

			jQuery('.mysite_tab').css('display','none');
		
			jQuery(clicked_tab).css('display','block');
			
			if(clicked_tab == '#mysite_skins_tab'){
				jQuery('.mysite_admin_save').css('display','none');
				jQuery('.mysite_reset_button').css('display','none');
				jQuery('.mysite_footer_submit').css('display','none');
			} else {
				jQuery('.mysite_admin_save').css('display','block');
				jQuery('.mysite_reset_button').css('display','inline');
				jQuery('.mysite_footer_submit').css('display','inline');
			}

			e.preventDefault();
		});
	},
	
	layoutSelect : function() {
		var el = jQuery('.layout_option_set');
		
		el.each(function(){
			var _this = jQuery(this),
			    _input = _this.find(':input');
			
			jQuery(_this).find('a').each(function(){
				if(jQuery(this).attr('rel')==_input.val()){
					jQuery(this).addClass('selected');
				}
				
				jQuery(this).click(function(e){
					if(jQuery(this).hasClass('selected')){
						jQuery(this).removeClass('selected');
						jQuery(_input).val('');
					} else {
						jQuery(_input).val(jQuery(this).attr('rel'));
						jQuery(_this).find('.selected').removeClass('selected');
						jQuery(this).addClass('selected');
					}

					e.preventDefault();
				});
				
			});
			
		});
	},
	
	multiDropdown : function() {
		var el = jQuery(".multidropdown");

		el.each(function() {
			var _this = jQuery(this),
			    selects = jQuery(this).children('select'),
			    name = jQuery(this).attr("id");
			
			selects.each(function(i) {
				if(jQuery(this).val() != ''){
						jQuery(this).attr('id', name + '['+i+']');
						jQuery(this).attr('name', name + '['+i+']');
				}
				
				jQuery(this).unbind('change').bind('change',function() {
					if (jQuery(this).val() && selects.length == i + 1) {
						jQuery(this).clone().val("").appendTo(_this);
					} else if (!(jQuery(this).val())
							&& !(selects.length == i + 1)) {
						jQuery(this).remove();
					}
					mysiteAdmin.multiDropdown();
				});

			})

		})
	},
	
	clearSliderHeight : function() {
		jQuery('#mysite_slideshow_tab').css({height: ''});
	},
	
	refreshSliderHeight : function() {
		jQuery('#mysite_slideshow_tab').css({
		      height: function(index, value) {
		        return parseFloat(value);
		      }
		});
	},
	
	refreshMenuKeys : function (_this) {
		var _this = _this,
		    addKeys = new Array;
		
		sliderIDs = _this.find('li')
		sliderIDs.each(function(i) {
			var thisID = jQuery(this).attr('id').match(/\d+/g);
			addKeys.push(thisID);
		});
		addKeys.push('#');
		_this.parent().find('.menu-keys').val(addKeys.toString());
	},
	
	menuAdd : function() {
		jQuery('.mysite_add_menu').live('click', function(e){
			
			mysiteAdmin.clearSliderHeight();

			var _this = jQuery(this).parent().parent(),
				 append = _this.find('.menu-to-edit'),
				 menuItem = _this.find('.sample-to-edit li'),
				 menuEdit = append.find('li'),
				 count = menuEdit.length,
				 allIds = new Array;
			
			menuEdit.each( function() {
				if(jQuery(this).attr('id')){
					menuEditId = jQuery(this).attr('id').match(/\d+/g);
					if(menuEditId){
						allIds.push(parseInt(menuEditId));
					}
				}
			});
			
			var newID = ( jQuery(append).css('display') == 'none' )? count : count+1,
			    template = menuItem;
			
			while (jQuery.inArray(newID, allIds) != -1 ) {
				newID++;
			}
			
			var newClone = template.clone()

				.attr('id',template.attr('id').replace('#',newID))
				.find('*').each( function() {

					if( jQuery(this).hasClass('item-title') ) {
						var newTitle = jQuery(this).text().replace(/\d+/g,newID);
						jQuery(this).text(newTitle);
					}

					var attrId = jQuery(this).attr('id');
					if (attrId) jQuery(this).attr('id', attrId.replace('#',newID));

					var attrHref = jQuery(this).attr('href');
					if (attrHref) jQuery(this).attr('href', attrHref.replace('#',newID));

					var attrFor = jQuery(this).attr('for');
					if (attrFor) jQuery(this).attr('for', attrFor.replace('#',newID));

					var attrName = jQuery(this).attr('name');
					if (attrName) jQuery(this).attr('name', attrName.replace('#',newID));

				}).end();

			var newAppend = jQuery(append).append(function(index, html) {
				if( jQuery(this).css('display') == 'none' ){
					jQuery(_this).find('.menu_clear').css('display','block');
					jQuery(this).empty();
					jQuery(this).css('display','block');
				}
				
				return newClone;
			});

			if(newAppend) {
				mysiteAdmin.clearSliderHeight();
				
				var _regex = new RegExp( "(.*)menu-item-settings-" + newID, "i"),
				    _match,
				    _item;
				
				append.find('li').children().filter(function() {
				    _find = this.id.match(_regex);
					if(_find){
						_match = _find;
					}
				});
				
				if(_match){
					_item = jQuery('#'+_match[0]).parent();
					
					jQuery('#'+_match[0]).slideToggle('fast', function() {
					    mysiteAdmin.refreshSliderHeight();
					});

					if(_item.hasClass('menu-item-edit-inactive')){
						_item.removeClass('menu-item-edit-inactive');
						_item.addClass('menu-item-edit-active');
					}else{
						_item.removeClass('menu-item-edit-active');
						_item.addClass('menu-item-edit-inactive');
					}
				}

				mysiteAdmin.refreshMenuKeys(append);			
			}

			e.preventDefault();
		});
	},
	
	menuSort : function() {
		jQuery(".menu-to-edit").sortable({
			handle: '.menu-item-handle',
			placeholder: 'sortable-placeholder',

			start: function() {
				jQuery('#wpwrap').css('overflow','hidden');
			},
			update: function(event, ui) {
				_this = jQuery(this);
				mysiteAdmin.refreshMenuKeys(_this);
			}
			
		});
	},
	
	menuEdit : function() {
		jQuery('.item-edit').live( 'click', function(e) {
			
			jQuery.fx.off = false;

			mysiteAdmin.clearSliderHeight();

			var settings = jQuery(this).attr('href');
			var item = jQuery('#'+settings).parent();
			
			jQuery('#'+settings).slideToggle('fast', function() {
			    mysiteAdmin.refreshSliderHeight();
			});

			if(item.hasClass('menu-item-edit-inactive')){
				item.removeClass('menu-item-edit-inactive');
				item.addClass('menu-item-edit-active');
			}else{
				item.removeClass('menu-item-edit-active');
				item.addClass('menu-item-edit-inactive');
			}
			
			e.preventDefault();
		});
	},
	
	menuCancel : function() {
		jQuery('.slider_cancel').live( 'click', function(e) {
			
			mysiteAdmin.clearSliderHeight();

			var settings = jQuery(this).attr('href');
			var item = jQuery('#'+settings).parent();
			
			jQuery('#'+settings).slideToggle('fast', function() {
			    mysiteAdmin.refreshSliderHeight();
			});

			if(item.hasClass('menu-item-edit-inactive')){
				item.removeClass('menu-item-edit-inactive');
				item.addClass('menu-item-edit-active');
			}else{
				item.removeClass('menu-item-edit-active');
				item.addClass('menu-item-edit-inactive');
			}

			e.preventDefault();
		});
	},
	
	menuDelete : function() {
		jQuery('.slider_deletion').live( 'click', function(e) {
			
			var _this = jQuery(this).parent().parent().parent().parent();
			
			var sliderRM = jQuery(this).attr('id').replace('delete-','');
			var el = _this.find('#'+sliderRM);

			el.addClass('deleting').animate({
					opacity : 0,
					height: 0
				}, 350, function() {
					el.remove();
					mysiteAdmin.refreshMenuKeys(_this);
					mysiteAdmin.clearSliderHeight();
					if(jQuery(_this).is(':empty')){
						jQuery(_this).parent().find('.menu_clear').css('display','none');
						jQuery(_this).css('display','none');
					}
				});

			e.preventDefault();
		});
	},
	
	menuRefresh : function() {
		jQuery('.slideshow_option_set').find('li').each(function(i) {
				var newID = i+1;
				jQuery(this).find('.item-title').text('Slideshow '+newID);
		});
		
		jQuery('.sociable_option_set select option:selected').each(function(i) {
			icon = jQuery(this).parent().attr('id').match(/edit-menu-sociable-icon-([0-9]+)/);
			if( icon ) {
				custom = jQuery(this).parent().parent().parent().parent().children().eq(2).find('input').val();
				if( custom ) {
					j = (i/2)+1;
					jQuery(this).parent().parent().parent().parent().parent().find('.item-title').text('Sociable '+j);
				} else {
					_text = jQuery(this).text();
					jQuery(this).parent().parent().parent().parent().parent().find('.item-title').text(_text);
				}
			}
		});
	},
	
	optionToggle : function() {
		var toggle = jQuery('.toggle_true'),
		    val;

		toggle.each(function() {

			if(jQuery(this).is('select')){
				val = jQuery(this).val();
			}else{
				_this = jQuery(this);
				chk = _this.attr('checked');

				if(chk){
					val = jQuery(this).val();
				}
			}

			var nameMatch = jQuery(this).attr('name').match(/\[[^\]]*/),
				_name = ( nameMatch )? nameMatch[0].replace( '[', '') : jQuery(this).attr('name'),
				//el = jQuery('*[class^="'+_name+'_"]'),
				el = jQuery('*[class*="'+_name+'_"]'),
			    attrID = _name + '_' +val;

			el.each(function() {
				
				var togglePrime = jQuery(this).attr('class').match(/toggle_prime_([\w-]*)/),
					toggleSub = jQuery(this).attr('class').match(/toggle_sub_([\w-]*)/);
				
				if(jQuery(this).hasClass(attrID)){
					jQuery(this).css({display:"block"});
				}else{
					jQuery(this).css({display:"none"});
				}
				
				if(jQuery(this).hasClass(attrID) && togglePrime && toggleSub) {
					var toggleSubPrime = jQuery(this).hasClass( togglePrime[1]+ '_' +jQuery('#'+ togglePrime[1]).val()),
						toggleSubVal = jQuery(this).hasClass( toggleSub[1]+ '_' +jQuery('#'+ toggleSub[1]).val());
						
					if(toggleSubPrime && toggleSubVal){
						jQuery(this).css({display:"block"});
					}else{
						jQuery(this).css({display:"none"});
					}
				}
			});

			jQuery(this).change(function() {
				var _id = jQuery(this).attr('id');
				
				if(_id == 'slider_custom_1' || _id == 'slider_custom_2' || _id == 'homepage_slider') {
					mysiteAdmin.clearSliderHeight();
				}
				
				var nameMatch = jQuery(this).attr('name').match(/\[[^\]]*/),
					_name = ( nameMatch )? nameMatch[0].replace( '[', '') : jQuery(this).attr('name'),
				    attrID = _name + '_' +jQuery(this).val();
				
				
				el.each(function() {
					
					var _regex = new RegExp( attrID, "i"),
						_match = jQuery(this).attr('class').match(_regex),
						_index = (_match) ? _match.index : '',
						toggleSub = jQuery(this).attr('class').match(/toggle_sub_([\w-]*)/);
						
					if(jQuery(this).hasClass(attrID)){
						jQuery(this).css({display:'block'});
					}else{
						jQuery(this).css({display:'none'});
					}
					
					if(jQuery(this).hasClass(attrID) && toggleSub){
						if(jQuery(this).hasClass( toggleSub[1]+ '_' +jQuery('#'+ toggleSub[1]).val())){
							jQuery(this).css({display:'block'});
						}else{
							jQuery(this).css({display:'none'});
						}
					}
				});

				if(_id == 'slider_custom_1') {
					mysiteAdmin.refreshSliderHeight();
				}
				
			});

		});
	},
	
	optionsToggleSlide : function() {
		
		jQuery('.option_toggle a').click(function(e){
			
			var val = '',
			    isSlider = ( jQuery(this).parent().hasClass('slider_option_toggle') ) ? true : false; 
			
			if( jQuery(this).find('span').text() == '[+]' ){
				jQuery(this).find('span').text('[-]');
			} else {
				jQuery(this).find('span').text('[+]');
			}
			
			if( isSlider ) {
				var slider = jQuery('*[id^="slider_custom_"]'),
				    val;

				slider.each(function() {
					_this = jQuery(this);
					chk = _this.attr('checked');
					if( chk == true){
						val = jQuery(this).val();
					}
				});

				mysiteAdmin.clearSliderHeight();
			}
			
			jQuery.fx.off = true;
			jQuery(this).parent().toggleClass('active').next().toggle('fast', function() {
				jQuery.fx.off = true;
				
				if( isSlider ) {
					mysiteAdmin.refreshSliderHeight();
				}
				
			});
			jQuery.fx.off = false;
			e.preventDefault();
		});
	},
	
	wpMedia : function() {
		var header_clicked = false,
			icon_clicked = false,
		    fileInput = '';

		// Frameworks upload button
		jQuery('.upload_button').live("click", function(e) {
			
			if(jQuery(this).prev()[0].type == 'button') {
				fileInput = jQuery(this).prev().prev('input');
			} else {
				fileInput = jQuery(this).prev('input');
			}
			
			tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;mysite_upload_button=1&amp;TB_iframe=true');

			header_clicked = true;
			
			e.preventDefault();
		});
		
		
		// Icon "Select Preset" button
		jQuery('.icon_preset_button').click(function(e){
			var iconShortcode = jQuery(this).attr('data-type');

			tb_show(objectL10n.iconTbTitle, mysiteAjaxUrl+"/icons.php?height=300&amp;width=300&amp;shortcode="+iconShortcode+"&amp;TB_iframe=true");
			jQuery(this).attr('id', 'current_icon_type');
			
			icon_clicked = true;

			e.preventDefault();
		});

		// Store original function
		window.original_send_to_editor = window.send_to_editor;
		window.original_tb_remove = window.tb_remove;

		// Override removing function (resets our boolean)
		window.tb_remove = function() {
			
			if(header_clicked && mysiteWpVersion>='3.3') {
				deleteUserSetting('uploader');
				jQuery('.media-upload-form').removeClass('html-uploader');
			}
			
			if(icon_clicked){
				jQuery('.icon_preset_button').attr('id', '');
			}
			
			header_clicked = false;
			icon_clicked = false;
			window.original_tb_remove();
		}

		// Override send_to_editor function from original script
		// Writes URL into the textbox.
		// Note: If header is not clicked, we use the original function.
		window.send_to_editor = function(html) {
			if (header_clicked) {
				imgurl = jQuery(html).attr('src');
				fileInput.val(imgurl);
				if(mysiteWpVersion>='3.3') {
					deleteUserSetting('uploader');
					jQuery('.media-upload-form').removeClass('html-uploader');
				}
				tb_remove();
			} else {
				window.original_send_to_editor(html);
			}
		};
	},
	
	fixField : function(field) {
		str = jQuery(field).val();
		jQuery(field).val(str.replace(/[^a-zA-Z_0-9]+/ig,''));
	},
	
	saveSidebar : function() {
		jQuery('.mysite_add_sidebar').click(function(e){
			
			if( !jQuery("#custom_sidebars").val() ){
				alert(objectL10n.sidebarEmpty);
			}
			
			if( jQuery("#custom_sidebars").val() ) {
				
				jQuery('#ajax-feedback').css({display:'block'});
				
				var _this = jQuery('#sidebar-to-edit'),
				    sidebarEdit = _this.find('li'),
				    count = sidebarEdit.length,
				    newID = ( _this.css('display') == 'none' )? count : count+1,
				    allIds = new Array;
				
				sidebarEdit.each( function() {
					if(jQuery(this).attr('id')){
						sidebarEditId = jQuery(this).attr('id').match(/\d+/g);
						if(sidebarEditId){
							allIds.push(parseInt(sidebarEditId));
						}
					}
				});

				while (jQuery.inArray(newID, allIds) != -1 ) {
					newID++;
				}
				
				var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
					allInputs = jQuery("#custom_sidebars"),
					action = jQuery('input[name=action]'),
					sidebarAction = jQuery('<input>', { type: 'text', name:'mysite_sidebar_save', val: true }),
					sidebarId = jQuery('<input>', { type: 'text', name:'mysite_sidebar_id', val: newID }),
					postData = _wpNonce.add(allInputs).add(action).add(sidebarAction).add(sidebarId).serialize();

				mysiteAdmin.ajaxSubmit(postData);
			}

			e.preventDefault();
		});
	},
	
	addSidebar : function(data) {		
		var _this = jQuery('#sidebar-to-edit'),
			menuItem = jQuery('#sample-sidebar-item li'),
			template;
			
		if( jQuery(_this).css('display') == 'none' ){
			jQuery(_this).parent().find('.menu_clear').css('display','block');
			jQuery(_this).empty();
			jQuery(_this).css('display','block');
		}
						
		template = menuItem;

		template.clone()
			.attr('id',template.attr('id').replace(':',data.sidebar_id))

			.find('*').each( function() {
				jQuery(this).find('.sidebar-title').text(data.sidebar);

				var attrId = jQuery(this).attr('rel');
				if (attrId) jQuery(this).attr('rel', attrId.replace(':',data.sidebar_id));

			}).end()
			.appendTo(jQuery('#sidebar-to-edit'));

		jQuery('input[name=sidebar_action]').val('');
		jQuery('#custom_sidebars').val('');
	},
	
	sidebarDelete : function() {
		jQuery('.delete_sidebar').live( 'click', function(e) {

			if (confirm(objectL10n.sidebarDelete)) {
				
				jQuery('#ajax-feedback').css({display:'block'});

				var sidebar = jQuery(this).attr('rel'),
					sidebarId = sidebar.match(/\d+/g);
					sidebarDelete = jQuery('#' +sidebar).find('.sidebar-title').text();
					
				var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
					allInputs = jQuery('<input>', { type: 'text', name:'mysite_sidebar_delete', val: sidebarDelete }),
					sidebarRm = jQuery('<input>', { type: 'text', name:'sidebar_id', val: parseInt(sidebarId) }),
					action = jQuery('input[name=action]'),
					postData = _wpNonce.add(allInputs).add(sidebarRm).add(action).serialize();

				mysiteAdmin.ajaxSubmit(postData);

				e.preventDefault();

			} else {

				e.preventDefault();
			}

		});
	},
	
	deleteSidebar : function(data) {
		var el = jQuery('#sidebar-item-' +data.sidebar_id);

		el.addClass('deleting').animate({
				opacity : 0,
				height: 0
			}, 350, function() {
				el.remove();
				_this = jQuery('#sidebar-to-edit');

				if(jQuery(_this).is(':empty')){
					jQuery(_this).parent().find('.menu_clear').css('display','none');
					jQuery(_this).css('display','none');
				}
			});
	},
	
	tooltipHelp : function() {
		jQuery('.mysite_option_help a').click(function(e){
			e.preventDefault();
		});
		
		jQuery('.mysite_option_help a').live('mouseover',function(){
		   if (!jQuery(this).hasClass("tooledUp")){
		      jQuery(this).tooltip({ delay: 150, predelay: 0, effect: 'slide', relative: true, direction: 'left', offset: [-4, -138], opacity: 0.9, relative: true, tipClass: 'mysite_help_tooltip' });
		      jQuery(this).tooltip().show();
		      jQuery(this).addClass("tooledUp");
		      }
		});
	},
	
	colorPicker : function() {
		jQuery('[id*=_picker]').each(function(i){
			var _this = jQuery(this),
			    _color = _this.next('input');
			
			jQuery(_this).children('div').css('backgroundColor', _color.val());
			jQuery(_color).keyup(function(event) { 
				var s = jQuery(this).val();
				var sub1 = s.substr(0, 1),
				    sub2 = s.substr(0, 2);
				if( (sub1 != '#' && sub1 != 'i' && sub1 != 't' && sub1 != 'r') && (sub2) ){
					jQuery(this).val('#'+sub1);
				}
				jQuery(_this).children('div').css('backgroundColor', jQuery(this).val());
			});
			
			jQuery(_this).ColorPicker({
				color: _color.val(),
				onShow: function (colpkr) {
					jQuery(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					jQuery(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					jQuery(_this).children('div').css('backgroundColor', '#' + hex);
					jQuery(_this).next('input').attr('value','#' + hex);
				}
			});
		}); //end each
	},
	
	/**
	 * Contact form functions
	 */
	cloneContactForm : function() {
		jQuery('#multiply_contactform').click(function(e){

			_this = jQuery(this).parent();
			el = _this.parent().parent().children(':visible');
			count = el.length;

			_clone = 'clone_' + _this.children().eq(0).val();
			var newClone = jQuery('.'+_clone).clone().find('*').each( function(){

				var attrId = jQuery(this).attr('id');
				if (attrId) jQuery(this).attr('id', attrId.replace('#',count));

				var attrName = jQuery(this).attr('name');
				if (attrName) jQuery(this).attr('name', attrName.replace('#',count));

				var attrFor = jQuery(this).attr('for');
				if (attrFor) jQuery(this).attr('for', attrFor.replace('#',count));

			}).end()
			.appendTo('.contactform_toggle_container').css('display', 'block')
			.removeClass(_clone).removeClass('contactform_clone').addClass('contact_form_custom');

			e.preventDefault();
		});
	},
	
	deleteContactForm : function() {
		jQuery('.contactform_field_deletion').live( 'click', function(){
			jQuery(this).parent().parent().remove()
			return false;
		});
	},
	
	responderContactForm : function() {
		var delay = (function(){
		  var timer = 0;
		  return function(callback, ms){
		    clearTimeout (timer);
		    timer = setTimeout(callback, ms);
		  };
		})();

		jQuery(':input').live('keyup', function(e){
		    delay(function(){
				var tags = new Array();
				_this = jQuery('#shortcode_contactform');
				_this.find(':input').each( function() {
					_id = jQuery(this).attr('id');
					if(_id){
						if( (_id.match(/\bsc-contactform-label/)) && (jQuery(this).val()) ){
							tags.push('%' + jQuery(this).val() + '%')
						}
					}
				});
				_this.find('.contactform_available_tags span').html( '%return%&nbsp;&nbsp;&nbsp;&nbsp;' + tags.join('&nbsp;&nbsp;&nbsp;&nbsp;'));
		    }, 500 );
		});
	},
	
	
	/**
	 * Shorcodes functions
	 */
	shortcodeSelect : function() {
		jQuery('.shortcode_selector select').val('');
		jQuery('.shortcode_type_selector select').val('');
		
		jQuery('.shortcode_selector select').change(function(){
			var selected = 'shortcode_'+jQuery(this).val();
			
			jQuery('.shortcode_wrap').each(function(){
				var el = jQuery(this),
				    _id = el.attr('id');
				
				if ( _id == selected ) {
					jQuery(this).children().each(function(){
						var _class = jQuery(this).attr('class');
						if( ( _class != 'shortcode_type_selector' ) && ( el.hasClass( 'shortcode_has_types' ) ) ) {
							jQuery(this).css({display: 'none'});
						}
					});
					jQuery(this).css({display: 'block'}).addClass('shortcode_selected');
				} else {
					jQuery(this).css({display: 'none'}).removeClass('shortcode_selected');
				}
			});
			
			var val = jQuery('#'+selected).find('.shortcode_type_selector select').val();
			if( val ) {
				jQuery('.shortcode_atts_'+val).css({display: 'block'});
			}
			
		});
		
		
		jQuery('.shortcode_wrap').each(function(){
			var el = jQuery(this);
			var selector = el.find('.shortcode_type_selector select');
			
			selector.change(function(){
				var val = 'shortcode_atts_'+jQuery(this).val()
				
				el.children().each(function(){
					var _this = jQuery(this);
					if( ( _this.hasClass( val ) ) ){ 
						_this.css({display: 'block'});
					} else {
						if ( !_this.hasClass( 'shortcode_type_selector' ) ){
							_this.css({display: 'none'});
						}
					}
				});
			});
		});
	},
	
	shortcodeMultiply : function() {
		jQuery('.shortcode_selected .shortcode_multiplier select').live('change', function(){
			
			var _html = new Array(),
			    cloneCount = jQuery(this).val(),
				 _id;
			
			jQuery('.shortcode_selected').each(function(){
				_id = jQuery(this).attr('id');
				
				jQuery(this).children().each(function(){
					var _this = jQuery(this);
					
					if( ( _this.is(':visible') ) && ( !_this.hasClass( 'shortcode_type_selector' ) ) && ( !_this.hasClass( 'shortcode_multiplier' ) ) && ( !_this.hasClass( 'shortcode_dont_multiply' ) ) ) {
						if( !_this.hasClass( 'clone' ) ) {
							_html.push(_this.addClass( 'clone' ).clone());
							_this.removeClass( 'clone' );
						}
						if( _this.hasClass( 'clone' ) ) {
							_this.remove();
						}
					}
				});
			});
			
			var i=0;
				while ( i<cloneCount ) {
					for ( j in _html ) {
						var newClone = _html[j].clone().find('*').each( function() {
							var titleReplace = jQuery(this).hasClass('mysite_option_header');
							if( titleReplace ) {
								text = jQuery(this).html();
								text = text.replace('1', i+2);
								jQuery(this).html(text);
							}
						}).end();
						jQuery('#' + _id).append(newClone);
					}
				  i++;
				 }
			});
	},
	
	shortcodeInsert : function() {
		jQuery('#shortcode_send').click(function(){
			
			var scSelected = jQuery('.shortcode_selected'),
			    _val = ( scSelected.find('.shortcode_type_selector').length ) ? scSelected.find('.shortcode_type_selector select').val() : jQuery('.shortcode_selector select').val();
			
			if( !_val )
				return false;
				
			var str = '',
				atts = '',
				_nestedVal = '';
				_nestedName = '';
				scSelectedAtts = 'shortcode_atts_'+_val,
				carriageReturn = false,
				rich = (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden(),
				_return = (rich) ? '<br />' : '\n';
			
			var shortCode = new Array(),
				optionalWrap = new Array(),
				multiDropdown = new Array(),
				chkBoxes = new Array(),
				scAtts = new Array(),
				scContent = new Array(),
				multiplyAtts = new Array();
			
			var attsCount = 0,
				contentCount = 0,
				attsMultiplyCount = 0,
				contentMultiplyCount = 0;
			
			jQuery('.'+scSelectedAtts).each(function(i){
				_this = jQuery(this);
				_input = _this.find('.mysite_option :input');
				_nestedVal = scSelected.find('input[type=hidden]').val();
				_nestedName = scSelected.find('input[type=hidden]').attr('name');
				if(_nestedName){
					_nestedName = _nestedName.match(/sc_nested_(.*)/);
				}
				
				// standard shortcodes
				if( (!_this.hasClass('shortcode_multiplier')) && (!_this.hasClass('shortcode_multiply')) ){
					
					if(_this.hasClass('shortcode_carriage_return')){
						carriageReturn = true;
					}
					
					atts = _input.attr('id').match(/[^-]+/gi);
					
					// shortcode content
					if(atts[2] == 'content'){
						shortCode.push(atts[1]);
						scContent.push(_input.val());
						contentCount++;
					}
					
					// shortcode atts
					if( (atts[2] != 'content') && (_input.val()) ){
						
						// multidropdown atts
						if( _input.parent().hasClass('multidropdown') ){
							multiLength = _this.find('.mysite_option :input').length;
							_input.each(function(i){
								if(jQuery(this).val()) {
									multiDropdown.push(jQuery(this).val());
								}
								if( (i == multiLength -1) && (multiDropdown.length >0) ){
									atts = _input.parent().attr('id').match(/[^-]+/gi);
									scAtts.push(' ' + atts[2].replace(']', '') + '="' + multiDropdown.join(',') + '"');
									multiDropdown = new Array();
								}
							});
							
						} else if(_input[0].type == 'checkbox'){
							chkBoxLength = _this.find('.mysite_option :checkbox').length;
							_input.each(function(i){
								if( (jQuery(this).attr('checked')) && (!_this.hasClass('shortcode_optional_wrap')) ){
									chkBoxes.push(jQuery(this).val());
								}
								if ( (i == chkBoxLength - 1) && (chkBoxes.length >0) ){
									scAtts.push(' ' + atts[2] + '="' + chkBoxes.join(',') + '"');
									chkBoxes = new Array();
								} else {
									if(_this.hasClass('shortcode_optional_wrap')){
										optionalWrap.push(true);
										if(jQuery(this).attr('checked')){
											optionalWrap.push(atts[2]);
										}
									}
								}
							});
							
						} else if(_input[0].type == 'radio'){
							_input.each(function(i){
								if(jQuery(this).attr('checked')){
									scAtts.push(' ' + atts[2].replace(/_[0-9]*/,'') + '="' + jQuery(this).val() + '"');
								}
							});
								
						} else {
							// all other atts
							if(_input.val()){
								scAtts.push(' ' + atts[2] + '="' + _input.val() + '"');
							} else {
								scAtts.push('');
							}
						}

						attsCount++;
					}
				}
				
				// multiplied shortcode atts
				if( _nestedName || optionalWrap ){
					if( _this.hasClass('shortcode_multiply') ){
						atts = _input.attr('id').match(/[^-]+/gi);
						
						// multiplied shortcode content
						if(atts[2] == 'content'){
							shortCode.push(atts[2]);
							scContent.push(_input.val());
							contentMultiplyCount++;
						}
						
						// multiplied shortcode atts
						if(atts[2] != 'content'){
							if(_input.val()){
								multiplyAtts.push(' ' + atts[2] + '="' + _input.val() + '"');
							} else {
								multiplyAtts.push('');
							}
							attsMultiplyCount++;
						}
						
					} else {

						// contact form shortcode
						if(_val == 'contactform'){
							if( i <= 4 ) {
								if( i==0 ) str += '[' + _val;

								if( (_input[0].type == 'checkbox') ) {
									_input.each(function(i){
										_chk = jQuery(_input[i]);
										if(_chk.attr('checked')){
											atts = _chk.val().match(/[^-]+/gi);
											str += ' ' + atts[0] + '="' + atts[1] + '"';
										}
									});

								} else if ( ( _input.val() ) && ( _input[0].type != 'checkbox' ) ) {
									str += ' ' + atts[2] + '="' + _input.val() + '"';
								}

								if( i==4 )	str += ']' + _return;

							} else {

								if(!_this.hasClass('contactform_clone')){
									str += '[' + _this.find('.mysite_option_header').text().toLowerCase();
									_input.each(function(i){
										_id = jQuery(this).attr('id');
										if(_id){
											atts = _id.match(/[^-]+/gi);
											if( ( this.type == 'checkbox' ) && ( jQuery(this).attr('checked') ) ) {
												str += ' ' + atts[2] + '="' + jQuery(this).val() + '"';
											} else if ( ( jQuery(this).val() ) && ( this.type != 'checkbox' ) ) {
												str += ' ' + atts[2] + '="' + jQuery(this).val() + '"';
											}
										}
									});
									str += ']' + _return;
									contentMultiplyCount++;
								}
							}
						}
					}
					
					
				}
				
			});
			
			
			// scroll to top on shortcode send to editor
			if(jQuery.browser.safari){ bodyelem = jQuery('body') } else { bodyelem = jQuery('html') }
			  bodyelem.animate({
			    scrollTop:0
			  }, 'fast' );
			
			
			// return contact form shortcode
			if(_val == 'contactform'){
				if(contentMultiplyCount>0)
					str += '[/' + _val + ']' + _return;

				return send_to_editor(str);
			}
			
			// return nested or optionally wrapped shortcodes
			if( _nestedName || optionalWrap.length >0 ){
				for(var i in shortCode){
					attsNum = attsMultiplyCount/contentMultiplyCount;

					slice1 = attsNum*i;
					slice2 = (attsNum*i)+attsNum;
					
					if(optionalWrap.length >0){
						str += '[' + _val + multiplyAtts.slice(slice1,slice2).join('') + ']'+ scContent[i] + '[/' + _val + ']' + _return;
					} else {
						str += '[' + _nestedVal + multiplyAtts.slice(slice1,slice2).join('') + ']'+ scContent[i] + '[/' + _nestedVal + ']' + _return;
					}
				}
				
				if(optionalWrap.length >0){
					if(optionalWrap.length == 2){
						return send_to_editor('[' + optionalWrap[1] + ']' + _return + str + '[/' + optionalWrap[1] + ']' + _return);
					} else {
						return send_to_editor(str);
					}
				} else {
					return send_to_editor('[' + _val + scAtts.join('') + ']' + _return + str + '[/' + _val + ']' + _return);
				}
			}
			
			// return shortcodes with content
			if(shortCode.length >0){
				for(var i in shortCode){
					attsNum = attsCount/contentCount;

					slice1 = attsNum*i;
					slice2 = (attsNum*i)+attsNum;

					if(carriageReturn){
						str += '[' + shortCode[i] + scAtts.slice(slice1,slice2).join('') +']' + _return + scContent[i] + _return + '[/' + shortCode[i] + ']' + _return;
					} else {
						str += '[' + shortCode[i] + scAtts.slice(slice1,slice2).join('') +']' + scContent[i] + '[/' + shortCode[i] + ']' + _return;;
					}
				}
				
				return send_to_editor(str);
			}

			// return all other shortcodes
			return send_to_editor('[' + _val + scAtts.join('') + ']');
				
		});

	},
	
	/**
	 * Skin Generator functions
	 */
	skinActivate : function() {
		jQuery('#mysite_skins_tab').delegate('#mysite_activate_skin', 'click', function(e){

			jQuery('.ajax_feedback_activate_skin').css('display','inline');

			var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
				 skinAction = jQuery('<input>', { type: 'text', name:'_mysite_activate_skin', val: jQuery(this).parent().find('select').val() }),
				 postData = skinAction.add(_wpNonce).serialize();

			mysiteAdmin.ajaxSubmit(postData);

			e.preventDefault();
		});
	},
	
	skinGenOptions : function() {
		jQuery('input[name="skin_generator"]').change(function(){
			var _val = jQuery(this).val();

			if(_val == 'create'){
				mysiteAdmin.skinCreateAjaxLoad('create');
			}

			if(_val == 'manage'){
				mysiteAdmin.skinManageAjaxLoad();
			}
		});
	},
	
	skinCreateAjaxLoad : function(stylesheet) {
		jQuery('.skin_generator_option_set').remove();
		jQuery('#ajax_feedback_skin_loader').css( 'display', 'block' );
		
		var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
		    loadType = jQuery('input[name=skin_generator]'),
			styleSheet = jQuery('<input>', { type: 'text', name:'_mysite_skin_ajax_load', val: stylesheet }),
		    postData = _wpNonce.add(loadType).add(styleSheet).serialize();
		
		mysiteAdmin.ajaxSubmit(postData);
	},
	
	skinManageAjaxLoad : function() {
		jQuery('.skin_generator_manage').remove();
		jQuery('#ajax_feedback_skin_loader').css( 'display', 'block' );
		
		var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
		    skinAction = jQuery('<input>', { type: 'text', name:'_mysite_manage_custom_skin', val: true }),
		    postData = skinAction.add(_wpNonce).serialize();
		
		mysiteAdmin.ajaxSubmit(postData);
	},
	
	skinAdvancedAjaxLoad : function() {
		jQuery('#mysite_skins_tab').undelegate('.mysite_skin_advanced a', 'click');
		jQuery('#mysite_skins_tab').delegate('.mysite_skin_advanced a', 'click', function(e){
			jQuery('.skin_generator_manage').remove();
			jQuery('#ajax_feedback_skin_loader').css( 'display', 'block' );

			var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
				 skinAction = jQuery('<input>', { type: 'text', name:'_mysite_advanced_skin_edit', val: jQuery(this).attr('rel') }),
				 postData = skinAction.add(_wpNonce).serialize();
				
			mysiteAdmin.ajaxSubmit(postData);
				
			e.preventDefault();
		});
	},
	
	skinAdvancedAjaxOutput : function(data) {
		jQuery('#ajax_feedback_skin_loader').css( 'display', 'none' );
		jQuery(data.html).appendTo('#mysite_skins_tab');
		mysiteAdmin.cancelSkinEdit();
		mysiteAdmin.saveSkinNew();
		mysiteAdmin.saveSkinEdit();
	},
	
	skinManageAjaxOutput : function(data) {
		jQuery('#ajax_feedback_skin_loader').css( 'display', 'none' );
		jQuery(data.html).appendTo('#mysite_skins_tab');
		mysiteAdmin.optionToggle();
		mysiteAdmin.skinUploader();
		mysiteAdmin.skinManager();
		mysiteAdmin.skinDelete();
		mysiteAdmin.skinExport();
		mysiteAdmin.skinAdvancedAjaxLoad();
	},
	
	skinCreateAjaxOutput : function(data) {
		jQuery('#ajax_feedback_skin_loader').css( 'display', 'none' );
		jQuery(data.html).appendTo('#mysite_skins_tab');
		mysiteAdmin.optionToggle();
		mysiteAdmin.colorPicker();
		mysiteAdmin.cancelSkinEdit();
		mysiteAdmin.saveSkinNew();
		mysiteAdmin.saveSkinEdit();
		mysiteAdmin.customDropdowns();
		mysiteAdmin.customSelects();
		
		// option toggles
		jQuery('#mysite_skins_tab .trigger a').click(function(e){
			if( jQuery(this).find('span').text() == '[+]' ){
				jQuery(this).find('span').text('[-]');
			} else {
				jQuery(this).find('span').text('[+]');
			}
			jQuery.fx.off = true;
			jQuery(this).parent().toggleClass('active').next().toggle();
			jQuery.fx.off = false;
			e.preventDefault();
		});
	},
	
	saveSkinNew : function() {
		jQuery('#mysite_skins_tab').undelegate('.save_custom_skin', 'click');
		jQuery('#mysite_skins_tab').delegate('.save_custom_skin', 'click', function(e){

			if( !jQuery('input[name=custom_skin_name]').val() ){
				alert(objectL10n.skinEmpty);
			}

			if( jQuery('input[name=custom_skin_name]').val() ){
				
				jQuery(this).parent().parent().find('.cancel_skin_edit').parent().css('display','none');
				jQuery('.ajax_feedback_save_skin').css('display','inline-block');

				var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
					 allInputs = jQuery('#mysite_skins_tab').find(':input'),
					 skinAction = jQuery('<input>', { type: 'text', name:'_mysite_save_custom_skin', val: true }),
					 postData = skinAction.add(allInputs).add(_wpNonce).serialize();

				mysiteAdmin.ajaxSubmit(postData);
			}

			e.preventDefault();
		});
	},
	
	saveSkinEdit : function() {
		jQuery('#mysite_skins_tab').undelegate('.save_manage_skin', 'click');
		jQuery('#mysite_skins_tab').delegate('.save_manage_skin', 'click', function(e){
			
			if (confirm(objectL10n.skinOverwriteConfirm)) {
				
				jQuery(this).parent().parent().find('.cancel_skin_edit').parent().css('display','none');
				jQuery('.ajax_feedback_save_skin').css('display','inline-block');
				
				var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
					allInputs = jQuery('#mysite_skins_tab').find(':input'),
					skinAction = jQuery('<input>', { type: 'text', name:'_mysite_save_existing_skin', val: true }),
					postData = skinAction.add(allInputs).add(_wpNonce).serialize();
					
					mysiteAdmin.ajaxSubmit(postData);
			}
			
			e.preventDefault();
		});
	},
	
	skinSaved : function(data) {
		jQuery('input[name=custom_skin_name]').val('');
		
		if(data.skin_name){
			jQuery('#style_variations').prepend('<option value="' +data.skin_name+ '">' +data.skin_name+ '</option>');
		}
		
		if(jQuery('input[name=_mysite_save_manage_skin]').length >0){
			jQuery('.skin_generator_option_set').remove();
			mysiteAdmin.skinManageAjaxLoad();
		}
	},
	
	cancelSkinEdit : function() {
		jQuery('#mysite_skins_tab').undelegate('.cancel_skin_edit', 'click');
		jQuery('#mysite_skins_tab').delegate('.cancel_skin_edit', 'click', function(e){
			jQuery('.skin_generator_manage').remove();
			mysiteAdmin.skinManageAjaxLoad();
			e.preventDefault();
		});
	},
	
	skinManager : function() {
		jQuery('#mysite_skins_tab').undelegate('.mysite_skin_edit a', 'click');
		jQuery('#mysite_skins_tab').delegate('.mysite_skin_edit a', 'click', function(e){
			jQuery('.skin_generator_manage').remove();
			mysiteAdmin.skinCreateAjaxLoad(jQuery(this).attr('rel'));
			e.preventDefault();
		});
	},
		
	skinDelete : function() {
		jQuery('#mysite_skins_tab').undelegate('.mysite_skin_delete a', 'click');
		jQuery('#mysite_skins_tab').delegate('.mysite_skin_delete a', 'click', function(e){
			
			if (confirm(objectL10n.skinDeleteConfirm)) {
				
				var _this = jQuery(this),
				    _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
				    skinName = _this.attr('rel'),
					skinAction = jQuery('<input>', { type: 'text', name:'_mysite_delete_custom_skin', val: skinName }),
					postData = skinAction.add(_wpNonce).serialize();
					
				_this.parent().css('display','none');
				_this.parent().parent().find('.ajax_feedback_manage_skin').css('display','inline');
				
				jQuery.ajax({
					type: 'POST',
					dataType: 'json',
					data: postData,
					beforeSend: function(x) {
				        if(x && x.overrideMimeType) {
				            x.overrideMimeType('application/json;charset=UTF-8');
				        }
				    },
					success: function(data) {
						if(data.success){
							jQuery('#style_variations option[value="' +skinName+ '"]').remove();
							_this.parent().parent().find('.ajax_feedback_manage_skin').remove();
							_this.parent().parent().parent().css('background-color', 'red').animate({
									opacity : 0,
									height: 0
								}, 350, function() {
									_this.parent().parent().parent().remove();
								});
								
						} else {
							_this.parent().css('display','block');
							_this.parent().parent().find('.ajax_feedback_manage_skin').css('display','none');
						}
						mysiteAdmin.processJson(data);
					}

				});
			}
			
			e.preventDefault();
		});
	},
	
	skinExport : function() {
		jQuery('#mysite_skins_tab').undelegate('.mysite_skin_export a', 'click');
		jQuery('#mysite_skins_tab').delegate('.mysite_skin_export a', 'click', function(e){

			var _this = jQuery(this),
			    _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
			    skinName = _this.attr('rel'),
				skinAction = jQuery('<input>', { type: 'text', name:'_mysite_export_custom_skin', val: skinName }),
				postData = skinAction.add(_wpNonce).serialize();
				
			_this.parent().css('display','none');
			_this.parent().parent().find('.ajax_feedback_manage_skin').css('display','inline');
			
			jQuery.ajax({
				type: 'POST',
				dataType: 'json',
				data: postData,
				beforeSubmit: '',
				beforeSend: function(x) {
			        if(x && x.overrideMimeType) {
			            x.overrideMimeType('application/json;charset=UTF-8');
			        }
			    },
				success: function(data) {
					if(data.success) {
						if(data.message){
							mysiteAdmin.processJson(data);
						}
						
						//send request for download
						var inputs = '';
						inputs+='<input type="hidden" name="_mysite_download_skin" value="'+ data.zip +'" />';
						inputs+='<input type="hidden" name="_mysite_delete_skin_zip" value="'+ data.rmdir +'" />';
						inputs+='<input type="hidden" name="_mysite_skin_wpnonce" value="'+ data.wpnonce +'" />';
						jQuery('<form action="' +data.dl_skin+ '" method="post">'+inputs+'</form>')
						.appendTo('body').submit().remove();
						 
					} else {
						mysiteAdmin.processJson(data);
					}
					
					_this.parent().css('display','block');
					_this.parent().parent().find('.ajax_feedback_manage_skin').css('display','none');
				}
				
			});
			
			e.preventDefault();
		});
		
	},
	
	skinUploader : function() {
		
		if( !qq.UploadHandlerXhr.isSupported() ) {
			jQuery('.upload_limit').css('display','inline');
		}
		
		var uploader = new qq.FileUploader({
			element: jQuery('#file-uploader')[0],
			action: ajaxurl,
			params: { action: 'mysite_skin_upload' },
			sizeLimit: 50 * 1024 * 1024,
			allowedExtensions: ['zip'],
			multiple: false,
			messages: {
		        typeError: objectL10n.typeError
		    },
			template: '<div class="qq-uploader">' +
					  '<div class="qq-upload-drop-area"><span>Drop files here to upload</span></div>' +
	                  '<div class="qq-upload-button"><span class="button">Upload a Skin</span></div>' +
	                  '<ul class="qq-upload-list"></ul>' + 
	             	  '</div>',
	
			onSubmit: function(id, fileName){
				if( !qq.UploadHandlerXhr.isSupported() ) {
					jQuery('.upload_limit').css('display','none');
				}
			},
			
			onCancel: function(id, fileName){
				if( !qq.UploadHandlerXhr.isSupported() ) {
					jQuery('.upload_limit').css('display','inline');
				}
			},

			onProgress: function(id, fileName, loaded, total){
				var item = uploader._getItemByFileId(id),
				    size = uploader._find( item, 'size' );

		        qq.setText(size, objectL10n.skinUploading);
			},

			onComplete: function(id, fileName, responseJSON){
				var item = uploader._getItemByFileId(id),
				    size = uploader._find( item, 'size' );
				
				if(responseJSON.success){
					qq.setText(size, objectL10n.skinUnziping);
					jQuery(item).find('.qq-upload-size').prepend('<span class="qq-upload-spinner"></span>');

					var _wpNonce = jQuery('input[name=mysite_admin_wpnonce]'),
						 skinAction = jQuery('<input>', { type: 'text', name:'_mysite_upload_custom_skin', val: fileName }),
						 postData = skinAction.add(_wpNonce).serialize();
						
						jQuery.ajax({
							type: 'POST',
							dataType: 'json',
							data: postData,
							beforeSend: function(x) {
						        if(x && x.overrideMimeType) {
						            x.overrideMimeType('application/json;charset=UTF-8');
						        }
						    },
							success: function(data) {
								jQuery(item).remove();
								mysiteAdmin.processJson(data);
								if( !qq.UploadHandlerXhr.isSupported() ) {
									jQuery('.upload_limit').css('display','inline');
								}

								if(data.html){
									jQuery('.skin_generator_manage tbody').prepend(data.html);
									
									var names = data.skin_name;
									for(var i in names){
										var newSkin = names[i].replace(/&quot;/g, '') + '.css';
										jQuery('#style_variations').prepend('<option value="' +newSkin+ '">' +newSkin+ '</option>');
									}
									
								}
							}
						});

				} else {
					jQuery(item).remove();
					mysiteAdmin.processJson(responseJSON);
					if( !qq.UploadHandlerXhr.isSupported() ) {
						jQuery('.upload_limit').css('display','inline');
					}
				}
			}

	   });
	},
	
	customDropdowns : function() {
		/**
		 * Font Select
		 */
		var isIE = ( jQuery.browser.msie ) ? true : false;

		if( isIE ){
			jQuery('.typography_option_set .mysite_option').append('<iframe class="fontiehack" src="javascript:false;" marginwidth="0" marginheight="0" align="bottom" scrolling="no" frameborder="0" style="position:absolute; right:0; top:0px; display:block; filter:alpha(opacity=0);"></iframe><div class="font_select"></div>');
		}else{
			jQuery('.typography_option_set .mysite_option').append('<div class="font_select"></div>');
		}
		
		jQuery('.font_select').click(function(e) {
			
			if( isIE ){
				var fonts = jQuery(this).prev().prev(),
					fontImages = fonts;
			}else{
				var fonts = jQuery(this).prev(),
					fontImages = fonts.prev();
			}
				
			var fontList = fonts.find('option'),
			    fontTitle = '',
			    fontClass;
			
			if(fontImages.hasClass('font_images')){
				if(fontImages[0].style.display != 'block'){
					jQuery('.font_images').css('display','none');
					jQuery('.pattern_images').css('display','none');
					document.onclick = function() {
						document.onclick = function() {
							jQuery('.font_images').css('display','none');
							jQuery('.pattern_images').css('display','none');
							document.onclick = null;
						}
					}
				
					fontImages.css('display','block');
				}
				return;
			}
				
			fontList.each(function(){
				fontClass = this.text.replace(/ /g, '').toLowerCase();
				fontTitle += '<a title=\'' +this.value+ '\' href="#" class="single_font ' +fontClass+ '">' +this.text+ '</a>';
			});
			
			jQuery('.font_images').css('display','none');
			jQuery('.pattern_images').css('display','none');
			document.onclick = function() {
				document.onclick = function() {
					jQuery('.font_images').css('display','none');
					jQuery('.pattern_images').css('display','none');
					document.onclick = null;
				}
			}
			
			jQuery('<div class="font_images">' +fontTitle+ '</div>').insertBefore(jQuery(this).prev()).css('display','block');
			
			e.preventDefault();
		});
		
		/**
		 * Patten select
		 */
		jQuery('.preset_pattern').click(function(e) {
			var patterns  = jQuery(this).prev().prev();
			
			if(patterns[0].style.display != 'block'){
				jQuery('.font_images').css('display','none');
				jQuery('.pattern_images').css('display','none');
				document.onclick = function() {
					document.onclick = function() {
						jQuery('.font_images').css('display','none');
						jQuery('.pattern_images').css('display','none');
						document.onclick = null;
					}
				}
				
				patterns.css('display','block');
			}
			
			e.preventDefault();
		});
	},
	
	customSelects : function(e) {
		// Font select
		jQuery('.typography_option_set').delegate('.single_font', 'click', function(e){
			if(jQuery.browser.msie) {
				jQuery(this).parent().prev().val(jQuery(this).attr('title'));
			}else{
				jQuery(this).parent().next().val(jQuery(this).attr('title'));
			}
			
			jQuery('.font_images').css('display','none');
			e.preventDefault();
		});
		
		// Pattern select
		jQuery('.single_pattern').click(function(e) {
			jQuery(this).parent().next().val(jQuery(this).attr('title'));
			jQuery('.pattern_images').css('display','none');
			e.preventDefault();
		});
	},
	
	sliderResponsiveOptionSet : function() {
		var homepageSlider = jQuery('#homepage_slider');
		
		if( homepageSlider.val() == 'responsive_slider'){
			if(jQuery('#responsive_options_1').attr('checked')) {
				jQuery('#homepage_slider option').each(function(){
				    if(jQuery(this).val() != 'responsive_slider'){
						jQuery(this).wrap('<span>').hide();
					}
				});
			}
			
			mysiteAdmin.sliderOptionChange(hide=true);
			
		}else{
			
			if(!jQuery('#responsive_options_1').attr('checked')){
				jQuery('#homepage_slider option').each(function(){
				    if(jQuery(this).val() == 'responsive_slider'){
						jQuery(this).wrap('<span>').hide();
					}
				});
			}
			
			mysiteAdmin.sliderOptionChange(hide=false);
		}
		
		homepageSlider.change(function() {
			if( homepageSlider.val() == 'responsive_slider'){
				mysiteAdmin.sliderOptionChange(hide=true);
				mysiteAdmin.clearSliderHeight();
				mysiteAdmin.refreshSliderHeight();
			}else{
				mysiteAdmin.sliderOptionChange(hide=false);
				mysiteAdmin.clearSliderHeight();
				mysiteAdmin.refreshSliderHeight();
			}
		});
		
		
		responsiveOptions = jQuery('#responsive_options_1').attr('name');
		jQuery('input[name="'+responsiveOptions+'"]').change(function() {
			if(jQuery(this).attr('value') == 'site'){

				jQuery('#homepage_slider option').each(function(){
				    if(jQuery(this).val() != 'responsive_slider'){
						jQuery(this).wrap('<span>').hide();
					}else{
						jQuery(this).unwrap().show();
					}
				});
				
				jQuery('#homepage_slider').val('responsive_slider');
				mysiteAdmin.sliderOptionChange(hide=true);
				mysiteAdmin.optionToggle();
				mysiteAdmin.clearSliderHeight();
				mysiteAdmin.refreshSliderHeight();
				
			}else{
				jQuery('#homepage_slider option').each(function(){
					option = jQuery(this).parent();

				    if(option[0].nodeName.toLowerCase() === 'span'){
						jQuery(this).unwrap().show();
					}
					
					if( jQuery(this).val() == 'responsive_slider' ){
						jQuery(this).wrap('<span>').hide();
					}

				});
				
				jQuery('#homepage_slider').val('fading_slider');
				mysiteAdmin.sliderOptionChange(hide=false);
				mysiteAdmin.optionToggle();
				mysiteAdmin.clearSliderHeight();
				mysiteAdmin.refreshSliderHeight();
			}
		});
	},
	
	sliderOptionChange : function(hide) {
		if(hide){
			jQuery('*[id*=edit-menu-title]').parent().parent().css('display','none');
			jQuery('*[id*=edit-menu-stage-effect]').parent().parent().css('display','none');
			jQuery('.slideshow_option_set').find('input:checkbox').parent().parent().css('display','none');
		}else{
			jQuery('*[id*=edit-menu-title]').parent().parent().css('display','block');
			jQuery('*[id*=edit-menu-stage-effect]').parent().parent().css('display','block');
			jQuery('.slideshow_option_set').find('input:checkbox').parent().parent().css('display','block');
		}
	},
	
	strpos : function (haystack, needle, offset) {
		var i = (haystack + '').indexOf(needle, (offset || 0));
		return i === -1 ? false : i;
	},
	
	
}// end mysiteAdmin

jQuery(document).ready(function(){
	mysiteAdmin.init();	
});