jQuery(document).ready(function($){

	//Map handler
    $( '#map-handler a' ).click( function() {
        $( '#map iframe' ).slideToggle( 400, function() {
            if( $( '#map iframe' ).is( ':visible' ) ) {
                $( '#map-handler a' ).text( l10n_handler.map_close );
            } else {
                $( '#map-handler a' ).text( l10n_handler.map_open );
            }
        });
    } );
	
	//social icon fade
	$('div.fade-socials a, div.fade-socials-small a').hide();
    $('div.fade-socials, div.fade-socials-small').hover(function(){
       $(this).children('a').fadeIn('slow');
    },
    function(){
       $(this).children('a').fadeOut('slow');
    });

	// socials tipTip
	$('a.socials-square, a.socials-square-small').each(function() {
	    var text = $(this).text().charAt(0).toUpperCase() + $(this).text().slice(1);
        if( $( '#wpadminbar' ).length != 0 )
            { var offset = 28; }
        else
            { var offset = 0; } 
        $(this).tipTip({
            defaultPosition: "top",
            maxWidth: 'auto',
            edgeOffset: offset,
            content: text
        });            
    });
	
	// black and white effect
	if (jQuery.isFunction(jQuery.fn.BlackAndWhite)){
// 		jQuery.fn.horizontalCenter = function (width) {
// 		    this.css("position","absolute");
// 			    this.css("left", Math.max(0, ((width - this.outerWidth()) / 2) ) + "px");
// 			    return this;
// 		}
		
		$('.bwWrapper').BlackAndWhite({
			hoverEffect : true, // default true
			// set the path to BnWWorker.js for a superfast implementation
			webworkerPath : false,
			// for the images with a fluid width and height 
			responsive:true,
			speed: { //this property could also be just speed: value for both fadeIn and fadeOut
				fadeIn: 200, // 200ms for fadeIn animations
				fadeOut: 300 // 800ms for fadeOut animations
			}
		});

		$("a.bwWrapper[href='#']").click(function(){ return false });
		
        $(".service-wrapper").each(function(){
	   	  $(this).mouseenter(function () {
	          $(this).find('canvas').stop(true, true).fadeOut(300);
			  // horizontal center readmore
			  //$(this).find('.read-more ').horizontalCenter($(this).find('.service').width());
          });
          $(this).mouseleave(function () {
	          $(this).find('canvas').stop(true, true).fadeIn(200);
          });
		});
	}

});
