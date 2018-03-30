<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Google Font Control
 *
 * This class adds a Google Font control to WordPress customizer
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 */

class Youxi_Customize_Google_Font_Control extends WP_Customize_Control {

	public $type = 'youxi_google_font';

	public function enqueue() {

		parent::enqueue();

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if( ! wp_script_is( 'youxi-google-font-control' ) ) {

			wp_enqueue_script( 'youxi-google-font-control', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/google-font-control{$suffix}.js", 
				array( 'jquery' ), YOUXI_CUSTOMIZER_VERSION, true
			);
			wp_localize_script( 'youxi-google-font-control', '_youxiCustomizeGoogleFonts', Youxi_Google_Font::fetch() );
		}
	}

	public function render_content() {

		$family_val = '';
		$variant_val = '';
		$subsets_val = array();

		$variant_options = array();
		$subsets_options = array();

		$google_fonts = Youxi_Google_Font::fetch();
		$value = Youxi_Google_Font::parse_str( $this->value() );

		if( isset( $value['family'] ) ) {

			$family_val = $value['family'];

			$variant_options = Youxi_Google_Font::get_variants( $family_val );
			$subsets_options = Youxi_Google_Font::get_subsets( $family_val );

			if( isset( $value['variant'] ) ) {
				$variant_val = $value['variant'];
			}
			if( isset( $value['subsets'] ) && is_array( $value['subsets'] ) ) {
				$subsets_val = $value['subsets'];
			}
		}

		?><label>

			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;

			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

			<input type="hidden" class="youxi-google-font-value" <?php $this->link(); ?>>

			<select class="youxi-google-font-control youxi-google-font-family" style="width: 100%">
				<option value=""<?php selected( '', $family_val ) ?>><?php esc_html_e( 'Inherit', 'youxi' ); ?></option>
				<?php foreach ( $google_fonts as $font ):
					$font_family = preg_replace( '/\s+/', '+', $font['family'] );
				?>
				<option value="<?php echo esc_attr( $font_family ) ?>"<?php selected( $font_family, $family_val ) ?>><?php 
					echo esc_html( $font['family'] );
				?></option>
				<?php endforeach; ?>
			</select>

			<select class="youxi-google-font-control youxi-google-font-variant" style="width: 100%;<?php if( ! $family_val ) echo ' display: none;'; ?>"<?php disabled( '', $family_val ) ?>>
				<option value=""><?php esc_html_e( 'Select a Font Variant', 'youxi' ); ?></option>
				<?php foreach( $variant_options as $font_variant ): ?>
				<option value="<?php echo esc_attr( $font_variant ) ?>"<?php selected( $variant_val, $font_variant ) ?>><?php 
					echo esc_html( $font_variant );
				?></option>
				<?php endforeach; ?>
			</select>

			<div class="youxi-google-font-control youxi-google-font-subsets">
				<?php foreach( $subsets_options as $subset ): ?>
				<label>
					<input type="checkbox" value="<?php echo esc_attr( $subset ) ?>"<?php checked( true, in_array( $subset, $subsets_val ) ) ?>>
					<?php echo esc_html( $subset ); ?>
					<br>
				</label>
				<?php endforeach; ?>
			</div>

		</label>
		<?php
	}
}
