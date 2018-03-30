jQuery.noConflict();

jQuery(document).ready(function($){
	"use strict";								
	//MAIN CONTACT FORM...
	jQuery(".contact-frm").validate({ 
      onfocusout: function(element){ $(element).valid(); },
        rules: { 
			cname: { required: true, minlength: 2 },
			cemail: { required: true, email: true },
			cmessage: { required: true, minlength: 10 },
			txtcap: { required: true, minlength: 4, equalTo: "#txthidcap" }
		}
	});
	
	//AJAX SUBMIT...
	$('.contact-frm').submit(function () {
      
		var This = $(this);
        var data_value = null;
		
		if($(This).valid()) {
			var action = $(This).attr('action');

			data_value = decodeURI($(This).serialize());
			$.ajax({
                 type: "POST",
                 url:action,
                 data: data_value,
                 success: function (response) {
                   $('#ajax_message').html(response);
                   $('#ajax_message').slideDown('slow');
                   if (response.match('success') !== null){ $(This).slideUp('slow'); }
                 }
            });
        }
        return false;
    });
});