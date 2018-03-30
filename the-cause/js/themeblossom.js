/* Theme Blossom - Custom scripts */
jQuery(document).ready(function($) {
	dropdownMenu();
	
	// blockquote
	$('blockquote, #sidebar .quote').each(function() {$(this).find('p').eq(0).addClass('first');});
	$('blockquote, #sidebar .quote').append('<span class="rightQuote"></span>');
	
	// noBorder, noPadding, noMargin divs
	$('#news .wide:last, #contactExtra ul li:last, #news .row:last, .fullWidth .issuesThumbs:last > div, #innerHome .news:last').addClass('noborder');
	$('#events #inner > div.eventHolder:last .horDashed').addClass('nodisplay');
	
	$('#galleryThumbs .thumbHolder:nth-child(3n), #gallery.eventGallery .thumbHolder:nth-child(3n)').addClass('last');
	$('ul.noliststyle').each(function() {
		$(this).children('li:last').addClass('last');
	});
	
	$('#main .evenHolder:last').addClass('last');
	$('#inner.woocommerce .woocommerce-tabs ul.tabs li:last').addClass('last');
	$('#inner.woocommerce .woocommerce-tabs .panel tr:even').addClass('even');
	$('.cart_totals table tr:even').addClass('even');
	
	$('#sidebar').append('<div class="horShadow"></div>');
	$('#sidebar input[type=submit]').addClass('tinyButton').addClass('roundButton').wrap('<p class="center"></p>');
	
	if ($('#landing').hasClass('width100')) {
		var windowHeight = $(window).height();
		var landingHeight = $('#landing > div').height();
		var landingH1Height = $('#landing h1').height();
		
		dif = windowHeight - landingHeight;
		
		padding = Math.floor((50 + dif - landingH1Height) / 2);
		
		$('#landing #logo').css({'paddingBottom': padding});
	}
	
	$('#content .wp-caption').each(function() {
		$(this).wrapInner('<div></div>');
	});
	
	// FAQ
	$('.faq div, .faq2 div').hide();
	$('.faq h4').click(function() {
		if ($(this).parent().hasClass('inactive')) {
			$(this).parent().removeClass('inactive').addClass('active');
			$(this).siblings('div').slideDown('slow');
		} else {
			$(this).parent().removeClass('active').addClass('inactive');
			$(this).siblings('div').slideUp('slow');
		}
	});
	$('.faq2 h4').click(function() {
		if ($(this).parent().hasClass('inactive')) {
			$(this).parent().removeClass('inactive').addClass('active');
			$(this).siblings('div').slideDown('slow');
			$(this).parent().siblings().removeClass('active').addClass('inactive').children('div').slideUp('normal');
		} else {
			$(this).parent().removeClass('active').addClass('inactive');
			$(this).siblings('div').slideUp('slow');
		}
	});
	
	// Heights and widths
	$('.issuesThumbs').each(function() {
		var minHeight = 0;
		$(this).children('.issuesThumb').each(function() {
			if ($(this).height() > minHeight) {
				minHeight = $(this).innerHeight();
			}
		});
		minHeight = minHeight + 22;
		$(this).children('.issuesThumb').css({'height': minHeight});
	});
	
	$('#news .row').each(function() {
		var minHeight = 0;
		$(this).children('.news').each(function() {
			if ($(this).height() > minHeight) {
				minHeight = $(this).innerHeight();
			}
		});
		//minHeight = minHeight + 22;
		$(this).children('.news').css({'height': minHeight});
	});
	
		
	// effects for non-IE browsers
	if ( $.browser.msie != true ) {
		$('#logo, ul.footerSoc li a').hover(function() {
			$(this).animate({opacity: 0.75}, 600);
		}, function() {
			$(this).animate({opacity: 1}, 600);
		});
	}
	
	// IE prior 10
	if ( $.browser.version < 10 ) {
		$('.roundButton').each(function() {$(this).removeClass('roundButton');})
		$('.roundButtonX').each(function() {$(this).removeClass('roundButtonX');})
	}
});

/* SPECIAL */
jQuery(document).ready(function($) {
	$('#footer .grid_3 .photos:last').addClass('nopadding nobckg');
	$('#footer .quote p:first').prepend('"');
	$('#footer .quote p:last').append('"');
	
	$('#bottomNav ul').append('<li><a href="#top" class="scroll" title="Back to top">Back to top</a></li>');
	
	$('#sidebar .cwu:first').addClass('first');
	$('#sidebar .cwu:last > div').addClass('noborder');
	$('#sidebar .box:last').addClass('last');

	$('#sidebar .widget div div').each(function() {$(this).find('.listPost:last').addClass('noborder');});
	
	$('#sidebar .widget').each(function() {
		$title = $(this).children('div').children('h3').text();
		
		if ($title) {
			$(this).children('div').children('h3').nextUntil('.clear.nodisplay').wrapAll('<div />');
		} else {
			$(this).children('div').wrapInner('<div />');
		}
		
	});
});

/* SMOOTH SCROLLING */
jQuery(document).ready(function($) {	
    $('.scroll').bind('click',function(event){
        var $anchor = $(this); 
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1000);
        event.preventDefault();
    });
});

/* PRETTY PHOTO, DOUBLE FRAMED THUMBNAILS, GALLERY PAGE */
jQuery(document).ready(function($) {
	$(".doubleFramed a, #shopWidget > a, a.thumb, .flickr_badge_image a").append('<span class="paperClip"></span>');

	$('a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], .singleItem .thumb a').each(function()
	{
		if(!$(this).attr('rel') != undefined && !$(this).attr('rel') != '')
		{
			$(this).attr('rel', 'prettyPhoto');
			
		} 

		if ($(this).children('img').hasClass('alignleft')) {
			$(this).addClass('alignleft');
		}

		if ($(this).children('img').hasClass('alignright')) {
			$(this).addClass('alignright');
		}

		if ($(this).children('img').hasClass('aligncenter')) {
			$(this).addClass('aligncenter');
		}
		
		var width = $(this).children('img').width();
		var height = $(this).children('img').height();
		$(this).css({'display': 'block', 'width': width, 'height': height});
		$(this).append('<span class="magnifier"></span>');
	});
	
	$('a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"]').each(function()
	{ 

		if ($(this).parent().parent().hasClass('cwu')) {
			// do nothing
		} else {
			if(!$(this).attr('rel') != undefined && !$(this).attr('rel') != '')
			{
				$(this).attr('rel', 'prettyPhoto');
			}
			$(this).append('<span class="play"></span>');
		}

	});
	
	$('#gallery .thumbHolder .thumb a').each(function() {
		if ($(this).attr('rel') == 'prettyPhoto') {
			$(this).attr('rel', 'prettyPhoto[gallery]');
		}
	});
	
	$('#gallery #slider a').each(function() {
		if ($(this).attr('rel') == 'prettyPhoto') {
			$(this).attr('rel', 'prettyPhoto[slider]');
		}
	});
	
	
	$("a[rel^='prettyPhoto'], .doubleFramed a, #shopWidget > a, a.thumb, .flickrWidget a, #inner.woocommerce .images a").hover(function() {
		$(this).children('img').animate({opacity: 0.5}, 400);
	}, function() {
		$(this).children('img').animate({opacity: 1}, 400);
	});
	
	$("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'normal',
			slideshow: 4000,
			autoplay_slideshow: false,
			theme: 'facebook'
	});
	
	$('#home #slider .slide').each(function () {
		$(this).append('<span class="paperClip"></span>');
	});
	
	$('#home #slider .slide a').hover(function() {
		$(this).siblings('img').animate({opacity: 0.5}, 400);
	}, function() {
		$(this).siblings('img').animate({opacity: 1}, 400);
	});
	
	$('.eventFrame a, .frame a').hover(function() {
		$(this).siblings('span.image').animate({opacity: 0.5}, 400);
	}, function() {
		$(this).siblings('span.image').animate({opacity: 1}, 400);
	});
	
	$('.videoPagination li a').hover(function() {
		if (!$(this).parent().hasClass('current')) {
			$(this).children().animate({opacity: 1}, 400);
		}		
	}, function() {
		if (!$(this).parent().hasClass('current')) {
			$(this).children().animate({opacity: 0.5}, 400);
		}		
	});
	
	$('.videoPagination li a').click(function() {
		$(this).parent().siblings().children('a').children().animate({opacity: 0.5}, 400);
	});
});

/* DROPDOWN */
function dropdownMenu()
{
	jQuery("ul.navigation ul ").css({display: "none"});
	jQuery("ul.navigation li").each(function()
	{			
		var dropdownMenu = jQuery(this).find('ul:first');
		
		jQuery(this).hover(function()
		{	
			dropdownMenu.stop().css({overflow:"hidden", height:"auto", display:"none"}).slideDown(400, function()
			{
				jQuery(this).css({overflow:"visible", height:"auto"});
			});	
		},
		function()
		{	
			dropdownMenu.stop().slideUp(400, function()
			{	
				jQuery(this).css({overflow:"hidden", display:"none"});
			});
		});	
	});
}


/* CONTACT FORMS */
/* validate email */
function isValidEmail(email){
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(email);
}

jQuery(document).ready(function($) {
	/* Subscribe Form */
	$('form#newsletterForm').submit(function() {
	
		var sendingError = false;

		var tbSenderEmail = $("form#newsletterForm input#email").val();
		
		if (jQuery.trim(tbSenderEmail) == "" || jQuery.trim(tbSenderEmail) == "Email" || jQuery.trim(tbSenderEmail) == "EMAIL" || !isValidEmail(tbSenderEmail)) {
			$(this).children('p').children('span').fadeIn(1500).delay(800).fadeOut(1500);
			$(this).children('p').children('#email').attr('val', '').focus();
			sendingError = true;
		}
		
		if (!sendingError) {
			$.post($("#newsletterForm").attr('action'), $("#newsletterForm").serialize(), function(data) {
				$("#newsletterForm").fadeOut(900);
				$('#signUpSuccess').html(data).delay(900).fadeIn(900);				
			});
			
			
		}
		return false;
	});

	// Contact Form
	$('form#contactForm').submit(function() {
	
		var sendingError = false;

		var tbSenderEmail = $("form#contactForm input#email").val();
		var tbMessage = $("form#contactForm textarea#message").val();
		
		if (jQuery.trim(tbSenderEmail) == "" || jQuery.trim(tbSenderEmail) == "Your Email Address..." || !isValidEmail(tbSenderEmail)) {
			$(this).children('p').children('#email').siblings('span').fadeIn(1500).delay(800).fadeOut(1500);
			$(this).children('p').children('#email').focus();
			sendingError = true;
		}
		
		if (jQuery.trim(tbMessage) == "" || jQuery.trim(tbMessage) == "Your Message...") {
			$(this).children('p').children('#message').siblings('span').fadeIn(1500).delay(800).fadeOut(1500);
			sendingError = true;			
		}
		
		
		if (!sendingError) {
			$('#contactForm .buttons input').fadeOut('normal', function(){
				$('form#contactForm .ajaxLoader').fadeIn('fast');			
			});
			
			$.post($("#contactForm").attr('action'), $("#contactForm").serialize(), function(data){
				$('#contactFormResult').html(data);
				$('form#contactForm .ajaxLoader').remove();
				$('#contactForm').fadeOut('slow');
				$('#contactFormResult').delay(100).fadeIn();
			});
			
			
		}
		
		return false;
	});
});

/* Woo Commerce Plugin */
jQuery(document).ready(function($) {
	$('#tbWooCommerce form#getInvolvedForm input').click(function() {
		var pid = $(this).val();
		var permalink = $('form#getInvolvedForm input[type=hidden]').val();
		var action = permalink + '?add-to-cart=' + pid;
		$('form#getInvolvedForm').attr('action', action);
	});

	$('#inner.woocommerce .button, #tbWooCommerce .button').removeClass('button').addClass('tinyButton').addClass('roundButton').addClass('right');
	
	$('p.buttons').addClass('center');
	
	$('ul.products li').each(function() {
		$(this).children('a:first').addClass('imagesLink');
	});
	
	$('ul.products li a.imagesLink img').after('<span class="paperClip"></span>');
	$('ul.products li a.imagesLink').hover(function() {
		$(this).children('img').animate({opacity: 0.6}, 400);
	}, function() {
		$(this).children('img').animate({opacity: 1}, 400);
	});
	
	$('#sidebar.shopSidebar .button, #sidebar.shopSidebar .bigButton').addClass('roundButton').removeClass('button').removeClass('bigButton').addClass('tinyButton');
	
	$('#inner.woocommerce .navigation div a').addClass('tinyButtonExtra').addClass('roundButton');
});


// Easy WordPress Donations
jQuery(document).ready(function($) {
	$('form.ewd_form input[type=submit]').addClass('tinyButton');

});

// Contact Form 7
jQuery(document).ready(function($) {
	$("form.wpcf7-form").attr("id", "contactForm");
	$("form.wpcf7-form input[type=submit]").addClass('tinyButton');
});

// Slider Revolution
jQuery(document).ready(function($) {
	$('.tparrows2').each(function() {
    	if ($(this).css('visibility') == 'hidden') {
			alert('hej');
      	  	$(this).addClass('nodisplay');
    	}
	});
});