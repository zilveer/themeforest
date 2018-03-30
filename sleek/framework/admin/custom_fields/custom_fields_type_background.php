<?php

if( !class_exists('acf_field') ) {
	return;
}



// check if class already exists
if( !class_exists('acf_field_background') ) :

class acf_field_background extends acf_field {

	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options


	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/

	function __construct() {
		// vars
		$this->name = 'background';
		$this->label = __('Background Control', 'sleek');
		$this->category = 'jquery';
		$this->defaults = array(
			// add default here to merge into your field.
			// This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
			'bg' => ''
		);

  	// settings
		// $this->settings = $settings;


		// do not delete!
		parent::__construct();
	}

	// V 5
	function render_field_settings( $field ) {
		// d($field);
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// key is needed in the field names to correctly save the data
		$key = $field['name'];


		// Create Field Options HTML
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Background Control",'acf'); ?></label>
				<p class="description"><?php _e("Bg Control",'acf'); ?></p>
			</td>
			<td>
				<?php

				do_action('acf/create_field', array(
					'type'		=>	'text',
					'name'		=>	'fields['.$key.'][bg]',
					'value'		=>	$field['bg'],
					'layout'	=>	'horizontal'
				));

				?>
			</td>
		</tr>
		<?php
	}

	// V 4
	function create_options( $field ) {
		// d($field);
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// key is needed in the field names to correctly save the data
		$key = $field['name'];


		// Create Field Options HTML
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Background Control",'acf'); ?></label>
				<p class="description"><?php _e("Bg Control",'acf'); ?></p>
			</td>
			<td>
				<?php

				do_action('acf/create_field', array(
					'type'		=>	'text',
					'name'		=>	'fields['.$key.'][bg]',
					'value'		=>	$field['bg'],
					'layout'	=>	'horizontal'
				));

				?>
			</td>
		</tr>
		<?php
	}

	// V 5
	function render_field( $field ) {
		// d($field);
		?>

		<div data-el="<?php echo $field['id'] ?>">
			<div class="sleek-bg-control-field" style="background:<?php echo $field['value'] ?>;">
				<input type="hidden" class="bg-control" id="<?php echo $field['id'] ?>" name="<?php echo $field['name'] ?>" value="<?php echo $field['value'] ?>"/>
				<a class="button button-primary js-bg-control-btn" data-id="<?php echo $field['id'] ?>">Change Background</a>
			</div>
		</div>

		<?php
	}

	// V 4
	function create_field( $field ) {
		// d($field);
		?>

		<div data-el="<?php echo $field['id'] ?>">
			<div class="sleek-bg-control-field" style="background:<?php echo $field['value'] ?>;">
				<input type="hidden" class="bg-control" id="<?php echo $field['id'] ?>" name="<?php echo $field['name'] ?>" value="<?php echo $field['value'] ?>"/>
				<a class="button button-primary js-bg-control-btn" data-id="<?php echo $field['id'] ?>">Change Background</a>
			</div>
		</div>

		<?php
	}



	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts() {

		// styles
		wp_enqueue_style(array(
			'acf-input-background',
			'wp-color-picker',
		));

	}
}


// create field
new acf_field_background();

// class_exists check
endif;

?>
