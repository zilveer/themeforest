<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom text description control
 */
class Text_Description_Custom_Control extends WP_Customize_Control
{
      /**
       * Render the content on the theme customizer page
       */
      public function render_content()
       {
            ?>
                <label>
                  <p class="customize-info"><span>NOTE:</span> <?php echo esc_html( $this->label ); ?></p>
                </label>
            <?php
       }
}
?>