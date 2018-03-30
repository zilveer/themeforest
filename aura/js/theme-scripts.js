(function($) {
  "use strict";

    $(".wmfloadingani").click(function(){
    	$(".wmfloadingani").css("display","none");
    });

})(jQuery);


function goBack(){
  window.history.back()
}


// SVG fallback
	// toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script#update
function ModernizrStart()
{
	"use strict";
	if (!Modernizr.svg) {
		var imgs = document.getElementsByTagName('img');
		var dotSVG = /.*\.svg$/;
		for (var i = 0; i != imgs.length; ++i) {
			if(imgs[i].src.match(dotSVG)) {
				imgs[i].src = imgs[i].src.slice(0, -3) + "png";
			}
		}
	}

}
ModernizrStart();

//Hide Address Bar
function hideAddressBar()
{
  if(!window.location.hash) 
  {
	  if(document.height < window.outerHeight)
	  {
		  document.body.style.height = (window.outerHeight + 50) + 'px'; 
	  }

	  setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
  }
}
window.addEventListener("load", function(){ if(!window.pageYOffset){ hideAddressBar(); } } );
window.addEventListener("orientationchange", hideAddressBar ); 


// IScroll
var myScroll;

function loaded () {
	myScroll = new IScroll('#auranavwrapper', { mouseWheel: true,click: true,scrollX: false, scrollY: true });
}
var auranavwrapper = document.getElementById('auranavwrapper');
auranavwrapper.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

(function() {
	"use strict";
	var triggerBttn = document.getElementById( 'aura-toggle-menu' ),
		overlay = document.querySelector( '.auraoverlay' ),
		transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		support = { transitions : Modernizr.csstransitions };

	function toggleOverlay() {
		if( classie.has( overlay, 'auraopen' ) ) {
			classie.remove( overlay, 'auraopen' );
			classie.add( overlay, 'auraclose' );
			var onEndTransitionFn = function( ev ) {
				if( support.transitions ) {
					if( ev.propertyName !== 'visibility' ) return;
					this.removeEventListener( transEndEventName, onEndTransitionFn );
				}
				classie.remove( overlay, 'auraclose' );
			};
			if( support.transitions ) {
				overlay.addEventListener( transEndEventName, onEndTransitionFn );
			}
			else {
				onEndTransitionFn();
			}
		}
		else if( !classie.has( overlay, 'auraclose' ) ) {
			classie.add( overlay, 'auraopen' );
		}
		
		if( classie.has( triggerBttn, 'auraopen' ) ) {
			classie.remove( triggerBttn, 'auraopen' );
			classie.add( triggerBttn, 'auraclose' );
		}else if( !classie.has( triggerBttn, 'auraopen' ) ) {
			classie.remove( triggerBttn, 'auraclose' );
			classie.add( triggerBttn, 'auraopen' );
		}
	}

	triggerBttn.addEventListener( 'click', toggleOverlay );
	//triggerBttn.addEventListener( 'touch', toggleOverlay );
	if (aura_theme_scripts.autoopenhome == 'yes') {
		toggleOverlay();
	};
	
})();