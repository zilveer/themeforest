<!-- @DEMO ONLY -->
    jQuery(function($){
        $('#demo-styles').tabSlideOut({
            tabHandle: '.handle',                     //class of the element that will become your tab
            tabLocation: 'left',                      //side of screen where tab lives, top, right, bottom, or left
            speed: 300,                               //speed of animation
            action: 'click',                          //options: 'click' or 'hover', action to trigger animation
            topPos: '50px',                          //position from the top/ use if tabLocation is left or right
            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
            fixedPosition: true                      //options: true makes it stick(fixed position) on scroll
        });

    });
	
	jQuery('#demos .demo-image').click(function($) {
	   window.location = "http://themeluxe.com/themes/quickstep/" + this.id;
	});
	
jQuery(window).on('load', function($) {	
	jQuery('#accentSelector').ColorPicker({
		color: '#FF6B59',
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#accentSelector').css('backgroundColor', '#' + hex);
			jQuery('input[name=accentHex]').val('#' + hex);
		}
	});
});

jQuery(function($){
			var url = window.location.pathname;
			var urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); 
			$('#demos .demo-image').each(function(){
				// and test its normalized href against the url pathname regexp
				var demoURL = "http://themeluxe.com/themes/quickstep/" + $(this).attr('id');
				if(urlRegExp.test(demoURL.replace(/\/$/,''))){
					$(this).addClass('active');
				}
			});

});