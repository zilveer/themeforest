jQuery(document).ready(function($) {
	
	$('.nets_poststuff .postbox').each(function(){
		$(this).addClass('closed').hide();		
	})
	
	if ($('.tabholder').length > 0){
  		var topper = $('.tabholder').offset(), measuretop = topper.top, measureleft = topper.left;
  		
  		$(window).scroll(function () { 
			if ($(window).scrollTop() > (measuretop - 20)) {
				$('.tabholder').css('position','fixed');
				$('.tabholder').css('top','20px');
				$('.tabholder').css('left',measureleft + 'px');
				$('.tabholder').css('margin-top','0px');				
			} else {
				$('.tabholder').css('position','relative');
				$('.tabholder').css('top','auto');
				$('.tabholder').css('left','auto');
				$('.tabholder').css('margin-top','105px');
			}
		});
	}
	
	
	$('.nets_poststuff .postbox:first').removeClass('closed').show();
	
	$('.tabholder li').not('.saver').click(function() {
		$('.tabholder li.current').removeClass('current');
		$(this).addClass('current');
		var currslide = $(this).attr('rel');
		$('.nets_poststuff .postbox:visible').addClass('closed').hide();
		$(currslide).removeClass('closed').show();
	});

								
});