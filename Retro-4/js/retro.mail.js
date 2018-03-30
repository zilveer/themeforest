jQuery(document).ready(function($) {

	$('#retro-mail-form').on( "submit", function(e) {

		e.preventDefault();

		var form = $( this ),
			fields = form.find("input[name='name'], input[name='email'], input[name='subject'], input[name='human'], textarea"),
			send = {
				url: retro_mail.url,
				data: {
					action: "retro_mail_send",
					referer: retro_mail.ref,
					name: fields.filter("[name=name]").val(),
					email: fields.filter("[name=email]").val(),
					subject: fields.filter("[name=subject]").val(),
					message: fields.filter("[name=message]").val(),
					human: fields.filter("[name=human]").val()
				},
				dataType: "text",
				type: "post"
			},
		name_error = form.find("#contact-form-name-error"),
		email_error = form.find("#contact-form-email-error"),
		message_error = form.find("#contact-form-message-error"),
		human_error = form.find("#contact-form-human-error"),
		success_message = form.find("#contact-form-success").html(),
		error = form.find("span");

		error.hide();
		
		error = false;
			
		fields.each( function() {
			
			val = $.trim( this.value );
						
			if ( this.name == "name" && val.length < 1 ) {
				this.focus();
				error = name_error;
			}
			else if ( this.name == "email" && ! is_email( val ) ) {
				this.focus();
				error = email_error;
			}
			else if ( this.name == "message" && val.length < 1 ) {
				this.focus();
				error = message_error;
			}
			else if ( this.name == "human" && val != 5 ) {
				this.focus();
				error = human_error;
			}			
									
		});
		
		if ( ! error ) {
											
			send = $.ajax( send )

			send
			.success( function( result ) {
							
				if ( result ) {

					$('#send, .human-math').hide();

					$("#contact-form-success").html( result ).show();
							
				}
				
			})

		} else {
			
			error.show();
			
		}

	});

	function is_email( address ) {
		return address.match( /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	}

});