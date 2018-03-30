<?php
	if ( !$_GET['popup'] ) exit;

	require 'tinymce.class.php';
    	$van_output->popup = trim( $_GET['popup'] );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title><?php $van_output->van_tinymce_title(); ?></title>

	<script type="text/javascript" src="../../../../../wp-admin/load-scripts.php?c=1&load=jquery,jquery-core,jquery-migrate"></script>
	<script type="text/javascript" src="../../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<link rel="stylesheet" id='popup-css' href="popup-css.css" />
	
	<?php $van_output->van_tinymce_js(); ?>

</head>
<body>

	<div id="van-popup">

		<form method="post" id="van-popup-form">

			<?php $van_output->van_tinymce_html(); ?>

		</form>

	</div>

</body>
</html>