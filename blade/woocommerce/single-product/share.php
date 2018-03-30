<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$product_socials = blade_grve_option( 'product_social');
if ( is_array( $product_socials ) ) {
	$product_socials = array_filter( $product_socials );
} else {
	$product_socials = '';
}

if ( !empty( $product_socials ) ) {
	global $post;
	$post_id = $post->ID;

	$social_email = blade_grve_option( 'product_social', '', 'email' );
	$social_facebook = blade_grve_option( 'product_social', '', 'facebook' );
	$social_twitter = blade_grve_option( 'product_social', '', 'twitter' );
	$social_linkedin = blade_grve_option( 'product_social', '', 'linkedin' );
	$social_googleplus = blade_grve_option( 'product_social', '', 'google-plus' );
	$social_reddit = blade_grve_option( 'product_social', '', 'reddit' );
	$grve_likes = blade_grve_option( 'product_social', '', 'grve-likes' );
	$grve_permalink = get_permalink();
	$grve_title = get_the_title();
	$grve_email_string = 'mailto:?subject=' . $grve_title . '&body=' . $grve_title . ': ' . $grve_permalink;

	$social_shape_classes = array('grve-text-content grve-text-hover-primary-1');

	$social_shape_class_string = implode( ' ', $social_shape_classes );

?>

	<div class="grve-product-social grve-border">
		<ul>
			<?php if ( !empty( $social_email  ) ) { ?>
			<li class="grve-zoomIn"><a href="<?php echo esc_url( $grve_email_string ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> grve-social-share-email"><i class="fa fa-envelope"></i></a></li>
			<?php } ?>
			<?php if ( !empty( $social_facebook ) ) { ?>
			<li class="grve-zoomIn"><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> grve-social-share-facebook"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
			<?php if ( !empty( $social_twitter ) ) { ?>
			<li class="grve-zoomIn"><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> grve-social-share-twitter"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>
			<?php if ( !empty( $social_linkedin ) ) { ?>
			<li class="grve-zoomIn"><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> grve-social-share-linkedin"><i class="fa fa-linkedin"></i></a></li>
			<?php } ?>
			<?php if ( !empty( $social_googleplus ) ) { ?>
			<li class="grve-zoomIn"><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> grve-social-share-googleplus"><i class="fa fa-google-plus"></i></a></li>
			<?php } ?>
			<?php if ( !empty( $social_reddit ) ) { ?>
			<li class="grve-zoomIn"><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> grve-social-share-reddit"><i class="fa fa-reddit"></i></a></li>
			<?php } ?>
			<?php if ( !empty( $grve_likes ) && function_exists( 'blade_grve_likes' ) ) {
				global $post;
				$post_id = $post->ID;
			?>
			<li class="grve-zoomIn"><a href="#" class="<?php echo esc_attr( $social_shape_class_string ); ?> grve-like-counter-link" data-post-id="<?php echo esc_attr( $post_id ); ?>"><i class="fa fa-heart"></i><span class="grve-text-primary-1 grve-like-counter"><?php echo blade_grve_likes( $post_id ); ?></span></a></li>
			<?php } ?>

		</ul>
	</div>
<?php

}

do_action( 'woocommerce_share' ); // Sharing plugins can hook into here

//Omit closing PHP tag to avoid accidental whitespace output errors.
