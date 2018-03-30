<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo esc_attr(get_option('blog_charset')); ?>"/>
	<?php
	do_action('wp_head');
	?>
</head>
<body <?php body_class('preview wp-core-ui') ?>>
<?php

if ($shortcode) {
	$shortcode = strpos($shortcode, '[row') !== false ? $shortcode : '[row][full_column]' . $shortcode . '[/full_column][/row]';
	echo str_replace(array('[raw]', '[/raw]'), '', do_shortcode(stripcslashes($shortcode)));
}
?>
<?php wp_footer(); ?>

<script type="text/javascript">
    function updateParent() {
        parent.updateIframeSize('shortcodeFrame', jQuery('html').height() + 100);
    }
    jQuery(window).load(updateParent).click(updateParent);
</script>
</body>
</html>