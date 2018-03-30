{var $disabled = 'yes'}

{if $meta->contactOwnerBtn && $meta->email}
	{var $disabled = ''}
{/if}

<div n:class="contact-owner-container, $disabled ? contact-owner-disabled">

	{if !$disabled}
	<a href="#contact-owner-popup-form" id="contact-owner-popup-button" class="contact-owner-popup-button">{$settings->contactOwnerButtonTitle|trimWords:10}</a>
	<div class="contact-owner-popup-form-container" style="display: none">

		<form id="contact-owner-popup-form" class="contact-owner-popup-form" onSubmit="javascript:contactOwnerSubmit(event);">
			<h3>{$settings->contactOwnerButtonTitle}</h3>
			<input type="hidden" name="response-email-address" value="{$meta->email}">
			<input type="hidden" name="response-email-content" value="{$settings->contactOwnerMailForm}">
			{if $settings->contactOwnerMailFromName}
			<input type="hidden" name="response-email-sender-name" value="{$settings->contactOwnerMailFromName}">
			{/if}

			{if $settings->contactOwnerMailFromEmail}
			<input type="hidden" name="response-email-sender-address" value="{$settings->contactOwnerMailFromEmail}">
			{else}
			<input type="hidden" name="response-email-sender-address" value="{get_option('admin_email')}">
			{/if}

			<div class="input-container">
				<input type="text" class="input name" name="user-name" value="" placeholder="{$settings->contactOwnerInputNameLabel}" id="user-name">
			</div>

			<div class="input-container">
				<input type="text" class="input email" name="user-email" value="" placeholder="{$settings->contactOwnerInputEmailLabel}" id="user-email">
			</div>

			<div class="input-container">
				<input type="text" class="input subject" name="response-email-subject" value="" placeholder="{$settings->contactOwnerInputSubjectLabel}" id="user-subject">
			</div>

			<div class="input-container">
				<textarea class="user-message" name="user-message" cols="30" rows="4" placeholder="{$settings->contactOwnerInputMessageLabel}" id="user-message"></textarea>
			</div>

			<div class="input-container btn">
				<button class="contact-owner-send" type="submit">{$settings->contactOwnerSendButtonLabel}</button>
			</div>

			<div class="messages">
				<div class="message message-success" style="display: none">{$settings->contactOwnerMessageSuccess}</div>
				<div class="message message-error-user" style="display: none">{$settings->contactOwnerMessageErrorUser}</div>
				<div class="message message-error-server" style="display: none">{$settings->contactOwnerMessageErrorServer}</div>
			</div>
		</form>

	</div>
	<script type="text/javascript" n:syntax="off">
	jQuery(document).ready(function(){
		jQuery("#contact-owner-popup-button").colorbox({ inline:true, href:"#contact-owner-popup-form" });
	});
	function contactOwnerSubmit(e){
		e.preventDefault();

		var $form = jQuery("#"+e.target.id);
		var $inputs = $form.find('input, textarea');
		var $messages = $form.find('.messages');
		var mailCheck = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var mailParsed = $form.find('.email').val();
		// validate form data
			var passedInputs = 0;
			// check for empty inputs -- all inputs must be filled
			$inputs.each(function(){
				var inputValue = jQuery(this).val();
				if(inputValue !== ""){
					passedInputs = passedInputs + 1;
				}
			});

			// check for email field -- must be a valid email form
			if(passedInputs == $inputs.length && mailCheck.test(mailParsed)){
				// ajax post -- if data are filled
				var data = {};
				$inputs.each(function(){
					data[jQuery(this).attr('name')] = jQuery(this).val();
				});
				ait.ajax.post('contact-owner:send', data).done(function(data){
					if(data.success == true){
						$messages.find('.message-success').fadeIn('fast').delay(3000).fadeOut("fast", function(){
							jQuery.colorbox.close();
							$form.find('input[type=text], textarea').each(function(){
								jQuery(this).attr('value', "");
							});
						});
					} else {
						$messages.find('.message-error-server').fadeIn('fast').delay(3000).fadeOut("fast");
					}
				}).fail(function(){
					$messages.find('.message-error-server').fadeIn('fast').delay(3000).fadeOut("fast");
				});
				// display result based on response data
			} else {
				// display bad message result
				$messages.find('.message-error-user').fadeIn('fast').delay(3000).fadeOut("fast");
			}


	}
	</script>
	{else}
	<a href="#contact-owner-popup-form" id="contact-owner-popup-button" class="contact-owner-popup-button">{$settings->contactOwnerButtonDisabledTitle|trimWords:10}</a>
	{/if}
</div>
