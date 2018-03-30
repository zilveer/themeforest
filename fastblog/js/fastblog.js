/**
 * @package Fast_Blog_Theme
 * @since Fast Blog 1.0
 */

// -----------------------------------------------------------------------------

(function($) {
	
	'use strict';

	$(document).ready(function($) {
	
		// Flickr API key
		var flickr_api_key = '6baa65d21a4e4139d5e2f1b4943dcb2e';
		
		// Browsers support
		var ie = $.browser.msie ? parseInt($.browser.version) : 256;

		// Form
		$('p:not(.input):has(> input[type="text"]), .post .content div:not(.input):has(> input[type="text"])').addClass('input');
		$('p:not(.textarea):has(> textarea), .post .content div:not(.textarea):has(> textarea)').addClass('textarea');
		$('p:not(.submit):has(> input[type="submit"]), .post .content div:not(.submit):has(> input[type="submit"])').replaceWith(function() {
			var title = $('input', this).val();
			return '<p class="submit"><a title="'+title+'">'+title+'</a></p>';
		});
		$('form .submit a').click(function() {
			$(this).parentsUntil('form').last().parent().submit();
		});
		
		// Menu
		$('#menu li:has(> ul) > a').append(' &rsaquo;');
	 
		// Cufon font replacement
		var gradient = {color: scheme.colors.gradient.primary, hover: {color: scheme.colors.gradient.secondary}};
		var cufon_replace = {
			logo:         [{selector: '#logo span', options: {color: scheme.colors.gradient.secondary}}],
			tagline:      [{selector: '#tagline', options: {}}],
			menu:         [{selector: '#menu li:not(.current) > a', options: gradient}, {selector: '#menu li.current > a', options: {color: scheme.colors.gradient.secondary}}],
			post_title:   [{selector: '.post .title', options: gradient}],
			widget_title: [{selector: '#sidebar .title', options: {}}],
			headlines:    [{selector: '.post .content h1, .post .content h2, .post .content h3, .post .content h4', options: gradient}],
			shortcode:    [{selector: '.cufon-shortcode', options: {}}],
			other:        [{selector: 'form .submit a, .message', options: gradient}],
			custom:       [{selector: typography.custom_selector, options: {}}]
		};
		for (var element in typography.fonts) {
			for (var i in cufon_replace[element]) {
				var selector = cufon_replace[element][i].selector;
				if (!selector) continue;
				var options = cufon_replace[element][i].options;
				options['fontFamily'] = typography.fonts[element];
				$(selector).addClass('cufon');
				Cufon.replace(selector, options);
			}
		}
	
		// Menu
		if (ie <= 7) {
			$('#menu li ul').each(function() {
				var max_width = 0;
				$('> li', this).each(function() {
					var cufon_width = 0;
					$('> a > cufon', this).each(function() {
						cufon_width += parseInt($(this).css('width'));
					});
					if (cufon_width == 0) cufon_width = 150;
					max_width = Math.max(max_width, cufon_width);
				});
				$('> li', this).css('width', (max_width+20)+'px');
			});
		}
		
		// Search
		$('#search input[name="s"]').focus(function(){
			if ($(this).val() == fastblog.search) $(this).val('');
		}).blur(function() {
			if ($(this).val() == '') $(this).val(fastblog.search);
		});
		
		// Post
		var posts = $('.post');
		if (ie >= 9) $('.corner, .post-icon > *', posts).fadeTo(0, 0).css('display', 'block');
		posts.hover(function() {
			var icon = $('.corner, .post-icon > *', this);
			if (ie >= 9) icon.stop(true).fadeTo('fast', 1); else icon.css('display', 'block');
		}, function() {
			var icon = $('.corner, .post-icon > *', this);
			if (ie >= 9) icon.stop(true).fadeTo('fast', 0); else icon.hide();
		});
		
		// Comments
		$('.comment').hover(function() {
			$('.tools', this).css('visibility', 'visible');
		}, function() {
			$('.tools', this).css('visibility', 'hidden');
		});
	
		// Twitter and Flickr widgets
		$('.widget_twitter, .widget_flickr').each(function() {
			if (ie >= 9) $('.title a', this).fadeTo(0, 0).css('display', 'block'); 
			$('.title', this).hover(function() {
				var a = $('a', this);
				if (ie >= 9) a.stop(true).fadeTo('fast', 1); else a.css('display', 'block');
			}, function() {
				var a = $('a', this);
				if (ie >= 9) a.stop(true).fadeTo('fast', 0); else a.hide();
			});
		});
		
		// Contact form
		$('.contact-form').submit(function() {
			if ($('.submit', this).hasClass('disabled')) return false;
			$('.submit', this).addClass('disabled').fadeTo('normal', 0.4);
			$('.status', this).text('');
			$('.loader', this).fadeIn('normal');
			$.post($(this).attr('action'), $(this).serialize(), function(data) {
				var contact_form = $('.contact-form');
				if (data.result) $('input[type!=hidden], textarea', contact_form).val('');
				$('.submit', contact_form).removeClass('disabled').fadeTo('normal', 1);
				$('.status', contact_form).text(data.message);
				$('.loader', contact_form).fadeOut('normal');
			}, 'json');
			return false;
		});
		
		// Newsletter Sign-Up
		$('.nsu_widget form label').remove();
		
		// Fancybox
		if (fancybox.enabled) {
			$('a.fancybox, .post .content a:has(img)').filter(function () {
				return $(this).hasClass('fancybox') || /\.(jpe?g|png|gif|bmp)$/i.test($(this).attr('href'));
			}).attr('rel', function() {
				return 'fancybox-'+$(this).parentsUntil('.post, #sidebar > li').last().parent().attr('id');
			}).attr('title', function() {
				var img = $('img', this);
				if (!$(this).attr('title') && img.length > 0) {
					return img.attr('title') ? img.attr('title') : img.attr('alt');
				}
				else {
					return $(this).attr('title');
				}
			}).each(function() {
				var options = {titleShow: fancybox.show_title, showNavArrows: true};
				var matches = $(this).attr('href').match(/^http:\/\/(www\.youtube\.com\/watch\?v=|youtu\.be\/)([-_a-z0-9]+)/i);
				if (matches != null) {
					$(this).attr('href', 'http://www.youtube.com/v/'+matches[2]);
					$.extend(options, {type: 'swf', swf: {allowfullscreen: 'true', wmode: 'transparent'}});
				}
				$(this).fancybox(options);	
			});
		}
		
	});

})(jQuery);