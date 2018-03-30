function addTableBuilder(){
	jQuery('#table_builder').html('');
	jQuery('#nr_rows').removeClass('required');
	jQuery('#nr_columns').removeClass('required');
	var validated = true; 
	if(jQuery('#nr_rows').val() == '' || jQuery('#nr_rows').val() == ''){
		
		jQuery('#nr_rows').addClass('required');
		validated = false;
	}
	if(jQuery('#nr_columns').val() == '' || jQuery('#nr_columns').val() == ''){
		
		jQuery('#nr_columns').addClass('required');
		validated = false;
	}
	
	if(validated){
		var rows = jQuery('#nr_rows').val();
		var cols = jQuery('#nr_columns').val();
		//alert(rows);
		var output = '';
		
		output += '<table border=1 class="cosmotable ">';
		if(jQuery('#table_title').val() != ''){
			output += '<tr><th colspan='+cols+'>'+jQuery('#table_title').val()+'</th></tr>';	
		}
		
		for(var i = 1; i<=rows; i++){
			output += '<tr class="row_'+i+'">';
			for(var j = 1; j<=cols; j++){ //alert(1);
				output += '<td class="td_'+i+'_'+j+'">';
				output += '<textarea cols=20 rows=5 class="cell_'+i+'_'+j+'"></textarea>';
				output += '</td>';
			}
			output += '</tr>';
		} 
		output += '</table>';
		
		output += '<div><input type="button" onclick="addTableCode('+rows+','+cols+','+'\''+jQuery('#table_title').val()+'\''+')" id="insert_tabs_btn" value="Add Table to the post" class="button-primary"></div>';
		jQuery('#table_builder').html(output);
	}
	 
}

function addTableCode(rows,cols,title){
	var custom_css = '';
	if(jQuery('#additional_style').val() != '' ){
		custom_css = '"style='+jQuery('#additional_style').val()+' "';
	}
	
	var table_classes = jQuery('#table_style').val()+' '+ jQuery('#additional_class').val();
	var table = '';
	
	table += '<table class="cosmotable '+table_classes+'" '+custom_css+'>';
	if(jQuery('#table_title').val() != ''){
		table += '<tr><th colspan='+cols+'>'+jQuery('#table_title').val()+'</th></tr>';	
	}
	for(var i = 1; i<=rows; i++){
		table += '<tr class="row_'+i+'">';
		for(var j = 1; j<=cols; j++){
			table += '<td class="td_'+j+'_'+i+'">';
			table += jQuery('.cell_'+i+'_'+j).val();  
			table += '</td>';
		}
		table += '</tr>';
	} 
	table += '</table>';
	
	Editor.AddText( "content" , "\n"+ table +"\n");
	showNotify();
}