<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Multicheck Control
 *
 * This class adds a multiple select control to WordPress customizer
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 */

class Youxi_Customize_Multicheck_Control extends WP_Customize_Control {

	public $type = 'youxi_multicheck';

	public function enqueue() {

		parent::enqueue();

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if( ! wp_script_is( 'youxi-multicheck-control' ) ) {
			wp_enqueue_script( 'youxi-multicheck-control', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/multicheck-control{$suffix}.js", 
				array( 'jquery' ), YOUXI_CUSTOMIZER_VERSION, true
			);
		}
	}

	public function render_content() {
		if ( empty( $this->choices ) )
			return;
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<select multiple <?php $this->link(); ?>>
			<?php foreach ( $this->choices as $value => $label ): 
				echo '<option value="' . esc_attr( $value ) . '"' . selected( in_array( $value, (array) $this->value() ), true, false ) . '>' . $label . '</option>';
			endforeach; ?>
		</select>
		<div class="youxi-multicheck-checkboxes" style="display: none;">
			<?php foreach( $this->choices as $value => $label ):
			?>
			<label>
				<input type="checkbox" <?php checked( in_array( $value, (array) $this->value() ), true ); ?>>
				<?php echo $label; ?>
				<br>
			</label>
			<?php endforeach; ?>
		</div>
		<?php
	}
}