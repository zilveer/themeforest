<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

	global $theme_version;
?>

	<?php if( ! defined("LAB_FOOTERLESS")) get_template_part('tpls/footer'); ?>

	<?php wp_footer(); ?>
	
	<!-- <?php echo 'ET: ', microtime( true ) - TS, 's ', $theme_version, ( is_child_theme() ? 'ch' : '' ); ?> -->

</body>
</html>
