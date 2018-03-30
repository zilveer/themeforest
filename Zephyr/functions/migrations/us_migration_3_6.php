<?php

class us_migration_3_6 extends US_Migration_Translator {

	// Options
	public function translate_theme_options( &$options ) {
		$changed = FALSE;

		if ( isset( $options['shop_listing_style'] ) ) {
			if ( $options['shop_listing_style'] == 1 ) {
				$options['shop_listing_style'] = 'standard';
				$changed = TRUE;
			} elseif ( $options['shop_listing_style'] == 2 ) {
				$options['shop_listing_style'] = 'modern';
				$changed = TRUE;
			}
		}

		return $changed;
	}
}
