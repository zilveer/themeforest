<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Widget random work
 */
class crum_gallery_widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'gallery_widget', // Base ID
            'Widget: Random portfolio item', // Name
            array( 'description' => __( 'Displays random work from your portfolio', 'dfd' ), ) // Args
        );

    }

    public function form( $instance ) {

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'Random work', 'gallery' );
        }

        if ( isset( $instance[ 'image_number' ] ) ) {
            $image_number = $instance[ 'image_number' ];
        } else {
            $image_number = -1;
        }
        if ( isset( $instance[ 'width' ] ) ) {
            $width = $instance[ 'width' ];
        } else {
            $width = 280;
        }
        if ( isset( $instance[ 'height' ] ) ) {
            $height = $instance[ 'height' ];
        } else {
            $height = 160;
        }
        if ( isset( $instance['folio_hover_style'] ) ) {
            $folio_hover_style = $instance['folio_hover_style'];
        } else {
            $folio_hover_style = 'portfolio-hover-style-1';
        }
		
		if(function_exists('dfd_portfolio_hover_variants')) {
			$hover_styles_option = dfd_portfolio_hover_variants();
		} else {
			$hover_styles_option = '';
		}
		
		/*
        if ( isset( $instance[ 'show_meta' ] ) ) {
            $show_meta = $instance[ 'show_meta' ];
        } else {
            $show_meta = 0;
        }
		
		$show_meta_checked = ( isset( $instance['show_meta'] ) && 1 == $instance['show_meta'] ) ? ' checked="checked"' : '';
		 */
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
	<?php if(!empty($hover_styles_option)) : ?>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('folio_hover_style')); ?>"><?php _e('Portfolio hover style', 'dfd'); ?></label>
		<select class="widefat" id="<?php echo esc_attr($this->get_field_id('folio_hover_style')); ?>" name="<?php echo esc_attr($this->get_field_name('folio_hover_style')); ?>">
			<?php foreach($hover_styles_option as $key => $val) : ?>
				<option class="widefat" value="<?php echo esc_attr($val); ?>" <?php if (($folio_hover_style) == $val) echo 'selected'; ?>><?php echo $key ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<?php endif; ?>
	<?php /*
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'show_meta' )); ?>"><?php _e( 'Show portfolio meta', 'dfd' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_meta' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_meta' )); ?>" type="checkbox" <?php echo $show_meta_checked; ?> />
	</p>
	*/?>
        <?php

    }

    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['image_number'] = strip_tags( $new_instance['image_number'] );
        $instance['width'] = strip_tags( $new_instance['width'] );
        $instance['height'] = strip_tags( $new_instance['height'] );
        $instance['folio_hover_style'] = $new_instance['folio_hover_style'];
		//if ( isset( $new_instance['show_meta'] ) ) {
			//$instance['show_meta'] = 1;
		//}

        return $instance;

    }



    public function widget( $args, $instance ) {

        extract( $args );
	    
	    $title = apply_filters( 'widget_title', $instance['title'] );
		$width = $instance['width'];
		$height = $instance['height'];
		$image_number = !empty($instance['image_number']) ? $instance['image_number'] : 1;
		$folio_hover_style = !empty($instance['folio_hover_style']) ? $instance['folio_hover_style'] : 'portfolio-hover-style-1';
        ?>



    <?php echo $before_widget;
    
	    if ($title) {
		    echo $before_title;
		    echo $title;
		    echo $after_title;
	    }
			echo '<div class="folio-items clearfix">';
            $args = array(
                'post_type' => 'my-product', //TODO: Add more post types and sort options
                'posts_per_page' => $image_number,
                'orderby' => 'rand'
            );

			$the_query = new WP_Query($args);
			
            // The Loop

            while ($the_query->have_posts()) : $the_query->the_post();


                if(has_post_thumbnail()) {

                    $thumb = get_post_thumbnail_id();

                    $img_url = wp_get_attachment_url( $thumb,'full'); //get img URL

                    $article_image = dfd_aq_resize( $img_url, $width, $height, true, true, true ); //resize & crop img 
					if(!$article_image) {
						$article_image = $img_url;
					}
					?>
					<div class="recent-works-item project <?php echo !empty($folio_hover_style) ? esc_attr($folio_hover_style) : ''; ?>">
						<div class="work-cover">
							<div class="entry-thumb">
								<img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>
								<?php get_template_part('templates/portfolio/entry-hover'); ?>
							</div>
						</div>
					</div>

                <?php    }

                endwhile; wp_reset_postdata(); ?>

    <?php
				echo '</div>';

        echo $after_widget;
    }
}