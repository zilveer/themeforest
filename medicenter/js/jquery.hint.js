(function($){
	var defaults = {
		hintClass: "hint"
	};

	var methods =
	{
		init : function(options){
			return this.each(function(){
				options = $.extend(defaults, options);
				if($(this).attr("placeholder")==$(this).val())
					$(this).addClass(options.hintClass);
				$(this).focus(function(){
					if($(this).attr("placeholder")==$(this).val())
						$(this).val("").removeClass(options.hintClass);
				});
				$(this).blur(function(){
					if($(this).val()=="")
						$(this).val($(this).attr("placeholder")).addClass(options.hintClass);
				});
			});
		}
	};

	jQuery.fn.hint = function(method){
		if(methods[method])
			return methods[method].apply(this, arguments);
		else if(typeof(method)==='object' || !method)
			return methods.init.apply(this, arguments);
	};
})(jQuery);