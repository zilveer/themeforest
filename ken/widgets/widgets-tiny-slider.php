<?php

/*
	TESTIMONIAL WIDGET
*/

class Artbees_Widget_Tiny_Slider extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'tiny_slider_widget', 'description' => 'Small Slider with swipe capability' );
		WP_Widget::__construct( 'tiny_slider_widget', THEME_SLUG.' - '.'Tiny Slider', $widget_ops );

	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$count = (int)$instance["count"];
		$random = rand( 0, 999999 );
		$width = (int)$instance["width"];
		$height = (int)$instance["height"];

		$output = '<div class="mk-image-slideshow" style="max-width:' . $width . 'px;max-height:'.$height.'px"><div id="mk-swiper-'.$id.'" data-freeModeFluid="true" data-loop="true" data-slidesPerView="1" data-pagination="false" data-freeMode="false" data-mousewheelControl="false" data-direction="horizontal" data-slideshowSpeed="5000" data-animationSpeed="600" data-directionNav="true" class="mk-swiper-container mk-swiper-slider ">';
		$output .= '<div class="mk-swiper-wrapper">';

		if ( $count > 0 ) {

			for ( $i=1; $i<=$count; $i++ ) {
				$src =  isset( $instance["src_".$i] ) ? $instance["src_".$i] : '';
				$image_src = bfi_thumb( $src, array('width' => $width, 'height' => $height, 'crop'=>true));

				$output .= '<div class="swiper-slide">';
				$output .= '<img width="'.$width.'" height="'.$height.'" height="80" alt="'.get_the_title().'" src="' . $image_src .'" />';
				$output .= '</div>' . "\n\n";

			}
		}
		$output .= '</div>';
		$output .= '<a class="mk-swiper-prev slideshow-swiper-arrows"><i class="mk-theme-icon-prev-big"></i></a>';
		$output .= '<a class="mk-swiper-next slideshow-swiper-arrows"><i class="mk-theme-icon-next-big"></i></a>';
		$output .= '</div></div>';




		if ( !empty( $output ) ) {
			echo $before_widget;

?>
            <?php

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
		$width = isset( $instance['width'] ) ? absint( $instance['width'] ) : 250;
		$height = isset( $instance['height'] ) ? absint( $instance['height'] ) : 250;
		for ( $i=1;$i<=10;$i++ ) {
			$src = 'src_'.$i;
			$$src = isset( $instance[$src] ) ? $instance[$src] : '';
		}


?>

		<p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        	<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of Sliders</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'width' ); ?>">Image Width</label>
		<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo $width; ?>" size="4" /></p>

		<p><label for="<?php echo $this->get_field_id( 'height' ); ?>">Image Height</label>
		<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $height; ?>" size="4" /></p>

		<div class="social_custom_icon_wrap" style="padding-top:30px">
		<?php for ( $i=1;$i<=10;$i++ ): $src = 'src_'.$i; ?>
		<div class="social_icon_custom_<?php echo $i;?>" <?php if ( $i>$count ):?>style="display:none;"<?php endif;?>>


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
/***************************************************/
