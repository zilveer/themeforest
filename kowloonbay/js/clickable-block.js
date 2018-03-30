/*
 *  Project: Clickable Block
 *  Description: Clickable block plug-in for the KowloonBay template
 *  Author: Simon Li
 */

 ;(function ( $, window, undefined ) {
	"use strict";

	var document = window.document,
	defaults = {
	};

	function ClickableBlock( elem, options ) {
		this.elem = elem;
		this.options = $.extend( {}, defaults, options) ;
		this._defaults = defaults;
		this._name = 'clickableBlock';

		this.$elem = $(this.elem);
		this.init();
	}

	ClickableBlock.prototype.init = function () {
		var self = this;

		this.$elem.on('click', function (e) {
			var $this = $(this),
				$target = $(e.target);

			var nonClickable = e.target.tagName.toUpperCase() === 'A' ||
							e.target.tagName.toUpperCase() === 'FORM' ||
							e.target.tagName.toUpperCase() === 'INPUT' ||
							e.target.tagName.toUpperCase() === 'BUTTON' ||
							e.target.tagName.toUpperCase() === 'LABEL' ||
							$target.attr('class') !== undefined && $target.attr('class').indexOf('owl-') > -1 ||
							$target.hasClass('item');

			if (!nonClickable){
				window.location = $this.find('.clickable-block-link').attr('href');
			}
		});

		this.$elem.hover(function() {
			var $this = $(this);
			$this.find('.clickable-block-link').toggleClass('active');
		});
	};

	$.fn['clickableBlock'] = function ( options ) {
		return this.each(function () {
			if (!$.data(this, 'plugin_clickableBlock')) {
				$.data(this, 'plugin_clickableBlock', new ClickableBlock( this, options ));
			}
		});
	};

 }(jQuery, window));