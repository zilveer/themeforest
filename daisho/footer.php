<?php
/**
 * The template for displaying the footer.
 */
?>
	
	<footer id="footer" class="site-footer" role="contentinfo">
		<div class="inner clearfix">
			<?php 
			$footer_cols = get_option( 'footer_col_countcustom' );
			$footer_columns_classes = null;
			if ( $footer_cols ) {
				$footer_columns_classes = explode( ',', $footer_cols );
			}
			if ( is_array( $footer_columns_classes ) ) {
				for ( $i = 0; $i < count( $footer_columns_classes ); $i++ ) {
					if ( is_active_sidebar( 'flow-footer-' . ( $i + 1 ) ) ) {
						echo '<div class="' . $footer_columns_classes[$i] . '">';
							dynamic_sidebar( 'flow-footer-' . ( $i + 1 ) );
						echo '</div>';
					}
				}
			}
			?>
		</div>
	</footer>
	
	<?php wp_footer(); ?>
</body>
</html>