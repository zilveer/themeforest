(function($) {
  "use strict";
  jQuery(document).ready(function($){

		try {
			var $browser_height = jQuery( window ).height();
			var $header_height	=	jQuery( 'div#header' ).height();
			var $menu_height	=	jQuery( 'div#navigation-wrapper' ).height();
			var $footer_height	=	jQuery( 'div#footer' ).height();
			jQuery('body > .container').css( 'min-height', $browser_height - ( $header_height + $menu_height + $footer_height + 30 ) );
		} catch (e) {
			// TODO: handle exception
		}
		
		try {
			$('#header-search .search-icon').click( function(){
				
				var $formParent = $(this).parent();
				
				var $searchInput = $formParent.find( 'input[name=s]' );
				var $searchValue = $searchInput.val();
				
				if( $searchValue == '' ){
					$searchInput.focus();
				}
				else{
					window.location.href = jsvar.home_url + '?s=' + $searchValue;
				}
			} )
		} catch (e) {
			// TODO: handle exception
			console.log( e.message );
		}		

		$('div.col-sm-3 > ul').addClass('list-unstyled');
		$('input[type="submit"]').addClass('btn btn-default');
		$('.item.responsive-height, .carousel .post').matchHeight();
	});
})(jQuery);