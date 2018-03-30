<?php
$slider_nr     = get_post_meta($post->ID, "page_slider_nr", true);
$argsleft       = array(
	'post_type' => 'slide',
    'posts_per_page' => $slider_nr,
    'meta_key' => 'wz_slider',
    'meta_value' => 'sliderleft',
    'order' => 'DESC',
    'orderby' => 'DATE'
);
$argsright        = array(
	'post_type' => 'slide',
    'posts_per_page' => $slider_nr,
    'meta_key' => 'wz_slider',
    'meta_value' => 'sliderright',
    'order' => 'DESC',
    'orderby' => 'DATE'
);

$wp_sliderleft  = new WP_Query($argsleft);
$wp_sliderright   = new WP_Query($argsright);

echo '
<div id="slider">
	<div class="slider-boxed" style="overflow: visible;">
		<div id="slider-left">
			<ul>';
while ($wp_sliderleft->have_posts()):
    $wp_sliderleft->the_post();
    $image_id  = get_post_thumbnail_id();
    $cover     = wp_get_attachment_image_src($image_id, 'SldLR');
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
    echo '	data-masterspeed="1500" data-delay="10000">
					<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr( get_the_title() ) . '" data-kenburns="on" data-duration="' . $animation . '" data-ease="Linear.easeNone" data-bgfit="110" data-bgfitend="100">
					<div class="sld-bg"></div>
					<div class="tp-caption" data-speed="1100" data-start="1500" data-easing="Linear.easeNone" data-endspeed="500" data-endeasing="Power4.easeIn" style="z-index:3;">
						<div class="sld-left">
							<div class="sld-title">' . get_the_title() . '</div>
							<div class="sld-desc">' . $desc . '</div>
							<div class="sld-date">' . get_the_date('l, d F Y') . '</div>
						</div><!-- end .sld-left -->
					</div><!-- end .tp-caption -->
				</li><!-- end li.slide -->';
				
endwhile;

wp_reset_postdata();

echo '    
			</ul>
		</div><!-- end #slider-big -->		
	</div><!-- end .slider-boxed -->	

	<div class="slider-boxed" style="overflow: visible;">
		<div id="slider-right">
			<ul>';
while ($wp_sliderright->have_posts()):
    $wp_sliderright->the_post();
    $image_id  = get_post_thumbnail_id();
    $cover     = wp_get_attachment_image_src($image_id, 'SldLR');
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
    echo '	data-masterspeed="1500" data-delay="10000">
					<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr( get_the_title() ) . '" data-kenburns="on" data-duration="' . $animation . '" data-ease="Linear.easeNone" data-bgfit="110" data-bgfitend="100">
					<div class="sld-bg"></div>
					<div class="tp-caption" data-speed="1100" data-start="1500" data-easing="Linear.easeNone" data-endspeed="500" data-endeasing="Power4.easeIn" style="z-index:3;">
						<div class="sld-right">
							<div class="sld-title">' . get_the_title() . '</div>
							<div class="sld-desc">' . $desc . '</div>
							<div class="sld-date">' . get_the_date('l, d F Y') . '</div>
						</div><!-- end .sld-big -->
					</div><!-- end .tp-caption -->
				</li><!-- end li.slide -->';
				
endwhile;

wp_reset_postdata();

echo '    
			</ul>
		</div><!-- end #slider-big -->		
	</div><!-- end .slider-boxed -->	
</div><!-- end #slider -->';