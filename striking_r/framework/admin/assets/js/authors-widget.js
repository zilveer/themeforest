jQuery(document).ready( function($) {
	$(document).on('change', '.author_count', function(){
		var wrap = $(this).closest('p').siblings('.authors_wrap');
		wrap.children('div').hide();
		var count = $(this).val();
		for(var i = 1; i <= count; i++){
			wrap.find('.author_'+i).show();
		}
	});
});