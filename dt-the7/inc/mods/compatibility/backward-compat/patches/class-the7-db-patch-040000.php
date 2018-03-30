<?php
/**
 * The7 4.0.0 patch.
 *
 * @package the7
 * @since 4.0.0
 */

if ( ! class_exists( 'The7_DB_Patch_040000', false ) ) {

	class The7_DB_Patch_040000 extends The7_DB_Patch {

		protected function do_apply() {
			$paddings = array(
				'top' => 6,
				'right' => 15,
				'bottom' => 6,
				'left' => 16,
			);
			foreach ( $paddings as $padding => $val ) {
				$this->set_option( "general-filter-padding-{$padding}", $val );
			}

			$margins = array(
				'top' => 0,
				'right' => 5,
				'bottom' => 0,
				'left' => 0,
			);
			foreach ( $margins as $margin => $val ) {
				$this->set_option( "general-filter-margin-{$margin}", $val );
			}

			$microwidgets_icon_style = $this->get_option( 'general-icons_style' );
			$this->remove_option( 'general-icons_style' );
			foreach ( array( 'classic', 'inline', 'split', 'side', 'slide_out', 'overlay' ) as $header_layout ) {
				$this->set_option( "header-{$header_layout}-icons_style", $microwidgets_icon_style );
			}

			$this->remove_option( 'general-fancy_date_size' );
			$this->remove_option( 'general-filter-line_height' );
			$this->set_option( 'general-filter_style', 'minimal' );
			$this->set_option( 'general-page_content_vertical_margins', 50 );
		}

	}

}
