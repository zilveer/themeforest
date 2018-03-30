jQuery(document).ready( function($) {
	$(document).on('change', '.social_icon_select_sites', function(){
		var wrap = $(this).closest('p').siblings('.social_icon_wrap');
		wrap.children('p').hide();
		$('option:selected',this).each(function(){
			wrap.find('.social_icon_'+this.value).show();
		});
	});
	$(document).on('change', '.social_icon_custom_count', function(){
		var wrap = $(this).closest('p').siblings('.social_custom_icon_wrap');
		wrap.children('div').hide();
		var count = $(this).val();
		for(var i = 1; i <= count; i++){
			wrap.find('.social_icon_custom_'+i).show();
		}
	});
});