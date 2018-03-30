jQuery("body").append('<img id="background" src="'+window.globalRainVar+'" alt="background" crossorigin = "anonymous" ><div id="cholder"><canvas id="canvas"></canvas></div>');

jQuery(window).load(function() {
	 initRainEffect();
	 /*rain effect*/
});

var SCREEN_WIDTH = window.innerWidth;
var SCREEN_HEIGHT = window.innerHeight;

/* initRainEffect */
function initRainEffect() {
	
	var engine = new RainyDay('canvas', 'background', SCREEN_WIDTH, SCREEN_HEIGHT);
	engine.gravity = engine.GRAVITY_NON_LINEAR;
	engine.trail = engine.TRAIL_DROPS;

	engine.rain([
		engine.preset(0, 2, 500)
	]);

	engine.rain([
		engine.preset(3, 3, 0.88),
		engine.preset(5, 5, 0.9),
		engine.preset(6, 2, 1),
	], 100);

}