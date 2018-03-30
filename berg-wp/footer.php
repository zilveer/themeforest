<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package berg-wp
 */
?>


<?php include(THEME_INCLUDES.'/navigation/nav-fixed-bar.php'); ?>



	<div class="berg-overlay-background"></div>
</div>
<div class="berg-overlay"></div>


<?php
if (YSettings::g('theme_google_analytics')) {
	echo html_entity_decode(html_entity_decode(YSettings::g('theme_google_analytics')));
}
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
var pageId = '<?php echo get_the_id(); ?>';
</script>
<?php wp_footer(); ?>
</body>
</html>