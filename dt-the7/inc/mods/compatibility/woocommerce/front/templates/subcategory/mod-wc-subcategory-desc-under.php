<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$category = presscore_config()->get( 'subcategory' );
?>
<figure class="woocom-project">
	<div class="woo-buttons-on-img">

		<?php dt_woocommerce_subcategory_thumbnail( $category, 'alignnone' ); ?>

	</div>
	<figcaption class="woocom-list-content">

		<?php dt_woocommerce_template_subcategory_description(); ?>

	</figcaption>
</figure>