jQuery(document).ready(function($){
	
	$('body').on('click', '.ebor-icons i', function(){
		$('.ebor-icons i').removeClass('active');
		$(this).addClass('active');
		$(this).parents('.ebor-icons').find('input').attr('value', $(this).attr('data-icon-class'));
	});
	
	$('body').on('click', '#ebor-icon-toggle', function(){
		$('.ebor-icons-wrapper').slideToggle();
		return false;
	});
	
});