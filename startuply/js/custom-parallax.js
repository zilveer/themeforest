// Parallax Bgs //


jQuery(window).load( function() {

	// Parallax Bgs for rows
	jQuery('div[class*="parallax-bag"]').each( function() {
		var $div = jQuery(this);
		var token = $div.data('token');
		var settingObj = window['vsc_parallax_' + token];

		if(!( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )) {
			jQuery('.parallax-bag-'+settingObj.id+'').parallax("50%", 0.4, false);
			jQuery('.parallax-bag-'+settingObj.id+'').css({'background-attachment': 'fixed'});
		}

		// Parallax Fix for Mobile Devices
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			jQuery('.parallax-bag-'+settingObj.id+'').css({'background-attachment': 'scroll'});
		}

	});

});
