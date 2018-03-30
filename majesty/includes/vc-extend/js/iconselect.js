// JavaScript Document
!function($) {

$('.vc-icon-select i').on('click',function(){
		 $value = $(this).data('icon');
		if( $(this).hasClass('selected')){
         $(this).removeClass('selected');
		  $(this).parent().parent().find('input.vc-icon-select').attr('value','').trigger('change');
		}
		else {
		 $(this).parent().find(' > i').removeClass('selected');	
         $(this).addClass('selected');
         $(this).parent().parent().find('input.vc-icon-select').attr('value',$value).trigger('change');
		}
	 });
}(window.jQuery);