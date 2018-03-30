<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<?php ob_start(); ?>
<script type="text/javascript">
	<?php echo file_get_contents(get_template_directory().'/schemes/'.fastblog_get_option('scheme').'/style.js'); ?>
	fancybox = {
		"enabled":    <?php echo tb_bool_to_string(fastblog_get_option('fancybox/enabled')); ?>,
		"show_title": <?php echo tb_bool_to_string(fastblog_get_option('fancybox/show_title')); ?>
	};
	<?php
		$typography = array();
		foreach (fastblog_get_option('typography/fonts') as $element => $font) {
			if (!$font) continue;
			list(, $fontfamily) = explode('|', $font, 2);
			$typography['fonts'][$element] = $fontfamily;
		}
		$typography['custom_selector'] = fastblog_get_option('typography/custom_selector');
	?>
	typography = <?php echo json_encode($typography); ?>;
</script>
<?php echo tb_script_minify(ob_get_clean())."\n"; ?>