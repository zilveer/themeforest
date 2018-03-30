(function($){
	
	// trigger this function to save the tabs data
	function gdlrSaveTabAction( textarea ){
		var accordion = [];
		var container = textarea.siblings('.tabs-container');
		
		container.children().each(function(){
			var item = new Object;
		
			$(this).find('[data-name]').each(function(){
				eval("item['" + $(this).attr('data-name') + "']= $(this).val()");
			});
			
			accordion.push(item);
		});
		
		textarea.val(JSON.stringify(accordion));
	}
	
	// use this function to crate the tab item
	function gdlrCreateTabItem( options ){
        var settings = $.extend({
			textarea: '',
			active: false,
			default_item: '',
			title: '',
			value: ''
        }, options);		
	
		var tab_item = $('<div class="tab-item-wrapper"></div>');
		var tab_head = $('<div class="tab-item-head"></div>');
		var tab_text = $('<span class="tab-item-head-text">' + settings.title + '<span>');
		var tab_head_open = $('<div class="tab-item-head-open"></div>');
		var tab_content = $('<div class="tab-item-content"></div>');
		
		if( settings.active ){ 
			tab_head_open.addClass('active'); 
		}else{
			tab_content.css('display', 'none'); 
		}
		
		// bind open tab button
		tab_head_open.click(function(){
			if( $(this).hasClass('active') ){
				$(this).removeClass('active');
				$(this).parent('.tab-item-head').siblings('.tab-item-content').slideUp();
			}else{
				$(this).addClass('active');
				$(this).parent('.tab-item-head').siblings('.tab-item-content').slideDown();
			}				
		});
		
		var tab_head_delete = $('<div class="tab-item-head-delete"></div>');
		
		tab_head_delete.click(function(){
			$('body').gdlr_confirm({
				success: function(){
					tab_item.slideUp(function(){
						$(this).remove();
						gdlrSaveTabAction(settings.textarea);
					});				
				}
			});

		});		

		// create and slide the tab item
		tab_head.append(tab_text)
				.append(tab_head_open)
				.append(tab_head_delete);
		tab_item.append(tab_head)
				.append(tab_content.append(settings.default_item));

		// assign the value
		if( settings.value ){
			tab_item.find('[data-name]').each(function(){
				$(this).val( settings.value[$(this).attr('data-name')] );
			});
		}				
				
		// bind upload button ( if any )
		tab_item.find('.gdlr-upload-wrapper .gdl-text-input').each(function(){
			if( $(this).val() ){
				$(this).siblings('.gdlr-upload-img-sample').attr('src', $(this).val()).removeClass('blank');
			}
			
			$(this).change(function(){
				$(this).siblings('.gdlr-upload-box-hidden').val($(this).val());
				if( $(this).val() == '' ){ 
					$(this).siblings('.gdlr-upload-img-sample').addClass('blank').trigger('change'); 
				}else{
					$(this).siblings('.gdlr-upload-img-sample').attr('src', $(this).val()).removeClass('blank').trigger('change');
				}
			});
		});
		tab_item.find('.gdlr-upload-box-button').click(function(){
			var upload_button = $(this);
			var custom_uploader = wp.media({
				title: 'Author Image',
				button: { text: 'Assign Image' },
				library : { type : 'image' },
				multiple: false
			}).on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				upload_button.siblings('.gdlr-upload-img-sample').attr('src', attachment.url).removeClass('blank');
				upload_button.siblings('.gdl-text-input').val(attachment.url);
				upload_button.siblings('.gdlr-upload-box-hidden').val(attachment.id).trigger('change');
			}).open();			
		});		
				
		// bind the changes event
		tab_item.find('[data-name]').change(function(){
			gdlrSaveTabAction(settings.textarea);
				
			if( $(this).attr('data-name') == 'gdl-tab-title' ){
				tab_text.html($(this).val());
			}
		});				
				
		return tab_item;
	}
	
	// a function to initaite the tabs input
	$.fn.gdlrAddMoreTabs = function( options ){
        var settings = $.extend({
			default_item: '',
			default_title: '',
			textarea: '',
        }, options);		
	
		// initiate the tab section
		var tabs = $('<div class="tab-wrapper"></div>');
		var add_button = $('<div class="add-more-tabs">+</div>');
		var container = $('<div class="tabs-container"></div>');
		container.sortable({
			revert: 100,
			opacity: 0.8,
			forcePlaceholderSize: true,
			placeholder: 'gdlr-placeholder',
			update: function(){
				gdlrSaveTabAction(settings.textarea);
			}
		});
		tabs.append( $('<div class="add-button-wrapper" ></div>')
						.append(add_button)
						.append('<span>ADD MORE TABS</span>') )
			.append( container )
			.append( settings.textarea );
		
		// create the accordion from saved value
		if( settings.textarea.val() ){
			var current_item = $.parseJSON(settings.textarea.val());
			for (var i=0; i<current_item.length; i++){
				var item_title = current_item[i]['gdl-tab-title'];
				if( !item_title ){ item_title = settings.default_title; }
				
				var tab_item = gdlrCreateTabItem({
					default_item : settings.default_item, 
					title : item_title,
					value: current_item[i],
					textarea: settings.textarea
				});
				container.append(tab_item);
			}
		}
			
		// add action to add new tab item
		add_button.click(function(){	

			var tab_item = gdlrCreateTabItem({
				default_item : settings.default_item, 
				title : settings.default_title,
				active : true,
				textarea: settings.textarea
			});
			container.append(tab_item.css('display','none'));
			tab_item.slideDown(300);	

			// update the tab textarea
			gdlrSaveTabAction(settings.textarea);
		});
			
		$(this).append( tabs );
	}
	
	////////////////////////////// END OF TABS SECTION ////////////////////////////////////
	
	$.fn.gdlrEditBoxToggleBox = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
		
		$(this).gdlrAddMoreTabs({
			default_item	: 	'<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Title</div>\
									<input type="text" class="gdl-text-input" data-name="gdl-tab-title" />\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Content</div>\
									<textarea data-name="gdl-tab-content" ></textarea>\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Active</div>\
									<div class="gdlr-combobox-wrapper">\
									<select data-name="gdl-tab-active" >\
										<option value="yes" >Yes</option>\
										<option value="no" >No</option>\
									</select>\
									</div>\
								</div>', 								
			default_title	: 	option.attr('data-default-title'),
			textarea		: 	$('<textarea class="gdlr-input-hidden" name="' + option.attr('data-name') + '">' + value + '</textarea>')
		});
	}
	
	$.fn.gdlrEditBoxTab = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
		
		$(this).gdlrAddMoreTabs({
			default_item	: 	'<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Title</div>\
									<input type="text" class="gdl-text-input" data-name="gdl-tab-title" />\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Content</div>\
									<textarea data-name="gdl-tab-content" ></textarea>\
								</div>', 
			default_title	: 	option.attr('data-default-title'),
			textarea		: 	$('<textarea class="gdlr-input-hidden" name="' + option.attr('data-name') + '">' + value + '</textarea>')
		});
	}
	
	$.fn.gdlrEditBoxIconWithList = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
		
		$(this).gdlrAddMoreTabs({
			default_item	: 	'<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Icon Class</div>\
									<input type="text" class="gdl-text-input" data-name="gdl-tab-icon" />\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Title</div>\
									<input type="text" class="gdl-text-input" data-name="gdl-tab-title" />\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Content</div>\
									<textarea data-name="gdl-tab-content" ></textarea>\
								</div>', 
			default_title	: 	option.attr('data-default-title'),
			textarea		: 	$('<textarea class="gdlr-input-hidden" name="' + option.attr('data-name') + '">' + value + '</textarea>')
		});
	}	
	
	$.fn.gdlrEditBoxPrice = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
		
		$(this).gdlrAddMoreTabs({
			default_item	: 	'<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Title</div>\
									<input type="text" class="gdl-text-input" data-name="gdl-tab-title" />\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Price</div>\
									<input type="text" class="gdl-text-input" data-name="gdl-tab-price" />\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Content</div>\
									<textarea data-name="gdl-tab-content" ></textarea>\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Active</div>\
									<div class="gdlr-combobox-wrapper">\
									<select data-name="gdl-tab-active" >\
										<option value="no" >No</option>\
										<option value="yes" >Yes</option>\
									</select>\
									</div>\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Button Link</div>\
									<input type="text" class="gdl-text-input" data-name="gdl-tab-link" />\
								</div>', 
			default_title	: 	option.attr('data-default-title'),
			textarea		: 	$('<textarea class="gdlr-input-hidden" name="' + option.attr('data-name') + '">' + value + '</textarea>')
		});
	}	
	
	$.fn.gdlrEditBoxAuthor = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
		
		var default_input = '<div class="edit-box-input-wrapper">\
								<div class="input-box-title">Author Image</div>\
								<div class="edit-box-input">\
								<div class="gdlr-upload-wrapper">\
									<img class="gdlr-upload-img-sample blank" src="">\
									<div class="clear"></div>\
									<input type="text" class="gdl-text-input" data-name="gdl-tab-author-image-url" >\
									<input type="text" class="gdlr-upload-box-hidden" data-name="gdl-tab-author-image">\
									<input type="button" class="gdlr-upload-box-button gdl-button" value="Upload"></div>\
									<div class="clear"></div>\
								</div>\
							</div>\
							<div class="edit-box-input-wrapper">\
								<div class="input-box-title">Author Name</div>\
								<input type="text" class="gdl-text-input" data-name="gdl-tab-title" />\
							</div>\
							<div class="edit-box-input-wrapper">\
								<div class="input-box-title">Position</div>\
								<input type="text" class="gdl-text-input" data-name="gdl-tab-position" />\
							</div>\
							<div class="edit-box-input-wrapper">\
								<div class="input-box-title">Content</div>\
								<textarea data-name="gdl-tab-content" ></textarea>\
							</div>';
		if( option.attr('data-enable-social') != 'false' ){
			default_input = default_input + '<div class="edit-box-input-wrapper">\
												<div class="input-box-title">Social List ( Shortcode )</div>\
												<textarea data-name="gdl-tab-social-list" ></textarea>\
											 </div>';
		}
		
		$(this).gdlrAddMoreTabs({
			default_item	: 	default_input,
			default_title	: 	option.attr('data-default-title'),
			textarea		: 	$('<textarea class="gdlr-input-hidden" name="' + option.attr('data-name') + '">' + value + '</textarea>')
		});
	}		

})(jQuery);
