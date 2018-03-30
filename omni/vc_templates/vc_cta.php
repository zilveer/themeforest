<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Cta
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->buildTemplate( $atts, $content );
$containerClass = trim( 'vc_cta3-container ' . esc_attr( implode( ' ', $this->getTemplateVariable( 'container-class' ) ) ) );
$cssClass = trim( 'vc_general ' . esc_attr( implode( ' ', $this->getTemplateVariable( 'css-class' ) ) ) );
?>
<section class="<?php echo esc_attr( $containerClass ); ?>">
	<div class="<?php echo esc_attr( $cssClass ); ?>"<?php
	if ( $this->getTemplateVariable( 'inline-css' ) ) {
		echo ' style="' . esc_attr( implode( ' ', $this->getTemplateVariable( 'inline-css' ) ) ) . '"';
	}
	?>>
		<?php echo $this->getTemplateVariable( 'icons-top' ); ?>
		<?php echo $this->getTemplateVariable( 'icons-left' ); ?>
		<div class="vc_cta3_content-container">
			<?php echo $this->getTemplateVariable( 'actions-top' ); ?>
			<?php echo $this->getTemplateVariable( 'actions-left' ); ?>
			<div class="vc_cta3-content">
				<header class="vc_cta3-content-header">
					<?php echo do_shortcode('[vc_custom_heading text="'.$atts['h2'].'" font_container="tag:h2|'.$atts['h2_font_container'].'" google_fonts="'.$atts['h2_google_fonts'].'" use_theme_fonts="'.$atts['h2_use_theme_fonts'].'"]')?>
					<?php echo do_shortcode('[vc_custom_heading text="'.$atts['h4'].'" font_container="tag:h4|'.$atts['h4_font_container'].'" google_fonts="'.$atts['h4_google_fonts'].'" use_theme_fonts="'.$atts['h4_use_theme_fonts'].'"]')?>
				</header>
				<?php echo $this->getTemplateVariable( 'content' ); ?>
			</div>
			<?php echo $this->getTemplateVariable( 'actions-bottom' ); ?>
			<?php echo $this->getTemplateVariable( 'actions-right' ); ?>
		</div>
		<?php echo $this->getTemplateVariable( 'icons-bottom' ); ?>
		<?php echo $this->getTemplateVariable( 'icons-right' ); ?>
	</div>
</section>

