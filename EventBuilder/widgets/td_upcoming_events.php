<?php

/*
 * Latest Posts Widget 
 * lambda framework v 1.0
 * by www.unitedthemes.com
 * since framework v 1.0
 */


// Recent Listings Widget
class upcoming_events_Widget extends WP_Widget
{
	  function upcoming_events_Widget()
	  {
	    $widget_ops = array('classname' => 'upcoming_events_Widget', 'description' => 'ThemesDojo Recent Posts Widget' );
	    $this->WP_Widget('upcoming_events_Widget', 'ThemesDojo - Upcoming Events Widget', $widget_ops);
	  }
	 
	  function form($instance)
	  {
	    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'items' => '' ));
	    $title = $instance['title'];
		$items = strip_tags($instance['items']);
		
	  ?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	  
	  <p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 5): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
	  <?php
	  }
	 
	  function update($new_instance, $old_instance)
	  {
	    $instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
		$instance['items'] = strip_tags($new_instance['items']);
		
	    return $instance;
	  }

	  function widget($args, $instance){

	    extract($args, EXTR_SKIP);

	    echo $before_widget;

	    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$items = empty($instance['items']) ? 0 : $instance['items'];
		
		if(empty($items))
		{
			$items = 5;
		}

	    if (!empty($title))
	      echo $before_title . $title . $after_title;  
		
	    // recent_posts Widget Content
		
	    global $post_id;

	    $pc = new WP_Query();
		$pc->query(array(
		    'post_type'      => 'event',
		    'posts_per_page' => $items,
		    'post_status'    => 'publish',
		    'meta_key'       => 'event_start_date_number',
		    'orderby'        => 'meta_value',
		    'order'          => 'ASC',
		    'meta_query' => array(
		            array(
		                'key'     => 'event_status',
		                'value'   => 'upcoming',
		            ),
		        ),
		    )
		); 

		while ($pc->have_posts()) : $pc->the_post();
		
		$id = get_the_ID();

		$my_var = get_comments_number( $post_id );	

		?>

		<div class="full post-<?php echo the_ID(); ?>" style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: solid 1px #ecf0f1">
												
			<div class="post-title-preview">

				<a class="latestpostlink" title="" href="<?php echo the_permalink(); ?>">

					<?php 

					if(has_post_thumbnail()) { 

						$image_src_all = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), false, '' );

						$image_src = $image_src_all[0];

					} elseif(!empty($redux_default_img_bg)) { 

						$image_src = esc_url($redux_default_img_bg); 

					} else { 

						$image_src = esc_url(get_template_directory_uri())."/images/title-bg.jpg";

					} 

					?>

					<?php get_template_part( 'inc/BFI_Thumb' ); ?>

			        <?php $params = array( 'width' => 500, 'height' => 200, 'crop' => true ); ?>

			        <img src="<?php echo esc_url( bfi_thumb( "$image_src", $params ) ); ?>" alt="" style="margin-bottom: 20px;"/>

		        </a>

		        <h5 style="margin-top: 0;">
		        	<a title="" href="<?php echo the_permalink(); ?>" ><?php the_title(); ?></a>
		        </h5>

				<span class="listing-container-tagline-widget">

					<?php 

						$event_address_country = get_post_meta(get_the_ID(), 'event_address_country', true);
						$event_address_state = get_post_meta(get_the_ID(), 'event_address_state', true);
						$event_address_city = get_post_meta(get_the_ID(), 'event_address_city', true);
						$event_address_address = get_post_meta(get_the_ID(), 'event_address_address', true);
						$event_address_zip = get_post_meta(get_the_ID(), 'event_address_zip', true);
						$event_location = get_post_meta(get_the_ID(), 'event_location', true);

					?> 

					<i class="fa fa-map-marker"></i>

					<?php if(!empty($event_location)) { ?>
						<?php echo esc_attr($event_location); ?><?php _e( ' - ', 'themesdojo' ); ?>
					<?php } ?>

					<?php if(!empty($event_address_address)) { ?>
						<?php echo esc_attr($event_address_address); ?><?php _e( ', ', 'themesdojo' ); ?>
					<?php } ?>

					<?php if(!empty($event_address_city)) { ?>
						<?php echo esc_attr($event_address_city); ?><?php _e( ', ', 'themesdojo' ); ?>
					<?php } ?>

					<?php if(!empty($event_address_state)) { ?>
						<?php echo esc_attr($event_address_state); ?><?php _e( ' ', 'themesdojo' ); ?>
					<?php } ?>

					<?php if(!empty($event_address_zip)) { ?>
						<?php echo esc_attr($event_address_zip); ?><?php _e( ', ', 'themesdojo' ); ?>
					<?php } ?>

					<?php if(!empty($event_address_country)) { ?>
						<?php echo esc_attr($event_address_country); ?>
					<?php } ?>

					<?php $event_phone = get_post_meta(get_the_ID(), 'event_phone', true); if(!empty($event_phone)) { ?>
					<span><i class="fa fa-phone"></i><?php echo esc_attr($event_phone); ?></span><?php } ?>

				</span>

				<span class="widget-items-meta">

					<i class="fa fa-calendar"></i>

					<?php $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true); $event_start_time = get_post_meta(get_the_ID(), 'event_start_time', true); if(!empty($event_start_date)) { ?>

					<?php

																	global $redux_demo; 
																	if(isset($redux_demo['events-date-format'])) {
																		$time_format = $redux_demo['events-date-format'];
																		if($time_format == 1) {

																?>

																	<?php $start_unix_time = strtotime($event_start_date); $start_date = date("m/d/Y",$start_unix_time); ?>

																	<?php } elseif($time_format == 2) { ?>

																	<?php $start_unix_time = strtotime($event_start_date); $start_date = date("d/m/Y",$start_unix_time); ?>

																	<?php } } else { ?>

																	<?php $start_unix_time = strtotime($event_start_date); $start_date = date("m/d/Y",$start_unix_time); ?>

																<?php } ?>

																<?php

																	global $redux_demo; 
																	if(isset($redux_demo['events-time-format'])) {
																		$time_format = $redux_demo['events-time-format'];
																		if($time_format == 1) {

																?>

																	<?php $start_time = esc_attr($event_start_time); ?>

																	<?php } elseif($time_format == 2) { ?>

																	<?php $start_time = date("H:i", strtotime($event_start_time)); ?>

																	<?php } } else { ?>

																	<?php $start_time = esc_attr($event_start_time); ?>

																<?php } ?>

														        <span><?php echo esc_attr($start_date); ?> <?php echo esc_attr($start_time); ?></span>

					<?php } ?>

				</span>

			</div>

		</div>

		<?php
																		
		endwhile;	

		$wp_query = null; 	
		wp_reset_postdata();		
					
		echo $after_widget;			
		
	  }
	 

}
wp_reset_postdata();	
register_widget('upcoming_events_Widget');

?>
