<?php
/**
 * The Content of the widget areas
 */

  if ( wolf_is_woocommerce() ) : ?>

	<?php dynamic_sidebar( 'woocommerce' ); ?>

<?php else : ?>

	<?php if ( function_exists( 'wolf_sidebar' ) ) : ?>

		<?php wolf_sidebar(); ?>

	<?php else : ?>

		<?php dynamic_sidebar( 'sidebar-main' ); ?>

	<?php endif; ?>

<?php endif; ?>