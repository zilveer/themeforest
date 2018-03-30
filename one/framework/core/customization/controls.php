<?php

/**
 * Divider customizer control.
 *
 * @see WP_Customize_Control
 */
class THB_Divider_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'divider';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		?>

		<div class="thb-divider"></div>
		<?php if( !empty($this->label ) ) : ?>
			<span class="thb-section-label"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>
		<?php
	}
}

/**
 * Font family customizer control.
 *
 * @see WP_Customize_Control
 */
class THB_FontFamily_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'font-family';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		$thb_theme = thb_theme();
		$fonts = thb_get_fonts();

		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?> class="font-family">
				<?php foreach( $fonts as $style => $families ) : ?>
					<optgroup label="<?php echo $style; ?>">
						<?php foreach( $families as $family => $font ) : ?>
							<?php if( is_array($font) ) : ?>
								<option value="<?php echo $family; ?>"><?php echo $font['family']; ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</optgroup>
				<?php endforeach; ?>
			</select>
		</label>
		<?php
	}
}

class THB_TextVariant_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'variant';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?> class="text-variant" data-preselect="<?php echo $this->value(); ?>">
			</select>
		</label>
		<?php
	}
}

/**
 * Font size customizer control.
 *
 * @see WP_Customize_Control
 */
class THB_FontSize_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'font-size';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" min="0" step="1" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
		</label>
		<?php
	}
}

/**
 * Font line height customizer control.
 *
 * @see WP_Customize_Control
 */
class THB_FontLineHeight_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'font-line-height';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" min="0" step="0.01" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
		</label>
		<?php
	}
}

/**
 * Font letter spacing customizer control.
 *
 * @see WP_Customize_Control
 */
class THB_FontLetterSpacing_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'font-letter-spacing';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" step="1" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
		</label>
		<?php
	}
}

/**
 * Font weight customizer control.
 *
 * @see WP_Customize_Control
 */
class THB_FontWeight_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'font-weight';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

			<select <?php $this->link(); ?>>
				<?php

				$weights = array(
					'normal' => __('Normal', 'thb_text_domain'),
					'bold' => __('Bold', 'thb_text_domain'),
					'100' => __('Light', 'thb_text_domain')
				);

				foreach ( $weights as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
				?>
			</select>
		</label>
		<?php
	}
}

/**
 * Font case customizer control.
 *
 * @see WP_Customize_Control
 */
class THB_FontCase_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'font-case';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

			<select <?php $this->link(); ?>>
				<?php

				$cases = array(
					'none' => __( 'Normal', 'thb_text_domain' ),
					'uppercase' => __( 'Uppercase', 'thb_text_domain' ),
					'lowercase' => __( 'Lowercase', 'thb_text_domain' ),
					'capitalize' => __( 'Capitalize', 'thb_text_domain' )
				);

				foreach ( $cases as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
				?>
			</select>
		</label>
		<?php
	}
}

/**
 * Font style customizer control.
 *
 * @see WP_Customize_Control
 */
class THB_FontStyle_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'font-style';

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?>>
				<?php

				$fonts = array(
					'normal' => __('Normal', 'thb_text_domain'),
					'italic' => __('Italic', 'thb_text_domain')
				);

				foreach ( $fonts as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
				?>
			</select>
		</label>
		<?php
	}
}

class THB_BackgroundRepeat_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'background-repeat';

	/**
	 * The control options.
	 *
	 * @var array
	 */
	private $options = array();

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		$this->options = array(
			'no-repeat'  => __('No repeat', 'thb_text_domain'),
			'repeat'     => __('Tile', 'thb_text_domain'),
			'repeat-x'   => __('Tile horizontally', 'thb_text_domain'),
			'repeat-y'   => __('Tile vertically', 'thb_text_domain')
		);
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?> class="background-repeat">
				<?php echo thb_get_options_from_array($this->options); ?>
			</select>
		</label>
		<?php
	}
}

class THB_BackgroundPosition_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'background-position';

	/**
	 * The control options.
	 *
	 * @var array
	 */
	private $options = array();

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		$this->options = array(
			'left'       => __('Left', 'thb_text_domain'),
			'center'     => __('Center', 'thb_text_domain'),
			'right'      => __('Right', 'thb_text_domain')
		);
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?> class="background-position">
				<?php echo thb_get_options_from_array($this->options); ?>
			</select>
		</label>
		<?php
	}
}

class THB_BackgroundAttachment_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'background-attachment';

	/**
	 * The control options.
	 *
	 * @var array
	 */
	private $options = array();

	/**
	 * Render the control.
	 *
	 * @return void
	 */
	public function render_content() {
		$this->options = array(
			'scroll'     => __('Scroll', 'thb_text_domain'),
			'fixed'      => __('Fixed', 'thb_text_domain')
		);
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?> class="background-attachment">
				<?php echo thb_get_options_from_array($this->options); ?>
			</select>
		</label>
		<?php
	}
}