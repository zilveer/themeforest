// Custom Contact Forms Script //
jQuery(window).load( function() {

	// Contact Forms 7 extra data
	jQuery('.contact-form-7-data').each( function() {

		var $div = jQuery(this);
		var token = $div.data('token');
		var settings = window['vsc_custom_contact_form_7_' + token];
		/*
		settings = {
			_wpcf7_vsc_redirect_after_send: [0|1],
			_wpcf7_vsc_redirect_url: ...,

			_wpcf7_vsc_provider: [mailchimp | aweber | madmimi | campaign_monitor | get_response],

			_wpcf7_vsc_mailchimp_list_id: ...,
			_wpcf7_vsc_double_opt: [0|1],

			_wpcf7_vsc_aweber_list_id: ...,

			_wpcf7_vsc_madmimi_list_id: ...,
			_wpcf7_vsc_madmimi_email: ...,

			_wpcf7_vsc_campaign_monitor_list_id: ...,

			_wpcf7_vsc_get_response_list_id: ...,
		}
		*/

		var $form = $div.find('form');
		if (settings._wpcf7_vsc_redirect_after_send) {
			$form.append( '<input type="hidden" name="_wpcf7_vsc_redirect_after_send" value="true" />' );
			$form.append( '<input type="hidden" name="_wpcf7_vsc_redirect_url" value="'+ settings._wpcf7_vsc_redirect_url + '" />' );
		}

		if (settings._wpcf7_vsc_hide_after_send) {
			$form.append( '<input type="hidden" name="_wpcf7_vsc_hide_after_send" value="true" />' );
		}


		if (settings._wpcf7_vsc_provider) {
			$form.append( '<input type="hidden" name="_wpcf7_vsc_provider" value="'+ settings._wpcf7_vsc_provider + '" />' );

			if (settings._wpcf7_vsc_provider == 'mailchimp' ) {
				$form.append( '<input type="hidden" name="_wpcf7_vsc_mailchimp_list_id" value="'+ settings._wpcf7_vsc_mailchimp_list_id + '" />' );
				$form.append( '<input type="hidden" name="_wpcf7_vsc_double_opt" value="'+ settings._wpcf7_vsc_double_opt + '" />' );
			}

			if (settings._wpcf7_vsc_provider == 'aweber' ) {
				$form.append( '<input type="hidden" name="_wpcf7_vsc_aweber_list_id" value="'+ settings._wpcf7_vsc_aweber_list_id + '" />' );
			}

			if (settings._wpcf7_vsc_provider == 'madmimi' ) {
				$form.append( '<input type="hidden" name="_wpcf7_vsc_madmimi_list_id" value="'+ settings._wpcf7_vsc_madmimi_list_id + '" />' );
				$form.append( '<input type="hidden" name="_wpcf7_vsc_madmimi_email" value="'+ settings._wpcf7_vsc_madmimi_email + '" />' );				
			}

			if (settings._wpcf7_vsc_provider == 'campaign_monitor' ) {
				$form.append( '<input type="hidden" name="_wpcf7_vsc_campaign_monitor_list_id" value="'+ settings._wpcf7_vsc_campaign_monitor_list_id + '" />' );
			}

			if (settings._wpcf7_vsc_provider == 'get_response' ) {
				$form.append( '<input type="hidden" name="_wpcf7_vsc_get_response_list_id" value="'+ settings._wpcf7_vsc_get_response_list_id + '" />' );
			}

		}

	});
});
