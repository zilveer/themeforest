

jQuery(document).ready(function() {
	
	// For widget category list dotted line
	jQuery(".widget ul li .seperator").each(function() {
		var thisel = jQuery(this);
		var lisize = parseInt(thisel.parent().css("width"));
		var asize = parseInt(thisel.parent().children("a").css("width"))+10;
		var spansize = parseInt(thisel.parent().children("span").css("width"))+10;
		if(!spansize){
			thisel.css("display", "none");
		}else{
			thisel.css("left", (asize)+"px").css("width", (lisize-spansize-asize)+"px");
		}
	});

	// For featured header product slider
	jQuery(".header .header-featured ul.header-featured-blocks").each(function() {
		var thisel = jQuery(this);
		var featurednavi = '';
		thisel.children("li").eq(0).addClass("active");
		thisel.children("li").each(function() {
			if(jQuery(this).index() == 0)
				featurednavi += '<li class="active"><a href="#">'+jQuery(this).index()+'</a></li>';
			else
				featurednavi += '<li><a href="#">'+jQuery(this).index()+'</a></li>';
		});
		thisel.parent().children(".header-featured-navi").html(featurednavi);
	});

	jQuery(".header .header-featured-navi li a").click(function() {
		var thisel = jQuery(this).parent();
		thisel.siblings("li").removeClass("active");
		thisel.addClass("active");
		thisel.parent().parent().children(".header-featured-blocks").children("li").eq(thisel.index()).addClass("active").siblings("li").removeClass("active");
		return false;
	});

	// Alert box close
	jQuery('a[href="#close-alert"]').click(function() {
		jQuery(this).parent().animate({
			opacity: 0,
			padding: "0px 13px",
			margin: "0px",
			height: "0px"
		}, 300, function() {
			// Animation complete.
		});
		return false;
	});


	// Widget photo gallery navigation
	jQuery('a[href="#gal-next"]').click(function() {
		var thisel = jQuery(this);
		var thislist = thisel.parent().children('ul');
		var currentel = thisel.parent().children('ul').children('li.active').index();

		thisel.parent().children('ul').children('li').removeClass("active").removeClass("next").removeClass("prev");
		thisel.parent().children('ul').children('li').eq(currentel).addClass("prev");

		currentel = (currentel > thislist.length+1) ? 0 : currentel + 1;
		var prevel = (currentel > thislist.length+1) ? 0 : currentel + 1;

		thisel.parent().children('ul').children('li').eq(currentel).addClass("active");
		thisel.parent().children('ul').children('li').eq(prevel).addClass("next");
		return false;
	});

	jQuery('a[href="#gal-prev"]').click(function() {
		var thisel = jQuery(this);
		var thislist = thisel.parent().children('ul');
		var currentel = thisel.parent().children('ul').children('li.active').index();

		thisel.parent().children('ul').children('li').removeClass("active").removeClass("next").removeClass("prev");
		thisel.parent().children('ul').children('li').eq(currentel).addClass("prev");

		currentel = (currentel+1 == 0) ? thislist.length-1 : currentel - 1;
		var prevel = (currentel+1 == 0) ? thislist.length+1 : currentel - 1;

		thisel.parent().children('ul').children('li').eq(currentel).addClass("active");
		thisel.parent().children('ul').children('li').eq(prevel).addClass("next");
		return false;
	});

	jQuery('.widget-gallery .gallery-photos ul, .main-thumb-gallery .gallery-photos ul').each(function() {
		var thisel = jQuery(this).children('li');
		thisel.eq(0).addClass('active');
		thisel.eq(1).addClass('next');
	});


	// Tabbed blocks
	jQuery(".tabs").each(function() {
		var thisel = jQuery(this);
		thisel.children("div").css("min-height", (parseInt(thisel.css("height"))-30)+"px");
		thisel.children("div").eq(0).addClass("active");
		thisel.children("ul").children("li").eq(0).addClass("active");
	});

	jQuery(".tabs > ul > li a").click(function() {
		var thisel = jQuery(this).parent();
		thisel.siblings(".active").removeClass("active");
		thisel.addClass("active");
		thisel.parent().siblings("div.active").removeClass("active");
		thisel.parent().siblings("div").eq(thisel.index()).addClass("active");
		return false;
	});


	// Accordion blocks
	jQuery(".accordion > div > a").click(function() {
		var thisel = jQuery(this).parent();
		if(thisel.hasClass("active")){
			thisel.removeClass("active");
			return false;
		}
		thisel.siblings("div").removeClass("active");
		thisel.addClass("active");
		return false;
	});

	jQuery(".lightbox").click(function () {
		jQuery(".lightbox").css('overflow', 'hidden');
		jQuery("body").css('overflow', 'auto');
		jQuery(".lightbox .lightcontent").fadeOut('fast');
		jQuery(".lightbox").fadeOut('slow');
	}).children().click(function(e) {
		return false;
	});

	jQuery(".main-menu > .wrapper > ul").append('<li class="mobile-menu"><a href="#showphonemenu">Toggle Menu</a></li>');

	jQuery('a[href="#showphonemenu"]').click(function() {
		var thisel = jQuery(this);
		thisel.parent().parent().toggleClass('openmenu');
		return false;
	});
	
	startTimer();

});



function lightboxclose(){
	jQuery(".lightbox").css('overflow', 'hidden');
	jQuery(".lightbox .lightcontent").fadeOut('fast');
	jQuery(".lightbox").fadeOut('slow');
	jQuery("body").css('overflow', 'auto');
}


function startTimer(){
	setInterval(function(){
	jQuery(".countdown-text").each(function (){
		var currentTime = jQuery(this).attr("rel");
		var seconds = new Date().getTime() / 1000;
		var seconds = Math.floor(seconds);
		if(currentTime > seconds){
			jQuery(this).html(secondsToHms(currentTime-seconds));
		}else{
			jQuery(this).css("color", "#e62d24");
			jQuery(this).html("00:00:00:00");
		}
	})}, 1000);
}

function addZero(number){
	if(number.toString().length == 1){
		return "0"+number;
	}else{
		return number;
	}
}

function secondsToHms(d) {
	d = Number(d);
	var h = Math.floor(d / 3600);
	var days = addZero(Math.floor(h / (24)));
	var h = addZero(Math.floor((d / 3600)-(days*24)));
	var m = addZero(Math.floor(d % 3600 / 60));
	var s = addZero(Math.floor(d % 3600 % 60));
	return days+":"+h+":"+m+":"+s;
}

