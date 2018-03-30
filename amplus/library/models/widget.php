<?php

/**
 * IMPORTANT NOTE:
 * For inheriting classes, do not use the magic function __construct()
 * for the constructor. Use the class name instead to prevent hidden
 * errors in external scripts that require wp-load.php 
 */

class BFIWidgetModel extends WP_Widget implements iBFIWidget {
    
    public $label = 'A Widget';
    public $description = '';
    public $args = array();
    
    // This holds an array of arg names (from the property above) which are enabled for translation
    // This may also be an associative array with the keys as the arg names and the values
    // as labels for the field
    public $translatableArgs = array();
    
    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetModel() {
        parent::WP_Widget(
            false, 
            BFI_THEMENAME . ' &rarr; ' . trim($this->label), 
            array('description' => $this->description));
    }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
    
        foreach ($new_instance as $key => $value)
            $instance[$key] = $value;
    
        return $instance;
    }
    
    function widget($args, $instance) {
        extract($args);
        
        $title = apply_filters('widget_title', empty( $instance['title'] ) ? $this->label : $instance['title'], $instance, $this->id_base);
        unset($instance['title']);
        
        // Apply translation to translatable text
        foreach ($this->translatableArgs as $key => $value) {
            if (is_numeric($key)) {
                $arg = $value;
            } else {
                $arg = $key;
            }
            $instance[$arg] = apply_filters('widget_translate', $instance[$arg], $arg);
        }
  
        echo $before_widget;
        echo $before_title . $title . $after_title;
        
        // set arguments to default values to prevent newly added args from showing errors
        foreach ( $this->args as $key => $default ) {
            if ( empty($instance[$key]) ) {
                $instance[$key] = $default;
            }
        }
        
        $this->render($instance);
        
        echo $after_widget;
    }
    
    function form($instance) {
        // always display the title form field
        $title = !array_key_exists('title', $instance) ? '' : esc_attr( $instance['title'] );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
        </p>
        <?php
        
        // this assigns the arguments to be passed to the display form function
        $args = array();
        foreach ($this->args as $key => $value) {
            $args[$key] = array_key_exists($key, $instance) ? esc_attr($instance[$key]) : $value;
        }
        $this->displayForm($args);
        
        // Create translation fields to translatable text
        foreach ($this->translatableArgs as $key => $value) {
            if (is_numeric($key)) {
                $arg = $value;
                $label = ucfirst($value);
            } else {
                $arg = $key;
                $label = $value;
            }
            $instance[$arg] = apply_filters('widget_translate_form', $this->id, $arg, $label);
        }
    }
    
    // these will be overriden
    public function render($args) { }
    public function displayForm($args) { }
}
