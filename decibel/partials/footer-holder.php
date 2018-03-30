<?php
/**
 * Footer Holder
 */
$font_color = wolf_get_theme_option( 'footer_holder_bg_font_color' );
$parallax_class = ( wolf_get_theme_option( 'footer_holder_bg_parallax' ) ) ? ' section-parallax' : '';
$content = wolf_format_custom_content_output( stripslashes( wolf_get_theme_option( 'footer_holder_content' ) ) );
$class = "wolf-row content-$font_color-font wolf-row-standard-width";
$class .= $parallax_class;
?>
<section class="footer-holder <?php echo $class; ?>">
	<div class="footer-holder-overlay"></div>
	<div class="wolf-row-inner">
		<div class="wrap">
			<?php echo $content; ?>
		</div>
	</div>
</section>