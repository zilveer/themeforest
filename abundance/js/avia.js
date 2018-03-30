/* this prevents dom flickering, needs to be outside of dom.ready event: */
document.documentElement.className += ' js_active ';
/*end dom flickering =) */

//global path: avia_framework_globals.installedAt

jQuery.noConflict();
jQuery(document).ready(function(){

	
	//activates the mega menu javascript
	if(jQuery.fn.aviaMegamenu)		
	jQuery(".main_menu .avia_mega, .sub_menu>ul, .sub_menu>div>ul").aviaMegamenu({modify_position:true});

	//activates the prettyphoto lightbox
	if(jQuery.fn.avia_activate_lightbox)		
	jQuery('body').avia_activate_lightbox();
	
	//activates the hover effect for image links
	if(jQuery.fn.avia_activate_hover_effect)
	{		
		if((jQuery.browser.msie && jQuery.browser.version < 9)) 
		{
			jQuery('#main').avia_activate_hover_effect();
		}
		else
		{
			jQuery('#main, .main_menu').avia_activate_hover_effect();
		}
	}
	
	// enhances contact form with ajax capabilities
	if(jQuery.fn.kriesi_ajax_form)
	jQuery('.ajax_form').kriesi_ajax_form();
	
	//smooth scrooling
	if(jQuery.fn.avia_smoothscroll)
	jQuery('a[href*="#"]').avia_smoothscroll();
	
	//activates the shortcode content slider
	if(jQuery.fn.avia_sc_slider)
	{								
		jQuery(".content_slider").avia_sc_slider({appendControlls:{}});
		jQuery(".shop_slider_yes ul").avia_sc_slider({appendControlls:false, group:true, slide:'.product', arrowControll: true, autorotationInterval:'parent'});
	}
	//activates the toggle shortcode
	if(jQuery.fn.avia_sc_toggle)
	jQuery('.togglecontainer').avia_sc_toggle();
	
	//activates the tabs shortcode
	if(jQuery.fn.avia_sc_tabs)
	jQuery('.tabcontainer').avia_sc_tabs();
	
	//activate html5 flare video player
	if(jQuery.fn.avia_video_activation)
	jQuery(".avia_video").avia_video_activation({ratio:'16:9'});
	
	//activates the mega menu javascript
	if(jQuery.fn.avia_menu_helper)		
	jQuery(".main_menu .menu").avia_menu_helper({modify_position:true});
	
	avia_cufon_helper('h1, h2, h3, h4, h5, h6');
	
	
	//accordion slider
	if(jQuery.fn.aviaCordion)
	jQuery(".aviacordion .slideshow").aviaCordion();
	
	// default fade slider
	if(jQuery.fn.avia_fade_slider)
	jQuery(".fade_slider .slideshow, .piecemaker .slideshow, .caption_slider .slideshow").avia_fade_slider();
	

	// aviaslider initialisation: large aviaslider
	if(jQuery.fn.aviaSlider)
	jQuery(".aviaslider .slideshow").each(function(){
	
	jQuery(this).aviaSlider({
			animationSpeed:500,										// animation duration
			autorotation: true,										// autorotation true or false?
			autorotationSpeed:8,									// duration between autorotation switch in Seconds
			transition: 'fade',
			blockSize: {height: 'full', width:'full'},				// heigth and width of the blocks'
			betweenBlockDelay:50,									// delay between each block change
			transitionOrder: ['diagonaltop', 'diagonalbottom','topleft', 'bottomright', 'random'],
			showText: true,											// wether description text should be shown or not 
			display: 'all', 										// showing up blocks: random, topleft, bottomright, diagonaltop, diagonalbottom, all
			switchMovement: false,									// if display is set "topleft" it will switch to "br" every 2nd transition
			slideControlls: 'items',								// which controlls should the be displayed for the user: none, items
			slides: '.featured',									// wich element inside the container should serve as slide
			captionReplacement:'.slideshow_caption'
			});
			
	jQuery(this).next('.arrowslidecontrolls').aviaSlider_externalControlls();
			
	});	


	
	// actiavte portfolio sorting
	if(jQuery.fn.avia_portfolio_sort)
	jQuery('.template-portfolio-overview').avia_portfolio_sort();
	
	avia_iframe_fix();
	avia_sidebar_fix();
	avia_ie_fix();
	avia_more_link_fade('.template-portfolio-overview:not(.portfolio-size-1)');
	
	
	// improves comment forms
	if(jQuery.fn.kriesi_empty_input)
	jQuery('#s').kriesi_empty_input();
});




function avia_more_link_fade(container)
{
	var container 	= jQuery(container),
		links 		= container.find('.more-link').css({opacity:0, 'visibility':'visible'}),
		parents 	= links.parents('.post-entry');
		parents.hover(
			function()
			{
				jQuery(this).find('.more-link').stop().animate({opacity:1});
			}, 
			function()
			{
				jQuery(this).find('.more-link').stop().animate({opacity:0});
			}
		);
}

function avia_sidebar_fix(container)
{
	var sidebars = jQuery('.dual-sidebar .sidebar'),
		content  = jQuery('.dual-sidebar .content:eq(0)'),
		minHeight = content.outerHeight();
		
		sidebars.each(function()
		{	
			var current = jQuery(this);
			if(current.outerHeight() > minHeight) minHeight = current.outerHeight();
		});
		
		sidebars.css('min-height',minHeight)
		content.css('min-height',minHeight)
}

function avia_ie_fix()
{
	if(!jQuery.support.opacity)
	{
		jQuery('.image_overlay_effect').css({'background-image':'none'});
	}

}


// -------------------------------------------------------------------------------------------
// Mega Menu
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
				dropdownItems = menuItems.find(">ul").parent(),
				parentContainerWidth = menu.parent().width(),
				delayCheck = {},
				mega_open = [];

			
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
					if(typeof link.attr('href') != 'string'){ link.css('cursor','default'); }
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
// portfolio sorting
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_portfolio_sort = function() 
	{
		var pluginNameSpace 	= 'avia_portfolio_sort', 
			transition			= 'easeOutQuint',
			duration			= 500,
			activate_sorting 	= function()
			{
				var container = this
					data 	= this.data( pluginNameSpace );
				
				data.links.bind('click', function()
				{
					var clickedElement 		= $(this);
					
					data.entries = container.find('.post-entry:not(.not-sortable)');
					
					if(clickedElement.is('.active_sort') || data.is_animating) { return false };
					
					var	elementFilter 		= this.id,
						showEntries 		= data.entries.not('.'+elementFilter),
						showOverlays 		= showEntries.find('.portfolio_sort:not(:visible)'),
						activeEntries		= data.entries.filter('.'+elementFilter),
						hideOverlays		= activeEntries.find('.portfolio_sort:visible');
					
					//apply active state
					clickedElement.parent().find('.active_sort').removeClass('active_sort');
					this.className += ' active_sort';
						
					//show Overlays
					data.is_animating = true;
					showOverlays.css({display:'block',opacity:'0'}).animate({opacity:0.9}, duration, transition, function()
					{
						data.is_animating = false;
					});
					hideOverlays.animate({opacity:0}, duration, transition, function()
					{
						$(this).css({display:'none'});
						data.is_animating = false;
					});
					
					setTimeout(function(){ data.is_animating = false; }, duration);
					
					return false;
				});
			};
	
		return this.each(function()
		{
			var container =  $(this), data = {};
			data.entries			= container.find('.post-entry')
			data.linkContainer 		= container.find('.sort_by_cat');
			data.links				= data.linkContainer.find('a');
			data.is_animating		= false;
			
			
			//apply data to the slider to keep track of variables and states
			container.data( pluginNameSpace, data );
			
			data.entries.append('<div class="portfolio_sort"></div>');

			activate_sorting.apply( container );
			
			
		
		});
	}
})(jQuery);	



	
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
// Avia Menu
// -------------------------------------------------------------------------------------------


(function($)
{
	$.fn.avia_menu_helper = function(variables) 
	{
		var defaults = 
		{
			modify_position:true,
			delay:300
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			
			var menu = $(this),
				menuItems = menu.find(">li"),
				dropdownItems = menuItems.find(">ul").parent(),
				parentContainerWidth = menu.parent().width(),
				delayCheck = {},
				descriptions = menu.find('.main-menu-description');

			if(!descriptions.length) menu.addClass('no_description_menu');
				
			menuItems.each(function()
			{
				var item = $(this),
					normalDropdown = item.find("li>ul").css({display:"none"});
				
				//if we got a mega menu or dropdown menu add the arrow beside the menu item	
				if(normalDropdown.length)
				{
					normalDropdown.parent('li').addClass('submenu_available');
				}
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
// HTML 5 // Flash self hosted video
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_video_activation = function(options) 
	{
		var defaults = 
		{
			ratio: '16:9'
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var fv = $(this),
		      	fv_parent = fv.parents('.slideshow:eq(0)'),
		      	fv_height = fv_parent.height(),
		      	fv_width = fv_parent.width();
		      	
		      	
		    var id_to_apply = '#' + $(this).attr('id'),
		      	posterImg = fv.attr('poster');
		      		
		    fv.height(fv_height);
		    fv.width(fv_width);
		    
		    		    
		     projekktor(id_to_apply, {
				 plugins: ['Startbutton', 'Controlbar', 'Bufferingicon'],
				 debug: false, //'console',
				 controls: true,
				 playerFlashMP4: avia_framework_globals.installedAt + 'js/projekktor/jarisplayer.swf',
				 height: fv_height,
				 width: fv_width,
				 poster: posterImg
			});

		});
	};
})(jQuery);
//.ppfsenter, .ppfsexit


// -------------------------------------------------------------------------------------------
// Tab shortcode javascript
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_sc_tabs= function(options) 
	{
		var defaults = 
		{
			heading: '.tab',
			content:'.tab_content'
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var container = $(this),
				tabs = $(options.heading, container),
				content = $(options.content, container),
				initialOpen = 1;
			
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
			
			tabs.prependTo(container).each(function(i)
			{
				var tab = $(this);
				
				//set default tab to open
					if(initialOpen == (i+1))
					{
						tab.addClass('active_tab');
						content.filter(':eq('+i+')').addClass('active_tab_content');
					}
			
				tab.bind('click', function()
				{
					if(!tab.is('.active_tab'))
					{
						$('.active_tab', container).removeClass('active_tab');
						$('.active_tab_content', container).removeClass('active_tab_content');
						
						tab.addClass('active_tab');
						content.filter(':eq('+i+')').addClass('active_tab_content');
					}
					return false;
				});
			});
		
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
				
				if(initialOpen == (i+1)) { content.css({display:'block'}); }
				
					
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
					}
				});
			});
		});
	};
})(jQuery); 



function avia_cufon_helper(elString)
{
	var els = jQuery(elString).not('.no_cufon');
	
		els = els.not('.slideshow h1');
	 
	
	if(typeof avia_cufon_size_mod == 'string' && avia_cufon_size_mod != "1")
	{
		avia_cufon_size_mod = parseFloat(avia_cufon_size_mod);
		els.each(function()
		{
			$size = parseInt(jQuery(this).css('fontSize'));	
			jQuery(this).css('fontSize', $size * avia_cufon_size_mod)
		});
	}
	
	
	els.addClass('cufon_headings');
}




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
		
		var options = $.extend(defaults, variables);
		
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
					
					//manipulate the link in case we got a screenr video
					if(el.is('a[href*="screenr.com"]'))
					{
						var currentlink = el.attr('href');
						
						if(currentlink.indexOf('embed') !== -1)
						{
							el.attr('href', currentlink + '?iframe=true&width=650&height=396');
						}
						else
						{
							var append =  currentlink.substring(currentlink.lastIndexOf('/') + 1,currentlink.length);
							el.attr('href', 'http://www.screenr.com/embed/' + append + '?iframe=true&width=650&height=396');
						}
					}
				}
			});
			
			if($.fn.prettyPhoto)
			elements.prettyPhoto({ 'social_tools':'','slideshow': 5000 }); /* facebook /light_rounded / dark_rounded / light_square / dark_square */								
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
			autolinkElements: 'a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"], a.external-link, .avia_mega a, .dynamic_template_columns a'
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{	
			$(options.autolinkElements, this).not(".noLightbox a").contents('img').each(function()
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
					if(img.css('float') == 'left' || img.css('float') == 'right') {a.css({float:img.css('float')})}
					if(!a.css('position') || a.css('position') == 'static') { a.css({position:'relative', display:'inline-block'}); }
					if(img.is('.aligncenter')) a.css({display:'block'}); 
					if(img.is('.avia_mega img')) a.css({position:'relative', display:'inline-block'}); 
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
					
					bg.stop().animate({opacity:0.6},400);
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
// content slider
// -------------------------------------------------------------------------------------------

(function($)
{
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
				slides 		= $(options.slide, container);
			
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
				
			container.methods = 
			{
				preload: function()
				{
					followslides.css({display:"none"});
										
					
					if(!slideCount)
					{
						container.methods.init();
					}
					else
					{
						container.aviaImagePreloader(container.methods.init);
					}
				},
				
				init: function()
				{
					if(slideCount > 1)
					{
						//set container height to match the first slide
						container.height(firstSlide.height());
						
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
					}
				},
				
				change: function()
				{
					//move inner container
					var moveTo = ((-i * container.width()) - (i * options.slidePadding));
					innerContainer.stop().animate({left: moveTo}, options.transitionDuration, options.transitionEasing);
					
					//change height of outer container
					var nextSlideHeight = slides.filter(':eq('+i+')').height();
					container.stop().animate({height: nextSlideHeight}, options.transitionDuration, options.transitionEasing);
					
					//change active state of controlls
					var controllLinks = $('a', controlls);
					controllLinks.removeClass('activeItem');
					controllLinks.filter(':eq('+i+')').addClass('activeItem');
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
						
						controlls.css({visibility:'visible', opacity:0}).animate({opacity:1},400);
					}
					
					//add arrow Controlls
					if(options.arrowControll && slideCount > 1)
					{
						arrowControlls = $('<div></div>').addClass(options.arrowControlls).css({visibility:'visible', opacity:0});
						nextArrow = $('<a class="arrow_controll arrow_controll_next" href="#next">+</a>').appendTo(arrowControlls).bind('click', {show: 'next'}, container.methods.setSlideNumber);
						prevArrow = $('<a class="arrow_controll arrow_controll_prev" href="#prev">-</a>').appendTo(arrowControlls).bind('click', {show: 'prev'}, container.methods.setSlideNumber);
					}
					
					if(positioningClass)
					{
						arrowControlls.appendTo(container);
					}							
					else
					{
						arrowControlls.insertAfter(container);
					}
					
					arrowControlls.parent().hover(function()
					{
						arrowControlls.stop().animate({opacity:1},400);
					},
					function()
					{
						arrowControlls.stop().animate({opacity:0},400)
					});
					
					
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
					formElements: form.find('textarea, select, input[type=text], input[type=hidden]'),
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
																											position:"fixed", 
																											top:0, right:0, 
																											width:"300px",
																											borderColor:"#cccccc",
																											borderWidth:"1px",
																											borderStyle:'solid',
																											height:"600px",
																											overflow:'scroll',
																											display:'block',
																											zoom:1
																											});
		var val = logfield.html();
		var text = avia_get_object(text);
		logfield.html(val + "\n<br/>" + text);
	
	
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

// -------------------------------------------------------------------------------------------
// image preloader
// -------------------------------------------------------------------------------------------


(function($)
{
	$.fn.aviaImagePreloader = function(variables, callback) 
	{
		var defaults = 
		{
			fadeInSpeed: 800,
			delay:0,
			maxLoops: 10,
			thisData: {},
			data: ''
		};
		
		var options = $.extend(defaults, variables);
			
		return this.each(function()
		{
			var container 	= $(this),
				images		= $('img', this).css({opacity:0, visibility:'visible', display:'block'}),
				parent = images.parent().addClass('preloading'),
				imageCount = images.length,
				interval = '',
				allImages = images ;
							
			
			var methods = 
			{
				checkImage: function()
				{
					images.each(function(i)
					{
						if(this.complete == true) images = images.not(this);
					});
					
					if(images.length && options.maxLoops >= 0)
					{
						options.maxLoops--;
						setTimeout(methods.checkImage, 500);
					}
					else
					{
						methods.showImages();
					}
				},
				
				showImages: function()
				{
					allImages.each(function(i)
					{
						var currentImage = $(this);
						setTimeout(function()
						{
							methods.showSingleImage(currentImage, i);
						},options.delay * i);
						
						
					});
				},
				
				showSingleImage: function(currentImage, i)
				{
					currentImage.animate({opacity:1}, options.fadeInSpeed, function()
					{
						currentImage.parents().removeClass('preloading');
						if(allImages.length == i+1) 
						{
							methods.callback(i);
						}
					});
				},
				
				callback: function()
				{		
					if (variables instanceof Function) { callback = variables; }
					if (callback  instanceof Function) { callback.call(options.thisData, options.data);  }
				}
			};
			
			if(!images.length) { methods.callback(); return }
			methods.checkImage();

		});
	};
})(jQuery);







function avia_iframe_fix()
{
	var iframe 	= jQuery('.slideshow iframe'),
		youtubeEmbed = jQuery('.slideshow object, .slideshow embed').attr('wmode','opaque');
		
		iframe.each(function()
		{
			var current = jQuery(this),
				src 	= current.attr('src');
			
			if(src)
			{
				if(src.indexOf('?') !== -1)
				{
					src += "&wmode=opaque";
				}
				else
				{
					src += "?wmode=opaque";
				}
				
				current.attr('src', src);
			}
		});
}