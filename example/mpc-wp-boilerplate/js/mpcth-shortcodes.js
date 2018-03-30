jQuery(document).ready(function($) {

/* ---------------------------------------------------------------- */
/* Tabs
/* ---------------------------------------------------------------- */

	if($('.mpcth-sc-tabs').hasClass('mpcth-sc-tabs-vertical')) tabSetMinSize();

	$('.mpcth-sc-tabs')
		.on('click', '.mpcth-sc-tabs-title', function(e) {
			var $tab = $(this);
			var $content = $($tab.children('a').attr('href'));

			$tab
				.addClass('mpcth-sc-tabs-active')
				.siblings('.mpcth-sc-tabs-title')
					.removeClass('mpcth-sc-tabs-active');

			$content
				.stop(true, true)
				.fadeIn()
				.siblings('.mpcth-sc-tabs-content')
					.hide();

			e.preventDefault();
		})
		.find('.mpcth-sc-tabs-title')
			.first()
				.click();

/* ---------------------------------------------------------------- */
/* Tooltip
/* ---------------------------------------------------------------- */

	tooltipSetSize();

	$('.mpcth-sc-tooltip-wrap').on('mouseenter', function() {
		$message = $(this).children('.mpcth-sc-tooltip');
		$message.show();
	})

	$('.mpcth-sc-tooltip-wrap').on('mouseleave', function() {
		$message = $(this).children('.mpcth-sc-tooltip');
		$message.hide();
	})

/* ---------------------------------------------------------------- */
/* Fancybox
/* ---------------------------------------------------------------- */

	$("a.mpcth-sc-fancybox").live('click', function() {
		$this = $(this);
		// Lighbox Image
		if($this.hasClass('mpcth-image')) {
			$.fancybox({
				'padding' : 0,
				'transitionIn'	: 'fade',
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href
			});
		// Lighbox YouTube Video
		} else if($this.hasClass('mpcth-youtube-video')){
			$.fancybox({
				'padding' : 0,
				'autoScale'		: true,
				'transitionIn'	: 'fade',
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
				'wmode'				: 'transparent',
				'allowfullscreen'	: 'true'
				}
			});
		// Lighbox Vimeo Video
		} else if($this.hasClass('mpcth-vimeo-video')){
			$.fancybox({
				'padding' : 0,
				'autoScale'		: true,
				'transitionIn'	: 'fade',
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href,
				'type'			: 'iframe'
			});
		// Lighbox iFrame
		} else if($this.hasClass('mpcth-iframe')){
			$.fancybox({
				'padding'			 : 0,
				'width'				: '75%',
				'height'			: '75%',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'title'				: this.title,
				'href'				: this.href,
				'type'				: 'iframe'
			});
		// Lighbox SWF
		} else if($this.hasClass('mpcth-swf')){
			$.fancybox({
				'padding' 			: 0,
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'title'				: this.title,
				'href'				: this.href,
				'type'				: 'swf'
			});
		}

		return false;
	});

/* ---------------------------------------------------------------- */
/* Alert
/* ---------------------------------------------------------------- */

	$('.mpcth-sc-alert').on('click', '.mpcth-sc-alert-close', function(e) {
		var $alert = $(this).parent();

		$alert.fadeOut(function() {
			$alert.remove();
		});

		e.preventDefault();
	})

/* ---------------------------------------------------------------- */
/* Toggle
/* ---------------------------------------------------------------- */

	toggleSetSize();

	$('.mpcth-sc-toggle')
		.data('open', false)
		.on('click', '.mpcth-sc-toggle-title', function(e) {
			var $this = $(this);
			$this.next().stop(true, true);

			if($this.data('open')) {
				$this.next().slideUp();
			} else {
				$this.next().slideDown();
			}

			$this.data('open', !$this.data('open'));

			e.preventDefault();
		})

/* ---------------------------------------------------------------- */
/* Resizing
/* ---------------------------------------------------------------- */

	$(window).on('resize', function() {
		toggleSetSize();
	})

	function toggleSetSize() {
		$('.mpcth-sc-toggle-content').each(function() {
			$toggle = $(this);

			$toggle.width($toggle.siblings('.mpcth-sc-toggle-title').width());
		});
	}

	function tooltipSetSize() {
		$('.mpcth-sc-tooltip').each(function() {
			$tooltip = $(this);

			$tooltip.css({
				width: $tooltip.outerWidth(),
				position: 'absolute',
				visibility: 'visible',
				display: 'none'
			})
		});
	}

	function tabSetMinSize() {
		$('.mpcth-sc-tabs-content').each(function() {
			$tab = $(this);

			$tab.css('min-height', $tab.siblings('ul').height() - 2 * parseInt($tab.css('padding')));
		});
	}

});