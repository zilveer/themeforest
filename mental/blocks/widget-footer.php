<?php
/**
 * Footer with widgets
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>

<div class="footer widget-footer">
	<footer>

		<div class="container">
			<div class="row">
				<?php
				$cols_count  = get_mental_option( 'footer_columns' );
				$col_classes = 'col-lg-' . ( 12 / $cols_count );
				if ( $cols_count > 1 ) {
					$col_classes .= ' col-md-6';
				}
				?>

				<div class="<?php echo esc_attr($col_classes); ?>">
					<?php if ( function_exists( 'dynamic_sidebar' ) ) dynamic_sidebar( 'footer-area-1' ) ?>
				</div>

				<?php if ( $cols_count > 1 ): ?>
					<div class="<?php echo esc_attr($col_classes); ?>">
						<?php if ( function_exists( 'dynamic_sidebar' ) ) dynamic_sidebar( 'footer-area-2' ) ?>
					</div>
				<?php endif ?>

				<?php if ( $cols_count > 2 ): ?>
					<div class="<?php echo esc_attr($col_classes); ?>">
						<?php if ( function_exists( 'dynamic_sidebar' ) ) dynamic_sidebar( 'footer-area-3' ) ?>
					</div>
				<?php endif ?>

				<?php if ( $cols_count > 3 ): ?>
					<div class="<?php echo esc_attr($col_classes); ?>">
						<?php if ( function_exists( 'dynamic_sidebar' ) ) dynamic_sidebar( 'footer-area-4' ) ?>
					</div>
				<?php endif ?>

			</div>
		</div>

		<?php if ( get_mental_option( 'footer_show_copyright' ) ): ?>
			<div class="ft-copyright">
				<div class="container">
					<?php get_template_part( 'blocks/social-links' ) ?>
					<p><?php echo stripslashes(get_mental_option( 'footer_copyright_text' )) ?></p>
				</div>
			</div>
		<?php endif ?>

	</footer>
</div>