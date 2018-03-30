<?php

	header("Content-type: text/css; charset: UTF-8");

	/*	
	*	Goodlayers IE Style File
	*	---------------------------------------------------------------------
	*	
	*	---------------------------------------------------------------------
	*/
	
?>

div.shortcode-dropcap.circle{
	position: relative;
	z-index: 1000;
	behavior: url(<?php echo $_GET['path']?>/stylesheet/ie-fix/PIE.php);
}

label img {
  behavior: url(<?php echo $_GET['path']?>/stylesheet/ie-fix/label_img.htc);
}

div.social-icon-wrapper.bottom-slider-on{ 
	padding: 10px 5px 0px 16px; 
} 