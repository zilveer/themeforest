// recent proj
jQuery(document).ready(function() {
	jQuery('.recent_proj').cycle({
		fx: 'scrollLeft',
		timeout: 3000,
		delay: -1000
	});
})
// Tiny carousel
/*jQuery(document).ready(function(){
	jQuery('.carousel_container').tinycarousel({
		start: 1, // where should the carousel start?
		display: 1, // how many blocks do you want to move at a time?
		axis: 'x', // vertical or horizontal scroller? 'x' or 'y' .
		controls: true, // show left and right navigation buttons?
		pager: false, // is there a page number navigation present?
		interval: 1000, // move to the next block on interval.
		intervaltime: 3000, // interval time in milliseconds.
		rewind: true, // If interval is true and rewind is true it will play in reverse if the last slide is reached
		animation: true, // false is instant, true is animate.
		duration: 1000, // how fast must the animation move in milliseconds?
		callback: null // function that executes after every move
	});
});
*/
