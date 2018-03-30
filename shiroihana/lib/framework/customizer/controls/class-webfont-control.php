<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize WebFont Control
 *
 * This class adds a WebFont control currently supporting Google Font and Typekit
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 */

abstract class Youxi_Customize_WebFont_Provider {

	public $control = null;

	public $id;

	public function __construct( $control, $id, $args = array() ) {
		$keys = array_keys( get_object_vars( $this ) );
		foreach( $keys as $key ) {
			if ( isset( $args[ $key ] ) ) {
				$this->$key = $args[ $key ];
			}
		}

		$this->control = $control;
		$this->id      = $id;
	}

	abstract public function render_content( $value );

	abstract public function label();

	public function js_vars() {}
}

class Youxi_Customize_WebFont_Websafe extends Youxi_Customize_WebFont_Provider {

	public function render_content( $value ) {

		$family_val    = '';
		$variation_val = 'n4';

		$families   = Youxi_Websafe::get_families();
		$variations = Youxi_Websafe::get_variations();

		if( $value = Youxi_FVD::extract( $value ) ) {
			$family_val    = $value['id'];
			$variation_val = $value['fvd'];
		}

		?>
		<div class="youxi-webfont-form-control youxi-webfont-provider-family">
			<label class="customize-control-title"><?php esc_html_e( 'Family', 'youxi' ); ?></label>
			<select>
				<option class="placeholder" selected disabled value=""><?php esc_html_e( 'Select a Font Family', 'youxi' ); ?></option>
				<?php foreach ( $families as $id => $family ): ?>
					<option value="<?php echo esc_attr( $id ) ?>"<?php selected( $id, $family_val ) ?>><?php 
						echo esc_html( $family );
					?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="youxi-webfont-form-control youxi-webfont-provider-variation"<?php if( ! $family_val ) echo ' style="display: none;"' ?>>
			<label class="customize-control-title"><?php esc_html_e( 'Variation', 'youxi' ); ?></label>
			<select>
				<?php foreach( $variations as $id => $variation ): ?>
				<option value="<?php echo esc_attr( $id ) ?>"<?php selected( $id, $variation_val ) ?>><?php 
					echo esc_html( $variation );
				?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php
	}

	public function label() {
		return esc_html__( 'Websafe', 'youxi' );
	}
}

class Youxi_Customize_WebFont_Google extends Youxi_Customize_WebFont_Provider {

	public function render_content( $value ) {

		$family_val = '';
		$variant_val = 'regular';
		$subsets_val = array();

		$variant_options = array();
		$subsets_options = array();

		$google_fonts = Youxi_Google_Font::fetch();
		$value = Youxi_Google_Font::parse_str( $value );

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

		?>
		<div class="youxi-webfont-form-control youxi-webfont-provider-family">
			<label class="customize-control-title"><?php esc_html_e( 'Family', 'youxi' ); ?></label>
			<select>
				<option class="placeholder" selected disabled value=""><?php esc_html_e( 'Select a Font Family', 'youxi' ); ?></option>
				<?php foreach ( $google_fonts as $font ):
					$font_family = preg_replace( '/\s+/', '+', $font['family'] );
				?>
				<option value="<?php echo esc_attr( $font_family ) ?>"<?php selected( $font_family, $family_val ) ?>><?php 
					echo esc_html( $font['family'] );
				?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="youxi-webfont-form-control youxi-webfont-provider-variation"<?php if( ! $family_val ) echo ' style="display: none;"' ?>>
			<label class="customize-control-title"><?php esc_html_e( 'Variant', 'youxi' ); ?></label>
			<select>
				<?php foreach( $variant_options as $font_variant ): ?>
				<option value="<?php echo esc_attr( $font_variant ) ?>"<?php selected( $font_variant, $variant_val ) ?>><?php 
					echo esc_html( $font_variant );
				?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="youxi-webfont-form-control youxi-webfont-provider-subsets"<?php if( ! $family_val ) echo ' style="display: none;"' ?>>
			<label class="customize-control-title"><?php esc_html_e( 'Subsets', 'youxi' ); ?></label>
			<div class="checkboxes">
				<?php foreach( $subsets_options as $subset ): ?>
				<label>
					<input type="checkbox" value="<?php echo esc_attr( $subset ) ?>"<?php checked( true, in_array( $subset, $subsets_val ) ) ?>>
					<?php echo esc_html( $subset ); ?>
					<br>
				</label>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	public function label() {
		return esc_html__( 'Google Font', 'youxi' );
	}

	public function js_vars() {
		return Youxi_Google_Font::fetch();
	}
}

class Youxi_Customize_WebFont_Typekit extends Youxi_Customize_WebFont_Provider {

	public function render_content( $value ) {

		$family_id = '';
		$variation = 'n4';

		$families   = Youxi_Typekit::get_families();
		$variations = array();

		if( $value = Youxi_FVD::extract( $value ) ) {

			$family_id  = $value['id'];
			$variation  = $value['fvd'];
			$variations = Youxi_Typekit::get_family_variations( $family_id, true );
		}

		?>
		<div class="youxi-webfont-form-control youxi-webfont-provider-family">
			<label class="customize-control-title"><?php esc_html_e( 'Family', 'youxi' ); ?></label>
			<select>
				<option class="placeholder" selected disabled value=""><?php esc_html_e( 'Select a Font Family', 'youxi' ); ?></option>
				<?php foreach ( (array) $families as $family ): ?>
				<option value="<?php echo esc_attr( $family['id'] ) ?>"<?php selected( $family['id'], $family_id ) ?>><?php 
					echo esc_html( $family['name'] );
				?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="youxi-webfont-form-control youxi-webfont-provider-variation"<?php if( ! $family_id ) echo ' style="display: none;"' ?>>
			<label class="customize-control-title"><?php esc_html_e( 'Variation', 'youxi' ); ?></label>
			<select>
				<?php foreach( (array) $variations as $fvd => $label ): ?>
				<option value="<?php echo esc_attr( $fvd ) ?>"<?php selected( $fvd, $variation ) ?>><?php 
					echo esc_html( $label );
				?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php
	}

	public function label() {
		return esc_html__( 'Typekit', 'youxi' );
	}

	public function js_vars() {
		return Youxi_Typekit::get_families( true );
	}
}

class Youxi_Customize_WebFont_Control extends WP_Customize_Control {

	private $providers = array();

	public $enable_websafe = true;

	public $enable_google = true;

	public $enable_typekit = true;

	public $type = 'youxi_webfont';

	public function __construct( $manager, $id, $args = array() ) {

		parent::__construct( $manager, $id, $args );

		if( $this->enable_websafe ) {
			$this->providers['websafe'] = new Youxi_Customize_WebFont_Websafe( $this, 'websafe' );
		}
		if( $this->enable_google ) {
			$this->providers['google']  = new Youxi_Customize_WebFont_Google( $this, 'google' );
		}
		if( $this->enable_typekit ) {
			$this->providers['typekit'] = new Youxi_Customize_WebFont_Typekit( $this, 'typekit' );
		}
	}

	public function enqueue() {

		parent::enqueue();

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if( ! wp_style_is( 'youxi-webfont-control' ) ) {
			wp_enqueue_style( 'youxi-webfont-control', 
				get_template_directory_uri() . '/lib/framework/customizer/controls/assets/css/webfont-control.css', 
				array(), YOUXI_CUSTOMIZER_VERSION, 'screen'
			);
		}

		if( ! wp_script_is( 'youxi-webfont-control' ) ) {
			wp_enqueue_script( 'youxi-webfont-control', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/webfont-control{$suffix}.js", 
				array( 'jquery', 'backbone' ), YOUXI_CUSTOMIZER_VERSION, true
			);

			wp_localize_script( 'youxi-webfont-control', '_youxiCustomizeWebFonts', $this->provider_js_vars() );
		}
	}

	public function provider_js_vars() {

		$vars = array();
		foreach( $this->providers as $provider ) {
			$vars[ $provider->id ] = $provider->js_vars();
		}

		return $vars;
	}

	public function render_content() {

		$current_value   = $this->value();
		$active_provider = $value = '';
		$providers_regex = implode( '|', array_keys( $this->providers ) );

		if( ! is_string( $current_value ) ) {
			$current_value = '';
		}

		if( preg_match( '/^(' . $providers_regex . ')\/(.+)$/', $current_value, $matches ) ) {
			$active_provider = $this->providers[ $matches[1] ]->id;
			$value = $matches[2];
		}

		if( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;

		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>

		<div class="youxi-webfont-control">
			<div class="youxi-webfont-control-header">
				<select class="youxi-webfont-control-sources">
					<option value="" <?php selected( $active_provider, '' ) ?>><?php esc_html_e( 'Inherit', 'youxi' ) ?></option>
					<?php foreach( $this->providers as $provider ): ?>
					<option value="<?php echo esc_attr( $provider->id ) ?>" <?php selected( $active_provider, $provider->id ) ?>>
						<?php echo esc_html( $provider->label() ) ?>
					</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="youxi-webfont-control-providers">
				<?php foreach( $this->providers as $provider ):

					$provider_class = array( 'youxi-webfont-provider', 'youxi-webfont-' . $provider->id . '-provider' );
					if( $provider->id != $active_provider ) {
						$provider_class[] = 'youxi-webfont-provider-inactive';
					}
				?>
				<div data-provider-id="<?php echo esc_attr( $provider->id ) ?>" class="<?php echo esc_attr( implode( ' ', $provider_class ) ) ?>">
					<?php $provider->render_content( $provider->id == $active_provider ? $value : '' ); ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
