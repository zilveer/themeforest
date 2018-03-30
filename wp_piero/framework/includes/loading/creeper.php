<div class="content">
	<svg id="line-svg-node" width="100%" height="120px" viewBox="0 0 600 120">
		<path id="l0" fill="none" stroke="<?php echo $page_loader_color;?>" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
		M400,200 Q500,200 600,200 " />
		<circle id="p0" cx="0" cy="0" r="14" fill="rgba(0,0,0,0)" stroke-width="0" stroke="<?php echo $page_loader_color2;?>"></circle>
		<circle id="p1" cx="0" cy="0" r="14" fill="rgba(0,0,0,0)" stroke-width="0" stroke="<?php echo $page_loader_color2;?>"></circle>
	</svg>
	<div id="null-object"></div>
	<div id="p0-null-object"></div>
	<div id="p1-null-object"></div>
	<div id="container-null-object"></div>
</div>

<script>
	(function() {
		var bezierPoint = document.getElementById('null-object');
		var p0NullObject = document.getElementById('p0-null-object');
		var p1NullObject = document.getElementById('p1-null-object');
		var containerNullObject = document.getElementById('container-null-object');

		var lineSVGNode = document.getElementById('line-svg-node');
		var l0 = document.getElementById('l0');
		var p0 = document.getElementById('p0');
		var p1 = document.getElementById('p1');

		var lineLength = 100;

		TweenMax.set(lineSVGNode, {
			position: 'absolute',
			top: '50%',
			left: 0,
			xPercent: 0,
			yPercent: -50
		})

		TweenMax.set([p0, p1], {
			position: 'absolute'
		})

		TweenMax.set(bezierPoint, {
			position: 'absolute',
			x: 300,
			y: 300
		})

		TweenMax.set(p0NullObject, {
			position: 'absolute',
			x: 10,
			y: 100
		})

		TweenMax.set(p1NullObject, {
			position: 'absolute',
			x: 100,
			y: 100
		})

		TweenMax.ticker.addEventListener('tick', updateLine);

		function point0Update(e) {
			TweenMax.set(p0, {
				attr: {
					cx: p0NullObject._gsTransform.x,
					cy: p0NullObject._gsTransform.y
				}
			})
			p0cX = p0NullObject._gsTransform.x;
			p0cY = p0NullObject._gsTransform.y;
			p1cX = p1NullObject._gsTransform.x;
			p1cY = p1NullObject._gsTransform.y;
		}

		function point1Update(e) {
			TweenMax.set(p1, {
				attr: {
					cx: p1NullObject._gsTransform.x,
					cy: p1NullObject._gsTransform.y
				}
			})
			p0cX = p0NullObject._gsTransform.x;
			p0cY = p0NullObject._gsTransform.y;
			p1cX = p1NullObject._gsTransform.x;
			p1cY = p1NullObject._gsTransform.y;
		}

		function updateLine() {
			var bezierDiffX = Math.abs(p0NullObject._gsTransform.x - p1NullObject._gsTransform.x) / 2;
			var bezierOffsetX = Math.min(p0NullObject._gsTransform.x, p1NullObject._gsTransform.x) + bezierDiffX;
			var bezierOffsetY = Math.min(p0NullObject._gsTransform.y, p1NullObject._gsTransform.y) - (lineLength);

			TweenMax.to(bezierPoint, 0.08, {
				x: bezierOffsetX,
				y: bezierOffsetY,
				ease: Power1.easeIn
			});

			nullX = bezierPoint._gsTransform.x;
			nullY = bezierPoint._gsTransform.y;

			TweenMax.set(l0, {
				attr: {
					d: "M" + p0cX + "," + p0cY + " Q" + nullX + "," + nullY + " " + p1cX + "," + p1cY
				}
			})
		}

		function initPoints() {
			TweenMax.set(p0, {
				attr: {
					cx: p0NullObject._gsTransform.x,
					cy: p0NullObject._gsTransform.y
				}
			})
			TweenMax.set(p1, {
				attr: {
					cx: p1NullObject._gsTransform.x,
					cy: p1NullObject._gsTransform.y
				}
			})
			point0Update();
			point1Update();
			updateLine();
		}

		var tl = new TimelineMax({
			repeatDelay: 0,
			repeat: -1,
			yoyo: true
		});

		tl.timeScale(2);

		tl.to(p0NullObject, 1, {
			x: 200,
			onUpdate: point0Update,
			ease: Power4.easeInOut
		})
		.to(p1NullObject, 1, {
			x: 300,
			onUpdate: point1Update,
			ease: Power4.easeInOut
		})

		tl.to(p0NullObject, 1, {
			x: 400,
			onUpdate: point0Update,
			ease: Power4.easeInOut
		})
		.to(p1NullObject, 1, {
			x: 500,
			onUpdate: point1Update,
			ease: Power4.easeInOut
		})

		initPoints();
	})();
	</script>