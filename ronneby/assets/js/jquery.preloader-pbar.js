(function( $ ) {

	$.fn.preloaderPbar = function(options) {

		var settings = $.extend({
			p: 0,
			bgImg: null,
		}, options);

		var $c, c; // Canvas object

		var sa = 270; // The starting angle

		var w = 86, // canvas width
			h = 86; // height

		var x = Math.ceil(w/2), // The x-coordinate of the center of the circle
			y = Math.ceil(h/2), // The y-coordinate of the center of the circle
			r = x-3; // The radius of the circle

		var interval = null;

		var deg2rad = function(deg) {
			return deg * (Math.PI/180);
		}

		var percent2rad = function(percent) {
			var eat = 270 + percent * 3.6;

			if (percent === 0) {
				return deg2rad(270.1);
			}

			if (percent > 25) {
				eat = eat - 360;
			} else {
				eat = eat;
			}

			return deg2rad(eat);
		}

		var draw = function(canvas, input, angle, stop) {
			c.clearRect(0, 0, w, h);
			if (settings.bgImg != undefined) {
				c.drawImage(settings.bgImg, 1, 1);
			}
			c.beginPath();
			c.lineWidth = 5;
			c.strokeStyle = 'rgb(255, 255, 255)';
			c.arc(x, y, r, deg2rad(270), percent2rad(angle), true);
			c.stroke();
			
			$('#qLpercentage').text(angle+'%');
			
			if (angle >= 100) {
				$('#qLoverlay').trigger('pbar_complete');
			}
		};

		return this.each(function() {
			var $this = $(this);

			if (!$this.is(':hidden')) {
				console.log('element must be <input type="hidden" />');
				return false;
			}

			$c = $(document.createElement('canvas'));
			c = $c[0].getContext ? $c[0].getContext('2d') : null;

			if (!c) {
				console.log('error canvas');
				return false;
			}

			
			$c.appendTo($this.parent())
				.attr('width', w)
				.attr('height', h);

			$this.change(function(e, percentage) {
				percentage = parseInt(percentage);
				
				draw(c, $this, percentage, true);
			});

		});

	};

})(jQuery);