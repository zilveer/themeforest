//jQuery.noConflict();	
	jQuery.fn.equalizeHeights = function() {
	  var maxHeight = this.map(function( i, e ) {
	    return jQuery( e ).height();
	  }).get();
	  
	  return this.height( Math.max.apply( this, maxHeight ));
	};
/* jQuery CounTo */
(function(a){a.fn.countTo=function(g){g=g||{};return a(this).each(function(){function e(a){a=b.formatter.call(h,a,b);f.html(a)}var b=a.extend({},a.fn.countTo.defaults,{from:a(this).data("from"),to:a(this).data("to"),speed:a(this).data("speed"),refreshInterval:a(this).data("refresh-interval"),decimals:a(this).data("decimals")},g),j=Math.ceil(b.speed/b.refreshInterval),l=(b.to-b.from)/j,h=this,f=a(this),k=0,c=b.from,d=f.data("countTo")||{};f.data("countTo",d);d.interval&&clearInterval(d.interval);d.interval=
setInterval(function(){c+=l;k++;e(c);"function"==typeof b.onUpdate&&b.onUpdate.call(h,c);k>=j&&(f.removeData("countTo"),clearInterval(d.interval),c=b.to,"function"==typeof b.onComplete&&b.onComplete.call(h,c))},b.refreshInterval);e(c)})};a.fn.countTo.defaults={from:0,to:0,speed:1E3,refreshInterval:100,decimals:0,formatter:function(a,e){return a.toFixed(e.decimals)},onUpdate:null,onComplete:null}})(jQuery); 

var min_w = 1500; // minimum video width allowed
var video_width_original = 1280;  // original video dimensions
var video_height_original = 720;
var vid_ratio = 1280/720;

jQuery(document).ready(function($){
	/* ------------------------------------------------------------------------ */
	/* Accordion */
	/* ------------------------------------------------------------------------ */
	
	$('.accordion').each(function(){
	    var acc = $(this).attr("rel");
	    $(this).find('.acc-group:nth-child(' + acc + ') .accordion-inner').show();
	     $(this).find('.acc-group:nth-child(' + acc + ') .accordion-inner').prev().addClass("active").find('.acc-icon i').addClass('fa-minus').removeClass('fa-plus');
	});
	
	$('.accordion .accordion-title').click(function() {
	    if($(this).next().is(':hidden')) {
	        $(this).parent().parent().find('.accordion-title').removeClass('active').find('.acc-icon i').removeClass('fa-minus').addClass('fa-plus').parent().parent().next().slideUp(200);
	        $(this).toggleClass('active').find('.acc-icon i').addClass('fa-minus').removeClass('fa-plus').parent().parent().next().slideDown(200);
	    }
	    return false;
	});

	/* ------------------------------------------------------------------------ */
	/* Iconbox */
	/* ------------------------------------------------------------------------ */

	  $( ".iconbox.framed_when_hover" ).equalizeHeights();
	  $( ".portfolio-with-excerpts .portfolio-content" ).equalizeHeights();

	  $(window).resize(function(){
	  	$( ".iconbox.framed_when_hover" ).css({'height':'auto'});
	  	$( ".portfolio-with-excerpts .portfolio-content" ).css({'height':'auto'});
	  	$( ".iconbox.framed_when_hover" ).equalizeHeights();
	  	$( ".portfolio-with-excerpts .portfolio-content" ).equalizeHeights();
	  });
	  //$( ".blog-item-excerpt" ).equalizeHeights();

	/* ------------------------------------------------------------------------ */
	/* Alert Messages */
	/* ------------------------------------------------------------------------ */
	
	$(".alert-message .close").click(function(){
		$(this).parent().animate({'opacity' : '0'}, 300).slideUp(300);
		return false;
	});
	
	/* ------------------------------------------------------------------------ */
	/* Progressbar */
	/* ------------------------------------------------------------------------ */
	
	
	if(jQuery().waypoint) {
		jQuery('.progressbar').waypoint(function() {
			$(this).find('.bar-percentage').css('width', '0%');
		    dataperc = $(this).attr('data-perc');
		    $(this).find('.bar-percentage').animate({ "width" : dataperc + "%"}, 900);
		}, {
			triggerOnce: true,
			offset: '100%'
		});
	} else {
		$('.progressbar').each(function(){
		$(this).find('.bar-percentage').css('width', '0%');
	    dataperc = $(this).attr('data-perc');
	    $(this).find('.bar-percentage').animate({ "width" : dataperc + "%"}, 900);
	});
	}
	/* ------------------------------------------------------------------------ */
	/* counter box */
	/* ------------------------------------------------------------------------ */
	jQuery('.counter-value .value').each(function() {
		var percentage = jQuery(this).data('value');
		jQuery(this).countTo({from: 0, to: percentage, speed: 900});
	});

	if(jQuery().waypoint) {
		jQuery('.counter-info').waypoint(function() {
			jQuery(this).find('.counter-value .value').each(function() {
			var percentage = jQuery(this).data('value');
			jQuery(this).countTo({from: 0, to: percentage, speed: 900});
		});
		}, {
			triggerOnce: true,
			offset: '100%'
		});
	}
	/* ------------------------------------------------------------------------ */
	/* counter box */
	/* ------------------------------------------------------------------------ */
	if(jQuery().waypoint) {
		jQuery('.iconlist').waypoint(function() {
			jQuery(this).addClass('animation');
		}, {
			triggerOnce: true,
			offset: '100%'
		});
	} else {
		jQuery('.iconlist').each(function() {
			jQuery(this).addClass('animation');
		});
	}
	/* ------------------------------------------------------------------------ */
	/* Tabs */
	/* ------------------------------------------------------------------------ */
	
	$('div.tabset').tabset();
	
	/* ------------------------------------------------------------------------ */
	/* Toggle */
	/* ------------------------------------------------------------------------ */
	
	if( $(".toggle .toggle-title").hasClass('active') ){
		$(".toggle .toggle-title.active").closest('.toggle').find('.toggle-inner').show();
		$('.toggle .toggle-title.active').find('.status-icon i').removeClass('fa-plus').addClass('fa-minus');
	}

	$(".toggle .toggle-title").click(function(){
		if( $(this).hasClass('active') ){
			$(this).removeClass("active").closest('.toggle').find('.toggle-inner').slideUp(200);
			$(this).find('.status-icon i').removeClass('fa-minus').addClass('fa-plus');
		}
		else{
			$(this).addClass("active").closest('.toggle').find('.toggle-inner').slideDown(200);
			$(this).find('.status-icon i').removeClass('fa-plus').addClass('fa-minus');
		}
	});
	/* ------------------------------------------------------------------------ */
	/* Banner's badge */
	/* ------------------------------------------------------------------------ */
	var banner_height = $('.banner .banner_bg').height();
	$('.bannerposition').height(banner_height);

	function activate_waypoints(container)
	{
		//activates simple css animations of the content once the user scrolls to an elements
		if($.fn.appearence)
		{
			if(typeof container == 'undefined'){ container = 'body';};

			$('.when_visible', container).appearence();
			$('.when_almost_visible', container).appearence({ offset: '80%'});
		}
	}
	activate_waypoints('body');

	/*hovers for portfolio elements*/
	$('.portfolio-item:not(.portfolio-item-one), .portfolio-item.portfolio-item-one .portfolio-pic').hover(function() {
		$(this).find('.portfolio-overlay').stop().animate({'opacity' : 1}, 300);
		$(this).find('.overlay-link').stop().animate({'opacity' : 1}, 160, 'easeOutSine').addClass('zoom-out');
	}, function(){
		$(this).find('.portfolio-overlay').stop().animate({'opacity' : 0}, 200);
		$(this).find('.overlay-link').stop().removeClass('zoom-out').animate({'opacity' : 0}, 260, 'easeOutSine');
	});

	/* ------------------------------------------------------------------------ */
	/* Video Background
	/* ------------------------------------------------------------------------ */

	vid_w_orig = parseInt($('video').attr('width'));
    vid_h_orig = parseInt($('video').attr('height'));

    $(window).resize(function () { resizeToCover(); });
    $(window).trigger('resize');

/* EOF document.ready */
});
jQuery(window).load(function(){
	resizeToCover();
});	
function resizeToCover() {
	jQuery('.videosection .video-wrap').each(function(i){

		var $sectionWidth = jQuery(this).closest('.videosection').outerWidth();
		var $sectionHeight = jQuery(this).closest('.videosection').outerHeight();
		
		jQuery(this).width($sectionWidth);
		jQuery(this).height($sectionHeight);

		// calculate scale ratio
		var scale_h = $sectionWidth / video_width_original;
		var scale_v = $sectionHeight / video_height_original; 
		var scale = scale_h > scale_v ? scale_h : scale_v;

		// limit minimum width
		min_w = vid_ratio * ($sectionHeight+20);
		
		if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}
				
		jQuery(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
		jQuery(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
		
		jQuery(this).scrollLeft((jQuery(this).find('video').width() - $sectionWidth) / 2);
			
		jQuery(this).find('.mejs-overlay, .mejs-poster').scrollTop((jQuery(this).find('video').height() - ($sectionHeight)) / 2);
		jQuery(this).scrollTop((jQuery(this).find('video').height() - ($sectionHeight)) / 2);
		
	});

} // end resizetocover
/* Tabset Function ---------------------------------- */
(function ($) {
$.fn.tabset = function () {
    var $tabsets = $(this);
    $tabsets.each(function (i) {
        var $tabs = $('li.tab > a, .panel li.tab > a, form.checkout a.button.continue-checkout', this);
        $tabs.click(function (e) {
            var $this = $(this);
                panels = $.map($tabs, function (val, i) {
                    return $(val).attr('href');
                });
            $(panels.join(',')).hide();
            $tabs.removeClass('selected');
            $this.addClass('selected').blur();
            $($this.attr('href')).show();
            e.preventDefault();
            return false;
        });
        setTimeout(function(){$tabs.first().triggerHandler('click')}, 500);
    });
};

//waipoint script when something comes into viewport
 $.fn.appearence = function(options_passed)
	{
		var defaults = { offset: 'bottom-in-view' , triggerOnce: true},
			options  = $.extend({}, defaults, options_passed);
		return this.each(function()
		{
			var element = $(this);

			setTimeout(function()
			{
				element.waypoint(function(direction)
				{
				 	$(this).addClass('animation').trigger('animation');

				}, options );

			},100)
		});
	};
})(jQuery);
/*
jQuery Waypoints - v2.0.2
Copyright (c) 2011-2013 Caleb Troughton
Dual licensed under the MIT license and GPL license.
https://github.com/imakewebthings/jquery-waypoints/blob/master/licenses.txt
*/
(function(){var t=[].indexOf||function(t){for(var e=0,n=this.length;e<n;e++){if(e in this&&this[e]===t)return e}return-1},e=[].slice;(function(t,e){if(typeof define==="function"&&define.amd){return define("waypoints",["jquery"],function(n){return e(n,t)})}else{return e(t.jQuery,t)}})(this,function(n,r){var i,o,l,s,f,u,a,c,h,d,p,y,v,w,g,m;i=n(r);c=t.call(r,"ontouchstart")>=0;s={horizontal:{},vertical:{}};f=1;a={};u="waypoints-context-id";p="resize.waypoints";y="scroll.waypoints";v=1;w="waypoints-waypoint-ids";g="waypoint";m="waypoints";o=function(){function t(t){var e=this;this.$element=t;this.element=t[0];this.didResize=false;this.didScroll=false;this.id="context"+f++;this.oldScroll={x:t.scrollLeft(),y:t.scrollTop()};this.waypoints={horizontal:{},vertical:{}};t.data(u,this.id);a[this.id]=this;t.bind(y,function(){var t;if(!(e.didScroll||c)){e.didScroll=true;t=function(){e.doScroll();return e.didScroll=false};return r.setTimeout(t,n[m].settings.scrollThrottle)}});t.bind(p,function(){var t;if(!e.didResize){e.didResize=true;t=function(){n[m]("refresh");return e.didResize=false};return r.setTimeout(t,n[m].settings.resizeThrottle)}})}t.prototype.doScroll=function(){var t,e=this;t={horizontal:{newScroll:this.$element.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.$element.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};if(c&&(!t.vertical.oldScroll||!t.vertical.newScroll)){n[m]("refresh")}n.each(t,function(t,r){var i,o,l;l=[];o=r.newScroll>r.oldScroll;i=o?r.forward:r.backward;n.each(e.waypoints[t],function(t,e){var n,i;if(r.oldScroll<(n=e.offset)&&n<=r.newScroll){return l.push(e)}else if(r.newScroll<(i=e.offset)&&i<=r.oldScroll){return l.push(e)}});l.sort(function(t,e){return t.offset-e.offset});if(!o){l.reverse()}return n.each(l,function(t,e){if(e.options.continuous||t===l.length-1){return e.trigger([i])}})});return this.oldScroll={x:t.horizontal.newScroll,y:t.vertical.newScroll}};t.prototype.refresh=function(){var t,e,r,i=this;r=n.isWindow(this.element);e=this.$element.offset();this.doScroll();t={horizontal:{contextOffset:r?0:e.left,contextScroll:r?0:this.oldScroll.x,contextDimension:this.$element.width(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:r?0:e.top,contextScroll:r?0:this.oldScroll.y,contextDimension:r?n[m]("viewportHeight"):this.$element.height(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};return n.each(t,function(t,e){return n.each(i.waypoints[t],function(t,r){var i,o,l,s,f;i=r.options.offset;l=r.offset;o=n.isWindow(r.element)?0:r.$element.offset()[e.offsetProp];if(n.isFunction(i)){i=i.apply(r.element)}else if(typeof i==="string"){i=parseFloat(i);if(r.options.offset.indexOf("%")>-1){i=Math.ceil(e.contextDimension*i/100)}}r.offset=o-e.contextOffset+e.contextScroll-i;if(r.options.onlyOnScroll&&l!=null||!r.enabled){return}if(l!==null&&l<(s=e.oldScroll)&&s<=r.offset){return r.trigger([e.backward])}else if(l!==null&&l>(f=e.oldScroll)&&f>=r.offset){return r.trigger([e.forward])}else if(l===null&&e.oldScroll>=r.offset){return r.trigger([e.forward])}})})};t.prototype.checkEmpty=function(){if(n.isEmptyObject(this.waypoints.horizontal)&&n.isEmptyObject(this.waypoints.vertical)){this.$element.unbind([p,y].join(" "));return delete a[this.id]}};return t}();l=function(){function t(t,e,r){var i,o;r=n.extend({},n.fn[g].defaults,r);if(r.offset==="bottom-in-view"){r.offset=function(){var t;t=n[m]("viewportHeight");if(!n.isWindow(e.element)){t=e.$element.height()}return t-n(this).outerHeight()}}this.$element=t;this.element=t[0];this.axis=r.horizontal?"horizontal":"vertical";this.callback=r.handler;this.context=e;this.enabled=r.enabled;this.id="waypoints"+v++;this.offset=null;this.options=r;e.waypoints[this.axis][this.id]=this;s[this.axis][this.id]=this;i=(o=t.data(w))!=null?o:[];i.push(this.id);t.data(w,i)}t.prototype.trigger=function(t){if(!this.enabled){return}if(this.callback!=null){this.callback.apply(this.element,t)}if(this.options.triggerOnce){return this.destroy()}};t.prototype.disable=function(){return this.enabled=false};t.prototype.enable=function(){this.context.refresh();return this.enabled=true};t.prototype.destroy=function(){delete s[this.axis][this.id];delete this.context.waypoints[this.axis][this.id];return this.context.checkEmpty()};t.getWaypointsByElement=function(t){var e,r;r=n(t).data(w);if(!r){return[]}e=n.extend({},s.horizontal,s.vertical);return n.map(r,function(t){return e[t]})};return t}();d={init:function(t,e){var r;if(e==null){e={}}if((r=e.handler)==null){e.handler=t}this.each(function(){var t,r,i,s;t=n(this);i=(s=e.context)!=null?s:n.fn[g].defaults.context;if(!n.isWindow(i)){i=t.closest(i)}i=n(i);r=a[i.data(u)];if(!r){r=new o(i)}return new l(t,r,e)});n[m]("refresh");return this},disable:function(){return d._invoke(this,"disable")},enable:function(){return d._invoke(this,"enable")},destroy:function(){return d._invoke(this,"destroy")},prev:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e>0){return t.push(n[e-1])}})},next:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e<n.length-1){return t.push(n[e+1])}})},_traverse:function(t,e,i){var o,l;if(t==null){t="vertical"}if(e==null){e=r}l=h.aggregate(e);o=[];this.each(function(){var e;e=n.inArray(this,l[t]);return i(o,e,l[t])});return this.pushStack(o)},_invoke:function(t,e){t.each(function(){var t;t=l.getWaypointsByElement(this);return n.each(t,function(t,n){n[e]();return true})});return this}};n.fn[g]=function(){var t,r;r=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(d[r]){return d[r].apply(this,t)}else if(n.isFunction(r)){return d.init.apply(this,arguments)}else if(n.isPlainObject(r)){return d.init.apply(this,[null,r])}else if(!r){return n.error("jQuery Waypoints needs a callback function or handler option.")}else{return n.error("The "+r+" method does not exist in jQuery Waypoints.")}};n.fn[g].defaults={context:r,continuous:true,enabled:true,horizontal:false,offset:0,triggerOnce:false};h={refresh:function(){return n.each(a,function(t,e){return e.refresh()})},viewportHeight:function(){var t;return(t=r.innerHeight)!=null?t:i.height()},aggregate:function(t){var e,r,i;e=s;if(t){e=(i=a[n(t).data(u)])!=null?i.waypoints:void 0}if(!e){return[]}r={horizontal:[],vertical:[]};n.each(r,function(t,i){n.each(e[t],function(t,e){return i.push(e)});i.sort(function(t,e){return t.offset-e.offset});r[t]=n.map(i,function(t){return t.element});return r[t]=n.unique(r[t])});return r},above:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset<=t.oldScroll.y})},below:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset>t.oldScroll.y})},left:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset<=t.oldScroll.x})},right:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset>t.oldScroll.x})},enable:function(){return h._invoke("enable")},disable:function(){return h._invoke("disable")},destroy:function(){return h._invoke("destroy")},extendFn:function(t,e){return d[t]=e},_invoke:function(t){var e;e=n.extend({},s.vertical,s.horizontal);return n.each(e,function(e,n){n[t]();return true})},_filter:function(t,e,r){var i,o;i=a[n(t).data(u)];if(!i){return[]}o=[];n.each(i.waypoints[e],function(t,e){if(r(i,e)){return o.push(e)}});o.sort(function(t,e){return t.offset-e.offset});return n.map(o,function(t){return t.element})}};n[m]=function(){var t,n;n=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(h[n]){return h[n].apply(null,t)}else{return h.aggregate.call(null,n)}};n[m].settings={resizeThrottle:100,scrollThrottle:30};return i.load(function(){return n[m]("refresh")})})}).call(this);


/* ------------------------------------------------------------------------ */
/* EOF */
/* ------------------------------------------------------------------------ */