<?php 

/**
  * Newsletter Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action('widgets_init','van_newsletter_widget_init');

function van_newsletter_widget_init() {
	register_widget('van_newsletter_widget');
	}

class van_newsletter_widget extends WP_Widget {
	function van_newsletter_widget() {
		$options = array('classname' => 'newsletter','description' => 'Widget display the Subscribe box');
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'newsletter' );
		$this->WP_Widget('newsletter','( '.THEME_NAME .' ) - Newsletter',$options,$control);
		}
		
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$feed_url = $instance['feed_url'];

		echo $before_widget;
		echo $before_title . $title . $after_title
		?>
		<div class="newsletter">
			<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feed_url; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			     <input size="35" type="text" class="nsf" name="email" value="<?php _e('Your Email', 'van'); ?>" onfocus="if(this.value=='<?php _e('Your Email', 'van'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Your Email', 'van'); ?>';"/>
			     <input type="hidden" name="loc" value="en_US"/>
				 <input type="hidden" value="<?php echo $feed_url; ?>" name="uri"/>
			     	<input type="submit"  class="nsb" value="<?php _e('Subscribe','van');?>" />
            		</form>
		</div>
		<?php 
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['feed_url'] = strip_tags($new_instance['feed_url']);
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array( 'title' => __('Subscribe to our newsletter', 'van'));
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'van'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'feed_url' ); ?>"><?php _e('feedburner name: (your name without http://feeds.feedburner.com/) ', 'van'); ?></label>
			<input id="<?php echo $this->get_field_id( 'feed_url' ); ?>" name="<?php echo $this->get_field_name( 'feed_url' ); ?>" value="<?php if( isset( $instance['feed_url'] ) ){ echo esc_attr( $instance['feed_url'] ); } ?>" class="widefat" type="text" />
		</p>
   		<?php 
	}
}