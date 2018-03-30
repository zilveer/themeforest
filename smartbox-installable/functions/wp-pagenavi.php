<?php

/*
Plugin Name: WP-PageNavi
Plugin URI: http://lesterchan.net/portfolio/programming/php/
Description: Adds a more advanced paging navigation to your WordPress blog.
Version: 2.50
Author: Lester 'GaMerZ' Chan
Author URI: http://lesterchan.net
*/


/*  
	Copyright 2009  Lester Chan  (email : lesterchan@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


### Create Text Domain For Translations
//add_action('init', 'pagenavi_textdomain');
function pagenavi_textdomain() {
	load_plugin_textdomain('wp-pagenavi', false, 'wp-pagenavi');
}


### Function: Page Navigation Option Menu
//add_action('admin_menu', 'pagenavi_menu');





### Function: Page Navigation: Boxed Style Paging
function wp_pagenavi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$se = get_option(DESIGNARE_SHORTNAME."_search_everything");
	$pag = 1;
	$totalPosts = 0;
	
	if (isset($_GET['paged'])) $pag = $_GET['paged'];
	else {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$pagina = explode('/page/', $pageURL);
		if(isset($pagina[1])) $pagina = explode ('/', $pagina[1]);
		if ($pagina[0]) $pag = $pagina[0];	
	}
	if (!is_numeric($pag)) $pag = 1;
	$varS = "";
	if (is_author()){
		$author = $wp_query->get_queried_object();		
		$current_author = $tag->term_id;
		$args = array(
			'showposts' => get_option('posts_per_page'),
			'post_status' => 'publish',
			'paged' => $pag,
			'tag' => $current_author
		);
	    $the_query = new WP_Query( $args );
	    
	    $args2 = array(
			'showposts' => -1,
			'post_status' => 'publish',
			'paged' => $pag,
			'tag' => $current_author
		);
		$counter = new WP_Query($args2);
		$totalPosts = $counter->post_count;
	}
	if (is_category()){
		$category = $wp_query->get_queried_object();		
		$current_cat = $tag->term_id;
		$args = array(
			'showposts' => get_option('posts_per_page'),
			'post_status' => 'publish',
			'paged' => $pag,
			'tag' => $current_cat
		);
	    $the_query = new WP_Query( $args );
	    
	    $args2 = array(
			'showposts' => -1,
			'post_status' => 'publish',
			'paged' => $pag,
			'tag' => $current_cat
		);
		$counter = new WP_Query($args2);
		$totalPosts = $counter->post_count;
	}
	if (is_tag()){
		$tag = $wp_query->get_queried_object();
		$current_tag = $tag->term_id;
		$args = array(
			'showposts' => get_option('posts_per_page'),
			'post_status' => 'publish',
			'paged' => $pag,
			'tag' => $current_tag
		);
	    $the_query = new WP_Query( $args );
	    
	    $args2 = array(
			'showposts' => -1,
			'post_status' => 'publish',
			'paged' => $pag,
			'tag' => $current_tag
		);
		$counter = new WP_Query($args2);
		$totalPosts = $counter->post_count;
	}
	if (is_search()){
		if (isset($_GET['s'])) $varS = esc_html($_GET['s']);
			if ($se == "on"){
			$args = array(
				'showposts' => get_option('posts_per_page'),
				'post_status' => 'publish',
				'paged' => $pag,
				's' => $varS
			);
		    $the_query = new WP_Query( $args );
		    
		    $args2 = array(
				'showposts' => -1,
				'post_status' => 'publish',
				'paged' => $pag,
				's' => $varS
			);
			$counter = new WP_Query($args2);
			$totalPosts = $counter->post_count;
			
		} else {
			$args = array(
				'showposts' => get_option('posts_per_page'),
				'post_status' => 'publish',
				'paged' => $pag,
				'post_type' => 'post',
				's' => $varS
			);	
		    $the_query = new WP_Query( $args );
		    
		    $args2 = array(
				'showposts' => -1,
				'post_status' => 'publish',
				'paged' => $pag,
				'post_type' => 'post',
				's' => $varS
			);
			$counter = new WP_Query($args2);
			$totalPosts = $counter->post_count;
		}
		
	}
	if (!is_single()) {
		$args = array(
			'showposts' => -1,
			'post_status' => 'publish',
			'paged' => $pag,
		);
	    $counter = new WP_Query( $args );
		$request = $wp_query->request;
		//$res = $wpdb->get_results($request);
		$posts_per_page = get_option('posts_per_page');
		$paged = $pag;
		$pagenavi_options = get_option('pagenavi_options');
		$max_page = ceil($counter->post_count / $posts_per_page);

		$numposts = $counter->post_count;
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = 5;
		$larger_page_to_show = 3;
		$larger_page_multiple = -1;
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		$larger_per_page = $larger_page_to_show*$larger_page_multiple;
		$larger_start_page_start = (n_round($start_page, 10) + $larger_page_multiple) - $larger_per_page;
		$larger_start_page_end = n_round($start_page, 10) + $larger_page_multiple;
		$larger_end_page_start = n_round($end_page, 10) + $larger_page_multiple;
		$larger_end_page_end = n_round($end_page, 10) + ($larger_per_page);
		if($larger_start_page_end - $larger_page_multiple == $start_page) {
			$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
			$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
		}
		if($larger_start_page_start <= 0) {
			$larger_start_page_start = $larger_page_multiple;
		}
		if($larger_start_page_end > $max_page) {
			$larger_start_page_end = $max_page;
		}
		if($larger_end_page_end > $max_page) {
			$larger_end_page_end = $max_page;
		}
		
		if (is_search() && $totalPosts < get_option('posts_per_page')) $max_page = 1;
		
		if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
			$pages_text = str_replace("_CURRENT_PAGE_", $paged, $pagenavi_options['pages_text']);
			$pages_text = str_replace("_TOTAL_PAGES_", $max_page, $pages_text);
			$pages_text = __("Page ","smartbox") . $paged . __(" of ","smartbox") . $max_page;
			echo $before.'<div class="des-pages">'."\n";
			
			switch(get_option(DESIGNARE_SHORTNAME."_blog_reading_type")){
				case "paged": $pagenavi_options['style'] = 1; break;
				case "dropdown": $pagenavi_options['style'] = 2; break;
				default: $pagenavi_options['style'] = 1; break;
			}
			
			switch(intval($pagenavi_options['style'])) {
				case 1:
				
					if ($start_page >= 2 && $pages_to_show < $max_page) {
						if (isset($pagenavi_options['first_text']))
							$first_page_text = $pagenavi_options['first_text'];
						echo '<a href="'.esc_url(get_pagenum_link()).'" class="page first" title="&laquo;">&laquo;</a>';
						if(!empty($pagenavi_options['dotleft_text'])) {
							echo '<span class="extend">'.$pagenavi_options['dotleft_text'].'</span>';
						}
					}
					
					for($i = $start_page; $i  <= $end_page; $i++) {						
						if($i == $paged) {
							echo '<span class="pages current">'.$pages_text.'</span>';
						} else {
							if (isset($pagenavi_options['page_text']))
								$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							$page_text = $i;
							echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
						}
					}
					
					if ($end_page < $max_page) {
						echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="page last" title="&raquo;">&raquo;</a>';
					}
					
					break;
				case 2:
					echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">'."\n";
					echo '<label class="gotopagedd" for="pagedd">'. __('Go to page','smartbox') .'</label>';
					echo '<select name="pagedd" size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">'."\n";
					for($i = 1; $i  <= $max_page; $i++) {
						$page_num = $i;
						if($page_num == 1) {
							$page_num = 0;
						}
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							$current_page_text = number_format_i18n($i);
							echo '<option value="'.esc_url(get_pagenum_link($page_num)).'" selected="selected" class="current">'.$current_page_text."</option>\n";
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							$page_text = number_format_i18n($i);
							echo '<option value="'.esc_url(get_pagenum_link($page_num)).'">'.$page_text."</option>\n";
						}
					}
					echo "</select>\n";
					echo "</form>\n";
					break;
			}
			echo '</div>'.$after."\n";
		}
	}
}


### Function: Page Navigation: Drop Down Menu (Deprecated)
function wp_pagenavi_dropdown() { 
	wp_pagenavi(); 
}


### Function: Round To The Nearest Value
function n_round($num, $tonearest) {
   return floor($num/$tonearest)*$tonearest;
}


### Function: Page Navigation Options
//add_action('activate_wp-pagenavi/wp-pagenavi.php', 'pagenavi_init');
//add_action('init', 'pagenavi_init');
function pagenavi_init() {
	pagenavi_textdomain();
	// Add Options
	$pagenavi_options = array();
	$pagenavi_options['pages_text'] = __('Page _CURRENT_PAGE_ of _TOTAL_PAGES_','smartbox');
	$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['first_text'] = __('&laquo;','smartbox');
	$pagenavi_options['last_text'] = __('&raquo;','smartbox');
	$pagenavi_options['next_text'] = __('&raquo;','smartbox');
	$pagenavi_options['prev_text'] = __('&laquo;','smartbox');
	$pagenavi_options['dotright_text'] = __('...','smartbox');
	$pagenavi_options['dotleft_text'] = __('...','smartbox');
	$pagenavi_options['style'] = 1;
	$pagenavi_options['num_pages'] = 5;
	$pagenavi_options['always_show'] = 0;
	$pagenavi_options['num_larger_page_numbers'] = 3;
	$pagenavi_options['larger_page_numbers_multiple'] = 10;
	
	//add_option('pagenavi_options', $pagenavi_options, 'PageNavi Options', "no");
}
?>