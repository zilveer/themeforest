		<?php 

			$inspire_options_hp = get_option('inspire_options_hp');

			if (isset($inspire_options_hp['show_slider'])) {

				$results_slider_posts = get_posts(array(
					'numberposts'		=> -1,
					'meta_key'			=> 'cmb_slider_feature',
					'meta_value'		=> 'checked',
					'orderby'			=> 'post_date',
					'order'				=> 'DESC',
					'post_type'    		=> 'post',
					'post_status'     	=> 'publish',
					'suppress_filters'  => true,
				));

				$order_array = mb_get_updated_order_array($results_slider_posts);


	 	?>
			<div class="flexslider">
				<ul class="slides">

					<?php 
						for ($i = 0; $i < count($results_slider_posts); $i++) {
							$current_id = $order_array[$i];  
							//get the array key for the object from $results_slider_posts where ID is = $current_id
							for ($n = 0; $n < count($results_slider_posts); $n++) { 
								if ($results_slider_posts[$n]->ID == $current_id) {
									$current_key = $n;
									break;	
								}
							}

							$result_cmb_slider_use_cap_header = get_post_meta($results_slider_posts[$current_key]->ID, 'cmb_slider_use_cap_header', true);
							$result_cmb_slider_cap_header = get_post_meta($results_slider_posts[$current_key]->ID, 'cmb_slider_cap_header', true);
							$result_cmb_slider_use_cap_text = get_post_meta($results_slider_posts[$current_key]->ID, 'cmb_slider_use_cap_text', true);
							$result_cmb_slider_cap_text = get_post_meta($results_slider_posts[$current_key]->ID, 'cmb_slider_cap_text', true);
							$result_cmb_slider_use_link = get_post_meta($results_slider_posts[$current_key]->ID, 'cmb_slider_use_link', true);
							$result_cmb_slider_link = get_post_meta($results_slider_posts[$current_key]->ID, 'cmb_slider_link', true);
							$result_cmb_slider_use_media = get_post_meta($results_slider_posts[$current_key]->ID, 'cmb_slider_use_media', true);
							$result_cmb_slider_media = get_post_meta($results_slider_posts[$current_key]->ID, 'cmb_slider_media', true);

							if ($result_cmb_slider_use_media == 'checked') {
								if (!empty($result_cmb_slider_media)) {
								?>
									<li>
										<?php echo $result_cmb_slider_media; ?>
									</li>
								<?php	
								}
									
							} else {
								if (has_post_thumbnail($results_slider_posts[$current_key]->ID)) {
								?> 
									<li>
										<?php 
											$td_slider_link = !empty($result_cmb_slider_use_link) ? $result_cmb_slider_link : get_permalink($results_slider_posts[$current_key]->ID);
											printf("<a href='%s'>%s</a>",  esc_url($td_slider_link),get_the_post_thumbnail($results_slider_posts[$current_key]->ID, 'slider_img'));
										 ?>
										<div class="slider-text">

											<?php 
												if ($result_cmb_slider_use_cap_header == "checked" && !empty($result_cmb_slider_cap_header)) {
												?>
													<a href="<?php echo get_permalink($results_slider_posts[$current_key]->ID); ?>"><div class="slider-title"><h1><?php echo $result_cmb_slider_cap_header; ?></h1></div></a>
												<?php		
												}
											?>

											<?php 
												if ($result_cmb_slider_use_cap_text == "checked" && !empty($result_cmb_slider_cap_text)) {
												?>
													<a href="<?php echo get_permalink($results_slider_posts[$current_key]->ID); ?>"><div class="slider-excerpt"><p><?php echo $result_cmb_slider_cap_text; ?></p></div></a>
												<?php
												}
											?>

										</div>
									</li>
								<?php
								}
									
							} //if media or thumbnail
									
						} //fori
					?>

				</ul>
			</div>

		<?php
			}	//end if show_slider
		?>