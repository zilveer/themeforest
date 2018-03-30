
var ArchiveParallax = (function() {

	var $pileItems,
		initialized = false,
		top,
		bottom;

	function initialize() {

		bindEvents();
		$window.on('infiniteLoad', function() {
			bindEvents();
		});

        if ( $('.pile').is('.pile--no-3d, .pile--single') ) return;

        $pileItems = $('.pile-item--archive');

		var count = Math.round( $('.pile').width() / $pileItems.first().outerWidth() );

		set3DClasses(count);
		bindEvents();

		$('.pile--portfolio-archive').imagesLoaded(function() {
			// Call the Parallax only when 3D Grid is active
		    addMissingPadding();

		    prepare();
		    initialized = true;
		    update();
		});
	}

	function bindEvents() {

		if ( Modernizr.touchevents ) {
			return;
		}

		$('.pile-item-wrap').unbind('mouseenter mouseleave');

		$('.pile-item-wrap').each(function(index, item) {
			var $item       = $(item),
	            $border     = $item.find('.pile-item-border'),
	            $image      = $item.find('img'),
	            $content    = $item.find('.pile-item-content'),
	            $title      = $item.find('.pile-item-title'),
	            $meta       = $item.find('.pile-item-meta'),
	            $bg       	= $item.find('.pile-item-bg'),
	            $link       = $item.find('.pile-item-link'),
	            is3D        = !! $item.closest('.js-3d').length,
	            borderWidth = parseInt($border.css('fontSize')),
	            transitionReset = Math.min(Math.max(parseInt(parseInt($border.css('lineHeight'))), 0), 1),
	            // Make the transition timing dependend to borderWidth
	            // but keep it within a 0.3s to 0.8s interval
	            transition  = Math.min(Math.max(parseInt(borderWidth)/5, 3), 8)/10*transitionReset;

	        if ( is3D || $item.closest('.pile-item').is('.product') ) {
	            borderWidth = borderWidth / 1.4;
	            $title.css('fontSize', '24px');
	        } else {
	            $title.css('fontSize', '38px');
	        }

	        var removeClassTimeout;

            $item.hover(function () {
            	clearTimeout(removeClassTimeout);
    			$bg.removeAttr('style');
            	$bg.addClass('to-animate');

	            TweenMax.from($bg, transition, {opacity: 0});
	            TweenMax.to($border, transition, {borderWidth: borderWidth, ease: Power4.easeOut});
	            TweenMax.fromTo($meta, transition, {y: - borderWidth}, {y: 0, ease: Power4.easeOut});
	            TweenMax.fromTo($link, transition, {y: borderWidth}, {y: 0, ease: Power4.easeOut});
	            TweenMax.to($content, transition, {opacity: 1, ease: Power2.easeOut});

            }, function () {
	            TweenMax.to($bg, transition, {opacity: ''});
	            TweenMax.to($border, transition, {borderWidth: 0, ease: Power4.easeOut});
	            TweenMax.to($meta, transition, {y: - borderWidth, ease: Power4.easeOut});
	            TweenMax.to($link, transition, {y: borderWidth, ease: Power4.easeOut});
	            TweenMax.to($content, transition, {opacity: 0, ease: Power2.easeOut});

        		removeClassTimeout = setTimeout(function() {
        			$bg.removeClass('to-animate');
        			$bg.removeAttr('style');
        		}, transition * 1000);

            });

		});

	}

	function prepare() {

		var parallaxAmount = parseInt($body.data('parallax'), 10) / 100;

		$pileItems.each(function (i, element) {

			var $item           = $(element),
                itemTop         = $item.offset().top,
				itemHeight      = $item.outerHeight(),
				parallaxInfo    = {
					start       : itemTop - windowHeight,
					end         : itemTop + itemHeight
				},
				initialTop      = itemHeight * parallaxAmount / 2,
				timeline        = new TimelineMax({paused: true});

			if ($item.is('.js-3d')) {
				initialTop = initialTop * 2;
			}

			timeline.fromTo($item, 1, {
				y: initialTop
			}, {
                y: initialTop * -1,
                ease: Linear.easeNone,
                force3D: true
            });

			parallaxInfo.timeline = timeline;
			// bind sensible variables for tweening to the image using a data attribute
			$item.data('parallax', parallaxInfo);

		});
	}

	function set3DClasses(count) {
		var odd = 0;

		if ( $('.pile').hasClass('pile--odd') ) {
			odd = 1;
		}

		if ( count < 2 ) {
			$pileItems.removeClass('js-3d');
		}

		$pileItems.each(function (i, element) {
			var $item = $(element),
				index = i;

			if ( $('.pile').hasClass('pile--column') ) {
				$item.toggleClass('js-3d', !! ((parseInt(index / count) + odd + index) % 2));
			} else {
				$item.toggleClass('js-3d', !! ((parseInt(index / count) + odd + index % count) % 2));
			}
		});
	}

	function addMissingPadding() {
		var parallaxAmount = parseInt($body.data('parallax'), 10) / 100;

		var $content = $('.pile'),
			top = 0,
			bottom = 0,
			maxMissingTop   = 0,
            maxMissingBtm   = 0;

        $content.css({
            'paddingTop': '',
            'paddingBottom': ''
        });

        bottom = $document.height();

        $pileItems.each(function (i, element) {

            TweenMax.to($(element), 0, {y: 0});

            var $item           = $(element),
                itemTop         = $item.offset().top,
                itemHeight      = $item.outerHeight(),
                toTop           = itemTop + itemHeight/2 - top,
                toBottom        = bottom - itemTop - itemHeight/2,
                missingTop      = toTop < windowHeight/2 ? (windowHeight/2 - toTop) : 0,
                missingBottom   = toBottom < windowHeight/2 ? (windowHeight/2 - toBottom) : 0,
                paddingLimit 	= itemHeight * parallaxAmount/2;

            maxMissingTop   = Math.max(Math.min(missingTop, paddingLimit), maxMissingTop);
            maxMissingBtm   = Math.max(Math.min(missingBottom, paddingLimit), maxMissingBtm);
        });

        if ( maxMissingBtm || maxMissingBtm ) {
	        $content.css({
	            'paddingTop': '+=' + maxMissingTop,
	            'paddingBottom': '+=' + maxMissingBtm
	        });
        }
	}

	function update() {
		if ( ! initialized ) return;

		$pileItems.each(function (i, obj) {
			var $item 	= $(obj),
				options = $item.data('parallax');

			if ( ! empty(options) ) {
				if (options.end - options.start == 0) {
					return;
				}

				var progress = (1 / (options.end - options.start)) * (latestKnownScrollY - options.start);

				if (1 >= progress && 0 <= progress) {
			    	options.timeline.progress(progress);
				}
			}

		});
	}

	function destroy() {
		initialized = false;
		$pileItems = $();
	}

	return {
		initialize: initialize,
		update: update,
		destroy: destroy
	}
})();
