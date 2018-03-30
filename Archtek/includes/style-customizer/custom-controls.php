<?php

add_action('customize_register', 'uxbarn_register_customizer_custom_controls');

if( ! function_exists('uxbarn_register_customizer_custom_controls')) {

	function uxbarn_register_customizer_custom_controls() {
	    
	    class WP_Customize_Textarea_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_textarea';
	     
	        public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo $this->value(); ?></textarea>
	            </label>
	        <?php
	        }
	    }
	    
	    // Title control
	    class WP_Customize_Title_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_title';
	         
	        public function render_content() {
	            echo '<strong>' . $this->label . '</strong>';
	        }
	    }
	    
	    // Description control
	    class WP_Customize_Description_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_description';
	         
	        public function render_content() {
	            echo $this->label;
	        }
	    }
	    
	    // Divider control
	    class WP_Customize_Divider_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_divider';
	         
	        public function render_content() {
	            echo '<hr class="divider" />';
	        }
	    }
	    
	    // Font Family control
	    class WP_Customize_FontFamily_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_font_family';
	     
	        public function render_content() {
	            
	            ?>
	                <label>
	                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	                </label>
	                <select <?php $this->link(); ?> class="uxbarn_font_family">
	                    <option value="-1"><?php _e('- Font Family -', 'uxbarn'); ?></option>
	                    <?php
	                        
	                        $font_array = uxbarn_ctmzr_get_font_array();
	                        
	                        for($i=0; $i<count($font_array); $i++) {
	                            $keys = array_keys($font_array);
	                            $values = array_values($font_array);
	                            echo '<option value="' . $keys[$i] . '">' . $values[$i] . '</option>';
	                        }
	                        
	                    ?>
	                </select>
	                
	            <?php
	        }
	    }
	
	    // Font Size control (Use with Font Family control)
	    class WP_Customize_FontSize_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_font_size';
	     
	        public function render_content() {
	            
	            ?>
	            
	                <select <?php $this->link(); ?> class="font-size short-select-list float-left">
	                    <option value="-1"><?php _e('- Size -', 'uxbarn'); ?></option>
	                    <?php
	                        
	                        $font_size_array = uxbarn_ctmzr_get_font_size_array();
	                        
	                        for($i=0; $i<count($font_size_array); $i++) {
	                            $keys = array_keys($font_size_array);
	                            $values = array_values($font_size_array);
	                            echo '<option value="' . $keys[$i] . '">' . $values[$i] . '</option>';
	                        }
	                    
	                    ?>
	                </select>
	            
	            <?php
	        }
	    }
	    
	    // Font Style control (Use with Font Family control)
	    class WP_Customize_FontStyle_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_font_style';
	     
	        public function render_content() {
	            
	            ?>
	            
	                <select <?php $this->link(); ?> class="font-style short-select-list float-left">
	                    <option value="-1"><?php _e('- Style -', 'uxbarn'); ?></option>
	                    <?php
	                        
	                        $font_style_array = uxbarn_ctmzr_get_font_style_array();
	                        
	                        for($i=0; $i<count($font_style_array); $i++) {
	                            $keys = array_keys($font_style_array);
	                            $values = array_values($font_style_array);
	                            echo '<option value="' . $keys[$i] . '">' . $values[$i] . '</option>';
	                        }
	                    
	                    ?>
	                </select>
	            
	            <?php
	        }
	    }
	    
	    // Font Weight control (Use with Font Family control)
	    class WP_Customize_FontWeight_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_font_weight';
	     
	        public function render_content() {
	            
	            ?>
	            
	                <select <?php $this->link(); ?> class="font-weight short-select-list float-left">
	                    <option value="-1"><?php _e('- Weight -', 'uxbarn'); ?></option>
	                    <?php
	                        
	                        $font_weight_array = uxbarn_ctmzr_get_font_weight_array();
	                        
	                        for($i=0; $i<count($font_weight_array); $i++) {
	                            $keys = array_keys($font_weight_array);
	                            $values = array_values($font_weight_array);
	                            echo '<option value="' . $keys[$i] . '">' . $values[$i] . '</option>';
	                        }
	                    
	                    ?>
	                </select>
	            
	            <?php
	        }
	    }
	    
	    // Line Height control (Use with Font Family control)
	    class WP_Customize_LineHeight_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_line_height';
	     
	        public function render_content() {
	            
	            ?>
	            
	                <select <?php $this->link(); ?> class="line-height short-select-list float-left">
	                    <option value="-1"><?php _e('- Line Height -', 'uxbarn'); ?></option>
	                    <?php
	                        
	                        $line_height_array = uxbarn_ctmzr_get_line_height_array();
	                        
	                        for($i=0; $i<count($line_height_array); $i++) {
	                            $keys = array_keys($line_height_array);
	                            $values = array_values($line_height_array);
	                            echo '<option value="' . $keys[$i] . '">' . $values[$i] . '</option>';
	                        }
	                    
	                    ?>
	                </select>
	            
	            <?php
	        }
	    }
	    
	    // Background Repeat control
	    class WP_Customize_BackgroundRepeat_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_background_repeat';
	     
	        public function render_content() {
	            
	            ?>
	            
	                <select <?php $this->link(); ?> class="background-repeat short-select-list float-left">
	                    <option value="-1"><?php _e('- Repeat -', 'uxbarn'); ?></option>
	                    <?php
	                        
	                        $items = uxbarn_ctmzr_get_background_repeat_array();
	                        
	                        for($i=0; $i<count($items); $i++) {
	                            $keys = array_keys($items);
	                            $values = array_values($items);
	                            echo '<option value="' . $keys[$i] . '">' . $values[$i] . '</option>';
	                        }
	                    
	                    ?>
	                </select>
	            
	            <?php
	        }
	    }
	    
	    // Background Position control
	    class WP_Customize_BackgroundPosition_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_background_position';
	     
	        public function render_content() {
	            
	            ?>
	            
	                <select <?php $this->link(); ?> class="background-position short-select-list float-left">
	                    <option value="-1"><?php _e('- Position -', 'uxbarn'); ?></option>
	                    <?php
	                        
	                        $items = uxbarn_ctmzr_get_background_position_array();
	                        
	                        for($i=0; $i<count($items); $i++) {
	                            $keys = array_keys($items);
	                            $values = array_values($items);
	                            echo '<option value="' . $keys[$i] . '">' . $values[$i] . '</option>';
	                        }
	                    
	                    ?>
	                </select>
	            
	            <?php
	        }
	    }
	    
	    // Pixel Input
	    class WP_Customize_PixelInput_Custom_Control extends WP_Customize_Control {
	        public $type = 'uxbarn_pixel_input';
	     
	        public function render_content() {
	        ?>  
	            <label>
	                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	                <input class="pixel-input-field" type="text" style="width:60px" <?php $this->link(); ?> value="<?php echo esc_textarea($this->value()); ?>"></input> <span>px</span>
	            </label>
	        <?php
	        }
	    }
	    
	}

}

?>