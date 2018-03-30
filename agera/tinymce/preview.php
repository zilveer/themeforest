<?php

/* Hook Up To WP*/
$wp_content_path = explode( 'wp-content', __FILE__);
$wp_path = $wp_content_path[0];

require_once( $wp_path . '/wp-load.php' );
/* End Hook */

$sc = base64_decode(trim($_GET['shortcode']));
$preview = base64_decode(trim($_GET['preview']));

?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<?php wp_head(); ?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/tinymce/css/mpc-win.css' ?>" media="all" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/css/shortcodes-styles.css' ?>" media="all" />
		<style type="text/css">
 			 body {
 			 	overflow: hidden;
 			 	background: #FFFFFF;
 			 	height: 100%;
 			 	padding: 0;
 			 	margin-top: 0;
 			 	min-height: 300px;
 			 }

 			 #shortcode-preview,
 			 #shortcode-preview-partial,
 			 #shortcode-preview-false {
 			 	padding: 25px 0px;
 			 	margin: 0px 25px;
 			 	border-bottom: 1px solid #CECECE;
 			 	display: block;
 			 }

 			 #shortcode-code {
 			 	border-top: 1px solid #F2F2F2;
 			 	padding: 25px 0px;
 			 	margin: 0px 25px;
 			 	display: block;

 			 }

 			 .info {
 			 	position: relative;
 			 	margin-top: 50px;
 			 }
		</style>
	</head>
	<body>

		<?php if($preview == 'true'){ ?>
			<div id="shortcode-preview">
				<?php echo do_shortcode($sc); ?>
			</div>
		<?php } elseif($preview == 'partial') { ?>
			<div id="shortcode-preview-partial">
				<?php echo do_shortcode($sc); ?>
				<div class="info box-green">This preview may not be very accurate, due to the small preview space.</div>
			</div>
		<?php } elseif($preview == 'false') {?>
			<div id="shortcode-preview-false">
 				<img src="<?php echo get_template_directory_uri() . '/tinymce/images/no-preview.png' ?>"/>
 				<div class="info box-yellow">Sorry mate but there is no preview for this shortcode.</div>
			</div>
		<?php } ?>

		<div id="shortcode-code">
			<?php echo $sc; ?>
		</div>

		<script>
			jQuery(document).ready(function($) {
				// console.log('shortcode preview');
				$('div#shortcode-preview').height($('body').height() * 0.4);
			});
		</script>

	</body>
</html>