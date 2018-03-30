<?php

//Start footer recent posts widgets
class Theme2035_Footer_Recent_Posts_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'widget_footer_recent_entries', 'description' => __( "The most recent posts", "Theme2035") );
		parent::__construct('blogy-footer-recent-posts', __('[ CUSTOM ] Recent Posts  ', 'Theme2035'), $widget_ops);
		$this->alt_option_name = 'widget_footer_recent_entries';
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_footer_recent_posts', 'widget');
		if ( !is_array($cache) )
			$cache = array();
		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;
		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		ob_start();
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('[ CUSTOM ] Recent Posts  ', 'Theme2035') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) $number = 10;
		if ( empty( $instance['slider'] )) { $instance['slider'] = 'true'; } else { $slider = $instance['slider'] ? 'on' : 'off'; }
		
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title;  ?>


		<?php if($instance['slider'] == "on" ){ ?>
		<div class="flexslider slider-post-widget marginb20">
			<ul class="slides">
		<?php } else { ?>
			<div class="recent-post-custom">
			<?php } ?>
	<?php 
		

						// WP_Query arguments
						$args = array (
						'order'                  => 'DESC',
						'orderby'                => 'date',
						'posts_per_page'         => $number, // Slider Post Count
						'ignore_sticky_posts'    => 1,
						 'post_status'=>'publish',
						);

						// The Query
						$query = new WP_Query( $args );

						// The Loop
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
							$query->the_post();

							$image = "";
							

							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-slider-3-grid' );
							$image = $image[0];
					
							if($image == ""){

								$image = IMAGES."/slider-no-image-3.jpg"; 

							}
						?>
						<?php if($instance['slider'] == "on" ){ ?>
						<li class="slide-block home-slider-3-grid">
							<img class="img-responsive" src="<?php echo esc_attr($image);?>" />
							<div class="slider-content">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<date><?php echo esc_attr($post_date = the_time('F j')); ?></date>
							</div>
						</li>
						<?php } else { ?>

						
							
								<div class="recent-post-box marginb20 clearfix">
									<div class="recent-post-image"> 
									 <?php if (has_post_thumbnail() ){ the_post_thumbnail('thumbnail'); } else { echo '<img src="'.IMAGES.'/slider-no-image-3.jpg">'; } ?> 
									</div>
									<div class="recent-post-title-cont"> 
										<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
										<div class="time"><?php echo esc_attr($post_date = the_time('F j')); ?></div>
									</div>
								</div>
						
						
						<?php } ?>



						<?php 
						}
					}else {
						echo __("<h4>Not Post Found!</h4>","2035Themes-fm");
					}

					// Restore original Post Data
					wp_reset_postdata();

					?>
					<?php if($instance['slider'] == "on" ){ ?>
					</ul>
					</div>
					<?php } else { ?>
					</div>
					<?php } ?>


		<?php echo $after_widget; ?>
<?php
		
		//$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_footer_recent_posts', $cache, 'widget');
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['slider'] = strip_tags( $new_instance['slider'] );
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_footer_recent_entries']) )
			delete_option('widget_footer_recent_entries');
		return $instance;
	}
	function flush_widget_cache() {
		wp_cache_delete('widget_footer_recent_posts', 'widget');
	}
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Post';
		$number = isset($instance['number']) ? absint($instance['number']) : 3;
		$slider = isset($instance['slider']) ? absint($instance['slider']) : 'on';
		$thumb = isset($instance['thumb']) ? absint($instance['thumb']) : 5;


?>


		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'Theme2035'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'Theme2035'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
          <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['slider'], 'on'); ?> id="<?php echo $this->get_field_id('slider'); ?>" name="<?php echo $this->get_field_name('slider'); ?>" /> 
            <label for="<?php echo $this->get_field_id('slider'); ?>"><?php echo __('Show in Slider', 'theme2035'); ?></label>
        </p>
<?php
	}
} 
register_widget('Theme2035_Footer_Recent_Posts_Widget');
//End footer recent posts widgets

?>