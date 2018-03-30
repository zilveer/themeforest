<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */
?>

<?php if(!is_page_template('home-static.php')) : ?>
	</div>
<?php endif; ?>
<div class="img-load">
<img src="wp-content/themes/dt-chocolate/images/ddmenu_bg.png" alt="">
<img src="wp-content/themes/dt-chocolate/images/ddmenu_b.png" alt="">
</div>
</div>

<?php
if (!defined('GAL_HOME') || is_page_template('home-3d.php') )
   get_template_part( 'bottom' );
?>

<?php get_template_part('demo'); ?>

<script type="text/javascript">
	<?php $options = get_option(LANGUAGE_ZONE."_theme_options"); ?>
	var menu_cl = <?php echo intval($options['menu_cl']); ?>;

	// DT: Here goes trigger to show widgets in mobile layout 
	window.moveWidgets = <?php echo dt_get_theme_options( 'hide_sidebar_in_mobile' ) ? 'false' : 'true'; ?>;
	window.ResizeTurnOff = <?php echo dt_get_theme_options( 'turn_off_responsivness' ) ? 'true' : 'false'; ?>;

	// DO NOT REMOVE!
	// b21add52a799de0d40073fd36f7d1f89
</script>

<?php wp_footer(); ?>
</body>
</html>