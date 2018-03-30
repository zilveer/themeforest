/* --- 404 Page --- */
var gifImages = [
	"//media2.giphy.com/media/UslGBU1GPKc0g/giphy.gif",
	"//i.imgur.com/8ZYNp.gif",
	"//cdn.makeagif.com/media/9-04-2014/LqSsUg.gif"
];

function getGif() {
	return gifImages[Math.floor(Math.random() * gifImages.length)];
}

function changeBackground() {
	$('.error404').css('background-image', 'url(' + getGif() + ')');
}

$(window).on('load', function () {
	if ( $('.error404').length ) {
		$html.addClass('page404');
		changeBackground();
	} else {
		$html.removeClass('page404');
	}
});

$(window).keydown(function (e) {
	if (e.keyCode == 32) {
		changeBackground();
	}
});