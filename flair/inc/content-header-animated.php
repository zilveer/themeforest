<?php  
	/**
	 * All variables in here are being brought from /page_builder_blocks/header_block.php
	 * This is a separate file so that you can override it easily from your child theme.
	 */
?>

<section id="home" class="animation">
	
	<?php include( locate_template('inc/content-header-titles.php') ); ?>
	
	<div id="animation-container"></div>
	
</section>

<section id="big_clear"></section>

<script type="text/javascript">
jQuery(document).ready(function(){
	var container = document.getElementById('animation-container');
	var renderer = new FSS.CanvasRenderer();
	var scene = new FSS.Scene();
	var light = new FSS.Light('#333', '#646A7C');
	var geometry = new FSS.Plane(container.offsetWidth, container.offsetHeight, 16, 12);
	var material = new FSS.Material('#FFFFFF', '#FFFFFF');
	var mesh = new FSS.Mesh(geometry, material);
	var now, start = Date.now();
	function initialise() {
	  scene.add(mesh);
	  scene.add(light);
	  container.appendChild(renderer.element);
	  window.addEventListener('resize', resize);
	}
	function resize() {
	  renderer.setSize(container.offsetWidth, container.offsetHeight);
	}
	function animate() {
	  now = Date.now() - start;
	  light.setPosition(300*Math.sin(now*0.001), 200*Math.cos(now*0.0005), 60);
	  renderer.render(scene);
	  requestAnimationFrame(animate);
	}
	initialise();
	resize();
	animate();
});
</script>