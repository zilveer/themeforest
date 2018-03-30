<?php 

	$cmb_post_ratings_overall_score = get_post_meta($post->ID, 'cmb_post_ratings_overall_score', true);
	$cmb_post_ratings_out_of_total = get_post_meta($post->ID, 'cmb_post_ratings_out_of_total', true);
	$cmb_post_ratings_title = get_post_meta($post->ID, 'cmb_post_ratings_title', true);
	$cmb_post_ratings_summary = get_post_meta($post->ID, 'cmb_post_ratings_summary', true);
	$cmb_post_show_parameters = get_post_meta($post->ID, 'cmb_post_show_parameters', true);
	$cmb_post_ratings_parameters = get_post_meta($post->ID, 'cmb_post_ratings_parameters', true);
	
 ?>


    				<!-- Start Review box -->
    				<div class="clearfix boxy review-box">
    					<h2><?php echo esc_attr($cmb_post_ratings_title); ?></h2>
    					
						<!-- PARAMETERS -->
						<?php if ($cmb_post_show_parameters == "checked") : ?>

							<ul class="review-graph review-style-1">

								<?php 
                                    for ($i = 0; $i < count($cmb_post_ratings_parameters); $i++) : 

                                        $ratings_total = (float)$cmb_post_ratings_out_of_total;

                                        $ratio = ($ratings_total > 0) ? round($cmb_post_ratings_parameters[$i]['score']/$cmb_post_ratings_out_of_total, 2) : 0;
                                       
                                    ?>

		    						<li>
                                        <?php echo esc_attr($cmb_post_ratings_parameters[$i]['name']); ?> <span><?php echo esc_attr($cmb_post_ratings_parameters[$i]['score']); ?></span>
		    							<div class="rate-span"><div class="ratings-bar" data-ratio="<?php echo esc_attr($ratio); ?>"></div></div>
		    						</li>


								<?php endfor; ?>

							</ul>

						<?php endif; ?>
						<!-- ENDIF PARAMETERS -->


                        <?php 

                            // USER RATING 
                            // setcookie('cookbook_cookie', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, false);
                            // update_post_meta($post->ID,'cmb_post_user_ratings',"");

                            $cmb_post_user_ratings = get_post_meta($post->ID,'cmb_post_user_ratings',true);

                            // calculate average and num votes
                            $user_ratings_array = explode(',', $cmb_post_user_ratings);
                            $user_ratings_sum = 0;
                            $num_votes = count($user_ratings_array);
                            foreach ($user_ratings_array as $key => $value) {
                                $user_ratings_sum = $user_ratings_sum + $value;
                            }
                            $average = round($user_ratings_sum/$num_votes, 1);
                            if ($num_votes === 1 && empty($user_ratings_array[0])) {
                                $num_votes = 0;
                            }

                            // set unrated/rated status
                            $rate_status = 'unrated';
                            $my_rating = "-1";
                            $user_ratings_cookie_string = mb_cookie_get_key_value ("cookbook_cookie", "user-ratings");
                            $user_ratings_cookie_string_array = explode(',', $user_ratings_cookie_string);


                            foreach ($user_ratings_cookie_string_array as $key => $value) {
                                $single_rating_array = explode('-', $value);
                                if ($single_rating_array[0] == $post->ID) { 
                                    $rate_status = 'rated'; 
                                    $my_rating = $single_rating_array[1];
                                }
                            }

                        ?>
    					
    					<div class="clearfix">
    						<div class="col-1-4">
    							<h3><?php _e("User Rating", "loc_canon"); ?></h3>
    							
    							<ul class="star-rating <?php echo esc_attr($rate_status); ?>" data-post_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo wp_create_nonce('user_rating_' . $post->ID); ?>" data-my_rating="<?php echo esc_attr($my_rating); ?>">

                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>

    							</ul>


    							<div class="star-rating-result"><?php printf('%s (%s %s)', esc_attr($average), esc_attr($num_votes), __('Votes', 'loc_canon')); ?></div>
    							
    						</div>
    						
    						<div class="col-3-4 last">
    							<h3><?php _e("Summary", "loc_canon"); ?></h3>
    							<div class="rate-tab rate-big feat-block-1 right">
    								<strong><?php echo esc_attr($cmb_post_ratings_overall_score); ?></strong><i><?php _e("Score", "loc_canon"); ?></i>
    							</div>
    							<p><?php echo wp_kses_post($cmb_post_ratings_summary); ?></p>
    						</div>
    					</div>	
    				</div>





