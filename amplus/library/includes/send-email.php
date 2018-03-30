<?php
// find wp-load.php
$wpLoad = 'wp-load.php';
for ($i = 0; $i < 8; $i++) {
	if (file_exists($wpLoad)) {
		require_once($wpLoad);
		break;
	}
	$wpLoad = '../'.$wpLoad;
}

$date = date("F j, Y, g:i a");

$date = date_i18n(get_option('date_format'), current_time('timestamp'));

$retErr = '0';
$retOK = '1';
$retCaptchaErr = '2';

// check for recaptcha
if (function_exists('bfi_recaptcha_contactform_check')) {
    if (!bfi_recaptcha_contactform_check()) {
        echo $retCaptchaErr;
        die();
    }
}

if (!isset($_POST['name']) ||
    !isset($_POST['email']) ||
    !isset($_POST['message'])) die($retErr);

// get additional fields
$additionalFields = bfi_get_contact_additional_fields();
$additionalFieldNames = array();
$additionalFieldIDs = array();
foreach ($additionalFields as $key => $field) {
    if (trim($field) == "") continue;
    $fieldName = preg_replace('/\s?\*/', '', trim($field));
    $fieldName = strtolower(trim(preg_replace('#\[[^\]]+\]#', '', $fieldName)));
    $fieldName = preg_replace('#  #', ' ', $fieldName);
    $additionalFieldNames[] = $fieldName;
    $additionalFieldIDs[] = 'additional_field_'.$key;
}
unset($additionalFields);


// email variables
$fromName = $_POST['name'];
$fromEmail = $_POST['email'];
$toName = "";
$toEmail = bfi_get_option(BFI_OPTIONEMAIL);

$subject = html_entity_decode(bfi_get_option(BFI_OPTIONEMAILSUBJECT));
$message = $_POST['message'];
$body = '';
$headers = 'From: ' . $fromEmail . "\r\n" .
    'Reply-To: ' .$fromEmail . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


// build the body of the email
$body .= html_entity_decode(sprintf(__('Sent date: %s', BFI_I18NDOMAIN), $date), ENT_COMPAT, "UTF-8") . "\r\n";
$body .= html_entity_decode(sprintf(__('Name: %s', BFI_I18NDOMAIN), $fromName), ENT_COMPAT, "UTF-8") . "\r\n";
$body .= html_entity_decode(sprintf(__('Email: %s', BFI_I18NDOMAIN), $fromEmail), ENT_COMPAT, "UTF-8") . "\r\n";
foreach ($additionalFieldIDs as $key => $id) {
    if (array_key_exists($key, $additionalFieldNames) &&
        array_key_exists($id, $_POST)) {
        $body .= ucfirst(html_entity_decode($additionalFieldNames[$key], ENT_COMPAT, "UTF-8")) . ': ' . preg_replace("#\n\n#", "\n", $_POST[$id]) . "\r\n";
    }
}
$body .= "\r\n" . html_entity_decode(__('Message:', BFI_I18NDOMAIN), ENT_COMPAT, "UTF-8") . "\r\n\r\n";
$body .= $message;
$body = stripcslashes($body);


// send the email
if (wp_mail($toEmail, $subject, $body, $headers)) {
	echo $retOK;
} else {
	echo $retErr;
}
