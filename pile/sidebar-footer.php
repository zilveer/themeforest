<?php
/**
 * The template for the footer sidebar containing the footer widget area.
 * @package Pile
 * @since   Pile 1.0
 */

if ( is_active_sidebar( 'sidebar-footer' ) ):
	$num         = pile_option( 'footer_number_of_columns' );
	$cols_number = ( ! empty( $num ) ) ? $num : 3;

	$column_width = '';
	if ($cols_number == 1) {
		$column_width = pile_option( 'footer_column_width' );
	}
	?>
	<aside class="sidebar sidebar--footer">
		<div class="footer-widget-area <?php echo 'col-' . $cols_number; echo '  ' . $column_width; ?>">
			<aside class="sidebar">
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</aside><!-- .sidebar -->
		</div><!-- .grid__item -->
	</aside><!-- .sidebar.sidebar--footer -->
<?php endif; ?>