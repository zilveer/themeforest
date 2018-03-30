/*
 * Copyright 2014 Valeriu Timbuc
 * vtimbuc.com
 */

;(function($) {

  "use strict";

	var defaults = {
	};

	$.fn.uouAccordions = function(options) {

		var config = $.extend({}, defaults, options);

    return this.each(function() {

      var $self = $(this),
          $links = $self.find('> li > a'),
          $content = $self.find('> li > div');

      // Click Event
      $links.on('click', function(event) {
        event.preventDefault();

        var $this = $(this),
            $li = $this.parent('li'),
            $div = $this.siblings('div'),
            $siblings = $li.siblings('li').children('div');

        if (!$li.hasClass('active')) {
          $siblings.slideUp(250, function () {
            $(this).parent('li').removeClass('active');
          });

          $div.slideDown(250, function () {
            $li.addClass('active');
          });
        } else {
          $div.slideUp(250, function () {
            $li.removeClass('active');
          });
        }
      });

    });

	};

}(jQuery));
