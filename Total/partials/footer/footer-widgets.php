<?php
/**
 * Footer bottom content
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get footer widgets columns
$columns    = wpex_get_mod( 'footer_widgets_columns', '4' );
$grid_class = wpex_grid_class( $columns );
$gap        = wpex_get_mod( 'footer_widgets_gap', '30' );

// Classes
$wrap_classes = array( 'clr' );
if ( '1' == $columns ) {
	$wrap_classes[] = 'single-col-footer';
} 
if ( $gap ) {
	$wrap_classes[] = 'gap-'. $gap;
}
$wrap_classes = implode( ' ', $wrap_classes );
$wrap_classes = apply_filters( 'wpex_footer_widget_row_classes', $wrap_classes ); ?>

<div id="footer-widgets" class="wpex-row <?php echo esc_attr( $wrap_classes ); ?>">

	<?php
	// Footer box 1 ?>
	<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-1">
		<?php dynamic_sidebar( 'footer_one' ); ?>
	</div><!-- .footer-one-box -->

	<?php
	// Footer box 2
	if ( $columns > '1' ) : ?>
		<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-2">
			<?php dynamic_sidebar( 'footer_two' ); ?>
		</div><!-- .footer-one-box -->
	<?php endif; ?>
	
	<?php
	// Footer box 3
	if ( $columns > '2' ) : ?>
		<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-3 ">
			<?php dynamic_sidebar( 'footer_three' ); ?>
		</div><!-- .footer-one-box -->
	<?php endif; ?>

	<?php
	// Footer box 4
	if ( $columns > '3' ) : ?>
		<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-4">
			<?php dynamic_sidebar( 'footer_four' ); ?>
		</div><!-- .footer-box -->
	<?php endif; ?>

	<?php
	// Footer box 5
	if ( $columns > '4' ) : ?>
		<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-4">
			<?php dynamic_sidebar( 'footer_five' ); ?>
		</div><!-- .footer-box -->
	<?php endif; ?>

</div><!-- #footer-widgets -->