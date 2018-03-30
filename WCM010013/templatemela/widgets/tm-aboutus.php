<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 */
?><?php  // Reference:  http://codex.wordpress.org/Widgets_API
class AboutusWidget extends WP_Widget
{
    function AboutusWidget(){
		$widget_settings = array('description' => 'About Us Widget', 'classname' => 'widgets-aboutus');
		parent::__construct(false,$name='TM - About Us Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'About Me' : $instance['title']);
		$is_template_path = isset($instance['is_template_path']) ? $instance['is_template_path'] : false;
        $window_target = isset($instance['window_target']) ? $instance['window_target'] : false;
		$imageSrc = empty($instance['imageSrc']) ? '' : $instance['imageSrc'];
		$description = empty($instance['description']) ? '' : $instance['description']; 
		$link_text = empty($instance['link_text']) ? '' : $instance['link_text']; 
		$linkURL = empty($instance['linkURL']) ? '' : $instance['linkURL'];
		$display_image_in = empty( $instance['display_image_in'] ) ? '&nbsp;' : $instance['display_image_in']; 
		if($is_template_path == 1):
			$imageSrc= get_template_directory_uri() . '/images/megnor/' . $imageSrc; 
		endif;		
		echo $before_widget;
		echo $before_title ;		
		 ?>
		 <div class="tm_aboutus"> 
		 
		 <?php if ( $display_image_in == 'left' ){  
		 $imageDiv = 'float:left;margin-right:50px;';
		 $contentDiv = 'float:right';
		 } else { 
		 $imageDiv = 'float:right;margin-left:50px;';
		 $contentDiv = 'float:left';	
		 } 
		 ?>
		 
		<div class="aboutus_imagecontent animated" data-animated="fadeInLeft" style="<?php echo $imageDiv; ?>;opacity:0">
			<a href="<?php echo $linkURL;?>" title="<?php echo $title;?>" <?php if($window_target == true) echo 'target="_blank"'; ?>> <img src="<?php echo $imageSrc; ?>" id="<?php echo $title;?>" alt="" title="<?php echo $title;?>" /> </a>
		</div>
		
		<div class="tm_aboutus_content" style="<?php echo $contentDiv;?>">
			 <?php 
				if($title) : ?>
				<h1 class="aboutus_title"><?php echo $title; ?></h1>
				<?php endif; 
			 ?>
			 <div class="tm_about_desc">
				 <?php if(strlen($description) > 250) { 
					echo substr(wpautop($description), 0, 250) . '..';
					}else {echo wpautop($description); } 
				 ?>
			</div>	
			<div class="aboutus_readmore">
				<a href="<?php echo $linkURL; ?>" title="<?php echo $link_text; ?>"><?php echo $link_text; ?></a>
			</div>			
		</div>
							
		</div>
		<?php
		echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['window_target'] = false;
		$instance['is_template_path'] = true;
		if (isset($new_instance['window_target'])) $instance['window_target'] = true;
		if (isset($new_instance['is_template_path'])) $instance['is_template_path'] = true;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['imageSrc'] = strip_tags($new_instance['imageSrc']);
		$instance['description'] = strip_tags($new_instance['description']);
		$instance['link_text'] = strip_tags($new_instance['link_text']);
		$instance['linkURL'] = strip_tags($new_instance['linkURL']);
		$instance['display_image_in'] = ( $new_instance['display_image_in'] );		
		return $instance;
	}
    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'title'=>'Learn at your pace', 
		'description'=>'Description', 
		'window_target' => true, 
		'is_template_path' => true, 
		'imageSrc'=>'featureimage1.jpg', 
		'linkURL'=>'#',  
		'link_text'=>'About us',
		'display_image_in' => 'left'
		));
		$title = esc_attr($instance['title']);
		$imageSrc = esc_attr($instance['imageSrc']);
		$description = esc_attr($instance['description']);
		$link_text = esc_attr($instance['link_text']);
		$linkURL = esc_attr($instance['linkURL']);
		$display_image_in = esc_attr($instance['display_image_in']);
		?>
		
		
		<p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'templatemela'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
		</p>
		
		<p><label for="<?php echo $this->get_field_id('description');?>"><?php _e('Description:', 'templatemela'); ?></label>
			<textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('description');?>" name="<?php echo $this->get_field_name('description');?>" ><?php echo $description;?></textarea>
		</p>
		
		<p><label for="<?php echo $this->get_field_id('link_text');?>"><?php _e('Link Text:', 'templatemela'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('link_text');?>" name="<?php echo $this->get_field_name('link_text');?>" type="text" value="<?php echo $link_text;?>" />
		</p>
		<p><label for="<?php echo $this->get_field_id('linkURL');?>"><?php _e('Link URL:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL');?>" name="<?php echo $this->get_field_name('linkURL');?>" type="text" value="<?php echo $linkURL;?>" />
		<label>(e.g. http://www.Google.com/...)</label>
		<p>
		<label for="<?php echo $this->get_field_id('imageSrc');?>"><?php _e('Image URL:', 'templatemela'); ?><br />
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id('imageSrc');?>" name="<?php echo $this->get_field_name('imageSrc');?>" type="text" value="<?php echo $imageSrc;?>" />
		<br />
		<input class="checkbox" type="checkbox" <?php checked($instance['is_template_path'], true) ?> id="<?php echo $this->get_field_id('is_template_path'); ?>" name="<?php echo $this->get_field_name('is_template_path'); ?>" />
		<label for="<?php echo $this->get_field_id('is_template_path'); ?>"><?php _e('Use Template Path for Image', 'templatemela'); ?></label>
		</p>
		<p>
<label for="<?php echo $this->get_field_id('display_image_in'); ?>"><?php _e('Display Image in:', 'templatemela'); ?></label>
 <select id="<?php echo $this->get_field_id( 'display_image_in' ); ?>" name="<?php echo $this->get_field_name( 'display_image_in' ); ?>" class="widefat">
            <option <?php if ( 'left' == $instance['display_image_in'] ) echo 'selected="selected"'; ?> value="left">Left</option>
    <option <?php if ( 'right' == $instance['display_image_in'] ) echo 'selected="selected"'; ?> value="right">Right</option>
            </select>
</p>


		<br />
		
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("AboutusWidget");'));
// end AboutusWidget
?>