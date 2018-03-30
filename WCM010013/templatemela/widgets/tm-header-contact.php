<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 */
?>
<?php  // Reference:  http://codex.wordpress.org/Widgets_API
class HeaderContactWidget extends WP_Widget
{
    function HeaderContactWidget(){
		$widget_settings = array('description' => 'Header Contact Widget', 'classname' => 'widgets-header-contact');
		parent::__construct(false,$name='TM - Header Contact Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);		
		$description = empty($instance['description']) ? '' : $instance['description']; 
		echo $before_widget;
		echo $before_title ;			
		if($title)
			echo $title;
		echo $after_title; ?>

<div class="header_contact"><?php echo $description; ?> </div>
<?php echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;		
		$instance['window_target'] = false;
		$instance['description'] =($new_instance['description']);	
		return $instance;
	}

    function form($instance){
		$instance = wp_parse_args( (array) $instance, array('description'=>'Write your contact details here.') );		
		$description = esc_attr($instance['description']);	
		?>
<p>
  <label for="<?php echo $this->get_field_id('description');?>"><?php _e('Description:', 'templatemela'); ?></label>
  <textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('description');?>" name="<?php echo $this->get_field_name('description');?>" ><?php echo $description;?></textarea>
</p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("HeaderContactWidget");'));
?>
