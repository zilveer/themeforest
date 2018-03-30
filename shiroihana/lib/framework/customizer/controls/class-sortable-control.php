<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Sortable Control
 *
 * This class adds a sortable control to WordPress customizer
 *
 * @package   Youxi Themes Customizer Controls
 * @author    Mairel Theafila <maimairel@gmail.com>
 * @copyright Copyright (c) 2014-2016, Mairel Theafila
 */

class Youxi_Customize_Sortable_Control extends WP_Customize_Control {

	public $type = 'youxi_sortable';

	public $togglable = false;

	public function to_json() {
		parent::to_json();
		if( is_array( $this->togglable ) ) {
			$valid_togglables = array_intersect_key( array_flip( $this->togglable ), $this->choices );
			$this->json['togglable'] = ! empty( $valid_togglables );
		} else {
			$this->json['togglable'] = (bool) $this->togglable;
		}
	}

	public function enqueue() {

		parent::enqueue();

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if( ! wp_style_is( 'youxi-sortable-control' ) ) {
			wp_enqueue_style( 'youxi-sortable-control', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/css/sortable-control.css", 
				array(), YOUXI_CUSTOMIZER_VERSION, 'screen'
			);
		}

		if( ! wp_script_is( 'youxi-sortable-control' ) ) {
			wp_enqueue_script( 'youxi-sortable-control', 
				get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/sortable-control{$suffix}.js", 
				array( 'jquery', 'jquery-ui-sortable' ), YOUXI_CUSTOMIZER_VERSION, true
			);
		}
	}

	public function render_content() {

		if ( empty( $this->choices ) )
			return;

		$value = wp_parse_args( (array) $this->value(), array(
			'values' => array_keys( $this->choices ), 
			'order'  => array_keys( $this->choices )
		));

		$sorted_choices = array_merge( array_flip( $value['order'] ), $this->choices );
		$sorted_choices = array_intersect_key( $sorted_choices, $this->choices );

		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
		<ul class="youxi-sortable-container"><?php

			foreach( $sorted_choices as $val => $label ):

			?><li class="youxi-sortable-item" data-value="<?php echo esc_attr( $val ) ?>"><?php

				if( is_array( $this->togglable ) ? in_array( $val, $this->togglable ) : ( (bool) $this->togglable ) ):

				?><div class="youxi-sortable-toggle"><?php

					?><input type="checkbox" <?php checked( in_array( $val, $value['values'] ) ); ?>><?php
					
				?></div><?php

				endif;

				?><h4><?php echo $label ?></h4><?php

			?></li><?php

			endforeach;

		?></ul>
		<?php
	}
}