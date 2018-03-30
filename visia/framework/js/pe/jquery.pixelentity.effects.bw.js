/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */
(function($) {

	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	$.pixelentity.effects = $.pixelentity.effects || {version: '1.0.0'};
	
	
	function hasCanvas() {
		return !!document.createElement('canvas').getContext;
    }
	
	function build(img,target) {
		var bw;
		if (hasCanvas()) {
			var w = img[0].naturalWidth || img[0].width || img.width();
			var h = img[0].naturalHeight || img[0].height || img.height();
			bw = document.createElement("canvas");
			bw.width = w;
			bw.height = h;
			var ctx = bw.getContext("2d");
			ctx.drawImage(img[0],0,0);
			
			var d = ctx.getImageData(0,0,w,h),p=d.data;
			var n = p.length;
			var v,i;
			for (i =0; i<n; i+=4) {
				
				v = p[i]*0.3+p[i+1]*0.59+p[i+2]*0.11;
				//v = ((v*v*v)/(255*100));
				v = ((v*v*v)/(255*200));
				v = v > 255 ? 255 : v;
				//v = Math.min(v,100);
				//v = ((v*v)/(255));
				p[i] = p[i+1] = p[i+2] = v;
				
			}

			ctx.putImageData(d,0,0);
			bw = $(bw);
		} else if ($.browser.msie) {
			bw = img.clone();
			bw[0].style.filter = "gray";
		}
		
		if (bw) {
			bw.css({
				"z-index": 10,
				"position": "absolute"
			});
			bw.fadeTo(0,0);
			
			target
				.data("bw",bw)
				.prepend(bw);
			
			if (target.data("over")) {
				effect(target);
			}
		}
		//console.log(img,target);
	}
	
	function effect(target) {
		var bw = target.data("bw");
		bw.width(target.width()).height(target.height());
		bw.stop().fadeTo(target.data("over") ? 500 : 300,target.data("over") ? 1 : 0,"easeOutQuad");
	}
	
	$.pixelentity.effects.bw = function(e) {
		var target = $(e.currentTarget);
		
		var status = target.data("bw");
		target.data("over",e.type === "mouseenter");
		if (!status) {
			var img = target.find("img:first");
			target.data("bw","loading");
			$.pixelentity.preloader.load(img,function(data) {
				build(data,target);
			});
			//console.log(img);
		} else if (status != "loading") {
			effect(target);
		}
		
		/*
		if (e.type == "mouseenter" && target.hasClass("disabled")) {
			return;
		}
		target.data("bw").fadeTo(fadeTime,e.type == "mouseenter" ? 1 : 0,"easeOutQuad");
		*/
	};
	
		
}(jQuery));