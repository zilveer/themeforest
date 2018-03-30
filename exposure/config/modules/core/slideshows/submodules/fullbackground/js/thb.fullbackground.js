(function($) {
	$.thb.fullbackground = function( action, params ) {
		this.params = {};

		this.extend_params = function( params ) {
			this.params = $.extend({}, {
				container: '#thb-full-background',
				prev: '#thb-full-background_prev',
				next: '#thb-full-background_next',
				controls: 1,
				keyboard: 1,
				autoplay: 1,
				fit: 0,
				onSlideLoaded: function() {},
				onSlidesLoaded: function() {}
			}, params);
		};

		this.init = function( params ) {
			var self = this;
			this.extend_params(params);

			$(this.params.container)
				.thb_stretcher({
					adapt: this.params.fit,
					onSlideLoaded: this.params.onSlideLoaded,
					onSlidesLoaded: this.params.onSlidesLoaded,
					slides: '> .slide'
				});

			if( this.params.controls == 1 ) {
				this.assignControlsNavigation();
			}

			if( this.params.keyboard == 1 ) {
				this.assignKeyboardNavigation();
			}

			$(this.params.container).on('cycle-after', function( event, opts ) {
				var slide = $(this).find('.slide').eq(opts.currSlide);
				self.pauseVideos(slide);
			});

			if( !this.params.autoplay || $(this.params.container).find('.slide').first().data('autoplay') == '1' ) {
				$(this.params.container).cycle("pause");
			} else {
				$(this.params.container).find("video, iframe").on("change", function(e, state) {
					if( state == "finished" || state == "paused" ) {
						self.resume();
					}
					else {
						self.pause();
					}
				});
			}
		};

		this.fit = function( params ) {
			this.extend_params(params);

			$("body").addClass("thb-full-background-fit");

			$(this.params.container)
				.thb_stretcher({
					adapt: true
				});
		};

		this.unfit = function( params ) {
			this.extend_params(params);

			$("body").removeClass("thb-full-background-fit");

			$(this.params.container)
				.thb_stretcher({
					adapt: false
				});
		};

		this.assignControlsNavigation = function() {
			var self = this;

			$(this.params.next).on("click", function() {
				self.next();
			});

			$(this.params.prev).on("click", function() {
				self.prev();
			});
		};

		this.assignKeyboardNavigation = function() {
			var self = this;

			$.thb.key("right", function() {
				if( !$("input,textarea").is(":focus") ) {
					self.next();
				}
			}, true);

			$.thb.key("left", function() {
				if( !$("input,textarea").is(":focus") ) {
					self.prev();
				}
			}, true);

			$.thb.key("space", function() {
				if( !$("input,textarea").is(":focus") ) {
					if( $(self.params.container).is('.cycle-paused') ) {
						self.resume();
					}
					else {
						self.pause();
					}
				}
			}, true);
		};

		this.prev = function() {
			$(this.params.container).cycle('prev');
		};

		this.next = function() {
			$(this.params.container).cycle('next');
		};

		this.pause = function() {
			$(this.params.container).cycle('pause');
		};

		this.pauseVideos = function(slide) {
			$(slide).find('video, iframe').each(function() {
				$(this).data("player").pause();
			});
		};

		this.resume = function() {
			if( this.params.autoplay ) {
				this.pauseVideos();
				$(this.params.container).cycle('resume');
			}
		};

		if( action && this[action] ) {
			this[action](params);
		}
	};

	$(document).ready(function() {
		var config = $.thb.config.get('fullbackground');

		config.onSlidesLoaded = function() {
			setTimeout(function() {
				$("#thb-full-background").addClass("thb-loaded");
			}, 50);
		};

		$.thb.fullbackground("init", config);

		$('#thb-full-background').on('cycle-after', function(e, opts) {
			$('#thb-full-background-captions').cycle('goto', opts.nextSlide);
		});

		function changeCarouselItem() {
			$("#thb-full-background")
				.on("cycle-after", function(event, optionHash) {
					ce.setCurrent(optionHash.nextSlide);
					$("#thb-full-background-carousel .slide").removeClass("active");
					$("#thb-full-background-carousel .slide").eq(optionHash.nextSlide).addClass("active");
				});
		}

		if( config.carousel ) {
			var carousel = $("#thb-full-background-carousel ul");

			var ce = carousel.elastislide({
				imageW: 120,
				border: 0,
				margin: 0,
				minItems: 2,
				onClick: function( item ) {
					$("#thb-full-background-carousel .slide").removeClass("active");
					$(item).addClass("active");

					var slideshow = $("#thb-full-background");
					slideshow.cycle('goto', $(item).index());
				},
				onReady: function() {
					changeCarouselItem();
				}
			});
		}
	});
})(jQuery);