/*
 * QueryLoader v2 - A simple script to create a preloader for images
 *
 * For instructions read the original post:
 * http://www.gayadesign.com/diy/queryloader2-preload-your-images-with-ease/
 *
 * Copyright (c) 2011 - Gaya Kessler
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Version:  2.2
 * Last update: 03-04-2012
 *
 */
(function($) {
	/*Browser detection patch*/
	jQuery.browser = {};
	jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
	jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
	jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
	jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());

    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function (elt /*, from*/) {
            var len = this.length >>> 0;
            var from = Number(arguments[1]) || 0;
            from = (from < 0)
                ? Math.ceil(from)
                : Math.floor(from);
            if (from < 0)
                from += len;

            for (; from < len; from++) {
                if (from in this &&
                    this[from] === elt)
                    return from;
            }
            return -1;
        };
    }

    var qLimages = [];
    var qLdone = 0;
    var qLdestroyed = false;

    var qLimageContainer = "";
    var qLoverlay = "";
    var qLbar = "";
    var qLpercentage = "";
    var qLimageCounter = 0;
    var qLstart = 0;

    var qLoptions = {
        onComplete: function () {},
        backgroundColor: "#000",
        barColor: "#fff",
		textColor: "#fff",
        overlayId: 'qLoverlay',
        barHeight: 1,
		showbar: "on",
        percentage: false,
		loaderLogo: false,
        deepSearch: true,
        completeAnimation: "fade",
        minimumTime: 500,
        onLoadComplete: function () {
            if (qLoptions.completeAnimation == "grow") {
                var animationTime = 500;
                var currentTime = new Date();
                if ((currentTime.getTime() - qLstart) < qLoptions.minimumTime) {
                    animationTime = (qLoptions.minimumTime - (currentTime.getTime() - qLstart));
                }

                $(qLbar).stop().animate({
                    "width": "100%"
                }, animationTime, function () {
                    
                    $(this).animate({
                        top: "0%",
                        width: "100%",
                        height: "100%"
                    }, 500, function () {
                          
                        $('#'+qLoptions.overlayId).fadeOut( 500, function () {
                            $(this).remove();
                            qLoptions.onComplete();
                        });
                        
                    });
                    
                });
                
            } else {
                
                $('#'+qLoptions.overlayId).delay(1000).fadeOut( 300, function () {
                    $('#'+qLoptions.overlayId).remove();
                    qLoptions.onComplete();
                });
				
            }
        }
    };

    var afterEach = function () {
        //start timer
        //qLdestroyed = false;
        var currentTime = new Date();
        qLstart = currentTime.getTime();

        if (qLimages.length > 0) {
            createPreloadContainer();
            createOverlayLoader();
        } else {
            //no images == instant exit
            destroyQueryLoader();
        }
    };

    var createPreloadContainer = function() {
        qLimageContainer = $("<div></div>").appendTo("body").css({
            display: "none",
            width: 0,
            height: 0,
            overflow: "hidden"
        });
        
        for (var i = 0; qLimages.length > i; i++) {
            $.ajax({
                url: qLimages[i],
                type: 'HEAD',
                complete: function (data) {
                    if (!qLdestroyed) {
                        qLimageCounter++;
                        addImageForPreload(this['url']);
                    }
                }
            });
        }        	

    };

    var addImageForPreload = function(url) {
        var image = $("<img />").attr("src", url).bind("load error", function () {
            completeImageLoading();
        }).appendTo(qLimageContainer);
    };

    var completeImageLoading = function () {
        qLdone++;

        var percentage = (qLdone / qLimageCounter) * 100;
        $(qLbar).stop().animate({
            width: percentage + "%",
            minWidth: percentage + "%"
        }, 200);

        if (qLoptions.percentage == true) {
            $(qLpercentage).text(Math.ceil(percentage) + "%");
        }

        if (qLdone == qLimageCounter) {
            destroyQueryLoader();
        }
    };

    var destroyQueryLoader = function () {
        $(qLimageContainer).remove();
        qLoptions.onLoadComplete();
        qLdestroyed = true;
    };

    var createOverlayLoader = function () {
        
		qLoverlay = $("#qLoverlay");
       
	   	var barvisibility = 'visible',
			difference_one = 299
			difference_two = 0;
	   	
	    if( qLoptions.showbar === "off" ) {
			barvisibility = 'hidden';
			difference_one = 199;
			difference_two = 99;
		}
		
        
        if( preloader_settings.loader_logo !== '' ) {
        
            $("<div id='ut-loader-logo'><img src='"+ preloader_settings.loader_logo +"'></div>").appendTo(qLoverlay.children('.ut-inner-overlay'));
        
        }
       
        /* style 1 */
        if( preloader_settings.style === 'style_one' && qLoptions.showbar === "on" ) {
         	
            qLbar = $("<div id='qLbar'></div>").css({
                height: qLoptions.barHeight + "px",
                backgroundColor: qLoptions.barColor,
                width: "0%",
                marginTop: "40px",
                marginBottom: "40px",
                visibility : barvisibility
            }).appendTo( qLoverlay.children('.ut-inner-overlay') ); 
		
        }
        
        /* style 2 */
        if( preloader_settings.style === 'style_two' ) {
        
            $("<div class='ut-loading-bar-style2'><div class='ut-loading-bar-style2-ball-effect'></div></div><div class='ut-loading-text'><p>" + preloader_settings.loader_text + "</p></div>").appendTo( qLoverlay.children('.ut-inner-overlay') );
            
        }
        
        /* style 3 */
        if( preloader_settings.style === 'style_three' ) {
        
            $("<div class='ut-loading-bar-style3'><span class='ut-loading-bar-style3-outer'><span class='ut-loading-bar-style-3-inner'></span></span></div><div class='ut-loading-text'><p>" + preloader_settings.loader_text + "</p></div>").appendTo( qLoverlay.children('.ut-inner-overlay') );
            
        }
        
        /* style 4 */
        if( preloader_settings.style === 'style_four' ) {
            
            $("#ut-loader-logo").addClass("ut-style4-active");            
            $("<div class='ut-loading-bar-style4'><div class='ut-loader__bar4'></div><div class='ut-loader__bar4'></div><div class='ut-loader__bar4'></div><div class='ut-loader__bar4'></div><div class='ut-loader__bar4'></div><div class='ut-loader__ball4'></div></div><div class='ut-loading-text'><p>" + preloader_settings.loader_text + "</p></div>").appendTo( qLoverlay.children('.ut-inner-overlay') );
            
        }
        
        /* style 5 */
        if( preloader_settings.style === 'style_five' ) {
        
            $("<div class='ut-loading-bar-style5'><div class='ut-loading-bar-style5-inner'><label>    ●</label><label>    ●</label><label>    ●</label><label>    ●</label><label>    ●</label><label>    ●</label></div></div><div class='ut-loading-text'><p>" + preloader_settings.loader_text + "</p></div>").appendTo( qLoverlay.children('.ut-inner-overlay') );
            
        }
        
		if ( preloader_settings.loader_percentage === 'on' && preloader_settings.style === 'style_one' ) {
            
            qLpercentage = $("<div id='qLpercentage'></div>").text("0%").css({
                textAlign: "center",
                marginTop: "40px",
                color: qLoptions.textColor
            }).appendTo(qLoverlay.children('.ut-inner-overlay'));
            
        }
		
        
        if ( !qLimages.length) {
        	destroyQueryLoader()
        }
        
        
        
    };

    var findImageInElement = function (element) {
        var url = "";

        if ($(element).css("background-image") != "none") {
            var url = $(element).css("background-image");
        } else if (typeof($(element).attr("src")) != "undefined" && element.nodeName.toLowerCase() == "img") {
            var url = $(element).attr("src");
        }

        if (url.indexOf("gradient") == -1) {
            url = url.replace(/url\(\"/g, "");
            url = url.replace(/url\(/g, "");
            url = url.replace(/\"\)/g, "");
            url = url.replace(/\)/g, "");

            var urls = url.split(", ");

            for (var i = 0; i < urls.length; i++) {
                if (urls[i].length > 0 && qLimages.indexOf(urls[i]) == -1 && !urls[i].match(/^(data:)/i)) {
                    var extra = "";
                    if ($.browser.msie && $.browser.version < 9) {
                        extra = "?" + Math.floor(Math.random() * 3000);
                    }
                    qLimages.push(urls[i] + extra);
                }
            }
        }
    }

    $.fn.queryLoader2 = function(options) {
        if(options) {
            $.extend(qLoptions, options );
        }

        this.each(function() {
            findImageInElement(this);
            if (qLoptions.deepSearch == true) {
                $(this).find("*:not(script)").each(function() {
                    findImageInElement(this);
                });
            }
        });

        afterEach();

        return this;
    };

    //browser detect
    var BrowserDetect = {
        init: function () {
            this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
            this.version = this.searchVersion(navigator.userAgent)
                || this.searchVersion(navigator.appVersion)
                || "an unknown version";
            this.OS = this.searchString(this.dataOS) || "an unknown OS";
        },
        searchString: function (data) {
            for (var i=0;i<data.length;i++)	{
                var dataString = data[i].string;
                var dataProp = data[i].prop;
                this.versionSearchString = data[i].versionSearch || data[i].identity;
                if (dataString) {
                    if (dataString.indexOf(data[i].subString) != -1)
                        return data[i].identity;
                }
                else if (dataProp)
                    return data[i].identity;
            }
        },
        searchVersion: function (dataString) {
            var index = dataString.indexOf(this.versionSearchString);
            if (index == -1) return;
            return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
        },
        dataBrowser: [
            {
                string: navigator.userAgent,
                subString: "Chrome",
                identity: "Chrome"
            },
            { 	string: navigator.userAgent,
                subString: "OmniWeb",
                versionSearch: "OmniWeb/",
                identity: "OmniWeb"
            },
            {
                string: navigator.vendor,
                subString: "Apple",
                identity: "Safari",
                versionSearch: "Version"
            },
            {
                prop: window.opera,
                identity: "Opera",
                versionSearch: "Version"
            },
            {
                string: navigator.vendor,
                subString: "iCab",
                identity: "iCab"
            },
            {
                string: navigator.vendor,
                subString: "KDE",
                identity: "Konqueror"
            },
            {
                string: navigator.userAgent,
                subString: "Firefox",
                identity: "Firefox"
            },
            {
                string: navigator.vendor,
                subString: "Camino",
                identity: "Camino"
            },
            {		// for newer Netscapes (6+)
                string: navigator.userAgent,
                subString: "Netscape",
                identity: "Netscape"
            },
            {
                string: navigator.userAgent,
                subString: "MSIE",
                identity: "Explorer",
                versionSearch: "MSIE"
            },
            {
                string: navigator.userAgent,
                subString: "Gecko",
                identity: "Mozilla",
                versionSearch: "rv"
            },
            { 		// for older Netscapes (4-)
                string: navigator.userAgent,
                subString: "Mozilla",
                identity: "Netscape",
                versionSearch: "Mozilla"
            }
        ],
        dataOS : [
            {
                string: navigator.platform,
                subString: "Win",
                identity: "Windows"
            },
            {
                string: navigator.platform,
                subString: "Mac",
                identity: "Mac"
            },
            {
                string: navigator.userAgent,
                subString: "iPhone",
                identity: "iPhone/iPod"
            },
            {
                string: navigator.platform,
                subString: "Linux",
                identity: "Linux"
            }
        ]

    };
    BrowserDetect.init();
    jQuery.browser.version = BrowserDetect.version;
})(jQuery);
