jQuery.noConflict();
(function( $ ) {

$(function(){
	$("#ContactForm").submit(function(){
		$("#submitf").value='Please wait...';
		
		$.post("process.php?send=comments", $("#ContactForm").serialize(),
		function(data){
			if(data.frm_check == 'error'){ 
			
					$("#message_post").html("<div class='errorMessage'>ERROR: " + data.msg + "!</div>"); 
					document.ContactForm.submitf.value='Resend >>';
					document.ContactForm.submitf.disabled=false;
			} else {
				$("#message_post").html("<div class='successMessage'>Your message has been sent successfully!</div>"); 
				$("#submitf").value='Send >>';
				}
		}, "json");
		
		return false;
		
	});
});

})( jQuery );