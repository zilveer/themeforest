/* global mejs, _wpmejsSettings */
(function ($) {

	// add mime-type aliases to MediaElement plugin support
	mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');

	$(function () {
		var settings = {};

		if ( $( document.body ).hasClass( 'mce-content-body' ) ) {
			return;
		}

		if ( typeof _wpmejsSettings !== 'undefined' ) {
			settings.pluginPath = _wpmejsSettings.pluginPath;
		}

		settings.success = function( mejs ) {
			var autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
			if ( 'flash' === mejs.pluginType && autoplay ) {
				mejs.addEventListener( 'canplay', function () {
					mejs.play();
				}, false );
			}
		};

		settings.videoWidth='100%';
		settings.videoHeight='100%';
		settings.enableAutosize=true;
		
		$( '.wp-video-shortcode' ).mediaelementplayer( settings );
	});

}(jQuery));