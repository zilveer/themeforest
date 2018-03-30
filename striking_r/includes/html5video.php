<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 */
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=false" />
<title><?php echo theme_generator('title'); ?></title>
<?php if($custom_favicon = theme_get_option('general','custom_favicon')) { ?>
<link rel="shortcut icon" href="<?php echo theme_get_image_src($custom_favicon); ?>" />
<?php } ?>

<!-- Feeds and Pingback -->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo THEME_URI;?>/mediaelement/mediaelementplayer.css"/>
<script type="text/javascript" src="<?php echo THEME_URI;?>/mediaelement/mediaelement-and-player.js"></script>
<style type="text/css">
	body{
		margin:0;	
		overflow: hidden;
	}
	.iframe-video-wrap{
		background: none repeat scroll 0 0 transparent;
		height: 100%;
		margin: 0;
		overflow: hidden;
		padding: 0;
		width: 100%;
		position: absolute;
		z-index: 0;
	}
	.kenburn-video{
		position:absolute;
		z-index:2;	
	}
</style>
<script	type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#kenburn-video').mediaelementplayer({
			videoWidth: jQuery(window).width(),
			videoHeight: jQuery(window).height(),
			features: ['playpause','progress','current','duration','tracks','volume']
		});
	});
</script>
</head>
<body>
	<div class="iframe-video-wrap">
<?php
	$post_id = (int)$_GET['sliderid'];
	$mp4_src = htmlspecialchars(get_post_meta($post_id, '_ken_video_mp4_src', true));
	$webm_src =  htmlspecialchars(get_post_meta($post_id, '_ken_video_webm_src', true));
	$ogg_src =  htmlspecialchars(get_post_meta($post_id, '_ken_video_ogg_src', true));

	$uri = get_template_directory_uri();
?>
		<video id="kenburn-video" style="width:100%;height:100%;" controls="controls" tabindex="0">
			<?php if(!empty($mp4_src)):?><source type="video/mp4" src="<?php echo $mp4_src;?>"></source><?php endif;?>
			<?php if(!empty($ogg_src)):?><source type="video/ogg" src="<?php echo $ogg_src;?>"></source><?php endif;?>
			<?php if(!empty($webm_src)):?><source type="video/webm" src="<?php echo $webm_src;?>"></source><?php endif;?>
		</video>	
	</div>	
</body>
</html>
