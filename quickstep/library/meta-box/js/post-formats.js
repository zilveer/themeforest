jQuery( document ).ready( function($) {

	var	$linkSettings  = $('#post-link-settings').hide(),
		$quoteSettings = $('#post-quote-settings').hide(),
		$videoSettings = $('#post-video-settings').hide(),
		$gallerySettings = $('#post-gallery-settings').hide(),
		$postFormat    = $('#post-formats-select input[name="post_format"]');
	
	$postFormat.each(function() {
		
		var $this = $(this);

		if( $this.is(':checked') )
			changePostFormat( $this.val() );

	});

	$postFormat.change(function() {

		changePostFormat( $(this).val() );

	});

	function changePostFormat( val ) {

		$linkSettings.hide();
		$quoteSettings.hide();
		$videoSettings.hide();
		$gallerySettings.hide();

		if( val === 'link' ) {

			$linkSettings.show();

		} else if( val === 'quote' ) {

			$quoteSettings.show();

		} else if( val === 'video' ) {

			$videoSettings.show();
			
		} else if( val === 'gallery' ) {

			$gallerySettings.show();
			
		}

	}

});