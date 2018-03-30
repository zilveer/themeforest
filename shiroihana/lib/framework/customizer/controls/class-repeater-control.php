<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Repeater Control
 *
 * This class adds a repeater control to WordPress customizer
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 */

class Youxi_Customize_Repeater_Control extends WP_Customize_Control {

	public $type = 'youxi_repeater';

	public $item_fields = array();

	public $item_title = '';

	public function enqueue() {

		parent::enqueue();

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if( ! wp_style_is( 'youxi-repeater-control' ) ) {
			wp_enqueue_style( 'youxi-repeater-control', 
				get_template_directory_uri() . '/lib/framework/customizer/controls/assets/css/repeater-control.css', 
				array(), YOUXI_CUSTOMIZER_VERSION, 'screen'
			);
		}

		if( ! wp_script_is( 'youxi-repeater-control' ) ) {
			wp_enqueue_script( 'serializejson', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/plugins/serializejson/jquery.serializejson{$suffix}.js", 
				array( 'jquery' ), '2.6.1', true
			);
			wp_enqueue_script( 'youxi-repeater-control', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/repeater-control{$suffix}.js", 
				array( 'jquery', 'jquery-ui-sortable', 'serializejson', 'wp-util' ), YOUXI_CUSTOMIZER_VERSION, true
			);
		}
	}

	public function to_json() {

		parent::to_json();
		$this->json['item_title']    = $this->item_title;
		$this->json['item_fields']   = $this->item_fields;
		$this->json['item_key']      = $this->item_key();

		$this->json['item_defaults'] = array();
		foreach( $this->item_fields as $key => $field ) {
			$this->json['item_defaults'][ $key ] = isset( $field['std'] ) ? $field['std'] : '';
		}

	}

	public function item_key() {
		$id_keys = preg_split( '/\[/', str_replace( ']', '', $this->id ) );
		return array_pop( $id_keys );
	}

	public function render_content() {

		if( empty( $this->item_fields ) )
			return;

		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
		<ul class="youxi-repeater-control-list">

			<?php foreach( (array) $this->value() as $index => $value ):

			?><li class="youxi-repeater-control-item" data-index="<?php echo esc_attr( $index ) ?>">
				<div class="youxi-repeater-control-item-top">
					<div class="youxi-repeater-control-item-toggle"></div>
					<div class="youxi-repeater-control-item-title">
						<h4><?php echo $this->item_title ?></h4>
					</div>
				</div>
				<div class="youxi-repeater-control-item-inside">
					<?php $this->render_fields( $value, $index ); ?>
					<a href="#" class="youxi-repeater-control-remove-item"><?php esc_html_e( 'Remove', 'youxi' ) ?></a>
				</div>
			</li>
			<?php endforeach;

		?></ul>
		<button type="button" class="button-secondary youxi-repeater-control-add-item"><?php esc_html_e( 'Add Item', 'youxi' ) ?></button>
		<?php
	}

	protected function render_fields( $values, $index ) {

		foreach( $this->item_fields as $key => $field ) {

			$field = wp_parse_args( $field, array(
				'type' => 'text', 
				'label' => '', 
				'description' => '', 
				'std' => '', 
				'choices' => array()
			));

			$field = (object) $field;
			$field_name = $this->item_key() . '[' . $index . '][' . $key . ']';
			$current_value = isset( $values[ $key ] ) ? $values[ $key ] : $field->std;

			?><p class="youxi-repeater-control-field">

			<?php switch( $field->type ):

				case 'radio':
					if( ! empty( $field->label ) ): ?>
						<span class="customize-control-title"><?php echo esc_html( $field->label ); ?></span>
					<?php endif;
					if( ! empty( $field->description ) ): ?>
						<span class="description customize-control-description"><?php echo $field->description ; ?></span>
					<?php endif;

					foreach( $field->choices as $value => $label ): ?>
					<label>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $field_name ); ?>" <?php checked( $current_value, $value ); ?>>
						<?php echo esc_html( $label ); ?><br/>
					</label>
					<?php
					endforeach;
					break;

				case 'checkbox':
					?><label>
						<input type="hidden" value="0" name="<?php echo esc_attr( $field_name ) ?>">
						<input type="checkbox" value="1" name="<?php echo esc_attr( $field_name ) ?>" <?php checked( $current_value ); ?>>
						<?php echo esc_html( $field->label ); ?>
						<?php if( ! empty( $field->description ) ): ?>
							<span class="description customize-control-description"><?php echo $field->description; ?></span>
						<?php endif; ?>
					</label>
					<?php
					break;

				case 'select':
					?><label>
						<?php if( ! empty( $field->label ) ) : ?>
							<span class="customize-control-title"><?php echo esc_html( $field->label ); ?></span>
						<?php endif;
						if( ! empty( $field->description ) ) : ?>
							<span class="description customize-control-description"><?php echo $field->description; ?></span>
						<?php endif; ?>
						<select class="widefat" name="<?php echo esc_attr( $field_name ); ?>"><?php
							foreach( $field->choices as $value => $label ):
								echo '<option value="' . esc_attr( $value ) . '"' . selected( $current_value, $value, false ) . '>' . $label . '</option>';
							endforeach;
						?></select>
					</label>
					<?php
					break;

				case 'textarea':
					?><label>
						<?php if( ! empty( $field->label ) ) : ?>
							<span class="customize-control-title"><?php echo esc_html( $field->label ); ?></span>
						<?php endif;
						if( ! empty( $field->description ) ) : ?>
							<span class="description customize-control-description"><?php echo $field->description; ?></span>
						<?php endif; ?>
						<textarea class="widefat" name="<?php echo esc_attr( $field_name ); ?>" rows="5"><?php echo esc_textarea( $current_value ); ?></textarea>
					</label>
					<?php
					break;

				case 'text':
				default:
					?><label>
						<?php if( ! empty( $field->label ) ) : ?>
							<span class="customize-control-title"><?php echo esc_html( $field->label ); ?></span>
						<?php endif;
						if( ! empty( $field->description ) ) : ?>
							<span class="description customize-control-description"><?php echo $field->description; ?></span>
						<?php endif; ?>
						<input type="text" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $current_value ); ?>">
					</label>
					<?php
					break;

			endswitch; ?>

			</p><?php
		}
	}

	protected function content_template() {

		?><li class="youxi-repeater-control-item" data-index="{{ data.index }}">
			<div class="youxi-repeater-control-item-top">
				<div class="youxi-repeater-control-item-toggle"></div>
				<div class="youxi-repeater-control-item-title">
					<h4>{{{ data.title_template( data.item_defaults ) }}}</h4>
				</div>
			</div>
			<div class="youxi-repeater-control-item-inside">
				<# _.each( data.item_fields || {}, function( field, name ) { #>
				<p class="youxi-repeater-control-field">
					<# if( 'radio' == field.type ) { #>
						<# if( field.label ) { #>
							<span class="customize-control-title">{{ field.label }}</span>
						<# }
						if( field.description ) { #>
							<span class="description customize-control-description">{{ field.description }}</span>
						<# }
						_.each( field.choices || {}, function( label, value ) { #>
						<label>
							<input type="radio" value="{{ value }}" name="{{ data.item_key }}[{{ data.index }}][{{ name }}]"<# if( value == field.std ) { #> checked<# } #>>
							{{ label }}<br/>
						</label>
						<# }) #>
					<# } else if( 'checkbox' == field.type ) { #>
					<label>
						<input type="hidden" value="0" name="{{ data.item_key }}[{{ data.index }}][{{ name }}]">
						<input type="checkbox" value="1" name="{{ data.item_key }}[{{ data.index }}][{{ name }}]"<# if( !! field.std ) { #> checked<# } #>>
						{{ field.label }}
						<# if( field.description ) { #>
							<span class="description customize-control-description">{{ field.description }}</span>
						<# } #>
					</label>
					<# } else if( 'select' == field.type ) { #>
					<label>
						<# if( field.label ) { #>
							<span class="customize-control-title">{{ field.label }}</span>
						<# }
						if( field.description ) { #>
							<span class="description customize-control-description">{{ field.description }}</span>
						<# } #>
						<select class="widefat" name="{{ data.item_key }}[{{ data.index }}][{{ name }}]">
						<# _.each( field.choices || {}, function( label, value ) { #>
							<option value="{{ value }}"<# if( value == field.std ) { #> selected<# } #>>{{ label }}</option>
						<# }); #>
						</select>
					</label>
					<# } else if( 'textarea' == field.type ) { #>
					<label>
						<# if( field.label ) { #>
							<span class="customize-control-title">{{ field.label }}</span>
						<# }
						if( field.description ) { #>
							<span class="description customize-control-description">{{ field.description }}</span>
						<# } #>
						<textarea class="widefat" name="{{ data.item_key }}[{{ data.index }}][{{ name }}]" rows="5">{{ field.std }}</textarea>
					</label>
					<# } else { #>
					<label>
						<# if( field.label ) { #>
							<span class="customize-control-title">{{ field.label }}</span>
						<# }
						if( field.description ) { #>
							<span class="description customize-control-description">{{ field.description }}</span>
						<# } #>
						<input type="text" name="{{ data.item_key }}[{{ data.index }}][{{ name }}]" value="{{ field.std }}">
					</label>
					<# } #>
				</p>
				<# }) #>
				<a href="#" class="youxi-repeater-control-remove-item"><?php esc_html_e( 'Remove', 'youxi' ) ?></a>
			</div>
		</li><?php
	}

}