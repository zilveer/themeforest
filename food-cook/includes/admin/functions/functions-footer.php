<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/*-----------------------------------------------------------------------------------*/
/* Add customisable footer areas */
/*-----------------------------------------------------------------------------------*/

/**
 * Add customisable footer areas.
 *
 * @package WooFramework
 * @subpackage Actions
 */

if ( ! function_exists( 'woo_footer_left' ) ) {
	function woo_footer_left() {
		global $woo_options;
		$df_options  = get_theme_mod( 'df_options' );
		$footer_left = isset( $df_options['footer_left'] ) ? $df_options['footer_left'] : NULL;
		$left_text	 = isset( $df_options['footer_left_text'] ) ? stripslashes( $df_options['footer_left_text'] ) : NULL;
		$html 		 = '';

		woo_do_atomic( 'woo_footer_left_before' );

		if ( $footer_left == '' ) :
			$html .= '[site_copyright]';
		else :
			$html .= '<p>' . $left_text . '</p>';
		endif;

		$html = apply_filters( 'woo_footer_left', $html );

		echo $html;

		woo_do_atomic( 'woo_footer_left_after' );
	} // End woo_footer_left()
}

if ( ! function_exists( 'woo_footer_right' ) ) {
	function woo_footer_right() {
		global $woo_options;
		$df_options   = get_theme_mod( 'df_options' );
		$footer_right = isset( $df_options['footer_right'] ) ? $df_options['footer_right'] : NULL;
		$right_text	  = isset( $df_options['footer_right_text'] ) ? stripslashes( $df_options['footer_right_text'] ) : NULL;
		$html 		  = '';

		woo_do_atomic( 'woo_footer_right_before' );

		if ( $footer_right == '' ) :
			$html .= '[site_credit]';
		else :
			$html .= '<p>' . $right_text . '</p>';
		endif;

		$html = apply_filters( 'woo_footer_right', $html );

		echo $html;

		woo_do_atomic( 'woo_footer_right_after' );
	} // End woo_footer_right()
}

/*-----------------------------------------------------------------------------------*/
/* Footer Widgetized Areas  */
/*-----------------------------------------------------------------------------------*/

add_action( 'woo_footer_top', 'woo_footer_sidebars', 30 );

if ( ! function_exists( 'woo_footer_sidebars' ) ) {
	function woo_footer_sidebars() {
		$df_options 	 = get_theme_mod( 'df_options' );
		$footer_sidebars = isset( $df_options[ 'footer_sidebars' ] ) ? $df_options[ 'footer_sidebars' ] : '';
		$col_widgets 	 = $footer_sidebars == '' ? 4 : $footer_sidebars;

		if ( $col_widgets != 0 ) : ?>

			<div id="footer-widgets" class="col-full col-<?php echo esc_attr( $col_widgets ); ?>">

				<?php $i = 0; while ( $i < $col_widgets ) : $i++; ?>

					<div class="block footer-widget-<?php echo $i; ?>">

				    	<?php dynamic_sidebar( 'footer-' . $i ); ?>

					</div>

				<?php endwhile; // End WHILE Loop ?>

				<div class="fix"></div>

			</div><!--/#footer-widgets-->

		<?php endif; // End IF Statement

	} // End woo_footer_sidebars()
}