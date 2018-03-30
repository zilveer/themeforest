
var iron_vars = window.iron_vars || {}
, IRON = window.IRON || {};

var AudioPlaylists = [];

var isiPad = /ipad/i.test(navigator.userAgent.toLowerCase());
var isMobile = jQuery.browser.mobile;

(function($) {
    "use strict";

    IRON.$ = window.IRON.$ || {};

    IRON.XHR = {
        settings: {
            url: iron_vars.ajaxurl
            , type: 'POST'
        }
    };

    var jcf = window.jcf || {};
    var DocumentTouch = window.DocumentTouch || {};
    var ResponsiveHelper = window.ResponsiveHelper || {};
    var jPlayerPlaylist = window.jPlayerPlaylist || {};
    var PlaceholderInput = window.PlaceholderInput || {};
    var TouchNav = window.TouchNav || {};
    var lib = window.lib || {};

    // page init
    jQuery(function() {


        /* Fancybox overlay fix */
        // detect device type
        var isTouchDevice = (function() {
            try {
                return ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;
            } catch (e) {
                return false;
            }
        }());


        IRON.initFreeWall();
        IRON.initPopups();
        IRON.initInputs();
        IRON.initFitVids();
        IRON.initVideoLinks();
        IRON.initDropDownClasses();
        IRON.initPlayer();
        IRON.initAjaxBlocksLoad();
        IRON.initLightbox();
        IRON.initFacebookLikebox();
        IRON.initTwitter();
		IRON.initSideMenu();
		
		if(iron_vars.header_top_menu_hide_on_scroll == 1)
			IRON.initTopMenu();
			
		IRON.initCircleCentering();
		IRON.initGridDisplayPhoto();
		IRON.initGridDisplayAlbum();
		IRON.initGridDisplayNews();
		IRON.initGridDisplayVideo();
		
		if(!isMobile && !isiPad)
			IRON.initPusherHeight();
			
		IRON.initEventCenter();
		IRON.initTwitterCenter();
		IRON.initHeadsetCenter();
		IRON.initIOSCenter();
		IRON.initCountdownLang();
		IRON.initCountdownCenter();
		IRON.initMenuHierarchy();
		IRON.initSubmenuPosition();
		IRON.initSingleDisco();
		IRON.initNewsletterLabel();
		IRON.initBackToTop();
		IRON.initScrollToSection();
        IRON.initParallax();
		IRON.initDisableHovers();
		IRON.initVcAnimations();
		IRON.initIsotope();
		IRON.initWooImageBack();

        if (iron_vars.enable_fixed_header)
            IRON.initFixedBar();

        if (!isTouchDevice && iron_vars.enable_nice_scroll)
            IRON.initNiceScroll();


		IRON.initCustomJS();	
			
        // fix options
        var supportPositionFixed = !((jQuery.browser.msie && jQuery.browser.version < 8) || isTouchDevice);
        var overlaySelector = '#fancybox-overlay';

        if (supportPositionFixed) {
            // create <style> rules
            var head = document.getElementsByTagName('head')[0],
                    style = document.createElement('style'),
                    rules = document.createTextNode(overlaySelector + '{' +
                            'position:fixed;' +
                            'top:0;' +
                            'left:0;' +
                            '}');

            // append style element
            style.type = 'text/css';
            if (style.styleSheet) {
                style.styleSheet.cssText = rules.nodeValue;
            } else {
                style.appendChild(rules);
            }
            head.appendChild(style);
        }
    });

    jQuery(window).load(function() {
        setTimeout(function() {
            IRON.initSameHeight();
            jQuery(window).trigger('resize');
        }, 200);
    });

    IRON.pagination = {
        XHR: {}
        , $: {}
        , loadingClass: 'ajax-load'
        , ajaxBusy: false
        , isotope: false
    };

    IRON.pagination.XHR = {
        done: function(response, status, xhr) { // success : data, status, xhr

            var IB = IRON.pagination;

            if (response)
            {
            
            	if(IB.isotope) {
	            	var $newItems = $(response);
					IB.$.container.append( $newItems ).isotope( 'addItems', $newItems ).isotope( 'reLayout' );
					IB.$.container.fadeIn();
            	}else{
                	IB.$.container.append(response).fadeIn();
				}
				
				var newMoreButton = IB.$.container.find('.button-more');
				if(newMoreButton.length > 0) {
					IB.$.loadButton.replaceWith(newMoreButton[0].outerHTML );
					newMoreButton.remove();
					IB.$.loadButton = $('.button-more');
					
				}else{
					IB.$.loadButton.remove();
				}


                IB.ajaxBusy = false;

                //IRON.initTouchNav();

                var callbacks = IB.$.loadButton.data('callback');
                if (callbacks) {
                    callbacks = callbacks.split(',');

                    for (var i = 0; i < callbacks.length; i++)
                    {
                        var callback = IRON[callbacks[i]];

                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                }

                if (IB.method == 'paginate_scroll') {

                    $('#pusher').on('scroll', function(event) {
                        if (!IB.ajaxBusy) {
                            var $win = $(this)
                                    , $doc = $(document)
                                    , $foot = $('body > footer');

                            if ($win.scrollTop() >= ($doc.height() - $win.height() - ($foot.height()))) {
                                IB.$.loadButton.click();
                            }
                        }
                    });

                } else {
                    IB.$.loadButton.css('visibility', 'visible').fadeIn();
                }
                
                IRON.initAjaxBlocksLoadEvent();

            } else {

                IB.$.loadButton.remove();
                IB.XHR.fail(xhr, 'error', 404);
            }
        }
        , fail: function(xhr, status, error) { // error : xhr, status, error

            var IB = IRON.pagination;

            setTimeout(function() {
                alert(IB.$.loadButton.data('warning'));
            }, 100);
        }
        , always: function() { // complete : data|xhr, status, xhr|error

            var IB = IRON.pagination;
            IB.$.loadButton.prop('disabled', false);

            IB.$.container.removeClass(IB.loadingClass);

            if (iron_vars.enable_nice_scroll && !jcf.isTouchDevice)
                IRON.niceScroll.resize();
        }
        , before: function(xhr) {

            var IB = IRON.pagination;
            IB.$.loadButton.prop('disabled', true);
        }
    };


    IRON.initFacebookLikebox = function() {
        if ($('#fb-likebox').length === 0) {
            return false;
        }

        var fb_app_id = $('#fb-likebox').data('appid');
        var fb_page_url = $('#fb-likebox').data('pageurl');
        fb_page_url = encodeURI(fb_page_url);

        var iframe = '<iframe src="//www.facebook.com/plugins/likebox.php?href=' + fb_page_url + '&amp;width=200&amp;height=62&amp;show_faces=false&amp;colorscheme=dark&amp;stream=false&amp;border_color&amp;header=false&amp;appId=' + fb_app_id + '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:62px;" allowTransparency="true"></iframe>';

        $('#fb-likebox').html(iframe);
    }


    IRON.initTwitter = function() {

        $('.iron_widget_twitter .query').each(function() {

            var $query = $(this);
            var username = $(this).data('username');

            $(function($) {
                $query.tweet({
                    modpath: iron_vars.theme_url + '/js/twitter/',
                    join_text: 'auto',
                    username: (username ? username : 'envato'),
                    count: 1,
                    auto_join_text_default: '',
                    auto_join_text_ed: '',
                    auto_join_text_ing: '',
                    auto_join_text_reply: '',
                    auto_join_text_url: '',
                    loading_text: 'loading tweets...'
                }).bind('loaded', function() {
                    $(window).resize();
                });
            });

        })
    }

    IRON.initNiceScroll = function() {
        $(document).ready(function() {

			if (isMobile == true || isiPad == true){
				/* Listen to orientation changes and trigger resize */
				window.addEventListener('orientationchange', function(){
					$(window).resize();
				});
			} else {
				IRON.niceScroll = $('#pusher').niceScroll();
			};
        });
    }


    IRON.initFixedBar = function() {

        var top = 0;
        $('#pusher').waypoint(function(direction) {
            if (direction == 'down') {
                $('#fixed-panel').animate({
                    opacity: "1",
                    top: top
                }, 400);
            } else if (direction == 'up') {
                $('#fixed-panel').animate({
                    opacity: "0",
                    top: "-78"
                }, 200);
            }
        }, {
            offset: -1
        });
    }


    IRON.initAjaxBlocksLoad = function() {

        IRON.pagination.XHR.request = {
            dataType: 'text',
            data: {
	            ajax: 1
            },
			beforeSend: IRON.pagination.XHR.before
        };

        IRON.pagination.XHR.request = $.extend(true, IRON.pagination.XHR.request, IRON.XHR.settings);
		IRON.initAjaxBlocksLoadEvent(); 

        $('a.button-more').trigger('click');

    }
    
    IRON.initAjaxBlocksLoadEvent = function() {
	    

		$(document).off('click', 'a.button-more');
        $(document).on('click', 'a.button-more', function(e) {
            e.preventDefault();

            var IB = IRON.pagination
                    , $this = $(this);

			IB.isotope = ($('.isotope-wrap').length > 0);
			
            if (IB.ajaxBusy)
                return;

            IB.$.loadButton = $this;
            IB.$.container = $('#' + IB.$.loadButton.data('rel'));
            IRON.pagination.XHR.request.url = IB.$.loadButton.attr('href');
            IRON.XHR.settings.url = IB.$.loadButton.attr('href');

            IB.method = $this.data('paginate');

            $.ajax(IB.XHR.request)
                    .done(IB.XHR.done)
                    .fail(IB.XHR.fail)
                    .always(IB.XHR.always);
        });	    
    }

    // add classes if item has dropdown
    IRON.initDropDownClasses = function() {
        jQuery('.side-menu #nav li').each(function() {
            var item = jQuery(this);
            var drop = item.find('ul');
            var link = item.find('a').eq(0);
            if (drop.length) {
                item.addClass('has-drop-down');
                if (link.length) {
                    link.addClass('has-drop-down-a');
                }
            }
        });
    }

    IRON.initPlayer = function() {

        jQuery('.player-holder').each(function(ind) {
            var set = jQuery(this);
            var dataUrl = set.attr('data-url-playlist');
            var autoplay = set.attr('data-autoplay');
            var posterImage = set.find('.poster-image');
            var defURl = posterImage.attr('src');
            var titleBox = set.find('.player-title-box');
            var player = set.find('.jp-jplayer');
            var playerBox = set.find('.player-box');
            var uiPlayer = 'jplayer-custom-' + new Date().getMilliseconds() + ind;
            var uiPlayerBox = 'jplayerBox-custom-' + new Date().getMilliseconds() + ind;
            var Playlist = {};

            player.attr('id', uiPlayer);
            playerBox.attr('id', uiPlayerBox);

            jQuery.ajax({
                url: dataUrl,
                type: 'get',
                dataType: 'script',
                success: function() {
                    startPlayer(autoplay);
                }
            });

            function startPlayer(autoplay) {
                Playlist = new jPlayerPlaylist({
                    jPlayer: '#' + uiPlayer,
                    cssSelectorAncestor: '#' + uiPlayerBox
                }, musicPlayList || [], {
                    swfPath: iron_vars.theme_url + '/js/',
                    supplied: 'mp3',
                    wmode: 'window',
                    ready: function() {
                        refreshInfo();
                        if(autoplay) {
	                        playerBox.find('.jp-play').click();
                        }
                        $( '#' + uiPlayer).jPlayer("option", 'loop', true);
                    },
                    play: function() {
                        refreshInfo();
                    }
                });
                
                AudioPlaylists.push(Playlist);


            }

            function refreshInfo() {
                if (Playlist.original.length)
                {
                    if (Playlist.original[Playlist.current].poster) {
                        posterImage.attr('src', Playlist.original[Playlist.current].poster);
                    } else {
                        posterImage.attr('src', defURl);
                    }

                    if (Playlist.original[Playlist.current].title) {
                        titleBox.html(Playlist.original[Playlist.current].title);
                    }
                }
            }
        });
        
        $('.tracks-list li').on('click', function() {
	       	$(this).find('a.jp-playlist-item').click(); 
        });
	
    }
    
    
    IRON.setTracksBuyButtons = function(data) {
	    
	    var tracklist = $('.iron_widget_radio.playlist_enabled .tracks-list');
	    $.each(data, function(trackNum, item) {
		    	
		    tracklist.find('li').eq(trackNum).prepend(item);
		    tracklist.find('li').eq(trackNum).find('.button').fadeIn();
	    });
	
    }


    // handle flexible video size
    IRON.initFitVids = function() {
        jQuery('.video-block').fitVids();
    }


	IRON.initVideoLinks = function() {
		
		$('.link-mode-inline a').off('click');
		$('.link-mode-inline a').on('click', function(e){
		
			e.preventDefault();

			var wrap = $(this).find('.image');
		    var permalink = $(this).attr('href');
		    var wrap_height = wrap.css('height');
		    
    			   
	   		$('.link-mode-inline a').not($(this)).find('.fluid-width-video-wrapper').each(function() {
		
				var parent = $(this).parent();
				$(this).remove();
				
				parent.find('.loader').remove();
				parent.find('.play-button').fadeIn();
				parent.find('img').fadeIn();
				parent.animate({opacity:1}, 1000);
			   	   
			});
			

		    
		    wrap.css('height', wrap_height);
		    wrap.animate({opacity:0});
		    
		    $.ajax({
			   url: permalink,
			   dataType: 'html',
			   type: 'post',
			   data: {ajax:1},
			   success: function(embed) {

			
					wrap.find('.play-button').hide();
					wrap.find('img').hide();
					wrap.append(embed).fitVids();
					wrap.animate({opacity:1}, 1000);
			   } 
			    
		    });
		});
		
		var scrolling = false;
		$('#pusher').on('scrollstart', function() {
			scrolling = true;
		});
		$('#pusher').on('scrollstop', function() {
			scrolling = false;
		});
		
		
		$(window).on('resize', function() {

			if( (window.outerWidth == screen.width) || scrolling) 
				return false;

				
			$('.link-mode-inline a .image').each(function() {
		
				$(this).css('height', '');
			   	   
			});
			$('.link-mode-inline a').not($(this)).find('.fluid-width-video-wrapper').each(function() {
		
				var parent = $(this).parent();
				$(this).remove();
				
				parent.find('.loader').remove();
				parent.find('.play-button').fadeIn();
				parent.find('img').fadeIn();
				parent.animate({opacity:1}, 1000);
			   	   
			});
			
			
		});
		
		$('.link-mode-lightbox a').off('click');
		$('.link-mode-lightbox a').on('click', function(e){
		
			e.preventDefault();
			
		    var wrap = $(this).find('.image');
		    var permalink = $(this).attr('href');
		    var wrap_height = wrap.height();
		    
		    $.ajax({
			   url: permalink,
			   dataType: 'html',
			   type: 'post',
			   data: {ajax:1},
			   success: function(embed) {
				   
					$.fancybox(embed, {
						// fancybox API options
						fitToView: false,
						autoSize: true,
						closeClick: false,
						//openEffect: 'none',
						//closeEffect: 'none'
					}); // fancybox
        
        
			   } 
			   
			    
		    });
		});
	
	}
	
    // popups init
    IRON.initPopups = function() {
        jQuery('.panel').contentPopup({
            mode: 'click',
            popup: '.nav-holder',
            btnOpen: '.opener'
        });
    }

    // clear inputs on focus
    IRON.initInputs = function() {
        PlaceholderInput.replaceByOptions({
            // filter options
            clearInputs: true,
            clearTextareas: true,
            clearPasswords: true,
            skipClass: 'default',
            // input options
            wrapWithElement: false,
            showUntilTyping: false,
            getParentByClass: false,
            placeholderAttr: 'value'
        });
    }

    // align blocks height
    IRON.initSameHeight = function() {
        jQuery('.widget-area.grid-cols').sameHeight({
            elements: '.widget'
            , flexible: true
            , multiLine: true
        });
    }


    // fancybox modal popup init
    IRON.initLightbox = function() {
		var lightboxtransition = iron_vars.lightbox_transition;
        jQuery('a.lightbox, a[rel*="lightbox"]').fancybox({
            padding: 10,
            cyclic: false,
            overlayShow: true,
            overlayOpacity: 0.65,
            overlayColor: '#000000',
            titlePosition: 'inside',
			transitionIn: 'fade',
			transitionOut: 'fade',
			prevEffect : lightboxtransition,
			nextEffect : lightboxtransition
        });
    }
    
    IRON.initFreeWall = function() {


			$(".free-wall").each(function() {
			
				var single_album = $('body').hasClass('single-photo-album');
				var layout = $(this).data('layout');
				var height = parseInt($(this).data('height'));
				
				
				if(single_album || layout == 'show_all') {

					var wall = new freewall($(this));

					var multiplier = 0.69;
				
					var original_height = $(this).height() * multiplier;
					
					wall.reset({
						selector: '.brick',
						gutterX: 1,
						gutterY: 1,
						animate:false,
						onResize: function() {
						
							if(single_album)
								original_height =  wall.container.height();
								
							wall.fitZone();
							
							if(!single_album)
								wall.container.height(original_height);
						}
					});
					if(single_album)
						original_height = wall.container.height();
								
					// caculator width and height for IE7;
					wall.fitWidth();
					
					if(!single_album)
						wall.container.height(original_height);
						
					$(window).resize();
					
				}else{
			
					if(layout != 'window_height' && height != '' && height != 0) {
						var gallery_height = height;
					}else{
						gallery_height = $(window).height();
					}
					
					var wall = new freewall($(this));
					wall.container.height(gallery_height);
					wall.reset({
						selector: '.brick',
						animate: false,
						cellW: 150,
						cellH: 150,
						gutterX: 1,
						gutterY: 1,
						delay: 30,
						onResize: function() {
							wall.refresh($(wall.container).width(), gallery_height);
	
						}
					});
		
					// caculator width and height for IE7;
					wall.fitZone($(wall.container).width(), gallery_height);
					$(window).resize();
				}
			});
		

    }
	
	/* SIDE MENU */
	IRON.initSideMenu = function() {
		/* Variable pour changer si le menu affiche a gauche(lefttype) ou droite(righttype) */
		var typeside = iron_vars.menu_position;
		/* Variable pour changer l'animation du menu (type1,type2,type3) */
		var typeclass = iron_vars.menu_transition;
		jQuery('.site-logo,.menu-toggle,.side-menu,#pusher').addClass(typeside);
		jQuery(".menu-toggle,.alt-menu-toggle").click(function(event) {
			event.preventDefault();
			var timeout = 1;
			if(isMobile || isiPad) {
				IRON.initPusherHeight();
				timeout = 500;
			}

			setTimeout(function() {
				if(typeclass == 'type1' || typeclass == 'type2'){
					setTimeout(function() {
						jQuery('#pusher').addClass(typeclass);
					},50);
					jQuery('.side-menu').addClass('open');
					jQuery('#overlay').css('display', 'block');
					jQuery('.menu-toggle').css('display', 'none');
					jQuery('.site-logo').css('opacity', '0');
					jQuery('.header-top-menu').fadeOut();
				}else{
					jQuery('#pusher').addClass(typeclass);
					jQuery('.side-menu').addClass('open');
					jQuery('#overlay').css('display', 'block');
					jQuery('.menu-toggle').css('display', 'none');
					jQuery('.site-logo').css('opacity', '0');
					jQuery('.header-top-menu').fadeOut();
				}
			}, timeout);

		});
		jQuery("#overlay,.menu-toggle-off").click(function() {
			if(typeclass == 'type1' || typeclass == 'type2'){
				setTimeout(function() {
					jQuery('.side-menu').removeClass('open');
				},50);
				jQuery('#pusher').removeClass(typeclass);
				jQuery('.sub-menu').removeClass('active');
				jQuery('#overlay').css('display', 'none');
				jQuery('.menu-toggle').css('display', 'block');
				jQuery('ul.nav-menu a').css('opacity','1');
				jQuery('.panel-networks').css('opacity','1');
				jQuery('.site-logo').css('opacity', '1');
				jQuery('.nav-menu li a, ul.nav-menu ul a, .nav-menu ul ul a').css('pointer-events','auto');
				jQuery('.header-top-menu').fadeIn();
			}else{
				jQuery('#pusher').removeClass(typeclass);
				jQuery('.side-menu').removeClass('open');
				jQuery('.sub-menu').removeClass('active');
				jQuery('#overlay').css('display', 'none');
				jQuery('.menu-toggle').css('display', 'block');
				jQuery('ul.nav-menu a').css('opacity','1');
				jQuery('.panel-networks').css('opacity','1');
				jQuery('.site-logo').css('opacity', '1');
				jQuery('.nav-menu li a, ul.nav-menu ul a, .nav-menu ul ul a').css('pointer-events','auto');
				jQuery('.header-top-menu').fadeIn();
			}
			
			if(isMobile || isiPad) {
				setTimeout(function() {
					IRON.resetPusherHeight();
				}, 500);	
			}	
		});
		jQuery('.side-menu').css('display','block');
	}
	
	IRON.initTopMenu = function() {
		
		$('#pusher').on('scroll', function() {
		
			if ($(this).scrollTop() >= 400) {
			
		       	jQuery('.header-top-menu').stop().animate({
					top: '-100px',
					opacity:0
				}, 600);
		    }
		    else {
		    
		       	jQuery('.header-top-menu').stop().animate({
					top: '8px',
					opacity: 1
				}, 600);
		    }

		});
			
	}
	
	/* CIRCLE CENTERING */
	IRON.initCircleCentering = function() {
		jQuery(".centering, .circle .wpb_wrapper").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		
		jQuery(window).resize(function(){
			if(jQuery(window).innerWidth() < 660){
				if(jQuery(".circle").length > 0){
					jQuery(".circle").each(function(){
						jQuery(this).closest(".wpb_column").css({
							"float" : "none",
							"margin-left" : "0",
							"width" : "100%"
						});
					})
				}
			} else {
				if(jQuery(".circle").length > 0){
					jQuery(".circle").each(function(){
						jQuery(this).closest(".wpb_column").removeAttr("style")
					})
				}
			}
		});
	}
	
	/* PHOTO ALBUM GRID DISPLAY */
	IRON.initGridDisplayPhoto = function() {
		setTimeout(function() {
		jQuery('.listing-section.photo').each(function(){
			var leftColumnHeight = 0;
			var rightColumnHeight = 0;
			var $articles = jQuery(this).find('.photo-wrap');
			for (var i = 0; i < $articles.length; i++) {
				if (leftColumnHeight > rightColumnHeight) {
					rightColumnHeight += $articles.eq(i).addClass('right').outerHeight(true);
				} else {
					leftColumnHeight += $articles.eq(i).outerHeight(true);
				}
			} 
			jQuery(this).css('visibility','visible')
		});
		},250);
		setTimeout(function() {
			jQuery('.photo-wrap').css('opacity','1');
		},250);
	}
	
	/* MUSIC ALBUM GRID DISPLAY */
	IRON.initGridDisplayAlbum = function() {
		setTimeout(function() {
		jQuery('.two_column_album').each(function(){
			var leftColumnHeight = 0;
			var rightColumnHeight = 0;
			var $articles = jQuery(this).find('.media-block');
			for (var i = 0; i < $articles.length; i++) {
				if (leftColumnHeight > rightColumnHeight) {
					rightColumnHeight += $articles.eq(i).addClass('right').outerHeight(true);
				} else {
					leftColumnHeight += $articles.eq(i).outerHeight(true);
				}
			} 
			jQuery(this).css('visibility','visible')
		});
		},250);
		setTimeout(function() {
			jQuery('.two_column_album .media-block').css('opacity','1');
		},250);
	}
	
	/* NEWS GRID DISPLAY */
	IRON.initGridDisplayNews = function() {
		setTimeout(function() {
		jQuery('.iron_widget_posts, .articles-section').each(function(){
			var leftColumnHeight = 0;
			var rightColumnHeight = 0;
			var $articles = jQuery(this).find('.news-grid-wrap');
			for (var i = 0; i < $articles.length; i++) {
				if (leftColumnHeight > rightColumnHeight) {
					rightColumnHeight += $articles.eq(i).addClass('right').outerHeight(true);
				} else {
					leftColumnHeight += $articles.eq(i).outerHeight(true);
				}
			} 
			jQuery(this).css('visibility','visible')
		});
		},250);
		setTimeout(function() {
			jQuery('.news-grid-wrap').css('opacity','1');
		},250);
	}
	
	/* VIDEO GRID DISPLAY */
	IRON.initGridDisplayVideo = function() {
		setTimeout(function() {
		jQuery('.iron_widget_videos, .listing-section.videos').each(function(){
			var leftColumnHeight = 0;
			var rightColumnHeight = 0;
			var $articles = jQuery(this).find('.videogrid');
			for (var i = 0; i < $articles.length; i++) {
				if (leftColumnHeight > rightColumnHeight) {
					rightColumnHeight += $articles.eq(i).addClass('right').outerHeight(true);
				} else {
					leftColumnHeight += $articles.eq(i).outerHeight(true);
				}
			} 
			jQuery(this).css('visibility','visible')
		});
		},250);
		setTimeout(function() {
			jQuery('.videogrid').css('opacity','1');
		},250);
	}
	
	/* PUSHER FORCED HEIGHT */
	IRON.initPusherHeight = function() {
		var forcedheight = jQuery(window).height();
		jQuery("#pusher").height(forcedheight);
		jQuery(window).on('resize', function(){
			var forcedheight = jQuery(window).height();
			jQuery("#pusher").height(forcedheight);
		});
	}
	
	/* RESET PUSHER HEIGHT */
	IRON.resetPusherHeight = function() {
		jQuery("#pusher").css('height', '100%');
		jQuery(window).off('resize');
	}
	
	/* EVENT WIDGET CENTERING */
	IRON.initEventCenter = function() {
		if(jQuery(window).width() >= 767){
			jQuery(".event-text-wrap, .event-text-wrap-single").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		} else {
			jQuery(".event-text-wrap").css('margin-top',0);
		};
		
		jQuery(window).resize(function(){
			if(jQuery(window).width() >= 767){
				jQuery(".event-text-wrap, .event-text-wrap-single").each(function(){
					var halfheight = (jQuery(this).height())/2;
					jQuery(this).css('margin-top',(-halfheight));
				});
			} else {
				jQuery(".event-text-wrap").css('margin-top',0);
			};
		});
		
		jQuery('.title-row').mouseenter(function(){
			if(jQuery(window).width() >= 767){
				jQuery(".event-text-wrap.btn").each(function(){
					var halfheight = (jQuery(this).height())/2;
					jQuery(this).css('margin-top',(-halfheight));
				});
			} else {
				jQuery(".event-text-wrap.btn").css('margin-top',0);
			};
		});
	}
	
	/* TWITTER WIDGET CENTERING */
	IRON.initTwitterCenter = function() {
		jQuery(".twitter-center").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".twitter-center").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	}
	
	/* HEADSET ICON CENTERING */
	IRON.initHeadsetCenter = function() {
		jQuery(".album-listen").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".album-listen").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	}
	
	/* IOS SLIDER TEXT CENTERING */
	IRON.initIOSCenter = function() {
		jQuery(".iosSlider .slider .item .inner a").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".album-listen").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	}
	
	IRON.initCountdownLang = function() {
		
		if(iron_vars.lang)
			$.countdown.setDefaults($.countdown.regionalOptions[iron_vars.lang]);
		
	}
	
	/* COUNTDOWNS CENTERING */
	IRON.initCountdownCenter = function() {
		jQuery(".countdown-wrap,.event-centering").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".countdown-wrap,.event-centering").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	}
	
	/* MENU HIERARCHY */
	IRON.initMenuHierarchy = function() {
		var menulevel = 0;
		jQuery(".menu-item").each(function(){
			if(jQuery(this).has("ul").length){
				jQuery(this).children(".has-drop-down-a").append("<div class='sub-arrow'><i class='fa fa-angle-right'></i></div>");
			};
		});
		jQuery(".has-drop-down-a").click(function(event) {
			event.preventDefault();
			menulevel = menulevel+1
			jQuery(this).parent('li').parent('ul').children('li').each(function(){
				jQuery(this).children('a').css('opacity','0');
				jQuery(this).children('a').css('pointer-events','none');
				if(menulevel > 0){
					jQuery('.panel-networks').css('opacity','0');
					jQuery('.panel-networks').css('pointer-events','none');
				};
			});
			jQuery(this).next('ul').addClass('active');
		});
		jQuery(".backlist").click(function(event) {
			event.preventDefault();
			menulevel = menulevel-1
			jQuery(this).parent('ul.sub-menu').parent('li').parent('ul').children('li').each(function(){
				jQuery(this).children('a').css('opacity','1');
				jQuery(this).children('a').css('pointer-events','auto');
				if(menulevel == 0){
					jQuery('.panel-networks').css('opacity','1');
					jQuery('.panel-networks').css('pointer-events','auto');
				};
			});
			jQuery(this).parent("ul").removeClass('active');
		});
	}
	
	/* SUB-MENU DYNAMIC POSITIONING */
	IRON.initSubmenuPosition = function() {
		function sidemenuoffset(){
			var menuoffset = jQuery('.nav-menu').offset();
			jQuery('.sub-menu').css('top',menuoffset);
		}
		jQuery(window).resize(function(){
			sidemenuoffset();
		});
		sidemenuoffset();
	}
	
	/* LARGE SINGLE DISCOGRAPHY */
	IRON.initSingleDisco = function() {
		var discocount = $('.two_column_album .media-block').length;
		if(discocount == 1){
			$('.two_column_album .media-block').addClass('single');
		}
	}
	
	/* NEWSLETTER LABEL TRANSFORM */
	IRON.initNewsletterLabel = function() {
		jQuery(".nm_mc_input").each(function(){
			var thelabel = $(this).prev("label").text();
			$(this).attr('placeholder',thelabel);
		});
		$(".nm_mc_form label").css('display','none');
	}
	
	/* DISABLE HOVERS ON MOBILE */
	IRON.initDisableHovers = function() {
		$(document).ready(function() {

			if (isMobile == true || isiPad == true){
				jQuery('.countdown-wrap').css('display','none');
				jQuery('.button-wrap').css('display','none');
				jQuery('.buttons').removeClass('no-touch');
				jQuery('html').removeClass('no-touch');
			};
        });
	}
	
	/* ISOTOPE NEWS GRID */
	IRON.initIsotope = function() {
		$.Isotope.prototype._getCenteredMasonryColumns = function() {
			this.width = this.element.width();
			var parentWidth = this.element.parent().width();
			var colW = this.options.masonry && this.options.masonry.columnWidth || // i.e. options.masonry && options.masonry.columnWidth
			this.$filteredAtoms.outerWidth(true) || // or use the size of the first item
			parentWidth; // if there's no items, use size of container
			var cols = Math.floor(parentWidth / colW);
			cols = Math.max(cols, 1);
			this.masonry.cols = cols; // i.e. this.masonry.cols = ....
			this.masonry.columnWidth = colW; // i.e. this.masonry.columnWidth = ...
		};
		$.Isotope.prototype._masonryReset = function() {
			this.masonry = {}; // layout-specific props
			this._getCenteredMasonryColumns(); // FIXME shouldn't have to call this again
			var i = this.masonry.cols;
			this.masonry.colYs = [];
				while (i--) {
				this.masonry.colYs.push(0);
			}
		};
		$.Isotope.prototype._masonryResizeChanged = function() {
			var prevColCount = this.masonry.cols;
			this._getCenteredMasonryColumns(); // get updated colCount
			return (this.masonry.cols !== prevColCount);
		};
		$.Isotope.prototype._masonryGetContainerSize = function() {
			var unusedCols = 0,
			i = this.masonry.cols;
				while (--i) { // count unused columns
				if (this.masonry.colYs[i] !== 0) {
					break;
				}
				unusedCols++;
			}
			return {
				height: Math.max.apply(Math, this.masonry.colYs),
				width: (this.masonry.cols - unusedCols) * this.masonry.columnWidth // fit container to columns that have been used;
			};
		};
		$('.isotope-wrap').isotope({
		  itemSelector : '.news-grid-wrap'
		});
		setTimeout(function() {
			$('.isotope-wrap').isotope('reloadItems').isotope('reLayout');
		},200);
	}
	
	IRON.initParallax = function (){
		setTimeout(function(){
			$("div.wpb_row.parallax").each(function() {
				var bgimage = $(this).css('background-image');
				if(bgimage && bgimage != '' && bgimage != 'none') {
					if(!( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )) {	
						$(this).parallax("50%", 0.4, false);
						$('.parallax').addClass('enabled');
					}	
					// Parallax Fix for Mobile Devices
					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
						//$(this).css({'background-attachment': 'scroll'});
						$('.parallax').addClass('disabled');
					}
				}
			});		
		},1000);
		
	}
	
	IRON.initBackToTop = function() {
		
		$('#back-to-top, #back-to-top-mobile').on('click', function (e) {
		
			e.preventDefault();
			
			var selector = '#pusher';
			if (isMobile == true || isiPad == true){
				selector = 'html,body';
			}
				
			$(selector).animate({
				scrollTop: 0
			}, 800);
		});
	}
	
	IRON.initScrollToSection = function() {

		var animating = false;
		// Iterate over all nav links, setting the "selected" class as-appropriate.
		$("a[href*='#']").on('click', function(e){
		
			
			if(animating || $(this).hasClass('ui-tabs-anchor'))
				return false;
				
			
		  	var target = $(this).attr('href');
		  	if(target.charAt(0) != '#') {
			  	target = target.split('#');
			  	target = '#'+target[1];
		  	}
		  	if($(target).length > 0) {
		  		e.preventDefault();
		  		animating = true;
		  		
		  		var menu_open = $('.side-menu').hasClass('open');
		  		var timeout = 10;
		  		
		  		if(menu_open) {
		  			$('.side-menu.open .menu-toggle-off').click();
		  			timeout = 400;
		  		}	
		  		
		  		setTimeout(function() {
			  
			  		var top = $(target).position().top;
			  		
			  		var selector = '#pusher';
					if (isMobile == true || isiPad == true){
						selector = 'html,body';
					}
			
			  		animating = true;
			  		$(selector).animate({
						scrollTop: top
					}, 800, function() {
						
						animating = false;
					});
				
		  		}, timeout);
			  	
			  	
		  	}
		  	
		});

	}
	
	IRON.initVcAnimations = function() {
			
		if(navigator.userAgent.match(/iPhone|iPad|iPod/i))
            jQuery('.wpb_animate_when_almost_visible').removeClass('wpb_animate_when_almost_visible');
            	
		var single_album = $('body').hasClass('single-photo-album');

		if(!single_album) {
						
			$('#pusher').on('scroll', function() {
	
				$(window).resize();
	    	
			});
		}		
	}
	
	IRON.initWooImageBack = function (){
		$('.attachment-shop_catalog').each(function() {
			$(this).wrap('<div class="tint"></div>');
		});  
	}
	
	
	IRON.initCustomJS = function() {
		
		if(iron_vars.custom_js != '') {
			eval(iron_vars.custom_js);
		}
		
	}
	
	$(document).ready(function() {
		$(window).resize();
		setTimeout(function() {
			$(window).resize();
			jQuery('header').animate({'opacity': 1});
		},1000);
	});
	
	/* OWL CAROUSEL */
	$(document).ready(function() {
		var owl = $(".vc_col-sm-12 .owl-carousel");
		owl.owlCarousel({
			responsive: {
				1400:{items:7},
				1000:{items:5},
				600:{items:3},
				0:{items:1}
			},
			itemsMobile : false,
			pagination : false,
			rewindNav : true,
			autoplay : true,
			autoplayTimeout : 2000,
			loop: true,
			nav : false
		});
	});
	
	/* Two-third-row */
	$(document).ready(function() {
		var owl = $(".vc_col-sm-8 .owl-carousel");
		owl.owlCarousel({
			responsive: {
				1400:{items:5},
				1000:{items:3},
				600:{items:1},
				0:{items:1}
			},
			itemsMobile : false,
			pagination : false,
			rewindNav : true,
			autoplay : true,
			autoplayTimeout : 2000,
			loop: true,
			nav : false
		});
	});
	
	/* Half-row */
	$(document).ready(function() {
		var owl = $(".vc_col-sm-6 .owl-carousel");
		owl.owlCarousel({
			responsive: {
				1400:{items:3},
				1000:{items:2},
				600:{items:1},
				0:{items:1}
			},
			itemsMobile : false,
			pagination : false,
			rewindNav : true,
			autoplay : true,
			autoplayTimeout : 2000,
			loop: true,
			nav : false
		});
	});
	
	/* Third-row */
	$(document).ready(function() {
		var owl = $(".vc_col-sm-4 .owl-carousel");
		owl.owlCarousel({
			responsive: {
				1400:{items:2},
				1000:{items:2},
				600:{items:1},
				0:{items:1}
			},
			itemsMobile : false,
			pagination : false,
			rewindNav : true,
			autoplay : true,
			autoplayTimeout : 2000,
			loop: true,
			nav : false
		});
	});
	
	/* Fourth-row */
	$(document).ready(function() {
		var owl = $(".vc_col-sm-3 .owl-carousel");
		owl.owlCarousel({
			responsive: {
				1400:{items:1},
				1000:{items:1},
				600:{items:1},
				0:{items:1}
			},
			itemsMobile : false,
			pagination : false,
			rewindNav : true,
			autoplay : true,
			autoplayTimeout : 2000,
			loop: true,
			nav : false
		});
	});
	
	/* Portfolio Owl Carousel */
	$(document).ready(function(){
		//iron_vars.portfolio.slider_arrows
		//iron_vars.portfolio.slider_autoplay
		//iron_vars.portfolio.slider_slide_speed
		//iron_vars.portfolio.slider_stop_hover
		var owlportfolio = $(".portfolio .owl-carousel");
		var itemcount = $('img.item').length;
	
		if(itemcount == 1){
			owlportfolio.owlCarousel({
				items : 1,
				nav : iron_vars.portfolio.slider_arrows,
				navText : ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
				autoplayHoverPause: iron_vars.portfolio.slider_stop_hover,
				autoplay : iron_vars.portfolio.slider_autoplay,
				autoplayTimeout : iron_vars.portfolio.slider_slide_speed,
				loop : false,
				center : true
			});
		}else{
			owlportfolio.owlCarousel({
				items : 1,
				nav : iron_vars.portfolio.slider_arrows,
				navText : ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
				autoplayHoverPause: iron_vars.portfolio.slider_stop_hover,
				autoplay : iron_vars.portfolio.slider_autoplay,
				autoplayTimeout : iron_vars.portfolio.slider_slide_speed,
				loop : true,
				center : true
			});
			if(iron_vars.portfolio.slider_arrows){
				$('.owl-controls').addClass('enabled');
			}
		}
	});
	
	/* Widget Button Hover */
	$(document).ready(function(){
		$('.button-widget').each(function() {
			var initialcolor = $(this).css('color');
			var initialbg = $(this).css('background-color');
			var initialborder = $(this).css('border-color');
			
			$(this).mouseover(function(){
				var bghovercolor = $(this).attr('data-hoverbg');
				var texthovercolor = $(this).attr('data-hovertext');
				var borderhovercolor = $(this).attr('data-hoverborder');
				$(this).css('border-color',borderhovercolor);
				$(this).css('background-color',bghovercolor);
				$(this).css('color',texthovercolor);
			});
			$(this).mouseout(function(){
				$(this).css('border-color',initialborder);
				$(this).css('background-color',initialbg);
				$(this).css('color',initialcolor);
			});
		})
	});
	
	/* Portfolio Button Hover */
	$(document).ready(function(){
		$('.portfolio-button').each(function() {
			var initialcolor = $(this).css('color');
			var initialbg = $(this).css('background-color');
			var initialborder = $(this).css('border-top-color');
			
			$(this).mouseover(function(){
				$(this).css('background-color',initialborder);
				$(this).css('color','#FFF');
			});
			$(this).mouseout(function(){
				$(this).css('background-color',initialbg);
				$(this).css('color',initialcolor);
			});
		})
	});
	
	/* Fit Text - Auto-Resize page titles */
	$(document).ready(function(){
		/*$('.page-title h1, h1.page-title').fitText(1.2,{maxFontSize:'60px'});*/
		$('.fittext h1, .fittext h2, .fittext h3, .fittext h4, .fittext h5, .fittext h6').fitText(1.2,{maxFontSize:'85px'});
	});
	
	/* SUB-MENU ARROW CENTERING */
	$(document).ready(function(){
		jQuery(".sub-arrow i").each(function(){
			var halfheight = (jQuery(this).height())/2;
			jQuery(this).css('margin-top',(-halfheight));
		});
		jQuery(window).resize(function(){
			jQuery(".sub-arrow i").each(function(){
				var halfheight = (jQuery(this).height())/2;
				jQuery(this).css('margin-top',(-halfheight));
			});
		});
	});
	
	/* FOOTER TEXT CENTERING */
	$(document).ready(function(){
		var footerheight = $('.footer-wrapper').height();
		var footertextheight = $('.footer-wrapper .text').height();
		var centeredtext = (footerheight/2)-(footertextheight/2)
		$('.footer-wrapper .text').css('top',centeredtext);
	});
	
	/* MOBILE PARALLAX FIX */
	$(document).ready(function(){
		if (isMobile == true || isiPad == true){

		};
	});
	
	/* BACKTOTOP BUTTON */
	$(document).ready(function(){
		$('#footer').waypoint(function(direction) {
			if (direction == 'down'){
				$('.footer-wrapper-backtotop').addClass('active');
			} else if (direction == 'up'){
				$('.footer-wrapper-backtotop').removeClass('active');
			}
		}, { offset:2000});
		
		/* MOBILE MODE */
		if(isMobile || isiPad){
			$('.footer-wrapper-backtotop').addClass('mobile');
			$('.footer-wrapper-backtotop-mobile').addClass('active');
		}
	});
	
	/* WPML MENU CROP CURRENT LANGUAGE */
	$(document).ready(function(){
		$('.menu-item-language').first().css("display","none");
	});
	
	/* Woocommerce row override
	$(document).ready(function(){
		$('.woocommerce .products').each(function() {
			var thecount = $(this).children("li").length;
			console.log(thecount);
			$(this).parent().removeClass('columns-4');
			switch(thecount) {
				case 1:
					$(this).parent().addClass('columns-1');
					break;
				case 2:
					$(this).parent().addClass('columns-2');
					break;
				case 3:
					$(this).parent().addClass('columns-3');
					break;
				default:
					default $(this).parent().addClass('columns-4');
			} 
		});
	});*/
	
})(jQuery);

