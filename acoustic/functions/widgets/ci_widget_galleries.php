<?php 
/**
 * Latest Galleries Widget.
 */
if( !class_exists('CI_Galleries') ):
class CI_Galleries extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ci_galleries_widget', // Base ID
			'-= CI Latest Photo Galleries =-', // Name
			array( 'description' => __( 'Display your latest photo galleries', 'ci_theme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$galleries_no = $instance['galleries_no'];

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
		$latest_galleries = new WP_Query( array( 
			'post_type' => 'cpt_galleries',
			'posts_per_page' => $galleries_no
		));

		while ( $latest_galleries->have_posts() ) : $latest_galleries->the_post();

			global $post;
			$gal_location = get_post_meta($post->ID, 'ci_cpt_galleries_location', true);
			$gal_venue = get_post_meta($post->ID, 'ci_cpt_galleries_venue', true);

			?>
			<div class="widget-content">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ci_featured', array('class' => "scale-with-grid")); ?></a>
				<div class="album-info">
					<h4 class="pair-title"><?php echo $gal_venue; ?></h4>
					<p class="pair-sub"><?php echo $gal_location; ?></p>
					<a href="<?php the_permalink(); ?>" class="btn"><?php _e('View set', 'ci_theme'); ?></a>
				</div>
			</div><!-- widget-content -->
			<?php

		endwhile;

		wp_reset_postdata();

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['galleries_no'] = absint( $new_instance['galleries_no'] );
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'galleries_no' => 3
		));
		extract($instance);

		echo '<p><label for="'.$this->get_field_id('title').'">' . __('Title:','ci_theme') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" class="widefat" /></p>';
		echo '<p><label for="'.$this->get_field_id('galleries_no').'">' . __('Galleries Number:','ci_theme') . '</label><input id="' . $this->get_field_id('galleries_no') . '" name="' . $this->get_field_name('galleries_no') . '" type="text" value="' . esc_attr($galleries_no) . '" class="widefat" /></p>';
	} // form

} // class CI_Galleries

register_widget('CI_Galleries');

endif; // !class_exists
?>