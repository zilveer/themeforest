
/* --- 404 Page --- */
var gifImages = [
	"//i.imgur.com/c9X6n.gif",
	"//i.imgur.com/eezCO.gif",
	"//i.imgur.com/DYO6X.gif",
	"//i.imgur.com/9DWBx.gif",
	"//i.imgur.com/8ZYNp.gif",
	"//media1.giphy.com/media/vonLA9G2VvENG/giphy.gif",
	"//media2.giphy.com/media/UslGBU1GPKc0g/giphy.gif",
	"//media.giphy.com/media/LD0OalPb8u8Le/giphy.gif",
]

function getGif(){
	return gifImages[Math.floor(Math.random()*gifImages.length)];
}

function changeBackground(){
	$('.error404').css('background-image', 'url('+getGif()+')');
}


if($('.error404').length){
	changeBackground();
}

$(window).keydown(function(e){
	if(e.keyCode == 32){
		changeBackground();
	}
})
