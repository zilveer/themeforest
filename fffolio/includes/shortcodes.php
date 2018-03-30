<?php

add_shortcode('addthis','teo_addthis');
function teo_addthis($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1,
	), $atts));
	
	$output = '<div style="margin: 5px; display: inline">';
	switch($variation) {
		case 'Big bar':
			$output .= '<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_counter addthis_pill_style"></a>
				</div>';
			break;
		case 'Normal bar':
			$output .= '<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>';
			break;
		case 'Small bar':		
			$output .= '<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>';
			break;
		case 'Floating bar':
			$output .= '<div class="addthis_toolbox addthis_floating_style addthis_counter_style" style="left:50px;top:50px;">
				<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
				<a class="addthis_button_tweet" tw:count="vertical"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
				<a class="addthis_counter"></a>
				</div>';
			break;
		default:
			$output .= '<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_counter addthis_pill_style"></a>
				</div>';
	}
	$output .= '<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ff05056494689b5"></script>';
	$output .= '</div>';		
	return $output;
}
add_shortcode('one_third','teo_one_third');
function teo_one_third($atts, $content = null){
	$output = '<div class="one-third column">' . do_shortcode($content) . '</div>';
	return $output;
}
add_shortcode('eight','teo_one_half');
add_shortcode('one_half','teo_one_half');
function teo_one_half($atts, $content = null){
	$class = '';
	$output = '<div class="eight columns">' . do_shortcode($content) . '</div>';
	return $output;
}

add_shortcode('two_thirds','teo_two_thirds');
function teo_two_thirds($atts, $content = null){
	$output = '<div class="two-thirds column">' . do_shortcode($content) . '</div>';
	return $output;
}

add_shortcode('four','teo_one_fourth');
add_shortcode('one_fourth','teo_one_fourth');
function teo_one_fourth($atts, $content = null){
	extract(shortcode_atts(array(
		'icon' => '',
	), $atts));
	$content = do_shortcode($content);
	$output = '<div class="four columns">';
	if($icon !== '')
		$output .= '<img alt="" src="' . esc_attr($icon) . '">';
	$output .= $content;
	$output .= '</div>';
	return $output;
}
add_shortcode('one','teo_one');
function teo_one($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="one column">' . $content . '</div>';
	return $output;
}
add_shortcode('two','teo_two');
function teo_two($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="two columns">' . $content . '</div>';
	return $output;
}
add_shortcode('three','teo_three');
function teo_three($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="three columns">' . $content . '</div>';
	return $output;
}
add_shortcode('five','teo_five');
function teo_five($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="five columns">' . $content . '</div>';
	return $output;
}
add_shortcode('six','teo_six');
function teo_six($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="six columns">' . $content . '</div>';
	return $output;
}
add_shortcode('seven','teo_seven');
function teo_seven($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="seven columns">' . $content . '</div>';
	return $output;
}
add_shortcode('nine','teo_nine');
function teo_nine($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="nine columns">' . $content . '</div>';
	return $output;
}
add_shortcode('ten','teo_ten');
function teo_ten($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="ten columns">' . $content . '</div>';
	return $output;
}
add_shortcode('eleven','teo_eleven');
function teo_eleven($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="eleven columns">' . $content . '</div>';
	return $output;
}
add_shortcode('twelve','teo_twelve');
function teo_twelve($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="twelve columns">' . $content . '</div>';
	return $output;
}
add_shortcode('thirteen','teo_thirteen');
function teo_thirteen($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="thirteen columns">' . $content . '</div>';
	return $output;
}
add_shortcode('fourteen','teo_fourteen');
function teo_fourteen($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="fourteen columns">' . $content . '</div>';
	return $output;
}
add_shortcode('fifteen','teo_fifteen');
function teo_fifteen($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="fifteen columns">' . $content . '</div>';
	return $output;
}
add_shortcode('full','teo_full');
add_shortcode('sixteen','teo_full');
function teo_full($atts, $content = null){
	$content = do_shortcode($content);
	$output = '<div class="sixteen columns">' . $content . '</div>';
	return $output;
}
add_shortcode('skills','teo_skills');
function teo_skills($atts, $content = null){
	extract(shortcode_atts(array(
		'title' => '',
	), $atts));
	$content = do_shortcode($content);
	$output =  '<div class="sixteen columns"><div class="skills">';
	if($title !== '')
		$output .= '<h5>' . $title . '</h5>';
	$output .= $content . '</div></div>';
	return $output;
}
add_shortcode('skill','teo_skill');
function teo_skill($atts, $content = null){
	extract(shortcode_atts(array(
		'name' => '',
		'value' => '50',
		'bg' => ''
	), $atts));
	if($name !== '')
		$content = $name;
	else
		$content = do_shortcode($content);
	$value = (int)$value;
	if($value < 1 || $value > 100)
		$value = 50;
	$opacity = $value / 100;
	$rand = rand(1,4); //uses some random backgrounds, just to make them different in case the use doesn't set any
	$output = '<div class="skill_bg"><div style="opacity: ' . $opacity . '; width: ' . $value . '%;';
	if($bg !== '') 
		$output .= 'background-color: #' . esc_attr($bg);
	$output .= '" class="skill' . $rand . ' skill_hover"></div></div>';	
	$output .= '<p> ' . $content . '</p>';
	return $output;
}

add_shortcode('slider', 'teo_slider');
function teo_slider($atts, $content=null) {
	$id = rand(0, 25000);
	$content = do_shortcode($content);
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

add_shortcode('slider_img', 'teo_slider_img');
function teo_slider_img($atts, $content=null) {
	extract(shortcode_atts(array(
		'alt' => '',
		'url' => '',
		'image' => ''
	), $atts));
	if($content != '')
		$image = $content;
	$content = do_shortcode($content);
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

add_shortcode('carousel', 'teo_carousel');
function teo_carousel($atts, $content=null) {
	$content = do_shortcode($content);
	$output = '<div id="carousel" class="es-carousel-wrapper">
					<div class="es-carousel">
						<ul>' . PHP_EOL;
	$output .= $content;
	$output .= '</ul>
	</div> </div>
	<div class="clear"></div>';
	return $output;
}

add_shortcode('carousel_item', 'teo_carousel_item');
function teo_carousel_item($atts, $content=null) {
	extract(shortcode_atts(array(
		'thumb' => '',
		'image' => '',
		'alt' => '',
	), $atts));
	if($thumb === '')
		$thumb = $image;
	if($image !== '')
	{
		$output = '<li>';
		$output .= '<a class="prettyPhoto" href="' . esc_attr($image) . '"><img alt="' . esc_attr($alt) . '" src="' . esc_attr($thumb) . '" /></a>';
		$output .= '</li>';
		return $output;
	}
	else return '';
}

add_shortcode('portfolio', 'teo_portfolio');
function teo_portfolio($atts, $content=null) {
	extract(shortcode_atts(array(
		'categories' => ''
	), $atts));
	$categories = str_replace(" ", "", $categories);
	$output = '<div id="sort" class="sort">
				<div class="filter">
						<a href="" data-filter="*" class="selected">All</a>';
	$cats = explode(",", $categories);
	foreach($cats as $cat) {
		$output .= '<a href="" data-filter=".' . strtolower($cat) . '">' . $cat . '</a>';
	}

	$output .= '
				</div> <!-- end filter -->
			</div> <!-- end sort -->
	<div class="clear"></div>';

	$output .= '<div class="sixteen columns">
	<ul class="portfolio">';
	$output .= do_shortcode($content);
	$output .= '</ul>
	</div>
	<div class="clear"></div>';
	return $output;
}

add_shortcode('portfolio_item', 'teo_portfolio_item');
function teo_portfolio_item($atts, $content=null) {
	extract(shortcode_atts(array(
		'images' => '',
		'name' => '',
		'category' => '',
		'text' => '',
		'thumb' => ''
	), $atts));
	$output = '';
	$output .= '<li class="item ' . strtolower($category) . '">';
	$images = explode(",", $images);
	if($thumb === '') {
		$thumb = $images[0];
	}
	$rand = rand(1, 50000);
	$output .= '<a href="' . esc_url($images[0]) . '" class="retina" rel="prettyPhoto[' . $rand . ']">
		<img alt="" class="portimg scale-with-grid" src="' . esc_url($thumb) . '">
	</a>';
	if(count($images) >= 2) {
		for($i=1; $i<count($images); $i++)
			$output .= '<a href="' . esc_url($images[$i]) . '" rel="prettyPhoto[' . $rand . ']" style="display: none">&nbsp</a>';
	}
	if($name !== '')
		$output .= '<p class="proj_name">' . $name . '</p>';
	if($text !== '')
		$output .= '<p class="proj_type">' . $text . '</p>';
	$output .= '</li>';
	return $output;
}

add_shortcode('button', 'teo_button');
function teo_button($atts, $content=null) {
	extract(shortcode_atts(array(
		'url' => '',
		'newwindow' => 'no',
		'color' => 'FADBA1'
	), $atts));
	$content = do_shortcode($content);
	$color = esc_attr($color);
	if($color == '')
		$color = 'FADBA1';
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

add_shortcode('clear', 'teo_clear');
function teo_clear($atts, $content=null) {
	return '<div class="clear"></div>';
}
add_shortcode('center', 'teo_centered');
function teo_centered($atts, $content=null) {
	$content = do_shortcode($content);
	return '<div style="text-align: center">' . $content . '</div>';
}

add_shortcode('header','teo_header');
function teo_header($atts, $content = null) {
	$content = do_shortcode($content);
	$output = '<h2>' . $content . '</h2>';
	return $output;
}
add_shortcode('subheader','teo_subheader');
function teo_subheader($atts, $content = null) {
	$content = do_shortcode($content);
	$output = '<h5>' . $content . '</h5>';
	return $output;
}

add_shortcode('services','teo_services');
function teo_services($atts, $content = null) {
	return '<div class="more_services">' . do_shortcode($content) . '</div>';
}

add_shortcode('service','teo_service');
function teo_service($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"image" => '',
		"columns" => '3'
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
		default:
			$class = 'class="one-third column"';
			break;
	}
	$image = esc_attr($image);
	$title = esc_attr($title);
	$output = '<div ' . $class . '>
	<div class="serv_icon">';
	if($image != '') 
		$output .= '<img alt="" src="' . $image . '" />';
	if($title != '')
		$output .= '<h3>' . $title . '</h3>';
	if($content != '')
		$output .= '<p>' . $content . '</p>';
	$output .= '</div>
	</div>';
	return $output;
}

add_shortcode('box','teo_box');
function teo_box($atts, $content = null) {
	return '<div class="text_box"><p>' . $content . '</p></div>';
}

add_shortcode('social','teo_social');
function teo_social($atts, $content = null) {
	extract(shortcode_atts(array(
		"twitter" => '',
		"zerply" => '',
		"facebook" => '',
		"linkedin" => '',
		"pinterest" => '',
		"dribbble" => '',
		"gplus" => '',
	), $atts));
	$output = '<div class="social">
	<ul>';
	if($twitter !== '')
		$output .= '<li><a target="_blank" rel="nofollow" href="' . esc_url($twitter) . '"><div class="twitter"></div> Twitter</a></li>';
	if($zerply !== '')
		$output .= '<li><a target="_blank" rel="nofollow" href="' . esc_url($zerply) . '"><div class="zerply"></div> Zerply</a></li>';
	if($facebook !== '')
		$output .= '<li><a target="_blank" rel="nofollow" href="' . esc_url($facebook) . '"><div class="facebook"></div> Facebook</a></li>';
	if($linkedin !== '')
		$output .= '<li><a target="_blank" rel="nofollow" href="' . esc_url($linkedin) . '"><div class="linkedin"></div> Linkedin</a></li>';
	if($pinterest !== '')
		$output .= '<li><a target="_blank" rel="nofollow" href="' . esc_url($pinterest) . '"><div class="pinterest"></div> Pinterest</a></li>';
	if($dribbble !== '')
		$output .= '<li><a target="_blank" rel="nofollow" href="' . esc_url($dribbble) . '"><div class="dribbble"></div> Dribbble</a></li>';
	if($gplus !== '')
		$output .= '<li><a target="_blank" rel="nofollow" href="' . esc_url($gplus) . '"><div class="gplus"></div> Google+</a></li>';
	$output .= '</ul>
	</div>';
	return $output;
}

add_shortcode('divider', 'teo_divider');
function teo_divider($atts, $content=null) {
	return '<div class="sixteen columns"><div class="div_line"></div></div>';
}
?>