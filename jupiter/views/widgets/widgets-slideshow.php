<?php

class Artbees_Widget_Slideshow extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_mini_slidshow', 'description' => 'Displays a mini slideshow.' );
		WP_Widget::__construct( 'mini_slidshow_widget', THEME_SLUG.' - '.'Mini Slideshow', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Mini Slideshow' : $instance['title'], $instance, $this->id_base );
		$count = (int)$instance["count"];
		$width = (int)$instance["width"];
		$height = (int)$instance["height"];
		$random = uniqid();

		$slider_atts[] = 'data-animation="fade"';
		$slider_atts[] = 'data-easing="swing"';
		$slider_atts[] = 'data-smoothHeight="false"'; 
		$slider_atts[] = 'data-slideshowSpeed="7000"'; 
		$slider_atts[] = 'data-animationSpeed="400"'; 
		$slider_atts[] = 'data-pauseOnHover="true"'; 
		$slider_atts[] = 'data-controlNav="true"'; 
		$slider_atts[] = 'data-directionNav="true"'; 
		

		$output = '<div class="mk-widget-mini-slideshow mk-flexslider js-flexslider" id="slider_' . $random . '"  '. implode(' ', $slider_atts) .'><ul class="mk-flex-slides">';
		if ( $count > 0 ) {
			for ( $i=1; $i<=$count; $i++ ) {
				$src =  isset( $instance["src_".$i] ) ? $instance["src_".$i] : '';
				$image_src = Mk_Image_Resize::resize_by_url_adaptive($src, $width, $height, $crop = true, $dummy = true);
				$output .= '<li>';
				$output .= '<img alt="Slide" src="'.$image_src['dummy'].'" '.$image_src['data-set'].' width="'.$width.'" height="'.$height.'" />';
				$output .= '</li>';
			}
		}
		$output .= "</ul></div>";

		if ( !empty( $output ) ) {
			echo $before_widget;

			if ( $title )
				echo $before_title . $title . $after_title;
			echo $output;
			echo $after_widget;
		}

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['count'] = (int)$new_instance['count'];
		$instance['width'] = (int)$new_instance['width'];
		$instance['height'] = (int)$new_instance['height'];
		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["src_".$i] = isset( $new_instance['src_'.$i] ) ? strip_tags( $new_instance['src_'.$i] ) : ' ';
		}

		return $instance;
	}


	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
		$width = isset( $instance['width'] ) ? absint( $instance['width'] ) : 300;
		$height = isset( $instance['height'] ) ? absint( $instance['height'] ) : 260;
		for ( $i=1;$i<=10;$i++ ) {
			$src = 'src_'.$i;
			$$src = isset( $instance[$src] ) ? $instance[$src] : '';
		}
?>

		<p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Image width', 'mk_framework'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo $width; ?>" size="3" />
		</p>

		 <p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Image height', 'mk_framework'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $height; ?>" size="3" />
		 </p>


		 <p>
			 <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('How many slides?', 'mk_framework'); ?></label>
			 <input id="<?php echo $this->get_field_id( 'count' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" />
		 </p>


		<div class="social_custom_icon_wrap" style="margin-top:50px;">
			<?php for ( $i=1;$i<=10;$i++ ): $src = 'src_'.$i; ?>
			<div class="social_icon_custom_<?php echo $i;?>" <?php if ( $i>$count ):?>style="display:none;"<?php endif;?> style="padding-bottom:10px">
				<p>
					<label for="<?php echo $this->get_field_id( $src ); ?>"><?php printf( '#%s Image URL:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $src ); ?>" name="<?php echo $this->get_field_name( $src ); ?>" type="text" value="<?php echo $$src; ?>" />
				</p>
			</div>
		<?php endfor;?>
		</div>
	<?php
	}
}
 register_widget("Artbees_Widget_Slideshow");
