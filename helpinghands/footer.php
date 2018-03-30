<?php
/**
 * Theme Footer
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

global $sd_data;

$body_boxed        = $sd_data['sd_boxed'];
$boxed_footer      = $sd_data['sd_boxed_footer'];
$widgetized_footer = $sd_data['sd_widgetized_footer'];
$footer_sidebars   = $sd_data['sd_footer_sidebars'];
$copyright         = $sd_data['sd_copyright'];
$minicart_enabled  = ( isset( $sd_data['sd_minicart_top'] ) ? $sd_data['sd_minicart_top'] : '' );
$minicart_main     = ( isset ( $sd_data['sd_minicart_main'] ) ? $sd_data['sd_minicart_main'] : '' );
$newsletter        = $sd_data['sd_newsletter'];
wp_reset_query();
if ( is_page() ) {
	$newsletter_hide = rwmb_meta( 'sd_hide_newsletter', 'type=checkbox');
} else {
	$newsletter_hide = '';
}

?>
<?php if ( $boxed_footer == 1 ) : ?>
<div class="sd-boxed-footer">
	<div class="container">
<?php endif; ?>
<?php if ( $newsletter == 1 ) {
	if ( $newsletter_hide !== '1' ) {
	get_template_part( 'framework/inc/newsletter' );
	}
} ?>
<footer id="sd-footer" class="<?php if ( $widgetized_footer == '0' ) echo 'sd-padding-none'; ?>">
	<?php 
		if ( $widgetized_footer == '1' ) { 
			if ( $footer_sidebars == '3' ) {
				get_template_part( 'framework/inc/3-sidebars-footer' );
			} else {
				get_template_part( 'framework/inc/4-sidebars-footer' );
			}
		} 
	?>
	<?php if ( $copyright == 1 ) { get_template_part( 'framework/inc/copyright' ); } ?>
</footer>
<!-- footer end -->
<?php if ( $boxed_footer == 1 ) : ?>
	</div>
	<!-- container -->
</div>
<!-- sd-boxed-footer -->
<?php endif; ?>
<?php if ( $body_boxed == 2 ) : ?>
</div>
<!-- sd-boxed -->
<?php endif; ?>
</div>
<!-- sd-wrapper -->
<?php
	if ( sd_is_woo() ) {
		if ( $minicart_enabled == 1 || $minicart_main == 1 ) {
		  get_template_part( 'framework/inc/minicart' );
		}
	}
?>
<?php wp_footer(); ?>
</body>
</html>