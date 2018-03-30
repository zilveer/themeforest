<?php 
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

    /**
 * Class to create a custom text description control
 */
class Text_Slider_Custom_Control extends WP_Customize_Control
{

	public $type = 'slider';
	/**
    * Enqueue the styles and scripts
    */
    public function enqueue()
    {
        wp_enqueue_script( 'jquery-ui-slider' );
    }

      /**
       * Render the content on the theme customizer page
       */
      public function render_content()
       {	                                                   
       
  		?>

  		<label>
  			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
  			<div id="<?php echo $this->id; ?>_slider" class="slider_df_slider_text"></div>
  			<input id="<?php echo $this->id; ?>_input" class="input_df_slider_text" type="text" value="<?php echo $this->value(); ?>" <?php $this->link(); ?>>
  		</label>

  		<script>
  		 jQuery(document).ready(function($) {

                $( "#<?php echo $this->id; ?>_slider" ).slider({
                    value: <?php echo $this->value(); ?>,
                    min: 0, // 0
                    max: 100, // 100
                    step: 5,
                    slide: function( event, ui ) {
                        $( "#<?php echo $this->id; ?>_input" ).val(ui.value).keyup();
                    }
                });
                $( "#<?php echo $this->id; ?>_input" ).val( $( "#<?php echo $this->id; ?>_slider" ).slider( "value" ) );

            });
  		</script>

		<?php
		}
}
?>