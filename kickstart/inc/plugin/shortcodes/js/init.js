jQuery(document).ready(function($) {
	
	// Testimonials
	var el = $('.testimonials-slider .testimonial-wrapper'),
    F = 1200,   // FADE TIME
    P = 8000,  // PAUSE TIME
    S = -1;    // START el (will turn 0 after initial kick)
    H = -1;    // START el (will turn 0 after initial kick)

	function a(){el.eq(++S%el.length).fadeTo(F,1).siblings(el).stop(1).fadeTo(600,0);
	var slider_height = el.eq(++H%el.length).height();
	$('.testimonials-slider').animate({height: slider_height },800);}
	a();

	setInterval(a, P);
	
	// Spoiler
	$('.su-spoiler .su-spoiler-title').click(function() {

		var // Spoiler elements
		spoiler = $(this).parent('.su-spoiler').filter(':first'),
		title = spoiler.children('.su-spoiler-title'),
		content = spoiler.children('.su-spoiler-content'),
		isAccordion = ( spoiler.parent('.su-accordion').length > 0 ) ? true : false;

		if ( spoiler.hasClass('su-spoiler-open') ) {
			if ( !isAccordion ) {
				content.slideUp(200);
				spoiler.removeClass('su-spoiler-open');
			}
		}
		else {
			spoiler.parent('.su-accordion').children('.su-spoiler').removeClass('su-spoiler-open');
			spoiler.parent('.su-accordion').find('.su-spoiler-content').slideUp(200);
			content.slideDown(200);
			spoiler.addClass('su-spoiler-open');
		}
	});
	
	//Skills Bar Animation (Licensed under a Creative Commons Attribution 3.0 License. www.jenniferperrin.com)
    $('.skillbar-wrapper').each(function(){
        var t = $(this),
        dataperc = t.attr('data-perc');
        t.find('.skillbar').animate({width: dataperc + '%'}, dataperc*25);
    });

	// Tabs
	$('.su-tabs-nav').delegate('span:not(.su-tabs-current)', 'click', function() {
		$(this).addClass('su-tabs-current').siblings().removeClass('su-tabs-current')
		.parents('.su-tabs').find('.su-tabs-pane').hide().eq($(this).index()).fadeIn().parents('.su-tabs').find('.pane-title').removeClass('su-tabs-current').eq($(this).index()).addClass('su-tabs-current');
		var panes_height = $('.su-tabs-style-2 .su-tabs-panes').height();
		//$('.su-tabs-style-2 .su-tabs-nav-shadow').css('height', panes_height);
	});
	$('.su-tabs-pane').hide();
	$('.su-tabs-nav span:first-child, .su-tabs-panes .pane-wrapper:first-child .pane-title').addClass('su-tabs-current');
	$('.su-tabs-panes .pane-wrapper:first-child .su-tabs-pane').show();

	//var nav_height = $('.su-tabs-style-2 .su-tabs-nav').height(),
	//p_height = $('.su-tabs-style-2 .su-tabs-panes').height();
	//$('.su-tabs-style-2 .su-tabs-panes, .su-tabs-style-2 .su-tabs-nav-shadow').css('min-height', nav_height + 10);
	//$('.su-tabs-style-2 .su-tabs-nav-shadow').css('height', p_height);
	
	$('.pane-wrapper').delegate('.pane-title:not(.su-tabs-current)', 'click', function() {	
		var pane_wrapper = $(this).parent('.pane-wrapper').filter(':first'),
		pane_content = pane_wrapper.children('.su-tabs-pane'),
		pane_title = pane_wrapper.children('.pane-title');
		
		$(this).parents('.su-tabs').find('.su-tabs-nav').find('span').removeClass('su-tabs-current').eq($(pane_wrapper).index()).addClass('su-tabs-current');
		
		pane_wrapper.parent('.su-tabs-panes').find('.su-tabs-pane').slideUp(200)
		pane_wrapper.parent('.su-tabs-panes').find('.pane-title').removeClass('su-tabs-current');
		pane_content.slideDown(200);
		pane_title.addClass('su-tabs-current');
	});
	
	
	// Client logo hover effect
	$(window).load(function(){
		$(".client-wrapper img").fadeIn(700);
		
		// clone image
		$('.client-wrapper img').each(function(){
			var el = $(this);
			el.clone().addClass('img_grayscale').css({"position":"absolute","z-index":"998","opacity":"0"}).insertBefore(el).queue(function(){
				var el = $(this);
				el.dequeue();
			});
			this.src = grayscale(this.src);
		});
		
		// Fade image 
		$('.client-wrapper img').mouseover(function(){
			$(this).parent().find('img:first').stop().animate({opacity:1}, 1000);
		})
		$('.img_grayscale').mouseout(function(){
			$(this).stop().animate({opacity:0}, 1000);
		});		
	});
	
});

// Grayscale w canvas method
function grayscale(src){
	var canvas = document.createElement('canvas');
	var ctx = canvas.getContext('2d');
	var imgObj = new Image();
	imgObj.src = src;
	canvas.width = imgObj.width;
	canvas.height = imgObj.height; 
	ctx.drawImage(imgObj, 0, 0); 
	var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
	for(var y = 0; y < imgPixels.height; y++){
		for(var x = 0; x < imgPixels.width; x++){
			var i = (y * 4) * imgPixels.width + x * 4;
			var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
			imgPixels.data[i] = avg; 
			imgPixels.data[i + 1] = avg; 
			imgPixels.data[i + 2] = avg;
		}
	}
	ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
	return canvas.toDataURL();
}


// Carousel init	
function mycarousel_initCallback(carousel) {

	// Disable autoscrolling if the user clicks the prev or next button.
	carousel.buttonNext.bind('click', function() {
		carousel.startAuto(0);
	});

	carousel.buttonPrev.bind('click', function() {
		carousel.startAuto(0);
	});

	// Pause autoscrolling if the user moves with the cursor over the clip.
	carousel.clip.hover(function() {
		carousel.stopAuto();
	}, function() {
		carousel.startAuto();
	});
}