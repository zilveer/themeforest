<?php
			$default_excerpt_len = 300;

			//get user like string from cookie for use in later check
			$like_string = mb_cookie_get_key_value ("inspire_cookie", "likes");

			//first display sticky posts
			if (($current_page == "1") && (count($sticky_posts) > 0)) {
				$results_query = $results_query_sticky;
				include ('functions_ajax_posts_columns_display.php');
			}
			
			//second display non sticky posts
			$results_query = $results_query_non_sticky;
				include ('functions_ajax_posts_columns_display.php');

