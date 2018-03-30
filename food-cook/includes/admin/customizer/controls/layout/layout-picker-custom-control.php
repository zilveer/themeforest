<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom layout control
 */
class Layout_Picker_Custom_Control extends WP_Customize_Control
{

      public $type = 'images_radio';
      /**
       * Render the content on the theme customizer page
       */
      public function render_content()
       {
                  
            if ( empty( $this->choices ) )
            return;
            ?>
              <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
              <ul>

              <?php foreach ( $this->choices as $value => $label ) : ?>
               
                <li>
                <label class="customize-images-picker">
                <input name="<?php echo $this->id; ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" <?php $this->link(); ?> />
                <img src="<?php echo $label; ?>" />
                </label>
                </li>

              <?php endforeach; // end foreach ?>

               </ul>
               
            <?php
       }

}
?>