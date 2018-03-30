(function($) {
    $(document)
        .ready(function() {
            
            // -------------------------------------------------------------------------------------------------------
            // WOOCOMMERCE FIXED
            // -------------------------------------------------------------------------------------------------------	
            
            $("ul.products a").attr("id", "no-ajax")

            // -------------------------------------------------------------------------------------------------------
            // VIDEO & GALLERY
            // -------------------------------------------------------------------------------------------------------	

            $('#sng-gallery').royalSlider({
                fullscreen: {
                    enabled: true,
                    nativeFS: true
                },
                controlNavigation: 'thumbnails',

                loop: false,
                imageScaleMode: 'fit-if-smaller',
                navigateByClick: true,
                numImagesToPreload: 2,
                arrowsNav: true,
                arrowsNavAutoHide: true,
                arrowsNavHideOnTouch: true,
                keyboardNavEnabled: true,
                fadeinLoadedSlide: true,
                globalCaption: false,
                globalCaptionInside: false,
                thumbs: {
                    appendSpan: true,
                    firstMargin: true,
                    paddingBottom: 6
                }
            });

            $('#video-gallery').royalSlider({
                arrowsNav: false,
                fadeinLoadedSlide: true,
                controlNavigationSpacing: 0,
                controlNavigation: 'thumbnails',

                thumbs: {
                    autoCenter: false,
                    fitInViewport: true,
                    orientation: 'vertical',
                    spacing: 0,
                    paddingBottom: 0
                },
                keyboardNavEnabled: true,
                imageScaleMode: 'fill',
                imageAlignCenter: true,
                slidesSpacing: 0,
                loop: false,
                loopRewind: true,
                numImagesToPreload: 3,
                video: {
                    autoHideArrows: true,
                    autoHideControlNav: false,
                    autoHideBlocks: true
                },
            });
			
            // -------------------------------------------------------------------------------------------------------
            // PRETTY PHOTO
            // -------------------------------------------------------------------------------------------------------	
			
			if(jQuery().prettyPhoto) {
                  jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
                     animation_speed: 'fast', // fast/slow/normal 
                     slideshow: 5000, // false OR interval time in ms 
                     autoplay_slideshow: false, // true/false 
                     opacity: 0.80, // Value between 0 and 1 
                     show_title: true, // true/false 
                     allow_resize: true, // Resize the photos bigger than viewport. true/false 
                     default_width: 540,
                     default_height: 344,
					 deeplinking : false,
                     counter_separator_label: '/', // The separator for the gallery counter 1 "of" 2
                     theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook
                     horizontal_padding: 20, // The padding on each side of the picture 
                     autoplay: true, // Automatically start videos: True/False 					
                     ie6_fallback: true,
                  });
               }
			   
            // -------------------------------------------------------------------------------------------------------
            // WIDGET SLIDER
            // -------------------------------------------------------------------------------------------------------	

            $('.wd-sld').flexslider({
                animation: "slide",
                directionNav: false,
            });

            // -------------------------------------------------------------------------------------------------------
            // CAROUSEL
            // -------------------------------------------------------------------------------------------------------		

            $('.feat-carousel').carouFredSel({
                width: '100%',
                items: {
                    visible: 4,
                    start: -1
                },
                scroll: {
                    items: 1,
                    duration: 1000,
                    timeoutDuration: 3500
                },
                prev: '.feat-prev',
                next: '.feat-next'
            });
			
            // -------------------------------------------------------------------------------------------------------
            // SEARCH
            // -------------------------------------------------------------------------------------------------------		

            $(".iconsearh").click(function() {
                var icon = $(this),
                    input = icon.parent().find("#search"),
                    submit = icon.parent().find(".submit"),
                    is_submit_clicked = false;

                input.animate({
                    "width": "135px",
                    "padding": "6",
                    "opacity": 1
                }, 300, function() {
                    input.focus();
                });

                submit.mousedown(function() {
                    is_submit_clicked = true;
                });

                icon.fadeOut(300);

                input.blur(function() {
                    if (!input.val() && !is_submit_clicked) {
                        input.animate({
                            "width": "0",
                            "padding": "0",
                            "opacity": 0
                        }, 200);

                        // Get the icon back
                        icon.fadeIn(200);
                    };
                });
            });

            // -------------------------------------------------------------------------------------------------------
            // SLIDER
            // -------------------------------------------------------------------------------------------------------	

            jQuery('#slider-full').show().revolution({
                hideTimerBar: "on",
                startwidth: 1225,
                startheight: 550,
                hideThumbs: 1,
                touchenabled: "on",
                onHoverStop: "off",
                drag_block_vertical: false,
                keyboardNavigation: "off",
                fullWidth: "on",
                fullScreen: "off"
            }).on('revolution.slide.onloaded', sliderLoaded);

            jQuery('#slider-left').show().revolution({
                hideTimerBar: "on",
                startwidth: 595,
                startheight: 550,
                hideThumbs: 1,
                touchenabled: "on",
                onHoverStop: "off",
                drag_block_vertical: false,
                keyboardNavigation: "off",
                fullWidth: "on",
                fullScreen: "off"
            }).on('revolution.slide.onloaded', sliderLoaded);
			
			jQuery('#slider-right').show().revolution({
                hideTimerBar: "on",
                startwidth: 595,
                startheight: 550,
                hideThumbs: 1,
                touchenabled: "on",
                onHoverStop: "off",
                drag_block_vertical: false,
                keyboardNavigation: "off",
                fullWidth: "on",
                fullScreen: "off"
            }).on('revolution.slide.onloaded', sliderLoaded);

            function sliderLoaded() {
                var $this = jQuery(this);
                $this.parent().find('.tp-bullets, .tparrows').appendTo($this);
            }

            // -------------------------------------------------------------------------------------------------------
            // IMAGE HOVER
            // -------------------------------------------------------------------------------------------------------

            $(".photo-preview img").fadeTo(1, 1);
            $(".photo-preview img").hover(
                function() {
                    $(this).fadeTo("fast", 0.70);
                },
                function() {
                    $(this).fadeTo("slow", 1);
                });

            $(".flickr_badge_image img").fadeTo(1, 1);
            $(".flickr_badge_image img").hover(
                function() {
                    $(this).fadeTo("fast", 0.70);
                },
                function() {
                    $(this).fadeTo("slow", 1);
                });

            // -------------------------------------------------------------------------------------------------------
            // TABS
            // -------------------------------------------------------------------------------------------------------

            $("#tabs ul").idTabs();

            // -------------------------------------------------------------------------------------------------------
            // TOGGLE
            // -------------------------------------------------------------------------------------------------------

            $("#tabs ul")
                .idTabs();
            $(".toggle_container")
                .hide();
            $(".trigger")
                .click(function() {
                    jQuery(this)
                        .toggleClass("active")
                        .next()
                        .slideToggle("fast");
                    return false; //Prevent the browser jump to the link anchor
                });
				

			
			

			
			
			
			


        });
})(window.jQuery);