<?php
require_once(dirname(__FILE__).'/../text/'.'field_text.php');
require_once(dirname(__FILE__).'/../select/'.'field_select.php');
require_once(dirname(__FILE__).'/../color/'.'field_color.php');

class Redux_Options_typography {

	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since Redux_Options 1.0.0
	 */
	function __construct($field = array(), $value ='', $parent) {
		$this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
	}

	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since Redux_Options 1.0.0
	 */
	function render() {
		
		$class = (isset($this->field['class'])) ? $this->field['class'] : 'regular-text';

		$tmp = @explode(":", $this->value['font']);

		$this->value['font_readable'] = '';
		$this->value['style'] = '';
		//$this->value['weight'] = '';

		if(isset($tmp[0])) {
			$this->value['font_readable'] = trim(str_replace(array("_safe_","+"), " ", $tmp[0]));
		}
		if(isset($tmp[1])) {

			if(strpos("regular", $tmp[1]) !== false) {
				$tmp[1] = str_replace("regular", "", $tmp[1]);

			}else if(strpos("italic", $tmp[1]) !== false) {

				$this->value['style'] = "italic";
				$tmp[1] = str_replace("italic", "", $tmp[1]);
			}

			if(!empty($tmp[1]))
				$this->value['weight'] = $tmp[1];
		}
		?>

		<table id="<?php echo $this->field['id']; ?>-wrap" class="redux-typography-table <?php echo $class; ?>">
		<tr>
			<td colspan="2">
			<?php

				echo '<input type="hidden" id="' . $this->field['id'] . '-font_readable" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][font_readable]" ' . 'value="' . esc_attr($this->value['font_readable']) . '" />';
				echo '<input type="hidden" id="' . $this->field['id'] . '-style" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][style]" ' . 'value="' . esc_attr($this->value['style']) . '" />';

				echo '<input type="text" id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][font]" class="fontselect"  ' . 'value="' . esc_attr(@$this->value['font']) . '" />';
				echo '<input type="button" id="' . $this->field['id'] . '-smaller" class="redux-font-select fs-size button" value="A-" />';
				echo '<input type="button" id="' . $this->field['id'] . '-bigger" class="redux-font-select fs-size button" value="A+" />';
				echo '<br /><textarea id="' . $this->field['id'] . '-example" class="redux-font-select fs-example">Lorem Ipsum is simply dummy text</textarea>';

			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php

				echo '<label>'.__('Text Align', IRON_TEXT_DOMAIN).'</label> ';

				$field_id = "align";
				$field = new Redux_Options_select(
					array(
						'id' => $this->field['id'] . '-'.$field_id,
						'class' => 'redux-typography-'.$field_id,
						'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
						'options' => array(
							'' => 'Default',
							'left' => 'left',
							'center' => 'center',
							'right' => 'right',
						)
					),'' , ''
				);
				$field->value = @$this->value[$field_id];
				$field->render();

			?>
			</td>
			<td>
			<?php

				echo '<label>'.__('Font Size', IRON_TEXT_DOMAIN).'</label> ';

				$field_id = "size";
				$field = new Redux_Options_text(
					array(
						'id' => $this->field['id'] . '-'.$field_id,
						'class' => 'small-text redux-typography-'.$field_id,
						'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
						'validate' => 'numeric',
					),'' , ''
				);
				$field->value = @$this->value[$field_id];
				$field->render();



			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php

				echo '<label>'.__('Transform', IRON_TEXT_DOMAIN).'</label> ';

				$field_id = "transform";
				$field = new Redux_Options_select(
					array(
						'id' => $this->field['id'] . '-'.$field_id,
						'class' => 'redux-typography-'.$field_id,
						'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
						'options' => array(
							'' => 'Default',
							'none' => 'None',
							'capitalize' => 'Capitalize',
							'uppercase' => 'Uppercase',
							'lowercase' => 'Lowercase'
						)
					),'' , ''
				);
				$field->value = @$this->value[$field_id];
				$field->render();


			?>
			</td>
			<td>
			<?php

				echo '<label>'.__('Line Height', IRON_TEXT_DOMAIN).'</label> ';

				$field_id = "height";
				$field = new Redux_Options_text(
					array(
						'id' => $this->field['id'] . '-'.$field_id,
						'class' => 'small-text redux-typography-'.$field_id,
						'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
						'validate' => 'numeric',
					),'' , ''
				);
				$field->value = @$this->value[$field_id];
				$field->render();


			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php

				echo '<label>'.__('Font Weight', IRON_TEXT_DOMAIN).'</label> ';

				$field_id = "weight";
				$field = new Redux_Options_select(
					array(
						'id' => $this->field['id'] . '-'.$field_id,
						'class' => 'redux-typography-'.$field_id,
						'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
						'options' => array(
							'' => 'Default',
							'none' => 'None',
							'bold' => 'Bold',
							'bolder' => 'Bolder',
							'lighter' => 'Lighter',
							'100' => '100',
							'200' => '200',
							'300' => '300',
							'400' => '400',
							'500' => '500',
							'600' => '600',
							'700' => '700',
							'800' => '800',
							'900' => '900',
							'inherit' => 'Inherit'
						)
					),'' , ''
				);
				$field->value = @$this->value[$field_id];
				$field->render();

			?>
			</td>
			<td>
			<?php


			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php


				echo '<label>Font Color</label> ';

				$field_id = "color";
				$field = new Redux_Options_color(
					array(
						'id' => $this->field['id'] . '-'.$field_id,
						'class' => 'redux-typography-'.$field_id,
						'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
						'std' => ''
					),'' , ''
				);
				$field->value = @$this->value[$field_id];
				$field->enqueue();
				$field->render();


			?>
			</td>
			<td>
			<?php

				echo '<label>'.__('Background', IRON_TEXT_DOMAIN).'</label> ';

				$field_id = "bgcolor";
				$field = new Redux_Options_color(
					array(
						'id' => $this->field['id'] . '-'.$field_id,
						'class' => 'redux-typography-'.$field_id,
						'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
						'std' => ''
					),'' , ''
				);
				$field->value = @$this->value[$field_id];
				$field->enqueue();
				$field->render();
		   ?>
		   </td>
		</tr>
		</table>

		<?php

		echo '<br><br>';
		echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';


	}

	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since Redux_Options 1.0.0
	 */
	function enqueue() {
		wp_enqueue_script(
			'redux-opts-typography-js',
			Redux_OPTIONS_URL . 'fields/typography/jquery.fontselect.js',
			array('jquery'),
			time(),
			true
		);
	}
}
