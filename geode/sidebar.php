<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */
?>

<?php
	global $post;
	$display = false;
	$align = apply_filters('geode_sidebar_position', get_option('pix_style_main_sidebar_position')) == 'right'  ? 'right' : 'left';

	ob_start();
	dynamic_sidebar( strtolower(apply_filters('geode_primary_sidebar','geode_default_sidebar')));
	$sidebar = ob_get_clean();
?>

<?php
if ( ($post && get_post_type()=='portfolio' && get_post_meta( $post->ID, 'pix_sidebar_content', true )=='on') || $sidebar!=='' ) {
	$display = true;
}

if ( $display ) {
?>
<aside id="secondary" class="widget-area align<?php echo $align; ?> column" role="complementary">
	<?php
	if ( $post && get_post_type()=='portfolio' && get_post_meta( $post->ID, 'pix_sidebar_content', true )=='on' ) {
		the_content();
	} else {
		dynamic_sidebar( strtolower(apply_filters('geode_primary_sidebar','geode_default_sidebar')) );
	}
	?>
</aside><!-- aside#secondary -->
<?php } ?>
