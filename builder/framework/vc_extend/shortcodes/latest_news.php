<?php
/*LATEST NEWS*/
add_shortcode('vc_latest_news', 'vc_latest_news_f');
function vc_latest_news_f( $atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'show_posts' => '1',
    ), $atts));
	$output='';
	$output .= '<div class=""><div class="blog_snipet_slider"><ul>'.latest_news_loop($show_posts).'</ul></div></div>';
	return $output;

}

function latest_news_loop($show_posts)
{

	$query =  new WP_Query(array('post_type' => 'post', 'showposts' => $show_posts, 'order' => 'DESC'));
	$loop_count = 0;
	ob_start();	
	while ($query->have_posts()) { $query->the_post();
			
		$post_id = get_the_id();
		echo '<li class="oi_short_blog_item">';
		echo '<div class="oi_vc_post">';
		echo '<div class="vc_latest_news_date">'.get_the_date('M j, Y').'</div>';
		echo '<h3><span class="vc_latest_news_title">'.get_the_title($post_id).'</span></h3>'."\n";
		echo the_excerpt($post_id).'</div>';
		echo '<a class="vc_latest_news_a" href="'. get_permalink($post_id).'">Continue reading</a>';
		echo '</li>';
	}
	wp_reset_postdata();
	return ob_get_clean();
};
/*Latest News*/
vc_map( array(
	"name" => __("Latest News",'orangeidea'),
	"base" => "vc_latest_news",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"category" => __('BUILDER','orangeidea'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "show_posts",
			"heading" => __("How many posts to show", "orangeidea"),
			"value" => '',
		)
	)
) );

