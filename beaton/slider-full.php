<?php
$slider_nr  = get_post_meta($post->ID, "page_slider_nr", true);
$queryslide = array(
	'post_type' => 'slide',
    'posts_per_page' => $slider_nr,
    'meta_key' => 'wz_slider',
    'meta_value' => 'sliderfull',
    'order' => 'DESC',
    'orderby' => 'DATE'
);

$wp_slide = new WP_Query($queryslide);

echo '
<div id="slider">
	<div id="slider-full">
		<ul>';

while ($wp_slide->have_posts()):
    $wp_slide->the_post();
    $image_id  = get_post_thumbnail_id();
    $cover     = wp_get_attachment_image_src($image_id, 'SldFull');
    $link      = get_post_meta($post->ID, "sl_url", true);
	$desc      = get_post_meta($post->ID, "sl_desc", true);
    $delay     = of_get_option('slide_delay');
    $animation = of_get_option('slide_animation');
    $effects   = of_get_option('slide_effects');
	
	/* display */
	
    echo '
			<li data-transition="' . $effects . '"';
    if ($link) {
        echo ' data-link="' . $link  . '"';
    }
    echo ' data-masterspeed="1500" data-delay="' . $delay . '" data-thumb="' . $cover[0] . '">
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr( get_the_title() ) . '" data-kenburns="on" data-duration="' . $animation . '" data-ease="Linear.easeNone" data-bgfit="110" data-bgfitend="100">
				<div class="sld-bg"></div>
				<div class="tp-caption" data-x="20" data-speed="1100" data-start="1500" data-easing="Linear.easeNone" data-endspeed="500" data-endeasing="Power4.easeIn" style="z-index:3; max-width:350px; white-space: normal !important;">
					<div class="sld-full">
						<div class="sld-full-title">' . get_the_title() . '</div>
							<div class="sld-full-desc">' . $desc . '</div>
							<div class="sld-full-date">' . get_the_date('l, d F Y') . '</div>
						</div>
				</div><!-- end .tp-caption -->
			</li><!-- end li.slide -->';
		
endwhile;

wp_reset_postdata();

echo '	
		</ul>
	</div><!-- end #slider-full -->
</div><!-- end #slider -->';