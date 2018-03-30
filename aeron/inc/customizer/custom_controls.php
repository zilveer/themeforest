<?php

if (class_exists('WP_Customize_Control')){


	class Info_Custom_control extends WP_Customize_Control{
		public $type = 'info';
		public function render_content(){
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<p><?php echo $this->description; ?></p>
			<?php
		}
	}


	class Separator_Custom_control extends WP_Customize_Control{
		public $type = 'separator';
		public function render_content(){
			?>
			<p><hr></p>
			<?php
		}
	}


	class Multi_Input_Custom_control extends WP_Customize_Control{
		public $type = 'multi_input';
		public function enqueue(){
			wp_enqueue_script( 'custom_controls', TEMPPATH.'/inc/customizer/js/custom_controls.js', array( 'jquery' ),'', true );
			wp_enqueue_style( 'custom_controls_css', TEMPPATH.'/inc/customizer/css/custom_controls.css');
		}
		public function render_content(){
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo $this->description; ?></p>
				<input type="hidden" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" value="<?php echo $this->value(); ?>" class="customize_multi_value_field" data-customize-setting-link="<?php echo $this->id; ?>"/>
				<div class="customize_multi_fields">
					<div class="set">
						<input type="text" value="" class="customize_multi_single_field"/>
						<a href="#" class="customize_multi_remove_field">X</a>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php _e('Add More', 'ABdev_spiral') ?></a>
			</label>
			<?php
		}
	}

	class Toggle_Checkbox_Custom_control extends WP_Customize_Control{
		public $type = 'toogle_checkbox';
		public function enqueue(){
			wp_enqueue_script( 'custom_controls', TEMPPATH.'/inc/customizer/js/custom_controls.js', array( 'jquery' ),'', true );
			wp_enqueue_style( 'custom_controls_css', TEMPPATH.'/inc/customizer/css/custom_controls.css');
		}
		public function render_content(){
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
				    <input type="checkbox" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
				    <label class="onoffswitch-label" for="<?php echo $this->id; ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo $this->description; ?></p>
			</div>
			<?php
		}
	}

}

