jQuery(function($) {
	//
	// Enabling miniColors
	//
	
	/*$(".color-picker").miniColors({
		letterCase: 'uppercase',
		change: function(hex, rgb) {
			logData('change', hex, rgb);
		},
		open: function(hex, rgb) {
			logData('open', hex, rgb);
		},
		close: function(hex, rgb) {
			logData('close', hex, rgb);
		}
	});*/
	
	
	//
	// Only for the demo
	//
	
	function logData(type, hex, rgb) {
		jQuery("#console").prepend(type + ': HEX = ' + hex + ', RGB = (' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ')<br />');
	}
	
	jQuery("#disable").click( function() {
		var $ = jQuery;
		$("#console").prepend('disable<br />');
		$(".color-picker").miniColors('disabled', true);
		$("#disable").prop('disabled', true);
		$("#enable").prop('disabled', false);
	});
	
	jQuery("#enable").click( function() {
		var $ = jQuery;
		$("#console").prepend('enable<br />');
		$(".color-picker").miniColors('disabled', false);
		$("#disable").prop('disabled', false);
		$("#enable").prop('disabled', true);
	});
	
	jQuery("#makeReadonly").click( function() {
		var $ = jQuery;
		$("#console").prepend('readonly = true<br />');
		$(".color-picker").miniColors('readonly', true);
		$("#unmakeReadonly").prop('disabled', false);
		$("#makeReadonly").prop('disabled', true);
	});
	
	jQuery("#unmakeReadonly").click( function() {
		var $ = jQuery;
		$("#console").prepend('readonly = false<br />');
		$(".color-picker").miniColors('readonly', false);
		$("#unmakeReadonly").prop('disabled', true);
		$("#makeReadonly").prop('disabled', false);
	});
	
	jQuery("#destroy").click( function() {
		var $ = jQuery;
		$("#console").prepend('destroy<br />');
		$(".color-picker").miniColors('destroy');
		$("INPUT[type=button]:not(#create)").prop('disabled', true);
		$("#destroy").prop('disabled', true);
		$("#create").prop('disabled', false);
	});
	
	jQuery("#create").click( function() {
		var $ = jQuery;
		$("#console").prepend('create<br />');
		$(".color-picker").miniColors({
			letterCase: 'uppercase',
			change: function(hex, rgb) {
				logData('change', hex, rgb);
			},
			open: function(hex, rgb) {
				logData('open', hex, rgb);
			},
			close: function(hex, rgb) {
				logData('close', hex, rgb);
			}
		});
		$("#makeReadonly, #disable, #destroy, #randomize").prop('disabled', false);
		$("#destroy").prop('disabled', false);
		$("#create").prop('disabled', true);
	});
	
	jQuery("#randomize").click( function() {
		jQuery(".color-picker").miniColors('value', '#' + Math.floor(Math.random() * 16777215).toString(16));
	});
	
	
});

// functions by usman start
	function cs_toggle(id){
		
		jQuery("#"+id).toggle("slow");

	}
	
	function cs_flexslider_shortcode(){
		jQuery(window).load(function(){
  jQuery('.flexslider').flexslider({
	animation: "fade",
	start: function(slider){
	  jQuery('body').removeClass('loading');
	}
  });
});	
	}

// functions by usman end
