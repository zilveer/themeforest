<div id="container">
	<svg width="300px" height="200px" viewBox="0 0 187.3 93.7" preserveAspectRatio="xMidYMid meet">
		<path style="-webkit-filter:url(#f2)" stroke="<?php echo $page_loader_color;?>" id="outline" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
	M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1
	c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" />
		<path id="outline-bg" opacity="0.05" fill="none" stroke="<?php echo $page_loader_color2;?>" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
	M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1
	c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" />
	</svg>
</div>
<script>
	(function() {
		var container = document.getElementById('container');

		TweenMax.set(['svg'], {
			position: 'absolute',
			top: '50%',
			left: '50%',
			xPercent: -50,
			yPercent: -50
		})

		TweenMax.set([container], {
			position: 'absolute',
			top: '50%',
			left: '50%',
			xPercent: -50,
			yPercent: -50
		})

		var tl = new TimelineMax({
			repeat: -1
		});

		tl.set('#outline', {
			drawSVG: '0% 0%'
		})
		.to('#outline', 0.2, {
			drawSVG: '11% 25%',
			ease: Linear.easeNone
		})
		.to('#outline', 0.5, {
			drawSVG: '35% 70%',
			ease: Linear.easeNone
		})
		.to('#outline', 0.9, {
			drawSVG: '99% 100%',
			ease: Linear.easeNone
		})
	})();
	</script>