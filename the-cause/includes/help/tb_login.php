<?php

/* LOGIN PAGE */
function the_url()
{
	return home_url();
}

add_filter("login_headerurl","the_url");

function tb_admin_title()
{
	return get_bloginfo('name');
}

add_filter("login_headertitle","tb_admin_title");

// retrieve image size if getimagesize is disabled
// http://stackoverflow.com/questions/4635936/super-fast-getimagesize-in-php
function tb_image_size($url){

	if (function_exists(curl_init)) {
	    $curl = curl_init($url);
		
		if (!$curl) {
			return FALSE;
		} else {
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    $data = curl_exec($curl);
		    curl_close($curl);
			
			$im = imagecreatefromstring($data);
			
			$width = imagesx($im);
			$height = imagesy($im);
			
			$imSize = array($width, $height);
		    return $imSize;
		}		
	} else {
		return FALSE;
	}
}

// custom login for theme
function tb_custom_login() {
	
	$loginImage = get_option('tb_login_logo', DEFAULT_LOGIN_LOGO);
	
	$loginColor = get_option('tb_login_bgcolor', DEFAULT_LOGIN_BGCOLOR);
	
	$loginImageSize = tb_image_size($loginImage);
	
	if (!$loginImageSize) {
		$loginImageSize = getimagesize($loginImage);
	}
	
	$loginImageWidth = $loginImageSize[0];
	$loginImageHeight = $loginImageSize[1];
	
	$tbLoginStyle = '';
	
	$tbLoginStyle .= "body.login {background: $loginColor" . " !important;}\n";
	
	$loginDiv = 320;
	
	if ($loginDiv < $loginImageWidth) {
		$loginDiv = $loginImageWidth;
		$tbLoginStyle .= "#login {width: $loginDiv" . "px !important;}\n";
	}

	$loginImageMargin = floor(($loginDiv - $loginImageWidth)/2);	
	$tbLoginStyle .= ".login h1 a {width: $loginImageWidth" . "px !important; height: $loginImageHeight" . "px !important; margin-left: $loginImageMargin" . "px !important;}\n";
	$tbLoginStyle .= ".login h1 a { background-image: url($loginImage) !important; background-size: auto !important;}\n";
	$tbLoginStyle .= ".login #nav, .login #backtoblog {text-shadow: none !important;}";
	
	?>
    
    <style type="text/css">
		<?php echo $tbLoginStyle; ?>
	</style>
    
    <?php
}

if (get_option('tb_login_change') == 1) { 
	add_action('login_head', 'tb_custom_login');
}

?>