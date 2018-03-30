<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$category = presscore_config()->get( 'subcategory' );
?>
<figure class="woocom-project">

	<?php dt_woocommerce_subcategory_thumbnail( $category ); ?>

	<?php if ( dt_woocommerce_product_show_content() ) : ?>

		<figcaption class="woocom-rollover-content">
			<div class="woo-content-container">

				<?php dt_woocommerce_template_subcategory_description(); ?>

			</div>
		</figcaption>

	<?php endif; ?>

</figure>