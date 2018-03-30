var fireEvent;
(function(jQuery){
    jQuery(document).ready(function(){		//when DOM is ready
        theme.init();
    });
    jQuery(window).resize(function() {
        clearTimeout(fireEvent);
        fireEvent = setTimeout(theme.resizeEvent, 200);
	});
})(jQuery);
jQuery(window).load(function() {
	jQuery("body").removeClass("preload");
    theme.initGallery();
    theme.initLeftSidebarResponsivePosition();
    theme.initAffixSidebar();
	setTimeout(theme.initVCColumnAffixSidebar, 3000);	//init with 3 sec delay in case of slow loading content
});

var theme = {
	mosaicTimeout: false,
    init: function() {
        
        theme.initComments();
        theme.initMosaic();
        theme.initMobileMenu();
        theme.initSecondaryMenu();
        theme.initMenuAnimation();
        theme.setDropdownMargin();
        theme.initTouchMenu();
        theme.initDropdownPostFilter();
        theme.initWidgetTabs();
        theme.initNewsTicker();
        theme.initScrollTop();
        theme.initOverlays();
        theme.initReviewSummary();
        theme.setFixedMenuAffix();
        theme.initReadProgress();
        theme.initPostNavigation();
        theme.initParticles();
        theme.initTouchClick();
        theme.initMobileCarouselSlide();
        theme.initLeftSidebarResponsivePosition();
        theme.initGalleriesIntroMargin();
        theme.initMenuWidthFix();
        theme.initPostBottomSharrre();
        theme.initPostImageSharrre();
	},
    resizeEvent: function() {
        theme.positionNewStories();
        theme.positionGalleryControls();
        theme.setPostNavigationPosition();
        theme.initLeftSidebarResponsivePosition();
        theme.removeAffixSidebarsIfMobileEntered();
    },
    initComments: function() {
        //form submit
        jQuery('#comment-submit').click(function(){
            jQuery('#hidden-submit').trigger('click');
            return false;
        });
    },
    initMosaic: function() {
        
        if(jQuery('.mosaic').length > 0) 
        {
            theme.setMosaicContentMargin();
            jQuery('.mosaic .title').animate({
                'opacity': 1
            }, 100);
        
            jQuery('.mosaic button').click(function(){

                var mosaic = jQuery(this).parents('.mosaic');
                var page = parseInt(mosaic.attr('data-page')) + 1;
                var max = parseInt(mosaic.attr('data-max'));

                var data = {
                    action: 'mosaic',
                    page: page,
                    category: mosaic.attr('data-category'),
                    tag: mosaic.attr('data-tag')
                };

                jQuery.post(ajax_object.ajaxurl, data, function(response) {
                    mosaic.attr('data-page', page); //update page value

                    mosaic.find('.item').last().after(response.html);
                    mosaic.find('.item.big').filter(':odd').css('float', 'right');
                                        
                    theme.setMosaicContentMargin();
                    jQuery('.mosaic .title').animate({
                        'opacity': 1
                    }, 100);

                    if(page >= max || response.last === true)
                    {
                        mosaic.find('button').hide();
                    }
					
					//reinit affix values
					theme.reInitAffixWrap();
                },
                'json');

                return false;
            });

            if(jQuery('.mosaic').offset().top < 500)
            {
                //hide when dropdown is open
                jQuery('.nav > .menu-item.dropdown').hover(
                    function(){
                    },
                    function(){
                        theme.enableMosaicAfterMenu();
                    }
                );
            }
        }
    },
    setMosaicContentMargin: function(){
        jQuery('.mosaic .intro').each(function(){
            var mosaicintroheight = jQuery(this).outerHeight();
            jQuery(this).css('marginBottom', '-' + mosaicintroheight + 'px');
        });
    },
    initMenuAnimation: function() {
        
        //launch dropdown hover
        jQuery('[data-hover="dropdown"]').dropdownHover();
        
        jQuery('.dropdown').on('show.bs.dropdown', function(e){
                        
            if(jQuery(window).width() < 768 && !jQuery(this).hasClass('new-stories'))
            {
                jQuery('.navbar-wrapper-responsive .menu .nav .search').show();
            }
            
            var menu = jQuery(this).find('.dropdown-menu').first();
            menu.stop(true, true).animate({
                opacity:"toggle",
            }, { duration: 180, queue: false }, 'linear');
            
            if(ajax_object.show_mosaic_overlay === 'on' && menu.length > 0)
            {
                if(jQuery('.mosaic').length > 0 && jQuery('.mosaic').offset().top < 500)
                {
                    jQuery('.mosaic .overlay').animate({
                        'background-color': 'rgba(0, 0, 0, 0.8)'
                    }, { duration: 100, queue: false }, 'linear' );
                    jQuery('.mosaic .title').animate({
                        'opacity': '0.15'
                    }, { duration: 100, queue: false }, 'linear' );
                    
                    window.clearTimeout(theme.mosaicTimeout);
                }
            }
        });

        // ADD SLIDEUP ANIMATION TO DROPDOWN //
        jQuery('.dropdown').on('hide.bs.dropdown', function(e){
            jQuery(this).find('.dropdown-menu').first().fadeOut(180);
            theme.enableMosaicAfterMenu();
            if(jQuery(window).width() < 768)
			{
				jQuery('.navbar-wrapper-responsive .menu .nav .search').fadeOut(180);
			}
        });
        
        //force mosaic enable if mouse leaves menu
        jQuery('.navbar .constellation').hover(function(){
            //do nothing
        },
        function() {
            theme.animateMosaicFadeOut();
            window.clearTimeout(theme.mosaicTimeout);
        });
        
    },
    animateMosaicFadeOut: function() {
        
        jQuery('.mosaic .overlay').css('transition', 'none');
        
        jQuery('.mosaic .overlay').animate({
            'background-color': 'rgba(0, 0, 0, 0)'
        }, { duration: 50, queue: false }, 'linear').promise().done(function(){
            jQuery('.mosaic .overlay').attr('style', '');
        });
        jQuery('.mosaic .title').animate({
            'opacity': '1'
        }, { duration: 50, queue: false }, 'linear');
        
    },
    enableMosaicAfterMenu: function() {
        if(ajax_object.show_mosaic_overlay === 'on')
        {
            window.clearTimeout(theme.mosaicTimeout);

            theme.mosaicTimeout = window.setTimeout(function(){
                theme.animateMosaicFadeOut();
            }, 200);
        }
    },
    initMobileMenu: function(){
        var active = jQuery('#mobile-menu').find('.current-menu-item > a');
        if(active.length > 0 )
        {
            jQuery('.navbar-wrapper-responsive .container > .nav > .active').html(active.outerHTML());
        }
    },
    initSecondaryMenu: function(){
        var primary = jQuery('#menu-primary');
        var secondary = jQuery('.secondary-menu');
        
        //move children to primary menu
        secondary.children().each(function(){
            jQuery(this).clone().appendTo(primary);
        });
                
        //remove the secondary
        secondary.remove();
        
        theme.positionNewStories();
    },
    positionNewStories: function() {
        
        var menu_wrap = jQuery('.navbar-wrapper:not(.navbar-wrapper-responsive) .container').outerWidth();
        var new_stories = jQuery('#menu-primary > .new-stories');
        var others = jQuery('#menu-primary > li').not(new_stories);
        var spacer = jQuery('#menu-primary > .menu-spacer');
        
        new_stories.attr('style', '');
        
        var other_width = 0;
        others.each(function(index) {
            other_width += parseInt(jQuery(this).outerWidth(), 10);
        });

        var diff = menu_wrap - other_width - new_stories.outerWidth() - 20;

        if(diff > 0)
        {
            spacer.css('width', diff);
        }
        
    },
    initTouchMenu: function() {
        if('ontouchstart' in document)
        {
            
            //no dropdown
			jQuery('.navbar-wrapper:not(.navbar-wrapper-responsive) .nav > .menu-item:not(.dropdown) > a').on('touchstart', function(){
				return true;
			});
            
            //first level of dropdowns
            jQuery('.navbar-wrapper:not(.navbar-wrapper-responsive) .nav .menu-item.dropdown .dropdown-toggle').on('touchstart', function(){
                                
                var current_item = jQuery(this);
                //if there are other open menus, hide them
                if(jQuery('.nav .menu-item.dropdown.open .dropdown-toggle').not(this).length > 0)
                {
                    jQuery('.nav .menu-item.dropdown.open').each(function(){
                        if(current_item.parent() !== jQuery(this))
                        {
                            jQuery(this).removeClass('open');
                            jQuery(this).children('.dropdown-toggle').trigger('hide.bs.dropdown');
                        }
                    });
                }
                
                var parent = jQuery(this).parent();
                if(!parent.hasClass('open'))
                {
                    jQuery(this).parent().addClass('open');
                    jQuery(this).trigger('show.bs.dropdown');
                    return false;
                }
                
                //for search and new stories close dropdown, rest follow link
                if(parent.hasClass('open') && ( parent.hasClass('new-stories') || parent.hasClass('search')))
                {
                    jQuery(this).parent().removeClass('open');
                    jQuery(this).trigger('hide.bs.dropdown');
                    return false;
                }
            });
            
            //second level of dropdowns
            jQuery('.navbar-wrapper:not(.navbar-wrapper-responsive) .nav .menu-item.dropdown .dropdown > a').on('touchstart', function(){
              
                var current_item = jQuery(this).parent();
                //if there are other open menus, hide them
                if(jQuery('.nav .menu-item.dropdown .dropdown').not(this).length > 0)
                {
                    jQuery('.nav .menu-item.dropdown .dropdown.open').each(function(){
                        if(current_item.parent() !== jQuery(this))
                        {
                            jQuery(this).removeClass('open');
                        }
                    });
                }
                                
                if(!current_item.hasClass('open'))
                {
                    current_item.addClass('open');
                    return false;
                }
                
            });
            
            
            //close menu
			jQuery('.homepage-content, .header, .footer').on('touchstart', function(){
				var open = jQuery('.navbar-wrapper:not(.navbar-wrapper-responsive) .nav .menu-item.dropdown.open');
				if(open.length > 0)
				{
					open.removeClass('open');
                    open.trigger('hide.bs.dropdown');
				}
			});			
            
        }
    },
    initDropdownPostFilter: function() {
        
        jQuery('.dropdown-menu .item').click(function(e){
            e.stopPropagation();
        });
        
        jQuery('.dropdown-category-posts .items').hide();
        jQuery('.dropdown-category-posts').each(function(){
			jQuery(this).find('.items').first().show();
		});
        
        jQuery('.dropdown-menu .tags a').click(function(){
            
            var href = jQuery(this).attr('href');
            jQuery(this).siblings().removeClass('active');
            jQuery(this).addClass('active');
            
            var items = jQuery(href);
            if(typeof items != 'undefined')
            {
                jQuery(this).parents('.dropdown-menu').find('.items').hide();                
                items.css('display', 'table');
                theme.setDropdownMarginSpecific(items.find('.intro'));
            }
            
            return false;
        });
    },
    setDropdownMargin: function() {
        jQuery('.menu .dropdown-menu .items .intro').each(function(){
            
            var parent = jQuery(this).parents('.menu .dropdown-menu');
            parent.css({
                position:   'absolute', // Optional if #myDiv is already absolute
                visibility: 'hidden',
                display:    'block'
            });
            
            var dropdownintroheight = jQuery(this).outerHeight();
            parent.attr('style', '');
            jQuery(this).css('marginBottom', '-' + dropdownintroheight + 'px');
        });
    },
    setDropdownMarginSpecific: function(items) {
        items.each(function(){
            var dropdownintroheight = jQuery(this).outerHeight();
            jQuery(this).css('marginBottom', '-' + dropdownintroheight + 'px');
        });
    },
    initWidgetTabs: function() {
        jQuery('.switchable-tabs .title-default a').click(function(){
            var parent = jQuery(this).parents('.switchable-tabs');
            var index = parent.find('.title-default a').index(jQuery(this));
            parent.find('.title-default a').removeClass('active');
            jQuery(this).addClass('active');
            parent.find('.tabs-content .items').fadeOut(250).promise().done(function(){
                parent.find('.tabs-content .items').eq(index).fadeIn(250);
            });
            
            return false;
        });
    },
    initNewsTicker: function() {
                
        jQuery('.trending .pause').click(function(){
        
            if(jQuery('.trending .pause').hasClass('active'))
            {
                jQuery('#newsticker').cycle('resume');
                jQuery('.trending .pause').removeClass('active');
            }
            else
            {
                jQuery('#newsticker').cycle('pause');
                jQuery('.trending .pause').addClass('active');
            }
            
            return false;
        });
        
        //adjust width
        var title_width = jQuery('.trending > .title-default > a').width() ;
        jQuery('.trending .items').css('marginLeft', title_width+19);
        
        jQuery('.trending').hover(function(){
            jQuery('.trending .items').css('marginLeft', title_width+80);
            jQuery('.trending .controls').css('left', title_width+15);
        },
        function(){
            jQuery('.trending .items').css('marginLeft', title_width+19);
        });
    },
    initScrollTop: function() {
        //show the back to top button
        var offset = 220;
        var duration = 500;
        jQuery(window).scroll(function() {
			
			if(jQuery(window).outerWidth()+15 >= 970) { 
								
				if (jQuery(this).scrollTop() > offset) {
					jQuery('.back-to-top').fadeIn(duration);
				} else {
					jQuery('.back-to-top').fadeOut(duration);
				}
			}
            
        });
        
        //to the scrolling
        jQuery('.back-to-top').click(function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, duration);
            return false;
        });
    },
    loadOverlay: function(obj){
        if(obj.parents('.navbar').length > 0) { return false; }
        if(jQuery(window).outerWidth()+15 <= 970) { return false; }
        if(jQuery('html').hasClass('touch')) { return false; }
                
        //remove ALL others
        jQuery('.post-item-overlay').remove();

        var long_text = obj.attr('data-overlay-excerpt');
        var overlay = obj.clone();
        var url = obj.attr('data-overlay-url');
        overlay.addClass('post-item-overlay');

        var position = obj.position();
        if(obj.parents('.wpb_tabs').length > 0)
        {
            var top = position.top - (22 - (parseInt(obj.css('marginTop')) + parseInt(obj.css('paddingTop')))) + parseInt(obj.css('borderTopWidth')); //there is 20px margin for overlay
            var left = position.left - (22 - (parseInt(obj.css('marginLeft')) + parseInt(obj.css('paddingLeft')))); //there is 20px margin for overlay
            var padding = 40;
        }
        else if(obj.parents('.carousel-inner').length > 0)
        {
            var top = position.top + 3;
            var left = position.left - 22;
            var padding = 44;
        }
        else
        {
            var top = position.top - (20 - (parseInt(obj.css('marginTop')) + parseInt(obj.css('paddingTop')))) + parseInt(obj.css('borderTopWidth')); //there is 20px margin for overlay
            var left = position.left - (20 - (parseInt(obj.css('marginLeft')) + parseInt(obj.css('paddingLeft')))); //there is 20px margin for overlay
            var padding = 40;
        }

                
        overlay.attr('style', ''); //reset style tag
        overlay.css({ top: top, left: left });
        overlay.width(obj.width() + padding);

        var more = '<a href="' + url + '" class="more-link">' + ajax_object.readmore + '</a>';

        var intro = overlay.find('.post-intro, .intro');
        if(intro.length === 0)
        {
            var title = overlay.find('.title');
            if(title.lenght > 0)
            {
                title.after('<div class="intro">' + long_text + '</div>');
            }
            else
            {
                overlay.append('<div class="intro">' + long_text + '</div>');
            }
        }
        else
        {
            intro.text(long_text);
        }

        overlay.find('.post-intro, .intro').append(more);
        overlay.appendTo(obj.parents('.items').parent()).fadeIn(150); //1 level above .items
    },
    initOverlays: function() {
        
        if(ajax_object.show_post_quick_view === 'on')
        {
            jQuery('[data-overlay="1"]').hoverIntent({
                over: function(){
                    theme.loadOverlay(jQuery(this));
                },
                out: function(){

                },
                interval: 80
            });

            jQuery('.post-block-1, .post-block-2, .post-block-3, .widget-tabs, .slider-tabs').on('mouseleave', '.post-item-overlay', function(){
                jQuery(this).fadeOut(150).promise().done(function(){
                    jQuery(this).remove();
                });
            });
        }
    },
    initGallery: function() {
        if(jQuery('body').hasClass('single-gallery')) {
            
            jQuery('.gallery-item-open .gallery-slideshow').on('cycle-post-initialize', function(){
                theme.positionGalleryControls();
            });
            jQuery('.gallery-item-open .gallery-slideshow').cycle();
        }
    },
    positionGalleryControls: function() {
        
        if(jQuery('body').hasClass('single-gallery')) {
            var height = 0;
            jQuery('.gallery-slideshow .image img').each(function(){
                if(jQuery(this).height() > height)
                {
                    height = jQuery(this).height();
                }
            });
            var marginTop = height / 2;
            jQuery('.gallery-item-open .control').css('margin-top', marginTop - 50);
        }
    },
    initReviewSummary: function() {        
        jQuery('.overview .rating').bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
            if (isInView === true) {
                
                var bar_w = jQuery(this).find('.content span').width();
                
                jQuery(this).find('.content s').each(function(){
                    var percent = jQuery(this).attr('data-value');
                    var add_width = ((percent*bar_w)/100)+'px';
                    jQuery(this).animate({
                        'width': '+=' + add_width 
                    }, 1000, 'easeInQuart');
                });
                jQuery(this).unbind('inview');
            }
        });  
    },
    setFixedMenuAffix: function() {
        if(!jQuery('html').hasClass('touch'))
        {
            jQuery('.navbar-wrapper').affix({
                offset: {
                  top: jQuery('.trending').outerHeight(true) + jQuery('.header').outerHeight(true)
                }
            });
        }
    },
    initReadProgress: function() {
        var bar = jQuery('.read-progress');
        if(bar.length > 0)
        {
            theme.setReadProgress();
            
            jQuery(window).scroll(function(){
                theme.setReadProgress();
            });
        }
    },
    setReadProgress: function() {
        var bar = jQuery('.read-progress');
        if(bar.length > 0)
        {
            var post = jQuery('.main-content-column-1 > .post');            
            var progress = (jQuery(window).scrollTop() + jQuery(window).height() - post.offset().top) / post.outerHeight(true) * 100;
            bar.children('span').width(progress + '%');
        }
    },
    initPostNavigation: function() {
        if(jQuery('body').hasClass('single') || jQuery('body').hasClass('page')) {
            
            if(jQuery('.post-1-navbar').length > 0)
            {
                var sections = jQuery('[data-text-section="true"]');
                if(sections.length > 0)
                {
                    var items = '';
                    sections.each(function(){
                        jQuery(this);
                        items = items + '<li><a href="#' + jQuery(this).attr('id') + '">' + jQuery(this).attr('data-title') + '</a></li>';
                    });
                    
                    jQuery('.post-1-navbar > ul').prepend(items);
                }
                else
                {
                    var item = '<li><a href="#intro">' + ajax_object.article  + '</a></li>';
                    jQuery('.post-1-navbar > ul').prepend(item);
                }
                
                jQuery('body').scrollspy({ target: '.post-1-navbar', offset: 45 });
                theme.setPostNavigationPosition();
                
                jQuery('.post-1-navbar > ul > li').first().addClass('active');
                
                jQuery('.post-1-navbar a').click(function(){
                    var selector = jQuery(this).attr('href');
                    jQuery('html, body').animate({ scrollTop: jQuery(selector).offset().top - 45}, 500); 
                    return false;
                });
                
            }
        }
    },
    setPostNavigationPosition: function() {
        if(jQuery('body').hasClass('single') || jQuery('body').hasClass('page')) {
            
            if(jQuery('.post-1-navbar').length > 0)
            {
                if(jQuery(window).width() > 1320)
                {
                    //position of main title
                    var top_postion = jQuery('.main-content-column-1').offset().top; 
                    var menu_height = 30;

                    jQuery('.post-1-navbar').css('top', top_postion);

                    jQuery('.post-1-navbar').affix({
                        offset: {
                            top: top_postion-menu_height,
                            bottom: function () {
                                return (this.bottom = jQuery('.footer').outerHeight(true));
                            }
                        }
                    });
                }
                else
                {
                    jQuery('.post-1-navbar').attr('style', '');
                }
                
            }
        }
    },
    initParticles: function() {
        //only for large screens
        if(jQuery('#particles').length > 0 && jQuery(window).width() > 970)
        {
            jQuery('#particles').particleground({
                dotColor: ajax_object.particle_color,
                lineColor: ajax_object.particle_color,
                parallax: false,
                particleRadius: 6,
                minSpeedX: 1,
                minSpeedY: 1,
                maxSpeedX: 2,
                maxSpeedY: 2
            });

            jQuery(window).scroll(function() {
                if(jQuery(window).width() > 970)
                {
                    jQuery('#particles').particleground('start').delay(10).particleground('pause');
                }
            });
        }
    },
    initTouchClick: function() {
        if (jQuery('html').hasClass('touch'))   //this needs to work also on touch laptops
        {
            jQuery('.touch-click').click(function(){
                var closest_link = jQuery(this).find('a').eq(0).attr('href');
                if(typeof closest_link !== "undefined")
                {
                    window.location = closest_link;
                }
            });
        }
    },
    initMobileCarouselSlide: function() {
        if (jQuery('html').hasClass('touch'))   //this needs to work also on touch laptops
        {
            jQuery('.carousel').carousel();//it just needs the JS re-initialize action
        }
    },
    initLeftSidebarResponsivePosition: function() {
        if(jQuery('body.single-post .main-sidebar, body.page .main-sidebar, body.blog .main-sidebar, body.archive .main-sidebar').length > 0 && jQuery('.main-sidebar').hasClass('left'))
        {
            if(jQuery(window).width() < 970-15)
            {
                //reset it this is the second run
                jQuery('.main-sidebar').attr('style', '');
                jQuery('.main-content-column-1').attr('style', '');
                
                var blog_h = jQuery('.main-content-column-1').outerHeight();
                var featured_h = 0;
                if(jQuery('.post-block-3.featured').length > 0)
                {
                    featured_h = jQuery('.post-block-3.featured').outerHeight();
                }
                
                var limited_w_img = 0;
                if(jQuery('.image.limited-width').length > 0)
                {
                    limited_w_img = jQuery('.image.limited-width').outerHeight();
                }
                
                var sidebar_h = jQuery('.main-sidebar').outerHeight();
                jQuery('.main-sidebar').css({ position: 'absolute', top: blog_h + featured_h + limited_w_img + 30 });
                
                jQuery('.main-content-column-1').css({
                   'padding-bottom': sidebar_h
                });
            }
            else
            {
                jQuery('.main-sidebar').attr('style', '');
                jQuery('.main-content-column-1').attr('style', '');
            }
        }
    },
    initGalleriesIntroMargin: function() {
        jQuery('.latest-galleries .gallery-item .intro').each(function(){
            var mosaicintroheight = jQuery(this).outerHeight();
            if(mosaicintroheight > 0)
            {
                jQuery(this).css('marginBottom', '-' + mosaicintroheight + 'px');
            }
        });
    },
    initAffixSidebar: function() {
        if(ajax_object.enable_sidebar_affix === 'on')
        {
            if(jQuery('.main-sidebar').length > 0 && jQuery(window).width() > 970-15)
            {
                var main_content = jQuery('.main-content-column-1');
                var sidebar = jQuery('.main-sidebar');
				var menu_offset = 0;
				if(jQuery('html').hasClass('no-touch'))
				{
					menu_offset = 38; //height of affixed menu
				}

                if(main_content.outerHeight() > sidebar.outerHeight())
                {
                    
                    jQuery('.main-sidebar').wrapInner('<div class="sidebar-affix-wrap affix-top"></div>');

                    jQuery('.sidebar-affix-wrap').affix({
                        offset: {
                            top: jQuery('.main-sidebar').offset().top - menu_offset,
                            bottom: function () {
                                return (this.bottom = jQuery('.footer').outerHeight(true) + jQuery('.copyright').outerHeight(true) + 30)
                            }
                        }
                    });
                }
            }
        }
    },
    initVCColumnAffixSidebar: function() {
        if(ajax_object.enable_sidebar_affix === 'on')
        {
            if(jQuery('.wpb_widgetised_column').length > 0 && jQuery(window).width() > 970-15)
            {
                jQuery('.wpb_widgetised_column').each(function(){

                    var widget_column = jQuery(this);
					var menu_offset = 0;
					if(jQuery('html').hasClass('no-touch'))
					{
						menu_offset = 38; //height of affixed menu
					}
					
                    var parent = jQuery(this).parents('.vc_col-sm-4');
                    if(parent.length > 0)
                    {
                        var content_column = parent.siblings('.vc_column_container');

                        if(content_column.outerHeight(true) > parent.outerHeight(true))
                        {
                            widget_column.wrapInner('<div class="sidebar-affix-wrap affix-top"></div>');
                            jQuery('.sidebar-affix-wrap').affix({
                                offset: {
                                    top: widget_column.offset().top - menu_offset,
                                    bottom: (jQuery(document).height() - content_column.outerHeight(true) - content_column.offset().top)
                                }
                            });
                        }
                    }
                });
            }
        }
    },
    removeAffixSidebarsIfMobileEntered: function() {
        if(jQuery(window).width() < 970-15)
        {
            if(jQuery('.sidebar-affix-wrap').length > 0 )
            {
               jQuery('.sidebar-affix-wrap').children().first().unwrap();
            }
        }
    },
	reInitAffixWrap: function() {
		if(jQuery('.sidebar-affix-wrap').length > 0 )
		{
		   jQuery('.sidebar-affix-wrap').children().first().unwrap();
		   theme.initVCColumnAffixSidebar();
		}
	},
    initMenuWidthFix: function() {
        var menu = jQuery('#menu-primary');
        if(menu.width() > 970)
        {
            var width = menu.width();
            while(width > 970)
            {
                menu.children().last().remove();
                width = menu.width();
            }
        }
    },
    initPostBottomSharrre: function() {
       	
        setTimeout(function(){ 
            jQuery('.sharrre-pinterest').sharrre({
                share: {
                  pinterest: true
                },
                enableHover: false,
                enableTracking: false,
                urlCurl: ajax_object.ajaxurl + '?action=sharrre',
                click: function(api, options){
                  api.simulateClick();
                  api.openPopup('pinterest');
                }
            });
        
        }, 500);
        
        setTimeout(function(){ 
            jQuery('.sharrre-twitter').sharrre({
                share: {
                  twitter: true
                },
                enableHover: false,
                enableTracking: false,
                enableCounter: false,
                buttons: { },
                template: '<div class="box"><a class="count" href="#">0</a><a class="share" href="#"><span>' + 'Twitter' + '</span></a></div>',
                render: function(api, options){
                    jQuery(api.element).append(options.template);
                },
                click: function(api, options){
                  api.simulateClick();
                  api.openPopup('twitter');
                }
            });
        }, 100);

        setTimeout(function(){ 
            jQuery('.sharrre-googleplus').sharrre({
                share: {
                  googlePlus: true
                },
                enableHover: false,
                enableTracking: true,
                urlCurl: ajax_object.ajaxurl + '?action=sharrre',
                click: function(api, options){
                  api.simulateClick();
                  api.openPopup('googlePlus');
                }
            });
        }, 400);
        
        setTimeout(function(){ 
            jQuery('.sharrre-linkedin').sharrre({
                share: {
                  linkedin: true
                },
                enableHover: false,
                enableTracking: false,
                click: function(api, options){
                  api.simulateClick();
                  api.openPopup('linkedin');
                }
            });
        }, 100);
        
        setTimeout(function(){ 
            jQuery('.sharrre-facebook').sharrre({
                share: {
                  facebook: true
                },
                enableHover: false,
                enableTracking: false,
                click: function(api, options){
                  api.simulateClick();
                  api.openPopup('facebook');
                }
            });
        }, 300);
    },
    initPostImageSharrre: function() {
		
        jQuery('.shareme').sharrre({
            share: {
                twitter: true,
                facebook: true,
                googlePlus: true,
                pinterest: true,
                linkedin: true
            },
            template: '<div class="box"><div class="left"><strong>{total}</strong> shares</div><div class="right"><a href="#" class="sharrre-facebook"><i class="fa fa-facebook-square"></i></a><a href="#" class="sharrre-twitter"><i class="fa fa-twitter-square"></i></a><a href="#" class="sharrre-googleplus"><i class="fa fa-google-plus-square"></i></a><a href="#" class="sharrre-pinterest"><i class="fa fa-pinterest-square"></i></a><a href="#" class="sharrre-linkedin"><i class="fa fa-linkedin-square"></i></a></div></div>',
            enableHover: false,
            enableTracking: true,
            urlCurl: ajax_object.ajaxurl + '?action=sharrre',
			buttons: { pinterest: { media: jQuery('.shareme').data('image'), description: jQuery('.shareme').data('text') } },
            render: function(api, options){
                jQuery(api.element).on('click', '.sharrre-twitter', function() {
                  api.openPopup('twitter');
                });
                jQuery(api.element).on('click', '.sharrre-facebook', function() {
                  api.openPopup('facebook');
                });
                jQuery(api.element).on('click', '.sharrre-googleplus', function() {
                  api.openPopup('googlePlus');
                });
                jQuery(api.element).on('click', '.sharrre-pinterest', function() {
					api.openPopup('pinterest');	  
                });
                jQuery(api.element).on('click', '.sharrre-linkedin', function() {
                  api.openPopup('linkedin');
                });
            }
        });
    }
};

function chunk (arr, len) {

  var chunks = [],
      i = 0,
      n = arr.length;

  while (i < n) {
    chunks.push(arr.slice(i, i += len));
  }

  return chunks;
}
jQuery.fn.outerHTML = function() {
  return jQuery('<div />').append(this.eq(0).clone()).html();
};