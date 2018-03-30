<?php
function filter_shortcode($content) {
	return do_shortcode(strip_tags($content, "<h1><h2><h3><h4><h5><h6><a><img><div><ul><li><ol><table><td><th><span><p><br><strong><em><b><i><iframe><embed>"));
}

add_shortcode('subtext','vp_subtext');
function vp_subtext($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<p class="line2nd">' . $content . '</p>';
	return $output;
}

add_shortcode('lightbox', 'vp_lightbox');
function vp_lightbox($atts, $content = null) {
	extract(shortcode_atts(array(
		'alt' => 0,
		'title' => 0,
		'thumbnail' => 0,
		'width' => 250,
		'height' => 125,
		'float' => 'none'
	), $atts));

	$content = filter_shortcode($content);

	$output = '<div class="pic" style="width: ' . $width . 'px; float: ' . $float;
	if($float == 'left') 
		$output .= '; margin-right: 10px';
	elseif($float == 'right')
		$output .= '; margin-left: 10px';
	$output .= '">';
	$output .= '<div class="proj-img">' . PHP_EOL;
	if($content != '')
	{
		if($title !== 0)
			$title = ' title="' . $title . '"';
		else
			$title = '';
		if($alt !== 0)
			$alt = ' alt="' . $alt . '"';
		else
			$alt = '';
		//the shortcode should return something only if the user sends an image
		$output .= '<a href="' . $content . '" class="prettyPhoto"' . $title . $alt . '></a>' . PHP_EOL;
		if($thumbnail === 0)
		{
			$thumbnail = $content;
		}
		//if the user sends out a thumbnail img, we use that one. If not, we use the full width img to create a thumb.
		$output .= '<img ' . $alt . ' src="' . $thumbnail . '" style="width: ' . $width . 'px; height: ' . $height . 'px" />' . PHP_EOL;
		$output .= '<i>hover background</i>' . PHP_EOL;
		$output .= '</div>
		</div>' . PHP_EOL;
	}
	else
		$output = '';
		return $output;
}

add_shortcode('quote_slider', 'vp_quote_slider');
function vp_quote_slider($atts, $content=null) {
	$content = filter_shortcode($content);
	$id = rand(1, 25000);
	$output = '<div class="quote-container">
          <div class="quote-slider" id="quote-slider-' . $id . '">' . PHP_EOL;
    $output .= $content;
    $output .= '</div>
    </div>' . PHP_EOL;
    $output .= "<script type='text/javascript'>
    jQuery().ready(function() {
    jQuery('#quote-slider-$id').cycle({
    		fx: 'scrollHorz',
    		easing: 'easeInOutExpo',
    		timeout: 8000
    	});
	});
    </script>" . PHP_EOL;
    return $output;
}
add_shortcode('quote', 'vp_quote');
function vp_quote($atts, $content=null) {
	extract(shortcode_atts(array(
		'author' => ''
	), $atts));

	$content = filter_shortcode($content);
	$output = '<div class="panel">
            <p class="quoter-text">&ldquo;' . $content . '&rdquo;</p>
            <p class="quoter">&ndash;  ' . $author . '</p>
    </div>' . PHP_EOL;
    return $output;
}

add_shortcode('slider', 'vp_slider');
function vp_slider($atts, $content=null) {
	$id = rand(0, 25000);
	$content = filter_shortcode($content);
	$output = '<div class="flexslider flex-' . $id . '">';
	$output .= '<ul class="slides">';
	$output .= $content;
	$output .= '</ul></div>';
	$output .= '
	<script type="text/javascript">
		jQuery(".flex-' . $id . '").flexslider({
				animation: "slide",
				slideshow: true,
				slideshowSpeed: 3500,
				animationSpeed: 1000
			});
	</script>';
	return $output;
}

add_shortcode('slider_img', 'vp_slider_img');
function vp_slider_img($atts, $content=null) {
	extract(shortcode_atts(array(
		'alt' => '',
		'url' => ''
	), $atts));
	$content = filter_shortcode($content);
	if($content != '')
	{
		if($url !== '')
			$output = ' <li><a target="_blank" href="' . esc_url($url) . '"><img alt="' . $alt . '" src="' . $content . '" /></a></li>' . PHP_EOL;
		else
			$output = ' <li><img alt="' . $alt . '" src="' . $content . '"></li>' . PHP_EOL;
		return $output;
	}
	else return '';
}

add_shortcode('portfolio', 'vp_portfolio');
function vp_portfolio($atts, $content=null) {
	$content = filter_shortcode($content);
	$output = '<div class="portfolio">' . PHP_EOL;
	$output .= $content;
	$output .= '</div>
	<div class="clear"></div>';
	return $output;
}

add_shortcode('filterable_portfolio', 'vp_filterable_portfolio');
function vp_filterable_portfolio($atts, $content=null) {
	extract(shortcode_atts(array(
        'filtertext'  => 'Filter',
		'categories' => '',
		'number' => 6
	), $atts));
	global $post;
	$categories = esc_attr($categories);
	$categories = str_replace(' ', '', $categories);
	$output = '<div class="filter-categories five columns">
				<div class="filter">
                <h3 class="content-title-small">' . $filtertext . '</h3>
					<ul>
						<li><a href="" data-filter="*" class="selected">All</a></li><br/><br/>';
	if($categories == '')
	{
		$cats = get_categories();
		foreach($cats as $cat) {
			$output .= '<li><a href="" data-filter=".' . $cat->term_id . '">' . $cat->name . '</a></li><br/><br/>';
		}
	}
	else
	{
		$cats = explode(",", $categories);
		foreach($cats as $cat) {
			$cat_details = get_category($cat);
			$output .= '<li><a href="" data-filter=".' . $cat . '">' . $cat_details->name . '</a></li><br/><br/>';
		}
	}

	$output .= '</ul>
				</div> <!-- end filter -->
			</div> <!-- end sixteen columns -->';

    $output .= '<div class="eleven columns">';
	$output .= '<div class="portfolio_details"></div>';
	$categories = trim($categories);
	$number = (int)$number;
	$output .= '
	<div class="filterable_portfolio">';
	$query = new WP_Query('post_type=portfolio&posts_per_page=' . $number . '&cat=' . $categories);
	while($query->have_posts() ) : $query->the_post();
		$title = get_the_title();
		$image1 = get_post_meta($post->ID, '_portfolio_image1', true);
		$image2 = get_post_meta($post->ID, '_portfolio_image2', true);
		$image3 = get_post_meta($post->ID, '_portfolio_image3', true);
		$image4 = get_post_meta($post->ID, '_portfolio_image4', true);
		$image5 = get_post_meta($post->ID, '_portfolio_image5', true);
		$image6 = get_post_meta($post->ID, '_portfolio_image6', true);
		$video1 = get_post_meta($post->ID, '_portfolio_video1', true);
		$type = get_post_meta($post->ID, '_portfolio_type', true);
		$size = get_post_meta($post->ID, '_portfolio_size', true);
		$description = get_post_meta($post->ID, '_portfolio_description', true);
		$buttontext = get_post_meta($post->ID, '_portfolio_buttontext', true);
		$buttonurl = get_post_meta($post->ID, '_portfolio_buttonurl', true);
		$thumbnail = get_post_meta($post->ID, '_portfolio_thumb', true);
		$video = get_post_meta($post->ID, '_portfolio_video', true);
		if($image1 != '' || $video1 != '')
		{ 
			if($thumbnail == '') {
				if($image1 != '')
					$thumbnail = $image1;
				elseif($image2 != '')
					$thumbnail = $image2;
				elseif($image3 != '')
					$thumbnail = $image2;
				elseif($image4 != '')
					$thumbnail = $image4;
				elseif($image5 != '')
					$thumbnail = $image5;
				elseif($image6 != '')
					$thumbnail = $image6;
			}
			$class = '';
			switch($size)
			{
				case 1:
					$class = 'class="item sixteen columns ';
					break;
				case 2:
					$class = 'class="item eight columns ';
					break;
				case 3:
					$class = 'class="item one-third column ';
					break;
				case 4: 
					$class = 'class="item four columns ';
					break;
				default:
					$class = 'class="item one-third column ';
			}
			$cats = get_the_category();
			foreach($cats as $cat)
				$class .= $cat->term_id . ' ';
			$class .= '"';
			$output .= '<div style="text-align: center" ' . $class . '>';
			if($video != '') //if the video field is not empty, we will show the video upon clicking on the zoom icon
				$zoomlink = $video;
			else
				if($image1 != '')
					$zoomlink = $image1;
				elseif($image2 != '')
					$zoomlink = $image2;
				elseif($image3 != '')
					$zoomlink = $image3;
				elseif($image4 != '')
					$zoomlink = $image4;
				elseif($image5 != '')
					$zoomlink = $image5;
				elseif($image6 != '')
					$zoomlink = $image6;
			$output .= '<div class="image">
			<a class="portfolio-opening" rel="nofollow" href="' . get_permalink() . '"><img src="' . $thumbnail . '" class="scale-with-grid" alt="" /></a> 
			<div class="hoverimage">
				<div class="overlay-img"></div>
				<a href="' . $zoomlink . '" class="prettyPhoto">
					<span class="btn-viewimage" >View Image</span>
				</a>
				<a class="portfolio-opening" rel="nofollow" href="' . get_permalink() . '">
					<span class="btn-viewproject" >View Project</span>
				</a>
			</div>
			</div>
			<p class="portfolio-title">' . $title . '</p>';
			$output .= '</div>';
		}
		endwhile;
	$output .= '</div>
    </div> <!-- end eleven columns -->
	<div class="clear"></div>';
	return $output;
}

add_shortcode('portfolio_item', 'vp_portfolio_item');
function vp_portfolio_item($atts, $content=null) {
	extract(shortcode_atts(array(
		'thumbnail' => '',
		'image' => '',
		'title' => '',
		'text' => '',
		'columns' => 3,
		'centered' => 'no',
		'alt' => '',
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns"';
			break;
		case 2:
			$class = 'class="eight columns"';
			break;
		case 3:
			$class = 'class="one-third column"';
			break;
		case 4: 
			$class = 'class="four columns"';
			break;
	}
	if($thumbnail === '')
		$thumbnail = $image;
	if($image !== '')
	{
		if($centered == 'yes')
			$var = ' style="text-align: center" ';
		else
			$var = '';
		$output = '<div ' . $var . $class . '>';
		$output .= '<a class="prettyPhoto" href="' . esc_attr($image) . '"><img alt="' . esc_attr($alt) . '" class="scale-with-grid" src="' . esc_attr($thumbnail) . '" /></a>';
		$output .= '<p class="portfolio-title">' . esc_attr($title) . '</p>';
		$output .= '</div>';
		return $output;
	}
	else return '';
}
add_shortcode('button', 'vp_button');
function vp_button($atts, $content=null) {
	extract(shortcode_atts(array(
		'url' => '',
		'newwindow' => 'no',
		'color' => 'FADBA1'
	), $atts));
	$content = filter_shortcode($content);
	$color = esc_attr($color);
	if($newwindow == 'yes')
		$target = ' target="_blank" ';
	else
		$target = '';
	if($content !== '')
	{
		if($color === 'FADBA1')
		{
			if($url === '')
				$output = '<div class="button1">' . $content . '</div>';
			else
				$output = '<a ' . $target . ' href="' . esc_url($url) . '"><div class="button1">' . $content . '</div></a>';
		}
		else
		{
			if($url === '')
				$output = '<div class="button2" style="background-color: #' . $color . '">' . $content . '</div>';
			else
				$output = '<a ' . $target . ' href="' . esc_url($url) . '"><div class="button2" style="background-color: #' . $color . '">' . $content . '</div></a>';
		}
		return $output;
	}
	else return '';
}

add_shortcode('font_family', 'vp_font_family');
function vp_font_family($atts, $content=null) {
	extract(shortcode_atts(array(
		'fontfamily' => 'Dancing Script',
	), $atts));
	$content = filter_shortcode($content);
	$output = '<h3 class="content-title-small" style="font-family:' . $fontfamily . ';">' . $content . '</h3>';
    return $output;
}

add_shortcode('testimonial', 'vp_testimonial');
function vp_testimonial($atts, $content=null) {
	$content = filter_shortcode($content);
	return '<div class="testimonials">
	<p>&ldquo;' . $content . '&rdquo;</p>
	</div>';
}

add_shortcode('center', 'vp_centered');
function vp_centered($atts, $content=null) {
	$content = filter_shortcode($content);
	return '<div style="text-align: center">' . $content . '</div>';
}
add_shortcode('list', 'vp_list');
function vp_list($atts, $content=null) {
	extract(shortcode_atts(array(
		'type' => 'bullet'
	), $atts));
	$content = filter_shortcode($content);
	if($type == 'bullet')
		$output = '<ul class="list bullet">';
	elseif($type == 'check')
		$output = '<ul class="list check">';
	elseif($type == 'float')
		$output = '<ul class="list float">';
	else return '';
	$output .= $content;
	$output .= '</ul>';
	return $output;
}

add_shortcode('pricing_table','til_pricing_table');
function til_pricing_table($atts, $content = null){
	extract(shortcode_atts(array(
		'name' => '',
		'price' => '',
		'price_text' => '',
		'moretext' => 'Sign up',
		'morelink' => '',
		'columns' => '4'
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns pricing"';
			break;
		case 2:
			$class = 'class="eight columns pricing"';
			break;
		case 3:
			$class = 'class="one-third column pricing"';
			break;
		case 4: 
			$class = 'class="four columns pricing"';
			break;
		default:
			$class = 'class="one-third column pricing"';
			break;
	}
	$content = filter_shortcode($content);
	$name = esc_attr($name);
	$price = esc_attr($price);
	$price_text = esc_attr($price_text);
	$moretext = esc_attr($moretext);
	$morelink = esc_url($morelink);
	$output = '';
	$output .= '<div ' . $class .'>';
	if($name !== '')
		$output .= '<p class="pricing-plan-name">' . $name . '</p>';
	if($price !== '')
	{
		$output .= '<p class="pricing-plan-price">' . $price . '</p>';
		if ($price_text !== '') {
			$output .= '<span class="pricing-plan-tsmall">' . $price_text . '</span>';
		}
	}
	$output .= '<ul>' . $content . '</ul>';
	$output .= '<div class="signup"><div class="pricing-button">';
	if($morelink !== '')
		$output .= '<a href="' . $morelink . '">' . $moretext . '</a>';
	else
		$output .= $moretext;
	$output .= '</div></div>
	</div>';
	return $output;
}
add_shortcode('feature','vp_feature');
function vp_feature($atts, $content = null){
	$content = filter_shortcode($content);
	if($content != '')
		return '<li>' . $content . '</li>';	
}

add_shortcode('header','vp_header');
function vp_header($atts, $content = null) {
	$content = filter_shortcode($content);
	$output = '<h3 style="text-align: center; margin-top: 25px"><span class="lines">' . $content . '</span></h3>';
	return $output;
}

add_shortcode('subheader','vp_subheader');
function vp_subheader($atts, $content = null) {
	$content = filter_shortcode($content);
	$output = '<div class="action"><p>' . $content . '</p></div>';
	return $output;
}

add_shortcode('team','vp_team');
function vp_team($atts, $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"name" => '',
		"position" => '',
		"description" => '',
		"twitter" => '',
		"facebook" => '',
		"dribble" => '',
		"skype" => '',
		"gplus" => '',
		"linkedin" => '',
		"pinterest" => '',
		"columns" => 3
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns team"';
			break;
		case 2:
			$class = 'class="eight columns team"';
			break;
		case 3:
			$class = 'class="one-third column team"';
			break;
		case 4: 
			$class = 'class="four columns team"';
			break;
		default:
			$class = 'class="one-third column team';
			break;
	}
	$output = '<div ' . $class . '>';
	if($image !== '')
		$output .= '<img alt="' . esc_attr($name) . '" class="scale-with-grid" src="' . esc_attr($image) . '" />';
	if($name !== '')
		$output .= '<p class="team-name">' . esc_attr($name) . '</p>';
	if($position !== '')
		$output .= '<p class="team-position">' . esc_attr($position) . '</p>';
	if($description !== '')
		$output .= '<p>' . esc_attr($description) . '</p>';
	$output .= '<ul>';
	if($twitter !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($twitter) . '"><img alt="Twitter icon" src="' . get_stylesheet_directory_uri() . '/images/icn-twitter.png" /></a></li>';
	if($facebook !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($facebook) . '"><img alt="Facebook icon" src="' . get_stylesheet_directory_uri() . '/images/icn-facebook.png" /></a></li>';
	if($dribble !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($dribble) . '"><img alt="Dribbble icon" src="' . get_stylesheet_directory_uri() . '/images/icn-dribbble.png" /></a></li>';
	if($skype !== '')
		$output .= '<li><a target="_blank" href="' . esc_attr($skype) . '"><img alt="Skype icon" src="' . get_stylesheet_directory_uri() . '/images/icn-skype.png" /></a></li>';
	if($gplus !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($gplus) . '"><img alt="Google+ icon" src="' . get_stylesheet_directory_uri() . '/images/icn-gplus.png" /></a></li>';
	if($linkedin !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($linkedin) . '"><img alt="LinkedIn icon" src="' . get_stylesheet_directory_uri() . '/images/icn-linkedin.png" /></a></li>';
	if($pinterest !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($pinterest) . '"><img alt="Pinterest icon" src="' . get_stylesheet_directory_uri() . '/images/icn-pinterest.png" /></a></li>';
	$output .= '</ul>
	</div>';
	return $output;
}
add_shortcode('service','vp_service');
function vp_service($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"image" => '',
		"text" => '',
		"columns" => '3',
		"url" => ''
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns service-sc"';
			break;
		case 2:
			$class = 'class="eight columns service-sc"';
			break;
		case 3:
			$class = 'class="one-third column service-sc"';
			break;
		case 4: 
			$class = 'class="four columns service-sc"';
			break;
		default:
			$class = 'class="one-third column service-sc"';
			break;
	}
	$text = esc_attr($text);
	$image = esc_attr($image);
	$title = esc_attr($title);
	$output = '<div ' . $class . '>';
	if($image != '')  {
		if($url != '') {
			$output .= '<a href="' . esc_url($url) . '"><img alt="" src="' . $image . '" /></a>';
		}
		else {
			$output .= '<img alt="" src="' . $image . '" />';
		}
	if($title != '')
		$output .= '<h4>' . $title . '</h4>';
	}
	if($text != '')
		$output .= '<p>' . $text . '</p>';
	$output .= '</div>';
	return $output;
}
?>