/*
*  Project: Multi-Level Menu
*  Description: Multi-level menu plug-in for the KowloonBay template
*  Author: Simon Li
*/

;(function ( $, window, undefined ) {
	"use strict";
	
	var document = window.document,
	defaults = {
	};

	function MultiLevelMenu( elem, options ) {
		this.elem = elem;
		this.options = $.extend( {}, defaults, options) ;
		this._defaults = defaults;
		this._name = 'multiLevelMenu';

		this.$elem = $(this.elem);
		this.$subMenus = this.$elem.find('ul');
		this.subMenuTimeoutHandle = Array(this.$subMenus.length);
		this.subMenuNonFamily = Array(this.$subMenus.length);
		this.$doc = $(document);
		this.init();
	}

	MultiLevelMenu.prototype.init = function () {
		var self = this;

		// resize second level menu
		this.$subMenus.each(function(index, el) {
			var $el = $(el),
			$items = $el.children('li').children('a'),
				$parent = $el.parent(), // li
				paddingH = parseInt($items.css('padding-left'),10),
				itemMaxWidth;

			itemMaxWidth = Math.max.apply(null, $items.map(function ()
			{
				return $(this).width();
			}).get());

			$el.css('max-width', itemMaxWidth + 1 + 25 + paddingH * 2);
			self.subMenuNonFamily[index] = self.$subMenus.parents().not($parent.parents()).not($parent).not($parent.find('li'));

			$parent.on('mouseenter', function () {
				if (self.subMenuTimeoutHandle[index] !== undefined){
					clearTimeout(self.subMenuTimeoutHandle[index]);
				}

				var $this = $(this);
				$this.addClass('expand');
				self.subMenuNonFamily[index].removeClass('expand');
			}).on('mouseleave', function () {
				var $this = $(this);
				self.subMenuTimeoutHandle[index] = setTimeout(function () {
					$this.removeClass('expand');
				}, 500);
			});

			if ($parent.parent().get(0) !== self.elem){
				// prevent the top-level menu items from having sub menu classes
				$parent.addClass('has-sub-menu');
			}
		});

		// set a link to block
		this.$elem.find('a').css('display', 'block');

		// Handle overflow of submenus
		this.checkOverFlow();
		$(window).on('resize', function () {
			self.checkOverFlow();
		});
	};

	MultiLevelMenu.prototype.checkOverFlow = function () {
		var self = this;

		this.$subMenus.removeClass('sub-menu-overflow');
		this.$subMenus.each(function(index, el) {
			var $el = $(el);
			if ($el.offset().left + $el.width() > self.$doc.width()){
				$el.parent().addClass('sub-menu-overflow');
			}
		});
	};

	$.fn['multiLevelMenu'] = function ( options ) {
		return this.each(function () {
			if (!$.data(this, 'plugin_multiLevelMenu')) {
				$.data(this, 'plugin_multiLevelMenu', new MultiLevelMenu( this, options ));
			}
		});
	};

}(jQuery, window));