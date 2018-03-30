<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

//Access WordPress
require_once( $path_to_wp.'/wp-load.php' );

if(isset($_POST['s']))
{
	$s = (int) $_POST['s'];
	$s1 = (int) $_POST['s1'];
	$s2 = (int) $_POST['s2'];
	if($s1+$s2!=$s)
	{
		echo '{"status":"NOK", "ERR":"'.__('Please check your value for validation because your result of sum is incorrect.','rb').'"}';
		die();
	}
}

$form = '<table cellspacing="1" cellpadding="2" border="0">'."\n";

for($i=0; $i<sizeof($_POST['key']); $i++)
	$form .= "<tr>\n\t<td valign=\"top\">".htmlspecialchars($_POST['title'][$i])."</td>\n\t<td>".htmlspecialchars($_POST[$_POST['key'][$i]])."</td>\n</tr>";

$form .= '</table>';

$subject = 'Online Form from '.get_bloginfo('name');

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.get_bloginfo('name')." <".get_bloginfo('admin_email').">\r\n";

// Mail it
if(function_exists('wp_mail'))
	$result = wp_mail(get_bloginfo('admin_email'), $subject, $form, $headers);
else
	$result = mail(get_bloginfo('admin_email'), $subject, $form, $headers);

if($result)
	echo '{"status":"OK"}';
else
	echo '{"status":"NOK", "ERR":"'.__('Have got an error while sending e-mail.', 'rb').'"}';

die();

?>