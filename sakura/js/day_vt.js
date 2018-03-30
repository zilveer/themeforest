$(function() {
    $('.shadow_light, .shadow_dark, .alignnone, .alignleft, .alignright, .aligncenter, .media_video').each(function() {
        if ( $.browser.msie && PIE && PIE.attach ) PIE.attach(this);
    });
});


$(document).ready(function() {

});

Cufon('#nav > li > a', {
	color: '-linear-gradient(#272727, #1d1d1d)', textShadow: '1px 1px #fff',
	hover: {
		color: '-linear-gradient(#414141, #606060)', textShadow: '1px 1px #fff'
	}
});

Cufon('#about', {
	color: '-linear-gradient(#272727, #1d1d1d)', textShadow: '1px 1px #fff'
});

Cufon('h1, h2, h3, h4, h5, h6, .quote_author', {
	color: '-linear-gradient(#282828, #1d1d1d)', textShadow: '1px 1px #fff'
});

Cufon('.post_type div, .post_type span, .header', {
	color: '-linear-gradient(#fff, 0.4=#e8eaeb, #b0b5b8)', textShadow: '1px 1px #000'
});

Cufon('#footer .header', {
	color: '-linear-gradient(#3f3f3f, #707375)', textShadow: '-1px -1px #000'
});

Cufon('.slot ul li a h4', {
	color: '-linear-gradient(#fff, 0.4=#e8eaeb, #b0b5b8)', textShadow: '1px 1px #000'
});
