jQuery(document).ready(function(){
	jQuery('#gdl-custom-slider ul').cycle({ 
	    before:     before_transition,
        after:      after_transition,
		fx:			'fade',
		pager:  	'#custom-slider-nav',
		speed:   	CUSTOM.speed, 
		timeout: 	CUSTOM.timeout 
	});
	
	function before_transition(curr, next, opts, fwd){
		jQuery(next).find('.custom-slider-title').css({'top':'15px','opacity':'0'});
		jQuery(next).find('.custom-slider-caption').css({'top':'15px','opacity':'0'});
	}
	
	function after_transition(curr, next, opts, fwd){
		jQuery(this).find('.custom-slider-title').delay(100).animate({'top':'0px','opacity':'1'}, 200);
		jQuery(this).find('.custom-slider-caption').delay(400).animate({'top':'0px','opacity':'1'}, 200);
	}
	

});