<?php

if(!array_key_exists('sc', $_POST) || 
	strlen(trim($_POST['sc'])) < 1)
	return;

// get the shortcode
$sc = $_POST['sc'];

//Used for wp functions
require_once('../../../../../wp-config.php');

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
<?php wp_head(); ?>
<style type="text/css">
html { margin: 0 !important; }
body { padding: 20px 15px; background:none;}
</style>
</head>
<body>
<?php echo do_shortcode( $sc ); ?>
</body>
</html>