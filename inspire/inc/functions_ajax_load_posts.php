<?php

/**************************************
FILTER AND LOAD MORE AJAX

ROADMAP:
We get posts and try to get plus one post (here).
If success #filter data-more_posts is set to true (here).
if #filter data-more_posts is true then create load more button (scripts)

***************************************/

	//SETUP
	add_action('wp_print_styles', 'ins_filter_menu');			//notice action hook, a little experimental but it seems to work fine
	function ins_filter_menu () {
		if (is_singular()) return false;

		//set vars to send to js
		wp_localize_script('inspire_scripts','extDataFilterMenu', array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'numPosts' => get_option('posts_per_page'),
			'nonce' => wp_create_nonce('filter_menu')
		));        
	}

	//AJAX CALL
	add_action('wp_ajax_filter_menu', 'filter_menu');
	add_action('wp_ajax_nopriv_filter_menu', 'filter_menu');

	function filter_menu() {
		if (!wp_verify_nonce($_REQUEST['nonce'], 'filter_menu')) {
			exit('NONCE INCORRECT!');
		}

	/**************************************
	GET VARS
	***************************************/

		//get options first
		$inspire_options = get_option('inspire_options');
		$inspire_options_hp = get_option('inspire_options_hp');

		//build vars
		$filter_category = htmlspecialchars($_REQUEST['filter_category']);
		$filter_subfilter = $_REQUEST['filter_subfilter'];
		$page_type = $_REQUEST['page_type'];
		$current_page =  $_REQUEST['current_page'];
		$num_posts = $_REQUEST['num_posts'];
		$search_query = $_REQUEST['search_query'];
		$author_ID = $_REQUEST['author_ID'];
		$tag = $_REQUEST['tag'];
		$item_id_array = $_REQUEST['item_id_array'];
		//$exclude_string = mb_build_delim_string_from_array($inspire_options_hp['ex_ID'],',','-','');
		$exclude_string = isset($inspire_options_hp['ex_ID']) ? mb_build_delim_string_from_array($inspire_options_hp['ex_ID'],',','-','') : '';

		$sticky_posts = get_option('sticky_posts');

		//create date array - NB: index content varies depending on page type. E.g. if day then [0] = day if month [0] = month etc
		if ($page_type == "day" || $page_type == "month" || $page_type == "year") $date_array = explode("/",$filter_category);

		//set style
		if ($page_type == "home") {
			switch ($inspire_options_hp['hp_style']) {
				case 'classic':
					$columns = 0;
					$style = "classic";
					break;	
				case '1-column':
					$columns = 1;
					$style = "columns";
					break;	
				case '2-column':
					$columns = 2;
					$style = "columns";
					break;	
				case '3-column':
					$columns = 3;
					$style = "columns";
					break;	
				case '4-column':
					$columns = 4;
					$style = "columns";
					break;	
				default:
					$columns = 0;
					$style = "classic";
					break;	
			}
		} else {
			switch ($inspire_options['archive_style']) {
				case 'classic':
					$columns = 0;
					$style = "classic";
					break;	
				case '1-column':
					$columns = 1;
					$style = "columns";
					break;	
				case '2-column':
					$columns = 2;
					$style = "columns";
					break;	
				case '3-column':
					$columns = 3;
					$style = "columns";
					break;	
				case '4-column':
					$columns = 4;
					$style = "columns";
					break;	
				default:
					$columns = 0;
					$style = "classic";
					break;	
			}
				
		}

		switch ($columns) {
			case 1: 
				$featured_img_width = 990;
				break;
			case 2: 
				$featured_img_width = 490;
				break;
			case 3: 
				$featured_img_width = 323;
				break;
			default:
				$featured_img_width = 240;
				break;
		}

		//calculate offset
		$offset = ($current_page - 1) * $num_posts;


	/**************************************
	DATABASE QUERY
	***************************************/

		$query_args = array();

		//standard args
		$query_args = array_merge($query_args, array(
				'numberposts' 		=> $num_posts + 1,
				'offset' 			=> $offset,
				'order'				=> 'DESC',
				'post_type'    		=> 'post',
				'post_status'     	=> 'publish',
				'suppress_filters' 	=> true
		));

		//subfilters
		if ($filter_subfilter == __('Latest', 'loc_inspire')) $query_args = array_merge($query_args, array('orderby' => 'post_date'));
		if ($filter_subfilter == __('Comments', 'loc_inspire')) $query_args = array_merge($query_args, array('orderby' => 'comment_count'));
		if ($filter_subfilter == __('Likes', 'loc_inspire')) $query_args = array_merge($query_args, array('orderby' => 'meta_value_num', 'meta_key' => 'inspire_likes', 'meta_compare' => '>', 'meta_value' => '0'));
		if ($filter_subfilter == __('Random', 'loc_inspire')) {
			$random_exclude_string = "";
			foreach ($item_id_array as $key => $value) {
				$random_exclude_string .= $value . ",";
			}
			$random_exclude_string = substr($random_exclude_string, 0, strlen($random_exclude_string)-1);
			$query_args = array_merge($query_args, array('orderby' => 'rand', 'exclude' => $random_exclude_string, 'offset' => 0));	
		} 

		//page types
		if (($page_type == "category" || $page_type == "home") && $filter_category == __('Show all', 'loc_inspire')) $query_args = array_merge($query_args, array('category' => $exclude_string));
		if (($page_type == "category" || $page_type == "home") && $filter_category != __('Show all', 'loc_inspire')) $query_args = array_merge($query_args, array('category' => get_cat_ID($filter_category)));
		
		if ($page_type == "tag") $query_args = array_merge($query_args, array('tag' => $tag));
		if ($page_type == "search") $query_args = array_merge($query_args, array('s' => $search_query));
		if ($page_type == "author") $query_args = array_merge($query_args, array('author' => $author_ID));
		if ($page_type == "day") $query_args = array_merge($query_args, array('day' => $date_array[0], 'monthnum' => $date_array[1], 'year' => $date_array[2]));
		if ($page_type == "month") $query_args = array_merge($query_args, array('monthnum' => $date_array[0], 'year' => $date_array[1]));
		if ($page_type == "year") $query_args = array_merge($query_args, array('year' => $date_array[0]));

		//split into sticky and non-sticky
		$query_args_sticky = array_merge($query_args, array('post__in' => $sticky_posts));
		$query_args_non_sticky = array_merge($query_args, array('post__not_in' => $sticky_posts));

		//the final querys
		$results_query_sticky = get_posts($query_args_sticky);
		$results_query_non_sticky = get_posts($query_args_non_sticky);

		//debugging
		// foreach($query_args as $key => $value) {
		// 	$array_str .= $key . " : " . $value . "###";
		// }

	/**************************************
	OUTPUT
	***************************************/

		//check if this is an ajax call and if so output
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		      
			if ($style == "columns") {
				include "functions_ajax_posts_columns.php";
			}

			if ($style == "classic") {
				include "functions_ajax_posts_classic.php";
			}
		}

		die();
	}

