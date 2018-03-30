<?php

class Redux_Options_Checkbox_Hide_Group {
	function __construct( $field = array(), $value = '', $parent ) {
		$this->field = $field;
		$this->value = $value;
		$this->args  = $parent->args;
	}

	function render() {
		$class  = ( isset( $this->field['class'] ) ) ? $this->field['class'] : '';
		$switch = isset( $this->field['switch'] ) ? $this->field['switch'] : false;

		?>
		<label for="<?php echo $this->field['id']; ?>" <?php if ($switch) echo 'class="switch_wrap"' ?>>
			<input type="checkbox" id="<?php echo $this->field['id']; ?>" name="<?php echo $this->args['opt_name'] ?>[<?php echo $this->field['id']; ?>]" value="1" class="<?php echo $class ?> redux-opts-checkbox-hide-group" <?php checked( $this->value, '1' ) ?> />
			<?php if ( $switch ): ?>
				<div class="switch"><span class="bullet"></span></div>
			<?php endif; ?>
			<?php if ( isset( $this->field['desc'] ) && ! empty( $this->field['desc'] ) ) echo $this->field['desc'] ?>
		</label>
	<?php
	}

	function enqueue() {
		wp_enqueue_script(
			'redux-opts-checkbox-hide-group-js',
				Redux_OPTIONS_URL . 'fields/checkbox_hide_group/field_checkbox_hide_group.js',
			array('jquery'),
			time(),
			true
		);
	}
}
