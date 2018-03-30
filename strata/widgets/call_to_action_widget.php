<?php

class Call_To_Action extends WP_Widget {
    public function __construct() {
		parent::__construct(
	 		'call_to_action_widget', // Base ID
			'Call To Action', // Name
			array( 'description' => __( 'Call to Action Widget', 'text_domain' ), ) // Args
		);
	}
    
    public function widget($args, $instance) {
        global $qode_options_theme13;

        extract($args);

        $html                   = "";
        $button_html            = "";
        $text_html              = "";
        $section_wrapper_styles = "";
        $container_inner_styles = "";
        $text_styles            = "";
        $button_styles          = "";
        $button_classes         = "";
        $call_to_action_classes = "";

        if($qode_options_theme13['content_bottom_in_grid'] == 'yes') {
            $call_to_action_classes .= 'in_grid';
        }
        
        if($instance['background_color'] != "") {
            $section_wrapper_styles .= "background-color:".$instance['background_color'].";";
        }

        if($instance['padding_top'] != "") {
            $container_inner_styles .= "padding-top: ".$instance['padding_top'].";";
        }

        if($instance['padding_bottom'] != "") {
            $container_inner_styles .= "padding-bottom: ".$instance['padding_bottom'].";";
        }
        
        if($instance['text_color'] != "") {
            $text_styles .= "color: ".$instance['text_color'].";";
        }

        if($instance['text_size'] != "") {
            $text_styles .= "font-size: ".$instance['text_size'].";";
        }
        
        if($instance['button_color'] != "") {
            $button_styles .= "color: ".$instance['button_color'].";";
        }

        if(!empty($instance['button_top_gradient_background_color']) && !empty($instance['button_bottom_gradient_background_color'])) {
            $button_styles .= "background: {$instance['button_top_gradient_background_color']};";
            $button_styles .= "background: {$instance['button_top_gradient_background_color']} -ms-linear-gradient(bottom, {$instance['button_bottom_gradient_background_color']} 0%, {$instance['button_top_gradient_background_color']} 100%);";
            $button_styles .= "background: {$instance['button_top_gradient_background_color']} -moz-linear-gradient(bottom, {$instance['button_bottom_gradient_background_color']} 0%, {$instance['button_top_gradient_background_color']} 100%);";
            $button_styles .= "background: {$instance['button_top_gradient_background_color']} -o-linear-gradient(bottom, {$instance['button_bottom_gradient_background_color']} 0%, {$instance['button_top_gradient_background_color']} 100%);";
            $button_styles .= "background: {$instance['button_top_gradient_background_color']} -webkit-gradient(linear, left bottom, left top, color-stop(0,{$instance['button_bottom_gradient_background_color']}), color-stop(1, {$instance['button_top_gradient_background_color']}));";
            $button_styles .= "background: {$instance['button_top_gradient_background_color']} -webkit-linear-gradient(bottom, {$instance['button_bottom_gradient_background_color']} 0%, {$instance['button_top_gradient_background_color']} 100%);";
            $button_styles .= "background: {$instance['button_top_gradient_background_color']} linear-gradient(to top, {$instance['button_bottom_gradient_background_color']} 0%, {$instance['button_top_gradient_background_color']} 100%);";
        }
        
        if($instance['button_border_color']) {
            $button_styles .= "border-color: ".$instance['button_border_color'].";";
        }
        
        $button_link    = (isset($instance['button_link']) && $instance['button_link'] != "") ? $instance['button_link'] : '#';
        $button_target  = (isset($instance['button_target']) && $instance['button_target'] != "") ? $instance['button_target'] : '_self';
        $button_text    = (isset($instance['button_text']) && $instance['button_text'] != "") ? $instance['button_text'] : __('Default button text', 'qode');
        $text           = (isset($instance['text']) && $instance['text'] != "") ? $instance['text'] :  __('Default call to action text', 'qode');
        
        $html        .= "<div class='qode_call_to_action container {$call_to_action_classes}' style='{$section_wrapper_styles}'>";
        $html        .= "<div class='container_inner' style='{$container_inner_styles}'>";
        $html        .= "<section class='grid_section'>";
        $html        .= "<div class='two_columns_75_25 clearfix'>";
        
        $button_html .= "<div class='column2 call_to_action_button_wrapper {$instance['button_position']}'>";
        $button_html .= "<div class='column_inner'>";
        $button_html .= "<a href='{$button_link}' target='{$button_target}' class='qbutton {$button_classes}' style='{$button_styles}'>{$button_text}</a>";
        $button_html .= "</div>"; //close column_inner button html
        $button_html .= "</div>"; //close column2 button html
        
        $text_html   .= "<div class='column1 call_to_action_text_wrapper wpb_column column_container {$instance['button_position']}'>";
        $text_html   .= "<div class='column_inner call_to_action_text_wrapper wpb_column column_container'>";
        $text_html   .= "<p style='{$text_styles}'>".do_shortcode($text)."</p>";
        $text_html   .= "</div>"; //close column_inner text html
        $text_html   .= "</div>"; //close column1 text html
        
        //if we need to show the button
        if($instance['button_option'] == "yes") {
            if($instance['button_position'] == 'left') {
                $html  .= $button_html;
                $html  .= $text_html;
            } else {
                $html  .= $text_html;
                $html  .= $button_html;
            }
        } else {
            $html  .= $text_html;
        }
        
        $html        .= "</div>";
        $html        .= "</section>";
        $html        .= "</div>";
        $html        .= "</div>";
        
        echo $html;
	}

 	public function form($instance) {
        
        //set widget values
		$text                                       = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
        $text_color                                 = isset( $instance['text_color'] ) ? esc_attr( $instance['text_color'] ) : '';
        $text_size                                  = isset( $instance['text_size'] ) ? esc_attr( $instance['text_size'] ) : '';
        $background_color                           = isset( $instance['background_color'] ) ? esc_attr( $instance['background_color'] ) : '';
        $padding_top                                = isset( $instance['padding_top'] ) ? esc_attr( $instance['padding_top'] ) : '';
        $padding_bottom                             = isset( $instance['padding_bottom'] ) ? esc_attr( $instance['padding_bottom'] ) : '';
        $button_option                              = isset( $instance['button_option'] ) ? esc_attr( $instance['button_option'] ) : 'no';
        $button_color                               = isset( $instance['button_color'] ) ? esc_attr( $instance['button_color'] ) : '';
        $button_top_gradient_background_color       = isset( $instance['button_top_gradient_background_color'] ) ? esc_attr( $instance['button_top_gradient_background_color'] ) : '';
        $button_bottom_gradient_background_color    = isset( $instance['button_bottom_gradient_background_color'] ) ? esc_attr( $instance['button_bottom_gradient_background_color'] ) : '';
        $button_border_color                        = isset( $instance['button_border_color'] ) ? esc_attr( $instance['button_border_color'] ) : '';
        $button_text                                = isset( $instance['button_text'] ) ? esc_attr( $instance['button_text'] ) : '';
        $button_link                                = isset( $instance['button_link'] ) ? esc_attr( $instance['button_link'] ) : '';
        $button_target                              = isset( $instance['button_target'] ) ? esc_attr( $instance['button_target'] ) : '';
        $button_position                            = isset( $instance['button_position'] ) ? esc_attr( $instance['button_position'] ) : 'right';
            
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:','qode'); ?></label> 
        <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="5" rows="5"><?php echo esc_attr( $text ); ?></textarea>
		</p>
        
		<p>
		<label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php _e( 'Text Color:','qode' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" type="text" value="<?php echo esc_attr( $text_color ); ?>" />
		</p>

        <p>
        <label for="<?php echo $this->get_field_id( 'text_size' ); ?>"><?php _e( 'Text Size:','qode' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'text_size' ); ?>" name="<?php echo $this->get_field_name( 'text_size' ); ?>" type="text" value="<?php echo esc_attr( $text_size ); ?>" />
        </p>
        
		<p>
		<label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:','qode' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" type="text" value="<?php echo esc_attr( $background_color ); ?>" />
		</p>

        <p>
		<label for="<?php echo $this->get_field_id( 'padding_bottom' ); ?>"><?php _e( 'Padding Bottom:','qode' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'padding_bottom' ); ?>" name="<?php echo $this->get_field_name( 'padding_bottom' ); ?>" type="text" value="<?php echo esc_attr( $padding_bottom ); ?>" />
		</p>

        <p>
		<label for="<?php echo $this->get_field_id( 'padding_top' ); ?>"><?php _e( 'Padding Top:','qode' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'padding_top' ); ?>" name="<?php echo $this->get_field_name( 'padding_top' ); ?>" type="text" value="<?php echo esc_attr( $padding_top ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'button_option' ); ?>"><?php _e( 'Show Button:','qode' ); ?></label> 
		<select id="<?php echo $this->get_field_id( 'button_option' ); ?>" name="<?php echo $this->get_field_name( 'button_option' ); ?>">
            <option value="yes" <?php if(esc_attr($button_option) == "yes"){echo 'selected="selected"';} ?>>Yes</option>  
            <option value="no" <?php if(esc_attr($button_option) == "no"){echo 'selected="selected"';} ?>>No</option>  
		</select>
        </p>
        
        <p>

        <p>
		<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:','qode' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'button_color' ); ?>"><?php _e( 'Button Color:','qode' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'button_color' ); ?>" name="<?php echo $this->get_field_name( 'button_color' ); ?>" type="text" value="<?php echo esc_attr( $button_color ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'button_top_gradient_background_color' ); ?>"><?php _e( 'Button Top Gradient Background Color:','qode' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'button_top_gradient_background_color' ); ?>" name="<?php echo $this->get_field_name( 'button_top_gradient_background_color' ); ?>" type="text" value="<?php echo esc_attr( $button_top_gradient_background_color ); ?>" />
		</p>

        <p>
		<label for="<?php echo $this->get_field_id( 'button_bottom_gradient_background_color' ); ?>"><?php _e( 'Button Bottom Gradient Background Color:','qode' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'button_bottom_gradient_background_color' ); ?>" name="<?php echo $this->get_field_name( 'button_bottom_gradient_background_color' ); ?>" type="text" value="<?php echo esc_attr( $button_bottom_gradient_background_color ); ?>" />
		</p>

        <p>
		<label for="<?php echo $this->get_field_id( 'button_border_color' ); ?>"><?php _e( 'Button Border Color:','qode' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'button_border_color' ); ?>" name="<?php echo $this->get_field_name( 'button_border_color' ); ?>" type="text" value="<?php echo esc_attr( $button_border_color ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'button_link' ); ?>"><?php _e( 'Button Link:','qode' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'button_link' ); ?>" name="<?php echo $this->get_field_name( 'button_link' ); ?>" type="text" value="<?php echo esc_attr( $button_link ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'button_target' ); ?>"><?php _e( 'Button Target:','qode' ); ?></label> 
		<select id="<?php echo $this->get_field_id( 'button_target' ); ?>" name="<?php echo $this->get_field_name( 'button_target' ); ?>">
            <option value="_blank" <?php if(esc_attr($button_target) == "_blank"){echo 'selected="selected"';} ?>>Blank</option>  
            <option value="_self" <?php if(esc_attr($button_target) == "_self"){echo 'selected="selected"';} ?>>Self</option>  
            <option value="_top" <?php if(esc_attr($button_target) == "_top"){echo 'selected="selected"';} ?>>Top</option>  
            <option value="_parent" <?php if(esc_attr($button_target) == "_parent"){echo 'selected="selected"';} ?>>Parent</option>  
		</select>
        </p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'button_position' ); ?>"><?php _e( 'Button Position:','qode' ); ?></label> 
		<select id="<?php echo $this->get_field_id( 'button_position' ); ?>" name="<?php echo $this->get_field_name( 'button_position' ); ?>">
            <option value="right" <?php if(esc_attr($button_position) == "right"){echo 'selected="selected"';} ?>>Right</option>  
            <option value="left" <?php if(esc_attr($button_position) == "left"){echo 'selected="selected"';} ?>>Left</option>  
		</select>
        </p>
        
		<?php 
	}

	public function update($new_instance, $old_instance) {
		// processes widget options to be saved
        $instance = array();
        
		$instance['text']                                    = strip_tags( $new_instance['text'] );
		$instance['text_color']                              = $new_instance['text_color'];
        $instance['text_size']                               = $new_instance['text_size'];
		$instance['background_color']                        = $new_instance['background_color'];
		$instance['padding_top']                             = $new_instance['padding_top'];
		$instance['padding_bottom']                          = $new_instance['padding_bottom'];
		$instance['button_option']                           = $new_instance['button_option'];
		$instance['button_text']                             = $new_instance['button_text'];
		$instance['button_color']                            = $new_instance['button_color'];
		$instance['button_top_gradient_background_color']    = $new_instance['button_top_gradient_background_color'];
		$instance['button_bottom_gradient_background_color'] = $new_instance['button_bottom_gradient_background_color'];
		$instance['button_border_color']                     = $new_instance['button_border_color'];
		$instance['button_link']                             = $new_instance['button_link'];
		$instance['button_target']                           = $new_instance['button_target'];
		$instance['button_position']                         = $new_instance['button_position'];
        
		return $instance;
	}
}

function qode_call_to_action_load(){   
	register_widget('Call_To_Action');
}

add_action('widgets_init', 'qode_call_to_action_load');
