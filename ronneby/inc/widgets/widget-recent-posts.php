<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Widget random work
 */
class dfd_recent_posts_widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'recent_posts_widget', // Base ID
            'Widget: Random posts', // Name
            array( 'description' => __( 'Displays random posts', 'dfd' ), ) // Args
        );

    }

    public function form( $instance ) {

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'Random post', 'gallery' );
        }

        if ( isset( $instance[ 'image_number' ] ) ) {
            $image_number = $instance[ 'image_number' ];
        } else {
            $image_number = -1;
        }
        if ( isset( $instance[ 'width' ] ) ) {
            $width = $instance[ 'width' ];
        } else {
            $width = 360;
        }
        if ( isset( $instance[ 'height' ] ) ) {
            $height = $instance[ 'height' ];
        } else {
            $height = 160;
        }
        if ( isset( $instance[ 'show_meta' ] ) ) {
            $show_meta = $instance[ 'show_meta' ];
        } else {
            $show_meta = 0;
        }
		
		$show_meta_checked = ( isset( $instance['show_meta'] ) && 1 == $instance['show_meta'] ) ? ' checked="checked"' : '';	
?>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'dfd' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'width' )); ?>"><?php _e( 'Width(px):', 'dfd' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'width' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'width' )); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"><?php _e( 'Height(px):', 'dfd' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'height' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'height' )); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'image_number' )); ?>"><?php _e( 'Images number:', 'dfd' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'image_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image_number' )); ?>" type="text" value="<?php echo esc_attr( $image_number ); ?>" />
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'show_meta' )); ?>"><?php _e( 'Show post content', 'dfd' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_meta' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_meta' )); ?>" type="checkbox" <?php echo $show_meta_checked; ?> />
	</p>

        <?php

    }

    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['image_number'] = strip_tags( $new_instance['image_number'] );
        $instance['width'] = strip_tags( $new_instance['width'] );
        $instance['height'] = strip_tags( $new_instance['height'] );
        $instance['show_meta'] = 0;
		if ( isset( $new_instance['show_meta'] ) ) {
			$instance['show_meta'] = 1;
		}

        return $instance;

    }



    public function widget( $args, $instance ) {

        extract( $args );
	    
	    $title = apply_filters( 'widget_title', $instance['title'] );
		$width = $instance['width'];
		$height = $instance['height'];
		$image_number = $instance['image_number'];
		$show_meta = $instance['show_meta'];
        ?>



    <?php echo $before_widget;
    
	    if ($title) {
		    echo $before_title;
		    echo $title;
		    echo $after_title;
	    } ?>
			<div class="posts-items">
				<?php
				$args = array(
					'post_type' => 'post', //TODO: Add more post types and sort options
					'posts_per_page' => $image_number,
					'orderby' => 'rand'
				);

				$the_query = new WP_Query($args);

				// The Loop

				while ($the_query->have_posts()) : $the_query->the_post();
					$post_class_elems = get_post_class();

					$post_class = implode(' ', $post_class_elems);
				?>
					<article class="<?php echo esc_attr($post_class); ?>">
						<div class="entry-media">
							<?php
							switch(true) {
								case has_post_format('video'):
									get_template_part('templates/post', 'video');
									break;
								case has_post_format('audio'):
									get_template_part('templates/post', 'audio');
									break;
								case has_post_format('gallery'):
									get_template_part('templates/post', 'gallery');
									break;
								case has_post_format('quote'):
									get_template_part('templates/post', 'quote');
									break;
								default:
									if (has_post_thumbnail()) {
										$thumb = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url($thumb, 'large'); //get img URL

										$article_image = dfd_aq_resize($img_url, 450);
										if(!$article_image) {
											$article_image = $img_url;
										}
										?>
										<div class="entry-thumb">
											<img src="<?php echo esc_url($article_image) ?>" alt="<?php the_title() ?>"/>
											<?php get_template_part('templates/entry-meta/hover-link'); ?>
										</div>
							<?php
									}
							}
						?>
						</div>
						<?php if(!empty($show_meta) && $show_meta == 1) : ?>
							<div class="content-wrap">

								<div class="box-name"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
								<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>

								<div class="entry-content">
									<?php
									$content = get_the_excerpt();
									if(!empty($content)) {
										echo '<p>'.$content.'</p>';
									}
									?>
									<a href="<?php the_permalink(); ?>" class="more-button chaffle" title="<?php the_title(); ?>" data-lang="en"><?php _e('Continue', 'dfd'); ?></a>
								</div>
							</div>
						<?php endif; ?>
					</article>

				<?php endwhile; wp_reset_postdata(); ?>

				</div>
			<?php

        echo $after_widget;
    }
}