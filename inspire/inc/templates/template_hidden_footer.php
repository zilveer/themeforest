	<!-- HIDDEN FOOTER -->
	<?php 

		$inspire_options = get_option('inspire_options');

		$footer_shows =  $inspire_options['footer_shows'];
		$footer_num_posts = $inspire_options['footer_num_posts'];

		$query_args = array();

		//standard args
		$query_args = array_merge($query_args, array(
			'numberposts' 		=> $footer_num_posts,
			'offset' 			=> 0,
			'order'				=> 'DESC',
			'post_type'    		=> 'post',
			'post_status'     	=> 'publish',
			'suppress_filters' 	=> true,
		));

		if ($footer_shows == "latest") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
			));
		} elseif ($footer_shows == "random") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'orderby'			=> 'rand',
			));
		} else {
			$query_args = array_merge($query_args, array(
				'category'			=> get_cat_ID($footer_shows),
				'orderby'			=> 'rand',
			));
		}

		//final query
		$results_footer = get_posts($query_args);

		//count how many posts actually have featured image
		$footer_counter = 0;
		for ($i = 0; $i < count($results_footer); $i++) {  
			if (has_post_thumbnail($results_footer[$i]->ID)) $footer_counter++;
		}
		$footer_num_posts = $footer_counter;

	?>
	<div id="footer_hidden_wrapper">
		<div id="footer_hidden" 
			data-num_posts="<?php echo $footer_num_posts; ?>" 
			data-scroll_posts="<?php echo $inspire_options['footer_num_posts_scroll']; ?>" 
			data-auto_scroll="<?php echo $inspire_options['footer_autoscroll_sec']; ?>" 
			data-anim_speed="<?php echo $inspire_options['footer_animation_speed']; ?>" 
			data-footer_default="<?php echo $inspire_options['footer_default']; ?>"
		>

			<ul id="footer_carousel" class="jcarousel-skin-tango">

				<?php
					for ($i = 0; $i < count($results_footer); $i++) { 
						if (has_post_thumbnail($results_footer[$i]->ID)) { 
						?> 
							<li>
								<?php printf("<a href='%s'>%s</a>", esc_url(get_permalink($results_footer[$i]->ID)),get_the_post_thumbnail($results_footer[$i]->ID,'footer_thumb'));?>
							</li>
						<?php
						} 
				}

				?>

			</ul>

		</div>
	</div>
