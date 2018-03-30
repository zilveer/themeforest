<?php

/*-----------------------------------------------------------------------------------*/
/*	Contact Form 7 Wrapper VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			if ( shortcode_exists( 'contact-form-7' ) ) {

				$cf7 = get_posts( 'post_type="wpcf7_contact_form"&posts_per_page=-1&orderby=title&order=ASC' );
				$contact_forms = array();
				if ( $cf7 ) {
					foreach ( $cf7 as $cform ) {
						$contact_forms[ $cform->post_title ] = $cform->ID;
					}
				} else {
					$contact_forms[ __( 'No contact forms found', 'js_composer' ) ] = 0;
				}

				$api_keys = array();
				$api_keys_all = array(
					'mailchimp' => 'MailChimp',
					'aweber' => 'AWeber',
					'madmimi' => 'MadMimi',
					'campaign_monitor' => 'CampaignMonitor',
					'get_response' => 'GetResponse'
				);

				foreach ($api_keys_all as $key => $value) {

					$key_values = startuply_option("vivaco_{$key}_api_key", '');

					if ( !empty($key_values) ) {
						if (empty($api_keys)) {
							$api_keys['None'] = '';
						}
						$api_keys[$value] = $key;
					}
				}

				/*
					'vivaco_mailchimp_api_key'
					'vivaco_aweber_api_key'
					'vivaco_madmimi_api_key'
					'vivaco_campaign_monitor_api_key'
					'vivaco_get_response_api_key'
				*/

				$params = array(

					array(
						'type' => 'dropdown',
						'heading' => __( 'Select contact form', 'vivaco' ),
						'param_name' => 'id',
						'value' => $contact_forms,
						'description' => __( 'Choose previously created contact form from the drop down list.', 'vivaco' )
					),
				);


				$params[] = array(

					"type" => "checkbox",
					"heading" => __("Show/Hide", "vivaco"),
					"param_name" => "_wpcf7_vsc_hide_after_send",
					"value" => array(
						__("Hide form on successful submit", "vivaco") => "yes"
					)
				);
				$params[] = array(

					"type" => "checkbox",
					"heading" => __("Redirect/Idle", "vivaco"),
					"param_name" => "_wpcf7_vsc_redirect_after_send",
					"value" => array(
						__("Redirect to another page on successful submit", "vivaco") => "yes"
					)
				);
				$params[] = array(

					"type" => "textfield",
					"heading" => __("Redirect url", "vivaco"),
					"param_name" => "_wpcf7_vsc_redirect_url",
					"admin_label" => true,
					"dependency" => array(
						"element" => "_wpcf7_vsc_redirect_after_send",
						"value" => "yes"
					),
					"description" => __("Please enter full page url with http://", "vivaco"),
				);

				if( empty($api_keys) ) {

					$params[] = array(
						'param_name' => 'custom_warning1', // all params must have a unique name
						'type' => 'custom_markup', // this param type
						'heading' => __( 'List Subscribe Settings', 'vivaco' ),
						"dependency" => array(
							"element" => "vsc_use_mailchimp",
							"value" => "yes"
						),
						'value' => __( '<div class="alert alert-info">Please set "Mailchimp Api key" or any other key in Startuply options to use List Subscribe shortcode functionality <a href="http://kb.mailchimp.com/accounts/management/about-api-keys" target="_blank">Where can i find my API key?</a></div>', 'vivaco' ), // your custom markup
					);
				} else {

					$params[] = array(
						'type' => 'dropdown',
						'heading' => __( 'Select MailList Provider form', 'vivaco' ),
						'param_name' => '_wpcf7_vsc_provider',
						'value' => $api_keys,
						'description' => __( 'Choose previously created contact form from the drop down list.', 'vivaco' )
					);

					// $params[] = array(
					// 	"type" => "checkbox",
					// 	"heading" => __("Mailchimp API", "vivaco"),
					// 	"param_name" => "_wpcf7_vsc_use_mailchimp",
					// 	"value" => array(
					// 		__("Enable Mailchimp for this form", "vivaco") => "yes"
					// 	),
					// 	"dependency" => array(
					// 		"element" => "_wpcf7_vsc_provider",
					// 		"value" => "mailchimp"
					// 	),
					// );
						$params[] = array(
							"type" => "textfield",
							"heading" => __("MailChimp List ID", "vivaco"),
							"param_name" => "_wpcf7_vsc_mailchimp_list_id",
							"admin_label" => true,
							"dependency" => array(
								"element" => "_wpcf7_vsc_provider",
								"value" => "mailchimp"
							),
							"description" => __("Enter MailChimp List ID here. <a href=\"http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id\" target=\"_blank\">Where can i find my List ID?</a>", "vivaco"),
						);
						$params[] = array(
							"type" => "checkbox",
							"heading" => __("Double opt-in", "vivaco"),
							"param_name" => "_wpcf7_vsc_double_opt",
							"dependency" => array(
								"element" => "_wpcf7_vsc_provider",
								"value" => "mailchimp"
							),
							"value" => array(
								__("Enable Mailchimp Double Opt-in", "vivaco") => "yes"
							),
							"description" => __("What is <a href=\"http://kb.mailchimp.com/lists/signup-forms/the-double-opt-in-process\" target=\"_blank\">Double Opt-in</a> used for?", "vivaco"),
						);


					$params[] = array(
						"type" => "textfield",
						"heading" => __("AWeber List ID", "vivaco"),
						"param_name" => "_wpcf7_vsc_aweber_list_id",
						"admin_label" => true,
						"dependency" => array(
							"element" => "_wpcf7_vsc_provider",
							"value" => "aweber"
						),
						"description" => __("Enter AWeber List ID here. <a href=\"\" target=\"_blank\">Where can i find my List ID?</a>", "vivaco"),
					);


                    $params[] = array(
                        "type" => "textfield",
                        "heading" => __("MadMimi List ID", "vivaco"),
                        "param_name" => "_wpcf7_vsc_madmimi_list_id",
                        "admin_label" => true,
                        "dependency" => array(
                            "element" => "_wpcf7_vsc_provider",
                            "value" => "madmimi"
                        ),
                        "description" => __("Enter MadMimi List ID here. <a href=\"\" target=\"_blank\">Where can i find my List ID?</a>", "vivaco"),
                    );
                    $params[] = array(
                        "type" => "textfield",
                        "heading" => __("MadMimi Email", "vivaco"),
                        "param_name" => "_wpcf7_vsc_madmimi_email",
                        "admin_label" => true,
                        "dependency" => array(
                            "element" => "_wpcf7_vsc_provider",
                            "value" => "madmimi"
                        ),
                        "description" => __("Enter MadMimi Username or email here. <a href=\"\" target=\"_blank\">Where can i find my List ID?</a>", "vivaco"),
                    );



                    $params[] = array(
                        "type" => "textfield",
                        "heading" => __("CampaignMonitor List ID", "vivaco"),
                        "param_name" => "_wpcf7_vsc_campaign_monitor_list_id",
                        "admin_label" => true,
                        "dependency" => array(
                            "element" => "_wpcf7_vsc_provider",
                            "value" => "campaign_monitor"
                        ),
                        "description" => __("Enter CampaignMonitor List ID here. <a href=\"\" target=\"_blank\">Where can i find my List ID?</a>", "vivaco"),
                    );

                    $params[] = array(
                        "type" => "textfield",
                        "heading" => __("GetResponse Campaign Name", "vivaco"),
                        "param_name" => "_wpcf7_vsc_get_response_list_id",
                        "admin_label" => true,
                        "dependency" => array(
                            "element" => "_wpcf7_vsc_provider",
                            "value" => "get_response"
                        ),
                        "description" => __("Enter GetResponse Campaign Name here. <a href=\"\" target=\"_blank\">Where can i find my List ID?</a>", "vivaco"),
                    );

				}

				vc_map( array(
					'base' => 'contact-form-7-wrapper',
					'name' => __( 'Form Manager', 'vivaco' ),
					'icon' => 'icon-wpb-contactform7',
					'category' => __( 'Content', 'vivaco' ),
					'weight' => 18,
					'description' => __( 'Contact 7 form controls', 'vivaco' ),
					'params' => $params
				) );





/*-----------------------------------------------------------------------------------*/
/*	Contact Form 7 Wrapper VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
				function contact_form_7_wrapper($atts, $content = null) {
					extract(shortcode_atts(array(
						'title' => '',
						'id' => '',
						'_wpcf7_vsc_hide_after_send' => 'false',
						'_wpcf7_vsc_redirect_after_send' => 'false',
						'_wpcf7_vsc_redirect_url' => '',

						'_wpcf7_vsc_provider' => '',

						'_wpcf7_vsc_use_mailchimp' => false, // not use, for backward compatibility
						'_wpcf7_vsc_mailchimp_list_id' => '',
						'_wpcf7_vsc_double_opt' => 'false',

						'_wpcf7_vsc_aweber_list_id' => '',

						'_wpcf7_vsc_madmimi_list_id' => '',
						'_wpcf7_vsc_madmimi_email' => '',

						'_wpcf7_vsc_campaign_monitor_list_id' => '',

						'_wpcf7_vsc_get_response_list_id' => '',
					), $atts));

					$_wpcf7_vsc_double_opt = $_wpcf7_vsc_double_opt === 'yes';

					$_wpcf7_vsc_redirect_after_send = $_wpcf7_vsc_redirect_after_send === 'yes';
					$_wpcf7_vsc_hide_after_send = $_wpcf7_vsc_hide_after_send === 'yes';

					$token = wp_generate_password(5, false, false);

					wp_enqueue_script( 'vsc-custom-contact-form-7' );

					$localizes = array(
						'_wpcf7_vsc_redirect_after_send' => $_wpcf7_vsc_redirect_after_send,
						'_wpcf7_vsc_redirect_url' => empty($_wpcf7_vsc_redirect_url) ? $_wpcf7_vsc_redirect_url : base64_encode($_wpcf7_vsc_redirect_url),
						'_wpcf7_vsc_hide_after_send' => $_wpcf7_vsc_hide_after_send,

						'_wpcf7_vsc_provider' => $_wpcf7_vsc_provider,

						'_wpcf7_vsc_mailchimp_list_id' => $_wpcf7_vsc_mailchimp_list_id,
						'_wpcf7_vsc_double_opt' => $_wpcf7_vsc_double_opt,

						'_wpcf7_vsc_aweber_list_id' => $_wpcf7_vsc_aweber_list_id,

						'_wpcf7_vsc_madmimi_list_id' => $_wpcf7_vsc_madmimi_list_id,
						'_wpcf7_vsc_madmimi_email' => $_wpcf7_vsc_madmimi_email,

						'_wpcf7_vsc_campaign_monitor_list_id' => $_wpcf7_vsc_campaign_monitor_list_id,

						'_wpcf7_vsc_get_response_list_id' => $_wpcf7_vsc_get_response_list_id,
					);

					wp_localize_script( 'vsc-custom-contact-form-7', 'vsc_custom_contact_form_7_' . $token,
						$localizes
					);

					$output = "<div class=\"contact-form-7-data\" data-token=\"{$token}\">[contact-form-7 id=\"{$id}\" title=\"{$title}\"]</div>";

					return do_shortcode($output); // redirect to default contact-form-7 shortcode
				}
				add_shortcode("contact-form-7-wrapper", "contact_form_7_wrapper");
			}
