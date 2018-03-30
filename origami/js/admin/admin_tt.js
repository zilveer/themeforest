// Exclude/Include Selector Sync
function exclude_include_update() {
	var $box_select = jQuery('.page_select');
		$box_select.each(function(){
			var $box_select_id = jQuery(this).attr("id");
			
			var $catstoshow = jQuery('input[name='+$box_select_id+']').val();
			var $catstoshow_array = new Array();
				if ($catstoshow) {
					$catstoshow_array = $catstoshow.split(",");
				}

			var $l = $catstoshow_array.length;
			 
				for (var i=0;i<$l;i++) {
					jQuery('#'+$box_select_id+'_'+$catstoshow_array[i]).attr('checked','checked')
				}

		});

}
// Exclude/Include Selector
function exclude_include_checkbox() {
	var $box_select = jQuery('.page_select');
	
		$box_select.each(function(){
			
			var $box_select_id = jQuery(this).attr("id");
			var $toshow = ".select_"+$box_select_id;
			var $class_toshow = jQuery(this).find($toshow);
			$class_toshow.each(function(i){
				var $catid = jQuery(this).attr('name');
				jQuery(this).bind('change',function(){
						
					var $original_pgstoshow = jQuery('input[name='+$box_select_id+']').val();
					if (jQuery(this).attr('checked')){

						if(jQuery(this).val()){	
							if ($original_pgstoshow == '') {
								jQuery('input[name='+$box_select_id+']').val($catid);
							}else{
								jQuery('input[name='+$box_select_id+']').val($original_pgstoshow+','+$catid);
							}					
						}	
					} else {
						$original_pgstoshow = ','+$original_pgstoshow+',';
						$original_pgstoshow = $original_pgstoshow.replace(','+$catid+',',',');
						if ($original_pgstoshow.charAt(0) == ',') {
							if ($original_pgstoshow == ',') {
								$original_pgstoshow = '';
							}else{
								$original_pgstoshow = $original_pgstoshow.substr(1);
							}			
						}
						if ($original_pgstoshow.charAt(($original_pgstoshow.length-1)) == ',') {
							$original_pgstoshow = $original_pgstoshow.substr(0,($original_pgstoshow.length-1));
						}
					  	jQuery('input[name='+$box_select_id+']').val($original_pgstoshow);				
					}
					exclude_include_update();
				
				});			
		
			});

		});
}
jQuery(document).ready(function(){
	exclude_include_checkbox();
	exclude_include_update();
});