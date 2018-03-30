<?php
require_once get_template_directory() . '/framework/main.php';
if (file_exists(get_template_directory() . '/demo/demo.php')) {
    	$detect = new Mobile_Detect;
	if(! $detect->isMobile()) {
            require_once get_template_directory() . '/demo/demo.php';
	}
}
?>