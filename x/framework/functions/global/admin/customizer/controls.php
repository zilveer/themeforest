<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/CONTROLS.PHP
// -----------------------------------------------------------------------------
// Sets up custom controls for the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Custom Controls
// =============================================================================

// Custom Controls
// =============================================================================

function x_add_customizer_custom_controls( $wp_customize ) {

  //
  // Textarea.
  //

  class X_Customize_Control_Textarea extends WP_Customize_Control {

    public $type = 'textarea';

    public function render_content() { ?>

      <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea <?php $this->link(); ?> rows="10" style="width: 98%;"><?php echo esc_textarea( $this->value() ); ?></textarea>
      </label>

    <?php }

  }


  //
  // Slider.
  //

  class X_Customize_Control_Slider extends WP_Customize_Control {

    public $type = 'slider';

    public function enqueue() {
      wp_enqueue_script( 'jquery-ui-core' );
      wp_enqueue_script( 'jquery-ui-slider' );
    }

    public function render_content() { ?>

      <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <input type="text" id="input_<?php echo $this->id; ?>" value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
      </label>

      <div id="slider_<?php echo $this->id; ?>" class="x-slider"></div>

      <script>
        jQuery(document).ready(function($) {

          $('#slider_<?php echo $this->id; ?>').slider({
            value : <?php echo floatval( $this->value() ); ?>,
            min   : <?php echo $this->choices['min']; ?>,
            max   : <?php echo $this->choices['max']; ?>,
            step  : <?php echo $this->choices['step']; ?>,
            slide : function(e, ui) { $('#input_<?php echo $this->id; ?>').val(ui.value).keyup(); }
          });

          $('#input_<?php echo $this->id; ?>').val($('#slider_<?php echo $this->id; ?>').slider('value'));

        });
      </script>

    <?php }

  }

}

add_action( 'customize_register', 'x_add_customizer_custom_controls' );