<?php

$current    = current_time('Y/m/d');
$queryevent	= array(
        'post_type' => 'event',
        'posts_per_page' => 4,
		'orderby' => 'meta_value',
		'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'ev_date',
                'compare' => '>=',
                'value' => $current ,
            )),
		'meta_key' => 'ev_date'
);

echo '
	<div id="evhead">';	
$wp_queryevent = new WP_Query($queryevent);
while ($wp_queryevent->have_posts()):
	$wp_queryevent->the_post();
	global $post;
    $image_id = get_post_thumbnail_id();
    $cover    = wp_get_attachment_image_src($image_id, 'SldFull');
	$no_cover = get_template_directory_uri();
    $venue    = get_post_meta($post->ID, 'ev_venue', true);
    $date     = get_post_meta($post->ID, 'ev_date', true);
	require('includes/language.php');
    $time     = strtotime($date);
    $day      = date('d', $time);
    
	/* display */
	
    echo '
		<div class="evhead-cont">
			<a href="' . esc_url(get_permalink()) . '">
				<div class="evhead-bg"></div>';
    if ($image_id) {
        echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
    } else {
        echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/evhead.png" alt="no-cover" />';
    }
    echo '
				<div class="evhead-date">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . '</div>
				<div class="evhead-week">' . esc_html($week, "wizedesign") . '</div>
				<div class="evhead-loc"><span>' . esc_html($venue, "wizedesign") . '</span></div>
			</a>
		</div><!-- end .evhead-cont -->';
	
endwhile;

echo '
	</div><!-- end #evhead -->';

wp_reset_postdata();
