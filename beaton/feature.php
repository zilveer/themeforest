<?php
$feature_nr = of_get_option('feature_number');
$queryfeat = array(
    'posts_per_page' => $feature_nr,
    'meta_key' => 'post_feature',
    'meta_value' => 'yes',
    'orderby' => 'DATE'
    
);

$wp_feat = new WP_Query($queryfeat);

echo '
<div id="feat">
	<div class="feat-wrap">
		<div class="feat-carousel">';

while ($wp_feat->have_posts()):
    $wp_feat->the_post();
    $category = get_the_category();
    $image_id = get_post_thumbnail_id();
    $cover    = wp_get_attachment_image_src($image_id, 'Bl2Sng');
    $no_cover = get_template_directory_uri();
    
	/* display */
	
    echo '	
			<div class="feat-cover">
				<a href="' . esc_url(get_permalink()) . '">
					<div class="feat-bg"></div>';
    if ($image_id) {
        echo '
					<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
    } else {
        echo '
					<img src="' . esc_url($no_cover) . '/images/no-cover/feat.png" alt="no-cover" />';
    }
    echo '
					<div class="feat-cat">' . esc_html($category[0]->cat_name, "wizedesign") . '</div>
					<div class="feat-title">
						<div class="feat-date">' . get_the_date('l, d F Y') . '</div>
						<h2>' . get_the_title() . '</h2>
					</div><!-- end .feat-title -->
					<div class="feat-lv">
						' . wize_like_info($post->ID) . '
						<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
					</div><!-- end .feat-lv -->
				</a>
			</div><!-- end .feat-cover -->';
			
endwhile;

wp_reset_postdata();

echo '
		</div><!-- end .feat-carousel -->
		<a href="#" class="feat-prev"></a>
		<a href="#" class="feat-next"></a>
	</div><!-- end .feat-wrap -->
</div><!-- end #feat -->';