function ResetColor(xy) {
	jQuery('#ub_color_'+xy).val('del');	
	jQuery('#colorinfo'+xy).text('');
	
	if(xy == '1'){
	jQuery('#colorSelector div').css('backgroundColor', 'transparent');
	}else{
	jQuery('#colorSelector'+xy+' div').css('backgroundColor', 'transparent');
	}
	
}