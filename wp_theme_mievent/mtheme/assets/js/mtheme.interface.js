var mthemeElements={
	page: '.mtheme-page',
	popup: '.mtheme-popup',
	button: '.mtheme-button',
	buttonSave: '.mtheme-save-button',
	buttonSubmit: '.mtheme-submit-button',
	buttonReset: '.mtheme-reset-button',
	buttonUpload: '.mtheme-upload-button',
	buttonAdd: '.mtheme-add-button',
	buttonClone: '.mtheme-clone-button',
	buttonRemove: '.mtheme-remove-button',
	buttonRefresh: '.mtheme-refresh-button',
	option: '.mtheme-option',
	optionImage: '.mtheme-select-image',
	optionColor: '.mtheme-colorpicker',
	optionSlider: '.mtheme-slider-controls',
	optionSliderValue: '.mtheme-slider-value',
	selectSubmit: '.mtheme-submit-select',
	sidebarModule: '.mtheme-sidebar',
	shortcodeModule: '.mtheme-shortcode',
	shortcodeModuleClone: '.mtheme-shortcode-clone',
	shortcodeModuleValue: '.mtheme-shortcode-value',
	shortcodeModulePattern: '.mtheme-shortcode-pattern',
	tabsContainer: '.mtheme-page',
	tabsList: '.mtheme-menu',
	tabsPane: '.mtheme-section',
}

jQuery(document).ready(function($) {
	
	$( "#_event_slider_date" ).datetimepicker({dateFormat: "yy/mm/dd",minDate: 0});
	$( "#_event_slider_date" ).keypress(function( event ) { return false;});	
	
	var data_value,currentThis,thisValue,parent;
	$("*[data-defendency-show='off']").each(function(){
		parent=$(this).data('parent');
		$(this).parents(parent).fadeOut('fast');
	});
	$("select[data-defendency='on']").each(function(){
			
		data_value = $(this).val();	
		currentThis=$(this).attr('id');
		
		$("#"+currentThis+" > option").each(function() {
			thisValue=$(this).val();
			if(thisValue==data_value){
				$("*[data-defendency-set='"+currentThis+"_"+thisValue+"']").each(function(){
					parent=$(this).data('parent');
					$(this).parents(parent).fadeIn('slow');
				});
			}
			else{
				$("*[data-defendency-set='"+currentThis+"_"+thisValue+"']").each(function(){
					parent=$(this).data('parent');
					$(this).parents(parent).fadeOut('fast');
				});
			}
		});
		
	$(this).live('change',function(){

		data_value = $(this).val();		
		currentThis=$(this).attr('id');
		
		$("#"+currentThis+" > option").each(function() {
			thisValue=$(this).val();
			if(thisValue==data_value){
				$("*[data-defendency-set='"+currentThis+"_"+thisValue+"']").each(function(){
					parent=$(this).data('parent');
					$(this).parents(parent).fadeIn('slow');
				});
			}
			else{
				$("*[data-defendency-set='"+currentThis+"_"+thisValue+"']").each(function(){
					parent=$(this).data('parent');
				$(this).parents(parent).fadeOut('fast');
				});
			}
		});
		
	});});
	$('input[data-defendency="on"]').each(function(){
	
		data_value = $(this).val();
		if($(this).is(':checked')) {
			data_value='true';
		}
		else
		{
			data_value='false';
		}		
		
		currentThis=$(this).attr('id');
		
		if('true'==data_value){
			$("*[data-defendency-set='"+currentThis+"_true']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeIn('slow');
			});			
			$("*[data-defendency-set='"+currentThis+"_false']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeOut('fast');
			});
		}
		else if('false'==data_value){
			$("*[data-defendency-set='"+currentThis+"_true']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeOut('fast');
			});			
			$("*[data-defendency-set='"+currentThis+"_false']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeIn('slow');
			});
		}
		else{
			$("*[data-defendency-set='"+currentThis+"_"+data_value+"']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeOut('fast');
			});
		}
		
	$(this).live('change',function(){

		data_value = $(this).val();	
		if($(this).is(':checked')) {
			data_value='true';
		}
		else
		{
			data_value='false';
		}
		currentThis=$(this).attr('id');
		
		if('true'==data_value){
			$("*[data-defendency-set='"+currentThis+"_true']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeIn('slow');
			});
			$("*[data-defendency-set='"+currentThis+"_false']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeOut('fast');
			});
		}
		else if('false'==data_value){
			$("*[data-defendency-set='"+currentThis+"_true']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeOut('fast');
			});
			$("*[data-defendency-set='"+currentThis+"_false']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeIn('slow');
			});
		}
		else{
			$("*[data-defendency-set='"+currentThis+"_"+data_value+"']").each(function(){
				parent=$(this).data('parent');
				$(this).parents(parent).fadeOut('fast');
			});
		}
		
	});});
	//Options
	$(mthemeElements.page).find('form').submit(function() {
		return false;
	});	
	
	$(mthemeElements.page).find('input[type="submit"]:not(.disabled)').live('click', function() {
		var options = $(mthemeElements.page).find('form').serialize();
		var data = {
			action: $(this).attr('name'),
			options: options
		};
		
		if($(this).attr('name')=='mtheme_reset_options') {
			$(mthemeElements.buttonReset).addClass('disabled');
		} else {
			$(mthemeElements.buttonReset).removeClass('disabled');
		}
		
		$(mthemeElements.buttonSave).addClass('disabled');		
		$.post($(mthemeElements.page).find('form').attr('action'), data, function(response) {
			$(mthemeElements.popup).text(response).fadeIn(300);
			window.setTimeout(function() {
				$(mthemeElements.popup).fadeOut(300);
			}, 2000);
		});
	});
	
	$(mthemeElements.page).find(mthemeElements.option).each(function() {
		var parent=$(this).data('parent'),
			value=$(this).data('value');
			
		if(parent) {		
			parent=$('#'+parent);
			if(parent.length && ((parent.is('select') && parent.val()!=value) || (parent.is('input') && !parent.is(':checked')))) {
				$(this).hide();
			}
		}
	});
	
	$(mthemeElements.page).find('select, input[type="checkbox"]').change(function() {
		var value=$(this).val();
		if($(this).is('input') && !$(this).is(':checked')) {
			value='';
		}
		
		var children=$(mthemeElements.page).find('[data-parent="'+$(this).attr('id')+'"]'),
			visible=children.filter('[data-value="'+value+'"]'),
			hidden=children.filter('[data-value!="'+value+'"]');
			
		if(children.length) {
			visible.slideDown(300);
			hidden.slideUp(300);
		}
	});
	
	//Buttons
	$(mthemeElements.page).find('input, select').live('change', function(){
		$(mthemeElements.buttonSave).removeClass('disabled');
	});
	
	$(mthemeElements.page).find('input, textarea').each(function() {
		$(this).data('value', $(this).val());
		$(this).bind('propertychange keyup input paste', function(event){
			if ($(this).data('value')!=$(this).val()) {
				$(this).data('value', $(this).val());
				$(mthemeElements.buttonSave).removeClass('disabled');
			}
		});
	});
	
	$(mthemeElements.buttonAdd).live('click', function() {
		var button=$(this);
		var data = {
			action: button.data('action'),
			value: $(mthemeElements.page).find('#'+button.data('value')).val(),
		};
		
		if(button.data('value')) {
			$.post($(mthemeElements.page).find('form').attr('action'), data, function(response) {			
				if(response) {				
					$(mthemeElements.buttonSave).removeClass('disabled');					
					if(button.data('container')) {
						$('#'+button.data('container')).prepend(response);
						$('#'+button.data('container')).find('>*:first-child').hide().slideToggle(300);
					} else if(button.data('element')) {
						$('#'+button.data('element')).after(response);
						$('#'+button.data('element')).next('*').hide().slideToggle(300);
					}
				}
			});
		}	
		
		return false;
	});
	
	$(mthemeElements.buttonRemove).live('click', function() {
		var button=$(this);
		
		$('#'+button.data('element')).slideToggle(300, function() {
			$(mthemeElements.buttonSave).removeClass('disabled');
			$(this).remove();
		});
		
		return false;
	});
	
	$(mthemeElements.buttonClone).live('click', function() {
		var button=$(this),
			pane=$(button.data('element')),
			key='a'+(new Date().getTime().toString(16));
		
		if(!pane.length) {
			pane=button.parent();
		}
		
		newPane=pane.clone().attr('id', pane.attr('id').replace(button.data('value'), key)).hide();
		newPane.html(newPane.html().replace(new RegExp(button.data('value'), 'igm'), key));
		newPane.find('input[type="text"], input[type="number"], select, textarea').val('');
		newPane.find('input[type="checkbox"]').attr('checked', false);
		newPane.insertAfter(pane).slideToggle(300);
		
		return false;
	});
	
	$(mthemeElements.buttonSubmit).click(function() {
		var form=$(this).parent();
		
		if(!form.length || !form.is('form')) {
			form=$(this).parent();
			while(!form.is('form')) {
				form=form.parent();
			}
		}
			
		form.submit();
		return false;
	});
	
	$(mthemeElements.buttonRefresh).click(function() {
		location.reload();
		return false;
	});
	
	//Tabs
	$(mthemeElements.tabsContainer).each(function() {
		var tabsContainer=$(this);
		
		if(window.location.hash && tabsContainer.find(window.location.hash).length) {
			tabsContainer.find(window.location.hash).show();
			
			tabsContainer.find(mthemeElements.tabsList).find('li').each(function() {
				if($(this).find('a').attr('href')==window.location.hash) {
					$(this).addClass('current');
				}
			});
			
		} else {
			tabsContainer.find(mthemeElements.tabsList).find('li:eq(0)').addClass('current');
			tabsContainer.find(mthemeElements.tabsPane).eq(0).show();
		}
	
		tabsContainer.find(mthemeElements.tabsList).find('li').click(function() {
			var tabLink=$(this).find('a').attr('href');
			window.location.hash=tabLink;
			
			tabsContainer.find(mthemeElements.tabsList).find('li').removeClass('current');
			$(this).addClass('current');
			
			tabsContainer.find(mthemeElements.tabsPane).hide();
			tabsContainer.find(tabLink).show();
		
			return false;	
		});
	});
	
	//Colorpicker
	$(mthemeElements.optionColor).wpColorPicker({
		defaultColor: $(this).val(),
		palettes: false,
		change: function(event, ui){
			$(mthemeElements.buttonSave).removeClass('disabled');
		}
	});
	
	//Select
	$(mthemeElements.selectSubmit).change(function() {
		var form=$(this).parent();
		
		if(!form.length || !form.is('form')) {
			form=$(this).parent();
			while(!form.is('form')) {
				form=form.parent();
			}
		}
			
		form.submit();
		return false;
	});
	
	//Slider
	$(mthemeElements.optionSlider).each(function() {
		var slider=$(this);
		var unit=slider.parent().find('input.slider-unit').val();
		var value=parseInt(slider.parent().find('input.slider-value').val());
		var minValue=parseInt(slider.parent().find('input.slider-min').val());
		var maxValue=parseInt(slider.parent().find('input.slider-max').val());		

		slider.parent().find(mthemeElements.optionSliderValue).text(value+' '+unit);		
		slider.slider({
			value: value,
			min: minValue,
			max: maxValue,
			slide: function( event, ui ) {
				slider.parent().find(mthemeElements.optionSliderValue).text( ui.value+' '+unit );
				slider.parent().find('input.slider-value').val(ui.value);
				$(mthemeElements.buttonSave).removeClass('disabled');
			}
		});
	});
	
	//Select Image
	$(mthemeElements.optionImage).find('img').click(function(){
		$(mthemeElements.buttonSave).removeClass('disabled');
		$(this).parent().find('img').removeClass('current');
		$(this).addClass('current');	
		$(this).parent().find('input').val($(this).data('value'));				
	});	
	
	//Uploader
	var header_clicked = false,
		fileInput = '',
		imageInput = '';

	$(mthemeElements.buttonUpload).live('click', function(e) {		
		fileInput = jQuery(this).prev('input');		
		
		if(fileInput.length) {
			imageInput = fileInput.prev('img');
		}
		
		if(fileInput.length) {
			tb_show('', 'media-upload.php?post=-629834&amp;mtheme_uploader=1&amp;TB_iframe=true');
			header_clicked = true;
			e.preventDefault();
		}
	});

	//store original
	window.original_send_to_editor = window.send_to_editor;
	window.original_tb_remove = window.tb_remove;

	//override removing
	window.tb_remove = function() {
		header_clicked = false;
		window.original_tb_remove();
	}
	
	//send to editor
	window.send_to_editor = function(html) {
		$(mthemeElements.buttonSave).removeClass('disabled');
		if (header_clicked) {
			imgurl = $(html).attr('href');
			fileInput.val(imgurl);
			
			if(imageInput!='' && imageInput.length) {
				imageInput.attr('src', imgurl);
			}
			
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}		
	}
	
	//Profile
	if($('#profile-page').length) {
		$('#description').parents('tr').remove();
	}
});


jQuery(document).on({click: function()
{
	//Colorpicker
	jQuery(mthemeElements.optionColor).wpColorPicker({
		defaultColor: jQuery(this).val(),
		palettes: false,
		change: function(event, ui){
			jQuery(mthemeElements.buttonSave).removeClass('disabled');
		}
	});
}});