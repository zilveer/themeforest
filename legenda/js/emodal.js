/**
 * jquery.emodal.js v1.0.0
 * http://8theme.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Serg
 * http://8theme.com
 */
;( function( $, window, undefined ) {

	'use strict';

	// global
	var Modernizr = window.Modernizr;

	var settings = {};


	var methods = {
		_init : function( options ) {

			methods.$el = $(this);

			// options
			methods.options = $.extend(true, {
				'custom': false,
				'modalIdAttribute': 'modal-id',
				'hiddeBtnID': 'hideemodal'
			}, options);

			methods._config();

			// show modal
			methods.$el.click(function(event) {
				//methods.showModal();
			});

			return this;

		},
		_config : function() {

			//modal window
			var id = methods.$el.data(methods.options.modalIdAttribute);
			settings.modal = $('#' + id);

			return this;

		},
		showModal : function() {
			// base HTML
			methods.baseHtml();
            methods.startLoading();
			settings.overlay.addClass('shown');
			settings.html.addClass('shown');
			return this;
		},
		hideModal: function() {
			settings.overlay.removeClass('shown');
			settings.html.removeClass('shown');
			setTimeout(function(){
				methods.destroy();
			}, 300)
			return this;
		},
		setHideEvent: function (){
			// hide modal
			settings.overlay.click(function(event) {
				methods.hideModal();
			});

			settings.closeBtnHtml.click(function(event) {
				methods.hideModal();
			});

			// other hide btn
			var hideBtn = $('#' + methods.options.hiddeBtnID);
			hideBtn.click(function(event) {
				methods.hideModal();
			});
		},
		setHTML: function(html){
			settings.html.html(html);
			return this;
		},
		setTitle: function(title){
			settings.modalTitle.text(title);
			return this;
		},
		addText: function(text){
			settings.modalText.append(text);
			return this;
		},
		addError: function(text){
			settings.modalText.append('<p class="error-msg">' + text + '</p>');
			settings.modalTitle.text('ERROR');
			return this;
		},
		addImage: function(src){
			settings.html.addClass('with-image');
			settings.modalImage = jQuery('<img src="' + src + '" />').appendTo(settings.html);
			return this;
		},
		addBtn: function(attr){
			attr = $.extend(true, {
				'href': '',
				'cssClass': '',
				'onclick': '',
				'id': '',
				'title': '',
				'hideOnClick': false
			}, attr);

			settings.modalBtn = jQuery('<a href="' + attr.href + '" id="' + attr.id + '" class="' + attr.cssClass + '" onclick="' + attr.onclick + '"><span>' + attr.title + '</span></a>').appendTo(settings.modalText);
		
			if(attr.hideOnClick) {
				settings.modalBtn.click(function(){
					methods.hideModal();
				});
			}

			return this;
		},
		startLoading: function(){
			settings.html.addClass('eloading');
			return this;
		},
		endLoading: function(){
			settings.html.removeClass('eloading');
			return this;
		},
		baseHtml: function (){
			// Base HTML structure
			settings.overlay = jQuery('<div class="emodal-overlay"></div>');
			settings.html = jQuery('<div class="emodal" id="base-modal"><div class="emodal-border"></div></div>');
			settings.modalText = jQuery('<div class="emodal-text"></div>').prependTo(settings.html);
			settings.modalTitle = jQuery('<h5 class="emodal-title"></h5>').prependTo(settings.modalText);
			settings.closeBtnHtml = jQuery('<div class="close-modal"><i class="icon-remove"></i></div>').prependTo(settings.html);

			if(Modernizr.csstransforms) {
				settings.overlay.addClass('with-transforms');
				settings.html.addClass('with-transforms');
			}

			if(Modernizr.csstransitions) {
				settings.overlay.addClass('with-transitions');
				settings.html.addClass('with-transitions');
			}

			// add base html to body
			$('body').prepend(settings.overlay);
			$('body').prepend(settings.html);
			methods.setHideEvent();
			return this;

		},
		destroy: function(){
			settings.overlay.remove();
			settings.html.remove();
			return this;
		}
	}

	/* public functions */
	$.fn.eModal = function(method) {

		if(methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods._init.apply(this, arguments);
		} else {
			$.error('invalid method call!');
		}

    };


	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};


} )( jQuery, window );