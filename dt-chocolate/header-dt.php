<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */

if ( !isset($GLOBALS['dt_is_contacts']) )
	$GLOBALS['dt_is_contacts'] = 0;
if ( !isset($GLOBALS['nostrip']) )
	$GLOBALS['nostrip'] = 0;

$options = get_option(LANGUAGE_ZONE."_theme_options");
?>

<?php if ( isset($options['favicon']) && $options['favicon'] ): ?>
	<?php
	$up_dir = wp_upload_dir();
	$dir = $up_dir['baseurl'].'/dt_uploads/';
	?>
	<link rel="shortcut icon" href="<?php echo $dir.$options['favicon']; ?>" />
<?php endif; ?>

<?php
if ( isset($options['ga_code']) ) {
	echo $options['ga_code'];
}
?>

<?php get_template_part('demo'); ?>
