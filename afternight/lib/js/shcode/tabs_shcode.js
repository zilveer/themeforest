
jQuery(document).ready(function() {
	
	/*Set default settings*/
	jQuery('#tabs_style option:first').prop('selected','selected');
	jQuery('#nr_tabs option:first').prop('selected','selected');
	jQuery('#nr_tabs_accordion option:first').prop('selected','selected');
	
	jQuery('#open_title').val('');
	jQuery('#close_title').val('');
	jQuery('#toggle_content').val('');
	jQuery('#tabber_title').val('');
	
	jQuery('#tabs_title_').html('');
	jQuery('#tabs_title_accordion').html('');
	
	
	/*first select logic*/
	jQuery('#tabs_style').change(function() {
		jQuery('.tab_togle_settings').hide();
		if(jQuery(this).val() == 'default' || jQuery(this).val() == 'vertical'){
			jQuery('#tabs_settings').show();
		}
		else if(jQuery(this).val() == 'toggle' ){
			jQuery('#toggle_setings').show();
		}
		else if(jQuery(this).val() == 'accordion' ){
			jQuery('#accordion_settings').show();
		}
	});
	
	
	/*BOF  Tabs*/
	jQuery('#nr_tabs').change(function() {
		jQuery('#tabs_title_').html('');
		
		for( var i=1; i<=jQuery(this).val(); i++ ){
			var title_content = '<div><label>Tab ' +i+ ' tile: </label> <input type="text" name="title_tab" id="title_tab_'+i+'"></div>'; 
			jQuery('#tabs_title_').append(title_content);
			
		}
	});
	/*EOF  Tabs*/

	/*BOF  Accordion*/
	jQuery('#nr_tabs_accordion').change(function() {
		jQuery('#tabs_title_accordion').html('');
		
		for( var i=1; i<=jQuery(this).val(); i++ ){
			var title_content = '<div><label>Tab ' +i+ ' tile: </label> <input type="text" name="title_tab_acc" id="title_tab_acc_'+i+'"></div>'; 
			jQuery('#tabs_title_accordion').append(title_content);
			
		}
	});	
	/*EOF  Accordion*/
});

function insertTabs(){
	
	var tabs = '';
	var nr_tabs = 0;
	jQuery('[name="title_tab"]').each(function(i) {   
		var  tab_name = 'Tab '+(i+1);
		if( jQuery.trim(jQuery(this).val()) != '' ){
			tab_name = jQuery.trim(jQuery(this).val());
		}
		 tabs = tabs + '[tab title="'+tab_name+'"]Add '+tab_name+' content here.[/tab]'; 
		nr_tabs ++;
	});
	
	if(nr_tabs > 0){
		var tabs_shcode = '[tabs style="'+jQuery('#tabs_style').val()+'" title="'+jQuery('#tabber_title').val()+'"] '+ tabs +'[/tabs]';
		
		Editor.AddText( "content" , "\n"+tabs_shcode+"\n");
		showNotify();
	}
	else{
		showErrorMessage('Select please number of tabs');
	}
	
}

function insertTabsAccordion(){
	var tabs = '';
	var nr_tabs = 0;
	jQuery('[name="title_tab_acc"]').each(function(i) {   
		var  tab_name = 'Tab '+(i+1);
		if( jQuery.trim(jQuery(this).val()) != '' ){
			tab_name = jQuery.trim(jQuery(this).val());
		}
		 tabs = tabs + '[acc title="'+tab_name+'"]Add '+tab_name+' content here.[/acc]'; 
		nr_tabs ++;
	});
	
	if(nr_tabs > 0){
		var tabs_shcode = '[accordion]'+ tabs +'[/accordion]';
		
		Editor.AddText( "content" , "\n"+tabs_shcode+"\n");
		showNotify();
	}
	else{
		showErrorMessage('Select please number of tabs');
	}
	
}