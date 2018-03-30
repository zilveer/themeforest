/* 
*
* Quick social buttons share snippets
*
*
*/
	
jQuery('.share-options a').click(function(e) {
	e.preventDefault();
});

// Linkedin
function LinkedinShare(){
	window.open( 'http://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(location.href)+'$title='+jQuery("h2.entry-title").text(), 
		'linkedinWindow', 
		'width=650,height=450, resizable=1');
	return false;
}

// Facebook
function FacebookShare(){
	window.open( 'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
		'facebookWindow', 
		'width=650,height=350');
	return false;
}	

// Twitter
function TwitterShare(){
	window.open( 'http://twitter.com/intent/tweet?text='+jQuery("h2.entry-title").text() +' '+window.location, 
		"twitterWindow", 
		"width=650,height=350" );
	return false;
}
// Pinterest
function PinterestShare(){
	window.open( 'http://pinterest.com/pin/create/bookmarklet/?media='+ jQuery('.post-thumbnail img').first().attr('src') + '&description='+jQuery('h2.entry-title').text()+' '+encodeURIComponent(location.href), 
		'pinterestWindow', 
		'width=750,height=430, resizable=1');
	return false;
}
// Google Plus
function GoogleShare(){
	window.open( 'https://plus.google.com/share?url='+encodeURIComponent(location.href), 
		'googleWindow', 
		'width=500,height=500');
	return false;
}	
