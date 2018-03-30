<?php

/**
 * WooCommerce customer importer - if needed
 * @author alex
 */
class ctWooCommerceImporter {
	public static function addRecommendation( $html ) {
		if ( current_theme_supports( 'woocommerce' ) ) {
			//we have configs
			if ( ! class_exists( 'WooCommerce' ) ) {
				$html = $html != '' ? $html : '';
				$html .= '<p class="recommended">This theme comes with custom WooCommerce Demo Content. Please <strong>install and activate</strong> WooCommerce Shop, if you are interested in using WooCommerce Shop, otherwise please discard this message.</strong></p>';
			}
		}

		return $html;
	}
} 