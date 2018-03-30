
if (!$) $ = jQuery;

// Isotope for Portfolio

$(document).ready(function() {
	$('.vivaco-grid[id^="gridwrapper_"]').each( function() {
		var $div = $(this),
			token = $div.data('token'),
			settingObj = window['vsc_grid_' + token],
			$container = null,
			$optionSets = null,
			grid_gutter_width = settingObj.gutter_width;

		if (typeof settingObj === 'undefined') {
			$container = $(".grid_portfolio");
			$optionSets = $('#gridwrapper_portfolio #options .option-set');

		}else {
			$container = $(".grid_"+settingObj.id+"");
			$optionSets = $('#gridwrapper_'+settingObj.id+'  #options .option-set');

		}

		colWidth = function () {
			var w = $container.width(),
				columnNum = 1,
				columnWidth = 0;

			vals = settingObj.vals

			// apply default settings
			if (vals.grid_manager != 1) {
				if (w > 1440) {
					columnNum  = 4;

				} else if (w > 1365) {
					columnNum  = 3;

				} else if (w > 1279) {
					columnNum  = 3;

				} else if (w > 1023) {
					columnNum  = 3;

				} else if (w > 767) {
					columnNum  = 2;

				} else if (w > 479) {
					columnNum  = 2;

				}

			}else { // apply custom settings
				if (w > 1440) {
					columnNum  = vals.grid_very_wide;

				} else if (w > 1365) {
					columnNum  = vals.grid_wide;

				} else if (w > 1279) {
					columnNum  = vals.grid_normal;

				} else if (w > 1023) {
					columnNum  = vals.grid_small;

				} else if (w > 767) {
					columnNum  = vals.grid_tablet;

				} else if (w > 479) {
					columnNum  = vals.grid_phone;

				}
			}


			columnWidth = Math.floor(w/columnNum);

			$container.find('.grid-item').each(function() {
				var $item = $(this),
					gwidth = 0;

				if (vals.grid_manager == 1) {
					gwidth = grid_gutter_width;

				}

				$item.css({'margin': Math.floor(gwidth/2)});

				if ($item.hasClass('item-wide')) {
					if (w < 480) {
						$item.css({
							'width' : ((columnWidth)-gwidth) + 'px',
							'height' : Math.round(((columnWidth)-gwidth) * 0.7777777) + 'px'
						});

						$item.find('img').css({
							'width' : ((columnWidth)-gwidth) + 'px',
							'height' : '100%'
						});

					}else {
						$item.css({
							'width' : ((columnWidth*2)-gwidth) + 'px',
							'height' : Math.round(((columnWidth*2)-gwidth) * 0.7777777) + 'px'
						});

						$item.find('img').css({
							'width' : ((columnWidth*2)-gwidth) + 'px',
							'height' : '100%'
						});

					}
				}

				if ($item.hasClass('item-small')) {
					$item.css({
						'width' : ((columnWidth)-gwidth) + 'px',
						'height' : Math.round(((columnWidth)-gwidth) * 0.7777777) + 'px'
					});

					$item.find('img').css({
						'width' : ((columnWidth)-gwidth) + 'px',
						'height' : '100%'
					});

				}

				if ($item.hasClass('item-long')) {
					if (w < 480) {
						$item.css({
							'width' : ((columnWidth)-gwidth) + 'px',
							'height' : Math.round(((columnWidth)-gwidth) * 0.7777777/2) + 'px'
						});

						$item.find('img').css({
							'width' : ((columnWidth)-gwidth) + 'px',
							'height' : '100%'
						});

					}else {
						$item.css({
							'width' : ((columnWidth*2)-gwidth) + 'px',
							'height' : Math.round(((columnWidth)-gwidth) * 0.7777777) + 'px'
						});

						$item.find('img').css({
							'width' : ((columnWidth*2)-gwidth) + 'px',
							'height' : '100%'
						});

					}
				}

				if ($item.hasClass('item-high')) {
					$item.css({
						'width' : ((columnWidth)-gwidth) + 'px',
						'height' : Math.round(((columnWidth*2)-gwidth) * 0.7777777) +'px'
					});

					$item.find('img').css({
						'width' : ((columnWidth)-gwidth) + 'px',
						'height' : '100%'
					});

				}
			});

			return columnWidth;
		}

		// Isotope Call
		gridIsotope = function () {
			$container.isotope({
				layoutMode : 'masonry',
				itemSelector: '.grid-item',
				animationEngine: 'jquery',
				resizable: false,
				masonry: { columnWidth: colWidth(), gutter: 35, isFitWidth: true }
			});
		};
		gridIsotope();
		$(window).smartresize(gridIsotope);


		// Portfolio Filtering
		$optionLinks = $optionSets.find('a');

		$optionLinks.click(function() {
			var $this = $(this);
			var $optionSet = $this.parents('.option-set');

			// don't proceed if already selected
			if ( $this.hasClass('selected') ) return false;

			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected');

			// make option object dynamically, i.e. { filter: '.my-filter-class' }
			var options = {},
				key = $optionSet.attr('data-option-key'),
				value = $this.attr('data-option-value');

			// parse 'false' as false boolean
			value = value === 'false' ? false : value;
			options[ key ] = value;

			if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
				changeLayoutMode( $this, options ); // changes in layout modes need extra logic

			} else {
				$container.isotope( options ); // otherwise, apply new options

			}

			return false;
		});
	});
});