jQuery(document).ready( function($) {
	jQuery('.social_icon_select_sites').live('change',function(){
		var wrap = jQuery(this).closest('p').siblings('.social_icon_wrap');
		wrap.children('p').hide();
		jQuery('option:selected',this).each(function(){
			wrap.find('.social_icon_'+this.value).show();
		});
	});
	jQuery('.social_icon_custom_count').live('change',function(){
		
		var wrap = jQuery(this).closest('p').siblings('.social_custom_icon_wrap');
		wrap.children('div').hide();
		var count = jQuery(this).val();
		for(var i = 1; i <= count; i++){
			wrap.find('.social_icon_custom_'+i).show();
		}
	});
});