<?php
class CS_Facebook_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cs_facebook_widget', // Base ID
            esc_html__('Facebook Box', 'wp_nuvo'), // Name
            array('description' => esc_html__('Facebook Box Widget', 'wp_nuvo'),) // Args
        );
    }
    
    function widget($args, $instance) {      
        extract($args);
		if (!empty($instance['title'])) {
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Social', 'wp_nuvo' ) : $instance['title'], $instance, $this->id_base);
        }
        $appid = isset($instance['appid']) ? (!empty($instance['appid']) ? $instance['appid']: '217625671749731') : '217625671749731';
        $facebook_url = isset($instance['facebook_url']) ? (!empty($instance['facebook_url']) ? $instance['facebook_url']: 'https://www.facebook.com/Joomlamantemplates') : 'https://www.facebook.com/Joomlamantemplates';
        $width = isset($instance['width']) ? (!empty($instance['width']) ? $instance['width']: 'auto') : 'auto';
        $height = isset($instance['height']) ? (!empty($instance['height']) ? $instance['height']: '400px') : '400px';
        $colorscheme = isset($instance['colorscheme']) ? (!empty($instance['colorscheme']) ? $instance['colorscheme']: 'light') : 'light';
        $showface = isset($instance['showface']) ? (!empty($instance['showface']) ? $instance['showface']: 'true') : 'true';
        $show_dataheader = isset($instance['show_dataheader']) ? (!empty($instance['show_dataheader']) ? $instance['show_dataheader']: 'true') : 'true';
        $datastream = isset($instance['datastream']) ? (!empty($instance['datastream']) ? $instance['datastream']: 'true') : 'true';
        $databorder = isset($instance['databorder']) ? (!empty($instance['databorder']) ? $instance['databorder']: 'true') : 'true';
        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }

        echo $before_widget;

        if (!empty($title))
            echo $before_title . $title . $after_title;
        /*content*/
        wp_register_script( 'facebook_js', get_template_directory_uri() .'/js/facebook.js' );
        $facebook_config = array( 'language' => get_bloginfo('language'), 'appid' => $appid );
        wp_localize_script( 'facebook_js', 'facebook_config', $facebook_config );
        wp_enqueue_script( 'facebook_js' );
        ?>
        <div id="fb-root"></div>
		<div class="fb-like-box" data-href="<?php echo $facebook_url;?>" data-width="<?php echo $width;?>" data-height="<?php echo $height;?>" data-colorscheme="<?php echo $colorscheme?>" data-show-faces="<?php echo $showface;?>" data-header="<?php echo $show_dataheader;?>" data-stream="<?php echo $datastream;?>" data-show-border="<?php echo $databorder;?>"></div>
        <?php
        echo $after_widget;
    }         
    
    function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['appid'] = strip_tags($new_instance['appid']);
         $instance['facebook_url'] = strip_tags($new_instance['facebook_url']);
         $instance['width'] = strip_tags($new_instance['width']);
         $instance['height'] = strip_tags($new_instance['height']);
         $instance['colorscheme'] = strip_tags($new_instance['colorscheme']);
         $instance['showface'] = strip_tags($new_instance['showface']);
         $instance['show_dataheader'] = strip_tags($new_instance['show_dataheader']);
         $instance['datastream'] = strip_tags($new_instance['datastream']);
         $instance['databorder'] = strip_tags($new_instance['databorder']);
         $instance['extra_class'] = $new_instance['extra_class'];
         
         return $instance;
    }
    
    function form( $instance ) {
         $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
         $appid = isset($instance['appid']) ? esc_attr($instance['appid']) : '217625671749731';
         $facebook_url = isset($instance['facebook_url']) ? esc_attr($instance['facebook_url']) : 'https://www.facebook.com/Joomlamantemplates';
         $width = isset($instance['width']) ? esc_attr($instance['width']) : 'auto';
         $height = isset($instance['height']) ? esc_attr($instance['height']) : '400px';
         $colorscheme = isset($instance['colorscheme']) ? esc_attr($instance['colorscheme']) : 'light';
         $showface = isset($instance['showface']) ? esc_attr($instance['showface']) : "true";
         $show_dataheader = isset($instance['show_dataheader']) ? esc_attr($instance['show_dataheader']) : "true";
         $datastream = isset($instance['datastream']) ? esc_attr($instance['datastream']) : "true";
         $databorder = isset($instance['databorder']) ? esc_attr($instance['databorder']) : "true";
         $extra_class = isset($instance['extra_class']) ? esc_attr($instance['extra_class']) : '';
         ?>
        <p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('appid'); ?>">AppID:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('appid'); ?>" name="<?php echo $this->get_field_name('appid'); ?>" value="<?php echo $appid; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('facebook_url'); ?>">Facebook Url:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook_url'); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" value="<?php echo $facebook_url; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('width'); ?>">Width:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $width; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('height'); ?>">Height:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $height; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('colorscheme'); ?>">Color Scheme:</label>
			<select name="<?php echo $this->get_field_name('colorscheme'); ?>" id="<?php echo $this->get_field_id('colorscheme'); ?>">
				<option value="light" <?php if($instance['colorscheme']=='light') echo 'selected';?>>Light</option>
				<option value="dark" <?php if($instance['colorscheme']=='dark') echo 'selected';?>>Dark</option>
			</select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('showface'); ?>">Show Face:</label>
            <select name="<?php echo $this->get_field_name('showface'); ?>" id="<?php echo $this->get_field_id('showface'); ?>">
                <option value="true" <?php if($instance['showface']=='true') echo 'selected';?>>Yes</option>
                <option value="false" <?php if($instance['showface']=='false') echo 'selected';?>>No</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_dataheader'); ?>">Data Header:</label>
            <select name="<?php echo $this->get_field_name('show_dataheader'); ?>" id="<?php echo $this->get_field_id('show_dataheader'); ?>">
                <option value="true" <?php if($instance['show_dataheader']=='true') echo 'selected';?>>Yes</option>
                <option value="false" <?php if($instance['show_dataheader']=='false') echo 'selected';?>>No</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('datastream'); ?>">Data Stream:</label>
            <select name="<?php echo $this->get_field_name('datastream'); ?>" id="<?php echo $this->get_field_id('datastream'); ?>">
                <option value="true" <?php if($instance['datastream']=='true') echo 'selected';?>>Yes</option>
                <option value="false" <?php if($instance['datastream']=='false') echo 'selected';?>>No</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('databorder'); ?>">Border Data:</label>
            <select name="<?php echo $this->get_field_name('databorder'); ?>" id="<?php echo $this->get_field_id('databorder'); ?>">
                <option value="true" <?php if($instance['databorder']=='true') echo 'selected';?>>Yes</option>
                <option value="false" <?php if($instance['databorder']=='false') echo 'selected';?>>No</option>
            </select>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('extra_class'); ?>">Extra Class:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('extra_class'); ?>" name="<?php echo $this->get_field_name('extra_class'); ?>" value="<?php echo $instance['extra_class']; ?>" />
		</p>
         <?php
         
    } 

}

/**
* Class CS_Social_Widget
*/

function register_facebook_widget() {
    register_widget('CS_Facebook_Widget');
}

add_action('widgets_init', 'register_facebook_widget');
?>