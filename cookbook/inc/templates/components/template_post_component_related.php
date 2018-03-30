<?php
	
	// GET VARS
	$show = $cmb_post_related_shows = get_post_meta($post->ID, 'cmb_post_related_shows', true);
	$title = get_post_meta($post->ID, 'cmb_post_related_title', true);
	$num_posts = get_post_meta($post->ID, 'cmb_post_related_num_posts', true);


	//basic args
	$query_args = array();
	$query_args = array_merge($query_args, array(
		'post_type'    			=> 'post',
		'numberposts' 			=> $num_posts,
		'post_status'     		=> 'publish',
		'offset' 				=> 0,
		'suppress_filters' 		=> false
	));

	if ($show == "same_cat") {
		$cat_object = get_the_category($post->ID);
		$cat_slug = $cat_object[0]->slug;
		$query_args = array_merge($query_args, array(
			'category_name'		=> $cat_slug,
			'orderby'			=> 'post_date',
			'order'				=> 'DESC',
		));
	} elseif ($show == "latest_posts") {
		$query_args = array_merge($query_args, array(
			'category'			=> '',
			'orderby'			=> 'post_date',
			'order'				=> 'DESC',
		));
	} elseif ($show == "random_posts") {
		$query_args = array_merge($query_args, array(
			'category'			=> '',
			'orderby'			=> 'rand',
		));
	} elseif ($show == "popular_views") {
		$query_args = array_merge($query_args, array(
			'category'			=> '',
			'meta_key'			=> 'post_views',
 			'orderby'   		=> 'meta_value_num', //or 'meta_value_num'
			'order'				=> 'DESC',
			'exclude'			=> mb_get_exclude_string('cmb_hide_from_popular'),
		));
	} elseif ($show == "popular_comments") {
		$query_args = array_merge($query_args, array(
			'category'			=> '',
			'orderby'			=> 'comment_count',
			'order'				=> 'DESC',
			'exclude'			=> mb_get_exclude_string('cmb_hide_from_popular'),
		));
	} elseif (strpos($show, "postcat_") !== false) {
		$show = str_replace("postcat_", "", $show);
		$query_args = array_merge($query_args, array(
			'category_name'		=> $show,
			'orderby'			=> 'post_date',
			'order'				=> 'DESC',
		));
	}

	//final query
	$results_query = get_posts($query_args);

?>

		<!-- Start Related Posts -->
		<div class="clearfix related-posts">

			<?php if(!empty($title)) { echo "<h2>$title</h2>"; } ?>

			<!-- Thumbnail list -->
			<ul class="thumb-list archive relates clearfix">

				<?php 

					for ($i = 0; $i < count($results_query); $i++) {

						$this_post = $results_query[$i];

                        echo '<li>';

						// FEATURED IMAGE
						if (has_post_thumbnail($this_post->ID) && get_post(get_post_thumbnail_id($this_post->ID)) ) { 

                            $cmb_post_show_ratings = get_post_meta($this_post->ID, 'cmb_post_show_ratings', true);
                            $cmb_post_ratings_overall_score = get_post_meta($this_post->ID, 'cmb_post_ratings_overall_score', true);

							$post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'small_square_thumb');
							$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
							$img_post = get_post(get_post_thumbnail_id($this_post->ID));

							echo '<div class="rate-container">';
                            if ( $cmb_post_show_ratings == "checked" && !empty($cmb_post_ratings_overall_score) ) { printf('<div class="rate-tab rate-small feat-block-1"><strong>%s</strong></div>', esc_attr($cmb_post_ratings_overall_score)); }
							printf('<a href="%s"><img src="%s" alt="%s" /></a>', get_the_permalink(), esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
							echo '</div>';

						}

						// CATEGORIES
						$cat_string = mb_get_cat_string($this_post->ID, " | ");

						printf('<div class="meta feat-1"><h6>%s</h6></div>', wp_kses_post($cat_string));

						// TITLE
						printf('<a href="%s" class="title"><h3 class="title">%s</h3></a>', esc_url(get_permalink($this_post->ID)), esc_attr(get_the_title($this_post->ID)));

                        echo '</li>';

					}

				?>

			</ul>
			
		</div>


