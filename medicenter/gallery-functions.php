<?php
function theme_gallery_shortcode($atts, $content='', $tag='medicenter_gallery')
{
	global $themename;
	global $post;
	if(isset($_GET["atts"]))//$_GET["action"]=="theme_" . $atts['shortcode_type'] . "_pagination")
		$atts = unserialize(stripslashes($_GET["atts"]));
	extract(shortcode_atts(array(
		"shortcode_type" => "",
		"header" => "",
		"animation" => 0,
		"order_by" => "title menu_order",
		"order" => "ASC",
		"type" => "list_with_details",
		"layout" => "gallery_4_columns",
		"featured_image_size" => "default",
		"hover_icons" => 1,
		"title_box" => 1,
		"details_page" => "",
		"display_method" => "dm_filters",
		"all_label" => "",
		"id" => "carousel",
		"autoplay" => 0,
		"pause_on_hover" => 1,
		"scroll" => 1,
		"effect" => "scroll",
		"easing" => "swing",
		"duration" => 500,
		"items_per_page" => 4,
		"ajax_pagination" => 1,
		"category" => "",
		"ids" => "",
		"display_headers" => 1,
		"headers_type" => "h2",
		"display_social_icons" => 1,
		"images_loop" => 0,
		"lightbox_icon_color" => "blue_light",
		"top_margin" => "page_margin_top_section"
	), $atts));

	$featured_image_size = str_replace("mc_", "", $featured_image_size);
	
	if($display_method=="dm_carousel")
	{
		if($effect=="_fade")
			$effect = "fade";
		if(strpos('ease', $easing)!==false)
		{
			$newEasing = 'ease';
			if(strpos('InOut'. $easing)!==false)
				$newEasing .= 'InOut';
			else if(strpos('In'. $easing)!==false)
				$newEasing .= 'In';
			else if(strpos('Out'. $easing)!==false)
				$newEasing .= 'Out';
			$newEasing .= ucfirst(substr($easing, strlen($newEasing), strlen($easing)-strlen($newEasing)));
		}
		else
			$newEasing = $easing;
	}
	
	$ids = explode(",", $ids);
	if($ids[0]=="-" || $ids[0]=="")
	{
		unset($ids[0]);
		$ids = array_values($ids);
	}
	$category = explode(",", $category);
	if($category[0]=="-" || $category[0]=="")
	{
		unset($category[0]);
		$category = array_values($category);
	}
	if(empty($shortcode_type))
		$shortcode_type = $tag;
	$args = array( 
		'post__in' => $ids,
		'post_type' => ($shortcode_type=='gallery' ? 'medicenter_gallery' : $shortcode_type),
		'posts_per_page' => ($display_method=="dm_pagination" ? $items_per_page : '-1'),
		'post_status' => 'publish',
		($shortcode_type=='gallery' ? 'medicenter_gallery' : $shortcode_type) . '_category' => implode(",", $category),
		'orderby' => implode(" ", explode(",", $order_by)), 
		'order' => $order
	);
	if($display_method=="dm_pagination")
	{
		if(isset($_GET["action"]) && $_GET["action"]=="theme_" . $shortcode_type . "_pagination")
			$args['paged'] = (int)$_GET['paged'];
		else
			$args['paged'] = get_query_var('paged');
	}
	query_posts($args);
	global $wp_query; 
	$post_count = $wp_query->post_count;
	
	$output = "";
	if(have_posts())
	{
		if($display_method=="dm_pagination" && ((isset($_GET["action"]) && $_GET["action"]!="theme_" . $shortcode_type . "_pagination") || !isset($_GET["action"])))
			$output .= "<div class='theme_" . $shortcode_type . "_pagination'>";
		//details
		if($type=="list_with_details" || $type=="details")
		{
			$output .= '<ul class="gallery_item_details_list clearfix' . ($type=="details" ? ' not_hidden' : '') . ($top_margin!="none" ? ' ' . $top_margin : '') . '">';
			while(have_posts()): the_post();
			$output .= '<li id="gallery-details-' . $post->post_name . '" class="gallery_item_details clearfix">
					<div class="columns no_width">
						<div class="column_left">';
							$attachment_ids = get_post_meta(get_the_ID(), $themename . "_attachment_ids", true);
							$images = get_post_meta(get_the_ID(), $themename . "_images", true);
							$images_count = count((array)$images);
							$arrayEmpty = true;
							for($i=0; $i<$images_count; $i++)
								if((int)$attachment_ids)
									$arrayEmpty = false;
							$output .= '<div class="gallery_box '.($hover_icons==0 ? 'hover_icons_off' : '').'">';
							if(!$arrayEmpty)
								$output .= '<ul class="image_carousel">';
							$features_images_loop = get_post_meta(get_the_ID(), $themename . "_features_images_loop", true);
							if(has_post_thumbnail())
							{
								$image_title = get_post_meta(get_the_ID(), "image_title", true);
								$video_url = get_post_meta(get_the_ID(), "video_url", true);
								if($video_url!="")
									$large_image_url = $video_url;
								else
								{
									$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
									$large_image_url = $attachment_image[0];
								}
								$external_url = get_post_meta(get_the_ID(), "external_url", true);
								$external_url_target = get_post_meta(get_the_ID(), "external_url_target", true);
								$iframe_url = get_post_meta(get_the_ID(), "iframe_url", true);
								if(!$arrayEmpty)
									$output .= '<li>';
								$output .= '<span class="mc_preloader"></span>
									' . get_the_post_thumbnail(get_the_ID(), $themename . "-gallery-image", array("alt" => get_the_title(), "title" => "", "class" => "mc_preload")) . '
									<ul class="controls">
										<li>
											<a' . ($external_url!="" && $external_url_target=="new_window" ? ' target="_blank"' : '') . ' href="' . ($external_url=="" ? ($iframe_url!="" ? $iframe_url : $large_image_url) : $external_url) . '" class="fancybox' . ($video_url!="" ? '-video' : ($iframe_url!="" ? '-iframe' : ($external_url!="" ? '-url' : ''))) . ' open' . ($video_url!="" ? '_video' : ($iframe_url!="" ? '_iframe' : ($external_url!="" ? '_url' : ''))) . '_lightbox"' . ($features_images_loop=="yes" ? ' rel="featured_' . get_the_ID() . '"' : '') . ($image_title!="" ? ' title="' . esc_attr($image_title) . '"' : '') . ' style="background-image: url(\'' . get_template_directory_uri() . '/images/icons_media/' . $lightbox_icon_color . '/' . ($video_url!="" ? 'video' : ($iframe_url!="" || $external_url!="" ? 'url' : 'image')) . '.png\')"></a>
										</li>
									</ul>';
								if(!$arrayEmpty)
									$output .= '</li>';
							}
							if(!$arrayEmpty)
							{
								$images_titles = get_post_meta(get_the_ID(), $themename . "_images_titles", true);
								$videos = get_post_meta(get_the_ID(), $themename . "_videos", true);
								$iframes = get_post_meta(get_the_ID(), $themename . "_iframes", true);
								$external_urls = get_post_meta(get_the_ID(), $themename . "_external_urls", true);
								for($i=0; $i<$images_count; $i++)
								{
									if((int)$attachment_ids[$i])
										$output .= '<li>' . ($i==0 && !has_post_thumbnail() ? '<span class="mc_preloader"></span>' : '') .
											wp_get_attachment_image((int)$attachment_ids[$i], $themename . "-gallery-image", array("alt "=> "")) . '
											<ul class="controls">
												<li>
													<a' . ($external_urls[$i]!="" ? ' target="_blank"' : '') . ' href="' . ($external_urls[$i]=="" ? ($iframes[$i]!="" ? $iframes[$i] : ($videos[$i]!="" ? $videos[$i] : $images[$i])) : $external_urls[$i]) . '" title="' . esc_attr($images_titles[$i]) . '" class="fancybox' . ($videos[$i]!="" ? '-video' : ($iframes[$i]!="" ? '-iframe' : ($external_urls[$i]!="" ? '-url' : ''))) . ' open' . ($videos[$i]!="" ? '_video' : ($iframes[$i]!="" ? '_iframe' : ($external_urls[$i]!="" ? '_url' : ''))) . '_lightbox"' . ($external_urls[$i]=="" && $iframes[$i]=="" && $videos[$i]=="" ? ($features_images_loop=="yes" ? ' rel="featured_' . get_the_ID() . '"' : '') : '') . ' style="background-image: url(\'' . get_template_directory_uri() . '/images/icons_media/' . $lightbox_icon_color . '/' . ($videos[$i]!="" ? 'video' : ($iframes[$i]!="" || $external_urls[$i]!="" ? 'url' : 'image')) . '.png\')"></a>
												</li>
											</ul>
										</li>';
								}
							}
							if(!$arrayEmpty)
								$output .= '</ul>';
							if((int)$title_box)
							{
								$output .= '<div class="description">
										<h3>' . get_the_title() . '</h3>
										<h5>' . get_post_meta(get_the_ID(), "subtitle", true) . '</h5>
									</div>';
							}
							$output .= '</div>';
					if((int)$display_social_icons)
					{
						$icon_type = get_post_meta(get_the_ID(), "social_icon_type", true);
						$arrayEmpty = true;
						for($i=0; $i<count($icon_type); $i++)
						{
							if($icon_type[$i]!="")
								$arrayEmpty = false;
						}
						if(!$arrayEmpty)
						{
							$icon_url = get_post_meta(get_the_ID(), "social_icon_url", true);
							$icon_target = get_post_meta(get_the_ID(), "social_icon_target", true);
							$icon_color = get_post_meta(get_the_ID(), "social_icon_color", true);
							$output .= '<ul class="social_icons clearfix">';
							for($i=0; $i<count($icon_type); $i++)
							{
								if($icon_type[$i]!="")
									$output .= '<li><a class="social_icon" href="' . $icon_url[$i] . '"' . ($icon_target[$i]=='new_window' ? ' target="_blank"' : '') . ' title="" style="background-image: url(\'' . get_template_directory_uri() . '/images/social_body/' . $icon_color[$i] . '/' . $icon_type[$i] . '.png\');">&nbsp;</a></li>';
							}
							$output .= '</ul>';
						}
					}
					$output .= '</div>
					<div class="column_right">
						<div class="details_box">';
					if((int)$display_headers)
						$output .= '<' . $headers_type . ' class="box_header' . ((int)$animation ? ' animation-slide' : '') . '"> ' . get_the_title() . '</' . $headers_type . '>';
					$output .= wpb_js_remove_wpautop(apply_filters("the_content", get_the_content()));
					$timetable_page = get_post_meta(get_the_ID(), "timetable_page", true);
					if($timetable_page!="")
					{
						$output .= '<div class="item_footer clearfix">
								<a title="' . esc_attr(get_the_title($timetable_page)) . '" href="' . get_permalink($timetable_page) . '" class="more">
									' . get_the_title($timetable_page) . ' &rarr;
								</a>
							</div>';
					}
					if($type!="details")
					{
						$output .= '<ul class="controls page_margin_top">
									<li>
										<a href="#gallery-details-close" class="close"></a>
									</li>';
						if($post_count>1)
							$output .= '
									<li>
										<a href="#" class="prev icon_small_arrow left_black"></a>
									</li>
									<li>
										<a href="#" class="next icon_small_arrow right_black"></a>
									</li>';
						$output .= '
								</ul>';
					}
					$output .= '</div>
					</div>
				</div>';
			endwhile;
			$output .= '</ul>';
		}
		
		if($type!="details")
		{
			if($header!="" && $display_method!="dm_carousel")
				$output .= '<h3 class="box_header' . ((int)$animation ? ' animation-slide' : '') . ($top_margin!="none" ? ' ' . $top_margin : '') . '">' . $header . '</h3>';

			//categories filters
			if($display_method=="dm_filters")
			{
				$categories_count = count($category);
				$output .= '<ul class="tabs_navigation isotope_filters page_margin_top clearfix">';
				if($all_label!="")
					$output .= '<li>
							<a class="selected" href="#filter-*" title="' . ($all_label!='' ? esc_attr($all_label) : '') . '">' . ($all_label!='' ? esc_attr($all_label) : '') . '</a>
						</li>';
				for($i=0; $i<$categories_count; $i++)
				{
					$term = get_term_by('slug', $category[$i], ($shortcode_type=='gallery' ? "medicenter_gallery" : $shortcode_type) . "_category");
					$output .= '<li>
							<a href="#filter-' . trim($category[$i]) . '" title="' . esc_attr($term->name) . '">' . $term->name . '</a>
						</li>';
				}
				$output .= '</ul>';
			}

			//list
			if($display_method=="dm_carousel")
				$output .= '<div class="clearfix' . ($top_margin!="none" ? ' ' . $top_margin : '') . '">
				<div class="header_left">' . ($header!="" ? '<h3 class="box_header' . ((int)$animation ? ' animation-slide' : '') . '">' . $header . '</h3>' : '') . '</div>
				<div class="header_right"><a href="#" id="' . $id . '_prev" class="scrolling_list_control_left icon_small_arrow left_black"></a><a href="#" id="' . $id . '_next" class="scrolling_list_control_right icon_small_arrow right_black"></a></div></div>
				<ul class="mc_gallery ' . $layout . ' horizontal_carousel ' . $id . ' id-' . $id . ' autoplay-' . $autoplay . ' pause_on_hover-' . $pause_on_hover . ' scroll-' . $scroll . ' effect-' . $effect . ' easing-' . $newEasing . ' duration-' . $duration . /*((int)$ontouch ? ' ontouch' : '') . ((int)$onmouse ? ' onmouse' : '') .*/ '">';
			else
				$output .= '<ul class="mc_gallery ' . $layout . '">';
			while(have_posts()): the_post();
				$categories = array_filter((array)get_the_terms(get_the_ID(), ($shortcode_type=='gallery' ? "medicenter_gallery" : $shortcode_type) . "_category"));
				$categories_count = count($categories);
				$categories_string = "";
				$i = 0;
				foreach($categories as $category)
				{
					$categories_string .= urldecode($category->slug) . ($i+1<$categories_count ? ' ' : '');
					$i++;
				}
			if($display_method=="dm_filters")
				$output .= '<li class="' . $categories_string . '" id="gallery-item-' . $post->post_name . '">
					<div class="gallery_box '.($hover_icons==0 ? 'hover_icons_off' : '').'">';
			else
				$output .= '<li class="gallery_box '.($hover_icons==0 ? 'hover_icons_off' : '').'" id="gallery-item-' . $post->post_name . '">';
				if(has_post_thumbnail())
					$output .= ($display_method!="dm_carousel" ? '<span class="mc_preloader"></span>' : '') . get_the_post_thumbnail(get_the_ID(), ($featured_image_size!="default" ? $featured_image_size : $themename . "-gallery-" . ($layout=="gallery_4_columns" ? "thumb-type-2" : ($layout=="gallery_3_columns" ? "thumb-type-1" : "image"))), array("alt" => get_the_title(), "title" => "", "class" => "mc_preload"));
				$output .= '
						<div class="description">
							<h3>' . get_the_title() . '</h3>
							<h5>' . get_post_meta(get_the_ID(), "subtitle", true) . '</h5>
						</div>';
					if(get_the_excerpt()!="")
						$output .= '<div class="item_details">' . apply_filters('the_excerpt', get_the_excerpt()) . '</div>';
						if((int)$display_social_icons)
						{
							$icon_type = get_post_meta(get_the_ID(), "social_icon_type", true);
							$arrayEmpty = true;
							for($i=0; $i<count($icon_type); $i++)
							{
								if($icon_type[$i]!="")
									$arrayEmpty = false;
							}
							if(!$arrayEmpty)
							{
								$icon_url = get_post_meta(get_the_ID(), "social_icon_url", true);
								$icon_target = get_post_meta(get_the_ID(), "social_icon_target", true);
								$icon_color = get_post_meta(get_the_ID(), "social_icon_color", true);
								$output .= '<ul class="social_icons clearfix">';
								for($i=0; $i<count($icon_type); $i++)
								{
									if($icon_type[$i]!="")
										$output .= '<li><a class="social_icon" href="' . $icon_url[$i] . '"' . (isset($icon_target[$i]) && $icon_target[$i]=='new_window' ? ' target="_blank"' : '') . ' title="" style="background-image: url(\'' . get_template_directory_uri() . '/images/social_body/' . $icon_color[$i] . '/' . $icon_type[$i] . '.png\');">&nbsp;</a></li>';
								}
								$output .= '</ul>';
							}
						}
				$output .= '
						<ul class="controls">
							<li>
								<a href="' . ($type=="list" && ((int)$details_page) ? get_permalink((int)$details_page) : '') . '#gallery-details-' . $post->post_name . '" class="open_details" style="background-image: url(\'' . get_template_directory_uri() . '/images/icons_media/' . $lightbox_icon_color . '/details.png\')"></a>
							</li>';
				if(has_post_thumbnail())
				{
					$output .= '<li>';
					$image_title = get_post_meta(get_the_ID(), "image_title", true);
					$video_url = get_post_meta(get_the_ID(), "video_url", true);
					if($video_url!="")
						$large_image_url = $video_url;
					else
					{
						$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
						$large_image_url = $attachment_image[0];
					}
					$external_url = get_post_meta(get_the_ID(), "external_url", true);
					$external_url_target = get_post_meta(get_the_ID(), "external_url_target", true);
					$iframe_url = get_post_meta(get_the_ID(), "iframe_url", true);
					$output .= '<a' . ($external_url!="" && $external_url_target=="new_window" ? ' target="_blank"' : '') . ' href="' . ($external_url=="" ? ($iframe_url!="" ? $iframe_url : $large_image_url) : $external_url) . '" class="fancybox' . ($video_url!="" ? '-video' : ($iframe_url!="" ? '-iframe' : ($external_url!="" ? '-url' : ''))) . ' open' . ($video_url!="" ? '_video' : ($iframe_url!="" ? '_iframe' : ($external_url!="" ? '_url' : ''))) . '_lightbox"' . ($external_url=="" && $iframe_url=="" && $video_url=="" ? ' rel="' . ((int)$images_loop ? 'mc_gallery' : 'gallery_item_' . get_the_ID()) . '"' : '') . ($image_title!="" ? ' title="' . esc_attr($image_title) . '"' : '') . ' style="background-image: url(\'' . get_template_directory_uri() . '/images/icons_media/' . $lightbox_icon_color . '/' . ($video_url!="" ? 'video' : ($iframe_url!="" || $external_url!="" ? 'url' : 'image')) . '.png\')"></a>
					</li>';
				}
				$output .= '</ul>';
			if($display_method=="dm_filters")
				$output .= '</div>';
			$output .= '</li>';
			endwhile;
			$output .= '</ul>';
			if($display_method=="dm_pagination" && ((isset($_GET["action"]) && $_GET["action"]!="theme_" . $shortcode_type . "_pagination") || !isset($_GET["action"])))
				$output .= "</div>";

			if(isset($_GET["action"]) && $_GET["action"]=="theme_" . $shortcode_type . "_pagination")
			{
				echo "theme_start" . $output . "theme_end";
				//Reset Query
				wp_reset_query();
				exit();
			}
			else
			{
				if($display_method=="dm_pagination")
				{
					mc_get_theme_file("/pagination.php");
					$output .= kriesi_pagination(((int)$ajax_pagination ? true : false), '', ((int)$ajax_pagination ? 100 : 2), false, false, 'theme_' . $shortcode_type . '_pagination', 'page_margin_top');
					if((int)$ajax_pagination)
						$output .= '<input type="hidden" name="theme_' . $shortcode_type . '_pagination" value="' . htmlentities(serialize($atts)) . '" />';
				}
			}
		}
	}
	//Reset Query
	wp_reset_query();
	return $output;
}
?>
