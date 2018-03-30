<?php /** @var $shortcodes [] ctShortcode */
$screen = get_current_screen(); $screen = (object)$screen;
?>
<?php /** @var $shortcode ctShortcode */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>"/>
	<script type="text/javascript">
		var ajaxurl = "<?php echo admin_url('admin-ajax.php', 'relative')?>";
	</script>
	<?php
	//do_action('admin_enqueue_scripts');
	do_action('admin_print_styles');
	do_action('admin_print_scripts');
	do_action('admin_head');
	?>
	<script type="text/javascript">
		function updateIframeSize(x, y) {
			if (x != '') {
				jQuery('#' + x).height(y + 'px');
			}
		}
	</script>
	<style>
		#formWrapper {
			height: 90%;
			margin-bottom: 40px;
			overflow: auto;
		}
	</style>

</head>
<body <?php body_class('no-js wp-core-ui') ?>>

<div id="theme-dialog">
	<div id="formWrapper">
		<?php if (isset($contentPre)): ?>
			<?php echo $contentPre ?>
		<?php endif; ?>
		<?php if (isset($decorator)): ?>
			<?php echo $decorator ?>
		<?php endif; ?>
		<?php if (isset($contentPost)): ?>
			<?php echo $contentPost ?>
		<?php endif; ?>
	</div>
	<br>
	<br>
</div>
<div id="theme-dialog-preview">
</div>
<div id="theme-dialog-footer">
	<div class="inner">
		<input type="button" id="theme-button-cancel" class="button" name="cancel" value="Cancel" accesskey="Ca"/>
		<input type="button" id="theme-button-insert" class="button-primary" name="insert" value="Insert" accesskey="I"/>
		<?php if (!$shortcode->getParentShortcodeName()): ?>
			<input type="button" id="theme-button-preview" class="button" name="preview" value="Preview" accesskey="P"/>
		<?php endif; ?>
	</div>
</div>
<?php do_action('admin_print_footer_scripts'); ?>
<script type="text/javascript">
	<?php if (isset($customJs)): ?>
	<?php echo $customJs ?>
	<?php endif;?>

	<?php if (!isset($js) || $js): ?>
	//<![CDATA[
	if (typeof wpOnload == 'function') {
		wpOnload();
	}
	(function ($) {
		$(document).ready(function ($) {
			dialog.init({
				shortcode: '<?php echo $child ? esc_html($child->getShortcodeName()) : esc_html($shortcode->getShortcodeName()) ?>',
				type: '<?php echo $child ? $child->getShortcodeType() : $shortcode->getShortcodeType()?>', parent: '<?php echo $child ? $shortcode->getShortcodeName() : ''?>'
			});
		});
	})(jQuery);//]]>
	<?php endif;?>
</script>
</body>
</html>