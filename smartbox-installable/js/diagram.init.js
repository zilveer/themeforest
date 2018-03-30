var o = {
	init: function(){
		this.diagram();
	},
	random: function(l, u){
		return Math.floor((Math.random()*(u-l+1))+l);
	},
	diagram: function(e){
	
		var currentMousePos = { x: -1, y: -1 };
	    $(document).mousemove(function(event) {
	        currentMousePos.x = event.pageX;
	        currentMousePos.y = event.pageY;
	    });
	
		$('.diagrams').each(function(){

			var width = parseInt($(this).closest('section').width(),10);
			
			var id = $(this).attr('id');

			var r = Raphael(id, width, width),
				rad = 73,
				defaultText = $(this).attr('title'),
				speed = 250,
				newGroup = [];
				
			if (defaultText == "undefined") defaultText = "&nbsp;";
			
			var c = r.circle(width/2, width/2, 85).attr({ stroke: 'none', fill: '#193340' });
			
			var st = r.set();

			st.push(r.circle(width/2, width/2, 85).attr({ stroke: 'none', fill: '#193340' }));
						
			r.customAttributes.arc = function(value, color, rad){
				var v = 3.6*value,
					alpha = v == 360 ? 359.99 : v,
					random = o.random(91, 240),
					a = (random-alpha) * Math.PI/180,
					b = random * Math.PI/180,
					sx = width/2 + rad * Math.cos(b),
					sy = width/2 - rad * Math.sin(b),
					x = width/2 + rad * Math.cos(a),
					y = width/2 - rad * Math.sin(a),
					path = [['M', sx, sy], ['A', rad, rad, 0, +(alpha > 180), 1, x, y]];
				return { path: path, stroke: color }
			}
			
			$(this).siblings('.textcontainer').html('<div id="outer"><div id="middle"><div id="inner">'+defaultText+'</div></div></div>');
			
			
			var lines = [];
			$('#'+id+' .get .arc').each(function(i){
				var t = jQuery(this), 
					color = t.find('.color').val(),
					value = t.find('.percent').val(),
					text = t.find('.text').html();
				
				rad += 30;
				var z = r.path().attr({ arc: [value, color, rad], 'stroke-width': 26 });
					z.data = [value,text];
				//zs.push(z);
				st.push(z);
				lines.push(z);
			});
			
			var maxWidth = 1;
			var howMany = 0;
			$('#'+id).children().children().each(function(e){
				howMany++;

				if (( $(this)[0].getBoundingClientRect().width+ howMany*16) > maxWidth) {
					maxWidth = $(this)[0].getBoundingClientRect().width+ howMany*16;
				}
				if (( $(this)[0].getBoundingClientRect().height+ howMany*16) > maxWidth) {
					maxWidth = $(this)[0].getBoundingClientRect().height+ howMany*16;
				}
			});
			
			var scale = width / maxWidth ;

			st.scale(scale,scale,width/2,width/2);
			var stroke = Math.round(26*scale);

			
			if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
			
				var newHeight = $(this).siblings('.textcontainer').find('#inner').height();
				$(this).siblings('.textcontainer').css({
					'height': newHeight,
					'bottom': parseInt(($(this).closest('section').height() - newHeight)/2)+'px'
				});
				
				$(window).resize(function(){
					$(this).siblings('.textcontainer').css({
						'height': $(this).find('.inner').height(),
						'bottom': parseInt(($(this).closest('section').height() - $(this).find('.inner').height())/2)+'px'
					});
				});
			
				for (var i=0; i<lines.length; i++){
				
					lines[i].mouseover(function(who){
						elem = this;
		                this.animate({ 'stroke-width': 50, opacity: .75 }, 1000, 'elastic');
		                if(Raphael.type != 'VML') //solves IE problem
						this.toFront();
						
						$(who.toElement).parents('.diagrams-container').find('.textcontainer').stop().animate({
							opacity: 0 
						}, speed, 'linear', function(){
							$(this).html('<div id="outer"><div id="middle"><div id="inner">'+elem.data[1]+ "<br/>" + elem.data[0] + "%</div></div></div>");
							var newHeight = $(this).find('#inner').height();
							$(this).css({
								'height': newHeight,
								'bottom': parseInt(($(this).closest('section').height() - newHeight)/2)+'px'
							});
							$(this).animate({ opacity: 1 }, speed, 'linear');
						});
		            }).mouseout(function(who){
						this.stop().animate({ 'stroke-width': 26, opacity: 1 }, speed*4, 'elastic');
						$(who.toElement).parents('.diagrams-container').find('.textcontainer').stop().animate({
		            		opacity: 0 
		            	}, speed, 'linear', function(){
			            	$(this).html('<div id="outer"><div id="middle"><div id="inner">'+defaultText+'</div></div></div>');
			            	$(this).css({
								'height': newHeight,
								'bottom': parseInt(($(this).closest('section').height() - newHeight)/2)+'px'
							});
			            	$(this).stop().animate({ opacity: 1 }, speed, "linear" );
		            	});
		            });
		
				}
								
			} else {
				for (var i=0; i<lines.length; i++){
					var stroke = Math.round(26*scale);
					lines[i].attr('stroke-width',stroke*2).attr('stroke-width',stroke);
					lines[i].mouseover(function(who){
						if (window.BrowserDetect.browser == "Explorer" && this.attr('stroke-width')>stroke){
							return false;
							$(who.toElement).siblings().animate({ 'stroke-width': stroke, opacity: 1 }, speed*4, 'elastic');
						}
						elem = this;
						this.animate({ 'stroke-width': stroke*2, opacity: .75 }, 1000, 'elastic');
						this.toFront();
						$(who.toElement).parents('.diagrams-container').find('.textcontainer').stop().animate({
							opacity: 0 
						}, speed, 'linear', function(){
							$(this).html('<div id="outer"><div id="middle"><div id="inner">'+elem.data[1]+ "<br/>" + elem.data[0] + "%</div></div></div>");
							$(this).animate({ opacity: 1 }, speed, 'linear');
						});
						
					}).mouseout(function(who){
						this.stop().animate({ 'stroke-width': stroke, opacity: 1 }, speed*4, 'elastic');
						$(who.toElement).parents('.diagrams-container').find('.textcontainer').stop().animate({
		            		opacity: 0 
		            	}, speed, 'linear', function(){
			            	$(this).html('<div id="outer"><div id="middle"><div id="inner">'+defaultText+'</div></div></div>');
			            	$(this).stop().animate({ opacity: 1}, speed, "linear" );
		            	});

					});
				}
			}
								
		});
	}
	
	
	
}

$(window).load(function(){ o.init(); });
$(window).resize(debouncer(function(e){
	if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version < 9){
		$('.diagrams > div:not(.diagram-jquery)').remove();
	} else $('.diagrams svg').remove();
	o.init();
}));

function debouncer( func , timeout ) {
   var timeoutID , timeout = timeout || 500;
   return function () {
      var scope = this , args = arguments;
      clearTimeout( timeoutID );
      timeoutID = setTimeout( function () {
          func.apply( scope , Array.prototype.slice.call( args ) );
      } , timeout );
   }
}
