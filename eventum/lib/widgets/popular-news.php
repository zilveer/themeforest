<?php

add_action('widgets_init','register_themeum_popular_posts_widget');

function register_themeum_popular_posts_widget(){
	register_widget('themeum_popular_posts_widget');
}

class themeum_popular_posts_widget extends WP_Widget{

	function themeum_popular_posts_widget(){
		parent::__construct( 'themeum_popular_posts_widget','Popular News',array('description' => 'Themeum Popular News(Short by Number of views)'));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget($args, $instance){

		extract($args);

		$title 			= apply_filters('widget_title', $instance['title'] );
		$count 			= $instance['count'];
		
		//echo ;

		$output = '';

		if ( $title )
			echo $before_title . $title . $after_title;

		global $post;


		$args = array(
				'post_type' => 'post',
				'meta_key' => '_post_views_count',
    			'orderby' => 'meta_value_num',
		        'order' => 'DESC',
			);
		$posts = get_posts( $args );



		if(count($posts)>0){
			$output .='<div class="widget-popular-news">';

			foreach ($posts as $post): setup_postdata($post);
				$output .='<div class="media">';

					if(has_post_thumbnail()):
						$output .= '<div class="pull-left">';
						$output .='<a href="'.get_permalink().'">'.get_the_post_thumbnail( get_the_ID(), 'x-blog-small', array('class' => 'img-responsive')).'</a>';
						$output .='</div>';
					endif;
					$output .= '<div class="media-body"><a href="'.get_permalink().'">'. get_the_title() .'</a></div>';

				$output .='</div>';
			endforeach;
			wp_reset_postdata();

			$output .='</div>';
		}


		echo $before_widget.$output.$after_widget;

	}


	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['count'] 			= strip_tags( $new_instance['count'] );
		return $instance;
	}


	function form($instance){
		$defaults = array( 
			'title' 	=> 'Popular News',
			'order_by' 	=> 'popular',
			'count' 	=> 5
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title', 'eventum'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php esc_html_e('Number of Post', 'eventum'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($instance['count']); ?>" style="width:100%;" />
		</p>

	<?php
	}
}