jQuery(document).ready(function($) {

	// fix @font-face chrome bug: https://code.google.com/p/chromium/issues/detail?id=336476
	jQuery('body').width(jQuery('body').width()+1).width('auto');
	
	// TinyNav
	$('#primary-nav-list').tinyNav({
		active: 'current-menu-item',
		target: '#tiny-nav .select-wrap'
	});

	// Navigation
	setSubNavPos();
	function setSubNavPos() {
    	$('#primary-nav ul ul ul').each(function(){
			$(this).css('left', $(this).parents('ul').width())
		});
	};

	var resizeTimer;
	$(window).resize(function() {
	    clearTimeout(resizeTimer);
	    resizeTimer = setTimeout(setSubNavPos, 100);
	});

	// Search
	$('#social-box li.search a').click(function(){
		$(this).parents('li').toggleClass('active');
		if( $(this).parents('li').hasClass('active') ) {
			$('input', $(this).parents('li')).focus();
		} else {
			$('input', $(this).parents('li')).focusout();
		}
	});

	// Fancybox
	$('a.fancy-image, .gallery a').fancybox({
		'padding': 5,
		'cyclic': true,
		'showCloseButton': false,
		'titlePosition': 'over'
	});
	$("a.fancy-youtube").click(function() {
		$.fancybox({
			'padding'       : 0,
			'showCloseButton': false,
			'title'         : this.title,
			'href'          : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/') + '?showinfo=0',
			'type'          : 'swf',
			'swf'           : {
				'wmode' : 'transparent',
			    'allowfullscreen' : 'true'
			}
		});

		return false;
	});
	$("a.fancy-vimeo").click(function() {
		$.fancybox({
			'padding'       : 0,
			'showCloseButton': false,
			'title'         : this.title,
			'href'          : this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
			'type'          : 'swf',
			'swf'           : {
				'wmode' : 'transparent',
			    'allowfullscreen' : 'true'
			}
		});

		return false;
	});

	// Link with ahref="#"
	$('a[href="#"]').click(function(e){
		e.preventDefault();
	});

	// Fitvids
	$('.post-content').fitVids();

	// Box
	$('.box .icon-times-circle').click(function(){
		$(this).parent('.box').fadeOut('fast');
	});

	// Tab
	$('.tabs-wrap').each(function(){
		var tab_group = $(this);
		$('.tabs li', tab_group).click(function(e){
			e.preventDefault();
			$('.tabs li', tab_group).removeClass('current');
			$(this).addClass('current');

			$('.panes .pane', tab_group).hide();
			$('.panes .pane', tab_group).eq($(this).index()).show();
		});

		// Trigger Initial Tab
		var initial_tab = parseInt( $('.tabs', this).data('active') );
		$('.tabs li', tab_group).eq(initial_tab).trigger('click');
	});

	// Accordion
	$('.accordions-wrap').each(function(){
		var acc_group = $(this);
		$('.tab', acc_group).click(function(){
			$('.tab', acc_group).not($(this)).removeClass('current');
			$(this).addClass('current');
			$(this).next('.pane').slideDown(200, 'linear');
			$('.pane', acc_group).not($(this).next('.pane')).slideUp(200, 'linear');
		});

		// Trigger Initial Tab
		var initial_tab = parseInt( $(this).data('active') );
		if( initial_tab >= 0 ) {
			$('.tab', acc_group).eq(initial_tab).addClass('current').next('.pane').show();
		}
	});

	// Toggle
	$('.toggle-wrap .tab').click(function(){
		$(this).toggleClass('current');
		$(this).siblings('.pane').slideToggle(200, 'linear');
	});
	$('.toggle-wrap').each(function(){
		if( $(this).data('state') == 'open' ) {
			$('.pane', $(this)).show();
		}
	});

	// Flickr
	$('.widget_flickr a').attr('target','_blank');

	// Lettering
	$('.sidebar .widget-title, #pre-footer .widget-title').lettering('words');

	// Widget
	$('.widget li').not('.disable-toggle').has('ul').addClass('has-child').each(function(){
		$('> a', $(this)).append('<i class="icon icon-angle-down"></i>');
	});
	
	$('.widget .current_page_ancestor').addClass('active');
	$('.widget .current_page_item').parents('li').addClass('active');
	$('.widget .current_page_item').has('ul').addClass('active');

	$('.widget .current_page_item').parents('ul').show();
	$('.widget .current_page_item ul').show();
	$('.widget .active ul').show();

	$('.widget li .icon-angle-down').click(function(){
		if( $('> ul', $(this).parents('li')).is(':visible') ) {
			$(this).parents('li').removeClass('active');
			$('> ul', $(this).parents('li')).slideUp('medium');
		} else {
			$(this).parents('li').addClass('active');
			$('> ul', $(this).parents('li')).slideDown('medium');
		}

		return false;
	});

	// Map
	$('.map-wrap').each(function() {
		var pane = $(this).siblings('.contact-pane');
		var markers = $(this).children();
		var defaults = {
			el: this,
			lat: 0,
			lng: 0,
			zoomControl : true,
			panControl : false,
			streetViewControl : false,
			mapTypeControl: false,
			overviewMapControl: false,
			scrollwheel: false,
			zoom: 6
		};
		var options = $.extend({}, defaults, $(this).data());
		var map = new GMaps(options);

		for (var i = 0; i < markers.length; i++) {
		  marker_data = $(markers[i]).data();
		  map.addMarker({
		  	lat: marker_data.lat,
		  	lng: marker_data.lng,
		  	title: marker_data.title,
		  	content: marker_data.content,
		  	click: function(e) {
		  		if(this.title == null) return;
		  		pane.empty();
		  		if(this.title) pane.append('<p class="title"><strong>'+this.title+'</strong></p>');
				if(this.content) pane.append(this.content);
				if(this.title || this.content) {
					pane.css('opacity', 0).css('margin-top', 10);
					pane.animate({opacity: 1, marginTop: '20px'}, 250);
				}
			}
		  });
		}
	});
    
	// Carousel
	$('.m-carousel').each(function(){
		var spp = $(this).data('slide-per-page');
		$(this).carousel({
			slidePerPage: spp
		});
	});
	$('.m-carousel-next').click(function(e){
		e.preventDefault();
		$(this).parent('.m-carousel-control').siblings('.m-carousel').carousel('next');
	});
	$('.m-carousel-prev').click(function(e){
		e.preventDefault();
		$(this).parent('.m-carousel-control').siblings('.m-carousel').carousel('prev');
		return false;
	});

	// Form
	$('.validate-form').each(function(){
		if( $(this).is('form') ) {
			var curForm = $(this);
		} else {
			var curForm = $('form', $(this));
		}
		$(curForm).validate({
			errorPlacement: function(error, element) {
				$('.form-response', curForm).html(error).fadeIn();
			}
		});
	});
	$('.ajax-form').ajaxForm({
		dataType: 'json',
		beforeSubmit: function(arr, $form, options){
			$('.form-response', $form).html('sending data …').fadeIn();
		},
		success: function(data, statusText, xhr, $form){
			$('.form-response', $form).html(data.response_text);
			$form[0].reset();
		}
	});

	// Slides
	$('.slides').each(function(){
		var cur_slides = $(this);
		var children = $(this).children();
		var defaults = {
			effect: 'fade',
			height: 940,
			height: 500,
			speed: 500,
			interval: 2000,
			autoplay: false,
			pagination: false
        };
        var options = $.extend({}, defaults, $(this).data());

        if( children.length <= 1 ) { $(this).show(); }

        if( children.length > 1 ){
        	$('.slide-content', cur_slides).hide();
        	$(this).slidesjs({
				width: options['width'],
				height: options['height'],
				pagination: {
					active: options['pagination']
				},
				play: {
					auto: options['autoplay'],
					effect: options['effect'],
					interval: options['interval'],
					pauseOnHover: true,
					restartDelay: options['interval']
				},
				navigation: {
		          effect: options['effect']
		        },
				effect: {
			      slide: { speed: options['speed'] },
			      fade: { speed: options['speed'] }
			    },
			    callback: {
			      loaded: function(number) {
			        $('.slide', cur_slides).eq(number-1).find('.slide-content').fadeIn(250);
			      },
			      start: function(number) {
			        $('.slide', cur_slides).eq(number-1).find('.slide-content').hide();
			      },
			      complete: function(number) {
						$('.slide', cur_slides).eq(number-1).find('.slide-content').fadeIn(250);
			      }
			    }
			});
        }
		
	});

	// Tweet
	$(".tweet").each(function(){
		var defaults = {
			modpath: '/assets/twitter/',
			extra_params: {action: 'do_tweet'},
			username: 'twitter',
	        count: 1,
	        loading_text: "",
	        template: "<i class='icon icon-twitter'></i> {text}"
        };
        var options = $.extend({}, defaults, $(this).data());
		$(this).tweet(options);
	});
	

	$(window).load(function(){

		// Mansonry
		$('.masonry-container').each(function(){
			var cols = $(this).data('cols');
			$(this).masonry({
				itemSelector: '.masonry-item',
				columnWidth: function( containerWidth ) {
					return containerWidth / cols;
				}
			});
		});

	    // Filter
	    $('.filter-wrap').each(function(){
	    	var filter_wrap = $(this);
	    	var filter_button_wrap = $(this).parents('.stack').find('.filter-button-list');
	    	var defaults = {
				itemSelector : '.filter-item',
				resizable : false,
				masonry: { columnWidth: filter_wrap.width()/$(this).data('cols') }
	        };
	        var options = $.extend({}, defaults, $(this).data());
	        $('.filter-wrap').isotope(options);

	        $('a.filter-button', filter_button_wrap).click(function(){
			  var selector = $(this).attr('data-filter');
			  $(this).parents('ul').find('.active').removeClass('active');
			  $(this).addClass('active');
			  filter_wrap.isotope({ filter: selector });
			  return false;
			});
	    });
	    $(window).smartresize(function(){
	    	$('.filter-wrap').each(function(){
	    		$(this).isotope({
			    	masonry: { columnWidth: $(this).width() / $(this).data('cols') }
			  	});
	    	});
		});

		// Event Map - Image Toggle
		$('.event-map-image-toggle a').click(function(e){
			$('.event-map-image-toggle a').removeClass('active');
			$(this).addClass('active');
			$( $(this).data('toggle-on') ).show().css('visibility', 'visible');
			$( $(this).data('toggle-off') ).hide();
		});
		$( $('.event-map-image-toggle a.active').data('toggle-on') ).show().css('visibility', 'visible');
		$( $('.event-map-image-toggle a.active').data('toggle-off') ).hide();

		// Slidejs Effect
		if( $('.stack-slider').length > 0 ){
			var slide_offset_top = $('.stack-slider').offset().top;
			var slide_h = $('.stack-slider').height();
			var img_h = $('.slides img').eq(0).height();
			var fade_ratio = 0;
			var ratio = 0;
			var active_padding = 200;
			var parallax_distance = img_h - slide_h;
			$(window).scroll(function(){
				var window_offset_top = $(window).scrollTop();
				
				if( window_offset_top < slide_offset_top + slide_h ) {
					ratio = window_offset_top/(slide_h+slide_offset_top);
					$('.slides img').css('top', -parallax_distance*ratio );
				}
			});

			// For Touch Device
			document.addEventListener("touchmove", ScrollStart, false);
			function ScrollStart() {
			    var window_offset_top = $(window).scrollTop();
				
				if( window_offset_top < slide_offset_top + slide_h ) {
					ratio = window_offset_top/(slide_h+slide_offset_top);
					$('.slides img').css('top', -parallax_distance*ratio );
				}
			}
		}

		
		
	});
	
});