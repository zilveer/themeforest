(function($, undefined){
	var $rule = $('.elm-rule .rule-btn-top');
	if($rule.length){
		$rule.on('click', function(){
			$('html, body').animate({
				scrollTop: 0
			}, 1000);
		});
	}
})(jQuery);
