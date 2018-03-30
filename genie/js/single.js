(function($) {

    $( document ).ready(function() {


		$('.topBlock').css('margin-top','-' + $('.mainHeader').height()+ 'px');
		$('#imageHolder').anystretch();

		var ie = (function(){
					var undef,rv = -1; // Return value assumes failure.
					var ua = window.navigator.userAgent;
					var msie = ua.indexOf('MSIE ');
					var trident = ua.indexOf('Trident/');

					if (msie > 0) {
						// IE 10 or older => return version number
						rv = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
					} else if (trident > 0) {
						// IE 11 (or newer) => return version number
						var rvNum = ua.indexOf('rv:');
						rv = parseInt(ua.substring(rvNum + 3, ua.indexOf('.', rvNum)), 10);
					}

					return ((rv > -1) ? rv : undef);
				}());
		
		function preventDefault(e) {
					e = e || window.event;
					if (e.preventDefault)
					e.preventDefault();
					e.returnValue = false;  
		}

		function touchmove(e) {
					toggle(1);
					preventDefault(e);
		}

		function disable_scroll() {
					window.onmousewheel = document.onmousewheel = function(){};
					document.body.ontouchmove = touchmove;
					$( "#imageHolder" ).on("click",div_click);
		}

		function div_click() {
			toggle(1);
		}

		function enable_scroll() {
					window.onmousewheel = document.onmousewheel = document.onkeydown = document.body.ontouchmove = null;
					$( "#imageHolder" ).off("click",div_click);
					if ( ! is_iP ) window.scrollTo( 0, 1 );
					
		}

		var docElem = window.document.documentElement,
					scrollVal,
					isRevealed, 
					noscroll, 
					isAnimating,
					topBlock = document.getElementById( 'topBlock' ),
					content = document.getElementById( 'content' );

		function scrollY() {
					return window.pageYOffset || docElem.scrollTop;
		}

		function scrollPage() {
					scrollVal = scrollY();
					
					if( noscroll && !ie ) {
						if( scrollVal < 0 ) return false;
						// keep it that way
						window.scrollTo( 0, 0 );
					}

					if( classie.has( topBlock, 'notrans' ) ) {
						classie.remove( topBlock, 'notrans' );
						classie.remove( content, 'notrans' );
						return false;
					}

					if( isAnimating ) {
						return false;
					}
					
					if( scrollVal <= 0 && isRevealed ) {
						toggle(0);
					}
					else if( scrollVal > 0 && !isRevealed ){
						toggle(1);
					}
				}

		function toggle( reveal ) {
					isAnimating = true;
					
					if( reveal ) {
						classie.add( topBlock, 'modify' );
						classie.add( content, 'modify' );
						if ( document.getElementById( 'bt_slider_related_t' ) ) {
							classie.add( document.getElementById( 'bt_slider_related_t' ), 'modify' );
						}
						if ( document.getElementById( 'bt_footer_t' ) ) {
							classie.add( document.getElementById( 'bt_footer_t' ), 'modify' );
						}
					}
					else {
						noscroll = true;
						disable_scroll();
						classie.remove( topBlock, 'modify' );
						classie.remove( content, 'modify' );
						if ( document.getElementById( 'bt_slider_related_t' ) ) {
							classie.remove( document.getElementById( 'bt_slider_related_t' ), 'modify' );
						}
						if ( document.getElementById( 'bt_footer_t' ) ) {
							classie.remove( document.getElementById( 'bt_footer_t' ), 'modify' );
						}
					}

					// simulating the end of the transition:
					setTimeout( function() {
						isRevealed = !isRevealed;
						isAnimating = false;
						if( reveal ) {
							noscroll = false;
							enable_scroll();
						}
					}, 1200 );
				}

				// refreshing the page...
		var pageScroll = scrollY();
		noscroll = pageScroll === 0;

		var nua = navigator.userAgent;
		var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));
		
		var is_iP = false;
		if ( ( nua.match( /iPhone/i ) ) || ( nua.match( /iPad/i ) ) ) {
			is_iP = true;
		}

		var whh = window.innerHeight;
		var whw = $(window).width();
		if ((whw > whh) && is_android)
		{
			addh = 60;
		}else{
			addh = 5;
		}
		$(".topBlock").height(whh + addh);
		$("#imageHolder").height(whh + addh);
		
		if ( ! bt_isIE() || ! ( bt_isIE() <= 9 ) ) {
			disable_scroll();
		} else {
			$( 'div.content' ).addClass( 'bt_single_ie9' );
		}

		$( window ).resize(function() {
			var nua = navigator.userAgent;
			var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 &&     nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));
			var whh = window.innerHeight;
			var whw = $(window).width();
			if ((whw > whh) && is_android)
			{
				addh = 60;
			}else{
				addh = 5;
			}
			$(".topBlock").height(whh + addh);
			$("#imageHolder").height(whh + addh);
		});

		if ( ! bt_isIE() || ! ( bt_isIE() <= 9 ) ) {
			window.addEventListener( 'scroll', scrollPage );
		}

    });
	
	$( window ).load(function() {
		$( '.anystretch img' ).css( 'opacity', '1' );
	});
	
	function bt_isIE() {
		var myNav = navigator.userAgent.toLowerCase();
		return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
	}	
	
})( jQuery );