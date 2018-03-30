<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 */
?><?php  // Reference:  http://codex.wordpress.org/Widgets_API
class StaticLinksWidget extends WP_Widget
{
    function StaticLinksWidget(){
		$widget_settings = array('description' => 'Static Links Widget', 'classname' => 'widgets-static-links');
		parent::__construct(false,$name='TM - Static Links Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$linktext1 = empty($instance['linktext1']) ? '' : $instance['linktext1'];
		$linktext2 = empty($instance['linktext2']) ? '' : $instance['linktext2'];
		$linktext3 = empty($instance['linktext3']) ? '' : $instance['linktext3'];
		$linktext4 = empty($instance['linktext4']) ? '' : $instance['linktext4'];
		$linktext5 = empty($instance['linktext5']) ? '' : $instance['linktext5'];		
		$linkURL1 = empty($instance['linkURL1']) ? '' : $instance['linkURL1'];
		$linkURL2 = empty($instance['linkURL2']) ? '' : $instance['linkURL2'];
		$linkURL3 = empty($instance['linkURL3']) ? '' : $instance['linkURL3'];
		$linkURL4 = empty($instance['linkURL4']) ? '' : $instance['linkURL4'];
		$linkURL5 = empty($instance['linkURL5']) ? '' : $instance['linkURL5'];
		
		echo $before_widget; 
		echo $before_title;			
		if($title)
			echo $title;
		echo $after_title; 		
		?> 
		
		<ul>
			<li>
				<div class="static-links-list">
			<?php if($linktext1) : ?>
			<span><a href="<?php if($linkURL1 == ""): echo home_url( '/' ); else:?><?php echo $linkURL1; endif;?>">
				<?php echo $linktext1;  ?></a></span>
			<?php endif; ?>	
			<?php if($linktext2) : ?>
			<span><a href="<?php if($linkURL2 == ""): echo home_url( '/' ); else:?><?php echo $linkURL2; endif;?>">
				<?php echo $linktext2;  ?></a></span>
			<?php endif; ?>	
			<?php if($linktext3) : ?>
			<span><a href="<?php if($linkURL3 == ""): echo home_url( '/' ); else:?><?php echo $linkURL3; endif;?>">
				<?php echo $linktext3;  ?></a></span>
			<?php endif; ?>	
			<?php if($linktext4) : ?>
			<span><a href="<?php if($linkURL4 == ""): echo home_url( '/' ); else:?><?php echo $linkURL4; endif;?>">
				<?php echo $linktext4;  ?></a></span>
			<?php endif; ?>
			<?php if($linktext5) : ?>
			<span><a href="<?php if($linkURL5 == ""): echo home_url( '/' ); else:?><?php echo $linkURL5; endif;?>">
				<?php echo $linktext5;  ?></a></span>
			<?php endif; ?>
						
		</div>
			</li>
		</ul>
		<?php
		echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;			
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['linktext1'] =($new_instance['linktext1']);
		$instance['linktext2'] =($new_instance['linktext2']);
		$instance['linktext3'] =($new_instance['linktext3']);
		$instance['linktext4'] =($new_instance['linktext4']);
		$instance['linktext5'] =($new_instance['linktext5']);
		
		$instance['linkURL1'] = strip_tags($new_instance['linkURL1']);
		$instance['linkURL2'] = strip_tags($new_instance['linkURL2']);
		$instance['linkURL3'] = strip_tags($new_instance['linkURL3']);
		$instance['linkURL4'] = strip_tags($new_instance['linkURL4']);
		$instance['linkURL5'] = strip_tags($new_instance['linkURL5']);		
		return $instance;
	}

    function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
		'title'=>'Our Templates',
		'linktext1'=>'Prestashop Theme',
		'linktext2'=>'Wordpress Theme',
		'linktext3'=>'Magento Theme',
		'linktext4'=>'Opencart Theme',
		'linktext5'=>'Zencart Theme',
		'linkURL'=>'#',
		'linkURL1'=>'#',
		'linkURL2'=>'#',
		'linkURL3'=>'#',
		'linkURL4'=>'#',
		'linkURL5'=>'#') );			
		$title = esc_attr($instance['title']);
		$linktext1	= esc_attr($instance['linktext1']);	
		$linktext2	= esc_attr($instance['linktext2']);
		$linktext3	= esc_attr($instance['linktext3']);
		$linktext4	= esc_attr($instance['linktext4']);
		$linktext5	= esc_attr($instance['linktext5']);
		
		$linkURL1 	= esc_attr($instance['linkURL1']);
		$linkURL2 	= esc_attr($instance['linkURL2']);
		$linkURL3 	= esc_attr($instance['linkURL3']);
		$linkURL4 	= esc_attr($instance['linkURL4']);
		$linkURL5 	= esc_attr($instance['linkURL5']);
		
		?>
		<p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'templatemela'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('linktext1');?>"><?php _e('Link Text1:', 'templatemela'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('linktext1');?>" name="<?php echo $this->get_field_name('linktext1');?>" ><?php echo $linktext1;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL1');?>"><?php _e('Link URL1:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL1');?>" name="<?php echo $this->get_field_name('linkURL1');?>" type="text" value="<?php echo $linkURL1;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		
		<p><label for="<?php echo $this->get_field_id('linktext2');?>"><?php _e('Link Text2:', 'templatemela'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('linktext2');?>" name="<?php echo $this->get_field_name('linktext2');?>" ><?php echo $linktext2;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL2');?>"><?php _e('Link URL2:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL2');?>" name="<?php echo $this->get_field_name('linkURL2');?>" type="text" value="<?php echo $linkURL2;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		
		<p><label for="<?php echo $this->get_field_id('linktext3');?>"><?php _e('Link Text3:', 'templatemela'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('linktext3');?>" name="<?php echo $this->get_field_name('linktext3');?>" ><?php echo $linktext3;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL3');?>"><?php _e('Link URL3:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL3');?>" name="<?php echo $this->get_field_name('linkURL3');?>" type="text" value="<?php echo $linkURL3;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		
		<p><label for="<?php echo $this->get_field_id('linktext4');?>"><?php _e('Link Text4:', 'templatemela'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('linktext4');?>" name="<?php echo $this->get_field_name('linktext4');?>" ><?php echo $linktext4;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL4');?>"><?php _e('Link URL4:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL4');?>" name="<?php echo $this->get_field_name('linkURL4');?>" type="text" value="<?php echo $linkURL4;?>" />
		<label>(e.g. http://www.Google.com/...)</label>	
		
		<p><label for="<?php echo $this->get_field_id('linktext5');?>"><?php _e('Link Text5:', 'templatemela'); ?></label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('linktext5');?>" name="<?php echo $this->get_field_name('linktext5');?>" ><?php echo $linktext5;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL5');?>"><?php _e('Link URL5:', 'templatemela'); ?><br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL5');?>" name="<?php echo $this->get_field_name('linkURL5');?>" type="text" value="<?php echo $linkURL5;?>" />
		<label>(e.g. http://www.Google.com/...)</label>	
		
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("StaticLinksWidget");'));
?>