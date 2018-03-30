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