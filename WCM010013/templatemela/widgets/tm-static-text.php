<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 */
 ?>
<?php 
class StaticTextWidget extends WP_Widget
{
    function StaticTextWidget(){
		$widget_settings = array('description' => 'Static Text Widget', 'classname' => 'widgets-statictext');
		parent::__construct(false,$name='TM - Static Text Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'services' : $instance['title']);
		$subtitle = apply_filters('widget_title', empty($instance['subtitle']) ? '' : $instance['subtitle']);
        $window_target = isset($instance['window_target']) ? $instance['window_target'] : false;
		$is_template_path = isset($instance['is_template_path']) ? $instance['is_template_path'] : false;
		$service = empty($instance['service']) ? '' : $instance['service'];
		$imageSrc = empty($instance['imageSrc']) ? '' : $instance['imageSrc'];
		$linkURL = empty($instance['linkURL']) ? '' : $instance['linkURL'];
		echo $before_widget; ?> 
		<div class="static-text">
			<div class="statictext-title">
				<?php 
				echo $before_title;			
				 if($title) echo $title; 
				echo $after_title;	?>
					<?php if(!empty($imageSrc)) : ?>
					<img src="<?php echo $imageSrc; ?>" alt="Image"/>
					<?php endif; ?>
					<?php if(!empty($subtitle)) : ?>
					<h4 class="statictext-subtitle"><?php echo $subtitle; ?></h4>
					<?php endif; ?>
			</div>
			<?php if(!empty($service)) : ?>
			<div class="statictext-description"><?php echo $service; ?></div>
			<?php endif; ?>
		</div>				
		<?php
		echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;		
		$instance['window_target'] = false;
		if (isset($new_instance['window_target'])) $instance['window_target'] = true;
		if (isset($new_instance['is_template_path'])) $instance['is_template_path'] = true;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['service'] =($new_instance['service']);
		$instance['imageSrc'] =($new_instance['imageSrc']);
		$instance['linkURL'] = strip_tags($new_instance['linkURL']);
		return $instance;
	}
    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'title'=>'Main Title', 
		'subtitle'=>'', 
		'service'=>'',
		'linkURL'=>'#',
		'imageSrc' => '',
		'window_target'=> true,
		'is_template_path'=> true) );			
		$title = esc_attr($instance['title']);	
		$subtitle = esc_attr($instance['subtitle']);	
		$service = esc_attr($instance['service']);
		$imageSrc = esc_attr($instance['imageSrc']);		
		$linkURL = esc_attr($instance['linkURL']);
		$window_target =  esc_attr($instance['window_target']); 
		$is_template_path =  esc_attr($instance['is_template_path']); 
		?>
		<p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'templatemela'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
		</p>
		
		<p><label for="<?php echo $this->get_field_id('subtitle');?>"><?php _e('Subtitle:', 'templatemela'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('subtitle');?>" name="<?php echo $this->get_field_name('subtitle');?>" type="text" value="<?php echo $subtitle;?>" />
		</p>
		
		<p><label for="<?php echo $this->get_field_id('service');?>"><?php _e('Description:', 'templatemela'); ?></label>
		<textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('service');?>" name="<?php echo $this->get_field_name('service');?>" ><?php echo $service;?></textarea>
		</p>
		<p><label for="<?php echo $this->get_field_id('imageSrc');?>"><?php _e('Image URL:', 'templatemela'); ?></label>
		  <input class="widefat" id="<?php echo $this->get_field_id('imageSrc');?>" name="<?php echo $this->get_field_name('imageSrc');?>" type="text" value="<?php echo $imageSrc;?>" />
		  <input class="checkbox" type="checkbox" <?php checked($instance['is_template_path'], true) ?> id="<?php echo $this->get_field_id('is_template_path'); ?>" name="<?php echo $this->get_field_name('is_template_path'); ?>" />
		  <label for="<?php echo $this->get_field_id('is_template_path'); ?>"><?php _e('Use Template Path for Image', 'templatemela'); ?></label>
		</p>

		<p><label for="<?php echo $this->get_field_id('linkURL');?>"><?php _e('Link URL:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL');?>" name="<?php echo $this->get_field_name('linkURL');?>" type="text" value="<?php echo $linkURL;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['window_target'], true) ?> id="<?php echo $this->get_field_id('window_target'); ?>" name="<?php echo $this->get_field_name('window_target'); ?>" /><label for="<?php echo $this->get_field_id('window_target'); ?>"><?php _e('Open Link In New Window', 'templatemela'); ?></label></p>	
				

		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("StaticTextWidget");'));
?>
