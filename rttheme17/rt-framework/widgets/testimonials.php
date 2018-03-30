<?php
#
# RT-Theme Testimonials
#

class Testimonials extends WP_Widget {

	function Testimonials() {
		$opts =array(
					'classname' 	=> 'widget_testimonials',
					'description' 	=> __( 'Use this widget to display your testimonials.', 'rt_theme_admin' )
				);

		parent::__construct('testimonials', '['. THEMENAME.']   '.__('Testimonials', 'rt_theme_admin'), $opts);
	}
	

	function widget( $args, $instance ) {
		extract( $args );
		
		$title			=	apply_filters('widget_title', $instance['title']) ;		 
		$testimonial	=	wpml_t( THEMESLUG , 'Testimonial', $instance['testimonial'] );
		$from			=	wpml_t( THEMESLUG , 'From', $instance['from'] ); 
		$addClass		=  "";
 		if(empty($title)){
 				$addClass="notitle";
 		}
		//Content
 		$content = '<blockquote class="testimonial '.$addClass.'"><p>';

		if(!empty($testimonial)) 		$content .= '<span class="mark-first"></span>'.$testimonial.'<span class="mark-last"></span>';
		if(!empty($from))				$content .= '<span class="author">— '.$from.'</span>'; 
		
		$content .= '</p></blockquote>';
		 

		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		echo $content;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		 
		$instance = $old_instance;
		$instance['title']			= strip_tags($new_instance['title']);  
		$instance['testimonial']	= strip_tags($new_instance['testimonial']);	
		$instance['from']			= strip_tags($new_instance['from']); 
		
		wpml_register_string( THEMESLUG , 'Testimonial', strip_tags($new_instance['testimonial']) ) ;
		wpml_register_string( THEMESLUG , 'From', strip_tags($new_instance['from']) ) ; 		

		return $instance;
	}

	function form( $instance ) {
		$title 			= 	isset($instance['title']) ? esc_attr($instance['title']) : '';
		$testimonial 	= 	isset($instance['testimonial']) ? esc_attr($instance['testimonial']) : '';
		$from 			= 	isset($instance['from']) ? esc_attr($instance['from']) : ''; 
		
		// Categories
		$rt_getcat = RTTheme::rt_get_categories();
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
 
		<p><label for="<?php echo $this->get_field_id('testimonial'); ?>"><?php _e('Testimonial:', 'rt_theme_admin'); ?></label>
		
		<textarea class="widefat" id="<?php echo $this->get_field_id('testimonial'); ?>" name="<?php echo $this->get_field_name('testimonial'); ?>"><?php echo $testimonial; ?></textarea>
		</p>

		<p><label for="<?php echo $this->get_field_id('from'); ?>"><?php _e('From:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('from'); ?>" name="<?php echo $this->get_field_name('from'); ?>" type="text" value="<?php echo $from; ?>" /></p>

<?php } } ?>