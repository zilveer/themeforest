<?php if ( class_exists( 'woocommerce' ) ) {
	get_header();
	if (is_product()) {
		get_template_part( 'woocommerce', 'single' );
	}else {
		get_template_part( 'woocommerce', 'page' );
	}
	get_footer();
}