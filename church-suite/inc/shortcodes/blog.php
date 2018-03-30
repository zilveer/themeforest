<?php
function webnus_blog($attributes, $content = null){
	extract(shortcode_atts(array(
	'type'=>'1',
	'category'=>'',
	'author'=>'',
	'count'=>'',
	), $attributes));
	ob_start();
	$p_count = '0';
	$paged = ( is_front_page() ) ? 'page' : 'paged' ;
	$last_time = get_the_time(' F Y'); $i=1; $flag = false; //timeline
	$args = array(
		   'orderby'=>'date',
		   'order'=>'desc',
		   'post_type'=>'post',
		   'paged' => get_query_var($paged),
		   'category_name' => $category,
		   'author_name' => $author,
		   'posts_per_page'=> $count,
	); 	
	$query = new WP_Query($args);
	if ($type == 6){ 
		echo'<section id="main-content-pin"><div class="container"><div id="pin-content">';
	}elseif ($type == 7){ 
		echo'<section id="main-content-timeline"><div class="container"><div id="tline-content">';
	}
	if ($query ->have_posts()) :
		if ($type == 3)
			echo '<div class="row">';
	while ($query -> have_posts()) : $query -> the_post();
	switch($type){
		case 2:
			get_template_part('parts/blogloop','type2');
		break;
		case 3:
			get_template_part('parts/blogloop','type3');
		break;
		case 4:
			if($p_count == '0')
				get_template_part('parts/blogloop');
			else
				get_template_part('parts/blogloop','type2');
			$p_count++;
		break;
		case 5:
			if($p_count == '0'){
				get_template_part('parts/blogloop');
				echo '<div class="row">';
			}else
				get_template_part('parts/blogloop','type3');
			$p_count++;
		break;
		case 6:
			get_template_part('parts/blogloop','masonry');
		break;
		case 7:
			get_template_part('parts/blogloop','timeline');
		break;
		default:
			get_template_part('parts/blogloop'); //type 1
		break;
		}
	endwhile;
	if($type == 3 || $type == 5 || $type == 6)
		echo '</div>';
	elseif($type == 7) // for timeline
		echo'<div class="tline-topdate enddte">'. get_the_time(' F Y') .'</div></div></div>';
	endif;

if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
	echo '<div class="wp-pagenavi">';
	next_posts_link(esc_html__('&larr; Previous page', 'webnus_framework'));
	previous_posts_link(esc_html__('Next page &rarr;', 'webnus_framework'));
	echo '</div>';
}

	$out = ob_get_contents();
	ob_end_clean();	
	wp_reset_postdata();
	return $out;
}
add_shortcode("blog", "webnus_blog");
?>