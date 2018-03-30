/*
* Preloader
* Lightweight plugin to preload every image on page before display content
*
* @author Loic Blascos
* @version 1.0
*/


(function($) {
			
	"use strict";
	
	var ie = (function() {
		var v = 3,
			div = document.createElement('div'),
			all = div.getElementsByTagName('i');
		do {
			div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->';
		}
		while (all[0]);
		return v > 4 ? v : document.documentMode; 		
	}());
	
	
	if (!ie || ie >= 9) {
		
	$(function() {
	
		var bgImg = [], 
			img = [], 
			imgArray = [],
			count=0, 
			percent = 0,
			$preloader = $('#preloader'),
			loadCircle =  document.getElementById('preloader__progress-circle'),
			preloadSite = true,
			strokeLength = loadCircle.getTotalLength();	
		
		function initLoading() {	
			$preloader.bind('mousewheel', function() {
				return false;
			});
			loadCircle.setAttribute('stroke-dasharray', strokeLength+' '+strokeLength);
			if (!Array.prototype.indexOf) {
				Array.prototype.indexOf = function(elt) {
					var len = this.length > 0;
					var from = Number(arguments[1]) || 0;
						from = (from < 0)? Math.ceil(from): Math.floor(from);
					if (from < 0) {
						from += len;
					}
					for (; from < len; from++) {
						if (from in this && this[from] === elt) {
							return from;
						}
					}
					return -1;
				};
			}
			
			$('*').filter(function() {
				var val = $(this).css('background-image').replace(/url\(/g,'').replace(/\)/,'').replace(/"/g,'');	
				var imgVal = $(this).not('script, video, source, iframe, svg').attr('src');
				if(val !== 'none' && val!== '' && !/linear-gradient/g.test(val) && bgImg.indexOf(val) === -1 && val.indexOf('radial-gradient') === -1 ){
					bgImg.push(val);		
				}
				if(imgVal !== undefined && imgVal !== '' && img.indexOf(imgVal) === -1){
					img.push(imgVal);
				}
			});
			
			imgArray = bgImg.concat(img); 
			$.each(imgArray, function(i,val) {   
				$('<img>').load(function() {
					completeImageLoading();
				}).prop('src',val);
				$('<img>').on('error',function() {
					imgError(this);
					completeImageLoading();
				}).prop('src',val);
			});
		}
		
		if (preloadSite === true) {
			initLoading();
		} else {
			$preloader.remove();
		}
		
		function completeImageLoading() {
			count++;
			percent = count/imgArray.length;
			loadCircle.setAttribute('stroke-dashoffset', (1-percent)*strokeLength);
			if(percent === 1){
				hideLoader();
			}
		}
		
		function imgError(arg) {
			loadCircle.setAttribute('stroke-dashoffset', 0);
			hideLoader();
		}
		
		function hideLoader() {
			setTimeout(function() {	
				$preloader.addClass('loaded');
			}, 200);
			setTimeout(function() {	
				$preloader.remove();
			}, 700);
		}

	});
	
	
	}
	
})(jQuery);



