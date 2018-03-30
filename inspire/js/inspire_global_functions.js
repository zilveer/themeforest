/**************************************
INSPIRE GLOBAL FUNCTIONS

	loadMoreButton
	isHandHeld
	getBrowserSize
	hexToRgb
	hexToRgbString
	rgbToHex
	insOnAjaxSucces

***************************************/

	jQuery.insGlobalFunctions = {

	/**************************************
	loadMoreButton
	***************************************/
		loadMoreButton: function () {
			$ = jQuery;

			//first empty
			$('.load-more > span').hide();

			//then build updated markup
			var morePosts = $('#filter').attr('data-more_posts');
			if (morePosts == "true"){
				$('.load-more .load_more').show();
			} else {
				$('.load-more .no_more').show();
			}

			return;		
		},

	/**************************************
	isHandHeld
	***************************************/

		isHandHeld: function () {
			if( /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) {
				return true;
			} else {
				return false;	
			}
		},

	/*************************************************************
	getBrowserSize
	*************************************************************/

		getBrowserSize: function () {
			$ = jQuery;
			var size = new Array();

		    // Get the dimensions of the viewport
		    size['width'] = $(window).width();
		    size['height'] = $(window).height();

		    return size;

		},

	/*************************************************************
	hexToRgb
	*************************************************************/

		hexToRgb: function (hex) {
		    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
		    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
		    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
		        return r + r + g + g + b + b;
		    });

		    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		    return result ? {
		        r: parseInt(result[1], 16),
		        g: parseInt(result[2], 16),
		        b: parseInt(result[3], 16)
		    } : null;
		},

	/*************************************************************
	hexToRgbString
	*************************************************************/

		hexToRgbString: function (hex) {
			$rawRgb = jQuery.insGlobalFunctions.hexToRgb(hex);
			var returnString = "rgb(";
			returnString = returnString + $rawRgb.r + ",";
			returnString = returnString + $rawRgb.g + ",";
			returnString = returnString + $rawRgb.b + ")";

			return returnString;
		},

	/*************************************************************
	hexOpacityToRgbaString
	*************************************************************/

		hexOpacityToRgbaString: function (hex, opacity) {
			$rawRgb = jQuery.insGlobalFunctions.hexToRgb(hex);
			var returnString = "rgba(";
			returnString = returnString + $rawRgb.r + ",";
			returnString = returnString + $rawRgb.g + ",";
			returnString = returnString + $rawRgb.b + ",";
			returnString = returnString + opacity + ")";

			return returnString;
		},

	/*************************************************************
	rgbToHex
	*************************************************************/

		componentToHex: function (c) {
		    var hex = c.toString(16);
		    return hex.length == 1 ? "0" + hex : hex;
		},

		rgbToHex: function (r, g, b) {
		    return "#" + jQuery.insGlobalFunctions.componentToHex(r) + jQuery.insGlobalFunctions.componentToHex(g) + jQuery.insGlobalFunctions.componentToHex(b);
		},


	/*************************************************************
	insOnAjaxSucces
	*************************************************************/

		insOnAjaxSuccess: function (c) {

			$=jQuery;

			//add fancybox to all images
			jQuery("a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").attr('rel','gallery').attr('class','fancybox');

			//reinit fancybox
			var insMainColor = extData.inspireOptionsAppearance['color_lightbox_overlay'];
			var insMainOpacity = extData.inspireOptionsAppearance['lightbox_overlay_opacity'];

			$(".fancybox").fancybox({
				helpers : {
			        overlay : {
			            css : {
			                'background' : jQuery.insGlobalFunctions.hexOpacityToRgbaString(insMainColor, insMainOpacity)
			            }
			        }
			    }
			});

			//zoom align
			if ($('.item-thumb').size() > 0) {
				var imgWidth = 0;
				var imgHeight = 0;
				var zoomWidth = 60;
				var zoomHeight = 60;
				var leftPos = 0;
				var topPos = 0;
				$('.item-thumb').each(function(index, e) {
					$this = $(this);
					$img = $this.find('img');
					if ($img.size() > 0) {
						$zoom = $this.find('.zoom');
						if ($zoom.size() > 0) {
							imgWidth = $img.attr('width');
							imgHeight = $img.attr('height');
							leftPos = (imgWidth/2) - (zoomWidth/2);
							topPos = (imgHeight/2) - (zoomHeight/2);
							$zoom.css('left', leftPos);
							$zoom.css('top', topPos);
						}
					}
				});
			}
		},


	}; // end jquery.insfunctions


