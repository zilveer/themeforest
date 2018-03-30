<?php 
/**
 * Theme Header
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
global $sd_data;

if ( is_page() || is_single()  ) {
	$transp_header   = rwmb_meta( 'sd_transparent_header', 'type=checkbox');
}
$header_email    = isset( $sd_data['sd_header_email'] ) ? sanitize_email( $sd_data['sd_header_email'] ) : NULL;
$header_phone    = isset( $sd_data['sd_header_phone'] ) ? $sd_data['sd_header_phone'] : NULL;
$header_btn      = isset( $sd_data['sd_extra_button'] ) ? esc_url( $sd_data['sd_extra_button'] ) : NULL;
$header_btn_text = isset( $sd_data['sd_extra_button_text'] ) ? $sd_data['sd_extra_button_text'] : NULL;
$logo            = esc_url( $sd_data['sd_logo_upload']['url'] );
$header_style    = $sd_data['sd_header_style'];
$boxed           = $sd_data['sd_boxed'];
$top_bar         = $sd_data['sd_top_bar'];
$sticky          = $sd_data['sd_sticky_menu'];

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/framework/js/html5.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/framework/js/respond.min.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>
<body <?php body_class( 'sd-theme' ); ?>>
<div class="sd-wrapper">
<?php if ( $boxed == '2' ) : ?>
	<div class="sd-boxed">
<?php endif; ?>
<header id="sd-header" class="clearfix <?php if ( is_page() && $transp_header == '1' ) { echo 'sd-transparent-bg'; } ?>">

	<?php if ( $top_bar == '1' ) { get_template_part( 'framework/inc/header-top-bar' ); } ?>
	
	<div class="container sd-logo-menu">
		<div class="sd-logo-menu-content">
			<div class="sd-logo">
				<?php if ( ! empty( $logo ) ) : ?>
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <img src="<?php echo $logo; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" /></a>
				<?php else : ?>
					<a name="top" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <?php echo get_bloginfo( 'name' );	?> </a>
				<?php endif; ?>
			</div>
			<!-- sd-logo -->
			
			<?php if ( $header_style == '1' ) : ?>
				<div id="sd-sticky-wrapper" class="sd-header-style1 <?php if ( $sticky == '1' ) { echo 'sd-sticky-header sd-opacity-trans'; } ?>">
					<?php if ( $sticky == '1' ) { echo '<div class="container">'; } ?>
					<?php get_template_part( 'framework/inc/main-menu' ); ?>
					<?php if ( $sticky == '1' ) { echo '</div>'; } ?>
				</div>
			<?php else : ?>
				<?php if ( ! empty( $header_email ) || ! empty( $header_phone ) || ! empty( $header_btn ) ) : ?>
					<div class="sd-header-extra">
						<?php if ( ! empty( $header_email ) ) : ?>
							<div class="sd-header-extra-email clearfix">
								<i class="fa fa-envelope-o"></i>
								<span>
									<span><?php _e( 'EMAIL US AT', 'sd-framework' ); ?></span>
									<a href="mailto:<?php echo antispambot( $header_email, 1 ); ?>" title="<?php _e( 'Email Us', 'sd-framework' ); ?>"><?php echo antispambot( $header_email ); ?></a>
								</span>
							</div>
							<!-- sd-header-extra-email -->
						<?php endif; ?>
						<?php if ( ! empty( $header_phone ) ) : ?>
							<div class="sd-header-extra-phone clearfix">
								<i class="fa fa-phone"></i>
								<span class="sd-header-extra-desc">
									<span><?php _e( 'CALL US NOW', 'sd-framework' ); ?></span>
									<span class="sd-header-ph-number"><?php echo $header_phone; ?></span>
								</span>
							</div>
							<!-- sd-header-extra-phone -->
						<?php endif; ?>
						<?php if ( ! empty( $header_btn ) ) : ?>
							<a class="sd-extra-button" href="<?php echo $header_btn; ?>" title="<?php echo esc_attr( $header_btn_text ); ?>"><?php echo $header_btn_text; ?></a>
						<?php endif; ?>
					</div>
					<!-- sd-header-extra -->
				<?php endif; ?>
			
			<?php endif; ?>

		</div>
		<!-- sd-logo-menu-content -->
	</div>
	<!-- sd-logo-menu -->
	<?php if ( $header_style == '3' ) : ?>
	<div id="sd-sticky-wrapper" class="sd-header-style3 <?php if ( $sticky == '1' ) { echo 'sd-sticky-header sd-opacity-trans'; } ?>">
		<div id="mega-menu-wrap-main-header-menu" class="sd-header-style3 <?php if ( $sticky == '1' ) { echo 'sd-sticky-header sd-opacity-trans'; } ?>">
			<div class="container">
				<?php get_template_part( 'framework/inc/main-menu' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
</header>
<!-- #sd-header -->

<?php
	if ( ! is_singular( array( 'post', 'download', 'events', 'staff' ) ) ) {
		get_template_part( 'framework/inc/page-top' );
	}
?>