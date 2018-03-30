(function($) { "use strict"; 
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id))
		return;
	js = d.createElement(s);
	js.id = id;
	js.src = "//connect.facebook.net/" + facebook_config.language
			+ "/sdk.js#xfbml=1&appId=" + facebook_config.appid
			+ "&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
})(jQuery);