<?php
class MthemeAuthors extends WP_Widget {

	//Widget Setup
	function __construct() {
		$widget_ops=array('classname' => 'widget-users', 'description' => __('Selected blog authors', 'mtheme'));
		parent::__construct('blog-authors', __('Blog Authors','mtheme'), $widget_ops);
		$this->alt_option_name='widget_blog_authors';
	}

	//Widget View
	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);
		$instance=wp_parse_args((array)$instance, array(
			'title' => __('Blog Authors', 'mtheme'),
			'number' => '6',
			'order' => 'registered',
		));
		
		$orderdir='DESC';
		if($instance['order']=='display_name') {
			$orderdir='ASC';
		}
				
		$title=apply_filters( 'widget_title', empty($instance['title'])?__('Blog Authors', 'mtheme'):$instance['title'], $instance, $this->id_base);
		
		$out=$before_widget;
		$out.=$before_title.$title.$after_title;
		
		$counter=0;
		$users=get_users(array(
			'number' => $instance['number'],
			'orderby' => $instance['order'],
			'order' => $orderdir,
		));
		
		$out.='<div class="users-listing">';
		foreach($users as $user) {
			$name=trim($user->first_name.' '.$user->last_name);
			$counter++;
			
			$out.='<div class="user-image ';
			if($counter==3){
				$out.='last';
			}
			$out.='"><div class="bordered-image">';
			$out.='<a title="'.$name.'" href="'.get_author_posts_url($user->ID).'">'.get_avatar($user->ID).'</a>';
			$out.='</div></div>';
			
			if($counter==3) {
				$out.='<div class="clear"></div>';
				$counter=0;
			}
		}
		$out.='</div>';
		
		$out.=$after_widget;
		echo $out;
	}

	//Update Widget
	function update($new_instance, $old_instance) {
		$instance=$old_instance;
		$instance['title']=$new_instance['title'];
		$instance['number']=intval($new_instance['number']);
		$instance['order']=strip_tags($new_instance['order']);
		
		return $instance;
	}
	
	//Widget Form
	function form($instance) {
		$instance=wp_parse_args( (array)$instance, array(
			'number'=>'6',
			'order'=>'registered',
			'title' => '',
		));
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'mtheme'); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number', 'mtheme'); ?>:</label>
			<input class="widefat" type="number" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', 'mtheme'); ?>:</label>
			<?php 
			echo MthemeInterface::renderOption(array(
				'id' => $this->get_field_name('order'),
				'type' => 'select',
				'value' => $instance['order'],
				'wrap' => false,
				'options' => array(
					'registered' => __('Date', 'mtheme'),
					'display_name' => __('Name', 'mtheme'),		
					'post_count' => __('Activity', 'mtheme'),	
				),
				'attributes' => array(
					'class' => 'widefat',
				),
			));
			?>
		</p>
	<?php
	}
}