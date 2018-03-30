
/* :: 	Twitter	Feed						      
---------------------------------------------*/

(function($) {
	
	"use strict";

	// Call back function
	function tweet_callback( data ) {
				
		// Loop through the data from twitter
		jQuery.each( data, function( i, tweet ) {
		
			// Make sure the text isn't undefined
			if( tweet.text != undefined ) {
				
				text = tweet.text.toString().replace( /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, '<a href="$1">$1</a>' ).replace( /(^|\s)@(\w+)/, '<a href="http://www.twitter.com/$2">@$2</a>' ).replace( /[#]+[A-Za-z0-9-_]+/ig, function(t) { var tag = t.replace("#","%23"); return t.link("http://search.twitter.com/search?q="+tag); } );
					
				
				jQuery( "#tweet_container" ).append( "<span>" + text + "</span>");
					
				jQuery('#tweet_container').cycle({ // Cycle through tweets
					fx: 'scrollDown',
					speed: 800,
					timeout: 10000,
					easing: 'easeInOutBack',
					cleartype:  true,
					cleartypeNoBg:  true
				});
			}
		});
	}
	
	jQuery(document).ready(function() 
	{
		tweet_callback( TWITTERFC.twitter_data );
	
	});
	
})(jQuery);