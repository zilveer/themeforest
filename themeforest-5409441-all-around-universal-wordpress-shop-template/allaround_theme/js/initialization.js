(function($){
"use strict";





/*			PrettyPhoto			*/

$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto();
});


/*		Carousel Slider			*/
$(document).ready(function(){
	var footerLinks = $( "#mycarousel" );
	var visibleItems = footerLinks.children().length;
	if ( visibleItems > 4 ) { visibleItems = 5; }
	$("#mycarousel").rcarousel({
		margin: 50,
		visible: visibleItems,
		step: 1,
		width: 60,
		height: 60,
		navigation : {
			prev: "#ui-carousel-prev",
			next: "#ui-carousel-next"
			}

	});

	$("#ui-carousel-next").add("#ui-carousel-prev").hover(
			function() {
				$( this ).css( "opacity", 0.7 );
			},
			function() {
				$( this ).css( "opacity", 1.0 );
			}
		);


	var clientLinks = $( "#rcarousel2" );
	var visibleClients = clientLinks.children().length;
	if ( visibleClients > 4 ) { visibleClients = 5; }

	$("#rcarousel2").rcarousel({
		margin: 20,
		visible: visibleClients,
		step: 1,
		width:160,
		height: 45,
		navigation : {
			prev: "#rcarousel2-prev",
			next: "#rcarousel2-next"
			}

	});

	$("#rcarousel2-next" ).add( "#rcarousel2-prev").hover(
			function() {
				$( this ).css( "opacity", 0.7 );
			},
			function() {
				$( this ).css( "opacity", 1.0 );
			}
		);
});



/*				Zoom			*/

$(document).ready(function(){
	$('.zoom_wrap img.content_image').wrap('<span style="display:block;"></span>').css('display', 'block').parent().zoom({duration:370});
});





})(jQuery);