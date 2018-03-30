/*
 Plugin: jQuery Parallax
 Version 1.1.3
 Author: Ian Lunn
 Twitter: @IanLunn
 Author URL: http://www.ianlunn.co.uk/
 Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

 (Contains lots of UpSolution's modifications)

 Dual licensed under the MIT and GPL licenses:
 http://www.opensource.org/licenses/mit-license.php
 http://www.gnu.org/licenses/gpl.html
 */

(function( $ ){
	var $window = $(window),
		windowHeight = $window.height();

	$.fn.parallax = function(xpos, baseSpeedFactor, outerHeight){
		var $this = $(this),
			speedFactor,
			offsetFactor = 0,
			getHeight,
			topOffset = 0,
			containerHeight = 0,
			containerWidth = 0,
			// Disable parallax on certain screen/img ratios
			disableParallax = 0,
			// Base image width and height (if can be achieved)
			baseImgHeight = 0,
			baseImgWidth = 0,
			// Backgroud-size cover? and current image size (counted)
			isBgCover = ($this.css('background-size') == 'cover'),
			curImgHeight = 0;

		if ($this.length == 0) return;

		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || baseSpeedFactor === null) baseSpeedFactor = 0.61;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;

		if (outerHeight){
			getHeight = function(jqo){
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo){
				return jqo.height();
			};
		}

		// Count background image size
		function getBackgroundSize(callback){
			var img = new Image(),
			// here we will place image's width and height
				width, height,
			// here we get the size of the background and split it to array
				backgroundSize = ($this.css('background-size') || ' ').split(' ');

			// checking if width was set to pixel value
			if (/px/.test(backgroundSize[0])) width = parseInt(backgroundSize[0]);
			// checking if width was set to percent value
			if (/%/.test(backgroundSize[0])) width = $this.parent().width() * (parseInt(backgroundSize[0]) / 100);
			// checking if height was set to pixel value
			if (/px/.test(backgroundSize[1])) height = parseInt(backgroundSize[1]);
			// checking if height was set to percent value
			if (/%/.test(backgroundSize[1])) height = $this.parent().height() * (parseInt(backgroundSize[0]) / 100);

			if (typeof width != 'undefined' && typeof height != 'undefined'){
				// Image is not needed
				return callback({ width: width, height: height });
			}

			// Image is needed
			img.onload = function () {
				// check if width was set earlier, if not then set it now
				if (typeof width == 'undefined') width = this.width;
				// do the same with height
				if (typeof height == 'undefined') height = this.height;
				// call the callback
				callback({ width: width, height: height });
			};
			// extract image source from css using one, simple regex
			// src should be set AFTER onload handler
			img.src = ($this.css('background-image') || '').replace(/url\(['"]*(.*?)['"]*\)/g, '$1');
		}
		function update(){
			if (disableParallax)
				 return $this.css('backgroundPosition', '');
			if (isNaN(speedFactor))
				return;

			var pos = $window.scrollTop();
			topOffset = $this.offset().top;
			// Check if totally above or totally below viewport
			if ((pos < topOffset - windowHeight) || (topOffset + containerHeight < pos)) return;
			$this.css('backgroundPosition', xpos + " " + (offsetFactor + speedFactor * (topOffset - pos)) + "px");
		}
		function resize(){
			setTimeout(function(){
				windowHeight = $window.height();
				containerHeight = getHeight($this);
				containerWidth = $this.width();
				if (isBgCover){
					if (baseImgWidth / baseImgHeight <= containerWidth / containerHeight){
						// Resizing by width
						curImgHeight = baseImgHeight * ($this.width() / baseImgWidth);
						disableParallax = 0;
					}
					else {
						disableParallax = 1;
					}
				}
				// Improving speed factor to prevent showing image limits
				if (curImgHeight !== 0){
					if (baseSpeedFactor >= 0) {
						speedFactor = Math.min(baseSpeedFactor, curImgHeight / windowHeight);
						offsetFactor = Math.min(0, .5 * (windowHeight - curImgHeight - speedFactor * (windowHeight - containerHeight)));
					} else {
						speedFactor = Math.max(baseSpeedFactor, -(curImgHeight / windowHeight));
						offsetFactor = Math.min(0, 0.5 * (-windowHeight + curImgHeight + speedFactor * (-windowHeight + containerHeight)));
					}


				}else{
					speedFactor = baseSpeedFactor;
					offsetFactor = 0;
				}
				update();
			}, 10);
		}

		getBackgroundSize(function(sz){
			curImgHeight = baseImgHeight = sz.height;
			baseImgWidth = sz.width;
			resize();
		});

		$window.bind({scroll: update, load: resize, resize: resize});
		resize();
	};
})(jQuery);
