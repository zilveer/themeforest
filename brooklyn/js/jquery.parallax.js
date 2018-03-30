/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/
(function() {
    var lastTime = 0;
    var vendors = ['webkit', 'moz'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame =
          window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

(function( $ ){
	
    var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		
        var $this = $(this);
		var getHeight;
		var firstTop;
		
		//get the starting position of each element to have parallax applied to it	
		function update (){
			
			$this.each(function(){								
				firstTop = $this.offset().top;
			});
	
			if (outerHeight) {
				getHeight = function(jqo) {
					return jqo.outerHeight(true);
				};
			} else {
				getHeight = function(jqo) {
					return jqo.height();
				};
			}
            	
			// setup defaults if arguments aren't specified
			if (arguments.length < 1 || xpos === null) { xpos = "50%"; }
			if (arguments.length < 2 || speedFactor === null) { speedFactor = 0.5; }
			if (arguments.length < 3 || outerHeight === null) { outerHeight = true; }
			
			// function to be called whenever the window is scrolled or resized
			
				var pos = $window.scrollTop();				
	
				$this.each(function(){
					
                    var $element = $(this);
					var top = $element.offset().top;
					var height = getHeight($element);
	
					// Check if totally above or totally below viewport
					if ( top + height < pos || top > pos + windowHeight ) {
                        return;
					}
        
                    if( $('html').hasClass('no-csstransforms') ) {
                        
                        /* fallback to older browser */                 
                        $this.addClass("fixed").css('backgroundPosition', xpos + " " + Math.round( ( firstTop - pos ) * speedFactor ) + "px");                    
                       
                    } else {
                        
                        if( window.pageYOffset >= 1 || document.documentElement.scrollTop >= 1 ) {
                        
                            $this.css('transform', 'translate3d(0px, ' + ( - ( firstTop - pos ) * speedFactor ) + "px" + ', 0px)' );                        
                        
                        } else {
                            
                            $this.css('transform', 'translate3d(0px, 0px, 0px)' );    
                            
                        }
                        
                    }
					
				});
		}	
		
        if( $('html').hasClass('no-csstransforms') ) {
            
            $window.bind('scroll', update).resize(update);
            
        } else {
        
            $window.bind('scroll', function() {
                
                window.requestAnimationFrame(update);
                
            }).resize(function() { 
            
                window.requestAnimationFrame(update); 
    
            });
        
        }
                	
		update();
		
		
	};
})(jQuery);