<?php 
/**
 * Single Artist Widget.
 */
if( !class_exists('CI_Artist') ):
class CI_Artist extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'CI_Artist_widget', // Base ID
			'-= CI Artist =-', // Name
			array( 'description' => __( 'Display a single artist', 'ci_theme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$artist = intval($instance['artist']);
		
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
		$artist = new WP_Query( array( 
			'post_type' => 'cpt_artists',
			'p' => $artist
		));

		while ( $artist->have_posts() ) : $artist->the_post();

			global $post;
			$artist_role = get_post_meta($post->ID, 'ci_cpt_artists_text', true);

			if(has_post_thumbnail())
			{
				?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ci_rectangle'); ?></a><?php
			}

			?>
			<div class="title-pair">
				<h4 class="pair-title"><?php the_title(); ?></h4>
				<p class="pair-sub"><?php echo $artist_role; ?></p>
				<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more', 'ci_theme'); ?></a>
			</div>
			<?php

		endwhile;
		wp_reset_postdata();

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['artist'] = absint( $new_instance['artist'] );
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'artist' => ''
		));
		extract($instance);

		echo '<p><label for="'.$this->get_field_id('title').'">' . __('Title:','ci_theme') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" class="widefat" /></p>';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('artist'); ?>"><?php _e( 'Select Artist:','ci_theme' ); ?></label>
			<?php wp_dropdown_posts(array(
				'post_type' => 'cpt_artists',
				'selected' => $artist
			), $this->get_field_name('artist')); ?>
		</p>
		<?php 
	} // form

} // class CI_Artist

register_widget('CI_Artist');

endif; // !class_exists
?>