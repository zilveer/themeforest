<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header('Content-type: text/javascript');

?>
var $j = jQuery.noConflict();	

function initFlexSlider(){
	$j('.flexslider').flexslider({
		animationLoop: true,
		controlNav: false,
		useCSS: false,
		pauseOnAction: true,
		pauseOnHover: true,
		slideshow: <?php if($qode_options_magnet['slider_transition_auto'] != ""){ echo $qode_options_magnet['slider_transition_auto'];} else{ echo "true"; }  ?>,
		animation: <?php if($qode_options_magnet['slider_transition_effect'] != ""){ echo '"'.$qode_options_magnet['slider_transition_effect'].'"';} else{ echo '"slide"'; }  ?>,
		animationSpeed: <?php if($qode_options_magnet['slider_transition_speed'] != ""){ echo $qode_options_magnet['slider_transition_speed'];} else{ echo "600"; }  ?>,
		slideshowSpeed: <?php if($qode_options_magnet['slider_transition_timeout'] != ""){ echo $qode_options_magnet['slider_transition_timeout'];} else{ echo "8000"; }  ?>,
		start: function(){
			setTimeout(function(){$j(".flexslider").fitVids();},100);
			
		}
	});
	
	$j('.flex-direction-nav a').click(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		e.stopPropagation();
	});
}
	
function ajaxSubmitCommentForm(){
	var options = { 
		success: function(){
			$j("#commentform textarea").val("");
			$j("#commentform .success p").text("<?php _e('Comment has been sent!','qode'); ?>");
		}
	}; 
	
	$j('#commentform').submit(function() {
		$j(this).find('input[type="submit"]').next('.success').remove();
		$j(this).find('input[type="submit"]').after('<div class="success"><p></p></div>')
		$j(this).ajaxSubmit(options); 
		return false; 
	}); 
}