<?php
//post
function theme_single_post($atts, $content)
{
	global $themename;
	global $comments_form_animation, $comments_form_animation_duration, $comments_form_animation_delay;
	extract(shortcode_atts(array(
		"featured_image_size" => "default",
		"columns" => 1,
		"show_post_title" => 1,
		"show_post_featured_image" => 1,
		"show_post_categories" => 1,
		"show_post_author" => 1,
		"comments" => 1,
		"comments_form_animation" => "",
		"comments_form_animation_duration" => 600,
		"comments_form_animation_delay" => 0,
		"lightbox_icon_color" => "blue_light",
		"show_post_date_box" => 1,
		"show_post_comments_box" => 1,
		"show_post_comments_label" => 0,
		"post_date_animation" => "",
		"post_date_animation_duration" => 600,
		"post_date_animation_delay" => 0,
		"post_comments_animation" => "",
		"post_comments_animation_duration" => 600,
		"post_comments_animation_delay" => 0
	), $atts));
	
	$featured_image_size = str_replace("mc_", "", $featured_image_size);
	
	global $post;
	setup_postdata($post);
	
	$output = "";
	if((int)$columns==2)
		$output .= '<div class="columns clearfix">';
	$output .= '<ul class="blog clearfix">';
	$post_classes = get_post_class("post");
	$output .= '<li class="single ';
	foreach($post_classes as $key=>$post_class)
		$output .= ($key>0 ? ' ' : '') . $post_class;
	$output .= '">';
				if((int)$columns!=2 || (int)$show_post_date_box || (int)$show_post_comments_box)
				{
				$output .= '<ul class="comment_box clearfix">';
					if((int)$columns!=2 || (int)$show_post_date_box)
					{
					$output .= '<li class="date' . ((int)$columns!=2 ? ' clearfix' : '' ) . ($post_date_animation!='' ? ' animated_element animation-' . $post_date_animation . ((int)$post_date_animation_duration>0 && (int)$post_date_animation_duration!=600 ? ' duration-' . (int)$post_date_animation_duration : '') . ((int)$post_date_animation_delay>0 ? ' delay-' . (int)$post_date_animation_delay : '') : '') . '">
						<div class="value">' . mb_strtoupper(date_i18n("d M y", get_post_time())) . '</div>
						<div class="arrow_date"></div>
					</li>';
					}
	if((int)$comments && ((int)$columns!=2 || (int)$show_post_comments_box))
	{
			$output .= '<li class="comments_number' . ($post_comments_animation!='' ? ' animated_element animation-' . $post_comments_animation . ((int)$post_comments_animation_duration>0 && (int)$post_comments_animation_duration!=600 ? ' duration-' . (int)$post_comments_animation_duration : '') . ((int)$post_comments_animation_delay>0 ? ' delay-' . (int)$post_comments_animation_delay : '') : '') . '">';
					$comments_count = get_comments_number();
	$output .= '		<a href="' . get_comments_link() . '" title="' . $comments_count . ' ' . ($comments_count==1 ? __('comment', 'medicenter') : __('comments', 'medicenter')) . '">' . $comments_count . ((int)$show_post_comments_label ? ' ' . ($comments_count==1 ? __('comment', 'medicenter') : __('comments', 'medicenter')) : '') . '</a>
					</li>';
	}
	$output .= '</ul>';
				}
				$output .= '<div class="post_content">';
				$show_images_in = get_post_meta(get_the_ID(), $themename . "_show_images_in", true);
				$attachment_ids = get_post_meta(get_the_ID(), $themename . "_attachment_ids", true);
				$images = get_post_meta(get_the_ID(), $themename . "_images", true);
				$images_count = count((array)$images);
				if($images_count>0 && ($show_images_in=="post" || $show_images_in=="both")  && $show_post_featured_image)
				{
					$images_titles = get_post_meta(get_the_ID(), $themename . "_images_titles", true);
					$videos = get_post_meta(get_the_ID(), $themename . "_videos", true);
					$iframes = get_post_meta(get_the_ID(), $themename . "_iframes", true);
					$external_urls = get_post_meta(get_the_ID(), $themename . "_external_urls", true);
					$features_images_loop = get_post_meta(get_the_ID(), $themename . "_features_images_loop", true);
					$output .= '<div class="gallery_box">
						<ul class="image_carousel">';
						if(has_post_thumbnail())
						{
							$thumb_id = get_post_thumbnail_id(get_the_ID());
							$attachment_image = wp_get_attachment_image_src($thumb_id, "large");
							$large_image_url = $attachment_image[0];
							$thumbnail_image = get_posts(array('p' => $thumb_id, 'post_type' => 'attachment'));
							$output .= '<li><span class="mc_preloader"></span>
							' . get_the_post_thumbnail(get_the_ID(), ($featured_image_size!="default" ? $featured_image_size : ($columns==2 ? $themename . "-gallery-image" : "blog-post-thumb")), array("alt" => get_the_title(), "title" => "")) . '
								<ul class="controls">
									<li>
										<a href="' . $large_image_url . '" title="' . esc_attr($thumbnail_image[0]->post_title) . '" class="fancybox open_lightbox"' . ($features_images_loop=="yes" ? ' rel="featured_' . get_the_ID() . '"' : '') . ' style="background-image: url(\'' . get_template_directory_uri() . '/images/icons_media/' . $lightbox_icon_color . '/image.png\')"></a>
									</li>
								</ul>
							</li>';
						}
					for($j=0; $j<$images_count; $j++)
					{
						$output .= '<li>' . ($j==0 && !has_post_thumbnail() ? '<span class="mc_preloader"></span>' : '') .
							wp_get_attachment_image((int)$attachment_ids[$j], ($featured_image_size!="default" ? $featured_image_size : ($columns==2 ? $themename . "-gallery-image" : "blog-post-thumb")), array("alt "=> "")) . '
								<ul class="controls">
									<li>
										<a' . (!empty($external_urls[$j]) ? ' target="_blank"' : '') . ' href="' . (!empty($external_urls[$j]) ? $external_urls[$j] : (!empty($iframes[$j]) ? $iframes[$j] : (!empty($videos[$j]) ? $videos[$j] : $images[$j] ))) . '" title="' . (!empty($images_titles[$j]) ? esc_attr($images_titles[$j]) : "") . '" class="fancybox' . (!empty($external_urls[$j]) ? '-externalurl' : (!empty($iframes[$j]) ? '-iframe' : (!empty($videos[$j]) ? '-video' : '' ))) . ' open_' . (!empty($external_urls[$j]) || !empty($iframes[$j]) ? 'iframe_' : (!empty($videos[$j]) ? 'video_' : '' )) . 'lightbox"' . ($features_images_loop=="yes" ? ' rel="featured_' . get_the_ID() . '"' : '') . ' style="background-image: url(\'' . get_template_directory_uri() . '/images/icons_media/' . $lightbox_icon_color . '/' . (!empty($videos[$j]) ? 'video' : (!empty($iframes[$j]) || !empty($external_urls[$j]) ? 'url' : 'image')) . '.png\')"></a>
									</li>
								</ul>
							</li>';
					}
					$output .= '</ul>
					</div>';
				}
				else if(has_post_thumbnail() && $show_post_featured_image)
					$output .= '<a class="post_image" href="' . get_permalink() . '" title="' . get_the_title() . '"><span class="mc_preloader"></span>' . get_the_post_thumbnail(get_the_ID(), ($featured_image_size!="default" ? $featured_image_size : ($columns==2 ? $themename . "-gallery-image" : "blog-post-thumb")), array("alt" => get_the_title(), "title" => "")) . '</a>';	
	if($show_post_title) {
		$output .= '<h2>
						<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>
					</h2>';
	}
	$output .= wpb_js_remove_wpautop(apply_filters('the_content', get_the_content()));
	
					if((int)$comments)
					{
						$output .= '<a title="' . __('Leave a reply', 'medicenter') . '" href="#comment_form" class="more reply_button">'
							. __('Leave a reply &rarr;', 'medicenter') . '
						</a>';
					}
					if((int)$show_post_categories || (int)$show_post_author)
					{
	$output .= '	<div class="post_footer clearfix">';
						if((int)$show_post_categories)
						{
						$output .= '<ul class="post_footer_details">';
							$categories = get_the_category();
							$output .= '<li>' . __('Posted in ', 'medicenter') . '</li>';
							foreach($categories as $key=>$category)
							{
								$output .= '<li>
									<a href="' . get_category_link($category->term_id ) . '" ';
								if(empty($category->description))
									$output .= 'title="' . sprintf(__('View all posts filed under %s', 'medicenter'), $category->name) . '"';
								else
									$output .= 'title="' . esc_attr(strip_tags(apply_filters('category_description', $category->description, $category))) . '"';
								$output .= '>' . $category->name . '</a>' . ($category != end($categories) ? ', ' : '') . '
								</li>';
							}
	$output .= '		</ul>';
						}
						if((int)$show_post_author)
						{
						$output .= '<ul class="post_footer_details">
							<li>' . __('Posted by', 'medicenter') . '</li>
							<li>
								' . (get_the_author_meta("user_url")!="" ? '<a class="author" href="' . get_the_author_meta("user_url") . '" title="' . get_the_author() . '">' . get_the_author() . '</a>' : get_the_author()) . '
							</li>
						</ul>';
						}
					$output .= '</div>';
					}
	$output .= '</div>
			</li>
		</ul>';
	if((int)$columns==2)
		$output .= '</div>';
	if((int)$comments)
	{
		ob_start();
		comments_template();
		mc_get_theme_file("/comments-form.php");	
		$output .= ob_get_contents();
		ob_end_clean();
	}
	return $output;
}
add_shortcode("single_post", "theme_single_post");

//visual composer
function theme_single_post_vc_init()
{
	//image sizes
	$image_sizes_array = array();
	$image_sizes_array[__("Default", 'medicenter')] = "default";
	global $_wp_additional_image_sizes;
	foreach(get_intermediate_image_sizes() as $s) 
	{
		if(isset($_wp_additional_image_sizes[$s])) 
		{
			$width = intval($_wp_additional_image_sizes[$s]['width']);
			$height = intval($_wp_additional_image_sizes[$s]['height']);
		} 
		else
		{
			$width = get_option($s.'_size_w');
			$height = get_option($s.'_size_h');
		}
		$image_sizes_array[$s . " (" . $width . "x" . $height . ")"] = "mc_" . $s;
	}
	vc_map( array(
		"name" => __("Post", 'medicenter'),
		"base" => "single_post",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-post",
		"category" => __('MediCenter', 'medicenter'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Featured image size", 'medicenter'),
				"param_name" => "featured_image_size",
				"value" => $image_sizes_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Layout type", 'medicenter'),
				"param_name" => "columns",
				"value" => array(__("Type 1", 'medicenter') => 1, __("Type 2", 'medicenter') => 2)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post title", 'medicenter'),
				"param_name" => "show_post_title",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post featured image", 'medicenter'),
				"param_name" => "show_post_featured_image",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post categories", 'medicenter'),
				"param_name" => "show_post_categories",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post author", 'medicenter'),
				"param_name" => "show_post_author",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Comments", 'medicenter'),
				"param_name" => "comments",
				"value" => array(__("Enabled", 'medicenter') => 1, __("Disabled", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Comments form box animation", "js_composer"),
				"param_name" => "comments_form_animation",
				"value" => array(
					__("none", "medicenter") => "",
					__("fade in", "medicenter") => "fadeIn",
					__("scale", "medicenter") => "scale",
					__("slide right", "medicenter") => "slideRight",
					__("slide right 200%", "medicenter") => "slideRight200",
					__("slide left", "medicenter") => "slideLeft",
					__("slide left 50%", "medicenter") => "slideLeft50",
					__("slide down", "medicenter") => "slideDown",
					__("slide down 200%", "medicenter") => "slideDown200",
					__("slide up", "medicenter") => "slideUp"
				),
				"dependency" => Array('element' => "comments", 'value' => '1')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Comments form box animation duration (ms)", 'medicenter'),
				"param_name" => "comments_form_animation_duration",
				"value" => "600",
				"dependency" => Array('element' => "comments", 'value' => '1')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Comments form box animation delay (ms)", 'medicenter'),
				"param_name" => "comments_form_animation_delay",
				"value" => "0",
				"dependency" => Array('element' => "comments", 'value' => '1')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Lightbox icon color", 'medicenter'),
				"param_name" => "lightbox_icon_color",
				"value" => array(
					__("light blue", 'medicenter') => 'blue_light', 
					__("dark blue", 'medicenter') => 'blue_dark',
					__("blue", 'medicenter') => 'blue',
					__("black", 'medicenter') => 'black',
					__("gray", 'medicenter') => 'gray',
					__("dark gray", 'medicenter') => 'gray_dark',
					__("light gray", 'medicenter') => 'gray_light',
					__("green", 'medicenter') => 'green',
					__("dark green", 'medicenter') => 'green_dark',
					__("light green", 'medicenter') => 'green_light',
					__("orange", 'medicenter') => 'orange',
					__("dark orange", 'medicenter') => 'orange_dark',
					__("light orange", 'medicenter') => 'orange_light',
					__("red", 'medicenter') => 'red',
					__("dark red", 'medicenter') => 'red_dark',
					__("light red", 'medicenter') => 'red_light',
					__("turquoise", 'medicenter') => 'turquoise',
					__("dark turquoise", 'medicenter') => 'turquoise_dark',
					__("light turquoise", 'medicenter') => 'turquoise_light',
					__("violet", 'medicenter') => 'violet',
					__("dark violet", 'medicenter') => 'violet_dark',
					__("light violet", 'medicenter') => 'violet_light',
					__("white", 'medicenter') => 'white',
					__("yellow", 'medicenter') => 'yellow'
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post date in box above post", 'medicenter'),
				"param_name" => "show_post_date_box",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
				"dependency" => Array('element' => "columns", 'value' => '2')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show comments number in box above post", 'medicenter'),
				"param_name" => "show_post_comments_box",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
				"dependency" => Array('element' => "columns", 'value' => '2')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show comments number label in box above post", 'medicenter'),
				"param_name" => "show_post_comments_label",
				"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Post date box animation", "js_composer"),
				"param_name" => "post_date_animation",
				"value" => array(
					__("none", "medicenter") => "",
					__("fade in", "medicenter") => "fadeIn",
					__("scale", "medicenter") => "scale",
					__("slide right", "medicenter") => "slideRight",
					__("slide right 200%", "medicenter") => "slideRight200",
					__("slide left", "medicenter") => "slideLeft",
					__("slide left 50%", "medicenter") => "slideLeft50",
					__("slide down", "medicenter") => "slideDown",
					__("slide down 200%", "medicenter") => "slideDown200",
					__("slide up", "medicenter") => "slideUp"
				)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Post date box animation duration (ms)", 'medicenter'),
				"param_name" => "post_date_animation_duration",
				"value" => "600"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Post date box animation delay (ms)", 'medicenter'),
				"param_name" => "post_date_animation_delay",
				"value" => "0"
			),
			array(
				"type" => "dropdown",
				"heading" => __("Post comments box animation", "js_composer"),
				"param_name" => "post_comments_animation",
				"value" => array(
					__("none", "medicenter") => "",
					__("fade in", "medicenter") => "fadeIn",
					__("scale", "medicenter") => "scale",
					__("slide right", "medicenter") => "slideRight",
					__("slide right 200%", "medicenter") => "slideRight200",
					__("slide left", "medicenter") => "slideLeft",
					__("slide left 50%", "medicenter") => "slideLeft50",
					__("slide down", "medicenter") => "slideDown",
					__("slide down 200%", "medicenter") => "slideDown200",
					__("slide up", "medicenter") => "slideUp"
				)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Post comments box animation duration (ms)", 'medicenter'),
				"param_name" => "post_comments_animation_duration",
				"value" => "600"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Post comments box animation delay (ms)", 'medicenter'),
				"param_name" => "post_comments_animation_delay",
				"value" => "0"
			)
		)
	));
}
add_action("init", "theme_single_post_vc_init");
?>
