
/*------------------------------------------------------------------------
 Video Generator Plugin
 Copyright: Rascals Themes
 www: http://rascals.eu
------------------------------------------------------------------------*/

;(function($) {

jQuery.fn.VideoGenerator = function( options ) {
		
	return this.each( function( i ) {

		var opts = $.extend({
			'null' : 0
		}, options);
		   
		/* List variables */
		var vars = {
			type: $( this ).data( 'type' ),
			id: $( this ).data( 'id' ),
			width: $( this ).data( 'width' ),
			height: $( this ).data( 'height' ),
			align: $( this ).data( 'align' ),
			params: $( this ).data( 'params' )
		};
		var video = $( this );
		
		/* Check if ID exists */
		if ( vars.id == '' || vars.id == undefined )
			return false;
		
		/* Align */
		if ( vars.align == 'center' && vars.align != '' ) {
			vars.align = 'margin:0 auto;';
		} else {
			vars.align = 'float:'+vars.align;
		}
					
		/* Codes */
		var 
			wrap = '<div class="video-wrap" style="position:relative;width:' + vars.width + 'px;height:' + vars.height + 'px;' + vars.align + '"></div>',
			vimeo = '<iframe src="http://player.vimeo.com/video/' + vars.id + '?' + vars.params + '" width="' + vars.width + '" height="' + vars.height + '" frameborder="0" style="z-index:0" webkitAllowFullScreen allowFullScreen class="video-frame"></iframe>',
			youtube = '<iframe src="http://www.youtube.com/embed/' + vars.id + '?wmode=transparent&amp;' + vars.params + '" width="' +vars.width + '" height="' + vars.height + '" frameborder="0" style="z-index:0" webkitAllowFullScreen allowFullScreen class="video-frame"></iframe>';
		
		/* Insert wrapper code */
		$( this ).append( wrap );
		
		
		/* Insert video code */
		function _insert_code() {
			if ( vars.type == 'vimeo' ) {
				$( '.video-wrap', video ).append( vimeo );
				return false;
			}
			if ( vars.type == 'youtube' ) {
				$( '.video-wrap', video ).append( youtube );
				return false;
			}
		}
		
		_insert_code(); 
		
	});
}

})(jQuery);