<?php
/**
 * Customizer controls
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.3.0
 */

/**
 * HR control for the customizer
 *
 * @since 1.6.0
 */
class WPEX_Customizer_Hr_Control extends WP_Customize_Control {
	public $type = 'hr';
	public function render_content() {
		echo '<hr />';
	}
}

/**
 * Heading control for the customizer
 *
 * @since 1.6.0
 */
class WPEX_Customizer_Heading_Control extends WP_Customize_Control {
	public $type = 'wpex-heading';
	public function render_content() {
		echo '<span class="wpex-customizer-heading">' . esc_html( $this->label ) . '</span>';
	}
}

/**
 * Textarea control for the customizer
 *
 * @since 1.6.0
 */
class WPEX_Customizer_Textarea_Control extends WP_Customize_Control {
	public $type = 'wpex_textareaa';
	public $rows = '10';
	public function render_content() { ?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
			<textarea rows="<?php echo intval( $this->rows ); ?>" <?php $this->link(); ?> style="width:100%;"><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	<?php }
}

/**
 * Dropdown pages with Description
 *
 * @since 1.6.0
 */
class WPEX_Customizer_Dropdown_Pages extends WP_Customize_Control {
	public $type = 'wpex-dropdown-pages';
	public function render_content() { ?>

		<label class="customize-control-select">
		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		// Description
		if ( ! empty( $this->description ) ) { ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php }
		$dropdown = wp_dropdown_pages(
			array(
				'name'              => '_customize-dropdown-pages-' . $this->id,
				'echo'              => 0,
				'show_option_none'  => '&mdash; '. esc_html__( 'Select', 'total' ) .' &mdash;',
				'option_none_value' => '0',
				'selected'          => $this->value(),
			)
		);
		// Hackily add in the data link parameter.
		echo str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
	}
}

/**
 * Multiple check customize control class.
 *
 * @since 2.0.0
 */
class WPEX_Customize_Multicheck_Control extends WP_Customize_Control {
	public $description = '';
	public $subtitle = '';
	private static $firstLoad = true;
	// Since theme_mod cannot handle multichecks, we will do it with some JS
	public function render_content() {
		// the saved value is an array. convert it to csv
		if ( is_array( $this->value() ) ) {
			$savedValueCSV = implode( ',', $this->value() );
			$values = $this->value();
		} else {
			$savedValueCSV = $this->value();
			$values = explode( ',', $this->value() );
		}
		if ( self::$firstLoad ) {
			self::$firstLoad = false;
			?>
			<script>
			jQuery(document).ready( function($) {
				"use strict";
				$( 'input.tf-multicheck' ).change( function(event) {
					event.preventDefault();
					var csv = '';
					$( this ).parents( 'li:eq(0)' ).find( 'input[type=checkbox]' ).each( function() {
						if ($( this ).is( ':checked' )) {
							csv += $( this ).attr( 'value' ) + ',';
						}
					} );
					csv = csv.replace(/,+$/, "");
					$( this ).parents( 'li:eq(0)' ).find( 'input[type=hidden]' ).val(csv)
					// we need to trigger the field afterwards to enable the save button
					.trigger( 'change' );
					return true;
				} );
			} );
			</script>
			<?php
		} ?>
		<label class='tf-multicheck-container'>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
				<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
					<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
				<?php } ?>
			</span>
			<?php if ( '' != $this->subtitle ) : ?>
				<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
			<?php endif; ?>
			<?php
			foreach ( $this->choices as $value => $label ) {
				printf( '<label for="%s"><input class="tf-multicheck" id="%s" type="checkbox" value="%s" %s/> %s</label><br>',
					$this->id . $value,
					$this->id . $value,
					esc_attr( $value ),
					checked( in_array( $value, $values ), true, false ),
					$label
				);
			}
			?>
			<input type="hidden" value="<?php echo esc_attr( $savedValueCSV ); ?>" <?php $this->link(); ?> />
		</label>
		<?php
	}
}

/**
 * Multiple select customize control class.
 *
 * @since 1.6.0
 */
class WPEX_Customize_Control_Multiple_Select extends WP_Customize_Control {
	/**
	 * The type of customize control being rendered.
	 */
	public $type = 'multiple-select';

	/**
	 * Displays the multiple select on the customize screen.
	 */
	public function render_content() {
	if ( empty( $this->choices ) ) {
		return;
	}
	$this_val = $this->value(); ?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( '' != $this->description ) { ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php } ?>
			<select <?php $this->link(); ?> multiple="multiple" style="height:120px;">
				<?php foreach ( $this->choices as $value => $label ) {
					$selected = ( in_array( $value, $this_val ) ) ? selected( 1, 1, false ) : '';
					echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
				} ?>
			</select>
		</label>
	<?php }
}

/**
 * Sorter Control
 *
 * @since 1.6.0
 */
class WPEX_Customize_Control_Sorter extends WP_Customize_Control {

	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
	}

	public function render_content() { ?>
		<div class="wpex-sortable">
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( '' != $this->description ) { ?>
					<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php } ?>
			</label>
			<?php
			// Get values and choices
			$choices = $this->choices;
			$values  = $this->value();
			// Turn values into array
			if ( ! is_array( $values ) ) {
				$values = explode( ',', $values );
			} ?>
			<ul id="<?php echo $this->id; ?>_sortable">
				<?php
				// Loop through values
				foreach ( $values as $val ) :
					// Get label
					$label = isset( $choices[$val] ) ? $choices[$val] : '';
					if ( $label ) : ?>
						<li data-value="<?php echo esc_attr( $val ); ?>" class="wpex-sortable-li">
							<?php echo esc_html( $label ); ?>
							<span class="wpex-hide-sortee fa fa-toggle-on"></span>
						</li>
					<?php
					// End if label check
					endif;
					// Remove item from choices array - so only disabled items are left
					unset( $choices[$val] );
				// End val loop
				endforeach;
				// Loop through disabled items (disabled items have been removed alredy from choices)
				foreach ( $choices as $val => $label ) { ?>
					<li data-value="<?php echo esc_attr( $val ); ?>" class="wpex-sortable-li wpex-hide">
						<?php echo esc_html( $label ); ?>
						<span class="wpex-hide-sortee fa fa-toggle-on fa-rotate-180"></span>
					</li>
				<?php } ?>
			</ul>
		</div><!-- .wpex-sortable -->
		<div class="clear:both"></div>
		<?php
		// Return values as comma seperated string for input
		if ( is_array( $values ) ) {
			$values = array_keys( $values );
			$values = implode( ',', $values );
		} ?>
		<input id="<?php echo $this->id; ?>_input" type='hidden' name="<?php echo $this->id; ?>" value="<?php echo esc_attr( $values ); ?>" <?php echo $this->get_link(); ?> />
		<script>
		jQuery(document).ready( function($) {
			"use strict";
			// Define variables
			var sortableUl = $( '#<?php echo $this->id; ?>_sortable' );

			// Create sortable
			sortableUl.sortable()
			sortableUl.disableSelection();

			// Update values on sortstop
			sortableUl.on( "sortstop", function( event, ui ) {
				wpexUpdateSortableVal();
			} );

			// Toggle classes
			sortableUl.find( 'li' ).each( function() {
				$( this ).find( '.wpex-hide-sortee' ).click( function() {
					$( this ).toggleClass( 'fa-rotate-180' ).parents( 'li:eq(0)' ).toggleClass( 'wpex-hide' );
				} );
			})
			// Update Sortable when hidding/showing items
			$( '#<?php echo $this->id; ?>_sortable span.wpex-hide-sortee' ).click( function() {
				wpexUpdateSortableVal();
			} );
			// Used to update the sortable input value
			function wpexUpdateSortableVal() {
				var values = [];
				sortableUl.find( 'li' ).each( function() {
					if ( ! $( this ).hasClass( 'wpex-hide' ) ) {
						values.push( $( this ).attr( 'data-value' ) );
					}
				} );
				$( '#<?php echo $this->id; ?>_input' ).val(values).trigger( 'change' );
			}
		} );
		</script>
		<?php
	}
}

/**
 * Google Fonts Control
 *
 * @since 1.6.0
 */
class WPEX_Fonts_Dropdown_Custom_Control extends WP_Customize_Control {
	public function render_content() {
	$this_val = $this->value(); ?>
	<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?> style="width:100%;">
			<option value="" <?php if ( ! $this_val ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Default', 'total' ); ?></option>
			<?php
			// Add custom fonts from child themes
			if ( function_exists( 'wpex_add_custom_fonts' ) ) {
				$fonts = wpex_add_custom_fonts();
				if ( $fonts && is_array( $fonts ) ) { ?>
					<optgroup label="<?php esc_html_e( 'Custom Fonts', 'total' ); ?>">
						<?php foreach ( $fonts as $font ) { ?>
							<option value="<?php echo $font; ?>" <?php if ( $font == $this_val ) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
						<?php } ?>
					</optgroup>
				<?php }
			} ?>
			<?php
			// Get Standard font options
			if ( $std_fonts = wpex_standard_fonts() ) { ?>
				<optgroup label="<?php esc_html_e( 'Standard Fonts', 'total' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $std_fonts as $font ) { ?>
						<option value="<?php echo $font; ?>" <?php selected( $font, $this_val ); ?>><?php echo $font; ?></option>
					<?php } ?>
				</optgroup>
			<?php } ?>
			<?php
			// Google font options
			if ( $google_fonts = wpex_google_fonts_array( $google_fonts ) ) { ?>
				<optgroup label="<?php esc_html_e( 'Google Fonts', 'total' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $google_fonts as $font ) { ?>
						<option value="<?php echo $font; ?>" <?php selected( $font, $this_val ); ?>><?php echo $font; ?></option>
					<?php } ?>
				</optgroup>
			<?php } ?>
		</select>
	</label>
	<?php }
}