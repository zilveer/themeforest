<?php header('HTTP/1.1 503 Service Temporarily Unavailable'); // Send 503 HTTP header ?>
<!DOCTYPE html> 
<html dir="ltr" lang="en-US"> 
<head> 
<meta charset="UTF-8"> 
<title><?php bloginfo('name'); ?></title>

<style type="text/css">
<?php if ( air_maintenance::get_option('maintenance-css') ): ?>
	<?php echo air_maintenance::get_option('maintenance-css'); ?>
<?php else: ?>
	body { font-family: Arial,sans-serif; font-size: 15px; color: #444; line-height: 1.5em; margin: 80px; }
	h1 { font-size: 32px; letter-spacing: -1px; margin-bottom: 30px; }
	.wrap { margin: 0 auto; text-align: center; width: 500px; }
	.note { background: #fffad6; color: #846000; padding: 10px; }
<?php endif; ?>
</style>

</head>
<body>
<?php if ( air_maintenance::get_option('maintenance-html') ): ?>
	<?php echo air_maintenance::get_option('maintenance-html'); ?>
<?php else: ?>
	<div class="wrap">
		<h1>Site Maintenance</h1>
		<p class="note">Site is currently under maintenance. Please check back later.</p>
	</div>
<?php endif; // end custom html ?>
</body>
</html>
