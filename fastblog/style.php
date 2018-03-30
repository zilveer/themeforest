<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<?php ob_start(); ?>
<style type="text/css">
	#header { height: <?php echo $header_height = fastblog_get_option('header/height'); ?>px; }
	#logo, #tagline { line-height: <?php echo $header_height; ?>px; }
	#logo img { max-height: <?php echo $header_height; ?>px; }
	#logo span { font-size: <?php echo round($header_height*1.1); ?>px; }
	<?php fastblog_option('custom_css'); ?>
</style>
<?php echo tb_style_minify(ob_get_clean())."\n"; ?>