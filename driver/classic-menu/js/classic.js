
jQuery(document).ready(function ($) {

	$wrap = $('.classic-menu');
	$menu = $wrap.find('>ul');
	
	var menu_height = $menu.outerHeight(true);
	$wrap.height(menu_height);	

	var site_url = $wrap.data('site_url');
	var site_name = $wrap.data('site_name');
	var logo_url = $wrap.data('logo');
	var logo_page_url = $wrap.data('logo_page');
	var retina_logo_url = $wrap.data('retina_logo');
	var logo_mini_url = $wrap.data('logo_mini');
	var logo_align = $wrap.data('logo_align');

	// add class ready when classic menu is ready.
	$(window).load( function() { $('.classic-menu').addClass('ready'); });
	// activate responsiveness to classic menu.
	
	if($('html').hasClass('no-touch')) {
		$(window).on('load resize', responsiveMenu);
	}else{
		$(window).on('load', responsiveMenu);
	}
	
	// function that activate responsiveness
	function responsiveMenu() {
		if( $(window).width() < 1144 ) {
			$('.classic-menu').addClass('responsive').removeClass('mini');
			
			if(logo_mini_url != '') {
		    	$('.classic-menu').find('.classic-menu-logo').attr('src', logo_url);
	    	}
				    	
			if( $('.responsive-header').length < 1  ) { 
				$('<div class="responsive-header"><a class="sandwich-icon fa fa-bars"></a></div>').prependTo('.classic-menu');
				$('.classic-menu.responsive .hotlink').first().addClass('first-hotlink');
				$('.classic-menu.responsive .hotlink').last().addClass('last-hotlink');
				var hotlinksCount = $('.classic-menu.responsive .hotlink').length;
				var hotlinkWidth = (100 - ((parseInt(hotlinksCount) - 2)*10)) /2;
				if( hotlinksCount > 2 ) $('.classic-menu.responsive .hotlink.first-hotlink, .classic-menu.responsive .hotlink.last-hotlink').attr('style', 'width: ' + hotlinkWidth + '% !important' );
				if( hotlinksCount == 1 ) $('.classic-menu.responsive .hotlink, .classic-menu.responsive .hotlink a').attr('style', 'width: 100% !important; text-align:center !important;' );

			}
			$('.sandwich-icon').off().on('click', function(e) {
				e.preventDefault();
				if( $('.classic-menu').is('.visible') ) { $('.sandwich-icon').removeClass('opened'); $('.classic-menu').removeClass('visible'); return false; }
				else { $('.sandwich-icon').addClass('opened'); $('.classic-menu').addClass('visible'); }
			});
			$('.classic-menu li a').off().on('click', function(e) {
				// when we click in a first level
				if($(this).parent().parent().parent('.classic-menu').length > 0) $('.classic-menu li').removeClass('active');
				// toggle in all case active class
				$(this).closest('li').toggleClass('active');

			});
		} else {
			$('.classic-menu').removeClass('responsive');
			$('.classic-menu .hotlink').attr('style', '');
			$('.classic-menu .responsive-header').remove();

		}	
		
		setTimeout(function() {
			calculateTopPadding();
		},450);
		

	}

		

	function calculateTopPadding() {

		if(!$('.classic-menu').hasClass('responsive')) {
			
			if($wrap.hasClass('fixed_before')) {
				//$('#pusher').css('padding-top', parseInt(menu_height) + parseInt($wrap.css('margin-top').replace('px', '')) + 'px');
				$('#wrapper').css('padding-top', $wrap.outerHeight(true) + 'px');
				// $('#pusher').css('margin-bottom', $wrap.outerHeight(true) + 'px');
			}
			
			if($wrap.hasClass('absolute_before')) {
				// $('#pusher').css('padding-top', parseInt(menu_height) + parseInt($wrap.css('margin-bottom').replace('px', '')) + parseInt($wrap.css('margin-top').replace('px', '')) + 'px');
				$('#wrapper').css('padding-top', $('.classic-menu').outerHeight(true) + 'px');
			}
			
					
			var forcedheight = $(window).height();
			$("#pusher").height(forcedheight);
		
		}else{
			$('#wrapper').css('padding-top', '');
		}

	}
	
	function fixLogoMargin() {
		
		if($('.classic-menu > ul > li.logo').hasClass('pull-center') || $('.classic-menu > ul > li.logo').hasClass('pull-top')) 
			return false;
			
		var itemHeight = $('.classic-menu > ul > li').not('.logo').first().outerHeight(true);
    	var logoHeight = $('.classic-menu > ul > li.logo a').height();
    	var marginTop = (itemHeight / 2) - (logoHeight / 2);
    	$('.classic-menu > ul > li.logo a').css('margin', marginTop+'px 0 0');
	}
		
	$(window).on('load', function() {

		var total_items = $menu.find('>li:not(".hotlink")').length;
		var middle = Math.ceil(total_items / 2);
		
		
		// Activate Mini menu.
		var lastScrollTop = 0;
	
		if($('html').hasClass('no-touch')) {
		
			$('#pusher').on('scroll touchmove', function (e) {
			   	var offset = $(this).scrollTop();
			   	var st = $(this).scrollTop();
		
		       	if( ( $('.classic-menu').hasClass('mini-active') || $('.classic-menu').hasClass('mini-fullwidth-active') ) && !$('.classic-menu').hasClass('responsive')) {
			   		if (offset > 150) {
				    	$('.classic-menu').addClass('mini');
				    	if(logo_mini_url != '') {
					    	$('.classic-menu').find('.classic-menu-logo').attr('src', logo_mini_url);
				    	}

				    }
				    if (offset <= 150) {
				    	$('.classic-menu').removeClass('mini');
				    	if(logo_mini_url != '') {
							$('.classic-menu').find('.classic-menu-logo').attr('src', logo_url);
				    	}
				    }
				    	
			    	fixLogoMargin();
			    	
				}
				lastScrollTop = st;
				
				$('.classic-menu').css('height', '');
		
			});
			
			setTimeout(function() {
				fixLogoMargin();	
			},450);
	
			
			$('#pusher').on('scrollstop', function() {
				calculateTopPadding();
			});
		}	
		

		calculateTopPadding();

				
		if(logo_page_url != '' && !$('.classic-menu').hasClass('responsive')) {
			logo_url = logo_page_url;
		}
		
		if(logo_url) {
			
			var $logo = $('<li class="logo '+logo_align+'"><a href="'+site_url+'"><img class="classic-menu-logo" src="'+logo_url+'" data-at2x="'+retina_logo_url+'" alt="'+site_name+'"></a></li>');
		
		}else{
			
			var $logo = $('<li class="logo '+logo_align+'"><a href="'+site_url+'">'+site_name+'</a></li>');
		}	
		
		
		$menu.find('>li').eq(middle).before($logo);
		setTimeout( function() {
		if( logo_align == 'pull-top' ) {
					$logo.css('margin-left', -parseInt($logo.width()/2) + 'px' );
				}
			}, 100 );
		
		// Collision: avoid submenu to be out of viewport.
		$menu.find('>li a').on('mouseover', function(e) {
			// check if has submenu
			if( $(this).find(' + ul').length > 0 ) {
				// var zI = 1;
				var $_this = $(this).find(' + ul');
				if( $_this.outerWidth(true) + $_this.offset().left > $(window).width() ) {
					// $_this.css('zIndex', zI++);
					$(this).parent().addClass('collision');
				}
			}
	
		});
		
		// hotlinks
		$hotlinks = $wrap.find('.classic-menu-hot-links');
		if($hotlinks.length > 0) {
			
			var links = $hotlinks.html();
			$hotlinks.detach();
			
			$menu.append(links);
			
		}
	
	});
});