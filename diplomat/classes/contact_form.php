<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Contact_Form {

	public static $types = array(
		'textinput' => 'Textinput',
		'email' => 'Email',
		'website' => 'Website',
		'messagebody' => 'Message',
		'select' => 'Select',
		'checkbox' => 'Checkbox',
		'radio' => 'Radio',
		'title' => 'Title',
		'location' => 'Location',

	);
	public $options_description = array(), $contacts_form_titles = array(), $forms_count = 1;

	public static function save($data) {
		TMM::update_option('contact_form', $data);
	}

	public static function get_form($form_name) {
		$contact_forms = TMM::get_option('contact_form');
		if (!empty($contact_forms)) {
			//after import
			if (!empty($contact_forms) AND is_string($contact_forms)) {
				$contact_forms = unserialize($contact_forms);
			}

			$form_name_e = explode("\\", $form_name);

			if (count($form_name_e)>1){
				$form_name = implode("", $form_name_e);
			}

			foreach ($contact_forms as $form) {
				if ($form['title'] == $form_name) {
					return $form;
				}
			}
		}

		return array();
	}

	public static function get_forms_names() {
		$contact_forms = TMM::get_option('contact_form');
		$result = array();

		if (!empty($contact_forms)) {
			//after import
			if (!empty($contact_forms) AND is_string($contact_forms)) {
				$contact_forms = unserialize($contact_forms);
			}

			if (!empty($contact_forms) AND is_array($contact_forms)) {
				foreach ($contact_forms as $form) {
					if ($form['title'] == '__FORM_NAME__' OR empty($form['title'])) {
						continue;
					}
					$result[$form['title']] = $form['title'];
				}
			}
		}

		return $result;
	}

	public static function contact_form_request() {
		$data = array();
		parse_str($_REQUEST['values'], $data);
		$errors = array();
		$form = self::get_form($data['contact_form_name']);
		$email = "";
		$subject = "";
		$messagebody = "";
		$pre_message = "";
		$headers = '';
		$result = array(
			"is_errors" => 0,
			"info" => ""
		);

		/* set message */
		if (!empty($form['inputs'])) {
			foreach ($form['inputs'] as $key => $input) {
				$name = $input['type'] . $key;
				$input['label'] = trim($input['label'], ':');

				if ($input['is_required'] && empty($data[$name]) && ($input['type'] != 'radio' && $input['type'] != 'checkbox')) {
					$errors[$name] = trim($input['label']);
				}

				if (!empty($data[$name])) {

					if ($input['type'] == 'email') {
						if (!is_email($data[$name])) {
							$errors[$name] = $input['label'];
						}else{
							$email = $data[$name];
						}
					}

					if ($input['type'] == 'messagebody') {
						$messagebody .= $data[$name];
					}

					if ($input['type'] == 'website') {
						$subject = $data[$name];
					}

				}

				if ($input['type'] === 'checkbox') {

					$options = explode(',', $input['options']);

					$checkbox_data = '';

					foreach ($data[$name] as $key => $value) {

						if ($value) {

							$cb_key = strpos($value, 'cb_', 0);

							if ($cb_key !== false) {
								$cb_key = (int) str_replace('cb_', '', $value);
								$checkbox_data .= isset($options[$cb_key]) ? "&nbsp;&nbsp;&nbsp;&nbsp;<span> - {$options[$cb_key]}</span><br />" : '';
							} else {
								$checkbox_data .= "&nbsp;&nbsp;&nbsp;&nbsp;<span> - {$value}</span><br />";
							}

						}

					}

					if (!empty($checkbox_data)) {
						$pre_message .= "<strong>{$input['label']}</strong><br />";
					}

					$pre_message .= $checkbox_data . '<br />';

				} else if ($input['type'] === 'location') {
					$location = array(
						'country' => '',
						'state' => '',
						'county' => '',
						'city' => '',
						'zip' => '',
					);

					$countries = TMM_Contact_Form::get_countries();
					$states = TMM_Contact_Form::get_states();

					if (!empty($data[$name]['country'])) {
						$location['country'] = $data[$name]['country'];

						if ($location['country'] === 'US') {
							$location['state'] = $states[ $data[$name]['state'] ];
						} else {
							$location['county'] = $data[$name]['county'];
						}

						$location['country'] = $countries[ $location['country'] ];
					}

					if (!empty($data[$name]['city'])) {
						$location['city'] = $data[$name]['city'];
					}

					if (!empty($data[$name]['zip'])) {
						$location['zip'] = $data[$name]['zip'];
					}

					foreach ($location as $key => $value) {

						if ($value) {
							$pre_message .= "<strong>" . ucfirst($key) . "</strong>: {$value}<br /><br />";
						}

					}

				} else {

					if ($input['type'] != 'messagebody' && $input['type'] != 'title') {
						$text = $data[$name] ? $data[$name] : '';
						$pre_message .= "<strong>{$input['label']}</strong>: {$text}<br /><br />";
					}

				}

			}
		}

		$after_message = "\r\n<br />--------------------------------------------------------------------------------------------------\r\n<br /> " . sprintf( __('This mail was sent via %s contact form', 'diplomat'), site_url() );
		$messagebody = $pre_message . nl2br($messagebody) . $after_message;

		/* check captcha */
		if ( @$form['has_capture'] && substr($data['verify_code'], 7, 5) != $data['verify'] ) {
			$errors["verify"] = "Captcha";
		}

		/* check errors */
		if (!empty($errors)) {
			$result['is_errors'] = 1;
			$result['hash'] = md5(time());
			$result['info'] = $errors;
			echo json_encode($result);
			exit;
		}

		/* check subject */
		if (empty($subject)) {
			$subject = __("Email from contact form", 'diplomat');
		}

		/* set recipient email  */
		if (empty($form['recepient_email'])) {
			$recepient_mail = get_bloginfo('admin_email');
		} else {
			$recepient_mail = $form['recepient_email'];
		}

		/* set headers */
		if($email) {
			$headers .= 'From: '. $email . "\r\n";
		}

		add_filter('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
		add_filter('wp_mail_from_name', array(__CLASS__, 'set_mail_from_name'));

		/* set attachments */
		$attachments = array();
		if (!empty($_REQUEST['attachments'])) {
			$attach_counter = 0;
			foreach ($_REQUEST['attachments'] as $value) {
				if (is_file($value['file_path'])) {

					if (filesize($value['file_path']) > $form['attach_item_max_weight'] * 1024000) {
						continue;
					}

					if ($attach_counter >= $form['attach_count']) {
						break;
					}

					$attachments[] = $value['file_path'];
					$attach_counter++;
				}
			}
		}

		/* send email */
		if (wp_mail($recepient_mail, $subject, $messagebody, $headers, $attachments)) {
			$result["info"] = "succsess";
		} else {
			$result["info"] = "server_fail";
		}

		remove_filter('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
		remove_filter('wp_mail_from_name', array(__CLASS__, 'set_mail_from_name'));

		$result['hash'] = md5(time());

		if (!empty($_REQUEST['attachments'])) {
			foreach ($_REQUEST['attachments'] as $value) {
				TMM_Helper::delete_dir(dirname($value['file_path']));
			}
		}

		echo json_encode($result);
		exit;
	}

	public static function set_mail_from_name($name) {
		return get_option('blogname');
	}

	public static function set_html_content_type() {
		return 'text/html';
	}

	public static function get_countries() {
		return array(
			'AX' => 'Aland Islands',
			'AL' => 'Albania',
			'DZ' => 'Algeria',
			'AS' => 'American Samoa',
			'AD' => 'Andorra',
			'AO' => 'Angola',
			'AI' => 'Anguilla',
			'AQ' => 'Antarctica',
			'AG' => 'Antigua and Barbuda',
			'AR' => 'Argentina',
			'AM' => 'Armenia',
			'AW' => 'Aruba',
			'AU' => 'Australia',
			'AT' => 'Austria',
			'AZ' => 'Azerbaijan',

			'BS' => 'Bahamas',
			'BH' => 'Bahrain',
			'BD' => 'Bangladesh',
			'BB' => 'Barbados',
			'BE' => 'Belgium',
			'BZ' => 'Belize',
			'BJ' => 'Benin',
			'BM' => 'Bermuda',
			'BT' => 'Bhutan',
			'BO' => 'Bolivia',
			'BA' => 'Bosnia-Herzegovina',
			'BW' => 'Botswana',
			'BV' => 'Bouvet Island',
			'BR' => 'Brazil',
			'IO' => 'British Indian Ocean Territory',
			'BN' => 'Brunei Darussalam',
			'BG' => 'Bulgaria',
			'BF' => 'Burkina Faso',
			'BI' => 'Burundi',

			'KM' => 'Cambodia',
			'CA' => 'Canada',
			'CV' => 'Cape Verde',
			'KY' => 'Cayman Islands',
			'CF' => 'Central African Republic',
			'TD' => 'Chad',
			'CL' => 'Chile',
			'CN' => 'China',
			'CX' => 'Christmas Island',
			'CC' => 'Cocos (Keeling) Islands',
			'CO' => 'Colombia',
			'KM' => 'Comoros',
			'CD' => 'Democratic Republic of Congo',
			'CG' => 'Congo',
			'CK' => 'Cook Islands',
			'CR' => 'Costa Rica',
			'HR' => 'Croatia',
			'CY' => 'Cyprus',
			'CZ' => 'Czech Republic',

			'DK' => 'Denmark',
			'DJ' => 'Djibouti',
			'DM' => 'Dominica',
			'DO' => 'Dominican Republic',

			'EC' => 'Ecuador',
			'EG' => 'Egypt',
			'SV' => 'El Salvador',
			'ER' => 'Eriteria',
			'EE' => 'Estonia',
			'ET' => 'Ethiopia',

			'FK' => 'Falkland Islands (Malvinas)',
			'FO' => 'Faroe Islands',
			'FJ' => 'Fiji',
			'FI' => 'Finland',
			'FR' => 'France',
			'GF' => 'French Guiana',
			'PF' => 'French Polynesia',
			'TF' => 'French Southern Territories',

			'GA' => 'Gabon',
			'GM' => 'Gambia',
			'GE' => 'Georgia',
			'DE' => 'Germany',
			'GH' => 'Ghana',
			'GI' => 'Gibraltar',
			'GR' => 'Greece',
			'GL' => 'Greenland',
			'GD' => 'Grenada',
			'GP' => 'Guadeloupe',
			'GU' => 'Guam',
			'GT' => 'Guatemala',
			'GG' => 'Guernsey',
			'GN' => 'Guinea',
			'GW' => 'Guinea Bissau',
			'GY' => 'Guyana',

			'HM' => 'Heard Island / McDonald Islands',
			'VA' => 'Holy See (Vatican)',
			'HN' => 'Honduras',
			'HK' => 'Hong Kong',
			'HU' => 'Hungary',

			'IS' => 'Iceland',
			'IN' => 'India',
			'ID' => 'Indonesia',
			'IE' => 'Ireland',
			'IM' => 'Isle of Man',
			'IL' => 'Israel',
			'IT' => 'Italy',

			'JM' => 'Jamaica',
			'JP' => 'Japan',
			'JE' => 'Jersey',
			'JO' => 'Jordan',

			'KZ' => 'Kazakhstan',
			'KE' => 'Kenya',
			'KI' => 'Kiribati',
			'KR' => 'Korea, Republic of',
			'KW' => 'Kuwait',
			'KG' => 'Kyrgyzstan',

			'LA' => 'Laos',
			'LV' => 'Latvia',
			'LS' => 'Lesotho',
			'LI' => 'Liechtenstein',
			'LT' => 'Lithuania',
			'LU' => 'Luxembourg',

			'MO' => 'Macao',
			'MK' => 'Macedonia',
			'MG' => 'Madagascar',
			'MW' => 'Malawi',
			'MY' => 'Malaysia',
			'MV' => 'Maldives',
			'ML' => 'Mali',
			'MT' => 'Malta',
			'MH' => 'Marshall Islands',
			'MQ' => 'Martinique',
			'MR' => 'Mauritania',
			'MU' => 'Mauritius',
			'YT' => 'Mayotte',
			'MX' => 'Mexico',
			'FM' => 'Micronesia, Federated States of',
			'MD' => 'Moldova, Republic of',
			'MC' => 'Monaco',
			'MN' => 'Mongolia',
			'ME' => 'Montenegro',
			'MS' => 'Montserrat',
			'MA' => 'Morocco',
			'MZ' => 'Mozambique',

			'NA' => 'Namibia',
			'NR' => 'Nauru',
			'NP' => 'Nepal',
			'NL' => 'Netherlands',
			'AN' => 'Netherlands Antilles',
			'NC' => 'New Calendonia',
			'NZ' => 'New Zealand',
			'NI' => 'Nicaragua',
			'NE' => 'Niger',
			'NU' => 'Niue',
			'NF' => 'Norfolk Island',
			'MP' => 'Northern Mariana Islands',
			'NO' => 'Norway',

			'OM' => 'Oman',

			'PW' => 'Palau',
			'PS' => 'Palestine',
			'PA' => 'Panama',
			'PY' => 'Paraguay',
			'PG' => 'Papua New Guinea',
			'PE' => 'Peru',
			'PH' => 'Philippines',
			'PN' => 'Pitcairn',
			'PL' => 'Poland',
			'PT' => 'Portugal',
			'PR' => 'Puerto Rico',

			'QA' => 'Qatar',

			'RE' => 'Reunion',
			'RO' => 'Romania',
			'RS' => 'Republic of Serbia',
			'RU' => 'Russian Federation',
			'RW' => 'Rwanda',

			'SH' => 'Saint Helena',
			'KN' => 'Saint Kitts and Nevis',
			'LC' => 'Saint Lucia',
			'PM' => 'Saint Pierre and Miquelon',
			'VC' => 'Saint Vincent / Grenadines',
			'WS' => 'Samoa',
			'SM' => 'San Marino',
			'ST' => 'Sao Tome and Principe',
			'SA' => 'Saudi Arabia',
			'SN' => 'Senegal',
			'SC' => 'Seychelles',
			'SL' => 'Sierra Leone',
			'SG' => 'Singapore',
			'SK' => 'Slovakia',
			'SI' => 'Slovenia',
			'SB' => 'Solomon Islands',
			'SO' => 'Somalia',
			'ZA' => 'South Africa',
			'GS' => 'South Georgia / South Sandwich',
			'ES' => 'Spain',
			'LK' => 'Sri Lanka',
			'SR' => 'Suriname',
			'SJ' => 'Svalbard and Jan Mayen',
			'SZ' => 'Swaziland',
			'SE' => 'Sweden',
			'CH' => 'Switzerland',

			'TW' => 'Taiwan, Province of China',
			'TJ' => 'Tajikistan',
			'TZ' => 'Tanzania, United Republic of',
			'TH' => 'Thailand',
			'TL' => 'Timor-Leste',
			'TG' => 'Togo',
			'TK' => 'Tokelau',
			'TO' => 'Tonga',
			'TT' => 'Trinidad and Tobago',
			'TN' => 'Tunisia',
			'TR' => 'Turkey',
			'TM' => 'Turkmenistan',
			'TC' => 'Turks and Caicos Islands',
			'TV' => 'Tuvalu',

			'UG' => 'Uganda',
			'UA' => 'Ukraine',
			'AE' => 'United Arab Emirates',
			'GB' => 'United Kingdom',
			'US' => 'United States',
			'UM' => 'US Minor Outlying Islands',
			'UY' => 'Uruguay',
			'UZ' => 'Uzbekistan',

			'VU' => 'Vanuatu',
			'VE' => 'Venezuela',
			'VN' => 'Vietnam',
			'VG' => 'Virgin Islands, British',
			'VI' => 'Virgin Islands, U.S.',

			'WF' => 'Wallis and Futuna',
			'EH' => 'Western Sahara',

			'YE' => 'Yemen',

			'ZM' => 'Zambia'
		);
	}

	public static function get_states() {
		return array(
			'AL' => 'Alabama',
			'AK' => 'Alaska',
			'AS' => 'American Samoa',
			'AZ' => 'Arizona',
			'AR' => 'Arkansas',
			'CA' => 'California',
			'CO' => 'Colorado',
			'CT' => 'Connecticut',
			'DE' => 'Delaware',
			'DC' => 'District of Columbia',
			'FM' => 'Federated States of Micronesia',
			'FL' => 'Florida',
			'GA' => 'Georgia',
			'GU' => 'Guam',
			'HI' => 'Hawaii',
			'ID' => 'Idaho',
			'IL' => 'Illinois',
			'IN' => 'Indiana',
			'IA' => 'Iowa',
			'KS' => 'Kansas',
			'KY' => 'Kentucky',
			'LA' => 'Louisiana',
			'ME' => 'Maine',
			'MH' => 'Marshall Islands',
			'MD' => 'Maryland',
			'MA' => 'Massachusetts',
			'MI' => 'Michigan',
			'MN' => 'Minnesota',
			'MS' => 'Mississippi',
			'MO' => 'Missouri',
			'MT' => 'Montana',
			'NE' => 'Nebraska',
			'NV' => 'Nevada',
			'NH' => 'New Hampshire',
			'NJ' => 'New Jersey',
			'NM' => 'New Mexico',
			'NY' => 'New York',
			'NC' => 'North Carolina',
			'ND' => 'North Dakota',
			'MP' => 'Northern Mariana Islands',
			'OH' => 'Ohio',
			'OK' => 'Oklahoma',
			'OR' => 'Oregon',
			'PW' => 'Palau',
			'PA' => 'Pennsylvania',
			'PR' => 'Puerto Rico',
			'RI' => 'Rhode Island',
			'SC' => 'South Carolina',
			'SD' => 'South Dakota',
			'TN' => 'Tennessee',
			'TX' => 'Texas',
			'UT' => 'Utah',
			'VT' => 'Vermont',
			'VI' => 'Virgin Islands',
			'VA' => 'Virginia',
			'WA' => 'Washington',
			'WV' => 'West Virginia',
			'WI' => 'Wisconsin',
			'WY' => 'Wyoming',
			'AA' => 'Armed Forces Americas',
			'AE' => 'Armed Forces',
			'AP' => 'Armed Forces Pacific'
		);
	}

}
