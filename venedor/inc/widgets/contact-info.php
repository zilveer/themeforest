<?php
add_action('widgets_init', 'venedor_contact_info_load_widgets');

function venedor_contact_info_load_widgets() {
	register_widget('Venedor_Contact_Info_Widget');
}

class Venedor_Contact_Info_Widget extends WP_Widget {
    
    private $params;

	function Venedor_Contact_Info_Widget() {
        
        $this->params = array(
            'title' => __('Title', 'venedor'), 
            'company' => __('Company', 'venedor'), 
            'country' => __('Country', 'venedor'), 
            'locality' => __('Locality', 'venedor'),
            'region' => __('Region', 'venedor'),
            'street' => __('Street', 'venedor'),
            'working-days' => __('Working Days', 'venedor'),
            'working-hours' => __('Working Hours', 'venedor'),
            'phone' => __('Phone', 'venedor'),
            'mobile' => __('Mobile', 'venedor'),
            'fax' => __('Fax', 'venedor'),
            'skype' => __('Skype', 'venedor'),
            'email-address' => __('Email Address', 'venedor'),
            'email' => __('Email', 'venedor'),
            'website-url' => __('Website URL', 'venedor'),
            'website' => __('Website', 'venedor')
        );
                    
		$widget_ops = array('classname' => 'contact-info', 'description' => __('Add contact information.', 'venedor'));

		$control_ops = array('id_base' => 'contact-info-widget');

		parent::__construct('contact-info-widget', __('Venedor: Contact Info', 'venedor'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}
		?>
		<div class="contact-info">
        <?php
        foreach ($this->params as $key => $value) :
            if ($instance[$key]) : 
                switch ($key) { 
                    case 'working-days':
                    case 'working-hours':
                    case 'phone':
                    case 'mobile':
                    case 'skype':
                    ?>
                        <p class="<?php echo $key ?>"><?php echo $value ?>: <?php _e($instance[$key]); ?></p>
                    <?php
                        break;
                    case 'title':
                    case 'email-address':
                    case 'website-url':
                        break;
                    case 'email':
                    ?>
                        <p class="<?php echo $key ?>"><?php echo $value ?>: <a href="mailto:<?php echo $instance['email-address']; ?>"><?php if($instance[$key]) { _e($instance[$key]); } else { _e($instance[$key]); } ?></a></p>
                    <?php 
                        break;
                    case 'website':
                    ?>
                        <p class="<?php echo $key ?>"><?php echo $value ?> <a href="<?php echo $instance['website-url']; ?>"><?php if($instance[$key]) { _e($instance[$key]); } else { _e($instance[$key]); } ?></a></p>
                    <?php 
                        break;
                    default: ?>
                        <p class="<?php echo $key ?>"><?php _e($instance[$key]); ?></p>
            <?php }
            endif;
        endforeach; ?>
		</div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
        
        foreach ($this->params as $key => $value)
            $instance[$key] = $new_instance[$key];

		return $instance;
	}

	function form($instance) {
		$defaults = array('title' => __('Contact Info', 'venedor'));
		$instance = wp_parse_args((array) $instance, $defaults); 
        foreach ($this->params as $key => $value) :
        ?>
            <p>
                <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $value ?>:</label>
                <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" value="<?php if (isset($instance[$key])) _e($instance[$key]); ?>" />
            </p>
        <?php endforeach; ?>
	<?php
	}
}
?>