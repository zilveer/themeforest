<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */
?>

<?php
	$align = apply_filters('geode_sidebar_position', get_option('pix_style_main_sidebar_position')) == 'right'  ? 'left' : 'right';
?>

<aside id="extra-secondary" class="widget-area align<?php echo $align; ?> column" role="complementary">
	<?php dynamic_sidebar( strtolower(apply_filters('geode_secondary_sidebar','geode_default_sidebar_2')) ); ?>
</aside><!-- aside#extra-secondary -->
