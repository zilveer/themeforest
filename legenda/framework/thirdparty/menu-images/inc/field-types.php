<?php
/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

class ET_Menu_Fields {

	public function menu_field_text($item_id, $args, $stored) {
		$output = '';
		ob_start();
		
		$input_type = 'text';
		$attrubites = '';

		if (isset($args['input_type'])) {
			$input_type = $args['input_type'];
		} 

		if (isset($args['attributes'])) {
			foreach ($args['attributes'] as $key => $value) {
				$attrubites .= $key . '="'.$value.'" ';
			}
		} 

		?>
			<label>
				<?php echo $args['title']; ?><br>
				<input type="<?php echo $input_type; ?>" name="menu-item-<?php echo $args['id']; ?>[<?php echo $item_id; ?>]" value="<?php echo $stored; ?>" class="widefat" <?php echo $attrubites; ?> />
			</label>
		<?php

		$output .= ob_get_clean();

		return $output;

	}

	public function menu_field_select($item_id, $args, $stored) {
		$output = '';
		ob_start();

		?>
			<label>
				<?php echo $args['title']; ?><br>
				<select name="menu-item-<?php echo $args['id'] ?>[<?php echo $item_id; ?>]" class="widefat">
					<?php foreach ($args['options'] as $key => $value): ?>
						<option value="<?php echo $key; ?>" <?php echo selected($key, $stored, false); ?>><?php echo $value; ?></option>
					<?php endforeach ?>
				</select>
			</label>
		<?php

		$output .= ob_get_clean();

		return $output;

	}



	public function menu_field_checkbox($item_id, $args, $stored) {
		$output = '';
		ob_start();

		?>
			<input type="checkbox" name="menu-item-<?php echo $args['id']; ?>[<?php echo $item_id; ?>]"  id="menu-item-<?php echo $args['id']; ?>[<?php echo $item_id; ?>]" value="<?php echo $args['value']; ?>" <?php echo checked($stored, $args['value'], false); ?> />
			<label for="menu-item-<?php echo $args['id']; ?>[<?php echo $item_id; ?>]">
				<?php echo $args['title']; ?><br>
			</label>
		<?php

		$output .= ob_get_clean();

		return $output;

	}

	public function render_field( $item_id, $args ) {
		$output = $class = '';
		ob_start();


		$class .= 'field-'.$args['id'];
		$class .= ' description-'.$args['width'];

		if (isset($args['levels'])) {
			if(is_array($args['levels'])) {
				foreach ($args['levels'] as $level) {
					$class .= ' field-level-' . $level;
				}
			} else {
				$class .= ' field-level-' . $args['levels'];
			}
		} 

		$stored = get_post_meta($item_id, '_menu-item-' . $args['id'], true);

		?>
			<p class="description <?php echo $class; ?>">
				<?php
					$func = 'menu_field_' . $args['type'];
					echo $this->$func($item_id, $args, $stored);
				 ?>
			</p>
			<?php if ($args['width'] == 'wide'): ?>
				<div class="clear"></div>
			<?php endif ?>
		<?php

		$output .= ob_get_clean();

		return $output;
	}


	public function menu_render_fields( $item_id ) {
		$output = '';
		$fields = et_get_menu_fields();
		
		foreach ($fields as $field) {
			$output .= $this->render_field( $item_id, $field );
		}

		return $output;
	}
}
