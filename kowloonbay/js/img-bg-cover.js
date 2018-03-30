/*
 *  Project: Image as Background
 *  Description: Image as background menu plug-in for the TsingYi template
 *  Author: Simon Li
 */

 ;(function ( $, window, undefined ) {
	"use strict";
	
	var document = window.document,
	defaults = {
	};

	function ImgBgCover( elem, options ) {
		this.elem = elem;
		this.options = $.extend( {}, defaults, options) ;
		this._defaults = defaults;
		this._name = 'imgBgCover';

		this.$elem = $(this.elem);
		this.init();
	}

	ImgBgCover.prototype.init = function () {
		var self = this;

		this.$elem.each(function(index, el) {
			var $el = $(el),
				$img = $el.find('img').eq(0);

			if ($img.length === 0) return;

			$el.css({
				'background-image': 'url("' + $img.attr('src') + '")'
			});
		});
	};

	$.fn['imgBgCover'] = function ( options ) {
		return this.each(function () {
			if (!$.data(this, 'plugin_imgBgCover')) {
				$.data(this, 'plugin_imgBgCover', new ImgBgCover( this, options ));
			}
		});
	};

 }(jQuery, window));