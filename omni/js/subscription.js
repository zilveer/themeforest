(function($) {

	// ==============
	// subscribe form
	// ==============
	$('.crum_subscribe').each( function(){
		var $form = $(this);

		$form.submit(function(){

			var msg = $form.data('msg');
			var email = $form.find('input[name="crum_email"]').val();
			var error = 0;
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			if (!pattern.test($.trim(email))) {
				error = 1;
			}

			if (error){
				$form.find('.form-popup .text').text( $form.data('error') );
				$form.find('.form-popup').fadeIn(300);
				setTimeout(function(){$('.form-popup').fadeOut(300);}, 3000);
			}else{
				var url = $form.attr( "action" );
				$.post(url,{'email':email},function(data){
					$form.find('.form-popup .text').text( msg );
					$form.find('.form-popup').fadeIn(300);
					$form.append('<input type="reset" class="reset-button"/>');
					$form.find('.reset-button').click().remove();
                    setTimeout(function(){$('.form-popup').fadeOut(300);}, 3000);
				});
				return false;
			}
			return false;
		});



	});

})(jQuery);