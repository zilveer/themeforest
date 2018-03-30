/**
 * Styling page scripts.
 * Initialization of WP Color Picker.
 */
jQuery(document).ready(function(){
	if(typeof jQuery.wp === "object" && typeof jQuery.wp.wpColorPicker === "function"){
		var options = {
			palettes: false
		};
		jQuery(".flow_styling_input_color").wpColorPicker(options);
	}
});

/**
 * Footer creator scripts.
 * Updates footer creator container.
 */
function updateColumns(){
	jQuery('.footer-columns').empty();
	var myString = jQuery('[name="footer_col_countcustom"]').val();
	if(myString === undefined){
		return;
	}
	var myArray = myString.split(',');
	jQuery.each(myArray, function(index, value) {
		if(value == ''){
			return;
		}
		var column = jQuery('<div class="' + value + '"></div>').append('<div class="column-label">Column ' + ( index + 1 ) + '</div>');
		jQuery('.footer-columns').append(column);
	});
}
jQuery(document).ready(function(){
	jQuery('.footer-clear-rows').click(function(){
		jQuery('[name="footer_col_countcustom"]').val('');
		jQuery('[name="footer_col_countcustom"]').trigger('change');
	});
	jQuery('.footer-add-new-row').click(function(){
		var currentVal = jQuery('[name="footer_col_countcustom"]').val();
		if(currentVal != ''){
			currentVal += ', ';
		}
		var newRow = jQuery('.footer-new-row select').val();
		jQuery('[name="footer_col_countcustom"]').val(currentVal + newRow);
		jQuery('[name="footer_col_countcustom"]').trigger('change');
	});
	updateColumns();
	jQuery('[name="footer_col_countcustom"]').on('change', function(){
		updateColumns();
	});
});

( function( $ ) {

	'use strict';

	/**
	 * Demo importer.
	 */
	$(document).ready(function(){
		//$('.button-install-demo').on('click', function(){
		$('.au-install-button').on('click', function(){
			var answer = confirm( 'It is strongly recommended that you backup your database before proceeding. Are you sure you want to run the installer now? It can not be undone.' );
			return answer;
		});
	});

	/**
	 * Parse URL (Thumbnail Color Picker)
	 *
	 * Source: http://james.padolsey.com/javascript/parsing-urls-with-the-dom/
	 * License: http://unlicense.org/
	 */
	function parseURL(url) {
		var a =  document.createElement('a');
		a.href = url;
		return {
			source: url,
			protocol: a.protocol.replace(':',''),
			host: a.hostname,
			port: a.port,
			query: a.search,
			params: (function(){
				var ret = {},
					seg = a.search.replace(/^\?/,'').split('&'),
					len = seg.length, i = 0, s;
				for (;i<len;i++) {
					if (!seg[i]) { continue; }
					s = seg[i].split('=');
					ret[s[0]] = s[1];
				}
				return ret;
			})(),
			file: (a.pathname.match(/\/([^\/?#]+)$/i) || [,''])[1],
			hash: a.hash.replace('#',''),
			path: a.pathname.replace(/^([^\/])/,'/$1'),
			relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [,''])[1],
			segments: a.pathname.replace(/^\//,'').split('/')
		};
	}
	
	$(document).ready(function(){
		if(typeof $.wp === "object" && typeof $.wp.wpColorPicker === "function"){
			var options = {
				palettes: false,
				clear: function(event, ui) {
					$('#thumbnail_hover_color').val('');
				},
				change: function(event, ui) {
					// event = standard jQuery event, produced by whichever control was changed.
					// ui = standard jQuery UI object, with a color member containing a Color.js object
					$('#thumbnail_hover_color').val( ui.color.toString() );
				}
			};
			$(".ims_color").wpColorPicker(options);
		}
	});
	
	/**
	 * Image color picker
	 *
	 * @TODO Currently image color picker doesn't work with external images
	 *       because that would require the server to have CORS headers set
	 *       or we would need a PHP proxy.
	 *       We rather won't be implementing a PHP proxy because it is likely
	 *       to fail in many cases (like when accessing some image requires
	 *       prior log in to the user account on some external website).
	 *       What we should do is either prohibit users from entering external URLs
	 *       or rather we should check if the CORS header is set and allow
	 *       usage of canvas then. Otherwise a normal image will be displayed.
	 */
	// For HTTP if port is 80 and for HTTPS if it's 443 then the object.port will contain an empty string.
	var siteURL = parseURL(flowAdmin.siteURL);
	var siteProtocol = siteURL.protocol;
	var siteHost = siteURL.host;
	var sitePort = siteURL.port;
	
	function loadImageIntoArea(img_src){
		var imageURL = parseURL(img_src);
		var img = new Image();
		
		$('.img_preview').hide();
		$('#panel').hide();
		$('.image-loading').addClass('visible');
		$('.image-missing').removeClass('visible');
		
		img.onload = function(){
			$('.img_preview').hide();
			$('#panel').hide();
			$('.image-loading').removeClass('visible');
			$('.image-missing').removeClass('visible');
			
			if(siteProtocol == imageURL.protocol && siteHost == imageURL.host && sitePort == imageURL.port){
				$('#panel').show();
				initImageSampler();
			}else{
				$('.img_preview').show();
				$('.img_preview').empty().append(img);
			}
		};
		
		img.onerror = function(){
			$('.img_preview').hide();
			$('#panel').hide();
			$('.image-loading').removeClass('visible');
			$('.image-missing').addClass('visible');
		};
		
		img.src = img_src;
	}
	
	function initImageSampler(){
		var canvas = document.getElementById('panel');
		var ctx = canvas.getContext('2d');
		var img_src = $('#300-160-image').val();

		var image = new Image();
		image.crossOrigin = 'Anonymous'; // TODO: Is this necessary? https://developer.mozilla.org/en-US/docs/Web/HTML/CORS_enabled_image
		image.onload = function(){
			var imageWidth = image.naturalWidth;
			var imageHeight = image.naturalHeight;
			var imageRatio = imageWidth/imageHeight;
			var canvasRatio = 400/300;
			var imageCanvasWidth = imageWidth;
			var imageCanvasHeight = imageHeight;
			if(canvasRatio <= imageRatio){
				if(imageWidth > 400){
					imageCanvasWidth = 400;
					imageCanvasHeight = 400 * imageHeight / imageWidth;
				}
			}else{
				if(imageHeight > 300){
					imageCanvasWidth = 300 * imageWidth / imageHeight;
					imageCanvasHeight = 300;
				}
			}
			ctx.drawImage(image, 0, 0, imageCanvasWidth, imageCanvasHeight);
		};
		image.src = img_src;

		// Clear canvas
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		
		// Clear canvas on 'remove' click
		$('#300-160-image').parent().find('.briskuploader_remove').on('click', function(){
			ctx.clearRect(0, 0, canvas.width, canvas.height);
		});

		$('#panel').off();

		// Mouse move handler
		$('#panel').on('mousemove', function(e){
			var canvasOffset = $(canvas).offset();
			var canvasX = Math.floor(e.pageX - canvasOffset.left);
			var canvasY = Math.floor(e.pageY - canvasOffset.top);

			var imageData = ctx.getImageData(canvasX, canvasY, 1, 1);
			var pixel = imageData.data;

			var pixelColor = "rgba("+pixel[0]+", "+pixel[1]+", "+pixel[2]+", "+pixel[3]+")";
			$('.wp-color-result').css('backgroundColor', pixelColor);
		});
		$('#panel').on('mouseleave', function(){
			var currentcolor = $('#thumbnail_hover_color').val();
			$('.wp-color-result').css('backgroundColor', currentcolor);
		});

		// Mouse click handler
		$('#panel').on('click', function(e){
			var canvasOffset = $(canvas).offset();
			var canvasX = Math.floor(e.pageX - canvasOffset.left);
			var canvasY = Math.floor(e.pageY - canvasOffset.top);
			var imageData = ctx.getImageData(canvasX, canvasY, 1, 1);
			var pixel = imageData.data;
			var dColor = pixel[2] + 256 * pixel[1] + 65536 * pixel[0];
			var convstr = dColor.toString(16);
			while (convstr.length < 6) {
				convstr = '0' + convstr;
			}
			$('.ims_color').wpColorPicker('color', convstr);
		});
	}
	
	$(document).ready(function(){
		
		// Update color picker with current color
		var currentcolor = $('#thumbnail_hover_color').val();
		$('.ims_color').wpColorPicker('color', currentcolor);
		
		// Load image preview
		var img_src = $('#300-160-image').val();
		loadImageIntoArea(img_src);
		
		$('#300-160-image').on('change input', function(){
			var img_src = $('#300-160-image').val();
			loadImageIntoArea(img_src);
		});
	});

} )( jQuery );
