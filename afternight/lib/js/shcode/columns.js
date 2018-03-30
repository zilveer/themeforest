
jQuery(document).ready(function() {
	
	jQuery('#nbr_col').change(function() {
		if( jQuery(this).val() != '' ){
			addSampleColumns(jQuery(this).val());
		}
		else{
			jQuery('#col_samples').html('');		
			jQuery('#demo_box').hide();
		}
	});
	

});

function countAvailableColumnsNbr(){
	/*count columns in the sample div*/
	
	var cols_available = jQuery('#col_show').html(); 
	var counter = 0;
	for( var i=0;i<cols_available.length;i++){
		
		if(cols_available.substring(i, (i+1)) == 'X'){
			counter++;   
		}
	}
	return counter;
}

function addToBox(nbr_cols){
	
	if(jQuery('#col_show').html() != ''){
		jQuery('#col_show').append('|');
	}
	
	for( var i=0; i < nbr_cols; i++ ){
		jQuery('#col_show').append('X');
	}
	
	
	var cols_available = countAvailableColumnsNbr(); 
	var cols_left =  jQuery('#nbr_col').val() - cols_available;
	
	jQuery('.sample_col').each(function(index) {   
		if( parseInt(jQuery(this).attr('cols')) > parseInt(cols_left)){
			jQuery(this).attr('disabled','disabled');
		}
	});
	
}

function removeLastCols(){
	var div_content = jQuery('#col_show').html().split('|');

	jQuery('#col_show').html('');
	for( var i=0; i<div_content.length-1; i++ ){
		if(i>0){jQuery('#col_show').append('|');}
		jQuery('#col_show').append(div_content[i]);
	}
	
	var cols_available = countAvailableColumnsNbr();
	
	var cols_left =  jQuery('#nbr_col').val() - cols_available;
	
	jQuery('.sample_col').each(function(index) {   
		if( parseInt(jQuery(this).attr('cols')) <= parseInt(cols_left)){
			jQuery(this).removeAttr('disabled');
		}
	});
}

function addSampleColumns(nbr_col){
	jQuery('#demo_box').show();
	jQuery('#col_show').html('');
	jQuery('#col_samples').html('');	
	
	for( var i=0; i < nbr_col - 1; i++ ){
		var btn_width = ((i+1)*240/nbr_col);
		var btn = '<input type="button" name="sample_col" class="sample_col" onclick="addToBox('+(i+1)+')" cols="'+(i+1)+'" style="width:'+ btn_width +'px" value="'+(i+1) +'/'+ nbr_col +'"> <br/>';
		jQuery( '#col_samples' ).append( btn );
	}
}

function insertCols(){ 
	if(jQuery('#col_show').html() != ''){
		var div_content = jQuery('#col_show').html().split('|');
		
		var col_shortcode = '';
		for( var i=0; i < div_content.length; i++ ){
			var is_last = false;
			var is_first = false;
			if(i == 0){
				is_first = true;
			}
			if(i == div_content.length-1){
				is_last = true;
			}
			var shortcode = doColShortcode(div_content[i].length,is_last,is_first);
			col_shortcode = col_shortcode + shortcode;
			
		}
		Editor.AddText( "content" , "\n"+col_shortcode+"\n");
		showNotify();
	}
}

function doColShortcode(col_width,is_last,is_first){
	
	switch( jQuery('.sample_col').length )  /*check how many col were selected (count the buttons)*/
	{
	case 1:
		var class_name = getClass('twocol_one',is_last,is_first);
		var col_shortcode = '['+ class_name +'] Column 1/2 [/'+class_name+']';
		break;
	case 2:
		//execute code block 2
		
		if(col_width == 1){
			var class_name = getClass('threecol_one',is_last,is_first);
			var col_shortcode = '['+ class_name +'] Column 1/3 [/'+class_name+']';
		}
		else{
			var class_name = getClass('threecol_two',is_last,is_first);
			var col_shortcode = '['+ class_name +'] Column 2/3 [/'+class_name+']';
		}
		break;
	case 3:
	  
		if(col_width == 1){
			var class_name = getClass('fourcol_one',is_last,is_first);
			var col_shortcode = '['+ class_name +'] Column 1/4 [/'+class_name+']';
		}
		else if (col_width == 2){
			var class_name = getClass('fourcol_two',is_last,is_first);
			var col_shortcode = '['+ class_name +'] Column 2/4 [/'+class_name+']';
		}
		else{
			var class_name = getClass('fourcol_three',is_last,is_first);
			var col_shortcode = '['+ class_name +'] Column 3/4 [/'+class_name+']';
		}
		break;
		
	case 4:
		  
		if(col_width == 1){
			var class_name = getClass('fivecol_one',is_last,is_first);
			var col_shortcode = '['+ class_name +'] Column 1/5 [/'+class_name+']';
		}
		else if (col_width == 2){
			var class_name = getClass('fivecol_two',is_last,is_first);
			var col_shortcode = '['+ class_name +'] Column 2/5 [/'+class_name+']';
		}
		else if (col_width == 3){
			var class_name = getClass('fivecol_three',is_last);
			var col_shortcode = '['+ class_name +'] Column 3/5 [/'+class_name+']';
		}
		else{
			var class_name = getClass('fivecol_four',is_last,is_first);
			var col_shortcode = '['+ class_name +'] Column 4/5 [/'+class_name+']';
		}
		break;
	
		
	}
	
	
	return col_shortcode;
}

function getClass(class_name,is_last,is_first){
	if(is_last)
		return class_name + '_last';
	else if(is_first)
		return class_name + '_first';
	else
		return class_name; 
}
