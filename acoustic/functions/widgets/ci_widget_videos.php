<?php 
/**
 * Latest Videos Widget.
 */
if( !class_exists('CI_Videos') ):
class CI_Videos extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ci_videos_widget', // Base ID
			'-= CI Latest Videos =-', // Name
			array( 'description' => __( 'Display your latest videos', 'ci_theme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$videos_no = $instance['videos_no'];

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
		$latest_videos = new WP_Query( array( 
			'post_type' => 'cpt_videos',
			'posts_per_page' => $videos_no
		));

		$i = 1; 

		while ( $latest_videos->have_posts() ) : $latest_videos->the_post();

			global $post;
			$video_url = get_post_meta($post->ID, 'ci_cpt_videos_url', true);
			$video_type = get_post_meta($post->ID, 'ci_cpt_videos_self', true);

			?>
			<div class="media-block widget-content">
				<a href="<?php if ($video_type == 1): echo "#player" . $i . "-wrap"; else: echo esc_url($video_url); endif; ?>" data-rel="pp_video">
					<span class="media-act"></span>	
					<?php the_post_thumbnail('ci_featured'); ?>
				</a>
				<div class="album-info">
					<h4 class="pair-title"><?php the_title(); ?></h4>
					<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','ci_theme'); ?></a>
				</div>
				<?php if ($video_type == 1): ?>
					<div id="player<?php echo $i; ?>-wrap" class="video-player hidden">
						<video width="480" height="360" src="<?php echo esc_url($video_url); ?>" controls="controls" preload="none"></video>
					</div><!-- /player-wrapp -->
				<?php endif; ?>
			</div><!-- widget-content -->
			<?php

			$i++;
		endwhile;

		wp_reset_postdata();

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['videos_no'] = absint( $new_instance['videos_no'] );
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'videos_no' => 3
		));
		extract($instance);

		echo '<p><label for="'.$this->get_field_id('title').'">' . __('Title:', 'ci_theme') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" class="widefat" /></p>';
		echo '<p><label for="'.$this->get_field_id('videos_no').'">' . __('Videos Number:', 'ci_theme') . '</label><input id="' . $this->get_field_id('videos_no') . '" name="' . $this->get_field_name('videos_no') . '" type="text" value="' . esc_attr($videos_no) . '" class="widefat" /></p>';
	} // form

} // class CI_videos

register_widget('CI_Videos');

endif; // !class_exists
?>