

//Request animation frame polyfill
!function(){for(var a=0,b=["ms","moz","webkit","o"],c=0;c<b.length&&!window.requestAnimationFrame;++c)window.requestAnimationFrame=window[b[c]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[b[c]+"CancelAnimationFrame"]||window[b[c]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(b){var d=(new Date).getTime(),e=Math.max(0,16-(d-a)),f=window.setTimeout(function(){b(d+e)},e);return a=d+e,f}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)})}();

/*! Backstretch - v2.0.4 - 2013-06-19
* http://srobbin.com/jquery-plugins/backstretch/
* Copyright (c) 2013 Scott Robbin; Licensed MIT */
(function(a,d,p){a.fn.backstretch=function(c,b){(c===p||0===c.length)&&a.error("No images were supplied for Backstretch");0===a(d).scrollTop()&&d.scrollTo(0,0);return this.each(function(){var d=a(this),g=d.data("backstretch");if(g){if("string"==typeof c&&"function"==typeof g[c]){g[c](b);return}b=a.extend(g.options,b);g.destroy(!0)}g=new q(this,c,b);d.data("backstretch",g)})};a.backstretch=function(c,b){return a("body").backstretch(c,b).data("backstretch")};a.expr[":"].backstretch=function(c){return a(c).data("backstretch")!==p};a.fn.backstretch.defaults={centeredX:!0,centeredY:!0,duration:5E3,fade:0};var r={left:0,top:0,overflow:"hidden",margin:0,padding:0,height:"100%",width:"100%",zIndex:-999999},s={position:"absolute",display:"none",margin:0,padding:0,border:"none",width:"auto",height:"auto",maxHeight:"none",maxWidth:"none",zIndex:-999999},q=function(c,b,e){this.options=a.extend({},a.fn.backstretch.defaults,e||{});this.images=a.isArray(b)?b:[b];a.each(this.images,function(){a("<img />")[0].src=this});this.isBody=c===document.body;this.$container=a(c);this.$root=this.isBody?l?a(d):a(document):this.$container;c=this.$container.children(".backstretch").first();this.$wrap=c.length?c:a('<div class="backstretch"></div>').css(r).appendTo(this.$container);this.isBody||(c=this.$container.css("position"),b=this.$container.css("zIndex"),this.$container.css({position:"static"===c?"relative":c,zIndex:"auto"===b?0:b,background:"none"}),this.$wrap.css({zIndex:-999998}));this.$wrap.css({position:this.isBody&&l?"fixed":"absolute"});this.index=0;this.show(this.index);a(d).on("resize.backstretch",a.proxy(this.resize,this)).on("orientationchange.backstretch",a.proxy(function(){this.isBody&&0===d.pageYOffset&&(d.scrollTo(0,1),this.resize())},this))};q.prototype={resize:function(){try{var a={left:0,top:0},b=this.isBody?this.$root.width():this.$root.innerWidth(),e=b,g=this.isBody?d.innerHeight?d.innerHeight:this.$root.height():this.$root.innerHeight(),j=e/this.$img.data("ratio"),f;j>=g?(f=(j-g)/2,this.options.centeredY&&(a.top="-"+f+"px")):(j=g,e=j*this.$img.data("ratio"),f=(e-b)/2,this.options.centeredX&&(a.left="-"+f+"px"));this.$wrap.css({width:b,height:g}).find("img:not(.deleteable)").css({width:e,height:j}).css(a)}catch(h){}return this},show:function(c){if(!(Math.abs(c)>this.images.length-1)){var b=this,e=b.$wrap.find("img").addClass("deleteable"),d={relatedTarget:b.$container[0]};b.$container.trigger(a.Event("backstretch.before",d),[b,c]);this.index=c;clearInterval(b.interval);b.$img=a("<img />").css(s).bind("load",function(f){var h=this.width||a(f.target).width();f=this.height||a(f.target).height();a(this).data("ratio",h/f);a(this).fadeIn(b.options.speed||b.options.fade,function(){e.remove();b.paused||b.cycle();a(["after","show"]).each(function(){b.$container.trigger(a.Event("backstretch."+this,d),[b,c])})});b.resize()}).appendTo(b.$wrap);b.$img.attr("src",b.images[c]);return b}},next:function(){return this.show(this.index<this.images.length-1?this.index+1:0)},prev:function(){return this.show(0===this.index?this.images.length-1:this.index-1)},pause:function(){this.paused=!0;return this},resume:function(){this.paused=!1;this.next();return this},cycle:function(){1<this.images.length&&(clearInterval(this.interval),this.interval=setInterval(a.proxy(function(){this.paused||this.next()},this),this.options.duration));return this},destroy:function(c){a(d).off("resize.backstretch orientationchange.backstretch");clearInterval(this.interval);c||this.$wrap.remove();this.$container.removeData("backstretch")}};var l,f=navigator.userAgent,m=navigator.platform,e=f.match(/AppleWebKit\/([0-9]+)/),e=!!e&&e[1],h=f.match(/Fennec\/([0-9]+)/),h=!!h&&h[1],n=f.match(/Opera Mobi\/([0-9]+)/),t=!!n&&n[1],k=f.match(/MSIE ([0-9]+)/),k=!!k&&k[1];l=!((-1<m.indexOf("iPhone")||-1<m.indexOf("iPad")||-1<m.indexOf("iPod"))&&e&&534>e||d.operamini&&"[object OperaMini]"==={}.toString.call(d.operamini)||n&&7458>t||-1<f.indexOf("Android")&&e&&533>e||h&&6>h||"palmGetResource"in d&&e&&534>e||-1<f.indexOf("MeeGo")&&-1<f.indexOf("NokiaBrowser/8.5.0")||k&&6>=k)})(jQuery,window);

"use strict";
var $ = jQuery.noConflict();
/**
 * jQuery.browser.mobile (http://detectmobilebrowser.com/)
**/
(function(a) {
	($.browser = $.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4));
})(navigator.userAgent || navigator.vendor || window.opera);

(function(a) {
	($.browser = $.browser || {}).ipad = /ipad/i.test(a);
})(navigator.userAgent || navigator.vendor || window.opera);

var mobile = $.browser.mobile;
var ipad = $.browser.ipad;


if (jQuery('.home-bg-image').data('background')) {
	jQuery(".home-bg-image").backstretch(jQuery('.home-bg-image').data('background'));
} else {
	jQuery(".home-bg-image").backstretch("http://placehold.it/1440x900");
}

var $window = $(window);
var $body = $('body');
var click = 'click';
if ($.browser.windowsMobile === true) {
	if (window.navigator.pointerEnabled) {
		click = "pointerdown";
	} else if (window.navigator.msPointerEnabled) {
		click = "MSPointerDown";
	}
} else if ($.browser.mobile === true) {
	click = 'touchend';
}


var hidden, visibilityChange;
if (typeof document.hidden !== "undefined") { // Opera 12.10 and Firefox 18 and later support 
  hidden = "hidden";
  visibilityChange = "visibilitychange";
} else if (typeof document.mozHidden !== "undefined") {
  hidden = "mozHidden";
  visibilityChange = "mozvisibilitychange";
} else if (typeof document.msHidden !== "undefined") {
  hidden = "msHidden";
  visibilityChange = "msvisibilitychange";
} else if (typeof document.webkitHidden !== "undefined") {
  hidden = "webkitHidden";
  visibilityChange = "webkitvisibilitychange";
}







// (function($){
// "use strict";

// Change lat long to your location. You can add multiple markers.
var sites = [['Berg Restaurant', 51.104411, 17.01300, 1]];

function changeHomeSlide(){
  $('.parallax-slides > div:first')
	.velocity({opacity: 0}, 1500)
	.next()
	.velocity({opacity: 1}, 1500)
	.end()
	.appendTo('.parallax-slides');
}

function resetReservation() {

		window.history.replaceState("", document.title, window.location.pathname );
		$('#reservation-trigger').hide(0);
		$('.reservation-form').velocity({opacity: 0 }, {display: 'none', complete: function(){
			$('.ui-datepicker').hide(0);

			$('.home-2 .home-content .first-line').text($('.home-2 .home-content .first-line').data('base'));


			$('.reservation-form-1').velocity({translateX : '0', opacity: 1}, 0).css('display', 'block');
			$('.reservation-form-2').velocity({translateX : '100%', opacity: 0}, 0).css('display', 'block');
			$('.reservation-form-3').velocity({translateX : '200%', opacity: 0}, 0).css('display', 'block');
			$('.ui-datepicker').addClass('reservation-datepicker');

			$('.home-2 .home-content .first-line').velocity({ translateY : '0px', opacity: 1, blur: '0px'}, 700, 'easeOutCubic');
			$('#main-navbar-home').velocity({ opacity: 1}, 300);
			var dateReplace = $('.home-2 .home-content .button-text .second-line').data('base');
			if(dateReplace === '') {

			} else {
				$('.home-2 .home-content .second-line').text(dateReplace);
				$('.home-2 .home-content .second-line, .home-2 .home-content .second-border').velocity({ translateY : '0px', opacity: 1, blur: '0px'}, { duration: 700, easing: 'easeOutCubic', display: 'inline-block' });
			}
		}});
}

function homeBackReservation() {
	// if(window.location.hash == '#reservation') {

	// }
	$('#reservation-trigger').hide(0);
	// $('.reservation-form').velocity({opacity: 0 }, {display: 'none', complete: function(){
	$('.reservation-form-1').velocity({translateX : '0', opacity: 1}, 0).css('display', 'block');
	$('.reservation-form-2').velocity({translateX : '100%', opacity: 0}, 0).css('display', 'block');
	$('.reservation-form-3').velocity({translateX : '200%', opacity: 0}, 0).css('display', 'block');
		$('.home-reservation-back').velocity({opacity: 0}, {display: 'none'});

	$('.home-2 .home-content .first-line').velocity({ translateY : '-30px', opacity: 0, blur: '3px'}, 700,  'easeOutCubic', function(){
		$('.home-2 .home-content .first-line').text($('.home-2 .home-content .first-line').data('base'));
		$('.home-2 .home-content .first-line').delay(300).velocity({ translateY : '0px', opacity: 1, blur: '0px'}, 700, 'easeOutCubic', function(){});
	});
	$('.home-2 .home-content .second-line, .home-2 .home-content .second-border').velocity({ translateY : '30px', opacity: 0, blur: '3px'}, 700, 'easeOutCubic', function(){
		var dateReplace = $('.home-2 .home-content .button-text .second-line').data('base');
		if(dateReplace === '') {

		} else {
			$('.home-2 .home-content .second-line').text(dateReplace);
			$('.home-2 .home-content .second-line, .home-2 .home-content .second-border').delay(300).velocity({ translateY : '0px', opacity: 1, blur: '0px'}, { duration: 700, easing: 'easeOutCubic', display: 'inline-block', complete: function(){
			}});
		}
	});
}

// WPML
	var footerWpml = $('#lang_sel_footer');
	if($('.home-2').length > 0) {
		$('.home-2 .home-info-footer').append(footerWpml);
	}
	if($('#footer').length > 0) {
		footerWpml.addClass('wpml-color-footer');
		var footer = $('#footer');
		footerWpml.appendTo(footer);
	} else {
		footerWpml.removeClass('wpml-color-footer');
	}
	var menuLang = $('.flyout-container .menu > .menu-item-language');
	if( menuLang.length > 0) {
		var lang = menuLang.find('.menu-item-language');
		menuLang.append(lang);
	}


if(window.location.hash == '#reservation') {
	if($window.width() > 991) {
		setTimeout(function(){
			$('.booking-switch').click();
		}, 100);
		setTimeout(function(){
			$('#reservation-trigger').click();
		}, 3000);
	} else {
		setTimeout(function(){
			$('.mobile-booking-switch').click();
		}, 700);
	}
}

$(document).ready(function() {
	"use strict";
	
	$window.on('resize', function(){
		if(mobile || $window.outerWidth() < 992) {
			$('.contact-bg-fullscreen, .team-bg-fullscreen').css('min-height', $window.height() - 80);
		} else {
			$('.contact-bg-fullscreen, .team-bg-fullscreen').css('min-height', $window.height());
		}
	}).resize();


	if($('.nav-fixed-bar').length > 0) {
		var pageScrolled = false;
		$window.on('scroll', $.throttle(50, function(){
		
			if($window.scrollTop() > 200 && pageScrolled === false) {
				pageScrolled = true;
				$body.addClass('page-scrolled');

			} else if($window.scrollTop() <= 200 && pageScrolled === true) {
				pageScrolled = false;
				$body.removeClass('page-scrolled');
			}
		}));
	}

	$('#scene').parallax();

	$(".parallax-slides > div:gt(0)").velocity({opacity: 0}, 0);

	var autopager;
	function startHomeSlider() {
		autopager = window.setInterval(changeHomeSlide, slidesDuration);
	}
	function stoptHomeSlider() {
		window.clearInterval(autopager);
	}

	if($('.parallax-slides').length > 0) {
		if($('.parallax-slides .slide').length > 1) {
			startHomeSlider();
			window.addEventListener('focus', startHomeSlider);
			window.addEventListener('blur', stoptHomeSlider);
		}
	}

	function updateReservationTime() {
		var output = '';
		output = $('.spinner-hour').text() + ':' + $('.spinner-minutes').text();
		if($('.time-range-active').length > 0) {
			output += $('.time-range-active').text();
		}
		$('#time-otreservations').val(output);
	}

	function updateParty() {
		var output = '';
		output = $('.spinner-party').text();
		output = parseInt(output, 10);
		$('#party-otreservations').val(output);
	}

	function updateMobileReservation(el) {
		if(el.id == 'mobile-booking-month') {
			var date = el.value.split('/');
			var days = getMonthDays(date[1], date[0]);
			var dayElement = document.getElementById('mobile-booking-day');
			var oldValue = dayElement.value;
			dayElement.innerHTML = '';
			$.each(days, function(){
				dayElement.innerHTML = dayElement.innerHTML + '<option value="'+this+'">'+this+'</option>';
			});
			if(oldValue) {
				dayElement.value = oldValue;
				if(dayElement.value === '') {
					dayElement.value = 1;
				}
			}
		}

		var dayValue = document.getElementById('mobile-booking-day').value;
		var monthValue = document.getElementById('mobile-booking-month').value;
		var hourValue = document.getElementById('mobile-booking-hour').value;
		var minutesValue = document.getElementById('mobile-booking-minutes').value;
		var timeValue = '';
		timeValue = document.getElementById('mobile-booking-time');
		if(timeValue !== undefined && timeValue !== null) {
			timeValue = timeValue.value;
			$('#time-otreservations').val(hourValue+':'+minutesValue+timeValue);
		} else {
			$('#time-otreservations').val(hourValue+':'+minutesValue);
		}
		var partyValue = document.getElementById('mobile-booking-party').value;

		$('#date-otreservations').val(dayValue+'/'+monthValue);
		$('#party-otreservations').val(partyValue);

	}

	function getMonthDays(year, month) {
		var date = new Date(year, month-1, 1);
		var result = [];
		while (date.getMonth() == month-1) {
			result.push(date.getDate());
			date.setDate(date.getDate()+1);
		}
		return result;
	}

	function repositionHomeFooter(){
		if($('.home-info-inner').outerHeight() + $('.home-logo').outerHeight() + $('.home-info-footer').outerHeight() < $('.home-info').height() - $('.home-info-footer').outerHeight()-30) {
			$('.home-info-footer').addClass('bottom');
		} else {
			$('.home-info-footer').removeClass('bottom');
		}
	}

	if($('body').hasClass('page-template-homepage2')) {

		if($('.home-info-inner').length > 0) {
			repositionHomeFooter();
			$(window).on('resize', $.debounce( 250, function() {
				repositionHomeFooter();
			}));
		}
		var dateReplace = $('.home-2 .home-content .button-text .second-line').data('base');
		if(dateReplace === '') {
			$('.home-2 .home-content .second-line, .home-2 .home-content .second-border').velocity({ translateY : '30px', opacity: 0, blur: '3px'}, { duration: 0 });
		}

		if($('.mobile-booking').length > 0) {
			updateMobileReservation($('#mobile-booking-month')[0]);
			$('.mobile-booking select').each(function(){
				$(this).bind('change', function(){
					updateMobileReservation(this);
				});
			});
			var mobileBookingOpen = true;
			$('.mobile-booking-switch').bind(click, function(e){
				if($(this).attr('href') == '#') {
					e.preventDefault();
				} else {
					return;
				}
				if(mobileBookingOpen === true) {
					mobileBookingOpen = null;
					$('.mobile-booking').velocity('stop').velocity('slideDown', function(){
						mobileBookingOpen = false;
					});
				} else if(mobileBookingOpen === false) {
					mobileBookingOpen = null;
					$('.mobile-booking').velocity('stop').velocity('slideUp', function(){
						mobileBookingOpen = true;
					});
				}
			});

			$('.mobile-booking-submit').click(function(){
				$('.otw-widget-form').submit();
			});
		}

		$('.button-text').hover(function(){
			$('.button-frame-inner').velocity('stop').velocity({translateX: '-5px', translateY: '-5px'}, 300);
			$('.button-frame-hover').velocity('stop').velocity({translateX: '10px', translateY: '10px', opacity:1}, 300);
			$('.button-arrow').velocity('stop').velocity({ opacity:0.5}, 300);
		}, function(){
			$('.button-frame-inner').velocity('stop').velocity({translateX: 0, translateY: 0});
			$('.button-frame-hover').velocity('stop').velocity({translateX: 0, translateY: 0, opacity: 0});
			$('.button-arrow').velocity('stop').velocity({ opacity:1}, 300);

		});

		jQuery('#reservation-datepicker').datepicker({
			dateFormat : 'dd/mm/yy',
			firstDay: datepickerNames.startOfWeek,
			minDate: 0,
			dayNamesMin: datepickerNames.days,
			monthNames: datepickerNames.months,
			monthNamesShort: [ "Janeiro", "Fevereiro", "Março", "Abril",
                   "Maio", "Junho", "Julho", "Agosto", "Setembro",
                   "Outubro", "Novembro", "Dezembro" ],
			onSelect: function(dateText){
				$(this).data('datepicker').inline = true;
				$('.home-2 .home-content .second-line').text(dateText);
				$('#date-otreservations').val(dateText);
			},
		});
		$('.ui-datepicker').hide(0);


		$('.home-reservation-back .form-close').click(function(){
			homeBackReservation();
		});
		$('.form-submit .form-close').click(function(){
			resetReservation();
		});

		$('.spinner-up, .spinner-down').bind('click', function(e){
			e.preventDefault();
			var value = parseInt($(this).parent().text(), 10);
			if($('.time-range').length > 0) {
				if($(this).hasClass('spinner-up')) {
					if(value === 12) {
						value = 1;
					} else {
						value += 1;
					}
				} else {
					if(value === 1) {
						value = 12;
					} else {
						value = value - 1;
					}
				}
			} else {
				if($(this).hasClass('spinner-up')) {
					if(value === 23) {
						value = 0;
					} else {
						value += 1;
					}
				} else {
					if(value === 0) {
						value = 23;
					} else {
						value = value - 1;
					}
				}
			}
			value = value.toString();
			if(value.length == 1) {
				value = '0'+value;
			}
			$(this).parent().find('.value').text(value);
			updateReservationTime();
		});

		$('.spinner-up-minutes, .spinner-down-minutes').bind('click', function(e){
			e.preventDefault();
			var value = parseInt($(this).parent().text(), 10);
			if(value === 0) {
				value = '30';
			} else {
				value = '00';
			}
			$(this).parent().find('.value').text(value);
			updateReservationTime();
		});

		$('.spinner-up-party, .spinner-down-party').bind('click', function(e){
			e.preventDefault();
			var value = parseInt($(this).parent().text(), 10);
			if($(this).hasClass('spinner-up-party')) {
				if(value === 10) {
					value = 1;
				} else {
					value = value + 1;
				}
			} else {
				if(value === 1) {
					value = 10;
				} else {
					value = value - 1;
				}
			}
			value = value.toString();
			if(value.length == 1) {
				value = '0'+value;
			}
			$(this).parent().find('.value').text(value);
			updateParty();
		});

		$('.time-range').bind('click', function(e){
			e.preventDefault();
			if(!$(this).hasClass('time-range-active')) {
				$('.time-range-active').removeClass('time-range-active');
				$(this).addClass('time-range-active');
				updateReservationTime();
			}
		});

		$('.booking-switch').click(function(e){
			if($(this).attr('href') == '#') {
				e.preventDefault();
			} else {
				return;
			}
			
			$('#reservation-trigger').show(0);
			$('.reservation-form-2').velocity({translateX : '100%', opacity: 0}, 0);
			$('.reservation-form-3').velocity({translateX : '200%', opacity: 0}, 0);
			$('.ui-datepicker').addClass('reservation-datepicker');

			$('.home-2 .home-content .first-line').velocity({ translateY : '-30px', opacity: 0, blur: '3px'}, 700,  'easeOutCubic', function(){
				$('.home-2 .home-content .first-line').text($('.home-2 .home-content .first-line').data('replace'));
				$('.home-2 .home-content .first-line').delay(300).velocity({ translateY : '0px', opacity: 1, blur: '0px'}, 700, 'easeOutCubic', function(){});
			});
			$('.home-2 .home-content .second-line, .home-2 .home-content .second-border').velocity({ translateY : '30px', opacity: 0, blur: '3px'}, 700, 'easeOutCubic', function(){
				var dateReplace = $('.home-2 .home-content .button-text .second-line').data('replace');

				$('.home-2 .home-content .second-line').text(dateReplace);
				$('.home-2 .home-content .second-line, .home-2 .home-content .second-border').delay(300).velocity({ translateY : '0px', opacity: 1, blur: '0px'}, { duration: 700, easing: 'easeOutCubic', display: 'inline-block', complete: function(){
					$('.home-reservation-back').velocity({opacity: 1}, {display: 'inline-block'});
				}});
			});
		});
		$('#reservation-trigger').click(function(){

			if(window.location.hash == '') {
				window.location.hash = '#reservation';
			}
			$('.ui-datepicker').show(0);
			$('.home-reservation-back').velocity({opacity: 0}, {display: 'none'});

			$('#main-navbar-home').velocity({ opacity: 0}, 400,  'easeOutCubic');
			$('.home-2 .home-content .first-line').velocity('stop').velocity({ translateY : '-30px', opacity: 0, blur: '3px'}, 700,  'easeOutCubic');
			$('.home-2 .home-content .second-line, .home-2 .home-content .second-border').velocity('stop').velocity({ translateY : '30px', opacity: 0, blur: '3px'}, 700, 'easeOutCubic');
			$('.reservation-form').css('display', 'block').velocity({opacity: 1});
		});

		$('.datepicker-submit .form-next-step').click(function(){
			$('.reservation-form-1').velocity({translateX :'-100%', opacity: 0 }, 1500, 'easeOutQuint', function(){ $(this).hide(0); });
			$('.reservation-form-2').velocity({translateX :'0', opacity: 1 }, 1500, 'easeOutQuint');
			updateReservationTime();
		});

		$('.timepicker-submit .form-next-step').click(function(){
			$('.reservation-form-2').velocity({translateX :'-100%', opacity: 0 }, 1500, 'easeOutQuint', function(){ $(this).hide(0); });
			$('.reservation-form-3').velocity({translateX :'0', opacity: 1 }, 1500, 'easeOutQuint');
		});

		$('.reservation-submit .form-next-step').click(function(e){
			$('.otw-widget-form').submit();
			resetReservation();
		});

	}

	$('.loading-wrapper img').imagesLoaded(function() {
		$('.loading-wrapper img').addClass('ready');
	});

	$('.image-subnav').next('.subnav').addClass('hidden');
	stickyHeaders.bind();
	removePadding();
	home.init();
	navbar.init();
	mobileNav.show();
	subnav.show();
	blog.init();
	blogOpenSocial.init();
	// bindParallax();
	post_top_image.init();
	contact_map_section.init();
	unveil.init();
	reviews.init();
	gallery.init();
	menu.init();
	portfolioMasonry.init();
	overlay.init();
	scrollToUpBind();



	var players = [];

	$(".player").each(function(i, el) {
		var player = {};
		$(el).mb_YTPlayer();
		player.el = $(el);
		player.container = $(el).parent();

		if (!mobile && !ipad) {
			player.container.find(".video-controls .pause").click(function() {
				player.el.pauseYTP();
				player.container.find(".video-controls .pause").addClass('hidden');
				player.container.find(".video-controls .play").removeClass('hidden');
			});

			player.container.find(".video-controls .play").click(function() {
				player.el.playYTP();
				player.container.find(".video-controls .play").addClass('hidden');
				player.container.find(".video-controls .pause").removeClass('hidden');
			});

			player.container.find(".video-controls .fullscreen").click(function() {
				player.el.fullscreen();
			});
		} else {
			var url = player.el.data("property");
			var expression = '[-a-zA-Z0-9@:%_+.~#?&//=]{2,256}\\.[a-z]{2,4}\\b(\\/[-a-zA-Z0-9@:%_\\+.~#?&//=]*)';
			var regex = new RegExp(expression, 'gi');
			if (url.match(regex)) {
				url = url.match(regex);

				player.container.find(".video-controls .play").removeClass('hidden').click(function() {
					window.open(url, '_blank');
				});
			}

			player.container.find(".video-controls .pause").addClass('hidden');
			player.container.find(".video-controls .fullscreen").addClass('hidden');
		}
	});

	if (!mobile && !ipad) {
		$(".homepage .pause").click(function() {
			$(".homepage .player").pauseYTP();
			$(".homepage .pause").addClass('hidden');
			$(".homepage .play").removeClass('hidden');
		});

		$(".homepage .play").click(function() {
			$(".homepage .player").playYTP();
			$(".homepage .play").addClass('hidden');
			$(".homepage .pause").removeClass('hidden');
		});

		$(".homepage .fullscreen").click(function() {
			$(".player").fullscreen();
		});
	} else {
		var url = $('.homepage .player').data("property");
		var expression = '[-a-zA-Z0-9@:%_+.~#?&//=]{2,256}\\.[a-z]{2,4}\\b(\\/[-a-zA-Z0-9@:%_\\+.~#?&//=]*)';
		var regex = new RegExp(expression, 'gi');


		if (url && url.match(regex)) {
			url = url.match(regex);

			$(".homepage .play").removeClass('hidden').click(function() {
				window.open(url, '_blank');
			});
		}

		$(".homepage .pause").addClass('hidden');
		$(".homepage .fullscreen").addClass('hidden');
	}
	
	$('.to-the-top').click(function(e) {
		e.preventDefault();

		$('body').velocity("scroll", {
			duration: 1000
		});
	});
});

function repositionPicker() {
	if ($('#mobile-select').length > 0 && $('#rtb-time').length > 0) {
		$('#mobile-select').css('top', $('#rtb-time').offset().top);
		$('#mobile-select').css('left', $('#rtb-time').offset().left);
		$('#mobile-select').css('width', $('#rtb-time').outerWidth());
		$('#mobile-select').css('height', $('#rtb-time').outerHeight());
	}
}

$(window).load(function() {
	"use strict";

	bindParallax();

	if (!ipad && !mobile) {
		$('#rtb-time_root').addClass('desktop-version');
	} else {
		if ($('#rtb-time').length > 0) {
			if ($.browser.ios === true && !ipad) {
				var $input = $('#rtb-date').pickadate();

				var picker = $input.pickadate('picker');
				picker.on({
					open: function() {
						$('.content-wrapper').hide(0);
						$("html").velocity("scroll", { offset: -100 }).velocity("scroll", { offset: 0 });
					},
					close: function() {
						$('.content-wrapper').show();
						repositionPicker();
					},
				});
			}

			$('body').append('<div id="mobile-select" style="opacity: 0; position: absolute; background: red; width: 100px; z-index: 20;"><select id="time-select" style="width: 100%; height: 100%; -webkit-appearance:none;"></select></div>');

			repositionPicker();

			$(window).on('resize', $.debounce( 100, function() {
				repositionPicker();
			}));

			$('.picker--time .picker__list-item').each(function(i, el) {
				$('#time-select').append('<option value="' + $(el).data('pick') + '">' + $(el).html() + '</option>');
			});

			$("#time-select").on('change', function() {
				var str = "";
				var curr;

				$("select option:selected").each(function() {
					str += $( this ).text() + " ";
					curr = $(this).val();
				});

				$("#rtb-time").val(str);
				var picker = $('#rtb-time').pickatime('picker');
				picker.set('select', parseInt(curr, 10));
			});
		}
	}

	// stickyHeaders.bind();
	homeSlider.init();

	if ($('#preloader').length > 0) {
		$('.content-wrapper').velocity({opacity:1}, 0);
		$('#preloader').delay(1000).velocity({opacity: 0}, 500, function() {
			$(this).hide();
			animate_elements();
			if(!$('body').hasClass('show-nav')) {

				$('.home-2').addClass('loaded');
			}
		});
	} else {
		$('.content-wrapper').velocity({opacity:1}, 0);
		animate_elements();
		if(!$('body').hasClass('show-nav')) {

			$('.home-2').addClass('loaded');
		}
	}

	rating.init();
	$('.single-portfolio-carousel').each(function(i, el){
		singlePortfolioCarousel.init($(el));

	});
	
	menuCarousel.init();
	footer.init();
});

function removePadding() {
	if ($('.no-intro-padding').length > 0) {
		$('.no-intro').removeClass('no-intro');
	}
}

function animate_elements() {
	if (!ipad && !mobile) {
		if ($.waypoints) {
			var $obj=$('.yo-anim').each(function() {
				var delay=$(this).data('animation-delay');
				$(this).waypoint(function() {
					if (delay) {
						var $this = $(this);

						setTimeout(function() {
							$this.addClass('yo-anim-start');
						}, delay);
					} else {
						$(this).addClass('yo-anim-start');
					}
				}, {
					offset: '90%',
					triggerOnce: true
				});
			});
		}
	} else {
		$('.yo-anim').removeClass('yo-anim');
	}
}

var backgroundParallax = {
	init: function() {
		if ($('.parallax-layer').length > 0) {
			$('.home-parallax').parallax();
		}
	}
};

var unveil = {
	init : function() {
		$(".unveil img").unveil(-50, function() {
			$(this).load(function() {
				$(this).parents('.unveil').addClass('loaded');
			});
		});
	},
};

var portfolioMasonry = {
	init: function(el) {
		var portfolioItem = el;
		if ( $('.portfolio-masonry').length > 0 ) {

			$('.portfolio-masonry').isotope({
				itemSelector: 'article',
				percentPosition: true,
				transitionDuration: '0.4s',
				hiddenStyle: {
					opacity: 0,
					transform: 'translate3d(0, 30px, 0)',
					// transform: 'scale(1.2)',
				},
				visibleStyle: {
					opacity: 1,
					transform: 'translate3d(0, 0, 0)',
					// transform: 'scale(1)',
				},
				masonry: {
					columnWidth: '.grid-sizer'
				}
			});
		}
		$('#gallery2').on('click', '.list-category .filter', function(){
			var filter_val = $(this).data('filter');
			$('.portfolio-masonry').isotope({ filter: filter_val });


			if($(this).hasClass('active')) {
				return;
			}
			$('.list-category .filter').removeClass('active');
			$(this).addClass('active');
		
		});
	}
};

var scrollTop = function(){
	return (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
};


function scrollToUpBind() {
	if( $('.berg-overlay-to-bottom').length > 0 ) {

		//(scrollTop()> 350) ? $window.on('scroll', hideToTop) : $window.on('scroll', showToTop);
		if (scrollTop()> 60) {
			$window.on('scroll', $.throttle(50, hideToTop));
		} else {
			$window.on('scroll', $.throttle(50, showToTop));
		}
		hideToTop();
	}
}

function showToTop() {
	if (scrollTop()> 60) {
		$('.berg-overlay-to-bottom').addClass('hide-btn');
		$window.off('scroll', $.throttle(50, showToTop));
		$window.on('scroll', $.throttle(50, hideToTop));
	}
}

function hideToTop() {
	if (scrollTop()< 60) {
		$('.berg-overlay-to-bottom').removeClass('hide-btn');

		$window.off('scroll', $.throttle(50, hideToTop));
		$window.on('scroll', $.throttle(50, showToTop));
	}
}

var overlay = {
	oldScroll : 0,
	newScroll : 0,

	init: function() {
		var that = this;
		if(click == 'MSPointerDown' || click == 'pointerdown') {
			$('body').on('click', '.open-overlay', function(e) {
				e.preventDefault();
			});
		}

		$('body').on('click', '.open-overlay', function(e) {
			e.preventDefault();
			that.oldScroll = $(window).scrollTop();
			var id = $(this).data('postId');
			that.open(id);			
		});

		$('body').on('click', '.berg-overlay-close', function(e) {
			e.preventDefault();
			that.close();
		});
		$('.berg-overlay').on('click', '.berg-overlay-to-bottom span', function(e) {
			var offsetHeight = (($(".berg-overlay-gallery-wrapper").height())+($(".berg-overlay-header").height()));
			$("html").velocity("scroll", { offset: offsetHeight + 60, easing: [0.645, 0.045, 0.355, 1], duration: 1000 })
			$('.berg-overlay-to-bottom').addClass('hide-btn');
			$('.berg-overlay-content article').velocity({translateY: -30}, 0);
		}); 
		if (scrollTop()> 60) {
			$('.berg-overlay-to-bottom').addClass('hide-btn');
		}
		

	},

	open: function(id) {
		var that = this;

		$('.berg-overlay').show();
		var url = ajaxurl;
		$.post(url, { action : 'berg_load_single_portfolio', data : { 'id' : id}}, function(response) {
			// $(window).on('resize.overlay', $.debounce( 400, function(){
			// 	that.resize();
			// }));
			
			$('.berg-overlay').html(response);
			scrollToUpBind();
			that.carousel();

			$('.berg-overlay-background').velocity({ opacity: 1 }, { display: "block", duration: 0, complete: function(){
				// that.resize();
				$('.berg-overlay').velocity({opacity: 1}, 0, function(){
					$(window).scrollTop(0);
					$('body').addClass('berg-overlay-active');
					$('.berg-overlay-container').delay(100).velocity({opacity: 1}, function(){});
				});
			}});

		}, 'html');
	},
	close: function() {
		var that = this;
		$('body').removeClass('berg-overlay-active');
		$('.berg-overlay-container').delay(100).velocity({ opacity: 0 }, { complete: function(){
			$(window).scrollTop(that.oldScroll);
			$('.berg-overlay-background').velocity({ opacity: 0 }, { display: "none", complete: function(){
				$('.berg-overlay').velocity({opacity: 0}, {display: "none"});
				if ($('.berg-overlay-carousel').data('swiper')) {
					$('.berg-overlay-carousel').data('swiper').destroy(true,true);
				} 
			}});
		}});
	},

	carousel: function() {
		var that = this;
		var overlaySwiper = $('.berg-overlay-carousel');

		that.setHeight(overlaySwiper);
		$window.on('resize', jQuery.debounce( 300, function(){
			that.setHeight(overlaySwiper);
		}));

		if (overlaySwiper.find('.swiper-slide').length === 1) {
			// $('.berg-overlay .controls').addClass('hidden');
			$('.berg-arrow-right, .berg-arrow-left').hide();
			return;
		}
		overlaySwiper = new Swiper(overlaySwiper, {
			nextButton: '.berg-arrow-right',
			prevButton: '.berg-arrow-left',
			loop: true,
			// slidesPerView: 1,
			slidesPerView: 1,
			centeredSlides: true,
			speed: 700,
			spaceBetween: 0,	
			// effect: 'fade',
			grabCursor: true,	
			keyboardControl: true, 
			// onInit: function(){
			
			// }
		});
	},
	setHeight: function() {
		// console.log($('.berg-overlay-header').outerHeight());
		var overlaySwiper = $('.berg-overlay-carousel');
		if(window.outerWidth < 768) {
			if($('.berg-portfolio-lightbox').hasClass('lightbox-hide-desc')) {
				overlaySwiper.height($window.height());
			} else {
				var heightDescResize = $('.single-portfolio-header-wrapper').outerHeight();
				heightDescResize = heightDescResize + 30; 
				overlaySwiper.height($window.height() - heightDescResize);
			}
		} else {
			var heightHeaderResize = $('.berg-overlay-header').outerHeight()
			overlaySwiper.height($window.height() - heightHeaderResize);
		}
		
	}
}

var singlePortfolioCarousel = {
	init: function(el) {
		var portfolioSwiper;
		var that = this;
		// var loop = false;
		// var slides = 1;
		// var space = 0;
		// var centered = true;

		that.setHeight(el);
		// that.scrollToUpBind();
		$window.on('resize', jQuery.debounce( 300, function(){
			that.setHeight(el);
		}));

		if($('.single-portfolio-carousel .swiper-slide').length > 1) {
			
		} else {
			// $('.single-portfolio-carousel').removeClass('centered-slides');
			$('.single-portfolio-carousel .button-next, .single-portfolio-carousel .button-prev').hide();
			$('.single-portfolio-carousel').addClass('single-image-portfolio');
			return;
		}
		portfolioSwiper = new Swiper(el, {
			nextButton: '.button-next',
			prevButton: '.button-prev',
			loop: true,
			// slidesPerView: 1,
			slidesPerView: 'auto',
			centeredSlides: true,
			speed: 500,
			spaceBetween: 4,	
			// effect: 'coverflow',
			grabCursor: true,	
			keyboardControl: true, 
			// breakpoints: {

			//     992: {
			//         slidesPerView: 'auto',
			//         spaceBetween: 1,
			//     },
			//     768: {
			//         slidesPerView: 1,
			//         spaceBetween: 0
			//     },
			// }

		});
	
	},
	setHeight: function(el) {
		var heightHeaderResize = $('.berg-overlay-header').outerHeight() + $('.prev-next-post').outerHeight();
		if(window.outerWidth < 768) {
			// el.height('auto'); 
			el.height($window.height() /2 - 80);
		} else {
			
			el.height($window.height() - 80 - heightHeaderResize);
		}
		$('.berg-overlay-content').on('click', '.berg-overlay-to-bottom span', function(e) {
			$("html").velocity("scroll", { offset: heightHeaderResize + 60, easing: [0.645, 0.045, 0.355, 1], duration: 1000 });
			$('.berg-overlay-to-bottom').addClass('hide-btn');
		}); 
		if (scrollTop()> 60) {
			$('.berg-overlay-to-bottom').addClass('hide-btn');
		}
		
	}
}

var menuCarousel = {
	init: function() {
		var loop = true;
		var grabCursor = true;
		var centeredSlides = false;
		var virtualTranslate = false; 

		var thumbs = $('.gallery-thumbs');
		if(thumbs.find('.swiper-slide').length < 4) {
			thumbs.find('.swiper-next, .swiper-prev').addClass('hidden');
			loop = false;
			grabCursor = false; 
			centeredSlides = virtualTranslate = true;
			thumbs.find('.swiper-slide').css('cursor', 'pointer');
			// console.log(thumbs);
		} else {
			thumbs.find('.swiper-next, .swiper-prev').removeClass('hidden');
		}

		if(thumbs.find('.swiper-slide').length < 2) {
			$('.gallery-top .swiper-next, .gallery-top .swiper-prev').addClass('hidden');
			$('.gallery-thumbs').hide();
			return;
		}
		var galleryTop = new Swiper('.gallery-top', {
			nextButton: '.swiper-next',
			prevButton: '.swiper-prev',
			spaceBetween: 0,
			loopedSlides: 4,
			grabCursor: true,
			loop: loop,
		});
		var galleryThumbs = new Swiper('.gallery-thumbs', {
			spaceBetween: 0,
			// nextButton: '.swiper-next',
			// prevButton: '.swiper-prev',
			slidesPerView: 4,
			loop: loop,
			loopedSlides: 4,
			grabCursor: grabCursor,
			touchRatio: 0.2,

			
			centeredSlides: centeredSlides,
			virtualTranslate: virtualTranslate,
			
			slideToClickedSlide: true,


		});
		// galleryThumbs.activeIndex = galleryTop.activeIndex;
		if(thumbs.find('.swiper-slide').length < 4) {
			if(galleryTop.activeIndex == '0') {
				$('.gallery-top .swiper-prev').addClass('hidden');
			} else {
				$('.gallery-top .swiper-prev').removeClass('hidden');
			}

			galleryTop.on('TransitionEnd', function () {

				if(galleryTop.activeIndex == $('.gallery-top .swiper-slide').length -1) {
					$('.gallery-top .swiper-next').addClass('hidden');
				} else {
					$('.gallery-top .swiper-next').removeClass('hidden');
				}
				if(galleryTop.activeIndex == '0' ) {
					$('.gallery-top .swiper-prev').addClass('hidden');
				} else {
					$('.gallery-top .swiper-prev').removeClass('hidden');
				}
			});
		}

		// galleryThumbs.setWrapperTranslate(0);
		galleryTop.params.control = galleryThumbs;
		galleryThumbs.params.control = galleryTop;
		// galleryThumbs.activeIndex = galleryTop;
	}
	// resize: function() {

	// }
}


var prefix = (function () {
	var styles = window.getComputedStyle(document.documentElement, ''),
	pre = (Array.prototype.slice
		.call(styles)
		.join('')
		.match(/-(moz|webkit|ms)-/) || (styles.OLink === '' && ['', 'o'])
		)[1],
	dom = ('WebKit|Moz|MS|O').match(new RegExp('(' + pre + ')', 'i'))[1];
	return {
		dom: dom,
		lowercase: pre,
		css: '-' + pre + '-',
		js: pre[0].toUpperCase() + pre.substr(1)
	};
})();


function bindResizeIntro(){
	if($('.section-intro').length > 0) {
		var $intro = $('.section-intro');
		var height = $(window).height();
		if($intro.hasClass('section-intro-half')) {
			height = height / 2;
		} else if($intro.hasClass('section-intro-custom')) {
			height = $intro.data('height');
		}
		$intro.height(height + 10);
		$('.section-space').height(height);

		$(window).on('resize.intro', function(){
			height = $(window).height();
			if($intro.hasClass('section-intro-half')) {
				height = height / 2;
			} else if($intro.hasClass('section-intro-custom')) {
				height = $intro.data('height');
			}	
			$intro.height(height + 10);
			$('.section-space').height(height);
		});
	}
}
function unbindResizeIntro(){
	$(window).off('resize.intro');
	setTimeout(function(){
	   $('.section-intro').css('height', 'auto');
	},50)	
}


var $transform = prefix['js']+'Transform';


(function() {
	'use strict';
	var parallaxIntro = $('.section-intro-parallax')[0]
	var speedFactor1 = 0.2;
	var speedFactor2 = 0.1;
	var speedFactor3 = 0.15;
	var opacity = 100;
	var height = $(window).height()/2;
	opacity = (height / opacity);
	opacity = (1 / opacity)/100;
	var newOpacity = 0;
	var bgOpacity = 0;
	var $parallaxIntro1 = $('.parallax-element-first');
	var $parallaxIntro2 = $('.parallax-element-second');
	var $img = $('.section-intro');
	var firstTop = 0;
	var $bg = '';
	var startOpacity = $img.data('opacityStart') / 100;
	var endOpacity = $img.data('opacityEnd') / 100;

	var sectionIntro = {
		active : false,
		init : function(){
			var that = this; 
			if($('.section-intro').length === 0 || $('body').hasClass('fullpage-scroll') || $('body').hasClass('home-page'))
				return false;		
			if($('.section-intro').data('background')) {
				$(".section-intro").backstretch($('.section-intro').data('background'));
				$bg = $('.backstretch img');
			} else {
				if($('.bg-section').length > 0)
					$bg = $('.bg-section');
			}
			this.handler();
			requestAnimationFrame(this.handler);
			if($(window).width() > 991) {
				that.bindParallaxIntro();
				that.active = true;
			}

			$(window).on('resize.parallax', function(){
				if($(window).width() > 991) {
					that.bindParallaxIntro();
					that.active = true;
				} else {
					that.unbindParallaxIntro();
				}
			}); 

			$(window).on('bindParallaxIntro', function(){
				that.bindParallaxIntro();
			});
			$(window).on('unbindParallaxIntro', function(){
				that.unbindParallaxIntro();
			});
		},

		bindParallaxIntro : function() {
			requestAnimationFrame(this.handler);
			if(this.active === true)
				return false;

			var that = this;
			this.active = true;
			$(window).on('scroll.parallax', function(){
				requestAnimationFrame(that.handler);
			});
		},

		unbindParallaxIntro : function() {
			if(this.active === false)
				return false;

			$(window).off('scroll.parallax');
			this.active = false; 
			$('.parallax-element-first, .parallax-element-second').attr('style', '');
			$('.section-intro').velocity({translateY: 0}, 0)
			$('.section-intro .backstretch img, .section-bg').velocity({opacity: $('.section-intro').data('opacityStart') / 100}, 0)
		},

		handler : function(){
			var that = this;
			var pos = $(window).scrollTop();

			if(pos > height) {
				newOpacity = 0;
			} else {
				newOpacity = 1 - (opacity*pos);
			}

			if(endOpacity > startOpacity) {
				bgOpacity = startOpacity + (opacity * pos);
				if(bgOpacity >= endOpacity)
					bgOpacity = endOpacity;
			} else {
				bgOpacity = startOpacity - (opacity * pos);
				if(bgOpacity <= endOpacity)
					bgOpacity = endOpacity;
			}
			
			$img[0].style[$transform] = "translateY("+ Math.round((firstTop - pos) * speedFactor1) + "px) translateZ(0px)";

			if($parallaxIntro1[0] !== undefined) {
				$parallaxIntro1[0].style[$transform] = "translateY("+ Math.round((firstTop - pos) * speedFactor2) + "px) translateZ(0px)";
				$parallaxIntro1[0].style['opacity'] = newOpacity;
			}

			if($parallaxIntro2[0] !== undefined) {
				$parallaxIntro2[0].style[$transform] = "translateY("+ Math.round((firstTop - pos) * speedFactor3) + "px) translateZ(0px)";				
				$parallaxIntro2[0].style['opacity'] = newOpacity;
			}
			if($bg !== '')
				$bg[0].style['opacity'] = bgOpacity;
		},
	};
	
	sectionIntro.init();

}())

var menu = {
	init: function() {
		var that = this;
		var scrollspy = true;
		if ($('.grid').length > 0) {
			$('.grid').masonry({
				itemSelector: '.grid-item',
				percentPosition: true
			});
		}

		var offsetFilter = '';

		if($(window).width() <= 991) {
			offsetFilter = -80;
		} else {
			offsetFilter = -$('.list-category-wrapper').height()-80;
		}
		$(window).on('resize', function(){
			if($(window).width() <= 991) {
				offsetFilter = -80;
			} else {
				offsetFilter = -$('.list-category-wrapper').height()-80;
			}
		});
	
		
		if (document.location.hash !== '') {
			scrollspy = false;
			var filterClass = '.'+document.location.hash.substring(1)
			$('.filter.active').removeClass('active');
			$('.filter[data-filter="'+filterClass+'"]').addClass('active');
			$(filterClass).velocity("scroll", {
				duration: 800,
				easing: 'easeInOutCubic',
				offset: offsetFilter,
				complete: function(){
					scrollspy = true;
				}
			});

		}

		if($('.list-category-wrapper').length > 0) {
			$('.list-category').on('click', '.filter', function(e){
				if(!$('.list-category .filter').hasClass('product-filter-link')) {
					e.preventDefault();
				}
				$('.filter.active').removeClass('active');
				scrollspy = false;
				var filterClass = $(this).data('filter');
				$('.filter[data-filter="'+filterClass+'"]').addClass('active');
				$(filterClass).velocity("scroll", {
					duration: 800,
					easing: 'easeInOutCubic',
					offset: offsetFilter,
					complete: function(){
						scrollspy = true;
					}
				});

				document.location.hash = filterClass.substring(1);
			})
			$('.menu-content > div').each(function(i, el){
				$(el).waypoint(function(direction){
					if(direction == 'up' && scrollspy == true) {
						$('.filter.active').removeClass('active');
						$('.filter[data-filter=".'+$(this).attr('class')+'"]').addClass('active');
					}
				}, {

					offset: -$(el).height()+$('.list-category-wrapper').height()+110,
				})

				$(el).waypoint(function(direction){
					if(direction == 'down' && scrollspy == true) {
						$('.filter.active').removeClass('active');
						$('.filter[data-filter=".'+$(this).attr('class')+'"]').addClass('active');
					}
				}, {
					offset: $('.list-category-wrapper').height()+110,
				})			
			})
		}

		window.onhashchange = function() {
			if($('.list-category-wrapper').length > 0) {
				scrollspy = false;
				var filterClass = '.'+document.location.hash.substring(1)
				$('.filter.active').removeClass('active');
				$('.filter[data-filter="'+filterClass+'"]').addClass('active');
				$(filterClass).velocity("scroll", {
					duration: 800,
					easing: 'easeInOutCubic',
					offset: offsetFilter,
					complete: function(){
						scrollspy = true;
					}
				});
			}
		};

		that.lazyLoad();
		that.resizeDots();
		$(window).on('resize', function(){
			that.resizeDots();
		});
		that.show();
		that.resize();
	
	},
	lazyLoad: function() {
		$('.menu-content').find('.menu-item').each(function() {
			var $t = $(this),
			$img = $(this).find('img'),
			src = $img.attr('data-src');

			$img.on('load',function() {
				imgLoaded($img);
			});

			if (!$img.hasClass('lazyloaded')) {
				$img.attr('src',src).addClass('lazyloaded');
			}
		});
	},
	show: function() {
		$('#second-menu .menu-item').height($('#second-menu .menu-item').width());
	},
	resize: function(el) {
		var that = this;
		$(window).on('resize.menu', function(){
			that.show();
		});
	},
	resizeDots: function() {
		
		$('#menu-list-new .menu-content .menu-item').each(function(){
			var that = this;
			var start = $(that).find('.icon-food:last').position().left;
			var iconWidth = $(that).find('.icon-food').width();
			var label = $(that).find('.food-badges').outerWidth();
			var end = $(that).find('.menu-details').position().left;
			var priceWidth =  $(that).find('.menu-details').width();
			if($(that).find('.food-badges').length > 0) {
				labelWidth = label + 8;
			} else {
				labelWidth = 0;
			}

			$(that).find('.dots').width((end - start) - iconWidth - labelWidth - 2);
			$(that).find('.dots').css('right', priceWidth+'px');

		});

	},
	destroy: function() {
		$(window).off('resize.menu');
		$('#second-menu .menu-item').height('auto');
	}
};

$('body').on('intro-end', function() {
	unveil.init();
	navbar.open();
});

var navbar = {
	wrapper: $('body'),

	init: function() {


		var that = this;
		if(that.wrapper.hasClass('show-nav')) {
			var showed = true;
		} else {
			showed = false;
		}
		$('.main-reorder').on(click, function(e) {
			e.preventDefault();
			if (showed === true){
				if($(this).find('.burger-menu').hasClass('active')) {
					$(this).find('.burger-menu').removeClass('active');
				} else {
					$(this).find('.burger-menu').addClass('active');
				}
				$('.home-2').addClass('loaded');
				that.close();
				showed = false;
				// that.wrapper.find('.main-nav').css('overflow', 'hidden');
			} else {
				if($(this).find('.burger-menu').hasClass('active')) {
					$(this).find('.burger-menu').removeClass('active');
				} else {
					$(this).find('.burger-menu').addClass('active');
				}
				$('.home-2').removeClass('loaded');
				// that.wrapper.find('.main-nav').css('overflow', 'visible');	
				that.open();
				showed = true;				
			}
		});

		$('.nav-alt .main-nav > ul > li').on('mouseenter', function(){
			var subnav = $(this);
			var subnavWrapper = subnav.children('.subnav');
			var maxWidth = subnavWrapper.width() * 2;
			var subnavOffset = 0;
			if(subnavWrapper.length > 0) {

				subnavWrapper.removeClass('next-level-left');
				if($window.width() - subnavWrapper.offset().left < (maxWidth)) {
					subnavWrapper.removeClass('next-level-left');
				} else {
					subnavWrapper.addClass('next-level-left');
				}

				subnavWrapper.css('left', '');
				if(subnavWrapper.offset().left + subnavWrapper.width() > $window.width()) {
					subnavOffset = subnavWrapper.width() + subnavWrapper.offset().left - $window.width()+15;
					subnavWrapper.css('left', '-'+subnavOffset+'px');
				}
			}
		})

	},
	open: function() {
		var that = this;
		that.wrapper.addClass('show-nav');	

	},
	close: function() {
		var that = this;
		that.wrapper.removeClass('show-nav');
	}
};

var	subnav = {
	show: function() {
		if(!ipad && !mobile) {
			if($('body').hasClass('home-page') && !$('body').hasClass('page-template-homepage2') && $('#main-navbar-home').length == 0) {
				var newHeight = ($(window).height() / 2) - ($('.main-nav').height() / 2) - 80;
				$('.image-subnav').height(newHeight);
				$('.image-subnav div').height(newHeight);
			}

			$('.submenu-languages').addClass('subnav-wrapper').wrap('<div class="subnav"></div>');
			$('#main-navbar .main-nav ul li').hover(function() {
				subnav = $(this).find('.subnav-wrapper');
				var newPos = $(this).offset().left - subnav.width() / 2 + $(this).width() / 2 + 15;
				var adjustment = 0;

				if (newPos + subnav.width() > $(window).width()) {
					adjustment = newPos + subnav.width() - $(window).width();
				}
				if (newPos < 0) {
					newPos = 0;
				}
				subnav.css('left', newPos - adjustment);
			});
		} else {
			$('#main-navbar .main-nav > ul > li').addClass('touch-inactive');
			$('#main-navbar .main-nav').on(click, '.touch-inactive', function(e){
				e.preventDefault();
				$('.main-nav > ul > li.touch-active').removeClass('touch-active').addClass('touch-inactive');
				$(this).addClass('touch-active').removeClass('touch-inactive');
			})
		}
	}
};

var mobileNav = {
	show: function() {
		this.open();
		this.close();
	},
	open: function() {
		var that = this;
		$('.reorder a').on(click, function(e) {
			e.preventDefault();

			if ($('body').hasClass('mobile-nav-show')) {
				$(this).parent().removeClass('flyout-open');
				if($('.reorder').find('.burger-menu').hasClass('active')) {
					$('.reorder').find('.burger-menu').removeClass('active');
				} else {
					$('.reorder').find('.burger-menu').addClass('active');
				}
				$('.flyout-container').velocity({height: 0}, { complete: function() {
					$('.flyout-container .open').css('height', 0).removeClass('open');
					$('.flyout-container .subnav-open').removeClass('subnav-open');
					
				}});
			
				$('body').removeClass('mobile-nav-show');

			} else {
				$(this).parent().addClass('flyout-open');
				if($('.reorder').find('.burger-menu').hasClass('active')) {
					$('.reorder').find('.burger-menu').removeClass('active');
				} else {
					$('.reorder').find('.burger-menu').addClass('active');
				}
				$('.flyout-container').velocity({height: $('.flyout-container .menu > li').height() * $('.flyout-container .menu > li').length}, { complete: function() {
					$('.flyout-container').css('height', 'auto');
					
				}});

				$('body').addClass('mobile-nav-show');
			}
			
		});

		$('.flyout-container .menu-item .open-children, .flyout-container .menu-item a').on('click', function(e) {
			if($(this).attr('href') !== undefined) {
				return
			}

			e.preventDefault();
			var that = this;
			if ($(this).siblings('.subnav-wrapper').length > 0) {
				//has submenu
				if ($(this).siblings('.subnav-wrapper').hasClass('open')) {

					$(this).parent().removeClass('subnav-open');

					$(this).siblings('.subnav-wrapper').velocity({height: 0}, { complete: function() {
						$(that).siblings('.open').removeClass('open');
						$(that).siblings('.subnav-wrapper').find('.open').css('height', 0).removeClass('open');
						$(that).siblings('.subnav-wrapper').find('.subnav-open').removeClass('subnav-open');
					}});
				} else {
					$(this).parent().addClass('subnav-open');
					$(this).siblings('.subnav-wrapper').velocity({height: $(this).siblings('.subnav-wrapper').children('li').height() * $(this).siblings('.subnav-wrapper').children('li').length}, { complete: function() {
						$(that).siblings('.subnav-wrapper').css('height', 'auto').addClass('open');
					}});
				}
			}
		});
	},
	close: function() {
		$('.flyout-container .menu-item a').on('click', function() {
			if($(this).attr('href') === undefined) {
				return
			}
			var that = this;
			if($('.reorder').find('.burger-menu').hasClass('active')) {
				$('.reorder').find('.burger-menu').removeClass('active');
			}
			$(".flyout-container .menu-item .open-children").parent().removeClass('subnav-open');
			$('.flyout-container').velocity({height: 0}, { complete:  function() {
				$('.flyout-container .open').css('height', 0).removeClass('open');
				$('body').removeClass('mobile-nav-show');
			}});
		});
	},
};

var verticalSlider = {
	init: function() {
		if ($('body').hasClass('fullpage-scroll')) {
			$('#restaurant').fullpage({
				// easing :'swing',
				scrollingSpeed: 900,
				css3: true,
				resize: false,
				autoScrolling: true,
				paddingTop: 0,
				paddingBottom: 0,
				normalScrollElementTouchThreshold: 1,
				verticalCentered: false,
				navigation: true,
				navigationPosition: 'right',
				onLeave: function(index, nextIndex, direction){
					var current = index-1;
					if(mobile || ipad)
						return;
					if($('.item:eq('+current+') .player').length > 0) {
						$('.item:eq('+current+') .player').pauseYTP();
						$('.item:eq('+current+')').find(".video-controls .pause").addClass('hidden');
						$('.item:eq('+current+')').find(".video-controls .play").removeClass('hidden');
					}
				},
				afterLoad: function(anchorLink, index){
					var current = index-1;
					if(mobile || ipad)
						return;
					if($('.item:eq('+current+') .player').length > 0) {
						$('.item:eq('+current+') .player').playYTP();
						$('.item:eq('+current+')').find(".video-controls .pause").removeClass('hidden');
						$('.item:eq('+current+')').find(".video-controls .play").addClass('hidden');
					}
				},
			});
		};
		if ($('.fp-section').length > 1){
			$('#fp-nav').show();
		} else { 
			$('#fp-nav').hide();
		}
	},

	destroy: function(){
		if($.fn.fullpage.destroy !== undefined)
			$.fn.fullpage.destroy('all');
	},
};

var footer = {
	init: function() {
	   this.resize();
	   $(window).on('resize', function(){
		   footer.resize();
	   });
	},
	resize: function() {
	   $('#footer-spacer').height($('#footer').outerHeight());
	}    
};

var gallery = {
	page: 2,
	init: function() {
		var that = this;
		var first = true;
		$('.gallery-content').mixItUp({
			animation: {
				animateResizeContainer: true,
				effects: 'fade',
				easing: 'ease',
			},
			layout: {
				display: 'inline-block'
			},
			callbacks: {
				onMixEnd: function(){
					that.lazyLoad();
				},

			}
		});
		$('#gallery').on(click, '.load-more-text button, .load-more-text span', function(e) {
			e.preventDefault();
			that.loadMore();
		});
		$('#gallery2').on(click, '.load-more-text button, .load-more-text span', function(e) {
			e.preventDefault();
			that.loadMoreMasonry();
		});
	},
	lazyLoad: function() {
		$('#gallery').find('.mix:visible').each(function() {
			var $t = $(this),
				$img = $(this).find('img'),
				src = $img.attr('data-src');

			$img.on('load',function() {
				imgLoaded($img);
			});

			if (!$img.hasClass('lazyloaded')) {
				$img.attr('src',src).addClass('lazyloaded');
			}
		});
	},
	loadMore: function() {
		var that = this;
		var url = ajaxurl;

		if (url === '' || url === undefined) {
			return false;
		}

		$('.js-loading').velocity('fadeIn', 0);
		$('.load-more-text').velocity({opacity: 0}, 200, function(){});

		$.post(url, { action : 'berg_load_more_portfolio', data : { 'pageId' : pageId, 'page' : that.page }}, function(response) {
			$('.new-content').html(response);
			if($('.new-content .load-more').length > 0) {
				$('#gallery > .load-more').replaceWith($('.new-content .load-more'));

			} else {
				$('#gallery > .load-more').remove();
			}

			$('.gallery-content').mixItUp('append', $('.new-content .mix'));
				$('.js-loading').velocity('fadeOut');
				that.page = that.page + 1;
				if(that.page > $('.gallery-content').data('pages')) {
					$('.load-more-text button, .load-more-text span').html(translation.no_more_posts);
					$('.load-more-text').addClass('no-more-posts');
					$('#blog-squares, #blog-classic, #blog-list, #blog-new-masonry').off(click, '.load-more-text button, .load-more-text span');
				} else {
					$('.load-more-text').removeClass('no-more-posts');
				}

				if($('.no-more-posts').length > 0) {
					$('.load-more').velocity('slideUp');
				} else {
					$('.load-more-text').delay(400).velocity('fadeIn', { duration: 400, complete: function(){
						$('.portfolio-masonry .new-element').removeClass('new-element');
					}});
				}

		}, 'html');
		return true;
	},

	loadMoreMasonry: function() {
		var that = this;
		var url = ajaxurl;

		if (url === '' || url === undefined) {
			return false;
		}
		$('.js-loading').velocity('fadeIn', 0);
		$('.load-more-text').velocity({opacity: 0}, 200, function(){});
		$.post(url, { action : 'berg_load_more_portfolio_masonry', data : { 'pageId' : pageId, 'page' : that.page, 'layout': $('#gallery2 .load-page-counter').data('nextLayout') }}, function(response) {
			$('#gallery2').find('.load-page-counter').remove();
			setTimeout(function(){
				that.addMasonry(response);
			}, 200);
			that.page++;
		}, 'html');
		return true;
	},

	addMasonry: function(response) {
		$('#gallery2 .hidden-content').html(response);

		var items = $('.portfolio-masonry .hidden-content article').css('display', 'none').addClass('new-element'),
			pageControl = $('.portfolio-masonry .load-page-counter'),
			that = this;
		
		$.each(items, function(){
			$(this).css('display', 'none').addClass('new-element');
		});

		$('.portfolio-masonry .hidden-content').waitForImages(function() {
			$('.js-loading').velocity('fadeOut');
			setTimeout(function(){
				$('.portfolio-masonry').isotope('insert', items).isotope('layout').append(pageControl);
				if($('.no-more-posts').length > 0) {
					$('.load-more').velocity('slideUp');
				} else {
					$('.load-more-text').delay(400).velocity('fadeIn', { duration: 400, complete: function(){
						$('.portfolio-masonry .new-element').removeClass('new-element');
					}});
				}
				that.loadStatus = true;
			},300);

		});
		
		return true;
	}
};

var blog = {
	page: 2,
	init: function() {
		var that = this;
		$('.load-post').removeClass('load-post');
		$('#blog-squares, #blog-classic, #blog-list').on(click, '.load-more-text button, .load-more-text span', function(e) {
			e.preventDefault();
			that.loadMore();

		});

		$('#blog-new-masonry').on(click, '.load-more-text button, .load-more-text span', function(e) {
			e.preventDefault();
			var nextPage = parseInt($('#blog-new-masonry').find('.load-page-counter').data('next-page')),
				layoutIndex = parseInt($('#blog-new-masonry').find('.load-page-counter').data('next-layout')),
				maxPages = parseInt($(this).data('max-pages'));

			that.loadMoreMasonry(nextPage, layoutIndex, maxPages);
		});

		if ( $('.blog-masonry').length > 0 ) {
			$('.blog-masonry').isotope({
				itemSelector: 'article',
				percentPosition: true,
				transitionDuration: '0.4s',
				hiddenStyle: {
					opacity: 0,
					transform: 'translate3d(0, 30px, 0)',
					// transform: 'scale(1.2)',
				},
				visibleStyle: {
					opacity: 1,
					transform: 'translate3d(0, 0, 0)',
					// transform: 'scale(1)',
				},
				masonry: {
					columnWidth: '.grid-sizer'
				}
			});
		}
	},
	loadMore: function() {
		var that = this;
		var url = ajaxurl;

		if (url === '' || url === undefined) {
			return false;
		}


		$('.js-loading').velocity('fadeIn', 0);
		$('.load-more-text').velocity({opacity: 0}, 200, function(){});

		$.post(url, { action : 'berg_load_more_posts', data : { 'pageId' : pageId, 'page' :that.page } },function(response) {
			setTimeout(function(){
				that.add(response);
			}, 200);

		}, 'html');

		return true;
	},

	loadMoreMasonry: function(nextPage,layoutIndex, maxPages) {
		// console.log('loadmore masonry');
		var that = this;
		var url = ajaxurl;

		if (url === '' || url === undefined) {
			return false;
		}

		$('.js-loading').velocity('fadeIn', 0);
		$('.load-more-text').velocity({opacity: 0}, 200, function(){});

		$.post(url, { action : 'berg_load_more_posts_masonry', data : { 'pageId' : pageId, 'page' : that.page, 'customLayout': $('#blog-new-masonry').data('customLayout'), 'layout': $('.blog-masonry .load-page-counter').data('nextLayout') } },function(response) {
			$('.blog-masonry').find('.load-page-counter').remove();
			setTimeout(function(){
				that.addMasonry(response);
			}, 200);

		}, 'html');
		that.page++;

		return true;		
	},

	addMasonry: function(response) {
		$('.blog-masonry .hidden-content').html(response);

		var items = $('.blog-masonry .hidden-content article').css('display', 'none').addClass('new-element'),
			pageControl = $('.blog-masonry .load-page-counter'),
			that = this;
		
		$.each(items, function(){
			$(this).css('display', 'none').addClass('new-element');
		});

		$('.blog-masonry .hidden-content').waitForImages(function() {
			$('.js-loading').velocity('fadeOut');
			setTimeout(function(){
				$('.blog-masonry').isotope('insert', items).isotope('layout').append(pageControl);
				if($('.no-more-posts').length > 0) {
					$('.load-more').velocity('slideUp');
				} else {

					$('.load-more-text').delay(400).velocity('fadeIn', { duration: 400, complete: function(){
						$('.blog-masonry .new-element').removeClass('new-element');


					}});
				}
				that.loadStatus = true;
			},300);

		});
		
		return true;
	},


	add: function(response) {
		var that = this;

		var oldHeight = $('#blog-content-append').height();
		$('#blog-content-append').height(oldHeight);
	
		// $(this).remove();
		$('#blog-content-append').append(response);
		$('.js-loading').velocity('fadeOut', 300, function(){

		$('#blog-content-append .load-post').imagesLoaded(function() {
			var newHeight = 0;
			$('.load-post').each(function(i, el) {
				newHeight += $(el).height();
			});

			$('#blog-content-append').velocity({height : oldHeight + newHeight }, { duration: 300, complete : function() {
				$.waypoints('refresh');

				setTimeout(function() {
					$('#blog-content-append .load-post').removeClass('load-post');
					$('#blog-content-append').height('');
					that.page = that.page + 1; 
					if(that.page > $('#blog-content-append').data('pages')) {
						$('.load-more-text button, .load-more-text span').html(translation.no_more_posts);
						$('.load-more-text').addClass('no-more-posts');
						$('#blog-squares, #blog-classic, #blog-list, #blog-new-masonry').off('click', '.load-more-text button, .load-more-text span');
					} else {
						$('.load-more-text').removeClass('no-more-posts');
					}
					$('.load-more-text').velocity({opacity: 1}, 200, function(){});
					if($('.no-more-posts').length > 0) {
						$('.load-more').velocity('slideUp');
					}
				}, 400);

				$(".unveil img").unveil(-50, function() {
					$(this).load(function() {
						$(this).parents('.unveil').addClass('loaded');
					});
				});

			}});
		});
		});
		
	}
};

var blogOpenSocial = {
	init: function() {
		var that = this;
		var socialOpen = false;
		$('#blog-list .post-share').on("click", 'a', function(e){
			e.preventDefault();
			if(socialOpen === true)
				return;

			socialOpen = true;
			var content = $(this).parents('.post-details').siblings('.post-content');
			var share = $(this).parents('.post-details').siblings('.social-share');
			content.addClass('open-social-share');
			share.find('li').velocity("transition.slideDownIn", { stagger: 50, duration: 400, drag: true, delay: 150 });

			setTimeout(function(){
				
				$(document).on('click.social', function(e){
						$(document).off('click.social');
						content.removeClass('open-social-share');	
						share.find('li').velocity({opacity: 0}, { duration: 300 });					
					socialOpen = false;

				});
			},0);
		});
	},
}

var home = {
	init: function() {
		this.resize();
		var that = this;
		$(window).resize(function(){
			that.resize();
		});
		
	},

	resize: function() {
		$('.mobile-homepage').css('min-height', $('body').height() - $('#mobile-nav').height());
		if (mobile) {
			return;
		}
		$('.main-section .basic-info').parent().css('min-height', $(window).height() );
		$('.main-section .basic-info').css('margin-top', ($(window).height() / 2) + 40);
		if($('body').hasClass('nav-center')) {
			$('#main-navbar').css('top', ($(window).height() / 2));
			$('#main-navbar-home').css('top', ($(window).height() / 2));
		}
	}

}

var homeSlider = {
	init: function() {
		if (mobile) {
			return;
		}

		if($('#slides').length === 0)
			return;

		var sliderInfinite = false;

		$.fn.superslides.fx = $.extend({
			fadeTransition: function(orientation, complete) {
				var that = this,
				$children = that.$container.children(),
				$outgoing = $children.eq(orientation.outgoing_slide),
				$target = $children.eq(orientation.upcoming_slide);

				$target.css({
					left: this.width,
					opacity: 1,
					display: 'block'
				});

				// $('.slides-text li:eq('+orientation.outgoing_slide+') .slide-content-wrapper').removeClass('current-slide');
				// $('.slides-text li:eq('+orientation.upcoming_slide+') .slide-content-wrapper').addClass('current-slide');

				$target.velocity({scale:1},0);

				if (orientation.outgoing_slide >= 0) {
					$outgoing.velocity({
						opacity: 0,
						scale: 1.5,
					},
					that.options.animation_speed,
					function() {
						if (that.size() > 1) {
							$children.eq(orientation.upcoming_slide).css({
								zIndex: 2
							});

							if (orientation.outgoing_slide >= 0) {
								$children.eq(orientation.outgoing_slide).css({
									opacity: 1,
									display: 'none',
									zIndex: 0
								});
							}
						}

						complete();
					});
				} else {
					$target.css({
						zIndex: 2
					});
					complete();
				}
			}
		}, $.fn.superslides.fx);

		$('#slides').superslides({
			animation: 'fadeTransition',
			animation_speed: 1500,
			play: slideDuration,
			inherit_height_from: 'body',
		});

		$('#arrow-right').click(function(e) {
			e.preventDefault();
			$('#slides').superslides('animate', 'next');
		});

		$('#arrow-left').click(function(e) {
			e.preventDefault();
			$('#slides').superslides('animate', 'prev');
		});
		$(window).resize();
	}
};

var reviews = {
	init: function() {
		var that = this;
		var owl = $("#reviews-carousel");
		var loop = true;
		var nav = true;
		if ($('#reviews-carousel').find('.item').length === 1) {
			loop = false;
			nav = false;
		}

		owl.owlCarousel({
			items: 1,
			loop: loop,
			margin:10,
			nav:nav,
			autoplay:true,
			autoplayTimeout:5000,
			autoplayHoverPause:true,
			autoplaySpeed: 1500,
			navText: ['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>'],
			dots: false,
			onInitialized: function() {
				var controls = owl.find('.owl-controls');
				controls.prependTo($(".controls-reviews"));
			},
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			}
		});
	}
};

var rating = {
	init: function() {

		this.initStars();

		var ratingWidth = $('.rating-select span').width();
		var step = ratingWidth / 5;

		$('.rating-select').mousemove(function(e) {
			var x = e.pageX -  $(this).offset().left;
			x = Math.ceil(x / step) * step;
			$('.rating-select span span').width(x);
			$(this).data('rating', x/step);
		});

		$('.rating-select').mouseleave(function(e) {
			var newWidth = $(this).find('select').val();
			$('.rating-select span span').width(newWidth*step);
		});

		$('.rating-select').click(function(e) {
			e.preventDefault();
			$(this).find('select').val($(this).data('rating'));
		});
	},

	initStars: function() {
		$('.star-rating').each(function(i, el){
			$(el).find('span').wrap('<span></span>');
			$(el).find('span span').html('');
		})
	}
};

$("#comments-form").submit(function(e) {
	$('#comments-form .form-control').removeClass('#comments-form message-error');
	$.post("comments-send.php", $('#comments-form').serialize(), function(data) {
		if (data.status === 'ok') {
			$("#comments-form .message-success").removeClass('hidden').velocity({ opacity : 1 });
			$("#comments-form .button-submit").addClass('button-transparent');
			$('#comments-form .form-control').val('');

			setTimeout(function() {
				$("#comments-form .message-success").velocity({ opacity : 0 }, function() {
					$(this).addClass('hidden');
				});
				$("#comments-form .button-submit").removeClass('button-transparent');
			}, 3000);
		} else {
			$.each(data.errors, function(i, e) {
				$('.' + i).addClass('#comments-form message-error');
			});
		}
	}, 'json');
	e.preventDefault();
});

$("#comments-form").on('keyup', '.contact-form', function() {
	var that = this;
	if ($(this).val() !== '') {
		$(this).removeClass('message-error');
	} else {
		$(that).addClass('message-error');
	}
});

$("#reviews-form").submit(function(e) {
	$('#reviews-form .form-control').removeClass('#reviews-form message-error');
	$.post("reviews-send.php", $('#reviews-form').serialize(), function(data) {
		if (data.status === 'ok') {
			$("#reviews-form .message-success").removeClass('hidden').velocity({ opacity : 1 });
			$("#reviews-form .button-submit").addClass('button-transparent');
			$('#reviews-form .form-control').val('');
			setTimeout(function() {
				$("#reviews-form .message-success").velocity({ opacity : 0 }, function() {
					$(this).addClass('hidden');
				});
				$("#reviews-form .button-submit").removeClass('button-transparent');
			}, 3000);
		} else {
			$.each(data.errors, function(i, e) {
				$('.' + i).addClass('#reviews-form message-error');
			});
		}
	}, 'json');
	e.preventDefault();
});

$("#reviews-form").on('keyup', '.contact-form', function() {
	var that = this;
	if ($(this).val() !== '') {
		$(this).removeClass('message-error');
	} else {
		$(that).addClass('message-error');
	}
});

$(document).on("submit", "#contact-form", function(e) {
	e.preventDefault();
	$('#contact-form .message-error').removeClass('message-error');

	$.ajax({
		url: 'contact-send.php',
		type: 'POST',
		dataType: 'json',
		data: $('#contact-form').serialize(),

	}).done(function(responseData) {
		if(responseData.status === 'success') {
			$("#contact-form .message-success").removeClass('hidden').velocity({ opacity : 1 });
			$("#contact-form .button-submit .button-send").addClass('button-transparent');
			$('#contact-form input, #contact-form textarea').val('');
			setTimeout(function() {
				$("#contact-form .message-success").velocity({ opacity : 0 }, function() {
					$(this).addClass('hidden');
				});
				$("#contact-form .button-submit .button-send").removeClass('button-transparent');
			}, 3000);
		} else {
			$.each(responseData.errors, function(i, field) {
				$('#contact-'+field).addClass('message-error');
			});
		}
	}).fail(function() {
		
	});
});

$('body').on('added_to_cart', function(e) {
	
	$('.add-to-cart-button').each(function(){
		var that = $(this);
		var text = that.text();
		var addedText = that.data('added');
		if(that.hasClass('added')) {
			that.text(addedText);
			setTimeout(function() {
				that.removeClass('added');
				that.text(text);
			}, 3000);
		}
	});

	$('.shipping-cart-count').addClass('bounce-light animated');
	if(mobile || ipad || $(window).width() < 991) {
		$('#mobile-added-to-cart').show(0).velocity({opacity: 1}).delay(2000).velocity({opacity:0});
	}
})
$('.shipping_calculator').on('click','.shipping-calculator-button', function(){
	if($('.shipping-calculator-form').css("display") == 'none') {
		$that = $(this);
		$that.parent('h5').addClass('open-calculator');
	} else {
		$that.parent('h5').removeClass('open-calculator');
	}
	// if($('.shipping-calculator-form'))
});

$(document).on("submit", "#date-reservation-form", function(e) {
	e.preventDefault();
	$('#date-reservation-form .message-error').removeClass('message-error');

	$.ajax({
		url: 'reservation-send.php',
		type: 'POST',
		dataType: 'json',
		data: $('#date-reservation-form').serialize(),
	}).done(function(responseData) {
		if(responseData.status === 'success') {
			$("#date-reservation-form .message-success").removeClass('hidden').velocity({ opacity : 1 });
			$("#date-reservation-form .button-submit .button-send").addClass('button-transparent');
			$('#date-reservation-form input, #date-reservation-form textarea').val('');

			setTimeout(function() {
				$("#date-reservation-form .message-success").velocity({ opacity : 0 }, function() {
					$(this).addClass('hidden');
				});
				$("#date-reservation-form .button-submit .button-send").removeClass('button-transparent');
			}, 3000);
		} else {
			$.each(responseData.errors, function(i, field) {
				$('#reservation-'+field).addClass('message-error');
			});
		}
	}).fail(function() {
	});
});

$(document).on('click', '.refresh-captcha', function(e) {
	e.preventDefault();
	$('#captcha').attr('src', 'inc/securimage/securimage_show.php?' + Math.random());
});

var sticked = [];
var stickyHandler = function(){
	$.each(sticked, function(index, stickedHeader) {
		
			var pos = $(window).scrollTop();
			var element = stickedHeader.element;
			var child = stickedHeader.child;

			if($(element).offset().top <= pos + 80) {
				child.addClass('is_stuck');
				if($('.woo-fixed-wrapper').length == 0) {
			
					child.before('<div class="woo-fixed-wrapper" style="height: '+child.height()+'px"></div>');
				}
			} else {
				child.removeClass('is_stuck');
				$('.woo-fixed-wrapper').remove();
			}

	});
};

var stickyHandlerAlt = function(){
	$.each(sticked, function(index, stickedHeader) {
		
			var pos = $(window).scrollTop();
			var element = stickedHeader.element;
			var child = stickedHeader.child;
			var fixed = stickedHeader.fixed;



			if($(element).offset().top <= pos) {
				$(fixed).addClass('show-fixed').removeClass('hide-fixed');
			} else {
				$(fixed).addClass('hide-fixed').removeClass('show-fixed');
			}

	});
};

var stickyHeaders = {
	sticky: false,

	bind: function() {
		if(stickyHeaders === false || mobile)
			return;	
		if(this.sticky === false) {

			if($('.nav-alt').length == 0) {
				this.sticky = true;
				$('.woo-fixed.filter-sticky, #menu.list-category-sticky .list-category-wrapper, #second-menu.list-category-sticky .list-category-wrapper, #third-menu.list-category-sticky .list-category-wrapper, #menu-list-new.list-category-sticky .list-category-wrapper').each(function(i, el){
						var header = {};
						header.element = el;
						header.child = $(el).find('.list-category');
						sticked.push(header);

						if(sticked[i-1]) {
							sticked[i-1].sibling = el;
						}

					})

				window.requestAnimationFrame(stickyHandler);
				$(window).on('scroll.sticky', function() {
					window.requestAnimationFrame(stickyHandler);
				});		
			} else {


			$('.woo-fixed.filter-sticky, #menu.list-category-sticky .list-category-wrapper, #second-menu.list-category-sticky .list-category-wrapper, #third-menu.list-category-sticky .list-category-wrapper, #menu-list-new.list-category-sticky .list-category-wrapper').each(function(i, el){
						var fixed = $(el).clone().css('clear', 'both').appendTo($('.nav-fixed-bar')); 
						var header = {};
						header.element = el;
						header.child = $(el).find('.list-category');
						header.fixed = fixed;
						sticked.push(header);


						if(sticked[i-1]) {
							sticked[i-1].sibling = el;
						}
					})				
				window.requestAnimationFrame(stickyHandlerAlt);
				$(window).on('scroll.sticky', function() {
					window.requestAnimationFrame(stickyHandlerAlt);
				});		

			}
		
		}
	},

	unbind: function() {
		if(stickyHeaders === false || mobile)
			return;
		if(this.sticky === true) {
			this.sticky = false;
			$(window).off('scroll.sticky');
			$('.is_stuck').removeClass('is_stuck').attr('style', '');
		}
	}

};

function shareThis(url) {
	
	var w = 460;
	var h = 500;
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	window.open(url, "shareWindow", "status = 1, height =" + h + ", width = " + w + ", left =" + left + ", top =" + top + ", resizable = 0");
}

function imgLoaded($img) {
	$img.parents('.unveil').addClass('loaded');
}


enquire.register("screen and (min-width: 1px)", {
	match : function() {

	},
	unmatch : function() {

	},
	setup : function() {

	},
	deferSetup : true,
	shouldDegrade: true,
	destroy : function() {}
}, true);

enquire.register("screen and (max-width: 767px)", {
	match : function() {
		if($('.mobile-basic-info').height() < $(window).height()) {
			$('.mobile-basic-info').height($(window).height());
		}
		verticalSlider.destroy();
	},
	unmatch : function() {

	},
	setup : function() {
		
	},
	deferSetup : true,
	shouldDegrade: true,
	destroy : function() {}
}, true);

enquire.register("screen and (max-width: 991px)", {
	match : function() {
		if($('#scene').length > 0) {
			var $scene = $('#scene').parallax();
			$scene.parallax('disable');
		}
		unbindResizeIntro();
	},
	unmatch : function() {
		if($('#scene').length > 0) {
			var $scene = $('#scene').parallax();
			$scene.parallax('enable');
		}
	},
	setup : function() {

	},
	deferSetup : true,
	shouldDegrade: true,
	destroy : function() {}
}, true);

enquire.register("screen and (min-width: 768px)", {
	match : function() {
		verticalSlider.init();
		
	},
	unmatch : function() {

	},
	setup : function() {

	},
	deferSetup : true,
	shouldDegrade: true,

	destroy : function() {}
}, true);

enquire.register("screen and (min-width: 992px)", {
	match : function() {
		bindResizeIntro();

		if(!$('body').hasClass('no-smooth-scroll')) {
			$('body').addClass('scrollable');
		} else {
			$('body').removeClass('scrollable');
		}
		footer.init();
		backgroundParallax.init();

	},
	unmatch : function() {

	},
	setup : function() {

	},
	deferSetup : true,
	shouldDegrade: true,
	destroy : function() {}
}, true);



$('.rtb-booking-form').find("input, textarea").each(function(i, el){
	var elId = $(el).attr("id");
	var label = null;
	if (elId && (label = $(el).parents("form").find("label[for="+elId+"]")).length == 1) {
		$(el).attr("placeholder", label.html().trim());
	}
});

$('.rtb-booking-form fieldset.contact').after($('.rtb-booking-form .message'));
$('.rtb-error').siblings('input').addClass('message-error');

jQuery('document').ready(function($) {
	'use strict';
	if($('.nav-alt').length > 0) {
		$('.list-category').addClass('second-hover');
	}


	$('.social-share a').click(function(e){
		e.preventDefault();
		shareThis($(this).attr('href'));
	})
	$(".menu-item a[rel^='prettyPhoto']").prettyPhoto({
		// hook: 'data-rel',
		social_tools: false,
		// theme: 'pp_woocommerce',
		horizontal_padding: 20,
		opacity: 0.8,
		show_title: false,
		deeplinking: false
	});

	$(document).on("submit", "#commentform", function(e) {
		var commentform = $(this);
		if($('#comment-status').length === 0) {
			$('#respond').prepend('<div id="comment-status"></div>');
		}
		var statusdiv = $('#comment-status');
		var formdata = commentform.serialize();
		var formurl = commentform.attr('action');

		$.ajax({
			dataType: 'json',
			type: 'post',
			url: formurl,
			data: formdata,
			statusCode: {
				500: function(data) {
					var response = data.responseText;
					// var expression = /<p>[\s\S]+\p>/g;
					var expression = '<p>[\\s\\S]+p>'
					var regex = new RegExp(expression, 'g');
					response = response.match(regex);
					response = response[0].replace(/<strong>[a-zA-Z ]+<\/strong>: /g, '');
					statusdiv.html('<div class="alert alert-danger">'+response+'</div>');
				},
				403: function(data) {
					var response = data.responseText;
					// var expression = /<p>[\s\S]+\p>/g;
					var expression = '<p>[\\s\\S]+p>'
					var regex = new RegExp(expression, 'g');
					response = response.match(regex);
					response = response[0].replace(/<strong>[a-zA-Z ]+<\/strong>: /g, '');
					statusdiv.html('<div class="alert alert-danger">'+response+'</div>');
				}

			},

			success: function(data, textStatus) {
				if(data.status=="success") {
					if ($('.no-comments-so-far').length) {
						$('.no-comments-so-far').before('<section id="comments"><ul class="comments animate_element animate_content">'+data.contents+'</ul></section>');
					} else {
						location.reload();

					}
				} else {
					var response = data.responseText;
					// var expression = /<p>[\s\S]+\p>/g;
					var expression = '<p>[\\s\\S]+p>'
					var regex = new RegExp(expression, 'g');
					response = response.match(regex);
					response = response[0].replace(/<strong>[a-zA-Z ]+<\/strong>: /g, '');
					statusdiv.html('<div class="alert alert-danger">'+response+'</div>');
				}
				
				commentform.find('textarea[name=comment]').val('');
				setTimeout(function () {
					statusdiv.html('');
				}, 2000);
			}
		});
		return false;
	});
});





var navbar_alt = {
	wrapper: jQuery('body'),
	transparent : true,
	schemeStart : '',
	schemeEnd : '',
	backgroundStart : '',
	backgroundEnd : '',
	secondState : '',
	firstLogoClass : '.logo-start',
	secondLogoClass : '.logo-after',

	additionalSchemeStart : '',
	additionalSchemeEnd : '',
	additionalBackgroundStart : '',
	additionalBackgroundEnd : '',
	additionalSecondState : '',

	largeBackgroundStart : '',
	largeBackgroundEnd : '',
	largeSecondState : '',

	$navAdditional : '',
	$mainNavbarWrapper : '',
	$navbarLink : '',

	init: function() {
		var that = this;
		var time = 300,
			timer;

		var innerTime = 500;
		var current = '';


	},


};

var post_top_image = {
	init: function() {
		var img = $('#post2 .post-top-img');
		var that = this;
		that.resize(img);
		$(window).on('resize', $.debounce( 250, function() {
			that.resize(img);
		}));
	},
	resize: function(img) {
		var heightHeader = $('#post2 .post-header').outerHeight();
		var maxHeight = $window.height();
		if(window.outerWidth > 991) {
			img.css('height', maxHeight - heightHeader);
		}
	}
};


var isDraggable = '';
if(($(window).outerWidth() <= 768  || mobile) && $('.shop-map').hasClass('non-active-map')) {
	isDraggable = false;
} else {
	isDraggable = true;
}

var contact_map_section = {
	init: function() {
		var map = jQuery('#map.contact-intro-map');
		var that = this;
		if($(window).outerWidth() <= 768  || mobile) {
			if($('#map').data('fullHeight') > '400px') {
				$('#map').height('400px');
			}
		}
		$(window).on('resize', $.debounce( 250, function() {
			if($(window).outerWidth() <= 768  || mobile) {
				if($('#map').data('fullHeight') > '400px') {
					$('#map').height('400px');
				}
			} else {
				$('#map').height($('#map').data('fullHeight'));
			}
		}));
		$('.show-map-btn').on('click', function(e){
			e.preventDefault();
			$that = $(this);
			showText = $('.show-map-btn').data('shownText');
			hiddenText = $('.show-map-btn').data('hiddenText');
			dataOpacity = $that.parents('.section-intro').data('opacityStart') /100;

			if($('.show-map-btn').hasClass('non-active-map')) {
				$that.parents('.section-intro').find('.bg-section').velocity({opacity: 1}, { complete: function(){
					$(window).trigger('unbindParallaxIntro');
					$('.show-map-btn a').text(hiddenText);
					$that.removeClass('non-active-map');
				}});
				$that.parents('.section-intro').find('.pre-content').velocity({opacity: 0}, {display: 'table-cell', visibility: 'hidden'});
			} else {
				$that.parents('.section-intro').find('.bg-section').velocity({opacity: dataOpacity}, { complete: function(){
					$('.show-map-btn a').text(showText);
					$(window).on('resize', $.debounce( 250, function() {
						that.resize();
					}));
					that.resize();
					$that.addClass('non-active-map');
				}});
				$that.parents('.section-intro').find('.pre-content').velocity({opacity: 1}, {display: 'table-cell', visibility: 'visible'});
			}
		});
	},
	resize: function() {
		if($(window).outerWidth() <= 768  || mobile) {
			$(window).trigger('unbindParallaxIntro');
		} else {
			$(window).trigger('bindParallaxIntro');
		}
	}
};
function runParallax($el) {
	$el.parallax({});
}


var $transform = prefix['js']+'Transform';
var parallaxElement = $('.parallax')[0];

var speedFactor = -0.6;

var parallaxImages = [];
var parallaxElements = [];



function prepareImages() {
	resetParallax();
	parallaxImages = [];

	$('.team-bg-image, .contact-bg-image, .menu-category').each(function(index, el) {
	
	var $el = $(el);
	var additional = $el.data('parallax-additional');
	var parallaxOffset = 0;
	var parallaxImage = {};

		if($el.data('background')){
			if($el.data('parallax-type') == 'parallax_mouse' && jQuery.browser.mobile === false) {
				$el.backstretch($el.data('background'), {
					centeredY: true,
					fade: 500
				}).find('.backstretch').wrapAll('<ul class="parallax-scene"><li class="layer" data-depth="0.40"></li></ul>');
				runParallax($el);
			} else {

				if($el.hasClass('menu-category')) {
					$el.backstretch($el.data('background'), {
						centeredY: true,
						fade: 500
					}).find('.backstretch');
				} else {
					$el.backstretch($el.data('background'), {
						centeredY: false,
						fade: 500
					}).find('.backstretch');
				}
			}
		}
	
		if($el.hasClass('menu-category')) {
			parallaxImage.speedFactor = -0.3;
		} else {
			parallaxImage.speedFactor = -0.5;
		}

		parallaxImage.element = $el;

			parallaxImage.img = $el.find('.backstretch img');
		
			parallaxImage.offset = 0;
			if(parallaxImage.img.length > 0)
				parallaxImages.push(parallaxImage);
	});

}

function resetParallax() {
	$.each(parallaxImages, function(index, parallaxImage) {
		parallaxImage.img[0].style[$transform] = "translateY(0px) translateZ(0)";
	});
}

var parallaxHandler = function(){
	$.each(parallaxImages, function(index, parallaxImage) {
		var pos = scrollTop();
		var firstTop = parallaxImage.element.offset().top;
		// var offset = Math.round((firstTop) * parallaxImage.speedFactor);
		var transformation = Math.round((firstTop - pos) * parallaxImage.speedFactor+parallaxImage.offset);
		parallaxImage.img[0].style[$transform] = "translateY("+ transformation + "px) translateZ("+ transformation + "px) ";

	});
};

var parallax = false;

function bindParallax() {
	if(parallax === false) {
		if(jQuery.browser.mobile === false && $(window).width() > 991 ) {
			parallax = true;
			parallaxHandler();
			window.requestAnimationFrame(parallaxHandler);
			$window.on('scroll.parallax', function() {
				window.requestAnimationFrame(parallaxHandler);
			});
		}
	}
}

function unbindParallax() {
	if(parallax === true) {
		parallax = false;
		$window.off('scroll.parallax');
		$('.backstretch img').each(function(i, el){
			el.style[$transform] = 'none';
		});
		if(parallaxElement !== undefined) {
			parallaxElement.style[$transform] = 'none';
		}
	}
}
$(window).on('load', function(){
	if($('.team-bg-image').length > 0 || $('.contact-bg-image').length > 0 || $('#menu-list-new').length > 0) {
		prepareImages();
	}
});

$(window).on('resize.parallax', $.debounce( 400, function(){
	if($(window).width() > 991) {
		bindParallax();
	} else {
		unbindParallax();
	}
}));



$('.team-members-table').height($('.team-members').height()-180);
$(window).resize(function(){
   $('.team-members-table').height($('.team-members').height()-180);
});

$('.contact-info-table').height($('.contact-info').height()-180);
$(window).resize(function(){
   $('.contact-info-table').height($('.contact-info').height()-180);
});
