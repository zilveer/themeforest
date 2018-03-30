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
function onAfterSlide(obj)
{
	var currentSlide = obj.items.visible;
	jQuery("#" + jQuery(currentSlide).attr("id") + "_content").fadeIn();
	jQuery(".slider_navigation .more").css("display", "none");
	jQuery("#" + jQuery(currentSlide).attr("id") + "_url").css("display", "block");
}
/*function onAfterSlide(prevSlide, currentSlide)
{
	jQuery("#" + jQuery(currentSlide).attr("id") + "_content").fadeIn();
	jQuery(".slider_navigation .more").css("display", "none");
	jQuery("#" + jQuery(currentSlide).attr("id") + "_url").css("display", "block");
}*/
function onBeforeSlide()
{
	jQuery(".slider_content").fadeOut();
}
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
	$(".slider").carouFredSel({
		responsive: true,
		prev: {
			button: '#prev',
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			fx: config.slider_effect,
			easing: config.slider_transition,
			duration: parseInt(config.slider_transition_speed)
		},
		next: {
			button: '#next',
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			fx: config.slider_effect,
			easing: config.slider_transition,
			duration: parseInt(config.slider_transition_speed)
		},
		auto: {
			play: config.slider_autoplay=="true" ? true : false,
			pauseDuration: parseInt(config.slide_interval),
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			fx: config.slider_effect,
			easing: config.slider_transition,
			duration: parseInt(config.slider_transition_speed)
		}
	},
	{
		wrapper: {
			classname: "caroufredsel_wrapper caroufredsel_wrapper_slider"
		}
	});
	
	//upcoming classes
	$(".upcoming_classes").carouFredSel({
		responsive: ($(".upcoming_classes").children().length>2 ? true : false),
		direction: "up",
		items: {
			visible: 3
		},
		scroll: {
			items: 1,
			easing: "swing",
			pauseOnHover: true
		},
		prev: {
			button: function() {
				return $(this).parent().parent().parent().find('.upcoming_class_prev');
			}
		},
		next: {
			button: function() {
				return $(this).parent().parent().parent().find('.upcoming_class_next');
			}
		},
		auto: {
			play: false
		}
	});
	
	//training_classes
	$(".accordion").accordion({
		event: 'change',
		heightStyle: 'content',
		active: false
	});
	$(".accordion.wide").bind("accordionactivate", function(event, ui){
		$(window).trigger("refresh");
		$("html, body").animate({scrollTop: $("#"+$(ui.newHeader).attr("id")).offset().top}, 400);
	});
	$(".tabs").tabs({
		event: 'change',
		create: function(){
			$("html, body").scrollTop(0);
		}
	});
	
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
	
	//hashchange
	$(window).bind("hashchange", function(event){
		var hashSplit = $.param.fragment().split("-");
		if(hashSplit[0].substr(0,7)!="filter=" && hashSplit[0].substr(0,4)!="page")
		{
			$('.ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent($.param.fragment())).trigger("change");
			var hashString = "";
			for(var i=0; i<hashSplit.length-1; i++)
				hashString = hashString + hashSplit[i] + (i+1<hashSplit.length-1 ? "-" : "");
			$('.ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent(hashString)).trigger("change");
		}
		$('.tabs .ui-tabs-nav [href="#' + decodeURIComponent($.param.fragment()) + '"]').trigger("change");
		
		// get options object from hash
		var hashOptions = $.deparam.fragment();

		if(typeof(hashOptions.filter)!="undefined")
		{
			// apply options from hash
			$(".isotope_filters a").removeClass("selected");
			if($('.isotope_filters a[href="#filter='+hashOptions.filter+'"]').length)
				$('.isotope_filters a[href="#filter='+hashOptions.filter+'"]').addClass("selected");
			else
				$(".isotope_filters li:first a").addClass("selected");
			$(".theme_gallery").isotope(hashOptions);
			//$(".timetable_isotope").isotope(hashOptions);
		}
		
		if(location.hash.substr(1,7)=="comment")
		{
			if($(location.hash).length)
			{
				var offset = $(location.hash).offset();
				$("html, body").animate({scrollTop: offset.top-10}, 400);
			}
		}
		
		if(location.hash.substr(1,4)=="page")
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
					data: "action=theme_get_comments&post_id=" + $("#comment_form [name='post_id']").val() + "&paged="+parseInt(location.hash.substr(6)),
					type: "get",
					dataType: "json",
					success: function(json){
						if(typeof(json.html)!="undefined")
							$("#comments").html(json.html);
						var hashSplit = location.hash.split("/");
						var offset = null;
						if(hashSplit.length==2 && hashSplit[1]!="")
							offset = $("#" + hashSplit[1]).offset();
						else
							offset = $("#comments").offset();
						if(offset!=null)
							$("html, body").animate({scrollTop: offset.top-10}, 400);
						$("#comment_form [name='paged']").val(parseInt(location.hash.substr(6)));
					}
				});
			}
			return;
		}
		
		//open gallery details
		if(location.hash.substr(1,21)=="gallery-details-close" || typeof(hashOptions.filter)!="undefined")
		{
			$(".gallery_item_details_list").animate({height:'0'},{duration:200,easing:'easeOutQuint', complete:function(){
				$(this).css("display", "none")
				$(".gallery_item_details_list .gallery_item_details").css("display", "none");
			}
			});
		}
		else if(location.hash.substr(1,15)=="gallery-details")
		{
			var detailsBlock = $(location.hash);
			$(".gallery_item_details_list .gallery_item_details").css("display", "none");
			detailsBlock.css("display", "block");
			var galleryItem = $("#gallery-item-" + location.hash.substr(17));
			detailsBlock.find(".prev").attr("href", (galleryItem.prevAll(":not('.isotope-hidden')").first().length ? galleryItem.prevAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".theme_gallery").children(":not('.isotope-hidden')").last().find(".open_details").attr("href")));
			detailsBlock.find(".next").attr("href", (galleryItem.nextAll(":not('.isotope-hidden')").first().length ? galleryItem.nextAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".theme_gallery").children(":not('.isotope-hidden')").first().find(".open_details").attr("href")));
			var visible=parseInt($(".gallery_item_details_list").css("height"))==0 ? false : true;
			var galleryItemDetailsOffset;
			if(!visible)
			{
				$(".gallery_item_details_list").css("display", "block").animate({height:detailsBlock.height()}, 500, 'easeOutQuint', function(){
					$(this).css("height", "100%");
				});
				galleryItemDetailsOffset = $(".gallery_item_details_list").offset();
				$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-10}, 400);
			}
			else
			{
				/*$(".gallery_item_details_list").animate({height:'0'},{duration:200,easing:'easeOutQuint',complete:function() 
				{
					$(this).css("display", "none")*/
					//$(".gallery_item_details_list").css("height", "100%");
					galleryItemDetailsOffset = $(".gallery_item_details_list").offset();
					$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-10}, 400);
					/*$(".gallery_item_details_list").css("display", "block").animate({height:detailsBlock.height()},{duration:500,easing:'easeOutQuint'});
				}});*/
			}
		}
	}).trigger("hashchange");
	
	//timeago
	/*uncomment and configure timeago strings below if you need
	jQuery.timeago.settings.strings = {
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
	
	//footer recent posts, most commented, most viewed
	$(".latest_tweets, .footer_recent_posts, .most_commented, .most_viewed").carouFredSel({
		direction: "up",
		scroll: {
			items: 1,
			easing: "swing",
			pauseOnHover: true,
			height: "variable"
		},
		auto: {
			play: false
		}
	});
	$(".latest_tweets").trigger("configuration", {
		items: {
			visible: ($(".latest_tweets").children().length>2 ? 3 : $(".footer_recent_posts").children().length)
		},
		prev: {
			button: function() {
				return $(this).parent().parent().parent().find('.latest_tweets_prev');
			}
		},
		next: {
			button: function() {
				return $(this).parent().parent().parent().find('.latest_tweets_next');
			}
		}
	});
	$(".footer_recent_posts").trigger("configuration", {
		items: {
			visible: ($(".footer_recent_posts").children().length>2 ? 3 : $(".footer_recent_posts").children().length)
		},
		prev: {
			button: function() {
				return $(this).parent().parent().parent().find('.footer_recent_posts_prev');
			}
		},
		next: {
			button: function() {
				return $(this).parent().parent().parent().find('.footer_recent_posts_next');
			}
		}
	});
	$(".most_commented").trigger("configuration", {
		items: {
			visible: ($(".most_commented").children().length>2 ? 3 : $(".most_commented").children().length)
		},
		prev: {
			button: function() {
				return $(this).parent().parent().parent().find('.most_commented_prev');
			}
		},
		next: {
			button: function() {
                return $(this).parent().parent().parent().find('.most_commented_next');
			}
		}
	});
	$(".most_viewed").trigger("configuration", {
		items: {
			visible: ($(".most_viewed").children().length>2 ? 3 : $(".most_viewed").children().length)
		},
		prev: {
			button: function() {
				return $(this).parent().parent().parent().find('.most_viewed_prev');
			}
		},
		next: {
			button: function() {
				return $(this).parent().parent().parent().find('.most_viewed_next');
			}
		}
	});
	
	function windowResize()
	{
		$(".accordion").each(function(){
			var $this = $(this);
			if($this.hasClass("ui-accordion")) {
				$this.accordion("refresh");
			}
		});
		$(".slider").trigger('configuration', ['debug', false, true]);
		$(".upcoming_classes, .latest_tweets, .footer_recent_posts, .most_commented, .most_viewed").trigger('configuration', ['debug', false, true]);
	}
	//window resize
	$(window).resize(windowResize);
	window.addEventListener('orientationchange', windowResize);
	
	//scroll top
	$("a[href='#top']").click(function() {
		$("html, body").animate({scrollTop: 0}, "slow");
		return false;
	});
	
	//hint
	$(".search input[type='text'], .comment_form input[type='text'], .comment_form textarea, .contact_form input[type='text'], .contact_form textarea, .comment-form-comment textarea,.woocommerce .widget_product_search form .search-field").hint();
	
	//tooltip
	$(".tooltip").bind("mouseover click", function(){
		var position = $(this).position();
		var tooltip_text = $(this).children(".tooltip_text");
		tooltip_text.css("width", $(this).outerWidth() + "px");
		tooltip_text.css("height", tooltip_text.height() + "px");
		tooltip_text.css({"top": position.top-tooltip_text.innerHeight() + "px", "left": position.left + "px"});
	});
	
	//isotope
	$(".theme_gallery").isotope();
	//$(".timetable_isotope").isotope();
	
	//fancybox
	$(".fancybox").attr("rel", "gallery");
	$(".fancybox").fancybox({
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic'
	});
	$(".fancybox-video").bind('click',function() 
	{
		$.fancybox(
		{
			'autoScale':false,
			'speedIn': 600, 
			'speedOut': 200,
			'transitionIn': 'elastic',
			'width':(this.href.indexOf("vimeo")!=-1 ? 600 : 680),
			'height':(this.href.indexOf("vimeo")!=-1 ? 338 : 495),
			'href':(this.href.indexOf("vimeo")!=-1 ? this.href : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/')),
			'type':(this.href.indexOf("vimeo")!=-1 ? 'iframe' : 'swf'),
			'swf':
			{
				'wmode':'transparent',
				'allowfullscreen':'true'
			}
		});
		return false;
	});
	$(".fancybox-iframe").fancybox({
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic',
		'width' : '75%',
		'height' : '75%',
		'autoScale' : false,
		'titleShow': false,
		'type' : 'iframe'
	});
	
	//comment form, contact form
	$(".comment_form, .contact_form").submit(function(event){
		event.preventDefault();
		var data = $(this).serializeArray();
		var id = $(this).attr("id");
		$("#"+id+" .block").block({
			message: false,
			overlayCSS: {opacity:'0.3'}
		});
		$("#"+id+" [type='submit']").prop("disabled", true);
		$.ajax({
			url: config.ajaxurl,
			data: data,
			type: "post",
			dataType: "json",
			success: function(json){
				$("#"+id+" [name='submit'], #"+id+" [name='name'], #"+id+" [name='email'], #"+id+" [name='message']").qtip('destroy');
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
							$("#comments").html(json.html);
							$("#comment_form [name='comment_parent_id']").val(0);
							if(typeof(json.comment_id)!="undefined" && $("#comments").children().length)
							{
								var offset = $("#comment-" + json.comment_id).offset();
								$("html, body").animate({scrollTop: offset.top-10}, 400);
								if(typeof(json.change_url)!="undefined" && $.param.fragment()!=json.change_url.replace("#", ""))
									$("#comment_form [name='prevent_scroll']").val(1);
							}
							if(typeof(json.change_url)!="undefined")
								window.location.href = json.change_url;
						}
						$("#"+id)[0].reset();
						$("#cancel_comment").css("display", "none");
						$("#"+id+" [name='name'], #"+id+" [name='email'], #"+id+" [name='website'], #"+id+" [name='message']").addClass("hint");
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
				$("#"+id+" .block").unblock();
				$("#"+id+" [type='submit']").removeProp("disabled");
			}
		});
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