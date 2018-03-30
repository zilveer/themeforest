<?php

/**
 * FILE: class.php 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: WPLMS
 */
if ( !defined( 'ABSPATH' ) ) exit;
add_action( 'customize_register', 'themename_customize_register' );
function themename_customize_register($wp_customize) {

    class Vibe_Customize_Slider_Control extends WP_Customize_Control {
        public $type = 'text';
     
        public function render_content() {
            ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input type="text" class="slider_value text" data-min="<?php echo esc_html( $this->min ); ?>" data-max="<?php echo esc_html( $this->max ); ?>" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" />
            <div class="customizer_slider"></div>
            </label>
            <?php
        }
    }

    class Vibe_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';
     
        public function render_content() {
            ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
            <?php
        }
    }

}

?>
