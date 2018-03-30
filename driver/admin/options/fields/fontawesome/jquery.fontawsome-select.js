jQuery(document).ready(function($) {
	
	$('.fontawsome-select-button').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('active');
		
		var is_active = $(this).parent().hasClass('active');

		if(is_active) {
			$(this).find('i').removeClass('fa-angle-down');
			$(this).find('i').addClass('fa-angle-up');
		}else{
			$(this).find('i').removeClass('fa-angle-up');
			$(this).find('i').addClass('fa-angle-down');
		}		
	});
	
	$('.fa-icons-menu li a').on('click', function(e) {
		
		e.preventDefault();
		
		var value = $(this).attr('id');
		var text = $(this).html();
	
		$select = $(this).closest('.fontawsome-select');
		$field = $select.find('input[type="hidden"]');
		$title = $select.find('h3');

			
		$field.val(value);
		$title.html(text);
			
		$select.find('.fa-icons ul li').removeClass('selected');
		$(this).parent().addClass('selected');

		
	});
	
});