(function($) { 	

	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	$.pixelentity.backgrounds = $.pixelentity.backgrounds || {version: '1.0.0'};
	
	$.pixelentity.backgrounds.Nebula = function(w,h,gfx,max,noauto) {
		
		max = max || 40;
		var useCanvas = true;
		
		var self = this;
		var nebula;
		var	pw;
		var ph;
		var particles = [];
		var i;
		
		var speed=3;
		var shiftX=0,shiftY=0;
		var buffer;
		var buffer2d;
		var counter=0;
		
		function load() {
			if (typeof gfx == "string") {
				nebula=$("<img>");
				nebula.one("load",init);
				nebula.attr("src",gfx);
			} else {
				nebula = particle;
			}
			
		}
		
		function particle(p) {
			var sh = 20;
			var sw = w;
			
			p = p || {}
			p.x = Math.round(Math.random()*sw)-(sw>>1);
			p.y = Math.round(Math.random()*sh)-(sh>>1);
			p.z = -500;
			p.v = Math.random()*5+5;
			p.a	= Math.random()*0.2+0.8;
			
			if (!useCanvas) {
				if (p.img) {
					$(p.img).remove();
					delete p.img;
				}
				p.img = $(nebula).clone()[0];
				$(p.img).css("opacity",0).css("position","absolute");
				buffer2d.append(p.img);
			}
			return p;
		}
		
		function init() {
			pw = nebula.width() || nebula[0].width;
			ph = nebula.height() ||  nebula[0].height;
			
			var source = nebula[0];
			nebula = $('<canvas width="+pw+" height="+ph+">')[0];
			nebula.getContext("2d").drawImage(source,0,0);
			
			// no canvas
			//nebula = nebula[0]
			
			if (useCanvas) {
				buffer = $('<canvas width="'+w+'" height="'+h+'">')[0];
				buffer2d = buffer.getContext("2d");
			} else {
				buffer = buffer2d = $("<div>");
			}
			
			var i;
			
			for (i=0;i<max;i++) {
				particles.push(particle());
			}
						
			for (i=0;i<100;i++) {
				render();
			}
			
			if (noauto !== true) {
				$.pixelentity.ticker.register(render);
			}

			
			$(self).triggerHandler("ready.pixelentity");

			
			/*
			setTimeout(function () {
				$(self).triggerHandler("ready.pixelentity");
			},1000);
			*/
		}
		
	
		function render() {
			
			
			var x,y,z,xi,yi,s,sw,sh,a,wc;
			var cx = w >> 1;
			var cy = h >> 1;
			
			var fL = -1500;
			var p;
			
			if (useCanvas) {
				buffer2d.clearRect(0,0,w,h);
			}
			
			for (i=0;i<max;i++) {
			
				
				p = particles[i];
				
				s = ((500+p.z)/500);
				a = s <= 1 ? s : 1.2-s/2;
				
				if (a<0) {
					if (++counter < 100000000000) {
					//$(p.img).remove();
					delete p.img;
					p = particles[i] = particle(p);
					s = ((500+p.z)/500);
					a = s <= 1 ? s : 1.2-s/2;
					//console.log("CREATE",s,a);
					}
					continue;
				}
				
				if (useCanvas) {
					buffer2d.globalAlpha = p.a*a/2;
				}
				
				sw = parseInt(pw*s);
				sh = parseInt(ph*s);
				p.z += p.v*speed;
				p.x += shiftX;
				p.y += shiftY;
				
				
				if (sw<2 || sh <2) {
					//$(p.img).css("opacity",0);
					continue;
				}
				
				wc = fL / (fL + p.z);
				
				//xi = parseInt((wc*p.x + cx))-(sw >> 1);
				//yi = parseInt((wc*p.y + cy))-(sh >> 1);
				
				xi = (wc*p.x + cx)-(sw >> 1);
				yi = (wc*p.y + cy)-(sh >> 1);
				
				if (xi >= w-(sw>>1) || xi < -(sw>>1) || yi >= h-(sh>>1) || yi < -(sh>>1) ) {
					//$(p.img).css("opacity",0);
					continue;
				}
				
				if (useCanvas) {
					buffer2d.drawImage(nebula, 0, 0, pw, ph, xi, yi, sw, sh);
				} else {
					$(p.img).css("opacity",p.a*a/2).transform(s*2,xi*2,yi*2,128,128);
				}
			}
		}
		
		$.extend(self,{
			layer: function() {
				return buffer;
			},
			init: function() {
				load();
			},
			render: render,
			speed: function(s) {
				speed = s;
			},
			shiftX: function(s) {
				shiftX = s;
			},
			shiftY: function(s) {
				shiftY = s;
			}
			
		});
		
		return self;
	}
		
})(jQuery);

		

