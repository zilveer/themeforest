jQuery(document).ready( function($) {
	jQuery(document).on('change', '.advertisement_count', function(){
		
		var wrap = jQuery(this).closest('p').siblings('.advertisement_wrap');
		wrap.children('div').hide();
		var count = jQuery(this).val();
		for(var i = 1; i <= count; i++){
			wrap.find('.advertisement_'+i).show();
		}
	});
});