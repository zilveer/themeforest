/*
 *  Project: Equal Column Height
 *  Description: Equal column height plug-in for the KowloonBay template
 *  Author: Simon Li
 */

 ;(function ( $, window, undefined ) {
	"use strict";

	var document = window.document,
	defaults = {
		breakpoint: 992,
	};

	function EqColHeight( elem, options ) {
		this.elem = elem;
		this.options = $.extend( {}, defaults, options) ;
		this._defaults = defaults;
		this._name = 'eqColHeight';

		this.$elem = $(this.elem);
		this.init();
	}

	EqColHeight.prototype.init = function () {
		var self = this;
		this.setEqHeights();

		$(window).on('resize', function () {
			self.setEqHeights();
		});
	};

	EqColHeight.prototype.setEqHeights = function () {
		var self = this;

		this.$elem.each(function(index, el) {
			var $el = $(el),
				$cols = $el.children(),
				maxColHeight;

			$cols.css('height', '');

			// Equal column height will not apply if viewport width is smaller than breakpoint
			if ($(window).width() < self.options.breakpoint){
				return;
			}

			maxColHeight = Math.max.apply(null, $cols.map(function ()
				{
					return $(this).height();
				}).get());

			$cols.css('height', maxColHeight);
		});
	};

	$.fn['eqColHeight'] = function ( options ) {
		return this.each(function () {
			if (!$.data(this, 'plugin_eqColHeight')) {
				$.data(this, 'plugin_eqColHeight', new EqColHeight( this, options ));
			}
		});
	};

 }(jQuery, window));