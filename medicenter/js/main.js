if(!Date.prototype.toISOString) 
{
    Date.prototype.toISOString = function() 
	{
        function pad(n) {return n < 10 ? '0' + n : n}
        return this.getUTCFullYear() + '-'
            + pad(this.getUTCMonth() + 1) + '-'
                + pad(this.getUTCDate()) + 'T'
                    + pad(this.getUTCHours()) + ':'
                        + pad(this.getUTCMinutes()) + ':'
                            + pad(this.getUTCSeconds()) + 'Z';
    };
}
function getRandom(min,max)
{
	return((Math.floor(Math.random()*(max-min)))+min);
}
function onAfterSlide(obj)
{
	var currentSlide = obj.items.visible;
	var expando = jQuery(this).get(0)[jQuery.expando];
	jQuery("#slider_navigation_" + expando + " .slider_control").addClass("inactive");
	jQuery("#" + jQuery(currentSlide).attr("id") + "_content").fadeIn(200, function(){
		jQuery("#slider_navigation_" + expando + " .slider_control").removeClass("inactive");
	});	
}
function onBeforeSlide(obj)
{
	var prevSlide = obj.items.old;
	var currentSlide = obj.items.visible;
	var expando = jQuery(this).get(0)[jQuery.expando];
	var elementClasses = jQuery(this).attr('class').split(' ');
	var easing = "easeInOutQuint";
	var duration = 750;
	for(var i=0; i<elementClasses.length; i++)
	{
		if(elementClasses[i].indexOf('easing-')!=-1)
			easing = elementClasses[i].replace('easing-', '');
		if(elementClasses[i].indexOf('duration-')!=-1)
			duration = elementClasses[i].replace('duration-', '');
	}
	
	jQuery(".slider_" + expando + "_content_container .slider_content").fadeOut(200);
	jQuery("#slider_navigation_" + expando + " .slider_control_bar").css("display", "none");
	var navigationWidth = jQuery("#slider_navigation_" + expando).width() ;
	var currentNav = jQuery(jQuery("#" + jQuery(currentSlide).attr("id") + "_control"));
	var prevNav = jQuery(jQuery("#" + jQuery(prevSlide).attr("id") + "_control"));
	var currentMarginRight = navigationWidth - currentNav.position().left - currentNav.width();
	var prevMarginRight = navigationWidth - prevNav.position().left - prevNav.width();
	var margin_option_css, margin_option_animate;
	if(config.is_rtl==1) {
		margin_option_css = { 'margin-right' : prevMarginRight + "px" };
		margin_option_animate = { 'margin-right': currentMarginRight + "px" };
	} else {
		margin_option_css = { 'margin-left' : prevNav.position().left + "px" };
		margin_option_animate = { 'margin-left': currentNav.position().left + "px" };
	}
	
	jQuery("#slider_navigation_" + expando + " .slider_bar").css(jQuery.extend(margin_option_css,{"display": "block"}));
	jQuery("#slider_navigation_" + expando + " .slider_bar").animate(margin_option_animate,
		parseInt(duration), easing, function(){
			jQuery(this).css("display", "none");
			jQuery("#" + jQuery(currentSlide).attr("id") + "_control").children("#slider_navigation_" + expando + " .slider_control_bar").css("display", "block");
	});
}
function pushState(event)
{
	event.preventDefault();
	var History = window.History;
	var url = jQuery(this).attr("href");
	if(typeof(url)!="undefined")
	{
		var hashSplit = url.split("#");
		if(event.data.action=="theme_doctors_pagination")
		{
			if(jQuery(this).parent().hasClass("selected"))
				return false;
			var container = jQuery(this).parent().parent().prev();
			container.attr("id", "theme_doctors_pagination_" + container["context"][jQuery.expando]);
			event.data.container_id = container.attr("id");
			jQuery(this).parent().parent().children(".selected").removeClass("selected");
			jQuery(this).parent().addClass("selected");
		}
		else if(event.data.action=="theme_gallery_pagination")
		{
			if(jQuery(this).parent().hasClass("selected"))
				return false;
			var container = jQuery(this).parent().parent().prev();
			container.attr("id", "theme_gallery_pagination_" + container["context"][jQuery.expando]);
			event.data.container_id = container.attr("id");
			jQuery(this).parent().parent().children(".selected").removeClass("selected");
			jQuery(this).parent().addClass("selected");
		}
		if(hashSplit.length==2)
		{
			event.data.hash = hashSplit[1];
			url = url.replace("#" + hashSplit[1], "");
		}
		var title = "";
		if(history.pushState)
			History.pushState(event.data, title, url);
		else
			History.pushState(event.data, title, url);
	}
};
jQuery(document).ready(function($){
	//mobile menu
	$(".mobile-menu-switch").click(function(event){
		event.preventDefault();
		if(!$(".mobile-menu").is(":visible"))
			$(".mobile-menu-divider").css("display", "block");
		$(".mobile_menu_container nav.mobile_menu").slideToggle(500, function(){
			if(!$(".mobile_menu_container nav.mobile_menu").is(":visible"))
				$(".mobile-menu-divider").css("display", "none");
		});
	});
	$(".collapsible-mobile-submenus .template-arrow-menu").on("click", function(event){
		event.preventDefault();
		$(this).next().slideToggle(300);
		$(this).toggleClass("template-arrow-expanded");
	});
	
	//slider
	$(".slider").each(function(index){
		var autoplay = 0;
		var pause_on_hover = 0;
		var interval = 5000;
		var effect = "scroll";
		var easing = "easeInOutQuint";
		var duration = 750;
		var elementClasses = $(this).attr('class').split(' ');
		for(var i=0; i<elementClasses.length; i++)
		{
			if(elementClasses[i].indexOf('autoplay-')!=-1)
				autoplay = elementClasses[i].replace('autoplay-', '');
			if(elementClasses[i].indexOf('pause_on_hover-')!=-1)
				pause_on_hover = elementClasses[i].replace('pause_on_hover-', '');
			if(elementClasses[i].indexOf('interval-')!=-1)
				interval = elementClasses[i].replace('interval-', '');
			if(elementClasses[i].indexOf('effect-')!=-1)
				effect = elementClasses[i].replace('effect-', '');
			if(elementClasses[i].indexOf('easing-')!=-1)
				easing = elementClasses[i].replace('easing-', '');
			if(elementClasses[i].indexOf('duration-')!=-1)
				duration = elementClasses[i].replace('duration-', '');
			/*if(elementClasses[i].indexOf('threshold-')!=-1)
				var threshold = elementClasses[i].replace('threshold-', '');*/
		}
		var carouselOptions = {
			responsive: true,
			prev: {
				onAfter: onAfterSlide,
				onBefore: onBeforeSlide,
				fx: effect,
				easing: easing,
				duration: parseInt(duration)
			},
			next: {
				onAfter: onAfterSlide,
				onBefore: onBeforeSlide,
				fx: effect,
				easing: easing,
				duration: parseInt(duration)
			},
			auto: {
				onAfter: onAfterSlide,
				onBefore: onBeforeSlide,
				play: (parseInt(autoplay) ? true : false),
				pauseDuration: parseInt(interval),
				fx: effect,
				easing: easing,
				duration: parseInt(duration),
				pauseOnHover: (parseInt(pause_on_hover) ? true : false)
			}
		};
		$(this).carouFredSel(carouselOptions,
		{
			wrapper: {
				classname: "caroufredsel_wrapper caroufredsel_wrapper_slider"
			}
		});
		if($(this).children().length>1) {
			$(this).sliderControl({
				appendTo: $(".slider_content_box"),
				contentContainer: $(".slider_content_box")
			});
		}
	});
	/*$(".slider").carouFredSel({
		responsive: true,
		prev: {
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		},
		next: {
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		},
		auto: {
			play: true,
			pauseDuration: 5000,
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			easing: "easeInOutQuint",
			duration: 750
		}
	},
	{
		wrapper: {
			classname: "caroufredsel_wrapper caroufredsel_wrapper_slider"
		}
	});*/
	
	//image carousel with preloader
	var imageCarousel = function()
	{
		$(".image_carousel").each(function(index){
			$(this).addClass("mc_preloader_" + index);			
			$(".mc_preloader_" + index + " img:first").one("load", function(){
				$(this).prev(".mc_preloader").remove();
				$(this).fadeIn();
				//caroufred
				var autoplay = 0;			
				var pause_on_hover = 0;
				var scroll = 1;
				var effect = "scroll";
				var easing = "easeInOutQuint";
				var duration = 750;
				var elementClasses = $(".mc_preloader_" + index).attr('class').split(' ');
				for(var i=0; i<elementClasses.length; i++)
				{
					if(elementClasses[i].indexOf('autoplay-')!=-1)
						autoplay = elementClasses[i].replace('autoplay-', '');
					if(elementClasses[i].indexOf('pause_on_hover-')!=-1)
						pause_on_hover = elementClasses[i].replace('pause_on_hover-', '');
					if(elementClasses[i].indexOf('scroll-')!=-1)
						scroll = elementClasses[i].replace('scroll-', '');
					if(elementClasses[i].indexOf('effect-')!=-1)
						effect = elementClasses[i].replace('effect-', '');
					if(elementClasses[i].indexOf('easing-')!=-1)
						easing = elementClasses[i].replace('easing-', '');
					if(elementClasses[i].indexOf('duration-')!=-1)
						duration = elementClasses[i].replace('duration-', '');
					/*if(elementClasses[i].indexOf('threshold-')!=-1)
						var threshold = elementClasses[i].replace('threshold-', '');*/
				}
				var carouselOptions = {
					responsive: true,
					prev: {
						onAfter: onAfterSlide,
						onBefore: onBeforeSlide,
						items: parseInt(scroll),
						fx: effect,
						easing: easing,
						duration: parseInt(duration)
					},
					next: {
						onAfter: onAfterSlide,
						onBefore: onBeforeSlide,
						items: parseInt(scroll),
						fx: effect,
						easing: easing,
						duration: parseInt(duration)
					},
					auto: {
						onAfter: onAfterSlide,
						onBefore: onBeforeSlide,
						items: parseInt(scroll),
						play: (parseInt(autoplay) ? true : false),
						fx: effect,
						easing: easing,
						duration: parseInt(duration),
						pauseOnHover: (parseInt(pause_on_hover) ? true : false)
					}
				};
				$(".mc_preloader_" + index).carouFredSel(carouselOptions);
				/*$(".mc_preloader_" + index).carouFredSel({
					responsive: true,
					prev: {

						easing: "easeInOutQuint",
						duration: 750
					},
					next: {

						easing: "easeInOutQuint",
						duration: 750
					},
					auto: {
						play: false,


						easing: "easeInOutQuint",
						duration: 750
					}
				});*/
				if($(".mc_preloader_" + index).children().length>1)
				{
					$(".mc_preloader_" + index).sliderControl({
						appendTo: "",
						contentContainer: ""
					});
				}
				$(".mc_preloader_" + index + " li img").css("display", "block");
				//$(".mc_preloader_" + index).trigger('configuration', ['debug', false, true]); //for width
				$(".mc_preloader_" + index).trigger('configuration', ['debug', false, true]); //for width
				$(window).trigger("resize");
				$(".mc_preloader_" + index).trigger('configuration', ['debug', false, true]); //for height
			}).each(function(){
				if(this.complete) 
					$(this).load();
			});
		});
	};
	imageCarousel();
	
	//preloader
	var preloader = function()
	{
		$(".post_content a.post_image img, .mc_preload").each(function(){			
			$(this).one("load", function(){
				$(this).prev(".mc_preloader").remove();
				$(this).fadeIn();
				$(this).css("display", "block");
			}).each(function(){
				if(this.complete) 
					$(this).load();
			});
		});
	};
	preloader();
	
	
	/*$("ul.gallery_item_details_list").css({
		"height": 0,
		"display": "none"
	});
	$(".gallery_item_details_list li.gallery_item_details").css("display", "none");*/
	
	//horizontal carousel
	$(".horizontal_carousel").each(function(){
		var self = $(this);
		var elementClasses = self.attr('class').split(' ');
		var count = self.find('.gallery_box').length;
		for(var i=0; i<elementClasses.length; i++)
		{
			if(elementClasses[i].indexOf('id-')!=-1)
				var id = elementClasses[i].replace('id-', '');
			if(elementClasses[i].indexOf('autoplay-')!=-1)
				var autoplay = elementClasses[i].replace('autoplay-', '');
			if(elementClasses[i].indexOf('pause_on_hover-')!=-1)
				var pause_on_hover = elementClasses[i].replace('pause_on_hover-', '');
			if(elementClasses[i].indexOf('scroll-')!=-1)
				var scroll = elementClasses[i].replace('scroll-', '');
			if(elementClasses[i].indexOf('effect-')!=-1)
				var effect = elementClasses[i].replace('effect-', '');
			if(elementClasses[i].indexOf('easing-')!=-1)
				var easing = elementClasses[i].replace('easing-', '');
			if(elementClasses[i].indexOf('duration-')!=-1)
				var duration = elementClasses[i].replace('duration-', '');
			/*if(elementClasses[i].indexOf('threshold-')!=-1)
				var threshold = elementClasses[i].replace('threshold-', '');*/
		}

		var carouselOptions = {
			items: {
				start: (config.is_rtl==1 ? count-4 : 0),
				visible: 4
			},
			prev: {
				items: parseInt(scroll),
				button: $('#' + id + '_prev'),
				fx: effect,
				easing: easing,
				duration: parseInt(duration)
			},
			next: {
				items: parseInt(scroll),
				button: $('#' + id + '_next'),
				fx: effect,
				easing: easing,
				duration: parseInt(duration)
			},
			auto: {
				items: parseInt(scroll),
				play: (parseInt(autoplay) ? true : false),
				fx: effect,
				easing: easing,
				duration: parseInt(duration),
				pauseOnHover: (parseInt(pause_on_hover) ? true : false)
			}
		};
		/*if(self.hasClass('ontouch') || self.hasClass('onmouse'))
			carouselOptions.swipe = {
				items: parseInt(scroll),
				onTouch: (self.hasClass('ontouch') ? true : false),
				onMouse: (self.hasClass('onmouse') ? true : false),
				options: {
					allowPageScroll: "none",
					threshold: parseInt(threshold)
				},
				fx: effect,
				easing: easing,
				duration: parseInt(duration)
			};*/
		self.carouFredSel(carouselOptions);
	});
	//testimonials
	setTimeout(function(){
		$(".testimonials").trigger("configuration", {
			items: {
				visible: 2
			}
		});
	}, 1000);
	if($(".rev_slider_wrapper").length || $(".ls-wp-container").length)
	{
		var timer = 0;
		if($(".rev_slider_wrapper").length)
			timer = 100;
		if($(".ls-wp-container").length)
			timer = 1000;
		var posInterval = setTimeout(function(){
			$(".home_box_container_list").css("position", "static");
			setTimeout(function(){
				$(".home_box_container_list").css("position", "relative");
			}, 100);
		}, timer);
	}
	//accordion
	$(".accordion").each(function(){
		var active_tab = !isNaN(jQuery(this).data('active-tab')) && parseInt(jQuery(this).data('active-tab')) >  0 ? parseInt(jQuery(this).data('active-tab'))-1 : false,
		collapsible =  (active_tab===false ? true : false);
		$(this).accordion({
			event: 'change',
			heightStyle: 'content',
			icons: false,
			active: active_tab,
			collapsible: collapsible,
			create: function(event, ui){
				$(window).trigger('resize');
				$(".image_carousel").trigger('configuration', ['debug', false, true]);
			}
		});
		/*if(!$(this).hasClass("accordion-active"))
		{
			$(this).accordion("option", "collapsible", true);
			$(this).accordion("option", "active", false);
		}*/
	});
	$(".accordion.wide").bind("accordionactivate", function(event, ui){
		if(typeof($("#"+$(ui.newHeader).attr("id")).offset())!="undefined")
			$("html, body").animate({scrollTop: $("#"+$(ui.newHeader).attr("id")).offset().top}, 400);
	});
	$(".tabs").bind("tabsbeforeactivate", function(event, ui){
		$("html, body").animate({scrollTop: $("#"+$(ui.newTab).children("a").attr("id")).offset().top}, 400);
	});
	$(".tabs").on("tabsactivate", function(event, ui){
		ui.newPanel.find(".image_carousel").trigger('configuration', ['debug', false, true]);
		ui.newPanel.find(".image_carousel").trigger('configuration', ['debug', false, true]);
		$(window).trigger("resize");
	});
	
	$(".tabs").tabs({
		event: 'change',
		show: true,
		create: function(){
			$("html, body").scrollTop(0);
		}
	});
	
	//image controls
	var imageControls = function()
	{
		var currentControls;
		$(".gallery_box:not(.hover_icons_off)").hover(function(){
			var width = $(this).find("img").first().width();
			var height = $(this).find("img").first().height();
			currentControls = $(this).find(".controls");
			if(typeof(currentControls)!="undefined")
			{
				var currentControlsWidth = currentControls.outerWidth();
				var currentControlsHeight = currentControls.outerHeight();
				currentControls.stop();
				if(config.is_rtl==1) {
					margin_option = {"margin-right": (width/2-currentControlsWidth/2) + "px"};
				} else {
					margin_option = {"margin-left": (width/2-currentControlsWidth/2) + "px"};
				}
				currentControls.css(jQuery.extend(margin_option,{"display": "block","top": (height) + "px"}));
				currentControls.animate({"top": (height/2-currentControlsHeight/2) + "px"},250,'easeInOutCubic');
			}
		},function(){
			if(typeof(currentControls)!="undefined")
			{
				currentControls.stop();
				currentControls.css("display", "block");
				var height = $(this).find("img").first().height();
				currentControls.animate({"top": (height) + "px"},250,'easeInOutCubic', function(){
					$(this).css("display","none");
				});
			}
		});
		
		$(".gallery_box.hover_icons_off").click(function(event){
			var target = $(event.target);
			var navigation = $(this).find('.slider_navigation a');
			var details = $(this).find('.open_details');
			var secondary;
			if($(this).find('.image_carousel').length>0) {
				secondary = $(this).find('.image_carousel>li:first-child .open_lightbox,.image_carousel>li:first-child .open_video_lightbox,.image_carousel>li:first-child .open_iframe_lightbox,.image_carousel>li:first-child .open_url_lightbox');
			} else {
				secondary = $(this).find('.open_lightbox,.open_video_lightbox,.open_iframe_lightbox,.open_url_lightbox');
			}
			
			if( !target.is(details) &&
				!target.is(secondary) &&
				!target.is(navigation) )
			{
				if(details.attr('href')!==undefined) {					
					details[0].click();
				} else if( secondary.attr('href')!==undefined ) {
					secondary[0].click();
				}
			}
		});
	};
	imageControls();
	
	//browser history
	$(".tabs .ui-tabs-nav a").click(function(){
		if($(this).attr("href").substr(0,4)!="http")
			$.bbq.pushState($(this).attr("href"));
		else
			window.location.href = $(this).attr("href");
	});
	$(".ui-accordion .ui-accordion-header").click(function(){
		$.bbq.pushState("#" + $(this).attr("id").replace("accordion-", ""));
	});
	
	//tabs box navigation
	$(".tabs_box_navigation").mouseover(function(){
		$(this).find("ul").removeClass("tabs_box_navigation_hidden");
	});
	$(".tabs_box_navigation a").click(function(){
		$(".tabs_box_navigation_selected .selected").removeClass("selected");
		$(this).parent().addClass("selected");
		$(this).parent().parent().parent().children('span').text($(this).text());
		$(this).parent().parent().addClass("tabs_box_navigation_hidden");
	});
	$(".contact_form .tabs_box_navigation a").click(function(event){
		event.preventDefault();
		$(this).parent().parent().parent().children("[type='hidden']").first().val($.trim($(this).text()));
	});
	
	//comments number scroll
	$(".single .comments_number").click(function(event){
		event.preventDefault();
		var offset = $("#comments_list").offset();
		if(typeof(offset)!="undefined")
			$("html, body").animate({scrollTop: offset.top-10}, 400);
	});
	
	//hashchange
	$(window).bind("hashchange", function(event){
		var hashSplit = $.param.fragment().split("-");
		var hashString = "";
		for(var i=0; i<hashSplit.length-1; i++)
			hashString = hashString + hashSplit[i] + (i+1<hashSplit.length-1 ? "-" : "");
		if(hashSplit[0].substr(0,7)!="filter" && hashSplit[0].substr(0,4)!="page")
		{
			$('.ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent($.param.fragment())).trigger("change");
			$(".tabs_box_navigation a[href='#" + decodeURIComponent($.param.fragment()) + "']").trigger("click");
			$('.ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent(hashString)).trigger("change");
		}
		$('.tabs .ui-tabs-nav [href="#' + decodeURIComponent(hashString) + '"]').trigger("change");
		$('.tabs .ui-tabs-nav [href="#' + decodeURIComponent($.param.fragment()) + '"]').trigger("change");
		if(hashSplit[0].substr(0,7)!="filter")
			$('.tabs .ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent($.param.fragment())).trigger("change");
		$(".isotope.mc_gallery:not('.horizontal_carousel, .no_isotope')").isotope('reLayout');
		$(".testimonials, .scrolling_list").trigger('configuration', ['debug', false, true]);
		
		/*var maxHeight = Math.max.apply(null, $(".timetable:visible tr td:first-child").map(function ()
		{
			return $(this).height();
		}).get());
		$(".timetable:visible tr td").css("height", maxHeight);*/
		//timetable height fix
		/*$(".timetable .event").each(function(){
			if($(this).children(".event_container").length>1)
			{
				var childrenHeight = 0;
				$(this).children(".event_container").not(":last").each(function(){
					childrenHeight += $(this).innerHeight();
				});
				var height = $(this).height()-childrenHeight-($(this).parent().parent().width()<=750 ? 9 : 22);
				if(height>$(this).children(".event_container").last().height())
					$(this).children(".event_container").last().css("height", height + "px");
			}
		});*/
		
		// get options object from hash
		var hashOptions = $.deparam.fragment();
		if(hashSplit[0].substr(0,7)=="filter")
		{
			var filterClass = decodeURIComponent($.param.fragment()).substr(7, decodeURIComponent($.param.fragment()).length);
			// apply options from hash
			$(".isotope_filters a").removeClass("selected");
			if($('.isotope_filters a[href="#filter-' + filterClass + '"]').length)
				$('.isotope_filters a[href="#filter-' + filterClass + '"]').addClass("selected");
			else
				$(".isotope_filters li:first a").addClass("selected");
			
			$(".mc_gallery:not('.horizontal_carousel, .no_isotope')").isotope({filter: (filterClass!="*" ? "." : "") + filterClass, transformsEnabled: (config.is_rtl===1 ? false : true)});
			//$(".timetable_isotope").isotope(hashOptions);
		}
		
		if(hashSplit[0].substr(0,7)=="comment")
		{
			if($(location.hash).length)
			{
				var offset = $(location.hash).offset();
				$("html, body").animate({scrollTop: offset.top-10}, 400);
			}
		}
		
		if(hashSplit[0]=="comments")
		{
			$(".single .comments_number").trigger("click");
		}
		if(hashSplit[0].substr(0,4)=="page")
		{
			if(parseInt($("#comment_form [name='prevent_scroll']").val())==1)
			{
				$("#comment_form [name='prevent_scroll']").val(0);
				$("#comment_form [name='paged']").val(parseInt(location.hash.substr(6)));
			}
			else
			{
				$.ajax({
					url: config.ajaxurl,
					data: "action=theme_get_comments&post_id=" + $("#comment_form [name='post_id']").val() + "&post_type=" + $("#comment_form [name='post_type']").val() + "&paged="+parseInt(location.hash.substr(6)),
					type: "get",
					dataType: "json",
					success: function(json){
						if(typeof(json.html)!="undefined")
							$(".comments").html(json.html);
						var hashSplit = location.hash.split("/");
						var offset = null;
						if(hashSplit.length==2 && hashSplit[1]!="")
							offset = $("#" + hashSplit[1]).offset();
						else
							offset = $(".comments").offset();
						if(offset!=null)
							$("html, body").animate({scrollTop: offset.top-10}, 400);
						$("#comment_form [name='paged']").val(parseInt(location.hash.substr(6)));
					}
				});
				return;
			}
		}
		
		//open gallery details
		if(location.hash.substr(1,21)=="gallery-details-close" || hashSplit[0].substr(0,7)=="filter")
		{
			$(".gallery_item_details_list").animate({height:'0'},{duration:200,easing:'easeOutQuint', complete:function(){
				$(this).css("display", "none")
				$(".gallery_item_details_list .gallery_item_details").css("display", "none");
			}
			});
		}
		else if(location.hash.substr(1,15)=="gallery-details")
		{
			var detailsBlock = $('[id="' + location.hash.substr(1) + '"]');
			//var detailsBlock = $(location.hash);
			$(".gallery_item_details_list .gallery_item_details").css("display", "none");
			detailsBlock.css("display", "block");
			var galleryItem = $('[id="gallery-item-' + location.hash.substr(17) + '"]');
			//var galleryItem = $("#gallery-item-" + location.hash.substr(17));
			//detailsBlock.find(".prev").attr("href", (galleryItem.prevAll(":not('.isotope-hidden')").first().length ? galleryItem.prevAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".mc_gallery:not('.horizontal_carousel')").children(":not('.isotope-hidden')").last().find(".open_details").attr("href")));
			//detailsBlock.find(".next").attr("href", (galleryItem.nextAll(":not('.isotope-hidden')").first().length ? galleryItem.nextAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".mc_gallery:not('.horizontal_carousel')").children(":not('.isotope-hidden')").first().find(".open_details").attr("href")));
			detailsBlock.find(".prev").attr("href", (galleryItem.prevAll(":not('.isotope-hidden')").first().length ? galleryItem.prevAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".mc_gallery").children(":not('.isotope-hidden')").last().find(".open_details").attr("href")));
			detailsBlock.find(".next").attr("href", (galleryItem.nextAll(":not('.isotope-hidden')").first().length ? galleryItem.nextAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".mc_gallery").children(":not('.isotope-hidden')").first().find(".open_details").attr("href")));
			var visible=parseInt($(".gallery_item_details_list").height())==0 ? false : true;
			var galleryItemDetailsOffset;
			if(!visible)
			{
				$(".gallery_item_details_list").css("display", "block").animate({height:detailsBlock.height()}, 500, 'easeOutQuint', function(){
					$(this).css("height", "100%");
					//$(location.hash + " .image_carousel").trigger('configuration', ['debug', false, true]);
					$(window).trigger("resize");
				});
				galleryItemDetailsOffset = $(".gallery_item_details_list").offset();
				if(typeof(galleryItemDetailsOffset)!="undefined")
					$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-10}, 400);
			}
			else
			{
				/*$(".gallery_item_details_list").animate({height:'0'},{duration:200,easing:'easeOutQuint',complete:function() 
				{
					$(this).css("display", "none")*/
					//$(".gallery_item_details_list").css("height", "100%");
					galleryItemDetailsOffset = $(".gallery_item_details_list").offset();
					if(typeof(galleryItemDetailsOffset)!="undefined")
						$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-10}, 400);
					//$(location.hash + " .image_carousel").trigger('configuration', ['debug', false, true]);
					$(window).trigger("resize");
					/*$(".gallery_item_details_list").css("display", "block").animate({height:detailsBlock.height()},{duration:500,easing:'easeOutQuint'});
				}});*/
			}
		}
	}).trigger("hashchange");
	
	//History
	History.Adapter.bind(window,'statechange',function(){
		var state = History.getState();
		var stateSplit = state.url.replace(new RegExp(config.home_url, 'g'), "").split("/");
		stateSplit = $.grep(stateSplit,function(n){
			return(n);
		});
		if(typeof(stateSplit)!="undefined")
			var stateSplitLast = stateSplit[stateSplit.length-1];
		var data = state.data;
		if(data.action=="theme_doctors_pagination")
		{
			data.paged = 1;
			if(typeof(stateSplit)!="undefined" && parseInt(stateSplitLast))
				data.paged = parseInt(stateSplitLast);
			data.atts = $("[name='theme_doctors_pagination']").val();
			$("#" + data.container_id).next().next(".mc_preloader").css("display", "block");
		}
		else if(data.action=="theme_gallery_pagination")
		{
			data.paged = 1;
			if(typeof(stateSplit)!="undefined" && parseInt(stateSplitLast))
				data.paged = parseInt(stateSplitLast);
			data.atts = $("[name='theme_gallery_pagination']").val();
			$("#" + data.container_id).next().next(".mc_preloader").css("display", "block");
		}
		$.ajax({
				url: config.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: data,
				success: function(html){
					html = $.trim(html);
					var indexStart = html.indexOf("theme_start")+11;
					var indexEnd = html.indexOf("theme_end")-indexStart;
					html = html.substr(indexStart, indexEnd);
					$("#" + data.container_id).html(html);
					$("#" + data.container_id).next().next(".mc_preloader").css("display", "none");
					$(".mc_gallery:not('.horizontal_carousel, .no_isotope')").isotope({
						masonry: {
							//columnWidth: 225,
							gutterWidth: ($(".mc_gallery:not('.horizontal_carousel, .no_isotope')").width()>462 ? 30 : 12)
						},
						transformsEnabled: (config.is_rtl===1 ? false : true)
					});
					preloader();
					imageControls();
					imageCarousel();
					$("html, body").animate({scrollTop: $("#" + data.container_id).offset().top}, 400);
				}
		});
	});
	//setTimeout(function(){History.Adapter.trigger(window,'statechange');},1);
	
	//ajax pagination
	$(".pagination.ajax.theme_doctors_pagination a").click({action: 'theme_doctors_pagination'}, pushState);
	$(".pagination.ajax.theme_gallery_pagination a").click({action: 'theme_gallery_pagination'}, pushState);
	
	//timeago
	//translation
	/*jQuery.timeago.settings.strings = {
		prefixAgo: null,
		prefixFromNow: null,
		suffixAgo: "ago",
		suffixFromNow: "from now",
		seconds: "less than a minute",
		minute: "about a minute",
		minutes: "%d minutes",
		hour: "about an hour",
		hours: "about %d hours",
		day: "a day",
		days: "%d days",
		month: "about a month",
		months: "%d months",
		year: "about a year",
		years: "%d years",
		wordSeparator: " ",
		numbers: []
	};*/
	$("abbr.timeago").timeago();
	
	//footer recent posts, most commented, most viewed, scrolling list
	$(".latest_tweets, .footer_recent_posts, .most_commented, .most_viewed, .scrolling_list_0").carouFredSel({
		direction: "up",
		scroll: {
			items: 1,
			easing: "swing",
			pauseOnHover: true,
			height: "variable"
		},
		auto: {
			play: false
		},
		prev: {
			button: function(){
				return $(this).parent().parent().parent().find('.scrolling_list_control_left');
			}
		},
		next: {
			button: function(){
				return $(this).parent().parent().parent().find('.scrolling_list_control_right');
			}
		}
	});
	$(".latest_tweets").trigger("configuration", {
		items: {
			visible: ($(".latest_tweets").children().length>2 ? 3 : $(".latest_tweets").children().length)
		}
	});
	$(".footer_recent_posts").trigger("configuration", {
		items: {
			visible: ($(".footer_recent_posts").children().length>2 ? 3 : $(".footer_recent_posts").children().length)
		}
	});
	$(".most_commented").trigger("configuration", {
		items: {
			visible: ($(".most_commented").children().length>2 ? 3 : $(".most_commented").children().length)
		}
	});
	$(".most_viewed").trigger("configuration", {
		items: {
			visible: ($(".most_viewed").children().length>2 ? 3 : $(".most_viewed").children().length)
		}
	});
	$(".scrolling_list_0").trigger("configuration", {
		items: {
			visible: ($(".scrolling_list_0").children().length>2 ? 3 : $(".scrolling_list_0").children().length)
		}
	});
	
	
	function windowResize()
	{
		$(".horizontal_carousel").trigger("configuration", ['debug', false, true]);
		$(".training_classes").accordion("resize");
		$(".slider").trigger('configuration', ['debug', false, true]);
		$(".image_carousel").trigger('configuration', ['debug', false, true]);
		$(".latest_tweets, .footer_recent_posts, .most_commented, .most_viewed, .scrolling_list_0").trigger('configuration', ['debug', false, true]);
		if($(".mc_gallery:not('.horizontal_carousel, .no_isotope')").length)
		{
			$(".mc_gallery:not('.horizontal_carousel, .no_isotope')").isotope({
				masonry: {
					//columnWidth: 225,
					gutterWidth: ($(".mc_gallery:not('.horizontal_carousel, .no_isotope')").width()>462 ? 30 : 12)
				},
				transformsEnabled: (config.is_rtl===1 ? false : true)
			});
		}
		if($(".photostream").length)
		{
			$(".photostream").isotope({
				masonry: {
					//columnWidth: 225,
					gutterWidth: 11
				},
				transformsEnabled: (config.is_rtl===1 ? false : true)
			});
		}
		/*var maxHeight = Math.max.apply(null, $(".timetable:visible tr td:first-child").map(function ()
		{
			return $(this).height();
		}).get());
		$(".timetable:visible tr td").css("height", maxHeight);*/
		//timetable height fix
		/*$(".timetable .event").each(function(){
			if($(this).children(".event_container").length>1)
			{
				var childrenHeight = 0;
				$(this).children(".event_container").not(":last").each(function(){
					childrenHeight += $(this).innerHeight();
				});
				var height = $(this).height()-childrenHeight-($(this).parent().parent().width()<=750 ? 9 : 22);
				if(height>$(this).children(".event_container").last().height())
					$(this).children(".event_container").last().css("height", height + "px");
			}
		});*/
	}
	//window resize
	$(window).resize(windowResize);
	window.addEventListener('orientationchange', windowResize);
	
	//scroll top
	$("a[href='#top']").click(function() {
		$("html, body").animate({scrollTop: 0}, "slow");
		return false;
	});
	
	//reply button scroll
	$(".post_content .reply_button").click(function(event){
		event.preventDefault();
		var offset = $("#comment_form").offset();
		$("html, body").animate({scrollTop: offset.top-10}, 400);
	});
	
	//hint
	$(".search input[type='text'], .comment-form textarea").hint();
	
	/*var maxHeight = Math.max.apply(null, $(".timetable:visible tr td:first-child").map(function ()
	{
		return $(this).height();
	}).get());
	$(".timetable:visible tr td").css("height", maxHeight);*/
	//timetable height fix
	/*$(".timetable .event").each(function(){
		if($(this).children(".event_container").length>1)
		{
			var childrenHeight = 0;
			$(this).children(".event_container").not(":last").each(function(){
				childrenHeight += $(this).innerHeight();
			});
			var height = $(this).height()-childrenHeight-($(this).parent().parent().width()<=750 ? 9 : 22);
			if(height>$(this).children(".event_container").last().height())
				$(this).children(".event_container").last().css("height", height + "px");
		}
	});*/
	
	//tooltip
	$(".tooltip").bind("mouseover click", function(){
		var attachTo = $(this);
		if($(this).is(".event_container"))
			attachTo = $(this).parent();
		var position = attachTo.position();
		var tooltip_text = $(this).children(".tooltip_text");
		tooltip_text.css("width", $(this).outerWidth() + "px");
		tooltip_text.css("height", tooltip_text.height() + "px");
		tooltip_text.css({"top": position.top-tooltip_text.innerHeight() + "px", "left": position.left + "px"});
	});
	
	//isotope
	$(".mc_gallery:not('.horizontal_carousel, .no_isotope')").isotope({
		masonry: {
			//columnWidth: 225,
			gutterWidth: ($(".mc_gallery:not('.horizontal_carousel, .no_isotope')").width()>462 ? 30 : 12)
		},
		transformsEnabled: (config.is_rtl===1 ? false : true)
	});
	//photostream
	$(".photostream").isotope({
		masonry: {
			//columnWidth: 225,
			gutterWidth: 11
		},
		transformsEnabled: (config.is_rtl===1 ? false : true)
	});
	//$(".timetable_isotope").isotope();
	
	//fancybox
	$(".fancybox:not(.noautoscale)").fancybox({
		'titlePosition': 'inside',
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic',
		'cyclic': 'true'
	});
	$(".fancybox.noautoscale").fancybox({
		'autoScale': false,
		'titlePosition': 'inside',
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic',
		'cyclic': 'true'
	});
	$(".fancybox-video").bind('click',function() 
	{
		$.fancybox(
		{
			'autoScale':false,
			'titlePosition': 'inside',
			'title': this.title,
			'speedIn': 600, 
			'speedOut': 200,
			'transitionIn': 'elastic',
			'width':(this.href.indexOf("vimeo")!=-1 ? 600 : 680),
			'height':(this.href.indexOf("vimeo")!=-1 ? 338 : 495),
			'href':(this.href.indexOf("vimeo")!=-1 ? this.href : this.href.replace(new RegExp("watch\\?v=", "i"), 'embed/')),
			'type':'iframe',
			'swf':
			{
				'wmode':'transparent',
				'allowfullscreen':'true'
			}
		});
		return false;
	});
	$(".fancybox-iframe").bind('click',function() 
	{
		$.fancybox(
		{
			'autoScale' : false,
			'titlePosition': 'inside',
			'title': this.title,
			'speedIn': 600, 
			'speedOut': 200,
			'transitionIn': 'elastic',
			'width' : '75%',
			'height' : '75%',
			'href': this.href,
			'type' : 'iframe'
		});
		return false;
	});
	
	//comment form, contact form
	if($(".contact_form").length)
		$(".contact_form")[0].reset();
	if($(".comment_form").length)
		$(".comment_form")[0].reset();
	$(".comment_form, .contact_form").submit(function(event){
		event.preventDefault();
		var data = $(this).serializeArray();
		var id = $(this).attr("id");
		$("#"+id+" .block").block({
			message: false,
			overlayCSS: {
				opacity:'0.3',
				"backgroundColor": "#FFF"
			}
		});
		$("#"+id+" [type='submit']").prop("disabled", true);
		$.ajax({
			url: config.ajaxurl,
			data: data,
			type: "post",
			dataType: "json",
			success: function(json){
				$("#"+id+" [name='submit'], #"+id+" [name='name'], #"+id+" [name='first_name'], #"+id+" [name='last_name'], #"+id+" [name='email'], #"+id+" [name='message']").qtip('destroy');
				if(typeof(json.isOk)!="undefined" && json.isOk)
				{
					if(typeof(json.submit_message)!="undefined" && json.submit_message!="")
					{
						$("#"+id+" [name='submit']").qtip(
						{
							style: {
								classes: 'ui-tooltip-success'
							},
							content: { 
								text: json.submit_message 
							},
							position: { 
								my: "right center",
								at: "left center" 
							}
						}).qtip('show');
						//close tooltip after 5 sec
						/*setTimeout(function(){
							$("#"+id+" [name='submit']").qtip("api").hide();
						}, 5000);*/
						if(id=="comment_form" && typeof(json.html)!="undefined")
						{
							$(".comments").html(json.html);
							$("#comment_form [name='comment_parent_id']").val(0);
							if(typeof(json.comment_id)!="undefined")
							{
								var offset = $("#comment-" + json.comment_id).offset();
								$("html, body").animate({scrollTop: offset.top-10}, 400);
								if(typeof(json.change_url)!="undefined" && $.param.fragment()!=json.change_url.replace("#", ""))
									$("#comment_form [name='prevent_scroll']").val(1);
							}
							if(typeof(json.change_url)!="undefined" && $.param.fragment()!=json.change_url.replace("#", ""))
								$.bbq.pushState(json.change_url);
								//window.location.href = json.change_url;
						}
						$("#"+id)[0].reset();
						$("#cancel_comment").css("display", "none");
						$(".contact_form [name='department']").val("");
						$(".contact_form .tabs_box_navigation_selected>span").text($(".contact_form #department_select_box_title").val()!="" ? $(".contact_form #department_select_box_title").val() : "Select department");
					}
				}
				else
				{
					if(typeof(json.submit_message)!="undefined" && json.submit_message!="")
					{
						$("#"+id+" [name='submit']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.submit_message 
							},
							position: { 
								my: "right center",
								at: "left center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_name)!="undefined" && json.error_name!="")
					{
						$("#"+id+" [name='name']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_name 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_first_name)!="undefined" && json.error_first_name!="")
					{
						$("#"+id+" [name='first_name']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_first_name 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_last_name)!="undefined" && json.error_last_name!="")
					{
						$("#"+id+" [name='last_name']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_last_name 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_email)!="undefined" && json.error_email!="")
					{
						$("#"+id+" [name='email']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_email 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_message)!="undefined" && json.error_message!="")
					{
						$("#"+id+" [name='message']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_message 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
				}
				$("#"+id).unblock();
				$("#"+id+" [type='submit']").removeProp("disabled");
			}
		});
	});
	var endYear = new Date().getFullYear();
	var startYear = endYear-120;
	$(".contact_form [name='date_of_birth']").datepicker({
		dateFormat: "mm-dd-yy",
		changeYear: true,
		yearRange: startYear + ":" + endYear
	});
	$(".closing_in").each(function(){
		var self = $(this);
		var time = parseInt(self.children(".seconds").text());
		var id = setInterval(function(){
			time--;
			self.children(".seconds").text(time);
			if(time==0)
			{
				self.parent().prev(".notification_box").fadeOut(500, function(){
					$(this).remove();
				});
				self.remove();
				clearInterval(id);
			}
		}, 1000);
	});
	menu_position = ($(".header_container.sticky").length>0 ? $(".header_container.sticky").offset().top : null );
	function animateElements()
	{
		$('.animated_element, .sticky').each(function(){
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			if($(this).hasClass("sticky"))
			{
				if(menu_position!=null)
				{
					if(menu_position<topOfWindow)
						$(this).addClass("move");
					else
						$(this).removeClass("move");
				}
			}
			else if(elementPos<topOfWindow+$(window).height()-20) 
			{
				var elementClasses = $(this).attr('class').split(' ');
				var animation = "fadeIn";
				var duration = 600;
				var delay = 0;
				for(var i=0; i<elementClasses.length; i++)
				{
					if(elementClasses[i].indexOf('animation-')!=-1)
						animation = elementClasses[i].replace('animation-', '');
					if(elementClasses[i].indexOf('duration-')!=-1)
						duration = elementClasses[i].replace('duration-', '');
					if(elementClasses[i].indexOf('delay-')!=-1)
						delay = elementClasses[i].replace('delay-', '');
				}
				$(this).addClass(animation);
				$(this).css({"animation-duration": duration + "ms"});
				$(this).css({"animation-delay": delay + "ms"});
				$(this).css({"transition-delay": delay + "ms"});
			}
		});
		$('.box_header.animation-slide, .woocommerce .box_header').each(function(){
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			if(elementPos<topOfWindow+$(window).height()-30) 
			{
				$(this).addClass("slide");
			}
		});
	}
	animateElements();
	$(window).scroll(animateElements);
	
	function refreshGoogleMap() 
	{
		if(typeof(theme_google_maps)!="undefined") 
		{		
			theme_google_maps.forEach(function(elem){
				google.maps.event.trigger(elem.map, "resize");
				elem.map.setCenter(elem.coordinate);
				elem.map.setZoom(elem.map.getZoom());
			});
		}
	}
	refreshGoogleMap();
	$(".accordion").bind("accordionactivate", function(event, ui){
		refreshGoogleMap();
	});
	$(".tabs").bind("tabsbeforeactivate", function(event, ui){
		refreshGoogleMap();
	});
	//woocommerce
	$(".woocommerce .quantity .plus").on("click", function(){
		var input = $(this).prev();
		input.val(parseInt(input.val())+1);
	});
	$(".woocommerce .quantity .minus").on("click", function(){
		var input = $(this).next();
		input.val((parseInt(input.val())-1>0 ? parseInt(input.val())-1 : 0));
	});
	$(document.body).on("added_to_cart", function(event, data){
		var sum = 0;
		$(data["div.widget_shopping_cart_content"]).find(".quantity").each(function(){
			sum += parseInt($(this).html());
		});
		if(sum>0)
			$(".cart_items_number").html(sum).css("display", "block");
	});
});