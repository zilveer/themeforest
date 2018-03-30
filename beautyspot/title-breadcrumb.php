<?php if ( ! is_front_page() ) : ?>

	<?php if ( class_exists( 'woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) : ?>
		<?php woocommerce_breadcrumb(); ?>
	<?php else : ?>
		<ul class="breadcrumbs">
		<?php if ( function_exists( 'lsvr_breadcrumbs' ) ) {
			lsvr_breadcrumbs();
		} ?>
		</ul>
	<?php endif; ?>

<?php endif; ?>