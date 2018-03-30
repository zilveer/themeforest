jQuery(document).ready(function($) {
	
	$( document ).ajaxComplete(function() {
	
		$('select.iron_overlay_pattern').off('change', iron_vc_overlay_pattern_change);
		$('select.iron_overlay_pattern').on('change', iron_vc_overlay_pattern_change);
	});
	
	function iron_vc_overlay_pattern_change() {
		var currentPattern = $(this).parent().find('.pattern');
		if(currentPattern.length > 0) 
			currentPattern.remove();
			
		var value = $(this).val();
		var pattern = '<div class="pattern" style="background-image:url('+iron_vars.patterns_url+value+'.png); width:99.5%; height:70px;margin:15px 0;"></div>';
		$(this).after(pattern);
	}
	
});