var AjaxLoading = (function() {

	var timelinePromise = function(timeline) {
		return new Promise(function(resolve) {
			// alternate syntax for adding a callback
			timeline.eventCallback("onComplete", function() {
				resolve(true);
			});
		});
	}

	function init() {

		if ( $body.is('.is--customizer-preview') || typeof $body.data('ajaxloading') === "undefined" ) {
			return;
		}

		var ignored = ['.pdf', '.doc', '.eps', '.png', '.jpg', '.jpeg', '.zip', 'admin', 'wp-', 'wp-admin', 'feed', '#', '&add-to-cart=', '?add-to-cart=', '?remove_item'],
			$border = $('.js-border'),
			borderColor = '',
			timelineOut = null;

		if ( typeof pile_non_ajax_links === "object" && pile_non_ajax_links.length >= 1 ) {
			ignored = ignored.concat( pile_non_ajax_links )
		}

		var barbaPreventCheck = Barba.Pjax.preventCheck;

		Barba.Pjax.preventCheck = function(ev, element) {

		    if (!element || !element.href)
		      	return false;

			for (var i = ignored.length - 1; i >= 0; i--) {
				if (element.href.indexOf(ignored[i]) > -1) {
					return false;
				}
			}

			return barbaPreventCheck(ev, element);
		}

		Barba.Pjax.start();

		Barba.Dispatcher.on('linkClicked', function(obj) {
			$body.removeClass('js-open-cart is-cart-open');
			borderColor = $(obj).data('color');
			timelineOut = $(obj).is('.pile-item-wrapper-link') ? projectBorderOutTimeline($(obj)) : null;
		});

		var FadeTransition = Barba.BaseTransition.extend({
			start: function() {
			    /**
			     * This function is automatically called as soon the Transition starts
			     * this.newContainerLoading is a Promise for the loading of the new container
			     * (Barba.js also comes with an handy Promise polyfill!)
			     */
			     var _this = this;
			    // As soon the loading is finished and the old page is faded out, let's fade the new page
			    Promise
			    .all([this.newContainerLoading, this.fadeOut()])
			    .then(this.fadeIn.bind(this));
			},

			fadeOut: function() {
			    /**
			     * this.oldContainer is the HTMLElement of the old Container
			     */
				var _this = this;

			     if ( timelineOut === null ) {
			     	timelineOut = borderOutTimeline();
			     }

				timelineOut.play();

				Nav.hideMenu();

			    return timelinePromise(timelineOut).then(function() {
			    	var $old = $(_this.oldContainer);

	    			$old.find('video').each(function() {
					    this.pause(); // can't hurt
					    delete this; // @sparkey reports that this did the trick (even though it makes no sense!)
					    this.src = ""; // empty source
						this.load();
					    $(this).remove(); // this is probably what actually does the trick
					});

			    	$old.hide();
			    	timelineOut = null;
			    });
			 },

			 fadeIn: function() {
			    /**
			     * this.newContainer is the HTMLElement of the new Container
			     * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
			     * Please note, newContainer is available just after newContainerLoading is resolved!
			     */
			    var _this = this;
			    var $el = $(this.newContainer);

			    var timeline = new TimelineMax({ paused: true });

				$(window).scrollTop(0);
				$border.css('backgroundColor', 'transparent');

				timeline.to($border, 0.6, { borderWidth: 0, ease: Quart.easeInOut });
				timeline.fromTo('.hero-content', .4, { opacity: 0, y: 50 }, { opacity: 1, y: 0, ease: Quad.easeOut }, '-=.4');
				timeline.fromTo('.hero-slider', .4, { scale: 1.2 }, { scale: 1, ease: Quad.easeOut }, '-=.4');

				Barba.Pjax.Cache.data[Barba.HistoryManager.currentStatus().url].then(function(data) {
					// get data and replace the body tag with a nobody tag
					// because jquery strips the body tag when creating objects from data

					data = data.replace(/(<\/?)body( .+?)?>/gi, '$1NOTBODY$2>', data);

					// get the nobody tag's classes

					var nobodyClass = $(data).filter('notbody').attr("class");

					// set it to current body tag

					if ($body.hasClass('error404')) {
						$body.css('backgroundImage', '');
					}
					$body.attr('class', nobodyClass);

					// need to get the id and edit string from the data attributes
					var curPostID = $(data).filter('notbody').data("curpostid"),
						curPostTax = $(data).filter('notbody').data("curtaxonomy"),
						curPostEditString = $(data).filter('notbody').data("curpostedit");

					adminBarEditFix(curPostID, curPostEditString, curPostTax);
					onDjaxLoad();
				});

				_this.done();
				timeline.play();
			}
		});

		function onDjaxLoad() {
			onLoad();
			eventHandlers();
			// there are some things that should happen only when loading a page with dJax, not in the first "normal" loadUp
			loadUpDJaxOnly();
		}

		function borderOutTimeline() {

			var borderX = windowWidth / 2,
				borderY = windowHeight / 2,
				timeline = new TimelineMax({ paused: true });

			$border.css({
				top: 0,
				left: 0,
				scale: 1,
				width: windowWidth,
				height: windowHeight,
		        borderWidth: '0 0',
		        borderColor: borderColor,
				display: 'block'
			});

			timeline.fromTo($border, 0.6, {
				x: 0,
				y: 0,
				scale: 1
			}, {
		        borderWidth: borderY + ' ' + borderX,
		        ease: Quart.easeInOut
			});

			return timeline;
		}

		function projectBorderOutTimeline($item) {

			var offset 		= $item.offset(),
				itemWidth 	= $item.outerWidth(),
				itemHeight 	= $item.outerHeight(),
				borderX 	= (itemWidth + 1) % 2 ? (itemWidth + 1) / 2 : itemWidth / 2 + 1,
				borderY 	= (itemHeight + 1) % 2 ? (itemHeight + 1) / 2 : itemHeight / 2 + 1,
				scaleX 		= windowWidth / itemWidth,
				scaleY 		= windowHeight / itemHeight,
				borderColor = $item.find('.pile-item-border').css('borderTopColor'),
				moveX 		= windowWidth / 2 - offset.left - itemWidth / 2,
				moveY 		= windowHeight / 2 - (offset.top - latestKnownScrollY) - itemHeight / 2;

			$border.css({
				display: 'block',
				top: offset.top - latestKnownScrollY - 1,
				left: offset.left - 1,
				right: 'auto',
				bottom: 'auto',
				width: itemWidth + 2,
				height: itemHeight + 2,
				borderColor: borderColor
			});

			var timeline = new TimelineMax({paused: true});

			timeline.to($border, .4, {
		        borderWidth: borderY + ' ' + borderX,
				ease: Quart.easeInOut,
				onComplete: function () {
					$border.css('backgroundColor', $border.css('borderTopColor'));
				}
			});

			timeline.fromTo($border, .5, {
				x: 0,
				y: 0,
				scaleX: 1,
				scaleY: 1
			}, {
				x: moveX,
				y: moveY,
				scaleX: scaleX,
				scaleY: scaleY,
				ease: Power3.easeInOut
			});

			return timeline;
		}


		/**
		 * Next step, you have to tell Barba to use the new Transition
		 */

		 Barba.Pjax.getTransition = function() {
		  /**
		   * Here you can use your own logic!
		   * For example you can use different Transition based on the current page or link...
		   */

		   return FadeTransition;
		};
	}


	return {
		init: init
	}

})();
