<?php
/**
 * VideoTube Tags Cloud
 * Add Tags Cloud widget, video_key and tag taxonomy is supported.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_KeyCloud_Widgets') ){
	function Mars_KeyCloud_Widgets() {
		register_widget('Mars_KeyCloud_Widgets_Class');
	}
	add_action('widgets_init', 'Mars_KeyCloud_Widgets');
}
class Mars_KeyCloud_Widgets_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-keycloud-widgets', 'description' => __('Displays the Video tag and post tag.', 'mars') );
	
		parent::__construct( 'mars-keycloud-widgets' , __('VT Tags Cloud', 'mars') , $widget_ops);
	}	
	
	function widget($args, $instance){
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$taxonomy = !empty( $instance['taxonomy'] ) ? explode(",", $instance['taxonomy']) : array('post_tag','video_tag');
		$smallest = !empty( $instance['smallest'] ) ? absint( $instance['smallest'] ) : 8;
		$largest = !empty( $instance['largest'] ) ? absint( $instance['largest'] ) : 15;
		$number = !empty( $instance['number'] ) ? absint( $instance['number'] ) : 20;
		$tag_cloud = array(
		    'smallest'                  => $smallest, 
		    'largest'                   => $largest,
		    'unit'                      => 'pt', 
		    'number'                    => $number,  
		    'format'                    => 'flat',
		    'separator'                 => ' ',
		    'orderby'                   => 'name', 
		    'order'                     => 'ASC',
		    'exclude'                   => null, 
		    'include'                   => null, 
		    'link'                      => 'view', 
			'taxonomy'  => $taxonomy, 
		    'echo'                      => false
		);		
		print  $before_widget;
		if( !empty( $title ) ){
			print $before_title . $title . $after_title;
		}
			print wp_tag_cloud( apply_filters( 'mars_tag_cloud_value' , $tag_cloud) );
		print $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['taxonomy'] = strip_tags( $new_instance['taxonomy'] );
		$instance['smallest'] = absint( $new_instance['smallest'] );
		$instance['largest'] = absint( $new_instance['largest'] );
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Tags Cloud', 'mars'),
			'smallest'	=>	8,
			'largest'	=>	 15,
			'taxonomy'	=>	'post_tag,video_tag',
			'number'	=>	20
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e('Taxonomies:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" value="<?php echo $instance['taxonomy']; ?>" style="width:100%;" />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'smallest' ); ?>"><?php _e('Smallest Size:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'smallest' ); ?>" name="<?php echo $this->get_field_name( 'smallest' ); ?>" value="<?php echo $instance['smallest']; ?>" style="width:100%;" />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'largest' ); ?>"><?php _e('Largest Size:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'largest' ); ?>" name="<?php echo $this->get_field_name( 'largest' ); ?>" value="<?php echo $instance['largest']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
			<small><?php _e('How many tag will be shown?','mars')?></small>
		</p>		
	<?php		
	}
}

