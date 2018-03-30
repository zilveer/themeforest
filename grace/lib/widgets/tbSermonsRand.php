<?php

// Random Sermons
class TB_Random_Sermons extends WP_Widget {
	
	function TB_Random_Sermons() {
		$widget_ops = array('classname' => 'tb_sermons', 'description' => __( 'Random Sermons', 'grace') );		
		$this->WP_Widget('TB_Random_Sermons', __('ThemeBlossom: Random Sermons', 'grace'), $widget_ops);	
	}
	
	function widget( $args, $instance ) {
		
		$themeOptions = of_get_all_options();

		extract($args);

		$number_of_posts  = (int) $instance['number_of_posts'];

		$qSermons = new WP_Query(array('post_type' => TB_SERMON_CPT, 'posts_per_page' => $number_of_posts, 'no_found_rows' => true, 'post_status' => 'publish', 'orderby' => 'rand'));
		
		if ($qSermons->have_posts()) : ?>
        
		<?php
        echo $before_widget;
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Sermons', 'grace') : $instance['title'], $instance, $this->id_base);		
		if ( $title ) echo $before_title . $title . $after_title;
		?>
        
		<?php  while ($qSermons->have_posts()) : $qSermons->the_post(); ?>
        <?php
		$postID = get_the_ID();
		$postTitle = get_the_title($postID);
		$postCustom = get_post_custom($postID);		
		$postPermalink = get_permalink($postID);
		?>    
		    
		<div class="listPost">
		
        	<?php if (has_post_thumbnail()) { ?>
        	<a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>">
			<?php echo get_the_post_thumbnail($postID, 'thumbnail', array('class' => 'imageBorder alignleft tb_widget_image')); ?>
			</a>
            <?php } ?>
			
        	<h4><a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a></h4>
			
			<?php
			unset($video); unset($mp3); unset($pdf);
			$video = isset($postCustom['_tb_video'][0]) ? $postCustom['_tb_video'][0] : FALSE;
			$mp3 = isset($postCustom['_tb_mp3'][0]) ? $postCustom['_tb_mp3'][0] : FALSE;
			$pdf = isset($postCustom['_tb_pdf'][0]) ? $postCustom['_tb_pdf'][0] : FALSE;

			$sermonE = array();
			
			if ($pdf) {
				$sermonE[] = "<a href='$pdf' class='widget-icon' title='" . __('Download PDF', 'grace') . "'>" . '<span aria-hidden="true" class="icon-file-pdf"></span>' . "</a>";
			}
			
			if ($mp3) {
				$listenAudio = isset($themeOptions['_tb_listen_audio']) ? $themeOptions['_tb_listen_audio'] : FALSE;
				if ($listenAudio) {
					$listenAudioURL = get_permalink($listenAudio);
					$mp3iframe = $listenAudioURL . '?pid=' . $postID . '&iframe=true&width=350&height=70';
					$sermonE[] = "<a href='$mp3iframe' class='iframe widget-icon' rel='prettyPhoto' title='" . __('Listen Audio', 'grace') . "'>" . '<span aria-hidden="true" class="icon-volume-medium"></span>' . "</a>";
				} else {
					$sermonE[] = "<a href='$mp3' class='map_excluded widget-icon' title='" . __('Download mp3', 'grace') . "'>" . '<span aria-hidden="true" class="icon-volume-medium"></span>' . "</a>";	
				}	
			}
			
			if ($video) {
				$sermonE[] = "<a href='$video' class='iframe widget-icon' rel='prettyPhoto' title='" . __('Watch Video', 'grace') . "'>" . '<span aria-hidden="true" class="icon-film"></span>' . "</a>";
			}
			
			$sermonE[] = "<a href='$postPermalink' class='widget-icon' title='" . __('More', 'grace') . "'>" . '<span aria-hidden="true" class="icon-link"></span>' . "</a>";
			
			echo '<p class="widget-icons">' . implode(' ', $sermonE) . '</p>';
			
			?>
                        
        </div>
		<?php endwhile; ?>
		
		<?php
		
		endif;
		
		wp_reset_postdata();
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['number_of_posts'] = (int) strip_tags($new_instance['number_of_posts']);
		$instance['title'] =  strip_tags($new_instance['title']);
		
		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'number_of_posts' => 2, 'title'=>'Sermons', 'number_of_words' => 15 ) );
		$number_of_posts = (int) strip_tags($instance['number_of_posts']);
		$title =  strip_tags($instance['title']);
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
        <p>
        	<label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('Number of Posts:', 'grace'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('number_of_posts'); ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" type="text" value="<?php echo absint($number_of_posts); ?>" />
        </p>
	<?php
	}
}

function tb_register_random_sermons() {
	
	register_widget('TB_Random_Sermons');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_random_sermons', 1);

?>