jQuery(document).ready(function($){
	"use strict";

	/* HIDE TABLES UNTIL THEY ARE FULLY LOADED */
	$(window).load(function(){
		$('.pretable-loading').hide();
		$('.bt-table').show();
	});

	$.fn.hasAttr = function(name) {  
	   return this.attr(name) !== undefined;
	};		
	
	/* SCROLL TO TOP */
	$('.to-top a').click(function(e){
		e.preventDefault();
		$("html, body").stop().animate(
			{
				scrollTop: 0
			}, 
			{
				duration: 1200
			}
		);		
	});


	/* NAVIGATION */
	function sticky_nav(){
		var $admin = $('#wpadminbar');
		if( $admin.length > 0 && $admin.css( 'position' ) == 'fixed' ){
			$sticky_nav.css( 'top', $admin.height() );
		}
		else{
			$sticky_nav.css( 'top', '0' );
		}
	}

	if( $('.navigation').length > 0 && $('.navigation').data('enable_sticky') == 'yes' ){
		var $navigation_bar = $('.navigation');
		var $sticky_nav = $navigation_bar.clone().addClass('sticky-nav');
		$('body').append( $sticky_nav );


		$(window).on('scroll', function(){
			sticky_nav()
			if( $(window).scrollTop() >= $navigation_bar.position().top + $navigation_bar.outerHeight(true) && $(window).width() > 769 ){
				$sticky_nav.slideDown();
			}
			else{
				$sticky_nav.slideUp();
			}
		});	
		sticky_nav();
	}

	function handle_navigation(){
		if ($(window).width() >= 767) {
			$('ul.nav li.dropdown, ul.nav li.dropdown-submenu').hover(function () {
				$(this).addClass('open').find(' > .dropdown-menu').stop(true, true).hide().slideDown(200);
			}, function () {
				$(this).removeClass('open').find(' > .dropdown-menu').stop(true, true).show().slideUp(200);
	
			});
		}
		else{
			$('ul.nav li.dropdown, ul.nav li.dropdown-submenu').unbind('mouseenter mouseleave');
		}

		if ($(window).width() >= 767) {
			$('ul.nav li.mega_menu_li, ul.mega_menu').hover(function () {
				$(this).addClass('open').find(' > .mega_menu').stop(true, true).hide().slideDown(200);
			}, function () {
				$(this).removeClass('open').find(' > .mega_menu').stop(true, true).show().slideUp(200);
			});
		}
		else{
			$('ul.nav li.mega_menu_li, ul.mega_menu').unbind('mouseenter mouseleave');
			$('ul.nav li.mega_menu_li').click(function(){
				$(this).find('.mega_menu').slideToggle();
			});
		}		
	}
	handle_navigation();
	
	$(document).on( 'click', '.mega_menu_li > a',function(e){
		if( e.target.nodeName == 'I' ){
			return false;
		}
		if( $(this).attr( 'href' ).indexOf('http') > -1  ){
			window.location.href = $(this).attr('href');
		}
	});

	$(window).resize(function(){
		setTimeout(function(){
			handle_navigation();
		}, 200);
	});

	/* TOGGLE SHARE ICONS */	
	$('.open-share').click(function(e){
		e.preventDefault();
		$(this).prev().toggleClass('opened');
		$(this).toggleClass('active');
	});

	/* ADD BUTTON CLASS */
	$('input#submit').addClass('btn');

	/* SUBMIT FORMS */
	$('.form-submit').click(function(){
		$(this).parents('form').submit();
	});

	/* ADD READ MORE LINKS */
	var $read_more = $('.read-more');
	var box_height = $read_more.height();
	var max_height = $('.read-more .read-more-content').height();
	var open_text = $('.read-more-toggle').text();
	var close_text = $('.read-more-toggle').data('close');
	if( max_height > box_height ){
		$('.read-more-toggle').css('visibility', 'visible');
		$('.read-more-toggle').click(function(){
			var height = max_height;
			var $this = $(this);
			var text = close_text;
			if( $this.hasClass('opened') ){
				height = box_height;
				text = open_text;
			}
			$read_more.animate(
				{height: height},
				200,
				function(){
					$this.toggleClass('opened');
					$this.text( text );
				}
			);
		});
	}

	/* RESPONSIVE SLIDES */
	$('.post-slider').responsiveSlides({
		speed: 800,
		auto: false,
		pager: false,
		nav: true,
		prevText: '<i class="fa fa-angle-left"></i>',
		nextText: '<i class="fa fa-angle-right"></i>',
	});	

	/* FEATURED SLIDER */
	$(window).load(function(){
		$('.featured-slider-loader').hide();
		$('.featured-slider').show();
		$('.featured-slider').responsiveSlides({
			speed: 800,
			timeout: $('.featured-slider').data( 'slider_speed' ) ? $('.featured-slider').data( 'slider_speed' ) : 4000,
			auto: $('.featured-slider').data( 'slider_auto_rotate' ) == 'yes' ? true : false,
			pager: false,
			nav: true,
			pause: true,
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>',
			init: function(){
				$('.rslides_nav').css( 'bottom', $('.rslides1_on .white-block').outerHeight( true ) + 1);
			},		
			after: function(){
				$('.rslides_nav').css( 'bottom', $('.rslides1_on .white-block').outerHeight( true ) + 1);
			}
		});		
	});

	/* COUNTDOWN */
	var $countdown = $('.deal-countdown');
	if( $countdown.length > 0 ){
		$('.deal-countdown').kkcountdown({
			dayText		: $countdown.data('single'),
			daysText 	: $countdown.data('multiple'),
			displayZeroDays : true,
			rusNumbers  :   false
		});
	}

	/* HANDLE RATINGS */
	$('.item-ratings').each(function(){
		$(this).find('i').each(function(e){
			$(this).attr( 'backup-class', $(this).attr( 'class' ) );
		});
	});

	
	$(document).on( 'mouseover', '.item-ratings i', function(e){
		var $parent = $(this).parents('.item-ratings');
		if( $parent.find('.fa-spin').length == 0 ){
			var count = $parent.children().index( this );
			for( var i=0; i<=count; i++ ){
				$parent.find('i:eq('+i+')').attr( 'class', 'fa fa-star opacity-fa' );
			}
		}
	});

	$(document).on( 'mouseout', '.item-ratings i', function(e){
		var $parent = $(this).parents('.item-ratings');
		if( $parent.find('.fa-spin').length == 0 ){
			$parent.find('i').each(function(e){
				$(this).attr( 'class', $(this).attr('backup-class') );
			});
		}
	});

	$(document).on( 'click', '.item-ratings i', function(e){
		var $parent = $(this).parents('.item-ratings');
		var count = $parent.children().index( this );
		$parent.html('<i class="fa fa-spinner fa-spin"></i>');
		$.ajax({
			url: ajaxurl,
			method: "POST",
			data:{
				action: 'write_rate',
				rate: count + 1,
				post_id: $parent.data('post_id')
			},
			success: function( response ){
				$parent.html( response );
			},
			error: function(){

			},
			complete: function(){

			}
		});
	});	

	/* GOOGLE MAPS */
	var $map = $('#deal-map');
	if( $map.length > 0 ){
		var markers = $map.data('markers');
		var markersArray = [];
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = { mapTypeId: google.maps.MapTypeId.ROADMAP };
		var map =  new google.maps.Map(document.getElementById("deal-map"), mapOptions);
		var location;
		if( markers.length > 0 ){
			for( var i=0; i<markers.length; i++ ){
				location = new google.maps.LatLng( markers[i].deal_marker_latitude, markers[i].deal_marker_longitude );
				bounds.extend( location );

				var marker = new google.maps.Marker({
				    position: location,
				    map: map,
				});				
			}

			map.fitBounds( bounds );
			if( couponxl_data.deal_map_max_zoom ){
				var listener = google.maps.event.addListener(map, "idle", function() { 
					map.setZoom( parseInt( couponxl_data.deal_map_max_zoom ) ); 
				  	google.maps.event.removeListener( listener ); 
				});
			}			
			
		}
	}

	var $map2 = $('.gmap');
	if( $map2.length > 0 ){
		$map2.each(function(){
			var markers = JSON.parse( $(this).find('.main_map_markers').html().trim() );
			var markersArray = [];
			var bounds = new google.maps.LatLngBounds();
			var mapOptions = { scrollwheel: false, mapTypeId: google.maps.MapTypeId.ROADMAP };
			var map =  new google.maps.Map( $(this).find('.marker-map')[0], mapOptions);
			var location;
			if( markers.length > 0 ){
				for( var i=0; i<markers.length; i++ ){
					location = new google.maps.LatLng( markers[i].latitude, markers[i].longitude );
					bounds.extend( location );

					var marker = new google.maps.Marker({
					    position: location,
					    map: map,
					    icon: markers[i].marker,
					    url: markers[i].url,
					    title: markers[i].title,
					});	
					google.maps.event.addListener(marker, 'click', function () {
					    window.location.href = this.url;
					});
				}

				map.fitBounds( bounds );
				
			}
		});
	}	


	/* MAIN SEARCH */
	function close_search_option( $search_options ){
		$search_options.slideUp( 200 );
	}

	function show_search_option( $search_options ){
		$search_options.slideDown( 200 );
	}	

	$(document).on( 'click', '.search_options a', function(){
		var $this = $(this);
		var value = $this.data('value');
		if( value !== '' ){
			var $form = $this.parents('.main-search' );
			var $parent = $this.parents('.input-group');
			$parent.find('.top_bar_search').val( $this.text() );
			$parent.find('input[type="hidden"]').val( value );
			$form.removeClass('disabled');
			close_search_option( $this.parents('.search_options') );
			$form.submit();
		}
	});

	$('.main-search input').on( 'focus', function(){
		var $this = $(this);
		var $parent = $this.parents('.input-group');
		var $search_options = $parent.find('.search_options');
		if( $search_options.text() !== '' ){
			show_search_option( $search_options );
		}		
	});

	$('.main-search input').on( 'blur', function(){
		var $this = $(this);
		var $parent = $this.parents('.input-group');
		var $search_options = $parent.find('.search_options');		
		if( $this.val() == '' ){
			$this.parents('form').removeClass('disabled');
		}
		close_search_option( $search_options );
	});

	var timeout;

	$('.main-search input').on( 'keydown', function(e){
		clearTimeout( timeout );
	});

	$('.main-search input').on( 'keyup', function(e){
		var code = e.which || e.keyCode;
		var $this = $(this);
		var $form = $this.parents('.main-search' );		
		if( code !== 13 ){
			var $parent = $this.parents('.input-group');
			var $search_options = $parent.find('.search_options');

			$form.addClass( 'disabled' );
			var val = $this.val();


			if( val !== '' ){
				timeout = setTimeout(function(){
					$.ajax({
						url: ajaxurl,
						type: "POST",
						data: {
							action: 'search_options',
							search_by: $parent.find('input[type="hidden"]').attr('name'),
							val: val
						},
						dataType: "JSON",
						success: function( response ){
							if( response.length > 0 ){
								var $list = '<ul class="list-unstyled">';					
								for( var i=0; i<response.length; i++ ){
									$list += '<li><a href="javascript:;" data-value="'+response[i].slug+'">'+response[i].name+'</a></li>';
								}
								$list += '</ul>';

								$search_options.html( $list );

								show_search_option( $search_options );
							}
							else{
								$search_options.html('');
								close_search_option( $search_options );
							}
						},
						complete: function(){
							if( $this.val() == '' ){
								close_search_option( $search_options );
							}
						}
					});
				},200);
			}
			else{
				clearTimeout( timeout );
				$search_options.html('');
				close_search_option( $search_options );
			}
		}
		else{
			$form.submit();
		}
	});
	
	/* SHOW CODE */
	function show_code_modal( offer_id ){
		$('.coupon-print-image').remove();
		$.ajax({
			url: ajaxurl,
			method: 'POST',
			data: {
				action: 'show_code',
				offer_id: offer_id,
			},
			dataType: "HTML",
			success: function(response){
				$('#showCode .coupon_modal_content').html( response );
				$('body').append( $('.coupon-print-image').clone() );
				$('#showCode .coupon-print-image').remove();
				$('#showCode').modal('show');
				if( !/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
				    prepare_copy();
				}
				else{
					$('.coupon-code-modal.print').attr( 'href', $('.coupon-print-image').attr('src') );
					$('.coupon-code-copied').hide();
				}
			}
		});
	}

	if( window.location.hash && window.location.hash.indexOf('cpn') > 0 ){
		show_code_modal( window.location.hash.split('cpn-')[1] );
	}

	$('.show-code').click(function(e){
		e.preventDefault();
		var $this = $(this);
		if( $this.data('affiliate') != '' ){
			window.location.href = $this.data('affiliate');
			window.open('http://'+window.location.hostname + window.location.pathname + $(this).attr('href'), '_blank'); 
		}
		else{
			var offer_id = $this.data( 'offer_id' );
			show_code_modal( offer_id );
		}
	});

	ZeroClipboard.config( { swfPath: couponxl_data.url+"/js/ZeroClipboard.swf" } );
	function prepare_copy(){
		var $code = $('.coupon-code-modal');
		if( $code.length > 0 && !$code.hasClass('print') ){
			var client = new ZeroClipboard( $code );
			if (/MSIE|Trident|Edge/.test(window.navigator.userAgent)) {
			  (function($) {
			    var zcContainerId = ZeroClipboard.config('containerId');
			    $('#' + zcContainerId).on('focusin', false);
			  })(window.jQuery);
			}
			client.on( 'ready', function(event) {
				client.on( 'copy', function(event) {
					event.clipboardData.setData('text/plain', $code.val() );
				});
		
				client.on( 'aftercopy', function(event) {
					$('.coupon-code-copied').text( $('.coupon-code-copied').data( 'aftertext' ) );
				});
			});
		
			client.on( 'error', function(event) {
				ZeroClipboard.destroy();
			});			
		}
	}

	/* SHOW OPTIONS FOR DIFFERENT COUPON TYPES */
	$(document).on('change', '#coupon_type', function(){
		$('.group_printable').slideUp();
		$('.group_code').slideUp();
		$('.group_sale').slideUp();
		$('.group_'+$(this).val()).slideDown();
	} );

	/* VALIDATE FORM */
	function validate_form( $container ){
		var valid = true;
		$container.find( 'small.error' ).remove();
		$container.find('select, input, textarea').each(function(){
			var $$this = $(this);			
			$$this.removeClass( 'error' )
			if( $$this.hasAttr('data-validation') && ( $$this.is(':visible') || ( $$this.attr('type') == 'hidden' && $$this.parents('.input-group').is(':visible') ) ) ){
				var validations = $$this.data('validation').split('|');
				for( var i=0; i<validations.length; i++ ){
					switch ( validations[i] ){
						case 'length_conditional' :
							if( $$this.val() !== '' ){
								var num = parseInt( $( $$this.data('field_number_val') ).val() );
								if( $$this.val().split(/\r*\n/).length != num ){
									valid = false;
								}
							} break;						
						case 'conditional' :
							if( $$this.val() == '' && $('#'+$$this.data('conditional-field')).val() == '' ){
								valid = false;
							} break;
						case 'required' : 
							if( $$this.val() == '' ){
								valid = false;
							} break;
						case 'number' : 
							if( isNaN( parseInt( $$this.val() ) ) ){
								valid = false;
							} break;
						case 'email' : 
							if( !/\S+@\S+\.\S+/.test( $$this.val() ) ){
								valid = false;
							} break;
						case 'match' :
							if( $$this.val() !== $('input[name="'+$$this.data('match')+'"]' ).val() ){
								valid = false;
							} break;
						case 'checked' :
							if( !$$this.prop( 'checked' ) ){
								valid = false;
							} break;							
					}
				}
				if( !valid ){
					if( $$this.attr('type') == 'checkbox' ){
						$$this.parent().before('<small class="no-margin error">'+$$this.data('error')+'</small><br />');
					}
					else{
						$$this.before('<small class="error">'+$$this.data('error')+'</small>');
					}
				}				
			}
		});
		if( $container.find('#offer_description').length > 0 ){
			var $desc_label = $('label[for="offer_description"]');
			$desc_label.parent().find( '.error' ).remove();			
			if( typeof tinyMCE !== 'undefined' && tinyMCE.get('offer_description')){
				var tiny = tinyMCE.get('offer_description').getContent();
				var description = $('#offer_description').val( tiny );
			}
			else{
				var tiny = $('#offer_description').val();
			}
			if( tiny == '' ){
				valid = false;
				$desc_label.after('<small class="error">'+$desc_label.data('error')+'</small>');
			}			
		}
		return valid;
	}
	$('.submit-form').click(function(){
		var $this = $(this);
		var $form = $this.parents('form');
		
		var can_submit = validate_form( $form );

		if( can_submit ){
			if( $this.hasClass( 'register-form' ) ){
				var $text = $this.text();
				$this.append( '<i class="fa fa-spin fa-spinner" style="margin-left: 10px;"></i>' );
				$.ajax({
					url: ajaxurl,
					method: 'POST',
					data: $this.parents('form').serialize(),
					dataType: 'JSON',
					success: function(response){
						if( response.message.indexOf('success') > -1 ){
							$('input').val('');
						}
						$('.ajax-response').html( '<div class="white-block-content">'+response.message+'</div>' );					
					},
					complete: function(){
						$this.html( $text );
					}
				});
			}
			else{
				$form.submit();
			}
		}
		else{
			var error_message = $('.submit-form').data('form-error');
			if( typeof error_message !== 'undefined' ){
				$('.submit-form').after('<small class="submit-form-error error"><br />'+$('.submit-form').data('form-error')+'</small>');		
			}
		}
	});	

	/* SEND CONTACT */
	$('.submit-form-contact').click(function(e){
		e.preventDefault();
		
		$.ajax({
			url: ajaxurl,
			method: "POST",
			data: $(this).parents('form').serialize(),
			dataType: "JSON",
			success: function( response ){
				if( !response.error ){
					$('.send_result').html( '<div class="alert alert-success" role="alert"><span class="fa fa-check-circle"></span> '+response.success+'</div>' );
				}
				else{
					$('.send_result').html( '<div class="alert alert-danger" role="alert"><span class="fa fa-times-circle"></span> '+response.error+'</div>' );				
				}
			}
		})
	});

	/* MAIL SHARE */
	$('.mail-share').click(function(){
		$('#sendFriend').modal('show');
	});

	$(document).on('click', '.send-friend', function(e){
		e.preventDefault();
		var $this = $(this);
		var $html = $this.html();
		$this.html( '<i class="fa fa-spin fa-spinner"></i>' );
		$.ajax({
			url: ajaxurl,
			method: 'POST',
			data: $this.parents('form').serialize(),
			success: function(response){
				$this.parents('form').find('.friend-response').html( response );
			},
			complete: function(){
				$this.html( $html );
			}
		});
	});


	/* DATES RANGE */
	function start_date_time_pickers(){
		if( $('#offer_start').length > 0 ){
			$('#offer_start').datetimepicker({
				format:'Y-m-d',
				onShow:function( ct ){
					var start = $('#offer_expire').val();
					var maxDate = false;
					var minDate = false;
					var range = $('#offer_start').data('range');
					if( start !== '' ){
						var date = new Date( start );
						date.setDate( date.getDate() - 1 );
						maxDate = date.getFullYear() +'/'+ (date.getMonth()+1) +'/'+ date.getDate();
						if( range !== '' ){
							date.setDate( date.getDate() - range );
							minDate = date.getFullYear() +'/'+ (date.getMonth()+1) +'/'+ date.getDate();
						}
					}			
					this.setOptions({
						maxDate: maxDate,
						minDate: minDate
					});
				},
				timepicker:false
			});

			$('#offer_expire').datetimepicker({
				format:'Y-m-d',
				onShow:function( ct ){
					var start = $('#offer_start').val();
					var maxDate = false;
					var minDate = false;
					var range = $('#offer_expire').data('range');
					if( start !== '' ){
						var date = new Date( start );
						date.setDate( date.getDate() + 1 );
						minDate = date.getFullYear() +'/'+ (date.getMonth()+1) +'/'+ date.getDate();
						if( range !== '' ){
							date.setDate( date.getDate() + range );
							maxDate = date.getFullYear() +'/'+ (date.getMonth()+1) +'/'+ date.getDate();
						}				
					}
					
					this.setOptions({
						maxDate: maxDate,
						minDate: minDate
					});
				},
				timepicker:false
			});	

			/* VOUCHER EXPIRE DATE */
			$('#deal_voucher_expire').datetimepicker({
				format:'Y-m-d',
				onShow:function( ct ){		
					this.setOptions({
						minDate: $('#deal_voucher_expire').data( 'min-date' )
					});
				},
				timepicker:false
			});	
		}
	}

	/* ADD NEW MARKER */
	$(document).on('click', '.new-marker', function(){
		var $new_marker = $(this).next().clone();
		$new_marker.find( 'input' ).val('');
		$(this).after( $new_marker );
	});

	$(document).on( 'click', '.remove-marker', function(){
		if( $('.marker-wrap').length > 1 ){
			$(this).parents('.marker-wrap').remove();
		}
		else{
			$(this).parents('.marker-wrap').find('input').val('');
		}
	});	

	/* GENERATE PAYMENT LINK AJAX */
	$('.pay-offer').click(function(e){
		e.preventDefault();
		var $this = $(this);
		if( $this.find('i').length == 0 ){
			var $text = $this.html();
			$this.html( '<i class="fa fa-spin fa-spinner"></i>' );
			$.ajax({
				url: ajaxurl,
				data: {
					action: 'offer_paypal_link',
					offer_id: $(this).data('offer_id')
				},
				method: "POST",
				dataType: "JSON",
				success: function( response ){
					if( !response.error ){
						window.location.href = response.url;
					}
					else{
						$this.html( $text );
						alert( response.error );
					}
				}
			});
		}
	});

	/* CHANGE STATUS OF THE VOUCHER */
	$(document).on( 'click', '.voucher-mark', function(e){
		e.preventDefault();
		var $this = $(this);
		var $html = $this.html();
		if( $this.find('.fa-spin').length == 0 ){
			$this.html( '<i class="fa fa-spin fa-spinner"></i>' );
			$.ajax({
				url: ajaxurl,
				data:{
					action: 'voucher_status',
					voucher_id: $this.data('voucher_id'),
					status: $this.data('status')
				},
				dataType: "HTML",
				method: "POST",
				success: function( response ){
					$this.parents('tr').find( 'td:eq(1)' ).html( response );
				},
				complete: function(){
					$this.html( $html );
				}
			});
		}
	});

	/* TOP BAR HEIGHT FIX */
	$(window).resize(function(){
		if( $(window).width() >= 768 ){
			$('.search-collapse.collapse').height('auto');
			$('.account-collapse.collapse').height('auto');
		}
	});

	/* FIXED TOGGLES FIXED */
	var $admin = $('#wpadminbar');
	function toggle_offset(){
		if( $admin.length > 0 && $admin.css( 'position' ) == 'fixed' ){
			$('.navbar-toggle').css( 'top', $admin.height() );
			if( $(window).width() < 760 ){
				$('.navigation .col-xs-3').css( 'top', $admin.height() );
				$('.site-logo').css( 'top', $admin.height() );
				$('.account-collapse, .search-collapse, .navbar-collapse').css('padding-top', '50px');
			}
		}
		else if( $admin.length > 0 && $admin.css( 'position' ) == 'absolute' ){
			if( $(window).scrollTop() == 0 ){
				$('.navbar-toggle').css( 'top', $admin.height() );
				if( $(window).width() < 760 ){
					$('.navigation .col-xs-3').css( 'top', $admin.height() );
					$('.site-logo').css( 'top', $admin.height() );
					$('.account-collapse, .search-collapse, .navbar-collapse').css('padding-top', '50px');
				}
			}
			else{
				$('.navbar-toggle').css( 'top', 0 );
				if( $(window).width() < 760 ){
					$('.navigation .col-xs-3').css( 'top', 0 );
					$('.site-logo').css( 'top', 0 );
				}
			}
		}
		else{
			$('.navbar-toggle').css( 'top', '0' );
			if( $(window).width() < 760 ){
				$('.navigation .col-xs-3').css( 'top', '0' );
				$('.site-logo').css( 'top', '0' );
			}
		}		
	}
	toggle_offset();
	$(window).resize(function(){
		$('.account-collapse, .search-collapse, .navbar-collapse').css('padding-top', '0px');
		toggle_offset();
		if( $(window).width() > 760 ){
			$('.navigation .col-xs-3').css( 'top', 0 );
			$('.site-logo').css( 'top', 0 );			
		}
	});

	$(window).scroll(function(){
		$('.account-collapse, .search-collapse, .navbar-collapse').css('padding-top', '0px');
		toggle_offset();
	});

	$('.navbar-toggle').click(function(){
		$('html').toggleClass( 'hidden-overflow' );
	});

	/* MASONRY ITEMS */
	var $container = $('.masonry');
	var has_masonry = false;
	// initialize
	function start_masonry(){
		if( $(window).width() < 768 && has_masonry ){
			$container.masonry('destroy');
			has_masonry = false;			
		}
		else if( $(window).width() >= 768 && !has_masonry ){
			$container.imagesLoaded(function() {
				$container.masonry({
					itemSelector: '.masonry-item',
					columnWidth: '.masonry-item',
				});
				has_masonry = true;
			});	
		}
	}
	start_masonry();
	$(window).resize(function(){
		setTimeout( function(){
			start_masonry();
		}, 500);
	});	

	/* EQUAL WIDGET HEIGHT FOR THE MEGAMENU */
	function is_ie(){

	        var ua = window.navigator.userAgent;
	        var msie = ua.indexOf("MSIE ");

	        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
	            return true;
	        }
	        else{
	            return false;
	        }
	}

	if( is_ie() ){
		$('.mega_menu').width( $('.nav.navbar-nav').width() );
	}


	var $mega_menu = $('.mega_menu');
	var mega_menu_height = $mega_menu.outerHeight( true );
	function update_mega_menu(){
		if( $(window).width() > 768 ){
			$mega_menu.height( mega_menu_height );
		}
		else{
			$mega_menu.height( 'auto' );
		}
	}
	update_mega_menu();
	$(window).resize(function(){
		update_mega_menu();
	});

	/* SUBSCRIBE */
    $('.widget_couponxl_subscribe input').keyup(function(e) {
        var $this = $(this);
        var keyCode = e ? (e.which ? e.which : e.keyCode) : event.keyCode;
        if( keyCode == 13 ){
	        var $parent = $this.parents('.widget_couponxl_subscribe');
	        e.preventDefault();
	        $.ajax({
	            url: ajaxurl,
	            data: {
	                action: 'subscribe',
	                email: $parent.find('input').val(),
	            },
	            method: "POST",
	            dataType: "JSON",
	            success: function(response) {
	                $parent.find('.alert').remove();
	                if (!response.error) {
	                    $parent.find('.form-group').after('<div class="alert alert-success">' + response.success + '</div>');
	                } else {
	                    $parent.find('.form-group').after('<div class="alert alert-danger">' + response.error + '</div>');
	                }
	            }
	        });
	   	}
    });	

    /* SUBMIT DEAL CALCULATE DISCOUNT OR SALE */

	$(document).on('keyup', '#deal_sale_price', function(){
		var sale = parseFloat( $(this).val() );
		var price = parseFloat( $('#deal_price').val() );
		if( sale > 0 && price > 0 ){
			var discount = 100 - ( sale / price ) * 100;
			$('#deal_discount').val( discount.toFixed(0)+'%' );
		}
	});

	$(document).on('keyup', '#deal_discount', function(){
		var discount = parseFloat( $(this).val().replace('%','') );
		var price = parseFloat( $('#deal_price').val() );
		if( discount > 0  && price > 0 ){
			var sale = price - ( price * discount ) / 100;
			$('#deal_sale_price').val( sale.toFixed(2) );
		}
	});
	/* CONTACT MAP */
	var $contact_map = $('.contact_map');
	if( $contact_map.length > 0 ){
		var markers = [];
		$('.contact_map_marker').each(function(){
			var temp = $(this).val().split(',');
			markers.push({
				longitude: temp[0].trim(),
				latitude: temp[1].trim()
			})
		});
		var markersArray = [];
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = { 
			scrollwheel: $('.contact_map_scroll_zoom').length > 0 ? false: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP 
		};
		var map =  new google.maps.Map(document.getElementById("map"), mapOptions);
		var location;
		if( markers.length > 0 ){
			for( var i=0; i<markers.length; i++ ){
				location = new google.maps.LatLng( markers[i].longitude, markers[i].latitude );
				bounds.extend( location );

				var marker = new google.maps.Marker({
				    position: location,
				    map: map,
				});				
			}

			map.fitBounds( bounds );

			if( couponxl_data.contact_map_max_zoom ){
				var listener = google.maps.event.addListener(map, "idle", function() { 
					map.setZoom( parseInt( couponxl_data.contact_map_max_zoom ) ); 
				  	google.maps.event.removeListener( listener ); 
				});
			}
			
		}
	}

	/* CATEGORIES AND LOCATIONS FILTER */
	if( $('.expand-filter').length > 0 ){
		$('.widget .ex_offer_cat, .widget .ex_location').each(function(){
			var $parent = $(this);
			var initial_height = $parent.height() + 5;
			var full_height = 0;
			$parent.css( 'overflow', 'hidden' );
			$parent.height( initial_height );
			$parent.find(' > li').each(function(){
				$(this).removeClass('hidden');
				full_height += $(this).height();
				full_height += parseInt( $(this).css('margin-bottom') );
			});
			full_height+=5;
			$parent.data('initial_height', initial_height);
			$parent.data('full_height', full_height);					
		});


		$('.expand-filter').each(function(){
			var $this = $(this);
			var expand_text = $this.text();
			var collapse_text = $this.data('less');			
			$this.click(function(e){
				e.preventDefault();
				var $this = $(this);
				var $target = $( $this.data('target') );
				var full_height = $target.data('full_height');
				var initial_height = $target.data('initial_height');
				var target_height;

				if( !$this.hasClass('closed') ){
					target_height = initial_height;
					$this.text( expand_text );
				}
				else{
					target_height = full_height;
					$this.text( collapse_text );
				}

				$target.animate({
					height: target_height
				},
				500,
				function(){
					$this.toggleClass('closed');
				});				
			});				
		});	
	}

	/* TOGGLE COLLAPSED */
	$(document).on('click', '.button-white.menu', function(){
		var $this = $(this);
		$('.button-white.menu').each(function(){
			var target = $(this).data('target');
			var $target = $(target);
			if( target !== $this.data('target') && $target.hasClass('in') ){
				$(this).click();
			}
		})
	});	


	/* DEAL TYPE EXPLANATION */
	$(document).on('change', 'select[name="deal_type"]', function(){
		var $this = $(this);
		var val = $this.val();
		$('.shared_info').hide();
		$('.not_shared_info').hide();
		$('.'+val+'_info').show();
		var deal_sale = $('input[name="deal_sale_price"]').val();
		var unit = $this.data('unit');
		var unit_position = $this.data('unit_position');
		var charged = '';
		if( val == 'shared' ){
			var shared = $this.data('shared');
			if( shared.indexOf('%') > -1 ){
				shared = shared.replace('%','');
				charged = (deal_sale*shared) / 100;
			}
			else{
				charged = not_shared;
			}
			if( unit_position == 'front' ){
				charged = unit+charged;
			}
			else{
				charged = charged+unit;
			}
			$('.shared_info .charged').html( charged );
		}
		else{
			var not_shared = $this.data('not_shared');
			if( not_shared.indexOf('%') > -1 ){
				not_shared = not_shared.replace('%','');
				charged = (deal_sale*not_shared) / 100;
			}
			else{
				charged = not_shared;
			}
			if( unit_position == 'front' ){
				charged = unit+charged;
			}
			else{
				charged = charged+unit;
			}			
			$('.not_shared_info .charged').html( charged );
		}
	});

	/* CLOSE NOTIFICATION BAR */
	$('.close-notification-bar').click( function(){
        $(this).parents('section').slideToggle(200);
        $.cookie('couponxl_notification', 'closed', { expires: 3 });		
	});

	/* KEYWORD SEARCH TOGGLE */
	$('.keyword-search-toggle').click(function(){
		if( $(window).width() < 768 ){
			$('.top-bar .main-search').slideToggle( 200 );
		}
		else{
			$('.top-bar .main-search').slideDown( 200 );
			$('.top-bar .main-search').toggleClass( 'main-search-hide' );	
		}
		$('.keyword-search').slideToggle( 200 );
	});

	$('.main-search').submit(function(e){
		e.preventDefault();
		var $this = $(this);
		if( $this.hasClass('disabled') ){
			return false;
		}
		var prettylinks = $('.prettylinks').val();
		var url = $('.search_page_url').val();
		var protocol = url.indexOf( 'http://' ) > -1 ? 'http://' : 'https://'		
		url = url.replace( protocol, '' );
		var temp = url.split('?');
		var query_string = temp[1] ? temp[1] : '';
		if( prettylinks == 'yes' ){
			var segments = temp[0].split(/\//g);
			$this.find( 'input[type="hidden"]' ).each(function(){
				if( $(this).val() !== '' ){
					var index = segments.indexOf( $(this).attr('name') );
					if( index > -1 ) {					
						segments[index+1] = $(this).val();
					}
					else{
						segments.push( $(this).attr('name') );
						segments.push( $(this).val() );
					}	
				}			
			});
			segments = $.grep(segments,function(n){ return(n) });
			url = protocol + segments.join('/') + ( query_string ? '?' + query_string : '' );
			window.location.href = url;
		}
		else{
			var segments = queryString.parse( query_string );
			$this.find( 'input[type="hidden"]' ).each(function(){
				if( $(this).val() !== '' ){
					segments[$(this).attr('name')] = $(this).val();
				}
			});
			window.location.search = queryString.stringify( segments );
		}			
	});

	$('.keyword-search').submit(function(e){
		e.preventDefault();
		var $this = $(this);
		var url = $('.search_page_url').val();
		var prettylinks = $('.prettylinks').val();
		var value = $this.find('input').val().split( ' ' ).join('_');
		if( prettylinks == 'yes' ){
			window.location.href = url + $this.find('input').attr( 'name' ) + '/' + encodeURIComponent( value );
		}
		else{
			window.location.href = url + '&' + $this.find('input').attr( 'name' ) + '=' + encodeURIComponent( value );
		}
	});

	/* STEPS */
	var wizard = $("#wizard");
	if( wizard.length > 0 ){
		wizard.steps({
			titleTemplate: '<span class="number">#index#</span> #title#',
			enableKeyNavigation: false,
			onStepChanging: function( event, currentIndex, newIndex ){
				if ( currentIndex > newIndex ){
				    return true;
				}

				var $group = $( '#wizard-p-'+currentIndex );
				var can_submit = validate_form( $group );
				if( can_submit ){
					return true;
				}
				else{
					return false;
				}

			},
			onStepChanged: function (event, currentIndex, priorIndex){
				start_date_time_pickers();
			},
			onFinishing: function (event, currentIndex) {
				var $group = $( '#wizard-p-'+currentIndex );
				var can_submit = validate_form( $group );
				if( can_submit ){
					return true;
				}
				else{
					return false;
				}				
			},
			onFinished: function(){
				$('#wizard').parents('form').submit();
			},
			labels:{
				cancel: couponxl_data.steps_cancel,
				finish: couponxl_data.steps_finish,
				next: couponxl_data.steps_next,
				previous: couponxl_data.steps_previous,
				loading: couponxl_data.steps_loading,
			}
		});
	}


	/* SWITCH PAYMENTS */
	$(document).on( 'change', '#seller_payout_method', function(){
		$('.input-group.stripe').hide();
		$('.input-group.paypal').hide();
		$('.input-group.skrill').hide();
		if( $(this).val() !== '' ){
			$('.input-group.'+$(this).val()).show();
		}
	});

	/* OPEN MODAL PAYMENTS */
	$(document).on( 'click', '.modal-payment', function(){
		$('#showPayment .payment-content').html( $(this).next().html() );
		$('#showPayment').modal('show');
	});

	/* PAY WITH STRIPE */
	if( $('.stripe-payment').length > 0 ){
		var offer_id;
		var handler = StripeCheckout.configure({
		    key: $('.stripe-payment').attr('data-pk'),
		    token: function(token) {
		    	$('.deal-message').html( '<div class="alert alert-info">'+$('.stripe-payment').data('genearting_string')+'</div>' );
		    	var payment_for = '';
		    	var action = 'pay_with_stripe';
				if( $('table.table').length > 0 ){
					payment_for = 'submission-list';
					action = 'submit_with_stripe';
				}
		    	else if( $('.page-template-page-tpl_my_profile').length > 0 ) {
					payment_for = 'submission';
					action = 'submit_with_stripe';
				}
				$.ajax({
					url: ajaxurl,
					method: 'POST',
					data: {
						action: action,
						token: token,
						offer_id: offer_id,
						payment_for: payment_for
					},
					success: function( response ){
						if( payment_for == 'submission-list' ){
							$('a[data-offer_id="'+offer_id+'"]').parents('td').html( response);
						}
						else{
							$('.deal-message').html( response );
						}
						$('#showPayment').modal('hide');
					}
				});
		    }
		});		
		$(document).on( 'click', '.stripe-payment', function(e){
			e.preventDefault();
			handler.open({
				name: $(this).attr('data-name'),
				description: $(this).attr('data-description'),
				amount: $(this).attr('data-amount'),
				locale: 'auto',
				currency: $(this).attr('data-currency')
			});
			offer_id = $(this).attr('data-offer_id');
		});	
		// Close Checkout on page navigation
		$(window).on('popstate', function() {
			handler.close();
		});		
	}

	/* PAY WITH IDEAL */
	$(document).on( 'click', '.submit-ideal-payment', function(){
		var $this = $(this);
		if( $('.page-template-page-tpl_my_profile').length > 0 ){
			$('input[value="ideal_link"]').val('submit_with_ideal');
		}
		$('.deal-message').html( '<div class="alert alert-info">'+$this.data('genearting_string')+'</div>' );;
		$.ajax({
			url: ajaxurl,
			method: 'POST',
			data: $this.parent().find('.ideal-payment').serialize(),
			success: function( response ){
				if( response.indexOf( 'http' ) > -1 ){
					window.location.href = response;
				}
				else{
					$('.deal-message').html( response );
				}
			}
		})
	});	

	/* PAY WITH PAYU */
	$(document).on( 'click', '.payu-initiate', function(){
		var $this = $(this);
		var $form = $this.next();

		if( $form.hasClass( 'payu-submit-click' ) ){
			$form.submit();
		}
		else{
			$('#payUAdditional .payu-content-modal').html( $form.clone() );
			$('#payUAdditional').modal('show');
			$(document).on( 'click', '.payu-additional-info', function(){
				$.ajax({
					url: ajaxurl,
					method: 'POST',
					data: $(this).parents('form').serialize(),
					success: function( response ){
						$('#payUAdditional .payu-content-modal').html( response );
						var $$form = $('#payUAdditional .payu-content-modal .payu-submit');
						if( $$form.length > 0 ){
							$$form.submit();
						}
					}
				});
			});
		}
	});

	/* PRINT VOUCEHR */
	$(document).on('click', '.print-voucher', function(){
		$('.voucher-print-added').remove();
		var voucher_clone = $(this).parent().find('.voucher-print').clone();
		voucher_clone.addClass( 'voucher-print-added' );
		$('body').append( voucher_clone );
		window.print();
	});

	/* SUBMIT SKRILL FORM */
	$(document).on( 'click', '.skrill-payment', function(){
		$(this).parent().find('form').submit();
	});

});

/*!
	query-string
	Parse and stringify URL query strings
	https://github.com/sindresorhus/query-string
	by Sindre Sorhus
	MIT License
*/
(function () {
	'use strict';
	var queryString = {};

	queryString.parse = function (str) {
		if (typeof str !== 'string') {
			return {};
		}

		str = str.trim().replace(/^(\?|#)/, '');

		if (!str) {
			return {};
		}

		return str.trim().split('&').reduce(function (ret, param) {
			var parts = param.replace(/\+/g, ' ').split('=');
			var key = parts[0];
			var val = parts[1];

			key = decodeURIComponent(key);
			// missing `=` should be `null`:
			// http://w3.org/TR/2012/WD-url-20120524/#collect-url-parameters
			val = val === undefined ? null : decodeURIComponent(val);

			if (!ret.hasOwnProperty(key)) {
				ret[key] = val;
			} else if (Array.isArray(ret[key])) {
				ret[key].push(val);
			} else {
				ret[key] = [ret[key], val];
			}

			return ret;
		}, {});
	};

	queryString.stringify = function (obj) {
		for( var key in obj ){
			if( obj[key] === '' ){
				delete obj[key];
			}
		}
		return  obj ? Object.keys(obj).map(function (key) {
			var val = obj[key];

			if (Array.isArray(val)) {
				return val.map(function (val2) {
					return encodeURIComponent(key) + '=' + encodeURIComponent(val2);
				}).join('&');
			}
			return encodeURIComponent(key) + '=' + encodeURIComponent(val);	
		}).join('&') : '';
	};

	if (typeof define === 'function' && define.amd) {
		define(function() { return queryString; });
	} else if (typeof module !== 'undefined' && module.exports) {
		module.exports = queryString;
	} else {
		window.queryString = queryString;
	}
})();