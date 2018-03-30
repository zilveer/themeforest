/*
 * Copyright 2014 Valeriu Timbuc
 * vtimbuc.com
 */

;(function($) {

  "use strict";

	var defaults = {
		accordionOn: ['xs']
	};

	$.fn.uouTabs = function(options) {

		var config = $.extend({}, defaults, options),
        accordion = '';

		$.each(config.accordionOn, function(index, value) {
			accordion += ' accordion-' + value;
		});

    return this.each(function() {

      var $self = $(this),
          $links = $self.children('.tabs').find('> li > a'),
          $content = $self.children('.content'),
          $tabs = $content.children('div');

      $self.addClass(accordion);

      // Duplicate links for accordion
      $links.each(function(i) {
        var $this = $(this),
            id = $this.attr('href'),
            active = '',
            first = '',
            last = '';

        // Add active class
        if ($this.parent('li').hasClass('active')) {
          active = ' active';
        }

        // Add first class
        if (i === 0) {
          first = ' first';
        }

        // Add last class
        else if (i === $links.length - 1) {
          last = ' last';
        }

        $this.clone(false).addClass('accordion-link' + active + first + last).insertBefore(id);
      });

      var $accordionLinks = $content.children('.accordion-link');

      // Tabs Click Event
      $links.on('click', function(event) {
        event.preventDefault();

        var $this = $(this),
            $li = $this.parent('li'),
            $siblings = $li.siblings('li'),
            id = $this.attr('href'),
            $accordionLink = $content.children('a[href="' + id + '"]');

        if (!$li.hasClass('active')) {
          $li.addClass('active');
          $siblings.removeClass('active');

          $tabs.removeClass('active');
          $(id).addClass('active');

          $accordionLinks.removeClass('active');
          $accordionLink.addClass('active');
        }
      });

      // Accordion Click Event
      $accordionLinks.on('click', function(event) {
        event.preventDefault();

        var $this = $(this),
            id = $this.attr('href'),
            $tabLink = $self.find('li > a[href="' + id + '"]').parent('li');

        if (!$this.hasClass('active')) {
          $accordionLinks.removeClass('active');
          $this.addClass('active');

          $tabs.removeClass('active');
          $(id).addClass('active');

          $links.parent('li').removeClass('active');
          $tabLink.addClass('active');
        }
      });

    });

	};

}(jQuery));
