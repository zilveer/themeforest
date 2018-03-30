<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php _e('Preview','theme_admin'); ?></title>
<?php wp_head(); ?>
<!--[if IE 6 ]>
	<link href="<?php echo THEME_CSS;?>/ie6.css" media="screen" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo THEME_JS;?>/dd_belatedpng-min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_JS;?>/ie6.js"></script>
<![endif]-->
<!--[if IE 7 ]>
<link href="<?php echo THEME_CSS;?>/ie7.css" media="screen" rel="stylesheet" type="text/css">
<![endif]-->
<!--[if IE 8 ]>
<link href="<?php echo THEME_CSS;?>/ie8.css" media="screen" rel="stylesheet" type="text/css">
<![endif]-->
<!--[if IE]>
	<script type="text/javascript" src="<?php echo THEME_JS;?>/html5.js"></script>
<![endif]-->
<script type="text/javascript">
var image_url='<?php echo THEME_IMAGES;?>';
var theme_url='<?php echo THEME_URI;?>';
<?php
	$fancybox_width = theme_get_option('advanced','fancybox_width');
	$fancybox_height = theme_get_option('advanced','fancybox_height');
	$fancybox_autoSize = theme_get_option('advanced','fancybox_autoSize')?'true':'false';
	$fancybox_autoWidth = theme_get_option('advanced','fancybox_autoWidth')?'true':'false';
	$fancybox_autoHeight = theme_get_option('advanced','fancybox_autoHeight')?'true':'false';
	$fancybox_fitToView = theme_get_option('advanced','fancybox_fitToView')?'true':'false';
	$fancybox_aspectRatio = theme_get_option('advanced','fancybox_aspectRatio')?'true':'false';
	$fancybox_arrows = theme_get_option('advanced','fancybox_arrows')?'true':'false';
	$fancybox_closeBtn = theme_get_option('advanced','fancybox_closeBtn')?'true':'false';
	$fancybox_closeClick = theme_get_option('advanced','fancybox_closeClick')?'true':'false';
	$fancybox_nextClick = theme_get_option('advanced','fancybox_nextClick')?'true':'false';
	$fancybox_autoPlay = theme_get_option('advanced','fancybox_autoPlay')?'true':'false';
	$fancybox_playSpeed = theme_get_option('advanced','fancybox_playSpeed');
	$fancybox_preload = theme_get_option('advanced','fancybox_preload');
	$fancybox_loop = theme_get_option('advanced','fancybox_loop')?'true':'false';
	$fancybox_thumbnail = theme_get_option('advanced','fancybox_thumbnail')?'true':'false';
	$fancybox_thumbnail_width = theme_get_option('advanced','fancybox_thumbnail_width');
	$fancybox_thumbnail_height = theme_get_option('advanced','fancybox_thumbnail_height');
	$fancybox_thumbnail_position = theme_get_option('advanced','fancybox_thumbnail_position');

		echo <<<JS
var fancybox_options = {
	width : {$fancybox_width},
	height : {$fancybox_height},
	autoSize: {$fancybox_autoSize},
	autoWidth: {$fancybox_autoWidth},
	autoHeight: {$fancybox_autoHeight},
	fitToView : {$fancybox_fitToView},
	aspectRatio: {$fancybox_aspectRatio},
	arrows: {$fancybox_arrows},
	closeBtn: {$fancybox_closeBtn},
	closeClick: {$fancybox_closeClick},
	nextClick: {$fancybox_nextClick},
	autoPlay: {$fancybox_autoPlay},
	playSpeed: {$fancybox_playSpeed},
	preload: {$fancybox_preload},
	loop: {$fancybox_loop},
	thumbnail : {$fancybox_thumbnail},
	thumbnail_width : {$fancybox_thumbnail_width},
	thumbnail_height : {$fancybox_thumbnail_height},
	thumbnail_position: '{$fancybox_thumbnail_position}'
};
JS;
	$pie_progress_bar_color = theme_get_option('color', 'pie_progress_bar_color');
	if(!$pie_progress_bar_color){
		$pie_progress_bar_color = theme_get_option('color', 'primary');
	}
	$pie_progress_track_color = theme_get_option('color', 'pie_progress_track_color');

	echo <<<JS
var pie_progress_bar_color = "{$pie_progress_bar_color}",
	pie_progress_track_color = "{$pie_progress_track_color}";

JS;
?>
</script>
</head>
<body class="preview" style="background:none">
<div id="page">
<div id="content">
<?php
if(isset($_POST['shortcode'])){
	echo do_shortcode(stripcslashes($_POST['shortcode']));
}
?>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>