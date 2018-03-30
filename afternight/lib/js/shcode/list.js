

jQuery(document).ready(function() {
	
	setDefault(); /*reset the inputs when page is reloaded*/
	
	ResetSample();
	
	jQuery('#list_type').change(function() { 
		if(jQuery(this).val() == 'ordered_list' ){
			jQuery('#unordered_list').hide();
			jQuery('#ordered_list').show();
			
			jQuery('#unordered_sample').hide();
			jQuery('#ordered_sample').show();
			
		}
		else{
			jQuery('#ordered_list').hide();
			jQuery('#unordered_list').show();
			
			jQuery('#ordered_sample').hide();
			jQuery('#unordered_sample').show();
		}
	});
	
	
	jQuery('#ordered_list').change(function() {
		jQuery('#ordered_list option').each(function(index) {   
			jQuery('#ordered_sample').removeClass(jQuery(this).val());
		});
		
		jQuery('#ordered_sample').addClass( jQuery('#ordered_list').val() );
	});
	
	jQuery('#unordered_list').change(function() {
		jQuery('#unordered_list option').each(function(index) {   
			jQuery('#unordered_sample').removeClass(jQuery(this).val());
		});
		
		jQuery('#unordered_sample').addClass( jQuery('#unordered_list').val() );
	});
	

});


function ResetSample(){
	jQuery('#ordered_list').change(function() {
		jQuery('#ordered_list option').each(function(index) {   
			jQuery('#ordered_sample').removeClass(jQuery(this).val());
		});
		
		jQuery("#ordered_sample option:first").prop('selected','selected');
		//jQuery("#ordered_sample").addClass(jQuery("#ordered_list option:first").val());
	});
	
	jQuery('#unordered_list').change(function() {
		jQuery('#unordered_list option').each(function(index) {   
			jQuery('#unordered_sample').removeClass(jQuery(this).val());
		});
		
		jQuery("#unordered_sample option:first").prop('selected','selected');
		//jQuery("#unordered_sample").addClass(jQuery("#unordered_list option:first").val());
	});
	
}

function setDefault(){
	
	jQuery('#list_type option:first').prop('selected','selected');
	jQuery('#unordered_sample').hide();
	jQuery('#ordered_sample').show();
	
	jQuery('#unordered_list').hide();
	jQuery('#ordered_list').show();
	
	jQuery("#ordered_list option:first").prop('selected','selected');
	jQuery("#unordered_list option:first").prop('selected','selected');
	
	
	jQuery('#ordered_list option').each(function(index) {   
		jQuery('#ordered_sample').removeClass(jQuery(this).val());
	});
	jQuery("#ordered_sample").addClass(jQuery("#ordered_list option:first").val());
	
	jQuery('#unordered_list option').each(function(index) {   
		jQuery('#unordered_sample').removeClass(jQuery(this).val());
	});
	
	jQuery("#unordered_sample").addClass(jQuery("#unordered_list option:first").val());
}

function insertList(){
	
	var list_shcode;
	if(jQuery('#list_type').val() == 'ordered_list'){
		list_shcode = '[ordered_list style="'+jQuery('#ordered_list').val()+'"] <ol> <li>Here goes the list item</li> </ol>	[/ordered_list]';
	}
	else{
		list_shcode = '[unordered_list style="'+jQuery('#unordered_list').val()+'"] <ul> <li>Here goes the list item</li> </ul>	[/unordered_list]'; 
	}
	
	Editor.AddText( "content" , "\n"+list_shcode+"\n");
	showNotify();
}