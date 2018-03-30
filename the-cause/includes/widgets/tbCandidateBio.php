<?php

// TB_Candidate_Bio: data provided through theme options
class TB_Candidate_Bio extends WP_Widget {
	
	function TB_Candidate_Bio() {
		$widget_ops = array('classname' => 'tb_about_us', 'description' => __( 'Candidate Biography - Sidebar only', 'the-cause') );		
		$this->WP_Widget('TB_Candidate_Bio', __('TB Candidate Bio', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Candidate Biography', 'the-cause') : $instance['title'], $instance, $this->id_base);

		$output =  $before_widget . "\n";
		
		if ( $title ) $output .= $before_title . $title . $after_title;

        $tbCandidateBio = get_option('tb_candidate_biography');
		$tbCandidatePage = get_permalink(get_option('tb_page_biography'));
		$tbCandidatePhoto = get_option('tb_candidate_photo');
		$tbCandidateName = get_option('tb_candidate_name');
		$tbCandidateStatus = get_option('tb_candidate_status');
		
		if (!empty($tbCandidateBio)) {
		
			$output .= '<div>';
		
			if ($tbCandidatePhoto) {
			
	            $output .= '<div class="doubleFramed small alignleft">';
	            $output .= '<a href="' . $tbCandidatePage .'" title="' . $tbCandidateName . '">';
	            $output .= '<img src="' . $tbCandidatePhoto . '" alt="' . $tbCandidateName . '"></a>';
	            $output .= "</div>\n";
			} 
			
			if ($tbCandidateName) {
                
            $output .= '<h4><a href="' . $tbCandidatePage .'" title="' . $tbCandidateName . '">' . $tbCandidateName . "</a></h4>\n";
			
			}
			
			if ($tbCandidateStatus) {
				$output .= '<div class="newsInfo">' . strtoupper($tbCandidateStatus) . "</div>\n";
			}
			
			$output .= stripslashes(wpautop($tbCandidateBio));
			
			$output .= '</div>';		
			
		}
		
		$output .=  $after_widget;
		
		echo $output;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Candidate Biography' ) );
		$title = strip_tags($instance['title']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
	<?php
	}
}

function tb_register_candidate_bio() {
	
	register_widget('TB_Candidate_Bio');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_candidate_bio', 1);

?>