<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 */
?><?php // Reference:  http://codex.wordpress.org/Widgets_API
class FlickrWidget extends WP_Widget
{
    function FlickrWidget(){
		$widget_settings = array('description' => 'Flickr Photos Widget', 'classname' => 'widgets-flickr');
		parent::__construct(false,$name='TM - Flickr Photos Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Flickr Stream' : $instance['title']);
		$flickrid = empty($instance['flickrid']) ? '93128959@N03' : $instance['flickrid'];
		$photocount = empty($instance['photocount']) ? '6' : $instance['photocount'];
		echo $before_widget; 
		echo $before_title;
			if($title)
				echo $title;
			echo $after_title; ?>
				<div class="flickr-photos">
					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $photocount;?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickrid;?>"></script> 
				</div>	
		<?php
		echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickrid'] = strip_tags($new_instance['flickrid']);
		$instance['photocount'] = strip_tags($new_instance['photocount']);
		return $instance;
	}

    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'title'=>'Flickr Photos',
		'flickrid'=>'93128959@N03',
		'photocount'=>'6' ) );
		$title = esc_attr($instance['title']);
		$flickrid= esc_attr($instance['flickrid']);
		$photocount = esc_attr($instance['photocount']);
		?>
		<p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'templatemela'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p>
		<p><label for="<?php echo $this->get_field_id('flickrid');?>"><?php _e('ID:', 'templatemela'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('flickrid');?>" name="<?php echo $this->get_field_name('flickrid');?>" type="text" value="<?php echo $flickrid;?>" /></p>
		<p><label for="<?php echo $this->get_field_id('photocount');?>"><?php _e('No of Photo to Display:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('photocount');?>" name="<?php echo $this->get_field_name('photocount');?>" type="text" value="<?php echo $photocount;?>" />
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("FlickrWidget");'));
?>