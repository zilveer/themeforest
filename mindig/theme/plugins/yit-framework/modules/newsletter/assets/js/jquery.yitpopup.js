/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
(function($, window, document) {
    "use strict";

    $.yit_popup = function(element, options) {

        var defaults = {
            'popup_class' : 'yit-popup',
            'content' : ''
        };

        var self = this;

        self.settings = {};

        var $element = $(element),
            overlay = null,
            popup = null,
            close = null;

        self.init = function() {
            self.settings = $.extend({}, defaults, options);

            _createElements();
            _initEvents();

        };

        var _initEvents = function() {
                $(document).on('touchstart click', '.yitpopup_overlay', function(e){
                    if( $( e.target).hasClass('close') || $( e.target ).parents( '.yitpopup_overlay' ).length == 0 ) {
                        _close();
                    }
                }).on('keyup', function(e) {
                        if (e.keyCode == 27) {
                            _close();
                        }
                    }).on('click', '.yitpopup_wrapper a.close', function () {
                        _close();
                    });

                $(window).on('resize', function(){
                    _center();
                });

                $('html').removeClass('yit-opened');

                _open();
            },

            _createElements = function() {
                if( $('body').find('.yitpopup_overlay').length == 0 ) {
                    self.overlay = $('<div />', {
                        'class' : 'yitpopup_overlay'
                    }).appendTo('body');
                } else {
                    self.overlay = $('body').find('.yitpopup_overlay');
                }

                if( self.overlay.find('.yitpopup_wrapper').length == 0 ) {
                    self.popup = $('<div />', {
                        'class' : 'yitpopup_wrapper ' + self.settings.popup_class
                    }).appendTo( $('body') );
                } else {
                    self.popup = $('body').find('.yitpopup_wrapper');
                }

                if( self.overlay.find('.close').length == 0 ) {
                    self.close = $('<a />', {
                        'class' : 'close'
                    }).appendTo( self.popup );
                } else {
                    self.close = self.overlay.find('.close');
                }
            },

            _center = function() {
                self.popup.css({
                    position: 'fixed',
                    top: Math.max(0, ((jQuery(window).height() - self.popup.outerHeight()) / 2) - 50 ) + "px",//'15%',
                    left: Math.max(0, ((jQuery(window).width() - self.popup.outerWidth()) / 2) ) + "px"
                });
            },

            _open = function() {
                //_center();
                _content();
                _center();
                self.overlay.css({ 'display': 'block', opacity: 0 }).animate({ opacity: 1 }, 500);
                $('html').addClass('yit-opened');
            },

            _close = function() {
                self.overlay.css({ 'display': 'none', opacity: 1 }).animate({ opacity: 0 }, 500);
                $element.trigger('close.yit-popup');
                $('html').removeClass('yit-opened');
                _destroy();
            },

            _destroy = function() {
                self.popup.remove();
                self.overlay.remove();

                //self.popup = self.overlay = null;
                $element.removeData('yit_popup');
            },

            _content = function() {
                if( self.settings.content != '' ) {
                    self.popup.html( self.settings.content );
                } else if( $element.data('container') ) {
                    self.popup.html( $($element.data('container')).html() );
                } else if( $element.data('content') ) {
                    self.popup.html( $element.data('content') );
                } else if( $element.attr('title') ) {
                    self.popup.html( $element.attr('title') );
                } else {
                    self.popup.html('');
                }

                //update <input id="" /> and <label for="">
                self.popup.find('form, input, label, a').each(function(){
                    if( typeof $(this).attr('id') != 'undefined' ) {
                        var id = $(this).attr('id') + '_yit-popup';
                        $(this).attr('id', id);
                    }

                    if( typeof $(this).attr('for') != 'undefined' ) {
                        var id = $(this).attr('for') + '_yit-popup';
                        $(this).attr('for', id);
                    }
                });

                if( self.overlay.find('.close').length == 0 ) {
                    self.close = $('<a />', {
                        'class' : 'close'
                    }).appendTo( self.popup );
                } else {
                    self.close = self.overlay.find('.close');
                }
            };

        self.init();
    };

    $.fn.yit_popup = function(options) {

        return this.each(function() {
            if (undefined === $(this).data('yit_popup')) {
                var yit_popup = new $.yit_popup(this, options);
                $(this).data('yit_popup', yit_popup);
            }
        });

    };

})(jQuery, window, document);
