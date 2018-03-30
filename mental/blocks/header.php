<?php
/**
 * Header template part
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>
<?php
if(is_numeric($background_image_id = get_mental_option('header_background_image')))
	$background_image = wp_get_attachment_url($background_image_id);

if(is_numeric($parallax_image_id = get_mental_option('header_parallax_image')))
	$parallax_image = wp_get_attachment_url($parallax_image_id);
?>

<div id="header"
	style="
	<?php if ( ! empty( $background_image ) ) { echo ' background-image: url(\'' . esc_url($background_image) . '\');'; } ?>
	<?php if ( ! empty( $parallax_image ) ) { echo ' background-image: url(\'' . esc_url($parallax_image) . '\');'; } ?>
	"
	<?php if ( ! empty( $parallax_image ) && get_mental_option('header_parallax_ratio') ) {
		echo ' data-stellar-background-ratio="' . esc_attr(get_mental_option('header_parallax_ratio')) . '" '; } ?>
	<?php if ( ! empty( $parallax_image ) && get_mental_option('header_parallax_offset') ) {
		echo ' data-stellar-vertical-offset="' . esc_attr(get_mental_option('header_parallax_offset')) . '" '; } ?>
	>
	<header>
		<h1><?php echo the_title(); ?></h1>
	</header>
</div>