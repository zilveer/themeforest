/*-----------------------------------------------------------------------------------
/*
/* Custom JS
/*
-----------------------------------------------------------------------------------*/

/* Start Document */

(function($){
	$(document).ready(function(){

        $('body').removeClass('no-js').addClass('js');

        $("#navigation li").hover(
         function () {
            $(this).has('ul').addClass("hover");
            $(this).find('ul:first').css({
               visibility: "visible",
               display: "none"
           }).stop(true, true).slideDown("fast");
        },
        function () {
            $(this).removeClass("hover");
            $(this).find('ul:first').css({
               visibility: "visible",
               display: "block"
           }).stop(true, true).slideUp("fast");
        }
        );


        $("select.selectnav").change(function() {
         window.location = $(this).find("option:selected").val();
     });

        /*----------------------------------------------------*/
/*	Image Overlay
/*----------------------------------------------------*/

$('.picture a').hover(function () {
	$(this).find('.image-overlay-zoom, .image-overlay-link').stop().fadeTo('fast', 1);
},function () {
	$(this).find('.image-overlay-zoom, .image-overlay-link').stop().fadeTo('fast', 0);
});

/*----------------------------------------------------*/
/*	Back To Top Button
/*----------------------------------------------------*/

$('#scroll-top-top a').click(function(){
	$('html, body').animate({scrollTop:0}, 300);
	return false;
});

$('#search-in-menu .fa').click(function(){
				 $('li#search-in-menu input[type="text"]').focus();
			})


/*----------------------------------------------------*/
/*	Accordion
/*----------------------------------------------------*/

var $container = $('.acc-container'),
$trigger   = $('.acc-trigger');

$container.hide();
$trigger.first().addClass('active').next().show();

/*var fullWidth = $container.outerWidth(true);
$trigger.css('width', fullWidth);
$container.css('width', fullWidth);
*/
$trigger.on('click', function(e) {
	if( $(this).next().is(':hidden') ) {
		$trigger.removeClass('active').next().slideUp(300);
		$(this).toggleClass('active').next().slideDown(300);
	}
	e.preventDefault();
});

		// Resize
		$(window).on('resize', function() {
			fullWidth = $container.outerWidth(true)
			$trigger.css('width', $trigger.parent().width() );
			$container.css('width', $container.parent().width() );
		});


        /*----------------------------------------------------*/
/*  Accordion
/*----------------------------------------------------*/

$(".toggle-container").hide();
$(".toggle-trigger").click(function(){
    $(this).toggleClass("active").next().slideToggle("normal");
        return false; //Prevent the browser jump to the link anchor
    });


/*----------------------------------------------------*/
/*	Tabs
/*----------------------------------------------------*/



var $tabsNav    = $('.tabs-nav'),
$tabsNavLis = $tabsNav.children('li'),
$tabContent = $('.tab-content');

$tabsNav.each(function() {
	var $this = $(this);

	$this.next().children('.tab-content').stop(true,true).hide()
	.first().show();

	$this.children('li').first().addClass('active').stop(true,true).show();
});

$tabsNavLis.on('click', function(e) {
	var $this = $(this);

	$this.siblings().removeClass('active').end()
	.addClass('active');

	$this.parent().next().children('.tab-content').stop(true,true).hide()
	.siblings( $this.find('a').attr('href') ).fadeIn();

	e.preventDefault();
});



$('.testimonials-carousel').carousel({
    namespace: "mr-rotato",
    slider : '.carousel',
    slide : '.testimonial'
})



    $('.testimonials-slider').flexslider({
        animation: "fade",
        controlsContainer: $(".custom-controls-container"),
        customDirectionNav: $(".custom-navigation a"),
	    controlNav: true,
	    directionNav: false,
	    prevText: "",
	    nextText: ""
    });


/*----------------------------------------------------*/
/*	Isotope Portfolio Filter
/*----------------------------------------------------*/
$(window).load(function(){
	$('#portfolio-wrapper').isotope({
      itemSelector : '.portfolio-item',
      layoutMode : 'fitRows'
  });

	var $container = $('.full-width-class .products, .twelve.columns .products, .woocommerce.columns-2 .products,.woocommerce.columns-4 .products');
	$container.isotope({ itemSelector: 'div.product', layoutMode: 'fitRows' });
	

});
$('#filters a').click(function(e){
  e.preventDefault();

  var selector = $(this).attr('data-option-value');
  $('#portfolio-wrapper').isotope({ filter: selector });

  $(this).parents('ul').find('a').removeClass('selected');
  $(this).addClass('selected');
});



$('a.close').click(function(e){
	e.preventDefault();
	$(this).parent().fadeOut();

});

$('.tooltips').tooltip({
  selector: "a[rel=tooltip]"
})



$(".video-cont").fitVids();

$('.royalSlider').css('display', 'block');

$('#home-slider').royalSlider({
	autoScaleSlider: true,
	autoScaleSliderWidth: 1180,
	autoHeight: false,
	loop: centum.home_slider_loop,
	slidesSpacing: 0,
	imageScaleMode: centum.home_slider_scale_mode,
	imageAlignCenter:false,
	navigateByClick: false,
	numImagesToPreload : 10,
	autoPlay: {
		// autoplay options go gere
		enabled: centum.home_slider_autoplay,
		pauseOnHover: true,
		delay: centum.home_royal_delay
	},
	/* Arrow Navigation */
	arrowsNav:true,
	arrowsNavAutoHide: centum.home_slider_arrows_hide,
	arrowsNavHideOnTouch: true,
	keyboardNavEnabled: true,
	fadeinLoadedSlide: true,
});

$('#portfolio-slider').royalSlider({
	autoScaleSlider: true,
	autoScaleSliderWidth: 1180,
	autoHeight: true,
	loop: true,
	slidesSpacing: 0,
	imageScaleMode: 'fill',
	imageAlignCenter:true,
	navigateByClick: false,
	numImagesToPreload : 10,
	
	arrowsNav:true,
	arrowsNavAutoHide: false,
	arrowsNavHideOnTouch: true,
	keyboardNavEnabled: true,
	fadeinLoadedSlide: true,
});



 $("#product-slider").royalSlider({

        autoScaleSlider: true,
      autoScaleSliderWidth: 580,
      autoHeight: true,
      //autoScaleSliderHeight: 500,
      arrowsNavAutoHide: false,
      loop: false,
      slidesSpacing: 0,

      imageScaleMode: 'fill',
      imageAlignCenter:false,

      navigateByClick: false,
      numImagesToPreload:10,

      /* Thumbnail Navigation */
		controlNavigation: 'thumbnails',
		thumbs: {
			orientation: 'horizontal',
			firstMargin: false,
			appendSpan: true,
			autoCenter: false,
			spacing: 10,
			paddingTop: 10,
		}

    });


$('.basic-slider').royalSlider({

	autoScaleSlider: true,
	autoScaleSliderHeight: "auto",
	autoHeight: true,

	loop: false,
	slidesSpacing: 0,

	imageScaleMode: 'none',
	imageAlignCenter:false,

	navigateByClick: false,
	numImagesToPreload:10,

	/* Arrow Navigation */
	arrowsNav:true,
	arrowsNavAutoHide: false,
	arrowsNavHideOnTouch: true,
	keyboardNavEnabled: true,
	fadeinLoadedSlide: true,

});


$('[rel=image]').magnificPopup({ 
  	type: 'image',
	closeOnContentClick: true,
	mainClass: 'my-mfp-zoom-in',
	image: {
		 markup: '<div class="mfp-figure">'+
	        '<div class="mfp-close"></div>'+
	        '<div class="mfp-img"></div>'+
	        '<div class="mfp-bottom-bar">'+
	          '<div class="mfp-title"></div>'+
	          '<div class="mfp-counter"></div>'+
	        '</div>'+
	      '</div>',
		verticalFit: true,
		titleSrc: function(item) {
     		return item.el.attr('title');
  		}
	},
	// other options
});

$('[rel=image-gallery]').magnificPopup({
  type: 'image',
  mainClass: 'my-mfp-zoom-in',
  gallery:{
    enabled:true
  },

});

$('.wp-caption a').magnificPopup({
  type: 'image',
  mainClass: 'mfp-fade',
  closeOnContentClick: true,
  image: {
    verticalFit: true
  }
}); 

$('.page a.button.lightbox').magnificPopup({
  type: 'image',
  mainClass: 'mfp-fade',
  closeOnContentClick: true,
  image: {
    verticalFit: true
  }
});     

$('#product-slider-no-thumbs .rsSlide, #product-slider .rsSlide, .basic-slider .rsSlide, #portfolio-slider .rsSlide').magnificPopup({
  delegate: 'a',
  mainClass: 'my-mfp-zoom-in',
  type: 'image',
  closeOnContentClick: true,
  image: {
    verticalFit: true
  },
  	gallery: {
	  enabled: true
	},
});


$(window).load(function() {
    $('.flexslider').flexslider({ animation: "slide" , controlNav: false,smoothHeight: true, slideshowSpeed: 7000, animationSpeed: 600,start: function(slider) {
    	$('.flexslider').removeClass('loadingflex');
	}
	});
});

// Responsive Tables
//----------------------------------------//
$('.responsive-table').stacktable();


$('.stars a').on( "click", function() {
	$('.stars a').removeClass('prevactive');
 	$(this).prevAll().addClass('prevactive');
}).hover(
  function() {
  	$('.stars a').removeClass('prevactive');
	$(this).addClass('prevactive').prevAll().addClass('prevactive');
  }, function() {
  	$('.stars a').removeClass('prevactive');
  	$('.stars a.active').prevAll().addClass('prevactive');
  }
);


$(".small-only input.input-text.qty.text").on( "change", function() {
	var value = $(this).val();
	var name = $(this).attr('name');
	$(".large-only").find(".quantity.buttons_added .qty[name*='"+name+"']").val(value);
});




/*----------------------------------------------------*/
/*  Counters
/*----------------------------------------------------*/

    $('.counter').counterUp({
        delay: 10,
        time: 900
    });


// Retina Images
//----------------------------------------//

var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;

$(window).on("load", function() {
	if (pixelRatio > 1) {
		if(centum.retinalogo) {
			$('#logo img').attr('src',centum.retinalogo);
		}
	}
});

/* End Document */

});

})(this.jQuery);



/*global jQuery */
/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/


(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    if(!document.getElementById('fit-vids-style')) {

      var div = document.createElement('div'),
          ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0],
          cssStyles = '&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';

      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = cssStyles;

      ref.parentNode.insertBefore(div,ref);

    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );



jQuery( function( $ ) {

	// Quantity buttons

	$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
		$('.plus').val('\uf067');
		$('.minus').val('\uf068');
	$( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event
		$qty.trigger( 'change' );

	});

});

// Generated by CoffeeScript 1.6.2
/*
jQuery Waypoints - v2.0.3
Copyright (c) 2011-2013 Caleb Troughton
Dual licensed under the MIT license and GPL license.
https://github.com/imakewebthings/jquery-waypoints/blob/master/licenses.txt
*/
(function(){var t=[].indexOf||function(t){for(var e=0,n=this.length;e<n;e++){if(e in this&&this[e]===t)return e}return-1},e=[].slice;(function(t,e){if(typeof define==="function"&&define.amd){return define("waypoints",["jquery"],function(n){return e(n,t)})}else{return e(t.jQuery,t)}})(this,function(n,r){var i,o,l,s,f,u,a,c,h,d,p,y,v,w,g,m;i=n(r);c=t.call(r,"ontouchstart")>=0;s={horizontal:{},vertical:{}};f=1;a={};u="waypoints-context-id";p="resize.waypoints";y="scroll.waypoints";v=1;w="waypoints-waypoint-ids";g="waypoint";m="waypoints";o=function(){function t(t){var e=this;this.$element=t;this.element=t[0];this.didResize=false;this.didScroll=false;this.id="context"+f++;this.oldScroll={x:t.scrollLeft(),y:t.scrollTop()};this.waypoints={horizontal:{},vertical:{}};t.data(u,this.id);a[this.id]=this;t.bind(y,function(){var t;if(!(e.didScroll||c)){e.didScroll=true;t=function(){e.doScroll();return e.didScroll=false};return r.setTimeout(t,n[m].settings.scrollThrottle)}});t.bind(p,function(){var t;if(!e.didResize){e.didResize=true;t=function(){n[m]("refresh");return e.didResize=false};return r.setTimeout(t,n[m].settings.resizeThrottle)}})}t.prototype.doScroll=function(){var t,e=this;t={horizontal:{newScroll:this.$element.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.$element.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};if(c&&(!t.vertical.oldScroll||!t.vertical.newScroll)){n[m]("refresh")}n.each(t,function(t,r){var i,o,l;l=[];o=r.newScroll>r.oldScroll;i=o?r.forward:r.backward;n.each(e.waypoints[t],function(t,e){var n,i;if(r.oldScroll<(n=e.offset)&&n<=r.newScroll){return l.push(e)}else if(r.newScroll<(i=e.offset)&&i<=r.oldScroll){return l.push(e)}});l.sort(function(t,e){return t.offset-e.offset});if(!o){l.reverse()}return n.each(l,function(t,e){if(e.options.continuous||t===l.length-1){return e.trigger([i])}})});return this.oldScroll={x:t.horizontal.newScroll,y:t.vertical.newScroll}};t.prototype.refresh=function(){var t,e,r,i=this;r=n.isWindow(this.element);e=this.$element.offset();this.doScroll();t={horizontal:{contextOffset:r?0:e.left,contextScroll:r?0:this.oldScroll.x,contextDimension:this.$element.width(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:r?0:e.top,contextScroll:r?0:this.oldScroll.y,contextDimension:r?n[m]("viewportHeight"):this.$element.height(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};return n.each(t,function(t,e){return n.each(i.waypoints[t],function(t,r){var i,o,l,s,f;i=r.options.offset;l=r.offset;o=n.isWindow(r.element)?0:r.$element.offset()[e.offsetProp];if(n.isFunction(i)){i=i.apply(r.element)}else if(typeof i==="string"){i=parseFloat(i);if(r.options.offset.indexOf("%")>-1){i=Math.ceil(e.contextDimension*i/100)}}r.offset=o-e.contextOffset+e.contextScroll-i;if(r.options.onlyOnScroll&&l!=null||!r.enabled){return}if(l!==null&&l<(s=e.oldScroll)&&s<=r.offset){return r.trigger([e.backward])}else if(l!==null&&l>(f=e.oldScroll)&&f>=r.offset){return r.trigger([e.forward])}else if(l===null&&e.oldScroll>=r.offset){return r.trigger([e.forward])}})})};t.prototype.checkEmpty=function(){if(n.isEmptyObject(this.waypoints.horizontal)&&n.isEmptyObject(this.waypoints.vertical)){this.$element.unbind([p,y].join(" "));return delete a[this.id]}};return t}();l=function(){function t(t,e,r){var i,o;r=n.extend({},n.fn[g].defaults,r);if(r.offset==="bottom-in-view"){r.offset=function(){var t;t=n[m]("viewportHeight");if(!n.isWindow(e.element)){t=e.$element.height()}return t-n(this).outerHeight()}}this.$element=t;this.element=t[0];this.axis=r.horizontal?"horizontal":"vertical";this.callback=r.handler;this.context=e;this.enabled=r.enabled;this.id="waypoints"+v++;this.offset=null;this.options=r;e.waypoints[this.axis][this.id]=this;s[this.axis][this.id]=this;i=(o=t.data(w))!=null?o:[];i.push(this.id);t.data(w,i)}t.prototype.trigger=function(t){if(!this.enabled){return}if(this.callback!=null){this.callback.apply(this.element,t)}if(this.options.triggerOnce){return this.destroy()}};t.prototype.disable=function(){return this.enabled=false};t.prototype.enable=function(){this.context.refresh();return this.enabled=true};t.prototype.destroy=function(){delete s[this.axis][this.id];delete this.context.waypoints[this.axis][this.id];return this.context.checkEmpty()};t.getWaypointsByElement=function(t){var e,r;r=n(t).data(w);if(!r){return[]}e=n.extend({},s.horizontal,s.vertical);return n.map(r,function(t){return e[t]})};return t}();d={init:function(t,e){var r;if(e==null){e={}}if((r=e.handler)==null){e.handler=t}this.each(function(){var t,r,i,s;t=n(this);i=(s=e.context)!=null?s:n.fn[g].defaults.context;if(!n.isWindow(i)){i=t.closest(i)}i=n(i);r=a[i.data(u)];if(!r){r=new o(i)}return new l(t,r,e)});n[m]("refresh");return this},disable:function(){return d._invoke(this,"disable")},enable:function(){return d._invoke(this,"enable")},destroy:function(){return d._invoke(this,"destroy")},prev:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e>0){return t.push(n[e-1])}})},next:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e<n.length-1){return t.push(n[e+1])}})},_traverse:function(t,e,i){var o,l;if(t==null){t="vertical"}if(e==null){e=r}l=h.aggregate(e);o=[];this.each(function(){var e;e=n.inArray(this,l[t]);return i(o,e,l[t])});return this.pushStack(o)},_invoke:function(t,e){t.each(function(){var t;t=l.getWaypointsByElement(this);return n.each(t,function(t,n){n[e]();return true})});return this}};n.fn[g]=function(){var t,r;r=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(d[r]){return d[r].apply(this,t)}else if(n.isFunction(r)){return d.init.apply(this,arguments)}else if(n.isPlainObject(r)){return d.init.apply(this,[null,r])}else if(!r){return n.error("jQuery Waypoints needs a callback function or handler option.")}else{return n.error("The "+r+" method does not exist in jQuery Waypoints.")}};n.fn[g].defaults={context:r,continuous:true,enabled:true,horizontal:false,offset:0,triggerOnce:false};h={refresh:function(){return n.each(a,function(t,e){return e.refresh()})},viewportHeight:function(){var t;return(t=r.innerHeight)!=null?t:i.height()},aggregate:function(t){var e,r,i;e=s;if(t){e=(i=a[n(t).data(u)])!=null?i.waypoints:void 0}if(!e){return[]}r={horizontal:[],vertical:[]};n.each(r,function(t,i){n.each(e[t],function(t,e){return i.push(e)});i.sort(function(t,e){return t.offset-e.offset});r[t]=n.map(i,function(t){return t.element});return r[t]=n.unique(r[t])});return r},above:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset<=t.oldScroll.y})},below:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset>t.oldScroll.y})},left:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset<=t.oldScroll.x})},right:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset>t.oldScroll.x})},enable:function(){return h._invoke("enable")},disable:function(){return h._invoke("disable")},destroy:function(){return h._invoke("destroy")},extendFn:function(t,e){return d[t]=e},_invoke:function(t){var e;e=n.extend({},s.vertical,s.horizontal);return n.each(e,function(e,n){n[t]();return true})},_filter:function(t,e,r){var i,o;i=a[n(t).data(u)];if(!i){return[]}o=[];n.each(i.waypoints[e],function(t,e){if(r(i,e)){return o.push(e)}});o.sort(function(t,e){return t.offset-e.offset});return n.map(o,function(t){return t.element})}};n[m]=function(){var t,n;n=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(h[n]){return h[n].apply(null,t)}else{return h.aggregate.call(null,n)}};n[m].settings={resizeThrottle:100,scrollThrottle:30};return i.load(function(){return n[m]("refresh")})})}).call(this);

/*!
* jquery.counterup.js 1.0
*
* Copyright 2013, Benjamin Intal http://gambit.ph @bfintal
* Released under the GPL v2 License
*
* Date: Nov 26, 2013
*/(function(e){"use strict";e.fn.counterUp=function(t){var n=e.extend({time:400,delay:10},t);return this.each(function(){var t=e(this),r=n,i=function(){var e=[],n=r.time/r.delay,i=t.text(),s=/[0-9]+,[0-9]+/.test(i);i=i.replace(/,/g,"");var o=/^[0-9]+$/.test(i),u=/^[0-9]+\.[0-9]+$/.test(i),a=u?(i.split(".")[1]||[]).length:0;for(var f=n;f>=1;f--){var l=parseInt(i/n*f);u&&(l=parseFloat(i/n*f).toFixed(a));if(s)while(/(\d+)(\d{3})/.test(l.toString()))l=l.toString().replace(/(\d+)(\d{3})/,"$1,$2");e.unshift(l)}t.data("counterup-nums",e);t.text("0");var c=function(){t.text(t.data("counterup-nums").shift());if(t.data("counterup-nums").length)setTimeout(t.data("counterup-func"),r.delay);else{delete t.data("counterup-nums");t.data("counterup-nums",null);t.data("counterup-func",null)}};t.data("counterup-func",c);setTimeout(t.data("counterup-func"),r.delay)};t.waypoint(i,{offset:"100%",triggerOnce:!0})})}})(jQuery);