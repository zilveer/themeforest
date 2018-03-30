<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package omni
 */

$custom_footer_text_color =  cs_get_customize_option( 'footer_text_color' );
if(isset($custom_footer_text_color) && !empty($custom_footer_text_color)){
	$custom_footer_class = 'custom-text-color';
	$custom_footer_menu_class = 'menu-custom-text-color';
}else{
	$custom_footer_class = $custom_footer_menu_class = '';
}
?>

<!-- FOOTER -->
<footer id="site-footer" class="footer <?php echo esc_attr($custom_footer_class);?>">

	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
		<div class="container sidebar-wrapper">
			<div id="sidebar-footer" class="sidebar row" role="complementary">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
			<!-- #sidebar-footer -->
		</div><!--container-->
	<?php endif; ?>

	<div class="footer-bottom">
		<div class="footer-linck <?php echo esc_attr($custom_footer_menu_class);?>">
		<?php crum_footer_menu();  ?>
		</div>

		<div class="media-icon">
			<?php
			$show_socnetworks = cs_get_customize_option( 'footer_show_soc_networks' );

			if ( true === $show_socnetworks ) {
				crum_do_socnetworks();
			} ?>
		</div>
		<div class="copy">
			<span>
				<?php
				$footer_text = cs_get_customize_option( 'footer_copyright_text' );
				if ( isset( $footer_text ) && ! empty( $footer_text ) ) {
					global $allowedtags;
					echo wp_kses( do_shortcode( $footer_text ), $allowedtags );
				}
				?></span>
		</div>
	</div>
	<div class="back-to-top"><i class="fa fa-chevron-up"></i></div>
</footer>
<!-- FOOTER -->

</div>

</div><!-- end wrapper -->

<?php
if ( cs_get_customize_option( 'js-code' ) ) {
	echo '<script type="text/javascript">' . cs_get_customize_option( 'js-code' ) . '</script>';
}
if ( cs_get_customize_option( 'counter-code' ) ) {
	echo cs_get_customize_option( 'counter-code' );
}
?>

</div><!--main-wrapper-->
<?php wp_footer(); ?>
</body>
</html>
