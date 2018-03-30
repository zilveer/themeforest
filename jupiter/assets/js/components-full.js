(function($) {
    'use strict';

    var _toBuild = [];

    MK.component.AdvancedGMaps = function(el) {
        var $this = $(el),
            container = document.getElementById( 'mk-theme-container' ),
            data = $this.data( 'advancedgmaps-config' ),
            apikey = data.options.apikey ? ('key='+data.options.apikey+'&') : false,
            map = null,
            bounds = null,
            infoWindow = null,
            position = null;

        var build = function() {
            data.options.scrollwheel = false;
            data.options.mapTypeId = google.maps.MapTypeId[data.options.mapTypeId];
            data.options.styles = data.style;


            bounds = new google.maps.LatLngBounds();
            map = new google.maps.Map(el, data.options);
            infoWindow = new google.maps.InfoWindow();
            

             map.setOptions({
                panControl : data.options.panControl,
                draggable:  data.options.draggable,
                zoomControl:  data.options.zoomControl,
                mapTypeControl:  data.options.scaleControl,
                scaleControl:  data.options.mapTypeControl,
            });

            var marker, i;

            map.setTilt(45);

            for (i = 0; i < data.places.length; i++) {
                if(data.places[i].latitude && data.places[i].longitude) {
                    position = new google.maps.LatLng(data.places[i].latitude, data.places[i].longitude);

                    bounds.extend(position);

                    marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: data.places[i].address,
                        icon: (data.places[i].marker) ? data.places[i].marker : data.icon
                    });


                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() { 
                            if(data.places[i].address && data.places[i].address.length > 1) {
                                infoWindow.setContent('<div class="info_content"><p>'+ data.places[i].address +'</p></div>');
                                infoWindow.open(map, marker);
                            } else {
                                infoWindow.setContent('');
                                infoWindow.close();
                            }
                        };
                    })(marker, i));

                    map.fitBounds(bounds);
                }
            }

            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(data.options.zoom);
                google.maps.event.removeListener(boundsListener);
            });


            var update = function() {
                google.maps.event.trigger(map, "resize");
                map.setCenter(position);
            };
            update();


            var bindEvents = function() {
                $( window ).on( 'resize', update );
                window.addResizeListener( container, update );
            };
            bindEvents();
        };


        var initAll = function() {
            for( var i = 0, l = _toBuild.length; i < l; i++ ) {
                _toBuild[i]();
            }
        };

        MK.api.advancedgmaps = MK.api.advancedgmaps || function() {
            initAll();
        };

        return {
            init : function() {
                _toBuild.push( build );
                MK.core.loadDependencies(['https://maps.googleapis.com/maps/api/js?'+apikey+'callback=MK.api.advancedgmaps']);
            }
        };

    };

})(jQuery);
function mk_gmap_iterator($id) {
	$ = jQuery;


	$('.gmap-new-loaction-btn').on('click', openModal);
	$('#mk-popup-cancel-btn').on('click', cancelModal);
	$('#mk-popup-submit-btn').on('click', submitModal);
	$(document).on('click', '.gmap-delete-btn', remove);
	$(document).on('click', '.gmap-edit-btn', edit);


	function openModal(e) {
		e.preventDefault();
		var $modal = $('.gmap-marker-popup'),
			date = new Date(),
			time = date.getTime();

		$modal.find('input').val('');	
		$modal.find('.show-upload-image').html();
		$modal.fadeIn(200);
	}

	function cancelModal(e) {
		e.preventDefault();
		$('.gmap-marker-popup').fadeOut(200);
	}

	function submitModal(e) {
		e.preventDefault();
		var $submitBtn = $(this),
			$popup = $submitBtn.parents('.gmap-marker-popup'),
			$inputs = $popup.find('input'),
			$inputUniq = $inputs.filter('[name="uniqid"]'),
			uniq = $inputUniq.val(),
			date = new Date(),
			time = date.getTime(),
			data = {};

		// For new entry
		if(!uniq) $inputUniq.val(time);

		$inputs.each(function() {
			var $input = $(this),
				val = $input.val();
			if(val) data[$input.attr('name')] = val;
		});

		if(data && !uniq)     { appendData(data); appendRow(data); }
		else if(data && uniq) { updateData(data); updateRow(data); }

		$popup.fadeOut(200);
	}

	function appendData(data) {
		var currentData = getCurrentData();
		currentData.push(data);
		save(currentData);
	}

	function appendRow(data) {
		var $list = $('.gmap-marker-locations');
		var $item = $list.find('li').eq(0).clone();

		$item.attr('style', '');
		$item.removeClass('temp');
		$item.attr('data-id', data.uniqid);
		$item.find('span').html(data.title);
		$item.appendTo($list);
	}

	function updateData(data) {
		var currentData = getCurrentData(),
			index = getRowIndex(currentData, data.uniqid);

		currentData[index] = data;
		save(currentData);
	}

	function updateRow(data){
		$item = $('.gmap-marker-locations li[data-id="'+ data.uniqid +'"]');
		$item.find('span').html(data.title);
	}

	function addMarker() {

	}

	function save(data) {
		$('.gmap-marks-collector').val(escape(JSON.stringify(data)));
	}

	function remove(e) {
		e.preventDefault();
		var id = getRowId(e),
			data = getCurrentData(),
			index = getRowIndex(data, id);

		$('.gmap-marker-locations li:not(.temp)').eq(index).remove();
		data.splice(index, 1);
		save(data);
	}

	function edit(e) {
		e.preventDefault();
		var id = getRowId(e),
			data = getCurrentData(),
			index = getRowIndex(data, id),
			$modal = $('.gmap-marker-popup');

		$modal.find('input[name="uniqid"]').val(data[index].uniqid);
		$modal.find('input[name="title"]').val(data[index].title);
		$modal.find('input[name="latitude"]').val(data[index].latitude);
		$modal.find('input[name="longitude"]').val(data[index].longitude);
		$modal.find('input[name="address"]').val(data[index].address);
		$modal.find('input[name="marker_icon"]').val(data[index].marker_icon);
		$modal.find('.show-upload-image').html((!!data[index].marker_icon) ? ('<img src="'+data[index].marker_icon+'">') : '');
		$modal.fadeIn(200);
	}

	function getRowId(e) {
		var $btn = $(e.currentTarget),
			$item = $btn.parents('li'),
			id = $item.data('id');

		return id;
	}

	function getRowIndex(data, id) {
		var index = null;
		// find index to delete
		data.forEach(function(location, i){
			if(parseFloat(location.uniqid) === parseFloat(id)) index =  i;
		});
		return index;
	}

	function getCurrentData() {
		var data = $('.gmap-marks-collector').val();
		return (!!data && data !== 'false') ? JSON.parse(unescape(data)) : [];
	}
}
(function($) {
    'use strict';

    function mk_animated_cols() {
        function equalheight (container){
            var currentTallest = 0,
                 currentRowStart = 0,
                 rowDivs = new Array(),
                 $el,
                 topPosition = 0;
             $(container).each(function() {

               $el = $(this);
               $($el).height('auto');
               topPosition = $el.position().top;

               if (currentRowStart != topPosition) {
                 for (var currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                   rowDivs[currentDiv].height(currentTallest);
                 }
                 rowDivs.length = 0; // empty the array
                 currentRowStart = topPosition;
                 currentTallest = $el.height();
                 rowDivs.push($el);
               } else {
                 rowDivs.push($el);
                 currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
              }
               for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                 rowDivs[currentDiv].height(currentTallest);
               }

             });

            // console.log('recalc' + container + ' ' + currentTallest);

            return currentTallest;
        }


        function prepareCols(el) {
            var $this = el.parent().parent().find('.mk-animated-columns');

            var iconHeight  = equalheight('.vc_row .animated-column-icon, .animated-column-holder .mk-svg-icon'),
                titleHeight = equalheight('.vc_row .animated-column-title'),
                descHeight  = equalheight('.vc_row .animated-column-desc'),
                btnHeight   = $this.find('.animated-column-btn').innerHeight();

            if ($this.hasClass('full-style')) {
                $this.find('.animated-column-item').each(function() {
                    var $this = $(this),
                        contentHeight = (iconHeight + 30) + (titleHeight + 10) + (descHeight + 70) + 34;

                    $this.height(contentHeight * 1.5 + 50);

                    var $box_height = $this.outerHeight(true),
                        $icon_height = $this.find('.animated-column-icon, .animated-column-holder .mk-svg-icon').height();

                    $this.find('.animated-column-holder').css({
                        'paddingTop': $box_height / 2 - $icon_height
                    });


                    $this.animate({opacity:1}, 300);
                });
            } else {
                $this.find('.animated-column-item').each(function() {
                    var $this = $(this),
                        halfHeight = $this.height() / 2,
                        halfIconHeight = $this.find('.animated-column-icon, .animated-column-holder .mk-svg-icon').height()/2,
                        halfTitleHeight = $this.find('.animated-column-simple-title').height()/2;

                    $this.find('.animated-column-holder').css({
                        'paddingTop': halfHeight - halfIconHeight
                    });

                    $this.find('.animated-column-title').css({
                        'paddingTop': halfHeight - halfTitleHeight
                    });

                    $this.animate({
                        opacity:1
                    }, 300);

                });
            }
        }

        $('.mk-animated-columns').each(function() {
            var that = this;
            MK.core.loadDependencies([ MK.core.path.plugins + 'tweenmax.js' ], function() {
                var $this = $(that),
                    $parent = $this.parent().parent(),
                    $columns = $parent.find('.column_container'),
                    index = $columns.index($this.parent());
                    // really bad that we cannot read it before bootstrap - needs full shortcode refactor

                if($this.hasClass('full-style')) {
                    $this.find('.animated-column-item').hover(
                    function() {
                        TweenLite.to($(this).find(".animated-column-holder"), 0.5, {
                            top: '-15%',
                            ease: Back.easeOut
                        });
                        TweenLite.to($(this).find(".animated-column-desc"), 0.5, {
                            top: '50%',
                            ease: Expo.easeOut
                        }, 0.4);
                        TweenLite.to($(this).find(".animated-column-btn"), 0.3, {
                            top: '50%',
                            ease: Expo.easeOut
                        }, 0.6);
                    },
                    function() {

                        TweenLite.to($(this).find(".animated-column-holder"), 0.5, {
                            top: '0%',
                            ease: Back.easeOut, easeParams:[3]
                        });
                        TweenLite.to($(this).find(".animated-column-desc"), 0.5, {
                            top: '100%',
                            ease: Back.easeOut
                        }, 0.4);
                        TweenLite.to($(this).find(".animated-column-btn"), 0.5, {
                            top: '100%',
                            ease: Back.easeOut
                        }, 0.2);
                    });
                }

                if($this.hasClass('simple-style')) {
                    $this.find('.animated-column-item').hover(
                    function() {
                        TweenLite.to($(this).find(".animated-column-holder"), 0.7, {
                            top: '100%',
                            ease: Expo.easeOut
                        });
                        TweenLite.to($(this).find(".animated-column-title"), 0.7, {
                            top: '0%',
                            ease: Back.easeOut
                        }, 0.2);
                    },
                    function() {
                        TweenLite.to($(this).find(".animated-column-holder"), 0.7, {
                            top: '0%',
                            ease: Expo.easeOut
                        });
                        TweenLite.to($(this).find(".animated-column-title"), 0.7, {
                            top: '-100%',
                            ease: Back.easeOut
                        }, 0.2);
                    });
                }

                if($columns.length === index + 1) {
                    prepareCols($this);
                    $(window).on("resize", function() {
                            setTimeout(prepareCols($this), 1000);
                    });
                }

                MK.utils.eventManager.subscribe('iconsInsert', function() {
                    prepareCols($this);
                });
            });

        });
    }

    $(window).on('load', mk_animated_cols);

}(jQuery));
(function($) {
    'use strict';

    var core = MK.core,
    	path = MK.core.path;

    MK.component.BannerBuilder = function( el ) {
    	var init = function(){
            var $this = $(el),
                  data = $this.data( 'bannerbuilder-config' );

            MK.core.loadDependencies([ MK.core.path.plugins + 'jquery.flexslider.js' ], function() {
                $this.flexslider({
                        selector: '.mk-banner-slides > .mk-banner-slide',
                        animation: data.animation,
                        smoothHeight: false,
                        direction:'horizontal',
                        slideshow: true,
                        slideshowSpeed: data.slideshowSpeed,
                        animationSpeed: data.animationSpeed,
                        pauseOnHover: true,
                        directionNav: data.directionNav,
                        controlNav: false,
                        initDelay: 2000,
                        prevText: '',
                        nextText: '',
                        pauseText: '',
                        playText: ''
                });
            });
    	};

    	return {
    		init : init
    	};
    };

})(jQuery);








(function($) {
    'use strict';

    var zIndex = 0;

    $('.mk-newspaper-wrapper').on('click', '.blog-loop-comments', function (event) {
        event.preventDefault();

        var $this = $(event.currentTarget);
        var $parent = $this.parents('.mk-blog-newspaper-item');

        $parent.css('z-index', ++zIndex);
        $this.parents('.newspaper-item-footer').find('.newspaper-social-share').slideUp(200).end().find('.newspaper-comments-list').slideDown(200);
        setTimeout( function() {
          MK.utils.eventManager.publish('item-expanded');
        }, 300);
    });

    $('.mk-newspaper-wrapper').on('click', '.newspaper-item-share', function (event) {
        event.preventDefault();

        var $this = $(event.currentTarget);
        var $parent = $this.parents('.mk-blog-newspaper-item');

        $parent.css('z-index', ++zIndex);
        $this.parents('.newspaper-item-footer').find('.newspaper-comments-list').slideUp(200).end().find('.newspaper-social-share').slideDown(200);
        setTimeout( function() {
          MK.utils.eventManager.publish('item-expanded');
        }, 300);
    });

}(jQuery));
(function($) {
    'use strict';

    var core = MK.core,
    	path = MK.core.path;

    // TODO: Repair after Rifat. He repeated The same code twice - other same code is in photoalbum (why by the way?!).
    // Split it into two separate components when you see reusage
    MK.component.Category = function( el ) {
        var init = function(){
			core.loadDependencies([ path.plugins + 'pixastic.js' ], function() {
         		blurImage($('.blur-image-effect .mk-loop-item .item-holder '));
         	});

			core.loadDependencies([ path.plugins + 'minigrid.js' ], masonry);
        };

        var blurImage = function($item) {
         	return $item.each(function() {
				var $_this = $(this);

				var img = $_this.find('.item-thumbnail');

				img.clone().addClass("blur-effect item-blur-thumbnail").removeClass('item-thumbnail').prependTo(this);

				var blur_this = $(".blur-effect", this);
					blur_this.each(function(index, element){
						if (img[index].complete === true) {
							Pixastic.process(blur_this[index], "blurfast", {amount:0.5});
						}
						else {
							blur_this.load(function () {
								Pixastic.process(blur_this[index], "blurfast", {amount:0.5});
							});
						}
					});
			});
        };

        // TODO: find other shortcodes like this design and make it as a component
        var masonry = function() {
        	if(!$('.js-masonry').length) return;

	        function grid() {
	            minigrid({
		            container: '.js-masonry',
		            item: '.js-masonry-item',
		            gutter: 0
	            });
	        }

	        grid();
	        $(window).on('resize', grid);
        };

        return {
         	init : init
        };
    };

})(jQuery);








(function($) {
    'use strict';

    var core = MK.core,
        path = core.path;

    MK.component.Chart = function(el) {
        var init = function() {
            MK.core.loadDependencies([MK.core.path.plugins + 'jquery.easyPieChart.js'], function() {
                $('.mk-chart__chart').each(function() {
                    var $this = $(this),
                        $parent_width = $(this).parent().width(),
                        $chart_size = parseInt($this.attr('data-barSize'));

                    if ($parent_width < $chart_size) {
                        $chart_size = $parent_width;
                        $this.css('line-height', $chart_size);
                        $this.find('i').css({
                            'line-height': $chart_size + 'px'
                        });
                        $this.css({
                            'line-height': $chart_size + 'px'
                        });
                    }

                    var build = function() {
                        $this.easyPieChart({
                            animate: 1300,
                            lineCap: 'butt',
                            lineWidth: $this.attr('data-lineWidth'),
                            size: $chart_size,
                            barColor: $this.attr('data-barColor'),
                            trackColor: $this.attr('data-trackColor'),
                            scaleColor: 'transparent',
                            onStep: function(value) {
                                this.$el.find('.chart-percent span').text(Math.ceil(value));
                            }
                        });
                    };

                    // refactored only :in-viewport logic. rest is to-do
                    MK.utils.scrollSpy(this, {
                        position: 'bottom',
                        after: build
                    });
                });
            });
        };

        return {
            init: init
        };
    };

})(jQuery);

(function($) {
    "use strict";

    $('.mk-clients.column-style').each(function() {
        var $group = $(this),
            $listItems = $group.find('li'),
            listItemsCount = $listItems.length,
            listStyle = $group.find('ul').attr('style') || '',
            fullRowColumnsCount = $group.find('ul:first-of-type li').length;

        function recreateGrid() { 
            var i;

            $listItems.unwrap();

            if (window.matchMedia('(max-width: 550px)').matches && fullRowColumnsCount >= 1) {
                for (i = 0; i < listItemsCount; i += 1) {
                    $listItems.slice(i, i + 1)
                        .wrapAll('<ul class="mk-clients-fixed-list" style="' + listStyle + '"></ul>');
                }
            } else if (window.matchMedia('(max-width: 767px)').matches && fullRowColumnsCount >= 2) {
                for (i = 0; i < listItemsCount; i += 2) {
                    $listItems.slice(i, i + 2)
                        .wrapAll('<ul class="mk-clients-fixed-list" style="' + listStyle + '"></ul>');
                }
            } else if (window.matchMedia('(max-width: 960px)').matches && fullRowColumnsCount >= 3) {
                for (i = 0; i < listItemsCount; i += 3) {
                    $listItems.slice(i, i + 3)
                        .wrapAll('<ul class="mk-clients-fixed-list" style="' + listStyle + '"></ul>');
                }
            } else {
                for (i = 0; i < listItemsCount; i += fullRowColumnsCount) {
                    $listItems.slice(i, i + fullRowColumnsCount)
                        .wrapAll('<ul style="' + listStyle + '"></ul>');
                }
            }
        }
        
        recreateGrid();
        $(window).on('resize', recreateGrid);

    });

}(jQuery));
(function($) {
    'use strict';
    $(document).on('change', '.background_style', function(e) {
    	$(".background_hov_color_style option[value='none'], .background_hov_color_style option[value='gradient_color'], .background_hov_color_style option[value='image']").remove();
    	$(".background_hov_color_style").append('<option class="none" value="none" selected="selected">None</option>');
        $(".background_hov_color_style").append('<option class="image" value="image">Image & Single Color</option>');
		$(".background_hov_color_style").append('<option class="gradient_color" value="gradient_color">Gradient Color</option>');

        if(this.options[e.target.selectedIndex].value == 'gradient_color') {
        
            $(".background_hov_color_style").val('gradient_color').change();
            $(".background_hov_color_style option[value='image']").remove();
        
        }else if(this.options[e.target.selectedIndex].value == 'image') {

            $(".background_hov_color_style").val('image').change();
            $(".background_hov_color_style option[value='gradient_color']").remove();
        }
    });

})(jQuery);
(function($) {
	'use strict';

    $('.mk-edge-slider').find('video').each(function() {
        this.pause();
        this.currentTime = 0;
    });

	MK.component.EdgeSlider = function( el ) {
		var self = this,
			$this = $( el ), 
            $window = $(window),
            $wrapper = $this.parent(),
			config = $this.data( 'edgeslider-config' ),
            $nav = $( config.nav ),
            $prev = $nav.find( '.mk-edge-prev' ),
            $prevTitle = $prev.find( '.nav-item-caption' ),
            $prevBg = $prev.find('.edge-nav-bg'),
            $next = $nav.find( '.mk-edge-next' ),
            $nextTitle = $next.find( '.nav-item-caption' ),
            $nextBg = $next.find('.edge-nav-bg'),
            $navBtns = $nav.find( 'a' ),  
            $pagination = $( '.swiper-pagination' ),
            $skipBtn = $( '.edge-skip-slider' ),
            $opacityLayer = $this.find('.edge-slide-content'),
            $videos = $this.find('video'),
            currentSkin = null,
            currentPoint = null,
            winH = null,
            opacity = null,
            offset = null;

        var callbacks = { 
    		onInitialize : function( slides ) {
    			self.$slides = $( slides );
				
				self.slideContents = $.map( self.$slides, function( slide ) {
					var $slide = $( slide ),
						title = $slide.find('.edge-slide-content .edge-title').first().text(),
						skin = $slide.attr("data-header-skin"),
						image = $slide.find('.mk-section-image').css('background-image') || 
								$slide.find('.mk-video-section-touch').css('background-image'),
						bgColor = $slide.find('.mk-section-image').css('background-color');


					return {
						skin: skin,
						title: title,
						image: image,
						bgColor: bgColor
					};
				});

                // Set position fixed here rather than css to avoid flash of strangely styled slides befor plugin init
                if(MK.utils.isSmoothScroll) $this.css('position', 'fixed');

				setNavigationContent( 1, self.$slides.length - 1 );
				setSkin( 0 );
                // stopVideos();
                playVideo(0);

                setTimeout( function() {
                    $( '.edge-slider-loading' ).fadeOut( '100' );
                }, 1000 );
    		},

            onBeforeSlide : function( id ) {
                
            },

    		onAfterSlide : function( id ) {
    			setNavigationContent( nextFrom(id), prevFrom(id) );
    			setSkin( id );   
                stopVideos(); // stop all others if needed
                playVideo( id );
    		}
    	};


        var nextFrom = function nextFrom(id) {
            return ( id + 1 === self.$slides.length ) ? 0 : id + 1;
        };


        var prevFrom = function prevFrom(id) {
            return ( id - 1 === -1 ) ? self.$slides.length - 1 : id - 1;
        };


        var setNavigationContent = function( nextId, prevId ) {
            if(self.slideContents[ prevId ]) {
        		$prevTitle.text( self.slideContents[ prevId ].title );
        		$prevBg.css( 'background', 
        			self.slideContents[ prevId ].image !== 'none' ? 
        				self.slideContents[ prevId ].image :
        				self.slideContents[ prevId ].bgColor );
            }

            if(self.slideContents[ nextId ]) {
        		$nextTitle.text( self.slideContents[ nextId ].title ); 
        		$nextBg.css( 'background', 
        			self.slideContents[ nextId ].image !== 'none' ? 
        				self.slideContents[ nextId ].image :
        				self.slideContents[ nextId ].bgColor );
            }
        };


        var setSkin = function setSkin( id ) {  
        	currentSkin = self.slideContents[ id ].skin;

          	$navBtns.attr('data-skin', currentSkin);
          	$pagination.attr('data-skin', currentSkin);
         	$skipBtn.attr('data-skin', currentSkin); 

         	if( self.config.firstEl ) {
         		MK.utils.eventManager.publish( 'firstElSkinChange', currentSkin );
         	}
        };


        var stopVideos = function stopVideos() {
            $videos.each(function() {
                this.pause();
                this.currentTime = 0;
            });
        };


        var playVideo = function playVideo(id) {
            var video = self.$slides.eq(id).find('video').get(0);
            if(video) {
                video.play();
                console.log('play video in slide nr ' + id);
            }

        };


        var onResize = function onResize() {
            var height = $wrapper.height();
            $this.height( height );

            var width = $wrapper.width();
            $this.width( width );

            winH = $window.height();
            offset = $this.offset().top;

            if(!MK.utils.isSmoothScroll) return; 
            if(MK.utils.isResponsiveMenuState()) {
                // Reset our parallax layers position and styles when we're in responsive mode
                $this.css({
                    '-webkit-transform': 'translateZ(0)',
                    '-moz-transform': 'translateZ(0)',
                    '-ms-transform': 'translateZ(0)',
                    '-o-transform': 'translateZ(0)',
                    'transform': 'translateZ(0)',
                    'position': 'absolute'
                });
                $opacityLayer.css({
                    'opacity': 1
                });
            } else {
                // or proceed with scroll logic when we assume desktop screen
                onScroll();
            }
        };

        var onScroll = function onScroll() {
            currentPoint = - MK.val.scroll();

            if( offset + currentPoint <= 0 ) {
                opacity = 1 + ((offset + currentPoint) / winH) * 2;
                opacity = Math.min(opacity, 1);
                opacity = Math.max(opacity, 0);

                $opacityLayer.css({
                    opacity: opacity
                });
            }

            $this.css({
                '-webkit-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                '-moz-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                '-ms-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                '-o-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                'transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                'position': 'fixed'
            });  
        };

        onResize();
        $window.on('load', onResize);
        $window.on('resize', onResize);
        window.addResizeListener( $wrapper.get(0), onResize );

        if(MK.utils.isSmoothScroll) {
            onScroll();
            $window.on('scroll', function() {
                if(MK.utils.isResponsiveMenuState()) return;
                window.requestAnimationFrame(onScroll);
            });
        }

		this.el = el;
		this.config = $.extend( config, callbacks );
		this.slideContents = null; // cache slide contents
	};

	MK.component.EdgeSlider.prototype = {
		init : function() {
			// Inherit from Slider. add prototypes if needed
			var slider = new MK.ui.Slider( this.el, this.config );
			slider.init();
		}
	};

})(jQuery);
(function ($) {
	'use strict';

$('.mk-faq-wrapper').each( function() {
	var $this = $(this);
	var $filter = $this.find('.filter-faq');
	var $filterItem = $filter.find('a');
	var $faq = $this.find('.mk-faq-container > div');
	var currentFilter = '';

	$filterItem.on('click', function(e) {
		var $this = $(this);

		currentFilter = $this.data('filter');
		$filterItem.removeClass('current');
		$this.addClass('current');

		filterItems( currentFilter );

		e.preventDefault();
	});

	function filterItems( cat ) {
		if( cat === '' ) {
			$faq.slideDown(200).removeClass('hidden');
			return;
		}
		$faq.not( '.' + cat ).slideUp(200).addClass('hidden');
		$faq.filter( '.' + cat ).slideDown(200).removeClass('hidden');
	}
});
}( jQuery ));
(function($) {
    'use strict';

    // Move header to last wrapper of page section if its added into page section. 
    $('.js-header-shortcode').each(function() {
	    var $this = $(this),
	        $parent_page_section = $this.parents('.mk-page-section'),
	        $is_inside = $parent_page_section.attr('id');

	    if ($is_inside) {
	        $this.detach().appendTo($parent_page_section);
	    }
    });
})(jQuery);
(function($) {
  'use strict';

  /* Page Section Intro Effects */
  /* -------------------------------------------------------------------- */

  function mk_section_intro_effects() {
    if (!MK.utils.isMobile()) {
      if (!$.exists('.mk-page-section.intro-true')) return;

      $('.mk-page-section.intro-true').each(function() {
        var that = this;
        MK.core.loadDependencies([ MK.core.path.plugins + 'jquery.sectiontrans.js', MK.core.path.plugins + 'tweenmax.js' ], function() {
          var $this = $(that),
            $pageCnt = $this.parent().nextAll('div'),
            windowHeight = $(window).height(),
            effectName = $this.attr('data-intro-effect'),
            $header = $('.mk-header');

          var effect = {
            fade: new TimelineLite({paused: true})
              .set($pageCnt, { opacity: 0, y: windowHeight * 0.3 })
              .to($this, 1, { opacity: 0, ease:Power2.easeInOut })
              .to($pageCnt, 1, { opacity: 1, y: 0, ease:Power2.easeInOut}, "-=.7")
              .set($this, { zIndex: '-1'}),

            zoom_out: new TimelineLite({paused: true})
              .set($pageCnt, { opacity: 0, y: windowHeight * 0.3})
              .to($this, 1.5, { opacity: .8, scale: 0.8, y: -windowHeight - 100, ease:Strong.easeInOut })
              .to($pageCnt, 1.5, { opacity: 1, y:  0, ease:Strong.easeInOut}, "-=1.3"),

            shuffle: new TimelineLite({paused: true})
              .to($this, 1.5, { y: -windowHeight/2, ease:Strong.easeInOut })
              .to($pageCnt.first(), 1.5, { paddingTop: windowHeight/2, ease:Strong.easeInOut }, "-=1.3")
          };

          console.log($pageCnt);
        

          $this.sectiontrans({
            effect: effectName
          });

          if($this.hasClass('shuffled')) {
            TweenLite.set($this, { y: -windowHeight/2 });
            TweenLite.set($this.nextAll('div').first(), { paddingTop: windowHeight/2 });
          }

          $('body').on('page_intro', function() {
            MK.utils.scroll.disable();
            $(this).data('intro', true);
            effect[effectName].play();
            setTimeout(function() {
              $header.addClass('pre-sticky');
              $header.addClass('a-sticky');
              $('.mk-header-padding-wrapper').addClass('enable-padding');
              $('body').data('intro', false);
              if(effectName === 'shuffle') $this.addClass('shuffled');
            }, 1000);

            setTimeout(MK.utils.scroll.enable, 1500);
          });

          $('body').on('page_outro', function() {
            MK.utils.scroll.disable();
            $(this).data('intro', true);
            effect[effectName].reverse();
            setTimeout(function() {
              $header.removeClass('pre-sticky');
              $header.removeClass('a-sticky');
              $('.mk-header-padding-wrapper').removeClass('enable-padding');
              $('body').data('intro', false);
              if($this.hasClass('shuffled')) $this.removeClass('shuffled');
            }, 1000);
            
            setTimeout(MK.utils.scroll.enable, 1500);
          });
        });
      });

    } else {
      $('.mk-page-section.intro-true').each(function() {
        $(this).attr('data-intro-effect', '');
      });
    }
  }

  mk_section_intro_effects();

  var debounceResize = null;
  $(window).on("resize", function() {
    if( debounceResize !== null ) { clearTimeout( debounceResize ); }
    debounceResize = setTimeout( mk_section_intro_effects, 300 );
  });

}(jQuery));
(function($) {
	'use strict';

	function mk_page_title_parallax() {
	    if (!MK.utils.isMobile() && mk_smooth_scroll !== 'false') {

	        $('.mk-effect-wrapper').each(function() {
	            var $this = $(this),
                	progressVal,
                    currentPoint,
                    ticking = false,
                    scrollY = MK.val.scroll(),
                    $window = $(window),
                    windowHeight = $(window).height(),
                    parentHeight = $this.outerHeight(),
                    startPoint = 0,
                    endPoint = $this.offset().top + parentHeight,
                    effectLayer = $this.find('.mk-effect-bg-layer'),
                    gradientLayer = effectLayer.find('.mk-effect-gradient-layer'),
                    cntLayer = $this.find('.mk-page-title-box-content'),
                    animation = effectLayer.attr('data-effect'),
                    top = $this.offset().top,
                    height = $this.outerHeight();

                var parallaxSpeed = 0.7,
                    zoomFactor = 1.3;

                var parallaxTopGap = function() {
                    var gap = top * parallaxSpeed;

                    effectLayer.css({
                        height : height + gap + 'px',
                        top : (-gap) + 'px'
                    });
                };


                if (animation == ("parallax" || "parallaxZoomOut") ) {
                    parallaxTopGap();
                }

                var animationSet = function() {
                    scrollY = MK.val.scroll();

                    if (animation == "parallax") {
                        currentPoint = (startPoint + scrollY) * parallaxSpeed;
                        effectLayer.get(0).style.transform = 'translateY(' + currentPoint + 'px)';
                    }

                    if (animation == "parallaxZoomOut") {
                    	console.log(effectLayer);
                        currentPoint = (startPoint + scrollY) * parallaxSpeed;
                        progressVal = (1 / (endPoint - startPoint) * (scrollY - startPoint));
                        var zoomCalc = zoomFactor - ((zoomFactor - 1) * progressVal);

                        effectLayer.get(0).style.transform = 'translateY(' + currentPoint + 'px) scale(' + zoomCalc + ')';
                    }

                    if (animation == "gradient") {
                        progressVal = (1 / (endPoint - startPoint) * (scrollY - startPoint));
                        gradientLayer.css({
                            opacity: progressVal * 2
                        });
                    }

                    if (animation != "gradient") {
                        progressVal = (1 / (endPoint - startPoint) * (scrollY - startPoint));
                        cntLayer.css({
                            opacity: 1 - (progressVal * 4)
                        });
                    }

                    // Stop ticking
                    ticking = false;
                };
                animationSet();

                // This will limit the calculation of the background position to
                // 60fps as well as blocking it from running multiple times at once
                var requestTick = function() {
                    if (!ticking) {
                        window.requestAnimationFrame(animationSet);
                        ticking = true;
                    }
                };

                $window.off('scroll', requestTick);
                $window.on('scroll', requestTick);

	        });
	    }
	}


	var $window = $(window);
	var debounceResize = null;

	$window.on('load', mk_page_title_parallax);
    $window.on("resize", function() {
        if( debounceResize !== null ) { clearTimeout( debounceResize ); }
        debounceResize = setTimeout( mk_page_title_parallax, 300 );
    });

}(jQuery));
(function( $ ) {
	'use strict';

	var utils = MK.utils,
		core  = MK.core,
		path  = MK.core.path;

	MK.component.PhotoAlbum = function( el ) {
		this.album = el;
		this.initialOpen = false;
	};


	MK.component.PhotoAlbum.prototype = { 
		dom: {
			gallery 			: '.slick-slider-wrapper',
			title 				: '.slick-title',
			galleryContainer 	: '.slick-slides',
			closeBtn 			: '.slick-close-icon',
			thumbList 			: '.slick-dots',
			thumbs 				: '.slick-dots li',
			imagesData  		: 'photoalbum-images',
			titleData  			: 'photoalbum-title',
			idData  			: 'photoalbum-id',
			urlData  			: 'photoalbum-url',
			activeClass 		: 'is-active'
		},
 
		tpl: {
			gallery: '#tpl-photo-album',
			slide: '<div class="slick-slide"></div>'
		},

		init: function() {  
			this.cacheElements();
			this.bindEvents();
			this.openByLink();
		},

		cacheElements: function() {
			this.$album = $( this.album );
			this.imagesSrc = this.$album.data( this.dom.imagesData );

			this.albumLength = this.imagesSrc.length; 

			this.title = this.$album.data( this.dom.titleData );
			this.id = this.$album.data( this.dom.idData );
			this.url = this.$album.data( this.dom.urlData );

			this.images = []; // stores dom objects to insert into gallery instance
		},

		bindEvents: function() {
			this.$album.not('[data-photoalbum-images="[null]"]').on( 'click', this.albumClick.bind( this ) );
			$( document ).on( 'click', this.dom.closeBtn, this.closeClick.bind( this ) );
			$( window ).on( 'resize', this.thumbsVisibility.bind( this ) );
			$( window ).on( 'resize', this.makeArrows.bind( this ) );
		},

		albumClick: function( e ) {
			e.preventDefault();
			this.open();
			MK.ui.loader.add(this.album);
		},

		closeClick: function( e ) {
			e.preventDefault();

			// Because one close btn rules them all 
			if( this.slider ) {
				this.removeGallery();
				this.slider.exitFullScreen();  
			}
		},

		thumbsVisibility: function() {
			if( !this.thumbsWidth ) return;
			if( window.matchMedia( '(max-width:'+ (this.thumbsWidth + 260) +'px)' ).matches ) this.hideThumbs(); // 260 is 2 * 120 - right corner buttons width + scrollbar
			else this.showThumbs();
		},

		hideThumbs: function() {
			if( ! this.$thumbList ) return;
			this.$thumbList.hide();
		},

		showThumbs: function() {
			if( ! this.$thumbList ) return;
			this.$thumbList.show();
		},

		open: function() {
			var self = this;
			core.loadDependencies([ path.plugins + 'slick.js' ], function() {
				self.createGallery();
				self.loadImages();
			});
		},

		createGallery: function() {
			// only one per page
			if( ! $( this.dom.gallery ).length ) {
				var tpl = $( this.tpl.gallery ).eq( 0 ).html();
				$( 'body' ).append( tpl );
			}
			// and cache obj
			this.$gallery = $( this.dom.gallery ); 
			this.$closeBtn = $( this.dom.closeBtn );
		},

		createSlideshow : function() {
			var self = this;

			this.slider = new MK.ui.FullScreenGallery( this.dom.galleryContainer, {
				id: this.id,
				url: this.url
			});
			this.slider.init();

			$(window).trigger('resize');
			this.makeArrows();

			this.$thumbList = $( this.dom.thumbList );
			this.$thumbs = $( this.dom.thumbs ); 
			this.thumbsWidth = (this.$thumbs.length) * 95;
			this.thumbsVisibility();

			setTimeout(function() {
				MK.ui.loader.remove(self.album);
			}, 100);

			MK.utils.eventManager.publish('photoAlbum-open');
		},

		makeArrows: function() {
			if (this.arrowsTimeout) clearTimeout(this.arrowsTimeout);
			this.arrowsTimeout = setTimeout(function() {
				var $prev = $('.slick-prev').find('svg');
				var $next = $('.slick-next').find('svg');

				$prev.wrap('<div class="slick-nav-holder"></div>');
				$next.wrap('<div class="slick-nav-holder"></div>');

				if(matchMedia("(max-width: 1024px)").matches) {
					$prev.attr({width: 12, height: 22}).find('polyline').attr('points', '12,0 0,11 12,22');
					$next.attr({width: 12, height: 22}).find('polyline').attr('points', '0,0 12,11 0,22');
				} else {
					$prev.attr({width: 33, height: 65}).find('polyline').attr('points', '0.5,0.5 32.5,32.5 0.5,64.5');
					$next.attr({width: 33, height: 65}).find('polyline').attr('points', '0.5,0.5 32.5,32.5 0.5,64.5');
				}
			}, 0);
		},

		loadImages: function() {
			var self = this,
				n = 0;

			// cache images on first load. 
			if( ! this.images.length ) {
				this.imagesSrc.forEach( function( src ) {
					if(src === null) return; // protect from nulls
					var img = new Image(); 

					img.onload = function() {
						self.onLoad( n += 1 );
					};

					img.src = src; 
					self.images.push( img );
				});
			} else {
				this.onLoad( this.albumLength );
			}
		},

		onLoad : function( n ) {
			if( n === this.albumLength ) {
				this.insertImages(); 
				this.showGallery();
				this.createSlideshow();
			}
		},

		insertImages : function() {
			var $galleryContainer = this.$gallery.find( this.dom.galleryContainer ),
				$title = $( this.dom.title ),
				slide = this.tpl.slide;

			// clear first
			$galleryContainer.html( '' ); 
			$title.html( this.title );

			this.images.forEach( function( img ) {
				var $slide = $( slide );
				$slide.html( img );
				$galleryContainer.prepend( $slide );
			});
		},

		showGallery : function() {
			var self = this;

			this.$gallery.addClass( this.dom.activeClass );

			utils.scroll.disable();
 
		},

		removeGallery : function() {
			var self = this;

			this.$gallery.removeClass( this.dom.activeClass );

			setTimeout( function() {
				self.$gallery.remove();	
			}, 300 );

			utils.scroll.enable();
		},

		openByLink : function() {
			var loc = window.location,
				hash = loc.hash,
				id;

			if ( hash.length && hash.substring(1).length ) {
				id = hash.substring(1);
				id = id.replace( '!loading', '' );
				if( id == this.id && !this.initialOpen ) {
					this.initialOpen = true;
					this.open();
				}
			}
		}
	};


	// Barts note; Rifat duplication and coupling here. Remove it when have time
	MK.component.PhotoAlbumBlur = function( el ) {
         var init = function(){
			core.loadDependencies([ path.plugins + 'pixastic.js' ], function() {
         		blurImage($('.mk-album-item figure')); 
         	});
         };

         var blurImage = function($item) {
         	return $item.each(function() {
				var $_this = $(this);
				var img = $_this.find('.album-cover-image');
				img.clone().addClass("blur-effect item-blur-thumbnail").removeClass('album-cover-image').prependTo(this);

				var blur_this = $(".blur-effect", this);
				blur_this.each(function(index, element){
					if (img[index].complete === true) {
						Pixastic.process(blur_this[index], "blurfast", {amount:0.5});
					}
					else {
						blur_this.load(function () {
							Pixastic.process(blur_this[index], "blurfast", {amount:0.5});
						});
					}
				});
			});
         };

         return {
         	init : init
         };
    };

})( jQuery );
(function( $ ) {
	'use strict';

	var AjaxModal = function AjaxModal(el) {
		this.el = el;

		var $this = $(el);
		var action = $this.data( 'action' );
		var id = $this.data( 'id' );

		this.load(action, id);
	};

	AjaxModal.prototype = {
		// TODO decouple this
		init: function init(html) {
			var self = this;

			$('body').append( html );

			this.cacheElements();
			this.bindEvents();

			this.$modal.addClass( 'is-active' );

			MK.core.initAll(self.$modal.get(0));

			// Its used in Woocommerce Product variation script.
            $( '.variations_form' ).each( function() {
                $( this ).wc_variation_form().find('.variations select:eq(0)').change();
            });

            MK.utils.scroll.disable();
			MK.ui.loader.remove();
			MK.utils.eventManager.publish('quickViewOpen');
		},

		cacheElements: function cacheElement() {
			this.$modal = $('.mk-modal');
			this.$slider = this.$modal.find('.mk-slider-holder');
			this.$container = this.$modal.find('.mk-modal-container');
			this.$closeBtn = this.$modal.find('.js-modal-close');
		},

		bindEvents: function bindEvents() {
			this.$container.on('click', function(e) {
				e.stopPropagation();
			});

			this.$closeBtn.on('click', this.handleClose.bind(this));
			this.$modal.on('click', this.handleClose.bind(this));
		},

		handleClose: function handleClose(e) {
			e.preventDefault();
			MK.utils.scroll.enable();
			this.close();
		},

		close: function close() {
			this.$modal.remove();
		},

		load: function load(action, id) {
			$.ajax({
				url: MK.core.path.ajaxUrl,
				data: {
					action: action,
					id: id
				},
				success: this.init.bind( this ),
				error: this.error.bind( this )
			});
		},

		error: function error(response) {
			console.log(response);
		}
	};


	var createModal = function createModal(e) {
		e.preventDefault();
		var el = e.currentTarget;
		MK.ui.loader.add($(el).parents('.product-loop-thumb'));
		new AjaxModal(el);
	};


	$( document ).on( 'click', '.js-ajax-modal', createModal ); 

})( jQuery );
(function($) {
   if (window.addEventListener) {
      window.addEventListener('load', handleLoad, false);
    }
    else if (window.attachEvent) {
      window.attachEvent('onload', handleLoad);
    }

	function handleLoad() {
		$('.mk-slideshow-box').each(run);
	}

	function run() {
		var $slider = $(this);
		var $slides = $slider.find('.mk-slideshow-box-item');
		var $transition_time = $slider.data('transitionspeed');
		var $time_between_slides = $slider.data('slideshowspeed');

		$slider.find('.mk-slideshow-box-content').children('p').filter(function() {
			if ( $.trim($(this).text()) == '' ) {
				return true;
			}
		}).remove();

		// set active classes
		$slides.first().addClass('active').fadeIn($transition_time, function(){
			setTimeout(autoScroll, $time_between_slides);
		});

		// auto scroll
		function autoScroll(){
			if (isTest) return;
			var $i = $slider.find('.active').index();
			$slides.eq($i).removeClass('active').fadeOut($transition_time);
			if ($slides.length == $i + 1) $i = -1; // loop to start
			$slides.eq($i + 1).addClass('active').fadeIn($transition_time, function() {
				setTimeout(autoScroll, $time_between_slides);
			});
		}
	}
}(jQuery));
(function($) {
	'use strict';

	$(".mk-subscribe").each(function() {
		var $this = $(this);
		
		$this.find('.mk-subscribe--form').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: MK.core.path.ajaxUrl,
				type: "POST",
				data: {
					action: "mk_ajax_subscribe",
					email: $this.find(".mk-subscribe--email").val(),
					list_id: $this.find(".mk-subscribe--list-id").val(),
					optin: $this.find(".mk-subscribe--optin").val()
				},
				success: function (res) {
					$this.find(".mk-subscribe--message").html($.parseJSON(res).message);
					console.log($.parseJSON(res).message);
				}
			});
		});
	});

}(jQuery));
(function( $ ) {
    'use strict';

    // If we want to get access to API of already initilised component we run a regular new conctructor.
    // When instance is discovered in cache object then we return exisiting instance.
    // 
    // TODO move it to core functions and run logic on init
    var _instancesCollection = {};

    MK.component.SwipeSlideshow = function( el ) {
        var $this = $( el );
        var id = $this.parent().attr('id');

        this.el = el;
        this.id = id;
        this.config = $this.data( 'swipeslideshow-config' );
        if( this.config ) this.config.hasPagination = false;
    };

    MK.component.SwipeSlideshow.prototype = {
        init : function() {
            var slider = new MK.ui.Slider( this.el, this.config );
            slider.init();

            _instancesCollection[ this.id ] = slider;
        }
    };


    // Additional nav
    // Mostly for thumbs in woocommerce
    MK.component.SwipeSlideshowExtraNav = function( el ) {
        this.el = el;
    };

    MK.component.SwipeSlideshowExtraNav.prototype = {
        init : function init() {
            this.cacheElements();
            this.bindEvents();
        },

        cacheElements : function cacheElements() {
            var $this = $( this.el );

            this.sliderId = $this.data( 'gallery' );
            this.slider = _instancesCollection[this.sliderId]; 
            this.$thumbs = $( '#' + this.sliderId ).find( '.thumbnails a');
        },

        bindEvents : function bindEvents() {
            this.$thumbs.on( 'click', this.clickThumb.bind( this ) );
        },

        clickThumb : function clickThumb( e ) {
            e.preventDefault();
            var $this = $( e.currentTarget ),
                id = $this.index();

            this.slider.goTo( id );
        }
    };


    // Mostly for switcher in woocommerce
    MK.utils.eventManager.subscribe('gallery-update', function(e, config) {
        if(typeof _instancesCollection[config.id] === 'undefined') return;
        _instancesCollection[config.id].reset();
    });

})( jQuery );
(function($) {
    'use strict';

    var core = MK.core,
        path = core.path;

    MK.component.Tooltip = function(el) {
        var init = function() {
             $('.mk-tooltip').each(function() {
                $(this).find('.mk-tooltip--link').hover(function() {
                  $(this).siblings('.mk-tooltip--text').stop(true).animate({
                    'opacity': 1
                  }, 400);

                }, function() {
                  $(this).siblings('.mk-tooltip--text').stop(true).animate({
                    'opacity': 0
                  }, 400);
                });
              });
        };

        return {
            init: init
        };
    };

})(jQuery);

/* Flickr Feeds */
/* -------------------------------------------------------------------- */
(function ($) {
    'use strict';
function mk_flickr_feeds() {

    $('.mk-flickr-feeds').each(function() {
        var $this = $(this),
            apiKey = $this.attr('data-key'),
            userId = $this.attr('data-userid'),
            perPage = $this.attr('data-count'),
            column = $this.attr('data-column');

        jQuery.getJSON('https://api.flickr.com/services/rest/?format=json&method=' + 'flickr.photos.search&api_key=' + apiKey + '&user_id=' + userId + '&&per_page=' + perPage + '&jsoncallback=?', function(data) {

            jQuery.each(data.photos.photo, function(i, rPhoto) {
                var basePhotoURL = 'http://farm' + rPhoto.farm + '.static.flickr.com/' + rPhoto.server + '/' + rPhoto.id + '_' + rPhoto.secret;

                var thumbPhotoURL = basePhotoURL + '_q.jpg';
                var mediumPhotoURL = basePhotoURL + '.jpg';

                var photoStringStart = '<a ';
                var photoStringEnd = 'title="' + rPhoto.title + '" rel="flickr-feeds" class="mk-lightbox flickr-item a_colitem" href="' + mediumPhotoURL + '"><img src="' + thumbPhotoURL + '" alt="' + rPhoto.title + '"/></a>;';
                var photoString = (i < perPage) ? photoStringStart + photoStringEnd : photoStringStart + photoStringEnd;

                jQuery(photoString).appendTo($this);
            });
        });
    });

}
    mk_flickr_feeds();
})(jQuery);
(function ($) {
	'use strict';  

	function dynamicHeight() {
		var $this = $( this );

		$this.height( 'auto' );

		if( window.matchMedia( '(max-width: 768px)' ).matches ) {
			return;
		} 
		 
		$this.height( $this.height() );
	}


	var $window = $( window );
	var container = document.getElementById( 'mk-theme-container' );

	$( '.equal-columns' ).each( function() { 
		dynamicHeight.bind( this );
	    $window.on( 'load', dynamicHeight.bind( this ) );
	    $window.on( 'resize', dynamicHeight.bind( this ) );
	    window.addResizeListener( container, dynamicHeight.bind( this ) );
	});

}( jQuery ));