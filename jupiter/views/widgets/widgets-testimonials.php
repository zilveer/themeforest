<?php

class Artbees_Widget_Testimonials extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_testimonials', 'description' => 'Displays a testimonail slider.' );
		WP_Widget::__construct( 'testimonial_widget', THEME_SLUG.' - '.'Testimonial', $widget_ops );


	}


	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Testimonial' : $instance['title'], $instance, $this->id_base );
		$count = (int)$instance["count"];
		$random = rand( 0, 999999 );
		$output = '<div class="testimonial-slider mk-flexslider js-flexslider" data-directionNav="true" id="testimonial_slider_' . $random . '"><ul class="mk-flex-slides">';
		if ( $count > 0 ) {

			for ( $i=1; $i<=$count; $i++ ) {
				$image_src = '';
				$quote =  isset( $instance["quote_".$i] ) ? $instance["quote_".$i] : '';
				$company =  isset( $instance["company_".$i] ) ? $instance["company_".$i]:'';
				$position =  isset( $instance["position_".$i] ) ? $instance["position_".$i]:'';
				$url =  isset( $instance["url_".$i] ) ? $instance["url_".$i]:'';
				$src =  isset( $instance["src_".$i] ) ? $instance["src_".$i]:'';
				if(!empty($src)) {
					$image_src = Mk_Image_Resize::resize_by_url_adaptive($src, 50, 50, $crop = true, $dummy = false);
				}
				
				$output .= '<li>';
				$output .= '<div class="testimonial-quote"><span>' . $quote . '</span></div>';
				if(!empty($image_src['default'])) {
					$output .= '<img class="testimonial-author-image" width="50" hieght="50" src="'.$image_src['dummy'].'" '.$image_src['data-set'].' alt="' . $company  . '" />';
				}
				$output .= '<a class="testimonial-author" target="_blank" href="' . $url .'">' . $company  . '</a>';
				$output .= '<span class="testimonial-position">'.$position.'</span></li>';

			}
		}

		$output .= "</ul></div>";

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
		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["quote_".$i] = isset( $new_instance['quote_'.$i] ) ? strip_tags( $new_instance['quote_'.$i] ) : ' ';
			$instance["company_".$i] =  isset( $new_instance['company_'.$i] ) ? strip_tags( $new_instance['company_'.$i] ) : '';
			$instance["position_".$i] =  isset( $new_instance['position_'.$i] ) ? strip_tags( $new_instance['position_'.$i] ) : '';
			$instance["url_".$i] = isset( $new_instance['url_'.$i] ) ? strip_tags( $new_instance['url_'.$i] ) : '';
			$instance["src_".$i] = isset( $new_instance['src_'.$i] ) ? strip_tags( $new_instance['src_'.$i] ) : '';
		}

		return $instance;
	}


	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
		for ( $i=1;$i<=10;$i++ ) {


			$quote = 'quote_'.$i;
			$$quote = isset( $instance[$quote] ) ? $instance[$quote] : '';
			$src = 'src_'.$i;
			$$src = isset( $instance[$src] ) ? $instance[$src] : '';
			$company = 'company_'.$i;
			$$company = isset( $instance[$company] ) ? $instance[$company] : '';
			$position = 'position_'.$i;
			$$position = isset( $instance[$position] ) ? $instance[$position] : '';
			$url = 'url_'.$i;
			$$url = isset( $instance[$url] ) ? $instance[$url] : '';
		}


?>

		<p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        	<p><label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of Testimonials:', 'mk_framework'); ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>


<div class="social_custom_icon_wrap">
<?php for ( $i=1;$i<=10;$i++ ): $quote = 'quote_'.$i; $company = 'company_'.$i; $position = 'position_'.$i; $url = 'url_'.$i; $src = 'src_'.$i; ?>
<div class="social_icon_custom_<?php echo $i;?>" <?php if ( $i>$count ):?>style="display:none;"<?php endif;?> style="padding-bottom:30px">


<p>
<label for="<?php echo $this->get_field_id( $quote ); ?>"><?php printf( '#%s Quote:', $i );?></label>
<textarea style="width:98%" rows="6" id="<?php echo $this->get_field_id( $quote ); ?>" name="<?php echo $this->get_field_name( $quote ); ?>" ><?php echo $$quote; ?></textarea>
</p>

<p>
<label for="<?php echo $this->get_field_id( $company ); ?>"><?php printf( '#%s Company:', $i );?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $company ); ?>" name="<?php echo $this->get_field_name( $company ); ?>" type="text" value="<?php echo $$company; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( $src ); ?>"><?php printf( '#%s Author Image URL:', $i );?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $src ); ?>" name="<?php echo $this->get_field_name( $src ); ?>" type="text" value="<?php echo $$src; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( $url ); ?>"><?php printf( '#%s Author Website URL:', $i );?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $url ); ?>" name="<?php echo $this->get_field_name( $url ); ?>" type="text" value="<?php echo $$url; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( $position ); ?>"><?php printf( '#%s Position:', $i );?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $position ); ?>" name="<?php echo $this->get_field_name( $position ); ?>" type="text" value="<?php echo $$position; ?>" />
</p>
			</div>

		<?php endfor;?>
		</div>



	<?php
	}
}

register_widget("Artbees_Widget_Testimonials");
