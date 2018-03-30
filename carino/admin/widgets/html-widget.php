<?php

/**
  * Html & Text Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_html_widget_init' );

function van_html_widget_init() {

	register_widget( 'van_html_widget' );

}
class van_html_widget extends WP_Widget {

	function van_html_widget() {
		$options = array( 'classname' => 'html-widget' ,'description' => 'Custom html or test' );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'html-widget' );
		$this->WP_Widget( 'html-widget','( ' .THEME_NAME .' ) - Html or text', $options, $control );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title   = apply_filters('widget_title', $instance['title'] );
		$code    = $instance['code'];
		$show_bg = $instance['show_bg'];
		$center  = $instance['center'];
		
		$center_style = ( $center ) ? 'text-align:center;width:100%;margin:0 auto;' : 'width:100%;margin:0 auto;';
		
		if( $show_bg ){
			echo "<div class=\"skip-content\">";
		}
		echo $before_widget;
		echo $before_title . $title . $after_title;
		?>
			<div class="clearfix" style="<?php echo $center_style;?> ">
				<?php echo do_shortcode( $code ) ?>
		    	</div>
		<?php
		echo $after_widget;

		if( $show_bg ){
			echo "</div><!--.skip-content-->";
		}		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['code'] = $new_instance['code'] ;
		$instance['show_bg'] = strip_tags( $new_instance['show_bg'] );
		$instance['center'] = strip_tags( $new_instance['center'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Text' , 'van') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p style="text-align:center;" ><strong>*Note:</strong> You can do shortcodes in this widget.</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title : ","van") ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_bg' ); ?>">Transparent Background :</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_bg' ); ?>" name="<?php echo $this->get_field_name( 'show_bg' ); ?>" value="true" <?php if( isset( $instance['show_bg'] ) && $instance['show_bg'] ) echo 'checked="checked"'; ?>  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'center' ); ?>">Center content :</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'center' ); ?>" name="<?php echo $this->get_field_name( 'center' ); ?>" value="true" <?php if( isset( $instance['center'] ) && $instance['center'] ) echo 'checked="checked"'; ?>  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>">Text or Html code : </label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>" class="widefat" ><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></textarea>
		</p>
	<?php
	}
}