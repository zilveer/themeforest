<?php 

add_action('widgets_init','mom_fb_likebox_widget');

function mom_fb_likebox_widget() {
	register_widget('mom_fb_likebox_widget');
	
	}

class mom_fb_likebox_widget extends WP_Widget {
	function mom_fb_likebox_widget() {
			
		$widget_ops = array('classname' => 'momizat-facebook');

		parent::__construct('momizatFacebook',__('Effective - Facebook Likebox','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$width = $instance['width'];
		$height = $instance['height'];
		$color = $instance['color'];
		$faces = $instance['faces'];
		$stream = $instance['stream'];
		$header = $instance['header'];
		$background = $instance['background'];
		$borderc = $instance['borderc'];
		$page = $instance['page'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
                <div class="mom_facebook_likebox" style="<?php
			if($background != '') {
				echo 'background:'.$background.';';
			}
			if($borderc != '') {
				echo 'border:1px solid '.$borderc.';';
			}
		?>">
<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $page ; ?>&amp;width=<?php echo $width ; ?>&amp;height=<?php echo $height; ?>&amp;colorscheme=<?php echo $color; ?>&amp;show_faces=<?php if($faces != 'on') {echo 'false';}else{echo 'true';} ?>&amp;show_border=false&amp;stream=<?php if($stream != 'on') {echo 'false';}else{echo 'true';} ?>&amp;header=<?php if($header != 'on') {echo 'false';}else{echo 'true';} ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>

</div><!--like_box_footer-->

<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['color'] = $new_instance['color'];
		$instance['faces'] = $new_instance['faces'];
		$instance['stream'] = $new_instance['stream'];
		$instance['header'] = $new_instance['header'];
		$instance['background'] = $new_instance['background'];
		$instance['borderc'] = $new_instance['borderc'];
		$instance['page'] = $new_instance['page'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Facebook','theme'),
			'page' => 'http://www.facebook.com/ThemeLions',
			'width' => 263,
			'height' => 258,
			'faces' => 'on',
			'stream' => '',
			'header' => '',
			'background' => '#fff',
			'borderc' => '#e5e5e5',
			'color' => 'light'
			
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'theme') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

    	<p>
		<label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php _e('Facebook Page URL:', 'theme') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'page' ); ?>" name="<?php echo $this->get_field_name( 'page' ); ?>" value="<?php echo $instance['page']; ?>"  class="widefat" />
		</p>
        

    	<p>
		<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:', 'theme') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>"  class="widefat" />
		</p>

    	<p>
		<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'theme') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e('Color Scheme', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" class="widefat">
		<option value="light" <?php if ( 'light' == $instance['color'] ) echo 'selected="selected"'; ?>><?php _e('Light', 'theme'); ?></option>
		<option value="dark" <?php if ( 'dark' == $instance['color'] ) echo 'selected="selected"'; ?>><?php _e('Dark', 'theme'); ?></option>
		</select>
		</p>

		
    	<p>
		<label for="<?php echo $this->get_field_id( 'background' ); ?>"><?php _e('Background Color:', 'theme') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'background' ); ?>" name="<?php echo $this->get_field_name( 'background' ); ?>" value="<?php echo $instance['background']; ?>"  class="widefat" />
		</p>
    	<p>
		<label for="<?php echo $this->get_field_id( 'borderc' ); ?>"><?php _e('Box border Color:', 'theme') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'borderc' ); ?>" name="<?php echo $this->get_field_name( 'borderc' ); ?>" value="<?php echo $instance['borderc']; ?>"  class="widefat" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['faces'], 'on' ); ?> id="<?php echo $this->get_field_id( 'faces' ); ?>" name="<?php echo $this->get_field_name( 'faces' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'faces' ); ?>"><?php _e('Show faces', 'theme'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['stream'], 'on' ); ?> id="<?php echo $this->get_field_id( 'stream' ); ?>" name="<?php echo $this->get_field_name( 'stream' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'stream' ); ?>"><?php _e('Show stream', 'theme'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['header'], 'on' ); ?> id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'header' ); ?>"><?php _e('Show header', 'theme'); ?></label>
		</p>

	
   <?php 
}
	} //end class