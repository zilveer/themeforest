<?php if( $num_footer_widgets = Youxi()->option->get( 'footer_widget_areas' ) ):

	ob_start();

	$len = min( 4, $num_footer_widgets );
	$column_width = absint( 12 / $len );

	for( $i = 0; $i < $len; $i++ ):

		if( is_active_sidebar( 'footer_widget_area_' . ( $i + 1 ) ) ) : ?>

			<div class="col-md-<?php echo esc_attr( $column_width ) ?>">
				<?php dynamic_sidebar( 'footer_widget_area_' . ( $i + 1 ) ); ?>
			</div>

		<?php endif;

	endfor;

	if( $footer_widgets = ob_get_clean() ) : ?>

	<div class="footer-widgets">

		<div class="container">

			<div class="row">

				<?php echo $footer_widgets; ?>

			</div>

		</div>

	</div>

	<?php endif; ?>

<?php endif; ?>