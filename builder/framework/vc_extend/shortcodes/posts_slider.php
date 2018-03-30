<?php
/*LATEST NEWS*/
add_shortcode('vc_posts_slider', 'vc_posts_slider_f');
function vc_posts_slider_f( $atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'show_posts' => '1',
    ), $atts));
	$output='';
	$output .= '<div class=""><div class="blog_snipet_slider"><ul id="oi_posts_slider">'.vc_posts_slider_loop($show_posts).'</ul></div></div>';
	$output .='<script>
	
	</script>';
	return $output;

}

function vc_posts_slider_loop($show_posts)
{

	$query =  new WP_Query(array('post_type' => 'post', 'showposts' => $show_posts, 'order' => 'DESC'));
	$loop_count = 0;
	ob_start();	
	while ($query->have_posts()) { $query->the_post();
		$post_id = get_the_id();
		$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'blog-wide');
		
		echo '<li class="oi_short_blog_item">';
		echo '<div class="oi_vc_post">';
		echo '<div class="oi_vc_postimnage"><img class="img-responsive" src="'.$feat_image[0].'" alt=""></div>';
		echo '<div class="oi_slider_posts_content_holder">';
		echo '<h4><span class="vc_latest_news_title">'.get_the_title($post_id).'</span></h4>'."\n";
		echo '<div class="meta"> '.get_the_time( get_option( 'date_format' ) ).' / By '.get_the_author($post_id).' / '.get_comments_number( $post_id ).' Comments</div>';
		echo '<div class="clearfix"></div>';
		echo the_excerpt($post_id);
		echo '<a class="vc_latest_news_a" href="'. get_permalink($post_id).'">Continue reading</a>';
		echo '</div>';
		echo '</li>';
	}
	wp_reset_postdata();
	return ob_get_clean();
};
/*Latest News*/
vc_map( array(
	"name" => __("Posts Slider",'orangeidea'),
	"base" => "vc_posts_slider",
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

