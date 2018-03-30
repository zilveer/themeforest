/*
	Alive Custom Javascript
	Author: Spacehead Concepts (http://www.spaceheadconcepts.com)
*/

(function ($) {
    // Prepare our Variables
    var
    	History = window.History,
        document = window.document,
        iePresent = false;

    // Check to see if History.js is enabled for our Browser
    if (!History.enabled) {
        return false;
    }
	
	function getInternetExplorerVersion() {
	    var rv = -1; // Return value assumes failure.
	    if (navigator.appName == 'Microsoft Internet Explorer') {
	        var ua = navigator.userAgent;
	        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	        if (re.exec(ua) != null)
	            rv = parseFloat(RegExp.$1);
	    }
	    return rv;
	}


	function checkVersion() {

	    var ver = getInternetExplorerVersion();
	    if (ver == -1) return;
	    if (ver <= 9.0) {
	        iePresent = true;
	    }
	}

	checkVersion();
	
		
	if(iePresent) {
		$('head').append('<link rel="stylesheet" href="'+ themeURL +'/css/ie.css" type="text/css" />');
	}
	
	//v1.0.2
	function setCharAt(str,index,chr) {
    	if(index > str.length-1) return str;
    	return str.substr(0,index) + chr + str.substr(index+1);
	}


	if(iePresent) {
		if(window.location.hash) {
				
			var ieUrl = window.location.toString();
			var ieHash = window.location.hash;
			var ieCount = ieUrl.indexOf('#');
			
			if(ieCount > 0 && ieHash.indexOf('/') > 0) {
				ieUrl = setCharAt(ieUrl, ieCount, '');
				window.location = ieUrl;
			}
		}
	}
	//end v1.0.2


    $(document).ready(function () {

        var widthRef;
        var tileArray = new Array();
        var pageArray = new Array();
        var currentTile;
        //var contentLeftPos = $("#contentWrapper").css("top");
        var interval;
		var currentURL = window.location.toString();
		var isHomePage = true;
		var bookmarked = false;
		
		
        // Prepare Variables
        
        var /* Application Specific Variables */
        contentSelector = '#contentWrapper #content',
            $content = $(contentSelector).filter(':first'),
            contentNode = $content.get(0),
			$menu = $('#tileBlock').filter(':first'),
			activeClass = 'highlight',
			activeSelector = '.highlight',
			menuChildrenSelector = '.tile',
            
            /* Application Generic Variables */
            $body = $(document.body),
            rootUrl = History.getRootUrl();
            
        // Ensure Content
        if ($content.length === 0) {
            $content = $body;
        }
		
		// Internal Helper
		$.expr[':'].internal = function(obj, index, meta, stack){
			// Prepare
			var
				$this = $(obj),
				url = $this.attr('href')||'',
				isInternalLink;
			
			// Check link
			isInternalLink = url.substring(0,rootUrl.length) === rootUrl || url.indexOf(':') === -1;
			
			// Ignore or Keep
			return isInternalLink;
		};


        // HTML Helper
        var documentHtml = function (html) {
                // Prepare
                var result = String(html).replace(/<\!DOCTYPE[^>]*>/i, '').replace(/<(html|head|body|title|meta|script)([\s\>])/gi, '<div class="document-$1"$2').replace(/<\/(html|head|body|title|meta|script)\>/gi, '</div>');

                // Return
                return result;
            };

        // External Link Helper
        $.fn.externalLinks = function () {
            // Prepare
            var $this = $(this);

            // Find external links and add external class
            $this.find('a').each(function (index, obj) {

                var url = $(obj).attr('href') || '';
                
                if (url.substring(0, rootUrl.length) !== rootUrl && url.indexOf(':') !== -1) {
                    if (!$(obj).hasClass("external") && !$(obj).hasClass("_video")) $(obj).addClass("external");
                }
            });
            // Chain
            return $this;
        };
        
        // Ajaxify Helper
		$.fn.ajaxify = function(){
			// Prepare
			var $this = $(this);
			
			// Ajaxify
			$this.find('#contentWrapper #content a:internal:not(.external, ._image, ._video, .readMore, .postClose)').click(function(event){
				// Prepare
				var
					$this = $(this),
					url = $this.attr('href'),
					title = $this.attr('title')||null;
				
				// Continue as normal for cmd clicks etc
				if ( event.which == 2 || event.metaKey ) { return true; }
				
				
				if(url.indexOf('#') != -1 && iePresent) {
					return false;
				}	
				
				// Ajaxify this link
				History.pushState(null,title,url);
				event.preventDefault();
				return false;
			});
			
			// Chain
			return $this;
		};
		
        // Hook into State Changes
        $(window).bind('statechange', function () {
            // Prepare Variables
            var
            State = History.getState(),
                url = State.url,
                relativeUrl = url.replace(rootUrl, '');

            // Set Loading
			
			
            // Start Fade Out
            // Animating to opacity to 0 still keeps the element's height intact
            // Which prevents that annoying pop bang issue when loading in new content
            
            if(!isCurrentUrlHomePage(url)) {
            	$("html, body").animate({
                    scrollTop: 0
                }, tileSlideSpeed);
                	
            }
            
            
	
       		var $newContent;
       		if(iePresent) {
       			$newContent = $("#content, #content .pageHeading");
       		} else {
       			$newContent = $content;
       		}
            $newContent.animate({
                opacity: 0
            }, {
                duration: pageFadeSpeed,
                easing: pageEase,
                queue: true,
                complete: function () {
                    $("#contentWrapper #ajaxloader").show();


                    // Ajax Request the Traditional Page
                    $.ajax({
                        url: url,
                        success: function (data, textStatus, jqXHR) {
                            // Prepare
                            var
                            $data = $(documentHtml(data)),
                                $dataBody = $data.find('.document-body:first'),
                                $dataContent = $dataBody.find(contentSelector).filter(':first'),
                                contentHtml, $scripts;
							
							
							
							// Fetch the scripts
							$scripts = $dataContent.find('.document-script');
							if ( $scripts.length ) {
								$scripts.detach();
							}
														
							
                            // Fetch the content
                            contentHtml = $dataContent.html() || $data.html();
                            if (!contentHtml) {
                                document.location.href = url;
                                return false;
                            }
							
                            // Update the content
                            $("#contentWrapper #ajaxloader").hide();
                           
                            $content.html(contentHtml).externalLinks().animate({
                                opacity: 1
                            }, {
                                duration: pageFadeSpeed,
                                easing: pageEase,
                                queue: true
                            });
                            
                            // Bind custom scripts to new content
                            bindScripts();
                            
                            // Add the scripts
							$scripts.each(function(){
								var $script = $(this), scriptText = $script.text(), scriptNode = document.createElement('script');
								if(iePresent) {
									scriptNode.text = scriptText;
									var headNode = document.getElementsByTagName('head')[0];
									headNode.appendChild(scriptNode);
								} else {
									scriptNode.appendChild(document.createTextNode(scriptText));
									contentNode.appendChild(scriptNode);
								}
								
							});
							
							if($.isFunction($.bindWoocommerce)) {
								$.bindWoocommerce();
							}
						
                            // Update the title
                            document.title = $data.find('.document-title:first').text();
                            try {
                                document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<', '&lt;').replace('>', '&gt;').replace(' & ', ' &amp; ');
                            } catch (Exception) {}

                            // Inform Google Analytics of the change
                            if (typeof _gaq !== 'undefined') {
                                _gaq.push(['_trackPageview', relativeUrl]); 
                            }

                            
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            document.location.href = url;
                            return false;
                        }
                    }); // end ajax
                }
            });
            
        }); // end onStateChange
        $("#wrapper").hide().css({
            "opacity": 0
        });

		$("#contentWrapper").prepend('<div id="ajaxloader"><div id="ajaxloader-logo"></div></div>').css({'opacity' : 0});
        $("#contentWrapper #ajaxloader").hide();

        function Tile(element, index) {
            this.element = element; //DOM element entire tile
            this.content = $(this.element).find(".tileContent"); //DOM element tile content
            this.heading = $(this.element).find(".tileHeading"); //DOM element tile heading
            this.link = $(this.element).find(".main").find("a");
            this.position = 0; //0 : top, 1 : middle, 2 : bottom
            this.size = 0; //0 : home, 1 : nav
            this.index = index;
            this.submenu = null;
            this.submenuDisplay = false;

            this.isHighlight = function () {
                return $(this.element).hasClass("highlight");
            }

            this.setHighlight = function () {
                $(this.element).addClass("highlight");
            }

            this.removeHighlight = function () {
                $(this.element).removeClass("highlight");
             
            }

            this.headingHeight = function () {
                var h = this.heading.outerHeight(true);
                return h;
            };

            this.nextPosition = function () {
                this.position++;
                if (this.position > 2) {
                    this.position = 0;
                }
            };

            this.midPosition = function () {
                this.position = 1;
            }

            this.hover = function () {
                var h = this.tileHeight();
                var p = h / 2 + h * 0.1 - this.headingHeight();
                return p;
            };

            this.top = function () {
                var h = this.tileHeight() / 2;
                var t = h * this.position - this.headingHeight();
                return t;
            };

            this.tileTop = function () {
                var t = $(this.element).css("top");
                return t;
            };

            this.tileLeft = function () {
                var l = $(this.element).css("left");
                return l;
            };

            this.tileHeight = function () {
                var h;
                if (this.size == 0) {
                    h = tileLarge;
                } else {
                    h = tileSmall;
                }
                return h;
            };


            this.toggleSubmenu = function () {
                var tile = this;
                if (this.submenuDisplay == false) {
                    //do show submenu 
                    if (tile.submenu != null) {
                        tile.submenuDisplay = true;
                        $(tile.element).find(".main").animate({
                            "opacity": 0
                        }, {
                            duration: tileSlideSpeed,
                            queue: true,
                            complete: function () {
                                $(this).hide();
                                $(tile.submenu).show();
                                $(tile.submenu).animate({
                                    "opacity": 1
                                }, {
                                    duration: tileSlideSpeed,
                                    complete: function () {
                                        $(tile.element).on('mousemove.submenu', function (e) {
                                            var top = (($(this).offset().top - $("#wrapper").scrollTop() - e.pageY) * ($(tile.submenu).outerHeight(true) - tileSmall) / tileSmall);

                                            $(tile.submenu).stop().animate({
                                                'top': top
                                            }, {
                                                duration: 150
                                            });
                                        });
                                    }
                                });

                            }
                        });
                    }
                } else {
                    //do hide function
                    tile.submenuDisplay = false;
                    if (tile.submenu != null) {
                        $(tile.element).off('mousemove.submenu');
                        $(tile.submenu).find("a").each(function () {
                            $(this).removeClass("active");

                        });


                        $(tile.submenu).animate({
                            "opacity": 0
                        }, {
                            duration: tileSlideSpeed,
                            queue: true,
                            complete: function () {

                                $(this).hide();
                                $(this).css({
                                    "top": 0
                                });
                                $(tile.element).find(".main").show();
                                $(tile.element).find(".main").animate({
                                    "opacity": 1
                                }, {
                                    duration: tileSlideSpeed,
                                    queue: true
                                });
                            }



                        });
                    }
                }
            };

            this.setSubmenu = function () {
                if (this.submenu != null) {
                    var tile = this;

                    $(tile.submenu).find("a").each(function (index) {

                        $(this).on('click.subnav', function () {

                            changePage(null, this);
                            $(this).siblings().removeClass("active");
                            $(this).addClass("active");
                            return false;
                        });

                    });
                }
            };

        }


        function generateRandomNumber() {
            result = Math.floor(Math.random() * tileArray.length);
            if (result < 0) {
                result = 0;
            } else if (result > tileArray.length - 1) {
                result = tileArray.length - 1;
            }
            return result;
        }

        function moveLiveTiles() {

            var rand = generateRandomNumber();
            if (!tileArray[rand].isHighlight()) {
                tileArray[rand].nextPosition();
                tileAnimation(tileArray[rand]);
            }

        }

        function tileAnimation(tile, pos) {
            if (pos == null) {
                pos = tile.top();
            }
            $(tile.content).animate({
                "top": pos
            }, tileSlideSpeed);
        }

        function removeHighlight() {
            $(tileArray).each(function (index) {
                this.removeHighlight();
            });
        }

        function tileEvents(tile) {

            $(tile.element).hover(

            function () {
                if (tile.submenuDisplay == false) {

                    tileAnimation(tile, tile.hover());
                }
                if(animateTiles) { clearInterval(interval); }
            }, function () {

                if (tile.isHighlight()) {
                    tile.midPosition();
                }

                tileAnimation(tile);

                if(animateTiles) { interval = setInterval(moveLiveTiles, tileSpeed);}
            });



            $(tile.element).on('click.highlight', function (e) {

                if ($(tile.link).hasClass("external")) {
                    return true;
                }
				
				
				
                if (tile.size == 0) {
                    prevTile = null;
                    nextTile = null;
                    currentTile = null;
                    updateTileSize(1);
                    refreshTiles();

                    $("#logo.home, #logo.home *").switchClass("home", "nav", menuToggleSpeed, menuEase);
               
                    $(".tile.home").each(function (ind) {
                    	
                        $(this).find(".home").toggleClass("home nav");
                        $(this).switchClass("home", "nav", menuToggleSpeed + ind * 150, menuEase, function () {

                            if (ind == (tileArray.length - 1)) {
                                $("#tileBlock.home").toggleClass("home nav");
                                showPageContent();
                            }
                        });
                    });
                }

    
				//if (currentTile != tile.index) {
    				removeHighlight();
    				tile.setHighlight();
    				tile.toggleSubmenu();
    				if (currentTile != null) {
        				tileArray[currentTile].toggleSubmenu();
   					 }
	
					currentTile = tile.index;
	    			changePage(tile);
	
				//}

                return false;
            });

        }


        function updateTileSize(size) {
            $(tileArray).each(function (index) {
                this.size = size;

            });

        }

        function refreshTiles() {
            $(tileArray).each(function (index) {
                var pos = null;
                if(this.isHighlight()) {
                	pos = this.position;
                }
                tileAnimation(this, pos);
            });
        }


        function getPageIndex(mainIndex, subIndex) {
            if (subIndex != null) {
                return mainIndex + "-" + subIndex;

            } else {
                return mainIndex;
            }
        }

        function changePage(tile, internalLink) {
			var $this;
			if (internalLink != null) {
				$this = $(internalLink);
				submenuClick = true;
			} else {
				$this = $(tile.link);  
			}
           
           var  url = $this.attr('href'),
                title = $this.attr('title') || null;		
			
			// Ajaxify this link
            History.pushState(null, title, url);
                       
           	bookmarked = false;

        }


        function showPageContent() {
			
            $("#contentWrapper").show().css({
                "top": 500
            });

            if (pauseOnContent == 1) {
               if ( typeof vars !== "undefined") {
     				if(!vars.is_paused) {
                		api.playToggle();
                	}
				} 
            }
            
            $("#contentWrapper").animate({
                opacity: 1.0,
               	top: 0,
            }, {
                duration: tileSlideSpeed,
                easing: pageEase,
                queue: true,
                complete: function() {
                	setWrapperVertical();
                }
            });

        }


        function hidePageContent() {
				
            if (currentTile != null) {
                $(tileArray[currentTile].submenu).children().removeClass("active");
            }
            
            $("#contentWrapper").stop().animate({
                opacity: 0.0,
                top: 500
                
            }, {
                duration: tileSlideSpeed,
                easing: pageEase,
                queue: true,
                complete: function () {
                    $("#contentWrapper").hide();
                    //$(prevTile).hide();
                    if (pauseOnContent == 1) {
                		if ( typeof vars !== "undefined") {
     						if(vars.is_paused) {
                				api.playToggle();
                			}
						} 
                    }
                    if (currentTile != null) {
                        tileArray[currentTile].toggleSubmenu();
                    }
                    $("#tileBlock.nav").toggleClass("nav home");
                   	
                   	setWrapperVertical();
                    
                    $("#logo.nav, #logo.nav *").switchClass("nav", "home", menuToggleSpeed, menuEase);
                    
                    $(".tile.nav").each(function (ind) {
                        $(this).find(".nav").toggleClass("nav home");
                        $(this).switchClass("nav", "home", menuToggleSpeed + ind * 100, menuEase, function () {

                        }); 
                    }); 
                }
            });
        }



        function logoEvents() {
            $("#logo").on('click.logo', function () {
            
            	var link = $(this).find("a");
                if ($(this).hasClass("nav")) {
            
                	changePage(null, link);
                    updateTileSize(0);
                    refreshTiles();
                    removeHighlight();
                    hidePageContent();
                    
                }
                return false;
            });
        }

		function musicPlayer() {
		    		
			new jPlayerPlaylist({
				jPlayer: "#jquery_jplayer_1",
				cssSelectorAncestor: "#jp_container_1"
				}, 
				musicArray, 
				{
					swfPath:  themeURL + "/js",
					supplied: "oga, mp3",
					wmode: "window",
					ready: function () {
					
						if(musicAutoplay == 1) {
							$(this).jPlayer("play");
						};
				}
			});
			
		}

        function setWrapperVertical() {
            var viewport = viewportDimensions();
            var topPos = viewport[1];
            if($("#tileBlock").hasClass("nav")) {
            	var newHeight = $("#logo").height();
            	newHeight += Math.ceil(tileArray.length / 2)*(tileSmall + 10);
            	$("#tileBlock").height(newHeight);
            } else { 
            	var oldTop = $("#tileBlock").css("top");
            	$("#tileBlock").removeAttr("style");
            	$("#tileBlock").css({"top" : oldTop});
            }
            
            topPos = (topPos - $('#tileBlock').height()) / 2;
            
            if (topPos < 0) topPos = 0;
            if (isMobile == 1 && $("#tileBlock").hasClass("nav")) topPos = 10;
            $('#tileBlock').stop().animate({
                'top': topPos
            } ,{duration : menuToggleSpeed});
        }

        function viewportDimensions() {
            var viewportwidth;
            var viewportheight;

            if (typeof $(window).innerWidth() != 'undefined') {
                viewportwidth = $(window).innerWidth();
                viewportheight = $(window).innerHeight();
            }

            var dimensions = new Array(viewportwidth, viewportheight);
            return dimensions;

        }
		
		//v1.1

		function updateTileHeadingSize(cssClass) {			
			var fontSizeHtml = "";
			$(tileArray).each(function (index) {
                var headingSize;
                var fontRatio;
                if(cssClass == "home") {
                	headingSize = tileLargeFont;
                } else {
                	headingSize = tileSmallFont;
                }
                
				var newSize = this.heading.textfill({maxFontPixels : headingSize});
                
                var newSize2;
                var tempIndex = index + 1;
                
                if(cssClass == "home") {
                	newSize2 = Math.floor((newSize / headingSize) * tileSmallFont);
                	fontSizeHtml += '#tile' + tempIndex + ' .tileHeading.nav, #tile' + tempIndex + '.nav .tileHeading.nav  span.nav{font-size: '+ newSize2 +'px !important;}' + "\n";
                } else {
                	newSize2 = Math.floor((newSize / headingSize) * tileLargeFont);
                	fontSizeHtml += '#tile' + tempIndex + ' .tileHeading.home, #tile' + tempIndex + '.home .tileHeading.home span.home{font-size: '+ newSize2 +'px !important;}' + "\n";
                }
                
				fontSizeHtml += '#tile' + tempIndex + ' .tileHeading.' + cssClass + ', #tile' + tempIndex + '.' + cssClass + ' .tileHeading.' + cssClass + ' span.' + cssClass + '{font-size: '+ newSize +'px !important;}' + "\n";
				
	    		
            });
            
            $('head').append('<style type="text/css">' + fontSizeHtml + '</style>');
		}
		//end
		
        function initTiles() {

            var obj = $("#tileBlock .tile");
            $(obj).each(function (index) {
                tileArray[index] = new Tile(this, index);
                $(this).find(".submenu").each(function (ind) {
                    tileArray[index].submenu = this;
                    tileArray[index].setSubmenu();
                });
   
                if(!isHomePage) {

                	$("#tileBlock").addClass("nav");
                	$(this).addClass("nav");
                	if(!$(this).hasClass("music")) {
                		$(this).find('*').addClass("nav");
                		$(this).find('.tileHeading').css({'font-size' : tileSmallFont});
                	}
                	updateTileSize(1);
                	//refreshTiles();
                	
                	$("#contentWrapper").show().css({'opacity' : 1});
                	
                	
                	if(tileArray[index].link.attr('href') === currentURL){
                		currentTile = index;
                		tileArray[index].setHighlight();
                		tileArray[index].toggleSubmenu();
      
                		
                	} else {
                		var isSubmenuItem = false;
                		$(tileArray[index].submenu).find("a").each(function() {
                			//search for submenu item
                			if($(this).attr('href') === currentURL) {
                				isSubmenuItem = true;
                				currentTile = index;
                				tileArray[index].setHighlight();
                				tileArray[index].toggleSubmenu();
                				$(this).addClass("active");

                			}
                			//if found set isubmenuitem to true
                		});
                		
                		if(isSubmenuItem == false) {
                			bookmarked = true;
                		}
                	}
           
                } else {
                	$("#tileBlock").addClass("home");
                	$(this).addClass("home");
                	if(!$(this).hasClass("music")) {
                		$(this).find('*').addClass("home");
                	}
                	
                }
                
                tileEvents(tileArray[index]);
                var ind = index + 1;
                $(this).attr("id", "tile" + ind);
            });
			
			if(!isHomePage) {
               	$("#logo").addClass("nav");
            	$("#logo").find('*').addClass("nav");
            	$("#tileBlock").addClass("nav");
            	
            	//changePage(null, currentURL);
            	if(tileArray.length <= 0) {
            		showPageContent();
            		bookmarked = true;
            	}
            } else {
                $("#logo").addClass("home");
            	$("#logo").find('*').addClass("home");
            	$("#tileBlock").addClass("home");
            	
            }
            

        }


        //Start Creating Layout
        isHomePage = isCurrentUrlHomePage(currentURL);
        
        initTiles();
        setWrapperVertical();
        logoEvents();
        bindScripts();
		
		if(isMusic == 1) musicPlayer();
		
		function isCurrentUrlHomePage(cur) {
			if(cur.length != homePageURL.length) {
				cur = cur.substring(homePageURL.length);
				if (cur == "/" || cur == "") {
				
					return true;
				} else {
					return false;
				}
			}
			
		}
		

        $(window).load(function () {

            $("#preloader").animate({
                "opacity": 0
            }, {
                duration: 500,
                complete: function () {
                    $("#preloader").hide();
                    
                    $("#wrapper").show().animate({
                        "opacity": 1
                    }, {
                        duration: pageFadeSpeed,
                        complete: function () {
                        $('.tileHeading').removeAttr('style');
                            refreshTiles();
                            if(tileArray.length > 0) {
            					if(animateTiles) { interval = setInterval(moveLiveTiles, tileSpeed);}
            				}
                            
                            if(!isHomePage) {
                            	updateTileHeadingSize("nav");
                            	if (pauseOnContent == 1) {
                					if ( typeof vars !== "undefined") {
     									if(!vars.is_paused) {
                							api.playToggle();
                						}
									} 	
            					}
                            } else {
                            	updateTileHeadingSize("home");
                            }
                        }
                    });
                }
            });

        });

        $(window).resize(function () {

            setWrapperVertical();

        });


        function bindScripts() {
        
            var $script = $(this);
            
            // Ajaxify our Internal Links
			$body.ajaxify();

       		// Add external class to external links
        	$body.externalLinks();
        	
        	
        	// initialize fancybox for images + videos
            $("a._image").fancybox({
                'transitionIn': lightboxTransition,
                'transitionOut': lightboxTransition,
                'titlePosition': 'over',
                'padding': '0',
                'overlayOpacity': overlayOpacity,
                'overlayColor': overlayColor,
                'titleFormat': function (title, currentArray, currentIndex, currentOpts) {
                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                }
            });

            //init fancybox - video handling
            $("a._video").fancybox({
                'transitionIn': lightboxTransition,
                'transitionOut': lightboxTransition,
                'padding': '0',
                'width': videoWidth,
                'height': videoHeight,
                'overlayOpacity': overlayOpacity,
                'overlayColor': overlayColor,
                
                'autoscale': 'true',
                'type': 'swf',
                'swf': {
                    'wmode': 'transparent',
                    'allowfullscreen': 'true'
                }

            });
			
			
			$('.mediaContainer').hover(
				function(e) {
        			$('img', this).stop().animate({ height: $(this).height(), left: '0', top: '0', width: $(this).width()}, 100);
       				$('div._rollover', this).fadeIn(200);
    			}, function(e) {
        			$('img', this).stop().animate({ height: $(this).height() * 1.1, left: $(this).width() * -0.05, top: $(this).height() * -0.05, width: $(this).width() * 1.1}, 100);
        			$('div._rollover', this).fadeOut(200);
    			}
    		);
    
            //SOCIAL ------------------------------------------------------------------------------/
            $("._rolloverSocial").css({'opacity': 0}).hover(

            function () {
                $(this).animate({
                    "opacity": "1"
                }, hoverFadeSpeed);
            }, function () {
                $(this).animate({
                    "opacity": "0"
                }, hoverFadeSpeed);
            });

			
			firstPaginate = true; //prevents double animation on load of paginated container
			
            //init pajinate containers - add containers as necessary
            $('#blogContainer').pajinate({
                start_page: 0,
                items_per_page: 1,
                show_first_last: false,
                item_container_id: ".contentPaginate"
            }); //initialize pagination of blog items
            $('#searchContainer').pajinate({
                start_page: 0,
                items_per_page: 1,
                show_first_last: false,
                item_container_id: ".contentPaginate"
            }); //initialize pagination of blog items
            $('#galleryContainer').pajinate({
                start_page: 0,
                items_per_page: 1,
                show_first_last: false,
                item_container_id: ".contentPaginate"
            }); //initialize pagination of gallery items
            $('#productContainer').pajinate({
                start_page: 0,
                items_per_page: 1,
                show_first_last: false,
                item_container_id: ".contentPaginate"
            }); //initialize pagination of product items
            
            //BLOG -------------------------------------------------------------------------------/
            
           
           
           	if(!bookmarked) { $("#singlePost").append('<div class="postClose"></div>'); } //show close/back button when post navigated to through menu.
           	
            
			$(".readMore").click(function() {
				changePage(null, this);
				return false;
			});
			
			$(".postClose").css({'opacity' : 0.5}).click(function() {
				
				History.back();
				return false;
			});
			
            //postClose:hover
            $('.postClose').hover(function () {

                $(this).css({
                    opacity: 1
                });

            }, function () {

                $(this).css({
                    opacity: 0.5
                });

            });
			

             //FORMS -------------------------------------------------------------------------------/

            // hide form reload button
            $('#reload').hide();
			
            $('#contactForm #name,#contactForm #email,#contactForm #subject,#contactForm #message, #commentForm #blogName, #commentForm #blogEmail, #commentForm #blogWebsite, #commentForm #blogComment, #loginForm #log, #loginForm #pwd').focus(function () {
                var initVal = $(this).val();
                $(this).val(initVal === this.defaultValue ? '' : initVal);
            }).blur(function () {
                var initVal = $(this).val();
                $(this).val(initVal.match(/^\s+$|^$/) ? this.defaultValue : initVal);
            });
			
			$('#commentform #author, #commentform #email, #commentform #comment').each(function () {
            
                var initVal = $(this).val();
                $(this).val(initVal.match(/^\s+$|^$/) ? $(this).attr('id').charAt(0).toUpperCase() + $(this).attr('id').slice(1) : initVal);
            });
            
			$('#commentform #author, #commentform #email, #commentform #comment').focus(function () {
                var initVal = $(this).val();
                $(this).val(initVal === $(this).attr('id').charAt(0).toUpperCase() + $(this).attr('id').slice(1) ? '' : initVal);
            }).blur(function () {
                var initVal = $(this).val();
                $(this).val(initVal.match(/^\s+$|^$/) ? $(this).attr('id').charAt(0).toUpperCase() + $(this).attr('id').slice(1) : initVal);
            });
            
			$("#themeContactForm").submit(function() {
				$('#contactForm #submit').attr("disabled", "disabled");
			
    			var name = $('#contactForm #name').val();
            	var email = $('#contactForm #email').val();
            	var subject = $('#contactForm #subject').val();
            	var message = $('#contactForm #message').val();
    		
                var isError = 0;

    			if (name == 'Name*' || name == '') {
                    $('#contactForm #name').addClass('formVerify').focus();
                    isError = 1;
                }
                if (email == 'E-mail*' || email == '') {
                    $('#contactForm #email').addClass('formVerify').focus();
                    isError = 1;
                } else {
                    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                    if (reg.test(email) == false) {
                        $('#contactForm #email').addClass('formVerify').focus();
                        isError = 1;
                    }
                }
                if (message == 'Message*' || message == '') {
                    $('#contactForm #message').addClass('formVerify').focus();
                    isError = 1;
                }

                if (isError == 1) {
                    $('#contactForm #formProgress').html(formWarning);
                    $('#contactForm #submit').removeAttr("disabled");
                    return false;
                }

    			var str = $(this).serialize();
    			
    			$('#contactForm #formProgress').html('Sending&hellip;');
    			  			
    			$.ajax({
        			type: "POST",
        			url: homePageURL + "/wp-admin/admin-ajax.php",
        			data: 'action=contact_form&'+str,
        			success: function(msg) {
        				$("#contactForm").ajaxComplete(function(event, request, settings){
                			if(msg == 'Mail sent') {
                				$('#contactForm #submit').removeAttr("disabled");
                    			$("#contactForm").animate({'opacity' : 0},{'duration' : pageFadeSpeed, 'complete' : function() { $(this).hide();}});
            					$("#sentConfirmMessage").html(formSuccess);
            					$('#reload').fadeIn();
                			}
                			else {
                    			result = msg;
                    			$("#sentConfirmMessage").html(formError);
                    			$('#contactForm #submit').removeAttr("disabled");
        					}
        				});
        			}
    			});
    			return false;
    		});
            
            	    
            $('#reload').click(function () {
                $("#contactForm").show().animate({
                    "opacity": "1"
                }, pageFadeSpeed);
                $('#sentConfirmMessage').html(formReload);
                $('#reload').fadeOut();
                $('#contactForm #formProgress').html('*required');
            });

            $(".twitter").tweet({
                join_text: "auto",
                username: twitterAccount,
                avatar_size: 40,
                count: numTweets,
                auto_join_text_default: "we said,",
                auto_join_text_ed: "we",
                auto_join_text_ing: "we were",
                auto_join_text_reply: "we replied",
                auto_join_text_url: "we were checking out",
                loading_text: "loading tweets..."
            });

        }
    });
   
  
})(jQuery);