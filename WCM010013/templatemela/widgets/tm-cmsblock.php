<?php
/**

 * TemplateMela

 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)

 * @license    http://www.templatemela.com/license/

 */
?><?php  // Reference:  http://codex.wordpress.org/Widgets_API

class CMSBlockWidget extends WP_Widget
{
    function CMSBlockWidget(){
		$widget_settings = array('description' => 'Header CMS Block Widget', 'classname' => 'widgets-cms');
		parent::__construct(false,$name='TM - Header CMS Block Widget',$widget_settings);
    }
    function widget($args, $instance){

		extract($args);
		$window_target1 = isset($instance['window_target1']) ? $instance['window_target1'] : false;
		$window_target2 = isset($instance['window_target2']) ? $instance['window_target2'] : false;
		$window_target3 = isset($instance['window_target3']) ? $instance['window_target3'] : false;
		
		$main_title = empty($instance['main_title']) ? '' : $instance['main_title']; 
		$main_title_2 = empty($instance['main_title_2']) ? '' : $instance['main_title_2']; 
		$main_title_3 = empty($instance['main_title_3']) ? '' : $instance['main_title_3'];  	
		
		$linkURL1 = empty($instance['linkURL1']) ? '' : $instance['linkURL1'];
		$linkURL2 = empty($instance['linkURL2']) ? '' : $instance['linkURL2'];
		$linkURL3 = empty($instance['linkURL3']) ? '' : $instance['linkURL3'];
		
		echo $before_widget;
		 ?>

		 <div class="header_banner">
		 	<ul>
				<li class="shipping"> <a href="<?php if($linkURL1 == ""): echo home_url( '/' ); else:?><?php echo $linkURL1; endif;?>" <?php if($window_target1 == true) echo 'target="_blank"'; ?> > <?php echo $main_title ?> </a> </li>
				<li class="Money"> <a href="<?php if($linkURL2 == ""): echo home_url( '/' ); else:?><?php echo $linkURL2; endif;?>" <?php if($window_target2 == true) echo 'target="_blank"'; ?> ><?php echo $main_title_2 ?> </a></li>
				<li class="Offer"> <a href="<?php if($linkURL3 == ""): echo home_url( '/' ); else:?><?php echo $linkURL3; endif;?>" <?php if($window_target3 == true) echo 'target="_blank"'; ?> > <?php echo $main_title_3 ?> </a></li>
			</ul>
		 </div>

		<?php

		echo $after_widget;					

	}

    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['window_target1'] = false;
		$instance['window_target2'] = false;
		$instance['window_target3'] = false;
		$instance['is_template_path'] = false;
		if (isset($new_instance['window_target1'])) $instance['window_target1'] = true;
		if (isset($new_instance['window_target2'])) $instance['window_target2'] = true;
		if (isset($new_instance['window_target3'])) $instance['window_target3'] = true;
		
		$instance['main_title'] = strip_tags($new_instance['main_title']);
		$instance['main_title_2'] = strip_tags($new_instance['main_title_2']);
		$instance['main_title_3'] = strip_tags($new_instance['main_title_3']);
		
		$instance['linkURL1'] = strip_tags($new_instance['linkURL1']);
		$instance['linkURL2'] = strip_tags($new_instance['linkURL2']);
		$instance['linkURL3'] = strip_tags($new_instance['linkURL3']);
		return $instance;
	}

    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'main_title'=>' Free Shipping On All Products ', 
		'main_title_2'=>'Money Back Guarantee ', 
		'main_title_3'=>' Special weekly Offer ', 
		'linkURL1'=>'#',
		'linkURL2'=>'#',
		'linkURL3'=>'#',
		'window_target1'=>false,
		'window_target2'=>false,
		'window_target3'=>false,
		) );
		
		$main_title = esc_attr($instance['main_title']);
		$main_title_2 = esc_attr($instance['main_title_2']);
		$main_title_3 = esc_attr($instance['main_title_3']);
		
		$linkURL1 = esc_attr($instance['linkURL1']);
		$linkURL2 = esc_attr($instance['linkURL2']);
		$linkURL3 = esc_attr($instance['linkURL3']);
		
		
		
		
	?>
		
		
		
		<p><label for="<?php echo $this->get_field_id('main_title');?>">Main Title1:</label>
			<textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('main_title');?>" name="<?php echo $this->get_field_name('main_title');?>" ><?php echo $main_title;?></textarea>
		</p>
		<p><label for="<?php echo $this->get_field_id('linkURL1');?>">Link URL1:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL1');?>" name="<?php echo $this->get_field_name('linkURL1');?>" type="text" value="<?php echo $linkURL1;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['window_target1'], true) ?> id="<?php echo $this->get_field_id('window_target1'); ?>" name="<?php echo $this->get_field_name('window_target1'); ?>" /><label for="<?php echo $this->get_field_id('window_target1'); ?>">Open Link In New Window</label></p>		
		<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
		
		<p><label for="<?php echo $this->get_field_id('main_title_2');?>">Main Title2:</label>
			<textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('main_title_2');?>" name="<?php echo $this->get_field_name('main_title_2');?>" ><?php echo $main_title_2;?></textarea>
		</p>
		<p><label for="<?php echo $this->get_field_id('linkURL2');?>">Link URL2:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL2');?>" name="<?php echo $this->get_field_name('linkURL2');?>" type="text" value="<?php echo $linkURL2;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['window_target2'], true) ?> id="<?php echo $this->get_field_id('window_target2'); ?>" name="<?php echo $this->get_field_name('window_target2'); ?>" /><label for="<?php echo $this->get_field_id('window_target2'); ?>">Open Link In New Window</label></p>		
		<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
		
		
		<p><label for="<?php echo $this->get_field_id('main_title_3');?>">Main Title3:</label>
			<textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('main_title_3');?>" name="<?php echo $this->get_field_name('main_title_3');?>" ><?php echo $main_title_3;?></textarea>
		</p>
		<p><label for="<?php echo $this->get_field_id('linkURL3');?>">Link URL3:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL3');?>" name="<?php echo $this->get_field_name('linkURL3');?>" type="text" value="<?php echo $linkURL3;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['window_target3'], true) ?> id="<?php echo $this->get_field_id('window_target3'); ?>" name="<?php echo $this->get_field_name('window_target3'); ?>" /><label for="<?php echo $this->get_field_id('window_target3'); ?>">Open Link In New Window</label></p>		
		<div style="border-bottom:2px solid #ddd; margin-bottom:10px;">&nbsp;</div>
		<?php

	}

}

add_action('widgets_init', create_function('', 'return register_widget("CMSBlockWidget");'));

// end CMSBlockWidget

?>