<?php

function wize_blog($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "order" => "desc",
        "orderby" => "DATE"
    ), $atts));
    $order    = strtoupper($order);
    $look     = null;
    $query    = array(
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $items,
        'category_name' => $cat
    );
    $look .= '
	<div class="sh-media3 fixed">';
	$wp_query = new WP_Query($query);
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'Bl1PhVd');
        $no_cover = get_template_directory_uri();
        $category = get_the_category();
		
       	/* display */
		
        $look .= '
		<div class="bl1">
			<div class="bl1-cover">';
        if ($image_id) {
            $look .= '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $look .= '
				<img src="' . esc_url($no_cover) . '/images/no-cover/bl1.png" alt="no-cover" />';
        }
        $look .= '
				<div class="bl1-cat">' . esc_html($category[0]->cat_name, "wizedesign") . '</div>
			</div><!-- end .bl1-cover -->
			<div class="bl1-text">
				<div class="bl1-title">
					<h2><a href="' . esc_url(get_permalink()) . '">';
        if (strlen($post->post_title) > 63) {
            $look .= substr(get_the_title($before = '', $after = '', FALSE), 0, 63) . '...';
        } else {
            $look .= get_the_title();
        }
        $look .= '</a></h2>
				</div><!-- end .bl1-title -->
				<p>' . wize_excerpt(270) . '</p>
				<div class="bl1-date">' . get_the_date('l, d F Y') . '</div>
				<div class="bl1-lvc">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
					<div class="info-com">' . get_comments_number() . '</div>
				</div><!-- end .bl1-lvc -->
			</div><!-- end .bl1-text -->';
        if (is_sticky()) {
            $look .= '
			<div class="sticky">' . esc_html__("Featured", "wizedesign") . '</div>';
        }
        $look .= '
		</div><!-- end .bl1 -->';
		
    endwhile;
	
    $look .= '
</div><!-- end .sh-home -->';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("blog", "wize_blog");