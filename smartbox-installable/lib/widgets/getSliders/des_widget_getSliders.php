<?php

class GetSliders_Widget extends WP_Widget {

	function GetSliders_Widget() {
		$widget_ops = array('classname' => 'getSliders_widget', 'description' => __('Show the sliders you have created.','smartbox'));
		parent::__construct(false, 'DESIGNARE _ My Sliders', $widget_ops);
	}
	
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		
		if (isset($instance['title'])){
			$title = esc_attr($instance['title']);
		} else $title = "";
		
		if (isset($instance['slider_id'])){
			$slider_id = esc_attr($instance['slider_id']);			
		} else $slider_id = "";

		if (isset($instance['speed'])){
			$speed = esc_attr($instance['speed']);	
		} else $speed = "";
		
		if (isset($instance['interval'])){
			$interval = esc_attr($instance['interval']);	
		} else $interval = "";
		
		if (isset($instance['autoplay'])){
			$autoplay = esc_attr($instance['autoplay']);	
		} else $autoplay = "";
		
		if (isset($instance['arrows'])){
			$arrows = esc_attr($instance['arrows']);	
		} else $arrows = "";
		
		if (isset($instance['dots'])){
			$dots = esc_attr($instance['dots']);	
		} else $dots = "";
						
        $mysliders = designare_get_created_sliders2();
       
       ?>
        
       		<p>
		        <label>&#8212; <?php _e('Slider','smartbox'); ?> &#8212;<br>
		        <select id="<?php echo $this->get_field_id('slider_id'); ?>" name="<?php echo $this->get_field_name('slider_id'); ?>">
		        		<?php 
		        				
		        				foreach($mysliders as $ms){
		        					
		        					if($ms['id'] == $slider_id)
		        						$s = "selected";
		        					
		        					echo "<option value='" . $ms['id'] . "' ".$s.">" . $ms['name'] . "</option>";	
		        				}
		        		?>
		        </select>
		        </label>
		    </p>
		    
		    <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Slider Title','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /><br></label></p> 
		    <p>
		    <p><label for="<?php echo $this->get_field_id('speed'); ?>">&#8212; <?php _e('Transition Speed','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo $speed; ?>" /><br><span class="flickr-stuff">In milliseconds.</span></label></p> 
		    <p>
		    <p><label for="<?php echo $this->get_field_id('interval'); ?>">&#8212; <?php _e('Slides Duration','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('interval'); ?>" name="<?php echo $this->get_field_name('interval'); ?>" type="text" value="<?php echo $interval; ?>" /><br><span class="flickr-stuff">In milliseconds.</span></label></p> 
		    <p>
		    <p>
		        <label>&#8212; <?php _e('Autoplay','smartbox'); ?> &#8212;<br>
		        <select id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>">
		        		<option value="true" <?php if($autoplay == 'true') echo 'selected' ?>>Yes</option>
		        		<option value="false" <?php if($autoplay == 'false') echo 'selected' ?>>No</option>
		        </select>
		        </label>
		    </p>
		    <p>
		        <label>&#8212; <?php _e('Direction Arrows','smartbox'); ?> &#8212;<br>
		        <select id="<?php echo $this->get_field_id('arrows'); ?>" name="<?php echo $this->get_field_name('arrows'); ?>">
		        		<option value="true" <?php if($arrows == 'true') echo 'selected' ?>>Show</option>
		        		<option value="false" <?php if($arrows == 'false') echo 'selected' ?>>Hide</option>
		        </select>
		        </label>
		    </p>
		    <p>
		        <label>&#8212; <?php _e('Dots','smartbox'); ?> &#8212;<br>
		        <select id="<?php echo $this->get_field_id('dots'); ?>" name="<?php echo $this->get_field_name('dots'); ?>">
		        		<option value="true" <?php if($dots == 'true') echo 'selected' ?>>Show</option>
		        		<option value="false" <?php if($dots == 'false') echo 'selected' ?>>Hide</option>
		        </select>
		        </label>
		    </p>
		    
	<?php
	}
	
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['slider_id'] = $new_instance['slider_id'];
	    $instance['speed'] = $new_instance['speed'];
	    $instance['interval'] = $new_instance['interval'];
	    $instance['autoplay'] = $new_instance['autoplay'];
	    $instance['arrows'] = $new_instance['arrows'];
	    $instance['dots'] = $new_instance['dots'];
		return $instance;
	}
		
	function widget($args, $instance) {
			
		extract($args);
	    $title = apply_filters('widget_title', $instance['title'], $instance);
	    $slider_id = $instance['slider_id'];
	    $speed = $instance['speed'];
	    $interval = $instance['interval'];
	    $autoplay = $instance['autoplay'];
	    $arrows = $instance['arrows'];
	    $dots = $instance['dots'];
	    
	    //GET PAGE INFO
	    $coll = designare_get_slider_data($slider_id);
	    $element = $args['widget_id']."-".rand();
	    wp_enqueue_script( 'flex', DESIGNARE_JS_PATH .'jquery.flexslider-min.js', array(), '1',$in_footer = true);
		?>
			
			<section id="<?php echo $element; ?>" class="flexslider clearfix widget-flexslider">
				
				<h4><?php echo $title; ?></h4><hr>
				
				<ul class="slides">
	  			<?php
	  				foreach($coll['posts'] as $c){
						$p_bg_url = get_post_meta($c->ID, 'custom_image_url', true);
						$p_desc = get_post_meta($c->ID, 'custom_desctext', true);
						$p_title = get_post_meta($c->ID, 'custom_desctitle', true);
						$p_link = get_post_meta($c->ID, 'custom_imagelink', true);
						if ($p_link == "") $p_link = "javascript:;";
						
						$output = "<li><a "; 
						if ($p_link == "javascript:;") $output .= " style='cursor:default;' ";
						$output .= "href='".$p_link."'><img src='".$p_bg_url."' alt=''></a>";
$output .= "<p class='flex-caption'><span style='font-size: 18px; font-weight: bold;'>".$p_title."<br/></span>".$p_desc."</p>";
						$output .= "</li>";

						echo $output;
					}      				
	  			?>
	  			</ul>
			</section>
			
			<script type="text/javascript">
				jQuery(document).ready(function(){
					$('#<?php echo $element; ?>').flexslider({
						animation: "slide",
						slideDirection: "horizontal",
						directionNav: <?php echo $arrows; ?>,
						controlsContainer: '#<?php echo $element; ?> .flex-container',
						pauseOnAction: false,
						pauseOnHover: true,
						keyboardNav: false,
						slideshow: <?php echo $autoplay; ?>,
						animationSpeed: <?php if ($speed=="") $speed = 500; echo $speed; ?>,
						slideshowSpeed: <?php if ($interval=="") $interval = 2000; echo $interval; ?>, 
						controlNav: <?php echo $dots; ?>,
						start: function(slider) { 
							if ($('#<?php echo $element; ?> .slides li').eq(slider.currentSlide+1).find(".flex-caption span").html().length > 4) $('#<?php echo $element; ?> .slides li').eq(slider.currentSlide+1).find(".flex-caption").animate({'bottom' : '0'}, 500);
						},
						after: function(slider) { 
							$('#<?php echo $element; ?> .slides li').find(".flex-caption").each(function(){
								$(this).css('bottom', '-100px');
								if($(this).parent().hasClass('clone')){}
								else{
									$(this).animate({'bottom' : '-100px'}, 500);
								}
							})
							if ($('#<?php echo $element; ?> .slides li').eq(slider.currentSlide+1).find(".flex-caption span").html().length > 4) $('#<?php echo $element; ?> .slides li').eq(slider.currentSlide+1).find(".flex-caption").animate({'bottom' : '0'}, 500);
						}
					});
				});
			</script>
	<?php
	  
	}
}
register_widget('GetSliders_Widget');

?>
