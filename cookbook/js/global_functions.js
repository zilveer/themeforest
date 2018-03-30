"use strict";

/**************************************
CANON GLOBAL FUNCTIONS

	isHandHeld
	GetBrowserSize
	hexToRgb
	hexToRgbString
	rgbToHex

***************************************/

	jQuery.GlobalFunctions = {

	/**************************************
	isHandHeld
	***************************************/

		isHandHeld: function () {
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
				return true;
			} else {
				return false;	
			}
		},

	/*************************************************************
	GetBrowserSize
	*************************************************************/

		GetBrowserSize: function () {
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
			$rawRgb = jQuery.GlobalFunctions.hexToRgb(hex);
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
			var $rawRgb = jQuery.GlobalFunctions.hexToRgb(hex);
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
		    return "#" + jQuery.GlobalFunctions.componentToHex(r) + jQuery.GlobalFunctions.componentToHex(g) + jQuery.GlobalFunctions.componentToHex(b);
		},



	}; // end jquery.insfunctions


