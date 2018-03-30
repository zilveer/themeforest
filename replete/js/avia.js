/* this prevents dom flickering, needs to be outside of dom.ready event: */
document.documentElement.className += ' js_active ';
/*end dom flickering =) */

//global path: avia_framework_globals.installedAt

jQuery.noConflict();
jQuery(document).ready(function(){

	//browser class jquery
	add_browser_class();

	//activates the mega menu javascript
	if(jQuery.fn.aviaMegamenu)
	jQuery(".main_menu .menu").aviaMegamenu({modify_position:true});

	//activates the slideshow
	if(jQuery.fn.avia_ajax_portfolio)
	jQuery('.ajax_portfolio_container').avia_ajax_portfolio();

	// actiavte portfolio sorting
	if(jQuery.fn.avia_iso_sort)
	jQuery('.portfolio-sort-container').avia_iso_sort();

	// improves comment forms
	if(jQuery.fn.kriesi_empty_input)
	jQuery('#s, #search-fail input, .textwidget input, .widget_product_search input').kriesi_empty_input();


	// improves menu for mobile devices
	jQuery('.responsive .main_menu ul:eq(0)').mobileMenu({
	  switchWidth: 768,                   							//width (in px to switch at)
	  topOptionText: jQuery('.main_menu').data('selectname'),     	//first option text
	  indentString: '- '  							//string for indenting nested items
	});

	// enhances contact form with ajax capabilities
	if(jQuery.fn.kriesi_ajax_form)
	jQuery('.ajax_form').kriesi_ajax_form();



	//smooth scrooling
	if(jQuery.fn.avia_smoothscroll)
	jQuery('a[href*="#"]').avia_smoothscroll();

	//keep ratio of elements
	if(jQuery.fn.avia_ratio)
	jQuery(".avia_keep_ratio").avia_ratio();

	//fancy buttons
	if(jQuery.fn.avia_fancy_buttons)
	jQuery(".social_bookmarks li").avia_fancy_buttons({target:'a'});

	//fixed menu header
	if(jQuery.fn.avia_fixed_header)
	jQuery("body").avia_fixed_header();


	avia_ajax_call();

	avia_slideshow_caption_click();


});






// all functions within the avia_ajax_call function will be executed once the dynamic ajax portfolio has loaded
function avia_ajax_call(container)
{
	if(typeof container == 'undefined'){ container = 'body';};

	//activates the slideshow
	if(jQuery.fn.aviapoly)
	jQuery('.slideshow', container).aviapoly();
	jQuery('#slideshow_big .slideshow, .post-entry-type-gallery .slideshow', container).avia_base_control_hide();


	//activates the slideshow
	if(jQuery.fn.avia_external_controls)
	jQuery('.slide_container_big_thumbs', container).avia_external_controls();

	//activates the keyboard controlls
	if(jQuery.fn.avia_keyboard_controls)
	jQuery('.slideshow_container', container).avia_keyboard_controls();

	//activates the prettyphoto lightbox
	if(jQuery.fn.avia_activate_lightbox)
	jQuery(container).avia_activate_lightbox();

	//activates the hover effect for image links
	if(jQuery.fn.avia_activate_hover_effect)
	jQuery(container).avia_activate_hover_effect();

	//activates the shortcode content slider
	if(jQuery.fn.avia_sc_slider)
	jQuery(".content_slider", container).avia_sc_slider({appendControlls:{}});

	//activates the toggle shortcode
	if(jQuery.fn.avia_sc_toggle)
	jQuery('.togglecontainer', container).avia_sc_toggle();

	//activates the tabs shortcode
	if(jQuery.fn.avia_sc_tabs)
	{
		jQuery('.tabcontainer', container).avia_sc_tabs();
		jQuery('.sidebar_tabcontainer', container).avia_sc_tabs({heading: '.sidebar_tab', content:'.sidebar_tab_content', active:'sidebar_active_tab', sidebar:true});
	}


	if(jQuery.fn.hoverdir && jQuery('html').is('.csstransforms'))
	{
		var checkMobile = document.documentElement.ontouchstart !== undefined ? true : false;

		if(!checkMobile)
		{
			jQuery('.slideshow li:not(#slideshow_big .slideshow li)', container).hoverdir();
		}
	}

	avia_small_fixes(container);
}


function avia_slideshow_caption_click()
{
	var body_tag = jQuery('body');

	body_tag.on('mouseenter', '.slideshow .container', function()
	{
		var container  = jQuery(this),
			link_inner = container.prev('.slideshow_media_wrap').find('a').addClass('no_overlay');

		if(link_inner.length)
		{
			container.addClass('mousePointer');
		}

	});

	body_tag.on('click', '.slideshow .container', function(e)
	{
		if(!jQuery(e.srcElement).is('a')){
		jQuery(this).prev('.slideshow_media_wrap').find('a').trigger('click');
		}
	});
}



// -------------------------------------------------------------------------------------------
// Header scroll top
// -------------------------------------------------------------------------------------------
(function($)
{
	"use strict";
	$.fn.avia_fixed_header = function(passed_options)
	{
		var win	= $(window),
			menu_header = $('.container_wrap_menu'),
			logo_header = $('.container_wrap_logo'),
			logo_header_height = 0,
			wrap_all_top = parseInt($('#wrap_all').css('margin-top'),10),
			top_pos = parseInt($('html').css('margin-top'),10) ,
			isMobile = 'ontouchstart' in document.documentElement,
			height_tracking = true,
			set_pos = function()
			{
				var st = win.scrollTop(), pos_type = menu_header.css('position');

				if(height_tracking || logo_header_height == 0) logo_header_height = logo_header.height();

				if (st < logo_header_height +wrap_all_top)
				{
					if(pos_type != 'relative') menu_header.css({position:'relative', top:0});
				}
				else
				{
					if(pos_type != 'fixed') menu_header.css({position:'fixed', top:top_pos});
				}
			};


		//dont apply fixed headers to mobile devices, because of small screen and poor handling of css "fixed" position
		if(!isMobile)
		{
			win.scroll(set_pos);
			set_pos();
			setTimeout(function(){height_tracking = false;}, 10000)
		}
	};
})(jQuery);






// -------------------------------------------------------------------------------------------
// fancy hover effect
// -------------------------------------------------------------------------------------------

(function($)
{
	"use strict";
	$.avia_utilities = $.avia_utilities || {};
	$.fn.avia_fancy_buttons = function(passed_options)
	{
		var win	= $(window),
		defaults =
		{
			target: false,
			copy_img: true
		},

		options = $.extend({}, defaults, passed_options);

		return this.each(function()
		{
			//check if the browser supports element rotation
			if(!$.avia_utilities.supports('transition', ['Khtml', 'Ms','Moz','Webkit'])) { return false; }

			var buttons = $(this),
				current	= false,
				target 	= false,
				html 	= "<span class='css_3_hover'></span>",
				effect = false;

			buttons.each(function()
			{
				current = $(this).addClass('css_3_hover_container');
				target 	= options.target ? current.find(options.target) : current;
				effect 	= $(html).appendTo(current);

				//fix the default hover color
				target.css('background-color', target.css('background-color'));

				if(options.copy_img)
				{
					effect.css('background-position', target.css('background-position'));
					effect.css('background-image', target.css('background-image'));
				}
			});

		});
	};
})(jQuery);




// -------------------------------------------------------------------------------------------
// Avia AJAX Portfolio
// -------------------------------------------------------------------------------------------

(function($)
{
	"use strict";
	$.avia_utilities = $.avia_utilities || {};

	$.fn.avia_ajax_portfolio = function(passed_options)
	{
		var win  = $(window),
		isMobile = document.documentElement.ontouchstart !== undefined ? true : false,
		defaults =
		{
			open_wrap:	'.portfolio-details',
			open_in:	'.portfolio-details-inner',
			items:		'.portfolio-sort-container',
			easing:		'easeOutQuint',
			timing:		800,
			transition:	'slide' // 'fade' or 'slide'
		},

		options = $.extend({}, defaults, passed_options);

		return this.each(function()
		{
			var container			= $(this),
				target_wrap			= container.find(options.open_wrap),
				target_container	= container.find(options.open_in),
				item_container		= container.find(options.items),
				items				= item_container.find('.post-entry'),
				content_retrieved	= {},
				is_open				= false,
				animating			= false,
				index_open			= false,
				ajax_call			= false,
				methods,
				controls,
				loader				= $.avia_utilities.loading();

			methods =
			{
				load_item: function()
				{
					if(animating == true) return false;
					animating = true;

					var link			= $(this),
						post_container	= link.parents('.post-entry:eq(0)'),
						post_id			= "ID_" + post_container.data('ajax-id'),
						clickedIndex	= items.index(post_container);

					//check if current item is the clicked item or if we are currently animating
					if(post_id === is_open)
					{
						return false;
					}

					item_container.find('.active_portfolio_item').removeClass('active_portfolio_item');
					post_container.addClass('active_portfolio_item');
					loader.show();

					methods.ajax_get_contents(post_id, clickedIndex);
					return false;
				},

				scroll_top: function()
				{
					var target_offset = container.offset().top - 100,
						window_offset = win.scrollTop();

					if(window_offset > target_offset || target_offset - window_offset > 100  )
					{
						$('html:not(:animated),body:not(:animated)').animate({ scrollTop: target_offset }, options.timing, options.easing);
					}
				},

				attach_item: function(post_id)
				{
					content_retrieved[post_id] = $(content_retrieved[post_id]).appendTo(target_container);
					ajax_call = true;
				},

				remove_video: function()
				{
					var del = container.find('iframe, .avia_video').parents('.ajax_slide:not(.open_slide)');
						if(del.length > 0)
						{
							del.remove();
							content_retrieved["ID_" + del.data('slideId')] = undefined;
						}
				},

				show_item: function(post_id, clickedIndex)
				{

					//check if current item is the clicked item or if we are currently animating
					if(post_id === is_open)
					{
						return false;
					}
					animating = true;
					methods.scroll_top();

					loader.hide();

					if(false === is_open)
					{
						target_wrap.addClass('open_container');
						content_retrieved[post_id].addClass('open_slide');
						target_wrap.css({display:'none'}).slideDown(options.timing, options.easing, function()
						{
							if(ajax_call){ avia_ajax_call(content_retrieved[post_id]); ajax_call = false; }
							methods.remove_video();
						});

							index_open	= clickedIndex;
							is_open		= post_id;
							animating	= false;

					}
					else
					{
						var initCSS = { zIndex:3 },
							easing	= options.easing;

						if(index_open > clickedIndex) { initCSS.left = '-110%'; }
						if(options.transition === 'fade'){ initCSS.left = '0%'; initCSS.opacity = 0; easing = 'easeOutQuad'; }

						//fixate height for container during animation
						target_container.height(target_container.height()); //outerHeight = border problems?

						content_retrieved[post_id].css(initCSS).avia_animate({'left':"0%", opacity:1}, options.timing, easing);
						content_retrieved[is_open].avia_animate({opacity:0}, options.timing, easing, function()
						{
							content_retrieved[is_open].attr({'style':""}).removeClass('open_slide');
							content_retrieved[post_id].addClass('open_slide');

							target_container.avia_animate({height: content_retrieved[post_id].outerHeight()}, options.timing/2, options.easing, function()
							{
								target_container.attr({'style':""});
								is_open		= post_id;
								index_open	= clickedIndex;
								animating	= false;

								methods.remove_video();
								if(ajax_call){ avia_ajax_call(content_retrieved[post_id]); ajax_call = false; }

							});

						});
					}
				},

				ajax_get_contents: function(post_id, clickedIndex)
				{
					if(content_retrieved[post_id] !== undefined)
					{
						methods.show_item(post_id, clickedIndex);
						return;
					}

					var url_params = methods.getUrlVars(), add_params = "";
					if(typeof url_params.style == "string") add_params = "&style=" + url_params.style


					$.ajax({
						url: avia_framework_globals.ajaxurl,
						type: "POST",
						data: "action=avia_check_portfolio&avia_ajax_request="+post_id.replace(/ID_/,"")+add_params,
						beforeSend: function()
						{

						},
						success: function(msg)
						{
							content_retrieved[post_id] = msg;
							methods.attach_item(post_id);
							setTimeout(function(){ methods.show_item(post_id, clickedIndex); },10);
						},
						error: function()
						{
							loader.hide();
						}
					});
				},

				add_controls: function()
				{
					controls = $('<div class="ajax_controlls"><a href="#prev" class="ajax_previous">-</a><a href="#next" class="ajax_next">+</a><a class="avia_close" href="#close">x</a></div>').appendTo(target_wrap);

					target_wrap.avia_keyboard_controls({27:'.avia_close', 37:'.ajax_previous', 39:'.ajax_next'});
					//target_wrap.avia_swipe_trigger({prev:'.ajax_previous', next:'.ajax_next'});

					items.each(function(){

						var current = $(this), overlay;

						current.addClass('no_combo').bind('click', function(event)
						{
							overlay = current.find('.slideshow_overlay');

							if(overlay.length)
							{
								event.stopPropagation();
								methods.load_item.apply(current.find('a:eq(0)'));
								return false;
							}
						});


					});
				},

				control_click: function()
				{
					var showItem,
						activeID = item_container.find('.active_portfolio_item').data('ajax-id'),
						active   = item_container.find('.post-entry-'+activeID);

					switch(this.hash)
					{
						case '#next':

							showItem = active.nextAll('.post-entry:not(.isotope-hidden):eq(0)').find('a:eq(0)');
							if(!showItem.length) { showItem = $('.post-entry:not(.isotope-hidden):eq(0)', container).find('a:eq(0)'); }
							showItem.trigger('click');

						break;
						case '#prev':

							showItem = active.prevAll('.post-entry:not(.isotope-hidden):eq(0)').find('a:eq(0)');
							if(!showItem.length) { showItem = $('.post-entry:not(.isotope-hidden):last', container).find('a:eq(0)'); }
							showItem.trigger('click');

						break;
						case '#close':

							animating = true;

							target_wrap.slideUp( options.timing, options.easing, function()
							{
								item_container.find('.active_portfolio_item').removeClass('active_portfolio_item');
								content_retrieved[is_open].attr({'style':""}).removeClass('open_slide');
								target_wrap.removeClass('open_container');
								animating = is_open = index_open = false;
								methods.remove_video();
							});

						break;
					}
					return false;
				},

				getUrlVars: function() {
				    var vars = {};
				    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
				        vars[key] = value;
				    });
				    return vars;
				},

				resize_reset: function()
				{
					if(is_open === false)
					{
						target_container.html('');
						content_retrieved	= [];
					}
				}
			};

			methods.add_controls();

			item_container.on("click", "a", methods.load_item);
			controls.on("click", "a", methods.control_click);
			if(jQuery.support.leadingWhitespace) { win.bind('smartresize', methods.resize_reset); }

		});
	};
}(jQuery));





// -------------------------------------------------------------------------------------------
// Avia AJAX Sorting
// -------------------------------------------------------------------------------------------

(function($)
{
	"use strict";

	$.fn.avia_iso_sort = function(options)
	{

		$.extend( $.Isotope.prototype, {
		  _customModeReset : function() {

		  	this.fitRows = {
		        x : 0,
		        y : 0,
		        height : 0
		      };

		   },
		  _customModeLayout : function( $elems ) {

		    var instance		= this,
		        containerWidth	= this.element.width(),
		        props			= this.fitRows,
		        margin			= 0,//(containerWidth / 100) * 4, //margin based on %
		        extraRange		= 2; // adds a little range for % based calculation error in some browsers

		      $elems.each( function() {
		        var $this = $(this),
		            atomW = $this.outerWidth() ,
		            atomH = $this.outerHeight(true);

		        if ( props.x !== 0 && atomW + props.x > containerWidth + extraRange ) {
		          // if this element cannot fit in the current row
		          props.x = 0;
		          props.y = props.height;
		        }

		     	//webkit gets blurry elements if position is a float value
		     	props.x = Math.round(props.x);
		     	props.y = Math.round(props.y);

		        // position the atom
		        instance._pushPosition( $this, props.x, props.y );

		        props.height = Math.max( props.y + atomH, props.height );
		        props.x += atomW + margin;


		      });

		  },
		  _customModeGetContainerSize : function() {

		  	return { height : this.fitRows.height };

		  },
		  _customModeResizeChanged : function() {

		  	return true;

		   }
		});


		return this.each(function()
		{

			var container		= $(this),
				parentContainer	= container.parents('.portfolio-wrap'),
				filter			= parentContainer.prev('.sort_width_container').find('#js_sort_items').css({visibility:"visible", opacity:0}),
				links			= filter.find('a'),
				isoActive		= false,
				items			= $('.post-entry', container);

			function applyIso()
			{
				container.addClass('isotope_activated').isotope({
					layoutMode : 'customMode', itemSelector : '.flex_column'
				}, function()
				{
					container.css({overflow:'visible'});
				});

				isoActive = true;
				setTimeout(function(){ parentContainer.addClass('avia_sortable_active'); }, 0);
			};

			links.bind('click',function()
			{
				var current		= $(this),
			  		selector	= current.data('filter');
					links.removeClass('active_sort');
					current.addClass('active_sort');

					parentContainer.find('.open_container .ajax_controlls .avia_close').trigger('click');
					container.css({overflow:'hidden'}).isotope({ layoutMode : 'customMode', itemSelector : '.flex_column' , filter: '.'+selector}, function()
					{
						container.css({overflow:'visible'});
					});

					return false;
			});

			// update columnWidth on window resize
			$(window).smartresize(function()
			{
			  	applyIso();
			});

			$(window).bind('avia_images_loaded', function()
			{
				setTimeout(function()
				{
					filter.animate({opacity:1}, 400);
					applyIso();

				}, 900);


			});
			///applyIso();
		});
	};
}(jQuery));






// -------------------------------------------------------------------------------------------
// input field improvements
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.kriesi_empty_input = function(options)
	{
		return this.each(function()
		{
			var currentField = $(this);
			currentField.methods =
			{
				startingValue:  currentField.val(),

				resetValue: function()
				{
					var currentValue = currentField.val();
					if(currentField.methods.startingValue == currentValue) currentField.val('');
				},

				restoreValue: function()
				{
					var currentValue = currentField.val();
					if(currentValue == '') currentField.val(currentField.methods.startingValue);
				}
			};

			currentField.bind('focus',currentField.methods.resetValue);
			currentField.bind('blur',currentField.methods.restoreValue);
		});
	};
})(jQuery);



// -------------------------------------------------------------------------------------------
// Ratio function
// -------------------------------------------------------------------------------------------

(function($)
{

	"use strict";
	$.fn.avia_ratio = function()
	{
		var win	= $(window);

		return this.each(function()
		{
			//check if the browser supports element rotation
			var container 	= $(this),
				height		= container.height(),
				width		= container.data('imgw'),
				ratio 		=  height/width;

				function change_ratio()
				{
					container.height(container.outerWidth() * ratio);
				}

				change_ratio();
				win.bind('smartresize', change_ratio);

		});
	};
})(jQuery);



// -------------------------------------------------------------------------------------------
// Avia Menu
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.aviaMegamenu = function(variables)
	{
		var defaults =
		{
			modify_position:true,
			delay:300
		};

		var options = $.extend(defaults, variables);

		return this.each(function()
		{
			var isMobile 	= 'ontouchstart' in document.documentElement,
				menu = $(this),
				menuItems = menu.find(">li"),
				megaItems = menuItems.find(">div").parent().css({overflow:'hidden'}),
				menuActive = menu.find('>.current-menu-item>a, >.current_page_item>a'),
				dropdownItems = menuItems.find(">ul").parent(),
				parentContainerWidth = menu.parent().width(),
				delayCheck = {},
				mega_open = [];

			if(!menuActive.length){ menu.find('.current-menu-ancestor:eq(0) a:eq(0), .current_page_ancestor:eq(0) a:eq(0)').parent().addClass('active-parent-item')}

			menuItems.each(function()
			{
				var item = $(this),
					pos = item.position(),
					megaDiv = item.find("div:first").css({opacity:0, display:"none"}),
					normalDropdown = "";

				//check if we got a mega menu
				if(!megaDiv.length)
				{
					normalDropdown = item.find(">ul").css({display:"none"});
				}

				//if we got a mega menu or dropdown menu add the arrow beside the menu item
				if(megaDiv.length || normalDropdown.length)
				{
					var link = item.addClass('dropdown_ul_available').find('>a');
					link.html("<span class='dropdown_link'>"+link.html()+"</span>").append('<span class="dropdown_available"></span>');

					//is a mega menu main item doesnt have a link to click use the default cursor
					if(typeof link.attr('href') != 'string' || link.attr('href') == "#"){ link.css('cursor','default').click(function(){return false;}); }
				}

				//correct position of mega menus
				if(options.modify_position && megaDiv.length)
				{
					if(megaDiv.width() > pos.left)
					{
						megaDiv.css({left: (pos.left* -1)});
						//megaDiv.css({left: (Math.ceil() * -1)});
					}
					else if(pos.left + megaDiv.width() > parentContainerWidth)
					{
						megaDiv.css({left: (megaDiv.width() - pos.left) * -1 });
					}
				}

			});


			function megaDivShow(i)
			{
				if(delayCheck[i] == true)
				{
					var item = megaItems.filter(':eq('+i+')').css({overflow:'visible'}).find("div:first"),
						link = megaItems.filter(':eq('+i+')').find("a:first");
						mega_open["check"+i] = true;

						item.stop().css('display','block').animate({opacity:1},300);

						if(item.length)
						{
							link.addClass('open-mega-a');
						}
				}
			}

			function megaDivHide (i)
			{
				if(delayCheck[i] == false)
				{
					megaItems.filter(':eq('+i+')').find(">a").removeClass('open-mega-a');

					var listItem = megaItems.filter(':eq('+i+')'),
						item = listItem.find("div:first");


					item.stop().css('display','block').animate({opacity:0},300, function()
					{
						$(this).css('display','none');
						listItem.css({overflow:'hidden'});
						mega_open["check"+i] = false;
					});
				}
			}

			if(isMobile)
			{
				megaItems.each(function(i){

					$(this).bind('click', function()
					{
						if(mega_open["check"+i] != true) return false;
					});
				});
			}


			//bind event for mega menu
			megaItems.each(function(i){

				$(this).hover(

					function()
					{
						delayCheck[i] = true;
						setTimeout(function(){megaDivShow(i); },options.delay);
					},

					function()
					{
						delayCheck[i] = false;
						setTimeout(function(){megaDivHide(i); },options.delay);
					}
				);
			});


			// bind events for dropdown menu
			dropdownItems.find('li').andSelf().each(function()
			{
				var currentItem = $(this),
					sublist = currentItem.find('ul:first'),
					showList = false;

				if(sublist.length)
				{
					sublist.css({display:'block', opacity:0, visibility:'hidden'});
					var currentLink = currentItem.find('>a');

					currentLink.bind('mouseenter', function()
					{
						sublist.stop().css({visibility:'visible'}).animate({opacity:1});
					});

					currentItem.bind('mouseleave', function()
					{
						sublist.stop().animate({opacity:0}, function()
						{
							sublist.css({visibility:'hidden'});
						});
					});

				}

			});

		});
	};
})(jQuery);








// -------------------------------------------------------------------------------------------
// Tab shortcode javascript
// -------------------------------------------------------------------------------------------
(function($)
{
	"use strict"

	$.fn.avia_sc_tabs= function(options)
	{
		var defaults =
		{
			heading: '.tab',
			content:'.tab_content',
			active:'active_tab',
			sidebar: false
		};

		var win = $(window)
			options = $.extend(defaults, options);

		return this.each(function()
		{
			var container = $(this),
				tabs = $(options.heading, container),
				content = $(options.content, container),
				initialOpen = 1,
				newtabs = false,
				oldtabs = false;

			// sort tabs

			if(tabs.length < 2) return;

			if(container.is('.tab_initial_open'))
			{
				var myRegexp = /tab_initial_open__(\d+)/;
				var match = myRegexp.exec(container[0].className);

				if(match != null && parseInt(match[1]) > 0)
				{
					initialOpen = parseInt(match[1]);
				}
			}

			if(!initialOpen || initialOpen > tabs.length) initialOpen = 1;

			if(!options.sidebar)
			{
				tabs.prependTo(container);
			}
			else
			{
				var click_container = $("<div class='sidebar_tab_wrap'></div>").prependTo(container), min_height;

				newtabs = tabs.clone();
				oldtabs = tabs;
				tabs = newtabs;
				tabs.prependTo(click_container);
				var sidebar_shadow = $("<span class='sidebar_tab_shadow'></span>").prependTo(click_container);
				set_size(click_container, sidebar_shadow);

				win.smartresize(function(){ set_size(click_container, sidebar_shadow); });
			}

			tabs.each(function(i)
			{
				var tab = $(this), the_oldtab = false;

				if(newtabs) the_oldtab = oldtabs.filter(':eq('+i+')');

				//set default tab to open
				if(initialOpen == (i+1))
				{
					open_content(tab, i, the_oldtab);

				}

				tab.addClass('tab_counter_'+i).bind('click', function()
				{
					open_content(tab, i, the_oldtab);
					return false;
				});

				if(newtabs)
				{

					the_oldtab.bind('click', function()
					{
						open_content(the_oldtab, i, tab);
						return false;
					});
				}
			});

			function set_size(click_container, sidebar_shadow)
			{
				min_height = click_container.outerHeight();
				content.css({'min-height': ( min_height - parseInt(content.css('padding-top'),10) - parseInt(content.css('padding-bottom'),10) - parseInt(content.css('border-top-width'),10) - parseInt(content.css('border-bottom-width'),10) ) });
				sidebar_shadow.height(content.filter('.'+options.active+'_content').outerHeight());
			}


			function open_content(tab, i, alternate_tab)
			{
				if(!tab.is('.'+options.active))
				{
					$('.'+options.active, container).removeClass(options.active);
					$('.'+options.active+'_content', container).removeClass(options.active+'_content');

					tab.addClass(options.active);
					setTimeout(function(){avia_small_fixes($('.'+options.active+'_content', container));},10);

					if(alternate_tab) alternate_tab.addClass(options.active);
					var active_c = content.filter(':eq('+i+')').addClass(options.active+'_content');

					if(typeof click_container != 'undefined' && click_container.length)
					{
						sidebar_shadow.height(active_c.outerHeight());
					}
				}
			}

		});
	};
})(jQuery);


// -------------------------------------------------------------------------------------------
// Toggle shortcode javascript
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_sc_toggle = function(options)
	{
		var defaults =
		{
			heading: '.toggler',
			content: '.toggle_wrap'
		};

		var options = $.extend(defaults, options);

		return this.each(function()
		{
			var container = $(this),
				heading   = $(options.heading, container),
				allContent = $(options.content, container),
				initialOpen = '';

			//check if the container has the class toggle initial open.
			// if thats the case extract the number from the following class and open that toggle
			if(container.is('.toggle_initial_open'))
			{
				var myRegexp = /toggle_initial_open__(\d+)/;
				var match = myRegexp.exec(container[0].className);

				if(match != null && parseInt(match[1]) > 0)
				{
					initialOpen = parseInt(match[1]);
				}
			}

			heading.each(function(i)
			{
				var thisheading =  $(this),
					content = thisheading.next(options.content, container);

				if(initialOpen == (i+1)) { content.css({display:'block'}); setTimeout(function(){avia_small_fixes(content);},10); }


				if(content.is(':visible'))
				{
					thisheading.addClass('activeTitle');
				}

				thisheading.bind('click', function()
				{
					if(content.is(':visible'))
					{
						content.slideUp(300);
						thisheading.removeClass('activeTitle');

					}
					else
					{
						if(container.is('.toggle_close_all'))
						{
							allContent.slideUp(300);
							heading.removeClass('activeTitle');
						}
						content.slideDown(300);
						thisheading.addClass('activeTitle');
						avia_small_fixes(content);
					}
				});
			});
		});
	};
})(jQuery);




// -------------------------------------------------------------------------------------------
// Smooth scrooling when clicking on anchor links
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_smoothscroll = function(variables)
	{
		return this.each(function()
		{
			$(this).click(function() {

			   var newHash=this.hash;

			   if(newHash != '' && newHash != '#' && !$(this).is('.comment-reply-link, #cancel-comment-reply-link, .no-scroll'))
			   {
				   var container = $(this.hash);

				   if(container.length)
				   {
					   var target = container.offset().top,
						   oldLocation=window.location.href.replace(window.location.hash, ''),
						   newLocation=this,
						   duration=800,
						   easing='easeOutQuint';

					   // make sure it's the same location
					   if(oldLocation+newHash==newLocation)
					   {
					      // animate to target and set the hash to the window.location after the animation
					      $('html:not(:animated),body:not(:animated)').animate({ scrollTop: target }, duration, easing, function() {

					         // add new hash to the browser location
					         window.location.href=newLocation;
					      });

					      // cancel default click action
					      return false;
					   }
					}
				}
			});
		});
	};
})(jQuery);





// -------------------------------------------------------------------------------------------
// Ligthbox activation
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_activate_lightbox = function(variables)
	{
		var defaults =
		{
			autolinkElements: 'a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"] , a[href*="screenr.com"]'
		};

		var options 	= $.extend(defaults, variables),
			win		    = $(window),
			ww			= parseInt(win.width(),10) * 0.8, 	//controls the default lightbox width: 80% of the window size
			wh 			= (ww/16)*9;						//controls the default lightbox height (16:9 ration for videos. images are resized by the lightbox anyway)


		return this.each(function()
		{
			var elements = $(options.autolinkElements, this).not('.noLightbox, .noLightbox a'),
				lastParent = "",
				counter = 0;

			elements.each(function()
			{
				var el = $(this),
					parentPost = el.parents('.post-entry:eq(0)'),
					group = 'auto_group';

				if(parentPost.get(0) != lastParent)
				{
					lastParent = parentPost.get(0);
					counter ++;
				}

				if((el.attr('rel') == undefined || el.attr('rel') == '') && !el.hasClass('noLightbox'))
				{
					el.attr('rel','lightbox['+group+counter+']');
				}
			});

			if($.fn.prettyPhoto)
			elements.prettyPhoto({ social_tools:'',slideshow: 5000, deeplinking: false, overlay_gallery:false, default_width: ww, default_height: wh });
		});
	};
})(jQuery);




// -------------------------------------------------------------------------------------------
// Hover effect activation
// -------------------------------------------------------------------------------------------


(function($)
{
	$.fn.avia_activate_hover_effect = function(variables)
	{
		var defaults =
		{
			autolinkElements: 'a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"], a.external-link, .avia_mega a, .dynamic_template_columns a, .slideshow a'
		};

		var options = $.extend(defaults, variables), css3 = $('html').is('.csstransforms'), opacity_val = 0.8;

		return this.each(function()
		{
			if(css3)
			{
				opacity_val = 1;
			}

			$(options.autolinkElements, this).not(".noLightbox a").contents('img:not(.filtered-image)').each(function()
			{
				var img = $(this),
					a = img.parent(),
					preload = img.parents('.preloading'),
					$newclass = 'lightbox_video',
					applied= false;


				if(a.attr('href').match(/(jpg|gif|jpeg|png|tif)/))
				{
					$newclass = 'lightbox_image';
				}

				if(a.is('.external-link') || ! a.attr('href').match(/(jpg|gif|jpeg|png|\.tif|\.mov|\.swf|vimeo\.com|youtube\.com)/))
				{
					$newclass = 'external_image';
				}

				if(a.is('a'))
				{
					if(img.is('.alignright')) {img.removeClass('alignright'); a.addClass('alignright')}
					if(img.is('.alignleft')) {img.removeClass('alignleft'); a.addClass('alignleft')}
					if(img.css('float') == 'left' || img.css('float') == 'right') {a.css({float:img.css('float')})}
					if(!a.css('position') || a.css('position') == 'static') { a.css({position:'relative', display:'inline-block'}); }
					if(img.is('.aligncenter')) a.css({display:'block'});
					if(img.is('.avia_mega img')) a.css({position:'relative', display:'inline-block'});
					if(img.css('left')) { a.css({left: img.css('left')}); img.css('left', 0); }
				}

				var bg = $("<span class='image_overlay_effect'><span class='image_overlay_effect_inside'></span></span>").appendTo(a);
					bg.css({display:'block', zIndex:5, opacity:0});


				bg.hover(function()
				{
					if(applied == false && img.css('opacity') > 0.5)
					{
						bg.addClass($newclass);
						applied = true;
					}

					bg.stop().animate({opacity:opacity_val},400);
				},
				function()
				{
					bg.stop().animate({opacity:0},400);
				});



			});
		});
	};
})(jQuery);











// -------------------------------------------------------------------------------------------
// small js fixes for pixel perfection :)
// -------------------------------------------------------------------------------------------
function avia_small_fixes(container)
{
	if(!jQuery.support.opacity)
	{
		jQuery('.image_overlay_effect', container).css({'background-image':'none'});
	}

	if(jQuery('#slideshow_big').length) { jQuery('body').addClass('js-big-slider'); } else { jQuery('body').addClass('js-big-slider-false'); }


	setTimeout(function()
	{
		jQuery('.twitter-tweet-rendered', container).attr('style',"");
	}, 500);

	var win		= jQuery(window),
		iframes = jQuery(' iframe:not(.slideshow iframe):not( iframe.no_resize):not(ins iframe)', container),
		adjust_iframes = function()
		{
			iframes.each(function(){

				var iframe = jQuery(this), frame_parent_w = iframe.parent().width(), proportions = 16/9;

				if(this.width && this.height)
				{
					proportions = Math.round(this.width / this.height * 1000) / 1000;
					iframes.css({width:frame_parent_w, height: frame_parent_w / proportions});
				}

			});
		};

		adjust_iframes();
		win.smartresize(adjust_iframes);

}







// -------------------------------------------------------------------------------------------
// content slider
// -------------------------------------------------------------------------------------------

(function($)
{
	$.avia_utilities = $.avia_utilities || {};
	$.fn.avia_sc_slider = function(variables, callback)
	{

		return this.each(function()
		{
			var defaults =
			{
				slidePadding: 40,
				appendControlls: {'h1':'pos_h1', 'h2':'pos_h2', 'h3':'pos_h3', 'h4':'pos_h4', 'h5':'pos_h5', 'h6':'pos_h6'},
				controllContainerClass: 'contentSlideControlls',
				transitionDuration: 800,								//how fast should images crossfade
				autorotation: true,										//autorotation true or false? (this setting gets overwritten by the class autoslide_true and autoslide_false if applied to the container. easier for shortcode management)
				autorotationInterval: 3000,								//interval between transition if autorotation is active ()also gets overwritten by autoslidedelay__(number)
				transitionEasing: 'easeOutQuint',
				slide: '.single_slide',
				group: false,
				arrowControll:false
			};

			var options = $.extend(defaults, variables);

			var container 	= $(this).css({overflow:'hidden'}),
				optionWrap 	= container.parent(':eq(0)'),
				slides 		= $(options.slide, container),
				isMobile 	= 'ontouchstart' in document.documentElement;

			if(!slides.length) { return false; }

			if(optionWrap.data('interval')){ options.autorotationInterval = optionWrap.data('interval') * 1000;}
			if(optionWrap.data('interval') === 0) options.autorotation = false;

			if(options.group)
			{
				var container_new = $('<div>').addClass(container.attr('class')).css({overflow:'hidden', width:'100%', position:'relative'}).insertAfter(container),
					start = 0,
					end  = slides.index(slides.filter('.last:eq(0)'));

				if(end === -1) end = slides.length;

				var columns = end + 1,
					elements = slides.length,
					subgroup = {};

				slides.appendTo(container_new);

				for (i = 0; i <= elements; i += columns)
				{

					subgroup = slides.slice(i, i + columns);
					if(subgroup.length)
					{
						subgroup.wrapAll('<div class="single_slide"></div>');
					}
				}

				slides.each(function()
				{
					var current = $(this);
					current.find('>*').wrapAll('<div class="'+current.attr('class')+'"></div>');
					current.find('>div:eq(0)').insertAfter(current);
				});

				//reset values
				slides.remove();
				container.remove();
				container = container_new;
				options.slide = '.single_slide';
				slides = $(options.slide, container);
			}


			var slideCount = slides.length,
				firstSlide = slides.filter(':eq(0)'),
				followslides = $(options.slide+':not(:first)', container),
				innerContainer = "",
				innerContainerWidth = (container.width() * slideCount) + (options.slidePadding * slideCount),
				i = 0,
				interval = "",
				controlls = $(),
				arrowControlls = $(),
				nextArrow,
				prevArrow;


			container.animating  = false;
			container.methods =
			{
				resize: function()
				{
					if(!innerContainer) return;

					innerContainerWidth = (container.width() * slideCount) + (options.slidePadding * slideCount);
					innerContainer.width(innerContainerWidth);
					slides.width(container.width());
					container.methods.change();
				},

				preload: function()
				{
					followslides.css({display:"none"});

					if(!slideCount)
					{
						container.methods.init();
					}
					else
					{
						$.avia_utilities.preload({container: container, single_callback:  function(){ container.methods.init(); }});
					}
				},

				init: function()
				{

					if(slideCount > 1)
					{
						$(window).resize(container.methods.resize);

						//set container height to match the first slide
						container.height(firstSlide.outerHeight());

						//wrap additional container arround slides and align slides within that container
						slides.wrapAll('<div class="inner_slide_container" />').css({float:'left',
																					 width:container.width(),
																					 display:'block',
																					 paddingRight:options.slidePadding
																					 });

						innerContainer = $('.inner_slide_container', container).width(innerContainerWidth);

						//attach controll elements
						container.methods.appenControlls();

						//start autoslide
						container.methods.autoRotation();

						//start autoslide
						//container.methods.activate_touch_control();


					}
					container.addClass('not_animating_slides');
					slides.filter(':eq(0)').addClass('active_slide');

				},

				change: function()
				{
					container.animating = true;
					container.removeClass('not_animating_slides');


					var moveTo	 		= ((-i * container.width()) - (i * options.slidePadding)),
						nextSlide		= slides.removeClass('active_slide').filter(':eq('+i+')'),
						nextSlideHeight = nextSlide.outerHeight();

					//move inner container
					innerContainer.stop().animate({left: moveTo}, options.transitionDuration, options.transitionEasing, function()
					{
						container.animating = false;
						setTimeout(function(){
							container.addClass('not_animating_slides');
						},10);

						nextSlide.addClass('active_slide');

					});

					//change height of outer container
					container.stop().animate({height: nextSlideHeight}, options.transitionDuration, options.transitionEasing);

					//change active state of controlls
					var controllLinks = $('a', controlls);
					controllLinks.removeClass('activeItem');
					controllLinks.filter(':eq('+i+')').addClass('activeItem');
				},

				activate_touch_control:function()
				{
					var slider = container;

					if(isMobile)
					{
						slider.touchPos = {};
						slider.hasMoved = false;

						slider.bind('touchstart', function(event)
						{
							slider.touchPos.X = event.originalEvent.touches[0].clientX;
							slider.touchPos.Y = event.originalEvent.touches[0].clientY;

						});

						slider.bind('touchend', function(event)
						{
							slider.touchPos = {};
			                if(slider.hasMoved) { event.preventDefault(); }
			                slider.hasMoved = false;
						});

						slider.bind('touchmove', function(event)
						{
							if(!slider.touchPos.X)
							{
								slider.touchPos.X = event.originalEvent.touches[0].clientX;
								slider.touchPos.Y = event.originalEvent.touches[0].clientY;
							}
							else
							{
								var differenceX = event.originalEvent.touches[0].clientX - slider.touchPos.X;
								var differenceY = event.originalEvent.touches[0].clientY - slider.touchPos.Y;

								//check if user is scrolling the window or moving the slider
								if(Math.abs(differenceX) > Math.abs(differenceY))
								{
									event.preventDefault();

									if(!slider.animating)
									{
										if(slider.touchPos != event.originalEvent.touches[0].clientX)
										{
											if(Math.abs(differenceX) > 50)
											{
												i = differenceX > 0 ? i - 1 : i + 1;

												if(i+1 > slideCount) { i = 0; } else
												if(i < 0) {i = slideCount-1; }

												clearInterval(interval);
												container.methods.change();
												slider.touchPos = {};
												slider.hasMoved = true;
												return false;
						                	}
						                }

					                }
				                }
			                }
		            	});
					}

				},

				setSlideNumber: function(event)
				{
					var stop = false;

					if(event)
					{
						clearInterval(interval);

						if(event.data.show == 'next') i++;
						if(event.data.show == 'prev') i--;
						if(typeof(event.data.show) == 'number')
						{
							//check if next slide is the same as current slide
							if(i != event.data.show)
							{
								i = event.data.show;
							}
							else
							{
								stop = true;
							}
						}
					}
					else
					{
						i++;
					}

					if(i+1 > slideCount) { i = 0; } else
					if(i < 0) {i = slideCount-1; }

					if(!stop) // prevents transition if the next slide and the current slide are the same
					{
					    container.methods.change();
					}



					return false;
				},

				appenControlls: function()
				{
					//if controlls should be added by javascript and we got more than 1 slide
					if(options.appendControlls && slideCount > 1)
					{
						//check where to position the controll element, depending on the first element within the slide
						var positioningClass = '';

						for (var key in options.appendControlls)
						{
							if(!positioningClass)
							{
								if($(':first', firstSlide).is(key))
								{
									positioningClass = options.appendControlls[key];
								}

							}
						}


						//append the controlls
						var firstClass = 'class="activeItem"';

						controlls = $('<div></div>').addClass(options.controllContainerClass)
													.addClass(positioningClass)
													.css({visibility:'hidden', opacity:0});

							if(positioningClass)
							{
								controlls.appendTo(container);
							}
							else
							{
								controlls.insertAfter(container);
							}

						slides.each(function(i)
						{
							var link = $('<a '+firstClass+' href="#">'+(i+1)+'</a>').appendTo(controlls); firstClass = "";
								link.bind('click', {show: i}, container.methods.setSlideNumber);
						});

						controlls.css({visibility:'visible', opacity:0}).animate({opacity:0.7},400);
					}

					//add arrow Controlls
					if(options.arrowControll && slideCount > 1)
					{
						arrowControlls = $('<div class="arrow_container"></div>');
						nextArrow = $('<a class="arrow_controll arrow_controll_next" href="#next">+</a>').appendTo(arrowControlls).bind('click', {show: 'next'}, container.methods.setSlideNumber).css({visibility:'visible', opacity:0});
						prevArrow = $('<a class="arrow_controll arrow_controll_prev" href="#prev">-</a>').appendTo(arrowControlls).bind('click', {show: 'prev'}, container.methods.setSlideNumber).css({visibility:'visible', opacity:0});
					}

					if(positioningClass)
					{
						arrowControlls.appendTo(container);
					}
					else
					{
						arrowControlls.insertAfter(container);
					}

					if(!isMobile)
					{
						arrowControlls.parent().hover(function()
						{
							prevArrow.stop().animate({opacity:0.7},400);
							nextArrow.stop().animate({opacity:0.7},400);
						},
						function()
						{
							prevArrow.stop().animate({opacity:0},400)
							nextArrow.stop().animate({opacity:0},400)
						});
					}


				},

				autoRotation: function()
				{

					if(container.is('.autoslide_true'))
					{
						options.autorotation = true;

					var myRegexp = /autoslidedelay__(\d+)/g;
					var match = myRegexp.exec(container[0].className);

					if(parseInt(match[1]) > 0)
					{
						options.autorotationInterval = parseInt(match[1]) * 1000;
					}



					}
					else if(container.is('.autoslide_false'))
					{
						options.autorotation = false;
					}


					if(options.autorotation)
					{
						interval = setInterval(function()
						{
							container.methods.setSlideNumber();
						},
						options.autorotationInterval);
					}
				}
			};


			container.methods.preload();

		});
	};
})(jQuery);








// -------------------------------------------------------------------------------------------
// contact form ajax improvements
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.kriesi_ajax_form = function(variables)
	{
		var defaults =
		{
			sendPath: 'send.php',
			responseContainer: '#ajaxresponse'
		};

		var options = $.extend(defaults, variables);

		return this.each(function()
		{
			var form = $(this),
				form_sent = false,
				send =
				{
					formElements: form.find('textarea, select, input[type=text], input[type=checkbox], input[type=hidden]'),
					validationError:false,
					button : form.find('input:submit'),
					dataObj : {}
				};

			responseContainer = $(options.responseContainer+":eq(0)");

			send.button.bind('click', checkElements);

			function send_ajax_form()
			{
				if(form_sent){ return false; }

				form_sent = true;
				send.button.fadeOut(300);

				responseContainer.load(form.attr('action')+' '+options.responseContainer, send.dataObj, function()
				{
					responseContainer.find('.hidden').css({display:"block"});
					form.slideUp(400, function(){responseContainer.slideDown(400); send.formElements.val('');});
				});


			}

			function checkElements()
			{
				// reset validation var and send data
				send.validationError = false;
				send.datastring = 'ajax=true';

				send.formElements.each(function(i)
				{
					var currentElement = $(this),
						surroundingElement = currentElement.parent(),
						value = currentElement.val(),
						name = currentElement.attr('name'),
					 	classes = currentElement.attr('class'),
					 	nomatch = true;

					 	if(currentElement.is(':checkbox'))
					 	{
					 		if(currentElement.is(':checked')) { value = true } else {value = ''}
					 	}

					 	send.dataObj[name] = encodeURIComponent(value);

					 	if(classes && classes.match(/is_empty/))
						{
							if(value == '')
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}
							nomatch = false;
						}

						if(classes && classes.match(/is_email/))
						{
							if(!value.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/))
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}
							nomatch = false;
						}

						if(classes && classes.match(/is_phone/))
						{
							if(!value.match(/^(\d|\s|\-|\/|\(|\)|\[|\]|e|x|t|ension|\.|\+|\_|\,|\:|\;)*$/))
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}
							nomatch = false;
						}

						if(classes && classes.match(/is_number/))
						{
							if(!value.match(/^(\d)*$/))
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}
							nomatch = false;
						}

						if(classes && classes.match(/captcha/))
						{
							var verifier 	= form.find("#" + name + "_verifier").val(),
								lastVer		= verifier.charAt(verifier.length-1),
								finalVer	= verifier.charAt(lastVer);

							if(value != finalVer)
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}
							nomatch = false;
						}

						if(nomatch && value != '')
						{
							surroundingElement.attr("class","").addClass("valid");
						}
				});

				if(send.validationError == false)
				{
					send_ajax_form();
				}
				return false;
			}
		});
	};
})(jQuery);




/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
jQuery.cookie = function (key, value, options) {

    // key and at least value given, set cookie...
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : cookie_encode(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

function cookie_encode(string){
	//full uri decode not only to encode ",; =" but to save uicode charaters
	var decoded = encodeURIComponent(string);
	//encod back common and allowed charaters {}:"#[] to save space and make the cookies more human readable
	var ns = decoded.replace(/(%7B|%7D|%3A|%22|%23|%5B|%5D)/g,function(charater){return decodeURIComponent(charater);});
	return ns;
}

/**
 * Isotope v1.5.25
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time purchase of a commercial license
 * http://isotope.metafizzy.co/docs/license.html
 *
 * Non-commercial use is licensed under the MIT License
 *
 * Copyright 2013 Metafizzy
 */
(function(a,b,c){"use strict";var d=a.document,e=a.Modernizr,f=function(a){return a.charAt(0).toUpperCase()+a.slice(1)},g="Moz Webkit O Ms".split(" "),h=function(a){var b=d.documentElement.style,c;if(typeof b[a]=="string")return a;a=f(a);for(var e=0,h=g.length;e<h;e++){c=g[e]+a;if(typeof b[c]=="string")return c}},i=h("transform"),j=h("transitionProperty"),k={csstransforms:function(){return!!i},csstransforms3d:function(){var a=!!h("perspective");if(a){var c=" -o- -moz- -ms- -webkit- -khtml- ".split(" "),d="@media ("+c.join("transform-3d),(")+"modernizr)",e=b("<style>"+d+"{#modernizr{height:3px}}"+"</style>").appendTo("head"),f=b('<div id="modernizr" />').appendTo("html");a=f.height()===3,f.remove(),e.remove()}return a},csstransitions:function(){return!!j}},l;if(e)for(l in k)e.hasOwnProperty(l)||e.addTest(l,k[l]);else{e=a.Modernizr={_version:"1.6ish: miniModernizr for Isotope"};var m=" ",n;for(l in k)n=k[l](),e[l]=n,m+=" "+(n?"":"no-")+l;b("html").addClass(m)}if(e.csstransforms){var o=e.csstransforms3d?{translate:function(a){return"translate3d("+a[0]+"px, "+a[1]+"px, 0) "},scale:function(a){return"scale3d("+a+", "+a+", 1) "}}:{translate:function(a){return"translate("+a[0]+"px, "+a[1]+"px) "},scale:function(a){return"scale("+a+") "}},p=function(a,c,d){var e=b.data(a,"isoTransform")||{},f={},g,h={},j;f[c]=d,b.extend(e,f);for(g in e)j=e[g],h[g]=o[g](j);var k=h.translate||"",l=h.scale||"",m=k+l;b.data(a,"isoTransform",e),a.style[i]=m};b.cssNumber.scale=!0,b.cssHooks.scale={set:function(a,b){p(a,"scale",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.scale?d.scale:1}},b.fx.step.scale=function(a){b.cssHooks.scale.set(a.elem,a.now+a.unit)},b.cssNumber.translate=!0,b.cssHooks.translate={set:function(a,b){p(a,"translate",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.translate?d.translate:[0,0]}}}var q,r;e.csstransitions&&(q={WebkitTransitionProperty:"webkitTransitionEnd",MozTransitionProperty:"transitionend",OTransitionProperty:"oTransitionEnd otransitionend",transitionProperty:"transitionend"}[j],r=h("transitionDuration"));var s=b.event,t=b.event.handle?"handle":"dispatch",u;s.special.smartresize={setup:function(){b(this).bind("resize",s.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",s.special.smartresize.handler)},handler:function(a,b){var c=this,d=arguments;a.type="smartresize",u&&clearTimeout(u),u=setTimeout(function(){s[t].apply(c,d)},b==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Isotope=function(a,c,d){this.element=b(c),this._create(a),this._init(d)};var v=["width","height"],w=b(a);b.Isotope.settings={resizable:!0,layoutMode:"masonry",containerClass:"isotope",itemClass:"isotope-item",hiddenClass:"isotope-hidden",hiddenStyle:{opacity:0,scale:.001},visibleStyle:{opacity:1,scale:1},containerStyle:{position:"relative",overflow:"hidden"},animationEngine:"best-available",animationOptions:{queue:!1,duration:800},sortBy:"original-order",sortAscending:!0,resizesContainer:!0,transformsEnabled:!0,itemPositionDataEnabled:!1},b.Isotope.prototype={_create:function(a){this.options=b.extend({},b.Isotope.settings,a),this.styleQueue=[],this.elemCount=0;var c=this.element[0].style;this.originalStyle={};var d=v.slice(0);for(var e in this.options.containerStyle)d.push(e);for(var f=0,g=d.length;f<g;f++)e=d[f],this.originalStyle[e]=c[e]||"";this.element.css(this.options.containerStyle),this._updateAnimationEngine(),this._updateUsingTransforms();var h={"original-order":function(a,b){return b.elemCount++,b.elemCount},random:function(){return Math.random()}};this.options.getSortData=b.extend(this.options.getSortData,h),this.reloadItems(),this.offset={left:parseInt(this.element.css("padding-left")||0,10),top:parseInt(this.element.css("padding-top")||0,10)};var i=this;setTimeout(function(){i.element.addClass(i.options.containerClass)},0),this.options.resizable&&w.bind("smartresize.isotope",function(){i.resize()}),this.element.delegate("."+this.options.hiddenClass,"click",function(){return!1})},_getAtoms:function(a){var b=this.options.itemSelector,c=b?a.filter(b).add(a.find(b)):a,d={position:"absolute"};return c=c.filter(function(a,b){return b.nodeType===1}),this.usingTransforms&&(d.left=0,d.top=0),c.css(d).addClass(this.options.itemClass),this.updateSortData(c,!0),c},_init:function(a){this.$filteredAtoms=this._filter(this.$allAtoms),this._sort(),this.reLayout(a)},option:function(a){if(b.isPlainObject(a)){this.options=b.extend(!0,this.options,a);var c;for(var d in a)c="_update"+f(d),this[c]&&this[c]()}},_updateAnimationEngine:function(){var a=this.options.animationEngine.toLowerCase().replace(/[ _\-]/g,""),b;switch(a){case"css":case"none":b=!1;break;case"jquery":b=!0;break;default:b=!e.csstransitions}this.isUsingJQueryAnimation=b,this._updateUsingTransforms()},_updateTransformsEnabled:function(){this._updateUsingTransforms()},_updateUsingTransforms:function(){var a=this.usingTransforms=this.options.transformsEnabled&&e.csstransforms&&e.csstransitions&&!this.isUsingJQueryAnimation;a||(delete this.options.hiddenStyle.scale,delete this.options.visibleStyle.scale),this.getPositionStyles=a?this._translate:this._positionAbs},_filter:function(a){var b=this.options.filter===""?"*":this.options.filter;if(!b)return a;var c=this.options.hiddenClass,d="."+c,e=a.filter(d),f=e;if(b!=="*"){f=e.filter(b);var g=a.not(d).not(b).addClass(c);this.styleQueue.push({$el:g,style:this.options.hiddenStyle})}return this.styleQueue.push({$el:f,style:this.options.visibleStyle}),f.removeClass(c),a.filter(b)},updateSortData:function(a,c){var d=this,e=this.options.getSortData,f,g;a.each(function(){f=b(this),g={};for(var a in e)!c&&a==="original-order"?g[a]=b.data(this,"isotope-sort-data")[a]:g[a]=e[a](f,d);b.data(this,"isotope-sort-data",g)})},_sort:function(){var a=this.options.sortBy,b=this._getSorter,c=this.options.sortAscending?1:-1,d=function(d,e){var f=b(d,a),g=b(e,a);return f===g&&a!=="original-order"&&(f=b(d,"original-order"),g=b(e,"original-order")),(f>g?1:f<g?-1:0)*c};this.$filteredAtoms.sort(d)},_getSorter:function(a,c){return b.data(a,"isotope-sort-data")[c]},_translate:function(a,b){return{translate:[a,b]}},_positionAbs:function(a,b){return{left:a,top:b}},_pushPosition:function(a,b,c){b=Math.round(b+this.offset.left),c=Math.round(c+this.offset.top);var d=this.getPositionStyles(b,c);this.styleQueue.push({$el:a,style:d}),this.options.itemPositionDataEnabled&&a.data("isotope-item-position",{x:b,y:c})},layout:function(a,b){var c=this.options.layoutMode;this["_"+c+"Layout"](a);if(this.options.resizesContainer){var d=this["_"+c+"GetContainerSize"]();this.styleQueue.push({$el:this.element,style:d})}this._processStyleQueue(a,b),this.isLaidOut=!0},_processStyleQueue:function(a,c){var d=this.isLaidOut?this.isUsingJQueryAnimation?"animate":"css":"css",f=this.options.animationOptions,g=this.options.onLayout,h,i,j,k;i=function(a,b){b.$el[d](b.style,f)};if(this._isInserting&&this.isUsingJQueryAnimation)i=function(a,b){h=b.$el.hasClass("no-transition")?"css":d,b.$el[h](b.style,f)};else if(c||g||f.complete){var l=!1,m=[c,g,f.complete],n=this;j=!0,k=function(){if(l)return;var b;for(var c=0,d=m.length;c<d;c++)b=m[c],typeof b=="function"&&b.call(n.element,a,n);l=!0};if(this.isUsingJQueryAnimation&&d==="animate")f.complete=k,j=!1;else if(e.csstransitions){var o=0,p=this.styleQueue[0],s=p&&p.$el,t;while(!s||!s.length){t=this.styleQueue[o++];if(!t)return;s=t.$el}var u=parseFloat(getComputedStyle(s[0])[r]);u>0&&(i=function(a,b){b.$el[d](b.style,f).one(q,k)},j=!1)}}b.each(this.styleQueue,i),j&&k(),this.styleQueue=[]},resize:function(){this["_"+this.options.layoutMode+"ResizeChanged"]()&&this.reLayout()},reLayout:function(a){this["_"+this.options.layoutMode+"Reset"](),this.layout(this.$filteredAtoms,a)},addItems:function(a,b){var c=this._getAtoms(a);this.$allAtoms=this.$allAtoms.add(c),b&&b(c)},insert:function(a,b){this.element.append(a);var c=this;this.addItems(a,function(a){var d=c._filter(a);c._addHideAppended(d),c._sort(),c.reLayout(),c._revealAppended(d,b)})},appended:function(a,b){var c=this;this.addItems(a,function(a){c._addHideAppended(a),c.layout(a),c._revealAppended(a,b)})},_addHideAppended:function(a){this.$filteredAtoms=this.$filteredAtoms.add(a),a.addClass("no-transition"),this._isInserting=!0,this.styleQueue.push({$el:a,style:this.options.hiddenStyle})},_revealAppended:function(a,b){var c=this;setTimeout(function(){a.removeClass("no-transition"),c.styleQueue.push({$el:a,style:c.options.visibleStyle}),c._isInserting=!1,c._processStyleQueue(a,b)},10)},reloadItems:function(){this.$allAtoms=this._getAtoms(this.element.children())},remove:function(a,b){this.$allAtoms=this.$allAtoms.not(a),this.$filteredAtoms=this.$filteredAtoms.not(a);var c=this,d=function(){a.remove(),b&&b.call(c.element)};a.filter(":not(."+this.options.hiddenClass+")").length?(this.styleQueue.push({$el:a,style:this.options.hiddenStyle}),this._sort(),this.reLayout(d)):d()},shuffle:function(a){this.updateSortData(this.$allAtoms),this.options.sortBy="random",this._sort(),this.reLayout(a)},destroy:function(){var a=this.usingTransforms,b=this.options;this.$allAtoms.removeClass(b.hiddenClass+" "+b.itemClass).each(function(){var b=this.style;b.position="",b.top="",b.left="",b.opacity="",a&&(b[i]="")});var c=this.element[0].style;for(var d in this.originalStyle)c[d]=this.originalStyle[d];this.element.unbind(".isotope").undelegate("."+b.hiddenClass,"click").removeClass(b.containerClass).removeData("isotope"),w.unbind(".isotope")},_getSegments:function(a){var b=this.options.layoutMode,c=a?"rowHeight":"columnWidth",d=a?"height":"width",e=a?"rows":"cols",g=this.element[d](),h,i=this.options[b]&&this.options[b][c]||this.$filteredAtoms["outer"+f(d)](!0)||g;h=Math.floor(g/i),h=Math.max(h,1),this[b][e]=h,this[b][c]=i},_checkIfSegmentsChanged:function(a){var b=this.options.layoutMode,c=a?"rows":"cols",d=this[b][c];return this._getSegments(a),this[b][c]!==d},_masonryReset:function(){this.masonry={},this._getSegments();var a=this.masonry.cols;this.masonry.colYs=[];while(a--)this.masonry.colYs.push(0)},_masonryLayout:function(a){var c=this,d=c.masonry;a.each(function(){var a=b(this),e=Math.ceil(a.outerWidth(!0)/d.columnWidth);e=Math.min(e,d.cols);if(e===1)c._masonryPlaceBrick(a,d.colYs);else{var f=d.cols+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.colYs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryPlaceBrick(a,g)}})},_masonryPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=this.masonry.columnWidth*d,h=c;this._pushPosition(a,g,h);var i=c+a.outerHeight(!0),j=this.masonry.cols+1-f;for(e=0;e<j;e++)this.masonry.colYs[d+e]=i},_masonryGetContainerSize:function(){var a=Math.max.apply(Math,this.masonry.colYs);return{height:a}},_masonryResizeChanged:function(){return this._checkIfSegmentsChanged()},_fitRowsReset:function(){this.fitRows={x:0,y:0,height:0}},_fitRowsLayout:function(a){var c=this,d=this.element.width(),e=this.fitRows;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.x!==0&&f+e.x>d&&(e.x=0,e.y=e.height),c._pushPosition(a,e.x,e.y),e.height=Math.max(e.y+g,e.height),e.x+=f})},_fitRowsGetContainerSize:function(){return{height:this.fitRows.height}},_fitRowsResizeChanged:function(){return!0},_cellsByRowReset:function(){this.cellsByRow={index:0},this._getSegments(),this._getSegments(!0)},_cellsByRowLayout:function(a){var c=this,d=this.cellsByRow;a.each(function(){var a=b(this),e=d.index%d.cols,f=Math.floor(d.index/d.cols),g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByRowGetContainerSize:function(){return{height:Math.ceil(this.$filteredAtoms.length/this.cellsByRow.cols)*this.cellsByRow.rowHeight+this.offset.top}},_cellsByRowResizeChanged:function(){return this._checkIfSegmentsChanged()},_straightDownReset:function(){this.straightDown={y:0}},_straightDownLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,0,c.straightDown.y),c.straightDown.y+=d.outerHeight(!0)})},_straightDownGetContainerSize:function(){return{height:this.straightDown.y}},_straightDownResizeChanged:function(){return!0},_masonryHorizontalReset:function(){this.masonryHorizontal={},this._getSegments(!0);var a=this.masonryHorizontal.rows;this.masonryHorizontal.rowXs=[];while(a--)this.masonryHorizontal.rowXs.push(0)},_masonryHorizontalLayout:function(a){var c=this,d=c.masonryHorizontal;a.each(function(){var a=b(this),e=Math.ceil(a.outerHeight(!0)/d.rowHeight);e=Math.min(e,d.rows);if(e===1)c._masonryHorizontalPlaceBrick(a,d.rowXs);else{var f=d.rows+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.rowXs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryHorizontalPlaceBrick(a,g)}})},_masonryHorizontalPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=c,h=this.masonryHorizontal.rowHeight*d;this._pushPosition(a,g,h);var i=c+a.outerWidth(!0),j=this.masonryHorizontal.rows+1-f;for(e=0;e<j;e++)this.masonryHorizontal.rowXs[d+e]=i},_masonryHorizontalGetContainerSize:function(){var a=Math.max.apply(Math,this.masonryHorizontal.rowXs);return{width:a}},_masonryHorizontalResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_fitColumnsReset:function(){this.fitColumns={x:0,y:0,width:0}},_fitColumnsLayout:function(a){var c=this,d=this.element.height(),e=this.fitColumns;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.y!==0&&g+e.y>d&&(e.x=e.width,e.y=0),c._pushPosition(a,e.x,e.y),e.width=Math.max(e.x+f,e.width),e.y+=g})},_fitColumnsGetContainerSize:function(){return{width:this.fitColumns.width}},_fitColumnsResizeChanged:function(){return!0},_cellsByColumnReset:function(){this.cellsByColumn={index:0},this._getSegments(),this._getSegments(!0)},_cellsByColumnLayout:function(a){var c=this,d=this.cellsByColumn;a.each(function(){var a=b(this),e=Math.floor(d.index/d.rows),f=d.index%d.rows,g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByColumnGetContainerSize:function(){return{width:Math.ceil(this.$filteredAtoms.length/this.cellsByColumn.rows)*this.cellsByColumn.columnWidth}},_cellsByColumnResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_straightAcrossReset:function(){this.straightAcross={x:0}},_straightAcrossLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,c.straightAcross.x,0),c.straightAcross.x+=d.outerWidth(!0)})},_straightAcrossGetContainerSize:function(){return{width:this.straightAcross.x}},_straightAcrossResizeChanged:function(){return!0}},b.fn.imagesLoaded=function(a){function h(){a.call(c,d)}function i(a){var c=a.target;c.src!==f&&b.inArray(c,g)===-1&&(g.push(c),--e<=0&&(setTimeout(h),d.unbind(".imagesLoaded",i)))}var c=this,d=c.find("img").add(c.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",g=[];return e||h(),d.bind("load.imagesLoaded error.imagesLoaded",i).each(function(){var a=this.src;this.src=f,this.src=a}),c};var x=function(b){a.console&&a.console.error(b)};b.fn.isotope=function(a,c){if(typeof a=="string"){var d=Array.prototype.slice.call(arguments,1);this.each(function(){var c=b.data(this,"isotope");if(!c){x("cannot call methods on isotope prior to initialization; attempted to call method '"+a+"'");return}if(!b.isFunction(c[a])||a.charAt(0)==="_"){x("no such method '"+a+"' for isotope instance");return}c[a].apply(c,d)})}else this.each(function(){var d=b.data(this,"isotope");d?(d.option(a),d._init(c)):b.data(this,"isotope",new b.Isotope(a,this,c))});return this}})(window,jQuery);

/*
(function($,d){"use strict";$.HoverDir=function(a,b){this.$el=$(b);this._init(a)};$.HoverDir.defaults={hoverDelay:0,reverse:false,hoverItem:'image_overlay_effect_inside'};$.HoverDir.prototype={_init:function(a){this.options=$.extend(true,{},$.HoverDir.defaults,a);this._loadEvents()},_loadEvents:function(){var c=this;this.$el.on('mouseenter.hoverdir, mouseleave.hoverdir',function(a){var b=$(this),evType=a.type,$hoverElem=b.find('.'+c.options.hoverItem),direction=c._getDir(b,{x:a.pageX,y:a.pageY}),hoverClasses=c._getClasses(direction);$hoverElem.removeClass().addClass(c.options.hoverItem);if(evType==='mouseenter'){$hoverElem.hide().addClass(hoverClasses.from);clearTimeout(c.tmhover);c.tmhover=setTimeout(function(){$hoverElem.show(0,function(){$(this).addClass('da-animate').addClass(hoverClasses.to)})},c.options.hoverDelay)}else{$hoverElem.addClass('da-animate');clearTimeout(c.tmhover);$hoverElem.addClass(hoverClasses.from)}})},_getDir:function(a,b){var w=a.width(),h=a.height(),x=(b.x-a.offset().left-(w/2))*(w>h?(h/w):1),y=(b.y-a.offset().top-(h/2))*(h>w?(w/h):1),direction=Math.round((((Math.atan2(y,x)*(180/Math.PI))+180)/90)+3)%4;return direction},_getClasses:function(a){var b,toClass;switch(a){case 0:(!this.options.reverse)?b='da-slideFromTop':b='da-slideFromBottom';toClass='da-slideTop';break;case 1:(!this.options.reverse)?b='da-slideFromRight':b='da-slideFromLeft';toClass='da-slideLeft';break;case 2:(!this.options.reverse)?b='da-slideFromBottom':b='da-slideFromTop';toClass='da-slideTop';break;case 3:(!this.options.reverse)?b='da-slideFromLeft':b='da-slideFromRight';toClass='da-slideLeft';break};return{from:b,to:toClass}}};var e=function(a){if(this.console){console.error(a)}};$.fn.hoverdir=function(b){if(typeof b==='string'){var c=Array.prototype.slice.call(arguments,1);this.each(function(){var a=$.data(this,'hoverdir');if(!a){e("cannot call methods on hoverdir prior to initialization; "+"attempted to call method '"+b+"'");return}if(!$.isFunction(a[b])||b.charAt(0)==="_"){e("no such method '"+b+"' for hoverdir instance");return}a[b].apply(a,c)})}else{this.each(function(){var a=$.data(this,'hoverdir');if(!a){$.data(this,'hoverdir',new $.HoverDir(b,this))}})}return this}})(jQuery);
*/


(function( $, undefined ) {

	"use strict";

	/*
	 * HoverDir object.
	 */
	$.HoverDir 				= function( options, element ) {

		this.$el	= $( element );

		this._init( options );

	};

	$.HoverDir.defaults 	= {
		hoverDelay	: 0,
		reverse		: false,
		hoverItem	: 'image_overlay_effect_inside'
	};

	$.HoverDir.prototype 	= {
		_init 				: function( options ) {

			this.options 		= $.extend( true, {}, $.HoverDir.defaults, options );

			// load the events
			this._loadEvents();

		},
		_loadEvents			: function() {

			var _self = this;

			this.$el.on( 'mouseenter.hoverdir, mouseleave.hoverdir', function( event ) {

				var $el			= $(this),
					evType		= event.type,
					$hoverElem	= $el.find( '.'+ _self.options.hoverItem ),
					direction	= _self._getDir( $el, { x : event.pageX, y : event.pageY } ),
					hoverClasses= _self._getClasses( direction );

				$hoverElem.removeClass().addClass( _self.options.hoverItem);

				if( evType === 'mouseenter' ) {

					$hoverElem.hide().addClass( hoverClasses.from );

					clearTimeout( _self.tmhover );

					_self.tmhover	= setTimeout( function() {

						$hoverElem.show( 0, function() {
							$(this).addClass( 'da-animate' ).addClass( hoverClasses.to );
						} );


					}, _self.options.hoverDelay );

				}
				else {

					$hoverElem.addClass( 'da-animate' );

					clearTimeout( _self.tmhover );

					$hoverElem.addClass( hoverClasses.from );

				}

			} );

		},
		// credits : http://stackoverflow.com/a/3647634
		_getDir				: function( $el, coordinates ) {

				/** the width and height of the current div **/
			var w = $el.width(),
				h = $el.height(),

				/** calculate the x and y to get an angle to the center of the div from that x and y. **/
				/** gets the x value relative to the center of the DIV and "normalize" it **/
				x = ( coordinates.x - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
				y = ( coordinates.y - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),

				/** the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);**/
				/** first calculate the angle of the point,
				add 180 deg to get rid of the negative values
				divide by 90 to get the quadrant
				add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
				direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 )  % 4;

			return direction;

		},
		_getClasses			: function( direction ) {

			var fromClass, toClass;

			switch( direction ) {
				case 0:
					// from top
					( !this.options.reverse ) ? fromClass = 'da-slideFromTop' : fromClass = 'da-slideFromBottom';
					toClass		= 'da-slideTop';
					break;
				case 1:
					// from right
					( !this.options.reverse ) ? fromClass = 'da-slideFromRight' : fromClass = 'da-slideFromLeft';
					toClass		= 'da-slideLeft';
					break;
				case 2:
					// from bottom
					( !this.options.reverse ) ? fromClass = 'da-slideFromBottom' : fromClass = 'da-slideFromTop';
					toClass		= 'da-slideTop';
					break;
				case 3:
					// from left
					( !this.options.reverse ) ? fromClass = 'da-slideFromLeft' : fromClass = 'da-slideFromRight';
					toClass		= 'da-slideLeft';
					break;
			};

			return { from : fromClass, to: toClass };

		}
	};

	var logError 			= function( message ) {
		if ( this.console ) {
			console.error( message );
		}
	};

	$.fn.hoverdir			= function( options ) {

		if ( typeof options === 'string' ) {

			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {

				var instance = $.data( this, 'hoverdir' );

				if ( !instance ) {
					logError( "cannot call methods on hoverdir prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}

				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for hoverdir instance" );
					return;
				}

				instance[ options ].apply( instance, args );

			});

		}
		else {

			this.each(function() {

				var instance = $.data( this, 'hoverdir' );
				if ( !instance ) {
					$.data( this, 'hoverdir', new $.HoverDir( options, this ) );
				}
			});

		}

		return this;

	};

})( jQuery );






//add browser class in JS instead of PHP. works better with caching plugins
function add_browser_class()
{
	var html_class = "unknown", html_tag = jQuery('html'), broserObject = jQuery.browser, userAgent = navigator.userAgent.toLowerCase();

    broserObject.chrome = /chrome/.test(navigator.userAgent.toLowerCase());

	if(broserObject.chrome){ 		html_class = 'chrome';	}
	else if(broserObject.firefox){ 	html_class = 'firefox'; }
	else if(broserObject.msie){ 	html_class = 'msie'; 	}
	else if(broserObject.safari){ 	html_class = 'safari'; 	}
	else if(broserObject.opera){ 	html_class = 'opera'; 	}

	if('ontouchstart' in document.documentElement){ 	html_class = html_class + " " + html_class+"_mobile browser_mobile" ; 	}
	html_tag.addClass(html_class);
}






(function($)
{
	"use strict";

	$.avia_utilities = $.avia_utilities || {};

	/************************************************************************
	check if a css feature is supported and save it to the supported array
	*************************************************************************/
	$.avia_utilities.supported	= {};
	$.avia_utilities.supports	= (function()
	{
		var div		= document.createElement('div'),
			vendors	= ['Khtml', 'Ms', 'Webkit'];  // vendors	= ['Khtml', 'Ms','Moz','Webkit','O'];  exclude opera for the moment. stil to buggy

		return function(prop, vendor_overwrite)
		{
			if ( div.style.prop !== undefined  ) { return ""; }
			if (vendor_overwrite !== undefined) { vendors = vendor_overwrite; }

			prop = prop.replace(/^[a-z]/, function(val)
			{
				return val.toUpperCase();
			});

			var len	= vendors.length;
			while(len--)
			{
				if ( div.style[vendors[len] + prop] !== undefined )
				{
					return "-" + vendors[len].toLowerCase() + "-";
				}
			}

			return false;
		};

	}());
})( jQuery );













(function($){

  //variable for storing the menu count when no ID is present
  var menuCount = 0;

  //plugin code
  $.fn.mobileMenu = function(options){

    //plugin's default options
    var settings = {
      switchWidth: 768,
      topOptionText: 'Select a page',
      indentString: '&nbsp;&nbsp;&nbsp;'
    };


    //function to check if selector matches a list
    function isList($this){
      return $this.is('ul, ol');
    }


    //function to decide if mobile or not
    function isMobile(){
      return ($(window).width() < settings.switchWidth);
    }


    //check if dropdown exists for the current element
    function menuExists($this){

      //if the list has an ID, use it to give the menu an ID
      if($this.attr('id')){
        return ($('#mobileMenu_'+$this.attr('id')).length > 0);
      }

      //otherwise, give the list and select elements a generated ID
      else {
        menuCount++;
        $this.attr('id', 'mm'+menuCount);
        return ($('#mobileMenu_mm'+menuCount).length > 0);
      }
    }


    //change page on mobile menu selection
    function goToPage($this){
      if($this.val() !== null){document.location.href = $this.val()}
    }


    //show the mobile menu
    function showMenu($this){
      $this.css('display', 'none');
      $('#mobileMenu_'+$this.attr('id')).show();
    }


    //hide the mobile menu
    function hideMenu($this){
      $this.css('display', '');
      $('#mobileMenu_'+$this.attr('id')).hide();
    }


    //create the mobile menu
    function createMenu($this){
      if(isList($this)){

        //generate select element as a string to append via jQuery
        var selectString = '<select id="mobileMenu_'+$this.attr('id')+'" class="mobileMenu">';

        //create first option (no value)
        selectString += '<option value="">'+settings.topOptionText+'</option>';

        //loop through list items
        $this.find('li').each(function(){

          //when sub-item, indent
          var levelStr = '', disabled = '', skip = false, current = $(this);
          var len = current.parents('ul, ol').length;
          for(i=1;i<len;i++){levelStr += settings.indentString;}

          //get url and text for option
          var link 		= current.find('a:first-child').attr('href');
          var the_clone = current.clone();

          if(the_clone.find('.avia_mega_text_block').length && the_clone.find('li:not(.avia_mega_text_block)').length == 0)
          {
         	skip = true;
          }

	  if(the_clone.is('.noMobile'))
	  {
	  	skip = true;
	  }

	  if(the_clone.is('.disabled'))
	  {
		disabled = 'disabled="disabled"';
	  }

          if(!skip)
          {
	          var element 	= the_clone.children('ul, ol, .avia_mega_div').remove().end();
	          var text 		= levelStr + element.text();

	         console.log(element.text());

	         if($.trim( element.text() ) == "")
	         {
	         	skip = true;
	         }

	         if(element.find('.mega_menu_title').length > 0 || link == "" || link == '#')
	         {
	         	disabled = 'disabled="disabled"';
	         }

	         if(element.is('.avia_mega_text_block'))
	         {
	         	skip = true;
	         }

	          //add option
	          if(!skip) selectString += '<option '+disabled+' value="'+link+'">'+text+'</option>';
          }
        });

        selectString += '</select>';

        //append select element to ul/ol's container
        $this.parent().append(selectString);

        //add change event handler for mobile menu
        $('#mobileMenu_'+$this.attr('id')).change(function(){
          goToPage($(this));
        });

        //hide current menu, show mobile menu
        showMenu($this);
      } else {
        alert('mobileMenu will only work with UL or OL elements!');
      }
    }


    //plugin functionality
    function run($this){

      //menu doesn't exist
      if(isMobile() && !menuExists($this)){
        createMenu($this);
      }

      //menu already exists
      else if(isMobile() && menuExists($this)){
        showMenu($this);
      }

      //not mobile browser
      else if(!isMobile() && menuExists($this)){
        hideMenu($this);
      }

    }

    //run plugin on each matched ul/ol
    //maintain chainability by returning "this"
    return this.each(function() {

      //override the default settings if user provides some
      if(options){$.extend(settings, options);}

      //cache "this"
      var $this = $(this);

      //bind event to browser resize
      $(window).resize(function(){run($this);});

      //run plugin
      run($this);

    });

  };

})(jQuery);



jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

function avia_log(text)
	{
		var logfield = jQuery('.avia_logfield');
		if(!logfield.length) logfield = jQuery('<pre class="avia_logfield"></pre>').appendTo('body').css({	zIndex:100000,
																											padding:"20px",
																											backgroundColor:"#ffffff",
																											color:"#333333",
																											position:"fixed",
																											top:0, right:0,
																											width:"300px",
																											borderColor:"#cccccc",
																											borderWidth:"1px",
																											borderStyle:'solid',
																											height:"300px",
																											overflow:'scroll',
																											display:'block',
																											zoom:1
																											});
		var val = logfield.html();
		var text = avia_get_object(text);
		logfield.html(text + "\n<br/>" + val  );


		function avia_get_object(obj)
		{
			var sendreturn = obj;

			if(typeof obj == 'object' || typeof obj == 'array')
			{
				for (i in obj)
				{
					sendreturn += "'"+i+"': "+obj[i] + "<br/>";
				}
			}

			return sendreturn;
		}
	}
